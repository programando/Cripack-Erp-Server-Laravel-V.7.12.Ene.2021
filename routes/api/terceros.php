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
        Route::get('ots/historial'                           , $localController.'OrdenesTrabajoCliente') ;
        Route::get('ots/estado'                              , $localController.'OrdenesTrabajoEstadoProduccion') ;
        Route::get('ots/en-aprobacion'                       , $localController.'otsBloqueadasDibEnAprobacion') ;
        Route::get('cotizaciones'                            , $localController.'cotizacionGenerarDesdeOT')->name('get-cotizacion-from-ot') ;
        Route::get('bloqueados-cartera'                      , $localController.'bloqueadosPorCartera') ;
        Route::get('bloqueados-cartera/ots/pendientes'       , $localController.'bloqueadosPorCarteraOtsPendientes') ;
        Route::get('bitacora/disenadores'                    , $localController.'bitacoraOtsPorDisenador') ;
        Route::get('solicitud/orden-compra'                  , $localController.'solicitudOrdenesCompraGenerarFactura') ;
        Route::post('primeros/registros'                      , $localController.'primerosVeinteClientes') ;
        Route::post('busqueda/texto'                         , $localController.'clienteBusqueda') ;
        Route::post('busqueda/codigo'                        , $localController.'buscarClientePorCodigo') ;
        Route::post('busqueda/idtercero'                     , $localController.'buscarClientePorIdTercero') ;
        Route::post('ultimas/visitas'                        , $localController.'clienteUltimasVeinteVisitas') ;
        Route::post('ultimas/cinco/compras'                  , $localController.'clienteUltimasCincoCompras') ;
    });

    Route::group(['prefix' => 'terceros/clientes'], function () {
        Route::post('visitas/grabar/nuevo-registro'           , 'TercerosVisitasController@grabarNuevaVisita') ;
    });
?>