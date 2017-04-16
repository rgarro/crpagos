<?php
use Cake\Core\Configure;
use Cake\Error\Debugger;

$session = $this->request->session();
 if(count($InvoiceLogQ) > 0){
?>
<tr>
	<td>
		<div class="hidecomments"><a href="#" class="commentslink">-<?php echo __('HideComments')?></a></div>
		<div class="showcomments"><a href="#" class="commentslink">+<?php echo __('ShowComments')?></a></div>
	</td>
</tr>
<tr>
	<td>
		<div class="comments">
			<?php
			foreach ($InvoiceLogQ as $CurrentLog){
					echo '<div class="commentheader"><b>',__($CurrentLog['Action']),'</b><br>';
					echo '<em>** ',$CurrentLog['ActionBy'];
					if(Configure::read('Config.language') == 'spa_cr'){
						echo ' el ',$this->Fecha->get_date_spanish(strtotime($CurrentLog['ActionDate']));
					}else{
						echo ' on ',date('l, F j Y g:i a', strtotime($CurrentLog['ActionDate']));
					}
					echo '**</em><br>';
					if(trim($CurrentLog['Comment']) != ''){
						echo '<div class="commenttext">',html_entity_decode(str_replace("\\r\\n", "<br>", $CurrentLog['Comment']),ENT_NOQUOTES,'iso-8859-1'),'</div>';
					}
					echo '</div>';
	   		}
	   ?>
		</div>
	</td>
</tr>
<?php }

	if(isset($ThisInvoice['StatusID']) && $ThisInvoice['StatusID'] < 3){
?>
<tr>
	<td><label for="Comment"><?php echo (isset($ShowReq))? '*' : '', __('AddNewComment')?>:</label>
	<blockquote><textarea name="Comment" id="Comment" wrap="soft" cols="75" rows="3" tabindex="21"></textarea></blockquote></td>
</tr>
<?php } ?>
