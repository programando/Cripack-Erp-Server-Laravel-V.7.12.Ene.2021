<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebOtsMaquina
 * 
 * @property int $id_maquina
 * @property string|null $nom_maquina
 * @property bool|null $inactivo
 *
 * @package App\Models
 */
class WebOtsMaquina extends Model
{
	protected $table = 'web_ots_maquinas';
	protected $primaryKey = 'id_maquina';
	public $timestamps = false;

	protected $casts = [
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_maquina',
		'inactivo'
	];
}
