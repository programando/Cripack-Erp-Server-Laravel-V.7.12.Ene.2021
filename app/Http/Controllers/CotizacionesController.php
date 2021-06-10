<?php

namespace App\Http\Controllers;


use Carbon\Carbon;
use Illuminate\Http\Request;
use App\Models\Cotizaciones as Ctz;
use App\Events\Terceros\CotizacionesNtfcionesEvent;

class CotizacionesController extends Controller
{
    /*JUNIO 09 2021         CONSULTA NOTIFICACIONES PARA EL DÍA. SE ENVIAN CORREOS POR MEDIO DE CRON       */
    public function notificacionesPendientes () {
        $Ntfciones = Ctz::notificacionesPendientes();
        foreach ($Ntfciones as $Ntfcion) {
            if ( $Ntfcion->hoy == $Ntfcion->correo1   ) $this->notificacionesPendientesPreparaEnvio ($Ntfcion );
            if ( $Ntfcion->hoy == $Ntfcion->correo2   ) $this->notificacionesPendientesPreparaEnvio ($Ntfcion );
            if ( $Ntfcion->hoy == $Ntfcion->correo3   ) $this->notificacionesPendientesPreparaEnvio ($Ntfcion );
            if ( $Ntfcion->hoy == $Ntfcion->rechazada ) $this->rechazarCotizacion ( $Ntfcion->idcontrol );  
        }
    }

    private function notificacionesPendientesPreparaEnvio ( $Ntfcion ) {
        $Cotizacion     = Ctz::consultaCtzPorIdControl   ( $Ntfcion->idcontrol);
        $CotizacionDt   = Ctz::consultaCtzDtPorIdControl ( $Ntfcion->idcontrol);
        CotizacionesNtfcionesEvent::dispatch( $Ntfcion, $Cotizacion , $CotizacionDt );
    }

    /*JUNIO 09 2021         SI LA FECHA DE RECHAZO COINCIDE CON EL DÍA, COTIZACIÓN CAMBIA DE ESTADO      */
    public function rechazarCotizacion(  $IdControl ) {
        $Cotizacion               = Ctz::where('idcontrol', $IdControl)->first();
        $Cotizacion->id_estado    = 3;                                             // Rechazada
        $Cotizacion->fecha_estado = Carbon::now();
        $Cotizacion->save();
    }

}
