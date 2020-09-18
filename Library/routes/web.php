<?php

use Illuminate\Support\Facades\Auth;
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

//Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/', [App\Http\Controllers\HomeController::class, 'index']);

// show books as client
Route::get('/book/client', [App\Http\Controllers\LibraryController::class, 'indexClient'])
    ->middleware('auth');

// show books as admin
Route::get('/book', [App\Http\Controllers\LibraryController::class, 'index'])
    ->middleware(['auth', 'admin:create']);

// show add book view
Route::get('/book/add', [App\Http\Controllers\LibraryController::class, 'addView'])
    ->middleware(['auth', 'admin:create']);

// add book action
Route::post('/book/store', [App\Http\Controllers\LibraryController::class, 'add'])
    ->middleware(['auth', 'admin:create']);

// show save book view
Route::get('/book/save/{book_id}', [App\Http\Controllers\LibraryController::class, 'saveView'])
    ->middleware(['auth', 'admin:update']);

// save book action
Route::post('/book/update/', [App\Http\Controllers\LibraryController::class, 'save'])
    ->middleware(['auth', 'admin:update']);

// delete book action
Route::post('/book/delete/{book_id}', [App\Http\Controllers\LibraryController::class, 'delete'])
    ->middleware(['auth', 'admin:delete']);

// no permission
Route::get('/nopermission', function () {
    return view('nopermission');
});

// download book action
Route::get('/download/{book_id}', [App\Http\Controllers\LibraryController::class, 'download'])
    ->middleware(['auth']);

// show categories
Route::get('/book/category', [App\Http\Controllers\CategoryController::class, 'index'])
    ->middleware(['auth', 'admin:create']);

// show add category view
Route::get('/book/category/add', [App\Http\Controllers\CategoryController::class, 'addView'])
    ->middleware(['auth', 'admin:create']);

// add category action
Route::post('/book/category/store', [App\Http\Controllers\CategoryController::class, 'add'])
    ->middleware(['auth', 'admin:create']);

// show save category view
Route::get('/book/category/save/{category_id}', [App\Http\Controllers\CategoryController::class, 'saveView'])
    ->middleware(['auth', 'admin:update']);

// save category action
Route::post('/book/category/update/', [App\Http\Controllers\CategoryController::class, 'save'])
    ->middleware(['auth', 'admin:update']);

// delete category action
Route::post('/book/category/delete/{category_id}', [App\Http\Controllers\CategoryController::class, 'delete'])
    ->middleware(['auth', 'admin:delete']);
