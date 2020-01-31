<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "supervisorinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$supervisor_add = NULL; // Initialize page object first

class csupervisor_add extends csupervisor {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'supervisor';

	// Page object name
	var $PageObjName = 'supervisor_add';

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

		// Table object (supervisor)
		if (!isset($GLOBALS["supervisor"]) || get_class($GLOBALS["supervisor"]) == "csupervisor") {
			$GLOBALS["supervisor"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["supervisor"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'supervisor', TRUE);

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
		if (!$Security->CanAdd()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			if ($Security->CanList())
				$this->Page_Terminate(ew_GetUrl("supervisorlist.php"));
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
		$this->nombre->SetVisibility();
		$this->apellido->SetVisibility();
		$this->_login->SetVisibility();
		$this->password->SetVisibility();
		$this->ci->SetVisibility();
		$this->id_rol->SetVisibility();
		$this->id_sucursal->SetVisibility();
		$this->_email->SetVisibility();
		$this->telefono_fijo01->SetVisibility();
		$this->telefono_fijo02->SetVisibility();
		$this->celular->SetVisibility();
		$this->celular2->SetVisibility();
		$this->direccion->SetVisibility();
		$this->cargo->SetVisibility();
		$this->id_institucion->SetVisibility();
		$this->especialidad->SetVisibility();
		$this->codigo->SetVisibility();

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
		global $EW_EXPORT, $supervisor;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($supervisor);
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
					if ($pageName == "supervisorview.php")
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
	var $FormClassName = "form-horizontal ewForm ewAddForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $Priv = 0;
	var $OldRecordset;
	var $CopyRecord;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError;
		global $gbSkipHeaderFooter;

		// Check modal
		if ($this->IsModal)
			$gbSkipHeaderFooter = TRUE;
		$this->IsMobileOrModal = ew_IsMobile() || $this->IsModal;
		$this->FormClassName = "ewForm ewAddForm form-horizontal";

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["_login"] != "") {
				$this->_login->setQueryStringValue($_GET["_login"]);
				$this->setKey("_login", $this->_login->CurrentValue); // Set up key
			} else {
				$this->setKey("_login", ""); // Clear key
				$this->CopyRecord = FALSE;
			}
			if ($this->CopyRecord) {
				$this->CurrentAction = "C"; // Copy record
			} else {
				$this->CurrentAction = "I"; // Display blank record
			}
		}

		// Load old record / default values
		$loaded = $this->LoadOldRecord();

		// Load form values
		if (@$_POST["a_add"] <> "") {
			$this->LoadFormValues(); // Load form values
		}

		// Validate form if post back
		if (@$_POST["a_add"] <> "") {
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->EventCancelled = TRUE; // Event cancelled
				$this->RestoreFormValues(); // Restore form values
				$this->setFailureMessage($gsFormError);
			}
		}

