<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "viewsolicitudsupervisorinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$viewsolicitudsupervisor_edit = NULL; // Initialize page object first

class cviewsolicitudsupervisor_edit extends cviewsolicitudsupervisor {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewsolicitudsupervisor';

	// Page object name
	var $PageObjName = 'viewsolicitudsupervisor_edit';

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

		// Table object (viewsolicitudsupervisor)
		if (!isset($GLOBALS["viewsolicitudsupervisor"]) || get_class($GLOBALS["viewsolicitudsupervisor"]) == "cviewsolicitudsupervisor") {
			$GLOBALS["viewsolicitudsupervisor"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["viewsolicitudsupervisor"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'viewsolicitudsupervisor', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("viewsolicitudsupervisorlist.php"));
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
		$this->id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->id->Visible = FALSE;
		$this->name->SetVisibility();
		$this->lastname->SetVisibility();
		$this->_email->SetVisibility();
		$this->address->SetVisibility();
		$this->nombre_contacto->SetVisibility();
		$this->email_contacto->SetVisibility();
		$this->phone->SetVisibility();
		$this->cell->SetVisibility();
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
		$this->imagen_vehiculo05->SetVisibility();
		$this->imagen_vehiculo06->SetVisibility();
		$this->imagen_vehiculo07->SetVisibility();
		$this->tipomaquinaria->SetVisibility();
		$this->id_ciudad_maquinaria->SetVisibility();
		$this->id_provincia_maquinaria->SetVisibility();
		$this->imagen_maquinaria05->SetVisibility();
		$this->imagen_maquinaria06->SetVisibility();
		$this->imagen_maquinaria07->SetVisibility();
		$this->tipomercaderia->SetVisibility();
		$this->documento_mercaderia->SetVisibility();
		$this->tipoespecial->SetVisibility();
		$this->is_active->SetVisibility();
		$this->documentos->SetVisibility();

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
		global $EW_EXPORT, $viewsolicitudsupervisor;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($viewsolicitudsupervisor);
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
					if ($pageName == "viewsolicitudsupervisorview.php")
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
					$this->Page_Terminate("viewsolicitudsupervisorlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "viewsolicitudsupervisorlist.php")
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
		$this->imagen_vehiculo05->Upload->Index = $objForm->Index;
		$this->imagen_vehiculo05->Upload->UploadFile();
		$this->imagen_vehiculo06->Upload->Index = $objForm->Index;
		$this->imagen_vehiculo06->Upload->UploadFile();
		$this->imagen_vehiculo07->Upload->Index = $objForm->Index;
		$this->imagen_vehiculo07->Upload->UploadFile();
		$this->imagen_maquinaria05->Upload->Index = $objForm->Index;
		$this->imagen_maquinaria05->Upload->UploadFile();
		$this->imagen_maquinaria06->Upload->Index = $objForm->Index;
		$this->imagen_maquinaria06->Upload->UploadFile();
		$this->imagen_maquinaria07->Upload->Index = $objForm->Index;
		$this->imagen_maquinaria07->Upload->UploadFile();
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
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
		if (!$this->nombre_contacto->FldIsDetailKey) {
			$this->nombre_contacto->setFormValue($objForm->GetValue("x_nombre_contacto"));
		}
		if (!$this->email_contacto->FldIsDetailKey) {
			$this->email_contacto->setFormValue($objForm->GetValue("x_email_contacto"));
		}
		if (!$this->phone->FldIsDetailKey) {
			$this->phone->setFormValue($objForm->GetValue("x_phone"));
		}
		if (!$this->cell->FldIsDetailKey) {
			$this->cell->setFormValue($objForm->GetValue("x_cell"));
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
		if (!$this->is_active->FldIsDetailKey) {
			$this->is_active->setFormValue($objForm->GetValue("x_is_active"));
		}
		if (!$this->documentos->FldIsDetailKey) {
			$this->documentos->setFormValue($objForm->GetValue("x_documentos"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->name->CurrentValue = $this->name->FormValue;
		$this->lastname->CurrentValue = $this->lastname->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->address->CurrentValue = $this->address->FormValue;
		$this->nombre_contacto->CurrentValue = $this->nombre_contacto->FormValue;
		$this->email_contacto->CurrentValue = $this->email_contacto->FormValue;
		$this->phone->CurrentValue = $this->phone->FormValue;
		$this->cell->CurrentValue = $this->cell->FormValue;
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
		$this->is_active->CurrentValue = $this->is_active->FormValue;
		$this->documentos->CurrentValue = $this->documentos->FormValue;
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
		$this->name->setDbValue($row['name']);
		$this->lastname->setDbValue($row['lastname']);
		$this->_email->setDbValue($row['email']);
		$this->address->setDbValue($row['address']);
		$this->nombre_contacto->setDbValue($row['nombre_contacto']);
		$this->email_contacto->setDbValue($row['email_contacto']);
		$this->latitud->setDbValue($row['latitud']);
		$this->longitud->setDbValue($row['longitud']);
		$this->phone->setDbValue($row['phone']);
		$this->cell->setDbValue($row['cell']);
		$this->id_sucursal->setDbValue($row['id_sucursal']);
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
		$this->is_active->setDbValue($row['is_active']);
		$this->documentos->setDbValue($row['documentos']);
		$this->created_at->setDbValue($row['created_at']);
		$this->DateModified->setDbValue($row['DateModified']);
		$this->DateDeleted->setDbValue($row['DateDeleted']);
		$this->CreatedBy->setDbValue($row['CreatedBy']);
		$this->ModifiedBy->setDbValue($row['ModifiedBy']);
		$this->DeletedBy->setDbValue($row['DeletedBy']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['name'] = NULL;
		$row['lastname'] = NULL;
		$row['email'] = NULL;
		$row['address'] = NULL;
		$row['nombre_contacto'] = NULL;
		$row['email_contacto'] = NULL;
		$row['latitud'] = NULL;
		$row['longitud'] = NULL;
		$row['phone'] = NULL;
		$row['cell'] = NULL;
		$row['id_sucursal'] = NULL;
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
		$row['is_active'] = NULL;
		$row['documentos'] = NULL;
		$row['created_at'] = NULL;
		$row['DateModified'] = NULL;
		$row['DateDeleted'] = NULL;
		$row['CreatedBy'] = NULL;
		$row['ModifiedBy'] = NULL;
		$row['DeletedBy'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->name->DbValue = $row['name'];
		$this->lastname->DbValue = $row['lastname'];
		$this->_email->DbValue = $row['email'];
		$this->address->DbValue = $row['address'];
		$this->nombre_contacto->DbValue = $row['nombre_contacto'];
		$this->email_contacto->DbValue = $row['email_contacto'];
		$this->latitud->DbValue = $row['latitud'];
		$this->longitud->DbValue = $row['longitud'];
		$this->phone->DbValue = $row['phone'];
		$this->cell->DbValue = $row['cell'];
		$this->id_sucursal->DbValue = $row['id_sucursal'];
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
		$this->is_active->DbValue = $row['is_active'];
		$this->documentos->DbValue = $row['documentos'];
		$this->created_at->DbValue = $row['created_at'];
		$this->DateModified->DbValue = $row['DateModified'];
		$this->DateDeleted->DbValue = $row['DateDeleted'];
		$this->CreatedBy->DbValue = $row['CreatedBy'];
		$this->ModifiedBy->DbValue = $row['ModifiedBy'];
		$this->DeletedBy->DbValue = $row['DeletedBy'];
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
		// name
		// lastname
		// email
		// address
		// nombre_contacto
		// email_contacto
		// latitud
		// longitud
		// phone
		// cell
		// id_sucursal
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
		// is_active
		// documentos
		// created_at
		// DateModified
		// DateDeleted
		// CreatedBy
		// ModifiedBy
		// DeletedBy

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
			$this->imagen_inmueble02->ViewValue = "viewsolicitudsupervisor_imagen_inmueble02_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble02->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble02->ViewValue = "";
		}
		$this->imagen_inmueble02->ViewCustomAttributes = "";

		// imagen_inmueble03
		if (!ew_Empty($this->imagen_inmueble03->Upload->DbValue)) {
			$this->imagen_inmueble03->ViewValue = "viewsolicitudsupervisor_imagen_inmueble03_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble03->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble03->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble03->ViewValue = "";
		}
		$this->imagen_inmueble03->ViewCustomAttributes = "";

		// imagen_inmueble04
		if (!ew_Empty($this->imagen_inmueble04->Upload->DbValue)) {
			$this->imagen_inmueble04->ViewValue = "viewsolicitudsupervisor_imagen_inmueble04_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_inmueble04->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble04->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_inmueble04->ViewValue = "";
		}
		$this->imagen_inmueble04->ViewCustomAttributes = "";

		// imagen_inmueble05
		if (!ew_Empty($this->imagen_inmueble05->Upload->DbValue)) {
			$this->imagen_inmueble05->ViewValue = "viewsolicitudsupervisor_imagen_inmueble05_bv.php?" . "id=" . $this->id->CurrentValue;
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
		$this->id_ciudad_vehiculo->ViewValue = $this->id_ciudad_vehiculo->CurrentValue;
		$this->id_ciudad_vehiculo->ViewCustomAttributes = "";

		// id_provincia_vehiculo
		$this->id_provincia_vehiculo->ViewValue = $this->id_provincia_vehiculo->CurrentValue;
		$this->id_provincia_vehiculo->ViewCustomAttributes = "";

		// imagen_vehiculo05
		if (!ew_Empty($this->imagen_vehiculo05->Upload->DbValue)) {
			$this->imagen_vehiculo05->ViewValue = "viewsolicitudsupervisor_imagen_vehiculo05_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo05->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo05->ViewValue = "";
		}
		$this->imagen_vehiculo05->ViewCustomAttributes = "";

		// imagen_vehiculo06
		if (!ew_Empty($this->imagen_vehiculo06->Upload->DbValue)) {
			$this->imagen_vehiculo06->ViewValue = "viewsolicitudsupervisor_imagen_vehiculo06_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo06->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_vehiculo06->ViewValue = "";
		}
		$this->imagen_vehiculo06->ViewCustomAttributes = "";

		// imagen_vehiculo07
		if (!ew_Empty($this->imagen_vehiculo07->Upload->DbValue)) {
			$this->imagen_vehiculo07->ViewValue = "viewsolicitudsupervisor_imagen_vehiculo07_bv.php?" . "id=" . $this->id->CurrentValue;
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

		// imagen_maquinaria05
		if (!ew_Empty($this->imagen_maquinaria05->Upload->DbValue)) {
			$this->imagen_maquinaria05->ViewValue = "viewsolicitudsupervisor_imagen_maquinaria05_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria05->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria05->ViewValue = "";
		}
		$this->imagen_maquinaria05->ViewCustomAttributes = "";

		// imagen_maquinaria06
		if (!ew_Empty($this->imagen_maquinaria06->Upload->DbValue)) {
			$this->imagen_maquinaria06->ViewValue = "viewsolicitudsupervisor_imagen_maquinaria06_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria06->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen_maquinaria06->ViewValue = "";
		}
		$this->imagen_maquinaria06->ViewCustomAttributes = "";

		// imagen_maquinaria07
		if (!ew_Empty($this->imagen_maquinaria07->Upload->DbValue)) {
			$this->imagen_maquinaria07->ViewValue = "viewsolicitudsupervisor_imagen_maquinaria07_bv.php?" . "id=" . $this->id->CurrentValue;
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

		// documento_mercaderia
		$this->documento_mercaderia->ViewValue = $this->documento_mercaderia->CurrentValue;
		$this->documento_mercaderia->ViewCustomAttributes = "";

		// tipoespecial
		if (strval($this->tipoespecial->CurrentValue) <> "") {
			$sFilterWrk = "`id_tipoinmueble`" . ew_SearchString("=", $this->tipoespecial->CurrentValue, EW_DATATYPE_NUMBER, "");
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

		// is_active
		$this->is_active->ViewValue = $this->is_active->CurrentValue;
		$this->is_active->ViewCustomAttributes = "";

		// documentos
		$this->documentos->ViewValue = $this->documentos->CurrentValue;
		$this->documentos->ViewCustomAttributes = "";

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

			// imagen_inmueble02
			$this->imagen_inmueble02->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble02->Upload->DbValue)) {
				$this->imagen_inmueble02->HrefValue = "viewsolicitudsupervisor_imagen_inmueble02_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble02->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble02->HrefValue = ew_FullUrl($this->imagen_inmueble02->HrefValue, "href");
			} else {
				$this->imagen_inmueble02->HrefValue = "";
			}
			$this->imagen_inmueble02->HrefValue2 = "viewsolicitudsupervisor_imagen_inmueble02_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble02->TooltipValue = "";

			// imagen_inmueble03
			$this->imagen_inmueble03->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble03->Upload->DbValue)) {
				$this->imagen_inmueble03->HrefValue = "viewsolicitudsupervisor_imagen_inmueble03_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble03->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble03->HrefValue = ew_FullUrl($this->imagen_inmueble03->HrefValue, "href");
			} else {
				$this->imagen_inmueble03->HrefValue = "";
			}
			$this->imagen_inmueble03->HrefValue2 = "viewsolicitudsupervisor_imagen_inmueble03_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble03->TooltipValue = "";

			// imagen_inmueble04
			$this->imagen_inmueble04->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble04->Upload->DbValue)) {
				$this->imagen_inmueble04->HrefValue = "viewsolicitudsupervisor_imagen_inmueble04_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble04->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble04->HrefValue = ew_FullUrl($this->imagen_inmueble04->HrefValue, "href");
			} else {
				$this->imagen_inmueble04->HrefValue = "";
			}
			$this->imagen_inmueble04->HrefValue2 = "viewsolicitudsupervisor_imagen_inmueble04_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_inmueble04->TooltipValue = "";

			// imagen_inmueble05
			$this->imagen_inmueble05->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble05->Upload->DbValue)) {
				$this->imagen_inmueble05->HrefValue = "viewsolicitudsupervisor_imagen_inmueble05_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble05->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble05->HrefValue = ew_FullUrl($this->imagen_inmueble05->HrefValue, "href");
			} else {
				$this->imagen_inmueble05->HrefValue = "";
			}
			$this->imagen_inmueble05->HrefValue2 = "viewsolicitudsupervisor_imagen_inmueble05_bv.php?id=" . $this->id->CurrentValue;
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

			// imagen_vehiculo05
			$this->imagen_vehiculo05->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo05->Upload->DbValue)) {
				$this->imagen_vehiculo05->HrefValue = "viewsolicitudsupervisor_imagen_vehiculo05_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo05->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo05->HrefValue = ew_FullUrl($this->imagen_vehiculo05->HrefValue, "href");
			} else {
				$this->imagen_vehiculo05->HrefValue = "";
			}
			$this->imagen_vehiculo05->HrefValue2 = "viewsolicitudsupervisor_imagen_vehiculo05_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo05->TooltipValue = "";

			// imagen_vehiculo06
			$this->imagen_vehiculo06->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo06->Upload->DbValue)) {
				$this->imagen_vehiculo06->HrefValue = "viewsolicitudsupervisor_imagen_vehiculo06_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo06->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo06->HrefValue = ew_FullUrl($this->imagen_vehiculo06->HrefValue, "href");
			} else {
				$this->imagen_vehiculo06->HrefValue = "";
			}
			$this->imagen_vehiculo06->HrefValue2 = "viewsolicitudsupervisor_imagen_vehiculo06_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_vehiculo06->TooltipValue = "";

