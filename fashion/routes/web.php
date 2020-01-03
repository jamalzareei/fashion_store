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

// use Defuse\Crypto\File;

// Route::get('/', function () {
//     unlink('public/uploads/users/1/2019-12-15/2ff22293937c9b1039b9ad11bd343a8c1b0eb804.png');
//     return 'aaa';// view('welcome');
//     ///public/uploads/users/1/2019-12-15/2ff22293937c9b1039b9ad11bd343a8c1b0eb804.png
// });
Route::get('/{any?}', function (){
    return view('welcome');
})->where('any', '^(?!api\/)[\/\w\.-]*');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');

// Auth::routes();

// Route::get('/home', 'HomeController@index')->name('home');
