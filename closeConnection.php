<?php


// dealete connection row from database//
if(isSet($_POST['userID'])) {
	$userID = $_POST['userID'];
	include('database.php');

	$conn = connectData();
	//select DB
	if(!mysqli_select_db($conn, 'IAP')){
		echo "fail to sellect";
	}

	$sql = "SELECT * FROM connection WHERE userID ='".$userID."'";
	$result = mysqli_query($conn, $sql);
	$row = mysqli_fetch_array($result);

	if($row) {

		$sql = "DELETE FROM connection  WHERE userID = '".$userID."'";
		$result = mysqli_query($conn, $sql);
	} 



}else {

		header("Location: index.php");
}





?>