<?php

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

Route::post('login','App\Http\Controllers\api\UserController@login');
Route::post('register','App\Http\Controllers\api\UserController@register');

Route::group(['middleware' => 'auth:api'], function(){
    Route::get('user-list','App\Http\Controllers\api\UserController@userList');
    Route::post('logout','App\Http\Controllers\api\UserController@logout');
    Route::post('edit-role','App\Http\Controllers\api\RoleUserController@editRole');
    Route::post('delete-role','App\Http\Controllers\api\RoleUserController@deleteUser');
});
