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
$games_list = new cgames_list();
$Page =& $games_list;

// Page init
$games_list->Page_Init();

// Page main
$games_list->Page_Main();
?>
<?php include "header.php" ?>
<?php if ($games->Export == "") { ?>
<script type="text/javascript">
<!--

// Create page object
var games_list = new ew_Page("games_list");

// page properties
games_list.PageID = "list"; // page ID
games_list.FormID = "fgameslist"; // form ID
var EW_PAGE_ID = games_list.PageID; // for backward compatibility

// extend page with Form_CustomValidate function
games_list.Form_CustomValidate =  
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid. 
 	return true;
 }
<?php if (EW_CLIENT_VALIDATE) { ?>
games_list.ValidateRequired = true; // uses JavaScript validation
<?php } else { ?>
games_list.ValidateRequired = false; // no JavaScript validation
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
<?php } ?>
<?php if ($games->Export == "") { ?>
<?php } ?>
<?php
	$bSelectLimit = EW_SELECT_LIMIT;
	if ($bSelectLimit) {
		$games_list->lTotalRecs = $games->SelectRecordCount();
	} else {
		if ($rs = $games_list->LoadRecordset())
			$games_list->lTotalRecs = $rs->RecordCount();
	}
	$games_list->lStartRec = 1;
	if ($games_list->lDisplayRecs <= 0 || ($games->Export <> "" && $games->ExportAll)) // Display all records
		$games_list->lDisplayRecs = $games_list->lTotalRecs;
	if (!($games->Export <> "" && $games->ExportAll))
		$games_list->SetUpStartRec(); // Set up start record position
	if ($bSelectLimit)
		$rs = $games_list->LoadRecordset($games_list->lStartRec-1, $games_list->lDisplayRecs);
