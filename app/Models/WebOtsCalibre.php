<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebOtsCalibre
 * 
 * @property int $id_calibre
 * @property string|null $nom_calibre
 * @property bool|null $inactivo
 *
 * @package App\Models
 */
class WebOtsCalibre extends Model
{
	protected $table = 'web_ots_calibre';
	protected $primaryKey = 'id_calibre';
	public $timestamps = false;

	protected $casts = [
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_calibre',
		'inactivo'
	];
}
