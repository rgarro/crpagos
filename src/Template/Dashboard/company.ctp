<?php
$session = $this->request->session();
?>
<div class="panel panel-primary">
                        <div class="panel-heading">
<i class="fa fa-file-o fa-fw"></i>  <?= __('Invoices') ?>
                        </div>
                        <div class="panel-body">
                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs invoiceTabs">
                                  <li class="active"><a href="#pendinglist" ilist="Pending" data-toggle="tab" aria-expanded="true"><i class="fa fa-clock-o fa-fw"></i> <?= __('Pending') ?></a>
                                  </li>
                                  <li><a href="#sentlist" ilist="Sent" data-toggle="tab" aria-expanded="true"><i class="fa fa-truck fa-fw"></i> <?= __('Sent') ?></a>
                                  </li>
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
                                  <div class="tab-pane fade" id="addnew">
                                      <h4>New</h4>

                                  </div>
                              </div>
                          </div>
                        <!-- /.panel-body -->
                    </div>
<script>
    $(document).ready(function(){
  var cia = new company();
  cia.loadPendingInvoicesList(<?= $session->read('Company.CurrentCompanyID')?>);
  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
  var ilist = $(e.target).attr("ilist") // activated tab
  switch(ilist){
    case "Pending":
      cia.loadPendingInvoicesList(<?= $session->read('Company.CurrentCompanyID')?>);
      break;
    case "Sent":
        cia.loadSentInvoicesList(<?= $session->read('Company.CurrentCompanyID')?>);
        break;
  }
});
});
</script>
