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


Route::get('/', function () {
  return view('auth/login');
});


// Route::get('/', 'Auth\LoginController@login');

Auth::routes();
Route::post('/login', 'Auth\LoginController@authenticate');
Route::get('/logout', 'Auth\LoginController@logout');

Route::get('/home', 'HomeController@index')->middleware('auth');

// Admin User
Route::get('/admin/usuarios', 'UserController@index')->middleware('auth');
Route::get('/admin/usuarios/nuevo', 'UserController@create')->middleware('auth');
Route::post('/admin/usuarios/nuevo', 'UserController@store')->middleware('auth');
Route::get('/admin/usuarios/actualizar/{id}', 'UserController@edit')->middleware('auth');
Route::post('/admin/usuarios/actualizar/{id}', 'UserController@update')->middleware('auth');

// Admin Client
Route::get('/admin/clientes', 'ClientController@index')->middleware('auth');
Route::get('/admin/clientes/nuevo', 'ClientController@create')->middleware('auth');
Route::post('/admin/clientes/nuevo', 'ClientController@store')->middleware('auth');
Route::get('/admin/clientes/actualizar/{id}', 'ClientController@edit')->middleware('auth');
Route::post('/admin/clientes/actualizar/{id}', 'ClientController@update')->middleware('auth');

// Admin Brand
Route::get('/admin/marcas', 'BrandController@index')->middleware('auth');
Route::get('/admin/marcas/nuevo', 'BrandController@create')->middleware('auth');
Route::post('/admin/marcas/nuevo', 'BrandController@store')->middleware('auth');
Route::get('/admin/marcas/actualizar/{id}', 'BrandController@edit')->middleware('auth');
Route::post('/admin/marcas/actualizar/{id}', 'BrandController@update')->middleware('auth');

// Admin Contact
Route::get('/admin/contactos', 'ContactController@index')->middleware('auth');
Route::get('/admin/contactos/nuevo', 'ContactController@create')->middleware('auth');
Route::post('/admin/contactos/nuevo', 'ContactController@store')->middleware('auth');
Route::get('/admin/contactos/actualizar/{id}', 'ContactController@edit')->middleware('auth');
Route::post('/admin/contactos/actualizar/{id}', 'ContactController@update')->middleware('auth');

// Admin Vars
Route::get('/admin/variables', 'VariableController@index')->middleware('auth');
Route::get('/admin/variables/nuevo', 'VariableController@create')->middleware('auth');
Route::post('/admin/variables/nuevo', 'VariableController@store')->middleware('auth');
Route::get('/admin/variables/actualizar/{id}', 'VariableController@edit')->middleware('auth');
Route::post('/admin/variables/actualizar/{id}', 'VariableController@update')->middleware('auth');

// Budget
Route::get('/cotizaciones', 'BudgetController@index')->middleware('auth');
Route::get('/cotizaciones/nuevo', 'BudgetController@create')->middleware('auth');
Route::post('/cotizaciones/nuevo', 'BudgetController@store')->middleware('auth');
Route::get('/cotizaciones/actualizar/{id}', 'BudgetController@edit')->middleware('auth');
Route::post('/cotizaciones/actualizar/{id}', 'BudgetController@update')->middleware('auth');
Route::get('/cotizaciones/imprimir/{id}', 'BudgetController@show')->middleware('auth');
Route::get('/cotizaciones/duplicar/{id}', 'BudgetController@duplicate')->middleware('auth');

// Bill
Route::get('/facturas', 'BillController@index')->middleware('auth');
Route::get('/facturas/nuevo/{id}', 'BillController@create')->middleware('auth');
Route::post('/facturas/nuevo', 'BillController@store')->middleware('auth');
Route::get('/facturas/actualizar/{id}', 'BillController@edit')->middleware('auth');
Route::post('/facturas/actualizar/{id}', 'BillController@update')->middleware('auth');
Route::get('/facturas/imprimir/{id}', 'BillController@show')->middleware('auth');

// Notes
Route::get('/notas', 'NoteController@index')->middleware('auth');
Route::get('/notas/nuevo/{id}', 'NoteController@create')->middleware('auth');
Route::post('/notas/nuevo/{id}', 'NoteController@store')->middleware('auth');
Route::get('/notas/detalle/{id}', 'NoteController@show')->middleware('auth');
Route::get('/notas/imprimir/{id}', 'NoteController@showPrint')->middleware('auth');
