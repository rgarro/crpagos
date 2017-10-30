<?php
/**
 * Plantilla HTML Emails
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (http://cakefoundation.org)
 * @link          http://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       http://www.opensource.org/licenses/mit-license.php MIT License
 */
?>
<!DOCTYPE html PUBLIC "-//W3C//DTD HTML 4.01//EN">
<html>
<head>
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap.min.css">
  <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.2.0/css/bootstrap-theme.min.css">
    <title><?= $this->fetch('title') ?></title>
</head>
<body>
  <div class="navbar navbar-inverse">
  	<!-- <a class="navbar-brand" href="http://nicapagos.com/dashboard"><img src="http://nicapagos.com/img/NICApagos.gif" class="img-thumbnail" style="margin-top: -10px;"></a> -->

  	</div>
  <div class="container">
  	<?php echo $this->fetch('content'); ?>
  </div>
</body>
</html>
