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
        'App\Events\TercerosUsersWebEvent'              => [ 'App\Listeners\TercerosUsersWebListener',           ],
        'App\Events\TercerosClientesBloqueadosEvent'    => [ 'App\Listeners\TercerosClientesBloqueadosListener', ],         // Correo semanal. clientes bloqueados
        'App\Events\Terceros\ClientesBloqueadosOtsEvent'=> [ 'App\Listeners\Terceros\ClientesBloqueadosOtsListener', ],   // Correo diario. Clientes bloqueados
        'App\Events\TercerosUsersContactUsEvent'        => [ 'App\Listeners\TercerosUsersContactUsListener',     ],
        'App\Events\OrdenesTrabajoExteriorEvent'        => [ 'App\Listeners\OrdenesTrabajoExteriorListener',     ]
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
