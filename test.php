<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "viewsolicitudframeinfo.php" ?>

<?php

//
// Page class
//

$viewsolicitudframe_list = NULL; // Initialize page object first

class cviewsolicitudframe_list extends cviewsolicitudframe {

    // Page ID
    var $PageID = 'list';

    // Project ID
    var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

    // Table name
    var $TableName = 'viewsolicitudframe';

    // Page object name
    var $PageObjName = 'viewsolicitudframe_list';

    // Grid form hidden field names
    var $FormName = 'fviewsolicitudframelist';
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

        // Table object (viewsolicitudframe)
        if (!isset($GLOBALS["viewsolicitudframe"]) || get_class($GLOBALS["viewsolicitudframe"]) == "cviewsolicitudframe") {
            $GLOBALS["viewsolicitudframe"] = &$this;
            $GLOBALS["Table"] = &$GLOBALS["viewsolicitudframe"];
        }

        // Initialize URLs
        $this->ExportPrintUrl = $this->PageUrl() . "export=print";
        $this->ExportExcelUrl = $this->PageUrl() . "export=excel";
        $this->ExportWordUrl = $this->PageUrl() . "export=word";
        $this->ExportHtmlUrl = $this->PageUrl() . "export=html";
        $this->ExportXmlUrl = $this->PageUrl() . "export=xml";
        $this->ExportCsvUrl = $this->PageUrl() . "export=csv";
        $this->ExportPdfUrl = $this->PageUrl() . "export=pdf";
        $this->AddUrl = "viewsolicitudframeadd.php";
        $this->InlineAddUrl = $this->PageUrl() . "a=add";
        $this->GridAddUrl = $this->PageUrl() . "a=gridadd";
        $this->GridEditUrl = $this->PageUrl() . "a=gridedit";
        $this->MultiDeleteUrl = "viewsolicitudframedelete.php";
        $this->MultiUpdateUrl = "viewsolicitudframeupdate.php";

        // Table object (usuario)
        if (!isset($GLOBALS['usuario'])) $GLOBALS['usuario'] = new cusuario();

        // Page ID
        if (!defined("EW_PAGE_ID"))
            define("EW_PAGE_ID", 'list', TRUE);

        // Table name (for backward compatibility)
        if (!defined("EW_TABLE_NAME"))
            define("EW_TABLE_NAME", 'viewsolicitudframe', TRUE);

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
        $this->FilterOptions->TagClassName = "ewFilterOption fviewsolicitudframelistsrch";

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
        $this->CurrentAction = (@$_GET["a"] <> "") ? $_GET["a"] : @$_POST["a_list"]; // Set up current action

        // Get grid add count
        $gridaddcnt = @$_GET[EW_TABLE_GRID_ADD_ROW_COUNT];
        if (is_numeric($gridaddcnt) && $gridaddcnt > 0)
            $this->GridAddRowCount = $gridaddcnt;

        // Set up list options
        $this->SetupListOptions();
        global $gbOldSkipHeaderFooter, $gbSkipHeaderFooter;
        $gbOldSkipHeaderFooter = $gbSkipHeaderFooter;
        $gbSkipHeaderFooter = TRUE;
        $this->id->SetVisibility();
        if ($this->IsAdd() || $this->IsCopy() || $this->IsGridAdd())
            $this->id->Visible = FALSE;
        $this->name->SetVisibility();
        $this->lastname->SetVisibility();
        $this->_email->SetVisibility();
        $this->address->SetVisibility();
        $this->email_contacto->SetVisibility();
        $this->phone->SetVisibility();
        $this->cell->SetVisibility();
        $this->id_sucursal->SetVisibility();

        // Global Page Loading event (in userfn*.php)
//        Page_Loading();

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
        global $gbOldSkipHeaderFooter, $gbSkipHeaderFooter;
        $gbSkipHeaderFooter = $gbOldSkipHeaderFooter;

        // Page Unload event
        $this->Page_Unload();

        // Global Page Unloaded event (in userfn*.php)
        Page_Unloaded();

