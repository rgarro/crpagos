/**
 * CRMalls Manager Parent Object
 *
 * @author Rolando <rgarro@gmail.com>
 * @uses JQuery
 * @uses Handlebars
 */
var CRContactos_Manager = {
			'noty_form_errors':function(errors){
				for(var key in errors){
					errorsl = errors[key];
					for(var i=0;i<errorsl.length;i++){
						var errmsg = key + ": "+errorsl[i];
						//var n = noty({text: errmsg,layout:'bottomLeft',type:'error'});
						new Noty({
							 text: errmsg,
							 type:'error',
							 timeout:4000,
								 layout:'top',
							 animation: {
									 open: 'animated bounceInLeft', // Animate.css class names
									 close: 'animated bounceOutLeft', // Animate.css class names
							 }
					 }).show();
					}
				}
			},
			'alert_success':function(msg){
				new Noty({
					 text: msg,
					 type:'success',
					 timeout:4000,
						 layout:'top',
					 animation: {
							 open: 'animated bounceInLeft', // Animate.css class names
							 close: 'animated bounceOutLeft', // Animate.css class names
					 }
			 }).show();
			},
			'alert_warning':function(msg){
				new Noty({
					 text: msg,
					 type:'warning',
					 timeout:4000,
						 layout:'top',
					 animation: {
							 open: 'animated bounceInLeft', // Animate.css class names
							 close: 'animated bounceOutLeft', // Animate.css class names
					 }
			 }).show();
			},
			'alert_error':function(msg){
				new Noty({
					 text: msg,
					 type:'error',
					 timeout:4000,
						 layout:'top',
					 animation: {
							 open: 'animated bounceInLeft', // Animate.css class names
							 close: 'animated bounceOutLeft', // Animate.css class names
					 }
			 }).show();
			},
			'check_errors':function(data){
				//console.log(data);
				if(typeof data == "string"){
					try {
						d = JSON.parse(data);
				    } catch (e) {
				        d = {};
				    }
				}else{
					d = data;
				}

				if(d.error == 1){
					if(d.timed_out == 1){
						CRContactos_Manager.error_redirect();
					}
				}
			},
			'successHide':function(data){
				this.verify_in_session(data);
				this.successHideTableRow(data);
			},
			'successHideTableRow':function(data){
				if(data.success ==1){
					this.hideTableRow();
				}else{
					alert(data.err_msg);
				}
			},
			'verify_in_session':function(data){
				if(data.ir_salida==1){
					this.error_redirect();
				}
			},
			'error_redirect':function(){
				window.location = "/";
			},
			'getOption':function(key){
				if(this.options[key] == undefined){
					alert("invalid option: "+ key);
					return " ";
				}else{
					return this.options[key];
				}
			},
			'init_preloaders':function(){
				$(".preloader").hide();

				$( document ).ajaxStart(function(){
					$(".preloader").show();
				});

				$( document ).ajaxStop(function(){
					$(".preloader").hide();
				});
			},
			'lastTrID':'',
			'setRowToHide':function(TrID){
				this.lastTrID = TrID;
			},
			'hideTableRow':function(){
				$(this.lastTrID).hide();
			}
}
