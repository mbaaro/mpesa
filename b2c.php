<?php
include_once('gettoken.php');

$url = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'InitiatorName' => 'testapi',
  'SecurityCredential' => 'ksXfXO3tBxlTIoEWLnvbHRpQ+VA76drgY//YwtTJh/D8P0QHgEwKSqJKHg2WXCn58qvekgD9jLOe9tvMrimid7RVhv0g//x93+/RRu2nVwwafnmXi13f1yuqyyuXClF/w/t7V2A1hgS6PjCx9ZrK+6j4+rwyRPsslq1xHhKGJxcQlar3rHIsJMzTl7tMObwBoq9HEIJ+28td4kOmwpg+WibPCeDh4is1I+9+mJEIjpmgHRU9P943of27l7wXN4rHGJAIjNjdpcEXhssI/ibY0hb97BY/9d9cAqklmWPSbcuV8UO+wMKWophqBGGHqVgSa4CK4vqKspXtkUgurVYkCA==',
  'CommandID' => 'SalaryPayment',
  'Amount' => '10',
  'PartyA' => '600566',
  'PartyB' => '254708374149',
  'Remarks' => 'payment of your august salary',
  'QueueTimeOutURL' => 'https://713b66b5.ngrok.io/mpesa/response.php?type=timeout',
  'ResultURL' => 'https://713b66b5.ngrok.io/mpesa/response.php?type=b2c',
  'Occasion' => ' '
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
//print_r($curl_response);
echo $curl_response;




?>