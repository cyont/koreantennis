<?php 
$page_title = "Realtor Young Lee"; 
$file_name = substr($_SERVER['PHP_SELF'], 5);
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html40/strict.dtd">
<html>
<head>
<?php include('header.php'); ?>
<?php $nav_section = "sponsors"; ?>
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
       </div>       </td>
       <td colspan="1" id="content_column" rowspan="1">
       <div id="sub_container2">
         <div class="content" id="content_container">
           <h3><?php echo $page_title; ?></h3>
           <span class="contenttitle_orange">home appraisal, home inspection, home owners insurance 중 하나 realtor가 대신 지불</span>
           <ul>
             <li>Realtor Young Lee in Long Realty</li>
             <li>Phone: 520-820-4330</li>
             <li><a href="http://yslee.longrealty.com" target="_blank">http://yslee.longrealty.com</a></li>
             <li>Email: yslee@longrealty.com</li>
           </ul>
           <p> 
           1890 E. River Rd., Tucson, AZ 85718<br />
           <img src="../images/sponsors/realtoryounglee.jpg" width="438" height="407" border="1" />
           </p>
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