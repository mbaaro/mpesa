<?php
//get the access token
include_once('gettoken.php');
$url = 'https://sandbox.safaricom.co.ke/mpesa/b2b/v1/paymentrequest';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header
$securitycredential='FvFUKHuA8vs9YlEe/nhzZk5+qPxma47FWH5QAEINIym4tZQmfDf8il0kVzgxzv3Qgw863Yq7mhtFql2zwAzv9KCwqnks1v6v94UFMEjXSdrqpog7cSgVgcz+Dyo3JXYUh9TM2MsD9ObgnMJasdWgJMHX5SZTPiSQ6w9ZNQi0g6OMwDN0McanYLTVEDOsPLIDnKaq/DUQvOvFDUzlN/Fy/dKuENiaD4dDdRGi9W3cfwpBZMuM0/RwiYyl8+J0GGskg28OHSqDGR5446ELsFOG0fGQEyhhW3pm7XxVfJPScQrE7DO6wCdGTHahOZGcfAAnjcyzJkQYPeRQUh+dP2lprA==';

$curl_post_data = array(
  //Fill in the request parameters with valid values
  'Initiator' => 'apitest518',
  'SecurityCredential' =>$securitycredential,
  'CommandID' => 'BusinessPayBill',
  'SenderIdentifierType' => '4',
  'RecieverIdentifierType' => '4',
  'Amount' => '50',
  'PartyA' => '601518',
  'PartyB' => '600000',
  'AccountReference' => 'bgbgb',
  'Remarks' => 'Cheque payment',
  'QueueTimeOutURL' => 'https://6df81856.ngrok.io/mpesa/response.php?type=timeout',
  'ResultURL' => 'https://6df81856.ngrok.io/mpesa/response.php?type=b2b',
  
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;



?>