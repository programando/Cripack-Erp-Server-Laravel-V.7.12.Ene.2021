<?php

namespace App\Listeners\Terceros;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Despachos\ServiclientesSendNotifications;
use App\Events\Terceros\DespachoServiClientesSendEmailEvent;

class DespachoServiClientesSendEmailListener
{
   
    public function handle(DespachoServiClientesSendEmailEvent $event)
    {
           //       ->cc( )
           Mail::to( config('company.EMAIL_SERVICLIENTES') )
          ->queue(   new ServiclientesSendNotifications ( $event->Remisiones ));
          
    }
}
