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
<title>DIPM</title>
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
if(isset($_GET['id']))
    
{
     $id=$_GET['id'];
     $query="select * from tender where id='$id'";
        $run= mysqli_query($obj, $query);
        while ($data=mysqli_fetch_array($run)) { 
            
            $id=$data['id'];
           
            $title=$data['title'];
              $sdate=$data['start_date'];
                $edate=$data['end_date'];
           $pdf=$data['document'];
         
            $description=$data['description'];
           
           

        ?>
      
  <form name="frm" method="POST" enctype="multipart/form-data" action="" onsubmit="return validate(this)">
      <div class="heading">
      <div class="heading-left">Add Tender</div>
      <div class="heading-right"></div>
      <div class="clr"></div>
    </div>
      <div class="main-right-row">
       
        <p>
         <label><b>Title</b></label>
         <input type="text" name="title" id="title" value="<?php echo $data['title']; ?>" >
        </p>        
       
           
         <p>
         <label><b>Start Date</b></label>
         <input type="text" name="start_date" id="start_date" class="datetimepicker1 calendar-icon" value="<?php echo $sdate ?>" placeholder="YYYY-MM-DD"> (DD-MM-YYYY)
        </p>   
       

 <p>
         <label><b>End_date</b></label>
          <input type="text" name="end_date" id="end_date" class="datetimepicker1 calendar-icon" value="<?php echo $edate ?>" placeholder="YYYY-MM-DD"> (DD-MM-YYYY)
        </p> 
          
         <p>
         <label><b>Pdf</b></label>
           <input type="file" name="pdf" id="heading" value="<?php echo $pdf ?>" >
            </p>
          <p>
         <label></label>
         <?php if($_REQUEST['id']!='')
      {
     ?>
      <td><a href="upload_images/tender/<?php echo  $data['document'];?>" target="_blank"><?php echo  $data['document'];?></a></td>
 
     <?php } ?>         
        </p>
          
                  
         
      </div>
      
      <div><span><input type="submit" name="submit" value="Save"></span> </div>
    </form>
  </div>
  <div class="clr"></div>
  <?php }}?>
</section>

<?php
    
  if(isset($_POST['submit']))
    {
            
        $t2=$_POST['title'];
         $t3=$_POST['start_date'];
         $t4=$_POST['end_date'];
        
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
            echo "<script type='text/javascript'>alert('Image Format should be jpg,png,gif!');window.location=\"tender-list.php\";</script>";
        }
        
    }

    
      $sql="update tender set   title='$t2' , start_date='$t3',end_date='$t4',   status=1 ";       

     if($img!=""){
	   $sql.=", document='$img'";
            move_uploaded_file($_FILES['pdf']['tmp_name'],"upload_images/tender/".$img);
            	   }
     
      
	    $sql.=" where id='$id'";
       $qry=mysqli_query($obj,$sql);
   
    if($qry==true)
    {
        echo"<script>alert('Update Successfully')</script>";
        echo"<script>window.open('tender-list.php','_self')</script>";
    }
    else
        {
        echo"<script>alert('Update not Changes')</script>";
         echo"<script>window.open('tender-list.php','_self')</script>";
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