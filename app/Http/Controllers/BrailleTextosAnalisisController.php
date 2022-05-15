<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrailleTextosAnalisi as Braile;

use App\Helpers\Strings;

class BrailleTextosAnalisisController extends Controller
{
    private $Estandar = array(), $Minimo = array(), $Caracteres = array();
    private $Simbolos, $imgBraile_1, $imgBraile_2, $SimboloExcepcion;

     public function transcripcionTextos ( Request $FormData ) {

          $idtercero = $FormData->idTercero;
          $texto     =  Strings::FixAccents (strtoupper(trim($FormData->texto)));

          $largo     = (int)$FormData->largo;
          $alto      = (int)$FormData->alto;
          $ancho     = (int)$FormData->ancho; 
    
          $this->setParameters ();
          $this->reservarSimbolos () ;
          Braile::deleteTranscriptedTexts (  $idtercero );
          $this->saveText (  $idtercero, $texto , $largo, $ancho, $alto );
          $this->distibuirImpresionTextos ( $idtercero) ;
          $result = $this->showTranscription ( $idtercero, $texto  );

         return $result;
     }


      public function saveText( $idtercero, $texto , $caja_largo, $caja_ancho, $caja_alto ) {          
            //, $max_cara, $max_filas
             $caracteres = strlen ( $texto );
             $espacios   = substr_count ($texto, ' ' );
             $palabras   = $espacios + 1;
             //-----------------------------------------------------------------------------
             //Alto - Largo (Opción # 1)
             //-----------------------------------------------------------------------------
             $op1nfe     = $this->NFE ( $caja_alto );
             $op1nfm     = $this->NFM ( $caja_alto );
             $op1nc      = $this->NC  ( $caja_largo );
             $op1mce     = $op1nfe  * $op1nc ;
             $op1mcm     = $op1nfm  * $op1nc ;
             $op1fmax    = $this->Fmax ( $op1nc, $caracteres );
             $op1fdef    = ceil ( $op1fmax );
             $op1ncare   = $this->NcarE ( $caracteres, $op1mce ) ;
             $op1ncarm   = $this->NCarM ( $caracteres , $op1mcm);
             //-----------------------------------------------------------------------------
             //Alto - Ancho (Opción # 2)
             //-----------------------------------------------------------------------------            
             $op2nfe     = $this->NFE ( $caja_alto );
             $op2nfm     = $this->NFM ( $caja_alto );
             $op2nc      = $this->NC  ( $caja_ancho );
             $op2mce     = $op2nfe  * $op2nc ;
             $op2mcm     = $op2nfm  * $op2nc ;
             $op2fmax    = $this->Fmax ( $op2nc, $caracteres );
             $op2fdef    = ceil ( $op2fmax );
             $op2ncare   = $this->NcarE ( $caracteres, $op2mce ) ;
             $op2ncarm   = $this->NCarM ( $caracteres , $op2mcm);
             //-----------------------------------------------------------------------------
             //-----------------------------------------------------------------------------
             //Largo - Alto (Opción # 3)
             //-----------------------------------------------------------------------------            
             $op3nfe     = $this->NFE ( $caja_largo );
             $op3nfm     = $this->NFM ( $caja_largo  );            
             $op3nc      = $this->NC  ( $caja_alto );
             $op3mce     = $op3nfe  * $op3nc ;
             $op3mcm     = $op3nfm  * $op3nc ;
             $op3fmax    = $this->Fmax ( $op3nc, $caracteres );
             $op3fdef    = ceil ( $op3fmax );
             $op3ncare   = $this->NcarE ( $caracteres, $op3mce ) ;
             $op3ncarm   = $this->NCarM ( $caracteres , $op3mcm);
             //-----------------------------------------------------------------------------             

             //-----------------------------------------------------------------------------
             //Ancho - Alto (Opción # 4)
             //-----------------------------------------------------------------------------            
             $op4nfe     = $this->NFE ( $caja_ancho );
             $op4nfm     = $this->NFM ( $caja_ancho );
             $op4nc      = $this->NC  ( $caja_alto );
             $op4mce     = $op4nfe  * $op4nc ;
             $op4mcm     = $op4nfm  * $op4nc ;
             $op4fmax    = $this->Fmax ( $op4nc, $caracteres );
             $op4fdef    = ceil ( $op4fmax );
             $op4ncare   = $this->NcarE ( $caracteres, $op4mce ) ;
             $op4ncarm   = $this->NCarM ( $caracteres , $op4mcm);
             //-----------------------------------------------------------------------------   
             
             Braile::textSave( $idtercero, $texto, $caja_largo, $caja_ancho, $caja_alto, $caracteres, $espacios, $palabras, $op1nfe, $op1nfm , $op1nc, $op1mce, $op1mcm, $op1fmax,$op1fdef,      $op1ncare, $op1ncarm,  $op2nfe, $op2nfm , $op2nc, $op2mce, $op2mcm, $op2fmax,$op2fdef, $op2ncare, $op2ncarm,   $op3nfe, $op3nfm , $op3nc, $op3mce, $op3mcm, $op3fmax,$op3fdef, $op3ncare, $op3ncarm, $op4nfe, $op4nfm , $op4nc, $op4mce, $op4mcm, $op4fmax,$op4fdef, $op4ncare, $op4ncarm, $op3nc, $op3nfm  );
      }

