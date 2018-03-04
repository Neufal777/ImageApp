<html>
<head>
   <title></title>
   <script src='js/jquery.js'></script>
   <script src='js/main_script.js'></script>
</head>
<body>

</body>
</html>
          <?php
include 'php/connection.php';
session_start();

         $select_posts = mysqli_query($db_con,"SELECT * FROM posts order by 1 desc LIMIT 5");

         $session_un = $_SESSION['username'];

         if ($select_posts) {
               while ($posts = $select_posts->fetch_assoc()) {
                        
                        $pos = array($posts['id'],$posts['author'],$posts['texto'],$posts['image'],$posts['divid'],$posts['authorprofile']);
                        $get_posts_like = mysqli_query($db_con,"SELECT * FROM likes Where postid='$pos[0]' ");

                        $image_likes = mysqli_num_rows($get_posts_like);

                        echo "<div  class='home_individual_post_container'>
            <!--START OF THE SINGLE POST-->
            <a href='profile.php?username=$pos[1]'><h5 class='individual_post_author_name'>$pos[1]</h5></a>
            <div class='individual_post_profile_image_container'><img class='individual_post_profile_image_container' src='profile_images/$pos[5]'></img></div>
            <div class='individual_post_posted_image_container'><img id='posted_image_id' src='uploaded_images/$pos[3]'></img></div>
            <div class='individual_post_like_and_show_comments_container'>
               <h5 id='likes_count_display'>$image_likes</h5>
              
                  <a href='like.php?postid=$pos[0]&likefrom=$session_un' name='like_submit' id='like_link' ><img src='data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAACAAAAAgCAYAAABze
                  nr0AAABvklEQVRYR82XQU7CQBSG/1fjwlgTbyBHYEHZCtQDwAmQE4gnEU4gnKAeQGjdAol4A7yBiSUujH1m2pQgtMxMKdRZdt6875s3nZk
                  MoeBGMv5X3bqOY87c6YssXvTrjEkU8O1qG+AuQOVNIANPoKB/8Tzz1vs+byo1sHFHQHNbkucA9czRZLjZ90fAr1llGOSAUJLPlL3zn++WiFu
                  enDoA1aRjGAsE3DK96TyOXQmEMwjIIaJLaaI4QCQUTUk4GsTMHxSgHkuEAmLmbMDVgitbJizImkQkYFuuUgn3gCZoeOZoWidRemLDzTW3YjKmo
                  E6+bQ0AaiuOyTeMuS8EXpO2W76ktGw8J9+u8nFgyZR/INCoLkC4KqQKjLdif0LwkPyGdQuix2IqwJ3oICpiGRjv5nhSCgWWdrXJgHPMKohDSNyo
                  q8vIb1S6IOPhKBIc3JvjWS+6x9baUU5F5o45ng62ruP4w0ElNuBbFVhJHGI5EuCpAtHOyHF7psB3CuQmsQMuFdhbQgJXEsgsoQBXFtCWUIRrCShLa
                  MC1BaQSmvBMAqkSGeCZBbYkMsL3EgglxFMOwPpTS/cyk76OdRPqxv8Cr2jT7ckoQjEAAAAASUVORK5CYII='/></a>
               
            </div>";?>
            
            <?php
               if (!empty($pos[2])) {
                  echo "<div class='upload_description_container'> - $pos[2]</div>";
               }
            ?>
            <?php echo "
         </div>
        
         <br> <!--FINAL OF THE SINGLE POST-->";

                  }              
         }
      ?>