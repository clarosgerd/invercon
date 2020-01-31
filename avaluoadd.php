<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "avaluoinfo.php" ?>
<?php include_once "solicitudinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "documentosavaluogridcls.php" ?>
<?php include_once "pago_avaluogridcls.php" ?>
<?php include_once "comentariosavaluogridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$avaluo_add = NULL; // Initialize page object first

class cavaluo_add extends cavaluo {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'avaluo';

	// Page object name
	var $PageObjName = 'avaluo_add';

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
	var $AuditTrailOnAdd = TRUE;
	var $AuditTrailOnEdit = TRUE;
	var $AuditTrailOnDelete = TRUE;
	var $AuditTrailOnView = FALSE;
	var $AuditTrailOnViewData = FALSE;
	var $AuditTrailOnSearch = FALSE;

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

		// Table object (avaluo)
		if (!isset($GLOBALS["avaluo"]) || get_class($GLOBALS["avaluo"]) == "cavaluo") {
			$GLOBALS["avaluo"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["avaluo"];
		}

		// Table object (solicitud)
		if (!isset($GLOBALS['solicitud'])) $GLOBALS['solicitud'] = new csolicitud();

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'avaluo', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("avaluolist.php"));
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
		$this->tipoinmueble->SetVisibility();
		$this->id_solicitud->SetVisibility();
		$this->id_oficialcredito->SetVisibility();
		$this->monto_pago->SetVisibility();
		$this->comentario->SetVisibility();
		$this->documento_pago->SetVisibility();

