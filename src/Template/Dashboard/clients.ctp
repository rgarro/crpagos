<?php
$session = $this->request->session();
$this->pageTitle= __('ClientsOf').' '.$session->read('Company.CurrentName');
?>
<div class="panel panel-primary">
                        <div class="panel-heading">
                          <i class="fa fa-child fa-fw"></i> <?= __('ClientsOf').' '.$session->read('Company.CurrentName') ?>
                        </div>
                        <div class="panel-body">
                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs">
                                  <li class="active"><a href="#list" data-toggle="tab" aria-expanded="true"><i class="fa fa-th-list fa-fw"></i> <?= $this->pageTitle ?></a>
                                  </li>
                                  <li class=""><a href="#addnew" data-toggle="tab" aria-expanded="false"><i class="fa fa-plus-square fa-fw"></i> <?= __('AddNewClient') ?></a>
                                  </li>
                              </ul>

                              <!-- Tab panes -->
                              <div class="tab-content">
                                  <div class="tab-pane fade active in" id="list">

<div id="clientsListContainer">

</div>
                                  </div>
                                  <div class="tab-pane fade" id="addnew">
                                      <h4><?= __('New') ?></h4>

                                  </div>
                              </div>
                          </div>
                        <!-- /.panel-body -->
                    </div>
<script>
$(document).ready(function(){
  var cliente = new clientes();
  cliente.loadList(<?= $session->read('Company.CurrentCompanyID')?>);

  $(document).on("click",".edit-client-btn",function(){
    var client_id = $(this).attr("client_id");
//console.log(client_id);
  });

});
</script>
