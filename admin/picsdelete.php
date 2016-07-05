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
$pics_delete = new cpics_delete();
$Page =& $pics_delete;

// Page init
$pics_delete->Page_Init();

// Page main
$pics_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pics_delete = new ew_Page("pics_delete");

// page properties
pics_delete.PageID = "delete"; // page ID
pics_delete.FormID = "fpicsdelete"; // form ID
var EW_PAGE_ID = pics_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
pics_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pics_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pics_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $pics_delete->LoadRecordset())
	$pics_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($pics_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$pics_delete->Page_Terminate("picslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pics->TableCaption() ?><br><br>
<a href="<?php echo $pics->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$pics_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="pics">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($pics_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $pics->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $pics->id->FldCaption() ?></td>
		<td valign="top"><?php echo $pics->img->FldCaption() ?></td>
		<td valign="top"><?php echo $pics->width_big->FldCaption() ?></td>
		<td valign="top"><?php echo $pics->height_big->FldCaption() ?></td>
		<td valign="top"><?php echo $pics->width_small->FldCaption() ?></td>
		<td valign="top"><?php echo $pics->height_small->FldCaption() ?></td>
		<td valign="top"><?php echo $pics->hits->FldCaption() ?></td>
		<td valign="top"><?php echo $pics->date_uploaded->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$pics_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$pics_delete->lRecCnt++;

	// Set row properties
	$pics->CssClass = "";
	$pics->CssStyle = "";
	$pics->RowAttrs = array();
	$pics->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$pics_delete->LoadRowValues($rs);

	// Render row
	$pics_delete->RenderRow();
?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td<?php echo $pics->id->CellAttributes() ?>>
<div<?php echo $pics->id->ViewAttributes() ?>><?php echo $pics->id->ListViewValue() ?></div></td>
		<td<?php echo $pics->img->CellAttributes() ?>>
<div<?php echo $pics->img->ViewAttributes() ?>><?php echo $pics->img->ListViewValue() ?></div></td>
		<td<?php echo $pics->width_big->CellAttributes() ?>>
<div<?php echo $pics->width_big->ViewAttributes() ?>><?php echo $pics->width_big->ListViewValue() ?></div></td>
		<td<?php echo $pics->height_big->CellAttributes() ?>>
<div<?php echo $pics->height_big->ViewAttributes() ?>><?php echo $pics->height_big->ListViewValue() ?></div></td>
		<td<?php echo $pics->width_small->CellAttributes() ?>>
<div<?php echo $pics->width_small->ViewAttributes() ?>><?php echo $pics->width_small->ListViewValue() ?></div></td>
		<td<?php echo $pics->height_small->CellAttributes() ?>>
<div<?php echo $pics->height_small->ViewAttributes() ?>><?php echo $pics->height_small->ListViewValue() ?></div></td>
		<td<?php echo $pics->hits->CellAttributes() ?>>
<div<?php echo $pics->hits->ViewAttributes() ?>><?php echo $pics->hits->ListViewValue() ?></div></td>
		<td<?php echo $pics->date_uploaded->CellAttributes() ?>>
<div<?php echo $pics->date_uploaded->ViewAttributes() ?>><?php echo $pics->date_uploaded->ListViewValue() ?></div></td>
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
$pics_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cpics_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'pics';

	// Page object name
	var $PageObjName = 'pics_delete';

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
	function cpics_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (pics)
		$GLOBALS["pics"] = new cpics();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $pics;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$pics->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($pics->id->QueryStringValue))
				$this->Page_Terminate("picslist.php"); // Prevent SQL injection, exit
			$sKey .= $pics->id->QueryStringValue;
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
			$this->Page_Terminate("picslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("picslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in pics class, picsinfo.php

		$pics->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$pics->CurrentAction = $_POST["a_delete"];
		} else {
			$pics->CurrentAction = "I"; // Display record
		}
		switch ($pics->CurrentAction) {
			case "D": // Delete
				$pics->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($pics->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $pics;
		$DeleteRows = TRUE;
		$sWrkFilter = $pics->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in pics class, picsinfo.php

		$pics->CurrentFilter = $sWrkFilter;
		$sSql = $pics->SQL();
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
				$DeleteRows = $pics->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($pics->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($pics->CancelMessage <> "") {
				$this->setMessage($pics->CancelMessage);
				$pics->CancelMessage = "";
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
				$pics->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $pics;

		// Call Recordset Selecting event
		$pics->Recordset_Selecting($pics->CurrentFilter);

		// Load List page SQL
		$sSql = $pics->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$pics->Recordset_Selected($rs);
		return $rs;
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
		// Call Row_Rendering event

		$pics->Row_Rendering();

		// Common render codes for all row types
		// id

		$pics->id->CellCssStyle = ""; $pics->id->CellCssClass = "";
		$pics->id->CellAttrs = array(); $pics->id->ViewAttrs = array(); $pics->id->EditAttrs = array();

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
