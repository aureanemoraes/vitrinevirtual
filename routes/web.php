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
    return redirect('login');
});

Route::get('/login', function () {
    return view('auth.login');
})->name('login');

Route::get('/home', function () {
    return view('home');
});
Route::get('/products/all', function () {
    return view('products.index');
});

Route::get('/users', function () {
    return view('users.index');
});


Route::get('/users/create', function () {
    return view('users.create');
});

Route::get('/products/edit/{id}', function ($id) {
    return view('products.update');
});

Route::get('/users/edit/{id}', function ($id) {
    return view('users.update');
});

Route::get('/products/create', function () {
    return view('products.create');
});

Route::get('/vitrine', function() {
    return view('all-products');
});

Route::get('/vitrine/empreendedoras', function() {
    return view('bussinesses-w');
});


Route::get('/vitrine/empreendedoras/{user_id}', function($user_id) {
    return view('products-user');
});

Route::get('/vitrine/produto/{product_id}', function($product_id) {
    return view('product');
});
