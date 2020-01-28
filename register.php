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

$register = NULL; // Initialize page object first

class cregister extends cusuario {

	// Page ID
	var $PageID = 'register';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Page object name
	var $PageObjName = 'register';

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
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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
		return TRUE;
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
		if (!isset($GLOBALS["usuario"])) $GLOBALS["usuario"] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'register', TRUE);

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

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 
		// Create form object

		$objForm = new cFormObj();
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

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
		$this->Page_Redirecting($url);

		// Close connection
		ew_CloseConn();

		// Go to URL if specified
		if ($url <> "") {
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}
	var $FormClassName = "form-horizontal ewForm ewRegisterForm";

	//
	// Page main
	//
	function Page_Main() {
		global $UserTableConn, $Security, $Language, $gsLanguage, $gsFormError, $objForm;
		global $Breadcrumb;
		$this->FormClassName = "ewForm ewRegisterForm form-horizontal";

		// Set up Breadcrumb
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb = new cBreadcrumb();
		$Breadcrumb->Add("register", "RegisterPage", $url, "", "", TRUE);
		$this->Heading = $Language->Phrase("RegisterPage");
		$bUserExists = FALSE;
		$this->LoadRowValues(); // Load default values
		if (@$_POST["a_register"] <> "") {

			// Get action
			$this->CurrentAction = $_POST["a_register"];
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->setFailureMessage($gsFormError);
			}
		} else {
			$this->CurrentAction = "I"; // Display blank record
		}

		// Handle email activation
		if (@$_GET["action"] <> "") {
			$sAction = $_GET["action"];
			$sEmail = @$_GET["email"];
			$sCode = @$_GET["token"];
			@list($sApprovalCode, $sUsr, $sPwd) = explode(",", $sCode, 3);
			$sApprovalCode = ew_Decrypt($sApprovalCode);
			$sUsr = ew_Decrypt($sUsr);
			$sPwd = ew_Decrypt($sPwd);
			if ($sEmail == $sApprovalCode) {
				if (strtolower($sAction) == "confirm") { // Email activation
					if ($this->ActivateEmail($sEmail)) { // Activate this email
						if ($this->getSuccessMessage() == "")
							$this->setSuccessMessage($Language->Phrase("ActivateAccount")); // Set up message acount activated
						$this->Page_Terminate("login.php"); // Go to login page
					}
				}
			}
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("ActivateFailed")); // Set activate failed message
			$this->Page_Terminate("login.php"); // Go to login page
		}
		switch ($this->CurrentAction) {
			case "I": // Blank record, no action required
				break;
			case "A": // Add

				// Check for duplicate User ID
				$sFilter = str_replace("%u", ew_AdjustSql($this->_login->CurrentValue, EW_USER_TABLE_DBID), EW_USER_NAME_FILTER);

				// Set up filter (SQL WHERE clause) and get return SQL
				// SQL constructor in usuario class, usuarioinfo.php

				$this->CurrentFilter = $sFilter;
				$sUserSql = $this->SQL();
				if ($rs = $UserTableConn->Execute($sUserSql)) {
					if (!$rs->EOF) {
						$bUserExists = TRUE;
						$this->RestoreFormValues(); // Restore form values
						$this->setFailureMessage($Language->Phrase("UserExists")); // Set user exist message
					}
					$rs->Close();
				}
				if (!$bUserExists) {
					$this->SendEmail = TRUE; // Send email on add success
					if ($this->AddRow()) { // Add record
						$Email = $this->PrepareRegisterEmail();

						// Get new recordset
						$this->CurrentFilter = $this->KeyFilter();
						$sSql = $this->SQL();
						$rsnew = $UserTableConn->Execute($sSql);
						$row = $rsnew->fields;
						$Args = array();
						$Args["rs"] = $row;
						$bEmailSent = FALSE;
						if ($this->Email_Sending($Email, $Args))
							$bEmailSent = $Email->Send();

						// Send email failed
						if (!$bEmailSent)
							$this->setFailureMessage($Email->SendErrDescription);
						if ($this->getSuccessMessage() == "")
							$this->setSuccessMessage($Language->Phrase("RegisterSuccessActivate")); // Activate success
						$this->Page_Terminate("login.php"); // Return
					} else {
						$this->RestoreFormValues(); // Restore form values
					}
				}
		}

		// Render row
		if ($this->CurrentAction == "F") { // Confirm page
			$this->RowType = EW_ROWTYPE_VIEW; // Render view
		} else {
			$this->RowType = EW_ROWTYPE_ADD; // Render add
		}
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Activate account based on email
	function ActivateEmail($email) {
		global $UserTableConn, $Language;
		$sFilter = str_replace("%e", ew_AdjustSql($email, EW_USER_TABLE_DBID), EW_USER_EMAIL_FILTER);
		$sSql = $this->GetSQL($sFilter, "");
		$UserTableConn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $UserTableConn->Execute($sSql);
		$UserTableConn->raiseErrorFn = '';
		if (!$rs)
			return FALSE;
		if (!$rs->EOF) {
			$rsnew = $rs->fields;
			$this->LoadRowValues($rs); // Load row values
			$rs->Close();
			$rsact = array('status' => 1); // Auto register
			$this->CurrentFilter = $sFilter;
			$res = $this->Update($rsact);
			if ($res) { // Call User Activated event
				$rsnew['status'] = 1;
				$this->User_Activated($rsnew);
			}
			return $res;
		} else {
			$this->setFailureMessage($Language->Phrase("NoRecord"));
			$rs->Close();
			return FALSE;
		}
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
		$this->avatar->Upload->Index = $objForm->Index;
		$this->avatar->Upload->UploadFile();
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
		$this->id_rol->CurrentValue = 1;
		$this->status->CurrentValue = NULL;
		$this->status->OldValue = $this->status->CurrentValue;
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
		$this->cargo->CurrentValue = NULL;
		$this->cargo->OldValue = $this->cargo->CurrentValue;
		$this->id_institucion->CurrentValue = NULL;
		$this->id_institucion->OldValue = $this->id_institucion->CurrentValue;
		$this->celular2->CurrentValue = NULL;
		$this->celular2->OldValue = $this->celular2->CurrentValue;
		$this->direccion->CurrentValue = NULL;
		$this->direccion->OldValue = $this->direccion->CurrentValue;
		$this->especialidad->CurrentValue = NULL;
		$this->especialidad->OldValue = $this->especialidad->CurrentValue;
		$this->avatar->Upload->DbValue = NULL;
		$this->avatar->OldValue = $this->avatar->Upload->DbValue;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->color->CurrentValue = NULL;
		$this->color->OldValue = $this->color->CurrentValue;
		$this->codigo->CurrentValue = NULL;
		$this->codigo->OldValue = $this->codigo->CurrentValue;
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
		$this->password->ConfirmValue = $objForm->GetValue("c_password");
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
		$this->cargo->CurrentValue = $this->cargo->FormValue;
		$this->id_institucion->CurrentValue = $this->id_institucion->FormValue;
		$this->celular2->CurrentValue = $this->celular2->FormValue;
		$this->direccion->CurrentValue = $this->direccion->FormValue;
		$this->especialidad->CurrentValue = $this->especialidad->FormValue;
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
		$row['status'] = $this->status->CurrentValue;
		$row['id_sucursal'] = $this->id_sucursal->CurrentValue;
		$row['email'] = $this->_email->CurrentValue;
		$row['telefono_fijo01'] = $this->telefono_fijo01->CurrentValue;
		$row['telefono_fijo02'] = $this->telefono_fijo02->CurrentValue;
		$row['celular'] = $this->celular->CurrentValue;
		$row['cargo'] = $this->cargo->CurrentValue;
		$row['id_institucion'] = $this->id_institucion->CurrentValue;
		$row['celular2'] = $this->celular2->CurrentValue;
		$row['direccion'] = $this->direccion->CurrentValue;
		$row['especialidad'] = $this->especialidad->CurrentValue;
		$row['avatar'] = $this->avatar->Upload->DbValue;
		$row['created_at'] = $this->created_at->CurrentValue;
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
		$this->codigo->DbValue = $row['codigo'];
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
		if ($Security->CanAdmin()) { // System admin
		if (strval($this->id_rol->CurrentValue) <> "") {
			$sFilterWrk = "`userlevelid`" . ew_SearchString("=", $this->id_rol->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
				$sWhereWrk = "";
				$this->id_rol->LookupFilters = array("dx1" => '`userlevelname`');
				break;
			case "es":
				$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
				$sWhereWrk = "";
				$this->id_rol->LookupFilters = array("dx1" => '`userlevelname`');
				break;
			default:
				$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
				$sWhereWrk = "";
				$this->id_rol->LookupFilters = array("dx1" => '`userlevelname`');
				break;
		}
		$lookuptblfilter = "`userlevelid`>=1";
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
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
				$sWhereWrk = "";
				$this->id_sucursal->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
				$sWhereWrk = "";
				$this->id_sucursal->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
				$sWhereWrk = "";
				$this->id_sucursal->LookupFilters = array();
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

		// cargo
		$this->cargo->ViewValue = $this->cargo->CurrentValue;
		$this->cargo->ViewCustomAttributes = "";

		// id_institucion
		if (strval($this->id_institucion->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_institucion->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `banco`";
				$sWhereWrk = "";
				$this->id_institucion->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `banco`";
				$sWhereWrk = "";
				$this->id_institucion->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `banco`";
				$sWhereWrk = "";
				$this->id_institucion->LookupFilters = array();
				break;
		}
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
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `userlevels`";
					$sWhereWrk = "";
					$this->id_rol->LookupFilters = array("dx1" => '`userlevelname`');
					break;
				case "es":
					$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `userlevels`";
					$sWhereWrk = "";
					$this->id_rol->LookupFilters = array("dx1" => '`userlevelname`');
					break;
				default:
					$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `userlevels`";
					$sWhereWrk = "";
					$this->id_rol->LookupFilters = array("dx1" => '`userlevelname`');
					break;
			}
			$lookuptblfilter = "`userlevelid`>=1";
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

			// id_sucursal
			$this->id_sucursal->EditAttrs["class"] = "form-control";
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
					$this->id_sucursal->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `sucursal`";
					$sWhereWrk = "";
					$this->id_sucursal->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `sucursal`";
					$sWhereWrk = "";
					$this->id_sucursal->LookupFilters = array();
					break;
			}
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
			$this->cargo->EditValue = ew_HtmlEncode($this->cargo->CurrentValue);
			$this->cargo->PlaceHolder = ew_RemoveHtml($this->cargo->FldTitle());

			// id_institucion
			$this->id_institucion->EditAttrs["class"] = "form-control";
			$this->id_institucion->EditCustomAttributes = "";
			if (trim(strval($this->id_institucion->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_institucion->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `banco`";
					$sWhereWrk = "";
					$this->id_institucion->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `banco`";
					$sWhereWrk = "";
					$this->id_institucion->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `banco`";
					$sWhereWrk = "";
					$this->id_institucion->LookupFilters = array();
					break;
			}
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
			ew_AddMessage($gsFormError, $Language->Phrase("EnterUserName"));
		}
		if (!ew_CheckEmail($this->_login->FormValue)) {
			ew_AddMessage($gsFormError, $this->_login->FldErrMsg());
		}
		if (!$this->password->FldIsDetailKey && !is_null($this->password->FormValue) && $this->password->FormValue == "") {
			ew_AddMessage($gsFormError, $Language->Phrase("EnterPassword"));
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

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;

		// Check if valid User ID
		$bValidUser = FALSE;
		if ($Security->CurrentUserID() <> "" && !ew_Empty($this->_login->CurrentValue) && !$Security->IsAdmin()) { // Non system admin
			$bValidUser = $Security->IsValidUserID($this->_login->CurrentValue);
			if (!$bValidUser) {
				$sUserIdMsg = str_replace("%c", CurrentUserID(), $Language->Phrase("UnAuthorizedUserID"));
				$sUserIdMsg = str_replace("%u", $this->_login->CurrentValue, $sUserIdMsg);
				$this->setFailureMessage($sUserIdMsg);
				return FALSE;
			}
		}

		// Check if valid parent user id
		$bValidParentUser = FALSE;
		if ($Security->CurrentUserID() <> "" && !ew_Empty($this->cargo->CurrentValue) && !$Security->IsAdmin()) { // Non system admin
			$bValidParentUser = $Security->IsValidUserID($this->cargo->CurrentValue);
			if (!$bValidParentUser) {
				$sParentUserIdMsg = str_replace("%c", CurrentUserID(), $Language->Phrase("UnAuthorizedParentUserID"));
				$sParentUserIdMsg = str_replace("%p", $this->cargo->CurrentValue, $sParentUserIdMsg);
				$this->setFailureMessage($sParentUserIdMsg);
				return FALSE;
			}
		}
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
		$rsnew['id_rol'] = 1; // Set default User Level

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

		// cargo
		$this->cargo->SetDbValueDef($rsnew, $this->cargo->CurrentValue, NULL, FALSE);

		// id_institucion
		$this->id_institucion->SetDbValueDef($rsnew, $this->id_institucion->CurrentValue, NULL, FALSE);

		// celular2
		$this->celular2->SetDbValueDef($rsnew, $this->celular2->CurrentValue, NULL, FALSE);

		// direccion
		$this->direccion->SetDbValueDef($rsnew, $this->direccion->CurrentValue, "", FALSE);

		// especialidad
		$this->especialidad->SetDbValueDef($rsnew, $this->especialidad->CurrentValue, NULL, FALSE);

		// avatar
		if ($this->avatar->Visible && !$this->avatar->Upload->KeepFile) {
			if (is_null($this->avatar->Upload->Value)) {
				$rsnew['avatar'] = NULL;
			} else {
				$this->avatar->Upload->Resize(EW_THUMBNAIL_DEFAULT_WIDTH, EW_THUMBNAIL_DEFAULT_HEIGHT);
				$this->avatar->ImageWidth = EW_THUMBNAIL_DEFAULT_WIDTH; // Resize width
				$this->avatar->ImageHeight = EW_THUMBNAIL_DEFAULT_HEIGHT; // Resize height
				$rsnew['avatar'] = $this->avatar->Upload->Value;
			}
		}

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

			// Call User Registered event
			$this->User_Registered($rsnew);
		}

		// avatar
		ew_CleanUploadTempPath($this->avatar, $this->avatar->Upload->Index);
		return $AddRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_id_rol":
			$sSqlWrk = "";
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `userlevelid` AS `LinkFld`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
					$sWhereWrk = "{filter}";
					$fld->LookupFilters = array("dx1" => '`userlevelname`');
					break;
				case "es":
					$sSqlWrk = "SELECT `userlevelid` AS `LinkFld`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
					$sWhereWrk = "{filter}";
					$fld->LookupFilters = array("dx1" => '`userlevelname`');
					break;
				default:
					$sSqlWrk = "SELECT `userlevelid` AS `LinkFld`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
					$sWhereWrk = "{filter}";
					$fld->LookupFilters = array("dx1" => '`userlevelname`');
					break;
			}
			$lookuptblfilter = "`userlevelid`>=1";
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
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
			}
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_sucursal, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_institucion":
			$sSqlWrk = "";
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `banco`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `banco`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `banco`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
			}
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
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

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

	// Email Sending event
	function Email_Sending(&$Email, &$Args) {

		//var_dump($Email); var_dump($Args); exit();
		return TRUE;
	}

	// Form Custom Validate event
	function Form_CustomValidate(&$CustomError) {

		// Return error message in CustomError
		return TRUE;
	}

	// User Registered event
	function User_Registered(&$rs) {

		//echo "User_Registered";
	}

	// User Activated event
	function User_Activated(&$rs) {

		//echo "User_Activated";
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($register)) $register = new cregister();

