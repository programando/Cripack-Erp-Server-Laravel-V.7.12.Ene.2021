<?php

namespace App\Listeners\Terceros;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Despachos\RemissionSendToCustomer;
use App\Events\Terceros\DespachoCustomerSendEmailEvent;

class DespachoCustomerSendEmailListener
{
 
    public function handle(DespachoCustomerSendEmailEvent $event)
    {
 
      Mail::to( $event->Emails, $event->Contacto)
          ->queue(   new RemissionSendToCustomer ($event->Remision, $event->Remisiones ));
          

    }
}
