<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;
 
class CotizacionesDt extends Model
{
	protected $table = 'cotizaciones_dt';
	protected $primaryKey = 'idregistro_ctz_dt';
	public $timestamps = false;

	protected $casts = [
		'idcontrol' => 'int',
		'idtipotrabajo' => 'int',
		'idestilotrabajo' => 'int',
		'idmaterial' => 'int',
		'mano_obra' => 'float',
		'precio' => 'float',
		'cabida' => 'int',
		'cantidad' => 'int',
		'total_cm' => 'float',
		'total_derivados' => 'float',
		'vr_materiales' => 'float',
		'vr_bonificacion' => 'float',
		'vr_mano_obra_terc' => 'float',
		'vr_costo_adm' => 'float',
		'vr_costo_directo' => 'float',
		'vr_comision' => 'float',
		'vr_costo_financ' => 'float',
		'otros_costos' => 'float',
		'vr_costo_total' => 'float',
		'vr_precio_vta_sug' => 'float',
		'vr_precio_vta_dado' => 'float',
		'vr_ret_sugerido' => 'float',
		'vr_ret_dado' => 'float',
		'utilidad_sugerida' => 'float',
		'duracion_horas' => 'float',
		'aprobada' => 'bool'
	];

	protected $dates = [
		'fcha_aprobada'
	];

	protected $fillable = [
		'idcontrol',
		'idtipotrabajo',
		'idestilotrabajo',
		'idmaterial',
		'referencia',
		'mano_obra',
		'precio',
		'cabida',
		'cantidad',
		'encauche',
		'observ_item',
		'cod_moneda',
		'total_cm',
		'total_derivados',
		'vr_materiales',
		'vr_bonificacion',
		'vr_mano_obra_terc',
		'vr_costo_adm',
		'vr_costo_directo',
		'vr_comision',
		'vr_costo_financ',
		'otros_costos',
		'vr_costo_total',
		'vr_precio_vta_sug',
		'vr_precio_vta_dado',
		'vr_ret_sugerido',
		'vr_ret_dado',
		'equivale_cotizac',
		'utilidad_sugerida',
		'duracion_horas',
		'aprobada',
		'fcha_aprobada'
	];

	public function cotizacione()
	{
		return $this->belongsTo(Cotizacione::class, 'idcontrol', 'idcontrol');
	}

	public function estilos_trabajo()
	{
		return $this->belongsTo(EstilosTrabajo::class, 'idestilotrabajo');
	}

	public function materiale()
	{
		return $this->belongsTo(Materiale::class, 'idmaterial');
	}

	public function tipos_trabajo()
	{
		return $this->belongsTo(TiposTrabajo::class, 'idtipotrabajo');
	}
}
