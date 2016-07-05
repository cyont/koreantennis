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
$announcement_edit = new cannouncement_edit();
$Page =& $announcement_edit;

// Page init
$announcement_edit->Page_Init();

// Page main
$announcement_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var announcement_edit = new ew_Page("announcement_edit");

// page properties
announcement_edit.PageID = "edit"; // page ID
announcement_edit.FormID = "fannouncementedit"; // form ID
var EW_PAGE_ID = announcement_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
announcement_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_lid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($announcement->lid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_active"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($announcement->active->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_koreantennis"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($announcement->koreantennis->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_timestamp"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($announcement->timestamp->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
announcement_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
announcement_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
announcement_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $announcement->TableCaption() ?><br><br>
<a href="<?php echo $announcement->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$announcement_edit->ShowMessage();
?>
<form name="fannouncementedit" id="fannouncementedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return announcement_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="announcement">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($announcement->id->Visible) { // id ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->id->FldCaption() ?></td>
		<td<?php echo $announcement->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $announcement->id->ViewAttributes() ?>><?php echo $announcement->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($announcement->id->CurrentValue) ?>">
</span><?php echo $announcement->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($announcement->lid->Visible) { // lid ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->lid->FldCaption() ?></td>
		<td<?php echo $announcement->lid->CellAttributes() ?>><span id="el_lid">
        <input type="radio" name="x_lid" id="x_lid" value="21" <?php if ($announcement->lid->EditValue == 21) { ?> checked="checked" <?php } ?> /> English&nbsp;&nbsp;&nbsp;&nbsp;
		<input type="radio" name="x_lid" id="x_lid" value="44" <?php if ($announcement->lid->EditValue == 44) { ?> checked="checked" <?php } ?>/> Korean

<!--<input type="text" name="x_lid" id="x_lid" title="<?php echo $announcement->lid->FldTitle() ?>" size="30" value="<?php echo $announcement->lid->EditValue ?>"<?php echo $announcement->lid->EditAttributes() ?>>-->
</span><?php echo $announcement->lid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($announcement->title->Visible) { // title ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->title->FldCaption() ?></td>
		<td<?php echo $announcement->title->CellAttributes() ?>><span id="el_title">
<input type="text" name="x_title" id="x_title" title="<?php echo $announcement->title->FldTitle() ?>" size="80" maxlength="255" value="<?php echo $announcement->title->EditValue ?>"<?php echo $announcement->title->EditAttributes() ?>>
</span><?php echo $announcement->title->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($announcement->announcement_1->Visible) { // announcement ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->announcement_1->FldCaption() ?></td>
		<td<?php echo $announcement->announcement_1->CellAttributes() ?>><span id="el_announcement_1">
<textarea name="x_announcement_1" id="x_announcement_1" title="<?php echo $announcement->announcement_1->FldTitle() ?>" cols="80" rows="10"<?php echo $announcement->announcement_1->EditAttributes() ?>><?php echo $announcement->announcement_1->EditValue ?></textarea>
</span><?php echo $announcement->announcement_1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($announcement->active->Visible) { // active ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->active->FldCaption() ?></td>
		<td<?php echo $announcement->active->CellAttributes() ?>><span id="el_active">
        <input type="radio" name="x_active" id="x_active" value="1" <?php if ($announcement->active->EditValue == 1) { ?> checked="checked" <?php } ?> /> Active&nbsp;&nbsp;&nbsp;&nbsp;
   		<input type="radio" name="x_active" id="x_active" value="0" <?php if ($announcement->active->EditValue == 0) { ?> checked="checked" <?php } ?> /> Not Active

<!--<input type="text" name="x_active" id="x_active" title="<?php echo $announcement->active->FldTitle() ?>" size="30" value="<?php echo $announcement->active->EditValue ?>"<?php echo $announcement->active->EditAttributes() ?>>-->
</span><?php echo $announcement->active->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($announcement->koreantennis->Visible) { // koreantennis ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->koreantennis->FldCaption() ?></td>
		<td<?php echo $announcement->koreantennis->CellAttributes() ?>><span id="el_koreantennis">
<input type="text" name="x_koreantennis" id="x_koreantennis" title="<?php echo $announcement->koreantennis->FldTitle() ?>" size="30" value="<?php echo $announcement->koreantennis->EditValue ?>"<?php echo $announcement->koreantennis->EditAttributes() ?>>
</span><?php echo $announcement->koreantennis->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($announcement->timestamp->Visible) { // timestamp ?>
	<tr<?php echo $announcement->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $announcement->timestamp->FldCaption() ?></td>
		<td<?php echo $announcement->timestamp->CellAttributes() ?>><span id="el_timestamp">
<input type="text" name="x_timestamp" id="x_timestamp" title="<?php echo $announcement->timestamp->FldTitle() ?>" value="<?php echo date('n/j/Y h:i:s', strtotime($_SESSION['announce_time'])); ?>">
</span><?php echo $announcement->timestamp->CustomMsg ?></td>



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
$announcement_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cannouncement_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'announcement';

	// Page object name
	var $PageObjName = 'announcement_edit';

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
	function cannouncement_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (announcement)
		$GLOBALS["announcement"] = new cannouncement();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		global $objForm, $Language, $gsFormError, $announcement;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$announcement->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$announcement->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$announcement->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$announcement->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$announcement->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($announcement->id->CurrentValue == "")
			$this->Page_Terminate("announcementlist.php"); // Invalid key, return to list
		switch ($announcement->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("announcementlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$announcement->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $announcement->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$announcement->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$announcement->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $announcement;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $announcement;
		$announcement->id->setFormValue($objForm->GetValue("x_id"));
		$announcement->lid->setFormValue($objForm->GetValue("x_lid"));
		$announcement->title->setFormValue($objForm->GetValue("x_title"));
		$announcement->announcement_1->setFormValue($objForm->GetValue("x_announcement_1"));
		$announcement->active->setFormValue($objForm->GetValue("x_active"));
		$announcement->koreantennis->setFormValue($objForm->GetValue("x_koreantennis"));
		$announcement->timestamp->setFormValue($objForm->GetValue("x_timestamp"));
		$announcement->timestamp->CurrentValue = ew_UnFormatDateTime($announcement->timestamp->CurrentValue, 6);
		// $_SESSION['announce_time'] = $announcement->timestamp->CurrentValue;
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $announcement;
		$this->LoadRow();
		$announcement->id->CurrentValue = $announcement->id->FormValue;
		$announcement->lid->CurrentValue = $announcement->lid->FormValue;
		$announcement->title->CurrentValue = $announcement->title->FormValue;
		$announcement->announcement_1->CurrentValue = $announcement->announcement_1->FormValue;
		$announcement->active->CurrentValue = $announcement->active->FormValue;
		$announcement->koreantennis->CurrentValue = $announcement->koreantennis->FormValue;
		$announcement->timestamp->CurrentValue = $announcement->timestamp->FormValue;
		$announcement->timestamp->CurrentValue = ew_UnFormatDateTime($announcement->timestamp->CurrentValue, 6);
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
		$_SESSION['announce_time'] = $rs->fields('timestamp');
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

		// announcement
		$announcement->announcement_1->CellCssStyle = ""; $announcement->announcement_1->CellCssClass = "";
		$announcement->announcement_1->CellAttrs = array(); $announcement->announcement_1->ViewAttrs = array(); $announcement->announcement_1->EditAttrs = array();

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

			// announcement
			$announcement->announcement_1->ViewValue = $announcement->announcement_1->CurrentValue;
			$announcement->announcement_1->CssStyle = "";
			$announcement->announcement_1->CssClass = "";
			$announcement->announcement_1->ViewCustomAttributes = "";

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

			// announcement
			$announcement->announcement_1->HrefValue = "";
			$announcement->announcement_1->TooltipValue = "";

			// active
			$announcement->active->HrefValue = "";
			$announcement->active->TooltipValue = "";

			// koreantennis
			$announcement->koreantennis->HrefValue = "";
			$announcement->koreantennis->TooltipValue = "";

			// timestamp
			$announcement->timestamp->HrefValue = "";
			$announcement->timestamp->TooltipValue = "";
		} elseif ($announcement->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$announcement->id->EditCustomAttributes = "";
			$announcement->id->EditValue = $announcement->id->CurrentValue;
			$announcement->id->CssStyle = "";
			$announcement->id->CssClass = "";
			$announcement->id->ViewCustomAttributes = "";

			// lid
			$announcement->lid->EditCustomAttributes = "";
			$announcement->lid->EditValue = ew_HtmlEncode($announcement->lid->CurrentValue);

			// title
			$announcement->title->EditCustomAttributes = "";
			$announcement->title->EditValue = ew_HtmlEncode($announcement->title->CurrentValue);

			// announcement
			$announcement->announcement_1->EditCustomAttributes = "";
			$announcement->announcement_1->EditValue = ew_HtmlEncode($announcement->announcement_1->CurrentValue);

			// active
			$announcement->active->EditCustomAttributes = "";
			$announcement->active->EditValue = ew_HtmlEncode($announcement->active->CurrentValue);

			// koreantennis
			$announcement->koreantennis->EditCustomAttributes = "";
			$announcement->koreantennis->EditValue = ew_HtmlEncode($announcement->koreantennis->CurrentValue);

			// timestamp
			$announcement->timestamp->EditCustomAttributes = "";
			$announcement->timestamp->EditValue = ew_HtmlEncode(ew_FormatDateTime($announcement->timestamp->CurrentValue, 6));

			// Edit refer script
			// id

			$announcement->id->HrefValue = "";

			// lid
			$announcement->lid->HrefValue = "";

			// title
			$announcement->title->HrefValue = "";

			// announcement
			$announcement->announcement_1->HrefValue = "";

			// active
			$announcement->active->HrefValue = "";

			// koreantennis
			$announcement->koreantennis->HrefValue = "";

			// timestamp
			$announcement->timestamp->HrefValue = "";
		}

		// Call Row Rendered event
		if ($announcement->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$announcement->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $announcement;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($announcement->lid->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $announcement->lid->FldErrMsg();
		}
		if (!ew_CheckInteger($announcement->active->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $announcement->active->FldErrMsg();
		}
		if (!ew_CheckInteger($announcement->koreantennis->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $announcement->koreantennis->FldErrMsg();
		}
		if (!ew_CheckUSDate($announcement->timestamp->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $announcement->timestamp->FldErrMsg();
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
		global $conn, $Security, $Language, $announcement;
		$sFilter = $announcement->KeyFilter();
		$announcement->CurrentFilter = $sFilter;
		$sSql = $announcement->SQL();
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

			// lid
			$announcement->lid->SetDbValueDef($rsnew, $announcement->lid->CurrentValue, NULL, FALSE);

			// title
			$announcement->title->SetDbValueDef($rsnew, $announcement->title->CurrentValue, NULL, FALSE);

			// announcement
			$announcement->announcement_1->SetDbValueDef($rsnew, $announcement->announcement_1->CurrentValue, NULL, FALSE);

			// active
			$announcement->active->SetDbValueDef($rsnew, $announcement->active->CurrentValue, NULL, FALSE);

			// koreantennis
			$announcement->koreantennis->SetDbValueDef($rsnew, $announcement->koreantennis->CurrentValue, NULL, FALSE);

			// timestamp
			$announcement->timestamp->SetDbValueDef($rsnew, ew_UnFormatDateTime($announcement->timestamp->CurrentValue, 6, FALSE), NULL);

			// Call Row Updating event
			$bUpdateRow = $announcement->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($announcement->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($announcement->CancelMessage <> "") {
					$this->setMessage($announcement->CancelMessage);
					$announcement->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$announcement->Row_Updated($rsold, $rsnew);
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
