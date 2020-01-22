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

//Google Login routes
Route::get('auth/google', 'Auth\GoogleController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\GoogleController@handleGoogleCallback');

Route::get('/', 'Auth\LoginController@showLogin')->name('show.login');
Route::post('/', 'Auth\LoginController@login')->name('process.login');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/changepassword','Auth\ResetPasswordController@showResetPassword')->name('reset.password');
Route::post('/changepassword','Auth\ResetPasswordController@updatePassword')->name('password.update');

Route::get('/scorecards','ScoreCardsController@showScoreCards')->name('show.scorecards');
// Route::get('/scorecards/create','ScoreCardsController@showCreateScoreCard')->name('show.create.scorecard');
Route::get('/scorecards/view/{id}','ScoreCardsController@showViewScoreCard')->name('show.view.scorecard');
Route::post('/scorecards/view/{id}','ScoreCardsController@saveScoreCard')->name('save.scorecard');
Route::get('/scorecards/createsc','ScoreCardsController@createScoreCard')->name('create.scorecard');
Route::post('/scorecards/save','ScoreCardsController@saveCreatedScoreCard')->name('save.create.scorecard');
Route::get('/scorecards/delete/{id}','ScoreCardsController@deleteScoreCard')->name('delete.scorecard');


Route::get('/departments','DepartmentController@showDepartment')->name('show.departments');
Route::post('/departments','DepartmentController@addDepartment')->name('add.department');

Route::get('/staff','StaffController@showStaff')->name('show.staff');
Route::post('/staff','StaffController@addStaff')->name('add.staff');




