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
    $articles = \App\Article::paginate(20);
    return view('welcome',compact("articles"));
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');
Route::resource("/articles","ArticleController");
Route::post('/articles/{article}/request_collab',"ArticleController@requestCollab");
Route::post('/articles/{article}/approve_collab',"ArticleController@approveCollab");
Route::post('/comments',"CommentController@store");
