<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

 
class TercerosWebActividades extends Model
{
	protected $table = 'terceros_web_actividades';
	protected $primaryKey = 'idregistro';
	public $timestamps = false;

	protected $casts = [
		'idtercero' => 'int',
		'id_tp_activ_web' => 'int'
	];

	protected $dates = [
		'fecha'
	];

	protected $fillable = [
		'idtercero',
		'fecha',
		'id_tp_activ_web' 
	];

	public function terceros_web_tipos_actividade()
	{
		return $this->belongsTo(TercerosWebTiposActividade::class, 'id_tp_activ_web');
	}

	public function tercero()
	{
		return $this->belongsTo(Tercero::class, 'idtercero');
	}

	/*	Junio 28 2021			Registro de activiades de un usuario en el sitio */
	public static function saveActivity( $IdTercero, $IdTpActivweb, $Detalle ) {
			$NuevoRegistro                  = new TercerosWebActividades;
			$NuevoRegistro->idtercero       = $IdTercero;
			$NuevoRegistro->fecha           = Carbon::now();
			$NuevoRegistro->id_tp_activ_web = $IdTpActivweb;
			$NuevoRegistro->detalle					= $Detalle;
			$NuevoRegistro->save();
	}
}
