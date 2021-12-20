<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LocalizationController;
use App\Http\Controllers\HomeController;


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
Route::get('/home','HomeController@index')->name('home');
/*
Route::get('/page/{slug}', 'PagesController@index')->name('page.show');

*/
Route::get('page/{slug}', function($slug){
	$page = Page::where('slug', '=', $slug)->firstOrFail();
	return view('page', compact('page'));
});


Route::get('/lang/{lang}',[LocalizationController::class, 'setLocalization'])->name('lang');


Route::group(['prefix' => 'admin'], function () {
    Voyager::routes();
});
