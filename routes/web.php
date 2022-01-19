<?php

use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/


Route::get('/', function () {
   return view('welcome');
 
});

Route::get('/trm'            , 'TrmsController@getTrm') ;

Route::get('logs', '\Rap2hpoutre\LaravelLogViewer\LogViewerController@index');


Route::get('enviar', ['as' => 'enviar', function () {
    $data = ['link' => 'http://styde.net'];
    \Mail::send('mails.notificacion', $data, function ($message) {
        $message->from('comunicaciones@cripack.com', 'Cripack');
        $message->to('jhonjamesmg@hotmail.com')->subject('Notificación');
    });
    return "Se envío el email";
}]);