        // Export
        global $EW_EXPORT, $viewsolicitudframe;
        if ($this->CustomExport <> "" && $this->CustomExport == $this->Export && array_key_exists($this->CustomExport, $EW_EXPORT)) {
            $sContent = ob_get_contents();
            if ($gsExportFile == "") $gsExportFile = $this->TableVar;
            $class = $EW_EXPORT[$this->CustomExport];
            if (class_exists($class)) {
                $doc = new $class($viewsolicitudframe);
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
            $this->UpdateSort($this->id); // id
            $this->UpdateSort($this->name); // name
            $this->UpdateSort($this->lastname); // lastname
            $this->UpdateSort($this->_email); // email
            $this->UpdateSort($this->address); // address
            $this->UpdateSort($this->email_contacto); // email_contacto
            $this->UpdateSort($this->phone); // phone
            $this->UpdateSort($this->cell); // cell
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
                $this->id->setSort("");
                $this->name->setSort("");
                $this->lastname->setSort("");
                $this->_email->setSort("");
                $this->address->setSort("");
                $this->email_contacto->setSort("");
                $this->phone->setSort("");
                $this->cell->setSort("");
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
        $item->Body = "<a class=\"ewSaveFilter\" data-form=\"fviewsolicitudframelistsrch\" href=\"#\">" . $Language->Phrase("SaveCurrentFilter") . "</a>";
        $item->Visible = FALSE;
        $item = &$this->FilterOptions->Add("deletefilter");
        $item->Body = "<a class=\"ewDeleteFilter\" data-form=\"fviewsolicitudframelistsrch\" href=\"#\">" . $Language->Phrase("DeleteFilter") . "</a>";
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
                $item->Body = "<a class=\"ewAction ewListAction\" title=\"" . ew_HtmlEncode($caption) . "\" data-caption=\"" . ew_HtmlEncode($caption) . "\" href=\"\" onclick=\"ew_SubmitAction(event,jQuery.extend({f:document.fviewsolicitudframelist}," . $listaction->ToJson(TRUE) . "));return false;\">" . $icon . "</a>";
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
        $this->name->CurrentValue = NULL;
        $this->name->OldValue = $this->name->CurrentValue;
        $this->lastname->CurrentValue = NULL;
        $this->lastname->OldValue = $this->lastname->CurrentValue;
        $this->_email->CurrentValue = NULL;
        $this->_email->OldValue = $this->_email->CurrentValue;
        $this->address->CurrentValue = NULL;
        $this->address->OldValue = $this->address->CurrentValue;
        $this->nombre_contacto->CurrentValue = NULL;
        $this->nombre_contacto->OldValue = $this->nombre_contacto->CurrentValue;
        $this->email_contacto->CurrentValue = $_SESSION["usr"];
        $this->latitud->CurrentValue = NULL;
        $this->latitud->OldValue = $this->latitud->CurrentValue;
        $this->longitud->CurrentValue = NULL;
        $this->longitud->OldValue = $this->longitud->CurrentValue;
        $this->phone->CurrentValue = NULL;
        $this->phone->OldValue = $this->phone->CurrentValue;
        $this->cell->CurrentValue = NULL;
        $this->cell->OldValue = $this->cell->CurrentValue;
        $this->id_sucursal->CurrentValue = $_SESSION["sucursal"];
        $this->tipoinmueble->CurrentValue = NULL;
        $this->tipoinmueble->OldValue = $this->tipoinmueble->CurrentValue;
        $this->id_ciudad_inmueble->CurrentValue = NULL;
        $this->id_ciudad_inmueble->OldValue = $this->id_ciudad_inmueble->CurrentValue;
        $this->id_provincia_inmueble->CurrentValue = NULL;
        $this->id_provincia_inmueble->OldValue = $this->id_provincia_inmueble->CurrentValue;
        $this->imagen_inmueble01->Upload->DbValue = NULL;
        $this->imagen_inmueble01->OldValue = $this->imagen_inmueble01->Upload->DbValue;
        $this->imagen_inmueble02->Upload->DbValue = NULL;
        $this->imagen_inmueble02->OldValue = $this->imagen_inmueble02->Upload->DbValue;
        $this->imagen_inmueble03->Upload->DbValue = NULL;
        $this->imagen_inmueble03->OldValue = $this->imagen_inmueble03->Upload->DbValue;
        $this->imagen_inmueble04->Upload->DbValue = NULL;
        $this->imagen_inmueble04->OldValue = $this->imagen_inmueble04->Upload->DbValue;
        $this->imagen_inmueble05->Upload->DbValue = NULL;
        $this->imagen_inmueble05->OldValue = $this->imagen_inmueble05->Upload->DbValue;
        $this->imagen_inmueble06->Upload->DbValue = NULL;
        $this->imagen_inmueble06->OldValue = $this->imagen_inmueble06->Upload->DbValue;
        $this->imagen_inmueble07->Upload->DbValue = NULL;
        $this->imagen_inmueble07->OldValue = $this->imagen_inmueble07->Upload->DbValue;
        $this->imagen_inmueble08->Upload->DbValue = NULL;
        $this->imagen_inmueble08->OldValue = $this->imagen_inmueble08->Upload->DbValue;
        $this->tipovehiculo->CurrentValue = NULL;
        $this->tipovehiculo->OldValue = $this->tipovehiculo->CurrentValue;
        $this->id_ciudad_vehiculo->CurrentValue = NULL;
        $this->id_ciudad_vehiculo->OldValue = $this->id_ciudad_vehiculo->CurrentValue;
        $this->id_provincia_vehiculo->CurrentValue = NULL;
        $this->id_provincia_vehiculo->OldValue = $this->id_provincia_vehiculo->CurrentValue;
        $this->imagen_vehiculo01->Upload->DbValue = NULL;
        $this->imagen_vehiculo01->OldValue = $this->imagen_vehiculo01->Upload->DbValue;
        $this->imagen_vehiculo02->Upload->DbValue = NULL;
        $this->imagen_vehiculo02->OldValue = $this->imagen_vehiculo02->Upload->DbValue;
        $this->imagen_vehiculo03->Upload->DbValue = NULL;
        $this->imagen_vehiculo03->OldValue = $this->imagen_vehiculo03->Upload->DbValue;
        $this->imagen_vehiculo04->Upload->DbValue = NULL;
        $this->imagen_vehiculo04->OldValue = $this->imagen_vehiculo04->Upload->DbValue;
        $this->imagen_vehiculo05->Upload->DbValue = NULL;
        $this->imagen_vehiculo05->OldValue = $this->imagen_vehiculo05->Upload->DbValue;
        $this->imagen_vehiculo06->Upload->DbValue = NULL;
        $this->imagen_vehiculo06->OldValue = $this->imagen_vehiculo06->Upload->DbValue;
        $this->imagen_vehiculo07->Upload->DbValue = NULL;
        $this->imagen_vehiculo07->OldValue = $this->imagen_vehiculo07->Upload->DbValue;
        $this->imagen_vehiculo08->Upload->DbValue = NULL;
        $this->imagen_vehiculo08->OldValue = $this->imagen_vehiculo08->Upload->DbValue;
        $this->tipomaquinaria->CurrentValue = NULL;
        $this->tipomaquinaria->OldValue = $this->tipomaquinaria->CurrentValue;
        $this->id_ciudad_maquinaria->CurrentValue = NULL;
        $this->id_ciudad_maquinaria->OldValue = $this->id_ciudad_maquinaria->CurrentValue;
        $this->id_provincia_maquinaria->CurrentValue = NULL;
        $this->id_provincia_maquinaria->OldValue = $this->id_provincia_maquinaria->CurrentValue;
        $this->imagen_maquinaria01->Upload->DbValue = NULL;
        $this->imagen_maquinaria01->OldValue = $this->imagen_maquinaria01->Upload->DbValue;
        $this->imagen_maquinaria02->Upload->DbValue = NULL;
        $this->imagen_maquinaria02->OldValue = $this->imagen_maquinaria02->Upload->DbValue;
        $this->imagen_maquinaria03->Upload->DbValue = NULL;
        $this->imagen_maquinaria03->OldValue = $this->imagen_maquinaria03->Upload->DbValue;
        $this->imagen_maquinaria04->Upload->DbValue = NULL;
        $this->imagen_maquinaria04->OldValue = $this->imagen_maquinaria04->Upload->DbValue;
        $this->imagen_maquinaria05->Upload->DbValue = NULL;
        $this->imagen_maquinaria05->OldValue = $this->imagen_maquinaria05->Upload->DbValue;
        $this->imagen_maquinaria06->Upload->DbValue = NULL;
        $this->imagen_maquinaria06->OldValue = $this->imagen_maquinaria06->Upload->DbValue;
        $this->imagen_maquinaria07->Upload->DbValue = NULL;
        $this->imagen_maquinaria07->OldValue = $this->imagen_maquinaria07->Upload->DbValue;
        $this->imagen_maquinaria08->Upload->DbValue = NULL;
        $this->imagen_maquinaria08->OldValue = $this->imagen_maquinaria08->Upload->DbValue;
        $this->tipomercaderia->CurrentValue = NULL;
        $this->tipomercaderia->OldValue = $this->tipomercaderia->CurrentValue;
        $this->imagen_mercaderia01->Upload->DbValue = NULL;
        $this->imagen_mercaderia01->OldValue = $this->imagen_mercaderia01->Upload->DbValue;
        $this->documento_mercaderia->CurrentValue = NULL;
        $this->documento_mercaderia->OldValue = $this->documento_mercaderia->CurrentValue;
        $this->tipoespecial->CurrentValue = NULL;
        $this->tipoespecial->OldValue = $this->tipoespecial->CurrentValue;
        $this->imagen_tipoespecial01->Upload->DbValue = NULL;
        $this->imagen_tipoespecial01->OldValue = $this->imagen_tipoespecial01->Upload->DbValue;
        $this->is_active->CurrentValue = 1;
        $this->documentos->CurrentValue = NULL;
        $this->documentos->OldValue = $this->documentos->CurrentValue;
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
    }

    // Load form values
    function LoadFormValues() {

        // Load from form
        global $objForm;
        if (!$this->id->FldIsDetailKey && $this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
            $this->id->setFormValue($objForm->GetValue("x_id"));
        if (!$this->name->FldIsDetailKey) {
            $this->name->setFormValue($objForm->GetValue("x_name"));
        }
        if (!$this->lastname->FldIsDetailKey) {
            $this->lastname->setFormValue($objForm->GetValue("x_lastname"));
        }
        if (!$this->_email->FldIsDetailKey) {
            $this->_email->setFormValue($objForm->GetValue("x__email"));
        }
        if (!$this->address->FldIsDetailKey) {
            $this->address->setFormValue($objForm->GetValue("x_address"));
        }
        if (!$this->email_contacto->FldIsDetailKey) {
            $this->email_contacto->setFormValue($objForm->GetValue("x_email_contacto"));
        }
        if (!$this->phone->FldIsDetailKey) {
            $this->phone->setFormValue($objForm->GetValue("x_phone"));
        }
        if (!$this->cell->FldIsDetailKey) {
            $this->cell->setFormValue($objForm->GetValue("x_cell"));
        }
        if (!$this->id_sucursal->FldIsDetailKey) {
            $this->id_sucursal->setFormValue($objForm->GetValue("x_id_sucursal"));
        }
    }

    // Restore form values
    function RestoreFormValues() {
        global $objForm;
        if ($this->CurrentAction <> "gridadd" && $this->CurrentAction <> "add")
            $this->id->CurrentValue = $this->id->FormValue;
        $this->name->CurrentValue = $this->name->FormValue;
        $this->lastname->CurrentValue = $this->lastname->FormValue;
        $this->_email->CurrentValue = $this->_email->FormValue;
        $this->address->CurrentValue = $this->address->FormValue;
        $this->email_contacto->CurrentValue = $this->email_contacto->FormValue;
        $this->phone->CurrentValue = $this->phone->FormValue;
        $this->cell->CurrentValue = $this->cell->FormValue;
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
        $this->lastname->setDbValue($row['lastname']);
        $this->_email->setDbValue($row['email']);
        $this->address->setDbValue($row['address']);
        $this->nombre_contacto->setDbValue($row['nombre_contacto']);
        $this->email_contacto->setDbValue($row['email_contacto']);
        $this->latitud->setDbValue($row['latitud']);
        $this->longitud->setDbValue($row['longitud']);
        $this->phone->setDbValue($row['phone']);
        $this->cell->setDbValue($row['cell']);
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
    }

    // Return a row with default values
    function NewRow() {
        $this->LoadDefaultValues();
        $row = array();
        $row['id'] = $this->id->CurrentValue;
        $row['name'] = $this->name->CurrentValue;
        $row['lastname'] = $this->lastname->CurrentValue;
        $row['email'] = $this->_email->CurrentValue;
        $row['address'] = $this->address->CurrentValue;
        $row['nombre_contacto'] = $this->nombre_contacto->CurrentValue;
        $row['email_contacto'] = $this->email_contacto->CurrentValue;
        $row['latitud'] = $this->latitud->CurrentValue;
        $row['longitud'] = $this->longitud->CurrentValue;
        $row['phone'] = $this->phone->CurrentValue;
        $row['cell'] = $this->cell->CurrentValue;
        $row['id_sucursal'] = $this->id_sucursal->CurrentValue;
        $row['tipoinmueble'] = $this->tipoinmueble->CurrentValue;
        $row['id_ciudad_inmueble'] = $this->id_ciudad_inmueble->CurrentValue;
        $row['id_provincia_inmueble'] = $this->id_provincia_inmueble->CurrentValue;
        $row['imagen_inmueble01'] = $this->imagen_inmueble01->Upload->DbValue;
        $row['imagen_inmueble02'] = $this->imagen_inmueble02->Upload->DbValue;
        $row['imagen_inmueble03'] = $this->imagen_inmueble03->Upload->DbValue;
        $row['imagen_inmueble04'] = $this->imagen_inmueble04->Upload->DbValue;
        $row['imagen_inmueble05'] = $this->imagen_inmueble05->Upload->DbValue;
        $row['imagen_inmueble06'] = $this->imagen_inmueble06->Upload->DbValue;
        $row['imagen_inmueble07'] = $this->imagen_inmueble07->Upload->DbValue;
        $row['imagen_inmueble08'] = $this->imagen_inmueble08->Upload->DbValue;
        $row['tipovehiculo'] = $this->tipovehiculo->CurrentValue;
        $row['id_ciudad_vehiculo'] = $this->id_ciudad_vehiculo->CurrentValue;
        $row['id_provincia_vehiculo'] = $this->id_provincia_vehiculo->CurrentValue;
        $row['imagen_vehiculo01'] = $this->imagen_vehiculo01->Upload->DbValue;
        $row['imagen_vehiculo02'] = $this->imagen_vehiculo02->Upload->DbValue;
        $row['imagen_vehiculo03'] = $this->imagen_vehiculo03->Upload->DbValue;
        $row['imagen_vehiculo04'] = $this->imagen_vehiculo04->Upload->DbValue;
        $row['imagen_vehiculo05'] = $this->imagen_vehiculo05->Upload->DbValue;
        $row['imagen_vehiculo06'] = $this->imagen_vehiculo06->Upload->DbValue;
        $row['imagen_vehiculo07'] = $this->imagen_vehiculo07->Upload->DbValue;
        $row['imagen_vehiculo08'] = $this->imagen_vehiculo08->Upload->DbValue;
        $row['tipomaquinaria'] = $this->tipomaquinaria->CurrentValue;
        $row['id_ciudad_maquinaria'] = $this->id_ciudad_maquinaria->CurrentValue;
        $row['id_provincia_maquinaria'] = $this->id_provincia_maquinaria->CurrentValue;
        $row['imagen_maquinaria01'] = $this->imagen_maquinaria01->Upload->DbValue;
        $row['imagen_maquinaria02'] = $this->imagen_maquinaria02->Upload->DbValue;
        $row['imagen_maquinaria03'] = $this->imagen_maquinaria03->Upload->DbValue;
        $row['imagen_maquinaria04'] = $this->imagen_maquinaria04->Upload->DbValue;
        $row['imagen_maquinaria05'] = $this->imagen_maquinaria05->Upload->DbValue;
        $row['imagen_maquinaria06'] = $this->imagen_maquinaria06->Upload->DbValue;
        $row['imagen_maquinaria07'] = $this->imagen_maquinaria07->Upload->DbValue;
        $row['imagen_maquinaria08'] = $this->imagen_maquinaria08->Upload->DbValue;
        $row['tipomercaderia'] = $this->tipomercaderia->CurrentValue;
        $row['imagen_mercaderia01'] = $this->imagen_mercaderia01->Upload->DbValue;
        $row['documento_mercaderia'] = $this->documento_mercaderia->CurrentValue;
        $row['tipoespecial'] = $this->tipoespecial->CurrentValue;
        $row['imagen_tipoespecial01'] = $this->imagen_tipoespecial01->Upload->DbValue;
        $row['is_active'] = $this->is_active->CurrentValue;
        $row['documentos'] = $this->documentos->CurrentValue;
        $row['created_at'] = $this->created_at->CurrentValue;
        $row['DateModified'] = $this->DateModified->CurrentValue;
        $row['DateDeleted'] = $this->DateDeleted->CurrentValue;
        $row['CreatedBy'] = $this->CreatedBy->CurrentValue;
        $row['ModifiedBy'] = $this->ModifiedBy->CurrentValue;
        $row['DeletedBy'] = $this->DeletedBy->CurrentValue;
        return $row;
    }

    // Load DbValue from recordset
    function LoadDbValues(&$rs) {
        if (!$rs || !is_array($rs) && $rs->EOF)
            return;
        $row = is_array($rs) ? $rs : $rs->fields;
        $this->id->DbValue = $row['id'];
        $this->name->DbValue = $row['name'];
        $this->lastname->DbValue = $row['lastname'];
        $this->_email->DbValue = $row['email'];
        $this->address->DbValue = $row['address'];
        $this->nombre_contacto->DbValue = $row['nombre_contacto'];
        $this->email_contacto->DbValue = $row['email_contacto'];
        $this->latitud->DbValue = $row['latitud'];
        $this->longitud->DbValue = $row['longitud'];
        $this->phone->DbValue = $row['phone'];
        $this->cell->DbValue = $row['cell'];
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
        // lastname
        // email
        // address
        // nombre_contacto
        // email_contacto
        // latitud

        $this->latitud->CellCssStyle = "white-space: nowrap;";

        // longitud
        $this->longitud->CellCssStyle = "white-space: nowrap;";

        // phone
        // cell
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

            // lastname
            $this->lastname->ViewValue = $this->lastname->CurrentValue;
            $this->lastname->ViewCustomAttributes = "";

            // email
            $this->_email->ViewValue = $this->_email->CurrentValue;
            $this->_email->ViewCustomAttributes = "";

            // address
            $this->address->ViewValue = $this->address->CurrentValue;
            $this->address->ViewCustomAttributes = "";

            // email_contacto
            $this->email_contacto->ViewValue = $this->email_contacto->CurrentValue;
            $this->email_contacto->ViewCustomAttributes = "";

            // phone
            $this->phone->ViewValue = $this->phone->CurrentValue;
            $this->phone->ViewCustomAttributes = "";

            // cell
            $this->cell->ViewValue = $this->cell->CurrentValue;
            $this->cell->ViewCustomAttributes = "";

            // id_sucursal
            $this->id_sucursal->ViewValue = $this->id_sucursal->CurrentValue;
            $this->id_sucursal->ViewCustomAttributes = "";

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

            // id
            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";
            $this->id->TooltipValue = "";

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

            // email_contacto
            $this->email_contacto->LinkCustomAttributes = "";
            $this->email_contacto->HrefValue = "";
            $this->email_contacto->TooltipValue = "";

            // phone
            $this->phone->LinkCustomAttributes = "";
            $this->phone->HrefValue = "";
            $this->phone->TooltipValue = "";

            // cell
            $this->cell->LinkCustomAttributes = "";
            $this->cell->HrefValue = "";
            $this->cell->TooltipValue = "";

            // id_sucursal
            $this->id_sucursal->LinkCustomAttributes = "";
            $this->id_sucursal->HrefValue = "";
            $this->id_sucursal->TooltipValue = "";
        } elseif ($this->RowType == EW_ROWTYPE_ADD) { // Add row

            // id
            // name

            $this->name->EditAttrs["class"] = "form-control";
            $this->name->EditCustomAttributes = "";
            $this->name->EditValue = ew_HtmlEncode($this->name->CurrentValue);
            $this->name->PlaceHolder = ew_RemoveHtml($this->name->FldTitle());

            // lastname
            $this->lastname->EditAttrs["class"] = "form-control";
            $this->lastname->EditCustomAttributes = "";
            $this->lastname->EditValue = ew_HtmlEncode($this->lastname->CurrentValue);
            $this->lastname->PlaceHolder = ew_RemoveHtml($this->lastname->FldTitle());

            // email
            $this->_email->EditAttrs["class"] = "form-control";
            $this->_email->EditCustomAttributes = "";
            $this->_email->EditValue = ew_HtmlEncode($this->_email->CurrentValue);
            $this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldTitle());

            // address
            $this->address->EditAttrs["class"] = "form-control";
            $this->address->EditCustomAttributes = "";
            $this->address->EditValue = ew_HtmlEncode($this->address->CurrentValue);
            $this->address->PlaceHolder = ew_RemoveHtml($this->address->FldTitle());

            // email_contacto
            $this->email_contacto->EditAttrs["class"] = "form-control";
            $this->email_contacto->EditCustomAttributes = "";
            $this->email_contacto->CurrentValue = $_SESSION["usr"];

            // phone
            $this->phone->EditAttrs["class"] = "form-control";
            $this->phone->EditCustomAttributes = "";
            $this->phone->EditValue = ew_HtmlEncode($this->phone->CurrentValue);
            $this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldTitle());

            // cell
            $this->cell->EditAttrs["class"] = "form-control";
            $this->cell->EditCustomAttributes = "";
            $this->cell->EditValue = ew_HtmlEncode($this->cell->CurrentValue);
            $this->cell->PlaceHolder = ew_RemoveHtml($this->cell->FldTitle());

            // id_sucursal
            $this->id_sucursal->EditAttrs["class"] = "form-control";
            $this->id_sucursal->EditCustomAttributes = "";
            $this->id_sucursal->CurrentValue = $_SESSION["sucursal"];

            // Add refer script
            // id

            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // name
            $this->name->LinkCustomAttributes = "";
            $this->name->HrefValue = "";

            // lastname
            $this->lastname->LinkCustomAttributes = "";
            $this->lastname->HrefValue = "";

            // email
            $this->_email->LinkCustomAttributes = "";
            $this->_email->HrefValue = "";

            // address
            $this->address->LinkCustomAttributes = "";
            $this->address->HrefValue = "";

            // email_contacto
            $this->email_contacto->LinkCustomAttributes = "";
            $this->email_contacto->HrefValue = "";

            // phone
            $this->phone->LinkCustomAttributes = "";
            $this->phone->HrefValue = "";

            // cell
            $this->cell->LinkCustomAttributes = "";
            $this->cell->HrefValue = "";

            // id_sucursal
            $this->id_sucursal->LinkCustomAttributes = "";
            $this->id_sucursal->HrefValue = "";
        } elseif ($this->RowType == EW_ROWTYPE_EDIT) { // Edit row

            // id
            $this->id->EditAttrs["class"] = "form-control";
            $this->id->EditCustomAttributes = "";
            $this->id->EditValue = $this->id->CurrentValue;
            $this->id->ViewCustomAttributes = "";

            // name
            $this->name->EditAttrs["class"] = "form-control";
            $this->name->EditCustomAttributes = "";
            $this->name->EditValue = ew_HtmlEncode($this->name->CurrentValue);
            $this->name->PlaceHolder = ew_RemoveHtml($this->name->FldTitle());

            // lastname
            $this->lastname->EditAttrs["class"] = "form-control";
            $this->lastname->EditCustomAttributes = "";
            $this->lastname->EditValue = ew_HtmlEncode($this->lastname->CurrentValue);
            $this->lastname->PlaceHolder = ew_RemoveHtml($this->lastname->FldTitle());

            // email
            $this->_email->EditAttrs["class"] = "form-control";
            $this->_email->EditCustomAttributes = "";
            $this->_email->EditValue = ew_HtmlEncode($this->_email->CurrentValue);
            $this->_email->PlaceHolder = ew_RemoveHtml($this->_email->FldTitle());

            // address
            $this->address->EditAttrs["class"] = "form-control";
            $this->address->EditCustomAttributes = "";
            $this->address->EditValue = ew_HtmlEncode($this->address->CurrentValue);
            $this->address->PlaceHolder = ew_RemoveHtml($this->address->FldTitle());

            // email_contacto
            $this->email_contacto->EditAttrs["class"] = "form-control";
            $this->email_contacto->EditCustomAttributes = "";

            // phone
            $this->phone->EditAttrs["class"] = "form-control";
            $this->phone->EditCustomAttributes = "";
            $this->phone->EditValue = ew_HtmlEncode($this->phone->CurrentValue);
            $this->phone->PlaceHolder = ew_RemoveHtml($this->phone->FldTitle());

            // cell
            $this->cell->EditAttrs["class"] = "form-control";
            $this->cell->EditCustomAttributes = "";
            $this->cell->EditValue = ew_HtmlEncode($this->cell->CurrentValue);
            $this->cell->PlaceHolder = ew_RemoveHtml($this->cell->FldTitle());

            // id_sucursal
            $this->id_sucursal->EditAttrs["class"] = "form-control";
            $this->id_sucursal->EditCustomAttributes = "";

            // Edit refer script
            // id

            $this->id->LinkCustomAttributes = "";
            $this->id->HrefValue = "";

            // name
            $this->name->LinkCustomAttributes = "";
            $this->name->HrefValue = "";

            // lastname
            $this->lastname->LinkCustomAttributes = "";
            $this->lastname->HrefValue = "";

            // email
            $this->_email->LinkCustomAttributes = "";
            $this->_email->HrefValue = "";

            // address
            $this->address->LinkCustomAttributes = "";
            $this->address->HrefValue = "";

            // email_contacto
            $this->email_contacto->LinkCustomAttributes = "";
            $this->email_contacto->HrefValue = "";
            $this->email_contacto->TooltipValue = "";

            // phone
            $this->phone->LinkCustomAttributes = "";
            $this->phone->HrefValue = "";

            // cell
            $this->cell->LinkCustomAttributes = "";
            $this->cell->HrefValue = "";

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
        if (!$this->name->FldIsDetailKey && !is_null($this->name->FormValue) && $this->name->FormValue == "") {
            ew_AddMessage($gsFormError, str_replace("%s", $this->name->FldCaption(), $this->name->ReqErrMsg));
        }
        if (!$this->_email->FldIsDetailKey && !is_null($this->_email->FormValue) && $this->_email->FormValue == "") {
            ew_AddMessage($gsFormError, str_replace("%s", $this->_email->FldCaption(), $this->_email->ReqErrMsg));
        }
        if (!ew_CheckEmail($this->_email->FormValue)) {
            ew_AddMessage($gsFormError, $this->_email->FldErrMsg());
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

            // name
            $this->name->SetDbValueDef($rsnew, $this->name->CurrentValue, NULL, $this->name->ReadOnly);

            // lastname
            $this->lastname->SetDbValueDef($rsnew, $this->lastname->CurrentValue, NULL, $this->lastname->ReadOnly);

            // email
            $this->_email->SetDbValueDef($rsnew, $this->_email->CurrentValue, NULL, $this->_email->ReadOnly);

            // address
            $this->address->SetDbValueDef($rsnew, $this->address->CurrentValue, NULL, $this->address->ReadOnly);

            // phone
            $this->phone->SetDbValueDef($rsnew, $this->phone->CurrentValue, NULL, $this->phone->ReadOnly);

            // cell
            $this->cell->SetDbValueDef($rsnew, $this->cell->CurrentValue, NULL, $this->cell->ReadOnly);

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

        // name
        $this->name->SetDbValueDef($rsnew, $this->name->CurrentValue, NULL, FALSE);

        // lastname
        $this->lastname->SetDbValueDef($rsnew, $this->lastname->CurrentValue, NULL, FALSE);

        // email
        $this->_email->SetDbValueDef($rsnew, $this->_email->CurrentValue, NULL, FALSE);

        // address
        $this->address->SetDbValueDef($rsnew, $this->address->CurrentValue, NULL, FALSE);

        // email_contacto
        $this->email_contacto->SetDbValueDef($rsnew, $this->email_contacto->CurrentValue, NULL, FALSE);

        // phone
        $this->phone->SetDbValueDef($rsnew, $this->phone->CurrentValue, NULL, FALSE);

        // cell
        $this->cell->SetDbValueDef($rsnew, $this->cell->CurrentValue, NULL, FALSE);

        // id_sucursal
        $this->id_sucursal->SetDbValueDef($rsnew, $this->id_sucursal->CurrentValue, 0, FALSE);

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
if (!isset($viewsolicitudframe_list)) $viewsolicitudframe_list = new cviewsolicitudframe_list();

// Page init
$viewsolicitudframe_list->Page_Init();

// Page main
$viewsolicitudframe_list->Page_Main();

// Global Page Rendering event (in userfn*.php)
//Page_Rendering();

// Page Rendering event
$viewsolicitudframe_list->Page_Render();
?>
<script type="text/javascript">

    // Form object
    var CurrentPageID = EW_PAGE_ID = "list";
    var CurrentForm = fviewsolicitudframelist = new ew_Form("fviewsolicitudframelist", "list");
    fviewsolicitudframelist.FormKeyCountName = '<?php echo $viewsolicitudframe_list->FormKeyCountName ?>';

    // Validate form
    fviewsolicitudframelist.Validate = function() {
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
            elm = this.GetElements("x" + infix + "_name");
            if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
                return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewsolicitudframe->name->FldCaption(), $viewsolicitudframe->name->ReqErrMsg)) ?>");
            elm = this.GetElements("x" + infix + "__email");
            if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
                return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewsolicitudframe->_email->FldCaption(), $viewsolicitudframe->_email->ReqErrMsg)) ?>");
            elm = this.GetElements("x" + infix + "__email");
            if (elm && !ew_CheckEmail(elm.value))
                return this.OnError(elm, "<?php echo ew_JsEncode2($viewsolicitudframe->_email->FldErrMsg()) ?>");

            // Fire Form_CustomValidate event
            if (!this.Form_CustomValidate(fobj))
                return false;
        }
        return true;
    }

    // Form_CustomValidate event
    fviewsolicitudframelist.Form_CustomValidate =
        function(fobj) { // DO NOT CHANGE THIS LINE!

            // Your custom validation code here, return false if invalid.
            return true;
        }

    // Use JavaScript validation or not
    fviewsolicitudframelist.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

    // Dynamic selection lists
    // Form object for search

