var company = (function(){
  function company(){
    this.listUrl = "/acompany/index";
    this.pendingInvoicesListContainer = "#pendingInvoicesListContainer";
    this.listContainer = "";
  }

  company.prototype.loadPendingInvoicesList = function(company_id){
    var status_id = 1;//1 Pending 2Sent 3Paid 4PaidManually 5Void 6Deleted
    this.listContainer = this.pendingInvoicesListContainer;
    this.loadInvoicesByCompanyAndStatus(company_id,status_id);
  }


company.prototype.loadInvoicesByCompanyAndStatus = function(company_id,status_id){
  $.ajax({
    url:this.listUrl,
    data:{
      company_id:company_id,
      status_id:status_id
    },
    type:"GET",
    success:(function(data){
      CRContactos_Manager.check_errors(data);
      $(this.listContainer).html(data);

    }).bind(this)
  });
}
  return company;
})();
