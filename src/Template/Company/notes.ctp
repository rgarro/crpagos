<?php if(count($InvoiceLogQ) > 0){?>
<tr>
	<td>
		<div class="hidecomments"><a href="#" class="commentslink">-<?php __('HideComments')?></a></div>
		<div class="showcomments"><a href="#" class="commentslink">+<?php __('ShowComments')?></a></div>
	</td>
</tr>
<tr>
	<td>
		<div class="comments">
			<?php
			foreach ($InvoiceLogQ as $CurrentLog){
					echo '<div class="commentheader"><b>',__($CurrentLog['Actions']['Action']),'</b><br>';
					echo '<em>** ',$CurrentLog['InvoiceLog']['ActionBy'];
					if(Configure::read('Config.language') == 'spa_cr'){
						echo ' el ',$fecha->get_date_spanish(strtotime($CurrentLog['InvoiceLog']['ActionDate']));
					}else{
						echo ' on ',date('l, F j Y g:i a', strtotime($CurrentLog['InvoiceLog']['ActionDate']));
					}
					echo '**</em><br>';	
					if(trim($CurrentLog['InvoiceLog']['Comment']) != ''){
						echo '<div class="commenttext">',html_entity_decode(str_replace("\\r\\n", "<br>", $CurrentLog['InvoiceLog']['Comment']),ENT_NOQUOTES,'iso-8859-1'),'</div>';	
					}
					echo '</div>';
	   		}		
	   ?>
		</div>
	</td>
</tr>
<?php } 
	
	if(isset($ThisInvoice['Invoices']['StatusID']) && $ThisInvoice['Invoices']['StatusID'] < 3){
?>
<tr>
	<td><label for="Comment"><?php echo (isset($ShowReq))? '*' : '', __('AddNewComment')?>:</label>
	<blockquote><textarea name="Comment" id="Comment" wrap="soft" cols="75" rows="3" tabindex="21"></textarea></blockquote></td>
</tr>
<?php } ?>