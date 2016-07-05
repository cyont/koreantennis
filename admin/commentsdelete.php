<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "commentsinfo.php" ?>
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
$comments_delete = new ccomments_delete();
$Page =& $comments_delete;

// Page init
$comments_delete->Page_Init();

// Page main
$comments_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var comments_delete = new ew_Page("comments_delete");

// page properties
comments_delete.PageID = "delete"; // page ID
comments_delete.FormID = "fcommentsdelete"; // form ID
var EW_PAGE_ID = comments_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
comments_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
comments_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comments_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $comments_delete->LoadRecordset())
	$comments_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($comments_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$comments_delete->Page_Terminate("commentslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $comments->TableCaption() ?><br><br>
<a href="<?php echo $comments->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$comments_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="comments">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($comments_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $comments->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $comments->id->FldCaption() ?></td>
		<td valign="top"><?php echo $comments->imgid->FldCaption() ?></td>
		<td valign="top"><?php echo $comments->name2->FldCaption() ?></td>
		<td valign="top"><?php echo $comments->date->FldCaption() ?></td>
		<td valign="top"><?php echo $comments->status->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$comments_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$comments_delete->lRecCnt++;

	// Set row properties
	$comments->CssClass = "";
	$comments->CssStyle = "";
	$comments->RowAttrs = array();
	$comments->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$comments_delete->LoadRowValues($rs);

	// Render row
	$comments_delete->RenderRow();
?>
	<tr<?php echo $comments->RowAttributes() ?>>
		<td<?php echo $comments->id->CellAttributes() ?>>
<div<?php echo $comments->id->ViewAttributes() ?>><?php echo $comments->id->ListViewValue() ?></div></td>
		<td<?php echo $comments->imgid->CellAttributes() ?>>
<div<?php echo $comments->imgid->ViewAttributes() ?>><?php echo $comments->imgid->ListViewValue() ?></div></td>
		<td<?php echo $comments->name2->CellAttributes() ?>>
<div<?php echo $comments->name2->ViewAttributes() ?>><?php echo $comments->name2->ListViewValue() ?></div></td>
		<td<?php echo $comments->date->CellAttributes() ?>>
<div<?php echo $comments->date->ViewAttributes() ?>><?php echo $comments->date->ListViewValue() ?></div></td>
		<td<?php echo $comments->status->CellAttributes() ?>>
<div<?php echo $comments->status->ViewAttributes() ?>><?php echo $comments->status->ListViewValue() ?></div></td>
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
$comments_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class ccomments_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'comments';

	// Page object name
	var $PageObjName = 'comments_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $comments;
		if ($comments->UseTokenInUrl) $PageUrl .= "t=" . $comments->TableVar . "&"; // Add page token
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
		global $objForm, $comments;
		if ($comments->UseTokenInUrl) {
			if ($objForm)
				return ($comments->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($comments->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccomments_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (comments)
		$GLOBALS["comments"] = new ccomments();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'comments', TRUE);

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
		global $comments;

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
		global $Language, $comments;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["id"] <> "") {
			$comments->id->setQueryStringValue($_GET["id"]);
			if (!is_numeric($comments->id->QueryStringValue))
				$this->Page_Terminate("commentslist.php"); // Prevent SQL injection, exit
			$sKey .= $comments->id->QueryStringValue;
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
			$this->Page_Terminate("commentslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("commentslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in comments class, commentsinfo.php

		$comments->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$comments->CurrentAction = $_POST["a_delete"];
		} else {
			$comments->CurrentAction = "I"; // Display record
		}
		switch ($comments->CurrentAction) {
			case "D": // Delete
				$comments->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($comments->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $comments;
		$DeleteRows = TRUE;
		$sWrkFilter = $comments->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in comments class, commentsinfo.php

		$comments->CurrentFilter = $sWrkFilter;
		$sSql = $comments->SQL();
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
				$DeleteRows = $comments->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($comments->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($comments->CancelMessage <> "") {
				$this->setMessage($comments->CancelMessage);
				$comments->CancelMessage = "";
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
				$comments->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $comments;

		// Call Recordset Selecting event
		$comments->Recordset_Selecting($comments->CurrentFilter);

		// Load List page SQL
		$sSql = $comments->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$comments->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $comments;
		$sFilter = $comments->KeyFilter();

		// Call Row Selecting event
		$comments->Row_Selecting($sFilter);

		// Load SQL based on filter
		$comments->CurrentFilter = $sFilter;
		$sSql = $comments->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$comments->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $comments;
		$comments->id->setDbValue($rs->fields('id'));
		$comments->imgid->setDbValue($rs->fields('imgid'));
		$comments->name2->setDbValue($rs->fields('name2'));
		$comments->comment2->setDbValue($rs->fields('comment2'));
		$comments->date->setDbValue($rs->fields('date'));
		$comments->status->setDbValue($rs->fields('status'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $comments;

		// Initialize URLs
		// Call Row_Rendering event

		$comments->Row_Rendering();

		// Common render codes for all row types
		// id

		$comments->id->CellCssStyle = ""; $comments->id->CellCssClass = "";
		$comments->id->CellAttrs = array(); $comments->id->ViewAttrs = array(); $comments->id->EditAttrs = array();

		// imgid
		$comments->imgid->CellCssStyle = ""; $comments->imgid->CellCssClass = "";
		$comments->imgid->CellAttrs = array(); $comments->imgid->ViewAttrs = array(); $comments->imgid->EditAttrs = array();

		// name2
		$comments->name2->CellCssStyle = ""; $comments->name2->CellCssClass = "";
		$comments->name2->CellAttrs = array(); $comments->name2->ViewAttrs = array(); $comments->name2->EditAttrs = array();

		// date
		$comments->date->CellCssStyle = ""; $comments->date->CellCssClass = "";
		$comments->date->CellAttrs = array(); $comments->date->ViewAttrs = array(); $comments->date->EditAttrs = array();

		// status
		$comments->status->CellCssStyle = ""; $comments->status->CellCssClass = "";
		$comments->status->CellAttrs = array(); $comments->status->ViewAttrs = array(); $comments->status->EditAttrs = array();
		if ($comments->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$comments->id->ViewValue = $comments->id->CurrentValue;
			$comments->id->CssStyle = "";
			$comments->id->CssClass = "";
			$comments->id->ViewCustomAttributes = "";

			// imgid
			$comments->imgid->ViewValue = $comments->imgid->CurrentValue;
			$comments->imgid->CssStyle = "";
			$comments->imgid->CssClass = "";
			$comments->imgid->ViewCustomAttributes = "";

			// name2
			$comments->name2->ViewValue = $comments->name2->CurrentValue;
			$comments->name2->CssStyle = "";
			$comments->name2->CssClass = "";
			$comments->name2->ViewCustomAttributes = "";

			// date
			$comments->date->ViewValue = $comments->date->CurrentValue;
			$comments->date->CssStyle = "";
			$comments->date->CssClass = "";
			$comments->date->ViewCustomAttributes = "";

			// status
			$comments->status->ViewValue = $comments->status->CurrentValue;
			$comments->status->CssStyle = "";
			$comments->status->CssClass = "";
			$comments->status->ViewCustomAttributes = "";

			// id
			$comments->id->HrefValue = "";
			$comments->id->TooltipValue = "";

			// imgid
			$comments->imgid->HrefValue = "";
			$comments->imgid->TooltipValue = "";

			// name2
			$comments->name2->HrefValue = "";
			$comments->name2->TooltipValue = "";

			// date
			$comments->date->HrefValue = "";
			$comments->date->TooltipValue = "";

			// status
			$comments->status->HrefValue = "";
			$comments->status->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($comments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$comments->Row_Rendered();
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
