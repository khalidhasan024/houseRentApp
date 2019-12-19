<?php

use App\Http\Controllers\TenantController;

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
// +++++++++++++++++++++
// Route::get('/', function () {
//     return view('index');
// });

// Pages routes =================
Route::get('/', 'PageController@index') -> name("index");


// Flats routes ==================
Route::resource('/flats', 'FlatController');
Route::get('/flats/details/{flat}','FlatController@details') -> name("flats.details");
Route::post('/flats/book','FlatController@book') -> name("flats.book");
Route::post('/flats/reserve','FlatController@reserve') -> name("flats.reserve");
Route::post('/flats/tenant_update','FlatController@tenant_update') -> name("flats.tenant_update");



// Tenants routes ===================
Route::get('tenant/next', 'TenantController@next') -> name('tenant.next');
Route::get('/tenant/previous', 'TenantController@previous') -> name('tenant.previous');
Route::resource('/tenant', 'TenantController');


// Expense routes ======================
Route::resource('/expense', 'ExpenseController');


// Electricity routes ========================
Route::get('/electricity', 'ElectricityController@index') -> name("electricity.index");
Route::get('/electricity/create', 'ElectricityController@create') -> name("electricity.create");
Route::post('/electricity', 'ElectricityController@store') -> name("electricity.store");
Route::post('/electricity/show', 'ElectricityController@show') -> name("electricity.show");


// Payments routes =====================
Route::get('/payment' , 'PaymentController@index') -> name('payment.index');
Route::post('/payment/new' , 'PaymentController@create') -> name('payment.create');
Route::post('/payment/history' , 'PaymentController@history') -> name('payment.history');
Route::post('/payment' , 'PaymentController@store') -> name('payment.store');



// Documents routes =====================
Route::get('/docs', 'PageController@docs') -> name("docs");


// Authentication routes ====================
Auth::routes(['register' => false]);






// For any undefined route 
// Redirects to 404 page ===========================
Route::any('{all}', function(){
    return view('errors.404');
})->where('all', '.*');
