<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebOtsPunzones as Punzones;

class WebOtsPunzonesController extends Controller
{
        public function getPunzones() {
        return Punzones::whereInactivo('0')->orderBy('id_punzon')->get();
    }
}
