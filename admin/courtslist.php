<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "courtsinfo.php" ?>
<?php include "membersinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
header("Cache-Control: post-check=0, pre-check=0", false);
header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$courts_list = new ccourts_list();
$Page =& $courts_list;

// Page init
$courts_list->Page_Init();

// Page main
$courts_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($courts->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var courts_list = new ew_Page("courts_list");

// page properties
courts_list.PageID = "list"; // page ID
courts_list.FormID = "fcourtslist"; // form ID
var EW_PAGE_ID = courts_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
courts_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
courts_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
courts_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($courts->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$courts_list->lTotalRecs = $courts->SelectRecordCount();
	} else {
		if ($rs = $courts_list->LoadRecordset())
			$courts_list->lTotalRecs = $rs->RecordCount();
	}
	$courts_list->lStartRec = 1;
	if ($courts_list->lDisplayRecs <= 0 || ($courts->Export <> "" && $courts->ExportAll)) // Display all records
		$courts_list->lDisplayRecs = $courts_list->lTotalRecs;
	if (!($courts->Export <> "" && $courts->ExportAll))
		$courts_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $courts_list->LoadRecordset($courts_list->lStartRec-1, $courts_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $courts->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($courts->Export == "" && $courts->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(courts_list);" style="text-decoration: none;"><img id="courts_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="courts_list_SearchPanel">
<form name="fcourtslistsrch" id="fcourtslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="courts">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($courts->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $courts_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($courts->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($courts->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($courts->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$courts_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fcourtslist" id="fcourtslist" class="ewForm" action="" method="post">
<div id="gmp_courts" class="ewGridMiddlePanel">
<?php if ($courts_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $courts->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$courts_list->RenderListOptions();

// Render list options (header, left)
$courts_list->ListOptions->Render("header", "left");
?>
<?php if ($courts->id->Visible) { // id ?>
	<?php if ($courts->SortUrl($courts->id) == "") { ?>
		<td><?php echo $courts->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $courts->SortUrl($courts->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $courts->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($courts->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($courts->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($courts->name->Visible) { // name ?>
	<?php if ($courts->SortUrl($courts->name) == "") { ?>
		<td><?php echo $courts->name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $courts->SortUrl($courts->name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $courts->name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($courts->name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($courts->name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($courts->region->Visible) { // region ?>
	<?php if ($courts->SortUrl($courts->region) == "") { ?>
		<td><?php echo $courts->region->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $courts->SortUrl($courts->region) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $courts->region->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($courts->region->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($courts->region->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($courts->location->Visible) { // location ?>
	<?php if ($courts->SortUrl($courts->location) == "") { ?>
		<td><?php echo $courts->location->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $courts->SortUrl($courts->location) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $courts->location->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($courts->location->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($courts->location->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($courts->address->Visible) { // address ?>
	<?php if ($courts->SortUrl($courts->address) == "") { ?>
		<td><?php echo $courts->address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $courts->SortUrl($courts->address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $courts->address->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($courts->address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($courts->address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($courts->zip->Visible) { // zip ?>
	<?php if ($courts->SortUrl($courts->zip) == "") { ?>
		<td><?php echo $courts->zip->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $courts->SortUrl($courts->zip) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $courts->zip->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($courts->zip->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($courts->zip->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($courts->city->Visible) { // city ?>
	<?php if ($courts->SortUrl($courts->city) == "") { ?>
		<td><?php echo $courts->city->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $courts->SortUrl($courts->city) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $courts->city->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($courts->city->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($courts->city->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($courts->court_num->Visible) { // court_num ?>
	<?php if ($courts->SortUrl($courts->court_num) == "") { ?>
		<td><?php echo $courts->court_num->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $courts->SortUrl($courts->court_num) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $courts->court_num->FldCaption() ?></td><td style="width: 10px;"><?php if ($courts->court_num->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($courts->court_num->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($courts->lights->Visible) { // lights ?>
	<?php if ($courts->SortUrl($courts->lights) == "") { ?>
		<td><?php echo $courts->lights->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $courts->SortUrl($courts->lights) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $courts->lights->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($courts->lights->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($courts->lights->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($courts->maintenance->Visible) { // maintenance ?>
	<?php if ($courts->SortUrl($courts->maintenance) == "") { ?>
		<td><?php echo $courts->maintenance->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $courts->SortUrl($courts->maintenance) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $courts->maintenance->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($courts->maintenance->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($courts->maintenance->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($courts->website->Visible) { // website ?>
	<?php if ($courts->SortUrl($courts->website) == "") { ?>
		<td><?php echo $courts->website->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $courts->SortUrl($courts->website) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $courts->website->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($courts->website->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($courts->website->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($courts->phone->Visible) { // phone ?>
	<?php if ($courts->SortUrl($courts->phone) == "") { ?>
		<td><?php echo $courts->phone->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $courts->SortUrl($courts->phone) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $courts->phone->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($courts->phone->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($courts->phone->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$courts_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($courts->ExportAll && $courts->Export <> "") {
	$courts_list->lStopRec = $courts_list->lTotalRecs;
} else {
	$courts_list->lStopRec = $courts_list->lStartRec + $courts_list->lDisplayRecs - 1; // Set the last record to display
}
$courts_list->lRecCount = $courts_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $courts_list->lStartRec > 1)
		$rs->Move($courts_list->lStartRec - 1);
}

// Initialize aggregate
$courts->RowType = EW_ROWTYPE_AGGREGATEINIT;
$courts_list->RenderRow();
$courts_list->lRowCnt = 0;
while (($courts->CurrentAction == "gridadd" || !$rs->EOF) &&
	$courts_list->lRecCount < $courts_list->lStopRec) {
	$courts_list->lRecCount++;
	if (intval($courts_list->lRecCount) >= intval($courts_list->lStartRec)) {
		$courts_list->lRowCnt++;

	// Init row class and style
	$courts->CssClass = "";
	$courts->CssStyle = "";
	$courts->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($courts->CurrentAction == "gridadd") {
		$courts_list->LoadDefaultValues(); // Load default values
	} else {
		$courts_list->LoadRowValues($rs); // Load row values
	}
	$courts->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$courts_list->RenderRow();

	// Render list options
	$courts_list->RenderListOptions();
?>
	<tr<?php echo $courts->RowAttributes() ?>>
<?php

// Render list options (body, left)
$courts_list->ListOptions->Render("body", "left");
?>
	<?php if ($courts->id->Visible) { // id ?>
		<td<?php echo $courts->id->CellAttributes() ?>>
<div<?php echo $courts->id->ViewAttributes() ?>><?php echo $courts->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($courts->name->Visible) { // name ?>
		<td<?php echo $courts->name->CellAttributes() ?>>
<div<?php echo $courts->name->ViewAttributes() ?>><?php echo $courts->name->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($courts->region->Visible) { // region ?>
		<td<?php echo $courts->region->CellAttributes() ?>>
<div<?php echo $courts->region->ViewAttributes() ?>><?php echo $courts->region->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($courts->location->Visible) { // location ?>
		<td<?php echo $courts->location->CellAttributes() ?>>
<div<?php echo $courts->location->ViewAttributes() ?>><?php echo $courts->location->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($courts->address->Visible) { // address ?>
		<td<?php echo $courts->address->CellAttributes() ?>>
<div<?php echo $courts->address->ViewAttributes() ?>><?php echo $courts->address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($courts->zip->Visible) { // zip ?>
		<td<?php echo $courts->zip->CellAttributes() ?>>
<div<?php echo $courts->zip->ViewAttributes() ?>><?php echo $courts->zip->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($courts->city->Visible) { // city ?>
		<td<?php echo $courts->city->CellAttributes() ?>>
<div<?php echo $courts->city->ViewAttributes() ?>><?php echo $courts->city->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($courts->court_num->Visible) { // court_num ?>
		<td<?php echo $courts->court_num->CellAttributes() ?>>
<div<?php echo $courts->court_num->ViewAttributes() ?>><?php echo $courts->court_num->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($courts->lights->Visible) { // lights ?>
		<td<?php echo $courts->lights->CellAttributes() ?>>
<div<?php echo $courts->lights->ViewAttributes() ?>><?php echo $courts->lights->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($courts->maintenance->Visible) { // maintenance ?>
		<td<?php echo $courts->maintenance->CellAttributes() ?>>
<div<?php echo $courts->maintenance->ViewAttributes() ?>><?php echo $courts->maintenance->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($courts->website->Visible) { // website ?>
		<td<?php echo $courts->website->CellAttributes() ?>>
<div<?php echo $courts->website->ViewAttributes() ?>><?php echo $courts->website->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($courts->phone->Visible) { // phone ?>
		<td<?php echo $courts->phone->CellAttributes() ?>>
<div<?php echo $courts->phone->ViewAttributes() ?>><?php echo $courts->phone->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$courts_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($courts->CurrentAction <> "gridadd")
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
<?php if ($courts->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($courts->CurrentAction <> "gridadd" && $courts->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($courts_list->Pager)) $courts_list->Pager = new cPrevNextPager($courts_list->lStartRec, $courts_list->lDisplayRecs, $courts_list->lTotalRecs) ?>
<?php if ($courts_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($courts_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $courts_list->PageUrl() ?>start=<?php echo $courts_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($courts_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $courts_list->PageUrl() ?>start=<?php echo $courts_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $courts_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($courts_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $courts_list->PageUrl() ?>start=<?php echo $courts_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($courts_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $courts_list->PageUrl() ?>start=<?php echo $courts_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $courts_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $courts_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $courts_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $courts_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($courts_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($courts_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $courts_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($courts->Export == "" && $courts->CurrentAction == "") { ?>
<?php } ?>
<?php if ($courts->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$courts_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccourts_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'courts';

	// Page object name
	var $PageObjName = 'courts_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $courts;
		if ($courts->UseTokenInUrl) $PageUrl .= "t=" . $courts->TableVar . "&"; // Add page token
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
		global $objForm, $courts;
		if ($courts->UseTokenInUrl) {
			if ($objForm)
				return ($courts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($courts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccourts_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (courts)
		$GLOBALS["courts"] = new ccourts();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["courts"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "courtsdelete.php";
		$this->MultiUpdateUrl = "courtsupdate.php";

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'courts', TRUE);

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
		global $courts;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$courts->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$courts->Export = $_POST["exporttype"];
		} else {
			$courts->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $courts->Export; // Get export parameter, used in header
		$gsExportFile = $courts->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $courts;

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
			$courts->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($courts->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $courts->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$courts->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$courts->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$courts->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $courts->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$courts->setSessionWhere($sFilter);
		$courts->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $courts;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $courts->name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $courts->region, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $courts->location, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $courts->address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $courts->zip, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $courts->city, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $courts->time, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $courts->cost, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $courts->lights, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $courts->maintenance, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $courts->website, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $courts->phone, $Keyword);
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
		global $Security, $courts;
		$sSearchStr = "";
		$sSearchKeyword = $courts->BasicSearchKeyword;
		$sSearchType = $courts->BasicSearchType;
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
			$courts->setSessionBasicSearchKeyword($sSearchKeyword);
			$courts->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $courts;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$courts->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $courts;
		$courts->setSessionBasicSearchKeyword("");
		$courts->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $courts;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$courts->BasicSearchKeyword = $courts->getSessionBasicSearchKeyword();
			$courts->BasicSearchType = $courts->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $courts;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$courts->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$courts->CurrentOrderType = @$_GET["ordertype"];
			$courts->UpdateSort($courts->id); // id
			$courts->UpdateSort($courts->name); // name
			$courts->UpdateSort($courts->region); // region
			$courts->UpdateSort($courts->location); // location
			$courts->UpdateSort($courts->address); // address
			$courts->UpdateSort($courts->zip); // zip
			$courts->UpdateSort($courts->city); // city
			$courts->UpdateSort($courts->court_num); // court_num
			$courts->UpdateSort($courts->lights); // lights
			$courts->UpdateSort($courts->maintenance); // maintenance
			$courts->UpdateSort($courts->website); // website
			$courts->UpdateSort($courts->phone); // phone
			$courts->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $courts;
		$sOrderBy = $courts->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($courts->SqlOrderBy() <> "") {
				$sOrderBy = $courts->SqlOrderBy();
				$courts->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $courts;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$courts->setSessionOrderBy($sOrderBy);
				$courts->id->setSort("");
				$courts->name->setSort("");
				$courts->region->setSort("");
				$courts->location->setSort("");
				$courts->address->setSort("");
				$courts->zip->setSort("");
				$courts->city->setSort("");
				$courts->court_num->setSort("");
				$courts->lights->setSort("");
				$courts->maintenance->setSort("");
				$courts->website->setSort("");
				$courts->phone->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$courts->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $courts;

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

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($courts->Export <> "" ||
			$courts->CurrentAction == "gridadd" ||
			$courts->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $courts;
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

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $courts;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $courts;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$courts->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$courts->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $courts->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$courts->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$courts->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$courts->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $courts;
		$courts->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$courts->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $courts;

		// Call Recordset Selecting event
		$courts->Recordset_Selecting($courts->CurrentFilter);

		// Load List page SQL
		$sSql = $courts->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$courts->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $courts;
		$sFilter = $courts->KeyFilter();

		// Call Row Selecting event
		$courts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$courts->CurrentFilter = $sFilter;
		$sSql = $courts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$courts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $courts;
		$courts->id->setDbValue($rs->fields('id'));
		$courts->name->setDbValue($rs->fields('name'));
		$courts->region->setDbValue($rs->fields('region'));
		$courts->location->setDbValue($rs->fields('location'));
		$courts->address->setDbValue($rs->fields('address'));
		$courts->zip->setDbValue($rs->fields('zip'));
		$courts->city->setDbValue($rs->fields('city'));
		$courts->time->setDbValue($rs->fields('time'));
		$courts->cost->setDbValue($rs->fields('cost'));
		$courts->court_num->setDbValue($rs->fields('court_num'));
		$courts->lights->setDbValue($rs->fields('lights'));
		$courts->maintenance->setDbValue($rs->fields('maintenance'));
		$courts->website->setDbValue($rs->fields('website'));
		$courts->phone->setDbValue($rs->fields('phone'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $courts;

		// Initialize URLs
		$this->ViewUrl = $courts->ViewUrl();
		$this->EditUrl = $courts->EditUrl();
		$this->InlineEditUrl = $courts->InlineEditUrl();
		$this->CopyUrl = $courts->CopyUrl();
		$this->InlineCopyUrl = $courts->InlineCopyUrl();
		$this->DeleteUrl = $courts->DeleteUrl();

		// Call Row_Rendering event
		$courts->Row_Rendering();

		// Common render codes for all row types
		// id

		$courts->id->CellCssStyle = ""; $courts->id->CellCssClass = "";
		$courts->id->CellAttrs = array(); $courts->id->ViewAttrs = array(); $courts->id->EditAttrs = array();

		// name
		$courts->name->CellCssStyle = ""; $courts->name->CellCssClass = "";
		$courts->name->CellAttrs = array(); $courts->name->ViewAttrs = array(); $courts->name->EditAttrs = array();

		// region
		$courts->region->CellCssStyle = ""; $courts->region->CellCssClass = "";
		$courts->region->CellAttrs = array(); $courts->region->ViewAttrs = array(); $courts->region->EditAttrs = array();

		// location
		$courts->location->CellCssStyle = ""; $courts->location->CellCssClass = "";
		$courts->location->CellAttrs = array(); $courts->location->ViewAttrs = array(); $courts->location->EditAttrs = array();

		// address
		$courts->address->CellCssStyle = ""; $courts->address->CellCssClass = "";
		$courts->address->CellAttrs = array(); $courts->address->ViewAttrs = array(); $courts->address->EditAttrs = array();

		// zip
		$courts->zip->CellCssStyle = ""; $courts->zip->CellCssClass = "";
		$courts->zip->CellAttrs = array(); $courts->zip->ViewAttrs = array(); $courts->zip->EditAttrs = array();

		// city
		$courts->city->CellCssStyle = ""; $courts->city->CellCssClass = "";
		$courts->city->CellAttrs = array(); $courts->city->ViewAttrs = array(); $courts->city->EditAttrs = array();

		// court_num
		$courts->court_num->CellCssStyle = ""; $courts->court_num->CellCssClass = "";
		$courts->court_num->CellAttrs = array(); $courts->court_num->ViewAttrs = array(); $courts->court_num->EditAttrs = array();

		// lights
		$courts->lights->CellCssStyle = ""; $courts->lights->CellCssClass = "";
		$courts->lights->CellAttrs = array(); $courts->lights->ViewAttrs = array(); $courts->lights->EditAttrs = array();

		// maintenance
		$courts->maintenance->CellCssStyle = ""; $courts->maintenance->CellCssClass = "";
		$courts->maintenance->CellAttrs = array(); $courts->maintenance->ViewAttrs = array(); $courts->maintenance->EditAttrs = array();

		// website
		$courts->website->CellCssStyle = ""; $courts->website->CellCssClass = "";
		$courts->website->CellAttrs = array(); $courts->website->ViewAttrs = array(); $courts->website->EditAttrs = array();

		// phone
		$courts->phone->CellCssStyle = ""; $courts->phone->CellCssClass = "";
		$courts->phone->CellAttrs = array(); $courts->phone->ViewAttrs = array(); $courts->phone->EditAttrs = array();
		if ($courts->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$courts->id->ViewValue = $courts->id->CurrentValue;
			$courts->id->CssStyle = "";
			$courts->id->CssClass = "";
			$courts->id->ViewCustomAttributes = "";

			// name
			$courts->name->ViewValue = $courts->name->CurrentValue;
			$courts->name->CssStyle = "";
			$courts->name->CssClass = "";
			$courts->name->ViewCustomAttributes = "";

			// region
			$courts->region->ViewValue = $courts->region->CurrentValue;
			$courts->region->CssStyle = "";
			$courts->region->CssClass = "";
			$courts->region->ViewCustomAttributes = "";

			// location
			$courts->location->ViewValue = $courts->location->CurrentValue;
			$courts->location->CssStyle = "";
			$courts->location->CssClass = "";
			$courts->location->ViewCustomAttributes = "";

			// address
			$courts->address->ViewValue = $courts->address->CurrentValue;
			$courts->address->CssStyle = "";
			$courts->address->CssClass = "";
			$courts->address->ViewCustomAttributes = "";

			// zip
			$courts->zip->ViewValue = $courts->zip->CurrentValue;
			$courts->zip->CssStyle = "";
			$courts->zip->CssClass = "";
			$courts->zip->ViewCustomAttributes = "";

			// city
			$courts->city->ViewValue = $courts->city->CurrentValue;
			$courts->city->CssStyle = "";
			$courts->city->CssClass = "";
			$courts->city->ViewCustomAttributes = "";

			// court_num
			$courts->court_num->ViewValue = $courts->court_num->CurrentValue;
			$courts->court_num->CssStyle = "";
			$courts->court_num->CssClass = "";
			$courts->court_num->ViewCustomAttributes = "";

			// lights
			$courts->lights->ViewValue = $courts->lights->CurrentValue;
			$courts->lights->CssStyle = "";
			$courts->lights->CssClass = "";
			$courts->lights->ViewCustomAttributes = "";

			// maintenance
			$courts->maintenance->ViewValue = $courts->maintenance->CurrentValue;
			$courts->maintenance->CssStyle = "";
			$courts->maintenance->CssClass = "";
			$courts->maintenance->ViewCustomAttributes = "";

			// website
			$courts->website->ViewValue = $courts->website->CurrentValue;
			$courts->website->CssStyle = "";
			$courts->website->CssClass = "";
			$courts->website->ViewCustomAttributes = "";

			// phone
			$courts->phone->ViewValue = $courts->phone->CurrentValue;
			$courts->phone->CssStyle = "";
			$courts->phone->CssClass = "";
			$courts->phone->ViewCustomAttributes = "";

			// id
			$courts->id->HrefValue = "";
			$courts->id->TooltipValue = "";

			// name
			$courts->name->HrefValue = "";
			$courts->name->TooltipValue = "";

			// region
			$courts->region->HrefValue = "";
			$courts->region->TooltipValue = "";

			// location
			$courts->location->HrefValue = "";
			$courts->location->TooltipValue = "";

			// address
			$courts->address->HrefValue = "";
			$courts->address->TooltipValue = "";

			// zip
			$courts->zip->HrefValue = "";
			$courts->zip->TooltipValue = "";

			// city
			$courts->city->HrefValue = "";
			$courts->city->TooltipValue = "";

			// court_num
			$courts->court_num->HrefValue = "";
			$courts->court_num->TooltipValue = "";

			// lights
			$courts->lights->HrefValue = "";
			$courts->lights->TooltipValue = "";

			// maintenance
			$courts->maintenance->HrefValue = "";
			$courts->maintenance->TooltipValue = "";

			// website
			$courts->website->HrefValue = "";
			$courts->website->TooltipValue = "";

			// phone
			$courts->phone->HrefValue = "";
			$courts->phone->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($courts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$courts->Row_Rendered();
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
