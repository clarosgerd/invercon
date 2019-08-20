<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "solicitudinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "avaluogridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$solicitud_list = NULL; // Initialize page object first

class csolicitud_list extends csolicitud {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'solicitud';

	// Page object name
	var $PageObjName = 'solicitud_list';

	// Grid form hidden field names
	var $FormName = 'fsolicitudlist';
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

		// Table object (solicitud)
		if (!isset($GLOBALS["solicitud"]) || get_class($GLOBALS["solicitud"]) == "csolicitud") {
			$GLOBALS["solicitud"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["solicitud"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "solicitudadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "solicituddelete.php";
		$this->MultiUpdateUrl = "solicitudupdate.php";

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'solicitud', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fsolicitudlistsrch";

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
		$this->nombre_contacto->SetVisibility();
		$this->name->SetVisibility();
		$this->lastname->SetVisibility();
		$this->_email->SetVisibility();
		$this->address->SetVisibility();
		$this->phone->SetVisibility();
		$this->cell->SetVisibility();
		$this->created_at->SetVisibility();
		$this->id_sucursal->SetVisibility();
		$this->tipoinmueble->SetVisibility();
		$this->tipovehiculo->SetVisibility();
		$this->tipomaquinaria->SetVisibility();
		$this->tipomercaderia->SetVisibility();
		$this->tipoespecial->SetVisibility();
		$this->email_contacto->SetVisibility();

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
				if (in_array("avaluo", $DetailTblVar)) {

					// Process auto fill for detail table 'avaluo'
					if (preg_match('/^favaluo(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["avaluo_grid"])) $GLOBALS["avaluo_grid"] = new cavaluo_grid;
						$GLOBALS["avaluo_grid"]->Page_Init();
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
		global $EW_EXPORT, $solicitud;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($solicitud);
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
			ew_AddFilter($this->DefaultSearchWhere, $this->AdvancedSearchWhere(TRUE));

			// Get basic search values
			$this->LoadBasicSearchValues();

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

			// Get basic search criteria
			if ($gsSearchError == "")
				$sSrchBasic = $this->BasicSearchWhere();

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

			// Load basic search from default
			$this->BasicSearch->LoadDefault();
			if ($this->BasicSearch->Keyword != "")
				$sSrchBasic = $this->BasicSearchWhere();

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
			$sSavedFilterList = $UserProfile->GetSearchFilters(CurrentUserName(), "fsolicitudlistsrch");
		$sFilterList = ew_Concat($sFilterList, $this->id->AdvancedSearch->ToJson(), ","); // Field id
		$sFilterList = ew_Concat($sFilterList, $this->nombre_contacto->AdvancedSearch->ToJson(), ","); // Field nombre_contacto
		$sFilterList = ew_Concat($sFilterList, $this->name->AdvancedSearch->ToJson(), ","); // Field name
		$sFilterList = ew_Concat($sFilterList, $this->lastname->AdvancedSearch->ToJson(), ","); // Field lastname
		$sFilterList = ew_Concat($sFilterList, $this->_email->AdvancedSearch->ToJson(), ","); // Field email
		$sFilterList = ew_Concat($sFilterList, $this->address->AdvancedSearch->ToJson(), ","); // Field address
		$sFilterList = ew_Concat($sFilterList, $this->phone->AdvancedSearch->ToJson(), ","); // Field phone
		$sFilterList = ew_Concat($sFilterList, $this->cell->AdvancedSearch->ToJson(), ","); // Field cell
		$sFilterList = ew_Concat($sFilterList, $this->created_at->AdvancedSearch->ToJson(), ","); // Field created_at
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
		$sFilterList = ew_Concat($sFilterList, $this->email_contacto->AdvancedSearch->ToJson(), ","); // Field email_contacto
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fsolicitudlistsrch", $filters);

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

		// Field nombre_contacto
		$this->nombre_contacto->AdvancedSearch->SearchValue = @$filter["x_nombre_contacto"];
		$this->nombre_contacto->AdvancedSearch->SearchOperator = @$filter["z_nombre_contacto"];
		$this->nombre_contacto->AdvancedSearch->SearchCondition = @$filter["v_nombre_contacto"];
		$this->nombre_contacto->AdvancedSearch->SearchValue2 = @$filter["y_nombre_contacto"];
		$this->nombre_contacto->AdvancedSearch->SearchOperator2 = @$filter["w_nombre_contacto"];
		$this->nombre_contacto->AdvancedSearch->Save();

		// Field name
		$this->name->AdvancedSearch->SearchValue = @$filter["x_name"];
		$this->name->AdvancedSearch->SearchOperator = @$filter["z_name"];
		$this->name->AdvancedSearch->SearchCondition = @$filter["v_name"];
		$this->name->AdvancedSearch->SearchValue2 = @$filter["y_name"];
		$this->name->AdvancedSearch->SearchOperator2 = @$filter["w_name"];
		$this->name->AdvancedSearch->Save();

		// Field lastname
		$this->lastname->AdvancedSearch->SearchValue = @$filter["x_lastname"];
		$this->lastname->AdvancedSearch->SearchOperator = @$filter["z_lastname"];
		$this->lastname->AdvancedSearch->SearchCondition = @$filter["v_lastname"];
		$this->lastname->AdvancedSearch->SearchValue2 = @$filter["y_lastname"];
		$this->lastname->AdvancedSearch->SearchOperator2 = @$filter["w_lastname"];
		$this->lastname->AdvancedSearch->Save();

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

		// Field phone
		$this->phone->AdvancedSearch->SearchValue = @$filter["x_phone"];
		$this->phone->AdvancedSearch->SearchOperator = @$filter["z_phone"];
		$this->phone->AdvancedSearch->SearchCondition = @$filter["v_phone"];
		$this->phone->AdvancedSearch->SearchValue2 = @$filter["y_phone"];
		$this->phone->AdvancedSearch->SearchOperator2 = @$filter["w_phone"];
		$this->phone->AdvancedSearch->Save();

		// Field cell
		$this->cell->AdvancedSearch->SearchValue = @$filter["x_cell"];
		$this->cell->AdvancedSearch->SearchOperator = @$filter["z_cell"];
		$this->cell->AdvancedSearch->SearchCondition = @$filter["v_cell"];
		$this->cell->AdvancedSearch->SearchValue2 = @$filter["y_cell"];
		$this->cell->AdvancedSearch->SearchOperator2 = @$filter["w_cell"];
		$this->cell->AdvancedSearch->Save();

		// Field created_at
		$this->created_at->AdvancedSearch->SearchValue = @$filter["x_created_at"];
		$this->created_at->AdvancedSearch->SearchOperator = @$filter["z_created_at"];
		$this->created_at->AdvancedSearch->SearchCondition = @$filter["v_created_at"];
		$this->created_at->AdvancedSearch->SearchValue2 = @$filter["y_created_at"];
		$this->created_at->AdvancedSearch->SearchOperator2 = @$filter["w_created_at"];
		$this->created_at->AdvancedSearch->Save();

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

		// Field email_contacto
		$this->email_contacto->AdvancedSearch->SearchValue = @$filter["x_email_contacto"];
		$this->email_contacto->AdvancedSearch->SearchOperator = @$filter["z_email_contacto"];
		$this->email_contacto->AdvancedSearch->SearchCondition = @$filter["v_email_contacto"];
		$this->email_contacto->AdvancedSearch->SearchValue2 = @$filter["y_email_contacto"];
		$this->email_contacto->AdvancedSearch->SearchOperator2 = @$filter["w_email_contacto"];
		$this->email_contacto->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Advanced search WHERE clause based on QueryString
	function AdvancedSearchWhere($Default = FALSE) {
		global $Security;
		$sWhere = "";
		if (!$Security->CanSearch()) return "";
		$this->BuildSearchSql($sWhere, $this->id, $Default, FALSE); // id
		$this->BuildSearchSql($sWhere, $this->nombre_contacto, $Default, FALSE); // nombre_contacto
		$this->BuildSearchSql($sWhere, $this->name, $Default, FALSE); // name
		$this->BuildSearchSql($sWhere, $this->lastname, $Default, FALSE); // lastname
		$this->BuildSearchSql($sWhere, $this->_email, $Default, FALSE); // email
		$this->BuildSearchSql($sWhere, $this->address, $Default, FALSE); // address
		$this->BuildSearchSql($sWhere, $this->phone, $Default, FALSE); // phone
		$this->BuildSearchSql($sWhere, $this->cell, $Default, FALSE); // cell
		$this->BuildSearchSql($sWhere, $this->created_at, $Default, FALSE); // created_at
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
		$this->BuildSearchSql($sWhere, $this->tipoespecial, $Default, TRUE); // tipoespecial
		$this->BuildSearchSql($sWhere, $this->email_contacto, $Default, FALSE); // email_contacto

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->id->AdvancedSearch->Save(); // id
			$this->nombre_contacto->AdvancedSearch->Save(); // nombre_contacto
			$this->name->AdvancedSearch->Save(); // name
			$this->lastname->AdvancedSearch->Save(); // lastname
			$this->_email->AdvancedSearch->Save(); // email
			$this->address->AdvancedSearch->Save(); // address
			$this->phone->AdvancedSearch->Save(); // phone
			$this->cell->AdvancedSearch->Save(); // cell
			$this->created_at->AdvancedSearch->Save(); // created_at
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
			$this->email_contacto->AdvancedSearch->Save(); // email_contacto
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

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->nombre_contacto, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->name, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->lastname, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->_email, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->address, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->phone, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->cell, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->tipovehiculo, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->tipomaquinaria, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->documento_mercaderia, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->email_contacto, $arKeywords, $type);
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
		if ($this->id->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->nombre_contacto->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->name->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->lastname->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->_email->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->address->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->phone->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->cell->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->created_at->AdvancedSearch->IssetSession())
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
		if ($this->email_contacto->AdvancedSearch->IssetSession())
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

		// Clear advanced search parameters
		$this->ResetAdvancedSearchParms();
	}

	// Load advanced search default values
	function LoadAdvancedSearchDefault() {
		return FALSE;
	}

	// Clear all basic search parameters
	function ResetBasicSearchParms() {
		$this->BasicSearch->UnsetSession();
	}

	// Clear all advanced search parameters
	function ResetAdvancedSearchParms() {
		$this->id->AdvancedSearch->UnsetSession();
		$this->nombre_contacto->AdvancedSearch->UnsetSession();
		$this->name->AdvancedSearch->UnsetSession();
		$this->lastname->AdvancedSearch->UnsetSession();
		$this->_email->AdvancedSearch->UnsetSession();
		$this->address->AdvancedSearch->UnsetSession();
		$this->phone->AdvancedSearch->UnsetSession();
		$this->cell->AdvancedSearch->UnsetSession();
		$this->created_at->AdvancedSearch->UnsetSession();
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
		$this->email_contacto->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore basic search values
		$this->BasicSearch->Load();

		// Restore advanced search values
		$this->id->AdvancedSearch->Load();
		$this->nombre_contacto->AdvancedSearch->Load();
		$this->name->AdvancedSearch->Load();
		$this->lastname->AdvancedSearch->Load();
		$this->_email->AdvancedSearch->Load();
		$this->address->AdvancedSearch->Load();
		$this->phone->AdvancedSearch->Load();
		$this->cell->AdvancedSearch->Load();
		$this->created_at->AdvancedSearch->Load();
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
		$this->email_contacto->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->nombre_contacto); // nombre_contacto
			$this->UpdateSort($this->name); // name
			$this->UpdateSort($this->lastname); // lastname
			$this->UpdateSort($this->_email); // email
			$this->UpdateSort($this->address); // address
			$this->UpdateSort($this->phone); // phone
			$this->UpdateSort($this->cell); // cell
			$this->UpdateSort($this->created_at); // created_at
			$this->UpdateSort($this->id_sucursal); // id_sucursal
			$this->UpdateSort($this->tipoinmueble); // tipoinmueble
			$this->UpdateSort($this->tipovehiculo); // tipovehiculo
			$this->UpdateSort($this->tipomaquinaria); // tipomaquinaria
			$this->UpdateSort($this->tipomercaderia); // tipomercaderia
			$this->UpdateSort($this->tipoespecial); // tipoespecial
			$this->UpdateSort($this->email_contacto); // email_contacto
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
				$this->created_at->setSort("DESC");
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
				$this->nombre_contacto->setSort("");
				$this->name->setSort("");
				$this->lastname->setSort("");
				$this->_email->setSort("");
				$this->address->setSort("");
				$this->phone->setSort("");
				$this->cell->setSort("");
				$this->created_at->setSort("");
				$this->id_sucursal->setSort("");
				$this->tipoinmueble->setSort("");
				$this->tipovehiculo->setSort("");
				$this->tipomaquinaria->setSort("");
				$this->tipomercaderia->setSort("");
				$this->tipoespecial->setSort("");
				$this->email_contacto->setSort("");
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

		// "detail_avaluo"
		$item = &$this->ListOptions->Add("detail_avaluo");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'avaluo') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["avaluo_grid"])) $GLOBALS["avaluo_grid"] = new cavaluo_grid;

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
		$pages->Add("avaluo");
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

		// "detail_avaluo"
		$oListOpt = &$this->ListOptions->Items["detail_avaluo"];
		if ($Security->AllowList(CurrentProjectID() . 'avaluo')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("avaluo", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("avaluolist.php?" . EW_TABLE_SHOW_MASTER . "=solicitud&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["avaluo_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 'avaluo')) {
				$caption = $Language->Phrase("MasterDetailEditLink");
				$url = $this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=avaluo");
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . ew_HtmlImageAndText($caption) . "</a></li>";
				if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
				$DetailEditTblVar .= "avaluo";
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
		$item = &$option->Add("detailadd_avaluo");
		$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=avaluo");
		$caption = $Language->Phrase("Add") . "&nbsp;" . $this->TableCaption() . "/" . $GLOBALS["avaluo"]->TableCaption();
		$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["avaluo"]->DetailAdd && $Security->AllowAdd(CurrentProjectID() . 'avaluo') && $Security->CanAdd());
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "avaluo";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fsolicitudlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fsolicitudlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fsolicitudlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fsolicitudlistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// id

		$this->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		if ($this->id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// nombre_contacto
		$this->nombre_contacto->AdvancedSearch->SearchValue = @$_GET["x_nombre_contacto"];
		if ($this->nombre_contacto->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->nombre_contacto->AdvancedSearch->SearchOperator = @$_GET["z_nombre_contacto"];

		// name
		$this->name->AdvancedSearch->SearchValue = @$_GET["x_name"];
		if ($this->name->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->name->AdvancedSearch->SearchOperator = @$_GET["z_name"];

		// lastname
		$this->lastname->AdvancedSearch->SearchValue = @$_GET["x_lastname"];
		if ($this->lastname->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->lastname->AdvancedSearch->SearchOperator = @$_GET["z_lastname"];

		// email
		$this->_email->AdvancedSearch->SearchValue = @$_GET["x__email"];
		if ($this->_email->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->_email->AdvancedSearch->SearchOperator = @$_GET["z__email"];

		// address
		$this->address->AdvancedSearch->SearchValue = @$_GET["x_address"];
		if ($this->address->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->address->AdvancedSearch->SearchOperator = @$_GET["z_address"];

		// phone
		$this->phone->AdvancedSearch->SearchValue = @$_GET["x_phone"];
		if ($this->phone->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->phone->AdvancedSearch->SearchOperator = @$_GET["z_phone"];

		// cell
		$this->cell->AdvancedSearch->SearchValue = @$_GET["x_cell"];
		if ($this->cell->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->cell->AdvancedSearch->SearchOperator = @$_GET["z_cell"];

		// created_at
		$this->created_at->AdvancedSearch->SearchValue = @$_GET["x_created_at"];
		if ($this->created_at->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->created_at->AdvancedSearch->SearchOperator = @$_GET["z_created_at"];

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
		if (is_array($this->tipoespecial->AdvancedSearch->SearchValue)) $this->tipoespecial->AdvancedSearch->SearchValue = implode(",", $this->tipoespecial->AdvancedSearch->SearchValue);
		if (is_array($this->tipoespecial->AdvancedSearch->SearchValue2)) $this->tipoespecial->AdvancedSearch->SearchValue2 = implode(",", $this->tipoespecial->AdvancedSearch->SearchValue2);

		// email_contacto
		$this->email_contacto->AdvancedSearch->SearchValue = @$_GET["x_email_contacto"];
		if ($this->email_contacto->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->email_contacto->AdvancedSearch->SearchOperator = @$_GET["z_email_contacto"];
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
		$this->nombre_contacto->setDbValue($row['nombre_contacto']);
		$this->name->setDbValue($row['name']);
		$this->lastname->setDbValue($row['lastname']);
		$this->_email->setDbValue($row['email']);
		$this->address->setDbValue($row['address']);
		$this->phone->setDbValue($row['phone']);
		$this->cell->setDbValue($row['cell']);
		$this->is_active->setDbValue($row['is_active']);
		$this->created_at->setDbValue($row['created_at']);
		$this->id_sucursal->setDbValue($row['id_sucursal']);
		$this->documentos->setDbValue($row['documentos']);
		$this->DateModified->setDbValue($row['DateModified']);
		$this->DateDeleted->setDbValue($row['DateDeleted']);
		$this->CreatedBy->setDbValue($row['CreatedBy']);
		$this->ModifiedBy->setDbValue($row['ModifiedBy']);
		$this->DeletedBy->setDbValue($row['DeletedBy']);
		$this->latitud->setDbValue($row['latitud']);
		$this->longitud->setDbValue($row['longitud']);
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
		$this->email_contacto->setDbValue($row['email_contacto']);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['id'] = NULL;
		$row['nombre_contacto'] = NULL;
		$row['name'] = NULL;
		$row['lastname'] = NULL;
		$row['email'] = NULL;
		$row['address'] = NULL;
		$row['phone'] = NULL;
		$row['cell'] = NULL;
		$row['is_active'] = NULL;
		$row['created_at'] = NULL;
		$row['id_sucursal'] = NULL;
		$row['documentos'] = NULL;
		$row['DateModified'] = NULL;
		$row['DateDeleted'] = NULL;
		$row['CreatedBy'] = NULL;
		$row['ModifiedBy'] = NULL;
		$row['DeletedBy'] = NULL;
		$row['latitud'] = NULL;
		$row['longitud'] = NULL;
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
		$row['email_contacto'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->nombre_contacto->DbValue = $row['nombre_contacto'];
		$this->name->DbValue = $row['name'];
		$this->lastname->DbValue = $row['lastname'];
		$this->_email->DbValue = $row['email'];
		$this->address->DbValue = $row['address'];
		$this->phone->DbValue = $row['phone'];
		$this->cell->DbValue = $row['cell'];
		$this->is_active->DbValue = $row['is_active'];
		$this->created_at->DbValue = $row['created_at'];
		$this->id_sucursal->DbValue = $row['id_sucursal'];
		$this->documentos->DbValue = $row['documentos'];
		$this->DateModified->DbValue = $row['DateModified'];
		$this->DateDeleted->DbValue = $row['DateDeleted'];
		$this->CreatedBy->DbValue = $row['CreatedBy'];
		$this->ModifiedBy->DbValue = $row['ModifiedBy'];
		$this->DeletedBy->DbValue = $row['DeletedBy'];
		$this->latitud->DbValue = $row['latitud'];
		$this->longitud->DbValue = $row['longitud'];
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
		$this->email_contacto->DbValue = $row['email_contacto'];
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

		// nombre_contacto
		// name
		// lastname
		// email
		// address
		// phone
		// cell
		// is_active

		$this->is_active->CellCssStyle = "white-space: nowrap;";

		// created_at
		// id_sucursal
		// documentos

		$this->documentos->CellCssStyle = "white-space: nowrap;";

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

		// latitud
		$this->latitud->CellCssStyle = "white-space: nowrap;";

		// longitud
		$this->longitud->CellCssStyle = "white-space: nowrap;";

		// tipoinmueble
		// id_ciudad_inmueble
		// id_provincia_inmueble
		// imagen_inmueble01

		$this->imagen_inmueble01->CellCssStyle = "white-space: nowrap;";

		// imagen_inmueble02
		// imagen_inmueble03
		// imagen_inmueble04
		// imagen_inmueble05
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
		// imagen_vehiculo03

		$this->imagen_vehiculo03->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo04
		$this->imagen_vehiculo04->CellCssStyle = "white-space: nowrap;";

		// imagen_vehiculo05
		// imagen_vehiculo06
		// imagen_vehiculo07
		// imagen_vehiculo08

		$this->imagen_vehiculo08->CellCssStyle = "white-space: nowrap;";

		// tipomaquinaria
		// id_ciudad_maquinaria
		// id_provincia_maquinaria
		// imagen_maquinaria01

		$this->imagen_maquinaria01->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria02
		// imagen_maquinaria03
		// imagen_maquinaria04

		$this->imagen_maquinaria04->CellCssStyle = "white-space: nowrap;";

		// imagen_maquinaria05
		// imagen_maquinaria06
		// imagen_maquinaria07
		// imagen_maquinaria08

		$this->imagen_maquinaria08->CellCssStyle = "white-space: nowrap;";

		// tipomercaderia
		// imagen_mercaderia01
		// documento_mercaderia
		// tipoespecial
		// imagen_tipoespecial01
		// email_contacto

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// nombre_contacto
		$this->nombre_contacto->ViewValue = $this->nombre_contacto->CurrentValue;
		$this->nombre_contacto->ViewCustomAttributes = "";

		// name
		$this->name->ViewValue = $this->name->CurrentValue;
		$this->name->ViewCustomAttributes = "";

		// lastname
		$this->lastname->ViewValue = $this->lastname->CurrentValue;
		$this->lastname->ViewCustomAttributes = "";

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// address
		$this->address->ViewValue = $this->address->CurrentValue;
		$this->address->ViewCustomAttributes = "";

		// phone
		$this->phone->ViewValue = $this->phone->CurrentValue;
		$this->phone->ViewCustomAttributes = "";

		// cell
		$this->cell->ViewValue = $this->cell->CurrentValue;
		$this->cell->ViewCustomAttributes = "";

		// created_at
		$this->created_at->ViewValue = $this->created_at->CurrentValue;
		$this->created_at->ViewValue = ew_FormatDateTime($this->created_at->ViewValue, 17);
		$this->created_at->ViewCustomAttributes = "";

		// id_sucursal
		if (strval($this->id_sucursal->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_sucursal->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
		$sWhereWrk = "";
		$this->id_sucursal->LookupFilters = array("dx1" => '`nombre`');
		$lookuptblfilter = "`id`='".$_SESSION["sucursal"]."'";
		ew_AddFilter($sWhereWrk, $lookuptblfilter);
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

		// id_ciudad_inmueble
		if (strval($this->id_ciudad_inmueble->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_ciudad_inmueble->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
		$sWhereWrk = "";
		$this->id_ciudad_inmueble->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_ciudad_inmueble, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_ciudad_inmueble->ViewValue = $this->id_ciudad_inmueble->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_ciudad_inmueble->ViewValue = $this->id_ciudad_inmueble->CurrentValue;
			}
		} else {
			$this->id_ciudad_inmueble->ViewValue = NULL;
		}
		$this->id_ciudad_inmueble->ViewCustomAttributes = "";

		// id_provincia_inmueble
		if (strval($this->id_provincia_inmueble->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_provincia_inmueble->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
		$sWhereWrk = "";
		$this->id_provincia_inmueble->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_provincia_inmueble, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_provincia_inmueble->ViewValue = $this->id_provincia_inmueble->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_provincia_inmueble->ViewValue = $this->id_provincia_inmueble->CurrentValue;
			}
		} else {
			$this->id_provincia_inmueble->ViewValue = NULL;
		}
		$this->id_provincia_inmueble->ViewCustomAttributes = "";

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

		// id_ciudad_vehiculo
		if (strval($this->id_ciudad_vehiculo->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_ciudad_vehiculo->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
		$sWhereWrk = "";
		$this->id_ciudad_vehiculo->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_ciudad_vehiculo, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_ciudad_vehiculo->ViewValue = $this->id_ciudad_vehiculo->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_ciudad_vehiculo->ViewValue = $this->id_ciudad_vehiculo->CurrentValue;
			}
		} else {
			$this->id_ciudad_vehiculo->ViewValue = NULL;
		}
		$this->id_ciudad_vehiculo->ViewCustomAttributes = "";

		// id_provincia_vehiculo
		if (strval($this->id_provincia_vehiculo->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_provincia_vehiculo->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
		$sWhereWrk = "";
		$this->id_provincia_vehiculo->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_provincia_vehiculo, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_provincia_vehiculo->ViewValue = $this->id_provincia_vehiculo->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_provincia_vehiculo->ViewValue = $this->id_provincia_vehiculo->CurrentValue;
			}
		} else {
			$this->id_provincia_vehiculo->ViewValue = NULL;
		}
		$this->id_provincia_vehiculo->ViewCustomAttributes = "";

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

		// id_ciudad_maquinaria
		if (strval($this->id_ciudad_maquinaria->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_ciudad_maquinaria->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `departamento`";
		$sWhereWrk = "";
		$this->id_ciudad_maquinaria->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_ciudad_maquinaria, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_ciudad_maquinaria->ViewValue = $this->id_ciudad_maquinaria->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_ciudad_maquinaria->ViewValue = $this->id_ciudad_maquinaria->CurrentValue;
			}
		} else {
			$this->id_ciudad_maquinaria->ViewValue = NULL;
		}
		$this->id_ciudad_maquinaria->ViewCustomAttributes = "";

		// id_provincia_maquinaria
		if (strval($this->id_provincia_maquinaria->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_provincia_maquinaria->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `provincia`";
		$sWhereWrk = "";
		$this->id_provincia_maquinaria->LookupFilters = array();
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_provincia_maquinaria, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_provincia_maquinaria->ViewValue = $this->id_provincia_maquinaria->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_provincia_maquinaria->ViewValue = $this->id_provincia_maquinaria->CurrentValue;
			}
		} else {
			$this->id_provincia_maquinaria->ViewValue = NULL;
		}
		$this->id_provincia_maquinaria->ViewCustomAttributes = "";

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
		$this->tipomercaderia->LookupFilters = array();
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

		// documento_mercaderia
		$this->documento_mercaderia->ViewValue = $this->documento_mercaderia->CurrentValue;
		$this->documento_mercaderia->ViewCustomAttributes = "";

		// tipoespecial
		if (strval($this->tipoespecial->CurrentValue) <> "") {
			$arwrk = explode(",", $this->tipoespecial->CurrentValue);
			$sFilterWrk = "";
			foreach ($arwrk as $wrk) {
				if ($sFilterWrk <> "") $sFilterWrk .= " OR ";
				$sFilterWrk .= "`id_tipoinmueble`" . ew_SearchString("=", trim($wrk), EW_DATATYPE_NUMBER, "");
			}
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
				$this->tipoespecial->ViewValue = "";
				$ari = 0;
				while (!$rswrk->EOF) {
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->tipoespecial->ViewValue .= $this->tipoespecial->DisplayValue($arwrk);
					$rswrk->MoveNext();
					if (!$rswrk->EOF) $this->tipoespecial->ViewValue .= ew_ViewOptionSeparator($ari); // Separate Options
					$ari++;
				}
				$rswrk->Close();
			} else {
				$this->tipoespecial->ViewValue = $this->tipoespecial->CurrentValue;
			}
		} else {
			$this->tipoespecial->ViewValue = NULL;
		}
		$this->tipoespecial->ViewCustomAttributes = "";

		// email_contacto
		if (strval($this->email_contacto->CurrentValue) <> "") {
			$sFilterWrk = "`login`" . ew_SearchString("=", $this->email_contacto->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
		$sWhereWrk = "";
		$this->email_contacto->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->email_contacto, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->email_contacto->ViewValue = $this->email_contacto->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->email_contacto->ViewValue = $this->email_contacto->CurrentValue;
			}
		} else {
			$this->email_contacto->ViewValue = NULL;
		}
		$this->email_contacto->ViewCustomAttributes = "";

			// nombre_contacto
			$this->nombre_contacto->LinkCustomAttributes = "";
			$this->nombre_contacto->HrefValue = "";
			$this->nombre_contacto->TooltipValue = "";

			// name
			$this->name->LinkCustomAttributes = "";
			$this->name->HrefValue = "";
			$this->name->TooltipValue = "";

			// lastname
			$this->lastname->LinkCustomAttributes = "";
			$this->lastname->HrefValue = "";
			$this->lastname->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// address
			$this->address->LinkCustomAttributes = "";
			$this->address->HrefValue = "";
			$this->address->TooltipValue = "";

			// phone
			$this->phone->LinkCustomAttributes = "";
			$this->phone->HrefValue = "";
			$this->phone->TooltipValue = "";

			// cell
			$this->cell->LinkCustomAttributes = "";
			$this->cell->HrefValue = "";
			$this->cell->TooltipValue = "";

			// created_at
			$this->created_at->LinkCustomAttributes = "";
			$this->created_at->HrefValue = "";
			$this->created_at->TooltipValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";
			$this->id_sucursal->TooltipValue = "";

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

			// email_contacto
			$this->email_contacto->LinkCustomAttributes = "";
			$this->email_contacto->HrefValue = "";
			$this->email_contacto->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// nombre_contacto
			$this->nombre_contacto->EditAttrs["class"] = "form-control";
			$this->nombre_contacto->EditCustomAttributes = "";
			$this->nombre_contacto->EditValue = ew_HtmlEncode($this->nombre_contacto->AdvancedSearch->SearchValue);
			$this->nombre_contacto->PlaceHolder = ew_RemoveHtml($this->nombre_contacto->FldTitle());

			// name
			$this->name->EditAttrs["class"] = "form-control";
			$this->name->EditCustomAttributes = "";
			$this->name->EditValue = ew_HtmlEncode($this->name->AdvancedSearch->SearchValue);
			$this->name->PlaceHolder = ew_RemoveHtml($this->name->FldTitle());

			// lastname
			$this->lastname->EditAttrs["class"] = "form-control";
			$this->lastname->EditCustomAttributes = "";
			$this->lastname->EditValue = ew_HtmlEncode($this->lastname->AdvancedSearch->SearchValue);
			$this->lastname->PlaceHolder = ew_RemoveHtml($this->lastname->FldTitle());

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

			// phone
			$this->phone->EditAttrs["class"] = "form-control";
			$this->phone->EditCustomAttributes = "";
			$this->phone->EditValue = ew_HtmlEncode($this->phone->AdvancedSearch->SearchValue);
			$this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldTitle());

			// cell
			$this->cell->EditAttrs["class"] = "form-control";
			$this->cell->EditCustomAttributes = "";
			$this->cell->EditValue = ew_HtmlEncode($this->cell->AdvancedSearch->SearchValue);
			$this->cell->PlaceHolder = ew_RemoveHtml($this->cell->FldTitle());

			// created_at
			$this->created_at->EditAttrs["class"] = "form-control";
			$this->created_at->EditCustomAttributes = "";
			$this->created_at->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->created_at->AdvancedSearch->SearchValue, 17), 17));
			$this->created_at->PlaceHolder = ew_RemoveHtml($this->created_at->FldTitle());

			// id_sucursal
			$this->id_sucursal->EditAttrs["class"] = "form-control";
			$this->id_sucursal->EditCustomAttributes = "";

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

			// email_contacto
			$this->email_contacto->EditAttrs["class"] = "form-control";
			$this->email_contacto->EditCustomAttributes = "";
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
		$this->nombre_contacto->AdvancedSearch->Load();
		$this->name->AdvancedSearch->Load();
		$this->lastname->AdvancedSearch->Load();
		$this->_email->AdvancedSearch->Load();
		$this->address->AdvancedSearch->Load();
		$this->phone->AdvancedSearch->Load();
		$this->cell->AdvancedSearch->Load();
		$this->created_at->AdvancedSearch->Load();
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
		$this->email_contacto->AdvancedSearch->Load();
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

		var_dump($this->ListOptions);
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
if (!isset($solicitud_list)) $solicitud_list = new csolicitud_list();

// Page init
$solicitud_list->Page_Init();

// Page main
$solicitud_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$solicitud_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fsolicitudlist = new ew_Form("fsolicitudlist", "list");
fsolicitudlist.FormKeyCountName = '<?php echo $solicitud_list->FormKeyCountName ?>';

// Form_CustomValidate event
fsolicitudlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fsolicitudlist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fsolicitudlist.Lists["x_id_sucursal"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"sucursal"};
fsolicitudlist.Lists["x_id_sucursal"].Data = "<?php echo $solicitud_list->id_sucursal->LookupFilterQuery(FALSE, "list") ?>";
fsolicitudlist.Lists["x_tipoinmueble[]"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fsolicitudlist.Lists["x_tipoinmueble[]"].Data = "<?php echo $solicitud_list->tipoinmueble->LookupFilterQuery(FALSE, "list") ?>";
fsolicitudlist.Lists["x_tipovehiculo[]"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fsolicitudlist.Lists["x_tipovehiculo[]"].Data = "<?php echo $solicitud_list->tipovehiculo->LookupFilterQuery(FALSE, "list") ?>";
fsolicitudlist.Lists["x_tipomaquinaria[]"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fsolicitudlist.Lists["x_tipomaquinaria[]"].Data = "<?php echo $solicitud_list->tipomaquinaria->LookupFilterQuery(FALSE, "list") ?>";
fsolicitudlist.Lists["x_tipomercaderia[]"] = {"LinkField":"x_id_tipoinmueble","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fsolicitudlist.Lists["x_tipomercaderia[]"].Data = "<?php echo $solicitud_list->tipomercaderia->LookupFilterQuery(FALSE, "list") ?>";
fsolicitudlist.Lists["x_tipoespecial[]"] = {"LinkField":"x_id_tipoinmueble","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fsolicitudlist.Lists["x_tipoespecial[]"].Data = "<?php echo $solicitud_list->tipoespecial->LookupFilterQuery(FALSE, "list") ?>";
fsolicitudlist.Lists["x_email_contacto"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fsolicitudlist.Lists["x_email_contacto"].Data = "<?php echo $solicitud_list->email_contacto->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = fsolicitudlistsrch = new ew_Form("fsolicitudlistsrch");

// Validate function for search
fsolicitudlistsrch.Validate = function(fobj) {
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
fsolicitudlistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fsolicitudlistsrch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if ($solicitud_list->TotalRecs > 0 && $solicitud_list->ExportOptions->Visible()) { ?>
<?php $solicitud_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($solicitud_list->SearchOptions->Visible()) { ?>
<?php $solicitud_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($solicitud_list->FilterOptions->Visible()) { ?>
<?php $solicitud_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php
	$bSelectLimit = $solicitud_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($solicitud_list->TotalRecs <= 0)
			$solicitud_list->TotalRecs = $solicitud->ListRecordCount();
	} else {
		if (!$solicitud_list->Recordset && ($solicitud_list->Recordset = $solicitud_list->LoadRecordset()))
			$solicitud_list->TotalRecs = $solicitud_list->Recordset->RecordCount();
	}
	$solicitud_list->StartRec = 1;
	if ($solicitud_list->DisplayRecs <= 0 || ($solicitud->Export <> "" && $solicitud->ExportAll)) // Display all records
		$solicitud_list->DisplayRecs = $solicitud_list->TotalRecs;
	if (!($solicitud->Export <> "" && $solicitud->ExportAll))
		$solicitud_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$solicitud_list->Recordset = $solicitud_list->LoadRecordset($solicitud_list->StartRec-1, $solicitud_list->DisplayRecs);

	// Set no record found message
	if ($solicitud->CurrentAction == "" && $solicitud_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$solicitud_list->setWarningMessage(ew_DeniedMsg());
		if ($solicitud_list->SearchWhere == "0=101")
			$solicitud_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$solicitud_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$solicitud_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($solicitud->Export == "" && $solicitud->CurrentAction == "") { ?>
<form name="fsolicitudlistsrch" id="fsolicitudlistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($solicitud_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fsolicitudlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="solicitud">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$solicitud_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$solicitud->RowType = EW_ROWTYPE_SEARCH;

// Render row
$solicitud->ResetAttrs();
$solicitud_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($solicitud->name->Visible) { // name ?>
	<div id="xsc_name" class="ewCell form-group">
		<label for="x_name" class="ewSearchCaption ewLabel"><?php echo $solicitud->name->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_name" id="z_name" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" data-table="solicitud" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($solicitud->name->getPlaceHolder()) ?>" value="<?php echo $solicitud->name->EditValue ?>"<?php echo $solicitud->name->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
<?php if ($solicitud->lastname->Visible) { // lastname ?>
	<div id="xsc_lastname" class="ewCell form-group">
		<label for="x_lastname" class="ewSearchCaption ewLabel"><?php echo $solicitud->lastname->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_lastname" id="z_lastname" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" data-table="solicitud" data-field="x_lastname" name="x_lastname" id="x_lastname" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($solicitud->lastname->getPlaceHolder()) ?>" value="<?php echo $solicitud->lastname->EditValue ?>"<?php echo $solicitud->lastname->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ewRow">
<?php if ($solicitud->_email->Visible) { // email ?>
	<div id="xsc__email" class="ewCell form-group">
		<label for="x__email" class="ewSearchCaption ewLabel"><?php echo $solicitud->_email->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z__email" id="z__email" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" data-table="solicitud" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($solicitud->_email->getPlaceHolder()) ?>" value="<?php echo $solicitud->_email->EditValue ?>"<?php echo $solicitud->_email->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_4" class="ewRow">
<?php if ($solicitud->address->Visible) { // address ?>
	<div id="xsc_address" class="ewCell form-group">
		<label for="x_address" class="ewSearchCaption ewLabel"><?php echo $solicitud->address->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_address" id="z_address" value="LIKE"></span>
		<span class="ewSearchField">
<textarea data-table="solicitud" data-field="x_address" name="x_address" id="x_address" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($solicitud->address->getPlaceHolder()) ?>"<?php echo $solicitud->address->EditAttributes() ?>><?php echo $solicitud->address->EditValue ?></textarea>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_5" class="ewRow">
<?php if ($solicitud->phone->Visible) { // phone ?>
	<div id="xsc_phone" class="ewCell form-group">
		<label for="x_phone" class="ewSearchCaption ewLabel"><?php echo $solicitud->phone->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_phone" id="z_phone" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" data-table="solicitud" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($solicitud->phone->getPlaceHolder()) ?>" value="<?php echo $solicitud->phone->EditValue ?>"<?php echo $solicitud->phone->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_6" class="ewRow">
<?php if ($solicitud->cell->Visible) { // cell ?>
	<div id="xsc_cell" class="ewCell form-group">
		<label for="x_cell" class="ewSearchCaption ewLabel"><?php echo $solicitud->cell->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_cell" id="z_cell" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" data-table="solicitud" data-field="x_cell" name="x_cell" id="x_cell" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($solicitud->cell->getPlaceHolder()) ?>" value="<?php echo $solicitud->cell->EditValue ?>"<?php echo $solicitud->cell->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_7" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($solicitud_list->BasicSearch->getKeyword()) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($solicitud_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $solicitud_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($solicitud_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($solicitud_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($solicitud_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($solicitud_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
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
<?php $solicitud_list->ShowPageHeader(); ?>
<?php
$solicitud_list->ShowMessage();
?>
<?php if ($solicitud_list->TotalRecs > 0 || $solicitud->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($solicitud_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> solicitud">
<form name="fsolicitudlist" id="fsolicitudlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($solicitud_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $solicitud_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="solicitud">
<div id="gmp_solicitud" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($solicitud_list->TotalRecs > 0 || $solicitud->CurrentAction == "gridedit") { ?>
<table id="tbl_solicitudlist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$solicitud_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$solicitud_list->RenderListOptions();

// Render list options (header, left)
$solicitud_list->ListOptions->Render("header", "left");
?>
<?php if ($solicitud->nombre_contacto->Visible) { // nombre_contacto ?>
	<?php if ($solicitud->SortUrl($solicitud->nombre_contacto) == "") { ?>
		<th data-name="nombre_contacto" class="<?php echo $solicitud->nombre_contacto->HeaderCellClass() ?>"><div id="elh_solicitud_nombre_contacto" class="solicitud_nombre_contacto"><div class="ewTableHeaderCaption"><?php echo $solicitud->nombre_contacto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre_contacto" class="<?php echo $solicitud->nombre_contacto->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->nombre_contacto) ?>',1);"><div id="elh_solicitud_nombre_contacto" class="solicitud_nombre_contacto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->nombre_contacto->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->nombre_contacto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->nombre_contacto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->name->Visible) { // name ?>
	<?php if ($solicitud->SortUrl($solicitud->name) == "") { ?>
		<th data-name="name" class="<?php echo $solicitud->name->HeaderCellClass() ?>"><div id="elh_solicitud_name" class="solicitud_name"><div class="ewTableHeaderCaption"><?php echo $solicitud->name->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="name" class="<?php echo $solicitud->name->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->name) ?>',1);"><div id="elh_solicitud_name" class="solicitud_name">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->name->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->lastname->Visible) { // lastname ?>
	<?php if ($solicitud->SortUrl($solicitud->lastname) == "") { ?>
		<th data-name="lastname" class="<?php echo $solicitud->lastname->HeaderCellClass() ?>"><div id="elh_solicitud_lastname" class="solicitud_lastname"><div class="ewTableHeaderCaption"><?php echo $solicitud->lastname->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="lastname" class="<?php echo $solicitud->lastname->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->lastname) ?>',1);"><div id="elh_solicitud_lastname" class="solicitud_lastname">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->lastname->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->lastname->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->lastname->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->_email->Visible) { // email ?>
	<?php if ($solicitud->SortUrl($solicitud->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $solicitud->_email->HeaderCellClass() ?>"><div id="elh_solicitud__email" class="solicitud__email"><div class="ewTableHeaderCaption"><?php echo $solicitud->_email->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $solicitud->_email->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->_email) ?>',1);"><div id="elh_solicitud__email" class="solicitud__email">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->_email->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->_email->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->_email->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->address->Visible) { // address ?>
	<?php if ($solicitud->SortUrl($solicitud->address) == "") { ?>
		<th data-name="address" class="<?php echo $solicitud->address->HeaderCellClass() ?>"><div id="elh_solicitud_address" class="solicitud_address"><div class="ewTableHeaderCaption"><?php echo $solicitud->address->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="address" class="<?php echo $solicitud->address->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->address) ?>',1);"><div id="elh_solicitud_address" class="solicitud_address">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->address->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->address->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->address->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->phone->Visible) { // phone ?>
	<?php if ($solicitud->SortUrl($solicitud->phone) == "") { ?>
		<th data-name="phone" class="<?php echo $solicitud->phone->HeaderCellClass() ?>"><div id="elh_solicitud_phone" class="solicitud_phone"><div class="ewTableHeaderCaption"><?php echo $solicitud->phone->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="phone" class="<?php echo $solicitud->phone->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->phone) ?>',1);"><div id="elh_solicitud_phone" class="solicitud_phone">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->phone->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->phone->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->phone->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->cell->Visible) { // cell ?>
	<?php if ($solicitud->SortUrl($solicitud->cell) == "") { ?>
		<th data-name="cell" class="<?php echo $solicitud->cell->HeaderCellClass() ?>"><div id="elh_solicitud_cell" class="solicitud_cell"><div class="ewTableHeaderCaption"><?php echo $solicitud->cell->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cell" class="<?php echo $solicitud->cell->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->cell) ?>',1);"><div id="elh_solicitud_cell" class="solicitud_cell">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->cell->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->cell->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->cell->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->created_at->Visible) { // created_at ?>
	<?php if ($solicitud->SortUrl($solicitud->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $solicitud->created_at->HeaderCellClass() ?>"><div id="elh_solicitud_created_at" class="solicitud_created_at"><div class="ewTableHeaderCaption"><?php echo $solicitud->created_at->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $solicitud->created_at->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->created_at) ?>',1);"><div id="elh_solicitud_created_at" class="solicitud_created_at">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->created_at->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->created_at->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->created_at->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->id_sucursal->Visible) { // id_sucursal ?>
	<?php if ($solicitud->SortUrl($solicitud->id_sucursal) == "") { ?>
		<th data-name="id_sucursal" class="<?php echo $solicitud->id_sucursal->HeaderCellClass() ?>"><div id="elh_solicitud_id_sucursal" class="solicitud_id_sucursal"><div class="ewTableHeaderCaption"><?php echo $solicitud->id_sucursal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_sucursal" class="<?php echo $solicitud->id_sucursal->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->id_sucursal) ?>',1);"><div id="elh_solicitud_id_sucursal" class="solicitud_id_sucursal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->id_sucursal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->id_sucursal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->id_sucursal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->tipoinmueble->Visible) { // tipoinmueble ?>
	<?php if ($solicitud->SortUrl($solicitud->tipoinmueble) == "") { ?>
		<th data-name="tipoinmueble" class="<?php echo $solicitud->tipoinmueble->HeaderCellClass() ?>"><div id="elh_solicitud_tipoinmueble" class="solicitud_tipoinmueble"><div class="ewTableHeaderCaption"><?php echo $solicitud->tipoinmueble->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipoinmueble" class="<?php echo $solicitud->tipoinmueble->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->tipoinmueble) ?>',1);"><div id="elh_solicitud_tipoinmueble" class="solicitud_tipoinmueble">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->tipoinmueble->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->tipoinmueble->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->tipoinmueble->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->tipovehiculo->Visible) { // tipovehiculo ?>
	<?php if ($solicitud->SortUrl($solicitud->tipovehiculo) == "") { ?>
		<th data-name="tipovehiculo" class="<?php echo $solicitud->tipovehiculo->HeaderCellClass() ?>"><div id="elh_solicitud_tipovehiculo" class="solicitud_tipovehiculo"><div class="ewTableHeaderCaption"><?php echo $solicitud->tipovehiculo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipovehiculo" class="<?php echo $solicitud->tipovehiculo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->tipovehiculo) ?>',1);"><div id="elh_solicitud_tipovehiculo" class="solicitud_tipovehiculo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->tipovehiculo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->tipovehiculo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->tipovehiculo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->tipomaquinaria->Visible) { // tipomaquinaria ?>
	<?php if ($solicitud->SortUrl($solicitud->tipomaquinaria) == "") { ?>
		<th data-name="tipomaquinaria" class="<?php echo $solicitud->tipomaquinaria->HeaderCellClass() ?>"><div id="elh_solicitud_tipomaquinaria" class="solicitud_tipomaquinaria"><div class="ewTableHeaderCaption"><?php echo $solicitud->tipomaquinaria->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipomaquinaria" class="<?php echo $solicitud->tipomaquinaria->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->tipomaquinaria) ?>',1);"><div id="elh_solicitud_tipomaquinaria" class="solicitud_tipomaquinaria">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->tipomaquinaria->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->tipomaquinaria->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->tipomaquinaria->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->tipomercaderia->Visible) { // tipomercaderia ?>
	<?php if ($solicitud->SortUrl($solicitud->tipomercaderia) == "") { ?>
		<th data-name="tipomercaderia" class="<?php echo $solicitud->tipomercaderia->HeaderCellClass() ?>"><div id="elh_solicitud_tipomercaderia" class="solicitud_tipomercaderia"><div class="ewTableHeaderCaption"><?php echo $solicitud->tipomercaderia->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipomercaderia" class="<?php echo $solicitud->tipomercaderia->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->tipomercaderia) ?>',1);"><div id="elh_solicitud_tipomercaderia" class="solicitud_tipomercaderia">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->tipomercaderia->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->tipomercaderia->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->tipomercaderia->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->tipoespecial->Visible) { // tipoespecial ?>
	<?php if ($solicitud->SortUrl($solicitud->tipoespecial) == "") { ?>
		<th data-name="tipoespecial" class="<?php echo $solicitud->tipoespecial->HeaderCellClass() ?>"><div id="elh_solicitud_tipoespecial" class="solicitud_tipoespecial"><div class="ewTableHeaderCaption"><?php echo $solicitud->tipoespecial->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipoespecial" class="<?php echo $solicitud->tipoespecial->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->tipoespecial) ?>',1);"><div id="elh_solicitud_tipoespecial" class="solicitud_tipoespecial">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->tipoespecial->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->tipoespecial->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->tipoespecial->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($solicitud->email_contacto->Visible) { // email_contacto ?>
	<?php if ($solicitud->SortUrl($solicitud->email_contacto) == "") { ?>
		<th data-name="email_contacto" class="<?php echo $solicitud->email_contacto->HeaderCellClass() ?>"><div id="elh_solicitud_email_contacto" class="solicitud_email_contacto"><div class="ewTableHeaderCaption"><?php echo $solicitud->email_contacto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="email_contacto" class="<?php echo $solicitud->email_contacto->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $solicitud->SortUrl($solicitud->email_contacto) ?>',1);"><div id="elh_solicitud_email_contacto" class="solicitud_email_contacto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $solicitud->email_contacto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($solicitud->email_contacto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($solicitud->email_contacto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$solicitud_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($solicitud->ExportAll && $solicitud->Export <> "") {
	$solicitud_list->StopRec = $solicitud_list->TotalRecs;
} else {

	// Set the last record to display
	if ($solicitud_list->TotalRecs > $solicitud_list->StartRec + $solicitud_list->DisplayRecs - 1)
		$solicitud_list->StopRec = $solicitud_list->StartRec + $solicitud_list->DisplayRecs - 1;
	else
		$solicitud_list->StopRec = $solicitud_list->TotalRecs;
}
$solicitud_list->RecCnt = $solicitud_list->StartRec - 1;
if ($solicitud_list->Recordset && !$solicitud_list->Recordset->EOF) {
	$solicitud_list->Recordset->MoveFirst();
	$bSelectLimit = $solicitud_list->UseSelectLimit;
	if (!$bSelectLimit && $solicitud_list->StartRec > 1)
		$solicitud_list->Recordset->Move($solicitud_list->StartRec - 1);
} elseif (!$solicitud->AllowAddDeleteRow && $solicitud_list->StopRec == 0) {
	$solicitud_list->StopRec = $solicitud->GridAddRowCount;
}

// Initialize aggregate
$solicitud->RowType = EW_ROWTYPE_AGGREGATEINIT;
$solicitud->ResetAttrs();
$solicitud_list->RenderRow();
while ($solicitud_list->RecCnt < $solicitud_list->StopRec) {
	$solicitud_list->RecCnt++;
	if (intval($solicitud_list->RecCnt) >= intval($solicitud_list->StartRec)) {
		$solicitud_list->RowCnt++;

		// Set up key count
		$solicitud_list->KeyCount = $solicitud_list->RowIndex;

		// Init row class and style
		$solicitud->ResetAttrs();
		$solicitud->CssClass = "";
		if ($solicitud->CurrentAction == "gridadd") {
		} else {
			$solicitud_list->LoadRowValues($solicitud_list->Recordset); // Load row values
		}
		$solicitud->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$solicitud->RowAttrs = array_merge($solicitud->RowAttrs, array('data-rowindex'=>$solicitud_list->RowCnt, 'id'=>'r' . $solicitud_list->RowCnt . '_solicitud', 'data-rowtype'=>$solicitud->RowType));

		// Render row
		$solicitud_list->RenderRow();

		// Render list options
		$solicitud_list->RenderListOptions();
?>
	<tr<?php echo $solicitud->RowAttributes() ?>>
<?php

// Render list options (body, left)
$solicitud_list->ListOptions->Render("body", "left", $solicitud_list->RowCnt);
?>
	<?php if ($solicitud->nombre_contacto->Visible) { // nombre_contacto ?>
		<td data-name="nombre_contacto"<?php echo $solicitud->nombre_contacto->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_nombre_contacto" class="solicitud_nombre_contacto">
<span<?php echo $solicitud->nombre_contacto->ViewAttributes() ?>>
<?php echo $solicitud->nombre_contacto->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->name->Visible) { // name ?>
		<td data-name="name"<?php echo $solicitud->name->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_name" class="solicitud_name">
<span<?php echo $solicitud->name->ViewAttributes() ?>>
<?php echo $solicitud->name->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->lastname->Visible) { // lastname ?>
		<td data-name="lastname"<?php echo $solicitud->lastname->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_lastname" class="solicitud_lastname">
<span<?php echo $solicitud->lastname->ViewAttributes() ?>>
<?php echo $solicitud->lastname->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->_email->Visible) { // email ?>
		<td data-name="_email"<?php echo $solicitud->_email->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud__email" class="solicitud__email">
<span<?php echo $solicitud->_email->ViewAttributes() ?>>
<?php echo $solicitud->_email->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->address->Visible) { // address ?>
		<td data-name="address"<?php echo $solicitud->address->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_address" class="solicitud_address">
<span<?php echo $solicitud->address->ViewAttributes() ?>>
<?php echo $solicitud->address->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->phone->Visible) { // phone ?>
		<td data-name="phone"<?php echo $solicitud->phone->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_phone" class="solicitud_phone">
<span<?php echo $solicitud->phone->ViewAttributes() ?>>
<?php echo $solicitud->phone->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->cell->Visible) { // cell ?>
		<td data-name="cell"<?php echo $solicitud->cell->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_cell" class="solicitud_cell">
<span<?php echo $solicitud->cell->ViewAttributes() ?>>
<?php echo $solicitud->cell->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->created_at->Visible) { // created_at ?>
		<td data-name="created_at"<?php echo $solicitud->created_at->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_created_at" class="solicitud_created_at">
<span<?php echo $solicitud->created_at->ViewAttributes() ?>>
<?php echo $solicitud->created_at->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->id_sucursal->Visible) { // id_sucursal ?>
		<td data-name="id_sucursal"<?php echo $solicitud->id_sucursal->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_id_sucursal" class="solicitud_id_sucursal">
<span<?php echo $solicitud->id_sucursal->ViewAttributes() ?>>
<?php echo $solicitud->id_sucursal->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->tipoinmueble->Visible) { // tipoinmueble ?>
		<td data-name="tipoinmueble"<?php echo $solicitud->tipoinmueble->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_tipoinmueble" class="solicitud_tipoinmueble">
<span<?php echo $solicitud->tipoinmueble->ViewAttributes() ?>>
<?php echo $solicitud->tipoinmueble->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->tipovehiculo->Visible) { // tipovehiculo ?>
		<td data-name="tipovehiculo"<?php echo $solicitud->tipovehiculo->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_tipovehiculo" class="solicitud_tipovehiculo">
<span<?php echo $solicitud->tipovehiculo->ViewAttributes() ?>>
<?php echo $solicitud->tipovehiculo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->tipomaquinaria->Visible) { // tipomaquinaria ?>
		<td data-name="tipomaquinaria"<?php echo $solicitud->tipomaquinaria->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_tipomaquinaria" class="solicitud_tipomaquinaria">
<span<?php echo $solicitud->tipomaquinaria->ViewAttributes() ?>>
<?php echo $solicitud->tipomaquinaria->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->tipomercaderia->Visible) { // tipomercaderia ?>
		<td data-name="tipomercaderia"<?php echo $solicitud->tipomercaderia->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_tipomercaderia" class="solicitud_tipomercaderia">
<span<?php echo $solicitud->tipomercaderia->ViewAttributes() ?>>
<?php echo $solicitud->tipomercaderia->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->tipoespecial->Visible) { // tipoespecial ?>
		<td data-name="tipoespecial"<?php echo $solicitud->tipoespecial->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_tipoespecial" class="solicitud_tipoespecial">
<span<?php echo $solicitud->tipoespecial->ViewAttributes() ?>>
<?php echo $solicitud->tipoespecial->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($solicitud->email_contacto->Visible) { // email_contacto ?>
		<td data-name="email_contacto"<?php echo $solicitud->email_contacto->CellAttributes() ?>>
<span id="el<?php echo $solicitud_list->RowCnt ?>_solicitud_email_contacto" class="solicitud_email_contacto">
<span<?php echo $solicitud->email_contacto->ViewAttributes() ?>>
<?php echo $solicitud->email_contacto->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$solicitud_list->ListOptions->Render("body", "right", $solicitud_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($solicitud->CurrentAction <> "gridadd")
		$solicitud_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($solicitud->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($solicitud_list->Recordset)
	$solicitud_list->Recordset->Close();
?>
<div class="box-footer ewGridLowerPanel">
<?php if ($solicitud->CurrentAction <> "gridadd" && $solicitud->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($solicitud_list->Pager)) $solicitud_list->Pager = new cNumericPager($solicitud_list->StartRec, $solicitud_list->DisplayRecs, $solicitud_list->TotalRecs, $solicitud_list->RecRange, $solicitud_list->AutoHidePager) ?>
<?php if ($solicitud_list->Pager->RecordCount > 0 && $solicitud_list->Pager->Visible) { ?>
<div class="ewPager">
<div class="ewNumericPage"><ul class="pagination">
	<?php if ($solicitud_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $solicitud_list->PageUrl() ?>start=<?php echo $solicitud_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($solicitud_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $solicitud_list->PageUrl() ?>start=<?php echo $solicitud_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($solicitud_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $solicitud_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($solicitud_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $solicitud_list->PageUrl() ?>start=<?php echo $solicitud_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($solicitud_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $solicitud_list->PageUrl() ?>start=<?php echo $solicitud_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($solicitud_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $solicitud_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $solicitud_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $solicitud_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($solicitud_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($solicitud_list->TotalRecs == 0 && $solicitud->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($solicitud_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
fsolicitudlistsrch.FilterList = <?php echo $solicitud_list->GetFilterList() ?>;
fsolicitudlistsrch.Init();
fsolicitudlist.Init();
</script>
<?php
$solicitud_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$solicitud_list->Page_Terminate();
?>
