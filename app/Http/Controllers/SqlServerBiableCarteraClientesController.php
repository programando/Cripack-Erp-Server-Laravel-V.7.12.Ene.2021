<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\SqlSrvBiableCarteraCliente as Cartera;

class SqlServerBiableCarteraClientesController extends Controller
{
    
    public function carterNitTercero ( request $FormData ) {
         
            return Cartera::FacturasNitTercero($FormData->Nit_Tercero );
    }
}
