<?php
header("Pragma: no-cache");
header("Cache-Control: no-cache");
header("Expires: 0");
// following files need to be included
require_once("./lib/config_paytm.php");
require_once("./lib/encdec_paytm.php");
$checkSum = "";

// below code snippet is mandatory, so that no one can use your checksumgeneration url for other purpose .
$findme   = 'REFUND';
$findmepipe = '|';

$paramList = array();
$content=trim(file_get_contents("php://input"));
$_POST=json_decode($content,true);

$paramList["MID"] = 'parkin46421047711652';
$paramList["ORDER_ID"] = '11212';
$paramList["CUST_ID"] = '12344';
$paramList["INDUSTRY_TYPE_ID"] = 'Retail';
$paramList["CHANNEL_ID"] = 'WEB';
$paramList["TXN_AMOUNT"] = '1';
$paramList["WEBSITE"] = 'APP_STAGING';
$paramList["CALLBACK_URL"]="https://pguat.paytm.com/paytmchecksum/paytmCallback.jsp";


foreach($_POST as $key=>$value)
{  
  $pos = strpos($value, $findme);
  $pospipe = strpos($value, $findmepipe);
  if ($pos === false || $pospipe === false) 
    {
        $paramList[$key] = $value;

        
    }
    

}


  
//Here checksum string will return by getChecksumFromArray() function.
$checkSum = getChecksumFromArray($paramList,PAYTM_MERCHANT_KEY);
//print_r($_POST);
 echo json_encode(array("CHECKSUMHASH" => $checkSum,"ORDER_ID" => $_POST["ORDER_ID"], "payt_STATUS" => "1"));
  //Sample response return to SDK
 
//  {"CHECKSUMHASH":"GhAJV057opOCD3KJuVWesQ9pUxMtyUGLPAiIRtkEQXBeSws2hYvxaj7jRn33rTYGRLx2TosFkgReyCslu4OUj\/A85AvNC6E4wUP+CZnrBGM=","ORDER_ID":"asgasfgasfsdfhl7","payt_STATUS":"1"} 
 
?>