?>
<p><span class="phpmaker" style="white-space: nowrap;"><?php echo $Language->Phrase("TblTypeTABLE") ?><?php echo $games->TableCaption() ?>
</span></p>
<?php if ($Security->IsLoggedIn()) { ?>
<?php if ($games->Export == "" && $games->CurrentAction == "") { ?>
<a href="javascript:ew_ToggleSearchPanel(games_list);" style="text-decoration: none;"><img id="games_list_SearchImage" src="images/collapse.gif" alt="" width="9" height="9" border="0"></a><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("Search") ?></span><br>
<div id="games_list_SearchPanel">
<form name="fgameslistsrch" id="fgameslistsrch" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<input type="hidden" id="t" name="t" value="games">
<table class="ewBasicSearch">
	<tr>
		<td><span class="phpmaker">
			<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" size="20" value="<?php echo ew_HtmlEncode($games->getSessionBasicSearchKeyword()) ?>">
			<input type="Submit" name="Submit" id="Submit" value="<?php echo ew_BtnCaption($Language->Phrase("QuickSearchBtn")) ?>">&nbsp;
			<a href="<?php echo $games_list->PageUrl() ?>cmd=reset"><?php echo $Language->Phrase("ShowAll") ?></a>&nbsp;
		</span></td>
	</tr>
	<tr>
	<td><span class="phpmaker"><label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value=""<?php if ($games->getSessionBasicSearchType() == "") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("ExactPhrase") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="AND"<?php if ($games->getSessionBasicSearchType() == "AND") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AllWord") ?></label>&nbsp;&nbsp;<label><input type="radio" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="OR"<?php if ($games->getSessionBasicSearchType() == "OR") { ?> checked="checked"<?php } ?>><?php echo $Language->Phrase("AnyWord") ?></label></span></td>
	</tr>
</table>
</form>
</div>
<?php } ?>
<?php } ?>
<?php
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
$games_list->ShowMessage();
?>
<br>
<table cellspacing="0" class="ewGrid"><tr><td class="ewGridContent">
<form name="fgameslist" id="fgameslist" class="ewForm" action="" method="post">
<div id="gmp_games" class="ewGridMiddlePanel">
<?php if ($games_list->lTotalRecs > 0) { ?>
<table cellspacing="0" rowhighlightclass="ewTableHighlightRow" rowselectclass="ewTableSelectRow" roweditclass="ewTableEditRow" class="ewTable ewTableSeparate">
<?php echo $games->TableCustomInnerHtml ?>
<thead><!-- Table header -->
	<tr class="ewTableHeader">
<?php

// Render list options
$games_list->RenderListOptions();

// Render list options (header, left)
$games_list->ListOptions->Render("header", "left");
?>
<?php if ($games->Id->Visible) { // Id ?>
	<?php if ($games->SortUrl($games->Id) == "") { ?>
		<td><?php echo $games->Id->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $games->SortUrl($games->Id) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $games->Id->FldCaption() ?></td><td style="width: 10px;"><?php if ($games->Id->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($games->Id->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($games->person1->Visible) { // person1 ?>
	<?php if ($games->SortUrl($games->person1) == "") { ?>
		<td><?php echo $games->person1->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $games->SortUrl($games->person1) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $games->person1->FldCaption() ?></td><td style="width: 10px;"><?php if ($games->person1->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($games->person1->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($games->person1_score->Visible) { // person1_score ?>
	<?php if ($games->SortUrl($games->person1_score) == "") { ?>
		<td><?php echo $games->person1_score->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $games->SortUrl($games->person1_score) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $games->person1_score->FldCaption() ?></td><td style="width: 10px;"><?php if ($games->person1_score->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($games->person1_score->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($games->person2->Visible) { // person2 ?>
	<?php if ($games->SortUrl($games->person2) == "") { ?>
		<td><?php echo $games->person2->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $games->SortUrl($games->person2) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $games->person2->FldCaption() ?></td><td style="width: 10px;"><?php if ($games->person2->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($games->person2->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($games->person2_score->Visible) { // person2_score ?>
	<?php if ($games->SortUrl($games->person2_score) == "") { ?>
		<td><?php echo $games->person2_score->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $games->SortUrl($games->person2_score) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $games->person2_score->FldCaption() ?></td><td style="width: 10px;"><?php if ($games->person2_score->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($games->person2_score->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($games->r_group->Visible) { // r_group ?>
	<?php if ($games->SortUrl($games->r_group) == "") { ?>
		<td><?php echo $games->r_group->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $games->SortUrl($games->r_group) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $games->r_group->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></td><td style="width: 10px;"><?php if ($games->r_group->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($games->r_group->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php if ($games->game_date->Visible) { // game_date ?>
	<?php if ($games->SortUrl($games->game_date) == "") { ?>
		<td><?php echo $games->game_date->FldCaption() ?></td>
	<?php } else { ?>
		<td><div class="ewPointer" onmousedown="ew_Sort(event,'<?php echo $games->SortUrl($games->game_date) ?>',1);">
			<table cellspacing="0" class="ewTableHeaderBtn"><thead><tr><td><?php echo $games->game_date->FldCaption() ?></td><td style="width: 10px;"><?php if ($games->game_date->getSort() == "ASC") { ?><img src="images/sortup.gif" width="10" height="9" border="0"><?php } elseif ($games->game_date->getSort() == "DESC") { ?><img src="images/sortdown.gif" width="10" height="9" border="0"><?php } ?></td></tr></thead></table>
		</div></td>		
	<?php } ?>
<?php } ?>		
<?php

// Render list options (header, right)
$games_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<?php
if ($games->ExportAll && $games->Export <> "") {
	$games_list->lStopRec = $games_list->lTotalRecs;
} else {
	$games_list->lStopRec = $games_list->lStartRec + $games_list->lDisplayRecs - 1; // Set the last record to display
}
$games_list->lRecCount = $games_list->lStartRec - 1;
if ($rs && !$rs->EOF) {
	$rs->MoveFirst();
	if (!$bSelectLimit && $games_list->lStartRec > 1)
		$rs->Move($games_list->lStartRec - 1);
}

// Initialize aggregate
$games->RowType = EW_ROWTYPE_AGGREGATEINIT;
$games_list->RenderRow();
$games_list->lRowCnt = 0;
while (($games->CurrentAction == "gridadd" || !$rs->EOF) &&
	$games_list->lRecCount < $games_list->lStopRec) {
	$games_list->lRecCount++;
	if (intval($games_list->lRecCount) >= intval($games_list->lStartRec)) {
		$games_list->lRowCnt++;

	// Init row class and style
	$games->CssClass = "";
	$games->CssStyle = "";
	$games->RowAttrs = array('onmouseover'=>'ew_MouseOver(event, this);', 'onmouseout'=>'ew_MouseOut(event, this);', 'onclick'=>'ew_Click(event, this);');
	if ($games->CurrentAction == "gridadd") {
		$games_list->LoadDefaultValues(); // Load default values
	} else {
		$games_list->LoadRowValues($rs); // Load row values
	}
	$games->RowType = EW_ROWTYPE_VIEW; // Render view

	// Render row
	$games_list->RenderRow();

	// Render list options
	$games_list->RenderListOptions();
?>
	<tr<?php echo $games->RowAttributes() ?>>
<?php

// Render list options (body, left)
$games_list->ListOptions->Render("body", "left");
?>
	<?php if ($games->Id->Visible) { // Id ?>
		<td<?php echo $games->Id->CellAttributes() ?>>
<div<?php echo $games->Id->ViewAttributes() ?>><?php echo $games->Id->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($games->person1->Visible) { // person1 ?>
		<td<?php echo $games->person1->CellAttributes() ?>>
<div<?php echo $games->person1->ViewAttributes() ?>><?php echo $games->person1->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($games->person1_score->Visible) { // person1_score ?>
		<td<?php echo $games->person1_score->CellAttributes() ?>>
<div<?php echo $games->person1_score->ViewAttributes() ?>><?php echo $games->person1_score->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($games->person2->Visible) { // person2 ?>
		<td<?php echo $games->person2->CellAttributes() ?>>
<div<?php echo $games->person2->ViewAttributes() ?>><?php echo $games->person2->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($games->person2_score->Visible) { // person2_score ?>
		<td<?php echo $games->person2_score->CellAttributes() ?>>
<div<?php echo $games->person2_score->ViewAttributes() ?>><?php echo $games->person2_score->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($games->r_group->Visible) { // r_group ?>
		<td<?php echo $games->r_group->CellAttributes() ?>>
<div<?php echo $games->r_group->ViewAttributes() ?>><?php echo $games->r_group->ListViewValue() ?></div>
</td>
	<?php } ?>
	<?php if ($games->game_date->Visible) { // game_date ?>
		<td<?php echo $games->game_date->CellAttributes() ?>>
<div<?php echo $games->game_date->ViewAttributes() ?>><?php echo $games->game_date->ListViewValue() ?></div>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$games_list->ListOptions->Render("body", "right");
?>
	</tr>
<?php
	}
	if ($games->CurrentAction <> "gridadd")
		$rs->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($rs)
	$rs->Close();
?>
<?php if ($games->Export == "") { ?>
<div class="ewGridLowerPanel">
<?php if ($games->CurrentAction <> "gridadd" && $games->CurrentAction <> "gridedit") { ?>
<form name="ewpagerform" id="ewpagerform" class="ewForm" action="<?php echo ew_CurrentPage() ?>">
<table border="0" cellspacing="0" cellpadding="0" class="ewPager">
	<tr>
		<td nowrap>
<?php if (!isset($games_list->Pager)) $games_list->Pager = new cPrevNextPager($games_list->lStartRec, $games_list->lDisplayRecs, $games_list->lTotalRecs) ?>
<?php if ($games_list->Pager->RecordCount > 0) { ?>
	<table border="0" cellspacing="0" cellpadding="0"><tr><td><span class="phpmaker"><?php echo $Language->Phrase("Page") ?>&nbsp;</span></td>
<!--first page button-->
	<?php if ($games_list->Pager->FirstButton->Enabled) { ?>
	<td><a href="<?php echo $games_list->PageUrl() ?>start=<?php echo $games_list->Pager->FirstButton->Start ?>"><img src="images/first.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/firstdisab.gif" alt="<?php echo $Language->Phrase("PagerFirst") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--previous page button-->
	<?php if ($games_list->Pager->PrevButton->Enabled) { ?>
	<td><a href="<?php echo $games_list->PageUrl() ?>start=<?php echo $games_list->Pager->PrevButton->Start ?>"><img src="images/prev.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></a></td>
	<?php } else { ?>
	<td><img src="images/prevdisab.gif" alt="<?php echo $Language->Phrase("PagerPrevious") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--current page number-->
	<td><input type="text" name="<?php echo EW_TABLE_PAGE_NO ?>" id="<?php echo EW_TABLE_PAGE_NO ?>" value="<?php echo $games_list->Pager->CurrentPage ?>" size="4"></td>
<!--next page button-->
	<?php if ($games_list->Pager->NextButton->Enabled) { ?>
	<td><a href="<?php echo $games_list->PageUrl() ?>start=<?php echo $games_list->Pager->NextButton->Start ?>"><img src="images/next.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/nextdisab.gif" alt="<?php echo $Language->Phrase("PagerNext") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
<!--last page button-->
	<?php if ($games_list->Pager->LastButton->Enabled) { ?>
	<td><a href="<?php echo $games_list->PageUrl() ?>start=<?php echo $games_list->Pager->LastButton->Start ?>"><img src="images/last.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></a></td>	
	<?php } else { ?>
	<td><img src="images/lastdisab.gif" alt="<?php echo $Language->Phrase("PagerLast") ?>" width="16" height="16" border="0"></td>
	<?php } ?>
	<td><span class="phpmaker">&nbsp;<?php echo $Language->Phrase("of") ?>&nbsp;<?php echo $games_list->Pager->PageCount ?></span></td>
	</tr></table>
	</td>	
	<td>&nbsp;&nbsp;&nbsp;&nbsp;</td>
	<td>
	<span class="phpmaker"><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $games_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $games_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $games_list->Pager->RecordCount ?></span>
<?php } else { ?>
	<?php if ($games_list->sSrchWhere == "0=101") { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("EnterSearchCriteria") ?></span>
	<?php } else { ?>
	<span class="phpmaker"><?php echo $Language->Phrase("NoRecord") ?></span>
	<?php } ?>
<?php } ?>
		</td>
	</tr>
</table>
</form>
<?php } ?>
<?php //if ($games_list->lTotalRecs > 0) { ?>
<span class="phpmaker">
<?php if ($Security->IsLoggedIn()) { ?>
<a href="<?php echo $games_list->AddUrl ?>"><?php echo $Language->Phrase("AddLink") ?></a>&nbsp;&nbsp;
<?php } ?>
</span>
<?php //} ?>
</div>
<?php } ?>
</td></tr></table>
<?php if ($games->Export == "" && $games->CurrentAction == "") { ?>
<?php } ?>
<?php if ($games->Export == "") { ?>
<script language="JavaScript" type="text/javascript">
<!--

// Write your table-specific startup script here
// document.write("page loaded");
//-->

</script>
<?php } ?>
<?php include "footer.php" ?>
<?php
$games_list->Page_Terminate();
?>
<?php

//
// Page class
//
class cgames_list {

	// Page ID
	var $PageID = 'list';

	// Table name
	var $TableName = 'games';

	// Page object name
	var $PageObjName = 'games_list';

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
	function cgames_list() {
		global $conn, $Language;

		// Language object
		$Language = new cLanguage();

		// Table object (games)
		$GLOBALS["games"] = new cgames();

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->AddUrl = $GLOBALS["games"]->AddUrl();
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "gamesdelete.php";
		$this->MultiUpdateUrl = "gamesupdate.php";

		// Table object (members)
		$GLOBALS['members'] = new cmembers();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'games', TRUE);

		// Start timer
		$GLOBALS["gsTimer"] = new cTimer();

		// Open connection
		$conn = ew_Connect();

		// List options
		$this->ListOptions = new cListOptions();
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

		// Get export parameters
		if (@$_GET["export"] <> "") {
			$games->Export = $_GET["export"];
		} elseif (ew_IsHttpPost()) {
			if (@$_POST["exporttype"] <> "")
				$games->Export = $_POST["exporttype"];
		} else {
			$games->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExport = $games->Export; // Get export parameter, used in header
		$gsExportFile = $games->TableVar; // Get export file, used in header

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

	// Class variables
	var $ListOptions; // List options
	var $lDisplayRecs = 20;
	var $lStartRec;
	var $lStopRec;
	var $lTotalRecs = 0;
	var $lRecRange = 10;
	var $sSrchWhere = ""; // Search WHERE clause
	var $lRecCnt = 0; // Record count
	var $lEditRowCnt;
	var $lRowCnt;
	var $lRowIndex; // Row index
	var $lRecPerRow = 0;
	var $lColCnt = 0;
	var $sDbMasterFilter = ""; // Master filter
	var $sDbDetailFilter = ""; // Detail filter
	var $bMasterRecordExists;	
	var $sMultiSelectKey;
	var $RestoreSearch;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsSearchError, $Security, $games;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";
		if ($this->IsPageRequest()) { // Validate request

			// Handle reset command
			$this->ResetCmd();

			// Set up list options
			$this->SetupListOptions();

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Restore search parms from Session
			$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$games->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetUpSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
		}

		// Restore display records
		if ($games->getRecordsPerPage() <> "") {
			$this->lDisplayRecs = $games->getRecordsPerPage(); // Restore from Session
		} else {
			$this->lDisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		$this->LoadSortOrder();

		// Build search criteria
		if ($sSrchAdvanced <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchAdvanced . ")" : $sSrchAdvanced;
		if ($sSrchBasic <> "")
			$this->sSrchWhere = ($this->sSrchWhere <> "") ? "(" . $this->sSrchWhere . ") AND (" . $sSrchBasic. ")" : $sSrchBasic;

		// Call Recordset_Searching event
		$games->Recordset_Searching($this->sSrchWhere);

		// Save search criteria
		if ($this->sSrchWhere <> "") {
			if ($sSrchBasic == "")
				$this->ResetBasicSearchParms();
			$games->setSearchWhere($this->sSrchWhere); // Save to Session
			if (!$this->RestoreSearch) {
				$this->lStartRec = 1; // Reset start record counter
				$games->setStartRecordNumber($this->lStartRec);
			}
		} else {
			$this->sSrchWhere = $games->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if ($this->sDbDetailFilter <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (" . $this->sDbDetailFilter . ")" : $this->sDbDetailFilter;
		if ($this->sSrchWhere <> "")
			$sFilter = ($sFilter <> "") ? "(" . $sFilter . ") AND (". $this->sSrchWhere . ")" : $this->sSrchWhere;

		// Set up filter in session
		$games->setSessionWhere($sFilter);
		$games->CurrentFilter = "";
	}

	// Return basic search SQL
	function BasicSearchSQL($Keyword) {
		global $games;
		$sKeyword = ew_AdjustSql($Keyword);
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $games->r_group, $Keyword);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSql(&$Where, &$Fld, $Keyword) {
		$sFldExpression = ($Fld->FldVirtualExpression <> "") ? $Fld->FldVirtualExpression : $Fld->FldExpression;
		$lFldDataType = ($Fld->FldIsVirtual) ? EW_DATATYPE_STRING : $Fld->FldDataType;
		if ($lFldDataType == EW_DATATYPE_NUMBER) {
			$sWrk = $sFldExpression . " = " . ew_QuotedValue($Keyword, $lFldDataType);
		} else {
			$sWrk = $sFldExpression . " LIKE " . ew_QuotedValue("%" . $Keyword . "%", $lFldDataType);
		}
		if ($Where <> "") $Where .= " OR ";
		$Where .= $sWrk;
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere() {
		global $Security, $games;
		$sSearchStr = "";
		$sSearchKeyword = $games->BasicSearchKeyword;
		$sSearchType = $games->BasicSearchType;
		if ($sSearchKeyword <> "") {
			$sSearch = trim($sSearchKeyword);
			if ($sSearchType <> "") {
				while (strpos($sSearch, "  ") !== FALSE)
					$sSearch = str_replace("  ", " ", $sSearch);
				$arKeyword = explode(" ", trim($sSearch));
				foreach ($arKeyword as $sKeyword) {
					if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
					$sSearchStr .= "(" . $this->BasicSearchSQL($sKeyword) . ")";
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($sSearch);
			}
		}
		if ($sSearchKeyword <> "") {
			$games->setSessionBasicSearchKeyword($sSearchKeyword);
			$games->setSessionBasicSearchType($sSearchType);
		}
		return $sSearchStr;
	}

	// Clear all search parameters
	function ResetSearchParms() {
		global $games;

		// Clear search WHERE clause
		$this->sSrchWhere = "";
		$games->setSearchWhere($this->sSrchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		global $games;
		$games->setSessionBasicSearchKeyword("");
		$games->setSessionBasicSearchType("");
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		global $games;
		$bRestore = TRUE;
		if (@$_GET[EW_TABLE_BASIC_SEARCH] <> "") $bRestore = FALSE;
		$this->RestoreSearch = $bRestore;
		if ($bRestore) {

			// Restore basic search values
			$games->BasicSearchKeyword = $games->getSessionBasicSearchKeyword();
			$games->BasicSearchType = $games->getSessionBasicSearchType();
		}
	}

	// Set up sort parameters
	function SetUpSortOrder() {
		global $games;

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$games->CurrentOrder = ew_StripSlashes(@$_GET["order"]);
			$games->CurrentOrderType = @$_GET["ordertype"];
			$games->UpdateSort($games->Id); // Id
			$games->UpdateSort($games->person1); // person1
			$games->UpdateSort($games->person1_score); // person1_score
			$games->UpdateSort($games->person2); // person2
			$games->UpdateSort($games->person2_score); // person2_score
			$games->UpdateSort($games->r_group); // r_group
			$games->UpdateSort($games->game_date); // game_date
			$games->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		global $games;
		$sOrderBy = $games->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($games->SqlOrderBy() <> "") {
				$sOrderBy = $games->SqlOrderBy();
				$games->setSessionOrderBy($sOrderBy);
				$games->game_date->setSort("DESC");
				$games->Id->setSort("DESC");
			}
		}
	}

	// Reset command
	// cmd=reset (Reset search parameters)
	// cmd=resetall (Reset search and master/detail parameters)
	// cmd=resetsort (Reset sort parameters)
	function ResetCmd() {
		global $games;

		// Get reset command
		if (@$_GET["cmd"] <> "") {
			$sCmd = $_GET["cmd"];

			// Reset search criteria
			if (strtolower($sCmd) == "reset" || strtolower($sCmd) == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if (strtolower($sCmd) == "resetsort") {
				$sOrderBy = "";
				$games->setSessionOrderBy($sOrderBy);
				$games->Id->setSort("");
				$games->person1->setSort("");
				$games->person1_score->setSort("");
				$games->person2->setSort("");
				$games->person2_score->setSort("");
				$games->r_group->setSort("");
				$games->game_date->setSort("");
			}

			// Reset start position
			$this->lStartRec = 1;
			$games->setStartRecordNumber($this->lStartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $games;

		// "view"
		$this->ListOptions->Add("view");
		$item =& $this->ListOptions->Items["view"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "edit"
		$this->ListOptions->Add("edit");
		$item =& $this->ListOptions->Items["edit"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "copy"
		$this->ListOptions->Add("copy");
		$item =& $this->ListOptions->Items["copy"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// "delete"
		$this->ListOptions->Add("delete");
		$item =& $this->ListOptions->Items["delete"];
		$item->CssStyle = "white-space: nowrap;";
		$item->Visible = $Security->IsLoggedIn();
		$item->OnLeft = FALSE;

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		if ($games->Export <> "" ||
			$games->CurrentAction == "gridadd" ||
			$games->CurrentAction == "gridedit")
			$this->ListOptions->HideAllOptions();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $games;
		$this->ListOptions->LoadDefault();

		// "view"
		$oListOpt =& $this->ListOptions->Items["view"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a href=\"" . $this->ViewUrl . "\">" . $Language->Phrase("ViewLink") . "</a>";

		// "edit"
		$oListOpt =& $this->ListOptions->Items["edit"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->EditUrl . "\">" . $Language->Phrase("EditLink") . "</a>";
		}

		// "copy"
		$oListOpt =& $this->ListOptions->Items["copy"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible) {
			$oListOpt->Body = "<a href=\"" . $this->CopyUrl . "\">" . $Language->Phrase("CopyLink") . "</a>";
		}

		// "delete"
		$oListOpt =& $this->ListOptions->Items["delete"];
		if ($Security->IsLoggedIn() && $oListOpt->Visible)
			$oListOpt->Body = "<a" . "" . " href=\"" . $this->DeleteUrl . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	function RenderListOptionsExt() {
		global $Security, $Language, $games;
	}

	// Set up starting record parameters
	function SetUpStartRec() {
		global $games;
		if ($this->lDisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->lStartRec = $_GET[EW_TABLE_START_REC];
				$games->setStartRecordNumber($this->lStartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$this->nPageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($this->nPageNo)) {
					$this->lStartRec = ($this->nPageNo-1)*$this->lDisplayRecs+1;
					if ($this->lStartRec <= 0) {
						$this->lStartRec = 1;
					} elseif ($this->lStartRec >= intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1) {
						$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1;
					}
					$games->setStartRecordNumber($this->lStartRec);
				}
			}
		}
		$this->lStartRec = $games->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->lStartRec) || $this->lStartRec == "") { // Avoid invalid start record counter
			$this->lStartRec = 1; // Reset start record counter
			$games->setStartRecordNumber($this->lStartRec);
		} elseif (intval($this->lStartRec) > intval($this->lTotalRecs)) { // Avoid starting record > total records
			$this->lStartRec = intval(($this->lTotalRecs-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to last page first record
			$games->setStartRecordNumber($this->lStartRec);
		} elseif (($this->lStartRec-1) % $this->lDisplayRecs <> 0) {
			$this->lStartRec = intval(($this->lStartRec-1)/$this->lDisplayRecs)*$this->lDisplayRecs+1; // Point to page boundary
			$games->setStartRecordNumber($this->lStartRec);
		}
	}

	// Load basic search values
	function LoadBasicSearchValues() {
		global $games;
		$games->BasicSearchKeyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		$games->BasicSearchType = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
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
		$this->ViewUrl = $games->ViewUrl();
		$this->EditUrl = $games->EditUrl();
		$this->InlineEditUrl = $games->InlineEditUrl();
		$this->CopyUrl = $games->CopyUrl();
		$this->InlineCopyUrl = $games->InlineCopyUrl();
		$this->DeleteUrl = $games->DeleteUrl();

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

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// ListOptions Load event
	function ListOptions_Load() {

		// Example: 
		//$this->ListOptions->Add("new");
		//$this->ListOptions->Items["new"]->OnLeft = TRUE; // Link on left
		//$this->ListOptions->MoveItem("new", 0); // Move to first column

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example: 
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}
}
?>
