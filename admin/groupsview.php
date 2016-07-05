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
<?php

// Create page object
$groups_view = new cgroups_view();
$Page =& $groups_view;

// Page init
$groups_view->Page_Init();

// Page main
$groups_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($groups->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var groups_view = new ew_Page("groups_view");

// page properties
groups_view.PageID = "view"; // page ID
groups_view.FormID = "fgroupsview"; // form ID
var EW_PAGE_ID = groups_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
groups_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
groups_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
groups_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $groups->TableCaption() ?>
<br><br>
<?php if ($groups->Export == "") { ?>
<a href="<?php echo $groups_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $groups_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $groups_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $groups_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $groups_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$groups_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($groups->Id->Visible) { // Id ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->Id->FldCaption() ?></td>
		<td<?php echo $groups->Id->CellAttributes() ?>>
<div<?php echo $groups->Id->ViewAttributes() ?>><?php echo $groups->Id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($groups->nickname_kor->Visible) { // nickname_kor ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->nickname_kor->FldCaption() ?></td>
		<td<?php echo $groups->nickname_kor->CellAttributes() ?>>
<div<?php echo $groups->nickname_kor->ViewAttributes() ?>><?php echo $groups->nickname_kor->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($groups->nickname_eng->Visible) { // nickname_eng ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->nickname_eng->FldCaption() ?></td>
		<td<?php echo $groups->nickname_eng->CellAttributes() ?>>
<div<?php echo $groups->nickname_eng->ViewAttributes() ?>><?php echo $groups->nickname_eng->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($groups->inactive->Visible) { // inactive ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->inactive->FldCaption() ?></td>
		<td<?php echo $groups->inactive->CellAttributes() ?>>
<div<?php echo $groups->inactive->ViewAttributes() ?>><?php echo $groups->inactive->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($groups->r_group->Visible) { // r_group ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->r_group->FldCaption() ?></td>
		<td<?php echo $groups->r_group->CellAttributes() ?>>
<div<?php echo $groups->r_group->ViewAttributes() ?>><?php echo $groups->r_group->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($groups->points->Visible) { // points ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->points->FldCaption() ?></td>
		<td<?php echo $groups->points->CellAttributes() ?>>
<div<?php echo $groups->points->ViewAttributes() ?>><?php echo $groups->points->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($groups->hide_list->Visible) { // hide_list ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->hide_list->FldCaption() ?></td>
		<td<?php echo $groups->hide_list->CellAttributes() ?>>
<div<?php echo $groups->hide_list->ViewAttributes() ?>><?php echo $groups->hide_list->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($groups->total_wins->Visible) { // total_wins ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->total_wins->FldCaption() ?></td>
		<td<?php echo $groups->total_wins->CellAttributes() ?>>
<div<?php echo $groups->total_wins->ViewAttributes() ?>><?php echo $groups->total_wins->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($groups->total_losses->Visible) { // total_losses ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->total_losses->FldCaption() ?></td>
		<td<?php echo $groups->total_losses->CellAttributes() ?>>
<div<?php echo $groups->total_losses->ViewAttributes() ?>><?php echo $groups->total_losses->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($groups->current_wins->Visible) { // current_wins ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->current_wins->FldCaption() ?></td>
		<td<?php echo $groups->current_wins->CellAttributes() ?>>
<div<?php echo $groups->current_wins->ViewAttributes() ?>><?php echo $groups->current_wins->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($groups->current_losses->Visible) { // current_losses ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->current_losses->FldCaption() ?></td>
		<td<?php echo $groups->current_losses->CellAttributes() ?>>
<div<?php echo $groups->current_losses->ViewAttributes() ?>><?php echo $groups->current_losses->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$groups_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cgroups_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'groups';

	// Page object name
	var $PageObjName = 'groups_view';

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
	function cgroups_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (groups)
		$GLOBALS["groups"] = new cgroups();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'groups', TRUE);

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
		global $groups;

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
		global $Language, $groups;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["Id"] <> "") {
				$groups->Id->setQueryStringValue($_GET["Id"]);
				$this->arRecKey["Id"] = $groups->Id->QueryStringValue;
			} else {
				$sReturnUrl = "groupslist.php"; // Return to list
			}

			// Get action
			$groups->CurrentAction = "I"; // Display form
			switch ($groups->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "groupslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "groupslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$groups->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "Id=" . urlencode($groups->Id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "Id=" . urlencode($groups->Id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "Id=" . urlencode($groups->Id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "Id=" . urlencode($groups->Id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "Id=" . urlencode($groups->Id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "Id=" . urlencode($groups->Id->CurrentValue);
		$this->AddUrl = $groups->AddUrl();
		$this->EditUrl = $groups->EditUrl();
		$this->CopyUrl = $groups->CopyUrl();
		$this->DeleteUrl = $groups->DeleteUrl();
		$this->ListUrl = $groups->ListUrl();

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
}
?>
