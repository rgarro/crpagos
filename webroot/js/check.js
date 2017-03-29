/**
 * @author kchanto
 */
$(document).ready(function() {
	$('#BillToLastName').keyup(function() {
		$('#CCHolder').val($('#BillToFirstName').val() +' '+ $(this).val())
	})

	$("#dialog").dialog({
		bgiframe : true,
		modal : true,
		autoOpen : false,
		closeOnEscape : false,
		show : 'blind',
		hide : 'blind',
		speed : 'slow'
	});


	function isCreditCard(st) {
		if(st.length > 19)
			return (false);
		sum = 0;
		mul = 1;
		l = st.length;
		for( i = 0; i < l; i++) {
			digit = st.substring(l - i - 1, l - i);
			tproduct = parseInt(digit, 10) * mul;
			if(tproduct >= 10)
				sum += (tproduct % 10) + 1;
			else
				sum += tproduct;
			if(mul == 1)
				mul++;
			else
				mul--;
		}
		if((sum % 10) == 0)
			return (true);
		else
			return (false);
	}


	$('#CCNumber').blur(function() {
		if(!isCreditCard(this.value)) {
			alert($('#InvalidCCCard').val())
			$(this).select().focus()
			return false
		}
	})

	$('#CCNumber').keyup(function() {
		//Allow only numbers
		this.value = this.value.replace(/[^0-9\.]/g, '');

		if(this.value.length > 13) {
			var cc = this.value

			if(isCreditCard(cc)) {
				//check visa
				if(((cc.length == 16) || (cc.length == 13)) && (cc.substring(0, 1) == 4)) {
					$('#visa').css('opacity', 1);
					return true;
				}
				//check MC
				firstdig = cc.substring(0, 1);
				seconddig = cc.substring(1, 2);
				if((cc.length == 16) && (firstdig == 5) && ((seconddig >= 1) && (seconddig <= 5))) {
					$('#mastercard').css('opacity', 1);
					return true;
				}
				//Amex
				if((cc.length == 15) && (firstdig == 3) && ((seconddig == 4) || (seconddig == 7))) {
					$('#amex').css('opacity', 1);
					$(this).attr('maxlength', 15)
					return true;
				}
				//Discover
				first4digs = cc.substring(0, 4);
				if((cc.length == 16) && (first4digs == "6011")) {
					$('#discover').css('opacity', 1);
					return true;
				}
				//Jcb
				if((cc.length == 16) && (firstdig == 3) && (seconddig == 5)) {
					$('#jcb').css('opacity', 1);
					$(this).attr('maxlength', 16)
					return true;
				}
				//Dinners
				if((cc.length == 14) && (firstdig == 3) && ((seconddig == 0) || (seconddig == 8))) {
					$('#dinners').css('opacity', 1);
					$(this).attr('maxlength', 14)
					return true;
				}		
				
			}
		} else {
			$('.cards').css('opacity', 0.2)
			$(this).attr('maxlength', 16)
		}
	});


})