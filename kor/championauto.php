<?php 
$page_title = "챔피온 오토바디 & 페인팅"; 
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
           <span class="contenttitle_orange">투산 한인 테니스 협회 회원과 가족에게 할인 보장</span>
           <ul>
             <li>무료 견적</li>
             <li>견인 서비스 제공</li>
             <li>사고 보험 처리</li>
             <li>한국어로 서비스 가능</li>
             <li>Phone: 520-884-4888 (Office), 520-229-7731 (Cell)</li>
           </ul>
           <p> 
           37 W. Sahuaro St., Tucson, AZ 85705<br />
           <img src="../images/sponsors/championauto.jpg" width="542" height="458" border="1" />
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