<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Session;
use Illuminate\Database\Eloquent\Collection;


class Tercero extends Model
{
	protected $table = 'terceros';
	protected $primaryKey = 'idtercero';
	public $incrementing = false;

	protected $casts = [
		'idtercero' => 'int',
		'idmcipio' => 'int',
		'idmcipio_ced' => 'int',
		'idmcipio_nace' => 'int',
		'idtpdoc' => 'int',
		'idvendedor' => 'int',
		'idformapago' => 'int',
		'idpais' => 'int',
		'idzona_ventas' => 'int',
		'codigo_tercero' => 'float',
		'cliente' => 'bool',
		'proveedor' => 'bool',
		'vendedor' => 'bool',
		'certificado_calidad' => 'bool',
		'comision' => 'float',
		'vr_fletes' => 'float',
		'costo_financiero' => 'float',
		'transportador' => 'bool',
		'empleado' => 'bool',
		'aplica_extras' => 'bool',
		'idcargo' => 'int',
		'salario' => 'float',
		'vr_hora' => 'float',
		'vr_incentivo' => 'float',
		'descarga_materiales' => 'bool',
		'factor_salario' => 'float',
		'factor_transporte' => 'float',
		'inactivo' => 'bool',
		'presupuestoventas' => 'float',
		'incremento_ventas' => 'float',
		'comision_objetivo' => 'float',
		'id_lista_precio' => 'int',
		'cupo_credito' => 'float',
		'extra_cupo' => 'float',
		'cupo_pre_aprobado' => 'bool',
		'dia_limite_recibe_facturas' => 'int',
		'requiere_orden_compra' => 'bool',
		'discrimina_materiales_factura' => 'bool',
		'gran_contribuyente' => 'bool',
		'auto_retenedor' => 'bool',
		'retenedor_iva' => 'bool',
		'retenedor_renta' => 'bool',
		'agrupa_facturacion_estilo_trabajo' => 'bool',
		'idcargo_externo' => 'int',
		'idarea' => 'int',
		'idbanco' => 'int',
		'plazo' => 'int',
		'bloqueado' => 'bool',
		'dias_gracia' => 'int',
		'dia_informa_pagos' => 'int',
		'prioridad_costeo' => 'int',
		'aplica_ferias' => 'bool',
		'reg_ferias' => 'bool',
		'asiste_feria' => 'bool',
		'id_tp_prov' => 'int',
		'agrupa_ot_trazo' => 'bool',
		'seg_social' => 'bool',
		'idtercero_eps' => 'int',
		'idtercero_afp' => 'int',
		'aux_mvlzcion' => 'float',
		'aux_vienda' => 'float',
		'aux_cmuncion' => 'float',
		'aux_estudio' => 'float',
		'id_cls_prvdor' => 'int',
		'id_cndcion_pgo' => 'int',
		'gran_cntrbynte' => 'bool',
		'rtncion_renta' => 'bool',
		'rgmen_smplicdo' => 'bool',
		'exge_ord_cmpra' => 'bool',
		'csto_dsplzmnto' => 'float',
		'intgrdo_cg_1' => 'bool',
		'exig_cotizacion' => 'bool',
		'entrega_niks' => 'bool',
		'exig_vr_gra_oc' => 'bool',
		'comis_vta' => 'float',
		'comis_rcudo' => 'float'
	];

	protected $dates = [
		'fecha_ingreso',
		'ultimo_bloqueo',
		'fecha_nacimiento'
	];

