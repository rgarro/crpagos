<?php
$session = $this->request->session();
?>
<div id="ClientForm" >
	<ul style="float:none">
		<li><a href="#Bus"><?php echo __('Company') ?></a></li>
		<li><a href="#Per"><?php echo __('Personal') ?></a></li>
	</ul>
	<div id="Bus" style="padding:0px">
			<form method="post" action="/company/quickaddclient/" id="TheBusForm" name="TheBusForm" style="margin:10px 25px 10px 5px;">
			<input type="hidden" name="save_to" value="ClientID.data">
			<input type="hidden" value="<?php echo __('Save') ?>" id="ButOrValB">
			<table border="0" class="zebra" align="center" width="500">
				<tr>
					<td width="200" valign="top" nowrap=""><label for="ClientName">*<?php echo __('CompanyName') ?>:</label></td>
					<td width="300"><input type="text" name="ClientName" tabindex="8" size="30" maxlength="200" value=""></td>
				</tr>
				<tr>
					<td><label for="Email" valign="top">*<?php echo __('Email') ?>:</label></td>
					<td><input type="text" name="Email"  tabindex="9" size="30" maxlength="100" value=""></td>
				</tr>
				<tr>
					<td><label for="CedulaJuridica"><?php echo __('CedulaJuridica') ?>:</label></td>
					<td><input type="text" name="CedulaJuridica"  tabindex="10" size="30" maxlength="50" value=""></td>
				</tr>
					</tr>
				<tr>
					<td><label for="RazonSocial"><?php echo __('RazonSocial') ?>:</label></td>
					<td><input type="text" name="RazonSocial"  tabindex="11" size="30" maxlength="200" value=""></td>
				</tr>
				<tr>
					<td><label for="Phone"><?php echo __('Phone') ?>:</label></td>
					<td><input type="text" name="Phone" tabindex="12" size="30" maxlength="20" value=""></td>
				</tr>
				<tr>
					<th colspan="2" align="center">
						<input type="submit" value="<?php echo __('SaveCompany') ?>" name="QuickSubmitB" id="QuickSubmitB" tabindex="13">&nbsp;
						<input type="button" name="CloseB" id="CloseB" value="<?php echo __('Close')?>">
					</th>
				</tr>
			</table>
		</form>
	</div>
	<div id="Per"  style="padding:0px">
			<form method="post"  action="/company/quickaddclient/"  id="TheClientForm" name="TheClientForm" style="margin:10px 25px 10px 5px;">
			<input type="hidden" name="save_to" value="ClientID.data">
			<input type="hidden" value="<?php echo __('Save') ?>" id="ButOrValP">
			<table border="0" class="zebra" align="center" width="500">
				<tr>
					<td width="200" valign="top"><label for="ClientName">*<?php echo __('ClientName') ?></label></td>
					<td width="300"><input type="text" name="ClientName" tabindex="8" size="30" maxlength="30" value=""></td>
				</tr>
					<tr>
					<td valign="top"><label for="ClientLastName">*<?php echo __('ClientLastName') ?></label></td>
					<td><input type="text" name="ClientLastName" tabindex="8" size="30" maxlength="50" value=""></td>
				</tr>
				<tr>
					<td  valign="top"><label for="Email">*<?php echo __('Email') ?></label></td>
					<td><input type="text" name="Email"  tabindex="9" size="30" maxlength="100" value=""></td>
				</tr>
				<tr>
					<td><label for="CedulaJuridica"><?php echo __('Cedula') ?></label></td>
					<td><input type="text" name="CedulaJuridica"  tabindex="10" size="30" maxlength="50" value=""></td>
				</tr>
					</tr>
				<tr>
					<td><label for="Phone"><?php echo __('Phone') ?></label></td>
					<td><input type="text" name="Phone" tabindex="12" size="30" maxlength="20" value=""></td>
				</tr>
				<tr>
					<th colspan="2" align="center">
						<input type="submit" value="<?php echo __('SaveClient') ?>"  name="QuickSubmitB" id="QuickSubmitP" tabindex="13">&nbsp;
						<input type="button" name="CloseP" id="CloseP" value="<?php echo __('Close')?>">
					</th>
				</tr>
			</table>
		</form>
	</div>
</div>
