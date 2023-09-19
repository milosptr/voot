<?php

use App\Models\Tag;
use App\Models\Page;
use App\Models\User;
use App\Models\Inventory;
use Cocur\Slugify\Slugify;
use Illuminate\Http\Request;
use App\Http\Controllers\Users;
use App\Models\ProductCategory;
use App\Http\Controllers\Products;
use App\Http\Controllers\Web\Tags;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AssetsUpload;
use App\Http\Controllers\ProductAssets;
use App\Http\Controllers\TagController;
use App\Http\Controllers\CartController;
use Illuminate\Support\Facades\Redirect;
use App\Http\Controllers\EmailController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\StaffController;
use App\Http\Controllers\ColorsController;
use App\Http\Controllers\ConfigController;
use App\Http\Controllers\ReportsController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\LocationsController;
use App\Http\Controllers\MailChimpController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\NewsletterController;
use App\Http\Controllers\TermsPagesController;
use App\Http\Controllers\MembersInfoController;
use App\Http\Controllers\SettingsIconsController;
use App\Http\Controllers\AccountRequestController;
use App\Http\Controllers\SalesmanClientController;
use App\Http\Controllers\ShippingMethodController;
use App\Http\Controllers\ProductFavouriteController;
use App\Http\Controllers\RequestPriceCartController;
use App\Http\Controllers\ProductInformationController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| is assigned the "api" middleware group. Enjoy building your API!
|
*/

Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

// Product Categories
Route::get('product-categories', [CategoriesController::class, 'all']);
Route::get('product-categories/parent/{id}', [CategoriesController::class, 'byParent']);
Route::get('product-categories/{id}', [CategoriesController::class, 'index']);
Route::post('product-category', [CategoriesController::class, 'store']);
Route::post('product-category/{id}', [CategoriesController::class, 'update']);
Route::post('product-category-order', [CategoriesController::class, 'reorder']);
Route::post('sorted-categories', [CategoriesController::class, 'sortCategories']);
Route::post('v2/sorted-categories', [CategoriesController::class, 'sortCategoriesv2']);
Route::delete('product-categories/{id}', [CategoriesController::class, 'destroy']);

// Product icons
Route::get('settings-icons', [SettingsIconsController::class, 'index']);
Route::post('settings-icons', [SettingsIconsController::class, 'store']);
Route::delete('settings-icons/{id}', [SettingsIconsController::class, 'destroy']);

// Products
Route::get('product-variations/available-colors', [Products::class, 'availableColors']);
Route::get('product-information/{id}', [ProductInformationController::class, 'index']);
Route::get('product-variations/{id}', [Products::class, 'variations']);
Route::get('product-tags/{id}', [Products::class, 'tags']);
Route::get('product-media/{id}', [Products::class, 'media']);
Route::get('product-icons/{id}', [Products::class, 'icons']);
Route::get('cart-products', [Products::class, 'cartProducts']);
Route::get('products/all', [Products::class, 'all']);
Route::get('products/{id}', [Products::class, 'index']);
Route::post('products', [Products::class, 'store']);
Route::post('products/edit/{id}', [Products::class, 'update']);
Route::post('products/update', [Products::class, 'updateColumn']);
Route::post('product-variations/reorder', [Products::class, 'reorderVariations']);
Route::post('products/search', [Products::class, 'search']);
Route::delete('products/{id}', [Products::class, 'destroy']);
Route::delete('product-variations/{id}', [Products::class, 'destroyVariant']);

// Tags
Route::post('tags', [TagController::class, 'store']);

// Inventory
Route::get('check-sku/{sku}', [InventoryController::class, 'checkSku']);

// Favourites
Route::get('favourites/{product}/{user}', [ProductFavouriteController::class, 'index']);
Route::post('favourites', [ProductFavouriteController::class, 'store']);
Route::delete('favourites/{product}/{user}', [ProductFavouriteController::class, 'destroy']);

// Assets
Route::post('/assets', [AssetsUpload::class, 'upload'])->name('uploadAsset');
Route::post('/assets/new-product', [AssetsUpload::class, 'newProductUpload'])->name('uploadProductAsset');
Route::delete('assets/{id}', [ProductAssets::class, 'destroy']);

// Documents
Route::get('/documents/{id}', [DocumentController::class, 'index'])->name('indexDocument');
Route::post('/documents', [DocumentController::class, 'store'])->name('storeDocument');
Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('destroyDocument');

// Cart
Route::post('/add-to-cart', [CartController::class, 'store'])->name('addToCart');
Route::post('/add-to-cart/{user_id}', [CartController::class, 'update'])->name('removeFromCart');

