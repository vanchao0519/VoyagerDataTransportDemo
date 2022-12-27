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


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});

Route::group(['prefix' => 'admin'], function () {
    Route::get('/import_posts', [App\VoyagerDataTransport\Http\Controllers\ImportPosts::class, 'index'])->name('voyager.browse_import_posts')->middleware('admin.user');
    Route::get('/export_posts', [App\VoyagerDataTransport\Http\Controllers\ExportPosts::class, 'export'])->name('voyager.browse_export_posts')->middleware('admin.user');
    Route::post('/import_posts/upload', [App\VoyagerDataTransport\Http\Controllers\ImportPosts::class, 'upload'])->name('voyager.import_posts.upload')->middleware('admin.user');
});
