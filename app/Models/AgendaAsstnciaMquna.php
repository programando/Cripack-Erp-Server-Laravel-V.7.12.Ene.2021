<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

use DB;
class AgendaAsstnciaMquna extends Model
{
	protected $table = 'agenda_asstncia_mqunas';
	protected $primaryKey = 'idregistro';
	public $timestamps = false;

	protected $casts = [
		'idtercero'            => 'int',
		'idtercero_usuario'    => 'int',
		'idtercero_operario'   => 'int',
		'idtercero_aprueba'    => 'int',
		'email_aprobado'       => 'bool',
		'email_equpo_asstncia' => 'bool'
	];

	protected $dates = [
		'fecha',
		'fecha_aprobado',
		'aviso_crdndor_vntas',
		'aviso_grncia',
		'fecha_envio_equpo_asstncia'
	];

	protected $fillable = [
		'idtercero',
		'idtercero_usuario',
		'idtercero_operario',
		'idtercero_aprueba',
		'fecha',
		'fecha_aprobado',
		'email_aprobado',
		'actvdad_am',
		'actvdad_pm',
		'aviso_crdndor_vntas',
		'aviso_grncia',
		'fecha_envio_equpo_asstncia',
		'email_equpo_asstncia'
	];


	public static function consultaAgendaMesAnio ( $IdMes, $Anio  ){
		return DB::select('call api_agenda_asstncia_mqunas_x_mes_anio ( ?,? )', array ( $IdMes, $Anio ) );
	}

	public static function aprobadasEnviarEmail ( ) {
		return DB::select('call agenda_asstncia_mqunas_aprbdas_enviar_email ()');
	}

	public static function aprobadasFinalizar ( $IdRegistro ) {
		return DB::select('call agenda_asstncia_mqunas_aprbdas_fnlzar (?)', array ( $IdRegistro ));
	}
}
