<?php
//Create Data base if not exists
	$servername = "localhost";
	$username = "1092449";
	$password = "wordpress25";
	$dbname = "1092449";

	// Create connection
	$conn = new mysqli($servername, $username, $password);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	
//Connect to database and create table
	$servername = "localhost";
	$username = "1092449";
	$password = "wordpress25";
	$dbname = "1092449";
	
	
	// Create connection
	$conn = new mysqli($servername, $username, $password, $dbname);
	// Check connection
	if ($conn->connect_error) {
	    die("Connection failed: " . $conn->connect_error);
	}

	//Sr No, zone, place(OK, NM, WM, ACK) Date, Time
	//1         A          NM                 12-5-18    12:15:00 am
	// sql to create table
	$sql = "CREATE TABLE water (
	id INT(6) UNSIGNED AUTO_INCREMENT PRIMARY KEY,
	phlevel VARCHAR(30),
	turbidity VARCHAR(30),
	do VARCHAR(50),
	`Date` DATE NULL,
	`Time` TIME NULL, 
	`TimeStamp` TIMESTAMP NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
	)";
	if ($conn->query($sql) === TRUE) {
	    echo "Table water created successfully";
	} else {
	    echo "Error creating table: " . $conn->error;
	}

	$conn->close();
?>