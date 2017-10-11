<?php
use Cake\Core\App;

$session = $this->request->session();
	if(isset($_SERVER['HTTPS'])){
		$Protocol = "https://";
	}else{
		$Protocol = "http://";
	}
	$FirstURI = $Protocol.$_SERVER['SERVER_NAME']."/payment/".__('CodeLink', true).'/';
	$Code = '?'.__('InvoiceCode', true).'='.rawurlencode($TheCode);
	$FullURI = $FirstURI.$Code;

	require current(App::path("Template")).'/Acompany'.DS.'invoice.ctp';
?>
<p>&nbsp;</p><table width="720" border="0" align="center">
  <tr>
    <td colspan="2" bgcolor="#CCD6D8" align="center"><?php echo __('PayInstructions1') ?></td>
  </tr>
  <tr>
    <td width="50%" align="center" valign="top" colspan="2">
			<?php
		echo '<p align="left">',__('PayInstructions3'),'</p>';
		echo '<div class="homebutton">';
		echo '<a href="',$FullURI,'" class="btn btn-primary btn-lg" target="_blank">',__('Pay'),'</a>';
		echo '</div>';
		?></td>
  </tr>
  <tr>
    <td colspan="2" align="center" bgcolor="#CCD6D8">
    	<?php
		echo '<p>',__('PayInstructions4'),'</p>';
	?></td>
  </tr>
</table>
