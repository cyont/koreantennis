<?php 
$page_title = "LAZ Express - Moving";
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
           <h3>LAZ Express</h3>
           <span class="contenttitle_orange">10% discount for Tucson Korean Tennis Association members and familles</span>
           <ul>
             <li>Moving</li>
             <li>Helping Koreans moving back to Korea</li>
             <li>Phone: 602-442-8252</li>
           </ul>
           <p> 
           1315 E. Gibson Lane, Phoenix, AZ 85043<br />
           <img src="../images/sponsors/lazexpress.jpg" width="549" height="387" border="1" /> 
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