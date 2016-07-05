<?php

// Global variable for table object
$members = NULL;

//
// Table class for members
//
class cmembers {
	var $TableVar = 'members';
	var $TableName = 'members';
	var $TableType = 'TABLE';
	var $Id;
	var $first_name;
	var $last_name;
	var $first_name_eng;
	var $last_name_eng;
	var $username;
	var $password;
	var $phone_cell;
	var $phone_home;
	var $zemail;
	var $address;
	var $city;
	var $zip;
	var $gender;
	var $status_student;
	var $ethnicity_korean;
	var $language_korean;
	var $access_level;
	var $active_member;
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
	function cmembers() {
		global $Language;

		// Id
		$this->Id = new cField('members', 'members', 'x_Id', 'Id', '`Id`', 3, -1, FALSE, '`Id`', FALSE);
		$this->Id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['Id'] =& $this->Id;

		// first_name
		$this->first_name = new cField('members', 'members', 'x_first_name', 'first_name', '`first_name`', 200, -1, FALSE, '`first_name`', FALSE);
		$this->fields['first_name'] =& $this->first_name;

		// last_name
		$this->last_name = new cField('members', 'members', 'x_last_name', 'last_name', '`last_name`', 200, -1, FALSE, '`last_name`', FALSE);
		$this->fields['last_name'] =& $this->last_name;

		// first_name_eng
		$this->first_name_eng = new cField('members', 'members', 'x_first_name_eng', 'first_name_eng', '`first_name_eng`', 200, -1, FALSE, '`first_name_eng`', FALSE);
		$this->fields['first_name_eng'] =& $this->first_name_eng;

		// last_name_eng
		$this->last_name_eng = new cField('members', 'members', 'x_last_name_eng', 'last_name_eng', '`last_name_eng`', 200, -1, FALSE, '`last_name_eng`', FALSE);
		$this->fields['last_name_eng'] =& $this->last_name_eng;

		// username
		$this->username = new cField('members', 'members', 'x_username', 'username', '`username`', 200, -1, FALSE, '`username`', FALSE);
		$this->fields['username'] =& $this->username;

		// password
		$this->password = new cField('members', 'members', 'x_password', 'password', '`password`', 200, -1, FALSE, '`password`', FALSE);
		$this->fields['password'] =& $this->password;

		// phone_cell
		$this->phone_cell = new cField('members', 'members', 'x_phone_cell', 'phone_cell', '`phone_cell`', 200, -1, FALSE, '`phone_cell`', FALSE);
		$this->fields['phone_cell'] =& $this->phone_cell;

		// phone_home
		$this->phone_home = new cField('members', 'members', 'x_phone_home', 'phone_home', '`phone_home`', 200, -1, FALSE, '`phone_home`', FALSE);
		$this->fields['phone_home'] =& $this->phone_home;

		// email
		$this->zemail = new cField('members', 'members', 'x_zemail', 'email', '`email`', 200, -1, FALSE, '`email`', FALSE);
		$this->fields['email'] =& $this->zemail;

		// address
		$this->address = new cField('members', 'members', 'x_address', 'address', '`address`', 200, -1, FALSE, '`address`', FALSE);
		$this->fields['address'] =& $this->address;

		// city
		$this->city = new cField('members', 'members', 'x_city', 'city', '`city`', 200, -1, FALSE, '`city`', FALSE);
		$this->fields['city'] =& $this->city;

		// zip
		$this->zip = new cField('members', 'members', 'x_zip', 'zip', '`zip`', 200, -1, FALSE, '`zip`', FALSE);
		$this->fields['zip'] =& $this->zip;

		// gender
		$this->gender = new cField('members', 'members', 'x_gender', 'gender', '`gender`', 200, -1, FALSE, '`gender`', FALSE);
		$this->fields['gender'] =& $this->gender;

		// status_student
		$this->status_student = new cField('members', 'members', 'x_status_student', 'status_student', '`status_student`', 16, -1, FALSE, '`status_student`', FALSE);
		$this->status_student->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status_student'] =& $this->status_student;

		// ethnicity_korean
		$this->ethnicity_korean = new cField('members', 'members', 'x_ethnicity_korean', 'ethnicity_korean', '`ethnicity_korean`', 16, -1, FALSE, '`ethnicity_korean`', FALSE);
		$this->ethnicity_korean->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['ethnicity_korean'] =& $this->ethnicity_korean;

		// language_korean
		$this->language_korean = new cField('members', 'members', 'x_language_korean', 'language_korean', '`language_korean`', 16, -1, FALSE, '`language_korean`', FALSE);
		$this->language_korean->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['language_korean'] =& $this->language_korean;

		// access_level
		$this->access_level = new cField('members', 'members', 'x_access_level', 'access_level', '`access_level`', 16, -1, FALSE, '`access_level`', FALSE);
		$this->access_level->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['access_level'] =& $this->access_level;

		// active_member
		$this->active_member = new cField('members', 'members', 'x_active_member', 'active_member', '`active_member`', 16, -1, FALSE, '`active_member`', FALSE);
		$this->active_member->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['active_member'] =& $this->active_member;
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
		return "members_Highlight";
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
		return "`members`";
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
		return "Id DESC";
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
			if (EW_MD5_PASSWORD && $name == 'password')
				$value = (EW_CASE_SENSITIVE_PASSWORD) ? md5($value) : md5(strtolower($value));
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($names, -1) == ",") $names = substr($names, 0, strlen($names)-1);
		if (substr($values, -1) == ",") $values = substr($values, 0, strlen($values)-1);
		return "INSERT INTO `members` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `members` SET ";
		foreach ($rs as $name => $value) {
			if (EW_MD5_PASSWORD && $name == 'password') {
				$value = (EW_CASE_SENSITIVE_PASSWORD) ? md5($value) : md5(strtolower($value));
			}
			$SQL .= $this->fields[$name]->FldExpression . "=";
			$SQL .= ew_QuotedValue($value, $this->fields[$name]->FldDataType) . ",";
		}
		if (substr($SQL, -1) == ",") $SQL = substr($SQL, 0, strlen($SQL)-1);
		if ($this->CurrentFilter <> "")	$SQL .= " WHERE " . $this->CurrentFilter;
		return $SQL;
	}

	// DELETE statement
	function DeleteSQL(&$rs) {
		$SQL = "DELETE FROM `members` WHERE ";
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
			return "memberslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "memberslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("membersview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "membersadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("membersedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("membersadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("membersdelete.php", $this->UrlParm());
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=members" : "";
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
		$this->first_name->setDbValue($rs->fields('first_name'));
		$this->last_name->setDbValue($rs->fields('last_name'));
		$this->first_name_eng->setDbValue($rs->fields('first_name_eng'));
		$this->last_name_eng->setDbValue($rs->fields('last_name_eng'));
		$this->username->setDbValue($rs->fields('username'));
		$this->password->setDbValue($rs->fields('password'));
		$this->phone_cell->setDbValue($rs->fields('phone_cell'));
		$this->phone_home->setDbValue($rs->fields('phone_home'));
		$this->zemail->setDbValue($rs->fields('email'));
		$this->address->setDbValue($rs->fields('address'));
		$this->city->setDbValue($rs->fields('city'));
		$this->zip->setDbValue($rs->fields('zip'));
		$this->gender->setDbValue($rs->fields('gender'));
		$this->status_student->setDbValue($rs->fields('status_student'));
		$this->ethnicity_korean->setDbValue($rs->fields('ethnicity_korean'));
		$this->language_korean->setDbValue($rs->fields('language_korean'));
		$this->access_level->setDbValue($rs->fields('access_level'));
		$this->active_member->setDbValue($rs->fields('active_member'));
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

		// first_name
		$this->first_name->CellCssStyle = ""; $this->first_name->CellCssClass = "";
		$this->first_name->CellAttrs = array(); $this->first_name->ViewAttrs = array(); $this->first_name->EditAttrs = array();

		// last_name
		$this->last_name->CellCssStyle = ""; $this->last_name->CellCssClass = "";
		$this->last_name->CellAttrs = array(); $this->last_name->ViewAttrs = array(); $this->last_name->EditAttrs = array();

		// first_name_eng
		$this->first_name_eng->CellCssStyle = ""; $this->first_name_eng->CellCssClass = "";
		$this->first_name_eng->CellAttrs = array(); $this->first_name_eng->ViewAttrs = array(); $this->first_name_eng->EditAttrs = array();

		// last_name_eng
		$this->last_name_eng->CellCssStyle = ""; $this->last_name_eng->CellCssClass = "";
		$this->last_name_eng->CellAttrs = array(); $this->last_name_eng->ViewAttrs = array(); $this->last_name_eng->EditAttrs = array();

		// username
		$this->username->CellCssStyle = ""; $this->username->CellCssClass = "";
		$this->username->CellAttrs = array(); $this->username->ViewAttrs = array(); $this->username->EditAttrs = array();

		// password
		$this->password->CellCssStyle = ""; $this->password->CellCssClass = "";
		$this->password->CellAttrs = array(); $this->password->ViewAttrs = array(); $this->password->EditAttrs = array();

		// phone_cell
		$this->phone_cell->CellCssStyle = ""; $this->phone_cell->CellCssClass = "";
		$this->phone_cell->CellAttrs = array(); $this->phone_cell->ViewAttrs = array(); $this->phone_cell->EditAttrs = array();

		// phone_home
		$this->phone_home->CellCssStyle = ""; $this->phone_home->CellCssClass = "";
		$this->phone_home->CellAttrs = array(); $this->phone_home->ViewAttrs = array(); $this->phone_home->EditAttrs = array();

		// email
		$this->zemail->CellCssStyle = ""; $this->zemail->CellCssClass = "";
		$this->zemail->CellAttrs = array(); $this->zemail->ViewAttrs = array(); $this->zemail->EditAttrs = array();

		// address
		$this->address->CellCssStyle = ""; $this->address->CellCssClass = "";
		$this->address->CellAttrs = array(); $this->address->ViewAttrs = array(); $this->address->EditAttrs = array();

		// city
		$this->city->CellCssStyle = ""; $this->city->CellCssClass = "";
		$this->city->CellAttrs = array(); $this->city->ViewAttrs = array(); $this->city->EditAttrs = array();

		// zip
		$this->zip->CellCssStyle = ""; $this->zip->CellCssClass = "";
		$this->zip->CellAttrs = array(); $this->zip->ViewAttrs = array(); $this->zip->EditAttrs = array();

		// gender
		$this->gender->CellCssStyle = ""; $this->gender->CellCssClass = "";
		$this->gender->CellAttrs = array(); $this->gender->ViewAttrs = array(); $this->gender->EditAttrs = array();

		// status_student
		$this->status_student->CellCssStyle = ""; $this->status_student->CellCssClass = "";
		$this->status_student->CellAttrs = array(); $this->status_student->ViewAttrs = array(); $this->status_student->EditAttrs = array();

		// ethnicity_korean
		$this->ethnicity_korean->CellCssStyle = ""; $this->ethnicity_korean->CellCssClass = "";
		$this->ethnicity_korean->CellAttrs = array(); $this->ethnicity_korean->ViewAttrs = array(); $this->ethnicity_korean->EditAttrs = array();

		// language_korean
		$this->language_korean->CellCssStyle = ""; $this->language_korean->CellCssClass = "";
		$this->language_korean->CellAttrs = array(); $this->language_korean->ViewAttrs = array(); $this->language_korean->EditAttrs = array();

		// access_level
		$this->access_level->CellCssStyle = ""; $this->access_level->CellCssClass = "";
		$this->access_level->CellAttrs = array(); $this->access_level->ViewAttrs = array(); $this->access_level->EditAttrs = array();

		// active_member
		$this->active_member->CellCssStyle = ""; $this->active_member->CellCssClass = "";
		$this->active_member->CellAttrs = array(); $this->active_member->ViewAttrs = array(); $this->active_member->EditAttrs = array();

		// Id
		$this->Id->ViewValue = $this->Id->CurrentValue;
		$this->Id->CssStyle = "";
		$this->Id->CssClass = "";
		$this->Id->ViewCustomAttributes = "";

		// first_name
		$this->first_name->ViewValue = $this->first_name->CurrentValue;
		$this->first_name->CssStyle = "";
		$this->first_name->CssClass = "";
		$this->first_name->ViewCustomAttributes = "";

		// last_name
		$this->last_name->ViewValue = $this->last_name->CurrentValue;
		$this->last_name->CssStyle = "";
		$this->last_name->CssClass = "";
		$this->last_name->ViewCustomAttributes = "";

		// first_name_eng
		$this->first_name_eng->ViewValue = $this->first_name_eng->CurrentValue;
		$this->first_name_eng->CssStyle = "";
		$this->first_name_eng->CssClass = "";
		$this->first_name_eng->ViewCustomAttributes = "";

		// last_name_eng
		$this->last_name_eng->ViewValue = $this->last_name_eng->CurrentValue;
		$this->last_name_eng->CssStyle = "";
		$this->last_name_eng->CssClass = "";
		$this->last_name_eng->ViewCustomAttributes = "";

		// username
		$this->username->ViewValue = $this->username->CurrentValue;
		$this->username->CssStyle = "";
		$this->username->CssClass = "";
		$this->username->ViewCustomAttributes = "";

		// password
		$this->password->ViewValue = $this->password->CurrentValue;
		$this->password->CssStyle = "";
		$this->password->CssClass = "";
		$this->password->ViewCustomAttributes = "";

		// phone_cell
		$this->phone_cell->ViewValue = $this->phone_cell->CurrentValue;
		$this->phone_cell->CssStyle = "";
		$this->phone_cell->CssClass = "";
		$this->phone_cell->ViewCustomAttributes = "";

		// phone_home
		$this->phone_home->ViewValue = $this->phone_home->CurrentValue;
		$this->phone_home->CssStyle = "";
		$this->phone_home->CssClass = "";
		$this->phone_home->ViewCustomAttributes = "";

		// email
		$this->zemail->ViewValue = $this->zemail->CurrentValue;
		$this->zemail->CssStyle = "";
		$this->zemail->CssClass = "";
		$this->zemail->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->CssStyle = "";
		$this->address->CssClass = "";
		$this->address->ViewCustomAttributes = "";

		// city
		$this->city->ViewValue = $this->city->CurrentValue;
		$this->city->CssStyle = "";
		$this->city->CssClass = "";
		$this->city->ViewCustomAttributes = "";

		// zip
		$this->zip->ViewValue = $this->zip->CurrentValue;
		$this->zip->CssStyle = "";
		$this->zip->CssClass = "";
		$this->zip->ViewCustomAttributes = "";

		// gender
		$this->gender->ViewValue = $this->gender->CurrentValue;
		$this->gender->CssStyle = "";
		$this->gender->CssClass = "";
		$this->gender->ViewCustomAttributes = "";

		// status_student
		$this->status_student->ViewValue = $this->status_student->CurrentValue;
		$this->status_student->CssStyle = "";
		$this->status_student->CssClass = "";
		$this->status_student->ViewCustomAttributes = "";

		// ethnicity_korean
		$this->ethnicity_korean->ViewValue = $this->ethnicity_korean->CurrentValue;
		$this->ethnicity_korean->CssStyle = "";
		$this->ethnicity_korean->CssClass = "";
		$this->ethnicity_korean->ViewCustomAttributes = "";

		// language_korean
		$this->language_korean->ViewValue = $this->language_korean->CurrentValue;
		$this->language_korean->CssStyle = "";
		$this->language_korean->CssClass = "";
		$this->language_korean->ViewCustomAttributes = "";

		// access_level
		$this->access_level->ViewValue = $this->access_level->CurrentValue;
		$this->access_level->CssStyle = "";
		$this->access_level->CssClass = "";
		$this->access_level->ViewCustomAttributes = "";

		// active_member
		$this->active_member->ViewValue = $this->active_member->CurrentValue;
		$this->active_member->CssStyle = "";
		$this->active_member->CssClass = "";
		$this->active_member->ViewCustomAttributes = "";

		// Id
		$this->Id->HrefValue = "";
		$this->Id->TooltipValue = "";

		// first_name
		$this->first_name->HrefValue = "";
		$this->first_name->TooltipValue = "";

		// last_name
		$this->last_name->HrefValue = "";
		$this->last_name->TooltipValue = "";

		// first_name_eng
		$this->first_name_eng->HrefValue = "";
		$this->first_name_eng->TooltipValue = "";

		// last_name_eng
		$this->last_name_eng->HrefValue = "";
		$this->last_name_eng->TooltipValue = "";

		// username
		$this->username->HrefValue = "";
		$this->username->TooltipValue = "";

		// password
		$this->password->HrefValue = "";
		$this->password->TooltipValue = "";

		// phone_cell
		$this->phone_cell->HrefValue = "";
		$this->phone_cell->TooltipValue = "";

		// phone_home
		$this->phone_home->HrefValue = "";
		$this->phone_home->TooltipValue = "";

		// email
		$this->zemail->HrefValue = "";
		$this->zemail->TooltipValue = "";

		// address
		$this->address->HrefValue = "";
		$this->address->TooltipValue = "";

		// city
		$this->city->HrefValue = "";
		$this->city->TooltipValue = "";

		// zip
		$this->zip->HrefValue = "";
		$this->zip->TooltipValue = "";

		// gender
		$this->gender->HrefValue = "";
		$this->gender->TooltipValue = "";

		// status_student
		$this->status_student->HrefValue = "";
		$this->status_student->TooltipValue = "";

		// ethnicity_korean
		$this->ethnicity_korean->HrefValue = "";
		$this->ethnicity_korean->TooltipValue = "";

		// language_korean
		$this->language_korean->HrefValue = "";
		$this->language_korean->TooltipValue = "";

		// access_level
		$this->access_level->HrefValue = "";
		$this->access_level->TooltipValue = "";

		// active_member
		$this->active_member->HrefValue = "";
		$this->active_member->TooltipValue = "";

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
