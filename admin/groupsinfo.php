<?php

// Global variable for table object
$groups = NULL;

//
// Table class for groups
//
class cgroups {
	var $TableVar = 'groups';
	var $TableName = 'groups';
	var $TableType = 'TABLE';
	var $Id;
	var $nickname_kor;
	var $nickname_eng;
	var $inactive;
	var $r_group;
	var $points;
	var $hide_list;
	var $total_wins;
	var $total_losses;
	var $current_wins;
	var $current_losses;
	var $fields = array();
	var $UseTokenInUrl = EW_USE_TOKEN_IN_URL;
	var $Export; // Export
	var $ExportOriginalValue = EW_EXPORT_ORIGINAL_VALUE;
	var $ExportAll = TRUE;
	var $SendEmail; // Send email
	var $TableCustomInnerHtml; // Custom inner HTML
	var $BasicSearchKeyword; // Basic search keyword
	var $BasicSearchType; // Basic search type
	var $CurrentFilter; // Current filter
	var $CurrentOrder; // Current order
	var $CurrentOrderType; // Current order type
	var $RowType; // Row type
	var $CssClass; // CSS class
	var $CssStyle; // CSS style
	var $RowAttrs = array(); // Row custom attributes
	var $TableFilter = "";
	var $CurrentAction; // Current action
	var $UpdateConflict; // Update conflict
	var $EventName; // Event name
	var $EventCancelled; // Event cancelled
	var $CancelMessage; // Cancel message

	//
	// Table class constructor
	//
	function cgroups() {
		global $Language;

		// Id
		$this->Id = new cField('groups', 'groups', 'x_Id', 'Id', '`Id`', 3, -1, FALSE, '`Id`', FALSE);
		$this->Id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Id'] =& $this->Id;

		// nickname_kor
		$this->nickname_kor = new cField('groups', 'groups', 'x_nickname_kor', 'nickname_kor', '`nickname_kor`', 200, -1, FALSE, '`nickname_kor`', FALSE);
		$this->fields['nickname_kor'] =& $this->nickname_kor;

		// nickname_eng
		$this->nickname_eng = new cField('groups', 'groups', 'x_nickname_eng', 'nickname_eng', '`nickname_eng`', 200, -1, FALSE, '`nickname_eng`', FALSE);
		$this->fields['nickname_eng'] =& $this->nickname_eng;

		// inactive
		$this->inactive = new cField('groups', 'groups', 'x_inactive', 'inactive', '`inactive`', 16, -1, FALSE, '`inactive`', FALSE);
		$this->inactive->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['inactive'] =& $this->inactive;

		// r_group
		$this->r_group = new cField('groups', 'groups', 'x_r_group', 'r_group', '`r_group`', 200, -1, FALSE, '`r_group`', FALSE);
		$this->fields['r_group'] =& $this->r_group;

		// points
		$this->points = new cField('groups', 'groups', 'x_points', 'points', '`points`', 3, -1, FALSE, '`points`', FALSE);
		$this->points->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['points'] =& $this->points;

		// hide_list
		$this->hide_list = new cField('groups', 'groups', 'x_hide_list', 'hide_list', '`hide_list`', 16, -1, FALSE, '`hide_list`', FALSE);
		$this->hide_list->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['hide_list'] =& $this->hide_list;

		// total_wins
		$this->total_wins = new cField('groups', 'groups', 'x_total_wins', 'total_wins', '`total_wins`', 2, -1, FALSE, '`total_wins`', FALSE);
		$this->total_wins->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['total_wins'] =& $this->total_wins;

		// total_losses
		$this->total_losses = new cField('groups', 'groups', 'x_total_losses', 'total_losses', '`total_losses`', 2, -1, FALSE, '`total_losses`', FALSE);
		$this->total_losses->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['total_losses'] =& $this->total_losses;

		// current_wins
		$this->current_wins = new cField('groups', 'groups', 'x_current_wins', 'current_wins', '`current_wins`', 2, -1, FALSE, '`current_wins`', FALSE);
		$this->current_wins->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['current_wins'] =& $this->current_wins;

		// current_losses
		$this->current_losses = new cField('groups', 'groups', 'x_current_losses', 'current_losses', '`current_losses`', 2, -1, FALSE, '`current_losses`', FALSE);
		$this->current_losses->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['current_losses'] =& $this->current_losses;
	}

