<?php
/*$response='{"Body":{"stkCallback":{"MerchantRequestID":"19465-780693-1","CheckoutRequestID":"ws_CO_27072017154747416","ResultCode":0,
      "ResultDesc":"The service request is processed successfully.","CallbackMetadata":{"Item":[{"Name":"Amount","Value":1},{
            "Name":"MpesaReceiptNumber","Value":"LGR7OWQX0R"},{ "Name":"Balance","Value":"200"},{"Name":"TransactionDate","Value":20170727154800
          },{"Name":"PhoneNumber","Value":254721566839}]}}}}';
		*/
$response=file_get_contents('php://input');
$data1=json_decode($response);
if(isset($response)){
	//lets make the 
	$fw=fopen('resultfile.php', 'w');
	fwrite($fw,'nothing was passed');
	}else{
$fw=fopen('resultfile.php', 'w');
	fwrite($fw,'nothing was passed');	
}

























		
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