<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "gamesinfo.php" ?>
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
$games_view = new cgames_view();
$Page =& $games_view;

// Page init
$games_view->Page_Init();

// Page main
$games_view->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($games->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var games_view = new ew_Page("games_view");

// page properties
games_view.PageID = "view"; // page ID
games_view.FormID = "fgamesview"; // form ID
var EW_PAGE_ID = games_view.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
games_view.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
games_view.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
games_view.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("View") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $games->TableCaption() ?>
<br><br>
<?php if ($games->Export == "") { ?>
<a href="<?php echo $games_view->ListUrl ?>"><?php echo $Language->Phrase("BackToList") ?></a>&nbsp;
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $games_view->AddUrl ?>"><?php echo $Language->Phrase("ViewPageAddLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $games_view->EditUrl ?>"><?php echo $Language->Phrase("ViewPageEditLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $games_view->CopyUrl ?>"><?php echo $Language->Phrase("ViewPageCopyLink") ?></a>&nbsp;
<?php } ?>
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $games_view->DeleteUrl ?>"><?php echo $Language->Phrase("ViewPageDeleteLink") ?></a>&nbsp;
<?php } ?>
<?php } ?>
</span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$games_view->ShowMessage();
?>
<p>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($games->Id->Visible) { // Id ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->Id->FldCaption() ?></td>
		<td<?php echo $games->Id->CellAttributes() ?>>
<div<?php echo $games->Id->ViewAttributes() ?>><?php echo $games->Id->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($games->person1->Visible) { // person1 ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->person1->FldCaption() ?></td>
		<td<?php echo $games->person1->CellAttributes() ?>>
<div<?php echo $games->person1->ViewAttributes() ?>><?php echo $games->person1->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($games->person1_score->Visible) { // person1_score ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->person1_score->FldCaption() ?></td>
		<td<?php echo $games->person1_score->CellAttributes() ?>>
<div<?php echo $games->person1_score->ViewAttributes() ?>><?php echo $games->person1_score->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($games->person2->Visible) { // person2 ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->person2->FldCaption() ?></td>
		<td<?php echo $games->person2->CellAttributes() ?>>
<div<?php echo $games->person2->ViewAttributes() ?>><?php echo $games->person2->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($games->person2_score->Visible) { // person2_score ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->person2_score->FldCaption() ?></td>
		<td<?php echo $games->person2_score->CellAttributes() ?>>
<div<?php echo $games->person2_score->ViewAttributes() ?>><?php echo $games->person2_score->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($games->r_group->Visible) { // r_group ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->r_group->FldCaption() ?></td>
		<td<?php echo $games->r_group->CellAttributes() ?>>
<div<?php echo $games->r_group->ViewAttributes() ?>><?php echo $games->r_group->ViewValue ?></div></td>
	</tr>
<?php } ?>
<?php if ($games->game_date->Visible) { // game_date ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->game_date->FldCaption() ?></td>
		<td<?php echo $games->game_date->CellAttributes() ?>>
<div<?php echo $games->game_date->ViewAttributes() ?>><?php echo $games->game_date->ViewValue ?></div></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<?php if ($games->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$games_view->Page_Terminate();
?>
<?php

//
// Page class
//
class cgames_view {

	// Page ID
	var $PageID = 'view';

	// Table name
	var $TableName = 'games';

	// Page object name
	var $PageObjName = 'games_view';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $games;
		if ($games->UseTokenInUrl) $PageUrl .= "t=" . $games->TableVar . "&"; // Add page token
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
		global $objForm, $games;
		if ($games->UseTokenInUrl) {
			if ($objForm)
				return ($games->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($games->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgames_view() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (games)
		$GLOBALS["games"] = new cgames();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'view', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'games', TRUE);

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
		global $games;

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
		global $Language, $games;
		$sReturnUrl = "";
		$bMatchRecord = FALSE;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET["Id"] <> "") {
				$games->Id->setQueryStringValue($_GET["Id"]);
				$this->arRecKey["Id"] = $games->Id->QueryStringValue;
			} else {
				$sReturnUrl = "gameslist.php"; // Return to list
			}

			// Get action
			$games->CurrentAction = "I"; // Display form
			switch ($games->CurrentAction) {
				case "I": // Get a record to display
					if (!$this->LoadRow()) { // Load record based on key
						$this->setMessage($Language->Phrase("NoRecord")); // Set no record message
						$sReturnUrl = "gameslist.php"; // No matching record, return to list
					}
			}
		} else {
			$sReturnUrl = "gameslist.php"; // Not page request, return to list
		}
		if ($sReturnUrl <> "")
			$this->Page_Terminate($sReturnUrl);

		// Render row
		$games->RowType = EW_ROWTYPE_VIEW;
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $games;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$games->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$games->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $games->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$games->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$games->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$games->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $games;
		$sFilter = $games->KeyFilter();

		// Call Row Selecting event
		$games->Row_Selecting($sFilter);

		// Load SQL based on filter
		$games->CurrentFilter = $sFilter;
		$sSql = $games->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$games->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $games;
		$games->Id->setDbValue($rs->fields('Id'));
		$games->person1->setDbValue($rs->fields('person1'));
		$games->person1_score->setDbValue($rs->fields('person1_score'));
		$games->person2->setDbValue($rs->fields('person2'));
		$games->person2_score->setDbValue($rs->fields('person2_score'));
		$games->r_group->setDbValue($rs->fields('r_group'));
		$games->game_date->setDbValue($rs->fields('game_date'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $games;

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print&" . "Id=" . urlencode($games->Id->CurrentValue);
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html&" . "Id=" . urlencode($games->Id->CurrentValue);
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel&" . "Id=" . urlencode($games->Id->CurrentValue);
		$this->ExportWordUrl = $this->PageUrl() . "export=word&" . "Id=" . urlencode($games->Id->CurrentValue);
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml&" . "Id=" . urlencode($games->Id->CurrentValue);
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv&" . "Id=" . urlencode($games->Id->CurrentValue);
		$this->AddUrl = $games->AddUrl();
		$this->EditUrl = $games->EditUrl();
		$this->CopyUrl = $games->CopyUrl();
		$this->DeleteUrl = $games->DeleteUrl();
		$this->ListUrl = $games->ListUrl();

		// Call Row_Rendering event
		$games->Row_Rendering();

		// Common render codes for all row types
		// Id

		$games->Id->CellCssStyle = ""; $games->Id->CellCssClass = "";
		$games->Id->CellAttrs = array(); $games->Id->ViewAttrs = array(); $games->Id->EditAttrs = array();

		// person1
		$games->person1->CellCssStyle = ""; $games->person1->CellCssClass = "";
		$games->person1->CellAttrs = array(); $games->person1->ViewAttrs = array(); $games->person1->EditAttrs = array();

		// person1_score
		$games->person1_score->CellCssStyle = ""; $games->person1_score->CellCssClass = "";
		$games->person1_score->CellAttrs = array(); $games->person1_score->ViewAttrs = array(); $games->person1_score->EditAttrs = array();

		// person2
		$games->person2->CellCssStyle = ""; $games->person2->CellCssClass = "";
		$games->person2->CellAttrs = array(); $games->person2->ViewAttrs = array(); $games->person2->EditAttrs = array();

		// person2_score
		$games->person2_score->CellCssStyle = ""; $games->person2_score->CellCssClass = "";
		$games->person2_score->CellAttrs = array(); $games->person2_score->ViewAttrs = array(); $games->person2_score->EditAttrs = array();

		// r_group
		$games->r_group->CellCssStyle = ""; $games->r_group->CellCssClass = "";
		$games->r_group->CellAttrs = array(); $games->r_group->ViewAttrs = array(); $games->r_group->EditAttrs = array();

		// game_date
		$games->game_date->CellCssStyle = ""; $games->game_date->CellCssClass = "";
		$games->game_date->CellAttrs = array(); $games->game_date->ViewAttrs = array(); $games->game_date->EditAttrs = array();
		if ($games->RowType == EW_ROWTYPE_VIEW) { // View row

			// Id
			$games->Id->ViewValue = $games->Id->CurrentValue;
			$games->Id->CssStyle = "";
			$games->Id->CssClass = "";
			$games->Id->ViewCustomAttributes = "";

			// person1
			$games->person1->ViewValue = $games->person1->CurrentValue;
			$games->person1->CssStyle = "";
			$games->person1->CssClass = "";
			$games->person1->ViewCustomAttributes = "";

			// person1_score
			$games->person1_score->ViewValue = $games->person1_score->CurrentValue;
			$games->person1_score->CssStyle = "";
			$games->person1_score->CssClass = "";
			$games->person1_score->ViewCustomAttributes = "";

			// person2
			$games->person2->ViewValue = $games->person2->CurrentValue;
			$games->person2->CssStyle = "";
			$games->person2->CssClass = "";
			$games->person2->ViewCustomAttributes = "";

			// person2_score
			$games->person2_score->ViewValue = $games->person2_score->CurrentValue;
			$games->person2_score->CssStyle = "";
			$games->person2_score->CssClass = "";
			$games->person2_score->ViewCustomAttributes = "";

			// r_group
			$games->r_group->ViewValue = $games->r_group->CurrentValue;
			$games->r_group->CssStyle = "";
			$games->r_group->CssClass = "";
			$games->r_group->ViewCustomAttributes = "";

			// game_date
			$games->game_date->ViewValue = $games->game_date->CurrentValue;
			$games->game_date->ViewValue = ew_FormatDateTime($games->game_date->ViewValue, 5);
			$games->game_date->CssStyle = "";
			$games->game_date->CssClass = "";
			$games->game_date->ViewCustomAttributes = "";

			// Id
			$games->Id->HrefValue = "";
			$games->Id->TooltipValue = "";

			// person1
			$games->person1->HrefValue = "";
			$games->person1->TooltipValue = "";

			// person1_score
			$games->person1_score->HrefValue = "";
			$games->person1_score->TooltipValue = "";

			// person2
			$games->person2->HrefValue = "";
			$games->person2->TooltipValue = "";

			// person2_score
			$games->person2_score->HrefValue = "";
			$games->person2_score->TooltipValue = "";

			// r_group
			$games->r_group->HrefValue = "";
			$games->r_group->TooltipValue = "";

			// game_date
			$games->game_date->HrefValue = "";
			$games->game_date->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($games->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$games->Row_Rendered();
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
