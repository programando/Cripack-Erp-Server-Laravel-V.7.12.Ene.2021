<?php

namespace App\Listeners;

use App\Mail\TercerosUsersContactUs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\TercerosUsersContactUsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class TercerosUsersContactUsListener
{
 
    public function handle(TercerosUsersContactUsEvent $event)
    {
       Mail::to( config('company.EMAIL_SERVICIO_CLIENTES'))
          ->queue(   new TercerosUsersContactUs ( $event->contacto, $event->asunto , $event->email, $event->mensaje ));
    }
}
