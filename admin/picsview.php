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
$pics_view = new cpics_view();
$Page =& $pics_view;

// Page init
$pics_view->Page_Init();

// Page main
$pics_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($pics->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var pics_view = new ew_Page("pics_view");

// page properties
pics_view.PageID = "view"; // page ID
pics_view.FormID = "fpicsview"; // form ID
var EW_PAGE_ID = pics_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pics_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pics_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pics_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pics->TableCaption() ?>
<br><br>
<?php if ($pics->Export == "") { ?>
<a href="<?php echo $pics_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pics_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pics_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $pics_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$pics_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($pics->id->Visible) { // id ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->id->FldCaption() ?></td>
		<td<?php echo $pics->id->CellAttributes() ?>>
<div<?php echo $pics->id->ViewAttributes() ?>><?php echo $pics->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pics->caption->Visible) { // caption ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->caption->FldCaption() ?></td>
		<td<?php echo $pics->caption->CellAttributes() ?>>
<div<?php echo $pics->caption->ViewAttributes() ?>><?php echo $pics->caption->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pics->descc->Visible) { // descc ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->descc->FldCaption() ?></td>
		<td<?php echo $pics->descc->CellAttributes() ?>>
<div<?php echo $pics->descc->ViewAttributes() ?>><?php echo $pics->descc->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pics->img->Visible) { // img ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->img->FldCaption() ?></td>
		<td<?php echo $pics->img->CellAttributes() ?>>
<div<?php echo $pics->img->ViewAttributes() ?>><?php echo $pics->img->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pics->width_big->Visible) { // width_big ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->width_big->FldCaption() ?></td>
		<td<?php echo $pics->width_big->CellAttributes() ?>>
<div<?php echo $pics->width_big->ViewAttributes() ?>><?php echo $pics->width_big->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pics->height_big->Visible) { // height_big ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->height_big->FldCaption() ?></td>
		<td<?php echo $pics->height_big->CellAttributes() ?>>
<div<?php echo $pics->height_big->ViewAttributes() ?>><?php echo $pics->height_big->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pics->width_small->Visible) { // width_small ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->width_small->FldCaption() ?></td>
		<td<?php echo $pics->width_small->CellAttributes() ?>>
<div<?php echo $pics->width_small->ViewAttributes() ?>><?php echo $pics->width_small->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pics->height_small->Visible) { // height_small ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->height_small->FldCaption() ?></td>
		<td<?php echo $pics->height_small->CellAttributes() ?>>
<div<?php echo $pics->height_small->ViewAttributes() ?>><?php echo $pics->height_small->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pics->hits->Visible) { // hits ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->hits->FldCaption() ?></td>
		<td<?php echo $pics->hits->CellAttributes() ?>>
<div<?php echo $pics->hits->ViewAttributes() ?>><?php echo $pics->hits->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($pics->date_uploaded->Visible) { // date_uploaded ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->date_uploaded->FldCaption() ?></td>
		<td<?php echo $pics->date_uploaded->CellAttributes() ?>>
<div<?php echo $pics->date_uploaded->ViewAttributes() ?>><?php echo $pics->date_uploaded->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$pics_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cpics_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'pics';

	// Page object name
	var $PageObjName = 'pics_view';

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
	function cpics_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (pics)
		$GLOBALS["pics"] = new cpics();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pics', TRUE);

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
		global $pics;

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
		global $Language, $pics;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$pics->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $pics->id->QueryStringValue;
			} else {
				$sReturnUrl = "picslist.php"; // Return to list
			}

			// Get action
			$pics->CurrentAction = "I"; // Display form
			switch ($pics->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "picslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "picslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$pics->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($pics->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($pics->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($pics->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($pics->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($pics->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($pics->id->CurrentValue);
		$this->AddUrl = $pics->AddUrl();
		$this->EditUrl = $pics->EditUrl();
		$this->CopyUrl = $pics->CopyUrl();
		$this->DeleteUrl = $pics->DeleteUrl();
		$this->ListUrl = $pics->ListUrl();

		// Call Row_Rendering event
		$pics->Row_Rendering();

		// Common render codes for all row types
		// id

		$pics->id->CellCssStyle = ""; $pics->id->CellCssClass = "";
		$pics->id->CellAttrs = array(); $pics->id->ViewAttrs = array(); $pics->id->EditAttrs = array();

		// caption
		$pics->caption->CellCssStyle = ""; $pics->caption->CellCssClass = "";
		$pics->caption->CellAttrs = array(); $pics->caption->ViewAttrs = array(); $pics->caption->EditAttrs = array();

		// descc
		$pics->descc->CellCssStyle = ""; $pics->descc->CellCssClass = "";
		$pics->descc->CellAttrs = array(); $pics->descc->ViewAttrs = array(); $pics->descc->EditAttrs = array();

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

			// caption
			$pics->caption->ViewValue = $pics->caption->CurrentValue;
			$pics->caption->CssStyle = "";
			$pics->caption->CssClass = "";
			$pics->caption->ViewCustomAttributes = "";

			// descc
			$pics->descc->ViewValue = $pics->descc->CurrentValue;
			$pics->descc->CssStyle = "";
			$pics->descc->CssClass = "";
			$pics->descc->ViewCustomAttributes = "";

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

			// caption
			$pics->caption->HrefValue = "";
			$pics->caption->TooltipValue = "";

			// descc
			$pics->descc->HrefValue = "";
			$pics->descc->TooltipValue = "";

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
}
?>
