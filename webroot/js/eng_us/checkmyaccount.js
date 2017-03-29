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
			FirstName: "<br>Por type your Name",
			LastName: "<br>Por type your Last Name",
			Email: {
				required: "<br>Por type your E-mail",
				email: "<br>Por type your E-mail as &ldquo;you@yourcompany.com&rdquo;."
			},
			Password: {
				minlength: "<br>Your Password must be at least 6 chacters long."
			},
			Password2: {
				equalTo: "<br>Your passwords don't match, please check",
				minlength: "<br>Your Password must be at least 6 chacters long."
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