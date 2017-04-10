<?php
	if(isset($_SERVER['HTTPS'])){
		$Protocol = "https://";
	}else{
		$Protocol = "http://";
	}
	$FirstURI = $Protocol.$_SERVER['SERVER_NAME'].$session->read('Company.CurrentURL').__('CodeLink', true).'/';
	$Code = '?'.__('InvoiceCode', true).'='.rawurlencode($TheCode);
	$FullURI = $FirstURI.$Code;
	
	include VIEWS.'company'.DS.'invoice.ctp';
?>	
<p>&nbsp;</p><table width="720" border="0" align="center">
  <tr>
    <td colspan="2" bgcolor="#CCD6D8" align="center"><?php __('PayInstructions1') ?></td>
  </tr>
  <tr>
    <td width="50%" align="center" valign="top"><?php
		echo '<p align="left">',__('PayInstructions3'),'</p>';
		echo '<div class="homebutton">';
		echo '<a href="',$FullURI,'" target="_blank">',__('Pay'),'</a>';
		echo '</div>';
		?></td>
    <td width="50%" valign="top"><?php 
		echo '<p>',__('PayInstructions2'),'<ol>';
		echo '<li>',__('PayInstructions2a'), ':<br> ', $TheCode,' </li>' ;
		echo '<li>',__('PayInstructions2b'),'<br><a href="',$FirstURI,'" target="_blank">',$FirstURI,'</a></li>';
		echo '<li>',__('PayInstructions2c'),'</li>';
	echo '</ol></p>';
	
    ?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCD6D8">
    	<?php 
		echo '<p>',__('PayInstructions4'),'</p>';
	?></td>
  </tr>
</table>