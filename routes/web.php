<?php

use App\Models\User;
use App\Models\Order;
use App\Mail\OrderCreated;
use App\Services\LisaAxService;
use App\Http\Controllers\Web\Tags;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Web\Products;
use App\Http\Controllers\Web\WebPages;
use App\Http\Controllers\Web\Categories;
use App\Http\Controllers\Admin\PagesController;
use App\Http\Controllers\Auth\RegisteredUserController;
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

Route::get('/web/loggg', function() {
  Log::info('This is info log');
  Log::warning('This is warning log');
  Log::error('This is error log');
  Log::alert('This is alert log');
  Log::debug('This is debug log');
});

Route::get('/web/ax-service', function() {
  $body = '<?xml version="1.0" encoding="utf-8"?>
  <soap:Envelope xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema" xmlns:soap="http://schemas.xmlsoap.org/soap/envelope/">
    <soap:Body>
      <ConnectionVerify xmlns="http://tempuri.org/" />
    </soap:Body>
  </soap:Envelope>';
  $customer = User::find(2);

  $response = LisaAxService::forCustomer($customer)
    ->setRequestURL('http://192.168.120.137:1456/LisaAxServices.asmx')
    ->setRequestBody($body)
    ->send();



  print_r($response);
  dd($response);
});

Route::get('/web/ax', function() {
  $xml = '<?xml version="1.0" encoding="utf-8"?><soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:xsi="http://www.w3.org/2001/XMLSchema-instance" xmlns:xsd="http://www.w3.org/2001/XMLSchema"><soap:Body><CreateSalesOrderResponse xmlns="http://tempuri.org/"><CreateSalesOrderResult><SalesOrdID>S0018533</SalesOrdID><SalesTakerEmail /><ErrorCode>0</ErrorCode><ErrorMessage /><ErrorOrderLines /></CreateSalesOrderResult></CreateSalesOrderResponse></soap:Body></soap:Envelope>';
  $clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $xml);
  $xml = simplexml_load_string($clean_xml);

  dd(isset($xml->Body->Cr) ? $xml->Body->CreateSalesOrderResponse->CreateSalesOrderResult->SalesOrdID : ':)');
  // $customer = User::find(2);
  // $order = Order::find(15);
  // $response = LisaAxService::forCustomer($customer)
  //         ->setBodyForOrderCreated($order)
  //         ->getBody();
  // dd($response);
});

Route::get('/web/ax-service-live', function() {
  $body = '<soap:Envelope xmlns:soap="http://www.w3.org/2003/05/soap-envelope" xmlns:tem="http://tempuri.org/">
  <soap:Header/>
  <soap:Body>
  <tem:CreateSalesOrder>
  <tem:order>
  <tem:CustomerID>1010105VOB</tem:CustomerID>
  <tem:Comments>Comment Test Bruno</tem:Comments>
  <tem:SalesResponsibleID>VEFUR</tem:SalesResponsibleID>
  <tem:ReferenceNumber>Ref001 Bruno Test</tem:ReferenceNumber>
  <tem:PaymModeCode>ST/GR</tem:PaymModeCode> <!--Payment Mode: -->
  <tem:SSN>5555559999</tem:SSN><!--Kennitala needed for vefsala (800100HIS):-->
  <tem:DeliveryInfo>
  <!--Delivery Mode: -->
  <tem:DlvModeCode>VS</tem:DlvModeCode>
  <tem:Name>DlvName Bruno</tem:Name>
  <tem:Address>DlvAddress G 10</tem:Address>
  <tem:Zipcode>101</tem:Zipcode>
  <tem:Country>IS</tem:Country>
  <tem:ContactName>DlvContactName Bruno</tem:ContactName>
  <tem:ContactPhone>DlvContactPhone 5515555 </tem:ContactPhone>
  <tem:ContactEmail>DlvContactEmail test@hamp.is</tem:ContactEmail>
  </tem:DeliveryInfo>
  <tem:SalesOrderLines>
  <!--Zero or more repetitions:-->
  <tem:SalesOrderLine>
  <tem:LineID>9t5e6679-7425-40de-944b-e07fc1f90rt9</tem:LineID><!--your line id reference-->
  <tem:ItemId>1000433</tem:ItemId>
  <tem:Quantity>10</tem:Quantity>
  </tem:SalesOrderLine>
  </tem:SalesOrderLines>
  </tem:order>
  </tem:CreateSalesOrder>
  </soap:Body>
  </soap:Envelope>';
  $customer = User::find(2);

  $response = LisaAxService::forCustomer($customer)
    ->setRequestBody($body)
    ->send();

  print_r($response);

  $response2 = LisaAxService::forCustomer($customer)
    ->setRequestURL('https://ifconfig.me')
    ->send();

  print_r($response2);
  dd($response, $response2);
});


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

  Route::get('/test', [PagesController::class, 'test']);
});

Route::get('/send/email', function() {
    $order = Order::all()->first();
    Mail::to('milosptr@icloud.com')->send(new OrderCreated($order));

    return 'Email sent Successfully';
});

Route::get('email-template', function() { $password = 'As$5!2@lls)'; return view('emails.password-changed', compact('password')); });

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
