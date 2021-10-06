<?php

namespace App\Mail\Terceros;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;


Use Arrays ;        //      Helpers

class OtsDibujoAprobacion extends Mailable
{
    use Queueable, SerializesModels;

    public $Empresa, $BodyTable, $Contacto ;
    public function __construct( $OtsBloquedas, $OT)
    {
       $this->Empresa = $OT->nomtercero;
       $this->Contacto  = $OT->contacto;
       $this->BodyTable = Arrays::buildTableOtsReferenciaToEmail ( $OtsBloquedas, 'idregistro_ot', $OT->idregistro_ot);
    }
 
    public function build()
    {
                return $this->view('mails.terceros.OtsDibujoAprobacion')
                    ->from(  config('company.EMAIL_FROM_ADDRESS') )
                    ->subject('Órdenes de trabajo con dibujo por aprobación') ;
    }
}
