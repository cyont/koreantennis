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
$games_delete = new cgames_delete();
$Page =& $games_delete;

// Page init
$games_delete->Page_Init();

// Page main
$games_delete->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var games_delete = new ew_Page("games_delete");

// page properties
games_delete.PageID = "delete"; // page ID
games_delete.FormID = "fgamesdelete"; // form ID
var EW_PAGE_ID = games_delete.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
games_delete.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
games_delete.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
games_delete.ValidateRequired = false; // no JavaScript validation
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
if ($rs = $games_delete->LoadRecordset())
	$games_deletelTotalRecs = $rs->RecordCount(); // Get record count
if ($games_deletelTotalRecs <= 0) { // No record found, exit
	if ($rs)
		$rs->Close();
	$games_delete->Page_Terminate("gameslist.php"); // Return to list
}
?>
<p><span class="phpmaker"><?php echo $Language->Phrase("Delete") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $games->TableCaption() ?><br><br>
<a href="<?php echo $games->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$games_delete->ShowMessage();
?>
<form action="<?php echo ew_CurrentPage() ?>" method="post">
<p>
<input type="hidden" name="t" id="t" value="games">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($games_delete->arRecKeys as $key) { ?>
<input type="hidden" name="key_m[]" id="key_m[]" value="<?php echo ew_HtmlEncode($key) ?>">
<?php } ?>
<table class="ewGrid"><tr><td class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable ewTableSeparate">
<?php echo $games->TableCustomInnerHtml ?>
	<thead>
	<tr class="ewTableHeader">
		<td valign="top"><?php echo $games->Id->FldCaption() ?></td>
		<td valign="top"><?php echo $games->person1->FldCaption() ?></td>
		<td valign="top"><?php echo $games->person1_score->FldCaption() ?></td>
		<td valign="top"><?php echo $games->person2->FldCaption() ?></td>
		<td valign="top"><?php echo $games->person2_score->FldCaption() ?></td>
		<td valign="top"><?php echo $games->r_group->FldCaption() ?></td>
		<td valign="top"><?php echo $games->game_date->FldCaption() ?></td>
	</tr>
	</thead>
	<tbody>
<?php
$games_delete->lRecCnt = 0;
$i = 0;
while (!$rs->EOF) {
	$games_delete->lRecCnt++;

	// Set row properties
	$games->CssClass = "";
	$games->CssStyle = "";
	$games->RowAttrs = array();
	$games->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$games_delete->LoadRowValues($rs);

	// Render row
	$games_delete->RenderRow();
?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td<?php echo $games->Id->CellAttributes() ?>>
<div<?php echo $games->Id->ViewAttributes() ?>><?php echo $games->Id->ListViewValue() ?></div></td>
		<td<?php echo $games->person1->CellAttributes() ?>>
<div<?php echo $games->person1->ViewAttributes() ?>><?php echo $games->person1->ListViewValue() ?></div></td>
		<td<?php echo $games->person1_score->CellAttributes() ?>>
<div<?php echo $games->person1_score->ViewAttributes() ?>><?php echo $games->person1_score->ListViewValue() ?></div></td>
		<td<?php echo $games->person2->CellAttributes() ?>>
<div<?php echo $games->person2->ViewAttributes() ?>><?php echo $games->person2->ListViewValue() ?></div></td>
		<td<?php echo $games->person2_score->CellAttributes() ?>>
<div<?php echo $games->person2_score->ViewAttributes() ?>><?php echo $games->person2_score->ListViewValue() ?></div></td>
		<td<?php echo $games->r_group->CellAttributes() ?>>
<div<?php echo $games->r_group->ViewAttributes() ?>><?php echo $games->r_group->ListViewValue() ?></div></td>
		<td<?php echo $games->game_date->CellAttributes() ?>>
<div<?php echo $games->game_date->ViewAttributes() ?>><?php echo $games->game_date->ListViewValue() ?></div></td>
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
$games_delete->Page_Terminate();
?>
<?php

//
// Page class
//
class cgames_delete {

	// Page ID
	var $PageID = 'delete';

	// Table name
	var $TableName = 'games';

	// Page object name
	var $PageObjName = 'games_delete';

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
	function cgames_delete() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (games)
		$GLOBALS["games"] = new cgames();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'delete', TRUE);

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
		global $Language, $games;

		// Load key parameters
		$sKey = "";
		$bSingleDelete = TRUE; // Initialize as single delete
		$nKeySelected = 0; // Initialize selected key count
		$sFilter = "";
		if (@$_GET["Id"] <> "") {
			$games->Id->setQueryStringValue($_GET["Id"]);
			if (!is_numeric($games->Id->QueryStringValue))
				$this->Page_Terminate("gameslist.php"); // Prevent SQL injection, exit
			$sKey .= $games->Id->QueryStringValue;
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
			$this->Page_Terminate("gameslist.php"); // No key specified, return to list

		// Build filter
		foreach ($this->arRecKeys as $sKey) {
			$sFilter .= "(";

			// Set up key field
			$sKeyFld = $sKey;
			if (!is_numeric($sKeyFld))
				$this->Page_Terminate("gameslist.php"); // Prevent SQL injection, return to list
			$sFilter .= "`Id`=" . ew_AdjustSql($sKeyFld) . " AND ";
			if (substr($sFilter, -5) == " AND ") $sFilter = substr($sFilter, 0, strlen($sFilter)-5) . ") OR ";
		}
		if (substr($sFilter, -4) == " OR ") $sFilter = substr($sFilter, 0, strlen($sFilter)-4);

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in games class, gamesinfo.php

		$games->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$games->CurrentAction = $_POST["a_delete"];
		} else {
			$games->CurrentAction = "I"; // Display record
		}
		switch ($games->CurrentAction) {
			case "D": // Delete
				$games->SendEmail = TRUE; // Send email on delete success
				if ($this->DeleteRows()) { // delete rows
					$this->setMessage($Language->Phrase("DeleteSuccess")); // Set up success message
					$this->Page_Terminate($games->getReturnUrl()); // Return to caller
				}
		}
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $conn, $Language, $Security, $games;
		$DeleteRows = TRUE;
		$sWrkFilter = $games->CurrentFilter;

		// Set up filter (SQL WHERE clause) and get return SQL
		// SQL constructor in games class, gamesinfo.php

		$games->CurrentFilter = $sWrkFilter;
		$sSql = $games->SQL();
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
				$DeleteRows = $games->Row_Deleting($row);
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
				$DeleteRows = $conn->Execute($games->DeleteSQL($row)); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		} else {

			// Set up error message
			if ($games->CancelMessage <> "") {
				$this->setMessage($games->CancelMessage);
				$games->CancelMessage = "";
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
				$games->Row_Deleted($row);
			}	
		}
		return $DeleteRows;
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {
		global $conn, $games;

		// Call Recordset Selecting event
		$games->Recordset_Selecting($games->CurrentFilter);

		// Load List page SQL
		$sSql = $games->SelectSQL();
		if ($offset > -1 && $rowcnt > -1)
			$sSql .= " LIMIT $offset, $rowcnt";

		// Load recordset
		$rs = ew_LoadRecordset($sSql);

		// Call Recordset Selected event
		$games->Recordset_Selected($rs);
		return $rs;
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
		}

		// Call Row Rendered event
		if ($games->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$games->Row_Rendered();
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
