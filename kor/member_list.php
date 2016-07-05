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
mysql_query('set names euckr');
 
$page_title = "조별 회원 목록"; 
$file_name = "member_list.php";
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
       <h3>조별 회원 목록</h3>
       <span class="contenttitle_red">알림</span><br />
       회원께서 원하시면
       <ul>
       <li>실명 대신 가명이나 별명으로 대신할 수도 있습니다</li>
       <li>회원 자격을 유지한 채 목록에서 이름을 삭제할 수도 있습니다</li>
       <li>회원 자격을 취소할 수도 있습니다</li>
       <li>조를 바꾸거나, active/inactive 여부를 바꿀 수도 있습니다</li>
       </ul>
       <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>로 이메일 보내 주세요. 
	   <?php do { ?>
	     <p>
	     <div id="leftmargin_40" class="contentsubtitle_orange"><?php echo $row_rsMemberGroups['r_group']; ?> 조</div>	           
         <?php
		// $query_rsMemberList = "SET NAMES 'utf8'"; 
		$query_rsMemberList = "SELECT M.first_name, M.last_name FROM members M INNER JOIN groups G ON M.Id = G.Id ";
		$query_rsMemberList .= "WHERE active_member = 1 AND inactive = 0 AND hide_list = 0 AND r_group = '" . $row_rsMemberGroups['r_group'] . "' ";
		$query_rsMemberList .= "ORDER BY ethnicity_korean DESC, M.last_name ASC, M.first_name ASC";
		
		$rsMemberList = mysql_query($query_rsMemberList, $connTennis) or die(mysql_error());
		$row_rsMemberList = mysql_fetch_assoc($rsMemberList);
		// $row_rsMemberList = "SET NAMES 'utf8'";

		
		//$change = "SET NAMES 'utf8'"; 
//		mysql_query($change) or die("The change did not work: $change"); 

		?>
		<?php 
		do {
		?>
		<div id="leftmargin_40" class="text_black"><?php echo $row_rsMemberList['last_name']; ?>, <?php echo $row_rsMemberList['first_name']; ?></div>
        
        <?php
		} while ($row_rsMemberList = mysql_fetch_assoc($rsMemberList));
		?>
         </p>
	     <?php } while ($row_rsMemberGroups = mysql_fetch_assoc($rsMemberGroups)); ?>
         <p>
         <div id="leftmargin_40" class="contentsubtitle_orange">Inactive members</div>
         <?php
		$query_rsMemberInactive = "SELECT M.first_name, M.last_name, r_group FROM members M INNER JOIN groups G ON M.Id = G.Id ";
		$query_rsMemberInactive .= "WHERE active_member = 1 AND inactive = 1 AND hide_list = 0 ";
		$query_rsMemberInactive .= "ORDER BY ethnicity_korean DESC, M.last_name ASC, M.first_name ASC";
		$rsMemberInactive = mysql_query($query_rsMemberInactive, $connTennis) or die(mysql_error());
		$row_rsMemberInactive = mysql_fetch_assoc($rsMemberInactive);
		?>
		<?php 
		do {
		?>
		<div id="leftmargin_40" class="text_black"><?php echo $row_rsMemberInactive['last_name']; ?>, <?php echo $row_rsMemberInactive['first_name']; ?> (<?php echo $row_rsMemberInactive['r_group']; ?>)</div>
        
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