	protected $fillable = [
		'idmcipio',
		'idmcipio_ced',
		'idmcipio_nace',
		'idtpdoc',
		'idvendedor',
		'idformapago',
		'idpais',
		'idzona_ventas',
		'codigo_tercero',
		'identificacion',
		'dv',
		'nomtercero',
		'nom_sucursal',
		'alias',
		'cliente',
		'proveedor',
		'vendedor',
		'direccion',
		'telefono',
		'fax',
		'contacto',
		'email',
		'certificado_calidad',
		'comision',
		'vr_fletes',
		'atencion',
		'cargo',
		'despacho',
		'celular',
		'instrucciones',
		'costo_financiero',
		'transportador',
		'cobros_contacto',
		'cobros_telefono',
		'empleado',
		'cod_empleado',
		'aplica_extras',
		'idcargo',
		'salario',
		'fecha_ingreso',
		'vr_hora',
		'vr_incentivo',
		'password_operario',
		'descarga_materiales',
		'factor_salario',
		'factor_transporte',
		'grupo_sanguineo',
		'inactivo',
		'maquinas',
		'presupuestoventas',
		'id_rgb',
		'incremento_ventas',
		'comision_objetivo',
		'id_lista_precio',
		'cupo_credito',
		'extra_cupo',
		'cupo_pre_aprobado',
		'dia_limite_recibe_facturas',
		'contacto_pagos',
		'contacto_pagos_email',
		'contacto_pagos_celular',
		'requiere_orden_compra',
		'discrimina_materiales_factura',
		'gran_contribuyente',
		'auto_retenedor',
		'retenedor_iva',
		'retenedor_renta',
		'agrupa_facturacion_estilo_trabajo',
		'idcargo_externo',
		'idarea',
		'horario_rbo_mercancia',
		'dia_pago',
		'idbanco',
		'plazo',
		'empleado_abrev',
		'codigo_postal',
		'bloqueado',
		'ultimo_bloqueo',
		'dias_gracia',
		'dia_informa_pagos',
		'cod_cuenta_tcc',
		'fecha_nacimiento',
		'prioridad_costeo',
		'aplica_ferias',
		'reg_ferias',
		'asiste_feria',
		'id_tp_prov',
		'agrupa_ot_trazo',
		'seg_social',
		'nro_cta_banco',
		'idtercero_eps',
		'idtercero_afp',
		'aux_mvlzcion',
		'aux_vienda',
		'aux_cmuncion',
		'aux_estudio',
		'id_cls_prvdor',
		'cod_rte_iva',
		'cod_rte_ica',
		'cod_rte_otros',
		'id_cndcion_pgo',
		'gran_cntrbynte',
		'rtncion_renta',
		'rgmen_smplicdo',
		'exge_ord_cmpra',
		'suc_cg1',
		'csto_dsplzmnto',
		'intgrdo_cg_1',
		'exig_cotizacion',
		'entrega_niks',
		'exig_vr_gra_oc',
		'comis_vta',
		'comis_rcudo'
	];

		public static function getOrdenesTrabajoCliente( $Data ) {
					return DB::select('call api_terceros_consulta_trabajos_x_tercero( ?, ?, ?)', array ($Data->idTercero,$Data->fechaIni, $Data->fechaFin) );
			}

		public static function otsEstadoProduccion ( $idTercero ) {
				// Datos únicos de ls ots del cliente en produccion
			 	return DB::select('call api_ots_estado_produccion_por_idtercero_01( ?)', array ( $idTercero ) );
		 }

	public static function otsEstadoProduccionLaboresOt ( $idRegistroOt  ) {
				// Datos únicos de ls ots del cliente en produccion
			 	return DB::select('call api_ots_estado_produccion_labores_por_ot_02( ?)', array ( $idRegistroOt  ) );
		 }

 
  private static function esUsuarioCripack( $idTercero ) {
 
		if ( boolval ( session('UsuarioCripack')) == true ) return 0;
			return $idTercero;
	}
 
	public function formas_pago()
	{
		return $this->belongsTo(FormasPago::class, 'idformapago');
	}

	public function terceros_proveedores_tipo()
	{
		return $this->belongsTo(TercerosProveedoresTipo::class, 'id_tp_prov');
	}

	public function terceros_areas_empresa()
	{
		return $this->belongsTo(TercerosAreasEmpresa::class, 'idarea');
	}

