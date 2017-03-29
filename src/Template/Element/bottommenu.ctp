<?php
	$i = 0;
	$MenuItems = array("AboutUs", "Personal", "Bussiness", "ContactUs");
	$TotItems = count($MenuItems);
	foreach($MenuItems as $ThisMenu){
		$LinkMenu = 'MenuLinks_'.$session->read('LocaleCode');
		$ThisLink = "/".$_SESSION[$LinkMenu][$i].".htm";
		echo '<a class="bottommenu" href="',$ThisLink,'">',__($ThisMenu),'</a>';
	$i++;
		if($i!= $TotItems){
			echo '&nbsp;|&nbsp;';
		}
	}
?>