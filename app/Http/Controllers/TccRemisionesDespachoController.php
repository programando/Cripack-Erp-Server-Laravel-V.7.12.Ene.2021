<?php

namespace App\Http\Controllers;

use config;
use Carbon\Carbon;
use Illuminate\Support\Arr;

use Illuminate\Http\Request;
use Arrays;         //  Helpers
use Fechas;         //  Helpers
use Illuminate\Support\Facades\Mail;
use App\Events\Terceros\DespachoTccSendEmailEvent;
use App\Models\TccRemisionesDespacho as RemisionesTcc;
use App\Events\Terceros\DespachoCustomerSendEmailEvent;
use App\Events\Terceros\DespachoServiClientesSendEmailEvent;


$DocumentoReferencia; $UnidadBoomerang; $ObjectToSend; $RespuestaTcc; $NumeroRemesa;
class TccRemisionesDespachoController extends Controller
{
 

    // Junio 14 2021.       Consulta fecha de entrega TCC al cliente y actualiza datos en la remision
    public function remisionesPdtesFechaEntregaTcc () {
        $RemisionesPdtes = RemisionesTcc::remisionesPdtesFechaEntregaTcc () ;
        $Guias = Arrays::getUniqueRowsFormArray ($RemisionesPdtes, 'nro_rmsa_tcc' ) ;
        foreach ( $Guias as $Guia ) {
            $FechaEntrega = $this->getFechaTccFechaEntrega ( $Guia->nro_rmsa_tcc );
            if ( $FechaEntrega  != '' && !empty ( $FechaEntrega ) ) {       
                RemisionesTcc::remisionesUpdateFechaEntregaTcc ($Guia->idremision, Fechas::getFechaTCC($FechaEntrega  ));
            }
        }
    }

    // Junio 21 201.        Consulta el estado de una guía en tcc.
    public function getFechaTccFechaEntrega ( $NroGuia) {
          try{
              $client = new \SoapClient( config('company.TCC_ESTADO_GUIA') );
              $result = $client->ConsultarEstatusRemesasListaOSB([
                  'Clave'       => 'CALCRIPACK',
                  'remesas'     => "'".$NroGuia."'",
                  'Respuesta'   =>'0',
                  'Informacion' =>'',
                  'Mensaje'     =>'',
              ]);
            $Resultado = json_decode(json_encode((array) simplexml_load_string($result->Informacion)),1);
            if ( isset( $Resultado ['remesa']['fechacumplido'] )){
                return $Resultado ['remesa']['fechacumplido'];
          }else{
            return '';
          }
          }
          catch(Exception $e){
              echo $e->getMessage();
          }
    }

    
    public function sendCustomerNotification() {
        $Remisiones = RemisionesTcc::sendCustomerNotification() ;
        $Ids        = array_unique( Arr::pluck($Remisiones ,'idregistro' ) );
        foreach( $Ids as $Row) {  
                foreach ($Remisiones as $Remision) {
                   if (  $Remision->idregistro == $Row) {
                     $Emails = Arrays::getEmailsFromArray($Remisiones ,'idregistro',$Row );     
                     $this->sendEmailWithRemissions ( $Emails,$Remision, $Remisiones );
                     $this->remisionesTccUpdateEmailEnviado ($Row );
                     break;
                 }
            } //foreach $Remisiones  
        } //foreach $Ids
         
        $this->sendNotificationServicioAlCliente (  $Remisiones);
    }

    private function sendNotificationServicioAlCliente ( $Remisiones ) {
       DespachoServiClientesSendEmailEvent::dispatch( $Remisiones );
    }

    private function sendEmailWithRemissions ( $Emails, $Remision, $Remisiones ) {
         array_push ($Emails, config('company.EMAIL_PRODUCCION'));
         if ( $Remision->idtercero_transportador === 856 )  { 
           DespachoTccSendEmailEvent::dispatch ($Emails, $Remision->contacto ,  $Remision, $Remisiones );
         }else {
           DespachoCustomerSendEmailEvent::dispatch ($Emails, $Remision->contacto ,  $Remision, $Remisiones );
         }
    }

    

