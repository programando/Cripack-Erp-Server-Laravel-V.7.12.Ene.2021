<?php

namespace App\Http\Controllers;

use Throwable;
use Illuminate\Http\Request;
use App\Models\OrdenesTrabajo as OTs;
use App\Events\OrdenesTrabajoExteriorEvent;

class OrdenesTrabajoController extends Controller
{
     public function delExteriorIniciarGestionDespacho ( ) {

       try {
                $thereAreOts = OTs::delExteriorIniciarGestionDespacho();
                if ( !$thereAreOts ) return ;
                    OrdenesTrabajoExteriorEvent::dispatch( $thereAreOts  );
                    OTs::delExteriorFinalizarGestionDespacho();
                    return $thereAreOts;
            } 
       catch (Throwable $e) {
            \Log::error ($e);
                return false;
        }
    }
}
