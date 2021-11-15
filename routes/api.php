<?php
/* DB::listen(function($query) {
echo "<pre>{$query->sql} - {$query->time}</pre>";
});
   */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 

Route::group(['prefix' => 'solicitudes/ots/'], function () {
    Route::get('tipos/arreglo'            , 'WebOtsTpArregloController@getTiposArreglos') ;
    Route::get('sustratos'                , 'WebOtsSustratoController@getSustratos') ;
    Route::get('calibres'                 , 'WebOtsCalibreController@getCalibres') ;
    Route::get('tirajes'                  , 'WebOtsTirajeController@getTirajes') ;
    Route::get('frecuencias'              , 'WebOtsFrecuenciaController@getFrecuencias') ;
    Route::get('maquinas'                 , 'WebOtsMaquinaController@getMaquinas') ;
    Route::get('ayuda-pega'               , 'WebOtsAyudapegaController@getAyudaPega') ;
    Route::get('punzones'                 , 'WebOtsPunzonesController@getPunzones') ;
});

 
Route::group(['prefix' => 'cotizaciones/'], function () {
    $localController = 'CotizacionesController@'; 
    Route::get('notificaciones/pendientes'            , $localController.'notificacionesPendientes') ;
    Route::get('rechazar'                             , $localController.'rechazarCotizacion') ;
    Route::get('aprobada/{Id_Ctz_Dt}'                 , $localController.'aprobada') ;
    Route::get('en-estudio/{Id_Ctz_Dt}'               , $localController.'enEstudio') ;
    Route::get('aprobar-todo/{NroCotizacion}'         , $localController.'aprobarTodo') ;
});

Route::group(['prefix' => 'documentacion'], function () {
    $localController = 'DocumentacionProcesosArchivosController@'; 
    Route::get('/'                          , $localController.'getArchivosLecturaWeb') ;
    Route::get('/download/file'      , $localController.'downloadFile') ;
});


Route::group(['prefix' => 'usuarios/'], function () {
    $localController = 'TercerosUsersWebController@';
    Route::post('login'            , $localController.'login')->name('login');
    Route::post('logout'           , $localController.'logout')->name('logout'); 
    Route::post('reset/password'   , $localController.'resetPassword')->name('reset-password'); 
    Route::post('update/password'  , $localController.'updatePassword')->name('update-password'); 
    Route::get ('registro'         , $localController.'searchContactsWithOutWebRegister')->name('otsCustomerRegister') ;
    Route::post ('registro/save'    , $localController.'contactWebRegister')->name('contactWebRegister') ;
    Route::post ('contacto'        , $localController.'contactMessage')->name('contactMessage') ;
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 

//Route::group(['middleware' => ['auth:sanctum'], 'prefix' => 'clientes'], function () {
Route::group(['prefix' => 'clientes/'], function () {
    $localController = 'TercerosController@'; 
    Route::get('ots/historial'                           , $localController.'OrdenesTrabajoCliente') ;
    Route::get('ots/estado'                              , $localController.'OrdenesTrabajoEstadoProduccion') ;
    Route::get('ots/en-aprobacion'                       , $localController.'otsBloqueadasDibEnAprobacion') ;
    Route::post('ots/cotizacion/ot'                       , $localController.'cotizacionGenerarDesdeOT')->name('get-cotizacion-from-ot') ;
    Route::get('bloqueados-cartera'                      , $localController.'bloqueadosPorCartera') ;
    Route::get('bloqueados-cartera/ots/pendientes'       , $localController.'bloqueadosPorCarteraOtsPendientes') ;
    Route::get('bitacora/disenadores'                    , $localController.'bitacoraOtsPorDisenador') ;
    Route::get('solicitud/orden-compra'                   , $localController.'solicitudOrdenesCompraGenerarFactura') ;
});

Route::group(['prefix' => 'ordenes-trabajo/'], function () {
    $localController = 'OrdenesTrabajo'; 
    Route::get('exterior'                   , $localController . 'Controller@delExteriorIniciarGestionDespacho') ;
    Route::post('solicitud/plano'            , $localController . 'ControllerTroquelPlano@troquelPlano') ;
});

Route::group(['prefix' => 'braile/'], function () {
    $localController = 'BrailleTextosAnalisisController@'; 
    Route::post('transcripcion/textos'            , $localController . 'transcripcionTextos') ;
});
 
 

Route::group(['prefix'=>'tcc/'], function() {
    $localController = 'TccRemisionesDespachoController@';
    Route:: get('integrar-guias'                          , $localController.'getDocsToIntegration');
    Route:: get('clientes/notificacion'                    , $localController.'sendCustomerNotification');
    Route:: get('remisiones/pdtes/fecha/entrega'           , $localController.'remisionesPdtesFechaEntregaTcc');
});



/*
Route::get('/sales'            , 'dashBoardController@ventas')->name('ventas');
Route::get('/sales/compare'    , 'dashBoardController@comparativoVentasUltimosTresAnios')->name('compare');
*/
