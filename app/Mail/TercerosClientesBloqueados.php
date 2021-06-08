<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TercerosClientesBloqueados extends Mailable
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
            $this->view('mails.terceros.clientes.BloqueadosCartera')                    
                ->from(  config('company.EMAIL_CARTERA') )
                ->subject('Bloqueo crédito en Cripack S.A.S.')  ;
    }
}
