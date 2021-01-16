<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\models\dashBoardModel as dashBoard;


class dashBoardController extends Controller
{
    
    public function ventas() {

            return dashBoard::ventas();

             

    }

}
