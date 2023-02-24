<?php
use Illuminate\Support\Facades\Route;
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
Route::get('/api/contacto-data', 'App\Http\Controllers\ContactoFormController@index');

Route::post('/api/sendPasswordResetLink', 'App\Http\Controllers\PasswordResetRequestController@sendEmail');
Route::post('/api/resetPassword', 'App\Http\Controllers\ChangePasswordController@passwordResetProcess');


