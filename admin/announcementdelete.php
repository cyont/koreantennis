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
$announcement_delete = new cannouncement_delete();
$Page =& $announcement_delete;

// Page init
$announcement_delete->Page_Init();

// Page main
$announcement_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var announcement_delete = new ew_Page("announcement_delete");

// page properties
announcement_delete.PageID = "delete"; // page ID
announcement_delete.FormID = "fannouncementdelete"; // form ID
var EW_PAGE_ID = announcement_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
announcement_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
announcement_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
announcement_delete.ValidateRequired = false; // no JavaScript validation
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
<?php

// Load records for display
if ($rs = $announcement_delete->LoadRecordset())
	$announcement_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($announcement_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$announcement_delete->Page_Terminate("announcementlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $announcement->TableCaption() ?><br><br>
<a href="<?php echo $announcement->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$announcement_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="announcement">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($announcement_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $announcement->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $announcement->id->FldCaption() ?></td>
		<td valign="top"><?php echo $announcement->lid->FldCaption() ?></td>
		<td valign="top"><?php echo $announcement->title->FldCaption() ?></td>
		<td valign="top"><?php echo $announcement->active->FldCaption() ?></td>
		<td valign="top"><?php echo $announcement->koreantennis->FldCaption() ?></td>
		<td valign="top"><?php echo $announcement->timestamp->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$announcement_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$announcement_delete->lRecCnt++;

	// Set row properties
	$announcement->CssClass = "";
	$announcement->CssStyle = "";
	$announcement->RowAttrs = array();
	$announcement->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$announcement_delete->LoadRowValues($rs);

	// Render row
	$announcement_delete->RenderRow();
?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td<?php echo $announcement->id->CellAttributes() ?>>
<div<?php echo $announcement->id->ViewAttributes() ?>><?php echo $announcement->id->ListViewValue() ?></div></td>
		<td<?php echo $announcement->lid->CellAttributes() ?>>
<div<?php echo $announcement->lid->ViewAttributes() ?>><?php echo $announcement->lid->ListViewValue() ?></div></td>
		<td<?php echo $announcement->title->CellAttributes() ?>>
<div<?php echo $announcement->title->ViewAttributes() ?>><?php echo $announcement->title->ListViewValue() ?></div></td>
		<td<?php echo $announcement->active->CellAttributes() ?>>
<div<?php echo $announcement->active->ViewAttributes() ?>><?php echo $announcement->active->ListViewValue() ?></div></td>
		<td<?php echo $announcement->koreantennis->CellAttributes() ?>>
<div<?php echo $announcement->koreantennis->ViewAttributes() ?>><?php echo $announcement->koreantennis->ListViewValue() ?></div></td>
		<td<?php echo $announcement->timestamp->CellAttributes() ?>>
<div<?php echo $announcement->timestamp->ViewAttributes() ?>><?php echo $announcement->timestamp->ListViewValue() ?></div></td>
	</tr>
<?php
	$rs->MoveNext();
}
$rs->Close();
?>
</tbody>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="Action" id="Action" value="<?php echo ew_BtnCaption($Language->Phrase("DeleteBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$announcement_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cannouncement_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'announcement';

	// Page object name
	var $PageObjName = 'announcement_delete';

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
	function cannouncement_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (announcement)
		$GLOBALS["announcement"] = new cannouncement();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $announcement;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$announcement->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($announcement->id->QueryStringValue))
				$this->Page_Terminate("announcementlist.php"); // Prevent SQL injection, exit
			$sKey .= $announcement->id->QueryStringValue;
		} else {
			$bSingleDelete = FALSE;
		}
		if ($bSingleDelete) {
			$nKeySelected = 1; // Set up key selected count
			$this->arRecKeys[0] = $sKey;
		} else {
			if (isset($_POST["key_m"])) { // Key in form
				$nKeySelected = count($_POST["key_m"]); // Set up key selected count
				$this->arRecKeys = ew_StripSlashes($_POST["key_m"]);
			}
		}
		if ($nKeySelected <= 0)
			$this->Page_Terminate("announcementlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("announcementlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in announcement class, announcementinfo.php

		$announcement->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$announcement->CurrentAction = $_POST["a_delete"];
		} else {
			$announcement->CurrentAction = "I"; // Display record
		}
		switch ($announcement->CurrentAction) {
			case "D": // Delete
				$announcement->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($announcement->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $announcement;
		$DeleteRows = TRUE;
		$sWrkFilter = $announcement->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in announcement class, announcementinfo.php

		$announcement->CurrentFilter = $sWrkFilter;
		$sSql = $announcement->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$conn->BeginTrans();

		// Clone old rows
		$rsold = ($rs) ? $rs->GetRows() : array();
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $announcement->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($announcement->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($announcement->CancelMessage <> "") {
				$this->setMessage($announcement->CancelMessage);
				$announcement->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$announcement->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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
