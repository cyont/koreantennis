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
$query_rsCourtRegions = "SELECT id, region FROM courts GROUP BY region ORDER BY region ASC";
$rsCourtRegions = mysql_query($query_rsCourtRegions, $connTennis) or die(mysql_error());
$row_rsCourtRegions = mysql_fetch_assoc($rsCourtRegions);
$totalRows_rsCourtRegions = mysql_num_rows($rsCourtRegions);
 
$page_title = "Tennis Courts in Tucson - Tucson Korean Tennis Association"; 
$file_name = "courts.php";
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
       <h3>Tennis Courts in Tucson</h3>
       If you find any infromation wrong on this page, or if you can think of more names to be added on this list, <br />please post it on the Bulletin Board at Forum or email us at <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>. 
	   <?php do { ?>
	     <p>
	     <div class="contentsubtitle_orange"><?php echo $row_rsCourtRegions['region']; ?></div>	           
         <?php
		mysql_select_db($database_connTennis, $connTennis);
		$query_rsCourt = "SELECT * FROM courts WHERE region = '" . $row_rsCourtRegions['region'] . "' ORDER BY name ASC";
		$rsCourt = mysql_query($query_rsCourt, $connTennis) or die(mysql_error());
		$row_rsCourt = mysql_fetch_assoc($rsCourt);
		?>
		<?php 
		do {
		?>
		<div class="contenttitle_green"><?php if (strlen($row_rsCourt['website']) > 0) { ?><a href="<?php echo $row_rsCourt['website']; ?>" target="_blank"><span class="contenttitle_green"><?php } ?><?php echo $row_rsCourt['name']; ?><?php if (strlen($row_rsCourt['website']) > 0) { ?></span></a><?php } ?><?php if (strlen($row_rsCourt['phone']) > 0) { ?><span class="textsmall_black"> (<?php echo $row_rsCourt['phone']; ?>)</span> <?php } ?></div>
        <?php if ($row_rsCourt['name'] != $row_rsCourt['location']) { echo $row_rsCourt['location']; ?><br /><?php } ?>
        <?php echo $row_rsCourt['address'];  ?>, <?php echo $row_rsCourt['city']; ?> <?php echo $row_rsCourt['zip'];  ?>
        <table id="court_table" cellspacing="0" cellpadding="3" bordercolor="#993333">
  		<tr bgcolor="#F2FFF0">
        <td width="111"><div align="center">Number of Courts</div></td>
    	<td width="131"><div align="center">Cost</div></td>
        <td width="134"><div align="center">Lights at Night</div></td>
        <td width="98"><div align="center">Maintenance</div></td>
        </tr>
        <tr bgcolor="#FFFFFF" valign="top">
        <td><div align="center"><?php echo $row_rsCourt['court_num']; ?></div></td>
    	<td><div align="center"><?php echo $row_rsCourt['cost']; ?></div></td>
        <td><div align="center"><?php echo $row_rsCourt['lights']; ?></div></td>
        <td><div align="center"><?php echo $row_rsCourt['maintenance']; ?></div></td>
        </tr>
        </table>
        <?php
		} while ($row_rsCourt = mysql_fetch_assoc($rsCourt));
		?>
         </p>
	     <?php } while ($row_rsCourtRegions = mysql_fetch_assoc($rsCourtRegions)); ?></div>
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
mysql_free_result($rsCourtRegions);
?>