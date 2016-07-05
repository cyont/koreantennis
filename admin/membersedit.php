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
$members_edit = new cmembers_edit();
$Page =& $members_edit;

// Page init
$members_edit->Page_Init();

// Page main
$members_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var members_edit = new ew_Page("members_edit");

// page properties
members_edit.PageID = "edit"; // page ID
members_edit.FormID = "fmembersedit"; // form ID
var EW_PAGE_ID = members_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
members_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_status_student"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->status_student->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_ethnicity_korean"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->ethnicity_korean->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_language_korean"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->language_korean->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_access_level"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->access_level->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_active_member"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($members->active_member->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
members_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
members_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
members_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $members->TableCaption() ?><br><br>
<a href="<?php echo $members->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$members_edit->ShowMessage();
?>
<form name="fmembersedit" id="fmembersedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return members_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="members">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($members->Id->Visible) { // Id ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->Id->FldCaption() ?></td>
		<td<?php echo $members->Id->CellAttributes() ?>><span id="el_Id">
<div<?php echo $members->Id->ViewAttributes() ?>><?php echo $members->Id->EditValue ?></div><input type="hidden" name="x_Id" id="x_Id" value="<?php echo ew_HtmlEncode($members->Id->CurrentValue) ?>">
</span><?php echo $members->Id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->first_name->Visible) { // first_name ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->first_name->FldCaption() ?></td>
		<td<?php echo $members->first_name->CellAttributes() ?>><span id="el_first_name">
<input type="text" name="x_first_name" id="x_first_name" title="<?php echo $members->first_name->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $members->first_name->EditValue ?>"<?php echo $members->first_name->EditAttributes() ?>>
</span><?php echo $members->first_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->last_name->Visible) { // last_name ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->last_name->FldCaption() ?></td>
		<td<?php echo $members->last_name->CellAttributes() ?>><span id="el_last_name">
<input type="text" name="x_last_name" id="x_last_name" title="<?php echo $members->last_name->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $members->last_name->EditValue ?>"<?php echo $members->last_name->EditAttributes() ?>>
</span><?php echo $members->last_name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->first_name_eng->Visible) { // first_name_eng ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->first_name_eng->FldCaption() ?></td>
		<td<?php echo $members->first_name_eng->CellAttributes() ?>><span id="el_first_name_eng">
<input type="text" name="x_first_name_eng" id="x_first_name_eng" title="<?php echo $members->first_name_eng->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $members->first_name_eng->EditValue ?>"<?php echo $members->first_name_eng->EditAttributes() ?>>
</span><?php echo $members->first_name_eng->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->last_name_eng->Visible) { // last_name_eng ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->last_name_eng->FldCaption() ?></td>
		<td<?php echo $members->last_name_eng->CellAttributes() ?>><span id="el_last_name_eng">
<input type="text" name="x_last_name_eng" id="x_last_name_eng" title="<?php echo $members->last_name_eng->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $members->last_name_eng->EditValue ?>"<?php echo $members->last_name_eng->EditAttributes() ?>>
</span><?php echo $members->last_name_eng->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->username->Visible) { // username ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->username->FldCaption() ?></td>
		<td<?php echo $members->username->CellAttributes() ?>><span id="el_username">
<input type="text" name="x_username" id="x_username" title="<?php echo $members->username->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $members->username->EditValue ?>"<?php echo $members->username->EditAttributes() ?>>
</span><?php echo $members->username->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->password->Visible) { // password ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->password->FldCaption() ?></td>
		<td<?php echo $members->password->CellAttributes() ?>><span id="el_password">
<input type="text" name="x_password" id="x_password" title="<?php echo $members->password->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $members->password->EditValue ?>"<?php echo $members->password->EditAttributes() ?>>
</span><?php echo $members->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->phone_cell->Visible) { // phone_cell ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->phone_cell->FldCaption() ?></td>
		<td<?php echo $members->phone_cell->CellAttributes() ?>><span id="el_phone_cell">
<input type="text" name="x_phone_cell" id="x_phone_cell" title="<?php echo $members->phone_cell->FldTitle() ?>" size="30" maxlength="25" value="<?php echo $members->phone_cell->EditValue ?>"<?php echo $members->phone_cell->EditAttributes() ?>>
</span><?php echo $members->phone_cell->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->phone_home->Visible) { // phone_home ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->phone_home->FldCaption() ?></td>
		<td<?php echo $members->phone_home->CellAttributes() ?>><span id="el_phone_home">
<input type="text" name="x_phone_home" id="x_phone_home" title="<?php echo $members->phone_home->FldTitle() ?>" size="30" maxlength="25" value="<?php echo $members->phone_home->EditValue ?>"<?php echo $members->phone_home->EditAttributes() ?>>
</span><?php echo $members->phone_home->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->zemail->Visible) { // email ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->zemail->FldCaption() ?></td>
		<td<?php echo $members->zemail->CellAttributes() ?>><span id="el_zemail">
<input type="text" name="x_zemail" id="x_zemail" title="<?php echo $members->zemail->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $members->zemail->EditValue ?>"<?php echo $members->zemail->EditAttributes() ?>>
</span><?php echo $members->zemail->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->address->Visible) { // address ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->address->FldCaption() ?></td>
		<td<?php echo $members->address->CellAttributes() ?>><span id="el_address">
<input type="text" name="x_address" id="x_address" title="<?php echo $members->address->FldTitle() ?>" size="30" maxlength="250" value="<?php echo $members->address->EditValue ?>"<?php echo $members->address->EditAttributes() ?>>
</span><?php echo $members->address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->city->Visible) { // city ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->city->FldCaption() ?></td>
		<td<?php echo $members->city->CellAttributes() ?>><span id="el_city">
<input type="text" name="x_city" id="x_city" title="<?php echo $members->city->FldTitle() ?>" size="30" maxlength="25" value="<?php echo $members->city->EditValue ?>"<?php echo $members->city->EditAttributes() ?>>
</span><?php echo $members->city->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->zip->Visible) { // zip ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->zip->FldCaption() ?></td>
		<td<?php echo $members->zip->CellAttributes() ?>><span id="el_zip">
<input type="text" name="x_zip" id="x_zip" title="<?php echo $members->zip->FldTitle() ?>" size="30" maxlength="10" value="<?php echo $members->zip->EditValue ?>"<?php echo $members->zip->EditAttributes() ?>>
</span><?php echo $members->zip->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->gender->Visible) { // gender ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->gender->FldCaption() ?></td>
		<td<?php echo $members->gender->CellAttributes() ?>><span id="el_gender">
        <input name="x_gender" type="radio" value="M" <?php if ($members->gender->EditValue == "M") { ?> checked="checked" <?php } ?> /> Male &nbsp;&nbsp;&nbsp;
        <input name="x_gender" type="radio" value="F" <?php if ($members->gender->EditValue == "F") { ?> checked="checked" <?php } ?> /> Female
<!--<input type="text" name="x_gender" id="x_gender" title="<?php echo $members->gender->FldTitle() ?>" size="30" maxlength="4" value="<?php echo $members->gender->EditValue ?>"<?php echo $members->gender->EditAttributes() ?>>-->
</span><?php echo $members->gender->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->status_student->Visible) { // status_student ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->status_student->FldCaption() ?></td>
		<td<?php echo $members->status_student->CellAttributes() ?>><span id="el_status_student">
        <input name="x_status_student" type="radio" value="1" <?php if ($members->status_student->EditValue == 1) { ?> checked="checked" <?php } ?> /> Student &nbsp;&nbsp;&nbsp;
        <input name="x_status_student" type="radio" value="0" <?php if ($members->status_student->EditValue == 0) { ?> checked="checked" <?php } ?> /> Non-Student
<!--<input type="text" name="x_status_student" id="x_status_student" title="<?php echo $members->status_student->FldTitle() ?>" size="30" value="<?php echo $members->status_student->EditValue ?>"<?php echo $members->status_student->EditAttributes() ?>>-->
</span><?php echo $members->status_student->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->ethnicity_korean->Visible) { // ethnicity_korean ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->ethnicity_korean->FldCaption() ?></td>
		<td<?php echo $members->ethnicity_korean->CellAttributes() ?>><span id="el_ethnicity_korean">
        <input name="x_ethnicity_korean" type="radio" value="1" <?php if ($members->ethnicity_korean->EditValue == 1) { ?> checked="checked" <?php } ?> /> Korean &nbsp;&nbsp;&nbsp;
        <input name="x_ethnicity_korean" type="radio" value="0" <?php if ($members->ethnicity_korean->EditValue == 0) { ?> checked="checked" <?php } ?> /> Non-Korean
<!--<input type="text" name="x_ethnicity_korean" id="x_ethnicity_korean" title="<?php echo $members->ethnicity_korean->FldTitle() ?>" size="30" value="<?php echo $members->ethnicity_korean->EditValue ?>"<?php echo $members->ethnicity_korean->EditAttributes() ?>>-->
</span><?php echo $members->ethnicity_korean->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->language_korean->Visible) { // language_korean ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->language_korean->FldCaption() ?></td>
		<td<?php echo $members->language_korean->CellAttributes() ?>><span id="el_language_korean">
        <input name="x_language_korean" type="radio" value="1" <?php if ($members->language_korean->EditValue == 1) { ?> checked="checked" <?php } ?> /> Korean Language&nbsp;&nbsp;&nbsp;
        <input name="x_language_korean" type="radio" value="0" <?php if ($members->language_korean->EditValue == 0) { ?> checked="checked" <?php } ?> /> Non-Korean or Bilingual
<!--<input type="text" name="x_language_korean" id="x_language_korean" title="<?php echo $members->language_korean->FldTitle() ?>" size="30" value="<?php echo $members->language_korean->EditValue ?>"<?php echo $members->language_korean->EditAttributes() ?>>-->
</span><?php echo $members->language_korean->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->access_level->Visible) { // access_level ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->access_level->FldCaption() ?></td>
		<td<?php echo $members->access_level->CellAttributes() ?>><span id="el_access_level">
        <input name="x_access_level" type="radio" value="1" <?php if ($members->access_level->EditValue == 1) { ?> checked="checked" <?php } ?> /> General&nbsp;&nbsp;&nbsp;
        <input name="x_access_level" type="radio" value="2" <?php if ($members->access_level->EditValue == 2) { ?> checked="checked" <?php } ?> /> Administrator&nbsp;&nbsp;&nbsp;
        <input name="x_access_level" type="radio" value="3" <?php if ($members->access_level->EditValue == 3) { ?> checked="checked" <?php } ?> /> Database Owner
<!--<input type="text" name="x_access_level" id="x_access_level" title="<?php echo $members->access_level->FldTitle() ?>" size="30" value="<?php echo $members->access_level->EditValue ?>"<?php echo $members->access_level->EditAttributes() ?>>-->
</span><?php echo $members->access_level->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($members->active_member->Visible) { // active_member ?>
	<tr<?php echo $members->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $members->active_member->FldCaption() ?></td>
		<td<?php echo $members->active_member->CellAttributes() ?>><span id="el_active_member">
        <input name="x_active_member" type="radio" value="1" <?php if ($members->active_member->EditValue == 1) { ?> checked="checked" <?php } ?> /> Yes&nbsp;&nbsp;&nbsp;
        <input name="x_active_member" type="radio" value="0" <?php if ($members->active_member->EditValue == 0) { ?> checked="checked" <?php } ?> /> No
<!--<input type="text" name="x_active_member" id="x_active_member" title="<?php echo $members->active_member->FldTitle() ?>" size="30" value="<?php echo $members->active_member->EditValue ?>"<?php echo $members->active_member->EditAttributes() ?>>-->
</span><?php echo $members->active_member->CustomMsg ?></td>
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
$members_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cmembers_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'members';

	// Page object name
	var $PageObjName = 'members_edit';

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
	function cmembers_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (members)
		$GLOBALS["members"] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

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
		global $objForm, $Language, $gsFormError, $members;

		// Load key from QueryString
		if (@$_GET["Id"] <> "")
			$members->Id->setQueryStringValue($_GET["Id"]);
		if (@$_POST["a_edit"] <> "") {
			$members->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$members->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$members->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$members->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($members->Id->CurrentValue == "")
			$this->Page_Terminate("memberslist.php"); // Invalid key, return to list
		switch ($members->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("memberslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$members->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $members->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$members->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$members->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $members;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $members;
		$members->Id->setFormValue($objForm->GetValue("x_Id"));
		$members->first_name->setFormValue($objForm->GetValue("x_first_name"));
		$members->last_name->setFormValue($objForm->GetValue("x_last_name"));
		$members->first_name_eng->setFormValue($objForm->GetValue("x_first_name_eng"));
		$members->last_name_eng->setFormValue($objForm->GetValue("x_last_name_eng"));
		$members->username->setFormValue($objForm->GetValue("x_username"));
		$members->password->setFormValue($objForm->GetValue("x_password"));
		$members->phone_cell->setFormValue($objForm->GetValue("x_phone_cell"));
		$members->phone_home->setFormValue($objForm->GetValue("x_phone_home"));
		$members->zemail->setFormValue($objForm->GetValue("x_zemail"));
		$members->address->setFormValue($objForm->GetValue("x_address"));
		$members->city->setFormValue($objForm->GetValue("x_city"));
		$members->zip->setFormValue($objForm->GetValue("x_zip"));
		$members->gender->setFormValue($objForm->GetValue("x_gender"));
		$members->status_student->setFormValue($objForm->GetValue("x_status_student"));
		$members->ethnicity_korean->setFormValue($objForm->GetValue("x_ethnicity_korean"));
		$members->language_korean->setFormValue($objForm->GetValue("x_language_korean"));
		$members->access_level->setFormValue($objForm->GetValue("x_access_level"));
		$members->active_member->setFormValue($objForm->GetValue("x_active_member"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $members;
		$this->LoadRow();
		$members->Id->CurrentValue = $members->Id->FormValue;
		$members->first_name->CurrentValue = $members->first_name->FormValue;
		$members->last_name->CurrentValue = $members->last_name->FormValue;
		$members->first_name_eng->CurrentValue = $members->first_name_eng->FormValue;
		$members->last_name_eng->CurrentValue = $members->last_name_eng->FormValue;
		$members->username->CurrentValue = $members->username->FormValue;
		$members->password->CurrentValue = $members->password->FormValue;
		$members->phone_cell->CurrentValue = $members->phone_cell->FormValue;
		$members->phone_home->CurrentValue = $members->phone_home->FormValue;
		$members->zemail->CurrentValue = $members->zemail->FormValue;
		$members->address->CurrentValue = $members->address->FormValue;
		$members->city->CurrentValue = $members->city->FormValue;
		$members->zip->CurrentValue = $members->zip->FormValue;
		$members->gender->CurrentValue = $members->gender->FormValue;
		$members->status_student->CurrentValue = $members->status_student->FormValue;
		$members->ethnicity_korean->CurrentValue = $members->ethnicity_korean->FormValue;
		$members->language_korean->CurrentValue = $members->language_korean->FormValue;
		$members->access_level->CurrentValue = $members->access_level->FormValue;
		$members->active_member->CurrentValue = $members->active_member->FormValue;
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
		} elseif ($members->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// Id
			$members->Id->EditCustomAttributes = "";
			$members->Id->EditValue = $members->Id->CurrentValue;
			$members->Id->CssStyle = "";
			$members->Id->CssClass = "";
			$members->Id->ViewCustomAttributes = "";

			// first_name
			$members->first_name->EditCustomAttributes = "";
			$members->first_name->EditValue = ew_HtmlEncode($members->first_name->CurrentValue);

			// last_name
			$members->last_name->EditCustomAttributes = "";
			$members->last_name->EditValue = ew_HtmlEncode($members->last_name->CurrentValue);

			// first_name_eng
			$members->first_name_eng->EditCustomAttributes = "";
			$members->first_name_eng->EditValue = ew_HtmlEncode($members->first_name_eng->CurrentValue);

			// last_name_eng
			$members->last_name_eng->EditCustomAttributes = "";
			$members->last_name_eng->EditValue = ew_HtmlEncode($members->last_name_eng->CurrentValue);

			// username
			$members->username->EditCustomAttributes = "";
			$members->username->EditValue = ew_HtmlEncode($members->username->CurrentValue);

			// password
			$members->password->EditCustomAttributes = "";
			$members->password->EditValue = ew_HtmlEncode($members->password->CurrentValue);

			// phone_cell
			$members->phone_cell->EditCustomAttributes = "";
			$members->phone_cell->EditValue = ew_HtmlEncode($members->phone_cell->CurrentValue);

			// phone_home
			$members->phone_home->EditCustomAttributes = "";
			$members->phone_home->EditValue = ew_HtmlEncode($members->phone_home->CurrentValue);

			// email
			$members->zemail->EditCustomAttributes = "";
			$members->zemail->EditValue = ew_HtmlEncode($members->zemail->CurrentValue);

			// address
			$members->address->EditCustomAttributes = "";
			$members->address->EditValue = ew_HtmlEncode($members->address->CurrentValue);

			// city
			$members->city->EditCustomAttributes = "";
			$members->city->EditValue = ew_HtmlEncode($members->city->CurrentValue);

			// zip
			$members->zip->EditCustomAttributes = "";
			$members->zip->EditValue = ew_HtmlEncode($members->zip->CurrentValue);

			// gender
			$members->gender->EditCustomAttributes = "";
			$members->gender->EditValue = ew_HtmlEncode($members->gender->CurrentValue);

			// status_student
			$members->status_student->EditCustomAttributes = "";
			$members->status_student->EditValue = ew_HtmlEncode($members->status_student->CurrentValue);

			// ethnicity_korean
			$members->ethnicity_korean->EditCustomAttributes = "";
			$members->ethnicity_korean->EditValue = ew_HtmlEncode($members->ethnicity_korean->CurrentValue);

			// language_korean
			$members->language_korean->EditCustomAttributes = "";
			$members->language_korean->EditValue = ew_HtmlEncode($members->language_korean->CurrentValue);

			// access_level
			$members->access_level->EditCustomAttributes = "";
			$members->access_level->EditValue = ew_HtmlEncode($members->access_level->CurrentValue);

			// active_member
			$members->active_member->EditCustomAttributes = "";
			$members->active_member->EditValue = ew_HtmlEncode($members->active_member->CurrentValue);

			// Edit refer script
			// Id

			$members->Id->HrefValue = "";

			// first_name
			$members->first_name->HrefValue = "";

			// last_name
			$members->last_name->HrefValue = "";

			// first_name_eng
			$members->first_name_eng->HrefValue = "";

			// last_name_eng
			$members->last_name_eng->HrefValue = "";

			// username
			$members->username->HrefValue = "";

			// password
			$members->password->HrefValue = "";

			// phone_cell
			$members->phone_cell->HrefValue = "";

			// phone_home
			$members->phone_home->HrefValue = "";

			// email
			$members->zemail->HrefValue = "";

			// address
			$members->address->HrefValue = "";

			// city
			$members->city->HrefValue = "";

			// zip
			$members->zip->HrefValue = "";

			// gender
			$members->gender->HrefValue = "";

			// status_student
			$members->status_student->HrefValue = "";

			// ethnicity_korean
			$members->ethnicity_korean->HrefValue = "";

			// language_korean
			$members->language_korean->HrefValue = "";

			// access_level
			$members->access_level->HrefValue = "";

			// active_member
			$members->active_member->HrefValue = "";
		}

		// Call Row Rendered event
		if ($members->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$members->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $members;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($members->status_student->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $members->status_student->FldErrMsg();
		}
		if (!ew_CheckInteger($members->ethnicity_korean->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $members->ethnicity_korean->FldErrMsg();
		}
		if (!ew_CheckInteger($members->language_korean->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $members->language_korean->FldErrMsg();
		}
		if (!ew_CheckInteger($members->access_level->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $members->access_level->FldErrMsg();
		}
		if (!ew_CheckInteger($members->active_member->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $members->active_member->FldErrMsg();
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
		global $conn, $Security, $Language, $members;
		$sFilter = $members->KeyFilter();
		$members->CurrentFilter = $sFilter;
		$sSql = $members->SQL();
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

			// first_name
			$members->first_name->SetDbValueDef($rsnew, $members->first_name->CurrentValue, NULL, FALSE);

			// last_name
			$members->last_name->SetDbValueDef($rsnew, $members->last_name->CurrentValue, NULL, FALSE);

			// first_name_eng
			$members->first_name_eng->SetDbValueDef($rsnew, $members->first_name_eng->CurrentValue, NULL, FALSE);

			// last_name_eng
			$members->last_name_eng->SetDbValueDef($rsnew, $members->last_name_eng->CurrentValue, NULL, FALSE);

			// username
			$members->username->SetDbValueDef($rsnew, $members->username->CurrentValue, NULL, FALSE);

			// password
			$members->password->SetDbValueDef($rsnew, $members->password->CurrentValue, NULL, FALSE);

			// phone_cell
			$members->phone_cell->SetDbValueDef($rsnew, $members->phone_cell->CurrentValue, NULL, FALSE);

			// phone_home
			$members->phone_home->SetDbValueDef($rsnew, $members->phone_home->CurrentValue, NULL, FALSE);

			// email
			$members->zemail->SetDbValueDef($rsnew, $members->zemail->CurrentValue, NULL, FALSE);

			// address
			$members->address->SetDbValueDef($rsnew, $members->address->CurrentValue, NULL, FALSE);

			// city
			$members->city->SetDbValueDef($rsnew, $members->city->CurrentValue, NULL, FALSE);

			// zip
			$members->zip->SetDbValueDef($rsnew, $members->zip->CurrentValue, NULL, FALSE);

			// gender
			$members->gender->SetDbValueDef($rsnew, $members->gender->CurrentValue, NULL, FALSE);

			// status_student
			$members->status_student->SetDbValueDef($rsnew, $members->status_student->CurrentValue, NULL, FALSE);

			// ethnicity_korean
			$members->ethnicity_korean->SetDbValueDef($rsnew, $members->ethnicity_korean->CurrentValue, NULL, FALSE);

			// language_korean
			$members->language_korean->SetDbValueDef($rsnew, $members->language_korean->CurrentValue, NULL, FALSE);

			// access_level
			$members->access_level->SetDbValueDef($rsnew, $members->access_level->CurrentValue, NULL, FALSE);

			// active_member
			$members->active_member->SetDbValueDef($rsnew, $members->active_member->CurrentValue, NULL, FALSE);

			// Call Row Updating event
			$bUpdateRow = $members->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($members->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($members->CancelMessage <> "") {
					$this->setMessage($members->CancelMessage);
					$members->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$members->Row_Updated($rsold, $rsnew);
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
