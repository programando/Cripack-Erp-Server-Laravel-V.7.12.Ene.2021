<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;


class TercerosVisita extends Model
{
	protected $table = 'terceros_visitas';
	protected $primaryKey = 'idregistro';
	public $timestamps = false;

	protected $casts = [
		'idtercero'    => 'int',
		'idmtvovisita' => 'int',
		'venta'        => 'float',
		'pago'         => 'float',
		'tipo_visita'  => 'int'
	];

	protected $dates = [
		'fecha_visita',
		'fecha_proxvisita'
	];

	protected $fillable = [
		'idtercero',
		'fecha_visita',
		'idmtvovisita',
		'resultados',
		'siguiente_paso',
		'venta',
		'pago',
		'codcripack',
		'fecha_proxvisita',
		'contacto',
		'tipo_visita','idtercero_usuario'
	];

	public function motivos_visita()
	{
		return $this->belongsTo(MotivosVisita::class, 'idmtvovisita');
	}

	public function tercero()
	{
		return $this->belongsTo(Tercero::class, 'idtercero');
	}
}
