<?php

use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Route;

use App\Http\Controllers\AnswersController;
use App\Http\Controllers\QuestionsController;
use App\Http\Controllers\AcceptAnswersController;


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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::resource('questions', QuestionsController::class)->except('show');
// Route::post('questions/{question}/answers', 'App\Http\Controllers\AnswersController@store')->name('answers.store');
Route::resource('questions.answers', AnswersController::class)->except(['index', 'create', 'show']);

Route::get('/questions/{slug}', 'App\Http\Controllers\QuestionsController@show')->name('questions.show');
Route::post('/answers/{answer}/accept', AcceptAnswersController::class)->name('answers.accept');

Route::post('/questions/{question}/favorites', 'App\Http\Controllers\FavoritesController@store')->name('questions.favorite');
Route::delete('/questions/{question}/favorites', 'App\Http\Controllers\FavoritesController@destroy')->name('questions.unfavorite');

Route::post('/questions/{question}/vote', 'App\Http\Controllers\VoteQuestionController');