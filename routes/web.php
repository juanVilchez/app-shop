<?php

Route::get('/', 'TestController@welcome');


Auth::routes();

Route::get('/search', 'SearchController@show');//Buscar producto
Route::get('/products/json', 'SearchController@data');//json de buscar productos

Route::get('/home', 'HomeController@index')->name('home');
Route::get('/products/{id}', 'ProductController@show');//ver productos
Route::get('/categories/{category}', 'CategoryController@show');//Ver categoria en el home

Route::post('/cart', 'CartDetailController@store');//insertar detalle
Route::delete('/cart', 'CartDetailController@destroy');//eliminar detalle

Route::post('/order', 'CartController@update');//insertar detalle

Route::middleware(['auth','admin'])->prefix('admin')->namespace('Admin')->group(function () {
	//CRUD Productos
    Route::get('/products', 'ProductController@index'); //listado:get
	Route::get('/products/create', 'ProductController@create'); //crear:get -formulario
	Route::post('/products', 'ProductController@store'); //guardarmos:post-registrar
	Route::get('/products/{id}/edit', 'ProductController@edit'); //crear:get -formulario edicion
	Route::post('/products/{id}/edit', 'ProductController@update'); //guardarmos:post-actualizar
	Route::delete('/products/{id}', 'ProductController@destroy'); //crear:get -formulario eliminar

	//CRUD Imagenes
	Route::get('/products/{id}/images', 'ImageController@index'); //listado:get
	Route::post('/products/{id}/images', 'ImageController@store'); //guardarmos:post-registrar
	Route::delete('/products/{id}/images', 'ImageController@destroy'); //crear:get -formulario eliminar

	//IMG destacada
	Route::get('/products/{id}/images/select/{image}', 'ImageController@select'); //listado:get

	//CRUD Categoria
    Route::get('/categories', 'CategoryController@index'); //listado:get
	Route::get('/categories/create', 'CategoryController@create'); //crear:get -formulario
	Route::post('/categories', 'CategoryController@store'); //guardarmos:post-registrar
	Route::get('/categories/{category}/edit', 'CategoryController@edit'); //crear:get -formulario edicion
	Route::post('/categories/{category}/edit', 'CategoryController@update'); //guardarmos:post-actualizar
	Route::delete('/categories/{category}', 'CategoryController@destroy'); //crear:get -formulario eliminar

});



