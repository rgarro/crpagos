<!DOCTYPE html>
<html lang="en">

<head>

    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
<meta http-equiv="refresh" content="<?php echo ini_get('session.gc_maxlifetime');?>,url=http://nicapagos.com">
<title>NicaPagos</title>
<script src="/js/vendor/modernizr-2.8.3-respond-1.4.2.min.js"></script>
<link rel="stylesheet" href="/css/mainb.css">

    <!-- Bootstrap Core CSS -->
    <link href="/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
    <!-- MetisMenu CSS -->
    <link href="/vendor/metisMenu/metisMenu.min.css" rel="stylesheet">
    <!-- Custom CSS -->
    <link href="/dist/css/sb-admin-2.css" rel="stylesheet">
    <!-- Morris Charts CSS -->
    <link href="/vendor/morrisjs/morris.css" rel="stylesheet">
    <!-- Custom Fonts -->
    <link href="/vendor/font-awesome/css/font-awesome.min.css" rel="stylesheet" type="text/css">
    <!-- HTML5 Shim and Respond.js IE8 support of HTML5 elements and media queries -->
    <!-- WARNING: Respond.js doesn't work if you view the page via file:// -->
    <!--[if lt IE 9]>
        <script src="https://oss.maxcdn.com/libs/html5shiv/3.7.0/html5shiv.js"></script>
        <script src="https://oss.maxcdn.com/libs/respond.js/1.4.2/respond.min.js"></script>
    <![endif]-->
    <!-- jQuery -->
    <script src="/vendor/jquery/jquery.min.js"></script>
    <!-- Bootstrap Core JavaScript -->
    <script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
    <!-- Metis Menu Plugin JavaScript -->
    <script src="/vendor/metisMenu/metisMenu.min.js"></script>
    <!-- Morris Charts JavaScript -->
    <script src="/vendor/raphael/raphael.min.js"></script>

    <!-- Custom heme JavaScript -->
    <script src="/dist/js/sb-admin-2.js"></script>
    <script src="/js/pace.min.js"></script>
  	<link href="/css/animate.css" rel="stylesheet"></script>
  	<link href="/css/noty.css" rel="stylesheet"></script>
  <script src="/js/noty.min.js"></script>
  <script src="/js/soundjs-0.6.2.min.js"></script>
<script src="/js/jquery.route32.js"></script>
<script src="/js/crcontactos_manager.js"></script>
<script src="/js/custom.js"></script>
</head>

<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <a class="navbar-brand" href="/dashboard"><img src="/img/NICApagos.gif" width="130" class="img-responsive"></a>
            </div>
            <!-- /.navbar-header -->

            <?php echo $this->element('Admin/topnav'); ?>
            <!-- /.navbar-top-links -->

          <?php echo $this->element('Admin/menu'); ?>
            <!-- /.navbar-static-side -->
        </nav>

        <div id="page-wrapper">
          <div class="container-fluid">
            <div class="row">
              <?= $this->Flash->render() ?>
              <div id="content" class="col-md-12" style="padding-top:1%;"> 
                <?= $this->fetch('content') ?>
              </div>
            </div>
          </div>
            <!-- /.row -->
        </div>
        <!-- /#page-wrapper -->
    </div>
    <!-- /#wrapper -->
</body>
</html>