		// Set up detail page object
		$this->SetupDetailPages();

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
				if (in_array("documentosavaluo", $DetailTblVar)) {

					// Process auto fill for detail table 'documentosavaluo'
					if (preg_match('/^fdocumentosavaluo(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["documentosavaluo_grid"])) $GLOBALS["documentosavaluo_grid"] = new cdocumentosavaluo_grid;
						$GLOBALS["documentosavaluo_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
				if (in_array("pago_avaluo", $DetailTblVar)) {

					// Process auto fill for detail table 'pago_avaluo'
					if (preg_match('/^fpago_avaluo(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["pago_avaluo_grid"])) $GLOBALS["pago_avaluo_grid"] = new cpago_avaluo_grid;
						$GLOBALS["pago_avaluo_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
				if (in_array("comentariosavaluo", $DetailTblVar)) {

					// Process auto fill for detail table 'comentariosavaluo'
					if (preg_match('/^fcomentariosavaluo(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["comentariosavaluo_grid"])) $GLOBALS["comentariosavaluo_grid"] = new ccomentariosavaluo_grid;
						$GLOBALS["comentariosavaluo_grid"]->Page_Init();
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
		global $EW_EXPORT, $avaluo;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($avaluo);
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
					if ($pageName == "avaluoview.php")
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
	var $DetailPages; // Detail pages object

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

		// Set up master/detail parameters
		$this->SetupMasterParms();

		// Set up current action
		if (@$_POST["a_add"] <> "") {
			$this->CurrentAction = $_POST["a_add"]; // Get form action
		} else { // Not post back

			// Load key values from QueryString
			$this->CopyRecord = TRUE;
			if (@$_GET["id"] != "") {
				$this->id->setQueryStringValue($_GET["id"]);
				$this->setKey("id", $this->id->CurrentValue); // Set up key
			} else {
				$this->setKey("id", ""); // Clear key
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

		// Set up detail parameters
		$this->SetupDetailParms();

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
					$this->Page_Terminate("avaluolist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					if ($this->getCurrentDetailTable() <> "") // Master/detail add
						$sReturnUrl = $this->GetDetailUrl();
					else
						$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "avaluolist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "avaluoview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values

					// Set up detail parameters
					$this->SetupDetailParms();
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
		$this->documento_pago->Upload->Index = $objForm->Index;
		$this->documento_pago->Upload->UploadFile();
	}

	// Load default values
	function LoadDefaultValues() {
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->codigoavaluo->CurrentValue = NULL;
		$this->codigoavaluo->OldValue = $this->codigoavaluo->CurrentValue;
		$this->tipoinmueble->CurrentValue = NULL;
		$this->tipoinmueble->OldValue = $this->tipoinmueble->CurrentValue;
		$this->id_solicitud->CurrentValue = NULL;
		$this->id_solicitud->OldValue = $this->id_solicitud->CurrentValue;
		$this->id_oficialcredito->CurrentValue = NULL;
		$this->id_oficialcredito->OldValue = $this->id_oficialcredito->CurrentValue;
		$this->id_inspector->CurrentValue = NULL;
		$this->id_inspector->OldValue = $this->id_inspector->CurrentValue;
		$this->is_active->CurrentValue = 1;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->id_cliente->CurrentValue = NULL;
		$this->id_cliente->OldValue = $this->id_cliente->CurrentValue;
		$this->estado->CurrentValue = 1;
		$this->estadointerno->CurrentValue = 1;
		$this->estadopago->CurrentValue = 1;
		$this->fecha_avaluo->CurrentValue = NULL;
		$this->fecha_avaluo->OldValue = $this->fecha_avaluo->CurrentValue;
		$this->id_metodopago->CurrentValue = NULL;
		$this->id_metodopago->OldValue = $this->id_metodopago->CurrentValue;
		$this->DateModified->CurrentValue = NULL;
		$this->DateModified->OldValue = $this->DateModified->CurrentValue;
		$this->DateDeleted->CurrentValue = NULL;
		$this->DateDeleted->OldValue = $this->DateDeleted->CurrentValue;
		$this->CreatedBy->CurrentValue = NULL;
		$this->CreatedBy->OldValue = $this->CreatedBy->CurrentValue;
		$this->ModifiedBy->CurrentValue = NULL;
		$this->ModifiedBy->OldValue = $this->ModifiedBy->CurrentValue;
		$this->DeletedBy->CurrentValue = NULL;
		$this->DeletedBy->OldValue = $this->DeletedBy->CurrentValue;
		$this->id_sucursal->CurrentValue = NULL;
		$this->id_sucursal->OldValue = $this->id_sucursal->CurrentValue;
		$this->informe->Upload->DbValue = NULL;
		$this->informe->OldValue = $this->informe->Upload->DbValue;
		$this->monto_pago->CurrentValue = NULL;
		$this->monto_pago->OldValue = $this->monto_pago->CurrentValue;
		$this->montoincial->CurrentValue = NULL;
		$this->montoincial->OldValue = $this->montoincial->CurrentValue;
		$this->comentario->CurrentValue = NULL;
		$this->comentario->OldValue = $this->comentario->CurrentValue;
		$this->documento_pago->Upload->DbValue = NULL;
		$this->documento_pago->OldValue = $this->documento_pago->Upload->DbValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->tipoinmueble->FldIsDetailKey) {
			$this->tipoinmueble->setFormValue($objForm->GetValue("x_tipoinmueble"));
		}
		if (!$this->id_solicitud->FldIsDetailKey) {
			$this->id_solicitud->setFormValue($objForm->GetValue("x_id_solicitud"));
		}
		if (!$this->id_oficialcredito->FldIsDetailKey) {
			$this->id_oficialcredito->setFormValue($objForm->GetValue("x_id_oficialcredito"));
		}
		if (!$this->monto_pago->FldIsDetailKey) {
			$this->monto_pago->setFormValue($objForm->GetValue("x_monto_pago"));
		}
		if (!$this->comentario->FldIsDetailKey) {
			$this->comentario->setFormValue($objForm->GetValue("x_comentario"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->tipoinmueble->CurrentValue = $this->tipoinmueble->FormValue;
		$this->id_solicitud->CurrentValue = $this->id_solicitud->FormValue;
		$this->id_oficialcredito->CurrentValue = $this->id_oficialcredito->FormValue;
		$this->monto_pago->CurrentValue = $this->monto_pago->FormValue;
		$this->comentario->CurrentValue = $this->comentario->FormValue;
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
		$this->codigoavaluo->setDbValue($row['codigoavaluo']);
		$this->tipoinmueble->setDbValue($row['tipoinmueble']);
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
		$this->is_active->setDbValue($row['is_active']);
		$this->created_at->setDbValue($row['created_at']);
		$this->id_cliente->setDbValue($row['id_cliente']);
		$this->estado->setDbValue($row['estado']);
		$this->estadointerno->setDbValue($row['estadointerno']);
		$this->estadopago->setDbValue($row['estadopago']);
		$this->fecha_avaluo->setDbValue($row['fecha_avaluo']);
		$this->id_metodopago->setDbValue($row['id_metodopago']);
		$this->DateModified->setDbValue($row['DateModified']);
		$this->DateDeleted->setDbValue($row['DateDeleted']);
		$this->CreatedBy->setDbValue($row['CreatedBy']);
		$this->ModifiedBy->setDbValue($row['ModifiedBy']);
		$this->DeletedBy->setDbValue($row['DeletedBy']);
		$this->id_sucursal->setDbValue($row['id_sucursal']);
		$this->informe->Upload->DbValue = $row['informe'];
		if (is_array($this->informe->Upload->DbValue) || is_object($this->informe->Upload->DbValue)) // Byte array
			$this->informe->Upload->DbValue = ew_BytesToStr($this->informe->Upload->DbValue);
		$this->monto_pago->setDbValue($row['monto_pago']);
		$this->montoincial->setDbValue($row['montoincial']);
		$this->comentario->setDbValue($row['comentario']);
		$this->documento_pago->Upload->DbValue = $row['documento_pago'];
		if (is_array($this->documento_pago->Upload->DbValue) || is_object($this->documento_pago->Upload->DbValue)) // Byte array
			$this->documento_pago->Upload->DbValue = ew_BytesToStr($this->documento_pago->Upload->DbValue);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['id'] = $this->id->CurrentValue;
		$row['codigoavaluo'] = $this->codigoavaluo->CurrentValue;
		$row['tipoinmueble'] = $this->tipoinmueble->CurrentValue;
		$row['id_solicitud'] = $this->id_solicitud->CurrentValue;
		$row['id_oficialcredito'] = $this->id_oficialcredito->CurrentValue;
		$row['id_inspector'] = $this->id_inspector->CurrentValue;
		$row['is_active'] = $this->is_active->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		$row['id_cliente'] = $this->id_cliente->CurrentValue;
		$row['estado'] = $this->estado->CurrentValue;
		$row['estadointerno'] = $this->estadointerno->CurrentValue;
		$row['estadopago'] = $this->estadopago->CurrentValue;
		$row['fecha_avaluo'] = $this->fecha_avaluo->CurrentValue;
		$row['id_metodopago'] = $this->id_metodopago->CurrentValue;
		$row['DateModified'] = $this->DateModified->CurrentValue;
		$row['DateDeleted'] = $this->DateDeleted->CurrentValue;
		$row['CreatedBy'] = $this->CreatedBy->CurrentValue;
		$row['ModifiedBy'] = $this->ModifiedBy->CurrentValue;
		$row['DeletedBy'] = $this->DeletedBy->CurrentValue;
		$row['id_sucursal'] = $this->id_sucursal->CurrentValue;
		$row['informe'] = $this->informe->Upload->DbValue;
		$row['monto_pago'] = $this->monto_pago->CurrentValue;
		$row['montoincial'] = $this->montoincial->CurrentValue;
		$row['comentario'] = $this->comentario->CurrentValue;
		$row['documento_pago'] = $this->documento_pago->Upload->DbValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->codigoavaluo->DbValue = $row['codigoavaluo'];
		$this->tipoinmueble->DbValue = $row['tipoinmueble'];
		$this->id_solicitud->DbValue = $row['id_solicitud'];
		$this->id_oficialcredito->DbValue = $row['id_oficialcredito'];
		$this->id_inspector->DbValue = $row['id_inspector'];
		$this->is_active->DbValue = $row['is_active'];
		$this->created_at->DbValue = $row['created_at'];
		$this->id_cliente->DbValue = $row['id_cliente'];
		$this->estado->DbValue = $row['estado'];
		$this->estadointerno->DbValue = $row['estadointerno'];
		$this->estadopago->DbValue = $row['estadopago'];
		$this->fecha_avaluo->DbValue = $row['fecha_avaluo'];
		$this->id_metodopago->DbValue = $row['id_metodopago'];
		$this->DateModified->DbValue = $row['DateModified'];
		$this->DateDeleted->DbValue = $row['DateDeleted'];
		$this->CreatedBy->DbValue = $row['CreatedBy'];
		$this->ModifiedBy->DbValue = $row['ModifiedBy'];
		$this->DeletedBy->DbValue = $row['DeletedBy'];
		$this->id_sucursal->DbValue = $row['id_sucursal'];
		$this->informe->Upload->DbValue = $row['informe'];
		$this->monto_pago->DbValue = $row['monto_pago'];
		$this->montoincial->DbValue = $row['montoincial'];
		$this->comentario->DbValue = $row['comentario'];
		$this->documento_pago->Upload->DbValue = $row['documento_pago'];
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
		// Convert decimal values if posted back

		if ($this->monto_pago->FormValue == $this->monto_pago->CurrentValue && is_numeric(ew_StrToFloat($this->monto_pago->CurrentValue)))
			$this->monto_pago->CurrentValue = ew_StrToFloat($this->monto_pago->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// codigoavaluo
		// tipoinmueble
		// id_solicitud
		// id_oficialcredito
		// id_inspector
		// is_active
		// created_at
		// id_cliente
		// estado
		// estadointerno
		// estadopago
		// fecha_avaluo
		// id_metodopago
		// DateModified
		// DateDeleted
		// CreatedBy
		// ModifiedBy
		// DeletedBy
		// id_sucursal
		// informe
		// monto_pago
		// montoincial
		// comentario
		// documento_pago

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// tipoinmueble
		if (strval($this->tipoinmueble->CurrentValue) <> "") {
			$sFilterWrk = "`nombre`" . ew_SearchString("=", $this->tipoinmueble->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
		$sWhereWrk = "";
		$this->tipoinmueble->LookupFilters = array();
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

		// id_solicitud
		$this->id_solicitud->ViewValue = $this->id_solicitud->CurrentValue;
		if (strval($this->id_solicitud->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
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
		if (strval($this->id_oficialcredito->CurrentValue) <> "") {
			$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_oficialcredito->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
		$sWhereWrk = "";
		$this->id_oficialcredito->LookupFilters = array();
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
		$this->estado->LookupFilters = array("dx1" => '`descripcion`');
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
		$this->estadointerno->LookupFilters = array("dx1" => '`descripcion`');
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

		// monto_pago
		$this->monto_pago->ViewValue = $this->monto_pago->CurrentValue;
		$this->monto_pago->ViewCustomAttributes = "";

		// comentario
		$this->comentario->ViewValue = $this->comentario->CurrentValue;
		$this->comentario->ViewCustomAttributes = "";

		// documento_pago
		if (!ew_Empty($this->documento_pago->Upload->DbValue)) {
			$this->documento_pago->ViewValue = "avaluo_documento_pago_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->documento_pago->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->documento_pago->Upload->DbValue, 0, 11)));
		} else {
			$this->documento_pago->ViewValue = "";
		}
		$this->documento_pago->ViewCustomAttributes = "";

			// tipoinmueble
			$this->tipoinmueble->LinkCustomAttributes = "";
			$this->tipoinmueble->HrefValue = "";
			$this->tipoinmueble->TooltipValue = "";

			// id_solicitud
			$this->id_solicitud->LinkCustomAttributes = "";
			$this->id_solicitud->HrefValue = "";
			$this->id_solicitud->TooltipValue = "";

			// id_oficialcredito
			$this->id_oficialcredito->LinkCustomAttributes = "";
			$this->id_oficialcredito->HrefValue = "";
			$this->id_oficialcredito->TooltipValue = "";

			// monto_pago
			$this->monto_pago->LinkCustomAttributes = "";
			$this->monto_pago->HrefValue = "";
			$this->monto_pago->TooltipValue = "";

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";
			$this->comentario->TooltipValue = "";

			// documento_pago
			$this->documento_pago->LinkCustomAttributes = "";
			if (!empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->HrefValue = "avaluo_documento_pago_bv.php?id=" . $this->id->CurrentValue;
				$this->documento_pago->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->documento_pago->HrefValue = ew_FullUrl($this->documento_pago->HrefValue, "href");
			} else {
				$this->documento_pago->HrefValue = "";
			}
			$this->documento_pago->HrefValue2 = "avaluo_documento_pago_bv.php?id=" . $this->id->CurrentValue;
			$this->documento_pago->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// tipoinmueble
			$this->tipoinmueble->EditAttrs["class"] = "form-control";
			$this->tipoinmueble->EditCustomAttributes = "";
			if (trim(strval($this->tipoinmueble->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`nombre`" . ew_SearchString("=", $this->tipoinmueble->CurrentValue, EW_DATATYPE_STRING, "");
			}
			$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tipoinmueble`";
			$sWhereWrk = "";
			$this->tipoinmueble->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->tipoinmueble, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->tipoinmueble->EditValue = $arwrk;

			// id_solicitud
			$this->id_solicitud->EditAttrs["class"] = "form-control";
			$this->id_solicitud->EditCustomAttributes = "";
			if ($this->id_solicitud->getSessionValue() <> "") {
				$this->id_solicitud->CurrentValue = $this->id_solicitud->getSessionValue();
			$this->id_solicitud->ViewValue = $this->id_solicitud->CurrentValue;
			if (strval($this->id_solicitud->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
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
					$this->id_solicitud->ViewValue = $this->id_solicitud->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_solicitud->ViewValue = $this->id_solicitud->CurrentValue;
				}
			} else {
				$this->id_solicitud->ViewValue = NULL;
			}
			$this->id_solicitud->ViewCustomAttributes = "";
			} else {
			$this->id_solicitud->EditValue = ew_HtmlEncode($this->id_solicitud->CurrentValue);
			if (strval($this->id_solicitud->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
			$sWhereWrk = "";
			$this->id_solicitud->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_solicitud, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
					$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
					$this->id_solicitud->EditValue = $this->id_solicitud->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_solicitud->EditValue = ew_HtmlEncode($this->id_solicitud->CurrentValue);
				}
			} else {
				$this->id_solicitud->EditValue = NULL;
			}
			$this->id_solicitud->PlaceHolder = ew_RemoveHtml($this->id_solicitud->FldTitle());
			}

			// id_oficialcredito
			$this->id_oficialcredito->EditAttrs["class"] = "form-control";
			$this->id_oficialcredito->EditCustomAttributes = "";
			if (trim(strval($this->id_oficialcredito->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_oficialcredito->CurrentValue, EW_DATATYPE_STRING, "");
			}
			$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `oficialcredito`";
			$sWhereWrk = "";
			$this->id_oficialcredito->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_oficialcredito, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_oficialcredito->EditValue = $arwrk;

			// monto_pago
			$this->monto_pago->EditAttrs["class"] = "form-control";
			$this->monto_pago->EditCustomAttributes = "";
			$this->monto_pago->EditValue = ew_HtmlEncode($this->monto_pago->CurrentValue);
			$this->monto_pago->PlaceHolder = ew_RemoveHtml($this->monto_pago->FldTitle());
			if (strval($this->monto_pago->EditValue) <> "" && is_numeric($this->monto_pago->EditValue)) $this->monto_pago->EditValue = ew_FormatNumber($this->monto_pago->EditValue, -2, -1, -2, 0);

			// comentario
			$this->comentario->EditAttrs["class"] = "form-control";
			$this->comentario->EditCustomAttributes = "";
			$this->comentario->EditValue = ew_HtmlEncode($this->comentario->CurrentValue);
			$this->comentario->PlaceHolder = ew_RemoveHtml($this->comentario->FldTitle());

			// documento_pago
			$this->documento_pago->EditAttrs["class"] = "form-control";
			$this->documento_pago->EditCustomAttributes = "";
			if (!ew_Empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->EditValue = "avaluo_documento_pago_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->documento_pago->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->documento_pago->Upload->DbValue, 0, 11)));
			} else {
				$this->documento_pago->EditValue = "";
			}
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->documento_pago);

			// Add refer script
			// tipoinmueble

			$this->tipoinmueble->LinkCustomAttributes = "";
			$this->tipoinmueble->HrefValue = "";

			// id_solicitud
			$this->id_solicitud->LinkCustomAttributes = "";
			$this->id_solicitud->HrefValue = "";

			// id_oficialcredito
			$this->id_oficialcredito->LinkCustomAttributes = "";
			$this->id_oficialcredito->HrefValue = "";

			// monto_pago
			$this->monto_pago->LinkCustomAttributes = "";
			$this->monto_pago->HrefValue = "";

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";

			// documento_pago
			$this->documento_pago->LinkCustomAttributes = "";
			if (!empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->HrefValue = "avaluo_documento_pago_bv.php?id=" . $this->id->CurrentValue;
				$this->documento_pago->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->documento_pago->HrefValue = ew_FullUrl($this->documento_pago->HrefValue, "href");
			} else {
				$this->documento_pago->HrefValue = "";
			}
			$this->documento_pago->HrefValue2 = "avaluo_documento_pago_bv.php?id=" . $this->id->CurrentValue;
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
		if (!ew_CheckInteger($this->id_solicitud->FormValue)) {
			ew_AddMessage($gsFormError, $this->id_solicitud->FldErrMsg());
		}
		if (!ew_CheckNumber($this->monto_pago->FormValue)) {
			ew_AddMessage($gsFormError, $this->monto_pago->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("documentosavaluo", $DetailTblVar) && $GLOBALS["documentosavaluo"]->DetailAdd) {
			if (!isset($GLOBALS["documentosavaluo_grid"])) $GLOBALS["documentosavaluo_grid"] = new cdocumentosavaluo_grid(); // get detail page object
			$GLOBALS["documentosavaluo_grid"]->ValidateGridForm();
		}
		if (in_array("pago_avaluo", $DetailTblVar) && $GLOBALS["pago_avaluo"]->DetailAdd) {
			if (!isset($GLOBALS["pago_avaluo_grid"])) $GLOBALS["pago_avaluo_grid"] = new cpago_avaluo_grid(); // get detail page object
			$GLOBALS["pago_avaluo_grid"]->ValidateGridForm();
		}
		if (in_array("comentariosavaluo", $DetailTblVar) && $GLOBALS["comentariosavaluo"]->DetailAdd) {
			if (!isset($GLOBALS["comentariosavaluo_grid"])) $GLOBALS["comentariosavaluo_grid"] = new ccomentariosavaluo_grid(); // get detail page object
			$GLOBALS["comentariosavaluo_grid"]->ValidateGridForm();
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

		// Check referential integrity for master table 'solicitud'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_solicitud();
		if (strval($this->id_solicitud->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@id@", ew_AdjustSql($this->id_solicitud->CurrentValue, "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			if (!isset($GLOBALS["solicitud"])) $GLOBALS["solicitud"] = new csolicitud();
			$rsmaster = $GLOBALS["solicitud"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "solicitud", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Begin transaction
		if ($this->getCurrentDetailTable() <> "")
			$conn->BeginTrans();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// tipoinmueble
		$this->tipoinmueble->SetDbValueDef($rsnew, $this->tipoinmueble->CurrentValue, NULL, FALSE);

		// id_solicitud
		$this->id_solicitud->SetDbValueDef($rsnew, $this->id_solicitud->CurrentValue, NULL, FALSE);

		// id_oficialcredito
		$this->id_oficialcredito->SetDbValueDef($rsnew, $this->id_oficialcredito->CurrentValue, NULL, FALSE);

		// monto_pago
		$this->monto_pago->SetDbValueDef($rsnew, $this->monto_pago->CurrentValue, NULL, strval($this->monto_pago->CurrentValue) == "");

		// comentario
		$this->comentario->SetDbValueDef($rsnew, $this->comentario->CurrentValue, NULL, FALSE);

		// documento_pago
		if ($this->documento_pago->Visible && !$this->documento_pago->Upload->KeepFile) {
			if (is_null($this->documento_pago->Upload->Value)) {
				$rsnew['documento_pago'] = NULL;
			} else {
				$rsnew['documento_pago'] = $this->documento_pago->Upload->Value;
			}
		}

		// Call Row Inserting event
		$rs = ($rsold == NULL) ? NULL : $rsold->fields;
		$bInsertRow = $this->Row_Inserting($rs, $rsnew);
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

		// Add detail records
		if ($AddRow) {
			$DetailTblVar = explode(",", $this->getCurrentDetailTable());
			if (in_array("documentosavaluo", $DetailTblVar) && $GLOBALS["documentosavaluo"]->DetailAdd) {
				$GLOBALS["documentosavaluo"]->avaluo->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["documentosavaluo_grid"])) $GLOBALS["documentosavaluo_grid"] = new cdocumentosavaluo_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "documentosavaluo"); // Load user level of detail table
				$AddRow = $GLOBALS["documentosavaluo_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["documentosavaluo"]->avaluo->setSessionValue(""); // Clear master key if insert failed
			}
			if (in_array("pago_avaluo", $DetailTblVar) && $GLOBALS["pago_avaluo"]->DetailAdd) {
				$GLOBALS["pago_avaluo"]->avaluo_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["pago_avaluo_grid"])) $GLOBALS["pago_avaluo_grid"] = new cpago_avaluo_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "pago_avaluo"); // Load user level of detail table
				$AddRow = $GLOBALS["pago_avaluo_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["pago_avaluo"]->avaluo_id->setSessionValue(""); // Clear master key if insert failed
			}
			if (in_array("comentariosavaluo", $DetailTblVar) && $GLOBALS["comentariosavaluo"]->DetailAdd) {
				$GLOBALS["comentariosavaluo"]->id_avaluo->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["comentariosavaluo_grid"])) $GLOBALS["comentariosavaluo_grid"] = new ccomentariosavaluo_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "comentariosavaluo"); // Load user level of detail table
				$AddRow = $GLOBALS["comentariosavaluo_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["comentariosavaluo"]->id_avaluo->setSessionValue(""); // Clear master key if insert failed
			}
		}

		// Commit/Rollback transaction
		if ($this->getCurrentDetailTable() <> "") {
			if ($AddRow) {
				$conn->CommitTrans(); // Commit transaction
			} else {
				$conn->RollbackTrans(); // Rollback transaction
			}
		}
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}

		// documento_pago
		ew_CleanUploadTempPath($this->documento_pago, $this->documento_pago->Upload->Index);
		return $AddRow;
	}

	// Set up master/detail based on QueryString
	function SetupMasterParms() {
		$bValidMaster = FALSE;

		// Get the keys for master table
		if (isset($_GET[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_GET[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "solicitud") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["solicitud"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->id_solicitud->setQueryStringValue($GLOBALS["solicitud"]->id->QueryStringValue);
					$this->id_solicitud->setSessionValue($this->id_solicitud->QueryStringValue);
					if (!is_numeric($GLOBALS["solicitud"]->id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		} elseif (isset($_POST[EW_TABLE_SHOW_MASTER])) {
			$sMasterTblVar = $_POST[EW_TABLE_SHOW_MASTER];
			if ($sMasterTblVar == "") {
				$bValidMaster = TRUE;
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
			}
			if ($sMasterTblVar == "solicitud") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["solicitud"]->id->setFormValue($_POST["fk_id"]);
					$this->id_solicitud->setFormValue($GLOBALS["solicitud"]->id->FormValue);
					$this->id_solicitud->setSessionValue($this->id_solicitud->FormValue);
					if (!is_numeric($GLOBALS["solicitud"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "solicitud") {
				if ($this->id_solicitud->CurrentValue == "") $this->id_solicitud->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
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
			if (in_array("documentosavaluo", $DetailTblVar)) {
				if (!isset($GLOBALS["documentosavaluo_grid"]))
					$GLOBALS["documentosavaluo_grid"] = new cdocumentosavaluo_grid;
				if ($GLOBALS["documentosavaluo_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["documentosavaluo_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["documentosavaluo_grid"]->CurrentMode = "add";
					$GLOBALS["documentosavaluo_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["documentosavaluo_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["documentosavaluo_grid"]->setStartRecordNumber(1);
					$GLOBALS["documentosavaluo_grid"]->avaluo->FldIsDetailKey = TRUE;
					$GLOBALS["documentosavaluo_grid"]->avaluo->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["documentosavaluo_grid"]->avaluo->setSessionValue($GLOBALS["documentosavaluo_grid"]->avaluo->CurrentValue);
				}
			}
			if (in_array("pago_avaluo", $DetailTblVar)) {
				if (!isset($GLOBALS["pago_avaluo_grid"]))
					$GLOBALS["pago_avaluo_grid"] = new cpago_avaluo_grid;
				if ($GLOBALS["pago_avaluo_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["pago_avaluo_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["pago_avaluo_grid"]->CurrentMode = "add";
					$GLOBALS["pago_avaluo_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["pago_avaluo_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["pago_avaluo_grid"]->setStartRecordNumber(1);
					$GLOBALS["pago_avaluo_grid"]->avaluo_id->FldIsDetailKey = TRUE;
					$GLOBALS["pago_avaluo_grid"]->avaluo_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["pago_avaluo_grid"]->avaluo_id->setSessionValue($GLOBALS["pago_avaluo_grid"]->avaluo_id->CurrentValue);
				}
			}
			if (in_array("comentariosavaluo", $DetailTblVar)) {
				if (!isset($GLOBALS["comentariosavaluo_grid"]))
					$GLOBALS["comentariosavaluo_grid"] = new ccomentariosavaluo_grid;
				if ($GLOBALS["comentariosavaluo_grid"]->DetailAdd) {
					if ($this->CopyRecord)
						$GLOBALS["comentariosavaluo_grid"]->CurrentMode = "copy";
					else
						$GLOBALS["comentariosavaluo_grid"]->CurrentMode = "add";
					$GLOBALS["comentariosavaluo_grid"]->CurrentAction = "gridadd";

					// Save current master table to detail table
					$GLOBALS["comentariosavaluo_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["comentariosavaluo_grid"]->setStartRecordNumber(1);
					$GLOBALS["comentariosavaluo_grid"]->id_avaluo->FldIsDetailKey = TRUE;
					$GLOBALS["comentariosavaluo_grid"]->id_avaluo->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["comentariosavaluo_grid"]->id_avaluo->setSessionValue($GLOBALS["comentariosavaluo_grid"]->id_avaluo->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("avaluolist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Set up detail pages
	function SetupDetailPages() {
		$pages = new cSubPages();
		$pages->Style = "tabs";
		$pages->Add('documentosavaluo');
		$pages->Add('pago_avaluo');
		$pages->Add('comentariosavaluo');
		$this->DetailPages = $pages;
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_tipoinmueble":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `nombre` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`nombre` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->tipoinmueble, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_solicitud":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_solicitud, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_oficialcredito":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `login` AS `LinkFld`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`login` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_oficialcredito, $sWhereWrk); // Call Lookup Selecting
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
		case "x_id_solicitud":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld` FROM `solicitud`";
			$sWhereWrk = "`name` LIKE '{query_value}%' OR CONCAT(`name`,'" . ew_ValueSeparator(1, $this->id_solicitud) . "',`lastname`) LIKE '{query_value}%'";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_solicitud, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
if (!isset($avaluo_add)) $avaluo_add = new cavaluo_add();

// Page init
$avaluo_add->Page_Init();

// Page main
$avaluo_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$avaluo_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = favaluoadd = new ew_Form("favaluoadd", "add");

// Validate form
favaluoadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_id_solicitud");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($avaluo->id_solicitud->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_monto_pago");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($avaluo->monto_pago->FldErrMsg()) ?>");

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
favaluoadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
favaluoadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
favaluoadd.Lists["x_tipoinmueble"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
favaluoadd.Lists["x_tipoinmueble"].Data = "<?php echo $avaluo_add->tipoinmueble->LookupFilterQuery(FALSE, "add") ?>";
favaluoadd.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
favaluoadd.Lists["x_id_solicitud"].Data = "<?php echo $avaluo_add->id_solicitud->LookupFilterQuery(FALSE, "add") ?>";
favaluoadd.AutoSuggests["x_id_solicitud"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $avaluo_add->id_solicitud->LookupFilterQuery(TRUE, "add"))) ?>;
favaluoadd.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
favaluoadd.Lists["x_id_oficialcredito"].Data = "<?php echo $avaluo_add->id_oficialcredito->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $avaluo_add->ShowPageHeader(); ?>
<?php
$avaluo_add->ShowMessage();
?>
<form name="favaluoadd" id="favaluoadd" class="<?php echo $avaluo_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($avaluo_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $avaluo_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="avaluo">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($avaluo_add->IsModal) ?>">
<?php if ($avaluo->getCurrentMasterTable() == "solicitud") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="solicitud">
<input type="hidden" name="fk_id" value="<?php echo $avaluo->id_solicitud->getSessionValue() ?>">
<?php } ?>
<?php if (!$avaluo_add->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($avaluo_add->IsMobileOrModal) { ?>
<div class="ewAddDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_avaluoadd" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($avaluo->tipoinmueble->Visible) { // tipoinmueble ?>
<?php if ($avaluo_add->IsMobileOrModal) { ?>
	<div id="r_tipoinmueble" class="form-group">
		<label id="elh_avaluo_tipoinmueble" for="x_tipoinmueble" class="<?php echo $avaluo_add->LeftColumnClass ?>"><?php echo $avaluo->tipoinmueble->FldCaption() ?></label>
		<div class="<?php echo $avaluo_add->RightColumnClass ?>"><div<?php echo $avaluo->tipoinmueble->CellAttributes() ?>>
<span id="el_avaluo_tipoinmueble">
<select data-table="avaluo" data-field="x_tipoinmueble" data-value-separator="<?php echo $avaluo->tipoinmueble->DisplayValueSeparatorAttribute() ?>" id="x_tipoinmueble" name="x_tipoinmueble"<?php echo $avaluo->tipoinmueble->EditAttributes() ?>>
<?php echo $avaluo->tipoinmueble->SelectOptionListHtml("x_tipoinmueble") ?>
</select>
</span>
<?php echo $avaluo->tipoinmueble->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipoinmueble">
		<td class="col-sm-3"><span id="elh_avaluo_tipoinmueble"><?php echo $avaluo->tipoinmueble->FldCaption() ?></span></td>
		<td<?php echo $avaluo->tipoinmueble->CellAttributes() ?>>
<span id="el_avaluo_tipoinmueble">
<select data-table="avaluo" data-field="x_tipoinmueble" data-value-separator="<?php echo $avaluo->tipoinmueble->DisplayValueSeparatorAttribute() ?>" id="x_tipoinmueble" name="x_tipoinmueble"<?php echo $avaluo->tipoinmueble->EditAttributes() ?>>
<?php echo $avaluo->tipoinmueble->SelectOptionListHtml("x_tipoinmueble") ?>
</select>
</span>
<?php echo $avaluo->tipoinmueble->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($avaluo->id_solicitud->Visible) { // id_solicitud ?>
<?php if ($avaluo_add->IsMobileOrModal) { ?>
	<div id="r_id_solicitud" class="form-group">
		<label id="elh_avaluo_id_solicitud" class="<?php echo $avaluo_add->LeftColumnClass ?>"><?php echo $avaluo->id_solicitud->FldCaption() ?></label>
		<div class="<?php echo $avaluo_add->RightColumnClass ?>"><div<?php echo $avaluo->id_solicitud->CellAttributes() ?>>
<?php if ($avaluo->id_solicitud->getSessionValue() <> "") { ?>
<span id="el_avaluo_id_solicitud">
<span<?php echo $avaluo->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_id_solicitud" name="x_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el_avaluo_id_solicitud">
<?php
$wrkonchange = trim(" " . @$avaluo->id_solicitud->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$avaluo->id_solicitud->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_solicitud" style="white-space: nowrap; z-index: 8960">
	<input type="text" name="sv_x_id_solicitud" id="sv_x_id_solicitud" value="<?php echo $avaluo->id_solicitud->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($avaluo->id_solicitud->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($avaluo->id_solicitud->getPlaceHolder()) ?>"<?php echo $avaluo->id_solicitud->EditAttributes() ?>>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_solicitud" data-value-separator="<?php echo $avaluo->id_solicitud->DisplayValueSeparatorAttribute() ?>" name="x_id_solicitud" id="x_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
favaluoadd.CreateAutoSuggest({"id":"x_id_solicitud","forceSelect":false});
</script>
</span>
<?php } ?>
<?php echo $avaluo->id_solicitud->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_solicitud">
		<td class="col-sm-3"><span id="elh_avaluo_id_solicitud"><?php echo $avaluo->id_solicitud->FldCaption() ?></span></td>
		<td<?php echo $avaluo->id_solicitud->CellAttributes() ?>>
<?php if ($avaluo->id_solicitud->getSessionValue() <> "") { ?>
<span id="el_avaluo_id_solicitud">
<span<?php echo $avaluo->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $avaluo->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_id_solicitud" name="x_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el_avaluo_id_solicitud">
<?php
$wrkonchange = trim(" " . @$avaluo->id_solicitud->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$avaluo->id_solicitud->EditAttrs["onchange"] = "";
?>
<span id="as_x_id_solicitud" style="white-space: nowrap; z-index: 8960">
	<input type="text" name="sv_x_id_solicitud" id="sv_x_id_solicitud" value="<?php echo $avaluo->id_solicitud->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($avaluo->id_solicitud->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($avaluo->id_solicitud->getPlaceHolder()) ?>"<?php echo $avaluo->id_solicitud->EditAttributes() ?>>
</span>
<input type="hidden" data-table="avaluo" data-field="x_id_solicitud" data-value-separator="<?php echo $avaluo->id_solicitud->DisplayValueSeparatorAttribute() ?>" name="x_id_solicitud" id="x_id_solicitud" value="<?php echo ew_HtmlEncode($avaluo->id_solicitud->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
favaluoadd.CreateAutoSuggest({"id":"x_id_solicitud","forceSelect":false});
</script>
</span>
<?php } ?>
<?php echo $avaluo->id_solicitud->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($avaluo->id_oficialcredito->Visible) { // id_oficialcredito ?>
<?php if ($avaluo_add->IsMobileOrModal) { ?>
	<div id="r_id_oficialcredito" class="form-group">
		<label id="elh_avaluo_id_oficialcredito" for="x_id_oficialcredito" class="<?php echo $avaluo_add->LeftColumnClass ?>"><?php echo $avaluo->id_oficialcredito->FldCaption() ?></label>
		<div class="<?php echo $avaluo_add->RightColumnClass ?>"><div<?php echo $avaluo->id_oficialcredito->CellAttributes() ?>>
<span id="el_avaluo_id_oficialcredito">
<select data-table="avaluo" data-field="x_id_oficialcredito" data-value-separator="<?php echo $avaluo->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" id="x_id_oficialcredito" name="x_id_oficialcredito"<?php echo $avaluo->id_oficialcredito->EditAttributes() ?>>
<?php echo $avaluo->id_oficialcredito->SelectOptionListHtml("x_id_oficialcredito") ?>
</select>
</span>
<?php echo $avaluo->id_oficialcredito->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_oficialcredito">
		<td class="col-sm-3"><span id="elh_avaluo_id_oficialcredito"><?php echo $avaluo->id_oficialcredito->FldCaption() ?></span></td>
		<td<?php echo $avaluo->id_oficialcredito->CellAttributes() ?>>
<span id="el_avaluo_id_oficialcredito">
<select data-table="avaluo" data-field="x_id_oficialcredito" data-value-separator="<?php echo $avaluo->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" id="x_id_oficialcredito" name="x_id_oficialcredito"<?php echo $avaluo->id_oficialcredito->EditAttributes() ?>>
<?php echo $avaluo->id_oficialcredito->SelectOptionListHtml("x_id_oficialcredito") ?>
</select>
</span>
<?php echo $avaluo->id_oficialcredito->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($avaluo->monto_pago->Visible) { // monto_pago ?>
<?php if ($avaluo_add->IsMobileOrModal) { ?>
	<div id="r_monto_pago" class="form-group">
		<label id="elh_avaluo_monto_pago" for="x_monto_pago" class="<?php echo $avaluo_add->LeftColumnClass ?>"><?php echo $avaluo->monto_pago->FldCaption() ?></label>
		<div class="<?php echo $avaluo_add->RightColumnClass ?>"><div<?php echo $avaluo->monto_pago->CellAttributes() ?>>
<span id="el_avaluo_monto_pago">
<input type="text" data-table="avaluo" data-field="x_monto_pago" name="x_monto_pago" id="x_monto_pago" size="5" placeholder="<?php echo ew_HtmlEncode($avaluo->monto_pago->getPlaceHolder()) ?>" value="<?php echo $avaluo->monto_pago->EditValue ?>"<?php echo $avaluo->monto_pago->EditAttributes() ?>>
</span>
<?php echo $avaluo->monto_pago->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_monto_pago">
		<td class="col-sm-3"><span id="elh_avaluo_monto_pago"><?php echo $avaluo->monto_pago->FldCaption() ?></span></td>
		<td<?php echo $avaluo->monto_pago->CellAttributes() ?>>
<span id="el_avaluo_monto_pago">
<input type="text" data-table="avaluo" data-field="x_monto_pago" name="x_monto_pago" id="x_monto_pago" size="5" placeholder="<?php echo ew_HtmlEncode($avaluo->monto_pago->getPlaceHolder()) ?>" value="<?php echo $avaluo->monto_pago->EditValue ?>"<?php echo $avaluo->monto_pago->EditAttributes() ?>>
</span>
<?php echo $avaluo->monto_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($avaluo->comentario->Visible) { // comentario ?>
<?php if ($avaluo_add->IsMobileOrModal) { ?>
	<div id="r_comentario" class="form-group">
		<label id="elh_avaluo_comentario" for="x_comentario" class="<?php echo $avaluo_add->LeftColumnClass ?>"><?php echo $avaluo->comentario->FldCaption() ?></label>
		<div class="<?php echo $avaluo_add->RightColumnClass ?>"><div<?php echo $avaluo->comentario->CellAttributes() ?>>
<span id="el_avaluo_comentario">
<textarea data-table="avaluo" data-field="x_comentario" name="x_comentario" id="x_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($avaluo->comentario->getPlaceHolder()) ?>"<?php echo $avaluo->comentario->EditAttributes() ?>><?php echo $avaluo->comentario->EditValue ?></textarea>
</span>
<?php echo $avaluo->comentario->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_comentario">
		<td class="col-sm-3"><span id="elh_avaluo_comentario"><?php echo $avaluo->comentario->FldCaption() ?></span></td>
		<td<?php echo $avaluo->comentario->CellAttributes() ?>>
<span id="el_avaluo_comentario">
<textarea data-table="avaluo" data-field="x_comentario" name="x_comentario" id="x_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($avaluo->comentario->getPlaceHolder()) ?>"<?php echo $avaluo->comentario->EditAttributes() ?>><?php echo $avaluo->comentario->EditValue ?></textarea>
</span>
<?php echo $avaluo->comentario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($avaluo->documento_pago->Visible) { // documento_pago ?>
<?php if ($avaluo_add->IsMobileOrModal) { ?>
	<div id="r_documento_pago" class="form-group">
		<label id="elh_avaluo_documento_pago" class="<?php echo $avaluo_add->LeftColumnClass ?>"><?php echo $avaluo->documento_pago->FldCaption() ?></label>
		<div class="<?php echo $avaluo_add->RightColumnClass ?>"><div<?php echo $avaluo->documento_pago->CellAttributes() ?>>
<span id="el_avaluo_documento_pago">
<div id="fd_x_documento_pago">
<span title="<?php echo $avaluo->documento_pago->FldTitle() ? $avaluo->documento_pago->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($avaluo->documento_pago->ReadOnly || $avaluo->documento_pago->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="avaluo" data-field="x_documento_pago" name="x_documento_pago" id="x_documento_pago"<?php echo $avaluo->documento_pago->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_documento_pago" id= "fn_x_documento_pago" value="<?php echo $avaluo->documento_pago->Upload->FileName ?>">
<input type="hidden" name="fa_x_documento_pago" id= "fa_x_documento_pago" value="0">
<input type="hidden" name="fs_x_documento_pago" id= "fs_x_documento_pago" value="0">
<input type="hidden" name="fx_x_documento_pago" id= "fx_x_documento_pago" value="<?php echo $avaluo->documento_pago->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_documento_pago" id= "fm_x_documento_pago" value="<?php echo $avaluo->documento_pago->UploadMaxFileSize ?>">
</div>
<table id="ft_x_documento_pago" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $avaluo->documento_pago->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_documento_pago">
		<td class="col-sm-3"><span id="elh_avaluo_documento_pago"><?php echo $avaluo->documento_pago->FldCaption() ?></span></td>
		<td<?php echo $avaluo->documento_pago->CellAttributes() ?>>
<span id="el_avaluo_documento_pago">
<div id="fd_x_documento_pago">
<span title="<?php echo $avaluo->documento_pago->FldTitle() ? $avaluo->documento_pago->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($avaluo->documento_pago->ReadOnly || $avaluo->documento_pago->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="avaluo" data-field="x_documento_pago" name="x_documento_pago" id="x_documento_pago"<?php echo $avaluo->documento_pago->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_documento_pago" id= "fn_x_documento_pago" value="<?php echo $avaluo->documento_pago->Upload->FileName ?>">
<input type="hidden" name="fa_x_documento_pago" id= "fa_x_documento_pago" value="0">
<input type="hidden" name="fs_x_documento_pago" id= "fs_x_documento_pago" value="0">
<input type="hidden" name="fx_x_documento_pago" id= "fx_x_documento_pago" value="<?php echo $avaluo->documento_pago->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_documento_pago" id= "fm_x_documento_pago" value="<?php echo $avaluo->documento_pago->UploadMaxFileSize ?>">
</div>
<table id="ft_x_documento_pago" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $avaluo->documento_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($avaluo_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if ($avaluo->getCurrentDetailTable() <> "") { ?>
<?php
	$avaluo_add->DetailPages->ValidKeys = explode(",", $avaluo->getCurrentDetailTable());
	$FirstActiveDetailTable = $avaluo_add->DetailPages->ActivePageIndex();
?>
<div class="ewDetailPages"><!-- detail-pages -->
<div class="nav-tabs-custom" id="avaluo_add_details"><!-- .nav-tabs-custom -->
	<ul class="nav<?php echo $avaluo_add->DetailPages->NavStyle() ?>"><!-- .nav -->
<?php
	if (in_array("documentosavaluo", explode(",", $avaluo->getCurrentDetailTable())) && $documentosavaluo->DetailAdd) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "documentosavaluo") {
			$FirstActiveDetailTable = "documentosavaluo";
		}
?>
		<li<?php echo $avaluo_add->DetailPages->TabStyle("documentosavaluo") ?>><a href="#tab_documentosavaluo" data-toggle="tab"><?php echo $Language->TablePhrase("documentosavaluo", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("pago_avaluo", explode(",", $avaluo->getCurrentDetailTable())) && $pago_avaluo->DetailAdd) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "pago_avaluo") {
			$FirstActiveDetailTable = "pago_avaluo";
		}
?>
		<li<?php echo $avaluo_add->DetailPages->TabStyle("pago_avaluo") ?>><a href="#tab_pago_avaluo" data-toggle="tab"><?php echo $Language->TablePhrase("pago_avaluo", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("comentariosavaluo", explode(",", $avaluo->getCurrentDetailTable())) && $comentariosavaluo->DetailAdd) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "comentariosavaluo") {
			$FirstActiveDetailTable = "comentariosavaluo";
		}
?>
		<li<?php echo $avaluo_add->DetailPages->TabStyle("comentariosavaluo") ?>><a href="#tab_comentariosavaluo" data-toggle="tab"><?php echo $Language->TablePhrase("comentariosavaluo", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("documentosavaluo", explode(",", $avaluo->getCurrentDetailTable())) && $documentosavaluo->DetailAdd) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "documentosavaluo") {
			$FirstActiveDetailTable = "documentosavaluo";
		}
?>
		<div class="tab-pane<?php echo $avaluo_add->DetailPages->PageStyle("documentosavaluo") ?>" id="tab_documentosavaluo"><!-- page* -->
<?php include_once "documentosavaluogrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("pago_avaluo", explode(",", $avaluo->getCurrentDetailTable())) && $pago_avaluo->DetailAdd) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "pago_avaluo") {
			$FirstActiveDetailTable = "pago_avaluo";
		}
?>
		<div class="tab-pane<?php echo $avaluo_add->DetailPages->PageStyle("pago_avaluo") ?>" id="tab_pago_avaluo"><!-- page* -->
<?php include_once "pago_avaluogrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("comentariosavaluo", explode(",", $avaluo->getCurrentDetailTable())) && $comentariosavaluo->DetailAdd) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "comentariosavaluo") {
			$FirstActiveDetailTable = "comentariosavaluo";
		}
?>
		<div class="tab-pane<?php echo $avaluo_add->DetailPages->PageStyle("comentariosavaluo") ?>" id="tab_comentariosavaluo"><!-- page* -->
<?php include_once "comentariosavaluogrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /.nav-tabs-custom -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$avaluo_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $avaluo_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $avaluo_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$avaluo_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
favaluoadd.Init();
</script>
<?php
$avaluo_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$avaluo_add->Page_Terminate();
?>
