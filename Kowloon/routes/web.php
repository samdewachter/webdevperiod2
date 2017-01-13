<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| This file is where you may define all of the routes that are handled
| by your application. Just tell Laravel the URIs it should respond
| to using a Closure or controller method. Build something great!
|
*/

Auth::routes();

Route::get('/', 'HomeController@index');

Route::get('/cookie', 'CookieController@makeCookie');

Route::get('/FAQ', 'FAQController@index');
Route::post('/FAQ', 'FAQController@search');

Route::get('/search', 'SearchController@index');
Route::post('/search', 'SearchController@search');

Route::post('/subscribe', 'SubscribeController@index');

Route::get('/admindashboard', 'AdminController@index');

Route::get('/admindashboard/products', 'AdminController@products');
Route::get('/admindashboard/product/new', 'AdminController@newProduct');
Route::post('/admindashboard/product/new', 'AdminController@makeProduct');
Route::delete('/admindashboard/product/delete/{product}', 'AdminController@deleteProduct');
Route::get('/admindashboard/product/edit/{product}', 'AdminController@editProduct');
Route::post('/admindashboard/product/edit/{product}', 'AdminController@updateProduct');
Route::get('/admindashboard/product/faq/edit/{product}', 'AdminController@editFaqProduct');
Route::delete('/admindashboard/product/faq/delete/{product}/{faqproduct}', 'AdminController@deleteFaqProduct');
Route::post('/admindashboard/product/faq/add/{product}/{faq}', 'AdminController@addFaqProduct');

Route::get('/admindashboard/faq', 'AdminController@faq');
Route::get('/admindashboard/faq/new', 'AdminController@newFaq');
Route::post('/admindashboard/faq/new', 'AdminController@createFaq');
Route::delete('/admindashboard/faq/delete/{faq}', 'AdminController@deleteFaq');
Route::get('/admindashboard/faq/edit/{faq}', 'AdminController@editFaq');
Route::post('/admindashboard/faq/edit/{faq}', 'AdminController@updateFaq');

Route::get('categories/{category}', 'CategoryController@index');
Route::post('categories/{category}/search', 'CategoryController@search');
Route::get('categories/{category}/product/{product}', 'CategoryController@showProduct');

Route::get('about', 'AboutController@index');
Route::post('about/contact', 'AboutController@contact');

Route::get('language', 'LanguageController@index');