<?php

namespace App\Events\Terceros;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DespachoServiClientesSendEmailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

   public $Remisiones ;
    public function __construct( $Remisiones ) 
    {
        $this->Remisiones = $Remisiones;
    }

}
