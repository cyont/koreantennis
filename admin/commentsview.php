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
$comments_view = new ccomments_view();
$Page =& $comments_view;

// Page init
$comments_view->Page_Init();

// Page main
$comments_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($comments->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var comments_view = new ew_Page("comments_view");

// page properties
comments_view.PageID = "view"; // page ID
comments_view.FormID = "fcommentsview"; // form ID
var EW_PAGE_ID = comments_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
comments_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
comments_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comments_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $comments->TableCaption() ?>
<br><br>
<?php if ($comments->Export == "") { ?>
<a href="<?php echo $comments_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $comments_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $comments_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $comments_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$comments_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($comments->id->Visible) { // id ?>
	<tr<?php echo $comments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comments->id->FldCaption() ?></td>
		<td<?php echo $comments->id->CellAttributes() ?>>
<div<?php echo $comments->id->ViewAttributes() ?>><?php echo $comments->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($comments->imgid->Visible) { // imgid ?>
	<tr<?php echo $comments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comments->imgid->FldCaption() ?></td>
		<td<?php echo $comments->imgid->CellAttributes() ?>>
<div<?php echo $comments->imgid->ViewAttributes() ?>><?php echo $comments->imgid->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($comments->name2->Visible) { // name2 ?>
	<tr<?php echo $comments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comments->name2->FldCaption() ?></td>
		<td<?php echo $comments->name2->CellAttributes() ?>>
<div<?php echo $comments->name2->ViewAttributes() ?>><?php echo $comments->name2->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($comments->comment2->Visible) { // comment2 ?>
	<tr<?php echo $comments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comments->comment2->FldCaption() ?></td>
		<td<?php echo $comments->comment2->CellAttributes() ?>>
<div<?php echo $comments->comment2->ViewAttributes() ?>><?php echo $comments->comment2->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($comments->date->Visible) { // date ?>
	<tr<?php echo $comments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comments->date->FldCaption() ?></td>
		<td<?php echo $comments->date->CellAttributes() ?>>
<div<?php echo $comments->date->ViewAttributes() ?>><?php echo $comments->date->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($comments->status->Visible) { // status ?>
	<tr<?php echo $comments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comments->status->FldCaption() ?></td>
		<td<?php echo $comments->status->CellAttributes() ?>>
<div<?php echo $comments->status->ViewAttributes() ?>><?php echo $comments->status->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$comments_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ccomments_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'comments';

	// Page object name
	var $PageObjName = 'comments_view';

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
	function ccomments_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (comments)
		$GLOBALS["comments"] = new ccomments();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'comments', TRUE);

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
		global $comments;

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
		global $Language, $comments;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$comments->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $comments->id->QueryStringValue;
			} else {
				$sReturnUrl = "commentslist.php"; // Return to list
			}

			// Get action
			$comments->CurrentAction = "I"; // Display form
			switch ($comments->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "commentslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "commentslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$comments->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($comments->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($comments->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($comments->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($comments->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($comments->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($comments->id->CurrentValue);
		$this->AddUrl = $comments->AddUrl();
		$this->EditUrl = $comments->EditUrl();
		$this->CopyUrl = $comments->CopyUrl();
		$this->DeleteUrl = $comments->DeleteUrl();
		$this->ListUrl = $comments->ListUrl();

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

		// comment2
		$comments->comment2->CellCssStyle = ""; $comments->comment2->CellCssClass = "";
		$comments->comment2->CellAttrs = array(); $comments->comment2->ViewAttrs = array(); $comments->comment2->EditAttrs = array();

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

			// comment2
			$comments->comment2->ViewValue = $comments->comment2->CurrentValue;
			$comments->comment2->CssStyle = "";
			$comments->comment2->CssClass = "";
			$comments->comment2->ViewCustomAttributes = "";

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

			// comment2
			$comments->comment2->HrefValue = "";
			$comments->comment2->TooltipValue = "";

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
}
?>
