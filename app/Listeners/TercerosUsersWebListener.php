<?php

namespace App\Listeners;

use App\Events\TercerosUsersWebEvent;
use App\Mail\TercerosUsersWebResetPassword;

use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;

class TercerosUsersWebListener
{
    public function handle(TercerosUsersWebEvent $event)    {
         Mail::to( 'jhonjamesmg@hotmail.com')
            ->queue(   new TercerosUsersWebResetPassword (  $event->Email, $event->Token  ));
    }
}
