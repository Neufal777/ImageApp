<div id="home_page_lateral_menu_container">
         <!-- LOGIN AND REGISTER OPTIONS --> 
         <div id='home_page_lateral_menu_info_container'>
            <div id='info_container_profile_image_container'><img class='profile_image_home' src="<?php echo 'profile_images/'.$_SESSION['profileimage']; ?>"></div>
   <a href='profile.php?username=<?php echo $_SESSION['username'];  ?>'><h5 id='info_ontainer_name'><?php echo $_SESSION['name']." ".$_SESSION['surname']; ?></h5>
   <h5 id='info_ontainer_name'><?php echo "{ ".$_SESSION['username']." }"; ?></h5>
         </div>
         <!-- home LATERAL MENU -->
         <div id="home_page_lateral_menu">
            <a href="home.php">
               <ul>
                  <li>HOME</li>
               </ul>
            </a>
            <a href="#">
               <ul>
                  <li>#####</li>
               </ul>
            </a>
            <a href="#">
               <ul>
                  <li>#########</li>
               </ul>
            </a>
                        <label id='lateral_menu_label'>SETTINGS </label><br><br>

            <a href="#">
               <ul>
                  <li>#########</li>
               </ul>
            </a>
            <a href="#">
               <ul>
                  <li>#########</li>
               </ul>
            </a>
            <a href="#">
               <ul>
                  <li>#########</li>
               </ul>
            </a>
            <a href="#">
               <ul>
                  <li>#########</li>
               </ul>
            </a>
            <a href="#">
               <ul>
                  <li>#########</li>
               </ul>
            </a>
            <a href="#">
               <ul>
                  <li>#######</li>
               </ul>
            </a>
            <a href="#">
               <ul>
                  <li>##########</li>
               </ul>
            </a>
            <a href="php/log_out.php">
               <ul>
                  <li>Log Out</li>
               </ul>
            </a>
         </div>
      </div>