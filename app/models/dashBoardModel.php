<?php

namespace App\models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
class dashBoardModel extends Model
{
    
    public function scopeventas() {
        // Hoy   Hoy-365  ( Inicio y Final )
        $dtStarToday                   = date('Y-m-d 00:01:00');
        $dtEndToday                    = date('Y-m-d 23:59:59');
        $dtOneYearAgoStart             = Carbon::createFromDate( $dtStarToday)->subYear(1)->format('Y-m-d H:m:s');
        $dtOneYearAgoEnd               = Carbon::createFromDate( $dtEndToday)->subYear(1)->format('Y-m-d H:m:s');
        
        // Este mes hasta hoy ( Este mes, pero del año pasado )
        $dtMonthToTodayStart           = Carbon::now()->startOfYear()->format('Y-m-d H:m:s');
        $dtMonthToTodayEnd             = Carbon::createFromDate( $dtEndToday)->format('Y-m-d H:m:s');
        $dtMonthToTodayOneYearAgoStart = Carbon::now()->startOfYear()->subYear(1)->format('Y-m-d H:m:s');
        $dtMonthToTodayOneYearAgoEnd   = Carbon::createFromDate( $dtEndToday)->subYear(1)->format('Y-m-d H:m:s');

        return      DB::select(' call dashboard_ventas  (?,?,?,?,?,?,?,?)', 
                    array($dtStarToday, $dtEndToday,$dtOneYearAgoStart  , $dtOneYearAgoEnd,$dtMonthToTodayStart, $dtMonthToTodayEnd , $dtMonthToTodayOneYearAgoStart , $dtMonthToTodayOneYearAgoEnd     ));
            
        //return  Carbon::createFromDate( $dtStarToday)->format('Y-m-d');
        //return  Carbon::createFromDate( $dtEndToday)->subYear(1)->format('Y-m-d');
        //return  Carbon::createFromDate( $dtEndToday)->subYear(1)->format('Y-m-d H:m:s');
    }


}
