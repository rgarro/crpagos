<?php
/**
 * CakePHP(tm) : Rapid Development Framework (http://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
$session = $this->request->session();
$cakeDescription = 'crpagos cakephp3 version';
?>
<!doctype html>
<!--[if lt IE 7]>      <html class="no-js lt-ie9 lt-ie8 lt-ie7" lang=""> <![endif]-->
<!--[if IE 7]>         <html class="no-js lt-ie9 lt-ie8" lang=""> <![endif]-->
<!--[if IE 8]>         <html class="no-js lt-ie9" lang=""> <![endif]-->
<!--[if gt IE 8]><!--> <html class="no-js" lang=""> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php
  		header("Cache-Control: no-cache, must-revalidate");
  		header("Expires: Mon, 01 Jan 1990 00:00:01 GMT");
  	?>
  <meta http-equiv="Pragma" content="no-cache" >
  	<meta http-equiv="Expires" content="Mon, 01 Jan 1990 00:00:01 GMT" >
  	<meta name="robots" content="no index,no follow">
  	<meta name="robots" content="all">
    <? //$this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
		<link rel="stylesheet" href="/css/normalize.min.css">
		<link rel="stylesheet" href="/css/main.css">

		<script src="/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <title>
      <?php //echo $title_for_layout  ?>
        <?= $this->fetch('title') ?>
    </title>



	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="/css/crpagos.css" />
	<script type="text/javascript" src="/js/jquery/jquery.js"></script>
	<?php
		//echo $scripts_for_layout . "\n";
	?>
	<script language="javascript" src="/js/jquery/jquery.corner.js"></script>
	<script language="JavaScript" type="text/javascript">
		$(document).ready(function() {
			$(".mainwrap").corner("top");
			$(".bottom").corner("bottom");
			$(".loginround").corner()
			$(".content").corner();
		});
	</script>
	</head>
	<body>
		<!--[if lt IE 8]>
				<p class="browserupgrade">You are using an <strong>outdated</strong> browser. Please <a href="http://browsehappy.com/">upgrade your browser</a> to improve your experience.</p>
		<![endif]-->
		<center>
			<noscript>
				 <div class="jsmessage"><p><?php echo __('NoJavaScript')?></p></div>
			 </noscript>

			<div class="mainwrap">
				<?php
				if ($session -> check('Company.CurrentURL')) {
					$HomeLink = $session -> read('Company.CurrentURL');
				} else {
					$HomeLink = "/";
				}
				echo '<a href="', $HomeLink, '">';
				?>
				<img src="/img/logo.gif" width="277" height="80" alt="CRPagos.com Facil y Seguro" border="0" align="left"></a>
				<?php
					if ($session -> check('User.UserID')) {
						echo '<div class="welcome"><b>', __('Welcome'), '<br>', $session -> read('User.FullName'), '</b>';
						echo $this->element('langswitch');
						echo '</div>';
					} else {
						echo $this->element('toplogin');
					}
				?>
			</div>

			<?php if($this->request->here() != $session->read('Company.PayURL')){?>
			<div class="topmenu">
				<?php
				if ($session -> check('User.UserID')) {
					echo $this -> element('menu');
				} else {
					echo $this -> element('publicmenu');
				}
			?>
			</div>
			<?php } ?>
			<div class="contentwrap">

				<div class="content">
          <?= $this->Flash->render() ?>
					<?php
					/*if ($session -> flash() != "") {
						echo $session -> flash();
					}*/
					if($this->request->here() == $session->read('Company.CurrentURL')){
						echo '<div style="float:right">';
						include VIEWS.'elements'.DS.'companyselect.ctp' ;
						echo '</div>';
					}
					//echo $content_for_layout;
						?>
              <?= $this->fetch('content') ?>
				</div>
			</div>
			<div class="line"></div>
			<div class="bottom">
			<?php if($this->request->here() != $session->read('Company.PayURL')){?>
			<?php
				if ($this->request->here() == '/') {
					echo $this->element('bottomhome');
				}
				echo $this ->element('bottommenu');
			?>
			</div>
			<div class="copy">
				<?php echo __('CopyRights')?>
			</div>
			<?php } ?>
		</center>
	</body>
</html>
