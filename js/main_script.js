
$(document).ready(function(){

				
				$('#like_link').click(function(){
					event.preventDefault();
					$.ajax({
						url : $(this).attr('href'),
						success: function(){
							
						}
					})
					return false;
				});


						//USER REGISTER AJAX

						$('#register_form_submit_id').click(function(){

							$.ajax({
								type : 'post',
								url: 'php/register_user.php',
								data : $('#register_form_form').serialize(),
								success : function(data){
									$('#registration_result').html(data);
								}
							});
							return false;
						});

						//USER LOGIN AJAX

						$('#login_form_submit_id').click(function(){

							$.ajax({
								type : 'post',
								url: 'php/login_user.php',
								data : $('#login_form_form').serialize(),
								success : function(data){
									$('#login_result').html(data);
								}
							});
							return false;
						});

						$('#show_register_form').click(function(){
							$('#home_register_container').animate({marginLeft:'550px'},100);
							$('#home_register_container').animate({marginLeft:'450px'},100);
							$('#home_register_container').animate({marginLeft:'550px'},100);
							$('#home_register_container').animate({marginLeft:'450px'},100);
							$('#home_header_login_container').css({'-webkit-filter':'blur(6px)'},2000)
						});


						$('#hide_register_form').click(function(){
							$('#home_register_container').animate({marginLeft:'-550px'},100);
							$('#home_header_login_container').css({'-webkit-filter':'blur(0px)'},2000)
						});


						function readURL(input) {

    if (input.files && input.files[0]) {
        var reader = new FileReader();

        reader.onload = function (e) {
          $('#preview_uploaded_image').fadeIn(1000);
            $('#blah').attr('src', e.target.result);
        }

        reader.readAsDataURL(input.files[0]);
    }
}

$("#custom-file-input").change(function(){
    readURL(this);
});

	//Program a custom submit function for the form
$("form#home_post_image_form_form").submit(function(event){
 
  //disable the default form submission
  event.preventDefault();
 
  //grab all form data  
  var formData = new FormData($(this)[0]);
 
  $.ajax({
    url: 'php/upload_post.php',
    type: 'POST',
    data: formData,
    async: false,
    cache: false,
    contentType: false,
    processData: false,
    success: function (returndata) {
    	$('#post_image_result').fadeIn(1000);
     $('#post_image_result').html(returndata);
     $('form#home_post_image_form_form').val('');
     $('#preview_uploaded_image').fadeOut(1000);
     $("#info_refresh").show().delay(4000).fadeOut();
      
    }
  });
 
  return false;
});
		
		});


$(document).ready(function() {

    $("#update_posts").click(function(){
    	 $.ajax({    //create an ajax request to load_page.php
        type: "GET",
        url: "retrieve_posts.php",             
        dataType: "html",   //expect html to be returned                
        success: function(response){                    
            $(".home_all_posts_container").html(response); 
            //alert(response);
        }

    })
    });
});