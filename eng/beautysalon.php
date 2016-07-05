<?php 
$page_title = "Beauty Salon - Cha Eun Sook"; 
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
           <span class="contenttitle_orange">10% discount for Tucson Korean Tennis Association members and familles</span>
           <ul>
             <li>Plaza Elite</li>
             <li>Day & Spa</li>
             <li>Phone: 520-990-0118</li>
           </ul>
           <p> 
           6602 E. Grant Rd., Tucson, AZ 85715<br />
           <img src="../images/sponsors/beautysalon.JPG" width="534" height="336" border="1" />
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