<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\admin\AdminController;
use App\Http\Middleware\Admin;
use App\Http\Controller\SectionController;
use App\Http\Controller\CategoryController;

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
Route::prefix('/admin')->namespace('App\Http\Controllers\admin')->group(function () {
    Route::match (['get', 'post'], 'login', 'AdminController@login');

    Route::group(
        ['middleware' => ['admin']],
        function () {
            // Dashboard
            Route::get('dashboard', 'AdminController@dashboard');
            //logout
            Route::get('logout', 'AdminController@logout');
            // Admin Details
            Route::match (['get', 'post'], 'update-admin-password', 'AdminController@updateAdminPassword');
            Route::post('check-admin-password', 'AdminController@checkAdminPassword');
            Route::match (['get', 'post'], 'update-admin-details', 'AdminController@updateAdminDetails');
            Route::get('admins/{type?}', 'AdminController@admins');
            Route::post('update-admin-status', 'AdminController@updateAdminStatus');
            // Vendor Details
            Route::match (['get', 'post'], 'update-vendor-details/{slug}', 'AdminController@updateVendorDetails')->name('vendor');
            Route::get('view-vendor-details/{id}', 'AdminController@viewVendorDetails');
            // SECTIONS
            Route::get('sections', 'SectionController@sections');
            Route::post('update-section-status', 'SectionController@updateSectionStatus');
            Route::get('delete-section/{id}', 'SectionController@deleteSection');
            Route::match (['get', 'post'], 'add-edit-section/{id?}', 'SectionController@addEditSection');
            // CATEGORIES
            Route::get('categories', 'CategoryController@categories');
            Route::post('update-category-status', 'CategoryController@updateCategoryStatus');
            Route::match (['get', 'post'], 'add-edit-category/{id?}', 'CategoryController@addEditCategory');
            Route::get('delete-category/{id}', 'CategoryController@deleteCategory');
            Route::get('append-categories-level', 'CategoryController@appendCategoriesLevel');
            Route::get('delete-category-image/{id}', 'CategoryController@deleteCategoryImage');
            // BRANDS
            Route::get('brands', 'BrandController@brands');
            Route::post('update-brand-status', 'BrandController@updateBrandStatus');
            Route::match (['get', 'post'], 'add-edit-brand/{id?}', 'BrandController@addEditBrand');
            Route::get('delete-brand/{id}', 'BrandController@deleteBrand');

            // Products
            Route::get('products', 'ProductController@products');
            Route::post('update-product-status', 'ProductController@updateProductStatus');
            Route::match (['get', 'post'], 'add-edit-product/{id?}', 'ProductController@addEditProduct');
            Route::get('delete-product/{id}', 'ProductController@deleteProduct');

        }
    );


});
// Route::get('/dashboard', [AdminController::class,'dashboard'])->name('dashboard');
// Route::get('/login',[AdminController::class,'login'])->name('login');
// Route::get('admin/dashboard' , 'App\Http\Controllers\Admin\AdminController@dashboard');
