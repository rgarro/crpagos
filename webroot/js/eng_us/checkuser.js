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
			UserStatus: "<br>Plese Select the user's Status.",
			AccessLevelID: "<br>Plese Select the user's Access Level ",
			FirstName: "<br>Plese type the user's First Name",
			LastName: "<br>Plese type the user's Last Name",
		Email: {
				required: "<br>Plese type the user's E-mail Name",	
				email: "<br>Plese type it as &ldquo;user@company.com&rdquo;"
				},
		Password: "<br>Plese type the user's Password"
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