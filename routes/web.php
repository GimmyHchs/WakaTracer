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
use Illuminate\Support\Facades\Redis;

Route::get('/redis', function (){
    Redis::set('name', 'hchs');
    return Redis::get('name');
});


Route::get('/', function () {
    return view('welcome');
});
