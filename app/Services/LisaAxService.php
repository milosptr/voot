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
    $this->requestURL = 'http://213.167.137.207:1456/LisaAxServices.asmx';
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
    $this->body = '<soap:Envelope
        xmlns:soap="http://www.w3.org/2003/05/soap-envelope"
        xmlns:tem="http://tempuri.org/">
        <soap:Header/>
        <soap:Body>
          <tem:CreateSalesOrder>
            <tem:order>
              <tem:CustomerID>1010105VOB</tem:CustomerID>
              <tem:Comments>Customer desired delivery address: $order->shipping_address</tem:Comments>
              <tem:SalesResponsibleID>VEFUR</tem:SalesResponsibleID>
              <tem:ReferenceNumber>Ref001 Milos Test</tem:ReferenceNumber>
              <tem:PaymModeCode>ST/GR</tem:PaymModeCode>
              <tem:SSN>5555559999</tem:SSN>
              <!--Kennitala needed for vefsala (800100HIS):-->
              <tem:DeliveryInfo>
                <tem:DlvModeCode>VS</tem:DlvModeCode>
                <tem:Name>$customer->name</tem:Name>
                <tem:Address>$customer->address</tem:Address>
                <tem:Zipcode>$customer->zip</tem:Zipcode>
                <tem:Country>$customer->country</tem:Country>
                <tem:ContactName>$customer->name</tem:ContactName>
                <tem:ContactPhone>$customer->phone</tem:ContactPhone>
                <tem:ContactEmail>$customer->email</tem:ContactEmail>
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
    Log::notice('Response: '.json_encode($response));
    curl_close($curl);

    return $response;
  }
}
