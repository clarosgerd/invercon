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

$viewavaluo_list = NULL; // Initialize page object first

class cviewavaluo_list extends cviewavaluo {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewavaluo';

	// Page object name
	var $PageObjName = 'viewavaluo_list';

	// Grid form hidden field names
	var $FormName = 'fviewavaluolist';
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

		// Table object (viewavaluo)
		if (!isset($GLOBALS["viewavaluo"]) || get_class($GLOBALS["viewavaluo"]) == "cviewavaluo") {
			$GLOBALS["viewavaluo"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["viewavaluo"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "viewavaluoadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "viewavaluodelete.php";
		$this->MultiUpdateUrl = "viewavaluoupdate.php";

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Table object (viewsolicitud)
		if (!isset($GLOBALS['viewsolicitud'])) $GLOBALS['viewsolicitud'] = new cviewsolicitud();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fviewavaluolistsrch";

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

		$this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

		// Get grid add count
		$gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
		if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
			$this->GridAddRowCount = $gridaddcnt;

		// Set up list options
		$this->SetupListOptions();
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

		// Set up master detail parameters
		$this->SetupMasterParms();

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
			ew_AddFilter($this->DefaultSearchWhere, $this->BasicSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

			// Process filter list
			$this->ProcessFilterList();

			// Restore search parms from Session if not searching / reset / export
			if (($this->Export <> "" || $this->Command <> "search" && $this->Command <> "reset" && $this->Command <> "resetall") && $this->Command <> "json" && $this->CheckSearchParms())
				$this->RestoreSearchParms();

			// Call Recordset SearchValidated event
			$this->Recordset_SearchValidated();

			// Set up sorting order
			$this->SetupSortOrder();

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();
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

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();
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

		// Restore master/detail filter
		$this->DbMasterFilter = $this->GetMasterFilter(); // Restore master filter
		$this->DbDetailFilter = $this->GetDetailFilter(); // Restore detail filter
		ew_AddFilter($sFilter, $this->DbDetailFilter);
		ew_AddFilter($sFilter, $this->SearchWhere);

		// Load master record
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "viewsolicitud") {
			global $viewsolicitud;
			$rsmaster = $viewsolicitud->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("viewsolicitudlist.php"); // Return to master page
			} else {
				$viewsolicitud->LoadListRowValues($rsmaster);
				$viewsolicitud->RowType = EW_ROWTYPE_MASTER; // Master row
				$viewsolicitud->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Set up filter
		if ($this->Command == "json") {
			$this->UseSessionForListSQL = FALSE; // Do not use session for ListSQL
			$this->CurrentFilter = $sFilter;
		} else {
			$this->setSessionWhere($sFilter);
			$this->CurrentFilter = "";
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
			$sSavedFilterList = $UserProfile->GetSearchFilters(CurrentUserName(), "fviewavaluolistsrch");
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
		if ($this->BasicSearch->Keyword <> "") {
			$sWrk = "\"" . EW_TABLE_BASIC_SEARCH . "\":\"" . ew_JsEncode2($this->BasicSearch->Keyword) . "\",\"" . EW_TABLE_BASIC_SEARCH_TYPE . "\":\"" . ew_JsEncode2($this->BasicSearch->Type) . "\"";
			$sFilterList = ew_Concat($sFilterList, $sWrk, ",");
		}
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fviewavaluolistsrch", $filters);

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
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->tipoinmueble, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->codigoavaluo, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->id_oficialcredito, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->id_inspector, $arKeywords, $type);
		return $sWhere;
	}

	// Build basic search SQL
	function BuildBasicSearchSQL(&$Where, &$Fld, $arKeywords, $type) {
		global $EW_BASIC_SEARCH_IGNORE_PATTERN;
		$sDefCond = ($type == "OR") ? "OR" : "AND";
		$arSQL = array(); // Array for SQL parts
		$arCond = array(); // Array for search conditions
		$cnt = count($arKeywords);
		$j = 0; // Number of SQL parts
		for ($i = 0; $i < $cnt; $i++) {
			$Keyword = $arKeywords[$i];
			$Keyword = trim($Keyword);
			if ($EW_BASIC_SEARCH_IGNORE_PATTERN <> "") {
				$Keyword = preg_replace($EW_BASIC_SEARCH_IGNORE_PATTERN, "\\", $Keyword);
				$ar = explode("\\", $Keyword);
			} else {
				$ar = array($Keyword);
			}
			foreach ($ar as $Keyword) {
				if ($Keyword <> "") {
					$sWrk = "";
					if ($Keyword == "OR" && $type == "") {
						if ($j > 0)
							$arCond[$j-1] = "OR";
					} elseif ($Keyword == EW_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NULL";
					} elseif ($Keyword == EW_NOT_NULL_VALUE) {
						$sWrk = $Fld->FldExpression . " IS NOT NULL";
					} elseif ($Fld->FldIsVirtual) {
						$sWrk = $Fld->FldVirtualExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					} elseif ($Fld->FldDataType != EW_DATATYPE_NUMBER || is_numeric($Keyword)) {
						$sWrk = $Fld->FldBasicSearchExpression . ew_Like(ew_QuotedValue("%" . $Keyword . "%", EW_DATATYPE_STRING, $this->DBID), $this->DBID);
					}
					if ($sWrk <> "") {
						$arSQL[$j] = $sWrk;
						$arCond[$j] = $sDefCond;
						$j += 1;
					}
				}
			}
		}
		$cnt = count($arSQL);
		$bQuoted = FALSE;
		$sSql = "";
		if ($cnt > 0) {
			for ($i = 0; $i < $cnt-1; $i++) {
				if ($arCond[$i] == "OR") {
					if (!$bQuoted) $sSql .= "(";
					$bQuoted = TRUE;
				}
				$sSql .= $arSQL[$i];
				if ($bQuoted && $arCond[$i] <> "OR") {
					$sSql .= ")";
					$bQuoted = FALSE;
				}
				$sSql .= " " . $arCond[$i] . " ";
			}
			$sSql .= $arSQL[$cnt-1];
			if ($bQuoted)
				$sSql .= ")";
		}
		if ($sSql <> "") {
			if ($Where <> "") $Where .= " OR ";
			$Where .= "(" . $sSql . ")";
		}
	}

	// Return basic search WHERE clause based on search keyword and type
	function BasicSearchWhere($Default = FALSE) {
		global $Security;
		$sSearchStr = "";
		if (!$Security->CanSearch()) return "";
		$sSearchKeyword = ($Default) ? $this->BasicSearch->KeywordDefault : $this->BasicSearch->Keyword;
		$sSearchType = ($Default) ? $this->BasicSearch->TypeDefault : $this->BasicSearch->Type;

		// Get search SQL
		if ($sSearchKeyword <> "") {
			$ar = $this->BasicSearch->KeywordList($Default);

			// Search keyword in any fields
			if (($sSearchType == "OR" || $sSearchType == "AND") && $this->BasicSearch->BasicSearchAnyFields) {
				foreach ($ar as $sKeyword) {
					if ($sKeyword <> "") {
						if ($sSearchStr <> "") $sSearchStr .= " " . $sSearchType . " ";
						$sSearchStr .= "(" . $this->BasicSearchSQL(array($sKeyword), $sSearchType) . ")";
					}
				}
			} else {
				$sSearchStr = $this->BasicSearchSQL($ar, $sSearchType);
			}
			if (!$Default && in_array($this->Command, array("", "reset", "resetall"))) $this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->BasicSearch->setKeyword($sSearchKeyword);
			$this->BasicSearch->setType($sSearchType);
		}
		return $sSearchStr;
	}

	// Check if search parm exists
	function CheckSearchParms() {

		// Check basic search
		if ($this->BasicSearch->IssetSession())
			return TRUE;
		return FALSE;
	}

	// Clear all search parameters
	function ResetSearchParms() {

		// Clear search WHERE clause
		$this->SearchWhere = "";
		$this->setSearchWhere($this->SearchWhere);

		// Clear basic search parameters
		$this->ResetBasicSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();
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
			$this->UpdateSort($this->id_cliente); // id_cliente
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

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->id_solicitud->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->tipoinmueble->setSort("");
				$this->codigoavaluo->setSort("");
				$this->id_solicitud->setSort("");
				$this->id_oficialcredito->setSort("");
				$this->id_inspector->setSort("");
				$this->id_cliente->setSort("");
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

		// "view"
		$item = &$this->ListOptions->Add("view");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanView();
		$item->OnLeft = TRUE;

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
		$this->ListOptions->UseDropDownButton = TRUE;
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

		// "view"
		$oListOpt = &$this->ListOptions->Items["view"];
		$viewcaption = ew_HtmlTitle($Language->Phrase("ViewLink"));
		if ($Security->CanView()) {
			if (ew_IsMobile())
				$oListOpt->Body = "<a class=\"ewRowLink ewView\" title=\"" . $viewcaption . "\" data-caption=\"" . $viewcaption . "\" href=\"" . ew_HtmlEncode($this->ViewUrl) . "\">" . $Language->Phrase("ViewLink") . "</a>";
			else
				$oListOpt->Body = "<a class=\"ewRowLink ewView\" title=\"" . $viewcaption . "\" data-table=\"viewavaluo\" data-caption=\"" . $viewcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,url:'" . ew_HtmlEncode($this->ViewUrl) . "',btn:null});\">" . $Language->Phrase("ViewLink") . "</a>";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fviewavaluolistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fviewavaluolistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fviewavaluolist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fviewavaluolistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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

	// Load basic search values
	function LoadBasicSearchValues() {
		$this->BasicSearch->Keyword = @$_GET[EW_TABLE_BASIC_SEARCH];
		if ($this->BasicSearch->Keyword <> "" && $this->Command == "") $this->Command = "search";
		$this->BasicSearch->Type = @$_GET[EW_TABLE_BASIC_SEARCH_TYPE];
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
		// tipoinmueble
		// codigoavaluo
		// id_solicitud
		// id_oficialcredito
		// id_inspector
		// id_cliente
		// is_active

		$this->is_active->CellCssStyle = "white-space: nowrap;";

		// estado
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
		$this->estado->ViewValue = $this->estado->CurrentValue;
		$this->estado->ViewCustomAttributes = "";

		// estadopago
		$this->estadopago->ViewValue = $this->estadopago->CurrentValue;
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
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
			if ($sMasterTblVar == "viewsolicitud") {
				$bValidMaster = TRUE;
				if (@$_GET["fk_id"] <> "") {
					$GLOBALS["viewsolicitud"]->id->setQueryStringValue($_GET["fk_id"]);
					$this->id_solicitud->setQueryStringValue($GLOBALS["viewsolicitud"]->id->QueryStringValue);
					$this->id_solicitud->setSessionValue($this->id_solicitud->QueryStringValue);
					if (!is_numeric($GLOBALS["viewsolicitud"]->id->QueryStringValue)) $bValidMaster = FALSE;
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
			if ($sMasterTblVar == "viewsolicitud") {
				$bValidMaster = TRUE;
				if (@$_POST["fk_id"] <> "") {
					$GLOBALS["viewsolicitud"]->id->setFormValue($_POST["fk_id"]);
					$this->id_solicitud->setFormValue($GLOBALS["viewsolicitud"]->id->FormValue);
					$this->id_solicitud->setSessionValue($this->id_solicitud->FormValue);
					if (!is_numeric($GLOBALS["viewsolicitud"]->id->FormValue)) $bValidMaster = FALSE;
				} else {
					$bValidMaster = FALSE;
				}
			}
		}
		if ($bValidMaster) {

			// Update URL
			$this->AddUrl = $this->AddMasterUrl($this->AddUrl);
			$this->InlineAddUrl = $this->AddMasterUrl($this->InlineAddUrl);
			$this->GridAddUrl = $this->AddMasterUrl($this->GridAddUrl);
			$this->GridEditUrl = $this->AddMasterUrl($this->GridEditUrl);

			// Save current master table
			$this->setCurrentMasterTable($sMasterTblVar);

			// Reset start record counter (new master key)
			if (!$this->IsAddOrEdit()) {
				$this->StartRec = 1;
				$this->setStartRecordNumber($this->StartRec);
			}

			// Clear previous master key from Session
			if ($sMasterTblVar <> "viewsolicitud") {
				if ($this->id_solicitud->CurrentValue == "") $this->id_solicitud->setSessionValue("");
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
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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
if (!isset($viewavaluo_list)) $viewavaluo_list = new cviewavaluo_list();

// Page init
$viewavaluo_list->Page_Init();

// Page main
$viewavaluo_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewavaluo_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fviewavaluolist = new ew_Form("fviewavaluolist", "list");
fviewavaluolist.FormKeyCountName = '<?php echo $viewavaluo_list->FormKeyCountName ?>';

// Form_CustomValidate event
fviewavaluolist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluolist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluolist.Lists["x_tipoinmueble"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewavaluolist.Lists["x_tipoinmueble"].Data = "<?php echo $viewavaluo_list->tipoinmueble->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluolist.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","x__email",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
fviewavaluolist.Lists["x_id_solicitud"].Data = "<?php echo $viewavaluo_list->id_solicitud->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluolist.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fviewavaluolist.Lists["x_id_oficialcredito"].Data = "<?php echo $viewavaluo_list->id_oficialcredito->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = fviewavaluolistsrch = new ew_Form("fviewavaluolistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if ($viewavaluo_list->TotalRecs > 0 && $viewavaluo_list->ExportOptions->Visible()) { ?>
<?php $viewavaluo_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($viewavaluo_list->SearchOptions->Visible()) { ?>
<?php $viewavaluo_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($viewavaluo_list->FilterOptions->Visible()) { ?>
<?php $viewavaluo_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php if (($viewavaluo->Export == "") || (EW_EXPORT_MASTER_RECORD && $viewavaluo->Export == "print")) { ?>
<?php
if ($viewavaluo_list->DbMasterFilter <> "" && $viewavaluo->getCurrentMasterTable() == "viewsolicitud") {
	if ($viewavaluo_list->MasterRecordExists) {
?>
<?php include_once "viewsolicitudmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
	$bSelectLimit = $viewavaluo_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($viewavaluo_list->TotalRecs <= 0)
			$viewavaluo_list->TotalRecs = $viewavaluo->ListRecordCount();
	} else {
		if (!$viewavaluo_list->Recordset && ($viewavaluo_list->Recordset = $viewavaluo_list->LoadRecordset()))
			$viewavaluo_list->TotalRecs = $viewavaluo_list->Recordset->RecordCount();
	}
	$viewavaluo_list->StartRec = 1;
	if ($viewavaluo_list->DisplayRecs <= 0 || ($viewavaluo->Export <> "" && $viewavaluo->ExportAll)) // Display all records
		$viewavaluo_list->DisplayRecs = $viewavaluo_list->TotalRecs;
	if (!($viewavaluo->Export <> "" && $viewavaluo->ExportAll))
		$viewavaluo_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$viewavaluo_list->Recordset = $viewavaluo_list->LoadRecordset($viewavaluo_list->StartRec-1, $viewavaluo_list->DisplayRecs);

	// Set no record found message
	if ($viewavaluo->CurrentAction == "" && $viewavaluo_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$viewavaluo_list->setWarningMessage(ew_DeniedMsg());
		if ($viewavaluo_list->SearchWhere == "0=101")
			$viewavaluo_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$viewavaluo_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$viewavaluo_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($viewavaluo->Export == "" && $viewavaluo->CurrentAction == "") { ?>
<form name="fviewavaluolistsrch" id="fviewavaluolistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($viewavaluo_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fviewavaluolistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="viewavaluo">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($viewavaluo_list->BasicSearch->getKeyword()) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($viewavaluo_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $viewavaluo_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($viewavaluo_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($viewavaluo_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($viewavaluo_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($viewavaluo_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
		</ul>
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
	</div>
	</div>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $viewavaluo_list->ShowPageHeader(); ?>
<?php
$viewavaluo_list->ShowMessage();
?>
<?php if ($viewavaluo_list->TotalRecs > 0 || $viewavaluo->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($viewavaluo_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewavaluo">
<form name="fviewavaluolist" id="fviewavaluolist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewavaluo_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewavaluo_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewavaluo">
<?php if ($viewavaluo->getCurrentMasterTable() == "viewsolicitud" && $viewavaluo->CurrentAction <> "") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="viewsolicitud">
<input type="hidden" name="fk_id" value="<?php echo $viewavaluo->id_solicitud->getSessionValue() ?>">
<?php } ?>
<div id="gmp_viewavaluo" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($viewavaluo_list->TotalRecs > 0 || $viewavaluo->CurrentAction == "gridedit") { ?>
<table id="tbl_viewavaluolist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$viewavaluo_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$viewavaluo_list->RenderListOptions();

// Render list options (header, left)
$viewavaluo_list->ListOptions->Render("header", "left");
?>
<?php if ($viewavaluo->tipoinmueble->Visible) { // tipoinmueble ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->tipoinmueble) == "") { ?>
		<th data-name="tipoinmueble" class="<?php echo $viewavaluo->tipoinmueble->HeaderCellClass() ?>"><div id="elh_viewavaluo_tipoinmueble" class="viewavaluo_tipoinmueble"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->tipoinmueble->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipoinmueble" class="<?php echo $viewavaluo->tipoinmueble->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluo->SortUrl($viewavaluo->tipoinmueble) ?>',1);"><div id="elh_viewavaluo_tipoinmueble" class="viewavaluo_tipoinmueble">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->tipoinmueble->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->tipoinmueble->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->tipoinmueble->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->codigoavaluo->Visible) { // codigoavaluo ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->codigoavaluo) == "") { ?>
		<th data-name="codigoavaluo" class="<?php echo $viewavaluo->codigoavaluo->HeaderCellClass() ?>"><div id="elh_viewavaluo_codigoavaluo" class="viewavaluo_codigoavaluo"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->codigoavaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigoavaluo" class="<?php echo $viewavaluo->codigoavaluo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluo->SortUrl($viewavaluo->codigoavaluo) ?>',1);"><div id="elh_viewavaluo_codigoavaluo" class="viewavaluo_codigoavaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->codigoavaluo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->codigoavaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->codigoavaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->id_solicitud->Visible) { // id_solicitud ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->id_solicitud) == "") { ?>
		<th data-name="id_solicitud" class="<?php echo $viewavaluo->id_solicitud->HeaderCellClass() ?>"><div id="elh_viewavaluo_id_solicitud" class="viewavaluo_id_solicitud"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->id_solicitud->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_solicitud" class="<?php echo $viewavaluo->id_solicitud->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluo->SortUrl($viewavaluo->id_solicitud) ?>',1);"><div id="elh_viewavaluo_id_solicitud" class="viewavaluo_id_solicitud">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->id_solicitud->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->id_solicitud->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->id_solicitud->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->id_oficialcredito->Visible) { // id_oficialcredito ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->id_oficialcredito) == "") { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluo->id_oficialcredito->HeaderCellClass() ?>"><div id="elh_viewavaluo_id_oficialcredito" class="viewavaluo_id_oficialcredito"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->id_oficialcredito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluo->id_oficialcredito->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluo->SortUrl($viewavaluo->id_oficialcredito) ?>',1);"><div id="elh_viewavaluo_id_oficialcredito" class="viewavaluo_id_oficialcredito">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->id_oficialcredito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->id_oficialcredito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->id_oficialcredito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->id_inspector->Visible) { // id_inspector ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->id_inspector) == "") { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluo->id_inspector->HeaderCellClass() ?>"><div id="elh_viewavaluo_id_inspector" class="viewavaluo_id_inspector"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->id_inspector->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluo->id_inspector->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluo->SortUrl($viewavaluo->id_inspector) ?>',1);"><div id="elh_viewavaluo_id_inspector" class="viewavaluo_id_inspector">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->id_inspector->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->id_inspector->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->id_inspector->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->id_cliente->Visible) { // id_cliente ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->id_cliente) == "") { ?>
		<th data-name="id_cliente" class="<?php echo $viewavaluo->id_cliente->HeaderCellClass() ?>"><div id="elh_viewavaluo_id_cliente" class="viewavaluo_id_cliente"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->id_cliente->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_cliente" class="<?php echo $viewavaluo->id_cliente->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluo->SortUrl($viewavaluo->id_cliente) ?>',1);"><div id="elh_viewavaluo_id_cliente" class="viewavaluo_id_cliente">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->id_cliente->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->id_cliente->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->id_cliente->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->estado->Visible) { // estado ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->estado) == "") { ?>
		<th data-name="estado" class="<?php echo $viewavaluo->estado->HeaderCellClass() ?>"><div id="elh_viewavaluo_estado" class="viewavaluo_estado"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado" class="<?php echo $viewavaluo->estado->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluo->SortUrl($viewavaluo->estado) ?>',1);"><div id="elh_viewavaluo_estado" class="viewavaluo_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->estado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->estadopago->Visible) { // estadopago ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->estadopago) == "") { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluo->estadopago->HeaderCellClass() ?>"><div id="elh_viewavaluo_estadopago" class="viewavaluo_estadopago"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluo->estadopago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluo->estadopago->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluo->SortUrl($viewavaluo->estadopago) ?>',1);"><div id="elh_viewavaluo_estadopago" class="viewavaluo_estadopago">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->estadopago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->estadopago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->estadopago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->fecha_avaluo->Visible) { // fecha_avaluo ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->fecha_avaluo) == "") { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluo->fecha_avaluo->HeaderCellClass() ?>"><div id="elh_viewavaluo_fecha_avaluo" class="viewavaluo_fecha_avaluo"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->fecha_avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluo->fecha_avaluo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluo->SortUrl($viewavaluo->fecha_avaluo) ?>',1);"><div id="elh_viewavaluo_fecha_avaluo" class="viewavaluo_fecha_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->fecha_avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->fecha_avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->fecha_avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$viewavaluo_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($viewavaluo->ExportAll && $viewavaluo->Export <> "") {
	$viewavaluo_list->StopRec = $viewavaluo_list->TotalRecs;
} else {

	// Set the last record to display
	if ($viewavaluo_list->TotalRecs > $viewavaluo_list->StartRec + $viewavaluo_list->DisplayRecs - 1)
		$viewavaluo_list->StopRec = $viewavaluo_list->StartRec + $viewavaluo_list->DisplayRecs - 1;
	else
		$viewavaluo_list->StopRec = $viewavaluo_list->TotalRecs;
}
$viewavaluo_list->RecCnt = $viewavaluo_list->StartRec - 1;
if ($viewavaluo_list->Recordset && !$viewavaluo_list->Recordset->EOF) {
	$viewavaluo_list->Recordset->MoveFirst();
	$bSelectLimit = $viewavaluo_list->UseSelectLimit;
	if (!$bSelectLimit && $viewavaluo_list->StartRec > 1)
		$viewavaluo_list->Recordset->Move($viewavaluo_list->StartRec - 1);
} elseif (!$viewavaluo->AllowAddDeleteRow && $viewavaluo_list->StopRec == 0) {
	$viewavaluo_list->StopRec = $viewavaluo->GridAddRowCount;
}

// Initialize aggregate
$viewavaluo->RowType = EW_ROWTYPE_AGGREGATEINIT;
$viewavaluo->ResetAttrs();
$viewavaluo_list->RenderRow();
while ($viewavaluo_list->RecCnt < $viewavaluo_list->StopRec) {
	$viewavaluo_list->RecCnt++;
	if (intval($viewavaluo_list->RecCnt) >= intval($viewavaluo_list->StartRec)) {
		$viewavaluo_list->RowCnt++;

		// Set up key count
		$viewavaluo_list->KeyCount = $viewavaluo_list->RowIndex;

		// Init row class and style
		$viewavaluo->ResetAttrs();
		$viewavaluo->CssClass = "";
		if ($viewavaluo->CurrentAction == "gridadd") {
		} else {
			$viewavaluo_list->LoadRowValues($viewavaluo_list->Recordset); // Load row values
		}
		$viewavaluo->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$viewavaluo->RowAttrs = array_merge($viewavaluo->RowAttrs, array('data-rowindex'=>$viewavaluo_list->RowCnt, 'id'=>'r' . $viewavaluo_list->RowCnt . '_viewavaluo', 'data-rowtype'=>$viewavaluo->RowType));

		// Render row
		$viewavaluo_list->RenderRow();

		// Render list options
		$viewavaluo_list->RenderListOptions();
?>
	<tr<?php echo $viewavaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewavaluo_list->ListOptions->Render("body", "left", $viewavaluo_list->RowCnt);
?>
	<?php if ($viewavaluo->tipoinmueble->Visible) { // tipoinmueble ?>
		<td data-name="tipoinmueble"<?php echo $viewavaluo->tipoinmueble->CellAttributes() ?>>
<span id="el<?php echo $viewavaluo_list->RowCnt ?>_viewavaluo_tipoinmueble" class="viewavaluo_tipoinmueble">
<span<?php echo $viewavaluo->tipoinmueble->ViewAttributes() ?>>
<?php echo $viewavaluo->tipoinmueble->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluo->codigoavaluo->Visible) { // codigoavaluo ?>
		<td data-name="codigoavaluo"<?php echo $viewavaluo->codigoavaluo->CellAttributes() ?>>
<span id="el<?php echo $viewavaluo_list->RowCnt ?>_viewavaluo_codigoavaluo" class="viewavaluo_codigoavaluo">
<span<?php echo $viewavaluo->codigoavaluo->ViewAttributes() ?>>
<?php echo $viewavaluo->codigoavaluo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluo->id_solicitud->Visible) { // id_solicitud ?>
		<td data-name="id_solicitud"<?php echo $viewavaluo->id_solicitud->CellAttributes() ?>>
<span id="el<?php echo $viewavaluo_list->RowCnt ?>_viewavaluo_id_solicitud" class="viewavaluo_id_solicitud">
<span<?php echo $viewavaluo->id_solicitud->ViewAttributes() ?>>
<?php echo $viewavaluo->id_solicitud->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluo->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<td data-name="id_oficialcredito"<?php echo $viewavaluo->id_oficialcredito->CellAttributes() ?>>
<span id="el<?php echo $viewavaluo_list->RowCnt ?>_viewavaluo_id_oficialcredito" class="viewavaluo_id_oficialcredito">
<span<?php echo $viewavaluo->id_oficialcredito->ViewAttributes() ?>>
<?php echo $viewavaluo->id_oficialcredito->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluo->id_inspector->Visible) { // id_inspector ?>
		<td data-name="id_inspector"<?php echo $viewavaluo->id_inspector->CellAttributes() ?>>
<span id="el<?php echo $viewavaluo_list->RowCnt ?>_viewavaluo_id_inspector" class="viewavaluo_id_inspector">
<span<?php echo $viewavaluo->id_inspector->ViewAttributes() ?>>
<?php echo $viewavaluo->id_inspector->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluo->id_cliente->Visible) { // id_cliente ?>
		<td data-name="id_cliente"<?php echo $viewavaluo->id_cliente->CellAttributes() ?>>
<span id="el<?php echo $viewavaluo_list->RowCnt ?>_viewavaluo_id_cliente" class="viewavaluo_id_cliente">
<span<?php echo $viewavaluo->id_cliente->ViewAttributes() ?>>
<?php echo $viewavaluo->id_cliente->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluo->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $viewavaluo->estado->CellAttributes() ?>>
<span id="el<?php echo $viewavaluo_list->RowCnt ?>_viewavaluo_estado" class="viewavaluo_estado">
<span<?php echo $viewavaluo->estado->ViewAttributes() ?>>
<?php echo $viewavaluo->estado->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluo->estadopago->Visible) { // estadopago ?>
		<td data-name="estadopago"<?php echo $viewavaluo->estadopago->CellAttributes() ?>>
<span id="el<?php echo $viewavaluo_list->RowCnt ?>_viewavaluo_estadopago" class="viewavaluo_estadopago">
<span<?php echo $viewavaluo->estadopago->ViewAttributes() ?>>
<?php echo $viewavaluo->estadopago->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($viewavaluo->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<td data-name="fecha_avaluo"<?php echo $viewavaluo->fecha_avaluo->CellAttributes() ?>>
<span id="el<?php echo $viewavaluo_list->RowCnt ?>_viewavaluo_fecha_avaluo" class="viewavaluo_fecha_avaluo">
<span<?php echo $viewavaluo->fecha_avaluo->ViewAttributes() ?>>
<?php echo $viewavaluo->fecha_avaluo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewavaluo_list->ListOptions->Render("body", "right", $viewavaluo_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($viewavaluo->CurrentAction <> "gridadd")
		$viewavaluo_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($viewavaluo->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($viewavaluo_list->Recordset)
	$viewavaluo_list->Recordset->Close();
?>
<div class="box-footer ewGridLowerPanel">
<?php if ($viewavaluo->CurrentAction <> "gridadd" && $viewavaluo->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($viewavaluo_list->Pager)) $viewavaluo_list->Pager = new cNumericPager($viewavaluo_list->StartRec, $viewavaluo_list->DisplayRecs, $viewavaluo_list->TotalRecs, $viewavaluo_list->RecRange, $viewavaluo_list->AutoHidePager) ?>
<?php if ($viewavaluo_list->Pager->RecordCount > 0 && $viewavaluo_list->Pager->Visible) { ?>
<div class="ewPager">
<div class="ewNumericPage"><ul class="pagination">
	<?php if ($viewavaluo_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluo_list->PageUrl() ?>start=<?php echo $viewavaluo_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($viewavaluo_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluo_list->PageUrl() ?>start=<?php echo $viewavaluo_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($viewavaluo_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $viewavaluo_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($viewavaluo_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluo_list->PageUrl() ?>start=<?php echo $viewavaluo_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($viewavaluo_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluo_list->PageUrl() ?>start=<?php echo $viewavaluo_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($viewavaluo_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $viewavaluo_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $viewavaluo_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $viewavaluo_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewavaluo_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($viewavaluo_list->TotalRecs == 0 && $viewavaluo->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewavaluo_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
fviewavaluolistsrch.FilterList = <?php echo $viewavaluo_list->GetFilterList() ?>;
fviewavaluolistsrch.Init();
fviewavaluolist.Init();
</script>
<?php
$viewavaluo_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$viewavaluo_list->Page_Terminate();
?>
