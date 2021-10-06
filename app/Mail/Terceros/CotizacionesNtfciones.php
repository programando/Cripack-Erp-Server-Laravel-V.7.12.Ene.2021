<?php

namespace App\Mail\Terceros;

use Carbon\Carbon;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class CotizacionesNtfciones extends Mailable
{
    use Queueable, SerializesModels;

    public $Empresa, $Contacto, $BodyTable, $NroCotizacion, $FechaCotizacion;

    public function __construct( $Ntfcion, $Cotizacion, $CotizacionDt )
    {
        
         $this->Empresa         = trim ( $Cotizacion[0]->nomtercero) ;
         $this->Contacto        = trim( $Ntfcion->destinatario) ;
         $this->NroCotizacion   = $Cotizacion[0]->numcotizacion;
         $this->FechaCotizacion = Carbon::parse( $Cotizacion[0]->fecha)->format('d-M-Y');
         $this->BodyTable       = $this->buildTable ( $CotizacionDt );
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build() {
       return 
            $this->view('mails.terceros.CotizacionesNtfciones')                    
                 ->from(  config('company.EMAIL_FROM_ADDRESS') )
                 ->subject('Seguimiento Cotización Nro.: ' . $this->NroCotizacion . ' Cripack S.A.S ' )  ; 
    }

    private function buildTable ( $CotizacionDt ) {
           $Tabla = '';
 
           foreach ($CotizacionDt  as $CotizDt) {
               $Aprobada = url('cotizaciones/aprobada'      , [$CotizDt->idregistro_ctz_dt] );
               $EnEstudio = url('cotizaciones/en-estudio'   , [$CotizDt->idregistro_ctz_dt] );
               $Tabla   =  $Tabla ."<tr>" ;
               $Tabla   = $Tabla . "<td>" . trim( $CotizDt->referencia        )    . "</td>" ;
               $Tabla   = $Tabla . "<td>" . trim( $CotizDt->nomestilotrabajo  )    . "</td>" ;
               $Tabla   = $Tabla . "<td>" . trim( $CotizDt->nomtipotrabajo    )    . "</td>" ;
               $Tabla   = $Tabla . "<td>" . trim( $CotizDt->nommaterial       )    . "</td>" ;
               $Tabla   = $Tabla . "<td style='text-align: center;'>" . trim( $CotizDt->cabida            )    . "</td>" ;
               $Tabla   = $Tabla . "<td style='text-align: center;'>" . trim( $CotizDt->cantidad            )    . "</td>" ;
               $Tabla   = $Tabla . "<td style='text-align: center;'>" . trim( $CotizDt->encauche            )    . "</td>" ;
               $Tabla   = $Tabla . "<td style='text-align: right;'>" . "$" . number_format($CotizDt->vr_precio_vta_dado, 0, "" ,".")              . "</td>" ;
               $Tabla   = $Tabla . "<td style='text-align: center;'>" .
                                    '<a class="btn-aprobar"  href="'. $Aprobada  .'">   Aprobar </a>' . "</td>" ;
               $Tabla   = $Tabla . "<td style='text-align: center;'>" .
                                   '<a class="btn-estudio"  href="'. $EnEstudio .'">Pendiente</a>'. "</td>" ;

               $Tabla = $Tabla . '</tr>';
        }
          return $Tabla;
    }
}
