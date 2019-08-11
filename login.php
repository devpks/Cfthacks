<?php 

if (isset($_POST['login-submit'])) {
	
	require'practice connection.php';
	
	$mail = $_POST['email'];
	$password = $_POST['pass'];

		if(empty($mail) || empty($password)) {
			header("Location: ../error.php?error=emptyfields");
		exit();
		
		}						 //emptyfields if statement
else {
	$sql = "SELECT * FROM users WHERE email=? OR name=?;";
	$stmt = mysqli_stmt_init($conn);
	
	if (!mysqli_stmt_prepare($stmt, $sql)) {
		 header("Location: ../error.php?error=sqlerror");
		exit();
	 }
	 else{
		 mysqli_stmt_bind_param($stmt, "ss", $mail, $mail); // Prepared Statements
			mysqli_stmt_execute($stmt);
			$result = mysqli_stmt_get_result($stmt); //matching the email ID with the database data
			if($row = mysqli_fetch_assoc($result)){  // 
				$pwdCheck = password_verify($password, $row['pass']); // password verification
						if($pwdCheck == false) { // if it turns out to be false i.e that the password does not match, then :
								header("Location: ../error.php?error=wrongpass");
		exit();
						}
						else if(pwdCheck == true){  // If it turns out to be true i.e the password matches and the email Id already exists then :
						session_start();
						$_SESSION['userId'] = $row['id'];
						$_SESSION['userUid'] = $row['name'];
						header("Location: ../hola.php?login=success");
						exit();
						}
						else {
								header("Location: ../error.php?error=wrongpass");
								exit();
						}
					}
			else	{ // No such email is found in the database
				header("Location: ../error.php?error=nouser");
				exit();
				}
	 }
  }
}
else {  // - this is the else statement for if (isset($_POST['login-submit'])) 
	header("Location: ../signup.php?error=kindlysignup");
		exit();
}