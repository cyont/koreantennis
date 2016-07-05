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
$games_add = new cgames_add();
$Page =& $games_add;

// Page init
$games_add->Page_Init();

// Page main
$games_add->Page_Main();
?>
<?php include "header.php" ?>
<script type="text/javascript">
<!--

// Create page object
var games_add = new ew_Page("games_add");

// page properties
games_add.PageID = "add"; // page ID
games_add.FormID = "fgamesadd"; // form ID
var EW_PAGE_ID = games_add.PageID; // for backward compatibility

// extend page with ValidateForm function
games_add.ValidateForm = function(fobj) {
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
games_add.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
games_add.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
games_add.ValidateRequired = false; // no JavaScript validation
<?php } ?>

//-->
</script>
<script type="text/javascript">
function temp() {
	alert("hi");
}

function selectGroup(group) {
	// Slect group
	if (group == "A") {
	document.fgamesadd.x_r_group[0].checked = true;
	} else if (group == "B") {
	document.fgamesadd.x_r_group[1].checked = true;
	} else if (group == "C") {
	document.fgamesadd.x_r_group[2].checked = true;
	}
}
</script>
<p><span class="phpmaker"><?php echo $Language->Phrase("Add") ?>&nbsp;<?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $games->TableCaption() ?><br><br>
<a href="<?php echo $games->getReturnUrl() ?>"><?php echo $Language->Phrase("GoBack") ?></a></span></p>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$games_add->ShowMessage();
?>

<?php
// Display member names.
require_once('../Connections/connTennis.php');
mysql_select_db($database_connTennis, $connTennis);
// Query for Person 1
$query_rsNames = "SELECT M.Id, first_name_eng, last_name_eng, r_group, inactive FROM members M INNER JOIN groups G ON M.Id = G.Id ";
$query_rsNames .= "WHERE active_member = 1 ";
$query_rsNames .= "ORDER BY inactive, last_name_eng, first_name_eng ";
$rsNames = mysql_query($query_rsNames, $connTennis) or die(mysql_error());
$row_rsNames = mysql_fetch_assoc($rsNames);

// Query for Person 2
$query_rsNames2 = "SELECT M.Id, first_name_eng, last_name_eng, r_group, inactive FROM members M INNER JOIN groups G ON M.Id = G.Id ";
$query_rsNames .= "WHERE active_member = 1 ";
$query_rsNames2 .= "ORDER BY inactive, last_name_eng, first_name_eng ";
$rsNames2 = mysql_query($query_rsNames2, $connTennis) or die(mysql_error());
$row_rsNames2 = mysql_fetch_assoc($rsNames2);
// mysql_query('set names euckr');
?>



<form name="fgamesadd" id="fgamesadd" action="<?php echo ew_CurrentPage() ?>" method="post" onsubmit="return games_add.ValidateForm(this);">
<p>
<input type="hidden" name="t" id="t" value="games">
<input type="hidden" name="a_add" id="a_add" value="A">
<table cellspacing="0" class="ewGrid"><tr><td width="669" class="ewGridContent">
<div class="ewGridMiddlePanel">
<table cellspacing="0" class="ewTable" >
      <tr>
        <td width="40"></td>
        <td >Winner</td>
        <td >Winner Score</td>
        <td >Loser</td>
        <td >Loser Score</td>
      </tr>
<?php if ($games->person1->Visible) { // person1 ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td width="" class="ewTableHeader">Game Result</td>
		<td <?php echo $games->person1->CellAttributes() ?>>
        <span id="el_person1">       
        <select name="x_person1" id="x_person1" size="30" ;>
        <option value=" ">Select the Winner</option>
        <option value=" ">=================</option>
        <?php do { ?>        
            <?php if ($row_rsNames['inactive'] == 0) { ?>            
            <option value="<?php echo $row_rsNames['Id']; ?>"  onclick="selectGroup('<?php echo $row_rsNames['r_group']; ?>')"><?php echo $row_rsNames['r_group'] . " - " . $row_rsNames['last_name_eng'] . ", " . $row_rsNames['first_name_eng']; ?> </option>
            <?php } else { ?>
            <option value="<?php echo $row_rsNames['Id']; ?>"  onclick="selectGroup('<?php echo $row_rsNames['r_group']; ?>')"><?php echo "IA - " . $row_rsNames['last_name_eng'] . ", " . $row_rsNames['first_name_eng']; ?> </option>
			<?php } ?>
         <?php
		} while ($row_rsNames = mysql_fetch_assoc($rsNames));
		?>
        </select>
        </span>
        </td>
        
        <!--Winner Score-->
        <td<?php echo $games->person1_score->CellAttributes() ?> align="center" valign="top"><p>&nbsp;</p><span id="el_person1_score">
<input type="text" name="x_person1_score" id="x_person1_score" title="<?php echo $games->person1_score->FldTitle() ?>" size="3" value=""<?php echo $games->person1_score->EditAttributes() ?>>
</span><?php echo $games->person1_score->CustomMsg ?></td>

		<!--Person 2--> 
        <td<?php echo $games->person2->CellAttributes() ?>><span id="el_person2">
		  <select name="x_person2" id="x_person2" size="30" ;>
          <option value=" ">Select the Winner</option>
        <option value=" ">=================</option>
		    <?php do { ?> 
            <?php if ($row_rsNames2['inactive'] == 0) { ?>
		    <option value="<?php echo $row_rsNames2['Id']; ?>" onclick="selectGroup('<?php echo $row_rsNames2['r_group']; ?>')"><?php echo $row_rsNames2['r_group'] . " - " . $row_rsNames2['last_name_eng'] . ", " . $row_rsNames2['first_name_eng']; ?> </option>
            <?php } else { ?>
            <option value="<?php echo $row_rsNames2['Id']; ?>" onclick="selectGroup('<?php echo $row_rsNames2['r_group']; ?>')"><?php echo " IA - " . $row_rsNames2['last_name_eng'] . ", " . $row_rsNames2['first_name_eng']; ?> </option>
            <?php } ?>
            
		       <?php
		} while ($row_rsNames2 = mysql_fetch_assoc($rsNames2));
		?>
		    </select>
        </span><?php echo $games->person2->CustomMsg ?></td>
        
        <!--Loser Score-->
        <td<?php echo $games->person2_score->CellAttributes() ?> align="center" valign="top"><p>&nbsp;</p><span id="el_person2_score">
<input type="text" name="x_person2_score" id="x_person2_score" title="<?php echo $games->person2_score->FldTitle() ?>" size="3" value="<?php echo $games->person2_score->EditValue ?>"<?php echo $games->person2_score->EditAttributes() ?>>
</span><?php echo $games->person2_score->CustomMsg ?></td>
	</tr>
<?php } ?>


