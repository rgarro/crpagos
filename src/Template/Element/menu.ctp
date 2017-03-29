<?php
$UrlLocation = explode("/", $this->here);
	if(count($UrlLocation)< 4 || $UrlLocation[2] == 'search' || $UrlLocation[2] == 'terms') {
		if($this->here==$session->read('Company.CurrentURL')){$TheClass="sel";}else{$TheClass="";}
		echo '<div class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="',$session->read('Company.CurrentURL'),'">',__('Invoices'),'</a></div>';
		if($this->here == '/clients/'){$TheClass="sel";}else{$TheClass="";}
		echo '<div class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="/clients/">',__('Clients'),'</a></div>';
		if($session->read('User.AccessLevelID') <= 1){
			if($this->here == '/users/'){$TheClass="sel";}else{$TheClass="";}
				echo '<div class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="/users/">',__('Users'),'</a></div>';
				if($this->here == '/mycompany/'){$TheClass="sel";}else{$TheClass="";}
				echo '<div class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="/mycompany/">',__('MyCompany'),'</a></div>';
				if($this->here == '/mycompany/terms/'){$TheClass="sel";}else{$TheClass="";}
				echo '<div class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="/mycompany/terms/" style="font-size:0.8em">',__('Terms'),'</a></div>';

		}else{
				if($this->here == '/myaccount/'){$TheClass="sel";}else{$TheClass="";}
				echo '<div class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="/myaccount/">',__('MyAccount'),'</a></div>';
			}
		echo '<div class="menuitem"><a class="menuitemlink" href="/?logout=yes" onclick="return confirm(\'',__('LogoutConfirm'),'\')">',__('Logout'),'</a></div>';
	}
?>