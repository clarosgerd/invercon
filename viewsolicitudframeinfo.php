<?php

// Global variable for table object
$viewsolicitudframe = NULL;

//
// Table class for viewsolicitudframe
//
class cviewsolicitudframe extends cTable {
	var $id;
	var $name;
	var $lastname;
	var $_email;
	var $address;
	var $nombre_contacto;
	var $email_contacto;
	var $latitud;
	var $longitud;
	var $phone;
	var $cell;
	var $id_sucursal;
	var $tipoinmueble;
	var $id_ciudad_inmueble;
	var $id_provincia_inmueble;
	var $imagen_inmueble01;
	var $imagen_inmueble02;
	var $imagen_inmueble03;
	var $imagen_inmueble04;
	var $imagen_inmueble05;
	var $imagen_inmueble06;
	var $imagen_inmueble07;
	var $imagen_inmueble08;
	var $tipovehiculo;
	var $id_ciudad_vehiculo;
	var $id_provincia_vehiculo;
	var $imagen_vehiculo01;
	var $imagen_vehiculo02;
	var $imagen_vehiculo03;
	var $imagen_vehiculo04;
	var $imagen_vehiculo05;
	var $imagen_vehiculo06;
	var $imagen_vehiculo07;
	var $imagen_vehiculo08;
	var $tipomaquinaria;
	var $id_ciudad_maquinaria;
	var $id_provincia_maquinaria;
	var $imagen_maquinaria01;
	var $imagen_maquinaria02;
	var $imagen_maquinaria03;
	var $imagen_maquinaria04;
	var $imagen_maquinaria05;
	var $imagen_maquinaria06;
	var $imagen_maquinaria07;
	var $imagen_maquinaria08;
	var $tipomercaderia;
	var $imagen_mercaderia01;
	var $documento_mercaderia;
	var $tipoespecial;
	var $imagen_tipoespecial01;
	var $is_active;
	var $documentos;
	var $created_at;
	var $DateModified;
	var $DateDeleted;
	var $CreatedBy;
	var $ModifiedBy;
	var $DeletedBy;

	//
	// Table class constructor
	//
	function __construct() {
		global $Language;

		// Language object
		if (!isset($Language)) $Language = new cLanguage();
		$this->TableVar = 'viewsolicitudframe';
		$this->TableName = 'viewsolicitudframe';
		$this->TableType = 'VIEW';

		// Update Table
		$this->UpdateTable = "`viewsolicitudframe`";
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
		$this->id = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_id', 'id', '`id`', '`id`', 3, -1, FALSE, '`id`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'NO');
		$this->id->Sortable = TRUE; // Allow sort
		$this->id->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id'] = &$this->id;

		// name
		$this->name = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_name', 'name', '`name`', '`name`', 200, -1, FALSE, '`name`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->name->Sortable = TRUE; // Allow sort
		$this->fields['name'] = &$this->name;

		// lastname
		$this->lastname = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_lastname', 'lastname', '`lastname`', '`lastname`', 200, -1, FALSE, '`lastname`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->lastname->Sortable = TRUE; // Allow sort
		$this->fields['lastname'] = &$this->lastname;

		// email
		$this->_email = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x__email', 'email', '`email`', '`email`', 200, -1, FALSE, '`email`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->_email->Sortable = TRUE; // Allow sort
		$this->_email->FldDefaultErrMsg = $Language->Phrase("IncorrectEmail");
		$this->fields['email'] = &$this->_email;

		// address
		$this->address = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_address', 'address', '`address`', '`address`', 200, -1, FALSE, '`address`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->address->Sortable = TRUE; // Allow sort
		$this->fields['address'] = &$this->address;

		// nombre_contacto
		$this->nombre_contacto = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_nombre_contacto', 'nombre_contacto', '`nombre_contacto`', '`nombre_contacto`', 200, -1, FALSE, '`nombre_contacto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->nombre_contacto->Sortable = FALSE; // Allow sort
		$this->fields['nombre_contacto'] = &$this->nombre_contacto;

		// email_contacto
		$this->email_contacto = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_email_contacto', 'email_contacto', '`email_contacto`', '`email_contacto`', 200, -1, FALSE, '`email_contacto`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->email_contacto->Sortable = TRUE; // Allow sort
		$this->fields['email_contacto'] = &$this->email_contacto;

		// latitud
		$this->latitud = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_latitud', 'latitud', '`latitud`', '`latitud`', 5, -1, FALSE, '`latitud`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->latitud->Sortable = FALSE; // Allow sort
		$this->latitud->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['latitud'] = &$this->latitud;

		// longitud
		$this->longitud = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_longitud', 'longitud', '`longitud`', '`longitud`', 5, -1, FALSE, '`longitud`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->longitud->Sortable = FALSE; // Allow sort
		$this->longitud->FldDefaultErrMsg = $Language->Phrase("IncorrectFloat");
		$this->fields['longitud'] = &$this->longitud;

		// phone
		$this->phone = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_phone', 'phone', '`phone`', '`phone`', 200, -1, FALSE, '`phone`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->phone->Sortable = TRUE; // Allow sort
		$this->fields['phone'] = &$this->phone;

		// cell
		$this->cell = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_cell', 'cell', '`cell`', '`cell`', 200, -1, FALSE, '`cell`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->cell->Sortable = TRUE; // Allow sort
		$this->fields['cell'] = &$this->cell;

		// id_sucursal
		$this->id_sucursal = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_id_sucursal', 'id_sucursal', '`id_sucursal`', '`id_sucursal`', 3, -1, FALSE, '`id_sucursal`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'HIDDEN');
		$this->id_sucursal->Sortable = TRUE; // Allow sort
		$this->id_sucursal->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_sucursal'] = &$this->id_sucursal;

		// tipoinmueble
		$this->tipoinmueble = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_tipoinmueble', 'tipoinmueble', '`tipoinmueble`', '`tipoinmueble`', 200, -1, FALSE, '`tipoinmueble`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tipoinmueble->Sortable = FALSE; // Allow sort
		$this->tipoinmueble->FldSelectMultiple = TRUE; // Multiple select
		$this->fields['tipoinmueble'] = &$this->tipoinmueble;

		// id_ciudad_inmueble
		$this->id_ciudad_inmueble = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_id_ciudad_inmueble', 'id_ciudad_inmueble', '`id_ciudad_inmueble`', '`id_ciudad_inmueble`', 3, -1, FALSE, '`id_ciudad_inmueble`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_ciudad_inmueble->Sortable = FALSE; // Allow sort
		$this->id_ciudad_inmueble->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_ciudad_inmueble->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->id_ciudad_inmueble->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_ciudad_inmueble'] = &$this->id_ciudad_inmueble;

		// id_provincia_inmueble
		$this->id_provincia_inmueble = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_id_provincia_inmueble', 'id_provincia_inmueble', '`id_provincia_inmueble`', '`id_provincia_inmueble`', 3, -1, FALSE, '`id_provincia_inmueble`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_provincia_inmueble->Sortable = FALSE; // Allow sort
		$this->id_provincia_inmueble->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_provincia_inmueble->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->id_provincia_inmueble->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_provincia_inmueble'] = &$this->id_provincia_inmueble;

		// imagen_inmueble01
		$this->imagen_inmueble01 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_inmueble01', 'imagen_inmueble01', '`imagen_inmueble01`', '`imagen_inmueble01`', 205, -1, TRUE, '`imagen_inmueble01`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_inmueble01->Sortable = FALSE; // Allow sort
		$this->fields['imagen_inmueble01'] = &$this->imagen_inmueble01;

		// imagen_inmueble02
		$this->imagen_inmueble02 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_inmueble02', 'imagen_inmueble02', '`imagen_inmueble02`', '`imagen_inmueble02`', 205, -1, TRUE, '`imagen_inmueble02`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_inmueble02->Sortable = FALSE; // Allow sort
		$this->fields['imagen_inmueble02'] = &$this->imagen_inmueble02;

		// imagen_inmueble03
		$this->imagen_inmueble03 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_inmueble03', 'imagen_inmueble03', '`imagen_inmueble03`', '`imagen_inmueble03`', 205, -1, TRUE, '`imagen_inmueble03`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_inmueble03->Sortable = FALSE; // Allow sort
		$this->fields['imagen_inmueble03'] = &$this->imagen_inmueble03;

		// imagen_inmueble04
		$this->imagen_inmueble04 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_inmueble04', 'imagen_inmueble04', '`imagen_inmueble04`', '`imagen_inmueble04`', 205, -1, TRUE, '`imagen_inmueble04`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_inmueble04->Sortable = FALSE; // Allow sort
		$this->fields['imagen_inmueble04'] = &$this->imagen_inmueble04;

		// imagen_inmueble05
		$this->imagen_inmueble05 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_inmueble05', 'imagen_inmueble05', '`imagen_inmueble05`', '`imagen_inmueble05`', 205, -1, TRUE, '`imagen_inmueble05`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_inmueble05->Sortable = FALSE; // Allow sort
		$this->fields['imagen_inmueble05'] = &$this->imagen_inmueble05;

		// imagen_inmueble06
		$this->imagen_inmueble06 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_inmueble06', 'imagen_inmueble06', '`imagen_inmueble06`', '`imagen_inmueble06`', 205, -1, TRUE, '`imagen_inmueble06`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_inmueble06->Sortable = FALSE; // Allow sort
		$this->fields['imagen_inmueble06'] = &$this->imagen_inmueble06;

		// imagen_inmueble07
		$this->imagen_inmueble07 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_inmueble07', 'imagen_inmueble07', '`imagen_inmueble07`', '`imagen_inmueble07`', 205, -1, TRUE, '`imagen_inmueble07`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_inmueble07->Sortable = FALSE; // Allow sort
		$this->fields['imagen_inmueble07'] = &$this->imagen_inmueble07;

		// imagen_inmueble08
		$this->imagen_inmueble08 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_inmueble08', 'imagen_inmueble08', '`imagen_inmueble08`', '`imagen_inmueble08`', 205, -1, TRUE, '`imagen_inmueble08`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_inmueble08->Sortable = FALSE; // Allow sort
		$this->fields['imagen_inmueble08'] = &$this->imagen_inmueble08;

		// tipovehiculo
		$this->tipovehiculo = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_tipovehiculo', 'tipovehiculo', '`tipovehiculo`', '`tipovehiculo`', 200, -1, FALSE, '`tipovehiculo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tipovehiculo->Sortable = FALSE; // Allow sort
		$this->tipovehiculo->FldSelectMultiple = TRUE; // Multiple select
		$this->fields['tipovehiculo'] = &$this->tipovehiculo;

