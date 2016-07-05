<?php
session_start(); // Initialize session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg6.php" ?>
<?php include "ewmysql6.php" ?>
<?php include "phpfn6.php" ?>
<?php include "commentsinfo.php" ?>
<?php include "membersinfo.php" ?>
<?php include "userfn6.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
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

mysql_select_db($database_connTennis, $connTennis);
$query_rsEmailList = "SELECT first_name, last_name, email, ethnicity_korean FROM members WHERE active_member = 1 AND LENGTH(email) > 0 ORDER BY ethnicity_korean DESC, email ASC";
$rsEmailList = mysql_query($query_rsEmailList, $connTennis) or die(mysql_error());
$row_rsEmailList = mysql_fetch_assoc($rsEmailList);
$totalRows_rsEmailList = mysql_num_rows($rsEmailList);
 ?>
<?php include "header.php" ?>

<h3>Member Email List</h3>

		<?php 
		do {
		?>
        
        <?php 
		if ($row_rsEmailList['ethnicity_korean'] == 1) {
		echo '"' . $row_rsEmailList['last_name'] . " " . $row_rsEmailList['first_name'] . '" &lt;' . $row_rsEmailList['email'] . '&gt;;' ;  } else {
		echo '"' . $row_rsEmailList['first_name'] . " " . $row_rsEmailList['last_name'] . '" &lt;' . $row_rsEmailList['email'] . '&gt;;' ;	
		}
		?><br />
        <?php
		} while ($row_rsEmailList = mysql_fetch_assoc($rsEmailList));
		?>
        "Tucson Korean Tennis" &lt;contact@koreantennis.org&gt;

<p>
<h4>Total Records: <?php echo $totalRows_rsEmailList; ?></h4>

</p>
<?php
mysql_free_result($rsEmailList);
?>