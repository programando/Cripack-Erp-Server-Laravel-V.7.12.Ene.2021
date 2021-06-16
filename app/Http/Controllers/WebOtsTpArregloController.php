<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebOtsTpArreglo as TipoArreglo;

class WebOtsTpArregloController extends Controller
{
     public function getTiposArreglos () {
         return TipoArreglo::whereInactivo('0')->orderBy('nom_tp_arreglo')->get();
     }
}
