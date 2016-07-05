<?php
$page_title = "투산 한인 테니스 협회"; 
$file_name = "index.php";
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "../admin/ewcfg7.php" ?>
<?php include "../admin/ewmysql7.php" ?>
<?php include "../admin/phpfn7.php" ?>
<?php include "../admin/userfn7.php" ?>
<?php include "../cannouncement_class.php" ?>
<?php include "announcementinfo.php" ?>
<?php
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php
// Create page object
$announcement_list = new cannouncement_list();
$Page =& $announcement_list;

// Page init
$announcement_list->Page_Init();

// Page main
$announcement_list->Page_Main();
?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$announcement_list->lTotalRecs = $announcement->SelectRecordCount();
	} else {
		if ($rs = $announcement_list->LoadRecordset())
			$announcement_list->lTotalRecs = $rs->RecordCount();
	}
	$announcement_list->lStartRec = 1;
	if ($announcement_list->lDisplayRecs <= 0 || ($announcement->Export <> "" && $announcement->ExportAll)) // Display all records
		$announcement_list->lDisplayRecs = $announcement_list->lTotalRecs;
	if (!($announcement->Export <> "" && $announcement->ExportAll))
		$announcement_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $announcement_list->LoadRecordset($announcement_list->lStartRec-1, $announcement_list->lDisplayRecs);
?>
<!DOCTYPE html
  PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN" "http://www.w3.org/TR/html40/strict.dtd">
<html>
<head>
<meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
<?php include('header.php'); ?>
<link rel="stylesheet" type="text/css" media="screen" href="../styles/lightbox.css"  />
<script type="text/javascript" src="../scripts/scriptaculous/lib/prototype.js"></script>
<script type="text/javascript" src="../scripts/scriptaculous/src/scriptaculous.js?load=effects"></script>
<script type="text/javascript" src="../scripts/lightbox.js"></script>
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
       <h3>투산 한인 테니스 협회</h3>
       <p>
       <div class="subtitle_black">Announcements</div>
<?php
if ($announcement->ExportAll && $announcement->Export <> "") {
	$announcement_list->lStopRec = $announcement_list->lTotalRecs;
} else {
	$announcement_list->lStopRec = $announcement_list->lStartRec + $announcement_list->lDisplayRecs - 1; // Set the last record to display
}
$announcement_list->lRecCount = $announcement_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $announcement_list->lStartRec > 1)
		$rs->Move($announcement_list->lStartRec - 1);
}

// Initialize aggregate
$announcement->RowType = EW_ROWTYPE_AGGREGATEINIT;
$announcement_list->RenderRow();
$announcement_list->lRowCnt = 0;
while (($announcement->CurrentAction == "gridadd" || !$rs->EOF) &&
	$announcement_list->lRecCount < $announcement_list->lStopRec) {
	$announcement_list->lRecCount++;
	if (intval($announcement_list->lRecCount) >= intval($announcement_list->lStartRec)) {
		$announcement_list->lRowCnt++;

	// Init row class and style
	$announcement->CssClass = "";
	$announcement->CssStyle = "";
	$announcement->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($announcement->CurrentAction == "gridadd") {
		$announcement_list->LoadDefaultValues(); // Load default values
	} else {
		$announcement_list->LoadRowValues($rs); // Load row values
	}
	$announcement->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$announcement_list->RenderRow();

	// Render list options
	$announcement_list->RenderListOptions();
?>

<!-- Announcement records diplay here. -->
<?php if ($announcement_list->lTotalRecs > 0) { ?>
	<ul>
       	<li>
        <span class="contenttitle_green"><?php echo $announcement->title->ListViewValue() ?></span> (posted on <span class="text_red"><?php echo date('n/j/Y, h:i A', strtotime($_SESSION['announcement_post_time'])); ?></span>)<br />
		<?php echo $announcement->announcement_1->ListViewValue(); ?>
        </li>
    </ul>	
<?php
	}
	if ($announcement->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
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
// Close recordset
if ($rs)
	$rs->Close();
?>
<?php
$announcement_list->Page_Terminate();
?>
