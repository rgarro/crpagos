var clientes = (function(){
  function clientes(){
    this.listUrl = "/aclients/index";
    this.listContainer = "#clientsListContainer";
    this.editUrl = "/aclients/editview";
    this.editContainer = ".client-edit-form-spot";
  }

  clientes.prototype.loadList = function(company_id){
    $.ajax({
      url:this.listUrl,
      data:{
        company_id:company_id
      },
      type:"GET",
      success:(function(data){
        CRContactos_Manager.check_errors(data);
        $(this.listContainer).html(data);

      }).bind(this)
    });
  }

  return clientes;
})();
