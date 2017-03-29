$(document).ready(function() {
	$("#LocaleCode").change(function(){
		if ($("#LocaleCode").attr("value") != ''){
			if(confirm('If you change languages, any unsaved information will be lost.\nAre you sure??'))
			window.location.href='?Lang='+$("#LocaleCode").attr("value")
		}	
	})


	var validator2 = $("#TheForm").validate({
		rules: {
			ClientID: "required",
			CurrencyID: "required",
			InvoiceNumber: "required",
			LocaleCode: "required",
			InvoiceDate: {
				required: true,
				date: true
			},
			EmailSubject: "required",
			InvoiceTotal: {
				required: true,
				min: 1
			},
			Comment:{
				minlength: 10,
			    required: "#InvoiceID:filled"
			},
			RefNumber: {
				 required: function(element){
				 	return  $("#StatusID").val() == 4;
				 }
			}
		},
		messages: {
		ClientID: "<br>Please Select the Client.",
		CurrencyID: "<br>Please Select the currency.",
		InvoiceNumber: "<br>Please type your Invoice Number.",
		LocaleCode: "<br>Please Select the language.", 
		InvoiceDate: {
			required: "<br>Please select the Invoice Date.",
			date: "<br>Date format is invalid."
			},  
		EmailSubject: "<br>Please type the email subject.",
		InvoiceTotal: {
			required: "<br>Please verify,<br>the invoice<br>amount.",
			min: "<br>Amount must be<br>greater than 0."
			},
		Comment:{
			minlength: "<br>Please be more specific.",
			required: "<br>Please type this change's reason."
			} ,
		RefNumber:{
				required: "<br>Please type the Reference Number"
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
			form.submit()
		},
// set this class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		}
	});
	
	
});