// Request Price Cart
Route::get('/request/remove-from-cart/{id}', [RequestPriceCartController::class, 'destroy'])->name('removeFromRequestPriceCart');
Route::post('/request/add-to-cart', [RequestPriceCartController::class, 'store'])->name('addToRequestPriceCart');
Route::post('/request/ask-for-price', [RequestPriceCartController::class, 'askForPrice'])->name('askForPrice');

// Order
Route::get('orders/{id}/reorder', [OrderController::class, 'reorder']);
Route::get('orders/{id}/products', [OrderController::class, 'products']);
Route::post('resend-ax-order/{id}', [OrderController::class, 'resendAXOrder']);
Route::post('orders/{id}/notify', [EmailController::class, 'notifyCustomer']);
Route::post('request-order/{id}', [OrderController::class, 'store']);
Route::post('v2/request-order/{id}', [OrderController::class, 'storeOrder']);
Route::post('request-order/update/{id}', [OrderController::class, 'update']);
Route::post('request-order/change/{id}', [OrderController::class, 'change']);

// Customer
Route::get('customer-info/{id}', [Users::class, 'index'])->name('customerInfo');
Route::get('customer/{id}/companies', [Users::class, 'companies']);
Route::get('customer/{id}/reset-password', [Users::class, 'resetPassword']);
Route::get('customer/{id}/verify', [Users::class, 'verify']);
Route::get('customer/{id}/delete', [Users::class, 'destroy']);
Route::post('customer/new', [Users::class, 'create'])->name('createCustomer');
Route::post('customer/{id}', [Users::class, 'update']);
Route::post('customer/{id}/logo', [Users::class, 'logo']);
Route::post('invoice-email/{id}', [Users::class, 'invoiceEmail']);
Route::post('change-password/{id}', [Users::class, 'changePassword']);
Route::post('forgot-password', [Users::class, 'forgotPassword'])->name('forgot_password_request');
Route::get('forgot-password/{id}', [Users::class, 'forgotPassword'])->name('forgot_password_change');
Route::get('/check-ssn/{ssn}', [Users::class, 'checkSSN']);

// Members info
Route::get('members-info/{id}', [MembersInfoController::class, 'index']);
Route::post('members-info', [MembersInfoController::class, 'store']);
Route::post('members-info/{id}/edit', [MembersInfoController::class, 'edit']);
Route::delete('members-info/{id}', [MembersInfoController::class, 'destroy']);

// Staff
Route::get('staff', [StaffController::class, 'index']);
Route::post('staff', [StaffController::class, 'store']);
Route::delete('staff/{id}', [StaffController::class, 'destroy']);

// Locations
Route::get('locations', [LocationsController::class, 'index']);
Route::post('locations', [LocationsController::class, 'store']);
Route::delete('locations/{id}', [LocationsController::class, 'destroy']);

// Pages
Route::get('pages', [TermsPagesController::class, 'index']);
Route::post('pages', [TermsPagesController::class, 'store']);
Route::post('pages/{id}', [TermsPagesController::class, 'destroy']);

// Clients
Route::get('clients', [Users::class, 'getClients']);
Route::post('clients/search', [Users::class, 'search']);

// Color
Route::get('colors', [ColorsController::class, 'all']);
Route::post('colors', [ColorsController::class, 'store']);
Route::delete('colors/{id}', [ColorsController::class, 'destroy']);

// Config
Route::get('/config', [ConfigController::class, 'indexAll']);
Route::get('/config/{key}', [ConfigController::class, 'index']);
Route::post('/config', [ConfigController::class, 'updateOrStore']);
Route::post('/configs', [ConfigController::class, 'update']);

// Emails
Route::get('/resend-email/{id}', [EmailController::class, 'resendEmail']);

// Newsletter
Route::get('newsletter', [NewsletterController::class, 'index']);
Route::post('newsletter-registration', [MailChimpController::class, 'store']);
Route::post('newsletter', [NewsletterController::class, 'store']);
Route::delete('newsletter/{id}', [NewsletterController::class, 'destroy']);

// Reports
Route::get('/reports/orders', [ReportsController::class, 'orders']);

// Salesman Clients
Route::get('my-clients', [SalesmanClientController::class, 'forSalesman']);
Route::post('my-clients', [SalesmanClientController::class, 'store']);

// Account request
Route::get('account-request/{id}/finish', [AccountRequestController::class, 'toggleStatus']);
Route::post('account-request', [AccountRequestController::class, 'store']);

// Shipping methods
Route::get('shipping-methods', [ShippingMethodController::class, 'index']);
Route::post('shipping-methods', [ShippingMethodController::class, 'store']);
Route::post('shipping-methods/{id}', [ShippingMethodController::class, 'update']);
Route::delete('shipping-methods/{id}', [ShippingMethodController::class, 'destroy']);

//
Route::post('/slugify', function (Request $request) {
    $slugify = new Slugify();
    return response(['slug' => $slugify->slugify($request->get('name'), '-')], 200);
});
