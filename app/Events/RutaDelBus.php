<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Queue\SerializesModels;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;

class RutaDelBus implements ShouldBroadcast
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    /**
     * Create a new event instance.
     *
     * @return void
     */
    public $estudiante_id;
    public $estado_ruta;
    public $lat;
    public $long;

    public function __construct($estudiante_id,$estado_ruta,$lat,$long)
    {
        $this->estudiante_id=$estudiante_id;
        $this->estado_ruta=$estado_ruta;
        $this->lat=$lat;
        $this->long=$long;
    }

    /**
     * Get the channels the event should broadcast on.
     *
     * @return \Illuminate\Broadcasting\Channel|array
     */
    public function broadcastOn()
    {
        return new PrivateChannel('estudiante.'.$this->estudiante_id);
    }
}
