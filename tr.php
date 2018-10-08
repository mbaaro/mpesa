<?php 

$data=array(
'ResultType'=>'0',
 'ResultType'=>'0',
 'ResultCode'=>'0',
 'ResultDesc'=>'The service request has been accepted successfully.',
 'OriginatorConversationID'=>'19455-424535-1',
  'ConversationID'=>'AG_20170717_00006be9c8b5cc46abb6',
  'TransactionID'=>'LGH3197RIB',
  'ResultParameters'=>array(
   'ResultParameter'=>[
array('key'=>'TransactionReceipt'),
   ]),
  );

$json1= json_encode(array('Response' => $data ));
$json2= json_decode($json1);
var_dump($json2['Response']['ResultParameters']['ResultParameter']);

/*{
    "Result":{
    "ResultType":0,
    "ResultCode":0,
    "ResultDesc":"The service request has been accepted successfully.",
    "OriginatorConversationID":"19455-424535-1",
    "ConversationID":"AG_20170717_00006be9c8b5cc46abb6",
    "TransactionID":"LGH3197RIB",
    "ResultParameters":{
      "ResultParameter":[
        {
          "Key":"TransactionReceipt",
          "Value":"LGH3197RIB"
        },
        {
          "Key":"TransactionAmount",
          "Value":8000
        },
        {
          "Key":"B2CWorkingAccountAvailableFunds",
          "Value":150000
        },
        {
          "Key":"B2CUtilityAccountAvailableFunds",
          "Value":133568
        },
        {
          "Key":"TransactionCompletedDateTime",
          "Value":"17.07.2017 10:54:57"
        },
        {
          "Key":"ReceiverPartyPublicName",
          "Value":"254708374149 - John Doe"
        },
        {
          "Key":"B2CChargesPaidAccountAvailableFunds",
          "Value":0
        },
        {
          "Key":"B2CRecipientIsRegisteredCustomer",
          "Value":"Y"
        }
      ]
    },
    "ReferenceData":{
      "ReferenceItem":{
        "Key":"QueueTimeoutURL",
        "Value":"https://internalsandbox.safaricom.co.ke/mpesa/b2cresults/v1/submit"
      }
    }
  }}*/

  /*/*$myfile = fopen("resultfile.php", "w") or die("Unable to open file!");
$txt =var_dump($json1);
fwrite($myfile, $txt);
*/

?>