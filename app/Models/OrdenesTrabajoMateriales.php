<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * Class OrdenesTrabajoMateriale
 * 
 * @property int $idregistro_mat
 * @property int|null $idregistro_ot
 * @property int|null $idmaterial
 * @property float|null $costo_inventario
 * @property float|null $cantidad
 * @property float|null $cant_dsnio
 * @property bool $suma_cm_ot
 * @property bool $pendiente
 * @property float|null $madera_cant_1
 * @property float|null $madera_cant_2
 * @property bool $marca_material
 * @property float|null $cantreal
 * @property float|null $preciomaterial
 * @property float|null $consumo_estimado
 * @property int|null $id_inconformidad
 * @property float|null $cant_inconformidad
 * @property bool|null $dscrgdo_desde_labor
 * 
 * @property OrdenesTrabajo|null $ordenes_trabajo
 * @property Materiale|null $materiale
 *
 * @package App\Models
 */
class OrdenesTrabajoMateriales extends Model
{
	protected $table = 'ordenes_trabajo_materiales';
	protected $primaryKey = 'idregistro_mat';
	public $timestamps = false;

	protected $casts = [
		'idregistro_ot' => 'int',
		'idmaterial' => 'int',
		'costo_inventario' => 'float',
		'cantidad' => 'float',
		'cant_dsnio' => 'float',
		'suma_cm_ot' => 'bool',
		'pendiente' => 'bool',
		'madera_cant_1' => 'float',
		'madera_cant_2' => 'float',
		'marca_material' => 'bool',
		'cantreal' => 'float',
		'preciomaterial' => 'float',
		'consumo_estimado' => 'float',
		'id_inconformidad' => 'int',
		'cant_inconformidad' => 'float',
		'dscrgdo_desde_labor' => 'bool'
	];

	protected $fillable = [
		'idregistro_ot',
		'idmaterial',
		'costo_inventario',
		'cantidad',
		'cant_dsnio',
		'suma_cm_ot',
		'pendiente',
		'madera_cant_1',
		'madera_cant_2',
		'marca_material',
		'cantreal',
		'preciomaterial',
		'consumo_estimado',
		'id_inconformidad',
		'cant_inconformidad',
		'dscrgdo_desde_labor'
	];

	public function ordenes_trabajo()
	{
		return $this->belongsTo(OrdenesTrabajo::class, 'idregistro_ot');
	}

	public function materiale()
	{
		return $this->belongsTo(Materiale::class, 'idmaterial');
	}
}
