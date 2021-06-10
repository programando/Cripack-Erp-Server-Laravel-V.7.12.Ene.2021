<?php

namespace App\Listeners\Terceros;

use App\Events\Terceros\UsersWebEvent;
use App\Mail\Terceros\UsersWebResetPassword;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class UsersWebListener
{
    public function handle(UsersWebEvent $event)    {
         Mail::to( $event->Email)
            ->queue(   new  UsersWebResetPassword (  $event->Email, $event->Token  ));
    }
}
