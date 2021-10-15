<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class DocumentacionProcesosArchivo
 * 
 * @property int $idarchivo
 * @property int|null $idcategoria
 * @property string|null $nomarchivo
 * @property string|null $extension
 * @property string|null $observacion
 * @property string|null $palabrasclave
 * @property bool $restringido
 * @property string|null $ruta
 * @property string|null $file_key
 * 
 * @property Categoria|null $categoria
 *
 * @package App\Models
 */
class DocumentacionProcesosArchivo extends Model
{
	protected $table = 'documentacion_procesos_archivos';
	protected $primaryKey = 'idarchivo';
	public $timestamps = false;

	protected $casts = [
		'idcategoria' => 'int',
		'restringido' => 'bool'
	];

	protected $fillable = [
		'idcategoria',
		'nomarchivo',
		'extension',
		'observacion',
		'palabrasclave',
		'restringido',
		'ruta',
		'file_key'
	];

	public function categoria()
	{
		return $this->belongsTo(Categoria::class, 'idcategoria');
	}
}
