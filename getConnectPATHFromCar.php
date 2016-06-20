<?php

$carID = $_GET['carID'];
$connectPATH="";

//database connect 
include("database.php");

$conn = connectData();
//select DB
if(!mysqli_select_db($conn, 'IAP')){
	echo "fail to sellect";
}

$sql = "SELECT * FROM connection WHERE carID ='".$carID."'";
$result = mysqli_query($conn, $sql);
$row = mysqli_fetch_array($result);

if($row) {

	$connectPATH = $row['connectPATH'];
	
	echo "=".$connectPATH;
} else {
	echo "=no";
}
?>