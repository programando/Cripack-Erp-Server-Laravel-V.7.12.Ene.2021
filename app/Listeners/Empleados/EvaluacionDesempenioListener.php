<?php

namespace App\Listeners\Empleados;

use App\Events\Empleados\EvaluacionDesempenioEvent;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Support\Facades\Mail;
use App\Mail\Empleados\EvaluacionDesepenio;
class EvaluacionDesempenioListener
{
    
   
    public function handle(EvaluacionDesempenioEvent $event) {
        Mail::to( $event->email_crprttvo)
        ->queue(   new EvaluacionDesepenio ($event));  
    }

}
