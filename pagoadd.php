<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "pagoinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "clienteinfo.php" ?>
<?php include_once "pago_avaluogridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$pago_add = NULL; // Initialize page object first

class cpago_add extends cpago {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'pago';

	// Page object name
	var $PageObjName = 'pago_add';

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

		// Table object (pago)
		if (!isset($GLOBALS["pago"]) || get_class($GLOBALS["pago"]) == "cpago") {
			$GLOBALS["pago"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pago"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Table object (cliente)
		if (!isset($GLOBALS['cliente'])) $GLOBALS['cliente'] = new ccliente();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pago', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("pagolist.php"));
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
		$this->code->SetVisibility();
		$this->cliente_id->SetVisibility();
		$this->status_id->SetVisibility();
		$this->created_at->SetVisibility();
		$this->metodopago_id->SetVisibility();
		$this->documento_pago->SetVisibility();

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
		global $EW_EXPORT, $pago;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($pago);
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
					if ($pageName == "pagoview.php")
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
					$this->Page_Terminate("pagolist.php"); // No matching record, return to list
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
					if (ew_GetPageName($sReturnUrl) == "pagolist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "pagoview.php")
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
		$this->k->CurrentValue = NULL;
		$this->k->OldValue = $this->k->CurrentValue;
		$this->code->CurrentValue = NULL;
		$this->code->OldValue = $this->code->CurrentValue;
		$this->cliente_id->CurrentValue = NULL;
		$this->cliente_id->OldValue = $this->cliente_id->CurrentValue;
		$this->status_id->CurrentValue = NULL;
		$this->status_id->OldValue = $this->status_id->CurrentValue;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->metodopago_id->CurrentValue = NULL;
		$this->metodopago_id->OldValue = $this->metodopago_id->CurrentValue;
		$this->documento_pago->Upload->DbValue = NULL;
		$this->documento_pago->OldValue = $this->documento_pago->Upload->DbValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->code->FldIsDetailKey) {
			$this->code->setFormValue($objForm->GetValue("x_code"));
		}
		if (!$this->cliente_id->FldIsDetailKey) {
			$this->cliente_id->setFormValue($objForm->GetValue("x_cliente_id"));
		}
		if (!$this->status_id->FldIsDetailKey) {
			$this->status_id->setFormValue($objForm->GetValue("x_status_id"));
		}
		if (!$this->created_at->FldIsDetailKey) {
			$this->created_at->setFormValue($objForm->GetValue("x_created_at"));
			$this->created_at->CurrentValue = ew_UnFormatDateTime($this->created_at->CurrentValue, 0);
		}
		if (!$this->metodopago_id->FldIsDetailKey) {
			$this->metodopago_id->setFormValue($objForm->GetValue("x_metodopago_id"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->code->CurrentValue = $this->code->FormValue;
		$this->cliente_id->CurrentValue = $this->cliente_id->FormValue;
		$this->status_id->CurrentValue = $this->status_id->FormValue;
		$this->created_at->CurrentValue = $this->created_at->FormValue;
		$this->created_at->CurrentValue = ew_UnFormatDateTime($this->created_at->CurrentValue, 0);
		$this->metodopago_id->CurrentValue = $this->metodopago_id->FormValue;
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
		$this->k->setDbValue($row['k']);
		$this->code->setDbValue($row['code']);
		$this->cliente_id->setDbValue($row['cliente_id']);
		$this->status_id->setDbValue($row['status_id']);
		$this->created_at->setDbValue($row['created_at']);
		$this->metodopago_id->setDbValue($row['metodopago_id']);
		$this->documento_pago->Upload->DbValue = $row['documento_pago'];
		if (is_array($this->documento_pago->Upload->DbValue) || is_object($this->documento_pago->Upload->DbValue)) // Byte array
			$this->documento_pago->Upload->DbValue = ew_BytesToStr($this->documento_pago->Upload->DbValue);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['id'] = $this->id->CurrentValue;
		$row['k'] = $this->k->CurrentValue;
		$row['code'] = $this->code->CurrentValue;
		$row['cliente_id'] = $this->cliente_id->CurrentValue;
		$row['status_id'] = $this->status_id->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		$row['metodopago_id'] = $this->metodopago_id->CurrentValue;
		$row['documento_pago'] = $this->documento_pago->Upload->DbValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->k->DbValue = $row['k'];
		$this->code->DbValue = $row['code'];
		$this->cliente_id->DbValue = $row['cliente_id'];
		$this->status_id->DbValue = $row['status_id'];
		$this->created_at->DbValue = $row['created_at'];
		$this->metodopago_id->DbValue = $row['metodopago_id'];
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
		// Call Row_Rendering event

		$this->Row_Rendering();

		// Common render codes for all row types
		// id
		// k
		// code
		// cliente_id
		// status_id
		// created_at
		// metodopago_id
		// documento_pago

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// code
		$this->code->ViewValue = $this->code->CurrentValue;
		$this->code->ViewCustomAttributes = "";

		// cliente_id
		if (strval($this->cliente_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->cliente_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
		$sWhereWrk = "";
		$this->cliente_id->LookupFilters = array("dx1" => '`name`', "dx2" => '`lastname`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->cliente_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->cliente_id->ViewValue = $this->cliente_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->cliente_id->ViewValue = $this->cliente_id->CurrentValue;
			}
		} else {
			$this->cliente_id->ViewValue = NULL;
		}
		$this->cliente_id->ViewCustomAttributes = "";

		// status_id
		if (strval($this->status_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->status_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
		$sWhereWrk = "";
		$this->status_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->status_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->status_id->ViewValue = $this->status_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->status_id->ViewValue = $this->status_id->CurrentValue;
			}
		} else {
			$this->status_id->ViewValue = NULL;
		}
		$this->status_id->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = ew_FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// metodopago_id
		if (strval($this->metodopago_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->metodopago_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `metodopago`";
		$sWhereWrk = "";
		$this->metodopago_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->metodopago_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->metodopago_id->ViewValue = $this->metodopago_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->metodopago_id->ViewValue = $this->metodopago_id->CurrentValue;
			}
		} else {
			$this->metodopago_id->ViewValue = NULL;
		}
		$this->metodopago_id->ViewCustomAttributes = "";

		// documento_pago
		if (!ew_Empty($this->documento_pago->Upload->DbValue)) {
			$this->documento_pago->ViewValue = "pago_documento_pago_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->documento_pago->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->documento_pago->Upload->DbValue, 0, 11)));
		} else {
			$this->documento_pago->ViewValue = "";
		}
		$this->documento_pago->ViewCustomAttributes = "";

			// code
			$this->code->LinkCustomAttributes = "";
			$this->code->HrefValue = "";
			$this->code->TooltipValue = "";

			// cliente_id
			$this->cliente_id->LinkCustomAttributes = "";
			$this->cliente_id->HrefValue = "";
			$this->cliente_id->TooltipValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";
			$this->status_id->TooltipValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";

			// metodopago_id
			$this->metodopago_id->LinkCustomAttributes = "";
			$this->metodopago_id->HrefValue = "";
			$this->metodopago_id->TooltipValue = "";

			// documento_pago
			$this->documento_pago->LinkCustomAttributes = "";
			if (!empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->HrefValue = "pago_documento_pago_bv.php?id=" . $this->id->CurrentValue;
				$this->documento_pago->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->documento_pago->HrefValue = ew_FullUrl($this->documento_pago->HrefValue, "href");
			} else {
				$this->documento_pago->HrefValue = "";
			}
			$this->documento_pago->HrefValue2 = "pago_documento_pago_bv.php?id=" . $this->id->CurrentValue;
			$this->documento_pago->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// code
			$this->code->EditAttrs["class"] = "form-control";
			$this->code->EditCustomAttributes = "";
			$this->code->EditValue = ew_HtmlEncode($this->code->CurrentValue);
			$this->code->PlaceHolder = ew_RemoveHtml($this->code->FldTitle());

			// cliente_id
			$this->cliente_id->EditCustomAttributes = "";
			if ($this->cliente_id->getSessionValue() <> "") {
				$this->cliente_id->CurrentValue = $this->cliente_id->getSessionValue();
			if (strval($this->cliente_id->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->cliente_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
			$sWhereWrk = "";
			$this->cliente_id->LookupFilters = array("dx1" => '`name`', "dx2" => '`lastname`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cliente_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$arwrk[2] = $rswrk->fields('Disp2Fld');
					$this->cliente_id->ViewValue = $this->cliente_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->cliente_id->ViewValue = $this->cliente_id->CurrentValue;
				}
			} else {
				$this->cliente_id->ViewValue = NULL;
			}
			$this->cliente_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->cliente_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->cliente_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cliente`";
			$sWhereWrk = "";
			$this->cliente_id->LookupFilters = array("dx1" => '`name`', "dx2" => '`lastname`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->cliente_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$arwrk[2] = ew_HtmlEncode($rswrk->fields('Disp2Fld'));
				$this->cliente_id->ViewValue = $this->cliente_id->DisplayValue($arwrk);
			} else {
				$this->cliente_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->cliente_id->EditValue = $arwrk;
			}

			// status_id
			$this->status_id->EditCustomAttributes = "";
			if (trim(strval($this->status_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->status_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadopago`";
			$sWhereWrk = "";
			$this->status_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->status_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->status_id->EditValue = $arwrk;

			// created_at
			// metodopago_id

			$this->metodopago_id->EditAttrs["class"] = "form-control";
			$this->metodopago_id->EditCustomAttributes = "";
			if (trim(strval($this->metodopago_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->metodopago_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `metodopago`";
			$sWhereWrk = "";
			$this->metodopago_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->metodopago_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->metodopago_id->EditValue = $arwrk;

			// documento_pago
			$this->documento_pago->EditAttrs["class"] = "form-control";
			$this->documento_pago->EditCustomAttributes = "";
			if (!ew_Empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->EditValue = "pago_documento_pago_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->documento_pago->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->documento_pago->Upload->DbValue, 0, 11)));
			} else {
				$this->documento_pago->EditValue = "";
			}
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->documento_pago);

			// Add refer script
			// code

			$this->code->LinkCustomAttributes = "";
			$this->code->HrefValue = "";

			// cliente_id
			$this->cliente_id->LinkCustomAttributes = "";
			$this->cliente_id->HrefValue = "";

			// status_id
			$this->status_id->LinkCustomAttributes = "";
			$this->status_id->HrefValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";

			// metodopago_id
			$this->metodopago_id->LinkCustomAttributes = "";
			$this->metodopago_id->HrefValue = "";

			// documento_pago
			$this->documento_pago->LinkCustomAttributes = "";
			if (!empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->HrefValue = "pago_documento_pago_bv.php?id=" . $this->id->CurrentValue;
				$this->documento_pago->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->documento_pago->HrefValue = ew_FullUrl($this->documento_pago->HrefValue, "href");
			} else {
				$this->documento_pago->HrefValue = "";
			}
			$this->documento_pago->HrefValue2 = "pago_documento_pago_bv.php?id=" . $this->id->CurrentValue;
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

		// Validate detail grid
		$DetailTblVar = explode(",", $this->getCurrentDetailTable());
		if (in_array("pago_avaluo", $DetailTblVar) && $GLOBALS["pago_avaluo"]->DetailAdd) {
			if (!isset($GLOBALS["pago_avaluo_grid"])) $GLOBALS["pago_avaluo_grid"] = new cpago_avaluo_grid(); // get detail page object
			$GLOBALS["pago_avaluo_grid"]->ValidateGridForm();
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

		// Check referential integrity for master table 'cliente'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_cliente();
		if (strval($this->cliente_id->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@id@", ew_AdjustSql($this->cliente_id->CurrentValue, "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			if (!isset($GLOBALS["cliente"])) $GLOBALS["cliente"] = new ccliente();
			$rsmaster = $GLOBALS["cliente"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "cliente", $Language->Phrase("RelatedRecordRequired"));
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

		// code
		$this->code->SetDbValueDef($rsnew, $this->code->CurrentValue, NULL, FALSE);

		// cliente_id
		$this->cliente_id->SetDbValueDef($rsnew, $this->cliente_id->CurrentValue, NULL, FALSE);

		// status_id
		$this->status_id->SetDbValueDef($rsnew, $this->status_id->CurrentValue, NULL, FALSE);

		// created_at
		$this->created_at->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
		$rsnew['created_at'] = &$this->created_at->DbValue;

		// metodopago_id
		$this->metodopago_id->SetDbValueDef($rsnew, $this->metodopago_id->CurrentValue, NULL, FALSE);

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
			if (in_array("pago_avaluo", $DetailTblVar) && $GLOBALS["pago_avaluo"]->DetailAdd) {
				$GLOBALS["pago_avaluo"]->pago_id->setSessionValue($this->id->CurrentValue); // Set master key
				if (!isset($GLOBALS["pago_avaluo_grid"])) $GLOBALS["pago_avaluo_grid"] = new cpago_avaluo_grid(); // Get detail page object
				$Security->LoadCurrentUserLevel($this->ProjectID . "pago_avaluo"); // Load user level of detail table
				$AddRow = $GLOBALS["pago_avaluo_grid"]->GridInsert();
				$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName); // Restore user level of master table
				if (!$AddRow)
					$GLOBALS["pago_avaluo"]->pago_id->setSessionValue(""); // Clear master key if insert failed
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
			if ($sMasterTblVar == "cliente") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["cliente"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->cliente_id->setQueryStringValue($GLOBALS["cliente"]->id->QueryStringValue);
					$this->cliente_id->setSessionValue($this->cliente_id->QueryStringValue);
					if (!is_numeric($GLOBALS["cliente"]->id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "cliente") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["cliente"]->id->setFormValue($_POST["fk_id"]);
					$this->cliente_id->setFormValue($GLOBALS["cliente"]->id->FormValue);
					$this->cliente_id->setSessionValue($this->cliente_id->FormValue);
					if (!is_numeric($GLOBALS["cliente"]->id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "cliente") {
				if ($this->cliente_id->CurrentValue == "") $this->cliente_id->setSessionValue("");
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
					$GLOBALS["pago_avaluo_grid"]->pago_id->FldIsDetailKey = TRUE;
					$GLOBALS["pago_avaluo_grid"]->pago_id->CurrentValue = $this->id->CurrentValue;
					$GLOBALS["pago_avaluo_grid"]->pago_id->setSessionValue($GLOBALS["pago_avaluo_grid"]->pago_id->CurrentValue);
				}
			}
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("pagolist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_cliente_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`name`', "dx2" => '`lastname`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->cliente_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_status_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->status_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_metodopago_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `short_name` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `metodopago`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->metodopago_id, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($pago_add)) $pago_add = new cpago_add();

// Page init
$pago_add->Page_Init();

// Page main
$pago_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pago_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fpagoadd = new ew_Form("fpagoadd", "add");

// Validate form
fpagoadd.Validate = function() {
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
fpagoadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpagoadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpagoadd.Lists["x_cliente_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cliente"};
fpagoadd.Lists["x_cliente_id"].Data = "<?php echo $pago_add->cliente_id->LookupFilterQuery(FALSE, "add") ?>";
fpagoadd.Lists["x_status_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadopago"};
fpagoadd.Lists["x_status_id"].Data = "<?php echo $pago_add->status_id->LookupFilterQuery(FALSE, "add") ?>";
fpagoadd.Lists["x_metodopago_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_short_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"metodopago"};
fpagoadd.Lists["x_metodopago_id"].Data = "<?php echo $pago_add->metodopago_id->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $pago_add->ShowPageHeader(); ?>
<?php
$pago_add->ShowMessage();
?>
<form name="fpagoadd" id="fpagoadd" class="<?php echo $pago_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pago_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pago_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pago">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($pago_add->IsModal) ?>">
<?php if ($pago->getCurrentMasterTable() == "cliente") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="cliente">
<input type="hidden" name="fk_id" value="<?php echo $pago->cliente_id->getSessionValue() ?>">
<?php } ?>
<?php if (!$pago_add->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($pago_add->IsMobileOrModal) { ?>
<div class="ewAddDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_pagoadd" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($pago->code->Visible) { // code ?>
<?php if ($pago_add->IsMobileOrModal) { ?>
	<div id="r_code" class="form-group">
		<label id="elh_pago_code" for="x_code" class="<?php echo $pago_add->LeftColumnClass ?>"><?php echo $pago->code->FldCaption() ?></label>
		<div class="<?php echo $pago_add->RightColumnClass ?>"><div<?php echo $pago->code->CellAttributes() ?>>
<span id="el_pago_code">
<input type="text" data-table="pago" data-field="x_code" name="x_code" id="x_code" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($pago->code->getPlaceHolder()) ?>" value="<?php echo $pago->code->EditValue ?>"<?php echo $pago->code->EditAttributes() ?>>
</span>
<?php echo $pago->code->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_code">
		<td class="col-sm-3"><span id="elh_pago_code"><?php echo $pago->code->FldCaption() ?></span></td>
		<td<?php echo $pago->code->CellAttributes() ?>>
<span id="el_pago_code">
<input type="text" data-table="pago" data-field="x_code" name="x_code" id="x_code" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($pago->code->getPlaceHolder()) ?>" value="<?php echo $pago->code->EditValue ?>"<?php echo $pago->code->EditAttributes() ?>>
</span>
<?php echo $pago->code->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($pago->cliente_id->Visible) { // cliente_id ?>
<?php if ($pago_add->IsMobileOrModal) { ?>
	<div id="r_cliente_id" class="form-group">
		<label id="elh_pago_cliente_id" for="x_cliente_id" class="<?php echo $pago_add->LeftColumnClass ?>"><?php echo $pago->cliente_id->FldCaption() ?></label>
		<div class="<?php echo $pago_add->RightColumnClass ?>"><div<?php echo $pago->cliente_id->CellAttributes() ?>>
<?php if ($pago->cliente_id->getSessionValue() <> "") { ?>
<span id="el_pago_cliente_id">
<span<?php echo $pago->cliente_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago->cliente_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_cliente_id" name="x_cliente_id" value="<?php echo ew_HtmlEncode($pago->cliente_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_pago_cliente_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_cliente_id"><?php echo (strval($pago->cliente_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $pago->cliente_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pago->cliente_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_cliente_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($pago->cliente_id->ReadOnly || $pago->cliente_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="pago" data-field="x_cliente_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pago->cliente_id->DisplayValueSeparatorAttribute() ?>" name="x_cliente_id" id="x_cliente_id" value="<?php echo $pago->cliente_id->CurrentValue ?>"<?php echo $pago->cliente_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "cliente") && !$pago->cliente_id->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $pago->cliente_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_cliente_id',url:'clienteaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_cliente_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $pago->cliente_id->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } ?>
<?php echo $pago->cliente_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_cliente_id">
		<td class="col-sm-3"><span id="elh_pago_cliente_id"><?php echo $pago->cliente_id->FldCaption() ?></span></td>
		<td<?php echo $pago->cliente_id->CellAttributes() ?>>
<?php if ($pago->cliente_id->getSessionValue() <> "") { ?>
<span id="el_pago_cliente_id">
<span<?php echo $pago->cliente_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago->cliente_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_cliente_id" name="x_cliente_id" value="<?php echo ew_HtmlEncode($pago->cliente_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_pago_cliente_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_cliente_id"><?php echo (strval($pago->cliente_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $pago->cliente_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pago->cliente_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_cliente_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($pago->cliente_id->ReadOnly || $pago->cliente_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="pago" data-field="x_cliente_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pago->cliente_id->DisplayValueSeparatorAttribute() ?>" name="x_cliente_id" id="x_cliente_id" value="<?php echo $pago->cliente_id->CurrentValue ?>"<?php echo $pago->cliente_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "cliente") && !$pago->cliente_id->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $pago->cliente_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_cliente_id',url:'clienteaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_cliente_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $pago->cliente_id->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } ?>
<?php echo $pago->cliente_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($pago->status_id->Visible) { // status_id ?>
<?php if ($pago_add->IsMobileOrModal) { ?>
	<div id="r_status_id" class="form-group">
		<label id="elh_pago_status_id" class="<?php echo $pago_add->LeftColumnClass ?>"><?php echo $pago->status_id->FldCaption() ?></label>
		<div class="<?php echo $pago_add->RightColumnClass ?>"><div<?php echo $pago->status_id->CellAttributes() ?>>
<span id="el_pago_status_id">
<div id="tp_x_status_id" class="ewTemplate"><input type="radio" data-table="pago" data-field="x_status_id" data-value-separator="<?php echo $pago->status_id->DisplayValueSeparatorAttribute() ?>" name="x_status_id" id="x_status_id" value="{value}"<?php echo $pago->status_id->EditAttributes() ?>></div>
<div id="dsl_x_status_id" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $pago->status_id->RadioButtonListHtml(FALSE, "x_status_id") ?>
</div></div>
</span>
<?php echo $pago->status_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_status_id">
		<td class="col-sm-3"><span id="elh_pago_status_id"><?php echo $pago->status_id->FldCaption() ?></span></td>
		<td<?php echo $pago->status_id->CellAttributes() ?>>
<span id="el_pago_status_id">
<div id="tp_x_status_id" class="ewTemplate"><input type="radio" data-table="pago" data-field="x_status_id" data-value-separator="<?php echo $pago->status_id->DisplayValueSeparatorAttribute() ?>" name="x_status_id" id="x_status_id" value="{value}"<?php echo $pago->status_id->EditAttributes() ?>></div>
<div id="dsl_x_status_id" data-repeatcolumn="5" class="ewItemList" style="display: none;"><div>
<?php echo $pago->status_id->RadioButtonListHtml(FALSE, "x_status_id") ?>
</div></div>
</span>
<?php echo $pago->status_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($pago->metodopago_id->Visible) { // metodopago_id ?>
<?php if ($pago_add->IsMobileOrModal) { ?>
	<div id="r_metodopago_id" class="form-group">
		<label id="elh_pago_metodopago_id" for="x_metodopago_id" class="<?php echo $pago_add->LeftColumnClass ?>"><?php echo $pago->metodopago_id->FldCaption() ?></label>
		<div class="<?php echo $pago_add->RightColumnClass ?>"><div<?php echo $pago->metodopago_id->CellAttributes() ?>>
<span id="el_pago_metodopago_id">
<select data-table="pago" data-field="x_metodopago_id" data-value-separator="<?php echo $pago->metodopago_id->DisplayValueSeparatorAttribute() ?>" id="x_metodopago_id" name="x_metodopago_id"<?php echo $pago->metodopago_id->EditAttributes() ?>>
<?php echo $pago->metodopago_id->SelectOptionListHtml("x_metodopago_id") ?>
</select>
</span>
<?php echo $pago->metodopago_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_metodopago_id">
		<td class="col-sm-3"><span id="elh_pago_metodopago_id"><?php echo $pago->metodopago_id->FldCaption() ?></span></td>
		<td<?php echo $pago->metodopago_id->CellAttributes() ?>>
<span id="el_pago_metodopago_id">
<select data-table="pago" data-field="x_metodopago_id" data-value-separator="<?php echo $pago->metodopago_id->DisplayValueSeparatorAttribute() ?>" id="x_metodopago_id" name="x_metodopago_id"<?php echo $pago->metodopago_id->EditAttributes() ?>>
<?php echo $pago->metodopago_id->SelectOptionListHtml("x_metodopago_id") ?>
</select>
</span>
<?php echo $pago->metodopago_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($pago->documento_pago->Visible) { // documento_pago ?>
<?php if ($pago_add->IsMobileOrModal) { ?>
	<div id="r_documento_pago" class="form-group">
		<label id="elh_pago_documento_pago" class="<?php echo $pago_add->LeftColumnClass ?>"><?php echo $pago->documento_pago->FldCaption() ?></label>
		<div class="<?php echo $pago_add->RightColumnClass ?>"><div<?php echo $pago->documento_pago->CellAttributes() ?>>
<span id="el_pago_documento_pago">
<div id="fd_x_documento_pago">
<span title="<?php echo $pago->documento_pago->FldTitle() ? $pago->documento_pago->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($pago->documento_pago->ReadOnly || $pago->documento_pago->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="pago" data-field="x_documento_pago" name="x_documento_pago" id="x_documento_pago"<?php echo $pago->documento_pago->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_documento_pago" id= "fn_x_documento_pago" value="<?php echo $pago->documento_pago->Upload->FileName ?>">
<input type="hidden" name="fa_x_documento_pago" id= "fa_x_documento_pago" value="0">
<input type="hidden" name="fs_x_documento_pago" id= "fs_x_documento_pago" value="0">
<input type="hidden" name="fx_x_documento_pago" id= "fx_x_documento_pago" value="<?php echo $pago->documento_pago->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_documento_pago" id= "fm_x_documento_pago" value="<?php echo $pago->documento_pago->UploadMaxFileSize ?>">
</div>
<table id="ft_x_documento_pago" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $pago->documento_pago->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_documento_pago">
		<td class="col-sm-3"><span id="elh_pago_documento_pago"><?php echo $pago->documento_pago->FldCaption() ?></span></td>
		<td<?php echo $pago->documento_pago->CellAttributes() ?>>
<span id="el_pago_documento_pago">
<div id="fd_x_documento_pago">
<span title="<?php echo $pago->documento_pago->FldTitle() ? $pago->documento_pago->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($pago->documento_pago->ReadOnly || $pago->documento_pago->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="pago" data-field="x_documento_pago" name="x_documento_pago" id="x_documento_pago"<?php echo $pago->documento_pago->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_documento_pago" id= "fn_x_documento_pago" value="<?php echo $pago->documento_pago->Upload->FileName ?>">
<input type="hidden" name="fa_x_documento_pago" id= "fa_x_documento_pago" value="0">
<input type="hidden" name="fs_x_documento_pago" id= "fs_x_documento_pago" value="0">
<input type="hidden" name="fx_x_documento_pago" id= "fx_x_documento_pago" value="<?php echo $pago->documento_pago->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_documento_pago" id= "fm_x_documento_pago" value="<?php echo $pago->documento_pago->UploadMaxFileSize ?>">
</div>
<table id="ft_x_documento_pago" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $pago->documento_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($pago_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php
	if (in_array("pago_avaluo", explode(",", $pago->getCurrentDetailTable())) && $pago_avaluo->DetailAdd) {
?>
<?php if ($pago->getCurrentDetailTable() <> "") { ?>
<h4 class="ewDetailCaption"><?php echo $Language->TablePhrase("pago_avaluo", "TblCaption") ?></h4>
<?php } ?>
<?php include_once "pago_avaluogrid.php" ?>
<?php } ?>
<?php if (!$pago_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $pago_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $pago_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$pago_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fpagoadd.Init();
</script>
<?php
$pago_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pago_add->Page_Terminate();
?>
