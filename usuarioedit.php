<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$usuario_edit = NULL; // Initialize page object first

class cusuario_edit extends cusuario {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'usuario';

	// Page object name
	var $PageObjName = 'usuario_edit';

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

		// Table object (usuario)
		if (!isset($GLOBALS["usuario"]) || get_class($GLOBALS["usuario"]) == "cusuario") {
			$GLOBALS["usuario"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["usuario"];
		}

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'usuario', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("usuariolist.php"));
			else
				$this->Page_Terminate(ew_GetUrl("login.php"));
		}
		if ($Security->IsLoggedIn()) {
			$Security->UserID_Loading();
			$Security->LoadUserID();
			$Security->UserID_Loaded();
			if (strval($Security->CurrentUserID()) == "") {
				$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
				$this->Page_Terminate(ew_GetUrl("usuariolist.php"));
			}
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
		$this->status->SetVisibility();
		$this->id_sucursal->SetVisibility();
		$this->_email->SetVisibility();
		$this->telefono_fijo01->SetVisibility();
		$this->telefono_fijo02->SetVisibility();
		$this->celular->SetVisibility();
		$this->cargo->SetVisibility();
		$this->id_institucion->SetVisibility();
		$this->celular2->SetVisibility();
		$this->direccion->SetVisibility();
		$this->especialidad->SetVisibility();
		$this->avatar->SetVisibility();
		$this->created_at->SetVisibility();
		$this->color->SetVisibility();

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
		global $EW_EXPORT, $usuario;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($usuario);
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
					if ($pageName == "usuarioview.php")
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
					$this->Page_Terminate("usuariolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "usuariolist.php")
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
		$this->avatar->Upload->Index = $objForm->Index;
		$this->avatar->Upload->UploadFile();
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
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
		if (!$this->status->FldIsDetailKey) {
			$this->status->setFormValue($objForm->GetValue("x_status"));
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
		if (!$this->cargo->FldIsDetailKey) {
			$this->cargo->setFormValue($objForm->GetValue("x_cargo"));
		}
		if (!$this->id_institucion->FldIsDetailKey) {
			$this->id_institucion->setFormValue($objForm->GetValue("x_id_institucion"));
		}
		if (!$this->celular2->FldIsDetailKey) {
			$this->celular2->setFormValue($objForm->GetValue("x_celular2"));
		}
		if (!$this->direccion->FldIsDetailKey) {
			$this->direccion->setFormValue($objForm->GetValue("x_direccion"));
		}
		if (!$this->especialidad->FldIsDetailKey) {
			$this->especialidad->setFormValue($objForm->GetValue("x_especialidad"));
		}
		if (!$this->created_at->FldIsDetailKey) {
			$this->created_at->setFormValue($objForm->GetValue("x_created_at"));
			$this->created_at->CurrentValue = ew_UnFormatDateTime($this->created_at->CurrentValue, 0);
		}
		if (!$this->color->FldIsDetailKey) {
			$this->color->setFormValue($objForm->GetValue("x_color"));
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
		$this->status->CurrentValue = $this->status->FormValue;
		$this->id_sucursal->CurrentValue = $this->id_sucursal->FormValue;
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->telefono_fijo01->CurrentValue = $this->telefono_fijo01->FormValue;
		$this->telefono_fijo02->CurrentValue = $this->telefono_fijo02->FormValue;
		$this->celular->CurrentValue = $this->celular->FormValue;
		$this->cargo->CurrentValue = $this->cargo->FormValue;
		$this->id_institucion->CurrentValue = $this->id_institucion->FormValue;
		$this->celular2->CurrentValue = $this->celular2->FormValue;
		$this->direccion->CurrentValue = $this->direccion->FormValue;
		$this->especialidad->CurrentValue = $this->especialidad->FormValue;
		$this->created_at->CurrentValue = $this->created_at->FormValue;
		$this->created_at->CurrentValue = ew_UnFormatDateTime($this->created_at->CurrentValue, 0);
		$this->color->CurrentValue = $this->color->FormValue;
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

		// Check if valid user id
		if ($res) {
			$res = $this->ShowOptionLink('edit');
			if (!$res) {
				$sUserIdMsg = ew_DeniedMsg();
				$this->setFailureMessage($sUserIdMsg);
			}
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
		$this->status->setDbValue($row['status']);
		$this->id_sucursal->setDbValue($row['id_sucursal']);
		$this->_email->setDbValue($row['email']);
		$this->telefono_fijo01->setDbValue($row['telefono_fijo01']);
		$this->telefono_fijo02->setDbValue($row['telefono_fijo02']);
		$this->celular->setDbValue($row['celular']);
		$this->cargo->setDbValue($row['cargo']);
		$this->id_institucion->setDbValue($row['id_institucion']);
		$this->celular2->setDbValue($row['celular2']);
		$this->direccion->setDbValue($row['direccion']);
		$this->especialidad->setDbValue($row['especialidad']);
		$this->avatar->Upload->DbValue = $row['avatar'];
		if (is_array($this->avatar->Upload->DbValue) || is_object($this->avatar->Upload->DbValue)) // Byte array
			$this->avatar->Upload->DbValue = ew_BytesToStr($this->avatar->Upload->DbValue);
		$this->created_at->setDbValue($row['created_at']);
		$this->color->setDbValue($row['color']);
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
		$row['status'] = NULL;
		$row['id_sucursal'] = NULL;
		$row['email'] = NULL;
		$row['telefono_fijo01'] = NULL;
		$row['telefono_fijo02'] = NULL;
		$row['celular'] = NULL;
		$row['cargo'] = NULL;
		$row['id_institucion'] = NULL;
		$row['celular2'] = NULL;
		$row['direccion'] = NULL;
		$row['especialidad'] = NULL;
		$row['avatar'] = NULL;
		$row['created_at'] = NULL;
		$row['color'] = NULL;
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
		$this->status->DbValue = $row['status'];
		$this->id_sucursal->DbValue = $row['id_sucursal'];
		$this->_email->DbValue = $row['email'];
		$this->telefono_fijo01->DbValue = $row['telefono_fijo01'];
		$this->telefono_fijo02->DbValue = $row['telefono_fijo02'];
		$this->celular->DbValue = $row['celular'];
		$this->cargo->DbValue = $row['cargo'];
		$this->id_institucion->DbValue = $row['id_institucion'];
		$this->celular2->DbValue = $row['celular2'];
		$this->direccion->DbValue = $row['direccion'];
		$this->especialidad->DbValue = $row['especialidad'];
		$this->avatar->Upload->DbValue = $row['avatar'];
		$this->created_at->DbValue = $row['created_at'];
		$this->color->DbValue = $row['color'];
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
		// status
		// id_sucursal
		// email
		// telefono_fijo01
		// telefono_fijo02
		// celular
		// cargo
		// id_institucion
		// celular2
		// direccion
		// especialidad
		// avatar
		// created_at
		// color

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
		if ($Security->CanAdmin()) { // System admin
		if (strval($this->id_rol->CurrentValue) <> "") {
			$sFilterWrk = "`userlevelid`" . ew_SearchString("=", $this->id_rol->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
		$sWhereWrk = "";
		$this->id_rol->LookupFilters = array("dx1" => '`userlevelname`');
		$lookuptblfilter = "`userlevelid`='1'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
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
		} else {
			$this->id_rol->ViewValue = $Language->Phrase("PasswordMask");
		}
		$this->id_rol->ViewCustomAttributes = "";

		// status
		$this->status->ViewValue = $this->status->CurrentValue;
		$this->status->ViewCustomAttributes = "";

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

		// cargo
		$this->cargo->ViewValue = $this->cargo->CurrentValue;
		$this->cargo->ViewCustomAttributes = "";

		// id_institucion
		if (strval($this->id_institucion->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_institucion->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `banco`";
		$sWhereWrk = "";
		$this->id_institucion->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_institucion, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_institucion->ViewValue = $this->id_institucion->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_institucion->ViewValue = $this->id_institucion->CurrentValue;
			}
		} else {
			$this->id_institucion->ViewValue = NULL;
		}
		$this->id_institucion->ViewCustomAttributes = "";

		// celular2
		$this->celular2->ViewValue = $this->celular2->CurrentValue;
		$this->celular2->ViewCustomAttributes = "";

		// direccion
		$this->direccion->ViewValue = $this->direccion->CurrentValue;
		$this->direccion->ViewCustomAttributes = "";

		// especialidad
		$this->especialidad->ViewValue = $this->especialidad->CurrentValue;
		$this->especialidad->ViewCustomAttributes = "";

		// avatar
		if (!ew_Empty($this->avatar->Upload->DbValue)) {
			$this->avatar->ViewValue = "usuario_avatar_bv.php?" . "_login=" . $this->_login->CurrentValue;
			$this->avatar->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->avatar->Upload->DbValue, 0, 11)));
		} else {
			$this->avatar->ViewValue = "";
		}
		$this->avatar->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = ew_FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// color
		$this->color->ViewValue = $this->color->CurrentValue;
		$this->color->ViewCustomAttributes = "";

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

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";

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

			// cargo
			$this->cargo->LinkCustomAttributes = "";
			$this->cargo->HrefValue = "";
			$this->cargo->TooltipValue = "";

			// id_institucion
			$this->id_institucion->LinkCustomAttributes = "";
			$this->id_institucion->HrefValue = "";
			$this->id_institucion->TooltipValue = "";

			// celular2
			$this->celular2->LinkCustomAttributes = "";
			$this->celular2->HrefValue = "";
			$this->celular2->TooltipValue = "";

			// direccion
			$this->direccion->LinkCustomAttributes = "";
			$this->direccion->HrefValue = "";
			$this->direccion->TooltipValue = "";

			// especialidad
			$this->especialidad->LinkCustomAttributes = "";
			$this->especialidad->HrefValue = "";
			$this->especialidad->TooltipValue = "";

			// avatar
			$this->avatar->LinkCustomAttributes = "";
			if (!empty($this->avatar->Upload->DbValue)) {
				$this->avatar->HrefValue = "usuario_avatar_bv.php?_login=" . $this->_login->CurrentValue;
				$this->avatar->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->avatar->HrefValue = ew_FullUrl($this->avatar->HrefValue, "href");
			} else {
				$this->avatar->HrefValue = "";
			}
			$this->avatar->HrefValue2 = "usuario_avatar_bv.php?_login=" . $this->_login->CurrentValue;
			$this->avatar->TooltipValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";

			// color
			$this->color->LinkCustomAttributes = "";
			$this->color->HrefValue = "";
			$this->color->TooltipValue = "";
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
			$this->password->EditAttrs["class"] = "form-control ewPasswordStrength";
			$this->password->EditCustomAttributes = "";
			$this->password->EditValue = ew_HtmlEncode($this->password->CurrentValue);
			$this->password->PlaceHolder = ew_RemoveHtml($this->password->FldTitle());

			// ci
			$this->ci->EditAttrs["class"] = "form-control";
			$this->ci->EditCustomAttributes = "";
			$this->ci->EditValue = ew_HtmlEncode($this->ci->CurrentValue);
			$this->ci->PlaceHolder = ew_RemoveHtml($this->ci->FldTitle());

			// id_rol
			$this->id_rol->EditCustomAttributes = "";
			if (!$Security->CanAdmin()) { // System admin
				$this->id_rol->EditValue = $Language->Phrase("PasswordMask");
			} else {
			if (trim(strval($this->id_rol->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`userlevelid`" . ew_SearchString("=", $this->id_rol->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `userlevels`";
			$sWhereWrk = "";
			$this->id_rol->LookupFilters = array("dx1" => '`userlevelname`');
			$lookuptblfilter = "`userlevelid`='1'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_rol, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->id_rol->ViewValue = $this->id_rol->DisplayValue($arwrk);
			} else {
				$this->id_rol->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_rol->EditValue = $arwrk;
			}

			// status
			$this->status->EditAttrs["class"] = "form-control";
			$this->status->EditCustomAttributes = "";
			$this->status->CurrentValue = 1;

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

			// cargo
			$this->cargo->EditAttrs["class"] = "form-control";
			$this->cargo->EditCustomAttributes = "";
			if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin
				if (strval($this->_login->CurrentValue) == strval(CurrentUserID())) {
			$this->cargo->EditValue = $this->cargo->CurrentValue;
			$this->cargo->ViewCustomAttributes = "";
				} else {
				}
			} else {
			$this->cargo->EditValue = ew_HtmlEncode($this->cargo->CurrentValue);
			$this->cargo->PlaceHolder = ew_RemoveHtml($this->cargo->FldTitle());
			}

			// id_institucion
			$this->id_institucion->EditAttrs["class"] = "form-control";
			$this->id_institucion->EditCustomAttributes = "";
			if (trim(strval($this->id_institucion->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_institucion->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `banco`";
			$sWhereWrk = "";
			$this->id_institucion->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_institucion, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_institucion->EditValue = $arwrk;

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

			// especialidad
			$this->especialidad->EditAttrs["class"] = "form-control";
			$this->especialidad->EditCustomAttributes = "";
			$this->especialidad->EditValue = ew_HtmlEncode($this->especialidad->CurrentValue);
			$this->especialidad->PlaceHolder = ew_RemoveHtml($this->especialidad->FldTitle());

			// avatar
			$this->avatar->EditAttrs["class"] = "form-control";
			$this->avatar->EditCustomAttributes = "";
			if (!ew_Empty($this->avatar->Upload->DbValue)) {
				$this->avatar->EditValue = "usuario_avatar_bv.php?" . "_login=" . $this->_login->CurrentValue;
				$this->avatar->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->avatar->Upload->DbValue, 0, 11)));
			} else {
				$this->avatar->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->avatar);

			// created_at
			// color

			$this->color->EditAttrs["class"] = "form-control";
			$this->color->EditCustomAttributes = "";
			$this->color->EditValue = ew_HtmlEncode($this->color->CurrentValue);
			$this->color->PlaceHolder = ew_RemoveHtml($this->color->FldTitle());

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

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";

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

			// cargo
			$this->cargo->LinkCustomAttributes = "";
			$this->cargo->HrefValue = "";

			// id_institucion
			$this->id_institucion->LinkCustomAttributes = "";
			$this->id_institucion->HrefValue = "";

			// celular2
			$this->celular2->LinkCustomAttributes = "";
			$this->celular2->HrefValue = "";

			// direccion
			$this->direccion->LinkCustomAttributes = "";
			$this->direccion->HrefValue = "";

			// especialidad
			$this->especialidad->LinkCustomAttributes = "";
			$this->especialidad->HrefValue = "";

			// avatar
			$this->avatar->LinkCustomAttributes = "";
			if (!empty($this->avatar->Upload->DbValue)) {
				$this->avatar->HrefValue = "usuario_avatar_bv.php?_login=" . $this->_login->CurrentValue;
				$this->avatar->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->avatar->HrefValue = ew_FullUrl($this->avatar->HrefValue, "href");
			} else {
				$this->avatar->HrefValue = "";
			}
			$this->avatar->HrefValue2 = "usuario_avatar_bv.php?_login=" . $this->_login->CurrentValue;

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";

			// color
			$this->color->LinkCustomAttributes = "";
			$this->color->HrefValue = "";
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
		if (!$this->direccion->FldIsDetailKey && !is_null($this->direccion->FormValue) && $this->direccion->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->direccion->FldCaption(), $this->direccion->ReqErrMsg));
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

			$this->password->SetDbValueDef($rsnew, $this->password->CurrentValue, "", $this->password->ReadOnly || (EW_ENCRYPTED_PASSWORD && $rs->fields('password') == $this->password->CurrentValue));

			// ci
			$this->ci->SetDbValueDef($rsnew, $this->ci->CurrentValue, "", $this->ci->ReadOnly);

			// id_rol
			if ($Security->CanAdmin()) { // System admin
			$this->id_rol->SetDbValueDef($rsnew, $this->id_rol->CurrentValue, 0, $this->id_rol->ReadOnly);
			}

			// status
			$this->status->SetDbValueDef($rsnew, $this->status->CurrentValue, NULL, $this->status->ReadOnly);

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

			// cargo
			$this->cargo->SetDbValueDef($rsnew, $this->cargo->CurrentValue, NULL, $this->cargo->ReadOnly);

			// id_institucion
			$this->id_institucion->SetDbValueDef($rsnew, $this->id_institucion->CurrentValue, NULL, $this->id_institucion->ReadOnly);

			// celular2
			$this->celular2->SetDbValueDef($rsnew, $this->celular2->CurrentValue, NULL, $this->celular2->ReadOnly);

			// direccion
			$this->direccion->SetDbValueDef($rsnew, $this->direccion->CurrentValue, "", $this->direccion->ReadOnly);

			// especialidad
			$this->especialidad->SetDbValueDef($rsnew, $this->especialidad->CurrentValue, NULL, $this->especialidad->ReadOnly);

			// avatar
			if ($this->avatar->Visible && !$this->avatar->ReadOnly && !$this->avatar->Upload->KeepFile) {
				if (is_null($this->avatar->Upload->Value)) {
					$rsnew['avatar'] = NULL;
				} else {
					$this->avatar->Upload->Resize(EW_THUMBNAIL_DEFAULT_WIDTH, EW_THUMBNAIL_DEFAULT_HEIGHT);
					$this->avatar->ImageWidth = EW_THUMBNAIL_DEFAULT_WIDTH; // Resize width
					$this->avatar->ImageHeight = EW_THUMBNAIL_DEFAULT_HEIGHT; // Resize height
					$rsnew['avatar'] = $this->avatar->Upload->Value;
				}
			}

			// created_at
			$this->created_at->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['created_at'] = &$this->created_at->DbValue;

			// color
			$this->color->SetDbValueDef($rsnew, $this->color->CurrentValue, NULL, $this->color->ReadOnly);

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

		// avatar
		ew_CleanUploadTempPath($this->avatar, $this->avatar->Upload->Index);
		return $EditRow;
	}

	// Show link optionally based on User ID
	function ShowOptionLink($id = "") {
		global $Security;
		if ($Security->IsLoggedIn() && !$Security->IsAdmin() && !$this->UserIDAllow($id))
			return $Security->IsValidUserID($this->_login->CurrentValue);
		return TRUE;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("usuariolist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_id_rol":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `userlevelid` AS `LinkFld`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`userlevelname`');
			$lookuptblfilter = "`userlevelid`='1'";
			ew_AddFilter($sWhereWrk, $lookuptblfilter);
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
		case "x_id_institucion":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `banco`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_institucion, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($usuario_edit)) $usuario_edit = new cusuario_edit();

// Page init
$usuario_edit->Page_Init();

// Page main
$usuario_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$usuario_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fusuarioedit = new ew_Form("fusuarioedit", "edit");

// Validate form
fusuarioedit.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $usuario->nombre->FldCaption(), $usuario->nombre->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_apellido");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $usuario->apellido->FldCaption(), $usuario->apellido->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "__login");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $usuario->_login->FldCaption(), $usuario->_login->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "__login");
			if (elm && !ew_CheckEmail(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($usuario->_login->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_password");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $usuario->password->FldCaption(), $usuario->password->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_password");
			if (elm && $(elm).hasClass("ewPasswordStrength") && !$(elm).data("validated"))
				return this.OnError(elm, ewLanguage.Phrase("PasswordTooSimple"));
			elm = this.GetElements("x" + infix + "_ci");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $usuario->ci->FldCaption(), $usuario->ci->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_id_rol");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $usuario->id_rol->FldCaption(), $usuario->id_rol->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_id_sucursal");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $usuario->id_sucursal->FldCaption(), $usuario->id_sucursal->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_direccion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $usuario->direccion->FldCaption(), $usuario->direccion->ReqErrMsg)) ?>");

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
fusuarioedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fusuarioedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fusuarioedit.Lists["x_id_rol"] = {"LinkField":"x_userlevelid","Ajax":true,"AutoFill":false,"DisplayFields":["x_userlevelname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"userlevels"};
fusuarioedit.Lists["x_id_rol"].Data = "<?php echo $usuario_edit->id_rol->LookupFilterQuery(FALSE, "edit") ?>";
fusuarioedit.Lists["x_id_sucursal"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"sucursal"};
fusuarioedit.Lists["x_id_sucursal"].Data = "<?php echo $usuario_edit->id_sucursal->LookupFilterQuery(FALSE, "edit") ?>";
fusuarioedit.Lists["x_id_institucion"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_short_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"banco"};
fusuarioedit.Lists["x_id_institucion"].Data = "<?php echo $usuario_edit->id_institucion->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $usuario_edit->ShowPageHeader(); ?>
<?php
$usuario_edit->ShowMessage();
?>
<form name="fusuarioedit" id="fusuarioedit" class="<?php echo $usuario_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($usuario_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $usuario_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($usuario_edit->IsModal) ?>">
<!-- Fields to prevent google autofill -->
<input class="hidden" type="text" name="<?php echo ew_Encrypt(ew_Random()) ?>">
<input class="hidden" type="password" name="<?php echo ew_Encrypt(ew_Random()) ?>">
<?php if (!$usuario_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_usuarioedit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($usuario->nombre->Visible) { // nombre ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_nombre" class="form-group">
		<label id="elh_usuario_nombre" for="x_nombre" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->nombre->CellAttributes() ?>>
<span id="el_usuario_nombre">
<input type="text" data-table="usuario" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->nombre->getPlaceHolder()) ?>" value="<?php echo $usuario->nombre->EditValue ?>"<?php echo $usuario->nombre->EditAttributes() ?>>
</span>
<?php echo $usuario->nombre->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_nombre">
		<td class="col-sm-3"><span id="elh_usuario_nombre"><?php echo $usuario->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->nombre->CellAttributes() ?>>
<span id="el_usuario_nombre">
<input type="text" data-table="usuario" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->nombre->getPlaceHolder()) ?>" value="<?php echo $usuario->nombre->EditValue ?>"<?php echo $usuario->nombre->EditAttributes() ?>>
</span>
<?php echo $usuario->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->apellido->Visible) { // apellido ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_apellido" class="form-group">
		<label id="elh_usuario_apellido" for="x_apellido" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->apellido->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->apellido->CellAttributes() ?>>
<span id="el_usuario_apellido">
<input type="text" data-table="usuario" data-field="x_apellido" name="x_apellido" id="x_apellido" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($usuario->apellido->getPlaceHolder()) ?>" value="<?php echo $usuario->apellido->EditValue ?>"<?php echo $usuario->apellido->EditAttributes() ?>>
</span>
<?php echo $usuario->apellido->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_apellido">
		<td class="col-sm-3"><span id="elh_usuario_apellido"><?php echo $usuario->apellido->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->apellido->CellAttributes() ?>>
<span id="el_usuario_apellido">
<input type="text" data-table="usuario" data-field="x_apellido" name="x_apellido" id="x_apellido" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($usuario->apellido->getPlaceHolder()) ?>" value="<?php echo $usuario->apellido->EditValue ?>"<?php echo $usuario->apellido->EditAttributes() ?>>
</span>
<?php echo $usuario->apellido->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->_login->Visible) { // login ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r__login" class="form-group">
		<label id="elh_usuario__login" for="x__login" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->_login->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->_login->CellAttributes() ?>>
<span id="el_usuario__login">
<span<?php echo $usuario->_login->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->_login->EditValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x__login" name="x__login" id="x__login" value="<?php echo ew_HtmlEncode($usuario->_login->CurrentValue) ?>">
<?php echo $usuario->_login->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__login">
		<td class="col-sm-3"><span id="elh_usuario__login"><?php echo $usuario->_login->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->_login->CellAttributes() ?>>
<span id="el_usuario__login">
<span<?php echo $usuario->_login->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->_login->EditValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x__login" name="x__login" id="x__login" value="<?php echo ew_HtmlEncode($usuario->_login->CurrentValue) ?>">
<?php echo $usuario->_login->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->password->Visible) { // password ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_password" class="form-group">
		<label id="elh_usuario_password" for="x_password" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->password->CellAttributes() ?>>
<span id="el_usuario_password">
<div class="input-group" id="ig_password">
<input type="password" data-password-strength="pst_password" data-password-generated="pgt_password" data-table="usuario" data-field="x_password" name="x_password" id="x_password" value="<?php echo $usuario->password->EditValue ?>" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($usuario->password->getPlaceHolder()) ?>"<?php echo $usuario->password->EditAttributes() ?>>
<span class="input-group-btn">
	<button type="button" class="btn btn-default ewPasswordGenerator" title="<?php echo ew_HtmlTitle($Language->Phrase("GeneratePassword")) ?>" data-password-field="x_password" data-password-confirm="c_password" data-password-strength="pst_password" data-password-generated="pgt_password"><?php echo $Language->Phrase("GeneratePassword") ?></button>
</span>
</div>
<span class="help-block" id="pgt_password" style="display: none;"></span>
<div class="progress ewPasswordStrengthBar" id="pst_password" style="display: none;">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<?php echo $usuario->password->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_password">
		<td class="col-sm-3"><span id="elh_usuario_password"><?php echo $usuario->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->password->CellAttributes() ?>>
<span id="el_usuario_password">
<div class="input-group" id="ig_password">
<input type="password" data-password-strength="pst_password" data-password-generated="pgt_password" data-table="usuario" data-field="x_password" name="x_password" id="x_password" value="<?php echo $usuario->password->EditValue ?>" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($usuario->password->getPlaceHolder()) ?>"<?php echo $usuario->password->EditAttributes() ?>>
<span class="input-group-btn">
	<button type="button" class="btn btn-default ewPasswordGenerator" title="<?php echo ew_HtmlTitle($Language->Phrase("GeneratePassword")) ?>" data-password-field="x_password" data-password-confirm="c_password" data-password-strength="pst_password" data-password-generated="pgt_password"><?php echo $Language->Phrase("GeneratePassword") ?></button>
</span>
</div>
<span class="help-block" id="pgt_password" style="display: none;"></span>
<div class="progress ewPasswordStrengthBar" id="pst_password" style="display: none;">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<?php echo $usuario->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->ci->Visible) { // ci ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_ci" class="form-group">
		<label id="elh_usuario_ci" for="x_ci" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->ci->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->ci->CellAttributes() ?>>
<span id="el_usuario_ci">
<input type="text" data-table="usuario" data-field="x_ci" name="x_ci" id="x_ci" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($usuario->ci->getPlaceHolder()) ?>" value="<?php echo $usuario->ci->EditValue ?>"<?php echo $usuario->ci->EditAttributes() ?>>
</span>
<?php echo $usuario->ci->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ci">
		<td class="col-sm-3"><span id="elh_usuario_ci"><?php echo $usuario->ci->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->ci->CellAttributes() ?>>
<span id="el_usuario_ci">
<input type="text" data-table="usuario" data-field="x_ci" name="x_ci" id="x_ci" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($usuario->ci->getPlaceHolder()) ?>" value="<?php echo $usuario->ci->EditValue ?>"<?php echo $usuario->ci->EditAttributes() ?>>
</span>
<?php echo $usuario->ci->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->id_rol->Visible) { // id_rol ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_id_rol" class="form-group">
		<label id="elh_usuario_id_rol" for="x_id_rol" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->id_rol->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->id_rol->CellAttributes() ?>>
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<span id="el_usuario_id_rol">
<p class="form-control-static"><?php echo $usuario->id_rol->EditValue ?></p>
</span>
<?php } else { ?>
<span id="el_usuario_id_rol">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_id_rol"><?php echo (strval($usuario->id_rol->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $usuario->id_rol->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($usuario->id_rol->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_id_rol',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($usuario->id_rol->ReadOnly || $usuario->id_rol->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="usuario" data-field="x_id_rol" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $usuario->id_rol->DisplayValueSeparatorAttribute() ?>" name="x_id_rol" id="x_id_rol" value="<?php echo $usuario->id_rol->CurrentValue ?>"<?php echo $usuario->id_rol->EditAttributes() ?>>
</span>
<?php } ?>
<?php echo $usuario->id_rol->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_rol">
		<td class="col-sm-3"><span id="elh_usuario_id_rol"><?php echo $usuario->id_rol->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->id_rol->CellAttributes() ?>>
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<span id="el_usuario_id_rol">
<p class="form-control-static"><?php echo $usuario->id_rol->EditValue ?></p>
</span>
<?php } else { ?>
<span id="el_usuario_id_rol">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_id_rol"><?php echo (strval($usuario->id_rol->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $usuario->id_rol->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($usuario->id_rol->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_id_rol',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($usuario->id_rol->ReadOnly || $usuario->id_rol->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="usuario" data-field="x_id_rol" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $usuario->id_rol->DisplayValueSeparatorAttribute() ?>" name="x_id_rol" id="x_id_rol" value="<?php echo $usuario->id_rol->CurrentValue ?>"<?php echo $usuario->id_rol->EditAttributes() ?>>
</span>
<?php } ?>
<?php echo $usuario->id_rol->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->id_sucursal->Visible) { // id_sucursal ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_id_sucursal" class="form-group">
		<label id="elh_usuario_id_sucursal" for="x_id_sucursal" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->id_sucursal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->id_sucursal->CellAttributes() ?>>
<span id="el_usuario_id_sucursal">
<select data-table="usuario" data-field="x_id_sucursal" data-value-separator="<?php echo $usuario->id_sucursal->DisplayValueSeparatorAttribute() ?>" id="x_id_sucursal" name="x_id_sucursal"<?php echo $usuario->id_sucursal->EditAttributes() ?>>
<?php echo $usuario->id_sucursal->SelectOptionListHtml("x_id_sucursal") ?>
</select>
</span>
<?php echo $usuario->id_sucursal->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_sucursal">
		<td class="col-sm-3"><span id="elh_usuario_id_sucursal"><?php echo $usuario->id_sucursal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->id_sucursal->CellAttributes() ?>>
<span id="el_usuario_id_sucursal">
<select data-table="usuario" data-field="x_id_sucursal" data-value-separator="<?php echo $usuario->id_sucursal->DisplayValueSeparatorAttribute() ?>" id="x_id_sucursal" name="x_id_sucursal"<?php echo $usuario->id_sucursal->EditAttributes() ?>>
<?php echo $usuario->id_sucursal->SelectOptionListHtml("x_id_sucursal") ?>
</select>
</span>
<?php echo $usuario->id_sucursal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->_email->Visible) { // email ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r__email" class="form-group">
		<label id="elh_usuario__email" for="x__email" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->_email->FldCaption() ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->_email->CellAttributes() ?>>
<span id="el_usuario__email">
<input type="text" data-table="usuario" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($usuario->_email->getPlaceHolder()) ?>" value="<?php echo $usuario->_email->EditValue ?>"<?php echo $usuario->_email->EditAttributes() ?>>
</span>
<?php echo $usuario->_email->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__email">
		<td class="col-sm-3"><span id="elh_usuario__email"><?php echo $usuario->_email->FldCaption() ?></span></td>
		<td<?php echo $usuario->_email->CellAttributes() ?>>
<span id="el_usuario__email">
<input type="text" data-table="usuario" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($usuario->_email->getPlaceHolder()) ?>" value="<?php echo $usuario->_email->EditValue ?>"<?php echo $usuario->_email->EditAttributes() ?>>
</span>
<?php echo $usuario->_email->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->telefono_fijo01->Visible) { // telefono_fijo01 ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_telefono_fijo01" class="form-group">
		<label id="elh_usuario_telefono_fijo01" for="x_telefono_fijo01" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->telefono_fijo01->FldCaption() ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->telefono_fijo01->CellAttributes() ?>>
<span id="el_usuario_telefono_fijo01">
<input type="text" data-table="usuario" data-field="x_telefono_fijo01" name="x_telefono_fijo01" id="x_telefono_fijo01" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->telefono_fijo01->getPlaceHolder()) ?>" value="<?php echo $usuario->telefono_fijo01->EditValue ?>"<?php echo $usuario->telefono_fijo01->EditAttributes() ?>>
</span>
<?php echo $usuario->telefono_fijo01->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_telefono_fijo01">
		<td class="col-sm-3"><span id="elh_usuario_telefono_fijo01"><?php echo $usuario->telefono_fijo01->FldCaption() ?></span></td>
		<td<?php echo $usuario->telefono_fijo01->CellAttributes() ?>>
<span id="el_usuario_telefono_fijo01">
<input type="text" data-table="usuario" data-field="x_telefono_fijo01" name="x_telefono_fijo01" id="x_telefono_fijo01" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->telefono_fijo01->getPlaceHolder()) ?>" value="<?php echo $usuario->telefono_fijo01->EditValue ?>"<?php echo $usuario->telefono_fijo01->EditAttributes() ?>>
</span>
<?php echo $usuario->telefono_fijo01->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->telefono_fijo02->Visible) { // telefono_fijo02 ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_telefono_fijo02" class="form-group">
		<label id="elh_usuario_telefono_fijo02" for="x_telefono_fijo02" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->telefono_fijo02->FldCaption() ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->telefono_fijo02->CellAttributes() ?>>
<span id="el_usuario_telefono_fijo02">
<input type="text" data-table="usuario" data-field="x_telefono_fijo02" name="x_telefono_fijo02" id="x_telefono_fijo02" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->telefono_fijo02->getPlaceHolder()) ?>" value="<?php echo $usuario->telefono_fijo02->EditValue ?>"<?php echo $usuario->telefono_fijo02->EditAttributes() ?>>
</span>
<?php echo $usuario->telefono_fijo02->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_telefono_fijo02">
		<td class="col-sm-3"><span id="elh_usuario_telefono_fijo02"><?php echo $usuario->telefono_fijo02->FldCaption() ?></span></td>
		<td<?php echo $usuario->telefono_fijo02->CellAttributes() ?>>
<span id="el_usuario_telefono_fijo02">
<input type="text" data-table="usuario" data-field="x_telefono_fijo02" name="x_telefono_fijo02" id="x_telefono_fijo02" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->telefono_fijo02->getPlaceHolder()) ?>" value="<?php echo $usuario->telefono_fijo02->EditValue ?>"<?php echo $usuario->telefono_fijo02->EditAttributes() ?>>
</span>
<?php echo $usuario->telefono_fijo02->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->celular->Visible) { // celular ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_celular" class="form-group">
		<label id="elh_usuario_celular" for="x_celular" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->celular->FldCaption() ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->celular->CellAttributes() ?>>
<span id="el_usuario_celular">
<input type="text" data-table="usuario" data-field="x_celular" name="x_celular" id="x_celular" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->celular->getPlaceHolder()) ?>" value="<?php echo $usuario->celular->EditValue ?>"<?php echo $usuario->celular->EditAttributes() ?>>
</span>
<?php echo $usuario->celular->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_celular">
		<td class="col-sm-3"><span id="elh_usuario_celular"><?php echo $usuario->celular->FldCaption() ?></span></td>
		<td<?php echo $usuario->celular->CellAttributes() ?>>