    private function distibuirImpresionTextos ( $IdTercero )     {
        $Textos = Braile::getTextsToAnalysis ( $IdTercero );
       
         foreach ($Textos  as $Texto ) {
            $Filas = $this->distribuirPalabra ( $Texto->texto, $Texto->max_cara );  
            $this->grabarCaras ($IdTercero,$Texto->texto, $Filas , $Texto->max_cara , $Texto->max_filas );
        }
    }


 private function distribuirPalabra ( $Frase, $MaxCara  ) {
        $Frase         = explode( ' ', $Frase );
        $LongAcumulada = 0;
        $Fila          = '';
        $Filas         = array();  
        while ( count ( $Frase ) ) {  
            $Palabra     =   $Frase[0]  ;
            $LongPalabra = strlen ( $Palabra ) + $LongAcumulada;
  
            if ( strlen ( $Palabra ) > $MaxCara  ){
                $Filas[]       = $Fila;
                $Filas[]       = 'N/A-' .$Palabra ;
                $Frase         = $this->depurarArray( $Frase );
                $Fila          = '';
                $LongAcumulada = 0;
            }
            else{
                if ($LongPalabra <= $MaxCara ){
                    $Fila          = $Fila . $Palabra . ' ';
                    $LongAcumulada = strlen ( $Fila );
                    $Frase  = $this->depurarArray( $Frase );
                }else {                    
                    $Filas[]       = $Fila;
                    $Fila          = '';
                    $LongAcumulada = 0;                 
                }
            }
            
        } // EndWhile
        $Filas[]=$Fila;
        return $Filas;
    }

        private function depurarArray( &$datos  ){
        unset($datos[0] );
        return array_values ( $datos  );
    }


    private function grabarCaras ($idtercero, $texto,    $Filas , $MaxCara=5, $MaxFilas=8) {  
        $FilasOcupadas = 1;
         $texto = trim( $texto); 

        foreach ($Filas as $Fila ) {
            $palabrasAtraducir = strtolower( $Fila);
            $palabraError      = substr( $palabrasAtraducir,0,4)== 'n/a-' ? 1 : 0;
            $palabrasAtraducir = $palabraError == 1 ? substr( $palabrasAtraducir,4,strlen($palabrasAtraducir )) : $palabrasAtraducir;
            $Long              = strlen( trim($palabrasAtraducir) ) ;

            if ( (int)$Long > 0 ) {
                if ( $FilasOcupadas <= $MaxFilas ) {
                        $FilasOcupadas=  $FilasOcupadas  + 1;
                        $id_impresion  = Braile::textSavePrinter ($idtercero, $texto, $MaxCara, $MaxFilas, $palabrasAtraducir, $Long, 0, 0, $palabraError, '1');
                        $this->grabarSimbolosBraile ( $idtercero, $id_impresion[0]->id_impresion, $palabrasAtraducir );
                    }else {
                        $FilasOcupadas  =  $FilasOcupadas  + 1;
                        $id_impresion  = Braile::textSavePrinter ($idtercero, $texto, $MaxCara, $MaxFilas, 0, 0, $palabrasAtraducir, $Long, $palabraError,'2');
                        $this->grabarSimbolosBraile ($idtercero, $id_impresion[0]->id_impresion , $palabrasAtraducir );
                }
            };
        }
       
    }


