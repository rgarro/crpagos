<div class="contenttxt">
<?php
	$this->pageTitle='Terms and Conditions';
	$html->meta('keywords', '', array(), false);
	$html->meta('description', '', array(), false);

	if(count($TermsQ) > 0){
		echo htmlspecialchars_decode($TermsQ[0]['Terms']['Content']);
	}
?>
</div>