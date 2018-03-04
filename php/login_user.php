<?php
	include 'connection.php';

	$login_info = array($_POST['login_username'],md5($_POST['login_password']));


	if (!empty($login_info[0]) && !empty($login_info[1])) {
			
			$check_user = mysqli_query($db_con,"SELECT * FROM users WHERE username='$login_info[0]' ");

			if (mysqli_num_rows($check_user)>0) {
						
						while ($row = $check_user->fetch_assoc()) {
								
								$data = array($row['username'],$row['password'],$row['name'],$row['surname'],$row['email'],$row['id'],$row['profileimage']);

								if ($login_info[0]==$data[0] && $login_info[1]==$data[1]) {
									session_start();

									$_SESSION['id'] = $data[5];
									$_SESSION['name'] = $data[2];
									$_SESSION['surname'] = $data[3];
									$_SESSION['username'] = $data[0];
									$_SESSION['email'] = $data[4]; 
									$_SESSION['profileimage'] = $data[6];

									echo "<script>window.location.href='home.php'</script>";
								}else{
									echo "Incorrect Username Or Password";
								}
						}
				}else{
					echo "This user Doesn't exist";
				}
	}
?>