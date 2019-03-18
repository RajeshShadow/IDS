<?php
include('../include/config.php');
include('../include/functions.php');
include("../include/simpleimage.php");
validate_admin();
if (isset($_GET['id']))
               {
            $id=$_GET['id'];
            $mid= base64_decode($id);
}
          
         $name=strip_tags(trim($_POST['name']));
         $url=strip_tags(trim($_POST['url']));
          
       
  

if($_REQUEST['submitForm']=='yes')
{
     
  
	if($mid=='' )
	{
       
           
	   $sql="INSERT INTO video(title,url,status,link) VALUES('$name','$url',1,'video.php')";
	  $qry=mysqli_query($obj,$sql);
        
        if($qry==true){
     echo "<script type='text/javascript'>alert('Record added sucessfully');window.location=\"download-list.php\";</script>";
	
        }
        else{
        echo "<script type='text/javascript'>alert('Record Not Added');window.location=\"download-list.php\";</script>";
        }
    }
     if($mid !='')
	{
       
       $sql="update video set title='$name',url='$url', status=1";   
       $sql.=" where id='$mid'";
       $qry=mysqli_query($obj,$sql);
    if($qry==true)
    {
        echo"<script>alert('Update Successfully')</script>";
        echo"<script>window.open('download-list.php','_self')</script>";
    }
    else
        {
        echo"<script>alert('Update not Changes')</script>";
         echo"<script>window.open('download-list.php','_self')</script>";
    }

    }}
if($mid!='')
{
	$sql= "SELECT * FROM video where id='$mid'";
	$qry= mysqli_query($obj,$sql);
	$data= mysqli_fetch_array($qry);
    
    
}




?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>IDS</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="js/jquery-2.2.1.min.js"></script>
<link href="date-time-picker/css/jquery.datetimepicker.css" rel="stylesheet" type="text/css">
<script type="text/javascript" src="../include/ckeditor/ckeditor.js"></script>
</head>

<body>
<?php include('includes/header.php'); ?>
<?php include('includes/menu.php'); ?>
<section class="main">
  <div class="main-right">
  <form name="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
  <input type="hidden" name="submitForm" value="yes" />
      <input type="hidden" name="csrfToken" value="<?php echo $_SESSION['csrfToken']; ?>" />
  <input type="hidden" name="id" value="<?php echo $mid;?>" />
      <div class="heading">
      <div class="heading-left">Add Videos</div>
      <div class="heading-right"></div>
      <div class="clr"></div>
    </div>
     <div class="main-right-row">
       
             
       
  <p>
         <label><b>Title</b></label>
         <input type="text" name="name" id="title" value="<?php echo $data['title'];?>" >
        </p>        
       
         
        <p>
         <label><b>Video Link</b></label>
           <input type="text" name="url" id="heading" value="<?php echo $data['url']; ?>" >
            </p>
                  
        
          
        
        
         
          
            
               
          
         
      </div>
      
      <div><span><input type="submit" name="submit" value="Save"></span> </div>
    </form>
      
  </div>
  <div class="clr"></div>
</section>
<?php include('includes/footer.php'); ?>
   <script src="date-time-picker/js/jquery.datetimepicker.js"></script>
<script>
jQuery('.datetimepicker1').datetimepicker({
 lang:'en',
 i18n:{
  en:{
   months:[
    'January','February','March','April',
    'May','June','July','August',
    'September','October','November','December',
   ],
   dayOfWeek:[
    "Su.", "Mo", "Tu", "We", 
    "Th", "Fr", "Sa.",
   ]
  }
 },
 timepicker:false,
 format:'Y-m-d'
  
});
 
</script>
</body>
</html>