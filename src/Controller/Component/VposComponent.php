<?php
namespace App\Controller\Component;

use Cake\Controller\Component;
use Cake\Controller\ComponentRegistry;
use Cake\Core\App;
/**
 * Vpos component
 */
class VposComponent extends Component
{
  public $name="Vpos";
  public $useTable=false;

  public function initialize(array $config){

  }
  public function initializeB($InvoiceID = 0, $Amount = 100, $TransactionID = null, $VposCurCode = 188, $VposLocaleCode = 'SP', $ClientName='', $ClientLastName = '', $ClientEmail = '', $ClientPhone = ''){
    
  }

/*
  public function initializeB($InvoiceID = 0, $Amount = 100, $TransactionID = null, $VposCurCode = 188, $VposLocaleCode = 'SP', $ClientName='', $ClientLastName = '', $ClientEmail = '', $ClientPhone = ''){

    include current(App::path("Lib")).DS.'bncr'.DS.'vpos_plugin.php';
//Todos los parámetros del componente se colocan en un arreglo de
//cadenas, cuyo campo llave es el nombre del parámetro

    $array_send['acquirerId']=$_SESSION['Company']['AcquirerID'];
    $array_send['commerceId']=$_SESSION['Company']['CommerceID'];
    $array_send['purchaseAmount']=$Amount;
//$Currency;
    $array_send['purchaseCurrencyCode']= $VposCurCode;
//$TransactionID
    $array_send['purchaseOperationNumber']= $TransactionID;
    $array_send['billingAddress']='';
    $array_send['billingCity']='';
    $array_send['billingState']='';
    $array_send['billingCountry']='';
    $array_send['billingZIP']='';
    $array_send['billingPhone']=$ClientPhone;
    $array_send['billingEMail']=$ClientEmail;
    $array_send['billingFirstName']=$ClientName;
    $array_send['billingLastName']=$ClientLastName;
//LocaleCode
    $array_send['language']=$VposLocaleCode;
//$InvoiceNumber
    $array_send['reserved1']=$InvoiceID;


//Setear un arreglo de cadenas con los parámetros que serán devueltos
//por el componente
    $array_get['XMLREQ']="";
    $array_get['DIGITALSIGN']="";
    $array_get['SESSIONKEY']="";

//Vector de inicialización
    $VI = $_SESSION['Company']['HexNumber'];
    if(strrchr($_SESSION['Company']['KeyName'], '.') == '.TESTING'){
      $AlignetKeyName = "ALIGNET.TESTING.PHP.CRYPTO.PUBLIC.txt";
    }else{
      $AlignetKeyName = "ALIGNET.PRODUCTION.PHP.CRYPTO.PUBLIC.txt";
    }
    $llaveVPOSCryptoPub = file_get_contents(CONFIGS.'keys'.DS.$AlignetKeyName);
    $llaveComercioFirmaPriv =
file_get_contents(current(App::path("Lib")).'/keys'.DS.$_SESSION['Company']['CurrentCompanyID'].DS.strtoupper($_SESSION['Company']['KeyName']).'.SIGNATURE.PRIVATE.pem');

//Call the function
    VPOSSend($array_send,$array_get,$llaveVPOSCryptoPub,$llaveComercioFirmaPriv,$VI);
    return $array_get;
  }

  function ValidateResponse(){
    include current(App::path("Lib")).DS.'bncr'.DS.'vpos_plugin.php';
    $arrayIn = $_SESSION['VPOSResponse'];
    $arrayOut = array();
//Vector de inicialización
    $VI = $_SESSION['Company']['HexNumber'];
//Ejemplo de una llave leida de un archivo de texto plano
    if(strrchr($_SESSION['Company']['KeyName'], '.') == '.TESTING'){
      $AlignetKeyName = "ALIGNET.TESTING.PHP.SIGNATURE.PUBLIC.txt";
    }else{
      $AlignetKeyName = "ALIGNET.PRODUCTION.PHP.SIGNATURE.PUBLIC.txt";
    }
    $llaveVPOSFirmaPub = file_get_contents(CONFIGS.'keys'.DS.$AlignetKeyName);
    $llaveComercioCryptoPriv =
file_get_contents(current(App::path("Lib")).'/keys'.DS.$_SESSION['Company']['CurrentCompanyID'].DS.strtoupper($_SESSION['Company']['KeyName']).'.CRYPTO.PRIVATE.pem');
    if(VPOSResponse($arrayIn,$arrayOut,$llaveVPOSFirmaPub,$llaveComercioCryptoPriv,$VI)){
//La salida esta en $arrayOut con todos los parámetros decifrados devueltos por  el VPOS
      if(count($arrayOut) > 0){
        return $arrayOut;
      }else{
        unset($_SESSION['VPOSResponse']);
        return false;
      }
     }
  }*/
}
