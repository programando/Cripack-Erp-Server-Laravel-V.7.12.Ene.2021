<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SqlSrvBiableCarteraCliente as Cartera;

class SqlServerBiableCarteraClientesController extends Controller
{
    
    public function carterNitTercero ( request $FormData ) {
         
        $Cartera = Cartera::FacturasNitTercero( trim($FormData->Nit_Tercero) );
        if ( $Cartera ) {
            return $Cartera;
        }else {
            return 'nada';
        }
    }
}
