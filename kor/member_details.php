<?php require_once('../Connections/connTennis.php'); ?>
<?php
if (!function_exists("GetSQLValueString")) {
function GetSQLValueString($theValue, $theType, $theDefinedValue = "", $theNotDefinedValue = "") 
{
  $theValue = get_magic_quotes_gpc() ? stripslashes($theValue) : $theValue;

  $theValue = function_exists("mysql_real_escape_string") ? mysql_real_escape_string($theValue) : mysql_escape_string($theValue);

  switch ($theType) {
    case "text":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;    
    case "long":
    case "int":
      $theValue = ($theValue != "") ? intval($theValue) : "NULL";
      break;
    case "double":
      $theValue = ($theValue != "") ? "'" . doubleval($theValue) . "'" : "NULL";
      break;
    case "date":
      $theValue = ($theValue != "") ? "'" . $theValue . "'" : "NULL";
      break;
    case "defined":
      $theValue = ($theValue != "") ? $theDefinedValue : $theNotDefinedValue;
      break;
  }
  return $theValue;
}
}

$currentPage = $_SERVER["PHP_SELF"];
// initialize the session
if (!isset($_SESSION)) {
   session_start();
}
// Check if ID is passed from the previous page.
if (!isset($_GET["id"])) {
$current_id = $_SESSION['current_id'];
} else {
$current_id = $_GET["id"];
$_SESSION['current_id'] = $_GET["id"];
}

$maxRows_rsMemberDetails = 20;
$pageNum_rsMemberDetails = 0;
if (isset($_GET['pageNum_rsMemberDetails'])) {
  $pageNum_rsMemberDetails = $_GET['pageNum_rsMemberDetails'];
}
$startRow_rsMemberDetails = $pageNum_rsMemberDetails * $maxRows_rsMemberDetails;

mysql_select_db($database_connTennis, $connTennis);
$query_rsMemberDetails = "SELECT * FROM games WHERE (person1 = " . $current_id . ") OR (person2 = " . $current_id . ") ";
$query_rsMemberDetails .= "ORDER BY game_date DESC, Id DESC";
$query_limit_rsMemberDetails = sprintf("%s LIMIT %d, %d", $query_rsMemberDetails, $startRow_rsMemberDetails, $maxRows_rsMemberDetails);
$rsMemberDetails = mysql_query($query_limit_rsMemberDetails, $connTennis) or die(mysql_error());
$row_rsMemberDetails = mysql_fetch_assoc($rsMemberDetails);
mysql_query('set names euckr');

if (isset($_GET['totalRows_rsMemberDetails'])) {
  $totalRows_rsMemberDetails = $_GET['totalRows_rsMemberDetails'];
} else {
  $all_rsMemberDetails = mysql_query($query_rsMemberDetails);
  $totalRows_rsMemberDetails = mysql_num_rows($all_rsMemberDetails);
}
$totalPages_rsMemberDetails = ceil($totalRows_rsMemberDetails/$maxRows_rsMemberDetails)-1;

$queryString_rsMemberDetails = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsMemberDetails") == false && 
        stristr($param, "totalRows_rsMemberDetails") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsMemberDetails = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsMemberDetails = sprintf("&totalRows_rsMemberDetails=%d%s", $totalRows_rsMemberDetails, $queryString_rsMemberDetails);

if (isset($_GET['totalRows_rsMemberDetails'])) {
  $totalRows_rsMemberDetails = $_GET['totalRows_rsMemberDetails'];
} else {
  $all_rsMemberDetails = mysql_query($query_rsMemberDetails);
  $totalRows_rsMemberDetails = mysql_num_rows($all_rsMemberDetails);
}
$totalPages_rsMemberDetails = ceil($totalRows_rsMemberDetails/$maxRows_rsMemberDetails)-1;

// Get the name from the passed id.  
$query_rsPersonInfo = "SELECT first_name, last_name, G.* FROM members M INNER JOIN groups G ON M.Id = G.Id ";
$query_rsPersonInfo .= "WHERE M.Id = '" . $current_id . "'";
$rsPersonInfo = mysql_query($query_rsPersonInfo, $connTennis) or die(mysql_error());
$row_rsPersonInfo = mysql_fetch_assoc($rsPersonInfo);
mysql_query('set names euckr');

