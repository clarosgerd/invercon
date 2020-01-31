<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "viewavaluosofprocesadosinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$viewavaluosofprocesados_list = NULL; // Initialize page object first

class cviewavaluosofprocesados_list extends cviewavaluosofprocesados {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewavaluosofprocesados';

	// Page object name
	var $PageObjName = 'viewavaluosofprocesados_list';

	// Grid form hidden field names
	var $FormName = 'fviewavaluosofprocesadoslist';
	var $FormActionName = 'k_action';
	var $FormKeyName = 'k_key';
	var $FormOldKeyName = 'k_oldkey';
	var $FormBlankRowName = 'k_blankrow';
	var $FormKeyCountName = 'key_count';

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

	// Page URLs
	var $AddUrl;
	var $EditUrl;
	var $CopyUrl;
	var $DeleteUrl;
	var $ViewUrl;
	var $ListUrl;

	// Export URLs
	var $ExportPrintUrl;
	var $ExportHtmlUrl;
	var $ExportExcelUrl;
	var $ExportWordUrl;
	var $ExportXmlUrl;
	var $ExportCsvUrl;
	var $ExportPdfUrl;

	// Custom export
	var $ExportExcelCustom = FALSE;
	var $ExportWordCustom = FALSE;
	var $ExportPdfCustom = FALSE;
	var $ExportEmailCustom = FALSE;

	// Update URLs
	var $InlineAddUrl;
	var $InlineCopyUrl;
	var $InlineEditUrl;
	var $GridAddUrl;
	var $GridEditUrl;
	var $MultiDeleteUrl;
	var $MultiUpdateUrl;

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

