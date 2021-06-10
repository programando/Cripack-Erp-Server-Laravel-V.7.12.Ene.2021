<?php

namespace App\Events\Terceros;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClientesBloqueadosEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $Emails, $Empresa ;
    public function __construct( $Emails, $Empresa  )
    {
        $this->Emails = $Emails;
        $this->Empresa = trim($Empresa) ;
    }

 
}
