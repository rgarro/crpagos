<?php
$session = $this->request->session();
$this->pageTitle= __('UsersOf', true).' '.$session->read('Company.CurrentName');
?>
<div class="panel panel-primary">
                        <div class="panel-heading">
                          <i class="fa fa-users fa-fw"></i> <?= $this->pageTitle ?>
                        </div>
                        <div class="panel-body">
                              <!-- Nav tabs -->
                              <ul class="nav nav-tabs">
                                  <li class="active"><a href="#list" data-toggle="tab" aria-expanded="true"><i class="fa fa-th-list fa-fw"></i> <?= $this->pageTitle ?></a>
                                  </li>
                                  <li class=""><a href="#addnew" data-toggle="tab" aria-expanded="false"><?= __('AddNewUser') ?></a>
                                  </li>
                              </ul>

                              <!-- Tab panes -->
                              <div class="tab-content">
                                  <div class="tab-pane fade active in" id="list">
<div id="usersListContainer">
</div>
                                  </div>
                                  <div class="tab-pane fade" id="addnew">
                                      <h4>New</h4>

                                  </div>
                              </div>
                          </div>
                        <!-- /.panel-body -->
                    </div>
                    <!-- Modal -->
                    <div class="modal fade" id="userEditModal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
                        <div class="modal-dialog modal-lg">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
                                    <h4 class="modal-title" id="myModalLabel"><i class="fa fa-edit"></i><?php echo __("EditUser")?></h4>
                                </div>
                                <div class="modal-body user-edit-form-spot">
                                    ...
                                </div>
                                <div class="modal-footer">
                                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                </div>
                            </div>
                            <!-- /.modal-content -->
                        </div>
                        <!-- /.modal-dialog -->
                    </div>
                    <!-- /.modal -->
<script>
    $(document).ready(function(){
  var userf = new users();
  userf.loadList(<?= $session->read('Company.CurrentCompanyID')?>);

  $(document).on("click",".edit-user-btn",function(){
    var user_id = $(this).attr("user_id");
    $("#userEditModal").modal("show");
//console.log(client_id);
  });

  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var s = createjs.Sound.play(tingSnd);
    s.volume = 0.05;
  });

});
</script>
