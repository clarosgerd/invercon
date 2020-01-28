<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "historicoinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$historico_edit = NULL; // Initialize page object first

class chistorico_edit extends chistorico {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'historico';

	// Page object name
	var $PageObjName = 'historico_edit';

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

		// Table object (historico)
		if (!isset($GLOBALS["historico"]) || get_class($GLOBALS["historico"]) == "chistorico") {
			$GLOBALS["historico"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["historico"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'historico', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("historicolist.php"));
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
		global $gbOldSkipHeaderFooter, $gbSkipHeaderFooter;
		$gbOldSkipHeaderFooter = $gbSkipHeaderFooter;
		$gbSkipHeaderFooter = TRUE;
		$this->id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->id->Visible = FALSE;
		$this->proceso->SetVisibility();
		$this->responsable->SetVisibility();
		$this->ingreso->SetVisibility();
		$this->salida->SetVisibility();
		$this->id_solicitud->SetVisibility();
		$this->id_avaluo->SetVisibility();
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
		global $gbOldSkipHeaderFooter, $gbSkipHeaderFooter;
		$gbSkipHeaderFooter = $gbOldSkipHeaderFooter;

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $historico;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($historico);
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
					if ($pageName == "historicoview.php")
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
					$this->Page_Terminate("historicolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "historicolist.php")
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
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
		if (!$this->proceso->FldIsDetailKey) {
			$this->proceso->setFormValue($objForm->GetValue("x_proceso"));
		}
		if (!$this->responsable->FldIsDetailKey) {
			$this->responsable->setFormValue($objForm->GetValue("x_responsable"));
		}
		if (!$this->ingreso->FldIsDetailKey) {
			$this->ingreso->setFormValue($objForm->GetValue("x_ingreso"));
			$this->ingreso->CurrentValue = ew_UnFormatDateTime($this->ingreso->CurrentValue, 0);
		}
		if (!$this->salida->FldIsDetailKey) {
			$this->salida->setFormValue($objForm->GetValue("x_salida"));
			$this->salida->CurrentValue = ew_UnFormatDateTime($this->salida->CurrentValue, 0);
		}
		if (!$this->id_solicitud->FldIsDetailKey) {
			$this->id_solicitud->setFormValue($objForm->GetValue("x_id_solicitud"));
		}
		if (!$this->id_avaluo->FldIsDetailKey) {
			$this->id_avaluo->setFormValue($objForm->GetValue("x_id_avaluo"));
		}
		if (!$this->id_sucursal->FldIsDetailKey) {
			$this->id_sucursal->setFormValue($objForm->GetValue("x_id_sucursal"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->proceso->CurrentValue = $this->proceso->FormValue;
		$this->responsable->CurrentValue = $this->responsable->FormValue;
		$this->ingreso->CurrentValue = $this->ingreso->FormValue;
		$this->ingreso->CurrentValue = ew_UnFormatDateTime($this->ingreso->CurrentValue, 0);
		$this->salida->CurrentValue = $this->salida->FormValue;
		$this->salida->CurrentValue = ew_UnFormatDateTime($this->salida->CurrentValue, 0);
		$this->id_solicitud->CurrentValue = $this->id_solicitud->FormValue;
		$this->id_avaluo->CurrentValue = $this->id_avaluo->FormValue;
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
		$this->proceso->setDbValue($row['proceso']);
		$this->responsable->setDbValue($row['responsable']);
		$this->ingreso->setDbValue($row['ingreso']);
		$this->salida->setDbValue($row['salida']);
		$this->id_solicitud->setDbValue($row['id_solicitud']);
		$this->id_avaluo->setDbValue($row['id_avaluo']);
		$this->id_sucursal->setDbValue($row['id_sucursal']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['proceso'] = NULL;
		$row['responsable'] = NULL;
		$row['ingreso'] = NULL;
		$row['salida'] = NULL;
		$row['id_solicitud'] = NULL;
		$row['id_avaluo'] = NULL;
		$row['id_sucursal'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->proceso->DbValue = $row['proceso'];
		$this->responsable->DbValue = $row['responsable'];
		$this->ingreso->DbValue = $row['ingreso'];
		$this->salida->DbValue = $row['salida'];
		$this->id_solicitud->DbValue = $row['id_solicitud'];
		$this->id_avaluo->DbValue = $row['id_avaluo'];
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
		// proceso
		// responsable
		// ingreso
		// salida
		// id_solicitud
		// id_avaluo
		// id_sucursal

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// proceso
		if (strval($this->proceso->CurrentValue) <> "") {
			$sFilterWrk = "`descripcion`" . ew_SearchString("=", $this->proceso->CurrentValue, EW_DATATYPE_STRING, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `descripcion`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->proceso->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `descripcion`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->proceso->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `descripcion`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->proceso->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->proceso, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->proceso->ViewValue = $this->proceso->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->proceso->ViewValue = $this->proceso->CurrentValue;
			}
		} else {
			$this->proceso->ViewValue = NULL;
		}
		$this->proceso->ViewCustomAttributes = "";

		// responsable
		if (strval($this->responsable->CurrentValue) <> "") {
			$sFilterWrk = "`login`" . ew_SearchString("=", $this->responsable->CurrentValue, EW_DATATYPE_STRING, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `login`, `codigo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `usuario`";
				$sWhereWrk = "";
				$this->responsable->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `login`, `codigo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `usuario`";
				$sWhereWrk = "";
				$this->responsable->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `login`, `codigo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `usuario`";
				$sWhereWrk = "";
				$this->responsable->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->responsable, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->responsable->ViewValue = $this->responsable->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->responsable->ViewValue = $this->responsable->CurrentValue;
			}
		} else {
			$this->responsable->ViewValue = NULL;
		}
		$this->responsable->ViewCustomAttributes = "";

		// ingreso
		$this->ingreso->ViewValue = $this->ingreso->CurrentValue;
		$this->ingreso->ViewValue = ew_FormatDateTime($this->ingreso->ViewValue, 0);
		$this->ingreso->ViewCustomAttributes = "";

		// salida
		$this->salida->ViewValue = $this->salida->CurrentValue;
		$this->salida->ViewValue = ew_FormatDateTime($this->salida->ViewValue, 0);
		$this->salida->ViewCustomAttributes = "";

		// id_solicitud
		if (strval($this->id_solicitud->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `email_contacto` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `email_contacto` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `email_contacto` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array();
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
				$this->id_solicitud->ViewValue = $this->id_solicitud->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_solicitud->ViewValue = $this->id_solicitud->CurrentValue;
			}
		} else {
			$this->id_solicitud->ViewValue = NULL;
		}
		$this->id_solicitud->ViewCustomAttributes = "";

		// id_avaluo
		if (strval($this->id_avaluo->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_avaluo->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `codigoavaluo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
				$sWhereWrk = "";
				$this->id_avaluo->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `codigoavaluo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
				$sWhereWrk = "";
				$this->id_avaluo->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `codigoavaluo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
				$sWhereWrk = "";
				$this->id_avaluo->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_avaluo, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_FormatNumber($rswrk->fields('DispFld'), 0, 0, 0, 0);
				$this->id_avaluo->ViewValue = $this->id_avaluo->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_avaluo->ViewValue = $this->id_avaluo->CurrentValue;
			}
		} else {
			$this->id_avaluo->ViewValue = NULL;
		}
		$this->id_avaluo->ViewCustomAttributes = "";

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

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// proceso
			$this->proceso->LinkCustomAttributes = "";
			$this->proceso->HrefValue = "";
			$this->proceso->TooltipValue = "";

			// responsable
			$this->responsable->LinkCustomAttributes = "";
			$this->responsable->HrefValue = "";
			$this->responsable->TooltipValue = "";

			// ingreso
			$this->ingreso->LinkCustomAttributes = "";
			$this->ingreso->HrefValue = "";
			$this->ingreso->TooltipValue = "";

			// salida
			$this->salida->LinkCustomAttributes = "";
			$this->salida->HrefValue = "";
			$this->salida->TooltipValue = "";

			// id_solicitud
			$this->id_solicitud->LinkCustomAttributes = "";
			$this->id_solicitud->HrefValue = "";
			$this->id_solicitud->TooltipValue = "";

			// id_avaluo
			$this->id_avaluo->LinkCustomAttributes = "";
			$this->id_avaluo->HrefValue = "";
			$this->id_avaluo->TooltipValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";
			$this->id_sucursal->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// proceso
			$this->proceso->EditAttrs["class"] = "form-control";
			$this->proceso->EditCustomAttributes = "";
			if (trim(strval($this->proceso->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`descripcion`" . ew_SearchString("=", $this->proceso->CurrentValue, EW_DATATYPE_STRING, "");
			}
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `descripcion`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadointerno`";
					$sWhereWrk = "";
					$this->proceso->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `descripcion`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadointerno`";
					$sWhereWrk = "";
					$this->proceso->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `descripcion`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadointerno`";
					$sWhereWrk = "";
					$this->proceso->LookupFilters = array();
					break;
			}
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->proceso, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->proceso->EditValue = $arwrk;

			// responsable
			$this->responsable->EditAttrs["class"] = "form-control";
			$this->responsable->EditCustomAttributes = "";
			if (trim(strval($this->responsable->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`login`" . ew_SearchString("=", $this->responsable->CurrentValue, EW_DATATYPE_STRING, "");
			}
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `login`, `codigo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `usuario`";
					$sWhereWrk = "";
					$this->responsable->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `login`, `codigo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `usuario`";
					$sWhereWrk = "";
					$this->responsable->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `login`, `codigo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `usuario`";
					$sWhereWrk = "";
					$this->responsable->LookupFilters = array();
					break;
			}
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			if (!$GLOBALS["historico"]->UserIDAllow("edit")) $sWhereWrk = $GLOBALS["usuario"]->AddUserIDFilter($sWhereWrk);
			$this->Lookup_Selecting($this->responsable, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->responsable->EditValue = $arwrk;

			// ingreso
			$this->ingreso->EditAttrs["class"] = "form-control";
			$this->ingreso->EditCustomAttributes = "";
			$this->ingreso->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->ingreso->CurrentValue, 8));
			$this->ingreso->PlaceHolder = ew_RemoveHtml($this->ingreso->FldTitle());

			// salida
			$this->salida->EditAttrs["class"] = "form-control";
			$this->salida->EditCustomAttributes = "";
			$this->salida->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->salida->CurrentValue, 8));
			$this->salida->PlaceHolder = ew_RemoveHtml($this->salida->FldTitle());

			// id_solicitud
			$this->id_solicitud->EditAttrs["class"] = "form-control";
			$this->id_solicitud->EditCustomAttributes = "";
			if (strval($this->id_solicitud->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `email_contacto` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
					$sWhereWrk = "";
					$this->id_solicitud->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `email_contacto` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
					$sWhereWrk = "";
					$this->id_solicitud->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `email_contacto` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
					$sWhereWrk = "";
					$this->id_solicitud->LookupFilters = array();
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
					$this->id_solicitud->EditValue = $this->id_solicitud->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_solicitud->EditValue = $this->id_solicitud->CurrentValue;
				}
			} else {
				$this->id_solicitud->EditValue = NULL;
			}
			$this->id_solicitud->ViewCustomAttributes = "";

			// id_avaluo
			$this->id_avaluo->EditAttrs["class"] = "form-control";
			$this->id_avaluo->EditCustomAttributes = "";
			if (strval($this->id_avaluo->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_avaluo->CurrentValue, EW_DATATYPE_NUMBER, "");
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id`, `codigoavaluo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
					$sWhereWrk = "";
					$this->id_avaluo->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `codigoavaluo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
					$sWhereWrk = "";
					$this->id_avaluo->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id`, `codigoavaluo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
					$sWhereWrk = "";
					$this->id_avaluo->LookupFilters = array();
					break;
			}
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_avaluo, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = ew_FormatNumber($rswrk->fields('DispFld'), 0, 0, 0, 0);
					$this->id_avaluo->EditValue = $this->id_avaluo->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_avaluo->EditValue = $this->id_avaluo->CurrentValue;
				}
			} else {
				$this->id_avaluo->EditValue = NULL;
			}
			$this->id_avaluo->ViewCustomAttributes = "";

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

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// proceso
			$this->proceso->LinkCustomAttributes = "";
			$this->proceso->HrefValue = "";

			// responsable
			$this->responsable->LinkCustomAttributes = "";
			$this->responsable->HrefValue = "";

			// ingreso
			$this->ingreso->LinkCustomAttributes = "";
			$this->ingreso->HrefValue = "";

			// salida
			$this->salida->LinkCustomAttributes = "";
			$this->salida->HrefValue = "";

			// id_solicitud
			$this->id_solicitud->LinkCustomAttributes = "";
			$this->id_solicitud->HrefValue = "";
			$this->id_solicitud->TooltipValue = "";

			// id_avaluo
			$this->id_avaluo->LinkCustomAttributes = "";
			$this->id_avaluo->HrefValue = "";
			$this->id_avaluo->TooltipValue = "";

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
		if (!$this->proceso->FldIsDetailKey && !is_null($this->proceso->FormValue) && $this->proceso->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->proceso->FldCaption(), $this->proceso->ReqErrMsg));
		}
		if (!$this->responsable->FldIsDetailKey && !is_null($this->responsable->FormValue) && $this->responsable->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->responsable->FldCaption(), $this->responsable->ReqErrMsg));
		}
		if (!$this->ingreso->FldIsDetailKey && !is_null($this->ingreso->FormValue) && $this->ingreso->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->ingreso->FldCaption(), $this->ingreso->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->ingreso->FormValue)) {
			ew_AddMessage($gsFormError, $this->ingreso->FldErrMsg());
		}
		if (!$this->salida->FldIsDetailKey && !is_null($this->salida->FormValue) && $this->salida->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->salida->FldCaption(), $this->salida->ReqErrMsg));
		}
		if (!ew_CheckDateDef($this->salida->FormValue)) {
			ew_AddMessage($gsFormError, $this->salida->FldErrMsg());
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

			// proceso
			$this->proceso->SetDbValueDef($rsnew, $this->proceso->CurrentValue, "", $this->proceso->ReadOnly);

			// responsable
			$this->responsable->SetDbValueDef($rsnew, $this->responsable->CurrentValue, "", $this->responsable->ReadOnly);

			// ingreso
			$this->ingreso->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->ingreso->CurrentValue, 0), ew_CurrentDate(), $this->ingreso->ReadOnly);

			// salida
			$this->salida->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->salida->CurrentValue, 0), ew_CurrentDate(), $this->salida->ReadOnly);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("historicolist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_proceso":
			$sSqlWrk = "";
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `descripcion` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `descripcion` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `descripcion` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
			}
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`descripcion` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->proceso, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_responsable":
			$sSqlWrk = "";
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `login` AS `LinkFld`, `codigo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `usuario`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `login` AS `LinkFld`, `codigo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `usuario`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `login` AS `LinkFld`, `codigo` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `usuario`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
			}
			if (!$GLOBALS["historico"]->UserIDAllow("edit")) $sWhereWrk = $GLOBALS["usuario"]->AddUserIDFilter($sWhereWrk);
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`login` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->responsable, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($historico_edit)) $historico_edit = new chistorico_edit();

// Page init
$historico_edit->Page_Init();

// Page main
$historico_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$historico_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fhistoricoedit = new ew_Form("fhistoricoedit", "edit");

// Validate form
fhistoricoedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_proceso");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $historico->proceso->FldCaption(), $historico->proceso->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_responsable");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $historico->responsable->FldCaption(), $historico->responsable->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ingreso");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $historico->ingreso->FldCaption(), $historico->ingreso->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_ingreso");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($historico->ingreso->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_salida");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $historico->salida->FldCaption(), $historico->salida->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_salida");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($historico->salida->FldErrMsg()) ?>");

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
fhistoricoedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fhistoricoedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fhistoricoedit.Lists["x_proceso"] = {"LinkField":"x_descripcion","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadointerno"};
fhistoricoedit.Lists["x_proceso"].Data = "<?php echo $historico_edit->proceso->LookupFilterQuery(FALSE, "edit") ?>";
fhistoricoedit.Lists["x_responsable"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_codigo","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"usuario"};
fhistoricoedit.Lists["x_responsable"].Data = "<?php echo $historico_edit->responsable->LookupFilterQuery(FALSE, "edit") ?>";
fhistoricoedit.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_email_contacto","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
fhistoricoedit.Lists["x_id_solicitud"].Data = "<?php echo $historico_edit->id_solicitud->LookupFilterQuery(FALSE, "edit") ?>";
fhistoricoedit.Lists["x_id_avaluo"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_codigoavaluo","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"avaluo"};
fhistoricoedit.Lists["x_id_avaluo"].Data = "<?php echo $historico_edit->id_avaluo->LookupFilterQuery(FALSE, "edit") ?>";
fhistoricoedit.Lists["x_id_sucursal"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"sucursal"};
fhistoricoedit.Lists["x_id_sucursal"].Data = "<?php echo $historico_edit->id_sucursal->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $historico_edit->ShowPageHeader(); ?>
<?php
$historico_edit->ShowMessage();
?>
<form name="fhistoricoedit" id="fhistoricoedit" class="<?php echo $historico_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($historico_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $historico_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="historico">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($historico_edit->IsModal) ?>">
<?php if (!$historico_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($historico_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_historicoedit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($historico->id->Visible) { // id ?>
<?php if ($historico_edit->IsMobileOrModal) { ?>
	<div id="r_id" class="form-group">
		<label id="elh_historico_id" class="<?php echo $historico_edit->LeftColumnClass ?>"><?php echo $historico->id->FldCaption() ?></label>
		<div class="<?php echo $historico_edit->RightColumnClass ?>"><div<?php echo $historico->id->CellAttributes() ?>>
<span id="el_historico_id">
<span<?php echo $historico->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $historico->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="historico" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($historico->id->CurrentValue) ?>">
<?php echo $historico->id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id">
		<td class="col-sm-3"><span id="elh_historico_id"><?php echo $historico->id->FldCaption() ?></span></td>
		<td<?php echo $historico->id->CellAttributes() ?>>
<span id="el_historico_id">
<span<?php echo $historico->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $historico->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="historico" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($historico->id->CurrentValue) ?>">
<?php echo $historico->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($historico->proceso->Visible) { // proceso ?>
<?php if ($historico_edit->IsMobileOrModal) { ?>
	<div id="r_proceso" class="form-group">
		<label id="elh_historico_proceso" for="x_proceso" class="<?php echo $historico_edit->LeftColumnClass ?>"><?php echo $historico->proceso->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $historico_edit->RightColumnClass ?>"><div<?php echo $historico->proceso->CellAttributes() ?>>
<span id="el_historico_proceso">
<select data-table="historico" data-field="x_proceso" data-value-separator="<?php echo $historico->proceso->DisplayValueSeparatorAttribute() ?>" id="x_proceso" name="x_proceso"<?php echo $historico->proceso->EditAttributes() ?>>
<?php echo $historico->proceso->SelectOptionListHtml("x_proceso") ?>
</select>
</span>
<?php echo $historico->proceso->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_proceso">
		<td class="col-sm-3"><span id="elh_historico_proceso"><?php echo $historico->proceso->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $historico->proceso->CellAttributes() ?>>
<span id="el_historico_proceso">
<select data-table="historico" data-field="x_proceso" data-value-separator="<?php echo $historico->proceso->DisplayValueSeparatorAttribute() ?>" id="x_proceso" name="x_proceso"<?php echo $historico->proceso->EditAttributes() ?>>
<?php echo $historico->proceso->SelectOptionListHtml("x_proceso") ?>
</select>
</span>
<?php echo $historico->proceso->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($historico->responsable->Visible) { // responsable ?>
<?php if ($historico_edit->IsMobileOrModal) { ?>
	<div id="r_responsable" class="form-group">
		<label id="elh_historico_responsable" for="x_responsable" class="<?php echo $historico_edit->LeftColumnClass ?>"><?php echo $historico->responsable->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $historico_edit->RightColumnClass ?>"><div<?php echo $historico->responsable->CellAttributes() ?>>
<span id="el_historico_responsable">
<select data-table="historico" data-field="x_responsable" data-value-separator="<?php echo $historico->responsable->DisplayValueSeparatorAttribute() ?>" id="x_responsable" name="x_responsable"<?php echo $historico->responsable->EditAttributes() ?>>
<?php echo $historico->responsable->SelectOptionListHtml("x_responsable") ?>
</select>
</span>
<?php echo $historico->responsable->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_responsable">
		<td class="col-sm-3"><span id="elh_historico_responsable"><?php echo $historico->responsable->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $historico->responsable->CellAttributes() ?>>
<span id="el_historico_responsable">
<select data-table="historico" data-field="x_responsable" data-value-separator="<?php echo $historico->responsable->DisplayValueSeparatorAttribute() ?>" id="x_responsable" name="x_responsable"<?php echo $historico->responsable->EditAttributes() ?>>
<?php echo $historico->responsable->SelectOptionListHtml("x_responsable") ?>
</select>
</span>
<?php echo $historico->responsable->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($historico->ingreso->Visible) { // ingreso ?>
<?php if ($historico_edit->IsMobileOrModal) { ?>
	<div id="r_ingreso" class="form-group">
		<label id="elh_historico_ingreso" for="x_ingreso" class="<?php echo $historico_edit->LeftColumnClass ?>"><?php echo $historico->ingreso->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $historico_edit->RightColumnClass ?>"><div<?php echo $historico->ingreso->CellAttributes() ?>>
<span id="el_historico_ingreso">
<input type="text" data-table="historico" data-field="x_ingreso" name="x_ingreso" id="x_ingreso" placeholder="<?php echo ew_HtmlEncode($historico->ingreso->getPlaceHolder()) ?>" value="<?php echo $historico->ingreso->EditValue ?>"<?php echo $historico->ingreso->EditAttributes() ?>>
</span>
<?php echo $historico->ingreso->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_ingreso">
		<td class="col-sm-3"><span id="elh_historico_ingreso"><?php echo $historico->ingreso->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $historico->ingreso->CellAttributes() ?>>
<span id="el_historico_ingreso">
<input type="text" data-table="historico" data-field="x_ingreso" name="x_ingreso" id="x_ingreso" placeholder="<?php echo ew_HtmlEncode($historico->ingreso->getPlaceHolder()) ?>" value="<?php echo $historico->ingreso->EditValue ?>"<?php echo $historico->ingreso->EditAttributes() ?>>
</span>
<?php echo $historico->ingreso->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($historico->salida->Visible) { // salida ?>
<?php if ($historico_edit->IsMobileOrModal) { ?>
	<div id="r_salida" class="form-group">
		<label id="elh_historico_salida" for="x_salida" class="<?php echo $historico_edit->LeftColumnClass ?>"><?php echo $historico->salida->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $historico_edit->RightColumnClass ?>"><div<?php echo $historico->salida->CellAttributes() ?>>
<span id="el_historico_salida">
<input type="text" data-table="historico" data-field="x_salida" name="x_salida" id="x_salida" placeholder="<?php echo ew_HtmlEncode($historico->salida->getPlaceHolder()) ?>" value="<?php echo $historico->salida->EditValue ?>"<?php echo $historico->salida->EditAttributes() ?>>
</span>
<?php echo $historico->salida->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_salida">
		<td class="col-sm-3"><span id="elh_historico_salida"><?php echo $historico->salida->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $historico->salida->CellAttributes() ?>>
<span id="el_historico_salida">
<input type="text" data-table="historico" data-field="x_salida" name="x_salida" id="x_salida" placeholder="<?php echo ew_HtmlEncode($historico->salida->getPlaceHolder()) ?>" value="<?php echo $historico->salida->EditValue ?>"<?php echo $historico->salida->EditAttributes() ?>>
</span>
<?php echo $historico->salida->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($historico->id_solicitud->Visible) { // id_solicitud ?>
<?php if ($historico_edit->IsMobileOrModal) { ?>
	<div id="r_id_solicitud" class="form-group">
		<label id="elh_historico_id_solicitud" for="x_id_solicitud" class="<?php echo $historico_edit->LeftColumnClass ?>"><?php echo $historico->id_solicitud->FldCaption() ?></label>
		<div class="<?php echo $historico_edit->RightColumnClass ?>"><div<?php echo $historico->id_solicitud->CellAttributes() ?>>
<span id="el_historico_id_solicitud">
<span<?php echo $historico->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $historico->id_solicitud->EditValue ?></p></span>
</span>
<input type="hidden" data-table="historico" data-field="x_id_solicitud" name="x_id_solicitud" id="x_id_solicitud" value="<?php echo ew_HtmlEncode($historico->id_solicitud->CurrentValue) ?>">
<?php echo $historico->id_solicitud->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_solicitud">
		<td class="col-sm-3"><span id="elh_historico_id_solicitud"><?php echo $historico->id_solicitud->FldCaption() ?></span></td>
		<td<?php echo $historico->id_solicitud->CellAttributes() ?>>
<span id="el_historico_id_solicitud">
<span<?php echo $historico->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $historico->id_solicitud->EditValue ?></p></span>
</span>
<input type="hidden" data-table="historico" data-field="x_id_solicitud" name="x_id_solicitud" id="x_id_solicitud" value="<?php echo ew_HtmlEncode($historico->id_solicitud->CurrentValue) ?>">
<?php echo $historico->id_solicitud->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($historico->id_avaluo->Visible) { // id_avaluo ?>
<?php if ($historico_edit->IsMobileOrModal) { ?>
	<div id="r_id_avaluo" class="form-group">
		<label id="elh_historico_id_avaluo" for="x_id_avaluo" class="<?php echo $historico_edit->LeftColumnClass ?>"><?php echo $historico->id_avaluo->FldCaption() ?></label>
		<div class="<?php echo $historico_edit->RightColumnClass ?>"><div<?php echo $historico->id_avaluo->CellAttributes() ?>>
<span id="el_historico_id_avaluo">
<span<?php echo $historico->id_avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $historico->id_avaluo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="historico" data-field="x_id_avaluo" name="x_id_avaluo" id="x_id_avaluo" value="<?php echo ew_HtmlEncode($historico->id_avaluo->CurrentValue) ?>">
<?php echo $historico->id_avaluo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_avaluo">
		<td class="col-sm-3"><span id="elh_historico_id_avaluo"><?php echo $historico->id_avaluo->FldCaption() ?></span></td>
		<td<?php echo $historico->id_avaluo->CellAttributes() ?>>
<span id="el_historico_id_avaluo">
<span<?php echo $historico->id_avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $historico->id_avaluo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="historico" data-field="x_id_avaluo" name="x_id_avaluo" id="x_id_avaluo" value="<?php echo ew_HtmlEncode($historico->id_avaluo->CurrentValue) ?>">
<?php echo $historico->id_avaluo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($historico->id_sucursal->Visible) { // id_sucursal ?>
<?php if ($historico_edit->IsMobileOrModal) { ?>
	<div id="r_id_sucursal" class="form-group">
		<label id="elh_historico_id_sucursal" for="x_id_sucursal" class="<?php echo $historico_edit->LeftColumnClass ?>"><?php echo $historico->id_sucursal->FldCaption() ?></label>
		<div class="<?php echo $historico_edit->RightColumnClass ?>"><div<?php echo $historico->id_sucursal->CellAttributes() ?>>
<span id="el_historico_id_sucursal">
<span<?php echo $historico->id_sucursal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $historico->id_sucursal->EditValue ?></p></span>
</span>
<input type="hidden" data-table="historico" data-field="x_id_sucursal" name="x_id_sucursal" id="x_id_sucursal" value="<?php echo ew_HtmlEncode($historico->id_sucursal->CurrentValue) ?>">
<?php echo $historico->id_sucursal->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_sucursal">
		<td class="col-sm-3"><span id="elh_historico_id_sucursal"><?php echo $historico->id_sucursal->FldCaption() ?></span></td>
		<td<?php echo $historico->id_sucursal->CellAttributes() ?>>
<span id="el_historico_id_sucursal">
<span<?php echo $historico->id_sucursal->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $historico->id_sucursal->EditValue ?></p></span>
</span>
<input type="hidden" data-table="historico" data-field="x_id_sucursal" name="x_id_sucursal" id="x_id_sucursal" value="<?php echo ew_HtmlEncode($historico->id_sucursal->CurrentValue) ?>">
<?php echo $historico->id_sucursal->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($historico_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$historico_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $historico_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $historico_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$historico_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fhistoricoedit.Init();
</script>
<?php
$historico_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$historico_edit->Page_Terminate();
?>
