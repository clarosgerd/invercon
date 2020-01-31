<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "viewsolicitudinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "viewavaluogridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$viewsolicitud_list = NULL; // Initialize page object first

class cviewsolicitud_list extends cviewsolicitud {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewsolicitud';

	// Page object name
	var $PageObjName = 'viewsolicitud_list';

	// Grid form hidden field names
	var $FormName = 'fviewsolicitudlist';
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

		// Table object (viewsolicitud)
		if (!isset($GLOBALS["viewsolicitud"]) || get_class($GLOBALS["viewsolicitud"]) == "cviewsolicitud") {
			$GLOBALS["viewsolicitud"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["viewsolicitud"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "viewsolicitudadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "viewsolicituddelete.php";
		$this->MultiUpdateUrl = "viewsolicitudupdate.php";

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'viewsolicitud', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fviewsolicitudlistsrch";

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
		$this->name->SetVisibility();
		$this->cell->SetVisibility();
		$this->phone->SetVisibility();
		$this->_email->SetVisibility();
		$this->address->SetVisibility();
		$this->email_contacto->SetVisibility();
		$this->lastname->SetVisibility();
		$this->tipoinmueble->SetVisibility();
		$this->tipovehiculo->SetVisibility();
		$this->tipomaquinaria->SetVisibility();
		$this->tipomercaderia->SetVisibility();
		$this->tipoespecial->SetVisibility();

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
				if (in_array("viewavaluo", $DetailTblVar)) {

					// Process auto fill for detail table 'viewavaluo'
					if (preg_match('/^fviewavaluo(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["viewavaluo_grid"])) $GLOBALS["viewavaluo_grid"] = new cviewavaluo_grid;
						$GLOBALS["viewavaluo_grid"]->Page_Init();
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
		global $EW_EXPORT, $viewsolicitud;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($viewsolicitud);
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
	var $viewavaluo_Count;
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
			$sSavedFilterList = $UserProfile->GetSearchFilters(CurrentUserName(), "fviewsolicitudlistsrch");
		$sFilterList = ew_Concat($sFilterList, $this->id->AdvancedSearch->ToJson(), ","); // Field id
		$sFilterList = ew_Concat($sFilterList, $this->name->AdvancedSearch->ToJson(), ","); // Field name
		$sFilterList = ew_Concat($sFilterList, $this->cell->AdvancedSearch->ToJson(), ","); // Field cell
		$sFilterList = ew_Concat($sFilterList, $this->phone->AdvancedSearch->ToJson(), ","); // Field phone
		$sFilterList = ew_Concat($sFilterList, $this->_email->AdvancedSearch->ToJson(), ","); // Field email
		$sFilterList = ew_Concat($sFilterList, $this->address->AdvancedSearch->ToJson(), ","); // Field address
		$sFilterList = ew_Concat($sFilterList, $this->nombre_contacto->AdvancedSearch->ToJson(), ","); // Field nombre_contacto
		$sFilterList = ew_Concat($sFilterList, $this->email_contacto->AdvancedSearch->ToJson(), ","); // Field email_contacto
		$sFilterList = ew_Concat($sFilterList, $this->lastname->AdvancedSearch->ToJson(), ","); // Field lastname
		$sFilterList = ew_Concat($sFilterList, $this->id_sucursal->AdvancedSearch->ToJson(), ","); // Field id_sucursal
		$sFilterList = ew_Concat($sFilterList, $this->tipoinmueble->AdvancedSearch->ToJson(), ","); // Field tipoinmueble
		$sFilterList = ew_Concat($sFilterList, $this->id_ciudad_inmueble->AdvancedSearch->ToJson(), ","); // Field id_ciudad_inmueble
		$sFilterList = ew_Concat($sFilterList, $this->id_provincia_inmueble->AdvancedSearch->ToJson(), ","); // Field id_provincia_inmueble
		$sFilterList = ew_Concat($sFilterList, $this->tipovehiculo->AdvancedSearch->ToJson(), ","); // Field tipovehiculo
		$sFilterList = ew_Concat($sFilterList, $this->id_ciudad_vehiculo->AdvancedSearch->ToJson(), ","); // Field id_ciudad_vehiculo
		$sFilterList = ew_Concat($sFilterList, $this->id_provincia_vehiculo->AdvancedSearch->ToJson(), ","); // Field id_provincia_vehiculo
		$sFilterList = ew_Concat($sFilterList, $this->tipomaquinaria->AdvancedSearch->ToJson(), ","); // Field tipomaquinaria
		$sFilterList = ew_Concat($sFilterList, $this->id_ciudad_maquinaria->AdvancedSearch->ToJson(), ","); // Field id_ciudad_maquinaria
		$sFilterList = ew_Concat($sFilterList, $this->id_provincia_maquinaria->AdvancedSearch->ToJson(), ","); // Field id_provincia_maquinaria
		$sFilterList = ew_Concat($sFilterList, $this->tipomercaderia->AdvancedSearch->ToJson(), ","); // Field tipomercaderia
		$sFilterList = ew_Concat($sFilterList, $this->documento_mercaderia->AdvancedSearch->ToJson(), ","); // Field documento_mercaderia
		$sFilterList = ew_Concat($sFilterList, $this->tipoespecial->AdvancedSearch->ToJson(), ","); // Field tipoespecial
		$sFilterList = ew_Concat($sFilterList, $this->is_active->AdvancedSearch->ToJson(), ","); // Field is_active
		$sFilterList = ew_Concat($sFilterList, $this->documentos->AdvancedSearch->ToJson(), ","); // Field documentos
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fviewsolicitudlistsrch", $filters);

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

		// Field name
		$this->name->AdvancedSearch->SearchValue = @$filter["x_name"];
		$this->name->AdvancedSearch->SearchOperator = @$filter["z_name"];
		$this->name->AdvancedSearch->SearchCondition = @$filter["v_name"];
		$this->name->AdvancedSearch->SearchValue2 = @$filter["y_name"];
		$this->name->AdvancedSearch->SearchOperator2 = @$filter["w_name"];
		$this->name->AdvancedSearch->Save();

		// Field cell
		$this->cell->AdvancedSearch->SearchValue = @$filter["x_cell"];
		$this->cell->AdvancedSearch->SearchOperator = @$filter["z_cell"];
		$this->cell->AdvancedSearch->SearchCondition = @$filter["v_cell"];
		$this->cell->AdvancedSearch->SearchValue2 = @$filter["y_cell"];
		$this->cell->AdvancedSearch->SearchOperator2 = @$filter["w_cell"];
		$this->cell->AdvancedSearch->Save();

		// Field phone
		$this->phone->AdvancedSearch->SearchValue = @$filter["x_phone"];
		$this->phone->AdvancedSearch->SearchOperator = @$filter["z_phone"];
		$this->phone->AdvancedSearch->SearchCondition = @$filter["v_phone"];
		$this->phone->AdvancedSearch->SearchValue2 = @$filter["y_phone"];
		$this->phone->AdvancedSearch->SearchOperator2 = @$filter["w_phone"];
		$this->phone->AdvancedSearch->Save();

		// Field email
		$this->_email->AdvancedSearch->SearchValue = @$filter["x__email"];
		$this->_email->AdvancedSearch->SearchOperator = @$filter["z__email"];
		$this->_email->AdvancedSearch->SearchCondition = @$filter["v__email"];
		$this->_email->AdvancedSearch->SearchValue2 = @$filter["y__email"];
		$this->_email->AdvancedSearch->SearchOperator2 = @$filter["w__email"];
		$this->_email->AdvancedSearch->Save();

		// Field address
		$this->address->AdvancedSearch->SearchValue = @$filter["x_address"];
		$this->address->AdvancedSearch->SearchOperator = @$filter["z_address"];
		$this->address->AdvancedSearch->SearchCondition = @$filter["v_address"];
		$this->address->AdvancedSearch->SearchValue2 = @$filter["y_address"];
		$this->address->AdvancedSearch->SearchOperator2 = @$filter["w_address"];
		$this->address->AdvancedSearch->Save();

		// Field nombre_contacto
		$this->nombre_contacto->AdvancedSearch->SearchValue = @$filter["x_nombre_contacto"];
		$this->nombre_contacto->AdvancedSearch->SearchOperator = @$filter["z_nombre_contacto"];
		$this->nombre_contacto->AdvancedSearch->SearchCondition = @$filter["v_nombre_contacto"];
		$this->nombre_contacto->AdvancedSearch->SearchValue2 = @$filter["y_nombre_contacto"];
		$this->nombre_contacto->AdvancedSearch->SearchOperator2 = @$filter["w_nombre_contacto"];
		$this->nombre_contacto->AdvancedSearch->Save();

		// Field email_contacto
		$this->email_contacto->AdvancedSearch->SearchValue = @$filter["x_email_contacto"];
		$this->email_contacto->AdvancedSearch->SearchOperator = @$filter["z_email_contacto"];
		$this->email_contacto->AdvancedSearch->SearchCondition = @$filter["v_email_contacto"];
		$this->email_contacto->AdvancedSearch->SearchValue2 = @$filter["y_email_contacto"];
		$this->email_contacto->AdvancedSearch->SearchOperator2 = @$filter["w_email_contacto"];
		$this->email_contacto->AdvancedSearch->Save();

		// Field lastname
		$this->lastname->AdvancedSearch->SearchValue = @$filter["x_lastname"];
		$this->lastname->AdvancedSearch->SearchOperator = @$filter["z_lastname"];
		$this->lastname->AdvancedSearch->SearchCondition = @$filter["v_lastname"];
		$this->lastname->AdvancedSearch->SearchValue2 = @$filter["y_lastname"];
		$this->lastname->AdvancedSearch->SearchOperator2 = @$filter["w_lastname"];
		$this->lastname->AdvancedSearch->Save();

		// Field id_sucursal
		$this->id_sucursal->AdvancedSearch->SearchValue = @$filter["x_id_sucursal"];
		$this->id_sucursal->AdvancedSearch->SearchOperator = @$filter["z_id_sucursal"];
		$this->id_sucursal->AdvancedSearch->SearchCondition = @$filter["v_id_sucursal"];
		$this->id_sucursal->AdvancedSearch->SearchValue2 = @$filter["y_id_sucursal"];
		$this->id_sucursal->AdvancedSearch->SearchOperator2 = @$filter["w_id_sucursal"];
		$this->id_sucursal->AdvancedSearch->Save();

		// Field tipoinmueble
		$this->tipoinmueble->AdvancedSearch->SearchValue = @$filter["x_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->SearchOperator = @$filter["z_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->SearchCondition = @$filter["v_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->SearchValue2 = @$filter["y_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->SearchOperator2 = @$filter["w_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->Save();

		// Field id_ciudad_inmueble
		$this->id_ciudad_inmueble->AdvancedSearch->SearchValue = @$filter["x_id_ciudad_inmueble"];
		$this->id_ciudad_inmueble->AdvancedSearch->SearchOperator = @$filter["z_id_ciudad_inmueble"];
		$this->id_ciudad_inmueble->AdvancedSearch->SearchCondition = @$filter["v_id_ciudad_inmueble"];
		$this->id_ciudad_inmueble->AdvancedSearch->SearchValue2 = @$filter["y_id_ciudad_inmueble"];
		$this->id_ciudad_inmueble->AdvancedSearch->SearchOperator2 = @$filter["w_id_ciudad_inmueble"];
		$this->id_ciudad_inmueble->AdvancedSearch->Save();

		// Field id_provincia_inmueble
		$this->id_provincia_inmueble->AdvancedSearch->SearchValue = @$filter["x_id_provincia_inmueble"];
		$this->id_provincia_inmueble->AdvancedSearch->SearchOperator = @$filter["z_id_provincia_inmueble"];
		$this->id_provincia_inmueble->AdvancedSearch->SearchCondition = @$filter["v_id_provincia_inmueble"];
		$this->id_provincia_inmueble->AdvancedSearch->SearchValue2 = @$filter["y_id_provincia_inmueble"];
		$this->id_provincia_inmueble->AdvancedSearch->SearchOperator2 = @$filter["w_id_provincia_inmueble"];
		$this->id_provincia_inmueble->AdvancedSearch->Save();

		// Field tipovehiculo
		$this->tipovehiculo->AdvancedSearch->SearchValue = @$filter["x_tipovehiculo"];
		$this->tipovehiculo->AdvancedSearch->SearchOperator = @$filter["z_tipovehiculo"];
		$this->tipovehiculo->AdvancedSearch->SearchCondition = @$filter["v_tipovehiculo"];
		$this->tipovehiculo->AdvancedSearch->SearchValue2 = @$filter["y_tipovehiculo"];
		$this->tipovehiculo->AdvancedSearch->SearchOperator2 = @$filter["w_tipovehiculo"];
		$this->tipovehiculo->AdvancedSearch->Save();

		// Field id_ciudad_vehiculo
		$this->id_ciudad_vehiculo->AdvancedSearch->SearchValue = @$filter["x_id_ciudad_vehiculo"];
		$this->id_ciudad_vehiculo->AdvancedSearch->SearchOperator = @$filter["z_id_ciudad_vehiculo"];
		$this->id_ciudad_vehiculo->AdvancedSearch->SearchCondition = @$filter["v_id_ciudad_vehiculo"];
		$this->id_ciudad_vehiculo->AdvancedSearch->SearchValue2 = @$filter["y_id_ciudad_vehiculo"];
		$this->id_ciudad_vehiculo->AdvancedSearch->SearchOperator2 = @$filter["w_id_ciudad_vehiculo"];
		$this->id_ciudad_vehiculo->AdvancedSearch->Save();

		// Field id_provincia_vehiculo
		$this->id_provincia_vehiculo->AdvancedSearch->SearchValue = @$filter["x_id_provincia_vehiculo"];
		$this->id_provincia_vehiculo->AdvancedSearch->SearchOperator = @$filter["z_id_provincia_vehiculo"];
		$this->id_provincia_vehiculo->AdvancedSearch->SearchCondition = @$filter["v_id_provincia_vehiculo"];
		$this->id_provincia_vehiculo->AdvancedSearch->SearchValue2 = @$filter["y_id_provincia_vehiculo"];
		$this->id_provincia_vehiculo->AdvancedSearch->SearchOperator2 = @$filter["w_id_provincia_vehiculo"];
		$this->id_provincia_vehiculo->AdvancedSearch->Save();

		// Field tipomaquinaria
		$this->tipomaquinaria->AdvancedSearch->SearchValue = @$filter["x_tipomaquinaria"];
		$this->tipomaquinaria->AdvancedSearch->SearchOperator = @$filter["z_tipomaquinaria"];
		$this->tipomaquinaria->AdvancedSearch->SearchCondition = @$filter["v_tipomaquinaria"];
		$this->tipomaquinaria->AdvancedSearch->SearchValue2 = @$filter["y_tipomaquinaria"];
		$this->tipomaquinaria->AdvancedSearch->SearchOperator2 = @$filter["w_tipomaquinaria"];
		$this->tipomaquinaria->AdvancedSearch->Save();

		// Field id_ciudad_maquinaria
		$this->id_ciudad_maquinaria->AdvancedSearch->SearchValue = @$filter["x_id_ciudad_maquinaria"];
		$this->id_ciudad_maquinaria->AdvancedSearch->SearchOperator = @$filter["z_id_ciudad_maquinaria"];
		$this->id_ciudad_maquinaria->AdvancedSearch->SearchCondition = @$filter["v_id_ciudad_maquinaria"];
		$this->id_ciudad_maquinaria->AdvancedSearch->SearchValue2 = @$filter["y_id_ciudad_maquinaria"];
		$this->id_ciudad_maquinaria->AdvancedSearch->SearchOperator2 = @$filter["w_id_ciudad_maquinaria"];
		$this->id_ciudad_maquinaria->AdvancedSearch->Save();

		// Field id_provincia_maquinaria
		$this->id_provincia_maquinaria->AdvancedSearch->SearchValue = @$filter["x_id_provincia_maquinaria"];
		$this->id_provincia_maquinaria->AdvancedSearch->SearchOperator = @$filter["z_id_provincia_maquinaria"];
		$this->id_provincia_maquinaria->AdvancedSearch->SearchCondition = @$filter["v_id_provincia_maquinaria"];
		$this->id_provincia_maquinaria->AdvancedSearch->SearchValue2 = @$filter["y_id_provincia_maquinaria"];
		$this->id_provincia_maquinaria->AdvancedSearch->SearchOperator2 = @$filter["w_id_provincia_maquinaria"];
		$this->id_provincia_maquinaria->AdvancedSearch->Save();

		// Field tipomercaderia
		$this->tipomercaderia->AdvancedSearch->SearchValue = @$filter["x_tipomercaderia"];
		$this->tipomercaderia->AdvancedSearch->SearchOperator = @$filter["z_tipomercaderia"];
		$this->tipomercaderia->AdvancedSearch->SearchCondition = @$filter["v_tipomercaderia"];
		$this->tipomercaderia->AdvancedSearch->SearchValue2 = @$filter["y_tipomercaderia"];
		$this->tipomercaderia->AdvancedSearch->SearchOperator2 = @$filter["w_tipomercaderia"];
		$this->tipomercaderia->AdvancedSearch->Save();

		// Field documento_mercaderia
		$this->documento_mercaderia->AdvancedSearch->SearchValue = @$filter["x_documento_mercaderia"];
		$this->documento_mercaderia->AdvancedSearch->SearchOperator = @$filter["z_documento_mercaderia"];
		$this->documento_mercaderia->AdvancedSearch->SearchCondition = @$filter["v_documento_mercaderia"];
		$this->documento_mercaderia->AdvancedSearch->SearchValue2 = @$filter["y_documento_mercaderia"];
		$this->documento_mercaderia->AdvancedSearch->SearchOperator2 = @$filter["w_documento_mercaderia"];
		$this->documento_mercaderia->AdvancedSearch->Save();

		// Field tipoespecial
		$this->tipoespecial->AdvancedSearch->SearchValue = @$filter["x_tipoespecial"];
		$this->tipoespecial->AdvancedSearch->SearchOperator = @$filter["z_tipoespecial"];
		$this->tipoespecial->AdvancedSearch->SearchCondition = @$filter["v_tipoespecial"];
		$this->tipoespecial->AdvancedSearch->SearchValue2 = @$filter["y_tipoespecial"];
		$this->tipoespecial->AdvancedSearch->SearchOperator2 = @$filter["w_tipoespecial"];
		$this->tipoespecial->AdvancedSearch->Save();

		// Field is_active
		$this->is_active->AdvancedSearch->SearchValue = @$filter["x_is_active"];
		$this->is_active->AdvancedSearch->SearchOperator = @$filter["z_is_active"];
		$this->is_active->AdvancedSearch->SearchCondition = @$filter["v_is_active"];
		$this->is_active->AdvancedSearch->SearchValue2 = @$filter["y_is_active"];
		$this->is_active->AdvancedSearch->SearchOperator2 = @$filter["w_is_active"];
		$this->is_active->AdvancedSearch->Save();

		// Field documentos
		$this->documentos->AdvancedSearch->SearchValue = @$filter["x_documentos"];
		$this->documentos->AdvancedSearch->SearchOperator = @$filter["z_documentos"];
		$this->documentos->AdvancedSearch->SearchCondition = @$filter["v_documentos"];
		$this->documentos->AdvancedSearch->SearchValue2 = @$filter["y_documentos"];
		$this->documentos->AdvancedSearch->SearchOperator2 = @$filter["w_documentos"];
		$this->documentos->AdvancedSearch->Save();
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->id, $Default, FALSE); // id
		$this->BuildSearchSql($sWhere, $this->name, $Default, FALSE); // name
		$this->BuildSearchSql($sWhere, $this->cell, $Default, FALSE); // cell
		$this->BuildSearchSql($sWhere, $this->phone, $Default, FALSE); // phone
		$this->BuildSearchSql($sWhere, $this->_email, $Default, FALSE); // email
		$this->BuildSearchSql($sWhere, $this->address, $Default, FALSE); // address
		$this->BuildSearchSql($sWhere, $this->nombre_contacto, $Default, FALSE); // nombre_contacto
		$this->BuildSearchSql($sWhere, $this->email_contacto, $Default, FALSE); // email_contacto
		$this->BuildSearchSql($sWhere, $this->lastname, $Default, FALSE); // lastname
		$this->BuildSearchSql($sWhere, $this->id_sucursal, $Default, FALSE); // id_sucursal
		$this->BuildSearchSql($sWhere, $this->tipoinmueble, $Default, TRUE); // tipoinmueble
		$this->BuildSearchSql($sWhere, $this->id_ciudad_inmueble, $Default, FALSE); // id_ciudad_inmueble
		$this->BuildSearchSql($sWhere, $this->id_provincia_inmueble, $Default, FALSE); // id_provincia_inmueble
		$this->BuildSearchSql($sWhere, $this->tipovehiculo, $Default, TRUE); // tipovehiculo
		$this->BuildSearchSql($sWhere, $this->id_ciudad_vehiculo, $Default, FALSE); // id_ciudad_vehiculo
		$this->BuildSearchSql($sWhere, $this->id_provincia_vehiculo, $Default, FALSE); // id_provincia_vehiculo
		$this->BuildSearchSql($sWhere, $this->tipomaquinaria, $Default, TRUE); // tipomaquinaria
		$this->BuildSearchSql($sWhere, $this->id_ciudad_maquinaria, $Default, FALSE); // id_ciudad_maquinaria
		$this->BuildSearchSql($sWhere, $this->id_provincia_maquinaria, $Default, FALSE); // id_provincia_maquinaria
		$this->BuildSearchSql($sWhere, $this->tipomercaderia, $Default, TRUE); // tipomercaderia
		$this->BuildSearchSql($sWhere, $this->documento_mercaderia, $Default, FALSE); // documento_mercaderia
		$this->BuildSearchSql($sWhere, $this->tipoespecial, $Default, FALSE); // tipoespecial
		$this->BuildSearchSql($sWhere, $this->is_active, $Default, FALSE); // is_active
		$this->BuildSearchSql($sWhere, $this->documentos, $Default, FALSE); // documentos

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->id->AdvancedSearch->Save(); // id
			$this->name->AdvancedSearch->Save(); // name
			$this->cell->AdvancedSearch->Save(); // cell
			$this->phone->AdvancedSearch->Save(); // phone
			$this->_email->AdvancedSearch->Save(); // email
			$this->address->AdvancedSearch->Save(); // address
			$this->nombre_contacto->AdvancedSearch->Save(); // nombre_contacto
			$this->email_contacto->AdvancedSearch->Save(); // email_contacto
			$this->lastname->AdvancedSearch->Save(); // lastname
			$this->id_sucursal->AdvancedSearch->Save(); // id_sucursal
			$this->tipoinmueble->AdvancedSearch->Save(); // tipoinmueble
			$this->id_ciudad_inmueble->AdvancedSearch->Save(); // id_ciudad_inmueble
			$this->id_provincia_inmueble->AdvancedSearch->Save(); // id_provincia_inmueble
			$this->tipovehiculo->AdvancedSearch->Save(); // tipovehiculo
			$this->id_ciudad_vehiculo->AdvancedSearch->Save(); // id_ciudad_vehiculo
			$this->id_provincia_vehiculo->AdvancedSearch->Save(); // id_provincia_vehiculo
			$this->tipomaquinaria->AdvancedSearch->Save(); // tipomaquinaria
			$this->id_ciudad_maquinaria->AdvancedSearch->Save(); // id_ciudad_maquinaria
			$this->id_provincia_maquinaria->AdvancedSearch->Save(); // id_provincia_maquinaria
			$this->tipomercaderia->AdvancedSearch->Save(); // tipomercaderia
			$this->documento_mercaderia->AdvancedSearch->Save(); // documento_mercaderia
			$this->tipoespecial->AdvancedSearch->Save(); // tipoespecial
			$this->is_active->AdvancedSearch->Save(); // is_active
			$this->documentos->AdvancedSearch->Save(); // documentos
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
		if ($this->name->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->cell->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->phone->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->_email->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->address->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->nombre_contacto->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->email_contacto->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->lastname->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_sucursal->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->tipoinmueble->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_ciudad_inmueble->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_provincia_inmueble->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->tipovehiculo->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_ciudad_vehiculo->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_provincia_vehiculo->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->tipomaquinaria->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_ciudad_maquinaria->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_provincia_maquinaria->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->tipomercaderia->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->documento_mercaderia->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->tipoespecial->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->is_active->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->documentos->AdvancedSearch->IssetSession())
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
		$this->name->AdvancedSearch->UnsetSession();
		$this->cell->AdvancedSearch->UnsetSession();
		$this->phone->AdvancedSearch->UnsetSession();
		$this->_email->AdvancedSearch->UnsetSession();
		$this->address->AdvancedSearch->UnsetSession();
		$this->nombre_contacto->AdvancedSearch->UnsetSession();
		$this->email_contacto->AdvancedSearch->UnsetSession();
		$this->lastname->AdvancedSearch->UnsetSession();
		$this->id_sucursal->AdvancedSearch->UnsetSession();
		$this->tipoinmueble->AdvancedSearch->UnsetSession();
		$this->id_ciudad_inmueble->AdvancedSearch->UnsetSession();
		$this->id_provincia_inmueble->AdvancedSearch->UnsetSession();
		$this->tipovehiculo->AdvancedSearch->UnsetSession();
		$this->id_ciudad_vehiculo->AdvancedSearch->UnsetSession();
		$this->id_provincia_vehiculo->AdvancedSearch->UnsetSession();
		$this->tipomaquinaria->AdvancedSearch->UnsetSession();
		$this->id_ciudad_maquinaria->AdvancedSearch->UnsetSession();
		$this->id_provincia_maquinaria->AdvancedSearch->UnsetSession();
		$this->tipomercaderia->AdvancedSearch->UnsetSession();
		$this->documento_mercaderia->AdvancedSearch->UnsetSession();
		$this->tipoespecial->AdvancedSearch->UnsetSession();
		$this->is_active->AdvancedSearch->UnsetSession();
		$this->documentos->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->id->AdvancedSearch->Load();
		$this->name->AdvancedSearch->Load();
		$this->cell->AdvancedSearch->Load();
		$this->phone->AdvancedSearch->Load();
		$this->_email->AdvancedSearch->Load();
		$this->address->AdvancedSearch->Load();
		$this->nombre_contacto->AdvancedSearch->Load();
		$this->email_contacto->AdvancedSearch->Load();
		$this->lastname->AdvancedSearch->Load();
		$this->id_sucursal->AdvancedSearch->Load();
		$this->tipoinmueble->AdvancedSearch->Load();
		$this->id_ciudad_inmueble->AdvancedSearch->Load();
		$this->id_provincia_inmueble->AdvancedSearch->Load();
		$this->tipovehiculo->AdvancedSearch->Load();
		$this->id_ciudad_vehiculo->AdvancedSearch->Load();
		$this->id_provincia_vehiculo->AdvancedSearch->Load();
		$this->tipomaquinaria->AdvancedSearch->Load();
		$this->id_ciudad_maquinaria->AdvancedSearch->Load();
		$this->id_provincia_maquinaria->AdvancedSearch->Load();
		$this->tipomercaderia->AdvancedSearch->Load();
		$this->documento_mercaderia->AdvancedSearch->Load();
		$this->tipoespecial->AdvancedSearch->Load();
		$this->is_active->AdvancedSearch->Load();
		$this->documentos->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->name); // name
			$this->UpdateSort($this->cell); // cell
			$this->UpdateSort($this->phone); // phone
			$this->UpdateSort($this->_email); // email
			$this->UpdateSort($this->address); // address
			$this->UpdateSort($this->email_contacto); // email_contacto
			$this->UpdateSort($this->lastname); // lastname
			$this->UpdateSort($this->tipoinmueble); // tipoinmueble
			$this->UpdateSort($this->tipovehiculo); // tipovehiculo
			$this->UpdateSort($this->tipomaquinaria); // tipomaquinaria
			$this->UpdateSort($this->tipomercaderia); // tipomercaderia
			$this->UpdateSort($this->tipoespecial); // tipoespecial
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
				$this->name->setSort("");
				$this->cell->setSort("");
				$this->phone->setSort("");
				$this->_email->setSort("");
				$this->address->setSort("");
				$this->email_contacto->setSort("");
				$this->lastname->setSort("");
				$this->tipoinmueble->setSort("");
				$this->tipovehiculo->setSort("");
				$this->tipomaquinaria->setSort("");
				$this->tipomercaderia->setSort("");
				$this->tipoespecial->setSort("");
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

		// "edit"
		$item = &$this->ListOptions->Add("edit");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanEdit();
		$item->OnLeft = TRUE;

		// "detail_viewavaluo"
		$item = &$this->ListOptions->Add("detail_viewavaluo");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'viewavaluo') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["viewavaluo_grid"])) $GLOBALS["viewavaluo_grid"] = new cviewavaluo_grid;

		// Multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$this->ListOptions->Add("details");
			$item->CssClass = "text-nowrap";
			$item->Visible = $this->ShowMultipleDetails;
			$item->OnLeft = TRUE;
			$item->ShowInButtonGroup = FALSE;
		}

		// Set up detail pages
		$pages = new cSubPages();
		$pages->Add("viewavaluo");
		$this->DetailPages = $pages;

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

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

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
		$DetailViewTblVar = "";
		$DetailCopyTblVar = "";
		$DetailEditTblVar = "";

		// "detail_viewavaluo"
		$oListOpt = &$this->ListOptions->Items["detail_viewavaluo"];
		if ($Security->AllowList(CurrentProjectID() . 'viewavaluo')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("viewavaluo", "TblCaption");
			$body .= "&nbsp;" . str_replace("%c", $this->viewavaluo_Count, $Language->Phrase("DetailCount"));
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("viewavaluolist.php?" . EW_TABLE_SHOW_MASTER . "=viewsolicitud&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["viewavaluo_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 'viewavaluo')) {
				$caption = $Language->Phrase("MasterDetailEditLink");
				$url = $this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=viewavaluo");
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . ew_HtmlImageAndText($caption) . "</a></li>";
				if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
				$DetailEditTblVar .= "viewavaluo";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group\">" . $body . "</div>";
			$oListOpt->Body = $body;
			if ($this->ShowMultipleDetails) $oListOpt->Visible = FALSE;
		}
		if ($this->ShowMultipleDetails) {
			$body = $Language->Phrase("MultipleMasterDetails");
			$body = "<div class=\"btn-group\">";
			$links = "";
			if ($DetailViewTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailView\" data-action=\"view\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailViewLink")) . "\" href=\"" . ew_HtmlEncode($this->GetViewUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailViewTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailViewLink")) . "</a></li>";
			}
			if ($DetailEditTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailEditLink")) . "\" href=\"" . ew_HtmlEncode($this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailEditTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailEditLink")) . "</a></li>";
			}
			if ($DetailCopyTblVar <> "") {
				$links .= "<li><a class=\"ewRowLink ewDetailCopy\" data-action=\"add\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("MasterDetailCopyLink")) . "\" href=\"" . ew_HtmlEncode($this->GetCopyUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailCopyTblVar)) . "\">" . ew_HtmlImageAndText($Language->Phrase("MasterDetailCopyLink")) . "</a></li>";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewMasterDetail\" title=\"" . ew_HtmlTitle($Language->Phrase("MultipleMasterDetails")) . "\" data-toggle=\"dropdown\">" . $Language->Phrase("MultipleMasterDetails") . "<b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu ewMenu\">". $links . "</ul>";
			}
			$body .= "</div>";

			// Multiple details
			$oListOpt = &$this->ListOptions->Items["details"];
			$oListOpt->Body = $body;
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
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());
		$option = $options["detail"];
		$DetailTableLink = "";
		$item = &$option->Add("detailadd_viewavaluo");
		$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=viewavaluo");
		$caption = $Language->Phrase("Add") . "&nbsp;" . $this->TableCaption() . "/" . $GLOBALS["viewavaluo"]->TableCaption();
		$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["viewavaluo"]->DetailAdd && $Security->AllowAdd(CurrentProjectID() . 'viewavaluo') && $Security->CanAdd());
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "viewavaluo";
		}

