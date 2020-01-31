<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "viewavaluoinspectorhistoricoinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$viewavaluoinspectorhistorico_edit = NULL; // Initialize page object first

class cviewavaluoinspectorhistorico_edit extends cviewavaluoinspectorhistorico {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewavaluoinspectorhistorico';

	// Page object name
	var $PageObjName = 'viewavaluoinspectorhistorico_edit';

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

		// Table object (viewavaluoinspectorhistorico)
		if (!isset($GLOBALS["viewavaluoinspectorhistorico"]) || get_class($GLOBALS["viewavaluoinspectorhistorico"]) == "cviewavaluoinspectorhistorico") {
			$GLOBALS["viewavaluoinspectorhistorico"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["viewavaluoinspectorhistorico"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'viewavaluoinspectorhistorico', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("viewavaluoinspectorhistoricolist.php"));
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
		$this->codigoavaluo->SetVisibility();
		$this->id_solicitud->SetVisibility();
		$this->id_oficialcredito->SetVisibility();
		$this->id_inspector->SetVisibility();
		$this->id_cliente->SetVisibility();
		$this->estadointerno->SetVisibility();
		$this->comentario->SetVisibility();
		$this->id_sucursal->SetVisibility();

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
		global $EW_EXPORT, $viewavaluoinspectorhistorico;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($viewavaluoinspectorhistorico);
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
					if ($pageName == "viewavaluoinspectorhistoricoview.php")
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
					$this->Page_Terminate("viewavaluoinspectorhistoricolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = "viewavaluoinspectorhistoricolist.php";
				if (ew_GetPageName($sReturnUrl) == "viewavaluoinspectorhistoricolist.php")
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
		if (!$this->codigoavaluo->FldIsDetailKey) {
			$this->codigoavaluo->setFormValue($objForm->GetValue("x_codigoavaluo"));
		}
		if (!$this->id_solicitud->FldIsDetailKey) {
			$this->id_solicitud->setFormValue($objForm->GetValue("x_id_solicitud"));
		}
		if (!$this->id_oficialcredito->FldIsDetailKey) {
			$this->id_oficialcredito->setFormValue($objForm->GetValue("x_id_oficialcredito"));
		}
		if (!$this->id_inspector->FldIsDetailKey) {
			$this->id_inspector->setFormValue($objForm->GetValue("x_id_inspector"));
		}
		if (!$this->id_cliente->FldIsDetailKey) {
			$this->id_cliente->setFormValue($objForm->GetValue("x_id_cliente"));
		}
		if (!$this->estadointerno->FldIsDetailKey) {
			$this->estadointerno->setFormValue($objForm->GetValue("x_estadointerno"));
		}
		if (!$this->comentario->FldIsDetailKey) {
			$this->comentario->setFormValue($objForm->GetValue("x_comentario"));
		}
		if (!$this->id_sucursal->FldIsDetailKey) {
			$this->id_sucursal->setFormValue($objForm->GetValue("x_id_sucursal"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->codigoavaluo->CurrentValue = $this->codigoavaluo->FormValue;
		$this->id_solicitud->CurrentValue = $this->id_solicitud->FormValue;
		$this->id_oficialcredito->CurrentValue = $this->id_oficialcredito->FormValue;
		$this->id_inspector->CurrentValue = $this->id_inspector->FormValue;
		$this->id_cliente->CurrentValue = $this->id_cliente->FormValue;
		$this->estadointerno->CurrentValue = $this->estadointerno->FormValue;
		$this->comentario->CurrentValue = $this->comentario->FormValue;
		$this->id_sucursal->CurrentValue = $this->id_sucursal->FormValue;
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
		$this->tipoinmueble->setDbValue($row['tipoinmueble']);
		$this->codigoavaluo->setDbValue($row['codigoavaluo']);
		$this->id_solicitud->setDbValue($row['id_solicitud']);
		$this->id_oficialcredito->setDbValue($row['id_oficialcredito']);
		if (array_key_exists('EV__id_oficialcredito', $rs->fields)) {
			$this->id_oficialcredito->VirtualValue = $rs->fields('EV__id_oficialcredito'); // Set up virtual field value
		} else {
			$this->id_oficialcredito->VirtualValue = ""; // Clear value
		}
		$this->id_inspector->setDbValue($row['id_inspector']);
		if (array_key_exists('EV__id_inspector', $rs->fields)) {
			$this->id_inspector->VirtualValue = $rs->fields('EV__id_inspector'); // Set up virtual field value
		} else {
			$this->id_inspector->VirtualValue = ""; // Clear value
		}
		$this->id_cliente->setDbValue($row['id_cliente']);
		$this->is_active->setDbValue($row['is_active']);
		$this->estado->setDbValue($row['estado']);
		$this->estadointerno->setDbValue($row['estadointerno']);
		$this->estadopago->setDbValue($row['estadopago']);
		$this->fecha_avaluo->setDbValue($row['fecha_avaluo']);
		$this->montoincial->setDbValue($row['montoincial']);
		$this->id_metodopago->setDbValue($row['id_metodopago']);
		$this->created_at->setDbValue($row['created_at']);
		$this->DateModified->setDbValue($row['DateModified']);
		$this->DateDeleted->setDbValue($row['DateDeleted']);
		$this->CreatedBy->setDbValue($row['CreatedBy']);
		$this->ModifiedBy->setDbValue($row['ModifiedBy']);
		$this->DeletedBy->setDbValue($row['DeletedBy']);
		$this->comentario->setDbValue($row['comentario']);
		$this->id_sucursal->setDbValue($row['id_sucursal']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['tipoinmueble'] = NULL;
		$row['codigoavaluo'] = NULL;
		$row['id_solicitud'] = NULL;
		$row['id_oficialcredito'] = NULL;
		$row['id_inspector'] = NULL;
		$row['id_cliente'] = NULL;
		$row['is_active'] = NULL;
		$row['estado'] = NULL;
		$row['estadointerno'] = NULL;
		$row['estadopago'] = NULL;
		$row['fecha_avaluo'] = NULL;
		$row['montoincial'] = NULL;
		$row['id_metodopago'] = NULL;
		$row['created_at'] = NULL;
		$row['DateModified'] = NULL;
		$row['DateDeleted'] = NULL;
		$row['CreatedBy'] = NULL;
		$row['ModifiedBy'] = NULL;
		$row['DeletedBy'] = NULL;
		$row['comentario'] = NULL;
		$row['id_sucursal'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->tipoinmueble->DbValue = $row['tipoinmueble'];
		$this->codigoavaluo->DbValue = $row['codigoavaluo'];
		$this->id_solicitud->DbValue = $row['id_solicitud'];
		$this->id_oficialcredito->DbValue = $row['id_oficialcredito'];
		$this->id_inspector->DbValue = $row['id_inspector'];
		$this->id_cliente->DbValue = $row['id_cliente'];
		$this->is_active->DbValue = $row['is_active'];
		$this->estado->DbValue = $row['estado'];
		$this->estadointerno->DbValue = $row['estadointerno'];
		$this->estadopago->DbValue = $row['estadopago'];
		$this->fecha_avaluo->DbValue = $row['fecha_avaluo'];
		$this->montoincial->DbValue = $row['montoincial'];
		$this->id_metodopago->DbValue = $row['id_metodopago'];
		$this->created_at->DbValue = $row['created_at'];
		$this->DateModified->DbValue = $row['DateModified'];
		$this->DateDeleted->DbValue = $row['DateDeleted'];
		$this->CreatedBy->DbValue = $row['CreatedBy'];
		$this->ModifiedBy->DbValue = $row['ModifiedBy'];
		$this->DeletedBy->DbValue = $row['DeletedBy'];
		$this->comentario->DbValue = $row['comentario'];
		$this->id_sucursal->DbValue = $row['id_sucursal'];
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
		// tipoinmueble
		// codigoavaluo
		// id_solicitud
		// id_oficialcredito
		// id_inspector
		// id_cliente
		// is_active
		// estado
		// estadointerno
		// estadopago
		// fecha_avaluo
		// montoincial
		// id_metodopago
		// created_at
		// DateModified
		// DateDeleted
		// CreatedBy
		// ModifiedBy
		// DeletedBy
		// comentario
		// id_sucursal

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// codigoavaluo
		$this->codigoavaluo->ViewValue = $this->codigoavaluo->CurrentValue;
		$this->codigoavaluo->CssStyle = "font-weight: bold;";
		$this->codigoavaluo->ViewCustomAttributes = "";

		// id_solicitud
		if (strval($this->id_solicitud->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
		$sWhereWrk = "";
		$this->id_solicitud->LookupFilters = array();
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
		$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
		$sWhereWrk = "";
		$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
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
		$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
		$sWhereWrk = "";
		$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
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
		$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
		$sWhereWrk = "";
		$this->id_cliente->LookupFilters = array();
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
		$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
		$sWhereWrk = "";
		$this->estado->LookupFilters = array();
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
		$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
		$sWhereWrk = "";
		$this->estadointerno->LookupFilters = array();
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
		$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
		$sWhereWrk = "";
		$this->estadopago->LookupFilters = array();
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

		// comentario
		$this->comentario->ViewValue = $this->comentario->CurrentValue;
		$this->comentario->ViewCustomAttributes = "";

		// id_sucursal
		$this->id_sucursal->ViewValue = $this->id_sucursal->CurrentValue;
		$this->id_sucursal->ViewCustomAttributes = "";

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

			// estadointerno
			$this->estadointerno->LinkCustomAttributes = "";
			$this->estadointerno->HrefValue = "";
			$this->estadointerno->TooltipValue = "";

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";
			$this->comentario->TooltipValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";
			$this->id_sucursal->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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
			$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
			$sWhereWrk = "";
			$this->id_solicitud->LookupFilters = array();
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
			$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
			$sWhereWrk = "";
			$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
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
			$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
			$sWhereWrk = "";
			$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
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
			$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
			$sWhereWrk = "";
			$this->id_cliente->LookupFilters = array();
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

			// estadointerno
			$this->estadointerno->EditAttrs["class"] = "form-control";
			$this->estadointerno->EditCustomAttributes = "";
			if (trim(strval($this->estadointerno->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->estadointerno->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadointerno`";
			$sWhereWrk = "";
			$this->estadointerno->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->estadointerno, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->estadointerno->EditValue = $arwrk;

			// comentario
			$this->comentario->EditAttrs["class"] = "form-control";
			$this->comentario->EditCustomAttributes = "";
			$this->comentario->EditValue = ew_HtmlEncode($this->comentario->CurrentValue);
			$this->comentario->PlaceHolder = ew_RemoveHtml($this->comentario->FldTitle());

			// id_sucursal
			$this->id_sucursal->EditAttrs["class"] = "form-control";
			$this->id_sucursal->EditCustomAttributes = "";

			// Edit refer script
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

			// estadointerno
			$this->estadointerno->LinkCustomAttributes = "";
			$this->estadointerno->HrefValue = "";

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";
			$this->id_sucursal->TooltipValue = "";
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

			// estadointerno
			$this->estadointerno->SetDbValueDef($rsnew, $this->estadointerno->CurrentValue, NULL, $this->estadointerno->ReadOnly);

			// comentario
			$this->comentario->SetDbValueDef($rsnew, $this->comentario->CurrentValue, NULL, $this->comentario->ReadOnly);

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
		if ($EditRow) {
			if ($this->SendEmail)
				$this->SendEmailOnEdit($rsold, $rsnew);
		}
		$rs->Close();
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("viewavaluoinspectorhistoricolist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_estadointerno":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->estadointerno, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($viewavaluoinspectorhistorico_edit)) $viewavaluoinspectorhistorico_edit = new cviewavaluoinspectorhistorico_edit();

// Page init
$viewavaluoinspectorhistorico_edit->Page_Init();

// Page main
$viewavaluoinspectorhistorico_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewavaluoinspectorhistorico_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fviewavaluoinspectorhistoricoedit = new ew_Form("fviewavaluoinspectorhistoricoedit", "edit");

// Validate form
fviewavaluoinspectorhistoricoedit.Validate = function() {
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
fviewavaluoinspectorhistoricoedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluoinspectorhistoricoedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluoinspectorhistoricoedit.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_id","x_name","x_lastname","x__email"],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
fviewavaluoinspectorhistoricoedit.Lists["x_id_solicitud"].Data = "<?php echo $viewavaluoinspectorhistorico_edit->id_solicitud->LookupFilterQuery(FALSE, "edit") ?>";
fviewavaluoinspectorhistoricoedit.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fviewavaluoinspectorhistoricoedit.Lists["x_id_oficialcredito"].Data = "<?php echo $viewavaluoinspectorhistorico_edit->id_oficialcredito->LookupFilterQuery(FALSE, "edit") ?>";
fviewavaluoinspectorhistoricoedit.AutoSuggests["x_id_oficialcredito"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluoinspectorhistorico_edit->id_oficialcredito->LookupFilterQuery(TRUE, "edit"))) ?>;
fviewavaluoinspectorhistoricoedit.Lists["x_id_inspector"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_apellido","x_nombre","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"inspector"};
fviewavaluoinspectorhistoricoedit.Lists["x_id_inspector"].Data = "<?php echo $viewavaluoinspectorhistorico_edit->id_inspector->LookupFilterQuery(FALSE, "edit") ?>";
fviewavaluoinspectorhistoricoedit.AutoSuggests["x_id_inspector"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluoinspectorhistorico_edit->id_inspector->LookupFilterQuery(TRUE, "edit"))) ?>;
fviewavaluoinspectorhistoricoedit.Lists["x_id_cliente"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cliente"};
fviewavaluoinspectorhistoricoedit.Lists["x_id_cliente"].Data = "<?php echo $viewavaluoinspectorhistorico_edit->id_cliente->LookupFilterQuery(FALSE, "edit") ?>";
fviewavaluoinspectorhistoricoedit.AutoSuggests["x_id_cliente"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluoinspectorhistorico_edit->id_cliente->LookupFilterQuery(TRUE, "edit"))) ?>;
fviewavaluoinspectorhistoricoedit.Lists["x_estadointerno"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadointerno"};
fviewavaluoinspectorhistoricoedit.Lists["x_estadointerno"].Data = "<?php echo $viewavaluoinspectorhistorico_edit->estadointerno->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $viewavaluoinspectorhistorico_edit->ShowPageHeader(); ?>
<?php
$viewavaluoinspectorhistorico_edit->ShowMessage();
?>
<form name="fviewavaluoinspectorhistoricoedit" id="fviewavaluoinspectorhistoricoedit" class="<?php echo $viewavaluoinspectorhistorico_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewavaluoinspectorhistorico_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewavaluoinspectorhistorico_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewavaluoinspectorhistorico">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($viewavaluoinspectorhistorico_edit->IsModal) ?>">
<?php if (!$viewavaluoinspectorhistorico_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($viewavaluoinspectorhistorico_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_viewavaluoinspectorhistoricoedit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->codigoavaluo->Visible) { // codigoavaluo ?>
<?php if ($viewavaluoinspectorhistorico_edit->IsMobileOrModal) { ?>
	<div id="r_codigoavaluo" class="form-group">
		<label id="elh_viewavaluoinspectorhistorico_codigoavaluo" for="x_codigoavaluo" class="<?php echo $viewavaluoinspectorhistorico_edit->LeftColumnClass ?>"><?php echo $viewavaluoinspectorhistorico->codigoavaluo->FldCaption() ?></label>
		<div class="<?php echo $viewavaluoinspectorhistorico_edit->RightColumnClass ?>"><div<?php echo $viewavaluoinspectorhistorico->codigoavaluo->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_codigoavaluo">
<span<?php echo $viewavaluoinspectorhistorico->codigoavaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->codigoavaluo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_codigoavaluo" name="x_codigoavaluo" id="x_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->codigoavaluo->CurrentValue) ?>">
<?php echo $viewavaluoinspectorhistorico->codigoavaluo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_codigoavaluo">
		<td class="col-sm-3"><span id="elh_viewavaluoinspectorhistorico_codigoavaluo"><?php echo $viewavaluoinspectorhistorico->codigoavaluo->FldCaption() ?></span></td>
		<td<?php echo $viewavaluoinspectorhistorico->codigoavaluo->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_codigoavaluo">
<span<?php echo $viewavaluoinspectorhistorico->codigoavaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->codigoavaluo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_codigoavaluo" name="x_codigoavaluo" id="x_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->codigoavaluo->CurrentValue) ?>">
<?php echo $viewavaluoinspectorhistorico->codigoavaluo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->id_solicitud->Visible) { // id_solicitud ?>
<?php if ($viewavaluoinspectorhistorico_edit->IsMobileOrModal) { ?>
	<div id="r_id_solicitud" class="form-group">
		<label id="elh_viewavaluoinspectorhistorico_id_solicitud" for="x_id_solicitud" class="<?php echo $viewavaluoinspectorhistorico_edit->LeftColumnClass ?>"><?php echo $viewavaluoinspectorhistorico->id_solicitud->FldCaption() ?></label>
		<div class="<?php echo $viewavaluoinspectorhistorico_edit->RightColumnClass ?>"><div<?php echo $viewavaluoinspectorhistorico->id_solicitud->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_id_solicitud">
<span<?php echo $viewavaluoinspectorhistorico->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->id_solicitud->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_solicitud" name="x_id_solicitud" id="x_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_solicitud->CurrentValue) ?>">
<?php echo $viewavaluoinspectorhistorico->id_solicitud->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_solicitud">
		<td class="col-sm-3"><span id="elh_viewavaluoinspectorhistorico_id_solicitud"><?php echo $viewavaluoinspectorhistorico->id_solicitud->FldCaption() ?></span></td>
		<td<?php echo $viewavaluoinspectorhistorico->id_solicitud->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_id_solicitud">
<span<?php echo $viewavaluoinspectorhistorico->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->id_solicitud->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_solicitud" name="x_id_solicitud" id="x_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_solicitud->CurrentValue) ?>">
<?php echo $viewavaluoinspectorhistorico->id_solicitud->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->id_oficialcredito->Visible) { // id_oficialcredito ?>
<?php if ($viewavaluoinspectorhistorico_edit->IsMobileOrModal) { ?>
	<div id="r_id_oficialcredito" class="form-group">
		<label id="elh_viewavaluoinspectorhistorico_id_oficialcredito" class="<?php echo $viewavaluoinspectorhistorico_edit->LeftColumnClass ?>"><?php echo $viewavaluoinspectorhistorico->id_oficialcredito->FldCaption() ?></label>
		<div class="<?php echo $viewavaluoinspectorhistorico_edit->RightColumnClass ?>"><div<?php echo $viewavaluoinspectorhistorico->id_oficialcredito->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_id_oficialcredito">
<span<?php echo $viewavaluoinspectorhistorico->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->id_oficialcredito->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_oficialcredito" name="x_id_oficialcredito" id="x_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_oficialcredito->CurrentValue) ?>">
<?php echo $viewavaluoinspectorhistorico->id_oficialcredito->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_oficialcredito">
		<td class="col-sm-3"><span id="elh_viewavaluoinspectorhistorico_id_oficialcredito"><?php echo $viewavaluoinspectorhistorico->id_oficialcredito->FldCaption() ?></span></td>
		<td<?php echo $viewavaluoinspectorhistorico->id_oficialcredito->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_id_oficialcredito">
<span<?php echo $viewavaluoinspectorhistorico->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->id_oficialcredito->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_oficialcredito" name="x_id_oficialcredito" id="x_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_oficialcredito->CurrentValue) ?>">
<?php echo $viewavaluoinspectorhistorico->id_oficialcredito->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->id_inspector->Visible) { // id_inspector ?>
<?php if ($viewavaluoinspectorhistorico_edit->IsMobileOrModal) { ?>
	<div id="r_id_inspector" class="form-group">
		<label id="elh_viewavaluoinspectorhistorico_id_inspector" class="<?php echo $viewavaluoinspectorhistorico_edit->LeftColumnClass ?>"><?php echo $viewavaluoinspectorhistorico->id_inspector->FldCaption() ?></label>
		<div class="<?php echo $viewavaluoinspectorhistorico_edit->RightColumnClass ?>"><div<?php echo $viewavaluoinspectorhistorico->id_inspector->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_id_inspector">
<span<?php echo $viewavaluoinspectorhistorico->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->id_inspector->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_inspector" name="x_id_inspector" id="x_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_inspector->CurrentValue) ?>">
<?php echo $viewavaluoinspectorhistorico->id_inspector->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_inspector">
		<td class="col-sm-3"><span id="elh_viewavaluoinspectorhistorico_id_inspector"><?php echo $viewavaluoinspectorhistorico->id_inspector->FldCaption() ?></span></td>
		<td<?php echo $viewavaluoinspectorhistorico->id_inspector->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_id_inspector">
<span<?php echo $viewavaluoinspectorhistorico->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->id_inspector->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_inspector" name="x_id_inspector" id="x_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_inspector->CurrentValue) ?>">
<?php echo $viewavaluoinspectorhistorico->id_inspector->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->id_cliente->Visible) { // id_cliente ?>
<?php if ($viewavaluoinspectorhistorico_edit->IsMobileOrModal) { ?>
	<div id="r_id_cliente" class="form-group">
		<label id="elh_viewavaluoinspectorhistorico_id_cliente" class="<?php echo $viewavaluoinspectorhistorico_edit->LeftColumnClass ?>"><?php echo $viewavaluoinspectorhistorico->id_cliente->FldCaption() ?></label>
		<div class="<?php echo $viewavaluoinspectorhistorico_edit->RightColumnClass ?>"><div<?php echo $viewavaluoinspectorhistorico->id_cliente->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_id_cliente">
<span<?php echo $viewavaluoinspectorhistorico->id_cliente->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->id_cliente->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_cliente" name="x_id_cliente" id="x_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_cliente->CurrentValue) ?>">
<?php echo $viewavaluoinspectorhistorico->id_cliente->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_cliente">
		<td class="col-sm-3"><span id="elh_viewavaluoinspectorhistorico_id_cliente"><?php echo $viewavaluoinspectorhistorico->id_cliente->FldCaption() ?></span></td>
		<td<?php echo $viewavaluoinspectorhistorico->id_cliente->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_id_cliente">
<span<?php echo $viewavaluoinspectorhistorico->id_cliente->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->id_cliente->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_cliente" name="x_id_cliente" id="x_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_cliente->CurrentValue) ?>">
<?php echo $viewavaluoinspectorhistorico->id_cliente->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->estadointerno->Visible) { // estadointerno ?>
<?php if ($viewavaluoinspectorhistorico_edit->IsMobileOrModal) { ?>
	<div id="r_estadointerno" class="form-group">
		<label id="elh_viewavaluoinspectorhistorico_estadointerno" for="x_estadointerno" class="<?php echo $viewavaluoinspectorhistorico_edit->LeftColumnClass ?>"><?php echo $viewavaluoinspectorhistorico->estadointerno->FldCaption() ?></label>
		<div class="<?php echo $viewavaluoinspectorhistorico_edit->RightColumnClass ?>"><div<?php echo $viewavaluoinspectorhistorico->estadointerno->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_estadointerno">
<select data-table="viewavaluoinspectorhistorico" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluoinspectorhistorico->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x_estadointerno" name="x_estadointerno"<?php echo $viewavaluoinspectorhistorico->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->estadointerno->SelectOptionListHtml("x_estadointerno") ?>
</select>
</span>
<?php echo $viewavaluoinspectorhistorico->estadointerno->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_estadointerno">
		<td class="col-sm-3"><span id="elh_viewavaluoinspectorhistorico_estadointerno"><?php echo $viewavaluoinspectorhistorico->estadointerno->FldCaption() ?></span></td>
		<td<?php echo $viewavaluoinspectorhistorico->estadointerno->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_estadointerno">
<select data-table="viewavaluoinspectorhistorico" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluoinspectorhistorico->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x_estadointerno" name="x_estadointerno"<?php echo $viewavaluoinspectorhistorico->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->estadointerno->SelectOptionListHtml("x_estadointerno") ?>
</select>
</span>
<?php echo $viewavaluoinspectorhistorico->estadointerno->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->comentario->Visible) { // comentario ?>
<?php if ($viewavaluoinspectorhistorico_edit->IsMobileOrModal) { ?>
	<div id="r_comentario" class="form-group">
		<label id="elh_viewavaluoinspectorhistorico_comentario" for="x_comentario" class="<?php echo $viewavaluoinspectorhistorico_edit->LeftColumnClass ?>"><?php echo $viewavaluoinspectorhistorico->comentario->FldCaption() ?></label>
		<div class="<?php echo $viewavaluoinspectorhistorico_edit->RightColumnClass ?>"><div<?php echo $viewavaluoinspectorhistorico->comentario->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_comentario">
<textarea data-table="viewavaluoinspectorhistorico" data-field="x_comentario" name="x_comentario" id="x_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluoinspectorhistorico->comentario->EditAttributes() ?>><?php echo $viewavaluoinspectorhistorico->comentario->EditValue ?></textarea>
</span>
<?php echo $viewavaluoinspectorhistorico->comentario->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_comentario">
		<td class="col-sm-3"><span id="elh_viewavaluoinspectorhistorico_comentario"><?php echo $viewavaluoinspectorhistorico->comentario->FldCaption() ?></span></td>
		<td<?php echo $viewavaluoinspectorhistorico->comentario->CellAttributes() ?>>
<span id="el_viewavaluoinspectorhistorico_comentario">
<textarea data-table="viewavaluoinspectorhistorico" data-field="x_comentario" name="x_comentario" id="x_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluoinspectorhistorico->comentario->EditAttributes() ?>><?php echo $viewavaluoinspectorhistorico->comentario->EditValue ?></textarea>
</span>
<?php echo $viewavaluoinspectorhistorico->comentario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<span id="el_viewavaluoinspectorhistorico_id_sucursal">
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_sucursal" name="x_id_sucursal" id="x_id_sucursal" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_sucursal->CurrentValue) ?>">
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id->CurrentValue) ?>">
<?php if (!$viewavaluoinspectorhistorico_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $viewavaluoinspectorhistorico_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $viewavaluoinspectorhistorico_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$viewavaluoinspectorhistorico_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fviewavaluoinspectorhistoricoedit.Init();
</script>
<?php
$viewavaluoinspectorhistorico_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$viewavaluoinspectorhistorico_edit->Page_Terminate();
?>
