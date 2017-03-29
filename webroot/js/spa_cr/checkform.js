$(document).ready(function() {
	var validator = $("#TheForm").validate({
		rules: {
			Name: "required",
			LastName: "required",
			Email: {
				required: true,
				email: true
			},
			Tel1: {
				required: true,
				minlength: 8
			},
			Tel2:{
				minlength: 8
			}
		},
		messages: {
			Name: "<br>Por favor escriba su nombre",
			LastName: "<br>Por escribe sus apellidos",
			Email: {
				required: "<br>Por favor escriba su E-mail",
				email: "<br>Por favor escriba su E-mail como &ldquo;usted@sucompa&ntilde;&oacute;a.com&rdquo;."
			},
			Tel1: {
				required: "<br>Por favor escriba su tel&eacute;fono",
				minlength: "<br>Su tel&eacute;fono debe de tener al menos 8 caracteres"
			},
			Tel2: {
				minlength: "<br>Su tel&eacute;fono debe de tener al menos 8 caracteres"
			},
			// the errorPlacement has to take the table layout into account
			errorPlacement: function(error, element){
				if (element.is(":radio")) 
					error.appendTo(element.parent().next().next());
				else 
					if (element.is(":checkbox")) 
						error.appendTo(element.next());
					else 
						error.appendTo(element.parent());
				element.addClass("error")
			},
			// specifying a submitHandler prevents the default submit, good for the demo
			submitHandler: function(form){
				form.submit()
			},
			// set this class to error-labels to indicate valid fields
			success: function(label){
				// set &nbsp; as text for IE
				label.html("&nbsp;").addClass("checked");
			}
		}
	});
});