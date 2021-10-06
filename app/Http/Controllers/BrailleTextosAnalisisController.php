<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrailleTextosAnalisis as BraileTextos;

class BrailleTextosAnalisisController extends Controller
{
     
     public function transcripcionTextos ( Request $FormData ) {
            return $FormData ;
     }
}
