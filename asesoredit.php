<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "asesorinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$asesor_edit = NULL; // Initialize page object first

class casesor_edit extends casesor {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'asesor';

	// Page object name
	var $PageObjName = 'asesor_edit';

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

		// Table object (asesor)
		if (!isset($GLOBALS["asesor"]) || get_class($GLOBALS["asesor"]) == "casesor") {
			$GLOBALS["asesor"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["asesor"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'asesor', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("asesorlist.php"));
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
		$this->status->SetVisibility();
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
		global $EW_EXPORT, $asesor;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($asesor);
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
					if ($pageName == "asesorview.php")
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
			if ($objForm->HasValue("x__login")) {
				$this->_login->setFormValue($objForm->GetValue("x__login"));
			}
		} else {
			$this->CurrentAction = "I"; // Default action is display

			// Load key from QueryString
			$loadByQuery = FALSE;
			if (isset($_GET["_login"])) {
				$this->_login->setQueryStringValue($_GET["_login"]);
				$loadByQuery = TRUE;
			} else {
				$this->_login->CurrentValue = NULL;
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
					$this->Page_Terminate("asesorlist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "asesorlist.php")
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
		if (!$this->status->FldIsDetailKey) {
			$this->status->setFormValue($objForm->GetValue("x_status"));
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
		$this->status->CurrentValue = $this->status->FormValue;
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
		$this->codigo->setDbValue($row['codigo']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['nombre'] = NULL;
		$row['apellido'] = NULL;
		$row['login'] = NULL;
		$row['password'] = NULL;
		$row['ci'] = NULL;
		$row['id_rol'] = NULL;
		$row['id_sucursal'] = NULL;
		$row['email'] = NULL;
		$row['telefono_fijo01'] = NULL;
		$row['telefono_fijo02'] = NULL;
		$row['celular'] = NULL;
		$row['celular2'] = NULL;
		$row['direccion'] = NULL;
		$row['cargo'] = NULL;
		$row['id_institucion'] = NULL;
		$row['especialidad'] = NULL;
		$row['status'] = NULL;
		$row['codigo'] = NULL;
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
		$this->id_rol->ViewValue = $this->id_rol->CurrentValue;
		if (strval($this->id_rol->CurrentValue) <> "") {
			$sFilterWrk = "`userlevelid`" . ew_SearchString("=", $this->id_rol->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
				$sWhereWrk = "";
				$this->id_rol->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
				$sWhereWrk = "";
				$this->id_rol->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
				$sWhereWrk = "";
				$this->id_rol->LookupFilters = array();
				break;
		}
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
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
				$sWhereWrk = "";
				$this->id_sucursal->LookupFilters = array("dx1" => '`nombre`');
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
				$sWhereWrk = "";
				$this->id_sucursal->LookupFilters = array("dx1" => '`nombre`');
				break;
			default:
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
				$sWhereWrk = "";
				$this->id_sucursal->LookupFilters = array("dx1" => '`nombre`');
				break;
		}
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
		if (strval($this->status->CurrentValue) <> "") {
			$this->status->ViewValue = $this->status->OptionCaption($this->status->CurrentValue);
		} else {
			$this->status->ViewValue = NULL;
		}
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

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";

			// codigo
			$this->codigo->LinkCustomAttributes = "";
			$this->codigo->HrefValue = "";
			$this->codigo->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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
			$this->_login->EditValue = $this->_login->CurrentValue;
			$this->_login->ViewCustomAttributes = "";

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
			$this->id_rol->EditValue = $this->id_rol->CurrentValue;
			if (strval($this->id_rol->CurrentValue) <> "") {
				$sFilterWrk = "`userlevelid`" . ew_SearchString("=", $this->id_rol->CurrentValue, EW_DATATYPE_NUMBER, "");
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
					$sWhereWrk = "";
					$this->id_rol->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
					$sWhereWrk = "";
					$this->id_rol->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
					$sWhereWrk = "";
					$this->id_rol->LookupFilters = array();
					break;
			}
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
			$this->id_sucursal->EditCustomAttributes = "";
			if (trim(strval($this->id_sucursal->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_sucursal->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `sucursal`";
					$sWhereWrk = "";
					$this->id_sucursal->LookupFilters = array("dx1" => '`nombre`');
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `sucursal`";
					$sWhereWrk = "";
					$this->id_sucursal->LookupFilters = array("dx1" => '`nombre`');
					break;
				default:
					$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `sucursal`";
					$sWhereWrk = "";
					$this->id_sucursal->LookupFilters = array("dx1" => '`nombre`');
					break;
			}
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

			// status
			$this->status->EditCustomAttributes = "";
			$this->status->EditValue = $this->status->Options(FALSE);

			// codigo
			$this->codigo->EditAttrs["class"] = "form-control";
			$this->codigo->EditCustomAttributes = "";
			$this->codigo->EditValue = ew_HtmlEncode($this->codigo->CurrentValue);
			$this->codigo->PlaceHolder = ew_RemoveHtml($this->codigo->FldTitle());

			// Edit refer script
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
			$this->id_rol->TooltipValue = "";

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

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

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

			// nombre
			$this->nombre->SetDbValueDef($rsnew, $this->nombre->CurrentValue, "", $this->nombre->ReadOnly);

			// apellido
			$this->apellido->SetDbValueDef($rsnew, $this->apellido->CurrentValue, "", $this->apellido->ReadOnly);

			// login
			// password

			$this->password->SetDbValueDef($rsnew, $this->password->CurrentValue, "", $this->password->ReadOnly);

			// ci
			$this->ci->SetDbValueDef($rsnew, $this->ci->CurrentValue, "", $this->ci->ReadOnly);

			// id_sucursal
			$this->id_sucursal->SetDbValueDef($rsnew, $this->id_sucursal->CurrentValue, 0, $this->id_sucursal->ReadOnly);

			// email
			$this->_email->SetDbValueDef($rsnew, $this->_email->CurrentValue, NULL, $this->_email->ReadOnly);

			// telefono_fijo01
			$this->telefono_fijo01->SetDbValueDef($rsnew, $this->telefono_fijo01->CurrentValue, NULL, $this->telefono_fijo01->ReadOnly);

			// telefono_fijo02
			$this->telefono_fijo02->SetDbValueDef($rsnew, $this->telefono_fijo02->CurrentValue, NULL, $this->telefono_fijo02->ReadOnly);

			// celular
			$this->celular->SetDbValueDef($rsnew, $this->celular->CurrentValue, NULL, $this->celular->ReadOnly);

			// celular2
			$this->celular2->SetDbValueDef($rsnew, $this->celular2->CurrentValue, NULL, $this->celular2->ReadOnly);

			// direccion
			$this->direccion->SetDbValueDef($rsnew, $this->direccion->CurrentValue, "", $this->direccion->ReadOnly);

			// cargo
			$this->cargo->SetDbValueDef($rsnew, $this->cargo->CurrentValue, NULL, $this->cargo->ReadOnly);

			// id_institucion
			$this->id_institucion->SetDbValueDef($rsnew, $this->id_institucion->CurrentValue, NULL, $this->id_institucion->ReadOnly);

			// especialidad
			$this->especialidad->SetDbValueDef($rsnew, $this->especialidad->CurrentValue, NULL, $this->especialidad->ReadOnly);

			// status
			$this->status->SetDbValueDef($rsnew, $this->status->CurrentValue, NULL, $this->status->ReadOnly);

			// codigo
			$this->codigo->SetDbValueDef($rsnew, $this->codigo->CurrentValue, NULL, $this->codigo->ReadOnly);

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
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("asesorlist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_id_sucursal":
			$sSqlWrk = "";
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
					$sWhereWrk = "{filter}";
					$fld->LookupFilters = array("dx1" => '`nombre`');
					break;
				case "es":
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
					$sWhereWrk = "{filter}";
					$fld->LookupFilters = array("dx1" => '`nombre`');
					break;
				default:
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
					$sWhereWrk = "{filter}";
					$fld->LookupFilters = array("dx1" => '`nombre`');
					break;
			}
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
if (!isset($asesor_edit)) $asesor_edit = new casesor_edit();

// Page init
$asesor_edit->Page_Init();

// Page main
$asesor_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$asesor_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fasesoredit = new ew_Form("fasesoredit", "edit");

// Validate form
fasesoredit.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $asesor->nombre->FldCaption(), $asesor->nombre->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_apellido");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $asesor->apellido->FldCaption(), $asesor->apellido->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "__login");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $asesor->_login->FldCaption(), $asesor->_login->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "__login");
			if (elm && !ew_CheckEmail(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($asesor->_login->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_password");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $asesor->password->FldCaption(), $asesor->password->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ci");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $asesor->ci->FldCaption(), $asesor->ci->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_id_sucursal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $asesor->id_sucursal->FldCaption(), $asesor->id_sucursal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "__email");
			if (elm && !ew_CheckEmail(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($asesor->_email->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_direccion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $asesor->direccion->FldCaption(), $asesor->direccion->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_id_institucion");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($asesor->id_institucion->FldErrMsg()) ?>");

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
fasesoredit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fasesoredit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fasesoredit.Lists["x_id_rol"] = {"LinkField":"x_userlevelid","Ajax":true,"AutoFill":false,"DisplayFields":["x_userlevelname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"userlevels"};
fasesoredit.Lists["x_id_rol"].Data = "<?php echo $asesor_edit->id_rol->LookupFilterQuery(FALSE, "edit") ?>";
fasesoredit.AutoSuggests["x_id_rol"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $asesor_edit->id_rol->LookupFilterQuery(TRUE, "edit"))) ?>;
fasesoredit.Lists["x_id_sucursal"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"sucursal"};
fasesoredit.Lists["x_id_sucursal"].Data = "<?php echo $asesor_edit->id_sucursal->LookupFilterQuery(FALSE, "edit") ?>";
fasesoredit.Lists["x_status"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fasesoredit.Lists["x_status"].Options = <?php echo json_encode($asesor_edit->status->Options()) ?>;

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $asesor_edit->ShowPageHeader(); ?>
<?php
$asesor_edit->ShowMessage();
?>
<form name="fasesoredit" id="fasesoredit" class="<?php echo $asesor_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($asesor_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $asesor_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="asesor">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($asesor_edit->IsModal) ?>">
<?php if (!$asesor_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_asesoredit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($asesor->nombre->Visible) { // nombre ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_nombre" class="form-group">
		<label id="elh_asesor_nombre" for="x_nombre" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->nombre->CellAttributes() ?>>
<span id="el_asesor_nombre">
<input type="text" data-table="asesor" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->nombre->getPlaceHolder()) ?>" value="<?php echo $asesor->nombre->EditValue ?>"<?php echo $asesor->nombre->EditAttributes() ?>>
</span>
<?php echo $asesor->nombre->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_nombre">
		<td class="col-sm-3"><span id="elh_asesor_nombre"><?php echo $asesor->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $asesor->nombre->CellAttributes() ?>>
<span id="el_asesor_nombre">
<input type="text" data-table="asesor" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->nombre->getPlaceHolder()) ?>" value="<?php echo $asesor->nombre->EditValue ?>"<?php echo $asesor->nombre->EditAttributes() ?>>
</span>
<?php echo $asesor->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->apellido->Visible) { // apellido ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_apellido" class="form-group">
		<label id="elh_asesor_apellido" for="x_apellido" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->apellido->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->apellido->CellAttributes() ?>>
<span id="el_asesor_apellido">
<input type="text" data-table="asesor" data-field="x_apellido" name="x_apellido" id="x_apellido" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($asesor->apellido->getPlaceHolder()) ?>" value="<?php echo $asesor->apellido->EditValue ?>"<?php echo $asesor->apellido->EditAttributes() ?>>
</span>
<?php echo $asesor->apellido->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_apellido">
		<td class="col-sm-3"><span id="elh_asesor_apellido"><?php echo $asesor->apellido->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $asesor->apellido->CellAttributes() ?>>
<span id="el_asesor_apellido">
<input type="text" data-table="asesor" data-field="x_apellido" name="x_apellido" id="x_apellido" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($asesor->apellido->getPlaceHolder()) ?>" value="<?php echo $asesor->apellido->EditValue ?>"<?php echo $asesor->apellido->EditAttributes() ?>>
</span>
<?php echo $asesor->apellido->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->_login->Visible) { // login ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r__login" class="form-group">
		<label id="elh_asesor__login" for="x__login" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->_login->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->_login->CellAttributes() ?>>
<span id="el_asesor__login">
<span<?php echo $asesor->_login->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $asesor->_login->EditValue ?></p></span>
</span>
<input type="hidden" data-table="asesor" data-field="x__login" name="x__login" id="x__login" value="<?php echo ew_HtmlEncode($asesor->_login->CurrentValue) ?>">
<?php echo $asesor->_login->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__login">
		<td class="col-sm-3"><span id="elh_asesor__login"><?php echo $asesor->_login->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $asesor->_login->CellAttributes() ?>>
<span id="el_asesor__login">
<span<?php echo $asesor->_login->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $asesor->_login->EditValue ?></p></span>
</span>
<input type="hidden" data-table="asesor" data-field="x__login" name="x__login" id="x__login" value="<?php echo ew_HtmlEncode($asesor->_login->CurrentValue) ?>">
<?php echo $asesor->_login->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->password->Visible) { // password ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_password" class="form-group">
		<label id="elh_asesor_password" for="x_password" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->password->CellAttributes() ?>>
<span id="el_asesor_password">
<div class="input-group" id="ig_password">
<input type="password" data-password-generated="pgt_password" data-table="asesor" data-field="x_password" name="x_password" id="x_password" value="<?php echo $asesor->password->EditValue ?>" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($asesor->password->getPlaceHolder()) ?>"<?php echo $asesor->password->EditAttributes() ?>>
<span class="input-group-btn">
	<button type="button" class="btn btn-default ewPasswordGenerator" title="<?php echo ew_HtmlTitle($Language->Phrase("GeneratePassword")) ?>" data-password-field="x_password" data-password-confirm="c_password" data-password-generated="pgt_password"><?php echo $Language->Phrase("GeneratePassword") ?></button>
</span>
</div>
<span class="help-block" id="pgt_password" style="display: none;"></span>
</span>
<?php echo $asesor->password->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_password">
		<td class="col-sm-3"><span id="elh_asesor_password"><?php echo $asesor->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $asesor->password->CellAttributes() ?>>
<span id="el_asesor_password">
<div class="input-group" id="ig_password">
<input type="password" data-password-generated="pgt_password" data-table="asesor" data-field="x_password" name="x_password" id="x_password" value="<?php echo $asesor->password->EditValue ?>" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($asesor->password->getPlaceHolder()) ?>"<?php echo $asesor->password->EditAttributes() ?>>
<span class="input-group-btn">
	<button type="button" class="btn btn-default ewPasswordGenerator" title="<?php echo ew_HtmlTitle($Language->Phrase("GeneratePassword")) ?>" data-password-field="x_password" data-password-confirm="c_password" data-password-generated="pgt_password"><?php echo $Language->Phrase("GeneratePassword") ?></button>
</span>
</div>
<span class="help-block" id="pgt_password" style="display: none;"></span>
</span>
<?php echo $asesor->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->ci->Visible) { // ci ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_ci" class="form-group">
		<label id="elh_asesor_ci" for="x_ci" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->ci->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->ci->CellAttributes() ?>>
<span id="el_asesor_ci">
<input type="text" data-table="asesor" data-field="x_ci" name="x_ci" id="x_ci" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($asesor->ci->getPlaceHolder()) ?>" value="<?php echo $asesor->ci->EditValue ?>"<?php echo $asesor->ci->EditAttributes() ?>>
</span>
<?php echo $asesor->ci->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ci">
		<td class="col-sm-3"><span id="elh_asesor_ci"><?php echo $asesor->ci->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $asesor->ci->CellAttributes() ?>>
<span id="el_asesor_ci">
<input type="text" data-table="asesor" data-field="x_ci" name="x_ci" id="x_ci" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($asesor->ci->getPlaceHolder()) ?>" value="<?php echo $asesor->ci->EditValue ?>"<?php echo $asesor->ci->EditAttributes() ?>>
</span>
<?php echo $asesor->ci->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->id_rol->Visible) { // id_rol ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_id_rol" class="form-group">
		<label id="elh_asesor_id_rol" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->id_rol->FldCaption() ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->id_rol->CellAttributes() ?>>
<span id="el_asesor_id_rol">
<span<?php echo $asesor->id_rol->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $asesor->id_rol->EditValue ?></p></span>
</span>
<input type="hidden" data-table="asesor" data-field="x_id_rol" name="x_id_rol" id="x_id_rol" value="<?php echo ew_HtmlEncode($asesor->id_rol->CurrentValue) ?>">
<?php echo $asesor->id_rol->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_rol">
		<td class="col-sm-3"><span id="elh_asesor_id_rol"><?php echo $asesor->id_rol->FldCaption() ?></span></td>
		<td<?php echo $asesor->id_rol->CellAttributes() ?>>
<span id="el_asesor_id_rol">
<span<?php echo $asesor->id_rol->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $asesor->id_rol->EditValue ?></p></span>
</span>
<input type="hidden" data-table="asesor" data-field="x_id_rol" name="x_id_rol" id="x_id_rol" value="<?php echo ew_HtmlEncode($asesor->id_rol->CurrentValue) ?>">
<?php echo $asesor->id_rol->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->id_sucursal->Visible) { // id_sucursal ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_id_sucursal" class="form-group">
		<label id="elh_asesor_id_sucursal" for="x_id_sucursal" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->id_sucursal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->id_sucursal->CellAttributes() ?>>
<span id="el_asesor_id_sucursal">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_id_sucursal"><?php echo (strval($asesor->id_sucursal->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $asesor->id_sucursal->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($asesor->id_sucursal->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_id_sucursal',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($asesor->id_sucursal->ReadOnly || $asesor->id_sucursal->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="asesor" data-field="x_id_sucursal" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $asesor->id_sucursal->DisplayValueSeparatorAttribute() ?>" name="x_id_sucursal" id="x_id_sucursal" value="<?php echo $asesor->id_sucursal->CurrentValue ?>"<?php echo $asesor->id_sucursal->EditAttributes() ?>>
</span>
<?php echo $asesor->id_sucursal->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_sucursal">
		<td class="col-sm-3"><span id="elh_asesor_id_sucursal"><?php echo $asesor->id_sucursal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $asesor->id_sucursal->CellAttributes() ?>>
<span id="el_asesor_id_sucursal">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_id_sucursal"><?php echo (strval($asesor->id_sucursal->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $asesor->id_sucursal->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($asesor->id_sucursal->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_id_sucursal',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($asesor->id_sucursal->ReadOnly || $asesor->id_sucursal->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="asesor" data-field="x_id_sucursal" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $asesor->id_sucursal->DisplayValueSeparatorAttribute() ?>" name="x_id_sucursal" id="x_id_sucursal" value="<?php echo $asesor->id_sucursal->CurrentValue ?>"<?php echo $asesor->id_sucursal->EditAttributes() ?>>
</span>
<?php echo $asesor->id_sucursal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->_email->Visible) { // email ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r__email" class="form-group">
		<label id="elh_asesor__email" for="x__email" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->_email->FldCaption() ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->_email->CellAttributes() ?>>
<span id="el_asesor__email">
<input type="text" data-table="asesor" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($asesor->_email->getPlaceHolder()) ?>" value="<?php echo $asesor->_email->EditValue ?>"<?php echo $asesor->_email->EditAttributes() ?>>
</span>
<?php echo $asesor->_email->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__email">
		<td class="col-sm-3"><span id="elh_asesor__email"><?php echo $asesor->_email->FldCaption() ?></span></td>
		<td<?php echo $asesor->_email->CellAttributes() ?>>
<span id="el_asesor__email">
<input type="text" data-table="asesor" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($asesor->_email->getPlaceHolder()) ?>" value="<?php echo $asesor->_email->EditValue ?>"<?php echo $asesor->_email->EditAttributes() ?>>
</span>
<?php echo $asesor->_email->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->telefono_fijo01->Visible) { // telefono_fijo01 ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_telefono_fijo01" class="form-group">
		<label id="elh_asesor_telefono_fijo01" for="x_telefono_fijo01" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->telefono_fijo01->FldCaption() ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->telefono_fijo01->CellAttributes() ?>>
<span id="el_asesor_telefono_fijo01">
<input type="text" data-table="asesor" data-field="x_telefono_fijo01" name="x_telefono_fijo01" id="x_telefono_fijo01" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->telefono_fijo01->getPlaceHolder()) ?>" value="<?php echo $asesor->telefono_fijo01->EditValue ?>"<?php echo $asesor->telefono_fijo01->EditAttributes() ?>>
</span>
<?php echo $asesor->telefono_fijo01->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_telefono_fijo01">
		<td class="col-sm-3"><span id="elh_asesor_telefono_fijo01"><?php echo $asesor->telefono_fijo01->FldCaption() ?></span></td>
		<td<?php echo $asesor->telefono_fijo01->CellAttributes() ?>>
<span id="el_asesor_telefono_fijo01">
<input type="text" data-table="asesor" data-field="x_telefono_fijo01" name="x_telefono_fijo01" id="x_telefono_fijo01" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->telefono_fijo01->getPlaceHolder()) ?>" value="<?php echo $asesor->telefono_fijo01->EditValue ?>"<?php echo $asesor->telefono_fijo01->EditAttributes() ?>>
</span>
<?php echo $asesor->telefono_fijo01->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->telefono_fijo02->Visible) { // telefono_fijo02 ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_telefono_fijo02" class="form-group">
		<label id="elh_asesor_telefono_fijo02" for="x_telefono_fijo02" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->telefono_fijo02->FldCaption() ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->telefono_fijo02->CellAttributes() ?>>
<span id="el_asesor_telefono_fijo02">
<input type="text" data-table="asesor" data-field="x_telefono_fijo02" name="x_telefono_fijo02" id="x_telefono_fijo02" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->telefono_fijo02->getPlaceHolder()) ?>" value="<?php echo $asesor->telefono_fijo02->EditValue ?>"<?php echo $asesor->telefono_fijo02->EditAttributes() ?>>
</span>
<?php echo $asesor->telefono_fijo02->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_telefono_fijo02">
		<td class="col-sm-3"><span id="elh_asesor_telefono_fijo02"><?php echo $asesor->telefono_fijo02->FldCaption() ?></span></td>
		<td<?php echo $asesor->telefono_fijo02->CellAttributes() ?>>
<span id="el_asesor_telefono_fijo02">
<input type="text" data-table="asesor" data-field="x_telefono_fijo02" name="x_telefono_fijo02" id="x_telefono_fijo02" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->telefono_fijo02->getPlaceHolder()) ?>" value="<?php echo $asesor->telefono_fijo02->EditValue ?>"<?php echo $asesor->telefono_fijo02->EditAttributes() ?>>
</span>
<?php echo $asesor->telefono_fijo02->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->celular->Visible) { // celular ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_celular" class="form-group">
		<label id="elh_asesor_celular" for="x_celular" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->celular->FldCaption() ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->celular->CellAttributes() ?>>
<span id="el_asesor_celular">
<input type="text" data-table="asesor" data-field="x_celular" name="x_celular" id="x_celular" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->celular->getPlaceHolder()) ?>" value="<?php echo $asesor->celular->EditValue ?>"<?php echo $asesor->celular->EditAttributes() ?>>
</span>
<?php echo $asesor->celular->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_celular">
		<td class="col-sm-3"><span id="elh_asesor_celular"><?php echo $asesor->celular->FldCaption() ?></span></td>
		<td<?php echo $asesor->celular->CellAttributes() ?>>
<span id="el_asesor_celular">
<input type="text" data-table="asesor" data-field="x_celular" name="x_celular" id="x_celular" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->celular->getPlaceHolder()) ?>" value="<?php echo $asesor->celular->EditValue ?>"<?php echo $asesor->celular->EditAttributes() ?>>
</span>
<?php echo $asesor->celular->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->celular2->Visible) { // celular2 ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_celular2" class="form-group">
		<label id="elh_asesor_celular2" for="x_celular2" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->celular2->FldCaption() ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->celular2->CellAttributes() ?>>
<span id="el_asesor_celular2">
<input type="text" data-table="asesor" data-field="x_celular2" name="x_celular2" id="x_celular2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->celular2->getPlaceHolder()) ?>" value="<?php echo $asesor->celular2->EditValue ?>"<?php echo $asesor->celular2->EditAttributes() ?>>
</span>
<?php echo $asesor->celular2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_celular2">
		<td class="col-sm-3"><span id="elh_asesor_celular2"><?php echo $asesor->celular2->FldCaption() ?></span></td>
		<td<?php echo $asesor->celular2->CellAttributes() ?>>
<span id="el_asesor_celular2">
<input type="text" data-table="asesor" data-field="x_celular2" name="x_celular2" id="x_celular2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->celular2->getPlaceHolder()) ?>" value="<?php echo $asesor->celular2->EditValue ?>"<?php echo $asesor->celular2->EditAttributes() ?>>
</span>
<?php echo $asesor->celular2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->direccion->Visible) { // direccion ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_direccion" class="form-group">
		<label id="elh_asesor_direccion" for="x_direccion" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->direccion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->direccion->CellAttributes() ?>>
<span id="el_asesor_direccion">
<textarea data-table="asesor" data-field="x_direccion" name="x_direccion" id="x_direccion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($asesor->direccion->getPlaceHolder()) ?>"<?php echo $asesor->direccion->EditAttributes() ?>><?php echo $asesor->direccion->EditValue ?></textarea>
</span>
<?php echo $asesor->direccion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direccion">
		<td class="col-sm-3"><span id="elh_asesor_direccion"><?php echo $asesor->direccion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $asesor->direccion->CellAttributes() ?>>
<span id="el_asesor_direccion">
<textarea data-table="asesor" data-field="x_direccion" name="x_direccion" id="x_direccion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($asesor->direccion->getPlaceHolder()) ?>"<?php echo $asesor->direccion->EditAttributes() ?>><?php echo $asesor->direccion->EditValue ?></textarea>
</span>
<?php echo $asesor->direccion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->cargo->Visible) { // cargo ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_cargo" class="form-group">
		<label id="elh_asesor_cargo" for="x_cargo" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->cargo->FldCaption() ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->cargo->CellAttributes() ?>>
<span id="el_asesor_cargo">
<input type="text" data-table="asesor" data-field="x_cargo" name="x_cargo" id="x_cargo" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->cargo->getPlaceHolder()) ?>" value="<?php echo $asesor->cargo->EditValue ?>"<?php echo $asesor->cargo->EditAttributes() ?>>
</span>
<?php echo $asesor->cargo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cargo">
		<td class="col-sm-3"><span id="elh_asesor_cargo"><?php echo $asesor->cargo->FldCaption() ?></span></td>
		<td<?php echo $asesor->cargo->CellAttributes() ?>>
<span id="el_asesor_cargo">
<input type="text" data-table="asesor" data-field="x_cargo" name="x_cargo" id="x_cargo" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->cargo->getPlaceHolder()) ?>" value="<?php echo $asesor->cargo->EditValue ?>"<?php echo $asesor->cargo->EditAttributes() ?>>
</span>
<?php echo $asesor->cargo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->id_institucion->Visible) { // id_institucion ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_id_institucion" class="form-group">
		<label id="elh_asesor_id_institucion" for="x_id_institucion" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->id_institucion->FldCaption() ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->id_institucion->CellAttributes() ?>>
<span id="el_asesor_id_institucion">
<input type="text" data-table="asesor" data-field="x_id_institucion" name="x_id_institucion" id="x_id_institucion" size="30" placeholder="<?php echo ew_HtmlEncode($asesor->id_institucion->getPlaceHolder()) ?>" value="<?php echo $asesor->id_institucion->EditValue ?>"<?php echo $asesor->id_institucion->EditAttributes() ?>>
</span>
<?php echo $asesor->id_institucion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_institucion">
		<td class="col-sm-3"><span id="elh_asesor_id_institucion"><?php echo $asesor->id_institucion->FldCaption() ?></span></td>
		<td<?php echo $asesor->id_institucion->CellAttributes() ?>>
<span id="el_asesor_id_institucion">
<input type="text" data-table="asesor" data-field="x_id_institucion" name="x_id_institucion" id="x_id_institucion" size="30" placeholder="<?php echo ew_HtmlEncode($asesor->id_institucion->getPlaceHolder()) ?>" value="<?php echo $asesor->id_institucion->EditValue ?>"<?php echo $asesor->id_institucion->EditAttributes() ?>>
</span>
<?php echo $asesor->id_institucion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->especialidad->Visible) { // especialidad ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_especialidad" class="form-group">
		<label id="elh_asesor_especialidad" for="x_especialidad" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->especialidad->FldCaption() ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->especialidad->CellAttributes() ?>>
<span id="el_asesor_especialidad">
<input type="text" data-table="asesor" data-field="x_especialidad" name="x_especialidad" id="x_especialidad" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->especialidad->getPlaceHolder()) ?>" value="<?php echo $asesor->especialidad->EditValue ?>"<?php echo $asesor->especialidad->EditAttributes() ?>>
</span>
<?php echo $asesor->especialidad->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_especialidad">
		<td class="col-sm-3"><span id="elh_asesor_especialidad"><?php echo $asesor->especialidad->FldCaption() ?></span></td>
		<td<?php echo $asesor->especialidad->CellAttributes() ?>>
<span id="el_asesor_especialidad">
<input type="text" data-table="asesor" data-field="x_especialidad" name="x_especialidad" id="x_especialidad" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($asesor->especialidad->getPlaceHolder()) ?>" value="<?php echo $asesor->especialidad->EditValue ?>"<?php echo $asesor->especialidad->EditAttributes() ?>>
</span>
<?php echo $asesor->especialidad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->status->Visible) { // status ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_status" class="form-group">
		<label id="elh_asesor_status" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->status->FldCaption() ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->status->CellAttributes() ?>>
<span id="el_asesor_status">
<div id="tp_x_status" class="ewTemplate"><input type="radio" data-table="asesor" data-field="x_status" data-value-separator="<?php echo $asesor->status->DisplayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $asesor->status->EditAttributes() ?>></div>
<div id="dsl_x_status" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $asesor->status->RadioButtonListHtml(FALSE, "x_status") ?>
</div></div>
</span>
<?php echo $asesor->status->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_status">
		<td class="col-sm-3"><span id="elh_asesor_status"><?php echo $asesor->status->FldCaption() ?></span></td>
		<td<?php echo $asesor->status->CellAttributes() ?>>
<span id="el_asesor_status">
<div id="tp_x_status" class="ewTemplate"><input type="radio" data-table="asesor" data-field="x_status" data-value-separator="<?php echo $asesor->status->DisplayValueSeparatorAttribute() ?>" name="x_status" id="x_status" value="{value}"<?php echo $asesor->status->EditAttributes() ?>></div>
<div id="dsl_x_status" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $asesor->status->RadioButtonListHtml(FALSE, "x_status") ?>
</div></div>
</span>
<?php echo $asesor->status->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor->codigo->Visible) { // codigo ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
	<div id="r_codigo" class="form-group">
		<label id="elh_asesor_codigo" for="x_codigo" class="<?php echo $asesor_edit->LeftColumnClass ?>"><?php echo $asesor->codigo->FldCaption() ?></label>
		<div class="<?php echo $asesor_edit->RightColumnClass ?>"><div<?php echo $asesor->codigo->CellAttributes() ?>>
<span id="el_asesor_codigo">
<input type="text" data-table="asesor" data-field="x_codigo" name="x_codigo" id="x_codigo" size="30" maxlength="5" placeholder="<?php echo ew_HtmlEncode($asesor->codigo->getPlaceHolder()) ?>" value="<?php echo $asesor->codigo->EditValue ?>"<?php echo $asesor->codigo->EditAttributes() ?>>
</span>
<?php echo $asesor->codigo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_codigo">
		<td class="col-sm-3"><span id="elh_asesor_codigo"><?php echo $asesor->codigo->FldCaption() ?></span></td>
		<td<?php echo $asesor->codigo->CellAttributes() ?>>
<span id="el_asesor_codigo">
<input type="text" data-table="asesor" data-field="x_codigo" name="x_codigo" id="x_codigo" size="30" maxlength="5" placeholder="<?php echo ew_HtmlEncode($asesor->codigo->getPlaceHolder()) ?>" value="<?php echo $asesor->codigo->EditValue ?>"<?php echo $asesor->codigo->EditAttributes() ?>>
</span>
<?php echo $asesor->codigo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($asesor_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$asesor_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $asesor_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $asesor_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$asesor_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fasesoredit.Init();
</script>
<?php
$asesor_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$asesor_edit->Page_Terminate();
?>
