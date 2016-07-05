<?php 
$page_title = "투산의 테니스"; 
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
       <h3>테니스 코트와 클래스 안내</h3>
       <p>
       <a href="courts.php"><span class="subtitle_black">테니스 코트</span></a><br />
       투산 지역에서 테니스를 칠 수 있는 코트 안내 리스트입니다.<br />
       이 외에도 여러분이 알고 계신 코트가 있으면 Forum의 게시판에 글을 쓰거나 <br /><a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>로 이메일을 보내 주세요.
       </p>
       <p>
       <a href="classes.php"><span class="subtitle_black">테니스 클래스</span></a><br />투산 지역에서 정기적으로 진행되는 클래스 안내입니다.<br />
       이 외에도 여러분이 알고 계신 클래스가 있으면 Forum의 게시판에 글을 쓰거나 <br /><a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>로 이메일을 보내 주세요.
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