		// Perform current action
		switch ($this->CurrentAction) {
			case "I": // Blank record
				break;
			case "C": // Copy an existing record
				if (!$loaded) { // Record not loaded
					if ($this->getFailureMessage() == "") $this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
					$this->Page_Terminate("supervisorlist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "supervisorlist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "supervisorview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
				}
		}

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Render row based on row type
		$this->RowType = EW_ROWTYPE_ADD; // Render add type

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->nombre->CurrentValue = NULL;
		$this->nombre->OldValue = $this->nombre->CurrentValue;
		$this->apellido->CurrentValue = NULL;
		$this->apellido->OldValue = $this->apellido->CurrentValue;
		$this->_login->CurrentValue = NULL;
		$this->_login->OldValue = $this->_login->CurrentValue;
		$this->password->CurrentValue = NULL;
		$this->password->OldValue = $this->password->CurrentValue;
		$this->ci->CurrentValue = NULL;
		$this->ci->OldValue = $this->ci->CurrentValue;
		$this->id_rol->CurrentValue = 4;
		$this->id_sucursal->CurrentValue = NULL;
		$this->id_sucursal->OldValue = $this->id_sucursal->CurrentValue;
		$this->_email->CurrentValue = NULL;
		$this->_email->OldValue = $this->_email->CurrentValue;
		$this->telefono_fijo01->CurrentValue = NULL;
		$this->telefono_fijo01->OldValue = $this->telefono_fijo01->CurrentValue;
		$this->telefono_fijo02->CurrentValue = NULL;
		$this->telefono_fijo02->OldValue = $this->telefono_fijo02->CurrentValue;
		$this->celular->CurrentValue = NULL;
		$this->celular->OldValue = $this->celular->CurrentValue;
		$this->celular2->CurrentValue = NULL;
		$this->celular2->OldValue = $this->celular2->CurrentValue;
		$this->direccion->CurrentValue = NULL;
		$this->direccion->OldValue = $this->direccion->CurrentValue;
		$this->cargo->CurrentValue = NULL;
		$this->cargo->OldValue = $this->cargo->CurrentValue;
		$this->id_institucion->CurrentValue = NULL;
		$this->id_institucion->OldValue = $this->id_institucion->CurrentValue;
		$this->especialidad->CurrentValue = NULL;
		$this->especialidad->OldValue = $this->especialidad->CurrentValue;
		$this->status->CurrentValue = NULL;
		$this->status->OldValue = $this->status->CurrentValue;
		$this->avatar->Upload->DbValue = NULL;
		$this->avatar->OldValue = $this->avatar->Upload->DbValue;
		$this->color->CurrentValue = NULL;
		$this->color->OldValue = $this->color->CurrentValue;
		$this->codigo->CurrentValue = NULL;
		$this->codigo->OldValue = $this->codigo->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->nombre->FldIsDetailKey) {
			$this->nombre->setFormValue($objForm->GetValue("x_nombre"));
		}
		if (!$this->apellido->FldIsDetailKey) {
			$this->apellido->setFormValue($objForm->GetValue("x_apellido"));
		}
		if (!$this->_login->FldIsDetailKey) {
			$this->_login->setFormValue($objForm->GetValue("x__login"));
		}
		if (!$this->password->FldIsDetailKey) {
			$this->password->setFormValue($objForm->GetValue("x_password"));
		}
		if (!$this->ci->FldIsDetailKey) {
			$this->ci->setFormValue($objForm->GetValue("x_ci"));
		}
		if (!$this->id_rol->FldIsDetailKey) {
			$this->id_rol->setFormValue($objForm->GetValue("x_id_rol"));
		}
		if (!$this->id_sucursal->FldIsDetailKey) {
			$this->id_sucursal->setFormValue($objForm->GetValue("x_id_sucursal"));
		}
		if (!$this->_email->FldIsDetailKey) {
			$this->_email->setFormValue($objForm->GetValue("x__email"));
		}
		if (!$this->telefono_fijo01->FldIsDetailKey) {
			$this->telefono_fijo01->setFormValue($objForm->GetValue("x_telefono_fijo01"));
		}
		if (!$this->telefono_fijo02->FldIsDetailKey) {
			$this->telefono_fijo02->setFormValue($objForm->GetValue("x_telefono_fijo02"));
		}
		if (!$this->celular->FldIsDetailKey) {
			$this->celular->setFormValue($objForm->GetValue("x_celular"));
		}
		if (!$this->celular2->FldIsDetailKey) {
			$this->celular2->setFormValue($objForm->GetValue("x_celular2"));
		}
		if (!$this->direccion->FldIsDetailKey) {
			$this->direccion->setFormValue($objForm->GetValue("x_direccion"));
		}
		if (!$this->cargo->FldIsDetailKey) {
			$this->cargo->setFormValue($objForm->GetValue("x_cargo"));
		}
		if (!$this->id_institucion->FldIsDetailKey) {
			$this->id_institucion->setFormValue($objForm->GetValue("x_id_institucion"));
		}
		if (!$this->especialidad->FldIsDetailKey) {
			$this->especialidad->setFormValue($objForm->GetValue("x_especialidad"));
		}
		if (!$this->codigo->FldIsDetailKey) {
			$this->codigo->setFormValue($objForm->GetValue("x_codigo"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->nombre->CurrentValue = $this->nombre->FormValue;
		$this->apellido->CurrentValue = $this->apellido->FormValue;
		$this->_login->CurrentValue = $this->_login->FormValue;
		$this->password->CurrentValue = $this->password->FormValue;
		$this->ci->CurrentValue = $this->ci->FormValue;
		$this->id_rol->CurrentValue = $this->id_rol->FormValue;
		$this->id_sucursal->CurrentValue = $this->id_sucursal->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->telefono_fijo01->CurrentValue = $this->telefono_fijo01->FormValue;
		$this->telefono_fijo02->CurrentValue = $this->telefono_fijo02->FormValue;
		$this->celular->CurrentValue = $this->celular->FormValue;
		$this->celular2->CurrentValue = $this->celular2->FormValue;
		$this->direccion->CurrentValue = $this->direccion->FormValue;
		$this->cargo->CurrentValue = $this->cargo->FormValue;
		$this->id_institucion->CurrentValue = $this->id_institucion->FormValue;
		$this->especialidad->CurrentValue = $this->especialidad->FormValue;
		$this->codigo->CurrentValue = $this->codigo->FormValue;
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
		$this->nombre->setDbValue($row['nombre']);
		$this->apellido->setDbValue($row['apellido']);
		$this->_login->setDbValue($row['login']);
		$this->password->setDbValue($row['password']);
		$this->ci->setDbValue($row['ci']);
		$this->id_rol->setDbValue($row['id_rol']);
		$this->id_sucursal->setDbValue($row['id_sucursal']);
		$this->_email->setDbValue($row['email']);
		$this->telefono_fijo01->setDbValue($row['telefono_fijo01']);
		$this->telefono_fijo02->setDbValue($row['telefono_fijo02']);
		$this->celular->setDbValue($row['celular']);
		$this->celular2->setDbValue($row['celular2']);
		$this->direccion->setDbValue($row['direccion']);
		$this->cargo->setDbValue($row['cargo']);
		$this->id_institucion->setDbValue($row['id_institucion']);
		$this->especialidad->setDbValue($row['especialidad']);
		$this->status->setDbValue($row['status']);
		$this->avatar->Upload->DbValue = $row['avatar'];
		if (is_array($this->avatar->Upload->DbValue) || is_object($this->avatar->Upload->DbValue)) // Byte array
			$this->avatar->Upload->DbValue = ew_BytesToStr($this->avatar->Upload->DbValue);
		$this->color->setDbValue($row['color']);
		$this->codigo->setDbValue($row['codigo']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['nombre'] = $this->nombre->CurrentValue;
		$row['apellido'] = $this->apellido->CurrentValue;
		$row['login'] = $this->_login->CurrentValue;
		$row['password'] = $this->password->CurrentValue;
		$row['ci'] = $this->ci->CurrentValue;
		$row['id_rol'] = $this->id_rol->CurrentValue;
		$row['id_sucursal'] = $this->id_sucursal->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['telefono_fijo01'] = $this->telefono_fijo01->CurrentValue;
		$row['telefono_fijo02'] = $this->telefono_fijo02->CurrentValue;
		$row['celular'] = $this->celular->CurrentValue;
		$row['celular2'] = $this->celular2->CurrentValue;
		$row['direccion'] = $this->direccion->CurrentValue;
		$row['cargo'] = $this->cargo->CurrentValue;
		$row['id_institucion'] = $this->id_institucion->CurrentValue;
		$row['especialidad'] = $this->especialidad->CurrentValue;
		$row['status'] = $this->status->CurrentValue;
		$row['avatar'] = $this->avatar->Upload->DbValue;
		$row['color'] = $this->color->CurrentValue;
		$row['codigo'] = $this->codigo->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->nombre->DbValue = $row['nombre'];
		$this->apellido->DbValue = $row['apellido'];
		$this->_login->DbValue = $row['login'];
		$this->password->DbValue = $row['password'];
		$this->ci->DbValue = $row['ci'];
		$this->id_rol->DbValue = $row['id_rol'];
		$this->id_sucursal->DbValue = $row['id_sucursal'];
		$this->_email->DbValue = $row['email'];
		$this->telefono_fijo01->DbValue = $row['telefono_fijo01'];
		$this->telefono_fijo02->DbValue = $row['telefono_fijo02'];
		$this->celular->DbValue = $row['celular'];
		$this->celular2->DbValue = $row['celular2'];
		$this->direccion->DbValue = $row['direccion'];
		$this->cargo->DbValue = $row['cargo'];
		$this->id_institucion->DbValue = $row['id_institucion'];
		$this->especialidad->DbValue = $row['especialidad'];
		$this->status->DbValue = $row['status'];
		$this->avatar->Upload->DbValue = $row['avatar'];
		$this->color->DbValue = $row['color'];
		$this->codigo->DbValue = $row['codigo'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("_login")) <> "")
			$this->_login->CurrentValue = $this->getKey("_login"); // login
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
		// avatar
		// color
		// codigo

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		$this->id_rol->LookupFilters = array();
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
		$this->id_sucursal->LookupFilters = array();
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

		// codigo
		$this->codigo->ViewValue = $this->codigo->CurrentValue;
		$this->codigo->ViewCustomAttributes = "";

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

			// codigo
			$this->codigo->LinkCustomAttributes = "";
			$this->codigo->HrefValue = "";
			$this->codigo->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// nombre
			$this->nombre->EditAttrs["class"] = "form-control";
			$this->nombre->EditCustomAttributes = "";
			$this->nombre->EditValue = ew_HtmlEncode($this->nombre->CurrentValue);
			$this->nombre->PlaceHolder = ew_RemoveHtml($this->nombre->FldTitle());

			// apellido
			$this->apellido->EditAttrs["class"] = "form-control";
			$this->apellido->EditCustomAttributes = "";
			$this->apellido->EditValue = ew_HtmlEncode($this->apellido->CurrentValue);
			$this->apellido->PlaceHolder = ew_RemoveHtml($this->apellido->FldTitle());

			// login
			$this->_login->EditAttrs["class"] = "form-control";
			$this->_login->EditCustomAttributes = "";
			$this->_login->EditValue = ew_HtmlEncode($this->_login->CurrentValue);
			$this->_login->PlaceHolder = ew_RemoveHtml($this->_login->FldTitle());

			// password
			$this->password->EditAttrs["class"] = "form-control";
			$this->password->EditCustomAttributes = "";
			$this->password->EditValue = ew_HtmlEncode($this->password->CurrentValue);
			$this->password->PlaceHolder = ew_RemoveHtml($this->password->FldTitle());

			// ci
			$this->ci->EditAttrs["class"] = "form-control";
			$this->ci->EditCustomAttributes = "";
			$this->ci->EditValue = ew_HtmlEncode($this->ci->CurrentValue);
			$this->ci->PlaceHolder = ew_RemoveHtml($this->ci->FldTitle());

			// id_rol
			$this->id_rol->EditAttrs["class"] = "form-control";
			$this->id_rol->EditCustomAttributes = "";
			if (trim(strval($this->id_rol->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`userlevelid`" . ew_SearchString("=", $this->id_rol->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `userlevels`";
			$sWhereWrk = "";
			$this->id_rol->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_rol, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_rol->EditValue = $arwrk;

			// id_sucursal
			$this->id_sucursal->EditAttrs["class"] = "form-control";
			$this->id_sucursal->EditCustomAttributes = "";
			if (trim(strval($this->id_sucursal->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_sucursal->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `sucursal`";
			$sWhereWrk = "";
			$this->id_sucursal->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_sucursal, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_sucursal->EditValue = $arwrk;

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			$this->_email->EditValue = ew_HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldTitle());

			// telefono_fijo01
			$this->telefono_fijo01->EditAttrs["class"] = "form-control";
			$this->telefono_fijo01->EditCustomAttributes = "";
			$this->telefono_fijo01->EditValue = ew_HtmlEncode($this->telefono_fijo01->CurrentValue);
			$this->telefono_fijo01->PlaceHolder = ew_RemoveHtml($this->telefono_fijo01->FldTitle());

			// telefono_fijo02
			$this->telefono_fijo02->EditAttrs["class"] = "form-control";
			$this->telefono_fijo02->EditCustomAttributes = "";
			$this->telefono_fijo02->EditValue = ew_HtmlEncode($this->telefono_fijo02->CurrentValue);
			$this->telefono_fijo02->PlaceHolder = ew_RemoveHtml($this->telefono_fijo02->FldTitle());

			// celular
			$this->celular->EditAttrs["class"] = "form-control";
			$this->celular->EditCustomAttributes = "";
			$this->celular->EditValue = ew_HtmlEncode($this->celular->CurrentValue);
			$this->celular->PlaceHolder = ew_RemoveHtml($this->celular->FldTitle());

			// celular2
			$this->celular2->EditAttrs["class"] = "form-control";
			$this->celular2->EditCustomAttributes = "";
			$this->celular2->EditValue = ew_HtmlEncode($this->celular2->CurrentValue);
			$this->celular2->PlaceHolder = ew_RemoveHtml($this->celular2->FldTitle());

			// direccion
			$this->direccion->EditAttrs["class"] = "form-control";
			$this->direccion->EditCustomAttributes = "";
			$this->direccion->EditValue = ew_HtmlEncode($this->direccion->CurrentValue);
			$this->direccion->PlaceHolder = ew_RemoveHtml($this->direccion->FldTitle());

			// cargo
			$this->cargo->EditAttrs["class"] = "form-control";
			$this->cargo->EditCustomAttributes = "";
			$this->cargo->EditValue = ew_HtmlEncode($this->cargo->CurrentValue);
			$this->cargo->PlaceHolder = ew_RemoveHtml($this->cargo->FldTitle());

			// id_institucion
			$this->id_institucion->EditAttrs["class"] = "form-control";
			$this->id_institucion->EditCustomAttributes = "";
			$this->id_institucion->EditValue = ew_HtmlEncode($this->id_institucion->CurrentValue);
			$this->id_institucion->PlaceHolder = ew_RemoveHtml($this->id_institucion->FldTitle());

			// especialidad
			$this->especialidad->EditAttrs["class"] = "form-control";
			$this->especialidad->EditCustomAttributes = "";
			$this->especialidad->EditValue = ew_HtmlEncode($this->especialidad->CurrentValue);
			$this->especialidad->PlaceHolder = ew_RemoveHtml($this->especialidad->FldTitle());

			// codigo
			$this->codigo->EditAttrs["class"] = "form-control";
			$this->codigo->EditCustomAttributes = "";
			$this->codigo->EditValue = ew_HtmlEncode($this->codigo->CurrentValue);
			$this->codigo->PlaceHolder = ew_RemoveHtml($this->codigo->FldTitle());

			// Add refer script
			// nombre

			$this->nombre->LinkCustomAttributes = "";
			$this->nombre->HrefValue = "";

			// apellido
			$this->apellido->LinkCustomAttributes = "";
			$this->apellido->HrefValue = "";

			// login
			$this->_login->LinkCustomAttributes = "";
			$this->_login->HrefValue = "";

			// password
			$this->password->LinkCustomAttributes = "";
			$this->password->HrefValue = "";

			// ci
			$this->ci->LinkCustomAttributes = "";
			$this->ci->HrefValue = "";

			// id_rol
			$this->id_rol->LinkCustomAttributes = "";
			$this->id_rol->HrefValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// telefono_fijo01
			$this->telefono_fijo01->LinkCustomAttributes = "";
			$this->telefono_fijo01->HrefValue = "";

			// telefono_fijo02
			$this->telefono_fijo02->LinkCustomAttributes = "";
			$this->telefono_fijo02->HrefValue = "";

			// celular
			$this->celular->LinkCustomAttributes = "";
			$this->celular->HrefValue = "";

			// celular2
			$this->celular2->LinkCustomAttributes = "";
			$this->celular2->HrefValue = "";

			// direccion
			$this->direccion->LinkCustomAttributes = "";
			$this->direccion->HrefValue = "";

			// cargo
			$this->cargo->LinkCustomAttributes = "";
			$this->cargo->HrefValue = "";

			// id_institucion
			$this->id_institucion->LinkCustomAttributes = "";
			$this->id_institucion->HrefValue = "";

			// especialidad
			$this->especialidad->LinkCustomAttributes = "";
			$this->especialidad->HrefValue = "";

			// codigo
			$this->codigo->LinkCustomAttributes = "";
			$this->codigo->HrefValue = "";
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
		if (!$this->nombre->FldIsDetailKey && !is_null($this->nombre->FormValue) && $this->nombre->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->nombre->FldCaption(), $this->nombre->ReqErrMsg));
		}
		if (!$this->apellido->FldIsDetailKey && !is_null($this->apellido->FormValue) && $this->apellido->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->apellido->FldCaption(), $this->apellido->ReqErrMsg));
		}
		if (!$this->_login->FldIsDetailKey && !is_null($this->_login->FormValue) && $this->_login->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->_login->FldCaption(), $this->_login->ReqErrMsg));
		}
		if (!ew_CheckEmail($this->_login->FormValue)) {
			ew_AddMessage($gsFormError, $this->_login->FldErrMsg());
		}
		if (!$this->password->FldIsDetailKey && !is_null($this->password->FormValue) && $this->password->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->password->FldCaption(), $this->password->ReqErrMsg));
		}
		if (!$this->ci->FldIsDetailKey && !is_null($this->ci->FormValue) && $this->ci->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ci->FldCaption(), $this->ci->ReqErrMsg));
		}
		if (!$this->id_rol->FldIsDetailKey && !is_null($this->id_rol->FormValue) && $this->id_rol->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->id_rol->FldCaption(), $this->id_rol->ReqErrMsg));
		}
		if (!$this->id_sucursal->FldIsDetailKey && !is_null($this->id_sucursal->FormValue) && $this->id_sucursal->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->id_sucursal->FldCaption(), $this->id_sucursal->ReqErrMsg));
		}
		if (!ew_CheckEmail($this->_email->FormValue)) {
			ew_AddMessage($gsFormError, $this->_email->FldErrMsg());
		}
		if (!$this->direccion->FldIsDetailKey && !is_null($this->direccion->FormValue) && $this->direccion->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->direccion->FldCaption(), $this->direccion->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->id_institucion->FormValue)) {
			ew_AddMessage($gsFormError, $this->id_institucion->FldErrMsg());
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// nombre
		$this->nombre->SetDbValueDef($rsnew, $this->nombre->CurrentValue, "", FALSE);

		// apellido
		$this->apellido->SetDbValueDef($rsnew, $this->apellido->CurrentValue, "", FALSE);

		// login
		$this->_login->SetDbValueDef($rsnew, $this->_login->CurrentValue, "", FALSE);

		// password
		$this->password->SetDbValueDef($rsnew, $this->password->CurrentValue, "", FALSE);

		// ci
		$this->ci->SetDbValueDef($rsnew, $this->ci->CurrentValue, "", FALSE);

		// id_rol
		$this->id_rol->SetDbValueDef($rsnew, $this->id_rol->CurrentValue, 0, FALSE);

		// id_sucursal
		$this->id_sucursal->SetDbValueDef($rsnew, $this->id_sucursal->CurrentValue, 0, FALSE);

		// email
		$this->_email->SetDbValueDef($rsnew, $this->_email->CurrentValue, NULL, FALSE);

		// telefono_fijo01
		$this->telefono_fijo01->SetDbValueDef($rsnew, $this->telefono_fijo01->CurrentValue, NULL, FALSE);

		// telefono_fijo02
		$this->telefono_fijo02->SetDbValueDef($rsnew, $this->telefono_fijo02->CurrentValue, NULL, FALSE);

		// celular
		$this->celular->SetDbValueDef($rsnew, $this->celular->CurrentValue, NULL, FALSE);

		// celular2
		$this->celular2->SetDbValueDef($rsnew, $this->celular2->CurrentValue, NULL, FALSE);

		// direccion
		$this->direccion->SetDbValueDef($rsnew, $this->direccion->CurrentValue, "", FALSE);

		// cargo
		$this->cargo->SetDbValueDef($rsnew, $this->cargo->CurrentValue, NULL, FALSE);

		// id_institucion
		$this->id_institucion->SetDbValueDef($rsnew, $this->id_institucion->CurrentValue, NULL, FALSE);

		// especialidad
		$this->especialidad->SetDbValueDef($rsnew, $this->especialidad->CurrentValue, NULL, FALSE);

		// codigo
		$this->codigo->SetDbValueDef($rsnew, $this->codigo->CurrentValue, NULL, FALSE);

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);

		// Check if key value entered
		if ($bInsertRow && $this->ValidateKey && strval($rsnew['login']) == "") {
			$this->setFailureMessage($Language->Phrase("InvalidKeyValue"));
			$bInsertRow = FALSE;
		}

		// Check for duplicate key
		if ($bInsertRow && $this->ValidateKey) {
			$sFilter = $this->KeyFilter();
			$rsChk = $this->LoadRs($sFilter);
			if ($rsChk && !$rsChk->EOF) {
				$sKeyErrMsg = str_replace("%f", $sFilter, $Language->Phrase("DupKey"));
				$this->setFailureMessage($sKeyErrMsg);
				$rsChk->Close();
				$bInsertRow = FALSE;
			}
		}
		if ($bInsertRow) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$AddRow = $this->Insert($rsnew);
			$conn->raiseErrorFn = '';
			if ($AddRow) {
			}
		} else {
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("InsertCancelled"));
			}
			$AddRow = FALSE;
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("supervisorlist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_id_rol":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `userlevelid` AS `LinkFld`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`userlevelid` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_rol, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_sucursal":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_sucursal, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($supervisor_add)) $supervisor_add = new csupervisor_add();

// Page init
$supervisor_add->Page_Init();

// Page main
$supervisor_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$supervisor_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fsupervisoradd = new ew_Form("fsupervisoradd", "add");

// Validate form
fsupervisoradd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_nombre");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $supervisor->nombre->FldCaption(), $supervisor->nombre->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_apellido");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $supervisor->apellido->FldCaption(), $supervisor->apellido->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "__login");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $supervisor->_login->FldCaption(), $supervisor->_login->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "__login");
			if (elm && !ew_CheckEmail(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($supervisor->_login->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_password");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $supervisor->password->FldCaption(), $supervisor->password->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ci");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $supervisor->ci->FldCaption(), $supervisor->ci->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_id_rol");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $supervisor->id_rol->FldCaption(), $supervisor->id_rol->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_id_sucursal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $supervisor->id_sucursal->FldCaption(), $supervisor->id_sucursal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "__email");
			if (elm && !ew_CheckEmail(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($supervisor->_email->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_direccion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $supervisor->direccion->FldCaption(), $supervisor->direccion->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_id_institucion");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($supervisor->id_institucion->FldErrMsg()) ?>");

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
fsupervisoradd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fsupervisoradd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fsupervisoradd.Lists["x_id_rol"] = {"LinkField":"x_userlevelid","Ajax":true,"AutoFill":false,"DisplayFields":["x_userlevelname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"userlevels"};
fsupervisoradd.Lists["x_id_rol"].Data = "<?php echo $supervisor_add->id_rol->LookupFilterQuery(FALSE, "add") ?>";
fsupervisoradd.Lists["x_id_sucursal"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"sucursal"};
fsupervisoradd.Lists["x_id_sucursal"].Data = "<?php echo $supervisor_add->id_sucursal->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $supervisor_add->ShowPageHeader(); ?>
<?php
$supervisor_add->ShowMessage();
?>
<form name="fsupervisoradd" id="fsupervisoradd" class="<?php echo $supervisor_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($supervisor_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $supervisor_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="supervisor">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($supervisor_add->IsModal) ?>">
<?php if (!$supervisor_add->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
<div class="ewAddDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_supervisoradd" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($supervisor->nombre->Visible) { // nombre ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_nombre" class="form-group">
		<label id="elh_supervisor_nombre" for="x_nombre" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->nombre->CellAttributes() ?>>
<span id="el_supervisor_nombre">
<input type="text" data-table="supervisor" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->nombre->getPlaceHolder()) ?>" value="<?php echo $supervisor->nombre->EditValue ?>"<?php echo $supervisor->nombre->EditAttributes() ?>>
</span>
<?php echo $supervisor->nombre->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_nombre">
		<td class="col-sm-3"><span id="elh_supervisor_nombre"><?php echo $supervisor->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $supervisor->nombre->CellAttributes() ?>>
<span id="el_supervisor_nombre">
<input type="text" data-table="supervisor" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->nombre->getPlaceHolder()) ?>" value="<?php echo $supervisor->nombre->EditValue ?>"<?php echo $supervisor->nombre->EditAttributes() ?>>
</span>
<?php echo $supervisor->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->apellido->Visible) { // apellido ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_apellido" class="form-group">
		<label id="elh_supervisor_apellido" for="x_apellido" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->apellido->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->apellido->CellAttributes() ?>>
<span id="el_supervisor_apellido">
<input type="text" data-table="supervisor" data-field="x_apellido" name="x_apellido" id="x_apellido" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($supervisor->apellido->getPlaceHolder()) ?>" value="<?php echo $supervisor->apellido->EditValue ?>"<?php echo $supervisor->apellido->EditAttributes() ?>>
</span>
<?php echo $supervisor->apellido->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_apellido">
		<td class="col-sm-3"><span id="elh_supervisor_apellido"><?php echo $supervisor->apellido->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $supervisor->apellido->CellAttributes() ?>>
<span id="el_supervisor_apellido">
<input type="text" data-table="supervisor" data-field="x_apellido" name="x_apellido" id="x_apellido" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($supervisor->apellido->getPlaceHolder()) ?>" value="<?php echo $supervisor->apellido->EditValue ?>"<?php echo $supervisor->apellido->EditAttributes() ?>>
</span>
<?php echo $supervisor->apellido->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->_login->Visible) { // login ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r__login" class="form-group">
		<label id="elh_supervisor__login" for="x__login" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->_login->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->_login->CellAttributes() ?>>
<span id="el_supervisor__login">
<input type="text" data-table="supervisor" data-field="x__login" name="x__login" id="x__login" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->_login->getPlaceHolder()) ?>" value="<?php echo $supervisor->_login->EditValue ?>"<?php echo $supervisor->_login->EditAttributes() ?>>
</span>
<?php echo $supervisor->_login->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__login">
		<td class="col-sm-3"><span id="elh_supervisor__login"><?php echo $supervisor->_login->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $supervisor->_login->CellAttributes() ?>>
<span id="el_supervisor__login">
<input type="text" data-table="supervisor" data-field="x__login" name="x__login" id="x__login" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->_login->getPlaceHolder()) ?>" value="<?php echo $supervisor->_login->EditValue ?>"<?php echo $supervisor->_login->EditAttributes() ?>>
</span>
<?php echo $supervisor->_login->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->password->Visible) { // password ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_password" class="form-group">
		<label id="elh_supervisor_password" for="x_password" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->password->CellAttributes() ?>>
<span id="el_supervisor_password">
<div class="input-group" id="ig_password">
<input type="password" data-password-generated="pgt_password" data-table="supervisor" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($supervisor->password->getPlaceHolder()) ?>"<?php echo $supervisor->password->EditAttributes() ?>>
<span class="input-group-btn">
	<button type="button" class="btn btn-default ewPasswordGenerator" title="<?php echo ew_HtmlTitle($Language->Phrase("GeneratePassword")) ?>" data-password-field="x_password" data-password-confirm="c_password" data-password-generated="pgt_password"><?php echo $Language->Phrase("GeneratePassword") ?></button>
</span>
</div>
<span class="help-block" id="pgt_password" style="display: none;"></span>
</span>
<?php echo $supervisor->password->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_password">
		<td class="col-sm-3"><span id="elh_supervisor_password"><?php echo $supervisor->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $supervisor->password->CellAttributes() ?>>
<span id="el_supervisor_password">
<div class="input-group" id="ig_password">
<input type="password" data-password-generated="pgt_password" data-table="supervisor" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($supervisor->password->getPlaceHolder()) ?>"<?php echo $supervisor->password->EditAttributes() ?>>
<span class="input-group-btn">
	<button type="button" class="btn btn-default ewPasswordGenerator" title="<?php echo ew_HtmlTitle($Language->Phrase("GeneratePassword")) ?>" data-password-field="x_password" data-password-confirm="c_password" data-password-generated="pgt_password"><?php echo $Language->Phrase("GeneratePassword") ?></button>
</span>
</div>
<span class="help-block" id="pgt_password" style="display: none;"></span>
</span>
<?php echo $supervisor->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->ci->Visible) { // ci ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_ci" class="form-group">
		<label id="elh_supervisor_ci" for="x_ci" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->ci->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->ci->CellAttributes() ?>>
<span id="el_supervisor_ci">
<input type="text" data-table="supervisor" data-field="x_ci" name="x_ci" id="x_ci" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($supervisor->ci->getPlaceHolder()) ?>" value="<?php echo $supervisor->ci->EditValue ?>"<?php echo $supervisor->ci->EditAttributes() ?>>
</span>
<?php echo $supervisor->ci->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ci">
		<td class="col-sm-3"><span id="elh_supervisor_ci"><?php echo $supervisor->ci->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $supervisor->ci->CellAttributes() ?>>
<span id="el_supervisor_ci">
<input type="text" data-table="supervisor" data-field="x_ci" name="x_ci" id="x_ci" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($supervisor->ci->getPlaceHolder()) ?>" value="<?php echo $supervisor->ci->EditValue ?>"<?php echo $supervisor->ci->EditAttributes() ?>>
</span>
<?php echo $supervisor->ci->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->id_rol->Visible) { // id_rol ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_id_rol" class="form-group">
		<label id="elh_supervisor_id_rol" for="x_id_rol" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->id_rol->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->id_rol->CellAttributes() ?>>
<span id="el_supervisor_id_rol">
<select data-table="supervisor" data-field="x_id_rol" data-value-separator="<?php echo $supervisor->id_rol->DisplayValueSeparatorAttribute() ?>" id="x_id_rol" name="x_id_rol"<?php echo $supervisor->id_rol->EditAttributes() ?>>
<?php echo $supervisor->id_rol->SelectOptionListHtml("x_id_rol") ?>
</select>
</span>
<?php echo $supervisor->id_rol->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_rol">
		<td class="col-sm-3"><span id="elh_supervisor_id_rol"><?php echo $supervisor->id_rol->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $supervisor->id_rol->CellAttributes() ?>>
<span id="el_supervisor_id_rol">
<select data-table="supervisor" data-field="x_id_rol" data-value-separator="<?php echo $supervisor->id_rol->DisplayValueSeparatorAttribute() ?>" id="x_id_rol" name="x_id_rol"<?php echo $supervisor->id_rol->EditAttributes() ?>>
<?php echo $supervisor->id_rol->SelectOptionListHtml("x_id_rol") ?>
</select>
</span>
<?php echo $supervisor->id_rol->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->id_sucursal->Visible) { // id_sucursal ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_id_sucursal" class="form-group">
		<label id="elh_supervisor_id_sucursal" for="x_id_sucursal" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->id_sucursal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->id_sucursal->CellAttributes() ?>>
<span id="el_supervisor_id_sucursal">
<select data-table="supervisor" data-field="x_id_sucursal" data-value-separator="<?php echo $supervisor->id_sucursal->DisplayValueSeparatorAttribute() ?>" id="x_id_sucursal" name="x_id_sucursal"<?php echo $supervisor->id_sucursal->EditAttributes() ?>>
<?php echo $supervisor->id_sucursal->SelectOptionListHtml("x_id_sucursal") ?>
</select>
</span>
<?php echo $supervisor->id_sucursal->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_sucursal">
		<td class="col-sm-3"><span id="elh_supervisor_id_sucursal"><?php echo $supervisor->id_sucursal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $supervisor->id_sucursal->CellAttributes() ?>>
<span id="el_supervisor_id_sucursal">
<select data-table="supervisor" data-field="x_id_sucursal" data-value-separator="<?php echo $supervisor->id_sucursal->DisplayValueSeparatorAttribute() ?>" id="x_id_sucursal" name="x_id_sucursal"<?php echo $supervisor->id_sucursal->EditAttributes() ?>>
<?php echo $supervisor->id_sucursal->SelectOptionListHtml("x_id_sucursal") ?>
</select>
</span>
<?php echo $supervisor->id_sucursal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->_email->Visible) { // email ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r__email" class="form-group">
		<label id="elh_supervisor__email" for="x__email" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->_email->FldCaption() ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->_email->CellAttributes() ?>>
<span id="el_supervisor__email">
<input type="text" data-table="supervisor" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($supervisor->_email->getPlaceHolder()) ?>" value="<?php echo $supervisor->_email->EditValue ?>"<?php echo $supervisor->_email->EditAttributes() ?>>
</span>
<?php echo $supervisor->_email->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__email">
		<td class="col-sm-3"><span id="elh_supervisor__email"><?php echo $supervisor->_email->FldCaption() ?></span></td>
		<td<?php echo $supervisor->_email->CellAttributes() ?>>
<span id="el_supervisor__email">
<input type="text" data-table="supervisor" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($supervisor->_email->getPlaceHolder()) ?>" value="<?php echo $supervisor->_email->EditValue ?>"<?php echo $supervisor->_email->EditAttributes() ?>>
</span>
<?php echo $supervisor->_email->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->telefono_fijo01->Visible) { // telefono_fijo01 ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_telefono_fijo01" class="form-group">
		<label id="elh_supervisor_telefono_fijo01" for="x_telefono_fijo01" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->telefono_fijo01->FldCaption() ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->telefono_fijo01->CellAttributes() ?>>
<span id="el_supervisor_telefono_fijo01">
<input type="text" data-table="supervisor" data-field="x_telefono_fijo01" name="x_telefono_fijo01" id="x_telefono_fijo01" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->telefono_fijo01->getPlaceHolder()) ?>" value="<?php echo $supervisor->telefono_fijo01->EditValue ?>"<?php echo $supervisor->telefono_fijo01->EditAttributes() ?>>
</span>
<?php echo $supervisor->telefono_fijo01->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_telefono_fijo01">
		<td class="col-sm-3"><span id="elh_supervisor_telefono_fijo01"><?php echo $supervisor->telefono_fijo01->FldCaption() ?></span></td>
		<td<?php echo $supervisor->telefono_fijo01->CellAttributes() ?>>
<span id="el_supervisor_telefono_fijo01">
<input type="text" data-table="supervisor" data-field="x_telefono_fijo01" name="x_telefono_fijo01" id="x_telefono_fijo01" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->telefono_fijo01->getPlaceHolder()) ?>" value="<?php echo $supervisor->telefono_fijo01->EditValue ?>"<?php echo $supervisor->telefono_fijo01->EditAttributes() ?>>
</span>
<?php echo $supervisor->telefono_fijo01->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->telefono_fijo02->Visible) { // telefono_fijo02 ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_telefono_fijo02" class="form-group">
		<label id="elh_supervisor_telefono_fijo02" for="x_telefono_fijo02" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->telefono_fijo02->FldCaption() ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->telefono_fijo02->CellAttributes() ?>>
<span id="el_supervisor_telefono_fijo02">
<input type="text" data-table="supervisor" data-field="x_telefono_fijo02" name="x_telefono_fijo02" id="x_telefono_fijo02" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->telefono_fijo02->getPlaceHolder()) ?>" value="<?php echo $supervisor->telefono_fijo02->EditValue ?>"<?php echo $supervisor->telefono_fijo02->EditAttributes() ?>>
</span>
<?php echo $supervisor->telefono_fijo02->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_telefono_fijo02">
		<td class="col-sm-3"><span id="elh_supervisor_telefono_fijo02"><?php echo $supervisor->telefono_fijo02->FldCaption() ?></span></td>
		<td<?php echo $supervisor->telefono_fijo02->CellAttributes() ?>>
<span id="el_supervisor_telefono_fijo02">
<input type="text" data-table="supervisor" data-field="x_telefono_fijo02" name="x_telefono_fijo02" id="x_telefono_fijo02" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->telefono_fijo02->getPlaceHolder()) ?>" value="<?php echo $supervisor->telefono_fijo02->EditValue ?>"<?php echo $supervisor->telefono_fijo02->EditAttributes() ?>>
</span>
<?php echo $supervisor->telefono_fijo02->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->celular->Visible) { // celular ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_celular" class="form-group">
		<label id="elh_supervisor_celular" for="x_celular" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->celular->FldCaption() ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->celular->CellAttributes() ?>>
<span id="el_supervisor_celular">
<input type="text" data-table="supervisor" data-field="x_celular" name="x_celular" id="x_celular" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->celular->getPlaceHolder()) ?>" value="<?php echo $supervisor->celular->EditValue ?>"<?php echo $supervisor->celular->EditAttributes() ?>>
</span>
<?php echo $supervisor->celular->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_celular">
		<td class="col-sm-3"><span id="elh_supervisor_celular"><?php echo $supervisor->celular->FldCaption() ?></span></td>
		<td<?php echo $supervisor->celular->CellAttributes() ?>>
