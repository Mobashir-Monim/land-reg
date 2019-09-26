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
Route::get('/test', function () {
    $data['text'] = "Mobashir Monim";
    $data['hash'] = hash('sha256', $data['text']);
    return view('test', compact('data'));
    $x = hexdec('99bad0b8d4e910e2e6a5ef9bb3fd843e3d58ef434348fd984b294cdc0d621925');
    dd($x, $y, $x < $y, strlen(hash('sha256', 'This is the data')));
    return hash('sha256', 'This is the data');
})->name('test');