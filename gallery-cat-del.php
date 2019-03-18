<?php
include("../include/config.php");

$arr =$_POST['ids'];
$Submit =$_POST['what'];

if(count($arr)>0)
  {
	  $str_rest_refs=implode(",",$arr);
      if($Submit=='Delete')
      {
	    $sql= "SELECT * FROM gallery_cat where id in ($str_rest_refs)";
		$qry= mysqli_query($obj,$sql);
		$data= mysqli_fetch_array($qry);
				
		@unlink("../upload_images/gallery/".$data['photo']); 
		@unlink("../upload_images/gallery/thumb/".$data['photo']);
		@unlink("../upload_images/gallery/tiny/".$data['photo']);
		
		$sql= "DELETE FROM gallery_cat WHERE id in ($str_rest_refs)";
	    $qry= mysqli_query($obj,$sql);
			  
	    echo "<script>alert('Selected record(s) deleted successfully')</script>";
	    header("location:gallery-cat-list.php");
      }
	 elseif($Submit=='Activate')
	 {		
	    $sql="UPDATE gallery_cat SET status=1 where id in ($str_rest_refs)";
		$qry= mysqli_query($obj,$sql);		
	    header("location:gallery-cat-list.php");		
	 }
	 elseif($Submit=='Deactivate')
	 {		
	    $sql="UPDATE gallery_cat SET status=0 where id in ($str_rest_refs)";
		$qry= mysqli_query($obj,$sql);		
	    header("location:gallery-cat-list.php");		
	 }
  }
?>