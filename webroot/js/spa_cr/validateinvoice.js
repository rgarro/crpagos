$(document).ready(function() {
	$("#LocaleCode").change(function(){
		if ($("#LocaleCode").attr("value") != ''){
			if(confirm('Si cambia el lenguaje ahora, cualquier informacion no salvada se perdera.\nEsta Seguro?'))
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
		ClientID: "<br>Por Favor, seleccione el cliente.",
		CurrencyID: "<br>Por Favor, seleccione el tipo de moneda.",
		InvoiceNumber: "<br>Por Favor, ingrese su n&uacute;mero de factura.",
		LocaleCode: "<br>Por Favor, seleccione el idioma.", 
		InvoiceDate: {
			required: "<br>Por Favor, seleccione la fecha de la factura.",
			date: "<br>El formato de la fecha es inv&aacute;lido"
			},  
		EmailSubject: "<br>Por Favor, escriba el asunto del correo.",
		InvoiceTotal: {
			required: "<br>Por Favor,<br>verifique el monto<br>de la factura.",
			min: "<br>El monto debe<br>de ser mayor que 0."
			},
		Comment:{
			minlength: "Por favor sea m&aacute;s espec&iacute;fico",
			required: "Por favor escriba la razon de la modificaci&oacute;n"
			} ,
		RefNumber:{
				required: "<br> Por favor escriba el n&uacute;mero de referencia para esta solicitud"
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