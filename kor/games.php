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

$maxRows_rsGameDetails = 20;
$pageNum_rsGameDetails = 0;
if (isset($_GET['pageNum_rsGameDetails'])) {
  $pageNum_rsGameDetails = $_GET['pageNum_rsGameDetails'];
}
$startRow_rsGameDetails = $pageNum_rsGameDetails * $maxRows_rsGameDetails;

mysql_select_db($database_connTennis, $connTennis);
$query_rsGameDetails = "SELECT * FROM games ORDER BY game_date DESC, Id DESC";
$query_limit_rsGameDetails = sprintf("%s LIMIT %d, %d", $query_rsGameDetails, $startRow_rsGameDetails, $maxRows_rsGameDetails);
$rsGameDetails = mysql_query($query_limit_rsGameDetails, $connTennis) or die(mysql_error());
$row_rsGameDetails = mysql_fetch_assoc($rsGameDetails);
mysql_query('set names euckr');

if (isset($_GET['totalRows_rsGameDetails'])) {
  $totalRows_rsGameDetails = $_GET['totalRows_rsGameDetails'];
} else {
  $all_rsGameDetails = mysql_query($query_rsGameDetails);
  $totalRows_rsGameDetails = mysql_num_rows($all_rsGameDetails);
}
$totalPages_rsGameDetails = ceil($totalRows_rsGameDetails/$maxRows_rsGameDetails)-1;

$queryString_rsGameDetails = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsGameDetails") == false && 
        stristr($param, "totalRows_rsGameDetails") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsGameDetails = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsGameDetails = sprintf("&totalRows_rsGameDetails=%d%s", $totalRows_rsGameDetails, $queryString_rsGameDetails);

if (isset($_GET['totalRows_rsGameDetails'])) {
  $totalRows_rsGameDetails = $_GET['totalRows_rsGameDetails'];
} else {
  $all_rsGameDetails = mysql_query($query_rsGameDetails);
  $totalRows_rsGameDetails = mysql_num_rows($all_rsGameDetails);
}
$totalPages_rsGameDetails = ceil($totalRows_rsGameDetails/$maxRows_rsGameDetails)-1;

$page_title = "경기 전적"; 
$file_name = "games.php";
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
       <h3>경기 전적</h3> 
       회원께서 원하시면
       <ul>
       <li>실명 대신 가명이나 별명으로 대신할 수도 있습니다</li>
       <li>목록에서 이름을 삭제할 수도 있습니다</li>
       </ul>
       <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>로 이메일 보내 주세요.
       <div class="text_black" align="right"><span class="text_red"><?php echo ($startRow_rsGameDetails + 1) ?></span> to <span class="text_red"><?php echo min($startRow_rsGameDetails + $maxRows_rsGameDetails, $totalRows_rsGameDetails) ?></span> of Total <span class="text_red"><?php echo $totalRows_rsGameDetails ?></span> Records &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
<?php if ($totalRows_rsGameDetails > 0) { ?>
       <table width="98%" border="1" cellspacing="0" cellpadding="3">
  <tr align="center" bgcolor="#CCCCCC">
    <td width="12%">경기 날짜</td>
    <td width="24%">Person A</td>
    <td width="16%">Person A 점수</td>
    <td width="17%">Person B 점수</td>
    <td width="24%">Person B</td>
    <td width="7%">조</td>
  </tr>
  <?php $current_row = 0; ?>  
  <?php do { $current_row++ ?>
    <tr align="center" <?php if (($current_row % 2) == 1) { ?>bgcolor="#FAFDB3"<?php } ?>>
      <td><?php echo date('n/j/Y', strtotime($row_rsGameDetails['game_date'])); ?></td>
      <td>
        <?php
	// Query to get person name 1  
	$query_rsNames = "SELECT Id, first_name, last_name FROM members WHERE Id = '" . $row_rsGameDetails['person1'] . "'";
	$rsNames = mysql_query($query_rsNames, $connTennis) or die(mysql_error());
	$row_rsNames = mysql_fetch_assoc($rsNames);
	mysql_query('set names euckr'); 
	?>
    <a href="member_details.php?id=<?php echo $row_rsNames['Id']; ?>"><?php echo $row_rsNames['last_name'] . ", " . $row_rsNames['first_name']; ?></a>      </td>
      <td><?php echo $row_rsGameDetails['person1_score']; ?></td>
      <td><?php echo $row_rsGameDetails['person2_score']; ?></td>
      <td>
        <?php
	// Query to get person name 2  
	$query_rsNames2 = "SELECT Id, first_name, last_name FROM members WHERE Id = '" . $row_rsGameDetails['person2'] . "'";
	$rsNames2 = mysql_query($query_rsNames2, $connTennis) or die(mysql_error());
	$row_rsNames2 = mysql_fetch_assoc($rsNames2);
	mysql_query('set names euckr');
	?>
    <a href="member_details.php?id=<?php echo $row_rsNames2['Id']; ?>"><?php echo $row_rsNames2['last_name'] . ", " . $row_rsNames2['first_name']; ?> </a>     </td>
      <td><?php echo $row_rsGameDetails['r_group']; ?></td>
    </tr>
    <?php } while ($row_rsGameDetails = mysql_fetch_assoc($rsGameDetails)); ?>
  
</table>
	  <?php } else { ?>
      There is no record to display.
      <?php } ?>

<!--Page navigation goes here.-->
<div align="center">
<?php if ($pageNum_rsGameDetails > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsGameDetails=%d%s", $currentPage, 0, $queryString_rsGameDetails); ?>"><img src="../images/First.gif" border=0></a>
          <?php } // Show if not first page ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if ($pageNum_rsGameDetails > 0) { // Show if not first page ?>
          <a href="<?php printf("%s?pageNum_rsGameDetails=%d%s", $currentPage, max(0, $pageNum_rsGameDetails - 1), $queryString_rsGameDetails); ?>"><img src="../images/Previous.gif" border=0></a>
          <?php } // Show if not first page ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if ($pageNum_rsGameDetails < $totalPages_rsGameDetails) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsGameDetails=%d%s", $currentPage, min($totalPages_rsGameDetails, $pageNum_rsGameDetails + 1), $queryString_rsGameDetails); ?>"><img src="../images/Next.gif" border=0></a>
          <?php } // Show if not last page ?>
&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
<?php if ($pageNum_rsGameDetails < $totalPages_rsGameDetails) { // Show if not last page ?>
          <a href="<?php printf("%s?pageNum_rsGameDetails=%d%s", $currentPage, $totalPages_rsGameDetails, $queryString_rsGameDetails); ?>"><img src="../images/Last.gif" border=0></a>
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
mysql_free_result($rsGameDetails);
mysql_free_result($rsNames);
mysql_free_result($rsNames2);
?>