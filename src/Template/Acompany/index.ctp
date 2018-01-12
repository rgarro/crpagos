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
    case 4:
      $status_name = "PaidManually";
    break;
    case 5:
      $status_name = "Void";
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
           <th><i class="fa fa-dollar"></i> <?= __('Currency') ?></th>
           <th><i class="fa fa-money"></i> <?= __('Amount') ?></th>
           <th><i class="fa fa-search-plus"></i> <?= __('Description') ?></th>
           <th><i class="fa fa-gears"></i> </th>
       </tr>
   </thead>
   <tbody>
<?php
foreach ($invoices as $c) {
  $Monto = 0;
  $Desc = "";
  foreach($c["Detail"] as $iDet){
    $Monto += $iDet['Amount'];
    $Desc = $Desc.$iDet['Description']." - ".$c['Currency']['CurrencySymbol'].$iDet['Amount']."<br>";
  }
?>
     <tr class="">
         <td><?= $c['Entered'] ?></td>
         <td><?= $c['InvoiceNumber'] ?> </td>
         <td>
           <a href="mailto:<?= $c['Client']['Email']?>"><?= $c['Client']['ClientName']?> <?= $c['Client']['ClientLastName']?></a></td>
           <td>
           <?= $c['Currency']['CurrencyName']?>
            </td>
         <td>
           <?= $c['Currency']['CurrencySymbol']?> <?= $Monto; ?>
          </td>
         <td><?= $Desc;?> </td>
         <td>
           <?php
if($status_id == 3 || $status_id == 4){
           ?>
           <button invoice_id="<?= $c['InvoiceID'] ?>" class="btn btn-xs btn-outline btn-default view-invoice-btn"> <i class="fa fa-search-plus"></i> <?= __('View') ?></button>
<?php
} elseif ($status_id == 2) {
?>
<button invoice_id="<?= $c['InvoiceID'] ?>" class="btn btn-xs btn-outline btn-default view-voidinvoice-btn"> <i class="fa fa-warning"></i> <?= __('ToVoid') ?></button>
<button invoice_id="<?= $c['InvoiceID'] ?>" class="btn btn-xs btn-outline btn-default view-payinvoice-btn"> <i class="fa fa-money"></i> <?= __('Pay') ?></button>
<?php
}elseif ($status_id == 5) {
?>
<button invoice_id="<?= $c['InvoiceID'] ?>" class="btn btn-xs btn-outline btn-default view-invoice-btn"> <i class="fa fa-search-plus"></i> <?= __('View') ?></button>
<?php
}else {
  ?>
           <button invoice_id="<?= $c['InvoiceID'] ?>" action="edit" class="btn btn-xs btn-outline btn-default edit-invoice-btn"><i class="fa fa-pencil"></i> <?= __('EditInvoice') ?></button>
<?php } ?>
         </td>

     </tr>
<?php
}
?>
 </tbody>
</table>
<script>
    $(document).ready(function() {

      $('.view-payinvoice-btn').on('click',function(){
        $(".invoice-edit-form-spot").html(" ");
        var invoice_id = $(this).attr('invoice_id');
        $.ajax({
          url:"/acompany/viewpayinvoice",
          data:{
            invoice_id:invoice_id
          },
          type:"GET",
          success:function(data){
            CRContactos_Manager.check_errors(data);
            $(".invoice-edit-form-spot").html(data);
            $("#invoiceEditModal").modal("show");
          }
        });
      });


      $('.view-voidinvoice-btn').on('click',function(){
        $(".invoice-edit-form-spot").html(" ");
        var invoice_id = $(this).attr('invoice_id');
        $.ajax({
          url:"/acompany/viewvoidinvoice",
          data:{
            invoice_id:invoice_id
          },
          type:"GET",
          success:function(data){
            CRContactos_Manager.check_errors(data);
            $(".invoice-edit-form-spot").html(data);
            $("#invoiceEditModal").modal("show");
          }
        });
      });

$('.view-invoice-btn').on('click',function(){
  var invoice_id = $(this).attr('invoice_id');
  $.ajax({
    url:"/acompany/viewinvoice",
    data:{
      invoice_id:invoice_id
    },
    type:"GET",
    success:function(data){
      CRContactos_Manager.check_errors(data);
      $(".invoice-edit-form-spot").html(data);
      $("#invoiceEditModal").modal("show");
    }
  });
});

        $('#dataTables-<?=$status_name?>-Invoices').DataTable({
            responsive: true,
            order: [[ 0, 'desc' ]],
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