		// Table object (viewavaluosofprocesados)
		if (!isset($GLOBALS["viewavaluosofprocesados"]) || get_class($GLOBALS["viewavaluosofprocesados"]) == "cviewavaluosofprocesados") {
			$GLOBALS["viewavaluosofprocesados"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["viewavaluosofprocesados"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "viewavaluosofprocesadosadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "viewavaluosofprocesadosdelete.php";
		$this->MultiUpdateUrl = "viewavaluosofprocesadosupdate.php";

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'viewavaluosofprocesados', TRUE);

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

		// List options
		$this->ListOptions = new cListOptions();
		$this->ListOptions->TableVar = $this->TableVar;

		// Export options
		$this->ExportOptions = new cListOptions();
		$this->ExportOptions->Tag = "div";
		$this->ExportOptions->TagClassName = "ewExportOption";

		// Other options
		$this->OtherOptions['addedit'] = new cListOptions();
		$this->OtherOptions['addedit']->Tag = "div";
		$this->OtherOptions['addedit']->TagClassName = "ewAddEditOption";
		$this->OtherOptions['detail'] = new cListOptions();
		$this->OtherOptions['detail']->Tag = "div";
		$this->OtherOptions['detail']->TagClassName = "ewDetailOption";
		$this->OtherOptions['action'] = new cListOptions();
		$this->OtherOptions['action']->Tag = "div";
		$this->OtherOptions['action']->TagClassName = "ewActionOption";

		// Filter options
		$this->FilterOptions = new cListOptions();
		$this->FilterOptions->Tag = "div";
		$this->FilterOptions->TagClassName = "ewFilterOption fviewavaluosofprocesadoslistsrch";

		// List actions
		$this->ListActions = new cListActions();
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
		if (!$Security->CanList()) {
			$Security->SaveLastUrl();
			$this->setFailureMessage(ew_DeniedMsg()); // Set no permission
			$this->Page_Terminate(ew_GetUrl("index.php"));
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
		// Get export parameters

		$custom = "";
		if (@$_GET["export"] <> "") {
			$this->Export = $_GET["export"];
			$custom = @$_GET["custom"];
		} elseif (@$_POST["export"] <> "") {
			$this->Export = $_POST["export"];
			$custom = @$_POST["custom"];
		} elseif (ew_IsPost()) {
			if (@$_POST["exporttype"] <> "")
				$this->Export = $_POST["exporttype"];
			$custom = @$_POST["custom"];
		} elseif (@$_GET["cmd"] == "json") {
			$this->Export = $_GET["cmd"];
		} else {
			$this->setExportReturnUrl(ew_CurrentUrl());
		}
		$gsExportFile = $this->TableVar; // Get export file, used in header

		// Get custom export parameters
		if ($this->Export <> "" && $custom <> "") {
			$this->CustomExport = $this->Export;
			$this->Export = "print";
		}
		$gsCustomExport = $this->CustomExport;
		$gsExport = $this->Export; // Get export parameter, used in header

		// Update Export URLs
		if (defined("EW_USE_PHPEXCEL"))
			$this->ExportExcelCustom = FALSE;
		if ($this->ExportExcelCustom)
			$this->ExportExcelUrl .= "&amp;custom=1";
		if (defined("EW_USE_PHPWORD"))
			$this->ExportWordCustom = FALSE;
		if ($this->ExportWordCustom)
			$this->ExportWordUrl .= "&amp;custom=1";
		if ($this->ExportPdfCustom)
			$this->ExportPdfUrl .= "&amp;custom=1";
		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();

		// Setup export options
		$this->SetupExportOptions();
		$this->tipoinmueble->SetVisibility();
		$this->codigoavaluo->SetVisibility();
		$this->id_solicitud->SetVisibility();
		$this->id_oficialcredito->SetVisibility();
		$this->id_inspector->SetVisibility();
		$this->estado->SetVisibility();
		$this->estadopago->SetVisibility();
		$this->fecha_avaluo->SetVisibility();
		$this->informe->SetVisibility();

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

		// Setup other options
		$this->SetupOtherOptions();

		// Set up custom action (compatible with old version)
		foreach ($this->CustomActions as $name => $action)
			$this->ListActions->Add($name, $action);

		// Show checkbox column if multiple action
		foreach ($this->ListActions->Items as $listaction) {
			if ($listaction->Select == EW_ACTION_MULTIPLE && $listaction->Allow) {
				$this->ListOptions->Items["checkbox"]->Visible = TRUE;
				break;
			}
		}
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
		global $EW_EXPORT, $viewavaluosofprocesados;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($viewavaluosofprocesados);
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

	// Class variables
	var $ListOptions; // List options
	var $ExportOptions; // Export options
	var $SearchOptions; // Search options
	var $OtherOptions = array(); // Other options
	var $FilterOptions; // Filter options
	var $ListActions; // List actions
	var $SelectedCount = 0;
	var $SelectedIndex = 0;
	var $DisplayRecs = 20;
	var $StartRec;
	var $StopRec;
	var $TotalRecs = 0;
	var $RecRange = 10;
	var $Pager;
	var $AutoHidePager = EW_AUTO_HIDE_PAGER;
	var $AutoHidePageSizeSelector = EW_AUTO_HIDE_PAGE_SIZE_SELECTOR;
	var $DefaultSearchWhere = ""; // Default search WHERE clause
	var $SearchWhere = ""; // Search WHERE clause
	var $RecCnt = 0; // Record count
	var $EditRowCnt;
	var $StartRowCnt = 1;
	var $RowCnt = 0;
	var $Attrs = array(); // Row attributes and cell attributes
	var $RowIndex = 0; // Row index
	var $KeyCount = 0; // Key count
	var $RowAction = ""; // Row action
	var $RowOldKey = ""; // Row old key (for copy)
	var $RecPerRow = 0;
	var $MultiColumnClass;
	var $MultiColumnEditClass = "col-sm-12";
	var $MultiColumnCnt = 12;
	var $MultiColumnEditCnt = 12;
	var $GridCnt = 0;
	var $ColCnt = 0;
	var $DbMasterFilter = ""; // Master filter
	var $DbDetailFilter = ""; // Detail filter
	var $MasterRecordExists;
	var $MultiSelectKey;
	var $Command;
	var $RestoreSearch = FALSE;
	var $DetailPages;
	var $Recordset;
	var $OldRecordset;

	//
	// Page main
	//
	function Page_Main() {
		global $objForm, $Language, $gsFormError, $gsSearchError, $Security, $EW_EXPORT;

		// Search filters
		$sSrchAdvanced = ""; // Advanced search filter
		$sSrchBasic = ""; // Basic search filter
		$sFilter = "";

		// Get command
		$this->Command = strtolower(@$_GET["cmd"]);
		if ($this->IsPageRequest()) { // Validate request

			// Process list action first
			if ($this->ProcessListAction()) // Ajax request
				$this->Page_Terminate();

			// Set up records per page
			$this->SetupDisplayRecs();

			// Handle reset command
			$this->ResetCmd();

			// Set up Breadcrumb
			if ($this->Export == "")
				$this->SetupBreadcrumb();

			// Hide list options
			if ($this->Export <> "") {
				$this->ListOptions->HideAllOptions(array("sequence"));
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			} elseif ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$this->ListOptions->HideAllOptions();
				$this->ListOptions->UseDropDownButton = FALSE; // Disable drop down button
				$this->ListOptions->UseButtonGroup = FALSE; // Disable button group
			}

			// Hide options
			if ($this->Export <> "" || $this->CurrentAction <> "") {
				$this->ExportOptions->HideAllOptions();
				$this->FilterOptions->HideAllOptions();
			}

			// Hide other options
			if ($this->Export <> "") {
				foreach ($this->OtherOptions as &$option)
					$option->HideAllOptions();
			}

			// Get default search criteria
			ew_AddFilter($this->DefaultSearchWhere, $this->AdvancedSearchWhere(TRUE));

			// Get and validate search values for advanced search
			$this->LoadSearchValues(); // Get search values

			// Process filter list
			$this->ProcessFilterList();
			if (!$this->ValidateSearch())
				$this->setFailureMessage($gsSearchError);

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetupSortOrder();

			// Get search criteria for advanced search
			if ($gsSearchError == "")
				$sSrchAdvanced = $this->AdvancedSearchWhere();
		}

		// Restore display records
		if ($this->Command <> "json" && $this->getRecordsPerPage() <> "") {
			$this->DisplayRecs = $this->getRecordsPerPage(); // Restore from Session
		} else {
			$this->DisplayRecs = 20; // Load default
		}

		// Load Sorting Order
		if ($this->Command <> "json")
			$this->LoadSortOrder();

		// Load search default if no existing search criteria
		if (!$this->CheckSearchParms()) {

			// Load advanced search from default
			if ($this->LoadAdvancedSearchDefault()) {
				$sSrchAdvanced = $this->AdvancedSearchWhere();
			}
		}

		// Build search criteria
		ew_AddFilter($this->SearchWhere, $sSrchAdvanced);
		ew_AddFilter($this->SearchWhere, $sSrchBasic);

		// Call Recordset_Searching event
		$this->Recordset_Searching($this->SearchWhere);

		// Save search criteria
		if ($this->Command == "search" && !$this->RestoreSearch) {
			$this->setSearchWhere($this->SearchWhere); // Save to Session
			$this->StartRec = 1; // Reset start record counter
			$this->setStartRecordNumber($this->StartRec);
		} elseif ($this->Command <> "json") {
			$this->SearchWhere = $this->getSearchWhere();
		}

		// Build filter
		$sFilter = "";
		if (!$Security->CanList())
			$sFilter = "(0=1)"; // Filter all records
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSQL = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $sFilter;
		} else {
			$this->setSessionWhere($sFilter);
			$this->CurrentFilter = "";
		}

		// Export data only
		if ($this->CustomExport == "" && in_array($this->Export, array_keys($EW_EXPORT))) {
			$this->ExportData();
			$this->Page_Terminate(); // Terminate response
			exit();
		}

		// Load record count first
		if (!$this->IsAddOrEdit()) {
			$bSelectLimit = $this->UseSelectLimit;
			if ($bSelectLimit) {
				$this->TotalRecs = $this->ListRecordCount();
			} else {
				if ($this->Recordset = $this->LoadRecordset())
					$this->TotalRecs = $this->Recordset->RecordCount();
			}
		}

		// Search options
		$this->SetupSearchOptions();
	}

	// Set up number of records displayed per page
	function SetupDisplayRecs() {
		$sWrk = @$_GET[EW_TABLE_REC_PER_PAGE];
		if ($sWrk <> "") {
			if (is_numeric($sWrk)) {
				$this->DisplayRecs = intval($sWrk);
			} else {
				if (strtolower($sWrk) == "all") { // Display all records
					$this->DisplayRecs = -1;
				} else {
					$this->DisplayRecs = 20; // Non-numeric, load default
				}
			}
			$this->setRecordsPerPage($this->DisplayRecs); // Save to Session

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Build filter for all keys
	function BuildKeyFilter() {
		global $objForm;
		$sWrkFilter = "";

		// Update row index and get row key
		$rowindex = 1;
		$objForm->Index = $rowindex;
		$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		while ($sThisKey <> "") {
			if ($this->SetupKeyValues($sThisKey)) {
				$sFilter = $this->KeyFilter();
				if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
				$sWrkFilter .= $sFilter;
			} else {
				$sWrkFilter = "0=1";
				break;
			}

			// Update row index and get row key
			$rowindex++; // Next row
			$objForm->Index = $rowindex;
			$sThisKey = strval($objForm->GetValue($this->FormKeyName));
		}
		return $sWrkFilter;
	}

	// Set up key values
	function SetupKeyValues($key) {
		$arrKeyFlds = explode($GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"], $key);
		if (count($arrKeyFlds) >= 1) {
			$this->id->setFormValue($arrKeyFlds[0]);
			if (!is_numeric($this->id->FormValue))
				return FALSE;
		}
		return TRUE;
	}

	// Get list of filters
	function GetFilterList() {
		global $UserProfile;

		// Initialize
		$sFilterList = "";
		$sSavedFilterList = "";

		// Load server side filters
		if (EW_SEARCH_FILTER_OPTION == "Server" && isset($UserProfile))
			$sSavedFilterList = $UserProfile->GetSearchFilters(CurrentUserName(), "fviewavaluosofprocesadoslistsrch");
		$sFilterList = ew_Concat($sFilterList, $this->id->AdvancedSearch->ToJson(), ","); // Field id
		$sFilterList = ew_Concat($sFilterList, $this->tipoinmueble->AdvancedSearch->ToJson(), ","); // Field tipoinmueble
		$sFilterList = ew_Concat($sFilterList, $this->codigoavaluo->AdvancedSearch->ToJson(), ","); // Field codigoavaluo
		$sFilterList = ew_Concat($sFilterList, $this->id_solicitud->AdvancedSearch->ToJson(), ","); // Field id_solicitud
		$sFilterList = ew_Concat($sFilterList, $this->id_oficialcredito->AdvancedSearch->ToJson(), ","); // Field id_oficialcredito
		$sFilterList = ew_Concat($sFilterList, $this->id_inspector->AdvancedSearch->ToJson(), ","); // Field id_inspector
		$sFilterList = ew_Concat($sFilterList, $this->id_cliente->AdvancedSearch->ToJson(), ","); // Field id_cliente
		$sFilterList = ew_Concat($sFilterList, $this->estado->AdvancedSearch->ToJson(), ","); // Field estado
		$sFilterList = ew_Concat($sFilterList, $this->estadopago->AdvancedSearch->ToJson(), ","); // Field estadopago
		$sFilterList = ew_Concat($sFilterList, $this->fecha_avaluo->AdvancedSearch->ToJson(), ","); // Field fecha_avaluo
		$sFilterList = ew_Concat($sFilterList, $this->comentario->AdvancedSearch->ToJson(), ","); // Field comentario
		$sFilterList = preg_replace('/,$/', "", $sFilterList);

		// Return filter list in json
		if ($sFilterList <> "")
			$sFilterList = "\"data\":{" . $sFilterList . "}";
		if ($sSavedFilterList <> "") {
			if ($sFilterList <> "")
				$sFilterList .= ",";
			$sFilterList .= "\"filters\":" . $sSavedFilterList;
		}
		return ($sFilterList <> "") ? "{" . $sFilterList . "}" : "null";
	}

	// Process filter list
	function ProcessFilterList() {
		global $UserProfile;
		if (@$_POST["ajax"] == "savefilters") { // Save filter request (Ajax)
			$filters = @$_POST["filters"];
			$UserProfile->SetSearchFilters(CurrentUserName(), "fviewavaluosofprocesadoslistsrch", $filters);

			// Clean output buffer
			if (!EW_DEBUG_ENABLED && ob_get_length())
				ob_end_clean();
			echo ew_ArrayToJson(array(array("success" => TRUE))); // Success
			$this->Page_Terminate();
			exit();
		} elseif (@$_POST["cmd"] == "resetfilter") {
			$this->RestoreFilterList();
		}
	}

	// Restore list of filters
	function RestoreFilterList() {

		// Return if not reset filter
		if (@$_POST["cmd"] <> "resetfilter")
			return FALSE;
		$filter = json_decode(@$_POST["filter"], TRUE);
		$this->Command = "search";

		// Field id
		$this->id->AdvancedSearch->SearchValue = @$filter["x_id"];
		$this->id->AdvancedSearch->SearchOperator = @$filter["z_id"];
		$this->id->AdvancedSearch->SearchCondition = @$filter["v_id"];
		$this->id->AdvancedSearch->SearchValue2 = @$filter["y_id"];
		$this->id->AdvancedSearch->SearchOperator2 = @$filter["w_id"];
		$this->id->AdvancedSearch->Save();

		// Field tipoinmueble
		$this->tipoinmueble->AdvancedSearch->SearchValue = @$filter["x_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->SearchOperator = @$filter["z_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->SearchCondition = @$filter["v_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->SearchValue2 = @$filter["y_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->SearchOperator2 = @$filter["w_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->Save();

		// Field codigoavaluo
		$this->codigoavaluo->AdvancedSearch->SearchValue = @$filter["x_codigoavaluo"];
		$this->codigoavaluo->AdvancedSearch->SearchOperator = @$filter["z_codigoavaluo"];
		$this->codigoavaluo->AdvancedSearch->SearchCondition = @$filter["v_codigoavaluo"];
		$this->codigoavaluo->AdvancedSearch->SearchValue2 = @$filter["y_codigoavaluo"];
		$this->codigoavaluo->AdvancedSearch->SearchOperator2 = @$filter["w_codigoavaluo"];
		$this->codigoavaluo->AdvancedSearch->Save();

		// Field id_solicitud
		$this->id_solicitud->AdvancedSearch->SearchValue = @$filter["x_id_solicitud"];
		$this->id_solicitud->AdvancedSearch->SearchOperator = @$filter["z_id_solicitud"];
		$this->id_solicitud->AdvancedSearch->SearchCondition = @$filter["v_id_solicitud"];
		$this->id_solicitud->AdvancedSearch->SearchValue2 = @$filter["y_id_solicitud"];
		$this->id_solicitud->AdvancedSearch->SearchOperator2 = @$filter["w_id_solicitud"];
		$this->id_solicitud->AdvancedSearch->Save();

		// Field id_oficialcredito
		$this->id_oficialcredito->AdvancedSearch->SearchValue = @$filter["x_id_oficialcredito"];
		$this->id_oficialcredito->AdvancedSearch->SearchOperator = @$filter["z_id_oficialcredito"];
		$this->id_oficialcredito->AdvancedSearch->SearchCondition = @$filter["v_id_oficialcredito"];
		$this->id_oficialcredito->AdvancedSearch->SearchValue2 = @$filter["y_id_oficialcredito"];
		$this->id_oficialcredito->AdvancedSearch->SearchOperator2 = @$filter["w_id_oficialcredito"];
		$this->id_oficialcredito->AdvancedSearch->Save();

		// Field id_inspector
		$this->id_inspector->AdvancedSearch->SearchValue = @$filter["x_id_inspector"];
		$this->id_inspector->AdvancedSearch->SearchOperator = @$filter["z_id_inspector"];
		$this->id_inspector->AdvancedSearch->SearchCondition = @$filter["v_id_inspector"];
		$this->id_inspector->AdvancedSearch->SearchValue2 = @$filter["y_id_inspector"];
		$this->id_inspector->AdvancedSearch->SearchOperator2 = @$filter["w_id_inspector"];
		$this->id_inspector->AdvancedSearch->Save();

		// Field id_cliente
		$this->id_cliente->AdvancedSearch->SearchValue = @$filter["x_id_cliente"];
		$this->id_cliente->AdvancedSearch->SearchOperator = @$filter["z_id_cliente"];
		$this->id_cliente->AdvancedSearch->SearchCondition = @$filter["v_id_cliente"];
		$this->id_cliente->AdvancedSearch->SearchValue2 = @$filter["y_id_cliente"];
		$this->id_cliente->AdvancedSearch->SearchOperator2 = @$filter["w_id_cliente"];
		$this->id_cliente->AdvancedSearch->Save();

		// Field estado
		$this->estado->AdvancedSearch->SearchValue = @$filter["x_estado"];
		$this->estado->AdvancedSearch->SearchOperator = @$filter["z_estado"];
		$this->estado->AdvancedSearch->SearchCondition = @$filter["v_estado"];
		$this->estado->AdvancedSearch->SearchValue2 = @$filter["y_estado"];
		$this->estado->AdvancedSearch->SearchOperator2 = @$filter["w_estado"];
		$this->estado->AdvancedSearch->Save();

		// Field estadopago
		$this->estadopago->AdvancedSearch->SearchValue = @$filter["x_estadopago"];
		$this->estadopago->AdvancedSearch->SearchOperator = @$filter["z_estadopago"];
		$this->estadopago->AdvancedSearch->SearchCondition = @$filter["v_estadopago"];
		$this->estadopago->AdvancedSearch->SearchValue2 = @$filter["y_estadopago"];
		$this->estadopago->AdvancedSearch->SearchOperator2 = @$filter["w_estadopago"];
		$this->estadopago->AdvancedSearch->Save();

		// Field fecha_avaluo
		$this->fecha_avaluo->AdvancedSearch->SearchValue = @$filter["x_fecha_avaluo"];
		$this->fecha_avaluo->AdvancedSearch->SearchOperator = @$filter["z_fecha_avaluo"];
		$this->fecha_avaluo->AdvancedSearch->SearchCondition = @$filter["v_fecha_avaluo"];
		$this->fecha_avaluo->AdvancedSearch->SearchValue2 = @$filter["y_fecha_avaluo"];
		$this->fecha_avaluo->AdvancedSearch->SearchOperator2 = @$filter["w_fecha_avaluo"];
		$this->fecha_avaluo->AdvancedSearch->Save();

		// Field comentario
		$this->comentario->AdvancedSearch->SearchValue = @$filter["x_comentario"];
		$this->comentario->AdvancedSearch->SearchOperator = @$filter["z_comentario"];
		$this->comentario->AdvancedSearch->SearchCondition = @$filter["v_comentario"];
		$this->comentario->AdvancedSearch->SearchValue2 = @$filter["y_comentario"];
		$this->comentario->AdvancedSearch->SearchOperator2 = @$filter["w_comentario"];
		$this->comentario->AdvancedSearch->Save();
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->id, $Default, FALSE); // id
		$this->BuildSearchSql($sWhere, $this->tipoinmueble, $Default, FALSE); // tipoinmueble
		$this->BuildSearchSql($sWhere, $this->codigoavaluo, $Default, FALSE); // codigoavaluo
		$this->BuildSearchSql($sWhere, $this->id_solicitud, $Default, FALSE); // id_solicitud
		$this->BuildSearchSql($sWhere, $this->id_oficialcredito, $Default, FALSE); // id_oficialcredito
		$this->BuildSearchSql($sWhere, $this->id_inspector, $Default, FALSE); // id_inspector
		$this->BuildSearchSql($sWhere, $this->id_cliente, $Default, FALSE); // id_cliente
		$this->BuildSearchSql($sWhere, $this->estado, $Default, FALSE); // estado
		$this->BuildSearchSql($sWhere, $this->estadopago, $Default, FALSE); // estadopago
		$this->BuildSearchSql($sWhere, $this->fecha_avaluo, $Default, FALSE); // fecha_avaluo
		$this->BuildSearchSql($sWhere, $this->comentario, $Default, FALSE); // comentario

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->id->AdvancedSearch->Save(); // id
			$this->tipoinmueble->AdvancedSearch->Save(); // tipoinmueble
			$this->codigoavaluo->AdvancedSearch->Save(); // codigoavaluo
			$this->id_solicitud->AdvancedSearch->Save(); // id_solicitud
			$this->id_oficialcredito->AdvancedSearch->Save(); // id_oficialcredito
			$this->id_inspector->AdvancedSearch->Save(); // id_inspector
			$this->id_cliente->AdvancedSearch->Save(); // id_cliente
			$this->estado->AdvancedSearch->Save(); // estado
			$this->estadopago->AdvancedSearch->Save(); // estadopago
			$this->fecha_avaluo->AdvancedSearch->Save(); // fecha_avaluo
			$this->comentario->AdvancedSearch->Save(); // comentario
		}
		return $sWhere;
	}

	// Build search SQL
	function BuildSearchSql(&$Where, &$Fld, $Default, $MultiValue) {
		$FldParm = $Fld->FldParm();
		$FldVal = ($Default) ? $Fld->AdvancedSearch->SearchValueDefault : $Fld->AdvancedSearch->SearchValue; // @$_GET["x_$FldParm"]
		$FldOpr = ($Default) ? $Fld->AdvancedSearch->SearchOperatorDefault : $Fld->AdvancedSearch->SearchOperator; // @$_GET["z_$FldParm"]
		$FldCond = ($Default) ? $Fld->AdvancedSearch->SearchConditionDefault : $Fld->AdvancedSearch->SearchCondition; // @$_GET["v_$FldParm"]
		$FldVal2 = ($Default) ? $Fld->AdvancedSearch->SearchValue2Default : $Fld->AdvancedSearch->SearchValue2; // @$_GET["y_$FldParm"]
		$FldOpr2 = ($Default) ? $Fld->AdvancedSearch->SearchOperator2Default : $Fld->AdvancedSearch->SearchOperator2; // @$_GET["w_$FldParm"]
		$sWrk = "";
		if (is_array($FldVal)) $FldVal = implode(",", $FldVal);
		if (is_array($FldVal2)) $FldVal2 = implode(",", $FldVal2);
		$FldOpr = strtoupper(trim($FldOpr));
		if ($FldOpr == "") $FldOpr = "=";
		$FldOpr2 = strtoupper(trim($FldOpr2));
		if ($FldOpr2 == "") $FldOpr2 = "=";
		if (EW_SEARCH_MULTI_VALUE_OPTION == 1)
			$MultiValue = FALSE;
		if ($MultiValue) {
			$sWrk1 = ($FldVal <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr, $FldVal, $this->DBID) : ""; // Field value 1
			$sWrk2 = ($FldVal2 <> "") ? ew_GetMultiSearchSql($Fld, $FldOpr2, $FldVal2, $this->DBID) : ""; // Field value 2
			$sWrk = $sWrk1; // Build final SQL
			if ($sWrk2 <> "")
				$sWrk = ($sWrk <> "") ? "($sWrk) $FldCond ($sWrk2)" : $sWrk2;
		} else {
			$FldVal = $this->ConvertSearchValue($Fld, $FldVal);
			$FldVal2 = $this->ConvertSearchValue($Fld, $FldVal2);
			$sWrk = ew_GetSearchSql($Fld, $FldVal, $FldOpr, $FldCond, $FldVal2, $FldOpr2, $this->DBID);
		}
		ew_AddFilter($Where, $sWrk);
	}

	// Convert search value
	function ConvertSearchValue(&$Fld, $FldVal) {
		if ($FldVal == EW_NULL_VALUE || $FldVal == EW_NOT_NULL_VALUE)
			return $FldVal;
		$Value = $FldVal;
		if ($Fld->FldDataType == EW_DATATYPE_BOOLEAN) {
			if ($FldVal <> "") $Value = ($FldVal == "1" || strtolower(strval($FldVal)) == "y" || strtolower(strval($FldVal)) == "t") ? $Fld->TrueValue : $Fld->FalseValue;
		} elseif ($Fld->FldDataType == EW_DATATYPE_DATE || $Fld->FldDataType == EW_DATATYPE_TIME) {
			if ($FldVal <> "") $Value = ew_UnFormatDateTime($FldVal, $Fld->FldDateTimeFormat);
		}
		return $Value;
	}

	// Check if search parm exists
	function CheckSearchParms() {
		if ($this->id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->tipoinmueble->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->codigoavaluo->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_solicitud->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_oficialcredito->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_inspector->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_cliente->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->estado->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->estadopago->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->fecha_avaluo->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->comentario->AdvancedSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		$this->id->AdvancedSearch->UnsetSession();
		$this->tipoinmueble->AdvancedSearch->UnsetSession();
		$this->codigoavaluo->AdvancedSearch->UnsetSession();
		$this->id_solicitud->AdvancedSearch->UnsetSession();
		$this->id_oficialcredito->AdvancedSearch->UnsetSession();
		$this->id_inspector->AdvancedSearch->UnsetSession();
		$this->id_cliente->AdvancedSearch->UnsetSession();
		$this->estado->AdvancedSearch->UnsetSession();
		$this->estadopago->AdvancedSearch->UnsetSession();
		$this->fecha_avaluo->AdvancedSearch->UnsetSession();
		$this->comentario->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->id->AdvancedSearch->Load();
		$this->tipoinmueble->AdvancedSearch->Load();
		$this->codigoavaluo->AdvancedSearch->Load();
		$this->id_solicitud->AdvancedSearch->Load();
		$this->id_oficialcredito->AdvancedSearch->Load();
		$this->id_inspector->AdvancedSearch->Load();
		$this->id_cliente->AdvancedSearch->Load();
		$this->estado->AdvancedSearch->Load();
		$this->estadopago->AdvancedSearch->Load();
		$this->fecha_avaluo->AdvancedSearch->Load();
		$this->comentario->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->tipoinmueble); // tipoinmueble
			$this->UpdateSort($this->codigoavaluo); // codigoavaluo
			$this->UpdateSort($this->id_solicitud); // id_solicitud
			$this->UpdateSort($this->id_oficialcredito); // id_oficialcredito
			$this->UpdateSort($this->id_inspector); // id_inspector
			$this->UpdateSort($this->estado); // estado
			$this->UpdateSort($this->estadopago); // estadopago
			$this->UpdateSort($this->fecha_avaluo); // fecha_avaluo
			$this->setStartRecordNumber(1); // Reset start position
		}
	}

	// Load sort order parameters
	function LoadSortOrder() {
		$sOrderBy = $this->getSessionOrderBy(); // Get ORDER BY from Session
		if ($sOrderBy == "") {
			if ($this->getSqlOrderBy() <> "") {
				$sOrderBy = $this->getSqlOrderBy();
				$this->setSessionOrderBy($sOrderBy);
			}
		}
	}

	// Reset command
	// - cmd=reset (Reset search parameters)
	// - cmd=resetall (Reset search and master/detail parameters)
	// - cmd=resetsort (Reset sort parameters)
	function ResetCmd() {

		// Check if reset command
		if (substr($this->Command,0,5) == "reset") {

			// Reset search criteria
			if ($this->Command == "reset" || $this->Command == "resetall")
				$this->ResetSearchParms();

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->tipoinmueble->setSort("");
				$this->codigoavaluo->setSort("");
				$this->id_solicitud->setSort("");
				$this->id_oficialcredito->setSort("");
				$this->id_inspector->setSort("");
				$this->estado->setSort("");
				$this->estadopago->setSort("");
				$this->fecha_avaluo->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// Add group option item
		$item = &$this->ListOptions->Add($this->ListOptions->GroupOptionName);
		$item->Body = "";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;

		// List actions
		$item = &$this->ListOptions->Add("listactions");
		$item->CssClass = "text-nowrap";
		$item->OnLeft = TRUE;
		$item->Visible = FALSE;
		$item->ShowInButtonGroup = FALSE;
		$item->ShowInDropDown = FALSE;

		// "checkbox"
		$item = &$this->ListOptions->Add("checkbox");
		$item->Visible = FALSE;
		$item->OnLeft = TRUE;
		$item->Header = "<input type=\"checkbox\" name=\"key\" id=\"key\" onclick=\"ew_SelectAllKey(this);\">";
		$item->MoveTo(0);
		$item->ShowInDropDown = FALSE;
		$item->ShowInButtonGroup = FALSE;

		// Drop down button for ListOptions
		$this->ListOptions->UseImageAndText = TRUE;
		$this->ListOptions->UseDropDownButton = FALSE;
		$this->ListOptions->DropDownButtonPhrase = $Language->Phrase("ButtonListOptions");
		$this->ListOptions->UseButtonGroup = FALSE;
		if ($this->ListOptions->UseButtonGroup && ew_IsMobile())
			$this->ListOptions->UseDropDownButton = TRUE;
		$this->ListOptions->ButtonClass = "btn-sm"; // Class for button group

		// Call ListOptions_Load event
		$this->ListOptions_Load();
		$this->SetupListOptionsExt();
		$item = &$this->ListOptions->GetItem($this->ListOptions->GroupOptionName);
		$item->Visible = $this->ListOptions->GroupOptionVisible();
	}

	// Render list options
	function RenderListOptions() {
		global $Security, $Language, $objForm;
		$this->ListOptions->LoadDefault();

		// Call ListOptions_Rendering event
		$this->ListOptions_Rendering();

		// Set up list action buttons
		$oListOpt = &$this->ListOptions->GetItem("listactions");
		if ($oListOpt && $this->Export == "" && $this->CurrentAction == "") {
			$body = "";
			$links = array();
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_SINGLE && $listaction->Allow) {
					$action = $listaction->Action;
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode(str_replace(" ewIcon", "", $listaction->Icon)) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\"></span> " : "";
					$links[] = "<li><a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . $listaction->Caption . "</a></li>";
					if (count($links) == 1) // Single button
						$body = "<a class=\"ewAction ewListAction\" data-action=\"" . ew_HtmlEncode($action) . "\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({key:" . $this->KeyToJson() . "}," . $listaction->ToJson(TRUE) . "));return false;\">" . $Language->Phrase("ListActionButton") . "</a>";
				}
			}
			if (count($links) > 1) { // More than one buttons, use dropdown
				$body = "<button class=\"dropdown-toggle btn btn-default btn-sm ewActions\" title=\"" . ew_HtmlTitle($Language->Phrase("ListActionButton")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("ListActionButton") . "<b class=\"caret\"></b></button>";
				$content = "";
				foreach ($links as $link)
					$content .= "<li>" . $link . "</li>";
				$body .= "<ul class=\"dropdown-menu" . ($oListOpt->OnLeft ? "" : " dropdown-menu-right") . "\">". $content . "</ul>";
				$body = "<div class=\"btn-group\">" . $body . "</div>";
			}
			if (count($links) > 0) {
				$oListOpt->Body = $body;
				$oListOpt->Visible = TRUE;
			}
		}

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
		$this->RenderListOptionsExt();

		// Call ListOptions_Rendered event
		$this->ListOptions_Rendered();
	}

	// Set up other options
	function SetupOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = FALSE;
			$option->UseButtonGroup = TRUE;
			$option->ButtonClass = "btn-sm"; // Class for button group
			$item = &$option->Add($option->GroupOptionName);
			$item->Body = "";
			$item->Visible = FALSE;
		}
		$options["addedit"]->DropDownButtonPhrase = $Language->Phrase("ButtonAddEdit");
		$options["detail"]->DropDownButtonPhrase = $Language->Phrase("ButtonDetails");
		$options["action"]->DropDownButtonPhrase = $Language->Phrase("ButtonActions");

		// Filter button
		$item = &$this->FilterOptions->Add("savecurrentfilter");
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fviewavaluosofprocesadoslistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fviewavaluosofprocesadoslistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = TRUE;
		$this->FilterOptions->UseDropDownButton = TRUE;
		$this->FilterOptions->UseButtonGroup = !$this->FilterOptions->UseDropDownButton;
		$this->FilterOptions->DropDownButtonPhrase = $Language->Phrase("Filters");

		// Add group option item
		$item = &$this->FilterOptions->Add($this->FilterOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Render other options
	function RenderOtherOptions() {
		global $Language, $Security;
		$options = &$this->OtherOptions;
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fviewavaluosofprocesadoslist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
					$item->Visible = $listaction->Allow;
				}
			}

			// Hide grid edit and other options
			if ($this->TotalRecs <= 0) {
				$option = &$options["addedit"];
				$item = &$option->GetItem("gridedit");
				if ($item) $item->Visible = FALSE;
				$option = &$options["action"];
				$option->HideAllOptions();
			}
	}

	// Process list action
	function ProcessListAction() {
		global $Language, $Security;
		$userlist = "";
		$user = "";
		$sFilter = $this->GetKeyFilter();
		$UserAction = @$_POST["useraction"];
		if ($sFilter <> "" && $UserAction <> "") {

			// Check permission first
			$ActionCaption = $UserAction;
			if (array_key_exists($UserAction, $this->ListActions->Items)) {
				$ActionCaption = $this->ListActions->Items[$UserAction]->Caption;
				if (!$this->ListActions->Items[$UserAction]->Allow) {
					$errmsg = str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionNotAllowed"));
					if (@$_POST["ajax"] == $UserAction) // Ajax
						echo "<p class=\"text-danger\">" . $errmsg . "</p>";
					else
						$this->setFailureMessage($errmsg);
					return FALSE;
				}
			}
			$this->CurrentFilter = $sFilter;
			$sSql = $this->SQL();
			$conn = &$this->Connection();
			$conn->raiseErrorFn = $GLOBALS["EW_ERROR_FN"];
			$rs = $conn->Execute($sSql);
			$conn->raiseErrorFn = '';
			$this->CurrentAction = $UserAction;

			// Call row action event
			if ($rs && !$rs->EOF) {
				$conn->BeginTrans();
				$this->SelectedCount = $rs->RecordCount();
				$this->SelectedIndex = 0;
				while (!$rs->EOF) {
					$this->SelectedIndex++;
					$row = $rs->fields;
					$Processed = $this->Row_CustomAction($UserAction, $row);
					if (!$Processed) break;
					$rs->MoveNext();
				}
				if ($Processed) {
					$conn->CommitTrans(); // Commit the changes
					if ($this->getSuccessMessage() == "")
						$this->setSuccessMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionCompleted"))); // Set up success message
				} else {
					$conn->RollbackTrans(); // Rollback changes

					// Set up error message
					if ($this->getSuccessMessage() <> "" || $this->getFailureMessage() <> "") {

						// Use the message, do nothing
					} elseif ($this->CancelMessage <> "") {
						$this->setFailureMessage($this->CancelMessage);
						$this->CancelMessage = "";
					} else {
						$this->setFailureMessage(str_replace('%s', $ActionCaption, $Language->Phrase("CustomActionFailed")));
					}
				}
			}
			if ($rs)
				$rs->Close();
			$this->CurrentAction = ""; // Clear action
			if (@$_POST["ajax"] == $UserAction) { // Ajax
				if ($this->getSuccessMessage() <> "") {
					echo "<p class=\"text-success\">" . $this->getSuccessMessage() . "</p>";
					$this->ClearSuccessMessage(); // Clear message
				}
				if ($this->getFailureMessage() <> "") {
					echo "<p class=\"text-danger\">" . $this->getFailureMessage() . "</p>";
					$this->ClearFailureMessage(); // Clear message
				}
				return TRUE;
			}
		}
		return FALSE; // Not ajax request
	}

	// Set up search options
	function SetupSearchOptions() {
		global $Language;
		$this->SearchOptions = new cListOptions();
		$this->SearchOptions->Tag = "div";
		$this->SearchOptions->TagClassName = "ewSearchOption";

		// Search button
		$item = &$this->SearchOptions->Add("searchtoggle");
		$SearchToggleClass = ($this->SearchWhere <> "") ? " active" : " active";
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fviewavaluosofprocesadoslistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
		$item->Visible = TRUE;

		// Show all button
		$item = &$this->SearchOptions->Add("showall");
		$item->Body = "<a class=\"btn btn-default ewShowAll\" title=\"" . $Language->Phrase("ShowAll") . "\" data-caption=\"" . $Language->Phrase("ShowAll") . "\" href=\"" . $this->PageUrl() . "cmd=reset\">" . $Language->Phrase("ShowAllBtn") . "</a>";
		$item->Visible = ($this->SearchWhere <> $this->DefaultSearchWhere && $this->SearchWhere <> "0=101");

		// Button group for search
		$this->SearchOptions->UseDropDownButton = FALSE;
		$this->SearchOptions->UseImageAndText = TRUE;
		$this->SearchOptions->UseButtonGroup = TRUE;
		$this->SearchOptions->DropDownButtonPhrase = $Language->Phrase("ButtonSearch");

		// Add group option item
		$item = &$this->SearchOptions->Add($this->SearchOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;

		// Hide search options
		if ($this->Export <> "" || $this->CurrentAction <> "")
			$this->SearchOptions->HideAllOptions();
		global $Security;
		if (!$Security->CanSearch()) {
			$this->SearchOptions->HideAllOptions();
			$this->FilterOptions->HideAllOptions();
		}
	}

	function SetupListOptionsExt() {
		global $Security, $Language;
	}

	function RenderListOptionsExt() {
		global $Security, $Language;
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

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// id

		$this->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		if ($this->id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// tipoinmueble
		$this->tipoinmueble->AdvancedSearch->SearchValue = @$_GET["x_tipoinmueble"];
		if ($this->tipoinmueble->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->tipoinmueble->AdvancedSearch->SearchOperator = @$_GET["z_tipoinmueble"];

		// codigoavaluo
		$this->codigoavaluo->AdvancedSearch->SearchValue = @$_GET["x_codigoavaluo"];
		if ($this->codigoavaluo->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->codigoavaluo->AdvancedSearch->SearchOperator = @$_GET["z_codigoavaluo"];

		// id_solicitud
		$this->id_solicitud->AdvancedSearch->SearchValue = @$_GET["x_id_solicitud"];
		if ($this->id_solicitud->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id_solicitud->AdvancedSearch->SearchOperator = @$_GET["z_id_solicitud"];

		// id_oficialcredito
		$this->id_oficialcredito->AdvancedSearch->SearchValue = @$_GET["x_id_oficialcredito"];
		if ($this->id_oficialcredito->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id_oficialcredito->AdvancedSearch->SearchOperator = @$_GET["z_id_oficialcredito"];

		// id_inspector
		$this->id_inspector->AdvancedSearch->SearchValue = @$_GET["x_id_inspector"];
		if ($this->id_inspector->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id_inspector->AdvancedSearch->SearchOperator = @$_GET["z_id_inspector"];

		// estado
		$this->estado->AdvancedSearch->SearchValue = @$_GET["x_estado"];
		if ($this->estado->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->estado->AdvancedSearch->SearchOperator = @$_GET["z_estado"];

		// estadopago
		$this->estadopago->AdvancedSearch->SearchValue = @$_GET["x_estadopago"];
		if ($this->estadopago->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->estadopago->AdvancedSearch->SearchOperator = @$_GET["z_estadopago"];

		// fecha_avaluo
		$this->fecha_avaluo->AdvancedSearch->SearchValue = @$_GET["x_fecha_avaluo"];
		if ($this->fecha_avaluo->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->fecha_avaluo->AdvancedSearch->SearchOperator = @$_GET["z_fecha_avaluo"];

		// comentario
		$this->comentario->AdvancedSearch->SearchValue = @$_GET["x_comentario"];
		if ($this->comentario->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->comentario->AdvancedSearch->SearchOperator = @$_GET["z_comentario"];
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
		$this->id_sucursal->setDbValue($row['id_sucursal']);
		$this->informe->Upload->DbValue = $row['informe'];
		if (is_array($this->informe->Upload->DbValue) || is_object($this->informe->Upload->DbValue)) // Byte array
			$this->informe->Upload->DbValue = ew_BytesToStr($this->informe->Upload->DbValue);
		$this->comentario->setDbValue($row['comentario']);
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
		$row['id_sucursal'] = NULL;
		$row['informe'] = NULL;
		$row['comentario'] = NULL;
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
		$this->id_sucursal->DbValue = $row['id_sucursal'];
		$this->informe->Upload->DbValue = $row['informe'];
		$this->comentario->DbValue = $row['comentario'];
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
		$this->ViewUrl = $this->GetViewUrl();
		$this->EditUrl = $this->GetEditUrl();
		$this->InlineEditUrl = $this->GetInlineEditUrl();
		$this->CopyUrl = $this->GetCopyUrl();
		$this->InlineCopyUrl = $this->GetInlineCopyUrl();
		$this->DeleteUrl = $this->GetDeleteUrl();

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id

		$this->id->CellCssStyle = "white-space: nowrap;";

		// tipoinmueble
		// codigoavaluo
		// id_solicitud
		// id_oficialcredito

		$this->id_oficialcredito->CellCssStyle = "white-space: nowrap;";

		// id_inspector
		$this->id_inspector->CellCssStyle = "white-space: nowrap;";

		// id_cliente
		$this->id_cliente->CellCssStyle = "white-space: nowrap;";

		// is_active
		$this->is_active->CellCssStyle = "white-space: nowrap;";

		// estado
		$this->estado->CellCssStyle = "white-space: nowrap;";

		// estadointerno
		$this->estadointerno->CellCssStyle = "white-space: nowrap;";

		// estadopago
		$this->estadopago->CellCssStyle = "white-space: nowrap;";

		// fecha_avaluo
		// montoincial

		$this->montoincial->CellCssStyle = "white-space: nowrap;";

		// id_metodopago
		$this->id_metodopago->CellCssStyle = "white-space: nowrap;";

		// created_at
		$this->created_at->CellCssStyle = "white-space: nowrap;";

		// DateModified
		$this->DateModified->CellCssStyle = "white-space: nowrap;";

		// DateDeleted
		$this->DateDeleted->CellCssStyle = "white-space: nowrap;";

		// CreatedBy
		$this->CreatedBy->CellCssStyle = "white-space: nowrap;";

		// ModifiedBy
		$this->ModifiedBy->CellCssStyle = "white-space: nowrap;";

		// DeletedBy
		$this->DeletedBy->CellCssStyle = "white-space: nowrap;";

		// id_sucursal
		// informe
		// comentario

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

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
		$this->id_oficialcredito->ViewValue = $this->id_oficialcredito->CurrentValue;
		$this->id_oficialcredito->ViewCustomAttributes = "";

		// id_inspector
		if (strval($this->id_inspector->CurrentValue) <> "") {
			$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_inspector->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
		$sWhereWrk = "";
		$this->id_inspector->LookupFilters = array();
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
		$this->id_inspector->ViewCustomAttributes = "";

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

		// informe
		if (!ew_Empty($this->informe->Upload->DbValue)) {
			$this->informe->ViewValue = "viewavaluosofprocesados_informe_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->informe->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->informe->Upload->DbValue, 0, 11)));
		} else {
			$this->informe->ViewValue = "";
		}
		$this->informe->ViewCustomAttributes = "";

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

			// informe
			$this->informe->LinkCustomAttributes = "";
			if (!empty($this->informe->Upload->DbValue)) {
				$this->informe->HrefValue = "viewavaluosofprocesados_informe_bv.php?id=" . $this->id->CurrentValue;
				$this->informe->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->informe->HrefValue = ew_FullUrl($this->informe->HrefValue, "href");
			} else {
				$this->informe->HrefValue = "";
			}
			$this->informe->HrefValue2 = "viewavaluosofprocesados_informe_bv.php?id=" . $this->id->CurrentValue;
			$this->informe->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// tipoinmueble
			$this->tipoinmueble->EditAttrs["class"] = "form-control";
			$this->tipoinmueble->EditCustomAttributes = "";

			// codigoavaluo
			$this->codigoavaluo->EditAttrs["class"] = "form-control";
			$this->codigoavaluo->EditCustomAttributes = "";
			$this->codigoavaluo->EditValue = ew_HtmlEncode($this->codigoavaluo->AdvancedSearch->SearchValue);
			$this->codigoavaluo->PlaceHolder = ew_RemoveHtml($this->codigoavaluo->FldTitle());

			// id_solicitud
			$this->id_solicitud->EditAttrs["class"] = "form-control";
			$this->id_solicitud->EditCustomAttributes = "";

			// id_oficialcredito
			$this->id_oficialcredito->EditAttrs["class"] = "form-control";
			$this->id_oficialcredito->EditCustomAttributes = "";
			$this->id_oficialcredito->EditValue = ew_HtmlEncode($this->id_oficialcredito->AdvancedSearch->SearchValue);
			$this->id_oficialcredito->PlaceHolder = ew_RemoveHtml($this->id_oficialcredito->FldTitle());

			// id_inspector
			$this->id_inspector->EditAttrs["class"] = "form-control";
			$this->id_inspector->EditCustomAttributes = "";

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";

			// estadopago
			$this->estadopago->EditAttrs["class"] = "form-control";
			$this->estadopago->EditCustomAttributes = "";

			// fecha_avaluo
			$this->fecha_avaluo->EditAttrs["class"] = "form-control";
			$this->fecha_avaluo->EditCustomAttributes = "";
			$this->fecha_avaluo->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->fecha_avaluo->AdvancedSearch->SearchValue, 0), 8));
			$this->fecha_avaluo->PlaceHolder = ew_RemoveHtml($this->fecha_avaluo->FldTitle());

			// informe
			$this->informe->EditAttrs["class"] = "form-control";
			$this->informe->EditCustomAttributes = "";
			if (!ew_Empty($this->informe->Upload->DbValue)) {
				$this->informe->EditValue = "viewavaluosofprocesados_informe_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->informe->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->informe->Upload->DbValue, 0, 11)));
			} else {
				$this->informe->EditValue = "";
			}
		}
		if ($this->RowType == EW_ROWTYPE_ADD || $this->RowType == EW_ROWTYPE_EDIT || $this->RowType == EW_ROWTYPE_SEARCH) // Add/Edit/Search row
			$this->SetupFieldTitles();

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
	}

	// Validate search
	function ValidateSearch() {
		global $gsSearchError;

		// Initialize
		$gsSearchError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return TRUE;

		// Return validate result
		$ValidateSearch = ($gsSearchError == "");

		// Call Form_CustomValidate event
		$sFormCustomError = "";
		$ValidateSearch = $ValidateSearch && $this->Form_CustomValidate($sFormCustomError);
		if ($sFormCustomError <> "") {
			ew_AddMessage($gsSearchError, $sFormCustomError);
		}
		return $ValidateSearch;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->id->AdvancedSearch->Load();
		$this->tipoinmueble->AdvancedSearch->Load();
		$this->codigoavaluo->AdvancedSearch->Load();
		$this->id_solicitud->AdvancedSearch->Load();
		$this->id_oficialcredito->AdvancedSearch->Load();
		$this->id_inspector->AdvancedSearch->Load();
		$this->estado->AdvancedSearch->Load();
		$this->estadopago->AdvancedSearch->Load();
		$this->fecha_avaluo->AdvancedSearch->Load();
		$this->comentario->AdvancedSearch->Load();
	}

	// Set up export options
	function SetupExportOptions() {
		global $Language;

		// Printer friendly
		$item = &$this->ExportOptions->Add("print");
		$item->Body = "<a href=\"" . $this->ExportPrintUrl . "\" class=\"ewExportLink ewPrint\" title=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("PrinterFriendlyText")) . "\">" . $Language->Phrase("PrinterFriendly") . "</a>";
		$item->Visible = TRUE;

		// Export to Excel
		$item = &$this->ExportOptions->Add("excel");
		$item->Body = "<a href=\"" . $this->ExportExcelUrl . "\" class=\"ewExportLink ewExcel\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToExcelText")) . "\">" . $Language->Phrase("ExportToExcel") . "</a>";
		$item->Visible = TRUE;

		// Export to Word
		$item = &$this->ExportOptions->Add("word");
		$item->Body = "<a href=\"" . $this->ExportWordUrl . "\" class=\"ewExportLink ewWord\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToWordText")) . "\">" . $Language->Phrase("ExportToWord") . "</a>";
		$item->Visible = TRUE;

		// Export to Html
		$item = &$this->ExportOptions->Add("html");
		$item->Body = "<a href=\"" . $this->ExportHtmlUrl . "\" class=\"ewExportLink ewHtml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToHtmlText")) . "\">" . $Language->Phrase("ExportToHtml") . "</a>";
		$item->Visible = FALSE;

		// Export to Xml
		$item = &$this->ExportOptions->Add("xml");
		$item->Body = "<a href=\"" . $this->ExportXmlUrl . "\" class=\"ewExportLink ewXml\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToXmlText")) . "\">" . $Language->Phrase("ExportToXml") . "</a>";
		$item->Visible = FALSE;

		// Export to Csv
		$item = &$this->ExportOptions->Add("csv");
		$item->Body = "<a href=\"" . $this->ExportCsvUrl . "\" class=\"ewExportLink ewCsv\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToCsvText")) . "\">" . $Language->Phrase("ExportToCsv") . "</a>";
		$item->Visible = FALSE;

		// Export to Pdf
		$item = &$this->ExportOptions->Add("pdf");
		$item->Body = "<a href=\"" . $this->ExportPdfUrl . "\" class=\"ewExportLink ewPdf\" title=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\" data-caption=\"" . ew_HtmlEncode($Language->Phrase("ExportToPDFText")) . "\">" . $Language->Phrase("ExportToPDF") . "</a>";
		$item->Visible = FALSE;

		// Export to Email
		$item = &$this->ExportOptions->Add("email");
		$url = "";
		$item->Body = "<button id=\"emf_viewavaluosofprocesados\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_viewavaluosofprocesados',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fviewavaluosofprocesadoslist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
		$item->Visible = TRUE;

		// Drop down button for export
		$this->ExportOptions->UseButtonGroup = TRUE;
		$this->ExportOptions->UseImageAndText = TRUE;
		$this->ExportOptions->UseDropDownButton = TRUE;
		if ($this->ExportOptions->UseButtonGroup && ew_IsMobile())
			$this->ExportOptions->UseDropDownButton = TRUE;
		$this->ExportOptions->DropDownButtonPhrase = $Language->Phrase("ButtonExport");

		// Add group option item
		$item = &$this->ExportOptions->Add($this->ExportOptions->GroupOptionName);
		$item->Body = "";
		$item->Visible = FALSE;
	}

