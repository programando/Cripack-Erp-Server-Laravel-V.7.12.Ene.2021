<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\MotivosVisita;

class MotivosVisitasController extends Controller
{
   public function getMotivosVistas () {
        return MotivosVisita::where('inactivo','0')->orderBy('nommtvovisita')->get();
   }
}