<span id="el_supervisor_celular">
<input type="text" data-table="supervisor" data-field="x_celular" name="x_celular" id="x_celular" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->celular->getPlaceHolder()) ?>" value="<?php echo $supervisor->celular->EditValue ?>"<?php echo $supervisor->celular->EditAttributes() ?>>
</span>
<?php echo $supervisor->celular->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->celular2->Visible) { // celular2 ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_celular2" class="form-group">
		<label id="elh_supervisor_celular2" for="x_celular2" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->celular2->FldCaption() ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->celular2->CellAttributes() ?>>
<span id="el_supervisor_celular2">
<input type="text" data-table="supervisor" data-field="x_celular2" name="x_celular2" id="x_celular2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->celular2->getPlaceHolder()) ?>" value="<?php echo $supervisor->celular2->EditValue ?>"<?php echo $supervisor->celular2->EditAttributes() ?>>
</span>
<?php echo $supervisor->celular2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_celular2">
		<td class="col-sm-3"><span id="elh_supervisor_celular2"><?php echo $supervisor->celular2->FldCaption() ?></span></td>
		<td<?php echo $supervisor->celular2->CellAttributes() ?>>
<span id="el_supervisor_celular2">
<input type="text" data-table="supervisor" data-field="x_celular2" name="x_celular2" id="x_celular2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->celular2->getPlaceHolder()) ?>" value="<?php echo $supervisor->celular2->EditValue ?>"<?php echo $supervisor->celular2->EditAttributes() ?>>
</span>
<?php echo $supervisor->celular2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->direccion->Visible) { // direccion ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_direccion" class="form-group">
		<label id="elh_supervisor_direccion" for="x_direccion" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->direccion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->direccion->CellAttributes() ?>>
<span id="el_supervisor_direccion">
<textarea data-table="supervisor" data-field="x_direccion" name="x_direccion" id="x_direccion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($supervisor->direccion->getPlaceHolder()) ?>"<?php echo $supervisor->direccion->EditAttributes() ?>><?php echo $supervisor->direccion->EditValue ?></textarea>
</span>
<?php echo $supervisor->direccion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direccion">
		<td class="col-sm-3"><span id="elh_supervisor_direccion"><?php echo $supervisor->direccion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $supervisor->direccion->CellAttributes() ?>>
<span id="el_supervisor_direccion">
<textarea data-table="supervisor" data-field="x_direccion" name="x_direccion" id="x_direccion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($supervisor->direccion->getPlaceHolder()) ?>"<?php echo $supervisor->direccion->EditAttributes() ?>><?php echo $supervisor->direccion->EditValue ?></textarea>
</span>
<?php echo $supervisor->direccion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->cargo->Visible) { // cargo ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_cargo" class="form-group">
		<label id="elh_supervisor_cargo" for="x_cargo" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->cargo->FldCaption() ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->cargo->CellAttributes() ?>>
<span id="el_supervisor_cargo">
<input type="text" data-table="supervisor" data-field="x_cargo" name="x_cargo" id="x_cargo" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->cargo->getPlaceHolder()) ?>" value="<?php echo $supervisor->cargo->EditValue ?>"<?php echo $supervisor->cargo->EditAttributes() ?>>
</span>
<?php echo $supervisor->cargo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cargo">
		<td class="col-sm-3"><span id="elh_supervisor_cargo"><?php echo $supervisor->cargo->FldCaption() ?></span></td>
		<td<?php echo $supervisor->cargo->CellAttributes() ?>>
