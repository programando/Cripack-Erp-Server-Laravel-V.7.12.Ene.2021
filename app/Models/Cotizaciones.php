<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;

 
 
class Cotizaciones extends Model
{
	protected $table = 'cotizaciones';
	protected $primaryKey = 'idregistro_ctz';
	public $timestamps = false;

	protected $casts = [
		'idcontrol' => 'int',
		'idsucursal' => 'int',
		'numcotizacion' => 'int',
		'idtercero' => 'int',
		'idtercero_realiza' => 'int',
		'tasa_cambio' => 'float',
		'utilidad' => 'float',
		'costoa_adm' => 'float',
		'comision' => 'float',
		'flete' => 'float',
		'vr_transf_bancos' => 'float',
		'vr_embalaje' => 'float',
		'bonificacion' => 'float',
		'idcargo' => 'int',
		'idparametro_cotiz' => 'int',
		'idincoterms' => 'int',
		'id_estado' => 'int',
		'tiempo_horas' => 'float',
		'idgradodificultad' => 'int'
	];

	protected $dates = [
		'fecha',
		'fecha_estado',
		'fecha_hora_solicitud'
	];

	protected $fillable = [
		'idcontrol',
		'idsucursal',
		'numcotizacion',
		'idtercero',
		'idtercero_realiza',
		'fecha',
		'cod_moneda',
		'tasa_cambio',
		'utilidad',
		'costoa_adm',
		'comision',
		'flete',
		'vr_transf_bancos',
		'vr_embalaje',
		'forma_pago',
		'bonificacion',
		'notas_cotizacion',
		'referencias',
		'idcargo',
		'idparametro_cotiz',
		'texto_entrega',
		'idincoterms',
		'id_estado',
		'fecha_estado',
		'tiempo_horas',
		'fecha_hora_solicitud',
		'idgradodificultad'
	];


	// Junio 09 de 2021.		 Consulta datos iniciales de las notificaciones por enviar
		public static function notificacionesPendientes(  ) {
					return DB::select('call api_terceros_cotizaciones_notificaciones_seguimiento(?)', array(Carbon::now()->format('Ymd') ) );
			}
		public static function consultaCtzDtPorIdRegisro( $idregistro_ctz_dt ) {
					return DB::select('call api_terceros_cotizaciones_dt_consulta_datos(?)', array( $idregistro_ctz_dt ) );
			}
			
		
		public static function consultaCtzPorIdControl( $Idcontrol ) {
			return DB::select('call cotizaciones_consultar_h_x_idcontrol(?)', array( $Idcontrol ) );
		}
	  
		public static function consultaCtzDtPorIdControl( $Idcontrol ) {
			return DB::select('call cotizaciones_consultar_dt_x_idcontrol(?)', array( $Idcontrol ) );
		}


	public function cotizaciones_estado()
	{
		return $this->belongsTo(CotizacionesEstado::class, 'id_estado');
	}

	public function sucursale()
	{
		return $this->belongsTo(Sucursale::class, 'idsucursal');
	}

	public function tercero()
	{
		return $this->belongsTo(Tercero::class, 'idtercero');
	}

	public function cotizaciones_dts()
	{
		return $this->hasMany(CotizacionesDt::class, 'idcontrol', 'idcontrol');
	}

	public function cotizaciones_marbaches()
	{
		return $this->hasMany(CotizacionesMarbach::class, 'idcontrol');
	}

	public function materiales()
	{
		return $this->belongsToMany(Materiale::class, 'cotizaciones_materiales', 'idcontrol', 'idmaterial')
					->withPivot('idregistro', 'vr_unitario', 'margen', 'cantidad', 'referencia');
	}
}
