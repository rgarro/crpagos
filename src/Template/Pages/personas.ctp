<?php
$session = $this->request->session();
	$this->pageTitle='Afiliaci&oacute;n de Personas';
	//$html->meta('keywords', '', array(), false);
	//$html->meta('description', '', array(), false);
	//$javascript->link("jquery/validate", false);
	//echo $this->Html->script('jquery/validate');
	//localized validation code
	$TheJs = "/js/".$session->read('LocaleCode').'/checkform.js';
	//$javascript->link($TheJs, false);
	//echo $this->Html->script($TheJs);
?>
<script src="/js/jquery/validate.js"></script>
<script src="<?php echo $TheJs; ?>"></script>
<div class="contenttxt">
<h3>Personas</h3>
Cualquier persona que requiera hacer su gesti&oacute;n de cobro por medio de Tarjeta de Cr&eacute;dito, se puede ver beneficiado al hacer uso de <b>CR Pagos</b>.
<p><b>CR Pagos</b> le facilita el cobro de sus servicios, ya sea a nivel nacional o internacional.</p>
<p>Adicionalmente mejora su Servicio al Cliente, al facilitar el pago por sus 	servicios, utilizando una herramienta de &uacute;ltima tecnolog&iacute;a.</p>
<p>Nuestro servicio se ofrece &uacute;nicamente a personas radicadas en Costa Rica.</p>
<p>
Para solicitar informaci&oacute;n, por favor complete el siguiente formulario:

<form method="post" action="/contactenos/" align="right" name="TheForm" id="TheForm">
	<input name="FormType" type="hidden" id="FormType" value="2">
	<table border="0" width="500" align="center">
      <tr>
        <td><label for="Name">Nombre*</label></td>
        <td><input name="Name" type="text" id="Name" size="40" maxlength="200" /></td>
      </tr>
      <tr>
        <td><label for="LastName">Apellido*</label></td>
        <td><input name="LastName" type="text" id="LastName" size="40" maxlength="200" /></td>
      </tr>
      <tr>
        <td><label for="IdNumber">N&uacute;mero de c&eacute;dula</label></td>
        <td><input name="IdNumber" type="text" id="IdNumber" size="40" maxlength="200" /></td>
      </tr>
      <tr>
        <td><label for="Tel1">Tel&eacute;fono 1*</label></td>
        <td><input name="Tel1" type="text" id="Tel1" size="40" maxlength="20" /></td>
      </tr>
      <tr>
        <td><label for="Tel1">Tel&eacute;fono 2</label></td>
        <td><input name="Tel2" type="text" id="Tel2" size="40" maxlength="20" /></td>
      </tr>
      <tr>
        <td><label for="Email">Correo Electr&oacute;nico*</label></td>
        <td><input name="Email" type="text" id="Email" size="40" maxlength="200" /></td>
      </tr>
      <tr>
        <td><label for="Address">Direcci&oacute;n F&iacute;sica</label></td>
        <td><textarea name="Address" cols="30" rows="3" id="Address"></textarea></td>
      </tr>
      <tr>
        <td><label for="Comments">Comentarios</label></td>
        <td><textarea name="Comments" cols="30" rows="3" id="Comments"></textarea></td>
      </tr>
	  <tr>
	  	<th colspan="2" align="center"><input type="Submit" value="Enviar" id="Submit" name="Submit"></th>
	</tr>
    </table>
</form>
</p>
</div>
