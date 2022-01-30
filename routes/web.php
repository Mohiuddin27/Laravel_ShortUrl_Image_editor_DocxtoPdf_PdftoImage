<?php

use Illuminate\Support\Facades\Route;
use App\Models\Shortener;
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

Route::get('/', 'App\Http\Controllers\ShortenerController@getWelcomeView')->name('welcome');

Route::get('/directory', 'App\Http\Controllers\ShortenerController@getDirectoryView')->name('directory');

Route::post('/makeShortUrl','App\Http\Controllers\ShortenerController@makeShortUrl')->name('makeShortUrl');

Route::get('/c/{code}','App\Http\Controllers\ShortenerController@getUrl')->name('getUrl');
Route::view('image_editor','image');
Route::view('pdftoimage','pdftoimage');
Route::post('pdftoimage','App\Http\Controllers\PtoimageController@pdftoimage');
Route::get('pdftoConvertimage?image={$output}');
Route::view('docxtopdf','docxtopdf');
Route::post('docxtopdf','App\Http\Controllers\DocxtopdfController@docxtopdf');
