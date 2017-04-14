<?php
$session = $this->request->session();
	echo $this->Html->script("nyroModal/nyroModal");
	$CurrentSearch['Members']['ParentID']=$session->read('User.MemberID')
	?>
	<link rel="stylesheet" href="/js/nyroModal/nyroModal.css" type="text/css" media="screen" />
<fieldset>
<legend><?php echo $this->pageTitle ?></legend>
<form method="post" action="<?php $TheUrl ='/users/inactiveuser/'.$MemberID; echo do_crypt($TheUrl) ?>" name="TheForm" id="TheForm">
	<div align="center" class="message"><?php echo $Message; ?></div>
	<table align="center" border="0">
		<tr style="background-color:#FFFFFF">
			<?php if(count($GetParentsQ)> 0){ ?>
			<td><?php $SelectedParent = $CurrentSearch['ParentID']; include VIEWS.'/common/parent_select.php'?></td>
			<td><input type="submit" value="Re-Assign"></td>
			<?php }?>
		</tr>
		<tr><th colspan="2" class="lowerfade">&nbsp;</th></tr>
	</table>
</from>
