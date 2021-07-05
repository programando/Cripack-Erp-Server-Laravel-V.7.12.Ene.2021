<?php

namespace App\Mail\Despachos;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
Use Arrays;

class RemissionSendToCustomer extends Mailable
{
    use Queueable, SerializesModels;

    public $Empresa  ,$Contacto, $BodyTable, $Transportador, $TccNroGuia, $KilosReales, $Unidades;
    public function __construct( $_Remision, $Data){
         
         $this->Empresa       = trim( $_Remision->nom_destinatario);
         $this->Contacto      = trim( $_Remision->atencion) . ' ' . trim($_Remision->contacto) ;
         $this->Transportador = $_Remision->nomtransportador;
         $this->TccNroGuia    = $_Remision->nro_rmsa_tcc;
         $this->KilosReales   = $_Remision->kilos_reales;
         $this->Unidades      = $_Remision->unidades;
         $this->BodyTable     = Arrays::buildTableOtsReferenciaToEmail ( $Data , 'idregistro',$_Remision->idregistro);
    }

    public function build()
    {
        return $this->view('mails.despachos.OtrasRemisiones')
                    ->from(  config('company.EMAIL_USUARIO') )
                    ->subject('Notificación despacho desde Cripack') ;
    }

}
