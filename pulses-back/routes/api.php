<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Symfony\Component\Console\Question\Question;

Route::middleware('auth:api')->get('/user', function (Request $request) {
    return $request->user();
});

Route::get('/question', 'QuestionController@index');
Route::post('/save-question', 'QuestionController@save');
Route::put('/update-question', 'QuestionController@update');
Route::put('/update-status', 'QuestionController@updateStatus');
Route::delete('/delete-question/{id}', 'QuestionController@delete');

Route::get('/dimension', 'DimensionController@index');
Route::post('/save-dimension', 'DimensionController@save');
Route::put('/update-dimension', 'DimensionController@update');
Route::delete('/delete-dimension/{id}', 'DimensionController@delete');
