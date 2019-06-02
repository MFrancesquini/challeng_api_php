<?php
   session_start();
   unset($_SESSION['user']);
?>
<script>alert("Thank you");</script>
<script>location.href='login.php';</script>