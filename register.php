<?php
include('database.php');

session_start(); // start session
unset($_SESSION['loggedOn']);
unset($_SESSION['userID']);
unset($_SESSION['carID']);
unset($_SESSION['carName']);


// get data from post request and put into variables
$userID = $_POST['userID'];
$password = $_POST['password'];
$carID = $_POST['carID'];
$carName = $_POST['carName'];

//check if file was uploaded 
if (!empty($_FILES['carImg']['name'])) {

	// declare varaibles from file from client
	$fileName = $_FILES['carImg']['name'];
	$tfileName = $_FILES['carImg']['tmp_name'];
	$target_path = "./images/".$carID."/".$fileName;
	// make dir for image and move image stored in temp location to whatever i want to put
	// if it is succed then save url to database
	if(!file_exists("./images"."/".$carID)) {

		mkdir("./images"."/".$carID);
	if(move_uploaded_file($tfileName, $target_path)){


		$conn = connectData(); // call coonectData function returning connection obj
		//sellect db
		if(!mysqli_select_db($conn,"IAP")){
			echo "fail to select";
		}
		//make sql query and insert to user table
		$sql = "INSERT INTO user (userID, password, carID) VALUES ('".$userID."', '".$password."', '".$carID."')";
 	 
 		if (mysqli_query($conn, $sql)) {
    		//echo "New record created successfully";
		} else {
  			  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}
		//make sql and iser to car table
		$sql = "INSERT INTO car (carID,carName, userID, carImg) VALUES ('".$carID."', '".$carName."', '".$userID."', '".$target_path."')";
 	 
 		if (mysqli_query($conn, $sql)) {
    		//echo "New record created successfully";
		} else {
  			  echo "Error: " . $sql . "<br>" . mysqli_error($conn);
		}

		//echo '<img src="'.$target_path.'"/>';
		mysqli_close($conn);

	}// upload file

	// set session var for carName, UserID, carID
	$_SESSION['carID'] = $carID;
	$_SESSION['userID'] = $userID;
	$_SESSION['carName'] = $carName;
    $_SESSION['loggedOn'] = "true";
    header("Location: carsel.php");

	}else if(isSet($_SESSION['loggedOn'])){ // file exist meaning car ID has been taken.

		echo " car ID has been taken from other user try again</br>";
		echo " please go back and try gain with other car ID";
	}


}



?>