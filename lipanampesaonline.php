<?php
//lets pull the access token_get_all\
include_once('gettoken.php');

$url = 'https://sandbox.safaricom.co.ke/mpesa/stkpush/v1/processrequest';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header

//generate password
//$timestamp=date('yyyymmddhhiiss');
$timestamp=date('Ymdhis');
$shortcode='174379';
$passkey='bfb279f9aa9bdbcf158e97dd71a467cd2e0c893059b10f78e6b72ada1ed2c919';
$password=base64_encode($shortcode.$passkey.$timestamp);


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'BusinessShortCode' =>$shortcode,
  'Password' => $password,
  'Timestamp' => $timestamp,
  'TransactionType' => 'CustomerPayBillOnline',
  'Amount' => '100',
  'PartyA' => '254715694798',
  'PartyB' => $shortcode,
  'PhoneNumber' => '254715694798',
  'CallBackURL' => 'https://6df81856.ngrok.io/mpesa/response.php?type=lipaonline',
  'AccountReference' => '123459', //account number of receiver
  'TransactionDesc' => 'Benson Rwara Mbaaro Lunch'
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;



?>