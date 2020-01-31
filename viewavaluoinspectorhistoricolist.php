<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "viewavaluoinspectorhistoricoinfo.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$viewavaluoinspectorhistorico_list = NULL; // Initialize page object first

class cviewavaluoinspectorhistorico_list extends cviewavaluoinspectorhistorico {

	// Page ID
	var $PageID = 'list';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'viewavaluoinspectorhistorico';

	// Page object name
	var $PageObjName = 'viewavaluoinspectorhistorico_list';

	// Grid form hidden field names
	var $FormName = 'fviewavaluoinspectorhistoricolist';
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

		// Table object (viewavaluoinspectorhistorico)
		if (!isset($GLOBALS["viewavaluoinspectorhistorico"]) || get_class($GLOBALS["viewavaluoinspectorhistorico"]) == "cviewavaluoinspectorhistorico") {
			$GLOBALS["viewavaluoinspectorhistorico"] = &$this;
			$GLOBALS["Table"] = &$GLOBALS["viewavaluoinspectorhistorico"];
		}

		// Initialize URLs
		$this->ExportPrintUrl = $this->PageUrl() . "export=print";
		$this->ExportExcelUrl = $this->PageUrl() . "export=excel";
		$this->ExportWordUrl = $this->PageUrl() . "export=word";
		$this->ExportHtmlUrl = $this->PageUrl() . "export=html";
		$this->ExportXmlUrl = $this->PageUrl() . "export=xml";
		$this->ExportCsvUrl = $this->PageUrl() . "export=csv";
		$this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
		$this->AddUrl = "viewavaluoinspectorhistoricoadd.php";
		$this->InlineAddUrl = $this->PageUrl() . "a=add";
		$this->GridAddUrl = $this->PageUrl() . "a=gridadd";
		$this->GridEditUrl = $this->PageUrl() . "a=gridedit";
		$this->MultiDeleteUrl = "viewavaluoinspectorhistoricodelete.php";
		$this->MultiUpdateUrl = "viewavaluoinspectorhistoricoupdate.php";

