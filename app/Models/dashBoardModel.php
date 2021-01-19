<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Carbon\Carbon;
use DB;
class dashBoardModel extends Model
{
    
    public function scopecomparativoVentasUltimosTresAnios()  {
        $yearFinalConsulta                   = date('Y');

        return  DB::select(' call produccion_informe_ventas_ultimos_3_anios_mes_a_mes  (?,?,?,?)',    array($yearFinalConsulta , 0,0  , 0) ) ;
    }

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

        $dtStarTodayText       = Carbon::createFromDate( $dtStarToday)->format('d-m-Y');
        $dtOneYearAgoStartText = Carbon::createFromDate( $dtOneYearAgoStart)->format('d-m-Y');
        $dtMonthToTodayStartText = ucfirst( Carbon::createFromDate( $dtMonthToTodayStart)->formatLocalized('%B %Y'));
        $dtMonthToTodayOneYearAgoStartText = ucfirst( Carbon::createFromDate( $dtMonthToTodayOneYearAgoStart)->formatLocalized('%B %Y'));
        


        return      DB::select(' call dashboard_ventas  (?,?,?,?,?,?,?,?,?,?,?,?)', 
                    array($dtStarToday, $dtEndToday,$dtOneYearAgoStart  , $dtOneYearAgoEnd,$dtMonthToTodayStart, $dtMonthToTodayEnd , $dtMonthToTodayOneYearAgoStart , $dtMonthToTodayOneYearAgoEnd     , $dtStarTodayText, $dtOneYearAgoStartText, $dtMonthToTodayStartText,$dtMonthToTodayOneYearAgoStartText ));
            
        //return  Carbon::createFromDate( $dtStarToday)->format('Y-m-d');
        //return  Carbon::createFromDate( $dtEndToday)->subYear(1)->format('Y-m-d');
        //return  Carbon::createFromDate( $dtEndToday)->subYear(1)->format('Y-m-d H:m:s');
    }


}
