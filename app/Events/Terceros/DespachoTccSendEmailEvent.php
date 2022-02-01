<?php

namespace App\Events\Terceros;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class DespachoTccSendEmailEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $Emails, $Contacto ,  $Remision, $Remisiones;
    public function __construct( $Emails, $Contacto ,  $Remision, $Remisiones)
    {
        $this->Emails       = $Emails;
        $this->Contacto     = trim( $Contacto );
        $this->Remision     = $Remision;
        $this->Remisiones   = $Remisiones;
    }

   
}
