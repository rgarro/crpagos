<?php
	$html -> css("admin/forms", null, array('inline' => false));
	$html -> css("admin/validation", null, array('inline' => false));	
	$html -> script($session -> read('LocaleCode') . "/validate", array('inline' => false));
	$html -> script("donate", array('inline' => false));
	//ProductID = 11
?>
<form action="/donations/" method="post">
<fieldset>
	<ol>
		
		<?php
			echo '<li><h1>',__('ChooseAmount'),'</h1></li>';
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
					
			echo '<li><h1>', __('ContactandBillingInformation'), '</h1></li>';
			include 'contactinfo.ctp';
			
			echo '<li><h1>', __(' PaymentInformation'), '</h1></li>';
			include 'ccinfo.ctp';
			
			echo '<input type="submit" value="',  __('DonateNow'), '" id="DonateButton">';
		?>
	</ol>
</fieldset>

<div id="paydialog" title="<?php __('Wait')?>..." style="display:none;text-align:center">
  <p align="center">
    <h4 style="font-size:1.5em;margin-bottom: 20px">
    	<?php __('ContactingBank') ?>
    </h4>
    <img src="/img/nyroModal/loading.gif" width="43" height="43" border="0" alt="<?php __('Wait')?>...">  
  </p>
</div>	