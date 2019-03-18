<?php 
include('../include/config.php');
include('../include/functions.php');
if($_session['sess_admin_id']!='')
{
header('location:membership_type-list.php');
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>IDS</title>
<link rel="shortcut icon" href="../favicon.ico">

<link rel="stylesheet" type="text/css" href="css/style.css" />
<link href="css/captcha.css" rel="stylesheet">
<script src="js/modernizr.custom.63321.js"></script>
<style type="text/css">body{ background: linear-gradient(#ffffff, #fdd2ef);height:650px;}</style>
<script type="text/javascript">
function LoginValidate(obj)
 {
if(obj.username.value=='')
{
   alert("Please Enter User Name");
   obj.username.focus();
   return false;
}
if(obj.password.value=='')
{
alert("Please Enter Password");
obj.password.focus();
return false;
}
 }
</script>
    <script type='text/javascript'>
function refreshCaptcha(){
	var img = document.images['captchaimg'];
	img.src = img.src.substring(0,img.src.lastIndexOf("?"))+"?rand="+Math.random()*1000;
}
</script>
</head>

<body>

<section class="login">
 <div class="login-box" style="margin-bottom:10px;">
  <figure><img src="../images/logo-text.png" alt=""></figure>
 </div>
 <h4><span>IDS</span> Admin Login</h4>
 <?php if($_SESSION['sess_msg']){?>
  <span style="color:#F00; text-align:center; display:block; margin-top:10px; "><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></span>
 <?php
 }
 ?>
    <?php if($_SESSION['sess_msgcap']){?>
  <span style="color:#F00; text-align:center; display:block; margin-top:10px; "><?php echo $_SESSION['sess_msgcap'];$_SESSION['sess_msgcap']='';?></span>
 <?php
 }
 ?>
     
   
   <form action="" class="form-1" method="post">
       <?php if(isset($msg)){?>
    
      
   <div class='alert alert-danger'> <strong>sorry</strong><?php echo $msg;?> </div>
    
    <?php } ?>
     <div class="field">
       <input type="text" name="username" class="form-control" placeholder="username" required>
           <i class="icon-user icon-large"></i>
         </div>
    <div class="field">
       <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
       <i class="icon-lock icon-large"></i>
     </div>
         
         <div class="field">
       <img src="captcha.php?rand=<?php echo rand();?>" id='captchaimg'><br>
        <label for='message'>Enter the code above here :</label>
         </div>
         
         <div class="field">
        <input id="captcha_code" class="form-control" name="captcha_code" type="text" required>
             <i class="icon-lock icon-large" style="top: 30px;"></i>
             </div>
        
        Can't read the image? click <a href='javascript: refreshCaptcha();'>here</a> to refresh.<br><br>
       
         
     
    
     <div class="row">
       <div class="col-xs-8">
       </div>
       <!-- /.col -->
       <div class="col-xs-4">
         <input type="submit" name="submit" class="btn btn-primary btn-block btn-flat" value="Sign In">
       </div>
       <!-- /.col -->
     </div>
   </form>
   
<!-- <form name="login" class="form-1" method="post" action="login.php" onSubmit="return LoginValidate(this);">
 <input type="hidden" name="logged" value="yes">
 <input type="hidden" name="back" value="<?php echo $_REQUEST['back']; ?>">
Binit • Now

	<p class="field"><input type="text" name="username" id="username" placeholder="Username"><i class="icon-user icon-large"></i></p>
	<p class="field"><input type="password" name="password" id="password" placeholder="Password"><i class="icon-lock icon-large"></i></p>
	<p class="submit"><button type="submit" name="submit"><i class="icon-arrow-right icon-large"></i></button></p>
  </form>-->
    
</section>

</body>
</html>
<?php
if(isset($_POST['submit'])){
$username=mysqli_real_escape_string($obj,$_POST["username"]);
$password=SHA1(mysqli_real_escape_string($obj,$_POST["password"]));
    
    
if(empty($_SESSION['captcha_code'] ) || strcasecmp($_SESSION['captcha_code'], $_POST['captcha_code']) != 0){  
    //$msg="<span style='color:red'>The Validation code does not match!</span>";// Captcha verification is incorrect. 
    $_SESSION['sess_msgcap']='Sorry!!The Validation code does not match!';
	   header("location:index.php");
  }
    else{
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
 



}
?>