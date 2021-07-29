<?php

// Including connection.php which establishes connection with db
include("connection.php");

$em = $_POST['email'];
$ps = $_POST['password'];

// Encryption of Password for more security
$pass = md5($ps);

$usernamequery = " select * from signup where email='$em' ";

$query = mysqli_query($conn, $usernamequery);

$numexistrows = mysqli_num_rows($query);

if($numexistrows>0){
	// setting error message when username already registerd
	echo "<script>	
		alert('Username already exist!');	
		</script>";

	echo "<script>	
		window.location = '../html/signup.html';
	</script>";
		
	//	header('Location: ../html/signup.html');
	
}   
else{
	$insertquery = "insert into signup values('$em','$pass')";

	$iquery = mysqli_query($conn, $insertquery); 
	
	if($iquery){
		// setting showalert as true for showing, successful insertion
		echo "<script>
		alert('Username registerd successfully...Please Login...');
		</script>";

		echo "<script>	
				window.location = '../html/login.html';
			</script>";

		// header('Location: ../html/login.html');
	}
	else{
		?>
			<script>
				alert("Not inserted");
			</script>
		<?php
		//die("connection failed");
	} 
}

mysqli_close($conn);

?>