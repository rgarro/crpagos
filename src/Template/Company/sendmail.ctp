<div style="text-align:left">
	<blockquote>
		<ol>
			<?php foreach($SentTo As $ThisOne){
				echo '<li>',$ThisOne,'</li>';
			}?>
		</ol>
	</blockquote>
	</div>
<?php 
	echo '<a href="',$session->read('Company.CurrentURL'),'">', __('BackToList'),'</a>';
?>
