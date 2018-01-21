<?php
$session = $this->request->session();
$this->pageTitle= __('ClientsOf').' '.$session->read('Company.CurrentName');
?>
<!-- Modal -->
<div class="modal fade" id="clientEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog modal-lg">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><?php echo __("EditClient")?></h4>
            </div>
            <div class="modal-body client-edit-form-spot">
                ...
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal"> <?php echo __('Close') ?></button>
            </div>
        </div>
        <!-- /.modal-content -->
    </div>
    <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<!-- end edition modal -->
<div class="panel panel-primary animated pulse">
  <div class="panel-heading">
    <i class="fa fa-child fa-fw"></i> <?= __('ClientsOf').' '.$session->read('Company.CurrentName') ?>
  </div>
  <div class="panel-body">
        <!-- Nav tabs -->
        <ul class="nav nav-tabs">
            <li class="active"><a href="#list" data-toggle="tab" aria-expanded="true"><i class="fa fa-th-list fa-fw"></i> <?= $this->pageTitle ?></a>
            </li>
            <li class=""><a href="#cialist" data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square fa-fw"></i> <?= __('Companies') ?></a>
            </li>
            <li class=""><a href="#addnew" data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square fa-fw"></i> <?= __('AddNewClient') ?></a>
            </li>
            <li class=""><a href="#addnewcia" data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square fa-fw"></i> <?= __('AddNewCompany') ?></a>
            </li>
        </ul>

        <!-- Tab panes -->
        <div class="tab-content">
            <div class="tab-pane fade active in" id="list">

<div id="clientsListContainer">

</div></div>
<div class="tab-pane fade" id="cialist">

<div id="companiesListContainer">

</div>
</div>
<div class="tab-pane fade" id="addnew">
    <h4><?= __('AddNewClient') ?></h4>
<?php echo $this->element('Admin/newclient'); ?>
</div>
<div class="tab-pane fade" id="addnewcia">
    <h4><?= __('AddNewCompany') ?></h4>
<?php echo $this->element('Admin/newcompany'); ?>
</div>
</div>

<!-- /.panel-body -->
</div>
<script>
$(document).ready(function(){
  var cliente = new clientes();
  cliente.loadList(<?= $session->read('Company.CurrentCompanyID')?>);
  cliente.loadCiaList(<?= $session->read('Company.CurrentCompanyID')?>);
  $(document).on("click",".edit-client-btn",function(){
    var client_id = $(this).attr("client_id");
    $.ajax({
      url:cliente.editUrl,
      data:{
        client_id:client_id
      },
      type:"GET",
      success:function(data){
        CRContactos_Manager.check_errors(data);
        $(cliente.editContainer).html(data);
        $("#clientEditModal").modal("show");
      }
    });
  });


  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var s = createjs.Sound.play(tingSnd);
    s.volume = 0.05;
  });

});
</script>
