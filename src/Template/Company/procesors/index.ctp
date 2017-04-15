<?php
$session = $this->request->session();
	echo $this->Html->css("admin/forms");
	echo $this->Html->css("admin/validation");
	echo $this->Html->script($session -> read('LocaleCode') . "/validate");
	echo $this->Html->script("donate");
	//ProductID = 11
?>
<form action="/donations/" method="post">
<fieldset>
	<ol>

		<?php
			echo '<li><h3>',__('ChooseAmount'),'</h3></li>';
			echo '<li>';
			$DefaultAmount = 50;
			$Amounts = array(25,50,100,250,500);
			foreach ($Amounts as $ThisIDx => $ThisAmount) {
				if($ThisAmount == $DefaultAmount){
					$Checked = 'checked';
				}else{
					$Checked = null;
				}
				echo '<label for="Amount',$ThisIDx,'" style="width:110px">';
				echo '<input type="radio" name="Amount" id="Amount',$ThisIDx,'" value="',$ThisAmount,'" ',$Checked,' class="validate[required]">&nbsp;';
				echo $session->read('Client.Currency'),' ',number_format($ThisAmount, '2');
				echo '</label>'."\n";
			}
			echo '</li>';
			echo '<li>';
			echo '<label for="OtherAmount" style="width:110px">';
			echo '<input type="radio" name="Amount" id="OtherAmount" value="" onclick="$(\'#OtherAmountVal\').focus()">&nbsp;';
			echo  __('OtherAmount'),':';
			echo '</label>';
			echo '<div class="TextLeft"></div><div class="TextCenter">';
			echo  $session->read('Client.Currency'),' <input type="text" name="OtherAmountVal" id="OtherAmountVal" maxlength="5" value="" class="validate[optional,custom[onlyNumber]]" onclick="$(\'#OtherAmount\').attr(\'checked\', true)">';
			echo '</div><div class="TextRight"></div>';
			echo '</li>';

			echo '<li><h3>', __('ContactandBillingInformation'), '</h3></li>';
			include 'contactinfo.ctp';

			echo '<li><h3>', __(' PaymentInformation'), '</h3></li>';
			include 'ccinfo.ctp';

			echo '<input type="submit" value="',  __('DonateNow'), '" id="DonateButton">';
		?>
	</ol>
</fieldset>

<div id="paydialog" title="<?php echo __('Wait')?>..." style="display:none;text-align:center">
  <p align="center">
    <h4 style="font-size:1.5em;margin-bottom: 20px">
    	<?php echo __('ContactingBank') ?>
    </h4>
    <img src="/img/nyroModal/loading.gif" width="43" height="43" border="0" alt="<?php echo __('Wait')?>...">
  </p>
</div>
