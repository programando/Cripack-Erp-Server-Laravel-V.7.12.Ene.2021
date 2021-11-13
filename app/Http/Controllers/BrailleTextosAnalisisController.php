<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\BrailleTextosAnalisi as Braile;

class BrailleTextosAnalisisController extends Controller
{
    private $Estandar = array(), $Minimo = array(), $Caracteres = array();

     public function transcripcionTextos ( Request $FormData ) {
            
          $idtercero = $FormData->idTercero;
          $texto     = trim($FormData->texto);
          $largo     = (int)$FormData->largo;
          $alto      = (int)$FormData->alto;
          $ancho     = (int)$FormData->ancho;    
          
          $this->setParameters ();
          Braile::deleteTranscriptedTexts (  $idtercero );
          $this->saveText (  $idtercero, $texto , $largo, $ancho, $alto );
          return $FormData ;
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
