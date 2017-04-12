<form name="TheForm" id="TheForm"  action="/myaccount/recpass/" method="POST">
	<blockquote>
		<fieldset>
			<legend><?php echo __('RemindPass') ?></legend>
				<table width="450" border="0" align="center">
					<th colspan="2"><?php echo __('RemidPassInstr') ?>:</th>
					<tr>
						<td align="center"><input name="email" type="text" id="email" value="" size="30" maxlength="50" /></td>
						<td nowrap="">
							<input name="submit" type="submit" value="<?php echo __('SendPass') ?>" />&nbsp;
							<input type="button" name="Cancel" id="Cancel" Value="<?php echo __('Cancel') ?>" onclick="window.location.href='/login/'">
						</td>
					</tr>
				</table>
		</fieldset>
	</blockquote>
</form>