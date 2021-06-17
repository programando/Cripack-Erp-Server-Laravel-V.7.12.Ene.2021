<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebOtsSustrato
 * 
 * @property int $id_sustrato
 * @property string|null $nom_sustrato
 * @property bool|null $inactivo
 *
 * @package App\Models
 */
class WebOtsSustrato extends Model
{
	protected $table = 'web_ots_sustrato';
	protected $primaryKey = 'id_sustrato';
	public $timestamps = false;

	protected $casts = [
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_sustrato',
		'inactivo'
	];
}
