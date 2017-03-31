<?php
$session = $this->request->session();
?>
<?php
	$i = 0;
	$MenuItems = array("AboutUs", "Personal", "Bussiness", "ContactUs");
	foreach($MenuItems as $ThisMenu){
		$LinkMenu = 'MenuLinks_'.$session->read('LocaleCode');
		$ThisLink = "/".$_SESSION[$LinkMenu][$i].".htm";
		//$ThisLink = "/".$ThisMenu.".htm";
		if($this->here == $ThisLink){
			$TheClass="sel";
		}else{
			$TheClass="";
		}
		echo '<div class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="',$ThisLink,'">',__($ThisMenu),'</a></div>';
	$i++;
	}
?>
