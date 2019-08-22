<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "notificacionesinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$notificaciones_edit = NULL; // Initialize page object first

class cnotificaciones_edit extends cnotificaciones {

	// Page ID
	var $PageID = 'edit';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'notificaciones';

	// Page object name
	var $PageObjName = 'notificaciones_edit';

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

		// Table object (notificaciones)
		if (!isset($GLOBALS["notificaciones"]) || get_class($GLOBALS["notificaciones"]) == "cnotificaciones") {
			$GLOBALS["notificaciones"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["notificaciones"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'edit', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'notificaciones', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("notificacioneslist.php"));
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
		$this->mensaje->SetVisibility();
		$this->creadopor->SetVisibility();
		$this->recibidopor->SetVisibility();
		$this->leido->SetVisibility();
		$this->desde->SetVisibility();

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
		global $EW_EXPORT, $notificaciones;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($notificaciones);
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
					if ($pageName == "notificacionesview.php")
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
					$this->Page_Terminate("notificacioneslist.php"); // No matching record, return to list
				}
				break;
			Case "U": // Update
				$sReturnUrl = $this->getReturnUrl();
				if (ew_GetPageName($sReturnUrl) == "notificacioneslist.php")
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
		if (!$this->mensaje->FldIsDetailKey) {
			$this->mensaje->setFormValue($objForm->GetValue("x_mensaje"));
		}
		if (!$this->creadopor->FldIsDetailKey) {
			$this->creadopor->setFormValue($objForm->GetValue("x_creadopor"));
		}
		if (!$this->recibidopor->FldIsDetailKey) {
			$this->recibidopor->setFormValue($objForm->GetValue("x_recibidopor"));
		}
		if (!$this->leido->FldIsDetailKey) {
			$this->leido->setFormValue($objForm->GetValue("x_leido"));
		}
		if (!$this->desde->FldIsDetailKey) {
			$this->desde->setFormValue($objForm->GetValue("x_desde"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->mensaje->CurrentValue = $this->mensaje->FormValue;
		$this->creadopor->CurrentValue = $this->creadopor->FormValue;
		$this->recibidopor->CurrentValue = $this->recibidopor->FormValue;
		$this->leido->CurrentValue = $this->leido->FormValue;
		$this->desde->CurrentValue = $this->desde->FormValue;
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
		$this->mensaje->setDbValue($row['mensaje']);
		$this->creadopor->setDbValue($row['creadopor']);
		$this->recibidopor->setDbValue($row['recibidopor']);
		$this->leido->setDbValue($row['leido']);
		$this->estado->setDbValue($row['estado']);
		$this->fecha->setDbValue($row['fecha']);
		$this->fechaleido->setDbValue($row['fechaleido']);
		$this->desde->setDbValue($row['desde']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['mensaje'] = NULL;
		$row['creadopor'] = NULL;
		$row['recibidopor'] = NULL;
		$row['leido'] = NULL;
		$row['estado'] = NULL;
		$row['fecha'] = NULL;
		$row['fechaleido'] = NULL;
		$row['desde'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->mensaje->DbValue = $row['mensaje'];
		$this->creadopor->DbValue = $row['creadopor'];
		$this->recibidopor->DbValue = $row['recibidopor'];
		$this->leido->DbValue = $row['leido'];
		$this->estado->DbValue = $row['estado'];
		$this->fecha->DbValue = $row['fecha'];
		$this->fechaleido->DbValue = $row['fechaleido'];
		$this->desde->DbValue = $row['desde'];
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
		// mensaje
		// creadopor
		// recibidopor
		// leido
		// estado
		// fecha
		// fechaleido
		// desde

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// mensaje
		$this->mensaje->ViewValue = $this->mensaje->CurrentValue;
		$this->mensaje->ViewCustomAttributes = "";

		// creadopor
		$this->creadopor->ViewValue = $this->creadopor->CurrentValue;
		$this->creadopor->ViewCustomAttributes = "";

		// recibidopor
		$this->recibidopor->ViewValue = $this->recibidopor->CurrentValue;
		$this->recibidopor->ViewCustomAttributes = "";

		// leido
		$this->leido->ViewValue = $this->leido->CurrentValue;
		$this->leido->ViewCustomAttributes = "";

		// desde
		$this->desde->ViewValue = $this->desde->CurrentValue;
		$this->desde->ViewCustomAttributes = "";

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// mensaje
			$this->mensaje->LinkCustomAttributes = "";
			$this->mensaje->HrefValue = "";
			$this->mensaje->TooltipValue = "";

			// creadopor
			$this->creadopor->LinkCustomAttributes = "";
			$this->creadopor->HrefValue = "";
			$this->creadopor->TooltipValue = "";

			// recibidopor
			$this->recibidopor->LinkCustomAttributes = "";
			$this->recibidopor->HrefValue = "";
			$this->recibidopor->TooltipValue = "";

			// leido
			$this->leido->LinkCustomAttributes = "";
			$this->leido->HrefValue = "";
			$this->leido->TooltipValue = "";

			// desde
			$this->desde->LinkCustomAttributes = "";
			$this->desde->HrefValue = "";
			$this->desde->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id
			$this->id->EditAttrs["class"] = "form-control";
			$this->id->EditCustomAttributes = "";
			$this->id->EditValue = $this->id->CurrentValue;
			$this->id->ViewCustomAttributes = "";

			// mensaje
			$this->mensaje->EditAttrs["class"] = "form-control";
			$this->mensaje->EditCustomAttributes = "";
			$this->mensaje->EditValue = ew_HtmlEncode($this->mensaje->CurrentValue);
			$this->mensaje->PlaceHolder = ew_RemoveHtml($this->mensaje->FldTitle());

			// creadopor
			$this->creadopor->EditAttrs["class"] = "form-control";
			$this->creadopor->EditCustomAttributes = "";
			$this->creadopor->EditValue = ew_HtmlEncode($this->creadopor->CurrentValue);
			$this->creadopor->PlaceHolder = ew_RemoveHtml($this->creadopor->FldTitle());

			// recibidopor
			$this->recibidopor->EditAttrs["class"] = "form-control";
			$this->recibidopor->EditCustomAttributes = "";
			$this->recibidopor->EditValue = ew_HtmlEncode($this->recibidopor->CurrentValue);
			$this->recibidopor->PlaceHolder = ew_RemoveHtml($this->recibidopor->FldTitle());

			// leido
			$this->leido->EditAttrs["class"] = "form-control";
			$this->leido->EditCustomAttributes = "";
			$this->leido->EditValue = ew_HtmlEncode($this->leido->CurrentValue);
			$this->leido->PlaceHolder = ew_RemoveHtml($this->leido->FldTitle());

			// desde
			$this->desde->EditAttrs["class"] = "form-control";
			$this->desde->EditCustomAttributes = "";
			$this->desde->EditValue = ew_HtmlEncode($this->desde->CurrentValue);
			$this->desde->PlaceHolder = ew_RemoveHtml($this->desde->FldTitle());

			// Edit refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// mensaje
			$this->mensaje->LinkCustomAttributes = "";
			$this->mensaje->HrefValue = "";

			// creadopor
			$this->creadopor->LinkCustomAttributes = "";
			$this->creadopor->HrefValue = "";

			// recibidopor
			$this->recibidopor->LinkCustomAttributes = "";
			$this->recibidopor->HrefValue = "";

			// leido
			$this->leido->LinkCustomAttributes = "";
			$this->leido->HrefValue = "";

			// desde
			$this->desde->LinkCustomAttributes = "";
			$this->desde->HrefValue = "";
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
		if (!$this->mensaje->FldIsDetailKey && !is_null($this->mensaje->FormValue) && $this->mensaje->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->mensaje->FldCaption(), $this->mensaje->ReqErrMsg));
		}
		if (!$this->creadopor->FldIsDetailKey && !is_null($this->creadopor->FormValue) && $this->creadopor->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->creadopor->FldCaption(), $this->creadopor->ReqErrMsg));
		}
		if (!$this->recibidopor->FldIsDetailKey && !is_null($this->recibidopor->FormValue) && $this->recibidopor->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->recibidopor->FldCaption(), $this->recibidopor->ReqErrMsg));
		}
		if (!ew_CheckInteger($this->leido->FormValue)) {
			ew_AddMessage($gsFormError, $this->leido->FldErrMsg());
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

			// mensaje
			$this->mensaje->SetDbValueDef($rsnew, $this->mensaje->CurrentValue, "", $this->mensaje->ReadOnly);

			// creadopor
			$this->creadopor->SetDbValueDef($rsnew, $this->creadopor->CurrentValue, "", $this->creadopor->ReadOnly);

			// recibidopor
			$this->recibidopor->SetDbValueDef($rsnew, $this->recibidopor->CurrentValue, "", $this->recibidopor->ReadOnly);

			// leido
			$this->leido->SetDbValueDef($rsnew, $this->leido->CurrentValue, 0, $this->leido->ReadOnly);

			// desde
			$this->desde->SetDbValueDef($rsnew, $this->desde->CurrentValue, NULL, $this->desde->ReadOnly);

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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("notificacioneslist.php"), "", $this->TableVar, TRUE);
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
if (!isset($notificaciones_edit)) $notificaciones_edit = new cnotificaciones_edit();

// Page init
$notificaciones_edit->Page_Init();

// Page main
$notificaciones_edit->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$notificaciones_edit->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "edit";
var CurrentForm = fnotificacionesedit = new ew_Form("fnotificacionesedit", "edit");

// Validate form
fnotificacionesedit.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_mensaje");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $notificaciones->mensaje->FldCaption(), $notificaciones->mensaje->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_creadopor");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $notificaciones->creadopor->FldCaption(), $notificaciones->creadopor->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_recibidopor");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $notificaciones->recibidopor->FldCaption(), $notificaciones->recibidopor->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_leido");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($notificaciones->leido->FldErrMsg()) ?>");

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
fnotificacionesedit.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fnotificacionesedit.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $notificaciones_edit->ShowPageHeader(); ?>
<?php
$notificaciones_edit->ShowMessage();
?>
<form name="fnotificacionesedit" id="fnotificacionesedit" class="<?php echo $notificaciones_edit->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($notificaciones_edit->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $notificaciones_edit->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="notificaciones">
<input type="hidden" name="a_edit" id="a_edit" value="U">
<input type="hidden" name="modal" value="<?php echo intval($notificaciones_edit->IsModal) ?>">
<?php if (!$notificaciones_edit->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($notificaciones_edit->IsMobileOrModal) { ?>
<div class="ewEditDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_notificacionesedit" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($notificaciones->id->Visible) { // id ?>
<?php if ($notificaciones_edit->IsMobileOrModal) { ?>
	<div id="r_id" class="form-group">
		<label id="elh_notificaciones_id" class="<?php echo $notificaciones_edit->LeftColumnClass ?>"><?php echo $notificaciones->id->FldCaption() ?></label>
		<div class="<?php echo $notificaciones_edit->RightColumnClass ?>"><div<?php echo $notificaciones->id->CellAttributes() ?>>
<span id="el_notificaciones_id">
<span<?php echo $notificaciones->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $notificaciones->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="notificaciones" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($notificaciones->id->CurrentValue) ?>">
<?php echo $notificaciones->id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id">
		<td class="col-sm-3"><span id="elh_notificaciones_id"><?php echo $notificaciones->id->FldCaption() ?></span></td>
		<td<?php echo $notificaciones->id->CellAttributes() ?>>
<span id="el_notificaciones_id">
<span<?php echo $notificaciones->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $notificaciones->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="notificaciones" data-field="x_id" name="x_id" id="x_id" value="<?php echo ew_HtmlEncode($notificaciones->id->CurrentValue) ?>">
<?php echo $notificaciones->id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($notificaciones->mensaje->Visible) { // mensaje ?>
<?php if ($notificaciones_edit->IsMobileOrModal) { ?>
	<div id="r_mensaje" class="form-group">
		<label id="elh_notificaciones_mensaje" for="x_mensaje" class="<?php echo $notificaciones_edit->LeftColumnClass ?>"><?php echo $notificaciones->mensaje->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $notificaciones_edit->RightColumnClass ?>"><div<?php echo $notificaciones->mensaje->CellAttributes() ?>>
<span id="el_notificaciones_mensaje">
<textarea data-table="notificaciones" data-field="x_mensaje" name="x_mensaje" id="x_mensaje" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($notificaciones->mensaje->getPlaceHolder()) ?>"<?php echo $notificaciones->mensaje->EditAttributes() ?>><?php echo $notificaciones->mensaje->EditValue ?></textarea>
</span>
<?php echo $notificaciones->mensaje->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_mensaje">
		<td class="col-sm-3"><span id="elh_notificaciones_mensaje"><?php echo $notificaciones->mensaje->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $notificaciones->mensaje->CellAttributes() ?>>
<span id="el_notificaciones_mensaje">
<textarea data-table="notificaciones" data-field="x_mensaje" name="x_mensaje" id="x_mensaje" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($notificaciones->mensaje->getPlaceHolder()) ?>"<?php echo $notificaciones->mensaje->EditAttributes() ?>><?php echo $notificaciones->mensaje->EditValue ?></textarea>
</span>
<?php echo $notificaciones->mensaje->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($notificaciones->creadopor->Visible) { // creadopor ?>
<?php if ($notificaciones_edit->IsMobileOrModal) { ?>
	<div id="r_creadopor" class="form-group">
		<label id="elh_notificaciones_creadopor" for="x_creadopor" class="<?php echo $notificaciones_edit->LeftColumnClass ?>"><?php echo $notificaciones->creadopor->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $notificaciones_edit->RightColumnClass ?>"><div<?php echo $notificaciones->creadopor->CellAttributes() ?>>
<span id="el_notificaciones_creadopor">
<textarea data-table="notificaciones" data-field="x_creadopor" name="x_creadopor" id="x_creadopor" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($notificaciones->creadopor->getPlaceHolder()) ?>"<?php echo $notificaciones->creadopor->EditAttributes() ?>><?php echo $notificaciones->creadopor->EditValue ?></textarea>
</span>
<?php echo $notificaciones->creadopor->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_creadopor">
		<td class="col-sm-3"><span id="elh_notificaciones_creadopor"><?php echo $notificaciones->creadopor->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $notificaciones->creadopor->CellAttributes() ?>>
<span id="el_notificaciones_creadopor">
<textarea data-table="notificaciones" data-field="x_creadopor" name="x_creadopor" id="x_creadopor" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($notificaciones->creadopor->getPlaceHolder()) ?>"<?php echo $notificaciones->creadopor->EditAttributes() ?>><?php echo $notificaciones->creadopor->EditValue ?></textarea>
</span>
<?php echo $notificaciones->creadopor->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($notificaciones->recibidopor->Visible) { // recibidopor ?>
<?php if ($notificaciones_edit->IsMobileOrModal) { ?>
	<div id="r_recibidopor" class="form-group">
		<label id="elh_notificaciones_recibidopor" for="x_recibidopor" class="<?php echo $notificaciones_edit->LeftColumnClass ?>"><?php echo $notificaciones->recibidopor->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></label>
		<div class="<?php echo $notificaciones_edit->RightColumnClass ?>"><div<?php echo $notificaciones->recibidopor->CellAttributes() ?>>
<span id="el_notificaciones_recibidopor">
<textarea data-table="notificaciones" data-field="x_recibidopor" name="x_recibidopor" id="x_recibidopor" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($notificaciones->recibidopor->getPlaceHolder()) ?>"<?php echo $notificaciones->recibidopor->EditAttributes() ?>><?php echo $notificaciones->recibidopor->EditValue ?></textarea>
</span>
<?php echo $notificaciones->recibidopor->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_recibidopor">
		<td class="col-sm-3"><span id="elh_notificaciones_recibidopor"><?php echo $notificaciones->recibidopor->FldCaption() ?><?php echo $Language->Phrase("FieldRequiredIndicator") ?></span></td>
		<td<?php echo $notificaciones->recibidopor->CellAttributes() ?>>
<span id="el_notificaciones_recibidopor">
<textarea data-table="notificaciones" data-field="x_recibidopor" name="x_recibidopor" id="x_recibidopor" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($notificaciones->recibidopor->getPlaceHolder()) ?>"<?php echo $notificaciones->recibidopor->EditAttributes() ?>><?php echo $notificaciones->recibidopor->EditValue ?></textarea>
</span>
<?php echo $notificaciones->recibidopor->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($notificaciones->leido->Visible) { // leido ?>
<?php if ($notificaciones_edit->IsMobileOrModal) { ?>
	<div id="r_leido" class="form-group">
		<label id="elh_notificaciones_leido" for="x_leido" class="<?php echo $notificaciones_edit->LeftColumnClass ?>"><?php echo $notificaciones->leido->FldCaption() ?></label>
		<div class="<?php echo $notificaciones_edit->RightColumnClass ?>"><div<?php echo $notificaciones->leido->CellAttributes() ?>>
<span id="el_notificaciones_leido">
<input type="text" data-table="notificaciones" data-field="x_leido" name="x_leido" id="x_leido" size="30" placeholder="<?php echo ew_HtmlEncode($notificaciones->leido->getPlaceHolder()) ?>" value="<?php echo $notificaciones->leido->EditValue ?>"<?php echo $notificaciones->leido->EditAttributes() ?>>
</span>
<?php echo $notificaciones->leido->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_leido">
		<td class="col-sm-3"><span id="elh_notificaciones_leido"><?php echo $notificaciones->leido->FldCaption() ?></span></td>
		<td<?php echo $notificaciones->leido->CellAttributes() ?>>
<span id="el_notificaciones_leido">
<input type="text" data-table="notificaciones" data-field="x_leido" name="x_leido" id="x_leido" size="30" placeholder="<?php echo ew_HtmlEncode($notificaciones->leido->getPlaceHolder()) ?>" value="<?php echo $notificaciones->leido->EditValue ?>"<?php echo $notificaciones->leido->EditAttributes() ?>>
</span>
<?php echo $notificaciones->leido->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($notificaciones->desde->Visible) { // desde ?>
<?php if ($notificaciones_edit->IsMobileOrModal) { ?>
	<div id="r_desde" class="form-group">
		<label id="elh_notificaciones_desde" for="x_desde" class="<?php echo $notificaciones_edit->LeftColumnClass ?>"><?php echo $notificaciones->desde->FldCaption() ?></label>
		<div class="<?php echo $notificaciones_edit->RightColumnClass ?>"><div<?php echo $notificaciones->desde->CellAttributes() ?>>
<span id="el_notificaciones_desde">
<input type="text" data-table="notificaciones" data-field="x_desde" name="x_desde" id="x_desde" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($notificaciones->desde->getPlaceHolder()) ?>" value="<?php echo $notificaciones->desde->EditValue ?>"<?php echo $notificaciones->desde->EditAttributes() ?>>
</span>
<?php echo $notificaciones->desde->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_desde">
		<td class="col-sm-3"><span id="elh_notificaciones_desde"><?php echo $notificaciones->desde->FldCaption() ?></span></td>
		<td<?php echo $notificaciones->desde->CellAttributes() ?>>
<span id="el_notificaciones_desde">
<input type="text" data-table="notificaciones" data-field="x_desde" name="x_desde" id="x_desde" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($notificaciones->desde->getPlaceHolder()) ?>" value="<?php echo $notificaciones->desde->EditValue ?>"<?php echo $notificaciones->desde->EditAttributes() ?>>
</span>
<?php echo $notificaciones->desde->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($notificaciones_edit->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$notificaciones_edit->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $notificaciones_edit->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("SaveBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $notificaciones_edit->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$notificaciones_edit->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fnotificacionesedit.Init();
</script>
<?php
$notificaciones_edit->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$notificaciones_edit->Page_Terminate();
?>
