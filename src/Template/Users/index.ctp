<?php 
	$this->pageTitle= __('UsersOf', true).' '.$session->read('Company.CurrentName');
	$html->css("zebra","stylesheet", array(), false);
	$javascript->link("zebra/zebra", false);
?>
<h1><?php echo $this->pageTitle ?></h1>
<?php if(count($GetUsersQ) > 0){?>
<table border="0" width="80%" align="center" cellpadding="5"  class="zebra" >
<tr>
	<th><?php __('Status') ?></th>
	<th><?php __('AccessLevel') ?></th>
	<th><?php __('FirstName') ?></th>
	<th><?php __('LastName' )?></th>
	<th><?php __('Email') ?></th>
	<th>&nbsp;</th>
</tr>
<?php
	foreach($GetUsersQ as $CurrentUser){
		echo '<tr>';
		echo '<td align="center" class="left">';
		if($CurrentUser['Users']['UserStatus'] == 1){
			__('Active');
		}else{
			__('InActive');	
		}
		echo '</td>';
		echo '<td align="center">',__($CurrentUser['AccessLevels']['AccessLevel']),'</td>';	
		echo '<td align="center">',$CurrentUser['Users']['FirstName'],'</td>';
		echo '<td align="center">',$CurrentUser['Users']['LastName'],'</td>';
		echo '<td align="center"><a href="mailto:',$CurrentUser['Users']['Email'],'">',$CurrentUser['Users']['Email'],'</a></td>';
		echo '<td align="center" class="right">';
		echo '<a href="/users/edituser/',base64_encode($CurrentUser['Users']['UserID']),'/">',__('Edit'),'</a>';
		echo '</td>';
		echo '</tr>';
	}
?>
	<form>
		<tr>
			<th colspan="6">
				<input type="button" name="AddNew" value="<?php __('AddNewUser') ?>" onclick="window.location.href='/users/addnewuser/<?php base64_encode(0)?>'">
			</th>
		</tr>
	</form>

	</table>
<?php }else{ ?>
	<h1>We're Sorry, but you have no users assigned yet!</h1>
<?php } ?>
