<?php
include('../include/config.php');
include('../include/functions.php');
include("../include/simpleimage.php");
validate_admin();

$position=htmlspecialchars(strip_tags(trim($_POST['position'])));
$title=htmlspecialchars(strip_tags(trim($_POST['title'])));


  

if($_REQUEST['submitForm']=='yes')
{
   $fileinfo = getimagesize($_FILES["photo"]["tmp_name"]);
    $width = $fileinfo[0];
    $height = $fileinfo[1];
    $file_extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
    $allowed_image_extension = array(
        "png",
        "jpg",
        "jpeg"
    );
    
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

	if($_REQUEST['id']=='' )
	{
       if($img==true){
	  $sql="INSERT INTO  banner (img,status,position,title,link) VALUES('$img',1,'$position','$title','index.php')";
	  $qry=mysqli_query($obj,$sql);
     echo "<script type='text/javascript'>alert('Record added sucessfully');window.location=\"banner-list.php\";</script>";
	  /*$_SESSION['sess_msg']='Record added sucessfully';
	  header("location:related_links-list.php");*/
	
    }
        else{
        echo "<script type='text/javascript'>alert('Record Not Added');window.location=\"banner-list.php\";</script>";
        }
    }
   
}

?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title>IDS</title>
<link href="css/style.css" rel="stylesheet" type="text/css">
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
  <input type="hidden" name="id" value="<?php echo $_REQUEST['id'];?>" />
      <div class="heading">
      <div class="heading-left">Add Banners</div>
      <div class="heading-right"></div>
      <div class="clr"></div>
    </div>
      <div class="main-right-row">
        <p>
          <label>Title</label>
          <input type="text" name="title" id="title" value="<?php echo $data['links'];?>">
        </p><p>
          <label>Position</label>
          <input type="text" name="position" id="title" value="<?php echo $data['links'];?>">
        </p>
        
          
           <p>
          <label>Upload Image (Size 1400px × 425px) (Format :jpg, png, gif )</label>
          <input name="photo" id="photo" type="file"> (Width 1400px :: Height 425px)
        </p> 
        <p>
         <label></label>
         <?php if($_REQUEST['id']!='')
      {
     ?>
      <img src="upload_images/banner/<?php echo $data['image']; ?>">  
     <?php } ?>         
        </p>      
           
        
      </div>
      
      <div><span><input type="submit" name="submit" value="Save"></span> </div>
    </form>
      
  </div>
  <div class="clr"></div>
</section>
<?php include('includes/footer.php'); ?>
</body>
</html>
