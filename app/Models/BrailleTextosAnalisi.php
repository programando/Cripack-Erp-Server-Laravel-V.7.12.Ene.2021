<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class BrailleTextosAnalisi extends Model
{
	protected $table = 'braille_textos_analisis';
	protected $primaryKey = 'idregistro';
	public $timestamps = false;

	protected $casts = [
		'idtercero' => 'int',
		'caja_largo' => 'int',
		'caja_ancho' => 'int',
		'caja_alto' => 'int',
		'caracteres' => 'int',
		'espacios' => 'int',
		'palabras' => 'int',
		'op1nfe' => 'float',
		'op1nfm' => 'float',
		'op1nc' => 'float',
		'op1mce' => 'float',
		'op1mcm' => 'float',
		'op1fmax' => 'float',
		'op1fdef' => 'float',
		'op1ncare' => 'float',
		'op1ncarm' => 'float',
		'op2nfe' => 'float',
		'op2nfm' => 'float',
		'op2nc' => 'float',
		'op2mce' => 'float',
		'op2mcm' => 'float',
		'op2fmax' => 'float',
		'op2fdef' => 'float',
		'op2ncare' => 'float',
		'op2ncarm' => 'float',
		'op3nfe' => 'float',
		'op3nfm' => 'float',
		'op3nc' => 'float',
		'op3mce' => 'float',
		'op3mcm' => 'float',
		'op3fmax' => 'float',
		'op3fdef' => 'float',
		'op3ncare' => 'float',
		'op3ncarm' => 'float',
		'op4nfe' => 'float',
		'op4nfm' => 'float',
		'op4nc' => 'float',
		'op4mce' => 'float',
		'op4mcm' => 'float',
		'op4fmax' => 'float',
		'op4fdef' => 'float',
		'op4ncare' => 'float',
		'op4ncarm' => 'float',
		'max_cara' => 'int',
		'max_filas' => 'int'
	];

	protected $fillable = [
		'idtercero',
		'texto',
		'caja_largo',
		'caja_ancho',
		'caja_alto',
		'caracteres',
		'espacios',
		'palabras',
		'op1nfe',
		'op1nfm',
		'op1nc',
		'op1mce',
		'op1mcm',
		'op1fmax',
		'op1fdef',
		'op1ncare',
		'op1ncarm',
		'op2nfe',
		'op2nfm',
		'op2nc',
		'op2mce',
		'op2mcm',
		'op2fmax',
		'op2fdef',
		'op2ncare',
		'op2ncarm',
		'op3nfe',
		'op3nfm',
		'op3nc',
		'op3mce',
		'op3mcm',
		'op3fmax',
		'op3fdef',
		'op3ncare',
		'op3ncarm',
		'op4nfe',
		'op4nfm',
		'op4nc',
		'op4mce',
		'op4mcm',
		'op4fmax',
		'op4fdef',
		'op4ncare',
		'op4ncarm',
		'max_cara',
		'max_filas'
	];


	public static function deleteTranscriptedTexts ( $IdTercero  ) {
			return DB::select('call braille_textos_borrar(?)', array( $IdTercero  ) );
	}



	  public static function textSave ( $idtercero, $texto, $caja_largo, $caja_ancho, $caja_alto, $caracteres, $espacios, $palabras, $op1nfe, $op1nfm,$op1nc, $op1mce ,$op1mcm , $op1fmax, $op1fdef, $op1ncare, 															$op1ncarm,  $op2nfe, $op2nfm,$op2nc, $op2mce ,$op2mcm , $op2fmax, $op2fdef, $op2ncare, $op2ncarm ,    $op3nfe, $op3nfm,$op3nc, $op3mce ,$op3mcm , $op3fmax, $op3fdef, 																$op3ncare, $op3ncarm,         $op4nfe, $op4nfm,$op4nc, $op4mce ,$op4mcm , $op4fmax, $op4fdef, $op4ncare, $op4ncarm, $max_cara, $max_filas ) {
 
		 
	  	return DB::select("call braille_textos_grabar(?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?,?)", array($idtercero, "$texto", $caja_largo, $caja_ancho, $caja_alto,$caracteres, $espacios, $palabras, $op1nfe,	$op1nfm,$op1nc, $op1mce ,$op1mcm ,$op1fmax, $op1fdef, $op1ncare, $op1ncarm, $op2nfe,	$op2nfm,$op2nc, $op2mce ,$op2mcm ,$op2fmax, $op2fdef, $op2ncare, $op2ncarm,    $op3nfe,	$op3nfm,$op3nc, $op3mce ,$op3mcm ,$op3fmax, $op3fdef, $op3ncare, $op3ncarm,   $op4nfe,	$op4nfm,$op4nc, $op4mce ,$op4mcm ,$op4fmax, $op4fdef, $op4ncare, $op4ncarm,$max_cara, $max_filas  ));
	 
	  }

		public static function getTextsToAnalysis ( $IdTercero ) {
				return DB::select('call braile_textos_analisis_consulta(?)', array( $IdTercero  ) );

		}

 		public static function textSavePrinter ( $idtercero, $texto, $max_cara, $max_filas, $cara_1, $cara_1_long, $cara_2, $cara_2_long, $palabraError, $cara) {
			$DataResult = DB::select('call braile_textos_impresion_crear(?,?,?,?,?,?,?,?,?,?)', array( $idtercero, "$texto", $max_cara, $max_filas, "$cara_1", $cara_1_long, "$cara_2", $cara_2_long,$palabraError,"$cara"   ) );
			return $DataResult ;
		}

		public static function getSimbolos (  ) {
					return  DB::select('call braile_simbolos_consulta()');	 
		}

	  public static function saveSimbols ( $idtercero, $id_impresion, $caracter, $imgBraile_1, $imgBraile_2 ) {
				return 	DB::select('call braile_textos_impresion_simbolos_grabar(?,?,?,?,?)', array( $idtercero, $id_impresion, "$caracter", "$imgBraile_1", "$imgBraile_2" ) );
		}

		public function getTextosImpresion ( $IdTercero ) {
			return DB::select('call braile_impresion_textos_unicos_x_tercero(?)', array( $IdTercero  ) );
 
		}

	 public static function textosUnicosImpresion ( $IdTercero ) {
		 	return DB::select('call braile_impresion_textos_unicos_x_tercero(?)', array( $IdTercero  ) );
	 }

	 public static function palabrasPorCara ( $IdTercero, $cara, $texto) {
		 	return DB::select('call braile_impresion_textos_x_cara(?,?,?)', array( $IdTercero, $cara, "$texto"  ) );
	 }
	 
	 public static function simbolosPorPalabra ( $Id_Impresion, $ImagesPath  ) {
		 return DB::select('call braile_impresion_simbolos(?,?)', array(  $Id_Impresion, "$ImagesPath" ) );
	 }
}
