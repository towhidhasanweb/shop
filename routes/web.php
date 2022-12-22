<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\customerRegisterController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Frontendcontroller;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\SubcategoryController;
use App\Http\Controllers\UserController;
use App\Models\customerRegister;

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

Route::get('/', [Frontendcontroller::class, 'welcome'])->name('welcome');

Auth::routes();

Route::get('/dashboard', [App\Http\Controllers\HomeController::class, 'index'])->name('home');
Route::get('/about', [Frontendcontroller::class, 'about'])->name('about');
Route::get('/contact', [Frontendcontroller::class, 'contact'])->name('contact');

// users
Route::get('/user', [UserController::class, 'user_view'])->name('view user');
Route::get('user/delete/{user_id}', [UserController::class, 'user_delete'])->name('del.user');
Route::get('/profile', [UserController::class, 'profile'])->name('profile');
Route::post('/change/name', [UserController::class, 'name_change'])->name('name.change');
Route::post('/change/password', [UserController::class, 'password_change'])->name('password.change');
Route::Post('/update-profile-photo',[UserController::class, 'photo_change'])->name('photo.change');

//category
Route::get('/category-list', [CategoryController::class, 'category'])->name('category');
Route::post('/add-category', [CategoryController::class, 'add_category'])->name('add.category');
Route::get('/delete-category/{category_id}',[CategoryController::class, 'delete_category'])->name('delete.category');
Route::get('/hard-delete-category/{category_id}',[CategoryController::class, 'harddelete_category'])->name('harddelete.category');
Route::get('/restore-category/{category_id}',[CategoryController::class, 'restore_category'])->name('restore.category');
Route::get('/edit-category/{category_id}', [CategoryController::class, 'edit_category'])->name('edit.category');
Route::post('/update-category', [CategoryController::class, 'update_category'])->name('update.category');

// Subcategory
Route::get('/subcategory', [SubcategoryController::class, 'subcategory'])->name('subcategory');
Route::post('/add-subcategory', [SubcategoryController::class, 'add_subcategory'])->name('add.subcategory');
Route::get('/delete-subcategory/{subcategory_id}', [SubcategoryController::class, 'delete_subcategory'])->name('delete.subcategory');
Route::get('/harddelete-subcategory/{subcategory_id}', [SubcategoryController::class, 'harddelete_subcategory'])->name('harddelete.subcategory');
Route::get('/restore-subcategory/{subcategory_id}', [SubcategoryController::class, 'restore_subcategory'])->name('restore.subcategory');
Route::get('/edit-subcategory/{subcategory_id}',[SubcategoryController::class, 'edit_subcategory'])->name('edit.subcategory');
Route::post('/update-subcategory',[SubcategoryController::class, 'update_subcategory'])->name('update.subcategory');

// product 
Route::get('/product-list', [ProductController::class, 'product_list'])->name('product.list');
Route::get('/add-product', [ProductController::class, 'add_product'])->name('add.product');
Route::post('/getsubcategory', [ProductController::class, 'getsubcategory']);
Route::post('/product-upload', [ProductController::class, 'product_upload'])->name('product.upload');
Route::get('/color-size', [ProductController::class, 'color_size'])->name('color.size');
Route::post('/add-color', [ProductController::class, 'add_color'])->name('add.color');
Route::post('/add-size', [ProductController::class, 'add_size'])->name('add.size');
Route::get('/inventory/{product_id}', [ProductController::class, 'inventory'])->name('inventory');
Route::post('/inventory-store', [ProductController::class, 'inventory_store'])->name('inventory.store');
Route::get('/edit-inventory/{inventory_id}', [ProductController::class, 'inventory_edit'])->name('edit.inventory');
Route::post('/edit-inventory-store', [ProductController::class, 'edit_inventory_store'])->name('edit.inventory.store');





// Frontend 
Route::get('/home', [Frontendcontroller::class, 'frontend_view'])->name('index');
Route::get('/product/details/{product_slug}', [Frontendcontroller::class, 'product_details'])->name('product.details');
Route::post('/getsizeid', [Frontendcontroller::class, 'getsizeid']);


// login
Route::get('/login', [Frontendcontroller::class, 'customer_login'])->name('customer.login');
Route::post('/customer-register', [customerRegisterController::class, 'customer_register'])->name('customer.register');
Route::post('/login-customer', [customerRegisterController::class, 'login_customer'])->name('login.customer');
Route::get('/logout', [customerRegisterController::class, 'user_logout'])->name('user.logout');
