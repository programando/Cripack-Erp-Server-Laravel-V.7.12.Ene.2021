<?php

namespace App\Http\Controllers;

use App\Helpers\Arrays;
use Illuminate\Http\Request;
use App\Models\AgendaAsstnciaMquna ;
use App\Events\Terceros\AsisitenciaMaquinasAprobadaEvent;

class AgendaAsstnciaMqunasController extends Controller
{
    
    public function consultaAgendaMesAnio( request $FormData) {
        return AgendaAsstnciaMquna::consultaAgendaMesAnio ($FormData->idmes, $FormData->anio);
    }

    public function aprobadasEnviarEmail (){
        $DatosVisita = [];
        $DatosAgenda = AgendaAsstnciaMquna::aprobadasEnviarEmail();
        // 1. Obtner cada uno de los clientes en un array 
        $IdClientes = Arrays::getUniqueIdsFromArray ( $DatosAgenda,'idtercero'  );
        $IdRegistros = Arrays::getUniqueIdsFromArray ( $DatosAgenda,'idregistro'  );
        // 2. Buscar datos de cada uno de los clientes
        foreach ( $IdClientes as $IdCliente ){
            $DatosVisita = []; 
           foreach ( $DatosAgenda as $Agenda ){
                if ( $Agenda->idtercero == $IdCliente ) {
                    array_push( $DatosVisita,$Agenda );
                }
            }
            AsisitenciaMaquinasAprobadaEvent::dispatch ( $DatosVisita );
        }
        
        return $IdRegistros;
    }

 
    
}
