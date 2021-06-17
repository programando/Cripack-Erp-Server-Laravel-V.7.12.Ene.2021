<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebOtsSustrato as Sustrato;

class WebOtsSustratoController extends Controller
{
     public function getSustratos () {
         return Sustrato::whereInactivo('0')->orderBy('nom_sustrato')->get();
     }
}
