<?php 
$page_title = "Playing Tennis in Tucson - Tucson Korean Tennis Association"; 
$file_name = "tucson.php";
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
       <h3>Playing Tennis in Tucson</h3>
       <p>
       <a href="courts.php"><span class="subtitle_black">Tennis Courts</span></a><br />Check the list of tennis courts available in Tucson.<br />
       If you have information on more courts, please post it on the Bulletin Board at Forum or <br />email us at <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>.
       </p>
       <p>
       <a href="classes.php"><span class="subtitle_black">Tennis Classes</span></a><br />Check the list of tennis classes available in Tucson.<br />
       If you have information on more classes or lessons, please post it on the Bulletin Board at Forum or <br />email us at <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>.
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