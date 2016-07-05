<?php 
$page_title = "About Us - Tucson Korean Tennis Association"; 
$file_name = "aboutus.php";
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html40/strict.dtd">
<html>
<head>
<?php include('header.php'); ?>
</head>
<body id="main_body">
   <div id="container">
   <div id="header">
   <?php include('language_choice.php'); ?>
   <div id="key_visual">
   <?php include('logo.php'); ?>
   </div>
   </div>
   <div id="main_container">
   <table>
       <tr>
       <td colspan="1" id="sub_nav_column" rowspan="1">
       <div id="left_column_container">
       <div id="main_nav_container">
       <?php include('navigation.php'); ?>
       </div>
       <div id="sub_container1"></div>
       </div>
       </td>
       <td colspan="1" id="content_column" rowspan="1">
       <div id="sub_container2">
       <div class="content" id="content_container">
       <h3>About Us</h3>
       <p>
       <a href="members.php"><span class="subtitle_black">Members</span></a><br />
       There is no formal application process to become a member.  Just come to play tennis once and you are considered to be a member.  As it is free to join to become a member, it is also free to withdraw from the association.  Just stop showing up, and you won't be bothered.  You may still receive email from time to time when there are spcial events or announcements, but you can always remove yourself from the mailing list by sending email us at <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>.  For more detailed distribution of the members, click <a href="members.php">HERE</a>.
       </p>
       <div class="subtitle_black">Membership Fee</div>
       There is a membership fee of <span class="text_red">$10</span> per month.  You can give $10 to the person in charge any time of the month.  You won't be asked to pay for the previous month.  The collected membership fee will be used to pay for the courts, to buy balls and other necessary items, and sometimes to buy some foods when the balance stays high. 
</p>
       <p>
       <a href="timelocation.php"><span class="subtitle_black">Time</span></a><br />
       Monday 7:30 pm - 10:00 pm <br />
       Friday 7:30 pm - 10:00 pm <br />
       </p>
       
       <p>
       <a href="timelocation.php"><span class="subtitle_black">Location</span></a><br />
       Fort Lowell Park Tennis Center<br />
       2900 North Craycroft Road (NE corner of Craycroft & Glenn)<br />
	   Tucson, AZ 85712<br />
	   (520) 235-3986
       </p>
       For more detailed information about Time & Location, click <a href="timelocation.php">HERE</a>.
       </div>
       </div>
       </td>
       </tr>
   </table>
   </div>
   <div id="content_b"></div>
   <?php include('footer.php'); ?>
   </div>
</body>
</html>