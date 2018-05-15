<?php

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


Route::get('logout','LoginController@logout');

Route::resource('login','LoginController');

Route::middleware(['auth'])->group(function () {
    Route::get('/', function () {
        return view('layouts.dashboard');
    });
});

Route::middleware(['role:conductor|super-admin','auth'])->group(function () {
    Route::resource('rutas-conductor','RutaConductorController',['names'=>[
        'store' => 'ruta.conductor.store',
        'show' => 'ruta.conductor.show',
        'update' => 'ruta.conductor.update',
        'delete' => 'ruta.conductor.delete'
    ]]);
});

Route::middleware(['role:admin|super-admin','auth'])->group(function () {

    Route::post('validar-acudiente','AcudienteController@validar')->name('acudiente.validar');
    Route::resource('gestion-acudiente','AcudienteController',['names'=>[
        'show' => 'acudiente.show',
        'update' => 'acudiente.update',
    ]]);


    Route::post('validar-usuario','UserController@validar')->name('usuario.validar');
    Route::post('restaurar-usuario/{id}','UserController@restore')->name('usuario.restore');
    Route::resource('gestion-usuarios','UserController',['names'=>[
        'store' => 'usuario.store',
        'show' => 'usuario.show',
        'update' => 'usuario.update',
        'delete' => 'usuario.delete'
    ]]);

    Route::post('validar-arduino','ArduinoController@validar')->name('arduino.validar');
    Route::post('restaurar-arduino/{id}','ArduinoController@restore')->name('arduino.restore');
    Route::resource('gestion-arduinos','ArduinoController',['names'=>[
        'store' => 'arduino.store',
        'show' => 'arduino.show',
        'update' => 'arduino.update',
        'delete' => 'arduino.delete'
    ]]);

    Route::post('validar-zona','ZonaController@validar')->name('zona.validar');
    Route::post('restaurar-zona/{id}','ZonaController@restore')->name('zona.restore');
    Route::resource('gestion-zonas','ZonaController',['names'=>[
        'store' => 'zona.store',
        'show' => 'zona.show',
        'update' => 'zona.update',
        'delete' => 'zona.delete'
    ]]);

    Route::post('validar-ruta','RutaController@validar')->name('ruta.validar');
    Route::post('restaurar-ruta/{id}','RutaController@restore')->name('ruta.restore');
    Route::resource('gestion-rutas','RutaController',['names'=>[
        'store' => 'ruta.store',
        'show' => 'ruta.show',
        'update' => 'ruta.update',
        'delete' => 'ruta.delete'
    ]]);

});

Route::resource('monitoreo','MonitoreoController');

Route::get('reporte-zona','ReporteController@reporteZona')->name('reporte.zona');
Route::resource('reporte','ReporteController');

Route::get('/recibirDatos', function (\Illuminate\Http\Request $request) {
    event(new \App\Events\CapturarRfid(
        $request->arduino_id,
        $request->tarjeta
    ));
});

Route::get('prueba', function (\Illuminate\Http\Request $request) {
    $user = \App\User::findOrFail(6);

    dd($user->hasRutaActiva());
});