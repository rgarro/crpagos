<?php
$session = $this->request->session();
?>
<!-- begin user form -->
<form class="form-horizontal" method="post" id="myEditUserForm" name="myEditUserForm" enctype="multipart/form-data">
  <input type="hidden" name="UserID" value="<?= $user['UserID']?>"/>
  <input type="hidden" name="ModifiedBy" value="<?= $_SESSION['User']['FullName']?>"/>
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
  <div class="form-group">
    <label for="Email" class="col-sm-2 control-label"><?php echo __('Email') ?></label>
    <div class="col-sm-10">
        <input name="Email" type="text" class="form-control" value="<?= $user['Email']?>" placeholder="Email" required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="Password" class="col-sm-2 control-label"><?php echo __('Password') ?></label>
    <div class="col-sm-10">
        <input name="Password" type="text" class="form-control" value="<?= $user['Password']?>" placeholder="Password" required="required">
    </div>
  </div>
  <div class="form-group">
    <label for="Password" class="col-sm-2 control-label"><?php echo __('AccessLevel') ?></label>
    <div class="col-sm-10">
        <select name="AccessLevelID" class="form-control">
          <option value="<?= $user['AccessLevels']['AccessLevelID']?>"><?= $user['AccessLevels']['AccessLevel']?></option>
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
<script>
    $(document).ready(function(){


  $("#myEditUserForm").on("submit",function(){
    var user_data = $("#myEditUserForm").serializeHash();
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
          $(userf.editviewContainer).html(" ");
          $("#userEditModal").modal("hide");
        }
      }
    });
    return false;
  });

});
</script>
