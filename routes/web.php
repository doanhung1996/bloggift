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

Route::get('/', 'HomeController@index');

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::get('/posts','PostController@index')->name('post.index');
Route::get('/posts/{post:slug}', 'PostController@show')->name('post.show');
Route::get('/posts/load/more/home', 'HomeController@loadMore')->name('post.load.more.home');
Route::get('/posts/load/more/post/{slug}', 'PostController@loadMore')->name('post.load.more.post');
