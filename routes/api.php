<?php

use Illuminate\Http\Request;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::group(['middleware' => ['verify-ip']], function () {
    Route::post('/elect/area', 'ElectionController@area')->name('elect.area');
    Route::post('/elect/cluster', 'ElectionController@cluster')->name('elect.cluster');
    Route::post('/elect/node', 'ElectionController@node')->name('elect.node');
    Route::post('/mine/block', 'MineController@mine')->name('mine.block');
    Route::post('/chain/header', 'ChainController@sendLeading')->name('chain.header');
    Route::get('/blocks/send', 'BlockController@sendBlocks')->name('blocks.send');

    Route::post('/comp-dump', function () {
        dd(exec('cd .. ; ./composer-cmd.sh'));
    })->name('comp-dump');

    Route::post('/mig-reseed', function () {
        exec('cd .. ; php artisan migrate:refresh --seed');
    })->name('mig-reseed');

    Route::post('/server-config/store', 'ServerConfigController@storeAPI')->name('server.config.store');
    Route::post('/server-config/fetch', 'ServerConfigController@show')->name('server.config.fetch');
    Route::post('/server-config/self', 'ServerConfigController@callSelfConfig')->name('server.config.call');
    Route::post('/server-config/update/{name}', 'ServerConfigController@updateAPI')->name('server.config.update');
    Route::post('/test', function () {
        return response()->json([
            'message' => 'SUCCESS!!'
        ]);
    })->name('test');
});
