/**
 * @author kchanto
 */
$(document).ready(function(){
		$("#ClientEditForm").tabs();  
		 
		$("#ClientForm").tabs();   
	
	$("#DeleteClient").click(function(){
		if(this.checked == true){
			if( confirm("Are you sure you would like to delete this Client?")){
				$(this.form).submit()
			}else{
				return false	
			}
		}
	})		

	$("#DeleteCompany").click(function(){
		if(this.checked == true){
			if(confirm("Are you sure you would like to delete this Company?")){
				$(this.form).submit()
			}else{
				return false	
			}
		}
	})
	
	var validator = $("#TheClientForm").validate({
		rules: {
			ClientName: "required",
			ClientLastName: "required",
			Email: {
				required: true,
				email: true
			}
		},
		messages: {
		ClientName: "<br>Please type the client's Name.",
		ClientLastName: "<br>Please type the client's Last Name.",
		Email: {
				required: "<br>Please type the client's E-mail",	
				email: "<br>Please type the client's E-mail as &ldquo;clent@company.com&rdquo;"
				}
		},
	// the errorPlacement has to take the table layout into account
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.appendTo(element.parent() );
				element.addClass("error")
		},
// specifying a submitHandler prevents the default submit, good for the demo
		submitHandler: function(form) {
			$('#QuickSubmitP').attr('value', 'Please Wait..')
			$('#QuickSubmitP').attr('disabled', true)
			if($('#ClientID').attr('id')){
				$('#ClientID').trigger('TheClientForm-submit')	
			}else{
				form.submit()	
			}
			return false;
		},
// set this class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		}
	});
	
	var validator2 = $("#TheBusForm").validate({
		rules: {
			ClientName: "required",
			Email: {
				required: true,
				email: true
			}
		},
		messages: {
		ClientName: "<br>Please type the Company Name",
		Email: {
				required: "<br>Please type the Company's contact E-mail",	
				email: "<br>Please type the client's E-mail as &ldquo;clent@company.com&rdquo;"
				}
		},
	// the errorPlacement has to take the table layout into account
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.appendTo(element.parent() );
				element.addClass("error")
		},
// specifying a submitHandler prevents the default submit, good for the demo
		submitHandler: function(form) {
			$('#QuickSubmitB').attr('value', 'Please Wait..')
			$('#QuickSubmitB').attr('disabled', true)
			if($('#ClientID').attr('id')){
				$('#ClientID').trigger('TheBusForm-submit')	
			}else{
				form.submit()	
			}
			return false;
		},
// set this class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		}
	});
	

	
	
});