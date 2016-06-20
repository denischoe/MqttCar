<?php
session_start();

unset($_SESSION['loggedOn']);
unset($_SESSION['connectPATH']);
session_destroy();

header("Location: closeConnection.php");

?>