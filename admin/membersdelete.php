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
$members_delete = new cmembers_delete();
$Page =& $members_delete;

// Page init
$members_delete->Page_Init();

// Page main
$members_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var members_delete = new ew_Page("members_delete");

// page properties
members_delete.PageID = "delete"; // page ID
members_delete.FormID = "fmembersdelete"; // form ID
var EW_PAGE_ID = members_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
members_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
members_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
members_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $members_delete->LoadRecordset())
	$members_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($members_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$members_delete->Page_Terminate("memberslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $members->TableCaption() ?><br><br>
<a href="<?php echo $members->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$members_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="members">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($members_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $members->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $members->Id->FldCaption() ?></td>
		<td valign="top"><?php echo $members->first_name->FldCaption() ?></td>
		<td valign="top"><?php echo $members->last_name->FldCaption() ?></td>
		<td valign="top"><?php echo $members->first_name_eng->FldCaption() ?></td>
		<td valign="top"><?php echo $members->last_name_eng->FldCaption() ?></td>
		<td valign="top"><?php echo $members->username->FldCaption() ?></td>
		<td valign="top"><?php echo $members->password->FldCaption() ?></td>
		<td valign="top"><?php echo $members->phone_cell->FldCaption() ?></td>
		<td valign="top"><?php echo $members->phone_home->FldCaption() ?></td>
		<td valign="top"><?php echo $members->zemail->FldCaption() ?></td>
		<td valign="top"><?php echo $members->address->FldCaption() ?></td>
		<td valign="top"><?php echo $members->city->FldCaption() ?></td>
		<td valign="top"><?php echo $members->zip->FldCaption() ?></td>
		<td valign="top"><?php echo $members->gender->FldCaption() ?></td>
		<td valign="top"><?php echo $members->status_student->FldCaption() ?></td>
		<td valign="top"><?php echo $members->ethnicity_korean->FldCaption() ?></td>
		<td valign="top"><?php echo $members->language_korean->FldCaption() ?></td>
		<td valign="top"><?php echo $members->access_level->FldCaption() ?></td>
		<td valign="top"><?php echo $members->active_member->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$members_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$members_delete->lRecCnt++;

	// Set row properties
	$members->CssClass = "";
	$members->CssStyle = "";
	$members->RowAttrs = array();
	$members->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$members_delete->LoadRowValues($rs);

	// Render row
	$members_delete->RenderRow();
?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td<?php echo $members->Id->CellAttributes() ?>>
<div<?php echo $members->Id->ViewAttributes() ?>><?php echo $members->Id->ListViewValue() ?></div></td>
		<td<?php echo $members->first_name->CellAttributes() ?>>
<div<?php echo $members->first_name->ViewAttributes() ?>><?php echo $members->first_name->ListViewValue() ?></div></td>
		<td<?php echo $members->last_name->CellAttributes() ?>>
<div<?php echo $members->last_name->ViewAttributes() ?>><?php echo $members->last_name->ListViewValue() ?></div></td>
		<td<?php echo $members->first_name_eng->CellAttributes() ?>>
<div<?php echo $members->first_name_eng->ViewAttributes() ?>><?php echo $members->first_name_eng->ListViewValue() ?></div></td>
		<td<?php echo $members->last_name_eng->CellAttributes() ?>>
<div<?php echo $members->last_name_eng->ViewAttributes() ?>><?php echo $members->last_name_eng->ListViewValue() ?></div></td>
		<td<?php echo $members->username->CellAttributes() ?>>
<div<?php echo $members->username->ViewAttributes() ?>><?php echo $members->username->ListViewValue() ?></div></td>
		<td<?php echo $members->password->CellAttributes() ?>>
<div<?php echo $members->password->ViewAttributes() ?>><?php echo $members->password->ListViewValue() ?></div></td>
		<td<?php echo $members->phone_cell->CellAttributes() ?>>
<div<?php echo $members->phone_cell->ViewAttributes() ?>><?php echo $members->phone_cell->ListViewValue() ?></div></td>
		<td<?php echo $members->phone_home->CellAttributes() ?>>
<div<?php echo $members->phone_home->ViewAttributes() ?>><?php echo $members->phone_home->ListViewValue() ?></div></td>
		<td<?php echo $members->zemail->CellAttributes() ?>>
<div<?php echo $members->zemail->ViewAttributes() ?>><?php echo $members->zemail->ListViewValue() ?></div></td>
		<td<?php echo $members->address->CellAttributes() ?>>
<div<?php echo $members->address->ViewAttributes() ?>><?php echo $members->address->ListViewValue() ?></div></td>
		<td<?php echo $members->city->CellAttributes() ?>>
<div<?php echo $members->city->ViewAttributes() ?>><?php echo $members->city->ListViewValue() ?></div></td>
		<td<?php echo $members->zip->CellAttributes() ?>>
<div<?php echo $members->zip->ViewAttributes() ?>><?php echo $members->zip->ListViewValue() ?></div></td>
		<td<?php echo $members->gender->CellAttributes() ?>>
<div<?php echo $members->gender->ViewAttributes() ?>><?php echo $members->gender->ListViewValue() ?></div></td>
		<td<?php echo $members->status_student->CellAttributes() ?>>
<div<?php echo $members->status_student->ViewAttributes() ?>><?php echo $members->status_student->ListViewValue() ?></div></td>
		<td<?php echo $members->ethnicity_korean->CellAttributes() ?>>
<div<?php echo $members->ethnicity_korean->ViewAttributes() ?>><?php echo $members->ethnicity_korean->ListViewValue() ?></div></td>
		<td<?php echo $members->language_korean->CellAttributes() ?>>
<div<?php echo $members->language_korean->ViewAttributes() ?>><?php echo $members->language_korean->ListViewValue() ?></div></td>
		<td<?php echo $members->access_level->CellAttributes() ?>>
<div<?php echo $members->access_level->ViewAttributes() ?>><?php echo $members->access_level->ListViewValue() ?></div></td>
		<td<?php echo $members->active_member->CellAttributes() ?>>
<div<?php echo $members->active_member->ViewAttributes() ?>><?php echo $members->active_member->ListViewValue() ?></div></td>
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
$members_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembers_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'members';

	// Page object name
	var $PageObjName = 'members_delete';

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
	function cmembers_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (members)
		$GLOBALS["members"] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
	var $lTotalRecs = 0;
	var $lRecCnt;
	var $arRecKeys = array();

	//
	// Page main
	//
	function Page_Main() {
		global $Language, $members;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["Id"] <> "") {
			$members->Id->setQueryStringValue($_GET["Id"]);
			if (!is_numeric($members->Id->QueryStringValue))
				$this->Page_Terminate("memberslist.php"); // Prevent SQL injection, exit
			$sKey .= $members->Id->QueryStringValue;
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
			$this->Page_Terminate("memberslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("memberslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`Id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in members class, membersinfo.php

		$members->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$members->CurrentAction = $_POST["a_delete"];
		} else {
			$members->CurrentAction = "I"; // Display record
		}
		switch ($members->CurrentAction) {
			case "D": // Delete
				$members->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($members->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $members;
		$DeleteRows = TRUE;
		$sWrkFilter = $members->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in members class, membersinfo.php

		$members->CurrentFilter = $sWrkFilter;
		$sSql = $members->SQL();
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
				$DeleteRows = $members->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($members->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($members->CancelMessage <> "") {
				$this->setMessage($members->CancelMessage);
				$members->CancelMessage = "";
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
				$members->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
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
