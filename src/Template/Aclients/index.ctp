<?php
$session = $this->request->session();
?>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-Clients">
                                 <thead>
                                     <tr>
                                         <th><?= __('ClientName') ?></th>
                                         <th><i class="fa fa-envelope-o"></i> <?= __('Email') ?></th>
                                         <th><i class="fa fa-phone"></i> <?= __('Phone') ?></th>
                                         <th class="center"><i class="fa fa-gears"></i> </th>
                                     </tr>
                                 </thead>
                                 <tbody>
<?php
foreach ($clients as $c) {
?>
                                     <tr class="">
                                         <td><?= $c['ClientName']." ".$c['ClientLastName']?></td>
                                         <td><a href="<?= $c['Email'] ?>"><?= $c['Email'] ?></a></td>
                                         <td><?= $c['Phone'] ?></td>
                                         <td class="center"><button client_id="<?= $c['ClientID'] ?>" class="btn btn-xs btn-outline btn-default edit-client-btn"><i class="fa fa-pencil"></i> <?= __('EditClient') ?></button></td>

                                     </tr>
<?php
}
?>
                                 </tbody>
                             </table>
<script>
    $(document).ready(function() {
        $('#dataTables-Clients').DataTable({
            responsive: true
        });
    });
</script>