// Page init
$register->Page_Init();

// Page main
$register->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$register->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "register";
var CurrentForm = fregister = new ew_Form("fregister", "register");

// Validate form
fregister.Validate = function() {
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
				return this.OnError(elm, ewLanguage.Phrase("EnterUserName"));
			elm = this.GetElements("x" + infix + "__login");
			if (elm && !ew_CheckEmail(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($usuario->_login->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_password");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, ewLanguage.Phrase("EnterPassword"));
			elm = this.GetElements("x" + infix + "_password");
			if (elm && $(elm).hasClass("ewPasswordStrength") && !$(elm).data("validated"))
				return this.OnError(elm, ewLanguage.Phrase("PasswordTooSimple"));
			if (fobj.c_password.value != fobj.x_password.value)
				return this.OnError(fobj.c_password, ewLanguage.Phrase("MismatchPassword"));
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
	return true;
}

// Form_CustomValidate event
fregister.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fregister.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fregister.Lists["x_id_rol"] = {"LinkField":"x_userlevelid","Ajax":true,"AutoFill":false,"DisplayFields":["x_userlevelname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"userlevels"};
fregister.Lists["x_id_rol"].Data = "<?php echo $register->id_rol->LookupFilterQuery(FALSE, "register") ?>";
fregister.Lists["x_id_sucursal"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"sucursal"};
fregister.Lists["x_id_sucursal"].Data = "<?php echo $register->id_sucursal->LookupFilterQuery(FALSE, "register") ?>";
fregister.Lists["x_id_institucion"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_short_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"banco"};
fregister.Lists["x_id_institucion"].Data = "<?php echo $register->id_institucion->LookupFilterQuery(FALSE, "register") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $register->ShowPageHeader(); ?>
<?php
$register->ShowMessage();
?>
<form name="fregister" id="fregister" class="<?php echo $register->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($register->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $register->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="usuario">
<input type="hidden" name="a_register" id="a_register" value="A">
<!-- Fields to prevent google autofill -->
<input class="hidden" type="text" name="<?php echo ew_Encrypt(ew_Random()) ?>">
<input class="hidden" type="password" name="<?php echo ew_Encrypt(ew_Random()) ?>">
<?php if ($usuario->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } ?>
<?php if (!ew_IsMobile()) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if (ew_IsMobile()) { ?>
<div class="ewRegisterDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_register" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($usuario->nombre->Visible) { // nombre ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_nombre" class="form-group">
		<label id="elh_usuario_nombre" for="x_nombre" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->nombre->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_nombre">
<input type="text" data-table="usuario" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->nombre->getPlaceHolder()) ?>" value="<?php echo $usuario->nombre->EditValue ?>"<?php echo $usuario->nombre->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_nombre">
<span<?php echo $usuario->nombre->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->nombre->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_nombre" name="x_nombre" id="x_nombre" value="<?php echo ew_HtmlEncode($usuario->nombre->FormValue) ?>">
<?php } ?>
<?php echo $usuario->nombre->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_nombre">
		<td class="col-sm-3"><span id="elh_usuario_nombre"><?php echo $usuario->nombre->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->nombre->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_nombre">
<input type="text" data-table="usuario" data-field="x_nombre" name="x_nombre" id="x_nombre" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->nombre->getPlaceHolder()) ?>" value="<?php echo $usuario->nombre->EditValue ?>"<?php echo $usuario->nombre->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_nombre">
<span<?php echo $usuario->nombre->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->nombre->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_nombre" name="x_nombre" id="x_nombre" value="<?php echo ew_HtmlEncode($usuario->nombre->FormValue) ?>">
<?php } ?>
<?php echo $usuario->nombre->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->apellido->Visible) { // apellido ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_apellido" class="form-group">
		<label id="elh_usuario_apellido" for="x_apellido" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->apellido->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->apellido->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_apellido">
<input type="text" data-table="usuario" data-field="x_apellido" name="x_apellido" id="x_apellido" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($usuario->apellido->getPlaceHolder()) ?>" value="<?php echo $usuario->apellido->EditValue ?>"<?php echo $usuario->apellido->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_apellido">
<span<?php echo $usuario->apellido->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->apellido->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_apellido" name="x_apellido" id="x_apellido" value="<?php echo ew_HtmlEncode($usuario->apellido->FormValue) ?>">
<?php } ?>
<?php echo $usuario->apellido->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_apellido">
		<td class="col-sm-3"><span id="elh_usuario_apellido"><?php echo $usuario->apellido->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->apellido->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_apellido">
<input type="text" data-table="usuario" data-field="x_apellido" name="x_apellido" id="x_apellido" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($usuario->apellido->getPlaceHolder()) ?>" value="<?php echo $usuario->apellido->EditValue ?>"<?php echo $usuario->apellido->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_apellido">
<span<?php echo $usuario->apellido->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->apellido->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_apellido" name="x_apellido" id="x_apellido" value="<?php echo ew_HtmlEncode($usuario->apellido->FormValue) ?>">
<?php } ?>
<?php echo $usuario->apellido->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->_login->Visible) { // login ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r__login" class="form-group">
		<label id="elh_usuario__login" for="x__login" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->_login->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->_login->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario__login">
<input type="text" data-table="usuario" data-field="x__login" name="x__login" id="x__login" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->_login->getPlaceHolder()) ?>" value="<?php echo $usuario->_login->EditValue ?>"<?php echo $usuario->_login->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario__login">
<span<?php echo $usuario->_login->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->_login->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x__login" name="x__login" id="x__login" value="<?php echo ew_HtmlEncode($usuario->_login->FormValue) ?>">
<?php } ?>
<?php echo $usuario->_login->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__login">
		<td class="col-sm-3"><span id="elh_usuario__login"><?php echo $usuario->_login->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->_login->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario__login">
