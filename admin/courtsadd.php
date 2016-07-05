<?php
session_start(); // Initialize Session data
ob_start(); // Turn on output buffering
?>
<?php include "ewcfg7.php" ?>
<?php include "ewmysql7.php" ?>
<?php include "phpfn7.php" ?>
<?php include "courtsinfo.php" ?>
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
$courts_add = new ccourts_add();
$Page =& $courts_add;

// Page init
$courts_add->Page_Init();

// Page main
$courts_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var courts_add = new ew_Page("courts_add");

// page properties
courts_add.PageID = "add"; // page ID
courts_add.FormID = "fcourtsadd"; // form ID
var EW_PAGE_ID = courts_add.PageID; // for backward compatibility

// extend page with ValidateForm function
courts_add.ValidateForm = function(fobj) {
	ew_PostAutoSuggest(fobj);
	if (!this.ValidateRequired)
		return true; // ignore validation
	if (fobj.a_confirm && fobj.a_confirm.value == "F")
		return true;
	var i, elm, aelm, infix;
	var rowcnt = (fobj.key_count) ? Number(fobj.key_count.value) : 1;
	for (i=0; i<rowcnt; i++) {
		infix = (fobj.key_count) ? String(i+1) : "";
		elm = fobj.elements["x" + infix + "_court_num"];
		if (elm && !ew_CheckInteger(elm.value))
			return ew_OnError(this, elm, "<?php echo ew_JsEncode2($courts->court_num->FldErrMsg()) ?>");

		// Call Form Custom Validate event
		if (!this.Form_CustomValidate(fobj)) return false;
	}
	return true;
}