		// id_ciudad_vehiculo
		$this->id_ciudad_vehiculo = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_id_ciudad_vehiculo', 'id_ciudad_vehiculo', '`id_ciudad_vehiculo`', '`id_ciudad_vehiculo`', 3, -1, FALSE, '`id_ciudad_vehiculo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_ciudad_vehiculo->Sortable = FALSE; // Allow sort
		$this->id_ciudad_vehiculo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_ciudad_vehiculo->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->id_ciudad_vehiculo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_ciudad_vehiculo'] = &$this->id_ciudad_vehiculo;

		// id_provincia_vehiculo
		$this->id_provincia_vehiculo = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_id_provincia_vehiculo', 'id_provincia_vehiculo', '`id_provincia_vehiculo`', '`id_provincia_vehiculo`', 3, -1, FALSE, '`id_provincia_vehiculo`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_provincia_vehiculo->Sortable = FALSE; // Allow sort
		$this->id_provincia_vehiculo->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_provincia_vehiculo->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->id_provincia_vehiculo->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_provincia_vehiculo'] = &$this->id_provincia_vehiculo;

		// imagen_vehiculo01
		$this->imagen_vehiculo01 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_vehiculo01', 'imagen_vehiculo01', '`imagen_vehiculo01`', '`imagen_vehiculo01`', 205, -1, TRUE, '`imagen_vehiculo01`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_vehiculo01->Sortable = FALSE; // Allow sort
		$this->fields['imagen_vehiculo01'] = &$this->imagen_vehiculo01;

		// imagen_vehiculo02
		$this->imagen_vehiculo02 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_vehiculo02', 'imagen_vehiculo02', '`imagen_vehiculo02`', '`imagen_vehiculo02`', 205, -1, TRUE, '`imagen_vehiculo02`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_vehiculo02->Sortable = FALSE; // Allow sort
		$this->fields['imagen_vehiculo02'] = &$this->imagen_vehiculo02;

		// imagen_vehiculo03
		$this->imagen_vehiculo03 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_vehiculo03', 'imagen_vehiculo03', '`imagen_vehiculo03`', '`imagen_vehiculo03`', 205, -1, TRUE, '`imagen_vehiculo03`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_vehiculo03->Sortable = FALSE; // Allow sort
		$this->fields['imagen_vehiculo03'] = &$this->imagen_vehiculo03;

		// imagen_vehiculo04
		$this->imagen_vehiculo04 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_vehiculo04', 'imagen_vehiculo04', '`imagen_vehiculo04`', '`imagen_vehiculo04`', 205, -1, TRUE, '`imagen_vehiculo04`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_vehiculo04->Sortable = FALSE; // Allow sort
		$this->fields['imagen_vehiculo04'] = &$this->imagen_vehiculo04;

		// imagen_vehiculo05
		$this->imagen_vehiculo05 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_vehiculo05', 'imagen_vehiculo05', '`imagen_vehiculo05`', '`imagen_vehiculo05`', 205, -1, TRUE, '`imagen_vehiculo05`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_vehiculo05->Sortable = FALSE; // Allow sort
		$this->fields['imagen_vehiculo05'] = &$this->imagen_vehiculo05;

		// imagen_vehiculo06
		$this->imagen_vehiculo06 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_vehiculo06', 'imagen_vehiculo06', '`imagen_vehiculo06`', '`imagen_vehiculo06`', 205, -1, TRUE, '`imagen_vehiculo06`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_vehiculo06->Sortable = FALSE; // Allow sort
		$this->fields['imagen_vehiculo06'] = &$this->imagen_vehiculo06;

		// imagen_vehiculo07
		$this->imagen_vehiculo07 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_vehiculo07', 'imagen_vehiculo07', '`imagen_vehiculo07`', '`imagen_vehiculo07`', 205, -1, TRUE, '`imagen_vehiculo07`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_vehiculo07->Sortable = FALSE; // Allow sort
		$this->fields['imagen_vehiculo07'] = &$this->imagen_vehiculo07;

		// imagen_vehiculo08
		$this->imagen_vehiculo08 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_vehiculo08', 'imagen_vehiculo08', '`imagen_vehiculo08`', '`imagen_vehiculo08`', 205, -1, TRUE, '`imagen_vehiculo08`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_vehiculo08->Sortable = FALSE; // Allow sort
		$this->fields['imagen_vehiculo08'] = &$this->imagen_vehiculo08;

		// tipomaquinaria
		$this->tipomaquinaria = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_tipomaquinaria', 'tipomaquinaria', '`tipomaquinaria`', '`tipomaquinaria`', 200, -1, FALSE, '`tipomaquinaria`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tipomaquinaria->Sortable = FALSE; // Allow sort
		$this->tipomaquinaria->FldSelectMultiple = TRUE; // Multiple select
		$this->fields['tipomaquinaria'] = &$this->tipomaquinaria;

		// id_ciudad_maquinaria
		$this->id_ciudad_maquinaria = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_id_ciudad_maquinaria', 'id_ciudad_maquinaria', '`id_ciudad_maquinaria`', '`id_ciudad_maquinaria`', 3, -1, FALSE, '`id_ciudad_maquinaria`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_ciudad_maquinaria->Sortable = FALSE; // Allow sort
		$this->id_ciudad_maquinaria->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_ciudad_maquinaria->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->id_ciudad_maquinaria->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_ciudad_maquinaria'] = &$this->id_ciudad_maquinaria;

		// id_provincia_maquinaria
		$this->id_provincia_maquinaria = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_id_provincia_maquinaria', 'id_provincia_maquinaria', '`id_provincia_maquinaria`', '`id_provincia_maquinaria`', 3, -1, FALSE, '`id_provincia_maquinaria`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->id_provincia_maquinaria->Sortable = FALSE; // Allow sort
		$this->id_provincia_maquinaria->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->id_provincia_maquinaria->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->id_provincia_maquinaria->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['id_provincia_maquinaria'] = &$this->id_provincia_maquinaria;

		// imagen_maquinaria01
		$this->imagen_maquinaria01 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_maquinaria01', 'imagen_maquinaria01', '`imagen_maquinaria01`', '`imagen_maquinaria01`', 205, -1, TRUE, '`imagen_maquinaria01`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_maquinaria01->Sortable = FALSE; // Allow sort
		$this->fields['imagen_maquinaria01'] = &$this->imagen_maquinaria01;

		// imagen_maquinaria02
		$this->imagen_maquinaria02 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_maquinaria02', 'imagen_maquinaria02', '`imagen_maquinaria02`', '`imagen_maquinaria02`', 205, -1, TRUE, '`imagen_maquinaria02`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_maquinaria02->Sortable = FALSE; // Allow sort
		$this->fields['imagen_maquinaria02'] = &$this->imagen_maquinaria02;

		// imagen_maquinaria03
		$this->imagen_maquinaria03 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_maquinaria03', 'imagen_maquinaria03', '`imagen_maquinaria03`', '`imagen_maquinaria03`', 205, -1, TRUE, '`imagen_maquinaria03`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_maquinaria03->Sortable = FALSE; // Allow sort
		$this->fields['imagen_maquinaria03'] = &$this->imagen_maquinaria03;

		// imagen_maquinaria04
		$this->imagen_maquinaria04 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_maquinaria04', 'imagen_maquinaria04', '`imagen_maquinaria04`', '`imagen_maquinaria04`', 205, -1, TRUE, '`imagen_maquinaria04`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_maquinaria04->Sortable = FALSE; // Allow sort
		$this->fields['imagen_maquinaria04'] = &$this->imagen_maquinaria04;

		// imagen_maquinaria05
		$this->imagen_maquinaria05 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_maquinaria05', 'imagen_maquinaria05', '`imagen_maquinaria05`', '`imagen_maquinaria05`', 205, -1, TRUE, '`imagen_maquinaria05`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_maquinaria05->Sortable = FALSE; // Allow sort
		$this->fields['imagen_maquinaria05'] = &$this->imagen_maquinaria05;

		// imagen_maquinaria06
		$this->imagen_maquinaria06 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_maquinaria06', 'imagen_maquinaria06', '`imagen_maquinaria06`', '`imagen_maquinaria06`', 205, -1, TRUE, '`imagen_maquinaria06`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_maquinaria06->Sortable = FALSE; // Allow sort
		$this->fields['imagen_maquinaria06'] = &$this->imagen_maquinaria06;

		// imagen_maquinaria07
		$this->imagen_maquinaria07 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_maquinaria07', 'imagen_maquinaria07', '`imagen_maquinaria07`', '`imagen_maquinaria07`', 205, -1, TRUE, '`imagen_maquinaria07`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_maquinaria07->Sortable = FALSE; // Allow sort
		$this->fields['imagen_maquinaria07'] = &$this->imagen_maquinaria07;

		// imagen_maquinaria08
		$this->imagen_maquinaria08 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_maquinaria08', 'imagen_maquinaria08', '`imagen_maquinaria08`', '`imagen_maquinaria08`', 205, -1, TRUE, '`imagen_maquinaria08`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_maquinaria08->Sortable = FALSE; // Allow sort
		$this->fields['imagen_maquinaria08'] = &$this->imagen_maquinaria08;

		// tipomercaderia
		$this->tipomercaderia = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_tipomercaderia', 'tipomercaderia', '`tipomercaderia`', '`tipomercaderia`', 200, -1, FALSE, '`tipomercaderia`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tipomercaderia->Sortable = TRUE; // Allow sort
		$this->tipomercaderia->FldSelectMultiple = TRUE; // Multiple select
		$this->tipomercaderia->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tipomercaderia'] = &$this->tipomercaderia;

		// imagen_mercaderia01
		$this->imagen_mercaderia01 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_mercaderia01', 'imagen_mercaderia01', '`imagen_mercaderia01`', '`imagen_mercaderia01`', 205, -1, TRUE, '`imagen_mercaderia01`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_mercaderia01->Sortable = FALSE; // Allow sort
		$this->fields['imagen_mercaderia01'] = &$this->imagen_mercaderia01;

		// documento_mercaderia
		$this->documento_mercaderia = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_documento_mercaderia', 'documento_mercaderia', '`documento_mercaderia`', '`documento_mercaderia`', 200, -1, FALSE, '`documento_mercaderia`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->documento_mercaderia->Sortable = FALSE; // Allow sort
		$this->fields['documento_mercaderia'] = &$this->documento_mercaderia;

		// tipoespecial
		$this->tipoespecial = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_tipoespecial', 'tipoespecial', '`tipoespecial`', '`tipoespecial`', 200, -1, FALSE, '`tipoespecial`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'SELECT');
		$this->tipoespecial->Sortable = TRUE; // Allow sort
		$this->tipoespecial->UsePleaseSelect = TRUE; // Use PleaseSelect by default
		$this->tipoespecial->PleaseSelectText = $Language->Phrase("PleaseSelect"); // PleaseSelect text
		$this->tipoespecial->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['tipoespecial'] = &$this->tipoespecial;

		// imagen_tipoespecial01
		$this->imagen_tipoespecial01 = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_imagen_tipoespecial01', 'imagen_tipoespecial01', '`imagen_tipoespecial01`', '`imagen_tipoespecial01`', 205, -1, TRUE, '`imagen_tipoespecial01`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'FILE');
		$this->imagen_tipoespecial01->Sortable = FALSE; // Allow sort
		$this->fields['imagen_tipoespecial01'] = &$this->imagen_tipoespecial01;

		// is_active
		$this->is_active = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_is_active', 'is_active', '`is_active`', '`is_active`', 16, -1, FALSE, '`is_active`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->is_active->Sortable = FALSE; // Allow sort
		$this->is_active->FldDefaultErrMsg = $Language->Phrase("IncorrectInteger");
		$this->fields['is_active'] = &$this->is_active;

		// documentos
		$this->documentos = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_documentos', 'documentos', '`documentos`', '`documentos`', 200, -1, FALSE, '`documentos`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->documentos->Sortable = TRUE; // Allow sort
		$this->fields['documentos'] = &$this->documentos;

		// created_at
		$this->created_at = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_created_at', 'created_at', '`created_at`', ew_CastDateFieldForLike('`created_at`', 0, "DB"), 135, 0, FALSE, '`created_at`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->created_at->Sortable = FALSE; // Allow sort
		$this->created_at->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['created_at'] = &$this->created_at;

		// DateModified
		$this->DateModified = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_DateModified', 'DateModified', '`DateModified`', ew_CastDateFieldForLike('`DateModified`', 0, "DB"), 135, 0, FALSE, '`DateModified`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateModified->Sortable = FALSE; // Allow sort
		$this->DateModified->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['DateModified'] = &$this->DateModified;

		// DateDeleted
		$this->DateDeleted = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_DateDeleted', 'DateDeleted', '`DateDeleted`', ew_CastDateFieldForLike('`DateDeleted`', 0, "DB"), 135, 0, FALSE, '`DateDeleted`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DateDeleted->Sortable = FALSE; // Allow sort
		$this->DateDeleted->FldDefaultErrMsg = str_replace("%s", $GLOBALS["EW_DATE_FORMAT"], $Language->Phrase("IncorrectDate"));
		$this->fields['DateDeleted'] = &$this->DateDeleted;

		// CreatedBy
		$this->CreatedBy = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_CreatedBy', 'CreatedBy', '`CreatedBy`', '`CreatedBy`', 200, -1, FALSE, '`CreatedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->CreatedBy->Sortable = FALSE; // Allow sort
		$this->fields['CreatedBy'] = &$this->CreatedBy;

