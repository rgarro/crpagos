/**
 * @author kchanto
 */
$(document).ready(function(){
		$("#ClientEditForm").tabs();  
		 
		$("#ClientForm").tabs();   
	
	$("#DeleteClient").click(function(){
		if(this.checked == true){
			if( confirm("Esta seguro que desea eliminar este cliente?")){
				$(this.form).submit()
			}else{
				return false	
			}
		}
	})		

	$("#DeleteCompany").click(function(){
		if(this.checked == true){
			if(confirm("Esta seguro que desea eliminar esta compania?")){
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
		ClientName: "<br>Por Favor, ingrese el nombre del cliente.",
		ClientLastName: "<br>Por Favor, ingrese el apellido del cliente.",
		Email: {
				required: "<br>Por favor ingrese el E-mail de el cliente.",	
				email: "<br>Por favor ingrese el E-mail en el formato<br>&ldquo;cliente@compa&ntilde;ia.com&rdquo;"
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
			$('#QuickSubmitP').attr('value', 'Por favor espere...')
			$('#QuickSubmitP').attr('disabled', true)
			$('#CloseP').attr('disabled', true)
			if($('#ClientID').attr('id') == 'ClientID'){
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
		ClientName: "<br>Por Favor, ingrese el nombre de la empresa.",
		Email: {
				required: "<br>Por favor ingrese el E-mail de el contacto en la empresa.",	
				email: "<br>Por favor ingrese el E-mail en el formato<br>&ldquo;cliente@compania.com&rdquo;"
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
			$('#QuickSubmitB').attr('value', 'Por favor espere...')
			$('#QuickSubmitB').attr('disabled', true)
			$('#CloseB').attr('disabled', true)
			if($('#ClientID').attr('id') == 'ClientID'){
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