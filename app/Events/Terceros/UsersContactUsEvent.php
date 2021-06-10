<?php

namespace App\Events\Terceros;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class UsersContactUsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $contacto, $asunto, $email, $mensaje ;
 
    public function __construct( $Data )
    {
        $this->contacto = $Data->contacto ;
        $this->asunto   = $Data->asunto ;
        $this->email    = $Data->email ;
        $this->mensaje  = $Data->mensaje ;

    }
}
