<?php
$page_title = "Home - Tucson Korean Tennis Association"; 
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
       <h3>Tucson Korean Tennis Association</h3>
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
       <span class="contenttitle_orange">Free tennis lessons will be held for one hour every Friday.</span>  <br />
       All Tucson Korean Tennis Association members and any new visitors, young and old, men and women are welcome to participate.  New participants will be automatically registered as members.  The lessons are free and the membership fee is $10 per month.  <br />
       <br />
       
       <div id="givepadding_more">
       <span class="contenttitle_blue">Time:</span> Every Friday  8:00 - 9:00 PM <br />
       <span class="contenttitle_blue">Location:</span> Fort Lowell Park Tennis Center<br />
       		<div id="leftmargin_40"><a href="timelocation.php" target="_blank">2900 North Craycroft Rd, Tucson, AZ 85712</a> (NE corner of Craycroft & Glenn)</div>
       
		</div>
       </p>
       -->

       <p>
       <div class="subtitle_black">Welcome!</div>
       Tucson Korean Tennis Association is an open community which welcomes anyone that loves playing tennis.  The association consists of people with vaious occupations, students, young and old, men and women, and players with all different levels of tennis skills.  Most of the members are Koreans, but it's not exclusive to non-Koreans.  Anybody can join and play.  So just come and you will have somebody to play with.
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
