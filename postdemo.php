<?php
//Creates new record as per request
    //Connect to database
  	$servername = "localhost";
	$username = "1092449";
	$password = "wordpress25";
	$dbname = "1092449";

    // Create connection
    $conn = new mysqli($servername, $username, $password, $dbname);
    // Check connection
    if ($conn->connect_error) {
        die("Database Connection failed: " . $conn->connect_error);
    }

    //Get current date and time
    date_default_timezone_set('Asia/Kolkata');
    $d = date("Y-m-d");
    //echo " Date:".$d."<BR>";
    $t = date("H:i:s");

    if(!empty($_POST['phlevel']) && !empty($_POST['turbidity']) && !empty($_POST['do']))
    {
    	$phlevel = $_POST['phlevel'];
    	$turbidity = $_POST['turbidity'];
		$do = $_POST['do'];
	    $sql = "INSERT into water (turbidity, phlevel, do, Date, Time) VALUES ('".$turbidity."', '".$phlevel."', '".$do."', '".$d."', '".$t."')";

		if ($conn->query($sql) === TRUE) {
		    echo "OK";
		} else {
		    echo "Error: " . $sql . "<br>" . $conn->error;
		}
	}


	$conn->close();
?>