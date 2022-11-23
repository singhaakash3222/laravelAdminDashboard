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
    return view('welcome');
});

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Auth::routes();

Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('home');

Route::prefix('/admin')->namespace('Admin')->group(function(){
//All the admin routes will be find here

    Route::match(['get','post'],'/', [App\Http\Controllers\Admin\AdminController::class, 'login']); //For admin login page

    Route::group(['middleware'=>['admin']],function(){

        Route::get('dashboard', [App\Http\Controllers\Admin\AdminController::class, 'dashboard']);//For admin dashboard
        Route::get('settings', [App\Http\Controllers\Admin\AdminController::class, 'settings']);//For admin change password
        Route::get('logout', [App\Http\Controllers\Admin\AdminController::class, 'logout']);//For admin logout
        Route::post('check-current-password', [App\Http\Controllers\Admin\AdminController::class, 'chkCurrentPassword']);//For check admin current password
        Route::post('update-current-pwd', [App\Http\Controllers\Admin\AdminController::class, 'updateCurrentPassword']);//For update admin current password
        Route::match(['get','post'],'update-admin-details', [App\Http\Controllers\Admin\AdminController::class, 'updateAdminDetails']); //For update admin details
    });
    
});
