<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Cotizaciones as Ctz;
use App\Events\Terceros\CotizacionesNtfcionesEvent;

class CotizacionesController extends Controller
{
    public function notificacionesPendientes () {
        $Ntfciones = Ctz::notificacionesPendientes();
        foreach ($Ntfciones as $Ntfcion) {
            if ( $Ntfcion->hoy == $Ntfcion->correo1   ) $this->notificacionesPendientesPreparaEnvio ($Ntfcion );
            if ( $Ntfcion->hoy == $Ntfcion->correo2   ) $this->notificacionesPendientesPreparaEnvio ($Ntfcion );
            if ( $Ntfcion->hoy == $Ntfcion->correo3   ) $this->notificacionesPendientesPreparaEnvio ($Ntfcion );
            if ( $Ntfcion->hoy == $Ntfcion->rechazada ) $this->notificacionesPendientesPreparaEnvio ($Ntfcion );  
        }
    }

    private function notificacionesPendientesPreparaEnvio ( $Ntfcion ) {
        $Cotizacion     = Ctz::consultaCtzPorIdControl   ( $Ntfcion->idcontrol);
        $CotizacionDt   = Ctz::consultaCtzDtPorIdControl ( $Ntfcion->idcontrol);
        CotizacionesNtfcionesEvent::dispatch( $Ntfcion, $Cotizacion , $CotizacionDt );
    }

}
