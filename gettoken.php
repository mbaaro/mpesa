<?php 
///get token

                  $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
                    $credentials = base64_encode('UcD02EGzJsIiwWPmOJtyH0BFhLHmnyFF:v8Uy5ZwbLeUN1lgk');

                  $curl = curl_init();
                  curl_setopt($curl, CURLOPT_URL, $url);
                  curl_setopt($curl, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)); //setting a custom header
                  curl_setopt($curl, CURLOPT_HEADER, false);
                  curl_setopt($curl, CURLOPT_RETURNTRANSFER,true);
        
                  curl_setopt($curl, CURLOPT_SSL_VERIFYPEER, false);

                  $curl_response = curl_exec($curl);
                  $decoded=json_decode($curl_response);
                  $access_token=$decoded->access_token;
                  return $access_token;
                  //echo $access_token

?>