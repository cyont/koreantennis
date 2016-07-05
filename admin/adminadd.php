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
$admin_add = new cadmin_add();
$Page =& $admin_add;

// Page init
$admin_add->Page_Init();

// Page main
$admin_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var admin_add = new ew_Page("admin_add");

// page properties
admin_add.PageID = "add"; // page ID
admin_add.FormID = "fadminadd"; // form ID
var EW_PAGE_ID = admin_add.PageID; // for backward compatibility

// extend page with ValidateForm function
admin_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_admin_1"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($admin->admin_1->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_pass"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($admin->pass->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_zemail"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($admin->zemail->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_hits"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($admin->hits->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
admin_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
admin_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
admin_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $admin->TableCaption() ?><br><br>
<a href="<?php echo $admin->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$admin_add->ShowMessage();
?>
<form name="fadminadd" id="fadminadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return admin_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="admin">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($admin->admin_1->Visible) { // admin ?>
	<tr<?php echo $admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $admin->admin_1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $admin->admin_1->CellAttributes() ?>><span id="el_admin_1">
<input type="text" name="x_admin_1" id="x_admin_1" title="<?php echo $admin->admin_1->FldTitle() ?>" size="30" maxlength="190" value="<?php echo $admin->admin_1->EditValue ?>"<?php echo $admin->admin_1->EditAttributes() ?>>
</span><?php echo $admin->admin_1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($admin->pass->Visible) { // pass ?>
	<tr<?php echo $admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $admin->pass->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $admin->pass->CellAttributes() ?>><span id="el_pass">
<input type="text" name="x_pass" id="x_pass" title="<?php echo $admin->pass->FldTitle() ?>" size="30" maxlength="190" value="<?php echo $admin->pass->EditValue ?>"<?php echo $admin->pass->EditAttributes() ?>>
</span><?php echo $admin->pass->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($admin->zemail->Visible) { // email ?>
	<tr<?php echo $admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $admin->zemail->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $admin->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" title="<?php echo $admin->zemail->FldTitle() ?>" size="30" maxlength="190" value="<?php echo $admin->zemail->EditValue ?>"<?php echo $admin->zemail->EditAttributes() ?>>
</span><?php echo $admin->zemail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($admin->hits->Visible) { // hits ?>
	<tr<?php echo $admin->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $admin->hits->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $admin->hits->CellAttributes() ?>><span id="el_hits">
<input type="text" name="x_hits" id="x_hits" title="<?php echo $admin->hits->FldTitle() ?>" size="30" value="<?php echo $admin->hits->EditValue ?>"<?php echo $admin->hits->EditAttributes() ?>>
</span><?php echo $admin->hits->CustomMsg ?></td>
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
$admin_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cadmin_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'admin';

	// Page object name
	var $PageObjName = 'admin_add';

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
	function cadmin_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (admin)
		$GLOBALS["admin"] = new cadmin();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
		global $objForm, $Language, $gsFormError, $admin;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $admin->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $admin->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$admin->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $admin->CurrentAction = "C"; // Copy record
		  } else {
		    $admin->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($admin->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("adminlist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$admin->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $admin->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$admin->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $admin;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $admin;
		$admin->hits->CurrentValue = 0;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $admin;
		$admin->admin_1->setFormValue($objForm->GetValue("x_admin_1"));
		$admin->pass->setFormValue($objForm->GetValue("x_pass"));
		$admin->zemail->setFormValue($objForm->GetValue("x_zemail"));
		$admin->hits->setFormValue($objForm->GetValue("x_hits"));
		$admin->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $admin;
		$admin->id->CurrentValue = $admin->id->FormValue;
		$admin->admin_1->CurrentValue = $admin->admin_1->FormValue;
		$admin->pass->CurrentValue = $admin->pass->FormValue;
		$admin->zemail->CurrentValue = $admin->zemail->FormValue;
		$admin->hits->CurrentValue = $admin->hits->FormValue;
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
		} elseif ($admin->RowType == EW_ROWTYPE_ADD) { // Add row

			// admin
			$admin->admin_1->EditCustomAttributes = "";
			$admin->admin_1->EditValue = ew_HtmlEncode($admin->admin_1->CurrentValue);

			// pass
			$admin->pass->EditCustomAttributes = "";
			$admin->pass->EditValue = ew_HtmlEncode($admin->pass->CurrentValue);

			// email
			$admin->zemail->EditCustomAttributes = "";
			$admin->zemail->EditValue = ew_HtmlEncode($admin->zemail->CurrentValue);

			// hits
			$admin->hits->EditCustomAttributes = "";
			$admin->hits->EditValue = ew_HtmlEncode($admin->hits->CurrentValue);
		}

		// Call Row Rendered event
		if ($admin->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$admin->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $admin;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($admin->admin_1->FormValue) && $admin->admin_1->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $admin->admin_1->FldCaption();
		}
		if (!is_null($admin->pass->FormValue) && $admin->pass->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $admin->pass->FldCaption();
		}
		if (!is_null($admin->zemail->FormValue) && $admin->zemail->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $admin->zemail->FldCaption();
		}
		if (!ew_CheckInteger($admin->hits->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $admin->hits->FldErrMsg();
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
		global $conn, $Language, $Security, $admin;
		$rsnew = array();

		// admin
		$admin->admin_1->SetDbValueDef($rsnew, $admin->admin_1->CurrentValue, "", FALSE);

		// pass
		$admin->pass->SetDbValueDef($rsnew, $admin->pass->CurrentValue, "", FALSE);

		// email
		$admin->zemail->SetDbValueDef($rsnew, $admin->zemail->CurrentValue, "", FALSE);

		// hits
		$admin->hits->SetDbValueDef($rsnew, $admin->hits->CurrentValue, 0, TRUE);

		// Call Row Inserting event
		$bInsertRow = $admin->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($admin->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($admin->CancelMessage <> "") {
				$this->setMessage($admin->CancelMessage);
				$admin->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$admin->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $admin->id->DbValue;

			// Call Row Inserted event
			$admin->Row_Inserted($rsnew);
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
