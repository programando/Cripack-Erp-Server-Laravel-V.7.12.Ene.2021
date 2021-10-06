<?php

namespace App\Mail\Terceros;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;

class CotizacionesEnEstudio extends Mailable
{
    use Queueable, SerializesModels;

     public $NomCliente, $Referencia, $NumCotizacion, $Email, $IdRegistroCtzDt;
    public function __construct( $CotizDt)
    {
    
         $this->Email           = $CotizDt->Email ;
         $this->IdRegistroCtzDt = $CotizDt->IdRegistroCtzDt ;
         $this->NomCliente      = $CotizDt->NomCliente ;
         $this->NumCotizacion   = $CotizDt->NumCotizacion ;
         $this->Referencia      = trim($CotizDt->Referencia) ;
    }

   
    
    public function build()  {
                    $this->view('mails.terceros.CotizacionesEnEstudio')                    
                 ->from(  config('company.EMAIL_FROM_ADDRESS') )
                 ->subject('Cotiz. en estudio : ' . $this->Referencia  )  ; 
    }
}
