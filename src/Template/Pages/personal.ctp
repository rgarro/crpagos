<?php
$session = $this->request->session();
	$this->pageTitle='Personal Affiliation';
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
<h3>Personal</h3>
Any person who requires to collect payments via Credit Card can benefit 	from the use of <b>CR Pagos</b>.
<p><b>CR Pagos</b> will facilitate the collection of the payments for your services, either in Costa Rica or internationally.</p>
<p>In addition, you will benefit your Customer Service experience, from facilitating the payment to your clients using a high end technology.</p>
<p>Our service will only be provided to persons resident in Costa Rica.</p>
<p>
To request information please complete the following form:
<form method="post" action="/contactus/" align="right" name="TheForm" id="TheForm">
	<input name="FormType" type="hidden" id="FormType" value="2">
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
        <td><label for="IdNumber">ID Number</label></td>
        <td><input name="IdNumber" type="text" id="IdNumber" size="40" maxlength="200" /></td>
      </tr>
      <tr>
        <td><label for="Tel1">Telephone 1*</label></td>
        <td><input name="Tel1" type="text" id="Tel1" size="40" maxlength="20" /></td>
      </tr>
      <tr>
        <td><label for="Tel1">Telephone 2</label></td>
        <td><input name="Tel2" type="text" id="Tel2" size="40" maxlength="20" /></td>
      </tr>
      <tr>
        <td><label for="Email">E-mail*</label></td>
        <td><input name="Email" type="text" id="Email" size="40" maxlength="200" /></td>
      </tr>
      <tr>
        <td><label for="Address">Address</label></td>
        <td><textarea name="Address" cols="30" rows="3" id="Address"></textarea></td>
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
</p>
</div>
