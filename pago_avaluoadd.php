<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "pago_avaluoinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "pagoinfo.php" ?>
<?php include_once "viewavaluoscinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$pago_avaluo_add = NULL; // Initialize page object first

class cpago_avaluo_add extends cpago_avaluo {

	// Page ID
	var $PageID = 'add';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'pago_avaluo';

	// Page object name
	var $PageObjName = 'pago_avaluo_add';

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

		// Table object (pago_avaluo)
		if (!isset($GLOBALS["pago_avaluo"]) || get_class($GLOBALS["pago_avaluo"]) == "cpago_avaluo") {
			$GLOBALS["pago_avaluo"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pago_avaluo"];
		}

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Table object (pago)
		if (!isset($GLOBALS['pago'])) $GLOBALS['pago'] = new cpago();

		// Table object (viewavaluosc)
		if (!isset($GLOBALS['viewavaluosc'])) $GLOBALS['viewavaluosc'] = new cviewavaluosc();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'add', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'pago_avaluo', TRUE);

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
				$this->Page_Terminate(ew_GetUrl("pago_avaluolist.php"));
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
		$this->pago_id->SetVisibility();
		$this->avaluo_id->SetVisibility();

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
		global $EW_EXPORT, $pago_avaluo;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($pago_avaluo);
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
					if ($pageName == "pago_avaluoview.php")
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
					$this->Page_Terminate("pago_avaluolist.php"); // No matching record, return to list
				}
				break;
			case "A": // Add new record
				$this->SendEmail = TRUE; // Send email on add success
				if ($this->AddRow($this->OldRecordset)) { // Add successful
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage($Language->Phrase("AddSuccess")); // Set up success message
					$sReturnUrl = $this->getReturnUrl();
					if (ew_GetPageName($sReturnUrl) == "pago_avaluolist.php")
						$sReturnUrl = $this->AddMasterUrl($sReturnUrl); // List page, return to List page with correct master key if necessary
					elseif (ew_GetPageName($sReturnUrl) == "pago_avaluoview.php")
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
		if ($this->CurrentAction == "F") { // Confirm page
			$this->RowType = EW_ROWTYPE_VIEW; // Render view type
		} else {
			$this->RowType = EW_ROWTYPE_ADD; // Render add type
		}

		// Render row
		$this->ResetAttrs();
		$this->RenderRow();
	}

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
	}

	// Load default values
	function LoadDefaultValues() {
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->pago_id->CurrentValue = NULL;
		$this->pago_id->OldValue = $this->pago_id->CurrentValue;
		$this->avaluo_id->CurrentValue = NULL;
		$this->avaluo_id->OldValue = $this->avaluo_id->CurrentValue;
		$this->q->CurrentValue = NULL;
		$this->q->OldValue = $this->q->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->pago_id->FldIsDetailKey) {
			$this->pago_id->setFormValue($objForm->GetValue("x_pago_id"));
		}
		if (!$this->avaluo_id->FldIsDetailKey) {
			$this->avaluo_id->setFormValue($objForm->GetValue("x_avaluo_id"));
		}
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		$this->pago_id->CurrentValue = $this->pago_id->FormValue;
		$this->avaluo_id->CurrentValue = $this->avaluo_id->FormValue;
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
		$this->pago_id->setDbValue($row['pago_id']);
		$this->avaluo_id->setDbValue($row['avaluo_id']);
		if (array_key_exists('EV__avaluo_id', $rs->fields)) {
			$this->avaluo_id->VirtualValue = $rs->fields('EV__avaluo_id'); // Set up virtual field value
		} else {
			$this->avaluo_id->VirtualValue = ""; // Clear value
		}
		$this->q->setDbValue($row['q']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['id'] = $this->id->CurrentValue;
		$row['pago_id'] = $this->pago_id->CurrentValue;
		$row['avaluo_id'] = $this->avaluo_id->CurrentValue;
		$row['q'] = $this->q->CurrentValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->pago_id->DbValue = $row['pago_id'];
		$this->avaluo_id->DbValue = $row['avaluo_id'];
		$this->q->DbValue = $row['q'];
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
		// pago_id
		// avaluo_id
		// q

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// pago_id
		if (strval($this->pago_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->pago_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pago`";
		$sWhereWrk = "";
		$this->pago_id->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->pago_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->pago_id->ViewValue = $this->pago_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->pago_id->ViewValue = $this->pago_id->CurrentValue;
			}
		} else {
			$this->pago_id->ViewValue = NULL;
		}
		$this->pago_id->ViewCustomAttributes = "";

		// avaluo_id
		if ($this->avaluo_id->VirtualValue <> "") {
			$this->avaluo_id->ViewValue = $this->avaluo_id->VirtualValue;
		} else {
		if (strval($this->avaluo_id->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->avaluo_id->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `codigoavaluo` AS `Disp2Fld`, `id_oficialcredito` AS `Disp3Fld`, `tipoinmueble` AS `Disp4Fld` FROM `avaluo`";
		$sWhereWrk = "";
		$this->avaluo_id->LookupFilters = array("dx1" => '`id`', "dx2" => '`codigoavaluo`', "dx3" => '`id_oficialcredito`', "dx4" => '`tipoinmueble`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->avaluo_id, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = ew_FormatNumber($rswrk->fields('Disp2Fld'), 0, 0, 0, 0);
				$arwrk[3] = $rswrk->fields('Disp3Fld');
				$arwrk[4] = $rswrk->fields('Disp4Fld');
				$this->avaluo_id->ViewValue = $this->avaluo_id->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->avaluo_id->ViewValue = $this->avaluo_id->CurrentValue;
			}
		} else {
			$this->avaluo_id->ViewValue = NULL;
		}
		}
		$this->avaluo_id->ViewCustomAttributes = "";

		// q
		$this->q->ViewValue = $this->q->CurrentValue;
		$this->q->ViewCustomAttributes = "";

			// pago_id
			$this->pago_id->LinkCustomAttributes = "";
			$this->pago_id->HrefValue = "";
			$this->pago_id->TooltipValue = "";

			// avaluo_id
			$this->avaluo_id->LinkCustomAttributes = "";
			$this->avaluo_id->HrefValue = "";
			$this->avaluo_id->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// pago_id
			$this->pago_id->EditAttrs["class"] = "form-control";
			$this->pago_id->EditCustomAttributes = "";
			if ($this->pago_id->getSessionValue() <> "") {
				$this->pago_id->CurrentValue = $this->pago_id->getSessionValue();
			if (strval($this->pago_id->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->pago_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pago`";
			$sWhereWrk = "";
			$this->pago_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->pago_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->pago_id->ViewValue = $this->pago_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->pago_id->ViewValue = $this->pago_id->CurrentValue;
				}
			} else {
				$this->pago_id->ViewValue = NULL;
			}
			$this->pago_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->pago_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->pago_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `pago`";
			$sWhereWrk = "";
			$this->pago_id->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->pago_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->pago_id->EditValue = $arwrk;
			}

			// avaluo_id
			$this->avaluo_id->EditCustomAttributes = "";
			if ($this->avaluo_id->getSessionValue() <> "") {
				$this->avaluo_id->CurrentValue = $this->avaluo_id->getSessionValue();
			if ($this->avaluo_id->VirtualValue <> "") {
				$this->avaluo_id->ViewValue = $this->avaluo_id->VirtualValue;
			} else {
			if (strval($this->avaluo_id->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->avaluo_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `codigoavaluo` AS `Disp2Fld`, `id_oficialcredito` AS `Disp3Fld`, `tipoinmueble` AS `Disp4Fld` FROM `avaluo`";
			$sWhereWrk = "";
			$this->avaluo_id->LookupFilters = array("dx1" => '`id`', "dx2" => '`codigoavaluo`', "dx3" => '`id_oficialcredito`', "dx4" => '`tipoinmueble`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->avaluo_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$arwrk[2] = ew_FormatNumber($rswrk->fields('Disp2Fld'), 0, 0, 0, 0);
					$arwrk[3] = $rswrk->fields('Disp3Fld');
					$arwrk[4] = $rswrk->fields('Disp4Fld');
					$this->avaluo_id->ViewValue = $this->avaluo_id->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->avaluo_id->ViewValue = $this->avaluo_id->CurrentValue;
				}
			} else {
				$this->avaluo_id->ViewValue = NULL;
			}
			}
			$this->avaluo_id->ViewCustomAttributes = "";
			} else {
			if (trim(strval($this->avaluo_id->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->avaluo_id->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `codigoavaluo` AS `Disp2Fld`, `id_oficialcredito` AS `Disp3Fld`, `tipoinmueble` AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `avaluo`";
			$sWhereWrk = "";
			$this->avaluo_id->LookupFilters = array("dx1" => '`id`', "dx2" => '`codigoavaluo`', "dx3" => '`id_oficialcredito`', "dx4" => '`tipoinmueble`');
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->avaluo_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = ew_HtmlEncode($rswrk->fields('DispFld'));
				$arwrk[2] = ew_HtmlEncode(ew_FormatNumber($rswrk->fields('Disp2Fld'), 0, 0, 0, 0));
				$arwrk[3] = ew_HtmlEncode($rswrk->fields('Disp3Fld'));
				$arwrk[4] = ew_HtmlEncode($rswrk->fields('Disp4Fld'));
				$this->avaluo_id->ViewValue = $this->avaluo_id->DisplayValue($arwrk);
			} else {
				$this->avaluo_id->ViewValue = $Language->Phrase("PleaseSelect");
			}
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$rowswrk = count($arwrk);
			for ($rowcntwrk = 0; $rowcntwrk < $rowswrk; $rowcntwrk++) {
				$arwrk[$rowcntwrk][2] = ew_FormatNumber($arwrk[$rowcntwrk][2], 0, 0, 0, 0);
			}
			$this->avaluo_id->EditValue = $arwrk;
			}

			// Add refer script
			// pago_id

			$this->pago_id->LinkCustomAttributes = "";
			$this->pago_id->HrefValue = "";

			// avaluo_id
			$this->avaluo_id->LinkCustomAttributes = "";
			$this->avaluo_id->HrefValue = "";
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

		// Check referential integrity for master table 'pago'
		$bValidMasterRecord = TRUE;
		$sMasterFilter = $this->SqlMasterFilter_pago();
		if (strval($this->pago_id->CurrentValue) <> "") {
			$sMasterFilter = str_replace("@id@", ew_AdjustSql($this->pago_id->CurrentValue, "DB"), $sMasterFilter);
		} else {
			$bValidMasterRecord = FALSE;
		}
		if ($bValidMasterRecord) {
			if (!isset($GLOBALS["pago"])) $GLOBALS["pago"] = new cpago();
			$rsmaster = $GLOBALS["pago"]->LoadRs($sMasterFilter);
			$bValidMasterRecord = ($rsmaster && !$rsmaster->EOF);
			$rsmaster->Close();
		}
		if (!$bValidMasterRecord) {
			$sRelatedRecordMsg = str_replace("%t", "pago", $Language->Phrase("RelatedRecordRequired"));
			$this->setFailureMessage($sRelatedRecordMsg);
			return FALSE;
		}
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// pago_id
		$this->pago_id->SetDbValueDef($rsnew, $this->pago_id->CurrentValue, NULL, FALSE);

		// avaluo_id
		$this->avaluo_id->SetDbValueDef($rsnew, $this->avaluo_id->CurrentValue, NULL, FALSE);

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
			if ($sMasterTblVar == "pago") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["pago"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->pago_id->setQueryStringValue($GLOBALS["pago"]->id->QueryStringValue);
					$this->pago_id->setSessionValue($this->pago_id->QueryStringValue);
					if (!is_numeric($GLOBALS["pago"]->id->QueryStringValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
			if ($sMasterTblVar == "viewavaluosc") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["viewavaluosc"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->avaluo_id->setQueryStringValue($GLOBALS["viewavaluosc"]->id->QueryStringValue);
					$this->avaluo_id->setSessionValue($this->avaluo_id->QueryStringValue);
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
			if ($sMasterTblVar == "pago") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["pago"]->id->setFormValue($_POST["fk_id"]);
					$this->pago_id->setFormValue($GLOBALS["pago"]->id->FormValue);
					$this->pago_id->setSessionValue($this->pago_id->FormValue);
					if (!is_numeric($GLOBALS["pago"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
			if ($sMasterTblVar == "viewavaluosc") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["viewavaluosc"]->id->setFormValue($_POST["fk_id"]);
					$this->avaluo_id->setFormValue($GLOBALS["viewavaluosc"]->id->FormValue);
					$this->avaluo_id->setSessionValue($this->avaluo_id->FormValue);
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
			if ($sMasterTblVar <> "pago") {
				if ($this->pago_id->CurrentValue == "") $this->pago_id->setSessionValue("");
			}
			if ($sMasterTblVar <> "viewavaluosc") {
				if ($this->avaluo_id->CurrentValue == "") $this->avaluo_id->setSessionValue("");
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
		$Breadcrumb->Add("list", $this->TableVar, $this->AddMasterUrl("pago_avaluolist.php"), "", $this->TableVar, TRUE);
		$PageId = ($this->CurrentAction == "C") ? "Copy" : "Add";
		$Breadcrumb->Add("add", $PageId, $url);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		switch ($fld->FldVar) {
		case "x_pago_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `id` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `pago`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->pago_id, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_avaluo_id":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `id` AS `DispFld`, `codigoavaluo` AS `Disp2Fld`, `id_oficialcredito` AS `Disp3Fld`, `tipoinmueble` AS `Disp4Fld` FROM `avaluo`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`id`', "dx2" => '`codigoavaluo`', "dx3" => '`id_oficialcredito`', "dx4" => '`tipoinmueble`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->avaluo_id, $sWhereWrk); // Call Lookup Selecting
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
if (!isset($pago_avaluo_add)) $pago_avaluo_add = new cpago_avaluo_add();

// Page init
$pago_avaluo_add->Page_Init();

// Page main
$pago_avaluo_add->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pago_avaluo_add->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fpago_avaluoadd = new ew_Form("fpago_avaluoadd", "add");

// Validate form
fpago_avaluoadd.Validate = function() {
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
fpago_avaluoadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpago_avaluoadd.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpago_avaluoadd.Lists["x_pago_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_id","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pago"};
fpago_avaluoadd.Lists["x_pago_id"].Data = "<?php echo $pago_avaluo_add->pago_id->LookupFilterQuery(FALSE, "add") ?>";
fpago_avaluoadd.Lists["x_avaluo_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_id","x_codigoavaluo","x_id_oficialcredito","x_tipoinmueble"],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"avaluo"};
fpago_avaluoadd.Lists["x_avaluo_id"].Data = "<?php echo $pago_avaluo_add->avaluo_id->LookupFilterQuery(FALSE, "add") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php $pago_avaluo_add->ShowPageHeader(); ?>
<?php
$pago_avaluo_add->ShowMessage();
?>
<form name="fpago_avaluoadd" id="fpago_avaluoadd" class="<?php echo $pago_avaluo_add->FormClassName ?>" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pago_avaluo_add->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pago_avaluo_add->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pago_avaluo">
<?php if ($pago_avaluo->CurrentAction == "F") { // Confirm page ?>
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="a_confirm" id="a_confirm" value="F">
<?php } else { ?>
<input type="hidden" name="a_add" id="a_add" value="F">
<?php } ?>
<input type="hidden" name="modal" value="<?php echo intval($pago_avaluo_add->IsModal) ?>">
<?php if ($pago_avaluo->getCurrentMasterTable() == "pago") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="pago">
<input type="hidden" name="fk_id" value="<?php echo $pago_avaluo->pago_id->getSessionValue() ?>">
<?php } ?>
<?php if ($pago_avaluo->getCurrentMasterTable() == "viewavaluosc") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="viewavaluosc">
<input type="hidden" name="fk_id" value="<?php echo $pago_avaluo->avaluo_id->getSessionValue() ?>">
<?php } ?>
<?php if (!$pago_avaluo_add->IsMobileOrModal) { ?>
<div class="ewDesktop"><!-- desktop -->
<?php } ?>
<?php if ($pago_avaluo_add->IsMobileOrModal) { ?>
<div class="ewAddDiv"><!-- page* -->
<?php } else { ?>
<table id="tbl_pago_avaluoadd" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
<?php } ?>
<?php if ($pago_avaluo->pago_id->Visible) { // pago_id ?>
<?php if ($pago_avaluo_add->IsMobileOrModal) { ?>
	<div id="r_pago_id" class="form-group">
		<label id="elh_pago_avaluo_pago_id" for="x_pago_id" class="<?php echo $pago_avaluo_add->LeftColumnClass ?>"><?php echo $pago_avaluo->pago_id->FldCaption() ?></label>
		<div class="<?php echo $pago_avaluo_add->RightColumnClass ?>"><div<?php echo $pago_avaluo->pago_id->CellAttributes() ?>>
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<?php if ($pago_avaluo->pago_id->getSessionValue() <> "") { ?>
<span id="el_pago_avaluo_pago_id">
<span<?php echo $pago_avaluo->pago_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->pago_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_pago_id" name="x_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_pago_avaluo_pago_id">
<select data-table="pago_avaluo" data-field="x_pago_id" data-value-separator="<?php echo $pago_avaluo->pago_id->DisplayValueSeparatorAttribute() ?>" id="x_pago_id" name="x_pago_id"<?php echo $pago_avaluo->pago_id->EditAttributes() ?>>
<?php echo $pago_avaluo->pago_id->SelectOptionListHtml("x_pago_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_pago_avaluo_pago_id">
<span<?php echo $pago_avaluo->pago_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->pago_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_pago_id" name="x_pago_id" id="x_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->FormValue) ?>">
<?php } ?>
<?php echo $pago_avaluo->pago_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_pago_id">
		<td class="col-sm-3"><span id="elh_pago_avaluo_pago_id"><?php echo $pago_avaluo->pago_id->FldCaption() ?></span></td>
		<td<?php echo $pago_avaluo->pago_id->CellAttributes() ?>>
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<?php if ($pago_avaluo->pago_id->getSessionValue() <> "") { ?>
<span id="el_pago_avaluo_pago_id">
<span<?php echo $pago_avaluo->pago_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->pago_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_pago_id" name="x_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_pago_avaluo_pago_id">
<select data-table="pago_avaluo" data-field="x_pago_id" data-value-separator="<?php echo $pago_avaluo->pago_id->DisplayValueSeparatorAttribute() ?>" id="x_pago_id" name="x_pago_id"<?php echo $pago_avaluo->pago_id->EditAttributes() ?>>
<?php echo $pago_avaluo->pago_id->SelectOptionListHtml("x_pago_id") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_pago_avaluo_pago_id">
<span<?php echo $pago_avaluo->pago_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->pago_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_pago_id" name="x_pago_id" id="x_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->FormValue) ?>">
<?php } ?>
<?php echo $pago_avaluo->pago_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($pago_avaluo->avaluo_id->Visible) { // avaluo_id ?>
<?php if ($pago_avaluo_add->IsMobileOrModal) { ?>
	<div id="r_avaluo_id" class="form-group">
		<label id="elh_pago_avaluo_avaluo_id" for="x_avaluo_id" class="<?php echo $pago_avaluo_add->LeftColumnClass ?>"><?php echo $pago_avaluo->avaluo_id->FldCaption() ?></label>
		<div class="<?php echo $pago_avaluo_add->RightColumnClass ?>"><div<?php echo $pago_avaluo->avaluo_id->CellAttributes() ?>>
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<?php if ($pago_avaluo->avaluo_id->getSessionValue() <> "") { ?>
<span id="el_pago_avaluo_avaluo_id">
<span<?php echo $pago_avaluo->avaluo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->avaluo_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_avaluo_id" name="x_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_pago_avaluo_avaluo_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_avaluo_id"><?php echo (strval($pago_avaluo->avaluo_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $pago_avaluo->avaluo_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pago_avaluo->avaluo_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_avaluo_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($pago_avaluo->avaluo_id->ReadOnly || $pago_avaluo->avaluo_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pago_avaluo->avaluo_id->DisplayValueSeparatorAttribute() ?>" name="x_avaluo_id" id="x_avaluo_id" value="<?php echo $pago_avaluo->avaluo_id->CurrentValue ?>"<?php echo $pago_avaluo->avaluo_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_pago_avaluo_avaluo_id">
<span<?php echo $pago_avaluo->avaluo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->avaluo_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" name="x_avaluo_id" id="x_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->FormValue) ?>">
<?php } ?>
<?php echo $pago_avaluo->avaluo_id->CustomMsg ?></div></div>
	</div>
<?php } else { ?>
	<tr id="r_avaluo_id">
		<td class="col-sm-3"><span id="elh_pago_avaluo_avaluo_id"><?php echo $pago_avaluo->avaluo_id->FldCaption() ?></span></td>
		<td<?php echo $pago_avaluo->avaluo_id->CellAttributes() ?>>
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<?php if ($pago_avaluo->avaluo_id->getSessionValue() <> "") { ?>
<span id="el_pago_avaluo_avaluo_id">
<span<?php echo $pago_avaluo->avaluo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->avaluo_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x_avaluo_id" name="x_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el_pago_avaluo_avaluo_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x_avaluo_id"><?php echo (strval($pago_avaluo->avaluo_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $pago_avaluo->avaluo_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pago_avaluo->avaluo_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x_avaluo_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($pago_avaluo->avaluo_id->ReadOnly || $pago_avaluo->avaluo_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pago_avaluo->avaluo_id->DisplayValueSeparatorAttribute() ?>" name="x_avaluo_id" id="x_avaluo_id" value="<?php echo $pago_avaluo->avaluo_id->CurrentValue ?>"<?php echo $pago_avaluo->avaluo_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el_pago_avaluo_avaluo_id">
<span<?php echo $pago_avaluo->avaluo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->avaluo_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" name="x_avaluo_id" id="x_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->FormValue) ?>">
<?php } ?>
<?php echo $pago_avaluo->avaluo_id->CustomMsg ?></td>
	</tr>
<?php } ?>
<?php } ?>
<?php if ($pago_avaluo_add->IsMobileOrModal) { ?>
</div><!-- /page* -->
<?php } else { ?>
</table><!-- /table* -->
<?php } ?>
<?php if (!$pago_avaluo_add->IsModal) { ?>
<div class="form-group"><!-- buttons .form-group -->
	<div class="<?php echo $pago_avaluo_add->OffsetColumnClass ?>"><!-- buttons offset -->
<?php if ($pago_avaluo->CurrentAction <> "F") { // Confirm page ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit" onclick="this.form.a_add.value='F';"><?php echo $Language->Phrase("AddBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="<?php echo $pago_avaluo_add->getReturnUrl() ?>"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } else { ?>
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit"><?php echo $Language->Phrase("ConfirmBtn") ?></button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="submit" onclick="this.form.a_add.value='X';"><?php echo $Language->Phrase("CancelBtn") ?></button>
<?php } ?>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
<?php } ?>
<?php if (!$pago_avaluo_add->IsMobileOrModal) { ?>
</div><!-- /desktop -->
<?php } ?>
</form>
<script type="text/javascript">
fpago_avaluoadd.Init();
</script>
<?php
$pago_avaluo_add->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$pago_avaluo_add->Page_Terminate();
?>
