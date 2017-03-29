/**
 * @author kchanto
 */
$(document).ready(function(){
	$("#Pay").mouseover(function(){
		$("#Pay").attr("src", "/img/pay_over.gif")
	})
	$("#Pay").mouseout (function(){
		$("#Pay").attr("src", "/img/pay.gif")
	})
	
	$("#TheForm").submit(function(){
		if($('#CCHolder').val() == ''){
			alert('Please enter Card Holder\'s name')
			$('#CCHolder').focus();
			return false;
		}
		if($('#CCNumber').val() == ''){
			alert('Please enter Credit Card\'s number')
			$('#CCNumber').focus();
			return false;
		}
		
		if($('#CVV').val() == ''){
			alert('Please Enter the Card Verification Value ')
			$('#CVV').focus();
			return false;
		}
		
		if($('#CCExp').val() == ''){
			alert('Please Select the expitarion date')
			$('#CCExp').focus();
			return false;
		}
		
		if($("#CheckTC").attr("checked") == false){
			alert('You Must accept the Terms and Conditions'); 
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
	preloadImg('/img/pay.gif');
	preloadImg('/img/pay_over.gif');

});