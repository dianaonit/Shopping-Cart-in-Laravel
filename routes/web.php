<?php

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

Auth::routes();


//admin signin , profile and logout
Route::get('/signin', [
   'uses' => 'AdminController@getSignin',
   'as' => 'admin.signin',
   
 ]);

 Route::post('/signin', [
   'uses' => 'AdminController@postSignin',
   'as' => 'admin.signin',
   
 ]);

 Route::get('/admin/profile', [
   'uses' => 'AdminController@getProfile',
   'as' => 'admin.profile',
   
]);

Route::get('/logout', [
   'uses' => 'AdminController@getLogout',
   'as' => 'admin.logout',
   
 ]);

 

//for CRUD operations on PRODUCTS
Route::resource('products','ProductController');


Route::get('/', [
   'uses' => 'ProductController@getIndex',
   'as' => 'product.index'
]);




//for crud operations on cart
Route::get('/add-to-cart/{id}',[
   'uses' => 'ProductController@getAddToCart',
   'as' => 'product.addToCart'
]);

Route::get('/reduce/{id}',[
   'uses' => 'ProductController@getReduceByOne',
   'as' => 'product.reduceByOne'
]);

Route::get('/remove/{id}',[
   'uses' => 'ProductController@getRemoveItem',
   'as' => 'product.remove'
]);



//for shopping cart
Route::get('/shopping-cart',[
   'uses' => 'ProductController@getCart',
   'as' => 'product.shoppingCart'
]);

Route::get('/checkout',[
   'uses' => 'ProductController@getCheckout',
   'as' => 'shop.checkout',
   'middleware'=>'auth'//only an authenticated user can access the checkout page 
]);

Route::post('/checkout',[
   'uses' => 'ProductController@postCheckout',
   'as' => 'shop.checkout',
   'middleware'=>'auth'//only an authenticated user can access the checkout page 
]);


//use prefix and middleware for defining a group- they are executed in the order they are listed in the array
Route::group(['prefix'=>'user'],function(){

   Route::group(['middleware'=>'guest'],function(){
         //routes for signup-register user
      Route::get('/signup', [
        'uses' => 'UserController@getSignup',
        'as' => 'user.signup',
        // a guest user can access the sigup page
      ]);

      Route::post('/signup', [
        'uses' => 'UserController@postSignup',
        'as' => 'user.signup',
        // a guest user can access the sigup page
      ]);
   
        //routes for sign in 
       Route::get('/signin', [
       'uses' => 'UserController@getSignin',
       'as' => 'user.signin',
       // a guest user can access the sigin page
      ]);
   
      Route::post('/signin', [
        'uses' => 'UserController@postSignin',
        'as' => 'user.signin',
        // a guest user can access the sigin page
      ]);
   });



   Route::group(['middleware'=>'auth'],function(){
      //route for user profile
      Route::get('/profile', [
         'uses' => 'UserController@getProfile',
         'as' => 'user.profile',
         //only an authenticated user can access the profile
      ]);
   
      //route for log out user
      Route::get('/logout', [
        'uses' => 'UserController@getLogout',
        'as' => 'user.logout',
        //only an authenticated user can access the login out
      ]);
   });
   
});

