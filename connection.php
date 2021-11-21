<?php

	$servername = "localhost:3308";
	$username = "root";
	$password = "";
	$dbname = "online_bank";

	$conn = mysqli_connect($servername, $username, $password, $dbname);

	if(!$conn){
		die("Could not connect to the database ".mysqli_connect_error());
	}

?>
