<?php

// Global variable for table object
$viewavaluoinspectorhistorico = NULL;

//
// Table class for viewavaluoinspectorhistorico
//
class cviewavaluoinspectorhistorico extends cTable {
	var $id;
	var $tipoinmueble;
	var $codigoavaluo;
	var $id_solicitud;
	var $id_oficialcredito;
	var $id_inspector;
	var $id_cliente;
	var $is_active;
	var $estado;
	var $estadointerno;
	var $estadopago;
	var $fecha_avaluo;
	var $montoincial;
	var $id_metodopago;
	var $created_at;
	var $DateModified;
	var $DateDeleted;
	var $CreatedBy;
	var $ModifiedBy;
	var $DeletedBy;
	var $comentario;
	var $id_sucursal;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'viewavaluoinspectorhistorico';
		$this->TableName = 'viewavaluoinspectorhistorico';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`viewavaluoinspectorhistorico`";
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
		$this->id = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->Sortable = FALSE; // Allow sort
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// tipoinmueble
		$this->tipoinmueble = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_tipoinmueble', 'tipoinmueble', '`tipoinmueble`', '`tipoinmueble`', 200, -1, FALSE, '`tipoinmueble`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tipoinmueble->Sortable = FALSE; // Allow sort
		$this->tipoinmueble->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tipoinmueble->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->fields['tipoinmueble'] = &$this->tipoinmueble;

		// codigoavaluo
		$this->codigoavaluo = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_codigoavaluo', 'codigoavaluo', '`codigoavaluo`', '`codigoavaluo`', 200, -1, FALSE, '`codigoavaluo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->codigoavaluo->Sortable = TRUE; // Allow sort
		$this->fields['codigoavaluo'] = &$this->codigoavaluo;

		// id_solicitud
		$this->id_solicitud = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_id_solicitud', 'id_solicitud', '`id_solicitud`', '`id_solicitud`', 3, -1, FALSE, '`id_solicitud`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_solicitud->Sortable = TRUE; // Allow sort
		$this->id_solicitud->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_solicitud->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->id_solicitud->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_solicitud'] = &$this->id_solicitud;

		// id_oficialcredito
		$this->id_oficialcredito = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_id_oficialcredito', 'id_oficialcredito', '`id_oficialcredito`', '`id_oficialcredito`', 200, -1, FALSE, '`EV__id_oficialcredito`', TRUE, FALSE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->id_oficialcredito->Sortable = TRUE; // Allow sort
		$this->id_oficialcredito->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_oficialcredito'] = &$this->id_oficialcredito;

		// id_inspector
		$this->id_inspector = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_id_inspector', 'id_inspector', '`id_inspector`', '`id_inspector`', 200, -1, FALSE, '`EV__id_inspector`', TRUE, FALSE, TRUE, 'FORMATTED TEXT', 'TEXT');
		$this->id_inspector->Sortable = TRUE; // Allow sort
		$this->id_inspector->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_inspector'] = &$this->id_inspector;

		// id_cliente
		$this->id_cliente = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_id_cliente', 'id_cliente', '`id_cliente`', '`id_cliente`', 3, -1, FALSE, '`id_cliente`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->id_cliente->Sortable = FALSE; // Allow sort
		$this->id_cliente->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_cliente'] = &$this->id_cliente;

		// is_active
		$this->is_active = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_is_active', 'is_active', '`is_active`', '`is_active`', 16, -1, FALSE, '`is_active`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->is_active->Sortable = TRUE; // Allow sort
		$this->is_active->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->is_active->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->is_active->OptionCount = 2;
		$this->is_active->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['is_active'] = &$this->is_active;

		// estado
		$this->estado = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_estado', 'estado', '`estado`', '`estado`', 16, -1, FALSE, '`estado`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->estado->Sortable = TRUE; // Allow sort
		$this->estado->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->estado->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->estado->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['estado'] = &$this->estado;

		// estadointerno
		$this->estadointerno = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_estadointerno', 'estadointerno', '`estadointerno`', '`estadointerno`', 3, -1, FALSE, '`estadointerno`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->estadointerno->Sortable = TRUE; // Allow sort
		$this->estadointerno->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->estadointerno->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->estadointerno->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['estadointerno'] = &$this->estadointerno;

		// estadopago
		$this->estadopago = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_estadopago', 'estadopago', '`estadopago`', '`estadopago`', 3, -1, FALSE, '`estadopago`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->estadopago->Sortable = TRUE; // Allow sort
		$this->estadopago->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->estadopago->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->estadopago->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['estadopago'] = &$this->estadopago;

		// fecha_avaluo
		$this->fecha_avaluo = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_fecha_avaluo', 'fecha_avaluo', '`fecha_avaluo`', ew_CastDateFieldForLike('`fecha_avaluo`', 10, "DB"), 135, 10, FALSE, '`fecha_avaluo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->fecha_avaluo->Sortable = TRUE; // Allow sort
		$this->fecha_avaluo->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_SEPARATOR"], $Language->Phrase("IncorrectDateMDY"));
		$this->fields['fecha_avaluo'] = &$this->fecha_avaluo;

		// montoincial
		$this->montoincial = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_montoincial', 'montoincial', '`montoincial`', '`montoincial`', 5, -1, FALSE, '`montoincial`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->montoincial->Sortable = FALSE; // Allow sort
		$this->montoincial->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['montoincial'] = &$this->montoincial;

		// id_metodopago
		$this->id_metodopago = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_id_metodopago', 'id_metodopago', '`id_metodopago`', '`id_metodopago`', 3, -1, FALSE, '`id_metodopago`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_metodopago->Sortable = FALSE; // Allow sort
		$this->id_metodopago->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_metodopago->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->id_metodopago->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_metodopago'] = &$this->id_metodopago;

