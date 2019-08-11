<?php 
if (isset($_POST['submit'])) {
	require'practice connection.php';
  
	$name = $_POST['name'];
	$email = $_POST['email'];
	$pass = $_POST['pass'];
	
if (empty($name) || empty($email) || empty($pass)) {
		header("Location: ../signup.php?error=emptyfields"); // for empty fields
		exit();
}
	else if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
		 header("Location: ../signup.php?error=invalidemail"); // for invalid email
		exit();
	}
	
else if (!preg_match("/^[a-zA-Z0-9]*$/", $name)) {
		 header("Location: ../signup.php?error=invalidname"); // for invalid name
		exit();
}

else {
	$sql = "SELECT email FROM users WHERE email=?";
	$stmt = mysqli_stmt_init($conn);
	
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../signup.php?error=alreadyexists");
		exit();
	}
	else {
		mysqli_stmt_bind_param($stmt, "s", $name);
		mysqli_stmt_execute($stmt);
		 mysqli_stmt_store_result($stmt);
		 $resultCheck = mysqli_stmt_num_rows($stmt);
		 
		 if ($resultCheck > 0) {
			 header("Location: ../signup.php?error=usertaken");
		exit();
		 }
		 
		 else{
			$sql = "INSERT into users (name, email, pass) VALUES (?, ?, ?)"; // inserting data
		$stmt = mysqli_stmt_init($conn);
		
		if (!mysqli_stmt_prepare($stmt, $sql)) {
		header("Location: ../signup.php?error=sqlerror");
		exit();
	}
		else {
		$hashedPwd = password_hash($pass, PASSWORD_DEFAULT);
		mysqli_stmt_bind_param($stmt, "sss", $name, $email, $hashedPwd);
		mysqli_stmt_execute($stmt);
		header("Location: ../signup.php?signup=success");
		exit();
		}
		
		}
	
	
		}
		
	}
	
	mysqli_stmt_close($stmt);
	mysqli_close($conn);
	


}

else{
	header("Location: ../signup.php?signup=swrong method");
		exit();
}
	
	
	


  