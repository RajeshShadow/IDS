<?php
include('../include/config.php');
include('../include/functions.php');
include("../include/simpleimage.php");
validate_admin();
if (isset($_GET['id']))
               {
            $mid=$_GET['id'];
            $id= base64_decode($mid);
}

$title=htmlspecialchars(strip_tags(trim($_POST['title'])));
$location=htmlspecialchars(strip_tags(trim($_POST['location'])));
/*$description=htmlspecialchars(strip_tags(trim($_POST['description'])));*/
$description=$_POST['description'];
$start_date=strip_tags(trim($_POST['start_date']));
$end_date=strip_tags(trim($_POST['end_date']));
$event_time=strip_tags(trim($_POST['event_time']));
$map=strip_tags(trim($_POST['map']));




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
	  $sql="INSERT INTO events SET title='$title', location='$location', description='$description', start_date='$start_date', end_date='$end_date',event_time='$event_time',map='$map',banner='$img', status=1,link='events.php'";
	  $qry=mysqli_query($obj,$sql);
	  echo "<script type='text/javascript'>alert('Record added sucessfully');window.location=\"events-list.php\";</script>";
	}}
    
	 if($_REQUEST['id']!='')
	{
		if($img!=""){
	  $sql2="UPDATE events SET title='$title', location='$location', description='$description', start_date='$start_date', end_date='$end_date',event_time='$event_time',map='$map',banner='$img' where id='$id'";	  
	  	
	   $qry2= mysqli_query($obj,$sql2);
            if($qry2==true){
	   echo "<script type='text/javascript'>alert('Record  added sucessfully');window.location=\"events-list.php\";</script>";}
            else{
                echo "<script type='text/javascript'>alert('Record Not  added sucessfully');window.location=\"events-list.php\";</script>";
            }
	}}
}
if($_REQUEST['id']!='')
{
	$sql= "SELECT * FROM events where id='$id'";
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
		 <label>Map</label>
         <textarea name="map" id="map" rows="4"   placeholder="Map without Iframe" value="<?php echo $data['map'];?>"></textarea>
        </p>
          
        <p>
         <label>Start Date </label>
         <input type="text" name="start_date" id="news_date" class="datetimepicker1 calendar-icon" value="<?php echo $data['start_date'];?>" placeholder="YYYY-MM-DD"> (YYYY-MM-DD)
        </p> 
        <p>
         <label>End Date </label>
         <input type="text" name="end_date" id="news_date" class="datetimepicker1 calendar-icon" value="<?php echo $data['end_date'];?>" placeholder="YYYY-MM-DD"> (YYYY-MM-DD)
        </p>
          
          <p>
         <label>Event Time </label>
         <input type="text" name="event_time" id="event_time"  value="<?php echo $data['event_time'];?>" placeholder="HH:MMPM to HH:MMPM"> ( HH:MMPM to HH:MMPM)
        </p>
         
        <p>
          <label>Upload Banner </label>
          <input name="photo" id="photo" type="file"> (Max width 590px)
        </p> 
        <p>
         <label></label>
         <?php if($_REQUEST['id']!='')
		  {
		 ?>
		  <img src="../images/<?php echo $data['banner']; ?>"style="height:50px;width:100px;">	 
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