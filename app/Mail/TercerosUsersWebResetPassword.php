<?php

namespace App\Mail;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class TercerosUsersWebResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $from , $Email, $Token , $urlClient ;

    public function __construct($Email, $Token )   {
         
        $this->Email     = $Email;
        $this->Token     = $Token;
        $this->from      = ['address'=> config('company.EMAIL_SERVICLIENTES'), 'name' => config('company.EMPRESA' )];
        $this->urlClient = config('company.APP_URL_CLIENT') . config('company.URL_USER_PASSWORD_RESET').$Token;
    }
  
 
    public function build() {
        return $this->view('mails.terceros.usuarios.ResetPassword')
                    ->from(  config('company.EMAIL_SERVICLIENTES') )
                    ->subject('Cambio de contraseña') ;
    }
}
