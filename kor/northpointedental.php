<?php 
$page_title = "North Pointe Dental - ���� �� ġ��"; 
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
           <span class="contenttitle_orange">���� ���� �״Ͻ� ��ȸ ȸ���� �������� 10% ����</span>
           <ul>
             <li>ġ�� ��ö (ũ��� / �긴��)</li>
             <li>�Ϲ� ġ��</li>
             <li>�Ҿ� ġ��</li>
             <li>�Ű� ġ��</li>
             <li>�ɹ� ġ��</li>
             <li>�ѱ���� ġ�� ����</li>
             <li>���� �ð�: Tue - Fri 8:00 am - 5:00 pm</li>
             <li>���� �� ����: 520-797-0611</li>
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