<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "commentsinfo.php" ?>
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
$comments_list = new ccomments_list();
$Page =& $comments_list;

// Page init
$comments_list->Page_Init();

// Page main
$comments_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($comments->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var comments_list = new ew_Page("comments_list");

// page properties
comments_list.PageID = "list"; // page ID
comments_list.FormID = "fcommentslist"; // form ID
var EW_PAGE_ID = comments_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
comments_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
comments_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comments_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($comments->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$comments_list->lTotalRecs = $comments->SelectRecordCount();
	} else {
		if ($rs = $comments_list->LoadRecordset())
			$comments_list->lTotalRecs = $rs->RecordCount();
	}
	$comments_list->lStartRec = 1;
	if ($comments_list->lDisplayRecs <= 0 || ($comments->Export <> "" && $comments->ExportAll)) // Display all records
		$comments_list->lDisplayRecs = $comments_list->lTotalRecs;
	if (!($comments->Export <> "" && $comments->ExportAll))
		$comments_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $comments_list->LoadRecordset($comments_list->lStartRec-1, $comments_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $comments->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($comments->Export == "" && $comments->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(comments_list);" style="text-decoration: none;"><img id="comments_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="comments_list_SearchPanel">
<form name="fcommentslistsrch" id="fcommentslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="comments">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($comments->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $comments_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($comments->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($comments->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($comments->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$comments_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fcommentslist" id="fcommentslist" class="ewForm" action="" method="post">
<div id="gmp_comments" class="ewGridMiddlePanel">
<?php if ($comments_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $comments->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$comments_list->RenderListOptions();

// Render list options (header, left)
$comments_list->ListOptions->Render("header", "left");
?>
<?php if ($comments->id->Visible) { // id ?>
	<?php if ($comments->SortUrl($comments->id) == "") { ?>
		<td><?php echo $comments->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $comments->SortUrl($comments->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $comments->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($comments->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($comments->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($comments->imgid->Visible) { // imgid ?>
	<?php if ($comments->SortUrl($comments->imgid) == "") { ?>
		<td><?php echo $comments->imgid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $comments->SortUrl($comments->imgid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $comments->imgid->FldCaption() ?></td><td style="width: 10px;"><?php if ($comments->imgid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($comments->imgid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($comments->name2->Visible) { // name2 ?>
	<?php if ($comments->SortUrl($comments->name2) == "") { ?>
		<td><?php echo $comments->name2->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $comments->SortUrl($comments->name2) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $comments->name2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($comments->name2->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($comments->name2->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($comments->date->Visible) { // date ?>
	<?php if ($comments->SortUrl($comments->date) == "") { ?>
		<td><?php echo $comments->date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $comments->SortUrl($comments->date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $comments->date->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($comments->date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($comments->date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($comments->status->Visible) { // status ?>
	<?php if ($comments->SortUrl($comments->status) == "") { ?>
		<td><?php echo $comments->status->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $comments->SortUrl($comments->status) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $comments->status->FldCaption() ?></td><td style="width: 10px;"><?php if ($comments->status->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($comments->status->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$comments_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($comments->ExportAll && $comments->Export <> "") {
	$comments_list->lStopRec = $comments_list->lTotalRecs;
} else {
	$comments_list->lStopRec = $comments_list->lStartRec + $comments_list->lDisplayRecs - 1; // Set the last record to display
}
$comments_list->lRecCount = $comments_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $comments_list->lStartRec > 1)
		$rs->Move($comments_list->lStartRec - 1);
}

// Initialize aggregate
$comments->RowType = EW_ROWTYPE_AGGREGATEINIT;
$comments_list->RenderRow();
$comments_list->lRowCnt = 0;
while (($comments->CurrentAction == "gridadd" || !$rs->EOF) &&
	$comments_list->lRecCount < $comments_list->lStopRec) {
	$comments_list->lRecCount++;
	if (intval($comments_list->lRecCount) >= intval($comments_list->lStartRec)) {
		$comments_list->lRowCnt++;

	// Init row class and style
	$comments->CssClass = "";
	$comments->CssStyle = "";
	$comments->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($comments->CurrentAction == "gridadd") {
		$comments_list->LoadDefaultValues(); // Load default values
	} else {
		$comments_list->LoadRowValues($rs); // Load row values
	}
	$comments->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$comments_list->RenderRow();

	// Render list options
	$comments_list->RenderListOptions();
?>
	<tr<?php echo $comments->RowAttributes() ?>>
<?php

// Render list options (body, left)
$comments_list->ListOptions->Render("body", "left");
?>
	<?php if ($comments->id->Visible) { // id ?>
		<td<?php echo $comments->id->CellAttributes() ?>>
<div<?php echo $comments->id->ViewAttributes() ?>><?php echo $comments->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($comments->imgid->Visible) { // imgid ?>
		<td<?php echo $comments->imgid->CellAttributes() ?>>
<div<?php echo $comments->imgid->ViewAttributes() ?>><?php echo $comments->imgid->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($comments->name2->Visible) { // name2 ?>
		<td<?php echo $comments->name2->CellAttributes() ?>>
<div<?php echo $comments->name2->ViewAttributes() ?>><?php echo $comments->name2->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($comments->date->Visible) { // date ?>
		<td<?php echo $comments->date->CellAttributes() ?>>
<div<?php echo $comments->date->ViewAttributes() ?>><?php echo $comments->date->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($comments->status->Visible) { // status ?>
		<td<?php echo $comments->status->CellAttributes() ?>>
<div<?php echo $comments->status->ViewAttributes() ?>><?php echo $comments->status->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$comments_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($comments->CurrentAction <> "gridadd")
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
<?php if ($comments->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($comments->CurrentAction <> "gridadd" && $comments->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($comments_list->Pager)) $comments_list->Pager = new cPrevNextPager($comments_list->lStartRec, $comments_list->lDisplayRecs, $comments_list->lTotalRecs) ?>
<?php if ($comments_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($comments_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $comments_list->PageUrl() ?>start=<?php echo $comments_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($comments_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $comments_list->PageUrl() ?>start=<?php echo $comments_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $comments_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($comments_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $comments_list->PageUrl() ?>start=<?php echo $comments_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($comments_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $comments_list->PageUrl() ?>start=<?php echo $comments_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $comments_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $comments_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $comments_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $comments_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($comments_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($comments_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $comments_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($comments->Export == "" && $comments->CurrentAction == "") { ?>
<?php } ?>
<?php if ($comments->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$comments_list->Page_Terminate();
?>
<?php

//
// Page class
//
class ccomments_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'comments';

	// Page object name
	var $PageObjName = 'comments_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $comments;
		if ($comments->UseTokenInUrl) $PageUrl .= "t=" . $comments->TableVar . "&"; // Add page token
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
		global $objForm, $comments;
		if ($comments->UseTokenInUrl) {
			if ($objForm)
				return ($comments->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($comments->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccomments_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (comments)
		$GLOBALS["comments"] = new ccomments();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["comments"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "commentsdelete.php";
		$this->MultiUpdateUrl = "commentsupdate.php";

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'comments', TRUE);

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
		global $comments;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$comments->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$comments->Export = $_POST["exporttype"];
		} else {
			$comments->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $comments->Export; // Get export parameter, used in header
		$gsExportFile = $comments->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $comments;

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
			$comments->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($comments->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $comments->getRecordsPerPage(); // Restore from Session
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
		$comments->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$comments->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$comments->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $comments->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$comments->setSessionWhere($sFilter);
		$comments->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $comments;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $comments->name2, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $comments->comment2, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $comments->date, $Keyword);
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
		global $Security, $comments;
		$sSearchStr = "";
		$sSearchKeyword = $comments->BasicSearchKeyword;
		$sSearchType = $comments->BasicSearchType;
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
			$comments->setSessionBasicSearchKeyword($sSearchKeyword);
			$comments->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $comments;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$comments->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $comments;
		$comments->setSessionBasicSearchKeyword("");
		$comments->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $comments;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$comments->BasicSearchKeyword = $comments->getSessionBasicSearchKeyword();
			$comments->BasicSearchType = $comments->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $comments;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$comments->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$comments->CurrentOrderType = @$_GET["ordertype"];
			$comments->UpdateSort($comments->id); // id
			$comments->UpdateSort($comments->imgid); // imgid
			$comments->UpdateSort($comments->name2); // name2
			$comments->UpdateSort($comments->date); // date
			$comments->UpdateSort($comments->status); // status
			$comments->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $comments;
		$sOrderBy = $comments->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($comments->SqlOrderBy() <> "") {
				$sOrderBy = $comments->SqlOrderBy();
				$comments->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $comments;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$comments->setSessionOrderBy($sOrderBy);
				$comments->id->setSort("");
				$comments->imgid->setSort("");
				$comments->name2->setSort("");
				$comments->date->setSort("");
				$comments->status->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$comments->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $comments;

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
		if ($comments->Export <> "" ||
			$comments->CurrentAction == "gridadd" ||
			$comments->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $comments;
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
		global $Security, $Language, $comments;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $comments;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$comments->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$comments->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $comments->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$comments->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$comments->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$comments->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $comments;
		$comments->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$comments->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $comments;

		// Call Recordset Selecting event
		$comments->Recordset_Selecting($comments->CurrentFilter);

		// Load List page SQL
		$sSql = $comments->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$comments->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $comments;
		$sFilter = $comments->KeyFilter();

		// Call Row Selecting event
		$comments->Row_Selecting($sFilter);

		// Load SQL based on filter
		$comments->CurrentFilter = $sFilter;
		$sSql = $comments->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$comments->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $comments;
		$comments->id->setDbValue($rs->fields('id'));
		$comments->imgid->setDbValue($rs->fields('imgid'));
		$comments->name2->setDbValue($rs->fields('name2'));
		$comments->comment2->setDbValue($rs->fields('comment2'));
		$comments->date->setDbValue($rs->fields('date'));
		$comments->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $comments;

		// Initialize URLs
		$this->ViewUrl = $comments->ViewUrl();
		$this->EditUrl = $comments->EditUrl();
		$this->InlineEditUrl = $comments->InlineEditUrl();
		$this->CopyUrl = $comments->CopyUrl();
		$this->InlineCopyUrl = $comments->InlineCopyUrl();
		$this->DeleteUrl = $comments->DeleteUrl();

		// Call Row_Rendering event
		$comments->Row_Rendering();

		// Common render codes for all row types
		// id

		$comments->id->CellCssStyle = ""; $comments->id->CellCssClass = "";
		$comments->id->CellAttrs = array(); $comments->id->ViewAttrs = array(); $comments->id->EditAttrs = array();

		// imgid
		$comments->imgid->CellCssStyle = ""; $comments->imgid->CellCssClass = "";
		$comments->imgid->CellAttrs = array(); $comments->imgid->ViewAttrs = array(); $comments->imgid->EditAttrs = array();

		// name2
		$comments->name2->CellCssStyle = ""; $comments->name2->CellCssClass = "";
		$comments->name2->CellAttrs = array(); $comments->name2->ViewAttrs = array(); $comments->name2->EditAttrs = array();

		// date
		$comments->date->CellCssStyle = ""; $comments->date->CellCssClass = "";
		$comments->date->CellAttrs = array(); $comments->date->ViewAttrs = array(); $comments->date->EditAttrs = array();

		// status
		$comments->status->CellCssStyle = ""; $comments->status->CellCssClass = "";
		$comments->status->CellAttrs = array(); $comments->status->ViewAttrs = array(); $comments->status->EditAttrs = array();
		if ($comments->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$comments->id->ViewValue = $comments->id->CurrentValue;
			$comments->id->CssStyle = "";
			$comments->id->CssClass = "";
			$comments->id->ViewCustomAttributes = "";

			// imgid
			$comments->imgid->ViewValue = $comments->imgid->CurrentValue;
			$comments->imgid->CssStyle = "";
			$comments->imgid->CssClass = "";
			$comments->imgid->ViewCustomAttributes = "";

			// name2
			$comments->name2->ViewValue = $comments->name2->CurrentValue;
			$comments->name2->CssStyle = "";
			$comments->name2->CssClass = "";
			$comments->name2->ViewCustomAttributes = "";

			// date
			$comments->date->ViewValue = $comments->date->CurrentValue;
			$comments->date->CssStyle = "";
			$comments->date->CssClass = "";
			$comments->date->ViewCustomAttributes = "";

			// status
			$comments->status->ViewValue = $comments->status->CurrentValue;
			$comments->status->CssStyle = "";
			$comments->status->CssClass = "";
			$comments->status->ViewCustomAttributes = "";

			// id
			$comments->id->HrefValue = "";
			$comments->id->TooltipValue = "";

			// imgid
			$comments->imgid->HrefValue = "";
			$comments->imgid->TooltipValue = "";

			// name2
			$comments->name2->HrefValue = "";
			$comments->name2->TooltipValue = "";

			// date
			$comments->date->HrefValue = "";
			$comments->date->TooltipValue = "";

			// status
			$comments->status->HrefValue = "";
			$comments->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($comments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$comments->Row_Rendered();
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
