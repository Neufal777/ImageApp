<?php
	session_start();

	include 'php/connection.php';
	$post_id = $_GET['postid'];
	$like_from = $_GET['likefrom'];

	$check_if_username_alredy_gived_a_like = mysqli_query($db_con,"SELECT * FROM likes where postid='$post_id' and likefrom='$like_from'");

	if (mysqli_num_rows($check_if_username_alredy_gived_a_like)>0) {
		header("location:  home.php");
	}else{
		mysqli_query($db_con,"INSERT INTO likes(postid,likefrom) values ('$post_id','$like_from')");
		header("location: index.php");
	}
	

?>