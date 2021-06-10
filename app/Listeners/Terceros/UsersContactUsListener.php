<?php

namespace App\Listeners\Terceros;

use App\Mail\Terceros\UsersContactUs;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\Terceros\UsersContactUsEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class UsersContactUsListener
{
 
    public function handle(UsersContactUsEvent $event)
    {
       Mail::to( config('company.EMAIL_SERVICLIENTES'))
          ->queue(   new UsersContactUs ( $event->contacto, $event->asunto , $event->email, $event->mensaje ));
    }
}
