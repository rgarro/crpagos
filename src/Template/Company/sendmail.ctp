<?php
$session = $this->request->session();
?>
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
	echo '<a href="','/company/','">', __('BackToList'),'</a>';
?>
