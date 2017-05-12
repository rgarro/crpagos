<?php
  $session = $this->request->session();
  	if(count($session->read('Companies')) > 1){
  ?>
<form class="form-inline">
  <div class="form-group form-group-sm">
  <select id="companySwitchSel" class="form-control" onchange="companyChange(this.options[this.selectedIndex].value);">
    <option value="<?= $session->read('Company.CurrentCompanyID')?>"><?= $session->read('Company.CurrentName')?></option>
<?php
foreach($session->read('Companies') as $AvailCompanies){
  if($session->read('Company.CurrentURL') != $AvailCompanies['CompanyUrl']){
    echo '<option value="',$AvailCompanies['CompanyID'],'">',$AvailCompanies['CompanyName'],'</option>',"\n";
  }
}
?>
</select>
</form>
</form>
<script>
function companyChange(company){
  $.ajax({
    url:"/dashboard/changecompany",
    data:{
      company_id:company
    },
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
        loadStage("/dashboard/index?is_ajax=1");
        window.location.href = "#/Dashboard/";
      }
    }
  });
}
</script>
<?php } ?>
