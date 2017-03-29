/**
 * @author kchanto
 */
$(document).ready(function(){
	$("#Pay").mouseover(function(){
		$("#Pay").attr("src", "/img/pagar_over.gif")
	})
	$("#Pay").mouseout (function(){
		$("#Pay").attr("src", "/img/pagar.gif")
	})
	
	$("#TheForm").submit(function(){
		if($('#CCHolder').val() == ''){
			alert('Por favor ingrese el Tarjetahabiente')
			$('#CCHolder').focus();
			return false;
		}
		if($('#CCNumber').val() == ''){
			alert('Por favor ingrese el numero de tarjeta')
			$('#CCNumber').focus();
			return false;
		}
		
		if($('#CVV').val() == ''){
			alert('Por favor ingrese su Card Verification Value')
			$('#CVV').focus();
			return false;
		}
		
		if($('#CCExp').val() == ''){
			alert('Por favor seleccione la fecha de expiracion de la tarjeta')
			$('#CCExp').focus();
			return false;
		}
		
		if($("#CheckTC").attr("checked") == false){
			alert('Ud debe acepotar los Terminos y Condiciones'); 
			$("#CheckTC").focus();
			return false;
		}
		
		$("#dialog").dialog("open");
	})

	$("a").click(function(){
		$.nyroModalSettings({
			height: $(document).height()-100,
			width: $(document).width()-50
		});	
	});

  $("#CVVC").click(function(){
    $.nyroModalSettings({
      height:350,
      width: 600
    }); 
  })
	
	function preloadImg(image) {
		var img = new Image();
		img.src = image;
	}
	preloadImg('/img/pagar.gif');
	preloadImg('/img/pagar_over.gif');

});