	// Export data in HTML/CSV/Word/Excel/XML/Email/PDF format
	function ExportData() {
		$utf8 = (strtolower(EW_CHARSET) == "utf-8");
		$bSelectLimit = $this->UseSelectLimit;

		// Load recordset
		if ($bSelectLimit) {
			$this->TotalRecs = $this->ListRecordCount();
		} else {
			if (!$this->Recordset)
				$this->Recordset = $this->LoadRecordset();
			$rs = &$this->Recordset;
			if ($rs)
				$this->TotalRecs = $rs->RecordCount();
		}
		$this->StartRec = 1;

		// Export all
		if ($this->ExportAll) {
			set_time_limit(EW_EXPORT_ALL_TIME_LIMIT);
			$this->DisplayRecs = $this->TotalRecs;
			$this->StopRec = $this->TotalRecs;
		} else { // Export one page only
			$this->SetupStartRec(); // Set up start record position

			// Set the last record to display
			if ($this->DisplayRecs <= 0) {
				$this->StopRec = $this->TotalRecs;
			} else {
				$this->StopRec = $this->StartRec + $this->DisplayRecs - 1;
			}
		}
		if ($bSelectLimit)
			$rs = $this->LoadRecordset($this->StartRec-1, $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs);
		if (!$rs) {
			header("Content-Type:"); // Remove header
			header("Content-Disposition:");
			$this->ShowMessage();
			return;
		}
		$this->ExportDoc = ew_ExportDocument($this, "h");
		$Doc = &$this->ExportDoc;
		if ($bSelectLimit) {
			$this->StartRec = 1;
			$this->StopRec = $this->DisplayRecs <= 0 ? $this->TotalRecs : $this->DisplayRecs;
		} else {

			//$this->StartRec = $this->StartRec;
			//$this->StopRec = $this->StopRec;

		}

		// Call Page Exporting server event
		$this->ExportDoc->ExportCustom = !$this->Page_Exporting();
		$ParentTable = "";
		$sHeader = $this->PageHeader;
		$this->Page_DataRendering($sHeader);
		$Doc->Text .= $sHeader;
		$this->ExportDocument($Doc, $rs, $this->StartRec, $this->StopRec, "");
		$sFooter = $this->PageFooter;
		$this->Page_DataRendered($sFooter);
		$Doc->Text .= $sFooter;

		// Close recordset
		$rs->Close();

		// Call Page Exported server event
		$this->Page_Exported();

		// Export header and footer
		$Doc->ExportHeaderAndFooter();

		// Clean output buffer
		if (!EW_DEBUG_ENABLED && ob_get_length())
			ob_end_clean();

		// Write debug message if enabled
		if (EW_DEBUG_ENABLED && $this->Export <> "pdf")
			echo ew_DebugMsg();

		// Output data
		if ($this->Export == "email") {
			echo $this->ExportEmail($Doc->Text);
		} else {
			$Doc->Export();
		}
	}

