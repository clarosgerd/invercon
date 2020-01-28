<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "viewavaluoscinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "pago_avaluogridcls.php" ?>
<?php include_once "viewdocumentosavaluoscgridcls.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$viewavaluosc_list = NULL; // Initialize page object first

class cviewavaluosc_list extends cviewavaluosc {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewavaluosc';

	// Page object name
	var $PageObjName = 'viewavaluosc_list';

	// Grid form hidden field names
	var $FormName = 'fviewavaluosclist';
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

		// Table object (viewavaluosc)
		if (!isset($GLOBALS["viewavaluosc"]) || get_class($GLOBALS["viewavaluosc"]) == "cviewavaluosc") {
			$GLOBALS["viewavaluosc"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["viewavaluosc"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "viewavaluoscadd.php?" . EW_TABLE_SHOW_DETAIL . "=";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "viewavaluoscdelete.php";
		$this->MultiUpdateUrl = "viewavaluoscupdate.php";

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'viewavaluosc', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fviewavaluosclistsrch";

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
		// Create form object

		$objForm = new cFormObj();

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
		$this->codigoavaluo->SetVisibility();
		$this->id_oficialcredito->SetVisibility();
		$this->id_inspector->SetVisibility();
		$this->id_cliente->SetVisibility();
		$this->estadointerno->SetVisibility();
		$this->estadopago->SetVisibility();
		$this->fecha_avaluo->SetVisibility();
		$this->montoincial->SetVisibility();
		$this->monto_pago->SetVisibility();
		$this->comentario->SetVisibility();
		$this->documento_pago->SetVisibility();

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
				if (in_array("pago_avaluo", $DetailTblVar)) {

					// Process auto fill for detail table 'pago_avaluo'
					if (preg_match('/^fpago_avaluo(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["pago_avaluo_grid"])) $GLOBALS["pago_avaluo_grid"] = new cpago_avaluo_grid;
						$GLOBALS["pago_avaluo_grid"]->Page_Init();
						$this->Page_Terminate();
						exit();
					}
				}
				if (in_array("viewdocumentosavaluosc", $DetailTblVar)) {

					// Process auto fill for detail table 'viewdocumentosavaluosc'
					if (preg_match('/^fviewdocumentosavaluosc(grid|add|addopt|edit|update|search)$/', @$_POST["form"])) {
						if (!isset($GLOBALS["viewdocumentosavaluosc_grid"])) $GLOBALS["viewdocumentosavaluosc_grid"] = new cviewdocumentosavaluosc_grid;
						$GLOBALS["viewdocumentosavaluosc_grid"]->Page_Init();
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
		global $EW_EXPORT, $viewavaluosc;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($viewavaluosc);
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

			// Check QueryString parameters
			if (@$_GET["a"] <> "") {
				$this->CurrentAction = $_GET["a"];

				// Clear inline mode
				if ($this->CurrentAction == "cancel")
					$this->ClearInlineMode();

				// Switch to inline edit mode
				if ($this->CurrentAction == "edit")
					$this->InlineEditMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$this->CurrentAction = $_POST["a_list"]; // Get action

					// Inline Update
					if (($this->CurrentAction == "update" || $this->CurrentAction == "overwrite") && @$_SESSION[EW_SESSION_INLINE_MODE] == "edit")
						$this->InlineUpdate();
				}
			}

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

	// Exit inline mode
	function ClearInlineMode() {
		$this->setKey("id", ""); // Clear inline edit key
		$this->montoincial->FormValue = ""; // Clear form value
		$this->monto_pago->FormValue = ""; // Clear form value
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Inline Edit mode
	function InlineEditMode() {
		global $Security, $Language;
		if (!$Security->CanEdit())
			$this->Page_Terminate("login.php"); // Go to login page
		$bInlineEdit = TRUE;
		if (isset($_GET["id"])) {
			$this->id->setQueryStringValue($_GET["id"]);
		} else {
			$bInlineEdit = FALSE;
		}
		if ($bInlineEdit) {
			if ($this->LoadRow()) {
				$this->setKey("id", $this->id->CurrentValue); // Set up inline edit key
				$_SESSION[EW_SESSION_INLINE_MODE] = "edit"; // Enable inline edit
			}
		}
	}

	// Perform update to Inline Edit record
	function InlineUpdate() {
		global $Language, $objForm, $gsFormError;
		$objForm->Index = 1;
		$this->LoadFormValues(); // Get form values

		// Validate form
		$bInlineUpdate = TRUE;
		if (!$this->ValidateForm()) {
			$bInlineUpdate = FALSE; // Form error, reset action
			$this->setFailureMessage($gsFormError);
		} else {
			$bInlineUpdate = FALSE;
			$rowkey = strval($objForm->GetValue($this->FormKeyName));
			if ($this->SetupKeyValues($rowkey)) { // Set up key values
				if ($this->CheckInlineEditKey()) { // Check key
					$this->SendEmail = TRUE; // Send email on update success
					$bInlineUpdate = $this->EditRow(); // Update record
				} else {
					$bInlineUpdate = FALSE;
				}
			}
		}
		if ($bInlineUpdate) { // Update success
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("UpdateSuccess")); // Set up success message
			$this->ClearInlineMode(); // Clear inline edit mode
		} else {
			if ($this->getFailureMessage() == "")
				$this->setFailureMessage($Language->Phrase("UpdateFailed")); // Set update failed message
			$this->EventCancelled = TRUE; // Cancel event
			$this->CurrentAction = "edit"; // Stay in edit mode
		}
	}

	// Check Inline Edit key
	function CheckInlineEditKey() {

		//CheckInlineEditKey = True
		if (strval($this->getKey("id")) <> strval($this->id->CurrentValue))
			return FALSE;
		return TRUE;
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
			$sSavedFilterList = $UserProfile->GetSearchFilters(CurrentUserName(), "fviewavaluosclistsrch");
		$sFilterList = ew_Concat($sFilterList, $this->id->AdvancedSearch->ToJson(), ","); // Field id
		$sFilterList = ew_Concat($sFilterList, $this->codigoavaluo->AdvancedSearch->ToJson(), ","); // Field codigoavaluo
		$sFilterList = ew_Concat($sFilterList, $this->tipoinmueble->AdvancedSearch->ToJson(), ","); // Field tipoinmueble
		$sFilterList = ew_Concat($sFilterList, $this->id_solicitud->AdvancedSearch->ToJson(), ","); // Field id_solicitud
		$sFilterList = ew_Concat($sFilterList, $this->id_oficialcredito->AdvancedSearch->ToJson(), ","); // Field id_oficialcredito
		$sFilterList = ew_Concat($sFilterList, $this->id_inspector->AdvancedSearch->ToJson(), ","); // Field id_inspector
		$sFilterList = ew_Concat($sFilterList, $this->is_active->AdvancedSearch->ToJson(), ","); // Field is_active
		$sFilterList = ew_Concat($sFilterList, $this->estado->AdvancedSearch->ToJson(), ","); // Field estado
		$sFilterList = ew_Concat($sFilterList, $this->estadointerno->AdvancedSearch->ToJson(), ","); // Field estadointerno
		$sFilterList = ew_Concat($sFilterList, $this->estadopago->AdvancedSearch->ToJson(), ","); // Field estadopago
		$sFilterList = ew_Concat($sFilterList, $this->monto_pago->AdvancedSearch->ToJson(), ","); // Field monto_pago
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
			$UserProfile->SetSearchFilters(CurrentUserName(), "fviewavaluosclistsrch", $filters);

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

		// Field codigoavaluo
		$this->codigoavaluo->AdvancedSearch->SearchValue = @$filter["x_codigoavaluo"];
		$this->codigoavaluo->AdvancedSearch->SearchOperator = @$filter["z_codigoavaluo"];
		$this->codigoavaluo->AdvancedSearch->SearchCondition = @$filter["v_codigoavaluo"];
		$this->codigoavaluo->AdvancedSearch->SearchValue2 = @$filter["y_codigoavaluo"];
		$this->codigoavaluo->AdvancedSearch->SearchOperator2 = @$filter["w_codigoavaluo"];
		$this->codigoavaluo->AdvancedSearch->Save();

		// Field tipoinmueble
		$this->tipoinmueble->AdvancedSearch->SearchValue = @$filter["x_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->SearchOperator = @$filter["z_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->SearchCondition = @$filter["v_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->SearchValue2 = @$filter["y_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->SearchOperator2 = @$filter["w_tipoinmueble"];
		$this->tipoinmueble->AdvancedSearch->Save();

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

		// Field is_active
		$this->is_active->AdvancedSearch->SearchValue = @$filter["x_is_active"];
		$this->is_active->AdvancedSearch->SearchOperator = @$filter["z_is_active"];
		$this->is_active->AdvancedSearch->SearchCondition = @$filter["v_is_active"];
		$this->is_active->AdvancedSearch->SearchValue2 = @$filter["y_is_active"];
		$this->is_active->AdvancedSearch->SearchOperator2 = @$filter["w_is_active"];
		$this->is_active->AdvancedSearch->Save();

		// Field estado
		$this->estado->AdvancedSearch->SearchValue = @$filter["x_estado"];
		$this->estado->AdvancedSearch->SearchOperator = @$filter["z_estado"];
		$this->estado->AdvancedSearch->SearchCondition = @$filter["v_estado"];
		$this->estado->AdvancedSearch->SearchValue2 = @$filter["y_estado"];
		$this->estado->AdvancedSearch->SearchOperator2 = @$filter["w_estado"];
		$this->estado->AdvancedSearch->Save();

		// Field estadointerno
		$this->estadointerno->AdvancedSearch->SearchValue = @$filter["x_estadointerno"];
		$this->estadointerno->AdvancedSearch->SearchOperator = @$filter["z_estadointerno"];
		$this->estadointerno->AdvancedSearch->SearchCondition = @$filter["v_estadointerno"];
		$this->estadointerno->AdvancedSearch->SearchValue2 = @$filter["y_estadointerno"];
		$this->estadointerno->AdvancedSearch->SearchOperator2 = @$filter["w_estadointerno"];
		$this->estadointerno->AdvancedSearch->Save();

		// Field estadopago
		$this->estadopago->AdvancedSearch->SearchValue = @$filter["x_estadopago"];
		$this->estadopago->AdvancedSearch->SearchOperator = @$filter["z_estadopago"];
		$this->estadopago->AdvancedSearch->SearchCondition = @$filter["v_estadopago"];
		$this->estadopago->AdvancedSearch->SearchValue2 = @$filter["y_estadopago"];
		$this->estadopago->AdvancedSearch->SearchOperator2 = @$filter["w_estadopago"];
		$this->estadopago->AdvancedSearch->Save();

		// Field monto_pago
		$this->monto_pago->AdvancedSearch->SearchValue = @$filter["x_monto_pago"];
		$this->monto_pago->AdvancedSearch->SearchOperator = @$filter["z_monto_pago"];
		$this->monto_pago->AdvancedSearch->SearchCondition = @$filter["v_monto_pago"];
		$this->monto_pago->AdvancedSearch->SearchValue2 = @$filter["y_monto_pago"];
		$this->monto_pago->AdvancedSearch->SearchOperator2 = @$filter["w_monto_pago"];
		$this->monto_pago->AdvancedSearch->Save();

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
		$this->BuildSearchSql($sWhere, $this->codigoavaluo, $Default, FALSE); // codigoavaluo
		$this->BuildSearchSql($sWhere, $this->tipoinmueble, $Default, FALSE); // tipoinmueble
		$this->BuildSearchSql($sWhere, $this->id_solicitud, $Default, FALSE); // id_solicitud
		$this->BuildSearchSql($sWhere, $this->id_oficialcredito, $Default, FALSE); // id_oficialcredito
		$this->BuildSearchSql($sWhere, $this->id_inspector, $Default, FALSE); // id_inspector
		$this->BuildSearchSql($sWhere, $this->is_active, $Default, FALSE); // is_active
		$this->BuildSearchSql($sWhere, $this->estado, $Default, FALSE); // estado
		$this->BuildSearchSql($sWhere, $this->estadointerno, $Default, FALSE); // estadointerno
		$this->BuildSearchSql($sWhere, $this->estadopago, $Default, FALSE); // estadopago
		$this->BuildSearchSql($sWhere, $this->monto_pago, $Default, FALSE); // monto_pago
		$this->BuildSearchSql($sWhere, $this->comentario, $Default, FALSE); // comentario

		// Set up search parm
		if (!$Default && $sWhere <> "" && in_array($this->Command, array("", "reset", "resetall"))) {
			$this->Command = "search";
		}
		if (!$Default && $this->Command == "search") {
			$this->id->AdvancedSearch->Save(); // id
			$this->codigoavaluo->AdvancedSearch->Save(); // codigoavaluo
			$this->tipoinmueble->AdvancedSearch->Save(); // tipoinmueble
			$this->id_solicitud->AdvancedSearch->Save(); // id_solicitud
			$this->id_oficialcredito->AdvancedSearch->Save(); // id_oficialcredito
			$this->id_inspector->AdvancedSearch->Save(); // id_inspector
			$this->is_active->AdvancedSearch->Save(); // is_active
			$this->estado->AdvancedSearch->Save(); // estado
			$this->estadointerno->AdvancedSearch->Save(); // estadointerno
			$this->estadopago->AdvancedSearch->Save(); // estadopago
			$this->monto_pago->AdvancedSearch->Save(); // monto_pago
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
		if ($this->codigoavaluo->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->tipoinmueble->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_solicitud->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_oficialcredito->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->id_inspector->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->is_active->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->estado->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->estadointerno->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->estadopago->AdvancedSearch->IssetSession())
			return TRUE;
		if ($this->monto_pago->AdvancedSearch->IssetSession())
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
		$this->codigoavaluo->AdvancedSearch->UnsetSession();
		$this->tipoinmueble->AdvancedSearch->UnsetSession();
		$this->id_solicitud->AdvancedSearch->UnsetSession();
		$this->id_oficialcredito->AdvancedSearch->UnsetSession();
		$this->id_inspector->AdvancedSearch->UnsetSession();
		$this->is_active->AdvancedSearch->UnsetSession();
		$this->estado->AdvancedSearch->UnsetSession();
		$this->estadointerno->AdvancedSearch->UnsetSession();
		$this->estadopago->AdvancedSearch->UnsetSession();
		$this->monto_pago->AdvancedSearch->UnsetSession();
		$this->comentario->AdvancedSearch->UnsetSession();
	}

	// Restore all search parameters
	function RestoreSearchParms() {
		$this->RestoreSearch = TRUE;

		// Restore advanced search values
		$this->id->AdvancedSearch->Load();
		$this->codigoavaluo->AdvancedSearch->Load();
		$this->tipoinmueble->AdvancedSearch->Load();
		$this->id_solicitud->AdvancedSearch->Load();
		$this->id_oficialcredito->AdvancedSearch->Load();
		$this->id_inspector->AdvancedSearch->Load();
		$this->is_active->AdvancedSearch->Load();
		$this->estado->AdvancedSearch->Load();
		$this->estadointerno->AdvancedSearch->Load();
		$this->estadopago->AdvancedSearch->Load();
		$this->monto_pago->AdvancedSearch->Load();
		$this->comentario->AdvancedSearch->Load();
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->codigoavaluo); // codigoavaluo
			$this->UpdateSort($this->id_oficialcredito); // id_oficialcredito
			$this->UpdateSort($this->id_inspector); // id_inspector
			$this->UpdateSort($this->id_cliente); // id_cliente
			$this->UpdateSort($this->estadointerno); // estadointerno
			$this->UpdateSort($this->estadopago); // estadopago
			$this->UpdateSort($this->fecha_avaluo); // fecha_avaluo
			$this->UpdateSort($this->montoincial); // montoincial
			$this->UpdateSort($this->monto_pago); // monto_pago
			$this->UpdateSort($this->comentario); // comentario
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
				$this->setSessionOrderByList($sOrderBy);
				$this->codigoavaluo->setSort("");
				$this->id_oficialcredito->setSort("");
				$this->id_inspector->setSort("");
				$this->id_cliente->setSort("");
				$this->estadointerno->setSort("");
				$this->estadopago->setSort("");
				$this->fecha_avaluo->setSort("");
				$this->montoincial->setSort("");
				$this->monto_pago->setSort("");
				$this->comentario->setSort("");
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

		// "detail_pago_avaluo"
		$item = &$this->ListOptions->Add("detail_pago_avaluo");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'pago_avaluo') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["pago_avaluo_grid"])) $GLOBALS["pago_avaluo_grid"] = new cpago_avaluo_grid;

		// "detail_viewdocumentosavaluosc"
		$item = &$this->ListOptions->Add("detail_viewdocumentosavaluosc");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->AllowList(CurrentProjectID() . 'viewdocumentosavaluosc') && !$this->ShowMultipleDetails;
		$item->OnLeft = TRUE;
		$item->ShowInButtonGroup = FALSE;
		if (!isset($GLOBALS["viewdocumentosavaluosc_grid"])) $GLOBALS["viewdocumentosavaluosc_grid"] = new cviewdocumentosavaluosc_grid;

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
		$pages->Add("pago_avaluo");
		$pages->Add("viewdocumentosavaluosc");
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
		$item->Visible = $Security->CanEdit();
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

		// Set up row action and key
		if (is_numeric($this->RowIndex) && $this->CurrentMode <> "view") {
			$objForm->Index = $this->RowIndex;
			$ActionName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormActionName);
			$OldKeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormOldKeyName);
			$KeyName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormKeyName);
			$BlankRowName = str_replace("k_", "k" . $this->RowIndex . "_", $this->FormBlankRowName);
			if ($this->RowAction <> "")
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $ActionName . "\" id=\"" . $ActionName . "\" value=\"" . $this->RowAction . "\">";
			if ($this->RowAction == "delete") {
				$rowkey = $objForm->GetValue($this->FormKeyName);
				$this->SetupKeyValues($rowkey);
			}
			if ($this->RowAction == "insert" && $this->CurrentAction == "F" && $this->EmptyRow())
				$this->MultiSelectKey .= "<input type=\"hidden\" name=\"" . $BlankRowName . "\" id=\"" . $BlankRowName . "\" value=\"1\">";
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		if ($this->CurrentAction == "edit" && $this->RowType == EW_ROWTYPE_EDIT) { // Inline-Edit
			$this->ListOptions->CustomItem = "edit"; // Show edit column only
			$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
				$oListOpt->Body = "<div" . (($oListOpt->OnLeft) ? " style=\"text-align: right\"" : "") . ">" .
					"<a class=\"ewGridLink ewInlineUpdate\" title=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("UpdateLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . ew_UrlAddHash($this->PageName(), "r" . $this->RowCnt . "_" . $this->TableVar) . "');\">" . $Language->Phrase("UpdateLink") . "</a>&nbsp;" .
					"<a class=\"ewGridLink ewInlineCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("CancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("CancelLink") . "</a>" .
					"<input type=\"hidden\" name=\"a_list\" id=\"a_list\" value=\"update\"></div>";
			$oListOpt->Body .= "<input type=\"hidden\" name=\"k" . $this->RowIndex . "_key\" id=\"k" . $this->RowIndex . "_key\" value=\"" . ew_HtmlEncode($this->id->CurrentValue) . "\">";
			return;
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
			$oListOpt->Body .= "<a class=\"ewRowLink ewInlineEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("InlineEditLink")) . "\" href=\"" . ew_HtmlEncode(ew_UrlAddHash($this->InlineEditUrl, "r" . $this->RowCnt . "_" . $this->TableVar)) . "\">" . $Language->Phrase("InlineEditLink") . "</a>";
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

		// "detail_pago_avaluo"
		$oListOpt = &$this->ListOptions->Items["detail_pago_avaluo"];
		if ($Security->AllowList(CurrentProjectID() . 'pago_avaluo')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("pago_avaluo", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("pago_avaluolist.php?" . EW_TABLE_SHOW_MASTER . "=viewavaluosc&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["pago_avaluo_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 'pago_avaluo')) {
				$caption = $Language->Phrase("MasterDetailEditLink");
				$url = $this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=pago_avaluo");
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . ew_HtmlImageAndText($caption) . "</a></li>";
				if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
				$DetailEditTblVar .= "pago_avaluo";
			}
			if ($links <> "") {
				$body .= "<button class=\"dropdown-toggle btn btn-default btn-sm ewDetail\" data-toggle=\"dropdown\"><b class=\"caret\"></b></button>";
				$body .= "<ul class=\"dropdown-menu\">". $links . "</ul>";
			}
			$body = "<div class=\"btn-group\">" . $body . "</div>";
			$oListOpt->Body = $body;
			if ($this->ShowMultipleDetails) $oListOpt->Visible = FALSE;
		}

		// "detail_viewdocumentosavaluosc"
		$oListOpt = &$this->ListOptions->Items["detail_viewdocumentosavaluosc"];
		if ($Security->AllowList(CurrentProjectID() . 'viewdocumentosavaluosc')) {
			$body = $Language->Phrase("DetailLink") . $Language->TablePhrase("viewdocumentosavaluosc", "TblCaption");
			$body = "<a class=\"btn btn-default btn-sm ewRowLink ewDetail\" data-action=\"list\" href=\"" . ew_HtmlEncode("viewdocumentosavaluosclist.php?" . EW_TABLE_SHOW_MASTER . "=viewavaluosc&fk_id=" . urlencode(strval($this->id->CurrentValue)) . "") . "\">" . $body . "</a>";
			$links = "";
			if ($GLOBALS["viewdocumentosavaluosc_grid"]->DetailEdit && $Security->CanEdit() && $Security->AllowEdit(CurrentProjectID() . 'viewdocumentosavaluosc')) {
				$caption = $Language->Phrase("MasterDetailEditLink");
				$url = $this->GetEditUrl(EW_TABLE_SHOW_DETAIL . "=viewdocumentosavaluosc");
				$links .= "<li><a class=\"ewRowLink ewDetailEdit\" data-action=\"edit\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . ew_HtmlImageAndText($caption) . "</a></li>";
				if ($DetailEditTblVar <> "") $DetailEditTblVar .= ",";
				$DetailEditTblVar .= "viewdocumentosavaluosc";
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
		if (ew_IsMobile())
			$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-table=\"viewavaluosc\" data-caption=\"" . $addcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,btn:'AddBtn',url:'" . ew_HtmlEncode($this->AddUrl) . "'});\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());
		$option = $options["detail"];
		$DetailTableLink = "";
		$item = &$option->Add("detailadd_pago_avaluo");
		$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=pago_avaluo");
		$caption = $Language->Phrase("Add") . "&nbsp;" . $this->TableCaption() . "/" . $GLOBALS["pago_avaluo"]->TableCaption();
		$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["pago_avaluo"]->DetailAdd && $Security->AllowAdd(CurrentProjectID() . 'pago_avaluo') && $Security->CanAdd());
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "pago_avaluo";
		}
		$item = &$option->Add("detailadd_viewdocumentosavaluosc");
		$url = $this->GetAddUrl(EW_TABLE_SHOW_DETAIL . "=viewdocumentosavaluosc");
		$caption = $Language->Phrase("Add") . "&nbsp;" . $this->TableCaption() . "/" . $GLOBALS["viewdocumentosavaluosc"]->TableCaption();
		$item->Body = "<a class=\"ewDetailAddGroup ewDetailAdd\" title=\"" . ew_HtmlTitle($caption) . "\" data-caption=\"" . ew_HtmlTitle($caption) . "\" href=\"" . ew_HtmlEncode($url) . "\">" . $caption . "</a>";
		$item->Visible = ($GLOBALS["viewdocumentosavaluosc"]->DetailAdd && $Security->AllowAdd(CurrentProjectID() . 'viewdocumentosavaluosc') && $Security->CanAdd());
		if ($item->Visible) {
			if ($DetailTableLink <> "") $DetailTableLink .= ",";
			$DetailTableLink .= "viewdocumentosavaluosc";
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

		// Add multi update
		$item = &$option->Add("multiupdate");
		$item->Body = "<a class=\"ewAction ewMultiUpdate\" title=\"" . ew_HtmlTitle($Language->Phrase("UpdateSelectedLink")) . "\" data-table=\"viewavaluosc\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("UpdateSelectedLink")) . "\" href=\"\" onclick=\"ew_ModalDialogShow({lnk:this,btn:'UpdateBtn',f:document.fviewavaluosclist,url:'" . $this->MultiUpdateUrl . "'});return false;\">" . $Language->Phrase("UpdateSelectedLink") . "</a>";
		$item->Visible = ($Security->CanEdit());

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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fviewavaluosclistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = TRUE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fviewavaluosclistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fviewavaluosclist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$item->Body = "<button type=\"button\" class=\"btn btn-default ewSearchToggle" . $SearchToggleClass . "\" title=\"" . $Language->Phrase("SearchPanel") . "\" data-caption=\"" . $Language->Phrase("SearchPanel") . "\" data-toggle=\"button\" data-form=\"fviewavaluosclistsrch\">" . $Language->Phrase("SearchLink") . "</button>";
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

	// Get upload files
	function GetUploadFiles() {
		global $objForm, $Language;

		// Get upload data
		$this->documento_pago->Upload->Index = $objForm->Index;
		$this->documento_pago->Upload->UploadFile();
	}

	// Load default values
	function LoadDefaultValues() {
		$this->id->CurrentValue = NULL;
		$this->id->OldValue = $this->id->CurrentValue;
		$this->codigoavaluo->CurrentValue = NULL;
		$this->codigoavaluo->OldValue = $this->codigoavaluo->CurrentValue;
		$this->tipoinmueble->CurrentValue = NULL;
		$this->tipoinmueble->OldValue = $this->tipoinmueble->CurrentValue;
		$this->id_solicitud->CurrentValue = NULL;
		$this->id_solicitud->OldValue = $this->id_solicitud->CurrentValue;
		$this->id_oficialcredito->CurrentValue = NULL;
		$this->id_oficialcredito->OldValue = $this->id_oficialcredito->CurrentValue;
		$this->id_inspector->CurrentValue = NULL;
		$this->id_inspector->OldValue = $this->id_inspector->CurrentValue;
		$this->id_cliente->CurrentValue = NULL;
		$this->id_cliente->OldValue = $this->id_cliente->CurrentValue;
		$this->is_active->CurrentValue = 1;
		$this->estado->CurrentValue = 1;
		$this->estadointerno->CurrentValue = 1;
		$this->estadopago->CurrentValue = 0;
		$this->fecha_avaluo->CurrentValue = NULL;
		$this->fecha_avaluo->OldValue = $this->fecha_avaluo->CurrentValue;
		$this->montoincial->CurrentValue = NULL;
		$this->montoincial->OldValue = $this->montoincial->CurrentValue;
		$this->id_metodopago->CurrentValue = NULL;
		$this->id_metodopago->OldValue = $this->id_metodopago->CurrentValue;
		$this->created_at->CurrentValue = NULL;
		$this->created_at->OldValue = $this->created_at->CurrentValue;
		$this->DateModified->CurrentValue = NULL;
		$this->DateModified->OldValue = $this->DateModified->CurrentValue;
		$this->DateDeleted->CurrentValue = NULL;
		$this->DateDeleted->OldValue = $this->DateDeleted->CurrentValue;
		$this->CreatedBy->CurrentValue = NULL;
		$this->CreatedBy->OldValue = $this->CreatedBy->CurrentValue;
		$this->ModifiedBy->CurrentValue = NULL;
		$this->ModifiedBy->OldValue = $this->ModifiedBy->CurrentValue;
		$this->DeletedBy->CurrentValue = NULL;
		$this->DeletedBy->OldValue = $this->DeletedBy->CurrentValue;
		$this->monto_pago->CurrentValue = NULL;
		$this->monto_pago->OldValue = $this->monto_pago->CurrentValue;
		$this->comentario->CurrentValue = NULL;
		$this->comentario->OldValue = $this->comentario->CurrentValue;
		$this->documento_pago->Upload->DbValue = NULL;
		$this->documento_pago->OldValue = $this->documento_pago->Upload->DbValue;
	}

	// Load search values for validation
	function LoadSearchValues() {
		global $objForm;

		// Load search values
		// id

		$this->id->AdvancedSearch->SearchValue = @$_GET["x_id"];
		if ($this->id->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->id->AdvancedSearch->SearchOperator = @$_GET["z_id"];

		// codigoavaluo
		$this->codigoavaluo->AdvancedSearch->SearchValue = @$_GET["x_codigoavaluo"];
		if ($this->codigoavaluo->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->codigoavaluo->AdvancedSearch->SearchOperator = @$_GET["z_codigoavaluo"];

		// tipoinmueble
		$this->tipoinmueble->AdvancedSearch->SearchValue = @$_GET["x_tipoinmueble"];
		if ($this->tipoinmueble->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->tipoinmueble->AdvancedSearch->SearchOperator = @$_GET["z_tipoinmueble"];

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

		// is_active
		$this->is_active->AdvancedSearch->SearchValue = @$_GET["x_is_active"];
		if ($this->is_active->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->is_active->AdvancedSearch->SearchOperator = @$_GET["z_is_active"];

		// estado
		$this->estado->AdvancedSearch->SearchValue = @$_GET["x_estado"];
		if ($this->estado->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->estado->AdvancedSearch->SearchOperator = @$_GET["z_estado"];

		// estadointerno
		$this->estadointerno->AdvancedSearch->SearchValue = @$_GET["x_estadointerno"];
		if ($this->estadointerno->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->estadointerno->AdvancedSearch->SearchOperator = @$_GET["z_estadointerno"];

		// estadopago
		$this->estadopago->AdvancedSearch->SearchValue = @$_GET["x_estadopago"];
		if ($this->estadopago->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->estadopago->AdvancedSearch->SearchOperator = @$_GET["z_estadopago"];

		// monto_pago
		$this->monto_pago->AdvancedSearch->SearchValue = @$_GET["x_monto_pago"];
		if ($this->monto_pago->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->monto_pago->AdvancedSearch->SearchOperator = @$_GET["z_monto_pago"];

		// comentario
		$this->comentario->AdvancedSearch->SearchValue = @$_GET["x_comentario"];
		if ($this->comentario->AdvancedSearch->SearchValue <> "" && $this->Command == "") $this->Command = "search";
		$this->comentario->AdvancedSearch->SearchOperator = @$_GET["z_comentario"];
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		$this->GetUploadFiles(); // Get upload files
		if (!$this->codigoavaluo->FldIsDetailKey) {
			$this->codigoavaluo->setFormValue($objForm->GetValue("x_codigoavaluo"));
		}
		if (!$this->id_oficialcredito->FldIsDetailKey) {
			$this->id_oficialcredito->setFormValue($objForm->GetValue("x_id_oficialcredito"));
		}
		if (!$this->id_inspector->FldIsDetailKey) {
			$this->id_inspector->setFormValue($objForm->GetValue("x_id_inspector"));
		}
		if (!$this->id_cliente->FldIsDetailKey) {
			$this->id_cliente->setFormValue($objForm->GetValue("x_id_cliente"));
		}
		if (!$this->estadointerno->FldIsDetailKey) {
			$this->estadointerno->setFormValue($objForm->GetValue("x_estadointerno"));
		}
		if (!$this->estadopago->FldIsDetailKey) {
			$this->estadopago->setFormValue($objForm->GetValue("x_estadopago"));
		}
		if (!$this->fecha_avaluo->FldIsDetailKey) {
			$this->fecha_avaluo->setFormValue($objForm->GetValue("x_fecha_avaluo"));
			$this->fecha_avaluo->CurrentValue = ew_UnFormatDateTime($this->fecha_avaluo->CurrentValue, 10);
		}
		if (!$this->montoincial->FldIsDetailKey) {
			$this->montoincial->setFormValue($objForm->GetValue("x_montoincial"));
		}
		if (!$this->monto_pago->FldIsDetailKey) {
			$this->monto_pago->setFormValue($objForm->GetValue("x_monto_pago"));
		}
		if (!$this->comentario->FldIsDetailKey) {
			$this->comentario->setFormValue($objForm->GetValue("x_comentario"));
		}
		if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->CurrentValue = $this->id->FormValue;
		$this->codigoavaluo->CurrentValue = $this->codigoavaluo->FormValue;
		$this->id_oficialcredito->CurrentValue = $this->id_oficialcredito->FormValue;
		$this->id_inspector->CurrentValue = $this->id_inspector->FormValue;
		$this->id_cliente->CurrentValue = $this->id_cliente->FormValue;
		$this->estadointerno->CurrentValue = $this->estadointerno->FormValue;
		$this->estadopago->CurrentValue = $this->estadopago->FormValue;
		$this->fecha_avaluo->CurrentValue = $this->fecha_avaluo->FormValue;
		$this->fecha_avaluo->CurrentValue = ew_UnFormatDateTime($this->fecha_avaluo->CurrentValue, 10);
		$this->montoincial->CurrentValue = $this->montoincial->FormValue;
		$this->monto_pago->CurrentValue = $this->monto_pago->FormValue;
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
		$this->codigoavaluo->setDbValue($row['codigoavaluo']);
		$this->tipoinmueble->setDbValue($row['tipoinmueble']);
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
		$this->montoincial->setDbValue($row['montoincial']);
		$this->id_metodopago->setDbValue($row['id_metodopago']);
		$this->created_at->setDbValue($row['created_at']);
		$this->DateModified->setDbValue($row['DateModified']);
		$this->DateDeleted->setDbValue($row['DateDeleted']);
		$this->CreatedBy->setDbValue($row['CreatedBy']);
		$this->ModifiedBy->setDbValue($row['ModifiedBy']);
		$this->DeletedBy->setDbValue($row['DeletedBy']);
		$this->monto_pago->setDbValue($row['monto_pago']);
		$this->comentario->setDbValue($row['comentario']);
		$this->documento_pago->Upload->DbValue = $row['documento_pago'];
		if (is_array($this->documento_pago->Upload->DbValue) || is_object($this->documento_pago->Upload->DbValue)) // Byte array
			$this->documento_pago->Upload->DbValue = ew_BytesToStr($this->documento_pago->Upload->DbValue);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['id'] = $this->id->CurrentValue;
		$row['codigoavaluo'] = $this->codigoavaluo->CurrentValue;
		$row['tipoinmueble'] = $this->tipoinmueble->CurrentValue;
		$row['id_solicitud'] = $this->id_solicitud->CurrentValue;
		$row['id_oficialcredito'] = $this->id_oficialcredito->CurrentValue;
		$row['id_inspector'] = $this->id_inspector->CurrentValue;
		$row['id_cliente'] = $this->id_cliente->CurrentValue;
		$row['is_active'] = $this->is_active->CurrentValue;
		$row['estado'] = $this->estado->CurrentValue;
		$row['estadointerno'] = $this->estadointerno->CurrentValue;
		$row['estadopago'] = $this->estadopago->CurrentValue;
		$row['fecha_avaluo'] = $this->fecha_avaluo->CurrentValue;
		$row['montoincial'] = $this->montoincial->CurrentValue;
		$row['id_metodopago'] = $this->id_metodopago->CurrentValue;
		$row['created_at'] = $this->created_at->CurrentValue;
		$row['DateModified'] = $this->DateModified->CurrentValue;
		$row['DateDeleted'] = $this->DateDeleted->CurrentValue;
		$row['CreatedBy'] = $this->CreatedBy->CurrentValue;
		$row['ModifiedBy'] = $this->ModifiedBy->CurrentValue;
		$row['DeletedBy'] = $this->DeletedBy->CurrentValue;
		$row['monto_pago'] = $this->monto_pago->CurrentValue;
		$row['comentario'] = $this->comentario->CurrentValue;
		$row['documento_pago'] = $this->documento_pago->Upload->DbValue;
		return $row;
	}

	// Load DbValue from recordset
	function LoadDbValues(&$rs) {
		if (!$rs || !is_array($rs) && $rs->EOF)
			return;
		$row = is_array($rs) ? $rs : $rs->fields;
		$this->id->DbValue = $row['id'];
		$this->codigoavaluo->DbValue = $row['codigoavaluo'];
		$this->tipoinmueble->DbValue = $row['tipoinmueble'];
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
		$this->monto_pago->DbValue = $row['monto_pago'];
		$this->comentario->DbValue = $row['comentario'];
		$this->documento_pago->Upload->DbValue = $row['documento_pago'];
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

		// Convert decimal values if posted back
		if ($this->montoincial->FormValue == $this->montoincial->CurrentValue && is_numeric(ew_StrToFloat($this->montoincial->CurrentValue)))
			$this->montoincial->CurrentValue = ew_StrToFloat($this->montoincial->CurrentValue);

		// Convert decimal values if posted back
		if ($this->monto_pago->FormValue == $this->monto_pago->CurrentValue && is_numeric(ew_StrToFloat($this->monto_pago->CurrentValue)))
			$this->monto_pago->CurrentValue = ew_StrToFloat($this->monto_pago->CurrentValue);

		// Call Row_Rendering event
		$this->Row_Rendering();

		// Common render codes for all row types
		// id

		$this->id->CellCssStyle = "white-space: nowrap;";

		// codigoavaluo
		// tipoinmueble

		$this->tipoinmueble->CellCssStyle = "white-space: nowrap;";

		// id_solicitud
		// id_oficialcredito
		// id_inspector
		// id_cliente

		$this->id_cliente->CellCssStyle = "white-space: nowrap;";

		// is_active
		// estado
		// estadointerno
		// estadopago
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

		// monto_pago
		// comentario
		// documento_pago

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// codigoavaluo
		$this->codigoavaluo->ViewValue = $this->codigoavaluo->CurrentValue;
		$this->codigoavaluo->ViewCustomAttributes = "";

		// id_solicitud
		$this->id_solicitud->ViewValue = $this->id_solicitud->CurrentValue;
		if (strval($this->id_solicitud->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array("dx1" => '`id`', "dx2" => '`name`', "dx3" => '`lastname`', "dx4" => '`email`');
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array("dx1" => '`id`', "dx2" => '`name`', "dx3" => '`lastname`', "dx4" => '`email`');
				break;
			default:
				$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
				$sWhereWrk = "";
				$this->id_solicitud->LookupFilters = array("dx1" => '`id`', "dx2" => '`name`', "dx3" => '`lastname`', "dx4" => '`email`');
				break;
		}
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
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
				$sWhereWrk = "";
				$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
				break;
			case "es":
				$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
				$sWhereWrk = "";
				$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
				break;
			default:
				$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
				$sWhereWrk = "";
				$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
				break;
		}
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
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
				$sWhereWrk = "";
				$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
				break;
			case "es":
				$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
				$sWhereWrk = "";
				$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
				break;
			default:
				$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
				$sWhereWrk = "";
				$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
				break;
		}
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

		// id_cliente
		if (strval($this->id_cliente->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_cliente->CurrentValue, EW_DATATYPE_NUMBER, "");
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
				$sWhereWrk = "";
				$this->id_cliente->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
				$sWhereWrk = "";
				$this->id_cliente->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
				$sWhereWrk = "";
				$this->id_cliente->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->id_cliente, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
				$arwrk[2] = $rswrk->fields('Disp2Fld');
				$this->id_cliente->ViewValue = $this->id_cliente->DisplayValue($arwrk);
				$rswrk->Close();
			} else {
				$this->id_cliente->ViewValue = $this->id_cliente->CurrentValue;
			}
		} else {
			$this->id_cliente->ViewValue = NULL;
		}
		$this->id_cliente->ViewCustomAttributes = "";

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
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
				$sWhereWrk = "";
				$this->estado->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
				$sWhereWrk = "";
				$this->estado->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
				$sWhereWrk = "";
				$this->estado->LookupFilters = array();
				break;
		}
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
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->estadointerno->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->estadointerno->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
				$sWhereWrk = "";
				$this->estadointerno->LookupFilters = array();
				break;
		}
		ew_AddFilter($sWhereWrk, $sFilterWrk);
		$this->Lookup_Selecting($this->estadointerno, $sWhereWrk); // Call Lookup Selecting
		if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			if ($rswrk && !$rswrk->EOF) { // Lookup values found
				$arwrk = array();
				$arwrk[1] = $rswrk->fields('DispFld');
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
		switch (@$gsLanguage) {
			case "en":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
				$sWhereWrk = "";
				$this->estadopago->LookupFilters = array();
				break;
			case "es":
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
				$sWhereWrk = "";
				$this->estadopago->LookupFilters = array();
				break;
			default:
				$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
				$sWhereWrk = "";
				$this->estadopago->LookupFilters = array();
				break;
		}
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

		// montoincial
		$this->montoincial->ViewValue = $this->montoincial->CurrentValue;
		$this->montoincial->ViewValue = ew_FormatNumber($this->montoincial->ViewValue, 0, -2, -2, -2);
		$this->montoincial->ViewCustomAttributes = "";

		// monto_pago
		$this->monto_pago->ViewValue = $this->monto_pago->CurrentValue;
		$this->monto_pago->ViewCustomAttributes = "";

		// comentario
		$this->comentario->ViewValue = $this->comentario->CurrentValue;
		$this->comentario->ViewCustomAttributes = "";

		// documento_pago
		if (!ew_Empty($this->documento_pago->Upload->DbValue)) {
			$this->documento_pago->ViewValue = "viewavaluosc_documento_pago_bv.php?" . "id=" . $this->id->CurrentValue;
			$this->documento_pago->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->documento_pago->Upload->DbValue, 0, 11)));
		} else {
			$this->documento_pago->ViewValue = "";
		}
		$this->documento_pago->ViewCustomAttributes = "";

			// codigoavaluo
			$this->codigoavaluo->LinkCustomAttributes = "";
			$this->codigoavaluo->HrefValue = "";
			$this->codigoavaluo->TooltipValue = "";

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

			// estadointerno
			$this->estadointerno->LinkCustomAttributes = "";
			$this->estadointerno->HrefValue = "";
			$this->estadointerno->TooltipValue = "";

			// estadopago
			$this->estadopago->LinkCustomAttributes = "";
			$this->estadopago->HrefValue = "";
			$this->estadopago->TooltipValue = "";

			// fecha_avaluo
			$this->fecha_avaluo->LinkCustomAttributes = "";
			$this->fecha_avaluo->HrefValue = "";
			$this->fecha_avaluo->TooltipValue = "";

			// montoincial
			$this->montoincial->LinkCustomAttributes = "";
			$this->montoincial->HrefValue = "";
			$this->montoincial->TooltipValue = "";

			// monto_pago
			$this->monto_pago->LinkCustomAttributes = "";
			$this->monto_pago->HrefValue = "";
			$this->monto_pago->TooltipValue = "";

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";
			$this->comentario->TooltipValue = "";

			// documento_pago
			$this->documento_pago->LinkCustomAttributes = "";
			if (!empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->HrefValue = "viewavaluosc_documento_pago_bv.php?id=" . $this->id->CurrentValue;
				$this->documento_pago->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->documento_pago->HrefValue = ew_FullUrl($this->documento_pago->HrefValue, "href");
			} else {
				$this->documento_pago->HrefValue = "";
			}
			$this->documento_pago->HrefValue2 = "viewavaluosc_documento_pago_bv.php?id=" . $this->id->CurrentValue;
			$this->documento_pago->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// codigoavaluo
			$this->codigoavaluo->EditAttrs["class"] = "form-control";
			$this->codigoavaluo->EditCustomAttributes = "";
			$this->codigoavaluo->EditValue = ew_HtmlEncode($this->codigoavaluo->CurrentValue);
			$this->codigoavaluo->PlaceHolder = ew_RemoveHtml($this->codigoavaluo->FldTitle());

			// id_oficialcredito
			$this->id_oficialcredito->EditAttrs["class"] = "form-control";
			$this->id_oficialcredito->EditCustomAttributes = "";

			// id_inspector
			$this->id_inspector->EditAttrs["class"] = "form-control";
			$this->id_inspector->EditCustomAttributes = "";

			// id_cliente
			$this->id_cliente->EditAttrs["class"] = "form-control";
			$this->id_cliente->EditCustomAttributes = "";

			// estadointerno
			$this->estadointerno->EditAttrs["class"] = "form-control";
			$this->estadointerno->EditCustomAttributes = "";

			// estadopago
			$this->estadopago->EditAttrs["class"] = "form-control";
			$this->estadopago->EditCustomAttributes = "";

			// fecha_avaluo
			$this->fecha_avaluo->EditAttrs["class"] = "form-control";
			$this->fecha_avaluo->EditCustomAttributes = "";
			$this->fecha_avaluo->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_avaluo->CurrentValue, 10));
			$this->fecha_avaluo->PlaceHolder = ew_RemoveHtml($this->fecha_avaluo->FldTitle());

			// montoincial
			$this->montoincial->EditAttrs["class"] = "form-control";
			$this->montoincial->EditCustomAttributes = "";
			$this->montoincial->EditValue = ew_HtmlEncode($this->montoincial->CurrentValue);
			$this->montoincial->PlaceHolder = ew_RemoveHtml($this->montoincial->FldTitle());
			if (strval($this->montoincial->EditValue) <> "" && is_numeric($this->montoincial->EditValue)) $this->montoincial->EditValue = ew_FormatNumber($this->montoincial->EditValue, -2, -2, -2, -2);

			// monto_pago
			$this->monto_pago->EditAttrs["class"] = "form-control";
			$this->monto_pago->EditCustomAttributes = "";
			$this->monto_pago->EditValue = ew_HtmlEncode($this->monto_pago->CurrentValue);
			$this->monto_pago->PlaceHolder = ew_RemoveHtml($this->monto_pago->FldTitle());
			if (strval($this->monto_pago->EditValue) <> "" && is_numeric($this->monto_pago->EditValue)) $this->monto_pago->EditValue = ew_FormatNumber($this->monto_pago->EditValue, -2, -1, -2, 0);

			// comentario
			$this->comentario->EditAttrs["class"] = "form-control";
			$this->comentario->EditCustomAttributes = "";
			$this->comentario->EditValue = ew_HtmlEncode($this->comentario->CurrentValue);
			$this->comentario->PlaceHolder = ew_RemoveHtml($this->comentario->FldTitle());

			// documento_pago
			$this->documento_pago->EditAttrs["class"] = "form-control";
			$this->documento_pago->EditCustomAttributes = "";
			if (!ew_Empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->EditValue = "viewavaluosc_documento_pago_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->documento_pago->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->documento_pago->Upload->DbValue, 0, 11)));
			} else {
				$this->documento_pago->EditValue = "";
			}
			if (is_numeric($this->RowIndex) && !$this->EventCancelled) ew_RenderUploadField($this->documento_pago, $this->RowIndex);

			// Add refer script
			// codigoavaluo

			$this->codigoavaluo->LinkCustomAttributes = "";
			$this->codigoavaluo->HrefValue = "";

			// id_oficialcredito
			$this->id_oficialcredito->LinkCustomAttributes = "";
			$this->id_oficialcredito->HrefValue = "";

			// id_inspector
			$this->id_inspector->LinkCustomAttributes = "";
			$this->id_inspector->HrefValue = "";

			// id_cliente
			$this->id_cliente->LinkCustomAttributes = "";
			$this->id_cliente->HrefValue = "";

			// estadointerno
			$this->estadointerno->LinkCustomAttributes = "";
			$this->estadointerno->HrefValue = "";

			// estadopago
			$this->estadopago->LinkCustomAttributes = "";
			$this->estadopago->HrefValue = "";

			// fecha_avaluo
			$this->fecha_avaluo->LinkCustomAttributes = "";
			$this->fecha_avaluo->HrefValue = "";

			// montoincial
			$this->montoincial->LinkCustomAttributes = "";
			$this->montoincial->HrefValue = "";

			// monto_pago
			$this->monto_pago->LinkCustomAttributes = "";
			$this->monto_pago->HrefValue = "";

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";

			// documento_pago
			$this->documento_pago->LinkCustomAttributes = "";
			if (!empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->HrefValue = "viewavaluosc_documento_pago_bv.php?id=" . $this->id->CurrentValue;
				$this->documento_pago->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->documento_pago->HrefValue = ew_FullUrl($this->documento_pago->HrefValue, "href");
			} else {
				$this->documento_pago->HrefValue = "";
			}
			$this->documento_pago->HrefValue2 = "viewavaluosc_documento_pago_bv.php?id=" . $this->id->CurrentValue;
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// codigoavaluo
			$this->codigoavaluo->EditAttrs["class"] = "form-control";
			$this->codigoavaluo->EditCustomAttributes = "";
			$this->codigoavaluo->EditValue = $this->codigoavaluo->CurrentValue;
			$this->codigoavaluo->ViewCustomAttributes = "";

			// id_oficialcredito
			$this->id_oficialcredito->EditAttrs["class"] = "form-control";
			$this->id_oficialcredito->EditCustomAttributes = "";
			if ($this->id_oficialcredito->VirtualValue <> "") {
				$this->id_oficialcredito->EditValue = $this->id_oficialcredito->VirtualValue;
			} else {
			if (strval($this->id_oficialcredito->CurrentValue) <> "") {
				$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_oficialcredito->CurrentValue, EW_DATATYPE_STRING, "");
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
					$sWhereWrk = "";
					$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
					break;
				case "es":
					$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
					$sWhereWrk = "";
					$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
					break;
				default:
					$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
					$sWhereWrk = "";
					$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
					break;
			}
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_oficialcredito, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$arwrk[2] = $rswrk->fields('Disp2Fld');
					$this->id_oficialcredito->EditValue = $this->id_oficialcredito->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_oficialcredito->EditValue = $this->id_oficialcredito->CurrentValue;
				}
			} else {
				$this->id_oficialcredito->EditValue = NULL;
			}
			}
			$this->id_oficialcredito->ViewCustomAttributes = "";

