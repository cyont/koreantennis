<?php require_once('../Connections/connTennis.php'); ?>
<?php
$page_title = "투산 한인 테니스 협회";
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
       <h3>투산 한인 테니스 협회</h3>
       <p>
       <div class="subtitle_black">공지 사항</div>
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
       <span class="contenttitle_orange">매주 금요일 한시간씩 무료 테니스 레슨이 진행됩니다.</span>  <br />기존의 테니스 협회 회원 및 남녀노소 불문 모든 방문자께서 참여하실 수 있으며, 신규 참가자는 자동으로 테니스 협회 회원으로 등록됩니다.  레슨비는 없이 무료이며, 테니스 협회 회비로 매달 $10만 내어 주시면 됩니다.  많은 참가 부탁 드리고, 주위 아는 분들을 통해 광고도 해 주시면 감사하겠습니다.<br />
       <br />
       
       <div id="givepadding_more">
       <span class="contenttitle_blue">시간:</span> 매주 금요일 8:00 - 9:00 PM <br />
       <span class="contenttitle_blue">장소:</span> Fort Lowell Park Tennis Center<br />
       <div id="leftmargin_40"><a href="timelocation.php" target="_blank">2900 North Craycroft Rd, Tucson, AZ 85712</a> (NE corner of Craycroft & Glenn)</div>       
		</div>
       </p>
	--->
    
       <p>
       <div class="subtitle_black">Welcome</div>
        투산 한인 테니스 협회는 투산 지역의 테니스를 즐기는 사람들로 모인 공동체입니다. 다양한 직종의 직장인과 자영업자, 학생, 남자와 여자, 그리고 초중고급 여러 레벨의 테니스 기술을 지닌 사람들이 모여 매주 같이 테니스를 치며 친목을 도모하고 있습니다. 대부분의 회원은 한인이지만 꼭 한국 사람으로 국한된 것은 아니고, 누구든지 와서 같이 동참하시면 언제든지 환영입니다. 
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