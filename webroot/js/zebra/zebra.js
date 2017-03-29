$(document).ready(function(){
	$(".zebra tr").mouseover(function(){$(this).addClass("zover");}).mouseout(function() {$(this).removeClass("zover");});		
	$(".zebra tr:even").addClass("zalt");
});