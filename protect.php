<?php
   if(!function_exists("protect")){
	   function protect(){
	      if (!isset($_SESSION))
	         session_start();
	      //verifing if user is logged - from login.php   
	      if (!isset($_SESSION['user']) || !is_numeric($_SESSION['user'])){
			  header("Location: login.php");
			  }    
	   }
   }
?>
