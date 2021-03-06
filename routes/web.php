<?php

use App\Http\Controllers\Auth\LoginController;
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
    return redirect()->action([LoginController::class, 'showLoginForm']);
});

Route::prefix('/admin')->name('admin.')->namespace('Admin')->group(function () {
    Route::resource('personel', 'PersonController');
});

// Route::resource('/admin/personel', 'Admin\PersonController');

Route::prefix('/personel')->name('personel.')->namespace('Personel')->group(function () {
    Route::get('/dashboard', 'HomeController@index')->name('home');
    Route::get('/login', 'LoginController@showLoginForm')->name('login');
    Route::post('/login', 'LoginController@login');
    Route::post('/logout', 'LoginController@logout')->name('logout');
});

Route::prefix('/report')->name('report.')->namespace('Report')->group(function () {
    Route::prefix('/activity')->name('activity.')->group(function () {
        Route::get('/{id}', 'ActivityController@index')->name('index');
        Route::get('/showAll/{id}', 'ActivityController@showAll')->name('showAll');
        Route::get('/show/{id}/{dormId}', 'ActivityController@show')->name('show');
        Route::get('/{dormId}/{start}/{end}', 'ActivityController@search');
    });

    Route::prefix('/result')->name('result.')->group(function () {
        Route::post('/store', 'ResultController@store')->name('store');
        Route::get('/select', 'ResultController@select')->name('select');
        Route::get('/select/{id}', 'ResultController@edit')->name('edit');
        Route::post('/find', 'ResultController@show')->name('find');
        Route::get('/{id}', 'ResultController@index')->name('index');
    });

    Route::resource('validate', 'ValidateController');

    Route::prefix('/dorm')->name('dorm.')->group(function () {
        Route::get('/{id}', 'DormController@index')->name('index');
    });

    Route::prefix('/interview')->name('interview.')->group(function () {
        Route::get('/', 'InterviewController@index')->name('index');
        Route::get('/select/{id}', 'InterviewController@edit')->name('edit');
        Route::get('/{id}', 'InterviewController@show')->name('show');
    });
});

Route::resource('faculty', 'FacultyController');

Route::resource('yearConfig', 'YearConfigController');

Route::resource('registerRange', 'RegisterRangeController');

Route::resource('interview', 'InterviewController');

Route::resource('user', 'StudentController');

Route::resource('dorm', 'DormController');

Route::resource('room', 'RoomController');

Route::get('user/all/{id}', 'StudentController@getUserByDormId');

Route::get('/findByUsername/{id}', 'StudentController@findByUsername')->name('findByUsername');

Route::put('user/changeStatus/{id}', 'StudentController@changeStatus')->name('changeStatus');

Route::get('/indexScore/{id}', 'ScoreController@index')->name('indexScore');

Route::get('/createScore/{id}', 'ScoreController@showForm')->name('createScore');

Route::get('/findStudent', 'ScoreController@findStudent')->name('findStudent');

Route::get('/findApplication', 'InterviewController@findStudent')->name('findApplication');

Route::post('/calculateResult', 'InterviewController@calculateResult')->name('calculate');

Route::post('/storeScore', 'ScoreController@store')->name('storeScore');

Route::get('/getRoom/{id}', 'DormitoryDetailController@getRoom')->name('getRoom');

Route::post('/dormitorydetail', 'DormitoryDetailController@store')->name('dormRoomStore');

Route::resource('application', 'ApplicationController');

Route::get('application/showall/{id}', 'ApplicationController@showAll');

Route::get('application/detail/{id}', 'ApplicationController@showApp');

Route::get('/checkApp/{id}', 'ApplicationController@checkApplicationThisYear')->name('checkApp');

Route::resource('activity', 'ActivityController');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
