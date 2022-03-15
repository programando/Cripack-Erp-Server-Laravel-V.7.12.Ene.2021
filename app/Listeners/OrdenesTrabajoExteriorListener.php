<?php

namespace App\Listeners;

use App\Mail\OrdenesTrabajoExterior;
use Illuminate\Support\Facades\Mail;
use Illuminate\Queue\InteractsWithQueue;
use App\Events\OrdenesTrabajoExteriorEvent;
use Illuminate\Contracts\Queue\ShouldQueue;

class OrdenesTrabajoExteriorListener
{
     
    public function handle(OrdenesTrabajoExteriorEvent $event)
    {
        Mail::to(config('company.EMAIL_ALMACEN'))
            ->cc(config('company.EMAIL_PRODUCCION') )
            ->cc(config('company.EMAIL_AUXCONTABLE'))
            ->cc(config('company.EMAIL_GERENCIA'))
            ->cc(config('company.EMAIL_PRODUCCION'))
            ->cc(config('company.EMAIL_SERVICLIENTES'))
            ->cc(config('company.EMAIL_SOPORTE'))
          ->queue(   new OrdenesTrabajoExterior ( $event->Ots ));
    }
}
