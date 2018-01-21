<?php
$session = $this->request->session();
?>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-Users">
 <thead>
     <tr>
         <th><i class="fa fa-umbrella"></i> <?php echo __('Status') ?></th>
         <th><i class="fa fa-key"></i> <?php echo __('AccessLevel') ?></th>
         <th><?php echo __('FirstName') ?></th>
         <th><?php echo __('LastName' )?></th>
         <th><i class="fa fa-envelope-o"></i> <?php echo __('Email') ?></th>
         <th><i class="fa fa-gears"></i> </th>
     </tr>
 </thead>
        <tbody>
<?php
foreach ($users as $c) {
?>
   <tr class="">
      <td>
<?php
$label =  ($c['UserStatus']? __('Active') : __('InActive'));
$value = ($c['UserStatus']? 0 : 1);
$class = ($c['UserStatus']? "btn-success" : "btn-warning");
$icon = ($c['UserStatus']? "star" : "star-o");
?>
<button user_id="<?= $c['UserID'] ?>" status="<?= $value; ?>" class="btn btn-xs btn-outline <?= $class; ?> change-status-user-btn"><i class="fa fa-<?= $icon;?>"></i> </button> <?= $label; ?>
</td>
     <td><?= $c['AccessLevels']['AccessLevel'] ?></td>
     <td><?= $c['FirstName'] ?></td>
     <td><?= $c['LastName'] ?></td>
       <td><?= $c['Email'] ?></td>
       <td>
<button user_id="<?= $c['UserID'] ?>" class="btn btn-xs btn-outline btn-default edit-user-btn"><i class="fa fa-pencil"></i> <?= __('EditUser') ?></button>
<button user_id="<?= $c['UserID'] ?>" class="btn btn-xs btn-outline btn-danger delete-user-btn"><i class="fa fa-window-close"></i> <?= __('DeleteUser') ?></button>
       </td>
   </tr>
<?php
}
?>
  </tbody>
                             </table>
<script>
    $(document).ready(function() {

      $('.change-status-user-btn').on("click",function(){
        if(window.confirm("<?= __('ChangeStatus')?>")){
          var user_id = $(this).attr("user_id");
          var status = $(this).attr("status");
          $.ajax({
            url:"/ausers/save",
            data:{
              UserID:user_id,
              UserStatus:status
            },
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
              }
            }
          });
        }
      });

        $('#dataTables-Users').DataTable({
            responsive: true,
            language: {
              decimal:        "",
              emptyTable:     "No data available in table",
              info:           "<?= __('Showing') ?> _START_ <?= __('to') ?> _END_ <?= __('of') ?> _TOTAL_ <?= __('entries') ?>",
              infoEmpty:      "Showing 0 <?= __('to') ?> 0 <?= __('of') ?> 0 <?= __('entries') ?>",
              infoFiltered:   "(filtered from _MAX_ total entries)",
              infoPostFix:    "",
              thousands:      ",",
              lengthMenu:     "<?= __('Show') ?> _MENU_ <?= __('entries') ?>",
              loadingRecords: "Loading...",
              processing:     "Processing...",
              search:         "<?= __('Search') ?>:",
              zeroRecords:    "No matching records found",
              paginate: {
                  first:      "<?= __('First') ?>",
                  last:       "<?= __('Last') ?>",
                  next:       "<?= __('Next') ?>",
                  previous:   "<?= __('Previous') ?>"
              },
              aria: {
                  sortAscending:  ": activate to sort column ascending",
                  sortDescending: ": activate to sort column descending"
              }
            }
        });
    });
</script>
