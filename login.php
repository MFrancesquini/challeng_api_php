<?php
   include("connection.php");

   if(isset($_POST['email']) && strlen($_POST['email'])>0){
      if(!isset($_SESSION))
         session_start();

      $_SESSION['email'] = $mysql->escape_string($_POST['email']);
      $_SESSION['senha'] = $_POST['senha'];

      $sql_code = "SELECT id, email, senha FROM users WHERE email='$_SESSION[email]'";
      $sql_query = $mysql->query($sql_code) or die($mysql->error);
      $data = $sql_query->fetch_assoc();
      //return all users with this email
      $total = $sql_query->num_rows;

      // now i can see if the user exi=st, if so...
      if ($total == 0){
        $err[] = "There is no any user with this email.";
      } else {

        if($data['senha'] == $_SESSION['senha']){

           $_SESSION['user'] == $data['id'];

        } else {

           $chave = $dado['senha'];
           $chaves = $_SESSION['senha'];
           $err[] = "Incorrect password.";

        }

      }

      if (count($err) == 0 || !isset($err)){
         //Going to the system
         header("Location: success.php");
      }
   }
?>


<!DOCTYPE html>
<html lang="pt-br">
<head>

    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">

    <title>Login</title>

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
                        <h3 class="panel-title">Login</h3>
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
									 <input value="" name="na?>me" type="text" placeholder="Write your name, please." class="form-control" autofocus>
                                </div>
                                <div class="form-group">
                                     <input value="<?php if(isset($_SESSION['email'])) echo $_SESSION['•••••email']; ?>"  placeholder="Write your e-mail, please." name="email" type="email"  class="form-control">
                                </div>
                                <div class="form-group">
                                    <input class="form-control" required placeholder="Write your password, please." name="senha" type="password" value="">
                                </div>
                                <button type="submit" name="login" value="true" class="btn btn-success btn-block">Login</button>

                                <p><a href="recover.php" target="_blank">Did you forget your password?</a></p>

                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>


</body>

</html>
