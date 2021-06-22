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
  Route::get('', 'DashboardController@redirectDashboard');
  Route::get('/dashboard', 'DashboardController@index')->name('dashboard');
  Route::resource('users','UserController');
  Route::resource('products','ProductController');
  Route::resource('purchases','PurchaseController');
  Route::resource('customers','CustomerController');

});
