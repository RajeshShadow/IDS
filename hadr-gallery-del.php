<?php

include("../include/config.php");



$arr =$_POST['ids'];

$Submit =$_POST['what'];



if(count($arr)>0)

  {

	  $str_rest_refs=implode(",",$arr);

      if($Submit=='Delete')

      {

	    $sql= "SELECT * FROM hadr_gallery where id in ($str_rest_refs)";

		$qry= mysqli_query($obj,$sql);

		$data= mysqli_fetch_array($qry);		

		@unlink("../images/".$data['photo']); 		

		@unlink("../images/thumb/".$data['photo']);

		@unlink("../images/tiny/".$data['photo']);

		

		$sql= "DELETE FROM hadr_gallery WHERE id in ($str_rest_refs)";

	    $qry= mysqli_query($obj,$sql);

			  

	    echo "<script>alert('Selected record(s) deleted successfully')</script>";

	    header("location:hadr-gallery-list.php?cat_id=".$_REQUEST['cat_id'].""); 

      }

	 elseif($Submit=='Activate')

	 {		

	    $sql="UPDATE hadr_gallery SET status=1 where id in ($str_rest_refs)";

		$qry= mysqli_query($obj,$sql);		

	    header("location:hadr-gallery-list.php?cat_id=".$_REQUEST['cat_id']."");	

	 }

	 elseif($Submit=='Deactivate')

	 {		

	    $sql="UPDATE hadr_gallery SET status=0 where id in ($str_rest_refs)";

		$qry= mysqli_query($obj,$sql);		

	    header("location:hadr-gallery-list.php?cat_id=".$_REQUEST['cat_id']."");	

	 }

  }

?>