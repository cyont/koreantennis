<?php require_once('../Connections/connTennis.php'); ?>
<?php 
$page_title = "Members - Tucson Korean Tennis Association"; 
$file_name = "members.php";

mysql_select_db($database_connTennis, $connTennis);
$query_rsNumberCounts = "SELECT (SELECT count(status_student) FROM members WHERE status_student = 1 AND active_member = 1) AS Student_Num, ";
$query_rsNumberCounts .= "(SELECT count(status_student) FROM members WHERE status_student = 0 AND active_member = 1) AS Non_Student_Num, ";
$query_rsNumberCounts .= "(SELECT count(gender) FROM members WHERE gender = 'M' AND active_member = 1) AS Male_Num, ";
$query_rsNumberCounts .= "(SELECT count(gender) FROM members WHERE gender = 'F' AND active_member = 1) AS Female_Num, ";
$query_rsNumberCounts .= "(SELECT count(ethnicity_korean) FROM members WHERE ethnicity_korean = 1 AND active_member = 1) AS Korean_Num, ";
$query_rsNumberCounts .= "(SELECT count(ethnicity_korean) FROM members WHERE ethnicity_korean = 0 AND active_member = 1) AS Non_Korean_Num, ";
$query_rsNumberCounts .= "(SELECT count(language_korean) FROM members WHERE language_korean = 1 AND active_member = 1) AS KoreanSpeaker_Num, ";
$query_rsNumberCounts .= "(SELECT count(language_korean) FROM members WHERE language_korean = 0 AND active_member = 1) AS EnglishSpeaker_Num ";
$rsNumberCounts = mysql_query($query_rsNumberCounts, $connTennis) or die(mysql_error());
$row_rsNumberCounts = mysql_fetch_assoc($rsNumberCounts);
$total_number = $row_rsNumberCounts['Male_Num'] + $row_rsNumberCounts['Female_Num'];
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
       <div class="content2">
       <h3 class="contentmaintitle_green"><?php echo date("Y년 n월 j일"); ?> 현재 All Member 분포</h3>
       <p>아래 All Member 분포 차트를 참조하세요.</p>
       <span class="contenttitle_orange">총 회원 수: <?php echo $total_number; ?></span>
       <p>
       <div class="subtitle_black">Students vs Non-Students</div>
<table id="chart_table">
<tr>
<td>
        <?php
		include('graphs.inc.php');
		$student_num = $row_rsNumberCounts['Student_Num'];
		$non_student_num = $row_rsNumberCounts['Non_Student_Num'];
		$graph = new BAR_GRAPH("vBar");
		$graph->values = "$student_num, $non_student_num";
		$graph->labels = "&nbsp;&nbsp;&nbsp;&nbsp;Students&nbsp;&nbsp;&nbsp;&nbsp;,NonStudents";
		$graph->showValues = 0;
		// $graph->showValues = 1;
		$graph->barWidth = 20;
		$graph->barLength = 1.0;
		$graph->labelSize = 12;
		$graph->absValuesSize = 12;
		$graph->percValuesSize = 12;
		$graph->graphPadding = 10;
		$graph->graphBGColor = "#ABCDEF";
		$graph->graphBorder = "1px solid blue";
		$graph->barColors = "#A0C0F0";
		$graph->barBGColor = "#E0F0FF";
		$graph->barBorder = "2px outset white";
		$graph->labelColor = "#000000";
		$graph->labelBGColor = "#C0E0FF";
		$graph->labelBorder = "2px groove white";
		$graph->absValuesColor = "#000000";
		$graph->absValuesBGColor = "#FFFFFF";
		$graph->absValuesBorder = "2px groove white";
		echo $graph->create();
		?></td>
<td valign="bottom">
<div id="giveleftpadding">
<div class="text_red">Students: </div>
U of A와 Pima College의 학생, 고등학생, 포닥
<br /><br />
<div class="text_red">Non-Students: </div>
자영업자, 샐러리맨, 주부, 한국에서 온 방문자, 그 밖의 다양한 직종 종사자</div></td>
</tr>
</table>
		</p>
       <p>
       <div class="subtitle_black">Male vs Female</div>
