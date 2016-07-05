<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "groupsinfo.php" ?>
<?php include "membersinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<meta http-equiv="Content-Type" content="text/html; charset=euc-kr">
<?php
// Create page object
$groups_list = new cgroups_list();
$Page =& $groups_list;

// Page init
$groups_list->Page_Init();

// Page main
$groups_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($groups->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var groups_list = new ew_Page("groups_list");

// page properties
groups_list.PageID = "list"; // page ID
groups_list.FormID = "fgroupslist"; // form ID
var EW_PAGE_ID = groups_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
groups_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
groups_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
groups_list.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script language="JavaScript" type="text/javascript">
<!--

// Write your client script here, no need to add script tags.
// To include another .js script, use:
// ew_ClientScriptInclude("my_javascript.js"); 
//-->

</script>
<?php } ?>
<?php if ($groups->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$groups_list->lTotalRecs = $groups->SelectRecordCount();
	} else {
		if ($rs = $groups_list->LoadRecordset())
			$groups_list->lTotalRecs = $rs->RecordCount();
	}
	$groups_list->lStartRec = 1;
	if ($groups_list->lDisplayRecs <= 0 || ($groups->Export <> "" && $groups->ExportAll)) // Display all records
		$groups_list->lDisplayRecs = $groups_list->lTotalRecs;
	if (!($groups->Export <> "" && $groups->ExportAll))
		$groups_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $groups_list->LoadRecordset($groups_list->lStartRec-1, $groups_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $groups->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($groups->Export == "" && $groups->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(groups_list);" style="text-decoration: none;"><img id="groups_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="groups_list_SearchPanel">
<form name="fgroupslistsrch" id="fgroupslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="groups">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($groups->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $groups_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($groups->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($groups->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($groups->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$groups_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fgroupslist" id="fgroupslist" class="ewForm" action="" method="post">
<div id="gmp_groups" class="ewGridMiddlePanel">
<?php if ($groups_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $groups->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$groups_list->RenderListOptions();

// Render list options (header, left)
$groups_list->ListOptions->Render("header", "left");
?>
<?php if ($groups->Id->Visible) { // Id ?>
	<?php if ($groups->SortUrl($groups->Id) == "") { ?>
		<td><?php echo $groups->Id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $groups->SortUrl($groups->Id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $groups->Id->FldCaption() ?></td><td style="width: 10px;"><?php if ($groups->Id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($groups->Id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<td>Name</td>
<!--
Hiding Nickname
<?php if ($groups->nickname_kor->Visible) { // nickname_kor ?>
	<?php if ($groups->SortUrl($groups->nickname_kor) == "") { ?>
		<td><?php echo $groups->nickname_kor->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $groups->SortUrl($groups->nickname_kor) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $groups->nickname_kor->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($groups->nickname_kor->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($groups->nickname_kor->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($groups->nickname_eng->Visible) { // nickname_eng ?>
	<?php if ($groups->SortUrl($groups->nickname_eng) == "") { ?>
		<td><?php echo $groups->nickname_eng->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $groups->SortUrl($groups->nickname_eng) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $groups->nickname_eng->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($groups->nickname_eng->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($groups->nickname_eng->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
-->

<?php if ($groups->inactive->Visible) { // inactive ?>
	<?php if ($groups->SortUrl($groups->inactive) == "") { ?>
		<td><?php echo $groups->inactive->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $groups->SortUrl($groups->inactive) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $groups->inactive->FldCaption() ?></td><td style="width: 10px;"><?php if ($groups->inactive->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($groups->inactive->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($groups->r_group->Visible) { // r_group ?>
	<?php if ($groups->SortUrl($groups->r_group) == "") { ?>
		<td><?php echo $groups->r_group->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $groups->SortUrl($groups->r_group) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $groups->r_group->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($groups->r_group->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($groups->r_group->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($groups->points->Visible) { // points ?>
	<?php if ($groups->SortUrl($groups->points) == "") { ?>
		<td><?php echo $groups->points->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $groups->SortUrl($groups->points) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $groups->points->FldCaption() ?></td><td style="width: 10px;"><?php if ($groups->points->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($groups->points->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($groups->hide_list->Visible) { // hide_list ?>
	<?php if ($groups->SortUrl($groups->hide_list) == "") { ?>
		<td><?php echo $groups->hide_list->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $groups->SortUrl($groups->hide_list) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $groups->hide_list->FldCaption() ?></td><td style="width: 10px;"><?php if ($groups->hide_list->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($groups->hide_list->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($groups->total_wins->Visible) { // total_wins ?>
	<?php if ($groups->SortUrl($groups->total_wins) == "") { ?>
		<td><?php echo $groups->total_wins->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $groups->SortUrl($groups->total_wins) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $groups->total_wins->FldCaption() ?></td><td style="width: 10px;"><?php if ($groups->total_wins->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($groups->total_wins->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($groups->total_losses->Visible) { // total_losses ?>
	<?php if ($groups->SortUrl($groups->total_losses) == "") { ?>
		<td><?php echo $groups->total_losses->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $groups->SortUrl($groups->total_losses) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $groups->total_losses->FldCaption() ?></td><td style="width: 10px;"><?php if ($groups->total_losses->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($groups->total_losses->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($groups->current_wins->Visible) { // current_wins ?>
	<?php if ($groups->SortUrl($groups->current_wins) == "") { ?>
		<td><?php echo $groups->current_wins->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $groups->SortUrl($groups->current_wins) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $groups->current_wins->FldCaption() ?></td><td style="width: 10px;"><?php if ($groups->current_wins->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($groups->current_wins->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($groups->current_losses->Visible) { // current_losses ?>
	<?php if ($groups->SortUrl($groups->current_losses) == "") { ?>
		<td><?php echo $groups->current_losses->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $groups->SortUrl($groups->current_losses) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $groups->current_losses->FldCaption() ?></td><td style="width: 10px;"><?php if ($groups->current_losses->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($groups->current_losses->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$groups_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($groups->ExportAll && $groups->Export <> "") {
	$groups_list->lStopRec = $groups_list->lTotalRecs;
} else {
	$groups_list->lStopRec = $groups_list->lStartRec + $groups_list->lDisplayRecs - 1; // Set the last record to display
}
$groups_list->lRecCount = $groups_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $groups_list->lStartRec > 1)
		$rs->Move($groups_list->lStartRec - 1);
}

// Initialize aggregate
$groups->RowType = EW_ROWTYPE_AGGREGATEINIT;
$groups_list->RenderRow();
$groups_list->lRowCnt = 0;
while (($groups->CurrentAction == "gridadd" || !$rs->EOF) &&
	$groups_list->lRecCount < $groups_list->lStopRec) {
	$groups_list->lRecCount++;
	if (intval($groups_list->lRecCount) >= intval($groups_list->lStartRec)) {
		$groups_list->lRowCnt++;

	// Init row class and style
	$groups->CssClass = "";
	$groups->CssStyle = "";
	$groups->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($groups->CurrentAction == "gridadd") {
		$groups_list->LoadDefaultValues(); // Load default values
	} else {
		$groups_list->LoadRowValues($rs); // Load row values
	}
	$groups->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$groups_list->RenderRow();

	// Render list options
	$groups_list->RenderListOptions();
?>
	<tr<?php echo $groups->RowAttributes() ?>>
<?php

// Render list options (body, left)
$groups_list->ListOptions->Render("body", "left");
?>
	<?php if ($groups->Id->Visible) { // Id ?>
		<td<?php echo $groups->Id->CellAttributes() ?>>
<div<?php echo $groups->Id->ViewAttributes() ?>><?php echo $groups->Id->ListViewValue() ?></div>
</td>
	<?php } ?>

<td>
<?php 
require_once('../Connections/connTennis.php'); 
mysql_select_db($database_connTennis, $connTennis);
$query_rsMemberNames = "SELECT first_name, last_name, first_name_eng, last_name_eng FROM members M INNER JOIN groups G ON M.Id = G.Id ";
$query_rsMemberNames .= "WHERE M.Id = " . $groups->Id->ListViewValue() . "";
$rsMemberNames = mysql_query($query_rsMemberNames, $connTennis) or die(mysql_error());
$row_rsMemberNames = mysql_fetch_assoc($rsMemberNames);
mysql_query('set names euckr');
echo $row_rsMemberNames['first_name'] . " " . $row_rsMemberNames['last_name'] . " " ;
?>

</td>
<!--
Hiding Nickname
	<?php if ($groups->nickname_kor->Visible) { // nickname_kor ?>
		<td<?php echo $groups->nickname_kor->CellAttributes() ?>>
<div<?php echo $groups->nickname_kor->ViewAttributes() ?>><?php echo $groups->nickname_kor->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($groups->nickname_eng->Visible) { // nickname_eng ?>
		<td<?php echo $groups->nickname_eng->CellAttributes() ?>>
<div<?php echo $groups->nickname_eng->ViewAttributes() ?>><?php echo $groups->nickname_eng->ListViewValue() ?></div>
</td>
	<?php } ?>
-->

	<?php if ($groups->inactive->Visible) { // inactive ?>
		<td<?php echo $groups->inactive->CellAttributes() ?>>
<div<?php echo $groups->inactive->ViewAttributes() ?>><?php echo $groups->inactive->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($groups->r_group->Visible) { // r_group ?>
		<td<?php echo $groups->r_group->CellAttributes() ?>>
<div<?php echo $groups->r_group->ViewAttributes() ?>><?php echo $groups->r_group->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($groups->points->Visible) { // points ?>
		<td<?php echo $groups->points->CellAttributes() ?>>
<div<?php echo $groups->points->ViewAttributes() ?>><?php echo $groups->points->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($groups->hide_list->Visible) { // hide_list ?>
		<td<?php echo $groups->hide_list->CellAttributes() ?>>
<div<?php echo $groups->hide_list->ViewAttributes() ?>><?php echo $groups->hide_list->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($groups->total_wins->Visible) { // total_wins ?>
		<td<?php echo $groups->total_wins->CellAttributes() ?>>
<div<?php echo $groups->total_wins->ViewAttributes() ?>><?php echo $groups->total_wins->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($groups->total_losses->Visible) { // total_losses ?>
		<td<?php echo $groups->total_losses->CellAttributes() ?>>
<div<?php echo $groups->total_losses->ViewAttributes() ?>><?php echo $groups->total_losses->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($groups->current_wins->Visible) { // current_wins ?>
		<td<?php echo $groups->current_wins->CellAttributes() ?>>
<div<?php echo $groups->current_wins->ViewAttributes() ?>><?php echo $groups->current_wins->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($groups->current_losses->Visible) { // current_losses ?>
		<td<?php echo $groups->current_losses->CellAttributes() ?>>
<div<?php echo $groups->current_losses->ViewAttributes() ?>><?php echo $groups->current_losses->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$groups_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($groups->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($groups->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($groups->CurrentAction <> "gridadd" && $groups->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($groups_list->Pager)) $groups_list->Pager = new cPrevNextPager($groups_list->lStartRec, $groups_list->lDisplayRecs, $groups_list->lTotalRecs) ?>
<?php if ($groups_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($groups_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $groups_list->PageUrl() ?>start=<?php echo $groups_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($groups_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $groups_list->PageUrl() ?>start=<?php echo $groups_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $groups_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($groups_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $groups_list->PageUrl() ?>start=<?php echo $groups_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($groups_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $groups_list->PageUrl() ?>start=<?php echo $groups_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $groups_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $groups_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $groups_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $groups_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($groups_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($groups_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $groups_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($groups->Export == "" && $groups->CurrentAction == "") { ?>
<?php } ?>
<?php if ($groups->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$groups_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cgroups_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'groups';

	// Page object name
	var $PageObjName = 'groups_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $groups;
		if ($groups->UseTokenInUrl) $PageUrl .= "t=" . $groups->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		if (@$_SESSION[EW_SESSION_MESSAGE] <> "") { // Append
			$_SESSION[EW_SESSION_MESSAGE] .= "<br>" . $v;
		} else {
			$_SESSION[EW_SESSION_MESSAGE] = $v;
		}
	}

	// Show message
	function ShowMessage() {
		$sMessage = $this->getMessage();
		$this->Message_Showing($sMessage);
		if ($sMessage <> "") { // Message in Session, display
			echo "<p><span class=\"ewMessage\">" . $sMessage . "</span></p>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm, $groups;
		if ($groups->UseTokenInUrl) {
			if ($objForm)
				return ($groups->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($groups->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgroups_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (groups)
		$GLOBALS["groups"] = new cgroups();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["groups"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "groupsdelete.php";
		$this->MultiUpdateUrl = "groupsupdate.php";

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'groups', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
	}

	// 
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;
		global $groups;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$groups->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$groups->Export = $_POST["exporttype"];
		} else {
			$groups->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $groups->Export; // Get export parameter, used in header
		$gsExportFile = $groups->TableVar; // Get export file, used in header

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $conn;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		 // Close connection
		$conn->Close();

		// Go to URL if specified
		$this->Page_Redirecting($url);
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			header("Location: " . $url);
		}
		exit();
	}

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 20;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $groups;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$groups->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($groups->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $groups->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 200; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$groups->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$groups->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$groups->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $groups->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$groups->setSessionWhere($sFilter);
		$groups->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $groups;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $groups->nickname_kor, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $groups->nickname_eng, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $groups->r_group, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . " LIKE " . ew_QuotedValue("%" . $Keyword . "%", $lFldDataType);
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $groups;
		$sSearchStr = "";
		$sSearchKeyword = $groups->BasicSearchKeyword;
		$sSearchType = $groups->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$groups->setSessionBasicSearchKeyword($sSearchKeyword);
			$groups->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $groups;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$groups->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $groups;
		$groups->setSessionBasicSearchKeyword("");
		$groups->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $groups;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$groups->BasicSearchKeyword = $groups->getSessionBasicSearchKeyword();
			$groups->BasicSearchType = $groups->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $groups;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$groups->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$groups->CurrentOrderType = @$_GET["ordertype"];
			$groups->UpdateSort($groups->Id); // Id
			$groups->UpdateSort($groups->nickname_kor); // nickname_kor
			$groups->UpdateSort($groups->nickname_eng); // nickname_eng
			$groups->UpdateSort($groups->inactive); // inactive
			$groups->UpdateSort($groups->r_group); // r_group
			$groups->UpdateSort($groups->points); // points
			$groups->UpdateSort($groups->hide_list); // hide_list
			$groups->UpdateSort($groups->total_wins); // total_wins
			$groups->UpdateSort($groups->total_losses); // total_losses
			$groups->UpdateSort($groups->current_wins); // current_wins
			$groups->UpdateSort($groups->current_losses); // current_losses
			$groups->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $groups;
		$sOrderBy = $groups->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($groups->SqlOrderBy() <> "") {
				$sOrderBy = $groups->SqlOrderBy();
				$groups->setSessionOrderBy($sOrderBy);
				$groups->Id->setSort("ASC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $groups;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$groups->setSessionOrderBy($sOrderBy);
				$groups->Id->setSort("");
				$groups->nickname_kor->setSort("");
				$groups->nickname_eng->setSort("");
				$groups->inactive->setSort("");
				$groups->r_group->setSort("");
				$groups->points->setSort("");
				$groups->hide_list->setSort("");
				$groups->total_wins->setSort("");
				$groups->total_losses->setSort("");
				$groups->current_wins->setSort("");
				$groups->current_losses->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$groups->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $groups;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "copy"
		$this->ListOptions->Add("copy");
		$item =& $this->ListOptions->Items["copy"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($groups->Export <> "" ||
			$groups->CurrentAction == "gridadd" ||
			$groups->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $groups;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $groups;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $groups;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$groups->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$groups->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $groups->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$groups->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$groups->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$groups->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $groups;
		$groups->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$groups->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $groups;

		// Call Recordset Selecting event
		$groups->Recordset_Selecting($groups->CurrentFilter);

		// Load List page SQL
		$sSql = $groups->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$groups->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $groups;
		$sFilter = $groups->KeyFilter();

		// Call Row Selecting event
		$groups->Row_Selecting($sFilter);

		// Load SQL based on filter
		$groups->CurrentFilter = $sFilter;
		$sSql = $groups->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$groups->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $groups;
		$groups->Id->setDbValue($rs->fields('Id'));
		$groups->nickname_kor->setDbValue($rs->fields('nickname_kor'));
		$groups->nickname_eng->setDbValue($rs->fields('nickname_eng'));
		$groups->inactive->setDbValue($rs->fields('inactive'));
		$groups->r_group->setDbValue($rs->fields('r_group'));
		$groups->points->setDbValue($rs->fields('points'));
		$groups->hide_list->setDbValue($rs->fields('hide_list'));
		$groups->total_wins->setDbValue($rs->fields('total_wins'));
		$groups->total_losses->setDbValue($rs->fields('total_losses'));
		$groups->current_wins->setDbValue($rs->fields('current_wins'));
		$groups->current_losses->setDbValue($rs->fields('current_losses'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $groups;

		// Initialize URLs
		$this->ViewUrl = $groups->ViewUrl();
		$this->EditUrl = $groups->EditUrl();
		$this->InlineEditUrl = $groups->InlineEditUrl();
		$this->CopyUrl = $groups->CopyUrl();
		$this->InlineCopyUrl = $groups->InlineCopyUrl();
		$this->DeleteUrl = $groups->DeleteUrl();

		// Call Row_Rendering event
		$groups->Row_Rendering();

		// Common render codes for all row types
		// Id

		$groups->Id->CellCssStyle = ""; $groups->Id->CellCssClass = "";
		$groups->Id->CellAttrs = array(); $groups->Id->ViewAttrs = array(); $groups->Id->EditAttrs = array();

		// nickname_kor
		$groups->nickname_kor->CellCssStyle = ""; $groups->nickname_kor->CellCssClass = "";
		$groups->nickname_kor->CellAttrs = array(); $groups->nickname_kor->ViewAttrs = array(); $groups->nickname_kor->EditAttrs = array();

		// nickname_eng
		$groups->nickname_eng->CellCssStyle = ""; $groups->nickname_eng->CellCssClass = "";
		$groups->nickname_eng->CellAttrs = array(); $groups->nickname_eng->ViewAttrs = array(); $groups->nickname_eng->EditAttrs = array();

		// inactive
		$groups->inactive->CellCssStyle = ""; $groups->inactive->CellCssClass = "";
		$groups->inactive->CellAttrs = array(); $groups->inactive->ViewAttrs = array(); $groups->inactive->EditAttrs = array();

		// r_group
		$groups->r_group->CellCssStyle = ""; $groups->r_group->CellCssClass = "";
		$groups->r_group->CellAttrs = array(); $groups->r_group->ViewAttrs = array(); $groups->r_group->EditAttrs = array();

		// points
		$groups->points->CellCssStyle = ""; $groups->points->CellCssClass = "";
		$groups->points->CellAttrs = array(); $groups->points->ViewAttrs = array(); $groups->points->EditAttrs = array();

		// hide_list
		$groups->hide_list->CellCssStyle = ""; $groups->hide_list->CellCssClass = "";
		$groups->hide_list->CellAttrs = array(); $groups->hide_list->ViewAttrs = array(); $groups->hide_list->EditAttrs = array();

		// total_wins
		$groups->total_wins->CellCssStyle = ""; $groups->total_wins->CellCssClass = "";
		$groups->total_wins->CellAttrs = array(); $groups->total_wins->ViewAttrs = array(); $groups->total_wins->EditAttrs = array();

		// total_losses
		$groups->total_losses->CellCssStyle = ""; $groups->total_losses->CellCssClass = "";
		$groups->total_losses->CellAttrs = array(); $groups->total_losses->ViewAttrs = array(); $groups->total_losses->EditAttrs = array();

		// current_wins
		$groups->current_wins->CellCssStyle = ""; $groups->current_wins->CellCssClass = "";
		$groups->current_wins->CellAttrs = array(); $groups->current_wins->ViewAttrs = array(); $groups->current_wins->EditAttrs = array();

		// current_losses
		$groups->current_losses->CellCssStyle = ""; $groups->current_losses->CellCssClass = "";
		$groups->current_losses->CellAttrs = array(); $groups->current_losses->ViewAttrs = array(); $groups->current_losses->EditAttrs = array();
		if ($groups->RowType == EW_ROWTYPE_VIEW) { // View row

			// Id
			$groups->Id->ViewValue = $groups->Id->CurrentValue;
			$groups->Id->CssStyle = "";
			$groups->Id->CssClass = "";
			$groups->Id->ViewCustomAttributes = "";

			// nickname_kor
			$groups->nickname_kor->ViewValue = $groups->nickname_kor->CurrentValue;
			$groups->nickname_kor->CssStyle = "";
			$groups->nickname_kor->CssClass = "";
			$groups->nickname_kor->ViewCustomAttributes = "";

			// nickname_eng
			$groups->nickname_eng->ViewValue = $groups->nickname_eng->CurrentValue;
			$groups->nickname_eng->CssStyle = "";
			$groups->nickname_eng->CssClass = "";
			$groups->nickname_eng->ViewCustomAttributes = "";

			// inactive
			$groups->inactive->ViewValue = $groups->inactive->CurrentValue;
			$groups->inactive->CssStyle = "";
			$groups->inactive->CssClass = "";
			$groups->inactive->ViewCustomAttributes = "";

			// r_group
			$groups->r_group->ViewValue = $groups->r_group->CurrentValue;
			$groups->r_group->CssStyle = "";
			$groups->r_group->CssClass = "";
			$groups->r_group->ViewCustomAttributes = "";

			// points
			$groups->points->ViewValue = $groups->points->CurrentValue;
			$groups->points->CssStyle = "";
			$groups->points->CssClass = "";
			$groups->points->ViewCustomAttributes = "";

			// hide_list
			$groups->hide_list->ViewValue = $groups->hide_list->CurrentValue;
			$groups->hide_list->CssStyle = "";
			$groups->hide_list->CssClass = "";
			$groups->hide_list->ViewCustomAttributes = "";

			// total_wins
			$groups->total_wins->ViewValue = $groups->total_wins->CurrentValue;
			$groups->total_wins->CssStyle = "";
			$groups->total_wins->CssClass = "";
			$groups->total_wins->ViewCustomAttributes = "";

			// total_losses
			$groups->total_losses->ViewValue = $groups->total_losses->CurrentValue;
			$groups->total_losses->CssStyle = "";
			$groups->total_losses->CssClass = "";
			$groups->total_losses->ViewCustomAttributes = "";

			// current_wins
			$groups->current_wins->ViewValue = $groups->current_wins->CurrentValue;
			$groups->current_wins->CssStyle = "";
			$groups->current_wins->CssClass = "";
			$groups->current_wins->ViewCustomAttributes = "";

			// current_losses
			$groups->current_losses->ViewValue = $groups->current_losses->CurrentValue;
			$groups->current_losses->CssStyle = "";
			$groups->current_losses->CssClass = "";
			$groups->current_losses->ViewCustomAttributes = "";

			// Id
			$groups->Id->HrefValue = "";
			$groups->Id->TooltipValue = "";

			// nickname_kor
			$groups->nickname_kor->HrefValue = "";
			$groups->nickname_kor->TooltipValue = "";

			// nickname_eng
			$groups->nickname_eng->HrefValue = "";
			$groups->nickname_eng->TooltipValue = "";

			// inactive
			$groups->inactive->HrefValue = "";
			$groups->inactive->TooltipValue = "";

			// r_group
			$groups->r_group->HrefValue = "";
			$groups->r_group->TooltipValue = "";

			// points
			$groups->points->HrefValue = "";
			$groups->points->TooltipValue = "";

			// hide_list
			$groups->hide_list->HrefValue = "";
			$groups->hide_list->TooltipValue = "";

			// total_wins
			$groups->total_wins->HrefValue = "";
			$groups->total_wins->TooltipValue = "";

			// total_losses
			$groups->total_losses->HrefValue = "";
			$groups->total_losses->TooltipValue = "";

			// current_wins
			$groups->current_wins->HrefValue = "";
			$groups->current_wins->TooltipValue = "";

			// current_losses
			$groups->current_losses->HrefValue = "";
			$groups->current_losses->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($groups->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$groups->Row_Rendered();
	}

	// Page Load event
	function Page_Load() {

		//echo "Page Load";
	}

	// Page Unload event
	function Page_Unload() {

		//echo "Page Unload";
	}

	// Page Redirecting event
	function Page_Redirecting(&$url) {

		// Example:
		//$url = "your URL";

	}

	// Message Showing event
	function Message_Showing(&$msg) {

		// Example:
		//$msg = "your new message";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
<?php
mysql_free_result($rsMemberNames);
?>