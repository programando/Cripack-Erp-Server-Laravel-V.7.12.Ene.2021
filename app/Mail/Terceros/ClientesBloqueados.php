<?php

namespace App\Mail\Terceros;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class ClientesBloqueados extends Mailable
{
    use Queueable, SerializesModels;

    public $Empresa;
    public function __construct( $Empresa )
    {
        $this->Empresa = $Empresa;
    }

 
    public function build()
    {
        return 
            $this->view('mails.terceros.BloqueadosCartera')                    
                ->from(  config('company.EMAIL_FROM_ADDRESS') )
                ->subject('Bloqueo crédito en Cripack S.A.S.')  ;
    }
}
