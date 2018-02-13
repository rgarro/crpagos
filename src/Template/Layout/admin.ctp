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
    <?php echo $this->element('Admin/jsfiles'); ?>
</head>
<body>

    <div id="wrapper">

        <!-- Navigation -->
        <nav class="navbar navbar-default navbar-static-top" style='background-image: url("/img/nicabg.png");background-repeat: no-repeat;' role="navigation" style="margin-bottom: 0">
            <div class="navbar-header">
                <button type="button" class="navbar-toggle" data-toggle="collapse" data-target=".navbar-collapse">
                    <span class="sr-only">Toggle navigation</span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                    <span class="icon-bar"></span>
                </button>
                <div class="tituloBrandNav" > <i class="fa fa-credit-card"></i> NicaPagos
                  <!--<img src="/img/NICApagos.gif" width="130" class="img-responsive">-->
                </div>
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
