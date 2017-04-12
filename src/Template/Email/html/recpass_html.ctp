<?php 
	$greet = "Good";
	$today = getdate();
	$now = floatval($today['hours']);
	switch ($now){
		case 1:
		case 2:
		case 3:
		case 4:
		case 5:
		case 6:
		case 7:
		case 8:
		case 9:
		case 10:
		case 11:
			$greet = "Buenos D&iacute;s";
			break;
		case 12:
		case 13:
		case 14:
		case 15:
		case 16:
		case 17:
			$greet = "Buenas Tardes";
			break;
		default:
		$greet = "Buenas Noches";
		break;
	}
?>
<font face="Arial" size="2">
<?php echo $greet,' ',$UserQ['Users']['FirstName']?>;
<p>
Esta es la informaci&oacute;n solicitada en <?php echo $_SERVER['SERVER_NAME']?>.
<ul>	
	<li>Email: "<?php echo $UserQ['Users']['Email']?>"</li>
	<li>Clave: "<?php echo $UserQ['Users']['Password']?>"</li>
</ul>
Ud Puede ingresar en <a href="http://<?php echo $_SERVER['SERVER_NAME']?>/?logout=yes">https://<?php echo $_SERVER['SERVER_NAME']?>/login/</a>
<br>
Muchas gracias
</p>
</font>