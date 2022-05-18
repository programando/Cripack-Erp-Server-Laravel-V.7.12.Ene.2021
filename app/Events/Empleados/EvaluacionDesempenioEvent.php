<?php

namespace App\Events\Empleados;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class EvaluacionDesempenioEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public $Registro, $email_crprttvo, $email_crprttvo_jefe, $observacion,  $aprobada  ;

    public function __construct( $Registro )  {
        $this->Registro            = $Registro;
        $this->email_crprttvo      = $Registro->email_crprttvo;
        $this->email_crprttvo_jefe = $Registro->email_crprttvo_jefe;
        $this->observacion         = $Registro->observacion;
        $this->aprobada            = $Registro->aprobada ;

    }

 
}
