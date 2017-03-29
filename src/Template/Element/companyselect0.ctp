<?php
	if(count($session->read('Companies')) > 1){
		echo '<small>',__('MultiCompanyUser'),'</small><br><select style="font-size:10px;;width:165px" name="Avail" OnChange="if(this.options[this.selectedIndex].value!=\'\'){window.location.href=this.options[this.selectedIndex].value}">',"\n";
		echo '<option style="font-size:10px;"  value="">',__('PleaseSelectCompany'),'</option>',"\n";
		foreach($session->read('Companies') as $AvailCompanies){
			if($session->read('Company.CurrentURL') != $AvailCompanies['Companies']['CompanyUrl']){
				echo '<option style="font-size:10px;" value="',$AvailCompanies['Companies']['CompanyUrl'],'">',$AvailCompanies['Companies']['CompanyName'],'</option>',"\n";
			}
		}
		echo '</select>',"\n";
		echo '</form>',"\n";
	}
?>