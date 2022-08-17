<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TercerosVisita as Visitas;
use Carbon\Carbon;
class TercerosVisitasController extends Controller
{
    public function grabarNuevaVisita( request $FormData ) {
         $Visita                    = new Visitas ;
         $Visita->contacto          = $FormData->contacto;
         $Visita->fecha_proxvisita  = $FormData->fecha_proxvisita;
         $Visita->fecha_visita      = Carbon::now();
         $Visita->idmtvovisita      = $FormData->idmtvovisita;
         $Visita->idtercero         = $FormData->idtercero;
         $Visita->idtercero_usuario = $FormData->idtercero_usuario;
         $Visita->resultados        = $FormData->resultados;
         $Visita->siguiente_paso    = $FormData->siguiente_paso;
         $Visita->tipo_visita       = $FormData->tipo_visita;
         $Visita->save();
         return 'Ok';
    }

}