		// created_at
		$this->created_at = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_created_at', 'created_at', '`created_at`', ew_CastDateFieldForLike('`created_at`', 0, "DB"), 135, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = FALSE; // Allow sort
		$this->created_at->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// DateModified
		$this->DateModified = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_DateModified', 'DateModified', '`DateModified`', ew_CastDateFieldForLike('`DateModified`', 0, "DB"), 135, 0, FALSE, '`DateModified`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateModified->Sortable = FALSE; // Allow sort
		$this->DateModified->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['DateModified'] = &$this->DateModified;

		// DateDeleted
		$this->DateDeleted = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_DateDeleted', 'DateDeleted', '`DateDeleted`', ew_CastDateFieldForLike('`DateDeleted`', 0, "DB"), 135, 0, FALSE, '`DateDeleted`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateDeleted->Sortable = FALSE; // Allow sort
		$this->DateDeleted->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['DateDeleted'] = &$this->DateDeleted;

		// CreatedBy
		$this->CreatedBy = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_CreatedBy', 'CreatedBy', '`CreatedBy`', '`CreatedBy`', 200, -1, FALSE, '`CreatedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreatedBy->Sortable = FALSE; // Allow sort
		$this->fields['CreatedBy'] = &$this->CreatedBy;

		// ModifiedBy
		$this->ModifiedBy = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_ModifiedBy', 'ModifiedBy', '`ModifiedBy`', '`ModifiedBy`', 200, -1, FALSE, '`ModifiedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ModifiedBy->Sortable = FALSE; // Allow sort
		$this->fields['ModifiedBy'] = &$this->ModifiedBy;

