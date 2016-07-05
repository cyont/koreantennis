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
$courts_view = new ccourts_view();
$Page =& $courts_view;

// Page init
$courts_view->Page_Init();

// Page main
$courts_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($courts->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var courts_view = new ew_Page("courts_view");

// page properties
courts_view.PageID = "view"; // page ID
courts_view.FormID = "fcourtsview"; // form ID
var EW_PAGE_ID = courts_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
courts_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
courts_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
courts_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $courts->TableCaption() ?>
<br><br>
<?php if ($courts->Export == "") { ?>
<a href="<?php echo $courts_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $courts_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $courts_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $courts_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$courts_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($courts->id->Visible) { // id ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->id->FldCaption() ?></td>
		<td<?php echo $courts->id->CellAttributes() ?>>
<div<?php echo $courts->id->ViewAttributes() ?>><?php echo $courts->id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->name->Visible) { // name ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->name->FldCaption() ?></td>
		<td<?php echo $courts->name->CellAttributes() ?>>
<div<?php echo $courts->name->ViewAttributes() ?>><?php echo $courts->name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->region->Visible) { // region ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->region->FldCaption() ?></td>
		<td<?php echo $courts->region->CellAttributes() ?>>
<div<?php echo $courts->region->ViewAttributes() ?>><?php echo $courts->region->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->location->Visible) { // location ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->location->FldCaption() ?></td>
		<td<?php echo $courts->location->CellAttributes() ?>>
<div<?php echo $courts->location->ViewAttributes() ?>><?php echo $courts->location->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->address->Visible) { // address ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->address->FldCaption() ?></td>
		<td<?php echo $courts->address->CellAttributes() ?>>
<div<?php echo $courts->address->ViewAttributes() ?>><?php echo $courts->address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->zip->Visible) { // zip ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->zip->FldCaption() ?></td>
		<td<?php echo $courts->zip->CellAttributes() ?>>
<div<?php echo $courts->zip->ViewAttributes() ?>><?php echo $courts->zip->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->city->Visible) { // city ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->city->FldCaption() ?></td>
		<td<?php echo $courts->city->CellAttributes() ?>>
<div<?php echo $courts->city->ViewAttributes() ?>><?php echo $courts->city->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->time->Visible) { // time ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->time->FldCaption() ?></td>
		<td<?php echo $courts->time->CellAttributes() ?>>
<div<?php echo $courts->time->ViewAttributes() ?>><?php echo $courts->time->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->cost->Visible) { // cost ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->cost->FldCaption() ?></td>
		<td<?php echo $courts->cost->CellAttributes() ?>>
<div<?php echo $courts->cost->ViewAttributes() ?>><?php echo $courts->cost->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->court_num->Visible) { // court_num ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->court_num->FldCaption() ?></td>
		<td<?php echo $courts->court_num->CellAttributes() ?>>
<div<?php echo $courts->court_num->ViewAttributes() ?>><?php echo $courts->court_num->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->lights->Visible) { // lights ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->lights->FldCaption() ?></td>
		<td<?php echo $courts->lights->CellAttributes() ?>>
<div<?php echo $courts->lights->ViewAttributes() ?>><?php echo $courts->lights->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->maintenance->Visible) { // maintenance ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->maintenance->FldCaption() ?></td>
		<td<?php echo $courts->maintenance->CellAttributes() ?>>
<div<?php echo $courts->maintenance->ViewAttributes() ?>><?php echo $courts->maintenance->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->website->Visible) { // website ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->website->FldCaption() ?></td>
		<td<?php echo $courts->website->CellAttributes() ?>>
<div<?php echo $courts->website->ViewAttributes() ?>><?php echo $courts->website->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($courts->phone->Visible) { // phone ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->phone->FldCaption() ?></td>
		<td<?php echo $courts->phone->CellAttributes() ?>>
<div<?php echo $courts->phone->ViewAttributes() ?>><?php echo $courts->phone->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
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
$courts_view->Page_Terminate();
?>
<?php

//
// Page class
//
class ccourts_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'courts';

	// Page object name
	var $PageObjName = 'courts_view';

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
	function ccourts_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (courts)
		$GLOBALS["courts"] = new ccourts();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'courts', TRUE);

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
		global $courts;

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
		global $Language, $courts;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["id"] <> "") {
				$courts->id->setQueryStringValue($_GET["id"]);
				$this->arRecKey["id"] = $courts->id->QueryStringValue;
			} else {
				$sReturnUrl = "courtslist.php"; // Return to list
			}

			// Get action
			$courts->CurrentAction = "I"; // Display form
			switch ($courts->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "courtslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "courtslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$courts->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "id=" . urlencode($courts->id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "id=" . urlencode($courts->id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "id=" . urlencode($courts->id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "id=" . urlencode($courts->id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "id=" . urlencode($courts->id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "id=" . urlencode($courts->id->CurrentValue);
		$this->AddUrl = $courts->AddUrl();
		$this->EditUrl = $courts->EditUrl();
		$this->CopyUrl = $courts->CopyUrl();
		$this->DeleteUrl = $courts->DeleteUrl();
		$this->ListUrl = $courts->ListUrl();

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

		// time
		$courts->time->CellCssStyle = ""; $courts->time->CellCssClass = "";
		$courts->time->CellAttrs = array(); $courts->time->ViewAttrs = array(); $courts->time->EditAttrs = array();

		// cost
		$courts->cost->CellCssStyle = ""; $courts->cost->CellCssClass = "";
		$courts->cost->CellAttrs = array(); $courts->cost->ViewAttrs = array(); $courts->cost->EditAttrs = array();

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

			// time
			$courts->time->ViewValue = $courts->time->CurrentValue;
			$courts->time->CssStyle = "";
			$courts->time->CssClass = "";
			$courts->time->ViewCustomAttributes = "";

			// cost
			$courts->cost->ViewValue = $courts->cost->CurrentValue;
			$courts->cost->CssStyle = "";
			$courts->cost->CssClass = "";
			$courts->cost->ViewCustomAttributes = "";

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

			// time
			$courts->time->HrefValue = "";
			$courts->time->TooltipValue = "";

			// cost
			$courts->cost->HrefValue = "";
			$courts->cost->TooltipValue = "";

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
}
?>
