/**
 * Allows you to set an html5 email list handling mechanism to fill an input with csv string
 *
 * <!-- Begin extraMails -->
 * <label for="eENameInput"><i class="fa fa-cc"></i> ExtraEmails</label>
 * <input type="email" class="form-control-sm" size="15" placeholder="u@domain.com" id="extraEmailNewTInput"/>
 * <button id="extraEmailAddBtn" type="button" class="btn btn-outline-primary btn-sm" data-toggle="tooltip" data-placement="right" title="Click to Add Emails"><i class="fa fa-plus"></i></button>
 * <div id="extraEmailsBox" class="form-control">
 * </div>
 * <input type="hidden" name="Client[ExtraEmails]" id="extraEmailNewInput" value=""/>
 * <!-- End extraMails -->
 *
 * @author Rolando <rgarro@gmail.com>
 */
var extraEmails = (function(){

  function extraEmails(){
    //this.parentVars();
    //this.newInput = "#extraEmailNewTInput";
    this.newInput = "extraEmailNewTInput";
    this.hiddenInput = "#extraEmailNewInput";
    this.addBtn = "#extraEmailAddBtn";
    this.delBtn = ".delexmail";
    this.displayBox = "#extraEmailsBox";
    this.emailBoxSrc = "<span class='badge badge-pill badge-warning animated fadeInDown' style='margin-right:3px;'>{{email}} <i data-index='{{index}}' class='fa fa-trash delexmail' style='cursor:pointer;'></i></span>";
    this.emailBoxTpl = Handlebars.compile(this.emailBoxSrc);
    this.emails = [];
  }

  //extraEmails.prototype = Object.create(CRFut.FacturasCR.prototype);
  extraEmails.prototype.constructor = extraEmails;

  extraEmails.prototype.add = function(email){
    if(!this.inList(email)){
      this.emails.push(email);
      this.updateHidden();
      var e_index = this.emails.length - 1;
      this.updateDisplay(email,e_index);
      $("#" + this.newInput).val(" ");
    }
  }

  extraEmails.prototype.remove = function(index){
    this.emails.splice(index,1);
    this.updateHidden();
    this.rebuildDisplay();
  }

  extraEmails.prototype.rebuildDisplay = function(){
    $(this.displayBox).html(" ");
    for(var i =0;i < this.emails.length;i++){
      this.updateDisplay(this.emails[i],i);
    }
  }

  extraEmails.prototype.inList = function(email){
    if(this.emails.indexOf(email) == -1){
      return false;
    }else {
      return true;
    }
  }

  extraEmails.prototype.reset = function(){
    $(this.displayBox).html(" ");
    this.emails = [];
    $(this.hiddenInput).val(" ");
  }

  extraEmails.prototype.updateDisplay = function(email,e_index){
    var params = {email:email,index:e_index};
    var html_badge = this.emailBoxTpl(params);
    $(this.displayBox).append(html_badge);
  }

  extraEmails.prototype.updateHidden = function(){
    var emails_str = this.emails.join(",");
    $(this.hiddenInput).val(emails_str);
  }

  extraEmails.prototype.init = function(){
    //add button listener ...
    //$(this.addBtn).on("click",(function(evt){
    $(document).on("click",this.addBtn,(function(evt){
      var email = $("#" + this.newInput).val();
      if(email.length > 5){
          if(document.getElementById(this.newInput).validity.valid){
            this.add(email);
          }else{
            CRContactos_Manager.alert_error("Email Debe ser Valido");
          }
      }
    }).bind(this));
    //del button listener
    $(document).on("click",this.delBtn,(function(evt){
      var index = $(evt.target).data("index");
      this.remove(index);
    }).bind(this));
  }

  return extraEmails;
})();
