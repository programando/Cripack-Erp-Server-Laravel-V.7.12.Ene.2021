<?php

namespace App\Listeners;

use Illuminate\Support\Facades\Mail;
use App\Mail\TercerosClientesBloqueados;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Events\TercerosClientesBloqueadosEvent;

class TercerosClientesBloqueadosListener
{
   
    public function handle(TercerosClientesBloqueadosEvent $event)
    {
         Mail::to( $event->Emails)
          ->queue(   new TercerosClientesBloqueados ($event->Empresa ));
    }
}
