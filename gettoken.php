<?php 
///get token

                  $consumerkey='UcD02EGzJsIiwWPmOJtyH0BFhLHmnyFF';
                  $consumersecret='v8Uy5ZwbLeUN1lgk';
                  $url = 'https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
                  $credentials = base64_encode($consumerkey.":".$consumersecret);

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