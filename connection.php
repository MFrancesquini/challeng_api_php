<?php
   $host = "localhost";
   $user = "root";
   $password = "";
   $bd = "email";
   $mysql = new mysqli($host, $user, $password, $bd);
   if ($mysql->connect_errno)
      echo "Connection failed: (".$mysql->connect_errno.") ".$mysql->connect_error;
?>
