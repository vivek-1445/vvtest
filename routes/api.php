<?php

use App\Model\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::get('login', 'API\APIUserController@login');
Route::middleware(['auth.api'])->prefix('v1')->group(function(){
    Route::resource('productapi', 'API\ProductController');
    Route::resource('category', 'API\CategoryController');
});
