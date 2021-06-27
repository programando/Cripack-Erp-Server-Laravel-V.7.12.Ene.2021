<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Collection;


class OrdenesTrabajo extends Model
{
	protected $table = 'ordenes_trabajo';
	protected $primaryKey = 'idregistro_ot';
	public $timestamps = false;

	protected $casts = [
		'idreg_ot_ppal' => 'int',
		'numero_ot' => 'int',
		'idcontrol_cotizacion' => 'int',
		'idsucursal' => 'int',
		'idtercero' => 'int',
		'idestilotrabajo' => 'int',
		'idtipotrabajo' => 'int',
		'idgradodificultad' => 'int',
		'idtercero_vendedor' => 'int',
		'idtercero_realiza' => 'int',
		'idtercero_descarga' => 'int',
		'id_tipo_trazo' => 'int',
		'cabida' => 'int',
		'cantidad' => 'int',
		'terminada' => 'bool',
		'remisionada' => 'bool',
		'costeada' => 'bool',
		'excluida_costeo' => 'bool',
		'facturada' => 'bool',
		'd_y_a' => 'bool',
		'factura_pagada' => 'bool',
		'aplica_produccion' => 'bool',
		'edit_costo' => 'bool',
		'vr_adicional' => 'float',
		'numero_calado_laser' => 'int',
		'activa' => 'bool',
		'id_dibujo' => 'int',
		'req_corte_y_encauche' => 'bool',
		'id_turno' => 'int',
		'idtercero_trazo' => 'int',
		'prioridad_trazo' => 'int',
		'prioridad_doblado' => 'int',
		'numcotizacion' => 'int',
		'cm_ot' => 'float',
		'cm_ot_equivalentes' => 'float',
		'horas_estimadas_ot' => 'float',
		'idtercero_asig_fcha_producc' => 'int',
		'id_tipo_despacho' => 'int',
		'id_motivo_reproceso' => 'int',
		'no_facturable' => 'bool',
		'id_motivo_no_factura' => 'int',
		'bloqueada' => 'bool',
		'blquda_hstral' => 'bool',
		'id_pqr' => 'int',
		'braile_nro_caracteres' => 'float',
		'largo_3_d' => 'float',
		'ancho_3_d' => 'float',
		'tiempo_impresion_3_d' => 'float',
		'tiempo_produccion_3_d' => 'float',
		'exportada_cg1' => 'bool',
		'idmaquina' => 'int',
		'idincoterms' => 'int',
		'fact_antes_prdccion' => 'bool',
		'cchllacmpnscion' => 'float'
	];

	protected $dates = [
		'fecha_registro',
		'fecha_solicitud',
		'fecha_entrega',
		'fecha_terminada',
		'fecha_facturada',
		'fecha_costeada',
		'fecha_entrega_producc',
		'fecha_entrega_pn_real',
		'fecha_entrega_indicador'
	];

	protected $fillable = [
		'idreg_ot_ppal',
		'numero_ot',
		'idcontrol_cotizacion',
		'idsucursal',
		'idtercero',
		'idestilotrabajo',
		'idtipotrabajo',
		'idgradodificultad',
		'idtercero_vendedor',
		'idtercero_realiza',
		'idtercero_descarga',
		'id_tipo_trazo',
		'fecha_registro',
		'fecha_solicitud',
		'fecha_entrega',
		'fecha_terminada',
		'fecha_facturada',
		'fecha_costeada',
		'referencia',
		'referencia_facturacion',
		'cabida',
		'cantidad',
		'observaciones',
		'observaciones_2',
		'observaciones_op',
		'terminada',
		'remisionada',
		'costeada',
		'excluida_costeo',
		'facturada',
		'd_y_a',
		'factura_pagada',
		'aplica_produccion',
		'edit_costo',
		'numero_remision',
		'numero_factura',
		'numero_oc_cliente',
		'vr_adicional',
		'numero_calado_laser',
		'activa',
		'observ_inactiva',
		'id_dibujo',
		'req_corte_y_encauche',
		'id_turno',
		'trazo',
		'calado',
		'doblado_encuchillado',
		'encauche',
		'terminado',
		'idtercero_trazo',
		'prioridad_trazo',
		'prioridad_doblado',
		'numcotizacion',
		'cm_ot',
		'cm_ot_equivalentes',
		'horas_estimadas_ot',
		'fecha_entrega_producc',
		'fecha_entrega_pn_real',
		'idtercero_asig_fcha_producc',
		'fecha_entrega_indicador',
		'despacho',
		'id_tipo_despacho',
		'asume_dspcho',
		'id_motivo_reproceso',
		'no_facturable',
		'id_motivo_no_factura',
		'bloqueada',
		'blquda_hstral',
		'observ_adic',
		'nro_prg',
		'id_pqr',
		'braile_nro_caracteres',
		'largo_3_d',
		'ancho_3_d',
		'profundidad_3_d',
		'tiempo_impresion_3_d',
		'tiempo_produccion_3_d',
		'exportada_cg1',
		'texto_braile',
		'nro_troquel',
		'idmaquina',
		'idincoterms',
		'fact_antes_prdccion',
		'cchllacmpnscion'
	];

