<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebOtsPunzone
 * 
 * @property int $id_punzon
 * @property string|null $nom_punzon
 * @property bool|null $inactivo
 *
 * @package App\Models
 */
class WebOtsPunzones extends Model
{
	protected $table = 'web_ots_punzones';
	protected $primaryKey = 'id_punzon';
	public $timestamps = false;

	protected $casts = [
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_punzon',
		'inactivo'
	];
}
