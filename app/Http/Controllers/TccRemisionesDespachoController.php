<?php

namespace App\Http\Controllers;
use config;
use Illuminate\Support\Arr;
use Illuminate\Http\Request;
use App\Mail\RemissionTccToCustomer;
use Illuminate\Support\Facades\Mail;
use App\Models\TccRemisionesDespacho as RemisionesTcc;


$DocumentoReferencia; $UnidadBoomerang; $ObjectToSend; $RespuestaTcc; $NumeroRemesa;
class TccRemisionesDespachoController extends Controller
{
    public function sendCustomerNotification() {
        $Remisiones = RemisionesTcc::sendCustomerNotification() ;
        $Ids        = array_unique( Arr::pluck($Remisiones ,'idregistro' ) );
        foreach( $Ids as $Row) {  
                foreach ($Remisiones as $Remision) {
                   if (  $Remision->idregistro == $Row) {
                     $Emails    = $this->getEmails( $Remisiones, $Row);  
                     Mail::to( $Emails, trim($Remision->contacto) )->send( new RemissionTccToCustomer( $Remision, $Remisiones ));
                     $this->remisionesTccUpdateEmalEnviado ($Row );
                     break;
                 }
            } //foreach $Remisiones  
            echo $Row ."\n";
        } //foreach $Ids
    }

    private function remisionesTccUpdateEmalEnviado ( $IdRegistro ) {
        $ModelRemisionesTcc = RemisionesTcc::where('idregistro', $IdRegistro)->first();
        $ModelRemisionesTcc->email_enviado = 1;
        $ModelRemisionesTcc->save();
    }

    private function getEmails ( $Remisiones, $IdRegistro ){
           $Emails = [];
            foreach ($Remisiones as $Remision) {
                if (  $Remision->idregistro == $IdRegistro) {
                   array_push ($Emails, $Remision->email );
            }
        } //foreach 
        array_push ($Emails, config('company.EMAIL_SERVICIO_CLIENTES'));
        array_push ($Emails, 'jhonjamesmg@hotmail.com');
        return  array_values( array_unique($Emails));
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
