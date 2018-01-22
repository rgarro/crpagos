<?php
$session = $this->request->session();
$lang_label = ($companies['LocaleCode'] == "eng_us" ? "English" : "Español");
?>
<form class="form-horizontal" method="post" id="editCompanyForm" name="editCompanyForm" enctype="multipart/form-data">
<input type="hidden" name="CompanyID" value="<?= $companies['CompanyID'] ?>"/>
<input type="hidden" name="Processor" value="<?= $companies['Processor'] ?>"/>
	<div class="form-group">
    <label for="LocaleCode" class="col-sm-2 control-label"><?php echo __('DefaultLanguage') ?></label>
    <div class="col-sm-10">
				<select class="form-control" name="LocaleCode" id="LocaleCode" required="required">
          <option value="<?= $companies['LocaleCode'] ?>" selected="selected"><?= $lang_label ?></option>
						<option value="eng_us">English</option>
						<option value="spa_cr" selected="">Español</option>
					</select>
    </div>
	</div>
	<div class="form-group">
    <label for="LocaleCode" class="col-sm-2 control-label"><?php echo __('CompanyName') ?></label>
    <div class="col-sm-10">
				<input name="CompanyName" type="text" class="form-control" value="<?= $companies['CompanyName'] ?>" placeholder="CompanyName" required="required">
    </div>
	</div>
	<div class="form-group">
    <label for="Email" class="col-sm-2 control-label"><?php echo __('Email') ?></label>
    <div class="col-sm-10">
				<input name="Email" type="email" class="form-control" value="<?= $companies['Email'] ?>" placeholder="Email" required="required">
    </div>
	</div>
	<div class="form-group">
    <label for="TaxID" class="col-sm-2 control-label"><?php echo __('CedulaJuridica') ?></label>
    <div class="col-sm-10">
				<input name="TaxID" type="text" class="form-control" value="<?= $companies['TaxID'] ?>" placeholder="TaxID" required="required">
    </div>
	</div>
	<div class="form-group">
    <label for="CompanyInfo" class="col-sm-2 control-label"><?php echo __('CompanyInfo') ?></label>
    <div class="col-sm-10">
				<textarea name="CompanyInfo" wrap="soft" class="form-control" rows="3" required="required"><?= $companies['CompanyInfo'] ?></textarea>
    </div>
	</div>
	<div class="form-group">
    <label for="DefaultNote" class="col-sm-2 control-label"><?php echo __('DefaultNote') ?></label>
    <div class="col-sm-10">
				<textarea name="DefaultNote" wrap="soft" class="form-control" rows="3" required="required"><?= $companies['DefaultNote'] ?></textarea>
    </div>
	</div>
	<div class="form-group">
    <div class="col-sm-offset-2 col-sm-10">
      <button type="submit" class="btn btn-default"><i class="fa fa-save"></i> <?php echo __('Save') ?></button>
    </div>
  </div>
</form>
<script>
$(document).ready(function(){
	$("#editCompanyForm").on("submit",function(){
		var cia_datos = $("#editCompanyForm").serializeHash();
//console.log(cia_datos);
		$.ajax({
	    url:"/Acompany/save",
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
          //$("#myNewCompanyForm")[0].reset();
          var client = new clientes();
          client.loadCiaList(<?= $session->read('Company.CurrentCompanyID')?>);
          $("#companyEditModal").modal("hide");
	        //loadStage("/dashboard/clients");
	        //window.location.href = "#/Clients/";
	      }
	    }
	  });
		return false;
	});
});
</script>
