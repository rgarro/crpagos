<?php
$session = $this->request->session();
	$this->pageTitle=__('Welcome', true);
	//$this->html->meta('keywords', '', array(), false);
	//$this->html->meta('description', '', array(), false);
?>
<table border="0" cellpadding="0" cellspacing="0" width="100%">
	<tr>
		<td rowspan="2">
			<img src="/img/home_<?php echo $session->read('LocaleCode')?>.jpg" width="557" height="311" alt="<?php __('TheSolution') ?>"/>
		</td>
		<td colspan="2" style="text-align:center"><?php
			echo '<h1>',__('Home1'),'</h1>';
			echo '<h3>',__('Home2'),'</h3>';
			echo '<h2>',__('Home3'),'</h2>';
		?></td>
	</tr>
	<tr>
		<td class="homebutton"><a href="/<?php echo strtolower(__('Bussiness', true)) ?>.htm" class="homebuttonlink"><?php __('Bussiness') ?></a></td><td class="homebutton"><a href="/<?php echo strtolower(__('Personal', true))?>.htm" class="homebuttonlink"><?php __('Personal') ?></a></td>
	</tr>
</table>
