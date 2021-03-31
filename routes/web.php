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

// Route::get('/', function () {
//     return view('welcome');
// });

Auth::routes();

Route::get('/', 'HomeController@index')->name('home');

Route::get('/home', 'HomeController@index')->name('home');


Route::get('/chat', function () {
    return view('chat');
});

Route::get('/Dashboard', function () {
    return view('Dashboard');
});

Route::get('/ppmpl', function () {
    return view('ppmpl');
});

Route::get('chat/delete/{id}/{id_mat}/{idweek}', 'HomeController@deleteChat');
Route::get('chat/{idMat}/{idWeek}', 'HomeController@chat');
Route::get('choseWeek/{id}', 'HomeController@choseweek');
Route::post('chat/submit', 'HomeController@submit');