<?php

/*
|--------------------------------------------------------------------------
| Application Routes
|--------------------------------------------------------------------------
|
| Here is where you can register all of the routes for an application.
| It's a breeze. Simply tell Laravel the URIs it should respond to
| and give it the Closure to execute when that URI is requested.
|
*/

Route::get('/', [
    'as' => 'app.index',
    'uses' => 'HomeController@index'
]);


Route::get('/v2', [
    'as' => 'app.index',
    'uses' => 'HomeController@indexNew'
]);

Route::post('/filter', [
    'as' => 'hack.filter',
    'uses' => 'HomeController@filter'
]);

Route::get('resource/{id}', [
    'as' => 'app.resource.show',
    'uses' => 'InfoController@index'
]);

Route::get('/stats', [
    'as' => 'hack.stats',
    'uses' => 'HomeController@stats'
]);

Route::get('/about', [
    'as' => 'hack.about',
    'uses' => 'HomeController@about'
]);