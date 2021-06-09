<?php

namespace App\Events\Terceros;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class ClientesBloqueadosOtsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $OTs, $Cliente, $Emails, $OT;
    public function __construct( $Cliente, $Emails, $OTs, $OT )
    {
        $this->OTs     = $OTs;
        $this->Cliente = trim($Cliente);
        $this->Emails  = $Emails;
        $this->OT      = $OT;

    }

   
}
