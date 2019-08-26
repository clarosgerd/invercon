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

$notificaciones_delete = NULL; // Initialize page object first

class cnotificaciones_delete extends cnotificaciones {

	// Page ID
	var $PageID = 'delete';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'notificaciones';

	// Page object name
	var $PageObjName = 'notificaciones_delete';

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
			define("EW_PAGE_ID", 'delete', TRUE);

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

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanDelete()) {
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

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action
		$this->id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->id->Visible = FALSE;
		$this->mensaje->SetVisibility();
		$this->creadopor->SetVisibility();
		$this->recibidopor->SetVisibility();
		$this->leido->SetVisibility();
		$this->desde->SetVisibility();
		$this->id_avaluo->SetVisibility();

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
			ew_SaveDebugMsg();
			header("Location: " . $url);
		}
		exit();
	}
	var $DbMasterFilter = "";
	var $DbDetailFilter = "";
	var $StartRec;
	var $TotalRecs = 0;
	var $RecCnt;
	var $RecKeys = array();
	var $Recordset;
	var $StartRowCnt = 1;
	var $RowCnt = 0;

	//
	// Page main
	//
	function Page_Main() {
		global $Language;

		// Set up Breadcrumb
		$this->SetupBreadcrumb();

		// Load key parameters
		$this->RecKeys = $this->GetRecordKeys(); // Load record keys
		$sFilter = $this->GetKeyFilter();
		if ($sFilter == "")
			$this->Page_Terminate("notificacioneslist.php"); // Prevent SQL injection, return to list

		// Set up filter (SQL WHHERE clause) and get return SQL
		// SQL constructor in notificaciones class, notificacionesinfo.php

		$this->CurrentFilter = $sFilter;

		// Get action
		if (@$_POST["a_delete"] <> "") {
			$this->CurrentAction = $_POST["a_delete"];
		} elseif (@$_GET["a_delete"] == "1") {
			$this->CurrentAction = "D"; // Delete record directly
		} else {
			$this->CurrentAction = "I"; // Display record
		}
		if ($this->CurrentAction == "D") {
			$this->SendEmail = TRUE; // Send email on delete success
			if ($this->DeleteRows()) { // Delete rows
				if ($this->getSuccessMessage() == "")
					$this->setSuccessMessage($Language->Phrase("DeleteSuccess")); // Set up success message
				$this->Page_Terminate($this->getReturnUrl()); // Return to caller
			} else { // Delete failed
				$this->CurrentAction = "I"; // Display record
			}
		}
		if ($this->CurrentAction == "I") { // Load records for display
			if ($this->Recordset = $this->LoadRecordset())
				$this->TotalRecs = $this->Recordset->RecordCount(); // Get record count
			if ($this->TotalRecs <= 0) { // No record found, exit
				if ($this->Recordset)
					$this->Recordset->Close();
				$this->Page_Terminate("notificacioneslist.php"); // Return to list
			}
		}
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
		$this->mensaje->setDbValue($row['mensaje']);
		$this->creadopor->setDbValue($row['creadopor']);
		$this->recibidopor->setDbValue($row['recibidopor']);
		$this->leido->setDbValue($row['leido']);
		$this->estado->setDbValue($row['estado']);
		$this->fecha->setDbValue($row['fecha']);
		$this->fechaleido->setDbValue($row['fechaleido']);
		$this->desde->setDbValue($row['desde']);
		$this->id_avaluo->setDbValue($row['id_avaluo']);
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
		$row['id_avaluo'] = NULL;
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
		$this->id_avaluo->DbValue = $row['id_avaluo'];
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

		$this->estado->CellCssStyle = "white-space: nowrap;";

		// fecha
		$this->fecha->CellCssStyle = "white-space: nowrap;";

		// fechaleido
		$this->fechaleido->CellCssStyle = "white-space: nowrap;";

		// desde
		// id_avaluo

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

		// id_avaluo
		$this->id_avaluo->ViewValue = $this->id_avaluo->CurrentValue;
		$this->id_avaluo->ViewCustomAttributes = "";

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

			// id_avaluo
			$this->id_avaluo->LinkCustomAttributes = "";
			$this->id_avaluo->HrefValue = "";
			$this->id_avaluo->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	//
	// Delete records based on current filter
	//
	function DeleteRows() {
		global $Language, $Security;
		if (!$Security->CanDelete()) {
			$this->setFailureMessage($Language->Phrase("NoDeletePermission")); // No delete permission
			return FALSE;
		}
		$DeleteRows = TRUE;
		$sSql = $this->SQL();
		$conn = &$this->Connection();
		$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
		$rs = $conn->Execute($sSql);
		$conn->raiseErrorFn = '';
		if ($rs === FALSE) {
			return FALSE;
		} elseif ($rs->EOF) {
			$this->setFailureMessage($Language->Phrase("NoRecord")); // No record found
			$rs->Close();
			return FALSE;
		}
		$rows = ($rs) ? $rs->GetRows() : array();
		$conn->BeginTrans();

		// Clone old rows
		$rsold = $rows;
		if ($rs)
			$rs->Close();

		// Call row deleting event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$DeleteRows = $this->Row_Deleting($row);
				if (!$DeleteRows) break;
			}
		}
		if ($DeleteRows) {
			$sKey = "";
			foreach ($rsold as $row) {
				$sThisKey = "";
				if ($sThisKey <> "") $sThisKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
				$sThisKey .= $row['id'];
				$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
				$DeleteRows = $this->Delete($row); // Delete
				$conn->raiseErrorFn = '';
				if ($DeleteRows === FALSE)
					break;
				if ($sKey <> "") $sKey .= ", ";
				$sKey .= $sThisKey;
			}
		}
		if (!$DeleteRows) {

			// Set up error message
			if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

				// Use the message, do nothing
			} elseif ($this->CancelMessage <> "") {
				$this->setFailureMessage($this->CancelMessage);
				$this->CancelMessage = "";
			} else {
				$this->setFailureMessage($Language->Phrase("DeleteCancelled"));
			}
		}
		if ($DeleteRows) {
			$conn->CommitTrans(); // Commit the changes
		} else {
			$conn->RollbackTrans(); // Rollback changes
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("notificacioneslist.php"), "", $this->TableVar, TRUE);
		$PageId = "delete";
		$Breadcrumb->Add("delete", $PageId, $url);
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
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($notificaciones_delete)) $notificaciones_delete = new cnotificaciones_delete();

