<?php

// Global variable for table object
$inspector = NULL;

//
// Table class for inspector
//
class cinspector extends cTable {
	var $nombre;
	var $apellido;
	var $_login;
	var $password;
	var $ci;
	var $id_rol;
	var $id_sucursal;
	var $_email;
	var $telefono_fijo01;
	var $telefono_fijo02;
	var $celular;
	var $celular2;
	var $direccion;
	var $cargo;
	var $id_institucion;
	var $especialidad;
	var $status;
	var $color;
	var $avatar;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'inspector';
		$this->TableName = 'inspector';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`inspector`";
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

		// nombre
		$this->nombre = new cField('inspector', 'inspector', 'x_nombre', 'nombre', '`nombre`', '`nombre`', 200, -1, FALSE, '`nombre`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nombre->Sortable = TRUE; // Allow sort
		$this->fields['nombre'] = &$this->nombre;

		// apellido
		$this->apellido = new cField('inspector', 'inspector', 'x_apellido', 'apellido', '`apellido`', '`apellido`', 200, -1, FALSE, '`apellido`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->apellido->Sortable = TRUE; // Allow sort
		$this->fields['apellido'] = &$this->apellido;

		// login
		$this->_login = new cField('inspector', 'inspector', 'x__login', 'login', '`login`', '`login`', 200, -1, FALSE, '`login`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_login->Sortable = TRUE; // Allow sort
		$this->_login->FldDefaultErrMsg = $Language->Phrase("IncorrectEmail");
		$this->fields['login'] = &$this->_login;

		// password
		$this->password = new cField('inspector', 'inspector', 'x_password', 'password', '`password`', '`password`', 200, -1, FALSE, '`password`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'PASSWORD');
		$this->password->Sortable = FALSE; // Allow sort
		$this->fields['password'] = &$this->password;

		// ci
		$this->ci = new cField('inspector', 'inspector', 'x_ci', 'ci', '`ci`', '`ci`', 200, -1, FALSE, '`ci`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ci->Sortable = TRUE; // Allow sort
		$this->fields['ci'] = &$this->ci;

		// id_rol
		$this->id_rol = new cField('inspector', 'inspector', 'x_id_rol', 'id_rol', '`id_rol`', '`id_rol`', 3, -1, FALSE, '`id_rol`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_rol->Sortable = TRUE; // Allow sort
		$this->id_rol->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_rol->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->id_rol->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_rol'] = &$this->id_rol;

		// id_sucursal
		$this->id_sucursal = new cField('inspector', 'inspector', 'x_id_sucursal', 'id_sucursal', '`id_sucursal`', '`id_sucursal`', 3, -1, FALSE, '`id_sucursal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_sucursal->Sortable = TRUE; // Allow sort
		$this->id_sucursal->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_sucursal->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->id_sucursal->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_sucursal'] = &$this->id_sucursal;

		// email
		$this->_email = new cField('inspector', 'inspector', 'x__email', 'email', '`email`', '`email`', 200, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Sortable = TRUE; // Allow sort
		$this->_email->FldDefaultErrMsg = $Language->Phrase("IncorrectEmail");
		$this->fields['email'] = &$this->_email;

		// telefono_fijo01
		$this->telefono_fijo01 = new cField('inspector', 'inspector', 'x_telefono_fijo01', 'telefono_fijo01', '`telefono_fijo01`', '`telefono_fijo01`', 200, -1, FALSE, '`telefono_fijo01`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telefono_fijo01->Sortable = TRUE; // Allow sort
		$this->fields['telefono_fijo01'] = &$this->telefono_fijo01;

		// telefono_fijo02
		$this->telefono_fijo02 = new cField('inspector', 'inspector', 'x_telefono_fijo02', 'telefono_fijo02', '`telefono_fijo02`', '`telefono_fijo02`', 200, -1, FALSE, '`telefono_fijo02`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->telefono_fijo02->Sortable = TRUE; // Allow sort
		$this->fields['telefono_fijo02'] = &$this->telefono_fijo02;

		// celular
		$this->celular = new cField('inspector', 'inspector', 'x_celular', 'celular', '`celular`', '`celular`', 200, -1, FALSE, '`celular`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->celular->Sortable = TRUE; // Allow sort
		$this->fields['celular'] = &$this->celular;

		// celular2
		$this->celular2 = new cField('inspector', 'inspector', 'x_celular2', 'celular2', '`celular2`', '`celular2`', 200, -1, FALSE, '`celular2`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->celular2->Sortable = TRUE; // Allow sort
		$this->fields['celular2'] = &$this->celular2;

		// direccion
		$this->direccion = new cField('inspector', 'inspector', 'x_direccion', 'direccion', '`direccion`', '`direccion`', 201, -1, FALSE, '`direccion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->direccion->Sortable = TRUE; // Allow sort
		$this->fields['direccion'] = &$this->direccion;

		// cargo
		$this->cargo = new cField('inspector', 'inspector', 'x_cargo', 'cargo', '`cargo`', '`cargo`', 200, -1, FALSE, '`cargo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cargo->Sortable = TRUE; // Allow sort
		$this->fields['cargo'] = &$this->cargo;

		// id_institucion
		$this->id_institucion = new cField('inspector', 'inspector', 'x_id_institucion', 'id_institucion', '`id_institucion`', '`id_institucion`', 3, -1, FALSE, '`id_institucion`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_institucion->Sortable = TRUE; // Allow sort
		$this->id_institucion->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_institucion'] = &$this->id_institucion;

		// especialidad
		$this->especialidad = new cField('inspector', 'inspector', 'x_especialidad', 'especialidad', '`especialidad`', '`especialidad`', 200, -1, FALSE, '`especialidad`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->especialidad->Sortable = TRUE; // Allow sort
		$this->fields['especialidad'] = &$this->especialidad;

		// status
		$this->status = new cField('inspector', 'inspector', 'x_status', 'status', '`status`', '`status`', 3, -1, FALSE, '`status`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->status->Sortable = TRUE; // Allow sort
		$this->status->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['status'] = &$this->status;

		// color
		$this->color = new cField('inspector', 'inspector', 'x_color', 'color', '`color`', '`color`', 200, -1, FALSE, '`color`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->color->Sortable = TRUE; // Allow sort
		$this->fields['color'] = &$this->color;

		// avatar
		$this->avatar = new cField('inspector', 'inspector', 'x_avatar', 'avatar', '`avatar`', '`avatar`', 205, -1, TRUE, '`avatar`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->avatar->Sortable = FALSE; // Allow sort
		$this->fields['avatar'] = &$this->avatar;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`inspector`";
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
		$this->TableFilter = "`id_sucursal`='".$_SESSION["sucursal"]."'";
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
			if (array_key_exists('login', $rs))
				ew_AddFilter($where, ew_QuotedName('login', $this->DBID) . '=' . ew_QuotedValue($rs['login'], $this->_login->FldDataType, $this->DBID));
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
		return "`login` = '@_login@'";
	}

	// Key filter
	function KeyFilter() {
		$sKeyFilter = $this->SqlKeyFilter();
		if (is_null($this->_login->CurrentValue))
			return "0=1"; // Invalid key
		else
			$sKeyFilter = str_replace("@_login@", ew_AdjustSql($this->_login->CurrentValue, $this->DBID), $sKeyFilter); // Replace key value
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
			return "inspectorlist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "inspectorview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "inspectoredit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "inspectoradd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "inspectorlist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("inspectorview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("inspectorview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "inspectoradd.php?" . $this->UrlParm($parm);
		else
			$url = "inspectoradd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("inspectoredit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("inspectoradd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("inspectordelete.php", $this->UrlParm());
	}

	// Add master url
	function AddMasterUrl($url) {
		return $url;
	}

	function KeyToJson() {
		$json = "";
		$json .= "_login:" . ew_VarToJson($this->_login->CurrentValue, "string", "'");
		return "{" . $json . "}";
	}

	// Add key value to URL
	function KeyUrl($url, $parm = "") {
		$sUrl = $url . "?";
		if ($parm <> "") $sUrl .= $parm . "&";
		if (!is_null($this->_login->CurrentValue)) {
			$sUrl .= "_login=" . urlencode($this->_login->CurrentValue);
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
			if ($isPost && isset($_POST["_login"]))
				$arKeys[] = $_POST["_login"];
			elseif (isset($_GET["_login"]))
				$arKeys[] = $_GET["_login"];
			else
				$arKeys = NULL; // Do not setup

			//return $arKeys; // Do not return yet, so the values will also be checked by the following code
		}

		// Check keys
		$ar = array();
		if (is_array($arKeys)) {
			foreach ($arKeys as $key) {
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
			$this->_login->CurrentValue = $key;
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
		$this->nombre->setDbValue($rs->fields('nombre'));
		$this->apellido->setDbValue($rs->fields('apellido'));
		$this->_login->setDbValue($rs->fields('login'));
		$this->password->setDbValue($rs->fields('password'));
		$this->ci->setDbValue($rs->fields('ci'));
		$this->id_rol->setDbValue($rs->fields('id_rol'));
		$this->id_sucursal->setDbValue($rs->fields('id_sucursal'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->telefono_fijo01->setDbValue($rs->fields('telefono_fijo01'));
		$this->telefono_fijo02->setDbValue($rs->fields('telefono_fijo02'));
		$this->celular->setDbValue($rs->fields('celular'));
		$this->celular2->setDbValue($rs->fields('celular2'));
		$this->direccion->setDbValue($rs->fields('direccion'));
		$this->cargo->setDbValue($rs->fields('cargo'));
		$this->id_institucion->setDbValue($rs->fields('id_institucion'));
		$this->especialidad->setDbValue($rs->fields('especialidad'));
		$this->status->setDbValue($rs->fields('status'));
		$this->color->setDbValue($rs->fields('color'));
		$this->avatar->Upload->DbValue = $rs->fields('avatar');
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// nombre
		// apellido
		// login
		// password
		// ci
		// id_rol
		// id_sucursal
		// email
		// telefono_fijo01
		// telefono_fijo02
		// celular
		// celular2
		// direccion
		// cargo
		// id_institucion
		// especialidad
		// status
		// color
		// avatar

		$this->avatar->CellCssStyle = "white-space: nowrap;";

		// nombre
		$this->nombre->ViewValue = $this->nombre->CurrentValue;
		$this->nombre->ViewCustomAttributes = "";

		// apellido
		$this->apellido->ViewValue = $this->apellido->CurrentValue;
		$this->apellido->ViewCustomAttributes = "";

		// login
		$this->_login->ViewValue = $this->_login->CurrentValue;
		$this->_login->ViewCustomAttributes = "";

		// password
		$this->password->ViewValue = $Language->Phrase("PasswordMask");
		$this->password->ViewCustomAttributes = "";

		// ci
		$this->ci->ViewValue = $this->ci->CurrentValue;
		$this->ci->ViewCustomAttributes = "";

		// id_rol
		if (strval($this->id_rol->CurrentValue) <> "") {
			$sFilterWrk = "`userlevelid`" . ew_SearchString("=", $this->id_rol->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
		$sWhereWrk = "";
		$this->id_rol->LookupFilters = array("dx1" => '`userlevelname`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_rol, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_rol->ViewValue = $this->id_rol->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_rol->ViewValue = $this->id_rol->CurrentValue;
			}
		} else {
			$this->id_rol->ViewValue = NULL;
		}
		$this->id_rol->ViewCustomAttributes = "";

		// id_sucursal
		if (strval($this->id_sucursal->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_sucursal->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
		$sWhereWrk = "";
		$this->id_sucursal->LookupFilters = array("dx1" => '`nombre`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_sucursal, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_sucursal->ViewValue = $this->id_sucursal->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_sucursal->ViewValue = $this->id_sucursal->CurrentValue;
			}
		} else {
			$this->id_sucursal->ViewValue = NULL;
		}
		$this->id_sucursal->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// telefono_fijo01
		$this->telefono_fijo01->ViewValue = $this->telefono_fijo01->CurrentValue;
		$this->telefono_fijo01->ViewCustomAttributes = "";

		// telefono_fijo02
		$this->telefono_fijo02->ViewValue = $this->telefono_fijo02->CurrentValue;
		$this->telefono_fijo02->ViewCustomAttributes = "";

		// celular
		$this->celular->ViewValue = $this->celular->CurrentValue;
		$this->celular->ViewCustomAttributes = "";

		// celular2
		$this->celular2->ViewValue = $this->celular2->CurrentValue;
		$this->celular2->ViewCustomAttributes = "";

		// direccion
		$this->direccion->ViewValue = $this->direccion->CurrentValue;
		$this->direccion->ViewCustomAttributes = "";

		// cargo
		$this->cargo->ViewValue = $this->cargo->CurrentValue;
		$this->cargo->ViewCustomAttributes = "";

		// id_institucion
		$this->id_institucion->ViewValue = $this->id_institucion->CurrentValue;
		$this->id_institucion->ViewCustomAttributes = "";

		// especialidad
		$this->especialidad->ViewValue = $this->especialidad->CurrentValue;
		$this->especialidad->ViewCustomAttributes = "";

		// status
		$this->status->ViewValue = $this->status->CurrentValue;
		$this->status->ViewCustomAttributes = "";

		// color
		$this->color->ViewValue = $this->color->CurrentValue;
		$this->color->ViewCustomAttributes = "";

		// avatar
		if (!ew_Empty($this->avatar->Upload->DbValue)) {
			$this->avatar->ViewValue = "inspector_avatar_bv.php?" . "_login=" . $this->_login->CurrentValue;
			$this->avatar->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->avatar->Upload->DbValue, 0, 11)));
		} else {
			$this->avatar->ViewValue = "";
		}
		$this->avatar->ViewCustomAttributes = "";

		// nombre
		$this->nombre->LinkCustomAttributes = "";
		$this->nombre->HrefValue = "";
		$this->nombre->TooltipValue = "";

		// apellido
		$this->apellido->LinkCustomAttributes = "";
		$this->apellido->HrefValue = "";
		$this->apellido->TooltipValue = "";

		// login
		$this->_login->LinkCustomAttributes = "";
		$this->_login->HrefValue = "";
		$this->_login->TooltipValue = "";

		// password
		$this->password->LinkCustomAttributes = "";
		$this->password->HrefValue = "";
		$this->password->TooltipValue = "";

		// ci
		$this->ci->LinkCustomAttributes = "";
		$this->ci->HrefValue = "";
		$this->ci->TooltipValue = "";

		// id_rol
		$this->id_rol->LinkCustomAttributes = "";
		$this->id_rol->HrefValue = "";
		$this->id_rol->TooltipValue = "";

		// id_sucursal
		$this->id_sucursal->LinkCustomAttributes = "";
		$this->id_sucursal->HrefValue = "";
		$this->id_sucursal->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// telefono_fijo01
		$this->telefono_fijo01->LinkCustomAttributes = "";
		$this->telefono_fijo01->HrefValue = "";
		$this->telefono_fijo01->TooltipValue = "";

		// telefono_fijo02
		$this->telefono_fijo02->LinkCustomAttributes = "";
		$this->telefono_fijo02->HrefValue = "";
		$this->telefono_fijo02->TooltipValue = "";

		// celular
		$this->celular->LinkCustomAttributes = "";
		$this->celular->HrefValue = "";
		$this->celular->TooltipValue = "";

		// celular2
		$this->celular2->LinkCustomAttributes = "";
		$this->celular2->HrefValue = "";
		$this->celular2->TooltipValue = "";

		// direccion
		$this->direccion->LinkCustomAttributes = "";
		$this->direccion->HrefValue = "";
		$this->direccion->TooltipValue = "";

		// cargo
		$this->cargo->LinkCustomAttributes = "";
		$this->cargo->HrefValue = "";
		$this->cargo->TooltipValue = "";

		// id_institucion
		$this->id_institucion->LinkCustomAttributes = "";
		$this->id_institucion->HrefValue = "";
		$this->id_institucion->TooltipValue = "";

		// especialidad
		$this->especialidad->LinkCustomAttributes = "";
		$this->especialidad->HrefValue = "";
		$this->especialidad->TooltipValue = "";

		// status
		$this->status->LinkCustomAttributes = "";
		$this->status->HrefValue = "";
		$this->status->TooltipValue = "";

		// color
		$this->color->LinkCustomAttributes = "";
		$this->color->HrefValue = "";
		$this->color->TooltipValue = "";

		// avatar
		$this->avatar->LinkCustomAttributes = "";
		if (!empty($this->avatar->Upload->DbValue)) {
			$this->avatar->HrefValue = "inspector_avatar_bv.php?_login=" . $this->_login->CurrentValue;
			$this->avatar->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->avatar->HrefValue = ew_FullUrl($this->avatar->HrefValue, "href");
		} else {
			$this->avatar->HrefValue = "";
		}
		$this->avatar->HrefValue2 = "inspector_avatar_bv.php?_login=" . $this->_login->CurrentValue;
		$this->avatar->TooltipValue = "";

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

		// nombre
		$this->nombre->EditAttrs["class"] = "form-control";
		$this->nombre->EditCustomAttributes = "";
		$this->nombre->EditValue = $this->nombre->CurrentValue;
		$this->nombre->PlaceHolder = ew_RemoveHtml($this->nombre->FldTitle());

		// apellido
		$this->apellido->EditAttrs["class"] = "form-control";
		$this->apellido->EditCustomAttributes = "";
		$this->apellido->EditValue = $this->apellido->CurrentValue;
		$this->apellido->PlaceHolder = ew_RemoveHtml($this->apellido->FldTitle());

		// login
		$this->_login->EditAttrs["class"] = "form-control";
		$this->_login->EditCustomAttributes = "";
		$this->_login->EditValue = $this->_login->CurrentValue;
		$this->_login->ViewCustomAttributes = "";

		// password
		$this->password->EditAttrs["class"] = "form-control";
		$this->password->EditCustomAttributes = "";
		$this->password->EditValue = $this->password->CurrentValue;
		$this->password->PlaceHolder = ew_RemoveHtml($this->password->FldTitle());

		// ci
		$this->ci->EditAttrs["class"] = "form-control";
		$this->ci->EditCustomAttributes = "";
		$this->ci->EditValue = $this->ci->CurrentValue;
		$this->ci->PlaceHolder = ew_RemoveHtml($this->ci->FldTitle());

		// id_rol
		$this->id_rol->EditAttrs["class"] = "form-control";
		$this->id_rol->EditCustomAttributes = "";
		if (strval($this->id_rol->CurrentValue) <> "") {
			$sFilterWrk = "`userlevelid`" . ew_SearchString("=", $this->id_rol->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
		$sWhereWrk = "";
		$this->id_rol->LookupFilters = array("dx1" => '`userlevelname`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_rol, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_rol->EditValue = $this->id_rol->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_rol->EditValue = $this->id_rol->CurrentValue;
			}
		} else {
			$this->id_rol->EditValue = NULL;
		}
		$this->id_rol->ViewCustomAttributes = "";

		// id_sucursal
		$this->id_sucursal->EditAttrs["class"] = "form-control";
		$this->id_sucursal->EditCustomAttributes = "";

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldTitle());

		// telefono_fijo01
		$this->telefono_fijo01->EditAttrs["class"] = "form-control";
		$this->telefono_fijo01->EditCustomAttributes = "";
		$this->telefono_fijo01->EditValue = $this->telefono_fijo01->CurrentValue;
		$this->telefono_fijo01->PlaceHolder = ew_RemoveHtml($this->telefono_fijo01->FldTitle());

		// telefono_fijo02
		$this->telefono_fijo02->EditAttrs["class"] = "form-control";
		$this->telefono_fijo02->EditCustomAttributes = "";
		$this->telefono_fijo02->EditValue = $this->telefono_fijo02->CurrentValue;
		$this->telefono_fijo02->PlaceHolder = ew_RemoveHtml($this->telefono_fijo02->FldTitle());

		// celular
		$this->celular->EditAttrs["class"] = "form-control";
		$this->celular->EditCustomAttributes = "";
		$this->celular->EditValue = $this->celular->CurrentValue;
		$this->celular->PlaceHolder = ew_RemoveHtml($this->celular->FldTitle());

		// celular2
		$this->celular2->EditAttrs["class"] = "form-control";
		$this->celular2->EditCustomAttributes = "";
		$this->celular2->EditValue = $this->celular2->CurrentValue;
		$this->celular2->PlaceHolder = ew_RemoveHtml($this->celular2->FldTitle());

		// direccion
		$this->direccion->EditAttrs["class"] = "form-control";
		$this->direccion->EditCustomAttributes = "";
		$this->direccion->EditValue = $this->direccion->CurrentValue;
		$this->direccion->PlaceHolder = ew_RemoveHtml($this->direccion->FldTitle());

		// cargo
		$this->cargo->EditAttrs["class"] = "form-control";
		$this->cargo->EditCustomAttributes = "";
		$this->cargo->EditValue = $this->cargo->CurrentValue;
		$this->cargo->PlaceHolder = ew_RemoveHtml($this->cargo->FldTitle());

		// id_institucion
		$this->id_institucion->EditAttrs["class"] = "form-control";
		$this->id_institucion->EditCustomAttributes = "";
		$this->id_institucion->EditValue = $this->id_institucion->CurrentValue;
		$this->id_institucion->PlaceHolder = ew_RemoveHtml($this->id_institucion->FldTitle());

		// especialidad
		$this->especialidad->EditAttrs["class"] = "form-control";
		$this->especialidad->EditCustomAttributes = "";
		$this->especialidad->EditValue = $this->especialidad->CurrentValue;
		$this->especialidad->PlaceHolder = ew_RemoveHtml($this->especialidad->FldTitle());

		// status
		$this->status->EditAttrs["class"] = "form-control";
		$this->status->EditCustomAttributes = "";
		$this->status->EditValue = $this->status->CurrentValue;
		$this->status->PlaceHolder = ew_RemoveHtml($this->status->FldTitle());

		// color
		$this->color->EditAttrs["class"] = "form-control";
		$this->color->EditCustomAttributes = "";
		$this->color->EditValue = $this->color->CurrentValue;
		$this->color->PlaceHolder = ew_RemoveHtml($this->color->FldTitle());

		// avatar
		$this->avatar->EditAttrs["class"] = "form-control";
		$this->avatar->EditCustomAttributes = "";
		if (!ew_Empty($this->avatar->Upload->DbValue)) {
			$this->avatar->EditValue = "inspector_avatar_bv.php?" . "_login=" . $this->_login->CurrentValue;
			$this->avatar->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->avatar->Upload->DbValue, 0, 11)));
		} else {
			$this->avatar->EditValue = "";
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
					if ($this->nombre->Exportable) $Doc->ExportCaption($this->nombre);
					if ($this->apellido->Exportable) $Doc->ExportCaption($this->apellido);
					if ($this->_login->Exportable) $Doc->ExportCaption($this->_login);
					if ($this->password->Exportable) $Doc->ExportCaption($this->password);
					if ($this->ci->Exportable) $Doc->ExportCaption($this->ci);
					if ($this->id_rol->Exportable) $Doc->ExportCaption($this->id_rol);
					if ($this->id_sucursal->Exportable) $Doc->ExportCaption($this->id_sucursal);
					if ($this->_email->Exportable) $Doc->ExportCaption($this->_email);
					if ($this->telefono_fijo01->Exportable) $Doc->ExportCaption($this->telefono_fijo01);
					if ($this->telefono_fijo02->Exportable) $Doc->ExportCaption($this->telefono_fijo02);
					if ($this->celular->Exportable) $Doc->ExportCaption($this->celular);
					if ($this->celular2->Exportable) $Doc->ExportCaption($this->celular2);
					if ($this->direccion->Exportable) $Doc->ExportCaption($this->direccion);
					if ($this->cargo->Exportable) $Doc->ExportCaption($this->cargo);
					if ($this->id_institucion->Exportable) $Doc->ExportCaption($this->id_institucion);
					if ($this->especialidad->Exportable) $Doc->ExportCaption($this->especialidad);
					if ($this->status->Exportable) $Doc->ExportCaption($this->status);
					if ($this->color->Exportable) $Doc->ExportCaption($this->color);
				} else {
					if ($this->nombre->Exportable) $Doc->ExportCaption($this->nombre);
					if ($this->apellido->Exportable) $Doc->ExportCaption($this->apellido);
					if ($this->_login->Exportable) $Doc->ExportCaption($this->_login);
					if ($this->ci->Exportable) $Doc->ExportCaption($this->ci);
					if ($this->id_rol->Exportable) $Doc->ExportCaption($this->id_rol);
					if ($this->id_sucursal->Exportable) $Doc->ExportCaption($this->id_sucursal);
					if ($this->_email->Exportable) $Doc->ExportCaption($this->_email);
					if ($this->telefono_fijo01->Exportable) $Doc->ExportCaption($this->telefono_fijo01);
					if ($this->telefono_fijo02->Exportable) $Doc->ExportCaption($this->telefono_fijo02);
					if ($this->celular->Exportable) $Doc->ExportCaption($this->celular);
					if ($this->celular2->Exportable) $Doc->ExportCaption($this->celular2);
					if ($this->cargo->Exportable) $Doc->ExportCaption($this->cargo);
					if ($this->id_institucion->Exportable) $Doc->ExportCaption($this->id_institucion);
					if ($this->especialidad->Exportable) $Doc->ExportCaption($this->especialidad);
					if ($this->status->Exportable) $Doc->ExportCaption($this->status);
					if ($this->color->Exportable) $Doc->ExportCaption($this->color);
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
						if ($this->nombre->Exportable) $Doc->ExportField($this->nombre);
						if ($this->apellido->Exportable) $Doc->ExportField($this->apellido);
						if ($this->_login->Exportable) $Doc->ExportField($this->_login);
						if ($this->password->Exportable) $Doc->ExportField($this->password);
						if ($this->ci->Exportable) $Doc->ExportField($this->ci);
						if ($this->id_rol->Exportable) $Doc->ExportField($this->id_rol);
						if ($this->id_sucursal->Exportable) $Doc->ExportField($this->id_sucursal);
						if ($this->_email->Exportable) $Doc->ExportField($this->_email);
						if ($this->telefono_fijo01->Exportable) $Doc->ExportField($this->telefono_fijo01);
						if ($this->telefono_fijo02->Exportable) $Doc->ExportField($this->telefono_fijo02);
						if ($this->celular->Exportable) $Doc->ExportField($this->celular);
						if ($this->celular2->Exportable) $Doc->ExportField($this->celular2);
						if ($this->direccion->Exportable) $Doc->ExportField($this->direccion);
						if ($this->cargo->Exportable) $Doc->ExportField($this->cargo);
						if ($this->id_institucion->Exportable) $Doc->ExportField($this->id_institucion);
						if ($this->especialidad->Exportable) $Doc->ExportField($this->especialidad);
						if ($this->status->Exportable) $Doc->ExportField($this->status);
						if ($this->color->Exportable) $Doc->ExportField($this->color);
					} else {
						if ($this->nombre->Exportable) $Doc->ExportField($this->nombre);
						if ($this->apellido->Exportable) $Doc->ExportField($this->apellido);
						if ($this->_login->Exportable) $Doc->ExportField($this->_login);
						if ($this->ci->Exportable) $Doc->ExportField($this->ci);
						if ($this->id_rol->Exportable) $Doc->ExportField($this->id_rol);
						if ($this->id_sucursal->Exportable) $Doc->ExportField($this->id_sucursal);
						if ($this->_email->Exportable) $Doc->ExportField($this->_email);
						if ($this->telefono_fijo01->Exportable) $Doc->ExportField($this->telefono_fijo01);
						if ($this->telefono_fijo02->Exportable) $Doc->ExportField($this->telefono_fijo02);
						if ($this->celular->Exportable) $Doc->ExportField($this->celular);
						if ($this->celular2->Exportable) $Doc->ExportField($this->celular2);
						if ($this->cargo->Exportable) $Doc->ExportField($this->cargo);
						if ($this->id_institucion->Exportable) $Doc->ExportField($this->id_institucion);
						if ($this->especialidad->Exportable) $Doc->ExportField($this->especialidad);
						if ($this->status->Exportable) $Doc->ExportField($this->status);
						if ($this->color->Exportable) $Doc->ExportField($this->color);
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
