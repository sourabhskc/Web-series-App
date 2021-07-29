<?php

// Including connection.php which establishes connection with db
include("connection.php");


if(isset($_POST['submit'])){

	// To check at last, whether upload in the db or not after checking all the conditions
	$uploadOk_image = 1;
	$uploadOk_video = 1;


	// Common target directory for both images and videos 
	$target_dir = "../html/uploads/";

	/* --------------- Code for image file input -----------*/

	// Maximum image size
	$image_maxsize = 52428800; // 50MB

	$name_image = $_FILES['imageinput']['name'];

	$target_file_image = $target_dir . $_FILES["imageinput"]["name"];
	
	$imageFileType = strtolower(pathinfo($target_file_image,PATHINFO_EXTENSION));
	
	// Valid file extensions for images
	$extensions_arr_image = array("jpg","jpeg","png","gif");

	// Check extension of images
	if( in_array($imageFileType,$extensions_arr_image) ){

	   // Check file size of images
	   if(($_FILES['imageinput']['size'] >= $image_maxsize) || ($_FILES["imageinput"]["size"] == 0)) {
		// echo "Image File is too large. File must be less than 50MB.";
		echo "<script>
		alert('Image File is too large. File must be less than 50MB.');
		</script>";

		 $uploadOk_image = 0; // set this to 0 to not upload in db

	   }else{
		 // Upload image 
		 /*
		 if((move_uploaded_file($_FILES['imageinput']['tmp_name'],$target_file_image))){
			echo "image Uploaded successfully.";
		  }
		  */
	   }

	}else{
		echo "<script>
		alert('Invalid Image or Video file extension ');
		window.location.href='../html/adminindex.html';
		</script>";
		$uploadOk_image = 0; // set this to 0 to not upload in db
		//window.location.href='../html/adminindex.html';
	}

	/* -------x------- Code for image file input -----x-----*/


	/* --------------- Code for video file input ---------*/

	$video_maxsize = 524288000; // 500MB

	$name_video = $_FILES['videoinput']['name'];

	$target_file_video = $target_dir . $_FILES["videoinput"]["name"];

	// Select file type of video
	$videoFileType = strtolower(pathinfo($target_file_video,PATHINFO_EXTENSION));

	// Valid file extensions for videos
	$extensions_arr_video = array("mp4","avi","3gp","mov","mpeg");

	// Check extension of video
	if( in_array($videoFileType,$extensions_arr_video) ){

	   // Check file size of video 
	   if(($_FILES['videoinput']['size'] >= $video_maxsize) || ($_FILES["videoinput"]["size"] == 0)) {
		// echo "Video File is too large. File must be less than 500MB.";
		echo "<script>
		alert('Video File is too large. File must be less than 500MB.');
		</script>";
		 
		 $uploadOk_video = 0; // set this to 0 to not upload in db
		 
	   }else{
		 // Upload video 
		 /*
		 if((move_uploaded_file($_FILES['videoinput']['tmp_name'],$target_file_video))){
		   echo "Video Uploaded successfully.";
		 }
		 */
	   }

	}else{
		echo "<script>
		alert('Invalid Image or Video file extension ');
		window.location.href='../html/adminindex.html';
		</script>";

		$uploadOk_video = 0; // set this to 0 to not upload in db

		//window.location.href='../html/adminindex.html';
	}
	
	/* -------x------- Code for video file input ----x----*/

if($uploadOk_image == 1 && $uploadOk_video == 1){
	$name = $_POST['name'];
	$genre = $_POST['genre'];
	$season = $_POST['season'];
	$episode = $_POST['episode'];
	$duration = $_POST['duration'];
	$rating = $_POST['rating'];
	$imageinput = $_FILES['imageinput']['name'];
	$videoinput = $_FILES['videoinput']['name'];

	// Upload image 
	if((move_uploaded_file($_FILES['imageinput']['tmp_name'],$target_file_image))){
	//	echo "image Uploaded successfully.";
	/*
	echo "<script>
		alert('image Uploaded successfully.');
		</script>";
		*/
	}

	// Upload video 
	if((move_uploaded_file($_FILES['videoinput']['tmp_name'],$target_file_video))){
	//	echo "Video Uploaded successfully.";
	/*	echo "<script>
		alert('video Uploaded successfully.');
		</script>";
		*/
	}

	// Inserting the correct details into the DB
	$sql = "INSERT INTO `webupload` (`name`, `genre`, `season`, `episode`, `duration`, `rating`, `imageinput`, `videoinput`) VALUES ('$name', '$genre', '$season', '$episode', '$duration', '$rating', '$imageinput', '$videoinput')";

	$result = mysqli_query($conn,$sql);

	if($result)
	{
		echo "<script>
		alert('data inserted sucessfully ');
		window.location.href='../html/adminindex.html';
		</script>";
	}

	else
	{
		die("connection failed");
	}
}
}

$conn->close();

?>

