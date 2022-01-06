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
    return view('home');
});

Route::get('/painting/{id}', 'App\Http\Controllers\PaintingController@index')->name('painting.index');

Route::get('/paintings', function () {
    return view('paintings');
});

Route::get('/terms', function () {
    return view('terms');
});

Route::get('/instruction', function () {
    return view('instruction');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/profile')->group(function () {
    Route::get('/{username}', 'App\Http\Controllers\ProfileController@index')->name('profile.index');
    Route::get('/{username}/edit', 'App\Http\Controllers\ProfileController@edit')->name('profile.edit');
    Route::post('/{username}/edit', 'App\Http\Controllers\ProfileController@update')->name('profile.update');
    Route::post('/{username}/store', 'App\Http\Controllers\ProfileController@store')->name('profile.store');
    Route::delete('/destroy/{id}', 'App\Http\Controllers\ProfileController@destroy')->name('profile.destroy');
});
