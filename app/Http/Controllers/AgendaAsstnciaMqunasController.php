<?php

namespace App\Http\Controllers;

use App\Helpers\Arrays;
use Illuminate\Http\Request;
use App\Models\AgendaAsstnciaMquna ;
use App\Events\Terceros\AsisitenciaMaquinasAprobadaEvent;
use App\Events\Terceros\AsisitenciaMaquinasAprobadaToolsEvent;

class AgendaAsstnciaMqunasController extends Controller
{
    
    public function consultaAgendaMesAnio( request $FormData) {
        return AgendaAsstnciaMquna::consultaAgendaMesAnio ($FormData->idmes, $FormData->anio);
    }

    public function aprobadasEnviarEmail (){
        $DatosVisita                = [];
        $AssistanceToolsAreRequired = false;
        $DatosAgenda                = AgendaAsstnciaMquna::aprobadasEnviarEmail();
        // 1. Obtner cada uno de los clientes en un array 
        $IdClientes = Arrays::getUniqueIdsFromArray ( $DatosAgenda,'idtercero'  );
        
        // 2. Buscar datos de cada uno de los clientes
        foreach ( $IdClientes as $IdCliente ){
            $DatosVisita                = [];
            $AssistanceToolsAreRequired  = false;                //email_equpo_asstncia = Requiere equipo para la asistencia
           foreach ( $DatosAgenda as $Agenda ){
                if ( $Agenda->idtercero == $IdCliente ) {
                    array_push( $DatosVisita,$Agenda );
                    $AssistanceToolsAreRequired = $Agenda->email_equpo_asstncia;
                }
            }
            // Informe a cliente sobr la aprobación
            AsisitenciaMaquinasAprobadaEvent::dispatch ( $DatosVisita );
            if (  $AssistanceToolsAreRequired == true ) { 
                //Solicitud de herramientas necesarias para la asistencia
                AsisitenciaMaquinasAprobadaToolsEvent::dispatch ( $DatosVisita );
            }
        }
        //Marcar registros como enviados.
        $this->aprobadasMarcarEmailEnviado ($DatosAgenda );
          
    }

    public function aprobadasMarcarEmailEnviado( $DatosAgenda ) {
        $IdRegistros = Arrays::getUniqueIdsFromArray ( $DatosAgenda,'idregistro'  );
        foreach ( $IdRegistros as $IdRegistro ){       
            AgendaAsstnciaMquna::aprobadasFinalizar( $IdRegistro );
        }
    }

 
    
}
