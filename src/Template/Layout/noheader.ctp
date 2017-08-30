<?php
$session = $this->request->session();
?>
<!DOCTYPE html>
<html lang="en">
	<head>
	<meta charset="utf-8">
	<meta http-equiv="X-UA-Compatible" content="IE=edge">
	<meta name="viewport" content="width=device-width, initial-scale=1">
	<title>:: NicaPagos Pago ::</title>
	<?php
		header("Cache-Control: no-cache, must-revalidate");
		header("Expires: Mon, 01 Jan 1990 00:00:01 GMT");
	?>
<meta http-equiv="Pragma" content="no-cache" >
	<meta http-equiv="Expires" content="Mon, 01 Jan 1990 00:00:01 GMT" >
	<meta name="robots" content="no index,no follow">
	<meta name="robots" content="all">
	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="/css/crpagos.css" />
	<script type="text/javascript" src="/js/jquery/jquery.js"></script>
	<script language="javascript" src="/js/jquery/jquery.corner.js"></script>
	<script language="JavaScript" type="text/javascript">
		$(document).ready(function(){
			$(".mainwrap").corner("top");
			$(".bottom").corner("bottom");
			$(".loginround").corner()
			$(".content").corner();
		});
	</script>
	</head>
	<?php
		if(!isset($CurrentBgImage)){
			$CurrentBgImage = $session->read('Company.CurrentURL').$session->read('Company.CurrentBgImage');
		}

		if(!isset($CurrentBgColor)){
			$CurrentBgColor = $session->read('Company.CurrentBgColor');
		}
		if(strlen($CurrentBgImage) >0){
			echo '<style>body{ background-image:url(/img',$CurrentBgImage,')} div.content{background:',$CurrentBgColor,' none;}</style>'."\n";
		}
	?>
		<body>
		<center>
			<noscript>
				 <div class="jsmessage"><p><?php __('NoJavaScript')?></p></div>
			 </noscript>
			<div class="mainwrap" style="background:#ffffff none;height:5px"></div>
			<div class="contentwrap">
				<div class="content">
					  <?= $this->Flash->render() ?>
						<?= $this->fetch('content') ?>
				</div>
			</div>
			<div class="bottom" style="background:#ffffff"></div>
		</center>
	</body>
</html>
<?php
	if(isset($ClearSession)){
		unset($_SESSION['Company']);
		unset($_SESSION['Client']);
		unset($_SESSION['User']);
	 }
?>
