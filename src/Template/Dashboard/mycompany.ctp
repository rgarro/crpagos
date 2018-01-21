<?php
use Cake\Core\Configure;
if($company['LocaleCode'] == 'spa_cr'){
	$localeSelOpt = "<option value='spa_cr' selected='selected'>Español</option>";
}else{
	$localeSelOpt = "<option value='eng_us' selected='selected'>English</option>";
}
$session = $this->request->session();
$this->pageTitle= $session->read('Company.CurrentName');
?>
  <h4><i class="fa fa-users"></i> <?php echo $this->pageTitle; ?></h4>
<div class="panel panel-primary animated pulse">
    <div class="panel-heading">
      <i class="fa fa-building fa-fw"></i> <?= $this->pageTitle ?>
    </div>
    <div class="panel-body">
<?php
//print_r($company);
?>
<form class="form-horizontal" method="post" id="myCompanyForm" name="TheForm" enctype="multipart/form-data">
	<input type="hidden" name="CompanyID" value="<?= $company['CompanyID'] ?>"/>
	<div class="form-group">
		<div class="col-sm-12"><center>
<img src="<?= $_SESSION['Company']['CurrentLogo']?>" height="50"/>
</center>
		</div>
	</div>
	<div class="form-group">
    <label for="LocaleCode" class="col-sm-2 control-label"><?php echo __('DefaultLanguage') ?></label>
    <div class="col-sm-10">
				<select class="form-control" name="LocaleCode" id="LocaleCode" required="required">
					<?= $localeSelOpt ?>
						<option value="eng_us">English</option>
						<option value="spa_cr" selected="">Español</option>
					</select>
    </div>
	</div>
	<div class="form-group">
    <label for="LocaleCode" class="col-sm-2 control-label"><?php echo __('CompanyName') ?></label>
    <div class="col-sm-10">
				<input name="CompanyName" type="text" class="form-control" value="<?= $company['CompanyName'] ?>" placeholder="Email" required="required">
    </div>
	</div>
	<div class="form-group">
    <label for="Email" class="col-sm-2 control-label"><?php echo __('Email') ?></label>
    <div class="col-sm-10">
				<input name="Email" type="email" class="form-control" value="<?= $company['Email'] ?>" placeholder="Email" required="required">
    </div>
	</div>
	<div class="form-group">
    <label for="TaxID" class="col-sm-2 control-label"><?php echo __('CedulaJuridica') ?></label>
    <div class="col-sm-10">
				<input name="TaxID" type="text" class="form-control" value="<?= $company['TaxID'] ?>" placeholder="TaxID" required="required">
    </div>
	</div>
	<div class="form-group">
    <label for="CompanyInfo" class="col-sm-2 control-label"><?php echo __('CompanyInfo') ?></label>
    <div class="col-sm-10">
				<textarea name="CompanyInfo" wrap="soft" class="form-control" rows="3" required="required"><?= $company['CompanyInfo'] ?></textarea>
    </div>
	</div>
	<div class="form-group">
    <label for="DefaultNote" class="col-sm-2 control-label"><?php echo __('DefaultNote') ?></label>
    <div class="col-sm-10">
				<textarea name="DefaultNote" wrap="soft" class="form-control" rows="3" required="required"><?= $company['DefaultNote'] ?></textarea>
    </div>
	</div>
	<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default"><i class="fa fa-save"></i> <?php echo __('Save') ?></button>
    </div>
  </div>
</form>
    </div>
    <!-- /.panel-body -->
</div>
<script>
$(document).ready(function(){
	$("#myCompanyForm").on("submit",function(){
		var cia_datos = $("#myCompanyForm").serializeHash();
		$.ajax({
	    url:"/acompany/save",
	    data:cia_datos,
	    type:"GET",
	    dataType:"json",
	    success:function(dat){
	      var data = dat.__serialize;
	      CRContactos_Manager.check_errors(data);
	      if(data.is_success == 1){
	        new Noty({
	            text: data.flash,
	            type:'alert',
	            timeout:4000,
	              layout:'top',
	            animation: {
	                open: 'animated bounceInLeft', // Animate.css class names
	                close: 'animated bounceOutLeft', // Animate.css class names
	            }
	        }).show();
	        loadStage("/dashboard/mycompany");
	        //window.location.href = "#/MyCompany/";
					///setTimeout(function(){ window.location.href = "/dashboard"; }, 2000);
	      }
	    }
	  });
		return false;
	});
});
</script>
