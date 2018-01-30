<?php
$session = $this->request->session();
?>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-ClientsCias">
                                 <thead>
                                     <tr>
                                         <th><?= __('Company') ?></th>
                                         <th><i class="fa fa-envelope-o"></i> <?= __('Email') ?></th>
                                         <th><i class="fa fa-phone"></i> <?= __('ReplyTo') ?></th>
                                         <th class="center"><i class="fa fa-gears"></i> </th>
                                     </tr>
                                 </thead>
                                 <tbody>
<?php
foreach ($companies as $c) {
?>
                                     <tr class="">
                                         <td><?= $c['CompanyName']?></td>
                                         <td><a href="mailto:<?= $c['Email'] ?>"><?= $c['Email'] ?></a></td>
                                         <td><?= $c['ReplyTo'] ?></td>
                                         <td class="center">
                      <button company_id="<?= $c['CompanyID']?>" class="btn btn-xs btn-outline btn-default edit-company-btn"><i class="fa fa-pencil"></i> <?= __('EditCompany') ?></button>
                    </td>

                                     </tr>
<?php
}
?>
                                 </tbody>
                             </table>
<script>
    $(document).ready(function() {
        $('#dataTables-ClientsCias').DataTable({
            responsive: true,
            language: {
              decimal:        "",
              emptyTable:     "No data available in table",
              info:           "<?= __('Showing') ?> _START_ <?= __('to') ?> _END_ <?= __('of') ?> _TOTAL_ <?= __('entries') ?>",
              infoEmpty:      "Showing 0 <?= __('to') ?> 0 <?= __('of') ?> 0 <?= __('entries') ?>",
              infoFiltered:   "(<?= __('filtered from') ?> _MAX_ total <?= __('entries') ?>)",
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
