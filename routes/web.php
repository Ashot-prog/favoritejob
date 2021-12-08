<?php

use Illuminate\Support\Facades\Route;
use TCG\Voyager\Facades\Voyager;

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
Route::get('/', ['App\Http\Controllers\JobController', 'index']);
Route::get('/register', function () {
    return view('register');
});
Route::get('/logout', [\App\Http\Controllers\CandidateController::class, 'logout']);
Route::get('/favoritejob', [\App\Http\Controllers\FavoriteJobController::class, 'store']);
Route::get('/destroy', [\App\Http\Controllers\FavoriteJobController::class, 'destroy']);
Route::post('/registering', [App\Http\Controllers\CandidateController::class, 'store']);
Route::get('/login', function () {
    return view('login');
});
Route::post('/logining', [\App\Http\Controllers\CandidateController::class, 'login']);


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
