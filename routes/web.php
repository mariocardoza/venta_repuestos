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
    return redirect()->route('dashboard');
});
Auth::routes();

Route::get('/home', 'HomeController@index')->name('home');

Route::middleware('auth')->prefix('admin')->group(function() {
  // ROUTES FOR ADMIN DASHBOARD
    //rutas para autorizaciones del administrador
  Route::Post('autorizacion', 'Homecontroller@autorizacion');
  Route::get('', 'DashboardController@redirectDashboard');
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
  Route::resource('users','UserController');
  Route::get('profile','UserController@getProfile')->name('profile');
  Route::post('profile','UserController@updateProfile')->name('profile.store');
  Route::resource('products','ProductController');
  Route::resource('purchases','PurchaseController');
  Route::resource('purchase-detail','PurchaseDetailController');
  Route::resource('customers','CustomerController');
  Route::resource('sales','SaleController');
  Route::resource('sale_details','SaleDetailController');
  Route::get('sales/resume/day','SaleController@day')->name('sales.day');
  Route::get('sales/preview/{id}','SaleController@previews');
  Route::get('sales/pdf/{id}','SaleController@pdf');
  Route::get('sales/dayly/report','SaleController@dayly')->name('sales.dayly');



  Route::get('shop','ShopController@index')->name('shop.index');
  Route::post('shop','ShopController@store')->name('shop.store');
  Route::post('shop/percentages','ShopController@percentages')->name('shop.percentages');
  Route::get('logs','LogController@index')->name('logs.index');
});
