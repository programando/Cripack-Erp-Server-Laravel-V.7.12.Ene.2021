<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

use Strings;

class MotivosVisita extends Model
{
	protected $table = 'motivos_visitas';
	protected $primaryKey = 'idmtvovisita';
	public $incrementing = false;
	public $timestamps = false;

	protected $casts = [
		'idmtvovisita' => 'int',
		'inactivo'     => 'bool'
	];

	protected $fillable = [
		'codmtvovisita',
		'nommtvovisita',
		'inactivo'
	];

	
	public function getNommtvovisitaAttribute( $value ) {
		return Strings::InicialMayuscula( $value );
	}

	public function terceros_visitas()
	{
		return $this->hasMany(TercerosVisita::class, 'idmtvovisita');
	}
}
