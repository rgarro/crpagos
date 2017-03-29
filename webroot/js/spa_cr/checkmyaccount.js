$(document).ready(function() {
	var validator = $("#TheForm").validate({
		rules: {
			FirstName: "required",
			LastName: "required",
			Email: {
				required: true,
				email: true
			},
			Password: {
				minlength: 6
			},
			Password2:{
				minlength: 6,
				equalTo: "#Password"
			}
		},
		messages: {
			FirstName: "<br>Por favor escriba su nombre.",
			LastName: "<br>Por favor escriba su(s) apellido(s).",
			Email: {
				required: "<br>Por favor escriba su Email.",	
				email: "<br>Ecr&iacute;balo en el formato &ldquo;usted@compania.com&rdquo;."
				},
			Password: {
				minlength: "<br>Su clave de de ser de al menos 6 car&aacute;cteres."
				},
			Password2: {
				equalTo: "<br>Sus clasves no son las mismas, favor revise.",
				minlength: "<br>Su clave de de ser de al menos 6 car&aacute;cteres."
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
//			
//		},
// set this class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		}
	});
});