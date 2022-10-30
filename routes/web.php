<?php

use Illuminate\Support\Facades\Artisan;
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



Route::post('/authenticate', 'Controller@authenticate')->name('login.auth');
Route::get('/logout', 'Controller@logoutUser')->name('logout');
Route::post('/register/save', 'Controller@registerSave')->name('register.save');
Route::post('/forgot/password/post', 'Controller@forgotPasswordPost')->name('forgot.password.post');
Route::get('/reset/password/{token}', 'Controller@resetPassword')->name('reset.passwords');
Route::post('reset/password/post', 'Controller@resetPasswordPost')->name('reset.passwords.post');

Route::middleware(['not.logged.in'])->group(function(){
    Route::get('/', 'Controller@login')->name('home');
    Route::get('/login', 'Controller@login')->name('login');
    Route::get('/forgot/password', 'Controller@forgotPasswordView')->name('forgot.password');
    Route::get('register', 'Controller@register')->name('register');
});

Route::middleware(['auth'])->prefix('user/')->group(function () {
    Route::get('dashboard', 'DashboardController@index')->name('dashboard');
    Route::get('product/list', 'ProductController@list')->name('product.list');
    Route::resource('product', 'ProductController');
    Route::get('/category/list', 'CategoryController@index')->name('category.list');
});
