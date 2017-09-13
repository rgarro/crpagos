<?php
$session = $this->request->session();
?>
<div class="panel panel-primary animated pulse">
  <div class="panel-heading">
    <i class="fa fa-child fa-fw"></i> <?= __('Logo').' '.$session->read('Company.CurrentName') ?>
  </div>
  <div class="panel-body">
        <!-- Nav tabs -->
        <form class="form-horizontal style-form" id="LogoAddForm" enctype="multipart/form-data" method="post" accept-charset="utf-8">
          <fieldset>
        		<legend><?= __('AddLogo') ?></legend>
        		<center>
        		<img id="previewModelPic" src="/attachment.jpg" class='img-polaroid'/>
        <div class="progress progress-striped active">
            <div class="progress-bar progress-bar-primary"  role="progressbar" aria-valuenow="45" aria-valuemin="0" aria-valuemax="100" style="width: 45%">
              <span class="sr-only">45% Complete</span>
            </div>
          </div>
        		</center>
        	<input type="hidden" name="data[Attachment][model]" class="form-control" value="Evento" id="AttachmentModel"/>
          <input type="hidden" name="data[Attachment][foreign_key]" class="form-control" value="7" id="AttachmentForeignKey"/>
          <div class="form-group required"><label for="AttachmentAttachment" class="col col-md-3 control-label"><?= __('Logo') ?></label>
            <div class="col col-md-9 required"><input type="file" name="data[Attachment][attachment]"  class="form-control" id="AttachmentAttachment" required="required"/></div></div>
            <input type="hidden" name="data[Attachment][dir]" class="form-control" id="AttachmentDir"/>
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
