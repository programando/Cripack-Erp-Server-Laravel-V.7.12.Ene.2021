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

    public $Empresa  ,$Contacto;
    public function __construct( $_Remision){
         $this->Empresa  = trim( $_Remision->nom_destinatario);
         $this->Contacto = trim( $_Remision->atencion) . ' ' . trim($_Remision->contacto) ;
         $this->Ots      = $_Remision;
    }

    public function build()
    {
        return $this->view('mails.RemissionTccToCustomer')
                    ->from(  config('company.EMAIL_USUARIO') )
                    ->subject('Notificación despacho desde Cripack') ;

    }

 
}
