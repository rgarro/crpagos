/**
 * @author kchanto
 */
$(document).ready(function(){
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
});