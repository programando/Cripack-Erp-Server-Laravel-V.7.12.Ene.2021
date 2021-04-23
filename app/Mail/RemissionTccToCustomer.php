<?php

namespace App\Mail;

use config;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;

class RemissionTccToCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $Empresa  ,$Contacto, $Email, $Ots;
    public function __construct($_Empresa  ,$_Contacto, $_Email, $_Remision){
         $this->Empresa  = $_Empresa;
         $this->Contacto = $_Contacto;
         $this->Email    = $_Email;
         $this->Ots      = $_Remision;
    }

    public function build()
    {
        return $this->view('mails.RemissionTccToCustomer')
                    ->from(  config('company.EMAIL_USUARIO') )
                    ->subject('Notificacioón despacho desde Cripack') ;

    }
}
