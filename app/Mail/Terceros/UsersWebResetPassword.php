<?php

namespace App\Mail\Terceros;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class UsersWebResetPassword extends Mailable
{
    use Queueable, SerializesModels;

    public $from , $Email, $Token , $urlClient ;

    public function __construct($Email, $Token )   {
         
        $this->Email     = $Email;
        $this->Token     = $Token;
        $this->from      = ['address'=> config('company.EMAIL_FROM_ADDRESS'), 'name' => config('company.EMPRESA' )];
        $this->urlClient = config('company.APP_URL_CLIENT') . config('company.URL_USER_PASSWORD_RESET').$Token;
    }
  
 
    public function build() {
        return $this->view('mails.terceros.ResetPassword')
                    ->from(  config('company.EMAIL_FROM_ADDRESS') )
                    ->subject('Cambio de contraseña') ;
    }
}