    private function remisionesTccUpdateEmailEnviado ( $IdRegistro ) {
        $ModelRemisionesTcc = RemisionesTcc::where('idregistro', $IdRegistro)->first();
        $ModelRemisionesTcc->email_enviado = 1;
        $ModelRemisionesTcc->fecha_enviado = Carbon::now();

        $ModelRemisionesTcc->save();
    }

 


    public function getDocsToIntegration () {
        $Remisiones = RemisionesTcc::getDocsToIntegration() ;
        foreach ($Remisiones as $Remision) {
            $CodBarra           = 'CRIP'.intval( time());
            $this->buildDocumentReference    (  $Remision   );
            $this->buildBoomerangUnit        (  $Remision ,$CodBarra );
            $this->buildObjectToSend         ( $Remision );
            $this->documentSendToTcc         (  ) ;
            $this->assingNroRemesaToRemision ( $Remision->idregistro, $CodBarra );
        }
        print_r ( "Integración de remisiones con TCC ha finalizado!"."\n");
    }

    private function buildDocumentReference (  $Remisiones ) {
          $this->DocumentoReferencia = array(
                  array('tipodocumento'     => $Remisiones->tipo_documento,
                        'numerodocumento'   => $Remisiones->num_documento,
                        'fechadocumento'    => $Remisiones->fecha_documento
                    )
                );
           
    }

    private function buildBoomerangUnit( &$Remisiones, $CodBarra){
            $ClaseEmpaque = '';
            $TipoUnidad  = 'TIPO_UND_PAQ';
            if ( $Remisiones->docs_devolver > 0 ) {
                 $ClaseEmpaque                = 'TIPO_UND_DOCB';
                 $TipoUnidad                 = 'TIPO_UND_PAQ';
                 $Remisiones->kilos_reales    = 0;
                 $Remisiones->kilos_volumen   = 0;
                 $Remisiones->valor_mercancia = 0;
            }
            $this->UnidadBoomerang = array(
                  array(
                        'tipounidad'       => $TipoUnidad,
                        'claseempaque'     => $ClaseEmpaque,
                        'dicecontener'     => $Remisiones->observacion_Tcc,
                        'cantidadunidades' => '1',
                        'kilosreales'      => $Remisiones->kilos_reales,
                        'pesovolumen'      => $Remisiones->kilos_volumen,
                        'valormercancia'   => $Remisiones->valor_mercancia,
                        'codigobarras'     => $CodBarra
                  )
                );
                
    }

