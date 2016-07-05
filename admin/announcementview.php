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
$announcement_view = new cannouncement_view();
$Page =& $announcement_view;

// Page init
$announcement_view->Page_Init();

// Page main
$announcement_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($announcement->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var announcement_view = new ew_Page("announcement_view");

// page properties
announcement_view.PageID = "view"; // page ID
announcement_view.FormID = "fannouncementview"; // form ID
var EW_PAGE_ID = announcement_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
announcement_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
announcement_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
announcement_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $announcement->TableCaption() ?>
<br><br>
<?php if ($announcement->Export == "") { ?>
<a href="<?php echo $announcement_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $announcement_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $announcement_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $announcement_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $announcement_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$announcement_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($announcement->id->Visible) { // id ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->id->FldCaption() ?></td>
		<td<?php echo $announcement->id->CellAttributes() ?>>
<div<?php echo $announcement->id->ViewAttributes() ?>><?php echo $announcement->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($announcement->lid->Visible) { // lid ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->lid->FldCaption() ?></td>
		<td<?php echo $announcement->lid->CellAttributes() ?>>
<div<?php echo $announcement->lid->ViewAttributes() ?>><?php echo $announcement->lid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($announcement->title->Visible) { // title ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->title->FldCaption() ?></td>
		<td<?php echo $announcement->title->CellAttributes() ?>>
<div<?php echo $announcement->title->ViewAttributes() ?>><?php echo $announcement->title->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($announcement->announcement_1->Visible) { // announcement ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->announcement_1->FldCaption() ?></td>
		<td<?php echo $announcement->announcement_1->CellAttributes() ?>>
<div<?php echo $announcement->announcement_1->ViewAttributes() ?>><?php echo $announcement->announcement_1->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($announcement->active->Visible) { // active ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->active->FldCaption() ?></td>
		<td<?php echo $announcement->active->CellAttributes() ?>>
<div<?php echo $announcement->active->ViewAttributes() ?>><?php echo $announcement->active->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($announcement->koreantennis->Visible) { // koreantennis ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->koreantennis->FldCaption() ?></td>
		<td<?php echo $announcement->koreantennis->CellAttributes() ?>>
<div<?php echo $announcement->koreantennis->ViewAttributes() ?>><?php echo $announcement->koreantennis->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($announcement->timestamp->Visible) { // timestamp ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->timestamp->FldCaption() ?></td>
		<td<?php echo $announcement->timestamp->CellAttributes() ?>>
<div<?php echo $announcement->timestamp->ViewAttributes() ?>><?php echo $announcement->timestamp->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$announcement_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cannouncement_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'announcement';

	// Page object name
	var $PageObjName = 'announcement_view';

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
	function cannouncement_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (announcement)
		$GLOBALS["announcement"] = new cannouncement();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'announcement', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();
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
	var $lDisplayRecs = 1;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $lRecCnt;
	var $arRecKey = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $announcement;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$announcement->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $announcement->id->QueryStringValue;
			} else {
				$sReturnUrl = "announcementlist.php"; // Return to list
			}

			// Get action
			$announcement->CurrentAction = "I"; // Display form
			switch ($announcement->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "announcementlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "announcementlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$announcement->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($announcement->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($announcement->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($announcement->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($announcement->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($announcement->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($announcement->id->CurrentValue);
		$this->AddUrl = $announcement->AddUrl();
		$this->EditUrl = $announcement->EditUrl();
		$this->CopyUrl = $announcement->CopyUrl();
		$this->DeleteUrl = $announcement->DeleteUrl();
		$this->ListUrl = $announcement->ListUrl();

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

		// announcement
		$announcement->announcement_1->CellCssStyle = ""; $announcement->announcement_1->CellCssClass = "";
		$announcement->announcement_1->CellAttrs = array(); $announcement->announcement_1->ViewAttrs = array(); $announcement->announcement_1->EditAttrs = array();

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

			// announcement
			$announcement->announcement_1->ViewValue = $announcement->announcement_1->CurrentValue;
			$announcement->announcement_1->CssStyle = "";
			$announcement->announcement_1->CssClass = "";
			$announcement->announcement_1->ViewCustomAttributes = "";

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

			// announcement
			$announcement->announcement_1->HrefValue = "";
			$announcement->announcement_1->TooltipValue = "";

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
}
?>
