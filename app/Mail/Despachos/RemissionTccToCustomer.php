<?php

namespace App\Mail\Despachos;

use config;
use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;


Use Arrays; //      Helpers

class RemissionTccToCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $Empresa  ,$Contacto, $BodyTable, $TccRastreo, $TccNroGuia, $KilosReales, $Unidades;
    public function __construct( $_Remision, $Data){
         
         $this->Empresa     = trim( $_Remision->nom_destinatario);
         $this->Contacto    = trim( $_Remision->atencion) . ' ' . trim($_Remision->contacto) ;
         $this->TccRastreo  = config('company.TCC_RASTREO_GUIA' ).$_Remision->nro_rmsa_tcc;
         $this->TccNroGuia  = $_Remision->nro_rmsa_tcc;
         $this->KilosReales = $_Remision->kilos_reales;
         $this->Unidades    = $_Remision->unidades;
         $this->BodyTable   = Arrays::buildTableOtsReferenciaToEmail ( $Data , 'idregistro',$_Remision->idregistro);
    }

    public function build()
    {
        return $this->view('mails.despachos.TccRemisiones')
                    ->from(  config('company.EMAIL_FROM_ADDRESS') )
                    ->subject('Notificación despacho desde Cripack') ;
    }


 
}
