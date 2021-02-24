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

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('/personel')->name('personel.')->namespace('Personel')->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});

Route::prefix('/report')->name('report.')->namespace('Report')->group(function () {
    Route::prefix('/activity')->name('activity.')->group(function () {
        Route::get('/', 'ActivityController@index')->name('index');
        Route::get('/show/{id}', 'ActivityController@show')->name('show');
        Route::get('/{start}/{end}', 'ActivityController@search');
    });

    Route::prefix('/result')->name('result.')->group(function () {
        Route::get('/{id}', 'ResultController@index')->name('index');
    });

    Route::prefix('/dorm')->name('dorm.')->group(function () {
        Route::get('/{id}', 'DormController@index')->name('index');
    });
});

Route::resource('user', 'StudentController');

Route::get('/indexScore', 'ScoreController@index')->name('indexScore');

Route::get('/createScore/{id}', 'ScoreController@showForm')->name('createScore');

Route::get('/findStudent', 'ScoreController@findStudent')->name('findStudent');

Route::post('/storeScore', 'ScoreController@store')->name('storeScore');

Route::get('/getRoom/{id}', 'DormitoryDetailController@getRoom')->name('getRoom');

Route::resource('application', 'ApplicationController');

Route::get('/checkApp/{id}', 'ApplicationController@checkApplicationThisYear')->name('checkApp');

Route::resource('activity', 'ActivityController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
