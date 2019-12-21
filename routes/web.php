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

Auth::routes(['register' => false]);

Route::middleware(['auth', 'super-admin-only'])->group(function () {
    // Server Config Routes
    Route::get('/server-config/all', 'ServerConfigController@configAll')->name('server.config.all');
    Route::get('/server-config/index', 'ServerConfigController@index')->name('server.config.index');
    Route::get('/server-config/create', 'ServerConfigController@create')->name('server.config.create');
    Route::post('/server-config/create', 'ServerConfigController@store')->name('server.config.create');
    Route::get('/server-config/update/{name}', 'ServerConfigController@edit')->name('server.config.alter');
    Route::post('/server-config/update/{name}', 'ServerConfigController@update')->name('server.config.alter');

    // DApp Transaction Routes
    Route::get('/transaction/create', 'DAppTransactionsController@addTransaction')->name('transactions.create');
    Route::post('/transaction/create', 'DAppTransactionsController@processTransaction')->name('transactions.create');
    Route::post('/transaction/mine', 'DAppTransactionsController@mine')->name('transactions.mine');
});


Route::get('/home', 'HomeController@index')->name('home');
Route::post('/mine', 'BlockController@requestMine')->name('mine');
Route::get('/blocks', 'BlockController@index')->name('blocks');
Route::get('/blocks/mined', 'BlockController@mined')->name('mined');
Route::get('/blocks/mine/{txid}', 'BlockController@startMine')->name('mine.start');
Route::get('/reset-chain', 'BlockController@reset')->name('reset-chain');
Route::get('/js-blocks', function () {
    $data['text'] = "Mobashir Monim";
    $data['hash'] = hash('sha256', $data['text']);
    
    return view('test', compact('data'));
})->name('js-blocks');

Route::get('test', function () {
    exec("cd .. ; php artisan migrate:rollback --step=1 ; php artisan migrate");
    dd("done");
    dd(base64_encode(file_get_contents('https://www.taff2.com/uploads/TAF%20Bangladesh%20Project%20Briefing_final.pdf')));
    set_time_limit(3660);
    $start = Carbon\Carbon::now();

    while (Carbon\Carbon::now()->diffInSeconds($start) <= 3600) {
        App\ComputeTester::create([]);
    }

    $data = array();
    // $ip = $_SERVER['REMOTE_ADDR'];
    $ip = trim(shell_exec("dig +short myip.opendns.com @resolver1.opendns.com"));
    $data['fd08fe4cabe53c99e68895930ecf3af290cb16296339d54af3cf31a69f6acada-fd08fe4cabe53c99e68895930ecf3af290cb16296339d54af3cf31a69f6acada-fd08fe4cabe53c99e68895930ecf3af290cb16296339d54af3cf31a69f6acada'] = array();
    dd($data, $ip);

    // return count(App\ComputeTester::all());
});

Route::get('/test2', 'MineController@processMine');
Route::get('/test3', function () {
    $response = (new App\Http\Controllers\Controller)->postData("http://127.0.0.1:8001/api/test", ['ip' => (new App\Http\Controllers\Controller)->selfIP()]);
    dd(json_decode($response->getBody()->getContents()));
    dd(request()->ip(), (new App\Http\Controllers\Controller)->selfIP());
    dd(App\Block::generateUpperLim(), App\Block::generateLowerLim());
    $val = hexdec(bin2hex(openssl_random_pseudo_bytes(32)));
    $base = hexdec(bin2hex(openssl_random_pseudo_bytes(32)));
    dd($val == $base, $val >= $base, $val <= $base);
    dd((new App\ServerConfig)->getVal('ip'), 'here');
    return view('test3');
});
Route::post('/mine/transaction', 'DAppTransactionsController@processTransaction')->name('mine.transaction');