$page_title = "경기 전적"; 
$file_name = "member_details.php";
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
       <h3><span class="contentsupertitle_orange"><?php echo $row_rsPersonInfo['last_name'] . ", " . $row_rsPersonInfo['first_name']; ?></span> 경기 전적</h3> 
  <?php
	// Records for the current group.
	$total_current_matches = $row_rsPersonInfo['current_wins'] + $row_rsPersonInfo['current_losses'];
	if ($total_current_matches == 0) {
	$winning_percentage = 0;
	} else { 
	$winning_percentage = round($row_rsPersonInfo['current_wins']/$total_current_matches * 100);
	}

	// Records for the current group + previous group(s).
	$total_total_matches = $row_rsPersonInfo['total_wins'] + $row_rsPersonInfo['total_losses'];
	if ($total_total_matches == 0) {
	$total_winning_percentage = 0;
	} else { 
	$total_winning_percentage = round($row_rsPersonInfo['total_wins']/$total_total_matches * 100);
	}
  ?>
  <p>
  <!--If the current group records and total group records are the same-->
  <?php if ($total_current_matches == $total_total_matches) { ?>
  	<span class="contenttitle_green">경기 전적: </span><?php echo $row_rsPersonInfo['current_wins']; ?>승 <?php echo $row_rsPersonInfo['current_losses']; ?>패<br />
    <span class="contenttitle_green">승률: </span><?php echo $winning_percentage; ?> %
  
  <!--If the current group records and total group records are different -->
  <?php } else { ?>
  	<span class="contenttitle_green">현조 경기 전적: </span><?php echo $row_rsPersonInfo['current_wins']; ?>승 <?php echo $row_rsPersonInfo['current_losses']; ?>패<br />
    <span class="contenttitle_green">현조 승률: </span><?php echo $winning_percentage; ?> %<br />
  	<span class="contenttitle_green">전체 경기 전적: </span><?php echo $row_rsPersonInfo['total_wins']; ?>승 <?php echo $row_rsPersonInfo['total_losses']; ?>패<br />
    <span class="contenttitle_green">전체 경기 승률: </span><?php echo $total_winning_percentage; ?> %<br />
  <?php } ?>
  </p>
       
       <div class="text_black" align="right"><span class="text_red"><?php echo ($startRow_rsMemberDetails + 1) ?></span> to <span class="text_red"><?php echo min($startRow_rsMemberDetails + $maxRows_rsMemberDetails, $totalRows_rsMemberDetails) ?></span> of Total <span class="text_red"><?php echo $totalRows_rsMemberDetails ?></span> Records &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<?php if ($totalRows_rsMemberDetails > 0) { ?>
       <table width="98%" border="1" cellspacing="0" cellpadding="3">
  <tr align="center" bgcolor="#CCCCCC">
    <td width="12%">경기 날짜</td>
    <td width="21%">Person A</td>
    <td width="16%">Person A 점수</td>
    <td width="17%">Person B 점수</td>
    <td width="21%">Person B</td>
    <td width="6%">점수</td>
    <td width="7%">조</td>
  </tr>
  <?php $current_row = 0; ?>  
  <?php do { $current_row++ ?>
    <tr align="center" <?php if (($current_row % 2) == 1) { ?>bgcolor="#FAFDB3"<?php } ?>>
      <td><?php echo date('n/j/Y', strtotime($row_rsMemberDetails['game_date'])); ?></td>
      <td>
        <?php
	// Query to get person name 1  
	$query_rsNames = "SELECT first_name, last_name FROM members WHERE Id = '" . $row_rsMemberDetails['person1'] . "'";
	$rsNames = mysql_query($query_rsNames, $connTennis) or die(mysql_error());
	$row_rsNames = mysql_fetch_assoc($rsNames);
	mysql_query('set names euckr'); ?>
    <?php if ($row_rsMemberDetails['person1'] == $current_id) { ?><span class="text_blue"><?php } ?>
	<?php echo $row_rsNames['last_name'] . ", " . $row_rsNames['first_name']; ?>      
      </td>
      <td><?php echo $row_rsMemberDetails['person1_score']; ?></td>
      <td><?php echo $row_rsMemberDetails['person2_score']; ?></td>
      <td>
        <?php
	// Query to get person name 2  
	$query_rsNames2 = "SELECT first_name, last_name FROM members WHERE Id = '" . $row_rsMemberDetails['person2'] . "'";
	$rsNames2 = mysql_query($query_rsNames2, $connTennis) or die(mysql_error());
	$row_rsNames2 = mysql_fetch_assoc($rsNames2);
	mysql_query('set names euckr'); ?>
    <?php if ($row_rsMemberDetails['person2'] == $current_id) { ?><span class="text_blue"><?php } ?>
	<?php echo $row_rsNames2['last_name'] . ", " . $row_rsNames2['first_name'];
  ?>      </td>
      <td>
	  <?php $points_earned = ($row_rsMemberDetails['person1_score'] - $row_rsMemberDetails['person2_score']) * 10; ?>
	  <?php if ($row_rsMemberDetails['person1'] == $current_id) { ?>
      + <?php } else { ?> - <?php } ?>
      <?php echo $points_earned; ?>
      </td>
      <td><?php echo $row_rsMemberDetails['r_group']; ?></td>
    </tr>
    <?php } while ($row_rsMemberDetails = mysql_fetch_assoc($rsMemberDetails)); ?>
  
</table>
	  <?php } else { ?>
      There is no record to display.
      <?php } ?>

<!--Page navigation goes here.-->
<div align="center">
<?php if ($pageNum_rsMemberDetails > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsMemberDetails=%d%s", $currentPage, 0, $queryString_rsMemberDetails); ?>"><img src="../images/First.gif" border=0></a>
          <?php } // Show if not first page ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if ($pageNum_rsMemberDetails > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsMemberDetails=%d%s", $currentPage, max(0, $pageNum_rsMemberDetails - 1), $queryString_rsMemberDetails); ?>"><img src="../images/Previous.gif" border=0></a>
          <?php } // Show if not first page ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if ($pageNum_rsMemberDetails < $totalPages_rsMemberDetails) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsMemberDetails=%d%s", $currentPage, min($totalPages_rsMemberDetails, $pageNum_rsMemberDetails + 1), $queryString_rsMemberDetails); ?>"><img src="../images/Next.gif" border=0></a>
          <?php } // Show if not last page ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if ($pageNum_rsMemberDetails < $totalPages_rsMemberDetails) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsMemberDetails=%d%s", $currentPage, $totalPages_rsMemberDetails, $queryString_rsMemberDetails); ?>"><img src="../images/Last.gif" border=0></a>
          <?php } // Show if not last page ?>
</div>
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
mysql_free_result($rsMemberDetails);
mysql_free_result($rsNames);
mysql_free_result($rsNames2);
?>