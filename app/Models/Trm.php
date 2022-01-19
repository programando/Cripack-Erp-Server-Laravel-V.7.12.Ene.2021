<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Trm
 * 
 * @property int $idregistro
 * @property Carbon|null $fecha
 * @property string|null $moneda
 * @property float|null $trm
 *
 * @package App\Models
 */
class Trm extends Model
{
	protected $table = 'trms';
	protected $primaryKey = 'idregistro';
	public $timestamps = false;

	protected $casts = [
		'trm' => 'float'
	];

	protected $dates = [
		'fecha'
	];

	protected $fillable = [
		'fecha',
		'moneda',
		'trm'
	];
}
