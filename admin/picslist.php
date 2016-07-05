<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "picsinfo.php" ?>
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
$pics_list = new cpics_list();
$Page =& $pics_list;

// Page init
$pics_list->Page_Init();

// Page main
$pics_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($pics->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pics_list = new ew_Page("pics_list");

// page properties
pics_list.PageID = "list"; // page ID
pics_list.FormID = "fpicslist"; // form ID
var EW_PAGE_ID = pics_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pics_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pics_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pics_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($pics->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$pics_list->lTotalRecs = $pics->SelectRecordCount();
	} else {
		if ($rs = $pics_list->LoadRecordset())
			$pics_list->lTotalRecs = $rs->RecordCount();
	}
	$pics_list->lStartRec = 1;
	if ($pics_list->lDisplayRecs <= 0 || ($pics->Export <> "" && $pics->ExportAll)) // Display all records
		$pics_list->lDisplayRecs = $pics_list->lTotalRecs;
	if (!($pics->Export <> "" && $pics->ExportAll))
		$pics_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $pics_list->LoadRecordset($pics_list->lStartRec-1, $pics_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pics->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($pics->Export == "" && $pics->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(pics_list);" style="text-decoration: none;"><img id="pics_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="pics_list_SearchPanel">
<form name="fpicslistsrch" id="fpicslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="pics">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($pics->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $pics_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($pics->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($pics->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($pics->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$pics_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fpicslist" id="fpicslist" class="ewForm" action="" method="post">
<div id="gmp_pics" class="ewGridMiddlePanel">
<?php if ($pics_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $pics->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$pics_list->RenderListOptions();

// Render list options (header, left)
$pics_list->ListOptions->Render("header", "left");
?>
<?php if ($pics->id->Visible) { // id ?>
	<?php if ($pics->SortUrl($pics->id) == "") { ?>
		<td><?php echo $pics->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pics->SortUrl($pics->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pics->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($pics->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pics->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pics->img->Visible) { // img ?>
	<?php if ($pics->SortUrl($pics->img) == "") { ?>
		<td><?php echo $pics->img->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pics->SortUrl($pics->img) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pics->img->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($pics->img->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pics->img->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pics->width_big->Visible) { // width_big ?>
	<?php if ($pics->SortUrl($pics->width_big) == "") { ?>
		<td><?php echo $pics->width_big->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pics->SortUrl($pics->width_big) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pics->width_big->FldCaption() ?></td><td style="width: 10px;"><?php if ($pics->width_big->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pics->width_big->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pics->height_big->Visible) { // height_big ?>
	<?php if ($pics->SortUrl($pics->height_big) == "") { ?>
		<td><?php echo $pics->height_big->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pics->SortUrl($pics->height_big) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pics->height_big->FldCaption() ?></td><td style="width: 10px;"><?php if ($pics->height_big->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pics->height_big->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pics->width_small->Visible) { // width_small ?>
	<?php if ($pics->SortUrl($pics->width_small) == "") { ?>
		<td><?php echo $pics->width_small->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pics->SortUrl($pics->width_small) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pics->width_small->FldCaption() ?></td><td style="width: 10px;"><?php if ($pics->width_small->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pics->width_small->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pics->height_small->Visible) { // height_small ?>
	<?php if ($pics->SortUrl($pics->height_small) == "") { ?>
		<td><?php echo $pics->height_small->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pics->SortUrl($pics->height_small) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pics->height_small->FldCaption() ?></td><td style="width: 10px;"><?php if ($pics->height_small->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pics->height_small->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pics->hits->Visible) { // hits ?>
	<?php if ($pics->SortUrl($pics->hits) == "") { ?>
		<td><?php echo $pics->hits->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pics->SortUrl($pics->hits) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pics->hits->FldCaption() ?></td><td style="width: 10px;"><?php if ($pics->hits->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pics->hits->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($pics->date_uploaded->Visible) { // date_uploaded ?>
	<?php if ($pics->SortUrl($pics->date_uploaded) == "") { ?>
		<td><?php echo $pics->date_uploaded->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $pics->SortUrl($pics->date_uploaded) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $pics->date_uploaded->FldCaption() ?></td><td style="width: 10px;"><?php if ($pics->date_uploaded->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($pics->date_uploaded->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$pics_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($pics->ExportAll && $pics->Export <> "") {
	$pics_list->lStopRec = $pics_list->lTotalRecs;
} else {
	$pics_list->lStopRec = $pics_list->lStartRec + $pics_list->lDisplayRecs - 1; // Set the last record to display
}
$pics_list->lRecCount = $pics_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $pics_list->lStartRec > 1)
		$rs->Move($pics_list->lStartRec - 1);
}

// Initialize aggregate
$pics->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pics_list->RenderRow();
$pics_list->lRowCnt = 0;
while (($pics->CurrentAction == "gridadd" || !$rs->EOF) &&
	$pics_list->lRecCount < $pics_list->lStopRec) {
	$pics_list->lRecCount++;
	if (intval($pics_list->lRecCount) >= intval($pics_list->lStartRec)) {
		$pics_list->lRowCnt++;

	// Init row class and style
	$pics->CssClass = "";
	$pics->CssStyle = "";
	$pics->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($pics->CurrentAction == "gridadd") {
		$pics_list->LoadDefaultValues(); // Load default values
	} else {
		$pics_list->LoadRowValues($rs); // Load row values
	}
	$pics->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$pics_list->RenderRow();

	// Render list options
	$pics_list->RenderListOptions();
?>
	<tr<?php echo $pics->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pics_list->ListOptions->Render("body", "left");
?>
	<?php if ($pics->id->Visible) { // id ?>
		<td<?php echo $pics->id->CellAttributes() ?>>
<div<?php echo $pics->id->ViewAttributes() ?>><?php echo $pics->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pics->img->Visible) { // img ?>
		<td<?php echo $pics->img->CellAttributes() ?>>
<div<?php echo $pics->img->ViewAttributes() ?>><?php echo $pics->img->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pics->width_big->Visible) { // width_big ?>
		<td<?php echo $pics->width_big->CellAttributes() ?>>
<div<?php echo $pics->width_big->ViewAttributes() ?>><?php echo $pics->width_big->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pics->height_big->Visible) { // height_big ?>
		<td<?php echo $pics->height_big->CellAttributes() ?>>
<div<?php echo $pics->height_big->ViewAttributes() ?>><?php echo $pics->height_big->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pics->width_small->Visible) { // width_small ?>
		<td<?php echo $pics->width_small->CellAttributes() ?>>
<div<?php echo $pics->width_small->ViewAttributes() ?>><?php echo $pics->width_small->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pics->height_small->Visible) { // height_small ?>
		<td<?php echo $pics->height_small->CellAttributes() ?>>
<div<?php echo $pics->height_small->ViewAttributes() ?>><?php echo $pics->height_small->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pics->hits->Visible) { // hits ?>
		<td<?php echo $pics->hits->CellAttributes() ?>>
<div<?php echo $pics->hits->ViewAttributes() ?>><?php echo $pics->hits->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($pics->date_uploaded->Visible) { // date_uploaded ?>
		<td<?php echo $pics->date_uploaded->CellAttributes() ?>>
<div<?php echo $pics->date_uploaded->ViewAttributes() ?>><?php echo $pics->date_uploaded->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pics_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($pics->CurrentAction <> "gridadd")
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
<?php if ($pics->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($pics->CurrentAction <> "gridadd" && $pics->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($pics_list->Pager)) $pics_list->Pager = new cPrevNextPager($pics_list->lStartRec, $pics_list->lDisplayRecs, $pics_list->lTotalRecs) ?>
<?php if ($pics_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($pics_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $pics_list->PageUrl() ?>start=<?php echo $pics_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($pics_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $pics_list->PageUrl() ?>start=<?php echo $pics_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $pics_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($pics_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $pics_list->PageUrl() ?>start=<?php echo $pics_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($pics_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $pics_list->PageUrl() ?>start=<?php echo $pics_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $pics_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pics_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pics_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pics_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($pics_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($pics_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pics_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($pics->Export == "" && $pics->CurrentAction == "") { ?>
<?php } ?>
<?php if ($pics->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$pics_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cpics_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'pics';

	// Page object name
	var $PageObjName = 'pics_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $pics;
		if ($pics->UseTokenInUrl) $PageUrl .= "t=" . $pics->TableVar . "&"; // Add page token
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
		global $objForm, $pics;
		if ($pics->UseTokenInUrl) {
			if ($objForm)
				return ($pics->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($pics->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cpics_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (pics)
		$GLOBALS["pics"] = new cpics();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["pics"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "picsdelete.php";
		$this->MultiUpdateUrl = "picsupdate.php";

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pics', TRUE);

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
		global $pics;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$pics->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$pics->Export = $_POST["exporttype"];
		} else {
			$pics->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $pics->Export; // Get export parameter, used in header
		$gsExportFile = $pics->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $pics;

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
			$pics->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($pics->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $pics->getRecordsPerPage(); // Restore from Session
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
		$pics->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$pics->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$pics->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $pics->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$pics->setSessionWhere($sFilter);
		$pics->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $pics;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $pics->caption, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pics->descc, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $pics->img, $Keyword);
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
		global $Security, $pics;
		$sSearchStr = "";
		$sSearchKeyword = $pics->BasicSearchKeyword;
		$sSearchType = $pics->BasicSearchType;
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
			$pics->setSessionBasicSearchKeyword($sSearchKeyword);
			$pics->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $pics;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$pics->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $pics;
		$pics->setSessionBasicSearchKeyword("");
		$pics->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $pics;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$pics->BasicSearchKeyword = $pics->getSessionBasicSearchKeyword();
			$pics->BasicSearchType = $pics->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $pics;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$pics->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$pics->CurrentOrderType = @$_GET["ordertype"];
			$pics->UpdateSort($pics->id); // id
			$pics->UpdateSort($pics->img); // img
			$pics->UpdateSort($pics->width_big); // width_big
			$pics->UpdateSort($pics->height_big); // height_big
			$pics->UpdateSort($pics->width_small); // width_small
			$pics->UpdateSort($pics->height_small); // height_small
			$pics->UpdateSort($pics->hits); // hits
			$pics->UpdateSort($pics->date_uploaded); // date_uploaded
			$pics->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $pics;
		$sOrderBy = $pics->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($pics->SqlOrderBy() <> "") {
				$sOrderBy = $pics->SqlOrderBy();
				$pics->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $pics;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$pics->setSessionOrderBy($sOrderBy);
				$pics->id->setSort("");
				$pics->img->setSort("");
				$pics->width_big->setSort("");
				$pics->height_big->setSort("");
				$pics->width_small->setSort("");
				$pics->height_small->setSort("");
				$pics->hits->setSort("");
				$pics->date_uploaded->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$pics->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $pics;

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
		if ($pics->Export <> "" ||
			$pics->CurrentAction == "gridadd" ||
			$pics->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $pics;
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
		global $Security, $Language, $pics;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $pics;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$pics->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$pics->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $pics->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$pics->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$pics->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$pics->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $pics;
		$pics->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$pics->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pics;

		// Call Recordset Selecting event
		$pics->Recordset_Selecting($pics->CurrentFilter);

		// Load List page SQL
		$sSql = $pics->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pics->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $pics;
		$sFilter = $pics->KeyFilter();

		// Call Row Selecting event
		$pics->Row_Selecting($sFilter);

		// Load SQL based on filter
		$pics->CurrentFilter = $sFilter;
		$sSql = $pics->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$pics->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $pics;
		$pics->id->setDbValue($rs->fields('id'));
		$pics->caption->setDbValue($rs->fields('caption'));
		$pics->descc->setDbValue($rs->fields('descc'));
		$pics->img->setDbValue($rs->fields('img'));
		$pics->width_big->setDbValue($rs->fields('width_big'));
		$pics->height_big->setDbValue($rs->fields('height_big'));
		$pics->width_small->setDbValue($rs->fields('width_small'));
		$pics->height_small->setDbValue($rs->fields('height_small'));
		$pics->hits->setDbValue($rs->fields('hits'));
		$pics->date_uploaded->setDbValue($rs->fields('date_uploaded'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $pics;

		// Initialize URLs
		$this->ViewUrl = $pics->ViewUrl();
		$this->EditUrl = $pics->EditUrl();
		$this->InlineEditUrl = $pics->InlineEditUrl();
		$this->CopyUrl = $pics->CopyUrl();
		$this->InlineCopyUrl = $pics->InlineCopyUrl();
		$this->DeleteUrl = $pics->DeleteUrl();

		// Call Row_Rendering event
		$pics->Row_Rendering();

		// Common render codes for all row types
		// id

		$pics->id->CellCssStyle = ""; $pics->id->CellCssClass = "";
		$pics->id->CellAttrs = array(); $pics->id->ViewAttrs = array(); $pics->id->EditAttrs = array();

		// img
		$pics->img->CellCssStyle = ""; $pics->img->CellCssClass = "";
		$pics->img->CellAttrs = array(); $pics->img->ViewAttrs = array(); $pics->img->EditAttrs = array();

		// width_big
		$pics->width_big->CellCssStyle = ""; $pics->width_big->CellCssClass = "";
		$pics->width_big->CellAttrs = array(); $pics->width_big->ViewAttrs = array(); $pics->width_big->EditAttrs = array();

		// height_big
		$pics->height_big->CellCssStyle = ""; $pics->height_big->CellCssClass = "";
		$pics->height_big->CellAttrs = array(); $pics->height_big->ViewAttrs = array(); $pics->height_big->EditAttrs = array();

		// width_small
		$pics->width_small->CellCssStyle = ""; $pics->width_small->CellCssClass = "";
		$pics->width_small->CellAttrs = array(); $pics->width_small->ViewAttrs = array(); $pics->width_small->EditAttrs = array();

		// height_small
		$pics->height_small->CellCssStyle = ""; $pics->height_small->CellCssClass = "";
		$pics->height_small->CellAttrs = array(); $pics->height_small->ViewAttrs = array(); $pics->height_small->EditAttrs = array();

		// hits
		$pics->hits->CellCssStyle = ""; $pics->hits->CellCssClass = "";
		$pics->hits->CellAttrs = array(); $pics->hits->ViewAttrs = array(); $pics->hits->EditAttrs = array();

		// date_uploaded
		$pics->date_uploaded->CellCssStyle = ""; $pics->date_uploaded->CellCssClass = "";
		$pics->date_uploaded->CellAttrs = array(); $pics->date_uploaded->ViewAttrs = array(); $pics->date_uploaded->EditAttrs = array();
		if ($pics->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$pics->id->ViewValue = $pics->id->CurrentValue;
			$pics->id->CssStyle = "";
			$pics->id->CssClass = "";
			$pics->id->ViewCustomAttributes = "";

			// img
			$pics->img->ViewValue = $pics->img->CurrentValue;
			$pics->img->CssStyle = "";
			$pics->img->CssClass = "";
			$pics->img->ViewCustomAttributes = "";

			// width_big
			$pics->width_big->ViewValue = $pics->width_big->CurrentValue;
			$pics->width_big->CssStyle = "";
			$pics->width_big->CssClass = "";
			$pics->width_big->ViewCustomAttributes = "";

			// height_big
			$pics->height_big->ViewValue = $pics->height_big->CurrentValue;
			$pics->height_big->CssStyle = "";
			$pics->height_big->CssClass = "";
			$pics->height_big->ViewCustomAttributes = "";

			// width_small
			$pics->width_small->ViewValue = $pics->width_small->CurrentValue;
			$pics->width_small->CssStyle = "";
			$pics->width_small->CssClass = "";
			$pics->width_small->ViewCustomAttributes = "";

			// height_small
			$pics->height_small->ViewValue = $pics->height_small->CurrentValue;
			$pics->height_small->CssStyle = "";
			$pics->height_small->CssClass = "";
			$pics->height_small->ViewCustomAttributes = "";

			// hits
			$pics->hits->ViewValue = $pics->hits->CurrentValue;
			$pics->hits->CssStyle = "";
			$pics->hits->CssClass = "";
			$pics->hits->ViewCustomAttributes = "";

			// date_uploaded
			$pics->date_uploaded->ViewValue = $pics->date_uploaded->CurrentValue;
			$pics->date_uploaded->ViewValue = ew_FormatDateTime($pics->date_uploaded->ViewValue, 6);
			$pics->date_uploaded->CssStyle = "";
			$pics->date_uploaded->CssClass = "";
			$pics->date_uploaded->ViewCustomAttributes = "";

			// id
			$pics->id->HrefValue = "";
			$pics->id->TooltipValue = "";

			// img
			$pics->img->HrefValue = "";
			$pics->img->TooltipValue = "";

			// width_big
			$pics->width_big->HrefValue = "";
			$pics->width_big->TooltipValue = "";

			// height_big
			$pics->height_big->HrefValue = "";
			$pics->height_big->TooltipValue = "";

			// width_small
			$pics->width_small->HrefValue = "";
			$pics->width_small->TooltipValue = "";

			// height_small
			$pics->height_small->HrefValue = "";
			$pics->height_small->TooltipValue = "";

			// hits
			$pics->hits->HrefValue = "";
			$pics->hits->TooltipValue = "";

			// date_uploaded
			$pics->date_uploaded->HrefValue = "";
			$pics->date_uploaded->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($pics->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pics->Row_Rendered();
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
