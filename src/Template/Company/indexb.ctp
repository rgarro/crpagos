<?php
$session = $this->request->session();
$this -> pageTitle = __('InvoicesFor', true) . ' ' . $session -> read('Company.CurrentName');
echo $this->Html-> css("zebra");
echo $this->Html-> css("ui");
echo $this->Html->script("zebra/zebra");
echo $this->Html->script("jquery/jquery.ui");
echo $this->Html->script("jquery/jquery.cookie");
echo $this->Html->script("tabs2");
//localized validation code
$TheJs = $session -> read('LocaleCode') . '/checkradios';
echo $this->Html->script($TheJs);
?>
	<h3><?php echo $this->pageTitle ?></h3>
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
