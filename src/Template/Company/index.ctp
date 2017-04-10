<?php
$this -> pageTitle = __('InvoicesFor', true) . ' ' . $session -> read('Company.CurrentName');
$html -> css("zebra", "stylesheet", array(), false);
$html -> css("ui", "stylesheet", array(), false);
$javascript -> link("zebra/zebra", false);
$javascript -> link("jquery/jquery.ui", false);
$javascript -> link("jquery/jquery.cookie", false);
$javascript -> link("tabs2", false);
//localized validation code
$TheJs = $session -> read('LocaleCode') . '/checkradios';
$javascript -> link($TheJs, false);
?>
	<h1><?php echo $this->pageTitle ?></h1>
	<?php
		if (count($InvoicesQ) > 0) {
			echo '<div id="tabs" style="width:95%">';
			echo '<ul>';
			$CurrentStatus = "0";
			foreach ($InvoicesQ as $ThisInvoice) {
				if ($CurrentStatus != $ThisInvoice['Status']['StatusID']) {
					echo '<li><a href="#tabs-', $ThisInvoice['Status']['StatusID'], '">', __($ThisInvoice['Status']['Status'] . 'pl'), '</a></li>';
					$CurrentStatus = $ThisInvoice['Status']['StatusID'];
				}
			}
			echo '<li><a href="#tabs-search">',__('Search'),'</a></li>';
			echo '<li style="float:right;" class="ui-corner-top ui-state-hover"><a style="color:#0B4284;font-weight:bold" onclick="window.location.href=\'', $session -> read('Company.CurrentCompanyURL'), 'newinvoice/\'">', __('AddNewInvoice'), '</a></li>';
			echo '</ul>';
			include 'tabscontent.ctp';
			echo '</div>';
		} else {
			echo '<div id="tabs" style="width:95%">';
			echo '<ul>';
			echo '<li style="float:right;" class="ui-corner-top ui-state-hover"><a style="color:#0B4284;font-weight:bold" onclick="window.location.href=\'', $session -> read('Company.CurrentCompanyURL'), 'newinvoice/\'">', __('AddNewInvoice'), '</a></li>';
			echo '</ul>';
			echo '</div>';
		}
	?>