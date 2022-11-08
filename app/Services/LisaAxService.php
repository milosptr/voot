<?php
namespace App\Services;

use App\Models\Order;
use App\Models\User;
use Illuminate\Support\Facades\Log;

class LisaAxService {
  public $user;
  public $requestURL;
  public $requestType;
  public $body;

  public function __construct()
  {
    // test port 1456
    $this->requestURL = 'http://213.167.137.207:1458/LisaAxServices.asmx';
    $this->requestType = 'POST';

    return $this;
  }

  public static function forCustomer(User $user)
  {
    return new Static($user);
  }

  public static function storeOrderId($response, Order $order)
  {
    $clean_xml = str_ireplace(['SOAP-ENV:', 'SOAP:'], '', $response);
    $xml = simplexml_load_string($clean_xml);
    $orderId = null;
    if(isset($xml->Body) && isset($xml->Body->CreateSalesOrderResponse) && isset($xml->Body->CreateSalesOrderResponse->CreateSalesOrderResult) && isset($xml->Body->CreateSalesOrderResponse->CreateSalesOrderResult->SalesOrdID)) {
      $orderId = (string) $xml->Body->CreateSalesOrderResponse->CreateSalesOrderResult->SalesOrdID;
      $order->update(['order_id' => $orderId]);
    }

    return $orderId;
  }

  public function setRequestURL($url)
  {
    $this->requestURL = $url;
    return $this;
  }

  public function setRequestType($requestType)
  {
    $this->requestType = $requestType;
  }

  public function setRequestBody($body) {
    $this->body = $body;
    return $this;
  }

  public function setBodyForOrderCreated(Order $order)
  {
    $customer = $order->user;
    $company = User::where('key', $order->customer_key)->where('ssn', $order->user->ssn)->first();
    $this->body = '<soap:Envelope
        xmlns:soap="http://www.w3.org/2003/05/soap-envelope"
        xmlns:tem="http://tempuri.org/">
        <soap:Header/>
        <soap:Body>
          <tem:CreateSalesOrder>
            <tem:order>
              <tem:CustomerID>'.$customer->key.'VOB</tem:CustomerID>
              <tem:Comments></tem:Comments>
              <tem:SalesResponsibleID>VEFUR</tem:SalesResponsibleID>
              <tem:ReferenceNumber>REFCUSTID'.$customer->id.'</tem:ReferenceNumber>
              <tem:PaymModeCode>STGR</tem:PaymModeCode>
              <tem:SSN>'.$customer->ssn.'</tem:SSN>
              <tem:DeliveryInfo>
                <tem:DlvModeCode>VS</tem:DlvModeCode>
                <tem:Name>'.$company->name.'</tem:Name>
                <tem:Address>'.$customer->address.'</tem:Address>
                <tem:Zipcode>'.$customer->zip.'</tem:Zipcode>
                <tem:Country>'.$customer->country.'</tem:Country>
                <tem:ContactName>'.$customer->name.'</tem:ContactName>
                <tem:ContactPhone></tem:ContactPhone>
                <tem:ContactEmail>'.( isset($customer->invoice_email) ? $customer->invoice_email : $customer->email ).'</tem:ContactEmail>
              </tem:DeliveryInfo>
              <tem:SalesOrderLines>
      ';

      foreach ($order->order as $item) {
        $this->body .= '
        <tem:SalesOrderLine>
          <tem:LineID>O'.$order->id.'</tem:LineID>
          <tem:ItemId>'.$item['sku'].'</tem:ItemId>
          <tem:Quantity>'.$item['qty'].'</tem:Quantity>
        </tem:SalesOrderLine>
        ';
      }

      $this->body .= '
              </tem:SalesOrderLines>
            </tem:order>
          </tem:CreateSalesOrder>
        </soap:Body>
      </soap:Envelope>
    ';

    return $this;
  }

  public function getBody() {
    return $this->body;
  }

  public function send() {
    $curl = curl_init();

    curl_setopt_array($curl, array(
      CURLOPT_URL => $this->requestURL,
      CURLOPT_RETURNTRANSFER => true,
      CURLOPT_ENCODING => '',
      CURLOPT_MAXREDIRS => 10,
      CURLOPT_TIMEOUT => 0,
      CURLOPT_FOLLOWLOCATION => true,
      CURLOPT_HTTP_VERSION => CURL_HTTP_VERSION_1_1,
      CURLOPT_CUSTOMREQUEST => $this->requestType,
      CURLOPT_POSTFIELDS => $this->body,
      CURLOPT_HTTPHEADER => array(
        'Content-Type: text/xml',
        'X-Forwarded-For: 212.44.101.99',
        'Host: 212.44.101.99'
      ),
    ));

    $response = curl_exec($curl);
    Log::notice(json_encode(curl_getinfo($curl)));
    Log::notice($this->body);
    Log::notice('Response from AX: '.json_encode($response));
    curl_close($curl);

    return $response;
  }
}
