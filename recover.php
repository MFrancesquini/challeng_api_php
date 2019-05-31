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
         if (mail($email, "Your new password", "This is you new password: ".$newpassword)){((
         //if (1==1){
            $sql_code = "UPDATE users set senha = '$npciphred' WHERE email = '$email'";
            $sql_query = $mysql->query($sql_code) or die($mysql->error);

            if ($sql_query){
               $err[] = "We sent you an e-mail with the new password.";
            }
         } else {
			 $err[] = "Sorry, your password was not changed.";

		 }


      }
   }

?>
<!DOCTYPE html>
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Recover password</title>

    <!-- Some Basic bootstrap -->
    <link href="css/bootstrap.min.css" rel="stylesheet">



    <link href="css/sb-admin-2.css" rel="stylesheet">



</head>
   <body>
   <div class="container">
        <div class="row">
            <div class="col-md-4 col-md-offset-4">
                <div class="login-panel panel panel-default">
                    <div class="panel-heading">
                        <h3 class="panel-title">Password Recover</h3>
                    </div>
                    <div class="panel-body">
                        <?php
                        if(isset($err))
                            if(count($err) > 0){ ?>
                                <div class="alert alert-danger">
                                    <?php foreach($err as $msg) echo "$msg <br>"; ?>
                                </div>
                            <?php
                            }
                            ?>
                        <form method="post" action="" role="form">
	                       <fieldset>
                              <div class="form-group">
                                 <form method="POST" action="">
                                    <input placeholder="Write your e-mail, please." name="email" type="text" class="form-control">
                                    <input name="ok" value="ok" type="submit" class="btn btn-success btn-block">
                                 </form>
                              </div>
                           </fieldset>
                         </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
