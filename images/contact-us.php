<?php 

$WebsiteName = 'Dipmcouncil';
$EmailTo = 'info@dipmcouncil.org';
$EmailCC = 'dipm2015@yahoo.com';
$EmailBCC = 'binit@shadowinfosystem.com,rohit@shadowinfosystem.com';
$contNo = '011-49270301';

if(isset($_POST['submit']))
{
  $name=$_POST['fullname'];
  $email=$_POST['email'];
  
  $msg=$_POST['mes'];
 
  

  
  //*********mail function starts here*************//
  
  if ($name!="" && $email!=""  && $msg!="" )
  {
    $bcc=$EmailBCC;
    $cc=$EmailCC;
    $to=$EmailTo;
    $headers="From:$name<info@dipmcouncil.com>". "\r\n" ."BCC: $bcc" . "\r\n" ."CC: $cc" . "\r\n" ."MIME-Version: 1.0" . "\r\n"."Content-type: text/html; charset=iso-8859-1" . "\r\n"; 
    $subject="Contact Form";
    $message='<div style="width:550px; border:5px solid #e7ecf1; border-top:15px solid #e7ecf1; margin:auto; font-family:Arial, Helvetica, sans-serif; color:#666; font-size:14px; font-weight:400; padding:15px 15px 0 15px; line-height:19px;">
      <table width="100%" cellpadding="0" cellspacing="0">
       <thead>
       <tr>
        <th>
         <div style=" padding:5px 0 5px 0; border-bottom:1px solid #e7ecf1; margin-bottom:30px; font-size:20px; color:#666;">'.$WebsiteName.'</div>              </th>
       </tr>
       </thead> 
       <tbody>
        <tr>
         <td style="text-align:center;"><div style="display:inline-block; padding:3px 45px; border-bottom:1px solid #e7ecf1; margin-bottom:15px; font-size:16px;">:: Contact Us Enquiry ::</div></td>
        </tr>
        <tr>
         <td>
          <p style="text-align:left; border-bottom:1px solid #e7ecf1; padding-bottom:5px;">Dear Admin,<br>We got an Quick Enquiry from a User, please find the details below.</p>
          <div style="text-align:left;">      
          <table width="100%">
           <tr>
          <td width="15%" style="padding:4px 0px 4px 0;">Name:</td>
          <td width="85%">'.$name.'</td>
           </tr>
           
           <tr>
          <td width="15%" style="padding:4px 0px 4px 0;">Email:</td>
          <td width="85%">'.$email.'</td>
           </tr>   
                         
           <tr>
          <td width="15%" style="padding:4px 0px 4px 0; float:left;">Enquiry:</td>
          <td width="85%">'.$msg.'</td>
           </tr>
          
          
          </table>
          </div>
         </td>
        </tr>
        <tr>
         <td>
          <div style="border-top:1px solid #e7ecf1; text-align:left; padding-top:5px; margin-top:20px; padding-left:15px;">
            <span style="color:#999;">Thanks</span><br><span style="color:#888;">'.$WebsiteName.'</span>
          </div>
          <div style="background:#e7ecf1; color:#888888; margin-top:35px; padding:8px 15px 5px 15px; font-size:11px; line-height:17px; text-align:center;">
                   <span style="display:block;">This email was sent from a notification-only address that cannot accept incoming email.</span>
           <span style="display:block;">Please do not reply to this message</span>
               <span style="display:block;">'.$WebsiteName.' | '.$contNo.' </span>    
                  </div>
         </td>
        </tr>
        
       </tbody>  
      </table>
      </div>';
    


    $mail=mail($to, $subject, $message, $headers); 
      if($mail)
      {
         
       echo "<script type='text/javascript'>alert('Successfully Submitted!! We Wil Get Back To You Soon');window.location=\"index.php\";</script>";

        
        
      }
      else
      {   
         echo "<script type='text/javascript'>alert('Sorry!! Submit Again..');window.location=\"contact-us.php\";</script>";
      }

}

  }
  ?>








<!DOCTYPE html>
<html>

