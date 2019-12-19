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

Route::get('/', 'Auth\LoginController@showLogin')->name('show.login');
Route::post('/', 'Auth\LoginController@login')->name('process.login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');

Route::get('/scorecards','ScorecardsController@showScoreCards')->name('show.scorecards');
Route::get('/scorecards/create','ScorecardsController@showCreateScoreCard')->name('show.create.scorecard');
Route::get('/scorecards/view/{id}','ScorecardsController@showViewScoreCard')->name('show.view.scorecard');
Route::post('/scorecards/view/{id}','ScorecardsController@saveScoreCard')->name('save.scorecard');


Route::get('/departments','DepartmentController@showDepartment')->name('show.departments');
Route::post('/departments','DepartmentController@addDepartment')->name('add.department');

Route::get('/staff','StaffController@showStaff')->name('show.staff');
Route::post('/staff','StaffController@addStaff')->name('add.staff');

Route::get('/example','StaffController@showExample')->name('show.example');


