<?php

use App\Http\Controllers\CookieController;
use App\Http\Controllers\FileController;
use App\Http\Controllers\FormController;
use App\Http\Controllers\HelloController;
use App\Http\Controllers\InputController;
use App\Http\Controllers\RedirectController;
use App\Http\Controllers\ResponseController;
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
Route::get('/test', function () {
    return 'Hello World';
});

// redirect dari /lempar ke /test
Route::redirect('/lempar', '/test');

// fallback jika routes tidak ada
Route::fallback(function () {
    return '404 - Halaman Tidak ditemukan';
});

// menampilkan view cara 1 langsung
Route::view('/hello', 'hello', ['name' => 'Dede']);

// menampilkan view cara 2 dengan closure
Route::get('/hello-again', function () {
    return view('hello', ['name' => 'Dede']);
});

// view dalam folder (nested view), akses nested view bukan pakai slash (/) tapi pakai titik (.)
// bukan hello/world tapi hello.world
Route::get('/halo', function () {
    return view('hello.world', ['name' => 'Dede']);
});

// route parameter
// id = any
Route::get('/products/{id}', function ($productId) {
    return "Product Id : $productId";
});

Route::get('/products/{product}/items/{item}', function ($productId, $itemId) {
    return 'product : ' . $productId . '| items : ' . $itemId;
});

// route menggunakan Regex 
// id hanya angka
// kalo bukan angka otomatis masuk ke fallback
Route::get('/items/{id}', function ($itemId) {
    return "item ID : $itemId";
})->where('id', '[0-9]+');

// optional route parameter, isi tanda tanya (?)
// jika optional maka harus ada nilai defaultnya
Route::get('/categories/{id?}', function ($defaultId = '404') {
    return "category : $defaultId";
});

/**
 * ----routes conflict----- : jika ada routes yang sama, maka yg dijalankan adalah rout yang lebih dulu dibuat (yang diatas)
 */
Route::get('/conflict/{name}', function ($name) {
    return "Product : $name";
});

// ini gak akan jalan
Route::get('/conflict/susu', function () {
    return "Product : Susu";
});

// named route
// cara buatnya
Route::get('/user/{id}', function ($userId) {
    return "User : $userId";
})->where('id', '[0-9]+')->name('user.detail');

// cara pakek nya
Route::get('/pengguna/{id}', function ($id) {
    $link = route('user.detail', ['id' => $id]);
    return "link : $link";
});

Route::get('/pengguna-redirect/{id}', function ($userId) {
    return redirect()->route('user.detail', ['id' => $userId]);
});

// route ke Controller
// App\Http\Controllers\HelloController::class itu nama Controller
//  'hello' itu Methodnya
// route param {name} otomatis akan dikirim ke controller HelloController method hello sbg parameter 
Route::get('/hello/{name}', [App\Http\Controllers\HelloController::class, 'hello']);

// bisa spt dbawah ini tapi ingat di atas use App\Http\Controllers\HelloController;
Route::get('/say/{name}', [HelloController::class, 'hello']);

// request
Route::get('/request', [HelloController::class, 'request']);

// request input
Route::get('/say-hello', [InputController::class, 'sayHello']);
Route::post('/say-hello', [InputController::class, 'sayHello']);

// request Nested Input
Route::post('/hello-first', [InputController::class, 'helloFirstName']);

// get all input
Route::post('/hello-input', [InputController::class, 'helloInput']);

// get value name di array product
Route::post('/input-array', [InputController::class, 'helloArray']);

Route::post('/input/input-type', [InputController::class, 'inputType']);
Route::post('/input/filter-only', [InputController::class, 'filterOnly']);
Route::post('/input/filter-except', [InputController::class, 'filterExcept']);
Route::post('/input/filter-merge', [InputController::class, 'filterMerge']);
Route::post('/input/filter-merge-nest', [InputController::class, 'filterMergeNested']);

// file upload
Route::post('/file/upload', [FileController::class, 'upload']);

// response
Route::get('/response/hello', [ResponseController::class, 'response']);
Route::get('/response/header', [ResponseController::class, 'header']);

// // response type
// Route::get('/response/type/view', [ResponseController::class, 'responseView']);
// Route::get('/response/type/json', [ResponseController::class, 'responseJson']);
// Route::get('/response/type/file', [ResponseController::class, 'responseFile']);
// Route::get('/response/type/download', [ResponseController::class, 'responseDownload']);

// cookie
Route::get('/cookie/set', [CookieController::class, 'createCookie']);
Route::get('/cookie/get', [CookieController::class, 'getCookie']);
Route::get('/cookie/clear', [CookieController::class, 'clearCookie']);

// redirect
Route::get('/redirect/to', [RedirectController::class, 'redirectTo']);
Route::get('/redirect/from', [RedirectController::class, 'redirectFrom']);

// redirect to named route
Route::get('/redirect/name', [RedirectController::class, 'redirectName']);
Route::get('/redirect/name/{name}', [RedirectController::class, 'redirectHello'])->name('redirect-hello');

// redirect to controller action 
// WALAUPUN REDIRECT KE CONTROLLER, CONTROLLER TUJUAN HARUS TETAP DIDAFTARKAN DI ROUTE EX: redirect-hello ROUTE
Route::get('/redirect/action', [RedirectController::class, 'redirectAction']);

// redirect to external domain
Route::get('/redirect/away', [RedirectController::class, 'redirectAway']);

// middleware
// 'contoh' adalah alias yg ambil dari $routeMiddleware di Kernel.php di folder Http
// titik di (:) setelah contoh berarti ada parameter yg dikirim ke ContohMiddleware.php
// untuk dibawah berarti ada 2 parameter yang dikirim yaitu EKA dan 401
Route::get('/middleware/api', function () {
    return 'OK';
})->middleware(['contoh:EKA,401']);

// group middleware
Route::get('/middleware/group', function () {
    return 'Group';
})->middleware(['contohGroup']);

// file upload with exclude middleware
Route::post('/file/upload', [FileController::class, 'upload'])
    ->withoutMiddleware(\App\Http\Middleware\VerifyCsrfToken::class);

// CSRF
Route::get('/form', [FormController::class, 'form']);
Route::post('/form', [FormController::class, 'submitForm']);

// response type with group route
Route::prefix('/response/type')->group(function () {
    Route::get('/view', [ResponseController::class, 'responseView']);
    Route::get('/json', [ResponseController::class, 'responseJson']);
    Route::get('/file', [ResponseController::class, 'responseFile']);
    Route::get('/download', [ResponseController::class, 'responseDownload']);
});

// contoh route middleware
Route::middleware(['contoh:EKA,401'])->group(function () {
    Route::get('/middleware/api', function () {
        return 'OK';
    });
    Route::get('/middleware/group', function () {
        return 'Group';
    });
});

// contoh route controller
Route::controller(CookieController::class)->group(function () {
    Route::get('/cookie/set', 'createCookie');
    Route::get('/cookie/get', 'getCookie');
    Route::get('/cookie/clear', 'clearCookie');
});

// contoh multiple route group
Route::middleware(['contph:EKA,401'])->prefix('/middleware')->group(function () {
    Route::get('/api', function () {
        return 'OK';
    });
    Route::get('/group', function () {
        return 'Group';
    });
});