</script>
<script type="text/javascript">

    // Write your client script here, no need to add script tags.
</script>
<div class="ewToolbar">
    <?php if ($viewsolicitudframe_list->TotalRecs > 0 && $viewsolicitudframe_list->ExportOptions->Visible()) { ?>
        <?php $viewsolicitudframe_list->ExportOptions->Render("body") ?>
    <?php } ?>
    <div class="clearfix"></div>
</div>
<?php
$bSelectLimit = $viewsolicitudframe_list->UseSelectLimit;
if ($bSelectLimit) {
    if ($viewsolicitudframe_list->TotalRecs <= 0)
        $viewsolicitudframe_list->TotalRecs = $viewsolicitudframe->ListRecordCount();
} else {
    if (!$viewsolicitudframe_list->Recordset && ($viewsolicitudframe_list->Recordset = $viewsolicitudframe_list->LoadRecordset()))
        $viewsolicitudframe_list->TotalRecs = $viewsolicitudframe_list->Recordset->RecordCount();
}
$viewsolicitudframe_list->StartRec = 1;
if ($viewsolicitudframe_list->DisplayRecs <= 0 || ($viewsolicitudframe->Export <> "" && $viewsolicitudframe->ExportAll)) // Display all records
    $viewsolicitudframe_list->DisplayRecs = $viewsolicitudframe_list->TotalRecs;
