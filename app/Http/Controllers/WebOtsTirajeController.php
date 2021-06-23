<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\WebOtsTiraje as Tirajes;

class WebOtsTirajeController extends Controller
{
    public function getTirajes() {
        return Tirajes::whereInactivo('0')->orderBy('id_tiraje')->get();
    }
}
