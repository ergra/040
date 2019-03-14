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

Route::get('/', function () {
    return view('apply');
});



Route::get('courses.json', function () {
    $filePath = storage_path().'/courses.json';
    $fileContents = File::get($filePath);

    return Response::make($fileContents, 200);
});

Route::post('/submit', 'ApplicationFormController@submit');

