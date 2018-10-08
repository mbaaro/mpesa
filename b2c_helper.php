<?php

header('Content-Type: application/json');

/*$b2c ='{"Result":{"ResultType":0,"ResultCode":0,"ResultDesc":"The service request has been accepted successfully.","OriginatorConversationID":"19455-424535-1","ConversationID":"AG_20170717_00006be9c8b5cc46abb6","TransactionID":"LGH3197RIB","ResultParameters":{"ResultParameter":[{"Key":"TransactionReceipt","Value":"LGH3197RIB"},{"Key":"TransactionAmount","Value":8000},{"Key":"B2CWorkingAccountAvailableFunds","Value":150000},{"Key":"B2CUtilityAccountAvailableFunds","Value":133568},{"Key":"TransactionCompletedDateTime","Value":"17.07.2017 10:54:57"},{"Key":"ReceiverPartyPublicName","Value":"254708374149 - John Doe"},{"Key":"B2CChargesPaidAccountAvailableFunds","Value":0},{"Key":"B2CRecipientIsRegisteredCustomer","Value":"Y"}]},"ReferenceData":{"ReferenceItem":{"Key":"QueueTimeoutURL","Value":"https://internalsandbox.safaricom.co.ke/mpesa/b2cresults/v1/submit"}}}}'; */

//$b2c=file_get_contents('php://input');



//echo $b2c;
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

     return (object) $master;


}
//print_r(format_b2c($b2c));

?>