<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\dashBoardModel as dashBoard;


class dashBoardController extends Controller
{
    
    public function ventas() {
        return dashBoard::ventas();
    }
    public function comparativoVentasUltimosTresAnios() {
        return dashBoard::comparativoVentasUltimosTresAnios();
    }
}
