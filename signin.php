<?php
include('database.php');

session_start(); // start session

//====== retreive data =============
//get json object in a nomarl object ex({key:jsdonData})
$jsobject = $_POST['jsobject'];
// with true it will convert json to php associ array
$jsobject = json_decode($jsobject, true);

//get userID and password
$userID = $jsobject['userID'];
$password = $jsobject['password'];

//====== prepare response ========
// decalre response var for response back to client 
// it will be encoded as json before it is sent
$response = array();
$response['error'] = "";

//========= user validation.
$conn = connectData(); // call coonectData function returning connection obj
//sellect db
if(!mysqli_select_db($conn,'IAP')){
	$response['error'] = "fail to SELECT  database";
	$response = json_encode($response);
	echo $response;
}

// make sql
$sql = 'SELECT userID,password FROM user WHERE userID = "'.$userID.'"AND password = "'.$password.'"';
$result = mysqli_query($conn, $sql);
if(!$result){
	$response['error'] = "query fail";
	$response = json_encode($response);
	echo $response;
}else {
	$row = mysqli_fetch_array($result);

	if($row == 0){

		$response['error'] = "Invalid user ID or password";
		echo json_encode($response);

	}else {

		//set session data for later usage
		$_SESSION['userID'] = $userID;
		$_SESSION['loggedOn'] = "true";
		$response['redirect_location'] = "carsel.php";
		echo json_encode($response);

	}
}



// when auth successed
mysqli_close($conn); 




?>