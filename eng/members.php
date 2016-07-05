<?php require_once('../Connections/connTennis.php'); ?>
<?php 
$page_title = "Members - Tucson Korean Tennis Association"; 
$file_name = "members.php";

// mysqli_select_db($database_connTennis, $connTennis);
mysqli_select_db($connTennis, $database_connTennis);
$query_rsNumberCounts = "SELECT (SELECT count(status_student) FROM members WHERE status_student = 1 AND active_member = 1) AS Student_Num, ";
$query_rsNumberCounts .= "(SELECT count(status_student) FROM members WHERE status_student = 0 AND active_member = 1) AS Non_Student_Num, ";
$query_rsNumberCounts .= "(SELECT count(gender) FROM members WHERE gender = 'M' AND active_member = 1) AS Male_Num, ";
$query_rsNumberCounts .= "(SELECT count(gender) FROM members WHERE gender = 'F' AND active_member = 1) AS Female_Num, ";
$query_rsNumberCounts .= "(SELECT count(ethnicity_korean) FROM members WHERE ethnicity_korean = 1 AND active_member = 1) AS Korean_Num, ";
$query_rsNumberCounts .= "(SELECT count(ethnicity_korean) FROM members WHERE ethnicity_korean = 0 AND active_member = 1) AS Non_Korean_Num, ";
$query_rsNumberCounts .= "(SELECT count(language_korean) FROM members WHERE language_korean = 1 AND active_member = 1) AS KoreanSpeaker_Num, ";
$query_rsNumberCounts .= "(SELECT count(language_korean) FROM members WHERE language_korean = 0 AND active_member = 1) AS EnglishSpeaker_Num ";
// $rsNumberCounts = mysqli_query($query_rsNumberCounts, $connTennis) or die(mysql_error());
$rsNumberCounts = mysqli_query($connTennis, $query_rsNumberCounts) or die(mysqli_error());
$row_rsNumberCounts = mysqli_fetch_assoc($rsNumberCounts);
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
   <table id="">
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
       <h3 class="contentmaintitle_green">Distribution Charts for All Members as of <?php echo date("M. j, Y"); ?></h3>
       <p>These are distribution charts for all members.</p>
       <span class="contenttitle_orange">Total: <?php echo $total_number; ?></span>
       <p>
       <div class="subtitle_black">Students vs Non-Students</div>
<table id="chart_table">
<tr>
<td>
        <?php
		include('graphs.inc.php');
		$student_num = $row_rsNumberCounts['Student_Num'];
		$non_student_num = $row_rsNumberCounts['Non_Student_Num'];
		$graph = new BAR_GRAPH2("vBar2");
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
		?>
</td>
<td valign="bottom">
<div id="giveleftpadding">
<div class="text_red">Students: </div>
students at U of A, Pima College, high schools and po-docs<br /><br />
<div class="text_red">Non-Students: </div>
business owners, salarymen, housewives, visitors from Korea and people with various occupations
</div>
</td>
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
		$graph = new BAR_GRAPH2("vBar2");
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
		?>
</td>
<td valign="bottom">
</td>
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
		$graph = new BAR_GRAPH2("vBar2");
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
		?>
</td>
<td valign="bottom">
</td>
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
		$graph = new BAR_GRAPH2("vBar2");
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
people with Korean as the first language<br /><br />
<div class="text_red">English Speaker: </div>
people with English or other languages as the first language, <br />
or Korean and English bilingual speakers
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