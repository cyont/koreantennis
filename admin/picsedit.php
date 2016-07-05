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
$pics_edit = new cpics_edit();
$Page =& $pics_edit;

// Page init
$pics_edit->Page_Init();

// Page main
$pics_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var pics_edit = new ew_Page("pics_edit");

// page properties
pics_edit.PageID = "edit"; // page ID
pics_edit.FormID = "fpicsedit"; // form ID
var EW_PAGE_ID = pics_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
pics_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_caption"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pics->caption->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_descc"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pics->descc->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_img"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pics->img->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_width_big"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pics->width_big->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_height_big"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pics->height_big->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_width_small"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pics->width_small->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_height_small"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pics->height_small->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_hits"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pics->hits->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_date_uploaded"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($pics->date_uploaded->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_date_uploaded"];
		if (elm && !ew_CheckUSDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($pics->date_uploaded->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
pics_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
pics_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
pics_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $pics->TableCaption() ?><br><br>
<a href="<?php echo $pics->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$pics_edit->ShowMessage();
?>
<form name="fpicsedit" id="fpicsedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return pics_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="pics">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($pics->id->Visible) { // id ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->id->FldCaption() ?></td>
		<td<?php echo $pics->id->CellAttributes() ?>><span id="el_id">
<div<?php echo $pics->id->ViewAttributes() ?>><?php echo $pics->id->EditValue ?></div><input type="hidden" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($pics->id->CurrentValue) ?>">
</span><?php echo $pics->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pics->caption->Visible) { // caption ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->caption->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pics->caption->CellAttributes() ?>><span id="el_caption">
<textarea name="x_caption" id="x_caption" title="<?php echo $pics->caption->FldTitle() ?>" cols="35" rows="4"<?php echo $pics->caption->EditAttributes() ?>><?php echo $pics->caption->EditValue ?></textarea>
</span><?php echo $pics->caption->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pics->descc->Visible) { // descc ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->descc->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pics->descc->CellAttributes() ?>><span id="el_descc">
<textarea name="x_descc" id="x_descc" title="<?php echo $pics->descc->FldTitle() ?>" cols="35" rows="4"<?php echo $pics->descc->EditAttributes() ?>><?php echo $pics->descc->EditValue ?></textarea>
</span><?php echo $pics->descc->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pics->img->Visible) { // img ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->img->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pics->img->CellAttributes() ?>><span id="el_img">
<input type="text" name="x_img" id="x_img" title="<?php echo $pics->img->FldTitle() ?>" size="30" maxlength="190" value="<?php echo $pics->img->EditValue ?>"<?php echo $pics->img->EditAttributes() ?>>
</span><?php echo $pics->img->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pics->width_big->Visible) { // width_big ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->width_big->FldCaption() ?></td>
		<td<?php echo $pics->width_big->CellAttributes() ?>><span id="el_width_big">
<input type="text" name="x_width_big" id="x_width_big" title="<?php echo $pics->width_big->FldTitle() ?>" size="30" value="<?php echo $pics->width_big->EditValue ?>"<?php echo $pics->width_big->EditAttributes() ?>>
</span><?php echo $pics->width_big->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pics->height_big->Visible) { // height_big ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->height_big->FldCaption() ?></td>
		<td<?php echo $pics->height_big->CellAttributes() ?>><span id="el_height_big">
<input type="text" name="x_height_big" id="x_height_big" title="<?php echo $pics->height_big->FldTitle() ?>" size="30" value="<?php echo $pics->height_big->EditValue ?>"<?php echo $pics->height_big->EditAttributes() ?>>
</span><?php echo $pics->height_big->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pics->width_small->Visible) { // width_small ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->width_small->FldCaption() ?></td>
		<td<?php echo $pics->width_small->CellAttributes() ?>><span id="el_width_small">
<input type="text" name="x_width_small" id="x_width_small" title="<?php echo $pics->width_small->FldTitle() ?>" size="30" value="<?php echo $pics->width_small->EditValue ?>"<?php echo $pics->width_small->EditAttributes() ?>>
</span><?php echo $pics->width_small->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pics->height_small->Visible) { // height_small ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->height_small->FldCaption() ?></td>
		<td<?php echo $pics->height_small->CellAttributes() ?>><span id="el_height_small">
<input type="text" name="x_height_small" id="x_height_small" title="<?php echo $pics->height_small->FldTitle() ?>" size="30" value="<?php echo $pics->height_small->EditValue ?>"<?php echo $pics->height_small->EditAttributes() ?>>
</span><?php echo $pics->height_small->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pics->hits->Visible) { // hits ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->hits->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pics->hits->CellAttributes() ?>><span id="el_hits">
<input type="text" name="x_hits" id="x_hits" title="<?php echo $pics->hits->FldTitle() ?>" size="30" value="<?php echo $pics->hits->EditValue ?>"<?php echo $pics->hits->EditAttributes() ?>>
</span><?php echo $pics->hits->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($pics->date_uploaded->Visible) { // date_uploaded ?>
	<tr<?php echo $pics->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $pics->date_uploaded->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $pics->date_uploaded->CellAttributes() ?>><span id="el_date_uploaded">
<input type="text" name="x_date_uploaded" id="x_date_uploaded" title="<?php echo $pics->date_uploaded->FldTitle() ?>" value="<?php echo $pics->date_uploaded->EditValue ?>"<?php echo $pics->date_uploaded->EditAttributes() ?>>
</span><?php echo $pics->date_uploaded->CustomMsg ?></td>
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
$pics_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cpics_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'pics';

	// Page object name
	var $PageObjName = 'pics_edit';

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
	function cpics_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (pics)
		$GLOBALS["pics"] = new cpics();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		global $objForm, $Language, $gsFormError, $pics;

		// Load key from QueryString
		if (@$_GET["id"] <> "")
			$pics->id->setQueryStringValue($_GET["id"]);
		if (@$_POST["a_edit"] <> "") {
			$pics->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$pics->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$pics->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$pics->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($pics->id->CurrentValue == "")
			$this->Page_Terminate("picslist.php"); // Invalid key, return to list
		switch ($pics->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("picslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$pics->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $pics->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$pics->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$pics->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $pics;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $pics;
		$pics->id->setFormValue($objForm->GetValue("x_id"));
		$pics->caption->setFormValue($objForm->GetValue("x_caption"));
		$pics->descc->setFormValue($objForm->GetValue("x_descc"));
		$pics->img->setFormValue($objForm->GetValue("x_img"));
		$pics->width_big->setFormValue($objForm->GetValue("x_width_big"));
		$pics->height_big->setFormValue($objForm->GetValue("x_height_big"));
		$pics->width_small->setFormValue($objForm->GetValue("x_width_small"));
		$pics->height_small->setFormValue($objForm->GetValue("x_height_small"));
		$pics->hits->setFormValue($objForm->GetValue("x_hits"));
		$pics->date_uploaded->setFormValue($objForm->GetValue("x_date_uploaded"));
		$pics->date_uploaded->CurrentValue = ew_UnFormatDateTime($pics->date_uploaded->CurrentValue, 6);
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $pics;
		$this->LoadRow();
		$pics->id->CurrentValue = $pics->id->FormValue;
		$pics->caption->CurrentValue = $pics->caption->FormValue;
		$pics->descc->CurrentValue = $pics->descc->FormValue;
		$pics->img->CurrentValue = $pics->img->FormValue;
		$pics->width_big->CurrentValue = $pics->width_big->FormValue;
		$pics->height_big->CurrentValue = $pics->height_big->FormValue;
		$pics->width_small->CurrentValue = $pics->width_small->FormValue;
		$pics->height_small->CurrentValue = $pics->height_small->FormValue;
		$pics->hits->CurrentValue = $pics->hits->FormValue;
		$pics->date_uploaded->CurrentValue = $pics->date_uploaded->FormValue;
		$pics->date_uploaded->CurrentValue = ew_UnFormatDateTime($pics->date_uploaded->CurrentValue, 6);
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

		// caption
		$pics->caption->CellCssStyle = ""; $pics->caption->CellCssClass = "";
		$pics->caption->CellAttrs = array(); $pics->caption->ViewAttrs = array(); $pics->caption->EditAttrs = array();

		// descc
		$pics->descc->CellCssStyle = ""; $pics->descc->CellCssClass = "";
		$pics->descc->CellAttrs = array(); $pics->descc->ViewAttrs = array(); $pics->descc->EditAttrs = array();

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

			// caption
			$pics->caption->ViewValue = $pics->caption->CurrentValue;
			$pics->caption->CssStyle = "";
			$pics->caption->CssClass = "";
			$pics->caption->ViewCustomAttributes = "";

			// descc
			$pics->descc->ViewValue = $pics->descc->CurrentValue;
			$pics->descc->CssStyle = "";
			$pics->descc->CssClass = "";
			$pics->descc->ViewCustomAttributes = "";

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

			// caption
			$pics->caption->HrefValue = "";
			$pics->caption->TooltipValue = "";

			// descc
			$pics->descc->HrefValue = "";
			$pics->descc->TooltipValue = "";

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
		} elseif ($pics->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$pics->id->EditCustomAttributes = "";
			$pics->id->EditValue = $pics->id->CurrentValue;
			$pics->id->CssStyle = "";
			$pics->id->CssClass = "";
			$pics->id->ViewCustomAttributes = "";

			// caption
			$pics->caption->EditCustomAttributes = "";
			$pics->caption->EditValue = ew_HtmlEncode($pics->caption->CurrentValue);

			// descc
			$pics->descc->EditCustomAttributes = "";
			$pics->descc->EditValue = ew_HtmlEncode($pics->descc->CurrentValue);

			// img
			$pics->img->EditCustomAttributes = "";
			$pics->img->EditValue = ew_HtmlEncode($pics->img->CurrentValue);

			// width_big
			$pics->width_big->EditCustomAttributes = "";
			$pics->width_big->EditValue = ew_HtmlEncode($pics->width_big->CurrentValue);

			// height_big
			$pics->height_big->EditCustomAttributes = "";
			$pics->height_big->EditValue = ew_HtmlEncode($pics->height_big->CurrentValue);

			// width_small
			$pics->width_small->EditCustomAttributes = "";
			$pics->width_small->EditValue = ew_HtmlEncode($pics->width_small->CurrentValue);

			// height_small
			$pics->height_small->EditCustomAttributes = "";
			$pics->height_small->EditValue = ew_HtmlEncode($pics->height_small->CurrentValue);

			// hits
			$pics->hits->EditCustomAttributes = "";
			$pics->hits->EditValue = ew_HtmlEncode($pics->hits->CurrentValue);

			// date_uploaded
			$pics->date_uploaded->EditCustomAttributes = "";
			$pics->date_uploaded->EditValue = ew_HtmlEncode(ew_FormatDateTime($pics->date_uploaded->CurrentValue, 6));

			// Edit refer script
			// id

			$pics->id->HrefValue = "";

			// caption
			$pics->caption->HrefValue = "";

			// descc
			$pics->descc->HrefValue = "";

			// img
			$pics->img->HrefValue = "";

			// width_big
			$pics->width_big->HrefValue = "";

			// height_big
			$pics->height_big->HrefValue = "";

			// width_small
			$pics->width_small->HrefValue = "";

			// height_small
			$pics->height_small->HrefValue = "";

			// hits
			$pics->hits->HrefValue = "";

			// date_uploaded
			$pics->date_uploaded->HrefValue = "";
		}

		// Call Row Rendered event
		if ($pics->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$pics->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $pics;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($pics->caption->FormValue) && $pics->caption->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $pics->caption->FldCaption();
		}
		if (!is_null($pics->descc->FormValue) && $pics->descc->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $pics->descc->FldCaption();
		}
		if (!is_null($pics->img->FormValue) && $pics->img->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $pics->img->FldCaption();
		}
		if (!ew_CheckInteger($pics->width_big->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $pics->width_big->FldErrMsg();
		}
		if (!ew_CheckInteger($pics->height_big->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $pics->height_big->FldErrMsg();
		}
		if (!ew_CheckInteger($pics->width_small->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $pics->width_small->FldErrMsg();
		}
		if (!ew_CheckInteger($pics->height_small->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $pics->height_small->FldErrMsg();
		}
		if (!ew_CheckInteger($pics->hits->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $pics->hits->FldErrMsg();
		}
		if (!is_null($pics->date_uploaded->FormValue) && $pics->date_uploaded->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $pics->date_uploaded->FldCaption();
		}
		if (!ew_CheckUSDate($pics->date_uploaded->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $pics->date_uploaded->FldErrMsg();
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
		global $conn, $Security, $Language, $pics;
		$sFilter = $pics->KeyFilter();
		$pics->CurrentFilter = $sFilter;
		$sSql = $pics->SQL();
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

			// caption
			$pics->caption->SetDbValueDef($rsnew, $pics->caption->CurrentValue, "", FALSE);

			// descc
			$pics->descc->SetDbValueDef($rsnew, $pics->descc->CurrentValue, "", FALSE);

			// img
			$pics->img->SetDbValueDef($rsnew, $pics->img->CurrentValue, "", FALSE);

			// width_big
			$pics->width_big->SetDbValueDef($rsnew, $pics->width_big->CurrentValue, NULL, FALSE);

			// height_big
			$pics->height_big->SetDbValueDef($rsnew, $pics->height_big->CurrentValue, NULL, FALSE);

			// width_small
			$pics->width_small->SetDbValueDef($rsnew, $pics->width_small->CurrentValue, NULL, FALSE);

			// height_small
			$pics->height_small->SetDbValueDef($rsnew, $pics->height_small->CurrentValue, NULL, FALSE);

			// hits
			$pics->hits->SetDbValueDef($rsnew, $pics->hits->CurrentValue, 0, FALSE);

			// date_uploaded
			$pics->date_uploaded->SetDbValueDef($rsnew, ew_UnFormatDateTime($pics->date_uploaded->CurrentValue, 6, FALSE), ew_CurrentDate());

			// Call Row Updating event
			$bUpdateRow = $pics->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($pics->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($pics->CancelMessage <> "") {
					$this->setMessage($pics->CancelMessage);
					$pics->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$pics->Row_Updated($rsold, $rsnew);
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
