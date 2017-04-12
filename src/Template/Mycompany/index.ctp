<?php
use Cake\Core\Configure;
$session = $this->request->session();
	$CurrentCompany = current($GetMyCompanyQ);
	if($session->read('LocaleCode') == 'spa_cr'){
		$this->pageTitle= 'Cuenta de  '.$CurrentCompany['Companies']['CompanyName'];
	}else{
		$this->pageTitle= $CurrentCompany['Companies']['CompanyName'].'&rsquo;s Account';
	}
	echo $this->Html->css("zebra");
	echo $this->Html->script("zebra/zebra");
	echo $this->Html->script("jquery/validate");
//localized validation code
	$TheJs = $session->read('LocaleCode').'/checkmycompany';
	echo $this->Html->script($TheJs);
?>
<h1><?php echo $this->pageTitle ?></h1>
	<form method="post" action="/mycompany/saveme/" id="TheForm" name="TheForm" enctype="multipart/form-data">
	<table border="0" class="zebra" align="center" width="600">
		<tr><th colspan="2">&nbsp;</th></tr>
		<tr>
			<td><label for="LocaleCode">*<?php echo __('DefaultLanguage') ?>:</label></td>
			<td><select name="LocaleCode" id="LocaleCode" tabindex="2">
						<?php foreach($LocalesQ as $ThisLocale){
							if($ThisLocale['Locales']['LocaleCode'] == Configure::read('Config.language')){$Sel = " Selected ";}else{$Sel = "";}
							echo  '<option value="',$ThisLocale['Locales']['LocaleCode'],'"',$Sel,'>',$ThisLocale['Locales']['Locale'],'</option>',"\n";
							}?>
					</select>
				</td>
		</tr>
		<tr>
			<td><label for="CompanyName">*<?php echo __('CompanyName') ?>:</label></td>
			<td><input type="text" name="CompanyName" id="CompanyName"  tabindex="5" size="40" maxlength="150" value="<?php echo $CurrentCompany['Companies']['CompanyName'] ?>"></td>
		</tr>
		<tr>
			<td><label for="Email">*<?php echo __('Email') ?>:</label></td>
			<td><input type="text" name="Email" id="Email"  tabindex="6" size="40" maxlength="100" value="<?php echo $CurrentCompany['Companies']['Email'] ?>"></td>
		</tr>
		<tr>
			<td><label for="Logo"><?php echo __('Logo') ?>:</label></td>
			<td>
				<?php if(trim($CurrentCompany['Companies']['Logo']) != ''){
					echo '<img src="/img',$session->read('Company.CurrentURL'),$CurrentCompany['Companies']['Logo'],'"><br>';
				} ?>
				<input type="File" name="Logo" id="Logo"  tabindex="7" size="40" value="<?php echo $CurrentCompany['Companies']['Logo'] ?>">
			</td>
		</tr>
	<tr>
			<td><label for="TaxID"><?php echo __('CedulaJuridica') ?>:</label></td>
			<td><input type="text" name="TaxID" id="TaxID"  tabindex="7" size="40" maxlength="20" value="<?php echo $CurrentCompany['Companies']['TaxID'] ?>"></td>
		</tr>
	<tr>
			<td><label for="CompanyInfo"><?php echo __('CompanyInfo') ?>:</label></td>
			<td><textarea tabindex="8" wrap="soft" cols="40" rows="3" id="CompanyInfo" name="CompanyInfo"><?php echo $CurrentCompany['Companies']['CompanyInfo'] ?></textarea></td>
		</tr>
		<tr>
			<td><label for="DefaultNote"><?php echo __('DefaultNote') ?>:</label></td>
			<td><textarea tabindex="8" wrap="soft" cols="40" rows="3" id="DefaultNote" name="DefaultNote"><?php echo $CurrentCompany['Companies']['DefaultNote'] ?></textarea></td>
		</tr>
		<tr>
			<th colspan="2" align="center">
				<input type="submit" value="<?php echo __('Save') ?>" id="Sumbmit" name="Submit" tabindex="9">
			</th>
		</tr>
	</table>
</form>
