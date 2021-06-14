<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use DB;
class TccRemisionesDespacho extends Model
{
	protected $table = 'remisiones_despachos';
	protected $primaryKey = 'idregistro';
	public $timestamps = false;

	protected $casts = [
		'email_enviado' => 'bool',
		'web_service' => 'bool',
		'id_tercero' => 'int'
	];

	protected $dates = [
		'fecha_registro'
	];

	protected $fillable = [
		'num_remesa',
		'fecha_remesa',
		'cod_cripack',
		'nom_destinatario',
		'nom_destinatario_adicional',
		'dir_destinatario',
		'dir_destinatario_adicional',
		'tel_destinatario',
		'cod_ciudad_destino',
		'cod_ciudad_pago',
		'tipo_pago',
		'unidades',
		'kilos_reales',
		'kilos_volumen',
		'largo',
		'ancho',
		'alto',
		'tipo_empaque',
		'valor_mercancia',
		'observacion_1',
		'observacion_2',
		'observacion_3',
		'observacion_adicional',
		'tipo_documento',
		'num_documento',
		'fecha_documento',
		'tipo_relacion',
		'docs_entregar',
		'docs_devolver',
		'reclama_en_bodega',
		'centro_costo',
		'archivo_asociado',
		'fecha_registro',
		'email_enviado',
		'identificacion',
		'nombre',
		'web_service',
		'fecha_ws',
		'respuesta',
		'nro_rmsa_tcc',
		'cod_barra',
		'id_tercero'
	];

	public function emails(){
		return $this->hasMany(RemisionesDespachosEmail::class, 'idregistro_despacho');
	}


	public static function getDocsToIntegration() {
				return     DB::select('call remisiones_despachos_integrar_ws_tcc()');
	}

	public static function assingNroRemesaToRemision($idregistro ,$respuesta ,$nro_rmsa_tcc, $codbarra){
       $Registro    =  DB::select('call remisiones_despachos_integrar_ws_upd_nro_remesa(?,?,?,? )', array($idregistro,"$respuesta", $nro_rmsa_tcc,"$codbarra"  ));			
	}

 public static function sendCustomerNotification() {
	 	return     DB::select('call api_remisiones_informar_clientes()');
 }

  //  Junio 14 2021.			Consuilta las remisiones que no tienen fecha de entraga por parte del transportador 
	public static function remisionesPdtesFechaEntregaTcc() {
	 	return     DB::select('call api_remisiones_tcc_confirma_entrega()');
 }

  //  Junio 14 2021.			actualiza la fecha de entrega de las remisiones
	public static function remisionesUpdateFechaEntregaTcc( $idRemision, $FechaEntrega ) {
	 	return     DB::select('call api_remisiones_tcc_confirma_entrega_update_fecha(?,?)', array($idRemision, $FechaEntrega ));
 }


}
