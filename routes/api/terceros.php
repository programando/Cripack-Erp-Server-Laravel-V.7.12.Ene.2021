<?php
/* DB::listen(function($query) {
echo "<pre>{$query->sql} - {$query->time}</pre>";
});
   */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

//Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'clientes'], function () {
    Route::group(['prefix' => 'clientes/'], function () {
        $localController = 'TercerosController@'; 

        Route::get('bitacora/disenadores'                    , $localController.'bitacoraOtsPorDisenador') ;
        Route::get('bloqueados-cartera'                      , $localController.'bloqueadosPorCartera') ;
        Route::get('bloqueados-cartera/ots/pendientes'       , $localController.'bloqueadosPorCarteraOtsPendientes') ;
        Route::get('cotizaciones'                            , $localController.'cotizacionGenerarDesdeOT')->name('get-cotizacion-from-ot') ;
        Route::get('ots/en-aprobacion'                       , $localController.'otsBloqueadasDibEnAprobacion') ;
        Route::get('solicitud/orden-compra'                  , $localController.'solicitudOrdenesCompraGenerarFactura') ;
        Route::post('busqueda/'                              , $localController.'clientesBuscar') ;
        Route::post('busqueda/codigo'                        , $localController.'buscarClientePorCodigo') ;
        Route::post('busqueda/idtercero'                     , $localController.'buscarClientePorIdTercero') ;
        Route::post('busqueda/por/vendedor'                  , $localController.'clienteBuscarPorVendedor') ;
        Route::post('ots/estado'                             , $localController.'OrdenesTrabajoEstadoProduccion') ;
        Route::post('ots/historial'                          , $localController.'OrdenesTrabajoCliente') ;
        Route::post('primeros/registros'                     , $localController.'primerosVeinteClientes') ;
        Route::post('productos/ultimos/3/anios'              , $localController.'productosUltimos3Anios') ;
        Route::post('ultimas/cinco/compras'                  , $localController.'clienteUltimasCincoCompras') ;
        Route::post('ultimas/visitas'                        , $localController.'clienteUltimasVeinteVisitas') ;
        Route::post('ventas/ultimos/3/anios'                 , $localController.'ventasUltimos3Anios') ;
        Route::post('resumen/dashBoard'                      , $localController.'datosResumenDashBoard') ;
        Route::post('cotizaciones'                           , $localController.'dashBoardCotizacionesUltimos6Meses') ;
        Route::post('ordenes/trabajo'                        , $localController.'dashBoardOrdenesTrabajo') ;
        Route::post('pqrs'                                   , $localController.'dashBoardPqrs') ;
        Route::post('productos/vedidos/ultimos/3/anios'      , $localController.'productosVendidosUltimos3Anios') ;
        Route::post('ventas/grupos/productos'                , $localController.'ventasPorGruposDeProducto') ;
        
    });


    Route::group(['prefix' => 'terceros/clientes'], function () {
        Route::post('visitas/grabar/nuevo-registro'           , 'TercerosVisitasController@grabarNuevaVisita') ;
    });

    Route::group(['prefix' => 'terceros/empleados'], function () {
        Route::get('/evaluacion/desepenio/email'           , 'TercerosEvaluacionDesepenioController@enviarComunicaciones') ;
    });
    Route::group(['prefix' => 'terceros/asistencia'], function () {
        Route::post('/enviar/email/aprobadas'                , 'AgendaAsstnciaMqunasController@aprobadasEnviarEmail') ;
    });
   

?>