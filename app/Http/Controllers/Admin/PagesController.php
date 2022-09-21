<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Category;
use App\Http\Controllers\Controller;
use App\Http\Controllers\Users;
use App\Http\Resources\Categories;
use App\Http\Resources\Products;
use App\Models\Order;
use App\Models\Product;
use App\Models\User;
use App\Services\PaginationService;
use Illuminate\Support\Facades\Session;

class PagesController extends Controller
{

    public function dashboard()
    {
      return view('admin.dashboard');
    }
    public function categories()
    {
      $categories = Categories::collection(Category::tree());
      return view('admin.categories', compact('categories'));
    }
    public function createCategory()
    {
      $categories = Categories::collection(Category::tree());
      return view('admin.new-category', compact('categories'));
    }
    public function editCategory($id)
    {
      $category = Category::find($id);
      $categories = Categories::collection(Category::tree());
      return view('admin.edit-category', compact('category', 'categories'));
    }

    public function products(Request $request)
    {
      $categories = Categories::collection(Category::tree());
      $products = Product::orderBy('updated_at', 'DESC')->paginate(15);
      $pagination = PaginationService::extract($products);
      $products = Products::collection($products);
      return view('admin.products', compact('categories', 'products', 'pagination'));
    }

    public function createNewProduct()
    {
      $categories = Categories::collection(Category::tree());
      return view('admin.new-product', compact('categories'));
    }

    public function editProduct($id)
    {
      $categories = Categories::collection(Category::tree());
      $product = Product::find($id);

      return view('admin.edit-product', compact('product', 'categories'));
    }

    public function orders() {
      return view('admin.orders');
    }

    public function editOrder($id) {
      $order = Order::find($id);
      return view('admin.edit-order', compact('order'));
    }

    public function settings()
    {
      return view('admin.settings');
    }

    public function clients(Request $request)
    {
      $customers = User::where('role', 'customer')->orderBy('id', 'DESC')->get();

      return view('admin.clients', compact('customers'));
    }

    public function editCustomer($id)
    {
      $customer = User::find($id);
      return view('admin.edit-customer', compact('customer'));
    }

}
