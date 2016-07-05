<?php require_once('../Connections/connTennis.php'); ?>
<?php
$page_title = "투산의 테니스 코트"; 
$file_name = "courts.php";

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
       <h3>투산의 테니스 코트</h3>
       아래 리스트에서 잘못된 정보를 발견하시든지, 아니면 그 밖에 여러분이 알고 계신 코트가 있으면, Forum의 게시판에 글을 쓰거나 <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a>로 이메일을 보내 주세요.
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
        <td width="111"><div align="center">코트 숫자</div></td>
    	<td width="131"><div align="center">비용</div></td>
        <td width="134"><div align="center">야간 조명</div></td>
        <td width="98"><div align="center">코트 유지 상태</div></td>
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