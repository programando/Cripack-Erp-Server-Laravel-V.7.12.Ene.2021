<?php
namespace App\Helpers;

use DateTime;
use Carbon\Carbon;

class Fechas {

     /* ENERO 21 2019
        VALIDA QUE LA FECHA DE DESPACHO SEA VALIDA */
    public static function pedidosFechaDspachoValidar( $FechaDespacho ) {
        $FechaDespacho = Carbon::parse($FechaDespacho)->format('Y-m-d');
        $Hoy           = Carbon::now()->format('Y-m-d');
        if ( $FechaDespacho < $Hoy ){
            $FechaDespacho = $Hoy;
        }
        return Carbon::parse( $FechaDespacho );
    }

    public static function getFechaTCC( $Fecha ) {
        // 14 Junio 2021.        Fecha de retorno '13/01/2021 ...' es interpretada como Dia 01  Mes 13, lo cual da un error.
          $Partes = explode('/',$Fecha);
          $Dia    = $Partes[1].'/';
          $Mes    = $Partes[0].'/';
          $Anio   = $Partes[2];
          $Fecha  = $Dia . $Mes . $Anio;
            return  Carbon::parse( $Fecha )->format('Y-m-d h:m:s');
    }

    public static function get1900(){
        return Carbon::create(1900, 1, 1, 0, 0, 0);
    }

    public static function getHoy() {
        return Carbon::now();
    }


}
