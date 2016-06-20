<?php

// variable..
$carID = $_GET['carID'];

//database connect 
include("database.php");

$conn = connectData();
//select DB
if(!mysqli_select_db($conn, 'IAP')){
	echo "fail to sellect";
}

$sql = "SELECT * FROM request WHERE carID ='".$carID."'";

$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($row) {

	$sql = "UPDATE request SET connection = '1' WHERE carID = '".$carID."'";
	if (mysqli_query($conn, $sql)) {
    		echo "update  successfully";

	} else {
  			echo "Error: " . $sql . "<br>" . mysqli_error($conn);
	}
	echo "=yes";
} else {
	echo "=no";
}

?>