<table id="chart_table">
<tr>
<td>
        <?php
		$male_num = $row_rsNumberCounts['Male_Num'];
		$female_num = $row_rsNumberCounts['Female_Num'];
		$graph = new BAR_GRAPH("vBar");
		$graph->values = "$male_num ,$female_num";
		$graph->labels = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Male&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Female&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$graph->showValues = 0;
		// $graph->showValues = 1;
		$graph->barWidth = 20;
		$graph->barLength = 1.0;
		$graph->labelSize = 12;
		$graph->absValuesSize = 12;
		$graph->percValuesSize = 12;
		$graph->graphPadding = 10;
		$graph->graphBGColor = "#ABCDEF";
		$graph->graphBorder = "1px solid blue";
		$graph->barColors = "#A0C0F0";
		$graph->barBGColor = "#E0F0FF";
		$graph->barBorder = "2px outset white";
		$graph->labelColor = "#000000";
		$graph->labelBGColor = "#C0E0FF";
		$graph->labelBorder = "2px groove white";
		$graph->absValuesColor = "#000000";
		$graph->absValuesBGColor = "#FFFFFF";
		$graph->absValuesBorder = "2px groove white";
		echo $graph->create();
		?></td>
<td valign="bottom"></td>
</tr>
</table>
		</p>

       <p>
       <div class="subtitle_black">Korean vs Non-Korean</div>
<table id="chart_table">
<tr>
<td>
        <?php
		$Korean_Num = $row_rsNumberCounts['Korean_Num'];
		$Non_Korean_Num = $row_rsNumberCounts['Non_Korean_Num'];
		$graph = new BAR_GRAPH("vBar");
		$graph->values = "$Korean_Num ,$Non_Korean_Num";
		$graph->labels = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Korean&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;, &nbsp;&nbsp;&nbsp;NonKorean&nbsp;";
		$graph->showValues = 0;
		// $graph->showValues = 1;
		$graph->barWidth = 20;
		$graph->barLength = 1.0;
		$graph->labelSize = 12;
		$graph->absValuesSize = 12;
		$graph->percValuesSize = 12;
		$graph->graphPadding = 10;
		$graph->graphBGColor = "#ABCDEF";
		$graph->graphBorder = "1px solid blue";
		$graph->barColors = "#A0C0F0";
		$graph->barBGColor = "#E0F0FF";
		$graph->barBorder = "2px outset white";
		$graph->labelColor = "#000000";
		$graph->labelBGColor = "#C0E0FF";
		$graph->labelBorder = "2px groove white";
		$graph->absValuesColor = "#000000";
		$graph->absValuesBGColor = "#FFFFFF";
		$graph->absValuesBorder = "2px groove white";
		echo $graph->create();
		?></td>
<td valign="bottom"></td>
</tr>
</table>
		</p>
<!--
       <p>
       <div class="subtitle_black">Korean Speaker vs English Speaker</div>
<table id="chart_table">
<tr>
<td>
        <?php
		$KoreanSpeaker_Num = $row_rsNumberCounts['KoreanSpeaker_Num'];
		$EnglishSpeaker_Num = $row_rsNumberCounts['EnglishSpeaker_Num'];
		$graph = new BAR_GRAPH("vBar");
		$graph->values = "$KoreanSpeaker_Num ,$EnglishSpeaker_Num";
		$graph->labels = "&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Korean&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;, &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;English&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;";
		$graph->showValues = 0;
		// $graph->showValues = 1;
		$graph->barWidth = 20;
		$graph->barLength = 1.0;
		$graph->labelSize = 12;
		$graph->absValuesSize = 12;
		$graph->percValuesSize = 12;
		$graph->graphPadding = 10;
		$graph->graphBGColor = "#ABCDEF";
		$graph->graphBorder = "1px solid blue";
		$graph->barColors = "#A0C0F0";
		$graph->barBGColor = "#E0F0FF";
		$graph->barBorder = "2px outset white";
		$graph->labelColor = "#000000";
		$graph->labelBGColor = "#C0E0FF";
		$graph->labelBorder = "2px groove white";
		$graph->absValuesColor = "#000000";
		$graph->absValuesBGColor = "#FFFFFF";
		$graph->absValuesBorder = "2px groove white";
		echo $graph->create();
		?>
</td>
<td valign="bottom">
<div id="giveleftpadding">
<div class="text_red">Korean Speaker: </div>
한국어를 모국어로 하는 사람<br /><br />
<div class="text_red">English Speaker: </div>
영어 및 그 밖의 언어를 모국어로 하는 사람, <br />혹은 한국어와 영어 이중 언어 사용자
</div>
</td>
</tr>
</table>
		</p>
-->
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
<?php
mysql_free_result($rsNumberCounts);
?>