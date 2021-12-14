<?php

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
    return view('index');
});

Route::resource('anggota', 'AnggotaController');
Route::resource('buku', 'BukuController');
Route::resource('kategori', 'KategoriController');
Route::resource('pinjam', 'PinjamController');

Route::get('pinjam/edit/{id}', 'PinjamController@edit');
Route::get('pinjam/showBuku/{id}', 'PinjamController@showBuku');
Route::get('pinjam/getAnggota/{id}', 'PinjamController@getAnggota');
Route::get('/pinjam/update/{id}', 'PinjamController@update');

