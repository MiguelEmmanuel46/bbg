<?php

use Illuminate\Support\Facades\Route;
use App\Mail\Contacto;
//use Illuminate\Support\Facades\Mail;

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

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

/* Route::get('/pruebas/{nombre?}',function($nombre =null)
  {
  $texto='<h2>Texto de prueba</h2>';
  $texto.='Nombre: '.$nombre;

  return view('pruebas',array(
  'texto' => $texto
  ));
  }); */


Route::get('/animales', 'App\Http\Controllers\PruebasController@index');
Route::get('/test-orm', 'App\Http\Controllers\PruebasController@testOrm');

//RUTAS DEL API
Route::get('/user/pruebas', 'App\Http\Controllers\UserController@pruebas');
Route::get('/contacto/pruebas', 'App\Http\Controllers\ContactoController@pruebas');

///rutas si sirven controlador usuarios
Route::post('/api/register', 'App\Http\Controllers\UserController@register');
Route::post('/api/login', 'App\Http\Controllers\UserController@login');
Route::put('/api/user/update', 'App\Http\Controllers\UserController@update');
Route::get('/api/user/detail/{id}', 'App\Http\Controllers\UserController@detail');


//rutas del controlador de servicios
Route::resource('/api/servicios', 'App\Http\Controllers\ServiciosController');

//rutas del controlador de contactop
Route::resource('/api/contacto', 'App\Http\Controllers\ContactoController');

Route::post('/api/contacto-formulario', 'App\Http\Controllers\FormularioController@index');

/*
Route::get('/api/contacto-formulario', function(){
    $response = Mail::mailer("smtp")->to('contacto@bsgl.mx')->send(new Contacto("Mí ñómbre", "popo2@gmail.com", "2225722956", "Quiero informacion de bancos de p"));

    var_dump($response);
});*/