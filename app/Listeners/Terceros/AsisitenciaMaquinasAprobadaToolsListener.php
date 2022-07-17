<?php

namespace App\Listeners\Terceros;

use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\Mail\Terceros\AsisitenciaMaquinasAprobadaToolsMail;
use App\Events\Terceros\AsisitenciaMaquinasAprobadaToolsEvent;

class AsisitenciaMaquinasAprobadaToolsListener
{
    
    public function handle(AsisitenciaMaquinasAprobadaToolsEvent $event)
    {
       $ccEmails = array();
       array_push ($ccEmails, config('company.EMAIL_VENTAS')) ;
       array_push ($ccEmails, config('company.EMAIL_SERVICLIENTES')) ;
       if ( !empty(trim( $event->EmailCrprttvo )) )        array_push ($ccEmails, trim($event->EmailCrprttvo ) );
 
            
         Mail::to(config('company.EMAIL_ALMACEN') )  
                ->cc( $ccEmails  )
                ->queue(   new AsisitenciaMaquinasAprobadaToolsMail ($event->Cliente, $event->Servicios  ));
 
    }
}
