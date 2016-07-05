<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "announcementinfo.php" ?>
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
$announcement_list = new cannouncement_list();
$Page =& $announcement_list;

// Page init
$announcement_list->Page_Init();

// Page main
$announcement_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($announcement->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var announcement_list = new ew_Page("announcement_list");

// page properties
announcement_list.PageID = "list"; // page ID
announcement_list.FormID = "fannouncementlist"; // form ID
var EW_PAGE_ID = announcement_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
announcement_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
announcement_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
announcement_list.ValidateRequired = false; // no JavaScript validation
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
<?php if ($announcement->Export == "") { ?>
<?php } ?>
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
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $announcement->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($announcement->Export == "" && $announcement->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(announcement_list);" style="text-decoration: none;"><img id="announcement_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="announcement_list_SearchPanel">
<form name="fannouncementlistsrch" id="fannouncementlistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="announcement">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($announcement->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $announcement_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($announcement->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($announcement->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($announcement->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$announcement_list->ShowMessage();
?>
<br>
<!-- ADD LINK -->
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $announcement_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>

<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fannouncementlist" id="fannouncementlist" class="ewForm" action="" method="post">
<div id="gmp_announcement" class="ewGridMiddlePanel">
<?php if ($announcement_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $announcement->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$announcement_list->RenderListOptions();

// Render list options (header, left)
$announcement_list->ListOptions->Render("header", "left");
?>
<?php if ($announcement->id->Visible) { // id ?>
	<?php if ($announcement->SortUrl($announcement->id) == "") { ?>
		<td><?php echo $announcement->id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $announcement->SortUrl($announcement->id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $announcement->id->FldCaption() ?></td><td style="width: 10px;"><?php if ($announcement->id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($announcement->id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($announcement->lid->Visible) { // lid ?>
	<?php if ($announcement->SortUrl($announcement->lid) == "") { ?>
		<td><?php echo $announcement->lid->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $announcement->SortUrl($announcement->lid) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $announcement->lid->FldCaption() ?></td><td style="width: 10px;"><?php if ($announcement->lid->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($announcement->lid->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($announcement->title->Visible) { // title ?>
	<?php if ($announcement->SortUrl($announcement->title) == "") { ?>
		<td><?php echo $announcement->title->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $announcement->SortUrl($announcement->title) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $announcement->title->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($announcement->title->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($announcement->title->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($announcement->active->Visible) { // active ?>
	<?php if ($announcement->SortUrl($announcement->active) == "") { ?>
		<td><?php echo $announcement->active->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $announcement->SortUrl($announcement->active) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $announcement->active->FldCaption() ?></td><td style="width: 10px;"><?php if ($announcement->active->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($announcement->active->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($announcement->koreantennis->Visible) { // koreantennis ?>
	<?php if ($announcement->SortUrl($announcement->koreantennis) == "") { ?>
		<td><?php echo $announcement->koreantennis->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $announcement->SortUrl($announcement->koreantennis) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $announcement->koreantennis->FldCaption() ?></td><td style="width: 10px;"><?php if ($announcement->koreantennis->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($announcement->koreantennis->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($announcement->timestamp->Visible) { // timestamp ?>
	<?php if ($announcement->SortUrl($announcement->timestamp) == "") { ?>
		<td><?php echo $announcement->timestamp->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $announcement->SortUrl($announcement->timestamp) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $announcement->timestamp->FldCaption() ?></td><td style="width: 10px;"><?php if ($announcement->timestamp->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($announcement->timestamp->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$announcement_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
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
	<tr<?php echo $announcement->RowAttributes() ?>>
<?php

// Render list options (body, left)
$announcement_list->ListOptions->Render("body", "left");
?>
	<?php if ($announcement->id->Visible) { // id ?>
		<td<?php echo $announcement->id->CellAttributes() ?>>
<div<?php echo $announcement->id->ViewAttributes() ?>><?php echo $announcement->id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($announcement->lid->Visible) { // lid ?>
		<td<?php echo $announcement->lid->CellAttributes() ?>>
<div<?php echo $announcement->lid->ViewAttributes() ?>><?php if ($announcement->lid->ListViewValue() == 21) { echo "ENG"; } else { echo "KOR"; } ?></div>
</td>
	<?php } ?>
	<?php if ($announcement->title->Visible) { // title ?>
		<td<?php echo $announcement->title->CellAttributes() ?>>
<div<?php echo $announcement->title->ViewAttributes() ?>><?php echo $announcement->title->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($announcement->active->Visible) { // active ?>
		<td<?php echo $announcement->active->CellAttributes() ?>>
<div<?php echo $announcement->active->ViewAttributes() ?>><?php echo $announcement->active->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($announcement->koreantennis->Visible) { // koreantennis ?>
		<td<?php echo $announcement->koreantennis->CellAttributes() ?>>
<div<?php echo $announcement->koreantennis->ViewAttributes() ?>><?php echo $announcement->koreantennis->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($announcement->timestamp->Visible) { // timestamp ?>
		<td<?php echo $announcement->timestamp->CellAttributes() ?>>
<div<?php echo $announcement->timestamp->ViewAttributes() ?>><?php echo $announcement->timestamp->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$announcement_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($announcement->CurrentAction <> "gridadd")
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
<?php if ($announcement->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($announcement->CurrentAction <> "gridadd" && $announcement->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($announcement_list->Pager)) $announcement_list->Pager = new cPrevNextPager($announcement_list->lStartRec, $announcement_list->lDisplayRecs, $announcement_list->lTotalRecs) ?>
<?php if ($announcement_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($announcement_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $announcement_list->PageUrl() ?>start=<?php echo $announcement_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($announcement_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $announcement_list->PageUrl() ?>start=<?php echo $announcement_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $announcement_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($announcement_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $announcement_list->PageUrl() ?>start=<?php echo $announcement_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($announcement_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $announcement_list->PageUrl() ?>start=<?php echo $announcement_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $announcement_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $announcement_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $announcement_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $announcement_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($announcement_list->sSrchWhere == "0=101") { ?>
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
<?php //if ($announcement_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $announcement_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($announcement->Export == "" && $announcement->CurrentAction == "") { ?>
<?php } ?>
<?php if ($announcement->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$announcement_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cannouncement_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'announcement';

	// Page object name
	var $PageObjName = 'announcement_list';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $announcement;
		if ($announcement->UseTokenInUrl) $PageUrl .= "t=" . $announcement->TableVar . "&"; // Add page token
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
		global $objForm, $announcement;
		if ($announcement->UseTokenInUrl) {
			if ($objForm)
				return ($announcement->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($announcement->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cannouncement_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (announcement)
		$GLOBALS["announcement"] = new cannouncement();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["announcement"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "announcementdelete.php";
		$this->MultiUpdateUrl = "announcementupdate.php";

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'announcement', TRUE);

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
		global $announcement;

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if (!$Security->IsLoggedIn()) {
			$Security->SaveLastUrl();
			$this->Page_Terminate("login.php");
		}

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$announcement->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$announcement->Export = $_POST["exporttype"];
		} else {
			$announcement->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $announcement->Export; // Get export parameter, used in header
		$gsExportFile = $announcement->TableVar; // Get export file, used in header

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
		global $objForm, $Language, $gsSearchError, $Security, $announcement;

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
			$announcement->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($announcement->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $announcement->getRecordsPerPage(); // Restore from Session
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
		$announcement->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$announcement->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$announcement->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $announcement->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$announcement->setSessionWhere($sFilter);
		$announcement->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $announcement;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $announcement->title, $Keyword);
		$this->BuildBasicSearchSQL($sWhere, $announcement->announcement_1, $Keyword);
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
		global $Security, $announcement;
		$sSearchStr = "";
		$sSearchKeyword = $announcement->BasicSearchKeyword;
		$sSearchType = $announcement->BasicSearchType;
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
			$announcement->setSessionBasicSearchKeyword($sSearchKeyword);
			$announcement->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $announcement;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$announcement->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $announcement;
		$announcement->setSessionBasicSearchKeyword("");
		$announcement->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $announcement;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$announcement->BasicSearchKeyword = $announcement->getSessionBasicSearchKeyword();
			$announcement->BasicSearchType = $announcement->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $announcement;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$announcement->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$announcement->CurrentOrderType = @$_GET["ordertype"];
			$announcement->UpdateSort($announcement->id); // id
			$announcement->UpdateSort($announcement->lid); // lid
			$announcement->UpdateSort($announcement->title); // title
			$announcement->UpdateSort($announcement->active); // active
			$announcement->UpdateSort($announcement->koreantennis); // koreantennis
			$announcement->UpdateSort($announcement->timestamp); // timestamp
			$announcement->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $announcement;
		$sOrderBy = $announcement->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($announcement->SqlOrderBy() <> "") {
				$sOrderBy = $announcement->SqlOrderBy();
				$announcement->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $announcement;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$announcement->setSessionOrderBy($sOrderBy);
				$announcement->id->setSort("");
				$announcement->lid->setSort("");
				$announcement->title->setSort("");
				$announcement->active->setSort("");
				$announcement->koreantennis->setSort("");
				$announcement->timestamp->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$announcement->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $announcement;

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
		if ($announcement->Export <> "" ||
			$announcement->CurrentAction == "gridadd" ||
			$announcement->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $announcement;
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
		global $Security, $Language, $announcement;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $announcement;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$announcement->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$announcement->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $announcement->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$announcement->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$announcement->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$announcement->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $announcement;
		$announcement->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$announcement->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $announcement;

		// Call Recordset Selecting event
		$announcement->Recordset_Selecting($announcement->CurrentFilter);

		// Load List page SQL
		$sSql = $announcement->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$announcement->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $announcement;
		$sFilter = $announcement->KeyFilter();

		// Call Row Selecting event
		$announcement->Row_Selecting($sFilter);

		// Load SQL based on filter
		$announcement->CurrentFilter = $sFilter;
		$sSql = $announcement->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$announcement->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $announcement;
		$announcement->id->setDbValue($rs->fields('id'));
		$announcement->lid->setDbValue($rs->fields('lid'));
		$announcement->title->setDbValue($rs->fields('title'));
		$announcement->announcement_1->setDbValue($rs->fields('announcement'));
		$announcement->active->setDbValue($rs->fields('active'));
		$announcement->koreantennis->setDbValue($rs->fields('koreantennis'));
		$announcement->timestamp->setDbValue($rs->fields('timestamp'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $announcement;

		// Initialize URLs
		$this->ViewUrl = $announcement->ViewUrl();
		$this->EditUrl = $announcement->EditUrl();
		$this->InlineEditUrl = $announcement->InlineEditUrl();
		$this->CopyUrl = $announcement->CopyUrl();
		$this->InlineCopyUrl = $announcement->InlineCopyUrl();
		$this->DeleteUrl = $announcement->DeleteUrl();

		// Call Row_Rendering event
		$announcement->Row_Rendering();

		// Common render codes for all row types
		// id

		$announcement->id->CellCssStyle = ""; $announcement->id->CellCssClass = "";
		$announcement->id->CellAttrs = array(); $announcement->id->ViewAttrs = array(); $announcement->id->EditAttrs = array();

		// lid
		$announcement->lid->CellCssStyle = ""; $announcement->lid->CellCssClass = "";
		$announcement->lid->CellAttrs = array(); $announcement->lid->ViewAttrs = array(); $announcement->lid->EditAttrs = array();

		// title
		$announcement->title->CellCssStyle = ""; $announcement->title->CellCssClass = "";
		$announcement->title->CellAttrs = array(); $announcement->title->ViewAttrs = array(); $announcement->title->EditAttrs = array();

		// active
		$announcement->active->CellCssStyle = ""; $announcement->active->CellCssClass = "";
		$announcement->active->CellAttrs = array(); $announcement->active->ViewAttrs = array(); $announcement->active->EditAttrs = array();

		// koreantennis
		$announcement->koreantennis->CellCssStyle = ""; $announcement->koreantennis->CellCssClass = "";
		$announcement->koreantennis->CellAttrs = array(); $announcement->koreantennis->ViewAttrs = array(); $announcement->koreantennis->EditAttrs = array();

		// timestamp
		$announcement->timestamp->CellCssStyle = ""; $announcement->timestamp->CellCssClass = "";
		$announcement->timestamp->CellAttrs = array(); $announcement->timestamp->ViewAttrs = array(); $announcement->timestamp->EditAttrs = array();
		if ($announcement->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$announcement->id->ViewValue = $announcement->id->CurrentValue;
			$announcement->id->CssStyle = "";
			$announcement->id->CssClass = "";
			$announcement->id->ViewCustomAttributes = "";

			// lid
			$announcement->lid->ViewValue = $announcement->lid->CurrentValue;
			$announcement->lid->CssStyle = "";
			$announcement->lid->CssClass = "";
			$announcement->lid->ViewCustomAttributes = "";

			// title
			$announcement->title->ViewValue = $announcement->title->CurrentValue;
			$announcement->title->CssStyle = "";
			$announcement->title->CssClass = "";
			$announcement->title->ViewCustomAttributes = "";

			// active
			$announcement->active->ViewValue = $announcement->active->CurrentValue;
			$announcement->active->CssStyle = "";
			$announcement->active->CssClass = "";
			$announcement->active->ViewCustomAttributes = "";

			// koreantennis
			$announcement->koreantennis->ViewValue = $announcement->koreantennis->CurrentValue;
			$announcement->koreantennis->CssStyle = "";
			$announcement->koreantennis->CssClass = "";
			$announcement->koreantennis->ViewCustomAttributes = "";

			// timestamp
			$announcement->timestamp->ViewValue = $announcement->timestamp->CurrentValue;
			$announcement->timestamp->ViewValue = ew_FormatDateTime($announcement->timestamp->ViewValue, 6);
			$announcement->timestamp->CssStyle = "";
			$announcement->timestamp->CssClass = "";
			$announcement->timestamp->ViewCustomAttributes = "";

			// id
			$announcement->id->HrefValue = "";
			$announcement->id->TooltipValue = "";

			// lid
			$announcement->lid->HrefValue = "";
			$announcement->lid->TooltipValue = "";

			// title
			$announcement->title->HrefValue = "";
			$announcement->title->TooltipValue = "";

			// active
			$announcement->active->HrefValue = "";
			$announcement->active->TooltipValue = "";

			// koreantennis
			$announcement->koreantennis->HrefValue = "";
			$announcement->koreantennis->TooltipValue = "";

			// timestamp
			$announcement->timestamp->HrefValue = "";
			$announcement->timestamp->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($announcement->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$announcement->Row_Rendered();
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
