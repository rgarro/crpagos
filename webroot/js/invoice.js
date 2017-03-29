$(document).ready(function() {
	var count = $(".line").length
	$("#AddRow").click(function() {
		NewLine = $("#Line1").clone(true)
		TheNewID = "Line" + count
		NewLine.attr("id", TheNewID)
		NewLine.insertBefore("#LastLine");
		$("#" + TheNewID + " :text").attr("value", "")
		$(NewLine).find("a").show();
		$("#" + TheNewID + " #Qty").focus()
		count++
		return false;
	});

	$("#InvoiceDate").datepicker({
		showOn : "both",
		defaultDate : +1,
		buttonImage : '/img/calendar.gif',
		buttonImageOnly : true,
		dateFormat : "mm/dd/yy"
	})

	$("#StatusID").change(function() {
		if ($("#StatusID").attr("value") == 4) {
			$("#RefNumber").show();
		} else {
			$("#RefNumber").hide();
		}
	})

	$("#FormDetail :text").blur(function() {
		$("tr .line").each(function(i) {
			if ($(this).attr("id") != '') {
				TheVar = "#" + this.id + " input:eq(0)";
				Qty = $(TheVar).attr("value")
				if ((isNaN(Qty) || Qty.length == 0) || Qty < 1) {
					$(TheVar).attr("value", "0")
					Qty = 0
				}
				TheVar = "#" + this.id + " input:eq(2)";
				UnitPrice = $(TheVar).attr("value")
				if (isNaN(UnitPrice) || UnitPrice.length == 0 || UnitPrice < 0) {
					$(TheVar).attr("value", "0")
					UnitPrice = 0
				}
				TheUP = parseFloat(UnitPrice).toFixed(2)
				TheUP = UnitPrice
				$(TheVar).attr("value", TheUP)
				Amount = parseInt(Qty) * parseFloat(UnitPrice)
				Amount = Qty * UnitPrice;
				if (isNaN(Amount)) {
					Amount = 0
				}

				Amount = Amount.toFixed(2)
				TheVar = "#" + this.id + " input:eq(3)";
				$(TheVar).attr("value", Amount)
			}
		})
		var Total = 0
		$(".amount").each(function(i) {
			Total = (parseFloat(Total) + parseFloat(this.value))
		})
		Total = Total.toFixed(2)
		$("#InvoiceTotal").attr("value", Total)
	});

	$("#ClientID").addToList({
		form : '#ClientForm',
		insertPosition : 'first',
		dataHandler : function(data) {
			return {
				value : data.ClientID,
				label : data.ClientName
			}
		}
	});

	$('#ClientID').bind('form-open', function() {
		$('#TheClientForm').clearForm()
		$('#TheBusForm').clearForm()
		$('#TheClientForm label.error').remove()
		$('#TheBusForm label.error').remove()
		$('#TheClientForm *').removeClass("error")
		$('#TheBusForm *').removeClass("error")
		$('#TheClientForm *').removeClass("checked")
		$('#TheBusForm *').removeClass("checked	")
		$('#QuickSubmitP').attr("value", $('#ButOrValP').attr("value"))
		$('#QuickSubmitP').attr("disabled", false)
		$('#CloseP').attr("disabled", false)
		$('#QuickSubmitB').attr("value", $('#ButOrValB').attr("value"))
		$('#QuickSubmitB').attr("disabled", false)
		$('#CloseB').attr("disabled", false)

	});

	$('#CloseB, #CloseP').click(function() {
		$('#ClientID').trigger('form-cancel')
	});

	$('#New').click(function() {
		$('#ClientID').trigger('form-open');
	});

	$("#CurrencyID").change(function() {
		$("#CurrencyID option:selected").each(function() {
			$(".currency").html(($(this).attr("symbol")))
		})
	});

	$(".commentslink").click(function() {
		if ($(".comments").is(":hidden")) {
			$(".showcomments").fadeOut("slow")
			$(".comments").slideDown("slow", function() {
				$(".hidecomments").fadeIn("slow")
			});

		} else {
			$(".hidecomments").fadeOut("slow")
			$(".comments").slideUp("slow", function() {
				$(".showcomments").fadeIn("slow");
			});

		}
		return false
	});

	$(".DelLine").click(function(){
		if(confirm($(this).attr('msg'))){
			$(this).parent().parent().fadeOut('slow').remove()
			$("#Qty").focus();
			var Total = 0
			$(".amount").each(function(i) {
				Total = (parseFloat(Total) + parseFloat(this.value))
			})
			Total = Total.toFixed(2)
			$("#InvoiceTotal").attr("value", Total)
		};
		return false
	})
})