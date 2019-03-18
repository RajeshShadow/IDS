<?php
include("../include/config.php");

$arr =$_POST['ids'];
$Submit =$_POST['what'];

if(count($arr)>0)
  {
	  $str_rest_refs=implode(",",$arr);
      if($Submit=='Delete')
      {
	    $sql= "SELECT * FROM news where id in ($str_rest_refs)";
		$qry= mysqli_query($obj,$sql);
		$data= mysqli_fetch_array($qry);
				
		@unlink("../images/news/".$data['photo']); 
		
		
		$sql= "DELETE FROM news WHERE id in ($str_rest_refs)";
	    $qry= mysqli_query($obj,$sql);
			  
	    echo "<script>alert('Selected record(s) deleted successfully')</script>";
	    header("location:news-list.php");
      }
	 elseif($Submit=='Activate')
	 {		
	    $sql="UPDATE news SET status=1 where id in ($str_rest_refs)";
		$qry= mysqli_query($obj,$sql);		
	    header("location:news-list.php");		
	 }
	 elseif($Submit=='Deactivate')
	 {		
	    $sql="UPDATE news SET status=0 where id in ($str_rest_refs)";
		$qry= mysqli_query($obj,$sql);		
	    header("location:news-list.php");		
	 }
  }
?>