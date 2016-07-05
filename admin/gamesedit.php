<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "gamesinfo.php" ?>
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
$games_edit = new cgames_edit();
$Page =& $games_edit;

// Page init
$games_edit->Page_Init();

// Page main
$games_edit->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var games_edit = new ew_Page("games_edit");

// page properties
games_edit.PageID = "edit"; // page ID
games_edit.FormID = "fgamesedit"; // form ID
var EW_PAGE_ID = games_edit.PageID; // for backward compatibility

// extend page with ValidateForm function
games_edit.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_person1"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($games->person1->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_person1"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($games->person1->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_person1_score"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($games->person1_score->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_person1_score"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($games->person1_score->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_person2"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($games->person2->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_person2"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($games->person2->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_person2_score"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($games->person2_score->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_person2_score"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($games->person2_score->FldErrMsg()) ?>");
		elm = fobj.elements["x" + infix + "_r_group"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($games->r_group->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_game_date"];
		if (elm && !ew_HasValue(elm))
			return ew_OnError(this, elm, ewLanguage.Phrase("EnterRequiredField") + " - <?php echo ew_JsEncode2($games->game_date->FldCaption()) ?>");
		elm = fobj.elements["x" + infix + "_game_date"];
		if (elm && !ew_CheckDate(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($games->game_date->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
games_edit.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
games_edit.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
games_edit.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Edit") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $games->TableCaption() ?><br><br>
<a href="<?php echo $games->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$games_edit->ShowMessage();
?>
<form name="fgamesedit" id="fgamesedit" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return games_edit.ValidateForm(this);">
<p>
<input type="hidden" name="a_table" id="a_table" value="games">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($games->Id->Visible) { // Id ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->Id->FldCaption() ?></td>
		<td<?php echo $games->Id->CellAttributes() ?>><span id="el_Id">
<div<?php echo $games->Id->ViewAttributes() ?>><?php echo $games->Id->EditValue ?></div><input type="hidden" name="x_Id" id="x_Id" value="<?php echo ew_HtmlEncode($games->Id->CurrentValue) ?>">
</span><?php echo $games->Id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($games->person1->Visible) { // person1 ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->person1->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $games->person1->CellAttributes() ?>><span id="el_person1">
<input type="text" name="x_person1" id="x_person1" title="<?php echo $games->person1->FldTitle() ?>" size="30" value="<?php echo $games->person1->EditValue ?>"<?php echo $games->person1->EditAttributes() ?>>
</span><?php echo $games->person1->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($games->person1_score->Visible) { // person1_score ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->person1_score->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $games->person1_score->CellAttributes() ?>><span id="el_person1_score">
<input type="text" name="x_person1_score" id="x_person1_score" title="<?php echo $games->person1_score->FldTitle() ?>" size="30" value="<?php echo $games->person1_score->EditValue ?>"<?php echo $games->person1_score->EditAttributes() ?>>
</span><?php echo $games->person1_score->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($games->person2->Visible) { // person2 ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->person2->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $games->person2->CellAttributes() ?>><span id="el_person2">
<input type="text" name="x_person2" id="x_person2" title="<?php echo $games->person2->FldTitle() ?>" size="30" value="<?php echo $games->person2->EditValue ?>"<?php echo $games->person2->EditAttributes() ?>>
</span><?php echo $games->person2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($games->person2_score->Visible) { // person2_score ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->person2_score->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $games->person2_score->CellAttributes() ?>><span id="el_person2_score">
<input type="text" name="x_person2_score" id="x_person2_score" title="<?php echo $games->person2_score->FldTitle() ?>" size="30" value="<?php echo $games->person2_score->EditValue ?>"<?php echo $games->person2_score->EditAttributes() ?>>
</span><?php echo $games->person2_score->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($games->r_group->Visible) { // r_group ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->r_group->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $games->r_group->CellAttributes() ?>><span id="el_r_group">
<input type="text" name="x_r_group" id="x_r_group" title="<?php echo $games->r_group->FldTitle() ?>" size="30" maxlength="3" value="<?php echo $games->r_group->EditValue ?>"<?php echo $games->r_group->EditAttributes() ?>>
</span><?php echo $games->r_group->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($games->game_date->Visible) { // game_date ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $games->game_date->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></td>
		<td<?php echo $games->game_date->CellAttributes() ?>><span id="el_game_date">
<input type="text" name="x_game_date" id="x_game_date" title="<?php echo $games->game_date->FldTitle() ?>" value="<?php echo $games->game_date->EditValue ?>"<?php echo $games->game_date->EditAttributes() ?>>
</span><?php echo $games->game_date->CustomMsg ?></td>
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
$games_edit->Page_Terminate();
?>
<?php

//
// Page class
//
class cgames_edit {

	// Page ID
	var $PageID = 'edit';

	// Table name
	var $TableName = 'games';

	// Page object name
	var $PageObjName = 'games_edit';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $games;
		if ($games->UseTokenInUrl) $PageUrl .= "t=" . $games->TableVar . "&"; // Add page token
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
		global $objForm, $games;
		if ($games->UseTokenInUrl) {
			if ($objForm)
				return ($games->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($games->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function cgames_edit() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (games)
		$GLOBALS["games"] = new cgames();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'games', TRUE);

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
		global $games;

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
		global $objForm, $Language, $gsFormError, $games;

		// Load key from QueryString
		if (@$_GET["Id"] <> "")
			$games->Id->setQueryStringValue($_GET["Id"]);
		if (@$_POST["a_edit"] <> "") {
			$games->CurrentAction = $_POST["a_edit"]; // Get action code
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$games->CurrentAction = ""; // Form error, reset action
				$this->setMessage($gsFormError);
				$games->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		} else {
			$games->CurrentAction = "I"; // Default action is display
		}

		// Check if valid key
		if ($games->Id->CurrentValue == "")
			$this->Page_Terminate("gameslist.php"); // Invalid key, return to list
		switch ($games->CurrentAction) {
			case "I": // Get a record to display
				if (!$this->LoadRow()) { // Load record based on key
					$this->setMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("gameslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$games->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					$this->setMessage($Language->Phrase("UpdateSuccess")); // Update success
					$sReturnUrl = $games->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$games->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed
				}
		}

		// Render the record
		$games->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $games;

		// Get upload data
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $games;
		$games->Id->setFormValue($objForm->GetValue("x_Id"));
		$games->person1->setFormValue($objForm->GetValue("x_person1"));
		$games->person1_score->setFormValue($objForm->GetValue("x_person1_score"));
		$games->person2->setFormValue($objForm->GetValue("x_person2"));
		$games->person2_score->setFormValue($objForm->GetValue("x_person2_score"));
		$games->r_group->setFormValue($objForm->GetValue("x_r_group"));
		$games->game_date->setFormValue($objForm->GetValue("x_game_date"));
		$games->game_date->CurrentValue = ew_UnFormatDateTime($games->game_date->CurrentValue, 5);
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $games;
		$this->LoadRow();
		$games->Id->CurrentValue = $games->Id->FormValue;
		$games->person1->CurrentValue = $games->person1->FormValue;
		$games->person1_score->CurrentValue = $games->person1_score->FormValue;
		$games->person2->CurrentValue = $games->person2->FormValue;
		$games->person2_score->CurrentValue = $games->person2_score->FormValue;
		$games->r_group->CurrentValue = $games->r_group->FormValue;
		$games->game_date->CurrentValue = $games->game_date->FormValue;
		$games->game_date->CurrentValue = ew_UnFormatDateTime($games->game_date->CurrentValue, 5);
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $games;
		$sFilter = $games->KeyFilter();

		// Call Row Selecting event
		$games->Row_Selecting($sFilter);

		// Load SQL based on filter
		$games->CurrentFilter = $sFilter;
		$sSql = $games->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$games->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $games;
		$games->Id->setDbValue($rs->fields('Id'));
		$games->person1->setDbValue($rs->fields('person1'));
		$games->person1_score->setDbValue($rs->fields('person1_score'));
		$games->person2->setDbValue($rs->fields('person2'));
		$games->person2_score->setDbValue($rs->fields('person2_score'));
		$games->r_group->setDbValue($rs->fields('r_group'));
		$games->game_date->setDbValue($rs->fields('game_date'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $games;

		// Initialize URLs
		// Call Row_Rendering event

		$games->Row_Rendering();

		// Common render codes for all row types
		// Id

		$games->Id->CellCssStyle = ""; $games->Id->CellCssClass = "";
		$games->Id->CellAttrs = array(); $games->Id->ViewAttrs = array(); $games->Id->EditAttrs = array();

		// person1
		$games->person1->CellCssStyle = ""; $games->person1->CellCssClass = "";
		$games->person1->CellAttrs = array(); $games->person1->ViewAttrs = array(); $games->person1->EditAttrs = array();

		// person1_score
		$games->person1_score->CellCssStyle = ""; $games->person1_score->CellCssClass = "";
		$games->person1_score->CellAttrs = array(); $games->person1_score->ViewAttrs = array(); $games->person1_score->EditAttrs = array();

		// person2
		$games->person2->CellCssStyle = ""; $games->person2->CellCssClass = "";
		$games->person2->CellAttrs = array(); $games->person2->ViewAttrs = array(); $games->person2->EditAttrs = array();

		// person2_score
		$games->person2_score->CellCssStyle = ""; $games->person2_score->CellCssClass = "";
		$games->person2_score->CellAttrs = array(); $games->person2_score->ViewAttrs = array(); $games->person2_score->EditAttrs = array();

		// r_group
		$games->r_group->CellCssStyle = ""; $games->r_group->CellCssClass = "";
		$games->r_group->CellAttrs = array(); $games->r_group->ViewAttrs = array(); $games->r_group->EditAttrs = array();

		// game_date
		$games->game_date->CellCssStyle = ""; $games->game_date->CellCssClass = "";
		$games->game_date->CellAttrs = array(); $games->game_date->ViewAttrs = array(); $games->game_date->EditAttrs = array();
		if ($games->RowType == EW_ROWTYPE_VIEW) { // View row

			// Id
			$games->Id->ViewValue = $games->Id->CurrentValue;
			$games->Id->CssStyle = "";
			$games->Id->CssClass = "";
			$games->Id->ViewCustomAttributes = "";

			// person1
			$games->person1->ViewValue = $games->person1->CurrentValue;
			$games->person1->CssStyle = "";
			$games->person1->CssClass = "";
			$games->person1->ViewCustomAttributes = "";

			// person1_score
			$games->person1_score->ViewValue = $games->person1_score->CurrentValue;
			$games->person1_score->CssStyle = "";
			$games->person1_score->CssClass = "";
			$games->person1_score->ViewCustomAttributes = "";

			// person2
			$games->person2->ViewValue = $games->person2->CurrentValue;
			$games->person2->CssStyle = "";
			$games->person2->CssClass = "";
			$games->person2->ViewCustomAttributes = "";

			// person2_score
			$games->person2_score->ViewValue = $games->person2_score->CurrentValue;
			$games->person2_score->CssStyle = "";
			$games->person2_score->CssClass = "";
			$games->person2_score->ViewCustomAttributes = "";

			// r_group
			$games->r_group->ViewValue = $games->r_group->CurrentValue;
			$games->r_group->CssStyle = "";
			$games->r_group->CssClass = "";
			$games->r_group->ViewCustomAttributes = "";

			// game_date
			$games->game_date->ViewValue = $games->game_date->CurrentValue;
			$games->game_date->ViewValue = ew_FormatDateTime($games->game_date->ViewValue, 5);
			$games->game_date->CssStyle = "";
			$games->game_date->CssClass = "";
			$games->game_date->ViewCustomAttributes = "";

			// Id
			$games->Id->HrefValue = "";
			$games->Id->TooltipValue = "";

			// person1
			$games->person1->HrefValue = "";
			$games->person1->TooltipValue = "";

			// person1_score
			$games->person1_score->HrefValue = "";
			$games->person1_score->TooltipValue = "";

			// person2
			$games->person2->HrefValue = "";
			$games->person2->TooltipValue = "";

			// person2_score
			$games->person2_score->HrefValue = "";
			$games->person2_score->TooltipValue = "";

			// r_group
			$games->r_group->HrefValue = "";
			$games->r_group->TooltipValue = "";

			// game_date
			$games->game_date->HrefValue = "";
			$games->game_date->TooltipValue = "";
		} elseif ($games->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// Id
			$games->Id->EditCustomAttributes = "";
			$games->Id->EditValue = $games->Id->CurrentValue;
			$games->Id->CssStyle = "";
			$games->Id->CssClass = "";
			$games->Id->ViewCustomAttributes = "";

			// person1
			$games->person1->EditCustomAttributes = "";
			$games->person1->EditValue = ew_HtmlEncode($games->person1->CurrentValue);

			// person1_score
			$games->person1_score->EditCustomAttributes = "";
			$games->person1_score->EditValue = ew_HtmlEncode($games->person1_score->CurrentValue);

			// person2
			$games->person2->EditCustomAttributes = "";
			$games->person2->EditValue = ew_HtmlEncode($games->person2->CurrentValue);

			// person2_score
			$games->person2_score->EditCustomAttributes = "";
			$games->person2_score->EditValue = ew_HtmlEncode($games->person2_score->CurrentValue);

			// r_group
			$games->r_group->EditCustomAttributes = "";
			$games->r_group->EditValue = ew_HtmlEncode($games->r_group->CurrentValue);

			// game_date
			$games->game_date->EditCustomAttributes = "";
			$games->game_date->EditValue = ew_HtmlEncode(ew_FormatDateTime($games->game_date->CurrentValue, 5));

			// Edit refer script
			// Id

			$games->Id->HrefValue = "";

			// person1
			$games->person1->HrefValue = "";

			// person1_score
			$games->person1_score->HrefValue = "";

			// person2
			$games->person2->HrefValue = "";

			// person2_score
			$games->person2_score->HrefValue = "";

			// r_group
			$games->r_group->HrefValue = "";

			// game_date
			$games->game_date->HrefValue = "";
		}

		// Call Row Rendered event
		if ($games->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$games->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $games;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!is_null($games->person1->FormValue) && $games->person1->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $games->person1->FldCaption();
		}
		if (!ew_CheckInteger($games->person1->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $games->person1->FldErrMsg();
		}
		if (!is_null($games->person1_score->FormValue) && $games->person1_score->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $games->person1_score->FldCaption();
		}
		if (!ew_CheckInteger($games->person1_score->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $games->person1_score->FldErrMsg();
		}
		if (!is_null($games->person2->FormValue) && $games->person2->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $games->person2->FldCaption();
		}
		if (!ew_CheckInteger($games->person2->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $games->person2->FldErrMsg();
		}
		if (!is_null($games->person2_score->FormValue) && $games->person2_score->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $games->person2_score->FldCaption();
		}
		if (!ew_CheckInteger($games->person2_score->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $games->person2_score->FldErrMsg();
		}
		if (!is_null($games->r_group->FormValue) && $games->r_group->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $games->r_group->FldCaption();
		}
		if (!is_null($games->game_date->FormValue) && $games->game_date->FormValue == "") {
			$gsFormError .= ($gsFormError <> "") ? "<br>" : "";
			$gsFormError .= $Language->Phrase("EnterRequiredField") . " - " . $games->game_date->FldCaption();
		}
		if (!ew_CheckDate($games->game_date->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $games->game_date->FldErrMsg();
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
		global $conn, $Security, $Language, $games;
		$sFilter = $games->KeyFilter();
		$games->CurrentFilter = $sFilter;
		$sSql = $games->SQL();
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

			// person1
			$games->person1->SetDbValueDef($rsnew, $games->person1->CurrentValue, 0, FALSE);

			// person1_score
			$games->person1_score->SetDbValueDef($rsnew, $games->person1_score->CurrentValue, 0, FALSE);

			// person2
			$games->person2->SetDbValueDef($rsnew, $games->person2->CurrentValue, 0, FALSE);

			// person2_score
			$games->person2_score->SetDbValueDef($rsnew, $games->person2_score->CurrentValue, 0, FALSE);

			// r_group
			$games->r_group->SetDbValueDef($rsnew, $games->r_group->CurrentValue, "", FALSE);

			// game_date
			$games->game_date->SetDbValueDef($rsnew, ew_UnFormatDateTime($games->game_date->CurrentValue, 5, FALSE), ew_CurrentDate());

			// Call Row Updating event
			$bUpdateRow = $games->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = 'ew_ErrorFn';
				$EditRow = $conn->Execute($games->UpdateSQL($rsnew));
				$conn->raiseErrorFn = '';
			} else {
				if ($games->CancelMessage <> "") {
					$this->setMessage($games->CancelMessage);
					$games->CancelMessage = "";
				} else {
					$this->setMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$games->Row_Updated($rsold, $rsnew);
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
