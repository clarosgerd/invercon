<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "viewavaluosupervisorinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "viewdocumentosupervisorgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$viewavaluosupervisor_edit = NULL; // Initialize page object first

class cviewavaluosupervisor_edit extends cviewavaluosupervisor {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewavaluosupervisor';

	// Page object name
	var $PageObjName = 'viewavaluosupervisor_edit';

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

		// Table object (viewavaluosupervisor)
		if (!isset($GLOBALS["viewavaluosupervisor"]) || get_class($GLOBALS["viewavaluosupervisor"]) == "cviewavaluosupervisor") {
			$GLOBALS["viewavaluosupervisor"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["viewavaluosupervisor"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'viewavaluosupervisor', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("viewavaluosupervisorlist.php"));
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
				if (in_array("viewdocumentosupervisor", $DetailTblVar)) {

					// Process auto fill for detail table 'viewdocumentosupervisor'
					if (preg_match('/^fviewdocumentosupervisor(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["viewdocumentosupervisor_grid"])) $GLOBALS["viewdocumentosupervisor_grid"] = new cviewdocumentosupervisor_grid;
						$GLOBALS["viewdocumentosupervisor_grid"]->Page_Init();
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
		if (@$_POST["customexport"] == "") {

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();
		}

		// Export
		global $EW_EXPORT, $viewavaluosupervisor;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
			if (is_array(@$_SESSION[EW_SESSION_TEMP_IMAGES])) // Restore temp images
				$gTmpImages = @$_SESSION[EW_SESSION_TEMP_IMAGES];
			if (@$_POST["data"] <> "")
				$sContent = $_POST["data"];
			$gsExportFile = @$_POST["filename"];
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($viewavaluosupervisor);
				$doc->Text = $sContent;
				if ($this->Export == "email")
					echo $this->ExportEmail($doc->Text);
				else
					$doc->Export();
				ew_DeleteTmpImages(); // Delete temp images
				exit();
			}
		}
	if ($this->CustomExport <> "") { // Save temp images array for custom export
		if (is_array($gTmpImages))
			$_SESSION[EW_SESSION_TEMP_IMAGES] = $gTmpImages;
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
					if ($pageName == "viewavaluosupervisorview.php")
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
					$this->Page_Terminate("viewavaluosupervisorlist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			Case "U": // Update
				if ($this->getCurrentDetailTable() <> "") // Master/detail edit
					$sReturnUrl = $this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "viewavaluosupervisorlist.php")
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
		$this->informe->Upload->Index = $objForm->Index;
		$this->informe->Upload->UploadFile();
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
		if (!$this->id_inspector->FldIsDetailKey) {
			$this->id_inspector->setFormValue($objForm->GetValue("x_id_inspector"));
		}
		if (!$this->estadointerno->FldIsDetailKey) {
			$this->estadointerno->setFormValue($objForm->GetValue("x_estadointerno"));
		}
		if (!$this->id_sucursal->FldIsDetailKey) {
			$this->id_sucursal->setFormValue($objForm->GetValue("x_id_sucursal"));
		}
		if (!$this->monto_pago->FldIsDetailKey) {
			$this->monto_pago->setFormValue($objForm->GetValue("x_monto_pago"));
		}
		if (!$this->montoincial->FldIsDetailKey) {
			$this->montoincial->setFormValue($objForm->GetValue("x_montoincial"));
		}
		if (!$this->comentario->FldIsDetailKey) {
			$this->comentario->setFormValue($objForm->GetValue("x_comentario"));
		}
		if (!$this->ModifiedBy->FldIsDetailKey) {
			$this->ModifiedBy->setFormValue($objForm->GetValue("x_ModifiedBy"));
		}
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->tipoinmueble->CurrentValue = $this->tipoinmueble->FormValue;
		$this->id_solicitud->CurrentValue = $this->id_solicitud->FormValue;
		$this->id_oficialcredito->CurrentValue = $this->id_oficialcredito->FormValue;
		$this->id_inspector->CurrentValue = $this->id_inspector->FormValue;
		$this->estadointerno->CurrentValue = $this->estadointerno->FormValue;
		$this->id_sucursal->CurrentValue = $this->id_sucursal->FormValue;
		$this->monto_pago->CurrentValue = $this->monto_pago->FormValue;
		$this->montoincial->CurrentValue = $this->montoincial->FormValue;
		$this->comentario->CurrentValue = $this->comentario->FormValue;
		$this->ModifiedBy->CurrentValue = $this->ModifiedBy->FormValue;
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
		$this->id_metodopago->setDbValue($row['id_metodopago']);
		$this->created_at->setDbValue($row['created_at']);
		$this->DateModified->setDbValue($row['DateModified']);
		$this->DateDeleted->setDbValue($row['DateDeleted']);
		$this->CreatedBy->setDbValue($row['CreatedBy']);
		$this->DeletedBy->setDbValue($row['DeletedBy']);
		$this->id_sucursal->setDbValue($row['id_sucursal']);
		$this->informe->Upload->DbValue = $row['informe'];
		if (is_array($this->informe->Upload->DbValue) || is_object($this->informe->Upload->DbValue)) // Byte array
			$this->informe->Upload->DbValue = ew_BytesToStr($this->informe->Upload->DbValue);
		$this->monto_pago->setDbValue($row['monto_pago']);
		$this->montoincial->setDbValue($row['montoincial']);
		$this->comentario->setDbValue($row['comentario']);
		$this->ModifiedBy->setDbValue($row['ModifiedBy']);
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
		$row['id_metodopago'] = NULL;
		$row['created_at'] = NULL;
		$row['DateModified'] = NULL;
		$row['DateDeleted'] = NULL;
		$row['CreatedBy'] = NULL;
		$row['DeletedBy'] = NULL;
		$row['id_sucursal'] = NULL;
		$row['informe'] = NULL;
		$row['monto_pago'] = NULL;
		$row['montoincial'] = NULL;
		$row['comentario'] = NULL;
		$row['ModifiedBy'] = NULL;
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
		$this->id_metodopago->DbValue = $row['id_metodopago'];
		$this->created_at->DbValue = $row['created_at'];
		$this->DateModified->DbValue = $row['DateModified'];
		$this->DateDeleted->DbValue = $row['DateDeleted'];
		$this->CreatedBy->DbValue = $row['CreatedBy'];
		$this->DeletedBy->DbValue = $row['DeletedBy'];
		$this->id_sucursal->DbValue = $row['id_sucursal'];
		$this->informe->Upload->DbValue = $row['informe'];
		$this->monto_pago->DbValue = $row['monto_pago'];
		$this->montoincial->DbValue = $row['montoincial'];
		$this->comentario->DbValue = $row['comentario'];
		$this->ModifiedBy->DbValue = $row['ModifiedBy'];
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

		// Convert decimal values if posted back
		if ($this->montoincial->FormValue == $this->montoincial->CurrentValue && is_numeric(ew_StrToFloat($this->montoincial->CurrentValue)))
			$this->montoincial->CurrentValue = ew_StrToFloat($this->montoincial->CurrentValue);

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
		// id_metodopago
		// created_at
		// DateModified
		// DateDeleted
		// CreatedBy
		// DeletedBy
		// id_sucursal
		// informe
		// monto_pago
		// montoincial
		// comentario
		// ModifiedBy

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		$this->codigoavaluo->ViewCustomAttributes = "";

		// id_solicitud
		$this->id_solicitud->ViewValue = $this->id_solicitud->CurrentValue;
		if (strval($this->id_solicitud->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array("dx1" => '`id`', "dx2" => '`name`', "dx3" => '`lastname`', "dx4" => '`email`');
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array("dx1" => '`id`', "dx2" => '`name`', "dx3" => '`lastname`', "dx4" => '`email`');
				break;
			default:
				$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array("dx1" => '`id`', "dx2" => '`name`', "dx3" => '`lastname`', "dx4" => '`email`');
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
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, `owner` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->estadointerno->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, `owner` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->estadointerno->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, `owner` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
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
				$arwrk[2] = $rswrk->fields('Disp2Fld');
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

		// informe
		if (!ew_Empty($this->informe->Upload->DbValue)) {
			$this->informe->ViewValue = "viewavaluosupervisor_informe_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->informe->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->informe->Upload->DbValue, 0, 11)));
		} else {
			$this->informe->ViewValue = "";
		}
		$this->informe->ViewCustomAttributes = "";

		// monto_pago
		$this->monto_pago->ViewValue = $this->monto_pago->CurrentValue;
		$this->monto_pago->ViewCustomAttributes = "";

		// montoincial
		$this->montoincial->ViewValue = $this->montoincial->CurrentValue;
		$this->montoincial->ViewValue = ew_FormatNumber($this->montoincial->ViewValue, 0, -2, -2, -2);
		$this->montoincial->ViewCustomAttributes = "";

		// comentario
		$this->comentario->ViewValue = $this->comentario->CurrentValue;
		$this->comentario->ViewCustomAttributes = "";

		// ModifiedBy
		$this->ModifiedBy->ViewValue = $this->ModifiedBy->CurrentValue;
		$this->ModifiedBy->ViewCustomAttributes = "";

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

			// id_inspector
			$this->id_inspector->LinkCustomAttributes = "";
			$this->id_inspector->HrefValue = "";
			$this->id_inspector->TooltipValue = "";

			// estadointerno
			$this->estadointerno->LinkCustomAttributes = "";
			$this->estadointerno->HrefValue = "";
			$this->estadointerno->TooltipValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";
			$this->id_sucursal->TooltipValue = "";

			// informe
			$this->informe->LinkCustomAttributes = "";
			if (!empty($this->informe->Upload->DbValue)) {
				$this->informe->HrefValue = "viewavaluosupervisor_informe_bv.php?id=" . $this->id->CurrentValue;
				$this->informe->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->informe->HrefValue = ew_FullUrl($this->informe->HrefValue, "href");
			} else {
				$this->informe->HrefValue = "";
			}
			$this->informe->HrefValue2 = "viewavaluosupervisor_informe_bv.php?id=" . $this->id->CurrentValue;
			$this->informe->TooltipValue = "";

			// monto_pago
			$this->monto_pago->LinkCustomAttributes = "";
			$this->monto_pago->HrefValue = "";
			$this->monto_pago->TooltipValue = "";

			// montoincial
			$this->montoincial->LinkCustomAttributes = "";
			$this->montoincial->HrefValue = "";
			$this->montoincial->TooltipValue = "";

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";
			$this->comentario->TooltipValue = "";

			// ModifiedBy
			$this->ModifiedBy->LinkCustomAttributes = "";
			$this->ModifiedBy->HrefValue = "";
			$this->ModifiedBy->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// tipoinmueble
			$this->tipoinmueble->EditAttrs["class"] = "form-control";
			$this->tipoinmueble->EditCustomAttributes = "";
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
					$this->tipoinmueble->EditValue = $this->tipoinmueble->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->tipoinmueble->EditValue = $this->tipoinmueble->CurrentValue;
				}
			} else {
				$this->tipoinmueble->EditValue = NULL;
			}
			$this->tipoinmueble->ViewCustomAttributes = "";

			// id_solicitud
			$this->id_solicitud->EditAttrs["class"] = "form-control";
			$this->id_solicitud->EditCustomAttributes = "";
			$this->id_solicitud->EditValue = $this->id_solicitud->CurrentValue;
			if (strval($this->id_solicitud->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
					$sWhereWrk = "";
					$this->id_solicitud->LookupFilters = array("dx1" => '`id`', "dx2" => '`name`', "dx3" => '`lastname`', "dx4" => '`email`');
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
					$sWhereWrk = "";
					$this->id_solicitud->LookupFilters = array("dx1" => '`id`', "dx2" => '`name`', "dx3" => '`lastname`', "dx4" => '`email`');
					break;
				default:
					$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
					$sWhereWrk = "";
					$this->id_solicitud->LookupFilters = array("dx1" => '`id`', "dx2" => '`name`', "dx3" => '`lastname`', "dx4" => '`email`');
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

			// estadointerno
			$this->estadointerno->EditAttrs["class"] = "form-control";
			$this->estadointerno->EditCustomAttributes = "";
			if (trim(strval($this->estadointerno->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->estadointerno->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, `owner` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadointerno`";
					$sWhereWrk = "";
					$this->estadointerno->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, `owner` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadointerno`";
					$sWhereWrk = "";
					$this->estadointerno->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, `owner` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadointerno`";
					$sWhereWrk = "";
					$this->estadointerno->LookupFilters = array();
					break;
			}
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->estadointerno, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->estadointerno->EditValue = $arwrk;

			// id_sucursal
			$this->id_sucursal->EditAttrs["class"] = "form-control";
			$this->id_sucursal->EditCustomAttributes = "";
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
					$this->id_sucursal->EditValue = $this->id_sucursal->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_sucursal->EditValue = $this->id_sucursal->CurrentValue;
				}
			} else {
				$this->id_sucursal->EditValue = NULL;
			}
			$this->id_sucursal->ViewCustomAttributes = "";

			// informe
			$this->informe->EditAttrs["class"] = "form-control";
			$this->informe->EditCustomAttributes = "";
			if (!ew_Empty($this->informe->Upload->DbValue)) {
				$this->informe->EditValue = "viewavaluosupervisor_informe_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->informe->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->informe->Upload->DbValue, 0, 11)));
			} else {
				$this->informe->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->informe);

			// monto_pago
			$this->monto_pago->EditAttrs["class"] = "form-control";
			$this->monto_pago->EditCustomAttributes = "";
			$this->monto_pago->EditValue = ew_HtmlEncode($this->monto_pago->CurrentValue);
			$this->monto_pago->PlaceHolder = ew_RemoveHtml($this->monto_pago->FldTitle());
			if (strval($this->monto_pago->EditValue) <> "" && is_numeric($this->monto_pago->EditValue)) $this->monto_pago->EditValue = ew_FormatNumber($this->monto_pago->EditValue, -2, -1, -2, 0);

			// montoincial
			$this->montoincial->EditAttrs["class"] = "form-control";
			$this->montoincial->EditCustomAttributes = "";
			$this->montoincial->EditValue = ew_HtmlEncode($this->montoincial->CurrentValue);
			$this->montoincial->PlaceHolder = ew_RemoveHtml($this->montoincial->FldTitle());
			if (strval($this->montoincial->EditValue) <> "" && is_numeric($this->montoincial->EditValue)) $this->montoincial->EditValue = ew_FormatNumber($this->montoincial->EditValue, -2, -2, -2, -2);

			// comentario
			$this->comentario->EditAttrs["class"] = "form-control";
			$this->comentario->EditCustomAttributes = "";
			$this->comentario->EditValue = ew_HtmlEncode($this->comentario->CurrentValue);
			$this->comentario->PlaceHolder = ew_RemoveHtml($this->comentario->FldTitle());

			// ModifiedBy
			$this->ModifiedBy->EditAttrs["class"] = "form-control";
			$this->ModifiedBy->EditCustomAttributes = "";
			$this->ModifiedBy->EditValue = $this->ModifiedBy->CurrentValue;
			$this->ModifiedBy->ViewCustomAttributes = "";

			// Edit refer script
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

			// id_inspector
			$this->id_inspector->LinkCustomAttributes = "";
			$this->id_inspector->HrefValue = "";
			$this->id_inspector->TooltipValue = "";

			// estadointerno
			$this->estadointerno->LinkCustomAttributes = "";
			$this->estadointerno->HrefValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";
			$this->id_sucursal->TooltipValue = "";

			// informe
			$this->informe->LinkCustomAttributes = "";
			if (!empty($this->informe->Upload->DbValue)) {
				$this->informe->HrefValue = "viewavaluosupervisor_informe_bv.php?id=" . $this->id->CurrentValue;
				$this->informe->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->informe->HrefValue = ew_FullUrl($this->informe->HrefValue, "href");
			} else {
				$this->informe->HrefValue = "";
			}
			$this->informe->HrefValue2 = "viewavaluosupervisor_informe_bv.php?id=" . $this->id->CurrentValue;

			// monto_pago
			$this->monto_pago->LinkCustomAttributes = "";
			$this->monto_pago->HrefValue = "";

			// montoincial
			$this->montoincial->LinkCustomAttributes = "";
			$this->montoincial->HrefValue = "";

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";

			// ModifiedBy
			$this->ModifiedBy->LinkCustomAttributes = "";
			$this->ModifiedBy->HrefValue = "";
			$this->ModifiedBy->TooltipValue = "";
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();

		// Save data for Custom Template
		if ($this->RowType == EW_ROWTYPE_VIEW || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_ADD)
			$this->Rows[] = $this->CustomTemplateFieldValues();
	}

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!ew_CheckNumber($this->monto_pago->FormValue)) {
			ew_AddMessage($gsFormError, $this->monto_pago->FldErrMsg());
		}
		if (!ew_CheckNumber($this->montoincial->FormValue)) {
			ew_AddMessage($gsFormError, $this->montoincial->FldErrMsg());
		}

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("viewdocumentosupervisor", $DetailTblVar) && $GLOBALS["viewdocumentosupervisor"]->DetailEdit) {
			if (!isset($GLOBALS["viewdocumentosupervisor_grid"])) $GLOBALS["viewdocumentosupervisor_grid"] = new cviewdocumentosupervisor_grid(); // get detail page object
			$GLOBALS["viewdocumentosupervisor_grid"]->ValidateGridForm();
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

			// estadointerno
			$this->estadointerno->SetDbValueDef($rsnew, $this->estadointerno->CurrentValue, NULL, $this->estadointerno->ReadOnly);

			// informe
			if ($this->informe->Visible && !$this->informe->ReadOnly && !$this->informe->Upload->KeepFile) {
				if (is_null($this->informe->Upload->Value)) {
					$rsnew['informe'] = NULL;
				} else {
					$rsnew['informe'] = $this->informe->Upload->Value;
				}
			}

			// monto_pago
			$this->monto_pago->SetDbValueDef($rsnew, $this->monto_pago->CurrentValue, NULL, $this->monto_pago->ReadOnly);

			// montoincial
			$this->montoincial->SetDbValueDef($rsnew, $this->montoincial->CurrentValue, NULL, $this->montoincial->ReadOnly);

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

				// Update detail records
				$DetailTblVar = explode(",", $this->getCurrentDetailTable());
				if ($EditRow) {
					if (in_array("viewdocumentosupervisor", $DetailTblVar) && $GLOBALS["viewdocumentosupervisor"]->DetailEdit) {
						if (!isset($GLOBALS["viewdocumentosupervisor_grid"])) $GLOBALS["viewdocumentosupervisor_grid"] = new cviewdocumentosupervisor_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "viewdocumentosupervisor"); // Load user level of detail table
						$EditRow = $GLOBALS["viewdocumentosupervisor_grid"]->GridUpdate();
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
		if ($EditRow) {
			if ($this->SendEmail)
				$this->SendEmailOnEdit($rsold, $rsnew);
		}
		$rs->Close();

		// informe
		ew_CleanUploadTempPath($this->informe, $this->informe->Upload->Index);
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
			if (in_array("viewdocumentosupervisor", $DetailTblVar)) {
				if (!isset($GLOBALS["viewdocumentosupervisor_grid"]))
					$GLOBALS["viewdocumentosupervisor_grid"] = new cviewdocumentosupervisor_grid;
				if ($GLOBALS["viewdocumentosupervisor_grid"]->DetailEdit) {
					$GLOBALS["viewdocumentosupervisor_grid"]->CurrentMode = "edit";
					$GLOBALS["viewdocumentosupervisor_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["viewdocumentosupervisor_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["viewdocumentosupervisor_grid"]->setStartRecordNumber(1);
					$GLOBALS["viewdocumentosupervisor_grid"]->avaluo->FldIsDetailKey = TRUE;
					$GLOBALS["viewdocumentosupervisor_grid"]->avaluo->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["viewdocumentosupervisor_grid"]->avaluo->setSessionValue($GLOBALS["viewdocumentosupervisor_grid"]->avaluo->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("viewavaluosupervisorlist.php"), "", $this->TableVar, TRUE);
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
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, `owner` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, `owner` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, `owner` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
			}
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
if (!isset($viewavaluosupervisor_edit)) $viewavaluosupervisor_edit = new cviewavaluosupervisor_edit();

// Page init
$viewavaluosupervisor_edit->Page_Init();

// Page main
$viewavaluosupervisor_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewavaluosupervisor_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fviewavaluosupervisoredit = new ew_Form("fviewavaluosupervisoredit", "edit");

// Validate form
fviewavaluosupervisoredit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_monto_pago");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosupervisor->monto_pago->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_montoincial");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosupervisor->montoincial->FldErrMsg()) ?>");

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
fviewavaluosupervisoredit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluosupervisoredit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluosupervisoredit.Lists["x_tipoinmueble"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewavaluosupervisoredit.Lists["x_tipoinmueble"].Data = "<?php echo $viewavaluosupervisor_edit->tipoinmueble->LookupFilterQuery(FALSE, "edit") ?>";
fviewavaluosupervisoredit.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_id","x_name","x_lastname","x__email"],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
fviewavaluosupervisoredit.Lists["x_id_solicitud"].Data = "<?php echo $viewavaluosupervisor_edit->id_solicitud->LookupFilterQuery(FALSE, "edit") ?>";
fviewavaluosupervisoredit.AutoSuggests["x_id_solicitud"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluosupervisor_edit->id_solicitud->LookupFilterQuery(TRUE, "edit"))) ?>;
fviewavaluosupervisoredit.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fviewavaluosupervisoredit.Lists["x_id_oficialcredito"].Data = "<?php echo $viewavaluosupervisor_edit->id_oficialcredito->LookupFilterQuery(FALSE, "edit") ?>";
fviewavaluosupervisoredit.Lists["x_id_inspector"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_apellido","x_nombre","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"inspector"};
fviewavaluosupervisoredit.Lists["x_id_inspector"].Data = "<?php echo $viewavaluosupervisor_edit->id_inspector->LookupFilterQuery(FALSE, "edit") ?>";
fviewavaluosupervisoredit.Lists["x_estadointerno"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","x_owner","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadointerno"};
fviewavaluosupervisoredit.Lists["x_estadointerno"].Data = "<?php echo $viewavaluosupervisor_edit->estadointerno->LookupFilterQuery(FALSE, "edit") ?>";
fviewavaluosupervisoredit.Lists["x_id_sucursal"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"sucursal"};
fviewavaluosupervisoredit.Lists["x_id_sucursal"].Data = "<?php echo $viewavaluosupervisor_edit->id_sucursal->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $viewavaluosupervisor_edit->ShowPageHeader(); ?>
<?php
$viewavaluosupervisor_edit->ShowMessage();
?>
<form name="fviewavaluosupervisoredit" id="fviewavaluosupervisoredit" class="<?php echo $viewavaluosupervisor_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewavaluosupervisor_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewavaluosupervisor_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewavaluosupervisor">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($viewavaluosupervisor_edit->IsModal) ?>">
<div id="tpd_viewavaluosupervisoredit" class="ewCustomTemplate"></div>
<script id="tpm_viewavaluosupervisoredit" type="text/html">
<div id="ct_viewavaluosupervisor_edit"><div class="ewMultiPage">
<div class="nav-tabs-custom" id="solicitud_edit"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab_solicitud1" data-toggle="tab">DATOS GENERALES</a></li>
		<li><a href="#tab_solicitud2" data-toggle="tab">Disponibilidad</a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane active" id="tab_solicitud1"><!-- multi-page .tab-pane -->
<table id="tbl_solicitudedit1" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
	<tr id="r_name">
		<td>
<span id="el_solicitud_name">
{{include tmpl="#tpx_name"/}}
</span>
</td>
	</tr>
	<tr id="r_lastname">
		<td>
<span id="el_solicitud_lastname">
{{include tmpl="#tpx_lastname"/}}
</span>
</td>
	</tr>
	<tr id="r__email">
		<td>
<span id="el_solicitud__email">
{{include tmpl="#tpx_email"/}}
</span>
</td>
	</tr>
	<tr id="r_address">
		<td>
<span id="el_solicitud_address">
{{include tmpl="#tpx_address"/}}
</span>
</td>
	</tr>
	<tr id="r_phone">
		<td>
<span id="el_solicitud_phone">
{{include tmpl="#tpx_phone"/}}
</span>
</td>
	</tr>
	<tr id="r_cell">
		<td>
<span id="el_solicitud_cell">
{{include tmpl="#tpx_cell"/}}
</span>
</td>
	</tr>
	<tr id="r_nombre_contacto">
		<td>
<span id="el_solicitud_nombre_contacto">
{{include tmpl="#tpx_nombre_contacto"/}}
</span>
</td>
	</tr>
	<tr id="r_email_contacto">
		<td>
<span id="el_solicitud_email_contacto">
{{include tmpl="#tpx_email_contacto"/}}
</span>
</td>
	</tr>
</table><!-- /table* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane" id="tab_solicitud2"><!-- multi-page .tab-pane -->
<iframe src="reservacionesviewsecretaria.php" height="500" width="100%" style="border:none;" scrolling="yes"></iframe>
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
</div>
</script>
<?php if (!$viewavaluosupervisor_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv hidden"><!-- page* -->
<?php } else { ?>
<table id="tbl_viewavaluosupervisoredit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable hidden"><!-- table* -->
<?php } ?>
<?php if ($viewavaluosupervisor->tipoinmueble->Visible) { // tipoinmueble ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_tipoinmueble" class="form-group">
		<label id="elh_viewavaluosupervisor_tipoinmueble" for="x_tipoinmueble" class="<?php echo $viewavaluosupervisor_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosupervisor_tipoinmueble" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->tipoinmueble->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosupervisor_edit->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->tipoinmueble->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_tipoinmueble" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_tipoinmueble">
<span<?php echo $viewavaluosupervisor->tipoinmueble->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->tipoinmueble->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_tipoinmueble" name="x_tipoinmueble" id="x_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->tipoinmueble->CurrentValue) ?>">
<?php echo $viewavaluosupervisor->tipoinmueble->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipoinmueble">
		<td class="col-sm-3"><span id="elh_viewavaluosupervisor_tipoinmueble"><script id="tpc_viewavaluosupervisor_tipoinmueble" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->tipoinmueble->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosupervisor->tipoinmueble->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_tipoinmueble" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_tipoinmueble">
<span<?php echo $viewavaluosupervisor->tipoinmueble->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->tipoinmueble->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_tipoinmueble" name="x_tipoinmueble" id="x_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->tipoinmueble->CurrentValue) ?>">
<?php echo $viewavaluosupervisor->tipoinmueble->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->id_solicitud->Visible) { // id_solicitud ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_id_solicitud" class="form-group">
		<label id="elh_viewavaluosupervisor_id_solicitud" class="<?php echo $viewavaluosupervisor_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosupervisor_id_solicitud" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->id_solicitud->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosupervisor_edit->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->id_solicitud->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_id_solicitud" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_id_solicitud">
<span<?php echo $viewavaluosupervisor->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_solicitud->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" name="x_id_solicitud" id="x_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->CurrentValue) ?>">
<script type="text/html" class="viewavaluosupervisoredit_js">
fviewavaluosupervisoredit.CreateAutoSuggest({"id":"x_id_solicitud","forceSelect":false});
</script>
<?php echo $viewavaluosupervisor->id_solicitud->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_solicitud">
		<td class="col-sm-3"><span id="elh_viewavaluosupervisor_id_solicitud"><script id="tpc_viewavaluosupervisor_id_solicitud" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->id_solicitud->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosupervisor->id_solicitud->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_id_solicitud" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_id_solicitud">
<span<?php echo $viewavaluosupervisor->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_solicitud->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_solicitud" name="x_id_solicitud" id="x_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_solicitud->CurrentValue) ?>">
<script type="text/html" class="viewavaluosupervisoredit_js">
fviewavaluosupervisoredit.CreateAutoSuggest({"id":"x_id_solicitud","forceSelect":false});
</script>
<?php echo $viewavaluosupervisor->id_solicitud->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->id_oficialcredito->Visible) { // id_oficialcredito ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_id_oficialcredito" class="form-group">
		<label id="elh_viewavaluosupervisor_id_oficialcredito" for="x_id_oficialcredito" class="<?php echo $viewavaluosupervisor_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosupervisor_id_oficialcredito" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->id_oficialcredito->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosupervisor_edit->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->id_oficialcredito->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_id_oficialcredito" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_id_oficialcredito">
<span<?php echo $viewavaluosupervisor->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_oficialcredito->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" name="x_id_oficialcredito" id="x_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_oficialcredito->CurrentValue) ?>">
<?php echo $viewavaluosupervisor->id_oficialcredito->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_oficialcredito">
		<td class="col-sm-3"><span id="elh_viewavaluosupervisor_id_oficialcredito"><script id="tpc_viewavaluosupervisor_id_oficialcredito" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->id_oficialcredito->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosupervisor->id_oficialcredito->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_id_oficialcredito" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_id_oficialcredito">
<span<?php echo $viewavaluosupervisor->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_oficialcredito->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_oficialcredito" name="x_id_oficialcredito" id="x_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_oficialcredito->CurrentValue) ?>">
<?php echo $viewavaluosupervisor->id_oficialcredito->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->id_inspector->Visible) { // id_inspector ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_id_inspector" class="form-group">
		<label id="elh_viewavaluosupervisor_id_inspector" for="x_id_inspector" class="<?php echo $viewavaluosupervisor_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosupervisor_id_inspector" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->id_inspector->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosupervisor_edit->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->id_inspector->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_id_inspector" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_id_inspector">
<span<?php echo $viewavaluosupervisor->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_inspector->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" name="x_id_inspector" id="x_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_inspector->CurrentValue) ?>">
<?php echo $viewavaluosupervisor->id_inspector->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_inspector">
		<td class="col-sm-3"><span id="elh_viewavaluosupervisor_id_inspector"><script id="tpc_viewavaluosupervisor_id_inspector" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->id_inspector->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosupervisor->id_inspector->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_id_inspector" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_id_inspector">
<span<?php echo $viewavaluosupervisor->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_inspector->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_inspector" name="x_id_inspector" id="x_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_inspector->CurrentValue) ?>">
<?php echo $viewavaluosupervisor->id_inspector->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->estadointerno->Visible) { // estadointerno ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_estadointerno" class="form-group">
		<label id="elh_viewavaluosupervisor_estadointerno" for="x_estadointerno" class="<?php echo $viewavaluosupervisor_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosupervisor_estadointerno" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->estadointerno->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosupervisor_edit->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->estadointerno->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_estadointerno" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_estadointerno">
<select data-table="viewavaluosupervisor" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluosupervisor->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x_estadointerno" name="x_estadointerno"<?php echo $viewavaluosupervisor->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estadointerno->SelectOptionListHtml("x_estadointerno") ?>
</select>
</span>
</script>
<?php echo $viewavaluosupervisor->estadointerno->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_estadointerno">
		<td class="col-sm-3"><span id="elh_viewavaluosupervisor_estadointerno"><script id="tpc_viewavaluosupervisor_estadointerno" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->estadointerno->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosupervisor->estadointerno->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_estadointerno" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_estadointerno">
<select data-table="viewavaluosupervisor" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluosupervisor->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x_estadointerno" name="x_estadointerno"<?php echo $viewavaluosupervisor->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estadointerno->SelectOptionListHtml("x_estadointerno") ?>
</select>
</span>
</script>
<?php echo $viewavaluosupervisor->estadointerno->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->id_sucursal->Visible) { // id_sucursal ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_id_sucursal" class="form-group">
		<label id="elh_viewavaluosupervisor_id_sucursal" for="x_id_sucursal" class="<?php echo $viewavaluosupervisor_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosupervisor_id_sucursal" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->id_sucursal->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosupervisor_edit->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->id_sucursal->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_id_sucursal" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_id_sucursal">
<span<?php echo $viewavaluosupervisor->id_sucursal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_sucursal->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_sucursal" name="x_id_sucursal" id="x_id_sucursal" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_sucursal->CurrentValue) ?>">
<?php echo $viewavaluosupervisor->id_sucursal->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_sucursal">
		<td class="col-sm-3"><span id="elh_viewavaluosupervisor_id_sucursal"><script id="tpc_viewavaluosupervisor_id_sucursal" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->id_sucursal->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosupervisor->id_sucursal->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_id_sucursal" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_id_sucursal">
<span<?php echo $viewavaluosupervisor->id_sucursal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->id_sucursal->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id_sucursal" name="x_id_sucursal" id="x_id_sucursal" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id_sucursal->CurrentValue) ?>">
<?php echo $viewavaluosupervisor->id_sucursal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->informe->Visible) { // informe ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_informe" class="form-group">
		<label id="elh_viewavaluosupervisor_informe" class="<?php echo $viewavaluosupervisor_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosupervisor_informe" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->informe->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosupervisor_edit->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->informe->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_informe" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_informe">
<div id="fd_x_informe">
<span title="<?php echo $viewavaluosupervisor->informe->FldTitle() ? $viewavaluosupervisor->informe->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewavaluosupervisor->informe->ReadOnly || $viewavaluosupervisor->informe->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewavaluosupervisor" data-field="x_informe" name="x_informe" id="x_informe"<?php echo $viewavaluosupervisor->informe->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_informe" id= "fn_x_informe" value="<?php echo $viewavaluosupervisor->informe->Upload->FileName ?>">
<?php if (@$_POST["fa_x_informe"] == "0") { ?>
<input type="hidden" name="fa_x_informe" id= "fa_x_informe" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_informe" id= "fa_x_informe" value="1">
<?php } ?>
<input type="hidden" name="fs_x_informe" id= "fs_x_informe" value="0">
<input type="hidden" name="fx_x_informe" id= "fx_x_informe" value="<?php echo $viewavaluosupervisor->informe->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_informe" id= "fm_x_informe" value="<?php echo $viewavaluosupervisor->informe->UploadMaxFileSize ?>">
</div>
<table id="ft_x_informe" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
</script>
<?php echo $viewavaluosupervisor->informe->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_informe">
		<td class="col-sm-3"><span id="elh_viewavaluosupervisor_informe"><script id="tpc_viewavaluosupervisor_informe" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->informe->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosupervisor->informe->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_informe" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_informe">
<div id="fd_x_informe">
<span title="<?php echo $viewavaluosupervisor->informe->FldTitle() ? $viewavaluosupervisor->informe->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewavaluosupervisor->informe->ReadOnly || $viewavaluosupervisor->informe->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewavaluosupervisor" data-field="x_informe" name="x_informe" id="x_informe"<?php echo $viewavaluosupervisor->informe->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_informe" id= "fn_x_informe" value="<?php echo $viewavaluosupervisor->informe->Upload->FileName ?>">
<?php if (@$_POST["fa_x_informe"] == "0") { ?>
<input type="hidden" name="fa_x_informe" id= "fa_x_informe" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_informe" id= "fa_x_informe" value="1">
<?php } ?>
<input type="hidden" name="fs_x_informe" id= "fs_x_informe" value="0">
<input type="hidden" name="fx_x_informe" id= "fx_x_informe" value="<?php echo $viewavaluosupervisor->informe->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_informe" id= "fm_x_informe" value="<?php echo $viewavaluosupervisor->informe->UploadMaxFileSize ?>">
</div>
<table id="ft_x_informe" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
</script>
<?php echo $viewavaluosupervisor->informe->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->monto_pago->Visible) { // monto_pago ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_monto_pago" class="form-group">
		<label id="elh_viewavaluosupervisor_monto_pago" for="x_monto_pago" class="<?php echo $viewavaluosupervisor_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosupervisor_monto_pago" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->monto_pago->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosupervisor_edit->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->monto_pago->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_monto_pago" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_monto_pago">
<input type="text" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="x_monto_pago" id="x_monto_pago" size="10" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->monto_pago->EditValue ?>"<?php echo $viewavaluosupervisor->monto_pago->EditAttributes() ?>>
</span>
</script>
<?php echo $viewavaluosupervisor->monto_pago->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_monto_pago">
		<td class="col-sm-3"><span id="elh_viewavaluosupervisor_monto_pago"><script id="tpc_viewavaluosupervisor_monto_pago" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->monto_pago->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosupervisor->monto_pago->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_monto_pago" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_monto_pago">
<input type="text" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="x_monto_pago" id="x_monto_pago" size="10" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->monto_pago->EditValue ?>"<?php echo $viewavaluosupervisor->monto_pago->EditAttributes() ?>>
</span>
</script>
<?php echo $viewavaluosupervisor->monto_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->montoincial->Visible) { // montoincial ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_montoincial" class="form-group">
		<label id="elh_viewavaluosupervisor_montoincial" for="x_montoincial" class="<?php echo $viewavaluosupervisor_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosupervisor_montoincial" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->montoincial->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosupervisor_edit->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->montoincial->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_montoincial" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_montoincial">
<input type="text" data-table="viewavaluosupervisor" data-field="x_montoincial" name="x_montoincial" id="x_montoincial" size="10" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->montoincial->EditValue ?>"<?php echo $viewavaluosupervisor->montoincial->EditAttributes() ?>>
</span>
</script>
<?php echo $viewavaluosupervisor->montoincial->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_montoincial">
		<td class="col-sm-3"><span id="elh_viewavaluosupervisor_montoincial"><script id="tpc_viewavaluosupervisor_montoincial" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->montoincial->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosupervisor->montoincial->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_montoincial" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_montoincial">
<input type="text" data-table="viewavaluosupervisor" data-field="x_montoincial" name="x_montoincial" id="x_montoincial" size="10" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->montoincial->EditValue ?>"<?php echo $viewavaluosupervisor->montoincial->EditAttributes() ?>>
</span>
</script>
<?php echo $viewavaluosupervisor->montoincial->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->comentario->Visible) { // comentario ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_comentario" class="form-group">
		<label id="elh_viewavaluosupervisor_comentario" for="x_comentario" class="<?php echo $viewavaluosupervisor_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosupervisor_comentario" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->comentario->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosupervisor_edit->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->comentario->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_comentario" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_comentario">
<textarea data-table="viewavaluosupervisor" data-field="x_comentario" name="x_comentario" id="x_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluosupervisor->comentario->EditAttributes() ?>><?php echo $viewavaluosupervisor->comentario->EditValue ?></textarea>
</span>
</script>
<?php echo $viewavaluosupervisor->comentario->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_comentario">
		<td class="col-sm-3"><span id="elh_viewavaluosupervisor_comentario"><script id="tpc_viewavaluosupervisor_comentario" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->comentario->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosupervisor->comentario->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_comentario" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_comentario">
<textarea data-table="viewavaluosupervisor" data-field="x_comentario" name="x_comentario" id="x_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluosupervisor->comentario->EditAttributes() ?>><?php echo $viewavaluosupervisor->comentario->EditValue ?></textarea>
</span>
</script>
<?php echo $viewavaluosupervisor->comentario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->ModifiedBy->Visible) { // ModifiedBy ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
	<div id="r_ModifiedBy" class="form-group">
		<label id="elh_viewavaluosupervisor_ModifiedBy" for="x_ModifiedBy" class="<?php echo $viewavaluosupervisor_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosupervisor_ModifiedBy" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->ModifiedBy->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosupervisor_edit->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->ModifiedBy->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_ModifiedBy" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_ModifiedBy">
<span<?php echo $viewavaluosupervisor->ModifiedBy->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->ModifiedBy->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_ModifiedBy" name="x_ModifiedBy" id="x_ModifiedBy" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->ModifiedBy->CurrentValue) ?>">
<?php echo $viewavaluosupervisor->ModifiedBy->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ModifiedBy">
		<td class="col-sm-3"><span id="elh_viewavaluosupervisor_ModifiedBy"><script id="tpc_viewavaluosupervisor_ModifiedBy" class="viewavaluosupervisoredit" type="text/html"><span><?php echo $viewavaluosupervisor->ModifiedBy->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosupervisor->ModifiedBy->CellAttributes() ?>>
<script id="tpx_viewavaluosupervisor_ModifiedBy" class="viewavaluosupervisoredit" type="text/html">
<span id="el_viewavaluosupervisor_ModifiedBy">
<span<?php echo $viewavaluosupervisor->ModifiedBy->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosupervisor->ModifiedBy->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_ModifiedBy" name="x_ModifiedBy" id="x_ModifiedBy" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->ModifiedBy->CurrentValue) ?>">
<?php echo $viewavaluosupervisor->ModifiedBy->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<input type="hidden" data-table="viewavaluosupervisor" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($viewavaluosupervisor->id->CurrentValue) ?>">
<?php
	if (in_array("viewdocumentosupervisor", explode(",", $viewavaluosupervisor->getCurrentDetailTable())) && $viewdocumentosupervisor->DetailEdit) {
?>
<?php if ($viewavaluosupervisor->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("viewdocumentosupervisor", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "viewdocumentosupervisorgrid.php" ?>
<?php } ?>
<?php if (!$viewavaluosupervisor_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $viewavaluosupervisor_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $viewavaluosupervisor_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$viewavaluosupervisor_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($viewavaluosupervisor->Rows) ?> };
ew_ApplyTemplate("tpd_viewavaluosupervisoredit", "tpm_viewavaluosupervisoredit", "viewavaluosupervisoredit", "<?php echo $viewavaluosupervisor->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.viewavaluosupervisoredit_js").each(function(){ew_AddScript(this.text);});
</script>
<script type="text/javascript">
fviewavaluosupervisoredit.Init();
</script>
<?php
$viewavaluosupervisor_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$viewavaluosupervisor_edit->Page_Terminate();
?>