<input type="text" data-table="usuario" data-field="x__login" name="x__login" id="x__login" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->_login->getPlaceHolder()) ?>" value="<?php echo $usuario->_login->EditValue ?>"<?php echo $usuario->_login->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario__login">
<span<?php echo $usuario->_login->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->_login->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x__login" name="x__login" id="x__login" value="<?php echo ew_HtmlEncode($usuario->_login->FormValue) ?>">
<?php } ?>
<?php echo $usuario->_login->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->password->Visible) { // password ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_password" class="form-group">
		<label id="elh_usuario_password" for="x_password" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->password->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_password">
<div class="input-group" id="ig_password">
<input type="password" data-password-strength="pst_password" data-password-generated="pgt_password" data-table="usuario" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($usuario->password->getPlaceHolder()) ?>"<?php echo $usuario->password->EditAttributes() ?>>
<span class="input-group-btn">
	<button type="button" class="btn btn-default ewPasswordGenerator" title="<?php echo ew_HtmlTitle($Language->Phrase("GeneratePassword")) ?>" data-password-field="x_password" data-password-confirm="c_password" data-password-strength="pst_password" data-password-generated="pgt_password"><?php echo $Language->Phrase("GeneratePassword") ?></button>
</span>
</div>
<span class="help-block" id="pgt_password" style="display: none;"></span>
<div class="progress ewPasswordStrengthBar" id="pst_password" style="display: none;">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<?php } else { ?>
<span id="el_usuario_password">
<span<?php echo $usuario->password->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->password->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_password" name="x_password" id="x_password" value="<?php echo ew_HtmlEncode($usuario->password->FormValue) ?>">
<?php } ?>
<?php echo $usuario->password->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_password">
		<td class="col-sm-3"><span id="elh_usuario_password"><?php echo $usuario->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->password->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_password">