<head>
<?php include('includes/head.php');?>
<style type="text/css">
	.footerimg{


background-image:url('images/footerimg.jpg');
background-repeat:repeat;
min-height: 170px;
width: 100%;


	}

</style>
</head>

<body>
	<!-- header -->
<?php include('includes/header.php');?>
<!-- header -->
	<!-- banner -->
	<div class="banner_inner_content_agile_w3l">
		<!--<p>Add Some Description</p>-->
	</div>
	<!--//banner -->
	<!--/w3_short-->
	<div class="services-breadcrumb_w3ls">
		<div class="inner_breadcrumb">

			<ul class="short">
				<li><a href="./">Home</a><span>|</span></li>
				<li>Contact Us<span></span></li>
				<li><span></span></li>
				
			</ul>
		</div>
	</div>
	<!--//w3_short-->

	<!-- /features -->
	<div class="banner-bottom">
		<div class="container">
			<div class="tittle_head_w3layouts">
				<h3 class="innertittle">Contact   <span>Us</span></h3>
				<div class="section-title-divider2"></div>
			</div>
			<div class="inner_sec_info_agileits_w3">
				<div class="col-md-12 plan_grid"><br>

	<div class="row">
			
<div class="col-md-6" >
<h5 class="innertittle">CONTACT INFORMATION</h5>	

<div>
	<iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3502.444840452949!2d77.38697331467985!3d28.616426982424198!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390cfab48824d99d%3A0x281752610cf8aac2!2sShadow+infosystem+Pvt.+Ltd.!5e0!3m2!1sen!2sin!4v1514632487674" width="540" height="200" frameborder="0" class="embed-responsive-item" style="border-radius:10px;" allowfullscreen></iframe>
</div>
<div class="col-md-6">
	<br>
		<i class="fa fa-home" aria-hidden="true" style="color: #3383cf;"></i> ADDRESS<br>
		<span style="color:#a6a6a6;">B-333, Chittaranjan Park, New Delhi 110019</span>
		<br><br>
		<i class="fa fa-envelope-o" aria-hidden="true" style="color: #3383cf;"></i> EMAIL ID<br>
		<span style="color:#a6a6a6;">info@dipmcouncil.org</span>
		

</div>
<div class="col-md-6">
	<br>
	<i class="fa fa-phone-square" aria-hidden="true"  style="color: #3383cf;"></i> PHONE NO<br>
		<span style="color:#a6a6a6;">+91-11-49270301</span>
		
			<br><br><br>
		<i class="fa fa-link" aria-hidden="true"  style="color: #3383cf;"></i> WEB ADDRESS<br>
		<span style="color:#a6a6a6;">www.dipmcouncil.org</span>
		

</div>

</div>

<div class="col-md-6" >
	
<h5 class="innertittle">CONTACT US BY MESSAGE</h5>

<div>
	<p>Your email address will not be published. Required fields are marked *</p>
	
<form method="post" >
    <div class="form-group">
      <label for="name">Full name <span style="color:red;">*</span></label>
      <input type="text" class="form-control" id="full name" placeholder="Enter Full name" name="fullname" required="true">
    </div>
    <div class="form-group">
      <label for="email">Email Address <span style="color:red;">*</span></label>
      <input type="email" class="form-control" id="email" placeholder="Enter Email" name="email" required="true">
    </div>
   <div class="form-group">
  <label for="comment">Message <span style="color:red;">*</span></label>
  <textarea class="form-control" rows="7" id="comment" name="mes" placeholder="Enter Message"></textarea>
</div>
    <input type="submit" class="btn btn-primary" style="padding: 8px 20px;" value="submit" name="submit">
     <button type="reset" class="btn btn-danger" style="padding: 8px 20px;">Reset</button>
  </form>

</div>

