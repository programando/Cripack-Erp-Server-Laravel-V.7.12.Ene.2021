<?php

namespace App\Events;

use Illuminate\Broadcasting\Channel;
use Illuminate\Broadcasting\InteractsWithSockets;
use Illuminate\Broadcasting\PresenceChannel;
use Illuminate\Broadcasting\PrivateChannel;
use Illuminate\Contracts\Broadcasting\ShouldBroadcast;
use Illuminate\Foundation\Events\Dispatchable;
use Illuminate\Queue\SerializesModels;

class OrdenesTrabajoExteriorEvent
{
    use Dispatchable, InteractsWithSockets, SerializesModels;

     public $Ots;
    public function __construct( $Ots)
    {
        $this->Ots = $Ots;
    }
 
}
