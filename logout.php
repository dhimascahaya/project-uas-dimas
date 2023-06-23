<?php  
session_start();
session_destroy();
header('location:login.php?silahkan_login=true');
?>
