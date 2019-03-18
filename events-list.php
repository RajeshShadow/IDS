<?php
include('../include/config.php');
include('../include/functions.php');
validate_admin();
?>
<!doctype html>
<html>
<head>
<meta charset="utf-8">
<title><?php echo SITE_TITLE; ?></title>
<link href="css/style.css" rel="stylesheet" type="text/css">
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
					frmobj.action = "events-del.php";
					frmobj.what.value="Delete";
					frmobj.submit();
					
				}
				else{ 
				return false;
				}
		}
		else if(comb=='Deactivate'){
           
			frmobj.action = "events-del.php";
			frmobj.what.value="Deactivate";
			frmobj.submit();
                
		}
		else if(comb=='Activate'){
            
			frmobj.action = "events-del.php";
			frmobj.what.value="Activate";
			frmobj.submit();
                
		}
	}
</script>
</head>

<body>
<?php include('includes/header.php'); ?>
<?php include('includes/menu.php'); ?>
<section class="main">
  <div class="main-right">
    <div class="heading">
      <div class="heading-left">View Events</div>
      <div class="heading-right"><a href="event-add.php" class="button1">Add Event</a></div>
      <div class="clr"></div>
    </div>
    <form name="form" method="post" action="">
      <div class="main-right-row">
        <div class="table-responsive">
          <table id="myTable" class="table table-striped">
          <thead>
          <tr class="tb-head">
            <td width="6%">S. No.</td>            
            <td width="19%">Title</td>
            <td width="9%">Location</td>
            <td width="8%">Map</td>
            <td width="18%">Description</td>
            <td width="8%">Event Date</td>
            <td width="8%">Image</td>
            <!--<td width="31%">Add Speakers</td> -->
            <td width="6%" align="center">Status</td>
            <td width="5%">Edit</td>
            <td width="3%"><input name="check_all" type="checkbox" id="check_all" onclick="checkall(this.form)" value="check_all" />Action</td>
          </tr>
          </thead>
          <tbody> 
		  <?php		   
	$sql= "SELECT * FROM events ORDER BY id DESC";
	$qry= mysqli_query($obj,$sql);
	$i=0;
	while($data= mysqli_fetch_array($qry))
	{
        $id=$data['id'];
		$i++;
		if($i%2==0)
		{
			$bgcolor = "#eeeeee";
		}
		else
		{
			$bgcolor = "";
		}					  
  ?>
          <tr bgcolor="<?php echo $bgcolor;?>">
            <td><?php echo $i+$start; ?>.</td>            
            <td><?php echo $data['title'];?></td>
            <td><?php echo $data['location']; ?></td>  
            <td ><?php echo substr($data['map'],0,50); ?>...</td>
            <td><?php echo substr($data['description'],0,50); ?>...</td>
            <td><?php echo $data['start_date']; ?></td>
            <td><img src="../images/<?php echo $data['banner']; ?>" alt=""></td>
            <!--<td><a href="speaker-add.php?cat_id=<?php echo $data['id']; ?>"><img src="images/add.png" alt=""></a></td>-->
            <td align="center"><?php if($data['status']==1) {?>
              <img src="images/enable.gif" alt="">
              <?php } else {?>
              <img src="images/disable.gif" alt="">
              <?php } ?></td>
            <td align="center"><a href="event-add.php?id=<?php echo urlencode(base64_encode($id)); ?>"><img src="images/edit.png" alt=""></a></td>
            <td><input type="checkbox" name="ids[]" value="<?php echo $data['id']; ?>" ></td>
          </tr>
          <?php } ?>
          </tbody>
        </table>
        </div>
      </div>
      <div>
        <input type="hidden" name="what" value="what" />
        <span>
        <input type="submit" name="submit" value="Activate" onclick="return del_prompt(this.form,this.value)" >
        </span> <span>
        <input type="submit" name="submit" value="Deactivate" onclick="return del_prompt(this.form,this.value)" >
        </span> <span>
        <input type="submit" name="submit" value="Delete" onclick="return del_prompt(this.form,this.value)" >
        </span> </div>
    </form>
  </div>
  <div class="clr"></div>
</section>
<?php include('includes/footer.php'); ?>
</body>
</html>