	public function banco()
	{
		return $this->belongsTo(Banco::class, 'idbanco');
	}

	public function terceros_cargos_externo()
	{
		return $this->belongsTo(TercerosCargosExterno::class, 'idcargo_externo');
	}

	public function municipio()
	{
		return $this->belongsTo(Municipio::class, 'idmcipio');
	}

	public function paise()
	{
		return $this->belongsTo(Paise::class, 'idpais');
	}

	public function zonas_venta()
	{
		return $this->belongsTo(ZonasVenta::class, 'idzona_ventas');
	}

	public function agendas()
	{
		return $this->hasMany(Agenda::class, 'idtercero');
	}

	public function caladora_lasers()
	{
		return $this->hasMany(CaladoraLaser::class, 'idtercero');
	}

	public function capacitaciones()
	{
		return $this->hasMany(Capacitacione::class, 'idtercero');
	}

	public function cotizaciones()
	{
		return $this->hasMany(Cotizacione::class, 'idtercero');
	}

	public function ideas_mejoras()
	{
		return $this->hasMany(IdeasMejora::class, 'idtercero');
	}

	public function inconformidades_planes_accions()
	{
		return $this->hasMany(InconformidadesPlanesAccion::class, 'idtercero');
	}

	public function kardex_ajustes()
	{
		return $this->hasMany(KardexAjuste::class, 'idtercero_realiza');
	}

	public function kardex_hs()
	{
		return $this->hasMany(KardexH::class, 'idtercero');
	}

	public function kardex_h_med_proveedors()
	{
		return $this->hasMany(KardexHMedProveedor::class, 'idtercero');
	}

	public function kardex_med_proveedor_ajustes()
	{
		return $this->hasMany(KardexMedProveedorAjuste::class, 'idtercero_realiza');
	}

	public function kardex_med_proveedor_solicitudes_materiales()
	{
		return $this->hasMany(KardexMedProveedorSolicitudesMateriale::class, 'idtercero_solicita');
	}

	public function kardex_prestamo_materiales()
	{
		return $this->hasMany(KardexPrestamoMateriale::class, 'idtercero');
	}

	public function mantenimiento_activos_fijos()
	{
		return $this->hasMany(MantenimientoActivosFijo::class, 'idresponsable');
	}

	public function mantenimiento_activos_fijos_hojas_de_vidas()
	{
		return $this->hasMany(MantenimientoActivosFijosHojasDeVida::class, 'idtercero');
	}

	public function mantenimiento_bitacora_llamadas()
	{
		return $this->hasMany(MantenimientoBitacoraLlamada::class, 'idtercero');
	}

	public function mantenimiento_registros()
	{
		return $this->hasMany(MantenimientoRegistro::class, 'idtercero');
	}

	public function mensajes_entre_turnos()
	{
		return $this->hasMany(MensajesEntreTurno::class, 'idtercero');
	}

	public function ordenes_compras()
	{
		return $this->hasMany(OrdenesCompra::class, 'idtercero');
	}

	public function ordenes_trabajos()
	{
		return $this->hasMany(OrdenesTrabajo::class, 'idtercero');
	}

	public function ordenes_trabajo_facturas()
	{
		return $this->hasMany(OrdenesTrabajoFactura::class, 'idtercero');
	}

	public function ordenes_trabajo_historial_disenadores()
	{
		return $this->hasMany(OrdenesTrabajoHistorialDisenadore::class, 'idtercero');
	}

	public function ordenes_trabajo_labores()
	{
		return $this->hasMany(OrdenesTrabajoLabore::class, 'idtercero');
	}

	public function ordenes_trabajo_registro_tiempos_procesos()
	{
		return $this->hasMany(OrdenesTrabajoRegistroTiemposProceso::class, 'idtercero');
	}

	public function ordenes_trabajo_traslado_dibujos()
	{
		return $this->hasMany(OrdenesTrabajoTrasladoDibujo::class, 'idtercero');
	}

