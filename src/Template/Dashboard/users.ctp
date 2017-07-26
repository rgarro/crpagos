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
                                      <h4>New User</h4>
<!-- begin user form -->
<form class="form-horizontal" method="post" id="newUserForm" name="newUserForm" enctype="multipart/form-data">
  <input type="hidden" name="EnteredBy" value="<?= $_SESSION['User']['FullName']?>"/>
  <div class="form-group">
    <label for="ClientName" class="col-sm-2 control-label"><?php echo __('Name') ?></label>
    <div class="col-sm-10">
        <input name="FirstName" type="text" class="form-control" value="" placeholder="FirstName" required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="LastName" class="col-sm-2 control-label"><?php echo __('LastName') ?></label>
    <div class="col-sm-10">
        <input name="LastName" type="text" class="form-control" value="" placeholder="LastName" required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="Email" class="col-sm-2 control-label"><?php echo __('Email') ?></label>
    <div class="col-sm-10">
        <input name="Email" type="text" class="form-control" value="" placeholder="Email" required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="Password" class="col-sm-2 control-label"><?php echo __('Password') ?></label>
    <div class="col-sm-10">
        <input name="Password" type="text" class="form-control" value="" placeholder="Password" required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="Password" class="col-sm-2 control-label"><?php echo __('AccessLevel') ?></label>
    <div class="col-sm-10">
        <select name="AccessLevelID" class="form-control">
<?php
foreach($alevels as $ac){
?>
<option value="<?= $ac['AccessLevelID']?>"><?= $ac['AccessLevel']?></option>
<?php } ?>
        </select>
    </div>
  </div>
  <button type="submit" class="btn btn-outline btn-primary"><?php echo __('Save') ?></button>
  <button type="reset" class="btn btn-outline btn-warning"><?php echo __('Reset') ?></button>
</form>
<!-- end user form -->
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
    $.ajax({
      url:userf.editviewUrl,
      data:{
        user_id:user_id
      },
      type:"GET",
      success:(function(data){
        CRContactos_Manager.check_errors(data);
        $(userf.editviewContainer).html(data);
        $("#userEditModal").modal("show");
      }).bind(this)
    });
  });

  $('a[data-toggle="tab"]').on('shown.bs.tab', function (e) {
    var s = createjs.Sound.play(tingSnd);
    s.volume = 0.05;
  });

  $("#newUserForm").on("submit",function(){
    var user_data = $("#newUserForm").serializeHash();
    $.ajax({
      url:"/ausers/save",
      data:user_data,
      type:"GET",
      dataType:"json",
      success:function(dat){
        var data = dat.__serialize;
        CRContactos_Manager.check_errors(data);
        if(data.is_success == 1){
          new Noty({
              text: data.flash,
              type:'success',
              timeout:4000,
                layout:'top',
              animation: {
                  open: 'animated bounceInLeft', // Animate.css class names
                  close: 'animated bounceOutLeft', // Animate.css class names
              }
          }).show();
          var userf = new users();
          userf.loadList(<?= $session->read('Company.CurrentCompanyID')?>);
console.log("end here ...");
          $("#newUserForm")[0].reset();
          loadStage("/dashboard/users");
          //$("#clientEditModal").modal("hide");
        }
      }
    });
    return false;
  });

});
</script>
