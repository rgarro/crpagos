<?php 
	$CurrentUser = current($GetUserQ);
	if($session->read('LocaleCode') == 'spa_cr'){
		$this->pageTitle= 'Cuenta de  '.$CurrentUser['Users']['FirstName'];	
	}else{
		$this->pageTitle= $CurrentUser['Users']['FirstName'].'&rsquo;s Account';	
	}
	$html->css("zebra","stylesheet", array(), false);
	$javascript->link("zebra/zebra", false);
	$javascript->link("jquery/validate", false);	
//localized validation code
	$TheJs = $session->read('LocaleCode').'/checkmyaccount';
	$javascript->link($TheJs, false);
?>
<h1><?php echo $this->pageTitle ?></h1>
	<form method="post" action="/myaccount/saveme/" id="TheForm" name="TheForm">
	<input type="hidden" name="UserID" Id="UserID" value="<?php echo base64_encode($CurrentUser['Users']['UserID']) ?>">
	<table border="0" class="zebra" align="center" width="600">
		<tr><th colspan="2">&nbsp;</th></tr>
		<tr>
			<td><label for="FirstName">*<?php  __('FirstName') ?></label></td>
			<td><input type="text" name="FirstName" id="FirstName" tabindex="4" size="30" maxlength="50" value="<?php echo $CurrentUser['Users']['FirstName'] ?>"></td>
		</tr>
		<tr>
			<td><label for="LastName">*<?php  __('LastName') ?></label></td>
			<td><input type="text" name="LastName" id="LastName"  tabindex="5" size="30" maxlength="50" value="<?php echo $CurrentUser['Users']['LastName'] ?>"></td>
		</tr>
		<tr>
			<td><label for="Email">*<?php  __('Email') ?></label></td>
			<td><input type="text" name="Email" id="Email"  tabindex="6" size="30" maxlength="100" value="<?php echo $CurrentUser['Users']['Email'] ?>"></td>
		</tr>
		<tr><th colspan="2"><?php echo __('PasswordChange'),'<br><small>',__('ToKeepCurrent'),'</small>' ?></th></tr>
		<tr>
			<td><label for="Password"><?php  __('NewPassword') ?></label></td>
			<td><input type="Password" name="Password" id="Password"  tabindex="7" size="30" maxlength="20" value=""></td>
		</tr>
	<tr>
			<td><label for="Password"><?php  __('ReTypePassword') ?></label></td>
			<td><input type="Password" name="Password2" id="Password2"  tabindex="7" size="30" maxlength="20" value=""></td>
		</tr>

		<tr>
			<th colspan="2" align="center">
				<input type="submit" value="<?php echo __('Save') ?>" id="QuickSubmit" tabindex="8">
			</th>
		</tr>
	</table>
</form>