    private function buildObjectToSend ( $Remisiones ) {
        $this->ObjectToSend = array(
                'objDespacho' => array(
                      'clave'                          => config('company.TCC_SOAP_PASSWORD'),
                      'fechahoralote'                  => '',
                      'numeroremesa'                   => '',
                      'numeroDepacho'                  => '',
                      'unidadnegocio'                  => '1',
                      'fechadespacho'                  => $Remisiones->fecha_ws,
                      'cuentaremitente'                => config('company.TCC_SOAP_CUENTA'),
                      'sederemitente'                  => '',
                      'primernombreremitente'          => '',
                      'segundonombreremitente'         => '',
                      'primerapellidoremitente'        => '',
                      'segundoapellidoremitente'       => '',
                      'razonsocialremitente'           => config('company.EMPRESA'),
                      'naturalezaremitente'            => 'J',
                      'tipoidentificacionremitente'    => 'NIT',
                      'identificacionremitente'        => config('company.NIT'),
                      'telefonoremitente'              => config('company.TELEFONO'),
                      'direccionremitente'             => config('company.DIRECCION'),
                      'ciudadorigen'                   => '76001000',
                      'tipoidentificaciondestinatario' => '',
                      'identificaciondestinatario'     => '',
                      'sededestinatario'               => '',
                      'primernombredestinatario'       => '',
                      'segundonombredestinatario'      => '',
                      'primerapellidodestinatario'     => '',
                      'segundoapellidodestinatario'    => '',
                      'razonsocialdestinatario'        => $Remisiones->nom_destinatario_Tcc,
                      'naturalezadestinatario'         => 'N',
                      'direcciondestinatario'          => $Remisiones->dir_destinatario_Tcc,
                      'telefonodestinatario'           => $Remisiones->tel_destinatario,
                      'ciudaddestinatario'             => $Remisiones->cod_ciudad_destino,
                      'barriodestinatario'             => '',
                      'totalpeso'                      => '',
                      'totalpesovolumen'               => '',
                      'formapago'                      => '',
                      'observaciones'                  => $Remisiones->observacion_Tcc,
                      'llevabodega'                    => '',
                      'recogebodega'                   => $Remisiones->reclama_en_bodega,
                      'centrocostos'                   => '',
                      'totalvalorproducto'             => '',
                      'unidad'                         => $this->UnidadBoomerang,
                      'documentoreferencia'            => $this->DocumentoReferencia,
                      'generarDocumentos'              => true
              ),'respuesta'      => 0,
              'remesa'           => '',
              'URLRelacionEnvio' => '',
              'URLRotulos'       => '',
              'URLRemesa'        => '',
              'IMGRelacionEnvio' => null,
              'IMGRotulos'       => null,
              'IMGRemesa'        => null,
              'respuesta'        => 0,
              'mensaje'          => ''
          );

    }

    private function documentSendToTcc () {
          
          $client                             = new \SoapClient( config('company.TCC_SOAP_ENDPOINT' ));
          $remesa                             = new \StdClass;
          $remesa->remesa                     = '';
          $URLRelacionEnvio                   = new \StdClass;
          $URLRelacionEnvio->URLRelacionEnvio ='';
          $URLRotulos                         = new \StdClass;
          $URLRotulos->URLRotulos             ='';
          $URLRemesa                          = new \StdClass;
          $URLRemesa->URLRemesa               ='';
          $IMGRelacionEnvio                   = new \StdClass;
          $IMGRelacionEnvio->IMGRelacionEnvio = null;
          $IMGRotulos                         = new \StdClass;
          $IMGRotulos->IMGRotulos             =null;
          $IMGRemesa                          = new \StdClass;
          $IMGRemesa->IMGRemesa               =null;
          $respuesta                          = new \StdClass;
          $respuesta->respuesta               = 0;
          $mensaje                            = new \StdClass;
          $mensaje->mensaje                   = '';
        
          //print_r ( $client->__getFunctions() );
          //print_r ( $client->__getTypes() ); 

         
            
         try {
            //Despues de realizar la configuración del xml a enviar, se realiza el consumo del servicio web
            $resp = $client->GrabarDespacho4($this->ObjectToSend, $remesa,$URLRelacionEnvio,$URLRotulos,$URLRemesa,$IMGRelacionEnvio,$IMGRotulos,$IMGRemesa,$respuesta,$mensaje);
            //Aqui se hace el manejo de la excepción del consumo
            echo $client->__getLastRequest() ."\n";
          }catch(Exception $e){
            echo 'Excepción capturada: ',  $e->getMessage() , '<br>';
          }
          $this->RespuestaTcc='';
          $this->NumeroRemesa = intval($resp->remesa);
          if ( $this->NumeroRemesa > 0 ){
                $this->RespuestaTcc = substr( $resp->mensaje,0,45);
          };
        
        //print_r ( $NumeroRemesa );
        print_r ( $resp->mensaje ."\n");

    }
    //$idregistro ,$respuesta ,$nro_rmsa_tcc, $codbarra
    private function assingNroRemesaToRemision ( $IdRegistro, $CodBarra) {
        RemisionesTcc::assingNroRemesaToRemision( $IdRegistro, $this->RespuestaTcc, $this->NumeroRemesa,$CodBarra );
    }
     
}
