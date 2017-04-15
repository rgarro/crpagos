<?php
$session = $this->request->session();
	$CurrentClient = current($GetClientQ);
	if($CurrentClient['ClientID'] != ''){
		$this->pageTitle= __('Editing', true).' '.$CurrentClient['ClientName'];
	}else{
		$this->pageTitle = __('AddingNewClient', true).' '.$session->read('Company.CurrentName');
	}
	echo $this->Html->css("zebra");
	echo $this->Html->css("ui");
	echo $this->Html->script("zebra/zebra");
	echo $this->Html->script("jquery/jquery.ui");
	echo $this->Html->script("jquery/jquery.cookie");
	echo $this->Html->script("jquery/validate");
  //localized validation code
	$TheJs = $session->read('LocaleCode').'/checkclient';
	echo $this->Html->script($TheJs);
//	echo '<p align="center"><a href="/',$this->viewPath,'/" onclick="return confirm(\'', __('BackConfirm'),'\');">', __('BackToClientList'),'</a></p>';
?>
<h3><?php echo $this->pageTitle ?></h3>
<div id="ClientEditForm">
	<ul>
		<li><a href="#Bus">Negocios</a></li>
		<li><a href="#Per">Personas</a></li>
	</ul>
	<div id="Bus">
		<form method="post" action="/<?php echo $this->viewPath ?>/saveclient/" id="TheBusForm" name="TheBusForm">
			<?php if($CurrentClient['ClientID'] != ''){?>
			<input type="hidden" name="ClientID" value="<?php echo base64_encode($CurrentClient['ClientID']) ?>">
			<?php } ?>
			<table border="0" class="zebra" align="center" width="600">
				<tr><th colspan="2">&nbsp;</th></tr>
			<?php if($CurrentClient['ClientID'] != '' && $session->read('User.AccessLevelID') < 2 ){?>
				<tr>
					<td><label for="DeleteCompany">*<?php echo __('DeleteCompany') ?></label></td>
					<td><input type="checkbox" name="DeleteCompany" id="DeleteCompany" tabindex="7"></td>

				</tr>
			<?php } ?>
				<tr>
					<td><label for="ClientName">*<?php echo __('CompanyName') ?></label></td>
					<td><input type="text" name="ClientName" tabindex="8" size="30" maxlength="30" value="<?php echo $CurrentClient['ClientName'] ?>"></td>
				</tr>

				<tr>
					<td><label for="Email">*<?php echo __('Email') ?></label></td>
					<td><input type="text" name="Email"  tabindex="9" size="30" maxlength="100" value="<?php echo $CurrentClient['Email'] ?>"></td>
				</tr>
				<tr>
					<td><label for="CedulaJuridica"><?php echo __('CedulaJuridica') ?></label></td>
					<td><input type="text" name="CedulaJuridica"  tabindex="10" size="30" maxlength="50" value="<?php echo $CurrentClient['CedulaJuridica'] ?>"></td>
				</tr>
					</tr>
				<tr>
					<td><label for="RazonSocial"><?php echo __('RazonSocial') ?></label></td>
					<td><input type="text" name="RazonSocial"  tabindex="11" size="30" maxlength="200" value="<?php echo $CurrentClient['RazonSocial'] ?>"></td>
				</tr>
				<tr>
					<td><label for="Phone"><?php echo __('Phone') ?></label></td>
					<td><input type="text" name="Phone" tabindex="12" size="30" maxlength="20" value="<?php echo $CurrentClient['Phone'] ?>"></td>
				</tr>
				<tr>
					<th colspan="2" align="center">
						<input type="submit" value="<?php echo __('SaveCompany') ?>" name="QuickSubmitB" id="QuickSubmitB" tabindex="13">
					</th>
				</tr>
			</table>
		</form>
	</div>
	<div id="Per">
			<form method="post" action="/<?php echo $this->viewPath ?>/saveclient/" id="TheClientForm" name="TheClientForm">
			<?php if($CurrentClient['ClientID'] != ''){?>
			<input type="hidden" name="ClientID" value="<?php echo base64_encode($CurrentClient['ClientID']) ?>">
			<?php } ?>
			<table border="0" class="zebra" align="center" width="600">
				<tr><th colspan="2">&nbsp;</th></tr>
			<?php if($CurrentClient['ClientID'] != ''){?>
				<tr>
					<td><label for="DeleteClient">*<?php echo __('DeleteClient') ?></label></td>
					<td><input type="checkbox" name="DeleteClient" id="DeleteClient" tabindex="7"></td>

				</tr>
			<?php } ?>
				<tr>
					<td><label for="ClientName">*<?php echo __('ClientName') ?></label></td>
					<td><input type="text" name="ClientName" tabindex="8" size="30" maxlength="200" value="<?php echo $CurrentClient['ClientName'] ?>"></td>
				</tr>
							<tr>
					<td><label for="ClientName">*<?php echo __('ClientLastName') ?></lablientel></td>
					<td><input type="text" name="ClientLastName" tabindex="8" size="30" maxlength="50" value="<?php echo $CurrentClient['ClientLastName'] ?>"></td>
				</tr>
				<tr>
					<td><label for="Email">*<?php echo __('Email') ?></label></td>
					<td><input type="text" name="Email"  tabindex="9" size="30" maxlength="100" value="<?php echo $CurrentClient['Email'] ?>"></td>
				</tr>
				<tr>
					<td><label for="CedulaJuridica"><?php echo __('Cedula') ?></label></td>
					<td><input type="text" name="CedulaJuridica"  tabindex="10" size="30" maxlength="50" value="<?php echo $CurrentClient['CedulaJuridica'] ?>"></td>
				</tr>
					</tr>
				<tr>
					<td><label for="Phone"><?php echo __('Phone') ?></label></td>
					<td><input type="text" name="Phone" tabindex="12" size="30" maxlength="20" value="<?php echo $CurrentClient['Phone'] ?>"></td>
				</tr>
				<tr>
					<th colspan="2" align="center">
						<input type="submit" value="<?php echo __('SaveClient') ?>"  name="QuickSubmitB" id="QuickSubmitP" tabindex="13">
					</th>
				</tr>
			</table>
		</form>



	</div>
</div>
<?php
	echo '<p align="center"><a href="/',$this->viewPath,'/" onclick="return confirm(\'', __('BackClientsConfirm'),'\')">', __('BackToClientList'),'</a></p>';
?>
