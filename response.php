<?php
//include('b2c_helper.php');


$b2c ='{"Result":{"ResultType":0,"ResultCode":0,"ResultDesc":"The service request has been accepted successfully.","OriginatorConversationID":"19455-424535-1","ConversationID":"AG_20170717_00006be9c8b5cc46abb6","TransactionID":"LGH3197RIB","ResultParameters":{"ResultParameter":[{"Key":"TransactionReceipt","Value":"LGH3197RIB"},{"Key":"TransactionAmount","Value":8000},{"Key":"B2CWorkingAccountAvailableFunds","Value":150000},{"Key":"B2CUtilityAccountAvailableFunds","Value":133568},{"Key":"TransactionCompletedDateTime","Value":"17.07.2017 10:54:57"},{"Key":"ReceiverPartyPublicName","Value":"254708374149 - John Doe"},{"Key":"B2CChargesPaidAccountAvailableFunds","Value":0},{"Key":"B2CRecipientIsRegisteredCustomer","Value":"Y"}]},"ReferenceData":{"ReferenceItem":{"Key":"QueueTimeoutURL","Value":"https://internalsandbox.safaricom.co.ke/mpesa/b2cresults/v1/submit"}}}}'; 

//$b2c=file_get_contents('php://input');
/*include 'b2c_helper.php' ;
$response=format_b2c($b2c);
$fw=fopen('resultfile.php', 'a');

//fwrite($fw, $response->ResultType);
//fwrite($fw, $response);
foreach($response as $master1){
fwrite($fw, $master1);
	
fwrite($fw, $master1['ResultDesc']);
	
fwrite($fw, $master1->ResultDesc;
}
*/
$result=format_b2c($b2c);

print_r($result->ResultDesc);

//format_b2c($data);
function format_b2c($data){
     $master = array();
     $data = json_decode($data);
     $result = $data->Result;
     $master['ResultType'] = $result->ResultType;
     $master['ResultCode'] = $result->ResultCode;
     $master['TransactionID'] = $result->TransactionID;
     $master['ResultDesc'] = $result->ResultDesc;
     $master['OriginatorConversationID'] = $result->OriginatorConversationID;
     $master['ConversationID'] = $result->ConversationID;
    if($result->ResultCode == 0){
        if(isset($result->ResultParameters)){
            foreach($result->ResultParameters->ResultParameter as $item){
                $item = (array) $item;
                $master[$item['Key']] = ((isset($item['Value'])) ? $item['Value'] : NULL);
            }
        }
    }else{
        if(isset($result->ResultParameters)){
            $master[$result->ResultParameters->ResultParameter->Key] = $result->ResultParameters->ResultParameter->Value;
        }
    }


 /*$fw=fopen('resultfile.php','w');
 fwrite($fw, $master->ResultType);
 
 print_r($master->ResultType);
 foreach($master as $master1){
	fwrite($fw, $master1->ResultType); 
	 }
 
 fwrite($fw, $master1->ResultType);
     //
*/
 
return (object) $master;


}
 

function sendmessage($message){
    // Be sure to include the file you've just downloaded
require_once('AfricasTalkingGateway.php');

// Specify your authentication credentials
$username="sandbox";
$apikey="4bf62af822fac19210277653049dfab0650f8a92269e50992b8c575432b089e3";

// Specify the numbers that you want to send to in a comma-separated 

//list
// Please ensure you include the country code (+254 for Kenya in this case)


$recipients = "+254715694798";

// And of course we want our recipients to know what we really do
 //$message    = "I'm a lumberjack and its ok, I sleep all night and I 

// work all day";

// Create a new instance of our awesome gateway class
$gateway  = new AfricasTalkingGateway($username,$apikey,"sandbox");


//$gateway    = new AfricasTalkingGateway($username, $apikey);

/********************************************************************

*****************
  NOTE: If connecting to the sandbox:

  1. Use "sandbox" as the username
  2. Use the apiKey generated from your sandbox application
     https://account.africastalking.com/apps/sandbox/settings/key
  3. Add the "sandbox" flag to the constructor

  $gateway  = new AfricasTalkingGateway($username, $apiKey, 

"sandbox");
*********************************************************************

*****************/

// Any gateway error will be captured by our custom Exception class 

//below, 
// so wrap the call in a try-catch block

try 
{ 
  // Thats it, hit send and we'll take care of the rest. 
  $results = $gateway->sendMessage($recipients, $message);
            
  foreach($results as $result) {
    // status is either "Success" or "error message"
    echo " Number: " .$result->number;
    echo " Status: " .$result->status;
    echo " StatusCode: " .$result->statusCode;
    echo " MessageId: " .$result->messageId;
    echo " Cost: "   .$result->cost."\n";
  }
}
catch ( AfricasTalkingGatewayException $e )
{
  echo "Encountered an error while sending: ".$e->getMessage();
}

// DONE!!! 


}   
?>