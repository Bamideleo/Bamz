<?php

use Illuminate\Support\Facades\Route;
use Illuminate\Http\Request;

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

Route::get('/', 'HomeController@index')->name('home');
//product section start
Route::middleware('auth:admin')->group(function(){
    Route::get('/admin','ProductController@index');
Route::get('/admin/create','ProductController@create');
Route::post('/admin/create','ProductController@store');
Route::get('admin/{dit}/edit','ProductController@edit');
Route::get('admin/show','ProductController@show')->name('dit.show');
Route::put('admin/{dit}/update','ProductController@update')->name('dit.update');
Route::delete('/admin/{dit}/destroy','ProductController@destroy');
// categories section start 
Route::get('/admin/categories','CategoriesController@categories');
Route::post('/admin/categories','CategoriesController@store');
Route::delete('/admin/categories/{id}/destroy','CategoriesController@destroy');
//categories section end
   
});
//product section end
Auth::routes();
//frontend section start
Route::get('/home', 'HomeController@index')->name('home');
Route::post('/user/logout','Auth\LoginController@userlogout')->name('user.logout');
Route::get('/shop', 'HomeController@shop')->name('shop');
Route::get('/category/{id}', 'HomeController@showcategory');
Route::get('/productDetail/{id}', 'HomeController@productdetail');
Route::get('/about','HomeController@about');
Route::get('/privacy','HomeController@privacy');
Route::get('/shipping','HomeController@shipping');
Route::get('/exchange','HomeController@exchange');
//frontend section end
//cart section start
Route::middleware('auth')->group(function(){
Route::get('/wishlist', 'HomeController@Wishlist');
Route::post('/addWishlist', 'HomeController@AddWish')->name('addWishlist');
Route::delete('/destroy/{id}', 'HomeController@destroy');
Route::get('/cart','cartController@index');
Route::get('/cart/addItem/{id}','cartController@addItem');
Route::delete('/cart/{id}/destroy','cartController@destroy')->name('destroy');
Route::put('/cart/{id}/update','cartController@updateCart')->name('updateCart');
//cart section end
//check section start
Route::get('/check','CheckOutController@index');
Route::post('/check/formValidate','CheckOutController@address');
Route::get('/check/execute-payment','CheckOutController@execute');
Route::post('/check/create-payment','CheckOutController@create')->name('create-payment');
//check section end
// //payment section start
// Route::get('/check/execute-payment','PaymentController@execute');
// Route::post('/check/create-payment','PaymentController@create')->name('create-payment');
// //payment section end
//profile must have middleware
Route::get('/profile','profileController@index');
Route::get('/profile/orders','profileController@Order');
Route::get('/profile/address','profileController@Address');
Route::post('/profile/updateAddress','profileController@Update');
Route::get('/profile/updatePassword','profileController@Password');
Route::put('/profile/updatePassword','profileController@updatepass');
});
// Admin section start
Route::prefix('admin')->group(function(){
    //admin dashboard
    Route::get('/','AdminController@index')->name('admin.index'); 
    //login route
    Route::get('/login','Auth\AdminLoginController@showLogin')->name('admin.login');
    Route::post('/login','Auth\AdminLoginController@login')->name('admin.submit');
    //logout route
    Route::post('/logout','Auth\AdminLoginController@Logout')->name('admin.logout');
    //register route
    Route::get('/register','Auth\AdminRegisterController@showRegister')->name('admin.register');
    Route::post('/register','Auth\AdminRegisterController@Register')->name('admin.register.submit');
});
//Admin section end
