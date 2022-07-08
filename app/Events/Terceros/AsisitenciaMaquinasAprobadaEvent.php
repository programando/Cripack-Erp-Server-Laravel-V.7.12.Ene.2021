<?php

namespace App\Events\Terceros;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class AsisitenciaMaquinasAprobadaEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    
    public   $Cliente,  $Servicios, $EmailsClientes,$EmailCrprttvo;

    public function __construct( $DatosAsistencia )     {
        $this->Cliente        = $DatosAsistencia[0]->cliente;
        $this->EmailCrprttvo  = $DatosAsistencia[0]->email_crprttvo;
        $this->EmailsClientes = $DatosAsistencia[0]->emails_cliente;
        $this->Servicios      = $DatosAsistencia;
    }
 
}
