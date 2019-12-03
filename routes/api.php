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
});