// extend page with Form_CustomValidate function
courts_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
courts_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
courts_add.ValidateRequired = false; // no JavaScript validation
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
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $courts->TableCaption() ?><br><br>
<a href="<?php echo $courts->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$courts_add->ShowMessage();
?>
<form name="fcourtsadd" id="fcourtsadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return courts_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="courts">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable">
<?php if ($courts->name->Visible) { // name ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->name->FldCaption() ?></td>
		<td<?php echo $courts->name->CellAttributes() ?>><span id="el_name">
<input type="text" name="x_name" id="x_name" title="<?php echo $courts->name->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $courts->name->EditValue ?>"<?php echo $courts->name->EditAttributes() ?>>
</span><?php echo $courts->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($courts->region->Visible) { // region ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->region->FldCaption() ?></td>
		<td<?php echo $courts->region->CellAttributes() ?>><span id="el_region">
<input type="text" name="x_region" id="x_region" title="<?php echo $courts->region->FldTitle() ?>" size="30" maxlength="10" value="<?php echo $courts->region->EditValue ?>"<?php echo $courts->region->EditAttributes() ?>>
</span><?php echo $courts->region->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($courts->location->Visible) { // location ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->location->FldCaption() ?></td>
		<td<?php echo $courts->location->CellAttributes() ?>><span id="el_location">
<input type="text" name="x_location" id="x_location" title="<?php echo $courts->location->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $courts->location->EditValue ?>"<?php echo $courts->location->EditAttributes() ?>>
</span><?php echo $courts->location->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($courts->address->Visible) { // address ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->address->FldCaption() ?></td>
		<td<?php echo $courts->address->CellAttributes() ?>><span id="el_address">
<input type="text" name="x_address" id="x_address" title="<?php echo $courts->address->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $courts->address->EditValue ?>"<?php echo $courts->address->EditAttributes() ?>>
</span><?php echo $courts->address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($courts->zip->Visible) { // zip ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->zip->FldCaption() ?></td>
		<td<?php echo $courts->zip->CellAttributes() ?>><span id="el_zip">
<input type="text" name="x_zip" id="x_zip" title="<?php echo $courts->zip->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $courts->zip->EditValue ?>"<?php echo $courts->zip->EditAttributes() ?>>
</span><?php echo $courts->zip->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($courts->city->Visible) { // city ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->city->FldCaption() ?></td>
		<td<?php echo $courts->city->CellAttributes() ?>><span id="el_city">
<input type="text" name="x_city" id="x_city" title="<?php echo $courts->city->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $courts->city->EditValue ?>"<?php echo $courts->city->EditAttributes() ?>>
</span><?php echo $courts->city->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($courts->time->Visible) { // time ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->time->FldCaption() ?></td>
		<td<?php echo $courts->time->CellAttributes() ?>><span id="el_time">
<textarea name="x_time" id="x_time" title="<?php echo $courts->time->FldTitle() ?>" cols="35" rows="4"<?php echo $courts->time->EditAttributes() ?>><?php echo $courts->time->EditValue ?></textarea>
</span><?php echo $courts->time->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($courts->cost->Visible) { // cost ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->cost->FldCaption() ?></td>
		<td<?php echo $courts->cost->CellAttributes() ?>><span id="el_cost">
<textarea name="x_cost" id="x_cost" title="<?php echo $courts->cost->FldTitle() ?>" cols="35" rows="4"<?php echo $courts->cost->EditAttributes() ?>><?php echo $courts->cost->EditValue ?></textarea>
</span><?php echo $courts->cost->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($courts->court_num->Visible) { // court_num ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->court_num->FldCaption() ?></td>
		<td<?php echo $courts->court_num->CellAttributes() ?>><span id="el_court_num">
<input type="text" name="x_court_num" id="x_court_num" title="<?php echo $courts->court_num->FldTitle() ?>" size="30" value="<?php echo $courts->court_num->EditValue ?>"<?php echo $courts->court_num->EditAttributes() ?>>
</span><?php echo $courts->court_num->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($courts->lights->Visible) { // lights ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->lights->FldCaption() ?></td>
		<td<?php echo $courts->lights->CellAttributes() ?>><span id="el_lights">
<input type="text" name="x_lights" id="x_lights" title="<?php echo $courts->lights->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $courts->lights->EditValue ?>"<?php echo $courts->lights->EditAttributes() ?>>
</span><?php echo $courts->lights->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($courts->maintenance->Visible) { // maintenance ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->maintenance->FldCaption() ?></td>
		<td<?php echo $courts->maintenance->CellAttributes() ?>><span id="el_maintenance">
<input type="text" name="x_maintenance" id="x_maintenance" title="<?php echo $courts->maintenance->FldTitle() ?>" size="30" maxlength="20" value="<?php echo $courts->maintenance->EditValue ?>"<?php echo $courts->maintenance->EditAttributes() ?>>
</span><?php echo $courts->maintenance->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($courts->website->Visible) { // website ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->website->FldCaption() ?></td>
		<td<?php echo $courts->website->CellAttributes() ?>><span id="el_website">
<input type="text" name="x_website" id="x_website" title="<?php echo $courts->website->FldTitle() ?>" size="30" maxlength="255" value="<?php echo $courts->website->EditValue ?>"<?php echo $courts->website->EditAttributes() ?>>
</span><?php echo $courts->website->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php if ($courts->phone->Visible) { // phone ?>
	<tr<?php echo $courts->RowAttributes() ?>>
		<td class="ewTableHeader"><?php echo $courts->phone->FldCaption() ?></td>
		<td<?php echo $courts->phone->CellAttributes() ?>><span id="el_phone">
<input type="text" name="x_phone" id="x_phone" title="<?php echo $courts->phone->FldTitle() ?>" size="30" maxlength="50" value="<?php echo $courts->phone->EditValue ?>"<?php echo $courts->phone->EditAttributes() ?>>
</span><?php echo $courts->phone->CustomMsg ?></td>
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
$courts_add->Page_Terminate();
?>
<?php

//
// Page class
//
class ccourts_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'courts';

	// Page object name
	var $PageObjName = 'courts_add';

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		global $courts;
		if ($courts->UseTokenInUrl) $PageUrl .= "t=" . $courts->TableVar . "&"; // Add page token
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
		global $objForm, $courts;
		if ($courts->UseTokenInUrl) {
			if ($objForm)
				return ($courts->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($courts->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}

	//
	// Page class constructor
	//
	function ccourts_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (courts)
		$GLOBALS["courts"] = new ccourts();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'courts', TRUE);

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
		global $courts;

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
		global $objForm, $Language, $gsFormError, $courts;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["id"] != "") {
		  $courts->id->setQueryStringValue($_GET["id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $courts->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$courts->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $courts->CurrentAction = "C"; // Copy record
		  } else {
		    $courts->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($courts->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("courtslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$courts->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $courts->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$courts->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $courts;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $courts;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $courts;
		$courts->name->setFormValue($objForm->GetValue("x_name"));
		$courts->region->setFormValue($objForm->GetValue("x_region"));
		$courts->location->setFormValue($objForm->GetValue("x_location"));
		$courts->address->setFormValue($objForm->GetValue("x_address"));
		$courts->zip->setFormValue($objForm->GetValue("x_zip"));
		$courts->city->setFormValue($objForm->GetValue("x_city"));
		$courts->time->setFormValue($objForm->GetValue("x_time"));
		$courts->cost->setFormValue($objForm->GetValue("x_cost"));
		$courts->court_num->setFormValue($objForm->GetValue("x_court_num"));
		$courts->lights->setFormValue($objForm->GetValue("x_lights"));
		$courts->maintenance->setFormValue($objForm->GetValue("x_maintenance"));
		$courts->website->setFormValue($objForm->GetValue("x_website"));
		$courts->phone->setFormValue($objForm->GetValue("x_phone"));
		$courts->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $courts;
		$courts->id->CurrentValue = $courts->id->FormValue;
		$courts->name->CurrentValue = $courts->name->FormValue;
		$courts->region->CurrentValue = $courts->region->FormValue;
		$courts->location->CurrentValue = $courts->location->FormValue;
		$courts->address->CurrentValue = $courts->address->FormValue;
		$courts->zip->CurrentValue = $courts->zip->FormValue;
		$courts->city->CurrentValue = $courts->city->FormValue;
		$courts->time->CurrentValue = $courts->time->FormValue;
		$courts->cost->CurrentValue = $courts->cost->FormValue;
		$courts->court_num->CurrentValue = $courts->court_num->FormValue;
		$courts->lights->CurrentValue = $courts->lights->FormValue;
		$courts->maintenance->CurrentValue = $courts->maintenance->FormValue;
		$courts->website->CurrentValue = $courts->website->FormValue;
		$courts->phone->CurrentValue = $courts->phone->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $conn, $Security, $courts;
		$sFilter = $courts->KeyFilter();

		// Call Row Selecting event
		$courts->Row_Selecting($sFilter);

		// Load SQL based on filter
		$courts->CurrentFilter = $sFilter;
		$sSql = $courts->SQL();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values

			// Call Row Selected event
			$courts->Row_Selected($rs);
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues(&$rs) {
		global $conn, $courts;
		$courts->id->setDbValue($rs->fields('id'));
		$courts->name->setDbValue($rs->fields('name'));
		$courts->region->setDbValue($rs->fields('region'));
		$courts->location->setDbValue($rs->fields('location'));
		$courts->address->setDbValue($rs->fields('address'));
		$courts->zip->setDbValue($rs->fields('zip'));
		$courts->city->setDbValue($rs->fields('city'));
		$courts->time->setDbValue($rs->fields('time'));
		$courts->cost->setDbValue($rs->fields('cost'));
		$courts->court_num->setDbValue($rs->fields('court_num'));
		$courts->lights->setDbValue($rs->fields('lights'));
		$courts->maintenance->setDbValue($rs->fields('maintenance'));
		$courts->website->setDbValue($rs->fields('website'));
		$courts->phone->setDbValue($rs->fields('phone'));
	}

	// Render row values based on field settings
	function RenderRow() {
		global $conn, $Security, $Language, $courts;

		// Initialize URLs
		// Call Row_Rendering event

		$courts->Row_Rendering();

		// Common render codes for all row types
		// name

		$courts->name->CellCssStyle = ""; $courts->name->CellCssClass = "";
		$courts->name->CellAttrs = array(); $courts->name->ViewAttrs = array(); $courts->name->EditAttrs = array();

		// region
		$courts->region->CellCssStyle = ""; $courts->region->CellCssClass = "";
		$courts->region->CellAttrs = array(); $courts->region->ViewAttrs = array(); $courts->region->EditAttrs = array();

		// location
		$courts->location->CellCssStyle = ""; $courts->location->CellCssClass = "";
		$courts->location->CellAttrs = array(); $courts->location->ViewAttrs = array(); $courts->location->EditAttrs = array();

		// address
		$courts->address->CellCssStyle = ""; $courts->address->CellCssClass = "";
		$courts->address->CellAttrs = array(); $courts->address->ViewAttrs = array(); $courts->address->EditAttrs = array();

		// zip
		$courts->zip->CellCssStyle = ""; $courts->zip->CellCssClass = "";
		$courts->zip->CellAttrs = array(); $courts->zip->ViewAttrs = array(); $courts->zip->EditAttrs = array();

		// city
		$courts->city->CellCssStyle = ""; $courts->city->CellCssClass = "";
		$courts->city->CellAttrs = array(); $courts->city->ViewAttrs = array(); $courts->city->EditAttrs = array();

		// time
		$courts->time->CellCssStyle = ""; $courts->time->CellCssClass = "";
		$courts->time->CellAttrs = array(); $courts->time->ViewAttrs = array(); $courts->time->EditAttrs = array();

		// cost
		$courts->cost->CellCssStyle = ""; $courts->cost->CellCssClass = "";
		$courts->cost->CellAttrs = array(); $courts->cost->ViewAttrs = array(); $courts->cost->EditAttrs = array();

		// court_num
		$courts->court_num->CellCssStyle = ""; $courts->court_num->CellCssClass = "";
		$courts->court_num->CellAttrs = array(); $courts->court_num->ViewAttrs = array(); $courts->court_num->EditAttrs = array();

		// lights
		$courts->lights->CellCssStyle = ""; $courts->lights->CellCssClass = "";
		$courts->lights->CellAttrs = array(); $courts->lights->ViewAttrs = array(); $courts->lights->EditAttrs = array();

		// maintenance
		$courts->maintenance->CellCssStyle = ""; $courts->maintenance->CellCssClass = "";
		$courts->maintenance->CellAttrs = array(); $courts->maintenance->ViewAttrs = array(); $courts->maintenance->EditAttrs = array();

		// website
		$courts->website->CellCssStyle = ""; $courts->website->CellCssClass = "";
		$courts->website->CellAttrs = array(); $courts->website->ViewAttrs = array(); $courts->website->EditAttrs = array();

		// phone
		$courts->phone->CellCssStyle = ""; $courts->phone->CellCssClass = "";
		$courts->phone->CellAttrs = array(); $courts->phone->ViewAttrs = array(); $courts->phone->EditAttrs = array();
		if ($courts->RowType == EW_ROWTYPE_VIEW) { // View row

			// id
			$courts->id->ViewValue = $courts->id->CurrentValue;
			$courts->id->CssStyle = "";
			$courts->id->CssClass = "";
			$courts->id->ViewCustomAttributes = "";

			// name
			$courts->name->ViewValue = $courts->name->CurrentValue;
			$courts->name->CssStyle = "";
			$courts->name->CssClass = "";
			$courts->name->ViewCustomAttributes = "";

			// region
			$courts->region->ViewValue = $courts->region->CurrentValue;
			$courts->region->CssStyle = "";
			$courts->region->CssClass = "";
			$courts->region->ViewCustomAttributes = "";

			// location
			$courts->location->ViewValue = $courts->location->CurrentValue;
			$courts->location->CssStyle = "";
			$courts->location->CssClass = "";
			$courts->location->ViewCustomAttributes = "";

			// address
			$courts->address->ViewValue = $courts->address->CurrentValue;
			$courts->address->CssStyle = "";
			$courts->address->CssClass = "";
			$courts->address->ViewCustomAttributes = "";

			// zip
			$courts->zip->ViewValue = $courts->zip->CurrentValue;
			$courts->zip->CssStyle = "";
			$courts->zip->CssClass = "";
			$courts->zip->ViewCustomAttributes = "";

			// city
			$courts->city->ViewValue = $courts->city->CurrentValue;
			$courts->city->CssStyle = "";
			$courts->city->CssClass = "";
			$courts->city->ViewCustomAttributes = "";

			// time
			$courts->time->ViewValue = $courts->time->CurrentValue;
			$courts->time->CssStyle = "";
			$courts->time->CssClass = "";
			$courts->time->ViewCustomAttributes = "";

			// cost
			$courts->cost->ViewValue = $courts->cost->CurrentValue;
			$courts->cost->CssStyle = "";
			$courts->cost->CssClass = "";
			$courts->cost->ViewCustomAttributes = "";

			// court_num
			$courts->court_num->ViewValue = $courts->court_num->CurrentValue;
			$courts->court_num->CssStyle = "";
			$courts->court_num->CssClass = "";
			$courts->court_num->ViewCustomAttributes = "";

			// lights
			$courts->lights->ViewValue = $courts->lights->CurrentValue;
			$courts->lights->CssStyle = "";
			$courts->lights->CssClass = "";
			$courts->lights->ViewCustomAttributes = "";

			// maintenance
			$courts->maintenance->ViewValue = $courts->maintenance->CurrentValue;
			$courts->maintenance->CssStyle = "";
			$courts->maintenance->CssClass = "";
			$courts->maintenance->ViewCustomAttributes = "";

			// website
			$courts->website->ViewValue = $courts->website->CurrentValue;
			$courts->website->CssStyle = "";
			$courts->website->CssClass = "";
			$courts->website->ViewCustomAttributes = "";

			// phone
			$courts->phone->ViewValue = $courts->phone->CurrentValue;
			$courts->phone->CssStyle = "";
			$courts->phone->CssClass = "";
			$courts->phone->ViewCustomAttributes = "";

			// name
			$courts->name->HrefValue = "";
			$courts->name->TooltipValue = "";

			// region
			$courts->region->HrefValue = "";
			$courts->region->TooltipValue = "";

			// location
			$courts->location->HrefValue = "";
			$courts->location->TooltipValue = "";

			// address
			$courts->address->HrefValue = "";
			$courts->address->TooltipValue = "";

			// zip
			$courts->zip->HrefValue = "";
			$courts->zip->TooltipValue = "";

			// city
			$courts->city->HrefValue = "";
			$courts->city->TooltipValue = "";

			// time
			$courts->time->HrefValue = "";
			$courts->time->TooltipValue = "";

			// cost
			$courts->cost->HrefValue = "";
			$courts->cost->TooltipValue = "";

			// court_num
			$courts->court_num->HrefValue = "";
			$courts->court_num->TooltipValue = "";

			// lights
			$courts->lights->HrefValue = "";
			$courts->lights->TooltipValue = "";

			// maintenance
			$courts->maintenance->HrefValue = "";
			$courts->maintenance->TooltipValue = "";

			// website
			$courts->website->HrefValue = "";
			$courts->website->TooltipValue = "";

			// phone
			$courts->phone->HrefValue = "";
			$courts->phone->TooltipValue = "";
		} elseif ($courts->RowType == EW_ROWTYPE_ADD) { // Add row

			// name
			$courts->name->EditCustomAttributes = "";
			$courts->name->EditValue = ew_HtmlEncode($courts->name->CurrentValue);

			// region
			$courts->region->EditCustomAttributes = "";
			$courts->region->EditValue = ew_HtmlEncode($courts->region->CurrentValue);

			// location
			$courts->location->EditCustomAttributes = "";
			$courts->location->EditValue = ew_HtmlEncode($courts->location->CurrentValue);

			// address
			$courts->address->EditCustomAttributes = "";
			$courts->address->EditValue = ew_HtmlEncode($courts->address->CurrentValue);

			// zip
			$courts->zip->EditCustomAttributes = "";
			$courts->zip->EditValue = ew_HtmlEncode($courts->zip->CurrentValue);

			// city
			$courts->city->EditCustomAttributes = "";
			$courts->city->EditValue = ew_HtmlEncode($courts->city->CurrentValue);

			// time
			$courts->time->EditCustomAttributes = "";
			$courts->time->EditValue = ew_HtmlEncode($courts->time->CurrentValue);

			// cost
			$courts->cost->EditCustomAttributes = "";
			$courts->cost->EditValue = ew_HtmlEncode($courts->cost->CurrentValue);

			// court_num
			$courts->court_num->EditCustomAttributes = "";
			$courts->court_num->EditValue = ew_HtmlEncode($courts->court_num->CurrentValue);

			// lights
			$courts->lights->EditCustomAttributes = "";
			$courts->lights->EditValue = ew_HtmlEncode($courts->lights->CurrentValue);

			// maintenance
			$courts->maintenance->EditCustomAttributes = "";
			$courts->maintenance->EditValue = ew_HtmlEncode($courts->maintenance->CurrentValue);

			// website
			$courts->website->EditCustomAttributes = "";
			$courts->website->EditValue = ew_HtmlEncode($courts->website->CurrentValue);

			// phone
			$courts->phone->EditCustomAttributes = "";
			$courts->phone->EditValue = ew_HtmlEncode($courts->phone->CurrentValue);
		}

		// Call Row Rendered event
		if ($courts->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$courts->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError, $courts;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckInteger($courts->court_num->FormValue)) {
			if ($gsFormError <> "") $gsFormError .= "<br>";
			$gsFormError .= $courts->court_num->FldErrMsg();
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
		global $conn, $Language, $Security, $courts;
		$rsnew = array();

		// name
		$courts->name->SetDbValueDef($rsnew, $courts->name->CurrentValue, NULL, FALSE);

		// region
		$courts->region->SetDbValueDef($rsnew, $courts->region->CurrentValue, NULL, FALSE);

		// location
		$courts->location->SetDbValueDef($rsnew, $courts->location->CurrentValue, NULL, FALSE);

		// address
		$courts->address->SetDbValueDef($rsnew, $courts->address->CurrentValue, NULL, FALSE);

		// zip
		$courts->zip->SetDbValueDef($rsnew, $courts->zip->CurrentValue, NULL, FALSE);

		// city
		$courts->city->SetDbValueDef($rsnew, $courts->city->CurrentValue, NULL, FALSE);

		// time
		$courts->time->SetDbValueDef($rsnew, $courts->time->CurrentValue, NULL, FALSE);

		// cost
		$courts->cost->SetDbValueDef($rsnew, $courts->cost->CurrentValue, NULL, FALSE);

		// court_num
		$courts->court_num->SetDbValueDef($rsnew, $courts->court_num->CurrentValue, NULL, FALSE);

		// lights
		$courts->lights->SetDbValueDef($rsnew, $courts->lights->CurrentValue, NULL, FALSE);

		// maintenance
		$courts->maintenance->SetDbValueDef($rsnew, $courts->maintenance->CurrentValue, NULL, FALSE);

		// website
		$courts->website->SetDbValueDef($rsnew, $courts->website->CurrentValue, NULL, FALSE);

		// phone
		$courts->phone->SetDbValueDef($rsnew, $courts->phone->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$bInsertRow = $courts->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($courts->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($courts->CancelMessage <> "") {
				$this->setMessage($courts->CancelMessage);
				$courts->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$courts->id->setDbValue($conn->Insert_ID());
			$rsnew['id'] = $courts->id->DbValue;

			// Call Row Inserted event
			$courts->Row_Inserted($rsnew);
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
