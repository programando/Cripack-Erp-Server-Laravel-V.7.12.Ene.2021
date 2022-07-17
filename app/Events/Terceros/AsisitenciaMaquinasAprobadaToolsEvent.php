<?php

namespace App\Events\Terceros;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AsisitenciaMaquinasAprobadaToolsEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public   $Cliente,  $Servicios,$EmailCrprttvo;

    public function __construct( $DatosAsistencia )     {
        $this->Cliente        = $DatosAsistencia[0]->cliente;
        $this->EmailCrprttvo  = $DatosAsistencia[0]->email_crprttvo;
        $this->Servicios      = $DatosAsistencia;
    }
 
}
