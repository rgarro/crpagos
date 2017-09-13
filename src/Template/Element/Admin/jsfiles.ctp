<!-- DataTables CSS -->
<link href="/vendor/datatables-plugins/dataTables.bootstrap.css" rel="stylesheet">
<!-- DataTables Responsive CSS -->
<link href="/vendor/datatables-responsive/dataTables.responsive.css" rel="stylesheet">

<script src="/vendor/jquery/jquery.min.js"></script>

<!-- Bootstrap Core JavaScript -->
<script src="/vendor/bootstrap/js/bootstrap.min.js"></script>
<!-- Metis Menu Plugin JavaScript -->
<script src="/vendor/metisMenu/metisMenu.min.js"></script>
<!-- Morris Charts JavaScript -->
<script src="/vendor/raphael/raphael.min.js"></script>

<!-- DataTables JavaScript -->
<script src="/vendor/datatables/js/jquery.dataTables.min.js"></script>
<script src="/vendor/datatables-plugins/dataTables.bootstrap.min.js"></script>
<script src="/vendor/datatables-responsive/dataTables.responsive.js"></script>
<script type="text/javascript" src="http://malsup.github.com/jquery.form.js"></script>
<!-- Custom Theme JavaScript -->
<script src="/dist/js/sb-admin-2.js"></script>
<script src="/js/pace.min.js"></script>
<link href="/css/animate.css" rel="stylesheet"></script>
<link href="/css/noty.css" rel="stylesheet"></script>
<script src="/js/noty.min.js"></script>
<script src="/js/soundjs-0.6.2.min.js"></script>
<script src="/js/jquery.serialize-hash.js"></script>
<script src="/js/jquery.route32.js"></script>
<script src="/js/crcontactos_manager.js"></script>
<script src="/js/clientes.js"></script>
<script src="/js/company.js"></script>
<script src="/js/users.js"></script>
<script src="/js/custom.js"></script>
<script src="/js/jquery/jquery.tinymce.js"></script>
<?php
$session = $this->request->session();
echo $this->Html-> css("ui");
//	echo $this->Html-> css("tabs","stylesheet", array(), false);
echo $this->Html->script("jquery/jquery.ui");
//echo $this->Html->script("jquery/jquery.form");
echo $this->Html->script("jquery/jquery.addtolist");
echo $this->Html->script("jquery/jquery.cookie");
echo $this->Html->script("jquery/validate");


$TheJs = $session->read('LocaleCode').'/validateinvoice';
echo $this->Html->script($TheJs);
$TheJs1 = $session->read('LocaleCode').'/checkclient';
echo $this->Html->script($TheJs1);
//localized datepiecker
$TheUiJs = 'jquery/ui/i18n/ui.datepicker-'.$session->read('LocaleCode');
echo $this->Html->script($TheUiJs);
