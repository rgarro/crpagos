<?php
$session = $this->request->session();
	$this->pageTitle= __('UsersOf', true).' '.$session->read('Company.CurrentName');
	echo $this->Html->css("zebra");
	echo $this->Html->script("zebra/zebra");
?>
<h3><?php echo $this->pageTitle ?></h3>
<?php if(count($GetUsersQ) > 0){?>
<table border="0" width="80%" align="center" cellpadding="5"  class="zebra" >
<tr>
	<th><?php echo __('Status') ?></th>
	<th><?php echo __('AccessLevel') ?></th>
	<th><?php echo __('FirstName') ?></th>
	<th><?php echo __('LastName' )?></th>
	<th><?php echo __('Email') ?></th>
	<th>&nbsp;</th>
</tr>
<?php
	foreach($GetUsersQ as $CurrentUser){
		echo '<tr>';
		echo '<td align="center" class="left">';
		if($CurrentUser['UserStatus'] == 1){
			echo __('Active');
		}else{
			echo __('InActive');
		}
		echo '</td>';
		echo '<td align="center">',__($CurrentUser['AccessLevel']),'</td>';
		echo '<td align="center">',$CurrentUser['FirstName'],'</td>';
		echo '<td align="center">',$CurrentUser['LastName'],'</td>';
		echo '<td align="center"><a href="mailto:',$CurrentUser['Email'],'">',$CurrentUser['Email'],'</a></td>';
		echo '<td align="center" class="right">';
		echo '<a href="/users/edituser/',base64_encode($CurrentUser['UserID']),'/">',__('Edit'),'</a>';
		echo '</td>';
		echo '</tr>';
	}
?>
	<form>
		<tr>
			<th colspan="6">
				<input type="button" name="AddNew" value="<?php echo __('AddNewUser') ?>" onclick="window.location.href='/users/addnewuser/<?php base64_encode(0)?>'">
			</th>
		</tr>
	</form>

	</table>
<?php }else{ ?>
	<h3>We're Sorry, but you have no users assigned yet!</h3>
<?php } ?>
