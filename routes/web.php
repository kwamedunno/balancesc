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
//Authentication
Route::get('auth/google', 'Auth\LoginController@redirectToGoogle');
Route::get('auth/google/callback', 'Auth\LoginController@handleGoogleCallback');
Route::get('/', 'Auth\LoginController@showLogin')->name('show.login');
Route::post('/', 'Auth\LoginController@login')->name('process.login');

//Google test routes
Route::get('/login2', 'Auth\LoginController@showLogin2')->name('show.login2');
Route::get('/logout', 'Auth\LoginController@logout')->name('logout');
Route::get('/changepassword','Auth\ResetPasswordController@showResetPassword')->name('reset.password');
Route::post('/changepassword','Auth\ResetPasswordController@updatePassword')->name('password.update');

//Scorecards
Route::get('/scorecards','ScoreCardsController@showScoreCards')->name('show.scorecards');
Route::get('/scorecards/view/{id}','ScoreCardsController@showViewScoreCard')->name('show.view.scorecard');
Route::post('/scorecards/view/{id}','ScoreCardsController@saveScoreCard')->name('save.scorecard');
Route::get('/scorecards/createsc','ScoreCardsController@createScoreCard')->name('create.scorecard');
Route::post('/scorecards/save','ScoreCardsController@saveCreatedScoreCard')->name('save.create.scorecard');
Route::get('/scorecards/delete/{id}','ScoreCardsController@deleteScoreCard')->name('delete.scorecard');

//Departments
Route::get('/departments','DepartmentController@showDepartment')->name('show.departments');
Route::post('/departments','DepartmentController@addDepartment')->name('add.department');

//Staff
Route::get('/staff','StaffController@showStaff')->name('show.staff');
Route::post('/staff','StaffController@addStaff')->name('add.staff');
Route::get('/staff/delete/{id}','StaffController@deleteStaff')->name('delete.staff');
Route::post('/staff/edit','StaffController@editStaff')->name('edit.staff');
Route::get('/staff/profile/{id}','StaffController@showProfile')->name('show.profile');
Route::get('/staff/loggedprofile','StaffController@showLoggedUserProfile')->name('show.logged.profile');

Route::get('/staff/restore','StaffController@restoreCards')->name('restore.felicity');