<div class="input-group" id="ig_password">
<input type="password" data-password-strength="pst_password" data-password-generated="pgt_password" data-table="usuario" data-field="x_password" name="x_password" id="x_password" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($usuario->password->getPlaceHolder()) ?>"<?php echo $usuario->password->EditAttributes() ?>>
<span class="input-group-btn">
	<button type="button" class="btn btn-default ewPasswordGenerator" title="<?php echo ew_HtmlTitle($Language->Phrase("GeneratePassword")) ?>" data-password-field="x_password" data-password-confirm="c_password" data-password-strength="pst_password" data-password-generated="pgt_password"><?php echo $Language->Phrase("GeneratePassword") ?></button>
</span>
</div>
<span class="help-block" id="pgt_password" style="display: none;"></span>
<div class="progress ewPasswordStrengthBar" id="pst_password" style="display: none;">
	<div class="progress-bar" role="progressbar"></div>
</div>
</span>
<?php } else { ?>
<span id="el_usuario_password">
<span<?php echo $usuario->password->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->password->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_password" name="x_password" id="x_password" value="<?php echo ew_HtmlEncode($usuario->password->FormValue) ?>">
<?php } ?>
<?php echo $usuario->password->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->password->Visible) { // password ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_c_password" class="form-group">
		<label id="elh_c_usuario_password" for="c_password" class="<?php echo $register->LeftColumnClass ?>"><?php echo $Language->Phrase("Confirm") ?> <?php echo $usuario->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->password->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_c_usuario_password">
<input type="password" data-field="c_password" name="c_password" id="c_password" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($usuario->password->getPlaceHolder()) ?>"<?php echo $usuario->password->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_c_usuario_password">
<span<?php echo $usuario->password->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->password->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="c_password" name="c_password" id="c_password" value="<?php echo ew_HtmlEncode($usuario->password->FormValue) ?>">
<?php } ?>
</div></div>
	</div>
