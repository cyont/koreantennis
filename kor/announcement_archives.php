<?php require_once('../Connections/connTennis.php'); ?>
<?php
$page_title = "Announcement Arichives"; 
$file_name = "announcement_archives.php";

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

$maxRows_rsAnnouncement = 7;
$pageNum_rsAnnouncement = 0;
if (isset($_GET['pageNum_rsAnnouncement'])) {
  $pageNum_rsAnnouncement = $_GET['pageNum_rsAnnouncement'];
}
$startRow_rsAnnouncement = $pageNum_rsAnnouncement * $maxRows_rsAnnouncement;

$colname_rsAnnouncement = "-1";
if (isset($_GET['lid'])) {
  $colname_rsAnnouncement = $_GET['lid'];
}
mysql_select_db($database_connTennis, $connTennis);
mysql_query('set names euckr');
$query_rsAnnouncement = "SELECT * FROM announcement WHERE lid = 44 and koreantennis = 1 ORDER BY `timestamp` DESC";
$query_limit_rsAnnouncement = sprintf("%s LIMIT %d, %d", $query_rsAnnouncement, $startRow_rsAnnouncement, $maxRows_rsAnnouncement);
$rsAnnouncement = mysql_query($query_limit_rsAnnouncement, $connTennis) or die(mysql_error());
$row_rsAnnouncement = mysql_fetch_assoc($rsAnnouncement);

if (isset($_GET['totalRows_rsAnnouncement'])) {
  $totalRows_rsAnnouncement = $_GET['totalRows_rsAnnouncement'];
} else {
  $all_rsAnnouncement = mysql_query($query_rsAnnouncement);
  $totalRows_rsAnnouncement = mysql_num_rows($all_rsAnnouncement);
}
$totalPages_rsAnnouncement = ceil($totalRows_rsAnnouncement/$maxRows_rsAnnouncement)-1;

$queryString_rsAnnouncement = "";
if (!empty($_SERVER['QUERY_STRING'])) {
  $params = explode("&", $_SERVER['QUERY_STRING']);
  $newParams = array();
  foreach ($params as $param) {
    if (stristr($param, "pageNum_rsAnnouncement") == false && 
        stristr($param, "totalRows_rsAnnouncement") == false) {
      array_push($newParams, $param);
    }
  }
  if (count($newParams) != 0) {
    $queryString_rsAnnouncement = "&" . htmlentities(implode("&", $newParams));
  }
}
$queryString_rsAnnouncement = sprintf("&totalRows_rsAnnouncement=%d%s", $totalRows_rsAnnouncement, $queryString_rsAnnouncement);
 
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
       <h3>Tucson Korean Tennis Association</h3>
       <p>
       <div class="subtitle_black">Announcements</div>
       <ul>
       	   <?php do { ?>
       	     <li><span class="contenttitle_green"><?php echo $row_rsAnnouncement['title']; ?></span> (posted on <span class="text_red"><?php echo date('n/j/Y, h:i A', strtotime($row_rsAnnouncement['timestamp'])); ?></span>)<br />
       	       <?php echo $row_rsAnnouncement['announcement']; ?><br /><br />
     	       </li>
       	     <?php } while ($row_rsAnnouncement = mysql_fetch_assoc($rsAnnouncement)); ?></ul>
       </p>
       <div align="center">
       <?php if ($pageNum_rsAnnouncement > 0) { // Show if not first page ?>
                 <a href="<?php printf("%s?pageNum_rsAnnouncement=%d%s", $currentPage, 0, $queryString_rsAnnouncement); ?>"><img src="../images/First.gif" border=0></a>
                 <?php } // Show if not first page ?>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php if ($pageNum_rsAnnouncement > 0) { // Show if not first page ?>
                 <a href="<?php printf("%s?pageNum_rsAnnouncement=%d%s", $currentPage, max(0, $pageNum_rsAnnouncement - 1), $queryString_rsAnnouncement); ?>"><img src="../images/Previous.gif" border=0></a>
                 <?php } // Show if not first page ?>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
	   <?php if ($pageNum_rsAnnouncement < $totalPages_rsAnnouncement) { // Show if not last page ?>
                 <a href="<?php printf("%s?pageNum_rsAnnouncement=%d%s", $currentPage, min($totalPages_rsAnnouncement, $pageNum_rsAnnouncement + 1), $queryString_rsAnnouncement); ?>"><img src="../images/Next.gif" border=0></a>
                 <?php } // Show if not last page ?>
       &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
       <?php if ($pageNum_rsAnnouncement < $totalPages_rsAnnouncement) { // Show if not last page ?>
                 <a href="<?php printf("%s?pageNum_rsAnnouncement=%d%s", $currentPage, $totalPages_rsAnnouncement, $queryString_rsAnnouncement); ?>"><img src="../images/Last.gif" border=0></a>
                 <?php } // Show if not last page ?>
		&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
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
mysql_free_result($rsAnnouncement);
?>