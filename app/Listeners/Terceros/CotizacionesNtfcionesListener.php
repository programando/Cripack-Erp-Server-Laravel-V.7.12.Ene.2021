<?php

namespace App\Listeners\Terceros;

use App\Mail\Terceros\CotizacionesNtfciones;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Terceros\CotizacionesNtfcionesEvent;

class CotizacionesNtfcionesListener
{

    public function handle(CotizacionesNtfcionesEvent $event)
    {
          Mail::to( trim($event->Ntfcion->email))
           ->cc( config('company.EMAIL_PRODUCCION') )
           ->cc( config('company.EMAIL_SERVICLIENTES') )
           ->queue(   new CotizacionesNtfciones ($event->Ntfcion, $event->Cotizacion , $event->CotizacionDt));
    }
}
