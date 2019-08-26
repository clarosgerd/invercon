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

$pago_avaluo_list = NULL; // Initialize page object first

class cpago_avaluo_list extends cpago_avaluo {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'pago_avaluo';

	// Page object name
	var $PageObjName = 'pago_avaluo_list';

	// Grid form hidden field names
	var $FormName = 'fpago_avaluolist';
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

		// Table object (pago_avaluo)
		if (!isset($GLOBALS["pago_avaluo"]) || get_class($GLOBALS["pago_avaluo"]) == "cpago_avaluo") {
			$GLOBALS["pago_avaluo"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["pago_avaluo"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "pago_avaluoadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "pago_avaluodelete.php";
		$this->MultiUpdateUrl = "pago_avaluoupdate.php";

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Table object (pago)
		if (!isset($GLOBALS['pago'])) $GLOBALS['pago'] = new cpago();

		// Table object (viewavaluosc)
		if (!isset($GLOBALS['viewavaluosc'])) $GLOBALS['viewavaluosc'] = new cviewavaluosc();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fpago_avaluolistsrch";

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
		$this->id->SetVisibility();
		if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
			$this->id->Visible = FALSE;
		$this->pago_id->SetVisibility();
		$this->avaluo_id->SetVisibility();
		$this->q->SetVisibility();

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

				// Switch to grid add mode
				if ($this->CurrentAction == "gridadd")
					$this->GridAddMode();
			} else {
				if (@$_POST["a_list"] <> "") {
					$this->CurrentAction = $_POST["a_list"]; // Get action

					// Grid Insert
					if ($this->CurrentAction == "gridinsert" && @$_SESSION[EW_SESSION_INLINE_MODE] == "gridadd") {
						if ($this->ValidateGridForm()) {
							$bGridInsert = $this->GridInsert();
						} else {
							$bGridInsert = FALSE;
							$this->setFailureMessage($gsFormError);
						}
						if (!$bGridInsert) {
							$this->EventCancelled = TRUE;
							$this->CurrentAction = "gridadd"; // Stay in Grid Add mode
						}
					}
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

			// Show grid delete link for grid add / grid edit
			if ($this->AllowAddDeleteRow) {
				if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
					$item = $this->ListOptions->GetItem("griddelete");
					if ($item) $item->Visible = TRUE;
				}
			}

			// Set up sorting order
			$this->SetupSortOrder();
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
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "pago") {
			global $pago;
			$rsmaster = $pago->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("pagolist.php"); // Return to master page
			} else {
				$pago->LoadListRowValues($rsmaster);
				$pago->RowType = EW_ROWTYPE_MASTER; // Master row
				$pago->RenderListRow();
				$rsmaster->Close();
			}
		}

		// Load master record
		if ($this->CurrentMode <> "add" && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "viewavaluosc") {
			global $viewavaluosc;
			$rsmaster = $viewavaluosc->LoadRs($this->DbMasterFilter);
			$this->MasterRecordExists = ($rsmaster && !$rsmaster->EOF);
			if (!$this->MasterRecordExists) {
				$this->setFailureMessage($Language->Phrase("NoRecord")); // Set no record found
				$this->Page_Terminate("viewavaluosclist.php"); // Return to master page
			} else {
				$viewavaluosc->LoadListRowValues($rsmaster);
				$viewavaluosc->RowType = EW_ROWTYPE_MASTER; // Master row
				$viewavaluosc->RenderListRow();
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
		$this->LastAction = $this->CurrentAction; // Save last action
		$this->CurrentAction = ""; // Clear action
		$_SESSION[EW_SESSION_INLINE_MODE] = ""; // Clear inline mode
	}

	// Switch to Grid Add mode
	function GridAddMode() {
		$_SESSION[EW_SESSION_INLINE_MODE] = "gridadd"; // Enabled grid add
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

	// Perform Grid Add
	function GridInsert() {
		global $Language, $objForm, $gsFormError;
		$rowindex = 1;
		$bGridInsert = FALSE;
		$conn = &$this->Connection();

		// Call Grid Inserting event
		if (!$this->Grid_Inserting()) {
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("GridAddCancelled")); // Set grid add cancelled message
			}
			return FALSE;
		}

		// Begin transaction
		$conn->BeginTrans();

		// Init key filter
		$sWrkFilter = "";
		$addcnt = 0;
		$sKey = "";

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Insert all rows
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "" && $rowaction <> "insert")
				continue; // Skip
			$this->LoadFormValues(); // Get form values
			if (!$this->EmptyRow()) {
				$addcnt++;
				$this->SendEmail = FALSE; // Do not send email on insert success

				// Validate form
				if (!$this->ValidateForm()) {
					$bGridInsert = FALSE; // Form error, reset action
					$this->setFailureMessage($gsFormError);
				} else {
					$bGridInsert = $this->AddRow($this->OldRecordset); // Insert this row
				}
				if ($bGridInsert) {
					if ($sKey <> "") $sKey .= $GLOBALS["EW_COMPOSITE_KEY_SEPARATOR"];
					$sKey .= $this->id->CurrentValue;

					// Add filter for this record
					$sFilter = $this->KeyFilter();
					if ($sWrkFilter <> "") $sWrkFilter .= " OR ";
					$sWrkFilter .= $sFilter;
				} else {
					break;
				}
			}
		}
		if ($addcnt == 0) { // No record inserted
			$this->setFailureMessage($Language->Phrase("NoAddRecord"));
			$bGridInsert = FALSE;
		}
		if ($bGridInsert) {
			$conn->CommitTrans(); // Commit transaction

			// Get new recordset
			$this->CurrentFilter = $sWrkFilter;
			$sSql = $this->SQL();
			if ($rs = $conn->Execute($sSql)) {
				$rsnew = $rs->GetRows();
				$rs->Close();
			}

			// Call Grid_Inserted event
			$this->Grid_Inserted($rsnew);
			if ($this->getSuccessMessage() == "")
				$this->setSuccessMessage($Language->Phrase("InsertSuccess")); // Set up insert success message
			$this->ClearInlineMode(); // Clear grid add mode
		} else {
			$conn->RollbackTrans(); // Rollback transaction
			if ($this->getFailureMessage() == "") {
				$this->setFailureMessage($Language->Phrase("InsertFailed")); // Set insert failed message
			}
		}
		return $bGridInsert;
	}

	// Check if empty row
	function EmptyRow() {
		global $objForm;
		if ($objForm->HasValue("x_pago_id") && $objForm->HasValue("o_pago_id") && $this->pago_id->CurrentValue <> $this->pago_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_avaluo_id") && $objForm->HasValue("o_avaluo_id") && $this->avaluo_id->CurrentValue <> $this->avaluo_id->OldValue)
			return FALSE;
		if ($objForm->HasValue("x_q") && $objForm->HasValue("o_q") && $this->q->CurrentValue <> $this->q->OldValue)
			return FALSE;
		return TRUE;
	}

	// Validate grid form
	function ValidateGridForm() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;

		// Validate all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else if (!$this->ValidateForm()) {
					return FALSE;
				}
			}
		}
		return TRUE;
	}

	// Get all form values of the grid
	function GetGridFormValues() {
		global $objForm;

		// Get row count
		$objForm->Index = -1;
		$rowcnt = strval($objForm->GetValue($this->FormKeyCountName));
		if ($rowcnt == "" || !is_numeric($rowcnt))
			$rowcnt = 0;
		$rows = array();

		// Loop through all records
		for ($rowindex = 1; $rowindex <= $rowcnt; $rowindex++) {

			// Load current row values
			$objForm->Index = $rowindex;
			$rowaction = strval($objForm->GetValue($this->FormActionName));
			if ($rowaction <> "delete" && $rowaction <> "insertdelete") {
				$this->LoadFormValues(); // Get form values
				if ($rowaction == "insert" && $this->EmptyRow()) {

					// Ignore
				} else {
					$rows[] = $this->GetFieldValues("FormValue"); // Return row as array
				}
			}
		}
		return $rows; // Return as array of array
	}

	// Restore form values for current row
	function RestoreCurrentRowFormValues($idx) {
		global $objForm;

		// Get row based on current index
		$objForm->Index = $idx;
		$this->LoadFormValues(); // Load form values
	}

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->id); // id
			$this->UpdateSort($this->pago_id); // pago_id
			$this->UpdateSort($this->avaluo_id); // avaluo_id
			$this->UpdateSort($this->q); // q
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

			// Reset master/detail keys
			if ($this->Command == "resetall") {
				$this->setCurrentMasterTable(""); // Clear master table
				$this->DbMasterFilter = "";
				$this->DbDetailFilter = "";
				$this->pago_id->setSessionValue("");
				$this->avaluo_id->setSessionValue("");
			}

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->setSessionOrderByList($sOrderBy);
				$this->id->setSort("");
				$this->pago_id->setSort("");
				$this->avaluo_id->setSort("");
				$this->q->setSort("");
			}

			// Reset start position
			$this->StartRec = 1;
			$this->setStartRecordNumber($this->StartRec);
		}
	}

	// Set up list options
	function SetupListOptions() {
		global $Security, $Language;

		// "griddelete"
		if ($this->AllowAddDeleteRow) {
			$item = &$this->ListOptions->Add("griddelete");
			$item->CssClass = "text-nowrap";
			$item->OnLeft = TRUE;
			$item->Visible = FALSE; // Default hidden
		}

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

		// "delete"
		$item = &$this->ListOptions->Add("delete");
		$item->CssClass = "text-nowrap";
		$item->Visible = $Security->CanDelete();
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

		// "delete"
		if ($this->AllowAddDeleteRow) {
			if ($this->CurrentAction == "gridadd" || $this->CurrentAction == "gridedit") {
				$option = &$this->ListOptions;
				$option->UseButtonGroup = TRUE; // Use button group for grid delete button
				$option->UseImageAndText = TRUE; // Use image and text for grid delete button
				$oListOpt = &$option->Items["griddelete"];
				if (!$Security->CanDelete() && is_numeric($this->RowIndex) && ($this->RowAction == "" || $this->RowAction == "edit")) { // Do not allow delete existing record
					$oListOpt->Body = "&nbsp;";
				} else {
					$oListOpt->Body = "<a class=\"ewGridLink ewGridDelete\" title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" onclick=\"return ew_DeleteGridRow(this, " . $this->RowIndex . ");\">" . $Language->Phrase("DeleteLink") . "</a>";
				}
			}
		}

		// "edit"
		$oListOpt = &$this->ListOptions->Items["edit"];
		$editcaption = ew_HtmlTitle($Language->Phrase("EditLink"));
		if ($Security->CanEdit()) {
			$oListOpt->Body = "<a class=\"ewRowLink ewEdit\" title=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("EditLink")) . "\" href=\"" . ew_HtmlEncode($this->EditUrl) . "\">" . $Language->Phrase("EditLink") . "</a>";
		} else {
			$oListOpt->Body = "";
		}

		// "delete"
		$oListOpt = &$this->ListOptions->Items["delete"];
		if ($Security->CanDelete())
			$oListOpt->Body = "<a class=\"ewRowLink ewDelete\"" . "" . " title=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("DeleteLink")) . "\" href=\"" . ew_HtmlEncode($this->DeleteUrl) . "\">" . $Language->Phrase("DeleteLink") . "</a>";
		else
			$oListOpt->Body = "";

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
		$option = $options["addedit"];

		// Add
		$item = &$option->Add("add");
		$addcaption = ew_HtmlTitle($Language->Phrase("AddLink"));
		if (ew_IsMobile())
			$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-caption=\"" . $addcaption . "\" href=\"" . ew_HtmlEncode($this->AddUrl) . "\">" . $Language->Phrase("AddLink") . "</a>";
		else
			$item->Body = "<a class=\"ewAddEdit ewAdd\" title=\"" . $addcaption . "\" data-table=\"pago_avaluo\" data-caption=\"" . $addcaption . "\" href=\"javascript:void(0);\" onclick=\"ew_ModalDialogShow({lnk:this,btn:'AddBtn',url:'" . ew_HtmlEncode($this->AddUrl) . "'});\">" . $Language->Phrase("AddLink") . "</a>";
		$item->Visible = ($this->AddUrl <> "" && $Security->CanAdd());
		$item = &$option->Add("gridadd");
		$item->Body = "<a class=\"ewAddEdit ewGridAdd\" title=\"" . ew_HtmlTitle($Language->Phrase("GridAddLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridAddLink")) . "\" href=\"" . ew_HtmlEncode($this->GridAddUrl) . "\">" . $Language->Phrase("GridAddLink") . "</a>";
		$item->Visible = ($this->GridAddUrl <> "" && $Security->CanAdd());
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fpago_avaluolistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fpago_avaluolistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
		$item->Visible = FALSE;
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
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "gridedit") { // Not grid add/edit mode
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fpago_avaluolist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		} else { // Grid add/edit mode

			// Hide all options first
			foreach ($options as &$option)
				$option->HideAllOptions();
			if ($this->CurrentAction == "gridadd") {
				if ($this->AllowAddDeleteRow) {

					// Add add blank row
					$option = &$options["addedit"];
					$option->UseDropDownButton = FALSE;
					$option->UseImageAndText = TRUE;
					$item = &$option->Add("addblankrow");
					$item->Body = "<a class=\"ewAddEdit ewAddBlankRow\" title=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("AddBlankRow")) . "\" href=\"javascript:void(0);\" onclick=\"ew_AddGridRow(this);\">" . $Language->Phrase("AddBlankRow") . "</a>";
					$item->Visible = $Security->CanAdd();
				}
				$option = &$options["action"];
				$option->UseDropDownButton = FALSE;
				$option->UseImageAndText = TRUE;

				// Add grid insert
				$item = &$option->Add("gridinsert");
				$item->Body = "<a class=\"ewAction ewGridInsert\" title=\"" . ew_HtmlTitle($Language->Phrase("GridInsertLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridInsertLink")) . "\" href=\"\" onclick=\"return ewForms(this).Submit('" . $this->PageName() . "');\">" . $Language->Phrase("GridInsertLink") . "</a>";

				// Add grid cancel
				$item = &$option->Add("gridcancel");
				$cancelurl = $this->AddMasterUrl($this->PageUrl() . "a=cancel");
				$item->Body = "<a class=\"ewAction ewGridCancel\" title=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" data-caption=\"" . ew_HtmlTitle($Language->Phrase("GridCancelLink")) . "\" href=\"" . $cancelurl . "\">" . $Language->Phrase("GridCancelLink") . "</a>";
			}
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
		if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->setFormValue($objForm->GetValue("x_id"));
		if (!$this->pago_id->FldIsDetailKey) {
			$this->pago_id->setFormValue($objForm->GetValue("x_pago_id"));
		}
		$this->pago_id->setOldValue($objForm->GetValue("o_pago_id"));
		if (!$this->avaluo_id->FldIsDetailKey) {
			$this->avaluo_id->setFormValue($objForm->GetValue("x_avaluo_id"));
		}
		$this->avaluo_id->setOldValue($objForm->GetValue("o_avaluo_id"));
		if (!$this->q->FldIsDetailKey) {
			$this->q->setFormValue($objForm->GetValue("x_q"));
		}
		$this->q->setOldValue($objForm->GetValue("o_q"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->CurrentValue = $this->id->FormValue;
		$this->pago_id->CurrentValue = $this->pago_id->FormValue;
		$this->avaluo_id->CurrentValue = $this->avaluo_id->FormValue;
		$this->q->CurrentValue = $this->q->FormValue;
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

			// id
			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";
			$this->id->TooltipValue = "";

			// pago_id
			$this->pago_id->LinkCustomAttributes = "";
			$this->pago_id->HrefValue = "";
			$this->pago_id->TooltipValue = "";

			// avaluo_id
			$this->avaluo_id->LinkCustomAttributes = "";
			$this->avaluo_id->HrefValue = "";
			$this->avaluo_id->TooltipValue = "";

			// q
			$this->q->LinkCustomAttributes = "";
			$this->q->HrefValue = "";
			$this->q->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// id
			// pago_id

			$this->pago_id->EditAttrs["class"] = "form-control";
			$this->pago_id->EditCustomAttributes = "";
			if ($this->pago_id->getSessionValue() <> "") {
				$this->pago_id->CurrentValue = $this->pago_id->getSessionValue();
				$this->pago_id->OldValue = $this->pago_id->CurrentValue;
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
				$this->avaluo_id->OldValue = $this->avaluo_id->CurrentValue;
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

			// q
			$this->q->EditAttrs["class"] = "form-control";
			$this->q->EditCustomAttributes = "";
			$this->q->EditValue = ew_HtmlEncode($this->q->CurrentValue);
			$this->q->PlaceHolder = ew_RemoveHtml($this->q->FldTitle());

			// Add refer script
			// id

			$this->id->LinkCustomAttributes = "";
			$this->id->HrefValue = "";

			// pago_id
			$this->pago_id->LinkCustomAttributes = "";
			$this->pago_id->HrefValue = "";

			// avaluo_id
			$this->avaluo_id->LinkCustomAttributes = "";
			$this->avaluo_id->HrefValue = "";

			// q
			$this->q->LinkCustomAttributes = "";
			$this->q->HrefValue = "";
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
		} else {
		}

		// Call Row Deleted event
		if ($DeleteRows) {
			foreach ($rsold as $row) {
				$this->Row_Deleted($row);
			}
		}
		return $DeleteRows;
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

		// q
		$this->q->SetDbValueDef($rsnew, $this->q->CurrentValue, NULL, FALSE);

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
		$item->Body = "<button id=\"emf_pago_avaluo\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_pago_avaluo',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fpago_avaluolist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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

		// Export master record
		if (EW_EXPORT_MASTER_RECORD && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "pago") {
			global $pago;
			if (!isset($pago)) $pago = new cpago;
			$rsmaster = $pago->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$ExportStyle = $Doc->Style;
				$Doc->SetStyle("v"); // Change to vertical
				if ($this->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
					$Doc->Table = &$pago;
					$pago->ExportDocument($Doc, $rsmaster, 1, 1);
					$Doc->ExportEmptyRow();
					$Doc->Table = &$this;
				}
				$Doc->SetStyle($ExportStyle); // Restore
				$rsmaster->Close();
			}
		}

		// Export master record
		if (EW_EXPORT_MASTER_RECORD && $this->GetMasterFilter() <> "" && $this->getCurrentMasterTable() == "viewavaluosc") {
			global $viewavaluosc;
			if (!isset($viewavaluosc)) $viewavaluosc = new cviewavaluosc;
			$rsmaster = $viewavaluosc->LoadRs($this->DbMasterFilter); // Load master record
			if ($rsmaster && !$rsmaster->EOF) {
				$ExportStyle = $Doc->Style;
				$Doc->SetStyle("v"); // Change to vertical
				if ($this->Export <> "csv" || EW_EXPORT_MASTER_RECORD_FOR_CSV) {
					$Doc->Table = &$viewavaluosc;
					$viewavaluosc->ExportDocument($Doc, $rsmaster, 1, 1);
					$Doc->ExportEmptyRow();
					$Doc->Table = &$this;
				}
				$Doc->SetStyle($ExportStyle); // Restore
				$rsmaster->Close();
			}
		}
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
		$url = preg_replace('/\?cmd=reset(all){0,1}$/i', '', $url); // Remove cmd=reset / cmd=resetall
		$Breadcrumb->Add("list", $this->TableVar, $url, "", $this->TableVar, TRUE);
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
if (!isset($pago_avaluo_list)) $pago_avaluo_list = new cpago_avaluo_list();

// Page init
$pago_avaluo_list->Page_Init();

// Page main
$pago_avaluo_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pago_avaluo_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($pago_avaluo->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fpago_avaluolist = new ew_Form("fpago_avaluolist", "list");
fpago_avaluolist.FormKeyCountName = '<?php echo $pago_avaluo_list->FormKeyCountName ?>';

// Validate form
fpago_avaluolist.Validate = function() {
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
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	if (gridinsert && addcnt == 0) { // No row added
		ew_Alert(ewLanguage.Phrase("NoAddRecord"));
		return false;
	}
	return true;
}

// Check empty row
fpago_avaluolist.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "pago_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "avaluo_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "q", false)) return false;
	return true;
}

