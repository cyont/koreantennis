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
$comments_add = new ccomments_add();
$Page =& $comments_add;

// Page init
$comments_add->Page_Init();

// Page main
$comments_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var comments_add = new ew_Page("comments_add");

// page properties
comments_add.PageID = "add"; // page ID
comments_add.FormID = "fcommentsadd"; // form ID
var EW_PAGE_ID = comments_add.PageID; // for backward compatibility

// extend page with ValidateForm function
comments_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_imgid"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($comments->imgid->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_name2"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($comments->name2->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_comment2"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($comments->comment2->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($comments->date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_status"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($comments->status->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
comments_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
comments_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
comments_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $comments->TableCaption() ?><br><br>
<a href="<?php echo $comments->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$comments_add->ShowMessage();
?>
<form name="fcommentsadd" id="fcommentsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return comments_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="comments">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($comments->imgid->Visible) { // imgid ?>
	<tr<?php echo $comments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comments->imgid->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $comments->imgid->CellAttributes() ?>><span id="el_imgid">
<input type="text" name="x_imgid" id="x_imgid" title="<?php echo $comments->imgid->FldTitle() ?>" size="30" value="<?php echo $comments->imgid->EditValue ?>"<?php echo $comments->imgid->EditAttributes() ?>>
</span><?php echo $comments->imgid->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($comments->name2->Visible) { // name2 ?>
	<tr<?php echo $comments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comments->name2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $comments->name2->CellAttributes() ?>><span id="el_name2">
<input type="text" name="x_name2" id="x_name2" title="<?php echo $comments->name2->FldTitle() ?>" size="30" maxlength="190" value="<?php echo $comments->name2->EditValue ?>"<?php echo $comments->name2->EditAttributes() ?>>
</span><?php echo $comments->name2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($comments->comment2->Visible) { // comment2 ?>
	<tr<?php echo $comments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comments->comment2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $comments->comment2->CellAttributes() ?>><span id="el_comment2">
<textarea name="x_comment2" id="x_comment2" title="<?php echo $comments->comment2->FldTitle() ?>" cols="35" rows="4"<?php echo $comments->comment2->EditAttributes() ?>><?php echo $comments->comment2->EditValue ?></textarea>
</span><?php echo $comments->comment2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($comments->date->Visible) { // date ?>
	<tr<?php echo $comments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comments->date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $comments->date->CellAttributes() ?>><span id="el_date">
<input type="text" name="x_date" id="x_date" title="<?php echo $comments->date->FldTitle() ?>" size="30" maxlength="190" value="<?php echo $comments->date->EditValue ?>"<?php echo $comments->date->EditAttributes() ?>>
</span><?php echo $comments->date->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($comments->status->Visible) { // status ?>
	<tr<?php echo $comments->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $comments->status->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $comments->status->CellAttributes() ?>><span id="el_status">
<input type="text" name="x_status" id="x_status" title="<?php echo $comments->status->FldTitle() ?>" size="30" value="<?php echo $comments->status->EditValue ?>"<?php echo $comments->status->EditAttributes() ?>>
</span><?php echo $comments->status->CustomMsg ?></td>
	</tr>
<?php } ?>
</table>
</div>
</td></tr></table>
<p>
<input type="submit" name="btnAction" id="btnAction" value="<?php echo ew_BtnCaption($Language->Phrase("AddBtn")) ?>">
</form>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php include "footer.php" ?>
<?php
$comments_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ccomments_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'comments';

	// Page object name
	var $PageObjName = 'comments_add';

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
	function ccomments_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (comments)
		$GLOBALS["comments"] = new ccomments();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $comments;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $comments->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $comments->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$comments->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $comments->CurrentAction = "C"; // Copy record
		  } else {
		    $comments->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($comments->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("commentslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$comments->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $comments->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$comments->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $comments;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $comments;
		$comments->imgid->CurrentValue = 0;
		$comments->status->CurrentValue = 1;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $comments;
		$comments->imgid->setFormValue($objForm->GetValue("x_imgid"));
		$comments->name2->setFormValue($objForm->GetValue("x_name2"));
		$comments->comment2->setFormValue($objForm->GetValue("x_comment2"));
		$comments->date->setFormValue($objForm->GetValue("x_date"));
		$comments->status->setFormValue($objForm->GetValue("x_status"));
		$comments->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $comments;
		$comments->id->CurrentValue = $comments->id->FormValue;
		$comments->imgid->CurrentValue = $comments->imgid->FormValue;
		$comments->name2->CurrentValue = $comments->name2->FormValue;
		$comments->comment2->CurrentValue = $comments->comment2->FormValue;
		$comments->date->CurrentValue = $comments->date->FormValue;
		$comments->status->CurrentValue = $comments->status->FormValue;
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
		// imgid

		$comments->imgid->CellCssStyle = ""; $comments->imgid->CellCssClass = "";
		$comments->imgid->CellAttrs = array(); $comments->imgid->ViewAttrs = array(); $comments->imgid->EditAttrs = array();

		// name2
		$comments->name2->CellCssStyle = ""; $comments->name2->CellCssClass = "";
		$comments->name2->CellAttrs = array(); $comments->name2->ViewAttrs = array(); $comments->name2->EditAttrs = array();

		// comment2
		$comments->comment2->CellCssStyle = ""; $comments->comment2->CellCssClass = "";
		$comments->comment2->CellAttrs = array(); $comments->comment2->ViewAttrs = array(); $comments->comment2->EditAttrs = array();

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

			// comment2
			$comments->comment2->ViewValue = $comments->comment2->CurrentValue;
			$comments->comment2->CssStyle = "";
			$comments->comment2->CssClass = "";
			$comments->comment2->ViewCustomAttributes = "";

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

			// imgid
			$comments->imgid->HrefValue = "";
			$comments->imgid->TooltipValue = "";

			// name2
			$comments->name2->HrefValue = "";
			$comments->name2->TooltipValue = "";

			// comment2
			$comments->comment2->HrefValue = "";
			$comments->comment2->TooltipValue = "";

			// date
			$comments->date->HrefValue = "";
			$comments->date->TooltipValue = "";

			// status
			$comments->status->HrefValue = "";
			$comments->status->TooltipValue = "";
		} elseif ($comments->RowType == EW_ROWTYPE_ADD) { // Add row

			// imgid
			$comments->imgid->EditCustomAttributes = "";
			$comments->imgid->EditValue = ew_HtmlEncode($comments->imgid->CurrentValue);

			// name2
			$comments->name2->EditCustomAttributes = "";
			$comments->name2->EditValue = ew_HtmlEncode($comments->name2->CurrentValue);

			// comment2
			$comments->comment2->EditCustomAttributes = "";
			$comments->comment2->EditValue = ew_HtmlEncode($comments->comment2->CurrentValue);

			// date
			$comments->date->EditCustomAttributes = "";
			$comments->date->EditValue = ew_HtmlEncode($comments->date->CurrentValue);

			// status
			$comments->status->EditCustomAttributes = "";
			$comments->status->EditValue = ew_HtmlEncode($comments->status->CurrentValue);
		}

		// Call Row Rendered event
		if ($comments->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$comments->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $comments;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($comments->imgid->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $comments->imgid->FldErrMsg();
		}
		if (!is_null($comments->name2->FormValue) && $comments->name2->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $comments->name2->FldCaption();
		}
		if (!is_null($comments->comment2->FormValue) && $comments->comment2->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $comments->comment2->FldCaption();
		}
		if (!is_null($comments->date->FormValue) && $comments->date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $comments->date->FldCaption();
		}
		if (!ew_CheckInteger($comments->status->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $comments->status->FldErrMsg();
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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $comments;
		$rsnew = array();

		// imgid
		$comments->imgid->SetDbValueDef($rsnew, $comments->imgid->CurrentValue, 0, TRUE);

		// name2
		$comments->name2->SetDbValueDef($rsnew, $comments->name2->CurrentValue, "", FALSE);

		// comment2
		$comments->comment2->SetDbValueDef($rsnew, $comments->comment2->CurrentValue, "", FALSE);

		// date
		$comments->date->SetDbValueDef($rsnew, $comments->date->CurrentValue, "", FALSE);

		// status
		$comments->status->SetDbValueDef($rsnew, $comments->status->CurrentValue, 0, TRUE);

		// Call Row Inserting event
		$bInsertRow = $comments->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($comments->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($comments->CancelMessage <> "") {
				$this->setMessage($comments->CancelMessage);
				$comments->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$comments->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $comments->id->DbValue;

			// Call Row Inserted event
			$comments->Row_Inserted($rsnew);
		}
		return $AddRow;
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
