<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

 
class OrdenesTrabajoLabores extends Model
{
	protected $table = 'ordenes_trabajo_labores';
	protected $primaryKey = 'idregistro_labores';
	public $timestamps = false;

	protected $casts = [
		'idregistro_ot' => 'int',
		'idlabor' => 'int',
		'idtercero' => 'int',
		'idtercero_inicia' => 'int',
		'idtercero_finaliza' => 'int',
		'id_motivo_inactiva_ot' => 'int',
		'inicio_trazo_manual' => 'bool',
		'lab_acomp' => 'bool',
		'idtercero_acomp' => 'int',
		'duracion' => 'float',
		'minutos_lab_simult' => 'float',
		'tot_minutos' => 'float',
		'idmaquina' => 'int',
		'idtercero_operario_manual' => 'int'
	];

	protected $dates = [
		'fecha_hora_inicio',
		'fecha_hora_final',
		'ini_lab_simult',
		'fin_lab_simult',
		'fecha_hora_inicio_manual',
		'fecha_hora_final_manual',
		'fecha_hora_dscga_labor'
	];

	protected $fillable = [
		'idregistro_ot',
		'idlabor',
		'idtercero',
		'fecha_hora_inicio',
		'fecha_hora_final',
		'idtercero_inicia',
		'idtercero_finaliza',
		'id_motivo_inactiva_ot',
		'inicio_trazo_manual',
		'ini_lab_simult',
		'fin_lab_simult',
		'lab_acomp',
		'idtercero_acomp',
		'duracion',
		'minutos_lab_simult',
		'tot_minutos',
		'idmaquina',
		'fecha_hora_inicio_manual',
		'fecha_hora_final_manual',
		'idtercero_operario_manual',
		'fecha_hora_dscga_labor'
	];

	public function ordenes_trabajo_motivos_inactivar()
	{
		return $this->belongsTo(OrdenesTrabajoMotivosInactivar::class, 'id_motivo_inactiva_ot');
	}

	public function ordenes_trabajo()
	{
		return $this->belongsTo(OrdenesTrabajo::class, 'idregistro_ot');
	}

	public function labore()
	{
		return $this->belongsTo(Labore::class, 'idlabor');
	}

	public function tercero()
	{
		return $this->belongsTo(Tercero::class, 'idtercero');
	}
}
