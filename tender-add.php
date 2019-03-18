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

  <form name="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
<input type="hidden" name="csrfToken" value="<?php echo $_SESSION['csrfToken']; ?>" />
      <div class="heading">

      <div class="heading-left">Add Tender</div>

      <div class="heading-right"></div>

      <div class="clr"></div>

    </div>

      <div class="main-right-row">

       

        <p>

         <label><b>Title</b></label>

         <input type="text" name="title" id="title" value="" >

        </p>        

       

           

         <p>

         <label><b>Start Date</b></label>

         <input type="text" name="start_date" id="start_date" class="datetimepicker1 calendar-icon" value="" placeholder="YYYY-MM-DD"> (DD-MM-YYYY)

        </p>   

       



 <p>

         <label><b>End_date</b></label>

          <input type="text" name="end_date" id="end_date" class="datetimepicker1 calendar-icon" value="" placeholder="YYYY-MM-DD"> (DD-MM-YYYY)

        </p> 

          

         <p>

         <label><b>Pdf</b></label>

           <input type="file" name="pdf" id="heading" value="" >

            </p>

          

          

                  

         

      </div>

      

      <div><span><input type="submit" name="submit" value="Save"></span> </div>

    </form>

  </div>

  <div class="clr"></div>

</section>

    

    <?php

    

    if(isset($_POST['submit']))

    {

         

        $t2=strip_tags(trim($_POST['title']));

         $t3=strip_tags(trim($_POST['start_date']));
         $t4=strip_tags(trim($_POST['end_date']));



   $fileinfo = getimagesize($_FILES["pdf"]["tmp_name"]);

    $width = $fileinfo[0];

    $height = $fileinfo[1];

    $file_extension = pathinfo($_FILES["pdf"]["name"], PATHINFO_EXTENSION);

    $allowed_image_extension = array(

        "pdf",

        "docx"

       

    );

    

  $Image=new SimpleImage();

    if($_FILES['pdf']['size']>0 && $_FILES['pdf']['error']=='')

    {

      if(in_array($file_extension, $allowed_image_extension)){

          

        

        

        $img=$_FILES['pdf']['name'];

        move_uploaded_file($_FILES['pdf']['tmp_name'],"upload_images/tender/".$img);

         

        //$Image->load("upload_images/tender/".$img);

        //$Image->resize(135,173);

        //$Image->save("upload_images/tender/".$img);

      

      

      

       

        

    }

         else{

            echo "<script type='text/javascript'>alert('Pdf Format should be pdf,docx file!!');window.location=\"tender-list.php\";</script>";

        }

        

    }

    if($img==true){

	  $sql="INSERT INTO tender(title,start_date,end_date,document,status,link) VALUES('$t2','$t3' , '$t4','$img',1,'tenders.php')";        

     $qry=mysqli_query($obj,$sql);

        echo"<script>alert('record inserted')</script>";

        echo"<script>window.open('tender-list.php','_self')</script>";

    }

    else

        {

        echo"<script>alert('record not inserted')</script>";

        echo"<script>window.open('tender-list.php','_self')</script>";

        

    }



    }

?>

    

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

