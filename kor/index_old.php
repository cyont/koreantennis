<?php require_once('../Connections/connTennis.php'); ?>
<?php
$page_title = "���� ���� �״Ͻ� ��ȸ";
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
mysql_select_db($database_connTennis, $connTennis);
$query_rsAnnouncement = "SELECT * FROM announcement WHERE lid = 44 and koreantennis = 1 AND active = 1 ORDER BY `timestamp` DESC";
$rsAnnouncement = mysql_query($query_rsAnnouncement, $connTennis) or die(mysql_error());
$row_rsAnnouncement = mysql_fetch_assoc($rsAnnouncement);
$totalRows_rsAnnouncement = mysql_num_rows($rsAnnouncement);
mysql_query('set names euckr'); 
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html40/strict.dtd">
<html>
<head>
<?php include('header.php'); ?>
</head>
<link rel="stylesheet" type="text/css" media="screen" href="../styles/lightbox.css"  />
<script type="text/javascript" src="../scripts/scriptaculous/lib/prototype.js"></script>
<script type="text/javascript" src="../scripts/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="../scripts/lightbox.js"></script>
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
       <h3>���� ���� �״Ͻ� ��ȸ</h3>
       <p>
       <div class="subtitle_black">���� ����</div>
       <?php if ($row_rsAnnouncement['id'] > 0) { ?>
       <ul>
       	 <?php do { ?>
       	   <li><span class="contenttitle_green"><?php echo $row_rsAnnouncement['title']; ?></span> (posted on <span class="text_red"><?php echo date('n/j/Y, h:i A', strtotime($row_rsAnnouncement['timestamp'])); ?></span>)<br />
		   <span class=""><?php echo $row_rsAnnouncement['announcement']; ?></span></li>
       	   <?php } while ($row_rsAnnouncement = mysql_fetch_assoc($rsAnnouncement)); ?></ul>
         <?php } else { ?>
         Currently there is no active announcement.
         <?php } ?>
       </p>

	<!--Tennis Lesson Section
       <p>
       <div class="subtitle_black">Tennis Lessons</div>
       <span class="contenttitle_orange">���� �ݿ��� �ѽð��� ���� �״Ͻ� ������ ����˴ϴ�.</span>  <br />������ �״Ͻ� ��ȸ ȸ�� �� ������ �ҹ� ��� �湮�ڲ��� �����Ͻ� �� ������, �ű� �����ڴ� �ڵ����� �״Ͻ� ��ȸ ȸ������ ��ϵ˴ϴ�.  ������� ���� �����̸�, �״Ͻ� ��ȸ ȸ��� �Ŵ� $10�� ���� �ֽø� �˴ϴ�.  ���� ���� ��Ź �帮��, ���� �ƴ� �е��� ���� ���� �� �ֽø� �����ϰڽ��ϴ�.<br />
       <br />
       
       <div id="givepadding_more">
       <span class="contenttitle_blue">�ð�:</span> ���� �ݿ��� 8:00 - 9:00 PM <br />
       <span class="contenttitle_blue">���:</span> Fort Lowell Park Tennis Center<br />
       <div id="leftmargin_40"><a href="timelocation.php" target="_blank">2900 North Craycroft Rd, Tucson, AZ 85712</a> (NE corner of Craycroft & Glenn)</div>       
		</div>
       </p>
	--->
    
       <p>
       <div class="subtitle_black">Welcome</div>
        ���� ���� �״Ͻ� ��ȸ�� ���� ������ �״Ͻ��� ���� ������ ���� ����ü�Դϴ�. �پ��� ������ �����ΰ� �ڿ�����, �л�, ���ڿ� ����, �׸��� ���߰�� ���� ������ �״Ͻ� ����� ���� ������� �� ���� ���� �״Ͻ��� ġ�� ģ���� �����ϰ� �ֽ��ϴ�. ��κ��� ȸ���� ���������� �� �ѱ� ������� ���ѵ� ���� �ƴϰ�, �������� �ͼ� ���� �����Ͻø� �������� ȯ���Դϴ�. 
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
mysql_free_result($rsAnnouncement);
?>