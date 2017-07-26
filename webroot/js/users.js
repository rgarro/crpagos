var users = (function(){
  function users(){
    this.listUrl = "/ausers/index";
    this.listContainer = "#usersListContainer";
    this.editviewUrl = "/ausers/editview";
    this.editviewContainer = ".user-edit-form-spot";
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