	public function ordenes_venta()
	{
		return $this->hasMany(OrdenesVentum::class, 'idtercero_usu');
	}

	public function reparaciones_locativas()
	{
		return $this->hasMany(ReparacionesLocativa::class, 'idtercero');
	}

	public function reparaciones_locativas_dts()
	{
		return $this->hasMany(ReparacionesLocativasDt::class, 'idtercero');
	}

	public function requisiciones()
	{
		return $this->hasMany(Requisicione::class, 'idtercero_solicita');
	}

	public function seg_modulos_informes_usuarios()
	{
		return $this->hasMany(SegModulosInformesUsuario::class, 'idtercero');
	}

	public function seg_modulos_opciones_favoritos_x_usuarios()
	{
		return $this->hasMany(SegModulosOpcionesFavoritosXUsuario::class, 'idtercero');
	}

	public function seg_usuarios_sistemas()
	{
		return $this->hasMany(SegUsuariosSistema::class, 'idtercero');
	}

	public function terceros_bitacora_llamadas()
	{
		return $this->hasMany(TercerosBitacoraLlamada::class, 'idtercero');
	}

	public function terceros_bitacora_tareas_pendientes()
	{
		return $this->hasMany(TercerosBitacoraTareasPendiente::class, 'idtercero');
	}

	public function terceros_bloqueados_bitacoras()
	{
		return $this->hasMany(TercerosBloqueadosBitacora::class, 'idtercero');
	}

	public function terceros_contactos()
	{
		return $this->hasMany(TercerosContacto::class, 'idtercero');
	}

	public function terceros_cuchilla_grafas()
	{
		return $this->hasMany(TercerosCuchillaGrafa::class, 'idtercero');
	}

	public function terceros_empleados_grupo_familiars()
	{
		return $this->hasMany(TercerosEmpleadosGrupoFamiliar::class, 'idtercero');
	}

	public function terceros_horas_entradas()
	{
		return $this->hasMany(TercerosHorasEntrada::class, 'idtercero');
	}

	public function terceros_horas_salidas()
	{
		return $this->hasMany(TercerosHorasSalida::class, 'idtercero');
	}

	public function terceros_maderas()
	{
		return $this->hasMany(TercerosMadera::class, 'idtercero');
	}

	public function terceros_maq_registros()
	{
		return $this->hasMany(TercerosMaqRegistro::class, 'idtercero');
	}

	public function terceros_otras_especificaciones()
	{
		return $this->hasMany(TercerosOtrasEspecificacione::class, 'idtercero');
	}

	public function terceros_permisos()
	{
		return $this->hasMany(TercerosPermiso::class, 'idtercero');
	}

	public function terceros_tareas_pdtes_vendedores()
	{
		return $this->hasMany(TercerosTareasPdtesVendedore::class, 'idtercero');
	}

	public function terceros_visitantes_bitac_llamadas()
	{
		return $this->hasMany(TercerosVisitantesBitacLlamada::class, 'idtercero');
	}

	public function terceros_visitantes_ferias()
	{
		return $this->hasMany(TercerosVisitantesFeria::class, 'idtercero');
	}

	public function terceros_visitantes_ferias_estilos_interes()
	{
		return $this->hasMany(TercerosVisitantesFeriasEstilosIntere::class, 'idtercero');
	}

	public function terceros_visitas()
	{
		return $this->hasMany(TercerosVisita::class, 'idtercero');
	}

	public function terceros_web_actividades()
	{
		return $this->hasMany(TercerosWebActividade::class, 'idtercero');
	}

	public function terceros_web_passwords_temporales()
	{
		return $this->hasMany(TercerosWebPasswordsTemporale::class, 'idtercero');
	}

	public function web_msj_bloq_clis()
	{
		return $this->hasMany(WebMsjBloqCli::class, 'idtercero');
	}

	public function web_temp_tablero_ot()
	{
		return $this->hasOne(WebTempTableroOt::class, 'idtercero');
	}
}
