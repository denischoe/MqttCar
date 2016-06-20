<?php
session_start(); //session start

//============ristric user from viewing this page without login
// if user did not login then redirect them to login page (index.php)

if(!isSet($_SESSION['loggedOn'])){
	header("Location: index.php");
}

// variables
$userID = $_SESSION['userID'];
$carID = $_POST['carID'];

$response = array();
$response['connectPATH'] ="";
$response['viewPATH'] ="";
$response['message'] ="";

// data base connect
include('database.php');

$conn = connectData();
//select DB
if(!mysqli_select_db($conn, 'IAP')){
	echo "fail to sellect";
}

$sql = "SELECT * FROM request WHERE carID ='".$carID."'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);


//================now it will check wheather there is any request that user made (pending)
if(!$row){ // no request any made yet

	// making request on DB
	$sql = "INSERT INTO request (userID, carID) VALUES ('".$userID."', '".$carID."')";

	if (mysqli_query($conn, $sql)) {
    		$response['message'] .= "New record created successfully";
    		echo json_encode($response);
	} else {
  			$response['message'] .=  "Error: " . $sql . "<br>" . mysqli_error($conn);
  			echo json_encode($response);
	}

}else {	// yes there is request made which should be second time indicating pendding


	if(!$row['connection']) { //waiting for connect to change "ok(1) " from car

		$response['message'] .= " waiting...";

		echo json_encode($response);

	}else { // indecating (1) meaning car accecpted it properly
		// now that we have connected fom car we gonna delete request row and create
		// new connection row in connection table 
		$sql = "DELETE FROM request  WHERE carID = '".$carID."'";

		if (mysqli_query($conn, $sql)) {
    		$response['message'] .=  "successfully Delete";
		} else {
  			$response['message'] .=  "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		// create connectPATH randomly with carID and insert
		$response['connectPATH'] = rand(1000,9999).$carID;
		$sql = "INSERT INTO connection (userID, carID, connectPATH) VALUES ('".$userID."', '".$carID."', '".$response['connectPATH']."')";
		
		if (mysqli_query($conn, $sql)) {
    		$response['message'] .=  "successfully Inserted";
    		$_SESSION['connectPATH'] = $response['connectPATH'];
		} else {
  			$response['message'] .=  "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		echo json_encode($response);
		//$response['connectPATH'] = $row['connectPATH'];
	}

}



mysqli_close($conn); 


?>