<?php } else { ?>
	<tr id="r_c_password">
		<td class="col-sm-3"><span id="elh_c_usuario_password" class="ewConfirmPassword"><?php echo $Language->Phrase("Confirm") ?> <?php echo $usuario->password->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->password->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_c_usuario_password">
<input type="password" data-field="c_password" name="c_password" id="c_password" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($usuario->password->getPlaceHolder()) ?>"<?php echo $usuario->password->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_c_usuario_password">
<span<?php echo $usuario->password->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->password->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="c_password" name="c_password" id="c_password" value="<?php echo ew_HtmlEncode($usuario->password->FormValue) ?>">
<?php } ?>
</td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->ci->Visible) { // ci ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_ci" class="form-group">
		<label id="elh_usuario_ci" for="x_ci" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->ci->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->ci->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_ci">
<input type="text" data-table="usuario" data-field="x_ci" name="x_ci" id="x_ci" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($usuario->ci->getPlaceHolder()) ?>" value="<?php echo $usuario->ci->EditValue ?>"<?php echo $usuario->ci->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_ci">
<span<?php echo $usuario->ci->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->ci->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_ci" name="x_ci" id="x_ci" value="<?php echo ew_HtmlEncode($usuario->ci->FormValue) ?>">
<?php } ?>
<?php echo $usuario->ci->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ci">
		<td class="col-sm-3"><span id="elh_usuario_ci"><?php echo $usuario->ci->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->ci->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_ci">
<input type="text" data-table="usuario" data-field="x_ci" name="x_ci" id="x_ci" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($usuario->ci->getPlaceHolder()) ?>" value="<?php echo $usuario->ci->EditValue ?>"<?php echo $usuario->ci->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_ci">
<span<?php echo $usuario->ci->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->ci->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_ci" name="x_ci" id="x_ci" value="<?php echo ew_HtmlEncode($usuario->ci->FormValue) ?>">
<?php } ?>
<?php echo $usuario->ci->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->id_sucursal->Visible) { // id_sucursal ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_id_sucursal" class="form-group">
		<label id="elh_usuario_id_sucursal" for="x_id_sucursal" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->id_sucursal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->id_sucursal->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_id_sucursal">
<select data-table="usuario" data-field="x_id_sucursal" data-value-separator="<?php echo $usuario->id_sucursal->DisplayValueSeparatorAttribute() ?>" id="x_id_sucursal" name="x_id_sucursal"<?php echo $usuario->id_sucursal->EditAttributes() ?>>
<?php echo $usuario->id_sucursal->SelectOptionListHtml("x_id_sucursal") ?>
</select>
</span>
<?php } else { ?>
<span id="el_usuario_id_sucursal">
<span<?php echo $usuario->id_sucursal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->id_sucursal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_id_sucursal" name="x_id_sucursal" id="x_id_sucursal" value="<?php echo ew_HtmlEncode($usuario->id_sucursal->FormValue) ?>">
<?php } ?>
<?php echo $usuario->id_sucursal->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_sucursal">
		<td class="col-sm-3"><span id="elh_usuario_id_sucursal"><?php echo $usuario->id_sucursal->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->id_sucursal->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_id_sucursal">
