<?php
$dbhost = "192.168.43.194:3306"; // need to be changed according to assigned Ip from DHCP
$dbuser = "root";
$dbpass = "root";



function connectData() { // connect to database 

	$conn = mysqli_connect("localhost");
	

	if(! $conn )
	{
  		die('Could not connect: ' . mysql_error());
	}

	//echo $conn = mysqli_connect($dbhost, $dbuser, $dbpass);

	//echo "Database test_db created successfully\n";
	//mysql_close($conn);
	return $conn;
}




?>