<?php
$session = $this->request->session();
$TheClass="";
$UrlLocation = explode("/", $this->request->here());
	if(count($UrlLocation)< 4 || $UrlLocation[2] == 'search' || $UrlLocation[2] == 'terms') {
		//if($this->request->here()==$session->read('Company.CurrentURL')){$TheClass="sel";}else{$TheClass="";}
		echo '<li class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="',$session->read('Company.CurrentURL'),'">',__('Invoices'),'</a></li>';
		//if($this->request->here() == '/clients/'){$TheClass="sel";}else{$TheClass="";}
		echo '<li class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="/clients/">',__('Clients'),'</a></li>';
		if($session->read('User.AccessLevelID') <= 1){
			//if($this->request->here() == '/users/'){$TheClass="sel";}else{$TheClass="";}
				echo '<li class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="/users/">',__('Users'),'</a></li>';
				//if($this->request->here() == '/mycompany/'){$TheClass="sel";}else{$TheClass="";}
				echo '<li class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="/mycompany/">',__('MyCompany'),'</a></li>';
				//if($this->request->here() == '/mycompany/terms/'){$TheClass="sel";}else{$TheClass="";}
				echo '<li class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="/mycompany/terms/" style="font-size:0.8em">',__('Terms'),'</a></li>';

		}else{
				//if($this->request->here() == '/myaccount/'){$TheClass="sel";}else{$TheClass="";}
				echo '<li class="menuitem',$TheClass,'"><a class="menuitemlink',$TheClass,'" href="/myaccount/">',__('MyAccount'),'</a></li>';
			}
		echo '<li class="menuitem"><a class="menuitemlink" href="/?logout=yes" onclick="return confirm(\'',__('LogoutConfirm'),'\')">',__('Logout'),'</a></li>';
	}
?>
