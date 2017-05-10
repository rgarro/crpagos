<?php
$session = $this->request->session();
?>
<div class="panel panel-primary">
                        <div class="panel-heading">
<i class="fa fa-file-o fa-fw"></i>  <?= __('Invoices') ?>
                        </div>
                        <div class="panel-body">
                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs">
                                  <li class="active"><a href="#pendinglist" data-toggle="tab" aria-expanded="true"><i class="fa fa-clock-o fa-fw"></i> <?= __('Pending') ?></a>
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
});
</script>
