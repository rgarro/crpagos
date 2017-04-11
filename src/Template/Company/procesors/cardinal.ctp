<?php
$session = $this->request->session();
echo $this->Html->css("ui");
echo $this->Html->script("jquery/jquery.ui");
echo $this->Html->script("check");
?>
<fieldset style="width: 400px; margin: 10px auto;">
	<ol style="list-style: none">
		<input type="hidden" id="InvalidCCCard" value="<?php __('InvalidCCCard')?>" />
		<li>
			<label for="CCHolder" style="display: block;margin: 0px;float: left;width: 150px;">*<?php __('CardHolderName') ?>:</label>
			<input type="text" name="CCHolder" id="CCHolder" value="<?php echo $session->read('CardData.CCHolder') ?>" maxlength="50"/>
		</li>
		<li>
			<label for="CCNumber" style="display: block;margin: 0px;float: left;width: 150px;">*<?php __('CCNumber') ?>:</label>
			<input type="text" name="CCNumber" id="CCNumber" value="<?php echo $session->read('CardData.CCNumber') ?>" maxlength="16" autocomplete="off"/>
			<div class="card">
				<img class="cards" id="amex" width="40" height="25" src="/img/cardlogos/amex_mid.png">
				<img class="cards" id="dinners" width="40" height="25" src="/img/cardlogos/dinners_mid.png">
				<img class="cards" id="jcb" width="40" height="25" src="/img/cardlogos/jcb_mid.png">
				<img class="cards" id="mastercard" width="40" height="25" src="/img/cardlogos/mastercard_mid.png">
				<img class="cards" id="visa" width="40" height="25" src="/img/cardlogos/visa_mid.png">
				<img class="cards" id="discover" width="40" height="25" src="/img/cardlogos/discover_mid.png">
			</div>
		</li>
		<li>
			<label for="CVV" style="display: block;margin: 0px;float: left;width: 150px;">*<?php __('CVV') ?>:</label>
			<input type="text" name="CVV" id="CVV" value="" maxlength="4" style="width:45px" autocomplete="off"/> <a id="CVVC" href="http://www.cvvnumber.com/cvv.html" target="_blank" class="nyroModal" style="font-size:11px">What is my CVV code?</a>
		</li>
		<li>
		<li>
			<label for="ccexp" style="display: block;margin: 0px;float: left;width: 150px;">*<?php __('ExpireDate') ?>:</label>
			<select  name="CCExp" id="CCExp" style="text-align:center;width:153px">
				<option value=""><?php echo __('Month'),' / ',__('Year')
					?></option>
				<?php
				$today = getdate();
				$year = $today['year'];
				$mon = $today['mon'];
				for ($y = $year; $y < $year + 20; $y++) {
					if ($y == $year) {
						$mv = $mon;
					} else {
						$mv = 1;
					}
					for ($m = $mv; $m < 13; $m++) {
						$TheVal = str_pad($m, 2, "00", STR_PAD_LEFT) . substr($y, -2, 2);
						$TheDisp = str_pad($m, 2, "00", STR_PAD_LEFT) . " / " . $y;
						if ($session -> read('CardData.CCExp') == $TheVal) {
							$Selected = 'Selected';
						} else {
							$Selected = '';
						}
						echo '<option value="', $TheVal, '" ', $Selected, '>', $TheDisp, '</option>';
					}
				}
				?>
			</select>
		</li>
	</ol>
</fieldset>

<div id="dialog" title="<?php __('PleaseWait')?>" style="display:none;text-align:center">
  <p align="center">
    <h1><?php __('ContactingBank')?></h1>
    <img src="/img/loading.gif" width="43" height="43" border="0" alt="<?php __('PleaseWait')?>">
  </p>
</div>
