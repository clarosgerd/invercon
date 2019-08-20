<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php $EW_ROOT_RELATIVE_PATH = ""; ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$corenotificacion_php = NULL; // Initialize page object first

class ccorenotificacion_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'corenotificacion.php';

	// Page object name
	var $PageObjName = 'corenotificacion_php';

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
		return "";
	}

	// Page name
	function PageName() {
		return ew_CurrentPage();
	}

	// Page URL
	function PageUrl() {
		$PageUrl = ew_CurrentPage() . "?";
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

		// Page ID
		if (!defined("EW_PAGE_ID"))
			define("EW_PAGE_ID", 'custom', TRUE);

		// Table name (for backward compatibility)
		if (!defined("EW_TABLE_NAME"))
			define("EW_TABLE_NAME", 'corenotificacion.php', TRUE);

		// Start timer
		if (!isset($GLOBALS["gTimer"]))
			$GLOBALS["gTimer"] = new cTimer();

		// Debug message
		ew_LoadDebugMsg();

		// Open connection
		if (!isset($conn))
			$conn = ew_Connect();

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

		// User profile
		$UserProfile = new cUserProfile();

		// Security
		$Security = new cAdvancedSecurity();
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loading();
		$Security->LoadCurrentUserLevel($this->ProjectID . $this->TableName);
		if ($Security->IsLoggedIn()) $Security->TablePermission_Loaded();
		if (!$Security->CanReport()) {
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

		if (@$_GET["export"] <> "")
			$gsExport = $_GET["export"]; // Get export parameter, used in header

		// Global Page Loading event (in userfn*.php)
		Page_Loading();

		// Check token
		if (!$this->ValidPost()) {
			echo $Language->Phrase("InvalidPostRequest");
			$this->Page_Terminate();
			exit();
		}

		// Create Token
		$this->CreateToken();
	}

	//
	// Page_Terminate
	//
	function Page_Terminate($url = "") {
		global $gsExportFile, $gTmpImages;

		// Global Page Unloaded event (in userfn*.php)
		Page_Unloaded();

		// Export
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

	//
	// Page main
	//
	function Page_Main() {

		// Set up Breadcrumb
		$this->SetupBreadcrumb();
	}

	// Set up Breadcrumb
	function SetupBreadcrumb() {
		global $Breadcrumb, $Language;
		$Breadcrumb = new cBreadcrumb();
		$url = substr(ew_CurrentUrl(), strrpos(ew_CurrentUrl(), "/")+1);
		$Breadcrumb->Add("custom", "corenotificacion_php", $url, "", "corenotificacion_php", TRUE);
		$this->Heading = $Language->TablePhrase("corenotificacion_php", "TblCaption"); 
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($corenotificacion_php)) $corenotificacion_php = new ccorenotificacion_php();

// Page init
$corenotificacion_php->Page_Init();

// Page main
$corenotificacion_php->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php" ?>
 <li class="dropdown messages-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  <i class="fa fa-envelope-o"></i>
			  <span class="label label-success">4</span>
			</a>
			<ul class="dropdown-menu">
			  <li class="header">You have 4 messages</li>
			  <li>
				<!-- inner menu: contains the actual data -->
				<ul class="menu">
				  <li><!-- start message -->
					<a href="#">
					  <div class="pull-left">
						<img src="dist/img/user2-160x160.jpg" class="img-circle" alt="User Image">
					  </div>
					  <h4>
						Support Team
						<small><i class="fa fa-clock-o"></i> 5 mins</small>
					  </h4>
					  <p>Why not buy a new awesome theme?</p>
					</a>
				  </li>
				  <!-- end message -->
				  <li>
					<a href="#">
					  <div class="pull-left">
						<img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
					  </div>
					  <h4>
						AdminLTE Design Team
						<small><i class="fa fa-clock-o"></i> 2 hours</small>
					  </h4>
					  <p>Why not buy a new awesome theme?</p>
					</a>
				  </li>
				  <li>
					<a href="#">
					  <div class="pull-left">
						<img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
					  </div>
					  <h4>
						Developers
						<small><i class="fa fa-clock-o"></i> Today</small>
					  </h4>
					  <p>Why not buy a new awesome theme?</p>
					</a>
				  </li>
				  <li>
					<a href="#">
					  <div class="pull-left">
						<img src="dist/img/user3-128x128.jpg" class="img-circle" alt="User Image">
					  </div>
					  <h4>
						Sales Department
						<small><i class="fa fa-clock-o"></i> Yesterday</small>
					  </h4>
					  <p>Why not buy a new awesome theme?</p>
					</a>
				  </li>
				  <li>
					<a href="#">
					  <div class="pull-left">
						<img src="dist/img/user4-128x128.jpg" class="img-circle" alt="User Image">
					  </div>
					  <h4>
						Reviewers
						<small><i class="fa fa-clock-o"></i> 2 days</small>
					  </h4>
					  <p>Why not buy a new awesome theme?</p>
					</a>
				  </li>
				</ul>
			  </li>
			  <li class="footer"><a href="#">See All Messages</a></li>
			</ul>
		  </li>
		  <!-- Notifications: style can be found in dropdown.less -->
		  <li class="dropdown notifications-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  <i class="fa fa-bell-o"></i>
			  <span class="label label-warning">10</span>
			</a>
			<ul class="dropdown-menu">
			  <li class="header">You have 10 notifications</li>
			  <li>
				<!-- inner menu: contains the actual data -->
				<ul class="menu">
				  <li>
					<a href="#">
					  <i class="fa fa-users text-aqua"></i> 5 new members joined today
					</a>
				  </li>
				  <li>
					<a href="#">
					  <i class="fa fa-warning text-yellow"></i> Very long description here that may not fit into the
					  page and may cause design problems
					</a>
				  </li>
				  <li>
					<a href="#">
					  <i class="fa fa-users text-red"></i> 5 new members joined
					</a>
				  </li>
				  <li>
					<a href="#">
					  <i class="fa fa-shopping-cart text-green"></i> 25 sales made
					</a>
				  </li>
				  <li>
					<a href="#">
					  <i class="fa fa-user text-red"></i> You changed your username
					</a>
				  </li>
				</ul>
			  </li>
			  <li class="footer"><a href="#">View all</a></li>
			</ul>
		  </li>
		  <!-- Tasks: style can be found in dropdown.less -->
		  <li class="dropdown tasks-menu">
			<a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  <i class="fa fa-flag-o"></i>
			  <span class="label label-danger">9</span>
			</a>
			<ul class="dropdown-menu">
			  <li class="header">You have 9 tasks</li>
			  <li>
				<!-- inner menu: contains the actual data -->
				<ul class="menu">
				  <li><!-- Task item -->
					<a href="#">
					  <h3>
						Design some buttons
						<small class="pull-right">20%</small>
					  </h3>
					  <div class="progress xs">
						<div class="progress-bar progress-bar-aqua" style="width: 20%" role="progressbar"
							 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
						  <span class="sr-only">20% Complete</span>
						</div>
					  </div>
					</a>
				  </li>
				  <!-- end task item -->
				  <li><!-- Task item -->
					<a href="#">
					  <h3>
						Create a nice theme
						<small class="pull-right">40%</small>
					  </h3>
					  <div class="progress xs">
						<div class="progress-bar progress-bar-green" style="width: 40%" role="progressbar"
							 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
						  <span class="sr-only">40% Complete</span>
						</div>
					  </div>
					</a>
				  </li>
				  <!-- end task item -->
				  <li><!-- Task item -->
					<a href="#">
					  <h3>
						Some task I need to do
						<small class="pull-right">60%</small>
					  </h3>
					  <div class="progress xs">
						<div class="progress-bar progress-bar-red" style="width: 60%" role="progressbar"
							 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
						  <span class="sr-only">60% Complete</span>
						</div>
					  </div>
					</a>
				  </li>
				  <!-- end task item -->
				  <li><!-- Task item -->
					<a href="#">
					  <h3>
						Make beautiful transitions
						<small class="pull-right">80%</small>
					  </h3>
					  <div class="progress xs">
						<div class="progress-bar progress-bar-yellow" style="width: 80%" role="progressbar"
							 aria-valuenow="20" aria-valuemin="0" aria-valuemax="100">
						  <span class="sr-only">80% Complete</span>
						</div>
					  </div>
					</a>
				  </li>
				  <!-- end task item -->
				</ul>
			  </li>
			  <li class="footer">
				<a href="#">View all tasks</a>
			  </li>
			</ul>
		  </li>
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$corenotificacion_php->Page_Terminate();
?>
