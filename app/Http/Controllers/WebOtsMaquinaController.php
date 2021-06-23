<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebOtsMaquina as Maquinas;

class WebOtsMaquinaController extends Controller
{
    public function getMaquinas() {
        return Maquinas::whereInactivo('0')->orderBy('nom_maquina')->get();
    }
}
