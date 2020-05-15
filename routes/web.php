<?php

use Illuminate\Support\Facades\Route;
require_once('employer\routes.php');
require_once ('manager\routes.php');
Auth::routes();


Route::get('/', 'HomeController@index')->name('home');

//Auth::routes();
//
//Route::get('/home', 'HomeController@index')->name('home');




