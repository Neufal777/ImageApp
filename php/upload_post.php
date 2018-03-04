<?php
	
	session_start();
	include 'connection.php';


	$path_info = pathinfo($_FILES['posted_image']['name']);
	$uploaded_image = $_FILES['posted_image']['name']; 
	$upload_description = mysqli_real_escape_string($db_con,$_POST['description_post']);
	$author = $_SESSION['username'];

$exp = explode('.', $uploaded_image); // 'Jpeg || png' //Notice: Undefined index: extension in C:\wamp\www\ImagePlatform\php\upload_post.php on line 13
$ext = strtolower(end($exp));
	$authorprofile = $_SESSION['profileimage'];

if ($ext == 'jpg'  || $ext== 'png' || $ext=='jpeg') {

		if (!empty($_FILES['posted_image']['name'])) {

			$check_if_image_exists = mysqli_query($db_con,"SELECT * FROM posts WHERE image='$uploaded_image' ");

			if (mysqli_num_rows($check_if_image_exists) < 0) {
				echo "Uploaded Correctly";
			}else{
				$random_string = substr(str_shuffle('0123456789'),0, 7);
			mysqli_query($db_con,"INSERT INTO posts(author,texto,image,divid,authorprofile) values('$author','$upload_description','$uploaded_image','$random_string','$authorprofile')");
			move_uploaded_file($_FILES['posted_image']['tmp_name'], '../uploaded_images/'.$uploaded_image);
			echo "Uploaded Correctly";
			}

		}else{
			echo "You Have to selectt An Image";
		}

}else{
	echo "Incorrect File Extension ".$ext;
}



?>