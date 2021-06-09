<?php
/* DB::listen(function($query) {
echo "<pre>{$query->sql} - {$query->time}</pre>";
});
   */

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/
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
    Route::get('bloqueados-cartera'                      , $localController.'bloqueadosPorCartera') ;
    Route::get('bloqueados-cartera/ots/pendientes'       , $localController.'bloqueadosPorCarteraOtsPendientes') ;
});

Route::group(['prefix' => 'ordenes-trabajo/'], function () {
    $localController = 'OrdenesTrabajoController@'; 
    Route::get('exterior'            , $localController.'delExteriorIniciarGestionDespacho') ;
});
 
Route::group(['prefix'=>'tcc/'], function() {
    $localController = 'TccRemisionesDespachoController@';
    Route:: get('integrar-guias'                          , $localController.'getDocsToIntegration');
    Route:: get('clientes/notificacion'                    , $localController.'sendCustomerNotification');
});





/*
Route::get('/sales'            , 'dashBoardController@ventas')->name('ventas');
Route::get('/sales/compare'    , 'dashBoardController@comparativoVentasUltimosTresAnios')->name('compare');
*/
