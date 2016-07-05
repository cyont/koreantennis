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
 
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html40/strict.dtd">
<html>
<head>
<?php include('header.php'); ?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr"></head>
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
		   <span class="view_korean"><?php echo $row_rsAnnouncement['announcement']; ?></span></li>
       	   <?php } while ($row_rsAnnouncement = mysql_fetch_assoc($rsAnnouncement)); ?></ul>
         <?php } else { ?>
         Currently there is no active announcement.
         <?php } ?>
       </p>

       <p>
       <div class="contentsubtitle_orange">Tennis Tournament Coming!!</div>
       제 2회 한인 회장배 테니스 대회가 4월 24일로 예정되어 있습니다.  <br /><br />
       <div align="center"><img src="../images/280E1901.jpg" width="500" height="205" alt="2009 Korean Tennis Tournament" title="2009 Korean Tennis Tournament">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;<br />
       2009 Korean Tennis Tournament&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;</div>
	   <p>
       
       <div id="givepadding_more">
       <span class="contenttitle_blue">시간:</span> Apr. 24 (Sat).  11:00 AM <br />
       <span class="contenttitle_blue">장소:</span> Fort Lowell Park Tennis Center<br />
       <div id="leftmargin_40"><a href="timelocation.php" target="_blank">2900 North Craycroft Rd, Tucson, AZ 85712</a> (NE corner of Craycroft & Glenn)</div>
       <span class="contenttitle_blue">상금:</span> 상금은 Korea House에서 저녁 식사 후에 수여됩니다..
       <div id="leftmargin_40">
       <table width="400px" border="1" cellspacing="0" cellpadding="3">
          <tr align="center">
            <td rowspan="4" class="contenttitle_black">단식</td>
            <td class="contenttitle_black">조</td>
            <td class="contenttitle_black">우승</td>
            <td class="contenttitle_black">준우승</td>
          </tr>
          <tr align="center">
            <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;A (Advanced)</td>
            <td>$80</td>
            <td>$40</td>
          </tr>
          <tr align="center">
            <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;B (Intermediate)</td>
            <td>$60</td>
            <td>$30</td>
          </tr>
          <tr align="center">
            <td align="left">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;C (Beginner)</td>
            <td>$40</td>
            <td>$20</td>
          </tr>
          <tr align="center">
            <td class="contenttitle_black">복식</td>
            <td>&nbsp;</td>
            <td>$100</td>
            <td>$60</td>
          </tr>
        </table>
		</div>
       <span class="contenttitle_blue">참가비:</span>  
       <div id="leftmargin_40">
       <span class="contenttitle_black">단식:</span> 학생 ($15), 일반 ($20)<br />
       <span class="contenttitle_black">복식:</span> 각각 $15씩<br />
       <span class="contenttitle_black">단식 and 복식:</span> $25<br />
       </div>
       <span class="contenttitle_blue">참가 자격:</span> <br />
       <div id="leftmargin_40">Tucson Korean Tennis Assoication 회원 (외국인 포함) 및 <br />아리조나에 거주하는 모든 한인</div>
       <span class="contenttitle_blue">저녁 식사:</span> 시합이 끝난 뒤 Korea House에서 무료 저녁 식사가 제공되겠습니다.<br />
       <div id="leftmargin_40"><a href="http://maps.google.com/maps?rls=com.microsoft:en-us:IE-SearchBox&oe=UTF-8&rlz=1I7GGLL_en&um=1&ie=UTF-8&q=korean+house+in+tucson&fb=1&gl=us&hq=korean+house&hnear=tucson&cid=0,0,6072910033209302188&ei=XTrCS8GxHc38nAeq_Zn-CQ&sa=X&oi=local_result&ct=image&resnum=1&ved=0CAoQnwIwAA" target="_blank">4030 East Speedway Blvd., Tucson, AZ 85712</a> (on Speedway between Alvernon and Columbus)</div>
       <span class="contenttitle_blue">등록:</span> 시합 당일의 원활한 경기 운영을 위해 미리 등록해 주시면 감사하겠습니다.
       <div id="leftmargin_40">
       <span class="contenttitle_black">전화:</span> 520-750-9009<br />
       <span class="contenttitle_black">이메일:</span> <a href="mailto:contact@koreantennis.org">contact@koreantennis.org</a><br />참가자 성명, 전화 번호, 주소, 이메일 주소, 그리고 참가하고자 하는 조를 이메일로 보내 주세요. 참가비는 시합 당일 납부해 주시면 되겠습니다.  미리 등록하시더리도 사정이 여의치 않아 시합에 참여하지 못하실 경우는 등록이 자동으로 취소되니까, 지금 바로 등록해 주세요.
       </div>
       </div>
       </p>
       </p>

       <p>
       <div class="subtitle_black">Welcome</div>
        투산 한인 테니스 협회는 투산 지역의 테니스를 즐기는 사람들로 모인 공동체입니다. 다양한 직종의 직장인과 자영업자, 학생, 남자와 여자, 그리고 초중고급 여러 레벨의 테니스 기술을 지닌 사람들이 모여 매주 같이 테니스를 치며 친목을 도모하고 있습니다. 대부분의 회원은 한인이지만 꼭 한국 사람으로 국한된 것은 아니고, 누구든지 와서 같이 동참하시면 언제든지 환영입니다. 
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