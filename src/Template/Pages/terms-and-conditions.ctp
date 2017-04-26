<?php
use Cake\Core\App;
?>
<div class="contenttxt">
<?php
$session = $this->request->session();
	$this->pageTitle='Terms and Conditions';
	//$html->meta('keywords', '', array(), false);
	//$html->meta('description', '', array(), false);
	if($session->check('Company.CurrentCompanyID')){
		Configure::write('debug', 0);
		$this->layout = "terms";
		require current(App::path("Template")).'/Terms'.DS.$session->read('Company.CurrentCompanyID').'_eng_us.ctp';
	}else{
		require current(App::path("Template")).'/Terms'.DS.'default_eng_us.ctp';
	}
	?>
</div>
