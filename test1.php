<?php
	
  
include_once('gettoken.php');
  


$publicKey = file_get_contents("C:/xampp/htdocs/mpesa/cert.cer");

$plaintext = "ch5AMdxCZnBasPbTn0k0pQAgqYqWsViQUuSPU1vmrK2YL918GKHVG7hs1hiyj40wZOMMdZdNODKe9CygTknaYc1dYrMJMp7JeZXZ3LfsT3oYeMWQiSm81IACrLryLL3nUB+lSVr0zrC/hYoJ2LmKJal/fN+Jvt3GIPQ6DrliAUMLQ9++p4qI/D/CCw2v8MamDMN+Jhc+i+U4Fu6mos+lOa/DEHbJd6q2BTR2emglzxqjK1EhZR+FB0316ruv1eOCjF9sKaY8T/KtM4US4CzWcNhTkRBrytOLwv71+pCtnvY9uwT6NQJua3dDYkOzDKlqffl4ukkZ337aXg3agRphSw==";


openssl_public_encrypt($plaintext, $encrypted, $publicKey, OPENSSL_PKCS1_PADDING);

 //echo "<br>credentials <br>". base64_encode($encrypted);
 


//B2C

$url1 = 'https://sandbox.safaricom.co.ke/mpesa/b2c/v1/paymentrequest';

$curl = curl_init();
curl_setopt($curl, CURLOPT_URL, $url1);
curl_setopt($curl, CURLOPT_HTTPHEADER, array('Content-Type:application/json','Authorization:Bearer '.$access_token)); //setting custom header


$curl_post_data = array(
  //Fill in the request parameters with valid values
  'InitiatorName' => 'testapi',
  'SecurityCredential' => 'ksXfXO3tBxlTIoEWLnvbHRpQ+VA76drgY//YwtTJh/D8P0QHgEwKSqJKHg2WXCn58qvekgD9jLOe9tvMrimid7RVhv0g//x93+/RRu2nVwwafnmXi13f1yuqyyuXClF/w/t7V2A1hgS6PjCx9ZrK+6j4+rwyRPsslq1xHhKGJxcQlar3rHIsJMzTl7tMObwBoq9HEIJ+28td4kOmwpg+WibPCeDh4is1I+9+mJEIjpmgHRU9P943of27l7wXN4rHGJAIjNjdpcEXhssI/ibY0hb97BY/9d9cAqklmWPSbcuV8UO+wMKWophqBGGHqVgSa4CK4vqKspXtkUgurVYkCA==',
  'CommandID' => 'SalaryPayment',
  'Amount' => '500',
  'PartyA' => '600566',
  'PartyB' => '254708374149',
  'Remarks' => 'payment of your august salary',
  'QueueTimeOutURL' => 'https://f5dd70d6.ngrok.io/mpesa/response.php?type=timeout',
  'ResultURL' => 'https://f5dd70d6.ngrok.io/mpesa/response.php?type=b2c',
  'Occasion' => ' '
);

$data_string = json_encode($curl_post_data);

curl_setopt($curl, CURLOPT_RETURNTRANSFER, true);
curl_setopt($curl, CURLOPT_POST, true);
curl_setopt($curl, CURLOPT_POSTFIELDS, $data_string);

$curl_response = curl_exec($curl);
print_r($curl_response);

echo $curl_response;
echo time();


?>