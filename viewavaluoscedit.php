<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "viewavaluoscinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "pago_avaluogridcls.php" ?>
<?php include_once "viewdocumentosavaluoscgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$viewavaluosc_edit = NULL; // Initialize page object first

class cviewavaluosc_edit extends cviewavaluosc {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewavaluosc';

	// Page object name
	var $PageObjName = 'viewavaluosc_edit';

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

		// Table object (viewavaluosc)
		if (!isset($GLOBALS["viewavaluosc"]) || get_class($GLOBALS["viewavaluosc"]) == "cviewavaluosc") {
			$GLOBALS["viewavaluosc"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["viewavaluosc"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'viewavaluosc', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("viewavaluosclist.php"));
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
				if (in_array("pago_avaluo", $DetailTblVar)) {

					// Process auto fill for detail table 'pago_avaluo'
					if (preg_match('/^fpago_avaluo(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["pago_avaluo_grid"])) $GLOBALS["pago_avaluo_grid"] = new cpago_avaluo_grid;
						$GLOBALS["pago_avaluo_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
				if (in_array("viewdocumentosavaluosc", $DetailTblVar)) {

					// Process auto fill for detail table 'viewdocumentosavaluosc'
					if (preg_match('/^fviewdocumentosavaluosc(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["viewdocumentosavaluosc_grid"])) $GLOBALS["viewdocumentosavaluosc_grid"] = new cviewdocumentosavaluosc_grid;
						$GLOBALS["viewdocumentosavaluosc_grid"]->Page_Init();
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
		global $EW_EXPORT, $viewavaluosc;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
			if (is_array(@$_SESSION[EW_SESSION_TEMP_IMAGES])) // Restore temp images
				$gTmpImages = @$_SESSION[EW_SESSION_TEMP_IMAGES];
			if (@$_POST["data"] <> "")
				$sContent = $_POST["data"];
			$gsExportFile = @$_POST["filename"];
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($viewavaluosc);
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
					if ($pageName == "viewavaluoscview.php")
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
	var $DetailPages; // Detail pages object

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
					$this->Page_Terminate("viewavaluosclist.php"); // No matching record, return to list
				}

				// Set up detail parameters
				$this->SetupDetailParms();
				break;
			Case "U": // Update
				if ($this->getCurrentDetailTable() <> "") // Master/detail edit
					$sReturnUrl = $this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $this->getCurrentDetailTable()); // Master/Detail view page
				else
					$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "viewavaluosclist.php")
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
		$this->documento_pago->Upload->Index = $objForm->Index;
		$this->documento_pago->Upload->UploadFile();
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
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
		if (!$this->monto_pago->FldIsDetailKey) {
			$this->monto_pago->setFormValue($objForm->GetValue("x_monto_pago"));
		}
		if (!$this->comentario->FldIsDetailKey) {
			$this->comentario->setFormValue($objForm->GetValue("x_comentario"));
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
		$this->monto_pago->setDbValue($row['monto_pago']);
		$this->comentario->setDbValue($row['comentario']);
		$this->documento_pago->Upload->DbValue = $row['documento_pago'];
		if (is_array($this->documento_pago->Upload->DbValue) || is_object($this->documento_pago->Upload->DbValue)) // Byte array
			$this->documento_pago->Upload->DbValue = ew_BytesToStr($this->documento_pago->Upload->DbValue);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['codigoavaluo'] = NULL;
		$row['tipoinmueble'] = NULL;
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
		$row['monto_pago'] = NULL;
		$row['comentario'] = NULL;
		$row['documento_pago'] = NULL;
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
		$this->monto_pago->DbValue = $row['monto_pago'];
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
		// monto_pago
		// comentario
		// documento_pago

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->estadointerno->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->estadointerno->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
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

		// monto_pago
		$this->monto_pago->ViewValue = $this->monto_pago->CurrentValue;
		$this->monto_pago->ViewCustomAttributes = "";

		// comentario
		$this->comentario->ViewValue = $this->comentario->CurrentValue;
		$this->comentario->ViewCustomAttributes = "";

		// documento_pago
		if (!ew_Empty($this->documento_pago->Upload->DbValue)) {
			$this->documento_pago->ViewValue = "viewavaluosc_documento_pago_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->documento_pago->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->documento_pago->Upload->DbValue, 0, 11)));
		} else {
			$this->documento_pago->ViewValue = "";
		}
		$this->documento_pago->ViewCustomAttributes = "";

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
				$this->documento_pago->HrefValue = "viewavaluosc_documento_pago_bv.php?id=" . $this->id->CurrentValue;
				$this->documento_pago->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->documento_pago->HrefValue = ew_FullUrl($this->documento_pago->HrefValue, "href");
			} else {
				$this->documento_pago->HrefValue = "";
			}
			$this->documento_pago->HrefValue2 = "viewavaluosc_documento_pago_bv.php?id=" . $this->id->CurrentValue;
			$this->documento_pago->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// codigoavaluo
			$this->codigoavaluo->EditAttrs["class"] = "form-control";
			$this->codigoavaluo->EditCustomAttributes = "";
			$this->codigoavaluo->EditValue = $this->codigoavaluo->CurrentValue;
			$this->codigoavaluo->ViewCustomAttributes = "";

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
				$this->documento_pago->EditValue = "viewavaluosc_documento_pago_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->documento_pago->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->documento_pago->Upload->DbValue, 0, 11)));
			} else {
				$this->documento_pago->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->documento_pago);

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

			// monto_pago
			$this->monto_pago->LinkCustomAttributes = "";
			$this->monto_pago->HrefValue = "";

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";

			// documento_pago
			$this->documento_pago->LinkCustomAttributes = "";
			if (!empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->HrefValue = "viewavaluosc_documento_pago_bv.php?id=" . $this->id->CurrentValue;
				$this->documento_pago->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->documento_pago->HrefValue = ew_FullUrl($this->documento_pago->HrefValue, "href");
			} else {
				$this->documento_pago->HrefValue = "";
			}
			$this->documento_pago->HrefValue2 = "viewavaluosc_documento_pago_bv.php?id=" . $this->id->CurrentValue;
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

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("pago_avaluo", $DetailTblVar) && $GLOBALS["pago_avaluo"]->DetailEdit) {
			if (!isset($GLOBALS["pago_avaluo_grid"])) $GLOBALS["pago_avaluo_grid"] = new cpago_avaluo_grid(); // get detail page object
			$GLOBALS["pago_avaluo_grid"]->ValidateGridForm();
		}
		if (in_array("viewdocumentosavaluosc", $DetailTblVar) && $GLOBALS["viewdocumentosavaluosc"]->DetailEdit) {
			if (!isset($GLOBALS["viewdocumentosavaluosc_grid"])) $GLOBALS["viewdocumentosavaluosc_grid"] = new cviewdocumentosavaluosc_grid(); // get detail page object
			$GLOBALS["viewdocumentosavaluosc_grid"]->ValidateGridForm();
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

			// monto_pago
			$this->monto_pago->SetDbValueDef($rsnew, $this->monto_pago->CurrentValue, NULL, $this->monto_pago->ReadOnly);

			// comentario
			$this->comentario->SetDbValueDef($rsnew, $this->comentario->CurrentValue, NULL, $this->comentario->ReadOnly);

			// documento_pago
			if ($this->documento_pago->Visible && !$this->documento_pago->ReadOnly && !$this->documento_pago->Upload->KeepFile) {
				if (is_null($this->documento_pago->Upload->Value)) {
					$rsnew['documento_pago'] = NULL;
				} else {
					$rsnew['documento_pago'] = $this->documento_pago->Upload->Value;
				}
			}

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
					if (in_array("pago_avaluo", $DetailTblVar) && $GLOBALS["pago_avaluo"]->DetailEdit) {
						if (!isset($GLOBALS["pago_avaluo_grid"])) $GLOBALS["pago_avaluo_grid"] = new cpago_avaluo_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "pago_avaluo"); // Load user level of detail table
						$EditRow = $GLOBALS["pago_avaluo_grid"]->GridUpdate();
						$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
					}
				}
				if ($EditRow) {
					if (in_array("viewdocumentosavaluosc", $DetailTblVar) && $GLOBALS["viewdocumentosavaluosc"]->DetailEdit) {
						if (!isset($GLOBALS["viewdocumentosavaluosc_grid"])) $GLOBALS["viewdocumentosavaluosc_grid"] = new cviewdocumentosavaluosc_grid(); // Get detail page object
						$Security->LoadCurrentUserLevel($this->ProjectID . "viewdocumentosavaluosc"); // Load user level of detail table
						$EditRow = $GLOBALS["viewdocumentosavaluosc_grid"]->GridUpdate();
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

		// documento_pago
		ew_CleanUploadTempPath($this->documento_pago, $this->documento_pago->Upload->Index);
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
			if (in_array("pago_avaluo", $DetailTblVar)) {
				if (!isset($GLOBALS["pago_avaluo_grid"]))
					$GLOBALS["pago_avaluo_grid"] = new cpago_avaluo_grid;
				if ($GLOBALS["pago_avaluo_grid"]->DetailEdit) {
					$GLOBALS["pago_avaluo_grid"]->CurrentMode = "edit";
					$GLOBALS["pago_avaluo_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["pago_avaluo_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["pago_avaluo_grid"]->setStartRecordNumber(1);
					$GLOBALS["pago_avaluo_grid"]->avaluo_id->FldIsDetailKey = TRUE;
					$GLOBALS["pago_avaluo_grid"]->avaluo_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["pago_avaluo_grid"]->avaluo_id->setSessionValue($GLOBALS["pago_avaluo_grid"]->avaluo_id->CurrentValue);
				}
			}
			if (in_array("viewdocumentosavaluosc", $DetailTblVar)) {
				if (!isset($GLOBALS["viewdocumentosavaluosc_grid"]))
					$GLOBALS["viewdocumentosavaluosc_grid"] = new cviewdocumentosavaluosc_grid;
				if ($GLOBALS["viewdocumentosavaluosc_grid"]->DetailEdit) {
					$GLOBALS["viewdocumentosavaluosc_grid"]->CurrentMode = "edit";
					$GLOBALS["viewdocumentosavaluosc_grid"]->CurrentAction = "gridedit";

					// Save current master table to detail table
					$GLOBALS["viewdocumentosavaluosc_grid"]->setCurrentMasterTable($this->TableVar);
					$GLOBALS["viewdocumentosavaluosc_grid"]->setStartRecordNumber(1);
					$GLOBALS["viewdocumentosavaluosc_grid"]->avaluo->FldIsDetailKey = TRUE;
					$GLOBALS["viewdocumentosavaluosc_grid"]->avaluo->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["viewdocumentosavaluosc_grid"]->avaluo->setSessionValue($GLOBALS["viewdocumentosavaluosc_grid"]->avaluo->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("viewavaluosclist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Set up detail pages
	function SetupDetailPages() {
		$pages = new cSubPages();
		$pages->Style = "tabs";
		$pages->Add('pago_avaluo');
		$pages->Add('viewdocumentosavaluosc');
		$this->DetailPages = $pages;
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
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
if (!isset($viewavaluosc_edit)) $viewavaluosc_edit = new cviewavaluosc_edit();

// Page init
$viewavaluosc_edit->Page_Init();

// Page main
$viewavaluosc_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewavaluosc_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fviewavaluoscedit = new ew_Form("fviewavaluoscedit", "edit");

// Validate form
fviewavaluoscedit.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosc->monto_pago->FldErrMsg()) ?>");

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
fviewavaluoscedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluoscedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluoscedit.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_id","x_name","x_lastname","x__email"],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
fviewavaluoscedit.Lists["x_id_solicitud"].Data = "<?php echo $viewavaluosc_edit->id_solicitud->LookupFilterQuery(FALSE, "edit") ?>";
fviewavaluoscedit.AutoSuggests["x_id_solicitud"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluosc_edit->id_solicitud->LookupFilterQuery(TRUE, "edit"))) ?>;
fviewavaluoscedit.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fviewavaluoscedit.Lists["x_id_oficialcredito"].Data = "<?php echo $viewavaluosc_edit->id_oficialcredito->LookupFilterQuery(FALSE, "edit") ?>";
fviewavaluoscedit.Lists["x_id_inspector"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_apellido","x_nombre","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"inspector"};
fviewavaluoscedit.Lists["x_id_inspector"].Data = "<?php echo $viewavaluosc_edit->id_inspector->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $viewavaluosc_edit->ShowPageHeader(); ?>
<?php
$viewavaluosc_edit->ShowMessage();
?>
<form name="fviewavaluoscedit" id="fviewavaluoscedit" class="<?php echo $viewavaluosc_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewavaluosc_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewavaluosc_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewavaluosc">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($viewavaluosc_edit->IsModal) ?>">
<div id="tpd_viewavaluoscedit" class="ewCustomTemplate"></div>
<script id="tpm_viewavaluoscedit" type="text/html">
<div id="ct_viewavaluosc_edit"><tr>
test
</tr>
</div>
</script>
<?php if (!$viewavaluosc_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($viewavaluosc_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv hidden"><!-- page* -->
<?php } else { ?>
<table id="tbl_viewavaluoscedit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable hidden"><!-- table* -->
<?php } ?>
<?php if ($viewavaluosc->codigoavaluo->Visible) { // codigoavaluo ?>
<?php if ($viewavaluosc_edit->IsMobileOrModal) { ?>
	<div id="r_codigoavaluo" class="form-group">
		<label id="elh_viewavaluosc_codigoavaluo" for="x_codigoavaluo" class="<?php echo $viewavaluosc_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosc_codigoavaluo" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->codigoavaluo->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosc_edit->RightColumnClass ?>"><div<?php echo $viewavaluosc->codigoavaluo->CellAttributes() ?>>
<script id="tpx_viewavaluosc_codigoavaluo" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_codigoavaluo">
<span<?php echo $viewavaluosc->codigoavaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosc->codigoavaluo->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosc" data-field="x_codigoavaluo" name="x_codigoavaluo" id="x_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluosc->codigoavaluo->CurrentValue) ?>">
<?php echo $viewavaluosc->codigoavaluo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_codigoavaluo">
		<td class="col-sm-3"><span id="elh_viewavaluosc_codigoavaluo"><script id="tpc_viewavaluosc_codigoavaluo" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->codigoavaluo->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosc->codigoavaluo->CellAttributes() ?>>
<script id="tpx_viewavaluosc_codigoavaluo" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_codigoavaluo">
<span<?php echo $viewavaluosc->codigoavaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosc->codigoavaluo->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosc" data-field="x_codigoavaluo" name="x_codigoavaluo" id="x_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluosc->codigoavaluo->CurrentValue) ?>">
<?php echo $viewavaluosc->codigoavaluo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->id_solicitud->Visible) { // id_solicitud ?>
<?php if ($viewavaluosc_edit->IsMobileOrModal) { ?>
	<div id="r_id_solicitud" class="form-group">
		<label id="elh_viewavaluosc_id_solicitud" class="<?php echo $viewavaluosc_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosc_id_solicitud" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->id_solicitud->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosc_edit->RightColumnClass ?>"><div<?php echo $viewavaluosc->id_solicitud->CellAttributes() ?>>
<script id="tpx_viewavaluosc_id_solicitud" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_id_solicitud">
<span<?php echo $viewavaluosc->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosc->id_solicitud->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosc" data-field="x_id_solicitud" name="x_id_solicitud" id="x_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosc->id_solicitud->CurrentValue) ?>">
<script type="text/html" class="viewavaluoscedit_js">
fviewavaluoscedit.CreateAutoSuggest({"id":"x_id_solicitud","forceSelect":false});
</script>
<?php echo $viewavaluosc->id_solicitud->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_solicitud">
		<td class="col-sm-3"><span id="elh_viewavaluosc_id_solicitud"><script id="tpc_viewavaluosc_id_solicitud" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->id_solicitud->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosc->id_solicitud->CellAttributes() ?>>
<script id="tpx_viewavaluosc_id_solicitud" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_id_solicitud">
<span<?php echo $viewavaluosc->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosc->id_solicitud->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosc" data-field="x_id_solicitud" name="x_id_solicitud" id="x_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluosc->id_solicitud->CurrentValue) ?>">
<script type="text/html" class="viewavaluoscedit_js">
fviewavaluoscedit.CreateAutoSuggest({"id":"x_id_solicitud","forceSelect":false});
</script>
<?php echo $viewavaluosc->id_solicitud->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->id_oficialcredito->Visible) { // id_oficialcredito ?>
<?php if ($viewavaluosc_edit->IsMobileOrModal) { ?>
	<div id="r_id_oficialcredito" class="form-group">
		<label id="elh_viewavaluosc_id_oficialcredito" for="x_id_oficialcredito" class="<?php echo $viewavaluosc_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosc_id_oficialcredito" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->id_oficialcredito->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosc_edit->RightColumnClass ?>"><div<?php echo $viewavaluosc->id_oficialcredito->CellAttributes() ?>>
<script id="tpx_viewavaluosc_id_oficialcredito" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_id_oficialcredito">
<span<?php echo $viewavaluosc->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosc->id_oficialcredito->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosc" data-field="x_id_oficialcredito" name="x_id_oficialcredito" id="x_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosc->id_oficialcredito->CurrentValue) ?>">
<?php echo $viewavaluosc->id_oficialcredito->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_oficialcredito">
		<td class="col-sm-3"><span id="elh_viewavaluosc_id_oficialcredito"><script id="tpc_viewavaluosc_id_oficialcredito" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->id_oficialcredito->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosc->id_oficialcredito->CellAttributes() ?>>
<script id="tpx_viewavaluosc_id_oficialcredito" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_id_oficialcredito">
<span<?php echo $viewavaluosc->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosc->id_oficialcredito->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosc" data-field="x_id_oficialcredito" name="x_id_oficialcredito" id="x_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosc->id_oficialcredito->CurrentValue) ?>">
<?php echo $viewavaluosc->id_oficialcredito->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->id_inspector->Visible) { // id_inspector ?>
<?php if ($viewavaluosc_edit->IsMobileOrModal) { ?>
	<div id="r_id_inspector" class="form-group">
		<label id="elh_viewavaluosc_id_inspector" for="x_id_inspector" class="<?php echo $viewavaluosc_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosc_id_inspector" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->id_inspector->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosc_edit->RightColumnClass ?>"><div<?php echo $viewavaluosc->id_inspector->CellAttributes() ?>>
<script id="tpx_viewavaluosc_id_inspector" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_id_inspector">
<span<?php echo $viewavaluosc->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosc->id_inspector->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosc" data-field="x_id_inspector" name="x_id_inspector" id="x_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosc->id_inspector->CurrentValue) ?>">
<?php echo $viewavaluosc->id_inspector->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_inspector">
		<td class="col-sm-3"><span id="elh_viewavaluosc_id_inspector"><script id="tpc_viewavaluosc_id_inspector" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->id_inspector->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosc->id_inspector->CellAttributes() ?>>
<script id="tpx_viewavaluosc_id_inspector" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_id_inspector">
<span<?php echo $viewavaluosc->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosc->id_inspector->EditValue ?></p></span>
</span>
</script>
<input type="hidden" data-table="viewavaluosc" data-field="x_id_inspector" name="x_id_inspector" id="x_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosc->id_inspector->CurrentValue) ?>">
<?php echo $viewavaluosc->id_inspector->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->monto_pago->Visible) { // monto_pago ?>
<?php if ($viewavaluosc_edit->IsMobileOrModal) { ?>
	<div id="r_monto_pago" class="form-group">
		<label id="elh_viewavaluosc_monto_pago" for="x_monto_pago" class="<?php echo $viewavaluosc_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosc_monto_pago" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->monto_pago->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosc_edit->RightColumnClass ?>"><div<?php echo $viewavaluosc->monto_pago->CellAttributes() ?>>
<script id="tpx_viewavaluosc_monto_pago" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_monto_pago">
<input type="text" data-table="viewavaluosc" data-field="x_monto_pago" name="x_monto_pago" id="x_monto_pago" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosc->monto_pago->getPlaceHolder()) ?>" value="<?php echo $viewavaluosc->monto_pago->EditValue ?>"<?php echo $viewavaluosc->monto_pago->EditAttributes() ?>>
</span>
</script>
<?php echo $viewavaluosc->monto_pago->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_monto_pago">
		<td class="col-sm-3"><span id="elh_viewavaluosc_monto_pago"><script id="tpc_viewavaluosc_monto_pago" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->monto_pago->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosc->monto_pago->CellAttributes() ?>>
<script id="tpx_viewavaluosc_monto_pago" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_monto_pago">
<input type="text" data-table="viewavaluosc" data-field="x_monto_pago" name="x_monto_pago" id="x_monto_pago" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosc->monto_pago->getPlaceHolder()) ?>" value="<?php echo $viewavaluosc->monto_pago->EditValue ?>"<?php echo $viewavaluosc->monto_pago->EditAttributes() ?>>
</span>
</script>
<?php echo $viewavaluosc->monto_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->comentario->Visible) { // comentario ?>
<?php if ($viewavaluosc_edit->IsMobileOrModal) { ?>
	<div id="r_comentario" class="form-group">
		<label id="elh_viewavaluosc_comentario" for="x_comentario" class="<?php echo $viewavaluosc_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosc_comentario" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->comentario->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosc_edit->RightColumnClass ?>"><div<?php echo $viewavaluosc->comentario->CellAttributes() ?>>
<script id="tpx_viewavaluosc_comentario" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_comentario">
<textarea data-table="viewavaluosc" data-field="x_comentario" name="x_comentario" id="x_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluosc->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluosc->comentario->EditAttributes() ?>><?php echo $viewavaluosc->comentario->EditValue ?></textarea>
</span>
</script>
<?php echo $viewavaluosc->comentario->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_comentario">
		<td class="col-sm-3"><span id="elh_viewavaluosc_comentario"><script id="tpc_viewavaluosc_comentario" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->comentario->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosc->comentario->CellAttributes() ?>>
<script id="tpx_viewavaluosc_comentario" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_comentario">
<textarea data-table="viewavaluosc" data-field="x_comentario" name="x_comentario" id="x_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluosc->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluosc->comentario->EditAttributes() ?>><?php echo $viewavaluosc->comentario->EditValue ?></textarea>
</span>
</script>
<?php echo $viewavaluosc->comentario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->documento_pago->Visible) { // documento_pago ?>
<?php if ($viewavaluosc_edit->IsMobileOrModal) { ?>
	<div id="r_documento_pago" class="form-group">
		<label id="elh_viewavaluosc_documento_pago" class="<?php echo $viewavaluosc_edit->LeftColumnClass ?>"><script id="tpc_viewavaluosc_documento_pago" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->documento_pago->FldCaption() ?></span></script></label>
		<div class="<?php echo $viewavaluosc_edit->RightColumnClass ?>"><div<?php echo $viewavaluosc->documento_pago->CellAttributes() ?>>
<script id="tpx_viewavaluosc_documento_pago" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_documento_pago">
<div id="fd_x_documento_pago">
<span title="<?php echo $viewavaluosc->documento_pago->FldTitle() ? $viewavaluosc->documento_pago->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewavaluosc->documento_pago->ReadOnly || $viewavaluosc->documento_pago->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewavaluosc" data-field="x_documento_pago" name="x_documento_pago" id="x_documento_pago"<?php echo $viewavaluosc->documento_pago->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_documento_pago" id= "fn_x_documento_pago" value="<?php echo $viewavaluosc->documento_pago->Upload->FileName ?>">
<?php if (@$_POST["fa_x_documento_pago"] == "0") { ?>
<input type="hidden" name="fa_x_documento_pago" id= "fa_x_documento_pago" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_documento_pago" id= "fa_x_documento_pago" value="1">
<?php } ?>
<input type="hidden" name="fs_x_documento_pago" id= "fs_x_documento_pago" value="0">
<input type="hidden" name="fx_x_documento_pago" id= "fx_x_documento_pago" value="<?php echo $viewavaluosc->documento_pago->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_documento_pago" id= "fm_x_documento_pago" value="<?php echo $viewavaluosc->documento_pago->UploadMaxFileSize ?>">
</div>
<table id="ft_x_documento_pago" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
</script>
<?php echo $viewavaluosc->documento_pago->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_documento_pago">
		<td class="col-sm-3"><span id="elh_viewavaluosc_documento_pago"><script id="tpc_viewavaluosc_documento_pago" class="viewavaluoscedit" type="text/html"><span><?php echo $viewavaluosc->documento_pago->FldCaption() ?></span></script></span></td>
		<td<?php echo $viewavaluosc->documento_pago->CellAttributes() ?>>
<script id="tpx_viewavaluosc_documento_pago" class="viewavaluoscedit" type="text/html">
<span id="el_viewavaluosc_documento_pago">
<div id="fd_x_documento_pago">
<span title="<?php echo $viewavaluosc->documento_pago->FldTitle() ? $viewavaluosc->documento_pago->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewavaluosc->documento_pago->ReadOnly || $viewavaluosc->documento_pago->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewavaluosc" data-field="x_documento_pago" name="x_documento_pago" id="x_documento_pago"<?php echo $viewavaluosc->documento_pago->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_documento_pago" id= "fn_x_documento_pago" value="<?php echo $viewavaluosc->documento_pago->Upload->FileName ?>">
<?php if (@$_POST["fa_x_documento_pago"] == "0") { ?>
<input type="hidden" name="fa_x_documento_pago" id= "fa_x_documento_pago" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_documento_pago" id= "fa_x_documento_pago" value="1">
<?php } ?>
<input type="hidden" name="fs_x_documento_pago" id= "fs_x_documento_pago" value="0">
<input type="hidden" name="fx_x_documento_pago" id= "fx_x_documento_pago" value="<?php echo $viewavaluosc->documento_pago->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_documento_pago" id= "fm_x_documento_pago" value="<?php echo $viewavaluosc->documento_pago->UploadMaxFileSize ?>">
</div>
<table id="ft_x_documento_pago" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
</script>
<?php echo $viewavaluosc->documento_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosc_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<input type="hidden" data-table="viewavaluosc" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($viewavaluosc->id->CurrentValue) ?>">
<?php if ($viewavaluosc->getCurrentDetailTable() <> "") { ?>
<?php
	$viewavaluosc_edit->DetailPages->ValidKeys = explode(",", $viewavaluosc->getCurrentDetailTable());
	$FirstActiveDetailTable = $viewavaluosc_edit->DetailPages->ActivePageIndex();
?>
<div class="ewDetailPages"><!-- detail-pages -->
<div class="nav-tabs-custom" id="viewavaluosc_edit_details"><!-- .nav-tabs-custom -->
	<ul class="nav<?php echo $viewavaluosc_edit->DetailPages->NavStyle() ?>"><!-- .nav -->
<?php
	if (in_array("pago_avaluo", explode(",", $viewavaluosc->getCurrentDetailTable())) && $pago_avaluo->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "pago_avaluo") {
			$FirstActiveDetailTable = "pago_avaluo";
		}
?>
		<li<?php echo $viewavaluosc_edit->DetailPages->TabStyle("pago_avaluo") ?>><a href="#tab_pago_avaluo" data-toggle="tab"><?php echo $Language->TablePhrase("pago_avaluo", "TblCaption") ?></a></li>
<?php
	}
?>
<?php
	if (in_array("viewdocumentosavaluosc", explode(",", $viewavaluosc->getCurrentDetailTable())) && $viewdocumentosavaluosc->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "viewdocumentosavaluosc") {
			$FirstActiveDetailTable = "viewdocumentosavaluosc";
		}
?>
		<li<?php echo $viewavaluosc_edit->DetailPages->TabStyle("viewdocumentosavaluosc") ?>><a href="#tab_viewdocumentosavaluosc" data-toggle="tab"><?php echo $Language->TablePhrase("viewdocumentosavaluosc", "TblCaption") ?></a></li>
<?php
	}
?>
	</ul><!-- /.nav -->
	<div class="tab-content"><!-- .tab-content -->
<?php
	if (in_array("pago_avaluo", explode(",", $viewavaluosc->getCurrentDetailTable())) && $pago_avaluo->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "pago_avaluo") {
			$FirstActiveDetailTable = "pago_avaluo";
		}
?>
		<div class="tab-pane<?php echo $viewavaluosc_edit->DetailPages->PageStyle("pago_avaluo") ?>" id="tab_pago_avaluo"><!-- page* -->
<?php include_once "pago_avaluogrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
<?php
	if (in_array("viewdocumentosavaluosc", explode(",", $viewavaluosc->getCurrentDetailTable())) && $viewdocumentosavaluosc->DetailEdit) {
		if ($FirstActiveDetailTable == "" || $FirstActiveDetailTable == "viewdocumentosavaluosc") {
			$FirstActiveDetailTable = "viewdocumentosavaluosc";
		}
?>
		<div class="tab-pane<?php echo $viewavaluosc_edit->DetailPages->PageStyle("viewdocumentosavaluosc") ?>" id="tab_viewdocumentosavaluosc"><!-- page* -->
<?php include_once "viewdocumentosavaluoscgrid.php" ?>
		</div><!-- /page* -->
<?php } ?>
	</div><!-- /.tab-content -->
</div><!-- /.nav-tabs-custom -->
</div><!-- /detail-pages -->
<?php } ?>
<?php if (!$viewavaluosc_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $viewavaluosc_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $viewavaluosc_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$viewavaluosc_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($viewavaluosc->Rows) ?> };
ew_ApplyTemplate("tpd_viewavaluoscedit", "tpm_viewavaluoscedit", "viewavaluoscedit", "<?php echo $viewavaluosc->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.viewavaluoscedit_js").each(function(){ew_AddScript(this.text);});
</script>
<script type="text/javascript">
fviewavaluoscedit.Init();
</script>
<?php
$viewavaluosc_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$viewavaluosc_edit->Page_Terminate();
?>
