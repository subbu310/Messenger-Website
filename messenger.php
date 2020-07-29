<?php

 error_reporting(0);
 
 include('connect.php');
 
 session_start();
 
 if(!isset($_SESSION['user_id'])){
	
    header('location:signin.php');
				
 }else{
	 
	 
 }

?>

<!DOCTYPE html>
<html>
<head>
   
 <title>Messenger Home</title>
   
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!----add icon link----> 
  
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
 
 <!----add jquery link----> 
 <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
   
 <link rel="stylesheet" href="messenger.css">
 
 <script src="messenger.js"></script>

 <style>
  
  
 </style>
 
 <body>
   
   <div class="messenger-container">
   
       <div class="messenger-left">
   
            <div class="messenger-left-top-nav">
                
				<div class="messenger-nav-top-image">
   
                     
				   
                </div>
				
				<div class="messenger-nav-top-name">
   
                     <a><b>Chats</b></a>
					 
                </div>
				
				<div class="messenger-nav-top-icon">
                   
				   <div class="messenger-nav-icon-round">
   
                      <div class="messenger-nav-icon">
   
                          <img class="setting" src="icon/settings.png" />
						  
						  <div class="messenger-setting">
						    
							  <div class="messenger-setting-text">
						       
							     <a>Settings</a>
								 
						      </div>
							  
							   <div class="messenger-setting-contact">
 
                                   <a>Active contacts</a>
							
							       <a>Message requests</a>
							
							       <a>Hidden chats</a>
							
							       <a>Unread Chats</a>
							
                                </div>
					  
					          <div class="messenger-setting-about">
 
                                  <a>About</a>
							
							      <a>Terms</a>
							
							     <a>Privacy Policy</a>
							
							     <a>Cookie Policy</a>
							
                             </div>
					  
					        <div class="messenger-setting-help">
 
                               <a>Help</a>
							
							   <a>Report a problem</a>
							
                             </div>
					  
					        <div class="messenger-setting-logout">
 
                               <a href="signout.php">Log Out</a>
							
                             </div>
					      
						  </div>
						  
                     </div>
					 
				    </div> 
					 
                </div>
				
				<div class="messenger-nav-top-icon">
                  
				   <div class="messenger-nav-icon-round">
   
                      <div class="messenger-nav-icon">
   
                          <img src="icon/cam_add.png" />
					   
                     </div>
					 
				    </div> 
          
                </div>
				
				<div class="messenger-nav-top-icon">
                     
					 <div class="messenger-nav-icon-round">
   
                       <div class="messenger-nav-icon">
   
                          <img src="icon/edit.png" />
					   
                       </div>
					 
				    </div> 
          
                </div>
          
            </div>
			
			<div class="messenger-search-container">
                
				<div class="messenger-search-icon">
   
                    <div class="messenger-search-image">
   
                          <img src="icon/search.png" />
					   
                    </div>
					   
                </div>
				
				<div class="messenger-search-input">
   
                    <div class="messenger-search-input-inside">
   
                          <input type="text" name="search" id="search-users" placeholder="Search Messenger" />
					   
                    </div>
					
                </div>
                          
            </div>
			
			<div class="messenger-user-container">
                
				
                          
            </div>
			
			<div class="messenger-user-search-container">
                
				
                          
            </div>
		   
      </div>
	  
	  <div class="messenger-right">
   
          
     </div>
   
   </div>
  	
 </body>
 
</html>