    private function grabarSimbolosBraile ($idtercero, $id_impresion, $Palabra  ) {
         $Palabra            = trim( $Palabra  );
         $excepciones        = array ('$','%','{','}','€', '\\');
         $numeros            = array ('1','2','3','4','5','6','7','8','9','0');
         $Letras             = preg_split('//',$Palabra ,-1, PREG_SPLIT_NO_EMPTY)  ;  /// Separa cada palabra en letras para encontrar su simbolo braile 
         $complementoSimbolo = 0;
         $complementoNumero  = true;
         foreach ( $Letras as $Letra) {
             $letraToSave = strtolower( $Letra);
             $this->buscarSimbolo ( $letraToSave ) ;  
             if ( $this->imgBraile_1 == 'espacio.png' ){
                  $complementoNumero = true;    
             }
             // es numero y es el primero de la lista
             if ( in_array( $letraToSave, $numeros ) && $complementoNumero == true  ) {
                 $this->imgBraile_2 = $this->imgBraile_1 ;
                 $this->imgBraile_1 = 'numeral.png';
                 $complementoNumero = false;
             }
             if ( $complementoSimbolo > 0 && !in_array( $letraToSave,$excepciones ) && $complementoNumero == true )  {
                     $this->imgBraile_2=''; 
             }     
             Braile::saveSimbols ( $idtercero, $id_impresion, $letraToSave, $this->imgBraile_1, $this->imgBraile_2) ;
            if ( strlen($this->imgBraile_2) > 0  )     $complementoSimbolo++;
         }
    }


     private function showTranscription ( $IdTercero, $Texto ) {
            $jsonResponse  = [];  $ArrayPalabra;
            $ParabrasCara1 = Braile::palabrasPorCara( $IdTercero, "1", $Texto);
            $ParabrasCara2 = Braile::palabrasPorCara( $IdTercero, "2", $Texto);
            $this->addDataToArray ($ParabrasCara1 , $jsonResponse,'1' );
            $this->addDataToArray ($ParabrasCara2 , $jsonResponse,'2' );
             return   $jsonResponse  ;
     }

        private function addDataToArray ( $PalabrasPorCara, &$jsonResponse, $nro_cara){
                $ImagesPath    = str_replace('\\', '/', asset('/storage/images/braile\\/') ) ;
                foreach ($PalabrasPorCara as $Palabra => $value ) {     
                    $simbolosPalabra = Braile::simbolosPorPalabra ( $value->id_impresion, $ImagesPath  );
                    array_push ($jsonResponse  ,  [
                                   'cara'       => 'cara'."$nro_cara",
                            'cara'."$nro_cara"  => $value->cara,
                                   'idregistro' => $value->id_impresion,
                                   'MC'         => $value->MC,
                                   'MF'         => $value->max_filas,
                                   'simbolos'   => $simbolosPalabra
                        ]);
                }
        }
   

      private function buscarSimbolo ( $caraterBusqueda ) {
           $this->imgBraile_1 ='';
           $this->imgBraile_2 = '';
           $this->SimboloExcepcion = false;
           $this->caracterEsEspacio         ( $caraterBusqueda  );
           $this->caracterEsSignoPesos      ( $caraterBusqueda  );
           $this->caracterEsPorcentaje      ( $caraterBusqueda  );   
           $this->caracterEsLlaveApertura   ( $caraterBusqueda  );  //      "{"
           $this->caracterEsLlaveCierre     ( $caraterBusqueda  );  //      "}"
           $this->caracterEsBackSlash       ( $caraterBusqueda  );  //      "\"
           $this->caracterEsSignoEuros      ( $caraterBusqueda  );  //      "€"

           if ( $this->SimboloExcepcion == true ) return ;

            foreach($this->Simbolos as $keyInt=>$arrayInterno){
                foreach($arrayInterno as $keyInte=>$valor){
                    if ( $valor === $caraterBusqueda )  {
                          $this->imgBraile_1 = $arrayInterno['imagen'] ;
                          $this->imgBraile_2 = $arrayInterno['imagen_2'] ;
                          return ;
                      }
                }
            }
      }



