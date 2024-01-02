<?php

namespace App\Console\Commands;

use App\Events\NewDataPush;
use App\Models\Data;
use App\Models\Plant;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;
use PhpMqtt\Client\Facades\MQTT;

class MqttListener extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'mqtt-listener';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        try {
            $mqtt = MQTT::connection();
            ini_set('memory_limit', '256M');
            echo sprintf("MQTT is connected\r\n");
            $mqtt->subscribe('plant/data', function (string $topic, string $message) {
                echo sprintf("Received QoS level 0 message on topic [%s]: \r\n%s\r\n", $topic, $message);
                // $message = '{"temperature":23,"humidity":33,"soil_humidity":33,"mac_address":"A0:B7:65:DE:0C:08","time":"2023-12-26 11:34:00"}';
                $data = json_decode($message, true);
                $plant = Plant::where('mac_address', $data["mac_address"])->first();
                if ($plant) {
                    $data = Data::create($data);
                    $message = "";
                    if ($data->temperature < $plant->min_temperature) {
                        $message = $message . "當前溫度小於設定最小溫度\n";
                    }
                    if ($data->temperature > $plant->max_temperature) {
                        $message = $message . "當前溫度大於設定最大溫度\n";
                    }
                    if ($data->humidity < $plant->min_humidity) {
                        $message = $message . "當前濕度小於設定最小濕度\n";
                    }
                    if ($data->humidity > $plant->max_humidity) {
                        $message = $message . "當前濕度大於設定最大濕度\n";
                    }
                    if ($data->soil_humidity < $plant->min_soil_humidity) {
                        $message = $message . "當前土壤濕度小於設定最小土壤濕度\n";
                    }
                    if ($data->soil_humidity > $plant->max_soil_humidity) {
                        $message = $message . "當前土壤濕度大於設定最大土壤濕度\n";
                    }
                    if ($message) {
                        $accessToken = config('app.Line_notify_token');
                        $responseData = Http::asForm()->withHeaders(
                            [
                                'Authorization' => "Bearer {$accessToken}"
                            ]
                        )->post(
                            'https://notify-api.line.me/api/notify',
                            [
                                'message' => "\n" . $message
                            ]
                        )->json();
                        Log::info($responseData);
                    }
                } else
                    echo "mac_address not found\n";
            }, 0);

            $mqtt->loop(true);
        } catch (\Exception $e) {
            echo sprintf($e->getMessage()) . "\n";
        }
        return 1;
    }
}
