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
Auth::routes();


Route::middleware(['auth'])->group(function() {
Route::get('/', 'DashboardController@index');

Route::get('/archiwum', 'ArchiwumController@index');
Route::get('/zamowienia-archiwum', 'ArchiwumController@zamowienia');
Route::get('/archiwum/{id}', 'ArchiwumController@show');
Route::get('/archiwalne_zamowienie/{id}', 'ArchiwumController@zamowienie');
Route::get('/kategorie-archiwum', 'CategoryController@archiwum');
Route::get('/kategorie-archiwum/{id}', 'CategoryController@archiwum_old_products');
Route::get('/produkty-archiwum', 'ProduktController@old_index');
Route::delete('/archiwum/{id}', 'ArchiwumController@forceDelete');
Route::delete('/zamowienia-archiwum/{id}', 'ArchiwumController@destroy');
Route::delete('/kategorie-archiwum/{id}', 'CategoryController@forceDelete');
Route::delete('/produkty-archiwum/{id}', 'ProduktController@forceDelete');

Route::get('/kategorie', 'CategoryController@index');
Route::get('/kategorie/nowa', 'CategoryController@create');
Route::get('/kategorie/{id}/edit', 'CategoryController@edit');
Route::get('/kategorie/{id}', 'CategoryController@show');
Route::put('/kategorie/{id}', 'CategoryController@update');
Route::post('/kategorie/nowa', 'CategoryController@store');
Route::delete('/kategorie/{id}', 'CategoryController@destroy');

Route::post('/products/{id}/create', 'ProduktController@create');

Route::get('/klienci', 'KlientController@index');
Route::get('/klienci/nowy', 'KlientController@create');
Route::get('/klienci/{id}', 'KlientController@show');
Route::put('/klienci/{id}', 'KlientController@update');
Route::get('/klienci/{id}/edit', 'KlientController@edit');
Route::post('/klienci/nowy', 'KlientController@store');
Route::delete('/klienci/{id}', 'KlientController@destroy');

Route::get('/zamowienia', 'ZamowienieController@index');
Route::get('/zamowienia/nowe', 'ZamowienieController@create');
Route::get('/zamowienia/{id}', 'ZamowienieController@show');
Route::get('/zamowienia/{id}/edit', 'ZamowienieController@edit');
Route::put('/zamowienia/{id}', 'ZamowienieController@update');
Route::delete('/zamowienia/{id}', 'ZamowienieController@destroy');

Route::get('/sprzedaz', 'SprzedazController@index');
Route::get('/sprzedaz/{id}', 'SprzedazController@show');
Route::get('/zamowienie/{id}', 'SprzedazController@zamowienie');

Route::get('/pracownicy', 'PracownicyController@index');
Route::get('/rozliczenia/{id}', 'PracownicyController@show');
Route::post('/pracownicy', 'PracownicyController@store');
Route::get('pracownicy/{id}/edit', 'PracownicyController@edit');
Route::put('pracownicy/{id}', 'PracownicyController@update');
Route::delete('/pracownicy/{id}', 'PracownicyController@destroy');

Route::post('/rozliczenia', 'RozliczeniaController@store');
Route::delete('/rozliczenia/{id}', 'RozliczeniaController@destroy');

Route::get('/zadania/{id}', 'ZadaniaController@index');
Route::get('/zadania/{id}/nowe', 'ZadaniaController@create');
Route::post('/zadania/{id}', 'ZadaniaController@store');
Route::delete('/zadania/{id}', 'ZadaniaController@destroy');

Route::get('/oferta', 'OfertaController@index');
Route::get('/oferta/{id}', 'OfertaController@show');

Route::get('/changePassword','ProfilController@showChangePasswordForm');
Route::post('/changePassword','ProfilController@changePassword')->name('changePassword');
Route::get('/profil', 'ProfilController@profile');
Route::post('/profil', 'ProfilController@update_avatar');

//Route::get('/sprzedaz/{id}/PDF', function () {return view('/sprzedaz/{id}/PDF');});
Route::get('/sprzedaz/{id}/PDF', 'PdfController@pdf');
Route::get('/oferta/{id}/PDF', 'PdfController@oferta');

Route::resource('products', 'ProduktController');
});
//Route::resource('kategorie', 'CategoryController');