<?php if ($games->r_group->Visible) { // r_group ?>
	<tr<?php echo $games->RowAttributes() ?>>
		<td class="ewTableHeader">Group</td>
		<td<?php echo $games->r_group->CellAttributes() ?>  colspan="4"><span id="el_r_group" >&nbsp;&nbsp;&nbsp;
        <input name="x_r_group" id="x_r_group" type="radio" value="A" /> A&nbsp;&nbsp;&nbsp;
        <input name="x_r_group" id="x_r_group" type="radio" value="B" /> B&nbsp;&nbsp;&nbsp;
        <input name="x_r_group" id="x_r_group" type="radio" value="C" /> C
        
<!--<input type="text" name="x_r_group" id="x_r_group" title="<?php echo $games->r_group->FldTitle() ?>" size="30" maxlength="3" value="<?php echo $games->r_group->EditValue ?>"<?php echo $games->r_group->EditAttributes() ?>>-->
</span><?php echo $games->r_group->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php 
// Because of the time difference between Tucson and 1&1 Server, yesterday date is probably the date we want here.
$yesterday = date('Y/n/j', mktime(0, 0, 0, date("m") , date("d") - 1, date("Y")));
if (!isset($_SESSION['current_date'])) {
$current_date = $yesterday;
$_SESSION['current_date'] = $current_date;
} else {
$current_date = $_SESSION['current_date'];
}
?>
	<tr>
		<td class="ewTableHeader">Date</td>
		<td colspan="4"><span id="el_game_date" >
<input name="x_game_date" type="text" id="x_game_date" title="<?php echo $games->game_date->FldTitle() ?>" value="<?php echo $current_date; ?>" size="8">
</span><?php echo $games->game_date->CustomMsg ?></td>
	</tr>

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
$games_add->Page_Terminate();
?>
<?php

//
// Page class
//
class cgames_add {

	// Page ID
	var $PageID = 'add';

	// Table name
	var $TableName = 'games';

	// Page object name
	var $PageObjName = 'games_add';

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
	function cgames_add() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (games)
		$GLOBALS["games"] = new cgames();

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

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
	var $sDbMasterFilter = "";
	var $sDbDetailFilter = "";
	var $lPriv = 0;

	// 
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $games;

		// Load key values from QueryString
		$bCopy = TRUE;
		if (@$_GET["Id"] != "") {
		  $games->Id->setQueryStringValue($_GET["Id"]);
		} else {
		  $bCopy = FALSE;
		}

		// Process form if post back
		if (@$_POST["a_add"] <> "") {
		   $games->CurrentAction = $_POST["a_add"]; // Get form action
		  $this->LoadFormValues(); // Load form values

			// Validate form
			if (!$this->ValidateForm()) {
				$games->CurrentAction = "I"; // Form error, reset action
				$this->setMessage($gsFormError);
			}
		} else { // Not post back
		  if ($bCopy) {
		    $games->CurrentAction = "C"; // Copy record
		  } else {
		    $games->CurrentAction = "I"; // Display blank record
		    $this->LoadDefaultValues(); // Load default values
		  }
		}

		// Perform action based on action code
		switch ($games->CurrentAction) {
		  case "I": // Blank record, no action required
				break;
		  case "C": // Copy an existing record
		   if (!$this->LoadRow()) { // Load record based on key
		      $this->setMessage($Language->Phrase("NoRecord")); // No record found
		      $this->Page_Terminate("gameslist.php"); // No matching record, return to list
		    }
				break;
		  case "A": // ' Add new record
				$games->SendEmail = TRUE; // Send email on add success
		    if ($this->AddRow()) { // Add successful
		      $this->setMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $games->getReturnUrl();
					$this->Page_Terminate($sReturnUrl); // Clean up and return
		    } else {
		      $this->RestoreFormValues(); // Add failed, restore form values
		    }
		}

		// Render row based on row type
		$games->RowType = EW_ROWTYPE_ADD;  // Render add type

		// Render row
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $games;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		global $games;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm, $games;
		$games->person1->setFormValue($objForm->GetValue("x_person1"));
		$games->person1_score->setFormValue($objForm->GetValue("x_person1_score"));
		$games->person2->setFormValue($objForm->GetValue("x_person2"));
		$games->person2_score->setFormValue($objForm->GetValue("x_person2_score"));
		$games->r_group->setFormValue($objForm->GetValue("x_r_group"));
		$games->game_date->setFormValue($objForm->GetValue("x_game_date"));
		$games->game_date->CurrentValue = ew_UnFormatDateTime($games->game_date->CurrentValue, 5);
		$games->Id->setFormValue($objForm->GetValue("x_Id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm, $games;
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
		} elseif ($games->RowType == EW_ROWTYPE_ADD) { // Add row

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

	// Add record
	function AddRow() {
		global $conn, $Language, $Security, $games;
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

		// Call Row Inserting event
		$bInsertRow = $games->Row_Inserting($rsnew);
		if ($bInsertRow) {
			$conn->raiseErrorFn = 'ew_ErrorFn';
			$AddRow = $conn->Execute($games->InsertSQL($rsnew));
			$conn->raiseErrorFn = '';
		} else {
			if ($games->CancelMessage <> "") {
				$this->setMessage($games->CancelMessage);
				$games->CancelMessage = "";
			} else {
				$this->setMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {
			$games->Id->setDbValue($conn->Insert_ID());
			$rsnew['Id'] = $games->Id->DbValue;

			// Call Row Inserted event
			$games->Row_Inserted($rsnew);
		}

// Here goes the query to add extra records.
require_once('../Connections/connTennis.php');
// Update Person 1 for the Win
mysql_select_db($database_connTennis, $connTennis);
$query_rsPerson1 = "SELECT inactive, total_wins, current_wins, points FROM groups WHERE Id = " . $games->person1->CurrentValue . " ";
$rsPerson1 = mysql_query($query_rsPerson1, $connTennis) or die(mysql_error());
$row_rsPerson1 = mysql_fetch_assoc($rsPerson1);
$person1_total_wins = $row_rsPerson1['total_wins'] + 1;
$person1_current_wins = $row_rsPerson1['current_wins'] + 1;
$person1_points = $row_rsPerson1['points'] + (($games->person1_score->CurrentValue - $games->person2_score->CurrentValue) * 10);
// If this person is inactive, make it active
if ($row_rsPerson1['inactive'] == 0) {
$updateSQL = "UPDATE groups SET total_wins = " . $person1_total_wins . ", current_wins = " . $person1_current_wins . ", points = " . $person1_points . " WHERE Id = " . $games->person1->CurrentValue . " ";
} else { 
$updateSQL = "UPDATE groups SET inactive = 0, total_wins = " . $person1_total_wins . ", current_wins = " . $person1_current_wins . ", points = " . $person1_points . " WHERE Id = " . $games->person1->CurrentValue . " ";
}
$Result = mysql_query($updateSQL, $connTennis) or die(mysql_error());

// Update Person 2 for the Loss
$query_rsPerson2 = "SELECT inactive, total_losses, current_losses, points FROM groups WHERE Id = " . $games->person2->CurrentValue . " ";
$rsPerson2 = mysql_query($query_rsPerson2, $connTennis) or die(mysql_error());
$row_rsPerson2 = mysql_fetch_assoc($rsPerson2);
$person2_total_losses = $row_rsPerson2['total_losses'] + 1;
$person2_current_losses = $row_rsPerson2['current_losses'] + 1;
$person2_points = $row_rsPerson2['points'] - (($games->person1_score->CurrentValue - $games->person2_score->CurrentValue) * 10);
// If this person is inactive, make it active
if ($row_rsPerson2['inactive'] == 0) {
$updateSQL = "UPDATE groups SET total_losses = " . $person2_total_losses . ", current_losses = " . $person2_current_losses . ", points = " . $person2_points . " WHERE Id = " . $games->person2->CurrentValue . " ";
} else { 
$updateSQL = "UPDATE groups SET inactive = 0, total_losses = " . $person2_total_losses . ", current_losses = " . $person2_current_losses . ", points = " . $person2_points . " WHERE Id = " . $games->person2->CurrentValue . " ";
}
$Result = mysql_query($updateSQL, $connTennis) or die(mysql_error());


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
<?php
mysql_free_result($rsPerson1);
mysql_free_result($rsPerson2);
mysql_free_result($rsNames);
mysql_free_result($rsNames2);
?>