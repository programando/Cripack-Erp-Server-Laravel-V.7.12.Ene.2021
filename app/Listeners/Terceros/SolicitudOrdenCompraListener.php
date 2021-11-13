<?php

namespace App\Listeners\Terceros;

use App\Mail\Terceros\SolicitudOrdenCompra;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Terceros\SolicitudOrdenCompraEvent;

class SolicitudOrdenCompraListener
{
 
    public function handle(SolicitudOrdenCompraEvent $event)
    {
           Mail::to( $event->Emails)
          ->cc( config('company.EMAIL_AUXCONTABLE') )
          ->queue(   new SolicitudOrdenCompra ($event->Cliente, $event->OTs, $event->OT ));
    }
}

 