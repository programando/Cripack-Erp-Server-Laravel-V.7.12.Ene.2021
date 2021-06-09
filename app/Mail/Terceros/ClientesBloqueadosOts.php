<?php

namespace App\Mail\Terceros;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use App\Helpers\Utilities as HelperUtilites;

class ClientesBloqueadosOts extends Mailable
{
    use Queueable, SerializesModels;

     public $Empresa, $BodyTable;
    public function __construct( $Empresa, $OtsBloquedas, $OT)
    {
         $this->Empresa = $Empresa;
          
         $this->BodyTable = HelperUtilites::buildTableOtsReferenciaToEmail ( $OtsBloquedas, 'idregistro_ot', $OT->idregistro_ot);
         
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return 
            $this->view('mails.terceros.clientes.BloqueadosCarteraOts')                    
                 ->from(  config('company.EMAIL_CARTERA') )
                 ->subject('Órdenes de trabajo bloqueadas - Cripack S.A.S.')  ; 
    }
}
