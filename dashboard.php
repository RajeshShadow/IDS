<?php

include('../include/config.php');

include('../include/functions.php');
validate_admin();


?>

<!doctype html>

<html>

<head>

<meta charset="utf-8">

<title>IDS</title>

<link href="css/style.css" rel="stylesheet" type="text/css">
     <script src="https://ajax.googleapis.com/ajax/libs/jquery/2.1.3/jquery.min.js"></script>
<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.4/css/bootstrap.min.css"/>
    <script src="js/jquery-2.2.1.min.js" type="text/javascript"></script>

<?php include('head.php'); ?>

<script>  

	function checkall(objForm)

    {

	len = objForm.elements.length;

	var i=0;

	for( i=0 ; i<len ; i++){

		if (objForm.elements[i].type=='checkbox') 

		objForm.elements[i].checked=objForm.check_all.checked;

	}

   }

	function del_prompt(frmobj,comb)

		{

		//alert(comb);

			if(comb=='Delete'){

				if(confirm ("Are you sure you want to delete record(s)"))

				{

					frmobj.action = "reg-mem-del.php";

					frmobj.what.value="Delete";

					frmobj.submit();

					

				}

				else{ 

				return false;

				}

		}

		else if(comb=='Deactivate'){

			frmobj.action = "reg-mem-del.php";

			frmobj.what.value="Deactivate";

			frmobj.submit();

		}

		else if(comb=='Activate'){

			frmobj.action = "reg-mem-del.php";

			frmobj.what.value="Activate";
      

			frmobj.submit();

		}

	}

</script>

</head>



<body>

<?php include('includes/header.php'); ?>

<?php include('includes/menu.php'); ?>

<section class="main" style=" background: linear-gradient(#ffffff, #fdd2ef);margin: 0px;">
<div class="container">
 <div class="col-md-12" style="text-align: center;">
         <?php if($_SESSION['sess_msg']){?>
  <span style="color:green; text-align:center; display:block; margin-top:10px; "><?php echo $_SESSION['sess_msg'];$_SESSION['sess_msg']='';?></span>
 <?php
 }
 ?>
      <?php if($_SESSION['sess_msg1']){?>
  <span style="color:green; text-align:center; display:block; margin-top:10px;  "><?php echo $_SESSION['sess_msg1'];$_SESSION['sess_msg1']='';?></span>
 <?php
 }
 ?>
          <h1 style="font-size: 43px; margin-bottom: 40px; margin-top:50px;">Welcome To Admin Panel</h1>
          <img src="../images/logo-text.png" style="margin-bottom: 162px;"><br>
  
   
         </div>
		</div>

</section>

<?php include('includes/footer.php'); ?>
     <script type="text/javascript" src="js/tableExport.js"></script>
<script type="text/javascript" src="js/jquery.base64.js"></script>

<script type="text/javascript" src="https://maxcdn.bootstrapcdn.com/bootstrap/3.3.5/js/bootstrap.min.js"></script>


<script type="text/javascript">
//$('#myTable').tableExport();
$(function(){
	$('#example').DataTable();
      }); 
</script>
       

</body>

</html>

