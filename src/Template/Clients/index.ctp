<?php 
	$this->pageTitle= __('ClientsOf', true).' '.$session->read('Company.CurrentName');
	$html->css("zebra","stylesheet", array(), false);
	$javascript->link("zebra/zebra", false);
?>
<h1><?php echo $this->pageTitle ?></h1>
<table border="0" width="80%" align="center" cellpadding="5"  class="zebra" >
			<form><tr><th colspan="5">
			<input type="button" name="AddNew" value="<?php __('AddNewClient') ?>" onclick="window.location.href='/<?php echo $this->viewPath ?>/newclient/'">
			</th></tr></form>
<?php 	if(count($ClientsQ) > 0){ ?>
	<tr>
		<th>&nbsp;</th>
		<th><?php __('ClientName') ?></th>
		<th><?php 
			$Em = str_replace(' ', '<br>', __('Email', true)); 
			echo $Em
		 ?></th>
		<th><?php __('Phone') ?></th>
		<th>&nbsp;</th>
	</tr>
	<?php
	$i = 0;
		foreach($ClientsQ as $CurrentClient){
			echo '<tr>';
			echo '<td class="left">&nbsp;</td>';
			echo '<td>',$CurrentClient['Clients']['ClientName'];
			if(trim($CurrentClient['Clients']['ClientLastName'])!=''){
				echo ' ',$CurrentClient['Clients']['ClientLastName'];	
			}
			echo '</td>';
			echo '<td>',$CurrentClient['Clients']['Email'],'</td>';
			echo '<td align="center">',$CurrentClient['Clients']['Phone'],'</td>';
			echo '<td class="right">';
			echo '<a href="/',$this->viewPath,'/editclient/',base64_encode($CurrentClient['Clients']['ClientID']),'/">',__('EditClient'),'</a>';
			echo '</td>';
			echo '</tr>';
		}
	?>
<?php } ?>
 	</table>
