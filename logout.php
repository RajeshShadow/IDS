<?php   
session_start(); 
$message=$_SESSION['sess_msg1'];//to ensure you are using same session
session_destroy(); //destroy the session
$_SESSION['sess_msg']='Logout Successfull';

header("location:index.php"); //to redirect back to "index.php" after logging out
exit();
?>