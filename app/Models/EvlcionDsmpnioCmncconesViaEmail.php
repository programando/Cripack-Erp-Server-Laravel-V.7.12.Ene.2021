<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

 
class EvlcionDsmpnioCmncconesViaEmail extends Model
{
	protected $table = 'evlcion_dsmpnio_cmnccones_via_email';
	protected $primaryKey = 'idregistro';
	public $timestamps = false;

	protected $casts = [
		'idtercero' => 'int',
		'aprobada' => 'bool',
		'inactivo' => 'bool'
	];

	protected $dates = [
		'fecha'
	];

	protected $fillable = [
		'idtercero',
		'fecha',
		'observacion',
		'aprobada',
		'inactivo'
	];

	public function Terceros()
	{
		return $this->hasMany(Tercero::class, 'idtercero');
	}
}
