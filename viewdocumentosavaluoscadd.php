<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "viewdocumentosavaluoscinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "viewavaluoscinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$viewdocumentosavaluosc_add = NULL; // Initialize page object first

class cviewdocumentosavaluosc_add extends cviewdocumentosavaluosc {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewdocumentosavaluosc';

	// Page object name
	var $PageObjName = 'viewdocumentosavaluosc_add';

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

		// Table object (viewdocumentosavaluosc)
		if (!isset($GLOBALS["viewdocumentosavaluosc"]) || get_class($GLOBALS["viewdocumentosavaluosc"]) == "cviewdocumentosavaluosc") {
			$GLOBALS["viewdocumentosavaluosc"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["viewdocumentosavaluosc"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Table object (viewavaluosc)
		if (!isset($GLOBALS['viewavaluosc'])) $GLOBALS['viewavaluosc'] = new cviewavaluosc();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'viewdocumentosavaluosc', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("viewdocumentosavaluosclist.php"));
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
		$this->descripcion->SetVisibility();
		$this->imagen->SetVisibility();
		$this->avaluo->SetVisibility();
		$this->id_tipodocumento->SetVisibility();

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
		global $EW_EXPORT, $viewdocumentosavaluosc;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($viewdocumentosavaluosc);
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
					if ($pageName == "viewdocumentosavaluoscview.php")
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
					$this->Page_Terminate("viewdocumentosavaluosclist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "viewdocumentosavaluosclist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "viewdocumentosavaluoscview.php")
						$sReturnUrl = $this->GetViewUrl(); // View page, return to View page with keyurl directly
					$this->Page_Terminate($sReturnUrl); // Clean up and return
				} else {
					$this->EventCancelled = TRUE; // Event cancelled
					$this->RestoreFormValues(); // Add failed, restore form values
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
		$this->imagen->Upload->Index = $objForm->Index;
		$this->imagen->Upload->UploadFile();
	}

	// Load default values
	function LoadDefaultValues() {
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->descripcion->CurrentValue = NULL;
		$this->descripcion->OldValue = $this->descripcion->CurrentValue;
		$this->imagen->Upload->DbValue = NULL;
		$this->imagen->OldValue = $this->imagen->Upload->DbValue;
		$this->avaluo->CurrentValue = NULL;
		$this->avaluo->OldValue = $this->avaluo->CurrentValue;
		$this->path_drive->CurrentValue = NULL;
		$this->path_drive->OldValue = $this->path_drive->CurrentValue;
		$this->id_tipodocumento->CurrentValue = NULL;
		$this->id_tipodocumento->OldValue = $this->id_tipodocumento->CurrentValue;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->descripcion->FldIsDetailKey) {
			$this->descripcion->setFormValue($objForm->GetValue("x_descripcion"));
		}
		if (!$this->avaluo->FldIsDetailKey) {
			$this->avaluo->setFormValue($objForm->GetValue("x_avaluo"));
		}
		if (!$this->id_tipodocumento->FldIsDetailKey) {
			$this->id_tipodocumento->setFormValue($objForm->GetValue("x_id_tipodocumento"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->descripcion->CurrentValue = $this->descripcion->FormValue;
		$this->avaluo->CurrentValue = $this->avaluo->FormValue;
		$this->id_tipodocumento->CurrentValue = $this->id_tipodocumento->FormValue;
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
		$this->descripcion->setDbValue($row['descripcion']);
		$this->imagen->Upload->DbValue = $row['imagen'];
		if (is_array($this->imagen->Upload->DbValue) || is_object($this->imagen->Upload->DbValue)) // Byte array
			$this->imagen->Upload->DbValue = ew_BytesToStr($this->imagen->Upload->DbValue);
		$this->avaluo->setDbValue($row['avaluo']);
		$this->path_drive->setDbValue($row['path_drive']);
		$this->id_tipodocumento->setDbValue($row['id_tipodocumento']);
		$this->created_at->setDbValue($row['created_at']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['id'] = $this->id->CurrentValue;
		$row['descripcion'] = $this->descripcion->CurrentValue;
		$row['imagen'] = $this->imagen->Upload->DbValue;
		$row['avaluo'] = $this->avaluo->CurrentValue;
		$row['path_drive'] = $this->path_drive->CurrentValue;
		$row['id_tipodocumento'] = $this->id_tipodocumento->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->descripcion->DbValue = $row['descripcion'];
		$this->imagen->Upload->DbValue = $row['imagen'];
		$this->avaluo->DbValue = $row['avaluo'];
		$this->path_drive->DbValue = $row['path_drive'];
		$this->id_tipodocumento->DbValue = $row['id_tipodocumento'];
		$this->created_at->DbValue = $row['created_at'];
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
		// descripcion
		// imagen
		// avaluo
		// path_drive
		// id_tipodocumento
		// created_at

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// descripcion
		$this->descripcion->ViewValue = $this->descripcion->CurrentValue;
		$this->descripcion->ViewCustomAttributes = "";

		// imagen
		if (!ew_Empty($this->imagen->Upload->DbValue)) {
			$this->imagen->ViewValue = "viewdocumentosavaluosc_imagen_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen->ViewValue = "";
		}
		$this->imagen->ViewCustomAttributes = "";

		// avaluo
		if (strval($this->avaluo->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->avaluo->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
				$sWhereWrk = "";
				$this->avaluo->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
				$sWhereWrk = "";
				$this->avaluo->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
				$sWhereWrk = "";
				$this->avaluo->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->avaluo, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->avaluo->ViewValue = $this->avaluo->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->avaluo->ViewValue = $this->avaluo->CurrentValue;
			}
		} else {
			$this->avaluo->ViewValue = NULL;
		}
		$this->avaluo->ViewCustomAttributes = "";

		// id_tipodocumento
		if (strval($this->id_tipodocumento->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_tipodocumento->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipodocumento`";
				$sWhereWrk = "";
				$this->id_tipodocumento->LookupFilters = array("dx1" => '`nombre`');
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipodocumento`";
				$sWhereWrk = "";
				$this->id_tipodocumento->LookupFilters = array("dx1" => '`nombre`');
				break;
			default:
				$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipodocumento`";
				$sWhereWrk = "";
				$this->id_tipodocumento->LookupFilters = array("dx1" => '`nombre`');
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_tipodocumento, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_tipodocumento->ViewValue = $this->id_tipodocumento->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_tipodocumento->ViewValue = $this->id_tipodocumento->CurrentValue;
			}
		} else {
			$this->id_tipodocumento->ViewValue = NULL;
		}
		$this->id_tipodocumento->ViewCustomAttributes = "";

			// descripcion
			$this->descripcion->LinkCustomAttributes = "";
			$this->descripcion->HrefValue = "";
			$this->descripcion->TooltipValue = "";

			// imagen
			$this->imagen->LinkCustomAttributes = "";
			if (!empty($this->imagen->Upload->DbValue)) {
				$this->imagen->HrefValue = "viewdocumentosavaluosc_imagen_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen->HrefValue = ew_FullUrl($this->imagen->HrefValue, "href");
			} else {
				$this->imagen->HrefValue = "";
			}
			$this->imagen->HrefValue2 = "viewdocumentosavaluosc_imagen_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen->TooltipValue = "";

			// avaluo
			$this->avaluo->LinkCustomAttributes = "";
			$this->avaluo->HrefValue = "";
			$this->avaluo->TooltipValue = "";

			// id_tipodocumento
			$this->id_tipodocumento->LinkCustomAttributes = "";
			$this->id_tipodocumento->HrefValue = "";
			$this->id_tipodocumento->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// descripcion
			$this->descripcion->EditAttrs["class"] = "form-control";
			$this->descripcion->EditCustomAttributes = "";
			$this->descripcion->EditValue = ew_HtmlEncode($this->descripcion->CurrentValue);
			$this->descripcion->PlaceHolder = ew_RemoveHtml($this->descripcion->FldTitle());

			// imagen
			$this->imagen->EditAttrs["class"] = "form-control";
			$this->imagen->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen->Upload->DbValue)) {
				$this->imagen->EditValue = "viewdocumentosavaluosc_imagen_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen->EditValue = "";
			}
			if (($this->CurrentAction == "I" || $this->CurrentAction == "C") && !$this->EventCancelled) ew_RenderUploadField($this->imagen);

			// avaluo
			$this->avaluo->EditAttrs["class"] = "form-control";
			$this->avaluo->EditCustomAttributes = "";
			if ($this->avaluo->getSessionValue() <> "") {
				$this->avaluo->CurrentValue = $this->avaluo->getSessionValue();
			if (strval($this->avaluo->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->avaluo->CurrentValue, EW_DATATYPE_NUMBER, "");
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
					$sWhereWrk = "";
					$this->avaluo->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
					$sWhereWrk = "";
					$this->avaluo->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
					$sWhereWrk = "";
					$this->avaluo->LookupFilters = array();
					break;
			}
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->avaluo, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->avaluo->ViewValue = $this->avaluo->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->avaluo->ViewValue = $this->avaluo->CurrentValue;
				}
			} else {
				$this->avaluo->ViewValue = NULL;
			}
			$this->avaluo->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->avaluo->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->avaluo->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `avaluo`";
					$sWhereWrk = "";
					$this->avaluo->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `avaluo`";
					$sWhereWrk = "";
					$this->avaluo->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `avaluo`";
					$sWhereWrk = "";
					$this->avaluo->LookupFilters = array();
					break;
			}
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->avaluo, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->avaluo->EditValue = $arwrk;
			}

			// id_tipodocumento
			$this->id_tipodocumento->EditCustomAttributes = "";
			if (trim(strval($this->id_tipodocumento->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_tipodocumento->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tipodocumento`";
					$sWhereWrk = "";
					$this->id_tipodocumento->LookupFilters = array("dx1" => '`nombre`');
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tipodocumento`";
					$sWhereWrk = "";
					$this->id_tipodocumento->LookupFilters = array("dx1" => '`nombre`');
					break;
				default:
					$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tipodocumento`";
					$sWhereWrk = "";
					$this->id_tipodocumento->LookupFilters = array("dx1" => '`nombre`');
					break;
			}
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_tipodocumento, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->id_tipodocumento->ViewValue = $this->id_tipodocumento->DisplayValue($arwrk);
			} else {
				$this->id_tipodocumento->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_tipodocumento->EditValue = $arwrk;

			// Add refer script
			// descripcion

			$this->descripcion->LinkCustomAttributes = "";
			$this->descripcion->HrefValue = "";

			// imagen
			$this->imagen->LinkCustomAttributes = "";
			if (!empty($this->imagen->Upload->DbValue)) {
				$this->imagen->HrefValue = "viewdocumentosavaluosc_imagen_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen->HrefValue = ew_FullUrl($this->imagen->HrefValue, "href");
			} else {
				$this->imagen->HrefValue = "";
			}
			$this->imagen->HrefValue2 = "viewdocumentosavaluosc_imagen_bv.php?id=" . $this->id->CurrentValue;

			// avaluo
			$this->avaluo->LinkCustomAttributes = "";
			$this->avaluo->HrefValue = "";

			// id_tipodocumento
			$this->id_tipodocumento->LinkCustomAttributes = "";
			$this->id_tipodocumento->HrefValue = "";
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
		if (!$this->descripcion->FldIsDetailKey && !is_null($this->descripcion->FormValue) && $this->descripcion->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->descripcion->FldCaption(), $this->descripcion->ReqErrMsg));
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

		// Check referential integrity for master table 'viewavaluosc'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_viewavaluosc();
		if (strval($this->avaluo->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@id@", ew_AdjustSql($this->avaluo->CurrentValue, "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			if (!isset($GLOBALS["viewavaluosc"])) $GLOBALS["viewavaluosc"] = new cviewavaluosc();
			$rsmaster = $GLOBALS["viewavaluosc"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "viewavaluosc", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// descripcion
		$this->descripcion->SetDbValueDef($rsnew, $this->descripcion->CurrentValue, "", FALSE);

		// imagen
		if ($this->imagen->Visible && !$this->imagen->Upload->KeepFile) {
			if (is_null($this->imagen->Upload->Value)) {
				$rsnew['imagen'] = NULL;
			} else {
				$rsnew['imagen'] = $this->imagen->Upload->Value;
			}
		}

		// avaluo
		$this->avaluo->SetDbValueDef($rsnew, $this->avaluo->CurrentValue, NULL, FALSE);

		// id_tipodocumento
		$this->id_tipodocumento->SetDbValueDef($rsnew, $this->id_tipodocumento->CurrentValue, NULL, FALSE);

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
		if ($AddRow) {

			// Call Row Inserted event
			$rs = ($rsold == NULL) ? NULL : $rsold->fields;
			$this->Row_Inserted($rs, $rsnew);
		}

		// imagen
		ew_CleanUploadTempPath($this->imagen, $this->imagen->Upload->Index);
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
			if ($sMasterTblVar == "viewavaluosc") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["viewavaluosc"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->avaluo->setQueryStringValue($GLOBALS["viewavaluosc"]->id->QueryStringValue);
					$this->avaluo->setSessionValue($this->avaluo->QueryStringValue);
					if (!is_numeric($GLOBALS["viewavaluosc"]->id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "viewavaluosc") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["viewavaluosc"]->id->setFormValue($_POST["fk_id"]);
					$this->avaluo->setFormValue($GLOBALS["viewavaluosc"]->id->FormValue);
					$this->avaluo->setSessionValue($this->avaluo->FormValue);
					if (!is_numeric($GLOBALS["viewavaluosc"]->id->FormValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar <> "viewavaluosc") {
				if ($this->avaluo->CurrentValue == "") $this->avaluo->setSessionValue("");
			}
		}
		$this->DbMasterFilter = $this->GetMasterFilter(); // Get master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Get detail filter
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("viewdocumentosavaluosclist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_avaluo":
			$sSqlWrk = "";
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
					$sWhereWrk = "";
					$fld->LookupFilters = array();
					break;
			}
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->avaluo, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_tipodocumento":
			$sSqlWrk = "";
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipodocumento`";
					$sWhereWrk = "{filter}";
					$fld->LookupFilters = array("dx1" => '`nombre`');
					break;
				case "es":
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipodocumento`";
					$sWhereWrk = "{filter}";
					$fld->LookupFilters = array("dx1" => '`nombre`');
					break;
				default:
					$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipodocumento`";
					$sWhereWrk = "{filter}";
					$fld->LookupFilters = array("dx1" => '`nombre`');
					break;
			}
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_tipodocumento, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($viewdocumentosavaluosc_add)) $viewdocumentosavaluosc_add = new cviewdocumentosavaluosc_add();

// Page init
$viewdocumentosavaluosc_add->Page_Init();

// Page main
$viewdocumentosavaluosc_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewdocumentosavaluosc_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fviewdocumentosavaluoscadd = new ew_Form("fviewdocumentosavaluoscadd", "add");

// Validate form
fviewdocumentosavaluoscadd.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_descripcion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewdocumentosavaluosc->descripcion->FldCaption(), $viewdocumentosavaluosc->descripcion->ReqErrMsg)) ?>");

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
fviewdocumentosavaluoscadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewdocumentosavaluoscadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewdocumentosavaluoscadd.Lists["x_avaluo"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tipoinmueble","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"avaluo"};
fviewdocumentosavaluoscadd.Lists["x_avaluo"].Data = "<?php echo $viewdocumentosavaluosc_add->avaluo->LookupFilterQuery(FALSE, "add") ?>";
fviewdocumentosavaluoscadd.Lists["x_id_tipodocumento"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipodocumento"};
fviewdocumentosavaluoscadd.Lists["x_id_tipodocumento"].Data = "<?php echo $viewdocumentosavaluosc_add->id_tipodocumento->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $viewdocumentosavaluosc_add->ShowPageHeader(); ?>
<?php
$viewdocumentosavaluosc_add->ShowMessage();
?>
<form name="fviewdocumentosavaluoscadd" id="fviewdocumentosavaluoscadd" class="<?php echo $viewdocumentosavaluosc_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewdocumentosavaluosc_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewdocumentosavaluosc_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewdocumentosavaluosc">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="<?php echo intval($viewdocumentosavaluosc_add->IsModal) ?>">
<?php if ($viewdocumentosavaluosc->getCurrentMasterTable() == "viewavaluosc") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="viewavaluosc">
<input type="hidden" name="fk_id" value="<?php echo $viewdocumentosavaluosc->avaluo->getSessionValue() ?>">
<?php } ?>
<?php if (!$viewdocumentosavaluosc_add->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($viewdocumentosavaluosc_add->IsMobileOrModal) { ?>
<div class="ewAddDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_viewdocumentosavaluoscadd" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($viewdocumentosavaluosc->descripcion->Visible) { // descripcion ?>
<?php if ($viewdocumentosavaluosc_add->IsMobileOrModal) { ?>
	<div id="r_descripcion" class="form-group">
		<label id="elh_viewdocumentosavaluosc_descripcion" for="x_descripcion" class="<?php echo $viewdocumentosavaluosc_add->LeftColumnClass ?>"><?php echo $viewdocumentosavaluosc->descripcion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $viewdocumentosavaluosc_add->RightColumnClass ?>"><div<?php echo $viewdocumentosavaluosc->descripcion->CellAttributes() ?>>
<span id="el_viewdocumentosavaluosc_descripcion">
<textarea data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentosavaluosc->descripcion->EditAttributes() ?>><?php echo $viewdocumentosavaluosc->descripcion->EditValue ?></textarea>
</span>
<?php echo $viewdocumentosavaluosc->descripcion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_descripcion">
		<td class="col-sm-3"><span id="elh_viewdocumentosavaluosc_descripcion"><?php echo $viewdocumentosavaluosc->descripcion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $viewdocumentosavaluosc->descripcion->CellAttributes() ?>>
<span id="el_viewdocumentosavaluosc_descripcion">
<textarea data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentosavaluosc->descripcion->EditAttributes() ?>><?php echo $viewdocumentosavaluosc->descripcion->EditValue ?></textarea>
</span>
<?php echo $viewdocumentosavaluosc->descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentosavaluosc->imagen->Visible) { // imagen ?>
<?php if ($viewdocumentosavaluosc_add->IsMobileOrModal) { ?>
	<div id="r_imagen" class="form-group">
		<label id="elh_viewdocumentosavaluosc_imagen" class="<?php echo $viewdocumentosavaluosc_add->LeftColumnClass ?>"><?php echo $viewdocumentosavaluosc->imagen->FldCaption() ?></label>
		<div class="<?php echo $viewdocumentosavaluosc_add->RightColumnClass ?>"><div<?php echo $viewdocumentosavaluosc->imagen->CellAttributes() ?>>
<span id="el_viewdocumentosavaluosc_imagen">
<div id="fd_x_imagen">
<span title="<?php echo $viewdocumentosavaluosc->imagen->FldTitle() ? $viewdocumentosavaluosc->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentosavaluosc->imagen->ReadOnly || $viewdocumentosavaluosc->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentosavaluosc" data-field="x_imagen" name="x_imagen" id="x_imagen"<?php echo $viewdocumentosavaluosc->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen" id= "fn_x_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->Upload->FileName ?>">
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="0">
<input type="hidden" name="fs_x_imagen" id= "fs_x_imagen" value="0">
<input type="hidden" name="fx_x_imagen" id= "fx_x_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen" id= "fm_x_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewdocumentosavaluosc->imagen->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen">
		<td class="col-sm-3"><span id="elh_viewdocumentosavaluosc_imagen"><?php echo $viewdocumentosavaluosc->imagen->FldCaption() ?></span></td>
		<td<?php echo $viewdocumentosavaluosc->imagen->CellAttributes() ?>>
<span id="el_viewdocumentosavaluosc_imagen">
<div id="fd_x_imagen">
<span title="<?php echo $viewdocumentosavaluosc->imagen->FldTitle() ? $viewdocumentosavaluosc->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentosavaluosc->imagen->ReadOnly || $viewdocumentosavaluosc->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentosavaluosc" data-field="x_imagen" name="x_imagen" id="x_imagen"<?php echo $viewdocumentosavaluosc->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen" id= "fn_x_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->Upload->FileName ?>">
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="0">
<input type="hidden" name="fs_x_imagen" id= "fs_x_imagen" value="0">
<input type="hidden" name="fx_x_imagen" id= "fx_x_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen" id= "fm_x_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewdocumentosavaluosc->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentosavaluosc->avaluo->Visible) { // avaluo ?>
<?php if ($viewdocumentosavaluosc_add->IsMobileOrModal) { ?>
	<div id="r_avaluo" class="form-group">
		<label id="elh_viewdocumentosavaluosc_avaluo" for="x_avaluo" class="<?php echo $viewdocumentosavaluosc_add->LeftColumnClass ?>"><?php echo $viewdocumentosavaluosc->avaluo->FldCaption() ?></label>
		<div class="<?php echo $viewdocumentosavaluosc_add->RightColumnClass ?>"><div<?php echo $viewdocumentosavaluosc->avaluo->CellAttributes() ?>>
<?php if ($viewdocumentosavaluosc->avaluo->getSessionValue() <> "") { ?>
<span id="el_viewdocumentosavaluosc_avaluo">
<span<?php echo $viewdocumentosavaluosc->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosavaluosc->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_avaluo" name="x_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_viewdocumentosavaluosc_avaluo">
<select data-table="viewdocumentosavaluosc" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentosavaluosc->avaluo->DisplayValueSeparatorAttribute() ?>" id="x_avaluo" name="x_avaluo"<?php echo $viewdocumentosavaluosc->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentosavaluosc->avaluo->SelectOptionListHtml("x_avaluo") ?>
</select>
</span>
<?php } ?>
<?php echo $viewdocumentosavaluosc->avaluo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_avaluo">
		<td class="col-sm-3"><span id="elh_viewdocumentosavaluosc_avaluo"><?php echo $viewdocumentosavaluosc->avaluo->FldCaption() ?></span></td>
		<td<?php echo $viewdocumentosavaluosc->avaluo->CellAttributes() ?>>
<?php if ($viewdocumentosavaluosc->avaluo->getSessionValue() <> "") { ?>
<span id="el_viewdocumentosavaluosc_avaluo">
<span<?php echo $viewdocumentosavaluosc->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosavaluosc->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_avaluo" name="x_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_viewdocumentosavaluosc_avaluo">
<select data-table="viewdocumentosavaluosc" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentosavaluosc->avaluo->DisplayValueSeparatorAttribute() ?>" id="x_avaluo" name="x_avaluo"<?php echo $viewdocumentosavaluosc->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentosavaluosc->avaluo->SelectOptionListHtml("x_avaluo") ?>
</select>
</span>
<?php } ?>
<?php echo $viewdocumentosavaluosc->avaluo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentosavaluosc->id_tipodocumento->Visible) { // id_tipodocumento ?>
<?php if ($viewdocumentosavaluosc_add->IsMobileOrModal) { ?>
	<div id="r_id_tipodocumento" class="form-group">
		<label id="elh_viewdocumentosavaluosc_id_tipodocumento" for="x_id_tipodocumento" class="<?php echo $viewdocumentosavaluosc_add->LeftColumnClass ?>"><?php echo $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?></label>
		<div class="<?php echo $viewdocumentosavaluosc_add->RightColumnClass ?>"><div<?php echo $viewdocumentosavaluosc->id_tipodocumento->CellAttributes() ?>>
<span id="el_viewdocumentosavaluosc_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_id_tipodocumento"><?php echo (strval($viewdocumentosavaluosc->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentosavaluosc->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentosavaluosc->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentosavaluosc->id_tipodocumento->ReadOnly || $viewdocumentosavaluosc->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentosavaluosc->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x_id_tipodocumento" id="x_id_tipodocumento" value="<?php echo $viewdocumentosavaluosc->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentosavaluosc->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentosavaluosc->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php echo $viewdocumentosavaluosc->id_tipodocumento->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_tipodocumento">
		<td class="col-sm-3"><span id="elh_viewdocumentosavaluosc_id_tipodocumento"><?php echo $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?></span></td>
		<td<?php echo $viewdocumentosavaluosc->id_tipodocumento->CellAttributes() ?>>
<span id="el_viewdocumentosavaluosc_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_id_tipodocumento"><?php echo (strval($viewdocumentosavaluosc->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentosavaluosc->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentosavaluosc->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentosavaluosc->id_tipodocumento->ReadOnly || $viewdocumentosavaluosc->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentosavaluosc->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x_id_tipodocumento" id="x_id_tipodocumento" value="<?php echo $viewdocumentosavaluosc->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentosavaluosc->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentosavaluosc->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php echo $viewdocumentosavaluosc->id_tipodocumento->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentosavaluosc_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$viewdocumentosavaluosc_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $viewdocumentosavaluosc_add->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $viewdocumentosavaluosc_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$viewdocumentosavaluosc_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fviewdocumentosavaluoscadd.Init();
</script>
<?php
$viewdocumentosavaluosc_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$viewdocumentosavaluosc_add->Page_Terminate();
?>
