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
			Name: "<br>Por type your Name",
			LastName: "<br>Por type your Last Name",
			Email: {
				required: "<br>Por type your E-mail",
				email: "<br>Por type your E-mail as &ldquo;you@yourcompany.com&rdquo;."
			},
			Tel1: {
				required: "<br>Please Type your Telephone",
				minlength: "<br>Your Telephone must be at least 8 chacters long."
			},
			Tel2: {
				minlength: "<br>Your Telephone must be at least 8 chacters long."
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