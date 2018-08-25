<?php
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;
/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
*/


Route::get('/', "ThesisController@index");
Route::resource('thesis', "ThesisController")->except('edit');
Route::post('search', "ThesisController@search")->name('search');
Route::get("search/tag/{id}", "ThesisController@search")->name('searchTag');
Route::get("search/level/{id}", "ThesisController@search")->name('searchLevel');
Route::get("search/session/{id}", "ThesisController@search")->name('searchSession');

Auth::routes();

Route::get('/home', 'ThesisController@index')->name('home');