  private function caracterEsEspacio ( $caraterBusqueda ) {
        if ( $caraterBusqueda === ' ') {
            $this->imgBraile_1 = 'espacio.png';
            $this->SimboloExcepcion = true;
        }
    }

    private function caracterEsSignoPesos ( $caraterBusqueda ) {
        if ( $caraterBusqueda == '$') {
            $this->imgBraile_1 = 'moneda1.png';
            $this->imgBraile_2 = 'moneda2.png';
            $this->SimboloExcepcion = true;
        }
    }

    private function caracterEsPorcentaje ( $caraterBusqueda ) {
        if ( $caraterBusqueda == '%') {
            $this->imgBraile_1 = 'porcentaje1.png';
            $this->imgBraile_2 = 'porcentaje2.png';
            $this->SimboloExcepcion = true;
        }
    }

    private function caracterEsLlaveApertura ( $caraterBusqueda ) {
        if ( $caraterBusqueda == '{') {
            $this->imgBraile_1 = 'Sim044.jpg';
            $this->imgBraile_2 = 'Sim047.jpg';
            $this->SimboloExcepcion = true;
        }
    }

    private function caracterEsLlaveCierre ( $caraterBusqueda ) {
        if ( $caraterBusqueda == '{') {
            $this->imgBraile_1 = 'corcheteIzq1.png';
            $this->imgBraile_2 = 'corcheteIzq2.png';
            $this->SimboloExcepcion = true;
        }
    }

    private function caracterEsBackSlash ( $caraterBusqueda ) {
        if ( $caraterBusqueda == '\\') {
            $this->imgBraile_1 = 'barra invertida1';
            $this->imgBraile_2 = 'barra invertida 2.png';
            $this->$this->$SimboloExcepcion = true;
        }
    }

   private function caracterEsSignoEuros ( $caraterBusqueda ) {
        if ( $caraterBusqueda == '€') {
            $this->imgBraile_1 = 'euro1.png';
            $this->imgBraile_2 = 'euro1.png';
            $this->$this->$SimboloExcepcion = true;
        }
    }



  private function NcarE ( $Long, $Mce ) {
          if ( $Mce === 0 ) return 0;
          $NcarE    = $Long/$Mce;
          $NcarEInt = (int)$NcarE; 
           if ( ( $NcarE /( $Mce  - $NcarEInt)) > 0 ) {
                return (int)$NcarE +1;
            }else{
                return $NcarEInt;
            }
          }
      
      private function NCarM ( $Long, $Mcm ) {
            if (  $Mcm === 0 ) return 0;
            $NCarM = $Long /  $Mcm;
            $NCarMInt = (int)$NCarM;

            if ( ( $NCarM / ( $Mcm - $NCarMInt) ) > 0 ) {
                return (int)$NCarM +1;
            }else {
                return $NCarMInt;
            }
      }

     private function Fmax ( $NC, $caracteres  ){
             if ( $NC === 0 ) {
                 return   0;
             }else{
                return $caracteres / $NC ; 
             }
     }

      private function NFE ( $search) {
          $resultado = '';
          foreach ( $this->Estandar as $Lines) {
            if (  $search >= $Lines['key-ini'] && $search <= $Lines['key-fin']) {
                $resultado = $Lines['value'];
            }              
          }
          if  ( $resultado === '') { 
              $resultado = end( $this->Estandar); 
            
              $resultado = $resultado['value'];
              };
          
          return (int)$resultado;
 
      }

