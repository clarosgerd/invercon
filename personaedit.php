<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "personainfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$persona_edit = NULL; // Initialize page object first

class cpersona_edit extends cpersona {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'persona';

	// Page object name
	var $PageObjName = 'persona_edit';

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

		// Table object (persona)
		if (!isset($GLOBALS["persona"]) || get_class($GLOBALS["persona"]) == "cpersona") {
			$GLOBALS["persona"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["persona"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'persona', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("personalist.php"));
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
		$this->id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->id->Visible = FALSE;
		$this->name->SetVisibility();
		$this->lastname->SetVisibility();
		$this->day_of_birth->SetVisibility();
		$this->_email->SetVisibility();
		$this->address->SetVisibility();
		$this->phone->SetVisibility();
		$this->id_tipo->SetVisibility();
		$this->is_active->SetVisibility();
		$this->created_at->SetVisibility();
		$this->category_id->SetVisibility();

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
		global $EW_EXPORT, $persona;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($persona);
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
					if ($pageName == "personaview.php")
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
					$this->Page_Terminate("personalist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "personalist.php")
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
		if (!$this->name->FldIsDetailKey) {
			$this->name->setFormValue($objForm->GetValue("x_name"));
		}
		if (!$this->lastname->FldIsDetailKey) {
			$this->lastname->setFormValue($objForm->GetValue("x_lastname"));
		}
		if (!$this->day_of_birth->FldIsDetailKey) {
			$this->day_of_birth->setFormValue($objForm->GetValue("x_day_of_birth"));
			$this->day_of_birth->CurrentValue = ew_UnFormatDateTime($this->day_of_birth->CurrentValue, 0);
		}
		if (!$this->_email->FldIsDetailKey) {
			$this->_email->setFormValue($objForm->GetValue("x__email"));
		}
		if (!$this->address->FldIsDetailKey) {
			$this->address->setFormValue($objForm->GetValue("x_address"));
		}
		if (!$this->phone->FldIsDetailKey) {
			$this->phone->setFormValue($objForm->GetValue("x_phone"));
		}
		if (!$this->id_tipo->FldIsDetailKey) {
			$this->id_tipo->setFormValue($objForm->GetValue("x_id_tipo"));
		}
		if (!$this->is_active->FldIsDetailKey) {
			$this->is_active->setFormValue($objForm->GetValue("x_is_active"));
		}
		if (!$this->created_at->FldIsDetailKey) {
			$this->created_at->setFormValue($objForm->GetValue("x_created_at"));
			$this->created_at->CurrentValue = ew_UnFormatDateTime($this->created_at->CurrentValue, 0);
		}
		if (!$this->category_id->FldIsDetailKey) {
			$this->category_id->setFormValue($objForm->GetValue("x_category_id"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->name->CurrentValue = $this->name->FormValue;
		$this->lastname->CurrentValue = $this->lastname->FormValue;
		$this->day_of_birth->CurrentValue = $this->day_of_birth->FormValue;
		$this->day_of_birth->CurrentValue = ew_UnFormatDateTime($this->day_of_birth->CurrentValue, 0);
		$this->_email->CurrentValue = $this->_email->FormValue;
		$this->address->CurrentValue = $this->address->FormValue;
		$this->phone->CurrentValue = $this->phone->FormValue;
		$this->id_tipo->CurrentValue = $this->id_tipo->FormValue;
		$this->is_active->CurrentValue = $this->is_active->FormValue;
		$this->created_at->CurrentValue = $this->created_at->FormValue;
		$this->created_at->CurrentValue = ew_UnFormatDateTime($this->created_at->CurrentValue, 0);
		$this->category_id->CurrentValue = $this->category_id->FormValue;
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
		$this->name->setDbValue($row['name']);
		$this->lastname->setDbValue($row['lastname']);
		$this->day_of_birth->setDbValue($row['day_of_birth']);
		$this->_email->setDbValue($row['email']);
		$this->address->setDbValue($row['address']);
		$this->phone->setDbValue($row['phone']);
		$this->id_tipo->setDbValue($row['id_tipo']);
		$this->is_active->setDbValue($row['is_active']);
		$this->created_at->setDbValue($row['created_at']);
		$this->category_id->setDbValue($row['category_id']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['name'] = NULL;
		$row['lastname'] = NULL;
		$row['day_of_birth'] = NULL;
		$row['email'] = NULL;
		$row['address'] = NULL;
		$row['phone'] = NULL;
		$row['id_tipo'] = NULL;
		$row['is_active'] = NULL;
		$row['created_at'] = NULL;
		$row['category_id'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->name->DbValue = $row['name'];
		$this->lastname->DbValue = $row['lastname'];
		$this->day_of_birth->DbValue = $row['day_of_birth'];
		$this->_email->DbValue = $row['email'];
		$this->address->DbValue = $row['address'];
		$this->phone->DbValue = $row['phone'];
		$this->id_tipo->DbValue = $row['id_tipo'];
		$this->is_active->DbValue = $row['is_active'];
		$this->created_at->DbValue = $row['created_at'];
		$this->category_id->DbValue = $row['category_id'];
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
		// name
		// lastname
		// day_of_birth
		// email
		// address
		// phone
		// id_tipo
		// is_active
		// created_at
		// category_id

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// name
		$this->name->ViewValue = $this->name->CurrentValue;
		$this->name->ViewCustomAttributes = "";

		// lastname
		$this->lastname->ViewValue = $this->lastname->CurrentValue;
		$this->lastname->ViewCustomAttributes = "";

		// day_of_birth
		$this->day_of_birth->ViewValue = $this->day_of_birth->CurrentValue;
		$this->day_of_birth->ViewValue = ew_FormatDateTime($this->day_of_birth->ViewValue, 0);
		$this->day_of_birth->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// id_tipo
		$this->id_tipo->ViewValue = $this->id_tipo->CurrentValue;
		$this->id_tipo->ViewCustomAttributes = "";

		// is_active
		$this->is_active->ViewValue = $this->is_active->CurrentValue;
		$this->is_active->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = ew_FormatDateTime($this->created_at->ViewValue, 0);
		$this->created_at->ViewCustomAttributes = "";

		// category_id
		$this->category_id->ViewValue = $this->category_id->CurrentValue;
		$this->category_id->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";
			$this->name->TooltipValue = "";

			// lastname
			$this->lastname->LinkCustomAttributes = "";
			$this->lastname->HrefValue = "";
			$this->lastname->TooltipValue = "";

			// day_of_birth
			$this->day_of_birth->LinkCustomAttributes = "";
			$this->day_of_birth->HrefValue = "";
			$this->day_of_birth->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";
			$this->address->TooltipValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";
			$this->phone->TooltipValue = "";

			// id_tipo
			$this->id_tipo->LinkCustomAttributes = "";
			$this->id_tipo->HrefValue = "";
			$this->id_tipo->TooltipValue = "";

			// is_active
			$this->is_active->LinkCustomAttributes = "";
			$this->is_active->HrefValue = "";
			$this->is_active->TooltipValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";

			// category_id
			$this->category_id->LinkCustomAttributes = "";
			$this->category_id->HrefValue = "";
			$this->category_id->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// name
			$this->name->EditAttrs["class"] = "form-control";
			$this->name->EditCustomAttributes = "";
			$this->name->EditValue = ew_HtmlEncode($this->name->CurrentValue);
			$this->name->PlaceHolder = ew_RemoveHtml($this->name->FldCaption());

			// lastname
			$this->lastname->EditAttrs["class"] = "form-control";
			$this->lastname->EditCustomAttributes = "";
			$this->lastname->EditValue = ew_HtmlEncode($this->lastname->CurrentValue);
			$this->lastname->PlaceHolder = ew_RemoveHtml($this->lastname->FldCaption());

			// day_of_birth
			$this->day_of_birth->EditAttrs["class"] = "form-control";
			$this->day_of_birth->EditCustomAttributes = "";
			$this->day_of_birth->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->day_of_birth->CurrentValue, 8));
			$this->day_of_birth->PlaceHolder = ew_RemoveHtml($this->day_of_birth->FldCaption());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			$this->_email->EditValue = ew_HtmlEncode($this->_email->CurrentValue);
			$this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldCaption());

			// address
			$this->address->EditAttrs["class"] = "form-control";
			$this->address->EditCustomAttributes = "";
			$this->address->EditValue = ew_HtmlEncode($this->address->CurrentValue);
			$this->address->PlaceHolder = ew_RemoveHtml($this->address->FldCaption());

			// phone
			$this->phone->EditAttrs["class"] = "form-control";
			$this->phone->EditCustomAttributes = "";
			$this->phone->EditValue = ew_HtmlEncode($this->phone->CurrentValue);
			$this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldCaption());

			// id_tipo
			$this->id_tipo->EditAttrs["class"] = "form-control";
			$this->id_tipo->EditCustomAttributes = "";
			$this->id_tipo->EditValue = ew_HtmlEncode($this->id_tipo->CurrentValue);
			$this->id_tipo->PlaceHolder = ew_RemoveHtml($this->id_tipo->FldCaption());

			// is_active
			$this->is_active->EditAttrs["class"] = "form-control";
			$this->is_active->EditCustomAttributes = "";
			$this->is_active->EditValue = ew_HtmlEncode($this->is_active->CurrentValue);
			$this->is_active->PlaceHolder = ew_RemoveHtml($this->is_active->FldCaption());

			// created_at
			// category_id

			$this->category_id->EditAttrs["class"] = "form-control";
			$this->category_id->EditCustomAttributes = "";
			$this->category_id->EditValue = ew_HtmlEncode($this->category_id->CurrentValue);
			$this->category_id->PlaceHolder = ew_RemoveHtml($this->category_id->FldCaption());

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";

			// lastname
			$this->lastname->LinkCustomAttributes = "";
			$this->lastname->HrefValue = "";

			// day_of_birth
			$this->day_of_birth->LinkCustomAttributes = "";
			$this->day_of_birth->HrefValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";

			// id_tipo
			$this->id_tipo->LinkCustomAttributes = "";
			$this->id_tipo->HrefValue = "";

			// is_active
			$this->is_active->LinkCustomAttributes = "";
			$this->is_active->HrefValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";

			// category_id
			$this->category_id->LinkCustomAttributes = "";
			$this->category_id->HrefValue = "";
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
		if (!ew_CheckDateDef($this->day_of_birth->FormValue)) {
			ew_AddMessage($gsFormError, $this->day_of_birth->FldErrMsg());
		}
		if (!ew_CheckInteger($this->id_tipo->FormValue)) {
			ew_AddMessage($gsFormError, $this->id_tipo->FldErrMsg());
		}
		if (!ew_CheckInteger($this->is_active->FormValue)) {
			ew_AddMessage($gsFormError, $this->is_active->FldErrMsg());
		}
		if (!ew_CheckInteger($this->category_id->FormValue)) {
			ew_AddMessage($gsFormError, $this->category_id->FldErrMsg());
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

			// name
			$this->name->SetDbValueDef($rsnew, $this->name->CurrentValue, NULL, $this->name->ReadOnly);

			// lastname
			$this->lastname->SetDbValueDef($rsnew, $this->lastname->CurrentValue, NULL, $this->lastname->ReadOnly);

			// day_of_birth
			$this->day_of_birth->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->day_of_birth->CurrentValue, 0), NULL, $this->day_of_birth->ReadOnly);

			// email
			$this->_email->SetDbValueDef($rsnew, $this->_email->CurrentValue, NULL, $this->_email->ReadOnly);

			// address
			$this->address->SetDbValueDef($rsnew, $this->address->CurrentValue, NULL, $this->address->ReadOnly);

			// phone
			$this->phone->SetDbValueDef($rsnew, $this->phone->CurrentValue, NULL, $this->phone->ReadOnly);

			// id_tipo
			$this->id_tipo->SetDbValueDef($rsnew, $this->id_tipo->CurrentValue, NULL, $this->id_tipo->ReadOnly);

			// is_active
			$this->is_active->SetDbValueDef($rsnew, $this->is_active->CurrentValue, 0, $this->is_active->ReadOnly);

			// created_at
			$this->created_at->SetDbValueDef($rsnew, ew_CurrentDateTime(), NULL);
			$rsnew['created_at'] = &$this->created_at->DbValue;

			// category_id
			$this->category_id->SetDbValueDef($rsnew, $this->category_id->CurrentValue, NULL, $this->category_id->ReadOnly);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("personalist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
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
if (!isset($persona_edit)) $persona_edit = new cpersona_edit();

// Page init
$persona_edit->Page_Init();

// Page main
$persona_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$persona_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fpersonaedit = new ew_Form("fpersonaedit", "edit");

// Validate form
fpersonaedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_day_of_birth");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($persona->day_of_birth->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_id_tipo");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($persona->id_tipo->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_is_active");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($persona->is_active->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_category_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($persona->category_id->FldErrMsg()) ?>");

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
fpersonaedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpersonaedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $persona_edit->ShowPageHeader(); ?>
<?php
$persona_edit->ShowMessage();
?>
<form name="fpersonaedit" id="fpersonaedit" class="<?php echo $persona_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($persona_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $persona_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="persona">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($persona_edit->IsModal) ?>">
<div class="ewEditDiv"><!-- page* -->
<?php if ($persona->id->Visible) { // id ?>
	<div id="r_id" class="form-group">
		<label id="elh_persona_id" class="<?php echo $persona_edit->LeftColumnClass ?>"><?php echo $persona->id->FldCaption() ?></label>
		<div class="<?php echo $persona_edit->RightColumnClass ?>"><div<?php echo $persona->id->CellAttributes() ?>>
<span id="el_persona_id">
<span<?php echo $persona->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $persona->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="persona" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($persona->id->CurrentValue) ?>">
<?php echo $persona->id->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($persona->name->Visible) { // name ?>
	<div id="r_name" class="form-group">
		<label id="elh_persona_name" for="x_name" class="<?php echo $persona_edit->LeftColumnClass ?>"><?php echo $persona->name->FldCaption() ?></label>
		<div class="<?php echo $persona_edit->RightColumnClass ?>"><div<?php echo $persona->name->CellAttributes() ?>>
<span id="el_persona_name">
<input type="text" data-table="persona" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($persona->name->getPlaceHolder()) ?>" value="<?php echo $persona->name->EditValue ?>"<?php echo $persona->name->EditAttributes() ?>>
</span>
<?php echo $persona->name->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($persona->lastname->Visible) { // lastname ?>
	<div id="r_lastname" class="form-group">
		<label id="elh_persona_lastname" for="x_lastname" class="<?php echo $persona_edit->LeftColumnClass ?>"><?php echo $persona->lastname->FldCaption() ?></label>
		<div class="<?php echo $persona_edit->RightColumnClass ?>"><div<?php echo $persona->lastname->CellAttributes() ?>>
<span id="el_persona_lastname">
<input type="text" data-table="persona" data-field="x_lastname" name="x_lastname" id="x_lastname" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($persona->lastname->getPlaceHolder()) ?>" value="<?php echo $persona->lastname->EditValue ?>"<?php echo $persona->lastname->EditAttributes() ?>>
</span>
<?php echo $persona->lastname->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($persona->day_of_birth->Visible) { // day_of_birth ?>
	<div id="r_day_of_birth" class="form-group">
		<label id="elh_persona_day_of_birth" for="x_day_of_birth" class="<?php echo $persona_edit->LeftColumnClass ?>"><?php echo $persona->day_of_birth->FldCaption() ?></label>
		<div class="<?php echo $persona_edit->RightColumnClass ?>"><div<?php echo $persona->day_of_birth->CellAttributes() ?>>
<span id="el_persona_day_of_birth">
<input type="text" data-table="persona" data-field="x_day_of_birth" name="x_day_of_birth" id="x_day_of_birth" placeholder="<?php echo ew_HtmlEncode($persona->day_of_birth->getPlaceHolder()) ?>" value="<?php echo $persona->day_of_birth->EditValue ?>"<?php echo $persona->day_of_birth->EditAttributes() ?>>
</span>
<?php echo $persona->day_of_birth->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($persona->_email->Visible) { // email ?>
	<div id="r__email" class="form-group">
		<label id="elh_persona__email" for="x__email" class="<?php echo $persona_edit->LeftColumnClass ?>"><?php echo $persona->_email->FldCaption() ?></label>
		<div class="<?php echo $persona_edit->RightColumnClass ?>"><div<?php echo $persona->_email->CellAttributes() ?>>
<span id="el_persona__email">
<input type="text" data-table="persona" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($persona->_email->getPlaceHolder()) ?>" value="<?php echo $persona->_email->EditValue ?>"<?php echo $persona->_email->EditAttributes() ?>>
</span>
<?php echo $persona->_email->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($persona->address->Visible) { // address ?>
	<div id="r_address" class="form-group">
		<label id="elh_persona_address" for="x_address" class="<?php echo $persona_edit->LeftColumnClass ?>"><?php echo $persona->address->FldCaption() ?></label>
		<div class="<?php echo $persona_edit->RightColumnClass ?>"><div<?php echo $persona->address->CellAttributes() ?>>
<span id="el_persona_address">
<input type="text" data-table="persona" data-field="x_address" name="x_address" id="x_address" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($persona->address->getPlaceHolder()) ?>" value="<?php echo $persona->address->EditValue ?>"<?php echo $persona->address->EditAttributes() ?>>
</span>
<?php echo $persona->address->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($persona->phone->Visible) { // phone ?>
	<div id="r_phone" class="form-group">
		<label id="elh_persona_phone" for="x_phone" class="<?php echo $persona_edit->LeftColumnClass ?>"><?php echo $persona->phone->FldCaption() ?></label>
		<div class="<?php echo $persona_edit->RightColumnClass ?>"><div<?php echo $persona->phone->CellAttributes() ?>>
<span id="el_persona_phone">
<input type="text" data-table="persona" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($persona->phone->getPlaceHolder()) ?>" value="<?php echo $persona->phone->EditValue ?>"<?php echo $persona->phone->EditAttributes() ?>>
</span>
<?php echo $persona->phone->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($persona->id_tipo->Visible) { // id_tipo ?>
	<div id="r_id_tipo" class="form-group">
		<label id="elh_persona_id_tipo" for="x_id_tipo" class="<?php echo $persona_edit->LeftColumnClass ?>"><?php echo $persona->id_tipo->FldCaption() ?></label>
		<div class="<?php echo $persona_edit->RightColumnClass ?>"><div<?php echo $persona->id_tipo->CellAttributes() ?>>
<span id="el_persona_id_tipo">
<input type="text" data-table="persona" data-field="x_id_tipo" name="x_id_tipo" id="x_id_tipo" size="30" placeholder="<?php echo ew_HtmlEncode($persona->id_tipo->getPlaceHolder()) ?>" value="<?php echo $persona->id_tipo->EditValue ?>"<?php echo $persona->id_tipo->EditAttributes() ?>>
</span>
<?php echo $persona->id_tipo->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($persona->is_active->Visible) { // is_active ?>
	<div id="r_is_active" class="form-group">
		<label id="elh_persona_is_active" for="x_is_active" class="<?php echo $persona_edit->LeftColumnClass ?>"><?php echo $persona->is_active->FldCaption() ?></label>
		<div class="<?php echo $persona_edit->RightColumnClass ?>"><div<?php echo $persona->is_active->CellAttributes() ?>>
<span id="el_persona_is_active">
<input type="text" data-table="persona" data-field="x_is_active" name="x_is_active" id="x_is_active" size="30" placeholder="<?php echo ew_HtmlEncode($persona->is_active->getPlaceHolder()) ?>" value="<?php echo $persona->is_active->EditValue ?>"<?php echo $persona->is_active->EditAttributes() ?>>
</span>
<?php echo $persona->is_active->CustomMsg ?></div></div>
	</div>
<?php } ?>
<?php if ($persona->category_id->Visible) { // category_id ?>
	<div id="r_category_id" class="form-group">
		<label id="elh_persona_category_id" for="x_category_id" class="<?php echo $persona_edit->LeftColumnClass ?>"><?php echo $persona->category_id->FldCaption() ?></label>
		<div class="<?php echo $persona_edit->RightColumnClass ?>"><div<?php echo $persona->category_id->CellAttributes() ?>>
<span id="el_persona_category_id">
<input type="text" data-table="persona" data-field="x_category_id" name="x_category_id" id="x_category_id" size="30" placeholder="<?php echo ew_HtmlEncode($persona->category_id->getPlaceHolder()) ?>" value="<?php echo $persona->category_id->EditValue ?>"<?php echo $persona->category_id->EditAttributes() ?>>
</span>
<?php echo $persona->category_id->CustomMsg ?></div></div>
	</div>
<?php } ?>
</div><!-- /page* -->
<?php if (!$persona_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $persona_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $persona_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
</form>
<script type="text/javascript">
fpersonaedit.Init();
</script>
<?php
$persona_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$persona_edit->Page_Terminate();
?>
