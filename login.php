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
         //using javascript to access success page
         echo "<script>alert('Success login'); location.href='sucess.php';</script>";
      }
   }
?>
<html>
   <head></head>
   <body>
      <?php
         if (count($err)>0)

            foreach ($err as $msg) {
              echo "<p> $msg </p>";
            }
      ?>
      <form method="POST" action="">
        <p><input value="" name="name" type="text" placeholder="Please, write your name"></p>
        <p><input value="<?php echo $_SESSION['email']; ?>" name="email" type="text" placeholder="Please, write your e-mail"></p>
        <p><input name="senha" type="password"></p>
        <p><a href="recover.php" target="_blank">Recover your password</a></p>
        <p><input value="Enter" type="submit"></p>
      </form>
   </body>
</html>