if (!($viewsolicitudframe->Export <> "" && $viewsolicitudframe->ExportAll))
    $viewsolicitudframe_list->SetupStartRec(); // Set up start record position
if ($bSelectLimit)
    $viewsolicitudframe_list->Recordset = $viewsolicitudframe_list->LoadRecordset($viewsolicitudframe_list->StartRec-1, $viewsolicitudframe_list->DisplayRecs);

// Set no record found message
if ($viewsolicitudframe->CurrentAction == "" && $viewsolicitudframe_list->TotalRecs == 0) {
    if (!$Security->CanList())
        $viewsolicitudframe_list->setWarningMessage(ew_DeniedMsg());
    if ($viewsolicitudframe_list->SearchWhere == "0=101")
        $viewsolicitudframe_list->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
    else
        $viewsolicitudframe_list->setWarningMessage($Language->Phrase("NoRecord"));
}
$viewsolicitudframe_list->RenderOtherOptions();
?>
<?php $viewsolicitudframe_list->ShowPageHeader(); ?>
<?php
$viewsolicitudframe_list->ShowMessage();
?>
<?php if ($viewsolicitudframe_list->TotalRecs > 0 || $viewsolicitudframe->CurrentAction <> "") { ?>
    <div class="box ewBox ewGrid<?php if ($viewsolicitudframe_list->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewsolicitudframe">
        <form name="fviewsolicitudframelist" id="fviewsolicitudframelist" class="form-inline ewForm ewListForm" action="<?php echo ew_CurrentPage() ?>" method="post">
            <?php if ($viewsolicitudframe_list->CheckToken) { ?>
                <input type="hidden" name="<?php echo EW_TOKEN_NAME ?>" value="<?php echo $viewsolicitudframe_list->Token ?>">
            <?php } ?>
            <input type="hidden" name="t" value="viewsolicitudframe">
            <div id="gmp_viewsolicitudframe" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
                <?php if ($viewsolicitudframe_list->TotalRecs > 0 || $viewsolicitudframe->CurrentAction == "gridedit") { ?>
                    <table id="tbl_viewsolicitudframelist" class="table ewTable">
                        <thead>
                        <tr class="ewTableHeader">
                            <?php

                            // Header row
                            $viewsolicitudframe_list->RowType = EW_ROWTYPE_HEADER;

                            // Render list options
                            $viewsolicitudframe_list->RenderListOptions();

                            // Render list options (header, left)
                            $viewsolicitudframe_list->ListOptions->Render("header", "left");
                            ?>
                            <?php if ($viewsolicitudframe->id->Visible) { // id ?>
                                <?php if ($viewsolicitudframe->SortUrl($viewsolicitudframe->id) == "") { ?>
                                    <th data-name="id" class="<?php echo $viewsolicitudframe->id->HeaderCellClass() ?>"><div id="elh_viewsolicitudframe_id" class="viewsolicitudframe_id"><div class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->id->FldCaption() ?></div></div></th>
                                <?php } else { ?>
                                    <th data-name="id" class="<?php echo $viewsolicitudframe->id->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitudframe->SortUrl($viewsolicitudframe->id) ?>',1);"><div id="elh_viewsolicitudframe_id" class="viewsolicitudframe_id">
                                                <div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitudframe->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitudframe->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
                                            </div></div></th>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($viewsolicitudframe->name->Visible) { // name ?>
                                <?php if ($viewsolicitudframe->SortUrl($viewsolicitudframe->name) == "") { ?>
                                    <th data-name="name" class="<?php echo $viewsolicitudframe->name->HeaderCellClass() ?>"><div id="elh_viewsolicitudframe_name" class="viewsolicitudframe_name"><div class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->name->FldCaption() ?></div></div></th>
                                <?php } else { ?>
                                    <th data-name="name" class="<?php echo $viewsolicitudframe->name->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitudframe->SortUrl($viewsolicitudframe->name) ?>',1);"><div id="elh_viewsolicitudframe_name" class="viewsolicitudframe_name">
                                                <div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->name->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitudframe->name->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitudframe->name->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
                                            </div></div></th>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($viewsolicitudframe->lastname->Visible) { // lastname ?>
                                <?php if ($viewsolicitudframe->SortUrl($viewsolicitudframe->lastname) == "") { ?>
                                    <th data-name="lastname" class="<?php echo $viewsolicitudframe->lastname->HeaderCellClass() ?>"><div id="elh_viewsolicitudframe_lastname" class="viewsolicitudframe_lastname"><div class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->lastname->FldCaption() ?></div></div></th>
                                <?php } else { ?>
                                    <th data-name="lastname" class="<?php echo $viewsolicitudframe->lastname->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitudframe->SortUrl($viewsolicitudframe->lastname) ?>',1);"><div id="elh_viewsolicitudframe_lastname" class="viewsolicitudframe_lastname">
                                                <div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->lastname->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitudframe->lastname->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitudframe->lastname->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
                                            </div></div></th>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($viewsolicitudframe->_email->Visible) { // email ?>
                                <?php if ($viewsolicitudframe->SortUrl($viewsolicitudframe->_email) == "") { ?>
                                    <th data-name="_email" class="<?php echo $viewsolicitudframe->_email->HeaderCellClass() ?>"><div id="elh_viewsolicitudframe__email" class="viewsolicitudframe__email"><div class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->_email->FldCaption() ?></div></div></th>
                                <?php } else { ?>
                                    <th data-name="_email" class="<?php echo $viewsolicitudframe->_email->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitudframe->SortUrl($viewsolicitudframe->_email) ?>',1);"><div id="elh_viewsolicitudframe__email" class="viewsolicitudframe__email">
                                                <div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->_email->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitudframe->_email->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitudframe->_email->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
                                            </div></div></th>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($viewsolicitudframe->address->Visible) { // address ?>
                                <?php if ($viewsolicitudframe->SortUrl($viewsolicitudframe->address) == "") { ?>
                                    <th data-name="address" class="<?php echo $viewsolicitudframe->address->HeaderCellClass() ?>"><div id="elh_viewsolicitudframe_address" class="viewsolicitudframe_address"><div class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->address->FldCaption() ?></div></div></th>
                                <?php } else { ?>
                                    <th data-name="address" class="<?php echo $viewsolicitudframe->address->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitudframe->SortUrl($viewsolicitudframe->address) ?>',1);"><div id="elh_viewsolicitudframe_address" class="viewsolicitudframe_address">
                                                <div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->address->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitudframe->address->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitudframe->address->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
                                            </div></div></th>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($viewsolicitudframe->email_contacto->Visible) { // email_contacto ?>
                                <?php if ($viewsolicitudframe->SortUrl($viewsolicitudframe->email_contacto) == "") { ?>
                                    <th data-name="email_contacto" class="<?php echo $viewsolicitudframe->email_contacto->HeaderCellClass() ?>"><div id="elh_viewsolicitudframe_email_contacto" class="viewsolicitudframe_email_contacto"><div class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->email_contacto->FldCaption() ?></div></div></th>
                                <?php } else { ?>
                                    <th data-name="email_contacto" class="<?php echo $viewsolicitudframe->email_contacto->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitudframe->SortUrl($viewsolicitudframe->email_contacto) ?>',1);"><div id="elh_viewsolicitudframe_email_contacto" class="viewsolicitudframe_email_contacto">
                                                <div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->email_contacto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitudframe->email_contacto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitudframe->email_contacto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
                                            </div></div></th>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($viewsolicitudframe->phone->Visible) { // phone ?>
                                <?php if ($viewsolicitudframe->SortUrl($viewsolicitudframe->phone) == "") { ?>
                                    <th data-name="phone" class="<?php echo $viewsolicitudframe->phone->HeaderCellClass() ?>"><div id="elh_viewsolicitudframe_phone" class="viewsolicitudframe_phone"><div class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->phone->FldCaption() ?></div></div></th>
                                <?php } else { ?>
                                    <th data-name="phone" class="<?php echo $viewsolicitudframe->phone->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitudframe->SortUrl($viewsolicitudframe->phone) ?>',1);"><div id="elh_viewsolicitudframe_phone" class="viewsolicitudframe_phone">
                                                <div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->phone->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitudframe->phone->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitudframe->phone->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
                                            </div></div></th>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($viewsolicitudframe->cell->Visible) { // cell ?>
                                <?php if ($viewsolicitudframe->SortUrl($viewsolicitudframe->cell) == "") { ?>
                                    <th data-name="cell" class="<?php echo $viewsolicitudframe->cell->HeaderCellClass() ?>"><div id="elh_viewsolicitudframe_cell" class="viewsolicitudframe_cell"><div class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->cell->FldCaption() ?></div></div></th>
                                <?php } else { ?>
                                    <th data-name="cell" class="<?php echo $viewsolicitudframe->cell->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitudframe->SortUrl($viewsolicitudframe->cell) ?>',1);"><div id="elh_viewsolicitudframe_cell" class="viewsolicitudframe_cell">
                                                <div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->cell->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitudframe->cell->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitudframe->cell->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
                                            </div></div></th>
                                <?php } ?>
                            <?php } ?>
                            <?php if ($viewsolicitudframe->id_sucursal->Visible) { // id_sucursal ?>
                                <?php if ($viewsolicitudframe->SortUrl($viewsolicitudframe->id_sucursal) == "") { ?>
                                    <th data-name="id_sucursal" class="<?php echo $viewsolicitudframe->id_sucursal->HeaderCellClass() ?>"><div id="elh_viewsolicitudframe_id_sucursal" class="viewsolicitudframe_id_sucursal"><div class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->id_sucursal->FldCaption() ?></div></div></th>
                                <?php } else { ?>
                                    <th data-name="id_sucursal" class="<?php echo $viewsolicitudframe->id_sucursal->HeaderCellClass() ?>"><div class="ewPointer" onclick="ew_Sort(event,'<?php echo $viewsolicitudframe->SortUrl($viewsolicitudframe->id_sucursal) ?>',1);"><div id="elh_viewsolicitudframe_id_sucursal" class="viewsolicitudframe_id_sucursal">
                                                <div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewsolicitudframe->id_sucursal->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewsolicitudframe->id_sucursal->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewsolicitudframe->id_sucursal->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
                                            </div></div></th>
                                <?php } ?>
                            <?php } ?>
                            <?php

                            // Render list options (header, right)
                            $viewsolicitudframe_list->ListOptions->Render("header", "right");
                            ?>
                        </tr>
                        </thead>
                        <tbody>
                        <?php
                        if ($viewsolicitudframe->ExportAll && $viewsolicitudframe->Export <> "") {
                            $viewsolicitudframe_list->StopRec = $viewsolicitudframe_list->TotalRecs;
                        } else {

                            // Set the last record to display
                            if ($viewsolicitudframe_list->TotalRecs > $viewsolicitudframe_list->StartRec + $viewsolicitudframe_list->DisplayRecs - 1)
                                $viewsolicitudframe_list->StopRec = $viewsolicitudframe_list->StartRec + $viewsolicitudframe_list->DisplayRecs - 1;
                            else
                                $viewsolicitudframe_list->StopRec = $viewsolicitudframe_list->TotalRecs;
                        }

                        // Restore number of post back records
                        if ($objForm) {
                            $objForm->Index = -1;
                            if ($objForm->HasValue($viewsolicitudframe_list->FormKeyCountName) && ($viewsolicitudframe->CurrentAction == "gridadd" || $viewsolicitudframe->CurrentAction == "gridedit" || $viewsolicitudframe->CurrentAction == "F")) {
                                $viewsolicitudframe_list->KeyCount = $objForm->GetValue($viewsolicitudframe_list->FormKeyCountName);
                                $viewsolicitudframe_list->StopRec = $viewsolicitudframe_list->StartRec + $viewsolicitudframe_list->KeyCount - 1;
                            }
                        }
                        $viewsolicitudframe_list->RecCnt = $viewsolicitudframe_list->StartRec - 1;
                        if ($viewsolicitudframe_list->Recordset && !$viewsolicitudframe_list->Recordset->EOF) {
                            $viewsolicitudframe_list->Recordset->MoveFirst();
                            $bSelectLimit = $viewsolicitudframe_list->UseSelectLimit;
                            if (!$bSelectLimit && $viewsolicitudframe_list->StartRec > 1)
                                $viewsolicitudframe_list->Recordset->Move($viewsolicitudframe_list->StartRec - 1);
                        } elseif (!$viewsolicitudframe->AllowAddDeleteRow && $viewsolicitudframe_list->StopRec == 0) {
                            $viewsolicitudframe_list->StopRec = $viewsolicitudframe->GridAddRowCount;
                        }

                        // Initialize aggregate
                        $viewsolicitudframe->RowType = EW_ROWTYPE_AGGREGATEINIT;
                        $viewsolicitudframe->ResetAttrs();
                        $viewsolicitudframe_list->RenderRow();
                        $viewsolicitudframe_list->EditRowCnt = 0;
                        if ($viewsolicitudframe->CurrentAction == "edit")
                            $viewsolicitudframe_list->RowIndex = 1;
                        while ($viewsolicitudframe_list->RecCnt < $viewsolicitudframe_list->StopRec) {
                            $viewsolicitudframe_list->RecCnt++;
                            if (intval($viewsolicitudframe_list->RecCnt) >= intval($viewsolicitudframe_list->StartRec)) {
                                $viewsolicitudframe_list->RowCnt++;

                                // Set up key count
                                $viewsolicitudframe_list->KeyCount = $viewsolicitudframe_list->RowIndex;

                                // Init row class and style
                                $viewsolicitudframe->ResetAttrs();
                                $viewsolicitudframe->CssClass = "";
                                if ($viewsolicitudframe->CurrentAction == "gridadd") {
                                    $viewsolicitudframe_list->LoadRowValues(); // Load default values
                                } else {
                                    $viewsolicitudframe_list->LoadRowValues($viewsolicitudframe_list->Recordset); // Load row values
                                }
                                $viewsolicitudframe->RowType = EW_ROWTYPE_VIEW; // Render view
                                if ($viewsolicitudframe->CurrentAction == "edit") {
                                    if ($viewsolicitudframe_list->CheckInlineEditKey() && $viewsolicitudframe_list->EditRowCnt == 0) { // Inline edit
                                        $viewsolicitudframe->RowType = EW_ROWTYPE_EDIT; // Render edit
                                    }
                                }
                                if ($viewsolicitudframe->CurrentAction == "edit" && $viewsolicitudframe->RowType == EW_ROWTYPE_EDIT && $viewsolicitudframe->EventCancelled) { // Update failed
                                    $objForm->Index = 1;
                                    $viewsolicitudframe_list->RestoreFormValues(); // Restore form values
                                }
                                if ($viewsolicitudframe->RowType == EW_ROWTYPE_EDIT) // Edit row
                                    $viewsolicitudframe_list->EditRowCnt++;

                                // Set up row id / data-rowindex
                                $viewsolicitudframe->RowAttrs = array_merge($viewsolicitudframe->RowAttrs, array('data-rowindex'=>$viewsolicitudframe_list->RowCnt, 'id'=>'r' . $viewsolicitudframe_list->RowCnt . '_viewsolicitudframe', 'data-rowtype'=>$viewsolicitudframe->RowType));

                                // Render row
                                $viewsolicitudframe_list->RenderRow();

                                // Render list options
                                $viewsolicitudframe_list->RenderListOptions();
                                ?>
                                <tr<?php echo $viewsolicitudframe->RowAttributes() ?>>
                                    <?php

                                    // Render list options (body, left)
                                    $viewsolicitudframe_list->ListOptions->Render("body", "left", $viewsolicitudframe_list->RowCnt);
                                    ?>
                                    <?php if ($viewsolicitudframe->id->Visible) { // id ?>
                                        <td data-name="id"<?php echo $viewsolicitudframe->id->CellAttributes() ?>>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_id" class="form-group viewsolicitudframe_id">
<span<?php echo $viewsolicitudframe->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewsolicitudframe->id->EditValue ?></p></span>
</span>
                                                <input type="hidden" data-table="viewsolicitudframe" data-field="x_id" name="x<?php echo $viewsolicitudframe_list->RowIndex ?>_id" id="x<?php echo $viewsolicitudframe_list->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewsolicitudframe->id->CurrentValue) ?>">
                                            <?php } ?>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_id" class="viewsolicitudframe_id">
<span<?php echo $viewsolicitudframe->id->ViewAttributes() ?>>
<?php echo $viewsolicitudframe->id->ListViewValue() ?></span>
</span>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                    <?php if ($viewsolicitudframe->name->Visible) { // name ?>
                                        <td data-name="name"<?php echo $viewsolicitudframe->name->CellAttributes() ?>>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_name" class="form-group viewsolicitudframe_name">
<input type="text" data-table="viewsolicitudframe" data-field="x_name" name="x<?php echo $viewsolicitudframe_list->RowIndex ?>_name" id="x<?php echo $viewsolicitudframe_list->RowIndex ?>_name" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewsolicitudframe->name->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudframe->name->EditValue ?>"<?php echo $viewsolicitudframe->name->EditAttributes() ?>>
</span>
                                            <?php } ?>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_name" class="viewsolicitudframe_name">
<span<?php echo $viewsolicitudframe->name->ViewAttributes() ?>>
<?php echo $viewsolicitudframe->name->ListViewValue() ?></span>
</span>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                    <?php if ($viewsolicitudframe->lastname->Visible) { // lastname ?>
                                        <td data-name="lastname"<?php echo $viewsolicitudframe->lastname->CellAttributes() ?>>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_lastname" class="form-group viewsolicitudframe_lastname">
<input type="text" data-table="viewsolicitudframe" data-field="x_lastname" name="x<?php echo $viewsolicitudframe_list->RowIndex ?>_lastname" id="x<?php echo $viewsolicitudframe_list->RowIndex ?>_lastname" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewsolicitudframe->lastname->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudframe->lastname->EditValue ?>"<?php echo $viewsolicitudframe->lastname->EditAttributes() ?>>
</span>
                                            <?php } ?>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_lastname" class="viewsolicitudframe_lastname">
<span<?php echo $viewsolicitudframe->lastname->ViewAttributes() ?>>
<?php echo $viewsolicitudframe->lastname->ListViewValue() ?></span>
</span>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                    <?php if ($viewsolicitudframe->_email->Visible) { // email ?>
                                        <td data-name="_email"<?php echo $viewsolicitudframe->_email->CellAttributes() ?>>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe__email" class="form-group viewsolicitudframe__email">
<input type="text" data-table="viewsolicitudframe" data-field="x__email" name="x<?php echo $viewsolicitudframe_list->RowIndex ?>__email" id="x<?php echo $viewsolicitudframe_list->RowIndex ?>__email" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitudframe->_email->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudframe->_email->EditValue ?>"<?php echo $viewsolicitudframe->_email->EditAttributes() ?>>
</span>
                                            <?php } ?>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe__email" class="viewsolicitudframe__email">
<span<?php echo $viewsolicitudframe->_email->ViewAttributes() ?>>
<?php echo $viewsolicitudframe->_email->ListViewValue() ?></span>
</span>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                    <?php if ($viewsolicitudframe->address->Visible) { // address ?>
                                        <td data-name="address"<?php echo $viewsolicitudframe->address->CellAttributes() ?>>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_address" class="form-group viewsolicitudframe_address">
<input type="text" data-table="viewsolicitudframe" data-field="x_address" name="x<?php echo $viewsolicitudframe_list->RowIndex ?>_address" id="x<?php echo $viewsolicitudframe_list->RowIndex ?>_address" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitudframe->address->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudframe->address->EditValue ?>"<?php echo $viewsolicitudframe->address->EditAttributes() ?>>
</span>
                                            <?php } ?>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_address" class="viewsolicitudframe_address">
<span<?php echo $viewsolicitudframe->address->ViewAttributes() ?>>
<?php echo $viewsolicitudframe->address->ListViewValue() ?></span>
</span>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                    <?php if ($viewsolicitudframe->email_contacto->Visible) { // email_contacto ?>
                                        <td data-name="email_contacto"<?php echo $viewsolicitudframe->email_contacto->CellAttributes() ?>>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_email_contacto" class="form-group viewsolicitudframe_email_contacto">
<input type="hidden" data-table="viewsolicitudframe" data-field="x_email_contacto" name="x<?php echo $viewsolicitudframe_list->RowIndex ?>_email_contacto" id="x<?php echo $viewsolicitudframe_list->RowIndex ?>_email_contacto" value="<?php echo ew_HtmlEncode($viewsolicitudframe->email_contacto->CurrentValue) ?>">
</span>
                                            <?php } ?>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_email_contacto" class="viewsolicitudframe_email_contacto">
<span<?php echo $viewsolicitudframe->email_contacto->ViewAttributes() ?>>
<?php echo $viewsolicitudframe->email_contacto->ListViewValue() ?></span>
</span>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                    <?php if ($viewsolicitudframe->phone->Visible) { // phone ?>
                                        <td data-name="phone"<?php echo $viewsolicitudframe->phone->CellAttributes() ?>>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_phone" class="form-group viewsolicitudframe_phone">
<input type="text" data-table="viewsolicitudframe" data-field="x_phone" name="x<?php echo $viewsolicitudframe_list->RowIndex ?>_phone" id="x<?php echo $viewsolicitudframe_list->RowIndex ?>_phone" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitudframe->phone->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudframe->phone->EditValue ?>"<?php echo $viewsolicitudframe->phone->EditAttributes() ?>>
</span>
                                            <?php } ?>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_phone" class="viewsolicitudframe_phone">
<span<?php echo $viewsolicitudframe->phone->ViewAttributes() ?>>
<?php echo $viewsolicitudframe->phone->ListViewValue() ?></span>
</span>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                    <?php if ($viewsolicitudframe->cell->Visible) { // cell ?>
                                        <td data-name="cell"<?php echo $viewsolicitudframe->cell->CellAttributes() ?>>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_cell" class="form-group viewsolicitudframe_cell">
<input type="text" data-table="viewsolicitudframe" data-field="x_cell" name="x<?php echo $viewsolicitudframe_list->RowIndex ?>_cell" id="x<?php echo $viewsolicitudframe_list->RowIndex ?>_cell" size="30" maxlength="255" placeholder="<?php echo ew_HtmlEncode($viewsolicitudframe->cell->getPlaceHolder()) ?>" value="<?php echo $viewsolicitudframe->cell->EditValue ?>"<?php echo $viewsolicitudframe->cell->EditAttributes() ?>>
</span>
                                            <?php } ?>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_cell" class="viewsolicitudframe_cell">
<span<?php echo $viewsolicitudframe->cell->ViewAttributes() ?>>
<?php echo $viewsolicitudframe->cell->ListViewValue() ?></span>
</span>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                    <?php if ($viewsolicitudframe->id_sucursal->Visible) { // id_sucursal ?>
                                        <td data-name="id_sucursal"<?php echo $viewsolicitudframe->id_sucursal->CellAttributes() ?>>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_id_sucursal" class="form-group viewsolicitudframe_id_sucursal">
<input type="hidden" data-table="viewsolicitudframe" data-field="x_id_sucursal" name="x<?php echo $viewsolicitudframe_list->RowIndex ?>_id_sucursal" id="x<?php echo $viewsolicitudframe_list->RowIndex ?>_id_sucursal" value="<?php echo ew_HtmlEncode($viewsolicitudframe->id_sucursal->CurrentValue) ?>">
</span>
                                            <?php } ?>
                                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_VIEW) { // View record ?>
                                                <span id="el<?php echo $viewsolicitudframe_list->RowCnt ?>_viewsolicitudframe_id_sucursal" class="viewsolicitudframe_id_sucursal">
<span<?php echo $viewsolicitudframe->id_sucursal->ViewAttributes() ?>>
<?php echo $viewsolicitudframe->id_sucursal->ListViewValue() ?></span>
</span>
                                            <?php } ?>
                                        </td>
                                    <?php } ?>
                                    <?php

                                    // Render list options (body, right)
                                    $viewsolicitudframe_list->ListOptions->Render("body", "right", $viewsolicitudframe_list->RowCnt);
                                    ?>
                                </tr>
                            <?php if ($viewsolicitudframe->RowType == EW_ROWTYPE_ADD || $viewsolicitudframe->RowType == EW_ROWTYPE_EDIT) { ?>
                                <script type="text/javascript">
                                    fviewsolicitudframelist.UpdateOpts(<?php echo $viewsolicitudframe_list->RowIndex ?>);
                                </script>
                            <?php } ?>
                                <?php
                            }
                            if ($viewsolicitudframe->CurrentAction <> "gridadd")
                                $viewsolicitudframe_list->Recordset->MoveNext();
                        }
                        ?>
                        </tbody>
                    </table>
                <?php } ?>
                <?php if ($viewsolicitudframe->CurrentAction == "edit") { ?>
                    <input type="hidden" name="<?php echo $viewsolicitudframe_list->FormKeyCountName ?>" id="<?php echo $viewsolicitudframe_list->FormKeyCountName ?>" value="<?php echo $viewsolicitudframe_list->KeyCount ?>">
                <?php } ?>
                <?php if ($viewsolicitudframe->CurrentAction == "") { ?>
                    <input type="hidden" name="a_list" id="a_list" value="">
                <?php } ?>
            </div>
        </form>
        <?php

        // Close recordset
        if ($viewsolicitudframe_list->Recordset)
            $viewsolicitudframe_list->Recordset->Close();
        ?>
        <div class="box-footer ewGridLowerPanel">
            <?php if ($viewsolicitudframe->CurrentAction <> "gridadd" && $viewsolicitudframe->CurrentAction <> "gridedit") { ?>
                <form name="ewPagerForm" class="ewForm form-inline ewPagerForm" action="<?php echo ew_CurrentPage() ?>">
                    <?php if (!isset($viewsolicitudframe_list->Pager)) $viewsolicitudframe_list->Pager = new cNumericPager($viewsolicitudframe_list->StartRec, $viewsolicitudframe_list->DisplayRecs, $viewsolicitudframe_list->TotalRecs, $viewsolicitudframe_list->RecRange, $viewsolicitudframe_list->AutoHidePager) ?>
                    <?php if ($viewsolicitudframe_list->Pager->RecordCount > 0 && $viewsolicitudframe_list->Pager->Visible) { ?>
                        <div class="ewPager">
                            <div class="ewNumericPage"><ul class="pagination">
                                    <?php if ($viewsolicitudframe_list->Pager->FirstButton->Enabled) { ?>
                                        <li><a href="<?php echo $viewsolicitudframe_list->PageUrl() ?>start=<?php echo $viewsolicitudframe_list->Pager->FirstButton->Start ?>"><?php echo $Language->Phrase("PagerFirst") ?></a></li>
                                    <?php } ?>
                                    <?php if ($viewsolicitudframe_list->Pager->PrevButton->Enabled) { ?>
                                        <li><a href="<?php echo $viewsolicitudframe_list->PageUrl() ?>start=<?php echo $viewsolicitudframe_list->Pager->PrevButton->Start ?>"><?php echo $Language->Phrase("PagerPrevious") ?></a></li>
                                    <?php } ?>
                                    <?php foreach ($viewsolicitudframe_list->Pager->Items as $PagerItem) { ?>
                                        <li<?php if (!$PagerItem->Enabled) { echo " class=\" active\""; } ?>><a href="<?php if ($PagerItem->Enabled) { echo $viewsolicitudframe_list->PageUrl() . "start=" . $PagerItem->Start; } else { echo "#"; } ?>"><?php echo $PagerItem->Text ?></a></li>
                                    <?php } ?>
                                    <?php if ($viewsolicitudframe_list->Pager->NextButton->Enabled) { ?>
                                        <li><a href="<?php echo $viewsolicitudframe_list->PageUrl() ?>start=<?php echo $viewsolicitudframe_list->Pager->NextButton->Start ?>"><?php echo $Language->Phrase("PagerNext") ?></a></li>
                                    <?php } ?>
                                    <?php if ($viewsolicitudframe_list->Pager->LastButton->Enabled) { ?>
                                        <li><a href="<?php echo $viewsolicitudframe_list->PageUrl() ?>start=<?php echo $viewsolicitudframe_list->Pager->LastButton->Start ?>"><?php echo $Language->Phrase("PagerLast") ?></a></li>
                                    <?php } ?>
                                </ul></div>
                        </div>
                    <?php } ?>
                    <?php if ($viewsolicitudframe_list->Pager->RecordCount > 0) { ?>
                        <div class="ewPager ewRec">
                            <span><?php echo $Language->Phrase("Record") ?>&nbsp;<?php echo $viewsolicitudframe_list->Pager->FromIndex ?>&nbsp;<?php echo $Language->Phrase("To") ?>&nbsp;<?php echo $viewsolicitudframe_list->Pager->ToIndex ?>&nbsp;<?php echo $Language->Phrase("Of") ?>&nbsp;<?php echo $viewsolicitudframe_list->Pager->RecordCount ?></span>
                        </div>
                    <?php } ?>
                    <?php if ($viewsolicitudframe_list->TotalRecs > 0 && (!$viewsolicitudframe_list->AutoHidePageSizeSelector || $viewsolicitudframe_list->Pager->Visible)) { ?>
                        <div class="ewPager">
                            <input type="hidden" name="t" value="viewsolicitudframe">
                            <select name="<?php echo EW_TABLE_REC_PER_PAGE ?>" class="form-control input-sm ewTooltip" title="<?php echo $Language->Phrase("RecordsPerPage") ?>" onchange="this.form.submit();">
                                <option value="10"<?php if ($viewsolicitudframe_list->DisplayRecs == 10) { ?> selected<?php } ?>>10</option>
                                <option value="20"<?php if ($viewsolicitudframe_list->DisplayRecs == 20) { ?> selected<?php } ?>>20</option>
                                <option value="50"<?php if ($viewsolicitudframe_list->DisplayRecs == 50) { ?> selected<?php } ?>>50</option>
                                <option value="ALL"<?php if ($viewsolicitudframe->getRecordsPerPage() == -1) { ?> selected<?php } ?>><?php echo $Language->Phrase("AllRecords") ?></option>
                            </select>
                        </div>
                    <?php } ?>
                </form>
            <?php } ?>
            <div class="ewListOtherOptions">
                <?php
                foreach ($viewsolicitudframe_list->OtherOptions as &$option)
                    $option->Render("body", "bottom");
                ?>
            </div>
            <div class="clearfix"></div>
        </div>
    </div>
<?php } ?>
<?php if ($viewsolicitudframe_list->TotalRecs == 0 && $viewsolicitudframe->CurrentAction == "") { // Show other options ?>
    <div class="ewListOtherOptions">
        <?php
        foreach ($viewsolicitudframe_list->OtherOptions as &$option) {
            $option->ButtonClass = "";
            $option->Render("body", "");
        }
        ?>
    </div>
    <div class="clearfix"></div>
<?php } ?>
<script type="text/javascript">
    fviewsolicitudframelist.Init();
</script>
<?php
$viewsolicitudframe_list->ShowPageFooter();
if (EW_DEBUG_ENABLED)
    echo ew_DebugMsg();
?>
<script type="text/javascript">

    // Write your table-specific startup script here
    // document.write("page loaded");

</script>

