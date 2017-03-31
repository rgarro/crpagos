<?php 
	$this->pageTitle='About CRPagos';
	$html->meta('keywords', '', array(), false);
	$html->meta('description', '', array(), false); 
//localized validation code
	$TheJs = $session->read('LocaleCode').'/checkform';
	$javascript->link($TheJs, false);
?>
<div class="contenttxt">
	<h1>About Us</h1>
	<b>CR Pagos</b> is a division of Pragm&aacute;tico Consultores, S.A., a company with more than 10 years providing consultancy in the area of Internet.
	<p><b>CR Pagos</b> was developed with the idea of allowing any Business or Person established in Costa Rica, to easily and safely collect online payments via Credit Cards.</p>
	<p>To use our service an E-Commerce web site is not needed.</p>
	<p>If you don't have your own website, we will assist you in the development of your presence in Internet.</p>
	<p><a href="contact-us.htm">Request Information Today !</a>
</div>