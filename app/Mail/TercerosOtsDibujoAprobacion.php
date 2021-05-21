<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Helpers\Utilities as HelperUtilites;

class TercerosOtsDibujoAprobacion extends Mailable
{
    use Queueable, SerializesModels;

    public $Empresa, $BodyTable, $Contacto ;
    public function __construct( $OtsBloquedas, $OT)
    {
       $this->Empresa = $OT->nomtercero;
       $this->Contacto  = $OT->contacto;
       $this->BodyTable = HelperUtilites::buildTableOtsReferenciaToEmail ( $OtsBloquedas, 'idregistro_ot', $OT->idregistro_ot);
    }
 
    public function build()
    {
                return $this->view('mails.TercerosOtsDibujoAprobacion')
                    ->from(  config('company.EMAIL_USUARIO') )
                    ->subject('Órdenes de trabajo con dibujo por aprobación') ;
    }
}