// Form_CustomValidate event
fpago_avaluolist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpago_avaluolist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpago_avaluolist.Lists["x_pago_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_id","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"pago"};
fpago_avaluolist.Lists["x_pago_id"].Data = "<?php echo $pago_avaluo_list->pago_id->LookupFilterQuery(FALSE, "list") ?>";
fpago_avaluolist.Lists["x_avaluo_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_id","x_codigoavaluo","x_id_oficialcredito","x_tipoinmueble"],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"avaluo"};
fpago_avaluolist.Lists["x_avaluo_id"].Data = "<?php echo $pago_avaluo_list->avaluo_id->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($pago_avaluo->Export == "") { ?>
<div class="ewToolbar">
<?php if ($pago_avaluo_list->TotalRecs > 0 && $pago_avaluo_list->ExportOptions->Visible()) { ?>
<?php $pago_avaluo_list->ExportOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php if (($pago_avaluo->Export == "") || (EW_EXPORT_MASTER_RECORD && $pago_avaluo->Export == "print")) { ?>
<?php
if ($pago_avaluo_list->DbMasterFilter <> "" && $pago_avaluo->getCurrentMasterTable() == "pago") {
	if ($pago_avaluo_list->MasterRecordExists) {
?>
<?php include_once "pagomaster.php" ?>
<?php
	}
}
?>
<?php
if ($pago_avaluo_list->DbMasterFilter <> "" && $pago_avaluo->getCurrentMasterTable() == "viewavaluosc") {
	if ($pago_avaluo_list->MasterRecordExists) {
?>
<?php include_once "viewavaluoscmaster.php" ?>
<?php
	}
}
?>
<?php } ?>
<?php
if ($pago_avaluo->CurrentAction == "gridadd") {
	$pago_avaluo->CurrentFilter = "0=1";
	$pago_avaluo_list->StartRec = 1;
	$pago_avaluo_list->DisplayRecs = $pago_avaluo->GridAddRowCount;
	$pago_avaluo_list->TotalRecs = $pago_avaluo_list->DisplayRecs;
	$pago_avaluo_list->StopRec = $pago_avaluo_list->DisplayRecs;
} else {
	$bSelectLimit = $pago_avaluo_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($pago_avaluo_list->TotalRecs <= 0)
			$pago_avaluo_list->TotalRecs = $pago_avaluo->ListRecordCount();
	} else {
		if (!$pago_avaluo_list->Recordset && ($pago_avaluo_list->Recordset = $pago_avaluo_list->LoadRecordset()))
			$pago_avaluo_list->TotalRecs = $pago_avaluo_list->Recordset->RecordCount();
	}
	$pago_avaluo_list->StartRec = 1;
	if ($pago_avaluo_list->DisplayRecs <= 0 || ($pago_avaluo->Export <> "" && $pago_avaluo->ExportAll)) // Display all records
		$pago_avaluo_list->DisplayRecs = $pago_avaluo_list->TotalRecs;
	if (!($pago_avaluo->Export <> "" && $pago_avaluo->ExportAll))
		$pago_avaluo_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$pago_avaluo_list->Recordset = $pago_avaluo_list->LoadRecordset($pago_avaluo_list->StartRec-1, $pago_avaluo_list->DisplayRecs);

	// Set no record found message
	if ($pago_avaluo->CurrentAction == "" && $pago_avaluo_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$pago_avaluo_list->setWarningMessage(ew_DeniedMsg());
		if ($pago_avaluo_list->SearchWhere == "0=101")
			$pago_avaluo_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$pago_avaluo_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$pago_avaluo_list->RenderOtherOptions();
?>
<?php $pago_avaluo_list->ShowPageHeader(); ?>
<?php
$pago_avaluo_list->ShowMessage();
?>
<?php if ($pago_avaluo_list->TotalRecs > 0 || $pago_avaluo->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($pago_avaluo_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> pago_avaluo">
<form name="fpago_avaluolist" id="fpago_avaluolist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($pago_avaluo_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $pago_avaluo_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="pago_avaluo">
<?php if ($pago_avaluo->getCurrentMasterTable() == "pago" && $pago_avaluo->CurrentAction <> "") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="pago">
<input type="hidden" name="fk_id" value="<?php echo $pago_avaluo->pago_id->getSessionValue() ?>">
<?php } ?>
<?php if ($pago_avaluo->getCurrentMasterTable() == "viewavaluosc" && $pago_avaluo->CurrentAction <> "") { ?>
<input type="hidden" name="<?php echo EW_TABLE_SHOW_MASTER ?>" value="viewavaluosc">
<input type="hidden" name="fk_id" value="<?php echo $pago_avaluo->avaluo_id->getSessionValue() ?>">
<?php } ?>
<div id="gmp_pago_avaluo" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($pago_avaluo_list->TotalRecs > 0 || $pago_avaluo->CurrentAction == "gridedit") { ?>
<table id="tbl_pago_avaluolist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$pago_avaluo_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$pago_avaluo_list->RenderListOptions();

// Render list options (header, left)
$pago_avaluo_list->ListOptions->Render("header", "left");
?>
<?php if ($pago_avaluo->id->Visible) { // id ?>
	<?php if ($pago_avaluo->SortUrl($pago_avaluo->id) == "") { ?>
		<th data-name="id" class="<?php echo $pago_avaluo->id->HeaderCellClass() ?>"><div id="elh_pago_avaluo_id" class="pago_avaluo_id"><div class="ewTableHeaderCaption"><?php echo $pago_avaluo->id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $pago_avaluo->id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pago_avaluo->SortUrl($pago_avaluo->id) ?>',1);"><div id="elh_pago_avaluo_id" class="pago_avaluo_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago_avaluo->id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago_avaluo->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago_avaluo->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago_avaluo->pago_id->Visible) { // pago_id ?>
	<?php if ($pago_avaluo->SortUrl($pago_avaluo->pago_id) == "") { ?>
		<th data-name="pago_id" class="<?php echo $pago_avaluo->pago_id->HeaderCellClass() ?>"><div id="elh_pago_avaluo_pago_id" class="pago_avaluo_pago_id"><div class="ewTableHeaderCaption"><?php echo $pago_avaluo->pago_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pago_id" class="<?php echo $pago_avaluo->pago_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pago_avaluo->SortUrl($pago_avaluo->pago_id) ?>',1);"><div id="elh_pago_avaluo_pago_id" class="pago_avaluo_pago_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago_avaluo->pago_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago_avaluo->pago_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago_avaluo->pago_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago_avaluo->avaluo_id->Visible) { // avaluo_id ?>
	<?php if ($pago_avaluo->SortUrl($pago_avaluo->avaluo_id) == "") { ?>
		<th data-name="avaluo_id" class="<?php echo $pago_avaluo->avaluo_id->HeaderCellClass() ?>"><div id="elh_pago_avaluo_avaluo_id" class="pago_avaluo_avaluo_id"><div class="ewTableHeaderCaption"><?php echo $pago_avaluo->avaluo_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="avaluo_id" class="<?php echo $pago_avaluo->avaluo_id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pago_avaluo->SortUrl($pago_avaluo->avaluo_id) ?>',1);"><div id="elh_pago_avaluo_avaluo_id" class="pago_avaluo_avaluo_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago_avaluo->avaluo_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago_avaluo->avaluo_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago_avaluo->avaluo_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago_avaluo->q->Visible) { // q ?>
	<?php if ($pago_avaluo->SortUrl($pago_avaluo->q) == "") { ?>
		<th data-name="q" class="<?php echo $pago_avaluo->q->HeaderCellClass() ?>"><div id="elh_pago_avaluo_q" class="pago_avaluo_q"><div class="ewTableHeaderCaption"><?php echo $pago_avaluo->q->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="q" class="<?php echo $pago_avaluo->q->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $pago_avaluo->SortUrl($pago_avaluo->q) ?>',1);"><div id="elh_pago_avaluo_q" class="pago_avaluo_q">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago_avaluo->q->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago_avaluo->q->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago_avaluo->q->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pago_avaluo_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($pago_avaluo->ExportAll && $pago_avaluo->Export <> "") {
	$pago_avaluo_list->StopRec = $pago_avaluo_list->TotalRecs;
} else {

	// Set the last record to display
	if ($pago_avaluo_list->TotalRecs > $pago_avaluo_list->StartRec + $pago_avaluo_list->DisplayRecs - 1)
		$pago_avaluo_list->StopRec = $pago_avaluo_list->StartRec + $pago_avaluo_list->DisplayRecs - 1;
	else
		$pago_avaluo_list->StopRec = $pago_avaluo_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($pago_avaluo_list->FormKeyCountName) && ($pago_avaluo->CurrentAction == "gridadd" || $pago_avaluo->CurrentAction == "gridedit" || $pago_avaluo->CurrentAction == "F")) {
		$pago_avaluo_list->KeyCount = $objForm->GetValue($pago_avaluo_list->FormKeyCountName);
		$pago_avaluo_list->StopRec = $pago_avaluo_list->StartRec + $pago_avaluo_list->KeyCount - 1;
	}
}
$pago_avaluo_list->RecCnt = $pago_avaluo_list->StartRec - 1;
if ($pago_avaluo_list->Recordset && !$pago_avaluo_list->Recordset->EOF) {
	$pago_avaluo_list->Recordset->MoveFirst();
	$bSelectLimit = $pago_avaluo_list->UseSelectLimit;
	if (!$bSelectLimit && $pago_avaluo_list->StartRec > 1)
		$pago_avaluo_list->Recordset->Move($pago_avaluo_list->StartRec - 1);
} elseif (!$pago_avaluo->AllowAddDeleteRow && $pago_avaluo_list->StopRec == 0) {
	$pago_avaluo_list->StopRec = $pago_avaluo->GridAddRowCount;
}

// Initialize aggregate
$pago_avaluo->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pago_avaluo->ResetAttrs();
$pago_avaluo_list->RenderRow();
if ($pago_avaluo->CurrentAction == "gridadd")
	$pago_avaluo_list->RowIndex = 0;
while ($pago_avaluo_list->RecCnt < $pago_avaluo_list->StopRec) {
	$pago_avaluo_list->RecCnt++;
	if (intval($pago_avaluo_list->RecCnt) >= intval($pago_avaluo_list->StartRec)) {
		$pago_avaluo_list->RowCnt++;
		if ($pago_avaluo->CurrentAction == "gridadd" || $pago_avaluo->CurrentAction == "gridedit" || $pago_avaluo->CurrentAction == "F") {
			$pago_avaluo_list->RowIndex++;
			$objForm->Index = $pago_avaluo_list->RowIndex;
			if ($objForm->HasValue($pago_avaluo_list->FormActionName))
				$pago_avaluo_list->RowAction = strval($objForm->GetValue($pago_avaluo_list->FormActionName));
			elseif ($pago_avaluo->CurrentAction == "gridadd")
				$pago_avaluo_list->RowAction = "insert";
			else
				$pago_avaluo_list->RowAction = "";
		}

		// Set up key count
		$pago_avaluo_list->KeyCount = $pago_avaluo_list->RowIndex;

		// Init row class and style
		$pago_avaluo->ResetAttrs();
		$pago_avaluo->CssClass = "";
		if ($pago_avaluo->CurrentAction == "gridadd") {
			$pago_avaluo_list->LoadRowValues(); // Load default values
		} else {
			$pago_avaluo_list->LoadRowValues($pago_avaluo_list->Recordset); // Load row values
		}
		$pago_avaluo->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($pago_avaluo->CurrentAction == "gridadd") // Grid add
			$pago_avaluo->RowType = EW_ROWTYPE_ADD; // Render add
		if ($pago_avaluo->CurrentAction == "gridadd" && $pago_avaluo->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$pago_avaluo_list->RestoreCurrentRowFormValues($pago_avaluo_list->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$pago_avaluo->RowAttrs = array_merge($pago_avaluo->RowAttrs, array('data-rowindex'=>$pago_avaluo_list->RowCnt, 'id'=>'r' . $pago_avaluo_list->RowCnt . '_pago_avaluo', 'data-rowtype'=>$pago_avaluo->RowType));

		// Render row
		$pago_avaluo_list->RenderRow();

		// Render list options
		$pago_avaluo_list->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($pago_avaluo_list->RowAction <> "delete" && $pago_avaluo_list->RowAction <> "insertdelete" && !($pago_avaluo_list->RowAction == "insert" && $pago_avaluo->CurrentAction == "F" && $pago_avaluo_list->EmptyRow())) {
?>
	<tr<?php echo $pago_avaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pago_avaluo_list->ListOptions->Render("body", "left", $pago_avaluo_list->RowCnt);
?>
	<?php if ($pago_avaluo->id->Visible) { // id ?>
		<td data-name="id"<?php echo $pago_avaluo->id->CellAttributes() ?>>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_id" name="o<?php echo $pago_avaluo_list->RowIndex ?>_id" id="o<?php echo $pago_avaluo_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago_avaluo->id->OldValue) ?>">
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_avaluo_list->RowCnt ?>_pago_avaluo_id" class="pago_avaluo_id">
<span<?php echo $pago_avaluo->id->ViewAttributes() ?>>
<?php echo $pago_avaluo->id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago_avaluo->pago_id->Visible) { // pago_id ?>
		<td data-name="pago_id"<?php echo $pago_avaluo->pago_id->CellAttributes() ?>>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($pago_avaluo->pago_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $pago_avaluo_list->RowCnt ?>_pago_avaluo_pago_id" class="form-group pago_avaluo_pago_id">
<span<?php echo $pago_avaluo->pago_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->pago_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_avaluo_list->RowIndex ?>_pago_id" name="x<?php echo $pago_avaluo_list->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pago_avaluo_list->RowCnt ?>_pago_avaluo_pago_id" class="form-group pago_avaluo_pago_id">
<select data-table="pago_avaluo" data-field="x_pago_id" data-value-separator="<?php echo $pago_avaluo->pago_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $pago_avaluo_list->RowIndex ?>_pago_id" name="x<?php echo $pago_avaluo_list->RowIndex ?>_pago_id"<?php echo $pago_avaluo->pago_id->EditAttributes() ?>>
<?php echo $pago_avaluo->pago_id->SelectOptionListHtml("x<?php echo $pago_avaluo_list->RowIndex ?>_pago_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_pago_id" name="o<?php echo $pago_avaluo_list->RowIndex ?>_pago_id" id="o<?php echo $pago_avaluo_list->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->OldValue) ?>">
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_avaluo_list->RowCnt ?>_pago_avaluo_pago_id" class="pago_avaluo_pago_id">
<span<?php echo $pago_avaluo->pago_id->ViewAttributes() ?>>
<?php echo $pago_avaluo->pago_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago_avaluo->avaluo_id->Visible) { // avaluo_id ?>
		<td data-name="avaluo_id"<?php echo $pago_avaluo->avaluo_id->CellAttributes() ?>>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($pago_avaluo->avaluo_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $pago_avaluo_list->RowCnt ?>_pago_avaluo_avaluo_id" class="form-group pago_avaluo_avaluo_id">
<span<?php echo $pago_avaluo->avaluo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->avaluo_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id" name="x<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pago_avaluo_list->RowCnt ?>_pago_avaluo_avaluo_id" class="form-group pago_avaluo_avaluo_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id"><?php echo (strval($pago_avaluo->avaluo_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $pago_avaluo->avaluo_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pago_avaluo->avaluo_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($pago_avaluo->avaluo_id->ReadOnly || $pago_avaluo->avaluo_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pago_avaluo->avaluo_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id" id="x<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id" value="<?php echo $pago_avaluo->avaluo_id->CurrentValue ?>"<?php echo $pago_avaluo->avaluo_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" name="o<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id" id="o<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->OldValue) ?>">
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_avaluo_list->RowCnt ?>_pago_avaluo_avaluo_id" class="pago_avaluo_avaluo_id">
<span<?php echo $pago_avaluo->avaluo_id->ViewAttributes() ?>>
<?php echo $pago_avaluo->avaluo_id->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago_avaluo->q->Visible) { // q ?>
		<td data-name="q"<?php echo $pago_avaluo->q->CellAttributes() ?>>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pago_avaluo_list->RowCnt ?>_pago_avaluo_q" class="form-group pago_avaluo_q">
<input type="text" data-table="pago_avaluo" data-field="x_q" name="x<?php echo $pago_avaluo_list->RowIndex ?>_q" id="x<?php echo $pago_avaluo_list->RowIndex ?>_q" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->q->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->q->EditValue ?>"<?php echo $pago_avaluo->q->EditAttributes() ?>>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_q" name="o<?php echo $pago_avaluo_list->RowIndex ?>_q" id="o<?php echo $pago_avaluo_list->RowIndex ?>_q" value="<?php echo ew_HtmlEncode($pago_avaluo->q->OldValue) ?>">
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_avaluo_list->RowCnt ?>_pago_avaluo_q" class="pago_avaluo_q">
<span<?php echo $pago_avaluo->q->ViewAttributes() ?>>
<?php echo $pago_avaluo->q->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pago_avaluo_list->ListOptions->Render("body", "right", $pago_avaluo_list->RowCnt);
?>
	</tr>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD || $pago_avaluo->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fpago_avaluolist.UpdateOpts(<?php echo $pago_avaluo_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($pago_avaluo->CurrentAction <> "gridadd")
		if (!$pago_avaluo_list->Recordset->EOF) $pago_avaluo_list->Recordset->MoveNext();
}
?>
<?php
	if ($pago_avaluo->CurrentAction == "gridadd" || $pago_avaluo->CurrentAction == "gridedit") {
		$pago_avaluo_list->RowIndex = '$rowindex$';
		$pago_avaluo_list->LoadRowValues();

		// Set row properties
		$pago_avaluo->ResetAttrs();
		$pago_avaluo->RowAttrs = array_merge($pago_avaluo->RowAttrs, array('data-rowindex'=>$pago_avaluo_list->RowIndex, 'id'=>'r0_pago_avaluo', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($pago_avaluo->RowAttrs["class"], "ewTemplate");
		$pago_avaluo->RowType = EW_ROWTYPE_ADD;

		// Render row
		$pago_avaluo_list->RenderRow();

		// Render list options
		$pago_avaluo_list->RenderListOptions();
		$pago_avaluo_list->StartRowCnt = 0;
?>
	<tr<?php echo $pago_avaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pago_avaluo_list->ListOptions->Render("body", "left", $pago_avaluo_list->RowIndex);
?>
	<?php if ($pago_avaluo->id->Visible) { // id ?>
		<td data-name="id">
<input type="hidden" data-table="pago_avaluo" data-field="x_id" name="o<?php echo $pago_avaluo_list->RowIndex ?>_id" id="o<?php echo $pago_avaluo_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago_avaluo->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago_avaluo->pago_id->Visible) { // pago_id ?>
		<td data-name="pago_id">
<?php if ($pago_avaluo->pago_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_pago_avaluo_pago_id" class="form-group pago_avaluo_pago_id">
<span<?php echo $pago_avaluo->pago_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->pago_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_avaluo_list->RowIndex ?>_pago_id" name="x<?php echo $pago_avaluo_list->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_pago_avaluo_pago_id" class="form-group pago_avaluo_pago_id">
<select data-table="pago_avaluo" data-field="x_pago_id" data-value-separator="<?php echo $pago_avaluo->pago_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $pago_avaluo_list->RowIndex ?>_pago_id" name="x<?php echo $pago_avaluo_list->RowIndex ?>_pago_id"<?php echo $pago_avaluo->pago_id->EditAttributes() ?>>
<?php echo $pago_avaluo->pago_id->SelectOptionListHtml("x<?php echo $pago_avaluo_list->RowIndex ?>_pago_id") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_pago_id" name="o<?php echo $pago_avaluo_list->RowIndex ?>_pago_id" id="o<?php echo $pago_avaluo_list->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago_avaluo->avaluo_id->Visible) { // avaluo_id ?>
		<td data-name="avaluo_id">
<?php if ($pago_avaluo->avaluo_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_pago_avaluo_avaluo_id" class="form-group pago_avaluo_avaluo_id">
<span<?php echo $pago_avaluo->avaluo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->avaluo_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id" name="x<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_pago_avaluo_avaluo_id" class="form-group pago_avaluo_avaluo_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id"><?php echo (strval($pago_avaluo->avaluo_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $pago_avaluo->avaluo_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pago_avaluo->avaluo_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($pago_avaluo->avaluo_id->ReadOnly || $pago_avaluo->avaluo_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pago_avaluo->avaluo_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id" id="x<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id" value="<?php echo $pago_avaluo->avaluo_id->CurrentValue ?>"<?php echo $pago_avaluo->avaluo_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" name="o<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id" id="o<?php echo $pago_avaluo_list->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago_avaluo->q->Visible) { // q ?>
		<td data-name="q">
<span id="el$rowindex$_pago_avaluo_q" class="form-group pago_avaluo_q">
<input type="text" data-table="pago_avaluo" data-field="x_q" name="x<?php echo $pago_avaluo_list->RowIndex ?>_q" id="x<?php echo $pago_avaluo_list->RowIndex ?>_q" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->q->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->q->EditValue ?>"<?php echo $pago_avaluo->q->EditAttributes() ?>>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_q" name="o<?php echo $pago_avaluo_list->RowIndex ?>_q" id="o<?php echo $pago_avaluo_list->RowIndex ?>_q" value="<?php echo ew_HtmlEncode($pago_avaluo->q->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pago_avaluo_list->ListOptions->Render("body", "right", $pago_avaluo_list->RowIndex);
?>
<script type="text/javascript">
fpago_avaluolist.UpdateOpts(<?php echo $pago_avaluo_list->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($pago_avaluo->CurrentAction == "gridadd") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $pago_avaluo_list->FormKeyCountName ?>" id="<?php echo $pago_avaluo_list->FormKeyCountName ?>" value="<?php echo $pago_avaluo_list->KeyCount ?>">
<?php echo $pago_avaluo_list->MultiSelectKey ?>
<?php } ?>
<?php if ($pago_avaluo->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($pago_avaluo_list->Recordset)
	$pago_avaluo_list->Recordset->Close();
?>
<?php if ($pago_avaluo->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($pago_avaluo->CurrentAction <> "gridadd" && $pago_avaluo->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($pago_avaluo_list->Pager)) $pago_avaluo_list->Pager = new cNumericPager($pago_avaluo_list->StartRec, $pago_avaluo_list->DisplayRecs, $pago_avaluo_list->TotalRecs, $pago_avaluo_list->RecRange, $pago_avaluo_list->AutoHidePager) ?>
<?php if ($pago_avaluo_list->Pager->RecordCount > 0 && $pago_avaluo_list->Pager->Visible) { ?>
<div class="ewPager">
<div class="ewNumericPage"><ul class="pagination">
	<?php if ($pago_avaluo_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $pago_avaluo_list->PageUrl() ?>start=<?php echo $pago_avaluo_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($pago_avaluo_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $pago_avaluo_list->PageUrl() ?>start=<?php echo $pago_avaluo_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($pago_avaluo_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $pago_avaluo_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($pago_avaluo_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $pago_avaluo_list->PageUrl() ?>start=<?php echo $pago_avaluo_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($pago_avaluo_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $pago_avaluo_list->PageUrl() ?>start=<?php echo $pago_avaluo_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($pago_avaluo_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $pago_avaluo_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $pago_avaluo_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $pago_avaluo_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($pago_avaluo_list->TotalRecs > 0 && (!$pago_avaluo_list->AutoHidePageSizeSelector || $pago_avaluo_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="pago_avaluo">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($pago_avaluo_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($pago_avaluo_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($pago_avaluo_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($pago_avaluo->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($pago_avaluo_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($pago_avaluo_list->TotalRecs == 0 && $pago_avaluo->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($pago_avaluo_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($pago_avaluo->Export == "") { ?>
<script type="text/javascript">
fpago_avaluolist.Init();
</script>
<?php } ?>
<?php
$pago_avaluo_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($pago_avaluo->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$pago_avaluo_list->Page_Terminate();
?>
