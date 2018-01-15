<?php
$session = $this->request->session();
?>
<form class="form-horizontal" method="post" id="myNewClientForm" name="TheNewForm" enctype="multipart/form-data">
  <input type="hidden" name="CompanyID" value="<?= $session->read('Company.CurrentCompanyID')?>">
<input type="hidden" name="Processor" value="BNCR"/>
	<div class="form-group">
    <label for="LocaleCode" class="col-sm-2 control-label"><?php echo __('DefaultLanguage') ?></label>
    <div class="col-sm-10">
				<select class="form-control" name="LocaleCode" id="LocaleCode" required="required">
						<option value="eng_us">English</option>
						<option value="spa_cr" selected="">Español</option>
					</select>
    </div>
	</div>
	<div class="form-group">
    <label for="ClientName" class="col-sm-2 control-label"><?php echo __('ClientName') ?></label>
    <div class="col-sm-10">
				<input name="ClientName" type="text" class="form-control" value="" placeholder="Client" required="required">
    </div>
	</div>
	<div class="form-group">
    <label for="Email" class="col-sm-2 control-label"><?php echo __('Email') ?></label>
    <div class="col-sm-10">
				<input name="Email" type="email" class="form-control main-email" value="" placeholder="Email" required="required">
<br>
        <input name="cEmail" type="email" class="form-control confirm-email" value="" placeholder="Confirm Email" required="required">
    </div>
	</div>
	<div class="form-group">
    <label for="TaxID" class="col-sm-2 control-label"><?php echo __('Cedula') ?></label>
    <div class="col-sm-10">
				<input name="CedulaJuridica" type="text" class="form-control" value="" placeholder="CedulaJuridica" required="required">
    </div>
	</div>
	<!-- <div class="form-group">
    <label for="RazonSocial" class="col-sm-2 control-label"><?php echo __('RazonSocial') ?></label>
    <div class="col-sm-10">
				<textarea name="RazonSocial" wrap="soft" class="form-control" rows="3" required="required"></textarea>
    </div>
	</div> -->
	<div class="form-group">
      <label class="col-sm-2 control-label" for="Phone"><?php echo __('Phone') ?></label>
      <div class="col-sm-10">
      <input type="text" class="form-control" name="Phone" tabindex="12" size="30" maxlength="20" value="">
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
	$("#myNewClientForm").on("submit",function(){
    if($('.main-email').val() == $('.confirm-email').val()){
      var cia_datos = $("#myNewClientForm").serializeHash();
  		$.ajax({
  	    url:"/Aclients/save",
  	    data:cia_datos,
  	    type:"GET",
  	    dataType:"json",
  	    success:function(dat){
  	      var data = dat.__serialize;
  //console.log(data);
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
            $("#myNewClientForm")[0].reset();
            var client = new clientes();
            client.loadList(<?= $session->read('Company.CurrentCompanyID')?>);
  	        //loadStage("/dashboard/clients");
  	        //window.location.href = "#/Clients/";
  	      }
  	    }
  	  });
    }else{
      new Noty({
         text: "Emails must be equals",
         type:'error',
         timeout:4000,
           layout:'top',
         animation: {
             open: 'animated bounceInLeft', // Animate.css class names
             close: 'animated bounceOutLeft', // Animate.css class names
         }
     }).show();
    }
		return false;
	});
});
</script>
