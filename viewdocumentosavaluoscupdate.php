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

$viewdocumentosavaluosc_update = NULL; // Initialize page object first

class cviewdocumentosavaluosc_update extends cviewdocumentosavaluosc {

	// Page ID
	var $PageID = 'update';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewdocumentosavaluosc';

	// Page object name
	var $PageObjName = 'viewdocumentosavaluosc_update';

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
			define("EW_PAGE_ID", 'update', TRUE);

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
		if (!$Security->CanEdit()) {
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
			$this->Page_Terminate("viewdocumentosavaluosclist.php"); // No records selected, return to list
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
					$this->descripcion->setDbValue($this->Recordset->fields('descripcion'));
					$this->avaluo->setDbValue($this->Recordset->fields('avaluo'));
					$this->id_tipodocumento->setDbValue($this->Recordset->fields('id_tipodocumento'));
				} else {
					if (!ew_CompareValue($this->descripcion->DbValue, $this->Recordset->fields('descripcion')))
						$this->descripcion->CurrentValue = NULL;
					if (!ew_CompareValue($this->avaluo->DbValue, $this->Recordset->fields('avaluo')))
						$this->avaluo->CurrentValue = NULL;
					if (!ew_CompareValue($this->id_tipodocumento->DbValue, $this->Recordset->fields('id_tipodocumento')))
						$this->id_tipodocumento->CurrentValue = NULL;
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
		$this->imagen->Upload->Index = $objForm->Index;
		$this->imagen->Upload->UploadFile();
		$this->imagen->MultiUpdate = $objForm->GetValue("u_imagen");
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->descripcion->FldIsDetailKey) {
			$this->descripcion->setFormValue($objForm->GetValue("x_descripcion"));
		}
		$this->descripcion->MultiUpdate = $objForm->GetValue("u_descripcion");
		if (!$this->avaluo->FldIsDetailKey) {
			$this->avaluo->setFormValue($objForm->GetValue("x_avaluo"));
		}
		$this->avaluo->MultiUpdate = $objForm->GetValue("u_avaluo");
		if (!$this->id_tipodocumento->FldIsDetailKey) {
			$this->id_tipodocumento->setFormValue($objForm->GetValue("x_id_tipodocumento"));
		}
		$this->id_tipodocumento->MultiUpdate = $objForm->GetValue("u_id_tipodocumento");
		if (!$this->id->FldIsDetailKey)
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->id->CurrentValue = $this->id->FormValue;
		$this->descripcion->CurrentValue = $this->descripcion->FormValue;
		$this->avaluo->CurrentValue = $this->avaluo->FormValue;
		$this->id_tipodocumento->CurrentValue = $this->id_tipodocumento->FormValue;
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
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

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
		$lUpdateCnt = 0;
		if ($this->descripcion->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->imagen->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->avaluo->MultiUpdate == "1") $lUpdateCnt++;
		if ($this->id_tipodocumento->MultiUpdate == "1") $lUpdateCnt++;
		if ($lUpdateCnt == 0) {
			$gsFormError = $Language->Phrase("NoFieldSelected");
			return FALSE;
		}

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if ($this->descripcion->MultiUpdate <> "" && !$this->descripcion->FldIsDetailKey && !is_null($this->descripcion->FormValue) && $this->descripcion->FormValue == "") {
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
			$this->descripcion->SetDbValueDef($rsnew, $this->descripcion->CurrentValue, "", $this->descripcion->ReadOnly || $this->descripcion->MultiUpdate <> "1");

			// imagen
			if ($this->imagen->Visible && !$this->imagen->ReadOnly && strval($this->imagen->MultiUpdate) == "1" && !$this->imagen->Upload->KeepFile) {
				if (is_null($this->imagen->Upload->Value)) {
					$rsnew['imagen'] = NULL;
				} else {
					$rsnew['imagen'] = $this->imagen->Upload->Value;
				}
			}

			// avaluo
			$this->avaluo->SetDbValueDef($rsnew, $this->avaluo->CurrentValue, NULL, $this->avaluo->ReadOnly || $this->avaluo->MultiUpdate <> "1");

			// id_tipodocumento
			$this->id_tipodocumento->SetDbValueDef($rsnew, $this->id_tipodocumento->CurrentValue, NULL, $this->id_tipodocumento->ReadOnly || $this->id_tipodocumento->MultiUpdate <> "1");

			// Check referential integrity for master table 'viewavaluosc'
			$bValidMasterRecord = TRUE;
			$sMasterFilter = $this->SqlMasterFilter_viewavaluosc();
			$KeyValue = isset($rsnew['avaluo']) ? $rsnew['avaluo'] : $rsold['avaluo'];
			if (strval($KeyValue) <> "") {
				$sMasterFilter = str_replace("@id@", ew_AdjustSql($KeyValue), $sMasterFilter);
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

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("viewdocumentosavaluosclist.php"), "", $this->TableVar, TRUE);
		$PageId = "update";
		$Breadcrumb->Add("update", $PageId, $url);
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
if (!isset($viewdocumentosavaluosc_update)) $viewdocumentosavaluosc_update = new cviewdocumentosavaluosc_update();

// Page init
$viewdocumentosavaluosc_update->Page_Init();

// Page main
$viewdocumentosavaluosc_update->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewdocumentosavaluosc_update->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "update";
var CurrentForm = fviewdocumentosavaluoscupdate = new ew_Form("fviewdocumentosavaluoscupdate", "update");

// Validate form
fviewdocumentosavaluoscupdate.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_descripcion");
			uelm = this.GetElements("u" + infix + "_descripcion");
			if (uelm && uelm.checked) {
				if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
					return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewdocumentosavaluosc->descripcion->FldCaption(), $viewdocumentosavaluosc->descripcion->ReqErrMsg)) ?>");
			}

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fviewdocumentosavaluoscupdate.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewdocumentosavaluoscupdate.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewdocumentosavaluoscupdate.Lists["x_avaluo"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tipoinmueble","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"avaluo"};
fviewdocumentosavaluoscupdate.Lists["x_avaluo"].Data = "<?php echo $viewdocumentosavaluosc_update->avaluo->LookupFilterQuery(FALSE, "update") ?>";
fviewdocumentosavaluoscupdate.Lists["x_id_tipodocumento"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipodocumento"};
fviewdocumentosavaluoscupdate.Lists["x_id_tipodocumento"].Data = "<?php echo $viewdocumentosavaluosc_update->id_tipodocumento->LookupFilterQuery(FALSE, "update") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $viewdocumentosavaluosc_update->ShowPageHeader(); ?>
<?php
$viewdocumentosavaluosc_update->ShowMessage();
?>
<form name="fviewdocumentosavaluoscupdate" id="fviewdocumentosavaluoscupdate" class="<?php echo $viewdocumentosavaluosc_update->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewdocumentosavaluosc_update->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewdocumentosavaluosc_update->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewdocumentosavaluosc">
<input type="hidden" name="a_update" id="a_update" value="U">
<input type="hidden" name="modal" value="<?php echo intval($viewdocumentosavaluosc_update->IsModal) ?>">
<?php foreach ($viewdocumentosavaluosc_update->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<?php if (!$viewdocumentosavaluosc_update->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($viewdocumentosavaluosc_update->IsMobileOrModal) { ?>
<div id="tbl_viewdocumentosavaluoscupdate" class="ewUpdateDiv"><!-- page -->
	<div class="checkbox">
		<label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);"> <?php echo $Language->Phrase("UpdateSelectAll") ?></label>
	</div>
<?php } else { ?>
<table id="tbl_viewdocumentosavaluoscupdate" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- desktop table -->
	<thead>
	<tr>
		<th colspan="2"><div class="checkbox"><label><input type="checkbox" name="u" id="u" onclick="ew_SelectAll(this);" /> <?php echo $Language->Phrase("UpdateSelectAll") ?></label></div></th>
	</tr>
	</thead>
	<tbody>
<?php } ?>
<?php if ($viewdocumentosavaluosc->descripcion->Visible) { // descripcion ?>
<?php if ($viewdocumentosavaluosc_update->IsMobileOrModal) { ?>
	<div id="r_descripcion" class="form-group">
		<label for="x_descripcion" class="<?php echo $viewdocumentosavaluosc_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_descripcion" id="u_descripcion" class="ewMultiSelect" value="1"<?php echo ($viewdocumentosavaluosc->descripcion->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewdocumentosavaluosc->descripcion->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewdocumentosavaluosc_update->RightColumnClass ?>"><div<?php echo $viewdocumentosavaluosc->descripcion->CellAttributes() ?>>
<span id="el_viewdocumentosavaluosc_descripcion">
<textarea data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentosavaluosc->descripcion->EditAttributes() ?>><?php echo $viewdocumentosavaluosc->descripcion->EditValue ?></textarea>
</span>
<?php echo $viewdocumentosavaluosc->descripcion->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_descripcion">
		<td class="col-sm-3"<?php echo $viewdocumentosavaluosc->descripcion->CellAttributes() ?>><span id="elh_viewdocumentosavaluosc_descripcion"><div class="checkbox"><label for="u_descripcion">
<input type="checkbox" name="u_descripcion" id="u_descripcion" class="ewMultiSelect" value="1"<?php echo ($viewdocumentosavaluosc->descripcion->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewdocumentosavaluosc->descripcion->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewdocumentosavaluosc->descripcion->CellAttributes() ?>>
<span id="el_viewdocumentosavaluosc_descripcion">
<textarea data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="x_descripcion" id="x_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentosavaluosc->descripcion->EditAttributes() ?>><?php echo $viewdocumentosavaluosc->descripcion->EditValue ?></textarea>
</span>
<?php echo $viewdocumentosavaluosc->descripcion->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentosavaluosc->imagen->Visible) { // imagen ?>
<?php if ($viewdocumentosavaluosc_update->IsMobileOrModal) { ?>
	<div id="r_imagen" class="form-group">
		<label class="<?php echo $viewdocumentosavaluosc_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_imagen" id="u_imagen" class="ewMultiSelect" value="1"<?php echo ($viewdocumentosavaluosc->imagen->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewdocumentosavaluosc->imagen->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewdocumentosavaluosc_update->RightColumnClass ?>"><div<?php echo $viewdocumentosavaluosc->imagen->CellAttributes() ?>>
<span id="el_viewdocumentosavaluosc_imagen">
<div id="fd_x_imagen">
<span title="<?php echo $viewdocumentosavaluosc->imagen->FldTitle() ? $viewdocumentosavaluosc->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentosavaluosc->imagen->ReadOnly || $viewdocumentosavaluosc->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentosavaluosc" data-field="x_imagen" name="x_imagen" id="x_imagen"<?php echo $viewdocumentosavaluosc->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen" id= "fn_x_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen"] == "0") { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="1">
<?php } ?>
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
		<td class="col-sm-3"<?php echo $viewdocumentosavaluosc->imagen->CellAttributes() ?>><span id="elh_viewdocumentosavaluosc_imagen"><div class="checkbox"><label for="u_imagen">
<input type="checkbox" name="u_imagen" id="u_imagen" class="ewMultiSelect" value="1"<?php echo ($viewdocumentosavaluosc->imagen->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewdocumentosavaluosc->imagen->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewdocumentosavaluosc->imagen->CellAttributes() ?>>
<span id="el_viewdocumentosavaluosc_imagen">
<div id="fd_x_imagen">
<span title="<?php echo $viewdocumentosavaluosc->imagen->FldTitle() ? $viewdocumentosavaluosc->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentosavaluosc->imagen->ReadOnly || $viewdocumentosavaluosc->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentosavaluosc" data-field="x_imagen" name="x_imagen" id="x_imagen"<?php echo $viewdocumentosavaluosc->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x_imagen" id= "fn_x_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->Upload->FileName ?>">
<?php if (@$_POST["fa_x_imagen"] == "0") { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x_imagen" id= "fa_x_imagen" value="1">
<?php } ?>
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
<?php if ($viewdocumentosavaluosc_update->IsMobileOrModal) { ?>
	<div id="r_avaluo" class="form-group">
		<label for="x_avaluo" class="<?php echo $viewdocumentosavaluosc_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_avaluo" id="u_avaluo" class="ewMultiSelect" value="1"<?php echo ($viewdocumentosavaluosc->avaluo->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewdocumentosavaluosc->avaluo->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewdocumentosavaluosc_update->RightColumnClass ?>"><div<?php echo $viewdocumentosavaluosc->avaluo->CellAttributes() ?>>
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
		<td class="col-sm-3"<?php echo $viewdocumentosavaluosc->avaluo->CellAttributes() ?>><span id="elh_viewdocumentosavaluosc_avaluo"><div class="checkbox"><label for="u_avaluo">
<input type="checkbox" name="u_avaluo" id="u_avaluo" class="ewMultiSelect" value="1"<?php echo ($viewdocumentosavaluosc->avaluo->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewdocumentosavaluosc->avaluo->FldCaption() ?></label></div></span></td>
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
<?php if ($viewdocumentosavaluosc_update->IsMobileOrModal) { ?>
	<div id="r_id_tipodocumento" class="form-group">
		<label for="x_id_tipodocumento" class="<?php echo $viewdocumentosavaluosc_update->LeftColumnClass ?>"><div class="checkbox"><label>
<input type="checkbox" name="u_id_tipodocumento" id="u_id_tipodocumento" class="ewMultiSelect" value="1"<?php echo ($viewdocumentosavaluosc->id_tipodocumento->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?></label></div></label>
		<div class="<?php echo $viewdocumentosavaluosc_update->RightColumnClass ?>"><div<?php echo $viewdocumentosavaluosc->id_tipodocumento->CellAttributes() ?>>
<span id="el_viewdocumentosavaluosc_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_id_tipodocumento"><?php echo (strval($viewdocumentosavaluosc->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentosavaluosc->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentosavaluosc->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentosavaluosc->id_tipodocumento->ReadOnly || $viewdocumentosavaluosc->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentosavaluosc->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x_id_tipodocumento" id="x_id_tipodocumento" value="<?php echo $viewdocumentosavaluosc->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentosavaluosc->id_tipodocumento->EditAttributes() ?>>
</span>
<?php echo $viewdocumentosavaluosc->id_tipodocumento->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_id_tipodocumento">
		<td class="col-sm-3"<?php echo $viewdocumentosavaluosc->id_tipodocumento->CellAttributes() ?>><span id="elh_viewdocumentosavaluosc_id_tipodocumento"><div class="checkbox"><label for="u_id_tipodocumento">
<input type="checkbox" name="u_id_tipodocumento" id="u_id_tipodocumento" class="ewMultiSelect" value="1"<?php echo ($viewdocumentosavaluosc->id_tipodocumento->MultiUpdate == "1") ? " checked" : "" ?>>
 <?php echo $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?></label></div></span></td>
		<td<?php echo $viewdocumentosavaluosc->id_tipodocumento->CellAttributes() ?>>
<span id="el_viewdocumentosavaluosc_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_id_tipodocumento"><?php echo (strval($viewdocumentosavaluosc->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentosavaluosc->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentosavaluosc->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentosavaluosc->id_tipodocumento->ReadOnly || $viewdocumentosavaluosc->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentosavaluosc->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x_id_tipodocumento" id="x_id_tipodocumento" value="<?php echo $viewdocumentosavaluosc->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentosavaluosc->id_tipodocumento->EditAttributes() ?>>
</span>
<?php echo $viewdocumentosavaluosc->id_tipodocumento->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentosavaluosc_update->IsMobileOrModal) { ?>
	</div><!-- /page -->
<?php } else { ?>
	</tbody>
</table><!-- /desktop table -->
<?php } ?>
<?php if (!$viewdocumentosavaluosc_update->IsModal) { ?>
	<div class="form-group"><!-- buttons .form-group -->
		<div class="<?php echo $viewdocumentosavaluosc_update->OffsetColumnClass ?>"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("UpdateBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $viewdocumentosavaluosc_update->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
		</div><!-- /buttons offset -->
	</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$viewdocumentosavaluosc_update->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fviewdocumentosavaluoscupdate.Init();
</script>
<?php
$viewdocumentosavaluosc_update->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$viewdocumentosavaluosc_update->Page_Terminate();
?>