	// Table caption
	function TableCaption() {
		global $Language;
		return $Language->TablePhrase($this->TableVar, "TblCaption");
	}

	// Page caption
	function PageCaption($Page) {
		global $Language;
		$Caption = $Language->TablePhrase($this->TableVar, "TblPageCaption" . $Page);
		if ($Caption == "") $Caption = "Page " . $Page;
		return $Caption;
	}

	// Export return page
	function ExportReturnUrl() {
		$url = @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL];
		return ($url <> "") ? $url : ew_CurrentPage();
	}

	function setExportReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_EXPORT_RETURN_URL] = $v;
	}

	// Records per page
	function getRecordsPerPage() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE];
	}

	function setRecordsPerPage($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_REC_PER_PAGE] = $v;
	}

	// Start record number
	function getStartRecordNumber() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC];
	}

	function setStartRecordNumber($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_START_REC] = $v;
	}

	// Search highlight name
	function HighlightName() {
		return "groups_Highlight";
	}

	// Advanced search
	function getAdvancedSearch($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld];
	}

	function setAdvancedSearch($fld, $v) {
		if (@$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] <> $v) {
			$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ADVANCED_SEARCH . "_" . $fld] = $v;
		}
	}

	// Basic search keyword
	function getSessionBasicSearchKeyword() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH];
	}

	function setSessionBasicSearchKeyword($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH] = $v;
	}

	// Basic search type
	function getSessionBasicSearchType() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE];
	}

	function setSessionBasicSearchType($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_BASIC_SEARCH_TYPE] = $v;
	}

	// Search WHERE clause
	function getSearchWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE];
	}

	function setSearchWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_SEARCH_WHERE] = $v;
	}

	// Single column sort
	function UpdateSort(&$ofld) {
		if ($this->CurrentOrder == $ofld->FldName) {
			$sSortField = $ofld->FldExpression;
			$sLastSort = $ofld->getSort();
			if ($this->CurrentOrderType == "ASC" || $this->CurrentOrderType == "DESC") {
				$sThisSort = $this->CurrentOrderType;
			} else {
				$sThisSort = ($sLastSort == "ASC") ? "DESC" : "ASC";
			}
			$ofld->setSort($sThisSort);
			$this->setSessionOrderBy($sSortField . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session WHERE clause
	function getSessionWhere() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE];
	}

	function setSessionWhere($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_WHERE] = $v;
	}

	// Session ORDER BY
	function getSessionOrderBy() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY];
	}

	function setSessionOrderBy($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY] = $v;
	}

	// Session key
	function getKey($fld) {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld];
	}

	function setKey($fld, $v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_KEY . "_" . $fld] = $v;
	}

	// Table level SQL
	function SqlFrom() { // From
		return "`groups`";
	}

	function SqlSelect() { // Select
		return "SELECT * FROM " . $this->SqlFrom();
	}

	function SqlWhere() { // Where
		$sWhere = "";
		$this->TableFilter = "";
		if ($this->TableFilter <> "") {
			if ($sWhere <> "") $sWhere = "(" . $sWhere . ") AND (";
			$sWhere .= "(" . $this->TableFilter . ")";
		}
		return $sWhere;
	}

	function SqlGroupBy() { // Group By
		return "";
	}

	function SqlHaving() { // Having
		return "";
	}

	function SqlOrderBy() { // Order By
		return "`inactive` ASC,`r_group` ASC,`Id` ASC";
	}

	// Check if Anonymous User is allowed
	function AllowAnonymousUser() {
		switch (EW_PAGE_ID) {
			case "add":
			case "register":
			case "addopt":
				return FALSE;
			case "edit":
			case "update":
				return FALSE;
			case "delete":
				return FALSE;
			case "view":
				return FALSE;
			case "search":
				return FALSE;
			default:
				return FALSE;
		}
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$sFilter = $this->CurrentFilter;
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(),
			$this->SqlGroupBy(), $this->SqlHaving(), $this->SqlOrderBy(),
			$sFilter, $sSort);
	}

	// Table SQL with List page filter
	function SelectSQL() {
		$sFilter = $this->getSessionWhere();
		if ($this->CurrentFilter <> "") {
			if ($sFilter <> "") $sFilter = "(" . $sFilter . ") AND ";
			$sFilter .= "(" . $this->CurrentFilter . ")";
		}
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql($this->SqlSelect(), $this->SqlWhere(), $this->SqlGroupBy(),
			$this->SqlHaving(), $this->SqlOrderBy(), $sFilter, $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sSql) {
		global $conn;
		$cnt = -1;
		if ($this->TableType == 'TABLE' || $this->TableType == 'VIEW') {
			$sSql = "SELECT COUNT(*) FROM" . substr($sSql, 13);
		} else {
			$sSql = "SELECT COUNT(*) FROM (" . $sSql . ") EW_COUNT_TABLE";
		}
		if ($rs = $conn->Execute($sSql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($sFilter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $sFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $this->LoadRs($this->CurrentFilter)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// Get record count (for current List page)
	function SelectRecordCount() {
		global $conn;
		$origFilter = $this->CurrentFilter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$sSql = $this->SelectSQL();
		$cnt = $this->TryGetRecordCount($sSql);
		if ($cnt == -1) {
			if ($rs = $conn->Execute($this->SelectSQL())) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		$this->CurrentFilter = $origFilter;
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		global $conn;
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `groups` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `groups` SET ";
		foreach ($rs as $name => $value) {
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `groups` WHERE ";
		$SQL .= ew_QuotedName('Id') . '=' . ew_QuotedValue($rs['Id'], $this->Id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`Id` = @Id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->Id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@Id@", ew_AdjustSql($this->Id->CurrentValue), $sKeyFilter); // Replace key value
		return $sKeyFilter;
	}

	// Return page URL
	function getReturnUrl() {
		$name = EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL;

		// Get referer URL automatically
		if (ew_ServerVar("HTTP_REFERER") <> "" && ew_ReferPage() <> ew_CurrentPage() && ew_ReferPage() <> "login.php") // Referer not same page or login page
			$_SESSION[$name] = ew_ServerVar("HTTP_REFERER"); // Save to Session
		if (@$_SESSION[$name] <> "") {
			return $_SESSION[$name];
		} else {
			return "groupslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "groupslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("groupsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "groupsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("groupsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("groupsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("groupsdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->Id->CurrentValue)) {
			$sUrl .= "Id=" . urlencode($this->Id->CurrentValue);
		} else {
			return "javascript:alert(ewLanguage.Phrase(\"InvalidRecord\"));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&ordertype=" . $fld->ReverseSort());
			return ew_CurrentPage() . "?" . $sUrlParm;
		} else {
			return "";
		}
	}

	// Add URL parameter
	function UrlParm($parm = "") {
		$UrlParm = ($this->UseTokenInUrl) ? "t=groups" : "";
		if ($parm <> "") {
			if ($UrlParm <> "")
				$UrlParm .= "&";
			$UrlParm .= $parm;
		}
		return $UrlParm;
	}

	// Load rows based on filter
	function &LoadRs($sFilter) {
		global $conn;

		// Set up filter (SQL WHERE clause) and get return SQL
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		return $conn->Execute($sSql);
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->Id->setDbValue($rs->fields('Id'));
		$this->nickname_kor->setDbValue($rs->fields('nickname_kor'));
		$this->nickname_eng->setDbValue($rs->fields('nickname_eng'));
		$this->inactive->setDbValue($rs->fields('inactive'));
		$this->r_group->setDbValue($rs->fields('r_group'));
		$this->points->setDbValue($rs->fields('points'));
		$this->hide_list->setDbValue($rs->fields('hide_list'));
		$this->total_wins->setDbValue($rs->fields('total_wins'));
		$this->total_losses->setDbValue($rs->fields('total_losses'));
		$this->current_wins->setDbValue($rs->fields('current_wins'));
		$this->current_losses->setDbValue($rs->fields('current_losses'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// Id

		$this->Id->CellCssStyle = ""; $this->Id->CellCssClass = "";
		$this->Id->CellAttrs = array(); $this->Id->ViewAttrs = array(); $this->Id->EditAttrs = array();

		// nickname_kor
		$this->nickname_kor->CellCssStyle = ""; $this->nickname_kor->CellCssClass = "";
		$this->nickname_kor->CellAttrs = array(); $this->nickname_kor->ViewAttrs = array(); $this->nickname_kor->EditAttrs = array();

		// nickname_eng
		$this->nickname_eng->CellCssStyle = ""; $this->nickname_eng->CellCssClass = "";
		$this->nickname_eng->CellAttrs = array(); $this->nickname_eng->ViewAttrs = array(); $this->nickname_eng->EditAttrs = array();

		// inactive
		$this->inactive->CellCssStyle = ""; $this->inactive->CellCssClass = "";
		$this->inactive->CellAttrs = array(); $this->inactive->ViewAttrs = array(); $this->inactive->EditAttrs = array();

		// r_group
		$this->r_group->CellCssStyle = ""; $this->r_group->CellCssClass = "";
		$this->r_group->CellAttrs = array(); $this->r_group->ViewAttrs = array(); $this->r_group->EditAttrs = array();

		// points
		$this->points->CellCssStyle = ""; $this->points->CellCssClass = "";
		$this->points->CellAttrs = array(); $this->points->ViewAttrs = array(); $this->points->EditAttrs = array();

		// hide_list
		$this->hide_list->CellCssStyle = ""; $this->hide_list->CellCssClass = "";
		$this->hide_list->CellAttrs = array(); $this->hide_list->ViewAttrs = array(); $this->hide_list->EditAttrs = array();

		// total_wins
		$this->total_wins->CellCssStyle = ""; $this->total_wins->CellCssClass = "";
		$this->total_wins->CellAttrs = array(); $this->total_wins->ViewAttrs = array(); $this->total_wins->EditAttrs = array();

		// total_losses
		$this->total_losses->CellCssStyle = ""; $this->total_losses->CellCssClass = "";
		$this->total_losses->CellAttrs = array(); $this->total_losses->ViewAttrs = array(); $this->total_losses->EditAttrs = array();

		// current_wins
		$this->current_wins->CellCssStyle = ""; $this->current_wins->CellCssClass = "";
		$this->current_wins->CellAttrs = array(); $this->current_wins->ViewAttrs = array(); $this->current_wins->EditAttrs = array();

		// current_losses
		$this->current_losses->CellCssStyle = ""; $this->current_losses->CellCssClass = "";
		$this->current_losses->CellAttrs = array(); $this->current_losses->ViewAttrs = array(); $this->current_losses->EditAttrs = array();

		// Id
		$this->Id->ViewValue = $this->Id->CurrentValue;
		$this->Id->CssStyle = "";
		$this->Id->CssClass = "";
		$this->Id->ViewCustomAttributes = "";

		// nickname_kor
		$this->nickname_kor->ViewValue = $this->nickname_kor->CurrentValue;
		$this->nickname_kor->CssStyle = "";
		$this->nickname_kor->CssClass = "";
		$this->nickname_kor->ViewCustomAttributes = "";

		// nickname_eng
		$this->nickname_eng->ViewValue = $this->nickname_eng->CurrentValue;
		$this->nickname_eng->CssStyle = "";
		$this->nickname_eng->CssClass = "";
		$this->nickname_eng->ViewCustomAttributes = "";

		// inactive
		$this->inactive->ViewValue = $this->inactive->CurrentValue;
		$this->inactive->CssStyle = "";
		$this->inactive->CssClass = "";
		$this->inactive->ViewCustomAttributes = "";

		// r_group
		$this->r_group->ViewValue = $this->r_group->CurrentValue;
		$this->r_group->CssStyle = "";
		$this->r_group->CssClass = "";
		$this->r_group->ViewCustomAttributes = "";

		// points
		$this->points->ViewValue = $this->points->CurrentValue;
		$this->points->CssStyle = "";
		$this->points->CssClass = "";
		$this->points->ViewCustomAttributes = "";

		// hide_list
		$this->hide_list->ViewValue = $this->hide_list->CurrentValue;
		$this->hide_list->CssStyle = "";
		$this->hide_list->CssClass = "";
		$this->hide_list->ViewCustomAttributes = "";

		// total_wins
		$this->total_wins->ViewValue = $this->total_wins->CurrentValue;
		$this->total_wins->CssStyle = "";
		$this->total_wins->CssClass = "";
		$this->total_wins->ViewCustomAttributes = "";

		// total_losses
		$this->total_losses->ViewValue = $this->total_losses->CurrentValue;
		$this->total_losses->CssStyle = "";
		$this->total_losses->CssClass = "";
		$this->total_losses->ViewCustomAttributes = "";

		// current_wins
		$this->current_wins->ViewValue = $this->current_wins->CurrentValue;
		$this->current_wins->CssStyle = "";
		$this->current_wins->CssClass = "";
		$this->current_wins->ViewCustomAttributes = "";

		// current_losses
		$this->current_losses->ViewValue = $this->current_losses->CurrentValue;
		$this->current_losses->CssStyle = "";
		$this->current_losses->CssClass = "";
		$this->current_losses->ViewCustomAttributes = "";

		// Id
		$this->Id->HrefValue = "";
		$this->Id->TooltipValue = "";

		// nickname_kor
		$this->nickname_kor->HrefValue = "";
		$this->nickname_kor->TooltipValue = "";

		// nickname_eng
		$this->nickname_eng->HrefValue = "";
		$this->nickname_eng->TooltipValue = "";

		// inactive
		$this->inactive->HrefValue = "";
		$this->inactive->TooltipValue = "";

		// r_group
		$this->r_group->HrefValue = "";
		$this->r_group->TooltipValue = "";

		// points
		$this->points->HrefValue = "";
		$this->points->TooltipValue = "";

		// hide_list
		$this->hide_list->HrefValue = "";
		$this->hide_list->TooltipValue = "";

		// total_wins
		$this->total_wins->HrefValue = "";
		$this->total_wins->TooltipValue = "";

		// total_losses
		$this->total_losses->HrefValue = "";
		$this->total_losses->TooltipValue = "";

		// current_wins
		$this->current_wins->HrefValue = "";
		$this->current_wins->TooltipValue = "";

		// current_losses
		$this->current_losses->HrefValue = "";
		$this->current_losses->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {
	}

	// Row styles
	function RowStyles() {
		$sAtt = "";
		$sStyle = trim($this->CssStyle);
		if (@$this->RowAttrs["style"] <> "")
			$sStyle .= " " . $this->RowAttrs["style"];
		$sClass = trim($this->CssClass);
		if (@$this->RowAttrs["class"] <> "")
			$sClass .= " " . $this->RowAttrs["class"];
		if (trim($sStyle) <> "")
			$sAtt .= " style=\"" . trim($sStyle) . "\"";
		if (trim($sClass) <> "")
			$sAtt .= " class=\"" . trim($sClass) . "\"";
		return $sAtt;
	}

	// Row attributes
	function RowAttributes() {
		$sAtt = $this->RowStyles();
		if ($this->Export == "") {
			foreach ($this->RowAttrs as $k => $v) {
				if ($k <> "class" && $k <> "style" && trim($v) <> "")
					$sAtt .= " " . $k . "=\"" . trim($v) . "\"";
			}
		}
		return $sAtt;
	}

	// Field object by name
	function fields($fldname) {
		return $this->fields[$fldname];
	}

	// Table level events
	// Recordset Selecting event
	function Recordset_Selecting(&$filter) {

		// Enter your code here	
	}

	// Recordset Selected event
	function Recordset_Selected(&$rs) {

		//echo "Recordset Selected";
	}

	// Recordset Search Validated event
	function Recordset_SearchValidated() {

		// Example:
		//$this->MyField1->AdvancedSearch->SearchValue = "your search criteria"; // Search value

	}

	// Recordset Searching event
	function Recordset_Searching(&$filter) {

		// Enter your code here	
	}

	// Row_Selecting event
	function Row_Selecting(&$filter) {

		// Enter your code here	
	}

	// Row Selected event
	function Row_Selected(&$rs) {

		//echo "Row Selected";
	}

	// Row Rendering event
	function Row_Rendering() {

		// Enter your code here	
	}

	// Row Rendered event
	function Row_Rendered() {

		// To view properties of field class, use:
		//var_dump($this-><FieldName>); 

	}

	// Row Inserting event
	function Row_Inserting(&$rs) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted(&$rs) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating(&$rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated(&$rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict(&$rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Row Deleting event
	function Row_Deleting(&$rs) {

		// Enter your code here
		// To cancel, set return value to False

		return TRUE;
	}

	// Row Deleted event
	function Row_Deleted(&$rs) {

		//echo "Row Deleted";
	}

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}
}
?>
