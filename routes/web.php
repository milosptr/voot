<?php

use App\Models\Order;
use App\Mail\OrderCreated;
use App\Http\Controllers\Web\Tags;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Products;
use App\Http\Controllers\Web\WebPages;
use App\Http\Controllers\Web\Categories;
use App\Http\Controllers\Admin\PagesController;
use Mcamara\LaravelLocalization\Facades\LaravelLocalization;

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
Route::get('/web/ax-service', function() {
  $curl = curl_init();

  curl_setopt_array($curl, array(
    CURLOPT_URL => 'http://213.167.137.207:1456/LisaAxServices.asmx',
    CURLOPT_RETURNTRANSFER => true,
    CURLOPT_ENCODING => '',
    CURLOPT_MAXREDIRS => 10,
    CURLOPT_TIMEOUT => 0,
    CURLOPT_FOLLOWLOCATION => true,
    CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
    CURLOPT_CUSTOMREQUEST => 'POST',
    CURLOPT_POSTFIELDS =>'<?xml version="1.0" encoding="utf-8"?>
      <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
        <soap:Body>
          <ConnectionVerify xmlns="http://tempuri.org/" />
        </soap:Body>
      </soap:Envelope>',
    CURLOPT_HTTPHEADER => array(
      'Content-Type: text/xml'
    ),
  ));

  $response = curl_exec($curl);

  curl_close($curl);
  print_r($response);
  dd($response);

});


Route::get('/login', function() {
  return view('auth.login');
})->name('login');

Route::get('/register', function() {
  return view('auth.register');
})->name('register');


// Customer routes
Route::prefix('/app')->middleware(['auth'])->group(function () {
  Route::get('/', function () {
    return view('customer.dashboard');
  });
  Route::get('/dashboard', function () {
      return view('customer.dashboard');
  });
  Route::get('/orders', function () {
    return view('customer.orders');
  });
  Route::get('/orders/{id}', function ($id) {
    $order = Order::find($id);
    return view('customer.order', compact('order'));
  });
  Route::get('/favourites', function () {
    return view('customer.favourites');
  });
});

// Backend routes
Route::prefix('/backend')->middleware(['admin'])->group(function () {
  Route::get('/', [PagesController::class,'dashboard']);
  Route::get('/dashboard', [PagesController::class,'dashboard'])->name('backend');

  Route::get('/categories', [PagesController::class,'categories']);
  Route::get('/categories/new', [PagesController::class,'createCategory']);
  Route::get('/categories/edit/{id}', [PagesController::class,'editCategory']);

  Route::get('/products', [PagesController::class, 'products'])->name('products');
  Route::get('/products/new', [PagesController::class, 'createNewProduct']);
  Route::get('/products/edit/{id}', [PagesController::class, 'editProduct']);

  Route::get('/orders', [PagesController::class, 'orders'])->name('admin-orders');
  Route::get('/orders/{id}', [PagesController::class, 'editOrder']);

  Route::get('/settings', [PagesController::class, 'settings'])->name('settings');
  Route::get('/settings/clients', [PagesController::class, 'clients'])->name('customers');
  Route::get('/settings/clients/{id}', [PagesController::class, 'editCustomer'])->name('customer-edit');
  Route::get('/settings/{page}', [PagesController::class, 'settings'])->name('settings');

  Route::get('/test', [PagesController::class, 'test']);
});

Route::get('/send/email', function() {
    $order = Order::all()->first();
    Mail::to('milosptr@icloud.com')->send(new OrderCreated($order));

    return 'Email sent Successfully';
});

Route::get('email-template', function() { return view('emails.order-created'); });

// Frontend + Language routes
Route::group(['prefix' => LaravelLocalization::setLocale(), 'middleware' => [ 'localize' ]], function () {

  Route::get('/', [WebPages::class, 'index']);

  Route::get(LaravelLocalization::transRoute('routes.about'), [WebPages::class, 'about'])->name('about');
  Route::get(LaravelLocalization::transRoute('routes.services'), [WebPages::class, 'services'])->name('services');
  Route::get(LaravelLocalization::transRoute('routes.contact'), [WebPages::class, 'contact'])->name('contact');

  Route::get(LaravelLocalization::transRoute('routes.cart'), [WebPages::class, 'cart']);
  Route::get(LaravelLocalization::transRoute('routes.thanks'), [WebPages::class, 'thanks']);

  Route::get(LaravelLocalization::transRoute('routes.all_products'), [Products::class, 'all'])->name('all_products');

  Route::get('/tag/{slug}', [Tags::class, 'indexProducts'])->name('all.tag');
  Route::get('products/search', [Products::class, 'search'])->name('products.search');
  Route::get(LaravelLocalization::transRoute('routes.product_uncategorised'), [Products::class, 'uncategorised']);

  Route::get('/{category}', [Categories::class, 'index'])->name('category');
  Route::get('/{category}/{product}', [Products::class, 'index'])->name('product');

});



require __DIR__.'/auth.php';
