<script type="text/javascript">
function memberStatus(id, active)  {
	// alert(id);
	window.location = "update_member_status.php?id=" + id + "&active=" + active
}
</script>

<?php
//session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "membersinfo.php" ?>
<?php include "userfn7.php" ?>
<?php
//header("Expires: Mon, 26 Jul 1997 05:00:00 GMT"); // Date in the past
//header("Last-Modified: " . gmdate("D, d M Y H:i:s") . " GMT"); // Always modified
//header("Cache-Control: private, no-store, no-cache, must-revalidate"); // HTTP/1.1 
//header("Cache-Control: post-check=0, pre-check=0", false);
//header("Pragma: no-cache"); // HTTP/1.0
?>
<?php

// Create page object
$members_list = new cmembers_list();
$Page =& $members_list;

// Page init
$members_list->Page_Init();

// Page main
$members_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($members->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var members_list = new ew_Page("members_list");

// page properties
members_list.PageID = "list"; // page ID
members_list.FormID = "fmemberslist"; // form ID
var EW_PAGE_ID = members_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
members_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
members_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
members_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($members->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$members_list->lTotalRecs = $members->SelectRecordCount();
	} else {
		if ($rs = $members_list->LoadRecordset())
			$members_list->lTotalRecs = $rs->RecordCount();
	}
	$members_list->lStartRec = 1;
	if ($members_list->lDisplayRecs <= 0 || ($members->Export <> "" && $members->ExportAll)) // Display all records
		$members_list->lDisplayRecs = $members_list->lTotalRecs;
	if (!($members->Export <> "" && $members->ExportAll))
		$members_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $members_list->LoadRecordset($members_list->lStartRec-1, $members_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $members->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($members->Export == "" && $members->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(members_list);" style="text-decoration: none;"><img id="members_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="members_list_SearchPanel">
<form name="fmemberslistsrch" id="fmemberslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="members">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($members->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $members_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($members->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($members->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($members->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$members_list->ShowMessage();
?>
<br>

<!-- Add Link -->
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $members_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>

<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fmemberslist" id="fmemberslist" class="ewForm" action="" method="post">
<div id="gmp_members" class="ewGridMiddlePanel">
<?php if ($members_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $members->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$members_list->RenderListOptions();

// Render list options (header, left)
$members_list->ListOptions->Render("header", "left");
?>

<?php

// Render list options (header, right)
$members_list->ListOptions->Render("header", "right");
?>
<?php if ($members->Id->Visible) { // Id ?>
	<?php if ($members->SortUrl($members->Id) == "") { ?>
		<td><?php echo $members->Id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->Id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->Id->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->Id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->Id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		

<?php if ($members->active_member->Visible) { // active_member ?>
	<?php if ($members->SortUrl($members->active_member) == "") { ?>
		<td>Active</td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->active_member) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td>Active</td><td style="width: 10px;"><?php if ($members->active_member->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->active_member->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		

<!-- Last Name-->
<?php if ($members->last_name->Visible) { // last_name ?>
	<?php if ($members->SortUrl($members->last_name) == "") { ?>
		<td><?php echo $members->last_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->last_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->last_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->last_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->last_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		

<!-- First Name-->
<?php if ($members->first_name->Visible) { // first_name ?>
	<?php if ($members->SortUrl($members->first_name) == "") { ?>
		<td><?php echo $members->first_name->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->first_name) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->first_name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->first_name->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->first_name->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		

<?php if ($members->first_name_eng->Visible) { // first_name_eng ?>
	<?php if ($members->SortUrl($members->first_name_eng) == "") { ?>
		<td><?php echo $members->first_name_eng->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->first_name_eng) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->first_name_eng->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->first_name_eng->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->first_name_eng->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->last_name_eng->Visible) { // last_name_eng ?>
	<?php if ($members->SortUrl($members->last_name_eng) == "") { ?>
		<td><?php echo $members->last_name_eng->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->last_name_eng) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->last_name_eng->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->last_name_eng->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->last_name_eng->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->username->Visible) { // username ?>
	<?php if ($members->SortUrl($members->username) == "") { ?>
		<td><?php echo $members->username->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->username) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->username->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->username->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->username->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->password->Visible) { // password ?>
	<?php if ($members->SortUrl($members->password) == "") { ?>
		<td><?php echo $members->password->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->password) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->password->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->password->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->password->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->phone_cell->Visible) { // phone_cell ?>
	<?php if ($members->SortUrl($members->phone_cell) == "") { ?>
		<td><?php echo $members->phone_cell->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->phone_cell) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->phone_cell->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->phone_cell->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->phone_cell->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->phone_home->Visible) { // phone_home ?>
	<?php if ($members->SortUrl($members->phone_home) == "") { ?>
		<td><?php echo $members->phone_home->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->phone_home) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->phone_home->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->phone_home->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->phone_home->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->zemail->Visible) { // email ?>
	<?php if ($members->SortUrl($members->zemail) == "") { ?>
		<td><?php echo $members->zemail->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->zemail) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->zemail->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->zemail->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->zemail->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->address->Visible) { // address ?>
	<?php if ($members->SortUrl($members->address) == "") { ?>
		<td><?php echo $members->address->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->address) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->address->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->address->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->address->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->city->Visible) { // city ?>
	<?php if ($members->SortUrl($members->city) == "") { ?>
		<td><?php echo $members->city->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->city) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->city->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->city->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->city->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->zip->Visible) { // zip ?>
	<?php if ($members->SortUrl($members->zip) == "") { ?>
		<td><?php echo $members->zip->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->zip) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->zip->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->zip->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->zip->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->gender->Visible) { // gender ?>
	<?php if ($members->SortUrl($members->gender) == "") { ?>
		<td><?php echo $members->gender->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->gender) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->gender->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($members->gender->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->gender->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->status_student->Visible) { // status_student ?>
	<?php if ($members->SortUrl($members->status_student) == "") { ?>
		<td><?php echo $members->status_student->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->status_student) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->status_student->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->status_student->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->status_student->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->ethnicity_korean->Visible) { // ethnicity_korean ?>
	<?php if ($members->SortUrl($members->ethnicity_korean) == "") { ?>
		<td><?php echo $members->ethnicity_korean->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->ethnicity_korean) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->ethnicity_korean->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->ethnicity_korean->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->ethnicity_korean->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->language_korean->Visible) { // language_korean ?>
	<?php if ($members->SortUrl($members->language_korean) == "") { ?>
		<td><?php echo $members->language_korean->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->language_korean) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->language_korean->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->language_korean->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->language_korean->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($members->access_level->Visible) { // access_level ?>
	<?php if ($members->SortUrl($members->access_level) == "") { ?>
		<td><?php echo $members->access_level->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $members->SortUrl($members->access_level) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $members->access_level->FldCaption() ?></td><td style="width: 10px;"><?php if ($members->access_level->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($members->access_level->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		

	</tr>
</thead>
<?php
if ($members->ExportAll && $members->Export <> "") {
	$members_list->lStopRec = $members_list->lTotalRecs;
} else {
	$members_list->lStopRec = $members_list->lStartRec + $members_list->lDisplayRecs - 1; // Set the last record to display
}
$members_list->lRecCount = $members_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $members_list->lStartRec > 1)
		$rs->Move($members_list->lStartRec - 1);
}

// Initialize aggregate
$members->RowType = EW_ROWTYPE_AGGREGATEINIT;
$members_list->RenderRow();
$members_list->lRowCnt = 0;
while (($members->CurrentAction == "gridadd" || !$rs->EOF) &&
	$members_list->lRecCount < $members_list->lStopRec) {
	$members_list->lRecCount++;
	if (intval($members_list->lRecCount) >= intval($members_list->lStartRec)) {
		$members_list->lRowCnt++;

	// Init row class and style
	$members->CssClass = "";
	$members->CssStyle = "";
	$members->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($members->CurrentAction == "gridadd") {
		$members_list->LoadDefaultValues(); // Load default values
	} else {
		$members_list->LoadRowValues($rs); // Load row values
	}
	$members->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$members_list->RenderRow();

	// Render list options
	$members_list->RenderListOptions();
?>
	
<?php
// Render list options (body, left)
$members_list->ListOptions->Render("body", "left");
?>

<?php
// Render list options (body, right)
$members_list->ListOptions->Render("body", "right");
?>

	<?php if ($members->Id->Visible) { // Id ?>
		<td<?php echo $members->Id->CellAttributes() ?>>
<div<?php echo $members->Id->ViewAttributes() ?>><?php echo $members->Id->ListViewValue() ?></div>
</td>
	<?php } ?>
    
	<?php if ($members->active_member->Visible) { // active_member ?>
		<td<?php echo $members->active_member->CellAttributes() ?>>
        <a name="id_<?php echo $members->Id->ListViewValue() ?>"></a>
<div<?php echo $members->active_member->ViewAttributes() ?> align="center" onclick="memberStatus(<?php echo $members->Id->ListViewValue() ?>, <?php echo $members->active_member->ListViewValue() ?>);">
<u><?php if ($members->active_member->ListViewValue() == 1) { echo "YES"; } else { echo "NO"; } ?></u>
</div>
</td>
	<?php } ?>

<!-- Last Name -->
	<?php if ($members->last_name->Visible) { // last_name ?>
		<td<?php echo $members->last_name->CellAttributes() ?>>
<div<?php echo $members->last_name->ViewAttributes() ?>><?php echo $members->last_name->ListViewValue() ?></div>
</td>
	<?php } ?>

<!-- First Name -->
	<?php if ($members->first_name->Visible) { // first_name ?>
		<td<?php echo $members->first_name->CellAttributes() ?>>
<div<?php echo $members->first_name->ViewAttributes() ?>><?php echo $members->first_name->ListViewValue() ?></div>
</td>
	<?php } ?>

	<?php if ($members->first_name_eng->Visible) { // first_name_eng ?>
		<td<?php echo $members->first_name_eng->CellAttributes() ?>>
<div<?php echo $members->first_name_eng->ViewAttributes() ?>><?php echo $members->first_name_eng->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->last_name_eng->Visible) { // last_name_eng ?>
		<td<?php echo $members->last_name_eng->CellAttributes() ?>>
<div<?php echo $members->last_name_eng->ViewAttributes() ?>><?php echo $members->last_name_eng->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->username->Visible) { // username ?>
		<td<?php echo $members->username->CellAttributes() ?>>
<div<?php echo $members->username->ViewAttributes() ?>><?php echo $members->username->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->password->Visible) { // password ?>
		<td<?php echo $members->password->CellAttributes() ?>>
<div<?php echo $members->password->ViewAttributes() ?>><?php echo $members->password->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->phone_cell->Visible) { // phone_cell ?>
		<td<?php echo $members->phone_cell->CellAttributes() ?>>
<div<?php echo $members->phone_cell->ViewAttributes() ?>><?php echo $members->phone_cell->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->phone_home->Visible) { // phone_home ?>
		<td<?php echo $members->phone_home->CellAttributes() ?>>
<div<?php echo $members->phone_home->ViewAttributes() ?>><?php echo $members->phone_home->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->zemail->Visible) { // email ?>
		<td<?php echo $members->zemail->CellAttributes() ?>>
<div<?php echo $members->zemail->ViewAttributes() ?>><?php echo $members->zemail->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->address->Visible) { // address ?>
		<td<?php echo $members->address->CellAttributes() ?>>
<div<?php echo $members->address->ViewAttributes() ?>><?php echo $members->address->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->city->Visible) { // city ?>
		<td<?php echo $members->city->CellAttributes() ?>>
<div<?php echo $members->city->ViewAttributes() ?>><?php echo $members->city->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->zip->Visible) { // zip ?>
		<td<?php echo $members->zip->CellAttributes() ?>>
<div<?php echo $members->zip->ViewAttributes() ?>><?php echo $members->zip->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->gender->Visible) { // gender ?>
		<td<?php echo $members->gender->CellAttributes() ?>>
<div<?php echo $members->gender->ViewAttributes() ?>><?php echo $members->gender->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->status_student->Visible) { // status_student ?>
		<td<?php echo $members->status_student->CellAttributes() ?>>
<div<?php echo $members->status_student->ViewAttributes() ?>><?php echo $members->status_student->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->ethnicity_korean->Visible) { // ethnicity_korean ?>
		<td<?php echo $members->ethnicity_korean->CellAttributes() ?>>
<div<?php echo $members->ethnicity_korean->ViewAttributes() ?>><?php echo $members->ethnicity_korean->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->language_korean->Visible) { // language_korean ?>
		<td<?php echo $members->language_korean->CellAttributes() ?>>
<div<?php echo $members->language_korean->ViewAttributes() ?>><?php echo $members->language_korean->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($members->access_level->Visible) { // access_level ?>
		<td<?php echo $members->access_level->CellAttributes() ?>>
<div<?php echo $members->access_level->ViewAttributes() ?>><?php echo $members->access_level->ListViewValue() ?></div>
</td>
	<?php } ?>
	</tr>
<?php
	}
	if ($members->CurrentAction <> "gridadd")
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
<?php if ($members->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($members->CurrentAction <> "gridadd" && $members->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($members_list->Pager)) $members_list->Pager = new cPrevNextPager($members_list->lStartRec, $members_list->lDisplayRecs, $members_list->lTotalRecs) ?>
<?php if ($members_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($members_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $members_list->PageUrl() ?>start=<?php echo $members_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($members_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $members_list->PageUrl() ?>start=<?php echo $members_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $members_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($members_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $members_list->PageUrl() ?>start=<?php echo $members_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($members_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $members_list->PageUrl() ?>start=<?php echo $members_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $members_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $members_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $members_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $members_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($members_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($members_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $members_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($members->Export == "" && $members->CurrentAction == "") { ?>
<?php } ?>
<?php if ($members->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$members_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembers_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'members';

	// Page object name
	var $PageObjName = 'members_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $members;
		if ($members->UseTokenInUrl) $PageUrl .= "t=" . $members->TableVar . "&"; // Add page token
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
		global $objForm, $members;
		if ($members->UseTokenInUrl) {
			if ($objForm)
				return ($members->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($members->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cmembers_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (members)
		$GLOBALS["members"] = new cmembers();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["members"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "membersdelete.php";
		$this->MultiUpdateUrl = "membersupdate.php";

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'members', TRUE);

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
		global $members;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$members->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$members->Export = $_POST["exporttype"];
		} else {
			$members->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $members->Export; // Get export parameter, used in header
		$gsExportFile = $members->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $members;

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
			$members->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($members->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $members->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 1000; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$members->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$members->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$members->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $members->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$members->setSessionWhere($sFilter);
		$members->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $members;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $members->first_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $members->last_name, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $members->first_name_eng, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $members->last_name_eng, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $members->username, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $members->password, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $members->phone_cell, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $members->phone_home, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $members->zemail, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $members->address, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $members->city, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $members->zip, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $members->gender, $Keyword);
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
		global $Security, $members;
		$sSearchStr = "";
		$sSearchKeyword = $members->BasicSearchKeyword;
		$sSearchType = $members->BasicSearchType;
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
			$members->setSessionBasicSearchKeyword($sSearchKeyword);
			$members->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $members;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$members->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $members;
		$members->setSessionBasicSearchKeyword("");
		$members->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $members;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$members->BasicSearchKeyword = $members->getSessionBasicSearchKeyword();
			$members->BasicSearchType = $members->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $members;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$members->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$members->CurrentOrderType = @$_GET["ordertype"];
			$members->UpdateSort($members->Id); // Id
			$members->UpdateSort($members->first_name); // first_name
			$members->UpdateSort($members->last_name); // last_name
			$members->UpdateSort($members->first_name_eng); // first_name_eng
			$members->UpdateSort($members->last_name_eng); // last_name_eng
			$members->UpdateSort($members->username); // username
			$members->UpdateSort($members->password); // password
			$members->UpdateSort($members->phone_cell); // phone_cell
			$members->UpdateSort($members->phone_home); // phone_home
			$members->UpdateSort($members->zemail); // email
			$members->UpdateSort($members->address); // address
			$members->UpdateSort($members->city); // city
			$members->UpdateSort($members->zip); // zip
			$members->UpdateSort($members->gender); // gender
			$members->UpdateSort($members->status_student); // status_student
			$members->UpdateSort($members->ethnicity_korean); // ethnicity_korean
			$members->UpdateSort($members->language_korean); // language_korean
			$members->UpdateSort($members->access_level); // access_level
			$members->UpdateSort($members->active_member); // active_member
			$members->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $members;
		$sOrderBy = $members->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($members->SqlOrderBy() <> "") {
				$sOrderBy = $members->SqlOrderBy();
				$members->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $members;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$members->setSessionOrderBy($sOrderBy);
				$members->Id->setSort("");
				$members->first_name->setSort("");
				$members->last_name->setSort("");
				$members->first_name_eng->setSort("");
				$members->last_name_eng->setSort("");
				$members->username->setSort("");
				$members->password->setSort("");
				$members->phone_cell->setSort("");
				$members->phone_home->setSort("");
				$members->zemail->setSort("");
				$members->address->setSort("");
				$members->city->setSort("");
				$members->zip->setSort("");
				$members->gender->setSort("");
				$members->status_student->setSort("");
				$members->ethnicity_korean->setSort("");
				$members->language_korean->setSort("");
				$members->access_level->setSort("");
				$members->active_member->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$members->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $members;

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
		if ($members->Export <> "" ||
			$members->CurrentAction == "gridadd" ||
			$members->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $members;
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
		global $Security, $Language, $members;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $members;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$members->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$members->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $members->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$members->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$members->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$members->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $members;
		$members->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$members->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $members;

		// Call Recordset Selecting event
		$members->Recordset_Selecting($members->CurrentFilter);

		// Load List page SQL
		$sSql = $members->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$members->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $members;
		$sFilter = $members->KeyFilter();

		// Call Row Selecting event
		$members->Row_Selecting($sFilter);

		// Load SQL based on filter
		$members->CurrentFilter = $sFilter;
		$sSql = $members->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$members->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $members;
		$members->Id->setDbValue($rs->fields('Id'));
		$members->first_name->setDbValue($rs->fields('first_name'));
		$members->last_name->setDbValue($rs->fields('last_name'));
		$members->first_name_eng->setDbValue($rs->fields('first_name_eng'));
		$members->last_name_eng->setDbValue($rs->fields('last_name_eng'));
		$members->username->setDbValue($rs->fields('username'));
		$members->password->setDbValue($rs->fields('password'));
		$members->phone_cell->setDbValue($rs->fields('phone_cell'));
		$members->phone_home->setDbValue($rs->fields('phone_home'));
		$members->zemail->setDbValue($rs->fields('email'));
		$members->address->setDbValue($rs->fields('address'));
		$members->city->setDbValue($rs->fields('city'));
		$members->zip->setDbValue($rs->fields('zip'));
		$members->gender->setDbValue($rs->fields('gender'));
		$members->status_student->setDbValue($rs->fields('status_student'));
		$members->ethnicity_korean->setDbValue($rs->fields('ethnicity_korean'));
		$members->language_korean->setDbValue($rs->fields('language_korean'));
		$members->access_level->setDbValue($rs->fields('access_level'));
		$members->active_member->setDbValue($rs->fields('active_member'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $members;

		// Initialize URLs
		$this->ViewUrl = $members->ViewUrl();
		$this->EditUrl = $members->EditUrl();
		$this->InlineEditUrl = $members->InlineEditUrl();
		$this->CopyUrl = $members->CopyUrl();
		$this->InlineCopyUrl = $members->InlineCopyUrl();
		$this->DeleteUrl = $members->DeleteUrl();

		// Call Row_Rendering event
		$members->Row_Rendering();

		// Common render codes for all row types
		// Id

		$members->Id->CellCssStyle = ""; $members->Id->CellCssClass = "";
		$members->Id->CellAttrs = array(); $members->Id->ViewAttrs = array(); $members->Id->EditAttrs = array();

		// first_name
		$members->first_name->CellCssStyle = ""; $members->first_name->CellCssClass = "";
		$members->first_name->CellAttrs = array(); $members->first_name->ViewAttrs = array(); $members->first_name->EditAttrs = array();

		// last_name
		$members->last_name->CellCssStyle = ""; $members->last_name->CellCssClass = "";
		$members->last_name->CellAttrs = array(); $members->last_name->ViewAttrs = array(); $members->last_name->EditAttrs = array();

		// first_name_eng
		$members->first_name_eng->CellCssStyle = ""; $members->first_name_eng->CellCssClass = "";
		$members->first_name_eng->CellAttrs = array(); $members->first_name_eng->ViewAttrs = array(); $members->first_name_eng->EditAttrs = array();

		// last_name_eng
		$members->last_name_eng->CellCssStyle = ""; $members->last_name_eng->CellCssClass = "";
		$members->last_name_eng->CellAttrs = array(); $members->last_name_eng->ViewAttrs = array(); $members->last_name_eng->EditAttrs = array();

		// username
		$members->username->CellCssStyle = ""; $members->username->CellCssClass = "";
		$members->username->CellAttrs = array(); $members->username->ViewAttrs = array(); $members->username->EditAttrs = array();

		// password
		$members->password->CellCssStyle = ""; $members->password->CellCssClass = "";
		$members->password->CellAttrs = array(); $members->password->ViewAttrs = array(); $members->password->EditAttrs = array();

		// phone_cell
		$members->phone_cell->CellCssStyle = ""; $members->phone_cell->CellCssClass = "";
		$members->phone_cell->CellAttrs = array(); $members->phone_cell->ViewAttrs = array(); $members->phone_cell->EditAttrs = array();

		// phone_home
		$members->phone_home->CellCssStyle = ""; $members->phone_home->CellCssClass = "";
		$members->phone_home->CellAttrs = array(); $members->phone_home->ViewAttrs = array(); $members->phone_home->EditAttrs = array();

		// email
		$members->zemail->CellCssStyle = ""; $members->zemail->CellCssClass = "";
		$members->zemail->CellAttrs = array(); $members->zemail->ViewAttrs = array(); $members->zemail->EditAttrs = array();

		// address
		$members->address->CellCssStyle = ""; $members->address->CellCssClass = "";
		$members->address->CellAttrs = array(); $members->address->ViewAttrs = array(); $members->address->EditAttrs = array();

		// city
		$members->city->CellCssStyle = ""; $members->city->CellCssClass = "";
		$members->city->CellAttrs = array(); $members->city->ViewAttrs = array(); $members->city->EditAttrs = array();

		// zip
		$members->zip->CellCssStyle = ""; $members->zip->CellCssClass = "";
		$members->zip->CellAttrs = array(); $members->zip->ViewAttrs = array(); $members->zip->EditAttrs = array();

		// gender
		$members->gender->CellCssStyle = ""; $members->gender->CellCssClass = "";
		$members->gender->CellAttrs = array(); $members->gender->ViewAttrs = array(); $members->gender->EditAttrs = array();

		// status_student
		$members->status_student->CellCssStyle = ""; $members->status_student->CellCssClass = "";
		$members->status_student->CellAttrs = array(); $members->status_student->ViewAttrs = array(); $members->status_student->EditAttrs = array();

		// ethnicity_korean
		$members->ethnicity_korean->CellCssStyle = ""; $members->ethnicity_korean->CellCssClass = "";
		$members->ethnicity_korean->CellAttrs = array(); $members->ethnicity_korean->ViewAttrs = array(); $members->ethnicity_korean->EditAttrs = array();

		// language_korean
		$members->language_korean->CellCssStyle = ""; $members->language_korean->CellCssClass = "";
		$members->language_korean->CellAttrs = array(); $members->language_korean->ViewAttrs = array(); $members->language_korean->EditAttrs = array();

		// access_level
		$members->access_level->CellCssStyle = ""; $members->access_level->CellCssClass = "";
		$members->access_level->CellAttrs = array(); $members->access_level->ViewAttrs = array(); $members->access_level->EditAttrs = array();

		// active_member
		$members->active_member->CellCssStyle = ""; $members->active_member->CellCssClass = "";
		$members->active_member->CellAttrs = array(); $members->active_member->ViewAttrs = array(); $members->active_member->EditAttrs = array();
		if ($members->RowType == EW_ROWTYPE_VIEW) { // View row

			// Id
			$members->Id->ViewValue = $members->Id->CurrentValue;
			$members->Id->CssStyle = "";
			$members->Id->CssClass = "";
			$members->Id->ViewCustomAttributes = "";

			// first_name
			$members->first_name->ViewValue = $members->first_name->CurrentValue;
			$members->first_name->CssStyle = "";
			$members->first_name->CssClass = "";
			$members->first_name->ViewCustomAttributes = "";

			// last_name
			$members->last_name->ViewValue = $members->last_name->CurrentValue;
			$members->last_name->CssStyle = "";
			$members->last_name->CssClass = "";
			$members->last_name->ViewCustomAttributes = "";

			// first_name_eng
			$members->first_name_eng->ViewValue = $members->first_name_eng->CurrentValue;
			$members->first_name_eng->CssStyle = "";
			$members->first_name_eng->CssClass = "";
			$members->first_name_eng->ViewCustomAttributes = "";

			// last_name_eng
			$members->last_name_eng->ViewValue = $members->last_name_eng->CurrentValue;
			$members->last_name_eng->CssStyle = "";
			$members->last_name_eng->CssClass = "";
			$members->last_name_eng->ViewCustomAttributes = "";

			// username
			$members->username->ViewValue = $members->username->CurrentValue;
			$members->username->CssStyle = "";
			$members->username->CssClass = "";
			$members->username->ViewCustomAttributes = "";

			// password
			$members->password->ViewValue = $members->password->CurrentValue;
			$members->password->CssStyle = "";
			$members->password->CssClass = "";
			$members->password->ViewCustomAttributes = "";

			// phone_cell
			$members->phone_cell->ViewValue = $members->phone_cell->CurrentValue;
			$members->phone_cell->CssStyle = "";
			$members->phone_cell->CssClass = "";
			$members->phone_cell->ViewCustomAttributes = "";

			// phone_home
			$members->phone_home->ViewValue = $members->phone_home->CurrentValue;
			$members->phone_home->CssStyle = "";
			$members->phone_home->CssClass = "";
			$members->phone_home->ViewCustomAttributes = "";

			// email
			$members->zemail->ViewValue = $members->zemail->CurrentValue;
			$members->zemail->CssStyle = "";
			$members->zemail->CssClass = "";
			$members->zemail->ViewCustomAttributes = "";

			// address
			$members->address->ViewValue = $members->address->CurrentValue;
			$members->address->CssStyle = "";
			$members->address->CssClass = "";
			$members->address->ViewCustomAttributes = "";

			// city
			$members->city->ViewValue = $members->city->CurrentValue;
			$members->city->CssStyle = "";
			$members->city->CssClass = "";
			$members->city->ViewCustomAttributes = "";

			// zip
			$members->zip->ViewValue = $members->zip->CurrentValue;
			$members->zip->CssStyle = "";
			$members->zip->CssClass = "";
			$members->zip->ViewCustomAttributes = "";

			// gender
			$members->gender->ViewValue = $members->gender->CurrentValue;
			$members->gender->CssStyle = "";
			$members->gender->CssClass = "";
			$members->gender->ViewCustomAttributes = "";

			// status_student
			$members->status_student->ViewValue = $members->status_student->CurrentValue;
			$members->status_student->CssStyle = "";
			$members->status_student->CssClass = "";
			$members->status_student->ViewCustomAttributes = "";

			// ethnicity_korean
			$members->ethnicity_korean->ViewValue = $members->ethnicity_korean->CurrentValue;
			$members->ethnicity_korean->CssStyle = "";
			$members->ethnicity_korean->CssClass = "";
			$members->ethnicity_korean->ViewCustomAttributes = "";

			// language_korean
			$members->language_korean->ViewValue = $members->language_korean->CurrentValue;
			$members->language_korean->CssStyle = "";
			$members->language_korean->CssClass = "";
			$members->language_korean->ViewCustomAttributes = "";

			// access_level
			$members->access_level->ViewValue = $members->access_level->CurrentValue;
			$members->access_level->CssStyle = "";
			$members->access_level->CssClass = "";
			$members->access_level->ViewCustomAttributes = "";

			// active_member
			$members->active_member->ViewValue = $members->active_member->CurrentValue;
			$members->active_member->CssStyle = "";
			$members->active_member->CssClass = "";
			$members->active_member->ViewCustomAttributes = "";

			// Id
			$members->Id->HrefValue = "";
			$members->Id->TooltipValue = "";

			// first_name
			$members->first_name->HrefValue = "";
			$members->first_name->TooltipValue = "";

			// last_name
			$members->last_name->HrefValue = "";
			$members->last_name->TooltipValue = "";

			// first_name_eng
			$members->first_name_eng->HrefValue = "";
			$members->first_name_eng->TooltipValue = "";

			// last_name_eng
			$members->last_name_eng->HrefValue = "";
			$members->last_name_eng->TooltipValue = "";

			// username
			$members->username->HrefValue = "";
			$members->username->TooltipValue = "";

			// password
			$members->password->HrefValue = "";
			$members->password->TooltipValue = "";

			// phone_cell
			$members->phone_cell->HrefValue = "";
			$members->phone_cell->TooltipValue = "";

			// phone_home
			$members->phone_home->HrefValue = "";
			$members->phone_home->TooltipValue = "";

			// email
			$members->zemail->HrefValue = "";
			$members->zemail->TooltipValue = "";

			// address
			$members->address->HrefValue = "";
			$members->address->TooltipValue = "";

			// city
			$members->city->HrefValue = "";
			$members->city->TooltipValue = "";

			// zip
			$members->zip->HrefValue = "";
			$members->zip->TooltipValue = "";

			// gender
			$members->gender->HrefValue = "";
			$members->gender->TooltipValue = "";

			// status_student
			$members->status_student->HrefValue = "";
			$members->status_student->TooltipValue = "";

			// ethnicity_korean
			$members->ethnicity_korean->HrefValue = "";
			$members->ethnicity_korean->TooltipValue = "";

			// language_korean
			$members->language_korean->HrefValue = "";
			$members->language_korean->TooltipValue = "";

			// access_level
			$members->access_level->HrefValue = "";
			$members->access_level->TooltipValue = "";

			// active_member
			$members->active_member->HrefValue = "";
			$members->active_member->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($members->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$members->Row_Rendered();
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
