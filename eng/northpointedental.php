<?php 
$page_title = "North Pointe Dental - Jane Koo, D.D.S"; 
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
             <li>Dental supplement (Crown/Bridge)</li>
             <li>General treatment</li>
             <li>Pediatric treatment</li>
             <li>Neural treatment</li>
             <li>Aesthetic treatment</li>
             <li>Treatment in Korean</li>
             <li>Office Hours: Tue - Fri 8:00 am - 5:00 pm</li>
             <li>Questions & Reservation: 520-797-0611</li>
           </ul>
           <p> 
           6781 N. Thornydale, Tucson, AZ 85741<br />
           <img src="../images/sponsors/northpointedental.jpg" width="599" height="399" border="1" />
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