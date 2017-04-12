<form name="SearchForm" id="SearchForm" method="post" action="<?php echo $session -> read('Company.CurrentURL') ?>search/">
	<table border="0" class="zebra" align="center" width="500">
		<tr>
			<td valign="top"><label for="InvoiceNumber"><?php echo __('InvoiceNumber') ?>:</label></td>
			<td><input type="text" name="InvoiceNumber" id="InvoiceNumber" value="" size="15" maxlength="25"></td>
		</tr>
		<tr>
			<td valign="top"><label for="ClientName"><?php echo __('CompanyName') ,'<br>&nbsp;&nbsp;',__('Or'),' ', __('ClientsName') ?>:</label></td>
			<td><input type="text" name="ClientName" size="30" maxlength="30" value=""></td>
		</tr>
		<tr>
			<td><label for="ClientLastName"><?php echo __('ClientLastName') ?>:</label></td>
			<td><input type="text" name="ClientLastName" size="30" maxlength="50" value=""></td>
		</tr>
		<tr>
			<td  valign="top"><label for="Email"><?php echo __('Email') ?>:</label></td>
			<td><input type="text" name="Email" size="30" maxlength="100" value=""></td>
		</tr>
		</tr>
		<tr>
			<th colspan="2" align="center">
				<input name="Search" type="submit" id="Search" value="<?php echo __('Search') ?>">
			</th>
		</tr>
	</table>
</form>