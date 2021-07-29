<?php

	// Including connection.php which establishes connection with db
	include("connection.php");
	
	$em = $_POST['email'];
	$pas = $_POST['password'];
	
	
	// Encryption of Password for more security
	$pass = md5($pas);

	$sql = "SELECT * FROM signup WHERE email ='$em' and pas = '$pass' ";
	
	$result = mysqli_query($conn,$sql);

	$row = mysqli_fetch_array($result);
		
	if($row){
		header('Location: ../html/demo.php');
	} else{
		// setting error message when login cred is wrong
		echo "<script>	
		alert('Your id password do not match with database..Please login again or Signup !!!');	
		</script>";

		echo "<script>	
			window.location = '../html/login.html';
		</script>";
	//	echo ('Your id password do not match with database..Please Signup !!!');
	}

	mysqli_close($conn);
?>