<span id="el_usuario_celular">
<input type="text" data-table="usuario" data-field="x_celular" name="x_celular" id="x_celular" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->celular->getPlaceHolder()) ?>" value="<?php echo $usuario->celular->EditValue ?>"<?php echo $usuario->celular->EditAttributes() ?>>
</span>
<?php echo $usuario->celular->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->cargo->Visible) { // cargo ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_cargo" class="form-group">
		<label id="elh_usuario_cargo" for="x_cargo" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->cargo->FldCaption() ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->cargo->CellAttributes() ?>>
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<?php if (strval($usuario->_login->CurrentValue) == strval(CurrentUserID())) { ?>
<span id="el_usuario_cargo">
<span<?php echo $usuario->cargo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->cargo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_cargo" name="x_cargo" id="x_cargo" value="<?php echo ew_HtmlEncode($usuario->cargo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_usuario_cargo">
<select data-table="usuario" data-field="x_cargo" data-value-separator="<?php echo $usuario->cargo->DisplayValueSeparatorAttribute() ?>" id="x_cargo" name="x_cargo"<?php echo $usuario->cargo->EditAttributes() ?>>
<?php echo $usuario->cargo->SelectOptionListHtml("x_cargo") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_usuario_cargo">
<input type="text" data-table="usuario" data-field="x_cargo" name="x_cargo" id="x_cargo" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->cargo->getPlaceHolder()) ?>" value="<?php echo $usuario->cargo->EditValue ?>"<?php echo $usuario->cargo->EditAttributes() ?>>
</span>
<?php } ?>
<?php echo $usuario->cargo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cargo">
		<td class="col-sm-3"><span id="elh_usuario_cargo"><?php echo $usuario->cargo->FldCaption() ?></span></td>
		<td<?php echo $usuario->cargo->CellAttributes() ?>>
<?php if (!$Security->IsAdmin() && $Security->IsLoggedIn()) { // Non system admin ?>
<?php if (strval($usuario->_login->CurrentValue) == strval(CurrentUserID())) { ?>
<span id="el_usuario_cargo">
<span<?php echo $usuario->cargo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->cargo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_cargo" name="x_cargo" id="x_cargo" value="<?php echo ew_HtmlEncode($usuario->cargo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_usuario_cargo">
<select data-table="usuario" data-field="x_cargo" data-value-separator="<?php echo $usuario->cargo->DisplayValueSeparatorAttribute() ?>" id="x_cargo" name="x_cargo"<?php echo $usuario->cargo->EditAttributes() ?>>
<?php echo $usuario->cargo->SelectOptionListHtml("x_cargo") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_usuario_cargo">
<input type="text" data-table="usuario" data-field="x_cargo" name="x_cargo" id="x_cargo" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->cargo->getPlaceHolder()) ?>" value="<?php echo $usuario->cargo->EditValue ?>"<?php echo $usuario->cargo->EditAttributes() ?>>
</span>
<?php } ?>
<?php echo $usuario->cargo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->id_institucion->Visible) { // id_institucion ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_id_institucion" class="form-group">
		<label id="elh_usuario_id_institucion" for="x_id_institucion" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->id_institucion->FldCaption() ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->id_institucion->CellAttributes() ?>>
<span id="el_usuario_id_institucion">
<select data-table="usuario" data-field="x_id_institucion" data-value-separator="<?php echo $usuario->id_institucion->DisplayValueSeparatorAttribute() ?>" id="x_id_institucion" name="x_id_institucion"<?php echo $usuario->id_institucion->EditAttributes() ?>>
<?php echo $usuario->id_institucion->SelectOptionListHtml("x_id_institucion") ?>
</select>
</span>
<?php echo $usuario->id_institucion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_institucion">
		<td class="col-sm-3"><span id="elh_usuario_id_institucion"><?php echo $usuario->id_institucion->FldCaption() ?></span></td>
		<td<?php echo $usuario->id_institucion->CellAttributes() ?>>
<span id="el_usuario_id_institucion">
<select data-table="usuario" data-field="x_id_institucion" data-value-separator="<?php echo $usuario->id_institucion->DisplayValueSeparatorAttribute() ?>" id="x_id_institucion" name="x_id_institucion"<?php echo $usuario->id_institucion->EditAttributes() ?>>
<?php echo $usuario->id_institucion->SelectOptionListHtml("x_id_institucion") ?>
</select>
</span>
<?php echo $usuario->id_institucion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->celular2->Visible) { // celular2 ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_celular2" class="form-group">
		<label id="elh_usuario_celular2" for="x_celular2" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->celular2->FldCaption() ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->celular2->CellAttributes() ?>>
<span id="el_usuario_celular2">
<input type="text" data-table="usuario" data-field="x_celular2" name="x_celular2" id="x_celular2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->celular2->getPlaceHolder()) ?>" value="<?php echo $usuario->celular2->EditValue ?>"<?php echo $usuario->celular2->EditAttributes() ?>>
</span>
<?php echo $usuario->celular2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_celular2">
		<td class="col-sm-3"><span id="elh_usuario_celular2"><?php echo $usuario->celular2->FldCaption() ?></span></td>
		<td<?php echo $usuario->celular2->CellAttributes() ?>>
<span id="el_usuario_celular2">
<input type="text" data-table="usuario" data-field="x_celular2" name="x_celular2" id="x_celular2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->celular2->getPlaceHolder()) ?>" value="<?php echo $usuario->celular2->EditValue ?>"<?php echo $usuario->celular2->EditAttributes() ?>>
</span>
<?php echo $usuario->celular2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->direccion->Visible) { // direccion ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_direccion" class="form-group">
		<label id="elh_usuario_direccion" for="x_direccion" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->direccion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->direccion->CellAttributes() ?>>
<span id="el_usuario_direccion">
<textarea data-table="usuario" data-field="x_direccion" name="x_direccion" id="x_direccion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($usuario->direccion->getPlaceHolder()) ?>"<?php echo $usuario->direccion->EditAttributes() ?>><?php echo $usuario->direccion->EditValue ?></textarea>
</span>
<?php echo $usuario->direccion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direccion">
		<td class="col-sm-3"><span id="elh_usuario_direccion"><?php echo $usuario->direccion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->direccion->CellAttributes() ?>>
<span id="el_usuario_direccion">
<textarea data-table="usuario" data-field="x_direccion" name="x_direccion" id="x_direccion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($usuario->direccion->getPlaceHolder()) ?>"<?php echo $usuario->direccion->EditAttributes() ?>><?php echo $usuario->direccion->EditValue ?></textarea>
</span>
<?php echo $usuario->direccion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->especialidad->Visible) { // especialidad ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_especialidad" class="form-group">
		<label id="elh_usuario_especialidad" for="x_especialidad" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->especialidad->FldCaption() ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->especialidad->CellAttributes() ?>>
<span id="el_usuario_especialidad">
<input type="text" data-table="usuario" data-field="x_especialidad" name="x_especialidad" id="x_especialidad" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->especialidad->getPlaceHolder()) ?>" value="<?php echo $usuario->especialidad->EditValue ?>"<?php echo $usuario->especialidad->EditAttributes() ?>>
</span>
<?php echo $usuario->especialidad->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_especialidad">
		<td class="col-sm-3"><span id="elh_usuario_especialidad"><?php echo $usuario->especialidad->FldCaption() ?></span></td>
		<td<?php echo $usuario->especialidad->CellAttributes() ?>>
<span id="el_usuario_especialidad">
<input type="text" data-table="usuario" data-field="x_especialidad" name="x_especialidad" id="x_especialidad" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->especialidad->getPlaceHolder()) ?>" value="<?php echo $usuario->especialidad->EditValue ?>"<?php echo $usuario->especialidad->EditAttributes() ?>>
</span>
<?php echo $usuario->especialidad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->avatar->Visible) { // avatar ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_avatar" class="form-group">
		<label id="elh_usuario_avatar" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->avatar->FldCaption() ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->avatar->CellAttributes() ?>>
<span id="el_usuario_avatar">
<div id="fd_x_avatar">
<span title="<?php echo $usuario->avatar->FldTitle() ? $usuario->avatar->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($usuario->avatar->ReadOnly || $usuario->avatar->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="usuario" data-field="x_avatar" name="x_avatar" id="x_avatar"<?php echo $usuario->avatar->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_avatar" id= "fn_x_avatar" value="<?php echo $usuario->avatar->Upload->FileName ?>">
<?php if (@$_POST["fa_x_avatar"] == "0") { ?>
<input type="hidden" name="fa_x_avatar" id= "fa_x_avatar" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_avatar" id= "fa_x_avatar" value="1">
<?php } ?>
<input type="hidden" name="fs_x_avatar" id= "fs_x_avatar" value="0">
<input type="hidden" name="fx_x_avatar" id= "fx_x_avatar" value="<?php echo $usuario->avatar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_avatar" id= "fm_x_avatar" value="<?php echo $usuario->avatar->UploadMaxFileSize ?>">
</div>
<table id="ft_x_avatar" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table><?php if (!$usuario->avatar->ReadOnly && !$usuario->avatar->Disabled && @$usuario->avatar->EditAttrs["readonly"] == "" && @$usuario->avatar->EditAttrs["disabled"] == "") { ?>
<script type="text/javascript">ew_CheckFileUpload("fusuarioedit", "x_avatar");</script>
<?php } ?>
</span>
<?php echo $usuario->avatar->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_avatar">
		<td class="col-sm-3"><span id="elh_usuario_avatar"><?php echo $usuario->avatar->FldCaption() ?></span></td>
		<td<?php echo $usuario->avatar->CellAttributes() ?>>
<span id="el_usuario_avatar">
<div id="fd_x_avatar">
<span title="<?php echo $usuario->avatar->FldTitle() ? $usuario->avatar->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($usuario->avatar->ReadOnly || $usuario->avatar->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="usuario" data-field="x_avatar" name="x_avatar" id="x_avatar"<?php echo $usuario->avatar->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_avatar" id= "fn_x_avatar" value="<?php echo $usuario->avatar->Upload->FileName ?>">
<?php if (@$_POST["fa_x_avatar"] == "0") { ?>
<input type="hidden" name="fa_x_avatar" id= "fa_x_avatar" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_avatar" id= "fa_x_avatar" value="1">
<?php } ?>
<input type="hidden" name="fs_x_avatar" id= "fs_x_avatar" value="0">
<input type="hidden" name="fx_x_avatar" id= "fx_x_avatar" value="<?php echo $usuario->avatar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_avatar" id= "fm_x_avatar" value="<?php echo $usuario->avatar->UploadMaxFileSize ?>">
</div>
<table id="ft_x_avatar" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table><?php if (!$usuario->avatar->ReadOnly && !$usuario->avatar->Disabled && @$usuario->avatar->EditAttrs["readonly"] == "" && @$usuario->avatar->EditAttrs["disabled"] == "") { ?>
<script type="text/javascript">ew_CheckFileUpload("fusuarioedit", "x_avatar");</script>
<?php } ?>
</span>
<?php echo $usuario->avatar->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->color->Visible) { // color ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
	<div id="r_color" class="form-group">
		<label id="elh_usuario_color" for="x_color" class="<?php echo $usuario_edit->LeftColumnClass ?>"><?php echo $usuario->color->FldCaption() ?></label>
		<div class="<?php echo $usuario_edit->RightColumnClass ?>"><div<?php echo $usuario->color->CellAttributes() ?>>
<span id="el_usuario_color">
<input type="text" data-table="usuario" data-field="x_color" name="x_color" id="x_color" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($usuario->color->getPlaceHolder()) ?>" value="<?php echo $usuario->color->EditValue ?>"<?php echo $usuario->color->EditAttributes() ?>>

<script type="text/javascript">
$("#x_color").colorpicker({ format: "hex" });
</script>

</span>
<?php echo $usuario->color->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_color">
		<td class="col-sm-3"><span id="elh_usuario_color"><?php echo $usuario->color->FldCaption() ?></span></td>
		<td<?php echo $usuario->color->CellAttributes() ?>>
<span id="el_usuario_color">
<input type="text" data-table="usuario" data-field="x_color" name="x_color" id="x_color" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($usuario->color->getPlaceHolder()) ?>" value="<?php echo $usuario->color->EditValue ?>"<?php echo $usuario->color->EditAttributes() ?>>

<script type="text/javascript">
$("#x_color").colorpicker({ format: "hex" });
</script>

</span>
<?php echo $usuario->color->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<span id="el_usuario_status">
<input type="hidden" data-table="usuario" data-field="x_status" name="x_status" id="x_status" value="<?php echo ew_HtmlEncode($usuario->status->CurrentValue) ?>">
</span>
<?php if (!$usuario_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $usuario_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $usuario_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$usuario_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fusuarioedit.Init();
</script>
<?php
$usuario_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$usuario_edit->Page_Terminate();
?>
