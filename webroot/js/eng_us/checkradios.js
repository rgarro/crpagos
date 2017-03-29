$(document).ready(function(){
	$(".radios").click(function(){
		if(this.checked == true){
			if($(this).parent().parent().hasClass("zalt")){
				$(this).parent().parent().removeClass("zalt")
				$(this).parent().parent().addClass("zalty")
			}
			$(this).parent().parent().addClass("zsel")
		}else{

			$(this).parent().parent().removeClass("zsel")
			if($(this).parent().parent().hasClass("zalty")){
				$(this).parent().parent().removeClass("zalty")
				$(this).parent().parent().addClass("zalt")
			}
		}
	})

	$("#Resend, #Delete").submit(function(){
			var Checked = 'none'
			$(".radios").each(function (i) {
			     if(this.checked == true){
				 	Checked = 'ok'
				 }
     		})
			if(Checked != 'ok'){
				if($(this).attr("id") == "Delete"){
					alert('Please select at least one request to delete.')
				}else{
					alert('Please select at least one request to re-send.')
				 }
				return false;
			}
			return confirm('Are you sure?')
	})
});
