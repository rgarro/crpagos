<?php
$session = $this->request->session();
print_r($user);
?>
<form class="form-horizontal" method="post" id="myEditUserForm" name="myEditUserForm" enctype="multipart/form-data">
  <div class="form-group">
    <label for="ClientName" class="col-sm-2 control-label"><?php echo __('Name') ?></label>
    <div class="col-sm-10">
        <input name="FirstName" type="text" class="form-control" value="" placeholder="Client" required="required">
    </div>
  </div>
</form>
