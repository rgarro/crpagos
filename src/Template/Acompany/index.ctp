<?php
$session = $this->request->session();
 $status_name = "";
switch ($status_id) {
  case 1:
    $status_name = "Pending";
    break;
    case 2:
      $status_name = "Sent";
      break;
    case 3:
      $status_name = "Paid";
        break;
  default:
    # code...
    break;
}
?>
 <table width="100%" class="table table-striped table-bordered table-hover" id="dataTables-<?=$status_name?>-Invoices">
   <thead>
       <tr>
           <th><i class="fa fa-calendar"></i> <?= __('InvoiceDate') ?></th>
           <th><i class="fa fa-barcode"></i> <?= __('InvoiceNumber') ?></th>
           <th><i class="fa fa-child"></i> <?= __('Client') ?></th>
           <th><i class="fa fa-money"></i> <?= __('Amount') ?></th>
           <th><i class="fa fa-search-plus"></i> <?= __('Description') ?></th>
           <th><i class="fa fa-gears"></i> </th>
       </tr>
   </thead>
   <tbody>
<?php
foreach ($invoices as $c) {
?>
     <tr class="">
         <td><?= $c['InvoiceDate'] ?></td>
         <td> </td>
         <td> </td>
         <td> </td>
         <td> </td>
         <td>
           <button invoice_id="" class="btn btn-xs btn-outline btn-default edit-invoice-btn"><i class="fa fa-pencil"></i> <?= __('EditInvoice') ?></button>
         </td>

     </tr>
<?php
}
?>
 </tbody>
</table>
<script>
    $(document).ready(function() {
        $('#dataTables-<?=$status_name?>-Invoices').DataTable({
            responsive: true
        });
    });
</script>
