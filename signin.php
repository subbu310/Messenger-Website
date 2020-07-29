<?php

 error_reporting(0);
 
 include('connect.php');
 
 session_start();
 
 if(isset($_POST['submit'])){
	
    $email = $_POST['email'];
	
	$password = $_POST['password'];
	
	if(empty($email)|| empty($password)){
		
	  $message = '<h6>'.'Plss fill all the feilds'.'</h6>';	
		
	}else{
		
		$sql ="SELECT * FROM `user` WHERE `email`='$email'AND `password`='$password'";
		
		$result = mysqli_query($conn, $sql);
		
		if(mysqli_num_rows($result)>0){
			
			while($row = mysqli_fetch_assoc($result)){
				
				$_SESSION['user_id'] = $row['user_id'];
				
				header('location:messenger.php');
				
				$message = '<h6>'.'Sign in success'.'</h6>';	
			
			}
			 
		}else{
			
			$message = '<h6>'.'Email and Password doesnt match'.'</h6>';	
				 
		}
	}
 }

?>

<!DOCTYPE html>
<html>
<head>
   
 <title>Messenger Sign In form </title>
   
 <meta name="viewport" content="width=device-width, initial-scale=1">
 <!----add icon link----> 
  
<link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.0/css/all.css" integrity="sha384-lZN37f5QGtY3VHgisS14W3ExzMWZxybE1SJSEsQp9S+oqd12jhcu+A56Ebc1zFSJ" crossorigin="anonymous">
 
 <style>
  *{
	  margin:0;
	  padding:0;
	  box-sizing:border-box;
  }
  .container{
	  
	  width:100%;
	  height:100%;
  }
  .signup-top-nav{
	  
	  width:100%;
	  max-width:1000px;
	  margin:auto;
	  height:100px;
	  display:flex;
	  justify-content:center;
	  align-items:center;
  }
  .signup-top-nav-icon{
	  
	  flex:1;
  }
  .signup-top-nav-text{
	  
	  flex:1;
	  display:flex;
	  justify-content:space-between;
	  align-items:center;
	  color:#aaa;
	  font-size:20px;
  }
  .signup-top-nav-icon img{
	
	 width:40px;
	 height:40px;
  }
  
  .signup-container{
	  
	  width:100%;
	  max-width:1000px;
	  margin:auto;
	  height:100%;
	  display:flex;
	  justify-content:center;
	  margin-top:50px;
  }
  .signup-text{
	  
	  flex:1;
  }
  .signup-icon{
	  
	  flex:1;
  }
  .signup-icon-image{
	
	 width:100%;
	 
  }
  .signup-icon-image img{
	
	 width:100%;
	 
  }
  .signup-text-inside{
	  
	  width:60%;
	  height:100%;
  }
  .signup-text-inside p{
	
	 font-size:30px;
	 margin-bottom:15px;
  }
  .signup-text-inside a{
	
	 font-size:20px;
	 color:#aaa;
  }
  .signup-text-inside input[type=email],[type=text],[type=password]{
	
	width:100%;
	padding:15px;
	background-color:#eee;
	font-size:17px;
	border:none;
	margin-top:10px;
	border-radius:10px;
  }
  .signup-text-inside button{
	
	width:100px;
	padding:10px;
	background-color:#0084ff;
	font-size:17px;
	border:none;
	margin-top:15px;
	border-radius:30px;
	color:white;
	cursor:pointer;
	font-weight:bold;
  }
  .signup-text-inside .link-account{
	  
	  font-size:20px;
	  margin-top:10px;
  }
  h6{
	  
	font-size:20px;
	margin-top:10px;
    color:red;	
  }
 </style>
 
 <body>
 
  	<div class="container">
	
	   <div class="signup-top-nav">
	
	       <div class="signup-top-nav-icon">
	
	          <img src="icon/messenger.png"/>
			  
	       </div>
		   
		    <div class="signup-top-nav-text">
	          
			  <a>Rooms</a>
			 
			 <a>Features</a>
			 
			 <a>Privacy & safety</a>
			 
			 <a>For developers</a>
	
	      </div>
		  
	   </div>
	   
	   <div class="signup-container">
	
	       <div class="signup-text">
	          
			  <div class="signup-text-inside">
	            
				<form action="" method="post" >
	
	            <p><b>Be together, <br/> whenever.</b></p>
			   
			    <a>A simple way to text, video chat and plan things all in one place.</a>
			    
				  <?php echo $message; ?>
				  
				<input type="email" name="email" placeholder="Email address or phone number" />
				
				<input type="password" name="password" placeholder="Password" />
				
				<button type="submit" name="submit">Sign In </button>
				
				</form>
				
				<p class="link-account">Don't have an account? <a href="signup.php" style="text-decoration:none; color:#0084ff;">Sign Up</a></p>
				
				
			  </div>
			   
	       </div>
		   
		    <div class="signup-icon">
	        
               <div class="signup-icon-image">
	        			
			      <img src="icon/logo.jpg"/>
				  
			   </div>  
	
	       </div>
		  
	   </div>
	  
	</div>
	
 </body>
 
</html>



