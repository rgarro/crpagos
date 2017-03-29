/**
 * @author kchanto
 */
$(document).ready(function() {
	$("#tabs").tabs({
		cookie : {
			expires : 30
		},
		fx : {
			opacity : 'toggle'
		}
	});
})