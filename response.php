<?php
//decoding the responses from various calls

$type=$_GET['type'];
//get the response sent from the request files
$response=file_get_contents('php://input');

//lets open a file to write something onto
$fw=fopen('resultfile.php', 'w');

if($type=='b2c'){
$result=format_b2c($response);
fwrite($fw,$result->TransactionID);	
}
elseif($type=='b2b'){
$result=format_b2c($response);
fwrite($fw,$result->TransactionID.$result->ResultDesc.$result->InitiatorAccountCurrentBalance);	

}
elseif($type=='lipaonline'){

fwrite($fw,"hdhdhdh");	

}
else{

fwrite($fw,"Please specify the request type");	

}

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

//onlinepayment helper
function format_data($data){
	$master=array();
	$data=json_decode($data);
	$result=$data->Body->stkCallback;
	$master['MerchantRequestID']=$result->MerchantRequestID;
	$master['CheckoutRequestID']=$result->CheckoutRequestID;
	$master['ResultCode']=$result->ResultCode;
	if($result->ResultCode==0){
		//successful
$master['ResultDesc']=$result->ResultDesc;
if(isset($result->CallbackMetadata)){
	foreach($result->CallbackMetadata->Item as $item){
	$item=(array)$item;
$master[$item['Name']] = ((isset($item['Value'])) ? $item['Value'] : NULL);
           	
	}}}
	else{
		//cancelled
		 $master['ResultDesc']=$result->ResultDesc;
			}
	
return (object)$master;	 
}


?>