<select data-table="usuario" data-field="x_id_sucursal" data-value-separator="<?php echo $usuario->id_sucursal->DisplayValueSeparatorAttribute() ?>" id="x_id_sucursal" name="x_id_sucursal"<?php echo $usuario->id_sucursal->EditAttributes() ?>>
<?php echo $usuario->id_sucursal->SelectOptionListHtml("x_id_sucursal") ?>
</select>
</span>
<?php } else { ?>
<span id="el_usuario_id_sucursal">
<span<?php echo $usuario->id_sucursal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->id_sucursal->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_id_sucursal" name="x_id_sucursal" id="x_id_sucursal" value="<?php echo ew_HtmlEncode($usuario->id_sucursal->FormValue) ?>">
<?php } ?>
<?php echo $usuario->id_sucursal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->_email->Visible) { // email ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r__email" class="form-group">
		<label id="elh_usuario__email" for="x__email" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->_email->FldCaption() ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->_email->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario__email">
<input type="text" data-table="usuario" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($usuario->_email->getPlaceHolder()) ?>" value="<?php echo $usuario->_email->EditValue ?>"<?php echo $usuario->_email->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario__email">
<span<?php echo $usuario->_email->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->_email->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x__email" name="x__email" id="x__email" value="<?php echo ew_HtmlEncode($usuario->_email->FormValue) ?>">
<?php } ?>
<?php echo $usuario->_email->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r__email">
		<td class="col-sm-3"><span id="elh_usuario__email"><?php echo $usuario->_email->FldCaption() ?></span></td>
		<td<?php echo $usuario->_email->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario__email">
<input type="text" data-table="usuario" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($usuario->_email->getPlaceHolder()) ?>" value="<?php echo $usuario->_email->EditValue ?>"<?php echo $usuario->_email->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario__email">
<span<?php echo $usuario->_email->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->_email->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x__email" name="x__email" id="x__email" value="<?php echo ew_HtmlEncode($usuario->_email->FormValue) ?>">
<?php } ?>
<?php echo $usuario->_email->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->telefono_fijo01->Visible) { // telefono_fijo01 ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_telefono_fijo01" class="form-group">
		<label id="elh_usuario_telefono_fijo01" for="x_telefono_fijo01" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->telefono_fijo01->FldCaption() ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->telefono_fijo01->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_telefono_fijo01">
<input type="text" data-table="usuario" data-field="x_telefono_fijo01" name="x_telefono_fijo01" id="x_telefono_fijo01" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->telefono_fijo01->getPlaceHolder()) ?>" value="<?php echo $usuario->telefono_fijo01->EditValue ?>"<?php echo $usuario->telefono_fijo01->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_telefono_fijo01">
<span<?php echo $usuario->telefono_fijo01->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->telefono_fijo01->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_telefono_fijo01" name="x_telefono_fijo01" id="x_telefono_fijo01" value="<?php echo ew_HtmlEncode($usuario->telefono_fijo01->FormValue) ?>">
<?php } ?>
<?php echo $usuario->telefono_fijo01->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_telefono_fijo01">
		<td class="col-sm-3"><span id="elh_usuario_telefono_fijo01"><?php echo $usuario->telefono_fijo01->FldCaption() ?></span></td>
		<td<?php echo $usuario->telefono_fijo01->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_telefono_fijo01">
<input type="text" data-table="usuario" data-field="x_telefono_fijo01" name="x_telefono_fijo01" id="x_telefono_fijo01" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->telefono_fijo01->getPlaceHolder()) ?>" value="<?php echo $usuario->telefono_fijo01->EditValue ?>"<?php echo $usuario->telefono_fijo01->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_telefono_fijo01">
<span<?php echo $usuario->telefono_fijo01->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->telefono_fijo01->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_telefono_fijo01" name="x_telefono_fijo01" id="x_telefono_fijo01" value="<?php echo ew_HtmlEncode($usuario->telefono_fijo01->FormValue) ?>">
<?php } ?>
<?php echo $usuario->telefono_fijo01->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->telefono_fijo02->Visible) { // telefono_fijo02 ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_telefono_fijo02" class="form-group">
		<label id="elh_usuario_telefono_fijo02" for="x_telefono_fijo02" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->telefono_fijo02->FldCaption() ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->telefono_fijo02->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_telefono_fijo02">
<input type="text" data-table="usuario" data-field="x_telefono_fijo02" name="x_telefono_fijo02" id="x_telefono_fijo02" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->telefono_fijo02->getPlaceHolder()) ?>" value="<?php echo $usuario->telefono_fijo02->EditValue ?>"<?php echo $usuario->telefono_fijo02->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_telefono_fijo02">
<span<?php echo $usuario->telefono_fijo02->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->telefono_fijo02->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_telefono_fijo02" name="x_telefono_fijo02" id="x_telefono_fijo02" value="<?php echo ew_HtmlEncode($usuario->telefono_fijo02->FormValue) ?>">
<?php } ?>
<?php echo $usuario->telefono_fijo02->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_telefono_fijo02">
		<td class="col-sm-3"><span id="elh_usuario_telefono_fijo02"><?php echo $usuario->telefono_fijo02->FldCaption() ?></span></td>
		<td<?php echo $usuario->telefono_fijo02->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_telefono_fijo02">
<input type="text" data-table="usuario" data-field="x_telefono_fijo02" name="x_telefono_fijo02" id="x_telefono_fijo02" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->telefono_fijo02->getPlaceHolder()) ?>" value="<?php echo $usuario->telefono_fijo02->EditValue ?>"<?php echo $usuario->telefono_fijo02->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_telefono_fijo02">
<span<?php echo $usuario->telefono_fijo02->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->telefono_fijo02->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_telefono_fijo02" name="x_telefono_fijo02" id="x_telefono_fijo02" value="<?php echo ew_HtmlEncode($usuario->telefono_fijo02->FormValue) ?>">
<?php } ?>
<?php echo $usuario->telefono_fijo02->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->celular->Visible) { // celular ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_celular" class="form-group">
		<label id="elh_usuario_celular" for="x_celular" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->celular->FldCaption() ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->celular->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_celular">
<input type="text" data-table="usuario" data-field="x_celular" name="x_celular" id="x_celular" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->celular->getPlaceHolder()) ?>" value="<?php echo $usuario->celular->EditValue ?>"<?php echo $usuario->celular->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_celular">
<span<?php echo $usuario->celular->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->celular->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_celular" name="x_celular" id="x_celular" value="<?php echo ew_HtmlEncode($usuario->celular->FormValue) ?>">
<?php } ?>
<?php echo $usuario->celular->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_celular">
		<td class="col-sm-3"><span id="elh_usuario_celular"><?php echo $usuario->celular->FldCaption() ?></span></td>
		<td<?php echo $usuario->celular->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_celular">
