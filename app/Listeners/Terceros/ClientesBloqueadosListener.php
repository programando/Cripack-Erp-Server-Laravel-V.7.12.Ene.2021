<?php

namespace App\Listeners\Terceros;

use Illuminate\Support\Facades\Mail;
use App\Mail\Terceros\ClientesBloqueados;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\Terceros\ClientesBloqueadosEvent;

class ClientesBloqueadosListener
{
   
    public function handle(ClientesBloqueadosEvent $event)
    {
         Mail::to( $event->Emails)
          ->cc( config('company.EMAIL_CARTERA') )
          ->queue(   new ClientesBloqueados ($event->Empresa ));
    }
}
