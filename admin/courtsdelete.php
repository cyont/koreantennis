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
$courts_delete = new ccourts_delete();
$Page =& $courts_delete;

// Page init
$courts_delete->Page_Init();

// Page main
$courts_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var courts_delete = new ew_Page("courts_delete");

// page properties
courts_delete.PageID = "delete"; // page ID
courts_delete.FormID = "fcourtsdelete"; // form ID
var EW_PAGE_ID = courts_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
courts_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
courts_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
courts_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $courts_delete->LoadRecordset())
	$courts_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($courts_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$courts_delete->Page_Terminate("courtslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $courts->TableCaption() ?><br><br>
<a href="<?php echo $courts->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$courts_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="courts">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($courts_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $courts->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $courts->id->FldCaption() ?></td>
		<td valign="top"><?php echo $courts->name->FldCaption() ?></td>
		<td valign="top"><?php echo $courts->region->FldCaption() ?></td>
		<td valign="top"><?php echo $courts->location->FldCaption() ?></td>
		<td valign="top"><?php echo $courts->address->FldCaption() ?></td>
		<td valign="top"><?php echo $courts->zip->FldCaption() ?></td>
		<td valign="top"><?php echo $courts->city->FldCaption() ?></td>
		<td valign="top"><?php echo $courts->court_num->FldCaption() ?></td>
		<td valign="top"><?php echo $courts->lights->FldCaption() ?></td>
		<td valign="top"><?php echo $courts->maintenance->FldCaption() ?></td>
		<td valign="top"><?php echo $courts->website->FldCaption() ?></td>
		<td valign="top"><?php echo $courts->phone->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$courts_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$courts_delete->lRecCnt++;

	// Set row properties
	$courts->CssClass = "";
	$courts->CssStyle = "";
	$courts->RowAttrs = array();
	$courts->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$courts_delete->LoadRowValues($rs);

	// Render row
	$courts_delete->RenderRow();
?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td<?php echo $courts->id->CellAttributes() ?>>
<div<?php echo $courts->id->ViewAttributes() ?>><?php echo $courts->id->ListViewValue() ?></div></td>
		<td<?php echo $courts->name->CellAttributes() ?>>
<div<?php echo $courts->name->ViewAttributes() ?>><?php echo $courts->name->ListViewValue() ?></div></td>
		<td<?php echo $courts->region->CellAttributes() ?>>
<div<?php echo $courts->region->ViewAttributes() ?>><?php echo $courts->region->ListViewValue() ?></div></td>
		<td<?php echo $courts->location->CellAttributes() ?>>
<div<?php echo $courts->location->ViewAttributes() ?>><?php echo $courts->location->ListViewValue() ?></div></td>
		<td<?php echo $courts->address->CellAttributes() ?>>
<div<?php echo $courts->address->ViewAttributes() ?>><?php echo $courts->address->ListViewValue() ?></div></td>
		<td<?php echo $courts->zip->CellAttributes() ?>>
<div<?php echo $courts->zip->ViewAttributes() ?>><?php echo $courts->zip->ListViewValue() ?></div></td>
		<td<?php echo $courts->city->CellAttributes() ?>>
<div<?php echo $courts->city->ViewAttributes() ?>><?php echo $courts->city->ListViewValue() ?></div></td>
		<td<?php echo $courts->court_num->CellAttributes() ?>>
<div<?php echo $courts->court_num->ViewAttributes() ?>><?php echo $courts->court_num->ListViewValue() ?></div></td>
		<td<?php echo $courts->lights->CellAttributes() ?>>
<div<?php echo $courts->lights->ViewAttributes() ?>><?php echo $courts->lights->ListViewValue() ?></div></td>
		<td<?php echo $courts->maintenance->CellAttributes() ?>>
<div<?php echo $courts->maintenance->ViewAttributes() ?>><?php echo $courts->maintenance->ListViewValue() ?></div></td>
		<td<?php echo $courts->website->CellAttributes() ?>>
<div<?php echo $courts->website->ViewAttributes() ?>><?php echo $courts->website->ListViewValue() ?></div></td>
		<td<?php echo $courts->phone->CellAttributes() ?>>
<div<?php echo $courts->phone->ViewAttributes() ?>><?php echo $courts->phone->ListViewValue() ?></div></td>
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
$courts_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccourts_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'courts';

	// Page object name
	var $PageObjName = 'courts_delete';

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
	function ccourts_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (courts)
		$GLOBALS["courts"] = new ccourts();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $courts;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$courts->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($courts->id->QueryStringValue))
				$this->Page_Terminate("courtslist.php"); // Prevent SQL injection, exit
			$sKey .= $courts->id->QueryStringValue;
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
			$this->Page_Terminate("courtslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("courtslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in courts class, courtsinfo.php

		$courts->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$courts->CurrentAction = $_POST["a_delete"];
		} else {
			$courts->CurrentAction = "I"; // Display record
		}
		switch ($courts->CurrentAction) {
			case "D": // Delete
				$courts->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($courts->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $courts;
		$DeleteRows = TRUE;
		$sWrkFilter = $courts->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in courts class, courtsinfo.php

		$courts->CurrentFilter = $sWrkFilter;
		$sSql = $courts->SQL();
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
				$DeleteRows = $courts->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($courts->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($courts->CancelMessage <> "") {
				$this->setMessage($courts->CancelMessage);
				$courts->CancelMessage = "";
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
				$courts->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $courts;

		// Call Recordset Selecting event
		$courts->Recordset_Selecting($courts->CurrentFilter);

		// Load List page SQL
		$sSql = $courts->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$courts->Recordset_Selected($rs);
		return $rs;
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
