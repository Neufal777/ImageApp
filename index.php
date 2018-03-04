<?php
   session_start();

?>
<html>
<head>
   <title>Image Share Platform</title>
      <script src='js/jquery.js'></script>
      <script src='js/main_script.js'></script>
      <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body id="home_body">
   <header id='home_header_login_container'>
      <div id="home_login_container">
         <form method='POST' action='php/login_user.php' id='login_form_form'>
            <input class='home_login_inputs'  type='text' name='login_username' placeholder='username'>
            <input  class='home_login_inputs' type='password' name='login_password' placeholder='password'>
            <button type='submit' onclick="return false" name='login_submit' id='login_form_submit_id'>Log In</button>
            <button id='show_register_form' onclick="return false">Register</button>
         </form>
   </div>   

   </header>   
   <div id='login_result'></div>
   <div id='home_register_container'>
      <button id='register_title'>Intoduce Your Information Below To Start! </button>
      <a href="" id='hide_register_form'>close</a>
      <form method='post' id='register_form_form'>
         <input class="home_register_inputs" type='text' name='register_name' placeholder='name'>
         <input class="home_register_inputs" type='text' name='register_surname' placeholder='surname'><br>
         <input class="home_register_inputs" type='text' name='register_username' placeholder='username'>
         <input class="home_register_inputs" type='text' name='register_email' placeholder='email'><br>
         <input class="home_register_inputs" type='password' name='register_password' placeholder='password'>
         <input class="home_register_inputs" type='password' name='register_password_confirm' placeholder='confirm Password'><br>
         <button type='submit' onclick="return false" id='register_form_submit_id' name='register_form_submit'>Register</button>
      </form>
      <div id='registration_result'></div>
   </div>
   
</body>
</html>