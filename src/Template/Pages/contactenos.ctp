<?php
$session = $this->request->session();
	$this->pageTitle='Cont&aacute;ctenos';
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
Para contactarnos, por favor use el siguiente formulario:
<form method="post" action="/contactenos/" align="right" name="TheForm" id="TheForm">
	<input name="FormType" type="hidden" id="FormType" value="3">
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
        <td><label for="Tel1">Tel&eacute;fono*</label></td>
        <td><input name="Tel1" type="text" id="Tel1" size="40" maxlength="20" /></td>
      </tr>
      <tr>
        <td><label for="Email">Correo Electr&oacute;nico*</label></td>
        <td><input name="Email" type="text" id="Email" size="40" maxlength="200" /></td>
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
<blockquote>
	Tel&eacute;fono: +(506) 2262-0766<br>
	Fax: +(506)  2560-1696<br>
	E-mail: <a href="mailto:info@crpagos.com">info@crpagos.com</a><br>
	Apartado Postal: 515-1007 San Jos&eacute;
</blockquote>
</div>
