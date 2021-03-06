<?php

use App\Models\Order;
use App\Http\Controllers\Web\Tags;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Products;
use App\Http\Controllers\Web\WebPages;
use App\Http\Controllers\Web\Categories;
use App\Http\Controllers\Admin\PagesController;
use App\Models\Page;
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

Route::get('email-template', function() {  return view('emails.order-created'); });

Route::get('/login', function() {
  return view('auth.login');
})->name('login');

Route::get('/register', function() {
  return view('auth.register');
})->name('register');

Route::get('/registration-pending', function() {
  return view('auth.registration-pending');
});
Route::get('/registration-thanks', function() {
  return view('auth.registration-thanks');
});


// Customer routes
Route::prefix('/app')->middleware(['auth'])->group(function () {
  Route::get('/', function () {
    return view('customer.dashboard');
  });
  Route::get('/dashboard', function () {
    return view('customer.dashboard');
  });
  Route::get('/account', function () {
    return view('customer.account');
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
});

// Frontend + Language routes
Route::get('/page/{slug}', function($slug) {
  $page = Page::where('slug', $slug)->get()->first();
  if(!isset($page))
    return view('web.pages.404');
  return view('web.pages.single-page', compact('page'));
});
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
