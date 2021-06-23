<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebOtsCalibre as Calibres;

class WebOtsCalibreController extends Controller
{
    public function getCalibres() {
        return Calibres::whereInactivo('0')->orderBy('nom_calibre')->get();
    } 
}
