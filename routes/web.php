<?php

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

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::post('/mine', 'BlockController@requestMine')->name('mine');
Route::get('/blocks', 'BlockController@index')->name('blocks');
Route::get('/reset-chain', 'BlockController@reset')->name('reset-chain');
Route::get('/js-blocks', function () {
    $data['text'] = "Mobashir Monim";
    $data['hash'] = hash('sha256', $data['text']);
    
    return view('test', compact('data'));
})->name('js-blocks');

Route::get('test', function () {
    $data = array();
    $ip = $_SERVER['REMOTE_ADDR'];
    $data['fd08fe4cabe53c99e68895930ecf3af290cb16296339d54af3cf31a69f6acada-fd08fe4cabe53c99e68895930ecf3af290cb16296339d54af3cf31a69f6acada-fd08fe4cabe53c99e68895930ecf3af290cb16296339d54af3cf31a69f6acada'] = array();
    dd($data, $ip);
});