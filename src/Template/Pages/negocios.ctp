<?php
$session = $this->request->session();
	$this->pageTitle='Afiliaci&oacute;n de Compañías';
	//$html->meta('keywords', '', array(), false);
	//$html->meta('description', '', array(), false);
	//$javascript->link("jquery/validate", false);
	//localized validation code
	$TheJs = "/js/".$session->read('LocaleCode').'/checkform.js';
	//$javascript->link($TheJs, false);
?>
<script src="/js/jquery/validate.js"></script>
<script src="<?php echo $TheJs; ?>"></script>
<div class="contenttxt">
<h3>Compañías</h3>
Si requiere recibir pagos, como reservaciones, servicios a clientes internacionales, o venta de productos sin necesidad de contar con 	todo un sitio de comercio electr&oacute;nico, <b>CR Pagos</b> le ofrece la soluci&oacute;n que espera.
<p>Con el fin de que su Empresa obtenga el mayor beneficio de <b>CR Pagos</b>, ofrecemos el servicio de desarrollo de funcionalidades, hechas a la medida de sus necesidades.</p>
<p>Nuestro servicio se ofrece &uacute;nicamente a empresas radicadas en Costa Rica.</p>
<p>
Para solicitar informaci&oacute;n, por favor complete el siguiente formulario:

<form method="post" action="/contactenos/" align="right" name="TheForm" id="TheForm">
	<input name="FormType" type="hidden" id="FormType" value="1">
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
        <td><label for="Position">Puesto</label></td>
        <td><input name="JobPosition" type="text" id="JobPosition" size="40" maxlength="200" /></td>
      </tr>
      <tr>
        <td><label for="CompanyName">Nombre de la Empresa</label></td>
        <td><input name="CompanyName" type="text" id="CompanyName" size="40" maxlength="200" /></td>
      </tr>
      <tr>
        <td><label for="RazonSocial">&ldquo;Raz&oacute;n Social&rdquo;</label></td>
        <td><input name="RazonSocial" type="text" id="RazonSocial" size="40" maxlength="200" /></td>
      </tr>
      <tr>
        <td><label for="CedJur">&ldquo;C&eacute;dula Jur&iacute;dica&rdquo; number</label></td>
        <td><input name="CedJur" type="text" id="CedJur" size="40" maxlength="50" /></td>
      </tr>
      <tr>
        <td><label for="BusArea">&Aacute;rea Compañía</label></td>
        <td><input name="BusArea" type="text" id="BusArea" size="40" maxlength="200" /></td>
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
