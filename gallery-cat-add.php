<?php
include('../include/config.php');
include('../include/functions.php');
include("../include/simpleimage.php");
validate_admin();

$title=strip_tags(trim($_POST['title']));

if($_REQUEST['submitForm']=='yes')
{
    $file_extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
    $allowed_image_extension = array("png","jpg","JPG","JPEG","jpeg");
	$Image=new SimpleImage();
    
   // $condition = substr_count($_FILES["photo"]["name"], '.') > 1 ;
       
    if($_FILES['photo']['size']>0 && $_FILES['photo']['error']=='' && substr_count($_FILES["photo"]["name"], '.') == 1)
    {
       
        if(in_array($file_extension, $allowed_image_extension) ){
	    
	      $img=$_FILES['photo']['name'];
            
     
	      move_uploaded_file($_FILES['photo']['tmp_name'],"../images/".$img);
        }
		 
         else{
            echo "<script type='text/javascript'>alert('Image Format should be jpg,png,gif!');window.location=\"gallery-cat-list.php\";</script>";
        }   
		  
        
    }
	if($_REQUEST['id']=='')
	{
        if($img==true){
	  $sql="INSERT INTO gallery_cat SET title='$title',link='gallery.php', image='$img', status=1";
	  $qry=mysqli_query($obj,$sql);
	  $_SESSION['sess_msg']='Record added sucessfully';
	  header("location:gallery-cat-list.php");
	
    }}
    if($_REQUEST['id']!='')
	{
           
	  $sql="UPDATE gallery_cat SET title='$title' ";  
            if($img!=""){
             
	   $sql.=", image='$img'";
             move_uploaded_file($_FILES['photo']['tmp_name'],"../images/".$img);
           
	   }
     
      
	    $sql.=" where id='".$_REQUEST['id']."'";
	   $qry= mysqli_query($obj,$sql);
	 
       $_SESSION['sess_msg']='Record updated successfully';
	   header("location:gallery-cat-list.php");
	}
}
if($_REQUEST['id']!='')
{
	$sql= "SELECT * FROM gallery_cat where id='".$_REQUEST['id']."'";
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
      <div class="heading-left">Add Gallery Categories</div>
      <div class="heading-right"><!--<span><input type="submit" name="submit" value="Save"></span>--> </div>
      <div class="clr"></div>
    </div>
      <div class="main-right-row">
        <p>
          <label>Gallery Categories Name</label>
          <input type="text" name="title" id="title" value="<?php echo $data['title'];?>">
        </p>
        <p>
          <label>Upload Image</label>
          <input name="photo" id="photo" type="file" value="<?php echo $data['image'];?>"> (Max Width 800px)
             <?php if($_REQUEST['id']!='')
      {
     ?>
      <img src="../images/<?php echo $data['image']; ?>" style="height:50px;width:100px;">  
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
