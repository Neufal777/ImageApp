<?php
session_start();
if (isset($_SESSION['id'])) {
    # code...
}else{
    header("location: index.php");
}
?>
<html>
<head>
    <title><?php
echo $_GET['search'];
?></title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <?php
include 'search_bar.php';
?>
<?php
include 'lateral_menu.php';
?>
 
</body>
</html>
<div id="all_results_container">

    <?php
include 'php/connection.php';

if (!empty($_GET['search'])) {
    
    $searched = $_GET['search'];
    
    $find_users  = mysqli_query($db_con, "SELECT * FROM users Where username LIKE '%$searched%' or name LIKE '%$searched%' or surname LIKE '%$searched%' ");
    $results_num = mysqli_num_rows($find_users);
    
    echo "<h4 id='we_find_results_style'>We Found : $results_num Users</h4><br>";
    if (mysqli_num_rows($find_users) > 0) {
        
        while ($srch = $find_users->fetch_assoc()) {
            
            $searched      = array(
                $srch['username'],
                $srch['name'],
                $srch['surname'],
                $srch['profileimage'],
                $srch['email']
            );
            $complete_name = $searched[1] . " " . $searched[2];
            
            $search_followers       = mysqli_query($db_con, "SELECT * FROM followers WHERE followed='$searched[0]' ");
            $search_count_followers = mysqli_num_rows($search_followers);
            
            $search_following = mysqli_query($db_con, "SELECT * FROM followers WHERE user1 = '$searched[0]' ");
            
            $search_count_following = mysqli_num_rows($search_following);
            
            echo "<a href='profile.php?username=$searched[0]'><div id='search_result_container'>
        <div ><img class='search_result_profile_image' src='profile_images/$searched[3]'></div>
        <div class='search_information_container'>
            <h5 class='search_info_style'>$complete_name</h5>
            <h4 id='search_username'>[ $searched[0]  ]</h4>
        </div>
        <div id='search_users_follow'>
            ";
?>

            <?php
            $active_usr              = $_SESSION['username'];
            $search_following_system = mysqli_query($db_con, "SELECT * FROM followers where user1 ='$active_usr' and followed = '$searched[0]' ");
            
            if (mysqli_num_rows($search_following_system) > 0) {
                echo "<a href='' id='search_unfollow_link'>Followed</a>";
            } else {
                echo "<a href='' id='search_follow_link'>Unfollowed</a>";
            }
?>

            <?php
            echo "
        </div>
        <div class='user_social_information_container'>
        
                <h5> <img  src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABGElEQVQ4
        T7VTy03DQBScWUvk4EWkA9IB0AEd4Jw2t4QKgAoIFUA6iG82l7gESkgJoYOg2AeQsg8tIcKfBQdF2eO+N6PZmVnCd2b
        SVe/FkJRLNxbhi+2EMfpc1tfpw6skn5M4K88EmFujL9oJ0iIKIDMf8Rrsw4RZedZQoNLVmOC9j0AgD9Ycjw9NkE8JDP0
        KEFujRy0K9iSAi/AjXxA8qaYgb/ZI9+pR/hbjE4mbCoFgYgf6tj1Gt7EpkuvC6aZIeLWd8HznIjmQSn+8EDTN2yppPCF4z
        kcQuQIYVeVKBjBbGx37U0iLSIk8kuh5/8f3pQgWlrzbNvJLQVnuX+CaqVM70NdUSd5w/B8kEwbJKgPR3RVU2RMsPwEW5HWN
        xz1TkwAAAABJRU5ErkJggg=='/> Followers :  $search_count_followers</h5><br>
                <h5> <img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABAAAAAQCAYAAAAf8/9hAAABLUl
                EQVQ4T52Tz1GDQBTGvw/kkBkypgNjBxyEq2vwbjqwBdNBOkhK0A5iARpyTS50ICWQgRkPDDxndwRRkyFhT2/37ffb
                92+J1sqV79nEpT4arHebti+7v1EXJaUU7N1oF9c+akMLYWMBUDUiQUJipvciWIAY/wAlQomZBlGUN8ot54PkqP1il
                y0iqVsV18xD/xngY5fgsF9emE+CBMRVL4BOMw8D6SX+FjEL/ZSgqfy5SyB7ZmGwIvBwrth0B3il7i/FWvcCsLozc9An
                Cv368G07NQAzC7aTnFoLnbtbFmNGcWoA9TSKjagLYgpXQtXj3ABOgfwVa80vQJOO5axI3rYLKyIbtyqmOuz2+T9A7cwm
                wRyUJ7MXLofv2/mhTh0F6MufyjM/cBDFybE2fwGBjnl1mI/kDgAAAABJRU5ErkJggg=='/> Following : $search_count_following</h5>
        </div>
</div></a><br>";
        }
    } else {
        header("location: index.php");
    }
    
} else {
    header('location: home.php');
}
?>


</div>
