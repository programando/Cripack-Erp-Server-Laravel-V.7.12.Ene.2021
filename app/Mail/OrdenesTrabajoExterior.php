<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class OrdenesTrabajoExterior extends Mailable
{
    use Queueable, SerializesModels;

    public $Ots, $BodyTable;
    public function __construct( $Ots)
    {
      $this->Ots       =   $Ots;
      $this->BodyTable = $this->buildTableOts ($Ots  );
    }


    public function build()
    {
        return $this->from(config('company.EMAIL_FROM_ADDRESS'))
            ->subject('Órdenes de trabajo del exterior pendientes por despacho')
            ->view('mails.ordenesTrabajo.exterior');
    }

    private function buildTableOts ( $ArrayOts ) {
        $Tabla = '';
        $Num = 1;
        foreach ($ArrayOts  as $OT) {
                    $Tabla =  $Tabla ."<tr>"  ;
                    $Tabla = $Tabla . "<td>" . $Num       . "</td>" ;
                    $Tabla = $Tabla . "<td>" . $OT->numero_ot          . "</td>" ;
                    $Tabla = $Tabla . "<td>" . trim($OT->nomtercero)   . "</td>" ;
                    $Tabla = $Tabla . "<td>" . trim($OT->nomestilotrabajo)   . "</td>" ;
                    $Tabla = $Tabla . "<td>" . trim($OT->referencia )        . "</td>" ;
                    $Tabla = $Tabla . '</tr>';
                    $Num++;
        } // foreach $ArrayOts
        return   $Tabla;

    }
}
