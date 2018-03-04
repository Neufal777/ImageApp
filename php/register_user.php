<?php
	include 'connection.php';
	$reg_info = array(
		addslashes(mysqli_real_escape_string($db_con,$_POST['register_name'])),
		addslashes(mysqli_real_escape_string($db_con,$_POST['register_surname'])),
		addslashes(mysqli_real_escape_string($db_con,$_POST['register_username'])),
		addslashes(mysqli_real_escape_string($db_con,$_POST['register_email'])),
		md5($_POST['register_password']),
		md5($_POST['register_password_confirm']),
		'profile_image_sample.png'
		);

	if ($reg_info[4]==$reg_info[5]) {
		if (!empty($reg_info[0])&& !empty($reg_info[1])&& !empty($reg_info[2])&& !empty($reg_info[3])) {
			
			$check_if_username_exists = mysqli_query($db_con,"SELECT * FROM users WHERE username='$reg_info[2]' ");
			$check_if_email_exists = mysqli_query($db_con,"SELECT * FROM users WHERE email='$reg_info[3]' ");
			if (mysqli_num_rows($check_if_username_exists)>0) {
					
					echo "This Username Alredy Exists";
			}elseif (mysqli_num_rows($check_if_email_exists)>0) {
					
					echo "This Email Alredy Exists, Please Choose Another One";
			}else{
				mysqli_query($db_con,"INSERT INTO users(name,surname,username,email,password,profileimage) values 

						('$reg_info[0]','$reg_info[1]','$reg_info[2]','$reg_info[3]','$reg_info[4]','sample.jpg')
					");
				echo "Registred Correctly ! Please Log In";
			}
		}else{
			echo "You Let Some Inputs Empty";
		}
	}else{
		echo "Please Check Your Password";
	}

?>