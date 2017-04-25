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
<!--[if gt IE 8]><!--> <html class="no-js" lang="eng_us"> <!--<![endif]-->
	<head>
		<meta charset="utf-8">
		<meta http-equiv="X-UA-Compatible" content="IE=edge,chrome=1">
    <?php
  		header("Cache-Control: no-cache, must-revalidate");
  		header("Expires: Mon, 01 Jan 1990 00:00:01 GMT");
  	?>
		<meta http-equiv="refresh" content="<?php echo ini_get('session.gc_maxlifetime');?>,url=http://nicapagos.com">
  	<meta name="robots" content="no index,no follow">
  	<meta name="robots" content="all">
    <? //$this->Html->charset() ?>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

		<link rel="stylesheet" href="/css/main.css">

		<script src="/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
    <title>
      <?php //echo $title_for_layout  ?>
        <?= $this->fetch('title') ?>
    </title>

	<link rel="shortcut icon" href="/img/favicon.ico" type="image/x-icon" />
	<link rel="stylesheet" type="text/css" href="/css/crpagos.css" />
	<script type="text/javascript" src="/js/jquery/jquery.js"></script>
	<link rel="stylesheet" href="/css/normalize.min.css">

	<link rel="stylesheet" href="/css/bootstrap.min.css">
	<script src="/js/bootstrap.min.js"></script>

	<script src="/js/pace.min.js"></script>
	<link href="/css/animate.css" rel="stylesheet"></script>
	<link href="/css/noty.css" rel="stylesheet"></script>
<script src="/js/noty.min.js" type="text/javascript"></script>
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
			<noscript>
				 <div class="jsmessage"><p><?php echo __('NoJavaScript')?></p></div>
			 </noscript>

			 <nav class="navbar navbar-default navbar-fixed-top navbar-static-top">
   <div class="container-fluid">
     <div class="navbar-header">
       <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1">
         <span class="sr-only">Toggle navigation</span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
         <span class="icon-bar"></span>
       </button>
       <a class="navbar-brand" href="/">
<img src="/img/NICApagos.gif" width="133" alt="NicaPagos.com Facil y Seguro" border="0"/>
			 </a>
     </div>

		 <?php
		 if ($session -> check('User.UserID')) {
			 echo $this->element('langswitch');
		 	echo '<span class="welcome navbar-right"><b>', __('Welcome'), ' ', $session -> read('User.FullName'), '</b>';
			echo '</span>';

		 	//echo '</div>';
		 } else {
		 	echo $this->element('toplogin');
		 }
		 ?>


		 <?php if($this->request->here() != $session->read('Company.PayURL')){?>
		 <ul class="nav navbar-nav nav-pills" style="margin-top:1%;">
		 <?php
		 if ($session -> check('User.UserID')) {
		 echo $this -> element('menu');
		 } else {
		 echo $this -> element('publicmenu');
		 }
		 ?>
		 </ul>

		 <?php } ?>
   </div>
 </nav>
			<div class="container-fluid contentwrap">

				<div class="row" style="min-height:50%;">
          <?= $this->Flash->render() ?>
					<?php
					/*if ($session -> flash() != "") {
						echo $session -> flash();
					}*/
					if($this->request->here() == $session->read('Company.CurrentURL')){
						echo '<div style="float:right">';
						//include VIEWS.'elements'.DS.'companyselect.ctp' ;
						 echo $this -> element('companyselect');
						echo '</div>';
					}
					//echo $content_for_layout;
						?><div class="col-md-12" style="margin-top:8%;">
              <?= $this->fetch('content') ?>
						</div>
				</div>
			</div>
			<div class="container-fluid line"></div>
			<div class="container-fluid bottom">
			<?php if($this->request->here() != $session->read('Company.PayURL')){?>
			<?php
				if ($this->request->here() == '/') {
					echo $this->element('bottomhome');
				}
				echo $this ->element('bottommenu');
			?>
			</div>
			<?php } ?>
	</body>
</html>
