<?php

namespace App\Console\Commands;

use App\Models\Data;
use App\Models\Plant;
use Illuminate\Console\Command;
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
                if ($plant)
                    Data::create($data);
                else
                    echo "mac_address not found\n";
            }, 0);

            $mqtt->loop(true);
        } catch (\Exception $e) {
            echo sprintf($e->getMessage()) . "\n";
        }
        return 1;
    }
}
