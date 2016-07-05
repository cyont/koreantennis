<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "groupsinfo.php" ?>
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
$groups_delete = new cgroups_delete();
$Page =& $groups_delete;

// Page init
$groups_delete->Page_Init();

// Page main
$groups_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var groups_delete = new ew_Page("groups_delete");

// page properties
groups_delete.PageID = "delete"; // page ID
groups_delete.FormID = "fgroupsdelete"; // form ID
var EW_PAGE_ID = groups_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
groups_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
groups_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
groups_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $groups_delete->LoadRecordset())
	$groups_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($groups_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$groups_delete->Page_Terminate("groupslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $groups->TableCaption() ?><br><br>
<a href="<?php echo $groups->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$groups_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="groups">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($groups_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $groups->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $groups->Id->FldCaption() ?></td>
		<td valign="top"><?php echo $groups->nickname_kor->FldCaption() ?></td>
		<td valign="top"><?php echo $groups->nickname_eng->FldCaption() ?></td>
		<td valign="top"><?php echo $groups->inactive->FldCaption() ?></td>
		<td valign="top"><?php echo $groups->r_group->FldCaption() ?></td>
		<td valign="top"><?php echo $groups->points->FldCaption() ?></td>
		<td valign="top"><?php echo $groups->hide_list->FldCaption() ?></td>
		<td valign="top"><?php echo $groups->total_wins->FldCaption() ?></td>
		<td valign="top"><?php echo $groups->total_losses->FldCaption() ?></td>
		<td valign="top"><?php echo $groups->current_wins->FldCaption() ?></td>
		<td valign="top"><?php echo $groups->current_losses->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$groups_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$groups_delete->lRecCnt++;

	// Set row properties
	$groups->CssClass = "";
	$groups->CssStyle = "";
	$groups->RowAttrs = array();
	$groups->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$groups_delete->LoadRowValues($rs);

	// Render row
	$groups_delete->RenderRow();
?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td<?php echo $groups->Id->CellAttributes() ?>>
<div<?php echo $groups->Id->ViewAttributes() ?>><?php echo $groups->Id->ListViewValue() ?></div></td>
		<td<?php echo $groups->nickname_kor->CellAttributes() ?>>
<div<?php echo $groups->nickname_kor->ViewAttributes() ?>><?php echo $groups->nickname_kor->ListViewValue() ?></div></td>
		<td<?php echo $groups->nickname_eng->CellAttributes() ?>>
<div<?php echo $groups->nickname_eng->ViewAttributes() ?>><?php echo $groups->nickname_eng->ListViewValue() ?></div></td>
		<td<?php echo $groups->inactive->CellAttributes() ?>>
<div<?php echo $groups->inactive->ViewAttributes() ?>><?php echo $groups->inactive->ListViewValue() ?></div></td>
		<td<?php echo $groups->r_group->CellAttributes() ?>>
<div<?php echo $groups->r_group->ViewAttributes() ?>><?php echo $groups->r_group->ListViewValue() ?></div></td>
		<td<?php echo $groups->points->CellAttributes() ?>>
<div<?php echo $groups->points->ViewAttributes() ?>><?php echo $groups->points->ListViewValue() ?></div></td>
		<td<?php echo $groups->hide_list->CellAttributes() ?>>
<div<?php echo $groups->hide_list->ViewAttributes() ?>><?php echo $groups->hide_list->ListViewValue() ?></div></td>
		<td<?php echo $groups->total_wins->CellAttributes() ?>>
<div<?php echo $groups->total_wins->ViewAttributes() ?>><?php echo $groups->total_wins->ListViewValue() ?></div></td>
		<td<?php echo $groups->total_losses->CellAttributes() ?>>
<div<?php echo $groups->total_losses->ViewAttributes() ?>><?php echo $groups->total_losses->ListViewValue() ?></div></td>
		<td<?php echo $groups->current_wins->CellAttributes() ?>>
<div<?php echo $groups->current_wins->ViewAttributes() ?>><?php echo $groups->current_wins->ListViewValue() ?></div></td>
		<td<?php echo $groups->current_losses->CellAttributes() ?>>
<div<?php echo $groups->current_losses->ViewAttributes() ?>><?php echo $groups->current_losses->ListViewValue() ?></div></td>
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
$groups_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cgroups_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'groups';

	// Page object name
	var $PageObjName = 'groups_delete';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $groups;
		if ($groups->UseTokenInUrl) $PageUrl .= "t=" . $groups->TableVar . "&"; // Add page token
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
		global $objForm, $groups;
		if ($groups->UseTokenInUrl) {
			if ($objForm)
				return ($groups->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($groups->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgroups_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (groups)
		$GLOBALS["groups"] = new cgroups();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'groups', TRUE);

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
		global $groups;

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
		global $Language, $groups;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["Id"] <> "") {
			$groups->Id->setQueryStringValue($_GET["Id"]);
			if (!is_numeric($groups->Id->QueryStringValue))
				$this->Page_Terminate("groupslist.php"); // Prevent SQL injection, exit
			$sKey .= $groups->Id->QueryStringValue;
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
			$this->Page_Terminate("groupslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("groupslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`Id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in groups class, groupsinfo.php

		$groups->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$groups->CurrentAction = $_POST["a_delete"];
		} else {
			$groups->CurrentAction = "I"; // Display record
		}
		switch ($groups->CurrentAction) {
			case "D": // Delete
				$groups->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($groups->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $groups;
		$DeleteRows = TRUE;
		$sWrkFilter = $groups->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in groups class, groupsinfo.php

		$groups->CurrentFilter = $sWrkFilter;
		$sSql = $groups->SQL();
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
				$DeleteRows = $groups->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= EW_COMPOSITE_KEY_SEPARATOR;
				$sThisKey .= $row['Id'];
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$DeleteRows = $conn->Execute($groups->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($groups->CancelMessage <> "") {
				$this->setMessage($groups->CancelMessage);
				$groups->CancelMessage = "";
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
				$groups->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $groups;

		// Call Recordset Selecting event
		$groups->Recordset_Selecting($groups->CurrentFilter);

		// Load List page SQL
		$sSql = $groups->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$groups->Recordset_Selected($rs);
		return $rs;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $groups;
		$sFilter = $groups->KeyFilter();

		// Call Row Selecting event
		$groups->Row_Selecting($sFilter);

		// Load SQL based on filter
		$groups->CurrentFilter = $sFilter;
		$sSql = $groups->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$groups->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $groups;
		$groups->Id->setDbValue($rs->fields('Id'));
		$groups->nickname_kor->setDbValue($rs->fields('nickname_kor'));
		$groups->nickname_eng->setDbValue($rs->fields('nickname_eng'));
		$groups->inactive->setDbValue($rs->fields('inactive'));
		$groups->r_group->setDbValue($rs->fields('r_group'));
		$groups->points->setDbValue($rs->fields('points'));
		$groups->hide_list->setDbValue($rs->fields('hide_list'));
		$groups->total_wins->setDbValue($rs->fields('total_wins'));
		$groups->total_losses->setDbValue($rs->fields('total_losses'));
		$groups->current_wins->setDbValue($rs->fields('current_wins'));
		$groups->current_losses->setDbValue($rs->fields('current_losses'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $groups;

		// Initialize URLs
		// Call Row_Rendering event

		$groups->Row_Rendering();

		// Common render codes for all row types
		// Id

		$groups->Id->CellCssStyle = ""; $groups->Id->CellCssClass = "";
		$groups->Id->CellAttrs = array(); $groups->Id->ViewAttrs = array(); $groups->Id->EditAttrs = array();

		// nickname_kor
		$groups->nickname_kor->CellCssStyle = ""; $groups->nickname_kor->CellCssClass = "";
		$groups->nickname_kor->CellAttrs = array(); $groups->nickname_kor->ViewAttrs = array(); $groups->nickname_kor->EditAttrs = array();

		// nickname_eng
		$groups->nickname_eng->CellCssStyle = ""; $groups->nickname_eng->CellCssClass = "";
		$groups->nickname_eng->CellAttrs = array(); $groups->nickname_eng->ViewAttrs = array(); $groups->nickname_eng->EditAttrs = array();

		// inactive
		$groups->inactive->CellCssStyle = ""; $groups->inactive->CellCssClass = "";
		$groups->inactive->CellAttrs = array(); $groups->inactive->ViewAttrs = array(); $groups->inactive->EditAttrs = array();

		// r_group
		$groups->r_group->CellCssStyle = ""; $groups->r_group->CellCssClass = "";
		$groups->r_group->CellAttrs = array(); $groups->r_group->ViewAttrs = array(); $groups->r_group->EditAttrs = array();

		// points
		$groups->points->CellCssStyle = ""; $groups->points->CellCssClass = "";
		$groups->points->CellAttrs = array(); $groups->points->ViewAttrs = array(); $groups->points->EditAttrs = array();

		// hide_list
		$groups->hide_list->CellCssStyle = ""; $groups->hide_list->CellCssClass = "";
		$groups->hide_list->CellAttrs = array(); $groups->hide_list->ViewAttrs = array(); $groups->hide_list->EditAttrs = array();

		// total_wins
		$groups->total_wins->CellCssStyle = ""; $groups->total_wins->CellCssClass = "";
		$groups->total_wins->CellAttrs = array(); $groups->total_wins->ViewAttrs = array(); $groups->total_wins->EditAttrs = array();

		// total_losses
		$groups->total_losses->CellCssStyle = ""; $groups->total_losses->CellCssClass = "";
		$groups->total_losses->CellAttrs = array(); $groups->total_losses->ViewAttrs = array(); $groups->total_losses->EditAttrs = array();

		// current_wins
		$groups->current_wins->CellCssStyle = ""; $groups->current_wins->CellCssClass = "";
		$groups->current_wins->CellAttrs = array(); $groups->current_wins->ViewAttrs = array(); $groups->current_wins->EditAttrs = array();

		// current_losses
		$groups->current_losses->CellCssStyle = ""; $groups->current_losses->CellCssClass = "";
		$groups->current_losses->CellAttrs = array(); $groups->current_losses->ViewAttrs = array(); $groups->current_losses->EditAttrs = array();
		if ($groups->RowType == EW_ROWTYPE_VIEW) { // View row

			// Id
			$groups->Id->ViewValue = $groups->Id->CurrentValue;
			$groups->Id->CssStyle = "";
			$groups->Id->CssClass = "";
			$groups->Id->ViewCustomAttributes = "";

			// nickname_kor
			$groups->nickname_kor->ViewValue = $groups->nickname_kor->CurrentValue;
			$groups->nickname_kor->CssStyle = "";
			$groups->nickname_kor->CssClass = "";
			$groups->nickname_kor->ViewCustomAttributes = "";

			// nickname_eng
			$groups->nickname_eng->ViewValue = $groups->nickname_eng->CurrentValue;
			$groups->nickname_eng->CssStyle = "";
			$groups->nickname_eng->CssClass = "";
			$groups->nickname_eng->ViewCustomAttributes = "";

			// inactive
			$groups->inactive->ViewValue = $groups->inactive->CurrentValue;
			$groups->inactive->CssStyle = "";
			$groups->inactive->CssClass = "";
			$groups->inactive->ViewCustomAttributes = "";

			// r_group
			$groups->r_group->ViewValue = $groups->r_group->CurrentValue;
			$groups->r_group->CssStyle = "";
			$groups->r_group->CssClass = "";
			$groups->r_group->ViewCustomAttributes = "";

			// points
			$groups->points->ViewValue = $groups->points->CurrentValue;
			$groups->points->CssStyle = "";
			$groups->points->CssClass = "";
			$groups->points->ViewCustomAttributes = "";

			// hide_list
			$groups->hide_list->ViewValue = $groups->hide_list->CurrentValue;
			$groups->hide_list->CssStyle = "";
			$groups->hide_list->CssClass = "";
			$groups->hide_list->ViewCustomAttributes = "";

			// total_wins
			$groups->total_wins->ViewValue = $groups->total_wins->CurrentValue;
			$groups->total_wins->CssStyle = "";
			$groups->total_wins->CssClass = "";
			$groups->total_wins->ViewCustomAttributes = "";

			// total_losses
			$groups->total_losses->ViewValue = $groups->total_losses->CurrentValue;
			$groups->total_losses->CssStyle = "";
			$groups->total_losses->CssClass = "";
			$groups->total_losses->ViewCustomAttributes = "";

			// current_wins
			$groups->current_wins->ViewValue = $groups->current_wins->CurrentValue;
			$groups->current_wins->CssStyle = "";
			$groups->current_wins->CssClass = "";
			$groups->current_wins->ViewCustomAttributes = "";

			// current_losses
			$groups->current_losses->ViewValue = $groups->current_losses->CurrentValue;
			$groups->current_losses->CssStyle = "";
			$groups->current_losses->CssClass = "";
			$groups->current_losses->ViewCustomAttributes = "";

			// Id
			$groups->Id->HrefValue = "";
			$groups->Id->TooltipValue = "";

			// nickname_kor
			$groups->nickname_kor->HrefValue = "";
			$groups->nickname_kor->TooltipValue = "";

			// nickname_eng
			$groups->nickname_eng->HrefValue = "";
			$groups->nickname_eng->TooltipValue = "";

			// inactive
			$groups->inactive->HrefValue = "";
			$groups->inactive->TooltipValue = "";

			// r_group
			$groups->r_group->HrefValue = "";
			$groups->r_group->TooltipValue = "";

			// points
			$groups->points->HrefValue = "";
			$groups->points->TooltipValue = "";

			// hide_list
			$groups->hide_list->HrefValue = "";
			$groups->hide_list->TooltipValue = "";

			// total_wins
			$groups->total_wins->HrefValue = "";
			$groups->total_wins->TooltipValue = "";

			// total_losses
			$groups->total_losses->HrefValue = "";
			$groups->total_losses->TooltipValue = "";

			// current_wins
			$groups->current_wins->HrefValue = "";
			$groups->current_wins->TooltipValue = "";

			// current_losses
			$groups->current_losses->HrefValue = "";
			$groups->current_losses->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($groups->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$groups->Row_Rendered();
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
