<?php

// Global variable for table object
$emailnotificaciones = NULL;

//
// Table class for emailnotificaciones
//
class cemailnotificaciones extends cTable {
	var $id;
	var $enviadopor;
	var $recibidopor;
	var $cc;
	var $bcc;
	var $mensaje;
	var $leido;
	var $estado;
	var $fechaenvio;
	var $fecharecibido;
	var $id_avaluo;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'emailnotificaciones';
		$this->TableName = 'emailnotificaciones';
		$this->TableType = 'TABLE';

		// Update Table
		$this->UpdateTable = "`emailnotificaciones`";
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
		$this->id = new cField('emailnotificaciones', 'emailnotificaciones', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// enviadopor
		$this->enviadopor = new cField('emailnotificaciones', 'emailnotificaciones', 'x_enviadopor', 'enviadopor', '`enviadopor`', '`enviadopor`', 201, -1, FALSE, '`enviadopor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->enviadopor->Sortable = TRUE; // Allow sort
		$this->fields['enviadopor'] = &$this->enviadopor;

		// recibidopor
		$this->recibidopor = new cField('emailnotificaciones', 'emailnotificaciones', 'x_recibidopor', 'recibidopor', '`recibidopor`', '`recibidopor`', 201, -1, FALSE, '`recibidopor`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->recibidopor->Sortable = TRUE; // Allow sort
		$this->fields['recibidopor'] = &$this->recibidopor;

		// cc
		$this->cc = new cField('emailnotificaciones', 'emailnotificaciones', 'x_cc', 'cc', '`cc`', '`cc`', 201, -1, FALSE, '`cc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->cc->Sortable = TRUE; // Allow sort
		$this->fields['cc'] = &$this->cc;

		// bcc
		$this->bcc = new cField('emailnotificaciones', 'emailnotificaciones', 'x_bcc', 'bcc', '`bcc`', '`bcc`', 201, -1, FALSE, '`bcc`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->bcc->Sortable = TRUE; // Allow sort
		$this->fields['bcc'] = &$this->bcc;

		// mensaje
		$this->mensaje = new cField('emailnotificaciones', 'emailnotificaciones', 'x_mensaje', 'mensaje', '`mensaje`', '`mensaje`', 201, -1, FALSE, '`mensaje`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->mensaje->Sortable = TRUE; // Allow sort
		$this->fields['mensaje'] = &$this->mensaje;

		// leido
		$this->leido = new cField('emailnotificaciones', 'emailnotificaciones', 'x_leido', 'leido', '`leido`', '`leido`', 3, -1, FALSE, '`leido`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->leido->Sortable = FALSE; // Allow sort
		$this->leido->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['leido'] = &$this->leido;

		// estado
		$this->estado = new cField('emailnotificaciones', 'emailnotificaciones', 'x_estado', 'estado', '`estado`', '`estado`', 3, -1, FALSE, '`estado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->estado->Sortable = FALSE; // Allow sort
		$this->estado->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['estado'] = &$this->estado;

		// fechaenvio
		$this->fechaenvio = new cField('emailnotificaciones', 'emailnotificaciones', 'x_fechaenvio', 'fechaenvio', '`fechaenvio`', ew_CastDateFieldForLike('`fechaenvio`', 0, "DB"), 135, 0, FALSE, '`fechaenvio`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fechaenvio->Sortable = FALSE; // Allow sort
		$this->fechaenvio->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['fechaenvio'] = &$this->fechaenvio;

		// fecharecibido
		$this->fecharecibido = new cField('emailnotificaciones', 'emailnotificaciones', 'x_fecharecibido', 'fecharecibido', '`fecharecibido`', ew_CastDateFieldForLike('`fecharecibido`', 0, "DB"), 135, 0, FALSE, '`fecharecibido`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecharecibido->Sortable = FALSE; // Allow sort
		$this->fecharecibido->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['fecharecibido'] = &$this->fecharecibido;

		// id_avaluo
		$this->id_avaluo = new cField('emailnotificaciones', 'emailnotificaciones', 'x_id_avaluo', 'id_avaluo', '`id_avaluo`', '`id_avaluo`', 3, -1, FALSE, '`id_avaluo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_avaluo->Sortable = TRUE; // Allow sort
		$this->id_avaluo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_avaluo'] = &$this->id_avaluo;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`emailnotificaciones`";
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
		$this->TableFilter = "`recibidopor`='".$_SESSION["usr"]."'";
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
			return "emailnotificacioneslist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "emailnotificacionesview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "emailnotificacionesedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "emailnotificacionesadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "emailnotificacioneslist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("emailnotificacionesview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("emailnotificacionesview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "emailnotificacionesadd.php?" . $this->UrlParm($parm);
		else
			$url = "emailnotificacionesadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("emailnotificacionesedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("emailnotificacionesadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("emailnotificacionesdelete.php", $this->UrlParm());
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
		$this->enviadopor->setDbValue($rs->fields('enviadopor'));
		$this->recibidopor->setDbValue($rs->fields('recibidopor'));
		$this->cc->setDbValue($rs->fields('cc'));
		$this->bcc->setDbValue($rs->fields('bcc'));
		$this->mensaje->setDbValue($rs->fields('mensaje'));
		$this->leido->setDbValue($rs->fields('leido'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->fechaenvio->setDbValue($rs->fields('fechaenvio'));
		$this->fecharecibido->setDbValue($rs->fields('fecharecibido'));
		$this->id_avaluo->setDbValue($rs->fields('id_avaluo'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// id

		$this->id->CellCssStyle = "white-space: nowrap;";

		// enviadopor
		// recibidopor
		// cc
		// bcc
		// mensaje
		// leido

		$this->leido->CellCssStyle = "white-space: nowrap;";

		// estado
		$this->estado->CellCssStyle = "white-space: nowrap;";

		// fechaenvio
		$this->fechaenvio->CellCssStyle = "white-space: nowrap;";

		// fecharecibido
		$this->fecharecibido->CellCssStyle = "white-space: nowrap;";

		// id_avaluo
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// enviadopor
		$this->enviadopor->ViewValue = $this->enviadopor->CurrentValue;
		$this->enviadopor->ViewCustomAttributes = "";

		// recibidopor
		$this->recibidopor->ViewValue = $this->recibidopor->CurrentValue;
		$this->recibidopor->ViewCustomAttributes = "";

		// cc
		$this->cc->ViewValue = $this->cc->CurrentValue;
		$this->cc->ViewCustomAttributes = "";

		// bcc
		$this->bcc->ViewValue = $this->bcc->CurrentValue;
		$this->bcc->ViewCustomAttributes = "";

		// mensaje
		$this->mensaje->ViewValue = $this->mensaje->CurrentValue;
		$this->mensaje->ViewCustomAttributes = "";

		// leido
		$this->leido->ViewValue = $this->leido->CurrentValue;
		$this->leido->ViewCustomAttributes = "";

		// estado
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// fechaenvio
		$this->fechaenvio->ViewValue = $this->fechaenvio->CurrentValue;
		$this->fechaenvio->ViewValue = ew_FormatDateTime($this->fechaenvio->ViewValue, 0);
		$this->fechaenvio->ViewCustomAttributes = "";

		// fecharecibido
		$this->fecharecibido->ViewValue = $this->fecharecibido->CurrentValue;
		$this->fecharecibido->ViewValue = ew_FormatDateTime($this->fecharecibido->ViewValue, 0);
		$this->fecharecibido->ViewCustomAttributes = "";

		// id_avaluo
		$this->id_avaluo->ViewValue = $this->id_avaluo->CurrentValue;
		$this->id_avaluo->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// enviadopor
		$this->enviadopor->LinkCustomAttributes = "";
		$this->enviadopor->HrefValue = "";
		$this->enviadopor->TooltipValue = "";

		// recibidopor
		$this->recibidopor->LinkCustomAttributes = "";
		$this->recibidopor->HrefValue = "";
		$this->recibidopor->TooltipValue = "";

		// cc
		$this->cc->LinkCustomAttributes = "";
		$this->cc->HrefValue = "";
		$this->cc->TooltipValue = "";

		// bcc
		$this->bcc->LinkCustomAttributes = "";
		$this->bcc->HrefValue = "";
		$this->bcc->TooltipValue = "";

		// mensaje
		$this->mensaje->LinkCustomAttributes = "";
		$this->mensaje->HrefValue = "";
		$this->mensaje->TooltipValue = "";

		// leido
		$this->leido->LinkCustomAttributes = "";
		$this->leido->HrefValue = "";
		$this->leido->TooltipValue = "";

		// estado
		$this->estado->LinkCustomAttributes = "";
		$this->estado->HrefValue = "";
		$this->estado->TooltipValue = "";

		// fechaenvio
		$this->fechaenvio->LinkCustomAttributes = "";
		$this->fechaenvio->HrefValue = "";
		$this->fechaenvio->TooltipValue = "";

		// fecharecibido
		$this->fecharecibido->LinkCustomAttributes = "";
		$this->fecharecibido->HrefValue = "";
		$this->fecharecibido->TooltipValue = "";

		// id_avaluo
		$this->id_avaluo->LinkCustomAttributes = "";
		$this->id_avaluo->HrefValue = "";
		$this->id_avaluo->TooltipValue = "";

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

		// enviadopor
		$this->enviadopor->EditAttrs["class"] = "form-control";
		$this->enviadopor->EditCustomAttributes = "";
		$this->enviadopor->EditValue = $this->enviadopor->CurrentValue;
		$this->enviadopor->PlaceHolder = ew_RemoveHtml($this->enviadopor->FldTitle());

		// recibidopor
		$this->recibidopor->EditAttrs["class"] = "form-control";
		$this->recibidopor->EditCustomAttributes = "";
		$this->recibidopor->EditValue = $this->recibidopor->CurrentValue;
		$this->recibidopor->PlaceHolder = ew_RemoveHtml($this->recibidopor->FldTitle());

		// cc
		$this->cc->EditAttrs["class"] = "form-control";
		$this->cc->EditCustomAttributes = "";
		$this->cc->EditValue = $this->cc->CurrentValue;
		$this->cc->PlaceHolder = ew_RemoveHtml($this->cc->FldTitle());

		// bcc
		$this->bcc->EditAttrs["class"] = "form-control";
		$this->bcc->EditCustomAttributes = "";
		$this->bcc->EditValue = $this->bcc->CurrentValue;
		$this->bcc->PlaceHolder = ew_RemoveHtml($this->bcc->FldTitle());

		// mensaje
		$this->mensaje->EditAttrs["class"] = "form-control";
		$this->mensaje->EditCustomAttributes = "";
		$this->mensaje->EditValue = $this->mensaje->CurrentValue;
		$this->mensaje->PlaceHolder = ew_RemoveHtml($this->mensaje->FldTitle());

		// leido
		$this->leido->EditAttrs["class"] = "form-control";
		$this->leido->EditCustomAttributes = "";
		$this->leido->EditValue = $this->leido->CurrentValue;
		$this->leido->PlaceHolder = ew_RemoveHtml($this->leido->FldTitle());

		// estado
		$this->estado->EditAttrs["class"] = "form-control";
		$this->estado->EditCustomAttributes = "";
		$this->estado->EditValue = $this->estado->CurrentValue;
		$this->estado->PlaceHolder = ew_RemoveHtml($this->estado->FldTitle());

		// fechaenvio
		$this->fechaenvio->EditAttrs["class"] = "form-control";
		$this->fechaenvio->EditCustomAttributes = "";
		$this->fechaenvio->EditValue = ew_FormatDateTime($this->fechaenvio->CurrentValue, 8);
		$this->fechaenvio->PlaceHolder = ew_RemoveHtml($this->fechaenvio->FldTitle());

		// fecharecibido
		$this->fecharecibido->EditAttrs["class"] = "form-control";
		$this->fecharecibido->EditCustomAttributes = "";
		$this->fecharecibido->EditValue = ew_FormatDateTime($this->fecharecibido->CurrentValue, 8);
		$this->fecharecibido->PlaceHolder = ew_RemoveHtml($this->fecharecibido->FldTitle());

		// id_avaluo
		$this->id_avaluo->EditAttrs["class"] = "form-control";
		$this->id_avaluo->EditCustomAttributes = "";
		$this->id_avaluo->EditValue = $this->id_avaluo->CurrentValue;
		$this->id_avaluo->PlaceHolder = ew_RemoveHtml($this->id_avaluo->FldTitle());

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
					if ($this->enviadopor->Exportable) $Doc->ExportCaption($this->enviadopor);
					if ($this->recibidopor->Exportable) $Doc->ExportCaption($this->recibidopor);
					if ($this->cc->Exportable) $Doc->ExportCaption($this->cc);
					if ($this->bcc->Exportable) $Doc->ExportCaption($this->bcc);
					if ($this->mensaje->Exportable) $Doc->ExportCaption($this->mensaje);
					if ($this->id_avaluo->Exportable) $Doc->ExportCaption($this->id_avaluo);
				} else {
					if ($this->id_avaluo->Exportable) $Doc->ExportCaption($this->id_avaluo);
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
						if ($this->enviadopor->Exportable) $Doc->ExportField($this->enviadopor);
						if ($this->recibidopor->Exportable) $Doc->ExportField($this->recibidopor);
						if ($this->cc->Exportable) $Doc->ExportField($this->cc);
						if ($this->bcc->Exportable) $Doc->ExportField($this->bcc);
						if ($this->mensaje->Exportable) $Doc->ExportField($this->mensaje);
						if ($this->id_avaluo->Exportable) $Doc->ExportField($this->id_avaluo);
					} else {
						if ($this->id_avaluo->Exportable) $Doc->ExportField($this->id_avaluo);
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
