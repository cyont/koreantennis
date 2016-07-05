<?php 
$page_title = "경기 규칙"; 
$file_name = "game_rules_A.php";
?> 
<!DOCTYPE html
  PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html40/strict.dtd">
<html>
<head>
<?php include('header.php'); ?>
<link rel="stylesheet" type="text/css" media="screen" href="../styles/lightbox.css"  />
<script type="text/javascript" src="../scripts/scriptaculous/lib/prototype.js"></script>
<script type="text/javascript" src="../scripts/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="../scripts/lightbox.js"></script>
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
       <h3>경기 규칙</h3>
	   <p>
       <div id="giveleftpadding">
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;공식 테니스 대회 표준 규칙 준수<br />
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;6 게임 1 세트<br />
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;6-6 게임에서 7 점 타이브레이크 적용<br />
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;각조의 선수 숫자가 다음과 같을 때<br />
            <div id="leftmargin_40">
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;<span class="contenttitle_blue">3 - 5 명:</span> 리그 스타일 (각자가 한번씩 경기)<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;<span class="contenttitle_blue">6, 8, 10 명:</span> 두 그룹으로 나누어, 각 그룹 우승자끼리 결승<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;<span class="contenttitle_blue">7 명:</span> (4 & 3)의 두 그룹으로 나누어, 각 그룹 우승자끼리 결승<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;<span class="contenttitle_blue">9 명:</span> (5 & 4)의 두 그룹으로 나누어, 각 그룹 우승자끼리 결승<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;<span class="contenttitle_blue">11 명:</span> (4 & 4 & 3)의 세 그룹으로 나누어 각 그룹 우승자끼리 한번씩 경기<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;<span class="contenttitle_blue">12 명 이상:</span> 네 그룹으로 나누어 각 그룹 우승자끼리 터너먼트 스타일로 경기<br />
            </div>
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;만약 승패가 동일한 선수가 두 명 이상 나올 경우<br />
            <div id="leftmargin_40">
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;예를 들어 3 명이 한 그룹에서 3 명 모두 1승 1패일 경우, 혹은 4 명이 한 그룹에서 2 명이 2승 1패일 경우<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;각 경기의 (점수차 x 10)으로 계산하여 더 많은 점수를 획득한 사람이 승자가 된다.<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;예를 들어 경기가 6 대 4로 끝날 경우 20점의 점수가 승자에게 더해진다.<br />
            </div>
            <img src="../images/bullet_red_8.png" />&nbsp;&nbsp;기권승/기권패가 있을 경우<br />
            <div id="leftmargin_40">
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;경기 도중 기권승/기권패가 있으면, 그 당시의 스코어로 점수를 계산한다.  예를 들어, 3 대 1의 스코어에서 경기가 중단되면 20점의 점수가 승자에게 더해진다.<br />
            <img src="../images/bullet_red_5.png" />&nbsp;&nbsp;경기가 시작되기 전 기권승/기권패가 있으면, 30점의 점수가 승자에게 더해진다.<br />
            </div>
       </div>

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