		// DeletedBy
		$this->DeletedBy = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_DeletedBy', 'DeletedBy', '`DeletedBy`', '`DeletedBy`', 200, -1, FALSE, '`DeletedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeletedBy->Sortable = FALSE; // Allow sort
		$this->fields['DeletedBy'] = &$this->DeletedBy;

		// comentario
		$this->comentario = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_comentario', 'comentario', '`comentario`', '`comentario`', 201, -1, FALSE, '`comentario`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXTAREA');
		$this->comentario->Sortable = TRUE; // Allow sort
		$this->fields['comentario'] = &$this->comentario;

		// id_sucursal
		$this->id_sucursal = new cField('viewavaluoinspectorhistorico', 'viewavaluoinspectorhistorico', 'x_id_sucursal', 'id_sucursal', '`id_sucursal`', '`id_sucursal`', 3, -1, FALSE, '`id_sucursal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->id_sucursal->Sortable = TRUE; // Allow sort
		$this->id_sucursal->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_sucursal'] = &$this->id_sucursal;
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
			$sSortFieldList = ($ofld->FldVirtualExpression <> "") ? $ofld->FldVirtualExpression : $sSortField;
			$this->setSessionOrderByList($sSortFieldList . " " . $sThisSort); // Save to Session
		} else {
			$ofld->setSort("");
		}
	}

	// Session ORDER BY for List page
	function getSessionOrderByList() {
		return @$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST];
	}

	function setSessionOrderByList($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_ORDER_BY_LIST] = $v;
	}

	// Table level SQL
	var $_SqlFrom = "";

	function getSqlFrom() { // From
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`viewavaluoinspectorhistorico`";
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
	var $_SqlSelectList = "";

	function getSqlSelectList() { // Select for List page
		$select = "";
		global $gsLanguage;
		switch ($gsLanguage) {
		case "es":
			$select = "SELECT * FROM (" .
				"SELECT *, (SELECT CONCAT(COALESCE(`nombre`, ''),'" . ew_ValueSeparator(1, $this->id_oficialcredito) . "',COALESCE(`apellido`,'')) FROM `oficialcredito` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`login` = `viewavaluoinspectorhistorico`.`id_oficialcredito` LIMIT 1) AS `EV__id_oficialcredito`, (SELECT CONCAT(COALESCE(`apellido`, ''),'" . ew_ValueSeparator(1, $this->id_inspector) . "',COALESCE(`nombre`,'')) FROM `inspector` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`login` = `viewavaluoinspectorhistorico`.`id_inspector` LIMIT 1) AS `EV__id_inspector` FROM `viewavaluoinspectorhistorico`" .
				") `EW_TMP_TABLE`";
			break;
		default:
			$select = "SELECT * FROM (" .
				"SELECT *, (SELECT CONCAT(COALESCE(`nombre`, ''),'" . ew_ValueSeparator(1, $this->id_oficialcredito) . "',COALESCE(`apellido`,'')) FROM `oficialcredito` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`login` = `viewavaluoinspectorhistorico`.`id_oficialcredito` LIMIT 1) AS `EV__id_oficialcredito`, (SELECT CONCAT(COALESCE(`apellido`, ''),'" . ew_ValueSeparator(1, $this->id_inspector) . "',COALESCE(`nombre`,'')) FROM `inspector` `EW_TMP_LOOKUPTABLE` WHERE `EW_TMP_LOOKUPTABLE`.`login` = `viewavaluoinspectorhistorico`.`id_inspector` LIMIT 1) AS `EV__id_inspector` FROM `viewavaluoinspectorhistorico`" .
				") `EW_TMP_TABLE`";
			break;
		}
		return ($this->_SqlSelectList <> "") ? $this->_SqlSelectList : $select;
	}

	function SqlSelectList() { // For backward compatibility
		return $this->getSqlSelectList();
	}

	function setSqlSelectList($v) {
		$this->_SqlSelectList = $v;
	}
	var $_SqlWhere = "";

	function getSqlWhere() { // Where
		$sWhere = ($this->_SqlWhere <> "") ? $this->_SqlWhere : "";
		$this->TableFilter = "`id_sucursal`='".$_SESSION["sucursal"]."'  and `estadointerno`!=1  "." and `estadointerno`!=2";
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
		if ($this->UseVirtualFields()) {
			$sSelect = $this->getSqlSelectList();
			$sSort = $this->UseSessionForListSQL ? $this->getSessionOrderByList() : "";
		} else {
			$sSelect = $this->getSqlSelect();
			$sSort = $this->UseSessionForListSQL ? $this->getSessionOrderBy() : "";
		}
		return ew_BuildSelectSql($sSelect, $this->getSqlWhere(), $this->getSqlGroupBy(),
			$this->getSqlHaving(), $this->getSqlOrderBy(), $sFilter, $sSort);
	}

	// Get ORDER BY clause
	function GetOrderBy() {
		$sSort = ($this->UseVirtualFields()) ? $this->getSessionOrderByList() : $this->getSessionOrderBy();
		return ew_BuildSelectSql("", "", "", "", $this->getSqlOrderBy(), "", $sSort);
	}

	// Check if virtual fields is used in SQL
	function UseVirtualFields() {
		$sWhere = $this->UseSessionForListSQL ? $this->getSessionWhere() : $this->CurrentFilter;
		$sOrderBy = $this->UseSessionForListSQL ? $this->getSessionOrderByList() : "";
		if ($sWhere <> "")
			$sWhere = " " . str_replace(array("(",")"), array("",""), $sWhere) . " ";
		if ($sOrderBy <> "")
			$sOrderBy = " " . str_replace(array("(",")"), array("",""), $sOrderBy) . " ";
		if ($this->id_oficialcredito->AdvancedSearch->SearchValue <> "" ||
			$this->id_oficialcredito->AdvancedSearch->SearchValue2 <> "" ||
			strpos($sWhere, " " . $this->id_oficialcredito->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if (strpos($sOrderBy, " " . $this->id_oficialcredito->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if ($this->id_inspector->AdvancedSearch->SearchValue <> "" ||
			$this->id_inspector->AdvancedSearch->SearchValue2 <> "" ||
			strpos($sWhere, " " . $this->id_inspector->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		if (strpos($sOrderBy, " " . $this->id_inspector->FldVirtualExpression . " ") !== FALSE)
			return TRUE;
		return FALSE;
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
		if ($this->UseVirtualFields())
			$sql = ew_BuildSelectSql($this->getSqlSelectList(), $this->getSqlWhere(), $groupBy, $having, "", $filter, "");
		else
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
			return "viewavaluoinspectorhistoricolist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "viewavaluoinspectorhistoricoview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "viewavaluoinspectorhistoricoedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "viewavaluoinspectorhistoricoadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "viewavaluoinspectorhistoricolist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("viewavaluoinspectorhistoricoview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("viewavaluoinspectorhistoricoview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "viewavaluoinspectorhistoricoadd.php?" . $this->UrlParm($parm);
		else
			$url = "viewavaluoinspectorhistoricoadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("viewavaluoinspectorhistoricoedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("viewavaluoinspectorhistoricoadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("viewavaluoinspectorhistoricodelete.php", $this->UrlParm());
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
		$this->tipoinmueble->setDbValue($rs->fields('tipoinmueble'));
		$this->codigoavaluo->setDbValue($rs->fields('codigoavaluo'));
		$this->id_solicitud->setDbValue($rs->fields('id_solicitud'));
		$this->id_oficialcredito->setDbValue($rs->fields('id_oficialcredito'));
		$this->id_inspector->setDbValue($rs->fields('id_inspector'));
		$this->id_cliente->setDbValue($rs->fields('id_cliente'));
		$this->is_active->setDbValue($rs->fields('is_active'));
		$this->estado->setDbValue($rs->fields('estado'));
		$this->estadointerno->setDbValue($rs->fields('estadointerno'));
		$this->estadopago->setDbValue($rs->fields('estadopago'));
		$this->fecha_avaluo->setDbValue($rs->fields('fecha_avaluo'));
		$this->montoincial->setDbValue($rs->fields('montoincial'));
		$this->id_metodopago->setDbValue($rs->fields('id_metodopago'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->DateModified->setDbValue($rs->fields('DateModified'));
		$this->DateDeleted->setDbValue($rs->fields('DateDeleted'));
		$this->CreatedBy->setDbValue($rs->fields('CreatedBy'));
		$this->ModifiedBy->setDbValue($rs->fields('ModifiedBy'));
		$this->DeletedBy->setDbValue($rs->fields('DeletedBy'));
		$this->comentario->setDbValue($rs->fields('comentario'));
		$this->id_sucursal->setDbValue($rs->fields('id_sucursal'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// id

		$this->id->CellCssStyle = "white-space: nowrap;";

		// tipoinmueble
		$this->tipoinmueble->CellCssStyle = "white-space: nowrap;";

		// codigoavaluo
		// id_solicitud
		// id_oficialcredito
		// id_inspector
		// id_cliente

		$this->id_cliente->CellCssStyle = "white-space: nowrap;";

		// is_active
		// estado
		// estadointerno
		// estadopago
		// fecha_avaluo
		// montoincial

		$this->montoincial->CellCssStyle = "white-space: nowrap;";

		// id_metodopago
		$this->id_metodopago->CellCssStyle = "white-space: nowrap;";

		// created_at
		$this->created_at->CellCssStyle = "white-space: nowrap;";

		// DateModified
		$this->DateModified->CellCssStyle = "white-space: nowrap;";

		// DateDeleted
		$this->DateDeleted->CellCssStyle = "white-space: nowrap;";

		// CreatedBy
		$this->CreatedBy->CellCssStyle = "white-space: nowrap;";

		// ModifiedBy
		$this->ModifiedBy->CellCssStyle = "white-space: nowrap;";

		// DeletedBy
		$this->DeletedBy->CellCssStyle = "white-space: nowrap;";

		// comentario
		// id_sucursal
		// id

		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// tipoinmueble
		if (strval($this->tipoinmueble->CurrentValue) <> "") {
			$sFilterWrk = "`nombre`" . ew_SearchString("=", $this->tipoinmueble->CurrentValue, EW_DATATYPE_STRING, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipoinmueble->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipoinmueble->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipoinmueble->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tipoinmueble, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->tipoinmueble->ViewValue = $this->tipoinmueble->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->tipoinmueble->ViewValue = $this->tipoinmueble->CurrentValue;
			}
		} else {
			$this->tipoinmueble->ViewValue = NULL;
		}
		$this->tipoinmueble->ViewCustomAttributes = "";

		// codigoavaluo
		$this->codigoavaluo->ViewValue = $this->codigoavaluo->CurrentValue;
		$this->codigoavaluo->CssStyle = "font-weight: bold;";
		$this->codigoavaluo->ViewCustomAttributes = "";

		// id_solicitud
		if (strval($this->id_solicitud->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_solicitud, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$arwrk[3] = $rswrk->fields('Disp3Fld');
				$arwrk[4] = $rswrk->fields('Disp4Fld');
				$this->id_solicitud->ViewValue = $this->id_solicitud->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_solicitud->ViewValue = $this->id_solicitud->CurrentValue;
			}
		} else {
			$this->id_solicitud->ViewValue = NULL;
		}
		$this->id_solicitud->ViewCustomAttributes = "";

		// id_oficialcredito
		if ($this->id_oficialcredito->VirtualValue <> "") {
			$this->id_oficialcredito->ViewValue = $this->id_oficialcredito->VirtualValue;
		} else {
			$this->id_oficialcredito->ViewValue = $this->id_oficialcredito->CurrentValue;
		if (strval($this->id_oficialcredito->CurrentValue) <> "") {
			$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_oficialcredito->CurrentValue, EW_DATATYPE_STRING, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
				$sWhereWrk = "";
				$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
				break;
			case "es":
				$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
				$sWhereWrk = "";
				$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
				break;
			default:
				$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
				$sWhereWrk = "";
				$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_oficialcredito, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->id_oficialcredito->ViewValue = $this->id_oficialcredito->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_oficialcredito->ViewValue = $this->id_oficialcredito->CurrentValue;
			}
		} else {
			$this->id_oficialcredito->ViewValue = NULL;
		}
		}
		$this->id_oficialcredito->ViewCustomAttributes = "";

		// id_inspector
		if ($this->id_inspector->VirtualValue <> "") {
			$this->id_inspector->ViewValue = $this->id_inspector->VirtualValue;
		} else {
			$this->id_inspector->ViewValue = $this->id_inspector->CurrentValue;
		if (strval($this->id_inspector->CurrentValue) <> "") {
			$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_inspector->CurrentValue, EW_DATATYPE_STRING, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
				$sWhereWrk = "";
				$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
				break;
			case "es":
				$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
				$sWhereWrk = "";
				$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
				break;
			default:
				$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
				$sWhereWrk = "";
				$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_inspector, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->id_inspector->ViewValue = $this->id_inspector->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_inspector->ViewValue = $this->id_inspector->CurrentValue;
			}
		} else {
			$this->id_inspector->ViewValue = NULL;
		}
		}
		$this->id_inspector->ViewCustomAttributes = "";

		// id_cliente
		$this->id_cliente->ViewValue = $this->id_cliente->CurrentValue;
		if (strval($this->id_cliente->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_cliente->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
				$sWhereWrk = "";
				$this->id_cliente->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
				$sWhereWrk = "";
				$this->id_cliente->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
				$sWhereWrk = "";
				$this->id_cliente->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_cliente, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->id_cliente->ViewValue = $this->id_cliente->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_cliente->ViewValue = $this->id_cliente->CurrentValue;
			}
		} else {
			$this->id_cliente->ViewValue = NULL;
		}
		$this->id_cliente->ViewCustomAttributes = "";

		// is_active
		if (strval($this->is_active->CurrentValue) <> "") {
			$this->is_active->ViewValue = $this->is_active->OptionCaption($this->is_active->CurrentValue);
		} else {
			$this->is_active->ViewValue = NULL;
		}
		$this->is_active->ViewCustomAttributes = "";

		// estado
		if (strval($this->estado->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->estado->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
				$sWhereWrk = "";
				$this->estado->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
				$sWhereWrk = "";
				$this->estado->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
				$sWhereWrk = "";
				$this->estado->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->estado, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->estado->ViewValue = $this->estado->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->estado->ViewValue = $this->estado->CurrentValue;
			}
		} else {
			$this->estado->ViewValue = NULL;
		}
		$this->estado->ViewCustomAttributes = "";

		// estadointerno
		if (strval($this->estadointerno->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->estadointerno->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->estadointerno->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->estadointerno->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->estadointerno->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->estadointerno, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->estadointerno->ViewValue = $this->estadointerno->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->estadointerno->ViewValue = $this->estadointerno->CurrentValue;
			}
		} else {
			$this->estadointerno->ViewValue = NULL;
		}
		$this->estadointerno->ViewCustomAttributes = "";

		// estadopago
		if (strval($this->estadopago->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->estadopago->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
				$sWhereWrk = "";
				$this->estadopago->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
				$sWhereWrk = "";
				$this->estadopago->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
				$sWhereWrk = "";
				$this->estadopago->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->estadopago, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->estadopago->ViewValue = $this->estadopago->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->estadopago->ViewValue = $this->estadopago->CurrentValue;
			}
		} else {
			$this->estadopago->ViewValue = NULL;
		}
		$this->estadopago->ViewCustomAttributes = "";

		// fecha_avaluo
		$this->fecha_avaluo->ViewValue = $this->fecha_avaluo->CurrentValue;
		$this->fecha_avaluo->ViewValue = ew_FormatDateTime($this->fecha_avaluo->ViewValue, 10);
		$this->fecha_avaluo->ViewCustomAttributes = "";

		// montoincial
		$this->montoincial->ViewValue = $this->montoincial->CurrentValue;
		$this->montoincial->ViewValue = ew_FormatNumber($this->montoincial->ViewValue, 0, -2, -2, -2);
		$this->montoincial->ViewCustomAttributes = "";

		// id_metodopago
		if (strval($this->id_metodopago->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_metodopago->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `metodopago`";
				$sWhereWrk = "";
				$this->id_metodopago->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `metodopago`";
				$sWhereWrk = "";
				$this->id_metodopago->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `metodopago`";
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

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = ew_FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// DateModified
		$this->DateModified->ViewValue = $this->DateModified->CurrentValue;
		$this->DateModified->ViewValue = ew_FormatDateTime($this->DateModified->ViewValue, 0);
		$this->DateModified->ViewCustomAttributes = "";

		// DateDeleted
		$this->DateDeleted->ViewValue = $this->DateDeleted->CurrentValue;
		$this->DateDeleted->ViewValue = ew_FormatDateTime($this->DateDeleted->ViewValue, 0);
		$this->DateDeleted->ViewCustomAttributes = "";

		// CreatedBy
		$this->CreatedBy->ViewValue = $this->CreatedBy->CurrentValue;
		$this->CreatedBy->ViewCustomAttributes = "";

		// ModifiedBy
		$this->ModifiedBy->ViewValue = $this->ModifiedBy->CurrentValue;
		$this->ModifiedBy->ViewCustomAttributes = "";

		// DeletedBy
		$this->DeletedBy->ViewValue = $this->DeletedBy->CurrentValue;
		$this->DeletedBy->ViewCustomAttributes = "";

		// comentario
		$this->comentario->ViewValue = $this->comentario->CurrentValue;
		$this->comentario->ViewCustomAttributes = "";

		// id_sucursal
		$this->id_sucursal->ViewValue = $this->id_sucursal->CurrentValue;
		$this->id_sucursal->ViewCustomAttributes = "";

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// tipoinmueble
		$this->tipoinmueble->LinkCustomAttributes = "";
		$this->tipoinmueble->HrefValue = "";
		$this->tipoinmueble->TooltipValue = "";

		// codigoavaluo
		$this->codigoavaluo->LinkCustomAttributes = "";
		$this->codigoavaluo->HrefValue = "";
		$this->codigoavaluo->TooltipValue = "";

		// id_solicitud
		$this->id_solicitud->LinkCustomAttributes = "";
		$this->id_solicitud->HrefValue = "";
		$this->id_solicitud->TooltipValue = "";

		// id_oficialcredito
		$this->id_oficialcredito->LinkCustomAttributes = "";
		$this->id_oficialcredito->HrefValue = "";
		$this->id_oficialcredito->TooltipValue = "";

		// id_inspector
		$this->id_inspector->LinkCustomAttributes = "";
		$this->id_inspector->HrefValue = "";
		$this->id_inspector->TooltipValue = "";

		// id_cliente
		$this->id_cliente->LinkCustomAttributes = "";
		$this->id_cliente->HrefValue = "";
		$this->id_cliente->TooltipValue = "";

		// is_active
		$this->is_active->LinkCustomAttributes = "";
		$this->is_active->HrefValue = "";
		$this->is_active->TooltipValue = "";

		// estado
		$this->estado->LinkCustomAttributes = "";
		$this->estado->HrefValue = "";
		$this->estado->TooltipValue = "";

		// estadointerno
		$this->estadointerno->LinkCustomAttributes = "";
		$this->estadointerno->HrefValue = "";
		$this->estadointerno->TooltipValue = "";

		// estadopago
		$this->estadopago->LinkCustomAttributes = "";
		$this->estadopago->HrefValue = "";
		$this->estadopago->TooltipValue = "";

		// fecha_avaluo
		$this->fecha_avaluo->LinkCustomAttributes = "";
		$this->fecha_avaluo->HrefValue = "";
		$this->fecha_avaluo->TooltipValue = "";

		// montoincial
		$this->montoincial->LinkCustomAttributes = "";
		$this->montoincial->HrefValue = "";
		$this->montoincial->TooltipValue = "";

		// id_metodopago
		$this->id_metodopago->LinkCustomAttributes = "";
		$this->id_metodopago->HrefValue = "";
		$this->id_metodopago->TooltipValue = "";

		// created_at
		$this->created_at->LinkCustomAttributes = "";
		$this->created_at->HrefValue = "";
		$this->created_at->TooltipValue = "";

		// DateModified
		$this->DateModified->LinkCustomAttributes = "";
		$this->DateModified->HrefValue = "";
		$this->DateModified->TooltipValue = "";

		// DateDeleted
		$this->DateDeleted->LinkCustomAttributes = "";
		$this->DateDeleted->HrefValue = "";
		$this->DateDeleted->TooltipValue = "";

		// CreatedBy
		$this->CreatedBy->LinkCustomAttributes = "";
		$this->CreatedBy->HrefValue = "";
		$this->CreatedBy->TooltipValue = "";

		// ModifiedBy
		$this->ModifiedBy->LinkCustomAttributes = "";
		$this->ModifiedBy->HrefValue = "";
		$this->ModifiedBy->TooltipValue = "";

		// DeletedBy
		$this->DeletedBy->LinkCustomAttributes = "";
		$this->DeletedBy->HrefValue = "";
		$this->DeletedBy->TooltipValue = "";

		// comentario
		$this->comentario->LinkCustomAttributes = "";
		$this->comentario->HrefValue = "";
		$this->comentario->TooltipValue = "";

		// id_sucursal
		$this->id_sucursal->LinkCustomAttributes = "";
		$this->id_sucursal->HrefValue = "";
		$this->id_sucursal->TooltipValue = "";

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

		// tipoinmueble
		$this->tipoinmueble->EditAttrs["class"] = "form-control";
		$this->tipoinmueble->EditCustomAttributes = "";

		// codigoavaluo
		$this->codigoavaluo->EditAttrs["class"] = "form-control";
		$this->codigoavaluo->EditCustomAttributes = "";
		$this->codigoavaluo->EditValue = $this->codigoavaluo->CurrentValue;
		$this->codigoavaluo->CssStyle = "font-weight: bold;";
		$this->codigoavaluo->ViewCustomAttributes = "";

		// id_solicitud
		$this->id_solicitud->EditAttrs["class"] = "form-control";
		$this->id_solicitud->EditCustomAttributes = "";
		if (strval($this->id_solicitud->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_solicitud, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$arwrk[3] = $rswrk->fields('Disp3Fld');
				$arwrk[4] = $rswrk->fields('Disp4Fld');
				$this->id_solicitud->EditValue = $this->id_solicitud->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_solicitud->EditValue = $this->id_solicitud->CurrentValue;
			}
		} else {
			$this->id_solicitud->EditValue = NULL;
		}
		$this->id_solicitud->ViewCustomAttributes = "";

		// id_oficialcredito
		$this->id_oficialcredito->EditAttrs["class"] = "form-control";
		$this->id_oficialcredito->EditCustomAttributes = "";
		if ($this->id_oficialcredito->VirtualValue <> "") {
			$this->id_oficialcredito->EditValue = $this->id_oficialcredito->VirtualValue;
		} else {
			$this->id_oficialcredito->EditValue = $this->id_oficialcredito->CurrentValue;
		if (strval($this->id_oficialcredito->CurrentValue) <> "") {
			$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_oficialcredito->CurrentValue, EW_DATATYPE_STRING, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
				$sWhereWrk = "";
				$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
				break;
			case "es":
				$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
				$sWhereWrk = "";
				$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
				break;
			default:
				$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
				$sWhereWrk = "";
				$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_oficialcredito, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->id_oficialcredito->EditValue = $this->id_oficialcredito->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_oficialcredito->EditValue = $this->id_oficialcredito->CurrentValue;
			}
		} else {
			$this->id_oficialcredito->EditValue = NULL;
		}
		}
		$this->id_oficialcredito->ViewCustomAttributes = "";

		// id_inspector
		$this->id_inspector->EditAttrs["class"] = "form-control";
		$this->id_inspector->EditCustomAttributes = "";
		if ($this->id_inspector->VirtualValue <> "") {
			$this->id_inspector->EditValue = $this->id_inspector->VirtualValue;
		} else {
			$this->id_inspector->EditValue = $this->id_inspector->CurrentValue;
		if (strval($this->id_inspector->CurrentValue) <> "") {
			$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_inspector->CurrentValue, EW_DATATYPE_STRING, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
				$sWhereWrk = "";
				$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
				break;
			case "es":
				$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
				$sWhereWrk = "";
				$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
				break;
			default:
				$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
				$sWhereWrk = "";
				$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_inspector, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->id_inspector->EditValue = $this->id_inspector->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_inspector->EditValue = $this->id_inspector->CurrentValue;
			}
		} else {
			$this->id_inspector->EditValue = NULL;
		}
		}
		$this->id_inspector->ViewCustomAttributes = "";

		// id_cliente
		$this->id_cliente->EditAttrs["class"] = "form-control";
		$this->id_cliente->EditCustomAttributes = "";
		$this->id_cliente->EditValue = $this->id_cliente->CurrentValue;
		if (strval($this->id_cliente->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_cliente->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
				$sWhereWrk = "";
				$this->id_cliente->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
				$sWhereWrk = "";
				$this->id_cliente->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
				$sWhereWrk = "";
				$this->id_cliente->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_cliente, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->id_cliente->EditValue = $this->id_cliente->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_cliente->EditValue = $this->id_cliente->CurrentValue;
			}
		} else {
			$this->id_cliente->EditValue = NULL;
		}
		$this->id_cliente->ViewCustomAttributes = "";

		// is_active
		$this->is_active->EditAttrs["class"] = "form-control";
		$this->is_active->EditCustomAttributes = "";
		$this->is_active->EditValue = $this->is_active->Options(TRUE);

		// estado
		$this->estado->EditAttrs["class"] = "form-control";
		$this->estado->EditCustomAttributes = "";
		if (strval($this->estado->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->estado->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
				$sWhereWrk = "";
				$this->estado->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
				$sWhereWrk = "";
				$this->estado->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
				$sWhereWrk = "";
				$this->estado->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->estado, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->estado->EditValue = $this->estado->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->estado->EditValue = $this->estado->CurrentValue;
			}
		} else {
			$this->estado->EditValue = NULL;
		}
		$this->estado->ViewCustomAttributes = "";

		// estadointerno
		$this->estadointerno->EditAttrs["class"] = "form-control";
		$this->estadointerno->EditCustomAttributes = "";

		// estadopago
		$this->estadopago->EditAttrs["class"] = "form-control";
		$this->estadopago->EditCustomAttributes = "";
		if (strval($this->estadopago->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->estadopago->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
				$sWhereWrk = "";
				$this->estadopago->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
				$sWhereWrk = "";
				$this->estadopago->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
				$sWhereWrk = "";
				$this->estadopago->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->estadopago, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->estadopago->EditValue = $this->estadopago->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->estadopago->EditValue = $this->estadopago->CurrentValue;
			}
		} else {
			$this->estadopago->EditValue = NULL;
		}
		$this->estadopago->ViewCustomAttributes = "";

		// fecha_avaluo
		$this->fecha_avaluo->EditAttrs["class"] = "form-control";
		$this->fecha_avaluo->EditCustomAttributes = "";
		$this->fecha_avaluo->EditValue = $this->fecha_avaluo->CurrentValue;
		$this->fecha_avaluo->EditValue = ew_FormatDateTime($this->fecha_avaluo->EditValue, 10);
		$this->fecha_avaluo->ViewCustomAttributes = "";

		// montoincial
		$this->montoincial->EditAttrs["class"] = "form-control";
		$this->montoincial->EditCustomAttributes = "";
		$this->montoincial->EditValue = $this->montoincial->CurrentValue;
		$this->montoincial->PlaceHolder = ew_RemoveHtml($this->montoincial->FldTitle());
		if (strval($this->montoincial->EditValue) <> "" && is_numeric($this->montoincial->EditValue)) $this->montoincial->EditValue = ew_FormatNumber($this->montoincial->EditValue, -2, -2, -2, -2);

		// id_metodopago
		$this->id_metodopago->EditAttrs["class"] = "form-control";
		$this->id_metodopago->EditCustomAttributes = "";

		// created_at
		$this->created_at->EditAttrs["class"] = "form-control";
		$this->created_at->EditCustomAttributes = "";
		$this->created_at->EditValue = ew_FormatDateTime($this->created_at->CurrentValue, 8);
		$this->created_at->PlaceHolder = ew_RemoveHtml($this->created_at->FldTitle());

		// DateModified
		$this->DateModified->EditAttrs["class"] = "form-control";
		$this->DateModified->EditCustomAttributes = "";
		$this->DateModified->EditValue = ew_FormatDateTime($this->DateModified->CurrentValue, 8);
		$this->DateModified->PlaceHolder = ew_RemoveHtml($this->DateModified->FldTitle());

		// DateDeleted
		$this->DateDeleted->EditAttrs["class"] = "form-control";
		$this->DateDeleted->EditCustomAttributes = "";
		$this->DateDeleted->EditValue = ew_FormatDateTime($this->DateDeleted->CurrentValue, 8);
		$this->DateDeleted->PlaceHolder = ew_RemoveHtml($this->DateDeleted->FldTitle());

		// CreatedBy
		$this->CreatedBy->EditAttrs["class"] = "form-control";
		$this->CreatedBy->EditCustomAttributes = "";
		$this->CreatedBy->EditValue = $this->CreatedBy->CurrentValue;
		$this->CreatedBy->PlaceHolder = ew_RemoveHtml($this->CreatedBy->FldTitle());

		// ModifiedBy
		$this->ModifiedBy->EditAttrs["class"] = "form-control";
		$this->ModifiedBy->EditCustomAttributes = "";
		$this->ModifiedBy->EditValue = $this->ModifiedBy->CurrentValue;
		$this->ModifiedBy->PlaceHolder = ew_RemoveHtml($this->ModifiedBy->FldTitle());

		// DeletedBy
		$this->DeletedBy->EditAttrs["class"] = "form-control";
		$this->DeletedBy->EditCustomAttributes = "";
		$this->DeletedBy->EditValue = $this->DeletedBy->CurrentValue;
		$this->DeletedBy->PlaceHolder = ew_RemoveHtml($this->DeletedBy->FldTitle());

		// comentario
		$this->comentario->EditAttrs["class"] = "form-control";
		$this->comentario->EditCustomAttributes = "";
		$this->comentario->EditValue = $this->comentario->CurrentValue;
		$this->comentario->PlaceHolder = ew_RemoveHtml($this->comentario->FldTitle());

		// id_sucursal
		$this->id_sucursal->EditAttrs["class"] = "form-control";
		$this->id_sucursal->EditCustomAttributes = "";

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
					if ($this->codigoavaluo->Exportable) $Doc->ExportCaption($this->codigoavaluo);
					if ($this->id_solicitud->Exportable) $Doc->ExportCaption($this->id_solicitud);
					if ($this->id_oficialcredito->Exportable) $Doc->ExportCaption($this->id_oficialcredito);
					if ($this->id_inspector->Exportable) $Doc->ExportCaption($this->id_inspector);
					if ($this->is_active->Exportable) $Doc->ExportCaption($this->is_active);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->estadointerno->Exportable) $Doc->ExportCaption($this->estadointerno);
					if ($this->estadopago->Exportable) $Doc->ExportCaption($this->estadopago);
					if ($this->fecha_avaluo->Exportable) $Doc->ExportCaption($this->fecha_avaluo);
					if ($this->comentario->Exportable) $Doc->ExportCaption($this->comentario);
					if ($this->id_sucursal->Exportable) $Doc->ExportCaption($this->id_sucursal);
				} else {
					if ($this->codigoavaluo->Exportable) $Doc->ExportCaption($this->codigoavaluo);
					if ($this->id_solicitud->Exportable) $Doc->ExportCaption($this->id_solicitud);
					if ($this->id_oficialcredito->Exportable) $Doc->ExportCaption($this->id_oficialcredito);
					if ($this->id_inspector->Exportable) $Doc->ExportCaption($this->id_inspector);
					if ($this->is_active->Exportable) $Doc->ExportCaption($this->is_active);
					if ($this->estado->Exportable) $Doc->ExportCaption($this->estado);
					if ($this->estadointerno->Exportable) $Doc->ExportCaption($this->estadointerno);
					if ($this->estadopago->Exportable) $Doc->ExportCaption($this->estadopago);
					if ($this->fecha_avaluo->Exportable) $Doc->ExportCaption($this->fecha_avaluo);
					if ($this->id_sucursal->Exportable) $Doc->ExportCaption($this->id_sucursal);
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
						if ($this->codigoavaluo->Exportable) $Doc->ExportField($this->codigoavaluo);
						if ($this->id_solicitud->Exportable) $Doc->ExportField($this->id_solicitud);
						if ($this->id_oficialcredito->Exportable) $Doc->ExportField($this->id_oficialcredito);
						if ($this->id_inspector->Exportable) $Doc->ExportField($this->id_inspector);
						if ($this->is_active->Exportable) $Doc->ExportField($this->is_active);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->estadointerno->Exportable) $Doc->ExportField($this->estadointerno);
						if ($this->estadopago->Exportable) $Doc->ExportField($this->estadopago);
						if ($this->fecha_avaluo->Exportable) $Doc->ExportField($this->fecha_avaluo);
						if ($this->comentario->Exportable) $Doc->ExportField($this->comentario);
						if ($this->id_sucursal->Exportable) $Doc->ExportField($this->id_sucursal);
					} else {
						if ($this->codigoavaluo->Exportable) $Doc->ExportField($this->codigoavaluo);
						if ($this->id_solicitud->Exportable) $Doc->ExportField($this->id_solicitud);
						if ($this->id_oficialcredito->Exportable) $Doc->ExportField($this->id_oficialcredito);
						if ($this->id_inspector->Exportable) $Doc->ExportField($this->id_inspector);
						if ($this->is_active->Exportable) $Doc->ExportField($this->is_active);
						if ($this->estado->Exportable) $Doc->ExportField($this->estado);
						if ($this->estadointerno->Exportable) $Doc->ExportField($this->estadointerno);
						if ($this->estadopago->Exportable) $Doc->ExportField($this->estadopago);
						if ($this->fecha_avaluo->Exportable) $Doc->ExportField($this->fecha_avaluo);
						if ($this->id_sucursal->Exportable) $Doc->ExportField($this->id_sucursal);
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

	// Send email after update success
	function SendEmailOnEdit(&$rsold, &$rsnew) {
		global $Language;
		$sTable = 'viewavaluoinspectorhistorico';
		$sSubject = $sTable . " ". $Language->Phrase("RecordUpdated");
		$sAction = $Language->Phrase("ActionUpdated");

		// Get key value
		$sKey = "";
		if ($sKey <> "") $sKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
		$sKey .= $rsold['id'];
		$Email = new cEmail();
		$Email->Load(EW_EMAIL_NOTIFY_TEMPLATE);
		$Email->ReplaceSender(EW_SENDER_EMAIL); // Replace Sender
		$Email->ReplaceRecipient(EW_RECIPIENT_EMAIL); // Replace Recipient
		$Email->ReplaceSubject($sSubject); // Replace Subject
		$Email->ReplaceContent("<!--table-->", $sTable);
		$Email->ReplaceContent("<!--key-->", $sKey);
		$Email->ReplaceContent("<!--action-->", $sAction);
		$Args = array();
		$Args["rsold"] = &$rsold;
		$Args["rsnew"] = &$rsnew;
		$bEmailSent = FALSE;
		if ($this->Email_Sending($Email, $Args))
			$bEmailSent = $Email->Send();

		// Send email failed
		if (!$bEmailSent)
			$this->setFailureMessage($Email->SendErrDescription);
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

		if ($rsold['estadointerno']!=$rsnew['estadointerno']){
		switch ($rsold['estadointerno']) {
		case 1:
	   	case 2:
				$this->setFailureMessage("El Avaluo ".$rsnew["codigoavaluo"]."ya no puede ser actualizado porque esta en progreso");
				return FALSE;
				break;
		case 3:
		case 4:
		case 5:
			   	   $sql_comentarios="INSERT INTO `comentariosavaluo`(`descripcion`, `id_avaluo`) VALUES ('".$rsnew['comentario']."','".$rsold['id']."')";
				   	$sql_historico="INSERT INTO `historico`(`proceso`, `responsable`, `salida`, `comentario`, `id_solicitud`, `id_avaluo`) VALUES ('".$rsnew['estadointerno']."','".$_SESSION["usr"]."',NOW(),'".$rsnew["comentario"]."','".$rsold["id_solicitud"]."','".$rsold["id"]."')";
					$MyResult4 = ew_Execute($sql_comentarios);
					$MyResult5 = ew_Execute($sql_historico);
					break;
		case 6:
		case 7:
		case 8:
		   		$this->setFailureMessage("El Avaluo ".$rsnew["codigoavaluo"]."no puede ser actualizado porque esta en progreso revision");
				return FALSE;
				break;
		}
		}else
		{
		return FALSE;
		}
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
