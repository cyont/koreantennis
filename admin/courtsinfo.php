<?php

// Global variable for table object
$courts = NULL;

//
// Table class for courts
//
class ccourts {
	var $TableVar = 'courts';
	var $TableName = 'courts';
	var $TableType = 'TABLE';
	var $id;
	var $name;
	var $region;
	var $location;
	var $address;
	var $zip;
	var $city;
	var $time;
	var $cost;
	var $court_num;
	var $lights;
	var $maintenance;
	var $website;
	var $phone;
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
	function ccourts() {
		global $Language;

		// id
		$this->id = new cField('courts', 'courts', 'x_id', 'id', '`id`', 16, -1, FALSE, '`id`', FALSE);
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] =& $this->id;

		// name
		$this->name = new cField('courts', 'courts', 'x_name', 'name', '`name`', 200, -1, FALSE, '`name`', FALSE);
		$this->fields['name'] =& $this->name;

		// region
		$this->region = new cField('courts', 'courts', 'x_region', 'region', '`region`', 200, -1, FALSE, '`region`', FALSE);
		$this->fields['region'] =& $this->region;

		// location
		$this->location = new cField('courts', 'courts', 'x_location', 'location', '`location`', 200, -1, FALSE, '`location`', FALSE);
		$this->fields['location'] =& $this->location;

		// address
		$this->address = new cField('courts', 'courts', 'x_address', 'address', '`address`', 200, -1, FALSE, '`address`', FALSE);
		$this->fields['address'] =& $this->address;

		// zip
		$this->zip = new cField('courts', 'courts', 'x_zip', 'zip', '`zip`', 200, -1, FALSE, '`zip`', FALSE);
		$this->fields['zip'] =& $this->zip;

		// city
		$this->city = new cField('courts', 'courts', 'x_city', 'city', '`city`', 200, -1, FALSE, '`city`', FALSE);
		$this->fields['city'] =& $this->city;

		// time
		$this->time = new cField('courts', 'courts', 'x_time', 'time', '`time`', 201, -1, FALSE, '`time`', FALSE);
		$this->fields['time'] =& $this->time;

		// cost
		$this->cost = new cField('courts', 'courts', 'x_cost', 'cost', '`cost`', 201, -1, FALSE, '`cost`', FALSE);
		$this->fields['cost'] =& $this->cost;

		// court_num
		$this->court_num = new cField('courts', 'courts', 'x_court_num', 'court_num', '`court_num`', 16, -1, FALSE, '`court_num`', FALSE);
		$this->court_num->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['court_num'] =& $this->court_num;

		// lights
		$this->lights = new cField('courts', 'courts', 'x_lights', 'lights', '`lights`', 200, -1, FALSE, '`lights`', FALSE);
		$this->fields['lights'] =& $this->lights;

		// maintenance
		$this->maintenance = new cField('courts', 'courts', 'x_maintenance', 'maintenance', '`maintenance`', 200, -1, FALSE, '`maintenance`', FALSE);
		$this->fields['maintenance'] =& $this->maintenance;

		// website
		$this->website = new cField('courts', 'courts', 'x_website', 'website', '`website`', 200, -1, FALSE, '`website`', FALSE);
		$this->fields['website'] =& $this->website;

