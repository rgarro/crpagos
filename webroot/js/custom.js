//begin sounds
var changeRouteSnd = "changeRouteSnd";
var oweepSnd = "oweepSnd";
var dinkSnd = "dinkSnd";
var tingSnd = "tingSnd";
var blupSnd = "blupSnd";
var strawSound = "strawSound";
var resetSnd ="resetSnd";

createjs.Sound.registerSound("/sounds/Mechanic-Public_D-139_hifi.mp3", changeRouteSnd);
createjs.Sound.registerSound("/sounds/ooweep-Intermed-594_hifi.mp3",oweepSnd);
createjs.Sound.registerSound("/sounds/Dink-Public_D-146_hifi.mp3",dinkSnd);
createjs.Sound.registerSound("/sounds/Ting-Intermed-512_hifi.mp3",tingSnd);
createjs.Sound.registerSound("/sounds/Blubup-Public_D-2_hifi.mp3",blupSnd);
createjs.Sound.registerSound("/sounds/hollow_p-dog-7588_hifi.mp3",strawSound);
createjs.Sound.registerSound("/sounds/idg-bloo-intermed-3097_hifi.mp3",resetSnd);

function loadStage(stage_url){
  var s = createjs.Sound.play(changeRouteSnd);
  s.volume = 0.03;
	$("#content").html("<i class='fa fa-truck'></i> <i class='fa fa-spinner fa-pulse'></i> Cargando ...");
	$.ajax({
		url:stage_url,
		type:"GET",
		success:function(data){
			CRContactos_Manager.check_errors(data);
			$("#content").html(data);
		}
  });
}

$(document).ready(function(){
  //begin routes
	var router = new Route32({
        'automatic':true
    });

		router.add('#/Dashboard/',function(){
			loadStage("/dashboard/index?is_ajax=1");
		});

    router.add('#/Company/',function(){
    	loadStage("/dashboard/company");
    });

    router.add('#/Clients/',function(){
    	loadStage("/dashboard/clients");
    });

    router.add('#/Users/',function(){
    	loadStage("/dashboard/users");
    });

    router.add('#/MyCompany/',function(){
      loadStage("/dashboard/mycompany");
    });

    router.add('#/Terms/',function(){
    	loadStage("/dashboard/terms");
    });

    router.add('#/MyCompanyLogo/',function(){
      loadStage("/dashboard/mycompanylogo");
    });

    router.add('#/MyProfile/',function(){
      loadStage("/dashboard/myprofile");
    });

    router.drive();
});
