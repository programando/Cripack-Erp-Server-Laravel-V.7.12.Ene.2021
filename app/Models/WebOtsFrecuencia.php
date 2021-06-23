<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebOtsFrecuencium
 * 
 * @property int $id_frecuencia
 * @property string|null $nom_frecuencia
 * @property bool|null $inactivo
 *
 * @package App\Models
 */
class WebOtsFrecuencia extends Model
{
	protected $table = 'web_ots_frecuencia';
	protected $primaryKey = 'id_frecuencia';
	public $timestamps = false;

	protected $casts = [
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_frecuencia',
		'inactivo'
	];
}
