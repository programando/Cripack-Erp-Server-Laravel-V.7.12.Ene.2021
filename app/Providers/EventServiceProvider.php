<?php

namespace App\Providers;

use Illuminate\Auth\Events\Registered;
use Illuminate\Auth\Listeners\SendEmailVerificationNotification;
use Illuminate\Foundation\Support\Providers\EventServiceProvider as ServiceProvider;
use Illuminate\Support\Facades\Event;

class EventServiceProvider extends ServiceProvider
{
    /**
     * The event listener mappings for the application.
     *
     * @var array
     */
    protected $listen = [
        Registered::class => [
            SendEmailVerificationNotification::class,
        ],
        'App\Events\OrdenesTrabajoExteriorEvent'                    => [ 'App\Listeners\OrdenesTrabajoExteriorListener',                        ],
        'App\Events\Terceros\ClientesBloqueadosEvent'               => [ 'App\Listeners\Terceros\ClientesBloqueadosListener',                   ],   // Correo semanal. clientes bloqueados
        'App\Events\Terceros\ClientesBloqueadosOtsEvent'            => [ 'App\Listeners\Terceros\ClientesBloqueadosOtsListener',                ],   // Correo diario. Clientes bloqueados
        'App\Events\Terceros\CotizacionesAprobarEvent'              => [ 'App\Listeners\Terceros\CotizacionesAprobarListener',                  ],   // Aprobar cotizaciones
        'App\Events\Terceros\CotizacionesEnEstudioEvent'            => [ 'App\Listeners\Terceros\CotizacionesEnEstudioListener',                ],   // Cotizaciones en estudio
        'App\Events\Terceros\CotizacionesNtfcionesEvent'            => [ 'App\Listeners\Terceros\CotizacionesNtfcionesListener',                ],   // Notif.seguimiento de cotizaciones
        'App\Events\Terceros\DespachoTccSendEmailEvent'             => [ 'App\Listeners\Terceros\DespachoTccSendEmailListener',                 ],   // Envío notificaciones despachos TCC
        'App\Events\Terceros\DespachoCustomerSendEmailEvent'        => [ 'App\Listeners\Terceros\DespachoCustomerSendEmailListener',            ],   // Envío notificaciones despachos Clientes
        'App\Events\Terceros\DespachoServiClientesSendEmailEvent'   => [ 'App\Listeners\Terceros\DespachoServiClientesSendEmailListener',       ],   // Envío notificaciones despachos Servicio al cliente
        'App\Events\Terceros\SolicitudOrdenCompraEvent'             => [ 'App\Listeners\Terceros\SolicitudOrdenCompraListener',                 ],   // Cotizaciones en estudio
        'App\Events\Terceros\UsersContactUsEvent'                   => [ 'App\Listeners\Terceros\UsersContactUsListener',                       ],
        'App\Events\Terceros\UsersWebEvent'                         => [ 'App\Listeners\Terceros\UsersWebListener',                             ],
    ];

    /**
     * Register any events for your application.
     *
     * @return void
     */
    public function boot()
    {
        parent::boot();

        //
    }
}
