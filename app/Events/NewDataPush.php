<?php

namespace App\Events;

use App\Models\Data;
use App\Models\Plant;
use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Http;

class NewDataPush
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    private $message = "";
    private $data;
    private $plant;

    /**
     * Create a new event instance.
     */
    public function __construct(Plant $plant, Data $data)
    {
        $this->data = $data;
        $this->plant = $plant;
    }

    /**
     * The event's broadcast name.
     */
    public function broadcastAs(): string
    {
        return 'DataAnomaly';
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return array<int, \Illuminate\Broadcasting\Channel>
     */
    public function broadcastOn(): array
    {
        return [];
    }

    public function broadcastWith()
    {
        return [];
    }

    /**
     * Determine if this event should broadcast.
     */
    public function broadcastWhen(): bool
    {
        if ($this->data->temperature < $this->plant->min_temperature) {
            $this->message = $this->message . "當前溫度小於設定最小溫度\n";
        }
        if ($this->data->temperature > $this->plant->max_temperature) {
            $this->message = $this->message . "當前溫度大於設定最大溫度\n";
        }
        if ($this->data->humidity < $this->plant->min_humidity) {
            $this->message = $this->message . "當前濕度小於設定最小濕度\n";
        }
        if ($this->data->humidity > $this->plant->max_humidity) {
            $this->message = $this->message . "當前濕度大於設定最大濕度\n";
        }
        if ($this->data->soil_humidity < $this->plant->min_soil_humidity) {
            $this->message = $this->message . "當前土壤濕度小於設定最小土壤濕度\n";
        }
        if ($this->data->soil_humidity > $this->plant->max_soil_humidity) {
            $this->message = $this->message . "當前土壤濕度大於設定最大土壤濕度\n";
        }
        if ($this->message) {
            $accessToken = config('app.Line_notify_token');
            $responseData = Http::asForm()->withHeaders(
                [
                    'Authorization' => "Bearer {$accessToken}"
                ]
            )->post(
                'https://notify-api.line.me/api/notify',
                [
                    'message' => $this->message
                ]
            )->json();
        }
        return $this->message;
    }
}
