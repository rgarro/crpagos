<?php 
	$this->pageTitle='Contact Us';
	$html->meta('keywords', '', array(), false);
	$html->meta('description', '', array(), false);
	$javascript->link("jquery/validate", false);	
	//localized validation code
	$TheJs = $session->read('LocaleCode').'/checkform';
	$javascript->link($TheJs, false);
?>
<div class="contenttxt">
To Contact Us, please fill out the following form:
<form method="post" action="/contactus/" align="right" name="TheForm" id="TheForm">
	<input name="FormType" type="hidden" id="FormType" value="3">
	<table border="0" width="500" align="center">
      <tr>
        <td><label for="Name">Name*</label></td>
        <td><input name="Name" type="text" id="Name" size="40" maxlength="200" /></td>
      </tr>
      <tr>
        <td><label for="LastName">Last Name*</label></td>
        <td><input name="LastName" type="text" id="LastName" size="40" maxlength="200" /></td>
      </tr>
      <tr>
        <td><label for="Tel1">Telephone*</label></td>
        <td><input name="Tel1" type="text" id="Tel1" size="40" maxlength="20" /></td>
      </tr>
      <tr>
        <td><label for="Email">E-mail*</label></td>
        <td><input name="Email" type="text" id="Email" size="40" maxlength="200" /></td>
      </tr>
      <tr>
        <td><label for="Comments">Comments</label></td>
        <td><textarea name="Comments" cols="30" rows="3" id="Comments"></textarea></td>
      </tr>
	  <tr>
	  	<th colspan="2" align="center"><input type="Submit" value="Send" id="Submit" name="Submit"></th>
	</tr>
    </table>
</form>
<blockquote>
	Telephone: +(506) 2262-0766<br>
	Fax: +(506) 2560-1696<br>
	E-mail: <a href="mailto:info@crpagos.com">info@crpagos.com</a><br>
	P.O. Box: 515-1007 San Jos&eacute;
</blockquote>
</div>