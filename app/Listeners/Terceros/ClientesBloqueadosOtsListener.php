<?php

namespace App\Listeners\Terceros;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Terceros\ClientesBloqueadosOts;
use App\Events\Terceros\ClientesBloqueadosOtsEvent;

class ClientesBloqueadosOtsListener
{
   
    public function handle(ClientesBloqueadosOtsEvent $event)
    {
 
        Mail::to( $event->Emails)
          ->cc( config('company.EMAIL_CARTERA') )
          ->queue(   new ClientesBloqueadosOts ($event->Cliente, $event->OTs, $event->OT ));
    }
}
