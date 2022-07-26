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
        
          $idtercero  = $FormData->idTercero;
          $texto      = Strings::FixAccents (strtoupper(trim($FormData->texto)));
          $largo      = (int)$FormData->largo;
          $alto       = (int)$FormData->alto;
          $ancho      = (int)$FormData->ancho;
          $imprimirEn = (string)$FormData->imprimirEn;   // largo   o   ancho

   
          $this->setParameters ();
          
          $this->reservarSimbolos () ;
          
          Braile::deleteTranscriptedTexts (  $idtercero );
          
          $isPrinterPosible = $this->saveText (  $idtercero, $texto , $largo, $ancho, $alto, $imprimirEn );
          
          if ( $isPrinterPosible === false )  return response()->json(['result' => 'braileNoImprimible', 'data' => []]); ;
          
          $this->distibuirImpresionTextos ( $idtercero) ;
          $result = $this->showTranscription ( $idtercero, $texto  );
          return response()->json(['result' => 'Ok', 'data' => $result]);
          
     }


      public function saveText( $idtercero, $texto , $caja_largo, $caja_ancho, $caja_alto, $imprimirEn ) {          
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
             $_max_cara  = $op3nc;
             $_max_filas = $op3nfm ;
             $_estandar  = $op3nfe;
             $_minimo    = $op3nfm ;
             if ( $imprimirEn =='ancho'  ) {
                $_max_cara  = $op4nc;
                $_max_filas = $op4nfm;
                $_estandar  = $op4nfe ;
                $_minimo    = $op4nfm ;
              }
             Braile::textSave( $idtercero, $texto, $caja_largo, $caja_ancho, $caja_alto, $caracteres, $espacios, $palabras, $op1nfe, $op1nfm , $op1nc, $op1mce, $op1mcm, $op1fmax,$op1fdef,  $op1ncare, $op1ncarm,  $op2nfe, $op2nfm , $op2nc, $op2mce, $op2mcm, $op2fmax,$op2fdef, $op2ncare, $op2ncarm,   $op3nfe, $op3nfm , $op3nc, $op3mce, $op3mcm, $op3fmax,$op3fdef, $op3ncare, $op3ncarm, $op4nfe, $op4nfm , $op4nc, $op4mce, $op4mcm, $op4fmax,$op4fdef, $op4ncare, $op4ncarm, $_max_cara,  $_max_filas );
            
            if ( (int)$_estandar === 0 || (int)$_minimo  === 0 ) {
                return false; // Datos de la caja no pueden usarse para impresión
            } else {
                return true;
            }   
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


    private function grabarCaras ($idtercero, $texto,    $Filas , $MaxCara, $MaxFilas) {  
        $FilasOcupadas = 1;
        $texto = trim( $texto); 
        
        foreach ($Filas as $Fila ) {
            $palabrasAtraducir = trim(mb_strtolower( $Fila, 'UTF-8'));        
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
         //$Letras             = preg_split('//',$Palabra ,-1, PREG_SPLIT_NO_EMPTY)  ;  /// Separa cada palabra en letras para encontrar su simbolo braile 
         $Letras             = $this->lettersOfWord($Palabra)  ;  /// Separa cada palabra en letras para encontrar su simbolo braile 
         $complementoSimbolo = 0;
         $complementoNumero  = true;
         
         foreach ( $Letras as $Letra) {
             $letraToSave = mb_strtolower( $Letra,  'UTF-8');
              
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

    private function lettersOfWord ( $Palabra ) {
        //Separa cada palabra en letras para encontrar su simbolo braile 
        $Palabra = mb_str_split(trim($Palabra) );
        $Letras  = [];
        foreach ( $Palabra  as $Letra) {
            $Letras[] = $Letra;
        }
        return $Letras;
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
                                   'simbolos'   => $simbolosPalabra,
                                   'long_texto' => $value->long_texto,
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
        if ( $caraterBusqueda == '}') {
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
                  ['key-ini' =>  0, 'key-fin' => 22,  'value' => 0 ],
                  ['key-ini' => 23, 'key-fin' => 32,  'value' => 1 ],
                  ['key-ini' => 33, 'key-fin' => 42,  'value' => 2 ],
                  ['key-ini' => 43, 'key-fin' => 52,  'value' => 3 ],
                  ['key-ini' => 53, 'key-fin' => 62,  'value' => 4 ],
                  ['key-ini' => 63, 'key-fin' => 500, 'value' => 5 ],
                );

        $this->Minimo = array(
                  ['key-ini' =>  0, 'key-fin' => 19,  'value' => 0 ],
                  ['key-ini' => 20, 'key-fin' => 25,  'value' => 1 ],
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
                  ['key-ini' => 50, 'key-fin'=> 55, 'value' => 6 ],
                  ['key-ini' => 56, 'key-fin'=> 61, 'value' => 7 ],
                  ['key-ini' => 62, 'key-fin'=> 67, 'value' => 8 ],
                  ['key-ini' => 68, 'key-fin'=> 73, 'value' => 9 ],
                  ['key-ini' => 74, 'key-fin'=> 79, 'value' => 10 ],
                  ['key-ini' => 80, 'key-fin'=> 85, 'value' => 11 ],
                  ['key-ini' => 86, 'key-fin'=> 91, 'value' => 12 ],
                  ['key-ini' => 92, 'key-fin'=> 97, 'value' => 13 ],
                  ['key-ini' => 98, 'key-fin'=> 103, 'value' => 14 ],
                  ['key-ini' => 104, 'key-fin'=> 109, 'value' => 15 ],
                  ['key-ini' => 110, 'key-fin'=> 115, 'value' => 16 ],
                  ['key-ini' => 116, 'key-fin'=> 121, 'value' => 17 ],
                  ['key-ini' => 122, 'key-fin'=> 127, 'value' => 18 ],
                  ['key-ini' => 128, 'key-fin'=> 133, 'value' => 19 ],
                  ['key-ini' => 134, 'key-fin'=> 139, 'value' => 20 ],
                  ['key-ini' => 140, 'key-fin'=> 145, 'value' => 21 ],
                  ['key-ini' => 146, 'key-fin'=> 151, 'value' => 22 ],
                  ['key-ini' => 152, 'key-fin'=> 157, 'value' => 23 ],
                  ['key-ini' => 158, 'key-fin'=> 163, 'value' => 24 ],
                  ['key-ini' => 164, 'key-fin'=> 169, 'value' => 25 ],
                  ['key-ini' => 170, 'key-fin'=> 175, 'value' => 26 ],
                  ['key-ini' => 176, 'key-fin'=> 181, 'value' => 27 ],
                  ['key-ini' => 182, 'key-fin'=> 187, 'value' => 28 ],
                  ['key-ini' => 188, 'key-fin'=> 193, 'value' => 29 ],
                  ['key-ini' => 194, 'key-fin'=> 500, 'value' => 30 ],
 
                );
       }

}
