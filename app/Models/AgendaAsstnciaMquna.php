<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;


class AgendaAsstnciaMquna extends Model
{
	protected $table = 'agenda_asstncia_mqunas';
	protected $primaryKey = 'idregistro';
	public $timestamps = false;

	protected $casts = [
		'idtercero' => 'int',
		'idtercero_usuario' => 'int',
		'idtercero_operario' => 'int',
		'idtercero_aprueba' => 'int'
	];

	protected $dates = [
		'fecha'
	];

	protected $fillable = [
		'idtercero',
		'idtercero_usuario',
		'idtercero_operario',
		'idtercero_aprueba',
		'fecha',
		'actvdad_am',
		'actvdad_pm'
	];

	public static function consultaAgendaMesAnio ( $IdMes, $Anio  ){
		return DB::select('call api_agenda_asstncia_mqunas_x_mes_anio ( ?,? )', array ( $IdMes, $Anio ) );
	}


}
