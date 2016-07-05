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
$groups_edit = new cgroups_edit();
$Page =& $groups_edit;

// Page init
$groups_edit->Page_Init();

// Page main
$groups_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var groups_edit = new ew_Page("groups_edit");

// page properties
groups_edit.PageID = "edit"; // page ID
groups_edit.FormID = "fgroupsedit"; // form ID
var EW_PAGE_ID = groups_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
groups_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_Id"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($groups->Id->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_inactive"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($groups->inactive->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_points"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($groups->points->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_hide_list"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($groups->hide_list->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_total_wins"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($groups->total_wins->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_total_losses"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($groups->total_losses->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_current_wins"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($groups->current_wins->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_current_losses"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($groups->current_losses->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
groups_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
groups_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
groups_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $groups->TableCaption() ?><br><br>
<a href="<?php echo $groups->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$groups_edit->ShowMessage();
?>
<form name="fgroupsedit" id="fgroupsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return groups_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="groups">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($groups->Id->Visible) { // Id ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->Id->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $groups->Id->CellAttributes() ?>><span id="el_Id">
<div<?php echo $groups->Id->ViewAttributes() ?>><?php echo $groups->Id->EditValue ?></div><input type="hidden" name="x_Id" id="x_Id" value="<?php echo ew_HtmlEncode($groups->Id->CurrentValue) ?>">
</span><?php echo $groups->Id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($groups->nickname_kor->Visible) { // nickname_kor ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->nickname_kor->FldCaption() ?></td>
		<td<?php echo $groups->nickname_kor->CellAttributes() ?>><span id="el_nickname_kor">
<input type="text" name="x_nickname_kor" id="x_nickname_kor" title="<?php echo $groups->nickname_kor->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $groups->nickname_kor->EditValue ?>"<?php echo $groups->nickname_kor->EditAttributes() ?>>
</span><?php echo $groups->nickname_kor->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($groups->nickname_eng->Visible) { // nickname_eng ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->nickname_eng->FldCaption() ?></td>
		<td<?php echo $groups->nickname_eng->CellAttributes() ?>><span id="el_nickname_eng">
<input type="text" name="x_nickname_eng" id="x_nickname_eng" title="<?php echo $groups->nickname_eng->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $groups->nickname_eng->EditValue ?>"<?php echo $groups->nickname_eng->EditAttributes() ?>>
</span><?php echo $groups->nickname_eng->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($groups->inactive->Visible) { // inactive ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->inactive->FldCaption() ?></td>
		<td<?php echo $groups->inactive->CellAttributes() ?>><span id="el_inactive">
<input type="text" name="x_inactive" id="x_inactive" title="<?php echo $groups->inactive->FldTitle() ?>" size="30" value="<?php echo $groups->inactive->EditValue ?>"<?php echo $groups->inactive->EditAttributes() ?>>
</span><?php echo $groups->inactive->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($groups->r_group->Visible) { // r_group ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->r_group->FldCaption() ?></td>
		<td<?php echo $groups->r_group->CellAttributes() ?>><span id="el_r_group">
<input type="text" name="x_r_group" id="x_r_group" title="<?php echo $groups->r_group->FldTitle() ?>" size="30" maxlength="3" value="<?php echo $groups->r_group->EditValue ?>"<?php echo $groups->r_group->EditAttributes() ?>>
</span><?php echo $groups->r_group->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($groups->points->Visible) { // points ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->points->FldCaption() ?></td>
		<td<?php echo $groups->points->CellAttributes() ?>><span id="el_points">
<input type="text" name="x_points" id="x_points" title="<?php echo $groups->points->FldTitle() ?>" size="30" value="<?php echo $groups->points->EditValue ?>"<?php echo $groups->points->EditAttributes() ?>>
</span><?php echo $groups->points->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($groups->hide_list->Visible) { // hide_list ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->hide_list->FldCaption() ?></td>
		<td<?php echo $groups->hide_list->CellAttributes() ?>><span id="el_hide_list">
<input type="text" name="x_hide_list" id="x_hide_list" title="<?php echo $groups->hide_list->FldTitle() ?>" size="30" value="<?php echo $groups->hide_list->EditValue ?>"<?php echo $groups->hide_list->EditAttributes() ?>>
</span><?php echo $groups->hide_list->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($groups->total_wins->Visible) { // total_wins ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->total_wins->FldCaption() ?></td>
		<td<?php echo $groups->total_wins->CellAttributes() ?>><span id="el_total_wins">
<input type="text" name="x_total_wins" id="x_total_wins" title="<?php echo $groups->total_wins->FldTitle() ?>" size="30" value="<?php echo $groups->total_wins->EditValue ?>"<?php echo $groups->total_wins->EditAttributes() ?>>
</span><?php echo $groups->total_wins->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($groups->total_losses->Visible) { // total_losses ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->total_losses->FldCaption() ?></td>
		<td<?php echo $groups->total_losses->CellAttributes() ?>><span id="el_total_losses">
<input type="text" name="x_total_losses" id="x_total_losses" title="<?php echo $groups->total_losses->FldTitle() ?>" size="30" value="<?php echo $groups->total_losses->EditValue ?>"<?php echo $groups->total_losses->EditAttributes() ?>>
</span><?php echo $groups->total_losses->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($groups->current_wins->Visible) { // current_wins ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->current_wins->FldCaption() ?></td>
		<td<?php echo $groups->current_wins->CellAttributes() ?>><span id="el_current_wins">
<input type="text" name="x_current_wins" id="x_current_wins" title="<?php echo $groups->current_wins->FldTitle() ?>" size="30" value="<?php echo $groups->current_wins->EditValue ?>"<?php echo $groups->current_wins->EditAttributes() ?>>
</span><?php echo $groups->current_wins->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($groups->current_losses->Visible) { // current_losses ?>
	<tr<?php echo $groups->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $groups->current_losses->FldCaption() ?></td>
		<td<?php echo $groups->current_losses->CellAttributes() ?>><span id="el_current_losses">
<input type="text" name="x_current_losses" id="x_current_losses" title="<?php echo $groups->current_losses->FldTitle() ?>" size="30" value="<?php echo $groups->current_losses->EditValue ?>"<?php echo $groups->current_losses->EditAttributes() ?>>
</span><?php echo $groups->current_losses->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("EditBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$groups_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cgroups_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'groups';

	// Page object name
	var $PageObjName = 'groups_edit';

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
	function cgroups_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (groups)
		$GLOBALS["groups"] = new cgroups();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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

		// Create form object
		$objForm = new cFormObj();

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
	var $sDbMasterFilter;
	var $sDbDetailFilter;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $groups;

		// Load key from QueryString
		if (@$_GET["Id"] <> "")
			$groups->Id->setQueryStringValue($_GET["Id"]);
		if (@$_POST["a_edit"] <> "") {
			$groups->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$groups->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$groups->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$groups->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($groups->Id->CurrentValue == "")
			$this->Page_Terminate("groupslist.php"); // Invalid key, return to list
		switch ($groups->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("groupslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$groups->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $groups->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$groups->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$groups->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $groups;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $groups;
		$groups->Id->setFormValue($objForm->GetValue("x_Id"));
		$groups->nickname_kor->setFormValue($objForm->GetValue("x_nickname_kor"));
		$groups->nickname_eng->setFormValue($objForm->GetValue("x_nickname_eng"));
		$groups->inactive->setFormValue($objForm->GetValue("x_inactive"));
		$groups->r_group->setFormValue($objForm->GetValue("x_r_group"));
		$groups->points->setFormValue($objForm->GetValue("x_points"));
		$groups->hide_list->setFormValue($objForm->GetValue("x_hide_list"));
		$groups->total_wins->setFormValue($objForm->GetValue("x_total_wins"));
		$groups->total_losses->setFormValue($objForm->GetValue("x_total_losses"));
		$groups->current_wins->setFormValue($objForm->GetValue("x_current_wins"));
		$groups->current_losses->setFormValue($objForm->GetValue("x_current_losses"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $groups;
		$this->LoadRow();
		$groups->Id->CurrentValue = $groups->Id->FormValue;
		$groups->nickname_kor->CurrentValue = $groups->nickname_kor->FormValue;
		$groups->nickname_eng->CurrentValue = $groups->nickname_eng->FormValue;
		$groups->inactive->CurrentValue = $groups->inactive->FormValue;
		$groups->r_group->CurrentValue = $groups->r_group->FormValue;
		$groups->points->CurrentValue = $groups->points->FormValue;
		$groups->hide_list->CurrentValue = $groups->hide_list->FormValue;
		$groups->total_wins->CurrentValue = $groups->total_wins->FormValue;
		$groups->total_losses->CurrentValue = $groups->total_losses->FormValue;
		$groups->current_wins->CurrentValue = $groups->current_wins->FormValue;
		$groups->current_losses->CurrentValue = $groups->current_losses->FormValue;
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
		} elseif ($groups->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// Id
			$groups->Id->EditCustomAttributes = "";
			$groups->Id->EditValue = $groups->Id->CurrentValue;
			$groups->Id->CssStyle = "";
			$groups->Id->CssClass = "";
			$groups->Id->ViewCustomAttributes = "";

			// nickname_kor
			$groups->nickname_kor->EditCustomAttributes = "";
			$groups->nickname_kor->EditValue = ew_HtmlEncode($groups->nickname_kor->CurrentValue);

			// nickname_eng
			$groups->nickname_eng->EditCustomAttributes = "";
			$groups->nickname_eng->EditValue = ew_HtmlEncode($groups->nickname_eng->CurrentValue);

			// inactive
			$groups->inactive->EditCustomAttributes = "";
			$groups->inactive->EditValue = ew_HtmlEncode($groups->inactive->CurrentValue);

			// r_group
			$groups->r_group->EditCustomAttributes = "";
			$groups->r_group->EditValue = ew_HtmlEncode($groups->r_group->CurrentValue);

			// points
			$groups->points->EditCustomAttributes = "";
			$groups->points->EditValue = ew_HtmlEncode($groups->points->CurrentValue);

			// hide_list
			$groups->hide_list->EditCustomAttributes = "";
			$groups->hide_list->EditValue = ew_HtmlEncode($groups->hide_list->CurrentValue);

			// total_wins
			$groups->total_wins->EditCustomAttributes = "";
			$groups->total_wins->EditValue = ew_HtmlEncode($groups->total_wins->CurrentValue);

			// total_losses
			$groups->total_losses->EditCustomAttributes = "";
			$groups->total_losses->EditValue = ew_HtmlEncode($groups->total_losses->CurrentValue);

			// current_wins
			$groups->current_wins->EditCustomAttributes = "";
			$groups->current_wins->EditValue = ew_HtmlEncode($groups->current_wins->CurrentValue);

			// current_losses
			$groups->current_losses->EditCustomAttributes = "";
			$groups->current_losses->EditValue = ew_HtmlEncode($groups->current_losses->CurrentValue);

			// Edit refer script
			// Id

			$groups->Id->HrefValue = "";

			// nickname_kor
			$groups->nickname_kor->HrefValue = "";

			// nickname_eng
			$groups->nickname_eng->HrefValue = "";

			// inactive
			$groups->inactive->HrefValue = "";

			// r_group
			$groups->r_group->HrefValue = "";

			// points
			$groups->points->HrefValue = "";

			// hide_list
			$groups->hide_list->HrefValue = "";

			// total_wins
			$groups->total_wins->HrefValue = "";

			// total_losses
			$groups->total_losses->HrefValue = "";

			// current_wins
			$groups->current_wins->HrefValue = "";

			// current_losses
			$groups->current_losses->HrefValue = "";
		}

		// Call Row Rendered event
		if ($groups->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$groups->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $groups;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($groups->Id->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $groups->Id->FldErrMsg();
		}
		if (!ew_CheckInteger($groups->inactive->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $groups->inactive->FldErrMsg();
		}
		if (!ew_CheckInteger($groups->points->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $groups->points->FldErrMsg();
		}
		if (!ew_CheckInteger($groups->hide_list->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $groups->hide_list->FldErrMsg();
		}
		if (!ew_CheckInteger($groups->total_wins->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $groups->total_wins->FldErrMsg();
		}
		if (!ew_CheckInteger($groups->total_losses->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $groups->total_losses->FldErrMsg();
		}
		if (!ew_CheckInteger($groups->current_wins->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $groups->current_wins->FldErrMsg();
		}
		if (!ew_CheckInteger($groups->current_losses->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $groups->current_losses->FldErrMsg();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $sFormCustomError;
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $conn, $Security, $Language, $groups;
		$sFilter = $groups->KeyFilter();
		$groups->CurrentFilter = $sFilter;
		$sSql = $groups->SQL();
		$conn->raiseErrorFn = 'ew_ErrorFn';
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$EditRow = FALSE; // Update Failed
		} else {

			// Save old values
			$rsold =& $rs->fields;
			$rsnew = array();

			// Id
			// nickname_kor

			$groups->nickname_kor->SetDbValueDef($rsnew, $groups->nickname_kor->CurrentValue, NULL, FALSE);

			// nickname_eng
			$groups->nickname_eng->SetDbValueDef($rsnew, $groups->nickname_eng->CurrentValue, NULL, FALSE);

			// inactive
			$groups->inactive->SetDbValueDef($rsnew, $groups->inactive->CurrentValue, NULL, FALSE);

			// r_group
			$groups->r_group->SetDbValueDef($rsnew, $groups->r_group->CurrentValue, NULL, FALSE);

			// points
			$groups->points->SetDbValueDef($rsnew, $groups->points->CurrentValue, NULL, FALSE);

			// hide_list
			$groups->hide_list->SetDbValueDef($rsnew, $groups->hide_list->CurrentValue, NULL, FALSE);

			// total_wins
			$groups->total_wins->SetDbValueDef($rsnew, $groups->total_wins->CurrentValue, NULL, FALSE);

			// total_losses
			$groups->total_losses->SetDbValueDef($rsnew, $groups->total_losses->CurrentValue, NULL, FALSE);

			// current_wins
			$groups->current_wins->SetDbValueDef($rsnew, $groups->current_wins->CurrentValue, NULL, FALSE);

			// current_losses
			$groups->current_losses->SetDbValueDef($rsnew, $groups->current_losses->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $groups->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($groups->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($groups->CancelMessage <> "") {
					$this->setMessage($groups->CancelMessage);
					$groups->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$groups->Row_Updated($rsold, $rsnew);
		$rs->Close();
		return $EditRow;
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
}
?>
