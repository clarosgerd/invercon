<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "inspectorinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$inspector_list = NULL; // Initialize page object first

class cinspector_list extends cinspector {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'inspector';

	// Page object name
	var $PageObjName = 'inspector_list';

	// Grid form hidden field names
	var $FormName = 'finspectorlist';
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

		// Table object (inspector)
		if (!isset($GLOBALS["inspector"]) || get_class($GLOBALS["inspector"]) == "cinspector") {
			$GLOBALS["inspector"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["inspector"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "inspectoradd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "inspectordelete.php";
		$this->MultiUpdateUrl = "inspectorupdate.php";

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'inspector', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption finspectorlistsrch";

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
		$this->nombre->SetVisibility();
		$this->apellido->SetVisibility();
		$this->_login->SetVisibility();
		$this->ci->SetVisibility();
		$this->id_rol->SetVisibility();
		$this->id_sucursal->SetVisibility();
		$this->_email->SetVisibility();
		$this->telefono_fijo01->SetVisibility();
		$this->telefono_fijo02->SetVisibility();
		$this->celular->SetVisibility();
		$this->celular2->SetVisibility();
		$this->cargo->SetVisibility();
		$this->id_institucion->SetVisibility();
		$this->especialidad->SetVisibility();
		$this->status->SetVisibility();
		$this->color->SetVisibility();

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
		global $EW_EXPORT, $inspector;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($inspector);
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
			$this->_login->setFormValue($arrKeyFlds[0]);
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
			$sSavedFilterList = $UserProfile->GetSearchFilters(CurrentUserName(), "finspectorlistsrch");
		$sFilterList = ew_Concat($sFilterList, $this->nombre->AdvancedSearch->ToJson(), ","); // Field nombre
		$sFilterList = ew_Concat($sFilterList, $this->apellido->AdvancedSearch->ToJson(), ","); // Field apellido
		$sFilterList = ew_Concat($sFilterList, $this->_login->AdvancedSearch->ToJson(), ","); // Field login
		$sFilterList = ew_Concat($sFilterList, $this->password->AdvancedSearch->ToJson(), ","); // Field password
		$sFilterList = ew_Concat($sFilterList, $this->ci->AdvancedSearch->ToJson(), ","); // Field ci
		$sFilterList = ew_Concat($sFilterList, $this->id_rol->AdvancedSearch->ToJson(), ","); // Field id_rol
		$sFilterList = ew_Concat($sFilterList, $this->id_sucursal->AdvancedSearch->ToJson(), ","); // Field id_sucursal
		$sFilterList = ew_Concat($sFilterList, $this->_email->AdvancedSearch->ToJson(), ","); // Field email
		$sFilterList = ew_Concat($sFilterList, $this->telefono_fijo01->AdvancedSearch->ToJson(), ","); // Field telefono_fijo01
		$sFilterList = ew_Concat($sFilterList, $this->telefono_fijo02->AdvancedSearch->ToJson(), ","); // Field telefono_fijo02
		$sFilterList = ew_Concat($sFilterList, $this->celular->AdvancedSearch->ToJson(), ","); // Field celular
		$sFilterList = ew_Concat($sFilterList, $this->celular2->AdvancedSearch->ToJson(), ","); // Field celular2
		$sFilterList = ew_Concat($sFilterList, $this->direccion->AdvancedSearch->ToJson(), ","); // Field direccion
		$sFilterList = ew_Concat($sFilterList, $this->cargo->AdvancedSearch->ToJson(), ","); // Field cargo
		$sFilterList = ew_Concat($sFilterList, $this->id_institucion->AdvancedSearch->ToJson(), ","); // Field id_institucion
		$sFilterList = ew_Concat($sFilterList, $this->especialidad->AdvancedSearch->ToJson(), ","); // Field especialidad
		$sFilterList = ew_Concat($sFilterList, $this->status->AdvancedSearch->ToJson(), ","); // Field status
		$sFilterList = ew_Concat($sFilterList, $this->color->AdvancedSearch->ToJson(), ","); // Field color
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "finspectorlistsrch", $filters);

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

		// Field nombre
		$this->nombre->AdvancedSearch->SearchValue = @$filter["x_nombre"];
		$this->nombre->AdvancedSearch->SearchOperator = @$filter["z_nombre"];
		$this->nombre->AdvancedSearch->SearchCondition = @$filter["v_nombre"];
		$this->nombre->AdvancedSearch->SearchValue2 = @$filter["y_nombre"];
		$this->nombre->AdvancedSearch->SearchOperator2 = @$filter["w_nombre"];
		$this->nombre->AdvancedSearch->Save();

		// Field apellido
		$this->apellido->AdvancedSearch->SearchValue = @$filter["x_apellido"];
		$this->apellido->AdvancedSearch->SearchOperator = @$filter["z_apellido"];
		$this->apellido->AdvancedSearch->SearchCondition = @$filter["v_apellido"];
		$this->apellido->AdvancedSearch->SearchValue2 = @$filter["y_apellido"];
		$this->apellido->AdvancedSearch->SearchOperator2 = @$filter["w_apellido"];
		$this->apellido->AdvancedSearch->Save();

		// Field login
		$this->_login->AdvancedSearch->SearchValue = @$filter["x__login"];
		$this->_login->AdvancedSearch->SearchOperator = @$filter["z__login"];
		$this->_login->AdvancedSearch->SearchCondition = @$filter["v__login"];
		$this->_login->AdvancedSearch->SearchValue2 = @$filter["y__login"];
		$this->_login->AdvancedSearch->SearchOperator2 = @$filter["w__login"];
		$this->_login->AdvancedSearch->Save();

		// Field password
		$this->password->AdvancedSearch->SearchValue = @$filter["x_password"];
		$this->password->AdvancedSearch->SearchOperator = @$filter["z_password"];
		$this->password->AdvancedSearch->SearchCondition = @$filter["v_password"];
		$this->password->AdvancedSearch->SearchValue2 = @$filter["y_password"];
		$this->password->AdvancedSearch->SearchOperator2 = @$filter["w_password"];
		$this->password->AdvancedSearch->Save();

		// Field ci
		$this->ci->AdvancedSearch->SearchValue = @$filter["x_ci"];
		$this->ci->AdvancedSearch->SearchOperator = @$filter["z_ci"];
		$this->ci->AdvancedSearch->SearchCondition = @$filter["v_ci"];
		$this->ci->AdvancedSearch->SearchValue2 = @$filter["y_ci"];
		$this->ci->AdvancedSearch->SearchOperator2 = @$filter["w_ci"];
		$this->ci->AdvancedSearch->Save();

		// Field id_rol
		$this->id_rol->AdvancedSearch->SearchValue = @$filter["x_id_rol"];
		$this->id_rol->AdvancedSearch->SearchOperator = @$filter["z_id_rol"];
		$this->id_rol->AdvancedSearch->SearchCondition = @$filter["v_id_rol"];
		$this->id_rol->AdvancedSearch->SearchValue2 = @$filter["y_id_rol"];
		$this->id_rol->AdvancedSearch->SearchOperator2 = @$filter["w_id_rol"];
		$this->id_rol->AdvancedSearch->Save();

		// Field id_sucursal
		$this->id_sucursal->AdvancedSearch->SearchValue = @$filter["x_id_sucursal"];
		$this->id_sucursal->AdvancedSearch->SearchOperator = @$filter["z_id_sucursal"];
		$this->id_sucursal->AdvancedSearch->SearchCondition = @$filter["v_id_sucursal"];
		$this->id_sucursal->AdvancedSearch->SearchValue2 = @$filter["y_id_sucursal"];
		$this->id_sucursal->AdvancedSearch->SearchOperator2 = @$filter["w_id_sucursal"];
		$this->id_sucursal->AdvancedSearch->Save();

		// Field email
		$this->_email->AdvancedSearch->SearchValue = @$filter["x__email"];
		$this->_email->AdvancedSearch->SearchOperator = @$filter["z__email"];
		$this->_email->AdvancedSearch->SearchCondition = @$filter["v__email"];
		$this->_email->AdvancedSearch->SearchValue2 = @$filter["y__email"];
		$this->_email->AdvancedSearch->SearchOperator2 = @$filter["w__email"];
		$this->_email->AdvancedSearch->Save();

		// Field telefono_fijo01
		$this->telefono_fijo01->AdvancedSearch->SearchValue = @$filter["x_telefono_fijo01"];
		$this->telefono_fijo01->AdvancedSearch->SearchOperator = @$filter["z_telefono_fijo01"];
		$this->telefono_fijo01->AdvancedSearch->SearchCondition = @$filter["v_telefono_fijo01"];
		$this->telefono_fijo01->AdvancedSearch->SearchValue2 = @$filter["y_telefono_fijo01"];
		$this->telefono_fijo01->AdvancedSearch->SearchOperator2 = @$filter["w_telefono_fijo01"];
		$this->telefono_fijo01->AdvancedSearch->Save();

		// Field telefono_fijo02
		$this->telefono_fijo02->AdvancedSearch->SearchValue = @$filter["x_telefono_fijo02"];
		$this->telefono_fijo02->AdvancedSearch->SearchOperator = @$filter["z_telefono_fijo02"];
		$this->telefono_fijo02->AdvancedSearch->SearchCondition = @$filter["v_telefono_fijo02"];
		$this->telefono_fijo02->AdvancedSearch->SearchValue2 = @$filter["y_telefono_fijo02"];
		$this->telefono_fijo02->AdvancedSearch->SearchOperator2 = @$filter["w_telefono_fijo02"];
		$this->telefono_fijo02->AdvancedSearch->Save();

		// Field celular
		$this->celular->AdvancedSearch->SearchValue = @$filter["x_celular"];
		$this->celular->AdvancedSearch->SearchOperator = @$filter["z_celular"];
		$this->celular->AdvancedSearch->SearchCondition = @$filter["v_celular"];
		$this->celular->AdvancedSearch->SearchValue2 = @$filter["y_celular"];
		$this->celular->AdvancedSearch->SearchOperator2 = @$filter["w_celular"];
		$this->celular->AdvancedSearch->Save();

		// Field celular2
		$this->celular2->AdvancedSearch->SearchValue = @$filter["x_celular2"];
		$this->celular2->AdvancedSearch->SearchOperator = @$filter["z_celular2"];
		$this->celular2->AdvancedSearch->SearchCondition = @$filter["v_celular2"];
		$this->celular2->AdvancedSearch->SearchValue2 = @$filter["y_celular2"];
		$this->celular2->AdvancedSearch->SearchOperator2 = @$filter["w_celular2"];
		$this->celular2->AdvancedSearch->Save();

		// Field direccion
		$this->direccion->AdvancedSearch->SearchValue = @$filter["x_direccion"];
		$this->direccion->AdvancedSearch->SearchOperator = @$filter["z_direccion"];
		$this->direccion->AdvancedSearch->SearchCondition = @$filter["v_direccion"];
		$this->direccion->AdvancedSearch->SearchValue2 = @$filter["y_direccion"];
		$this->direccion->AdvancedSearch->SearchOperator2 = @$filter["w_direccion"];
		$this->direccion->AdvancedSearch->Save();

		// Field cargo
		$this->cargo->AdvancedSearch->SearchValue = @$filter["x_cargo"];
		$this->cargo->AdvancedSearch->SearchOperator = @$filter["z_cargo"];
		$this->cargo->AdvancedSearch->SearchCondition = @$filter["v_cargo"];
		$this->cargo->AdvancedSearch->SearchValue2 = @$filter["y_cargo"];
		$this->cargo->AdvancedSearch->SearchOperator2 = @$filter["w_cargo"];
		$this->cargo->AdvancedSearch->Save();

		// Field id_institucion
		$this->id_institucion->AdvancedSearch->SearchValue = @$filter["x_id_institucion"];
		$this->id_institucion->AdvancedSearch->SearchOperator = @$filter["z_id_institucion"];
		$this->id_institucion->AdvancedSearch->SearchCondition = @$filter["v_id_institucion"];
		$this->id_institucion->AdvancedSearch->SearchValue2 = @$filter["y_id_institucion"];
		$this->id_institucion->AdvancedSearch->SearchOperator2 = @$filter["w_id_institucion"];
		$this->id_institucion->AdvancedSearch->Save();

		// Field especialidad
		$this->especialidad->AdvancedSearch->SearchValue = @$filter["x_especialidad"];
		$this->especialidad->AdvancedSearch->SearchOperator = @$filter["z_especialidad"];
		$this->especialidad->AdvancedSearch->SearchCondition = @$filter["v_especialidad"];
		$this->especialidad->AdvancedSearch->SearchValue2 = @$filter["y_especialidad"];
		$this->especialidad->AdvancedSearch->SearchOperator2 = @$filter["w_especialidad"];
		$this->especialidad->AdvancedSearch->Save();

		// Field status
		$this->status->AdvancedSearch->SearchValue = @$filter["x_status"];
		$this->status->AdvancedSearch->SearchOperator = @$filter["z_status"];
		$this->status->AdvancedSearch->SearchCondition = @$filter["v_status"];
		$this->status->AdvancedSearch->SearchValue2 = @$filter["y_status"];
		$this->status->AdvancedSearch->SearchOperator2 = @$filter["w_status"];
		$this->status->AdvancedSearch->Save();

		// Field color
		$this->color->AdvancedSearch->SearchValue = @$filter["x_color"];
		$this->color->AdvancedSearch->SearchOperator = @$filter["z_color"];
		$this->color->AdvancedSearch->SearchCondition = @$filter["v_color"];
		$this->color->AdvancedSearch->SearchValue2 = @$filter["y_color"];
		$this->color->AdvancedSearch->SearchOperator2 = @$filter["w_color"];
		$this->color->AdvancedSearch->Save();
		$this->BasicSearch->setKeyword(@$filter[EW_TABLE_BASIC_SEARCH]);
		$this->BasicSearch->setType(@$filter[EW_TABLE_BASIC_SEARCH_TYPE]);
	}

	// Return basic search SQL
	function BasicSearchSQL($arKeywords, $type) {
		$sWhere = "";
		$this->BuildBasicSearchSQL($sWhere, $this->nombre, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->apellido, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->_login, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->password, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->ci, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->_email, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->telefono_fijo01, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->telefono_fijo02, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->celular, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->celular2, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->direccion, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->cargo, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->especialidad, $arKeywords, $type);
		$this->BuildBasicSearchSQL($sWhere, $this->color, $arKeywords, $type);
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
			$this->UpdateSort($this->nombre); // nombre
			$this->UpdateSort($this->apellido); // apellido
			$this->UpdateSort($this->_login); // login
			$this->UpdateSort($this->ci); // ci
			$this->UpdateSort($this->id_rol); // id_rol
			$this->UpdateSort($this->id_sucursal); // id_sucursal
			$this->UpdateSort($this->_email); // email
			$this->UpdateSort($this->telefono_fijo01); // telefono_fijo01
			$this->UpdateSort($this->telefono_fijo02); // telefono_fijo02
			$this->UpdateSort($this->celular); // celular
			$this->UpdateSort($this->celular2); // celular2
			$this->UpdateSort($this->cargo); // cargo
			$this->UpdateSort($this->id_institucion); // id_institucion
			$this->UpdateSort($this->especialidad); // especialidad
			$this->UpdateSort($this->status); // status
			$this->UpdateSort($this->color); // color
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
				$this->nombre->setSort("");
				$this->apellido->setSort("");
				$this->_login->setSort("");
				$this->ci->setSort("");
				$this->id_rol->setSort("");
				$this->id_sucursal->setSort("");
				$this->_email->setSort("");
				$this->telefono_fijo01->setSort("");
				$this->telefono_fijo02->setSort("");
				$this->celular->setSort("");
				$this->celular2->setSort("");
				$this->cargo->setSort("");
				$this->id_institucion->setSort("");
				$this->especialidad->setSort("");
				$this->status->setSort("");
				$this->color->setSort("");
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

		// "checkbox"
		$oListOpt = &$this->ListOptions->Items["checkbox"];
		$oListOpt->Body = "<input type=\"checkbox\" name=\"key_m[]\" class=\"ewMultiSelect\" value=\"" . ew_HtmlEncode($this->_login->CurrentValue) . "\" onclick=\"ew_ClickMultiCheckbox(event);\">";
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"finspectorlistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"finspectorlistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.finspectorlist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"finspectorlistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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
		$this->nombre->setDbValue($row['nombre']);
		$this->apellido->setDbValue($row['apellido']);
		$this->_login->setDbValue($row['login']);
		$this->password->setDbValue($row['password']);
		$this->ci->setDbValue($row['ci']);
		$this->id_rol->setDbValue($row['id_rol']);
		$this->id_sucursal->setDbValue($row['id_sucursal']);
		$this->_email->setDbValue($row['email']);
		$this->telefono_fijo01->setDbValue($row['telefono_fijo01']);
		$this->telefono_fijo02->setDbValue($row['telefono_fijo02']);
		$this->celular->setDbValue($row['celular']);
		$this->celular2->setDbValue($row['celular2']);
		$this->direccion->setDbValue($row['direccion']);
		$this->cargo->setDbValue($row['cargo']);
		$this->id_institucion->setDbValue($row['id_institucion']);
		$this->especialidad->setDbValue($row['especialidad']);
		$this->status->setDbValue($row['status']);
		$this->color->setDbValue($row['color']);
		$this->avatar->Upload->DbValue = $row['avatar'];
		if (is_array($this->avatar->Upload->DbValue) || is_object($this->avatar->Upload->DbValue)) // Byte array
			$this->avatar->Upload->DbValue = ew_BytesToStr($this->avatar->Upload->DbValue);
	}

	// Return a row with default values
	function NewRow() {
		$row = array();
		$row['nombre'] = NULL;
		$row['apellido'] = NULL;
		$row['login'] = NULL;
		$row['password'] = NULL;
		$row['ci'] = NULL;
		$row['id_rol'] = NULL;
		$row['id_sucursal'] = NULL;
		$row['email'] = NULL;
		$row['telefono_fijo01'] = NULL;
		$row['telefono_fijo02'] = NULL;
		$row['celular'] = NULL;
		$row['celular2'] = NULL;
		$row['direccion'] = NULL;
		$row['cargo'] = NULL;
		$row['id_institucion'] = NULL;
		$row['especialidad'] = NULL;
		$row['status'] = NULL;
		$row['color'] = NULL;
		$row['avatar'] = NULL;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->nombre->DbValue = $row['nombre'];
		$this->apellido->DbValue = $row['apellido'];
		$this->_login->DbValue = $row['login'];
		$this->password->DbValue = $row['password'];
		$this->ci->DbValue = $row['ci'];
		$this->id_rol->DbValue = $row['id_rol'];
		$this->id_sucursal->DbValue = $row['id_sucursal'];
		$this->_email->DbValue = $row['email'];
		$this->telefono_fijo01->DbValue = $row['telefono_fijo01'];
		$this->telefono_fijo02->DbValue = $row['telefono_fijo02'];
		$this->celular->DbValue = $row['celular'];
		$this->celular2->DbValue = $row['celular2'];
		$this->direccion->DbValue = $row['direccion'];
		$this->cargo->DbValue = $row['cargo'];
		$this->id_institucion->DbValue = $row['id_institucion'];
		$this->especialidad->DbValue = $row['especialidad'];
		$this->status->DbValue = $row['status'];
		$this->color->DbValue = $row['color'];
		$this->avatar->Upload->DbValue = $row['avatar'];
	}

	// Load old record
	function LoadOldRecord() {

		// Load key values from Session
		$bValidKey = TRUE;
		if (strval($this->getKey("_login")) <> "")
			$this->_login->CurrentValue = $this->getKey("_login"); // login
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
		// nombre
		// apellido
		// login
		// password
		// ci
		// id_rol
		// id_sucursal
		// email
		// telefono_fijo01
		// telefono_fijo02
		// celular
		// celular2
		// direccion
		// cargo
		// id_institucion
		// especialidad
		// status
		// color
		// avatar

		$this->avatar->CellCssStyle = "white-space: nowrap;";
		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// nombre
		$this->nombre->ViewValue = $this->nombre->CurrentValue;
		$this->nombre->ViewCustomAttributes = "";

		// apellido
		$this->apellido->ViewValue = $this->apellido->CurrentValue;
		$this->apellido->ViewCustomAttributes = "";

		// login
		$this->_login->ViewValue = $this->_login->CurrentValue;
		$this->_login->ViewCustomAttributes = "";

		// ci
		$this->ci->ViewValue = $this->ci->CurrentValue;
		$this->ci->ViewCustomAttributes = "";

		// id_rol
		if (strval($this->id_rol->CurrentValue) <> "") {
			$sFilterWrk = "`userlevelid`" . ew_SearchString("=", $this->id_rol->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `userlevelid`, `userlevelname` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `userlevels`";
		$sWhereWrk = "";
		$this->id_rol->LookupFilters = array("dx1" => '`userlevelname`');
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_rol, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$this->id_rol->ViewValue = $this->id_rol->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_rol->ViewValue = $this->id_rol->CurrentValue;
			}
		} else {
			$this->id_rol->ViewValue = NULL;
		}
		$this->id_rol->ViewCustomAttributes = "";

		// id_sucursal
		if (strval($this->id_sucursal->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_sucursal->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `nombre` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `sucursal`";
		$sWhereWrk = "";
		$this->id_sucursal->LookupFilters = array("dx1" => '`nombre`');
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

		// email
		$this->_email->ViewValue = $this->_email->CurrentValue;
		$this->_email->ViewCustomAttributes = "";

		// telefono_fijo01
		$this->telefono_fijo01->ViewValue = $this->telefono_fijo01->CurrentValue;
		$this->telefono_fijo01->ViewCustomAttributes = "";

		// telefono_fijo02
		$this->telefono_fijo02->ViewValue = $this->telefono_fijo02->CurrentValue;
		$this->telefono_fijo02->ViewCustomAttributes = "";

		// celular
		$this->celular->ViewValue = $this->celular->CurrentValue;
		$this->celular->ViewCustomAttributes = "";

		// celular2
		$this->celular2->ViewValue = $this->celular2->CurrentValue;
		$this->celular2->ViewCustomAttributes = "";

		// cargo
		$this->cargo->ViewValue = $this->cargo->CurrentValue;
		$this->cargo->ViewCustomAttributes = "";

		// id_institucion
		$this->id_institucion->ViewValue = $this->id_institucion->CurrentValue;
		$this->id_institucion->ViewCustomAttributes = "";

		// especialidad
		$this->especialidad->ViewValue = $this->especialidad->CurrentValue;
		$this->especialidad->ViewCustomAttributes = "";

		// status
		$this->status->ViewValue = $this->status->CurrentValue;
		$this->status->ViewCustomAttributes = "";

		// color
		$this->color->ViewValue = $this->color->CurrentValue;
		$this->color->ViewCustomAttributes = "";

			// nombre
			$this->nombre->LinkCustomAttributes = "";
			$this->nombre->HrefValue = "";
			$this->nombre->TooltipValue = "";

			// apellido
			$this->apellido->LinkCustomAttributes = "";
			$this->apellido->HrefValue = "";
			$this->apellido->TooltipValue = "";

			// login
			$this->_login->LinkCustomAttributes = "";
			$this->_login->HrefValue = "";
			$this->_login->TooltipValue = "";

			// ci
			$this->ci->LinkCustomAttributes = "";
			$this->ci->HrefValue = "";
			$this->ci->TooltipValue = "";

			// id_rol
			$this->id_rol->LinkCustomAttributes = "";
			$this->id_rol->HrefValue = "";
			$this->id_rol->TooltipValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";
			$this->id_sucursal->TooltipValue = "";

			// email
			$this->_email->LinkCustomAttributes = "";
			$this->_email->HrefValue = "";
			$this->_email->TooltipValue = "";

			// telefono_fijo01
			$this->telefono_fijo01->LinkCustomAttributes = "";
			$this->telefono_fijo01->HrefValue = "";
			$this->telefono_fijo01->TooltipValue = "";

			// telefono_fijo02
			$this->telefono_fijo02->LinkCustomAttributes = "";
			$this->telefono_fijo02->HrefValue = "";
			$this->telefono_fijo02->TooltipValue = "";

			// celular
			$this->celular->LinkCustomAttributes = "";
			$this->celular->HrefValue = "";
			$this->celular->TooltipValue = "";

			// celular2
			$this->celular2->LinkCustomAttributes = "";
			$this->celular2->HrefValue = "";
			$this->celular2->TooltipValue = "";

			// cargo
			$this->cargo->LinkCustomAttributes = "";
			$this->cargo->HrefValue = "";
			$this->cargo->TooltipValue = "";

			// id_institucion
			$this->id_institucion->LinkCustomAttributes = "";
			$this->id_institucion->HrefValue = "";
			$this->id_institucion->TooltipValue = "";

			// especialidad
			$this->especialidad->LinkCustomAttributes = "";
			$this->especialidad->HrefValue = "";
			$this->especialidad->TooltipValue = "";

			// status
			$this->status->LinkCustomAttributes = "";
			$this->status->HrefValue = "";
			$this->status->TooltipValue = "";

			// color
			$this->color->LinkCustomAttributes = "";
			$this->color->HrefValue = "";
			$this->color->TooltipValue = "";
		}

		// Call Row Rendered event
		if ($this->RowType <> EW_ROWTYPE_AGGREGATEINIT)
			$this->Row_Rendered();
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
if (!isset($inspector_list)) $inspector_list = new cinspector_list();

// Page init
$inspector_list->Page_Init();

// Page main
$inspector_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$inspector_list->Page_Render();
?>
<?php include_once "header.php" ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = finspectorlist = new ew_Form("finspectorlist", "list");
finspectorlist.FormKeyCountName = '<?php echo $inspector_list->FormKeyCountName ?>';

// Form_CustomValidate event
finspectorlist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
finspectorlist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
finspectorlist.Lists["x_id_rol"] = {"LinkField":"x_userlevelid","Ajax":true,"AutoFill":false,"DisplayFields":["x_userlevelname","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"userlevels"};
finspectorlist.Lists["x_id_rol"].Data = "<?php echo $inspector_list->id_rol->LookupFilterQuery(FALSE, "list") ?>";
finspectorlist.Lists["x_id_sucursal"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"sucursal"};
finspectorlist.Lists["x_id_sucursal"].Data = "<?php echo $inspector_list->id_sucursal->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = finspectorlistsrch = new ew_Form("finspectorlistsrch");
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
<?php if ($inspector_list->TotalRecs > 0 && $inspector_list->ExportOptions->Visible()) { ?>
<?php $inspector_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($inspector_list->SearchOptions->Visible()) { ?>
<?php $inspector_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($inspector_list->FilterOptions->Visible()) { ?>
<?php $inspector_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php
	$bSelectLimit = $inspector_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($inspector_list->TotalRecs <= 0)
			$inspector_list->TotalRecs = $inspector->ListRecordCount();
	} else {
		if (!$inspector_list->Recordset && ($inspector_list->Recordset = $inspector_list->LoadRecordset()))
			$inspector_list->TotalRecs = $inspector_list->Recordset->RecordCount();
	}
	$inspector_list->StartRec = 1;
	if ($inspector_list->DisplayRecs <= 0 || ($inspector->Export <> "" && $inspector->ExportAll)) // Display all records
		$inspector_list->DisplayRecs = $inspector_list->TotalRecs;
	if (!($inspector->Export <> "" && $inspector->ExportAll))
		$inspector_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$inspector_list->Recordset = $inspector_list->LoadRecordset($inspector_list->StartRec-1, $inspector_list->DisplayRecs);

	// Set no record found message
	if ($inspector->CurrentAction == "" && $inspector_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$inspector_list->setWarningMessage(ew_DeniedMsg());
		if ($inspector_list->SearchWhere == "0=101")
			$inspector_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$inspector_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$inspector_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($inspector->Export == "" && $inspector->CurrentAction == "") { ?>
<form name="finspectorlistsrch" id="finspectorlistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($inspector_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="finspectorlistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="inspector">
	<div class="ewBasicSearch">
<div id="xsr_1" class="ewRow">
	<div class="ewQuickSearch input-group">
	<input type="text" name="<?php echo EW_TABLE_BASIC_SEARCH ?>" id="<?php echo EW_TABLE_BASIC_SEARCH ?>" class="form-control" value="<?php echo ew_HtmlEncode($inspector_list->BasicSearch->getKeyword()) ?>">
	<input type="hidden" name="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" id="<?php echo EW_TABLE_BASIC_SEARCH_TYPE ?>" value="<?php echo ew_HtmlEncode($inspector_list->BasicSearch->getType()) ?>">
	<div class="input-group-btn">
		<button type="button" data-toggle="dropdown" class="btn btn-default"><span id="searchtype"><?php echo $inspector_list->BasicSearch->getTypeNameShort() ?></span><span class="caret"></span></button>
		<ul class="dropdown-menu pull-right" role="menu">
			<li<?php if ($inspector_list->BasicSearch->getType() == "") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this)"><?php echo $Language->Phrase("QuickSearchAuto") ?></a></li>
			<li<?php if ($inspector_list->BasicSearch->getType() == "=") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'=')"><?php echo $Language->Phrase("QuickSearchExact") ?></a></li>
			<li<?php if ($inspector_list->BasicSearch->getType() == "AND") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'AND')"><?php echo $Language->Phrase("QuickSearchAll") ?></a></li>
			<li<?php if ($inspector_list->BasicSearch->getType() == "OR") echo " class=\"active\""; ?>><a href="javascript:void(0);" onclick="ew_SetSearchType(this,'OR')"><?php echo $Language->Phrase("QuickSearchAny") ?></a></li>
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
<?php $inspector_list->ShowPageHeader(); ?>
<?php
$inspector_list->ShowMessage();
?>
<?php if ($inspector_list->TotalRecs > 0 || $inspector->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($inspector_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> inspector">
<form name="finspectorlist" id="finspectorlist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($inspector_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $inspector_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="inspector">
<div id="gmp_inspector" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($inspector_list->TotalRecs > 0 || $inspector->CurrentAction == "gridedit") { ?>
<table id="tbl_inspectorlist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$inspector_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$inspector_list->RenderListOptions();

// Render list options (header, left)
$inspector_list->ListOptions->Render("header", "left");
?>
<?php if ($inspector->nombre->Visible) { // nombre ?>
	<?php if ($inspector->SortUrl($inspector->nombre) == "") { ?>
		<th data-name="nombre" class="<?php echo $inspector->nombre->HeaderCellClass() ?>"><div id="elh_inspector_nombre" class="inspector_nombre"><div class="ewTableHeaderCaption"><?php echo $inspector->nombre->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="nombre" class="<?php echo $inspector->nombre->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->nombre) ?>',1);"><div id="elh_inspector_nombre" class="inspector_nombre">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->nombre->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inspector->nombre->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->nombre->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->apellido->Visible) { // apellido ?>
	<?php if ($inspector->SortUrl($inspector->apellido) == "") { ?>
		<th data-name="apellido" class="<?php echo $inspector->apellido->HeaderCellClass() ?>"><div id="elh_inspector_apellido" class="inspector_apellido"><div class="ewTableHeaderCaption"><?php echo $inspector->apellido->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="apellido" class="<?php echo $inspector->apellido->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->apellido) ?>',1);"><div id="elh_inspector_apellido" class="inspector_apellido">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->apellido->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inspector->apellido->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->apellido->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->_login->Visible) { // login ?>
	<?php if ($inspector->SortUrl($inspector->_login) == "") { ?>
		<th data-name="_login" class="<?php echo $inspector->_login->HeaderCellClass() ?>"><div id="elh_inspector__login" class="inspector__login"><div class="ewTableHeaderCaption"><?php echo $inspector->_login->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_login" class="<?php echo $inspector->_login->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->_login) ?>',1);"><div id="elh_inspector__login" class="inspector__login">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->_login->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inspector->_login->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->_login->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->ci->Visible) { // ci ?>
	<?php if ($inspector->SortUrl($inspector->ci) == "") { ?>
		<th data-name="ci" class="<?php echo $inspector->ci->HeaderCellClass() ?>"><div id="elh_inspector_ci" class="inspector_ci"><div class="ewTableHeaderCaption"><?php echo $inspector->ci->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="ci" class="<?php echo $inspector->ci->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->ci) ?>',1);"><div id="elh_inspector_ci" class="inspector_ci">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->ci->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inspector->ci->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->ci->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->id_rol->Visible) { // id_rol ?>
	<?php if ($inspector->SortUrl($inspector->id_rol) == "") { ?>
		<th data-name="id_rol" class="<?php echo $inspector->id_rol->HeaderCellClass() ?>"><div id="elh_inspector_id_rol" class="inspector_id_rol"><div class="ewTableHeaderCaption"><?php echo $inspector->id_rol->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_rol" class="<?php echo $inspector->id_rol->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->id_rol) ?>',1);"><div id="elh_inspector_id_rol" class="inspector_id_rol">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->id_rol->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inspector->id_rol->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->id_rol->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->id_sucursal->Visible) { // id_sucursal ?>
	<?php if ($inspector->SortUrl($inspector->id_sucursal) == "") { ?>
		<th data-name="id_sucursal" class="<?php echo $inspector->id_sucursal->HeaderCellClass() ?>"><div id="elh_inspector_id_sucursal" class="inspector_id_sucursal"><div class="ewTableHeaderCaption"><?php echo $inspector->id_sucursal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_sucursal" class="<?php echo $inspector->id_sucursal->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->id_sucursal) ?>',1);"><div id="elh_inspector_id_sucursal" class="inspector_id_sucursal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->id_sucursal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inspector->id_sucursal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->id_sucursal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->_email->Visible) { // email ?>
	<?php if ($inspector->SortUrl($inspector->_email) == "") { ?>
		<th data-name="_email" class="<?php echo $inspector->_email->HeaderCellClass() ?>"><div id="elh_inspector__email" class="inspector__email"><div class="ewTableHeaderCaption"><?php echo $inspector->_email->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="_email" class="<?php echo $inspector->_email->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->_email) ?>',1);"><div id="elh_inspector__email" class="inspector__email">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->_email->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inspector->_email->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->_email->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->telefono_fijo01->Visible) { // telefono_fijo01 ?>
	<?php if ($inspector->SortUrl($inspector->telefono_fijo01) == "") { ?>
		<th data-name="telefono_fijo01" class="<?php echo $inspector->telefono_fijo01->HeaderCellClass() ?>"><div id="elh_inspector_telefono_fijo01" class="inspector_telefono_fijo01"><div class="ewTableHeaderCaption"><?php echo $inspector->telefono_fijo01->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefono_fijo01" class="<?php echo $inspector->telefono_fijo01->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->telefono_fijo01) ?>',1);"><div id="elh_inspector_telefono_fijo01" class="inspector_telefono_fijo01">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->telefono_fijo01->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inspector->telefono_fijo01->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->telefono_fijo01->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->telefono_fijo02->Visible) { // telefono_fijo02 ?>
	<?php if ($inspector->SortUrl($inspector->telefono_fijo02) == "") { ?>
		<th data-name="telefono_fijo02" class="<?php echo $inspector->telefono_fijo02->HeaderCellClass() ?>"><div id="elh_inspector_telefono_fijo02" class="inspector_telefono_fijo02"><div class="ewTableHeaderCaption"><?php echo $inspector->telefono_fijo02->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="telefono_fijo02" class="<?php echo $inspector->telefono_fijo02->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->telefono_fijo02) ?>',1);"><div id="elh_inspector_telefono_fijo02" class="inspector_telefono_fijo02">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->telefono_fijo02->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inspector->telefono_fijo02->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->telefono_fijo02->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->celular->Visible) { // celular ?>
	<?php if ($inspector->SortUrl($inspector->celular) == "") { ?>
		<th data-name="celular" class="<?php echo $inspector->celular->HeaderCellClass() ?>"><div id="elh_inspector_celular" class="inspector_celular"><div class="ewTableHeaderCaption"><?php echo $inspector->celular->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="celular" class="<?php echo $inspector->celular->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->celular) ?>',1);"><div id="elh_inspector_celular" class="inspector_celular">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->celular->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inspector->celular->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->celular->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->celular2->Visible) { // celular2 ?>
	<?php if ($inspector->SortUrl($inspector->celular2) == "") { ?>
		<th data-name="celular2" class="<?php echo $inspector->celular2->HeaderCellClass() ?>"><div id="elh_inspector_celular2" class="inspector_celular2"><div class="ewTableHeaderCaption"><?php echo $inspector->celular2->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="celular2" class="<?php echo $inspector->celular2->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->celular2) ?>',1);"><div id="elh_inspector_celular2" class="inspector_celular2">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->celular2->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inspector->celular2->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->celular2->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->cargo->Visible) { // cargo ?>
	<?php if ($inspector->SortUrl($inspector->cargo) == "") { ?>
		<th data-name="cargo" class="<?php echo $inspector->cargo->HeaderCellClass() ?>"><div id="elh_inspector_cargo" class="inspector_cargo"><div class="ewTableHeaderCaption"><?php echo $inspector->cargo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cargo" class="<?php echo $inspector->cargo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->cargo) ?>',1);"><div id="elh_inspector_cargo" class="inspector_cargo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->cargo->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inspector->cargo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->cargo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->id_institucion->Visible) { // id_institucion ?>
	<?php if ($inspector->SortUrl($inspector->id_institucion) == "") { ?>
		<th data-name="id_institucion" class="<?php echo $inspector->id_institucion->HeaderCellClass() ?>"><div id="elh_inspector_id_institucion" class="inspector_id_institucion"><div class="ewTableHeaderCaption"><?php echo $inspector->id_institucion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_institucion" class="<?php echo $inspector->id_institucion->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->id_institucion) ?>',1);"><div id="elh_inspector_id_institucion" class="inspector_id_institucion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->id_institucion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inspector->id_institucion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->id_institucion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->especialidad->Visible) { // especialidad ?>
	<?php if ($inspector->SortUrl($inspector->especialidad) == "") { ?>
		<th data-name="especialidad" class="<?php echo $inspector->especialidad->HeaderCellClass() ?>"><div id="elh_inspector_especialidad" class="inspector_especialidad"><div class="ewTableHeaderCaption"><?php echo $inspector->especialidad->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="especialidad" class="<?php echo $inspector->especialidad->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->especialidad) ?>',1);"><div id="elh_inspector_especialidad" class="inspector_especialidad">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->especialidad->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inspector->especialidad->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->especialidad->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->status->Visible) { // status ?>
	<?php if ($inspector->SortUrl($inspector->status) == "") { ?>
		<th data-name="status" class="<?php echo $inspector->status->HeaderCellClass() ?>"><div id="elh_inspector_status" class="inspector_status"><div class="ewTableHeaderCaption"><?php echo $inspector->status->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status" class="<?php echo $inspector->status->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->status) ?>',1);"><div id="elh_inspector_status" class="inspector_status">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->status->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($inspector->status->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->status->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($inspector->color->Visible) { // color ?>
	<?php if ($inspector->SortUrl($inspector->color) == "") { ?>
		<th data-name="color" class="<?php echo $inspector->color->HeaderCellClass() ?>"><div id="elh_inspector_color" class="inspector_color"><div class="ewTableHeaderCaption"><?php echo $inspector->color->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="color" class="<?php echo $inspector->color->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $inspector->SortUrl($inspector->color) ?>',1);"><div id="elh_inspector_color" class="inspector_color">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $inspector->color->FldCaption() ?><?php echo $Language->Phrase("SrchLegend") ?></span><span class="ewTableHeaderSort"><?php if ($inspector->color->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($inspector->color->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$inspector_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($inspector->ExportAll && $inspector->Export <> "") {
	$inspector_list->StopRec = $inspector_list->TotalRecs;
} else {

	// Set the last record to display
	if ($inspector_list->TotalRecs > $inspector_list->StartRec + $inspector_list->DisplayRecs - 1)
		$inspector_list->StopRec = $inspector_list->StartRec + $inspector_list->DisplayRecs - 1;
	else
		$inspector_list->StopRec = $inspector_list->TotalRecs;
}
$inspector_list->RecCnt = $inspector_list->StartRec - 1;
if ($inspector_list->Recordset && !$inspector_list->Recordset->EOF) {
	$inspector_list->Recordset->MoveFirst();
	$bSelectLimit = $inspector_list->UseSelectLimit;
	if (!$bSelectLimit && $inspector_list->StartRec > 1)
		$inspector_list->Recordset->Move($inspector_list->StartRec - 1);
} elseif (!$inspector->AllowAddDeleteRow && $inspector_list->StopRec == 0) {
	$inspector_list->StopRec = $inspector->GridAddRowCount;
}

// Initialize aggregate
$inspector->RowType = EW_ROWTYPE_AGGREGATEINIT;
$inspector->ResetAttrs();
$inspector_list->RenderRow();
while ($inspector_list->RecCnt < $inspector_list->StopRec) {
	$inspector_list->RecCnt++;
	if (intval($inspector_list->RecCnt) >= intval($inspector_list->StartRec)) {
		$inspector_list->RowCnt++;

		// Set up key count
		$inspector_list->KeyCount = $inspector_list->RowIndex;

		// Init row class and style
		$inspector->ResetAttrs();
		$inspector->CssClass = "";
		if ($inspector->CurrentAction == "gridadd") {
		} else {
			$inspector_list->LoadRowValues($inspector_list->Recordset); // Load row values
		}
		$inspector->RowType = EW_ROWTYPE_VIEW; // Render view

		// Set up row id / data-rowindex
		$inspector->RowAttrs = array_merge($inspector->RowAttrs, array('data-rowindex'=>$inspector_list->RowCnt, 'id'=>'r' . $inspector_list->RowCnt . '_inspector', 'data-rowtype'=>$inspector->RowType));

		// Render row
		$inspector_list->RenderRow();

		// Render list options
		$inspector_list->RenderListOptions();
?>
	<tr<?php echo $inspector->RowAttributes() ?>>
<?php

// Render list options (body, left)
$inspector_list->ListOptions->Render("body", "left", $inspector_list->RowCnt);
?>
	<?php if ($inspector->nombre->Visible) { // nombre ?>
		<td data-name="nombre"<?php echo $inspector->nombre->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_nombre" class="inspector_nombre">
<span<?php echo $inspector->nombre->ViewAttributes() ?>>
<?php echo $inspector->nombre->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->apellido->Visible) { // apellido ?>
		<td data-name="apellido"<?php echo $inspector->apellido->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_apellido" class="inspector_apellido">
<span<?php echo $inspector->apellido->ViewAttributes() ?>>
<?php echo $inspector->apellido->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->_login->Visible) { // login ?>
		<td data-name="_login"<?php echo $inspector->_login->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector__login" class="inspector__login">
<span<?php echo $inspector->_login->ViewAttributes() ?>>
<?php echo $inspector->_login->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->ci->Visible) { // ci ?>
		<td data-name="ci"<?php echo $inspector->ci->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_ci" class="inspector_ci">
<span<?php echo $inspector->ci->ViewAttributes() ?>>
<?php echo $inspector->ci->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->id_rol->Visible) { // id_rol ?>
		<td data-name="id_rol"<?php echo $inspector->id_rol->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_id_rol" class="inspector_id_rol">
<span<?php echo $inspector->id_rol->ViewAttributes() ?>>
<?php echo $inspector->id_rol->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->id_sucursal->Visible) { // id_sucursal ?>
		<td data-name="id_sucursal"<?php echo $inspector->id_sucursal->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_id_sucursal" class="inspector_id_sucursal">
<span<?php echo $inspector->id_sucursal->ViewAttributes() ?>>
<?php echo $inspector->id_sucursal->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->_email->Visible) { // email ?>
		<td data-name="_email"<?php echo $inspector->_email->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector__email" class="inspector__email">
<span<?php echo $inspector->_email->ViewAttributes() ?>>
<?php echo $inspector->_email->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->telefono_fijo01->Visible) { // telefono_fijo01 ?>
		<td data-name="telefono_fijo01"<?php echo $inspector->telefono_fijo01->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_telefono_fijo01" class="inspector_telefono_fijo01">
<span<?php echo $inspector->telefono_fijo01->ViewAttributes() ?>>
<?php echo $inspector->telefono_fijo01->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->telefono_fijo02->Visible) { // telefono_fijo02 ?>
		<td data-name="telefono_fijo02"<?php echo $inspector->telefono_fijo02->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_telefono_fijo02" class="inspector_telefono_fijo02">
<span<?php echo $inspector->telefono_fijo02->ViewAttributes() ?>>
<?php echo $inspector->telefono_fijo02->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->celular->Visible) { // celular ?>
		<td data-name="celular"<?php echo $inspector->celular->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_celular" class="inspector_celular">
<span<?php echo $inspector->celular->ViewAttributes() ?>>
<?php echo $inspector->celular->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->celular2->Visible) { // celular2 ?>
		<td data-name="celular2"<?php echo $inspector->celular2->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_celular2" class="inspector_celular2">
<span<?php echo $inspector->celular2->ViewAttributes() ?>>
<?php echo $inspector->celular2->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->cargo->Visible) { // cargo ?>
		<td data-name="cargo"<?php echo $inspector->cargo->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_cargo" class="inspector_cargo">
<span<?php echo $inspector->cargo->ViewAttributes() ?>>
<?php echo $inspector->cargo->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->id_institucion->Visible) { // id_institucion ?>
		<td data-name="id_institucion"<?php echo $inspector->id_institucion->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_id_institucion" class="inspector_id_institucion">
<span<?php echo $inspector->id_institucion->ViewAttributes() ?>>
<?php echo $inspector->id_institucion->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->especialidad->Visible) { // especialidad ?>
		<td data-name="especialidad"<?php echo $inspector->especialidad->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_especialidad" class="inspector_especialidad">
<span<?php echo $inspector->especialidad->ViewAttributes() ?>>
<?php echo $inspector->especialidad->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->status->Visible) { // status ?>
		<td data-name="status"<?php echo $inspector->status->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_status" class="inspector_status">
<span<?php echo $inspector->status->ViewAttributes() ?>>
<?php echo $inspector->status->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
	<?php if ($inspector->color->Visible) { // color ?>
		<td data-name="color"<?php echo $inspector->color->CellAttributes() ?>>
<span id="el<?php echo $inspector_list->RowCnt ?>_inspector_color" class="inspector_color">
<span<?php echo $inspector->color->ViewAttributes() ?>>
<?php echo $inspector->color->ListViewValue() ?></span>
</span>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$inspector_list->ListOptions->Render("body", "right", $inspector_list->RowCnt);
?>
	</tr>
<?php
	}
	if ($inspector->CurrentAction <> "gridadd")
		$inspector_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($inspector->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($inspector_list->Recordset)
	$inspector_list->Recordset->Close();
?>
<div class="box-footer ewGridLowerPanel">
<?php if ($inspector->CurrentAction <> "gridadd" && $inspector->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($inspector_list->Pager)) $inspector_list->Pager = new cNumericPager($inspector_list->StartRec, $inspector_list->DisplayRecs, $inspector_list->TotalRecs, $inspector_list->RecRange, $inspector_list->AutoHidePager) ?>
<?php if ($inspector_list->Pager->RecordCount > 0 && $inspector_list->Pager->Visible) { ?>
<div class="ewPager">
<div class="ewNumericPage"><ul class="pagination">
	<?php if ($inspector_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $inspector_list->PageUrl() ?>start=<?php echo $inspector_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($inspector_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $inspector_list->PageUrl() ?>start=<?php echo $inspector_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($inspector_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $inspector_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($inspector_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $inspector_list->PageUrl() ?>start=<?php echo $inspector_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($inspector_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $inspector_list->PageUrl() ?>start=<?php echo $inspector_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($inspector_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $inspector_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $inspector_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $inspector_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($inspector_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
</div>
<?php } ?>
<?php if ($inspector_list->TotalRecs == 0 && $inspector->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($inspector_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
finspectorlistsrch.FilterList = <?php echo $inspector_list->GetFilterList() ?>;
finspectorlistsrch.Init();
finspectorlist.Init();
</script>
<?php
$inspector_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php include_once "footer.php" ?>
<?php
$inspector_list->Page_Terminate();
?>
