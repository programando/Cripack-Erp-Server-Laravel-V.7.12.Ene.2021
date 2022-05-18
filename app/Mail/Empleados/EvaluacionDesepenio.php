<?php

namespace App\Mail\Empleados;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class EvaluacionDesepenio extends Mailable
{
    use Queueable, SerializesModels;

    public $Registro , $Observaciones, $Resultado , $Texto ;


    public function __construct( $Registros )
    {
        $this->Observaciones = (string)$Registros->observacion;

        $this->Registro      = $Registros ;
        if (  $Registros->aprobada  == true) {
            $this->Resultado = 'Evaluación de desempeño : APROBADA';
        }else{
            $this->Resultado= 'Evaluación de desempeño : NO APROBADA' ;
        } 

         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
   
        return $this->view('mails.empleados.EvaluacionDesempenio')
            ->from(  $this->Registro->email_crprttvo_jefe )
            ->subject( $this->Resultado) ;     
    }

    
}