			// id_inspector
			$this->id_inspector->EditAttrs["class"] = "form-control";
			$this->id_inspector->EditCustomAttributes = "";
			if ($this->id_inspector->VirtualValue <> "") {
				$this->id_inspector->EditValue = $this->id_inspector->VirtualValue;
			} else {
			if (strval($this->id_inspector->CurrentValue) <> "") {
				$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_inspector->CurrentValue, EW_DATATYPE_STRING, "");
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
					$sWhereWrk = "";
					$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
					break;
				case "es":
					$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
					$sWhereWrk = "";
					$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
					break;
				default:
					$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
					$sWhereWrk = "";
					$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
					break;
			}
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_inspector, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$arwrk[2] = $rswrk->fields('Disp2Fld');
					$this->id_inspector->EditValue = $this->id_inspector->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_inspector->EditValue = $this->id_inspector->CurrentValue;
				}
			} else {
				$this->id_inspector->EditValue = NULL;
			}
			}
			$this->id_inspector->ViewCustomAttributes = "";

			// id_cliente
			$this->id_cliente->EditAttrs["class"] = "form-control";
			$this->id_cliente->EditCustomAttributes = "";
			if (trim(strval($this->id_cliente->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_cliente->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cliente`";
					$sWhereWrk = "";
					$this->id_cliente->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cliente`";
					$sWhereWrk = "";
					$this->id_cliente->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `cliente`";
					$sWhereWrk = "";
					$this->id_cliente->LookupFilters = array();
					break;
			}
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_cliente, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->id_cliente->EditValue = $arwrk;

			// estadointerno
			$this->estadointerno->EditAttrs["class"] = "form-control";
			$this->estadointerno->EditCustomAttributes = "";
			if (trim(strval($this->estadointerno->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->estadointerno->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadointerno`";
					$sWhereWrk = "";
					$this->estadointerno->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadointerno`";
					$sWhereWrk = "";
					$this->estadointerno->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadointerno`";
					$sWhereWrk = "";
					$this->estadointerno->LookupFilters = array();
					break;
			}
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->estadointerno, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->estadointerno->EditValue = $arwrk;

			// estadopago
			$this->estadopago->EditAttrs["class"] = "form-control";
			$this->estadopago->EditCustomAttributes = "";
			if (trim(strval($this->estadopago->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->estadopago->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			switch (@$gsLanguage) {
				case "en":
					$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadopago`";
					$sWhereWrk = "";
					$this->estadopago->LookupFilters = array();
					break;
				case "es":
					$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadopago`";
					$sWhereWrk = "";
					$this->estadopago->LookupFilters = array();
					break;
				default:
					$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadopago`";
					$sWhereWrk = "";
					$this->estadopago->LookupFilters = array();
					break;
			}
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->estadopago, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			$rswrk = Conn()->Execute($sSqlWrk);
			$arwrk = ($rswrk) ? $rswrk->GetRows() : array();
			if ($rswrk) $rswrk->Close();
			$this->estadopago->EditValue = $arwrk;

			// fecha_avaluo
			$this->fecha_avaluo->EditAttrs["class"] = "form-control";
			$this->fecha_avaluo->EditCustomAttributes = "";
			$this->fecha_avaluo->EditValue = ew_HtmlEncode(ew_FormatDateTime($this->fecha_avaluo->CurrentValue, 10));
			$this->fecha_avaluo->PlaceHolder = ew_RemoveHtml($this->fecha_avaluo->FldTitle());

			// montoincial
			$this->montoincial->EditAttrs["class"] = "form-control";
			$this->montoincial->EditCustomAttributes = "";
			$this->montoincial->EditValue = ew_HtmlEncode($this->montoincial->CurrentValue);
			$this->montoincial->PlaceHolder = ew_RemoveHtml($this->montoincial->FldTitle());
			if (strval($this->montoincial->EditValue) <> "" && is_numeric($this->montoincial->EditValue)) $this->montoincial->EditValue = ew_FormatNumber($this->montoincial->EditValue, -2, -2, -2, -2);

			// monto_pago
			$this->monto_pago->EditAttrs["class"] = "form-control";
			$this->monto_pago->EditCustomAttributes = "";
			$this->monto_pago->EditValue = ew_HtmlEncode($this->monto_pago->CurrentValue);
			$this->monto_pago->PlaceHolder = ew_RemoveHtml($this->monto_pago->FldTitle());
			if (strval($this->monto_pago->EditValue) <> "" && is_numeric($this->monto_pago->EditValue)) $this->monto_pago->EditValue = ew_FormatNumber($this->monto_pago->EditValue, -2, -1, -2, 0);

			// comentario
			$this->comentario->EditAttrs["class"] = "form-control";
			$this->comentario->EditCustomAttributes = "";
			$this->comentario->EditValue = ew_HtmlEncode($this->comentario->CurrentValue);
			$this->comentario->PlaceHolder = ew_RemoveHtml($this->comentario->FldTitle());

			// documento_pago
			$this->documento_pago->EditAttrs["class"] = "form-control";
			$this->documento_pago->EditCustomAttributes = "";
			if (!ew_Empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->EditValue = "viewavaluosc_documento_pago_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->documento_pago->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->documento_pago->Upload->DbValue, 0, 11)));
			} else {
				$this->documento_pago->EditValue = "";
			}
			if (is_numeric($this->RowIndex) && !$this->EventCancelled) ew_RenderUploadField($this->documento_pago, $this->RowIndex);

			// Edit refer script
			// codigoavaluo

			$this->codigoavaluo->LinkCustomAttributes = "";
			$this->codigoavaluo->HrefValue = "";
			$this->codigoavaluo->TooltipValue = "";

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

			// estadointerno
			$this->estadointerno->LinkCustomAttributes = "";
			$this->estadointerno->HrefValue = "";

			// estadopago
			$this->estadopago->LinkCustomAttributes = "";
			$this->estadopago->HrefValue = "";

			// fecha_avaluo
			$this->fecha_avaluo->LinkCustomAttributes = "";
			$this->fecha_avaluo->HrefValue = "";

			// montoincial
			$this->montoincial->LinkCustomAttributes = "";
			$this->montoincial->HrefValue = "";

			// monto_pago
			$this->monto_pago->LinkCustomAttributes = "";
			$this->monto_pago->HrefValue = "";

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";

			// documento_pago
			$this->documento_pago->LinkCustomAttributes = "";
			if (!empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->HrefValue = "viewavaluosc_documento_pago_bv.php?id=" . $this->id->CurrentValue;
				$this->documento_pago->LinkAttrs["target"] = "_blank";
				if ($this->Export <> "") $this->documento_pago->HrefValue = ew_FullUrl($this->documento_pago->HrefValue, "href");
			} else {
				$this->documento_pago->HrefValue = "";
			}
			$this->documento_pago->HrefValue2 = "viewavaluosc_documento_pago_bv.php?id=" . $this->id->CurrentValue;
		} elseif ($this->RowType == EW_ROWTYPE_SEARCH) { // Search row

			// codigoavaluo
			$this->codigoavaluo->EditAttrs["class"] = "form-control";
			$this->codigoavaluo->EditCustomAttributes = "";
			$this->codigoavaluo->EditValue = ew_HtmlEncode($this->codigoavaluo->AdvancedSearch->SearchValue);
			$this->codigoavaluo->PlaceHolder = ew_RemoveHtml($this->codigoavaluo->FldTitle());

			// id_oficialcredito
			$this->id_oficialcredito->EditAttrs["class"] = "form-control";
			$this->id_oficialcredito->EditCustomAttributes = "";
			$this->id_oficialcredito->EditValue = ew_HtmlEncode($this->id_oficialcredito->AdvancedSearch->SearchValue);
			$this->id_oficialcredito->PlaceHolder = ew_RemoveHtml($this->id_oficialcredito->FldTitle());

			// id_inspector
			$this->id_inspector->EditAttrs["class"] = "form-control";
			$this->id_inspector->EditCustomAttributes = "";
			$this->id_inspector->EditValue = ew_HtmlEncode($this->id_inspector->AdvancedSearch->SearchValue);
			$this->id_inspector->PlaceHolder = ew_RemoveHtml($this->id_inspector->FldTitle());

			// id_cliente
			$this->id_cliente->EditAttrs["class"] = "form-control";
			$this->id_cliente->EditCustomAttributes = "";

			// estadointerno
			$this->estadointerno->EditAttrs["class"] = "form-control";
			$this->estadointerno->EditCustomAttributes = "";

			// estadopago
			$this->estadopago->EditAttrs["class"] = "form-control";
			$this->estadopago->EditCustomAttributes = "";

			// fecha_avaluo
			$this->fecha_avaluo->EditAttrs["class"] = "form-control";
			$this->fecha_avaluo->EditCustomAttributes = "";
			$this->fecha_avaluo->EditValue = ew_HtmlEncode(ew_FormatDateTime(ew_UnFormatDateTime($this->fecha_avaluo->AdvancedSearch->SearchValue, 10), 10));
			$this->fecha_avaluo->PlaceHolder = ew_RemoveHtml($this->fecha_avaluo->FldTitle());

			// montoincial
			$this->montoincial->EditAttrs["class"] = "form-control";
			$this->montoincial->EditCustomAttributes = "";
			$this->montoincial->EditValue = ew_HtmlEncode($this->montoincial->AdvancedSearch->SearchValue);
			$this->montoincial->PlaceHolder = ew_RemoveHtml($this->montoincial->FldTitle());

			// monto_pago
			$this->monto_pago->EditAttrs["class"] = "form-control";
			$this->monto_pago->EditCustomAttributes = "";
			$this->monto_pago->EditValue = ew_HtmlEncode($this->monto_pago->AdvancedSearch->SearchValue);
			$this->monto_pago->PlaceHolder = ew_RemoveHtml($this->monto_pago->FldTitle());

			// comentario
			$this->comentario->EditAttrs["class"] = "form-control";
			$this->comentario->EditCustomAttributes = "";
			$this->comentario->EditValue = ew_HtmlEncode($this->comentario->AdvancedSearch->SearchValue);
			$this->comentario->PlaceHolder = ew_RemoveHtml($this->comentario->FldTitle());

			// documento_pago
			$this->documento_pago->EditAttrs["class"] = "form-control";
			$this->documento_pago->EditCustomAttributes = "";
			if (!ew_Empty($this->documento_pago->Upload->DbValue)) {
				$this->documento_pago->EditValue = "viewavaluosc_documento_pago_bv.php?" . "id=" . $this->id->CurrentValue;
				$this->documento_pago->IsBlobImage = ew_IsImageFile(ew_ContentExt(substr($this->documento_pago->Upload->DbValue, 0, 11)));
			} else {
				$this->documento_pago->EditValue = "";
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

	// Validate form
	function ValidateForm() {
		global $Language, $gsFormError;

		// Initialize form error message
		$gsFormError = "";

		// Check if validation required
		if (!EW_SERVER_VALIDATE)
			return ($gsFormError == "");
		if (!$this->fecha_avaluo->FldIsDetailKey && !is_null($this->fecha_avaluo->FormValue) && $this->fecha_avaluo->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->fecha_avaluo->FldCaption(), $this->fecha_avaluo->ReqErrMsg));
		}
		if (!ew_CheckUSDate($this->fecha_avaluo->FormValue)) {
			ew_AddMessage($gsFormError, $this->fecha_avaluo->FldErrMsg());
		}
		if (!ew_CheckNumber($this->montoincial->FormValue)) {
			ew_AddMessage($gsFormError, $this->montoincial->FldErrMsg());
		}
		if (!ew_CheckNumber($this->monto_pago->FormValue)) {
			ew_AddMessage($gsFormError, $this->monto_pago->FldErrMsg());
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

			// id_cliente
			$this->id_cliente->SetDbValueDef($rsnew, $this->id_cliente->CurrentValue, NULL, $this->id_cliente->ReadOnly);

			// estadointerno
			$this->estadointerno->SetDbValueDef($rsnew, $this->estadointerno->CurrentValue, NULL, $this->estadointerno->ReadOnly);

			// estadopago
			$this->estadopago->SetDbValueDef($rsnew, $this->estadopago->CurrentValue, NULL, $this->estadopago->ReadOnly);

			// fecha_avaluo
			$this->fecha_avaluo->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_avaluo->CurrentValue, 10), NULL, $this->fecha_avaluo->ReadOnly);

			// montoincial
			$this->montoincial->SetDbValueDef($rsnew, $this->montoincial->CurrentValue, NULL, $this->montoincial->ReadOnly);

			// monto_pago
			$this->monto_pago->SetDbValueDef($rsnew, $this->monto_pago->CurrentValue, NULL, $this->monto_pago->ReadOnly);

			// comentario
			$this->comentario->SetDbValueDef($rsnew, $this->comentario->CurrentValue, NULL, $this->comentario->ReadOnly);

			// documento_pago
			if ($this->documento_pago->Visible && !$this->documento_pago->ReadOnly && !$this->documento_pago->Upload->KeepFile) {
				if (is_null($this->documento_pago->Upload->Value)) {
					$rsnew['documento_pago'] = NULL;
				} else {
					$rsnew['documento_pago'] = $this->documento_pago->Upload->Value;
				}
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
		if ($EditRow) {
			if ($this->SendEmail)
				$this->SendEmailOnEdit($rsold, $rsnew);
		}
		$rs->Close();

		// documento_pago
		ew_CleanUploadTempPath($this->documento_pago, $this->documento_pago->Upload->Index);
		return $EditRow;
	}

	// Add record
	function AddRow($rsold = NULL) {
		global $Language, $Security;
		$conn = &$this->Connection();

		// Load db values from rsold
		$this->LoadDbValues($rsold);
		if ($rsold) {
		}
		$rsnew = array();

		// codigoavaluo
		$this->codigoavaluo->SetDbValueDef($rsnew, $this->codigoavaluo->CurrentValue, NULL, FALSE);

		// id_oficialcredito
		$this->id_oficialcredito->SetDbValueDef($rsnew, $this->id_oficialcredito->CurrentValue, NULL, FALSE);

		// id_inspector
		$this->id_inspector->SetDbValueDef($rsnew, $this->id_inspector->CurrentValue, NULL, FALSE);

		// id_cliente
		$this->id_cliente->SetDbValueDef($rsnew, $this->id_cliente->CurrentValue, NULL, FALSE);

		// estadointerno
		$this->estadointerno->SetDbValueDef($rsnew, $this->estadointerno->CurrentValue, NULL, strval($this->estadointerno->CurrentValue) == "");

		// estadopago
		$this->estadopago->SetDbValueDef($rsnew, $this->estadopago->CurrentValue, NULL, strval($this->estadopago->CurrentValue) == "");

		// fecha_avaluo
		$this->fecha_avaluo->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_avaluo->CurrentValue, 10), NULL, FALSE);

		// montoincial
		$this->montoincial->SetDbValueDef($rsnew, $this->montoincial->CurrentValue, NULL, strval($this->montoincial->CurrentValue) == "");

		// monto_pago
		$this->monto_pago->SetDbValueDef($rsnew, $this->monto_pago->CurrentValue, NULL, strval($this->monto_pago->CurrentValue) == "");

		// comentario
		$this->comentario->SetDbValueDef($rsnew, $this->comentario->CurrentValue, NULL, FALSE);

		// documento_pago
		if ($this->documento_pago->Visible && !$this->documento_pago->Upload->KeepFile) {
			if (is_null($this->documento_pago->Upload->Value)) {
				$rsnew['documento_pago'] = NULL;
			} else {
				$rsnew['documento_pago'] = $this->documento_pago->Upload->Value;
			}
		}

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

		// documento_pago
		ew_CleanUploadTempPath($this->documento_pago, $this->documento_pago->Upload->Index);
		return $AddRow;
	}

	// Load advanced search
	function LoadAdvancedSearch() {
		$this->id->AdvancedSearch->Load();
		$this->codigoavaluo->AdvancedSearch->Load();
		$this->tipoinmueble->AdvancedSearch->Load();
		$this->id_solicitud->AdvancedSearch->Load();
		$this->id_oficialcredito->AdvancedSearch->Load();
		$this->id_inspector->AdvancedSearch->Load();
		$this->is_active->AdvancedSearch->Load();
		$this->estado->AdvancedSearch->Load();
		$this->estadointerno->AdvancedSearch->Load();
		$this->estadopago->AdvancedSearch->Load();
		$this->monto_pago->AdvancedSearch->Load();
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
		$item->Body = "<button id=\"emf_viewavaluosc\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_viewavaluosc',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fviewavaluosclist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		$this->AddSearchQueryString($sQry, $this->codigoavaluo); // codigoavaluo
		$this->AddSearchQueryString($sQry, $this->tipoinmueble); // tipoinmueble
		$this->AddSearchQueryString($sQry, $this->id_solicitud); // id_solicitud
		$this->AddSearchQueryString($sQry, $this->id_oficialcredito); // id_oficialcredito
		$this->AddSearchQueryString($sQry, $this->id_inspector); // id_inspector
		$this->AddSearchQueryString($sQry, $this->is_active); // is_active
		$this->AddSearchQueryString($sQry, $this->estado); // estado
		$this->AddSearchQueryString($sQry, $this->estadointerno); // estadointerno
		$this->AddSearchQueryString($sQry, $this->estadopago); // estadopago
		$this->AddSearchQueryString($sQry, $this->monto_pago); // monto_pago
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
		case "x_id_oficialcredito":
			$sSqlWrk = "";
				switch (@$gsLanguage) {
					case "en":
						$sSqlWrk = "SELECT `login` AS `LinkFld`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
						$sWhereWrk = "{filter}";
						$fld->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
						break;
					case "es":
						$sSqlWrk = "SELECT `login` AS `LinkFld`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
						$sWhereWrk = "{filter}";
						$fld->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
						break;
					default:
						$sSqlWrk = "SELECT `login` AS `LinkFld`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
						$sWhereWrk = "{filter}";
						$fld->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
						break;
				}
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`login` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
				$this->Lookup_Selecting($this->id_oficialcredito, $sWhereWrk); // Call Lookup Selecting
				if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_inspector":
			$sSqlWrk = "";
				switch (@$gsLanguage) {
					case "en":
						$sSqlWrk = "SELECT `login` AS `LinkFld`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
						$sWhereWrk = "{filter}";
						$fld->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
						break;
					case "es":
						$sSqlWrk = "SELECT `login` AS `LinkFld`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
						$sWhereWrk = "{filter}";
						$fld->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
						break;
					default:
						$sSqlWrk = "SELECT `login` AS `LinkFld`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
						$sWhereWrk = "{filter}";
						$fld->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
						break;
				}
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`login` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
				$this->Lookup_Selecting($this->id_inspector, $sWhereWrk); // Call Lookup Selecting
				if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_cliente":
			$sSqlWrk = "";
				switch (@$gsLanguage) {
					case "en":
						$sSqlWrk = "SELECT `id` AS `LinkFld`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
						$sWhereWrk = "";
						$fld->LookupFilters = array();
						break;
					case "es":
						$sSqlWrk = "SELECT `id` AS `LinkFld`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
						$sWhereWrk = "";
						$fld->LookupFilters = array();
						break;
					default:
						$sSqlWrk = "SELECT `id` AS `LinkFld`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
						$sWhereWrk = "";
						$fld->LookupFilters = array();
						break;
				}
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
				$this->Lookup_Selecting($this->id_cliente, $sWhereWrk); // Call Lookup Selecting
				if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_estadointerno":
			$sSqlWrk = "";
				switch (@$gsLanguage) {
					case "en":
						$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
						$sWhereWrk = "";
						$fld->LookupFilters = array();
						break;
					case "es":
						$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
						$sWhereWrk = "";
						$fld->LookupFilters = array();
						break;
					default:
						$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
						$sWhereWrk = "";
						$fld->LookupFilters = array();
						break;
				}
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
				$this->Lookup_Selecting($this->estadointerno, $sWhereWrk); // Call Lookup Selecting
				if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_estadopago":
			$sSqlWrk = "";
				switch (@$gsLanguage) {
					case "en":
						$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
						$sWhereWrk = "";
						$fld->LookupFilters = array();
						break;
					case "es":
						$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
						$sWhereWrk = "";
						$fld->LookupFilters = array();
						break;
					default:
						$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
						$sWhereWrk = "";
						$fld->LookupFilters = array();
						break;
				}
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
				$this->Lookup_Selecting($this->estadopago, $sWhereWrk); // Call Lookup Selecting
				if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
			}
		} elseif ($pageId == "extbs") {
			switch ($fld->FldVar) {
		case "x_id_oficialcredito":
			$sSqlWrk = "";
				switch (@$gsLanguage) {
					case "en":
						$sSqlWrk = "SELECT `login` AS `LinkFld`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
						$sWhereWrk = "{filter}";
						$fld->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
						break;
					case "es":
						$sSqlWrk = "SELECT `login` AS `LinkFld`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
						$sWhereWrk = "{filter}";
						$fld->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
						break;
					default:
						$sSqlWrk = "SELECT `login` AS `LinkFld`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
						$sWhereWrk = "{filter}";
						$fld->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
						break;
				}
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`login` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
				$this->Lookup_Selecting($this->id_oficialcredito, $sWhereWrk); // Call Lookup Selecting
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

		if (!isset($_GET["id"]))
		{
            $var=0;
		$header = "<table style=\"width: 100% !important;height: 100%;\">";
		 $header .= "<tr>";
		 $header .= "<td>";
		 $header .= "<div class=\"card-body p-0\">";
		 $header .= "<iframe src=\"viewsolicitudframeedit.php?solicitud=".$var."\" height=\"300\" width=\"100%\" style=\"border:none;\" scrolling=\"yes\" name=\"framesol\"></iframe>";
		 $header .= "</div>";
		 $header .= "</td>";
		 $header .= "</tr>";
		 $header .= "</table>";
		 }else
		 {

		 $header = "<table style=\"width: 100% !important;height: 100%;\">";
		 $header .= "<tr>";
		 $header .= "<td>";
		 $header .= "<div class=\"card-body p-0\">";
		 $header .= "<iframe src=\"viewsolicitudframeedit.php?solicitud=".$_GET["id"]."\" height=\"300\" width=\"100%\" style=\"border:none;\" scrolling=\"yes\" name=\"framesol\"></iframe>";
		 $header .= "</div>";
		 $header .= "</td>";
		 $header .= "</tr>";
		 $header .= "</table>";
		 }
	}

	// Page Data Rendered event
	function Page_DataRendered(&$footer) {

		// Example:
		//$footer = "your footer";

		if (isset($_GET ["avaluo"]))
		{
		 $footer = "<table style=\"width: 100% !important;height: 100%;\">";
		 $footer .= "<tr>";
		 $footer .= "<td>";
		 $footer .= "<div class=\"card-body p-0\">";
		 $footer .= "<iframe src=\"historicolist.php?avaluo=".$_GET ["avaluo"]."\" height=\"300\" width=\"100%\" style=\"border:none;\" scrolling=\"yes\" name=\"frame\"></iframe>";
		 $footer .= "</div>";
		 $footer .= "</td><td></td>";
		  $footer .= "<td>";
		 $footer .= "<div class=\"card-body p-0\">";
		 $footer .= "<iframe src=\"viewdocumentosavaluoframelist.php?avaluo=".$_GET ["avaluo"]."\" height=\"300\" width=\"100%\" style=\"border:none;\" scrolling=\"yes\" name=\"framedoc\"></iframe>";
		 $footer .= "</div>";
		 $footer .= "</td>";
		 	  $footer .= "<td>";
		 $footer .= "<div class=\"card-body p-0\">";
		 $footer .= "<iframe src=\"viewpagoavaluoslist.php?avaluo=".$_GET ["avaluo"]."\" height=\"300\" width=\"100%\" style=\"border:none;\" scrolling=\"yes\" name=\"framepagos\"></iframe>";
		 $footer .= "</div>";
		 $footer .= "</td>";
		 $footer .= "</tr>";
		 $footer .= "</table>";
		}else
		{
		$var=0;
		 $footer = "<table style=\"width: 100% !important;height: 100%;\">";
		 $footer .= "<tr>";
		 $footer .= "<td>";
		 $footer .= "<div class=\"card-body p-0\">";
		 $footer .= "<iframe src=\"historicolist.php?avaluo=".$var."\" height=\"300\" width=\"100%\" style=\"border:none;\" scrolling=\"yes\" name=\"frame\"></iframe>";
		 $footer .= "</div>";
		 $footer .= "</td><td></td>";
		 $footer .= "<td>";
		 $footer .= "<div class=\"card-body p-0\">";
		 $footer .= "<iframe src=\"viewdocumentosavaluoframelist.php?avaluo=".$var."\" height=\"300\" width=\"100%\" style=\"border:none;\" scrolling=\"yes\" name=\"framedoc\"></iframe>";
		 $footer .= "</div>";
		 $footer .= "</td>";
		 $footer .= "<td>";
		 $footer .= "<div class=\"card-body p-0\">";
		 $footer .= "<iframe src=\"viewpagoavaluoslist.php?avaluo=".$var."\" height=\"300\" width=\"100%\" style=\"border:none;\" scrolling=\"yes\" name=\"framepagos\"></iframe>";
		 $footer .= "</div>";
		 $footer .= "</td>";
		 $footer .= "</tr>";
		 $footer .= "</table>";
		}
		if (isset($_GET ["id"]))
		{
		 $footer = "<table style=\"width: 100% !important;height: 100%;\">";
		 $footer .= "<tr>";
		 $footer .= "<td>";
		 $footer .= "<div class=\"card-body p-0\">";
		 $footer .= "<iframe src=\"historicolist.php?avaluo=".$_GET ["id"]."\" height=\"300\" width=\"100%\" style=\"border:none;\" scrolling=\"yes\" name=\"frame\"></iframe>";
		 $footer .= "</div>";
		 $footer .= "</td><td></td>";
		 $footer .= "<td>";
		 $footer .= "<div class=\"card-body p-0\">";
		 $footer .= "<iframe src=\"viewdocumentosavaluoframelist.php?avaluo=".$_GET ["id"]."\" height=\"300\" width=\"100%\" style=\"border:none;\" scrolling=\"yes\" name=\"framedoc\"></iframe>";
		 $footer .= "</div>";
		 $footer .= "</td>";
		 $footer .= "<td>";
		 $footer .= "<div class=\"card-body p-0\">";
		 $footer .= "<iframe src=\"viewpagoavaluoslist.php?avaluo=".$_GET ["id"]."\" height=\"300\" width=\"100%\" style=\"border:none;\" scrolling=\"yes\" name=\"framepagos\"></iframe>";
		 $footer .= "</div>";
		 $footer .= "</td>";
		 $footer .= "</tr>";
		 $footer .= "</table>";
		}
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

		$opt = &$this->ListOptions->Add("new");
		$opt->Header = "Notoficaciones de Pago";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(0); // Move to first column
		$opt = &$this->ListOptions->Add("new1");
		$opt->Header = "Tareas Secretaria";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(1); // Move to first column
		$opt = &$this->ListOptions->Add("new2");
		$opt->Header = "Ver Historial";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(2); // Move to first column
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

		$Sql="SELECT solicitud.cell FROM solicitud  INNER JOIN avaluo ON solicitud.id = avaluo.id_solicitud";
		$TheQuery=$Sql." WHERE avaluo.id = '" . ew_AdjustSql(CurrentTable()->id->CurrentValue) . "'";
		$celular = ew_ExecuteScalar($TheQuery);
		$text1="https://api.whatsapp.com/send?phone=";
		$text2=$celular."&";
		$text3="text=El%20avaluo%20fue%20terminado%20porfavor%20pasar%20a%20la%20oficina%20para%20cancelar";
		$url=$text1.$text2.$text3;
		$Sql_email="SELECT solicitud.email FROM solicitud  INNER JOIN avaluo ON solicitud.id = avaluo.id_solicitud";
		$TheQuery=$Sql." WHERE avaluo.id = '" . ew_AdjustSql(CurrentTable()->id->CurrentValue) . "'";
		$email = ew_ExecuteScalar($TheQuery);
		$button4="<div class=\"btn-group\" role=\"group\" aria-label=\"Button group with nested dropdown\">";
		$button4.=	"<button class=\"btn btn-primary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
		$button4.="Tareas Secretaria";
		$button4.="</button>";
		$button4.="<ul class=\"dropdown-menu ewMenu\" aria-labelledby=\"dropdownMenuButton\">";
		$button4.="<li><a class=\"dropdown-item\" href=core.php?case=sec&type=emailof&id=".CurrentTable()->id->CurrentValue.">Envio Email Oficial credito</a></li>";
		$button4.="<li><a class=\"dropdown-item\" href=core.php?case=sec&type=pagado&id=".CurrentTable()->id->CurrentValue.">Terminado</a></li>";
		$button4.="</ul>";
		$button4.="</div>";

			$button="<div class=\"btn-group\" role=\"group\" aria-label=\"Button group with nested dropdown\">";
		$button.=	"<button class=\"btn btn-danger dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
		$button.="Notificaciones Pago";
		$button.="</button>";
		$button.="<ul class=\"dropdown-menu ewMenu\" aria-labelledby=\"dropdownMenuButton\">";
		if ($email!=''){
		$button.="<li><a class=\"dropdown-item\" href=core.php?case=sec&type=email&id=".CurrentTable()->id->CurrentValue.">Enviar Email</a></li>";
		}
		if ($celular!=''){
		$button.="<li><a class=\"dropdown-item\" href=core.php?case=sec&type=sms&id=".CurrentTable()->id->CurrentValue.">Enviar SMS</a></li>";
		$button.="<li><a class=\"dropdown-item\" href=".$url." target=\"_blank\">Enviar Whatsapp</a></li>";
		$button.="<li><a class=\"dropdown-item\" href=core.php?case=sec&type=whatasppapi&id=".CurrentTable()->id->CurrentValue.">Enviar Whatsapp API</a></li>";
		}
		$button.="</ul>";
		$button.="</div>";
		$button2="<div class=\"btn-group\" role=\"group\" aria-label=\"Button group with nested dropdown\">";
		$button2.=	"<button class=\"btn btn-warning dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
		$button2.="Historiales";
		$button2.="</button>";
		$button2.="<ul class=\"dropdown-menu ewMenu\" aria-labelledby=\"dropdownMenuButton\">";
	   $button2.="<li><a class=\"dropdown-item\" href=historicolist.php?avaluo=".CurrentTable()->id->CurrentValue." target=\"frame\">Historial</a></li>";
	   $button2.="<li><a class=\"dropdown-item\" href=viewdocumentosavaluoframelist.php?avaluo=".CurrentTable()->id->CurrentValue." target=\"framedoc\" >Adjunto</a></li>";
	   $button2.="<li><a class=\"dropdown-item\" href=viewsolicitudframelist.php?id=".CurrentTable()->id_solicitud->CurrentValue." target=\"framesol\">Datos Solicitud</a></li>";
	   $button2.="<li><a class=\"dropdown-item\" href=viewpagoavaluoslist.php?avaluo=".CurrentTable()->id->CurrentValue." target=\"framepagos\">Historial de Pagos</a></li>";
		$button2.="</ul>";
		$button2.="</div>";
		$this->ListOptions->Items["new"]->Body = $button4;
		$this->ListOptions->Items["new1"]->Body = $button;
		$this->ListOptions->Items["new2"]->Body = $button2;

	//	$this->ListOptions->Items["edit"]->Visible = FALSE;
	   //$this->ListOptions->Items["detail_orderdetails"]->Visible = FALSE;

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
if (!isset($viewavaluosc_list)) $viewavaluosc_list = new cviewavaluosc_list();

// Page init
$viewavaluosc_list->Page_Init();

// Page main
$viewavaluosc_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewavaluosc_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($viewavaluosc->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fviewavaluosclist = new ew_Form("fviewavaluosclist", "list");
fviewavaluosclist.FormKeyCountName = '<?php echo $viewavaluosc_list->FormKeyCountName ?>';

// Validate form
fviewavaluosclist.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_fecha_avaluo");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewavaluosc->fecha_avaluo->FldCaption(), $viewavaluosc->fecha_avaluo->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_fecha_avaluo");
			if (elm && !ew_CheckUSDate(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosc->fecha_avaluo->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_montoincial");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosc->montoincial->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_monto_pago");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluosc->monto_pago->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fviewavaluosclist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluosclist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluosclist.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fviewavaluosclist.Lists["x_id_oficialcredito"].Data = "<?php echo $viewavaluosc_list->id_oficialcredito->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluosclist.Lists["x_id_inspector"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_apellido","x_nombre","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"inspector"};
fviewavaluosclist.Lists["x_id_inspector"].Data = "<?php echo $viewavaluosc_list->id_inspector->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluosclist.Lists["x_id_cliente"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cliente"};
fviewavaluosclist.Lists["x_id_cliente"].Data = "<?php echo $viewavaluosc_list->id_cliente->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluosclist.Lists["x_estadointerno"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadointerno"};
fviewavaluosclist.Lists["x_estadointerno"].Data = "<?php echo $viewavaluosc_list->estadointerno->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluosclist.Lists["x_estadopago"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadopago"};
fviewavaluosclist.Lists["x_estadopago"].Data = "<?php echo $viewavaluosc_list->estadopago->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
var CurrentSearchForm = fviewavaluosclistsrch = new ew_Form("fviewavaluosclistsrch");

