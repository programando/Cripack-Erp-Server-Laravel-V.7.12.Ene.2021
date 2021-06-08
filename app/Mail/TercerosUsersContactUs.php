<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TercerosUsersContactUs extends Mailable
{
    use Queueable, SerializesModels;

    public $contacto, $asunto, $email, $mensaje ;

    public function __construct( $contacto, $asunto , $email, $mensaje  )
    {
        $this->from     = ['address'=> $email, 'name' => $contacto];
        $this->asunto   = $asunto;
        $this->contacto = $contacto;
        $this->mensaje  = $mensaje;
        $this->email    = $email;
    }
    
    public function build()
    { 
      return $this->view('mails.terceros.usuarios.Contactos')
                   ->from(  config('company.EMAIL_SERVICLIENTES') )
                    ->subject($this->asunto) ;
    }
}
