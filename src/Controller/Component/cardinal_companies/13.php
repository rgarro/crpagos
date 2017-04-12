<?php
//Grayline/*Integracion de Gray Line en CRPagos.comDiciembre 201370656000 - graylinevm   - Visa y Master Card70656019 - graylineamex -  American ExpressEstos nombres se llaman procesadores, creo que aparecen como Processor IDgraylinevmgraylineamex Key ID4075264KeyRpuNwU3PTJGuTNX4gHs9RSMD94V5JSe4https://credomatic.compassmerchantsolutions.com/merchants/login.phpGraylineadmin12gralin987*/

//Test Keys
	$this -> Key_ID = "4075264";
	$this -> Key = "RpuNwU3PTJGuTNX4gHs9RSMD94V5JSe4";

//Client's Keys
//	$this -> Key_ID = "";
//	$this -> Key = "";

//Procesors Grayline  not needed
	$this -> AmexCols = null;
	$this -> AmexDols = "graylineamex";

	$this -> OthersCols = null;
	$this -> OthersDols = "graylinevm";
?>