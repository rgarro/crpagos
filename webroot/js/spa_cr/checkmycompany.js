$(document).ready(function() {
	var validator = $("#TheForm").validate({
		rules: {
			LocaleCode: "required",
			CompanyName: "required",
			Email: {
				required: true,
				email: true
			}
		},
		messages: {
			FirstName: "<br>Por seleccione el idioma predeterminado.",
			LastName: "<br>Por favor escriba el nombre de la compa&ntilde;&iacute;a.",
			Email: {
				required: "<br>Por favor escriba el Email de la compa&ntilde;&iacute;a..",	
				email: "<br>Ecr&iacute;balo en el formato &ldquo;info@compa&ntilde;&iacute;a.com.&rdquo;"
				}
		},
	// the errorPlacement has to take the table layout into account
		errorPlacement: function(error, element) {
			if ( element.is(":radio") )
				error.appendTo( element.parent().next().next() );
			else if ( element.is(":checkbox") )
				error.appendTo ( element.next() );
			else
				error.appendTo(element.parent());
				element.addClass("error")
		},
// specifying a submitHandler prevents the default submit, good for the demo
//		submitHandler: function() {
//				return false
//		},
// set this class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		}
	});
});