<input type="text" data-table="usuario" data-field="x_celular" name="x_celular" id="x_celular" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->celular->getPlaceHolder()) ?>" value="<?php echo $usuario->celular->EditValue ?>"<?php echo $usuario->celular->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_celular">
<span<?php echo $usuario->celular->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->celular->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_celular" name="x_celular" id="x_celular" value="<?php echo ew_HtmlEncode($usuario->celular->FormValue) ?>">
<?php } ?>
<?php echo $usuario->celular->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->cargo->Visible) { // cargo ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_cargo" class="form-group">
		<label id="elh_usuario_cargo" for="x_cargo" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->cargo->FldCaption() ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->cargo->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_cargo">
<input type="text" data-table="usuario" data-field="x_cargo" name="x_cargo" id="x_cargo" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->cargo->getPlaceHolder()) ?>" value="<?php echo $usuario->cargo->EditValue ?>"<?php echo $usuario->cargo->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_cargo">
<span<?php echo $usuario->cargo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->cargo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_cargo" name="x_cargo" id="x_cargo" value="<?php echo ew_HtmlEncode($usuario->cargo->FormValue) ?>">
<?php } ?>
<?php echo $usuario->cargo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cargo">
		<td class="col-sm-3"><span id="elh_usuario_cargo"><?php echo $usuario->cargo->FldCaption() ?></span></td>
		<td<?php echo $usuario->cargo->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_cargo">
<input type="text" data-table="usuario" data-field="x_cargo" name="x_cargo" id="x_cargo" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->cargo->getPlaceHolder()) ?>" value="<?php echo $usuario->cargo->EditValue ?>"<?php echo $usuario->cargo->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_cargo">
<span<?php echo $usuario->cargo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->cargo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_cargo" name="x_cargo" id="x_cargo" value="<?php echo ew_HtmlEncode($usuario->cargo->FormValue) ?>">
<?php } ?>
<?php echo $usuario->cargo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->id_institucion->Visible) { // id_institucion ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_id_institucion" class="form-group">
		<label id="elh_usuario_id_institucion" for="x_id_institucion" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->id_institucion->FldCaption() ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->id_institucion->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_id_institucion">
<select data-table="usuario" data-field="x_id_institucion" data-value-separator="<?php echo $usuario->id_institucion->DisplayValueSeparatorAttribute() ?>" id="x_id_institucion" name="x_id_institucion"<?php echo $usuario->id_institucion->EditAttributes() ?>>
<?php echo $usuario->id_institucion->SelectOptionListHtml("x_id_institucion") ?>
</select>
</span>
<?php } else { ?>
<span id="el_usuario_id_institucion">
<span<?php echo $usuario->id_institucion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->id_institucion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_id_institucion" name="x_id_institucion" id="x_id_institucion" value="<?php echo ew_HtmlEncode($usuario->id_institucion->FormValue) ?>">
<?php } ?>
<?php echo $usuario->id_institucion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_institucion">
		<td class="col-sm-3"><span id="elh_usuario_id_institucion"><?php echo $usuario->id_institucion->FldCaption() ?></span></td>
		<td<?php echo $usuario->id_institucion->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_id_institucion">
<select data-table="usuario" data-field="x_id_institucion" data-value-separator="<?php echo $usuario->id_institucion->DisplayValueSeparatorAttribute() ?>" id="x_id_institucion" name="x_id_institucion"<?php echo $usuario->id_institucion->EditAttributes() ?>>
<?php echo $usuario->id_institucion->SelectOptionListHtml("x_id_institucion") ?>
</select>
</span>
<?php } else { ?>
<span id="el_usuario_id_institucion">
<span<?php echo $usuario->id_institucion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->id_institucion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_id_institucion" name="x_id_institucion" id="x_id_institucion" value="<?php echo ew_HtmlEncode($usuario->id_institucion->FormValue) ?>">
<?php } ?>
<?php echo $usuario->id_institucion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->celular2->Visible) { // celular2 ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_celular2" class="form-group">
		<label id="elh_usuario_celular2" for="x_celular2" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->celular2->FldCaption() ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->celular2->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_celular2">
<input type="text" data-table="usuario" data-field="x_celular2" name="x_celular2" id="x_celular2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->celular2->getPlaceHolder()) ?>" value="<?php echo $usuario->celular2->EditValue ?>"<?php echo $usuario->celular2->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_celular2">
<span<?php echo $usuario->celular2->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->celular2->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_celular2" name="x_celular2" id="x_celular2" value="<?php echo ew_HtmlEncode($usuario->celular2->FormValue) ?>">
<?php } ?>
<?php echo $usuario->celular2->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_celular2">
		<td class="col-sm-3"><span id="elh_usuario_celular2"><?php echo $usuario->celular2->FldCaption() ?></span></td>
		<td<?php echo $usuario->celular2->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_celular2">
<input type="text" data-table="usuario" data-field="x_celular2" name="x_celular2" id="x_celular2" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->celular2->getPlaceHolder()) ?>" value="<?php echo $usuario->celular2->EditValue ?>"<?php echo $usuario->celular2->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_celular2">
<span<?php echo $usuario->celular2->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->celular2->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_celular2" name="x_celular2" id="x_celular2" value="<?php echo ew_HtmlEncode($usuario->celular2->FormValue) ?>">
<?php } ?>
<?php echo $usuario->celular2->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->direccion->Visible) { // direccion ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_direccion" class="form-group">
		<label id="elh_usuario_direccion" for="x_direccion" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->direccion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->direccion->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_direccion">
<textarea data-table="usuario" data-field="x_direccion" name="x_direccion" id="x_direccion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($usuario->direccion->getPlaceHolder()) ?>"<?php echo $usuario->direccion->EditAttributes() ?>><?php echo $usuario->direccion->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_usuario_direccion">
<span<?php echo $usuario->direccion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->direccion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_direccion" name="x_direccion" id="x_direccion" value="<?php echo ew_HtmlEncode($usuario->direccion->FormValue) ?>">
<?php } ?>
<?php echo $usuario->direccion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_direccion">
		<td class="col-sm-3"><span id="elh_usuario_direccion"><?php echo $usuario->direccion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $usuario->direccion->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_direccion">
