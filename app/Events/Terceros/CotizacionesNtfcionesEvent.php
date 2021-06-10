<?php

namespace App\Events\Terceros;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CotizacionesNtfcionesEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

    public  $Ntfcion, $Cotizacion , $CotizacionDt ;
    
    public function __construct(  $Ntfcion, $Cotizacion , $CotizacionDt )
    {
         $this->Ntfcion      = $Ntfcion;
         $this->Cotizacion   = $Cotizacion;
         $this->CotizacionDt = $CotizacionDt;
    }


}
