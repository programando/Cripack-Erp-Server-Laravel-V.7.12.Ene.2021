<?php
/* DB::listen(function($query) {
echo "<pre>{$query->sql} - {$query->time}</pre>";
});
   */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
 
Route::group(['prefix' => 'agendamiento/'], function () {
    Route::post('asistencia'            , 'AgendaAsstnciaMqunasController@consultaAgendaMesAnio') ;
    Route::get('aprobados-enviar-email', 'AgendaAsstnciaMqunasController@aprobadasEnviarEmail');
});

 
Route::group(['prefix' => 'SqlServer/'], function () {
    Route::post('cartera'            , 'SqlServerBiableCarteraClientesController@carterNitTercero') ;
});




Route::group(['prefix' => 'motivos/visitas/'], function () {
    Route::get('listado'            , 'MotivosVisitasController@getMotivosVistas') ;

});

Route::group(['prefix' => 'solicitudes/ots/'], function () {
    Route::get('ayuda-pega'               , 'WebOtsAyudapegaController@getAyudaPega') ;
    Route::get('calibres'                 , 'WebOtsCalibreController@getCalibres') ;
    Route::get('frecuencias'              , 'WebOtsFrecuenciaController@getFrecuencias') ;
    Route::get('maquinas'                 , 'WebOtsMaquinaController@getMaquinas') ;
    Route::get('punzones'                 , 'WebOtsPunzonesController@getPunzones') ;
    Route::get('sustratos'                , 'WebOtsSustratoController@getSustratos') ;
    Route::get('tipos/arreglo'            , 'WebOtsTpArregloController@getTiposArreglos') ;
    Route::get('tirajes'                  , 'WebOtsTirajeController@getTirajes') ;
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
    Route::get ('registro/pendiente'         , $localController.'searchContactsWithOutWebRegister')->name('otsCustomerRegister') ;
    Route::post ('registro/save'    , $localController.'contactWebRegister')->name('contactWebRegister') ;
    Route::post ('contacto'        , $localController.'contactMessage')->name('contactMessage') ;
});


Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 



Route::group(['prefix' => 'ordenes-trabajo/'], function () {
    $localController = 'OrdenesTrabajo'; 
    Route::get('exterior'                   , $localController . 'Controller@delExteriorIniciarGestionDespacho') ;
    Route::post('solicitud/plano'            , $localController . 'ControllerTroquelPlano@troquelPlano') ;
});

Route::group(['prefix' => 'braile/'], function () {
    $localController = 'BrailleTextosAnalisisController@'; 
    Route::post('transcripcion/textos'                  , $localController . 'transcripcionTextos') ;
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
