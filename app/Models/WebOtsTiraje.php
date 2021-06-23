<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebOtsTiraje
 * 
 * @property int $id_tiraje
 * @property string|null $nom_tiraje
 * @property bool|null $inactivo
 *
 * @package App\Models
 */
class WebOtsTiraje extends Model
{
	protected $table = 'web_ots_tiraje';
	protected $primaryKey = 'id_tiraje';
	public $timestamps = false;

	protected $casts = [
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_tiraje',
		'inactivo'
	];
}
