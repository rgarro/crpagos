<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;

class CardinalComponent extends Object {

// Variables
	var $OrderID = "error";
	var $CredomaticAmt = 1.0;
	var $CCNumber = "4111111111111111";
	var $CCExp= "0115";
	var $Approved = false;
	var $Response = null;
	var $ResponseArr = array();

	function startup(&$controller) {
//IMPORTATNT **** COMPANY'S VALUES file
		require 'cardinal_companies'.DS.$_SESSION['Company']['CurrentCompanyID'].'.php';

		$this -> controller = $controller;
		$this -> errmsg = '';
		$this -> SecsTimeOut = "30";
		$this -> CredomaticUrl = "https://credomatic.compassmerchantsolutions.com/api/transact.php";
		$this -> LocalIps = array('127.0.0.1', '192.168.1.52');
		if(in_array($_SERVER['SERVER_ADDR'], $this -> LocalIps)) {
			$TheProto = "http://";
		} else {
			$TheProto = "https://";
		}
		$this -> UrlToRedirect = $TheProto. $_SERVER['SERVER_NAME'] . "/pay-invoice/";

//Set ProcessorID to null to use Brand specific Processor's ID, else it will use this one for ALL Transactions
		$this -> ProcessorID = null;
		$this -> TransType = "auth";
	}

	function validation($CCNumber, $CCExp, $CredomaticAmt, $CVV, $Currency = 840) {
		require 'ccvs.inc';
		$Validator = new CreditCardValidationSolution;
		$Accepted = array('American Express', 'Diners Club', 'Discover/Novus', 'JCB', 'MasterCard', 'Visa');
		$Validator -> validateCreditCard($CCNumber, $_SESSION['LocaleCode'], $Accepted, 'N');
		$this -> errmsg = $Validator -> CCVSError;
		$this -> CCNumber = $CCNumber;
		$this -> CCExp = $CCExp;
		$this -> CVV= $CVV;
		$this -> CredomaticAmt = number_format($CredomaticAmt, 2, '.', '');
		$this -> CCType = $Validator -> CCVSType;
		if(is_null($this -> ProcessorID)){
//Check any special processorID
			switch($Validator->CCVSType) {
				case 'American Express' :
					//840 es dolares
					if($Currency == 840){
						$this -> ProcessorID = $this -> AmexDols;
					}else{
						$this -> ProcessorID = $this -> AmexCols;
					}
					//var_dump($Currency, $this -> ProcessorID);
					//exit;
					break;

				case 'MasterCard' :
				case 'Visa' :
				case 'JCB' :
				case 'Diners Club' :
				case 'Discover/Novus':
					//840 es dolares
					if($Currency == 840){
						$this -> ProcessorID = $this -> OthersDols;
					}else{
						$this -> ProcessorID = $this -> OthersCols;
					}
					//var_dump($Currency, $this -> ProcessorID);
					//exit;
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
		$CredomaticValues = array("firstname" => $this -> ClientName, "lastname" => $this -> ClientLastName, "email" => $this -> ClientEmail, "type" => $this -> TransType, "key_id" => $this -> Key_ID, "hash" => $TheHash, "time" => $Time, "redirect" => $this -> UrlToRedirect, "amount" => $this -> CredomaticAmt, "orderid" => $OrderID, "ccnumber" => $this -> CCNumber, "ccexp" => $this -> CCExp, "cvv" => $this ->  CVV);

		//Add any processor ID
		if(!is_null($this -> ProcessorID )){
			$CredomaticValues['processor_id'] = $this -> ProcessorID;
		}
		//var_dump($Currency, $this -> ProcessorID );
		//exit;
//Debug Here
//		var_dump($CredomaticValues);
//		exit;
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

		$Headers = curl_exec($ch);

		$curl_error = curl_error($ch);

		curl_close($ch);

		if(strlen($Headers) == 0) {
			return "Location: " . $this -> UrlToRedirect;
		}

//Create an Array and send it for redirect
		$Headers = str_replace("\r", "", $Headers);
		$Headers = explode("\n", $Headers);

//Get The location and do the redirect
			foreach($Headers as $ThisHeader) {
				$ThisArr = explode(": ", $ThisHeader);
				if(strtolower($ThisArr[0]) == 'location') {
					return $ThisHeader;
					break;
				}elseif(strlen($ThisArr[0]) < 20){
//give the page haders, no harm done
					header($ThisHeader);
				}else{
//else give the content to redirect to the verified by visa crap
					echo '<h1>',__('PleaseWait'),'</h1>';
					echo $ThisHeader;
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
