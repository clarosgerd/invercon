<?php

// Global variable for table object
$viewpagoavaluos = NULL;

//
// Table class for viewpagoavaluos
//
class cviewpagoavaluos extends cTable {
	var $id;
	var $pago_id;
	var $avaluo_id;
	var $q;
	var $id_metodopago;
	var $id_banco;
	var $monto;
	var $documentopago;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'viewpagoavaluos';
		$this->TableName = 'viewpagoavaluos';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`viewpagoavaluos`";
		$this->DBID = 'DB';
		$this->ExportAll = TRUE;
		$this->ExportPageBreakCount = 0; // Page break per every n record (PDF only)
		$this->ExportPageOrientation = "portrait"; // Page orientation (PDF only)
		$this->ExportPageSize = "a4"; // Page size (PDF only)
		$this->ExportExcelPageOrientation = ""; // Page orientation (PHPExcel only)
		$this->ExportExcelPageSize = ""; // Page size (PHPExcel only)
		$this->ExportWordPageOrientation = "portrait"; // Page orientation (PHPWord only)
		$this->ExportWordColumnWidth = NULL; // Cell width (PHPWord only)
		$this->DetailAdd = FALSE; // Allow detail add
		$this->DetailEdit = FALSE; // Allow detail edit
		$this->DetailView = FALSE; // Allow detail view
		$this->ShowMultipleDetails = FALSE; // Show multiple details
		$this->GridAddRowCount = 3;
		$this->AllowAddDeleteRow = TRUE; // Allow add/delete row
		$this->UserIDAllowSecurity = 0; // User ID Allow
		$this->BasicSearch = new cBasicSearch($this->TableVar);

