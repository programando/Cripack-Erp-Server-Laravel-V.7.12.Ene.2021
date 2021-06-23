<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class WebOtsAyudapega
 * 
 * @property int $id_ayudapega
 * @property string|null $nom_ayudapega
 * @property bool|null $inactivo
 *
 * @package App\Models
 */
class WebOtsAyudapega extends Model
{
	protected $table = 'web_ots_ayudapega';
	protected $primaryKey = 'id_ayudapega';
	public $timestamps = false;

	protected $casts = [
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_ayudapega',
		'inactivo'
	];
}
