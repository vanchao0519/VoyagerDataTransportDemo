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

    $routeConfigs = false;
    $configFile = dirname(__DIR__, 1) . "/app/VoyagerDataTransport/config/route/config.php";

    if ( file_exists( $configFile ) ) {
        $routeConfigs = require $configFile;
    }

    $hasRoute = !empty($routeConfigs) && ( count($routeConfigs) > 0 ) ;

    $routeConfigs = $hasRoute ? $routeConfigs : false;

    $regRoute = function ( string $verb, array $dataSets ): void {
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
    };

    if (false !== $routeConfigs) {
        foreach ($routeConfigs as $routeConfig) {
            foreach ($routeConfig as $verb => $dataSets) {
                $regRoute($verb, $dataSets);
            }
        }
    }

});