		// Add multiple details
		if ($this->ShowMultipleDetails) {
			$item = &$option->Add("detailsadd");
			$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=" . $DetailTableLink);
			$caption = $Language->Phrase("AddMasterDetailLink");
			$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
			$item->Visible = ($DetailTableLink <> "" && $Security->CanAdd());

			// Hide single master/detail items
			$ar = explode(",", $DetailTableLink);
			$cnt = count($ar);
			for ($i = 0; $i < $cnt; $i++) {
				if ($item = &$option->GetItem("detailadd_" . $ar[$i]))
					$item->Visible = FALSE;
			}
		}
		$option = $options["action"];

		// Set up options default
		foreach ($options as &$option) {
			$option->UseImageAndText = TRUE;
			$option->UseDropDownButton = TRUE;
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fviewsolicitudlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fviewsolicitudlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fviewsolicitudlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fviewsolicitudlistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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

		// name
		$this->name->AdvancedSearch->SearchValue = @$_GET["x_name"];
		if ($this->name->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->name->AdvancedSearch->SearchOperator = @$_GET["z_name"];

		// cell
		$this->cell->AdvancedSearch->SearchValue = @$_GET["x_cell"];
		if ($this->cell->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->cell->AdvancedSearch->SearchOperator = @$_GET["z_cell"];

		// phone
		$this->phone->AdvancedSearch->SearchValue = @$_GET["x_phone"];
		if ($this->phone->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->phone->AdvancedSearch->SearchOperator = @$_GET["z_phone"];

		// email
		$this->_email->AdvancedSearch->SearchValue = @$_GET["x__email"];
		if ($this->_email->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->_email->AdvancedSearch->SearchOperator = @$_GET["z__email"];

		// address
		$this->address->AdvancedSearch->SearchValue = @$_GET["x_address"];
		if ($this->address->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->address->AdvancedSearch->SearchOperator = @$_GET["z_address"];

		// nombre_contacto
		$this->nombre_contacto->AdvancedSearch->SearchValue = @$_GET["x_nombre_contacto"];
		if ($this->nombre_contacto->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->nombre_contacto->AdvancedSearch->SearchOperator = @$_GET["z_nombre_contacto"];

		// email_contacto
		$this->email_contacto->AdvancedSearch->SearchValue = @$_GET["x_email_contacto"];
		if ($this->email_contacto->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->email_contacto->AdvancedSearch->SearchOperator = @$_GET["z_email_contacto"];

		// lastname
		$this->lastname->AdvancedSearch->SearchValue = @$_GET["x_lastname"];
		if ($this->lastname->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->lastname->AdvancedSearch->SearchOperator = @$_GET["z_lastname"];

		// id_sucursal
		$this->id_sucursal->AdvancedSearch->SearchValue = @$_GET["x_id_sucursal"];
		if ($this->id_sucursal->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id_sucursal->AdvancedSearch->SearchOperator = @$_GET["z_id_sucursal"];

		// tipoinmueble
		$this->tipoinmueble->AdvancedSearch->SearchValue = @$_GET["x_tipoinmueble"];
		if ($this->tipoinmueble->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->tipoinmueble->AdvancedSearch->SearchOperator = @$_GET["z_tipoinmueble"];
		if (is_array($this->tipoinmueble->AdvancedSearch->SearchValue)) $this->tipoinmueble->AdvancedSearch->SearchValue = implode(",", $this->tipoinmueble->AdvancedSearch->SearchValue);
		if (is_array($this->tipoinmueble->AdvancedSearch->SearchValue2)) $this->tipoinmueble->AdvancedSearch->SearchValue2 = implode(",", $this->tipoinmueble->AdvancedSearch->SearchValue2);

		// id_ciudad_inmueble
		$this->id_ciudad_inmueble->AdvancedSearch->SearchValue = @$_GET["x_id_ciudad_inmueble"];
		if ($this->id_ciudad_inmueble->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id_ciudad_inmueble->AdvancedSearch->SearchOperator = @$_GET["z_id_ciudad_inmueble"];

		// id_provincia_inmueble
		$this->id_provincia_inmueble->AdvancedSearch->SearchValue = @$_GET["x_id_provincia_inmueble"];
		if ($this->id_provincia_inmueble->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id_provincia_inmueble->AdvancedSearch->SearchOperator = @$_GET["z_id_provincia_inmueble"];

		// tipovehiculo
		$this->tipovehiculo->AdvancedSearch->SearchValue = @$_GET["x_tipovehiculo"];
		if ($this->tipovehiculo->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->tipovehiculo->AdvancedSearch->SearchOperator = @$_GET["z_tipovehiculo"];
		if (is_array($this->tipovehiculo->AdvancedSearch->SearchValue)) $this->tipovehiculo->AdvancedSearch->SearchValue = implode(",", $this->tipovehiculo->AdvancedSearch->SearchValue);
		if (is_array($this->tipovehiculo->AdvancedSearch->SearchValue2)) $this->tipovehiculo->AdvancedSearch->SearchValue2 = implode(",", $this->tipovehiculo->AdvancedSearch->SearchValue2);

		// id_ciudad_vehiculo
		$this->id_ciudad_vehiculo->AdvancedSearch->SearchValue = @$_GET["x_id_ciudad_vehiculo"];
		if ($this->id_ciudad_vehiculo->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id_ciudad_vehiculo->AdvancedSearch->SearchOperator = @$_GET["z_id_ciudad_vehiculo"];

		// id_provincia_vehiculo
		$this->id_provincia_vehiculo->AdvancedSearch->SearchValue = @$_GET["x_id_provincia_vehiculo"];
		if ($this->id_provincia_vehiculo->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id_provincia_vehiculo->AdvancedSearch->SearchOperator = @$_GET["z_id_provincia_vehiculo"];

		// tipomaquinaria
		$this->tipomaquinaria->AdvancedSearch->SearchValue = @$_GET["x_tipomaquinaria"];
		if ($this->tipomaquinaria->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->tipomaquinaria->AdvancedSearch->SearchOperator = @$_GET["z_tipomaquinaria"];
		if (is_array($this->tipomaquinaria->AdvancedSearch->SearchValue)) $this->tipomaquinaria->AdvancedSearch->SearchValue = implode(",", $this->tipomaquinaria->AdvancedSearch->SearchValue);
		if (is_array($this->tipomaquinaria->AdvancedSearch->SearchValue2)) $this->tipomaquinaria->AdvancedSearch->SearchValue2 = implode(",", $this->tipomaquinaria->AdvancedSearch->SearchValue2);

		// id_ciudad_maquinaria
		$this->id_ciudad_maquinaria->AdvancedSearch->SearchValue = @$_GET["x_id_ciudad_maquinaria"];
		if ($this->id_ciudad_maquinaria->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id_ciudad_maquinaria->AdvancedSearch->SearchOperator = @$_GET["z_id_ciudad_maquinaria"];

		// id_provincia_maquinaria
		$this->id_provincia_maquinaria->AdvancedSearch->SearchValue = @$_GET["x_id_provincia_maquinaria"];
		if ($this->id_provincia_maquinaria->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id_provincia_maquinaria->AdvancedSearch->SearchOperator = @$_GET["z_id_provincia_maquinaria"];

		// tipomercaderia
		$this->tipomercaderia->AdvancedSearch->SearchValue = @$_GET["x_tipomercaderia"];
		if ($this->tipomercaderia->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->tipomercaderia->AdvancedSearch->SearchOperator = @$_GET["z_tipomercaderia"];
		if (is_array($this->tipomercaderia->AdvancedSearch->SearchValue)) $this->tipomercaderia->AdvancedSearch->SearchValue = implode(",", $this->tipomercaderia->AdvancedSearch->SearchValue);
		if (is_array($this->tipomercaderia->AdvancedSearch->SearchValue2)) $this->tipomercaderia->AdvancedSearch->SearchValue2 = implode(",", $this->tipomercaderia->AdvancedSearch->SearchValue2);

		// documento_mercaderia
		$this->documento_mercaderia->AdvancedSearch->SearchValue = @$_GET["x_documento_mercaderia"];
		if ($this->documento_mercaderia->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->documento_mercaderia->AdvancedSearch->SearchOperator = @$_GET["z_documento_mercaderia"];

		// tipoespecial
		$this->tipoespecial->AdvancedSearch->SearchValue = @$_GET["x_tipoespecial"];
		if ($this->tipoespecial->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->tipoespecial->AdvancedSearch->SearchOperator = @$_GET["z_tipoespecial"];

		// is_active
		$this->is_active->AdvancedSearch->SearchValue = @$_GET["x_is_active"];
		if ($this->is_active->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->is_active->AdvancedSearch->SearchOperator = @$_GET["z_is_active"];

		// documentos
		$this->documentos->AdvancedSearch->SearchValue = @$_GET["x_documentos"];
		if ($this->documentos->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->documentos->AdvancedSearch->SearchOperator = @$_GET["z_documentos"];
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
		$this->name->setDbValue($row['name']);
		$this->cell->setDbValue($row['cell']);
		$this->phone->setDbValue($row['phone']);
		$this->_email->setDbValue($row['email']);
		$this->address->setDbValue($row['address']);
		$this->nombre_contacto->setDbValue($row['nombre_contacto']);
		$this->email_contacto->setDbValue($row['email_contacto']);
		$this->lastname->setDbValue($row['lastname']);
		$this->latitud->setDbValue($row['latitud']);
		$this->longitud->setDbValue($row['longitud']);
		$this->id_sucursal->setDbValue($row['id_sucursal']);
		$this->tipoinmueble->setDbValue($row['tipoinmueble']);
		$this->id_ciudad_inmueble->setDbValue($row['id_ciudad_inmueble']);
		$this->id_provincia_inmueble->setDbValue($row['id_provincia_inmueble']);
		$this->imagen_inmueble01->Upload->DbValue = $row['imagen_inmueble01'];
		if (is_array($this->imagen_inmueble01->Upload->DbValue) || is_object($this->imagen_inmueble01->Upload->DbValue)) // Byte array
			$this->imagen_inmueble01->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble01->Upload->DbValue);
		$this->imagen_inmueble02->Upload->DbValue = $row['imagen_inmueble02'];
		if (is_array($this->imagen_inmueble02->Upload->DbValue) || is_object($this->imagen_inmueble02->Upload->DbValue)) // Byte array
			$this->imagen_inmueble02->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble02->Upload->DbValue);
		$this->imagen_inmueble03->Upload->DbValue = $row['imagen_inmueble03'];
		if (is_array($this->imagen_inmueble03->Upload->DbValue) || is_object($this->imagen_inmueble03->Upload->DbValue)) // Byte array
			$this->imagen_inmueble03->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble03->Upload->DbValue);
		$this->imagen_inmueble04->Upload->DbValue = $row['imagen_inmueble04'];
		if (is_array($this->imagen_inmueble04->Upload->DbValue) || is_object($this->imagen_inmueble04->Upload->DbValue)) // Byte array
			$this->imagen_inmueble04->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble04->Upload->DbValue);
		$this->imagen_inmueble05->Upload->DbValue = $row['imagen_inmueble05'];
		if (is_array($this->imagen_inmueble05->Upload->DbValue) || is_object($this->imagen_inmueble05->Upload->DbValue)) // Byte array
			$this->imagen_inmueble05->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble05->Upload->DbValue);
		$this->imagen_inmueble06->Upload->DbValue = $row['imagen_inmueble06'];
		if (is_array($this->imagen_inmueble06->Upload->DbValue) || is_object($this->imagen_inmueble06->Upload->DbValue)) // Byte array
			$this->imagen_inmueble06->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble06->Upload->DbValue);
		$this->imagen_inmueble07->Upload->DbValue = $row['imagen_inmueble07'];
		if (is_array($this->imagen_inmueble07->Upload->DbValue) || is_object($this->imagen_inmueble07->Upload->DbValue)) // Byte array
			$this->imagen_inmueble07->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble07->Upload->DbValue);
		$this->imagen_inmueble08->Upload->DbValue = $row['imagen_inmueble08'];
		if (is_array($this->imagen_inmueble08->Upload->DbValue) || is_object($this->imagen_inmueble08->Upload->DbValue)) // Byte array
			$this->imagen_inmueble08->Upload->DbValue = ew_BytesToStr($this->imagen_inmueble08->Upload->DbValue);
		$this->tipovehiculo->setDbValue($row['tipovehiculo']);
		$this->id_ciudad_vehiculo->setDbValue($row['id_ciudad_vehiculo']);
		$this->id_provincia_vehiculo->setDbValue($row['id_provincia_vehiculo']);
		$this->imagen_vehiculo01->Upload->DbValue = $row['imagen_vehiculo01'];
		if (is_array($this->imagen_vehiculo01->Upload->DbValue) || is_object($this->imagen_vehiculo01->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo01->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo01->Upload->DbValue);
		$this->imagen_vehiculo02->Upload->DbValue = $row['imagen_vehiculo02'];
		if (is_array($this->imagen_vehiculo02->Upload->DbValue) || is_object($this->imagen_vehiculo02->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo02->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo02->Upload->DbValue);
		$this->imagen_vehiculo03->Upload->DbValue = $row['imagen_vehiculo03'];
		if (is_array($this->imagen_vehiculo03->Upload->DbValue) || is_object($this->imagen_vehiculo03->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo03->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo03->Upload->DbValue);
		$this->imagen_vehiculo04->Upload->DbValue = $row['imagen_vehiculo04'];
		if (is_array($this->imagen_vehiculo04->Upload->DbValue) || is_object($this->imagen_vehiculo04->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo04->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo04->Upload->DbValue);
		$this->imagen_vehiculo05->Upload->DbValue = $row['imagen_vehiculo05'];
		if (is_array($this->imagen_vehiculo05->Upload->DbValue) || is_object($this->imagen_vehiculo05->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo05->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo05->Upload->DbValue);
		$this->imagen_vehiculo06->Upload->DbValue = $row['imagen_vehiculo06'];
		if (is_array($this->imagen_vehiculo06->Upload->DbValue) || is_object($this->imagen_vehiculo06->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo06->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo06->Upload->DbValue);
		$this->imagen_vehiculo07->Upload->DbValue = $row['imagen_vehiculo07'];
		if (is_array($this->imagen_vehiculo07->Upload->DbValue) || is_object($this->imagen_vehiculo07->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo07->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo07->Upload->DbValue);
		$this->imagen_vehiculo08->Upload->DbValue = $row['imagen_vehiculo08'];
		if (is_array($this->imagen_vehiculo08->Upload->DbValue) || is_object($this->imagen_vehiculo08->Upload->DbValue)) // Byte array
			$this->imagen_vehiculo08->Upload->DbValue = ew_BytesToStr($this->imagen_vehiculo08->Upload->DbValue);
		$this->tipomaquinaria->setDbValue($row['tipomaquinaria']);
		$this->id_ciudad_maquinaria->setDbValue($row['id_ciudad_maquinaria']);
		$this->id_provincia_maquinaria->setDbValue($row['id_provincia_maquinaria']);
		$this->imagen_maquinaria01->Upload->DbValue = $row['imagen_maquinaria01'];
		if (is_array($this->imagen_maquinaria01->Upload->DbValue) || is_object($this->imagen_maquinaria01->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria01->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria01->Upload->DbValue);
		$this->imagen_maquinaria02->Upload->DbValue = $row['imagen_maquinaria02'];
		if (is_array($this->imagen_maquinaria02->Upload->DbValue) || is_object($this->imagen_maquinaria02->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria02->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria02->Upload->DbValue);
		$this->imagen_maquinaria03->Upload->DbValue = $row['imagen_maquinaria03'];
		if (is_array($this->imagen_maquinaria03->Upload->DbValue) || is_object($this->imagen_maquinaria03->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria03->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria03->Upload->DbValue);
		$this->imagen_maquinaria04->Upload->DbValue = $row['imagen_maquinaria04'];
		if (is_array($this->imagen_maquinaria04->Upload->DbValue) || is_object($this->imagen_maquinaria04->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria04->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria04->Upload->DbValue);
		$this->imagen_maquinaria05->Upload->DbValue = $row['imagen_maquinaria05'];
		if (is_array($this->imagen_maquinaria05->Upload->DbValue) || is_object($this->imagen_maquinaria05->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria05->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria05->Upload->DbValue);
		$this->imagen_maquinaria06->Upload->DbValue = $row['imagen_maquinaria06'];
		if (is_array($this->imagen_maquinaria06->Upload->DbValue) || is_object($this->imagen_maquinaria06->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria06->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria06->Upload->DbValue);
		$this->imagen_maquinaria07->Upload->DbValue = $row['imagen_maquinaria07'];
		if (is_array($this->imagen_maquinaria07->Upload->DbValue) || is_object($this->imagen_maquinaria07->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria07->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria07->Upload->DbValue);
		$this->imagen_maquinaria08->Upload->DbValue = $row['imagen_maquinaria08'];
		if (is_array($this->imagen_maquinaria08->Upload->DbValue) || is_object($this->imagen_maquinaria08->Upload->DbValue)) // Byte array
			$this->imagen_maquinaria08->Upload->DbValue = ew_BytesToStr($this->imagen_maquinaria08->Upload->DbValue);
		$this->tipomercaderia->setDbValue($row['tipomercaderia']);
		$this->imagen_mercaderia01->Upload->DbValue = $row['imagen_mercaderia01'];
		if (is_array($this->imagen_mercaderia01->Upload->DbValue) || is_object($this->imagen_mercaderia01->Upload->DbValue)) // Byte array
			$this->imagen_mercaderia01->Upload->DbValue = ew_BytesToStr($this->imagen_mercaderia01->Upload->DbValue);
		$this->documento_mercaderia->setDbValue($row['documento_mercaderia']);
		$this->tipoespecial->setDbValue($row['tipoespecial']);
		$this->imagen_tipoespecial01->Upload->DbValue = $row['imagen_tipoespecial01'];
		if (is_array($this->imagen_tipoespecial01->Upload->DbValue) || is_object($this->imagen_tipoespecial01->Upload->DbValue)) // Byte array
			$this->imagen_tipoespecial01->Upload->DbValue = ew_BytesToStr($this->imagen_tipoespecial01->Upload->DbValue);
		$this->is_active->setDbValue($row['is_active']);
		$this->documentos->setDbValue($row['documentos']);
		$this->created_at->setDbValue($row['created_at']);
		$this->DateModified->setDbValue($row['DateModified']);
		$this->DateDeleted->setDbValue($row['DateDeleted']);
		$this->CreatedBy->setDbValue($row['CreatedBy']);
		$this->ModifiedBy->setDbValue($row['ModifiedBy']);
		$this->DeletedBy->setDbValue($row['DeletedBy']);
		if (!isset($GLOBALS["viewavaluo_grid"])) $GLOBALS["viewavaluo_grid"] = new cviewavaluo_grid;
		$sDetailFilter = $GLOBALS["viewavaluo"]->SqlDetailFilter_viewsolicitud();
		$sDetailFilter = str_replace("@id_solicitud@", ew_AdjustSql($this->id->DbValue, "DB"), $sDetailFilter);
		$GLOBALS["viewavaluo"]->setCurrentMasterTable("viewsolicitud");
		$sDetailFilter = $GLOBALS["viewavaluo"]->ApplyUserIDFilters($sDetailFilter);
		$this->viewavaluo_Count = $GLOBALS["viewavaluo"]->LoadRecordCount($sDetailFilter);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['name'] = NULL;
		$row['cell'] = NULL;
		$row['phone'] = NULL;
		$row['email'] = NULL;
		$row['address'] = NULL;
		$row['nombre_contacto'] = NULL;
		$row['email_contacto'] = NULL;
		$row['lastname'] = NULL;
		$row['latitud'] = NULL;
		$row['longitud'] = NULL;
		$row['id_sucursal'] = NULL;
		$row['tipoinmueble'] = NULL;
		$row['id_ciudad_inmueble'] = NULL;
		$row['id_provincia_inmueble'] = NULL;
		$row['imagen_inmueble01'] = NULL;
		$row['imagen_inmueble02'] = NULL;
		$row['imagen_inmueble03'] = NULL;
		$row['imagen_inmueble04'] = NULL;
		$row['imagen_inmueble05'] = NULL;
		$row['imagen_inmueble06'] = NULL;
		$row['imagen_inmueble07'] = NULL;
		$row['imagen_inmueble08'] = NULL;
		$row['tipovehiculo'] = NULL;
		$row['id_ciudad_vehiculo'] = NULL;
		$row['id_provincia_vehiculo'] = NULL;
		$row['imagen_vehiculo01'] = NULL;
		$row['imagen_vehiculo02'] = NULL;
		$row['imagen_vehiculo03'] = NULL;
		$row['imagen_vehiculo04'] = NULL;
		$row['imagen_vehiculo05'] = NULL;
		$row['imagen_vehiculo06'] = NULL;
		$row['imagen_vehiculo07'] = NULL;
		$row['imagen_vehiculo08'] = NULL;
		$row['tipomaquinaria'] = NULL;
		$row['id_ciudad_maquinaria'] = NULL;
		$row['id_provincia_maquinaria'] = NULL;
		$row['imagen_maquinaria01'] = NULL;
		$row['imagen_maquinaria02'] = NULL;
		$row['imagen_maquinaria03'] = NULL;
		$row['imagen_maquinaria04'] = NULL;
		$row['imagen_maquinaria05'] = NULL;
		$row['imagen_maquinaria06'] = NULL;
		$row['imagen_maquinaria07'] = NULL;
		$row['imagen_maquinaria08'] = NULL;
		$row['tipomercaderia'] = NULL;
		$row['imagen_mercaderia01'] = NULL;
		$row['documento_mercaderia'] = NULL;
		$row['tipoespecial'] = NULL;
		$row['imagen_tipoespecial01'] = NULL;
		$row['is_active'] = NULL;
		$row['documentos'] = NULL;
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
		$this->name->DbValue = $row['name'];
		$this->cell->DbValue = $row['cell'];
		$this->phone->DbValue = $row['phone'];
		$this->_email->DbValue = $row['email'];
		$this->address->DbValue = $row['address'];
		$this->nombre_contacto->DbValue = $row['nombre_contacto'];
		$this->email_contacto->DbValue = $row['email_contacto'];
		$this->lastname->DbValue = $row['lastname'];
		$this->latitud->DbValue = $row['latitud'];
		$this->longitud->DbValue = $row['longitud'];
		$this->id_sucursal->DbValue = $row['id_sucursal'];
		$this->tipoinmueble->DbValue = $row['tipoinmueble'];
		$this->id_ciudad_inmueble->DbValue = $row['id_ciudad_inmueble'];
		$this->id_provincia_inmueble->DbValue = $row['id_provincia_inmueble'];
		$this->imagen_inmueble01->Upload->DbValue = $row['imagen_inmueble01'];
		$this->imagen_inmueble02->Upload->DbValue = $row['imagen_inmueble02'];
		$this->imagen_inmueble03->Upload->DbValue = $row['imagen_inmueble03'];
		$this->imagen_inmueble04->Upload->DbValue = $row['imagen_inmueble04'];
		$this->imagen_inmueble05->Upload->DbValue = $row['imagen_inmueble05'];
		$this->imagen_inmueble06->Upload->DbValue = $row['imagen_inmueble06'];
		$this->imagen_inmueble07->Upload->DbValue = $row['imagen_inmueble07'];
		$this->imagen_inmueble08->Upload->DbValue = $row['imagen_inmueble08'];
		$this->tipovehiculo->DbValue = $row['tipovehiculo'];
		$this->id_ciudad_vehiculo->DbValue = $row['id_ciudad_vehiculo'];
		$this->id_provincia_vehiculo->DbValue = $row['id_provincia_vehiculo'];
		$this->imagen_vehiculo01->Upload->DbValue = $row['imagen_vehiculo01'];
		$this->imagen_vehiculo02->Upload->DbValue = $row['imagen_vehiculo02'];
		$this->imagen_vehiculo03->Upload->DbValue = $row['imagen_vehiculo03'];
		$this->imagen_vehiculo04->Upload->DbValue = $row['imagen_vehiculo04'];
		$this->imagen_vehiculo05->Upload->DbValue = $row['imagen_vehiculo05'];
		$this->imagen_vehiculo06->Upload->DbValue = $row['imagen_vehiculo06'];
		$this->imagen_vehiculo07->Upload->DbValue = $row['imagen_vehiculo07'];
		$this->imagen_vehiculo08->Upload->DbValue = $row['imagen_vehiculo08'];
		$this->tipomaquinaria->DbValue = $row['tipomaquinaria'];
		$this->id_ciudad_maquinaria->DbValue = $row['id_ciudad_maquinaria'];
		$this->id_provincia_maquinaria->DbValue = $row['id_provincia_maquinaria'];
		$this->imagen_maquinaria01->Upload->DbValue = $row['imagen_maquinaria01'];
		$this->imagen_maquinaria02->Upload->DbValue = $row['imagen_maquinaria02'];
		$this->imagen_maquinaria03->Upload->DbValue = $row['imagen_maquinaria03'];
		$this->imagen_maquinaria04->Upload->DbValue = $row['imagen_maquinaria04'];
		$this->imagen_maquinaria05->Upload->DbValue = $row['imagen_maquinaria05'];
		$this->imagen_maquinaria06->Upload->DbValue = $row['imagen_maquinaria06'];
		$this->imagen_maquinaria07->Upload->DbValue = $row['imagen_maquinaria07'];
		$this->imagen_maquinaria08->Upload->DbValue = $row['imagen_maquinaria08'];
		$this->tipomercaderia->DbValue = $row['tipomercaderia'];
		$this->imagen_mercaderia01->Upload->DbValue = $row['imagen_mercaderia01'];
		$this->documento_mercaderia->DbValue = $row['documento_mercaderia'];
		$this->tipoespecial->DbValue = $row['tipoespecial'];
		$this->imagen_tipoespecial01->Upload->DbValue = $row['imagen_tipoespecial01'];
		$this->is_active->DbValue = $row['is_active'];
		$this->documentos->DbValue = $row['documentos'];
		$this->created_at->DbValue = $row['created_at'];
		$this->DateModified->DbValue = $row['DateModified'];
		$this->DateDeleted->DbValue = $row['DateDeleted'];
		$this->CreatedBy->DbValue = $row['CreatedBy'];
		$this->ModifiedBy->DbValue = $row['ModifiedBy'];
		$this->DeletedBy->DbValue = $row['DeletedBy'];
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
		// name
		// cell
		// phone
		// email
		// address
		// nombre_contacto
		// email_contacto
		// lastname
		// latitud

		$this->latitud->CellCssStyle = "white-space: nowrap;";

		// longitud
		$this->longitud->CellCssStyle = "white-space: nowrap;";

		// id_sucursal
		// tipoinmueble
		// id_ciudad_inmueble
		// id_provincia_inmueble

		$this->id_provincia_inmueble->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble01
		$this->imagen_inmueble01->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble02
		$this->imagen_inmueble02->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble03
		$this->imagen_inmueble03->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble04
		$this->imagen_inmueble04->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble05
		$this->imagen_inmueble05->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble06
		$this->imagen_inmueble06->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble07
		$this->imagen_inmueble07->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble08
		$this->imagen_inmueble08->CellCssStyle = "white-space: nowrap;";

		// tipovehiculo
		// id_ciudad_vehiculo
		// id_provincia_vehiculo
		// imagen_vehiculo01

		$this->imagen_vehiculo01->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo02
		$this->imagen_vehiculo02->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo03
		$this->imagen_vehiculo03->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo04
		$this->imagen_vehiculo04->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo05
		$this->imagen_vehiculo05->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo06
		$this->imagen_vehiculo06->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo07
		$this->imagen_vehiculo07->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo08
		$this->imagen_vehiculo08->CellCssStyle = "white-space: nowrap;";

		// tipomaquinaria
		// id_ciudad_maquinaria
		// id_provincia_maquinaria
		// imagen_maquinaria01

		$this->imagen_maquinaria01->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria02
		$this->imagen_maquinaria02->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria03
		$this->imagen_maquinaria03->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria04
		$this->imagen_maquinaria04->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria05
		$this->imagen_maquinaria05->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria06
		$this->imagen_maquinaria06->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria07
		$this->imagen_maquinaria07->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria08
		$this->imagen_maquinaria08->CellCssStyle = "white-space: nowrap;";

		// tipomercaderia
		// imagen_mercaderia01

		$this->imagen_mercaderia01->CellCssStyle = "white-space: nowrap;";

		// documento_mercaderia
		// tipoespecial
		// imagen_tipoespecial01

		$this->imagen_tipoespecial01->CellCssStyle = "white-space: nowrap;";

		// is_active
		$this->is_active->CellCssStyle = "white-space: nowrap;";

		// documentos
		$this->documentos->CellCssStyle = "white-space: nowrap;";

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
		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// id
		$this->id->ViewValue = $this->id->CurrentValue;
		$this->id->ViewCustomAttributes = "";

		// name
		$this->name->ViewValue = $this->name->CurrentValue;
		$this->name->ViewCustomAttributes = "";

		// cell
		$this->cell->ViewValue = $this->cell->CurrentValue;
		$this->cell->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// email_contacto
		$this->email_contacto->ViewValue = $this->email_contacto->CurrentValue;
		$this->email_contacto->ViewCustomAttributes = "";

		// lastname
		$this->lastname->ViewValue = $this->lastname->CurrentValue;
		$this->lastname->ViewCustomAttributes = "";

		// id_sucursal
		$this->id_sucursal->ViewValue = $this->id_sucursal->CurrentValue;
		$this->id_sucursal->ViewCustomAttributes = "";

		// tipoinmueble
		if (strval($this->tipoinmueble->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipoinmueble->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`nombre`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_STRING, "");
			}
		$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
		$sWhereWrk = "";
		$this->tipoinmueble->LookupFilters = array("dx1" => '`nombre`');
		$lookuptblfilter = "`tipo`='INMUEBLE'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tipoinmueble, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->tipoinmueble->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->tipoinmueble->ViewValue .= $this->tipoinmueble->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipoinmueble->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->tipoinmueble->ViewValue = $this->tipoinmueble->CurrentValue;
			}
		} else {
			$this->tipoinmueble->ViewValue = NULL;
		}
		$this->tipoinmueble->ViewCustomAttributes = "";

		// tipovehiculo
		if (strval($this->tipovehiculo->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipovehiculo->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`nombre`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_STRING, "");
			}
		$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
		$sWhereWrk = "";
		$this->tipovehiculo->LookupFilters = array("dx1" => '`nombre`');
		$lookuptblfilter = "`tipo`='VEHICULO'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tipovehiculo, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->tipovehiculo->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->tipovehiculo->ViewValue .= $this->tipovehiculo->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipovehiculo->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->tipovehiculo->ViewValue = $this->tipovehiculo->CurrentValue;
			}
		} else {
			$this->tipovehiculo->ViewValue = NULL;
		}
		$this->tipovehiculo->ViewCustomAttributes = "";

		// tipomaquinaria
		if (strval($this->tipomaquinaria->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipomaquinaria->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`nombre`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_STRING, "");
			}
		$sSqlWrk = "SELECT `nombre`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
		$sWhereWrk = "";
		$this->tipomaquinaria->LookupFilters = array("dx1" => '`nombre`');
		$lookuptblfilter = "`tipo`='MAQUINARIA'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tipomaquinaria, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->tipomaquinaria->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->tipomaquinaria->ViewValue .= $this->tipomaquinaria->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipomaquinaria->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->tipomaquinaria->ViewValue = $this->tipomaquinaria->CurrentValue;
			}
		} else {
			$this->tipomaquinaria->ViewValue = NULL;
		}
		$this->tipomaquinaria->ViewCustomAttributes = "";

		// tipomercaderia
		if (strval($this->tipomercaderia->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipomercaderia->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`id_tipoinmueble`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
		$sSqlWrk = "SELECT `id_tipoinmueble`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
		$sWhereWrk = "";
		$this->tipomercaderia->LookupFilters = array("dx1" => '`nombre`');
		$lookuptblfilter = "`tipo`='MERCADERIA'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tipomercaderia, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$this->tipomercaderia->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->tipomercaderia->ViewValue .= $this->tipomercaderia->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipomercaderia->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->tipomercaderia->ViewValue = $this->tipomercaderia->CurrentValue;
			}
		} else {
			$this->tipomercaderia->ViewValue = NULL;
		}
		$this->tipomercaderia->ViewCustomAttributes = "";

		// tipoespecial
		if (strval($this->tipoespecial->CurrentValue) <> "") {
			$sFilterWrk = "`id_tipoinmueble`" . ew_SearchString("=", $this->tipoespecial->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id_tipoinmueble`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `tipoinmueble`";
		$sWhereWrk = "";
		$this->tipoespecial->LookupFilters = array("dx1" => '`nombre`');
		$lookuptblfilter = "`tipo`='ESPECIAL'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->tipoespecial, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->tipoespecial->ViewValue = $this->tipoespecial->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->tipoespecial->ViewValue = $this->tipoespecial->CurrentValue;
			}
		} else {
			$this->tipoespecial->ViewValue = NULL;
		}
		$this->tipoespecial->ViewCustomAttributes = "";

		// documentos
		$this->documentos->ViewValue = $this->documentos->CurrentValue;
		$this->documentos->ViewCustomAttributes = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";
			$this->name->TooltipValue = "";

			// cell
			$this->cell->LinkCustomAttributes = "";
			$this->cell->HrefValue = "";
			$this->cell->TooltipValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";
			$this->phone->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";
			$this->address->TooltipValue = "";

			// email_contacto
			$this->email_contacto->LinkCustomAttributes = "";
			$this->email_contacto->HrefValue = "";
			$this->email_contacto->TooltipValue = "";

			// lastname
			$this->lastname->LinkCustomAttributes = "";
			$this->lastname->HrefValue = "";
			$this->lastname->TooltipValue = "";

			// tipoinmueble
			$this->tipoinmueble->LinkCustomAttributes = "";
			$this->tipoinmueble->HrefValue = "";
			$this->tipoinmueble->TooltipValue = "";

			// tipovehiculo
			$this->tipovehiculo->LinkCustomAttributes = "";
			$this->tipovehiculo->HrefValue = "";
			$this->tipovehiculo->TooltipValue = "";

			// tipomaquinaria
			$this->tipomaquinaria->LinkCustomAttributes = "";
			$this->tipomaquinaria->HrefValue = "";
			$this->tipomaquinaria->TooltipValue = "";

			// tipomercaderia
			$this->tipomercaderia->LinkCustomAttributes = "";
			$this->tipomercaderia->HrefValue = "";
			$this->tipomercaderia->TooltipValue = "";

			// tipoespecial
			$this->tipoespecial->LinkCustomAttributes = "";
			$this->tipoespecial->HrefValue = "";
			$this->tipoespecial->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// name
			$this->name->EditAttrs["class"] = "form-control";
			$this->name->EditCustomAttributes = "";
			$this->name->EditValue = ew_HtmlEncode($this->name->AdvancedSearch->SearchValue);
			$this->name->PlaceHolder = ew_RemoveHtml($this->name->FldTitle());

			// cell
			$this->cell->EditAttrs["class"] = "form-control";
			$this->cell->EditCustomAttributes = "";
			$this->cell->EditValue = ew_HtmlEncode($this->cell->AdvancedSearch->SearchValue);
			$this->cell->PlaceHolder = ew_RemoveHtml($this->cell->FldTitle());

			// phone
			$this->phone->EditAttrs["class"] = "form-control";
			$this->phone->EditCustomAttributes = "";
			$this->phone->EditValue = ew_HtmlEncode($this->phone->AdvancedSearch->SearchValue);
			$this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldTitle());

			// email
			$this->_email->EditAttrs["class"] = "form-control";
			$this->_email->EditCustomAttributes = "";
			$this->_email->EditValue = ew_HtmlEncode($this->_email->AdvancedSearch->SearchValue);
			$this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldTitle());

			// address
			$this->address->EditAttrs["class"] = "form-control";
			$this->address->EditCustomAttributes = "";
			$this->address->EditValue = ew_HtmlEncode($this->address->AdvancedSearch->SearchValue);
			$this->address->PlaceHolder = ew_RemoveHtml($this->address->FldTitle());

			// email_contacto
			$this->email_contacto->EditAttrs["class"] = "form-control";
			$this->email_contacto->EditCustomAttributes = "";
			$this->email_contacto->EditValue = ew_HtmlEncode($this->email_contacto->AdvancedSearch->SearchValue);
			$this->email_contacto->PlaceHolder = ew_RemoveHtml($this->email_contacto->FldTitle());

			// lastname
			$this->lastname->EditAttrs["class"] = "form-control";
			$this->lastname->EditCustomAttributes = "";
			$this->lastname->EditValue = ew_HtmlEncode($this->lastname->AdvancedSearch->SearchValue);
			$this->lastname->PlaceHolder = ew_RemoveHtml($this->lastname->FldTitle());

			// tipoinmueble
			$this->tipoinmueble->EditAttrs["class"] = "form-control";
			$this->tipoinmueble->EditCustomAttributes = "";

			// tipovehiculo
			$this->tipovehiculo->EditAttrs["class"] = "form-control";
			$this->tipovehiculo->EditCustomAttributes = "";

			// tipomaquinaria
			$this->tipomaquinaria->EditAttrs["class"] = "form-control";
			$this->tipomaquinaria->EditCustomAttributes = "";

			// tipomercaderia
			$this->tipomercaderia->EditAttrs["class"] = "form-control";
			$this->tipomercaderia->EditCustomAttributes = "";

			// tipoespecial
			$this->tipoespecial->EditAttrs["class"] = "form-control";
			$this->tipoespecial->EditCustomAttributes = "";
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
		$this->name->AdvancedSearch->Load();
		$this->cell->AdvancedSearch->Load();
		$this->phone->AdvancedSearch->Load();
		$this->_email->AdvancedSearch->Load();
		$this->address->AdvancedSearch->Load();
		$this->nombre_contacto->AdvancedSearch->Load();
		$this->email_contacto->AdvancedSearch->Load();
		$this->lastname->AdvancedSearch->Load();
		$this->id_sucursal->AdvancedSearch->Load();
		$this->tipoinmueble->AdvancedSearch->Load();
		$this->id_ciudad_inmueble->AdvancedSearch->Load();
		$this->id_provincia_inmueble->AdvancedSearch->Load();
		$this->tipovehiculo->AdvancedSearch->Load();
		$this->id_ciudad_vehiculo->AdvancedSearch->Load();
		$this->id_provincia_vehiculo->AdvancedSearch->Load();
		$this->tipomaquinaria->AdvancedSearch->Load();
		$this->id_ciudad_maquinaria->AdvancedSearch->Load();
		$this->id_provincia_maquinaria->AdvancedSearch->Load();
		$this->tipomercaderia->AdvancedSearch->Load();
		$this->documento_mercaderia->AdvancedSearch->Load();
		$this->tipoespecial->AdvancedSearch->Load();
		$this->is_active->AdvancedSearch->Load();
		$this->documentos->AdvancedSearch->Load();
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
		$item->Body = "<button id=\"emf_viewsolicitud\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_viewsolicitud',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fviewsolicitudlist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		$this->AddSearchQueryString($sQry, $this->name); // name
		$this->AddSearchQueryString($sQry, $this->cell); // cell
		$this->AddSearchQueryString($sQry, $this->phone); // phone
		$this->AddSearchQueryString($sQry, $this->_email); // email
		$this->AddSearchQueryString($sQry, $this->address); // address
		$this->AddSearchQueryString($sQry, $this->nombre_contacto); // nombre_contacto
		$this->AddSearchQueryString($sQry, $this->email_contacto); // email_contacto
		$this->AddSearchQueryString($sQry, $this->lastname); // lastname
		$this->AddSearchQueryString($sQry, $this->id_sucursal); // id_sucursal
		$this->AddSearchQueryString($sQry, $this->tipoinmueble); // tipoinmueble
		$this->AddSearchQueryString($sQry, $this->id_ciudad_inmueble); // id_ciudad_inmueble
		$this->AddSearchQueryString($sQry, $this->id_provincia_inmueble); // id_provincia_inmueble
		$this->AddSearchQueryString($sQry, $this->tipovehiculo); // tipovehiculo
		$this->AddSearchQueryString($sQry, $this->id_ciudad_vehiculo); // id_ciudad_vehiculo
		$this->AddSearchQueryString($sQry, $this->id_provincia_vehiculo); // id_provincia_vehiculo
		$this->AddSearchQueryString($sQry, $this->tipomaquinaria); // tipomaquinaria
		$this->AddSearchQueryString($sQry, $this->id_ciudad_maquinaria); // id_ciudad_maquinaria
		$this->AddSearchQueryString($sQry, $this->id_provincia_maquinaria); // id_provincia_maquinaria
		$this->AddSearchQueryString($sQry, $this->tipomercaderia); // tipomercaderia
		$this->AddSearchQueryString($sQry, $this->documento_mercaderia); // documento_mercaderia
		$this->AddSearchQueryString($sQry, $this->tipoespecial); // tipoespecial
		$this->AddSearchQueryString($sQry, $this->is_active); // is_active
		$this->AddSearchQueryString($sQry, $this->documentos); // documentos

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

			$this->ListOptions->Items["edit"]->Visible = FALSE;
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
if (!isset($viewsolicitud_list)) $viewsolicitud_list = new cviewsolicitud_list();

// Page init
$viewsolicitud_list->Page_Init();

// Page main
$viewsolicitud_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewsolicitud_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($viewsolicitud->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fviewsolicitudlist = new ew_Form("fviewsolicitudlist", "list");
fviewsolicitudlist.FormKeyCountName = '<?php echo $viewsolicitud_list->FormKeyCountName ?>';

// Form_CustomValidate event
fviewsolicitudlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewsolicitudlist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewsolicitudlist.Lists["x_tipoinmueble[]"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewsolicitudlist.Lists["x_tipoinmueble[]"].Data = "<?php echo $viewsolicitud_list->tipoinmueble->LookupFilterQuery(FALSE, "list") ?>";
fviewsolicitudlist.Lists["x_tipovehiculo[]"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewsolicitudlist.Lists["x_tipovehiculo[]"].Data = "<?php echo $viewsolicitud_list->tipovehiculo->LookupFilterQuery(FALSE, "list") ?>";
fviewsolicitudlist.Lists["x_tipomaquinaria[]"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewsolicitudlist.Lists["x_tipomaquinaria[]"].Data = "<?php echo $viewsolicitud_list->tipomaquinaria->LookupFilterQuery(FALSE, "list") ?>";
fviewsolicitudlist.Lists["x_tipomercaderia[]"] = {"LinkField":"x_id_tipoinmueble","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewsolicitudlist.Lists["x_tipomercaderia[]"].Data = "<?php echo $viewsolicitud_list->tipomercaderia->LookupFilterQuery(FALSE, "list") ?>";
fviewsolicitudlist.Lists["x_tipoespecial"] = {"LinkField":"x_id_tipoinmueble","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewsolicitudlist.Lists["x_tipoespecial"].Data = "<?php echo $viewsolicitud_list->tipoespecial->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = fviewsolicitudlistsrch = new ew_Form("fviewsolicitudlistsrch");

// Validate function for search
fviewsolicitudlistsrch.Validate = function(fobj) {
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
fviewsolicitudlistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewsolicitudlistsrch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($viewsolicitud->Export == "") { ?>
<div class="ewToolbar">
<?php if ($viewsolicitud_list->TotalRecs > 0 && $viewsolicitud_list->ExportOptions->Visible()) { ?>
<?php $viewsolicitud_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($viewsolicitud_list->SearchOptions->Visible()) { ?>
<?php $viewsolicitud_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($viewsolicitud_list->FilterOptions->Visible()) { ?>
<?php $viewsolicitud_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $viewsolicitud_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($viewsolicitud_list->TotalRecs <= 0)
			$viewsolicitud_list->TotalRecs = $viewsolicitud->ListRecordCount();
	} else {
		if (!$viewsolicitud_list->Recordset && ($viewsolicitud_list->Recordset = $viewsolicitud_list->LoadRecordset()))
			$viewsolicitud_list->TotalRecs = $viewsolicitud_list->Recordset->RecordCount();
	}
	$viewsolicitud_list->StartRec = 1;
	if ($viewsolicitud_list->DisplayRecs <= 0 || ($viewsolicitud->Export <> "" && $viewsolicitud->ExportAll)) // Display all records
		$viewsolicitud_list->DisplayRecs = $viewsolicitud_list->TotalRecs;
	if (!($viewsolicitud->Export <> "" && $viewsolicitud->ExportAll))
		$viewsolicitud_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$viewsolicitud_list->Recordset = $viewsolicitud_list->LoadRecordset($viewsolicitud_list->StartRec-1, $viewsolicitud_list->DisplayRecs);

	// Set no record found message
	if ($viewsolicitud->CurrentAction == "" && $viewsolicitud_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$viewsolicitud_list->setWarningMessage(ew_DeniedMsg());
		if ($viewsolicitud_list->SearchWhere == "0=101")
			$viewsolicitud_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$viewsolicitud_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$viewsolicitud_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($viewsolicitud->Export == "" && $viewsolicitud->CurrentAction == "") { ?>
<form name="fviewsolicitudlistsrch" id="fviewsolicitudlistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($viewsolicitud_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fviewsolicitudlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="viewsolicitud">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$viewsolicitud_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$viewsolicitud->RowType = EW_ROWTYPE_SEARCH;

// Render row
$viewsolicitud->ResetAttrs();
$viewsolicitud_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($viewsolicitud->name->Visible) { // name ?>
	<div id="xsc_name" class="ewCell form-group">
		<label for="x_name" class="ewSearchCaption ewLabel"><?php echo $viewsolicitud->name->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_name" id="z_name" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" data-table="viewsolicitud" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewsolicitud->name->getPlaceHolder()) ?>" value="<?php echo $viewsolicitud->name->EditValue ?>"<?php echo $viewsolicitud->name->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
<?php if ($viewsolicitud->_email->Visible) { // email ?>
	<div id="xsc__email" class="ewCell form-group">
		<label for="x__email" class="ewSearchCaption ewLabel"><?php echo $viewsolicitud->_email->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z__email" id="z__email" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" data-table="viewsolicitud" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitud->_email->getPlaceHolder()) ?>" value="<?php echo $viewsolicitud->_email->EditValue ?>"<?php echo $viewsolicitud->_email->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ewRow">
<?php if ($viewsolicitud->lastname->Visible) { // lastname ?>
	<div id="xsc_lastname" class="ewCell form-group">
		<label for="x_lastname" class="ewSearchCaption ewLabel"><?php echo $viewsolicitud->lastname->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_lastname" id="z_lastname" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" data-table="viewsolicitud" data-field="x_lastname" name="x_lastname" id="x_lastname" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewsolicitud->lastname->getPlaceHolder()) ?>" value="<?php echo $viewsolicitud->lastname->EditValue ?>"<?php echo $viewsolicitud->lastname->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_4" class="ewRow">
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $viewsolicitud_list->ShowPageHeader(); ?>
<?php
$viewsolicitud_list->ShowMessage();
?>
<?php if ($viewsolicitud_list->TotalRecs > 0 || $viewsolicitud->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($viewsolicitud_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewsolicitud">
<form name="fviewsolicitudlist" id="fviewsolicitudlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewsolicitud_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewsolicitud_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewsolicitud">
<div id="gmp_viewsolicitud" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($viewsolicitud_list->TotalRecs > 0 || $viewsolicitud->CurrentAction == "gridedit") { ?>
<table id="tbl_viewsolicitudlist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$viewsolicitud_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$viewsolicitud_list->RenderListOptions();

// Render list options (header, left)
$viewsolicitud_list->ListOptions->Render("header", "left");
?>
<?php if ($viewsolicitud->name->Visible) { // name ?>
	<?php if ($viewsolicitud->SortUrl($viewsolicitud->name) == "") { ?>
		<th data-name="name" class="<?php echo $viewsolicitud->name->HeaderCellClass() ?>"><div id="elh_viewsolicitud_name" class="viewsolicitud_name"><div class="ewTableHeaderCaption"><?php echo $viewsolicitud->name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $viewsolicitud->name->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitud->SortUrl($viewsolicitud->name) ?>',1);"><div id="elh_viewsolicitud_name" class="viewsolicitud_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitud->name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitud->name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitud->name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewsolicitud->cell->Visible) { // cell ?>
	<?php if ($viewsolicitud->SortUrl($viewsolicitud->cell) == "") { ?>
		<th data-name="cell" class="<?php echo $viewsolicitud->cell->HeaderCellClass() ?>"><div id="elh_viewsolicitud_cell" class="viewsolicitud_cell"><div class="ewTableHeaderCaption"><?php echo $viewsolicitud->cell->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cell" class="<?php echo $viewsolicitud->cell->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitud->SortUrl($viewsolicitud->cell) ?>',1);"><div id="elh_viewsolicitud_cell" class="viewsolicitud_cell">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitud->cell->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitud->cell->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitud->cell->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewsolicitud->phone->Visible) { // phone ?>
	<?php if ($viewsolicitud->SortUrl($viewsolicitud->phone) == "") { ?>
		<th data-name="phone" class="<?php echo $viewsolicitud->phone->HeaderCellClass() ?>"><div id="elh_viewsolicitud_phone" class="viewsolicitud_phone"><div class="ewTableHeaderCaption"><?php echo $viewsolicitud->phone->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="phone" class="<?php echo $viewsolicitud->phone->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitud->SortUrl($viewsolicitud->phone) ?>',1);"><div id="elh_viewsolicitud_phone" class="viewsolicitud_phone">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitud->phone->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitud->phone->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitud->phone->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewsolicitud->_email->Visible) { // email ?>
	<?php if ($viewsolicitud->SortUrl($viewsolicitud->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $viewsolicitud->_email->HeaderCellClass() ?>"><div id="elh_viewsolicitud__email" class="viewsolicitud__email"><div class="ewTableHeaderCaption"><?php echo $viewsolicitud->_email->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $viewsolicitud->_email->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitud->SortUrl($viewsolicitud->_email) ?>',1);"><div id="elh_viewsolicitud__email" class="viewsolicitud__email">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitud->_email->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitud->_email->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitud->_email->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewsolicitud->address->Visible) { // address ?>
	<?php if ($viewsolicitud->SortUrl($viewsolicitud->address) == "") { ?>
		<th data-name="address" class="<?php echo $viewsolicitud->address->HeaderCellClass() ?>"><div id="elh_viewsolicitud_address" class="viewsolicitud_address"><div class="ewTableHeaderCaption"><?php echo $viewsolicitud->address->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="address" class="<?php echo $viewsolicitud->address->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitud->SortUrl($viewsolicitud->address) ?>',1);"><div id="elh_viewsolicitud_address" class="viewsolicitud_address">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitud->address->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitud->address->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitud->address->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewsolicitud->email_contacto->Visible) { // email_contacto ?>
	<?php if ($viewsolicitud->SortUrl($viewsolicitud->email_contacto) == "") { ?>
		<th data-name="email_contacto" class="<?php echo $viewsolicitud->email_contacto->HeaderCellClass() ?>"><div id="elh_viewsolicitud_email_contacto" class="viewsolicitud_email_contacto"><div class="ewTableHeaderCaption"><?php echo $viewsolicitud->email_contacto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="email_contacto" class="<?php echo $viewsolicitud->email_contacto->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitud->SortUrl($viewsolicitud->email_contacto) ?>',1);"><div id="elh_viewsolicitud_email_contacto" class="viewsolicitud_email_contacto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitud->email_contacto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitud->email_contacto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitud->email_contacto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewsolicitud->lastname->Visible) { // lastname ?>
	<?php if ($viewsolicitud->SortUrl($viewsolicitud->lastname) == "") { ?>
		<th data-name="lastname" class="<?php echo $viewsolicitud->lastname->HeaderCellClass() ?>"><div id="elh_viewsolicitud_lastname" class="viewsolicitud_lastname"><div class="ewTableHeaderCaption"><?php echo $viewsolicitud->lastname->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lastname" class="<?php echo $viewsolicitud->lastname->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitud->SortUrl($viewsolicitud->lastname) ?>',1);"><div id="elh_viewsolicitud_lastname" class="viewsolicitud_lastname">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitud->lastname->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitud->lastname->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitud->lastname->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewsolicitud->tipoinmueble->Visible) { // tipoinmueble ?>
	<?php if ($viewsolicitud->SortUrl($viewsolicitud->tipoinmueble) == "") { ?>
		<th data-name="tipoinmueble" class="<?php echo $viewsolicitud->tipoinmueble->HeaderCellClass() ?>"><div id="elh_viewsolicitud_tipoinmueble" class="viewsolicitud_tipoinmueble"><div class="ewTableHeaderCaption"><?php echo $viewsolicitud->tipoinmueble->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipoinmueble" class="<?php echo $viewsolicitud->tipoinmueble->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitud->SortUrl($viewsolicitud->tipoinmueble) ?>',1);"><div id="elh_viewsolicitud_tipoinmueble" class="viewsolicitud_tipoinmueble">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitud->tipoinmueble->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitud->tipoinmueble->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitud->tipoinmueble->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewsolicitud->tipovehiculo->Visible) { // tipovehiculo ?>
	<?php if ($viewsolicitud->SortUrl($viewsolicitud->tipovehiculo) == "") { ?>
		<th data-name="tipovehiculo" class="<?php echo $viewsolicitud->tipovehiculo->HeaderCellClass() ?>"><div id="elh_viewsolicitud_tipovehiculo" class="viewsolicitud_tipovehiculo"><div class="ewTableHeaderCaption"><?php echo $viewsolicitud->tipovehiculo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipovehiculo" class="<?php echo $viewsolicitud->tipovehiculo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitud->SortUrl($viewsolicitud->tipovehiculo) ?>',1);"><div id="elh_viewsolicitud_tipovehiculo" class="viewsolicitud_tipovehiculo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitud->tipovehiculo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitud->tipovehiculo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitud->tipovehiculo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewsolicitud->tipomaquinaria->Visible) { // tipomaquinaria ?>
	<?php if ($viewsolicitud->SortUrl($viewsolicitud->tipomaquinaria) == "") { ?>
		<th data-name="tipomaquinaria" class="<?php echo $viewsolicitud->tipomaquinaria->HeaderCellClass() ?>"><div id="elh_viewsolicitud_tipomaquinaria" class="viewsolicitud_tipomaquinaria"><div class="ewTableHeaderCaption"><?php echo $viewsolicitud->tipomaquinaria->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipomaquinaria" class="<?php echo $viewsolicitud->tipomaquinaria->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitud->SortUrl($viewsolicitud->tipomaquinaria) ?>',1);"><div id="elh_viewsolicitud_tipomaquinaria" class="viewsolicitud_tipomaquinaria">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitud->tipomaquinaria->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitud->tipomaquinaria->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitud->tipomaquinaria->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewsolicitud->tipomercaderia->Visible) { // tipomercaderia ?>
	<?php if ($viewsolicitud->SortUrl($viewsolicitud->tipomercaderia) == "") { ?>
		<th data-name="tipomercaderia" class="<?php echo $viewsolicitud->tipomercaderia->HeaderCellClass() ?>"><div id="elh_viewsolicitud_tipomercaderia" class="viewsolicitud_tipomercaderia"><div class="ewTableHeaderCaption"><?php echo $viewsolicitud->tipomercaderia->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipomercaderia" class="<?php echo $viewsolicitud->tipomercaderia->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitud->SortUrl($viewsolicitud->tipomercaderia) ?>',1);"><div id="elh_viewsolicitud_tipomercaderia" class="viewsolicitud_tipomercaderia">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitud->tipomercaderia->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitud->tipomercaderia->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitud->tipomercaderia->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewsolicitud->tipoespecial->Visible) { // tipoespecial ?>
	<?php if ($viewsolicitud->SortUrl($viewsolicitud->tipoespecial) == "") { ?>
		<th data-name="tipoespecial" class="<?php echo $viewsolicitud->tipoespecial->HeaderCellClass() ?>"><div id="elh_viewsolicitud_tipoespecial" class="viewsolicitud_tipoespecial"><div class="ewTableHeaderCaption"><?php echo $viewsolicitud->tipoespecial->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipoespecial" class="<?php echo $viewsolicitud->tipoespecial->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitud->SortUrl($viewsolicitud->tipoespecial) ?>',1);"><div id="elh_viewsolicitud_tipoespecial" class="viewsolicitud_tipoespecial">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitud->tipoespecial->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitud->tipoespecial->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitud->tipoespecial->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$viewsolicitud_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($viewsolicitud->ExportAll && $viewsolicitud->Export <> "") {
	$viewsolicitud_list->StopRec = $viewsolicitud_list->TotalRecs;
} else {

	// Set the last record to display
	if ($viewsolicitud_list->TotalRecs > $viewsolicitud_list->StartRec + $viewsolicitud_list->DisplayRecs - 1)
		$viewsolicitud_list->StopRec = $viewsolicitud_list->StartRec + $viewsolicitud_list->DisplayRecs - 1;
	else
		$viewsolicitud_list->StopRec = $viewsolicitud_list->TotalRecs;
}
$viewsolicitud_list->RecCnt = $viewsolicitud_list->StartRec - 1;
if ($viewsolicitud_list->Recordset && !$viewsolicitud_list->Recordset->EOF) {
	$viewsolicitud_list->Recordset->MoveFirst();
	$bSelectLimit = $viewsolicitud_list->UseSelectLimit;
	if (!$bSelectLimit && $viewsolicitud_list->StartRec > 1)
		$viewsolicitud_list->Recordset->Move($viewsolicitud_list->StartRec - 1);
} elseif (!$viewsolicitud->AllowAddDeleteRow && $viewsolicitud_list->StopRec == 0) {
	$viewsolicitud_list->StopRec = $viewsolicitud->GridAddRowCount;
}

// Initialize aggregate
$viewsolicitud->RowType = EW_ROWTYPE_AGGREGATEINIT;
$viewsolicitud->ResetAttrs();
$viewsolicitud_list->RenderRow();
while ($viewsolicitud_list->RecCnt < $viewsolicitud_list->StopRec) {
	$viewsolicitud_list->RecCnt++;
	if (intval($viewsolicitud_list->RecCnt) >= intval($viewsolicitud_list->StartRec)) {
		$viewsolicitud_list->RowCnt++;

		// Set up key count
		$viewsolicitud_list->KeyCount = $viewsolicitud_list->RowIndex;

		// Init row class and style
		$viewsolicitud->ResetAttrs();
		$viewsolicitud->CssClass = "";
		if ($viewsolicitud->CurrentAction == "gridadd") {
		} else {
			$viewsolicitud_list->LoadRowValues($viewsolicitud_list->Recordset); // Load row values
		}
		$viewsolicitud->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$viewsolicitud->RowAttrs = array_merge($viewsolicitud->RowAttrs, array('data-rowindex'=>$viewsolicitud_list->RowCnt, 'id'=>'r' . $viewsolicitud_list->RowCnt . '_viewsolicitud', 'data-rowtype'=>$viewsolicitud->RowType));

		// Render row
		$viewsolicitud_list->RenderRow();

		// Render list options
		$viewsolicitud_list->RenderListOptions();
?>
	<tr<?php echo $viewsolicitud->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewsolicitud_list->ListOptions->Render("body", "left", $viewsolicitud_list->RowCnt);
?>
	<?php if ($viewsolicitud->name->Visible) { // name ?>
		<td data-name="name"<?php echo $viewsolicitud->name->CellAttributes() ?>>
<span id="el<?php echo $viewsolicitud_list->RowCnt ?>_viewsolicitud_name" class="viewsolicitud_name">
<span<?php echo $viewsolicitud->name->ViewAttributes() ?>>
<?php echo $viewsolicitud->name->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewsolicitud->cell->Visible) { // cell ?>
		<td data-name="cell"<?php echo $viewsolicitud->cell->CellAttributes() ?>>
<span id="el<?php echo $viewsolicitud_list->RowCnt ?>_viewsolicitud_cell" class="viewsolicitud_cell">
<span<?php echo $viewsolicitud->cell->ViewAttributes() ?>>
<?php echo $viewsolicitud->cell->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewsolicitud->phone->Visible) { // phone ?>
		<td data-name="phone"<?php echo $viewsolicitud->phone->CellAttributes() ?>>
<span id="el<?php echo $viewsolicitud_list->RowCnt ?>_viewsolicitud_phone" class="viewsolicitud_phone">
<span<?php echo $viewsolicitud->phone->ViewAttributes() ?>>
<?php echo $viewsolicitud->phone->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewsolicitud->_email->Visible) { // email ?>
		<td data-name="_email"<?php echo $viewsolicitud->_email->CellAttributes() ?>>
<span id="el<?php echo $viewsolicitud_list->RowCnt ?>_viewsolicitud__email" class="viewsolicitud__email">
<span<?php echo $viewsolicitud->_email->ViewAttributes() ?>>
<?php echo $viewsolicitud->_email->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewsolicitud->address->Visible) { // address ?>
		<td data-name="address"<?php echo $viewsolicitud->address->CellAttributes() ?>>
<span id="el<?php echo $viewsolicitud_list->RowCnt ?>_viewsolicitud_address" class="viewsolicitud_address">
<span<?php echo $viewsolicitud->address->ViewAttributes() ?>>
<?php echo $viewsolicitud->address->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewsolicitud->email_contacto->Visible) { // email_contacto ?>
		<td data-name="email_contacto"<?php echo $viewsolicitud->email_contacto->CellAttributes() ?>>
<span id="el<?php echo $viewsolicitud_list->RowCnt ?>_viewsolicitud_email_contacto" class="viewsolicitud_email_contacto">
<span<?php echo $viewsolicitud->email_contacto->ViewAttributes() ?>>
<?php echo $viewsolicitud->email_contacto->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewsolicitud->lastname->Visible) { // lastname ?>
		<td data-name="lastname"<?php echo $viewsolicitud->lastname->CellAttributes() ?>>
<span id="el<?php echo $viewsolicitud_list->RowCnt ?>_viewsolicitud_lastname" class="viewsolicitud_lastname">
<span<?php echo $viewsolicitud->lastname->ViewAttributes() ?>>
<?php echo $viewsolicitud->lastname->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewsolicitud->tipoinmueble->Visible) { // tipoinmueble ?>
		<td data-name="tipoinmueble"<?php echo $viewsolicitud->tipoinmueble->CellAttributes() ?>>
<span id="el<?php echo $viewsolicitud_list->RowCnt ?>_viewsolicitud_tipoinmueble" class="viewsolicitud_tipoinmueble">
<span<?php echo $viewsolicitud->tipoinmueble->ViewAttributes() ?>>
<?php echo $viewsolicitud->tipoinmueble->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewsolicitud->tipovehiculo->Visible) { // tipovehiculo ?>
		<td data-name="tipovehiculo"<?php echo $viewsolicitud->tipovehiculo->CellAttributes() ?>>
<span id="el<?php echo $viewsolicitud_list->RowCnt ?>_viewsolicitud_tipovehiculo" class="viewsolicitud_tipovehiculo">
<span<?php echo $viewsolicitud->tipovehiculo->ViewAttributes() ?>>
<?php echo $viewsolicitud->tipovehiculo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewsolicitud->tipomaquinaria->Visible) { // tipomaquinaria ?>
		<td data-name="tipomaquinaria"<?php echo $viewsolicitud->tipomaquinaria->CellAttributes() ?>>
<span id="el<?php echo $viewsolicitud_list->RowCnt ?>_viewsolicitud_tipomaquinaria" class="viewsolicitud_tipomaquinaria">
<span<?php echo $viewsolicitud->tipomaquinaria->ViewAttributes() ?>>
<?php echo $viewsolicitud->tipomaquinaria->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewsolicitud->tipomercaderia->Visible) { // tipomercaderia ?>
		<td data-name="tipomercaderia"<?php echo $viewsolicitud->tipomercaderia->CellAttributes() ?>>
<span id="el<?php echo $viewsolicitud_list->RowCnt ?>_viewsolicitud_tipomercaderia" class="viewsolicitud_tipomercaderia">
<span<?php echo $viewsolicitud->tipomercaderia->ViewAttributes() ?>>
<?php echo $viewsolicitud->tipomercaderia->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewsolicitud->tipoespecial->Visible) { // tipoespecial ?>
		<td data-name="tipoespecial"<?php echo $viewsolicitud->tipoespecial->CellAttributes() ?>>
<span id="el<?php echo $viewsolicitud_list->RowCnt ?>_viewsolicitud_tipoespecial" class="viewsolicitud_tipoespecial">
<span<?php echo $viewsolicitud->tipoespecial->ViewAttributes() ?>>
<?php echo $viewsolicitud->tipoespecial->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewsolicitud_list->ListOptions->Render("body", "right", $viewsolicitud_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($viewsolicitud->CurrentAction <> "gridadd")
		$viewsolicitud_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($viewsolicitud->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($viewsolicitud_list->Recordset)
	$viewsolicitud_list->Recordset->Close();
?>
<?php if ($viewsolicitud->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($viewsolicitud->CurrentAction <> "gridadd" && $viewsolicitud->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($viewsolicitud_list->Pager)) $viewsolicitud_list->Pager = new cNumericPager($viewsolicitud_list->StartRec, $viewsolicitud_list->DisplayRecs, $viewsolicitud_list->TotalRecs, $viewsolicitud_list->RecRange, $viewsolicitud_list->AutoHidePager) ?>
<?php if ($viewsolicitud_list->Pager->RecordCount > 0 && $viewsolicitud_list->Pager->Visible) { ?>
<div class="ewPager">
<div class="ewNumericPage"><ul class="pagination">
	<?php if ($viewsolicitud_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $viewsolicitud_list->PageUrl() ?>start=<?php echo $viewsolicitud_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($viewsolicitud_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $viewsolicitud_list->PageUrl() ?>start=<?php echo $viewsolicitud_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($viewsolicitud_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $viewsolicitud_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($viewsolicitud_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $viewsolicitud_list->PageUrl() ?>start=<?php echo $viewsolicitud_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($viewsolicitud_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $viewsolicitud_list->PageUrl() ?>start=<?php echo $viewsolicitud_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($viewsolicitud_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $viewsolicitud_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $viewsolicitud_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $viewsolicitud_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($viewsolicitud_list->TotalRecs > 0 && (!$viewsolicitud_list->AutoHidePageSizeSelector || $viewsolicitud_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="viewsolicitud">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($viewsolicitud_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($viewsolicitud_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($viewsolicitud_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($viewsolicitud->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewsolicitud_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($viewsolicitud_list->TotalRecs == 0 && $viewsolicitud->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewsolicitud_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($viewsolicitud->Export == "") { ?>
<script type="text/javascript">
fviewsolicitudlistsrch.FilterList = <?php echo $viewsolicitud_list->GetFilterList() ?>;
fviewsolicitudlistsrch.Init();
fviewsolicitudlist.Init();
</script>
<?php } ?>
<?php
$viewsolicitud_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($viewsolicitud->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$viewsolicitud_list->Page_Terminate();
?>
