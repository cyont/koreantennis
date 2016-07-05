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
$admin_delete = new cadmin_delete();
$Page =& $admin_delete;

// Page init
$admin_delete->Page_Init();

// Page main
$admin_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var admin_delete = new ew_Page("admin_delete");

// page properties
admin_delete.PageID = "delete"; // page ID
admin_delete.FormID = "fadmindelete"; // form ID
var EW_PAGE_ID = admin_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
admin_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
admin_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
admin_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $admin_delete->LoadRecordset())
	$admin_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($admin_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$admin_delete->Page_Terminate("adminlist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $admin->TableCaption() ?><br><br>
<a href="<?php echo $admin->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$admin_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="admin">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($admin_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $admin->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $admin->id->FldCaption() ?></td>
		<td valign="top"><?php echo $admin->admin_1->FldCaption() ?></td>
		<td valign="top"><?php echo $admin->pass->FldCaption() ?></td>
		<td valign="top"><?php echo $admin->zemail->FldCaption() ?></td>
		<td valign="top"><?php echo $admin->hits->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$admin_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$admin_delete->lRecCnt++;

	// Set row properties
	$admin->CssClass = "";
	$admin->CssStyle = "";
	$admin->RowAttrs = array();
	$admin->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$admin_delete->LoadRowValues($rs);

	// Render row
	$admin_delete->RenderRow();
?>
	<tr<?php echo $admin->RowAttributes() ?>>
		<td<?php echo $admin->id->CellAttributes() ?>>
<div<?php echo $admin->id->ViewAttributes() ?>><?php echo $admin->id->ListViewValue() ?></div></td>
		<td<?php echo $admin->admin_1->CellAttributes() ?>>
<div<?php echo $admin->admin_1->ViewAttributes() ?>><?php echo $admin->admin_1->ListViewValue() ?></div></td>
		<td<?php echo $admin->pass->CellAttributes() ?>>
<div<?php echo $admin->pass->ViewAttributes() ?>><?php echo $admin->pass->ListViewValue() ?></div></td>
		<td<?php echo $admin->zemail->CellAttributes() ?>>
<div<?php echo $admin->zemail->ViewAttributes() ?>><?php echo $admin->zemail->ListViewValue() ?></div></td>
		<td<?php echo $admin->hits->CellAttributes() ?>>
<div<?php echo $admin->hits->ViewAttributes() ?>><?php echo $admin->hits->ListViewValue() ?></div></td>
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
$admin_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cadmin_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'admin';

	// Page object name
	var $PageObjName = 'admin_delete';

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
	function cadmin_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (admin)
		$GLOBALS["admin"] = new cadmin();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $admin;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$admin->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($admin->id->QueryStringValue))
				$this->Page_Terminate("adminlist.php"); // Prevent SQL injection, exit
			$sKey .= $admin->id->QueryStringValue;
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
			$this->Page_Terminate("adminlist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("adminlist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in admin class, admininfo.php

		$admin->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$admin->CurrentAction = $_POST["a_delete"];
		} else {
			$admin->CurrentAction = "I"; // Display record
		}
		switch ($admin->CurrentAction) {
			case "D": // Delete
				$admin->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($admin->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $admin;
		$DeleteRows = TRUE;
		$sWrkFilter = $admin->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in admin class, admininfo.php

		$admin->CurrentFilter = $sWrkFilter;
		$sSql = $admin->SQL();
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
				$DeleteRows = $admin->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($admin->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($admin->CancelMessage <> "") {
				$this->setMessage($admin->CancelMessage);
				$admin->CancelMessage = "";
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
				$admin->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $admin;

		// Call Recordset Selecting event
		$admin->Recordset_Selecting($admin->CurrentFilter);

		// Load List page SQL
		$sSql = $admin->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$admin->Recordset_Selected($rs);
		return $rs;
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
