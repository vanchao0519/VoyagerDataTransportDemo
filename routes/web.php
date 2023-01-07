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
    $configs = require  dirname(__DIR__, 1) . "/app/VoyagerDataTransport/config/route/config.php";
    foreach ($configs as $config) {
        foreach ($config as $verb => $dataSets) {
            $verb = strtolower($verb);
            if (in_array($verb, ['get', 'post'])) {
                foreach ($dataSets as $dataSet) {
                    Route::$verb( $dataSet['url'], [
                        $dataSet['controllerName'],
                        $dataSet['actionName']
                    ])
                        ->name($dataSet['alias'])
                        ->middleware('admin.user');
                }
            }
        }
    }

});
