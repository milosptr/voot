<?php
namespace App\Services;

use App\Models\User;

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
        'Content-Type: text/xml'
      ),
    ));

    $response = curl_exec($curl);

    var_dump($curl);
    curl_close($curl);

    return $response;
  }
}