</div>

		</div><br><br>







			  </div>	

			
					
						
								
			    <div class="clearfix"></div>
			</div>
		</div>

  <!--<div class="footerimg">
			  	<br><br>
			  	<div class="container">
			  		<div class="col-md-6">
			  			<h2 ><b style="color: #707070;">Follow us...</b></h2>


			  		</div>
			  		<div class="col-md-6">
			  			<span>
			  			<a href="" style="margin-left:6px;" ><img src="images/rss.jpg" style="border-radius:4px;"></a>
			  			<a href="" style="margin-left:6px;" ><img src="images/facebook.jpg"  style="border-radius:4px;"></a>
			  			<a href="" style="margin-left:6px;" ><img src="images/twitter-icon.png" ></a>
			  			<a href="" style="margin-left:6px;" ><img src="images/gplus.jpg"  style="border-radius:4px;"></a>
			  			<a href="" style="margin-left:6px;" ><img src="images/linked-in.jpg"  style="border-radius:4px;"></a>
			  			<a href="" style="margin-left:6px;" ><img src="images/pinterest.jpg"  style="border-radius:4px;"></a>
                       </span>
			  		</div>


			  	</div>
			  </div>-->

	</div>
	<!-- //features -->


	<!-- footer -->
<?php include('includes/footer.php')?>
<!-- //footer -->

	<!-- js -->
	<script type="text/javascript" src="js/jquery-2.1.4.min.js"></script>
	<script>
		$('ul.dropdown-menu li').hover(function () {
			$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeIn(500);
		}, function () {
			$(this).find('.dropdown-menu').stop(true, true).delay(200).fadeOut(500);
		});
	</script>
	<!-- stats -->
	<script src="js/jquery.waypoints.min.js"></script>
	<script src="js/jquery.countup.js"></script>
	<script>
		$('.counter').countUp();
	</script>
	<!-- //stats -->
	<script src="js/jquery.bootstrap.newsbox.min.js" type="text/javascript"></script> 
<script type="text/javascript">
$(function () {	
$(".demo1").bootstrapNews({
		newsPerPage:4,
		autoplay: true,
		pauseOnHover: true,
		navigation: false,
		direction: 'down',
		newsTickerInterval:3500,
		onToDo: function () {
			//console.log(this);
		}
});
$(".demo2").bootstrapNews({
		newsPerPage:5,
		autoplay: true,
		pauseOnHover: true,
		navigation: false,
		direction: 'down',
		newsTickerInterval:2500,
		onToDo: function () {
			//console.log(this);
		}
});
	
});
</script>

	<script type="text/javascript" src="js/bootstrap.js"></script>
	
	<script>
	(function($) {
$.fn.menumaker = function(options) {  
 var cssmenu = $(this), settings = $.extend({
   format: "dropdown",
   sticky: false
 }, options);
 return this.each(function() {
   $(this).find(".button").on('click', function(){
     $(this).toggleClass('menu-opened');
     var mainmenu = $(this).next('ul');
     if (mainmenu.hasClass('open')) { 
       mainmenu.slideToggle().removeClass('open');
     }
     else {
       mainmenu.slideToggle().addClass('open');
       if (settings.format === "dropdown") {
         mainmenu.find('ul').show();
       }
     }
   });
   cssmenu.find('li ul').parent().addClass('has-sub');
multiTg = function() {
     cssmenu.find(".has-sub").prepend('<span class="submenu-button"></span>');
     cssmenu.find('.submenu-button').on('click', function() {
       $(this).toggleClass('submenu-opened');
       if ($(this).siblings('ul').hasClass('open')) {
         $(this).siblings('ul').removeClass('open').slideToggle();
       }
       else {
         $(this).siblings('ul').addClass('open').slideToggle();
       }
     });
   };
   if (settings.format === 'multitoggle') multiTg();
   else cssmenu.addClass('dropdown');
   if (settings.sticky === true) cssmenu.css('position', 'fixed');
resizeFix = function() {
  var mediasize = 1000;
     if ($( window ).width() > mediasize) {
       cssmenu.find('ul').show();
     }
     if ($(window).width() <= mediasize) {
       cssmenu.find('ul').hide().removeClass('open');
     }
   };
   resizeFix();
   return $(window).on('resize', resizeFix);
 });
  };
})(jQuery);

(function($){
$(document).ready(function(){
$("#cssmenu").menumaker({
   format: "multitoggle"
});
});
})(jQuery);
	</script>
</body>

</html>