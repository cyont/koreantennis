<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "admininfo.php" ?>
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
$admin_view = new cadmin_view();
$Page =& $admin_view;

// Page init
$admin_view->Page_Init();

// Page main
$admin_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($admin->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var admin_view = new ew_Page("admin_view");

// page properties
admin_view.PageID = "view"; // page ID
admin_view.FormID = "fadminview"; // form ID
var EW_PAGE_ID = admin_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
admin_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
admin_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
admin_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $admin->TableCaption() ?>
<br><br>
<?php if ($admin->Export == "") { ?>
<a href="<?php echo $admin_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $admin_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $admin_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $admin_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$admin_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($admin->id->Visible) { // id ?>
	<tr<?php echo $admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $admin->id->FldCaption() ?></td>
		<td<?php echo $admin->id->CellAttributes() ?>>
<div<?php echo $admin->id->ViewAttributes() ?>><?php echo $admin->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($admin->admin_1->Visible) { // admin ?>
	<tr<?php echo $admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $admin->admin_1->FldCaption() ?></td>
		<td<?php echo $admin->admin_1->CellAttributes() ?>>
<div<?php echo $admin->admin_1->ViewAttributes() ?>><?php echo $admin->admin_1->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($admin->pass->Visible) { // pass ?>
	<tr<?php echo $admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $admin->pass->FldCaption() ?></td>
		<td<?php echo $admin->pass->CellAttributes() ?>>
<div<?php echo $admin->pass->ViewAttributes() ?>><?php echo $admin->pass->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($admin->zemail->Visible) { // email ?>
	<tr<?php echo $admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $admin->zemail->FldCaption() ?></td>
		<td<?php echo $admin->zemail->CellAttributes() ?>>
<div<?php echo $admin->zemail->ViewAttributes() ?>><?php echo $admin->zemail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($admin->hits->Visible) { // hits ?>
	<tr<?php echo $admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $admin->hits->FldCaption() ?></td>
		<td<?php echo $admin->hits->CellAttributes() ?>>
<div<?php echo $admin->hits->ViewAttributes() ?>><?php echo $admin->hits->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($admin->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$admin_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cadmin_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'admin';

	// Page object name
	var $PageObjName = 'admin_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $admin;
		if ($admin->UseTokenInUrl) $PageUrl .= "t=" . $admin->TableVar . "&"; // Add page token
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
		global $objForm, $admin;
		if ($admin->UseTokenInUrl) {
			if ($objForm)
				return ($admin->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($admin->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cadmin_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (admin)
		$GLOBALS["admin"] = new cadmin();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'admin', TRUE);

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
		global $admin;

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
		global $Language, $admin;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$admin->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $admin->id->QueryStringValue;
			} else {
				$sReturnUrl = "adminlist.php"; // Return to list
			}

			// Get action
			$admin->CurrentAction = "I"; // Display form
			switch ($admin->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "adminlist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "adminlist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$admin->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $admin;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$admin->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$admin->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $admin->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$admin->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$admin->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$admin->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $admin;
		$sFilter = $admin->KeyFilter();

		// Call Row Selecting event
		$admin->Row_Selecting($sFilter);

		// Load SQL based on filter
		$admin->CurrentFilter = $sFilter;
		$sSql = $admin->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$admin->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $admin;
		$admin->id->setDbValue($rs->fields('id'));
		$admin->admin_1->setDbValue($rs->fields('admin'));
		$admin->pass->setDbValue($rs->fields('pass'));
		$admin->zemail->setDbValue($rs->fields('email'));
		$admin->hits->setDbValue($rs->fields('hits'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $admin;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($admin->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($admin->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($admin->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($admin->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($admin->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($admin->id->CurrentValue);
		$this->AddUrl = $admin->AddUrl();
		$this->EditUrl = $admin->EditUrl();
		$this->CopyUrl = $admin->CopyUrl();
		$this->DeleteUrl = $admin->DeleteUrl();
		$this->ListUrl = $admin->ListUrl();

		// Call Row_Rendering event
		$admin->Row_Rendering();

		// Common render codes for all row types
		// id

		$admin->id->CellCssStyle = ""; $admin->id->CellCssClass = "";
		$admin->id->CellAttrs = array(); $admin->id->ViewAttrs = array(); $admin->id->EditAttrs = array();

		// admin
		$admin->admin_1->CellCssStyle = ""; $admin->admin_1->CellCssClass = "";
		$admin->admin_1->CellAttrs = array(); $admin->admin_1->ViewAttrs = array(); $admin->admin_1->EditAttrs = array();

		// pass
		$admin->pass->CellCssStyle = ""; $admin->pass->CellCssClass = "";
		$admin->pass->CellAttrs = array(); $admin->pass->ViewAttrs = array(); $admin->pass->EditAttrs = array();

		// email
		$admin->zemail->CellCssStyle = ""; $admin->zemail->CellCssClass = "";
		$admin->zemail->CellAttrs = array(); $admin->zemail->ViewAttrs = array(); $admin->zemail->EditAttrs = array();

		// hits
		$admin->hits->CellCssStyle = ""; $admin->hits->CellCssClass = "";
		$admin->hits->CellAttrs = array(); $admin->hits->ViewAttrs = array(); $admin->hits->EditAttrs = array();
		if ($admin->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$admin->id->ViewValue = $admin->id->CurrentValue;
			$admin->id->CssStyle = "";
			$admin->id->CssClass = "";
			$admin->id->ViewCustomAttributes = "";

			// admin
			$admin->admin_1->ViewValue = $admin->admin_1->CurrentValue;
			$admin->admin_1->CssStyle = "";
			$admin->admin_1->CssClass = "";
			$admin->admin_1->ViewCustomAttributes = "";

			// pass
			$admin->pass->ViewValue = $admin->pass->CurrentValue;
			$admin->pass->CssStyle = "";
			$admin->pass->CssClass = "";
			$admin->pass->ViewCustomAttributes = "";

			// email
			$admin->zemail->ViewValue = $admin->zemail->CurrentValue;
			$admin->zemail->CssStyle = "";
			$admin->zemail->CssClass = "";
			$admin->zemail->ViewCustomAttributes = "";

			// hits
			$admin->hits->ViewValue = $admin->hits->CurrentValue;
			$admin->hits->CssStyle = "";
			$admin->hits->CssClass = "";
			$admin->hits->ViewCustomAttributes = "";

			// id
			$admin->id->HrefValue = "";
			$admin->id->TooltipValue = "";

			// admin
			$admin->admin_1->HrefValue = "";
			$admin->admin_1->TooltipValue = "";

			// pass
			$admin->pass->HrefValue = "";
			$admin->pass->TooltipValue = "";

			// email
			$admin->zemail->HrefValue = "";
			$admin->zemail->TooltipValue = "";

			// hits
			$admin->hits->HrefValue = "";
			$admin->hits->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($admin->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$admin->Row_Rendered();
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
