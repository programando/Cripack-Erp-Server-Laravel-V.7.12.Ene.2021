<?php

namespace App\Mail\Terceros;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class AsisitenciaMaquinasAprobadaToolsMail extends Mailable
{
    use Queueable, SerializesModels;

    public $Cliente, $Servicios, $BodyTable;
    public function __construct( $Cliente, $Servicios )
    {
        $this->Cliente   = $Cliente;
        $this->Servicios = $Servicios;
        $this->BodyTable = $this->buildTableServiciosToEmail ( $Servicios );  
    }
 
    public function build()
    {
        return 
        $this->view('mails.terceros.AsisitenciaMaquinasAprobadaTools')                  
             ->subject('Servicios de asistencia aprobados - Cripack S.A.S.')  ; 
    }


    private  function buildTableServiciosToEmail ($DatosAsistencia ) {
        $Tabla = '';
        $Num = 1;
        foreach ($DatosAsistencia  as $Servicio) {        
                    $Tabla      = $Tabla ."<tr>"  ;
                    $Tabla      = $Tabla . "<td>" . $Num       . "</td>" ;
                    $Tabla      = $Tabla . "<td>" . Carbon::parse($Servicio->fecha)->format('m-d-Y')          . "</td>" ;
                    $Tabla      = $Tabla . "<td>" . trim($Servicio->cliente)   . "</td>" ;
                    $Tabla      = $Tabla . "<td>" . trim($Servicio->operario)   . "</td>" ;
                        $actvdad_am = is_null($Servicio->actvdad_am) ? '' : $Servicio->actvdad_am;
                        $actvdad_pm = is_null($Servicio->actvdad_pm) ? '' : $Servicio->actvdad_pm;
                            if ( trim( $actvdad_am ) == trim($actvdad_pm )  ) {
                                $Tabla = $Tabla . "<td>" . trim( $actvdad_am )   . "</td>" ;
                            }else{
                                $Tabla = $Tabla . "<td>" . trim( $actvdad_am ) . ' ' . trim( $actvdad_pm  )      . "</td>" ;
                            }
                    $Tabla = $Tabla . '</tr>';
                    $Num++;
         
        } // foreach $ArrayOts
        return   $Tabla;
    }
}
