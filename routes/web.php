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

/*Route::get('/', function () {
    return view('welcome');
});*/

Route::get('/', [App\Http\Controllers\WelcomeController::class, 'index'])->name('welcome');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/account', [App\Http\Controllers\AccountController::class, 'index'])->name('account');

Route::get('/rappers', [App\Http\Controllers\RappersController::class, 'index'])->name('rappers');
Route::get('/rcreate', [App\Http\Controllers\RappersController::class, 'create'])->name('rcreate');
Route::post('/rcreate', [App\Http\Controllers\RappersController::class, 'store'])->name('rstore');
Route::get('/redit/{id}', [App\Http\Controllers\RappersController::class, 'edit'])->name('redit');
Route::get('/rdelete/{id}', [App\Http\Controllers\RappersController::class, 'destroy'])->name('rdelete');
Route::post('/rupdate/{id}', [App\Http\Controllers\RappersController::class, 'update'])->name('rupdate');
Route::get('/rshow/{id}', [App\Http\Controllers\RappersController::class, 'show'])->name('rshow');

Route::get('/albums', [App\Http\Controllers\AlbumsController::class, 'index'])->name('albums');
Route::get('/acreate', [App\Http\Controllers\AlbumsController::class, 'create'])->name('acreate');
Route::post('/acreate', [App\Http\Controllers\AlbumsController::class, 'store'])->name('astore');
Route::get('/aedit/{id}', [App\Http\Controllers\AlbumsController::class, 'edit'])->name('aedit');
Route::get('/adelete/{id}', [App\Http\Controllers\AlbumsController::class, 'destroy'])->name('adelete');
Route::post('/aupdate/{id}', [App\Http\Controllers\AlbumsController::class, 'update'])->name('aupdate');
Route::get('/ashow/{id}', [App\Http\Controllers\AlbumsController::class, 'show'])->name('ashow');

Route::get('/changepassword', [App\Http\Controllers\ChangePasswordController::class, 'index'])->name('changepassword');
Route::post('/changepassword', [App\Http\Controllers\ChangePasswordController::class, 'store'])->name('changepass');
Route::get('/changeemail', [App\Http\Controllers\ChangeEmailController::class, 'index'])->name('changeemail');
Route::post('/changeemail', [App\Http\Controllers\ChangeEmailController::class, 'store'])->name('changemail');
Route::get('/changeusername', [App\Http\Controllers\ChangeUsernameController::class, 'index'])->name('changeusername');
Route::post('/changeusername', [App\Http\Controllers\ChangeUsernameController::class, 'store'])->name('changename');

Route::get('/search', [App\Http\Controllers\SearchController::class, 'index'])->name('search');

Route::get('/rapperlist', [App\Http\Controllers\RapperListController::class, 'index'])->name('rapperlist');
Route::get('/rapperlist/{name}', [App\Http\Controllers\RapperListController::class, 'show'])->name('rapperlist');
Route::get('/albumlist', [App\Http\Controllers\AlbumListController::class, 'index'])->name('albumlist');
Route::get('/albumlist/{name}', [App\Http\Controllers\AlbumListController::class, 'show'])->name('albumlist');