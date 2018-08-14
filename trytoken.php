
<?php
//check if you have curl loaded
if(!function_exists("curl_init")) die("cURL extension is not installed");

$url ='https://sandbox.safaricom.co.ke/oauth/v1/generate?grant_type=client_credentials';
  $credentials = base64_encode('UcD02EGzJsIiwWPmOJtyH0BFhLHmnyFF:v8Uy5ZwbLeUN1lgk');
                                  
 $curl_options = array(
                    CURLOPT_URL => $url,
                    CURLOPT_HEADER => TRUE,
                    CURLOPT_RETURNTRANSFER => TRUE,
                    CURLOPT_TIMEOUT => 0,
                    CURLOPT_SSL_VERIFYPEER => 0,
                    CURLOPT_FOLLOWLOCATION => TRUE,
                    CURLOPT_ENCODING => 'gzip,deflate',
                                        
            );

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_HTTPHEADER, array('Authorization: Basic '.$credentials)) ;//setting a custom header
            
           // curl_setopt_array( $ch, $curl_options );
            $output = curl_exec( $ch );
            curl_close($ch);
var_dump($output);
$arr = json_decode($output,true);

foreach($arr['items'] as $val)
{
        echo $val['thumbnailURL'].'<br>';       
}

?>