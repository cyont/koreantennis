<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
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
$members_view = new cmembers_view();
$Page =& $members_view;

// Page init
$members_view->Page_Init();

// Page main
$members_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($members->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var members_view = new ew_Page("members_view");

// page properties
members_view.PageID = "view"; // page ID
members_view.FormID = "fmembersview"; // form ID
var EW_PAGE_ID = members_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
members_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
members_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
members_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $members->TableCaption() ?>
<br><br>
<?php if ($members->Export == "") { ?>
<a href="<?php echo $members_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $members_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $members_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $members_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$members_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($members->Id->Visible) { // Id ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->Id->FldCaption() ?></td>
		<td<?php echo $members->Id->CellAttributes() ?>>
<div<?php echo $members->Id->ViewAttributes() ?>><?php echo $members->Id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->first_name->Visible) { // first_name ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->first_name->FldCaption() ?></td>
		<td<?php echo $members->first_name->CellAttributes() ?>>
<div<?php echo $members->first_name->ViewAttributes() ?>><?php echo $members->first_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->last_name->Visible) { // last_name ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->last_name->FldCaption() ?></td>
		<td<?php echo $members->last_name->CellAttributes() ?>>
<div<?php echo $members->last_name->ViewAttributes() ?>><?php echo $members->last_name->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->first_name_eng->Visible) { // first_name_eng ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->first_name_eng->FldCaption() ?></td>
		<td<?php echo $members->first_name_eng->CellAttributes() ?>>
<div<?php echo $members->first_name_eng->ViewAttributes() ?>><?php echo $members->first_name_eng->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->last_name_eng->Visible) { // last_name_eng ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->last_name_eng->FldCaption() ?></td>
		<td<?php echo $members->last_name_eng->CellAttributes() ?>>
<div<?php echo $members->last_name_eng->ViewAttributes() ?>><?php echo $members->last_name_eng->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->username->Visible) { // username ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->username->FldCaption() ?></td>
		<td<?php echo $members->username->CellAttributes() ?>>
<div<?php echo $members->username->ViewAttributes() ?>><?php echo $members->username->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->password->Visible) { // password ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->password->FldCaption() ?></td>
		<td<?php echo $members->password->CellAttributes() ?>>
<div<?php echo $members->password->ViewAttributes() ?>><?php echo $members->password->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->phone_cell->Visible) { // phone_cell ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->phone_cell->FldCaption() ?></td>
		<td<?php echo $members->phone_cell->CellAttributes() ?>>
<div<?php echo $members->phone_cell->ViewAttributes() ?>><?php echo $members->phone_cell->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->phone_home->Visible) { // phone_home ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->phone_home->FldCaption() ?></td>
		<td<?php echo $members->phone_home->CellAttributes() ?>>
<div<?php echo $members->phone_home->ViewAttributes() ?>><?php echo $members->phone_home->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->zemail->Visible) { // email ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->zemail->FldCaption() ?></td>
		<td<?php echo $members->zemail->CellAttributes() ?>>
<div<?php echo $members->zemail->ViewAttributes() ?>><?php echo $members->zemail->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->address->Visible) { // address ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->address->FldCaption() ?></td>
		<td<?php echo $members->address->CellAttributes() ?>>
<div<?php echo $members->address->ViewAttributes() ?>><?php echo $members->address->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->city->Visible) { // city ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->city->FldCaption() ?></td>
		<td<?php echo $members->city->CellAttributes() ?>>
<div<?php echo $members->city->ViewAttributes() ?>><?php echo $members->city->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->zip->Visible) { // zip ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->zip->FldCaption() ?></td>
		<td<?php echo $members->zip->CellAttributes() ?>>
<div<?php echo $members->zip->ViewAttributes() ?>><?php echo $members->zip->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->gender->Visible) { // gender ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->gender->FldCaption() ?></td>
		<td<?php echo $members->gender->CellAttributes() ?>>
<div<?php echo $members->gender->ViewAttributes() ?>><?php echo $members->gender->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->status_student->Visible) { // status_student ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->status_student->FldCaption() ?></td>
		<td<?php echo $members->status_student->CellAttributes() ?>>
<div<?php echo $members->status_student->ViewAttributes() ?>><?php echo $members->status_student->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->ethnicity_korean->Visible) { // ethnicity_korean ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->ethnicity_korean->FldCaption() ?></td>
		<td<?php echo $members->ethnicity_korean->CellAttributes() ?>>
<div<?php echo $members->ethnicity_korean->ViewAttributes() ?>><?php echo $members->ethnicity_korean->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->language_korean->Visible) { // language_korean ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->language_korean->FldCaption() ?></td>
		<td<?php echo $members->language_korean->CellAttributes() ?>>
<div<?php echo $members->language_korean->ViewAttributes() ?>><?php echo $members->language_korean->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->access_level->Visible) { // access_level ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->access_level->FldCaption() ?></td>
		<td<?php echo $members->access_level->CellAttributes() ?>>
<div<?php echo $members->access_level->ViewAttributes() ?>><?php echo $members->access_level->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($members->active_member->Visible) { // active_member ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->active_member->FldCaption() ?></td>
		<td<?php echo $members->active_member->CellAttributes() ?>>
<div<?php echo $members->active_member->ViewAttributes() ?>><?php echo $members->active_member->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($members->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$members_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembers_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'members';

	// Page object name
	var $PageObjName = 'members_view';

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
	function cmembers_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (members)
		$GLOBALS["members"] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'members', TRUE);

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
		global $members;

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
		global $Language, $members;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["Id"] <> "") {
				$members->Id->setQueryStringValue($_GET["Id"]);
				$this->arRecKey["Id"] = $members->Id->QueryStringValue;
			} else {
				$sReturnUrl = "memberslist.php"; // Return to list
			}

			// Get action
			$members->CurrentAction = "I"; // Display form
			switch ($members->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "memberslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "memberslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$members->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
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
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "Id=" . urlencode($members->Id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "Id=" . urlencode($members->Id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "Id=" . urlencode($members->Id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "Id=" . urlencode($members->Id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "Id=" . urlencode($members->Id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "Id=" . urlencode($members->Id->CurrentValue);
		$this->AddUrl = $members->AddUrl();
		$this->EditUrl = $members->EditUrl();
		$this->CopyUrl = $members->CopyUrl();
		$this->DeleteUrl = $members->DeleteUrl();
		$this->ListUrl = $members->ListUrl();

		// Call Row_Rendering event
		$members->Row_Rendering();

		// Common render codes for all row types
		// Id

		$members->Id->CellCssStyle = ""; $members->Id->CellCssClass = "";
		$members->Id->CellAttrs = array(); $members->Id->ViewAttrs = array(); $members->Id->EditAttrs = array();

		// first_name
		$members->first_name->CellCssStyle = ""; $members->first_name->CellCssClass = "";
		$members->first_name->CellAttrs = array(); $members->first_name->ViewAttrs = array(); $members->first_name->EditAttrs = array();

		// last_name
		$members->last_name->CellCssStyle = ""; $members->last_name->CellCssClass = "";
		$members->last_name->CellAttrs = array(); $members->last_name->ViewAttrs = array(); $members->last_name->EditAttrs = array();

		// first_name_eng
		$members->first_name_eng->CellCssStyle = ""; $members->first_name_eng->CellCssClass = "";
		$members->first_name_eng->CellAttrs = array(); $members->first_name_eng->ViewAttrs = array(); $members->first_name_eng->EditAttrs = array();

		// last_name_eng
		$members->last_name_eng->CellCssStyle = ""; $members->last_name_eng->CellCssClass = "";
		$members->last_name_eng->CellAttrs = array(); $members->last_name_eng->ViewAttrs = array(); $members->last_name_eng->EditAttrs = array();

		// username
		$members->username->CellCssStyle = ""; $members->username->CellCssClass = "";
		$members->username->CellAttrs = array(); $members->username->ViewAttrs = array(); $members->username->EditAttrs = array();

		// password
		$members->password->CellCssStyle = ""; $members->password->CellCssClass = "";
		$members->password->CellAttrs = array(); $members->password->ViewAttrs = array(); $members->password->EditAttrs = array();

		// phone_cell
		$members->phone_cell->CellCssStyle = ""; $members->phone_cell->CellCssClass = "";
		$members->phone_cell->CellAttrs = array(); $members->phone_cell->ViewAttrs = array(); $members->phone_cell->EditAttrs = array();

		// phone_home
		$members->phone_home->CellCssStyle = ""; $members->phone_home->CellCssClass = "";
		$members->phone_home->CellAttrs = array(); $members->phone_home->ViewAttrs = array(); $members->phone_home->EditAttrs = array();

		// email
		$members->zemail->CellCssStyle = ""; $members->zemail->CellCssClass = "";
		$members->zemail->CellAttrs = array(); $members->zemail->ViewAttrs = array(); $members->zemail->EditAttrs = array();

		// address
		$members->address->CellCssStyle = ""; $members->address->CellCssClass = "";
		$members->address->CellAttrs = array(); $members->address->ViewAttrs = array(); $members->address->EditAttrs = array();

		// city
		$members->city->CellCssStyle = ""; $members->city->CellCssClass = "";
		$members->city->CellAttrs = array(); $members->city->ViewAttrs = array(); $members->city->EditAttrs = array();

		// zip
		$members->zip->CellCssStyle = ""; $members->zip->CellCssClass = "";
		$members->zip->CellAttrs = array(); $members->zip->ViewAttrs = array(); $members->zip->EditAttrs = array();

		// gender
		$members->gender->CellCssStyle = ""; $members->gender->CellCssClass = "";
		$members->gender->CellAttrs = array(); $members->gender->ViewAttrs = array(); $members->gender->EditAttrs = array();

		// status_student
		$members->status_student->CellCssStyle = ""; $members->status_student->CellCssClass = "";
		$members->status_student->CellAttrs = array(); $members->status_student->ViewAttrs = array(); $members->status_student->EditAttrs = array();

		// ethnicity_korean
		$members->ethnicity_korean->CellCssStyle = ""; $members->ethnicity_korean->CellCssClass = "";
		$members->ethnicity_korean->CellAttrs = array(); $members->ethnicity_korean->ViewAttrs = array(); $members->ethnicity_korean->EditAttrs = array();

		// language_korean
		$members->language_korean->CellCssStyle = ""; $members->language_korean->CellCssClass = "";
		$members->language_korean->CellAttrs = array(); $members->language_korean->ViewAttrs = array(); $members->language_korean->EditAttrs = array();

		// access_level
		$members->access_level->CellCssStyle = ""; $members->access_level->CellCssClass = "";
		$members->access_level->CellAttrs = array(); $members->access_level->ViewAttrs = array(); $members->access_level->EditAttrs = array();

		// active_member
		$members->active_member->CellCssStyle = ""; $members->active_member->CellCssClass = "";
		$members->active_member->CellAttrs = array(); $members->active_member->ViewAttrs = array(); $members->active_member->EditAttrs = array();
		if ($members->RowType == EW_ROWTYPE_VIEW) { // View row

			// Id
			$members->Id->ViewValue = $members->Id->CurrentValue;
			$members->Id->CssStyle = "";
			$members->Id->CssClass = "";
			$members->Id->ViewCustomAttributes = "";

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

			// first_name_eng
			$members->first_name_eng->ViewValue = $members->first_name_eng->CurrentValue;
			$members->first_name_eng->CssStyle = "";
			$members->first_name_eng->CssClass = "";
			$members->first_name_eng->ViewCustomAttributes = "";

			// last_name_eng
			$members->last_name_eng->ViewValue = $members->last_name_eng->CurrentValue;
			$members->last_name_eng->CssStyle = "";
			$members->last_name_eng->CssClass = "";
			$members->last_name_eng->ViewCustomAttributes = "";

			// username
			$members->username->ViewValue = $members->username->CurrentValue;
			$members->username->CssStyle = "";
			$members->username->CssClass = "";
			$members->username->ViewCustomAttributes = "";

			// password
			$members->password->ViewValue = $members->password->CurrentValue;
			$members->password->CssStyle = "";
			$members->password->CssClass = "";
			$members->password->ViewCustomAttributes = "";

			// phone_cell
			$members->phone_cell->ViewValue = $members->phone_cell->CurrentValue;
			$members->phone_cell->CssStyle = "";
			$members->phone_cell->CssClass = "";
			$members->phone_cell->ViewCustomAttributes = "";

			// phone_home
			$members->phone_home->ViewValue = $members->phone_home->CurrentValue;
			$members->phone_home->CssStyle = "";
			$members->phone_home->CssClass = "";
			$members->phone_home->ViewCustomAttributes = "";

			// email
			$members->zemail->ViewValue = $members->zemail->CurrentValue;
			$members->zemail->CssStyle = "";
			$members->zemail->CssClass = "";
			$members->zemail->ViewCustomAttributes = "";

			// address
			$members->address->ViewValue = $members->address->CurrentValue;
			$members->address->CssStyle = "";
			$members->address->CssClass = "";
			$members->address->ViewCustomAttributes = "";

			// city
			$members->city->ViewValue = $members->city->CurrentValue;
			$members->city->CssStyle = "";
			$members->city->CssClass = "";
			$members->city->ViewCustomAttributes = "";

			// zip
			$members->zip->ViewValue = $members->zip->CurrentValue;
			$members->zip->CssStyle = "";
			$members->zip->CssClass = "";
			$members->zip->ViewCustomAttributes = "";

			// gender
			$members->gender->ViewValue = $members->gender->CurrentValue;
			$members->gender->CssStyle = "";
			$members->gender->CssClass = "";
			$members->gender->ViewCustomAttributes = "";

			// status_student
			$members->status_student->ViewValue = $members->status_student->CurrentValue;
			$members->status_student->CssStyle = "";
			$members->status_student->CssClass = "";
			$members->status_student->ViewCustomAttributes = "";

			// ethnicity_korean
			$members->ethnicity_korean->ViewValue = $members->ethnicity_korean->CurrentValue;
			$members->ethnicity_korean->CssStyle = "";
			$members->ethnicity_korean->CssClass = "";
			$members->ethnicity_korean->ViewCustomAttributes = "";

			// language_korean
			$members->language_korean->ViewValue = $members->language_korean->CurrentValue;
			$members->language_korean->CssStyle = "";
			$members->language_korean->CssClass = "";
			$members->language_korean->ViewCustomAttributes = "";

			// access_level
			$members->access_level->ViewValue = $members->access_level->CurrentValue;
			$members->access_level->CssStyle = "";
			$members->access_level->CssClass = "";
			$members->access_level->ViewCustomAttributes = "";

			// active_member
			$members->active_member->ViewValue = $members->active_member->CurrentValue;
			$members->active_member->CssStyle = "";
			$members->active_member->CssClass = "";
			$members->active_member->ViewCustomAttributes = "";

			// Id
			$members->Id->HrefValue = "";
			$members->Id->TooltipValue = "";

			// first_name
			$members->first_name->HrefValue = "";
			$members->first_name->TooltipValue = "";

			// last_name
			$members->last_name->HrefValue = "";
			$members->last_name->TooltipValue = "";

			// first_name_eng
			$members->first_name_eng->HrefValue = "";
			$members->first_name_eng->TooltipValue = "";

			// last_name_eng
			$members->last_name_eng->HrefValue = "";
			$members->last_name_eng->TooltipValue = "";

			// username
			$members->username->HrefValue = "";
			$members->username->TooltipValue = "";

			// password
			$members->password->HrefValue = "";
			$members->password->TooltipValue = "";

			// phone_cell
			$members->phone_cell->HrefValue = "";
			$members->phone_cell->TooltipValue = "";

			// phone_home
			$members->phone_home->HrefValue = "";
			$members->phone_home->TooltipValue = "";

			// email
			$members->zemail->HrefValue = "";
			$members->zemail->TooltipValue = "";

			// address
			$members->address->HrefValue = "";
			$members->address->TooltipValue = "";

			// city
			$members->city->HrefValue = "";
			$members->city->TooltipValue = "";

			// zip
			$members->zip->HrefValue = "";
			$members->zip->TooltipValue = "";

			// gender
			$members->gender->HrefValue = "";
			$members->gender->TooltipValue = "";

			// status_student
			$members->status_student->HrefValue = "";
			$members->status_student->TooltipValue = "";

			// ethnicity_korean
			$members->ethnicity_korean->HrefValue = "";
			$members->ethnicity_korean->TooltipValue = "";

			// language_korean
			$members->language_korean->HrefValue = "";
			$members->language_korean->TooltipValue = "";

			// access_level
			$members->access_level->HrefValue = "";
			$members->access_level->TooltipValue = "";

			// active_member
			$members->active_member->HrefValue = "";
			$members->active_member->TooltipValue = "";
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
}
?>
