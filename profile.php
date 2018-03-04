<?php

session_start();
if (isset($_SESSION['id'])) {
    # code...
}else{
    header("location: index.php");
}
include 'php/connection.php';

$profile_username = $_GET['username'];
$ch_usern         = mysqli_query($db_con, "SELECT * FROM users WHERE username='$profile_username' ");

if (mysqli_num_rows($ch_usern) > 0) {
    
    $select_info = mysqli_query($db_con, "SELECT * FROM users WHERE username='$profile_username'");
    
    while ($pro_inf = $select_info->fetch_assoc()) {
        
        $p_in = array(
            $pro_inf['name'],
            $pro_inf['surname'],
            $pro_inf['username'],
            $pro_inf['name'],
            $pro_inf['email'],
            $pro_inf['profileimage']
        );
    }
    
    
} else {
    header("location: index.php");
}
?>
<html>
<head>
	<title>Profile</title>
	<link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
	<?php
include 'search_bar.php';
?>
	<?php
include 'lateral_menu.php';
?>
	

	<div id="profile_personal_information_continer">
			<div class="profile_image_container"><img class='profile_image_container' src="profile_images/<?php
echo $p_in[5];
?>"></div>
			<h1 id='profile_information_name'><?php
echo $p_in[0] . ' ' . $p_in[1];
?>  {<?php
echo $p_in[2];
?>}</h1>
			<h5 id="profile_information_email_container">naoufaldah@gmailcom</h5>
			<?php
$followers_number = mysqli_query($db_con, "SELECT * FROM followers WHERE followed = '$p_in[2]' ");
$followers_count  = mysqli_num_rows($followers_number);

echo "<h5 id='followers_count_id'>$followers_count Followers</h5>";
?>
			<?php
$i_follow_number = mysqli_query($db_con, "SELECT * FROM followers WHERE user1 = '$p_in[2]' ");
$i_follow_count  = mysqli_num_rows($i_follow_number);

echo "<h5 id='i_follow_count_id'>I Follow : $i_follow_count People</h5>";
?>
			<?php
if ($p_in[2] != $_SESSION['username']) {
    
    $ac1                        = $_SESSION['username'];
    $check_if_alredy_follows_me = mysqli_query($db_con, "SELECT * FROM followers WHERE user1='$ac1' and followed='$p_in[2]' ");
    
    if (mysqli_num_rows($check_if_alredy_follows_me) > 0) {
        
        echo "<form method='POST' >
						<button  name='unfollow_submit' id='profile_followed_user'>Unfollow</button>
				</form>";
    } else {
        echo "<form method='POST' >
						<button name='follow_submit' id='profile_follow_user'>+1 Follow</button>
				</form>";
    }
    
} else {
    echo "<form method='POST' >
						<button onclick='return false'  id='profile_followed_user'>This is your profile</button>
				</form>";
}

?>
	</div>
	<?php
if (isset($_POST['unfollow_submit'])) {
    
    $ac3 = $_SESSION['username'];
    
    mysqli_query($db_con, " DELETE FROM followers WHERE user1='$ac1' and followed='$p_in[2]'");
    header("location: profile.php?username=$p_in[2]");
}
?>
	<!-- START PUBLISH ALL MY POSTS -->
<?php
if (isset($_POST['follow_submit'])) {
    
    $ac = $_SESSION['username'];
    
    mysqli_query($db_con, "INSERT INTO followers(user1,followed) values ('$ac','$p_in[2]')");
    header("location: profile.php?username=$p_in[2]");
}
?>
	<div class='profile_all_posts'>
			 <?php

$select_posts = mysqli_query($db_con, "SELECT * FROM posts where author='$p_in[2]' order by 1 desc ");

if ($select_posts) {
    while ($posts = $select_posts->fetch_assoc()) {
        
        $pos = array(
            $posts['id'],
            $posts['author'],
            $posts['texto'],
            $posts['image'],
            $posts['divid'],
            $posts['authorprofile']
        );
        
        $select_likes = mysqli_query($db_con,"SELECT * FROM likes WHERE postid='$pos[0]' ");
        $likes_count = mysqli_num_rows($select_likes);
        
        echo "
            <div class='profile_posted_image_container'><img id='profile_posted_image_id' src='uploaded_images/$pos[3]'></img> <p id='profile_image_likes_count01'>$likes_count </p> <img id='profile_image_likes_count' src='data:image/png;base64,iVBORw0KGgoAA
            AANSUhEUgAAACAAAAAgCAYAAABze
                  nr0AAABvklEQVRYR82XQU7CQBSG/1fjwlgTbyBHYEHZCtQDwAmQE4gnEU4gnKAeQGjdAol4A7yBiSUujH1m2pQgtMxMKdRZdt6875s3nZk
                  MoeBGMv5X3bqOY87c6YssXvTrjEkU8O1qG+AuQOVNIANPoKB/8Tzz1vs+byo1sHFHQHNbkucA9czRZLjZ90fAr1llGOSAUJLPlL3zn++WiFu
                  enDoA1aRjGAsE3DK96TyOXQmEMwjIIaJLaaI4QCQUTUk4GsTMHxSgHkuEAmLmbMDVgitbJizImkQkYFuuUgn3gCZoeOZoWidRemLDzTW3YjKmo
                  E6+bQ0AaiuOyTeMuS8EXpO2W76ktGw8J9+u8nFgyZR/INCoLkC4KqQKjLdif0LwkPyGdQuix2IqwJ3oICpiGRjv5nhSCgWWdrXJgHPMKohDSNyo
                  q8vIb1S6IOPhKBIc3JvjWS+6x9baUU5F5o45ng62ruP4w0ElNuBbFVhJHGI5EuCpAtHOyHF7psB3CuQmsQMuFdhbQgJXEsgsoQBXFtCWUIRrCShLa
                  MC1BaQSmvBMAqkSGeCZBbYkMsL3EgglxFMOwPpTS/cyk76OdRPqxv8Cr2jT7ckoQjEAAAAASUVORK5CYII='/></div>
            
        
          <!--FINAL OF THE SINGLE POST-->";
        
    }
}
?>
         
	</div>
</body>
</html>
