$(document).ready(function(){
	$("#StatusID").change(function(){
		if($("#StatusID").attr("value")== 4){
			$("#RefNumber").show();
		}else{
			$("#RefNumber").hide();
		}
	})
	$(".commentslink").click(function () {
      if ($(".comments").is(":hidden")) {
        $(".showcomments").fadeOut("slow")
			$(".comments").slideDown("slow", function(){
				$(".hidecomments").fadeIn("slow")	
			});
		 
      } else {
		$(".hidecomments").fadeOut("slow")
	  	$(".comments").slideUp("slow", function(){	
			$(".showcomments").fadeIn("slow");			
		});

      }
	  return false
    });
		var validator2 = $("#TheForm").validate({
		rules: {
			RefNumber: "required",
			Comment:{
				minlength: 10,
			    required: true
			},
			Note: {
				minlength: 10,
			    required: true
			}
		},
		messages: {
			RefNumber: "<br>Por favor, ingrese el numero de Referencia que certifica este pago.", 
			Comment:{
				minlength: "Por favor sea m&aacute;s espec&iacute;fico",
				required: "Por favor escriba la raz&oacute;n del pago por otro medio."
				} ,
			Note:{
				minlength: "Por favor sea m&aacute;s espec&iacute;fico",
				required: "Por favor escriba la raz&oacute;n del pago por otro medio para el cliente"
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
		submitHandler: function() {
			if(confirm("Esta seguro que desea Pagar Manualmente esta solicitud?")){
				document.getElementById('TheForm').submit()
			}
			
		},
// set this class to error-labels to indicate valid fields
		success: function(label) {
			// set &nbsp; as text for IE
			label.html("&nbsp;").addClass("checked");
		}
	});
	
	
});