			// imagen_vehiculo07
			$this->imagen_vehiculo07->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo07->Upload->DbValue)) {
				$this->imagen_vehiculo07->HrefValue = "viewsolicitudsupervisor_imagen_vehiculo07_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo07->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo07->HrefValue = ew_FullUrl($this->imagen_vehiculo07->HrefValue, "href");
			} else {
				$this->imagen_vehiculo07->HrefValue = "";
			}
			$this->imagen_vehiculo07->HrefValue2 = "viewsolicitudsupervisor_imagen_vehiculo07_bv.php?id=" . $this->id->CurrentValue;
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

			// imagen_maquinaria05
			$this->imagen_maquinaria05->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria05->Upload->DbValue)) {
				$this->imagen_maquinaria05->HrefValue = "viewsolicitudsupervisor_imagen_maquinaria05_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria05->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria05->HrefValue = ew_FullUrl($this->imagen_maquinaria05->HrefValue, "href");
			} else {
				$this->imagen_maquinaria05->HrefValue = "";
			}
			$this->imagen_maquinaria05->HrefValue2 = "viewsolicitudsupervisor_imagen_maquinaria05_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria05->TooltipValue = "";

			// imagen_maquinaria06
			$this->imagen_maquinaria06->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria06->Upload->DbValue)) {
				$this->imagen_maquinaria06->HrefValue = "viewsolicitudsupervisor_imagen_maquinaria06_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria06->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria06->HrefValue = ew_FullUrl($this->imagen_maquinaria06->HrefValue, "href");
			} else {
				$this->imagen_maquinaria06->HrefValue = "";
			}
			$this->imagen_maquinaria06->HrefValue2 = "viewsolicitudsupervisor_imagen_maquinaria06_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria06->TooltipValue = "";

			// imagen_maquinaria07
			$this->imagen_maquinaria07->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria07->Upload->DbValue)) {
				$this->imagen_maquinaria07->HrefValue = "viewsolicitudsupervisor_imagen_maquinaria07_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria07->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria07->HrefValue = ew_FullUrl($this->imagen_maquinaria07->HrefValue, "href");
			} else {
				$this->imagen_maquinaria07->HrefValue = "";
			}
			$this->imagen_maquinaria07->HrefValue2 = "viewsolicitudsupervisor_imagen_maquinaria07_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen_maquinaria07->TooltipValue = "";

			// tipomercaderia
			$this->tipomercaderia->LinkCustomAttributes = "";
			$this->tipomercaderia->HrefValue = "";
			$this->tipomercaderia->TooltipValue = "";

			// documento_mercaderia
			$this->documento_mercaderia->LinkCustomAttributes = "";
			$this->documento_mercaderia->HrefValue = "";
			$this->documento_mercaderia->TooltipValue = "";

			// tipoespecial
			$this->tipoespecial->LinkCustomAttributes = "";
			$this->tipoespecial->HrefValue = "";
			$this->tipoespecial->TooltipValue = "";

			// is_active
			$this->is_active->LinkCustomAttributes = "";
			$this->is_active->HrefValue = "";
			$this->is_active->TooltipValue = "";

			// documentos
			$this->documentos->LinkCustomAttributes = "";
			$this->documentos->HrefValue = "";
			$this->documentos->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

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

			// nombre_contacto
			$this->nombre_contacto->EditAttrs["class"] = "form-control";
			$this->nombre_contacto->EditCustomAttributes = "";
			$this->nombre_contacto->EditValue = ew_HtmlEncode($this->nombre_contacto->CurrentValue);
			$this->nombre_contacto->PlaceHolder = ew_RemoveHtml($this->nombre_contacto->FldTitle());

			// email_contacto
			$this->email_contacto->EditAttrs["class"] = "form-control";
			$this->email_contacto->EditCustomAttributes = "";

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

			// id_sucursal
			$this->id_sucursal->EditAttrs["class"] = "form-control";
			$this->id_sucursal->EditCustomAttributes = "";

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
				$this->imagen_inmueble02->EditValue = "viewsolicitudsupervisor_imagen_inmueble02_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_inmueble02->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble02->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_inmueble02->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_inmueble02);

			// imagen_inmueble03
			$this->imagen_inmueble03->EditAttrs["class"] = "form-control";
			$this->imagen_inmueble03->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_inmueble03->Upload->DbValue)) {
				$this->imagen_inmueble03->EditValue = "viewsolicitudsupervisor_imagen_inmueble03_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_inmueble03->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble03->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_inmueble03->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_inmueble03);

			// imagen_inmueble04
			$this->imagen_inmueble04->EditAttrs["class"] = "form-control";
			$this->imagen_inmueble04->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_inmueble04->Upload->DbValue)) {
				$this->imagen_inmueble04->EditValue = "viewsolicitudsupervisor_imagen_inmueble04_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_inmueble04->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_inmueble04->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_inmueble04->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_inmueble04);

			// imagen_inmueble05
			$this->imagen_inmueble05->EditAttrs["class"] = "form-control";
			$this->imagen_inmueble05->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_inmueble05->Upload->DbValue)) {
				$this->imagen_inmueble05->EditValue = "viewsolicitudsupervisor_imagen_inmueble05_bv.php?" . "id=" . $this->id->CurrentValue;
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
			$this->id_ciudad_vehiculo->EditValue = ew_HtmlEncode($this->id_ciudad_vehiculo->CurrentValue);
			$this->id_ciudad_vehiculo->PlaceHolder = ew_RemoveHtml($this->id_ciudad_vehiculo->FldTitle());

			// id_provincia_vehiculo
			$this->id_provincia_vehiculo->EditAttrs["class"] = "form-control";
			$this->id_provincia_vehiculo->EditCustomAttributes = "";
			$this->id_provincia_vehiculo->EditValue = ew_HtmlEncode($this->id_provincia_vehiculo->CurrentValue);
			$this->id_provincia_vehiculo->PlaceHolder = ew_RemoveHtml($this->id_provincia_vehiculo->FldTitle());

			// imagen_vehiculo05
			$this->imagen_vehiculo05->EditAttrs["class"] = "form-control";
			$this->imagen_vehiculo05->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_vehiculo05->Upload->DbValue)) {
				$this->imagen_vehiculo05->EditValue = "viewsolicitudsupervisor_imagen_vehiculo05_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo05->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_vehiculo05->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_vehiculo05);

			// imagen_vehiculo06
			$this->imagen_vehiculo06->EditAttrs["class"] = "form-control";
			$this->imagen_vehiculo06->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_vehiculo06->Upload->DbValue)) {
				$this->imagen_vehiculo06->EditValue = "viewsolicitudsupervisor_imagen_vehiculo06_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_vehiculo06->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_vehiculo06->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_vehiculo06);

			// imagen_vehiculo07
			$this->imagen_vehiculo07->EditAttrs["class"] = "form-control";
			$this->imagen_vehiculo07->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_vehiculo07->Upload->DbValue)) {
				$this->imagen_vehiculo07->EditValue = "viewsolicitudsupervisor_imagen_vehiculo07_bv.php?" . "id=" . $this->id->CurrentValue;
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

			// imagen_maquinaria05
			$this->imagen_maquinaria05->EditAttrs["class"] = "form-control";
			$this->imagen_maquinaria05->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_maquinaria05->Upload->DbValue)) {
				$this->imagen_maquinaria05->EditValue = "viewsolicitudsupervisor_imagen_maquinaria05_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria05->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria05->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_maquinaria05->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_maquinaria05);

			// imagen_maquinaria06
			$this->imagen_maquinaria06->EditAttrs["class"] = "form-control";
			$this->imagen_maquinaria06->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_maquinaria06->Upload->DbValue)) {
				$this->imagen_maquinaria06->EditValue = "viewsolicitudsupervisor_imagen_maquinaria06_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria06->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen_maquinaria06->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen_maquinaria06->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen_maquinaria06);

			// imagen_maquinaria07
			$this->imagen_maquinaria07->EditAttrs["class"] = "form-control";
			$this->imagen_maquinaria07->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen_maquinaria07->Upload->DbValue)) {
				$this->imagen_maquinaria07->EditValue = "viewsolicitudsupervisor_imagen_maquinaria07_bv.php?" . "id=" . $this->id->CurrentValue;
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
				$sFilterWrk = "`id_tipoinmueble`" . ew_SearchString("=", $this->tipoespecial->CurrentValue, EW_DATATYPE_NUMBER, "");
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
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->tipoespecial->ViewValue = $this->tipoespecial->DisplayValue($arwrk);
			} else {
				$this->tipoespecial->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->tipoespecial->EditValue = $arwrk;

			// is_active
			$this->is_active->EditAttrs["class"] = "form-control";
			$this->is_active->EditCustomAttributes = "";
			$this->is_active->EditValue = $this->is_active->CurrentValue;
			$this->is_active->ViewCustomAttributes = "";

			// documentos
			$this->documentos->EditAttrs["class"] = "form-control";
			$this->documentos->EditCustomAttributes = "";
			$this->documentos->EditValue = ew_HtmlEncode($this->documentos->CurrentValue);
			$this->documentos->PlaceHolder = ew_RemoveHtml($this->documentos->FldTitle());

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

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

			// nombre_contacto
			$this->nombre_contacto->LinkCustomAttributes = "";
			$this->nombre_contacto->HrefValue = "";

			// email_contacto
			$this->email_contacto->LinkCustomAttributes = "";
			$this->email_contacto->HrefValue = "";
			$this->email_contacto->TooltipValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";

			// cell
			$this->cell->LinkCustomAttributes = "";
			$this->cell->HrefValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";
			$this->id_sucursal->TooltipValue = "";

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
				$this->imagen_inmueble02->HrefValue = "viewsolicitudsupervisor_imagen_inmueble02_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble02->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble02->HrefValue = ew_FullUrl($this->imagen_inmueble02->HrefValue, "href");
			} else {
				$this->imagen_inmueble02->HrefValue = "";
			}
			$this->imagen_inmueble02->HrefValue2 = "viewsolicitudsupervisor_imagen_inmueble02_bv.php?id=" . $this->id->CurrentValue;

			// imagen_inmueble03
			$this->imagen_inmueble03->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble03->Upload->DbValue)) {
				$this->imagen_inmueble03->HrefValue = "viewsolicitudsupervisor_imagen_inmueble03_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble03->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble03->HrefValue = ew_FullUrl($this->imagen_inmueble03->HrefValue, "href");
			} else {
				$this->imagen_inmueble03->HrefValue = "";
			}
			$this->imagen_inmueble03->HrefValue2 = "viewsolicitudsupervisor_imagen_inmueble03_bv.php?id=" . $this->id->CurrentValue;

			// imagen_inmueble04
			$this->imagen_inmueble04->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble04->Upload->DbValue)) {
				$this->imagen_inmueble04->HrefValue = "viewsolicitudsupervisor_imagen_inmueble04_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble04->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble04->HrefValue = ew_FullUrl($this->imagen_inmueble04->HrefValue, "href");
			} else {
				$this->imagen_inmueble04->HrefValue = "";
			}
			$this->imagen_inmueble04->HrefValue2 = "viewsolicitudsupervisor_imagen_inmueble04_bv.php?id=" . $this->id->CurrentValue;

			// imagen_inmueble05
			$this->imagen_inmueble05->LinkCustomAttributes = "";
			if (!empty($this->imagen_inmueble05->Upload->DbValue)) {
				$this->imagen_inmueble05->HrefValue = "viewsolicitudsupervisor_imagen_inmueble05_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_inmueble05->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_inmueble05->HrefValue = ew_FullUrl($this->imagen_inmueble05->HrefValue, "href");
			} else {
				$this->imagen_inmueble05->HrefValue = "";
			}
			$this->imagen_inmueble05->HrefValue2 = "viewsolicitudsupervisor_imagen_inmueble05_bv.php?id=" . $this->id->CurrentValue;

			// tipovehiculo
			$this->tipovehiculo->LinkCustomAttributes = "";
			$this->tipovehiculo->HrefValue = "";

			// id_ciudad_vehiculo
			$this->id_ciudad_vehiculo->LinkCustomAttributes = "";
			$this->id_ciudad_vehiculo->HrefValue = "";

			// id_provincia_vehiculo
			$this->id_provincia_vehiculo->LinkCustomAttributes = "";
			$this->id_provincia_vehiculo->HrefValue = "";

			// imagen_vehiculo05
			$this->imagen_vehiculo05->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo05->Upload->DbValue)) {
				$this->imagen_vehiculo05->HrefValue = "viewsolicitudsupervisor_imagen_vehiculo05_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo05->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo05->HrefValue = ew_FullUrl($this->imagen_vehiculo05->HrefValue, "href");
			} else {
				$this->imagen_vehiculo05->HrefValue = "";
			}
			$this->imagen_vehiculo05->HrefValue2 = "viewsolicitudsupervisor_imagen_vehiculo05_bv.php?id=" . $this->id->CurrentValue;

			// imagen_vehiculo06
			$this->imagen_vehiculo06->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo06->Upload->DbValue)) {
				$this->imagen_vehiculo06->HrefValue = "viewsolicitudsupervisor_imagen_vehiculo06_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo06->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo06->HrefValue = ew_FullUrl($this->imagen_vehiculo06->HrefValue, "href");
			} else {
				$this->imagen_vehiculo06->HrefValue = "";
			}
			$this->imagen_vehiculo06->HrefValue2 = "viewsolicitudsupervisor_imagen_vehiculo06_bv.php?id=" . $this->id->CurrentValue;

			// imagen_vehiculo07
			$this->imagen_vehiculo07->LinkCustomAttributes = "";
			if (!empty($this->imagen_vehiculo07->Upload->DbValue)) {
				$this->imagen_vehiculo07->HrefValue = "viewsolicitudsupervisor_imagen_vehiculo07_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_vehiculo07->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_vehiculo07->HrefValue = ew_FullUrl($this->imagen_vehiculo07->HrefValue, "href");
			} else {
				$this->imagen_vehiculo07->HrefValue = "";
			}
			$this->imagen_vehiculo07->HrefValue2 = "viewsolicitudsupervisor_imagen_vehiculo07_bv.php?id=" . $this->id->CurrentValue;

			// tipomaquinaria
			$this->tipomaquinaria->LinkCustomAttributes = "";
			$this->tipomaquinaria->HrefValue = "";

			// id_ciudad_maquinaria
			$this->id_ciudad_maquinaria->LinkCustomAttributes = "";
			$this->id_ciudad_maquinaria->HrefValue = "";

			// id_provincia_maquinaria
			$this->id_provincia_maquinaria->LinkCustomAttributes = "";
			$this->id_provincia_maquinaria->HrefValue = "";

			// imagen_maquinaria05
			$this->imagen_maquinaria05->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria05->Upload->DbValue)) {
				$this->imagen_maquinaria05->HrefValue = "viewsolicitudsupervisor_imagen_maquinaria05_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria05->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria05->HrefValue = ew_FullUrl($this->imagen_maquinaria05->HrefValue, "href");
			} else {
				$this->imagen_maquinaria05->HrefValue = "";
			}
			$this->imagen_maquinaria05->HrefValue2 = "viewsolicitudsupervisor_imagen_maquinaria05_bv.php?id=" . $this->id->CurrentValue;

			// imagen_maquinaria06
			$this->imagen_maquinaria06->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria06->Upload->DbValue)) {
				$this->imagen_maquinaria06->HrefValue = "viewsolicitudsupervisor_imagen_maquinaria06_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria06->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria06->HrefValue = ew_FullUrl($this->imagen_maquinaria06->HrefValue, "href");
			} else {
				$this->imagen_maquinaria06->HrefValue = "";
			}
			$this->imagen_maquinaria06->HrefValue2 = "viewsolicitudsupervisor_imagen_maquinaria06_bv.php?id=" . $this->id->CurrentValue;

			// imagen_maquinaria07
			$this->imagen_maquinaria07->LinkCustomAttributes = "";
			if (!empty($this->imagen_maquinaria07->Upload->DbValue)) {
				$this->imagen_maquinaria07->HrefValue = "viewsolicitudsupervisor_imagen_maquinaria07_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen_maquinaria07->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen_maquinaria07->HrefValue = ew_FullUrl($this->imagen_maquinaria07->HrefValue, "href");
			} else {
				$this->imagen_maquinaria07->HrefValue = "";
			}
			$this->imagen_maquinaria07->HrefValue2 = "viewsolicitudsupervisor_imagen_maquinaria07_bv.php?id=" . $this->id->CurrentValue;

			// tipomercaderia
			$this->tipomercaderia->LinkCustomAttributes = "";
			$this->tipomercaderia->HrefValue = "";

			// documento_mercaderia
			$this->documento_mercaderia->LinkCustomAttributes = "";
			$this->documento_mercaderia->HrefValue = "";

			// tipoespecial
			$this->tipoespecial->LinkCustomAttributes = "";
			$this->tipoespecial->HrefValue = "";

			// is_active
			$this->is_active->LinkCustomAttributes = "";
			$this->is_active->HrefValue = "";
			$this->is_active->TooltipValue = "";

			// documentos
			$this->documentos->LinkCustomAttributes = "";
			$this->documentos->HrefValue = "";
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
		if (!ew_CheckEmail($this->_email->FormValue)) {
			ew_AddMessage($gsFormError, $this->_email->FldErrMsg());
		}
		if (!ew_CheckInteger($this->id_ciudad_vehiculo->FormValue)) {
			ew_AddMessage($gsFormError, $this->id_ciudad_vehiculo->FldErrMsg());
		}
		if (!ew_CheckInteger($this->id_provincia_vehiculo->FormValue)) {
			ew_AddMessage($gsFormError, $this->id_provincia_vehiculo->FldErrMsg());
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

			// Save old values
			$rsold = &$rs->fields;
			$this->LoadDbValues($rsold);
			$rsnew = array();

			// name
			$this->name->SetDbValueDef($rsnew, $this->name->CurrentValue, NULL, $this->name->ReadOnly);

			// lastname
			$this->lastname->SetDbValueDef($rsnew, $this->lastname->CurrentValue, NULL, $this->lastname->ReadOnly);

			// email
			$this->_email->SetDbValueDef($rsnew, $this->_email->CurrentValue, NULL, $this->_email->ReadOnly);

			// address
			$this->address->SetDbValueDef($rsnew, $this->address->CurrentValue, NULL, $this->address->ReadOnly);

			// nombre_contacto
			$this->nombre_contacto->SetDbValueDef($rsnew, $this->nombre_contacto->CurrentValue, NULL, $this->nombre_contacto->ReadOnly);

			// phone
			$this->phone->SetDbValueDef($rsnew, $this->phone->CurrentValue, NULL, $this->phone->ReadOnly);

			// cell
			$this->cell->SetDbValueDef($rsnew, $this->cell->CurrentValue, NULL, $this->cell->ReadOnly);

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

			// documento_mercaderia
			$this->documento_mercaderia->SetDbValueDef($rsnew, $this->documento_mercaderia->CurrentValue, NULL, $this->documento_mercaderia->ReadOnly);

			// tipoespecial
			$this->tipoespecial->SetDbValueDef($rsnew, $this->tipoespecial->CurrentValue, NULL, $this->tipoespecial->ReadOnly);

			// documentos
			$this->documentos->SetDbValueDef($rsnew, $this->documentos->CurrentValue, NULL, $this->documentos->ReadOnly);

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

		// imagen_vehiculo05
		ew_CleanUploadTempPath($this->imagen_vehiculo05, $this->imagen_vehiculo05->Upload->Index);

		// imagen_vehiculo06
		ew_CleanUploadTempPath($this->imagen_vehiculo06, $this->imagen_vehiculo06->Upload->Index);

		// imagen_vehiculo07
		ew_CleanUploadTempPath($this->imagen_vehiculo07, $this->imagen_vehiculo07->Upload->Index);

		// imagen_maquinaria05
		ew_CleanUploadTempPath($this->imagen_maquinaria05, $this->imagen_maquinaria05->Upload->Index);

		// imagen_maquinaria06
		ew_CleanUploadTempPath($this->imagen_maquinaria06, $this->imagen_maquinaria06->Upload->Index);

		// imagen_maquinaria07
		ew_CleanUploadTempPath($this->imagen_maquinaria07, $this->imagen_maquinaria07->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("viewsolicitudsupervisorlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Set up multi pages
	function SetupMultiPages() {
		$pages = new cSubPages();
		$pages->Style = "pills";
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

		//echo "Page Render";
	}

	// Page Data Rendering event
	function Page_DataRendering(&$header) {

		// Example:
		//$header = "your header";

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
if (!isset($viewsolicitudsupervisor_edit)) $viewsolicitudsupervisor_edit = new cviewsolicitudsupervisor_edit();

// Page init
$viewsolicitudsupervisor_edit->Page_Init();

// Page main
$viewsolicitudsupervisor_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewsolicitudsupervisor_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fviewsolicitudsupervisoredit = new ew_Form("fviewsolicitudsupervisoredit", "edit");

// Validate form
fviewsolicitudsupervisoredit.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewsolicitudsupervisor->name->FldCaption(), $viewsolicitudsupervisor->name->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_lastname");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewsolicitudsupervisor->lastname->FldCaption(), $viewsolicitudsupervisor->lastname->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "__email");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewsolicitudsupervisor->_email->FldCaption(), $viewsolicitudsupervisor->_email->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "__email");
			if (elm && !ew_CheckEmail(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewsolicitudsupervisor->_email->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_id_ciudad_vehiculo");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewsolicitudsupervisor->id_ciudad_vehiculo->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_id_provincia_vehiculo");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewsolicitudsupervisor->id_provincia_vehiculo->FldErrMsg()) ?>");

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
fviewsolicitudsupervisoredit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewsolicitudsupervisoredit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Multi-Page
fviewsolicitudsupervisoredit.MultiPage = new ew_MultiPage("fviewsolicitudsupervisoredit");

// Dynamic selection lists
fviewsolicitudsupervisoredit.Lists["x_tipoinmueble[]"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewsolicitudsupervisoredit.Lists["x_tipoinmueble[]"].Data = "<?php echo $viewsolicitudsupervisor_edit->tipoinmueble->LookupFilterQuery(FALSE, "edit") ?>";
fviewsolicitudsupervisoredit.Lists["x_id_ciudad_inmueble"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"departamento"};
fviewsolicitudsupervisoredit.Lists["x_id_ciudad_inmueble"].Data = "<?php echo $viewsolicitudsupervisor_edit->id_ciudad_inmueble->LookupFilterQuery(FALSE, "edit") ?>";
fviewsolicitudsupervisoredit.Lists["x_id_provincia_inmueble"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"provincia"};
fviewsolicitudsupervisoredit.Lists["x_id_provincia_inmueble"].Data = "<?php echo $viewsolicitudsupervisor_edit->id_provincia_inmueble->LookupFilterQuery(FALSE, "edit") ?>";
fviewsolicitudsupervisoredit.Lists["x_tipovehiculo[]"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewsolicitudsupervisoredit.Lists["x_tipovehiculo[]"].Data = "<?php echo $viewsolicitudsupervisor_edit->tipovehiculo->LookupFilterQuery(FALSE, "edit") ?>";
fviewsolicitudsupervisoredit.Lists["x_tipomaquinaria[]"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewsolicitudsupervisoredit.Lists["x_tipomaquinaria[]"].Data = "<?php echo $viewsolicitudsupervisor_edit->tipomaquinaria->LookupFilterQuery(FALSE, "edit") ?>";
fviewsolicitudsupervisoredit.Lists["x_id_ciudad_maquinaria"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"departamento"};
fviewsolicitudsupervisoredit.Lists["x_id_ciudad_maquinaria"].Data = "<?php echo $viewsolicitudsupervisor_edit->id_ciudad_maquinaria->LookupFilterQuery(FALSE, "edit") ?>";
fviewsolicitudsupervisoredit.Lists["x_id_provincia_maquinaria"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"provincia"};
fviewsolicitudsupervisoredit.Lists["x_id_provincia_maquinaria"].Data = "<?php echo $viewsolicitudsupervisor_edit->id_provincia_maquinaria->LookupFilterQuery(FALSE, "edit") ?>";
fviewsolicitudsupervisoredit.Lists["x_tipomercaderia[]"] = {"LinkField":"x_id_tipoinmueble","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewsolicitudsupervisoredit.Lists["x_tipomercaderia[]"].Data = "<?php echo $viewsolicitudsupervisor_edit->tipomercaderia->LookupFilterQuery(FALSE, "edit") ?>";
fviewsolicitudsupervisoredit.Lists["x_tipoespecial"] = {"LinkField":"x_id_tipoinmueble","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewsolicitudsupervisoredit.Lists["x_tipoespecial"].Data = "<?php echo $viewsolicitudsupervisor_edit->tipoespecial->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $viewsolicitudsupervisor_edit->ShowPageHeader(); ?>
<?php
$viewsolicitudsupervisor_edit->ShowMessage();
?>
<form name="fviewsolicitudsupervisoredit" id="fviewsolicitudsupervisoredit" class="<?php echo $viewsolicitudsupervisor_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewsolicitudsupervisor_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewsolicitudsupervisor_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewsolicitudsupervisor">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($viewsolicitudsupervisor_edit->IsModal) ?>">
<?php if (!$viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<div class="ewMultiPage"><!-- multi-page -->
<div class="nav-tabs-custom" id="viewsolicitudsupervisor_edit"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav<?php echo $viewsolicitudsupervisor_edit->MultiPages->NavStyle() ?>">
		<li<?php echo $viewsolicitudsupervisor_edit->MultiPages->TabStyle("1") ?>><a href="#tab_viewsolicitudsupervisor1" data-toggle="tab"><?php echo $viewsolicitudsupervisor->PageCaption(1) ?></a></li>
		<li<?php echo $viewsolicitudsupervisor_edit->MultiPages->TabStyle("2") ?>><a href="#tab_viewsolicitudsupervisor2" data-toggle="tab"><?php echo $viewsolicitudsupervisor->PageCaption(2) ?></a></li>
		<li<?php echo $viewsolicitudsupervisor_edit->MultiPages->TabStyle("3") ?>><a href="#tab_viewsolicitudsupervisor3" data-toggle="tab"><?php echo $viewsolicitudsupervisor->PageCaption(3) ?></a></li>
		<li<?php echo $viewsolicitudsupervisor_edit->MultiPages->TabStyle("4") ?>><a href="#tab_viewsolicitudsupervisor4" data-toggle="tab"><?php echo $viewsolicitudsupervisor->PageCaption(4) ?></a></li>
		<li<?php echo $viewsolicitudsupervisor_edit->MultiPages->TabStyle("5") ?>><a href="#tab_viewsolicitudsupervisor5" data-toggle="tab"><?php echo $viewsolicitudsupervisor->PageCaption(5) ?></a></li>
		<li<?php echo $viewsolicitudsupervisor_edit->MultiPages->TabStyle("6") ?>><a href="#tab_viewsolicitudsupervisor6" data-toggle="tab"><?php echo $viewsolicitudsupervisor->PageCaption(6) ?></a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane<?php echo $viewsolicitudsupervisor_edit->MultiPages->PageStyle("1") ?>" id="tab_viewsolicitudsupervisor1"><!-- multi-page .tab-pane -->
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_viewsolicitudsupervisoredit1" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($viewsolicitudsupervisor->id->Visible) { // id ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_id" class="form-group">
		<label id="elh_viewsolicitudsupervisor_id" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->id->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->id->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id">
<span<?php echo $viewsolicitudsupervisor->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewsolicitudsupervisor->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_id" data-page="1" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->id->CurrentValue) ?>">
<?php echo $viewsolicitudsupervisor->id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_id"><?php echo $viewsolicitudsupervisor->id->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->id->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id">
<span<?php echo $viewsolicitudsupervisor->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewsolicitudsupervisor->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_id" data-page="1" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->id->CurrentValue) ?>">
<?php echo $viewsolicitudsupervisor->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->name->Visible) { // name ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_name" class="form-group">
		<label id="elh_viewsolicitudsupervisor_name" for="x_name" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->name->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_name">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_name" data-page="1" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->name->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->name->EditValue ?>"<?php echo $viewsolicitudsupervisor->name->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->name->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_name">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_name"><?php echo $viewsolicitudsupervisor->name->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->name->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_name">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_name" data-page="1" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->name->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->name->EditValue ?>"<?php echo $viewsolicitudsupervisor->name->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->name->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->lastname->Visible) { // lastname ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_lastname" class="form-group">
		<label id="elh_viewsolicitudsupervisor_lastname" for="x_lastname" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->lastname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->lastname->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_lastname">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_lastname" data-page="1" name="x_lastname" id="x_lastname" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->lastname->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->lastname->EditValue ?>"<?php echo $viewsolicitudsupervisor->lastname->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->lastname->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_lastname">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_lastname"><?php echo $viewsolicitudsupervisor->lastname->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->lastname->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_lastname">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_lastname" data-page="1" name="x_lastname" id="x_lastname" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->lastname->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->lastname->EditValue ?>"<?php echo $viewsolicitudsupervisor->lastname->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->lastname->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->_email->Visible) { // email ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r__email" class="form-group">
		<label id="elh_viewsolicitudsupervisor__email" for="x__email" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->_email->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->_email->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor__email">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x__email" data-page="1" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->_email->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->_email->EditValue ?>"<?php echo $viewsolicitudsupervisor->_email->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->_email->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__email">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor__email"><?php echo $viewsolicitudsupervisor->_email->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->_email->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor__email">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x__email" data-page="1" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->_email->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->_email->EditValue ?>"<?php echo $viewsolicitudsupervisor->_email->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->_email->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->address->Visible) { // address ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_address" class="form-group">
		<label id="elh_viewsolicitudsupervisor_address" for="x_address" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->address->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->address->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_address">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_address" data-page="1" name="x_address" id="x_address" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->address->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->address->EditValue ?>"<?php echo $viewsolicitudsupervisor->address->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->address->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_address">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_address"><?php echo $viewsolicitudsupervisor->address->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->address->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_address">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_address" data-page="1" name="x_address" id="x_address" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->address->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->address->EditValue ?>"<?php echo $viewsolicitudsupervisor->address->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->address->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->nombre_contacto->Visible) { // nombre_contacto ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_nombre_contacto" class="form-group">
		<label id="elh_viewsolicitudsupervisor_nombre_contacto" for="x_nombre_contacto" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->nombre_contacto->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->nombre_contacto->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_nombre_contacto">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_nombre_contacto" data-page="1" name="x_nombre_contacto" id="x_nombre_contacto" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->nombre_contacto->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->nombre_contacto->EditValue ?>"<?php echo $viewsolicitudsupervisor->nombre_contacto->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->nombre_contacto->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_nombre_contacto">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_nombre_contacto"><?php echo $viewsolicitudsupervisor->nombre_contacto->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->nombre_contacto->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_nombre_contacto">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_nombre_contacto" data-page="1" name="x_nombre_contacto" id="x_nombre_contacto" size="30" maxlength="200" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->nombre_contacto->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->nombre_contacto->EditValue ?>"<?php echo $viewsolicitudsupervisor->nombre_contacto->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->nombre_contacto->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->phone->Visible) { // phone ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_phone" class="form-group">
		<label id="elh_viewsolicitudsupervisor_phone" for="x_phone" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->phone->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->phone->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_phone">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_phone" data-page="1" name="x_phone" id="x_phone" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->phone->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->phone->EditValue ?>"<?php echo $viewsolicitudsupervisor->phone->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->phone->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_phone">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_phone"><?php echo $viewsolicitudsupervisor->phone->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->phone->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_phone">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_phone" data-page="1" name="x_phone" id="x_phone" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->phone->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->phone->EditValue ?>"<?php echo $viewsolicitudsupervisor->phone->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->phone->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->cell->Visible) { // cell ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_cell" class="form-group">
		<label id="elh_viewsolicitudsupervisor_cell" for="x_cell" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->cell->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->cell->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_cell">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_cell" data-page="1" name="x_cell" id="x_cell" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->cell->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->cell->EditValue ?>"<?php echo $viewsolicitudsupervisor->cell->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->cell->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cell">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_cell"><?php echo $viewsolicitudsupervisor->cell->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->cell->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_cell">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_cell" data-page="1" name="x_cell" id="x_cell" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->cell->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->cell->EditValue ?>"<?php echo $viewsolicitudsupervisor->cell->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->cell->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->is_active->Visible) { // is_active ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_is_active" class="form-group">
		<label id="elh_viewsolicitudsupervisor_is_active" for="x_is_active" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->is_active->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->is_active->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_is_active">
<span<?php echo $viewsolicitudsupervisor->is_active->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewsolicitudsupervisor->is_active->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_is_active" data-page="1" name="x_is_active" id="x_is_active" value="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->is_active->CurrentValue) ?>">
<?php echo $viewsolicitudsupervisor->is_active->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_is_active">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_is_active"><?php echo $viewsolicitudsupervisor->is_active->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->is_active->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_is_active">
<span<?php echo $viewsolicitudsupervisor->is_active->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewsolicitudsupervisor->is_active->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_is_active" data-page="1" name="x_is_active" id="x_is_active" value="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->is_active->CurrentValue) ?>">
<?php echo $viewsolicitudsupervisor->is_active->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $viewsolicitudsupervisor_edit->MultiPages->PageStyle("2") ?>" id="tab_viewsolicitudsupervisor2"><!-- multi-page .tab-pane -->
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_viewsolicitudsupervisoredit2" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipoinmueble->Visible) { // tipoinmueble ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_tipoinmueble" class="form-group">
		<label id="elh_viewsolicitudsupervisor_tipoinmueble" for="x_tipoinmueble" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->tipoinmueble->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->tipoinmueble->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipoinmueble">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipoinmueble"><?php echo (strval($viewsolicitudsupervisor->tipoinmueble->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewsolicitudsupervisor->tipoinmueble->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewsolicitudsupervisor->tipoinmueble->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipoinmueble[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewsolicitudsupervisor->tipoinmueble->ReadOnly || $viewsolicitudsupervisor->tipoinmueble->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_tipoinmueble" data-page="2" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $viewsolicitudsupervisor->tipoinmueble->DisplayValueSeparatorAttribute() ?>" name="x_tipoinmueble[]" id="x_tipoinmueble[]" value="<?php echo $viewsolicitudsupervisor->tipoinmueble->CurrentValue ?>"<?php echo $viewsolicitudsupervisor->tipoinmueble->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->tipoinmueble->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipoinmueble">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_tipoinmueble"><?php echo $viewsolicitudsupervisor->tipoinmueble->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->tipoinmueble->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipoinmueble">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipoinmueble"><?php echo (strval($viewsolicitudsupervisor->tipoinmueble->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewsolicitudsupervisor->tipoinmueble->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewsolicitudsupervisor->tipoinmueble->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipoinmueble[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewsolicitudsupervisor->tipoinmueble->ReadOnly || $viewsolicitudsupervisor->tipoinmueble->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_tipoinmueble" data-page="2" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $viewsolicitudsupervisor->tipoinmueble->DisplayValueSeparatorAttribute() ?>" name="x_tipoinmueble[]" id="x_tipoinmueble[]" value="<?php echo $viewsolicitudsupervisor->tipoinmueble->CurrentValue ?>"<?php echo $viewsolicitudsupervisor->tipoinmueble->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->tipoinmueble->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->id_ciudad_inmueble->Visible) { // id_ciudad_inmueble ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_id_ciudad_inmueble" class="form-group">
		<label id="elh_viewsolicitudsupervisor_id_ciudad_inmueble" for="x_id_ciudad_inmueble" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->id_ciudad_inmueble->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->id_ciudad_inmueble->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id_ciudad_inmueble">
<select data-table="viewsolicitudsupervisor" data-field="x_id_ciudad_inmueble" data-page="2" data-value-separator="<?php echo $viewsolicitudsupervisor->id_ciudad_inmueble->DisplayValueSeparatorAttribute() ?>" id="x_id_ciudad_inmueble" name="x_id_ciudad_inmueble"<?php echo $viewsolicitudsupervisor->id_ciudad_inmueble->EditAttributes() ?>>
<?php echo $viewsolicitudsupervisor->id_ciudad_inmueble->SelectOptionListHtml("x_id_ciudad_inmueble") ?>
</select>
</span>
<?php echo $viewsolicitudsupervisor->id_ciudad_inmueble->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_ciudad_inmueble">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_id_ciudad_inmueble"><?php echo $viewsolicitudsupervisor->id_ciudad_inmueble->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->id_ciudad_inmueble->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id_ciudad_inmueble">
<select data-table="viewsolicitudsupervisor" data-field="x_id_ciudad_inmueble" data-page="2" data-value-separator="<?php echo $viewsolicitudsupervisor->id_ciudad_inmueble->DisplayValueSeparatorAttribute() ?>" id="x_id_ciudad_inmueble" name="x_id_ciudad_inmueble"<?php echo $viewsolicitudsupervisor->id_ciudad_inmueble->EditAttributes() ?>>
<?php echo $viewsolicitudsupervisor->id_ciudad_inmueble->SelectOptionListHtml("x_id_ciudad_inmueble") ?>
</select>
</span>
<?php echo $viewsolicitudsupervisor->id_ciudad_inmueble->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->id_provincia_inmueble->Visible) { // id_provincia_inmueble ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_id_provincia_inmueble" class="form-group">
		<label id="elh_viewsolicitudsupervisor_id_provincia_inmueble" for="x_id_provincia_inmueble" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->id_provincia_inmueble->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->id_provincia_inmueble->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id_provincia_inmueble">
<select data-table="viewsolicitudsupervisor" data-field="x_id_provincia_inmueble" data-page="2" data-value-separator="<?php echo $viewsolicitudsupervisor->id_provincia_inmueble->DisplayValueSeparatorAttribute() ?>" id="x_id_provincia_inmueble" name="x_id_provincia_inmueble"<?php echo $viewsolicitudsupervisor->id_provincia_inmueble->EditAttributes() ?>>
<?php echo $viewsolicitudsupervisor->id_provincia_inmueble->SelectOptionListHtml("x_id_provincia_inmueble") ?>
</select>
</span>
<?php echo $viewsolicitudsupervisor->id_provincia_inmueble->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_provincia_inmueble">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_id_provincia_inmueble"><?php echo $viewsolicitudsupervisor->id_provincia_inmueble->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->id_provincia_inmueble->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id_provincia_inmueble">
<select data-table="viewsolicitudsupervisor" data-field="x_id_provincia_inmueble" data-page="2" data-value-separator="<?php echo $viewsolicitudsupervisor->id_provincia_inmueble->DisplayValueSeparatorAttribute() ?>" id="x_id_provincia_inmueble" name="x_id_provincia_inmueble"<?php echo $viewsolicitudsupervisor->id_provincia_inmueble->EditAttributes() ?>>
<?php echo $viewsolicitudsupervisor->id_provincia_inmueble->SelectOptionListHtml("x_id_provincia_inmueble") ?>
</select>
</span>
<?php echo $viewsolicitudsupervisor->id_provincia_inmueble->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->imagen_inmueble02->Visible) { // imagen_inmueble02 ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_inmueble02" class="form-group">
		<label id="elh_viewsolicitudsupervisor_imagen_inmueble02" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->imagen_inmueble02->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->imagen_inmueble02->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_inmueble02">
<div id="fd_x_imagen_inmueble02">
<span title="<?php echo $viewsolicitudsupervisor->imagen_inmueble02->FldTitle() ? $viewsolicitudsupervisor->imagen_inmueble02->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_inmueble02->ReadOnly || $viewsolicitudsupervisor->imagen_inmueble02->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_inmueble02" data-page="2" name="x_imagen_inmueble02" id="x_imagen_inmueble02"<?php echo $viewsolicitudsupervisor->imagen_inmueble02->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble02" id= "fn_x_imagen_inmueble02" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble02->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble02"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble02" id= "fa_x_imagen_inmueble02" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble02" id= "fa_x_imagen_inmueble02" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble02" id= "fs_x_imagen_inmueble02" value="0">
<input type="hidden" name="fx_x_imagen_inmueble02" id= "fx_x_imagen_inmueble02" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble02->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble02" id= "fm_x_imagen_inmueble02" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble02->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble02" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_inmueble02->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_inmueble02">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_imagen_inmueble02"><?php echo $viewsolicitudsupervisor->imagen_inmueble02->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->imagen_inmueble02->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_inmueble02">
<div id="fd_x_imagen_inmueble02">
<span title="<?php echo $viewsolicitudsupervisor->imagen_inmueble02->FldTitle() ? $viewsolicitudsupervisor->imagen_inmueble02->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_inmueble02->ReadOnly || $viewsolicitudsupervisor->imagen_inmueble02->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_inmueble02" data-page="2" name="x_imagen_inmueble02" id="x_imagen_inmueble02"<?php echo $viewsolicitudsupervisor->imagen_inmueble02->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble02" id= "fn_x_imagen_inmueble02" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble02->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble02"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble02" id= "fa_x_imagen_inmueble02" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble02" id= "fa_x_imagen_inmueble02" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble02" id= "fs_x_imagen_inmueble02" value="0">
<input type="hidden" name="fx_x_imagen_inmueble02" id= "fx_x_imagen_inmueble02" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble02->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble02" id= "fm_x_imagen_inmueble02" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble02->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble02" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_inmueble02->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->imagen_inmueble03->Visible) { // imagen_inmueble03 ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_inmueble03" class="form-group">
		<label id="elh_viewsolicitudsupervisor_imagen_inmueble03" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->imagen_inmueble03->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->imagen_inmueble03->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_inmueble03">
<div id="fd_x_imagen_inmueble03">
<span title="<?php echo $viewsolicitudsupervisor->imagen_inmueble03->FldTitle() ? $viewsolicitudsupervisor->imagen_inmueble03->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_inmueble03->ReadOnly || $viewsolicitudsupervisor->imagen_inmueble03->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_inmueble03" data-page="2" name="x_imagen_inmueble03" id="x_imagen_inmueble03"<?php echo $viewsolicitudsupervisor->imagen_inmueble03->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble03" id= "fn_x_imagen_inmueble03" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble03->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble03"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble03" id= "fa_x_imagen_inmueble03" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble03" id= "fa_x_imagen_inmueble03" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble03" id= "fs_x_imagen_inmueble03" value="0">
<input type="hidden" name="fx_x_imagen_inmueble03" id= "fx_x_imagen_inmueble03" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble03->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble03" id= "fm_x_imagen_inmueble03" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble03->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble03" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_inmueble03->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_inmueble03">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_imagen_inmueble03"><?php echo $viewsolicitudsupervisor->imagen_inmueble03->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->imagen_inmueble03->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_inmueble03">
<div id="fd_x_imagen_inmueble03">
<span title="<?php echo $viewsolicitudsupervisor->imagen_inmueble03->FldTitle() ? $viewsolicitudsupervisor->imagen_inmueble03->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_inmueble03->ReadOnly || $viewsolicitudsupervisor->imagen_inmueble03->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_inmueble03" data-page="2" name="x_imagen_inmueble03" id="x_imagen_inmueble03"<?php echo $viewsolicitudsupervisor->imagen_inmueble03->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble03" id= "fn_x_imagen_inmueble03" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble03->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble03"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble03" id= "fa_x_imagen_inmueble03" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble03" id= "fa_x_imagen_inmueble03" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble03" id= "fs_x_imagen_inmueble03" value="0">
<input type="hidden" name="fx_x_imagen_inmueble03" id= "fx_x_imagen_inmueble03" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble03->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble03" id= "fm_x_imagen_inmueble03" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble03->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble03" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_inmueble03->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->imagen_inmueble04->Visible) { // imagen_inmueble04 ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_inmueble04" class="form-group">
		<label id="elh_viewsolicitudsupervisor_imagen_inmueble04" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->imagen_inmueble04->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->imagen_inmueble04->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_inmueble04">
<div id="fd_x_imagen_inmueble04">
<span title="<?php echo $viewsolicitudsupervisor->imagen_inmueble04->FldTitle() ? $viewsolicitudsupervisor->imagen_inmueble04->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_inmueble04->ReadOnly || $viewsolicitudsupervisor->imagen_inmueble04->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_inmueble04" data-page="2" name="x_imagen_inmueble04" id="x_imagen_inmueble04"<?php echo $viewsolicitudsupervisor->imagen_inmueble04->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble04" id= "fn_x_imagen_inmueble04" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble04->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble04"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble04" id= "fa_x_imagen_inmueble04" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble04" id= "fa_x_imagen_inmueble04" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble04" id= "fs_x_imagen_inmueble04" value="0">
<input type="hidden" name="fx_x_imagen_inmueble04" id= "fx_x_imagen_inmueble04" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble04->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble04" id= "fm_x_imagen_inmueble04" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble04->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble04" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_inmueble04->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_inmueble04">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_imagen_inmueble04"><?php echo $viewsolicitudsupervisor->imagen_inmueble04->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->imagen_inmueble04->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_inmueble04">
<div id="fd_x_imagen_inmueble04">
<span title="<?php echo $viewsolicitudsupervisor->imagen_inmueble04->FldTitle() ? $viewsolicitudsupervisor->imagen_inmueble04->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_inmueble04->ReadOnly || $viewsolicitudsupervisor->imagen_inmueble04->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_inmueble04" data-page="2" name="x_imagen_inmueble04" id="x_imagen_inmueble04"<?php echo $viewsolicitudsupervisor->imagen_inmueble04->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble04" id= "fn_x_imagen_inmueble04" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble04->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble04"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble04" id= "fa_x_imagen_inmueble04" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble04" id= "fa_x_imagen_inmueble04" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble04" id= "fs_x_imagen_inmueble04" value="0">
<input type="hidden" name="fx_x_imagen_inmueble04" id= "fx_x_imagen_inmueble04" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble04->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble04" id= "fm_x_imagen_inmueble04" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble04->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble04" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_inmueble04->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->imagen_inmueble05->Visible) { // imagen_inmueble05 ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_inmueble05" class="form-group">
		<label id="elh_viewsolicitudsupervisor_imagen_inmueble05" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->imagen_inmueble05->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->imagen_inmueble05->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_inmueble05">
<div id="fd_x_imagen_inmueble05">
<span title="<?php echo $viewsolicitudsupervisor->imagen_inmueble05->FldTitle() ? $viewsolicitudsupervisor->imagen_inmueble05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_inmueble05->ReadOnly || $viewsolicitudsupervisor->imagen_inmueble05->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_inmueble05" data-page="2" name="x_imagen_inmueble05" id="x_imagen_inmueble05"<?php echo $viewsolicitudsupervisor->imagen_inmueble05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble05" id= "fn_x_imagen_inmueble05" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble05->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble05"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble05" id= "fa_x_imagen_inmueble05" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble05" id= "fa_x_imagen_inmueble05" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble05" id= "fs_x_imagen_inmueble05" value="0">
<input type="hidden" name="fx_x_imagen_inmueble05" id= "fx_x_imagen_inmueble05" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble05" id= "fm_x_imagen_inmueble05" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_inmueble05->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_inmueble05">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_imagen_inmueble05"><?php echo $viewsolicitudsupervisor->imagen_inmueble05->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->imagen_inmueble05->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_inmueble05">
<div id="fd_x_imagen_inmueble05">
<span title="<?php echo $viewsolicitudsupervisor->imagen_inmueble05->FldTitle() ? $viewsolicitudsupervisor->imagen_inmueble05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_inmueble05->ReadOnly || $viewsolicitudsupervisor->imagen_inmueble05->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_inmueble05" data-page="2" name="x_imagen_inmueble05" id="x_imagen_inmueble05"<?php echo $viewsolicitudsupervisor->imagen_inmueble05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_inmueble05" id= "fn_x_imagen_inmueble05" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble05->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_inmueble05"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_inmueble05" id= "fa_x_imagen_inmueble05" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_inmueble05" id= "fa_x_imagen_inmueble05" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_inmueble05" id= "fs_x_imagen_inmueble05" value="0">
<input type="hidden" name="fx_x_imagen_inmueble05" id= "fx_x_imagen_inmueble05" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_inmueble05" id= "fm_x_imagen_inmueble05" value="<?php echo $viewsolicitudsupervisor->imagen_inmueble05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_inmueble05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_inmueble05->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $viewsolicitudsupervisor_edit->MultiPages->PageStyle("3") ?>" id="tab_viewsolicitudsupervisor3"><!-- multi-page .tab-pane -->
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_viewsolicitudsupervisoredit3" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipovehiculo->Visible) { // tipovehiculo ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_tipovehiculo" class="form-group">
		<label id="elh_viewsolicitudsupervisor_tipovehiculo" for="x_tipovehiculo" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->tipovehiculo->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->tipovehiculo->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipovehiculo">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipovehiculo"><?php echo (strval($viewsolicitudsupervisor->tipovehiculo->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewsolicitudsupervisor->tipovehiculo->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewsolicitudsupervisor->tipovehiculo->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipovehiculo[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewsolicitudsupervisor->tipovehiculo->ReadOnly || $viewsolicitudsupervisor->tipovehiculo->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_tipovehiculo" data-page="3" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $viewsolicitudsupervisor->tipovehiculo->DisplayValueSeparatorAttribute() ?>" name="x_tipovehiculo[]" id="x_tipovehiculo[]" value="<?php echo $viewsolicitudsupervisor->tipovehiculo->CurrentValue ?>"<?php echo $viewsolicitudsupervisor->tipovehiculo->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->tipovehiculo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipovehiculo">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_tipovehiculo"><?php echo $viewsolicitudsupervisor->tipovehiculo->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->tipovehiculo->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipovehiculo">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipovehiculo"><?php echo (strval($viewsolicitudsupervisor->tipovehiculo->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewsolicitudsupervisor->tipovehiculo->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewsolicitudsupervisor->tipovehiculo->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipovehiculo[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewsolicitudsupervisor->tipovehiculo->ReadOnly || $viewsolicitudsupervisor->tipovehiculo->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_tipovehiculo" data-page="3" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $viewsolicitudsupervisor->tipovehiculo->DisplayValueSeparatorAttribute() ?>" name="x_tipovehiculo[]" id="x_tipovehiculo[]" value="<?php echo $viewsolicitudsupervisor->tipovehiculo->CurrentValue ?>"<?php echo $viewsolicitudsupervisor->tipovehiculo->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->tipovehiculo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->id_ciudad_vehiculo->Visible) { // id_ciudad_vehiculo ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_id_ciudad_vehiculo" class="form-group">
		<label id="elh_viewsolicitudsupervisor_id_ciudad_vehiculo" for="x_id_ciudad_vehiculo" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->id_ciudad_vehiculo->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->id_ciudad_vehiculo->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id_ciudad_vehiculo">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_id_ciudad_vehiculo" data-page="3" name="x_id_ciudad_vehiculo" id="x_id_ciudad_vehiculo" size="30" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->id_ciudad_vehiculo->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->id_ciudad_vehiculo->EditValue ?>"<?php echo $viewsolicitudsupervisor->id_ciudad_vehiculo->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->id_ciudad_vehiculo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_ciudad_vehiculo">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_id_ciudad_vehiculo"><?php echo $viewsolicitudsupervisor->id_ciudad_vehiculo->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->id_ciudad_vehiculo->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id_ciudad_vehiculo">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_id_ciudad_vehiculo" data-page="3" name="x_id_ciudad_vehiculo" id="x_id_ciudad_vehiculo" size="30" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->id_ciudad_vehiculo->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->id_ciudad_vehiculo->EditValue ?>"<?php echo $viewsolicitudsupervisor->id_ciudad_vehiculo->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->id_ciudad_vehiculo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->id_provincia_vehiculo->Visible) { // id_provincia_vehiculo ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_id_provincia_vehiculo" class="form-group">
		<label id="elh_viewsolicitudsupervisor_id_provincia_vehiculo" for="x_id_provincia_vehiculo" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->id_provincia_vehiculo->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->id_provincia_vehiculo->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id_provincia_vehiculo">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_id_provincia_vehiculo" data-page="3" name="x_id_provincia_vehiculo" id="x_id_provincia_vehiculo" size="30" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->id_provincia_vehiculo->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->id_provincia_vehiculo->EditValue ?>"<?php echo $viewsolicitudsupervisor->id_provincia_vehiculo->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->id_provincia_vehiculo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_provincia_vehiculo">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_id_provincia_vehiculo"><?php echo $viewsolicitudsupervisor->id_provincia_vehiculo->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->id_provincia_vehiculo->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id_provincia_vehiculo">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_id_provincia_vehiculo" data-page="3" name="x_id_provincia_vehiculo" id="x_id_provincia_vehiculo" size="30" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->id_provincia_vehiculo->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->id_provincia_vehiculo->EditValue ?>"<?php echo $viewsolicitudsupervisor->id_provincia_vehiculo->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->id_provincia_vehiculo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->imagen_vehiculo05->Visible) { // imagen_vehiculo05 ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_vehiculo05" class="form-group">
		<label id="elh_viewsolicitudsupervisor_imagen_vehiculo05" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->imagen_vehiculo05->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_vehiculo05">
<div id="fd_x_imagen_vehiculo05">
<span title="<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->FldTitle() ? $viewsolicitudsupervisor->imagen_vehiculo05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_vehiculo05->ReadOnly || $viewsolicitudsupervisor->imagen_vehiculo05->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_vehiculo05" data-page="3" name="x_imagen_vehiculo05" id="x_imagen_vehiculo05"<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo05" id= "fn_x_imagen_vehiculo05" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo05"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo05" id= "fa_x_imagen_vehiculo05" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo05" id= "fa_x_imagen_vehiculo05" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo05" id= "fs_x_imagen_vehiculo05" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo05" id= "fx_x_imagen_vehiculo05" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo05" id= "fm_x_imagen_vehiculo05" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_vehiculo05">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_imagen_vehiculo05"><?php echo $viewsolicitudsupervisor->imagen_vehiculo05->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_vehiculo05">
<div id="fd_x_imagen_vehiculo05">
<span title="<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->FldTitle() ? $viewsolicitudsupervisor->imagen_vehiculo05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_vehiculo05->ReadOnly || $viewsolicitudsupervisor->imagen_vehiculo05->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_vehiculo05" data-page="3" name="x_imagen_vehiculo05" id="x_imagen_vehiculo05"<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo05" id= "fn_x_imagen_vehiculo05" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo05"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo05" id= "fa_x_imagen_vehiculo05" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo05" id= "fa_x_imagen_vehiculo05" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo05" id= "fs_x_imagen_vehiculo05" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo05" id= "fx_x_imagen_vehiculo05" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo05" id= "fm_x_imagen_vehiculo05" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_vehiculo05->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->imagen_vehiculo06->Visible) { // imagen_vehiculo06 ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_vehiculo06" class="form-group">
		<label id="elh_viewsolicitudsupervisor_imagen_vehiculo06" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->imagen_vehiculo06->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_vehiculo06">
<div id="fd_x_imagen_vehiculo06">
<span title="<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->FldTitle() ? $viewsolicitudsupervisor->imagen_vehiculo06->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_vehiculo06->ReadOnly || $viewsolicitudsupervisor->imagen_vehiculo06->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_vehiculo06" data-page="3" name="x_imagen_vehiculo06" id="x_imagen_vehiculo06"<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo06" id= "fn_x_imagen_vehiculo06" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo06"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo06" id= "fa_x_imagen_vehiculo06" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo06" id= "fa_x_imagen_vehiculo06" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo06" id= "fs_x_imagen_vehiculo06" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo06" id= "fx_x_imagen_vehiculo06" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo06" id= "fm_x_imagen_vehiculo06" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo06" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_vehiculo06">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_imagen_vehiculo06"><?php echo $viewsolicitudsupervisor->imagen_vehiculo06->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_vehiculo06">
<div id="fd_x_imagen_vehiculo06">
<span title="<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->FldTitle() ? $viewsolicitudsupervisor->imagen_vehiculo06->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_vehiculo06->ReadOnly || $viewsolicitudsupervisor->imagen_vehiculo06->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_vehiculo06" data-page="3" name="x_imagen_vehiculo06" id="x_imagen_vehiculo06"<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo06" id= "fn_x_imagen_vehiculo06" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo06"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo06" id= "fa_x_imagen_vehiculo06" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo06" id= "fa_x_imagen_vehiculo06" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo06" id= "fs_x_imagen_vehiculo06" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo06" id= "fx_x_imagen_vehiculo06" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo06" id= "fm_x_imagen_vehiculo06" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo06" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_vehiculo06->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->imagen_vehiculo07->Visible) { // imagen_vehiculo07 ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_vehiculo07" class="form-group">
		<label id="elh_viewsolicitudsupervisor_imagen_vehiculo07" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->imagen_vehiculo07->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_vehiculo07">
<div id="fd_x_imagen_vehiculo07">
<span title="<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->FldTitle() ? $viewsolicitudsupervisor->imagen_vehiculo07->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_vehiculo07->ReadOnly || $viewsolicitudsupervisor->imagen_vehiculo07->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_vehiculo07" data-page="3" name="x_imagen_vehiculo07" id="x_imagen_vehiculo07"<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo07" id= "fn_x_imagen_vehiculo07" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo07"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo07" id= "fa_x_imagen_vehiculo07" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo07" id= "fa_x_imagen_vehiculo07" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo07" id= "fs_x_imagen_vehiculo07" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo07" id= "fx_x_imagen_vehiculo07" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo07" id= "fm_x_imagen_vehiculo07" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo07" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_vehiculo07">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_imagen_vehiculo07"><?php echo $viewsolicitudsupervisor->imagen_vehiculo07->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_vehiculo07">
<div id="fd_x_imagen_vehiculo07">
<span title="<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->FldTitle() ? $viewsolicitudsupervisor->imagen_vehiculo07->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_vehiculo07->ReadOnly || $viewsolicitudsupervisor->imagen_vehiculo07->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_vehiculo07" data-page="3" name="x_imagen_vehiculo07" id="x_imagen_vehiculo07"<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_vehiculo07" id= "fn_x_imagen_vehiculo07" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_vehiculo07"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_vehiculo07" id= "fa_x_imagen_vehiculo07" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_vehiculo07" id= "fa_x_imagen_vehiculo07" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_vehiculo07" id= "fs_x_imagen_vehiculo07" value="0">
<input type="hidden" name="fx_x_imagen_vehiculo07" id= "fx_x_imagen_vehiculo07" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_vehiculo07" id= "fm_x_imagen_vehiculo07" value="<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_vehiculo07" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_vehiculo07->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $viewsolicitudsupervisor_edit->MultiPages->PageStyle("4") ?>" id="tab_viewsolicitudsupervisor4"><!-- multi-page .tab-pane -->
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_viewsolicitudsupervisoredit4" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipomaquinaria->Visible) { // tipomaquinaria ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_tipomaquinaria" class="form-group">
		<label id="elh_viewsolicitudsupervisor_tipomaquinaria" for="x_tipomaquinaria" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->tipomaquinaria->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->tipomaquinaria->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipomaquinaria">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipomaquinaria"><?php echo (strval($viewsolicitudsupervisor->tipomaquinaria->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewsolicitudsupervisor->tipomaquinaria->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewsolicitudsupervisor->tipomaquinaria->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipomaquinaria[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewsolicitudsupervisor->tipomaquinaria->ReadOnly || $viewsolicitudsupervisor->tipomaquinaria->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_tipomaquinaria" data-page="4" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $viewsolicitudsupervisor->tipomaquinaria->DisplayValueSeparatorAttribute() ?>" name="x_tipomaquinaria[]" id="x_tipomaquinaria[]" value="<?php echo $viewsolicitudsupervisor->tipomaquinaria->CurrentValue ?>"<?php echo $viewsolicitudsupervisor->tipomaquinaria->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->tipomaquinaria->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipomaquinaria">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_tipomaquinaria"><?php echo $viewsolicitudsupervisor->tipomaquinaria->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->tipomaquinaria->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipomaquinaria">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipomaquinaria"><?php echo (strval($viewsolicitudsupervisor->tipomaquinaria->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewsolicitudsupervisor->tipomaquinaria->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewsolicitudsupervisor->tipomaquinaria->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipomaquinaria[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewsolicitudsupervisor->tipomaquinaria->ReadOnly || $viewsolicitudsupervisor->tipomaquinaria->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_tipomaquinaria" data-page="4" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $viewsolicitudsupervisor->tipomaquinaria->DisplayValueSeparatorAttribute() ?>" name="x_tipomaquinaria[]" id="x_tipomaquinaria[]" value="<?php echo $viewsolicitudsupervisor->tipomaquinaria->CurrentValue ?>"<?php echo $viewsolicitudsupervisor->tipomaquinaria->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->tipomaquinaria->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->id_ciudad_maquinaria->Visible) { // id_ciudad_maquinaria ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_id_ciudad_maquinaria" class="form-group">
		<label id="elh_viewsolicitudsupervisor_id_ciudad_maquinaria" for="x_id_ciudad_maquinaria" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->id_ciudad_maquinaria->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->id_ciudad_maquinaria->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id_ciudad_maquinaria">
<select data-table="viewsolicitudsupervisor" data-field="x_id_ciudad_maquinaria" data-page="4" data-value-separator="<?php echo $viewsolicitudsupervisor->id_ciudad_maquinaria->DisplayValueSeparatorAttribute() ?>" id="x_id_ciudad_maquinaria" name="x_id_ciudad_maquinaria"<?php echo $viewsolicitudsupervisor->id_ciudad_maquinaria->EditAttributes() ?>>
<?php echo $viewsolicitudsupervisor->id_ciudad_maquinaria->SelectOptionListHtml("x_id_ciudad_maquinaria") ?>
</select>
</span>
<?php echo $viewsolicitudsupervisor->id_ciudad_maquinaria->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_ciudad_maquinaria">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_id_ciudad_maquinaria"><?php echo $viewsolicitudsupervisor->id_ciudad_maquinaria->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->id_ciudad_maquinaria->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id_ciudad_maquinaria">
<select data-table="viewsolicitudsupervisor" data-field="x_id_ciudad_maquinaria" data-page="4" data-value-separator="<?php echo $viewsolicitudsupervisor->id_ciudad_maquinaria->DisplayValueSeparatorAttribute() ?>" id="x_id_ciudad_maquinaria" name="x_id_ciudad_maquinaria"<?php echo $viewsolicitudsupervisor->id_ciudad_maquinaria->EditAttributes() ?>>
<?php echo $viewsolicitudsupervisor->id_ciudad_maquinaria->SelectOptionListHtml("x_id_ciudad_maquinaria") ?>
</select>
</span>
<?php echo $viewsolicitudsupervisor->id_ciudad_maquinaria->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->id_provincia_maquinaria->Visible) { // id_provincia_maquinaria ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_id_provincia_maquinaria" class="form-group">
		<label id="elh_viewsolicitudsupervisor_id_provincia_maquinaria" for="x_id_provincia_maquinaria" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->id_provincia_maquinaria->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->id_provincia_maquinaria->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id_provincia_maquinaria">
<select data-table="viewsolicitudsupervisor" data-field="x_id_provincia_maquinaria" data-page="4" data-value-separator="<?php echo $viewsolicitudsupervisor->id_provincia_maquinaria->DisplayValueSeparatorAttribute() ?>" id="x_id_provincia_maquinaria" name="x_id_provincia_maquinaria"<?php echo $viewsolicitudsupervisor->id_provincia_maquinaria->EditAttributes() ?>>
<?php echo $viewsolicitudsupervisor->id_provincia_maquinaria->SelectOptionListHtml("x_id_provincia_maquinaria") ?>
</select>
</span>
<?php echo $viewsolicitudsupervisor->id_provincia_maquinaria->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_provincia_maquinaria">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_id_provincia_maquinaria"><?php echo $viewsolicitudsupervisor->id_provincia_maquinaria->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->id_provincia_maquinaria->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id_provincia_maquinaria">
<select data-table="viewsolicitudsupervisor" data-field="x_id_provincia_maquinaria" data-page="4" data-value-separator="<?php echo $viewsolicitudsupervisor->id_provincia_maquinaria->DisplayValueSeparatorAttribute() ?>" id="x_id_provincia_maquinaria" name="x_id_provincia_maquinaria"<?php echo $viewsolicitudsupervisor->id_provincia_maquinaria->EditAttributes() ?>>
<?php echo $viewsolicitudsupervisor->id_provincia_maquinaria->SelectOptionListHtml("x_id_provincia_maquinaria") ?>
</select>
</span>
<?php echo $viewsolicitudsupervisor->id_provincia_maquinaria->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->imagen_maquinaria05->Visible) { // imagen_maquinaria05 ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_maquinaria05" class="form-group">
		<label id="elh_viewsolicitudsupervisor_imagen_maquinaria05" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->imagen_maquinaria05->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_maquinaria05">
<div id="fd_x_imagen_maquinaria05">
<span title="<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->FldTitle() ? $viewsolicitudsupervisor->imagen_maquinaria05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_maquinaria05->ReadOnly || $viewsolicitudsupervisor->imagen_maquinaria05->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_maquinaria05" data-page="4" name="x_imagen_maquinaria05" id="x_imagen_maquinaria05"<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria05" id= "fn_x_imagen_maquinaria05" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria05"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria05" id= "fa_x_imagen_maquinaria05" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria05" id= "fa_x_imagen_maquinaria05" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria05" id= "fs_x_imagen_maquinaria05" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria05" id= "fx_x_imagen_maquinaria05" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria05" id= "fm_x_imagen_maquinaria05" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_maquinaria05">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_imagen_maquinaria05"><?php echo $viewsolicitudsupervisor->imagen_maquinaria05->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_maquinaria05">
<div id="fd_x_imagen_maquinaria05">
<span title="<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->FldTitle() ? $viewsolicitudsupervisor->imagen_maquinaria05->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_maquinaria05->ReadOnly || $viewsolicitudsupervisor->imagen_maquinaria05->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_maquinaria05" data-page="4" name="x_imagen_maquinaria05" id="x_imagen_maquinaria05"<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria05" id= "fn_x_imagen_maquinaria05" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria05"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria05" id= "fa_x_imagen_maquinaria05" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria05" id= "fa_x_imagen_maquinaria05" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria05" id= "fs_x_imagen_maquinaria05" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria05" id= "fx_x_imagen_maquinaria05" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria05" id= "fm_x_imagen_maquinaria05" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria05" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_maquinaria05->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->imagen_maquinaria06->Visible) { // imagen_maquinaria06 ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_maquinaria06" class="form-group">
		<label id="elh_viewsolicitudsupervisor_imagen_maquinaria06" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->imagen_maquinaria06->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_maquinaria06">
<div id="fd_x_imagen_maquinaria06">
<span title="<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->FldTitle() ? $viewsolicitudsupervisor->imagen_maquinaria06->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_maquinaria06->ReadOnly || $viewsolicitudsupervisor->imagen_maquinaria06->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_maquinaria06" data-page="4" name="x_imagen_maquinaria06" id="x_imagen_maquinaria06"<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria06" id= "fn_x_imagen_maquinaria06" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria06"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria06" id= "fa_x_imagen_maquinaria06" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria06" id= "fa_x_imagen_maquinaria06" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria06" id= "fs_x_imagen_maquinaria06" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria06" id= "fx_x_imagen_maquinaria06" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria06" id= "fm_x_imagen_maquinaria06" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria06" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_maquinaria06">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_imagen_maquinaria06"><?php echo $viewsolicitudsupervisor->imagen_maquinaria06->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_maquinaria06">
<div id="fd_x_imagen_maquinaria06">
<span title="<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->FldTitle() ? $viewsolicitudsupervisor->imagen_maquinaria06->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_maquinaria06->ReadOnly || $viewsolicitudsupervisor->imagen_maquinaria06->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_maquinaria06" data-page="4" name="x_imagen_maquinaria06" id="x_imagen_maquinaria06"<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria06" id= "fn_x_imagen_maquinaria06" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria06"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria06" id= "fa_x_imagen_maquinaria06" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria06" id= "fa_x_imagen_maquinaria06" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria06" id= "fs_x_imagen_maquinaria06" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria06" id= "fx_x_imagen_maquinaria06" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria06" id= "fm_x_imagen_maquinaria06" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria06" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_maquinaria06->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->imagen_maquinaria07->Visible) { // imagen_maquinaria07 ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_imagen_maquinaria07" class="form-group">
		<label id="elh_viewsolicitudsupervisor_imagen_maquinaria07" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->imagen_maquinaria07->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_maquinaria07">
<div id="fd_x_imagen_maquinaria07">
<span title="<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->FldTitle() ? $viewsolicitudsupervisor->imagen_maquinaria07->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_maquinaria07->ReadOnly || $viewsolicitudsupervisor->imagen_maquinaria07->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_maquinaria07" data-page="4" name="x_imagen_maquinaria07" id="x_imagen_maquinaria07"<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria07" id= "fn_x_imagen_maquinaria07" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria07"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria07" id= "fa_x_imagen_maquinaria07" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria07" id= "fa_x_imagen_maquinaria07" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria07" id= "fs_x_imagen_maquinaria07" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria07" id= "fx_x_imagen_maquinaria07" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria07" id= "fm_x_imagen_maquinaria07" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria07" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen_maquinaria07">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_imagen_maquinaria07"><?php echo $viewsolicitudsupervisor->imagen_maquinaria07->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_imagen_maquinaria07">
<div id="fd_x_imagen_maquinaria07">
<span title="<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->FldTitle() ? $viewsolicitudsupervisor->imagen_maquinaria07->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewsolicitudsupervisor->imagen_maquinaria07->ReadOnly || $viewsolicitudsupervisor->imagen_maquinaria07->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewsolicitudsupervisor" data-field="x_imagen_maquinaria07" data-page="4" name="x_imagen_maquinaria07" id="x_imagen_maquinaria07"<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen_maquinaria07" id= "fn_x_imagen_maquinaria07" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen_maquinaria07"] == "0") { ?>
<input type="hidden" name="fa_x_imagen_maquinaria07" id= "fa_x_imagen_maquinaria07" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen_maquinaria07" id= "fa_x_imagen_maquinaria07" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen_maquinaria07" id= "fs_x_imagen_maquinaria07" value="0">
<input type="hidden" name="fx_x_imagen_maquinaria07" id= "fx_x_imagen_maquinaria07" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen_maquinaria07" id= "fm_x_imagen_maquinaria07" value="<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen_maquinaria07" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewsolicitudsupervisor->imagen_maquinaria07->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $viewsolicitudsupervisor_edit->MultiPages->PageStyle("5") ?>" id="tab_viewsolicitudsupervisor5"><!-- multi-page .tab-pane -->
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_viewsolicitudsupervisoredit5" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipomercaderia->Visible) { // tipomercaderia ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_tipomercaderia" class="form-group">
		<label id="elh_viewsolicitudsupervisor_tipomercaderia" for="x_tipomercaderia" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->tipomercaderia->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->tipomercaderia->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipomercaderia">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipomercaderia"><?php echo (strval($viewsolicitudsupervisor->tipomercaderia->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewsolicitudsupervisor->tipomercaderia->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewsolicitudsupervisor->tipomercaderia->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipomercaderia[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewsolicitudsupervisor->tipomercaderia->ReadOnly || $viewsolicitudsupervisor->tipomercaderia->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_tipomercaderia" data-page="5" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $viewsolicitudsupervisor->tipomercaderia->DisplayValueSeparatorAttribute() ?>" name="x_tipomercaderia[]" id="x_tipomercaderia[]" value="<?php echo $viewsolicitudsupervisor->tipomercaderia->CurrentValue ?>"<?php echo $viewsolicitudsupervisor->tipomercaderia->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->tipomercaderia->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipomercaderia">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_tipomercaderia"><?php echo $viewsolicitudsupervisor->tipomercaderia->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->tipomercaderia->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipomercaderia">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipomercaderia"><?php echo (strval($viewsolicitudsupervisor->tipomercaderia->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewsolicitudsupervisor->tipomercaderia->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewsolicitudsupervisor->tipomercaderia->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipomercaderia[]',m:1,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewsolicitudsupervisor->tipomercaderia->ReadOnly || $viewsolicitudsupervisor->tipomercaderia->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_tipomercaderia" data-page="5" data-multiple="1" data-lookup="1" data-value-separator="<?php echo $viewsolicitudsupervisor->tipomercaderia->DisplayValueSeparatorAttribute() ?>" name="x_tipomercaderia[]" id="x_tipomercaderia[]" value="<?php echo $viewsolicitudsupervisor->tipomercaderia->CurrentValue ?>"<?php echo $viewsolicitudsupervisor->tipomercaderia->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->tipomercaderia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->documento_mercaderia->Visible) { // documento_mercaderia ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_documento_mercaderia" class="form-group">
		<label id="elh_viewsolicitudsupervisor_documento_mercaderia" for="x_documento_mercaderia" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->documento_mercaderia->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->documento_mercaderia->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_documento_mercaderia">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_documento_mercaderia" data-page="5" name="x_documento_mercaderia" id="x_documento_mercaderia" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->documento_mercaderia->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->documento_mercaderia->EditValue ?>"<?php echo $viewsolicitudsupervisor->documento_mercaderia->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->documento_mercaderia->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_documento_mercaderia">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_documento_mercaderia"><?php echo $viewsolicitudsupervisor->documento_mercaderia->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->documento_mercaderia->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_documento_mercaderia">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_documento_mercaderia" data-page="5" name="x_documento_mercaderia" id="x_documento_mercaderia" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->documento_mercaderia->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->documento_mercaderia->EditValue ?>"<?php echo $viewsolicitudsupervisor->documento_mercaderia->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->documento_mercaderia->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane<?php echo $viewsolicitudsupervisor_edit->MultiPages->PageStyle("6") ?>" id="tab_viewsolicitudsupervisor6"><!-- multi-page .tab-pane -->
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_viewsolicitudsupervisoredit6" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipoespecial->Visible) { // tipoespecial ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_tipoespecial" class="form-group">
		<label id="elh_viewsolicitudsupervisor_tipoespecial" for="x_tipoespecial" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->tipoespecial->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->tipoespecial->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipoespecial">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipoespecial"><?php echo (strval($viewsolicitudsupervisor->tipoespecial->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewsolicitudsupervisor->tipoespecial->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewsolicitudsupervisor->tipoespecial->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipoespecial',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewsolicitudsupervisor->tipoespecial->ReadOnly || $viewsolicitudsupervisor->tipoespecial->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_tipoespecial" data-page="6" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewsolicitudsupervisor->tipoespecial->DisplayValueSeparatorAttribute() ?>" name="x_tipoespecial" id="x_tipoespecial" value="<?php echo $viewsolicitudsupervisor->tipoespecial->CurrentValue ?>"<?php echo $viewsolicitudsupervisor->tipoespecial->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->tipoespecial->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipoespecial">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_tipoespecial"><?php echo $viewsolicitudsupervisor->tipoespecial->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->tipoespecial->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipoespecial">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_tipoespecial"><?php echo (strval($viewsolicitudsupervisor->tipoespecial->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewsolicitudsupervisor->tipoespecial->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewsolicitudsupervisor->tipoespecial->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_tipoespecial',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewsolicitudsupervisor->tipoespecial->ReadOnly || $viewsolicitudsupervisor->tipoespecial->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_tipoespecial" data-page="6" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewsolicitudsupervisor->tipoespecial->DisplayValueSeparatorAttribute() ?>" name="x_tipoespecial" id="x_tipoespecial" value="<?php echo $viewsolicitudsupervisor->tipoespecial->CurrentValue ?>"<?php echo $viewsolicitudsupervisor->tipoespecial->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->tipoespecial->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor->documentos->Visible) { // documentos ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_documentos" class="form-group">
		<label id="elh_viewsolicitudsupervisor_documentos" for="x_documentos" class="<?php echo $viewsolicitudsupervisor_edit->LeftColumnClass ?>"><?php echo $viewsolicitudsupervisor->documentos->FldCaption() ?></label>
		<div class="<?php echo $viewsolicitudsupervisor_edit->RightColumnClass ?>"><div<?php echo $viewsolicitudsupervisor->documentos->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_documentos">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_documentos" data-page="6" name="x_documentos" id="x_documentos" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->documentos->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->documentos->EditValue ?>"<?php echo $viewsolicitudsupervisor->documentos->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->documentos->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_documentos">
		<td class="col-sm-3"><span id="elh_viewsolicitudsupervisor_documentos"><?php echo $viewsolicitudsupervisor->documentos->FldCaption() ?></span></td>
		<td<?php echo $viewsolicitudsupervisor->documentos->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_documentos">
<input type="text" data-table="viewsolicitudsupervisor" data-field="x_documentos" data-page="6" name="x_documentos" id="x_documentos" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->documentos->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudsupervisor->documentos->EditValue ?>"<?php echo $viewsolicitudsupervisor->documentos->EditAttributes() ?>>
</span>
<?php echo $viewsolicitudsupervisor->documentos->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
<span id="el_viewsolicitudsupervisor_email_contacto">
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_email_contacto" data-page="1" name="x_email_contacto" id="x_email_contacto" value="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->email_contacto->CurrentValue) ?>">
</span>
<span id="el_viewsolicitudsupervisor_id_sucursal">
<input type="hidden" data-table="viewsolicitudsupervisor" data-field="x_id_sucursal" data-page="1" name="x_id_sucursal" id="x_id_sucursal" value="<?php echo ew_HtmlEncode($viewsolicitudsupervisor->id_sucursal->CurrentValue) ?>">
</span>
<?php if (!$viewsolicitudsupervisor_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $viewsolicitudsupervisor_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $viewsolicitudsupervisor_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$viewsolicitudsupervisor_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fviewsolicitudsupervisoredit.Init();
</script>
<?php
$viewsolicitudsupervisor_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$viewsolicitudsupervisor_edit->Page_Terminate();
?>
