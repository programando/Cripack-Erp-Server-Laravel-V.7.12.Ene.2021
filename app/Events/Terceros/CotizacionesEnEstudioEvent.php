<?php

namespace App\Events\Terceros;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class CotizacionesEnEstudioEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

   public $NomCliente, $Referencia, $NumCotizacion, $Email, $IdRegistroCtzDt;
    public function __construct( $CotizDt )
    {
         $this->Email           = $CotizDt[0]->email ;
         $this->IdRegistroCtzDt = $CotizDt[0]->idregistro_ctz_dt ;
         $this->NomCliente      = $CotizDt[0]->nomtercero ;
         $this->NumCotizacion   = $CotizDt[0]->numcotizacion ;
         $this->Referencia      = $CotizDt[0]->referencia ;
    }

 
}
