<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\LoginController;


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
// Home
Route::get('/', 'Auth\LoginController@home');
Route::get('/home', 'HomeController@show');

//Listing books
Route::get('/books-id', 'HomeController@listById');
Route::get('/books-rating', 'HomeController@listByRating');
Route::get('/books-price', 'HomeController@listByPrice');





// Search
//aquele id n esta a fazer nada, dps é para tirar
Route::get('search/{id}', 'SearchBarController@show');
Route::get('category/{key}', 'CategoryController@show');

// Individual Profile
Route::get('user/{id}', 'UserController@show');
Route::get('user/{id}/edit', 'UserController@edit');
Route::put('user/{id}/edit/update', 'UserController@update');
Route::get('user/{id}/purchase-history', 'PurchaseHistoryController@index');
Route::get('user/{id}/review-history', 'ReviewController@showUserReviews');
Route::get('user/{id}/payment-methods', 'CreditCardController@show');
Route::get('user/{id}/confirm-delete', 'UserController@confirmDelete');
Route::delete('user/{id}/delete/confirmed', 'UserController@destroy');

// Payment Methods
Route::get('user/{id}/payment-methods/add', 'CreditCardController@add');
Route::put('user/{id}/payment-methods/add/add-to-payment-methods', 'CreditCardController@store');
Route::delete('user/{id}/payment-methods/{creditcardid}/delete', 'CreditCardController@destroy');
Route::get('user/{id}/payment-methods/{creditcardid}/edit', 'CreditCardController@edit');
Route::put('user/{id}/payment-methods/{creditcardid}/edit/update', 'CreditCardController@update');

// Books
Route::get('api/books/viewBook/{id}', 'BookProductController@show');

// Admin
Route::get('/api/books/viewBook/{id}/edit', 'BookProductController@edit');
Route::put('/api/books/viewBook/{id}/edit/update', 'BookProductController@update');
Route::get('/api/books/addBook', 'BookProductController@create');
Route::put('/api/books/addBook/confirmed', 'BookProductController@store');
Route::get('/admin/users', 'AdminController@users');
Route::get('/admin/users/{id}', 'AdminController@userDetails');
Route::get('/admin/orders/{orderid}', 'UserOrderController@show');
Route::put('/admin/orders/{orderid}/{bookid}/updateStatus', 'AdminController@updateStatus');
Route::put('/admin/user/{id}/update', 'AdminController@updateUser');



// Review
//Route::get('api/books/viewBook/{id}', 'ReviewController@show');
Route::get('api/books/viewBook/{id}/addReview', 'ReviewController@addReviewForm');
Route::put('api/books/viewBook/{id}/addReview/add-to-reviews', 'ReviewController@store');
Route::delete('user/{id}/review-history/{reviewid}/delete', 'ReviewController@destroy');
Route::get('user/{id}/review-history/{reviewid}/edit', 'ReviewController@edit');
Route::put('user/{id}/review-history/{reviewid}/edit/update', 'ReviewController@update');

// Cart
Route::put('api/books/viewBook/{id}/add-to-cart', 'CartController@store');
Route::delete('users/{id}/cart/{bookid}/delete', 'CartController@destroy');
Route::get('users/{id}/cart', 'CartController@index');
//Route::post('users/{id}/cart/add', 'CartController@store');
//Route::post('users/{id}/cart/remove', 'CartController@show');
//Route::post('users/{id}/cart/update', 'CartController@show');

// Wishlist
Route::put('api/books/viewBook/{id}/add-to-wishlist', 'WishlistController@store');
Route::delete('users/{id}/wishlist/{bookid}/delete', 'WishlistController@destroy');
Route::get('users/{id}/wishlist', 'WishlistController@index');

// Checkout
Route::get('/users/{id}/cart/checkout', 'OrderInformationController@checkout');
Route::put('/users/{id}/cart/checkout/confirmed', 'OrderInformationController@confirmedCheckout');
Route::delete('/user/{id}/purchase-history/{orderid}/delete', 'OrderInformationController@destroy');

// Authentication
Route::get('login', 'Auth\LoginController@showLoginForm')->name('login');
Route::post('login', 'Auth\LoginController@login');
Route::get('logout', 'Auth\LoginController@logout')->name('logout');
Route::get('register', 'Auth\RegisterController@showRegistrationForm')->name('register');
Route::post('register', 'Auth\RegisterController@register');

// Static Pages
Route::get('about', 'AboutUsController@show');
Route::get('contact', 'ContactController@show');
Route::get('faq', 'FAQController@show');

// Notification
Route::get('users/{id}/notifications', 'NotificationController@index');