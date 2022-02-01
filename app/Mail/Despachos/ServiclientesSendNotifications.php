<?php

namespace App\Mail\Despachos;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ServiclientesSendNotifications extends Mailable
{
    use Queueable, SerializesModels;

     public $BodyTable;
    public function __construct( $Remisiones )
    {
        $this->BodyTable = $this->getTableHTML( $Remisiones );
    }

  
    public function build()  {
          return $this->view('mails.despachos.ServiClientesRemisiones')
                    ->from(  config('company.EMAIL_FROM_ADDRESS') )
                    ->subject('Notificación despachos a clientes') ;
    }

    private function getTableHTML ($Remisiones ) {
        $Tabla = '';
        $Num   = 1;
        foreach ($Remisiones  as $OT) {
                $Tabla = $Tabla ."<tr>"  ;
                $Tabla = $Tabla . "<td>" . $Num                             . "</td>" ;
                $Tabla = $Tabla . "<td>" . $OT->numero_ot                   . "</td>" ;
                $Tabla = $Tabla . "<td>" . trim($OT->nom_destinatario)      . "</td>" ;
                $Tabla = $Tabla . "<td>" . trim($OT->nomestilotrabajo)      . "</td>" ;
                $Tabla = $Tabla . "<td>" . trim($OT->referencia )           . "</td>" ;
                $Tabla = $Tabla . "<td>" . trim($OT->nro_rmsa_tcc )         . "</td>" ;
                $Tabla = $Tabla . "<td>" . trim($OT->nomtransportador )     . "</td>" ;
                $Tabla = $Tabla . '</tr>';
                $Num++;
        } 
        return   $Tabla;
    }
}

 