      private function NFM ( $search) {
          $resultado = '';
          foreach ( $this->Minimo as $Lines) {
            if (  $search >= $Lines['key-ini'] && $search <= $Lines['key-fin']) {
                $resultado = $Lines['value'];
            }
          }
          if ( $resultado === '') { 
              $resultado = end( $this->Minimo); 
              $resultado = $resultado['value'];
              };
          return (int)$resultado;
      }

      private function NC ( $search) {

          $resultado = '';
          $search = (int)$search;
          foreach ( $this->Caracteres as $Lines) {
            if (  $search >= $Lines['key-ini'] && $search <= $Lines['key-fin']) {
                $resultado = $Lines['value'];
            }
          }
           
          if ( $resultado === '') { 
               $resultado = end( $this->Caracteres); 
               $resultado = $resultado['value'];

            };
          return (int)$resultado;
      }

        private function reservarSimbolos(){
            $Caracteres = Braile::getSimbolos();
            $this->Simbolos = [];
            foreach ($Caracteres as  $Fila) {
                    $this->Simbolos[] = array (
                            'caracter' => $Fila->caracter,
                            'imagen'   => $Fila->imagen,
                            'imagen_2' => $Fila->imagen_2,
                    ) ;
            }
        }


     private function setParameters () {
        $this->Estandar = array(
                  ['key-ini' =>  0, 'key-fin' => 32,  'value' => 1 ],
                  ['key-ini' => 33, 'key-fin' => 42,  'value' => 2 ],
                  ['key-ini' => 43, 'key-fin' => 52,  'value' => 3 ],
                  ['key-ini' => 53, 'key-fin' => 62,  'value' => 4 ],
                  ['key-ini' => 63, 'key-fin' => 500, 'value' => 5 ],
                );

        $this->Minimo = array(
                  ['key-ini' =>  0, 'key-fin' => 25,  'value' => 1 ],
                  ['key-ini' => 26, 'key-fin' => 35,  'value' => 2 ],
                  ['key-ini' => 36, 'key-fin' => 45,  'value' => 3 ],
                  ['key-ini' => 46, 'key-fin' => 55,  'value' => 4 ],
                  ['key-ini' => 56, 'key-fin' => 500, 'value' => 5 ],
                );
  
           $this->Caracteres = array(
                  ['key-ini' => 0, 'key-fin' => 19, 'value' => 0 ],
                  ['key-ini' => 20, 'key-fin' => 26, 'value' => 0 ],
                  ['key-ini' => 27, 'key-fin'=> 32, 'value' => 0 ],
                  ['key-ini' => 33, 'key-fin'=> 38, 'value' => 0 ],
                  ['key-ini' => 39, 'key-fin'=> 44, 'value' => 0 ],
                  ['key-ini' => 45, 'key-fin'=> 49, 'value' => 0 ],
                  ['key-ini' => 50, 'key-fin'=> 56, 'value' => 6 ],
                  ['key-ini' => 57, 'key-fin'=> 62, 'value' => 7 ],
                  ['key-ini' => 63, 'key-fin'=> 68, 'value' => 8 ],
                  ['key-ini' => 69, 'key-fin'=> 74, 'value' => 9 ],
                  ['key-ini' => 75, 'key-fin'=> 80, 'value' => 10 ],
                  ['key-ini' => 81, 'key-fin'=> 86, 'value' => 11 ],
                  ['key-ini' => 87, 'key-fin'=> 92, 'value' => 12 ],
                  ['key-ini' => 93, 'key-fin'=> 98, 'value' => 13 ],
                  ['key-ini' => 99, 'key-fin'=> 104, 'value' => 14 ],
                  ['key-ini' => 105, 'key-fin'=> 110, 'value' => 15 ],
                  ['key-ini' => 111, 'key-fin'=> 116, 'value' => 16 ],
                  ['key-ini' => 117, 'key-fin'=> 122, 'value' => 17 ],
                  ['key-ini' => 123, 'key-fin'=> 128, 'value' => 18 ],
                  ['key-ini' => 129, 'key-fin'=> 134, 'value' => 19 ],
                  ['key-ini' => 135, 'key-fin'=> 140, 'value' => 20 ],
                  ['key-ini' => 141, 'key-fin'=> 500, 'value' => 21 ],
 
                );
       }

}
