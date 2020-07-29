<?php

 error_reporting(0);
 
 include('connect.php');
 
 session_start();
 
 session_unset();
 
 header('location:signin.php');
	
 ?>