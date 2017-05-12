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
<div class="panel panel-primary">
    <div class="panel-heading">
      <i class="fa fa-building fa-fw"></i> <?= $this->pageTitle ?>
    </div>
    <div class="panel-body">
<?php
//print_r($company);
?>
<form class="form-horizontal" method="post" id="TheForm" name="TheForm" enctype="multipart/form-data">
	<input type="hidden" name="CompanyID" value="<?= $company['CompanyID'] ?>"/>
	<div class="form-group">
    <label for="LocaleCode" class="col-sm-2 control-label"><?php echo __('DefaultLanguage') ?></label>
    <div class="col-sm-10">
				<select class="form-control" name="LocaleCode" id="LocaleCode">
					<?= $localeSelOpt ?>
						<option value="eng_us">English</option>
						<option value="spa_cr" selected="">Español</option>
					</select>
    </div>
	</div>
	<div class="form-group">
    <label for="LocaleCode" class="col-sm-2 control-label"><?php echo __('CompanyName') ?></label>
    <div class="col-sm-10">
				<input name="CompanyName" type="text" class="form-control" value="<?= $company['CompanyName'] ?>" placeholder="Email">
    </div>
	</div>
</form>
    </div>
    <!-- /.panel-body -->
</div>
