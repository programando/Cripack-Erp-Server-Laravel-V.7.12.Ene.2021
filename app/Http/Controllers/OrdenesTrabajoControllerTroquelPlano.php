<?php

namespace App\Http\Controllers;

use  App\Helpers\Fechas;
use  App\Helpers\Arrays;
use Illuminate\Http\Request;
use App\Models\OrdenesTrabajo as OTS;
use App\Models\OrdenesTrabajoMateriales as OtMateriales;
use App\Models\OrdenesTrabajoLabores as OtLabores;
use App\Http\Requests\TroquelPlanoRequest;

class OrdenesTrabajoControllerTroquelPlano extends Controller
{
    //TroquelPlanoRequest

    public function troquelPlano( request $FormData ) {
/*        $Madera  = $this->getMaderaWebOts ( $FormData );
       $NewOT   = $this->grabarOtTroquelPlano ($FormData );
       $this->grabarMaderas ( $NewOT, $Madera);
       $this->grabarLabores    ( $NewOT ); */
       \Log::info( $FormData);
       //return response()->json(['message'=>'error uploading file'], 503);
       return $FormData;
    }


    private function getMaderaWebOts ( $FormData) {
       return OTS::getMaderaWebOts( $FormData->id_maquina,$FormData->id_sustrato  );
    }

    private function grabarOtTroquelPlano( $FormData ) {    
        $Ot = new OTS;
        $Ot->numero_ot              = $this->getNewNumberOt();
        $Ot->idsucursal             = 1;
        $Ot->idtercero              = $FormData->idtercero;
        $Ot->idestilotrabajo        = 1;
        $Ot->idtipotrabajo          = 1;
        $Ot->idgradodificultad      = 1;                              // ToDo
        $Ot->idtercero_vendedor     = $FormData->idtercero_vendedor;
        $Ot->idtercero_realiza      = $FormData->idtercero_realiza;
        $Ot->fecha_registro         = Fechas::getHoy();
        $Ot->fecha_solicitud        = Fechas::getHoy();
        $Ot->fecha_entrega          = Fechas::getHoy();
        $Ot->fecha_terminada        = Fechas::get1900();
        $Ot->fecha_facturada        = Fechas::get1900();
        $Ot->fecha_costeada         = Fechas::get1900();
        $Ot->referencia             = $FormData->referencia;
        $Ot->referencia_facturacion = $FormData->referencia;
        $Ot->cabida                 = $FormData->cabida;
        $Ot->cantidad               = 1;                              //ToDo
        $Ot->observaciones          = $FormData->observaciones;
        $Ot->aplica_produccion      = 1;
        $Ot->activa                 = 1;
        $Ot->cm_ot                  = 100 ;                           //ToDo              
        $Ot->cm_ot_equivalentes     = 100 ;                           //ToDo              
        $Ot->save();
        return $Ot;
    }

    private function grabarMaderas( $NewOT,$Materiales ) {
            foreach ($Materiales as  $Material) {   
                $NewMaterial                = new OtMateriales;
                $NewMaterial->idregistro_ot = $NewOT->idregistro_ot;
                $NewMaterial->idmaterial    = $Material->idmaterial;
                $NewMaterial->suma_cm_ot    = $Material->sumarordtrab;
                $NewMaterial->save();
            }
    }
    private function grabarLabores ( $NewOT  ) {
        $Labores = OTS::getLaboresPorEstiloTipoTrabajo() ;
        foreach ($Labores as $Labor) {
            $NewLabor                = new OtLabores ;
            $NewLabor->idregistro_ot = $NewOT->idregistro_ot;
            $NewLabor->idlabor       = $Labor->idlabor;
            $NewLabor->save();
        }
    }
    private function getNewNumberOt() {
       $NumeroOt = OTS::where('idsucursal','1')->orderBy('idregistro_ot','DESC')->take(1)->get() ;
       return $NumeroOt[0]['numero_ot'] + 1;
    }

}