		// Table object (usuario)
		if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'list', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'viewavaluoinspectorhistorico', TRUE);

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
		$this->FilterOptions->TagClassName = "ewFilterOption fviewavaluoinspectorhistoricolistsrch";

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
		$this->id_solicitud->SetVisibility();
		$this->id_oficialcredito->SetVisibility();
		$this->id_inspector->SetVisibility();
		$this->id_cliente->SetVisibility();
		$this->estado->SetVisibility();
		$this->estadointerno->SetVisibility();
		$this->estadopago->SetVisibility();
		$this->fecha_avaluo->SetVisibility();
		$this->comentario->SetVisibility();
		$this->id_sucursal->SetVisibility();

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
		global $EW_EXPORT, $viewavaluoinspectorhistorico;
		if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
				$sContent = ob_get_contents();
			if ($gsExportFile == "") $gsExportFile = $this->TableVar;
			$class = $EW_EXPORT[$this->CustomExport];
			if (class_exists($class)) {
				$doc = new $class($viewavaluoinspectorhistorico);
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

	// Set up sort parameters
	function SetupSortOrder() {

		// Check for "order" parameter
		if (@$_GET["order"] <> "") {
			$this->CurrentOrder = @$_GET["order"];
			$this->CurrentOrderType = @$_GET["ordertype"];
			$this->UpdateSort($this->id_solicitud); // id_solicitud
			$this->UpdateSort($this->id_oficialcredito); // id_oficialcredito
			$this->UpdateSort($this->id_inspector); // id_inspector
			$this->UpdateSort($this->id_cliente); // id_cliente
			$this->UpdateSort($this->estado); // estado
			$this->UpdateSort($this->estadointerno); // estadointerno
			$this->UpdateSort($this->estadopago); // estadopago
			$this->UpdateSort($this->fecha_avaluo); // fecha_avaluo
			$this->UpdateSort($this->comentario); // comentario
			$this->UpdateSort($this->id_sucursal); // id_sucursal
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

			// Reset sorting order
			if ($this->Command == "resetsort") {
				$sOrderBy = "";
				$this->setSessionOrderBy($sOrderBy);
				$this->setSessionOrderByList($sOrderBy);
				$this->id_solicitud->setSort("");
				$this->id_oficialcredito->setSort("");
				$this->id_inspector->setSort("");
				$this->id_cliente->setSort("");
				$this->estado->setSort("");
				$this->estadointerno->setSort("");
				$this->estadopago->setSort("");
				$this->fecha_avaluo->setSort("");
				$this->comentario->setSort("");
				$this->id_sucursal->setSort("");
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
		$item->Body = "<a class=\"ewSaveFilter\" data-form=\"fviewavaluoinspectorhistoricolistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
		$item->Visible = FALSE;
		$item = &$this->FilterOptions->Add("deletefilter");
		$item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fviewavaluoinspectorhistoricolistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
			$option = &$options["action"];

			// Set up list action buttons
			foreach ($this->ListActions->Items as $listaction) {
				if ($listaction->Select == EW_ACTION_MULTIPLE) {
					$item = &$option->Add("custom_" . $listaction->Action);
					$caption = $listaction->Caption;
					$icon = ($listaction->Icon <> "") ? "<span class=\"" . ew_HtmlEncode($listaction->Icon) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\"></span> " : $caption;
					$item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fviewavaluoinspectorhistoricolist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
		$this->tipoinmueble->CurrentValue = NULL;
		$this->tipoinmueble->OldValue = $this->tipoinmueble->CurrentValue;
		$this->codigoavaluo->CurrentValue = NULL;
		$this->codigoavaluo->OldValue = $this->codigoavaluo->CurrentValue;
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
		$this->comentario->CurrentValue = NULL;
		$this->comentario->OldValue = $this->comentario->CurrentValue;
		$this->id_sucursal->CurrentValue = NULL;
		$this->id_sucursal->OldValue = $this->id_sucursal->CurrentValue;
	}

	// Load form values
	function LoadFormValues() {

		// Load from form
		global $objForm;
		if (!$this->id_solicitud->FldIsDetailKey) {
			$this->id_solicitud->setFormValue($objForm->GetValue("x_id_solicitud"));
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
		if (!$this->estado->FldIsDetailKey) {
			$this->estado->setFormValue($objForm->GetValue("x_estado"));
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
		if (!$this->comentario->FldIsDetailKey) {
			$this->comentario->setFormValue($objForm->GetValue("x_comentario"));
		}
		if (!$this->id_sucursal->FldIsDetailKey) {
			$this->id_sucursal->setFormValue($objForm->GetValue("x_id_sucursal"));
		}
		if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->setFormValue($objForm->GetValue("x_id"));
	}

	// Restore form values
	function RestoreFormValues() {
		global $objForm;
		if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
			$this->id->CurrentValue = $this->id->FormValue;
		$this->id_solicitud->CurrentValue = $this->id_solicitud->FormValue;
		$this->id_oficialcredito->CurrentValue = $this->id_oficialcredito->FormValue;
		$this->id_inspector->CurrentValue = $this->id_inspector->FormValue;
		$this->id_cliente->CurrentValue = $this->id_cliente->FormValue;
		$this->estado->CurrentValue = $this->estado->FormValue;
		$this->estadointerno->CurrentValue = $this->estadointerno->FormValue;
		$this->estadopago->CurrentValue = $this->estadopago->FormValue;
		$this->fecha_avaluo->CurrentValue = $this->fecha_avaluo->FormValue;
		$this->fecha_avaluo->CurrentValue = ew_UnFormatDateTime($this->fecha_avaluo->CurrentValue, 10);
		$this->comentario->CurrentValue = $this->comentario->FormValue;
		$this->id_sucursal->CurrentValue = $this->id_sucursal->FormValue;
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
		$this->tipoinmueble->setDbValue($row['tipoinmueble']);
		$this->codigoavaluo->setDbValue($row['codigoavaluo']);
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
		$this->comentario->setDbValue($row['comentario']);
		$this->id_sucursal->setDbValue($row['id_sucursal']);
	}

	// Return a row with default values
	function NewRow() {
		$this->LoadDefaultValues();
		$row = array();
		$row['id'] = $this->id->CurrentValue;
		$row['tipoinmueble'] = $this->tipoinmueble->CurrentValue;
		$row['codigoavaluo'] = $this->codigoavaluo->CurrentValue;
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
		$row['comentario'] = $this->comentario->CurrentValue;
		$row['id_sucursal'] = $this->id_sucursal->CurrentValue;
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
		$this->comentario->DbValue = $row['comentario'];
		$this->id_sucursal->DbValue = $row['id_sucursal'];
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
		$this->tipoinmueble->CellCssStyle = "white-space: nowrap;";

		// codigoavaluo
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

		// comentario
		// id_sucursal

		if ($this->RowType == EW_ROWTYPE_VIEW) { // View row

		// codigoavaluo
		$this->codigoavaluo->ViewValue = $this->codigoavaluo->CurrentValue;
		$this->codigoavaluo->CssStyle = "font-weight: bold;";
		$this->codigoavaluo->ViewCustomAttributes = "";

		// id_solicitud
		if (strval($this->id_solicitud->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
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
			$this->id_oficialcredito->ViewValue = $this->id_oficialcredito->CurrentValue;
		if (strval($this->id_oficialcredito->CurrentValue) <> "") {
			$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_oficialcredito->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
		$sWhereWrk = "";
		$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
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
			$this->id_inspector->ViewValue = $this->id_inspector->CurrentValue;
		if (strval($this->id_inspector->CurrentValue) <> "") {
			$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_inspector->CurrentValue, EW_DATATYPE_STRING, "");
		$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
		$sWhereWrk = "";
		$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
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
		$this->id_cliente->ViewValue = $this->id_cliente->CurrentValue;
		if (strval($this->id_cliente->CurrentValue) <> "") {
			$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_cliente->CurrentValue, EW_DATATYPE_NUMBER, "");
		$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
		$sWhereWrk = "";
		$this->id_cliente->LookupFilters = array();
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
		$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
		$sWhereWrk = "";
		$this->estado->LookupFilters = array();
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
		$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
		$sWhereWrk = "";
		$this->estadointerno->LookupFilters = array();
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
		$this->fecha_avaluo->ViewValue = ew_FormatDateTime($this->fecha_avaluo->ViewValue, 10);
		$this->fecha_avaluo->ViewCustomAttributes = "";

		// comentario
		$this->comentario->ViewValue = $this->comentario->CurrentValue;
		$this->comentario->ViewCustomAttributes = "";

		// id_sucursal
		$this->id_sucursal->ViewValue = $this->id_sucursal->CurrentValue;
		$this->id_sucursal->ViewCustomAttributes = "";

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

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";
			$this->comentario->TooltipValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";
			$this->id_sucursal->TooltipValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

			// id_solicitud
			$this->id_solicitud->EditAttrs["class"] = "form-control";
			$this->id_solicitud->EditCustomAttributes = "";

			// id_oficialcredito
			$this->id_oficialcredito->EditAttrs["class"] = "form-control";
			$this->id_oficialcredito->EditCustomAttributes = "";
			$this->id_oficialcredito->EditValue = ew_HtmlEncode($this->id_oficialcredito->CurrentValue);
			$this->id_oficialcredito->PlaceHolder = ew_RemoveHtml($this->id_oficialcredito->FldTitle());

			// id_inspector
			$this->id_inspector->EditAttrs["class"] = "form-control";
			$this->id_inspector->EditCustomAttributes = "";
			$this->id_inspector->EditValue = ew_HtmlEncode($this->id_inspector->CurrentValue);
			$this->id_inspector->PlaceHolder = ew_RemoveHtml($this->id_inspector->FldTitle());

			// id_cliente
			$this->id_cliente->EditAttrs["class"] = "form-control";
			$this->id_cliente->EditCustomAttributes = "";
			$this->id_cliente->EditValue = ew_HtmlEncode($this->id_cliente->CurrentValue);
			$this->id_cliente->PlaceHolder = ew_RemoveHtml($this->id_cliente->FldTitle());

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";

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

			// comentario
			$this->comentario->EditAttrs["class"] = "form-control";
			$this->comentario->EditCustomAttributes = "";
			$this->comentario->EditValue = ew_HtmlEncode($this->comentario->CurrentValue);
			$this->comentario->PlaceHolder = ew_RemoveHtml($this->comentario->FldTitle());

			// id_sucursal
			$this->id_sucursal->EditAttrs["class"] = "form-control";
			$this->id_sucursal->EditCustomAttributes = "";
			$this->id_sucursal->EditValue = ew_HtmlEncode($this->id_sucursal->CurrentValue);
			$this->id_sucursal->PlaceHolder = ew_RemoveHtml($this->id_sucursal->FldTitle());

			// Add refer script
			// id_solicitud

			$this->id_solicitud->LinkCustomAttributes = "";
			$this->id_solicitud->HrefValue = "";

			// id_oficialcredito
			$this->id_oficialcredito->LinkCustomAttributes = "";
			$this->id_oficialcredito->HrefValue = "";

			// id_inspector
			$this->id_inspector->LinkCustomAttributes = "";
			$this->id_inspector->HrefValue = "";

			// id_cliente
			$this->id_cliente->LinkCustomAttributes = "";
			$this->id_cliente->HrefValue = "";

			// estado
			$this->estado->LinkCustomAttributes = "";
			$this->estado->HrefValue = "";

			// estadointerno
			$this->estadointerno->LinkCustomAttributes = "";
			$this->estadointerno->HrefValue = "";

			// estadopago
			$this->estadopago->LinkCustomAttributes = "";
			$this->estadopago->HrefValue = "";

			// fecha_avaluo
			$this->fecha_avaluo->LinkCustomAttributes = "";
			$this->fecha_avaluo->HrefValue = "";

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";
		} elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

			// id_solicitud
			$this->id_solicitud->EditAttrs["class"] = "form-control";
			$this->id_solicitud->EditCustomAttributes = "";
			if (strval($this->id_solicitud->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_solicitud->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
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
					$arwrk[4] = $rswrk->fields('Disp4Fld');
					$this->id_solicitud->EditValue = $this->id_solicitud->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_solicitud->EditValue = $this->id_solicitud->CurrentValue;
				}
			} else {
				$this->id_solicitud->EditValue = NULL;
			}
			$this->id_solicitud->ViewCustomAttributes = "";

			// id_oficialcredito
			$this->id_oficialcredito->EditAttrs["class"] = "form-control";
			$this->id_oficialcredito->EditCustomAttributes = "";
			if ($this->id_oficialcredito->VirtualValue <> "") {
				$this->id_oficialcredito->EditValue = $this->id_oficialcredito->VirtualValue;
			} else {
				$this->id_oficialcredito->EditValue = $this->id_oficialcredito->CurrentValue;
			if (strval($this->id_oficialcredito->CurrentValue) <> "") {
				$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_oficialcredito->CurrentValue, EW_DATATYPE_STRING, "");
			$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
			$sWhereWrk = "";
			$this->id_oficialcredito->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
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
				$this->id_inspector->EditValue = $this->id_inspector->CurrentValue;
			if (strval($this->id_inspector->CurrentValue) <> "") {
				$sFilterWrk = "`login`" . ew_SearchString("=", $this->id_inspector->CurrentValue, EW_DATATYPE_STRING, "");
			$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
			$sWhereWrk = "";
			$this->id_inspector->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
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
			$this->id_cliente->EditValue = $this->id_cliente->CurrentValue;
			if (strval($this->id_cliente->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->id_cliente->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
			$sWhereWrk = "";
			$this->id_cliente->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->id_cliente, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$arwrk[2] = $rswrk->fields('Disp2Fld');
					$this->id_cliente->EditValue = $this->id_cliente->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->id_cliente->EditValue = $this->id_cliente->CurrentValue;
				}
			} else {
				$this->id_cliente->EditValue = NULL;
			}
			$this->id_cliente->ViewCustomAttributes = "";

			// estado
			$this->estado->EditAttrs["class"] = "form-control";
			$this->estado->EditCustomAttributes = "";
			if (strval($this->estado->CurrentValue) <> "") {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->estado->CurrentValue, EW_DATATYPE_NUMBER, "");
			$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
			$sWhereWrk = "";
			$this->estado->LookupFilters = array();
			ew_AddFilter($sWhereWrk, $sFilterWrk);
			$this->Lookup_Selecting($this->estado, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
				$rswrk = Conn()->Execute($sSqlWrk);
				if ($rswrk && !$rswrk->EOF) { // Lookup values found
					$arwrk = array();
					$arwrk[1] = $rswrk->fields('DispFld');
					$this->estado->EditValue = $this->estado->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->estado->EditValue = $this->estado->CurrentValue;
				}
			} else {
				$this->estado->EditValue = NULL;
			}
			$this->estado->ViewCustomAttributes = "";

			// estadointerno
			$this->estadointerno->EditAttrs["class"] = "form-control";
			$this->estadointerno->EditCustomAttributes = "";
			if (trim(strval($this->estadointerno->CurrentValue)) == "") {
				$sFilterWrk = "0=1";
			} else {
				$sFilterWrk = "`id`" . ew_SearchString("=", $this->estadointerno->CurrentValue, EW_DATATYPE_NUMBER, "");
			}
			$sSqlWrk = "SELECT `id`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld`, '' AS `SelectFilterFld`, '' AS `SelectFilterFld2`, '' AS `SelectFilterFld3`, '' AS `SelectFilterFld4` FROM `estadointerno`";
			$sWhereWrk = "";
			$this->estadointerno->LookupFilters = array();
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
					$this->estadopago->EditValue = $this->estadopago->DisplayValue($arwrk);
					$rswrk->Close();
				} else {
					$this->estadopago->EditValue = $this->estadopago->CurrentValue;
				}
			} else {
				$this->estadopago->EditValue = NULL;
			}
			$this->estadopago->ViewCustomAttributes = "";

			// fecha_avaluo
			$this->fecha_avaluo->EditAttrs["class"] = "form-control";
			$this->fecha_avaluo->EditCustomAttributes = "";
			$this->fecha_avaluo->EditValue = $this->fecha_avaluo->CurrentValue;
			$this->fecha_avaluo->EditValue = ew_FormatDateTime($this->fecha_avaluo->EditValue, 10);
			$this->fecha_avaluo->ViewCustomAttributes = "";

			// comentario
			$this->comentario->EditAttrs["class"] = "form-control";
			$this->comentario->EditCustomAttributes = "";
			$this->comentario->EditValue = ew_HtmlEncode($this->comentario->CurrentValue);
			$this->comentario->PlaceHolder = ew_RemoveHtml($this->comentario->FldTitle());

			// id_sucursal
			$this->id_sucursal->EditAttrs["class"] = "form-control";
			$this->id_sucursal->EditCustomAttributes = "";

			// Edit refer script
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

			// estadointerno
			$this->estadointerno->LinkCustomAttributes = "";
			$this->estadointerno->HrefValue = "";

			// estadopago
			$this->estadopago->LinkCustomAttributes = "";
			$this->estadopago->HrefValue = "";
			$this->estadopago->TooltipValue = "";

			// fecha_avaluo
			$this->fecha_avaluo->LinkCustomAttributes = "";
			$this->fecha_avaluo->HrefValue = "";
			$this->fecha_avaluo->TooltipValue = "";

			// comentario
			$this->comentario->LinkCustomAttributes = "";
			$this->comentario->HrefValue = "";

			// id_sucursal
			$this->id_sucursal->LinkCustomAttributes = "";
			$this->id_sucursal->HrefValue = "";
			$this->id_sucursal->TooltipValue = "";
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
		if (!$this->fecha_avaluo->FldIsDetailKey && !is_null($this->fecha_avaluo->FormValue) && $this->fecha_avaluo->FormValue == "") {
			ew_AddMessage($gsFormError, str_replace("%s", $this->fecha_avaluo->FldCaption(), $this->fecha_avaluo->ReqErrMsg));
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

			// estadointerno
			$this->estadointerno->SetDbValueDef($rsnew, $this->estadointerno->CurrentValue, NULL, $this->estadointerno->ReadOnly);

			// comentario
			$this->comentario->SetDbValueDef($rsnew, $this->comentario->CurrentValue, NULL, $this->comentario->ReadOnly);

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

		// id_solicitud
		$this->id_solicitud->SetDbValueDef($rsnew, $this->id_solicitud->CurrentValue, NULL, FALSE);

		// id_oficialcredito
		$this->id_oficialcredito->SetDbValueDef($rsnew, $this->id_oficialcredito->CurrentValue, NULL, FALSE);

		// id_inspector
		$this->id_inspector->SetDbValueDef($rsnew, $this->id_inspector->CurrentValue, NULL, FALSE);

		// id_cliente
		$this->id_cliente->SetDbValueDef($rsnew, $this->id_cliente->CurrentValue, NULL, FALSE);

		// estado
		$this->estado->SetDbValueDef($rsnew, $this->estado->CurrentValue, NULL, strval($this->estado->CurrentValue) == "");

		// estadointerno
		$this->estadointerno->SetDbValueDef($rsnew, $this->estadointerno->CurrentValue, NULL, strval($this->estadointerno->CurrentValue) == "");

		// estadopago
		$this->estadopago->SetDbValueDef($rsnew, $this->estadopago->CurrentValue, NULL, strval($this->estadopago->CurrentValue) == "");

		// fecha_avaluo
		$this->fecha_avaluo->SetDbValueDef($rsnew, ew_UnFormatDateTime($this->fecha_avaluo->CurrentValue, 10), NULL, FALSE);

		// comentario
		$this->comentario->SetDbValueDef($rsnew, $this->comentario->CurrentValue, NULL, FALSE);

		// id_sucursal
		$this->id_sucursal->SetDbValueDef($rsnew, $this->id_sucursal->CurrentValue, NULL, FALSE);

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
		$item->Body = "<button id=\"emf_viewavaluoinspectorhistorico\" class=\"ewExportLink ewEmail\" title=\"" . $Language->Phrase("ExportToEmailText") . "\" data-caption=\"" . $Language->Phrase("ExportToEmailText") . "\" onclick=\"ew_EmailDialogShow({lnk:'emf_viewavaluoinspectorhistorico',hdr:ewLanguage.Phrase('ExportToEmailText'),f:document.fviewavaluoinspectorhistoricolist,sel:false" . $url . "});\">" . $Language->Phrase("ExportToEmail") . "</button>";
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
		switch ($fld->FldVar) {
		case "x_id_solicitud":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `id` AS `DispFld`, `name` AS `Disp2Fld`, `lastname` AS `Disp3Fld`, `email` AS `Disp4Fld` FROM `solicitud`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_solicitud, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_oficialcredito":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `login` AS `LinkFld`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `oficialcredito`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`login` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_oficialcredito, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_inspector":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `login` AS `LinkFld`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `inspector`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`login` IN ({filter_value})', "t0" => "200", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_inspector, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_cliente":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `name` AS `DispFld`, `lastname` AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `cliente`";
			$sWhereWrk = "{filter}";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_cliente, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_estado":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estado`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->estado, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_estadointerno":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadointerno`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->estadointerno, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_estadopago":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id` AS `LinkFld`, `descripcion` AS `DispFld`, '' AS `Disp2Fld`, '' AS `Disp3Fld`, '' AS `Disp4Fld` FROM `estadopago`";
			$sWhereWrk = "";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "", "f0" => '`id` IN ({filter_value})', "t0" => "3", "fn0" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->estadopago, $sWhereWrk); // Call Lookup Selecting
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
		case "x_id_oficialcredito":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `login`, `nombre` AS `DispFld`, `apellido` AS `Disp2Fld` FROM `oficialcredito`";
			$sWhereWrk = "`nombre` LIKE '{query_value}%' OR CONCAT(`nombre`,'" . ew_ValueSeparator(1, $this->id_oficialcredito) . "',`apellido`) LIKE '{query_value}%'";
			$fld->LookupFilters = array("dx1" => '`nombre`', "dx2" => '`apellido`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_oficialcredito, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_inspector":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `login`, `apellido` AS `DispFld`, `nombre` AS `Disp2Fld` FROM `inspector`";
			$sWhereWrk = "`apellido` LIKE '{query_value}%' OR CONCAT(`apellido`,'" . ew_ValueSeparator(1, $this->id_inspector) . "',`nombre`) LIKE '{query_value}%'";
			$fld->LookupFilters = array("dx1" => '`apellido`', "dx2" => '`nombre`');
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_inspector, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
		case "x_id_cliente":
			$sSqlWrk = "";
			$sSqlWrk = "SELECT `id`, `name` AS `DispFld`, `lastname` AS `Disp2Fld` FROM `cliente`";
			$sWhereWrk = "`name` LIKE '{query_value}%' OR CONCAT(`name`,'" . ew_ValueSeparator(1, $this->id_cliente) . "',`lastname`) LIKE '{query_value}%'";
			$fld->LookupFilters = array();
			$fld->LookupFilters += array("s" => $sSqlWrk, "d" => "");
			$sSqlWrk = "";
			$this->Lookup_Selecting($this->id_cliente, $sWhereWrk); // Call Lookup Selecting
			if ($sWhereWrk <> "") $sSqlWrk .= " WHERE " . $sWhereWrk;
			if ($sSqlWrk <> "")
				$fld->LookupFilters["s"] .= $sSqlWrk;
			break;
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
			// Example:

		$opt = &$this->ListOptions->Add("new");
		$opt->Header = "Terminar Inspeccion";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(0); // Move to first column

		//$this->ListOptions->Add("print_x"); // Replace abclink with your name of the link
		//$this->ListOptions->Items["print_x"]->Header = "<b>Print X</b>";

		$opt = &$this->ListOptions->Add("new1");
		$opt->Header = "Tareas Inspector";
		$opt->OnLeft = TRUE; // Link on left
		$opt->MoveTo(1); // Move to first column
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

			$this->ListOptions->Items["new"]->Body = "<a href='core.php?id=".CurrentTable()->id->CurrentValue."' class='btn btn-primary'>Terminar Inspeccion</a>";
		$button2="<div class=\"btn-group\" role=\"group\" aria-label=\"Button group with nested dropdown\">";
		$button2.=	"<button class=\"btn btn-secondary dropdown-toggle\" type=\"button\" id=\"dropdownMenuButton\" data-toggle=\"dropdown\" aria-haspopup=\"true\" aria-expanded=\"false\">";
		$button2.="Historiales";
		$button2.="</button>";
		$button2.="<ul class=\"dropdown-menu ewMenu\" aria-labelledby=\"dropdownMenuButton\">";
		$button2.="<li><a class=\"dropdown-item\" href=historicolist.php?avaluo=".CurrentTable()->id->CurrentValue." target=\"frame\">Historial</a></li>";
		$button2.="<li><a class=\"dropdown-item\" href=viewdocumentosavaluoframelist.php?avaluo=".CurrentTable()->id->CurrentValue." target=\"framedoc\" >Adjunto</a></li>";
		$button2.="</ul>";
		$button2.="</div>";
		$this->ListOptions->Items["new1"]->Body = $button2;
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
if (!isset($viewavaluoinspectorhistorico_list)) $viewavaluoinspectorhistorico_list = new cviewavaluoinspectorhistorico_list();

// Page init
$viewavaluoinspectorhistorico_list->Page_Init();

// Page main
$viewavaluoinspectorhistorico_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewavaluoinspectorhistorico_list->Page_Render();
?>
<?php include_once "header.php" ?>
<?php if ($viewavaluoinspectorhistorico->Export == "") { ?>
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "list";
var CurrentForm = fviewavaluoinspectorhistoricolist = new ew_Form("fviewavaluoinspectorhistoricolist", "list");
fviewavaluoinspectorhistoricolist.FormKeyCountName = '<?php echo $viewavaluoinspectorhistorico_list->FormKeyCountName ?>';

// Validate form
fviewavaluoinspectorhistoricolist.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewavaluoinspectorhistorico->fecha_avaluo->FldCaption(), $viewavaluoinspectorhistorico->fecha_avaluo->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}
	return true;
}

// Form_CustomValidate event
fviewavaluoinspectorhistoricolist.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluoinspectorhistoricolist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluoinspectorhistoricolist.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_id","x_name","x_lastname","x__email"],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
fviewavaluoinspectorhistoricolist.Lists["x_id_solicitud"].Data = "<?php echo $viewavaluoinspectorhistorico_list->id_solicitud->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluoinspectorhistoricolist.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fviewavaluoinspectorhistoricolist.Lists["x_id_oficialcredito"].Data = "<?php echo $viewavaluoinspectorhistorico_list->id_oficialcredito->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluoinspectorhistoricolist.AutoSuggests["x_id_oficialcredito"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluoinspectorhistorico_list->id_oficialcredito->LookupFilterQuery(TRUE, "list"))) ?>;
fviewavaluoinspectorhistoricolist.Lists["x_id_inspector"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_apellido","x_nombre","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"inspector"};
fviewavaluoinspectorhistoricolist.Lists["x_id_inspector"].Data = "<?php echo $viewavaluoinspectorhistorico_list->id_inspector->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluoinspectorhistoricolist.AutoSuggests["x_id_inspector"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluoinspectorhistorico_list->id_inspector->LookupFilterQuery(TRUE, "list"))) ?>;
fviewavaluoinspectorhistoricolist.Lists["x_id_cliente"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cliente"};
fviewavaluoinspectorhistoricolist.Lists["x_id_cliente"].Data = "<?php echo $viewavaluoinspectorhistorico_list->id_cliente->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluoinspectorhistoricolist.AutoSuggests["x_id_cliente"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluoinspectorhistorico_list->id_cliente->LookupFilterQuery(TRUE, "list"))) ?>;
fviewavaluoinspectorhistoricolist.Lists["x_estado"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estado"};
fviewavaluoinspectorhistoricolist.Lists["x_estado"].Data = "<?php echo $viewavaluoinspectorhistorico_list->estado->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluoinspectorhistoricolist.Lists["x_estadointerno"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadointerno"};
fviewavaluoinspectorhistoricolist.Lists["x_estadointerno"].Data = "<?php echo $viewavaluoinspectorhistorico_list->estadointerno->LookupFilterQuery(FALSE, "list") ?>";
fviewavaluoinspectorhistoricolist.Lists["x_estadopago"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadopago"};
fviewavaluoinspectorhistoricolist.Lists["x_estadopago"].Data = "<?php echo $viewavaluoinspectorhistorico_list->estadopago->LookupFilterQuery(FALSE, "list") ?>";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->Export == "") { ?>
<div class="ewToolbar">
<?php if ($viewavaluoinspectorhistorico_list->TotalRecs > 0 && $viewavaluoinspectorhistorico_list->ExportOptions->Visible()) { ?>
<?php $viewavaluoinspectorhistorico_list->ExportOptions->Render("body") ?>
<?php } ?>
<div class="clearfix"></div>
</div>
<?php } ?>
<?php
	$bSelectLimit = $viewavaluoinspectorhistorico_list->UseSelectLimit;
	if ($bSelectLimit) {
		if ($viewavaluoinspectorhistorico_list->TotalRecs <= 0)
			$viewavaluoinspectorhistorico_list->TotalRecs = $viewavaluoinspectorhistorico->ListRecordCount();
	} else {
		if (!$viewavaluoinspectorhistorico_list->Recordset && ($viewavaluoinspectorhistorico_list->Recordset = $viewavaluoinspectorhistorico_list->LoadRecordset()))
			$viewavaluoinspectorhistorico_list->TotalRecs = $viewavaluoinspectorhistorico_list->Recordset->RecordCount();
	}
	$viewavaluoinspectorhistorico_list->StartRec = 1;
	if ($viewavaluoinspectorhistorico_list->DisplayRecs <= 0 || ($viewavaluoinspectorhistorico->Export <> "" && $viewavaluoinspectorhistorico->ExportAll)) // Display all records
		$viewavaluoinspectorhistorico_list->DisplayRecs = $viewavaluoinspectorhistorico_list->TotalRecs;
	if (!($viewavaluoinspectorhistorico->Export <> "" && $viewavaluoinspectorhistorico->ExportAll))
		$viewavaluoinspectorhistorico_list->SetupStartRec(); // Set up start record position
	if ($bSelectLimit)
		$viewavaluoinspectorhistorico_list->Recordset = $viewavaluoinspectorhistorico_list->LoadRecordset($viewavaluoinspectorhistorico_list->StartRec-1, $viewavaluoinspectorhistorico_list->DisplayRecs);

	// Set no record found message
	if ($viewavaluoinspectorhistorico->CurrentAction == "" && $viewavaluoinspectorhistorico_list->TotalRecs == 0) {
		if (!$Security->CanList())
			$viewavaluoinspectorhistorico_list->setWarningMessage(ew_DeniedMsg());
		if ($viewavaluoinspectorhistorico_list->SearchWhere == "0=101")
			$viewavaluoinspectorhistorico_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$viewavaluoinspectorhistorico_list->setWarningMessage($Language->Phrase("NoRecord"));
	}
$viewavaluoinspectorhistorico_list->RenderOtherOptions();
?>
<?php $viewavaluoinspectorhistorico_list->ShowPageHeader(); ?>
<?php
$viewavaluoinspectorhistorico_list->ShowMessage();
?>
<?php if ($viewavaluoinspectorhistorico_list->TotalRecs > 0 || $viewavaluoinspectorhistorico->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($viewavaluoinspectorhistorico_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewavaluoinspectorhistorico">
<form name="fviewavaluoinspectorhistoricolist" id="fviewavaluoinspectorhistoricolist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
<?php if ($viewavaluoinspectorhistorico_list->CheckToken) { ?>
<input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewavaluoinspectorhistorico_list->Token ?>">
<?php } ?>
<input type="hidden" name="t" value="viewavaluoinspectorhistorico">
<div id="gmp_viewavaluoinspectorhistorico" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<?php if ($viewavaluoinspectorhistorico_list->TotalRecs > 0 || $viewavaluoinspectorhistorico->CurrentAction == "gridedit") { ?>
<table id="tbl_viewavaluoinspectorhistoricolist" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$viewavaluoinspectorhistorico_list->RowType = EW_ROWTYPE_HEADER;

// Render list options
$viewavaluoinspectorhistorico_list->RenderListOptions();

// Render list options (header, left)
$viewavaluoinspectorhistorico_list->ListOptions->Render("header", "left");
?>
<?php if ($viewavaluoinspectorhistorico->id_solicitud->Visible) { // id_solicitud ?>
	<?php if ($viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->id_solicitud) == "") { ?>
		<th data-name="id_solicitud" class="<?php echo $viewavaluoinspectorhistorico->id_solicitud->HeaderCellClass() ?>"><div id="elh_viewavaluoinspectorhistorico_id_solicitud" class="viewavaluoinspectorhistorico_id_solicitud"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->id_solicitud->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_solicitud" class="<?php echo $viewavaluoinspectorhistorico->id_solicitud->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->id_solicitud) ?>',1);"><div id="elh_viewavaluoinspectorhistorico_id_solicitud" class="viewavaluoinspectorhistorico_id_solicitud">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->id_solicitud->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspectorhistorico->id_solicitud->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspectorhistorico->id_solicitud->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->id_oficialcredito->Visible) { // id_oficialcredito ?>
	<?php if ($viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->id_oficialcredito) == "") { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluoinspectorhistorico->id_oficialcredito->HeaderCellClass() ?>"><div id="elh_viewavaluoinspectorhistorico_id_oficialcredito" class="viewavaluoinspectorhistorico_id_oficialcredito"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->id_oficialcredito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluoinspectorhistorico->id_oficialcredito->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->id_oficialcredito) ?>',1);"><div id="elh_viewavaluoinspectorhistorico_id_oficialcredito" class="viewavaluoinspectorhistorico_id_oficialcredito">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->id_oficialcredito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspectorhistorico->id_oficialcredito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspectorhistorico->id_oficialcredito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->id_inspector->Visible) { // id_inspector ?>
	<?php if ($viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->id_inspector) == "") { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluoinspectorhistorico->id_inspector->HeaderCellClass() ?>"><div id="elh_viewavaluoinspectorhistorico_id_inspector" class="viewavaluoinspectorhistorico_id_inspector"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->id_inspector->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluoinspectorhistorico->id_inspector->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->id_inspector) ?>',1);"><div id="elh_viewavaluoinspectorhistorico_id_inspector" class="viewavaluoinspectorhistorico_id_inspector">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->id_inspector->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspectorhistorico->id_inspector->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspectorhistorico->id_inspector->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->id_cliente->Visible) { // id_cliente ?>
	<?php if ($viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->id_cliente) == "") { ?>
		<th data-name="id_cliente" class="<?php echo $viewavaluoinspectorhistorico->id_cliente->HeaderCellClass() ?>"><div id="elh_viewavaluoinspectorhistorico_id_cliente" class="viewavaluoinspectorhistorico_id_cliente"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluoinspectorhistorico->id_cliente->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_cliente" class="<?php echo $viewavaluoinspectorhistorico->id_cliente->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->id_cliente) ?>',1);"><div id="elh_viewavaluoinspectorhistorico_id_cliente" class="viewavaluoinspectorhistorico_id_cliente">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->id_cliente->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspectorhistorico->id_cliente->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspectorhistorico->id_cliente->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->estado->Visible) { // estado ?>
	<?php if ($viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->estado) == "") { ?>
		<th data-name="estado" class="<?php echo $viewavaluoinspectorhistorico->estado->HeaderCellClass() ?>"><div id="elh_viewavaluoinspectorhistorico_estado" class="viewavaluoinspectorhistorico_estado"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado" class="<?php echo $viewavaluoinspectorhistorico->estado->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->estado) ?>',1);"><div id="elh_viewavaluoinspectorhistorico_estado" class="viewavaluoinspectorhistorico_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->estado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspectorhistorico->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspectorhistorico->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->estadointerno->Visible) { // estadointerno ?>
	<?php if ($viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->estadointerno) == "") { ?>
		<th data-name="estadointerno" class="<?php echo $viewavaluoinspectorhistorico->estadointerno->HeaderCellClass() ?>"><div id="elh_viewavaluoinspectorhistorico_estadointerno" class="viewavaluoinspectorhistorico_estadointerno"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->estadointerno->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadointerno" class="<?php echo $viewavaluoinspectorhistorico->estadointerno->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->estadointerno) ?>',1);"><div id="elh_viewavaluoinspectorhistorico_estadointerno" class="viewavaluoinspectorhistorico_estadointerno">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->estadointerno->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspectorhistorico->estadointerno->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspectorhistorico->estadointerno->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->estadopago->Visible) { // estadopago ?>
	<?php if ($viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->estadopago) == "") { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluoinspectorhistorico->estadopago->HeaderCellClass() ?>"><div id="elh_viewavaluoinspectorhistorico_estadopago" class="viewavaluoinspectorhistorico_estadopago"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->estadopago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluoinspectorhistorico->estadopago->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->estadopago) ?>',1);"><div id="elh_viewavaluoinspectorhistorico_estadopago" class="viewavaluoinspectorhistorico_estadopago">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->estadopago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspectorhistorico->estadopago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspectorhistorico->estadopago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->fecha_avaluo->Visible) { // fecha_avaluo ?>
	<?php if ($viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->fecha_avaluo) == "") { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluoinspectorhistorico->fecha_avaluo->HeaderCellClass() ?>"><div id="elh_viewavaluoinspectorhistorico_fecha_avaluo" class="viewavaluoinspectorhistorico_fecha_avaluo"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->fecha_avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluoinspectorhistorico->fecha_avaluo->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->fecha_avaluo) ?>',1);"><div id="elh_viewavaluoinspectorhistorico_fecha_avaluo" class="viewavaluoinspectorhistorico_fecha_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->fecha_avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspectorhistorico->fecha_avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspectorhistorico->fecha_avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->comentario->Visible) { // comentario ?>
	<?php if ($viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->comentario) == "") { ?>
		<th data-name="comentario" class="<?php echo $viewavaluoinspectorhistorico->comentario->HeaderCellClass() ?>"><div id="elh_viewavaluoinspectorhistorico_comentario" class="viewavaluoinspectorhistorico_comentario"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->comentario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="comentario" class="<?php echo $viewavaluoinspectorhistorico->comentario->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->comentario) ?>',1);"><div id="elh_viewavaluoinspectorhistorico_comentario" class="viewavaluoinspectorhistorico_comentario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->comentario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspectorhistorico->comentario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspectorhistorico->comentario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->id_sucursal->Visible) { // id_sucursal ?>
	<?php if ($viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->id_sucursal) == "") { ?>
		<th data-name="id_sucursal" class="<?php echo $viewavaluoinspectorhistorico->id_sucursal->HeaderCellClass() ?>"><div id="elh_viewavaluoinspectorhistorico_id_sucursal" class="viewavaluoinspectorhistorico_id_sucursal"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->id_sucursal->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_sucursal" class="<?php echo $viewavaluoinspectorhistorico->id_sucursal->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewavaluoinspectorhistorico->SortUrl($viewavaluoinspectorhistorico->id_sucursal) ?>',1);"><div id="elh_viewavaluoinspectorhistorico_id_sucursal" class="viewavaluoinspectorhistorico_id_sucursal">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspectorhistorico->id_sucursal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspectorhistorico->id_sucursal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspectorhistorico->id_sucursal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$viewavaluoinspectorhistorico_list->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
if ($viewavaluoinspectorhistorico->ExportAll && $viewavaluoinspectorhistorico->Export <> "") {
	$viewavaluoinspectorhistorico_list->StopRec = $viewavaluoinspectorhistorico_list->TotalRecs;
} else {

	// Set the last record to display
	if ($viewavaluoinspectorhistorico_list->TotalRecs > $viewavaluoinspectorhistorico_list->StartRec + $viewavaluoinspectorhistorico_list->DisplayRecs - 1)
		$viewavaluoinspectorhistorico_list->StopRec = $viewavaluoinspectorhistorico_list->StartRec + $viewavaluoinspectorhistorico_list->DisplayRecs - 1;
	else
		$viewavaluoinspectorhistorico_list->StopRec = $viewavaluoinspectorhistorico_list->TotalRecs;
}

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($viewavaluoinspectorhistorico_list->FormKeyCountName) && ($viewavaluoinspectorhistorico->CurrentAction == "gridadd" || $viewavaluoinspectorhistorico->CurrentAction == "gridedit" || $viewavaluoinspectorhistorico->CurrentAction == "F")) {
		$viewavaluoinspectorhistorico_list->KeyCount = $objForm->GetValue($viewavaluoinspectorhistorico_list->FormKeyCountName);
		$viewavaluoinspectorhistorico_list->StopRec = $viewavaluoinspectorhistorico_list->StartRec + $viewavaluoinspectorhistorico_list->KeyCount - 1;
	}
}
$viewavaluoinspectorhistorico_list->RecCnt = $viewavaluoinspectorhistorico_list->StartRec - 1;
if ($viewavaluoinspectorhistorico_list->Recordset && !$viewavaluoinspectorhistorico_list->Recordset->EOF) {
	$viewavaluoinspectorhistorico_list->Recordset->MoveFirst();
	$bSelectLimit = $viewavaluoinspectorhistorico_list->UseSelectLimit;
	if (!$bSelectLimit && $viewavaluoinspectorhistorico_list->StartRec > 1)
		$viewavaluoinspectorhistorico_list->Recordset->Move($viewavaluoinspectorhistorico_list->StartRec - 1);
} elseif (!$viewavaluoinspectorhistorico->AllowAddDeleteRow && $viewavaluoinspectorhistorico_list->StopRec == 0) {
	$viewavaluoinspectorhistorico_list->StopRec = $viewavaluoinspectorhistorico->GridAddRowCount;
}

// Initialize aggregate
$viewavaluoinspectorhistorico->RowType = EW_ROWTYPE_AGGREGATEINIT;
$viewavaluoinspectorhistorico->ResetAttrs();
$viewavaluoinspectorhistorico_list->RenderRow();
$viewavaluoinspectorhistorico_list->EditRowCnt = 0;
if ($viewavaluoinspectorhistorico->CurrentAction == "edit")
	$viewavaluoinspectorhistorico_list->RowIndex = 1;
while ($viewavaluoinspectorhistorico_list->RecCnt < $viewavaluoinspectorhistorico_list->StopRec) {
	$viewavaluoinspectorhistorico_list->RecCnt++;
	if (intval($viewavaluoinspectorhistorico_list->RecCnt) >= intval($viewavaluoinspectorhistorico_list->StartRec)) {
		$viewavaluoinspectorhistorico_list->RowCnt++;

		// Set up key count
		$viewavaluoinspectorhistorico_list->KeyCount = $viewavaluoinspectorhistorico_list->RowIndex;

		// Init row class and style
		$viewavaluoinspectorhistorico->ResetAttrs();
		$viewavaluoinspectorhistorico->CssClass = "";
		if ($viewavaluoinspectorhistorico->CurrentAction == "gridadd") {
			$viewavaluoinspectorhistorico_list->LoadRowValues(); // Load default values
		} else {
			$viewavaluoinspectorhistorico_list->LoadRowValues($viewavaluoinspectorhistorico_list->Recordset); // Load row values
		}
		$viewavaluoinspectorhistorico->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($viewavaluoinspectorhistorico->CurrentAction == "edit") {
			if ($viewavaluoinspectorhistorico_list->CheckInlineEditKey() && $viewavaluoinspectorhistorico_list->EditRowCnt == 0) { // Inline edit
				$viewavaluoinspectorhistorico->RowType = EW_ROWTYPE_EDIT; // Render edit
			}
		}
		if ($viewavaluoinspectorhistorico->CurrentAction == "edit" && $viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT && $viewavaluoinspectorhistorico->EventCancelled) { // Update failed
			$objForm->Index = 1;
			$viewavaluoinspectorhistorico_list->RestoreFormValues(); // Restore form values
		}
		if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT) // Edit row
			$viewavaluoinspectorhistorico_list->EditRowCnt++;

		// Set up row id / data-rowindex
		$viewavaluoinspectorhistorico->RowAttrs = array_merge($viewavaluoinspectorhistorico->RowAttrs, array('data-rowindex'=>$viewavaluoinspectorhistorico_list->RowCnt, 'id'=>'r' . $viewavaluoinspectorhistorico_list->RowCnt . '_viewavaluoinspectorhistorico', 'data-rowtype'=>$viewavaluoinspectorhistorico->RowType));

		// Render row
		$viewavaluoinspectorhistorico_list->RenderRow();

		// Render list options
		$viewavaluoinspectorhistorico_list->RenderListOptions();
?>
	<tr<?php echo $viewavaluoinspectorhistorico->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewavaluoinspectorhistorico_list->ListOptions->Render("body", "left", $viewavaluoinspectorhistorico_list->RowCnt);
?>
	<?php if ($viewavaluoinspectorhistorico->id_solicitud->Visible) { // id_solicitud ?>
		<td data-name="id_solicitud"<?php echo $viewavaluoinspectorhistorico->id_solicitud->CellAttributes() ?>>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_id_solicitud" class="form-group viewavaluoinspectorhistorico_id_solicitud">
<span<?php echo $viewavaluoinspectorhistorico->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->id_solicitud->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_solicitud" name="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_id_solicitud" id="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_solicitud->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_id_solicitud" class="viewavaluoinspectorhistorico_id_solicitud">
<span<?php echo $viewavaluoinspectorhistorico->id_solicitud->ViewAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->id_solicitud->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT || $viewavaluoinspectorhistorico->CurrentMode == "edit") { ?>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id" name="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_id" id="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($viewavaluoinspectorhistorico->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<td data-name="id_oficialcredito"<?php echo $viewavaluoinspectorhistorico->id_oficialcredito->CellAttributes() ?>>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_id_oficialcredito" class="form-group viewavaluoinspectorhistorico_id_oficialcredito">
<span<?php echo $viewavaluoinspectorhistorico->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->id_oficialcredito->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_oficialcredito" name="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_oficialcredito->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_id_oficialcredito" class="viewavaluoinspectorhistorico_id_oficialcredito">
<span<?php echo $viewavaluoinspectorhistorico->id_oficialcredito->ViewAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->id_oficialcredito->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspectorhistorico->id_inspector->Visible) { // id_inspector ?>
		<td data-name="id_inspector"<?php echo $viewavaluoinspectorhistorico->id_inspector->CellAttributes() ?>>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_id_inspector" class="form-group viewavaluoinspectorhistorico_id_inspector">
<span<?php echo $viewavaluoinspectorhistorico->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->id_inspector->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_inspector" name="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_inspector->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_id_inspector" class="viewavaluoinspectorhistorico_id_inspector">
<span<?php echo $viewavaluoinspectorhistorico->id_inspector->ViewAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->id_inspector->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspectorhistorico->id_cliente->Visible) { // id_cliente ?>
		<td data-name="id_cliente"<?php echo $viewavaluoinspectorhistorico->id_cliente->CellAttributes() ?>>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_id_cliente" class="form-group viewavaluoinspectorhistorico_id_cliente">
<span<?php echo $viewavaluoinspectorhistorico->id_cliente->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->id_cliente->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_cliente" name="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_cliente->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_id_cliente" class="viewavaluoinspectorhistorico_id_cliente">
<span<?php echo $viewavaluoinspectorhistorico->id_cliente->ViewAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->id_cliente->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspectorhistorico->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $viewavaluoinspectorhistorico->estado->CellAttributes() ?>>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_estado" class="form-group viewavaluoinspectorhistorico_estado">
<span<?php echo $viewavaluoinspectorhistorico->estado->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->estado->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_estado" name="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_estado" id="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->estado->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_estado" class="viewavaluoinspectorhistorico_estado">
<span<?php echo $viewavaluoinspectorhistorico->estado->ViewAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->estado->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspectorhistorico->estadointerno->Visible) { // estadointerno ?>
		<td data-name="estadointerno"<?php echo $viewavaluoinspectorhistorico->estadointerno->CellAttributes() ?>>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_estadointerno" class="form-group viewavaluoinspectorhistorico_estadointerno">
<select data-table="viewavaluoinspectorhistorico" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluoinspectorhistorico->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_estadointerno" name="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_estadointerno"<?php echo $viewavaluoinspectorhistorico->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->estadointerno->SelectOptionListHtml("x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_estadointerno") ?>
</select>
</span>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_estadointerno" class="viewavaluoinspectorhistorico_estadointerno">
<span<?php echo $viewavaluoinspectorhistorico->estadointerno->ViewAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->estadointerno->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspectorhistorico->estadopago->Visible) { // estadopago ?>
		<td data-name="estadopago"<?php echo $viewavaluoinspectorhistorico->estadopago->CellAttributes() ?>>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_estadopago" class="form-group viewavaluoinspectorhistorico_estadopago">
<span<?php echo $viewavaluoinspectorhistorico->estadopago->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->estadopago->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_estadopago" name="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_estadopago" id="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->estadopago->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_estadopago" class="viewavaluoinspectorhistorico_estadopago">
<span<?php echo $viewavaluoinspectorhistorico->estadopago->ViewAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->estadopago->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspectorhistorico->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<td data-name="fecha_avaluo"<?php echo $viewavaluoinspectorhistorico->fecha_avaluo->CellAttributes() ?>>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_fecha_avaluo" class="form-group viewavaluoinspectorhistorico_fecha_avaluo">
<span<?php echo $viewavaluoinspectorhistorico->fecha_avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspectorhistorico->fecha_avaluo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_fecha_avaluo" name="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->fecha_avaluo->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_fecha_avaluo" class="viewavaluoinspectorhistorico_fecha_avaluo">
<span<?php echo $viewavaluoinspectorhistorico->fecha_avaluo->ViewAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->fecha_avaluo->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspectorhistorico->comentario->Visible) { // comentario ?>
		<td data-name="comentario"<?php echo $viewavaluoinspectorhistorico->comentario->CellAttributes() ?>>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_comentario" class="form-group viewavaluoinspectorhistorico_comentario">
<textarea data-table="viewavaluoinspectorhistorico" data-field="x_comentario" name="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_comentario" id="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluoinspectorhistorico->comentario->EditAttributes() ?>><?php echo $viewavaluoinspectorhistorico->comentario->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_comentario" class="viewavaluoinspectorhistorico_comentario">
<span<?php echo $viewavaluoinspectorhistorico->comentario->ViewAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->comentario->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspectorhistorico->id_sucursal->Visible) { // id_sucursal ?>
		<td data-name="id_sucursal"<?php echo $viewavaluoinspectorhistorico->id_sucursal->CellAttributes() ?>>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_id_sucursal" class="form-group viewavaluoinspectorhistorico_id_sucursal">
<input type="hidden" data-table="viewavaluoinspectorhistorico" data-field="x_id_sucursal" name="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_id_sucursal" id="x<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>_id_sucursal" value="<?php echo ew_HtmlEncode($viewavaluoinspectorhistorico->id_sucursal->CurrentValue) ?>">
</span>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspectorhistorico_list->RowCnt ?>_viewavaluoinspectorhistorico_id_sucursal" class="viewavaluoinspectorhistorico_id_sucursal">
<span<?php echo $viewavaluoinspectorhistorico->id_sucursal->ViewAttributes() ?>>
<?php echo $viewavaluoinspectorhistorico->id_sucursal->ListViewValue() ?></span>
</span>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewavaluoinspectorhistorico_list->ListOptions->Render("body", "right", $viewavaluoinspectorhistorico_list->RowCnt);
?>
	</tr>
<?php if ($viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_ADD || $viewavaluoinspectorhistorico->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fviewavaluoinspectorhistoricolist.UpdateOpts(<?php echo $viewavaluoinspectorhistorico_list->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	if ($viewavaluoinspectorhistorico->CurrentAction <> "gridadd")
		$viewavaluoinspectorhistorico_list->Recordset->MoveNext();
}
?>
</tbody>
</table>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->CurrentAction == "edit") { ?>
<input type="hidden" name="<?php echo $viewavaluoinspectorhistorico_list->FormKeyCountName ?>" id="<?php echo $viewavaluoinspectorhistorico_list->FormKeyCountName ?>" value="<?php echo $viewavaluoinspectorhistorico_list->KeyCount ?>">
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->CurrentAction == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
</div>
</form>
<?php

// Close recordset
if ($viewavaluoinspectorhistorico_list->Recordset)
	$viewavaluoinspectorhistorico_list->Recordset->Close();
?>
<?php if ($viewavaluoinspectorhistorico->Export == "") { ?>
<div class="box-footer ewGridLowerPanel">
<?php if ($viewavaluoinspectorhistorico->CurrentAction <> "gridadd" && $viewavaluoinspectorhistorico->CurrentAction <> "gridedit") { ?>
<form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
<?php if (!isset($viewavaluoinspectorhistorico_list->Pager)) $viewavaluoinspectorhistorico_list->Pager = new cNumericPager($viewavaluoinspectorhistorico_list->StartRec, $viewavaluoinspectorhistorico_list->DisplayRecs, $viewavaluoinspectorhistorico_list->TotalRecs, $viewavaluoinspectorhistorico_list->RecRange, $viewavaluoinspectorhistorico_list->AutoHidePager) ?>
<?php if ($viewavaluoinspectorhistorico_list->Pager->RecordCount > 0 && $viewavaluoinspectorhistorico_list->Pager->Visible) { ?>
<div class="ewPager">
<div class="ewNumericPage"><ul class="pagination">
	<?php if ($viewavaluoinspectorhistorico_list->Pager->FirstButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluoinspectorhistorico_list->PageUrl() ?>start=<?php echo $viewavaluoinspectorhistorico_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
	<?php } ?>
	<?php if ($viewavaluoinspectorhistorico_list->Pager->PrevButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluoinspectorhistorico_list->PageUrl() ?>start=<?php echo $viewavaluoinspectorhistorico_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
	<?php } ?>
	<?php foreach ($viewavaluoinspectorhistorico_list->Pager->Items as $PagerItem) { ?>
		<li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $viewavaluoinspectorhistorico_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
	<?php } ?>
	<?php if ($viewavaluoinspectorhistorico_list->Pager->NextButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluoinspectorhistorico_list->PageUrl() ?>start=<?php echo $viewavaluoinspectorhistorico_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
	<?php } ?>
	<?php if ($viewavaluoinspectorhistorico_list->Pager->LastButton->Enabled) { ?>
	<li><a href="<?php echo $viewavaluoinspectorhistorico_list->PageUrl() ?>start=<?php echo $viewavaluoinspectorhistorico_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
	<?php } ?>
</ul></div>
</div>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico_list->Pager->RecordCount > 0) { ?>
<div class="ewPager ewRec">
	<span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $viewavaluoinspectorhistorico_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $viewavaluoinspectorhistorico_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $viewavaluoinspectorhistorico_list->Pager->RecordCount ?></span>
</div>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico_list->TotalRecs > 0 && (!$viewavaluoinspectorhistorico_list->AutoHidePageSizeSelector || $viewavaluoinspectorhistorico_list->Pager->Visible)) { ?>
<div class="ewPager">
<input type="hidden" name="t" value="viewavaluoinspectorhistorico">
<select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
<option value="10"<?php if ($viewavaluoinspectorhistorico_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
<option value="20"<?php if ($viewavaluoinspectorhistorico_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
<option value="50"<?php if ($viewavaluoinspectorhistorico_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
<option value="ALL"<?php if ($viewavaluoinspectorhistorico->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
</select>
</div>
<?php } ?>
</form>
<?php } ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewavaluoinspectorhistorico_list->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
</div>
<?php } ?>
</div>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico_list->TotalRecs == 0 && $viewavaluoinspectorhistorico->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewavaluoinspectorhistorico_list->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($viewavaluoinspectorhistorico->Export == "") { ?>
<script type="text/javascript">
fviewavaluoinspectorhistoricolist.Init();
</script>
<?php } ?>
<?php
$viewavaluoinspectorhistorico_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
	echo ew_DebugMsg();
?>
<?php if ($viewavaluoinspectorhistorico->Export == "") { ?>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
<?php } ?>
<?php include_once "footer.php" ?>
<?php
$viewavaluoinspectorhistorico_list->Page_Terminate();
?>
