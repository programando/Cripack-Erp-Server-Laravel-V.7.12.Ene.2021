<?php

namespace App\Listeners\Terceros;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Terceros\CotizacionesEnEstudio;
use App\Events\Terceros\CotizacionesEnEstudioEvent;

class CotizacionesEnEstudioListener
{
   

        public function handle(CotizacionesEnEstudioEvent $event)
    {
 
           Mail::to( config('company.EMAIL_VENTAS') )
           ->cc( config('company.EMAIL_SERVICLIENTES') )
           ->queue(   new CotizacionesEnEstudio ( $event));
    }
 

}
