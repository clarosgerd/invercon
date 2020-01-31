<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "viewdocumentooficialcreditoinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "viewavaluoinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$viewdocumentooficialcredito_edit = NULL; // Initialize page object first

class cviewdocumentooficialcredito_edit extends cviewdocumentooficialcredito {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewdocumentooficialcredito';

	// Page object name
	var $PageObjName = 'viewdocumentooficialcredito_edit';

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

		// Table object (viewdocumentooficialcredito)
		if (!isset($GLOBALS["viewdocumentooficialcredito"]) || get_class($GLOBALS["viewdocumentooficialcredito"]) == "cviewdocumentooficialcredito") {
			$GLOBALS["viewdocumentooficialcredito"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["viewdocumentooficialcredito"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Table object (viewavaluo)
		if (!isset($GLOBALS['viewavaluo'])) $GLOBALS['viewavaluo'] = new cviewavaluo();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'viewdocumentooficialcredito', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("viewdocumentooficialcreditolist.php"));
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
		global $EW_EXPORT, $viewdocumentooficialcredito;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($viewdocumentooficialcredito);
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
					if ($pageName == "viewdocumentooficialcreditoview.php")
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

		// Set up master detail parameters
		$this->SetupMasterParms();

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
					$this->Page_Terminate("viewdocumentooficialcreditolist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "viewdocumentooficialcreditolist.php")
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
		$this->imagen->Upload->Index = $objForm->Index;
		$this->imagen->Upload->UploadFile();
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
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
		$this->id->CurrentValue = $this->id->FormValue;
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
		$row = array();
		$row['id'] = NULL;
		$row['descripcion'] = NULL;
		$row['imagen'] = NULL;
		$row['avaluo'] = NULL;
		$row['path_drive'] = NULL;
		$row['id_tipodocumento'] = NULL;
		$row['created_at'] = NULL;
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

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// descripcion
		$this->descripcion->ViewValue = $this->descripcion->CurrentValue;
		$this->descripcion->ViewCustomAttributes = "";

		// imagen
		if (!ew_Empty($this->imagen->Upload->DbValue)) {
			$this->imagen->ViewValue = "viewdocumentooficialcredito_imagen_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->imagen->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen->Upload->DbValue, 0, 11)));
		} else {
			$this->imagen->ViewValue = "";
		}
		$this->imagen->ViewCustomAttributes = "";

		// avaluo
		if (strval($this->avaluo->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->avaluo->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
		$sWhereWrk = "";
		$this->avaluo->LookupFilters = array();
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
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipodocumento`";
		$sWhereWrk = "";
		$this->id_tipodocumento->LookupFilters = array("dx1" => '`nombre`');
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

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// descripcion
			$this->descripcion->LinkCustomAttributes = "";
			$this->descripcion->HrefValue = "";
			$this->descripcion->TooltipValue = "";

			// imagen
			$this->imagen->LinkCustomAttributes = "";
			if (!empty($this->imagen->Upload->DbValue)) {
				$this->imagen->HrefValue = "viewdocumentooficialcredito_imagen_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen->HrefValue = ew_FullUrl($this->imagen->HrefValue, "href");
			} else {
				$this->imagen->HrefValue = "";
			}
			$this->imagen->HrefValue2 = "viewdocumentooficialcredito_imagen_bv.php?id=" . $this->id->CurrentValue;
			$this->imagen->TooltipValue = "";

			// avaluo
			$this->avaluo->LinkCustomAttributes = "";
			$this->avaluo->HrefValue = "";
			$this->avaluo->TooltipValue = "";

			// id_tipodocumento
			$this->id_tipodocumento->LinkCustomAttributes = "";
			$this->id_tipodocumento->HrefValue = "";
			$this->id_tipodocumento->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// descripcion
			$this->descripcion->EditAttrs["class"] = "form-control";
			$this->descripcion->EditCustomAttributes = "";
			$this->descripcion->EditValue = ew_HtmlEncode($this->descripcion->CurrentValue);
			$this->descripcion->PlaceHolder = ew_RemoveHtml($this->descripcion->FldTitle());

			// imagen
			$this->imagen->EditAttrs["class"] = "form-control";
			$this->imagen->EditCustomAttributes = "";
			if (!ew_Empty($this->imagen->Upload->DbValue)) {
				$this->imagen->EditValue = "viewdocumentooficialcredito_imagen_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->imagen->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->imagen->Upload->DbValue, 0, 11)));
			} else {
				$this->imagen->EditValue = "";
			}
			if ($this->CurrentAction == "I" && !$this->EventCancelled) ew_RenderUploadField($this->imagen);

			// avaluo
			$this->avaluo->EditAttrs["class"] = "form-control";
			$this->avaluo->EditCustomAttributes = "";
			if ($this->avaluo->getSessionValue() <> "") {
				$this->avaluo->CurrentValue = $this->avaluo->getSessionValue();
			if (strval($this->avaluo->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->avaluo->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
			$sWhereWrk = "";
			$this->avaluo->LookupFilters = array();
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
			$sSqlWrk = "SELECT `id`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `avaluo`";
			$sWhereWrk = "";
			$this->avaluo->LookupFilters = array();
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
			$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `tipodocumento`";
			$sWhereWrk = "";
			$this->id_tipodocumento->LookupFilters = array("dx1" => '`nombre`');
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

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// descripcion
			$this->descripcion->LinkCustomAttributes = "";
			$this->descripcion->HrefValue = "";

			// imagen
			$this->imagen->LinkCustomAttributes = "";
			if (!empty($this->imagen->Upload->DbValue)) {
				$this->imagen->HrefValue = "viewdocumentooficialcredito_imagen_bv.php?id=" . $this->id->CurrentValue;
				$this->imagen->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->imagen->HrefValue = ew_FullUrl($this->imagen->HrefValue, "href");
			} else {
				$this->imagen->HrefValue = "";
			}
			$this->imagen->HrefValue2 = "viewdocumentooficialcredito_imagen_bv.php?id=" . $this->id->CurrentValue;

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

			// descripcion
			$this->descripcion->SetDbValueDef($rsnew, $this->descripcion->CurrentValue, "", $this->descripcion->ReadOnly);

			// imagen
			if ($this->imagen->Visible && !$this->imagen->ReadOnly && !$this->imagen->Upload->KeepFile) {
				if (is_null($this->imagen->Upload->Value)) {
					$rsnew['imagen'] = NULL;
				} else {
					$rsnew['imagen'] = $this->imagen->Upload->Value;
				}
			}

			// avaluo
			$this->avaluo->SetDbValueDef($rsnew, $this->avaluo->CurrentValue, NULL, $this->avaluo->ReadOnly);

			// id_tipodocumento
			$this->id_tipodocumento->SetDbValueDef($rsnew, $this->id_tipodocumento->CurrentValue, NULL, $this->id_tipodocumento->ReadOnly);

			// Check referential integrity for master table 'viewavaluo'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_viewavaluo();
			$KeyValue = isset($rsnew['path_drive']) ? $rsnew['path_drive'] : $rsold['path_drive'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@id@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			$KeyValue = isset($rsnew['avaluo']) ? $rsnew['avaluo'] : $rsold['avaluo'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@id@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				if (!isset($GLOBALS["viewavaluo"])) $GLOBALS["viewavaluo"] = new cviewavaluo();
				$rsmaster = $GLOBALS["viewavaluo"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "viewavaluo", $Language->Phrase("RelatedRecordRequired"));
				$this->setFailureMessage($sRelatedRecordMsg);
				$rs->Close();
				return FALSE;
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

		// imagen
		ew_CleanUploadTempPath($this->imagen, $this->imagen->Upload->Index);
		return $EditRow;
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
			if ($sMasterTblVar == "viewavaluo") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["viewavaluo"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->path_drive->setQueryStringValue($GLOBALS["viewavaluo"]->id->QueryStringValue);
					$this->path_drive->setSessionValue($this->path_drive->QueryStringValue);
					if (!is_numeric($GLOBALS["viewavaluo"]->id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["viewavaluo"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->avaluo->setQueryStringValue($GLOBALS["viewavaluo"]->id->QueryStringValue);
					$this->avaluo->setSessionValue($this->avaluo->QueryStringValue);
					if (!is_numeric($GLOBALS["viewavaluo"]->id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "viewavaluo") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["viewavaluo"]->id->setFormValue($_POST["fk_id"]);
					$this->path_drive->setFormValue($GLOBALS["viewavaluo"]->id->FormValue);
					$this->path_drive->setSessionValue($this->path_drive->FormValue);
					if (!is_numeric($GLOBALS["viewavaluo"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["viewavaluo"]->id->setFormValue($_POST["fk_id"]);
					$this->avaluo->setFormValue($GLOBALS["viewavaluo"]->id->FormValue);
					$this->avaluo->setSessionValue($this->avaluo->FormValue);
					if (!is_numeric($GLOBALS["viewavaluo"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);
			$this->setSessionWhere($this->GetDetailFilter());

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "viewavaluo") {
				if ($this->path_drive->CurrentValue == "") $this->path_drive->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("viewdocumentooficialcreditolist.php"), "", $this->TableVar, TRUE);
		$PageId = "edit";
		$Breadcrumb->Add("edit", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_avaluo":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `tipoinmueble` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `avaluo`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->avaluo, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_tipodocumento":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipodocumento`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`nombre`');
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
if (!isset($viewdocumentooficialcredito_edit)) $viewdocumentooficialcredito_edit = new cviewdocumentooficialcredito_edit();

// Page init
$viewdocumentooficialcredito_edit->Page_Init();

// Page main
$viewdocumentooficialcredito_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewdocumentooficialcredito_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fviewdocumentooficialcreditoedit = new ew_Form("fviewdocumentooficialcreditoedit", "edit");

// Validate form
fviewdocumentooficialcreditoedit.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewdocumentooficialcredito->descripcion->FldCaption(), $viewdocumentooficialcredito->descripcion->ReqErrMsg)) ?>");

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
fviewdocumentooficialcreditoedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewdocumentooficialcreditoedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewdocumentooficialcreditoedit.Lists["x_avaluo"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tipoinmueble","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"avaluo"};
fviewdocumentooficialcreditoedit.Lists["x_avaluo"].Data = "<?php echo $viewdocumentooficialcredito_edit->avaluo->LookupFilterQuery(FALSE, "edit") ?>";
fviewdocumentooficialcreditoedit.Lists["x_id_tipodocumento"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipodocumento"};
fviewdocumentooficialcreditoedit.Lists["x_id_tipodocumento"].Data = "<?php echo $viewdocumentooficialcredito_edit->id_tipodocumento->LookupFilterQuery(FALSE, "edit") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $viewdocumentooficialcredito_edit->ShowPageHeader(); ?>
<?php
$viewdocumentooficialcredito_edit->ShowMessage();
?>
<form name="fviewdocumentooficialcreditoedit" id="fviewdocumentooficialcreditoedit" class="<?php echo $viewdocumentooficialcredito_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewdocumentooficialcredito_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewdocumentooficialcredito_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewdocumentooficialcredito">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($viewdocumentooficialcredito_edit->IsModal) ?>">
<?php if ($viewdocumentooficialcredito->getCurrentMasterTable() == "viewavaluo") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="viewavaluo">
<input type="hidden" name="fk_id" value="<?php echo $viewdocumentooficialcredito->path_drive->getSessionValue() ?>">
<input type="hidden" name="fk_id" value="<?php echo $viewdocumentooficialcredito->avaluo->getSessionValue() ?>">
<?php } ?>
<?php if (!$viewdocumentooficialcredito_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($viewdocumentooficialcredito_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_viewdocumentooficialcreditoedit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($viewdocumentooficialcredito->id->Visible) { // id ?>
<?php if ($viewdocumentooficialcredito_edit->IsMobileOrModal) { ?>
	<div id="r_id" class="form-group">
		<label id="elh_viewdocumentooficialcredito_id" class="<?php echo $viewdocumentooficialcredito_edit->LeftColumnClass ?>"><?php echo $viewdocumentooficialcredito->id->FldCaption() ?></label>
		<div class="<?php echo $viewdocumentooficialcredito_edit->RightColumnClass ?>"><div<?php echo $viewdocumentooficialcredito->id->CellAttributes() ?>>
<span id="el_viewdocumentooficialcredito_id">
<span<?php echo $viewdocumentooficialcredito->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentooficialcredito->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->id->CurrentValue) ?>">
<?php echo $viewdocumentooficialcredito->id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id">
		<td class="col-sm-3"><span id="elh_viewdocumentooficialcredito_id"><?php echo $viewdocumentooficialcredito->id->FldCaption() ?></span></td>
		<td<?php echo $viewdocumentooficialcredito->id->CellAttributes() ?>>
<span id="el_viewdocumentooficialcredito_id">
<span<?php echo $viewdocumentooficialcredito->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentooficialcredito->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->id->CurrentValue) ?>">
<?php echo $viewdocumentooficialcredito->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentooficialcredito->descripcion->Visible) { // descripcion ?>
<?php if ($viewdocumentooficialcredito_edit->IsMobileOrModal) { ?>
	<div id="r_descripcion" class="form-group">
		<label id="elh_viewdocumentooficialcredito_descripcion" for="x_descripcion" class="<?php echo $viewdocumentooficialcredito_edit->LeftColumnClass ?>"><?php echo $viewdocumentooficialcredito->descripcion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $viewdocumentooficialcredito_edit->RightColumnClass ?>"><div<?php echo $viewdocumentooficialcredito->descripcion->CellAttributes() ?>>
<span id="el_viewdocumentooficialcredito_descripcion">
<textarea data-table="viewdocumentooficialcredito" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentooficialcredito->descripcion->EditAttributes() ?>><?php echo $viewdocumentooficialcredito->descripcion->EditValue ?></textarea>
</span>
<?php echo $viewdocumentooficialcredito->descripcion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_descripcion">
		<td class="col-sm-3"><span id="elh_viewdocumentooficialcredito_descripcion"><?php echo $viewdocumentooficialcredito->descripcion->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $viewdocumentooficialcredito->descripcion->CellAttributes() ?>>
<span id="el_viewdocumentooficialcredito_descripcion">
<textarea data-table="viewdocumentooficialcredito" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentooficialcredito->descripcion->EditAttributes() ?>><?php echo $viewdocumentooficialcredito->descripcion->EditValue ?></textarea>
</span>
<?php echo $viewdocumentooficialcredito->descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentooficialcredito->imagen->Visible) { // imagen ?>
<?php if ($viewdocumentooficialcredito_edit->IsMobileOrModal) { ?>
	<div id="r_imagen" class="form-group">
		<label id="elh_viewdocumentooficialcredito_imagen" class="<?php echo $viewdocumentooficialcredito_edit->LeftColumnClass ?>"><?php echo $viewdocumentooficialcredito->imagen->FldCaption() ?></label>
		<div class="<?php echo $viewdocumentooficialcredito_edit->RightColumnClass ?>"><div<?php echo $viewdocumentooficialcredito->imagen->CellAttributes() ?>>
<span id="el_viewdocumentooficialcredito_imagen">
<div id="fd_x_imagen">
<span title="<?php echo $viewdocumentooficialcredito->imagen->FldTitle() ? $viewdocumentooficialcredito->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentooficialcredito->imagen->ReadOnly || $viewdocumentooficialcredito->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentooficialcredito" data-field="x_imagen" name="x_imagen" id="x_imagen"<?php echo $viewdocumentooficialcredito->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen" id= "fn_x_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen"] == "0") { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen" id= "fs_x_imagen" value="0">
<input type="hidden" name="fx_x_imagen" id= "fx_x_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen" id= "fm_x_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewdocumentooficialcredito->imagen->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_imagen">
		<td class="col-sm-3"><span id="elh_viewdocumentooficialcredito_imagen"><?php echo $viewdocumentooficialcredito->imagen->FldCaption() ?></span></td>
		<td<?php echo $viewdocumentooficialcredito->imagen->CellAttributes() ?>>
<span id="el_viewdocumentooficialcredito_imagen">
<div id="fd_x_imagen">
<span title="<?php echo $viewdocumentooficialcredito->imagen->FldTitle() ? $viewdocumentooficialcredito->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentooficialcredito->imagen->ReadOnly || $viewdocumentooficialcredito->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentooficialcredito" data-field="x_imagen" name="x_imagen" id="x_imagen"<?php echo $viewdocumentooficialcredito->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen" id= "fn_x_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen"] == "0") { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="1">
<?php } ?>
<input type="hidden" name="fs_x_imagen" id= "fs_x_imagen" value="0">
<input type="hidden" name="fx_x_imagen" id= "fx_x_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x_imagen" id= "fm_x_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php echo $viewdocumentooficialcredito->imagen->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentooficialcredito->avaluo->Visible) { // avaluo ?>
<?php if ($viewdocumentooficialcredito_edit->IsMobileOrModal) { ?>
	<div id="r_avaluo" class="form-group">
		<label id="elh_viewdocumentooficialcredito_avaluo" for="x_avaluo" class="<?php echo $viewdocumentooficialcredito_edit->LeftColumnClass ?>"><?php echo $viewdocumentooficialcredito->avaluo->FldCaption() ?></label>
		<div class="<?php echo $viewdocumentooficialcredito_edit->RightColumnClass ?>"><div<?php echo $viewdocumentooficialcredito->avaluo->CellAttributes() ?>>
<?php if ($viewdocumentooficialcredito->avaluo->getSessionValue() <> "") { ?>
<span id="el_viewdocumentooficialcredito_avaluo">
<span<?php echo $viewdocumentooficialcredito->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentooficialcredito->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_avaluo" name="x_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_viewdocumentooficialcredito_avaluo">
<select data-table="viewdocumentooficialcredito" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentooficialcredito->avaluo->DisplayValueSeparatorAttribute() ?>" id="x_avaluo" name="x_avaluo"<?php echo $viewdocumentooficialcredito->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentooficialcredito->avaluo->SelectOptionListHtml("x_avaluo") ?>
</select>
</span>
<?php } ?>
<?php echo $viewdocumentooficialcredito->avaluo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_avaluo">
		<td class="col-sm-3"><span id="elh_viewdocumentooficialcredito_avaluo"><?php echo $viewdocumentooficialcredito->avaluo->FldCaption() ?></span></td>
		<td<?php echo $viewdocumentooficialcredito->avaluo->CellAttributes() ?>>
<?php if ($viewdocumentooficialcredito->avaluo->getSessionValue() <> "") { ?>
<span id="el_viewdocumentooficialcredito_avaluo">
<span<?php echo $viewdocumentooficialcredito->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentooficialcredito->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_avaluo" name="x_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el_viewdocumentooficialcredito_avaluo">
<select data-table="viewdocumentooficialcredito" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentooficialcredito->avaluo->DisplayValueSeparatorAttribute() ?>" id="x_avaluo" name="x_avaluo"<?php echo $viewdocumentooficialcredito->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentooficialcredito->avaluo->SelectOptionListHtml("x_avaluo") ?>
</select>
</span>
<?php } ?>
<?php echo $viewdocumentooficialcredito->avaluo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentooficialcredito->id_tipodocumento->Visible) { // id_tipodocumento ?>
<?php if ($viewdocumentooficialcredito_edit->IsMobileOrModal) { ?>
	<div id="r_id_tipodocumento" class="form-group">
		<label id="elh_viewdocumentooficialcredito_id_tipodocumento" for="x_id_tipodocumento" class="<?php echo $viewdocumentooficialcredito_edit->LeftColumnClass ?>"><?php echo $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?></label>
		<div class="<?php echo $viewdocumentooficialcredito_edit->RightColumnClass ?>"><div<?php echo $viewdocumentooficialcredito->id_tipodocumento->CellAttributes() ?>>
<span id="el_viewdocumentooficialcredito_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_id_tipodocumento"><?php echo (strval($viewdocumentooficialcredito->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentooficialcredito->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentooficialcredito->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentooficialcredito->id_tipodocumento->ReadOnly || $viewdocumentooficialcredito->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentooficialcredito->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x_id_tipodocumento" id="x_id_tipodocumento" value="<?php echo $viewdocumentooficialcredito->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentooficialcredito->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentooficialcredito->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php echo $viewdocumentooficialcredito->id_tipodocumento->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_tipodocumento">
		<td class="col-sm-3"><span id="elh_viewdocumentooficialcredito_id_tipodocumento"><?php echo $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?></span></td>
		<td<?php echo $viewdocumentooficialcredito->id_tipodocumento->CellAttributes() ?>>
<span id="el_viewdocumentooficialcredito_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_id_tipodocumento"><?php echo (strval($viewdocumentooficialcredito->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentooficialcredito->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentooficialcredito->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentooficialcredito->id_tipodocumento->ReadOnly || $viewdocumentooficialcredito->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentooficialcredito->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x_id_tipodocumento" id="x_id_tipodocumento" value="<?php echo $viewdocumentooficialcredito->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentooficialcredito->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentooficialcredito->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php echo $viewdocumentooficialcredito->id_tipodocumento->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentooficialcredito_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$viewdocumentooficialcredito_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $viewdocumentooficialcredito_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $viewdocumentooficialcredito_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$viewdocumentooficialcredito_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fviewdocumentooficialcreditoedit.Init();
</script>
<?php
$viewdocumentooficialcredito_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$viewdocumentooficialcredito_edit->Page_Terminate();
?>
