<?php

namespace App\Listeners\Terceros;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Despachos\RemissionTccToCustomer;
use App\Events\Terceros\DespachoTccSendEmailEvent;

class DespachoTccSendEmailListener
{
 
    public function handle(DespachoTccSendEmailEvent $event)
    {
        //
        
      Mail::to( $event->Emails, $event->Contacto)
          ->queue(   new RemissionTccToCustomer ($event->Remision, $event->Remisiones ));
    }
}
