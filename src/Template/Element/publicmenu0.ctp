<?php
$session = $this->request->session();
	$i = 0;
	$MenuItems = array("AboutUs", "Personal", "Bussiness", "ContactUs");
	foreach($MenuItems as $ThisMenu){
		$LinkMenu = 'MenuLinks_'.$session->read('LocaleCode');
		$ThisLink = "/".$_SESSION[$LinkMenu][$i].".htm";
		if($this->request->here() == $ThisLink){
			$TheClass="sel";
		}else{
			$TheClass="";
		}
		echo '<li class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="',$ThisLink,'">',__($ThisMenu),'</a></li>';
	$i++;
	}
?>
