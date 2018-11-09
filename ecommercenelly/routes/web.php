<?php
// ini_set('max_execution_time', '300');
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
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Category;
use App\Product;
use App\User;
use App\Feature;
use App\FeatureProduct;

Route::get('/', function () {
    return view('welcome');
});
//USSD
Route::get('/ussd', 'UssdController@index');
//Categories

Route::get('/categories', 'CategoryController@index');

Route::get('/categories/create', 'CategoryController@create');

Route::post('/categories', 'CategoryController@store');

Route::get('/categories/edit/{id}', 'CategoryController@edit');

Route::patch('/categories/update/{id}', 'CategoryController@update');

Route::get('/categories/delete/{id}', 'CategoryController@destroy');

//Users
Route::get('/users', 'UserController@index');

Route::get('/users/create', 'UserController@create');

Route::post('/users', 'UserController@store');

Route::get('/users/edit/{id}', 'UserController@edit');

Route::patch('/users/update/{id}', 'UserController@update');

Route::get('/users/delete/{id}', 'UserController@destroy');


//Products
Route::get('/products/{id}', 'ProductController@index');

Route::get('/productss/create', 'ProductController@create');  

// Route::get('/featuress/create', function () {
//     dd("hallo");
// $user = auth()->user();
// return view('features.createF',compact('user'));
// });

Route::post('/products', 'ProductController@store');

Route::get('/products/edit/{id}', 'ProductController@edit');

Route::get('/products/features/{id}', 'ProductController@features');//to add product Feature per product

Route::patch('/products/update/{id}', 'ProductController@update');

Route::get('/products/delete/{id}', 'ProductController@destroy');
//Buyer Products
Route::get('/productsbuyer', 'ProductController@indexBuyer');//for Buyer t view products that are in stock

Route::get('/productsbuyers', 'ProductController@indexBuyers');

Route::get('/productss/create', 'ProductController@create');  

Route::post('/products', 'ProductController@store');

Route::get('/products/edit/{id}', 'ProductController@edit');

Route::get('/products/features/{id}', 'ProductController@features');

Route::patch('/products/update/{id}', 'ProductController@update');

Route::get('/products/delete/{id}', 'ProductController@destroy');

//Features
Route::get('/features/{id}', 'FeatureController@index');

Route::get('/featuress/create', 'FeatureController@create');//add feature if you are in feature page

Route::post('/features', 'FeatureController@store');

Route::get('/features/edit/{id}', 'FeatureController@edit');

Route::patch('/features/update/{id}', 'FeatureController@update');

Route::get('/features/delete/{id}', 'FeatureController@destroy');

//ProductFeatures
Route::post('/productfeatures/{id}', 'ProductFeatureController@store');

Route::get('/productfeatures/{id}/{user}', 'ProductFeatureController@create');//to add productfeatures for a particular product

Route::patch('/productfeatures/update/{id}', 'ProductFeatureController@update');

Route::get('/productfeaturesedit/{id}/{feature}', 'ProductFeatureController@edit');

Route::patch('/productfeatures/update/{id}', 'ProductFeatureController@update');

Route::get('/productfeaturesdelete/{id}/{feature}', 'ProductFeatureController@destroy');

//Orders
// Route::get('/orders/{id}', 'OrderController@index');//for vie cart table format

Route::get('/orders/viewcart', 'OrderController@getCart');//to view cart

Route::get('/ordersbuyer/{id}', 'OrderController@ordersbuyer');//for pending orders ordersbuyercomplete

Route::get('/ordersbuyercomplete/{id}', 'OrderController@ordersbuyercomplete');//for completed orders

Route::get('/ordersseller', 'OrderController@ordersseller');//seller view all orders 

Route::get('/orderview/{id}/{order}', 'OrderController@orderview');//seller view single order 

Route::get('/orderviewsingle/{id}', 'OrderController@orderssellersingle');

Route::get('/orderbuyerview/{id}', 'OrderController@orderbuyerview');//buyer view single product

Route::get('/orderscomplete/{id}/{order}/{product}', 'OrderController@orderscomplete');

Route::get('/orders/cart/{id}/{product}', 'OrderController@cart');//for add to cart table format
//for add to cart table format
Route::get('/orders/cart/{id}', 'OrderController@getAddToCart');//to add to cart

Route::get('/orders/create/{id}', 'OrderController@create');//for status placed to specify quantities before placing order to seller

Route::post('/orders', 'OrderController@store');//to place order to seller

Route::get('/orders/edit/{id}', 'OrderController@edit');

Route::patch('/orders/update/{id}', 'OrderController@update');

Route::get('/orders/delete/{id}', 'OrderController@destroy');

Route::post('/orderitems/{results}', 'OrderController@orderitems');

//reports
Route::get('/reports/{id}', 'OrderController@reports');

Route::get('/reportsview/{id}/{order}', 'OrderController@productreports');

//reviews
Route::get('/reviewsbuyer', 'ProductController@reviewsbuyerindex');

Route::get('/reviewsseller/{id}', 'ProductController@reviewsseller');

Route::get('/reviewsbuyer/{id}', 'ProductController@reviewsbuyer');

Route::post('/reviewsbuyerstore', 'ProductController@reviewsbuyerstore');

Route::get('/reviewsbuyerdestroy/{review}/{user}', 'ProductController@reviewsbuyerdestroy');

//product Images
Route::get('/productimage/{id}', 'ProductImageController@create');

Route::post('/productimages', 'ProductImageController@store');

//Charts
Route::get('/bar-chart', 'FusionCharts@index');

Route::get('products/chart', 'FusionCharts@show');
//Auth and middlewre


Auth::routes();

Route::get('/home', 'HomeController@index');

Route::group(['middleware'=>'App\Http\Middleware\Admin'],function()
{
    Route::match(['get','post'],'/adminOnlyPage','HomeController@admin');
});

Route::group(['middleware'=>'App\Http\Middleware\Buyer'],function()
{
    Route::match(['get','post'],'/buyerOnlyPage','HomeController@buyer');
});

Route::group(['middleware'=>'App\Http\Middleware\Seller'],function()
{
    
    // Route::get('/categories', 'CategoryController@index');
    Route::match(['get','post'],'/sellerOnlyPage','HomeController@seller');
});


