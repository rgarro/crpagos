var users = (function(){
  function clientes(){
    this.listUrl = "/ausers/index";
    this.listContainer = "#usersListContainer";
  }

  users.prototype.loadList = function(company_id){
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

  return users;
})();
