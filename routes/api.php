<?php

use App\Http\Controllers\AssetsUpload;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoriesController;
use App\Http\Controllers\DocumentController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ProductAssets;
use App\Http\Controllers\ProductFavouriteController;
use App\Http\Controllers\SettingsIconsController;
use App\Http\Controllers\ProductInformationController;
use App\Http\Controllers\Products;
use App\Http\Controllers\Users;
use App\Http\Controllers\Web\Tags;
use App\Models\ProductCategory;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

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
Route::get('product-categories/{id}', [CategoriesController::class, 'index']);
Route::post('product-category', [CategoriesController::class, 'store']);
Route::post('product-category/{id}', [CategoriesController::class, 'update']);
Route::post('product-category/delete/{id}', [CategoriesController::class, 'destroy']);
Route::post('product-category-order', [CategoriesController::class, 'reorder']);

// Product icons
Route::get('settings-icons', [SettingsIconsController::class, 'index']);
Route::post('settings-icons', [SettingsIconsController::class, 'store']);

// Products
Route::get('product-information/{id}', [ProductInformationController::class, 'index']);
Route::get('product-variations/{id}', [Products::class, 'variations']);
Route::get('product-tags/{id}', [Products::class, 'tags']);
Route::get('product-media/{id}', [Products::class, 'media']);
Route::get('product-icons/{id}', [Products::class, 'icons']);
Route::get('cart-products', [Products::class, 'cartProducts']);
Route::post('products', [Products::class, 'store']);
Route::post('products/edit/{id}', [Products::class, 'update']);
Route::post('products/search', [Products::class, 'search']);
Route::delete('product-variations/{id}', [Products::class, 'destroyVariant']);

// Favourites
Route::get('favourites/{product}/{user}', [ProductFavouriteController::class, 'index']);
Route::post('favourites', [ProductFavouriteController::class, 'store']);
Route::delete('favourites/{product}/{user}', [ProductFavouriteController::class, 'destroy']);

// Assets
Route::post('/assets', [AssetsUpload::class, 'upload'])->name('uploadAsset');
Route::post('/assets/new-product', [AssetsUpload::class, 'newProductUpload'])->name('uploadAsset');
Route::delete('assets/{id}', [ProductAssets::class, 'destroy']);

// Documents
Route::get('/documents/{id}', [DocumentController::class, 'index'])->name('indexDocument');
Route::post('/documents', [DocumentController::class, 'store'])->name('storeDocument');
Route::delete('/documents/{id}', [DocumentController::class, 'destroy'])->name('destroyDocument');

// Cart
Route::post('/add-to-cart', [CartController::class, 'store'])->name('addToCart');
Route::delete('/add-to-cart/{user_id}/{sku}', [CartController::class, 'destroy'])->name('removeFromCart');

// Order
Route::post('request-order/{id}', [OrderController::class, 'store']);
Route::post('request-order/update/{id}', [OrderController::class, 'update']);

// Customer
Route::get('customer-info/{id}', [Users::class, 'index'])->name('customerInfo');
Route::get('customer/{id}/reset-password', [Users::class, 'resetPassword']);
Route::get('customer/{id}/delete', [Users::class, 'destroy']);
Route::post('customer/{id}', [Users::class, 'update']);
Route::post('customer/{id}/logo', [Users::class, 'logo']);

// Clients
Route::post('clients/search', [Users::class, 'search']);
