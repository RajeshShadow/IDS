<?php

include('../include/config.php');

include('../include/functions.php');

include("../include/simpleimage.php");

validate_admin();

if (isset($_GET['id']))
              {

            $id=$_GET['id'];
            $sid= base64_decode($id);
            
}
    
    
    if(isset($_GET['cat_id']))

               {

            $cid=$_GET['cat_id'];
            $cats_id=base64_decode($cid);

            
    
}

$cat_id=strip_tags(trim($_POST['cat_id']));





if($_REQUEST['submitForm']=='yes')

{
    
         $file_extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);
        $allowed_image_extension = array("png","jpg","JPEG","JPG","jpeg");
	$Image=new SimpleImage();

    if($_FILES['photo']['size']>0 && $_FILES['photo']['error']=='' && substr_count($_FILES["photo"]["name"], '.') == 1)

    {
 if(in_array($file_extension, $allowed_image_extension)){
	    
	      $img=$_FILES['photo']['name'];
	      move_uploaded_file($_FILES['photo']['tmp_name'],"../images/thumb/".$img);
        
         
        $Image->load("../images/thumb/".$img);
        $Image->resize(800,500);
        $Image->save("../images/thumb/".$img);
		 }
         else{
            /*echo "<script type='text/javascript'>alert('Image Format should be jpg,png,gif!');window.location=\"gallery-list.php\";</script>";*/
              echo"<script>alert('Image Format should be jpg,png,gif!')</script>";
        echo"<script>window.open('_self')</script>";
        }   

    }		

	if($sid=='')

	{
       if($img==true){
	  echo $sql="INSERT INTO hadr_gallery SET  cat_id='$cats_id', image='$img', status=1";

	  $qry=mysqli_query($obj,$sql);

	  $_SESSION['sess_msg']='Record added sucessfully';

	  header("location:hadr-gallery-list.php?cat_id=".$cid);

	}}

     if($sid!='')
	{
        if($img!=""){
	  $sql="UPDATE hadr_gallery SET image='$img'  where id='".$sid."'";  
	   $qry= mysqli_query($obj,$sql);
	 
       $_SESSION['sess_msg']='Record updated successfully';
	    header("location:hadr-gallery-list.php?cat_id=".$cats_id);
	}}
}



if($_REQUEST['id']!='')

{

	$sql= "SELECT * FROM hadr_gallery where id='".$sid."'";

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

    <input type="hidden" name="cat_id" value="<?php echo $_REQUEST['cats_id'];?>" />

      <div class="heading">

      <div class="heading-left">Add Hadr/Exercises Gallery</div>

      <div class="heading-right"> <!--<span><input type="submit" name="submit" value="Save"></span>--> </div>

      <div class="clr"></div>

    </div>

    

      <div class="main-right-row">

        

        <p>

          <label>Upload Image</label>

          <input name="photo" id="photo" type="file"> (Max Width 800px) 
     <?php if($_REQUEST['id']!='')
      {
     ?>
      <img src="../images/<?php echo $data['image']; ?>" style="height:50px;width:100px;">  
     <?php } ?>  
        </p>

        </div>        

      <div>

       <span>

        <input type="submit" name="submit" value="Save">

       </span>

      </div>

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

 format:'d-M-Y'

});

</script>

</body>

</html>