		// id
		$this->id = new cField('viewpagoavaluos', 'viewpagoavaluos', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// pago_id
		$this->pago_id = new cField('viewpagoavaluos', 'viewpagoavaluos', 'x_pago_id', 'pago_id', '`pago_id`', '`pago_id`', 3, -1, FALSE, '`pago_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->pago_id->Sortable = TRUE; // Allow sort
		$this->pago_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['pago_id'] = &$this->pago_id;

		// avaluo_id
		$this->avaluo_id = new cField('viewpagoavaluos', 'viewpagoavaluos', 'x_avaluo_id', 'avaluo_id', '`avaluo_id`', '`avaluo_id`', 3, -1, FALSE, '`avaluo_id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->avaluo_id->Sortable = TRUE; // Allow sort
		$this->avaluo_id->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->avaluo_id->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->avaluo_id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['avaluo_id'] = &$this->avaluo_id;

		// q
		$this->q = new cField('viewpagoavaluos', 'viewpagoavaluos', 'x_q', 'q', '`q`', '`q`', 3, -1, FALSE, '`q`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->q->Sortable = TRUE; // Allow sort
		$this->q->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['q'] = &$this->q;

		// id_metodopago
		$this->id_metodopago = new cField('viewpagoavaluos', 'viewpagoavaluos', 'x_id_metodopago', 'id_metodopago', '`id_metodopago`', '`id_metodopago`', 3, -1, FALSE, '`id_metodopago`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_metodopago->Sortable = TRUE; // Allow sort
		$this->id_metodopago->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_metodopago->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->id_metodopago->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_metodopago'] = &$this->id_metodopago;

		// id_banco
		$this->id_banco = new cField('viewpagoavaluos', 'viewpagoavaluos', 'x_id_banco', 'id_banco', '`id_banco`', '`id_banco`', 3, -1, FALSE, '`id_banco`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_banco->Sortable = TRUE; // Allow sort
		$this->id_banco->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_banco->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->id_banco->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_banco'] = &$this->id_banco;

		// monto
		$this->monto = new cField('viewpagoavaluos', 'viewpagoavaluos', 'x_monto', 'monto', '`monto`', '`monto`', 5, -1, FALSE, '`monto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->monto->Sortable = TRUE; // Allow sort
		$this->monto->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['monto'] = &$this->monto;

		// documentopago
		$this->documentopago = new cField('viewpagoavaluos', 'viewpagoavaluos', 'x_documentopago', 'documentopago', '`documentopago`', '`documentopago`', 205, -1, TRUE, '`documentopago`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->documentopago->Sortable = TRUE; // Allow sort
		$this->fields['documentopago'] = &$this->documentopago;
	}

	// Field Visibility
	function GetFieldVisibility($fldparm) {
		global $Security;
		return $this->$fldparm->Visible; // Returns original value
	}

	// Column CSS classes
	var $LeftColumnClass = "col-sm-3 control-label ewLabel";
	var $RightColumnClass = "col-sm-9";
	var $OffsetColumnClass = "col-sm-9 col-sm-offset-3";

	// Set left column class (must be predefined col-*-* classes of Bootstrap grid system)
	function SetLeftColumnClass($class) {
		if (preg_match('/^col\-(\w+)\-(\d+)$/', $class, $match)) {
			$this->LeftColumnClass = $class . " control-label ewLabel";
			$this->RightColumnClass = "col-" . $match[1] . "-" . strval(12 - intval($match[2]));
			$this->OffsetColumnClass = $this->RightColumnClass . " " . str_replace($match[1], $match[1] + "-offset", $class);
		}
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

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`viewpagoavaluos`";
	}

	function SqlFrom() { // For backward compatibility
		return $this->getSqlFrom();
	}

	function setSqlFrom($v) {
		$this->_SqlFrom = $v;
	}
	var $_SqlSelect = "";

	function getSqlSelect() { // Select
		return ($this->_SqlSelect <> "") ? $this->_SqlSelect : "SELECT * FROM " . $this->getSqlFrom();
	}

	function SqlSelect() { // For backward compatibility
		return $this->getSqlSelect();
	}

	function setSqlSelect($v) {
		$this->_SqlSelect = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "avaluo_id='".$_GET["avaluo"]."'";
		ew_AddFilter($sWhere, $this->TableFilter);
		return $sWhere;
	}

	function SqlWhere() { // For backward compatibility
		return $this->getSqlWhere();
	}

	function setSqlWhere($v) {
		$this->_SqlWhere = $v;
	}
	var $_SqlGroupBy = "";

	function getSqlGroupBy() { // Group By
		return ($this->_SqlGroupBy <> "") ? $this->_SqlGroupBy : "";
	}

	function SqlGroupBy() { // For backward compatibility
		return $this->getSqlGroupBy();
	}

	function setSqlGroupBy($v) {
		$this->_SqlGroupBy = $v;
	}
	var $_SqlHaving = "";

	function getSqlHaving() { // Having
		return ($this->_SqlHaving <> "") ? $this->_SqlHaving : "";
	}

	function SqlHaving() { // For backward compatibility
		return $this->getSqlHaving();
	}

	function setSqlHaving($v) {
		$this->_SqlHaving = $v;
	}
	var $_SqlOrderBy = "";

	function getSqlOrderBy() { // Order By
		return ($this->_SqlOrderBy <> "") ? $this->_SqlOrderBy : "";
	}

	function SqlOrderBy() { // For backward compatibility
		return $this->getSqlOrderBy();
	}

	function setSqlOrderBy($v) {
		$this->_SqlOrderBy = $v;
	}

	// Apply User ID filters
	function ApplyUserIDFilters($sFilter) {
		return $sFilter;
	}

	// Check if User ID security allows view all
	function UserIDAllow($id = "") {
		$allow = EW_USER_ID_ALLOW;
		switch ($id) {
			case "add":
			case "copy":
			case "gridadd":
			case "register":
			case "addopt":
				return (($allow & 1) == 1);
			case "edit":
			case "gridedit":
			case "update":
			case "changepwd":
			case "forgotpwd":
				return (($allow & 4) == 4);
			case "delete":
				return (($allow & 2) == 2);
			case "view":
				return (($allow & 32) == 32);
			case "search":
				return (($allow & 64) == 64);
			default:
				return (($allow & 8) == 8);
		}
	}

	// Get SQL
	function GetSQL($where, $orderby) {
		return ew_BuildSelectSql($this->getSqlSelect(), $this->getSqlWhere(),
			$this->getSqlGroupBy(), $this->getSqlHaving(), $this->getSqlOrderBy(),
			$where, $orderby);
	}

	// Table SQL
	function SQL() {
		$filter = $this->CurrentFilter;
		$filter = $this->ApplyUserIDFilters($filter);
		$sort = $this->getSessionOrderBy();
		return $this->GetSQL($filter, $sort);
	}

	// Table SQL with List page filter
	var $UseSessionForListSQL = TRUE;

	function ListSQL() {
		$sFilter = $this->UseSessionForListSQL ? $this->getSessionWhere() : "";
		ew_AddFilter($sFilter, $this->CurrentFilter);
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$this->Recordset_Selecting($sFilter);
		$sSelect = $this->getSqlSelect();
		$sSort = $this->UseSessionForListSQL ? $this->getSessionOrderBy() : "";
		return ew_BuildSelectSql($sSelect, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Try to get record count
	function TryGetRecordCount($sql) {
		$cnt = -1;
		$pattern = "/^SELECT \* FROM/i";
		if (($this->TableType == 'TABLE' || $this->TableType == 'VIEW' || $this->TableType == 'LINKTABLE') && preg_match($pattern, $sql)) {
			$sql = "SELECT COUNT(*) FROM" . preg_replace($pattern, "", $sql);
		} else {
			$sql = "SELECT COUNT(*) FROM (" . $sql . ") EW_COUNT_TABLE";
		}
		$conn = &$this->Connection();
		if ($rs = $conn->Execute($sql)) {
			if (!$rs->EOF && $rs->FieldCount() > 0) {
				$cnt = $rs->fields[0];
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// Get record count based on filter (for detail record count in master table pages)
	function LoadRecordCount($filter) {
		$origFilter = $this->CurrentFilter;
		$this->CurrentFilter = $filter;
		$this->Recordset_Selecting($this->CurrentFilter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $this->CurrentFilter, "");
		$cnt = $this->TryGetRecordCount($sql);
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
	function ListRecordCount() {
		$filter = $this->getSessionWhere();
		ew_AddFilter($filter, $this->CurrentFilter);
		$filter = $this->ApplyUserIDFilters($filter);
		$this->Recordset_Selecting($filter);
		$select = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlSelect() : "SELECT * FROM " . $this->getSqlFrom();
		$groupBy = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlGroupBy() : "";
		$having = $this->TableType == 'CUSTOMVIEW' ? $this->getSqlHaving() : "";
		$sql = ew_BuildSelectSql($select, $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		$cnt = $this->TryGetRecordCount($sql);
		if ($cnt == -1) {
			$conn = &$this->Connection();
			if ($rs = $conn->Execute($sql)) {
				$cnt = $rs->RecordCount();
				$rs->Close();
			}
		}
		return intval($cnt);
	}

	// INSERT statement
	function InsertSQL(&$rs) {
		$names = "";
		$values = "";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$names .= $this->fields[$name]->FldExpression . ",";
			$values .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$names = preg_replace('/,+$/', "", $names);
		$values = preg_replace('/,+$/', "", $values);
		return "INSERT INTO " . $this->UpdateTable . " ($names) VALUES ($values)";
	}

	// Insert
	function Insert(&$rs) {
		$conn = &$this->Connection();
		$bInsert = $conn->Execute($this->InsertSQL($rs));
		if ($bInsert) {

			// Get insert id if necessary
			$this->id->setDbValue($conn->Insert_ID());
			$rs['id'] = $this->id->DbValue;
		}
		return $bInsert;
	}

	// UPDATE statement
	function UpdateSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "UPDATE " . $this->UpdateTable . " SET ";
		foreach ($rs as $name => $value) {
			if (!isset($this->fields[$name]) || $this->fields[$name]->FldIsCustom)
				continue;
			$sql .= $this->fields[$name]->FldExpression . "=";
			$sql .= ew_QuotedValue($value, $this->fields[$name]->FldDataType, $this->DBID) . ",";
		}
		$sql = preg_replace('/,+$/', "", $sql);
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		ew_AddFilter($filter, $where);
		if ($filter <> "")	$sql .= " WHERE " . $filter;
		return $sql;
	}

	// Update
	function Update(&$rs, $where = "", $rsold = NULL, $curfilter = TRUE) {
		$conn = &$this->Connection();
		$bUpdate = $conn->Execute($this->UpdateSQL($rs, $where, $curfilter));
		return $bUpdate;
	}

	// DELETE statement
	function DeleteSQL(&$rs, $where = "", $curfilter = TRUE) {
		$sql = "DELETE FROM " . $this->UpdateTable . " WHERE ";
		if (is_array($where))
			$where = $this->ArrayToFilter($where);
		if ($rs) {
			if (array_key_exists('id', $rs))
				ew_AddFilter($where, ew_QuotedName('id', $this->DBID) . '=' . ew_QuotedValue($rs['id'], $this->id->FldDataType, $this->DBID));
		}
		$filter = ($curfilter) ? $this->CurrentFilter : "";
		ew_AddFilter($filter, $where);
		if ($filter <> "")
			$sql .= $filter;
		else
			$sql .= "0=1"; // Avoid delete
		return $sql;
	}

	// Delete
	function Delete(&$rs, $where = "", $curfilter = TRUE) {
		$bDelete = TRUE;
		$conn = &$this->Connection();
		if ($bDelete)
			$bDelete = $conn->Execute($this->DeleteSQL($rs, $where, $curfilter));
		return $bDelete;
	}

	// Key filter WHERE clause
	function SqlKeyFilter() {
		return "`id` = @id@";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (!is_numeric($this->id->CurrentValue))
			return "0=1"; // Invalid key
		if (is_null($this->id->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@id@", ew_AdjustSql($this->id->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "viewpagoavaluoslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "viewpagoavaluosview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "viewpagoavaluosedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "viewpagoavaluosadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "viewpagoavaluoslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("viewpagoavaluosview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("viewpagoavaluosview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "viewpagoavaluosadd.php?" . $this->UrlParm($parm);
		else
			$url = "viewpagoavaluosadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("viewpagoavaluosedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("viewpagoavaluosadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("viewpagoavaluosdelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "id:" . ew_VarToJson($this->id->CurrentValue, "number", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->id->CurrentValue)) {
			$sUrl .= "id=" . urlencode($this->id->CurrentValue);
		} else {
			return "javascript:ew_Alert(ewLanguage.Phrase('InvalidRecord'));";
		}
		return $sUrl;
	}

	// Sort URL
	function SortUrl(&$fld) {
		if ($this->CurrentAction <> "" || $this->Export <> "" ||
			in_array($fld->FldType, array(128, 204, 205))) { // Unsortable data type
				return "";
		} elseif ($fld->Sortable) {
			$sUrlParm = $this->UrlParm("order=" . urlencode($fld->FldName) . "&amp;ordertype=" . $fld->ReverseSort());
			return $this->AddMasterUrl(ew_CurrentPage() . "?" . $sUrlParm);
		} else {
			return "";
		}
	}

	// Get record keys from $_POST/$_GET/$_SESSION
	function GetRecordKeys() {
		global $EW_COMPOSITE_KEY_SEPARATOR;
		$arKeys = array();
		$arKey = array();
		if (isset($_POST["key_m"])) {
			$arKeys = $_POST["key_m"];
			$cnt = count($arKeys);
		} elseif (isset($_GET["key_m"])) {
			$arKeys = $_GET["key_m"];
			$cnt = count($arKeys);
		} elseif (!empty($_GET) || !empty($_POST)) {
			$isPost = ew_IsPost();
			if ($isPost && isset($_POST["id"]))
				$arKeys[] = $_POST["id"];
			elseif (isset($_GET["id"]))
				$arKeys[] = $_GET["id"];
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
				if (!is_numeric($key))
					continue;
				$ar[] = $key;
			}
		}
		return $ar;
	}

	// Get key filter
	function GetKeyFilter() {
		$arKeys = $this->GetRecordKeys();
		$sKeyFilter = "";
		foreach ($arKeys as $key) {
			if ($sKeyFilter <> "") $sKeyFilter .= " OR ";
			$this->id->CurrentValue = $key;
			$sKeyFilter .= "(" . $this->KeyFilter() . ")";
		}
		return $sKeyFilter;
	}

	// Load rows based on filter
	function &LoadRs($filter) {

		// Set up filter (SQL WHERE clause) and get return SQL
		//$this->CurrentFilter = $filter;
		//$sql = $this->SQL();

		$sql = $this->GetSQL($filter, "");
		$conn = &$this->Connection();
		$rs = $conn->Execute($sql);
		return $rs;
	}

	// Load row values from recordset
	function LoadListRowValues(&$rs) {
		$this->id->setDbValue($rs->fields('id'));
		$this->pago_id->setDbValue($rs->fields('pago_id'));
		$this->avaluo_id->setDbValue($rs->fields('avaluo_id'));
		$this->q->setDbValue($rs->fields('q'));
		$this->id_metodopago->setDbValue($rs->fields('id_metodopago'));
		$this->id_banco->setDbValue($rs->fields('id_banco'));
		$this->monto->setDbValue($rs->fields('monto'));
		$this->documentopago->Upload->DbValue = $rs->fields('documentopago');
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// id
		// pago_id
		// avaluo_id
		// q
		// id_metodopago
		// id_banco
		// monto
		// documentopago
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pago_id
		$this->pago_id->ViewValue = $this->pago_id->CurrentValue;
		$this->pago_id->ViewCustomAttributes = "";

		// avaluo_id
		if (strval($this->avaluo_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->avaluo_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `codigoavaluo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
				$sWhereWrk = "";
				$this->avaluo_id->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `codigoavaluo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
				$sWhereWrk = "";
				$this->avaluo_id->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `codigoavaluo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
				$sWhereWrk = "";
				$this->avaluo_id->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->avaluo_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_FormatNumber($rswrk->fields('DispFld'), 0, 0, 0, 0);
				$this->avaluo_id->ViewValue = $this->avaluo_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->avaluo_id->ViewValue = $this->avaluo_id->CurrentValue;
			}
		} else {
			$this->avaluo_id->ViewValue = NULL;
		}
		$this->avaluo_id->ViewCustomAttributes = "";

		// q
		$this->q->ViewValue = $this->q->CurrentValue;
		$this->q->ViewCustomAttributes = "";

		// id_metodopago
		if (strval($this->id_metodopago->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_metodopago->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `metodopago`";
				$sWhereWrk = "";
				$this->id_metodopago->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `metodopago`";
				$sWhereWrk = "";
				$this->id_metodopago->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `metodopago`";
				$sWhereWrk = "";
				$this->id_metodopago->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_metodopago, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_metodopago->ViewValue = $this->id_metodopago->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_metodopago->ViewValue = $this->id_metodopago->CurrentValue;
			}
		} else {
			$this->id_metodopago->ViewValue = NULL;
		}
		$this->id_metodopago->ViewCustomAttributes = "";

		// id_banco
		if (strval($this->id_banco->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_banco->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `banco`";
				$sWhereWrk = "";
				$this->id_banco->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `banco`";
				$sWhereWrk = "";
				$this->id_banco->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `banco`";
				$sWhereWrk = "";
				$this->id_banco->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_banco, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_banco->ViewValue = $this->id_banco->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_banco->ViewValue = $this->id_banco->CurrentValue;
			}
		} else {
			$this->id_banco->ViewValue = NULL;
		}
		$this->id_banco->ViewCustomAttributes = "";

		// monto
		$this->monto->ViewValue = $this->monto->CurrentValue;
		$this->monto->ViewCustomAttributes = "";

		// documentopago
		if (!ew_Empty($this->documentopago->Upload->DbValue)) {
			$this->documentopago->ViewValue = "viewpagoavaluos_documentopago_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->documentopago->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->documentopago->Upload->DbValue, 0, 11)));
		} else {
			$this->documentopago->ViewValue = "";
		}
		$this->documentopago->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// pago_id
		$this->pago_id->LinkCustomAttributes = "";
		$this->pago_id->HrefValue = "";
		$this->pago_id->TooltipValue = "";

		// avaluo_id
		$this->avaluo_id->LinkCustomAttributes = "";
		$this->avaluo_id->HrefValue = "";
		$this->avaluo_id->TooltipValue = "";

		// q
		$this->q->LinkCustomAttributes = "";
		$this->q->HrefValue = "";
		$this->q->TooltipValue = "";

		// id_metodopago
		$this->id_metodopago->LinkCustomAttributes = "";
		$this->id_metodopago->HrefValue = "";
		$this->id_metodopago->TooltipValue = "";

		// id_banco
		$this->id_banco->LinkCustomAttributes = "";
		$this->id_banco->HrefValue = "";
		$this->id_banco->TooltipValue = "";

		// monto
		$this->monto->LinkCustomAttributes = "";
		$this->monto->HrefValue = "";
		$this->monto->TooltipValue = "";

		// documentopago
		$this->documentopago->LinkCustomAttributes = "";
		if (!empty($this->documentopago->Upload->DbValue)) {
			$this->documentopago->HrefValue = "viewpagoavaluos_documentopago_bv.php?id=" . $this->id->CurrentValue;
			$this->documentopago->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->documentopago->HrefValue = ew_FullUrl($this->documentopago->HrefValue, "href");
		} else {
			$this->documentopago->HrefValue = "";
		}
		$this->documentopago->HrefValue2 = "viewpagoavaluos_documentopago_bv.php?id=" . $this->id->CurrentValue;
		$this->documentopago->TooltipValue = "";

		// Call Row Rendered event
		$this->Row_Rendered();

		// Save data for Custom Template
		$this->Rows[] = $this->CustomTemplateFieldValues();
	}

	// Render edit row values
	function RenderEditRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

		// id
		$this->id->EditAttrs["class"] = "form-control";
		$this->id->EditCustomAttributes = "";
		$this->id->EditValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pago_id
		$this->pago_id->EditAttrs["class"] = "form-control";
		$this->pago_id->EditCustomAttributes = "";
		$this->pago_id->EditValue = $this->pago_id->CurrentValue;
		$this->pago_id->PlaceHolder = ew_RemoveHtml($this->pago_id->FldTitle());

		// avaluo_id
		$this->avaluo_id->EditAttrs["class"] = "form-control";
		$this->avaluo_id->EditCustomAttributes = "";

		// q
		$this->q->EditAttrs["class"] = "form-control";
		$this->q->EditCustomAttributes = "";
		$this->q->EditValue = $this->q->CurrentValue;
		$this->q->PlaceHolder = ew_RemoveHtml($this->q->FldTitle());

		// id_metodopago
		$this->id_metodopago->EditAttrs["class"] = "form-control";
		$this->id_metodopago->EditCustomAttributes = "";

		// id_banco
		$this->id_banco->EditAttrs["class"] = "form-control";
		$this->id_banco->EditCustomAttributes = "";

		// monto
		$this->monto->EditAttrs["class"] = "form-control";
		$this->monto->EditCustomAttributes = "";
		$this->monto->EditValue = $this->monto->CurrentValue;
		$this->monto->PlaceHolder = ew_RemoveHtml($this->monto->FldTitle());
		if (strval($this->monto->EditValue) <> "" && is_numeric($this->monto->EditValue)) $this->monto->EditValue = ew_FormatNumber($this->monto->EditValue, -2, -1, -2, 0);

		// documentopago
		$this->documentopago->EditAttrs["class"] = "form-control";
		$this->documentopago->EditCustomAttributes = "";
		if (!ew_Empty($this->documentopago->Upload->DbValue)) {
			$this->documentopago->EditValue = "viewpagoavaluos_documentopago_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->documentopago->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->documentopago->Upload->DbValue, 0, 11)));
		} else {
			$this->documentopago->EditValue = "";
		}

		// Call Row Rendered event
		$this->Row_Rendered();
	}

	// Aggregate list row values
	function AggregateListRowValues() {
	}

	// Aggregate list row (for rendering)
	function AggregateListRow() {

		// Call Row Rendered event
		$this->Row_Rendered();
	}
	var $ExportDoc;

	// Export data in HTML/CSV/Word/Excel/Email/PDF format
	function ExportDocument(&$Doc, &$Recordset, $StartRec, $StopRec, $ExportPageType = "") {
		if (!$Recordset || !$Doc)
			return;
		if (!$Doc->ExportCustom) {

			// Write header
			$Doc->ExportTableHeader();
			if ($Doc->Horizontal) { // Horizontal format, write header
				$Doc->BeginExportRow();
				if ($ExportPageType == "view") {
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->pago_id->Exportable) $Doc->ExportCaption($this->pago_id);
					if ($this->avaluo_id->Exportable) $Doc->ExportCaption($this->avaluo_id);
					if ($this->q->Exportable) $Doc->ExportCaption($this->q);
					if ($this->id_metodopago->Exportable) $Doc->ExportCaption($this->id_metodopago);
					if ($this->id_banco->Exportable) $Doc->ExportCaption($this->id_banco);
					if ($this->monto->Exportable) $Doc->ExportCaption($this->monto);
					if ($this->documentopago->Exportable) $Doc->ExportCaption($this->documentopago);
				} else {
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->pago_id->Exportable) $Doc->ExportCaption($this->pago_id);
					if ($this->avaluo_id->Exportable) $Doc->ExportCaption($this->avaluo_id);
					if ($this->q->Exportable) $Doc->ExportCaption($this->q);
					if ($this->id_metodopago->Exportable) $Doc->ExportCaption($this->id_metodopago);
					if ($this->id_banco->Exportable) $Doc->ExportCaption($this->id_banco);
					if ($this->monto->Exportable) $Doc->ExportCaption($this->monto);
				}
				$Doc->EndExportRow();
			}
		}

		// Move to first record
		$RecCnt = $StartRec - 1;
		if (!$Recordset->EOF) {
			$Recordset->MoveFirst();
			if ($StartRec > 1)
				$Recordset->Move($StartRec - 1);
		}
		while (!$Recordset->EOF && $RecCnt < $StopRec) {
			$RecCnt++;
			if (intval($RecCnt) >= intval($StartRec)) {
				$RowCnt = intval($RecCnt) - intval($StartRec) + 1;

				// Page break
				if ($this->ExportPageBreakCount > 0) {
					if ($RowCnt > 1 && ($RowCnt - 1) % $this->ExportPageBreakCount == 0)
						$Doc->ExportPageBreak();
				}
				$this->LoadListRowValues($Recordset);

				// Render row
				$this->RowType = EW_ROWTYPE_VIEW; // Render view
				$this->ResetAttrs();
				$this->RenderListRow();
				if (!$Doc->ExportCustom) {
					$Doc->BeginExportRow($RowCnt); // Allow CSS styles if enabled
					if ($ExportPageType == "view") {
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->pago_id->Exportable) $Doc->ExportField($this->pago_id);
						if ($this->avaluo_id->Exportable) $Doc->ExportField($this->avaluo_id);
						if ($this->q->Exportable) $Doc->ExportField($this->q);
						if ($this->id_metodopago->Exportable) $Doc->ExportField($this->id_metodopago);
						if ($this->id_banco->Exportable) $Doc->ExportField($this->id_banco);
						if ($this->monto->Exportable) $Doc->ExportField($this->monto);
						if ($this->documentopago->Exportable) $Doc->ExportField($this->documentopago);
					} else {
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->pago_id->Exportable) $Doc->ExportField($this->pago_id);
						if ($this->avaluo_id->Exportable) $Doc->ExportField($this->avaluo_id);
						if ($this->q->Exportable) $Doc->ExportField($this->q);
						if ($this->id_metodopago->Exportable) $Doc->ExportField($this->id_metodopago);
						if ($this->id_banco->Exportable) $Doc->ExportField($this->id_banco);
						if ($this->monto->Exportable) $Doc->ExportField($this->monto);
					}
					$Doc->EndExportRow($RowCnt);
				}
			}

			// Call Row Export server event
			if ($Doc->ExportCustom)
				$this->Row_Export($Recordset->fields);
			$Recordset->MoveNext();
		}
		if (!$Doc->ExportCustom) {
			$Doc->ExportTableFooter();
		}
	}

	// Get auto fill value
	function GetAutoFill($id, $val) {
		$rsarr = array();
		$rowcnt = 0;

		// Output
		if (is_array($rsarr) && $rowcnt > 0) {
			$fldcnt = count($rsarr[0]);
			for ($i = 0; $i < $rowcnt; $i++) {
				for ($j = 0; $j < $fldcnt; $j++) {
					$str = strval($rsarr[$i][$j]);
					$str = ew_ConvertToUtf8($str);
					if (isset($post["keepCRLF"])) {
						$str = str_replace(array("\r", "\n"), array("\\r", "\\n"), $str);
					} else {
						$str = str_replace(array("\r", "\n"), array(" ", " "), $str);
					}
					$rsarr[$i][$j] = $str;
				}
			}
			return ew_ArrayToJson($rsarr);
		} else {
			return FALSE;
		}
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

	// Row Inserting event
	function Row_Inserting($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Inserted event
	function Row_Inserted($rsold, &$rsnew) {

		//echo "Row Inserted"
	}

	// Row Updating event
	function Row_Updating($rsold, &$rsnew) {

		// Enter your code here
		// To cancel, set return value to FALSE

		return TRUE;
	}

	// Row Updated event
	function Row_Updated($rsold, &$rsnew) {

		//echo "Row Updated";
	}

	// Row Update Conflict event
	function Row_UpdateConflict($rsold, &$rsnew) {

		// Enter your code here
		// To ignore conflict, set return value to FALSE

		return TRUE;
	}

	// Grid Inserting event
	function Grid_Inserting() {

		// Enter your code here
		// To reject grid insert, set return value to FALSE

		return TRUE;
	}

	// Grid Inserted event
	function Grid_Inserted($rsnew) {

		//echo "Grid Inserted";
	}

	// Grid Updating event
	function Grid_Updating($rsold) {

		// Enter your code here
		// To reject grid update, set return value to FALSE

		return TRUE;
	}

	// Grid Updated event
	function Grid_Updated($rsold, $rsnew) {

		//echo "Grid Updated";
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

	// Lookup Selecting event
	function Lookup_Selecting($fld, &$filter) {

		//var_dump($fld->FldName, $fld->LookupFilters, $filter); // Uncomment to view the filter
		// Enter your code here

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

	// User ID Filtering event
	function UserID_Filtering(&$filter) {

		// Enter your code here
	}
}
?>