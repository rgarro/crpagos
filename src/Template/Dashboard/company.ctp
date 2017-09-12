<?php
use Cake\Core\Configure;

$session = $this->request->session();
$this->pageTitle= __('Invoices').' '.$session->read('Company.CurrentName');

$newFormTitle= __('AddNewInvoiceFor').' '.$session->read('Company.CurrentName');
?>
<div class="panel panel-primary animated pulse">
                        <div class="panel-heading">
<i class="fa fa-file-o fa-fw"></i>  <?= $this->pageTitle ?>
                        </div>
                        <div class="panel-body">
                              <!-- Nav tabs -->
        <ul class="nav nav-tabs invoiceTabs">
            <li class="active"><a href="#pendinglist" ilist="Pending" data-toggle="tab" aria-expanded="true"><i class="fa fa-clock-o fa-fw"></i> <?= __('Pending') ?></a>
            </li>
            <li><a href="#sentlist" ilist="Sent" data-toggle="tab" aria-expanded="true"><i class="fa fa-truck fa-fw"></i> <?= __('Sent') ?></a></li>
              <li><a href="#paidlist" ilist="Paid" data-toggle="tab" aria-expanded="true"><i class="fa fa-money fa-fw"></i> <?= __('Paid') ?></a></li>
                <li><a href="#paidManuallylist" ilist="PaidManually" data-toggle="tab" aria-expanded="true"><i class="fa fa-hand-o-right fa-fw"></i> <?= __('PaidManually') ?></a></li>
    <li><a href="#voidlist" ilist="Void" data-toggle="tab" aria-expanded="true"><i class="fa fa-fire-extinguisher fa-fw"></i> <?= __('Void') ?></a></li>
            <li class=""><a href="#addnew" data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square fa-fw"></i> <?= __('AddNewInvoice') ?></a>
            </li>
        </ul>
                              <!-- Tab panes -->
                              <div class="tab-content">
                                  <div class="tab-pane fade active in" id="pendinglist">
                                    <h4><i class="fa fa-clock-o fa-fw"></i> <?= __('Pending') ?></h4>
<div id="pendingInvoicesListContainer">

</div>

                                  </div>
                                  <div class="tab-pane fade" id="sentlist">
                                    <h4>  <i class="fa fa-truck fa-fw"></i> <?= __('Sent') ?></h4>
                                      <div id="sentInvoicesListContainer">

                                      </div>
                                  </div>
                                  <div class="tab-pane fade" id="paidlist">
                                    <h4>  <i class="fa fa-money fa-fw"></i> <?= __('Paid') ?></h4>
                                      <div id="paidInvoicesListContainer">

                                      </div>
                                  </div>
                                  <div class="tab-pane fade" id="paidManuallylist">
                                    <h4><i class="fa fa-hand-o-right fa-fw"></i> <?= __('PaidManually') ?></a></h4>
                                      <div id="paidManuallyInvoicesListContainer">

                                      </div>
                                  </div>
                                  <div class="tab-pane fade" id="voidlist">
                                    <h4><i class="fa fa-fire-extinguisher fa-fw"></i> <?= __('Void') ?></a></h4>
                                      <div id="voidInvoicesListContainer">

                                      </div>
                                  </div>
                                  <div class="tab-pane fade" id="addnew">
                                      <h4><i class="fa fa-plus"></i> </h4>
<div id="newFormContainer"></div>
<?php
//echo $this->element('Admin/newinvoice');
?>
                                  </div>
                              </div>
                          </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="invoiceEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-money"></i> <?php echo __('InvoiceRequestFrom') ?></h4>
                                </div>
                                <div class="modal-body invoice-edit-form-spot">
                                    ...
                                </div>

                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
<script>
    $(document).ready(function(){

<?php
if(isset($_SESSION['is_invoice']) && $_SESSION['is_invoice'] == 1){
  ?>
$(".invoiceTabs a:last").tab("show");
<?php
  $_SESSION['is_invoice'] = 0;
}
?>

$('.invoiceTabs a:last').on('shown.bs.tab', function (e) {
  $.ajax({
    url:"/acompany/newinvoicev",
    type:"GET",
    success:function(data){
      CRContactos_Manager.check_errors(data);
      $("#newFormContainer").html(data);
    }
  });
});

$('.invoiceTabs a:last').on('hidden.bs.tab', function (e) {
  $("#newFormContainer").html(" ");
});

  var cia = new company();
  cia.loadPendingInvoicesList(<?= $session->read('Company.CurrentCompanyID')?>);
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var s = createjs.Sound.play(tingSnd);
    s.volume = 0.05;
  var ilist = $(e.target).attr("ilist") // activated tab
  switch(ilist){
    case "Pending":
      cia.loadPendingInvoicesList(<?= $session->read('Company.CurrentCompanyID')?>);
      break;
    case "Sent":
        cia.loadSentInvoicesList(<?= $session->read('Company.CurrentCompanyID')?>);
        break;
    case "Paid":
        cia.loadPaidInvoicesList(<?= $session->read('Company.CurrentCompanyID')?>);
    break;
    case "PaidManually":
        cia.loadPaidManuallyInvoicesList(<?= $session->read('Company.CurrentCompanyID')?>);
    break;
    case "Void":
        cia.loadVoidInvoicesList(<?= $session->read('Company.CurrentCompanyID')?>);
    break;
  }
});

$('#invoiceEditModal').on('hidden.bs.modal', function (e) {
  $(".invoice-edit-form-spot").html(" ");
})

$(document).on("click",".edit-invoice-btn",function(){
  $(".invoice-edit-form-spot").html(" ");
  var invoice_id = $(this).attr('invoice_id');
  $.ajax({
    url:"/acompany/editinvoice",
    data:{
      invoice_id:invoice_id
    },
    type:"GET",
    success:function(data){
      CRContactos_Manager.check_errors(data);
      $(".invoice-edit-form-spot").html(data);
      $("#invoiceEditModal").modal("show");
    }
  });
});

});
</script>
