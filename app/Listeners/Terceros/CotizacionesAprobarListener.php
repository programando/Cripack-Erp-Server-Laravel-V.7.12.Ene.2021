<?php

namespace App\Listeners\Terceros;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Mail\Terceros\CotizacionesAprobar;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Terceros\CotizacionesAprobarEvent;

class CotizacionesAprobarListener
{
    public function handle(CotizacionesAprobarEvent $event)
    { 
           Mail::to( trim($event->Email))
           ->cc( config('company.EMAIL_VENTAS') )
           ->cc( config('company.EMAIL_SERVICLIENTES') )
           ->queue(   new CotizacionesAprobar ( $event));
    }

} 