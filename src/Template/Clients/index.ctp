<?php
$session = $this->request->session();
	$this->pageTitle= __('ClientsOf', true).' '.$session->read('Company.CurrentName');
	echo $this->Html->css("zebra");
	echo $this->Html->script("zebra/zebra");
?>
<h1><?php echo $this->pageTitle ?></h1>
<table border="0" width="80%" align="center" cellpadding="5"  class="zebra" >
			<form><tr><th colspan="5">
			<input type="button" name="AddNew" value="<?php echo __('AddNewClient') ?>" onclick="window.location.href='/<?php echo $this->viewPath ?>/newclient/'">
			</th></tr></form>
<?php 	if(count($ClientsQ) > 0){ ?>
	<tr>
		<th>&nbsp;</th>
		<th><?php echo  __('ClientName',true) ?></th>
		<th><?php
			$Em = str_replace(' ', '<br>', __('Email', true));
			echo $Em
		 ?></th>
		<th><?php echo __('Phone') ?></th>
		<th>&nbsp;</th>
	</tr>
	<?php
	$i = 0;
		foreach($ClientsQ as $CurrentClient){
			echo '<tr>';
			echo '<td class="left">&nbsp;</td>';
			echo '<td>',$CurrentClient['ClientName'];
			if(trim($CurrentClient['ClientLastName'])!=''){
				echo ' ',$CurrentClient['ClientLastName'];
			}
			echo '</td>';
			echo '<td>',$CurrentClient['Email'],'</td>';
			echo '<td align="center">',$CurrentClient['Phone'],'</td>';
			echo '<td class="right">';
			echo '<a href="/',$this->viewPath,'/editclient/',base64_encode($CurrentClient['ClientID']),'/">',__('EditClient'),'</a>';
			echo '</td>';
			echo '</tr>';
		}
	?>
<?php } ?>
 	</table>