		// phone
		$this->phone = new cField('courts', 'courts', 'x_phone', 'phone', '`phone`', 200, -1, FALSE, '`phone`', FALSE);
		$this->fields['phone'] =& $this->phone;
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
		return "courts_Highlight";
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
		return "`courts`";
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
		return "";
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
		return "INSERT INTO `courts` ($names) VALUES ($values)";
	}

	// UPDATE statement
	function UpdateSQL(&$rs) {
		global $conn;
		$SQL = "UPDATE `courts` SET ";
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
		$SQL = "DELETE FROM `courts` WHERE ";
		$SQL .= ew_QuotedName('id') . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType) . ' AND ';
		if (substr($SQL, -5) == " AND ") $SQL = substr($SQL, 0, strlen($SQL)-5);
		if ($this->CurrentFilter <> "")	$SQL .= " AND " . $this->CurrentFilter;
		return $SQL;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			$sKeyFilter = "0=1"; // Invalid key
		$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue), $sKeyFilter); // Replace key value
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
			return "courtslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// List URL
	function ListUrl() {
		return "courtslist.php";
	}

	// View URL
	function ViewUrl() {
		return $this->KeyUrl("courtsview.php", $this->UrlParm());
	}

	// Add URL
	function AddUrl() {
		$AddUrl = "courtsadd.php";
		$sUrlParm = $this->UrlParm();
		if ($sUrlParm <> "")
			$AddUrl .= "?" . $sUrlParm;
		return $AddUrl;
	}

	// Edit URL
	function EditUrl() {
		return $this->KeyUrl("courtsedit.php", $this->UrlParm());
	}

	// Inline edit URL
	function InlineEditUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
	}

	// Copy URL
	function CopyUrl() {
		return $this->KeyUrl("courtsadd.php", $this->UrlParm());
	}

	// Inline copy URL
	function InlineCopyUrl() {
		return $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
	}

	// Delete URL
	function DeleteUrl() {
		return $this->KeyUrl("courtsdelete.php", $this->UrlParm());
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
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
		$UrlParm = ($this->UseTokenInUrl) ? "t=courts" : "";
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
		$this->id->setDbValue($rs->fields('id'));
		$this->name->setDbValue($rs->fields('name'));
		$this->region->setDbValue($rs->fields('region'));
		$this->location->setDbValue($rs->fields('location'));
		$this->address->setDbValue($rs->fields('address'));
		$this->zip->setDbValue($rs->fields('zip'));
		$this->city->setDbValue($rs->fields('city'));
		$this->time->setDbValue($rs->fields('time'));
		$this->cost->setDbValue($rs->fields('cost'));
		$this->court_num->setDbValue($rs->fields('court_num'));
		$this->lights->setDbValue($rs->fields('lights'));
		$this->maintenance->setDbValue($rs->fields('maintenance'));
		$this->website->setDbValue($rs->fields('website'));
		$this->phone->setDbValue($rs->fields('phone'));
	}

	// Render list row values
	function RenderListRow() {
		global $conn, $Security;

		// Call Row Rendering event
		$this->Row_Rendering();

   // Common render codes
		// id

		$this->id->CellCssStyle = ""; $this->id->CellCssClass = "";
		$this->id->CellAttrs = array(); $this->id->ViewAttrs = array(); $this->id->EditAttrs = array();

		// name
		$this->name->CellCssStyle = ""; $this->name->CellCssClass = "";
		$this->name->CellAttrs = array(); $this->name->ViewAttrs = array(); $this->name->EditAttrs = array();

		// region
		$this->region->CellCssStyle = ""; $this->region->CellCssClass = "";
		$this->region->CellAttrs = array(); $this->region->ViewAttrs = array(); $this->region->EditAttrs = array();

		// location
		$this->location->CellCssStyle = ""; $this->location->CellCssClass = "";
		$this->location->CellAttrs = array(); $this->location->ViewAttrs = array(); $this->location->EditAttrs = array();

		// address
		$this->address->CellCssStyle = ""; $this->address->CellCssClass = "";
		$this->address->CellAttrs = array(); $this->address->ViewAttrs = array(); $this->address->EditAttrs = array();

		// zip
		$this->zip->CellCssStyle = ""; $this->zip->CellCssClass = "";
		$this->zip->CellAttrs = array(); $this->zip->ViewAttrs = array(); $this->zip->EditAttrs = array();

		// city
		$this->city->CellCssStyle = ""; $this->city->CellCssClass = "";
		$this->city->CellAttrs = array(); $this->city->ViewAttrs = array(); $this->city->EditAttrs = array();

		// court_num
		$this->court_num->CellCssStyle = ""; $this->court_num->CellCssClass = "";
		$this->court_num->CellAttrs = array(); $this->court_num->ViewAttrs = array(); $this->court_num->EditAttrs = array();

		// lights
		$this->lights->CellCssStyle = ""; $this->lights->CellCssClass = "";
		$this->lights->CellAttrs = array(); $this->lights->ViewAttrs = array(); $this->lights->EditAttrs = array();

		// maintenance
		$this->maintenance->CellCssStyle = ""; $this->maintenance->CellCssClass = "";
		$this->maintenance->CellAttrs = array(); $this->maintenance->ViewAttrs = array(); $this->maintenance->EditAttrs = array();

		// website
		$this->website->CellCssStyle = ""; $this->website->CellCssClass = "";
		$this->website->CellAttrs = array(); $this->website->ViewAttrs = array(); $this->website->EditAttrs = array();

		// phone
		$this->phone->CellCssStyle = ""; $this->phone->CellCssClass = "";
		$this->phone->CellAttrs = array(); $this->phone->ViewAttrs = array(); $this->phone->EditAttrs = array();

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->CssStyle = "";
		$this->id->CssClass = "";
		$this->id->ViewCustomAttributes = "";

		// name
		$this->name->ViewValue = $this->name->CurrentValue;
		$this->name->CssStyle = "";
		$this->name->CssClass = "";
		$this->name->ViewCustomAttributes = "";

		// region
		$this->region->ViewValue = $this->region->CurrentValue;
		$this->region->CssStyle = "";
		$this->region->CssClass = "";
		$this->region->ViewCustomAttributes = "";

		// location
		$this->location->ViewValue = $this->location->CurrentValue;
		$this->location->CssStyle = "";
		$this->location->CssClass = "";
		$this->location->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->CssStyle = "";
		$this->address->CssClass = "";
		$this->address->ViewCustomAttributes = "";

		// zip
		$this->zip->ViewValue = $this->zip->CurrentValue;
		$this->zip->CssStyle = "";
		$this->zip->CssClass = "";
		$this->zip->ViewCustomAttributes = "";

		// city
		$this->city->ViewValue = $this->city->CurrentValue;
		$this->city->CssStyle = "";
		$this->city->CssClass = "";
		$this->city->ViewCustomAttributes = "";

		// court_num
		$this->court_num->ViewValue = $this->court_num->CurrentValue;
		$this->court_num->CssStyle = "";
		$this->court_num->CssClass = "";
		$this->court_num->ViewCustomAttributes = "";

		// lights
		$this->lights->ViewValue = $this->lights->CurrentValue;
		$this->lights->CssStyle = "";
		$this->lights->CssClass = "";
		$this->lights->ViewCustomAttributes = "";

		// maintenance
		$this->maintenance->ViewValue = $this->maintenance->CurrentValue;
		$this->maintenance->CssStyle = "";
		$this->maintenance->CssClass = "";
		$this->maintenance->ViewCustomAttributes = "";

		// website
		$this->website->ViewValue = $this->website->CurrentValue;
		$this->website->CssStyle = "";
		$this->website->CssClass = "";
		$this->website->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->CssStyle = "";
		$this->phone->CssClass = "";
		$this->phone->ViewCustomAttributes = "";

		// id
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// name
		$this->name->HrefValue = "";
		$this->name->TooltipValue = "";

		// region
		$this->region->HrefValue = "";
		$this->region->TooltipValue = "";

		// location
		$this->location->HrefValue = "";
		$this->location->TooltipValue = "";

		// address
		$this->address->HrefValue = "";
		$this->address->TooltipValue = "";

		// zip
		$this->zip->HrefValue = "";
		$this->zip->TooltipValue = "";

		// city
		$this->city->HrefValue = "";
		$this->city->TooltipValue = "";

		// court_num
		$this->court_num->HrefValue = "";
		$this->court_num->TooltipValue = "";

		// lights
		$this->lights->HrefValue = "";
		$this->lights->TooltipValue = "";

		// maintenance
		$this->maintenance->HrefValue = "";
		$this->maintenance->TooltipValue = "";

		// website
		$this->website->HrefValue = "";
		$this->website->TooltipValue = "";

		// phone
		$this->phone->HrefValue = "";
		$this->phone->TooltipValue = "";

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
