<?php
include('../include/config.php');
include('../include/functions.php');
include("../include/simpleimage.php");
validate_admin();
validateAdminSession();
if (isset($_GET['id']))
               {
            $mid=$_GET['id'];
            $id= base64_decode($mid);
}

$title=htmlspecialchars(strip_tags(trim($_POST['title'])));
$location=htmlspecialchars(strip_tags(trim($_POST['location'])));
$description=htmlspecialchars(strip_tags(trim($_POST['description'])));
$news_date = strip_tags(trim($_POST['news_date']));




if($_REQUEST['submitForm']=='yes')
{
	
	$file_extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
    $allowed_image_extension = array("png","jpg","jpeg");
	$Image=new SimpleImage();
    if($_FILES['photo']['size']>0 && $_FILES['photo']['error']=='' && substr_count($_FILES["photo"]["name"], '.') == 1)
    {
       
        if(in_array($file_extension, $allowed_image_extension)){
	    
	      $img=$_FILES['photo']['name'];
	      move_uploaded_file($_FILES['photo']['tmp_name'],"../images/".$img);
         
		 }
         else{
            echo "<script type='text/javascript'>alert('Image Format should be jpg,png,gif!');window.location=\"news-list.php\";</script>";
        }   
		  
	}

	if($_REQUEST['id']=='')
	{
		if($img==true){
	  $sql="INSERT INTO news SET title='$title', location='$location',link='news.php' description='$description', news_date='$news_date', image='$img', status=1";
	  $qry=mysqli_query($obj,$sql);
	  $_SESSION['sess_msg']='Record added sucessfully';
	  header("location:news-list.php");
	}}
    
	else
	{
		if($img!=""){
	  $sql="UPDATE news SET title='$title', location='$location', description='$description', news_date='$news_date', image='$img' where id='$id'";	  
	  	
	   $qry2= mysqli_query($obj,$sql2);
	   $_SESSION['sess_msg']='Record updated successfully';
	   header("location:news-list.php");
	}}
}
if($_REQUEST['id']!='')
{
	$sql= "SELECT * FROM news where id='$id'";
	$qry= mysqli_query($obj,$sql);
	$data= mysqli_fetch_array($qry);
}
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>HQIDS</title>
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
  <form name="frm" method="POST" enctype="multipart/form-data" action=" " onsubmit="return validate(this)">
       <input type="hidden" name="csrfToken" value="<?php echo $_SESSION['csrfToken']; ?>" />
  <input type="hidden" name="submitForm" value="yes" />
      <input type="hidden" name="csrfToken" value="<?php echo $_SESSION['csrfToken']; ?>" />
  <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
      <div class="heading">
      <div class="heading-left">Add News</div>
      <div class="heading-right"></div>
      <div class="clr"></div>
    </div>
      <div class="main-right-row">
        <p>
          <label>Title</label>
          <input name="title" id="title" type="text" value="<?php echo $data['title'];?>">
        </p> 
        <p>
          <label>Location</label>
          <input name="location" id="sub_title" type="text" value="<?php echo $data['location'];?>">
        </p> 
        <p>
         <label>News Date </label>
         <input type="text" name="news_date" id="news_date" class="datetimepicker1 calendar-icon" value="<?php echo $data['news_date'];?>" placeholder="YYYY-MM-DD"> (YYYY-MM-DD)
        </p> 
          
          
        
        <p>
          <label>Upload Image </label>
          <input name="photo" id="photo" type="file"> (Max width 590px)
        </p> 
        <p>
         <label></label>
         <?php if($_REQUEST['id']!='')
		  {
		 ?>
		  <img src="../images/<?php echo $data['image']; ?>"style="height:50px;width:100px;">	 
		 <?php } ?>         
        </p> 
        <br>
        <p>Description</p>
        <br>
        <p><textarea name="description" id="description" rows="4" class="ckeditor"  placeholder="Description Here..."><?php echo $data['description'];?></textarea>
        </p>     
        
      </div>
      
      <div><span><input type="submit" name="submit" value="Upload"></span> </div>
    </form>
  </div>
  <div class="clr"></div>
</section>
<?php include('includes/footer.php');?>
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