<textarea data-table="usuario" data-field="x_direccion" name="x_direccion" id="x_direccion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($usuario->direccion->getPlaceHolder()) ?>"<?php echo $usuario->direccion->EditAttributes() ?>><?php echo $usuario->direccion->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el_usuario_direccion">
<span<?php echo $usuario->direccion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->direccion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_direccion" name="x_direccion" id="x_direccion" value="<?php echo ew_HtmlEncode($usuario->direccion->FormValue) ?>">
<?php } ?>
<?php echo $usuario->direccion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->especialidad->Visible) { // especialidad ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_especialidad" class="form-group">
		<label id="elh_usuario_especialidad" for="x_especialidad" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->especialidad->FldCaption() ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->especialidad->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_especialidad">
<input type="text" data-table="usuario" data-field="x_especialidad" name="x_especialidad" id="x_especialidad" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->especialidad->getPlaceHolder()) ?>" value="<?php echo $usuario->especialidad->EditValue ?>"<?php echo $usuario->especialidad->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_especialidad">
<span<?php echo $usuario->especialidad->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->especialidad->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_especialidad" name="x_especialidad" id="x_especialidad" value="<?php echo ew_HtmlEncode($usuario->especialidad->FormValue) ?>">
<?php } ?>
<?php echo $usuario->especialidad->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_especialidad">
		<td class="col-sm-3"><span id="elh_usuario_especialidad"><?php echo $usuario->especialidad->FldCaption() ?></span></td>
		<td<?php echo $usuario->especialidad->CellAttributes() ?>>
<?php if ($usuario->CurrentAction <> "F") { ?>
<span id="el_usuario_especialidad">
<input type="text" data-table="usuario" data-field="x_especialidad" name="x_especialidad" id="x_especialidad" size="30" maxlength="100" placeholder="<?php echo ew_HtmlEncode($usuario->especialidad->getPlaceHolder()) ?>" value="<?php echo $usuario->especialidad->EditValue ?>"<?php echo $usuario->especialidad->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el_usuario_especialidad">
<span<?php echo $usuario->especialidad->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $usuario->especialidad->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="usuario" data-field="x_especialidad" name="x_especialidad" id="x_especialidad" value="<?php echo ew_HtmlEncode($usuario->especialidad->FormValue) ?>">
<?php } ?>
<?php echo $usuario->especialidad->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($usuario->avatar->Visible) { // avatar ?>
<?php if (ew_IsMobile()) { ?>
	<div id="r_avatar" class="form-group">
		<label id="elh_usuario_avatar" class="<?php echo $register->LeftColumnClass ?>"><?php echo $usuario->avatar->FldCaption() ?></label>
		<div class="<?php echo $register->RightColumnClass ?>"><div<?php echo $usuario->avatar->CellAttributes() ?>>
<span id="el_usuario_avatar">
<div id="fd_x_avatar">
<span title="<?php echo $usuario->avatar->FldTitle() ? $usuario->avatar->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($usuario->avatar->ReadOnly || $usuario->avatar->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="usuario" data-field="x_avatar" name="x_avatar" id="x_avatar"<?php echo $usuario->avatar->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_avatar" id= "fn_x_avatar" value="<?php echo $usuario->avatar->Upload->FileName ?>">
<input type="hidden" name="fa_x_avatar" id= "fa_x_avatar" value="0">
<input type="hidden" name="fs_x_avatar" id= "fs_x_avatar" value="0">
<input type="hidden" name="fx_x_avatar" id= "fx_x_avatar" value="<?php echo $usuario->avatar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_avatar" id= "fm_x_avatar" value="<?php echo $usuario->avatar->UploadMaxFileSize ?>">
</div>
<table id="ft_x_avatar" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $usuario->avatar->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_avatar">
		<td class="col-sm-3"><span id="elh_usuario_avatar"><?php echo $usuario->avatar->FldCaption() ?></span></td>
		<td<?php echo $usuario->avatar->CellAttributes() ?>>
<span id="el_usuario_avatar">
<div id="fd_x_avatar">
<span title="<?php echo $usuario->avatar->FldTitle() ? $usuario->avatar->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($usuario->avatar->ReadOnly || $usuario->avatar->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="usuario" data-field="x_avatar" name="x_avatar" id="x_avatar"<?php echo $usuario->avatar->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_avatar" id= "fn_x_avatar" value="<?php echo $usuario->avatar->Upload->FileName ?>">
<input type="hidden" name="fa_x_avatar" id= "fa_x_avatar" value="0">
<input type="hidden" name="fs_x_avatar" id= "fs_x_avatar" value="0">
<input type="hidden" name="fx_x_avatar" id= "fx_x_avatar" value="<?php echo $usuario->avatar->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_avatar" id= "fm_x_avatar" value="<?php echo $usuario->avatar->UploadMaxFileSize ?>">
</div>
<table id="ft_x_avatar" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $usuario->avatar->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if (ew_IsMobile()) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $register->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($usuario->CurrentAction <> "F") { // Confirm page ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit" onclick="this.form.a_register.value='F';"><?php echo $Language->Phrase("RegisterBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="submit" onclick="this.form.a_register.value='X';"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php if (!ew_IsMobile()) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fregister.Init();
</script>
<?php
$register->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$register->Page_Terminate();
?>
