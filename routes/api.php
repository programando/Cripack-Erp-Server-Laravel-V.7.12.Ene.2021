<?php

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



Route::post('/login'            , 'TercerosUsersWebController@login')->name('login');
Route::post('/logout'           , 'TercerosUsersWebController@logout')->name('logout'); 

/*Route::post('/reset/password'   , 'TercerosUserController@resetPassword')->name('reset-password'); 
Route::post('/update/password'  , 'TercerosUserController@updatePassword')->name('update-password'); 
*/ 

 Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
}); 


Route::get('/clientes/ots'            , 'TercerosController@OrdenesTrabajoCliente') ;
Route::get('/sales'            , 'dashBoardController@ventas')->name('ventas');
Route::get('/sales/compare'            , 'dashBoardController@comparativoVentasUltimosTresAnios')->name('compare');


Route::group(['prefix'=>'tcc'], function() {
    $localController = 'TccRemisionesDespachoController@';
    Route:: get('/integrar-guias'                          , $localController.'getDocsToIntegration');
    Route:: get('/clientes/notificacion'                    , $localController.'sendCustomerNotification');
});