// Page init
$notificaciones_delete->Page_Init();

// Page main
$notificaciones_delete->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$notificaciones_delete->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "delete";
var CurrentForm = fnotificacionesdelete = new ew_Form("fnotificacionesdelete", "delete");

// Form_CustomValidate event
fnotificacionesdelete.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fnotificacionesdelete.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $notificaciones_delete->ShowPageHeader(); ?>
<?php
$notificaciones_delete->ShowMessage();
?>
<form name="fnotificacionesdelete" id="fnotificacionesdelete" class="form-inline ewForm ewDeleteForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($notificaciones_delete->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $notificaciones_delete->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="notificaciones">
<input type="hidden" name="a_delete" id="a_delete" value="D">
<?php foreach ($notificaciones_delete->RecKeys as $key) { ?>
<?php $keyvalue = is_array($key) ? implode($EW_COMPOSITE_KEY_SEPARATOR, $key) : $key; ?>
<input type="hidden" name="key_m[]" value="<?php echo ew_HtmlEncode($keyvalue) ?>">
<?php } ?>
<div class="box ewBox ewGrid">
<div class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table class="table ewTable">
	<thead>
	<tr class="ewTableHeader">
<?php if ($notificaciones->id->Visible) { // id ?>
		<th class="<?php echo $notificaciones->id->HeaderCellClass() ?>"><span id="elh_notificaciones_id" class="notificaciones_id"><?php echo $notificaciones->id->FldCaption() ?></span></th>
<?php } ?>
<?php if ($notificaciones->mensaje->Visible) { // mensaje ?>
		<th class="<?php echo $notificaciones->mensaje->HeaderCellClass() ?>"><span id="elh_notificaciones_mensaje" class="notificaciones_mensaje"><?php echo $notificaciones->mensaje->FldCaption() ?></span></th>
<?php } ?>
<?php if ($notificaciones->creadopor->Visible) { // creadopor ?>
		<th class="<?php echo $notificaciones->creadopor->HeaderCellClass() ?>"><span id="elh_notificaciones_creadopor" class="notificaciones_creadopor"><?php echo $notificaciones->creadopor->FldCaption() ?></span></th>
<?php } ?>
<?php if ($notificaciones->recibidopor->Visible) { // recibidopor ?>
		<th class="<?php echo $notificaciones->recibidopor->HeaderCellClass() ?>"><span id="elh_notificaciones_recibidopor" class="notificaciones_recibidopor"><?php echo $notificaciones->recibidopor->FldCaption() ?></span></th>
<?php } ?>
<?php if ($notificaciones->leido->Visible) { // leido ?>
		<th class="<?php echo $notificaciones->leido->HeaderCellClass() ?>"><span id="elh_notificaciones_leido" class="notificaciones_leido"><?php echo $notificaciones->leido->FldCaption() ?></span></th>
<?php } ?>
<?php if ($notificaciones->desde->Visible) { // desde ?>
		<th class="<?php echo $notificaciones->desde->HeaderCellClass() ?>"><span id="elh_notificaciones_desde" class="notificaciones_desde"><?php echo $notificaciones->desde->FldCaption() ?></span></th>
<?php } ?>
<?php if ($notificaciones->id_avaluo->Visible) { // id_avaluo ?>
		<th class="<?php echo $notificaciones->id_avaluo->HeaderCellClass() ?>"><span id="elh_notificaciones_id_avaluo" class="notificaciones_id_avaluo"><?php echo $notificaciones->id_avaluo->FldCaption() ?></span></th>
<?php } ?>
	</tr>
	</thead>
	<tbody>
