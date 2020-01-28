<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "viewavaluoinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "viewsolicitudinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$viewavaluo_update = NULL; // Initialize page object first

class cviewavaluo_update extends cviewavaluo {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewavaluo';

	// Page object name
	var $PageObjName = 'viewavaluo_update';

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

		// Table object (viewavaluo)
		if (!isset($GLOBALS["viewavaluo"]) || get_class($GLOBALS["viewavaluo"]) == "cviewavaluo") {
			$GLOBALS["viewavaluo"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["viewavaluo"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Table object (viewsolicitud)
		if (!isset($GLOBALS['viewsolicitud'])) $GLOBALS['viewsolicitud'] = new cviewsolicitud();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'update', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'viewavaluo', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("viewavaluolist.php"));
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
		$this->codigoavaluo->SetVisibility();
		$this->id_solicitud->SetVisibility();
		$this->id_oficialcredito->SetVisibility();
		$this->id_inspector->SetVisibility();
		$this->id_cliente->SetVisibility();
		$this->estado->SetVisibility();
		$this->estadopago->SetVisibility();
		$this->fecha_avaluo->SetVisibility();

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
		global $EW_EXPORT, $viewavaluo;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($viewavaluo);
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
					if ($pageName == "viewavaluoview.php")
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
	var $FormClassName = "form-horizontal ewForm ewUpdateForm";
	var $IsModal = FALSE;
	var $IsMobileOrModal = FALSE;
	var $RecKeys;
	var $Disabled;
	var $Recordset;
	var $UpdateCount = 0;

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
		$this->FormClassName = "ewForm ewUpdateForm form-horizontal";

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Try to load keys from list form
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		if (@$_POST["a_update"] <> "") {

			// Get action
			$this->CurrentAction = $_POST["a_update"];
			$this->LoadFormValues(); // Get form values

			// Validate form
			if (!$this->ValidateForm()) {
				$this->CurrentAction = "I"; // Form error, reset action
				$this->setFailureMessage($gsFormError);
			}
		} else {
			$this->LoadMultiUpdateValues(); // Load initial values to form
		}
		if (count($this->RecKeys) <= 0)
			$this->Page_Terminate("viewavaluolist.php"); // No records selected, return to list
		switch ($this->CurrentAction) {
			case "U": // Update
				if ($this->UpdateRows()) { // Update Records based on key
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up update success message
					$this->Page_Terminate($this->getReturnUrl()); // Return to caller
				} else {
					$this->RestoreFormValues(); // Restore form values
				}
		}

		// Render row
		$this->RowType = EW_ROWTYPE_EDIT; // Render edit
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Load initial values to form if field values are identical in all selected records
	function LoadMultiUpdateValues() {
		$this->CurrentFilter = $this->GetKeyFilter();

		// Load recordset
		if ($this->Recordset = $this->LoadRecordset()) {
			$i = 1;
			while (!$this->Recordset->EOF) {
				if ($i == 1) {
					$this->tipoinmueble->setDbValue($this->Recordset->fields('tipoinmueble'));
					$this->codigoavaluo->setDbValue($this->Recordset->fields('codigoavaluo'));
					$this->id_solicitud->setDbValue($this->Recordset->fields('id_solicitud'));
					$this->id_oficialcredito->setDbValue($this->Recordset->fields('id_oficialcredito'));
					$this->id_inspector->setDbValue($this->Recordset->fields('id_inspector'));
					$this->id_cliente->setDbValue($this->Recordset->fields('id_cliente'));
					$this->estado->setDbValue($this->Recordset->fields('estado'));
					$this->estadopago->setDbValue($this->Recordset->fields('estadopago'));
					$this->fecha_avaluo->setDbValue($this->Recordset->fields('fecha_avaluo'));
				} else {
					if (!ew_CompareValue($this->tipoinmueble->DbValue, $this->Recordset->fields('tipoinmueble')))
						$this->tipoinmueble->CurrentValue = NULL;
					if (!ew_CompareValue($this->codigoavaluo->DbValue, $this->Recordset->fields('codigoavaluo')))
						$this->codigoavaluo->CurrentValue = NULL;
					if (!ew_CompareValue($this->id_solicitud->DbValue, $this->Recordset->fields('id_solicitud')))
						$this->id_solicitud->CurrentValue = NULL;
					if (!ew_CompareValue($this->id_oficialcredito->DbValue, $this->Recordset->fields('id_oficialcredito')))
						$this->id_oficialcredito->CurrentValue = NULL;
					if (!ew_CompareValue($this->id_inspector->DbValue, $this->Recordset->fields('id_inspector')))
						$this->id_inspector->CurrentValue = NULL;
					if (!ew_CompareValue($this->id_cliente->DbValue, $this->Recordset->fields('id_cliente')))
						$this->id_cliente->CurrentValue = NULL;
					if (!ew_CompareValue($this->estado->DbValue, $this->Recordset->fields('estado')))
						$this->estado->CurrentValue = NULL;
					if (!ew_CompareValue($this->estadopago->DbValue, $this->Recordset->fields('estadopago')))
						$this->estadopago->CurrentValue = NULL;
					if (!ew_CompareValue($this->fecha_avaluo->DbValue, $this->Recordset->fields('fecha_avaluo')))
						$this->fecha_avaluo->CurrentValue = NULL;
				}
				$i++;
				$this->Recordset->MoveNext();
			}
			$this->Recordset->Close();
		}
	}

	// Set up key value
	function SetupKeyValues($key) {
		$sKeyFld = $key;
		if (!is_numeric($sKeyFld))
			return FALSE;
		$this->id->CurrentValue = $sKeyFld;
		return TRUE;
	}

	// Update all selected rows
	function UpdateRows() {
		global $Language;
		$conn = &$this->Connection();
		$conn->BeginTrans();

		// Get old recordset
		$this->CurrentFilter = $this->GetKeyFilter();
		$sSql = $this->SQL();
		$rsold = $conn->Execute($sSql);

		// Update all rows
		$sKey = "";
		foreach ($this->RecKeys as $key) {
			if ($this->SetupKeyValues($key)) {
				$sThisKey = $key;
				$this->SendEmail = FALSE; // Do not send email on update success
				$this->UpdateCount += 1; // Update record count for records being updated
				$UpdateRows = $this->EditRow(); // Update this row
			} else {
				$UpdateRows = FALSE;
			}
			if (!$UpdateRows)
				break; // Update failed
			if ($sKey <> "") $sKey .= ", ";
			$sKey .= $sThisKey;
		}

		// Check if all rows updated
		if ($UpdateRows) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$rsnew = $conn->Execute($sSql);
		} else {
			$conn->RollbackTrans(); // Rollback transaction
		}
		return $UpdateRows;
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
		if (!$this->tipoinmueble->FldIsDetailKey) {
			$this->tipoinmueble->setFormValue($objForm->GetValue("x_tipoinmueble"));
		}
		$this->tipoinmueble->MultiUpdate = $objForm->GetValue("u_tipoinmueble");
		if (!$this->codigoavaluo->FldIsDetailKey) {
			$this->codigoavaluo->setFormValue($objForm->GetValue("x_codigoavaluo"));
		}
		$this->codigoavaluo->MultiUpdate = $objForm->GetValue("u_codigoavaluo");
		if (!$this->id_solicitud->FldIsDetailKey) {
			$this->id_solicitud->setFormValue($objForm->GetValue("x_id_solicitud"));
		}
		$this->id_solicitud->MultiUpdate = $objForm->GetValue("u_id_solicitud");
		if (!$this->id_oficialcredito->FldIsDetailKey) {
			$this->id_oficialcredito->setFormValue($objForm->GetValue("x_id_oficialcredito"));
		}
		$this->id_oficialcredito->MultiUpdate = $objForm->GetValue("u_id_oficialcredito");
		if (!$this->id_inspector->FldIsDetailKey) {
			$this->id_inspector->setFormValue($objForm->GetValue("x_id_inspector"));
		}
		$this->id_inspector->MultiUpdate = $objForm->GetValue("u_id_inspector");
		if (!$this->id_cliente->FldIsDetailKey) {
			$this->id_cliente->setFormValue($objForm->GetValue("x_id_cliente"));
		}
		$this->id_cliente->MultiUpdate = $objForm->GetValue("u_id_cliente");
		if (!$this->estado->FldIsDetailKey) {
			$this->estado->setFormValue($objForm->GetValue("x_estado"));
		}
		$this->estado->MultiUpdate = $objForm->GetValue("u_estado");
		if (!$this->estadopago->FldIsDetailKey) {
			$this->estadopago->setFormValue($objForm->GetValue("x_estadopago"));
		}
		$this->estadopago->MultiUpdate = $objForm->GetValue("u_estadopago");
		if (!$this->fecha_avaluo->FldIsDetailKey) {
			$this->fecha_avaluo->setFormValue($objForm->GetValue("x_fecha_avaluo"));
			$this->fecha_avaluo->CurrentValue = ew_UnFormatDateTime($this->fecha_avaluo->CurrentValue, 0);
		}
		$this->fecha_avaluo->MultiUpdate = $objForm->GetValue("u_fecha_avaluo");
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->tipoinmueble->CurrentValue = $this->tipoinmueble->FormValue;
		$this->codigoavaluo->CurrentValue = $this->codigoavaluo->FormValue;
		$this->id_solicitud->CurrentValue = $this->id_solicitud->FormValue;
		$this->id_oficialcredito->CurrentValue = $this->id_oficialcredito->FormValue;
		$this->id_inspector->CurrentValue = $this->id_inspector->FormValue;
		$this->id_cliente->CurrentValue = $this->id_cliente->FormValue;
		$this->estado->CurrentValue = $this->estado->FormValue;
		$this->estadopago->CurrentValue = $this->estadopago->FormValue;
		$this->fecha_avaluo->CurrentValue = $this->fecha_avaluo->FormValue;
		$this->fecha_avaluo->CurrentValue = ew_UnFormatDateTime($this->fecha_avaluo->CurrentValue, 0);
	}

	// Load recordset
	function LoadRecordset($offset = -1, $rowcnt = -1) {

		// Load List page SQL
		$sSql = $this->ListSQL();
		$conn = &$this->Connection();

		// Load recordset
		$dbtype = ew_GetConnectionType($this->DBID);
		if ($this->UseSelectLimit) {
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			if ($dbtype == "MSSQL") {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderBy())));
			} else {
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset);
			}
			$conn->raiseErrorFn = '';
		} else {
			$rs = ew_LoadRecordset($sSql, $conn);
		}

		// Call Recordset Selected event
		$this->Recordset_Selected($rs);
		return $rs;
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
		$this->id_inspector->setDbValue($row['id_inspector']);
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

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

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

		// codigoavaluo
		$this->codigoavaluo->ViewValue = $this->codigoavaluo->CurrentValue;
		$this->codigoavaluo->ViewCustomAttributes = "";

		// id_solicitud
		if (strval($this->id_solicitud->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, `email` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
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
		$this->id_oficialcredito->ViewCustomAttributes = "";

		// id_inspector
		$this->id_inspector->ViewCustomAttributes = "";

		// id_cliente
		$this->id_cliente->ViewValue = $this->id_cliente->CurrentValue;
		$this->id_cliente->ViewCustomAttributes = "";

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
		$this->fecha_avaluo->ViewValue = ew_FormatDateTime($this->fecha_avaluo->ViewValue, 0);
		$this->fecha_avaluo->ViewCustomAttributes = "";

			// tipoinmueble
			$this->tipoinmueble->LinkCustomAttributes = "";
			$this->tipoinmueble->HrefValue = "";
			$this->tipoinmueble->TooltipValue = "";

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

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";
			$this->estado->TooltipValue = "";

			// estadopago
			$this->estadopago->LinkCustomAttributes = "";
			$this->estadopago->HrefValue = "";
			$this->estadopago->TooltipValue = "";

			// fecha_avaluo
			$this->fecha_avaluo->LinkCustomAttributes = "";
			$this->fecha_avaluo->HrefValue = "";
			$this->fecha_avaluo->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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

			// codigoavaluo
			$this->codigoavaluo->EditAttrs["class"] = "form-control";
			$this->codigoavaluo->EditCustomAttributes = "";
			$this->codigoavaluo->EditValue = ew_HtmlEncode($this->codigoavaluo->CurrentValue);
			$this->codigoavaluo->PlaceHolder = ew_RemoveHtml($this->codigoavaluo->FldTitle());

			// id_solicitud
			$this->id_solicitud->EditAttrs["class"] = "form-control";
			$this->id_solicitud->EditCustomAttributes = "";
			if ($this->id_solicitud->getSessionValue() <> "") {
				$this->id_solicitud->CurrentValue = $this->id_solicitud->getSessionValue();
			if (strval($this->id_solicitud->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, `email` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
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
			if (trim(strval($this->id_solicitud->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, `email` AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `solicitud`";
			$sWhereWrk = "";
			$this->id_solicitud->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_solicitud, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_solicitud->EditValue = $arwrk;
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

			// id_inspector
			$this->id_inspector->EditAttrs["class"] = "form-control";
			$this->id_inspector->EditCustomAttributes = "";

			// id_cliente
			$this->id_cliente->EditAttrs["class"] = "form-control";
			$this->id_cliente->EditCustomAttributes = "";
			$this->id_cliente->EditValue = ew_HtmlEncode($this->id_cliente->CurrentValue);
			$this->id_cliente->PlaceHolder = ew_RemoveHtml($this->id_cliente->FldTitle());

			// estado
			$this->estado->EditCustomAttributes = "";
			if (trim(strval($this->estado->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->estado->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estado`";
			$sWhereWrk = "";
			$this->estado->LookupFilters = array("dx1" => '`descripcion`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->estado, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$this->estado->ViewValue = $this->estado->DisplayValue($arwrk);
			} else {
				$this->estado->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->estado->EditValue = $arwrk;

			// estadopago
			$this->estadopago->EditAttrs["class"] = "form-control";
			$this->estadopago->EditCustomAttributes = "";
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
					$this->estadopago->EditValue = $this->estadopago->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->estadopago->EditValue = $this->estadopago->CurrentValue;
				}
			} else {
				$this->estadopago->EditValue = NULL;
			}
			$this->estadopago->ViewCustomAttributes = "";

			// fecha_avaluo
			$this->fecha_avaluo->EditAttrs["class"] = "form-control";
			$this->fecha_avaluo->EditCustomAttributes = "";
			$this->fecha_avaluo->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_avaluo->CurrentValue, 8));
			$this->fecha_avaluo->PlaceHolder = ew_RemoveHtml($this->fecha_avaluo->FldTitle());

			// Edit refer script
			// tipoinmueble

			$this->tipoinmueble->LinkCustomAttributes = "";
			$this->tipoinmueble->HrefValue = "";

			// codigoavaluo
			$this->codigoavaluo->LinkCustomAttributes = "";
			$this->codigoavaluo->HrefValue = "";

			// id_solicitud
			$this->id_solicitud->LinkCustomAttributes = "";
			$this->id_solicitud->HrefValue = "";

			// id_oficialcredito
			$this->id_oficialcredito->LinkCustomAttributes = "";
			$this->id_oficialcredito->HrefValue = "";

			// id_inspector
			$this->id_inspector->LinkCustomAttributes = "";
			$this->id_inspector->HrefValue = "";

			// id_cliente
			$this->id_cliente->LinkCustomAttributes = "";
			$this->id_cliente->HrefValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";

			// estadopago
			$this->estadopago->LinkCustomAttributes = "";
			$this->estadopago->HrefValue = "";
			$this->estadopago->TooltipValue = "";

			// fecha_avaluo
			$this->fecha_avaluo->LinkCustomAttributes = "";
			$this->fecha_avaluo->HrefValue = "";
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
		$lUpdateCnt = 0;
		if ($this->tipoinmueble->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->codigoavaluo->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->id_solicitud->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->id_oficialcredito->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->id_inspector->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->id_cliente->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->estado->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->estadopago->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->fecha_avaluo->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->id_cliente->MultiUpdate <> "") {
			if (!ew_CheckInteger($this->id_cliente->FormValue)) {
				ew_AddMessage($gsFormError, $this->id_cliente->FldErrMsg());
			}
		}
		if ($this->fecha_avaluo->MultiUpdate <> "") {
			if (!ew_CheckDateDef($this->fecha_avaluo->FormValue)) {
				ew_AddMessage($gsFormError, $this->fecha_avaluo->FldErrMsg());
			}
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

			// tipoinmueble
			$this->tipoinmueble->SetDbValueDef($rsnew, $this->tipoinmueble->CurrentValue, NULL, $this->tipoinmueble->ReadOnly || $this->tipoinmueble->MultiUpdate <> "1");

			// codigoavaluo
			$this->codigoavaluo->SetDbValueDef($rsnew, $this->codigoavaluo->CurrentValue, NULL, $this->codigoavaluo->ReadOnly || $this->codigoavaluo->MultiUpdate <> "1");

			// id_solicitud
			$this->id_solicitud->SetDbValueDef($rsnew, $this->id_solicitud->CurrentValue, NULL, $this->id_solicitud->ReadOnly || $this->id_solicitud->MultiUpdate <> "1");

			// id_oficialcredito
			$this->id_oficialcredito->SetDbValueDef($rsnew, $this->id_oficialcredito->CurrentValue, NULL, $this->id_oficialcredito->ReadOnly || $this->id_oficialcredito->MultiUpdate <> "1");

			// id_inspector
			$this->id_inspector->SetDbValueDef($rsnew, $this->id_inspector->CurrentValue, NULL, $this->id_inspector->ReadOnly || $this->id_inspector->MultiUpdate <> "1");

			// id_cliente
			$this->id_cliente->SetDbValueDef($rsnew, $this->id_cliente->CurrentValue, NULL, $this->id_cliente->ReadOnly || $this->id_cliente->MultiUpdate <> "1");

			// estado
			$this->estado->SetDbValueDef($rsnew, $this->estado->CurrentValue, NULL, $this->estado->ReadOnly || $this->estado->MultiUpdate <> "1");

			// fecha_avaluo
			$this->fecha_avaluo->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_avaluo->CurrentValue, 0), NULL, $this->fecha_avaluo->ReadOnly || $this->fecha_avaluo->MultiUpdate <> "1");

			// Check referential integrity for master table 'viewsolicitud'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_viewsolicitud();
			$KeyValue = isset($rsnew['id_solicitud']) ? $rsnew['id_solicitud'] : $rsold['id_solicitud'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@id@", ew_AdjustSql($KeyValue), $sMasterFilter);
			} else {
				$bValidMasterRecord = FALSE;
			}
			if ($bValidMasterRecord) {
				if (!isset($GLOBALS["viewsolicitud"])) $GLOBALS["viewsolicitud"] = new cviewsolicitud();
				$rsmaster = $GLOBALS["viewsolicitud"]->LoadRs($sMasterFilter);
				$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
				$rsmaster->Close();
			}
			if (!$bValidMasterRecord) {
				$sRelatedRecordMsg = str_replace("%t", "viewsolicitud", $Language->Phrase("RelatedRecordRequired"));
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
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("viewavaluolist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
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
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, `email` AS `Disp3Fld`, '' AS `Disp4Fld` FROM `solicitud`";
			$sWhereWrk = "";
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
		case "x_estado":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`descripcion`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->estado, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($viewavaluo_update)) $viewavaluo_update = new cviewavaluo_update();

// Page init
$viewavaluo_update->Page_Init();

// Page main
$viewavaluo_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewavaluo_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fviewavaluoupdate = new ew_Form("fviewavaluoupdate", "update");

// Validate form
fviewavaluoupdate.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	if (!ew_UpdateSelected(fobj)) {
		ew_Alert(ewLanguage.Phrase("NoFieldSelected"));
		return false;
	}
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
			elm = this.GetElements("x" + infix + "_id_cliente");
			uelm = this.GetElements("u" + infix + "_id_cliente");
			if (uelm && uelm.checked && elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluo->id_cliente->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_avaluo");
			uelm = this.GetElements("u" + infix + "_fecha_avaluo");
			if (uelm && uelm.checked && elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluo->fecha_avaluo->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fviewavaluoupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluoupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluoupdate.Lists["x_tipoinmueble"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewavaluoupdate.Lists["x_tipoinmueble"].Data = "<?php echo $viewavaluo_update->tipoinmueble->LookupFilterQuery(FALSE, "update") ?>";
fviewavaluoupdate.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","x__email",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
fviewavaluoupdate.Lists["x_id_solicitud"].Data = "<?php echo $viewavaluo_update->id_solicitud->LookupFilterQuery(FALSE, "update") ?>";
fviewavaluoupdate.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fviewavaluoupdate.Lists["x_id_oficialcredito"].Data = "<?php echo $viewavaluo_update->id_oficialcredito->LookupFilterQuery(FALSE, "update") ?>";
fviewavaluoupdate.Lists["x_estado"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estado"};
fviewavaluoupdate.Lists["x_estado"].Data = "<?php echo $viewavaluo_update->estado->LookupFilterQuery(FALSE, "update") ?>";
fviewavaluoupdate.Lists["x_estadopago"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadopago"};
fviewavaluoupdate.Lists["x_estadopago"].Data = "<?php echo $viewavaluo_update->estadopago->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $viewavaluo_update->ShowPageHeader(); ?>
<?php
$viewavaluo_update->ShowMessage();
?>
<form name="fviewavaluoupdate" id="fviewavaluoupdate" class="<?php echo $viewavaluo_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewavaluo_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewavaluo_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewavaluo">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($viewavaluo_update->IsModal) ?>">
<?php foreach ($viewavaluo_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<?php if (!$viewavaluo_update->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($viewavaluo_update->IsMobileOrModal) { ?>
<div id="tbl_viewavaluoupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php } else { ?>
<table id="tbl_viewavaluoupdate" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- desktop table -->
	<thead>
	<tr>
		<th colspan="2"><div class="checkbox"><label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);" /> <?php echo $Language->Phrase("UpdateSelectAll") ?></label></div></th>
	</tr>
	</thead>
	<tbody>
<?php } ?>
<?php if ($viewavaluo->tipoinmueble->Visible) { // tipoinmueble ?>
<?php if ($viewavaluo_update->IsMobileOrModal) { ?>
	<div id="r_tipoinmueble" class="form-group">
		<label for="x_tipoinmueble" class="<?php echo $viewavaluo_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_tipoinmueble" id="u_tipoinmueble" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->tipoinmueble->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->tipoinmueble->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluo_update->RightColumnClass ?>"><div<?php echo $viewavaluo->tipoinmueble->CellAttributes() ?>>
<span id="el_viewavaluo_tipoinmueble">
<select data-table="viewavaluo" data-field="x_tipoinmueble" data-value-separator="<?php echo $viewavaluo->tipoinmueble->DisplayValueSeparatorAttribute() ?>" id="x_tipoinmueble" name="x_tipoinmueble"<?php echo $viewavaluo->tipoinmueble->EditAttributes() ?>>
<?php echo $viewavaluo->tipoinmueble->SelectOptionListHtml("x_tipoinmueble") ?>
</select>
</span>
<?php echo $viewavaluo->tipoinmueble->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_tipoinmueble">
		<td class="col-sm-3"<?php echo $viewavaluo->tipoinmueble->CellAttributes() ?>><span id="elh_viewavaluo_tipoinmueble"><div class="checkbox"><label for="u_tipoinmueble">
<input type="checkbox" name="u_tipoinmueble" id="u_tipoinmueble" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->tipoinmueble->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->tipoinmueble->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluo->tipoinmueble->CellAttributes() ?>>
<span id="el_viewavaluo_tipoinmueble">
<select data-table="viewavaluo" data-field="x_tipoinmueble" data-value-separator="<?php echo $viewavaluo->tipoinmueble->DisplayValueSeparatorAttribute() ?>" id="x_tipoinmueble" name="x_tipoinmueble"<?php echo $viewavaluo->tipoinmueble->EditAttributes() ?>>
<?php echo $viewavaluo->tipoinmueble->SelectOptionListHtml("x_tipoinmueble") ?>
</select>
</span>
<?php echo $viewavaluo->tipoinmueble->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluo->codigoavaluo->Visible) { // codigoavaluo ?>
<?php if ($viewavaluo_update->IsMobileOrModal) { ?>
	<div id="r_codigoavaluo" class="form-group">
		<label for="x_codigoavaluo" class="<?php echo $viewavaluo_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_codigoavaluo" id="u_codigoavaluo" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->codigoavaluo->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->codigoavaluo->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluo_update->RightColumnClass ?>"><div<?php echo $viewavaluo->codigoavaluo->CellAttributes() ?>>
<span id="el_viewavaluo_codigoavaluo">
<input type="text" data-table="viewavaluo" data-field="x_codigoavaluo" name="x_codigoavaluo" id="x_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewavaluo->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->codigoavaluo->EditValue ?>"<?php echo $viewavaluo->codigoavaluo->EditAttributes() ?>>
</span>
<?php echo $viewavaluo->codigoavaluo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_codigoavaluo">
		<td class="col-sm-3"<?php echo $viewavaluo->codigoavaluo->CellAttributes() ?>><span id="elh_viewavaluo_codigoavaluo"><div class="checkbox"><label for="u_codigoavaluo">
<input type="checkbox" name="u_codigoavaluo" id="u_codigoavaluo" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->codigoavaluo->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->codigoavaluo->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluo->codigoavaluo->CellAttributes() ?>>
<span id="el_viewavaluo_codigoavaluo">
<input type="text" data-table="viewavaluo" data-field="x_codigoavaluo" name="x_codigoavaluo" id="x_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewavaluo->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->codigoavaluo->EditValue ?>"<?php echo $viewavaluo->codigoavaluo->EditAttributes() ?>>
</span>
<?php echo $viewavaluo->codigoavaluo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluo->id_solicitud->Visible) { // id_solicitud ?>
<?php if ($viewavaluo_update->IsMobileOrModal) { ?>
	<div id="r_id_solicitud" class="form-group">
		<label for="x_id_solicitud" class="<?php echo $viewavaluo_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_id_solicitud" id="u_id_solicitud" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->id_solicitud->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->id_solicitud->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluo_update->RightColumnClass ?>"><div<?php echo $viewavaluo->id_solicitud->CellAttributes() ?>>
<?php if ($viewavaluo->id_solicitud->getSessionValue() <> "") { ?>
<span id="el_viewavaluo_id_solicitud">
<span<?php echo $viewavaluo->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_id_solicitud" name="x_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluo->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el_viewavaluo_id_solicitud">
<select data-table="viewavaluo" data-field="x_id_solicitud" data-value-separator="<?php echo $viewavaluo->id_solicitud->DisplayValueSeparatorAttribute() ?>" id="x_id_solicitud" name="x_id_solicitud"<?php echo $viewavaluo->id_solicitud->EditAttributes() ?>>
<?php echo $viewavaluo->id_solicitud->SelectOptionListHtml("x_id_solicitud") ?>
</select>
</span>
<?php } ?>
<?php echo $viewavaluo->id_solicitud->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_solicitud">
		<td class="col-sm-3"<?php echo $viewavaluo->id_solicitud->CellAttributes() ?>><span id="elh_viewavaluo_id_solicitud"><div class="checkbox"><label for="u_id_solicitud">
<input type="checkbox" name="u_id_solicitud" id="u_id_solicitud" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->id_solicitud->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->id_solicitud->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluo->id_solicitud->CellAttributes() ?>>
<?php if ($viewavaluo->id_solicitud->getSessionValue() <> "") { ?>
<span id="el_viewavaluo_id_solicitud">
<span<?php echo $viewavaluo->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_id_solicitud" name="x_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluo->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el_viewavaluo_id_solicitud">
<select data-table="viewavaluo" data-field="x_id_solicitud" data-value-separator="<?php echo $viewavaluo->id_solicitud->DisplayValueSeparatorAttribute() ?>" id="x_id_solicitud" name="x_id_solicitud"<?php echo $viewavaluo->id_solicitud->EditAttributes() ?>>
<?php echo $viewavaluo->id_solicitud->SelectOptionListHtml("x_id_solicitud") ?>
</select>
</span>
<?php } ?>
<?php echo $viewavaluo->id_solicitud->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluo->id_oficialcredito->Visible) { // id_oficialcredito ?>
<?php if ($viewavaluo_update->IsMobileOrModal) { ?>
	<div id="r_id_oficialcredito" class="form-group">
		<label for="x_id_oficialcredito" class="<?php echo $viewavaluo_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_id_oficialcredito" id="u_id_oficialcredito" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->id_oficialcredito->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->id_oficialcredito->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluo_update->RightColumnClass ?>"><div<?php echo $viewavaluo->id_oficialcredito->CellAttributes() ?>>
<span id="el_viewavaluo_id_oficialcredito">
<select data-table="viewavaluo" data-field="x_id_oficialcredito" data-value-separator="<?php echo $viewavaluo->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" id="x_id_oficialcredito" name="x_id_oficialcredito"<?php echo $viewavaluo->id_oficialcredito->EditAttributes() ?>>
<?php echo $viewavaluo->id_oficialcredito->SelectOptionListHtml("x_id_oficialcredito") ?>
</select>
</span>
<?php echo $viewavaluo->id_oficialcredito->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_oficialcredito">
		<td class="col-sm-3"<?php echo $viewavaluo->id_oficialcredito->CellAttributes() ?>><span id="elh_viewavaluo_id_oficialcredito"><div class="checkbox"><label for="u_id_oficialcredito">
<input type="checkbox" name="u_id_oficialcredito" id="u_id_oficialcredito" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->id_oficialcredito->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->id_oficialcredito->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluo->id_oficialcredito->CellAttributes() ?>>
<span id="el_viewavaluo_id_oficialcredito">
<select data-table="viewavaluo" data-field="x_id_oficialcredito" data-value-separator="<?php echo $viewavaluo->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" id="x_id_oficialcredito" name="x_id_oficialcredito"<?php echo $viewavaluo->id_oficialcredito->EditAttributes() ?>>
<?php echo $viewavaluo->id_oficialcredito->SelectOptionListHtml("x_id_oficialcredito") ?>
</select>
</span>
<?php echo $viewavaluo->id_oficialcredito->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluo->id_inspector->Visible) { // id_inspector ?>
<?php if ($viewavaluo_update->IsMobileOrModal) { ?>
	<div id="r_id_inspector" class="form-group">
		<label for="x_id_inspector" class="<?php echo $viewavaluo_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_id_inspector" id="u_id_inspector" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->id_inspector->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->id_inspector->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluo_update->RightColumnClass ?>"><div<?php echo $viewavaluo->id_inspector->CellAttributes() ?>>
<span id="el_viewavaluo_id_inspector">
<select data-table="viewavaluo" data-field="x_id_inspector" data-value-separator="<?php echo $viewavaluo->id_inspector->DisplayValueSeparatorAttribute() ?>" id="x_id_inspector" name="x_id_inspector"<?php echo $viewavaluo->id_inspector->EditAttributes() ?>>
<?php echo $viewavaluo->id_inspector->SelectOptionListHtml("x_id_inspector") ?>
</select>
</span>
<?php echo $viewavaluo->id_inspector->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_inspector">
		<td class="col-sm-3"<?php echo $viewavaluo->id_inspector->CellAttributes() ?>><span id="elh_viewavaluo_id_inspector"><div class="checkbox"><label for="u_id_inspector">
<input type="checkbox" name="u_id_inspector" id="u_id_inspector" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->id_inspector->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->id_inspector->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluo->id_inspector->CellAttributes() ?>>
<span id="el_viewavaluo_id_inspector">
<select data-table="viewavaluo" data-field="x_id_inspector" data-value-separator="<?php echo $viewavaluo->id_inspector->DisplayValueSeparatorAttribute() ?>" id="x_id_inspector" name="x_id_inspector"<?php echo $viewavaluo->id_inspector->EditAttributes() ?>>
<?php echo $viewavaluo->id_inspector->SelectOptionListHtml("x_id_inspector") ?>
</select>
</span>
<?php echo $viewavaluo->id_inspector->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluo->id_cliente->Visible) { // id_cliente ?>
<?php if ($viewavaluo_update->IsMobileOrModal) { ?>
	<div id="r_id_cliente" class="form-group">
		<label for="x_id_cliente" class="<?php echo $viewavaluo_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_id_cliente" id="u_id_cliente" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->id_cliente->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->id_cliente->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluo_update->RightColumnClass ?>"><div<?php echo $viewavaluo->id_cliente->CellAttributes() ?>>
<span id="el_viewavaluo_id_cliente">
<input type="text" data-table="viewavaluo" data-field="x_id_cliente" name="x_id_cliente" id="x_id_cliente" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluo->id_cliente->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->id_cliente->EditValue ?>"<?php echo $viewavaluo->id_cliente->EditAttributes() ?>>
</span>
<?php echo $viewavaluo->id_cliente->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_cliente">
		<td class="col-sm-3"<?php echo $viewavaluo->id_cliente->CellAttributes() ?>><span id="elh_viewavaluo_id_cliente"><div class="checkbox"><label for="u_id_cliente">
<input type="checkbox" name="u_id_cliente" id="u_id_cliente" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->id_cliente->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->id_cliente->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluo->id_cliente->CellAttributes() ?>>
<span id="el_viewavaluo_id_cliente">
<input type="text" data-table="viewavaluo" data-field="x_id_cliente" name="x_id_cliente" id="x_id_cliente" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluo->id_cliente->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->id_cliente->EditValue ?>"<?php echo $viewavaluo->id_cliente->EditAttributes() ?>>
</span>
<?php echo $viewavaluo->id_cliente->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluo->estado->Visible) { // estado ?>
<?php if ($viewavaluo_update->IsMobileOrModal) { ?>
	<div id="r_estado" class="form-group">
		<label for="x_estado" class="<?php echo $viewavaluo_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_estado" id="u_estado" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->estado->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->estado->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluo_update->RightColumnClass ?>"><div<?php echo $viewavaluo->estado->CellAttributes() ?>>
<span id="el_viewavaluo_estado">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_estado"><?php echo (strval($viewavaluo->estado->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluo->estado->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluo->estado->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_estado',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluo->estado->ReadOnly || $viewavaluo->estado->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluo" data-field="x_estado" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluo->estado->DisplayValueSeparatorAttribute() ?>" name="x_estado" id="x_estado" value="<?php echo $viewavaluo->estado->CurrentValue ?>"<?php echo $viewavaluo->estado->EditAttributes() ?>>
</span>
<?php echo $viewavaluo->estado->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_estado">
		<td class="col-sm-3"<?php echo $viewavaluo->estado->CellAttributes() ?>><span id="elh_viewavaluo_estado"><div class="checkbox"><label for="u_estado">
<input type="checkbox" name="u_estado" id="u_estado" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->estado->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->estado->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluo->estado->CellAttributes() ?>>
<span id="el_viewavaluo_estado">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_estado"><?php echo (strval($viewavaluo->estado->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewavaluo->estado->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluo->estado->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_estado',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluo->estado->ReadOnly || $viewavaluo->estado->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewavaluo" data-field="x_estado" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluo->estado->DisplayValueSeparatorAttribute() ?>" name="x_estado" id="x_estado" value="<?php echo $viewavaluo->estado->CurrentValue ?>"<?php echo $viewavaluo->estado->EditAttributes() ?>>
</span>
<?php echo $viewavaluo->estado->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluo->fecha_avaluo->Visible) { // fecha_avaluo ?>
<?php if ($viewavaluo_update->IsMobileOrModal) { ?>
	<div id="r_fecha_avaluo" class="form-group">
		<label for="x_fecha_avaluo" class="<?php echo $viewavaluo_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_fecha_avaluo" id="u_fecha_avaluo" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->fecha_avaluo->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->fecha_avaluo->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluo_update->RightColumnClass ?>"><div<?php echo $viewavaluo->fecha_avaluo->CellAttributes() ?>>
<span id="el_viewavaluo_fecha_avaluo">
<input type="text" data-table="viewavaluo" data-field="x_fecha_avaluo" name="x_fecha_avaluo" id="x_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($viewavaluo->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->fecha_avaluo->EditValue ?>"<?php echo $viewavaluo->fecha_avaluo->EditAttributes() ?>>
</span>
<?php echo $viewavaluo->fecha_avaluo->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_fecha_avaluo">
		<td class="col-sm-3"<?php echo $viewavaluo->fecha_avaluo->CellAttributes() ?>><span id="elh_viewavaluo_fecha_avaluo"><div class="checkbox"><label for="u_fecha_avaluo">
<input type="checkbox" name="u_fecha_avaluo" id="u_fecha_avaluo" class="ewMultiSelect" value="1"<?php echo ($viewavaluo->fecha_avaluo->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluo->fecha_avaluo->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluo->fecha_avaluo->CellAttributes() ?>>
<span id="el_viewavaluo_fecha_avaluo">
<input type="text" data-table="viewavaluo" data-field="x_fecha_avaluo" name="x_fecha_avaluo" id="x_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($viewavaluo->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->fecha_avaluo->EditValue ?>"<?php echo $viewavaluo->fecha_avaluo->EditAttributes() ?>>
</span>
<?php echo $viewavaluo->fecha_avaluo->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluo_update->IsMobileOrModal) { ?>
	</div><!-- /page -->
<?php } else { ?>
	</tbody>
</table><!-- /desktop table -->
<?php } ?>
<?php if (!$viewavaluo_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $viewavaluo_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $viewavaluo_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$viewavaluo_update->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fviewavaluoupdate.Init();
</script>
<?php
$viewavaluo_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$viewavaluo_update->Page_Terminate();
?>