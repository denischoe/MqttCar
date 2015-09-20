$(document).ready(function(e){
//	$(".form-horizontal .new-user").hide(2000);
//			$("#form-submit").css("dispaly","none");

	$('.form-horizontal .new-user').click(function(event){

//		$("#form-submit").css("dispaly","none");
//		alert($("#form-submit").val());
		$(".form-horizontal .sign-in").hide(1000);
		$(".form-horizontal .new-user").hide(1000);

		$(".form-horizontal .register").show(1000);
		$(".panel-title").html('<h3 class="panel-title">REGISTER</h3>');


	});

});