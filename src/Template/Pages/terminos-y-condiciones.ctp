<div class="contenttxt">
<?php
$session = $this->request->session();
	$this->pageTitle= __('Terms', true);
	//$html->meta('keywords', '', array(), false);
	//$html->meta('description', '', array(), false);
	if($session->check('Company.CurrentCompanyID')){
		Configure::write('debug', 0);
		$this->layout = "terms";
		include VIEWS.'terms'.DS.$session->read('Company.CurrentCompanyID').'_spa_cr.ctp';
	}else{
		include VIEWS.'terms'.DS.'default_spa_cr.ctp';
	}?>
</div>
