<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Tercero as Terceros;
use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Session;
use App\Helpers\Utilities as HelperUtilites;

class TercerosController extends Controller
{
    
    public function OrdenesTrabajoCliente ( Request $FormData) { 
        $FormData  = $this->isUserCripack ( $FormData );
        $CacheName = HelperUtilites::getUrlUniqueName();                                                                     // obtiene nombre a partir de la URL
        $DataOts   = Cache::tags( $CacheName )->remember( $CacheName, now()->addMinutes(30), function () use ($FormData)  {
            return Terceros:: getOrdenesTrabajoCliente( $FormData  );
        });  
         return HelperUtilites::arrayPaginator ($DataOts, $FormData );  // Incluir paginación de un array
    }


    public function OrdenesTrabajoEstadoProduccion ( Request $FormData ) {
       $FormData = $this->isUserCripack ( $FormData );       
       $OtsProduccion = Terceros::otsEstadoProduccion( $FormData->idTercero );
       $DatosTablero = array( array('numero_ot'=>0,'referencia'=>'', 'nomestilotrabajo'=>'','nomtipotrabajo'=>'',
                            'labor1'=>'', 'labor2'=>'', 'labor3'=>'', 'labor4'=>'', 'labor5'=>'',
                            'labor6'=>'', 'labor7'=>'', 'labor8'=>'', 'labor9'=>'', 'labor10'=>'',
                            'color1'=>'', 'color2'=>'', 'color3'=>'', 'color4'=>'', 'color5'=>'',
                            'color6'=>'', 'color7'=>'', 'color8'=>'', 'color9'=>'', 'color10'=>'',
                             'fecha_confirmada'=>''
                             ));
        $I            = 0;
        foreach  ($OtsProduccion  as $OT ) {
          $DatosTablero[$I]['numero_ot']        = $OT->numero_ot;
          $DatosTablero[$I]['referencia']       = trim( $OT->referencia       );
          $DatosTablero[$I]['nomestilotrabajo'] = trim( $OT->nomestilotrabajo );
          $DatosTablero[$I]['nomtipotrabajo']   = trim( $OT->nomtipotrabajo );
          $DatosTablero[$I]['fecha_confirmada'] =  $OT->fecha_confirmada ;
          //CONSULTA LAS LABORES DE LA OT
          //-------------------------------
          $IdLabor = 1;
          $Labores = Terceros::otsEstadoProduccionLaboresOt ($OT->idregistro_ot );
          foreach ($Labores  as $Labor) {
              $Anio_Inicio = $Labor->anio_inicio;
              $Anio_Final  = $Labor->anio_final;
              $IdInactiva  = $Labor->id_motivo_inactiva_ot;

              $DatosTablero[$I]["labor$IdLabor"] = $Labor->nomlabor;

              if ( $Anio_Inicio > 0 && $Anio_Final > 0){
                $DatosTablero[$I]["color$IdLabor"] = 'VERDE';
              }
              if ( $Anio_Inicio == 0 && $Anio_Final == 0){
                $DatosTablero[$I]["color$IdLabor"] = 'AZUL';
              }
              if ( $Anio_Inicio > 0 && $Anio_Final == 0){
                $DatosTablero[$I]["color$IdLabor"] = 'AMARILLO';
              }
              if ( $IdInactiva !=0 && $IdInactiva != 7 ){
                $DatosTablero[$I]["color$IdLabor"] = 'ROJO';
              }
              $IdLabor ++;
          }// Fin For Each Labores
          if ( $IdLabor < 11 )  {
            $IdLabor = $IdLabor-1;
            for ( $K=$IdLabor; $K <=10 ; $K++ ) {
               $DatosTablero[$I]["labor$K"] = '';
               $DatosTablero[$I]["color$K"] = '';
            }
          }

        $I++;
      }
      //Debug::Mostrar ( $DatosTablero);
      return $DatosTablero;
    }

    private function isUserCripack (  $FormData ) {
        if (  $FormData->userCripack  == '1' ) {
           $FormData->merge([ 'idTercero' => '0']);
        }
        return $FormData;
    }
 
}
