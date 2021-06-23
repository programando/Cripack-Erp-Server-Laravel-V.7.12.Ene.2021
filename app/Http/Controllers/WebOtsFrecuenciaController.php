<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebOtsFrecuencia as Frecuencias;

class WebOtsFrecuenciaController extends Controller
{
      public function getFrecuencias() {
        return Frecuencias::whereInactivo('0')->orderBy('id_frecuencia')->get();
    }
}
