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

			// Set up sorting order
			$this->SetUpSortOrder();
		}

		// Restore display records
		if ($announcement->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $announcement->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

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

	// Set up sort parameters
	function SetUpSortOrder() {
		global $announcement;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$announcement->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$announcement->CurrentOrderType = @$_GET["ordertype"];
			$announcement->UpdateSort($announcement->title); // title
			$announcement->UpdateSort($announcement->announcement_1); // announcement
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
				$announcement->timestamp->setSort("DESC");
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

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$announcement->setSessionOrderBy($sOrderBy);
				$announcement->title->setSort("");
				$announcement->announcement_1->setSort("");
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
		// title

		$announcement->title->CellCssStyle = "white-space: nowrap;"; $announcement->title->CellCssClass = "";
		$announcement->title->CellAttrs = array(); $announcement->title->ViewAttrs = array(); $announcement->title->EditAttrs = array();

		// announcement
		$announcement->announcement_1->CellCssStyle = "white-space: nowrap;"; $announcement->announcement_1->CellCssClass = "";
		$announcement->announcement_1->CellAttrs = array(); $announcement->announcement_1->ViewAttrs = array(); $announcement->announcement_1->EditAttrs = array();

		// timestamp
		$announcement->timestamp->CellCssStyle = "white-space: nowrap;"; $announcement->timestamp->CellCssClass = "";
		$announcement->timestamp->CellAttrs = array(); $announcement->timestamp->ViewAttrs = array(); $announcement->timestamp->EditAttrs = array();
		if ($announcement->RowType == EW_ROWTYPE_VIEW) { // View row

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

			// timestamp
			$announcement->timestamp->ViewValue = $announcement->timestamp->CurrentValue;
			$announcement->timestamp->ViewValue = ew_FormatDateTime($announcement->timestamp->ViewValue, 6);
			$announcement->timestamp->CssStyle = "";
			$announcement->timestamp->CssClass = "";
			$announcement->timestamp->ViewCustomAttributes = "";

			// title
			$announcement->title->HrefValue = "";
			$announcement->title->TooltipValue = "";

			// announcement
			$announcement->announcement_1->HrefValue = "";
			$announcement->announcement_1->TooltipValue = "";

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