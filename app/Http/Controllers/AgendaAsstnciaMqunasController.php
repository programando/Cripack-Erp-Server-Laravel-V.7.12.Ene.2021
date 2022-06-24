<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\Models\AgendaAsstnciaMquna ;

class AgendaAsstnciaMqunasController extends Controller
{
    
    public function consultaAgendaMesAnio( request $FormData) {

        return AgendaAsstnciaMquna::consultaAgendaMesAnio ($FormData->idmes, $FormData->anio);

    }
    
}