<span id="el_supervisor_cargo">
<input type="text" data-table="supervisor" data-field="x_cargo" name="x_cargo" id="x_cargo" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->cargo->getPlaceHolder()) ?>" value="<?php echo $supervisor->cargo->EditValue ?>"<?php echo $supervisor->cargo->EditAttributes() ?>>
</span>
<?php echo $supervisor->cargo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->id_institucion->Visible) { // id_institucion ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_id_institucion" class="form-group">
		<label id="elh_supervisor_id_institucion" for="x_id_institucion" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->id_institucion->FldCaption() ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->id_institucion->CellAttributes() ?>>
<span id="el_supervisor_id_institucion">
<input type="text" data-table="supervisor" data-field="x_id_institucion" name="x_id_institucion" id="x_id_institucion" size="30" placeholder="<?php echo ew_HtmlEncode($supervisor->id_institucion->getPlaceHolder()) ?>" value="<?php echo $supervisor->id_institucion->EditValue ?>"<?php echo $supervisor->id_institucion->EditAttributes() ?>>
</span>
<?php echo $supervisor->id_institucion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_institucion">
		<td class="col-sm-3"><span id="elh_supervisor_id_institucion"><?php echo $supervisor->id_institucion->FldCaption() ?></span></td>
		<td<?php echo $supervisor->id_institucion->CellAttributes() ?>>
<span id="el_supervisor_id_institucion">
<input type="text" data-table="supervisor" data-field="x_id_institucion" name="x_id_institucion" id="x_id_institucion" size="30" placeholder="<?php echo ew_HtmlEncode($supervisor->id_institucion->getPlaceHolder()) ?>" value="<?php echo $supervisor->id_institucion->EditValue ?>"<?php echo $supervisor->id_institucion->EditAttributes() ?>>
</span>
<?php echo $supervisor->id_institucion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->especialidad->Visible) { // especialidad ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_especialidad" class="form-group">
		<label id="elh_supervisor_especialidad" for="x_especialidad" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->especialidad->FldCaption() ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->especialidad->CellAttributes() ?>>
<span id="el_supervisor_especialidad">
<input type="text" data-table="supervisor" data-field="x_especialidad" name="x_especialidad" id="x_especialidad" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->especialidad->getPlaceHolder()) ?>" value="<?php echo $supervisor->especialidad->EditValue ?>"<?php echo $supervisor->especialidad->EditAttributes() ?>>
</span>
<?php echo $supervisor->especialidad->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_especialidad">
		<td class="col-sm-3"><span id="elh_supervisor_especialidad"><?php echo $supervisor->especialidad->FldCaption() ?></span></td>
		<td<?php echo $supervisor->especialidad->CellAttributes() ?>>
