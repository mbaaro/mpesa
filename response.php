<?php
//decoding the responses from various calls

$type=$_GET['type'];
//get the response sent from the request files
$response=file_get_contents('php://input');
$result=format_b2c($response);
//lets open a file to write something onto
$fw=fopen('resultfile.php', 'w');

if($type=='b2c'){
fwrite($fw,$result->TransactionID);	
}
elseif($type=='b2b'){

fwrite($fw,$result->TransactionID."  b2c");	

}
else(){

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



?>