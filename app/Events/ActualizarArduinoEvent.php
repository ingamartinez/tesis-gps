<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class ActualizarArduinoEvent implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $luz;
    public $temperatura;
    public $sonido;
    public $movimiento;

    public $id;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public function __construct($luz, $temperatura, $sonido, $movimiento, $id)
    {

        $this->luz = $luz;
        $this->temperatura= $temperatura;
        $this->sonido = $sonido;
        $this->movimiento= $movimiento;

        $this->id = $id;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return [
            "arduino"
        ];
    }
}
