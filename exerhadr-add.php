<?php

include('../include/config.php');

include('../include/functions.php');

include("../include/simpleimage.php");

validate_admin();



       

         $name=strip_tags(trim($_POST['name']));

        /*$description=strip_tags(trim($_POST['description']));*/
        $description=$_POST['description'];
        $gal=strip_tags(trim($_POST['gal']));
        $had=strip_tags(trim($_POST['had']));


  



if($_REQUEST['submitForm']=='yes')

{

   $fileinfo = getimagesize($_FILES["photo"]["tmp_name"]);

    $width = $fileinfo[0];

    $height = $fileinfo[1];

    $file_extension = pathinfo($_FILES["photo"]["name"], PATHINFO_EXTENSION);

    $allowed_image_extension = array(

        "png",

        "jpg","JPEG","JPG",

        "jpeg"

    );

    

  $Image=new SimpleImage();

    if($_FILES['photo']['size']>0 && $_FILES['photo']['error']=='' && substr_count($_FILES["photo"]["name"], '.') == 1)

    {

      if(in_array($file_extension, $allowed_image_extension)){

          

        

        

        $img=$_FILES['photo']['name'];

        move_uploaded_file($_FILES['photo']['tmp_name'],"upload_images/leadership/".$img);

         

        $Image->load("upload_images/leadership/".$img);

        $Image->resize(135,199);

        $Image->save("upload_images/leadership/".$img);

      

      

      

       

        

    }

         else{

            echo "<script type='text/javascript'>alert('Image Format should be jpg,png,gif!');window.location=\"exerhadr-list.php\";</script>";

        }

        

    }



	if($_REQUEST['id']=='' )

	{

       if($img==true){

	   $sql="INSERT INTO hadr_exer(name,image,content,status,link,gal,hadr) VALUES('$name','$img','$description',1,'hadr-exercises.php','$gal','$had')";

	  $qry=mysqli_query($obj,$sql);

     echo "<script type='text/javascript'>alert('Record added sucessfully');window.location=\"exerhadr-list.php\";</script>";

	 

	

    }

        else{

        echo "<script type='text/javascript'>alert('Record Not Added');window.location=\"exerhadr-list.php\";</script>";

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

      <div class="heading-left">Add Cisc</div>

      <div class="heading-right"></div>

      <div class="clr"></div>

    </div>

     <div class="main-right-row">

       

             

       

  <p>

         <label><b>Name</b></label>

         <input type="text" name="name" id="title" value="" >

        </p>        

       

       

        <p>

          <label><b>Upload Image</b></label>

          <input name="photo" id="img" type="file"> (Max Width 200px) 

        </p>
         <p>

          <label><b>In Hadr Gallery</b></label>

          <select name="gal">
          <option name="gal" value="">Select Options</option>
          <option name="gal" value="1">Yes</option>
          <option name="gal" value="0">No</option>
          
          </select> 

        </p>
         <p>

          <label><b>In Hadr Exercises</b></label>

          <select name="had">
          <option name="had" value="">Select Options</option>
          <option name="had" value="1">Yes</option>
          <option name="had" value="0">No</option>
          
          </select> 

        </p>

        

         

          

         <br>

          <p><b>Description</b></p>

            <p><textarea name="description" id="description" rows="4" class="ckeditor"  placeholder="Description Here..."></textarea>

            </p>

          

          <br>

                    
          

         

      </div>

      

      <div><span><input type="submit" name="submit" value="Save"></span> </div>

    </form>

      

  </div>

  <div class="clr"></div>

</section>

<?php include('includes/footer.php'); ?>

</body>

</html>

