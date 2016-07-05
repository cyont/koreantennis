<?php require_once('../Connections/connTennis.php'); ?>
<?php
$page_title = "Home - Tucson Korean Tennis Association"; 
$file_name = "index.php";

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

$colname_rsAnnouncement = "-1";
if (isset($_GET['lid'])) {
  $colname_rsAnnouncement = $_GET['lid'];
}
//mysqli_select_db($database_connTennis, $connTennis);
// mysqli_select_db (mysqli $link, string $database_connTennis);
mysqli_select_db($connTennis, $database_connTennis);
echo "Conneted Successfully";

//$query_rsAnnouncement = "SELECT * FROM announcement WHERE lid = 21 and koreantennis = 1 and active=1 ORDER BY `timestamp` DESC";
//$rsAnnouncement = mysqli_query($query_rsAnnouncement, $connTennis) or die(mysql_error());
//$row_rsAnnouncement = mysql_fetch_assoc($rsAnnouncement);
//$totalRows_rsAnnouncement = mysql_num_rows($rsAnnouncement);
 
 $sql = "SELECT * FROM announcement WHERE lid = 21 and koreantennis = 1 and active=1 ORDER BY `timestamp` DESC";
 if ($result = $mysqli->query($sql)) {
	while($obj = $result->fetch_object()){
		$line.=$obj->id;	
	}
 }
 
?>
