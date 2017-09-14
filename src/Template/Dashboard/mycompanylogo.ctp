<?php
$session = $this->request->session();
?>
<div class="panel panel-primary animated pulse">
  <div class="panel-heading">
    <i class="fa fa-child fa-fw"></i> <?= __('Logo').' '.$session->read('Company.CurrentName') ?>
  </div>
  <div class="panel-body">
    <div class="indexAttContainer">
</div>
        <!-- Nav tabs -->
        <form class="form-horizontal style-form" action="/acompany/savelogo" id="LogoAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
          <fieldset>
        		<legend><?= __('AddLogo') ?></legend>
        		<center>
        		<img id="previewModelPic" src="<?= $_SESSION['Company']['CurrentLogo']?>" class='img-polaroid'/>
        <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-primary"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
              <span class="sr-only">45% Complete</span>
            </div>
          </div>
        		</center>
        	<input type="hidden" name="CompanyID" class="form-control" value="<?= $_SESSION['Company']['CurrentCompanyID']?>" id="CompanyID"/>
          <div class="form-group required">
            <label for="AttachmentAttachment" class="col col-md-3 control-label"><?= __('Logo') ?></label>
            <div class="col col-md-9 required">
              <input type="file" name="photo" accept="image/*" class="form-control" id="AttachmentAttachment" required="required"/>
            </div>
          </div>
          </fieldset>
        <div class="submit">
          <button type="reset" class="btn btn-warning"> Reset</button>
          <button  class="btn btn-success" type="submit"><i class="fa fa-save"></i> <?= __('Save') ?></button>
        </div>

      </form>
        <!-- Tab panes -->
</div>
<!-- /.panel-body -->
</div>
<!-- Modal -->
<script type="text/javascript">
	$(document).ready(function(){
		var bar = $('.bar');
		var status = $('.progress');
   		status.hide();
   		//$('#previewModelPic').hide();

   		$("#AttachmentAttachment").change(function(){
        	if (this.files && this.files[0]) {
            	var reader = new FileReader();
            	reader.onload = function (e) {
                	$('#previewModelPic').attr('src', e.target.result);
                	$('#previewModelPic').show();
            	}
            	reader.readAsDataURL(this.files[0]);
        	}
    	});

   	 $("#LogoAddForm").on("reset",function(){
   		$('#previewModelPic').hide();
   	});

   	$("#LogoAddForm").ajaxForm({
    	beforeSend: function() {
        	status.show();
        	var percentVal = '0%';
        	bar.css("width",percentVal);
    	},
    	uploadProgress: function(event, position, total, percentComplete) {
        	var percentVal = percentComplete + '%';
        	bar.css("width",percentVal);
    	},
      error:function(evt){
//con>>
      },
    	success: function(dat) {
        var data = dat.__serialize;
			CRContactos_Manager.check_errors(data);
			if(data.invalid_form == 1){
				status.hide();
				$("#LogoAddForm")[0].reset();
			}
			if(data.is_success == 1){
        new Noty({
            text: "<?= __('LogoAdded')?>",
            type:'alert',
            timeout:4000,
              layout:'top',
            animation: {
                open: 'animated bounceInLeft',
                close: 'animated bounceOutLeft',
            }
        }).show();
				var percentVal = '100%';
        bar.css("width",percentVal);
        setTimeout(function(){ window.location.href = "#/MyCompany/"; }, 3000);
			}
    	},
		dataType:'JSON',
    type:"POST",
    url:"/acompany/savelogo"
	});


	});
</script>
