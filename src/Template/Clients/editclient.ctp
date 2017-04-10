<?php
	$CurrentClient = current($GetClientQ);
	if($CurrentClient['Clients']['ClientID'] != ''){
		$this->pageTitle= __('Editing', true).' '.$CurrentClient['Clients']['ClientName'];
	}else{
		$this->pageTitle = __('AddingNewClient', true).' '.$session->read('Company.CurrentName');
	}
	$html->css("zebra","stylesheet", array(), false);
	$html->css("ui","stylesheet", array(), false);
	$javascript->link("zebra/zebra", false);
	$javascript->link("jquery/jquery.ui", false);
	$javascript->link("jquery/jquery.cookie", false);
	$javascript->link("jquery/validate", false);
//localized validation code
	$TheJs = $session->read('LocaleCode').'/checkclient';
	$javascript->link($TheJs, false);
//	echo '<p align="center"><a href="/',$this->viewPath,'/" onclick="return confirm(\'', __('BackConfirm'),'\');">', __('BackToClientList'),'</a></p>';
?>
<h1><?php echo $this->pageTitle ?></h1>
<div id="ClientEditForm">
	<ul>
		<li><a href="#Bus">Negocios</a></li>
		<li><a href="#Per">Personas</a></li>
	</ul>
	<div id="Bus">
		<form method="post" action="/<?php echo $this->viewPath ?>/saveclient/" id="TheBusForm" name="TheBusForm">
			<?php if($CurrentClient['Clients']['ClientID'] != ''){?>
			<input type="hidden" name="ClientID" value="<?php echo base64_encode($CurrentClient['Clients']['ClientID']) ?>">
			<?php } ?>
			<table border="0" class="zebra" align="center" width="600">
				<tr><th colspan="2">&nbsp;</th></tr>
			<?php if($CurrentClient['Clients']['ClientID'] != '' && $session->read('User.AccessLevelID') < 2 ){?>
				<tr>
					<td><label for="DeleteCompany">*<?php  __('DeleteCompany') ?></label></td>
					<td><input type="checkbox" name="DeleteCompany" id="DeleteCompany" tabindex="7"></td>

				</tr>
			<?php } ?>
				<tr>
					<td><label for="ClientName">*<?php __('CompanyName') ?></label></td>
					<td><input type="text" name="ClientName" tabindex="8" size="30" maxlength="30" value="<?php echo $CurrentClient['Clients']['ClientName'] ?>"></td>
				</tr>

				<tr>
					<td><label for="Email">*<?php  __('Email') ?></label></td>
					<td><input type="text" name="Email"  tabindex="9" size="30" maxlength="100" value="<?php echo $CurrentClient['Clients']['Email'] ?>"></td>
				</tr>
				<tr>
					<td><label for="CedulaJuridica"><?php __('CedulaJuridica') ?></label></td>
					<td><input type="text" name="CedulaJuridica"  tabindex="10" size="30" maxlength="50" value="<?php echo $CurrentClient['Clients']['CedulaJuridica'] ?>"></td>
				</tr>
					</tr>
				<tr>
					<td><label for="RazonSocial"><?php  __('RazonSocial') ?></label></td>
					<td><input type="text" name="RazonSocial"  tabindex="11" size="30" maxlength="200" value="<?php echo $CurrentClient['Clients']['RazonSocial'] ?>"></td>
				</tr>
				<tr>
					<td><label for="Phone"><?php __('Phone') ?></label></td>
					<td><input type="text" name="Phone" tabindex="12" size="30" maxlength="20" value="<?php echo $CurrentClient['Clients']['Phone'] ?>"></td>
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
			<?php if($CurrentClient['Clients']['ClientID'] != ''){?>
			<input type="hidden" name="ClientID" value="<?php echo base64_encode($CurrentClient['Clients']['ClientID']) ?>">
			<?php } ?>
			<table border="0" class="zebra" align="center" width="600">
				<tr><th colspan="2">&nbsp;</th></tr>
			<?php if($CurrentClient['Clients']['ClientID'] != ''){?>
				<tr>
					<td><label for="DeleteClient">*<?php  __('DeleteClient') ?></label></td>
					<td><input type="checkbox" name="DeleteClient" id="DeleteClient" tabindex="7"></td>

				</tr>
			<?php } ?>
				<tr>
					<td><label for="ClientName">*<?php __('ClientName') ?></label></td>
					<td><input type="text" name="ClientName" tabindex="8" size="30" maxlength="200" value="<?php echo $CurrentClient['Clients']['ClientName'] ?>"></td>
				</tr>
							<tr>
					<td><label for="ClientName">*<?php __('ClientLastName') ?></lablientel></td>
					<td><input type="text" name="ClientLastName" tabindex="8" size="30" maxlength="50" value="<?php echo $CurrentClient['Clients']['ClientLastName'] ?>"></td>
				</tr>
				<tr>
					<td><label for="Email">*<?php __('Email') ?></label></td>
					<td><input type="text" name="Email"  tabindex="9" size="30" maxlength="100" value="<?php echo $CurrentClient['Clients']['Email'] ?>"></td>
				</tr>
				<tr>
					<td><label for="CedulaJuridica"><?php __('Cedula') ?></label></td>
					<td><input type="text" name="CedulaJuridica"  tabindex="10" size="30" maxlength="50" value="<?php echo $CurrentClient['Clients']['CedulaJuridica'] ?>"></td>
				</tr>
					</tr>
				<tr>
					<td><label for="Phone"><?php __('Phone') ?></label></td>
					<td><input type="text" name="Phone" tabindex="12" size="30" maxlength="20" value="<?php echo $CurrentClient['Clients']['Phone'] ?>"></td>
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