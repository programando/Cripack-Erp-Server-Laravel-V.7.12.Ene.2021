<?php
namespace App\Mail\Terceros;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

use Arrays ;    //  Helpers

class SolicitudOrdenCompra extends Mailable
{
    use Queueable, SerializesModels;

     public $Empresa, $BodyTable, $VrTotalOts;
    public function __construct( $Empresa, $OtsBloquedas, $OT)
    {
         $this->Empresa = $Empresa;
          
         $this->BodyTable = $this->buildTableOts ( $OtsBloquedas);
 
  
    }

    /**
     * Build the message.
     *
     * @return $this
     */
    public function build()
    {
        return 
            $this->view('mails.terceros.SolicitudOrdenesCompra')                    
                 ->from(  config('company.EMAIL_FROM_ADDRESS') )
                 ->subject('Solicitd órdenes de compra - Cripack S.A.S.')  ; 
    }

       private function buildTableOts ($ArrayOts ) {
          
        $Tabla = '';
        $Num = 1;
        $this->VrTotalOts = 0;
        foreach ($ArrayOts  as $OT) {
                    $Url =  route('get-cotizacion-from-ot', ['ID' => $OT->idregistro_ot]);
                    $Tabla =  $Tabla ."<tr>"  ;
                    $Tabla = $Tabla . "<td>" . $Num       . "</td>" ;
                    $Tabla = $Tabla . "<td style='padding-left:10px;'> " . $OT->numero_ot          . "</td>" ;
                    $Tabla = $Tabla . "<td style='padding-left:10px;'>" . trim($OT->nomestilotrabajo)   . "</td>" ;
                    $Tabla = $Tabla . "<td style='padding-left:10px;'>" . trim($OT->referencia )        . "</td>" ;
                    $Tabla = $Tabla . "<td style='padding-left:10px;text-align:right;'>" . 0   . "</td>" ;
                    if ( $OT->ctzacion_precio_unitario > 0 ) {
                        $Tabla = $Tabla . "<td style='text-align:center'> <a href='$Url'> Descargar </a></td>" ;
                    }
                    $Tabla = $Tabla . "<td style='padding-left:10px;text-align:right;'>" . number_format($OT->precio_venta)   . "</td>" ;
                    $Tabla = $Tabla . '</tr>';
                    $Num++;
                    $this->VrTotalOts = $this->VrTotalOts + $OT->precio_venta;
        } // foreach $ArrayOts
                    $Tabla =  $Tabla ."<tr></tr>"  ;
                    $Tabla =  $Tabla ."<tr></tr>"  ;
                    $Tabla =  $Tabla ."<tr></tr>"  ;
                    $Tabla =  $Tabla ."<tr></tr>"  ;
                    $Tabla =  $Tabla ."<tr>"  ;
                    $Tabla = $Tabla . "<td></td>" ;
                    $Tabla = $Tabla . "<td style='padding-left:10px;'> </td>" ;
                    $Tabla = $Tabla . "<td style='padding-left:10px;'></td>" ;
                    $Tabla = $Tabla . "<td></td>" ;
                    $Tabla = $Tabla . "<td></td>" ;
                    $Tabla = $Tabla . "<td style='padding-left:10px;text-align:right;font-weight: 700;'> TOTAL </td>" ;
                    $Tabla = $Tabla . "<td style='padding-left:10px;text-align:right;font-weight: 700;'>" . number_format($this->VrTotalOts)   . "</td>" ;
                    $Tabla = $Tabla . '</tr>';
            
        return   $Tabla;
    }

}
