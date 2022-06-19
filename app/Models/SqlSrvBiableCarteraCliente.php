<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

 
class SqlSrvBiableCarteraCliente extends Model
{
	protected $table = 'sql_srv_biable_cartera_clientes';
	protected $primaryKey = 'idregistro';
	public $timestamps = false;

	protected $casts = [
		'plazo' => 'int',
		'dias_vencida' => 'int',
		'valor_cartera' => 'float'
	];

	protected $dates = [
		'fcha_doc',
		'fcha_vence',
		'update_at'
	];

	protected $fillable = [
		'cod_tercero',
		'nom_vendedor',
		'nit_cliente',
		'nom_cliente',
		'tp_doc',
		'nro_doc',
		'fcha_doc',
		'plazo',
		'fcha_vence',
		'dias_vencida',
		'valor_cartera',
		'update_at'
	];

	public function scopeFacturasNitTercero ( $query, $NitTercero ) {
	 
		return $query->whereNitCliente("$NitTercero")->orderBy('dias_vencida','DESC')->get();
	}
}