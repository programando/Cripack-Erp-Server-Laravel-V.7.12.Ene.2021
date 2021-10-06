<?php

namespace App\Mail\Terceros;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsersContactUs extends Mailable
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
      return $this->view('mails.terceros.Contactos')
                   ->from(  config('company.EMAIL_FROM_ADDRESS') )
                    ->subject($this->asunto) ;
    }
}
