/**
 * @author kchanto
 */
$(document).ready(function(){
	var validator = $("#TheForm").validate({
		rules: {
			UserStatus: "required",
			AccessLevelID: "required",
			FirstName: "required",
			LastName: "required",
			Email: {
				required: true,
				email: true
			},
			Password: "required"
		},
		messages: {
			UserStatus: "<br>Por Favor, seleccione el estatus del usuario. ",
			AccessLevelID: "<br>Por Favor, seleccione el nivel de acceso del usuario. ",
			FirstName: "<br>Por Favor, ingrese el nombre del usuario. ",
			LastName: "<br>Por Favor, ingrese el o los apellidos del usuario. ",
		Email: {
				required: "<br>Por favor ingrese<br>el E-mail de el usuario.",	
				email: "<br>Por favor ingrese<br>el E-mail en el formato<br>&ldquo;usuario@compania.com&rdquo;"
				},
		Password: "<br>Por Favor, ingrese la clave del usuario."
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