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
$query_rsRankings = "SELECT first_name_eng, last_name_eng, G.* FROM members M INNER JOIN groups G ON M.Id = G.Id ";
$query_rsRankings .= "WHERE active_member = 1 AND inactive = 0 AND hide_list = 0 ";
$query_rsRankings .= "ORDER BY r_group ASC, points DESC, last_name_eng ASC, first_name_eng ASC";
$rsRankings = mysql_query($query_rsRankings, $connTennis) or die(mysql_error());
$row_rsRankings = mysql_fetch_assoc($rsRankings);
$totalRows_rsRankings = mysql_num_rows($rsRankings);

$page_title = "Tucson Korean Tennis Association Rankings"; 
$file_name = "rankings.php";
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
       <h3>Tucson Korean Tennis Association Rankings</h3> 
       <ul>
       <li>The rankings are decided by the order of groups, points and names.</li>  
       <li>If the points are the same within the same group, the rankings are by the order of last name and first name in English spelling.</li>
       <li>If you want, you can have your nickname instead of real name displayed or choose not to be displayed in the list.</ul>
       <table width="98%" border="1" cellspacing="0" cellpadding="3">
  <tr align="center" bgcolor="#CCCCCC">
    <td width="9%">Ranking</td>
    <td width="23%">Name</td>
    <td width="7%">Points</td>
    <td width="7%">Wins</td>
    <td width="8%">Losses</td>
    <td width="20%">Winning Percentage</td>
    <td width="19%">Total Percentage</td>
    <td width="7%">Group</td>
  </tr>
  <?php $current_ranking = 0; ?>
  <?php do { $current_ranking++ ?>
  <?php
	// Records for the current group.
	$total_current_matches = $row_rsRankings['current_wins'] + $row_rsRankings['current_losses'];
	if ($total_current_matches == 0) {
	$winning_percentage = 0;
	} else { 
	$winning_percentage = round($row_rsRankings['current_wins']/$total_current_matches * 100);
	}

	// Records for the current group + previous group(s).
	$total_total_matches = $row_rsRankings['total_wins'] + $row_rsRankings['total_losses'];
	if ($total_total_matches == 0) {
	$total_winning_percentage = 0;
	} else { 
	$total_winning_percentage = round($row_rsRankings['total_wins']/$total_total_matches * 100);
	}
  ?>
  <tr align="center" <?php if (($current_ranking % 2) == 1) { ?>bgcolor="#FAFDB3"<?php } ?>>
    <td><?php echo $current_ranking; ?></td>
    <td align="left">
	<?php if ($total_total_matches > 0) { ?>
    <a href="member_details.php?id=<?php echo $row_rsRankings['Id']; ?>"><?php echo $row_rsRankings['first_name_eng'] . " " . $row_rsRankings['last_name_eng']; ?></a><?php } else { echo $row_rsRankings['first_name_eng'] . " " . $row_rsRankings['last_name_eng']; } ?>
    </td>
    <td><?php echo $row_rsRankings['points']; ?></td>
    <td><?php echo $row_rsRankings['current_wins']; ?></td>
    <td><?php echo $row_rsRankings['current_losses']; ?></td>
    <td><?php if ($winning_percentage == 0) { ?>&nbsp;<?php } else { echo $winning_percentage; ?>% <?php } ?></td>
    <td>
	<?php if (($total_winning_percentage > 0) && ($row_rsRankings['total_wins'] <> $row_rsRankings['current_wins'])) { echo $total_winning_percentage . "% (" . $row_rsRankings['total_wins'] . "/" . $total_total_matches; ?>) <?php } else { ?>&nbsp;<?php } ?>
    </td>
    <td><?php echo $row_rsRankings['r_group']; ?></td>
  </tr>
  <?php } while ($row_rsRankings = mysql_fetch_assoc($rsRankings)); ?>
</table>
	<span class="contenttitle_red">About Winning Percentage and Total Percentage</span> <br />
    When a member moves from one group to another, the records for Wins, Losses and Winning Percentage are reset <br />as 0.  Total Percentage reflects the records for the curent group and the previous group(s) combined.  Total Percentage records will be displayed when it happens.      </div>
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
mysql_free_result($rsRankings);
?>