// Validate function for search
fviewavaluosclistsrch.Validate = function(fobj) {
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
fviewavaluosclistsrch.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluosclistsrch.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluosclistsrch.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fviewavaluosclistsrch.Lists["x_id_oficialcredito"].Data = "<?php echo $viewavaluosc_list->id_oficialcredito->LookupFilterQuery(FALSE, "extbs") ?>";
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($viewavaluosc->Export == "") { ?>
<div class="ewToolbar">
<?php if ($viewavaluosc_list->TotalRecs > 0 && $viewavaluosc_list->ExportOptions->Visible()) { ?>
<?php $viewavaluosc_list->ExportOptions->Render("body") ?>
<?php } ?>
<?php if ($viewavaluosc_list->SearchOptions->Visible()) { ?>
<?php $viewavaluosc_list->SearchOptions->Render("body") ?>
<?php } ?>
<?php if ($viewavaluosc_list->FilterOptions->Visible()) { ?>
<?php $viewavaluosc_list->FilterOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $viewavaluosc_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($viewavaluosc_list->TotalRecs <= 0)
			$viewavaluosc_list->TotalRecs = $viewavaluosc->ListRecordCount();
	} else {
		if (!$viewavaluosc_list->Recordset && ($viewavaluosc_list->Recordset = $viewavaluosc_list->LoadRecordset()))
			$viewavaluosc_list->TotalRecs = $viewavaluosc_list->Recordset->RecordCount();
	}
	$viewavaluosc_list->StartRec = 1;
	if ($viewavaluosc_list->DisplayRecs <= 0 || ($viewavaluosc->Export <> "" && $viewavaluosc->ExportAll)) // Display all records
		$viewavaluosc_list->DisplayRecs = $viewavaluosc_list->TotalRecs;
	if (!($viewavaluosc->Export <> "" && $viewavaluosc->ExportAll))
		$viewavaluosc_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$viewavaluosc_list->Recordset = $viewavaluosc_list->LoadRecordset($viewavaluosc_list->StartRec-1, $viewavaluosc_list->DisplayRecs);

	// Set no record found message
	if ($viewavaluosc->CurrentAction == "" && $viewavaluosc_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$viewavaluosc_list->setWarningMessage(ew_DeniedMsg());
		if ($viewavaluosc_list->SearchWhere == "0=101")
			$viewavaluosc_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$viewavaluosc_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$viewavaluosc_list->RenderOtherOptions();
?>
<?php if ($Security->CanSearch()) { ?>
<?php if ($viewavaluosc->Export == "" && $viewavaluosc->CurrentAction == "") { ?>
<form name="fviewavaluosclistsrch" id="fviewavaluosclistsrch" class="form-inline ewForm ewExtSearchForm" action="<?php echo ew_CurrentPage() ?>">
<?php $SearchPanelClass = ($viewavaluosc_list->SearchWhere <> "") ? " in" : " in"; ?>
<div id="fviewavaluosclistsrch_SearchPanel" class="ewSearchPanel collapse<?php echo $SearchPanelClass ?>">
<input type="hidden" name="cmd" value="search">
<input type="hidden" name="t" value="viewavaluosc">
	<div class="ewBasicSearch">
<?php
if ($gsSearchError == "")
	$viewavaluosc_list->LoadAdvancedSearch(); // Load advanced search

// Render for search
$viewavaluosc->RowType = EW_ROWTYPE_SEARCH;

// Render row
$viewavaluosc->ResetAttrs();
$viewavaluosc_list->RenderRow();
?>
<div id="xsr_1" class="ewRow">
<?php if ($viewavaluosc->codigoavaluo->Visible) { // codigoavaluo ?>
	<div id="xsc_codigoavaluo" class="ewCell form-group">
		<label for="x_codigoavaluo" class="ewSearchCaption ewLabel"><?php echo $viewavaluosc->codigoavaluo->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("LIKE") ?><input type="hidden" name="z_codigoavaluo" id="z_codigoavaluo" value="LIKE"></span>
		<span class="ewSearchField">
<input type="text" data-table="viewavaluosc" data-field="x_codigoavaluo" name="x_codigoavaluo" id="x_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewavaluosc->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluosc->codigoavaluo->EditValue ?>"<?php echo $viewavaluosc->codigoavaluo->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_2" class="ewRow">
<?php if ($viewavaluosc->id_oficialcredito->Visible) { // id_oficialcredito ?>
	<div id="xsc_id_oficialcredito" class="ewCell form-group">
		<label for="x_id_oficialcredito" class="ewSearchCaption ewLabel"><?php echo $viewavaluosc->id_oficialcredito->FldCaption() ?></label>
		<span class="ewSearchOperator"><?php echo $Language->Phrase("=") ?><input type="hidden" name="z_id_oficialcredito" id="z_id_oficialcredito" value="="></span>
		<span class="ewSearchField">
<input type="text" data-table="viewavaluosc" data-field="x_id_oficialcredito" name="x_id_oficialcredito" id="x_id_oficialcredito" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosc->id_oficialcredito->getPlaceHolder()) ?>" value="<?php echo $viewavaluosc->id_oficialcredito->EditValue ?>"<?php echo $viewavaluosc->id_oficialcredito->EditAttributes() ?>>
</span>
	</div>
<?php } ?>
</div>
<div id="xsr_3" class="ewRow">
	<button class="btn btn-primary ewButton" name="btnsubmit" id="btnsubmit" type="submit"><?php echo $Language->Phrase("SearchBtn") ?></button>
</div>
	</div>
</div>
</form>
<?php } ?>
<?php } ?>
<?php $viewavaluosc_list->ShowPageHeader(); ?>
<?php
$viewavaluosc_list->ShowMessage();
?>
<?php if ($viewavaluosc_list->TotalRecs > 0 || $viewavaluosc->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($viewavaluosc_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewavaluosc">
<form name="fviewavaluosclist" id="fviewavaluosclist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewavaluosc_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewavaluosc_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewavaluosc">
<div id="gmp_viewavaluosc" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($viewavaluosc_list->TotalRecs > 0 || $viewavaluosc->CurrentAction == "gridedit") { ?>
<table id="tbl_viewavaluosclist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$viewavaluosc_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$viewavaluosc_list->RenderListOptions();

// Render list options (header, left)
$viewavaluosc_list->ListOptions->Render("header", "left");
?>
<?php if ($viewavaluosc->codigoavaluo->Visible) { // codigoavaluo ?>
	<?php if ($viewavaluosc->SortUrl($viewavaluosc->codigoavaluo) == "") { ?>
		<th data-name="codigoavaluo" class="<?php echo $viewavaluosc->codigoavaluo->HeaderCellClass() ?>"><div id="elh_viewavaluosc_codigoavaluo" class="viewavaluosc_codigoavaluo"><div class="ewTableHeaderCaption"><?php echo $viewavaluosc->codigoavaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigoavaluo" class="<?php echo $viewavaluosc->codigoavaluo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosc->SortUrl($viewavaluosc->codigoavaluo) ?>',1);"><div id="elh_viewavaluosc_codigoavaluo" class="viewavaluosc_codigoavaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosc->codigoavaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosc->codigoavaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosc->codigoavaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->id_oficialcredito->Visible) { // id_oficialcredito ?>
	<?php if ($viewavaluosc->SortUrl($viewavaluosc->id_oficialcredito) == "") { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluosc->id_oficialcredito->HeaderCellClass() ?>"><div id="elh_viewavaluosc_id_oficialcredito" class="viewavaluosc_id_oficialcredito"><div class="ewTableHeaderCaption"><?php echo $viewavaluosc->id_oficialcredito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluosc->id_oficialcredito->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosc->SortUrl($viewavaluosc->id_oficialcredito) ?>',1);"><div id="elh_viewavaluosc_id_oficialcredito" class="viewavaluosc_id_oficialcredito">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosc->id_oficialcredito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosc->id_oficialcredito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosc->id_oficialcredito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->id_inspector->Visible) { // id_inspector ?>
	<?php if ($viewavaluosc->SortUrl($viewavaluosc->id_inspector) == "") { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluosc->id_inspector->HeaderCellClass() ?>"><div id="elh_viewavaluosc_id_inspector" class="viewavaluosc_id_inspector"><div class="ewTableHeaderCaption"><?php echo $viewavaluosc->id_inspector->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluosc->id_inspector->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosc->SortUrl($viewavaluosc->id_inspector) ?>',1);"><div id="elh_viewavaluosc_id_inspector" class="viewavaluosc_id_inspector">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosc->id_inspector->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosc->id_inspector->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosc->id_inspector->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->id_cliente->Visible) { // id_cliente ?>
	<?php if ($viewavaluosc->SortUrl($viewavaluosc->id_cliente) == "") { ?>
		<th data-name="id_cliente" class="<?php echo $viewavaluosc->id_cliente->HeaderCellClass() ?>"><div id="elh_viewavaluosc_id_cliente" class="viewavaluosc_id_cliente"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluosc->id_cliente->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_cliente" class="<?php echo $viewavaluosc->id_cliente->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosc->SortUrl($viewavaluosc->id_cliente) ?>',1);"><div id="elh_viewavaluosc_id_cliente" class="viewavaluosc_id_cliente">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluosc->id_cliente->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosc->id_cliente->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosc->id_cliente->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->estadointerno->Visible) { // estadointerno ?>
	<?php if ($viewavaluosc->SortUrl($viewavaluosc->estadointerno) == "") { ?>
		<th data-name="estadointerno" class="<?php echo $viewavaluosc->estadointerno->HeaderCellClass() ?>"><div id="elh_viewavaluosc_estadointerno" class="viewavaluosc_estadointerno"><div class="ewTableHeaderCaption"><?php echo $viewavaluosc->estadointerno->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadointerno" class="<?php echo $viewavaluosc->estadointerno->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosc->SortUrl($viewavaluosc->estadointerno) ?>',1);"><div id="elh_viewavaluosc_estadointerno" class="viewavaluosc_estadointerno">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosc->estadointerno->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosc->estadointerno->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosc->estadointerno->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->estadopago->Visible) { // estadopago ?>
	<?php if ($viewavaluosc->SortUrl($viewavaluosc->estadopago) == "") { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluosc->estadopago->HeaderCellClass() ?>"><div id="elh_viewavaluosc_estadopago" class="viewavaluosc_estadopago"><div class="ewTableHeaderCaption"><?php echo $viewavaluosc->estadopago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluosc->estadopago->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosc->SortUrl($viewavaluosc->estadopago) ?>',1);"><div id="elh_viewavaluosc_estadopago" class="viewavaluosc_estadopago">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosc->estadopago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosc->estadopago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosc->estadopago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->fecha_avaluo->Visible) { // fecha_avaluo ?>
	<?php if ($viewavaluosc->SortUrl($viewavaluosc->fecha_avaluo) == "") { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluosc->fecha_avaluo->HeaderCellClass() ?>"><div id="elh_viewavaluosc_fecha_avaluo" class="viewavaluosc_fecha_avaluo"><div class="ewTableHeaderCaption"><?php echo $viewavaluosc->fecha_avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluosc->fecha_avaluo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosc->SortUrl($viewavaluosc->fecha_avaluo) ?>',1);"><div id="elh_viewavaluosc_fecha_avaluo" class="viewavaluosc_fecha_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosc->fecha_avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosc->fecha_avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosc->fecha_avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->montoincial->Visible) { // montoincial ?>
	<?php if ($viewavaluosc->SortUrl($viewavaluosc->montoincial) == "") { ?>
		<th data-name="montoincial" class="<?php echo $viewavaluosc->montoincial->HeaderCellClass() ?>"><div id="elh_viewavaluosc_montoincial" class="viewavaluosc_montoincial"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluosc->montoincial->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="montoincial" class="<?php echo $viewavaluosc->montoincial->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosc->SortUrl($viewavaluosc->montoincial) ?>',1);"><div id="elh_viewavaluosc_montoincial" class="viewavaluosc_montoincial">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluosc->montoincial->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosc->montoincial->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosc->montoincial->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->monto_pago->Visible) { // monto_pago ?>
	<?php if ($viewavaluosc->SortUrl($viewavaluosc->monto_pago) == "") { ?>
		<th data-name="monto_pago" class="<?php echo $viewavaluosc->monto_pago->HeaderCellClass() ?>"><div id="elh_viewavaluosc_monto_pago" class="viewavaluosc_monto_pago"><div class="ewTableHeaderCaption"><?php echo $viewavaluosc->monto_pago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto_pago" class="<?php echo $viewavaluosc->monto_pago->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosc->SortUrl($viewavaluosc->monto_pago) ?>',1);"><div id="elh_viewavaluosc_monto_pago" class="viewavaluosc_monto_pago">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosc->monto_pago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosc->monto_pago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosc->monto_pago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->comentario->Visible) { // comentario ?>
	<?php if ($viewavaluosc->SortUrl($viewavaluosc->comentario) == "") { ?>
		<th data-name="comentario" class="<?php echo $viewavaluosc->comentario->HeaderCellClass() ?>"><div id="elh_viewavaluosc_comentario" class="viewavaluosc_comentario"><div class="ewTableHeaderCaption"><?php echo $viewavaluosc->comentario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="comentario" class="<?php echo $viewavaluosc->comentario->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosc->SortUrl($viewavaluosc->comentario) ?>',1);"><div id="elh_viewavaluosc_comentario" class="viewavaluosc_comentario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosc->comentario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosc->comentario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosc->comentario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluosc->documento_pago->Visible) { // documento_pago ?>
	<?php if ($viewavaluosc->SortUrl($viewavaluosc->documento_pago) == "") { ?>
		<th data-name="documento_pago" class="<?php echo $viewavaluosc->documento_pago->HeaderCellClass() ?>"><div id="elh_viewavaluosc_documento_pago" class="viewavaluosc_documento_pago"><div class="ewTableHeaderCaption"><?php echo $viewavaluosc->documento_pago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="documento_pago" class="<?php echo $viewavaluosc->documento_pago->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluosc->SortUrl($viewavaluosc->documento_pago) ?>',1);"><div id="elh_viewavaluosc_documento_pago" class="viewavaluosc_documento_pago">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluosc->documento_pago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluosc->documento_pago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluosc->documento_pago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$viewavaluosc_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($viewavaluosc->ExportAll && $viewavaluosc->Export <> "") {
	$viewavaluosc_list->StopRec = $viewavaluosc_list->TotalRecs;
} else {

	// Set the last record to display
	if ($viewavaluosc_list->TotalRecs > $viewavaluosc_list->StartRec + $viewavaluosc_list->DisplayRecs - 1)
		$viewavaluosc_list->StopRec = $viewavaluosc_list->StartRec + $viewavaluosc_list->DisplayRecs - 1;
	else
		$viewavaluosc_list->StopRec = $viewavaluosc_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($viewavaluosc_list->FormKeyCountName) && ($viewavaluosc->CurrentAction == "gridadd" || $viewavaluosc->CurrentAction == "gridedit" || $viewavaluosc->CurrentAction == "F")) {
		$viewavaluosc_list->KeyCount = $objForm->GetValue($viewavaluosc_list->FormKeyCountName);
		$viewavaluosc_list->StopRec = $viewavaluosc_list->StartRec + $viewavaluosc_list->KeyCount - 1;
	}
}
$viewavaluosc_list->RecCnt = $viewavaluosc_list->StartRec - 1;
if ($viewavaluosc_list->Recordset && !$viewavaluosc_list->Recordset->EOF) {
	$viewavaluosc_list->Recordset->MoveFirst();
	$bSelectLimit = $viewavaluosc_list->UseSelectLimit;
	if (!$bSelectLimit && $viewavaluosc_list->StartRec > 1)
		$viewavaluosc_list->Recordset->Move($viewavaluosc_list->StartRec - 1);
} elseif (!$viewavaluosc->AllowAddDeleteRow && $viewavaluosc_list->StopRec == 0) {
	$viewavaluosc_list->StopRec = $viewavaluosc->GridAddRowCount;
}

// Initialize aggregate
$viewavaluosc->RowType = EW_ROWTYPE_AGGREGATEINIT;
$viewavaluosc->ResetAttrs();
$viewavaluosc_list->RenderRow();
$viewavaluosc_list->EditRowCnt = 0;
if ($viewavaluosc->CurrentAction == "edit")
	$viewavaluosc_list->RowIndex = 1;
while ($viewavaluosc_list->RecCnt < $viewavaluosc_list->StopRec) {
	$viewavaluosc_list->RecCnt++;
	if (intval($viewavaluosc_list->RecCnt) >= intval($viewavaluosc_list->StartRec)) {
		$viewavaluosc_list->RowCnt++;

		// Set up key count
		$viewavaluosc_list->KeyCount = $viewavaluosc_list->RowIndex;

		// Init row class and style
		$viewavaluosc->ResetAttrs();
		$viewavaluosc->CssClass = "";
		if ($viewavaluosc->CurrentAction == "gridadd") {
			$viewavaluosc_list->LoadRowValues(); // Load default values
		} else {
			$viewavaluosc_list->LoadRowValues($viewavaluosc_list->Recordset); // Load row values
		}
		$viewavaluosc->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($viewavaluosc->CurrentAction == "edit") {
			if ($viewavaluosc_list->CheckInlineEditKey() && $viewavaluosc_list->EditRowCnt == 0) { // Inline edit
				$viewavaluosc->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($viewavaluosc->CurrentAction == "edit" && $viewavaluosc->RowType == EW_ROWTYPE_EDIT && $viewavaluosc->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$viewavaluosc_list->RestoreFormValues(); // Restore form values
		}
		if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT) // Edit row
			$viewavaluosc_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$viewavaluosc->RowAttrs = array_merge($viewavaluosc->RowAttrs, array('data-rowindex'=>$viewavaluosc_list->RowCnt, 'id'=>'r' . $viewavaluosc_list->RowCnt . '_viewavaluosc', 'data-rowtype'=>$viewavaluosc->RowType));

		// Render row
		$viewavaluosc_list->RenderRow();

		// Render list options
		$viewavaluosc_list->RenderListOptions();
?>
	<tr<?php echo $viewavaluosc->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewavaluosc_list->ListOptions->Render("body", "left", $viewavaluosc_list->RowCnt);
?>
	<?php if ($viewavaluosc->codigoavaluo->Visible) { // codigoavaluo ?>
		<td data-name="codigoavaluo"<?php echo $viewavaluosc->codigoavaluo->CellAttributes() ?>>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_codigoavaluo" class="form-group viewavaluosc_codigoavaluo">
<span<?php echo $viewavaluosc->codigoavaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosc->codigoavaluo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosc" data-field="x_codigoavaluo" name="x<?php echo $viewavaluosc_list->RowIndex ?>_codigoavaluo" id="x<?php echo $viewavaluosc_list->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluosc->codigoavaluo->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_codigoavaluo" class="viewavaluosc_codigoavaluo">
<span<?php echo $viewavaluosc->codigoavaluo->ViewAttributes() ?>>
<?php echo $viewavaluosc->codigoavaluo->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT || $viewavaluosc->CurrentMode == "edit") { ?>
<input type="hidden" data-table="viewavaluosc" data-field="x_id" name="x<?php echo $viewavaluosc_list->RowIndex ?>_id" id="x<?php echo $viewavaluosc_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluosc->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($viewavaluosc->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<td data-name="id_oficialcredito"<?php echo $viewavaluosc->id_oficialcredito->CellAttributes() ?>>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_id_oficialcredito" class="form-group viewavaluosc_id_oficialcredito">
<span<?php echo $viewavaluosc->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosc->id_oficialcredito->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosc" data-field="x_id_oficialcredito" name="x<?php echo $viewavaluosc_list->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluosc_list->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluosc->id_oficialcredito->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_id_oficialcredito" class="viewavaluosc_id_oficialcredito">
<span<?php echo $viewavaluosc->id_oficialcredito->ViewAttributes() ?>>
<?php echo $viewavaluosc->id_oficialcredito->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosc->id_inspector->Visible) { // id_inspector ?>
		<td data-name="id_inspector"<?php echo $viewavaluosc->id_inspector->CellAttributes() ?>>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_id_inspector" class="form-group viewavaluosc_id_inspector">
<span<?php echo $viewavaluosc->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluosc->id_inspector->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluosc" data-field="x_id_inspector" name="x<?php echo $viewavaluosc_list->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluosc_list->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluosc->id_inspector->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_id_inspector" class="viewavaluosc_id_inspector">
<span<?php echo $viewavaluosc->id_inspector->ViewAttributes() ?>>
<?php echo $viewavaluosc->id_inspector->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosc->id_cliente->Visible) { // id_cliente ?>
		<td data-name="id_cliente"<?php echo $viewavaluosc->id_cliente->CellAttributes() ?>>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_id_cliente" class="form-group viewavaluosc_id_cliente">
<select data-table="viewavaluosc" data-field="x_id_cliente" data-value-separator="<?php echo $viewavaluosc->id_cliente->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosc_list->RowIndex ?>_id_cliente" name="x<?php echo $viewavaluosc_list->RowIndex ?>_id_cliente"<?php echo $viewavaluosc->id_cliente->EditAttributes() ?>>
<?php echo $viewavaluosc->id_cliente->SelectOptionListHtml("x<?php echo $viewavaluosc_list->RowIndex ?>_id_cliente") ?>
</select>
</span>
<?php } ?>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_id_cliente" class="viewavaluosc_id_cliente">
<span<?php echo $viewavaluosc->id_cliente->ViewAttributes() ?>>
<?php echo $viewavaluosc->id_cliente->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosc->estadointerno->Visible) { // estadointerno ?>
		<td data-name="estadointerno"<?php echo $viewavaluosc->estadointerno->CellAttributes() ?>>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_estadointerno" class="form-group viewavaluosc_estadointerno">
<select data-table="viewavaluosc" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluosc->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosc_list->RowIndex ?>_estadointerno" name="x<?php echo $viewavaluosc_list->RowIndex ?>_estadointerno"<?php echo $viewavaluosc->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluosc->estadointerno->SelectOptionListHtml("x<?php echo $viewavaluosc_list->RowIndex ?>_estadointerno") ?>
</select>
</span>
<?php } ?>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_estadointerno" class="viewavaluosc_estadointerno">
<span<?php echo $viewavaluosc->estadointerno->ViewAttributes() ?>>
<?php echo $viewavaluosc->estadointerno->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosc->estadopago->Visible) { // estadopago ?>
		<td data-name="estadopago"<?php echo $viewavaluosc->estadopago->CellAttributes() ?>>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_estadopago" class="form-group viewavaluosc_estadopago">
<select data-table="viewavaluosc" data-field="x_estadopago" data-value-separator="<?php echo $viewavaluosc->estadopago->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluosc_list->RowIndex ?>_estadopago" name="x<?php echo $viewavaluosc_list->RowIndex ?>_estadopago"<?php echo $viewavaluosc->estadopago->EditAttributes() ?>>
<?php echo $viewavaluosc->estadopago->SelectOptionListHtml("x<?php echo $viewavaluosc_list->RowIndex ?>_estadopago") ?>
</select>
</span>
<?php } ?>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_estadopago" class="viewavaluosc_estadopago">
<span<?php echo $viewavaluosc->estadopago->ViewAttributes() ?>>
<?php echo $viewavaluosc->estadopago->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosc->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<td data-name="fecha_avaluo"<?php echo $viewavaluosc->fecha_avaluo->CellAttributes() ?>>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_fecha_avaluo" class="form-group viewavaluosc_fecha_avaluo">
<input type="text" data-table="viewavaluosc" data-field="x_fecha_avaluo" data-format="10" name="x<?php echo $viewavaluosc_list->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluosc_list->RowIndex ?>_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($viewavaluosc->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluosc->fecha_avaluo->EditValue ?>"<?php echo $viewavaluosc->fecha_avaluo->EditAttributes() ?>>
<?php if (!$viewavaluosc->fecha_avaluo->ReadOnly && !$viewavaluosc->fecha_avaluo->Disabled && !isset($viewavaluosc->fecha_avaluo->EditAttrs["readonly"]) && !isset($viewavaluosc->fecha_avaluo->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fviewavaluosclist", "x<?php echo $viewavaluosc_list->RowIndex ?>_fecha_avaluo", {"ignoreReadonly":true,"useCurrent":false,"format":10});
</script>
<?php } ?>
</span>
<?php } ?>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_fecha_avaluo" class="viewavaluosc_fecha_avaluo">
<span<?php echo $viewavaluosc->fecha_avaluo->ViewAttributes() ?>>
<?php echo $viewavaluosc->fecha_avaluo->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosc->montoincial->Visible) { // montoincial ?>
		<td data-name="montoincial"<?php echo $viewavaluosc->montoincial->CellAttributes() ?>>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_montoincial" class="form-group viewavaluosc_montoincial">
<input type="text" data-table="viewavaluosc" data-field="x_montoincial" name="x<?php echo $viewavaluosc_list->RowIndex ?>_montoincial" id="x<?php echo $viewavaluosc_list->RowIndex ?>_montoincial" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosc->montoincial->getPlaceHolder()) ?>" value="<?php echo $viewavaluosc->montoincial->EditValue ?>"<?php echo $viewavaluosc->montoincial->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_montoincial" class="viewavaluosc_montoincial">
<span<?php echo $viewavaluosc->montoincial->ViewAttributes() ?>>
<?php echo $viewavaluosc->montoincial->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosc->monto_pago->Visible) { // monto_pago ?>
		<td data-name="monto_pago"<?php echo $viewavaluosc->monto_pago->CellAttributes() ?>>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_monto_pago" class="form-group viewavaluosc_monto_pago">
<input type="text" data-table="viewavaluosc" data-field="x_monto_pago" name="x<?php echo $viewavaluosc_list->RowIndex ?>_monto_pago" id="x<?php echo $viewavaluosc_list->RowIndex ?>_monto_pago" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluosc->monto_pago->getPlaceHolder()) ?>" value="<?php echo $viewavaluosc->monto_pago->EditValue ?>"<?php echo $viewavaluosc->monto_pago->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_monto_pago" class="viewavaluosc_monto_pago">
<span<?php echo $viewavaluosc->monto_pago->ViewAttributes() ?>>
<?php echo $viewavaluosc->monto_pago->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosc->comentario->Visible) { // comentario ?>
		<td data-name="comentario"<?php echo $viewavaluosc->comentario->CellAttributes() ?>>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_comentario" class="form-group viewavaluosc_comentario">
<textarea data-table="viewavaluosc" data-field="x_comentario" name="x<?php echo $viewavaluosc_list->RowIndex ?>_comentario" id="x<?php echo $viewavaluosc_list->RowIndex ?>_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluosc->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluosc->comentario->EditAttributes() ?>><?php echo $viewavaluosc->comentario->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_comentario" class="viewavaluosc_comentario">
<span<?php echo $viewavaluosc->comentario->ViewAttributes() ?>>
<?php echo $viewavaluosc->comentario->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluosc->documento_pago->Visible) { // documento_pago ?>
		<td data-name="documento_pago"<?php echo $viewavaluosc->documento_pago->CellAttributes() ?>>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_documento_pago" class="form-group viewavaluosc_documento_pago">
<div id="fd_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago">
<span title="<?php echo $viewavaluosc->documento_pago->FldTitle() ? $viewavaluosc->documento_pago->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewavaluosc->documento_pago->ReadOnly || $viewavaluosc->documento_pago->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewavaluosc" data-field="x_documento_pago" name="x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" id="x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago"<?php echo $viewavaluosc->documento_pago->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" id= "fn_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" value="<?php echo $viewavaluosc->documento_pago->Upload->FileName ?>">
<?php if (@$_POST["fa_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago"] == "0") { ?>
<input type="hidden" name="fa_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" id= "fa_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" id= "fa_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" id= "fs_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" value="0">
<input type="hidden" name="fx_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" id= "fx_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" value="<?php echo $viewavaluosc->documento_pago->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" id= "fm_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" value="<?php echo $viewavaluosc->documento_pago->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewavaluosc_list->RowIndex ?>_documento_pago" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php } ?>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluosc_list->RowCnt ?>_viewavaluosc_documento_pago" class="viewavaluosc_documento_pago">
<span<?php echo $viewavaluosc->documento_pago->ViewAttributes() ?>>
<?php echo ew_GetFileViewTag($viewavaluosc->documento_pago, $viewavaluosc->documento_pago->ListViewValue()) ?>
</span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewavaluosc_list->ListOptions->Render("body", "right", $viewavaluosc_list->RowCnt);
?>
	</tr>
<?php if ($viewavaluosc->RowType == EW_ROWTYPE_ADD || $viewavaluosc->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fviewavaluosclist.UpdateOpts(<?php echo $viewavaluosc_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if ($viewavaluosc->CurrentAction <> "gridadd")
		$viewavaluosc_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($viewavaluosc->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $viewavaluosc_list->FormKeyCountName ?>" id="<?php echo $viewavaluosc_list->FormKeyCountName ?>" value="<?php echo $viewavaluosc_list->KeyCount ?>">
<?php } ?>
<?php if ($viewavaluosc->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($viewavaluosc_list->Recordset)
	$viewavaluosc_list->Recordset->Close();
?>
<?php if ($viewavaluosc->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($viewavaluosc->CurrentAction <> "gridadd" && $viewavaluosc->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($viewavaluosc_list->Pager)) $viewavaluosc_list->Pager = new cNumericPager($viewavaluosc_list->StartRec, $viewavaluosc_list->DisplayRecs, $viewavaluosc_list->TotalRecs, $viewavaluosc_list->RecRange, $viewavaluosc_list->AutoHidePager) ?>
<?php if ($viewavaluosc_list->Pager->RecordCount > 0 && $viewavaluosc_list->Pager->Visible) { ?>
<div class="ewPager">
<div class="ewNumericPage"><ul class="pagination">
	<?php if ($viewavaluosc_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluosc_list->PageUrl() ?>start=<?php echo $viewavaluosc_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($viewavaluosc_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluosc_list->PageUrl() ?>start=<?php echo $viewavaluosc_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($viewavaluosc_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $viewavaluosc_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($viewavaluosc_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluosc_list->PageUrl() ?>start=<?php echo $viewavaluosc_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($viewavaluosc_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluosc_list->PageUrl() ?>start=<?php echo $viewavaluosc_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($viewavaluosc_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $viewavaluosc_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $viewavaluosc_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $viewavaluosc_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($viewavaluosc_list->TotalRecs > 0 && (!$viewavaluosc_list->AutoHidePageSizeSelector || $viewavaluosc_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="viewavaluosc">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($viewavaluosc_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($viewavaluosc_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($viewavaluosc_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($viewavaluosc->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewavaluosc_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($viewavaluosc_list->TotalRecs == 0 && $viewavaluosc->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewavaluosc_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($viewavaluosc->Export == "") { ?>
<script type="text/javascript">
fviewavaluosclistsrch.FilterList = <?php echo $viewavaluosc_list->GetFilterList() ?>;
fviewavaluosclistsrch.Init();
fviewavaluosclist.Init();
</script>
<?php } ?>
<?php
$viewavaluosc_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($viewavaluosc->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$viewavaluosc_list->Page_Terminate();
?>
