<?php
$session = $this->request->session();
	$CurrentCompany = current($GetMyCompanyQ);
	if($session->read('LocaleCode') == 'spa_cr'){
		$this->pageTitle= __('Terms', true).' de '.$CurrentCompany['CompanyName'];
	}else{
		$this->pageTitle= $CurrentCompany['CompanyName'].'&rsquo;s '.__('Terms', true);
	}

	echo $this->Html->css("zebra");
	echo $this->Html->script("zebra/zebra");
	echo $this->Html->script("jquery/jquery.tinymce");
	$ThePageLang = substr($session -> read('LocaleCode'), 0, 2);
	if($ThePageLang == 'sp'){
		$ThePageLang = 'es';
	}
	$TheBlock = "var locale = '" . $ThePageLang . "';";
	?>
	<script type="text/javascript">
	<?php echo $TheBlock; ?>
	</script>
	<?php
	//$this -> addScript($javascript -> codeBlock($TheBlock));
	echo $this->Html->script("tinymce");
?>
<h4 style="text-align:center;"><?php echo $this->pageTitle ?></h4>
	<form method="post" action="/mycompany/terms/" id="TheForm" name="TheForm" enctype="multipart/form-data">
	<table border="0" class="zebra" align="center" width="600">
		<?php
			foreach ($LocalesQ as $ThisLocale) {
				echo '<tr>';
				echo '<th valign="top">',$ThisLocale['Locale'],':</th>';
				$ThisOne = $ThisLocale['LocaleCode'];
				echo '<input type="hidden" name="Locales[]" value="',$ThisOne,'">';
				if(is_null($TermsQ[$ThisLocale['LocaleCode']])){
					$FieldName = $ThisOne.'_New';
				}else{
					$FieldName = $ThisOne.'_Content';
				}
				echo '<td>';
				echo '<textarea name="',$FieldName,'" rows="20" cols="80">',$TermsQ[$ThisLocale['LocaleCode']],'</textarea>';
				echo '</td>';
				echo '</tr>';
			}
		?>
		<tr>
			<th colspan="2" align="center">
				<input type="submit" value="<?php echo __('Save') ?>" id="Sumbmit" name="Submit" tabindex="9">
			</th>
		</tr>
	</table>
</form>
