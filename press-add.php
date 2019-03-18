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

         $name=htmlspecialchars(strip_tags(trim($_POST['name'])));
        
        $posted=strip_tags(trim($_POST['posted']));
  

if($_REQUEST['submitForm']=='yes')
{
     
   $fileinfo = getimagesize($_FILES["photo"]["tmp_name"]);
    $width = $fileinfo[0];
    $height = $fileinfo[1];
    $file_extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
    $allowed_image_extension = array(
        "pdf",
        "docx",
        "xml"
    );
    
  $Image=new SimpleImage();
    if($_FILES['photo']['size']>0 && $_FILES['photo']['error']=='')
    {
      if(in_array($file_extension, $allowed_image_extension)){
          
        
        
        $pdf=$_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'],"upload_images/doctrine/".$pdf);
        
      
      
       
        
    }
         else{
            echo "<script type='text/javascript'>alert('Document Format should be pdf,docx,xml!');window.location=\"press-list.php\";</script>";
        }
        
    }

    
	if($mid=='' )
	{
       if($pdf==true){
           
	   $sql="INSERT INTO press(title,pdf,posted_on,status,link) VALUES('$name','$pdf','$posted',1,'press-release.php')";
	  $qry=mysqli_query($obj,$sql);
     echo "<script type='text/javascript'>alert('Record added sucessfully');window.location=\"press-list.php\";</script>";
	
    }
        else{
        echo "<script type='text/javascript'>alert('Record Not Added');window.location=\"press-list.php\";</script>";
        }
    }
     if($mid !='')
	{
        
       $sql="update press set title='$name', posted_on='$posted' ,status=1";   
     
        if($pdf!=""){
	   $sql.=", pdf='$pdf'";
            move_uploaded_file($_FILES['photo']['tmp_name'],"upload_images/doctrine/".$pdf);
           
	   }
     
      
	    $sql.=" where id='$mid'";
       $qry=mysqli_query($obj,$sql);
    if($qry==true)
    {
        echo"<script>alert('Update Successfully')</script>";
        echo"<script>window.open('press-list.php','_self')</script>";
    }
    else
        {
        echo"<script>alert('Update not Changes')</script>";
         echo"<script>window.open('press-list.php','_self')</script>";
    }

    }}
if($mid!='')
{
	$sql= "SELECT * FROM press where id='$mid'";
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
      <input type="hidden" name="csrfToken" value="<?php echo $_SESSION['csrfToken']; ?>" />
  <input type="hidden" name="submitForm" value="yes" />
  <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
      <div class="heading">
      <div class="heading-left">Add Press Releases</div>
      <div class="heading-right"></div>
      <div class="clr"></div>
    </div>
     <div class="main-right-row">
       
             
       
  <p>
         <label><b>Title</b></label>
         <input type="text" name="name" id="title" value="<?php echo $data['title'];?>" >
        </p>        
       
          
        
           <p>
         <label>Posted on </label>
         <input type="text" name="posted" id="posted" class="datetimepicker1 calendar-icon" value="<?php echo $data['posted_on']; ?>" placeholder="YYYY-MM-DD"> (DD-MM-YYYY)
        </p>  
        <p>
         <label><b>Pdf</b></label>
           <input type="file" name="photo" id="heading" value="<?php echo $pdf ?>" >
            </p>
          <p>
         <label></label>
         <?php if($_REQUEST['id']!='')
      {
     ?>
      <td><a href="upload_images/doctrine/<?php echo  $data['pdf'];?>" target="_blank"><?php echo  $data['pdf'];?></a></td>
 
     <?php } ?>         
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