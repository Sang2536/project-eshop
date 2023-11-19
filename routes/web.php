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

//  Auth
Route::get('/register', '\App\Http\Controllers\AuthController@registerLayout')->name('register.layout');
Route::post('/register-user', '\App\Http\Controllers\AuthController@registerUser')->name('register-user');
Route::get('/login', '\App\Http\Controllers\AuthController@loginLayout')->name('login.layout');
Route::post('/login-user', '\App\Http\Controllers\AuthController@loginUser')->name('login-user');
Route::get('/logout', '\App\Http\Controllers\AuthController@logoutUser')->name('logout-user');

//  Dashboard
Route::get('/dashboard', '\App\Http\Controllers\DashboardController@index')->name('dashboards.index');
Route::get('/dashboard/chart', '\App\Http\Controllers\DashboardController@getRevenuaChart');

//  Home
Route::resource('/home', '\App\Http\Controllers\HomeController');

//  Analytic
Route::resource('/analytics', '\App\Http\Controllers\AnalyticController');

//  Report
Route::get('/reports', '\App\Http\Controllers\ReportController@index')->name('reports.index');

//  Config
Route::resource('/configs', '\App\Http\Controllers\ConfigController');

//  Error
Route::resource('/errors', '\App\Http\Controllers\ErrorController');

//  users
Route::resource('/users', '\App\Http\Controllers\UserController');
Route::get('/user/{uid}/profile', '\App\Http\Controllers\UserController@profile')->name('user.profile');
Route::get('/user/{uid}/setting', '\App\Http\Controllers\UserController@setting')->name('user.setting');

//  Roles
Route::resource('/roles', '\App\Http\Controllers\RoleController');

//  contacts
Route::resource('/contacts', '\App\Http\Controllers\ContactController');

//  categories
Route::resource('/categories', '\App\Http\Controllers\CategoryController');

//  units
Route::resource('/units', '\App\Http\Controllers\UnitController');

//  products
Route::resource('/products', '\App\Http\Controllers\ProductController');

//  invoice discount
Route::resource('/invoce-discounts', '\App\Http\Controllers\InvoiceDiscountController');

//  Transaction
Route::resource('/transactions', '\App\Http\Controllers\TransactionController');
Route::post('/transactions/select-product', '\App\Http\Controllers\TransactionController@selectProduct')->name('transactions.select-product');
