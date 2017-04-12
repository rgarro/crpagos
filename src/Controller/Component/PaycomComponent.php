<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

class PaycomComponent extends Object {

// Variables
	var $OrderID = "error";
	var $CredomaticAmt = 1.0;
	var $CCNumber = "4111111111111111";
	var $CCExp= "0115";
	var $Approved = false;
	var $Response = null;
	var $ResponseArr = array();

	function startup(&$controller) {
		$this -> controller = $controller;
		$this -> errmsg = '';
		$this -> SecsTimeOut = "30";
		$this -> CredomaticUrl = "https://paycom.credomatic.com/PayComBackEndWeb/common/requestPaycomService.go";
		$this -> LocalIps = array('127.0.0.1', '192.168.1.52');
		if(in_array($_SERVER['SERVER_ADDR'], $this -> LocalIps)) {
			$TheProto = "http://";
		} else {
			$TheProto = "https://";
		}
		$this -> UrlToRedirect = $TheProto. $_SERVER['SERVER_NAME'] . "/booking/getresponse/";
//Data from client
		$this -> UserName = "imonge007";
		$this -> Key_ID = "37530198";
		$this -> Key = "4CAe1W5mP4xuOWM8kbANyuGIBztYlWDc";
//Set ProcessorID to null to use Brand specific Processor's ID, else it will use this one for ALL Transactions
		$this -> ProcessorID = null;
		$this -> TransType = "auth";
	}

	function validation($CCNumber, $CCExp, $CredomaticAmt) {
		require_once 'ccvs.inc';
		$Validator = new CreditCardValidationSolution;
		$Accepted = array('Visa', 'MasterCard', 'American Express', 'JCB', 'Diners Club');
		$Validator -> validateCreditCard($CCNumber, $_SESSION['LocaleCode'], $Accepted, 'N');
		$this -> errmsg = $Validator -> CCVSError;
		$this -> CCNumber = $CCNumber;
		$this -> CCExp = $CCExp;
		$this -> CredomaticAmt = number_format($CredomaticAmt, 2, '.', '');
		$this -> CCType = $Validator -> CCVSType;
		if(is_null($this -> ProcessorID)){
//Check any special processorID
			switch($Validator->CCVSType) {
				case 'American Express' :
					$this -> ProcessorID = "INET0750";
					break;
				case 'MasterCard' :
				case 'Visa' :
				case 'JCB' :
				case 'Diners Club' :
					$this -> ProcessorID = "INET0749";
					break;
				default :
					$this -> errmsg = __('InvalidCCNumber', true);
					break;
			}
		}
		if(strlen($this -> errmsg) > 0) {
			return false;
		} else {
			return true;
		}
	}

	function process($OrderID =0) {
		$Time = time();
//Prepare the MD5 string
		$ToEncodeString = $OrderID . "|" . $this -> CredomaticAmt . "|" . $Time . "|" . $this -> Key;
//Do The Hash
		$TheHash = MD5($ToEncodeString);
//Prepare the Post Field Values
		$CredomaticValues = array("username" => $this -> UserName, "type" => $this -> TransType, "key_id" => $this -> Key_ID, "hash" => $TheHash, "time" => $Time, "redirect" => $this -> UrlToRedirect, "amount" => $this -> CredomaticAmt, "orderid" => $OrderID, "ccnumber" => $this -> CCNumber, "ccexp" => $this -> CCExp);
//Add any processor ID
		if(!is_null($this -> ProcessorID )){
			$CredomaticValues['processor_id'] = $this -> ProcessorID;
		}
//Build the Query String a must so Credomatic will accept the "POST"
		$QueryStr = http_build_query($CredomaticValues);
//Init the curl
		$ch = curl_init($this -> CredomaticUrl);
//https localhost problem
		if(in_array($_SERVER['SERVER_ADDR'], $this -> LocalIps)) {
			curl_setopt($ch, CURLOPT_SSL_VERIFYPEER, false);
		}
// sec timeout & some error reporting justin case
		curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, $this -> SecsTimeOut);
//Pretty User Agent
		curl_setopt($ch, CURLOPT_USERAGENT, "Mozilla/5.0 (Windows; U; Windows NT 6.1; en-US) AppleWebKit/534.13 (KHTML, like Gecko) RockMelt/0.9.46.126 Chrome/9.0.597.107 Safari/534.13");
//Set the method to post
		curl_setopt($ch, CURLOPT_POST, true);
//Set The Postfields
		curl_setopt($ch, CURLOPT_POSTFIELDS, $QueryStr);
//Our beloved header variables
		curl_setopt($ch, CURLOPT_HEADER, true);
//Return so we will have the headers on the variable
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
//Execute and get the headers
		if(!in_array($_SERVER['SERVER_ADDR'],$this -> LocalIps)){
			$Headers = curl_exec($ch);
		}else{
			$Headers = 'Location: ' . $this -> UrlToRedirect;
//Denied
			//$Headers.='?response=2&responsetext=DENEGADA&authcode=&transactionid=001775&avsresponse=U&cvvresponse=P&orderid=1&type=auth&response_code=205&username=imonge007&time=1300748755&amount=40.00&hash=7a3e7daf9c6da447f42b88391a1f27f5'. "\n";
//Approved
			//$Headers.='?response=1&responsetext=APROBADA&authcode=&transactionid=001775&avsresponse=U&cvvresponse=P&orderid=1&type=auth&response_code=100&username=imonge007&time=1300748755&amount=40.00&hash=8111070c5f6e31d81b3a08afaafcc043'. "\n";
//Bad Date
			$Headers.='?response=3&responsetext=Invalid card expiration date&authcode=&transactionid=&avsresponse=&cvvresponse=&orderid=&type=auth&response_code=307&username=imonge007&time=&amount=&hash=c9f4135e58da4227fd2602ec7ebc3947'. "\n";
//Bad Hash
			//$Headers.='?response=3&responsetext=Invalid card expiration date&authcode=&transactionid=&avsresponse=&cvvresponse=&orderid=&type=auth&response_code=307&username=imonge007&time=&amount=&hash=c9f4135e58da4227fd2602ec7ebc3946'. "\n";
		}
		$curl_error = curl_error($ch);
		curl_close($ch);

		if(strlen($Headers) == 0) {
			return "Location: " . $this -> UrlToRedirect;
		}

//Create an Array and send it for redirect
		$Headers = str_replace("\r", "", $Headers);
		$Headers = explode("\n", $Headers);
		foreach($Headers as $ThisHeader) {
			$ThisArr = explode(": ", $ThisHeader);
			if(strtolower($ThisArr[0]) == 'location') {
				return $ThisHeader;
				break;
			}
		}
		exit ;
	}

	function checkhash($RecHash, $OrderID, $Amount, $Response, $TransacionID, $AVSResponse, $CVVResponse, $Time ){
		$MyHash= MD5($OrderID."|".$Amount."|".$Response."|".$TransacionID."|".$AVSResponse."|".$CVVResponse."|".$Time."|".$this -> Key);
		if($RecHash === $MyHash){
			return true;
		}else{
			$this -> MyHash = $MyHash;
			return false;
		}
	}

}
