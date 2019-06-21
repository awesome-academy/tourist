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

Route::namespace('Backend')->prefix('admin')->middleware(['auth', 'check.role'])->group(function(){
    Route::get('/', 'DashboardController@index')->name('dashboard');
    Route::resource('banner', 'BannerController');
    Route::resource('catetour', 'CategoryTourController');
    Route::resource('catenews', 'CategoryNewsController');
    Route::resource('media', 'MediaController');
    Route::resource('news', 'NewsController');
    Route::resource('tour', 'TourController');
    Route::resource('user', 'UserController');
    Route::resource('menu', 'MenuController');
    Route::get('destroy/delete/{id}', 'DestroyController@delete')->name('destroy.delete');
    Route::resource('review', 'ReviewController');
    Route::resource('ordertour', 'OrderTourManageController');
});

Route::namespace('Frontend')->group(function(){
    Route::get('/', 'HomeController@index')->name('homeTourist');
    Route::get('about', 'AboutController@index')->name('about');
    Route::get('tour-du-lich/{slug}', 'TourViewController@index')->name('tour');
    Route::get('chi-tiet-tour/{slug}.html', 'TourViewController@detailTour')->name('tour.detail');
    Route::get('tin-tuc/{slug}', 'NewsViewController@index')->name('news');
    Route::get('chi-tiet-tin-tuc/{slug}.html', 'NewsViewController@detailNews')->name('news.detail');
    Route::get('book-tour/{slug}', 'OrderTourController@index')->name('book');
    Route::post('book-tour/{slug}', 'OrderTourController@store')->name('book.store');
    Route::get('find', 'SearchController@find');
    Route::middleware('auth')->post('comment/{id}', 'RateStarController@index')->name('comment');
});

Auth::routes();
