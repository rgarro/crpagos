<div class="contenttxt">
<p>&nbsp;</p>
<?php 
	$this->pageTitle = __('ThankYou', true);
	if($session->read('LocaleCode') == "spa_cr"){
?>
	<h1>Gracias por su mensaje.</h1>
	<h2>Uno de nuestros representantes le estar&aacute; contactando dentro de las pr&oacute;ximas 24 horas.</h2>
	<h2>Saludos</h2>
	<h2>CR Pagos</h2>

<?php }else{ ?>

	<h1>Thanks for your message</h1>
	<h2>One of our Representatives will contact you within the next 24 hours.</h2>
	<h2>Regards</h2>
	<h2>CR Pagos</h2>

<?php }?>
<p>&nbsp;</p>
</div>