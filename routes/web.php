<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Middleware\Admin;

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
Route::prefix('/admin')->namespace('App\Http\Controllers\admin')->group(function(){
    Route::match(['get', 'post'], 'login', 'AdminController@login');

    Route::group(['middleware' => ['admin']],function(){
        Route::get('dashboard','AdminController@dashboard');
        Route::get('logout' , 'AdminController@logout');
        Route::match(['get', 'post'], 'update-admin-password', 'AdminController@updateAdminPassword');
        Route::post('check-admin-password', 'AdminController@checkAdminPassword');
        Route::match(['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails');
        Route::match(['get', 'post'], 'update-vendor-details/{slug}', 'AdminController@updateVendorDetails')->name('vendor');
        Route::get('admins/{type?}','AdminController@admins');

    });
    
});
// Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');
// Route::get('/login',[AdminController::class,'login'])->name('login');
// Route::get('admin/dashboard' , 'App\Http\Controllers\Admin\AdminController@dashboard');



