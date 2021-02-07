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


Route::get('/', [
    'as' => 'news_list',
    'uses' => 'App\Http\Controllers\NewsController@list',
]);

Route::get('/{id}', [
    'as' => 'news_item',
    'uses' => 'App\Http\Controllers\NewsController@item',
]);
