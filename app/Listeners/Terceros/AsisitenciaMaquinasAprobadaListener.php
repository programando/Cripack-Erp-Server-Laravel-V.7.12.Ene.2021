<?php

namespace App\Listeners\Terceros;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Terceros\AsisitenciaMaquinasAprobadaMail;
use App\Events\Terceros\AsisitenciaMaquinasAprobadaEvent;
use config;

class AsisitenciaMaquinasAprobadaListener
{
  
    public function handle(AsisitenciaMaquinasAprobadaEvent $event)
    {
     
        $Emails = explode(";", $event->EmailsClientes);

        if ( !empty(trim( $event->EmailCrprttvo )) )        array_push ($Emails, trim($event->EmailCrprttvo ) );
        
        array_push ($Emails, config('company.EMAIL_SEG_TRABAJO') );
            
         Mail::to($Emails)
        ->queue(   new AsisitenciaMaquinasAprobadaMail ($event->Cliente, $event->Servicios  ));

    }



}
