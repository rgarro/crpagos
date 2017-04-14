<?php
$session = $this->request->session();
	$CurrentUser = current($GetUserQ);
	$this->pageTitle= __('Editing', true).' '.$CurrentUser['FirstName'].' '.$CurrentUser['LastName'];
	echo $this->Html->css("zebra");
	echo $this->Html->script("zebra/zebra");
	echo $this->Html->script("jquery/validate");
//localized validation code
	$TheJs = $session->read('LocaleCode').'/checkuser';
	echo $this->Html->script($TheJs);
	//echo '<p align="center"><a href="/',$this->viewPath,'/" onclick="return confirm(\'', __('BackConfirm'),'\');">', __('BackToUserList'),'</a></p>';
?>
	<h1><?php echo $this->pageTitle ?></h1>
	<form method="post" action="/<?php echo $this->viewPath ?>/saveuser/" id="TheForm" name="TheForm">
	<?php if($CurrentUser['UserID'] != ''){?>
	<input type="hidden" name="UserID" Id="UserID" value="<?php echo base64_encode($CurrentUser['UserID']) ?>">
	<?php } ?>
	<table border="0" class="zebra" align="center" width="600">
		<tr><th colspan="2">&nbsp;</th></tr>
		<tr>
			<td><label for="UserStatus">*<?php echo __('Status') ?></label></td>
			<td>
				<input type="Radio" value="1" name="UserStatus" id="UserStatus" tabindex="1" <?php if($CurrentUser['UserStatus'] == 1){echo 'checked="checked"';}?> ><?php echo __('Active')?>
				<input type="Radio" value="0"  name="UserStatus" id="UserStatus" tabindex="2" <?php if($CurrentUser['UserStatus'] == 0){echo 'checked="checked"';}?> ><?php echo __('InActive')?>
			</td>
		</tr>
		<tr>
			<td><label for="AccessLevelID">*<?php echo __('AccessLevel') ?>:</label></td>
				<td nowrap="nowrap">
					<select name="AccessLevelID" id="AccessLevelID" tabindex="3">
					<option value=""><?php echo __('PleaseSelect') ?></option>
			    	<?php foreach($GetLevelsQ as $ThisLevel){
			   			if($ThisLevel['AccessLevelID'] == $CurrentUser['AccessLevelID']){$Sel = " Selected ";}else{$Sel = "";}
						echo  '<option value="',$ThisLevel['AccessLevelID'] ,'"',$Sel,'>',__($ThisLevel['AccessLevel']),'</option>',"\n";
						}
					?>
   	 				</select>
				</td>
		</tr>
		<tr>
			<td><label for="FirstName">*<?php echo __('FirstName') ?></label></td>
			<td><input type="text" name="FirstName" id="FirstName" tabindex="4" size="30" maxlength="50" value="<?php echo $CurrentUser['FirstName'] ?>"></td>
		</tr>
		<tr>
			<td><label for="LastName">*<?php echo __('LastName') ?></label></td>
			<td><input type="text" name="LastName" id="LastName"  tabindex="5" size="30" maxlength="50" value="<?php echo $CurrentUser['LastName'] ?>"></td>
		</tr>
		<tr>
			<td><label for="Email">*<?php echo __('Email') ?></label></td>
			<td><input type="text" name="Email" id="Email"  tabindex="6" size="30" maxlength="100" value="<?php echo $CurrentUser['Email'] ?>"></td>
		</tr>
		<tr>
			<td><label for="Password">*<?php echo __('Password') ?></label></td>
			<td><input type="password" " name="Password" id="Password"  tabindex="7" size="30" maxlength="20" value="<?php echo $CurrentUser['Password'] ?>"></td>
		</tr>


		<tr>
			<th colspan="2" align="center">
				<input type="submit" value="<?php echo __('Save') ?>" id="QuickSubmit" tabindex="8">
			</th>
		</tr>
	</table>
</form>
<?php
	echo '<p align="center"><a href="/',$this->viewPath,'/" onclick="return confirm(\'', __('BackConfirm'),'\');">', __('BackToUserList'),'</a></p>';
?>
