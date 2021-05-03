<?php

namespace App\Http\Controllers;

use App\Helpers\Utilities as HelperUtilites;
use App\Models\Tercero as Terceros;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Cache;

class TercerosController extends Controller
{
    
    public function OrdenesTrabajoCliente ( Request $FormData) {
        $CacheName = HelperUtilites::getUrlUniqueName();                // obtiene nombre a partir de la URL
        $DataOts  =Cache::tags( $CacheName )->remember( $CacheName, now()->addMinutes(30), function () use ($FormData)  {
            return Terceros::getOrdenesTrabajoCliente( $FormData->idtercero );
        });
         return HelperUtilites::arrayPaginator ($DataOts, $FormData );  // Incluir paginación de un array
    }

 
}