<span id="el_supervisor_especialidad">
<input type="text" data-table="supervisor" data-field="x_especialidad" name="x_especialidad" id="x_especialidad" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($supervisor->especialidad->getPlaceHolder()) ?>" value="<?php echo $supervisor->especialidad->EditValue ?>"<?php echo $supervisor->especialidad->EditAttributes() ?>>
</span>
<?php echo $supervisor->especialidad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor->codigo->Visible) { // codigo ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
	<div id="r_codigo" class="form-group">
		<label id="elh_supervisor_codigo" for="x_codigo" class="<?php echo $supervisor_add->LeftColumnClass ?>"><?php echo $supervisor->codigo->FldCaption() ?></label>
		<div class="<?php echo $supervisor_add->RightColumnClass ?>"><div<?php echo $supervisor->codigo->CellAttributes() ?>>
<span id="el_supervisor_codigo">
<input type="text" data-table="supervisor" data-field="x_codigo" name="x_codigo" id="x_codigo" size="30" maxlength="5" placeholder="<?php echo ew_HtmlEncode($supervisor->codigo->getPlaceHolder()) ?>" value="<?php echo $supervisor->codigo->EditValue ?>"<?php echo $supervisor->codigo->EditAttributes() ?>>
</span>
<?php echo $supervisor->codigo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_codigo">
		<td class="col-sm-3"><span id="elh_supervisor_codigo"><?php echo $supervisor->codigo->FldCaption() ?></span></td>
		<td<?php echo $supervisor->codigo->CellAttributes() ?>>
<span id="el_supervisor_codigo">
<input type="text" data-table="supervisor" data-field="x_codigo" name="x_codigo" id="x_codigo" size="30" maxlength="5" placeholder="<?php echo ew_HtmlEncode($supervisor->codigo->getPlaceHolder()) ?>" value="<?php echo $supervisor->codigo->EditValue ?>"<?php echo $supervisor->codigo->EditAttributes() ?>>
</span>
<?php echo $supervisor->codigo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($supervisor_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$supervisor_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $supervisor_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $supervisor_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$supervisor_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fsupervisoradd.Init();
</script>
<?php
$supervisor_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$supervisor_add->Page_Terminate();
?>