	public static function delExteriorIniciarGestionDespacho() {
			return DB::select('call api_ots_exterior_gestion_dspacho_factura( )' );
	}
	public static function delExteriorFinalizarGestionDespacho() {
			return DB::select('call api_ots_exterior_gestion_dspacho_factura_finaliza( )' );
	}

  public static function getMaderaWebOts ( $IdMaquina, $IdSustrato){
		return DB::select('call web_ots_config_madera_consulta(?,? )', array( $IdMaquina, $IdSustrato) );
	}

	public static function getLaboresPorEstiloTipoTrabajo() {
		return DB::select('call labores_por_estilo_trabajo_consulta_x_estilo_trabajo(?,? )', array( 1, 1) );
		
	}
	public function estilos_trabajo()
	{
		return $this->belongsTo(EstilosTrabajo::class, 'idestilotrabajo');
	}

	public function grados_dificultad()
	{
		return $this->belongsTo(GradosDificultad::class, 'idgradodificultad');
	}

	public function ordenes_trabajo_motivos_reproceso()
	{
		return $this->belongsTo(OrdenesTrabajoMotivosReproceso::class, 'id_motivo_reproceso');
	}

	public function tipos_despacho()
	{
		return $this->belongsTo(TiposDespacho::class, 'id_tipo_despacho');
	}

	public function tercero()
	{
		return $this->belongsTo(Tercero::class, 'idtercero');
	}

	public function sucursale()
	{
		return $this->belongsTo(Sucursale::class, 'idsucursal');
	}

	public function tipos_trabajo()
	{
		return $this->belongsTo(TiposTrabajo::class, 'idtipotrabajo');
	}

	public function ordenes_trabajo_costos()
	{
		return $this->hasMany(OrdenesTrabajoCosto::class, 'idregistro_ot');
	}

	public function ordenes_trabajo_costos_conceptos_valores()
	{
		return $this->hasMany(OrdenesTrabajoCostosConceptosValore::class, 'idregistro_ot');
	}

	public function ordenes_trabajo_fechas_procesos()
	{
		return $this->hasMany(OrdenesTrabajoFechasProceso::class, 'idregistro_ot');
	}

	public function labores()
	{
		return $this->belongsToMany(Labore::class, 'ordenes_trabajo_labores', 'idregistro_ot', 'idlabor')
					->withPivot('idregistro_labores', 'idtercero', 'fecha_hora_inicio', 'fecha_hora_final', 'idtercero_inicia', 'idtercero_finaliza', 'id_motivo_inactiva_ot', 'inicio_trazo_manual', 'ini_lab_simult', 'fin_lab_simult', 'lab_acomp', 'idtercero_acomp', 'duracion', 'minutos_lab_simult', 'tot_minutos', 'idmaquina', 'fecha_hora_inicio_manual', 'fecha_hora_final_manual', 'idtercero_operario_manual', 'fecha_hora_dscga_labor');
	}

	public function materiales()
	{
		return $this->belongsToMany(Materiale::class, 'ordenes_trabajo_materiales_bitacora', 'idregistro_ot', 'idmaterial')
					->withPivot('idregistro_mat', 'costo_inventario', 'cantidad', 'suma_cm_ot', 'pendiente', 'madera_cant_1', 'madera_cant_2', 'marca_material', 'cantreal', 'preciomaterial', 'consumo_estimado', 'id_inconformidad', 'cant_inconformidad', 'fecha');
	}

	public function ordenes_trabajo_planeamiento_pns()
	{
		return $this->hasMany(OrdenesTrabajoPlaneamientoPn::class, 'idregistro_ot');
	}

	public function ordenes_trabajo_secuencia_ruta()
	{
		return $this->hasMany(OrdenesTrabajoSecuenciaRutum::class, 'idregistro_ot');
	}

	public function ordenes_trabajo_secuencia_trazo_calado_doblados()
	{
		return $this->hasMany(OrdenesTrabajoSecuenciaTrazoCaladoDoblado::class, 'idregistro_ot');
	}

	public function ordenes_trabajo_servicios_ordenes_trabajos()
	{
		return $this->hasMany(OrdenesTrabajoServiciosOrdenesTrabajo::class, 'idregistro_ot');
	}

	public function ordenes_trabajo_valores_adicionales()
	{
		return $this->hasMany(OrdenesTrabajoValoresAdicionale::class, 'idregistro_ot');
	}

	public function pqrs()
	{
		return $this->hasMany(Pqr::class, 'idregistro_ot');
	}
}
