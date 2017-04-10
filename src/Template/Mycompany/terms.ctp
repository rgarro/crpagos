<?php

	$CurrentCompany = current($GetMyCompanyQ);
	if($session->read('LocaleCode') == 'spa_cr'){
		$this->pageTitle= __('Terms', true).' de '.$CurrentCompany['Companies']['CompanyName'];
	}else{
		$this->pageTitle= $CurrentCompany['Companies']['CompanyName'].'&rsquo;s '.__('Terms', true);
	}

	$html->css("zebra","stylesheet", array(), false);
	$javascript->link("zebra/zebra", false);
	$javascript->link("jquery/jquery.tinymce", false);
	$ThePageLang = substr($session -> read('LocaleCode'), 0, 2);
	if($ThePageLang == 'sp'){
		$ThePageLang = 'es';
	}
	$TheBlock = "var locale = '" . $ThePageLang . "'";
	$this -> addScript($javascript -> codeBlock($TheBlock));
	$javascript->link("tinymce", false);


?>
<h1><?php echo $this->pageTitle ?></h1>
	<form method="post" action="/mycompany/terms/" id="TheForm" name="TheForm" enctype="multipart/form-data">
	<table border="0" class="zebra" align="center" width="600">
		<?php
			foreach ($LocalesQ as $ThisLocale) {
				echo '<tr>';
				echo '<th valign="top">',$ThisLocale['Locales']['Locale'],':</th>';
				$ThisOne = $ThisLocale['Locales']['LocaleCode'];
				echo '<input type="hidden" name="Locales[]" value="',$ThisOne,'">';
				if(is_null($TermsQ[$ThisLocale['Locales']['LocaleCode']])){
					$FieldName = $ThisOne.'_New';
				}else{
					$FieldName = $ThisOne.'_Content';
				}
				echo '<td>';
				echo '<textarea name="',$FieldName,'" rows="20" cols="80">',$TermsQ[$ThisLocale['Locales']['LocaleCode']],'</textarea>';
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