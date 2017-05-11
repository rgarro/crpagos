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
      <td><?= ($c['UserStatus']? __('Active') : __('InActive')) ?></td>
     <td><?= $c['AccessLevels']['AccessLevel'] ?></td>
     <td><?= $c['FirstName'] ?></td>
     <td><?= $c['LastName'] ?></td>
       <td><?= $c['Email'] ?></td>
       <td><button user_id="<?= $c['UserID'] ?>" class="btn btn-xs btn-outline btn-default edit-user-btn"><i class="fa fa-pencil"></i> <?= __('EditUser') ?></button></td>
   </tr>
<?php
}
?>
  </tbody>
                             </table>
<script>
    $(document).ready(function() {
        $('#dataTables-Users').DataTable({
            responsive: true
        });
    });
</script>
