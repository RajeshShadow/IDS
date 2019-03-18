<?php
include('../include/config.php');
include('../include/functions.php');
include("../include/simpleimage.php");
validate_admin(); 

?>

<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo SITE_TITLE; ?></title>
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
      
  <form name="frm" method="POST" enctype="multipart/form-data" action="" >
 
<?php
if(isset($_GET['id']))
    
{
                $mid=$_GET['id'];
            $id= base64_decode($mid);
     $query="select *from banner where id='$id'";
        $run= mysqli_query($obj, $query);
        while ($data=mysqli_fetch_array($run)) { 
             $id=$data['id'];
            $img=$data['img'];
            $title=$data['title'];
            $status=$data['status'];
            

        ?>
      
      <input type="hidden" name="submitForm" value="yes" />
      <input type="hidden" name="csrfToken" value="<?php echo $_SESSION['csrfToken']; ?>" />
  <input type="hidden" name="id" value="<?php echo $id; ?>" />
      <div class="heading">
      <div class="heading-left">Add Banner</div>
      <div class="heading-right"></div>
      <div class="clr"></div>
    </div>
      <div class="main-right-row">
         
        <p>
          <label>Upload Image </label>
          <input type="file" name="photo" value="<?php echo $data['img']; ?>"> (Size 1400px × 425px)
             <?php if($_REQUEST['id']!='')
      {
     ?>
      <img src="upload_images/banner/<?php echo $data['img']; ?>" style="height:50px;width:100px;">  
     <?php } ?>  
        </p>
         
        <br>
           <p>        
              <label>Title</label>   
              <input type="text" name="title" id="position"  value="<?php echo $data['title'];?>">    
          </p> <p>        
              <label>Position</label>   
              <input type="text" name="position" id="position"  value="<?php echo $data['position'];?>">    
          </p>  
        
      </div>
      <?php }} ?>
      <div><span><input type="submit" name="update" value="Update"></span> </div>
    </form>
  </div>
  <div class="clr"></div>
</section>
    

<?php
    
  if(isset($_POST['update']))
    {
        $id=strip_tags(trim($_POST['id']));
       $position=strip_tags(trim($_POST['position']));
       $fileinfo = getimagesize($_FILES["photo"]["tmp_name"]);
       $width = $fileinfo[0];
       $height = $fileinfo[1];
       $file_extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
       $allowed_image_extension = array("png","jpg","jpeg");
    
      $Image=new SimpleImage();
    if($_FILES['photo']['size']>0 && $_FILES['photo']['error']=='' && substr_count($_FILES["photo"]["name"], '.') == 1)
    {
      if(in_array($file_extension, $allowed_image_extension)){
          
       
        
         $img=$_FILES['photo']['name'];
        move_uploaded_file($_FILES['photo']['tmp_name'],"upload_images/banner/".$img);
         
       $Image->load("upload_images/banner/".$img);
        $Image->resize(1349,420);
        $Image->save("upload_images/banner/".$img);
      
      
      
        
    }
         else{
            echo "<script type='text/javascript'>alert('Image Format should be jpg,png,gif!');window.location=\"banner-list.php\";</script>";
        }
        
    }

	
	if($img!="" && $img==true){
	  $sql="UPDATE banner SET  position='$position',status=1, img='$img' where id='$id'";
      $qry=mysqli_query($obj,$sql);
   
    if($qry)
    {
        echo"<script>alert('Update Successfully')</script>";
        echo"<script>window.open('banner-list.php','_self')</script>";
    }}
    else
        {
        echo"<script>alert('Update not Changes')</script>";
         echo"<script>window.open('banner-list.php','_self')</script>";
    }

    }
?>

    
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
 format:'d-M-Y'
});
</script>
</body>
</html>