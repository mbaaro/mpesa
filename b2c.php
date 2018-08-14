<?php
include_once('gettoken.php');

$url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'InitiatorName' => 'Safaricomapi',
  'SecurityCredential' => 'VKKYfN74',
  'CommandID' => 'SalaryPayment',
  'Amount' => '500',
  'PartyA' => '600736',
  'PartyB' => '254708374149',
  'Remarks' => 'payment of your august salary',
  'QueueTimeOutURL' => 'https://bd7c7307.ngrok.io/mpesa/response.php?type=timeout',
  'ResultURL' => 'https://bd7c7307.ngrok.io/mpesa/response.php?type=b2c',
  'Occasion' => ' '
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;


?>