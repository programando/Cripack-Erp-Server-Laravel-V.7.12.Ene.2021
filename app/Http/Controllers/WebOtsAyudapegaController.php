<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebOtsAyudapega as AyudaPega;

class WebOtsAyudapegaController extends Controller
{
      public function getAyudaPega() {
        return AyudaPega::whereInactivo('0')->orderBy('id_ayudapega')->get();
    }
}
