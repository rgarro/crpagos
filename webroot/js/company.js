var company = (function(){
  function company(){
    this.listUrl = "/acompany/index";
    this.pendingInvoicesListContainer = "#pendingInvoicesListContainer";
    this.sentInvoicesListContainer = "#sentInvoicesListContainer";
    this.paidInvoicesListContainer = "#paidInvoicesListContainer";
    this.paidManuallyInvoicesListContainer = "#paidManuallyInvoicesListContainer";
    this.voidInvoicesListContainer = "#voidInvoicesListContainer";
    this.listContainer = "";
  }

  company.prototype.loadPendingInvoicesList = function(company_id){
    var status_id = 1;//1 Pending 2Sent 3Paid 4PaidManually 5Void 6Deleted
    this.listContainer = this.pendingInvoicesListContainer;
    this.loadInvoicesByCompanyAndStatus(company_id,status_id);
  }


company.prototype.loadSentInvoicesList = function(company_id){
  var status_id = 2;//1 Pending 2Sent 3Paid 4PaidManually 5Void 6Deleted
  this.listContainer = this.sentInvoicesListContainer;
  this.loadInvoicesByCompanyAndStatus(company_id,status_id);
}

company.prototype.loadPaidInvoicesList = function(company_id){
  var status_id = 3;//1 Pending 2Sent 3Paid 4PaidManually 5Void 6Deleted
  this.listContainer = this.paidManuallyInvoicesListContainer;
  this.loadInvoicesByCompanyAndStatus(company_id,status_id);
}

company.prototype.loadPaidManuallyInvoicesList = function(company_id){
  var status_id = 4;//1 Pending 2Sent 3Paid 4PaidManually 5Void 6Deleted
  this.listContainer = this.paidInvoicesListContainer;
  this.loadInvoicesByCompanyAndStatus(company_id,status_id);
}

company.prototype.loadVoidInvoicesList = function(company_id){
  var status_id = 5;//1 Pending 2Sent 3Paid 4PaidManually 5Void 6Deleted
  this.listContainer = this.voidInvoicesListContainer;
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