	// Export email
	function ExportEmail($EmailContent) {
		global $gTmpImages, $Language;
		$sSender = @$_POST["sender"];
		$sRecipient = @$_POST["recipient"];
		$sCc = @$_POST["cc"];
		$sBcc = @$_POST["bcc"];

		// Subject
		$sSubject = @$_POST["subject"];
		$sEmailSubject = $sSubject;

		// Message
		$sContent = @$_POST["message"];
		$sEmailMessage = $sContent;

		// Check sender
		if ($sSender == "") {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterSenderEmail") . "</p>";
		}
		if (!ew_CheckEmail($sSender)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperSenderEmail") . "</p>";
		}

		// Check recipient
		if (!ew_CheckEmailList($sRecipient, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperRecipientEmail") . "</p>";
		}

		// Check cc
		if (!ew_CheckEmailList($sCc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperCcEmail") . "</p>";
		}

		// Check bcc
		if (!ew_CheckEmailList($sBcc, EW_MAX_EMAIL_RECIPIENT)) {
			return "<p class=\"text-danger\">" . $Language->Phrase("EnterProperBccEmail") . "</p>";
		}

		// Check email sent count
		if (!isset($_SESSION[EW_EXPORT_EMAIL_COUNTER]))
			$_SESSION[EW_EXPORT_EMAIL_COUNTER] = 0;
		if (intval($_SESSION[EW_EXPORT_EMAIL_COUNTER]) > EW_MAX_EMAIL_SENT_COUNT) {
			return "<p class=\"text-danger\">" . $Language->Phrase("ExceedMaxEmailExport") . "</p>";
		}

		// Send email
		$Email = new cEmail();
		$Email->Sender = $sSender; // Sender
		$Email->Recipient = $sRecipient; // Recipient
		$Email->Cc = $sCc; // Cc
		$Email->Bcc = $sBcc; // Bcc
		$Email->Subject = $sEmailSubject; // Subject
		$Email->Format = "html";
		if ($sEmailMessage <> "")
			$sEmailMessage = ew_RemoveXSS($sEmailMessage) . "<br><br>";
		foreach ($gTmpImages as $tmpimage)
			$Email->AddEmbeddedImage($tmpimage);
		$Email->Content = $sEmailMessage . ew_CleanEmailContent($EmailContent); // Content
		$EventArgs = array();
		if ($this->Recordset) {
			$this->RecCnt = $this->StartRec - 1;
			$this->Recordset->MoveFirst();
			if ($this->StartRec > 1)
				$this->Recordset->Move($this->StartRec - 1);
			$EventArgs["rs"] = &$this->Recordset;
		}
		$bEmailSent = FALSE;
		if ($this->Email_Sending($Email, $EventArgs))
			$bEmailSent = $Email->Send();

		// Check email sent status
		if ($bEmailSent) {

			// Update email sent count
			$_SESSION[EW_EXPORT_EMAIL_COUNTER]++;

			// Sent email success
			return "<p class=\"text-success\">" . $Language->Phrase("SendEmailSuccess") . "</p>"; // Set up success message
		} else {

			// Sent email failure
			return "<p class=\"text-danger\">" . $Email->SendErrDescription . "</p>";
		}
	}

	// Export QueryString
	function ExportQueryString() {

		// Initialize
		$sQry = "export=html";

		// Build QueryString for search
		$this->AddSearchQueryString($sQry, $this->id); // id
		$this->AddSearchQueryString($sQry, $this->tipoinmueble); // tipoinmueble
		$this->AddSearchQueryString($sQry, $this->codigoavaluo); // codigoavaluo
		$this->AddSearchQueryString($sQry, $this->id_solicitud); // id_solicitud
		$this->AddSearchQueryString($sQry, $this->id_oficialcredito); // id_oficialcredito
		$this->AddSearchQueryString($sQry, $this->id_inspector); // id_inspector
		$this->AddSearchQueryString($sQry, $this->id_cliente); // id_cliente
		$this->AddSearchQueryString($sQry, $this->estado); // estado
		$this->AddSearchQueryString($sQry, $this->estadopago); // estadopago
		$this->AddSearchQueryString($sQry, $this->fecha_avaluo); // fecha_avaluo
		$this->AddSearchQueryString($sQry, $this->comentario); // comentario

		// Build QueryString for pager
		$sQry .= "&" . EW_TABLE_REC_PER_PAGE . "=" . urlencode($this->getRecordsPerPage()) . "&" . EW_TABLE_START_REC . "=" . urlencode($this->getStartRecordNumber());
		return $sQry;
	}

	// Add search QueryString
	function AddSearchQueryString(&$Qry, &$Fld) {
		$FldSearchValue = $Fld->AdvancedSearch->getValue("x");
		$FldParm = substr($Fld->FldVar,2);
		if (strval($FldSearchValue) <> "") {
			$Qry .= "&x_" . $FldParm . "=" . urlencode($FldSearchValue) .
				"&z_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("z"));
		}
		$FldSearchValue2 = $Fld->AdvancedSearch->getValue("y");
		if (strval($FldSearchValue2) <> "") {
			$Qry .= "&v_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("v")) .
				"&y_" . $FldParm . "=" . urlencode($FldSearchValue2) .
				"&w_" . $FldParm . "=" . urlencode($Fld->AdvancedSearch->getValue("w"));
		}
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
	}

	// Setup lookup filters of a field
	function SetupLookupFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
		case "x_id_cliente":
			$sSqlWrk = "";
				$sSqlWrk = "SELECT `id` AS `LinkFld`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, `email` AS `Disp3Fld`, `phone` AS `Disp4Fld` FROM `cliente`";
				$sWhereWrk = "";
				$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
				$this->Lookup_Selecting($this->id_cliente, $sWhereWrk); // Call Lookup Selecting
				if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
			}
		}
	}

	// Setup AutoSuggest filters of a field
	function SetupAutoSuggestFilters($fld, $pageId = null) {
		global $gsLanguage;
		$pageId = $pageId ?: $this->PageID;
		if ($pageId == "list") {
			switch ($fld->FldVar) {
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
			}
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

	// ListOptions Load event
	function ListOptions_Load() {

		// Example:
		//$opt = &$this->ListOptions->Add("new");
		//$opt->Header = "xxx";
		//$opt->OnLeft = TRUE; // Link on left
		//$opt->MoveTo(0); // Move to first column

	}

	// ListOptions Rendering event
	function ListOptions_Rendering() {

		//$GLOBALS["xxx_grid"]->DetailAdd = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailEdit = (...condition...); // Set to TRUE or FALSE conditionally
		//$GLOBALS["xxx_grid"]->DetailView = (...condition...); // Set to TRUE or FALSE conditionally

	}

	// ListOptions Rendered event
	function ListOptions_Rendered() {

		// Example:
		//$this->ListOptions->Items["new"]->Body = "xxx";

	}

	// Row Custom Action event
	function Row_CustomAction($action, $row) {

		// Return FALSE to abort
		return TRUE;
	}

	// Page Exporting event
	// $this->ExportDoc = export document object
	function Page_Exporting() {

		//$this->ExportDoc->Text = "my header"; // Export header
		//return FALSE; // Return FALSE to skip default export and use Row_Export event

		return TRUE; // Return TRUE to use default export and skip Row_Export event
	}

	// Row Export event
	// $this->ExportDoc = export document object
	function Row_Export($rs) {

		//$this->ExportDoc->Text .= "my content"; // Build HTML with field value: $rs["MyField"] or $this->MyField->ViewValue
	}

	// Page Exported event
	// $this->ExportDoc = export document object
	function Page_Exported() {

		//$this->ExportDoc->Text .= "my footer"; // Export footer
		//echo $this->ExportDoc->Text;

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($viewavaluosofprocesados_list)) $viewavaluosofprocesados_list = new cviewavaluosofprocesados_list();

// Page init
$viewavaluosofprocesados_list->Page_Init();

// Page main
$viewavaluosofprocesados_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewavaluosofprocesados_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($viewavaluosofprocesados->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fviewavaluosofprocesadoslist = new ew_Form("fviewavaluosofprocesadoslist", "list");
fviewavaluosofprocesadoslist.FormKeyCountName = '<?php echo $viewavaluosofprocesados_list->FormKeyCountName ?>';

// Form_CustomValidate event
fviewavaluosofprocesadoslist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluosofprocesadoslist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluosofprocesadoslist.Lists["x_tipoinmueble"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewavaluosofprocesadoslist.Lists["x_tipoinmueble"].Data = "<?php echo $viewavaluosofprocesados_list->tipoinmueble->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluosofprocesadoslist.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","x__email",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
fviewavaluosofprocesadoslist.Lists["x_id_solicitud"].Data = "<?php echo $viewavaluosofprocesados_list->id_solicitud->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluosofprocesadoslist.Lists["x_id_inspector"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"inspector"};
fviewavaluosofprocesadoslist.Lists["x_id_inspector"].Data = "<?php echo $viewavaluosofprocesados_list->id_inspector->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluosofprocesadoslist.Lists["x_estado"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estado"};
fviewavaluosofprocesadoslist.Lists["x_estado"].Data = "<?php echo $viewavaluosofprocesados_list->estado->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluosofprocesadoslist.Lists["x_estadopago"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadopago"};
fviewavaluosofprocesadoslist.Lists["x_estadopago"].Data = "<?php echo $viewavaluosofprocesados_list->estadopago->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = fviewavaluosofprocesadoslistsrch = new ew_Form("fviewavaluosofprocesadoslistsrch");

// Validate function for search
fviewavaluosofprocesadoslistsrch.Validate = function(fobj) {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	fobj = fobj || this.Form;
	var infix = "";

	// Fire Form_CustomValidate event
	if (!this.Form_CustomValidate(fobj))
		return false;
	return true;
}

// Form_CustomValidate event
fviewavaluosofprocesadoslistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluosofprocesadoslistsrch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($viewavaluosofprocesados->Export == "") { ?>
<div class="ewToolbar">
<?php if ($viewavaluosofprocesados_list->TotalRecs > 0 && $viewavaluosofprocesados_list->ExportOptions->Visible()) { ?>
<?php $viewavaluosofprocesados_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($viewavaluosofprocesados_list->SearchOptions->Visible()) { ?>
<?php $viewavaluosofprocesados_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($viewavaluosofprocesados_list->FilterOptions->Visible()) { ?>
<?php $viewavaluosofprocesados_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $viewavaluosofprocesados_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($viewavaluosofprocesados_list->TotalRecs <= 0)
			$viewavaluosofprocesados_list->TotalRecs = $viewavaluosofprocesados->ListRecordCount();
	} else {
		if (!$viewavaluosofprocesados_list->Recordset && ($viewavaluosofprocesados_list->Recordset = $viewavaluosofprocesados_list->LoadRecordset()))
			$viewavaluosofprocesados_list->TotalRecs = $viewavaluosofprocesados_list->Recordset->RecordCount();
	}
	$viewavaluosofprocesados_list->StartRec = 1;
	if ($viewavaluosofprocesados_list->DisplayRecs <= 0 || ($viewavaluosofprocesados->Export <> "" && $viewavaluosofprocesados->ExportAll)) // Display all records
		$viewavaluosofprocesados_list->DisplayRecs = $viewavaluosofprocesados_list->TotalRecs;
	if (!($viewavaluosofprocesados->Export <> "" && $viewavaluosofprocesados->ExportAll))
		$viewavaluosofprocesados_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$viewavaluosofprocesados_list->Recordset = $viewavaluosofprocesados_list->LoadRecordset($viewavaluosofprocesados_list->StartRec-1, $viewavaluosofprocesados_list->DisplayRecs);

	// Set no record found message
	if ($viewavaluosofprocesados->CurrentAction == "" && $viewavaluosofprocesados_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$viewavaluosofprocesados_list->setWarningMessage(ew_DeniedMsg());
		if ($viewavaluosofprocesados_list->SearchWhere == "0=101")
			$viewavaluosofprocesados_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$viewavaluosofprocesados_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$viewavaluosofprocesados_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($viewavaluosofprocesados->Export == "" && $viewavaluosofprocesados->CurrentAction == "") { ?>
<form name="fviewavaluosofprocesadoslistsrch" id="fviewavaluosofprocesadoslistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($viewavaluosofprocesados_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fviewavaluosofprocesadoslistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="viewavaluosofprocesados">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$viewavaluosofprocesados_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$viewavaluosofprocesados->RowType = EW_ROWTYPE_SEARCH;

// Render row
$viewavaluosofprocesados->ResetAttrs();
$viewavaluosofprocesados_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($viewavaluosofprocesados->codigoavaluo->Visible) { // codigoavaluo ?>
	<div id="xsc_codigoavaluo" class="ewCell form-group">
		<label for="x_codigoavaluo" class="ewSearchCaption ewLabel"><?php echo $viewavaluosofprocesados->codigoavaluo->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_codigoavaluo" id="z_codigoavaluo" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" data-table="viewavaluosofprocesados" data-field="x_codigoavaluo" name="x_codigoavaluo" id="x_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewavaluosofprocesados->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluosofprocesados->codigoavaluo->EditValue ?>"<?php echo $viewavaluosofprocesados->codigoavaluo->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $viewavaluosofprocesados_list->ShowPageHeader(); ?>
<?php
$viewavaluosofprocesados_list->ShowMessage();
?>
<?php if ($viewavaluosofprocesados_list->TotalRecs > 0 || $viewavaluosofprocesados->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($viewavaluosofprocesados_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewavaluosofprocesados">
<form name="fviewavaluosofprocesadoslist" id="fviewavaluosofprocesadoslist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewavaluosofprocesados_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewavaluosofprocesados_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewavaluosofprocesados">
<div id="gmp_viewavaluosofprocesados" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($viewavaluosofprocesados_list->TotalRecs > 0 || $viewavaluosofprocesados->CurrentAction == "gridedit") { ?>
<table id="tbl_viewavaluosofprocesadoslist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$viewavaluosofprocesados_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$viewavaluosofprocesados_list->RenderListOptions();

// Render list options (header, left)
$viewavaluosofprocesados_list->ListOptions->Render("header", "left");
?>
<?php if ($viewavaluosofprocesados->tipoinmueble->Visible) { // tipoinmueble ?>
	<?php if ($viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->tipoinmueble) == "") { ?>
		<th data-name="tipoinmueble" class="<?php echo $viewavaluosofprocesados->tipoinmueble->HeaderCellClass() ?>"><div id="elh_viewavaluosofprocesados_tipoinmueble" class="viewavaluosofprocesados_tipoinmueble"><div class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->tipoinmueble->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipoinmueble" class="<?php echo $viewavaluosofprocesados->tipoinmueble->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->tipoinmueble) ?>',1);"><div id="elh_viewavaluosofprocesados_tipoinmueble" class="viewavaluosofprocesados_tipoinmueble">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->tipoinmueble->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosofprocesados->tipoinmueble->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosofprocesados->tipoinmueble->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosofprocesados->codigoavaluo->Visible) { // codigoavaluo ?>
	<?php if ($viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->codigoavaluo) == "") { ?>
		<th data-name="codigoavaluo" class="<?php echo $viewavaluosofprocesados->codigoavaluo->HeaderCellClass() ?>"><div id="elh_viewavaluosofprocesados_codigoavaluo" class="viewavaluosofprocesados_codigoavaluo"><div class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->codigoavaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigoavaluo" class="<?php echo $viewavaluosofprocesados->codigoavaluo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->codigoavaluo) ?>',1);"><div id="elh_viewavaluosofprocesados_codigoavaluo" class="viewavaluosofprocesados_codigoavaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->codigoavaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosofprocesados->codigoavaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosofprocesados->codigoavaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosofprocesados->id_solicitud->Visible) { // id_solicitud ?>
	<?php if ($viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->id_solicitud) == "") { ?>
		<th data-name="id_solicitud" class="<?php echo $viewavaluosofprocesados->id_solicitud->HeaderCellClass() ?>"><div id="elh_viewavaluosofprocesados_id_solicitud" class="viewavaluosofprocesados_id_solicitud"><div class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->id_solicitud->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_solicitud" class="<?php echo $viewavaluosofprocesados->id_solicitud->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->id_solicitud) ?>',1);"><div id="elh_viewavaluosofprocesados_id_solicitud" class="viewavaluosofprocesados_id_solicitud">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->id_solicitud->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosofprocesados->id_solicitud->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosofprocesados->id_solicitud->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosofprocesados->id_oficialcredito->Visible) { // id_oficialcredito ?>
	<?php if ($viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->id_oficialcredito) == "") { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluosofprocesados->id_oficialcredito->HeaderCellClass() ?>"><div id="elh_viewavaluosofprocesados_id_oficialcredito" class="viewavaluosofprocesados_id_oficialcredito"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluosofprocesados->id_oficialcredito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluosofprocesados->id_oficialcredito->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->id_oficialcredito) ?>',1);"><div id="elh_viewavaluosofprocesados_id_oficialcredito" class="viewavaluosofprocesados_id_oficialcredito">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->id_oficialcredito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosofprocesados->id_oficialcredito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosofprocesados->id_oficialcredito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosofprocesados->id_inspector->Visible) { // id_inspector ?>
	<?php if ($viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->id_inspector) == "") { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluosofprocesados->id_inspector->HeaderCellClass() ?>"><div id="elh_viewavaluosofprocesados_id_inspector" class="viewavaluosofprocesados_id_inspector"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluosofprocesados->id_inspector->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluosofprocesados->id_inspector->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->id_inspector) ?>',1);"><div id="elh_viewavaluosofprocesados_id_inspector" class="viewavaluosofprocesados_id_inspector">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->id_inspector->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosofprocesados->id_inspector->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosofprocesados->id_inspector->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosofprocesados->estado->Visible) { // estado ?>
	<?php if ($viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->estado) == "") { ?>
		<th data-name="estado" class="<?php echo $viewavaluosofprocesados->estado->HeaderCellClass() ?>"><div id="elh_viewavaluosofprocesados_estado" class="viewavaluosofprocesados_estado"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluosofprocesados->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado" class="<?php echo $viewavaluosofprocesados->estado->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->estado) ?>',1);"><div id="elh_viewavaluosofprocesados_estado" class="viewavaluosofprocesados_estado">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->estado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosofprocesados->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosofprocesados->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosofprocesados->estadopago->Visible) { // estadopago ?>
	<?php if ($viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->estadopago) == "") { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluosofprocesados->estadopago->HeaderCellClass() ?>"><div id="elh_viewavaluosofprocesados_estadopago" class="viewavaluosofprocesados_estadopago"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluosofprocesados->estadopago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluosofprocesados->estadopago->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->estadopago) ?>',1);"><div id="elh_viewavaluosofprocesados_estadopago" class="viewavaluosofprocesados_estadopago">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->estadopago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosofprocesados->estadopago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosofprocesados->estadopago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosofprocesados->fecha_avaluo->Visible) { // fecha_avaluo ?>
	<?php if ($viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->fecha_avaluo) == "") { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluosofprocesados->fecha_avaluo->HeaderCellClass() ?>"><div id="elh_viewavaluosofprocesados_fecha_avaluo" class="viewavaluosofprocesados_fecha_avaluo"><div class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->fecha_avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluosofprocesados->fecha_avaluo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->fecha_avaluo) ?>',1);"><div id="elh_viewavaluosofprocesados_fecha_avaluo" class="viewavaluosofprocesados_fecha_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->fecha_avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosofprocesados->fecha_avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosofprocesados->fecha_avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosofprocesados->informe->Visible) { // informe ?>
	<?php if ($viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->informe) == "") { ?>
		<th data-name="informe" class="<?php echo $viewavaluosofprocesados->informe->HeaderCellClass() ?>"><div id="elh_viewavaluosofprocesados_informe" class="viewavaluosofprocesados_informe"><div class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->informe->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="informe" class="<?php echo $viewavaluosofprocesados->informe->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosofprocesados->SortUrl($viewavaluosofprocesados->informe) ?>',1);"><div id="elh_viewavaluosofprocesados_informe" class="viewavaluosofprocesados_informe">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosofprocesados->informe->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosofprocesados->informe->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosofprocesados->informe->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$viewavaluosofprocesados_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($viewavaluosofprocesados->ExportAll && $viewavaluosofprocesados->Export <> "") {
	$viewavaluosofprocesados_list->StopRec = $viewavaluosofprocesados_list->TotalRecs;
} else {

	// Set the last record to display
	if ($viewavaluosofprocesados_list->TotalRecs > $viewavaluosofprocesados_list->StartRec + $viewavaluosofprocesados_list->DisplayRecs - 1)
		$viewavaluosofprocesados_list->StopRec = $viewavaluosofprocesados_list->StartRec + $viewavaluosofprocesados_list->DisplayRecs - 1;
	else
		$viewavaluosofprocesados_list->StopRec = $viewavaluosofprocesados_list->TotalRecs;
}
$viewavaluosofprocesados_list->RecCnt = $viewavaluosofprocesados_list->StartRec - 1;
if ($viewavaluosofprocesados_list->Recordset && !$viewavaluosofprocesados_list->Recordset->EOF) {
	$viewavaluosofprocesados_list->Recordset->MoveFirst();
	$bSelectLimit = $viewavaluosofprocesados_list->UseSelectLimit;
	if (!$bSelectLimit && $viewavaluosofprocesados_list->StartRec > 1)
		$viewavaluosofprocesados_list->Recordset->Move($viewavaluosofprocesados_list->StartRec - 1);
} elseif (!$viewavaluosofprocesados->AllowAddDeleteRow && $viewavaluosofprocesados_list->StopRec == 0) {
	$viewavaluosofprocesados_list->StopRec = $viewavaluosofprocesados->GridAddRowCount;
}

// Initialize aggregate
$viewavaluosofprocesados->RowType = EW_ROWTYPE_AGGREGATEINIT;
$viewavaluosofprocesados->ResetAttrs();
$viewavaluosofprocesados_list->RenderRow();
while ($viewavaluosofprocesados_list->RecCnt < $viewavaluosofprocesados_list->StopRec) {
	$viewavaluosofprocesados_list->RecCnt++;
	if (intval($viewavaluosofprocesados_list->RecCnt) >= intval($viewavaluosofprocesados_list->StartRec)) {
		$viewavaluosofprocesados_list->RowCnt++;

		// Set up key count
		$viewavaluosofprocesados_list->KeyCount = $viewavaluosofprocesados_list->RowIndex;

		// Init row class and style
		$viewavaluosofprocesados->ResetAttrs();
		$viewavaluosofprocesados->CssClass = "";
		if ($viewavaluosofprocesados->CurrentAction == "gridadd") {
		} else {
			$viewavaluosofprocesados_list->LoadRowValues($viewavaluosofprocesados_list->Recordset); // Load row values
		}
		$viewavaluosofprocesados->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$viewavaluosofprocesados->RowAttrs = array_merge($viewavaluosofprocesados->RowAttrs, array('data-rowindex'=>$viewavaluosofprocesados_list->RowCnt, 'id'=>'r' . $viewavaluosofprocesados_list->RowCnt . '_viewavaluosofprocesados', 'data-rowtype'=>$viewavaluosofprocesados->RowType));

		// Render row
		$viewavaluosofprocesados_list->RenderRow();

		// Render list options
		$viewavaluosofprocesados_list->RenderListOptions();
?>
	<tr<?php echo $viewavaluosofprocesados->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewavaluosofprocesados_list->ListOptions->Render("body", "left", $viewavaluosofprocesados_list->RowCnt);
?>
	<?php if ($viewavaluosofprocesados->tipoinmueble->Visible) { // tipoinmueble ?>
		<td data-name="tipoinmueble"<?php echo $viewavaluosofprocesados->tipoinmueble->CellAttributes() ?>>
<span id="el<?php echo $viewavaluosofprocesados_list->RowCnt ?>_viewavaluosofprocesados_tipoinmueble" class="viewavaluosofprocesados_tipoinmueble">
<span<?php echo $viewavaluosofprocesados->tipoinmueble->ViewAttributes() ?>>
<?php echo $viewavaluosofprocesados->tipoinmueble->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluosofprocesados->codigoavaluo->Visible) { // codigoavaluo ?>
		<td data-name="codigoavaluo"<?php echo $viewavaluosofprocesados->codigoavaluo->CellAttributes() ?>>
<span id="el<?php echo $viewavaluosofprocesados_list->RowCnt ?>_viewavaluosofprocesados_codigoavaluo" class="viewavaluosofprocesados_codigoavaluo">
<span<?php echo $viewavaluosofprocesados->codigoavaluo->ViewAttributes() ?>>
<?php echo $viewavaluosofprocesados->codigoavaluo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluosofprocesados->id_solicitud->Visible) { // id_solicitud ?>
		<td data-name="id_solicitud"<?php echo $viewavaluosofprocesados->id_solicitud->CellAttributes() ?>>
<span id="el<?php echo $viewavaluosofprocesados_list->RowCnt ?>_viewavaluosofprocesados_id_solicitud" class="viewavaluosofprocesados_id_solicitud">
<span<?php echo $viewavaluosofprocesados->id_solicitud->ViewAttributes() ?>>
<?php echo $viewavaluosofprocesados->id_solicitud->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluosofprocesados->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<td data-name="id_oficialcredito"<?php echo $viewavaluosofprocesados->id_oficialcredito->CellAttributes() ?>>
<span id="el<?php echo $viewavaluosofprocesados_list->RowCnt ?>_viewavaluosofprocesados_id_oficialcredito" class="viewavaluosofprocesados_id_oficialcredito">
<span<?php echo $viewavaluosofprocesados->id_oficialcredito->ViewAttributes() ?>>
<?php echo $viewavaluosofprocesados->id_oficialcredito->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluosofprocesados->id_inspector->Visible) { // id_inspector ?>
		<td data-name="id_inspector"<?php echo $viewavaluosofprocesados->id_inspector->CellAttributes() ?>>
<span id="el<?php echo $viewavaluosofprocesados_list->RowCnt ?>_viewavaluosofprocesados_id_inspector" class="viewavaluosofprocesados_id_inspector">
<span<?php echo $viewavaluosofprocesados->id_inspector->ViewAttributes() ?>>
<?php echo $viewavaluosofprocesados->id_inspector->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluosofprocesados->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $viewavaluosofprocesados->estado->CellAttributes() ?>>
<span id="el<?php echo $viewavaluosofprocesados_list->RowCnt ?>_viewavaluosofprocesados_estado" class="viewavaluosofprocesados_estado">
<span<?php echo $viewavaluosofprocesados->estado->ViewAttributes() ?>>
<?php echo $viewavaluosofprocesados->estado->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluosofprocesados->estadopago->Visible) { // estadopago ?>
		<td data-name="estadopago"<?php echo $viewavaluosofprocesados->estadopago->CellAttributes() ?>>
<span id="el<?php echo $viewavaluosofprocesados_list->RowCnt ?>_viewavaluosofprocesados_estadopago" class="viewavaluosofprocesados_estadopago">
<span<?php echo $viewavaluosofprocesados->estadopago->ViewAttributes() ?>>
<?php echo $viewavaluosofprocesados->estadopago->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluosofprocesados->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<td data-name="fecha_avaluo"<?php echo $viewavaluosofprocesados->fecha_avaluo->CellAttributes() ?>>
<span id="el<?php echo $viewavaluosofprocesados_list->RowCnt ?>_viewavaluosofprocesados_fecha_avaluo" class="viewavaluosofprocesados_fecha_avaluo">
<span<?php echo $viewavaluosofprocesados->fecha_avaluo->ViewAttributes() ?>>
<?php echo $viewavaluosofprocesados->fecha_avaluo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluosofprocesados->informe->Visible) { // informe ?>
		<td data-name="informe"<?php echo $viewavaluosofprocesados->informe->CellAttributes() ?>>
<span id="el<?php echo $viewavaluosofprocesados_list->RowCnt ?>_viewavaluosofprocesados_informe" class="viewavaluosofprocesados_informe">
<span<?php echo $viewavaluosofprocesados->informe->ViewAttributes() ?>>
<?php echo ew_GetFileViewTag($viewavaluosofprocesados->informe, $viewavaluosofprocesados->informe->ListViewValue()) ?>
</span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewavaluosofprocesados_list->ListOptions->Render("body", "right", $viewavaluosofprocesados_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($viewavaluosofprocesados->CurrentAction <> "gridadd")
		$viewavaluosofprocesados_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($viewavaluosofprocesados->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($viewavaluosofprocesados_list->Recordset)
	$viewavaluosofprocesados_list->Recordset->Close();
?>
<?php if ($viewavaluosofprocesados->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($viewavaluosofprocesados->CurrentAction <> "gridadd" && $viewavaluosofprocesados->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($viewavaluosofprocesados_list->Pager)) $viewavaluosofprocesados_list->Pager = new cNumericPager($viewavaluosofprocesados_list->StartRec, $viewavaluosofprocesados_list->DisplayRecs, $viewavaluosofprocesados_list->TotalRecs, $viewavaluosofprocesados_list->RecRange, $viewavaluosofprocesados_list->AutoHidePager) ?>
<?php if ($viewavaluosofprocesados_list->Pager->RecordCount > 0 && $viewavaluosofprocesados_list->Pager->Visible) { ?>
<div class="ewPager">
<div class="ewNumericPage"><ul class="pagination">
	<?php if ($viewavaluosofprocesados_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluosofprocesados_list->PageUrl() ?>start=<?php echo $viewavaluosofprocesados_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($viewavaluosofprocesados_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluosofprocesados_list->PageUrl() ?>start=<?php echo $viewavaluosofprocesados_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($viewavaluosofprocesados_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $viewavaluosofprocesados_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($viewavaluosofprocesados_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluosofprocesados_list->PageUrl() ?>start=<?php echo $viewavaluosofprocesados_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($viewavaluosofprocesados_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluosofprocesados_list->PageUrl() ?>start=<?php echo $viewavaluosofprocesados_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($viewavaluosofprocesados_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $viewavaluosofprocesados_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $viewavaluosofprocesados_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $viewavaluosofprocesados_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($viewavaluosofprocesados_list->TotalRecs > 0 && (!$viewavaluosofprocesados_list->AutoHidePageSizeSelector || $viewavaluosofprocesados_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="viewavaluosofprocesados">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($viewavaluosofprocesados_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($viewavaluosofprocesados_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($viewavaluosofprocesados_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($viewavaluosofprocesados->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewavaluosofprocesados_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($viewavaluosofprocesados_list->TotalRecs == 0 && $viewavaluosofprocesados->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewavaluosofprocesados_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($viewavaluosofprocesados->Export == "") { ?>
<script type="text/javascript">
fviewavaluosofprocesadoslistsrch.FilterList = <?php echo $viewavaluosofprocesados_list->GetFilterList() ?>;
fviewavaluosofprocesadoslistsrch.Init();
fviewavaluosofprocesadoslist.Init();
</script>
<?php } ?>
<?php
$viewavaluosofprocesados_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($viewavaluosofprocesados->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$viewavaluosofprocesados_list->Page_Terminate();
?>
