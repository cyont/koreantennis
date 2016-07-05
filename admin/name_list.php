<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "email_membersinfo.php" ?>
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

<div id="gmp_members" class="ewGridMiddlePanel">
<h4>Active Email List (Total: <?php echo $members->SelectRecordCount(); ?>)</h4>

<?php if ($members_list->lTotalRecs > 0) { ?>
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

<?php echo $members->last_name->ListViewValue() ?> <?php echo $members->first_name->ListViewValue() ?>
    <br />

<?php
	}
	if ($members->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
<?php } ?>
"Tucson Korean Tennis" &lt;contact@koreantennis.org&gt;
</div>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>


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
	var $lDisplayRecs = 1000;
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

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
//		if ($members->getRecordsPerPage() <> "") {
//			$this->lDisplayRecs = $members->getRecordsPerPage(); // Restore from Session
//		} else {
//			$this->lDisplayRecs = 20; // Load default
//		}

		// Load Sorting Order
		$this->LoadSortOrder();

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

	// Set up sort parameters
	function SetUpSortOrder() {
		global $members;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$members->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$members->CurrentOrderType = @$_GET["ordertype"];
			$members->UpdateSort($members->first_name); // first_name
			$members->UpdateSort($members->last_name); // last_name
			$members->UpdateSort($members->zemail); // email
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
				$members->last_name->setSort("ASC");
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

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$members->setSessionOrderBy($sOrderBy);
				$members->first_name->setSort("");
				$members->last_name->setSort("");
				$members->zemail->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$members->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $members;

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
		// first_name

		$members->first_name->CellCssStyle = ""; $members->first_name->CellCssClass = "";
		$members->first_name->CellAttrs = array(); $members->first_name->ViewAttrs = array(); $members->first_name->EditAttrs = array();

		// last_name
		$members->last_name->CellCssStyle = ""; $members->last_name->CellCssClass = "";
		$members->last_name->CellAttrs = array(); $members->last_name->ViewAttrs = array(); $members->last_name->EditAttrs = array();

		// email
		$members->zemail->CellCssStyle = ""; $members->zemail->CellCssClass = "";
		$members->zemail->CellAttrs = array(); $members->zemail->ViewAttrs = array(); $members->zemail->EditAttrs = array();
		if ($members->RowType == EW_ROWTYPE_VIEW) { // View row

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

			// email
			$members->zemail->ViewValue = $members->zemail->CurrentValue;
			$members->zemail->CssStyle = "";
			$members->zemail->CssClass = "";
			$members->zemail->ViewCustomAttributes = "";

			// first_name
			$members->first_name->HrefValue = "";
			$members->first_name->TooltipValue = "";

			// last_name
			$members->last_name->HrefValue = "";
			$members->last_name->TooltipValue = "";

			// email
			$members->zemail->HrefValue = "";
			$members->zemail->TooltipValue = "";
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
