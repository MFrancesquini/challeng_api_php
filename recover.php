<?php
   include("connection.php");
   
   if (isset($_POST[ok])){
	   
	  $email = $mysql->escape_string($_POST['email']);
	  
	  //validating email
	  if (!filter_var($email, FILTER_VALIDATE_EMAIL)){
	     $err[] = "Sorry, it is not a valid e-mail.";
	  }
	  
	  $sql_code = "SELECT id, email, senha FROM users WHERE email='$email'";
      $sql_query = $mysql->query($sql_code) or die($mysql->error);
      $data = $sql_query->fetch_assoc();
      //return all users with this email
      $total = $sql_query->num_rows; 
	  
	  if ($total == 0){
		$err[] = "Sorry, the e-mail you entered in, does not exist in the database.";   
	  }
	  
	  if (count($err) == 0 && $total > 0) {	     	  
	   
         //using a trick, to get a 6 characters for a ciphred time 
         $newpassword = substr(md5(time()), 0, 6);
         $npciphred = md5($newpassword);
         //protect for sql injection - escape_string
      
      
         //for security, only if the password is sent to user, it is changed in database
         //if (mail($email, "Your new password", "This is you new password: ".$newpassword)){((
         if (1==1){
            $sql_code = "UPDATE users set senha = '$npciphred' WHERE email = '$email'";
            $sql_query = $mysql->query($sql_code) or die($mysql->error);
            
            if ($sql_query){
               $err[] = "Your password was changed.";
            }
         } else {
			 $err[] = "Sorry, your password was not changed..."; 
			 
		 }
         
      
      }
   }
 
?>
<!DOCTYPE html>
   <head></head>
   <body>
	  <?php
         if (count($err)>0)        
            foreach ($err as $msg) {
              echo "<p> $msg </p>";
            }
      ?>
      <form method="POST" action="">
         <input placeholder="Please write your e-mail" name="email" type="text">
         <input name="ok" value="ok" type="submit">
      </form> 
   </body>
