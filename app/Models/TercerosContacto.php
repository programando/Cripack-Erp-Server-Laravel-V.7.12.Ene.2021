<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class TercerosContacto
 * 
 * @property int $idregistro
 * @property int|null $idtercero
 * @property string|null $atencion
 * @property string|null $contacto
 * @property int|null $idcargo_externo
 * @property int|null $idarea
 * @property string|null $celular
 * @property string|null $email
 * @property string|null $observacion
 * @property bool $edita_datos_web
 * @property bool|null $aplica_pqr
 * @property bool|null $rpte_ctera
 * @property bool|null $rpte_ots
 * @property bool|null $rpte_despachos
 * @property bool|null $rpte_desing
 * @property bool|null $rpte_ctzcones
 * 
 * @property TercerosAreasEmpresa|null $terceros_areas_empresa
 * @property TercerosCargosExterno|null $terceros_cargos_externo
 * @property Tercero|null $tercero
 *
 * @package App\Models
 */
class TercerosContacto extends Model
{
	protected $table = 'terceros_contactos';
	protected $primaryKey = 'idregistro';
	public $timestamps = false;

	protected $casts = [
		'idtercero' => 'int',
		'idcargo_externo' => 'int',
		'idarea' => 'int',
		'edita_datos_web' => 'bool',
		'aplica_pqr' => 'bool',
		'rpte_ctera' => 'bool',
		'rpte_ots' => 'bool',
		'rpte_despachos' => 'bool',
		'rpte_desing' => 'bool',
		'rpte_ctzcones' => 'bool'
	];

	protected $fillable = [
		'idtercero',
		'atencion',
		'contacto',
		'idcargo_externo',
		'idarea',
		'celular',
		'email',
		'observacion',
		'edita_datos_web',
		'aplica_pqr',
		'rpte_ctera',
		'rpte_ots',
		'rpte_despachos',
		'rpte_desing',
		'rpte_ctzcones'
	];

	public function terceros_areas_empresa()
	{
		return $this->belongsTo(TercerosAreasEmpresa::class, 'idarea');
	}

	public function terceros_cargos_externo()
	{
		return $this->belongsTo(TercerosCargosExterno::class, 'idcargo_externo');
	}

	public function tercero()
	{
		return $this->belongsTo(Tercero::class, 'idtercero');
	}
}
