<?php
session_start(); // session start.

//============ristric user from viewing this page without login
// if user did not login then redirect them to login page (index.php)

if(!isset($_SESSION['loggedOn'])){
	header("Location: index.php");
}

// variables
$userID = $_SESSION['userID'];


//include database php;
include("database.php");
$conn = connectData(); // call coonectData function returning connection obj
//sellect db
if(!mysqli_select_db($conn,"IAP")){
	echo "fail to select";
}
$sql= "SELECT * FROM car WHERE userID ='".$userID."'";
$result = mysqli_query($conn,$sql);



?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- The above 3 meta tags *must* come first in the head; any other head content must come *after* these tags -->
    <title>IAP</title>

    <!-- Bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">
    <!-- custom css -->
    <link href="css/custom.css" rel="stylesheet">
 <!-- jQuery (necessary for Bootstrap's JavaScript plugins) -->
    <script src="js/jquery.js"> </script>
    <!-- Include all compiled plugins (below), or include individual files as needed -->
    <script src="js/bootstrap.min.js"></script>
        <script src="js/jsfunctions.js"></script>

         

    
  </head>
  <body>

  	<!--test begin-->
 

  	<!--test end-->
  	<!--nav-->
 	<nav class="navbar navbar-default">
  <div class="container-fluid">
    <!-- Brand and toggle get grouped for better mobile display -->
    <div class="navbar-header">
      <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#bs-example-navbar-collapse-1" aria-expanded="false">
        <span class="sr-only">Toggle navigation</span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
      </button>
      <a class="navbar-brand" href="#">CHOE</a>
    </div>

    <!-- Collect the nav links, forms, and other content for toggling -->
    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
      <ul class="nav navbar-nav">
        <li><a href="#">Add CAR <span class="sr-only">(current)</span></a></li>
        <li><a href="#">About</a></li>
      </ul>
     
      <ul class="nav navbar-nav navbar-right test">

        <li><a href="logout.php">Sign out</a></li>
        
      </ul>
    </div><!-- /.navbar-collapse -->
  </div><!-- /.container-fluid -->
</nav>




  	<!--nav end-->
    <div class="container">
    	<div class="panel panel-success">
      	  <div class="panel-heading">
            <h3 class="panel-title"> Car Select </h3>
       	  </div>
        <div calss="panel-body">
        	<div class="row">
        	<!--php code-->
        	<?php

        	while($row = mysqli_fetch_array($result)){
   				
  				echo'<div class="col-sm-6 col-md-4">
    					<div class="thumbnail">';
      			echo'		<img src="'.$row['carImg'].'" alt="...">';

      			echo'		<div class="caption">';
       			echo'		 		<h3>'.$row['carName'].'</h3>';
       			echo'				<p>click for connection</p>
        							<p> <a href="#" class="btn btn-primary" id = "'.$row['carID'].'"role="button">Button</a></p>
      							</div>
    						</div>
  						</div>';
			
			}
			?>
			<!--php end-->
			</div>
			<!--row end-->
   		</div>
   		<!--panel-body end-->
    	</div>
    	<!--panel end-->
   </div>
   <!--container end-->


   <div id="waitDialog"  style="text-align: center">
        
        <div class = "centered" style=" top: 50%; color: white">
            <b>Please wait ...waiting for car's connection</b>
        </div>
    </div>
   
  </body>
</html>