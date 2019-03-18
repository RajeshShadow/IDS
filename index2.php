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
     
   
   <form action="login_conn.php" class="form-1" method="post">
     <div class="field">
       <input type="text" name="username" class="form-control" placeholder="username" required>
           <i class="icon-user icon-large"></i>
    <div class="field">
       <input type="password" name="password" class="form-control" placeholder="Password" autocomplete="off" required>
       <i class="icon-lock icon-large"></i>
     </div>
     </div>
    
     <div class="row">
       <div class="col-xs-8">
       </div>
       <!-- /.col -->
       <div class="col-xs-4">
         <button type="submit" class="btn btn-primary btn-block btn-flat">Sign In</button>
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
