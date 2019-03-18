<?php 
include('../include/config.php');
include('../include/functions.php');
validate_admin();

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>IDS</title>
<link rel="shortcut icon" href="../favicon.ico">

<link rel="stylesheet" type="text/css" href="css/style.css" />
<script src="js/modernizr.custom.63321.js"></script>
<style type="text/css">body{ background: linear-gradient(#ffffff, #fdd2ef);height:662px;}</style>

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
<style>
.tooltip {
    /*position: relative;
    display: inline-block;
    border-bottom: 1px dotted black;*/
}

.tooltip .tooltiptext {
    visibility: hidden;
    width: 305px;
    background-color: #fde0f4;
    color: #f00;
    text-align: left;
    border-radius: 6px;
    padding: 5px;
    position: absolute;
    z-index: 1;
    margin-top: -48px;
    margin-left: 293px;
    line-height: 16px;
}

.tooltip:hover .tooltiptext {
    visibility: visible;
}
</style>
</head>

<body>

<section class="login">
 <div class="login-box" style="margin-bottom:10px;">
  <figure><img src="../images/logo-text.png" alt=""></figure>
 </div>
 <h4><span>IDS</span> Password Change</h4>
 <?php if($_SESSION['sess_msg1']){?>
  <span style="color:#F00; text-align:center; display:block; margin-top:10px; "><?php echo $_SESSION['sess_msg1'];$_SESSION['sess_msg1']='';?></span>
 <?php
 }
 ?>
   

   
   <form name="chngpwd"  action="" class="form-1" method="post" onsubmit="return valid();">
     <div class="field">
       <input type="password" name="opwd" id="opwd" class="form-control" placeholder="Old Password" required>
           <i class="icon-user icon-large"></i>
    <div class="field tooltip">
       <input type="password" name="npwd" data-placement="right" id="npwd" class="form-control"  data-toggle="tooltip" placeholder="New Password" autocomplete="off" maxlength="20" required pattern="(?=.*\d)(?=.*[a-z])(?=.*[A-Z]).{8,}">
       <i class="icon-lock icon-large"></i>
         <span class="tooltiptext">* Password must be at least 8 characters in length. * Password must use character types: lowercase letters, uppercase letters, numbers, and symbols.</span>
		 </div>
         <div class="field">
        <input type="password" name="cpwd" id="cpwd" class="form-control" placeholder="Confirm Password" autocomplete="off" required>
       <i class="icon-lock icon-large"></i>
     </div>
     <progress max="100" value="0" id="strength" style="width:230px; margin-bottom:10px;"></progress>
     </div>
    
     <div class="row">
       <div class="col-xs-8">
       </div>
       <!-- /.col -->
       <div class="col-xs-4">
         <!--<button type="submit" class="btn btn-primary btn-block btn-flat">Change Password</button>-->
           <input type="submit" name="Submit" value="Change Password" class="btn btn-primary btn-block btn-flat">
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
session_start();
//include("dbconnection.php");
if(isset($_POST['Submit']))
{
$oldpass=SHA1(mysqli_real_escape_string($obj,$_POST['opwd']));
$useremail=$_SESSION['sess_admin_name'];
   
$newpassword=SHA1(mysqli_real_escape_string($obj,$_POST['npwd']));



$sql="SELECT password FROM admin where password='$oldpass' && username='$useremail'";
$result=mysqli_query($obj,$sql);
$num=mysqli_fetch_array($result);
    
if($num==true)
{
$sql="update admin set password='$newpassword'";
$con=mysqli_query($obj,$sql);
    
//echo"Password Changed Successfully !!";
    
     $_SESSION['sess_msg1']='Password Changed Successfull';
        
	   header("location:index.php");
    session_destroy();
}
else
{
//echo "Old Password not match !!";
    $_SESSION['sess_msg1']='Old Password not match !!';
	   header("location:change.php");
}
}
?>







<script type="text/javascript">
function valid()
{
if(document.chngpwd.opwd.value=="")
{
alert("Old Password Filed is Empty !!");
document.chngpwd.opwd.focus();
return false;
}
else if(document.chngpwd.npwd.value=="" && document.chngpwd.npwd.value>=50)
{
alert("New Password Filed is Empty !!");
document.chngpwd.npwd.focus();
return false;
}
else if(document.chngpwd.cpwd.value=="")
{
alert("Confirm Password Filed is Empty !!");
document.chngpwd.cpwd.focus();
return false;
}
else if(document.chngpwd.npwd.value!= document.chngpwd.cpwd.value)
{
alert("Password and Confirm Password Field do not match  !!");
document.chngpwd.cpwd.focus();
return false;
}
return true;
}
</script>

<script type="text/javascript" >
var pass = document.getElementById("npwd")
pass.addEventListener('keyup',function(){
              checkPassword(pass.value)        
                      
    })
    function checkPassword(password){
        
        var strengthBar = document.getElementById("strength")
        var strength = 0;
        if(password.match(/[a-zA-Z0-9][a-zA-Z0-9]+/)){
            
            strength +=1
        }
        
        if (password.match(/[~<>?]+/)){
            strength +=1
        }
        
        if(password.match(/[!@#$%^&*()]+/)){
             strength +=1
        }
        
        if(password.length > 5){
            strength +=1
        }
        switch(strength){
            case 0:
                strengthBar.value = 20;
                break
            
            case 1:
                 strengthBar.value = 40;
                  break
            case 2:
                 strengthBar.value = 60;
                  break
            case 3:
                 strengthBar.value = 80;
                  break
                  
            case 4:
                 strengthBar.value = 100;
                  break
            
                
        }
    
    }




</script>
<script>
$(document).ready(function(){
    $('[data-toggle="tooltip"]').tooltip();   
});
</script>