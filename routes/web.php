<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Products;
use App\Http\Controllers\Web\Categories;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Web\Tags;
use App\Http\Controllers\Web\WebPages;
use App\Models\Order;

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

  Route::get('/test', [PagesController::class, 'test']);
});

// Frontend + Language routes
Route::prefix(parseLocaleLan())->group(function () {
  Route::get('/', [WebPages::class, 'index']);

  Route::get('/about', [WebPages::class, 'about'])->name('about');
  Route::get('/um-okkur', [WebPages::class, 'about'])->name('about');

  Route::get('/services', [WebPages::class, 'services'])->name('services');
  Route::get('/thjonusta', [WebPages::class, 'services'])->name('services');

  Route::get('/contact', [WebPages::class, 'contact'])->name('contact');
  Route::get('/hafa-samband', [WebPages::class, 'contact'])->name('contact');

  Route::get('/cart', [WebPages::class, 'cart']);
  Route::get('/thank-you', [WebPages::class, 'thanks']);

  Route::get('/tag/{slug}', [Tags::class, 'indexProducts'])->name('all.tag');

  Route::get('/products', [Products::class, 'all'])->name('all_products');
  Route::get('/vorur', [Products::class, 'all'])->name('all_products');

  Route::get('products/search', [Products::class, 'search'])->name('products.search');
  Route::get('/product/{product}', [Products::class, 'uncategorised']);
  Route::get('/{category}', [Categories::class, 'index'])->name('category');
  Route::get('/{category}/{product}', [Products::class, 'index'])->name('product');
});

require __DIR__.'/auth.php';