		// ModifiedBy
		$this->ModifiedBy = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_ModifiedBy', 'ModifiedBy', '`ModifiedBy`', '`ModifiedBy`', 200, -1, FALSE, '`ModifiedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->ModifiedBy->Sortable = FALSE; // Allow sort
		$this->fields['ModifiedBy'] = &$this->ModifiedBy;

		// DeletedBy
		$this->DeletedBy = new cField('viewsolicitudframe', 'viewsolicitudframe', 'x_DeletedBy', 'DeletedBy', '`DeletedBy`', '`DeletedBy`', 200, -1, FALSE, '`DeletedBy`', FALSE, FALSE, FALSE, 'FORMATTED TEXT', 'TEXT');
		$this->DeletedBy->Sortable = FALSE; // Allow sort
		$this->fields['DeletedBy'] = &$this->DeletedBy;
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
		return ($this->_SqlFrom <> "") ? $this->_SqlFrom : "`viewsolicitudframe`";
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
        if (!isset($_GET["solicitud"]))
        {
            $this->TableFilter = "`id`='0'";

        }else{
            $this->TableFilter = "`id`='".$_GET["solicitud"]."'";
		}
        if (!isset($_GET["id"]))
        {
            $this->TableFilter = "`id`='0'";

        }else{
            $this->TableFilter = "`id`='".$_GET["id"]."'";
        }
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
			return "viewsolicitudframelist.php";
		}
	}

	function setReturnUrl($v) {
		$_SESSION[EW_PROJECT_NAME . "_" . $this->TableVar . "_" . EW_TABLE_RETURN_URL] = $v;
	}

	// Get modal caption
	function GetModalCaption($pageName) {
		global $Language;
		if ($pageName == "viewsolicitudframeview.php")
			return $Language->Phrase("View");
		elseif ($pageName == "viewsolicitudframeedit.php")
			return $Language->Phrase("Edit");
		elseif ($pageName == "viewsolicitudframeadd.php")
			return $Language->Phrase("Add");
		else
			return "";
	}

	// List URL
	function GetListUrl() {
		return "viewsolicitudframelist.php";
	}

	// View URL
	function GetViewUrl($parm = "") {
		if ($parm <> "")
			$url = $this->KeyUrl("viewsolicitudframeview.php", $this->UrlParm($parm));
		else
			$url = $this->KeyUrl("viewsolicitudframeview.php", $this->UrlParm(EW_TABLE_SHOW_DETAIL . "="));
		return $this->AddMasterUrl($url);
	}

	// Add URL
	function GetAddUrl($parm = "") {
		if ($parm <> "")
			$url = "viewsolicitudframeadd.php?" . $this->UrlParm($parm);
		else
			$url = "viewsolicitudframeadd.php";
		return $this->AddMasterUrl($url);
	}

	// Edit URL
	function GetEditUrl($parm = "") {
		$url = $this->KeyUrl("viewsolicitudframeedit.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline edit URL
	function GetInlineEditUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=edit"));
		return $this->AddMasterUrl($url);
	}

	// Copy URL
	function GetCopyUrl($parm = "") {
		$url = $this->KeyUrl("viewsolicitudframeadd.php", $this->UrlParm($parm));
		return $this->AddMasterUrl($url);
	}

	// Inline copy URL
	function GetInlineCopyUrl() {
		$url = $this->KeyUrl(ew_CurrentPage(), $this->UrlParm("a=copy"));
		return $this->AddMasterUrl($url);
	}

	// Delete URL
	function GetDeleteUrl() {
		return $this->KeyUrl("viewsolicitudframedelete.php", $this->UrlParm());
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
		$this->name->setDbValue($rs->fields('name'));
		$this->lastname->setDbValue($rs->fields('lastname'));
		$this->_email->setDbValue($rs->fields('email'));
		$this->address->setDbValue($rs->fields('address'));
		$this->nombre_contacto->setDbValue($rs->fields('nombre_contacto'));
		$this->email_contacto->setDbValue($rs->fields('email_contacto'));
		$this->latitud->setDbValue($rs->fields('latitud'));
		$this->longitud->setDbValue($rs->fields('longitud'));
		$this->phone->setDbValue($rs->fields('phone'));
		$this->cell->setDbValue($rs->fields('cell'));
		$this->id_sucursal->setDbValue($rs->fields('id_sucursal'));
		$this->tipoinmueble->setDbValue($rs->fields('tipoinmueble'));
		$this->id_ciudad_inmueble->setDbValue($rs->fields('id_ciudad_inmueble'));
		$this->id_provincia_inmueble->setDbValue($rs->fields('id_provincia_inmueble'));
		$this->imagen_inmueble01->Upload->DbValue = $rs->fields('imagen_inmueble01');
		$this->imagen_inmueble02->Upload->DbValue = $rs->fields('imagen_inmueble02');
		$this->imagen_inmueble03->Upload->DbValue = $rs->fields('imagen_inmueble03');
		$this->imagen_inmueble04->Upload->DbValue = $rs->fields('imagen_inmueble04');
		$this->imagen_inmueble05->Upload->DbValue = $rs->fields('imagen_inmueble05');
		$this->imagen_inmueble06->Upload->DbValue = $rs->fields('imagen_inmueble06');
		$this->imagen_inmueble07->Upload->DbValue = $rs->fields('imagen_inmueble07');
		$this->imagen_inmueble08->Upload->DbValue = $rs->fields('imagen_inmueble08');
		$this->tipovehiculo->setDbValue($rs->fields('tipovehiculo'));
		$this->id_ciudad_vehiculo->setDbValue($rs->fields('id_ciudad_vehiculo'));
		$this->id_provincia_vehiculo->setDbValue($rs->fields('id_provincia_vehiculo'));
		$this->imagen_vehiculo01->Upload->DbValue = $rs->fields('imagen_vehiculo01');
		$this->imagen_vehiculo02->Upload->DbValue = $rs->fields('imagen_vehiculo02');
		$this->imagen_vehiculo03->Upload->DbValue = $rs->fields('imagen_vehiculo03');
		$this->imagen_vehiculo04->Upload->DbValue = $rs->fields('imagen_vehiculo04');
		$this->imagen_vehiculo05->Upload->DbValue = $rs->fields('imagen_vehiculo05');
		$this->imagen_vehiculo06->Upload->DbValue = $rs->fields('imagen_vehiculo06');
		$this->imagen_vehiculo07->Upload->DbValue = $rs->fields('imagen_vehiculo07');
		$this->imagen_vehiculo08->Upload->DbValue = $rs->fields('imagen_vehiculo08');
		$this->tipomaquinaria->setDbValue($rs->fields('tipomaquinaria'));
		$this->id_ciudad_maquinaria->setDbValue($rs->fields('id_ciudad_maquinaria'));
		$this->id_provincia_maquinaria->setDbValue($rs->fields('id_provincia_maquinaria'));
		$this->imagen_maquinaria01->Upload->DbValue = $rs->fields('imagen_maquinaria01');
		$this->imagen_maquinaria02->Upload->DbValue = $rs->fields('imagen_maquinaria02');
		$this->imagen_maquinaria03->Upload->DbValue = $rs->fields('imagen_maquinaria03');
		$this->imagen_maquinaria04->Upload->DbValue = $rs->fields('imagen_maquinaria04');
		$this->imagen_maquinaria05->Upload->DbValue = $rs->fields('imagen_maquinaria05');
		$this->imagen_maquinaria06->Upload->DbValue = $rs->fields('imagen_maquinaria06');
		$this->imagen_maquinaria07->Upload->DbValue = $rs->fields('imagen_maquinaria07');
		$this->imagen_maquinaria08->Upload->DbValue = $rs->fields('imagen_maquinaria08');
		$this->tipomercaderia->setDbValue($rs->fields('tipomercaderia'));
		$this->imagen_mercaderia01->Upload->DbValue = $rs->fields('imagen_mercaderia01');
		$this->documento_mercaderia->setDbValue($rs->fields('documento_mercaderia'));
		$this->tipoespecial->setDbValue($rs->fields('tipoespecial'));
		$this->imagen_tipoespecial01->Upload->DbValue = $rs->fields('imagen_tipoespecial01');
		$this->is_active->setDbValue($rs->fields('is_active'));
		$this->documentos->setDbValue($rs->fields('documentos'));
		$this->created_at->setDbValue($rs->fields('created_at'));
		$this->DateModified->setDbValue($rs->fields('DateModified'));
		$this->DateDeleted->setDbValue($rs->fields('DateDeleted'));
		$this->CreatedBy->setDbValue($rs->fields('CreatedBy'));
		$this->ModifiedBy->setDbValue($rs->fields('ModifiedBy'));
		$this->DeletedBy->setDbValue($rs->fields('DeletedBy'));
	}

	// Render list row values
	function RenderListRow() {
		global $Security, $gsLanguage, $Language;

		// Call Row Rendering event
		$this->Row_Rendering();

	// Common render codes
		// id
		// name
		// lastname
		// email
		// address
		// nombre_contacto
		// email_contacto
		// latitud

		$this->latitud->CellCssStyle = "white-space: nowrap;";

		// longitud
		$this->longitud->CellCssStyle = "white-space: nowrap;";

		// phone
		// cell
		// id_sucursal
		// tipoinmueble
		// id_ciudad_inmueble
		// id_provincia_inmueble

		$this->id_provincia_inmueble->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble01
		$this->imagen_inmueble01->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble02
		$this->imagen_inmueble02->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble03
		$this->imagen_inmueble03->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble04
		$this->imagen_inmueble04->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble05
		$this->imagen_inmueble05->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble06
		$this->imagen_inmueble06->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble07
		$this->imagen_inmueble07->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble08
		$this->imagen_inmueble08->CellCssStyle = "white-space: nowrap;";

		// tipovehiculo
		// id_ciudad_vehiculo
		// id_provincia_vehiculo
		// imagen_vehiculo01

		$this->imagen_vehiculo01->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo02
		$this->imagen_vehiculo02->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo03
		$this->imagen_vehiculo03->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo04
		$this->imagen_vehiculo04->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo05
		$this->imagen_vehiculo05->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo06
		$this->imagen_vehiculo06->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo07
		$this->imagen_vehiculo07->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo08
		$this->imagen_vehiculo08->CellCssStyle = "white-space: nowrap;";

		// tipomaquinaria
		// id_ciudad_maquinaria
		// id_provincia_maquinaria
		// imagen_maquinaria01

		$this->imagen_maquinaria01->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria02
		$this->imagen_maquinaria02->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria03
		$this->imagen_maquinaria03->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria04
		$this->imagen_maquinaria04->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria05
		$this->imagen_maquinaria05->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria06
		$this->imagen_maquinaria06->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria07
		$this->imagen_maquinaria07->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria08
		$this->imagen_maquinaria08->CellCssStyle = "white-space: nowrap;";

		// tipomercaderia
		// imagen_mercaderia01

		$this->imagen_mercaderia01->CellCssStyle = "white-space: nowrap;";

		// documento_mercaderia
		// tipoespecial
		// imagen_tipoespecial01

		$this->imagen_tipoespecial01->CellCssStyle = "white-space: nowrap;";

		// is_active
		$this->is_active->CellCssStyle = "white-space: nowrap;";

		// documentos
		$this->documentos->CellCssStyle = "white-space: nowrap;";

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

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// name
		$this->name->ViewValue = $this->name->CurrentValue;
		$this->name->ViewCustomAttributes = "";

		// lastname
		$this->lastname->ViewValue = $this->lastname->CurrentValue;
		$this->lastname->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// nombre_contacto
		$this->nombre_contacto->ViewValue = $this->nombre_contacto->CurrentValue;
		$this->nombre_contacto->ViewCustomAttributes = "";

		// email_contacto
		$this->email_contacto->ViewValue = $this->email_contacto->CurrentValue;
		$this->email_contacto->ViewCustomAttributes = "";

		// latitud
		$this->latitud->ViewValue = $this->latitud->CurrentValue;
		$this->latitud->ViewCustomAttributes = "";

		// longitud
		$this->longitud->ViewValue = $this->longitud->CurrentValue;
		$this->longitud->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// cell
		$this->cell->ViewValue = $this->cell->CurrentValue;
		$this->cell->ViewCustomAttributes = "";

		// id_sucursal
		$this->id_sucursal->ViewValue = $this->id_sucursal->CurrentValue;
		$this->id_sucursal->ViewCustomAttributes = "";

		// tipoinmueble
		if (strval($this->tipoinmueble->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipoinmueble->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`nombre`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_STRING, "");
			}
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipoinmueble->LookupFilters = array("dx1" => '`nombre`');
				break;
			case "es":
				$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipoinmueble->LookupFilters = array("dx1" => '`nombre`');
				break;
			default:
				$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipoinmueble->LookupFilters = array("dx1" => '`nombre`');
				break;
		}
		$lookuptblfilter = "`tipo`='INMUEBLE'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tipoinmueble, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->tipoinmueble->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->tipoinmueble->ViewValue .= $this->tipoinmueble->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipoinmueble->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->tipoinmueble->ViewValue = $this->tipoinmueble->CurrentValue;
			}
		} else {
			$this->tipoinmueble->ViewValue = NULL;
		}
		$this->tipoinmueble->ViewCustomAttributes = "";

		// id_ciudad_inmueble
		if (strval($this->id_ciudad_inmueble->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_ciudad_inmueble->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
				$sWhereWrk = "";
				$this->id_ciudad_inmueble->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
				$sWhereWrk = "";
				$this->id_ciudad_inmueble->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
				$sWhereWrk = "";
				$this->id_ciudad_inmueble->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_ciudad_inmueble, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_ciudad_inmueble->ViewValue = $this->id_ciudad_inmueble->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_ciudad_inmueble->ViewValue = $this->id_ciudad_inmueble->CurrentValue;
			}
		} else {
			$this->id_ciudad_inmueble->ViewValue = NULL;
		}
		$this->id_ciudad_inmueble->ViewCustomAttributes = "";

		// id_provincia_inmueble
		if (strval($this->id_provincia_inmueble->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_provincia_inmueble->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
				$sWhereWrk = "";
				$this->id_provincia_inmueble->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
				$sWhereWrk = "";
				$this->id_provincia_inmueble->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
				$sWhereWrk = "";
				$this->id_provincia_inmueble->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_provincia_inmueble, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_provincia_inmueble->ViewValue = $this->id_provincia_inmueble->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_provincia_inmueble->ViewValue = $this->id_provincia_inmueble->CurrentValue;
			}
		} else {
			$this->id_provincia_inmueble->ViewValue = NULL;
		}
		$this->id_provincia_inmueble->ViewCustomAttributes = "";

		// imagen_inmueble01
		if (!ew_Empty($this->imagen_inmueble01->Upload->DbValue)) {
			$this->imagen_inmueble01->ViewValue = "viewsolicitudframe_imagen_inmueble01_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble01->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble01->ViewValue = "";
		}
		$this->imagen_inmueble01->ViewCustomAttributes = "";

		// imagen_inmueble02
		if (!ew_Empty($this->imagen_inmueble02->Upload->DbValue)) {
			$this->imagen_inmueble02->ViewValue = "viewsolicitudframe_imagen_inmueble02_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble02->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble02->ViewValue = "";
		}
		$this->imagen_inmueble02->ViewCustomAttributes = "";

		// imagen_inmueble03
		if (!ew_Empty($this->imagen_inmueble03->Upload->DbValue)) {
			$this->imagen_inmueble03->ViewValue = "viewsolicitudframe_imagen_inmueble03_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble03->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble03->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble03->ViewValue = "";
		}
		$this->imagen_inmueble03->ViewCustomAttributes = "";

		// imagen_inmueble04
		if (!ew_Empty($this->imagen_inmueble04->Upload->DbValue)) {
			$this->imagen_inmueble04->ViewValue = "viewsolicitudframe_imagen_inmueble04_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble04->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble04->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble04->ViewValue = "";
		}
		$this->imagen_inmueble04->ViewCustomAttributes = "";

		// imagen_inmueble05
		if (!ew_Empty($this->imagen_inmueble05->Upload->DbValue)) {
			$this->imagen_inmueble05->ViewValue = "viewsolicitudframe_imagen_inmueble05_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble05->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble05->ViewValue = "";
		}
		$this->imagen_inmueble05->ViewCustomAttributes = "";

		// imagen_inmueble06
		if (!ew_Empty($this->imagen_inmueble06->Upload->DbValue)) {
			$this->imagen_inmueble06->ViewValue = "viewsolicitudframe_imagen_inmueble06_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble06->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble06->ViewValue = "";
		}
		$this->imagen_inmueble06->ViewCustomAttributes = "";

		// imagen_inmueble07
		if (!ew_Empty($this->imagen_inmueble07->Upload->DbValue)) {
			$this->imagen_inmueble07->ViewValue = "viewsolicitudframe_imagen_inmueble07_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble07->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble07->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble07->ViewValue = "";
		}
		$this->imagen_inmueble07->ViewCustomAttributes = "";

		// imagen_inmueble08
		if (!ew_Empty($this->imagen_inmueble08->Upload->DbValue)) {
			$this->imagen_inmueble08->ViewValue = "viewsolicitudframe_imagen_inmueble08_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble08->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble08->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble08->ViewValue = "";
		}
		$this->imagen_inmueble08->ViewCustomAttributes = "";

		// tipovehiculo
		if (strval($this->tipovehiculo->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipovehiculo->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`nombre`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_STRING, "");
			}
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipovehiculo->LookupFilters = array("dx1" => '`nombre`');
				break;
			case "es":
				$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipovehiculo->LookupFilters = array("dx1" => '`nombre`');
				break;
			default:
				$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipovehiculo->LookupFilters = array("dx1" => '`nombre`');
				break;
		}
		$lookuptblfilter = "`tipo`='VEHICULO'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tipovehiculo, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->tipovehiculo->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->tipovehiculo->ViewValue .= $this->tipovehiculo->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipovehiculo->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->tipovehiculo->ViewValue = $this->tipovehiculo->CurrentValue;
			}
		} else {
			$this->tipovehiculo->ViewValue = NULL;
		}
		$this->tipovehiculo->ViewCustomAttributes = "";

		// id_ciudad_vehiculo
		if (strval($this->id_ciudad_vehiculo->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_ciudad_vehiculo->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
				$sWhereWrk = "";
				$this->id_ciudad_vehiculo->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
				$sWhereWrk = "";
				$this->id_ciudad_vehiculo->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
				$sWhereWrk = "";
				$this->id_ciudad_vehiculo->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_ciudad_vehiculo, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_ciudad_vehiculo->ViewValue = $this->id_ciudad_vehiculo->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_ciudad_vehiculo->ViewValue = $this->id_ciudad_vehiculo->CurrentValue;
			}
		} else {
			$this->id_ciudad_vehiculo->ViewValue = NULL;
		}
		$this->id_ciudad_vehiculo->ViewCustomAttributes = "";

		// id_provincia_vehiculo
		if (strval($this->id_provincia_vehiculo->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_provincia_vehiculo->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
				$sWhereWrk = "";
				$this->id_provincia_vehiculo->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
				$sWhereWrk = "";
				$this->id_provincia_vehiculo->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
				$sWhereWrk = "";
				$this->id_provincia_vehiculo->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_provincia_vehiculo, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_provincia_vehiculo->ViewValue = $this->id_provincia_vehiculo->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_provincia_vehiculo->ViewValue = $this->id_provincia_vehiculo->CurrentValue;
			}
		} else {
			$this->id_provincia_vehiculo->ViewValue = NULL;
		}
		$this->id_provincia_vehiculo->ViewCustomAttributes = "";

		// imagen_vehiculo01
		if (!ew_Empty($this->imagen_vehiculo01->Upload->DbValue)) {
			$this->imagen_vehiculo01->ViewValue = "viewsolicitudframe_imagen_vehiculo01_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo01->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo01->ViewValue = "";
		}
		$this->imagen_vehiculo01->ViewCustomAttributes = "";

		// imagen_vehiculo02
		if (!ew_Empty($this->imagen_vehiculo02->Upload->DbValue)) {
			$this->imagen_vehiculo02->ViewValue = "viewsolicitudframe_imagen_vehiculo02_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo02->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo02->ViewValue = "";
		}
		$this->imagen_vehiculo02->ViewCustomAttributes = "";

		// imagen_vehiculo03
		if (!ew_Empty($this->imagen_vehiculo03->Upload->DbValue)) {
			$this->imagen_vehiculo03->ViewValue = "viewsolicitudframe_imagen_vehiculo03_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo03->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo03->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo03->ViewValue = "";
		}
		$this->imagen_vehiculo03->ViewCustomAttributes = "";

		// imagen_vehiculo04
		if (!ew_Empty($this->imagen_vehiculo04->Upload->DbValue)) {
			$this->imagen_vehiculo04->ViewValue = "viewsolicitudframe_imagen_vehiculo04_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo04->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo04->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo04->ViewValue = "";
		}
		$this->imagen_vehiculo04->ViewCustomAttributes = "";

		// imagen_vehiculo05
		if (!ew_Empty($this->imagen_vehiculo05->Upload->DbValue)) {
			$this->imagen_vehiculo05->ViewValue = "viewsolicitudframe_imagen_vehiculo05_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo05->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo05->ViewValue = "";
		}
		$this->imagen_vehiculo05->ViewCustomAttributes = "";

		// imagen_vehiculo06
		if (!ew_Empty($this->imagen_vehiculo06->Upload->DbValue)) {
			$this->imagen_vehiculo06->ViewValue = "viewsolicitudframe_imagen_vehiculo06_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo06->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo06->ViewValue = "";
		}
		$this->imagen_vehiculo06->ViewCustomAttributes = "";

		// imagen_vehiculo07
		if (!ew_Empty($this->imagen_vehiculo07->Upload->DbValue)) {
			$this->imagen_vehiculo07->ViewValue = "viewsolicitudframe_imagen_vehiculo07_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo07->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo07->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo07->ViewValue = "";
		}
		$this->imagen_vehiculo07->ViewCustomAttributes = "";

		// imagen_vehiculo08
		if (!ew_Empty($this->imagen_vehiculo08->Upload->DbValue)) {
			$this->imagen_vehiculo08->ViewValue = "viewsolicitudframe_imagen_vehiculo08_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo08->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo08->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo08->ViewValue = "";
		}
		$this->imagen_vehiculo08->ViewCustomAttributes = "";

		// tipomaquinaria
		if (strval($this->tipomaquinaria->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipomaquinaria->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`nombre`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_STRING, "");
			}
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipomaquinaria->LookupFilters = array("dx1" => '`nombre`');
				break;
			case "es":
				$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipomaquinaria->LookupFilters = array("dx1" => '`nombre`');
				break;
			default:
				$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipomaquinaria->LookupFilters = array("dx1" => '`nombre`');
				break;
		}
		$lookuptblfilter = "`tipo`='MAQUINARIA'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tipomaquinaria, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->tipomaquinaria->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->tipomaquinaria->ViewValue .= $this->tipomaquinaria->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipomaquinaria->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->tipomaquinaria->ViewValue = $this->tipomaquinaria->CurrentValue;
			}
		} else {
			$this->tipomaquinaria->ViewValue = NULL;
		}
		$this->tipomaquinaria->ViewCustomAttributes = "";

		// id_ciudad_maquinaria
		if (strval($this->id_ciudad_maquinaria->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_ciudad_maquinaria->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
				$sWhereWrk = "";
				$this->id_ciudad_maquinaria->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
				$sWhereWrk = "";
				$this->id_ciudad_maquinaria->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
				$sWhereWrk = "";
				$this->id_ciudad_maquinaria->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_ciudad_maquinaria, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_ciudad_maquinaria->ViewValue = $this->id_ciudad_maquinaria->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_ciudad_maquinaria->ViewValue = $this->id_ciudad_maquinaria->CurrentValue;
			}
		} else {
			$this->id_ciudad_maquinaria->ViewValue = NULL;
		}
		$this->id_ciudad_maquinaria->ViewCustomAttributes = "";

		// id_provincia_maquinaria
		if (strval($this->id_provincia_maquinaria->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_provincia_maquinaria->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
				$sWhereWrk = "";
				$this->id_provincia_maquinaria->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
				$sWhereWrk = "";
				$this->id_provincia_maquinaria->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
				$sWhereWrk = "";
				$this->id_provincia_maquinaria->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_provincia_maquinaria, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_provincia_maquinaria->ViewValue = $this->id_provincia_maquinaria->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_provincia_maquinaria->ViewValue = $this->id_provincia_maquinaria->CurrentValue;
			}
		} else {
			$this->id_provincia_maquinaria->ViewValue = NULL;
		}
		$this->id_provincia_maquinaria->ViewCustomAttributes = "";

		// imagen_maquinaria01
		if (!ew_Empty($this->imagen_maquinaria01->Upload->DbValue)) {
			$this->imagen_maquinaria01->ViewValue = "viewsolicitudframe_imagen_maquinaria01_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria01->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria01->ViewValue = "";
		}
		$this->imagen_maquinaria01->ViewCustomAttributes = "";

		// imagen_maquinaria02
		if (!ew_Empty($this->imagen_maquinaria02->Upload->DbValue)) {
			$this->imagen_maquinaria02->ViewValue = "viewsolicitudframe_imagen_maquinaria02_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria02->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria02->ViewValue = "";
		}
		$this->imagen_maquinaria02->ViewCustomAttributes = "";

		// imagen_maquinaria03
		if (!ew_Empty($this->imagen_maquinaria03->Upload->DbValue)) {
			$this->imagen_maquinaria03->ViewValue = "viewsolicitudframe_imagen_maquinaria03_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria03->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria03->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria03->ViewValue = "";
		}
		$this->imagen_maquinaria03->ViewCustomAttributes = "";

		// imagen_maquinaria04
		if (!ew_Empty($this->imagen_maquinaria04->Upload->DbValue)) {
			$this->imagen_maquinaria04->ViewValue = "viewsolicitudframe_imagen_maquinaria04_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria04->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria04->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria04->ViewValue = "";
		}
		$this->imagen_maquinaria04->ViewCustomAttributes = "";

		// imagen_maquinaria05
		if (!ew_Empty($this->imagen_maquinaria05->Upload->DbValue)) {
			$this->imagen_maquinaria05->ViewValue = "viewsolicitudframe_imagen_maquinaria05_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria05->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria05->ViewValue = "";
		}
		$this->imagen_maquinaria05->ViewCustomAttributes = "";

		// imagen_maquinaria06
		if (!ew_Empty($this->imagen_maquinaria06->Upload->DbValue)) {
			$this->imagen_maquinaria06->ViewValue = "viewsolicitudframe_imagen_maquinaria06_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria06->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria06->ViewValue = "";
		}
		$this->imagen_maquinaria06->ViewCustomAttributes = "";

		// imagen_maquinaria07
		if (!ew_Empty($this->imagen_maquinaria07->Upload->DbValue)) {
			$this->imagen_maquinaria07->ViewValue = "viewsolicitudframe_imagen_maquinaria07_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria07->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria07->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria07->ViewValue = "";
		}
		$this->imagen_maquinaria07->ViewCustomAttributes = "";

		// imagen_maquinaria08
		if (!ew_Empty($this->imagen_maquinaria08->Upload->DbValue)) {
			$this->imagen_maquinaria08->ViewValue = "viewsolicitudframe_imagen_maquinaria08_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria08->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria08->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria08->ViewValue = "";
		}
		$this->imagen_maquinaria08->ViewCustomAttributes = "";

		// tipomercaderia
		if (strval($this->tipomercaderia->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipomercaderia->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`id_tipoinmueble`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id_tipoinmueble`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipomercaderia->LookupFilters = array("dx1" => '`nombre`');
				break;
			case "es":
				$sSqlWrk = "SELECT `id_tipoinmueble`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipomercaderia->LookupFilters = array("dx1" => '`nombre`');
				break;
			default:
				$sSqlWrk = "SELECT `id_tipoinmueble`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipomercaderia->LookupFilters = array("dx1" => '`nombre`');
				break;
		}
		$lookuptblfilter = "`tipo`='MERCADERIA'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tipomercaderia, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->tipomercaderia->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->tipomercaderia->ViewValue .= $this->tipomercaderia->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipomercaderia->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->tipomercaderia->ViewValue = $this->tipomercaderia->CurrentValue;
			}
		} else {
			$this->tipomercaderia->ViewValue = NULL;
		}
		$this->tipomercaderia->ViewCustomAttributes = "";

		// imagen_mercaderia01
		if (!ew_Empty($this->imagen_mercaderia01->Upload->DbValue)) {
			$this->imagen_mercaderia01->ViewValue = "viewsolicitudframe_imagen_mercaderia01_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_mercaderia01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_mercaderia01->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_mercaderia01->ViewValue = "";
		}
		$this->imagen_mercaderia01->ViewCustomAttributes = "";

		// documento_mercaderia
		$this->documento_mercaderia->ViewValue = $this->documento_mercaderia->CurrentValue;
		$this->documento_mercaderia->ViewCustomAttributes = "";

		// tipoespecial
		if (strval($this->tipoespecial->CurrentValue) <> "") {
			$sFilterWrk = "`id_tipoinmueble`" . ew_SearchString("=", $this->tipoespecial->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id_tipoinmueble`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipoespecial->LookupFilters = array("dx1" => '`nombre`');
				break;
			case "es":
				$sSqlWrk = "SELECT `id_tipoinmueble`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipoespecial->LookupFilters = array("dx1" => '`nombre`');
				break;
			default:
				$sSqlWrk = "SELECT `id_tipoinmueble`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
				$sWhereWrk = "";
				$this->tipoespecial->LookupFilters = array("dx1" => '`nombre`');
				break;
		}
		$lookuptblfilter = "`tipo`='ESPECIAL'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tipoespecial, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->tipoespecial->ViewValue = $this->tipoespecial->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->tipoespecial->ViewValue = $this->tipoespecial->CurrentValue;
			}
		} else {
			$this->tipoespecial->ViewValue = NULL;
		}
		$this->tipoespecial->ViewCustomAttributes = "";

		// imagen_tipoespecial01
		if (!ew_Empty($this->imagen_tipoespecial01->Upload->DbValue)) {
			$this->imagen_tipoespecial01->ViewValue = "viewsolicitudframe_imagen_tipoespecial01_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_tipoespecial01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_tipoespecial01->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_tipoespecial01->ViewValue = "";
		}
		$this->imagen_tipoespecial01->ViewCustomAttributes = "";

		// is_active
		$this->is_active->ViewValue = $this->is_active->CurrentValue;
		$this->is_active->ViewCustomAttributes = "";

		// documentos
		$this->documentos->ViewValue = $this->documentos->CurrentValue;
		$this->documentos->ViewCustomAttributes = "";

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

		// id
		$this->id->LinkCustomAttributes = "";
		$this->id->HrefValue = "";
		$this->id->TooltipValue = "";

		// name
		$this->name->LinkCustomAttributes = "";
		$this->name->HrefValue = "";
		$this->name->TooltipValue = "";

		// lastname
		$this->lastname->LinkCustomAttributes = "";
		$this->lastname->HrefValue = "";
		$this->lastname->TooltipValue = "";

		// email
		$this->_email->LinkCustomAttributes = "";
		$this->_email->HrefValue = "";
		$this->_email->TooltipValue = "";

		// address
		$this->address->LinkCustomAttributes = "";
		$this->address->HrefValue = "";
		$this->address->TooltipValue = "";

		// nombre_contacto
		$this->nombre_contacto->LinkCustomAttributes = "";
		$this->nombre_contacto->HrefValue = "";
		$this->nombre_contacto->TooltipValue = "";

		// email_contacto
		$this->email_contacto->LinkCustomAttributes = "";
		$this->email_contacto->HrefValue = "";
		$this->email_contacto->TooltipValue = "";

		// latitud
		$this->latitud->LinkCustomAttributes = "";
		$this->latitud->HrefValue = "";
		$this->latitud->TooltipValue = "";

		// longitud
		$this->longitud->LinkCustomAttributes = "";
		$this->longitud->HrefValue = "";
		$this->longitud->TooltipValue = "";

		// phone
		$this->phone->LinkCustomAttributes = "";
		$this->phone->HrefValue = "";
		$this->phone->TooltipValue = "";

		// cell
		$this->cell->LinkCustomAttributes = "";
		$this->cell->HrefValue = "";
		$this->cell->TooltipValue = "";

		// id_sucursal
		$this->id_sucursal->LinkCustomAttributes = "";
		$this->id_sucursal->HrefValue = "";
		$this->id_sucursal->TooltipValue = "";

		// tipoinmueble
		$this->tipoinmueble->LinkCustomAttributes = "";
		$this->tipoinmueble->HrefValue = "";
		$this->tipoinmueble->TooltipValue = "";

		// id_ciudad_inmueble
		$this->id_ciudad_inmueble->LinkCustomAttributes = "";
		$this->id_ciudad_inmueble->HrefValue = "";
		$this->id_ciudad_inmueble->TooltipValue = "";

		// id_provincia_inmueble
		$this->id_provincia_inmueble->LinkCustomAttributes = "";
		$this->id_provincia_inmueble->HrefValue = "";
		$this->id_provincia_inmueble->TooltipValue = "";

		// imagen_inmueble01
		$this->imagen_inmueble01->LinkCustomAttributes = "";
		if (!empty($this->imagen_inmueble01->Upload->DbValue)) {
			$this->imagen_inmueble01->HrefValue = "viewsolicitudframe_imagen_inmueble01_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble01->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_inmueble01->HrefValue = ew_FullUrl($this->imagen_inmueble01->HrefValue, "href");
		} else {
			$this->imagen_inmueble01->HrefValue = "";
		}
		$this->imagen_inmueble01->HrefValue2 = "viewsolicitudframe_imagen_inmueble01_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_inmueble01->TooltipValue = "";

		// imagen_inmueble02
		$this->imagen_inmueble02->LinkCustomAttributes = "";
		if (!empty($this->imagen_inmueble02->Upload->DbValue)) {
			$this->imagen_inmueble02->HrefValue = "viewsolicitudframe_imagen_inmueble02_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble02->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_inmueble02->HrefValue = ew_FullUrl($this->imagen_inmueble02->HrefValue, "href");
		} else {
			$this->imagen_inmueble02->HrefValue = "";
		}
		$this->imagen_inmueble02->HrefValue2 = "viewsolicitudframe_imagen_inmueble02_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_inmueble02->TooltipValue = "";

		// imagen_inmueble03
		$this->imagen_inmueble03->LinkCustomAttributes = "";
		if (!empty($this->imagen_inmueble03->Upload->DbValue)) {
			$this->imagen_inmueble03->HrefValue = "viewsolicitudframe_imagen_inmueble03_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble03->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_inmueble03->HrefValue = ew_FullUrl($this->imagen_inmueble03->HrefValue, "href");
		} else {
			$this->imagen_inmueble03->HrefValue = "";
		}
		$this->imagen_inmueble03->HrefValue2 = "viewsolicitudframe_imagen_inmueble03_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_inmueble03->TooltipValue = "";

		// imagen_inmueble04
		$this->imagen_inmueble04->LinkCustomAttributes = "";
		if (!empty($this->imagen_inmueble04->Upload->DbValue)) {
			$this->imagen_inmueble04->HrefValue = "viewsolicitudframe_imagen_inmueble04_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble04->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_inmueble04->HrefValue = ew_FullUrl($this->imagen_inmueble04->HrefValue, "href");
		} else {
			$this->imagen_inmueble04->HrefValue = "";
		}
		$this->imagen_inmueble04->HrefValue2 = "viewsolicitudframe_imagen_inmueble04_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_inmueble04->TooltipValue = "";

		// imagen_inmueble05
		$this->imagen_inmueble05->LinkCustomAttributes = "";
		if (!empty($this->imagen_inmueble05->Upload->DbValue)) {
			$this->imagen_inmueble05->HrefValue = "viewsolicitudframe_imagen_inmueble05_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble05->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_inmueble05->HrefValue = ew_FullUrl($this->imagen_inmueble05->HrefValue, "href");
		} else {
			$this->imagen_inmueble05->HrefValue = "";
		}
		$this->imagen_inmueble05->HrefValue2 = "viewsolicitudframe_imagen_inmueble05_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_inmueble05->TooltipValue = "";

		// imagen_inmueble06
		$this->imagen_inmueble06->LinkCustomAttributes = "";
		if (!empty($this->imagen_inmueble06->Upload->DbValue)) {
			$this->imagen_inmueble06->HrefValue = "viewsolicitudframe_imagen_inmueble06_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble06->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_inmueble06->HrefValue = ew_FullUrl($this->imagen_inmueble06->HrefValue, "href");
		} else {
			$this->imagen_inmueble06->HrefValue = "";
		}
		$this->imagen_inmueble06->HrefValue2 = "viewsolicitudframe_imagen_inmueble06_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_inmueble06->TooltipValue = "";

		// imagen_inmueble07
		$this->imagen_inmueble07->LinkCustomAttributes = "";
		if (!empty($this->imagen_inmueble07->Upload->DbValue)) {
			$this->imagen_inmueble07->HrefValue = "viewsolicitudframe_imagen_inmueble07_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble07->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_inmueble07->HrefValue = ew_FullUrl($this->imagen_inmueble07->HrefValue, "href");
		} else {
			$this->imagen_inmueble07->HrefValue = "";
		}
		$this->imagen_inmueble07->HrefValue2 = "viewsolicitudframe_imagen_inmueble07_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_inmueble07->TooltipValue = "";

		// imagen_inmueble08
		$this->imagen_inmueble08->LinkCustomAttributes = "";
		if (!empty($this->imagen_inmueble08->Upload->DbValue)) {
			$this->imagen_inmueble08->HrefValue = "viewsolicitudframe_imagen_inmueble08_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble08->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_inmueble08->HrefValue = ew_FullUrl($this->imagen_inmueble08->HrefValue, "href");
		} else {
			$this->imagen_inmueble08->HrefValue = "";
		}
		$this->imagen_inmueble08->HrefValue2 = "viewsolicitudframe_imagen_inmueble08_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_inmueble08->TooltipValue = "";

		// tipovehiculo
		$this->tipovehiculo->LinkCustomAttributes = "";
		$this->tipovehiculo->HrefValue = "";
		$this->tipovehiculo->TooltipValue = "";

		// id_ciudad_vehiculo
		$this->id_ciudad_vehiculo->LinkCustomAttributes = "";
		$this->id_ciudad_vehiculo->HrefValue = "";
		$this->id_ciudad_vehiculo->TooltipValue = "";

		// id_provincia_vehiculo
		$this->id_provincia_vehiculo->LinkCustomAttributes = "";
		$this->id_provincia_vehiculo->HrefValue = "";
		$this->id_provincia_vehiculo->TooltipValue = "";

		// imagen_vehiculo01
		$this->imagen_vehiculo01->LinkCustomAttributes = "";
		if (!empty($this->imagen_vehiculo01->Upload->DbValue)) {
			$this->imagen_vehiculo01->HrefValue = "viewsolicitudframe_imagen_vehiculo01_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo01->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_vehiculo01->HrefValue = ew_FullUrl($this->imagen_vehiculo01->HrefValue, "href");
		} else {
			$this->imagen_vehiculo01->HrefValue = "";
		}
		$this->imagen_vehiculo01->HrefValue2 = "viewsolicitudframe_imagen_vehiculo01_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_vehiculo01->TooltipValue = "";

		// imagen_vehiculo02
		$this->imagen_vehiculo02->LinkCustomAttributes = "";
		if (!empty($this->imagen_vehiculo02->Upload->DbValue)) {
			$this->imagen_vehiculo02->HrefValue = "viewsolicitudframe_imagen_vehiculo02_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo02->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_vehiculo02->HrefValue = ew_FullUrl($this->imagen_vehiculo02->HrefValue, "href");
		} else {
			$this->imagen_vehiculo02->HrefValue = "";
		}
		$this->imagen_vehiculo02->HrefValue2 = "viewsolicitudframe_imagen_vehiculo02_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_vehiculo02->TooltipValue = "";

		// imagen_vehiculo03
		$this->imagen_vehiculo03->LinkCustomAttributes = "";
		if (!empty($this->imagen_vehiculo03->Upload->DbValue)) {
			$this->imagen_vehiculo03->HrefValue = "viewsolicitudframe_imagen_vehiculo03_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo03->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_vehiculo03->HrefValue = ew_FullUrl($this->imagen_vehiculo03->HrefValue, "href");
		} else {
			$this->imagen_vehiculo03->HrefValue = "";
		}
		$this->imagen_vehiculo03->HrefValue2 = "viewsolicitudframe_imagen_vehiculo03_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_vehiculo03->TooltipValue = "";

		// imagen_vehiculo04
		$this->imagen_vehiculo04->LinkCustomAttributes = "";
		if (!empty($this->imagen_vehiculo04->Upload->DbValue)) {
			$this->imagen_vehiculo04->HrefValue = "viewsolicitudframe_imagen_vehiculo04_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo04->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_vehiculo04->HrefValue = ew_FullUrl($this->imagen_vehiculo04->HrefValue, "href");
		} else {
			$this->imagen_vehiculo04->HrefValue = "";
		}
		$this->imagen_vehiculo04->HrefValue2 = "viewsolicitudframe_imagen_vehiculo04_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_vehiculo04->TooltipValue = "";

		// imagen_vehiculo05
		$this->imagen_vehiculo05->LinkCustomAttributes = "";
		if (!empty($this->imagen_vehiculo05->Upload->DbValue)) {
			$this->imagen_vehiculo05->HrefValue = "viewsolicitudframe_imagen_vehiculo05_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo05->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_vehiculo05->HrefValue = ew_FullUrl($this->imagen_vehiculo05->HrefValue, "href");
		} else {
			$this->imagen_vehiculo05->HrefValue = "";
		}
		$this->imagen_vehiculo05->HrefValue2 = "viewsolicitudframe_imagen_vehiculo05_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_vehiculo05->TooltipValue = "";

		// imagen_vehiculo06
		$this->imagen_vehiculo06->LinkCustomAttributes = "";
		if (!empty($this->imagen_vehiculo06->Upload->DbValue)) {
			$this->imagen_vehiculo06->HrefValue = "viewsolicitudframe_imagen_vehiculo06_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo06->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_vehiculo06->HrefValue = ew_FullUrl($this->imagen_vehiculo06->HrefValue, "href");
		} else {
			$this->imagen_vehiculo06->HrefValue = "";
		}
		$this->imagen_vehiculo06->HrefValue2 = "viewsolicitudframe_imagen_vehiculo06_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_vehiculo06->TooltipValue = "";

		// imagen_vehiculo07
		$this->imagen_vehiculo07->LinkCustomAttributes = "";
		if (!empty($this->imagen_vehiculo07->Upload->DbValue)) {
			$this->imagen_vehiculo07->HrefValue = "viewsolicitudframe_imagen_vehiculo07_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo07->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_vehiculo07->HrefValue = ew_FullUrl($this->imagen_vehiculo07->HrefValue, "href");
		} else {
			$this->imagen_vehiculo07->HrefValue = "";
		}
		$this->imagen_vehiculo07->HrefValue2 = "viewsolicitudframe_imagen_vehiculo07_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_vehiculo07->TooltipValue = "";

		// imagen_vehiculo08
		$this->imagen_vehiculo08->LinkCustomAttributes = "";
		if (!empty($this->imagen_vehiculo08->Upload->DbValue)) {
			$this->imagen_vehiculo08->HrefValue = "viewsolicitudframe_imagen_vehiculo08_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo08->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_vehiculo08->HrefValue = ew_FullUrl($this->imagen_vehiculo08->HrefValue, "href");
		} else {
			$this->imagen_vehiculo08->HrefValue = "";
		}
		$this->imagen_vehiculo08->HrefValue2 = "viewsolicitudframe_imagen_vehiculo08_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_vehiculo08->TooltipValue = "";

		// tipomaquinaria
		$this->tipomaquinaria->LinkCustomAttributes = "";
		$this->tipomaquinaria->HrefValue = "";
		$this->tipomaquinaria->TooltipValue = "";

		// id_ciudad_maquinaria
		$this->id_ciudad_maquinaria->LinkCustomAttributes = "";
		$this->id_ciudad_maquinaria->HrefValue = "";
		$this->id_ciudad_maquinaria->TooltipValue = "";

		// id_provincia_maquinaria
		$this->id_provincia_maquinaria->LinkCustomAttributes = "";
		$this->id_provincia_maquinaria->HrefValue = "";
		$this->id_provincia_maquinaria->TooltipValue = "";

		// imagen_maquinaria01
		$this->imagen_maquinaria01->LinkCustomAttributes = "";
		if (!empty($this->imagen_maquinaria01->Upload->DbValue)) {
			$this->imagen_maquinaria01->HrefValue = "viewsolicitudframe_imagen_maquinaria01_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria01->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_maquinaria01->HrefValue = ew_FullUrl($this->imagen_maquinaria01->HrefValue, "href");
		} else {
			$this->imagen_maquinaria01->HrefValue = "";
		}
		$this->imagen_maquinaria01->HrefValue2 = "viewsolicitudframe_imagen_maquinaria01_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_maquinaria01->TooltipValue = "";

		// imagen_maquinaria02
		$this->imagen_maquinaria02->LinkCustomAttributes = "";
		if (!empty($this->imagen_maquinaria02->Upload->DbValue)) {
			$this->imagen_maquinaria02->HrefValue = "viewsolicitudframe_imagen_maquinaria02_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria02->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_maquinaria02->HrefValue = ew_FullUrl($this->imagen_maquinaria02->HrefValue, "href");
		} else {
			$this->imagen_maquinaria02->HrefValue = "";
		}
		$this->imagen_maquinaria02->HrefValue2 = "viewsolicitudframe_imagen_maquinaria02_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_maquinaria02->TooltipValue = "";

		// imagen_maquinaria03
		$this->imagen_maquinaria03->LinkCustomAttributes = "";
		if (!empty($this->imagen_maquinaria03->Upload->DbValue)) {
			$this->imagen_maquinaria03->HrefValue = "viewsolicitudframe_imagen_maquinaria03_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria03->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_maquinaria03->HrefValue = ew_FullUrl($this->imagen_maquinaria03->HrefValue, "href");
		} else {
			$this->imagen_maquinaria03->HrefValue = "";
		}
		$this->imagen_maquinaria03->HrefValue2 = "viewsolicitudframe_imagen_maquinaria03_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_maquinaria03->TooltipValue = "";

		// imagen_maquinaria04
		$this->imagen_maquinaria04->LinkCustomAttributes = "";
		if (!empty($this->imagen_maquinaria04->Upload->DbValue)) {
			$this->imagen_maquinaria04->HrefValue = "viewsolicitudframe_imagen_maquinaria04_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria04->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_maquinaria04->HrefValue = ew_FullUrl($this->imagen_maquinaria04->HrefValue, "href");
		} else {
			$this->imagen_maquinaria04->HrefValue = "";
		}
		$this->imagen_maquinaria04->HrefValue2 = "viewsolicitudframe_imagen_maquinaria04_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_maquinaria04->TooltipValue = "";

		// imagen_maquinaria05
		$this->imagen_maquinaria05->LinkCustomAttributes = "";
		if (!empty($this->imagen_maquinaria05->Upload->DbValue)) {
			$this->imagen_maquinaria05->HrefValue = "viewsolicitudframe_imagen_maquinaria05_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria05->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_maquinaria05->HrefValue = ew_FullUrl($this->imagen_maquinaria05->HrefValue, "href");
		} else {
			$this->imagen_maquinaria05->HrefValue = "";
		}
		$this->imagen_maquinaria05->HrefValue2 = "viewsolicitudframe_imagen_maquinaria05_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_maquinaria05->TooltipValue = "";

		// imagen_maquinaria06
		$this->imagen_maquinaria06->LinkCustomAttributes = "";
		if (!empty($this->imagen_maquinaria06->Upload->DbValue)) {
			$this->imagen_maquinaria06->HrefValue = "viewsolicitudframe_imagen_maquinaria06_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria06->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_maquinaria06->HrefValue = ew_FullUrl($this->imagen_maquinaria06->HrefValue, "href");
		} else {
			$this->imagen_maquinaria06->HrefValue = "";
		}
		$this->imagen_maquinaria06->HrefValue2 = "viewsolicitudframe_imagen_maquinaria06_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_maquinaria06->TooltipValue = "";

		// imagen_maquinaria07
		$this->imagen_maquinaria07->LinkCustomAttributes = "";
		if (!empty($this->imagen_maquinaria07->Upload->DbValue)) {
			$this->imagen_maquinaria07->HrefValue = "viewsolicitudframe_imagen_maquinaria07_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria07->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_maquinaria07->HrefValue = ew_FullUrl($this->imagen_maquinaria07->HrefValue, "href");
		} else {
			$this->imagen_maquinaria07->HrefValue = "";
		}
		$this->imagen_maquinaria07->HrefValue2 = "viewsolicitudframe_imagen_maquinaria07_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_maquinaria07->TooltipValue = "";

		// imagen_maquinaria08
		$this->imagen_maquinaria08->LinkCustomAttributes = "";
		if (!empty($this->imagen_maquinaria08->Upload->DbValue)) {
			$this->imagen_maquinaria08->HrefValue = "viewsolicitudframe_imagen_maquinaria08_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria08->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_maquinaria08->HrefValue = ew_FullUrl($this->imagen_maquinaria08->HrefValue, "href");
		} else {
			$this->imagen_maquinaria08->HrefValue = "";
		}
		$this->imagen_maquinaria08->HrefValue2 = "viewsolicitudframe_imagen_maquinaria08_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_maquinaria08->TooltipValue = "";

		// tipomercaderia
		$this->tipomercaderia->LinkCustomAttributes = "";
		$this->tipomercaderia->HrefValue = "";
		$this->tipomercaderia->TooltipValue = "";

		// imagen_mercaderia01
		$this->imagen_mercaderia01->LinkCustomAttributes = "";
		if (!empty($this->imagen_mercaderia01->Upload->DbValue)) {
			$this->imagen_mercaderia01->HrefValue = "viewsolicitudframe_imagen_mercaderia01_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_mercaderia01->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_mercaderia01->HrefValue = ew_FullUrl($this->imagen_mercaderia01->HrefValue, "href");
		} else {
			$this->imagen_mercaderia01->HrefValue = "";
		}
		$this->imagen_mercaderia01->HrefValue2 = "viewsolicitudframe_imagen_mercaderia01_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_mercaderia01->TooltipValue = "";

		// documento_mercaderia
		$this->documento_mercaderia->LinkCustomAttributes = "";
		$this->documento_mercaderia->HrefValue = "";
		$this->documento_mercaderia->TooltipValue = "";

		// tipoespecial
		$this->tipoespecial->LinkCustomAttributes = "";
		$this->tipoespecial->HrefValue = "";
		$this->tipoespecial->TooltipValue = "";

		// imagen_tipoespecial01
		$this->imagen_tipoespecial01->LinkCustomAttributes = "";
		if (!empty($this->imagen_tipoespecial01->Upload->DbValue)) {
			$this->imagen_tipoespecial01->HrefValue = "viewsolicitudframe_imagen_tipoespecial01_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_tipoespecial01->LinkAttrs["target"] = "_blank";
			if ($this->Export <> "") $this->imagen_tipoespecial01->HrefValue = ew_FullUrl($this->imagen_tipoespecial01->HrefValue, "href");
		} else {
			$this->imagen_tipoespecial01->HrefValue = "";
		}
		$this->imagen_tipoespecial01->HrefValue2 = "viewsolicitudframe_imagen_tipoespecial01_bv.php?id=" . $this->id->CurrentValue;
		$this->imagen_tipoespecial01->TooltipValue = "";

		// is_active
		$this->is_active->LinkCustomAttributes = "";
		$this->is_active->HrefValue = "";
		$this->is_active->TooltipValue = "";

		// documentos
		$this->documentos->LinkCustomAttributes = "";
		$this->documentos->HrefValue = "";
		$this->documentos->TooltipValue = "";

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

		// name
		$this->name->EditAttrs["class"] = "form-control";
		$this->name->EditCustomAttributes = "";
		$this->name->EditValue = $this->name->CurrentValue;
		$this->name->PlaceHolder = ew_RemoveHtml($this->name->FldTitle());

		// lastname
		$this->lastname->EditAttrs["class"] = "form-control";
		$this->lastname->EditCustomAttributes = "";
		$this->lastname->EditValue = $this->lastname->CurrentValue;
		$this->lastname->PlaceHolder = ew_RemoveHtml($this->lastname->FldTitle());

		// email
		$this->_email->EditAttrs["class"] = "form-control";
		$this->_email->EditCustomAttributes = "";
		$this->_email->EditValue = $this->_email->CurrentValue;
		$this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldTitle());

		// address
		$this->address->EditAttrs["class"] = "form-control";
		$this->address->EditCustomAttributes = "";
		$this->address->EditValue = $this->address->CurrentValue;
		$this->address->PlaceHolder = ew_RemoveHtml($this->address->FldTitle());

		// nombre_contacto
		$this->nombre_contacto->EditAttrs["class"] = "form-control";
		$this->nombre_contacto->EditCustomAttributes = "";
		$this->nombre_contacto->EditValue = $this->nombre_contacto->CurrentValue;
		$this->nombre_contacto->ViewCustomAttributes = "";

		// email_contacto
		$this->email_contacto->EditAttrs["class"] = "form-control";
		$this->email_contacto->EditCustomAttributes = "";

		// latitud
		$this->latitud->EditAttrs["class"] = "form-control";
		$this->latitud->EditCustomAttributes = "";
		$this->latitud->EditValue = $this->latitud->CurrentValue;
		$this->latitud->PlaceHolder = ew_RemoveHtml($this->latitud->FldTitle());
		if (strval($this->latitud->EditValue) <> "" && is_numeric($this->latitud->EditValue)) $this->latitud->EditValue = ew_FormatNumber($this->latitud->EditValue, -2, -1, -2, 0);

		// longitud
		$this->longitud->EditAttrs["class"] = "form-control";
		$this->longitud->EditCustomAttributes = "";
		$this->longitud->EditValue = $this->longitud->CurrentValue;
		$this->longitud->PlaceHolder = ew_RemoveHtml($this->longitud->FldTitle());
		if (strval($this->longitud->EditValue) <> "" && is_numeric($this->longitud->EditValue)) $this->longitud->EditValue = ew_FormatNumber($this->longitud->EditValue, -2, -1, -2, 0);

		// phone
		$this->phone->EditAttrs["class"] = "form-control";
		$this->phone->EditCustomAttributes = "";
		$this->phone->EditValue = $this->phone->CurrentValue;
		$this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldTitle());

		// cell
		$this->cell->EditAttrs["class"] = "form-control";
		$this->cell->EditCustomAttributes = "";
		$this->cell->EditValue = $this->cell->CurrentValue;
		$this->cell->PlaceHolder = ew_RemoveHtml($this->cell->FldTitle());

		// id_sucursal
		$this->id_sucursal->EditAttrs["class"] = "form-control";
		$this->id_sucursal->EditCustomAttributes = "";

		// tipoinmueble
		$this->tipoinmueble->EditAttrs["class"] = "form-control";
		$this->tipoinmueble->EditCustomAttributes = "";

		// id_ciudad_inmueble
		$this->id_ciudad_inmueble->EditAttrs["class"] = "form-control";
		$this->id_ciudad_inmueble->EditCustomAttributes = "";

		// id_provincia_inmueble
		$this->id_provincia_inmueble->EditAttrs["class"] = "form-control";
		$this->id_provincia_inmueble->EditCustomAttributes = "";

		// imagen_inmueble01
		$this->imagen_inmueble01->EditAttrs["class"] = "form-control";
		$this->imagen_inmueble01->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_inmueble01->Upload->DbValue)) {
			$this->imagen_inmueble01->EditValue = "viewsolicitudframe_imagen_inmueble01_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble01->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble01->EditValue = "";
		}

		// imagen_inmueble02
		$this->imagen_inmueble02->EditAttrs["class"] = "form-control";
		$this->imagen_inmueble02->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_inmueble02->Upload->DbValue)) {
			$this->imagen_inmueble02->EditValue = "viewsolicitudframe_imagen_inmueble02_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble02->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble02->EditValue = "";
		}

		// imagen_inmueble03
		$this->imagen_inmueble03->EditAttrs["class"] = "form-control";
		$this->imagen_inmueble03->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_inmueble03->Upload->DbValue)) {
			$this->imagen_inmueble03->EditValue = "viewsolicitudframe_imagen_inmueble03_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble03->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble03->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble03->EditValue = "";
		}

		// imagen_inmueble04
		$this->imagen_inmueble04->EditAttrs["class"] = "form-control";
		$this->imagen_inmueble04->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_inmueble04->Upload->DbValue)) {
			$this->imagen_inmueble04->EditValue = "viewsolicitudframe_imagen_inmueble04_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble04->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble04->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble04->EditValue = "";
		}

		// imagen_inmueble05
		$this->imagen_inmueble05->EditAttrs["class"] = "form-control";
		$this->imagen_inmueble05->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_inmueble05->Upload->DbValue)) {
			$this->imagen_inmueble05->EditValue = "viewsolicitudframe_imagen_inmueble05_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble05->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble05->EditValue = "";
		}

		// imagen_inmueble06
		$this->imagen_inmueble06->EditAttrs["class"] = "form-control";
		$this->imagen_inmueble06->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_inmueble06->Upload->DbValue)) {
			$this->imagen_inmueble06->EditValue = "viewsolicitudframe_imagen_inmueble06_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble06->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble06->EditValue = "";
		}

		// imagen_inmueble07
		$this->imagen_inmueble07->EditAttrs["class"] = "form-control";
		$this->imagen_inmueble07->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_inmueble07->Upload->DbValue)) {
			$this->imagen_inmueble07->EditValue = "viewsolicitudframe_imagen_inmueble07_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble07->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble07->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble07->EditValue = "";
		}

		// imagen_inmueble08
		$this->imagen_inmueble08->EditAttrs["class"] = "form-control";
		$this->imagen_inmueble08->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_inmueble08->Upload->DbValue)) {
			$this->imagen_inmueble08->EditValue = "viewsolicitudframe_imagen_inmueble08_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble08->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble08->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble08->EditValue = "";
		}

		// tipovehiculo
		$this->tipovehiculo->EditAttrs["class"] = "form-control";
		$this->tipovehiculo->EditCustomAttributes = "";

		// id_ciudad_vehiculo
		$this->id_ciudad_vehiculo->EditAttrs["class"] = "form-control";
		$this->id_ciudad_vehiculo->EditCustomAttributes = "";

		// id_provincia_vehiculo
		$this->id_provincia_vehiculo->EditAttrs["class"] = "form-control";
		$this->id_provincia_vehiculo->EditCustomAttributes = "";

		// imagen_vehiculo01
		$this->imagen_vehiculo01->EditAttrs["class"] = "form-control";
		$this->imagen_vehiculo01->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_vehiculo01->Upload->DbValue)) {
			$this->imagen_vehiculo01->EditValue = "viewsolicitudframe_imagen_vehiculo01_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo01->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo01->EditValue = "";
		}

		// imagen_vehiculo02
		$this->imagen_vehiculo02->EditAttrs["class"] = "form-control";
		$this->imagen_vehiculo02->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_vehiculo02->Upload->DbValue)) {
			$this->imagen_vehiculo02->EditValue = "viewsolicitudframe_imagen_vehiculo02_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo02->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo02->EditValue = "";
		}

		// imagen_vehiculo03
		$this->imagen_vehiculo03->EditAttrs["class"] = "form-control";
		$this->imagen_vehiculo03->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_vehiculo03->Upload->DbValue)) {
			$this->imagen_vehiculo03->EditValue = "viewsolicitudframe_imagen_vehiculo03_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo03->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo03->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo03->EditValue = "";
		}

		// imagen_vehiculo04
		$this->imagen_vehiculo04->EditAttrs["class"] = "form-control";
		$this->imagen_vehiculo04->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_vehiculo04->Upload->DbValue)) {
			$this->imagen_vehiculo04->EditValue = "viewsolicitudframe_imagen_vehiculo04_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo04->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo04->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo04->EditValue = "";
		}

		// imagen_vehiculo05
		$this->imagen_vehiculo05->EditAttrs["class"] = "form-control";
		$this->imagen_vehiculo05->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_vehiculo05->Upload->DbValue)) {
			$this->imagen_vehiculo05->EditValue = "viewsolicitudframe_imagen_vehiculo05_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo05->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo05->EditValue = "";
		}

		// imagen_vehiculo06
		$this->imagen_vehiculo06->EditAttrs["class"] = "form-control";
		$this->imagen_vehiculo06->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_vehiculo06->Upload->DbValue)) {
			$this->imagen_vehiculo06->EditValue = "viewsolicitudframe_imagen_vehiculo06_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo06->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo06->EditValue = "";
		}

		// imagen_vehiculo07
		$this->imagen_vehiculo07->EditAttrs["class"] = "form-control";
		$this->imagen_vehiculo07->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_vehiculo07->Upload->DbValue)) {
			$this->imagen_vehiculo07->EditValue = "viewsolicitudframe_imagen_vehiculo07_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo07->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo07->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo07->EditValue = "";
		}

		// imagen_vehiculo08
		$this->imagen_vehiculo08->EditAttrs["class"] = "form-control";
		$this->imagen_vehiculo08->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_vehiculo08->Upload->DbValue)) {
			$this->imagen_vehiculo08->EditValue = "viewsolicitudframe_imagen_vehiculo08_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo08->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo08->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo08->EditValue = "";
		}

		// tipomaquinaria
		$this->tipomaquinaria->EditAttrs["class"] = "form-control";
		$this->tipomaquinaria->EditCustomAttributes = "";

		// id_ciudad_maquinaria
		$this->id_ciudad_maquinaria->EditAttrs["class"] = "form-control";
		$this->id_ciudad_maquinaria->EditCustomAttributes = "";

		// id_provincia_maquinaria
		$this->id_provincia_maquinaria->EditAttrs["class"] = "form-control";
		$this->id_provincia_maquinaria->EditCustomAttributes = "";

		// imagen_maquinaria01
		$this->imagen_maquinaria01->EditAttrs["class"] = "form-control";
		$this->imagen_maquinaria01->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_maquinaria01->Upload->DbValue)) {
			$this->imagen_maquinaria01->EditValue = "viewsolicitudframe_imagen_maquinaria01_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria01->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria01->EditValue = "";
		}

		// imagen_maquinaria02
		$this->imagen_maquinaria02->EditAttrs["class"] = "form-control";
		$this->imagen_maquinaria02->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_maquinaria02->Upload->DbValue)) {
			$this->imagen_maquinaria02->EditValue = "viewsolicitudframe_imagen_maquinaria02_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria02->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria02->EditValue = "";
		}

		// imagen_maquinaria03
		$this->imagen_maquinaria03->EditAttrs["class"] = "form-control";
		$this->imagen_maquinaria03->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_maquinaria03->Upload->DbValue)) {
			$this->imagen_maquinaria03->EditValue = "viewsolicitudframe_imagen_maquinaria03_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria03->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria03->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria03->EditValue = "";
		}

		// imagen_maquinaria04
		$this->imagen_maquinaria04->EditAttrs["class"] = "form-control";
		$this->imagen_maquinaria04->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_maquinaria04->Upload->DbValue)) {
			$this->imagen_maquinaria04->EditValue = "viewsolicitudframe_imagen_maquinaria04_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria04->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria04->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria04->EditValue = "";
		}

		// imagen_maquinaria05
		$this->imagen_maquinaria05->EditAttrs["class"] = "form-control";
		$this->imagen_maquinaria05->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_maquinaria05->Upload->DbValue)) {
			$this->imagen_maquinaria05->EditValue = "viewsolicitudframe_imagen_maquinaria05_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria05->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria05->EditValue = "";
		}

		// imagen_maquinaria06
		$this->imagen_maquinaria06->EditAttrs["class"] = "form-control";
		$this->imagen_maquinaria06->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_maquinaria06->Upload->DbValue)) {
			$this->imagen_maquinaria06->EditValue = "viewsolicitudframe_imagen_maquinaria06_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria06->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria06->EditValue = "";
		}

		// imagen_maquinaria07
		$this->imagen_maquinaria07->EditAttrs["class"] = "form-control";
		$this->imagen_maquinaria07->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_maquinaria07->Upload->DbValue)) {
			$this->imagen_maquinaria07->EditValue = "viewsolicitudframe_imagen_maquinaria07_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria07->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria07->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria07->EditValue = "";
		}

		// imagen_maquinaria08
		$this->imagen_maquinaria08->EditAttrs["class"] = "form-control";
		$this->imagen_maquinaria08->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_maquinaria08->Upload->DbValue)) {
			$this->imagen_maquinaria08->EditValue = "viewsolicitudframe_imagen_maquinaria08_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria08->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria08->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria08->EditValue = "";
		}

		// tipomercaderia
		$this->tipomercaderia->EditAttrs["class"] = "form-control";
		$this->tipomercaderia->EditCustomAttributes = "";

		// imagen_mercaderia01
		$this->imagen_mercaderia01->EditAttrs["class"] = "form-control";
		$this->imagen_mercaderia01->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_mercaderia01->Upload->DbValue)) {
			$this->imagen_mercaderia01->EditValue = "viewsolicitudframe_imagen_mercaderia01_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_mercaderia01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_mercaderia01->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_mercaderia01->EditValue = "";
		}

		// documento_mercaderia
		$this->documento_mercaderia->EditAttrs["class"] = "form-control";
		$this->documento_mercaderia->EditCustomAttributes = "";
		$this->documento_mercaderia->EditValue = $this->documento_mercaderia->CurrentValue;
		$this->documento_mercaderia->PlaceHolder = ew_RemoveHtml($this->documento_mercaderia->FldTitle());

		// tipoespecial
		$this->tipoespecial->EditAttrs["class"] = "form-control";
		$this->tipoespecial->EditCustomAttributes = "";

		// imagen_tipoespecial01
		$this->imagen_tipoespecial01->EditAttrs["class"] = "form-control";
		$this->imagen_tipoespecial01->EditCustomAttributes = "";
		if (!ew_Empty($this->imagen_tipoespecial01->Upload->DbValue)) {
			$this->imagen_tipoespecial01->EditValue = "viewsolicitudframe_imagen_tipoespecial01_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_tipoespecial01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_tipoespecial01->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_tipoespecial01->EditValue = "";
		}

		// is_active
		$this->is_active->EditAttrs["class"] = "form-control";
		$this->is_active->EditCustomAttributes = "";
		$this->is_active->EditValue = $this->is_active->CurrentValue;
		$this->is_active->ViewCustomAttributes = "";

		// documentos
		$this->documentos->EditAttrs["class"] = "form-control";
		$this->documentos->EditCustomAttributes = "";
		$this->documentos->EditValue = $this->documentos->CurrentValue;
		$this->documentos->PlaceHolder = ew_RemoveHtml($this->documentos->FldTitle());

		// created_at
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
					if ($this->name->Exportable) $Doc->ExportCaption($this->name);
					if ($this->lastname->Exportable) $Doc->ExportCaption($this->lastname);
					if ($this->_email->Exportable) $Doc->ExportCaption($this->_email);
					if ($this->address->Exportable) $Doc->ExportCaption($this->address);
					if ($this->nombre_contacto->Exportable) $Doc->ExportCaption($this->nombre_contacto);
					if ($this->email_contacto->Exportable) $Doc->ExportCaption($this->email_contacto);
					if ($this->phone->Exportable) $Doc->ExportCaption($this->phone);
					if ($this->cell->Exportable) $Doc->ExportCaption($this->cell);
					if ($this->id_sucursal->Exportable) $Doc->ExportCaption($this->id_sucursal);
					if ($this->tipoinmueble->Exportable) $Doc->ExportCaption($this->tipoinmueble);
					if ($this->id_ciudad_inmueble->Exportable) $Doc->ExportCaption($this->id_ciudad_inmueble);
					if ($this->tipovehiculo->Exportable) $Doc->ExportCaption($this->tipovehiculo);
					if ($this->id_ciudad_vehiculo->Exportable) $Doc->ExportCaption($this->id_ciudad_vehiculo);
					if ($this->id_provincia_vehiculo->Exportable) $Doc->ExportCaption($this->id_provincia_vehiculo);
					if ($this->tipomaquinaria->Exportable) $Doc->ExportCaption($this->tipomaquinaria);
					if ($this->id_ciudad_maquinaria->Exportable) $Doc->ExportCaption($this->id_ciudad_maquinaria);
					if ($this->id_provincia_maquinaria->Exportable) $Doc->ExportCaption($this->id_provincia_maquinaria);
					if ($this->tipomercaderia->Exportable) $Doc->ExportCaption($this->tipomercaderia);
					if ($this->documento_mercaderia->Exportable) $Doc->ExportCaption($this->documento_mercaderia);
					if ($this->tipoespecial->Exportable) $Doc->ExportCaption($this->tipoespecial);
				} else {
					if ($this->id->Exportable) $Doc->ExportCaption($this->id);
					if ($this->name->Exportable) $Doc->ExportCaption($this->name);
					if ($this->lastname->Exportable) $Doc->ExportCaption($this->lastname);
					if ($this->_email->Exportable) $Doc->ExportCaption($this->_email);
					if ($this->address->Exportable) $Doc->ExportCaption($this->address);
					if ($this->email_contacto->Exportable) $Doc->ExportCaption($this->email_contacto);
					if ($this->phone->Exportable) $Doc->ExportCaption($this->phone);
					if ($this->cell->Exportable) $Doc->ExportCaption($this->cell);
					if ($this->id_sucursal->Exportable) $Doc->ExportCaption($this->id_sucursal);
					if ($this->tipomercaderia->Exportable) $Doc->ExportCaption($this->tipomercaderia);
					if ($this->tipoespecial->Exportable) $Doc->ExportCaption($this->tipoespecial);
					if ($this->documentos->Exportable) $Doc->ExportCaption($this->documentos);
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
						if ($this->name->Exportable) $Doc->ExportField($this->name);
						if ($this->lastname->Exportable) $Doc->ExportField($this->lastname);
						if ($this->_email->Exportable) $Doc->ExportField($this->_email);
						if ($this->address->Exportable) $Doc->ExportField($this->address);
						if ($this->nombre_contacto->Exportable) $Doc->ExportField($this->nombre_contacto);
						if ($this->email_contacto->Exportable) $Doc->ExportField($this->email_contacto);
						if ($this->phone->Exportable) $Doc->ExportField($this->phone);
						if ($this->cell->Exportable) $Doc->ExportField($this->cell);
						if ($this->id_sucursal->Exportable) $Doc->ExportField($this->id_sucursal);
						if ($this->tipoinmueble->Exportable) $Doc->ExportField($this->tipoinmueble);
						if ($this->id_ciudad_inmueble->Exportable) $Doc->ExportField($this->id_ciudad_inmueble);
						if ($this->tipovehiculo->Exportable) $Doc->ExportField($this->tipovehiculo);
						if ($this->id_ciudad_vehiculo->Exportable) $Doc->ExportField($this->id_ciudad_vehiculo);
						if ($this->id_provincia_vehiculo->Exportable) $Doc->ExportField($this->id_provincia_vehiculo);
						if ($this->tipomaquinaria->Exportable) $Doc->ExportField($this->tipomaquinaria);
						if ($this->id_ciudad_maquinaria->Exportable) $Doc->ExportField($this->id_ciudad_maquinaria);
						if ($this->id_provincia_maquinaria->Exportable) $Doc->ExportField($this->id_provincia_maquinaria);
						if ($this->tipomercaderia->Exportable) $Doc->ExportField($this->tipomercaderia);
						if ($this->documento_mercaderia->Exportable) $Doc->ExportField($this->documento_mercaderia);
						if ($this->tipoespecial->Exportable) $Doc->ExportField($this->tipoespecial);
					} else {
						if ($this->id->Exportable) $Doc->ExportField($this->id);
						if ($this->name->Exportable) $Doc->ExportField($this->name);
						if ($this->lastname->Exportable) $Doc->ExportField($this->lastname);
						if ($this->_email->Exportable) $Doc->ExportField($this->_email);
						if ($this->address->Exportable) $Doc->ExportField($this->address);
						if ($this->email_contacto->Exportable) $Doc->ExportField($this->email_contacto);
						if ($this->phone->Exportable) $Doc->ExportField($this->phone);
						if ($this->cell->Exportable) $Doc->ExportField($this->cell);
						if ($this->id_sucursal->Exportable) $Doc->ExportField($this->id_sucursal);
						if ($this->tipomercaderia->Exportable) $Doc->ExportField($this->tipomercaderia);
						if ($this->tipoespecial->Exportable) $Doc->ExportField($this->tipoespecial);
						if ($this->documentos->Exportable) $Doc->ExportField($this->documentos);
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
