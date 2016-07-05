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
$query_rsMemberGroups = "SELECT DISTINCT r_group FROM groups ORDER BY r_group ASC";
$rsMemberGroups = mysql_query($query_rsMemberGroups, $connTennis) or die(mysql_error());
$row_rsMemberGroups = mysql_fetch_assoc($rsMemberGroups);
$totalRows_rsMemberGroups = mysql_num_rows($rsMemberGroups);
 
$page_title = "Member List by Group"; 
$file_name = "member_list.php";
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html40/strict.dtd">
<html>
<head>
	<script src="/scripts/jquery/jquery-1.4.4.js"></script>
	<script src="/scripts/jquery/jquery.ui.core.js"></script>
	<script src="/scripts/jquery/jquery.ui.widget.js"></script>
	<script src="/scripts/jquery/jquery.ui.accordion.js"></script>
	<script>
	$(function() {
		$( "#accordion" ).accordion();
	});
	</script>
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
       <h3>Member List by Group</h3>




       <span class="contenttitle_red">NOTE TO MEMBERS</span><br />
       If you want, you can 
       <ul>
       <li>Have your nickname instead of real name displayed </li>
       <li>Keep the membership, but choose not to be displayed in the list</li>
       <li>Cancel the membership</li>
       <li>Change any wrong information (name spelling, wrong group or active/inactive status) </li>
       </ul>
       Just email <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>. 
	   <?php do { ?>
	     <p>

<div class="demo">

<div id="accordion">

	     <div id="leftmargin_40" class="contentsubtitle_orange"><?php echo $row_rsMemberGroups['r_group']; ?> Group</div>	           
         <?php
		$query_rsMemberList = "SELECT first_name_eng, last_name_eng FROM members M INNER JOIN groups G ON M.Id = G.Id ";
		$query_rsMemberList .= "WHERE active_member = 1 AND inactive = 0 AND hide_list = 0 AND r_group = '" . $row_rsMemberGroups['r_group'] . "' ";
		$query_rsMemberList .= "ORDER BY first_name_eng ASC, last_name_eng ASC";
		$rsMemberList = mysql_query($query_rsMemberList, $connTennis) or die(mysql_error());
		$row_rsMemberList = mysql_fetch_assoc($rsMemberList);
		?>
		<?php 
		do {
		?>
		<div id="leftmargin_40" class="text_black"><?php echo $row_rsMemberList['first_name_eng']; ?> <?php echo $row_rsMemberList['last_name_eng']; ?></div>
        
        <?php
		} while ($row_rsMemberList = mysql_fetch_assoc($rsMemberList));
		?>
         </p>
	     <?php } while ($row_rsMemberGroups = mysql_fetch_assoc($rsMemberGroups)); ?>

</div>

</div>
         <p>
         <div id="leftmargin_40" class="contentsubtitle_orange">Inactive members</div>
         <?php
		$query_rsMemberInactive = "SELECT first_name_eng, last_name_eng, r_group FROM members M INNER JOIN groups G ON M.Id = G.Id ";
		$query_rsMemberInactive .= "WHERE active_member = 1 AND inactive = 1 AND hide_list = 0 ";
		$query_rsMemberInactive .= "ORDER BY first_name_eng ASC, last_name_eng ASC";
		$rsMemberInactive = mysql_query($query_rsMemberInactive, $connTennis) or die(mysql_error());
		$row_rsMemberInactive = mysql_fetch_assoc($rsMemberInactive);
		?>
		<?php 
		do {
		?>
		<div id="leftmargin_40" class="text_black"><?php echo $row_rsMemberInactive['first_name_eng']; ?> <?php echo $row_rsMemberInactive['last_name_eng']; ?> (<?php echo $row_rsMemberInactive['r_group']; ?>)</div>
        
        <?php
		} while ($row_rsMemberInactive = mysql_fetch_assoc($rsMemberInactive));
		?>


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
<?php
mysql_free_result($rsMemberGroups);
?>