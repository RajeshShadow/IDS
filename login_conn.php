<?php 
include('../include/functions.php');

//require_once ('function/functions.php');
include('../include/config.php');

//$con = db_connect();
$username=mysqli_real_escape_string($obj,$_POST["username"]);
$password=SHA1(mysqli_real_escape_string($obj,$_POST["password"]));
if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
		$_SESSION['sess_msg']="The Validation code does not match!";// Captcha verification is incorrect.		
	}else{
    // Captcha verification is Correct. Final Code Execute here!		
		
$data_insert= "select * from admin where BINARY username='".$username."' && password='".$password."'";
$query=mysqli_query($obj,$data_insert);
$data=mysqli_fetch_assoc($query);
if(($data)==true){
     $randomtoken = md5(uniqid(rand(), true));

  session_set_cookie_params();   
session_start();
//$_SESSION['id']= $data['id'];
//$_SESSION['id'] = true;
  session_regenerate_id();
$_SESSION['sess_admin_id']=$data['id'];
$_SESSION['sess_admin_name']=$data['username'];	
$_SESSION['email']=$data['email'];
$_SESSION['csrfToken']=$randomtoken; 

       $_SESSION['sess_msg']='Login Successfull';
	   header("location:dashboard.php");
  // echo "<script type='text/javascript'>alert('Successfully login!');window.location=\"dashboard.php\";</script>";
} else{
   $_SESSION['sess_msg']='Sorry!!Invalid Credentials';
	   header("location:index.php");
}

}
 

?>

