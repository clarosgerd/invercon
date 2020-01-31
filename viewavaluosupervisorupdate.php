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

$viewavaluosupervisor_update = NULL; // Initialize page object first

class cviewavaluosupervisor_update extends cviewavaluosupervisor {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewavaluosupervisor';

	// Page object name
	var $PageObjName = 'viewavaluosupervisor_update';

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
			define("EW_PAGE_ID", 'update', TRUE);

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
		$this->estadointerno->SetVisibility();
		$this->informe->SetVisibility();
		$this->monto_pago->SetVisibility();
		$this->montoincial->SetVisibility();
		$this->comentario->SetVisibility();

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

		// Page Unload event
		$this->Page_Unload();

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
		global $EW_EXPORT, $viewavaluosupervisor;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
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
			$this->Page_Terminate("viewavaluosupervisorlist.php"); // No records selected, return to list
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
					$this->estadointerno->setDbValue($this->Recordset->fields('estadointerno'));
					$this->monto_pago->setDbValue($this->Recordset->fields('monto_pago'));
					$this->montoincial->setDbValue($this->Recordset->fields('montoincial'));
					$this->comentario->setDbValue($this->Recordset->fields('comentario'));
				} else {
					if (!ew_CompareValue($this->estadointerno->DbValue, $this->Recordset->fields('estadointerno')))
						$this->estadointerno->CurrentValue = NULL;
					if (!ew_CompareValue($this->monto_pago->DbValue, $this->Recordset->fields('monto_pago')))
						$this->monto_pago->CurrentValue = NULL;
					if (!ew_CompareValue($this->montoincial->DbValue, $this->Recordset->fields('montoincial')))
						$this->montoincial->CurrentValue = NULL;
					if (!ew_CompareValue($this->comentario->DbValue, $this->Recordset->fields('comentario')))
						$this->comentario->CurrentValue = NULL;
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
			$sTable = 'viewavaluosupervisor';
			$sSubject = $sTable . " " . $Language->Phrase("RecordUpdated");
			$sAction = $Language->Phrase("ActionUpdatedMultiUpdate");
			$Email = new cEmail();
			$Email->Load(EW_EMAIL_NOTIFY_TEMPLATE);
			$Email->ReplaceSender(EW_SENDER_EMAIL); // Replace Sender
			$Email->ReplaceRecipient(EW_RECIPIENT_EMAIL); // Replace Recipient
			$Email->ReplaceSubject($sSubject); // Replace Subject
			$Email->ReplaceContent('<!--table-->', $sTable);
			$Email->ReplaceContent('<!--key-->', $sKey);
			$Email->ReplaceContent('<!--action-->', $sAction);
			$Args = array();
			$Args["rsold"] = $rsold->GetRows();
			$Args["rsnew"] = $rsnew->GetRows();
			$bEmailSent = FALSE;
			if ($this->Email_Sending($Email, $Args))
				$bEmailSent = $Email->Send();

			// Send email failed
			if (!$bEmailSent)
				$this->setFailureMessage($Email->SendErrDescription);
		} else {
			$conn->RollbackTrans(); // Rollback transaction
		}
		return $UpdateRows;
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
		$this->informe->Upload->Index = $objForm->Index;
		$this->informe->Upload->UploadFile();
		$this->informe->MultiUpdate = $objForm->GetValue("u_informe");
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->estadointerno->FldIsDetailKey) {
			$this->estadointerno->setFormValue($objForm->GetValue("x_estadointerno"));
		}
		$this->estadointerno->MultiUpdate = $objForm->GetValue("u_estadointerno");
		if (!$this->monto_pago->FldIsDetailKey) {
			$this->monto_pago->setFormValue($objForm->GetValue("x_monto_pago"));
		}
		$this->monto_pago->MultiUpdate = $objForm->GetValue("u_monto_pago");
		if (!$this->montoincial->FldIsDetailKey) {
			$this->montoincial->setFormValue($objForm->GetValue("x_montoincial"));
		}
		$this->montoincial->MultiUpdate = $objForm->GetValue("u_montoincial");
		if (!$this->comentario->FldIsDetailKey) {
			$this->comentario->setFormValue($objForm->GetValue("x_comentario"));
		}
		$this->comentario->MultiUpdate = $objForm->GetValue("u_comentario");
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->estadointerno->CurrentValue = $this->estadointerno->FormValue;
		$this->monto_pago->CurrentValue = $this->monto_pago->FormValue;
		$this->montoincial->CurrentValue = $this->montoincial->FormValue;
		$this->comentario->CurrentValue = $this->comentario->FormValue;
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
				$rs = $conn->SelectLimit($sSql, $rowcnt, $offset, array("_hasOrderBy" => trim($this->getOrderBy()) || trim($this->getSessionOrderByList())));
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

		// codigoavaluo
		$this->codigoavaluo->ViewValue = $this->codigoavaluo->CurrentValue;
		$this->codigoavaluo->ViewCustomAttributes = "";

		// id_solicitud
		$this->id_solicitud->ViewValue = $this->id_solicitud->CurrentValue;
		if (strval($this->id_solicitud->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
		$sWhereWrk = "";
		$this->id_solicitud->LookupFilters = array("dx1" => '`id`', "dx2" => '`name`', "dx3" => '`lastname`', "dx4" => '`email`');
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
		$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
		$sWhereWrk = "";
		$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
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
		$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
		$sWhereWrk = "";
		$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
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
		$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
		$sWhereWrk = "";
		$this->estado->LookupFilters = array();
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
		$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, `owner` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
		$sWhereWrk = "";
		$this->estadointerno->LookupFilters = array();
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
		$this->fecha_avaluo->ViewValue = ew_FormatDateTime($this->fecha_avaluo->ViewValue, 10);
		$this->fecha_avaluo->ViewCustomAttributes = "";

		// id_sucursal
		if (strval($this->id_sucursal->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_sucursal->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
		$sWhereWrk = "";
		$this->id_sucursal->LookupFilters = array();
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

			// estadointerno
			$this->estadointerno->LinkCustomAttributes = "";
			$this->estadointerno->HrefValue = "";
			$this->estadointerno->TooltipValue = "";

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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// estadointerno
			$this->estadointerno->EditAttrs["class"] = "form-control";
			$this->estadointerno->EditCustomAttributes = "";
			if (trim(strval($this->estadointerno->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->estadointerno->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, `owner` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadointerno`";
			$sWhereWrk = "";
			$this->estadointerno->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->estadointerno, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->estadointerno->EditValue = $arwrk;

			// informe
			$this->informe->EditAttrs["class"] = "form-control";
			$this->informe->EditCustomAttributes = "";
			if (!ew_Empty($this->informe->Upload->DbValue)) {
				$this->informe->EditValue = "viewavaluosupervisor_informe_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->informe->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->informe->Upload->DbValue, 0, 11)));
			} else {
				$this->informe->EditValue = "";
			}

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

			// Edit refer script
			// estadointerno

			$this->estadointerno->LinkCustomAttributes = "";
			$this->estadointerno->HrefValue = "";

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
		if ($this->estadointerno->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->informe->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->monto_pago->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->montoincial->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->comentario->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->monto_pago->MultiUpdate <> "") {
			if (!ew_CheckNumber($this->monto_pago->FormValue)) {
				ew_AddMessage($gsFormError, $this->monto_pago->FldErrMsg());
			}
		}
		if ($this->montoincial->MultiUpdate <> "") {
			if (!ew_CheckNumber($this->montoincial->FormValue)) {
				ew_AddMessage($gsFormError, $this->montoincial->FldErrMsg());
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

			// estadointerno
			$this->estadointerno->SetDbValueDef($rsnew, $this->estadointerno->CurrentValue, NULL, $this->estadointerno->ReadOnly || $this->estadointerno->MultiUpdate <> "1");

			// informe
			if ($this->informe->Visible && !$this->informe->ReadOnly && strval($this->informe->MultiUpdate) == "1" && !$this->informe->Upload->KeepFile) {
				if (is_null($this->informe->Upload->Value)) {
					$rsnew['informe'] = NULL;
				} else {
					$rsnew['informe'] = $this->informe->Upload->Value;
				}
			}

			// monto_pago
			$this->monto_pago->SetDbValueDef($rsnew, $this->monto_pago->CurrentValue, NULL, $this->monto_pago->ReadOnly || $this->monto_pago->MultiUpdate <> "1");

			// montoincial
			$this->montoincial->SetDbValueDef($rsnew, $this->montoincial->CurrentValue, NULL, $this->montoincial->ReadOnly || $this->montoincial->MultiUpdate <> "1");

			// comentario
			$this->comentario->SetDbValueDef($rsnew, $this->comentario->CurrentValue, NULL, $this->comentario->ReadOnly || $this->comentario->MultiUpdate <> "1");

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
		if ($EditRow) {
			if ($this->SendEmail)
				$this->SendEmailOnEdit($rsold, $rsnew);
		}
		$rs->Close();

		// informe
		ew_CleanUploadTempPath($this->informe, $this->informe->Upload->Index);
		return $EditRow;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("viewavaluosupervisorlist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_estadointerno":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, `owner` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
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
if (!isset($viewavaluosupervisor_update)) $viewavaluosupervisor_update = new cviewavaluosupervisor_update();

// Page init
$viewavaluosupervisor_update->Page_Init();

// Page main
$viewavaluosupervisor_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewavaluosupervisor_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fviewavaluosupervisorupdate = new ew_Form("fviewavaluosupervisorupdate", "update");

// Validate form
fviewavaluosupervisorupdate.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_monto_pago");
			uelm = this.GetElements("u" + infix + "_monto_pago");
			if (uelm && uelm.checked && elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosupervisor->monto_pago->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_montoincial");
			uelm = this.GetElements("u" + infix + "_montoincial");
			if (uelm && uelm.checked && elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosupervisor->montoincial->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fviewavaluosupervisorupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluosupervisorupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluosupervisorupdate.Lists["x_estadointerno"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","x_owner","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadointerno"};
fviewavaluosupervisorupdate.Lists["x_estadointerno"].Data = "<?php echo $viewavaluosupervisor_update->estadointerno->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $viewavaluosupervisor_update->ShowPageHeader(); ?>
<?php
$viewavaluosupervisor_update->ShowMessage();
?>
<form name="fviewavaluosupervisorupdate" id="fviewavaluosupervisorupdate" class="<?php echo $viewavaluosupervisor_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewavaluosupervisor_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewavaluosupervisor_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewavaluosupervisor">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($viewavaluosupervisor_update->IsModal) ?>">
<?php foreach ($viewavaluosupervisor_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<?php if (!$viewavaluosupervisor_update->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($viewavaluosupervisor_update->IsMobileOrModal) { ?>
<div id="tbl_viewavaluosupervisorupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php } else { ?>
<table id="tbl_viewavaluosupervisorupdate" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- desktop table -->
	<thead>
	<tr>
		<th colspan="2"><div class="checkbox"><label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);" /> <?php echo $Language->Phrase("UpdateSelectAll") ?></label></div></th>
	</tr>
	</thead>
	<tbody>
<?php } ?>
<?php if ($viewavaluosupervisor->estadointerno->Visible) { // estadointerno ?>
<?php if ($viewavaluosupervisor_update->IsMobileOrModal) { ?>
	<div id="r_estadointerno" class="form-group">
		<label for="x_estadointerno" class="<?php echo $viewavaluosupervisor_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_estadointerno" id="u_estadointerno" class="ewMultiSelect" value="1"<?php echo ($viewavaluosupervisor->estadointerno->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluosupervisor->estadointerno->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluosupervisor_update->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->estadointerno->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_estadointerno">
<select data-table="viewavaluosupervisor" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluosupervisor->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x_estadointerno" name="x_estadointerno"<?php echo $viewavaluosupervisor->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estadointerno->SelectOptionListHtml("x_estadointerno") ?>
</select>
</span>
<?php echo $viewavaluosupervisor->estadointerno->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_estadointerno">
		<td class="col-sm-3"<?php echo $viewavaluosupervisor->estadointerno->CellAttributes() ?>><span id="elh_viewavaluosupervisor_estadointerno"><div class="checkbox"><label for="u_estadointerno">
<input type="checkbox" name="u_estadointerno" id="u_estadointerno" class="ewMultiSelect" value="1"<?php echo ($viewavaluosupervisor->estadointerno->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluosupervisor->estadointerno->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluosupervisor->estadointerno->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_estadointerno">
<select data-table="viewavaluosupervisor" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluosupervisor->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x_estadointerno" name="x_estadointerno"<?php echo $viewavaluosupervisor->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluosupervisor->estadointerno->SelectOptionListHtml("x_estadointerno") ?>
</select>
</span>
<?php echo $viewavaluosupervisor->estadointerno->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->informe->Visible) { // informe ?>
<?php if ($viewavaluosupervisor_update->IsMobileOrModal) { ?>
	<div id="r_informe" class="form-group">
		<label class="<?php echo $viewavaluosupervisor_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_informe" id="u_informe" class="ewMultiSelect" value="1"<?php echo ($viewavaluosupervisor->informe->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluosupervisor->informe->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluosupervisor_update->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->informe->CellAttributes() ?>>
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
<?php echo $viewavaluosupervisor->informe->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_informe">
		<td class="col-sm-3"<?php echo $viewavaluosupervisor->informe->CellAttributes() ?>><span id="elh_viewavaluosupervisor_informe"><div class="checkbox"><label for="u_informe">
<input type="checkbox" name="u_informe" id="u_informe" class="ewMultiSelect" value="1"<?php echo ($viewavaluosupervisor->informe->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluosupervisor->informe->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluosupervisor->informe->CellAttributes() ?>>
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
<?php echo $viewavaluosupervisor->informe->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->monto_pago->Visible) { // monto_pago ?>
<?php if ($viewavaluosupervisor_update->IsMobileOrModal) { ?>
	<div id="r_monto_pago" class="form-group">
		<label for="x_monto_pago" class="<?php echo $viewavaluosupervisor_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_monto_pago" id="u_monto_pago" class="ewMultiSelect" value="1"<?php echo ($viewavaluosupervisor->monto_pago->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluosupervisor->monto_pago->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluosupervisor_update->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->monto_pago->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_monto_pago">
<input type="text" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="x_monto_pago" id="x_monto_pago" size="10" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->monto_pago->EditValue ?>"<?php echo $viewavaluosupervisor->monto_pago->EditAttributes() ?>>
</span>
<?php echo $viewavaluosupervisor->monto_pago->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_monto_pago">
		<td class="col-sm-3"<?php echo $viewavaluosupervisor->monto_pago->CellAttributes() ?>><span id="elh_viewavaluosupervisor_monto_pago"><div class="checkbox"><label for="u_monto_pago">
<input type="checkbox" name="u_monto_pago" id="u_monto_pago" class="ewMultiSelect" value="1"<?php echo ($viewavaluosupervisor->monto_pago->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluosupervisor->monto_pago->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluosupervisor->monto_pago->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_monto_pago">
<input type="text" data-table="viewavaluosupervisor" data-field="x_monto_pago" name="x_monto_pago" id="x_monto_pago" size="10" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->monto_pago->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->monto_pago->EditValue ?>"<?php echo $viewavaluosupervisor->monto_pago->EditAttributes() ?>>
</span>
<?php echo $viewavaluosupervisor->monto_pago->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->montoincial->Visible) { // montoincial ?>
<?php if ($viewavaluosupervisor_update->IsMobileOrModal) { ?>
	<div id="r_montoincial" class="form-group">
		<label for="x_montoincial" class="<?php echo $viewavaluosupervisor_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_montoincial" id="u_montoincial" class="ewMultiSelect" value="1"<?php echo ($viewavaluosupervisor->montoincial->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluosupervisor->montoincial->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluosupervisor_update->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->montoincial->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_montoincial">
<input type="text" data-table="viewavaluosupervisor" data-field="x_montoincial" name="x_montoincial" id="x_montoincial" size="10" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->montoincial->EditValue ?>"<?php echo $viewavaluosupervisor->montoincial->EditAttributes() ?>>
</span>
<?php echo $viewavaluosupervisor->montoincial->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_montoincial">
		<td class="col-sm-3"<?php echo $viewavaluosupervisor->montoincial->CellAttributes() ?>><span id="elh_viewavaluosupervisor_montoincial"><div class="checkbox"><label for="u_montoincial">
<input type="checkbox" name="u_montoincial" id="u_montoincial" class="ewMultiSelect" value="1"<?php echo ($viewavaluosupervisor->montoincial->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluosupervisor->montoincial->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluosupervisor->montoincial->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_montoincial">
<input type="text" data-table="viewavaluosupervisor" data-field="x_montoincial" name="x_montoincial" id="x_montoincial" size="10" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->montoincial->getPlaceHolder()) ?>" value="<?php echo $viewavaluosupervisor->montoincial->EditValue ?>"<?php echo $viewavaluosupervisor->montoincial->EditAttributes() ?>>
</span>
<?php echo $viewavaluosupervisor->montoincial->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor->comentario->Visible) { // comentario ?>
<?php if ($viewavaluosupervisor_update->IsMobileOrModal) { ?>
	<div id="r_comentario" class="form-group">
		<label for="x_comentario" class="<?php echo $viewavaluosupervisor_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_comentario" id="u_comentario" class="ewMultiSelect" value="1"<?php echo ($viewavaluosupervisor->comentario->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluosupervisor->comentario->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewavaluosupervisor_update->RightColumnClass ?>"><div<?php echo $viewavaluosupervisor->comentario->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_comentario">
<textarea data-table="viewavaluosupervisor" data-field="x_comentario" name="x_comentario" id="x_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluosupervisor->comentario->EditAttributes() ?>><?php echo $viewavaluosupervisor->comentario->EditValue ?></textarea>
</span>
<?php echo $viewavaluosupervisor->comentario->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_comentario">
		<td class="col-sm-3"<?php echo $viewavaluosupervisor->comentario->CellAttributes() ?>><span id="elh_viewavaluosupervisor_comentario"><div class="checkbox"><label for="u_comentario">
<input type="checkbox" name="u_comentario" id="u_comentario" class="ewMultiSelect" value="1"<?php echo ($viewavaluosupervisor->comentario->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewavaluosupervisor->comentario->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewavaluosupervisor->comentario->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_comentario">
<textarea data-table="viewavaluosupervisor" data-field="x_comentario" name="x_comentario" id="x_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluosupervisor->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluosupervisor->comentario->EditAttributes() ?>><?php echo $viewavaluosupervisor->comentario->EditValue ?></textarea>
</span>
<?php echo $viewavaluosupervisor->comentario->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewavaluosupervisor_update->IsMobileOrModal) { ?>
	</div><!-- /page -->
<?php } else { ?>
	</tbody>
</table><!-- /desktop table -->
<?php } ?>
<?php if (!$viewavaluosupervisor_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $viewavaluosupervisor_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $viewavaluosupervisor_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$viewavaluosupervisor_update->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fviewavaluosupervisorupdate.Init();
</script>
<?php
$viewavaluosupervisor_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$viewavaluosupervisor_update->Page_Terminate();
?>
