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

Auth::routes();
Route::get('admin/logout', function(){
    auth()->logout();
})->name('log-out');


Route::group(['prefix' => 'admin'], function() {
    //
    Route::get('/login', 'AuthenticatinController@index')->name('admin');

    Route::post('/login', 'AuthenticatinController@login')->name('login.admin');
    
    Route::get('/test', function(){
        if(auth()->check()){
            return 'ok';
        }else{
            return 'no';
        }
    })->name('test');
});

Route::prefix("/admin")->middleware(['admin'])->namespace('Admin')->group(function(){
    // Route::prefix("/admin")->middleware(['admin'])->namespace('Admin')->group(function(){
    //
    Route::get('/dashboard', 'DashboardController@index')->name('admin.dashboard');
});