<?php
$notificaciones_delete->RecCnt = 0;
$i = 0;
while (!$notificaciones_delete->Recordset->EOF) {
	$notificaciones_delete->RecCnt++;
	$notificaciones_delete->RowCnt++;

	// Set row properties
	$notificaciones->ResetAttrs();
	$notificaciones->RowType = EW_ROWTYPE_VIEW; // View

	// Get the field contents
	$notificaciones_delete->LoadRowValues($notificaciones_delete->Recordset);

	// Render row
	$notificaciones_delete->RenderRow();
?>
	<tr<?php echo $notificaciones->RowAttributes() ?>>
<?php if ($notificaciones->id->Visible) { // id ?>
		<td<?php echo $notificaciones->id->CellAttributes() ?>>
<span id="el<?php echo $notificaciones_delete->RowCnt ?>_notificaciones_id" class="notificaciones_id">
<span<?php echo $notificaciones->id->ViewAttributes() ?>>
<?php echo $notificaciones->id->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($notificaciones->mensaje->Visible) { // mensaje ?>
		<td<?php echo $notificaciones->mensaje->CellAttributes() ?>>
<span id="el<?php echo $notificaciones_delete->RowCnt ?>_notificaciones_mensaje" class="notificaciones_mensaje">
<span<?php echo $notificaciones->mensaje->ViewAttributes() ?>>
<?php echo $notificaciones->mensaje->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($notificaciones->creadopor->Visible) { // creadopor ?>
		<td<?php echo $notificaciones->creadopor->CellAttributes() ?>>
<span id="el<?php echo $notificaciones_delete->RowCnt ?>_notificaciones_creadopor" class="notificaciones_creadopor">
<span<?php echo $notificaciones->creadopor->ViewAttributes() ?>>
<?php echo $notificaciones->creadopor->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($notificaciones->recibidopor->Visible) { // recibidopor ?>
		<td<?php echo $notificaciones->recibidopor->CellAttributes() ?>>
<span id="el<?php echo $notificaciones_delete->RowCnt ?>_notificaciones_recibidopor" class="notificaciones_recibidopor">
<span<?php echo $notificaciones->recibidopor->ViewAttributes() ?>>
<?php echo $notificaciones->recibidopor->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($notificaciones->leido->Visible) { // leido ?>
		<td<?php echo $notificaciones->leido->CellAttributes() ?>>
<span id="el<?php echo $notificaciones_delete->RowCnt ?>_notificaciones_leido" class="notificaciones_leido">
<span<?php echo $notificaciones->leido->ViewAttributes() ?>>
<?php echo $notificaciones->leido->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($notificaciones->desde->Visible) { // desde ?>
		<td<?php echo $notificaciones->desde->CellAttributes() ?>>
<span id="el<?php echo $notificaciones_delete->RowCnt ?>_notificaciones_desde" class="notificaciones_desde">
<span<?php echo $notificaciones->desde->ViewAttributes() ?>>
<?php echo $notificaciones->desde->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
<?php if ($notificaciones->id_avaluo->Visible) { // id_avaluo ?>
		<td<?php echo $notificaciones->id_avaluo->CellAttributes() ?>>
<span id="el<?php echo $notificaciones_delete->RowCnt ?>_notificaciones_id_avaluo" class="notificaciones_id_avaluo">
<span<?php echo $notificaciones->id_avaluo->ViewAttributes() ?>>
<?php echo $notificaciones->id_avaluo->ListViewValue() ?></span>
</span>
</td>
<?php } ?>
	</tr>
<?php
	$notificaciones_delete->Recordset->MoveNext();
}
$notificaciones_delete->Recordset->Close();
?>
</tbody>
</table>
</div>
</div>
<div>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("DeleteBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $notificaciones_delete->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
</div>
</form>
<script type="text/javascript">
fnotificacionesdelete.Init();
</script>
<?php
$notificaciones_delete->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$notificaciones_delete->Page_Terminate();
?>
