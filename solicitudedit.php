<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "solicitudinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "avaluogridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$solicitud_edit = NULL; // Initialize page object first

class csolicitud_edit extends csolicitud {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'solicitud';

	// Page object name
	var $PageObjName = 'solicitud_edit';

	// Page headings
	var $Heading = '';
	var $Subheading = '';

	// Page heading
	function PageHeading() {
		global $Language;
		if ($this->Heading <> "")
			return $this->Heading;
		if (method_exists($this, "TableCaption"))
			return $this->TableCaption();
		return "";
	}

	// Page subheading
	function PageSubheading() {
		global $Language;
		if ($this->Subheading <> "")
			return $this->Subheading;
		if ($this->TableName)
			return $Language->Phrase($this->PageID);
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
		if ($this->UseTokenInUrl) $PageUrl .= "t=" . $this->TableVar . "&"; // Add page token
		return $PageUrl;
	}

	// Message
	function getMessage() {
		return @$_SESSION[EW_SESSION_MESSAGE];
	}

	function setMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_MESSAGE], $v);
	}

	function getFailureMessage() {
		return @$_SESSION[EW_SESSION_FAILURE_MESSAGE];
	}

	function setFailureMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_FAILURE_MESSAGE], $v);
	}

	function getSuccessMessage() {
		return @$_SESSION[EW_SESSION_SUCCESS_MESSAGE];
	}

	function setSuccessMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_SUCCESS_MESSAGE], $v);
	}

	function getWarningMessage() {
		return @$_SESSION[EW_SESSION_WARNING_MESSAGE];
	}

	function setWarningMessage($v) {
		ew_AddMessage($_SESSION[EW_SESSION_WARNING_MESSAGE], $v);
	}

	// Methods to clear message
	function ClearMessage() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
	}

	function ClearFailureMessage() {
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
	}

	function ClearSuccessMessage() {
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
	}

	function ClearWarningMessage() {
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	function ClearMessages() {
		$_SESSION[EW_SESSION_MESSAGE] = "";
		$_SESSION[EW_SESSION_FAILURE_MESSAGE] = "";
		$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = "";
		$_SESSION[EW_SESSION_WARNING_MESSAGE] = "";
	}

	// Show message
	function ShowMessage() {
		$hidden = FALSE;
		$html = "";

		// Message
		$sMessage = $this->getMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sMessage, "");
		if ($sMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sMessage;
			$html .= "<div class=\"alert alert-info ewInfo\">" . $sMessage . "</div>";
			$_SESSION[EW_SESSION_MESSAGE] = ""; // Clear message in Session
		}

		// Warning message
		$sWarningMessage = $this->getWarningMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sWarningMessage, "warning");
		if ($sWarningMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sWarningMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sWarningMessage;
			$html .= "<div class=\"alert alert-warning ewWarning\">" . $sWarningMessage . "</div>";
			$_SESSION[EW_SESSION_WARNING_MESSAGE] = ""; // Clear message in Session
		}

		// Success message
		$sSuccessMessage = $this->getSuccessMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sSuccessMessage, "success");
		if ($sSuccessMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sSuccessMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sSuccessMessage;
			$html .= "<div class=\"alert alert-success ewSuccess\">" . $sSuccessMessage . "</div>";
			$_SESSION[EW_SESSION_SUCCESS_MESSAGE] = ""; // Clear message in Session
		}

		// Failure message
		$sErrorMessage = $this->getFailureMessage();
		if (method_exists($this, "Message_Showing"))
			$this->Message_Showing($sErrorMessage, "failure");
		if ($sErrorMessage <> "") { // Message in Session, display
			if (!$hidden)
				$sErrorMessage = "<button type=\"button\" class=\"close\" data-dismiss=\"alert\">&times;</button>" . $sErrorMessage;
			$html .= "<div class=\"alert alert-danger ewError\">" . $sErrorMessage . "</div>";
			$_SESSION[EW_SESSION_FAILURE_MESSAGE] = ""; // Clear message in Session
		}
		echo "<div class=\"ewMessageDialog\"" . (($hidden) ? " style=\"display: none;\"" : "") . ">" . $html . "</div>";
	}
	var $PageHeader;
	var $PageFooter;

	// Show Page Header
	function ShowPageHeader() {
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		if ($sHeader <> "") { // Header exists, display
			echo "<p>" . $sHeader . "</p>";
		}
	}

	// Show Page Footer
	function ShowPageFooter() {
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		if ($sFooter <> "") { // Footer exists, display
			echo "<p>" . $sFooter . "</p>";
		}
	}

	// Validate page request
	function IsPageRequest() {
		global $objForm;
		if ($this->UseTokenInUrl) {
			if ($objForm)
				return ($this->TableVar == $objForm->GetValue("t"));
			if (@$_GET["t"] <> "")
				return ($this->TableVar == $_GET["t"]);
		} else {
			return TRUE;
		}
	}
	var $Token = "";
	var $TokenTimeout = 0;
	var $CheckToken = EW_CHECK_TOKEN;
	var $CheckTokenFn = "ew_CheckToken";
	var $CreateTokenFn = "ew_CreateToken";

	// Valid Post
	function ValidPost() {
		if (!$this->CheckToken || !ew_IsPost())
			return TRUE;
		if (!isset($_POST[EW_TOKEN_NAME]))
			return FALSE;
		$fn = $this->CheckTokenFn;
		if (is_callable($fn))
			return $fn($_POST[EW_TOKEN_NAME], $this->TokenTimeout);
		return FALSE;
	}

	// Create Token
	function CreateToken() {
		global $gsToken;
		if ($this->CheckToken) {
			$fn = $this->CreateTokenFn;
			if ($this->Token == "" && is_callable($fn)) // Create token
				$this->Token = $fn();
			$gsToken = $this->Token; // Save to global variable
		}
	}

	//
	// Page class constructor
	//
	function __construct() {
		global $conn, $Language;
		global $UserTable, $UserTableConn;
		$GLOBALS["Page"] = &$this;
		$this->TokenTimeout = ew_SessionTimeoutTime();

		// Language object
		if (!isset($Language)) $Language = new cLanguage();

		// Parent constuctor
		parent::__construct();

		// Table object (solicitud)
		if (!isset($GLOBALS["solicitud"]) || get_class($GLOBALS["solicitud"]) == "csolicitud") {
			$GLOBALS["solicitud"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["solicitud"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'solicitud', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect($this->DBID);

		// User table object (usuario)
		if (!isset($UserTable)) {
			$UserTable = new cusuario();
			$UserTableConn = Conn($UserTable->DBID);
		}
	}

	//
	//  Page_Init
	//
	function Page_Init() {
		global $gsExport, $gsCustomExport, $gsExportFile, $UserProfile, $Language, $Security, $objForm;

		// Is modal
		$this->IsModal = (@$_GET["modal"] == "1" || @$_POST["modal"] == "1");

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanEdit()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("solicitudlist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
		}

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 
		// Create form object

		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->nombre_contacto->SetVisibility();
		$this->name->SetVisibility();
		$this->lastname->SetVisibility();
		$this->_email->SetVisibility();
		$this->address->SetVisibility();
		$this->phone->SetVisibility();
		$this->cell->SetVisibility();
		$this->created_at->SetVisibility();
		$this->id_sucursal->SetVisibility();
		$this->tipoinmueble->SetVisibility();
		$this->id_ciudad_inmueble->SetVisibility();
		$this->id_provincia_inmueble->SetVisibility();
		$this->imagen_inmueble02->SetVisibility();
		$this->imagen_inmueble03->SetVisibility();
		$this->imagen_inmueble04->SetVisibility();
		$this->imagen_inmueble05->SetVisibility();
		$this->tipovehiculo->SetVisibility();
		$this->id_ciudad_vehiculo->SetVisibility();
		$this->id_provincia_vehiculo->SetVisibility();
		$this->imagen_vehiculo02->SetVisibility();
		$this->imagen_vehiculo03->SetVisibility();
		$this->imagen_vehiculo05->SetVisibility();
		$this->imagen_vehiculo06->SetVisibility();
		$this->imagen_vehiculo07->SetVisibility();
		$this->tipomaquinaria->SetVisibility();
		$this->id_ciudad_maquinaria->SetVisibility();
		$this->id_provincia_maquinaria->SetVisibility();
		$this->imagen_maquinaria02->SetVisibility();
		$this->imagen_maquinaria05->SetVisibility();
		$this->imagen_maquinaria06->SetVisibility();
		$this->imagen_maquinaria07->SetVisibility();
		$this->tipomercaderia->SetVisibility();
		$this->imagen_mercaderia01->SetVisibility();
		$this->documento_mercaderia->SetVisibility();
		$this->tipoespecial->SetVisibility();
		$this->imagen_tipoespecial01->SetVisibility();
		$this->email_contacto->SetVisibility();

		// Set up multi page object
		$this->SetupMultiPages();

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Page Load event
		$this->Page_Load();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Process auto fill
		if (@$_POST["ajax"] == "autofill") {

			// Get the keys for master table
			$sDetailTblVar = $this->getCurrentDetailTable();
			if ($sDetailTblVar <> "") {
				$DetailTblVar = explode(",", $sDetailTblVar);
				if (in_array("avaluo", $DetailTblVar)) {

					// Process auto fill for detail table 'avaluo'
					if (preg_match('/^favaluo(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["avaluo_grid"])) $GLOBALS["avaluo_grid"] = new cavaluo_grid;
						$GLOBALS["avaluo_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
			}
			$results = $this->GetAutoFill(@$_POST["name"], @$_POST["q"]);
			if ($results) {

				// Clean output buffer
				if (!EW_DEBUG_ENABLED && ob_get_length())
					ob_end_clean();
				echo $results;
				$this->Page_Terminate();
				exit();
			}
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $solicitud;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($solicitud);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
		$this->Page_Redirecting($url);

		// Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();

			// Handle modal response
			if ($this->IsModal) { // Show as modal
				$row = array("url" => $url, "modal" => "1");
				$pageName = ew_GetPageName($url);
				if ($pageName != $this->GetListUrl()) { // Not List page
					$row["caption"] = $this->GetModalCaption($pageName);
					if ($pageName == "solicitudview.php")
						$row["view"] = "1";
				} else { // List page should not be shown as modal => error
					$row["error"] = $this->getFailureMessage();
					$this->clearFailureMessage();
				}
				header("Content-Type: application/json; charset=utf-8");
				echo ew_ConvertToUtf8(ew_ArrayToJson(array($row)));
			} else {
				ew_SaveDebugMsg();
				header("Location: " . $url);
			}
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewEditForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter;
	var $DbDetailFilter;
	var $MultiPages; // Multi pages object

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewEditForm form-horizontal";
		$sReturnUrl = "";
		$loaded = FALSE;
		$postBack = FALSE;

		// Set up current action and primary key
		if (@$_POST["a_edit"] <> "") {
			$this->CurrentAction = $_POST["a_edit"]; // Get action code
			if ($this->CurrentAction <> "I") // Not reload record, handle as postback
				$postBack = TRUE;

			// Load key from Form
			if ($objForm->HasValue("x_id")) {
				$this->id->setFormValue($objForm->GetValue("x_id"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["id"])) {
				$this->id->setQueryStringValue($_GET["id"]);
				$loadByQuery = TRUE;
			} else {
				$this->id->CurrentValue = NULL;
			}
		}

		// Load current record
		$loaded = $this->LoadRow();

		// Process form if post back
		if ($postBack) {
			$this->LoadFormValues(); // Get form values

			// Set up detail parameters
			$this->SetupDetailParms();
		}

		// Validate form if post back
		if ($postBack) {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = ""; // Form error, reset action
				$this->setFailureMessage($gsFormError);
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues();
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Get a record to display
				if (!$loaded) { // Load record based on key
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("solicitudlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			Case "U": // Update
				if ($this->getCurrentDetailTable() <> "") // Master/detail edit
					$sReturnUrl = $this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "solicitudlist.php")
					$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
				$this->SendEmail = TRUE; // Send email on update success
				if ($this->EditRow()) { // Update record based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Update success
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} elseif ($this->getFailureMessage() == $Language->Phrase("NoRecord")) {
					$this->Page_Terminate($sReturnUrl); // Return to caller
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Restore form values if update failed

					// Set up detail parameters
					$this->SetupDetailParms();
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render the record
		$this->RowType = EW_ROWTYPE_EDIT; // Render as Edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Set up starting record parameters
	function SetupStartRec() {
		if ($this->DisplayRecs == 0)
			return;
		if ($this->IsPageRequest()) { // Validate request
			if (@$_GET[EW_TABLE_START_REC] <> "") { // Check for "start" parameter
				$this->StartRec = $_GET[EW_TABLE_START_REC];
				$this->setStartRecordNumber($this->StartRec);
			} elseif (@$_GET[EW_TABLE_PAGE_NO] <> "") {
				$PageNo = $_GET[EW_TABLE_PAGE_NO];
				if (is_numeric($PageNo)) {
					$this->StartRec = ($PageNo-1)*$this->DisplayRecs+1;
					if ($this->StartRec <= 0) {
						$this->StartRec = 1;
					} elseif ($this->StartRec >= intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1) {
						$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1;
					}
					$this->setStartRecordNumber($this->StartRec);
				}
			}
		}
		$this->StartRec = $this->getStartRecordNumber();

		// Check if correct start record counter
		if (!is_numeric($this->StartRec) || $this->StartRec == "") { // Avoid invalid start record counter
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif (intval($this->StartRec) > intval($this->TotalRecs)) { // Avoid starting record > total records
			$this->StartRec = intval(($this->TotalRecs-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to last page first record
			$this->setStartRecordNumber($this->StartRec);
		} elseif (($this->StartRec-1) % $this->DisplayRecs <> 0) {
			$this->StartRec = intval(($this->StartRec-1)/$this->DisplayRecs)*$this->DisplayRecs+1; // Point to page boundary
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
		$this->imagen_inmueble02->Upload->Index = $objForm->Index;
		$this->imagen_inmueble02->Upload->UploadFile();
		$this->imagen_inmueble03->Upload->Index = $objForm->Index;
		$this->imagen_inmueble03->Upload->UploadFile();
		$this->imagen_inmueble04->Upload->Index = $objForm->Index;
		$this->imagen_inmueble04->Upload->UploadFile();
		$this->imagen_inmueble05->Upload->Index = $objForm->Index;
		$this->imagen_inmueble05->Upload->UploadFile();
		$this->imagen_vehiculo02->Upload->Index = $objForm->Index;
		$this->imagen_vehiculo02->Upload->UploadFile();
		$this->imagen_vehiculo03->Upload->Index = $objForm->Index;
		$this->imagen_vehiculo03->Upload->UploadFile();
		$this->imagen_vehiculo05->Upload->Index = $objForm->Index;
		$this->imagen_vehiculo05->Upload->UploadFile();
		$this->imagen_vehiculo06->Upload->Index = $objForm->Index;
		$this->imagen_vehiculo06->Upload->UploadFile();
		$this->imagen_vehiculo07->Upload->Index = $objForm->Index;
		$this->imagen_vehiculo07->Upload->UploadFile();
		$this->imagen_maquinaria02->Upload->Index = $objForm->Index;
		$this->imagen_maquinaria02->Upload->UploadFile();
		$this->imagen_maquinaria05->Upload->Index = $objForm->Index;
		$this->imagen_maquinaria05->Upload->UploadFile();
		$this->imagen_maquinaria06->Upload->Index = $objForm->Index;
		$this->imagen_maquinaria06->Upload->UploadFile();
		$this->imagen_maquinaria07->Upload->Index = $objForm->Index;
		$this->imagen_maquinaria07->Upload->UploadFile();
		$this->imagen_mercaderia01->Upload->Index = $objForm->Index;
		$this->imagen_mercaderia01->Upload->UploadFile();
		$this->imagen_tipoespecial01->Upload->Index = $objForm->Index;
		$this->imagen_tipoespecial01->Upload->UploadFile();
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->nombre_contacto->FldIsDetailKey) {
			$this->nombre_contacto->setFormValue($objForm->GetValue("x_nombre_contacto"));
		}
		if (!$this->name->FldIsDetailKey) {
			$this->name->setFormValue($objForm->GetValue("x_name"));
		}
		if (!$this->lastname->FldIsDetailKey) {
			$this->lastname->setFormValue($objForm->GetValue("x_lastname"));
		}
		if (!$this->_email->FldIsDetailKey) {
			$this->_email->setFormValue($objForm->GetValue("x__email"));
		}
		if (!$this->address->FldIsDetailKey) {
			$this->address->setFormValue($objForm->GetValue("x_address"));
		}
		if (!$this->phone->FldIsDetailKey) {
			$this->phone->setFormValue($objForm->GetValue("x_phone"));
		}
		if (!$this->cell->FldIsDetailKey) {
			$this->cell->setFormValue($objForm->GetValue("x_cell"));
		}
		if (!$this->created_at->FldIsDetailKey) {
			$this->created_at->setFormValue($objForm->GetValue("x_created_at"));
			$this->created_at->CurrentValue = ew_UnFormatDateTime($this->created_at->CurrentValue, 17);
		}
		if (!$this->id_sucursal->FldIsDetailKey) {
			$this->id_sucursal->setFormValue($objForm->GetValue("x_id_sucursal"));
		}
		if (!$this->tipoinmueble->FldIsDetailKey) {
			$this->tipoinmueble->setFormValue($objForm->GetValue("x_tipoinmueble"));
		}
		if (!$this->id_ciudad_inmueble->FldIsDetailKey) {
			$this->id_ciudad_inmueble->setFormValue($objForm->GetValue("x_id_ciudad_inmueble"));
		}
		if (!$this->id_provincia_inmueble->FldIsDetailKey) {
			$this->id_provincia_inmueble->setFormValue($objForm->GetValue("x_id_provincia_inmueble"));
		}
		if (!$this->tipovehiculo->FldIsDetailKey) {
			$this->tipovehiculo->setFormValue($objForm->GetValue("x_tipovehiculo"));
		}
		if (!$this->id_ciudad_vehiculo->FldIsDetailKey) {
			$this->id_ciudad_vehiculo->setFormValue($objForm->GetValue("x_id_ciudad_vehiculo"));
		}
		if (!$this->id_provincia_vehiculo->FldIsDetailKey) {
			$this->id_provincia_vehiculo->setFormValue($objForm->GetValue("x_id_provincia_vehiculo"));
		}
		if (!$this->tipomaquinaria->FldIsDetailKey) {
			$this->tipomaquinaria->setFormValue($objForm->GetValue("x_tipomaquinaria"));
		}
		if (!$this->id_ciudad_maquinaria->FldIsDetailKey) {
			$this->id_ciudad_maquinaria->setFormValue($objForm->GetValue("x_id_ciudad_maquinaria"));
		}
		if (!$this->id_provincia_maquinaria->FldIsDetailKey) {
			$this->id_provincia_maquinaria->setFormValue($objForm->GetValue("x_id_provincia_maquinaria"));
		}
		if (!$this->tipomercaderia->FldIsDetailKey) {
			$this->tipomercaderia->setFormValue($objForm->GetValue("x_tipomercaderia"));
		}
		if (!$this->documento_mercaderia->FldIsDetailKey) {
			$this->documento_mercaderia->setFormValue($objForm->GetValue("x_documento_mercaderia"));
		}
		if (!$this->tipoespecial->FldIsDetailKey) {
			$this->tipoespecial->setFormValue($objForm->GetValue("x_tipoespecial"));
		}
		if (!$this->email_contacto->FldIsDetailKey) {
			$this->email_contacto->setFormValue($objForm->GetValue("x_email_contacto"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->nombre_contacto->CurrentValue = $this->nombre_contacto->FormValue;
		$this->name->CurrentValue = $this->name->FormValue;
		$this->lastname->CurrentValue = $this->lastname->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->address->CurrentValue = $this->address->FormValue;
		$this->phone->CurrentValue = $this->phone->FormValue;
		$this->cell->CurrentValue = $this->cell->FormValue;
		$this->created_at->CurrentValue = $this->created_at->FormValue;
		$this->created_at->CurrentValue = ew_UnFormatDateTime($this->created_at->CurrentValue, 17);
		$this->id_sucursal->CurrentValue = $this->id_sucursal->FormValue;
		$this->tipoinmueble->CurrentValue = $this->tipoinmueble->FormValue;
		$this->id_ciudad_inmueble->CurrentValue = $this->id_ciudad_inmueble->FormValue;
		$this->id_provincia_inmueble->CurrentValue = $this->id_provincia_inmueble->FormValue;
		$this->tipovehiculo->CurrentValue = $this->tipovehiculo->FormValue;
		$this->id_ciudad_vehiculo->CurrentValue = $this->id_ciudad_vehiculo->FormValue;
		$this->id_provincia_vehiculo->CurrentValue = $this->id_provincia_vehiculo->FormValue;
		$this->tipomaquinaria->CurrentValue = $this->tipomaquinaria->FormValue;
		$this->id_ciudad_maquinaria->CurrentValue = $this->id_ciudad_maquinaria->FormValue;
		$this->id_provincia_maquinaria->CurrentValue = $this->id_provincia_maquinaria->FormValue;
		$this->tipomercaderia->CurrentValue = $this->tipomercaderia->FormValue;
		$this->documento_mercaderia->CurrentValue = $this->documento_mercaderia->FormValue;
		$this->tipoespecial->CurrentValue = $this->tipoespecial->FormValue;
		$this->email_contacto->CurrentValue = $this->email_contacto->FormValue;
	}

	// Load row based on key values
	function LoadRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();

		// Call Row Selecting event
		$this->Row_Selecting($sFilter);

		// Load SQL based on filter
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$res = FALSE;
		$rs = ew_LoadRecordset($sSql, $conn);
		if ($rs && !$rs->EOF) {
			$res = TRUE;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
		}
		return $res;
	}

	// Load row values from recordset
	function LoadRowValues($rs = NULL) {
		if ($rs && !$rs->EOF)
			$row = $rs->fields;
		else
			$row = $this->NewRow(); 

		// Call Row Selected event
		$this->Row_Selected($row);
		if (!$rs || $rs->EOF)
			return;
		$this->id->setDbValue($row['id']);
		$this->nombre_contacto->setDbValue($row['nombre_contacto']);
		$this->name->setDbValue($row['name']);
		$this->lastname->setDbValue($row['lastname']);
		$this->_email->setDbValue($row['email']);
		$this->address->setDbValue($row['address']);
		$this->phone->setDbValue($row['phone']);
		$this->cell->setDbValue($row['cell']);
		$this->is_active->setDbValue($row['is_active']);
		$this->created_at->setDbValue($row['created_at']);
		$this->id_sucursal->setDbValue($row['id_sucursal']);
		$this->documentos->setDbValue($row['documentos']);
		$this->DateModified->setDbValue($row['DateModified']);
		$this->DateDeleted->setDbValue($row['DateDeleted']);
		$this->CreatedBy->setDbValue($row['CreatedBy']);
		$this->ModifiedBy->setDbValue($row['ModifiedBy']);
		$this->DeletedBy->setDbValue($row['DeletedBy']);
		$this->latitud->setDbValue($row['latitud']);
		$this->longitud->setDbValue($row['longitud']);
		$this->tipoinmueble->setDbValue($row['tipoinmueble']);
		$this->id_ciudad_inmueble->setDbValue($row['id_ciudad_inmueble']);
		$this->id_provincia_inmueble->setDbValue($row['id_provincia_inmueble']);
		$this->imagen_inmueble01->Upload->DbValue = $row['imagen_inmueble01'];
		if (is_array($this->imagen_inmueble01->Upload->DbValue) || is_object($this->imagen_inmueble01->Upload->DbValue)) // Byte array
			$this->imagen_inmueble01->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble01->Upload->DbValue);
		$this->imagen_inmueble02->Upload->DbValue = $row['imagen_inmueble02'];
		if (is_array($this->imagen_inmueble02->Upload->DbValue) || is_object($this->imagen_inmueble02->Upload->DbValue)) // Byte array
			$this->imagen_inmueble02->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble02->Upload->DbValue);
		$this->imagen_inmueble03->Upload->DbValue = $row['imagen_inmueble03'];
		if (is_array($this->imagen_inmueble03->Upload->DbValue) || is_object($this->imagen_inmueble03->Upload->DbValue)) // Byte array
			$this->imagen_inmueble03->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble03->Upload->DbValue);
		$this->imagen_inmueble04->Upload->DbValue = $row['imagen_inmueble04'];
		if (is_array($this->imagen_inmueble04->Upload->DbValue) || is_object($this->imagen_inmueble04->Upload->DbValue)) // Byte array
			$this->imagen_inmueble04->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble04->Upload->DbValue);
		$this->imagen_inmueble05->Upload->DbValue = $row['imagen_inmueble05'];
		if (is_array($this->imagen_inmueble05->Upload->DbValue) || is_object($this->imagen_inmueble05->Upload->DbValue)) // Byte array
			$this->imagen_inmueble05->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble05->Upload->DbValue);
		$this->imagen_inmueble06->Upload->DbValue = $row['imagen_inmueble06'];
		if (is_array($this->imagen_inmueble06->Upload->DbValue) || is_object($this->imagen_inmueble06->Upload->DbValue)) // Byte array
			$this->imagen_inmueble06->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble06->Upload->DbValue);
		$this->imagen_inmueble07->Upload->DbValue = $row['imagen_inmueble07'];
		if (is_array($this->imagen_inmueble07->Upload->DbValue) || is_object($this->imagen_inmueble07->Upload->DbValue)) // Byte array
			$this->imagen_inmueble07->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble07->Upload->DbValue);
		$this->imagen_inmueble08->Upload->DbValue = $row['imagen_inmueble08'];
		if (is_array($this->imagen_inmueble08->Upload->DbValue) || is_object($this->imagen_inmueble08->Upload->DbValue)) // Byte array
			$this->imagen_inmueble08->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble08->Upload->DbValue);
		$this->tipovehiculo->setDbValue($row['tipovehiculo']);
		$this->id_ciudad_vehiculo->setDbValue($row['id_ciudad_vehiculo']);
		$this->id_provincia_vehiculo->setDbValue($row['id_provincia_vehiculo']);
		$this->imagen_vehiculo01->Upload->DbValue = $row['imagen_vehiculo01'];
		if (is_array($this->imagen_vehiculo01->Upload->DbValue) || is_object($this->imagen_vehiculo01->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo01->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo01->Upload->DbValue);
		$this->imagen_vehiculo02->Upload->DbValue = $row['imagen_vehiculo02'];
		if (is_array($this->imagen_vehiculo02->Upload->DbValue) || is_object($this->imagen_vehiculo02->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo02->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo02->Upload->DbValue);
		$this->imagen_vehiculo03->Upload->DbValue = $row['imagen_vehiculo03'];
		if (is_array($this->imagen_vehiculo03->Upload->DbValue) || is_object($this->imagen_vehiculo03->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo03->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo03->Upload->DbValue);
		$this->imagen_vehiculo04->Upload->DbValue = $row['imagen_vehiculo04'];
		if (is_array($this->imagen_vehiculo04->Upload->DbValue) || is_object($this->imagen_vehiculo04->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo04->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo04->Upload->DbValue);
		$this->imagen_vehiculo05->Upload->DbValue = $row['imagen_vehiculo05'];
		if (is_array($this->imagen_vehiculo05->Upload->DbValue) || is_object($this->imagen_vehiculo05->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo05->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo05->Upload->DbValue);
		$this->imagen_vehiculo06->Upload->DbValue = $row['imagen_vehiculo06'];
		if (is_array($this->imagen_vehiculo06->Upload->DbValue) || is_object($this->imagen_vehiculo06->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo06->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo06->Upload->DbValue);
		$this->imagen_vehiculo07->Upload->DbValue = $row['imagen_vehiculo07'];
		if (is_array($this->imagen_vehiculo07->Upload->DbValue) || is_object($this->imagen_vehiculo07->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo07->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo07->Upload->DbValue);
		$this->imagen_vehiculo08->Upload->DbValue = $row['imagen_vehiculo08'];
		if (is_array($this->imagen_vehiculo08->Upload->DbValue) || is_object($this->imagen_vehiculo08->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo08->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo08->Upload->DbValue);
		$this->tipomaquinaria->setDbValue($row['tipomaquinaria']);
		$this->id_ciudad_maquinaria->setDbValue($row['id_ciudad_maquinaria']);
		$this->id_provincia_maquinaria->setDbValue($row['id_provincia_maquinaria']);
		$this->imagen_maquinaria01->Upload->DbValue = $row['imagen_maquinaria01'];
		if (is_array($this->imagen_maquinaria01->Upload->DbValue) || is_object($this->imagen_maquinaria01->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria01->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria01->Upload->DbValue);
		$this->imagen_maquinaria02->Upload->DbValue = $row['imagen_maquinaria02'];
		if (is_array($this->imagen_maquinaria02->Upload->DbValue) || is_object($this->imagen_maquinaria02->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria02->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria02->Upload->DbValue);
		$this->imagen_maquinaria03->Upload->DbValue = $row['imagen_maquinaria03'];
		if (is_array($this->imagen_maquinaria03->Upload->DbValue) || is_object($this->imagen_maquinaria03->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria03->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria03->Upload->DbValue);
		$this->imagen_maquinaria04->Upload->DbValue = $row['imagen_maquinaria04'];
		if (is_array($this->imagen_maquinaria04->Upload->DbValue) || is_object($this->imagen_maquinaria04->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria04->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria04->Upload->DbValue);
		$this->imagen_maquinaria05->Upload->DbValue = $row['imagen_maquinaria05'];
		if (is_array($this->imagen_maquinaria05->Upload->DbValue) || is_object($this->imagen_maquinaria05->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria05->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria05->Upload->DbValue);
		$this->imagen_maquinaria06->Upload->DbValue = $row['imagen_maquinaria06'];
		if (is_array($this->imagen_maquinaria06->Upload->DbValue) || is_object($this->imagen_maquinaria06->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria06->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria06->Upload->DbValue);
		$this->imagen_maquinaria07->Upload->DbValue = $row['imagen_maquinaria07'];
		if (is_array($this->imagen_maquinaria07->Upload->DbValue) || is_object($this->imagen_maquinaria07->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria07->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria07->Upload->DbValue);
		$this->imagen_maquinaria08->Upload->DbValue = $row['imagen_maquinaria08'];
		if (is_array($this->imagen_maquinaria08->Upload->DbValue) || is_object($this->imagen_maquinaria08->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria08->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria08->Upload->DbValue);
		$this->tipomercaderia->setDbValue($row['tipomercaderia']);
		$this->imagen_mercaderia01->Upload->DbValue = $row['imagen_mercaderia01'];
		if (is_array($this->imagen_mercaderia01->Upload->DbValue) || is_object($this->imagen_mercaderia01->Upload->DbValue)) // Byte array
			$this->imagen_mercaderia01->Upload->DbValue = ew_BytesToStr($this->imagen_mercaderia01->Upload->DbValue);
		$this->documento_mercaderia->setDbValue($row['documento_mercaderia']);
		$this->tipoespecial->setDbValue($row['tipoespecial']);
		$this->imagen_tipoespecial01->Upload->DbValue = $row['imagen_tipoespecial01'];
		if (is_array($this->imagen_tipoespecial01->Upload->DbValue) || is_object($this->imagen_tipoespecial01->Upload->DbValue)) // Byte array
			$this->imagen_tipoespecial01->Upload->DbValue = ew_BytesToStr($this->imagen_tipoespecial01->Upload->DbValue);
		$this->email_contacto->setDbValue($row['email_contacto']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['nombre_contacto'] = NULL;
		$row['name'] = NULL;
		$row['lastname'] = NULL;
		$row['email'] = NULL;
		$row['address'] = NULL;
		$row['phone'] = NULL;
		$row['cell'] = NULL;
		$row['is_active'] = NULL;
		$row['created_at'] = NULL;
		$row['id_sucursal'] = NULL;
		$row['documentos'] = NULL;
		$row['DateModified'] = NULL;
		$row['DateDeleted'] = NULL;
		$row['CreatedBy'] = NULL;
		$row['ModifiedBy'] = NULL;
		$row['DeletedBy'] = NULL;
		$row['latitud'] = NULL;
		$row['longitud'] = NULL;
		$row['tipoinmueble'] = NULL;
		$row['id_ciudad_inmueble'] = NULL;
		$row['id_provincia_inmueble'] = NULL;
		$row['imagen_inmueble01'] = NULL;
		$row['imagen_inmueble02'] = NULL;
		$row['imagen_inmueble03'] = NULL;
		$row['imagen_inmueble04'] = NULL;
		$row['imagen_inmueble05'] = NULL;
		$row['imagen_inmueble06'] = NULL;
		$row['imagen_inmueble07'] = NULL;
		$row['imagen_inmueble08'] = NULL;
		$row['tipovehiculo'] = NULL;
		$row['id_ciudad_vehiculo'] = NULL;
		$row['id_provincia_vehiculo'] = NULL;
		$row['imagen_vehiculo01'] = NULL;
		$row['imagen_vehiculo02'] = NULL;
		$row['imagen_vehiculo03'] = NULL;
		$row['imagen_vehiculo04'] = NULL;
		$row['imagen_vehiculo05'] = NULL;
		$row['imagen_vehiculo06'] = NULL;
		$row['imagen_vehiculo07'] = NULL;
		$row['imagen_vehiculo08'] = NULL;
		$row['tipomaquinaria'] = NULL;
		$row['id_ciudad_maquinaria'] = NULL;
		$row['id_provincia_maquinaria'] = NULL;
		$row['imagen_maquinaria01'] = NULL;
		$row['imagen_maquinaria02'] = NULL;
		$row['imagen_maquinaria03'] = NULL;
		$row['imagen_maquinaria04'] = NULL;
		$row['imagen_maquinaria05'] = NULL;
		$row['imagen_maquinaria06'] = NULL;
		$row['imagen_maquinaria07'] = NULL;
		$row['imagen_maquinaria08'] = NULL;
		$row['tipomercaderia'] = NULL;
		$row['imagen_mercaderia01'] = NULL;
		$row['documento_mercaderia'] = NULL;
		$row['tipoespecial'] = NULL;
		$row['imagen_tipoespecial01'] = NULL;
		$row['email_contacto'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->nombre_contacto->DbValue = $row['nombre_contacto'];
		$this->name->DbValue = $row['name'];
		$this->lastname->DbValue = $row['lastname'];
		$this->_email->DbValue = $row['email'];
		$this->address->DbValue = $row['address'];
		$this->phone->DbValue = $row['phone'];
		$this->cell->DbValue = $row['cell'];
		$this->is_active->DbValue = $row['is_active'];
		$this->created_at->DbValue = $row['created_at'];
		$this->id_sucursal->DbValue = $row['id_sucursal'];
		$this->documentos->DbValue = $row['documentos'];
		$this->DateModified->DbValue = $row['DateModified'];
		$this->DateDeleted->DbValue = $row['DateDeleted'];
		$this->CreatedBy->DbValue = $row['CreatedBy'];
		$this->ModifiedBy->DbValue = $row['ModifiedBy'];
		$this->DeletedBy->DbValue = $row['DeletedBy'];
		$this->latitud->DbValue = $row['latitud'];
		$this->longitud->DbValue = $row['longitud'];
		$this->tipoinmueble->DbValue = $row['tipoinmueble'];
		$this->id_ciudad_inmueble->DbValue = $row['id_ciudad_inmueble'];
		$this->id_provincia_inmueble->DbValue = $row['id_provincia_inmueble'];
		$this->imagen_inmueble01->Upload->DbValue = $row['imagen_inmueble01'];
		$this->imagen_inmueble02->Upload->DbValue = $row['imagen_inmueble02'];
		$this->imagen_inmueble03->Upload->DbValue = $row['imagen_inmueble03'];
		$this->imagen_inmueble04->Upload->DbValue = $row['imagen_inmueble04'];
		$this->imagen_inmueble05->Upload->DbValue = $row['imagen_inmueble05'];
		$this->imagen_inmueble06->Upload->DbValue = $row['imagen_inmueble06'];
		$this->imagen_inmueble07->Upload->DbValue = $row['imagen_inmueble07'];
		$this->imagen_inmueble08->Upload->DbValue = $row['imagen_inmueble08'];
		$this->tipovehiculo->DbValue = $row['tipovehiculo'];
		$this->id_ciudad_vehiculo->DbValue = $row['id_ciudad_vehiculo'];
		$this->id_provincia_vehiculo->DbValue = $row['id_provincia_vehiculo'];
		$this->imagen_vehiculo01->Upload->DbValue = $row['imagen_vehiculo01'];
		$this->imagen_vehiculo02->Upload->DbValue = $row['imagen_vehiculo02'];
		$this->imagen_vehiculo03->Upload->DbValue = $row['imagen_vehiculo03'];
		$this->imagen_vehiculo04->Upload->DbValue = $row['imagen_vehiculo04'];
		$this->imagen_vehiculo05->Upload->DbValue = $row['imagen_vehiculo05'];
		$this->imagen_vehiculo06->Upload->DbValue = $row['imagen_vehiculo06'];
		$this->imagen_vehiculo07->Upload->DbValue = $row['imagen_vehiculo07'];
		$this->imagen_vehiculo08->Upload->DbValue = $row['imagen_vehiculo08'];
		$this->tipomaquinaria->DbValue = $row['tipomaquinaria'];
		$this->id_ciudad_maquinaria->DbValue = $row['id_ciudad_maquinaria'];
		$this->id_provincia_maquinaria->DbValue = $row['id_provincia_maquinaria'];
		$this->imagen_maquinaria01->Upload->DbValue = $row['imagen_maquinaria01'];
		$this->imagen_maquinaria02->Upload->DbValue = $row['imagen_maquinaria02'];
		$this->imagen_maquinaria03->Upload->DbValue = $row['imagen_maquinaria03'];
		$this->imagen_maquinaria04->Upload->DbValue = $row['imagen_maquinaria04'];
		$this->imagen_maquinaria05->Upload->DbValue = $row['imagen_maquinaria05'];
		$this->imagen_maquinaria06->Upload->DbValue = $row['imagen_maquinaria06'];
		$this->imagen_maquinaria07->Upload->DbValue = $row['imagen_maquinaria07'];
		$this->imagen_maquinaria08->Upload->DbValue = $row['imagen_maquinaria08'];
		$this->tipomercaderia->DbValue = $row['tipomercaderia'];
		$this->imagen_mercaderia01->Upload->DbValue = $row['imagen_mercaderia01'];
		$this->documento_mercaderia->DbValue = $row['documento_mercaderia'];
		$this->tipoespecial->DbValue = $row['tipoespecial'];
		$this->imagen_tipoespecial01->Upload->DbValue = $row['imagen_tipoespecial01'];
		$this->email_contacto->DbValue = $row['email_contacto'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("id")) <> "")
			$this->id->CurrentValue = $this->getKey("id"); // id
		else
			$bValidKey = FALSE;

		// Load old record
		$this->OldRecordset = NULL;
		if ($bValidKey) {
			$this->CurrentFilter = $this->KeyFilter();
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$this->OldRecordset = ew_LoadRecordset($sSql, $conn);
		}
		$this->LoadRowValues($this->OldRecordset); // Load row values
		return $bValidKey;
	}

	// Render row values based on field settings
	function RenderRow() {
		global $Security, $Language, $gsLanguage;

		// Initialize URLs
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// nombre_contacto
		// name
		// lastname
		// email
		// address
		// phone
		// cell
		// is_active
		// created_at
		// id_sucursal
		// documentos
		// DateModified
		// DateDeleted
		// CreatedBy
		// ModifiedBy
		// DeletedBy
		// latitud
		// longitud
		// tipoinmueble
		// id_ciudad_inmueble
		// id_provincia_inmueble
		// imagen_inmueble01
		// imagen_inmueble02
		// imagen_inmueble03
		// imagen_inmueble04
		// imagen_inmueble05
		// imagen_inmueble06
		// imagen_inmueble07
		// imagen_inmueble08
		// tipovehiculo
		// id_ciudad_vehiculo
		// id_provincia_vehiculo
		// imagen_vehiculo01
		// imagen_vehiculo02
		// imagen_vehiculo03
		// imagen_vehiculo04
		// imagen_vehiculo05
		// imagen_vehiculo06
		// imagen_vehiculo07
		// imagen_vehiculo08
		// tipomaquinaria
		// id_ciudad_maquinaria
		// id_provincia_maquinaria
		// imagen_maquinaria01
		// imagen_maquinaria02
		// imagen_maquinaria03
		// imagen_maquinaria04
		// imagen_maquinaria05
		// imagen_maquinaria06
		// imagen_maquinaria07
		// imagen_maquinaria08
		// tipomercaderia
		// imagen_mercaderia01
		// documento_mercaderia
		// tipoespecial
		// imagen_tipoespecial01
		// email_contacto

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// nombre_contacto
		$this->nombre_contacto->ViewValue = $this->nombre_contacto->CurrentValue;
		$this->nombre_contacto->ViewCustomAttributes = "";

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

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// cell
		$this->cell->ViewValue = $this->cell->CurrentValue;
		$this->cell->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = ew_FormatDateTime($this->created_at->ViewValue, 17);
		$this->created_at->ViewCustomAttributes = "";

		// id_sucursal
		if (strval($this->id_sucursal->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_sucursal->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
		$sWhereWrk = "";
		$this->id_sucursal->LookupFilters = array("dx1" => '`nombre`');
		$lookuptblfilter = "`id`='".$_SESSION["sucursal"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
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

		// tipoinmueble
		if (strval($this->tipoinmueble->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipoinmueble->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`nombre`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_STRING, "");
			}
		$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
		$sWhereWrk = "";
		$this->tipoinmueble->LookupFilters = array("dx1" => '`nombre`');
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
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
		$sWhereWrk = "";
		$this->id_ciudad_inmueble->LookupFilters = array();
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
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
		$sWhereWrk = "";
		$this->id_provincia_inmueble->LookupFilters = array();
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

		// imagen_inmueble02
		if (!ew_Empty($this->imagen_inmueble02->Upload->DbValue)) {
			$this->imagen_inmueble02->ViewValue = "solicitud_imagen_inmueble02_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble02->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble02->ViewValue = "";
		}
		$this->imagen_inmueble02->ViewCustomAttributes = "";

		// imagen_inmueble03
		if (!ew_Empty($this->imagen_inmueble03->Upload->DbValue)) {
			$this->imagen_inmueble03->ViewValue = "solicitud_imagen_inmueble03_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble03->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble03->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble03->ViewValue = "";
		}
		$this->imagen_inmueble03->ViewCustomAttributes = "";

		// imagen_inmueble04
		if (!ew_Empty($this->imagen_inmueble04->Upload->DbValue)) {
			$this->imagen_inmueble04->ViewValue = "solicitud_imagen_inmueble04_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble04->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble04->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble04->ViewValue = "";
		}
		$this->imagen_inmueble04->ViewCustomAttributes = "";

		// imagen_inmueble05
		if (!ew_Empty($this->imagen_inmueble05->Upload->DbValue)) {
			$this->imagen_inmueble05->ViewValue = "solicitud_imagen_inmueble05_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble05->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble05->ViewValue = "";
		}
		$this->imagen_inmueble05->ViewCustomAttributes = "";

		// tipovehiculo
		if (strval($this->tipovehiculo->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipovehiculo->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`nombre`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_STRING, "");
			}
		$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
		$sWhereWrk = "";
		$this->tipovehiculo->LookupFilters = array("dx1" => '`nombre`');
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
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
		$sWhereWrk = "";
		$this->id_ciudad_vehiculo->LookupFilters = array();
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
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
		$sWhereWrk = "";
		$this->id_provincia_vehiculo->LookupFilters = array();
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

		// imagen_vehiculo02
		if (!ew_Empty($this->imagen_vehiculo02->Upload->DbValue)) {
			$this->imagen_vehiculo02->ViewValue = "solicitud_imagen_vehiculo02_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo02->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo02->ViewValue = "";
		}
		$this->imagen_vehiculo02->ViewCustomAttributes = "";

		// imagen_vehiculo03
		if (!ew_Empty($this->imagen_vehiculo03->Upload->DbValue)) {
			$this->imagen_vehiculo03->ViewValue = "solicitud_imagen_vehiculo03_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo03->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo03->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo03->ViewValue = "";
		}
		$this->imagen_vehiculo03->ViewCustomAttributes = "";

		// imagen_vehiculo05
		if (!ew_Empty($this->imagen_vehiculo05->Upload->DbValue)) {
			$this->imagen_vehiculo05->ViewValue = "solicitud_imagen_vehiculo05_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo05->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo05->ViewValue = "";
		}
		$this->imagen_vehiculo05->ViewCustomAttributes = "";

		// imagen_vehiculo06
		if (!ew_Empty($this->imagen_vehiculo06->Upload->DbValue)) {
			$this->imagen_vehiculo06->ViewValue = "solicitud_imagen_vehiculo06_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo06->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo06->ViewValue = "";
		}
		$this->imagen_vehiculo06->ViewCustomAttributes = "";

		// imagen_vehiculo07
		if (!ew_Empty($this->imagen_vehiculo07->Upload->DbValue)) {
			$this->imagen_vehiculo07->ViewValue = "solicitud_imagen_vehiculo07_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo07->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo07->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo07->ViewValue = "";
		}
		$this->imagen_vehiculo07->ViewCustomAttributes = "";

		// tipomaquinaria
		if (strval($this->tipomaquinaria->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipomaquinaria->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`nombre`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_STRING, "");
			}
		$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
		$sWhereWrk = "";
		$this->tipomaquinaria->LookupFilters = array("dx1" => '`nombre`');
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
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
		$sWhereWrk = "";
		$this->id_ciudad_maquinaria->LookupFilters = array();
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
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
		$sWhereWrk = "";
		$this->id_provincia_maquinaria->LookupFilters = array();
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

		// imagen_maquinaria02
		if (!ew_Empty($this->imagen_maquinaria02->Upload->DbValue)) {
			$this->imagen_maquinaria02->ViewValue = "solicitud_imagen_maquinaria02_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria02->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria02->ViewValue = "";
		}
		$this->imagen_maquinaria02->ViewCustomAttributes = "";

		// imagen_maquinaria05
		if (!ew_Empty($this->imagen_maquinaria05->Upload->DbValue)) {
			$this->imagen_maquinaria05->ViewValue = "solicitud_imagen_maquinaria05_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria05->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria05->ViewValue = "";
		}
		$this->imagen_maquinaria05->ViewCustomAttributes = "";

		// imagen_maquinaria06
		if (!ew_Empty($this->imagen_maquinaria06->Upload->DbValue)) {
			$this->imagen_maquinaria06->ViewValue = "solicitud_imagen_maquinaria06_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria06->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria06->ViewValue = "";
		}
		$this->imagen_maquinaria06->ViewCustomAttributes = "";

		// imagen_maquinaria07
		if (!ew_Empty($this->imagen_maquinaria07->Upload->DbValue)) {
			$this->imagen_maquinaria07->ViewValue = "solicitud_imagen_maquinaria07_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria07->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria07->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria07->ViewValue = "";
		}
		$this->imagen_maquinaria07->ViewCustomAttributes = "";

		// tipomercaderia
		if (strval($this->tipomercaderia->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipomercaderia->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`id_tipoinmueble`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
		$sSqlWrk = "SELECT `id_tipoinmueble`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
		$sWhereWrk = "";
		$this->tipomercaderia->LookupFilters = array("dx1" => '`nombre`');
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
			$this->imagen_mercaderia01->ViewValue = "solicitud_imagen_mercaderia01_bv.php?" . "id=" . $this->id->CurrentValue;
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
			$arwrk = explode(",", $this->tipoespecial->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`id_tipoinmueble`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
		$sSqlWrk = "SELECT `id_tipoinmueble`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
		$sWhereWrk = "";
		$this->tipoespecial->LookupFilters = array("dx1" => '`nombre`');
		$lookuptblfilter = "`tipo`='ESPECIAL'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tipoespecial, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->tipoespecial->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->tipoespecial->ViewValue .= $this->tipoespecial->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipoespecial->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
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
			$this->imagen_tipoespecial01->ViewValue = "solicitud_imagen_tipoespecial01_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_tipoespecial01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_tipoespecial01->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_tipoespecial01->ViewValue = "";
		}
		$this->imagen_tipoespecial01->ViewCustomAttributes = "";

		// email_contacto
		if (strval($this->email_contacto->CurrentValue) <> "") {
			$sFilterWrk = "`login`" . ew_SearchString("=", $this->email_contacto->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
		$sWhereWrk = "";
		$this->email_contacto->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->email_contacto, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->email_contacto->ViewValue = $this->email_contacto->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->email_contacto->ViewValue = $this->email_contacto->CurrentValue;
			}
		} else {
			$this->email_contacto->ViewValue = NULL;
		}
		$this->email_contacto->ViewCustomAttributes = "";

			// nombre_contacto
			$this->nombre_contacto->LinkCustomAttributes = "";
			$this->nombre_contacto->HrefValue = "";
			$this->nombre_contacto->TooltipValue = "";

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

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";
			$this->phone->TooltipValue = "";

			// cell
			$this->cell->LinkCustomAttributes = "";
			$this->cell->HrefValue = "";
			$this->cell->TooltipValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";

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

			// imagen_inmueble02
			$this->imagen_inmueble02->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble02->Upload->DbValue)) {
				$this->imagen_inmueble02->HrefValue = "solicitud_imagen_inmueble02_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble02->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble02->HrefValue = ew_FullUrl($this->imagen_inmueble02->HrefValue, "href");
			} else {
				$this->imagen_inmueble02->HrefValue = "";
			}
			$this->imagen_inmueble02->HrefValue2 = "solicitud_imagen_inmueble02_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble02->TooltipValue = "";

			// imagen_inmueble03
			$this->imagen_inmueble03->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble03->Upload->DbValue)) {
				$this->imagen_inmueble03->HrefValue = "solicitud_imagen_inmueble03_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble03->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble03->HrefValue = ew_FullUrl($this->imagen_inmueble03->HrefValue, "href");
			} else {
				$this->imagen_inmueble03->HrefValue = "";
			}
			$this->imagen_inmueble03->HrefValue2 = "solicitud_imagen_inmueble03_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble03->TooltipValue = "";

			// imagen_inmueble04
			$this->imagen_inmueble04->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble04->Upload->DbValue)) {
				$this->imagen_inmueble04->HrefValue = "solicitud_imagen_inmueble04_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble04->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble04->HrefValue = ew_FullUrl($this->imagen_inmueble04->HrefValue, "href");
			} else {
				$this->imagen_inmueble04->HrefValue = "";
			}
			$this->imagen_inmueble04->HrefValue2 = "solicitud_imagen_inmueble04_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble04->TooltipValue = "";

			// imagen_inmueble05
			$this->imagen_inmueble05->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble05->Upload->DbValue)) {
				$this->imagen_inmueble05->HrefValue = "solicitud_imagen_inmueble05_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble05->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble05->HrefValue = ew_FullUrl($this->imagen_inmueble05->HrefValue, "href");
			} else {
				$this->imagen_inmueble05->HrefValue = "";
			}
			$this->imagen_inmueble05->HrefValue2 = "solicitud_imagen_inmueble05_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble05->TooltipValue = "";

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

			// imagen_vehiculo02
			$this->imagen_vehiculo02->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo02->Upload->DbValue)) {
				$this->imagen_vehiculo02->HrefValue = "solicitud_imagen_vehiculo02_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo02->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo02->HrefValue = ew_FullUrl($this->imagen_vehiculo02->HrefValue, "href");
			} else {
				$this->imagen_vehiculo02->HrefValue = "";
			}
			$this->imagen_vehiculo02->HrefValue2 = "solicitud_imagen_vehiculo02_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo02->TooltipValue = "";

			// imagen_vehiculo03
			$this->imagen_vehiculo03->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo03->Upload->DbValue)) {
				$this->imagen_vehiculo03->HrefValue = "solicitud_imagen_vehiculo03_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo03->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo03->HrefValue = ew_FullUrl($this->imagen_vehiculo03->HrefValue, "href");
			} else {
				$this->imagen_vehiculo03->HrefValue = "";
			}
			$this->imagen_vehiculo03->HrefValue2 = "solicitud_imagen_vehiculo03_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo03->TooltipValue = "";

			// imagen_vehiculo05
			$this->imagen_vehiculo05->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo05->Upload->DbValue)) {
				$this->imagen_vehiculo05->HrefValue = "solicitud_imagen_vehiculo05_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo05->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo05->HrefValue = ew_FullUrl($this->imagen_vehiculo05->HrefValue, "href");
			} else {
				$this->imagen_vehiculo05->HrefValue = "";
			}
			$this->imagen_vehiculo05->HrefValue2 = "solicitud_imagen_vehiculo05_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo05->TooltipValue = "";

			// imagen_vehiculo06
			$this->imagen_vehiculo06->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo06->Upload->DbValue)) {
				$this->imagen_vehiculo06->HrefValue = "solicitud_imagen_vehiculo06_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo06->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo06->HrefValue = ew_FullUrl($this->imagen_vehiculo06->HrefValue, "href");
			} else {
				$this->imagen_vehiculo06->HrefValue = "";
			}
			$this->imagen_vehiculo06->HrefValue2 = "solicitud_imagen_vehiculo06_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo06->TooltipValue = "";

			// imagen_vehiculo07
			$this->imagen_vehiculo07->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo07->Upload->DbValue)) {
				$this->imagen_vehiculo07->HrefValue = "solicitud_imagen_vehiculo07_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo07->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo07->HrefValue = ew_FullUrl($this->imagen_vehiculo07->HrefValue, "href");
			} else {
				$this->imagen_vehiculo07->HrefValue = "";
			}
			$this->imagen_vehiculo07->HrefValue2 = "solicitud_imagen_vehiculo07_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo07->TooltipValue = "";

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

			// imagen_maquinaria02
			$this->imagen_maquinaria02->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria02->Upload->DbValue)) {
				$this->imagen_maquinaria02->HrefValue = "solicitud_imagen_maquinaria02_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria02->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria02->HrefValue = ew_FullUrl($this->imagen_maquinaria02->HrefValue, "href");
			} else {
				$this->imagen_maquinaria02->HrefValue = "";
			}
			$this->imagen_maquinaria02->HrefValue2 = "solicitud_imagen_maquinaria02_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria02->TooltipValue = "";

			// imagen_maquinaria05
			$this->imagen_maquinaria05->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria05->Upload->DbValue)) {
				$this->imagen_maquinaria05->HrefValue = "solicitud_imagen_maquinaria05_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria05->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria05->HrefValue = ew_FullUrl($this->imagen_maquinaria05->HrefValue, "href");
			} else {
				$this->imagen_maquinaria05->HrefValue = "";
			}
			$this->imagen_maquinaria05->HrefValue2 = "solicitud_imagen_maquinaria05_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria05->TooltipValue = "";

			// imagen_maquinaria06
			$this->imagen_maquinaria06->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria06->Upload->DbValue)) {
				$this->imagen_maquinaria06->HrefValue = "solicitud_imagen_maquinaria06_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria06->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria06->HrefValue = ew_FullUrl($this->imagen_maquinaria06->HrefValue, "href");
			} else {
				$this->imagen_maquinaria06->HrefValue = "";
			}
			$this->imagen_maquinaria06->HrefValue2 = "solicitud_imagen_maquinaria06_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria06->TooltipValue = "";

			// imagen_maquinaria07
			$this->imagen_maquinaria07->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria07->Upload->DbValue)) {
				$this->imagen_maquinaria07->HrefValue = "solicitud_imagen_maquinaria07_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria07->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria07->HrefValue = ew_FullUrl($this->imagen_maquinaria07->HrefValue, "href");
			} else {
				$this->imagen_maquinaria07->HrefValue = "";
			}
			$this->imagen_maquinaria07->HrefValue2 = "solicitud_imagen_maquinaria07_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria07->TooltipValue = "";

			// tipomercaderia
			$this->tipomercaderia->LinkCustomAttributes = "";
			$this->tipomercaderia->HrefValue = "";
			$this->tipomercaderia->TooltipValue = "";

			// imagen_mercaderia01
			$this->imagen_mercaderia01->LinkCustomAttributes = "";
			if (!empty($this->imagen_mercaderia01->Upload->DbValue)) {
				$this->imagen_mercaderia01->HrefValue = "solicitud_imagen_mercaderia01_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_mercaderia01->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_mercaderia01->HrefValue = ew_FullUrl($this->imagen_mercaderia01->HrefValue, "href");
			} else {
				$this->imagen_mercaderia01->HrefValue = "";
			}
			$this->imagen_mercaderia01->HrefValue2 = "solicitud_imagen_mercaderia01_bv.php?id=" . $this->id->CurrentValue;
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
				$this->imagen_tipoespecial01->HrefValue = "solicitud_imagen_tipoespecial01_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_tipoespecial01->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_tipoespecial01->HrefValue = ew_FullUrl($this->imagen_tipoespecial01->HrefValue, "href");
			} else {
				$this->imagen_tipoespecial01->HrefValue = "";
			}
			$this->imagen_tipoespecial01->HrefValue2 = "solicitud_imagen_tipoespecial01_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_tipoespecial01->TooltipValue = "";

			// email_contacto
			$this->email_contacto->LinkCustomAttributes = "";
			$this->email_contacto->HrefValue = "";
			$this->email_contacto->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// nombre_contacto
			$this->nombre_contacto->EditAttrs["class"] = "form-control";
			$this->nombre_contacto->EditCustomAttributes = "";
			$this->nombre_contacto->EditValue = ew_HtmlEncode($this->nombre_contacto->CurrentValue);
			$this->nombre_contacto->PlaceHolder = ew_RemoveHtml($this->nombre_contacto->FldTitle());

			// name
			$this->name->EditAttrs["class"] = "form-control";
			$this->name->EditCustomAttributes = "";
			$this->name->EditValue = ew_HtmlEncode($this->name->CurrentValue);
			$this->name->PlaceHolder = ew_RemoveHtml($this->name->FldTitle());

			// lastname
			$this->lastname->EditAttrs["class"] = "form-control";
			$this->lastname->EditCustomAttributes = "";
			$this->lastname->EditValue = ew_HtmlEncode($this->lastname->CurrentValue);
			$this->lastname->PlaceHolder = ew_RemoveHtml($this->lastname->FldTitle());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			$this->_email->EditValue = ew_HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldTitle());

			// address
			$this->address->EditAttrs["class"] = "form-control";
			$this->address->EditCustomAttributes = "";
			$this->address->EditValue = ew_HtmlEncode($this->address->CurrentValue);
			$this->address->PlaceHolder = ew_RemoveHtml($this->address->FldTitle());

			// phone
			$this->phone->EditAttrs["class"] = "form-control";
			$this->phone->EditCustomAttributes = "";
			$this->phone->EditValue = ew_HtmlEncode($this->phone->CurrentValue);
			$this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldTitle());

			// cell
			$this->cell->EditAttrs["class"] = "form-control";
			$this->cell->EditCustomAttributes = "";
			$this->cell->EditValue = ew_HtmlEncode($this->cell->CurrentValue);
			$this->cell->PlaceHolder = ew_RemoveHtml($this->cell->FldTitle());

			// created_at
			$this->created_at->EditAttrs["class"] = "form-control";
			$this->created_at->EditCustomAttributes = "";
			$this->created_at->EditValue = $this->created_at->CurrentValue;
			$this->created_at->EditValue = ew_FormatDateTime($this->created_at->EditValue, 17);
			$this->created_at->ViewCustomAttributes = "";

			// id_sucursal
			$this->id_sucursal->EditCustomAttributes = "";
			if (trim(strval($this->id_sucursal->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_sucursal->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `sucursal`";
			$sWhereWrk = "";
			$this->id_sucursal->LookupFilters = array("dx1" => '`nombre`');
			$lookuptblfilter = "`id`='".$_SESSION["sucursal"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_sucursal, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->id_sucursal->ViewValue = $this->id_sucursal->DisplayValue($arwrk);
			} else {
				$this->id_sucursal->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_sucursal->EditValue = $arwrk;

			// tipoinmueble
			$this->tipoinmueble->EditCustomAttributes = "";
			if (trim(strval($this->tipoinmueble->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$arwrk = explode(",", $this->tipoinmueble->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`nombre`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_STRING, "");
				}
			}
			$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tipoinmueble`";
			$sWhereWrk = "";
			$this->tipoinmueble->LookupFilters = array("dx1" => '`nombre`');
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
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->tipoinmueble->ViewValue .= $this->tipoinmueble->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipoinmueble->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->MoveFirst();
			} else {
				$this->tipoinmueble->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->tipoinmueble->EditValue = $arwrk;

			// id_ciudad_inmueble
			$this->id_ciudad_inmueble->EditAttrs["class"] = "form-control";
			$this->id_ciudad_inmueble->EditCustomAttributes = "";
			if (trim(strval($this->id_ciudad_inmueble->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_ciudad_inmueble->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `departamento`";
			$sWhereWrk = "";
			$this->id_ciudad_inmueble->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_ciudad_inmueble, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_ciudad_inmueble->EditValue = $arwrk;

			// id_provincia_inmueble
			$this->id_provincia_inmueble->EditAttrs["class"] = "form-control";
			$this->id_provincia_inmueble->EditCustomAttributes = "";
			if (trim(strval($this->id_provincia_inmueble->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_provincia_inmueble->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `provincia`";
			$sWhereWrk = "";
			$this->id_provincia_inmueble->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_provincia_inmueble, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_provincia_inmueble->EditValue = $arwrk;

			// imagen_inmueble02
			$this->imagen_inmueble02->EditAttrs["class"] = "form-control";
			$this->imagen_inmueble02->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_inmueble02->Upload->DbValue)) {
				$this->imagen_inmueble02->EditValue = "solicitud_imagen_inmueble02_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_inmueble02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble02->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_inmueble02->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_inmueble02);

			// imagen_inmueble03
			$this->imagen_inmueble03->EditAttrs["class"] = "form-control";
			$this->imagen_inmueble03->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_inmueble03->Upload->DbValue)) {
				$this->imagen_inmueble03->EditValue = "solicitud_imagen_inmueble03_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_inmueble03->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble03->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_inmueble03->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_inmueble03);

			// imagen_inmueble04
			$this->imagen_inmueble04->EditAttrs["class"] = "form-control";
			$this->imagen_inmueble04->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_inmueble04->Upload->DbValue)) {
				$this->imagen_inmueble04->EditValue = "solicitud_imagen_inmueble04_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_inmueble04->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble04->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_inmueble04->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_inmueble04);

			// imagen_inmueble05
			$this->imagen_inmueble05->EditAttrs["class"] = "form-control";
			$this->imagen_inmueble05->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_inmueble05->Upload->DbValue)) {
				$this->imagen_inmueble05->EditValue = "solicitud_imagen_inmueble05_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_inmueble05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble05->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_inmueble05->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_inmueble05);

			// tipovehiculo
			$this->tipovehiculo->EditCustomAttributes = "";
			if (trim(strval($this->tipovehiculo->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$arwrk = explode(",", $this->tipovehiculo->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`nombre`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_STRING, "");
				}
			}
			$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tipoinmueble`";
			$sWhereWrk = "";
			$this->tipovehiculo->LookupFilters = array("dx1" => '`nombre`');
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
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->tipovehiculo->ViewValue .= $this->tipovehiculo->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipovehiculo->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->MoveFirst();
			} else {
				$this->tipovehiculo->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->tipovehiculo->EditValue = $arwrk;

			// id_ciudad_vehiculo
			$this->id_ciudad_vehiculo->EditAttrs["class"] = "form-control";
			$this->id_ciudad_vehiculo->EditCustomAttributes = "";
			if (trim(strval($this->id_ciudad_vehiculo->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_ciudad_vehiculo->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `departamento`";
			$sWhereWrk = "";
			$this->id_ciudad_vehiculo->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_ciudad_vehiculo, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_ciudad_vehiculo->EditValue = $arwrk;

			// id_provincia_vehiculo
			$this->id_provincia_vehiculo->EditAttrs["class"] = "form-control";
			$this->id_provincia_vehiculo->EditCustomAttributes = "";
			if (trim(strval($this->id_provincia_vehiculo->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_provincia_vehiculo->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `provincia`";
			$sWhereWrk = "";
			$this->id_provincia_vehiculo->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_provincia_vehiculo, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_provincia_vehiculo->EditValue = $arwrk;

			// imagen_vehiculo02
			$this->imagen_vehiculo02->EditAttrs["class"] = "form-control";
			$this->imagen_vehiculo02->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_vehiculo02->Upload->DbValue)) {
				$this->imagen_vehiculo02->EditValue = "solicitud_imagen_vehiculo02_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo02->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_vehiculo02->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_vehiculo02);

			// imagen_vehiculo03
			$this->imagen_vehiculo03->EditAttrs["class"] = "form-control";
			$this->imagen_vehiculo03->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_vehiculo03->Upload->DbValue)) {
				$this->imagen_vehiculo03->EditValue = "solicitud_imagen_vehiculo03_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo03->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo03->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_vehiculo03->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_vehiculo03);

			// imagen_vehiculo05
			$this->imagen_vehiculo05->EditAttrs["class"] = "form-control";
			$this->imagen_vehiculo05->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_vehiculo05->Upload->DbValue)) {
				$this->imagen_vehiculo05->EditValue = "solicitud_imagen_vehiculo05_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo05->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_vehiculo05->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_vehiculo05);

			// imagen_vehiculo06
			$this->imagen_vehiculo06->EditAttrs["class"] = "form-control";
			$this->imagen_vehiculo06->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_vehiculo06->Upload->DbValue)) {
				$this->imagen_vehiculo06->EditValue = "solicitud_imagen_vehiculo06_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo06->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_vehiculo06->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_vehiculo06);

			// imagen_vehiculo07
			$this->imagen_vehiculo07->EditAttrs["class"] = "form-control";
			$this->imagen_vehiculo07->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_vehiculo07->Upload->DbValue)) {
				$this->imagen_vehiculo07->EditValue = "solicitud_imagen_vehiculo07_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo07->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo07->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_vehiculo07->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_vehiculo07);

			// tipomaquinaria
			$this->tipomaquinaria->EditCustomAttributes = "";
			if (trim(strval($this->tipomaquinaria->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$arwrk = explode(",", $this->tipomaquinaria->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`nombre`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_STRING, "");
				}
			}
			$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tipoinmueble`";
			$sWhereWrk = "";
			$this->tipomaquinaria->LookupFilters = array("dx1" => '`nombre`');
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
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->tipomaquinaria->ViewValue .= $this->tipomaquinaria->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipomaquinaria->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->MoveFirst();
			} else {
				$this->tipomaquinaria->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->tipomaquinaria->EditValue = $arwrk;

			// id_ciudad_maquinaria
			$this->id_ciudad_maquinaria->EditAttrs["class"] = "form-control";
			$this->id_ciudad_maquinaria->EditCustomAttributes = "";
			if (trim(strval($this->id_ciudad_maquinaria->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_ciudad_maquinaria->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `departamento`";
			$sWhereWrk = "";
			$this->id_ciudad_maquinaria->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_ciudad_maquinaria, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_ciudad_maquinaria->EditValue = $arwrk;

			// id_provincia_maquinaria
			$this->id_provincia_maquinaria->EditAttrs["class"] = "form-control";
			$this->id_provincia_maquinaria->EditCustomAttributes = "";
			if (trim(strval($this->id_provincia_maquinaria->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_provincia_maquinaria->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `provincia`";
			$sWhereWrk = "";
			$this->id_provincia_maquinaria->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_provincia_maquinaria, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_provincia_maquinaria->EditValue = $arwrk;

			// imagen_maquinaria02
			$this->imagen_maquinaria02->EditAttrs["class"] = "form-control";
			$this->imagen_maquinaria02->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_maquinaria02->Upload->DbValue)) {
				$this->imagen_maquinaria02->EditValue = "solicitud_imagen_maquinaria02_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria02->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_maquinaria02->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_maquinaria02);

			// imagen_maquinaria05
			$this->imagen_maquinaria05->EditAttrs["class"] = "form-control";
			$this->imagen_maquinaria05->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_maquinaria05->Upload->DbValue)) {
				$this->imagen_maquinaria05->EditValue = "solicitud_imagen_maquinaria05_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria05->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_maquinaria05->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_maquinaria05);

			// imagen_maquinaria06
			$this->imagen_maquinaria06->EditAttrs["class"] = "form-control";
			$this->imagen_maquinaria06->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_maquinaria06->Upload->DbValue)) {
				$this->imagen_maquinaria06->EditValue = "solicitud_imagen_maquinaria06_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria06->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_maquinaria06->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_maquinaria06);

			// imagen_maquinaria07
			$this->imagen_maquinaria07->EditAttrs["class"] = "form-control";
			$this->imagen_maquinaria07->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_maquinaria07->Upload->DbValue)) {
				$this->imagen_maquinaria07->EditValue = "solicitud_imagen_maquinaria07_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria07->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria07->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_maquinaria07->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_maquinaria07);

			// tipomercaderia
			$this->tipomercaderia->EditCustomAttributes = "";
			if (trim(strval($this->tipomercaderia->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$arwrk = explode(",", $this->tipomercaderia->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`id_tipoinmueble`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
				}
			}
			$sSqlWrk = "SELECT `id_tipoinmueble`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tipoinmueble`";
			$sWhereWrk = "";
			$this->tipomercaderia->LookupFilters = array("dx1" => '`nombre`');
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
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->tipomercaderia->ViewValue .= $this->tipomercaderia->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipomercaderia->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->MoveFirst();
			} else {
				$this->tipomercaderia->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->tipomercaderia->EditValue = $arwrk;

			// imagen_mercaderia01
			$this->imagen_mercaderia01->EditAttrs["class"] = "form-control";
			$this->imagen_mercaderia01->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_mercaderia01->Upload->DbValue)) {
				$this->imagen_mercaderia01->EditValue = "solicitud_imagen_mercaderia01_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_mercaderia01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_mercaderia01->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_mercaderia01->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_mercaderia01);

			// documento_mercaderia
			$this->documento_mercaderia->EditAttrs["class"] = "form-control";
			$this->documento_mercaderia->EditCustomAttributes = "";
			$this->documento_mercaderia->EditValue = ew_HtmlEncode($this->documento_mercaderia->CurrentValue);
			$this->documento_mercaderia->PlaceHolder = ew_RemoveHtml($this->documento_mercaderia->FldTitle());

			// tipoespecial
			$this->tipoespecial->EditCustomAttributes = "";
			if (trim(strval($this->tipoespecial->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$arwrk = explode(",", $this->tipoespecial->CurrentValue);
				$sFilterWrk = "";
				foreach ($arwrk as $wrk) {
					if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
					$sFilterWrk .= "`id_tipoinmueble`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
				}
			}
			$sSqlWrk = "SELECT `id_tipoinmueble`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tipoinmueble`";
			$sWhereWrk = "";
			$this->tipoespecial->LookupFilters = array("dx1" => '`nombre`');
			$lookuptblfilter = "`tipo`='ESPECIAL'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->tipoespecial, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->tipoespecial->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$this->tipoespecial->ViewValue .= $this->tipoespecial->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipoespecial->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->MoveFirst();
			} else {
				$this->tipoespecial->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->tipoespecial->EditValue = $arwrk;

			// imagen_tipoespecial01
			$this->imagen_tipoespecial01->EditAttrs["class"] = "form-control";
			$this->imagen_tipoespecial01->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_tipoespecial01->Upload->DbValue)) {
				$this->imagen_tipoespecial01->EditValue = "solicitud_imagen_tipoespecial01_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_tipoespecial01->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_tipoespecial01->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_tipoespecial01->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_tipoespecial01);

			// email_contacto
			$this->email_contacto->EditCustomAttributes = "";
			if (trim(strval($this->email_contacto->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`login`" . ew_SearchString("=", $this->email_contacto->CurrentValue, EW_DATATYPE_STRING, "");
			}
			$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `oficialcredito`";
			$sWhereWrk = "";
			$this->email_contacto->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->email_contacto, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
				$this->email_contacto->ViewValue = $this->email_contacto->DisplayValue($arwrk);
			} else {
				$this->email_contacto->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->email_contacto->EditValue = $arwrk;

			// Edit refer script
			// nombre_contacto

			$this->nombre_contacto->LinkCustomAttributes = "";
			$this->nombre_contacto->HrefValue = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";

			// lastname
			$this->lastname->LinkCustomAttributes = "";
			$this->lastname->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";

			// cell
			$this->cell->LinkCustomAttributes = "";
			$this->cell->HrefValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";

			// tipoinmueble
			$this->tipoinmueble->LinkCustomAttributes = "";
			$this->tipoinmueble->HrefValue = "";

			// id_ciudad_inmueble
			$this->id_ciudad_inmueble->LinkCustomAttributes = "";
			$this->id_ciudad_inmueble->HrefValue = "";

			// id_provincia_inmueble
			$this->id_provincia_inmueble->LinkCustomAttributes = "";
			$this->id_provincia_inmueble->HrefValue = "";

			// imagen_inmueble02
			$this->imagen_inmueble02->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble02->Upload->DbValue)) {
				$this->imagen_inmueble02->HrefValue = "solicitud_imagen_inmueble02_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble02->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble02->HrefValue = ew_FullUrl($this->imagen_inmueble02->HrefValue, "href");
			} else {
				$this->imagen_inmueble02->HrefValue = "";
			}
			$this->imagen_inmueble02->HrefValue2 = "solicitud_imagen_inmueble02_bv.php?id=" . $this->id->CurrentValue;

			// imagen_inmueble03
			$this->imagen_inmueble03->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble03->Upload->DbValue)) {
				$this->imagen_inmueble03->HrefValue = "solicitud_imagen_inmueble03_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble03->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble03->HrefValue = ew_FullUrl($this->imagen_inmueble03->HrefValue, "href");
			} else {
				$this->imagen_inmueble03->HrefValue = "";
			}
			$this->imagen_inmueble03->HrefValue2 = "solicitud_imagen_inmueble03_bv.php?id=" . $this->id->CurrentValue;

			// imagen_inmueble04
			$this->imagen_inmueble04->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble04->Upload->DbValue)) {
				$this->imagen_inmueble04->HrefValue = "solicitud_imagen_inmueble04_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble04->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble04->HrefValue = ew_FullUrl($this->imagen_inmueble04->HrefValue, "href");
			} else {
				$this->imagen_inmueble04->HrefValue = "";
			}
			$this->imagen_inmueble04->HrefValue2 = "solicitud_imagen_inmueble04_bv.php?id=" . $this->id->CurrentValue;

			// imagen_inmueble05
			$this->imagen_inmueble05->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble05->Upload->DbValue)) {
				$this->imagen_inmueble05->HrefValue = "solicitud_imagen_inmueble05_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble05->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble05->HrefValue = ew_FullUrl($this->imagen_inmueble05->HrefValue, "href");
			} else {
				$this->imagen_inmueble05->HrefValue = "";
			}
			$this->imagen_inmueble05->HrefValue2 = "solicitud_imagen_inmueble05_bv.php?id=" . $this->id->CurrentValue;

			// tipovehiculo
			$this->tipovehiculo->LinkCustomAttributes = "";
			$this->tipovehiculo->HrefValue = "";

			// id_ciudad_vehiculo
			$this->id_ciudad_vehiculo->LinkCustomAttributes = "";
			$this->id_ciudad_vehiculo->HrefValue = "";

			// id_provincia_vehiculo
			$this->id_provincia_vehiculo->LinkCustomAttributes = "";
			$this->id_provincia_vehiculo->HrefValue = "";

			// imagen_vehiculo02
			$this->imagen_vehiculo02->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo02->Upload->DbValue)) {
				$this->imagen_vehiculo02->HrefValue = "solicitud_imagen_vehiculo02_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo02->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo02->HrefValue = ew_FullUrl($this->imagen_vehiculo02->HrefValue, "href");
			} else {
				$this->imagen_vehiculo02->HrefValue = "";
			}
			$this->imagen_vehiculo02->HrefValue2 = "solicitud_imagen_vehiculo02_bv.php?id=" . $this->id->CurrentValue;

			// imagen_vehiculo03
			$this->imagen_vehiculo03->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo03->Upload->DbValue)) {
				$this->imagen_vehiculo03->HrefValue = "solicitud_imagen_vehiculo03_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo03->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo03->HrefValue = ew_FullUrl($this->imagen_vehiculo03->HrefValue, "href");
			} else {
				$this->imagen_vehiculo03->HrefValue = "";
			}
			$this->imagen_vehiculo03->HrefValue2 = "solicitud_imagen_vehiculo03_bv.php?id=" . $this->id->CurrentValue;

			// imagen_vehiculo05
			$this->imagen_vehiculo05->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo05->Upload->DbValue)) {
				$this->imagen_vehiculo05->HrefValue = "solicitud_imagen_vehiculo05_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo05->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo05->HrefValue = ew_FullUrl($this->imagen_vehiculo05->HrefValue, "href");
			} else {
				$this->imagen_vehiculo05->HrefValue = "";
			}
			$this->imagen_vehiculo05->HrefValue2 = "solicitud_imagen_vehiculo05_bv.php?id=" . $this->id->CurrentValue;

			// imagen_vehiculo06
			$this->imagen_vehiculo06->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo06->Upload->DbValue)) {
				$this->imagen_vehiculo06->HrefValue = "solicitud_imagen_vehiculo06_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo06->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo06->HrefValue = ew_FullUrl($this->imagen_vehiculo06->HrefValue, "href");
			} else {
				$this->imagen_vehiculo06->HrefValue = "";
			}
			$this->imagen_vehiculo06->HrefValue2 = "solicitud_imagen_vehiculo06_bv.php?id=" . $this->id->CurrentValue;

			// imagen_vehiculo07
			$this->imagen_vehiculo07->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo07->Upload->DbValue)) {
				$this->imagen_vehiculo07->HrefValue = "solicitud_imagen_vehiculo07_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo07->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo07->HrefValue = ew_FullUrl($this->imagen_vehiculo07->HrefValue, "href");
			} else {
				$this->imagen_vehiculo07->HrefValue = "";
			}
			$this->imagen_vehiculo07->HrefValue2 = "solicitud_imagen_vehiculo07_bv.php?id=" . $this->id->CurrentValue;

			// tipomaquinaria
			$this->tipomaquinaria->LinkCustomAttributes = "";
			$this->tipomaquinaria->HrefValue = "";

			// id_ciudad_maquinaria
			$this->id_ciudad_maquinaria->LinkCustomAttributes = "";
			$this->id_ciudad_maquinaria->HrefValue = "";

			// id_provincia_maquinaria
			$this->id_provincia_maquinaria->LinkCustomAttributes = "";
			$this->id_provincia_maquinaria->HrefValue = "";

			// imagen_maquinaria02
			$this->imagen_maquinaria02->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria02->Upload->DbValue)) {
				$this->imagen_maquinaria02->HrefValue = "solicitud_imagen_maquinaria02_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria02->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria02->HrefValue = ew_FullUrl($this->imagen_maquinaria02->HrefValue, "href");
			} else {
				$this->imagen_maquinaria02->HrefValue = "";
			}
			$this->imagen_maquinaria02->HrefValue2 = "solicitud_imagen_maquinaria02_bv.php?id=" . $this->id->CurrentValue;

			// imagen_maquinaria05
			$this->imagen_maquinaria05->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria05->Upload->DbValue)) {
				$this->imagen_maquinaria05->HrefValue = "solicitud_imagen_maquinaria05_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria05->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria05->HrefValue = ew_FullUrl($this->imagen_maquinaria05->HrefValue, "href");
			} else {
				$this->imagen_maquinaria05->HrefValue = "";
			}
			$this->imagen_maquinaria05->HrefValue2 = "solicitud_imagen_maquinaria05_bv.php?id=" . $this->id->CurrentValue;

			// imagen_maquinaria06
			$this->imagen_maquinaria06->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria06->Upload->DbValue)) {
				$this->imagen_maquinaria06->HrefValue = "solicitud_imagen_maquinaria06_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria06->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria06->HrefValue = ew_FullUrl($this->imagen_maquinaria06->HrefValue, "href");
			} else {
				$this->imagen_maquinaria06->HrefValue = "";
			}
			$this->imagen_maquinaria06->HrefValue2 = "solicitud_imagen_maquinaria06_bv.php?id=" . $this->id->CurrentValue;

			// imagen_maquinaria07
			$this->imagen_maquinaria07->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria07->Upload->DbValue)) {
				$this->imagen_maquinaria07->HrefValue = "solicitud_imagen_maquinaria07_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria07->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria07->HrefValue = ew_FullUrl($this->imagen_maquinaria07->HrefValue, "href");
			} else {
				$this->imagen_maquinaria07->HrefValue = "";
			}
			$this->imagen_maquinaria07->HrefValue2 = "solicitud_imagen_maquinaria07_bv.php?id=" . $this->id->CurrentValue;

			// tipomercaderia
			$this->tipomercaderia->LinkCustomAttributes = "";
			$this->tipomercaderia->HrefValue = "";

			// imagen_mercaderia01
			$this->imagen_mercaderia01->LinkCustomAttributes = "";
			if (!empty($this->imagen_mercaderia01->Upload->DbValue)) {
				$this->imagen_mercaderia01->HrefValue = "solicitud_imagen_mercaderia01_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_mercaderia01->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_mercaderia01->HrefValue = ew_FullUrl($this->imagen_mercaderia01->HrefValue, "href");
			} else {
				$this->imagen_mercaderia01->HrefValue = "";
			}
			$this->imagen_mercaderia01->HrefValue2 = "solicitud_imagen_mercaderia01_bv.php?id=" . $this->id->CurrentValue;

			// documento_mercaderia
			$this->documento_mercaderia->LinkCustomAttributes = "";
			$this->documento_mercaderia->HrefValue = "";

			// tipoespecial
			$this->tipoespecial->LinkCustomAttributes = "";
			$this->tipoespecial->HrefValue = "";

			// imagen_tipoespecial01
			$this->imagen_tipoespecial01->LinkCustomAttributes = "";
			if (!empty($this->imagen_tipoespecial01->Upload->DbValue)) {
				$this->imagen_tipoespecial01->HrefValue = "solicitud_imagen_tipoespecial01_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_tipoespecial01->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_tipoespecial01->HrefValue = ew_FullUrl($this->imagen_tipoespecial01->HrefValue, "href");
			} else {
				$this->imagen_tipoespecial01->HrefValue = "";
			}
			$this->imagen_tipoespecial01->HrefValue2 = "solicitud_imagen_tipoespecial01_bv.php?id=" . $this->id->CurrentValue;

			// email_contacto
			$this->email_contacto->LinkCustomAttributes = "";
			$this->email_contacto->HrefValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->name->FldIsDetailKey && !is_null($this->name->FormValue) && $this->name->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->name->FldCaption(), $this->name->ReqErrMsg));
		}
		if (!$this->lastname->FldIsDetailKey && !is_null($this->lastname->FormValue) && $this->lastname->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->lastname->FldCaption(), $this->lastname->ReqErrMsg));
		}
		if (!$this->_email->FldIsDetailKey && !is_null($this->_email->FormValue) && $this->_email->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->_email->FldCaption(), $this->_email->ReqErrMsg));
		}
		if (!$this->id_sucursal->FldIsDetailKey && !is_null($this->id_sucursal->FormValue) && $this->id_sucursal->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->id_sucursal->FldCaption(), $this->id_sucursal->ReqErrMsg));
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("avaluo", $DetailTblVar) && $GLOBALS["avaluo"]->DetailEdit) {
			if (!isset($GLOBALS["avaluo_grid"])) $GLOBALS["avaluo_grid"] = new cavaluo_grid(); // get detail page object
			$GLOBALS["avaluo_grid"]->ValidateGridForm();
		}

		// Return validate result
		$ValidateForm = ($gsFormError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateForm = $ValidateForm && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsFormError, $sFormCustomError);
		}
		return $ValidateForm;
	}

	// Update record based on key values
	function EditRow() {
		global $Security, $Language;
		$sFilter = $this->KeyFilter();
		$sFilter = $this->ApplyUserIDFilters($sFilter);
		$conn = &$this->Connection();
		$this->CurrentFilter = $sFilter;
		$sSql = $this->SQL();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE)
			return FALSE;
		if ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record message
			$EditRow = FALSE; // Update Failed
		} else {

			// Begin transaction
			if ($this->getCurrentDetailTable() <> "")
				$conn->BeginTrans();

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// nombre_contacto
			$this->nombre_contacto->SetDbValueDef($rsnew, $this->nombre_contacto->CurrentValue, NULL, $this->nombre_contacto->ReadOnly);

			// name
			$this->name->SetDbValueDef($rsnew, $this->name->CurrentValue, NULL, $this->name->ReadOnly);

			// lastname
			$this->lastname->SetDbValueDef($rsnew, $this->lastname->CurrentValue, NULL, $this->lastname->ReadOnly);

			// email
			$this->_email->SetDbValueDef($rsnew, $this->_email->CurrentValue, NULL, $this->_email->ReadOnly);

			// address
			$this->address->SetDbValueDef($rsnew, $this->address->CurrentValue, NULL, $this->address->ReadOnly);

			// phone
			$this->phone->SetDbValueDef($rsnew, $this->phone->CurrentValue, NULL, $this->phone->ReadOnly);

			// cell
			$this->cell->SetDbValueDef($rsnew, $this->cell->CurrentValue, NULL, $this->cell->ReadOnly);

			// id_sucursal
			$this->id_sucursal->SetDbValueDef($rsnew, $this->id_sucursal->CurrentValue, 0, $this->id_sucursal->ReadOnly);

			// tipoinmueble
			$this->tipoinmueble->SetDbValueDef($rsnew, $this->tipoinmueble->CurrentValue, NULL, $this->tipoinmueble->ReadOnly);

			// id_ciudad_inmueble
			$this->id_ciudad_inmueble->SetDbValueDef($rsnew, $this->id_ciudad_inmueble->CurrentValue, NULL, $this->id_ciudad_inmueble->ReadOnly);

			// id_provincia_inmueble
			$this->id_provincia_inmueble->SetDbValueDef($rsnew, $this->id_provincia_inmueble->CurrentValue, NULL, $this->id_provincia_inmueble->ReadOnly);

			// imagen_inmueble02
			if ($this->imagen_inmueble02->Visible && !$this->imagen_inmueble02->ReadOnly && !$this->imagen_inmueble02->Upload->KeepFile) {
				if (is_null($this->imagen_inmueble02->Upload->Value)) {
					$rsnew['imagen_inmueble02'] = NULL;
				} else {
					$rsnew['imagen_inmueble02'] = $this->imagen_inmueble02->Upload->Value;
				}
			}

			// imagen_inmueble03
			if ($this->imagen_inmueble03->Visible && !$this->imagen_inmueble03->ReadOnly && !$this->imagen_inmueble03->Upload->KeepFile) {
				if (is_null($this->imagen_inmueble03->Upload->Value)) {
					$rsnew['imagen_inmueble03'] = NULL;
				} else {
					$rsnew['imagen_inmueble03'] = $this->imagen_inmueble03->Upload->Value;
				}
			}

			// imagen_inmueble04
			if ($this->imagen_inmueble04->Visible && !$this->imagen_inmueble04->ReadOnly && !$this->imagen_inmueble04->Upload->KeepFile) {
				if (is_null($this->imagen_inmueble04->Upload->Value)) {
					$rsnew['imagen_inmueble04'] = NULL;
				} else {
					$rsnew['imagen_inmueble04'] = $this->imagen_inmueble04->Upload->Value;
				}
			}

			// imagen_inmueble05
			if ($this->imagen_inmueble05->Visible && !$this->imagen_inmueble05->ReadOnly && !$this->imagen_inmueble05->Upload->KeepFile) {
				if (is_null($this->imagen_inmueble05->Upload->Value)) {
					$rsnew['imagen_inmueble05'] = NULL;
				} else {
					$rsnew['imagen_inmueble05'] = $this->imagen_inmueble05->Upload->Value;
				}
			}

			// tipovehiculo
			$this->tipovehiculo->SetDbValueDef($rsnew, $this->tipovehiculo->CurrentValue, NULL, $this->tipovehiculo->ReadOnly);

			// id_ciudad_vehiculo
			$this->id_ciudad_vehiculo->SetDbValueDef($rsnew, $this->id_ciudad_vehiculo->CurrentValue, NULL, $this->id_ciudad_vehiculo->ReadOnly);

			// id_provincia_vehiculo
			$this->id_provincia_vehiculo->SetDbValueDef($rsnew, $this->id_provincia_vehiculo->CurrentValue, NULL, $this->id_provincia_vehiculo->ReadOnly);

			// imagen_vehiculo02
			if ($this->imagen_vehiculo02->Visible && !$this->imagen_vehiculo02->ReadOnly && !$this->imagen_vehiculo02->Upload->KeepFile) {
				if (is_null($this->imagen_vehiculo02->Upload->Value)) {
					$rsnew['imagen_vehiculo02'] = NULL;
				} else {
					$rsnew['imagen_vehiculo02'] = $this->imagen_vehiculo02->Upload->Value;
				}
			}

			// imagen_vehiculo03
			if ($this->imagen_vehiculo03->Visible && !$this->imagen_vehiculo03->ReadOnly && !$this->imagen_vehiculo03->Upload->KeepFile) {
				if (is_null($this->imagen_vehiculo03->Upload->Value)) {
					$rsnew['imagen_vehiculo03'] = NULL;
				} else {
					$rsnew['imagen_vehiculo03'] = $this->imagen_vehiculo03->Upload->Value;
				}
			}

			// imagen_vehiculo05
			if ($this->imagen_vehiculo05->Visible && !$this->imagen_vehiculo05->ReadOnly && !$this->imagen_vehiculo05->Upload->KeepFile) {
				if (is_null($this->imagen_vehiculo05->Upload->Value)) {
					$rsnew['imagen_vehiculo05'] = NULL;
				} else {
					$rsnew['imagen_vehiculo05'] = $this->imagen_vehiculo05->Upload->Value;
				}
			}

			// imagen_vehiculo06
			if ($this->imagen_vehiculo06->Visible && !$this->imagen_vehiculo06->ReadOnly && !$this->imagen_vehiculo06->Upload->KeepFile) {
				if (is_null($this->imagen_vehiculo06->Upload->Value)) {
					$rsnew['imagen_vehiculo06'] = NULL;
				} else {
					$rsnew['imagen_vehiculo06'] = $this->imagen_vehiculo06->Upload->Value;
				}
			}

			// imagen_vehiculo07
			if ($this->imagen_vehiculo07->Visible && !$this->imagen_vehiculo07->ReadOnly && !$this->imagen_vehiculo07->Upload->KeepFile) {
				if (is_null($this->imagen_vehiculo07->Upload->Value)) {
					$rsnew['imagen_vehiculo07'] = NULL;
				} else {
					$rsnew['imagen_vehiculo07'] = $this->imagen_vehiculo07->Upload->Value;
				}
			}

			// tipomaquinaria
			$this->tipomaquinaria->SetDbValueDef($rsnew, $this->tipomaquinaria->CurrentValue, NULL, $this->tipomaquinaria->ReadOnly);

			// id_ciudad_maquinaria
			$this->id_ciudad_maquinaria->SetDbValueDef($rsnew, $this->id_ciudad_maquinaria->CurrentValue, NULL, $this->id_ciudad_maquinaria->ReadOnly);

			// id_provincia_maquinaria
			$this->id_provincia_maquinaria->SetDbValueDef($rsnew, $this->id_provincia_maquinaria->CurrentValue, NULL, $this->id_provincia_maquinaria->ReadOnly);

			// imagen_maquinaria02
			if ($this->imagen_maquinaria02->Visible && !$this->imagen_maquinaria02->ReadOnly && !$this->imagen_maquinaria02->Upload->KeepFile) {
				if (is_null($this->imagen_maquinaria02->Upload->Value)) {
					$rsnew['imagen_maquinaria02'] = NULL;
				} else {
					$rsnew['imagen_maquinaria02'] = $this->imagen_maquinaria02->Upload->Value;
				}
			}

			// imagen_maquinaria05
			if ($this->imagen_maquinaria05->Visible && !$this->imagen_maquinaria05->ReadOnly && !$this->imagen_maquinaria05->Upload->KeepFile) {
				if (is_null($this->imagen_maquinaria05->Upload->Value)) {
					$rsnew['imagen_maquinaria05'] = NULL;
				} else {
					$rsnew['imagen_maquinaria05'] = $this->imagen_maquinaria05->Upload->Value;
				}
			}

			// imagen_maquinaria06
			if ($this->imagen_maquinaria06->Visible && !$this->imagen_maquinaria06->ReadOnly && !$this->imagen_maquinaria06->Upload->KeepFile) {
				if (is_null($this->imagen_maquinaria06->Upload->Value)) {
					$rsnew['imagen_maquinaria06'] = NULL;
				} else {
					$rsnew['imagen_maquinaria06'] = $this->imagen_maquinaria06->Upload->Value;
				}
			}

			// imagen_maquinaria07
			if ($this->imagen_maquinaria07->Visible && !$this->imagen_maquinaria07->ReadOnly && !$this->imagen_maquinaria07->Upload->KeepFile) {
				if (is_null($this->imagen_maquinaria07->Upload->Value)) {
					$rsnew['imagen_maquinaria07'] = NULL;
				} else {
					$rsnew['imagen_maquinaria07'] = $this->imagen_maquinaria07->Upload->Value;
				}
			}

			// tipomercaderia
			$this->tipomercaderia->SetDbValueDef($rsnew, $this->tipomercaderia->CurrentValue, NULL, $this->tipomercaderia->ReadOnly);

			// imagen_mercaderia01
			if ($this->imagen_mercaderia01->Visible && !$this->imagen_mercaderia01->ReadOnly && !$this->imagen_mercaderia01->Upload->KeepFile) {
				if (is_null($this->imagen_mercaderia01->Upload->Value)) {
					$rsnew['imagen_mercaderia01'] = NULL;
				} else {
					$rsnew['imagen_mercaderia01'] = $this->imagen_mercaderia01->Upload->Value;
				}
			}

			// documento_mercaderia
			$this->documento_mercaderia->SetDbValueDef($rsnew, $this->documento_mercaderia->CurrentValue, NULL, $this->documento_mercaderia->ReadOnly);

			// tipoespecial
			$this->tipoespecial->SetDbValueDef($rsnew, $this->tipoespecial->CurrentValue, NULL, $this->tipoespecial->ReadOnly);

			// imagen_tipoespecial01
			if ($this->imagen_tipoespecial01->Visible && !$this->imagen_tipoespecial01->ReadOnly && !$this->imagen_tipoespecial01->Upload->KeepFile) {
				if (is_null($this->imagen_tipoespecial01->Upload->Value)) {
					$rsnew['imagen_tipoespecial01'] = NULL;
				} else {
					$rsnew['imagen_tipoespecial01'] = $this->imagen_tipoespecial01->Upload->Value;
				}
			}

			// email_contacto
			$this->email_contacto->SetDbValueDef($rsnew, $this->email_contacto->CurrentValue, NULL, $this->email_contacto->ReadOnly);

			// Call Row Updating event
			$bUpdateRow = $this->Row_Updating($rsold, $rsnew);
			if ($bUpdateRow) {
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				if (count($rsnew) > 0)
					$EditRow = $this->Update($rsnew, "", $rsold);
				else
					$EditRow = TRUE; // No field to update
				$conn->raiseErrorFn = '';
				if ($EditRow) {
				}

				// Update detail records
				$DetailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($EditRow) {
					if (in_array("avaluo", $DetailTblVar) && $GLOBALS["avaluo"]->DetailEdit) {
						if (!isset($GLOBALS["avaluo_grid"])) $GLOBALS["avaluo_grid"] = new cavaluo_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "avaluo"); // Load user level of detail table
						$EditRow = $GLOBALS["avaluo_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}

				// Commit/Rollback transaction
				if ($this->getCurrentDetailTable() <> "") {
					if ($EditRow) {
						$conn->CommitTrans(); // Commit transaction
					} else {
						$conn->RollbackTrans(); // Rollback transaction
					}
				}
			} else {
				if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

					// Use the message, do nothing
				} elseif ($this->CancelMessage <> "") {
					$this->setFailureMessage($this->CancelMessage);
					$this->CancelMessage = "";
				} else {
					$this->setFailureMessage($Language->Phrase("UpdateCancelled"));
				}
				$EditRow = FALSE;
			}
		}

		// Call Row_Updated event
		if ($EditRow)
			$this->Row_Updated($rsold, $rsnew);
		$rs->Close();

		// imagen_inmueble02
		ew_CleanUploadTempPath($this->imagen_inmueble02, $this->imagen_inmueble02->Upload->Index);

		// imagen_inmueble03
		ew_CleanUploadTempPath($this->imagen_inmueble03, $this->imagen_inmueble03->Upload->Index);

		// imagen_inmueble04
		ew_CleanUploadTempPath($this->imagen_inmueble04, $this->imagen_inmueble04->Upload->Index);

		// imagen_inmueble05
		ew_CleanUploadTempPath($this->imagen_inmueble05, $this->imagen_inmueble05->Upload->Index);

		// imagen_vehiculo02
		ew_CleanUploadTempPath($this->imagen_vehiculo02, $this->imagen_vehiculo02->Upload->Index);

		// imagen_vehiculo03
		ew_CleanUploadTempPath($this->imagen_vehiculo03, $this->imagen_vehiculo03->Upload->Index);

		// imagen_vehiculo05
		ew_CleanUploadTempPath($this->imagen_vehiculo05, $this->imagen_vehiculo05->Upload->Index);

		// imagen_vehiculo06
		ew_CleanUploadTempPath($this->imagen_vehiculo06, $this->imagen_vehiculo06->Upload->Index);

		// imagen_vehiculo07
		ew_CleanUploadTempPath($this->imagen_vehiculo07, $this->imagen_vehiculo07->Upload->Index);

		// imagen_maquinaria02
		ew_CleanUploadTempPath($this->imagen_maquinaria02, $this->imagen_maquinaria02->Upload->Index);

		// imagen_maquinaria05
		ew_CleanUploadTempPath($this->imagen_maquinaria05, $this->imagen_maquinaria05->Upload->Index);

		// imagen_maquinaria06
		ew_CleanUploadTempPath($this->imagen_maquinaria06, $this->imagen_maquinaria06->Upload->Index);

		// imagen_maquinaria07
		ew_CleanUploadTempPath($this->imagen_maquinaria07, $this->imagen_maquinaria07->Upload->Index);

		// imagen_mercaderia01
		ew_CleanUploadTempPath($this->imagen_mercaderia01, $this->imagen_mercaderia01->Upload->Index);

		// imagen_tipoespecial01
		ew_CleanUploadTempPath($this->imagen_tipoespecial01, $this->imagen_tipoespecial01->Upload->Index);
		return $EditRow;
	}

	// Set up detail parms based on QueryString
	function SetupDetailParms() {

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_DETAIL])) {
			$sDetailTblVar = $_GET[EW_TABLE_SHOW_DETAIL];
			$this->setCurrentDetailTable($sDetailTblVar);
		} else {
			$sDetailTblVar = $this->getCurrentDetailTable();
		}
		if ($sDetailTblVar <> "") {
			$DetailTblVar = explode(",", $sDetailTblVar);
			if (in_array("avaluo", $DetailTblVar)) {
				if (!isset($GLOBALS["avaluo_grid"]))
					$GLOBALS["avaluo_grid"] = new cavaluo_grid;
				if ($GLOBALS["avaluo_grid"]->DetailEdit) {
					$GLOBALS["avaluo_grid"]->CurrentMode = "edit";
					$GLOBALS["avaluo_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["avaluo_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["avaluo_grid"]->setStartRecordNumber(1);
					$GLOBALS["avaluo_grid"]->id_solicitud->FldIsDetailKey = TRUE;
					$GLOBALS["avaluo_grid"]->id_solicitud->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["avaluo_grid"]->id_solicitud->setSessionValue($GLOBALS["avaluo_grid"]->id_solicitud->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("solicitudlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Set up multi pages
	function SetupMultiPages() {
		$pages = new cSubPages();
		$pages->Style = "tabs";
		$pages->Add(0);
		$pages->Add(1);
		$pages->Add(2);
		$pages->Add(3);
		$pages->Add(4);
		$pages->Add(5);
		$pages->Add(6);
		$this->MultiPages = $pages;
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_id_sucursal":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`nombre`');
			$lookuptblfilter = "`id`='".$_SESSION["sucursal"]."'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_sucursal, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_tipoinmueble":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `nombre` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`nombre`');
			$lookuptblfilter = "`tipo`='INMUEBLE'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`nombre` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tipoinmueble, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_ciudad_inmueble":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_ciudad_inmueble, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_provincia_inmueble":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_provincia_inmueble, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_tipovehiculo":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `nombre` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`nombre`');
			$lookuptblfilter = "`tipo`='VEHICULO'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`nombre` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tipovehiculo, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_ciudad_vehiculo":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_ciudad_vehiculo, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_provincia_vehiculo":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_provincia_vehiculo, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_tipomaquinaria":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `nombre` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`nombre`');
			$lookuptblfilter = "`tipo`='MAQUINARIA'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`nombre` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tipomaquinaria, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_ciudad_maquinaria":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_ciudad_maquinaria, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_provincia_maquinaria":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_provincia_maquinaria, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_tipomercaderia":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id_tipoinmueble` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`nombre`');
			$lookuptblfilter = "`tipo`='MERCADERIA'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id_tipoinmueble` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tipomercaderia, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_tipoespecial":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id_tipoinmueble` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`nombre`');
			$lookuptblfilter = "`tipo`='ESPECIAL'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id_tipoinmueble` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tipoespecial, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_email_contacto":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `login` AS `LinkFld`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`login` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->email_contacto, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		}
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
	// $type = ''|'success'|'failure'|'warning'
	function Message_Showing(&$msg, $type) {
		if ($type == 'success') {

			//$msg = "your success message";
		} elseif ($type == 'failure') {

			//$msg = "your failure message";
		} elseif ($type == 'warning') {

			//$msg = "your warning message";
		} else {

			//$msg = "your message";
		}
	}

	// Page Render event
	function Page_Render() {

		//$header = "<button class='btn ewButton' name='convertapp' id='convertapp' type='submit'>Convert to Application</button>";
		//echo $header;

	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {	
	$button1 = "<a href=solicitudcore.php?showmaster=solicitud&fk_id=".$_GET['id']." class='btn btn-primary'". "role='button' aria-pressed='true'>"."Cerrar Solicitud</a>";
			$button2="";
			$button3="";
			if ($_SESSION["rol"]==3)
			{
			$button2 = "<a href=avaluocore.php?type=validar&id=".$_GET['id']." class='btn btn-warning'". "role='button' aria-pressed='true'>"."Validar Doc Faltante</a>";
			$button3="<div class=\"btn-group\">";
			$button3.="<button class=\"btn btn-secondary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
			$button3.="Notificar";
			$button3.="</button>";
			$button3.="<ul class=\"dropdown-menu\" aria-labelledby=\"dropdownMenuButton\">";
			$button3.="<li><a class=\"dropdown-item\" href=avaluocore.php?type=email&id=".$_GET['id'].">Enviar Correo</a></li>";
			$button3.="<li><a class=\"dropdown-item\" href=avaluocore.php?type=notify&id=".$_GET['id'].">Enviar Notificacion</a></li>";
			$button3.="<li><a class=\"dropdown-item\" href=avaluocore.php?type=sms&id=".$_GET['id'].">Enviar SMS</a></li>";
			$button3.="</ul>";
			$button3.="</div>";
			}
			$header = "<div>".$button1." ".$button2." ".$button3."</div>";
	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($solicitud_edit)) $solicitud_edit = new csolicitud_edit();

// Page init
$solicitud_edit->Page_Init();

// Page main
$solicitud_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$solicitud_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fsolicitudedit = new ew_Form("fsolicitudedit", "edit");

// Validate form
fsolicitudedit.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_name");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $solicitud->name->FldCaption(), $solicitud->name->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lastname");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $solicitud->lastname->FldCaption(), $solicitud->lastname->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "__email");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $solicitud->_email->FldCaption(), $solicitud->_email->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_id_sucursal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $solicitud->id_sucursal->FldCaption(), $solicitud->id_sucursal->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fsolicitudedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fsolicitudedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
fsolicitudedit.MultiPage = new ew_MultiPage("fsolicitudedit");

// Dynamic selection lists
fsolicitudedit.Lists["x_id_sucursal"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"sucursal"};
fsolicitudedit.Lists["x_id_sucursal"].Data = "<?php echo $solicitud_edit->id_sucursal->LookupFilterQuery(FALSE, "edit") ?>";
fsolicitudedit.Lists["x_tipoinmueble[]"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fsolicitudedit.Lists["x_tipoinmueble[]"].Data = "<?php echo $solicitud_edit->tipoinmueble->LookupFilterQuery(FALSE, "edit") ?>";
fsolicitudedit.Lists["x_id_ciudad_inmueble"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"departamento"};
fsolicitudedit.Lists["x_id_ciudad_inmueble"].Data = "<?php echo $solicitud_edit->id_ciudad_inmueble->LookupFilterQuery(FALSE, "edit") ?>";
fsolicitudedit.Lists["x_id_provincia_inmueble"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"provincia"};
fsolicitudedit.Lists["x_id_provincia_inmueble"].Data = "<?php echo $solicitud_edit->id_provincia_inmueble->LookupFilterQuery(FALSE, "edit") ?>";
fsolicitudedit.Lists["x_tipovehiculo[]"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fsolicitudedit.Lists["x_tipovehiculo[]"].Data = "<?php echo $solicitud_edit->tipovehiculo->LookupFilterQuery(FALSE, "edit") ?>";
fsolicitudedit.Lists["x_id_ciudad_vehiculo"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"departamento"};
fsolicitudedit.Lists["x_id_ciudad_vehiculo"].Data = "<?php echo $solicitud_edit->id_ciudad_vehiculo->LookupFilterQuery(FALSE, "edit") ?>";
fsolicitudedit.Lists["x_id_provincia_vehiculo"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"provincia"};
fsolicitudedit.Lists["x_id_provincia_vehiculo"].Data = "<?php echo $solicitud_edit->id_provincia_vehiculo->LookupFilterQuery(FALSE, "edit") ?>";
fsolicitudedit.Lists["x_tipomaquinaria[]"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fsolicitudedit.Lists["x_tipomaquinaria[]"].Data = "<?php echo $solicitud_edit->tipomaquinaria->LookupFilterQuery(FALSE, "edit") ?>";
fsolicitudedit.Lists["x_id_ciudad_maquinaria"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"departamento"};
fsolicitudedit.Lists["x_id_ciudad_maquinaria"].Data = "<?php echo $solicitud_edit->id_ciudad_maquinaria->LookupFilterQuery(FALSE, "edit") ?>";
fsolicitudedit.Lists["x_id_provincia_maquinaria"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"provincia"};
fsolicitudedit.Lists["x_id_provincia_maquinaria"].Data = "<?php echo $solicitud_edit->id_provincia_maquinaria->LookupFilterQuery(FALSE, "edit") ?>";
fsolicitudedit.Lists["x_tipomercaderia[]"] = {"LinkField":"x_id_tipoinmueble","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fsolicitudedit.Lists["x_tipomercaderia[]"].Data = "<?php echo $solicitud_edit->tipomercaderia->LookupFilterQuery(FALSE, "edit") ?>";
fsolicitudedit.Lists["x_tipoespecial[]"] = {"LinkField":"x_id_tipoinmueble","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fsolicitudedit.Lists["x_tipoespecial[]"].Data = "<?php echo $solicitud_edit->tipoespecial->LookupFilterQuery(FALSE, "edit") ?>";
fsolicitudedit.Lists["x_email_contacto"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fsolicitudedit.Lists["x_email_contacto"].Data = "<?php echo $solicitud_edit->email_contacto->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $solicitud_edit->ShowPageHeader(); ?>
<?php
$solicitud_edit->ShowMessage();
?>
<form name="fsolicitudedit" id="fsolicitudedit" class="<?php echo $solicitud_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($solicitud_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $solicitud_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="solicitud">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($solicitud_edit->IsModal) ?>">
<?php if (!$solicitud_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="solicitud_edit"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $solicitud_edit->MultiPages->NavStyle() ?>">
		<li<?php echo $solicitud_edit->MultiPages->TabStyle("1") ?>><a href="#tab_solicitud1" data-toggle="tab"><?php echo $solicitud->PageCaption(1) ?></a></li>
		<li<?php echo $solicitud_edit->MultiPages->TabStyle("2") ?>><a href="#tab_solicitud2" data-toggle="tab"><?php echo $solicitud->PageCaption(2) ?></a></li>
		<li<?php echo $solicitud_edit->MultiPages->TabStyle("3") ?>><a href="#tab_solicitud3" data-toggle="tab"><?php echo $solicitud->PageCaption(3) ?></a></li>
		<li<?php echo $solicitud_edit->MultiPages->TabStyle("4") ?>><a href="#tab_solicitud4" data-toggle="tab"><?php echo $solicitud->PageCaption(4) ?></a></li>
		<li<?php echo $solicitud_edit->MultiPages->TabStyle("5") ?>><a href="#tab_solicitud5" data-toggle="tab"><?php echo $solicitud->PageCaption(5) ?></a></li>
		<li<?php echo $solicitud_edit->MultiPages->TabStyle("6") ?>><a href="#tab_solicitud6" data-toggle="tab"><?php echo $solicitud->PageCaption(6) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $solicitud_edit->MultiPages->PageStyle("1") ?>" id="tab_solicitud1"><!-- multi-page .tab-pane -->
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_solicitudedit1" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($solicitud->nombre_contacto->Visible) { // nombre_contacto ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_nombre_contacto" class="form-group">
		<label id="elh_solicitud_nombre_contacto" for="x_nombre_contacto" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->nombre_contacto->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->nombre_contacto->CellAttributes() ?>>
<span id="el_solicitud_nombre_contacto">
<input type="text" data-table="solicitud" data-field="x_nombre_contacto" data-page="1" name="x_nombre_contacto" id="x_nombre_contacto" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($solicitud->nombre_contacto->getPlaceHolder()) ?>" value="<?php echo $solicitud->nombre_contacto->EditValue ?>"<?php echo $solicitud->nombre_contacto->EditAttributes() ?>>
</span>
<?php echo $solicitud->nombre_contacto->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_nombre_contacto">
		<td class="col-sm-3"><span id="elh_solicitud_nombre_contacto"><?php echo $solicitud->nombre_contacto->FldCaption() ?></span></td>
		<td<?php echo $solicitud->nombre_contacto->CellAttributes() ?>>
<span id="el_solicitud_nombre_contacto">
<input type="text" data-table="solicitud" data-field="x_nombre_contacto" data-page="1" name="x_nombre_contacto" id="x_nombre_contacto" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($solicitud->nombre_contacto->getPlaceHolder()) ?>" value="<?php echo $solicitud->nombre_contacto->EditValue ?>"<?php echo $solicitud->nombre_contacto->EditAttributes() ?>>
</span>
<?php echo $solicitud->nombre_contacto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->name->Visible) { // name ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_name" class="form-group">
		<label id="elh_solicitud_name" for="x_name" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->name->CellAttributes() ?>>
<span id="el_solicitud_name">
<input type="text" data-table="solicitud" data-field="x_name" data-page="1" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($solicitud->name->getPlaceHolder()) ?>" value="<?php echo $solicitud->name->EditValue ?>"<?php echo $solicitud->name->EditAttributes() ?>>
</span>
<?php echo $solicitud->name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_name">
		<td class="col-sm-3"><span id="elh_solicitud_name"><?php echo $solicitud->name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $solicitud->name->CellAttributes() ?>>
<span id="el_solicitud_name">
<input type="text" data-table="solicitud" data-field="x_name" data-page="1" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($solicitud->name->getPlaceHolder()) ?>" value="<?php echo $solicitud->name->EditValue ?>"<?php echo $solicitud->name->EditAttributes() ?>>
</span>
<?php echo $solicitud->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->lastname->Visible) { // lastname ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_lastname" class="form-group">
		<label id="elh_solicitud_lastname" for="x_lastname" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->lastname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->lastname->CellAttributes() ?>>
<span id="el_solicitud_lastname">
<input type="text" data-table="solicitud" data-field="x_lastname" data-page="1" name="x_lastname" id="x_lastname" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($solicitud->lastname->getPlaceHolder()) ?>" value="<?php echo $solicitud->lastname->EditValue ?>"<?php echo $solicitud->lastname->EditAttributes() ?>>
</span>
<?php echo $solicitud->lastname->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_lastname">
		<td class="col-sm-3"><span id="elh_solicitud_lastname"><?php echo $solicitud->lastname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $solicitud->lastname->CellAttributes() ?>>
<span id="el_solicitud_lastname">
<input type="text" data-table="solicitud" data-field="x_lastname" data-page="1" name="x_lastname" id="x_lastname" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($solicitud->lastname->getPlaceHolder()) ?>" value="<?php echo $solicitud->lastname->EditValue ?>"<?php echo $solicitud->lastname->EditAttributes() ?>>
</span>
<?php echo $solicitud->lastname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->_email->Visible) { // email ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r__email" class="form-group">
		<label id="elh_solicitud__email" for="x__email" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->_email->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->_email->CellAttributes() ?>>
<span id="el_solicitud__email">
<input type="text" data-table="solicitud" data-field="x__email" data-page="1" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($solicitud->_email->getPlaceHolder()) ?>" value="<?php echo $solicitud->_email->EditValue ?>"<?php echo $solicitud->_email->EditAttributes() ?>>
</span>
<?php echo $solicitud->_email->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__email">
		<td class="col-sm-3"><span id="elh_solicitud__email"><?php echo $solicitud->_email->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $solicitud->_email->CellAttributes() ?>>
<span id="el_solicitud__email">
<input type="text" data-table="solicitud" data-field="x__email" data-page="1" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($solicitud->_email->getPlaceHolder()) ?>" value="<?php echo $solicitud->_email->EditValue ?>"<?php echo $solicitud->_email->EditAttributes() ?>>
</span>
<?php echo $solicitud->_email->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->address->Visible) { // address ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_address" class="form-group">
		<label id="elh_solicitud_address" for="x_address" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->address->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->address->CellAttributes() ?>>
<span id="el_solicitud_address">
<textarea data-table="solicitud" data-field="x_address" data-page="1" name="x_address" id="x_address" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($solicitud->address->getPlaceHolder()) ?>"<?php echo $solicitud->address->EditAttributes() ?>><?php echo $solicitud->address->EditValue ?></textarea>
</span>
<?php echo $solicitud->address->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address">
		<td class="col-sm-3"><span id="elh_solicitud_address"><?php echo $solicitud->address->FldCaption() ?></span></td>
		<td<?php echo $solicitud->address->CellAttributes() ?>>
<span id="el_solicitud_address">
<textarea data-table="solicitud" data-field="x_address" data-page="1" name="x_address" id="x_address" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($solicitud->address->getPlaceHolder()) ?>"<?php echo $solicitud->address->EditAttributes() ?>><?php echo $solicitud->address->EditValue ?></textarea>
</span>
<?php echo $solicitud->address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->phone->Visible) { // phone ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_phone" class="form-group">
		<label id="elh_solicitud_phone" for="x_phone" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->phone->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->phone->CellAttributes() ?>>
<span id="el_solicitud_phone">
<input type="text" data-table="solicitud" data-field="x_phone" data-page="1" name="x_phone" id="x_phone" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($solicitud->phone->getPlaceHolder()) ?>" value="<?php echo $solicitud->phone->EditValue ?>"<?php echo $solicitud->phone->EditAttributes() ?>>
</span>
<?php echo $solicitud->phone->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_phone">
		<td class="col-sm-3"><span id="elh_solicitud_phone"><?php echo $solicitud->phone->FldCaption() ?></span></td>
		<td<?php echo $solicitud->phone->CellAttributes() ?>>
<span id="el_solicitud_phone">
<input type="text" data-table="solicitud" data-field="x_phone" data-page="1" name="x_phone" id="x_phone" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($solicitud->phone->getPlaceHolder()) ?>" value="<?php echo $solicitud->phone->EditValue ?>"<?php echo $solicitud->phone->EditAttributes() ?>>
</span>
<?php echo $solicitud->phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->cell->Visible) { // cell ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_cell" class="form-group">
		<label id="elh_solicitud_cell" for="x_cell" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->cell->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->cell->CellAttributes() ?>>
<span id="el_solicitud_cell">
<input type="text" data-table="solicitud" data-field="x_cell" data-page="1" name="x_cell" id="x_cell" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($solicitud->cell->getPlaceHolder()) ?>" value="<?php echo $solicitud->cell->EditValue ?>"<?php echo $solicitud->cell->EditAttributes() ?>>
</span>
<?php echo $solicitud->cell->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cell">
		<td class="col-sm-3"><span id="elh_solicitud_cell"><?php echo $solicitud->cell->FldCaption() ?></span></td>
		<td<?php echo $solicitud->cell->CellAttributes() ?>>
<span id="el_solicitud_cell">
<input type="text" data-table="solicitud" data-field="x_cell" data-page="1" name="x_cell" id="x_cell" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($solicitud->cell->getPlaceHolder()) ?>" value="<?php echo $solicitud->cell->EditValue ?>"<?php echo $solicitud->cell->EditAttributes() ?>>
</span>
<?php echo $solicitud->cell->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->created_at->Visible) { // created_at ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_created_at" class="form-group">
		<label id="elh_solicitud_created_at" for="x_created_at" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->created_at->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->created_at->CellAttributes() ?>>
<span id="el_solicitud_created_at">
<span<?php echo $solicitud->created_at->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $solicitud->created_at->EditValue ?></p></span>
</span>
<input type="hidden" data-table="solicitud" data-field="x_created_at" data-page="1" name="x_created_at" id="x_created_at" value="<?php echo ew_HtmlEncode($solicitud->created_at->CurrentValue) ?>">
<?php echo $solicitud->created_at->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_created_at">
		<td class="col-sm-3"><span id="elh_solicitud_created_at"><?php echo $solicitud->created_at->FldCaption() ?></span></td>
		<td<?php echo $solicitud->created_at->CellAttributes() ?>>
<span id="el_solicitud_created_at">
<span<?php echo $solicitud->created_at->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $solicitud->created_at->EditValue ?></p></span>
</span>
<input type="hidden" data-table="solicitud" data-field="x_created_at" data-page="1" name="x_created_at" id="x_created_at" value="<?php echo ew_HtmlEncode($solicitud->created_at->CurrentValue) ?>">
<?php echo $solicitud->created_at->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->id_sucursal->Visible) { // id_sucursal ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_id_sucursal" class="form-group">
		<label id="elh_solicitud_id_sucursal" for="x_id_sucursal" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->id_sucursal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->id_sucursal->CellAttributes() ?>>
<span id="el_solicitud_id_sucursal">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_id_sucursal"><?php echo (strval($solicitud->id_sucursal->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->id_sucursal->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->id_sucursal->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_id_sucursal',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->id_sucursal->ReadOnly || $solicitud->id_sucursal->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_id_sucursal" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $solicitud->id_sucursal->DisplayValueSeparatorAttribute() ?>" name="x_id_sucursal" id="x_id_sucursal" value="<?php echo $solicitud->id_sucursal->CurrentValue ?>"<?php echo $solicitud->id_sucursal->EditAttributes() ?>>
</span>
<?php echo $solicitud->id_sucursal->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_sucursal">
		<td class="col-sm-3"><span id="elh_solicitud_id_sucursal"><?php echo $solicitud->id_sucursal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $solicitud->id_sucursal->CellAttributes() ?>>
<span id="el_solicitud_id_sucursal">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_id_sucursal"><?php echo (strval($solicitud->id_sucursal->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->id_sucursal->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->id_sucursal->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_id_sucursal',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->id_sucursal->ReadOnly || $solicitud->id_sucursal->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_id_sucursal" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $solicitud->id_sucursal->DisplayValueSeparatorAttribute() ?>" name="x_id_sucursal" id="x_id_sucursal" value="<?php echo $solicitud->id_sucursal->CurrentValue ?>"<?php echo $solicitud->id_sucursal->EditAttributes() ?>>
</span>
<?php echo $solicitud->id_sucursal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->email_contacto->Visible) { // email_contacto ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_email_contacto" class="form-group">
		<label id="elh_solicitud_email_contacto" for="x_email_contacto" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->email_contacto->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->email_contacto->CellAttributes() ?>>
<span id="el_solicitud_email_contacto">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_email_contacto"><?php echo (strval($solicitud->email_contacto->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->email_contacto->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->email_contacto->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_email_contacto',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->email_contacto->ReadOnly || $solicitud->email_contacto->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_email_contacto" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $solicitud->email_contacto->DisplayValueSeparatorAttribute() ?>" name="x_email_contacto" id="x_email_contacto" value="<?php echo $solicitud->email_contacto->CurrentValue ?>"<?php echo $solicitud->email_contacto->EditAttributes() ?>>
</span>
<?php echo $solicitud->email_contacto->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_email_contacto">
		<td class="col-sm-3"><span id="elh_solicitud_email_contacto"><?php echo $solicitud->email_contacto->FldCaption() ?></span></td>
		<td<?php echo $solicitud->email_contacto->CellAttributes() ?>>
<span id="el_solicitud_email_contacto">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_email_contacto"><?php echo (strval($solicitud->email_contacto->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->email_contacto->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->email_contacto->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_email_contacto',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->email_contacto->ReadOnly || $solicitud->email_contacto->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_email_contacto" data-page="1" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $solicitud->email_contacto->DisplayValueSeparatorAttribute() ?>" name="x_email_contacto" id="x_email_contacto" value="<?php echo $solicitud->email_contacto->CurrentValue ?>"<?php echo $solicitud->email_contacto->EditAttributes() ?>>
</span>
<?php echo $solicitud->email_contacto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $solicitud_edit->MultiPages->PageStyle("2") ?>" id="tab_solicitud2"><!-- multi-page .tab-pane -->
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_solicitudedit2" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($solicitud->tipoinmueble->Visible) { // tipoinmueble ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_tipoinmueble" class="form-group">
		<label id="elh_solicitud_tipoinmueble" for="x_tipoinmueble" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->tipoinmueble->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->tipoinmueble->CellAttributes() ?>>
<span id="el_solicitud_tipoinmueble">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipoinmueble"><?php echo (strval($solicitud->tipoinmueble->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->tipoinmueble->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->tipoinmueble->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipoinmueble[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->tipoinmueble->ReadOnly || $solicitud->tipoinmueble->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_tipoinmueble" data-page="2" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $solicitud->tipoinmueble->DisplayValueSeparatorAttribute() ?>" name="x_tipoinmueble[]" id="x_tipoinmueble[]" value="<?php echo $solicitud->tipoinmueble->CurrentValue ?>"<?php echo $solicitud->tipoinmueble->EditAttributes() ?>>
</span>
<?php echo $solicitud->tipoinmueble->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipoinmueble">
		<td class="col-sm-3"><span id="elh_solicitud_tipoinmueble"><?php echo $solicitud->tipoinmueble->FldCaption() ?></span></td>
		<td<?php echo $solicitud->tipoinmueble->CellAttributes() ?>>
<span id="el_solicitud_tipoinmueble">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipoinmueble"><?php echo (strval($solicitud->tipoinmueble->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->tipoinmueble->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->tipoinmueble->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipoinmueble[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->tipoinmueble->ReadOnly || $solicitud->tipoinmueble->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_tipoinmueble" data-page="2" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $solicitud->tipoinmueble->DisplayValueSeparatorAttribute() ?>" name="x_tipoinmueble[]" id="x_tipoinmueble[]" value="<?php echo $solicitud->tipoinmueble->CurrentValue ?>"<?php echo $solicitud->tipoinmueble->EditAttributes() ?>>
</span>
<?php echo $solicitud->tipoinmueble->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->id_ciudad_inmueble->Visible) { // id_ciudad_inmueble ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_id_ciudad_inmueble" class="form-group">
		<label id="elh_solicitud_id_ciudad_inmueble" for="x_id_ciudad_inmueble" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->id_ciudad_inmueble->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->id_ciudad_inmueble->CellAttributes() ?>>
<span id="el_solicitud_id_ciudad_inmueble">
<select data-table="solicitud" data-field="x_id_ciudad_inmueble" data-page="2" data-value-separator="<?php echo $solicitud->id_ciudad_inmueble->DisplayValueSeparatorAttribute() ?>" id="x_id_ciudad_inmueble" name="x_id_ciudad_inmueble"<?php echo $solicitud->id_ciudad_inmueble->EditAttributes() ?>>
<?php echo $solicitud->id_ciudad_inmueble->SelectOptionListHtml("x_id_ciudad_inmueble") ?>
</select>
</span>
<?php echo $solicitud->id_ciudad_inmueble->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_ciudad_inmueble">
		<td class="col-sm-3"><span id="elh_solicitud_id_ciudad_inmueble"><?php echo $solicitud->id_ciudad_inmueble->FldCaption() ?></span></td>
		<td<?php echo $solicitud->id_ciudad_inmueble->CellAttributes() ?>>
<span id="el_solicitud_id_ciudad_inmueble">
<select data-table="solicitud" data-field="x_id_ciudad_inmueble" data-page="2" data-value-separator="<?php echo $solicitud->id_ciudad_inmueble->DisplayValueSeparatorAttribute() ?>" id="x_id_ciudad_inmueble" name="x_id_ciudad_inmueble"<?php echo $solicitud->id_ciudad_inmueble->EditAttributes() ?>>
<?php echo $solicitud->id_ciudad_inmueble->SelectOptionListHtml("x_id_ciudad_inmueble") ?>
</select>
</span>
<?php echo $solicitud->id_ciudad_inmueble->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->id_provincia_inmueble->Visible) { // id_provincia_inmueble ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_id_provincia_inmueble" class="form-group">
		<label id="elh_solicitud_id_provincia_inmueble" for="x_id_provincia_inmueble" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->id_provincia_inmueble->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->id_provincia_inmueble->CellAttributes() ?>>
<span id="el_solicitud_id_provincia_inmueble">
<select data-table="solicitud" data-field="x_id_provincia_inmueble" data-page="2" data-value-separator="<?php echo $solicitud->id_provincia_inmueble->DisplayValueSeparatorAttribute() ?>" id="x_id_provincia_inmueble" name="x_id_provincia_inmueble"<?php echo $solicitud->id_provincia_inmueble->EditAttributes() ?>>
<?php echo $solicitud->id_provincia_inmueble->SelectOptionListHtml("x_id_provincia_inmueble") ?>
</select>
</span>
<?php echo $solicitud->id_provincia_inmueble->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_provincia_inmueble">
		<td class="col-sm-3"><span id="elh_solicitud_id_provincia_inmueble"><?php echo $solicitud->id_provincia_inmueble->FldCaption() ?></span></td>
		<td<?php echo $solicitud->id_provincia_inmueble->CellAttributes() ?>>
<span id="el_solicitud_id_provincia_inmueble">
<select data-table="solicitud" data-field="x_id_provincia_inmueble" data-page="2" data-value-separator="<?php echo $solicitud->id_provincia_inmueble->DisplayValueSeparatorAttribute() ?>" id="x_id_provincia_inmueble" name="x_id_provincia_inmueble"<?php echo $solicitud->id_provincia_inmueble->EditAttributes() ?>>
<?php echo $solicitud->id_provincia_inmueble->SelectOptionListHtml("x_id_provincia_inmueble") ?>
</select>
</span>
<?php echo $solicitud->id_provincia_inmueble->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_inmueble02->Visible) { // imagen_inmueble02 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_inmueble02" class="form-group">
		<label id="elh_solicitud_imagen_inmueble02" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_inmueble02->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_inmueble02->CellAttributes() ?>>
<span id="el_solicitud_imagen_inmueble02">
<div id="fd_x_imagen_inmueble02">
<span title="<?php echo $solicitud->imagen_inmueble02->FldTitle() ? $solicitud->imagen_inmueble02->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_inmueble02->ReadOnly || $solicitud->imagen_inmueble02->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_inmueble02" data-page="2" name="x_imagen_inmueble02" id="x_imagen_inmueble02"<?php echo $solicitud->imagen_inmueble02->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble02" id= "fn_x_imagen_inmueble02" value="<?php echo $solicitud->imagen_inmueble02->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble02"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble02" id= "fa_x_imagen_inmueble02" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble02" id= "fa_x_imagen_inmueble02" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble02" id= "fs_x_imagen_inmueble02" value="0">
<input type="hidden" name="fx_x_imagen_inmueble02" id= "fx_x_imagen_inmueble02" value="<?php echo $solicitud->imagen_inmueble02->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble02" id= "fm_x_imagen_inmueble02" value="<?php echo $solicitud->imagen_inmueble02->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble02" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_inmueble02->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_inmueble02">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_inmueble02"><?php echo $solicitud->imagen_inmueble02->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_inmueble02->CellAttributes() ?>>
<span id="el_solicitud_imagen_inmueble02">
<div id="fd_x_imagen_inmueble02">
<span title="<?php echo $solicitud->imagen_inmueble02->FldTitle() ? $solicitud->imagen_inmueble02->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_inmueble02->ReadOnly || $solicitud->imagen_inmueble02->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_inmueble02" data-page="2" name="x_imagen_inmueble02" id="x_imagen_inmueble02"<?php echo $solicitud->imagen_inmueble02->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble02" id= "fn_x_imagen_inmueble02" value="<?php echo $solicitud->imagen_inmueble02->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble02"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble02" id= "fa_x_imagen_inmueble02" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble02" id= "fa_x_imagen_inmueble02" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble02" id= "fs_x_imagen_inmueble02" value="0">
<input type="hidden" name="fx_x_imagen_inmueble02" id= "fx_x_imagen_inmueble02" value="<?php echo $solicitud->imagen_inmueble02->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble02" id= "fm_x_imagen_inmueble02" value="<?php echo $solicitud->imagen_inmueble02->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble02" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_inmueble02->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_inmueble03->Visible) { // imagen_inmueble03 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_inmueble03" class="form-group">
		<label id="elh_solicitud_imagen_inmueble03" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_inmueble03->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_inmueble03->CellAttributes() ?>>
<span id="el_solicitud_imagen_inmueble03">
<div id="fd_x_imagen_inmueble03">
<span title="<?php echo $solicitud->imagen_inmueble03->FldTitle() ? $solicitud->imagen_inmueble03->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_inmueble03->ReadOnly || $solicitud->imagen_inmueble03->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_inmueble03" data-page="2" name="x_imagen_inmueble03" id="x_imagen_inmueble03"<?php echo $solicitud->imagen_inmueble03->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble03" id= "fn_x_imagen_inmueble03" value="<?php echo $solicitud->imagen_inmueble03->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble03"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble03" id= "fa_x_imagen_inmueble03" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble03" id= "fa_x_imagen_inmueble03" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble03" id= "fs_x_imagen_inmueble03" value="0">
<input type="hidden" name="fx_x_imagen_inmueble03" id= "fx_x_imagen_inmueble03" value="<?php echo $solicitud->imagen_inmueble03->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble03" id= "fm_x_imagen_inmueble03" value="<?php echo $solicitud->imagen_inmueble03->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble03" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_inmueble03->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_inmueble03">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_inmueble03"><?php echo $solicitud->imagen_inmueble03->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_inmueble03->CellAttributes() ?>>
<span id="el_solicitud_imagen_inmueble03">
<div id="fd_x_imagen_inmueble03">
<span title="<?php echo $solicitud->imagen_inmueble03->FldTitle() ? $solicitud->imagen_inmueble03->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_inmueble03->ReadOnly || $solicitud->imagen_inmueble03->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_inmueble03" data-page="2" name="x_imagen_inmueble03" id="x_imagen_inmueble03"<?php echo $solicitud->imagen_inmueble03->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble03" id= "fn_x_imagen_inmueble03" value="<?php echo $solicitud->imagen_inmueble03->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble03"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble03" id= "fa_x_imagen_inmueble03" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble03" id= "fa_x_imagen_inmueble03" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble03" id= "fs_x_imagen_inmueble03" value="0">
<input type="hidden" name="fx_x_imagen_inmueble03" id= "fx_x_imagen_inmueble03" value="<?php echo $solicitud->imagen_inmueble03->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble03" id= "fm_x_imagen_inmueble03" value="<?php echo $solicitud->imagen_inmueble03->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble03" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_inmueble03->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_inmueble04->Visible) { // imagen_inmueble04 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_inmueble04" class="form-group">
		<label id="elh_solicitud_imagen_inmueble04" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_inmueble04->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_inmueble04->CellAttributes() ?>>
<span id="el_solicitud_imagen_inmueble04">
<div id="fd_x_imagen_inmueble04">
<span title="<?php echo $solicitud->imagen_inmueble04->FldTitle() ? $solicitud->imagen_inmueble04->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_inmueble04->ReadOnly || $solicitud->imagen_inmueble04->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_inmueble04" data-page="2" name="x_imagen_inmueble04" id="x_imagen_inmueble04"<?php echo $solicitud->imagen_inmueble04->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble04" id= "fn_x_imagen_inmueble04" value="<?php echo $solicitud->imagen_inmueble04->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble04"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble04" id= "fa_x_imagen_inmueble04" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble04" id= "fa_x_imagen_inmueble04" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble04" id= "fs_x_imagen_inmueble04" value="0">
<input type="hidden" name="fx_x_imagen_inmueble04" id= "fx_x_imagen_inmueble04" value="<?php echo $solicitud->imagen_inmueble04->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble04" id= "fm_x_imagen_inmueble04" value="<?php echo $solicitud->imagen_inmueble04->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble04" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_inmueble04->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_inmueble04">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_inmueble04"><?php echo $solicitud->imagen_inmueble04->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_inmueble04->CellAttributes() ?>>
<span id="el_solicitud_imagen_inmueble04">
<div id="fd_x_imagen_inmueble04">
<span title="<?php echo $solicitud->imagen_inmueble04->FldTitle() ? $solicitud->imagen_inmueble04->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_inmueble04->ReadOnly || $solicitud->imagen_inmueble04->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_inmueble04" data-page="2" name="x_imagen_inmueble04" id="x_imagen_inmueble04"<?php echo $solicitud->imagen_inmueble04->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble04" id= "fn_x_imagen_inmueble04" value="<?php echo $solicitud->imagen_inmueble04->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble04"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble04" id= "fa_x_imagen_inmueble04" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble04" id= "fa_x_imagen_inmueble04" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble04" id= "fs_x_imagen_inmueble04" value="0">
<input type="hidden" name="fx_x_imagen_inmueble04" id= "fx_x_imagen_inmueble04" value="<?php echo $solicitud->imagen_inmueble04->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble04" id= "fm_x_imagen_inmueble04" value="<?php echo $solicitud->imagen_inmueble04->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble04" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_inmueble04->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_inmueble05->Visible) { // imagen_inmueble05 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_inmueble05" class="form-group">
		<label id="elh_solicitud_imagen_inmueble05" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_inmueble05->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_inmueble05->CellAttributes() ?>>
<span id="el_solicitud_imagen_inmueble05">
<div id="fd_x_imagen_inmueble05">
<span title="<?php echo $solicitud->imagen_inmueble05->FldTitle() ? $solicitud->imagen_inmueble05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_inmueble05->ReadOnly || $solicitud->imagen_inmueble05->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_inmueble05" data-page="2" name="x_imagen_inmueble05" id="x_imagen_inmueble05"<?php echo $solicitud->imagen_inmueble05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble05" id= "fn_x_imagen_inmueble05" value="<?php echo $solicitud->imagen_inmueble05->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble05"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble05" id= "fa_x_imagen_inmueble05" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble05" id= "fa_x_imagen_inmueble05" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble05" id= "fs_x_imagen_inmueble05" value="0">
<input type="hidden" name="fx_x_imagen_inmueble05" id= "fx_x_imagen_inmueble05" value="<?php echo $solicitud->imagen_inmueble05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble05" id= "fm_x_imagen_inmueble05" value="<?php echo $solicitud->imagen_inmueble05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_inmueble05->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_inmueble05">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_inmueble05"><?php echo $solicitud->imagen_inmueble05->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_inmueble05->CellAttributes() ?>>
<span id="el_solicitud_imagen_inmueble05">
<div id="fd_x_imagen_inmueble05">
<span title="<?php echo $solicitud->imagen_inmueble05->FldTitle() ? $solicitud->imagen_inmueble05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_inmueble05->ReadOnly || $solicitud->imagen_inmueble05->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_inmueble05" data-page="2" name="x_imagen_inmueble05" id="x_imagen_inmueble05"<?php echo $solicitud->imagen_inmueble05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble05" id= "fn_x_imagen_inmueble05" value="<?php echo $solicitud->imagen_inmueble05->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble05"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble05" id= "fa_x_imagen_inmueble05" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble05" id= "fa_x_imagen_inmueble05" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble05" id= "fs_x_imagen_inmueble05" value="0">
<input type="hidden" name="fx_x_imagen_inmueble05" id= "fx_x_imagen_inmueble05" value="<?php echo $solicitud->imagen_inmueble05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble05" id= "fm_x_imagen_inmueble05" value="<?php echo $solicitud->imagen_inmueble05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_inmueble05->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $solicitud_edit->MultiPages->PageStyle("3") ?>" id="tab_solicitud3"><!-- multi-page .tab-pane -->
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_solicitudedit3" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($solicitud->tipovehiculo->Visible) { // tipovehiculo ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_tipovehiculo" class="form-group">
		<label id="elh_solicitud_tipovehiculo" for="x_tipovehiculo" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->tipovehiculo->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->tipovehiculo->CellAttributes() ?>>
<span id="el_solicitud_tipovehiculo">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipovehiculo"><?php echo (strval($solicitud->tipovehiculo->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->tipovehiculo->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->tipovehiculo->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipovehiculo[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->tipovehiculo->ReadOnly || $solicitud->tipovehiculo->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_tipovehiculo" data-page="3" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $solicitud->tipovehiculo->DisplayValueSeparatorAttribute() ?>" name="x_tipovehiculo[]" id="x_tipovehiculo[]" value="<?php echo $solicitud->tipovehiculo->CurrentValue ?>"<?php echo $solicitud->tipovehiculo->EditAttributes() ?>>
</span>
<?php echo $solicitud->tipovehiculo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipovehiculo">
		<td class="col-sm-3"><span id="elh_solicitud_tipovehiculo"><?php echo $solicitud->tipovehiculo->FldCaption() ?></span></td>
		<td<?php echo $solicitud->tipovehiculo->CellAttributes() ?>>
<span id="el_solicitud_tipovehiculo">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipovehiculo"><?php echo (strval($solicitud->tipovehiculo->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->tipovehiculo->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->tipovehiculo->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipovehiculo[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->tipovehiculo->ReadOnly || $solicitud->tipovehiculo->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_tipovehiculo" data-page="3" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $solicitud->tipovehiculo->DisplayValueSeparatorAttribute() ?>" name="x_tipovehiculo[]" id="x_tipovehiculo[]" value="<?php echo $solicitud->tipovehiculo->CurrentValue ?>"<?php echo $solicitud->tipovehiculo->EditAttributes() ?>>
</span>
<?php echo $solicitud->tipovehiculo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->id_ciudad_vehiculo->Visible) { // id_ciudad_vehiculo ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_id_ciudad_vehiculo" class="form-group">
		<label id="elh_solicitud_id_ciudad_vehiculo" for="x_id_ciudad_vehiculo" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->id_ciudad_vehiculo->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->id_ciudad_vehiculo->CellAttributes() ?>>
<span id="el_solicitud_id_ciudad_vehiculo">
<select data-table="solicitud" data-field="x_id_ciudad_vehiculo" data-page="3" data-value-separator="<?php echo $solicitud->id_ciudad_vehiculo->DisplayValueSeparatorAttribute() ?>" id="x_id_ciudad_vehiculo" name="x_id_ciudad_vehiculo"<?php echo $solicitud->id_ciudad_vehiculo->EditAttributes() ?>>
<?php echo $solicitud->id_ciudad_vehiculo->SelectOptionListHtml("x_id_ciudad_vehiculo") ?>
</select>
</span>
<?php echo $solicitud->id_ciudad_vehiculo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_ciudad_vehiculo">
		<td class="col-sm-3"><span id="elh_solicitud_id_ciudad_vehiculo"><?php echo $solicitud->id_ciudad_vehiculo->FldCaption() ?></span></td>
		<td<?php echo $solicitud->id_ciudad_vehiculo->CellAttributes() ?>>
<span id="el_solicitud_id_ciudad_vehiculo">
<select data-table="solicitud" data-field="x_id_ciudad_vehiculo" data-page="3" data-value-separator="<?php echo $solicitud->id_ciudad_vehiculo->DisplayValueSeparatorAttribute() ?>" id="x_id_ciudad_vehiculo" name="x_id_ciudad_vehiculo"<?php echo $solicitud->id_ciudad_vehiculo->EditAttributes() ?>>
<?php echo $solicitud->id_ciudad_vehiculo->SelectOptionListHtml("x_id_ciudad_vehiculo") ?>
</select>
</span>
<?php echo $solicitud->id_ciudad_vehiculo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->id_provincia_vehiculo->Visible) { // id_provincia_vehiculo ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_id_provincia_vehiculo" class="form-group">
		<label id="elh_solicitud_id_provincia_vehiculo" for="x_id_provincia_vehiculo" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->id_provincia_vehiculo->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->id_provincia_vehiculo->CellAttributes() ?>>
<span id="el_solicitud_id_provincia_vehiculo">
<select data-table="solicitud" data-field="x_id_provincia_vehiculo" data-page="3" data-value-separator="<?php echo $solicitud->id_provincia_vehiculo->DisplayValueSeparatorAttribute() ?>" id="x_id_provincia_vehiculo" name="x_id_provincia_vehiculo"<?php echo $solicitud->id_provincia_vehiculo->EditAttributes() ?>>
<?php echo $solicitud->id_provincia_vehiculo->SelectOptionListHtml("x_id_provincia_vehiculo") ?>
</select>
</span>
<?php echo $solicitud->id_provincia_vehiculo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_provincia_vehiculo">
		<td class="col-sm-3"><span id="elh_solicitud_id_provincia_vehiculo"><?php echo $solicitud->id_provincia_vehiculo->FldCaption() ?></span></td>
		<td<?php echo $solicitud->id_provincia_vehiculo->CellAttributes() ?>>
<span id="el_solicitud_id_provincia_vehiculo">
<select data-table="solicitud" data-field="x_id_provincia_vehiculo" data-page="3" data-value-separator="<?php echo $solicitud->id_provincia_vehiculo->DisplayValueSeparatorAttribute() ?>" id="x_id_provincia_vehiculo" name="x_id_provincia_vehiculo"<?php echo $solicitud->id_provincia_vehiculo->EditAttributes() ?>>
<?php echo $solicitud->id_provincia_vehiculo->SelectOptionListHtml("x_id_provincia_vehiculo") ?>
</select>
</span>
<?php echo $solicitud->id_provincia_vehiculo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_vehiculo02->Visible) { // imagen_vehiculo02 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_vehiculo02" class="form-group">
		<label id="elh_solicitud_imagen_vehiculo02" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_vehiculo02->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_vehiculo02->CellAttributes() ?>>
<span id="el_solicitud_imagen_vehiculo02">
<div id="fd_x_imagen_vehiculo02">
<span title="<?php echo $solicitud->imagen_vehiculo02->FldTitle() ? $solicitud->imagen_vehiculo02->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_vehiculo02->ReadOnly || $solicitud->imagen_vehiculo02->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_vehiculo02" data-page="3" name="x_imagen_vehiculo02" id="x_imagen_vehiculo02"<?php echo $solicitud->imagen_vehiculo02->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo02" id= "fn_x_imagen_vehiculo02" value="<?php echo $solicitud->imagen_vehiculo02->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo02"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo02" id= "fa_x_imagen_vehiculo02" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo02" id= "fa_x_imagen_vehiculo02" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo02" id= "fs_x_imagen_vehiculo02" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo02" id= "fx_x_imagen_vehiculo02" value="<?php echo $solicitud->imagen_vehiculo02->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo02" id= "fm_x_imagen_vehiculo02" value="<?php echo $solicitud->imagen_vehiculo02->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo02" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_vehiculo02->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_vehiculo02">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_vehiculo02"><?php echo $solicitud->imagen_vehiculo02->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_vehiculo02->CellAttributes() ?>>
<span id="el_solicitud_imagen_vehiculo02">
<div id="fd_x_imagen_vehiculo02">
<span title="<?php echo $solicitud->imagen_vehiculo02->FldTitle() ? $solicitud->imagen_vehiculo02->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_vehiculo02->ReadOnly || $solicitud->imagen_vehiculo02->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_vehiculo02" data-page="3" name="x_imagen_vehiculo02" id="x_imagen_vehiculo02"<?php echo $solicitud->imagen_vehiculo02->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo02" id= "fn_x_imagen_vehiculo02" value="<?php echo $solicitud->imagen_vehiculo02->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo02"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo02" id= "fa_x_imagen_vehiculo02" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo02" id= "fa_x_imagen_vehiculo02" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo02" id= "fs_x_imagen_vehiculo02" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo02" id= "fx_x_imagen_vehiculo02" value="<?php echo $solicitud->imagen_vehiculo02->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo02" id= "fm_x_imagen_vehiculo02" value="<?php echo $solicitud->imagen_vehiculo02->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo02" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_vehiculo02->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_vehiculo03->Visible) { // imagen_vehiculo03 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_vehiculo03" class="form-group">
		<label id="elh_solicitud_imagen_vehiculo03" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_vehiculo03->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_vehiculo03->CellAttributes() ?>>
<span id="el_solicitud_imagen_vehiculo03">
<div id="fd_x_imagen_vehiculo03">
<span title="<?php echo $solicitud->imagen_vehiculo03->FldTitle() ? $solicitud->imagen_vehiculo03->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_vehiculo03->ReadOnly || $solicitud->imagen_vehiculo03->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_vehiculo03" data-page="3" name="x_imagen_vehiculo03" id="x_imagen_vehiculo03"<?php echo $solicitud->imagen_vehiculo03->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo03" id= "fn_x_imagen_vehiculo03" value="<?php echo $solicitud->imagen_vehiculo03->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo03"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo03" id= "fa_x_imagen_vehiculo03" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo03" id= "fa_x_imagen_vehiculo03" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo03" id= "fs_x_imagen_vehiculo03" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo03" id= "fx_x_imagen_vehiculo03" value="<?php echo $solicitud->imagen_vehiculo03->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo03" id= "fm_x_imagen_vehiculo03" value="<?php echo $solicitud->imagen_vehiculo03->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo03" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_vehiculo03->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_vehiculo03">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_vehiculo03"><?php echo $solicitud->imagen_vehiculo03->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_vehiculo03->CellAttributes() ?>>
<span id="el_solicitud_imagen_vehiculo03">
<div id="fd_x_imagen_vehiculo03">
<span title="<?php echo $solicitud->imagen_vehiculo03->FldTitle() ? $solicitud->imagen_vehiculo03->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_vehiculo03->ReadOnly || $solicitud->imagen_vehiculo03->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_vehiculo03" data-page="3" name="x_imagen_vehiculo03" id="x_imagen_vehiculo03"<?php echo $solicitud->imagen_vehiculo03->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo03" id= "fn_x_imagen_vehiculo03" value="<?php echo $solicitud->imagen_vehiculo03->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo03"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo03" id= "fa_x_imagen_vehiculo03" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo03" id= "fa_x_imagen_vehiculo03" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo03" id= "fs_x_imagen_vehiculo03" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo03" id= "fx_x_imagen_vehiculo03" value="<?php echo $solicitud->imagen_vehiculo03->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo03" id= "fm_x_imagen_vehiculo03" value="<?php echo $solicitud->imagen_vehiculo03->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo03" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_vehiculo03->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_vehiculo05->Visible) { // imagen_vehiculo05 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_vehiculo05" class="form-group">
		<label id="elh_solicitud_imagen_vehiculo05" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_vehiculo05->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_vehiculo05->CellAttributes() ?>>
<span id="el_solicitud_imagen_vehiculo05">
<div id="fd_x_imagen_vehiculo05">
<span title="<?php echo $solicitud->imagen_vehiculo05->FldTitle() ? $solicitud->imagen_vehiculo05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_vehiculo05->ReadOnly || $solicitud->imagen_vehiculo05->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_vehiculo05" data-page="3" name="x_imagen_vehiculo05" id="x_imagen_vehiculo05"<?php echo $solicitud->imagen_vehiculo05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo05" id= "fn_x_imagen_vehiculo05" value="<?php echo $solicitud->imagen_vehiculo05->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo05"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo05" id= "fa_x_imagen_vehiculo05" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo05" id= "fa_x_imagen_vehiculo05" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo05" id= "fs_x_imagen_vehiculo05" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo05" id= "fx_x_imagen_vehiculo05" value="<?php echo $solicitud->imagen_vehiculo05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo05" id= "fm_x_imagen_vehiculo05" value="<?php echo $solicitud->imagen_vehiculo05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_vehiculo05->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_vehiculo05">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_vehiculo05"><?php echo $solicitud->imagen_vehiculo05->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_vehiculo05->CellAttributes() ?>>
<span id="el_solicitud_imagen_vehiculo05">
<div id="fd_x_imagen_vehiculo05">
<span title="<?php echo $solicitud->imagen_vehiculo05->FldTitle() ? $solicitud->imagen_vehiculo05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_vehiculo05->ReadOnly || $solicitud->imagen_vehiculo05->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_vehiculo05" data-page="3" name="x_imagen_vehiculo05" id="x_imagen_vehiculo05"<?php echo $solicitud->imagen_vehiculo05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo05" id= "fn_x_imagen_vehiculo05" value="<?php echo $solicitud->imagen_vehiculo05->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo05"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo05" id= "fa_x_imagen_vehiculo05" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo05" id= "fa_x_imagen_vehiculo05" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo05" id= "fs_x_imagen_vehiculo05" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo05" id= "fx_x_imagen_vehiculo05" value="<?php echo $solicitud->imagen_vehiculo05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo05" id= "fm_x_imagen_vehiculo05" value="<?php echo $solicitud->imagen_vehiculo05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_vehiculo05->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_vehiculo06->Visible) { // imagen_vehiculo06 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_vehiculo06" class="form-group">
		<label id="elh_solicitud_imagen_vehiculo06" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_vehiculo06->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_vehiculo06->CellAttributes() ?>>
<span id="el_solicitud_imagen_vehiculo06">
<div id="fd_x_imagen_vehiculo06">
<span title="<?php echo $solicitud->imagen_vehiculo06->FldTitle() ? $solicitud->imagen_vehiculo06->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_vehiculo06->ReadOnly || $solicitud->imagen_vehiculo06->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_vehiculo06" data-page="3" name="x_imagen_vehiculo06" id="x_imagen_vehiculo06"<?php echo $solicitud->imagen_vehiculo06->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo06" id= "fn_x_imagen_vehiculo06" value="<?php echo $solicitud->imagen_vehiculo06->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo06"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo06" id= "fa_x_imagen_vehiculo06" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo06" id= "fa_x_imagen_vehiculo06" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo06" id= "fs_x_imagen_vehiculo06" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo06" id= "fx_x_imagen_vehiculo06" value="<?php echo $solicitud->imagen_vehiculo06->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo06" id= "fm_x_imagen_vehiculo06" value="<?php echo $solicitud->imagen_vehiculo06->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo06" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_vehiculo06->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_vehiculo06">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_vehiculo06"><?php echo $solicitud->imagen_vehiculo06->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_vehiculo06->CellAttributes() ?>>
<span id="el_solicitud_imagen_vehiculo06">
<div id="fd_x_imagen_vehiculo06">
<span title="<?php echo $solicitud->imagen_vehiculo06->FldTitle() ? $solicitud->imagen_vehiculo06->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_vehiculo06->ReadOnly || $solicitud->imagen_vehiculo06->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_vehiculo06" data-page="3" name="x_imagen_vehiculo06" id="x_imagen_vehiculo06"<?php echo $solicitud->imagen_vehiculo06->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo06" id= "fn_x_imagen_vehiculo06" value="<?php echo $solicitud->imagen_vehiculo06->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo06"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo06" id= "fa_x_imagen_vehiculo06" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo06" id= "fa_x_imagen_vehiculo06" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo06" id= "fs_x_imagen_vehiculo06" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo06" id= "fx_x_imagen_vehiculo06" value="<?php echo $solicitud->imagen_vehiculo06->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo06" id= "fm_x_imagen_vehiculo06" value="<?php echo $solicitud->imagen_vehiculo06->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo06" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_vehiculo06->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_vehiculo07->Visible) { // imagen_vehiculo07 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_vehiculo07" class="form-group">
		<label id="elh_solicitud_imagen_vehiculo07" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_vehiculo07->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_vehiculo07->CellAttributes() ?>>
<span id="el_solicitud_imagen_vehiculo07">
<div id="fd_x_imagen_vehiculo07">
<span title="<?php echo $solicitud->imagen_vehiculo07->FldTitle() ? $solicitud->imagen_vehiculo07->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_vehiculo07->ReadOnly || $solicitud->imagen_vehiculo07->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_vehiculo07" data-page="3" name="x_imagen_vehiculo07" id="x_imagen_vehiculo07"<?php echo $solicitud->imagen_vehiculo07->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo07" id= "fn_x_imagen_vehiculo07" value="<?php echo $solicitud->imagen_vehiculo07->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo07"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo07" id= "fa_x_imagen_vehiculo07" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo07" id= "fa_x_imagen_vehiculo07" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo07" id= "fs_x_imagen_vehiculo07" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo07" id= "fx_x_imagen_vehiculo07" value="<?php echo $solicitud->imagen_vehiculo07->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo07" id= "fm_x_imagen_vehiculo07" value="<?php echo $solicitud->imagen_vehiculo07->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo07" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_vehiculo07->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_vehiculo07">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_vehiculo07"><?php echo $solicitud->imagen_vehiculo07->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_vehiculo07->CellAttributes() ?>>
<span id="el_solicitud_imagen_vehiculo07">
<div id="fd_x_imagen_vehiculo07">
<span title="<?php echo $solicitud->imagen_vehiculo07->FldTitle() ? $solicitud->imagen_vehiculo07->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_vehiculo07->ReadOnly || $solicitud->imagen_vehiculo07->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_vehiculo07" data-page="3" name="x_imagen_vehiculo07" id="x_imagen_vehiculo07"<?php echo $solicitud->imagen_vehiculo07->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo07" id= "fn_x_imagen_vehiculo07" value="<?php echo $solicitud->imagen_vehiculo07->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo07"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo07" id= "fa_x_imagen_vehiculo07" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo07" id= "fa_x_imagen_vehiculo07" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo07" id= "fs_x_imagen_vehiculo07" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo07" id= "fx_x_imagen_vehiculo07" value="<?php echo $solicitud->imagen_vehiculo07->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo07" id= "fm_x_imagen_vehiculo07" value="<?php echo $solicitud->imagen_vehiculo07->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo07" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_vehiculo07->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $solicitud_edit->MultiPages->PageStyle("4") ?>" id="tab_solicitud4"><!-- multi-page .tab-pane -->
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_solicitudedit4" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($solicitud->tipomaquinaria->Visible) { // tipomaquinaria ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_tipomaquinaria" class="form-group">
		<label id="elh_solicitud_tipomaquinaria" for="x_tipomaquinaria" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->tipomaquinaria->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->tipomaquinaria->CellAttributes() ?>>
<span id="el_solicitud_tipomaquinaria">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipomaquinaria"><?php echo (strval($solicitud->tipomaquinaria->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->tipomaquinaria->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->tipomaquinaria->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipomaquinaria[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->tipomaquinaria->ReadOnly || $solicitud->tipomaquinaria->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_tipomaquinaria" data-page="4" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $solicitud->tipomaquinaria->DisplayValueSeparatorAttribute() ?>" name="x_tipomaquinaria[]" id="x_tipomaquinaria[]" value="<?php echo $solicitud->tipomaquinaria->CurrentValue ?>"<?php echo $solicitud->tipomaquinaria->EditAttributes() ?>>
</span>
<?php echo $solicitud->tipomaquinaria->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipomaquinaria">
		<td class="col-sm-3"><span id="elh_solicitud_tipomaquinaria"><?php echo $solicitud->tipomaquinaria->FldCaption() ?></span></td>
		<td<?php echo $solicitud->tipomaquinaria->CellAttributes() ?>>
<span id="el_solicitud_tipomaquinaria">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipomaquinaria"><?php echo (strval($solicitud->tipomaquinaria->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->tipomaquinaria->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->tipomaquinaria->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipomaquinaria[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->tipomaquinaria->ReadOnly || $solicitud->tipomaquinaria->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_tipomaquinaria" data-page="4" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $solicitud->tipomaquinaria->DisplayValueSeparatorAttribute() ?>" name="x_tipomaquinaria[]" id="x_tipomaquinaria[]" value="<?php echo $solicitud->tipomaquinaria->CurrentValue ?>"<?php echo $solicitud->tipomaquinaria->EditAttributes() ?>>
</span>
<?php echo $solicitud->tipomaquinaria->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->id_ciudad_maquinaria->Visible) { // id_ciudad_maquinaria ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_id_ciudad_maquinaria" class="form-group">
		<label id="elh_solicitud_id_ciudad_maquinaria" for="x_id_ciudad_maquinaria" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->id_ciudad_maquinaria->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->id_ciudad_maquinaria->CellAttributes() ?>>
<span id="el_solicitud_id_ciudad_maquinaria">
<select data-table="solicitud" data-field="x_id_ciudad_maquinaria" data-page="4" data-value-separator="<?php echo $solicitud->id_ciudad_maquinaria->DisplayValueSeparatorAttribute() ?>" id="x_id_ciudad_maquinaria" name="x_id_ciudad_maquinaria"<?php echo $solicitud->id_ciudad_maquinaria->EditAttributes() ?>>
<?php echo $solicitud->id_ciudad_maquinaria->SelectOptionListHtml("x_id_ciudad_maquinaria") ?>
</select>
</span>
<?php echo $solicitud->id_ciudad_maquinaria->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_ciudad_maquinaria">
		<td class="col-sm-3"><span id="elh_solicitud_id_ciudad_maquinaria"><?php echo $solicitud->id_ciudad_maquinaria->FldCaption() ?></span></td>
		<td<?php echo $solicitud->id_ciudad_maquinaria->CellAttributes() ?>>
<span id="el_solicitud_id_ciudad_maquinaria">
<select data-table="solicitud" data-field="x_id_ciudad_maquinaria" data-page="4" data-value-separator="<?php echo $solicitud->id_ciudad_maquinaria->DisplayValueSeparatorAttribute() ?>" id="x_id_ciudad_maquinaria" name="x_id_ciudad_maquinaria"<?php echo $solicitud->id_ciudad_maquinaria->EditAttributes() ?>>
<?php echo $solicitud->id_ciudad_maquinaria->SelectOptionListHtml("x_id_ciudad_maquinaria") ?>
</select>
</span>
<?php echo $solicitud->id_ciudad_maquinaria->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->id_provincia_maquinaria->Visible) { // id_provincia_maquinaria ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_id_provincia_maquinaria" class="form-group">
		<label id="elh_solicitud_id_provincia_maquinaria" for="x_id_provincia_maquinaria" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->id_provincia_maquinaria->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->id_provincia_maquinaria->CellAttributes() ?>>
<span id="el_solicitud_id_provincia_maquinaria">
<select data-table="solicitud" data-field="x_id_provincia_maquinaria" data-page="4" data-value-separator="<?php echo $solicitud->id_provincia_maquinaria->DisplayValueSeparatorAttribute() ?>" id="x_id_provincia_maquinaria" name="x_id_provincia_maquinaria"<?php echo $solicitud->id_provincia_maquinaria->EditAttributes() ?>>
<?php echo $solicitud->id_provincia_maquinaria->SelectOptionListHtml("x_id_provincia_maquinaria") ?>
</select>
</span>
<?php echo $solicitud->id_provincia_maquinaria->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_provincia_maquinaria">
		<td class="col-sm-3"><span id="elh_solicitud_id_provincia_maquinaria"><?php echo $solicitud->id_provincia_maquinaria->FldCaption() ?></span></td>
		<td<?php echo $solicitud->id_provincia_maquinaria->CellAttributes() ?>>
<span id="el_solicitud_id_provincia_maquinaria">
<select data-table="solicitud" data-field="x_id_provincia_maquinaria" data-page="4" data-value-separator="<?php echo $solicitud->id_provincia_maquinaria->DisplayValueSeparatorAttribute() ?>" id="x_id_provincia_maquinaria" name="x_id_provincia_maquinaria"<?php echo $solicitud->id_provincia_maquinaria->EditAttributes() ?>>
<?php echo $solicitud->id_provincia_maquinaria->SelectOptionListHtml("x_id_provincia_maquinaria") ?>
</select>
</span>
<?php echo $solicitud->id_provincia_maquinaria->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_maquinaria02->Visible) { // imagen_maquinaria02 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_maquinaria02" class="form-group">
		<label id="elh_solicitud_imagen_maquinaria02" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_maquinaria02->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_maquinaria02->CellAttributes() ?>>
<span id="el_solicitud_imagen_maquinaria02">
<div id="fd_x_imagen_maquinaria02">
<span title="<?php echo $solicitud->imagen_maquinaria02->FldTitle() ? $solicitud->imagen_maquinaria02->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_maquinaria02->ReadOnly || $solicitud->imagen_maquinaria02->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_maquinaria02" data-page="4" name="x_imagen_maquinaria02" id="x_imagen_maquinaria02"<?php echo $solicitud->imagen_maquinaria02->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria02" id= "fn_x_imagen_maquinaria02" value="<?php echo $solicitud->imagen_maquinaria02->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria02"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria02" id= "fa_x_imagen_maquinaria02" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria02" id= "fa_x_imagen_maquinaria02" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria02" id= "fs_x_imagen_maquinaria02" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria02" id= "fx_x_imagen_maquinaria02" value="<?php echo $solicitud->imagen_maquinaria02->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria02" id= "fm_x_imagen_maquinaria02" value="<?php echo $solicitud->imagen_maquinaria02->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria02" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_maquinaria02->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_maquinaria02">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_maquinaria02"><?php echo $solicitud->imagen_maquinaria02->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_maquinaria02->CellAttributes() ?>>
<span id="el_solicitud_imagen_maquinaria02">
<div id="fd_x_imagen_maquinaria02">
<span title="<?php echo $solicitud->imagen_maquinaria02->FldTitle() ? $solicitud->imagen_maquinaria02->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_maquinaria02->ReadOnly || $solicitud->imagen_maquinaria02->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_maquinaria02" data-page="4" name="x_imagen_maquinaria02" id="x_imagen_maquinaria02"<?php echo $solicitud->imagen_maquinaria02->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria02" id= "fn_x_imagen_maquinaria02" value="<?php echo $solicitud->imagen_maquinaria02->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria02"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria02" id= "fa_x_imagen_maquinaria02" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria02" id= "fa_x_imagen_maquinaria02" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria02" id= "fs_x_imagen_maquinaria02" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria02" id= "fx_x_imagen_maquinaria02" value="<?php echo $solicitud->imagen_maquinaria02->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria02" id= "fm_x_imagen_maquinaria02" value="<?php echo $solicitud->imagen_maquinaria02->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria02" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_maquinaria02->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_maquinaria05->Visible) { // imagen_maquinaria05 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_maquinaria05" class="form-group">
		<label id="elh_solicitud_imagen_maquinaria05" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_maquinaria05->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_maquinaria05->CellAttributes() ?>>
<span id="el_solicitud_imagen_maquinaria05">
<div id="fd_x_imagen_maquinaria05">
<span title="<?php echo $solicitud->imagen_maquinaria05->FldTitle() ? $solicitud->imagen_maquinaria05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_maquinaria05->ReadOnly || $solicitud->imagen_maquinaria05->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_maquinaria05" data-page="4" name="x_imagen_maquinaria05" id="x_imagen_maquinaria05"<?php echo $solicitud->imagen_maquinaria05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria05" id= "fn_x_imagen_maquinaria05" value="<?php echo $solicitud->imagen_maquinaria05->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria05"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria05" id= "fa_x_imagen_maquinaria05" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria05" id= "fa_x_imagen_maquinaria05" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria05" id= "fs_x_imagen_maquinaria05" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria05" id= "fx_x_imagen_maquinaria05" value="<?php echo $solicitud->imagen_maquinaria05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria05" id= "fm_x_imagen_maquinaria05" value="<?php echo $solicitud->imagen_maquinaria05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_maquinaria05->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_maquinaria05">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_maquinaria05"><?php echo $solicitud->imagen_maquinaria05->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_maquinaria05->CellAttributes() ?>>
<span id="el_solicitud_imagen_maquinaria05">
<div id="fd_x_imagen_maquinaria05">
<span title="<?php echo $solicitud->imagen_maquinaria05->FldTitle() ? $solicitud->imagen_maquinaria05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_maquinaria05->ReadOnly || $solicitud->imagen_maquinaria05->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_maquinaria05" data-page="4" name="x_imagen_maquinaria05" id="x_imagen_maquinaria05"<?php echo $solicitud->imagen_maquinaria05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria05" id= "fn_x_imagen_maquinaria05" value="<?php echo $solicitud->imagen_maquinaria05->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria05"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria05" id= "fa_x_imagen_maquinaria05" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria05" id= "fa_x_imagen_maquinaria05" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria05" id= "fs_x_imagen_maquinaria05" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria05" id= "fx_x_imagen_maquinaria05" value="<?php echo $solicitud->imagen_maquinaria05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria05" id= "fm_x_imagen_maquinaria05" value="<?php echo $solicitud->imagen_maquinaria05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_maquinaria05->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_maquinaria06->Visible) { // imagen_maquinaria06 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_maquinaria06" class="form-group">
		<label id="elh_solicitud_imagen_maquinaria06" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_maquinaria06->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_maquinaria06->CellAttributes() ?>>
<span id="el_solicitud_imagen_maquinaria06">
<div id="fd_x_imagen_maquinaria06">
<span title="<?php echo $solicitud->imagen_maquinaria06->FldTitle() ? $solicitud->imagen_maquinaria06->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_maquinaria06->ReadOnly || $solicitud->imagen_maquinaria06->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_maquinaria06" data-page="4" name="x_imagen_maquinaria06" id="x_imagen_maquinaria06"<?php echo $solicitud->imagen_maquinaria06->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria06" id= "fn_x_imagen_maquinaria06" value="<?php echo $solicitud->imagen_maquinaria06->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria06"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria06" id= "fa_x_imagen_maquinaria06" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria06" id= "fa_x_imagen_maquinaria06" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria06" id= "fs_x_imagen_maquinaria06" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria06" id= "fx_x_imagen_maquinaria06" value="<?php echo $solicitud->imagen_maquinaria06->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria06" id= "fm_x_imagen_maquinaria06" value="<?php echo $solicitud->imagen_maquinaria06->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria06" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_maquinaria06->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_maquinaria06">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_maquinaria06"><?php echo $solicitud->imagen_maquinaria06->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_maquinaria06->CellAttributes() ?>>
<span id="el_solicitud_imagen_maquinaria06">
<div id="fd_x_imagen_maquinaria06">
<span title="<?php echo $solicitud->imagen_maquinaria06->FldTitle() ? $solicitud->imagen_maquinaria06->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_maquinaria06->ReadOnly || $solicitud->imagen_maquinaria06->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_maquinaria06" data-page="4" name="x_imagen_maquinaria06" id="x_imagen_maquinaria06"<?php echo $solicitud->imagen_maquinaria06->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria06" id= "fn_x_imagen_maquinaria06" value="<?php echo $solicitud->imagen_maquinaria06->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria06"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria06" id= "fa_x_imagen_maquinaria06" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria06" id= "fa_x_imagen_maquinaria06" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria06" id= "fs_x_imagen_maquinaria06" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria06" id= "fx_x_imagen_maquinaria06" value="<?php echo $solicitud->imagen_maquinaria06->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria06" id= "fm_x_imagen_maquinaria06" value="<?php echo $solicitud->imagen_maquinaria06->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria06" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_maquinaria06->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_maquinaria07->Visible) { // imagen_maquinaria07 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_maquinaria07" class="form-group">
		<label id="elh_solicitud_imagen_maquinaria07" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_maquinaria07->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_maquinaria07->CellAttributes() ?>>
<span id="el_solicitud_imagen_maquinaria07">
<div id="fd_x_imagen_maquinaria07">
<span title="<?php echo $solicitud->imagen_maquinaria07->FldTitle() ? $solicitud->imagen_maquinaria07->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_maquinaria07->ReadOnly || $solicitud->imagen_maquinaria07->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_maquinaria07" data-page="4" name="x_imagen_maquinaria07" id="x_imagen_maquinaria07"<?php echo $solicitud->imagen_maquinaria07->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria07" id= "fn_x_imagen_maquinaria07" value="<?php echo $solicitud->imagen_maquinaria07->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria07"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria07" id= "fa_x_imagen_maquinaria07" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria07" id= "fa_x_imagen_maquinaria07" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria07" id= "fs_x_imagen_maquinaria07" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria07" id= "fx_x_imagen_maquinaria07" value="<?php echo $solicitud->imagen_maquinaria07->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria07" id= "fm_x_imagen_maquinaria07" value="<?php echo $solicitud->imagen_maquinaria07->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria07" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_maquinaria07->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_maquinaria07">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_maquinaria07"><?php echo $solicitud->imagen_maquinaria07->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_maquinaria07->CellAttributes() ?>>
<span id="el_solicitud_imagen_maquinaria07">
<div id="fd_x_imagen_maquinaria07">
<span title="<?php echo $solicitud->imagen_maquinaria07->FldTitle() ? $solicitud->imagen_maquinaria07->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_maquinaria07->ReadOnly || $solicitud->imagen_maquinaria07->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_maquinaria07" data-page="4" name="x_imagen_maquinaria07" id="x_imagen_maquinaria07"<?php echo $solicitud->imagen_maquinaria07->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria07" id= "fn_x_imagen_maquinaria07" value="<?php echo $solicitud->imagen_maquinaria07->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria07"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria07" id= "fa_x_imagen_maquinaria07" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria07" id= "fa_x_imagen_maquinaria07" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria07" id= "fs_x_imagen_maquinaria07" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria07" id= "fx_x_imagen_maquinaria07" value="<?php echo $solicitud->imagen_maquinaria07->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria07" id= "fm_x_imagen_maquinaria07" value="<?php echo $solicitud->imagen_maquinaria07->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria07" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_maquinaria07->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $solicitud_edit->MultiPages->PageStyle("5") ?>" id="tab_solicitud5"><!-- multi-page .tab-pane -->
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_solicitudedit5" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($solicitud->tipomercaderia->Visible) { // tipomercaderia ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_tipomercaderia" class="form-group">
		<label id="elh_solicitud_tipomercaderia" for="x_tipomercaderia" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->tipomercaderia->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->tipomercaderia->CellAttributes() ?>>
<span id="el_solicitud_tipomercaderia">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipomercaderia"><?php echo (strval($solicitud->tipomercaderia->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->tipomercaderia->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->tipomercaderia->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipomercaderia[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->tipomercaderia->ReadOnly || $solicitud->tipomercaderia->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_tipomercaderia" data-page="5" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $solicitud->tipomercaderia->DisplayValueSeparatorAttribute() ?>" name="x_tipomercaderia[]" id="x_tipomercaderia[]" value="<?php echo $solicitud->tipomercaderia->CurrentValue ?>"<?php echo $solicitud->tipomercaderia->EditAttributes() ?>>
</span>
<?php echo $solicitud->tipomercaderia->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipomercaderia">
		<td class="col-sm-3"><span id="elh_solicitud_tipomercaderia"><?php echo $solicitud->tipomercaderia->FldCaption() ?></span></td>
		<td<?php echo $solicitud->tipomercaderia->CellAttributes() ?>>
<span id="el_solicitud_tipomercaderia">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipomercaderia"><?php echo (strval($solicitud->tipomercaderia->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->tipomercaderia->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->tipomercaderia->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipomercaderia[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->tipomercaderia->ReadOnly || $solicitud->tipomercaderia->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_tipomercaderia" data-page="5" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $solicitud->tipomercaderia->DisplayValueSeparatorAttribute() ?>" name="x_tipomercaderia[]" id="x_tipomercaderia[]" value="<?php echo $solicitud->tipomercaderia->CurrentValue ?>"<?php echo $solicitud->tipomercaderia->EditAttributes() ?>>
</span>
<?php echo $solicitud->tipomercaderia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_mercaderia01->Visible) { // imagen_mercaderia01 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_mercaderia01" class="form-group">
		<label id="elh_solicitud_imagen_mercaderia01" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_mercaderia01->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_mercaderia01->CellAttributes() ?>>
<span id="el_solicitud_imagen_mercaderia01">
<div id="fd_x_imagen_mercaderia01">
<span title="<?php echo $solicitud->imagen_mercaderia01->FldTitle() ? $solicitud->imagen_mercaderia01->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_mercaderia01->ReadOnly || $solicitud->imagen_mercaderia01->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_mercaderia01" data-page="5" name="x_imagen_mercaderia01" id="x_imagen_mercaderia01"<?php echo $solicitud->imagen_mercaderia01->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_mercaderia01" id= "fn_x_imagen_mercaderia01" value="<?php echo $solicitud->imagen_mercaderia01->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_mercaderia01"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_mercaderia01" id= "fa_x_imagen_mercaderia01" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_mercaderia01" id= "fa_x_imagen_mercaderia01" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_mercaderia01" id= "fs_x_imagen_mercaderia01" value="0">
<input type="hidden" name="fx_x_imagen_mercaderia01" id= "fx_x_imagen_mercaderia01" value="<?php echo $solicitud->imagen_mercaderia01->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_mercaderia01" id= "fm_x_imagen_mercaderia01" value="<?php echo $solicitud->imagen_mercaderia01->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_mercaderia01" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_mercaderia01->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_mercaderia01">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_mercaderia01"><?php echo $solicitud->imagen_mercaderia01->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_mercaderia01->CellAttributes() ?>>
<span id="el_solicitud_imagen_mercaderia01">
<div id="fd_x_imagen_mercaderia01">
<span title="<?php echo $solicitud->imagen_mercaderia01->FldTitle() ? $solicitud->imagen_mercaderia01->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_mercaderia01->ReadOnly || $solicitud->imagen_mercaderia01->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_mercaderia01" data-page="5" name="x_imagen_mercaderia01" id="x_imagen_mercaderia01"<?php echo $solicitud->imagen_mercaderia01->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_mercaderia01" id= "fn_x_imagen_mercaderia01" value="<?php echo $solicitud->imagen_mercaderia01->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_mercaderia01"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_mercaderia01" id= "fa_x_imagen_mercaderia01" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_mercaderia01" id= "fa_x_imagen_mercaderia01" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_mercaderia01" id= "fs_x_imagen_mercaderia01" value="0">
<input type="hidden" name="fx_x_imagen_mercaderia01" id= "fx_x_imagen_mercaderia01" value="<?php echo $solicitud->imagen_mercaderia01->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_mercaderia01" id= "fm_x_imagen_mercaderia01" value="<?php echo $solicitud->imagen_mercaderia01->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_mercaderia01" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_mercaderia01->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->documento_mercaderia->Visible) { // documento_mercaderia ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_documento_mercaderia" class="form-group">
		<label id="elh_solicitud_documento_mercaderia" for="x_documento_mercaderia" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->documento_mercaderia->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->documento_mercaderia->CellAttributes() ?>>
<span id="el_solicitud_documento_mercaderia">
<textarea data-table="solicitud" data-field="x_documento_mercaderia" data-page="5" name="x_documento_mercaderia" id="x_documento_mercaderia" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($solicitud->documento_mercaderia->getPlaceHolder()) ?>"<?php echo $solicitud->documento_mercaderia->EditAttributes() ?>><?php echo $solicitud->documento_mercaderia->EditValue ?></textarea>
</span>
<?php echo $solicitud->documento_mercaderia->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_documento_mercaderia">
		<td class="col-sm-3"><span id="elh_solicitud_documento_mercaderia"><?php echo $solicitud->documento_mercaderia->FldCaption() ?></span></td>
		<td<?php echo $solicitud->documento_mercaderia->CellAttributes() ?>>
<span id="el_solicitud_documento_mercaderia">
<textarea data-table="solicitud" data-field="x_documento_mercaderia" data-page="5" name="x_documento_mercaderia" id="x_documento_mercaderia" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($solicitud->documento_mercaderia->getPlaceHolder()) ?>"<?php echo $solicitud->documento_mercaderia->EditAttributes() ?>><?php echo $solicitud->documento_mercaderia->EditValue ?></textarea>
</span>
<?php echo $solicitud->documento_mercaderia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $solicitud_edit->MultiPages->PageStyle("6") ?>" id="tab_solicitud6"><!-- multi-page .tab-pane -->
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_solicitudedit6" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($solicitud->tipoespecial->Visible) { // tipoespecial ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_tipoespecial" class="form-group">
		<label id="elh_solicitud_tipoespecial" for="x_tipoespecial" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->tipoespecial->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->tipoespecial->CellAttributes() ?>>
<span id="el_solicitud_tipoespecial">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipoespecial"><?php echo (strval($solicitud->tipoespecial->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->tipoespecial->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->tipoespecial->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipoespecial[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->tipoespecial->ReadOnly || $solicitud->tipoespecial->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_tipoespecial" data-page="6" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $solicitud->tipoespecial->DisplayValueSeparatorAttribute() ?>" name="x_tipoespecial[]" id="x_tipoespecial[]" value="<?php echo $solicitud->tipoespecial->CurrentValue ?>"<?php echo $solicitud->tipoespecial->EditAttributes() ?>>
</span>
<?php echo $solicitud->tipoespecial->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipoespecial">
		<td class="col-sm-3"><span id="elh_solicitud_tipoespecial"><?php echo $solicitud->tipoespecial->FldCaption() ?></span></td>
		<td<?php echo $solicitud->tipoespecial->CellAttributes() ?>>
<span id="el_solicitud_tipoespecial">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipoespecial"><?php echo (strval($solicitud->tipoespecial->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $solicitud->tipoespecial->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($solicitud->tipoespecial->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipoespecial[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($solicitud->tipoespecial->ReadOnly || $solicitud->tipoespecial->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="solicitud" data-field="x_tipoespecial" data-page="6" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $solicitud->tipoespecial->DisplayValueSeparatorAttribute() ?>" name="x_tipoespecial[]" id="x_tipoespecial[]" value="<?php echo $solicitud->tipoespecial->CurrentValue ?>"<?php echo $solicitud->tipoespecial->EditAttributes() ?>>
</span>
<?php echo $solicitud->tipoespecial->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud->imagen_tipoespecial01->Visible) { // imagen_tipoespecial01 ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_tipoespecial01" class="form-group">
		<label id="elh_solicitud_imagen_tipoespecial01" class="<?php echo $solicitud_edit->LeftColumnClass ?>"><?php echo $solicitud->imagen_tipoespecial01->FldCaption() ?></label>
		<div class="<?php echo $solicitud_edit->RightColumnClass ?>"><div<?php echo $solicitud->imagen_tipoespecial01->CellAttributes() ?>>
<span id="el_solicitud_imagen_tipoespecial01">
<div id="fd_x_imagen_tipoespecial01">
<span title="<?php echo $solicitud->imagen_tipoespecial01->FldTitle() ? $solicitud->imagen_tipoespecial01->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_tipoespecial01->ReadOnly || $solicitud->imagen_tipoespecial01->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_tipoespecial01" data-page="6" name="x_imagen_tipoespecial01" id="x_imagen_tipoespecial01"<?php echo $solicitud->imagen_tipoespecial01->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_tipoespecial01" id= "fn_x_imagen_tipoespecial01" value="<?php echo $solicitud->imagen_tipoespecial01->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_tipoespecial01"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_tipoespecial01" id= "fa_x_imagen_tipoespecial01" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_tipoespecial01" id= "fa_x_imagen_tipoespecial01" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_tipoespecial01" id= "fs_x_imagen_tipoespecial01" value="0">
<input type="hidden" name="fx_x_imagen_tipoespecial01" id= "fx_x_imagen_tipoespecial01" value="<?php echo $solicitud->imagen_tipoespecial01->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_tipoespecial01" id= "fm_x_imagen_tipoespecial01" value="<?php echo $solicitud->imagen_tipoespecial01->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_tipoespecial01" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_tipoespecial01->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_tipoespecial01">
		<td class="col-sm-3"><span id="elh_solicitud_imagen_tipoespecial01"><?php echo $solicitud->imagen_tipoespecial01->FldCaption() ?></span></td>
		<td<?php echo $solicitud->imagen_tipoespecial01->CellAttributes() ?>>
<span id="el_solicitud_imagen_tipoespecial01">
<div id="fd_x_imagen_tipoespecial01">
<span title="<?php echo $solicitud->imagen_tipoespecial01->FldTitle() ? $solicitud->imagen_tipoespecial01->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($solicitud->imagen_tipoespecial01->ReadOnly || $solicitud->imagen_tipoespecial01->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="solicitud" data-field="x_imagen_tipoespecial01" data-page="6" name="x_imagen_tipoespecial01" id="x_imagen_tipoespecial01"<?php echo $solicitud->imagen_tipoespecial01->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_tipoespecial01" id= "fn_x_imagen_tipoespecial01" value="<?php echo $solicitud->imagen_tipoespecial01->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_tipoespecial01"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_tipoespecial01" id= "fa_x_imagen_tipoespecial01" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_tipoespecial01" id= "fa_x_imagen_tipoespecial01" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_tipoespecial01" id= "fs_x_imagen_tipoespecial01" value="0">
<input type="hidden" name="fx_x_imagen_tipoespecial01" id= "fx_x_imagen_tipoespecial01" value="<?php echo $solicitud->imagen_tipoespecial01->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_tipoespecial01" id= "fm_x_imagen_tipoespecial01" value="<?php echo $solicitud->imagen_tipoespecial01->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_tipoespecial01" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $solicitud->imagen_tipoespecial01->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($solicitud_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<input type="hidden" data-table="solicitud" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($solicitud->id->CurrentValue) ?>">
<?php
	if (in_array("avaluo", explode(",", $solicitud->getCurrentDetailTable())) && $avaluo->DetailEdit) {
?>
<?php if ($solicitud->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("avaluo", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "avaluogrid.php" ?>
<?php } ?>
<?php if (!$solicitud_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $solicitud_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $solicitud_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$solicitud_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fsolicitudedit.Init();
</script>
<?php
$solicitud_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$solicitud_edit->Page_Terminate();
?>
