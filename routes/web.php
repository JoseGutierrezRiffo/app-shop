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

Route::get('/', 'TestController@welcome');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');





Route::middleware(['auth','admin'])->prefix('admin')->group(function () {

		Route::get('/products', 'ProductController@index'); // usuario accede al listado. (LISTADO)
		Route::get('/products/create', 'ProductController@create'); // usuario presiona un boton para crear un nuevo producto. (FORMULARIO)
		Route::post('/products', 'ProductController@store'); // usuario presiona el boton de registrar producto que esta en el formulario que antes vio. (REGISTRAR)
		Route::get('/products/{id}/edit', 'ProductController@edit'); // formulario de edicion de productos
		Route::post('/products/{id}/edit', 'ProductController@update'); // actualizar los datos del producto seleccionado
		Route::delete('/products/{id}', 'ProductController@destroy'); // eliminar
		
		
		Route::get('/products/{id}/images', 'ImageController@index'); // listar
		Route::post('/products/{id}/images', 'ImageController@store'); // registrar
		Route::delete('/products/{id}/images', 'ImageController@destroy'); // eliminar
});







