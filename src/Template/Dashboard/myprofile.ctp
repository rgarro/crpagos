<?php
$session = $this->request->session();
?>
<div class="panel panel-primary animated pulse">
  <div class="panel-heading">
    <i class="fa fa-user fa-fw"></i> <?= __('MyProfile') ?> <?= $_SESSION['User']['FullName']?>
  </div>
  <div class="panel-body">
<!-- begin form -->
<?php
$session = $this->request->session();
?>
<!-- begin user form -->
<form class="form-horizontal" method="post" id="myMyUserForm" name="myMyUserForm" enctype="multipart/form-data">
  <input type="hidden" name="UserID" value="<?= $user['UserID']?>"/>
  <input type="hidden" name="ModifiedBy" value="<?= $_SESSION['User']['FullName']?>"/>
<?php
if($session->read('User.AccessLevelID') < 2){
?>
  <div class="form-group">
    <label for="ClientName" class="col-sm-2 control-label"><?php echo __('Name') ?></label>
    <div class="col-sm-10">
        <input name="FirstName" type="text" class="form-control" value="<?= $user['FirstName']?>" placeholder="FirstName" required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="LastName" class="col-sm-2 control-label"><?php echo __('LastName') ?></label>
    <div class="col-sm-10">
        <input name="LastName" type="text" class="form-control" value="<?= $user['LastName']?>" placeholder="LastName" required="required">
    </div>
  </div>
<?php
}
?>
  <div class="form-group">
    <label for="Password" class="col-sm-2 control-label"><?php echo __('Password') ?></label>
    <div class="col-sm-10">
        <input name="Password" type="text" class="form-control" value="<?= $user['Password']?>" placeholder="Password" required="required">
    </div>
  </div>
  <button type="submit" class="btn btn-outline btn-primary"><?php echo __('Save') ?></button>
  <button type="reset" class="btn btn-outline btn-warning"><?php echo __('Reset') ?></button>
</form>
<!-- end user form -->
<script>
    $(document).ready(function(){


  $("#myMyUserForm").on("submit",function(){
    var user_data = $("#myMyUserForm").serializeHash();
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
          loadStage("/dashboard/myprofile");
        }
      }
    });
    return false;
  });

});
</script>

<!-- end form -->
</div>
<!-- /.panel-body -->
</div>
<!-- Modal -->
<script type="text/javascript">
	$(document).ready(function(){

	});
</script>
