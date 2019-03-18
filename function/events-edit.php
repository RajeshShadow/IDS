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
      
<?php
if(isset($_GET['id']))
    
{
     $id=$_GET['id'];
     $query="select *from events where id='$id'";
        $run= mysqli_query($obj, $query);
        while ($data=mysqli_fetch_array($run)) { 
            
           
        ?>
      
  <form name="frm" method="POST" enctype="multipart/form-data" action="" >
 

     <!-- <input type="hidden" name="submitForm" value="yes" />-->
 
      <div class="heading">
      <div class="heading-left">EDIT EVENTS</div>
      <div class="heading-right"></div>
      <div class="clr"></div>
    </div>
       <div class="main-right-row">
        <p>
         <label>Title</label>
         <input type="text" name="title" id="title" value="<?php echo $data['title'];?>">
        </p>        
        <p>
         <label>Location/Address</label>
         <input type="text" name="location" id="location" value="<?php echo $data['location'];?>">
        </p>
          <p>
		 <label>Map</label>
         <textarea name="map" id="map" rows="4"   placeholder="Map with Iframe" value="<?php echo $data['map'];?>"> </textarea>
        </p>
        
        <p>
         <label>Event Start Date </label>
         <input type="text" name="start_date" id="start_date" class="datetimepicker1 calendar-icon" value="<?php echo $data['start_date'];?>" placeholder="YYYY-MM-DD"> (DD-MM-YYYY)
        </p>
		 <p>
         <label>Event End Date </label>
         <input type="text" name="end_date" id="end_date" class="datetimepicker1 calendar-icon" value="<?php echo $data['end_date'];?>" placeholder="YYYY-MM-DD"> (DD-MM-YYYY)
        </p>
          <p>
         <label>Event Time </label>
         <input type="text" name="event_time" id="event_time"  value="<?php echo $data['event_time'];?>" placeholder="HH:MMPM to HH:MMPM"> ( HH:MMPM to HH:MMPM)
        </p>
       
         <p>
          <label>Upload Banner</label>
          <input name="banner" id="banner" type="file" value="<?php echo $data['banner'];?>"> (Max Width 1100px) 
        </p>
          <p>
          <label>Upload Speakers Image1</label>
          <input name="img" id="img" type="file" value="<?php echo $data['speaker1'];?>" > (Max Width 200px) 
        </p>
          
          <p>
         <label>Upload Speakers Name1</label>
         <input type="text" name="speakername1" id="location" value="<?php echo $data['speakername1'];?>">
        </p>
          <p>
         <label>Upload Speakers Designation1</label>
         <input type="text" name="speakerdesig1" id="location" value="<?php echo $data['speakerdesig1'];?>">
        </p>
          
          <p>
         <label>Upload Speakers Profile1</label>
         <input type="text" name="speakerprofile1" id="location" value="<?php echo $data['speakerprofile1'];?>">
        </p>
        
          <p>
          <label>Upload Speakers Image2</label>
          <input name="img1" id="img" type="file"  value="<?php echo $data['speaker2'];?>"> (Max Width 200px) 
        </p>
          <p>
         <label>Upload Speakers Name2</label>
         <input type="text" name="speakername2" id="location" value="<?php echo $data['speakername2'];?>">
        </p>
          
          <p>
         <label>Upload Speakers Designation2</label>
         <input type="text" name="speakerdesig2" id="location" value="<?php echo $data['speakerdesig2'];?>">
        </p>
          
           <p>
         <label>Upload Speakers Profile2</label>
         <input type="text" name="speakerprofile2" id="location" value="<?php echo $data['speakerprofile2'];?>">
        </p>
          
          
           <p>
          <label>Upload Speakers Image3</label>
          <input name="img2" id="img" type="file"  value="<?php echo $data['speaker3'];?>"> (Max Width 200px) 
        </p>
          
          
          <p>
         <label>Upload Speakers Name3</label>
         <input type="text" name="speakername3" id="location" value="<?php echo $data['speakername3'];?>">
        </p>
          
          <p>
         <label>Upload Speakers Designation3</label>
         <input type="text" name="speakerdesig3" id="location" value="<?php echo $data['speakerdesig3'];?>">
        </p>
          
           <p>
         <label>Upload Speakers Profile3</label>
         <input type="text" name="speakerprofile3" id="location" value="<?php echo $data['speakerprofile3'];?>">
        </p>
          
           <p>
          <label>Upload Speakers Image4</label>
          <input name="img3" id="img" type="file" value="<?php echo $data['speaker4'];?>"> (Max Width 200px) 
        </p>
           <p>
         <label>Upload Speakers Name4</label>
         <input type="text" name="speakername4" id="location" value="<?php echo $data['speakername4'];?>">
        </p>
          
          <p>
         <label>Upload Speakers Designation4</label>
         <input type="text" name="speakerdesig4" id="location" value="<?php echo $data['speakerdesig4'];?>">
        </p>
          
           <p>
         <label>Upload Speakers Profile4</label>
         <input type="text" name="speakerprofile4" id="location" value="<?php echo $data['speakerprofile4'];?>">
        </p>
          
          
           <p>
          <label>Upload Speakers Image5</label>
          <input name="img4" id="img" type="file" value="<?php echo $data['speaker5'];?>"> (Max Width 200px) 
        </p>
          
            <p>
         <label>Upload Speakers Name5</label>
         <input type="text" name="speakername5" id="location" value="<?php echo $data['speakername5'];?>">
        </p>
           <p>
         <label>Upload Speakers Designation5</label>
         <input type="text" name="speakerdesig5" id="location" value="<?php echo $data['speakerprofile5'];?>">
        </p>
           <p>
         <label>Upload Speakers Profile5</label>
         <input type="text" name="speakerprofile5" id="location" value="<?php echo $data['speakerprofile5'];?>">
        </p>
          
          
           <p>
          <label>Upload Speakers Image6</label>
          <input name="img5" id="img" type="file" value="<?php echo $data['speaker6'];?>"> (Max Width 200px) 
        </p>
            
          <p>
         <label>Upload Speakers Name6</label>
         <input type="text" name="speakername6" id="location" value="<?php echo $data['speakername6'];?>">
        </p>
           <p>
         <label>Upload Speakers Designation6</label>
         <input type="text" name="speakerdesig6" id="location" value="<?php echo $data['speakerdesig6'];?>">
        </p>
           <p>
         <label>Upload Speakers Profile6</label>
         <input type="text" name="speakerprofile6" id="location" value="<?php echo $data['speakerprofile6'];?>">
        </p>
          
         <br>
          <p><b>Description</b></p>
            <p><textarea name="description" id="description" rows="4" class="ckeditor"  placeholder="Description Here..."></textarea>
            </p>
          
          <br>
                    <!--<p><b>Agenda</b></p>
        
        <p><textarea name="description2" id="description2" rows="4" class="ckeditor"  placeholder="Agenda Here..."></textarea>
        </p>-->
          
         
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
        $title=$_POST['title'];
        $location=$_POST['location'];
        $description=$_POST['description'];
        $start_date=$_POST['start_date'];
        $end_date=$_POST['end_date'];
        $event_time=$_POST['event_time'];
         $map=$_POST['map'];
        $banner=$_FILES["banner"]["name"];	
        $temp_name4=$_FILES["banner"]["tmp_name"];
       
        $img=$_FILES["img"]["name"];	
        $temp_name1=$_FILES["img"]["tmp_name"];
        $speakername1=$_POST['speakername1'];
        $speakerdesig1=$_POST['speakerdesig1'];
        $speakerprofile1=$_POST['speakerprofile1'];
        
        $img1=$_FILES["img1"]["name"];	
        $temp_name2=$_FILES["img1"]["tmp_name"];
        $speakername2=$_POST['speakername2'];
        $speakerdesig2=$_POST['speakerdesig2'];
        $speakerprofile2=$_POST['speakerprofile2'];
        
        $img2=$_FILES["img2"]["name"];	
        $temp_name3=$_FILES["img2"]["tmp_name"];
        $speakername3=$_POST['speakername3'];
        $speakerdesig3=$_POST['speakerdesig3'];
        $speakerprofile3=$_POST['speakerprofile3'];
        
        $img3=$_FILES["img3"]["name"];	
        $temp_name7=$_FILES["img3"]["tmp_name"];
        
        $speakername4=$_POST['speakername4'];
        $speakerdesig4=$_POST['speakerdesig4'];
        $speakerprofile4=$_POST['speakerprofile4'];
        
        $img4=$_FILES["img4"]["name"];	
        $temp_name5=$_FILES["img4"]["tmp_name"];
        
        $speakername5=$_POST['speakername5'];
        $speakerdesig5=$_POST['speakerdesig5'];
        $speakerprofile5=$_POST['speakerprofile5'];
        
        
        $img5=$_FILES["img5"]["name"];	
        $temp_name6=$_FILES["img5"]["tmp_name"];
        $speakername6=$_POST['speakername6'];
        $speakerdesig6=$_POST['speakerdesig6'];
        $speakerprofile6=$_POST['speakerprofile6'];
        
      
      $sql="update events set title='$title', location='$location', description='$description', map='$map', event_time='$event_time', start_date='$start_date', end_date='$end_date',banner='$banner',
     speakername1='$speakername1',speakername2='$speakername2',speakername3='$speakername3',speakername4='$speakername4',speakername5='$speakername5'speakername6='$speakername6',speakerdesig1='$speakerdesig1',speakerdesig2='$speakerdesig2',speakerdesig3='$speakerdesig3',speakerdesig4='$speakerdesig4',speakerdesig5='$speakerdesig5',speakerdesig6='$speakerdesig6',speakerprofile1='$speakerprofile1',speakerprofile2='$speakerprofile2',speakerprofile3='$speakerprofile3',speakerprofile4='$speakerprofile4',speakerprofile5='$speakerprofile5',speakerprofile6='$speakerprofile6', status=1 ";
	
     
	   
      if($banner!=""){
	   $sql.=", banner='$banner'";
           move_uploaded_file($temp_name4,"../upload_images/event/$banner");
	   }
      if($img!=""){
	   $sql.=", speaker1='$img'";
           move_uploaded_file($temp_name1,"../upload_images/event/$img");
	   }
      if($img1!=""){
	   $sql.=", speaker2='$img1'";
           move_uploaded_file($temp_name2,"../upload_images/event/$img1");
	   }
      if($img2!=""){
	   $sql.=", speaker3='$img2'";
           move_uploaded_file($temp_name3,"../upload_images/event/$img2");
	   }
      if($img3!=""){
	   $sql.=", speaker4='$img3'";
           move_uploaded_file($temp_name7,"../event/$img3");
	   }
      if($img4!=""){
	   $sql.=", speaker5='$img4'";
           move_uploaded_file($temp_name5,"../event/$img4");
	   }
      if($img5!=""){
	   $sql.=", speaker6='$img5'";
           move_uploaded_file($temp_name6,"../event/$img5");
	   }
      
	    $sql.=" where id='$id'";

     $qry=mysqli_query($obj,$sql);
   
    if($qry)
    {
        echo"<script>alert('Update Successfully')</script>";
        echo"<script>window.open('events-list.php','_self')</script>";
    }
    else
        {
        echo"<script>alert('Update not Changes')</script>";
         echo"<script>window.open('events-list.php','_self')</script>";
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