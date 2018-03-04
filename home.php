
<?php
session_start();
include 'php/connection.php';
      if (isset($_SESSION['id'])) {
            
            $connected_user = $_SESSION['id'];
            $select_info_about_connected_user = mysqli_query($db_con,"SELECT * FROM users WHERE id='$connected_user'");

            while ($i = $select_info_about_connected_user->fetch_assoc()) {
                  $info = array($i['id'],$i['name'],$i['surname'],$i['username'],$i['email'],$i['profileimage']);

            }


      }else{
         header("location: index.php");
      }
?>
<html>
   <head>
      <title>Image Platform</title>
      <link rel="stylesheet" type="text/css" href="css/style.css">
      <meta charset='utf-8'>
      <script src='js/jquery.js'></script>
      <script src='js/main_script.js'></script>
   </head>
   <body>
      <div id='home_search_bar_container'>
         <form method='GET' action='search.php' >
            <input name='search' type="text" id='search_bar_input' spellcheck='false'>
         </form>
      </div>


      <!-- ALL POSTED IMAGES CONTAINER -->
      <div id='home_post_image_form_container'>
         <div ><img id='post_image_form_active_user_profile' src="<?php echo 'profile_images/'.$info[5]; ?>"></div>
                  <form enctype='multipart/form-data' method='post' id='home_post_image_form_form' action='php/upload_post.php'>
                        <div id='form_textarea_description'><textarea id='description_textarea_0' name='description_post' placeholder='Say Something..' spellcheck='false'></textarea></div>
                          <div id="item_upload_image_input_container">
                             <input type="file" name="posted_image" id="custom-file-input">
                            </div>
                        <button type='submit' id='post_image_submit'>Post Image!</button>
                  </form>
            <div id='post_image_result'></div>
            <div id="preview_uploaded_image"><img  src="#" id='blah' alt='your image'></div>
      </div>
      <div id="info_refresh">Refresh Posts! <div class="arrow-right"></div></div>
      <div id="update_posts">
            <img id='image_inside_update_posts' src="data:image/png;base64,iVBORw0KGgoAAAANSUhEUgAAABgAAAAY
            CAYAAADgdz34AAAB1klEQVRIS7WW4VECQQyFXypQK9AO1ArUCtQKxA60AulAOxA6gAqECtQKxA6kgjgfbpjl3D0WZ9w/MHfZ
            vJfkJTlTz3H3I0mXks4l8f8kmc/S70jS1My+am6s9CI5fpA06COQvQPovgT0C8DdryQ9S9pvdB5mRHFrZpP83gaAu8MY5/mZS
            4LhzMwWvHD3SNmdpOOOPSDYYzdaAxScf5IiM4t8FwNKYDg8zAyuJZGJmxWAu5OOjywt7xS2r3g5WroPkW40CgAY3KRLMD9pdR5
            ACeStE4ksKQb2cS62paVWfHenwMh6fQCgUI/pydzMKODOh4JmWdgAyFHXCtgFoeYcHxFBaH4UUmwFcHe6G8UUT7GTW5232P0/gL
            sPaYUKm6WZPbUwzeTKUAzJL6lB1XlqNrTdfDoTYVoDoJOvdi04LNydjj5LjO5LADuNiTy0NJdesmcHJQAm5ukfR8VrWkxgjM1sUE
            sReWdkVDdVhzl9BPPYeEuAuB8AY+Z9ZxcQCZ3dMq7ZIagnznUsHgDo3tVqrCwcokGqCzNj+WAHU0Yz97qza2Pc1FYmg2uvWZs/hqS
            FBVVfmVmzkFNYR8NswyLFw5Kse0dFWiIMsvi6CH0jZWpEfSZ9/fINN0vWrzYNsVIAAAAASUVORK5CYII="/>
      </div>

      <div class='home_all_posts_container'>

         
   
      </div>
      <div id='show_users_that_i_follow_container'>
            <h4 id='folloing_title'>Following...</h4><br><hr><br>
            <div id="following_container">
               <?php
                     $who_i_follow = mysqli_query($db_con,"SELECT * FROM followers WHERE user1='$info[3]' ");
                     if (mysqli_num_rows($who_i_follow)>0) {
                           
                           while ($followed = $who_i_follow->fetch_assoc()) {
                                 
                                 $who = $followed['followed'];

                                 echo "<a href='profile.php?username=$who'><div class='following_individual_container'>$who</div></a>";
                           }
                     }else{
                        echo "<a ><div class='following_individual_container'>You Don't Follow Anybody</div></a>";
                     }
                ?>
               
            </div>
      </div>



   <?php include 'lateral_menu.php'; ?>
<script type="text/javascript">
      $(document).ready(function(){
         $('#update_posts').click();
      })
</script>
   </body>
</html>
