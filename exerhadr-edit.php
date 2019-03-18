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

      

<?php

if (isset($_GET['id']))

               {

            $id=$_GET['id'];

            $sid= base64_decode($id);

    
     
     $query="select * from hadr_exer where id='$sid'";

        $run= mysqli_query($obj, $query);

        while ($data=mysqli_fetch_array($run)) { 

            

            $id=$data['id'];

            $name=$data['name'];

              $banner=$data['image'];

            $description=$data['content'];
            $gal=$data['gal'];
            $had=$data['hadr'];

           



        ?>

      

  <form name="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">

      <input type="hidden" name="csrfToken" value="<?php echo $_SESSION['csrfToken']; ?>" />
      <div class="heading">

      <div class="heading-left">Edit Hadr/Exercises</div>

      <div class="heading-right"></div>

      <div class="clr"></div>

    </div>

      <div class="main-right-row">

    

               

       <p>

         <label>Name</label>

         <input type="text" name="name" id="name" value="<?php echo $data['name'];?>">

        </p> 
          <p>
     <?php if($data['gal']==1){
    $yes='yes';
    $color='green';
}
    else{
        $yes='No';
        $color='red';
    }
    ?>
         <label><b>In Gallery</b></label> 

          <select name="gal">
          <option name="gal" value="">Select Options</option>
          <option name="gal" value="1">Yes</option>
          <option name="gal" value="0">No</option> 
          
          </select> 
         <span style="color:<?php echo $color;?>"><?php echo $yes ;?></span>
        </p>   
          <p>
     <?php if($data['hadr']==1){
    $yess='yes';
    $colors='green';
}
    else{
        $yess='No';
        $colors='red';
    }
    ?>
         <label><b>In Hadr Exer</b></label> 

          <select name="had">
          <option name="had" value="">Select Options</option>
          <option name="had" value="1">Yes</option>
          <option name="had" value="0">No</option> 
          
          </select> 
         <span style="color:<?php echo $colors;?>"><?php echo $yess ;?></span>
        </p>        

      

    

         <p>

          <label>Upload Image</label>

          <input name="photo" id="banner" type="file" value="<?php echo $data['image'];?>"> (Max Width 200px) 

        </p>

         <p>

         <label></label>

         <?php if($_REQUEST['id']!='')

      {

     ?>

      <img src="upload_images/leadership/<?php echo $data['image']; ?>" width="200px" height="200px" width="200">  

     <?php } ?>         

        </p>

          <p>



         <br>

          <p><b>Description</b></p>

            <p><textarea name="description" id="description"  rows="4" class="ckeditor" > <?php echo $data['content'];?></textarea>

            </p>

          

          <br>

          

         

      </div>

      

      <div><span><input type="submit" name="update" value="Save"></span> </div>

    </form>

  </div>

  <div class="clr"></div>

  <?php }}?>

</section>



<?php

    

  if(isset($_POST['update']))

    {
      $name=strip_tags(trim($_POST['name']));
      $gals=strip_tags(trim($_POST['gal']));
      $hads=strip_tags(trim($_POST['had']));

        /*$description=strip_tags(trim($_POST['description']));*/
         $description=$_POST['description'];

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

      // move_uploaded_file($_FILES['photo']['tmp_name'],"upload_images/leadership/".$img);
   

    }

         else{

            echo "<script type='text/javascript'>alert('Image Format should be jpg,png,gif!');window.location=\"exerhadr-list.php\";</script>";

        }

        

    }



	

	  $sql="update hadr_exer set name='$name', content='$description',gal='$gals',hadr='$hads' ,status=1";   

     

        if($img!=""){

	   $sql.=", image='$img'";

            move_uploaded_file($_FILES['photo']['tmp_name'],"upload_images/leadership/".$img);

            $Image->load("upload_images/leadership/".$img);

           $Image->resize(135,199);

           $Image->save("upload_images/leadership/".$img);

	   }

     

      

	    $sql.=" where id='$id'";

       $qry=mysqli_query($obj,$sql);

    if($qry==true)

    {

        echo"<script>alert('Update Successfully')</script>";

        echo"<script>window.open('exerhadr-list.php','_self')</script>";

    }

    else

        {

        echo"<script>alert('Update not Changes')</script>";

         echo"<script>window.open('exerhadr-list.php','_self')</script>";

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

 format:'Y-m-d'

});

</script>

</body>

</html>