<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AlbumsController;

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

Route::get('/', [AlbumsController::class, 'index'])->name('album.index');
Route::get('/create', [AlbumsController::class, 'create'])->name('album.create');
Route::post('index', [AlbumsController::class, 'storeMedia'])->name('album.storeMedia');
Route::post('album/media', [AlbumsController::class, 'storeMedia'])->name('album.storeMedia');
Route::post('album/store', [AlbumsController::class, 'store'])->name('album.store');
Route::get('/album/edit/{id}', [AlbumsController::class, 'edit'])->name('album.edit');
Route::post('/album/update/{album}', [AlbumsController::class, 'update'])->name('album.update');
Route::get('/album/show/{album}', [AlbumsController::class, 'show'])->name('album.show');
Route::get('/album/delete/{album}/{id}', [AlbumsController::class, 'delete'])->name('album.delete');
Route::post('/album/move', [AlbumsController::class, 'move'])->name('album.move');
Route::get('/album/show-move/{album}/{id}', [AlbumsController::class, 'ShowMove'])->name('album.show.move');
Route::get('/gallary/delete/{id}', [AlbumsController::class, 'DeleteAlbum'])->name('galary.delete');
Route::post('/album/move-all', [AlbumsController::class, 'MoveAlbum'])->name('album.move.all');


