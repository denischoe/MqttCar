var carID;
$(document).ready(function(e){


	$('.logerror').hide();
	//newuser button click listener
	$('.form-horizontal .new-user').click(function(event){
		$('.logerror').fadeOut();
		// signin button and new user hide
		$(".form-horizontal .sign-in").hide(1000);
		$(".form-horizontal .new-user").hide(1000);
		// show register button
		$(".form-horizontal .register").show(1000);
		//change timte name from signin to register
		$(".panel-title").html('<h3 class="panel-title">REGISTER</h3>');
		// change form action to register.php
		$(".form-horizontal").attr('action','register.php');
		// make div element
		var inputFormCarId = '<div class="form-group"> <label for="carID" class="col-sm-2 control-label">Car ID</label><div class="col-sm-10"><input type="text" class="form-control" id="carID" name="carID" placeholder="Car Id"></div></div> ';
     	var inputFormCarName = '<div class="form-group"> <label for="carName" class="col-sm-2 control-label">Car Name</label><div class="col-sm-10"><input type="text" class="form-control" id="carName" name="carName" placeholder="Car Name"></div></div> ';
     	var inputFormCarImg = '<div class="form-group"> <label for="carImg" class="col-sm-2 control-label">Car Image</label><div class="col-sm-6"><input type="file" class="form-control" id="carImg" name="carImg"></div></div> '; 
     	//add elements before the botton (sigin-in)
     	 $(".sign-in").before(inputFormCarId ,inputFormCarName, inputFormCarImg);


	});
	
//============thumnail hover 
	$('.thumbnail').hover(
		function(){
			$(this).find('.caption').slideDown(250);
		},
		function(){
			$(this).find('.caption').slideUp(250);
		}
	);

// =============when submit button clicked
	$('.form-horizontal').submit(function(event){

		//check every input value and change div of fomr-group to error
		if($('#userID').val() == "" ||
			$('#carID').val() == "" ||
			$('#carName').val() == "" ||
			$('#carImg').val() == "" ||
			$('#inputPassword3').val() == "" ){

			alert('every input is required');
			return false;

		}else if($('#carID').val() == undefined){ // check wheather signin button was clicked or not

			var userID = $('#userID').val();
			var password = $('#inputPassword3').val();
			// make javascript object to JSON
			var object = JSON.stringify({userID: userID, password: password});
			// make ajax post call
			console.log(object);

			// no need to use json.parse cuz it will automatically do with 'json datatype'
			//specified
			$.post("signin.php", {jsobject:object}, function(data){
				
				//alert(data.error);
				if(data.redirect_location){
					var href = window.location.href.substring(0,window.location.href.lastIndexOf('/') + 1);
					href += data.redirect_location;
					alert(href);
					$(location).attr('href',href);
				}else{
	
					$('.logerror').html(data.error).fadeIn();
				
				}

			}, 'json');
			return false;

		}
			
			
		
		//event.preventDefault();
	});
	
//============when car slected
	$('.thumbnail a').click(function(e){
		console.log($(e.target));
		$('#waitDialog').slideDown(500);
		carID = $(e.target).attr('id');
		longPollRequest();
	});
	
// when user leave controll page cut off the connection on database


return "0";
});
function longPollRequest() {

	$.ajax( {method:"POST", 

				url:"requestAndConnect.php",

				data:{carID: carID},

				dataType:"json"})

				.done(function(data,status,xhr){
				
				console.log(data);

				if(data.connectPATH == "") { // not connected

				setTimeout( longPollRequest, 1000);

				}else {
					
					var href = window.location.href.substring(0,window.location.href.lastIndexOf('/') + 1);
					href += "controlPanel.php";
					alert(href);
					$('#waitDialog').slideUp(500);
					$(location).attr('href',href);

				}

			
		});
}

