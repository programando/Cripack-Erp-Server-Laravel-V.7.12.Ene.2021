<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

 
class WebOtsTpArreglo extends Model
{
	protected $table = 'web_ots_tp_arreglo';
	protected $primaryKey = 'id_tp_arreglo';
	public $timestamps = false;

	protected $casts = [
		'inactivo' => 'bool'
	];

	protected $fillable = [
		'nom_tp_arreglo',
		'inactivo'
	];
}
