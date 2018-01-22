var clientes = (function(){
  function clientes(){
    this.listUrl = "/aclients/index";
    this.listContainer = "#clientsListContainer";
    this.ciaListContainer = "#companiesListContainer"
    this.editUrl = "/aclients/editview";
    this.editContainer = ".client-edit-form-spot";
    this.ciaListUrl = "/aclients/companiesindex";
    this.companyEditContainer = "#companyEditContainer";
    this.companyEditUrl = "/aclients/companyeditview";
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

  clientes.prototype.loadCiaList = function(company_id){
    $.ajax({
      url:this.ciaListUrl,
      data:{
        company_id:company_id
      },
      type:"GET",
      success:(function(data){
        CRContactos_Manager.check_errors(data);
        $(this.ciaListContainer).html(data);

      }).bind(this)
    });
  }

  return clientes;
})();
