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
    return view('welcome');
});
Route::get('/test',function(){
    return 'Hello World';
});

   // redirect dari /lempar ke /test
Route::redirect('/lempar','/test');

// fallback jika routes tidak ada
Route::fallback(function(){
    return '404 - Halaman Tidak ditemukan';
});

// menampilkan view cara 1 langsung
Route::view('/hello','hello',['name' => 'Dede']);

// menampilkan view cara 2 dengan closure
Route::get('/hello-again',function(){
    return view('hello',['name' =>'Dede']);
});

// view dalam folder (nested view), akses nested view bukan pakai slash (/) tapi pakai titik (.)
// bukan hello/world tapi hello.world
Route::get('/halo',function(){
    return view('hello.world',['name' =>'Dede']);
});