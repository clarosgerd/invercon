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

$dashboardv2_php = NULL; // Initialize page object first

class cdashboardv2_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'dashboardv2.php';

	// Page object name
	var $PageObjName = 'dashboardv2_php';

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
			define("EW_TABLE_NAME", 'dashboardv2.php', TRUE);

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
		$Breadcrumb->Add("custom", "dashboardv2_php", $url, "", "dashboardv2_php", TRUE);
		$this->Heading = $Language->TablePhrase("dashboardv2_php", "TblCaption"); 
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($dashboardv2_php)) $dashboardv2_php = new cdashboardv2_php();

// Page init
$dashboardv2_php->Page_Init();

// Page main
$dashboardv2_php->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php" ?>

<section class="content">
	  <!-- Small boxes (Stat box) -->
	  <div class="row">
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-aqua">
			<div class="inner">
			  <h3>150</h3>

			  <p>New Orders</p>
			</div>
			<div class="icon">
			  <i class="ion ion-bag"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-green">
			<div class="inner">
			  <h3>53<sup style="font-size: 20px">%</sup></h3>

			  <p>Bounce Rate</p>
			</div>
			<div class="icon">
			  <i class="ion ion-stats-bars"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-yellow">
			<div class="inner">
			  <h3>44</h3>

			  <p>User Registrations</p>
			</div>
			<div class="icon">
			  <i class="ion ion-person-add"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<!-- ./col -->
		<div class="col-lg-3 col-xs-6">
		  <!-- small box -->
		  <div class="small-box bg-red">
			<div class="inner">
			  <h3>65</h3>

			  <p>Unique Visitors</p>
			</div>
			<div class="icon">
			  <i class="ion ion-pie-graph"></i>
			</div>
			<a href="#" class="small-box-footer">More info <i class="fa fa-arrow-circle-right"></i></a>
		  </div>
		</div>
		<!-- ./col -->
	  </div>
	  <!-- /.row -->
	  <!-- Main row -->
	  <div class="row">
		<!-- Left col -->
		<section class="col-lg-7 connectedSortable">
		  <!-- Custom tabs (Charts with tabs)-->
		  <div class="nav-tabs-custom">
			<!-- Tabs within a box -->
			<ul class="nav nav-tabs pull-right">
			  <li class="active"><a href="#revenue-chart" data-toggle="tab">Area</a></li>
			  <li><a href="#sales-chart" data-toggle="tab">Donut</a></li>
			  <li class="pull-left header"><i class="fa fa-inbox"></i> Sales</li>
			</ul>
			<div class="tab-content no-padding">
			  <!-- Morris chart - Sales -->
			  <div class="chart tab-pane active" id="revenue-chart" style="position: relative; height: 300px;"></div>
			  <div class="chart tab-pane" id="sales-chart" style="position: relative; height: 300px;"></div>
			</div>
		  </div>
		  <!-- /.nav-tabs-custom -->

		  <!-- Chat box -->
		  <div class="box box-success">
			<div class="box-header">
			  <i class="fa fa-comments-o"></i>

			  <h3 class="box-title">Chat</h3>

			  <div class="box-tools pull-right" data-toggle="tooltip" title="Status">
				<div class="btn-group" data-toggle="btn-toggle">
				  <button type="button" class="btn btn-default btn-sm active"><i class="fa fa-square text-green"></i>
				  </button>
				  <button type="button" class="btn btn-default btn-sm"><i class="fa fa-square text-red"></i></button>
				</div>
			  </div>
			</div>
			<div class="box-body chat" id="chat-box">
			  <!-- chat item -->
			  <div class="item">
				<img src="dist/img/user4-128x128.jpg" alt="user image" class="online">

				<p class="message">
				  <a href="#" class="name">
					<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 2:15</small>
					Mike Doe
				  </a>
				  I would like to meet you to discuss the latest news about
				  the arrival of the new theme. They say it is going to be one the
				  best themes on the market
				</p>
				<div class="attachment">
				  <h4>Attachments:</h4>

				  <p class="filename">
					Theme-thumbnail-image.jpg
				  </p>

				  <div class="pull-right">
					<button type="button" class="btn btn-primary btn-sm btn-flat">Open</button>
				  </div>
				</div>
				<!-- /.attachment -->
			  </div>
			  <!-- /.item -->
			  <!-- chat item -->
			  <div class="item">
				<img src="dist/img/user3-128x128.jpg" alt="user image" class="offline">

				<p class="message">
				  <a href="#" class="name">
					<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:15</small>
					Alexander Pierce
				  </a>
				  I would like to meet you to discuss the latest news about
				  the arrival of the new theme. They say it is going to be one the
				  best themes on the market
				</p>
			  </div>
			  <!-- /.item -->
			  <!-- chat item -->
			  <div class="item">
				<img src="dist/img/user2-160x160.jpg" alt="user image" class="offline">

				<p class="message">
				  <a href="#" class="name">
					<small class="text-muted pull-right"><i class="fa fa-clock-o"></i> 5:30</small>
					Susan Doe
				  </a>
				  I would like to meet you to discuss the latest news about
				  the arrival of the new theme. They say it is going to be one the
				  best themes on the market
				</p>
			  </div>
			  <!-- /.item -->
			</div>
			<!-- /.chat -->
			<div class="box-footer">
			  <div class="input-group">
				<input class="form-control" placeholder="Type message...">

				<div class="input-group-btn">
				  <button type="button" class="btn btn-success"><i class="fa fa-plus"></i></button>
				</div>
			  </div>
			</div>
		  </div>
		  <!-- /.box (chat box) -->

		  <!-- TO DO List -->
		  <div class="box box-primary">
			<div class="box-header">
			  <i class="ion ion-clipboard"></i>

			  <h3 class="box-title">To Do List</h3>

			  <div class="box-tools pull-right">
				<ul class="pagination pagination-sm inline">
				  <li><a href="#">&laquo;</a></li>
				  <li><a href="#">1</a></li>
				  <li><a href="#">2</a></li>
				  <li><a href="#">3</a></li>
				  <li><a href="#">&raquo;</a></li>
				</ul>
			  </div>
			</div>
			<!-- /.box-header -->
			<div class="box-body">
			  <!-- See dist/js/pages/dashboard.js to activate the todoList plugin -->
			  <ul class="todo-list">
				<li>
				  <!-- drag handle -->
				  <span class="handle">
						<i class="fa fa-ellipsis-v"></i>
						<i class="fa fa-ellipsis-v"></i>
					  </span>
				  <!-- checkbox -->
				  <input type="checkbox" value="">
				  <!-- todo text -->
				  <span class="text">Design a nice theme</span>
				  <!-- Emphasis label -->
				  <small class="label label-danger"><i class="fa fa-clock-o"></i> 2 mins</small>
				  <!-- General tools such as edit or delete-->
				  <div class="tools">
					<i class="fa fa-edit"></i>
					<i class="fa fa-trash-o"></i>
				  </div>
				</li>
				<li>
					  <span class="handle">
						<i class="fa fa-ellipsis-v"></i>
						<i class="fa fa-ellipsis-v"></i>
					  </span>
				  <input type="checkbox" value="">
				  <span class="text">Make the theme responsive</span>
				  <small class="label label-info"><i class="fa fa-clock-o"></i> 4 hours</small>
				  <div class="tools">
					<i class="fa fa-edit"></i>
					<i class="fa fa-trash-o"></i>
				  </div>
				</li>
				<li>
					  <span class="handle">
						<i class="fa fa-ellipsis-v"></i>
						<i class="fa fa-ellipsis-v"></i>
					  </span>
				  <input type="checkbox" value="">
				  <span class="text">Let theme shine like a star</span>
				  <small class="label label-warning"><i class="fa fa-clock-o"></i> 1 day</small>
				  <div class="tools">
					<i class="fa fa-edit"></i>
					<i class="fa fa-trash-o"></i>
				  </div>
				</li>
				<li>
					  <span class="handle">
						<i class="fa fa-ellipsis-v"></i>
						<i class="fa fa-ellipsis-v"></i>
					  </span>
				  <input type="checkbox" value="">
				  <span class="text">Let theme shine like a star</span>
				  <small class="label label-success"><i class="fa fa-clock-o"></i> 3 days</small>
				  <div class="tools">
					<i class="fa fa-edit"></i>
					<i class="fa fa-trash-o"></i>
				  </div>
				</li>
				<li>
					  <span class="handle">
						<i class="fa fa-ellipsis-v"></i>
						<i class="fa fa-ellipsis-v"></i>
					  </span>
				  <input type="checkbox" value="">
				  <span class="text">Check your messages and notifications</span>
				  <small class="label label-primary"><i class="fa fa-clock-o"></i> 1 week</small>
				  <div class="tools">
					<i class="fa fa-edit"></i>
					<i class="fa fa-trash-o"></i>
				  </div>
				</li>
				<li>
					  <span class="handle">
						<i class="fa fa-ellipsis-v"></i>
						<i class="fa fa-ellipsis-v"></i>
					  </span>
				  <input type="checkbox" value="">
				  <span class="text">Let theme shine like a star</span>
				  <small class="label label-default"><i class="fa fa-clock-o"></i> 1 month</small>
				  <div class="tools">
					<i class="fa fa-edit"></i>
					<i class="fa fa-trash-o"></i>
				  </div>
				</li>
			  </ul>
			</div>
			<!-- /.box-body -->
			<div class="box-footer clearfix no-border">
			  <button type="button" class="btn btn-default pull-right"><i class="fa fa-plus"></i> Add item</button>
			</div>
		  </div>
		  <!-- /.box -->

		  <!-- quick email widget -->
		  <div class="box box-info">
			<div class="box-header">
			  <i class="fa fa-envelope"></i>

			  <h3 class="box-title">Quick Email</h3>
			  <!-- tools box -->
			  <div class="pull-right box-tools">
				<button type="button" class="btn btn-info btn-sm" data-widget="remove" data-toggle="tooltip"
						title="Remove">
				  <i class="fa fa-times"></i></button>
			  </div>
			  <!-- /. tools -->
			</div>
			<div class="box-body">
			  <form action="#" method="post">
				<div class="form-group">
				  <input type="email" class="form-control" name="emailto" placeholder="Email to:">
				</div>
				<div class="form-group">
				  <input type="text" class="form-control" name="subject" placeholder="Subject">
				</div>
				<div>
				  <textarea class="textarea" placeholder="Message"
							style="width: 100%; height: 125px; font-size: 14px; line-height: 18px; border: 1px solid #dddddd; padding: 10px;"></textarea>
				</div>
			  </form>
			</div>
			<div class="box-footer clearfix">
			  <button type="button" class="pull-right btn btn-default" id="sendEmail">Send
				<i class="fa fa-arrow-circle-right"></i></button>
			</div>
		  </div>

		</section>
		<!-- /.Left col -->
		<!-- right col (We are only adding the ID to make the widgets sortable)-->
		<section class="col-lg-5 connectedSortable">

		  <!-- Map box -->
		  <div class="box box-solid bg-light-blue-gradient">
			<div class="box-header">
			  <!-- tools box -->
			  <div class="pull-right box-tools">
				<button type="button" class="btn btn-primary btn-sm daterange pull-right" data-toggle="tooltip"
						title="Date range">
				  <i class="fa fa-calendar"></i></button>
				<button type="button" class="btn btn-primary btn-sm pull-right" data-widget="collapse"
						data-toggle="tooltip" title="Collapse" style="margin-right: 5px;">
				  <i class="fa fa-minus"></i></button>
			  </div>
			  <!-- /. tools -->

			  <i class="fa fa-map-marker"></i>

			  <h3 class="box-title">
				Visitors
			  </h3>
			</div>
			<div class="box-body">
			  <div id="world-map" style="height: 250px; width: 100%;"></div>
			</div>
			<!-- /.box-body-->
			<div class="box-footer no-border">
			  <div class="row">
				<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
				  <div id="sparkline-1"></div>
				  <div class="knob-label">Visitors</div>
				</div>
				<!-- ./col -->
				<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
				  <div id="sparkline-2"></div>
				  <div class="knob-label">Online</div>
				</div>
				<!-- ./col -->
				<div class="col-xs-4 text-center">
				  <div id="sparkline-3"></div>
				  <div class="knob-label">Exists</div>
				</div>
				<!-- ./col -->
			  </div>
			  <!-- /.row -->
			</div>
		  </div>
		  <!-- /.box -->

		  <!-- solid sales graph -->
		  <div class="box box-solid bg-teal-gradient">
			<div class="box-header">
			  <i class="fa fa-th"></i>

			  <h3 class="box-title">Sales Graph</h3>

			  <div class="box-tools pull-right">
				<button type="button" class="btn bg-teal btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn bg-teal btn-sm" data-widget="remove"><i class="fa fa-times"></i>
				</button>
			  </div>
			</div>
			<div class="box-body border-radius-none">
			  <div class="chart" id="line-chart" style="height: 250px;"></div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer no-border">
			  <div class="row">
				<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
				  <input type="text" class="knob" data-readonly="true" value="20" data-width="60" data-height="60"
						 data-fgColor="#39CCCC">

				  <div class="knob-label">Mail-Orders</div>
				</div>
				<!-- ./col -->
				<div class="col-xs-4 text-center" style="border-right: 1px solid #f4f4f4">
				  <input type="text" class="knob" data-readonly="true" value="50" data-width="60" data-height="60"
						 data-fgColor="#39CCCC">

				  <div class="knob-label">Online</div>
				</div>
				<!-- ./col -->
				<div class="col-xs-4 text-center">
				  <input type="text" class="knob" data-readonly="true" value="30" data-width="60" data-height="60"
						 data-fgColor="#39CCCC">

				  <div class="knob-label">In-Store</div>
				</div>
				<!-- ./col -->
			  </div>
			  <!-- /.row -->
			</div>
			<!-- /.box-footer -->
		  </div>
		  <!-- /.box -->

		  <!-- Calendar -->
		  <div class="box box-solid bg-green-gradient">
			<div class="box-header">
			  <i class="fa fa-calendar"></i>

			  <h3 class="box-title">Calendar</h3>
			  <!-- tools box -->
			  <div class="pull-right box-tools">
				<!-- button with a dropdown -->
				<div class="btn-group">
				  <button type="button" class="btn btn-success btn-sm dropdown-toggle" data-toggle="dropdown">
					<i class="fa fa-bars"></i></button>
				  <ul class="dropdown-menu pull-right" role="menu">
					<li><a href="#">Add new event</a></li>
					<li><a href="#">Clear events</a></li>
					<li class="divider"></li>
					<li><a href="#">View calendar</a></li>
				  </ul>
				</div>
				<button type="button" class="btn btn-success btn-sm" data-widget="collapse"><i class="fa fa-minus"></i>
				</button>
				<button type="button" class="btn btn-success btn-sm" data-widget="remove"><i class="fa fa-times"></i>
				</button>
			  </div>
			  <!-- /. tools -->
			</div>
			<!-- /.box-header -->
			<div class="box-body no-padding">
			  <!--The calendar -->
			  <div id="calendar" style="width: 100%"></div>
			</div>
			<!-- /.box-body -->
			<div class="box-footer text-black">
			  <div class="row">
				<div class="col-sm-6">
				  <!-- Progress bars -->
				  <div class="clearfix">
					<span class="pull-left">Task #1</span>
					<small class="pull-right">90%</small>
				  </div>
				  <div class="progress xs">
					<div class="progress-bar progress-bar-green" style="width: 90%;"></div>
				  </div>

				  <div class="clearfix">
					<span class="pull-left">Task #2</span>
					<small class="pull-right">70%</small>
				  </div>
				  <div class="progress xs">
					<div class="progress-bar progress-bar-green" style="width: 70%;"></div>
				  </div>
				</div>
				<!-- /.col -->
				<div class="col-sm-6">
				  <div class="clearfix">
					<span class="pull-left">Task #3</span>
					<small class="pull-right">60%</small>
				  </div>
				  <div class="progress xs">
					<div class="progress-bar progress-bar-green" style="width: 60%;"></div>
				  </div>

				  <div class="clearfix">
					<span class="pull-left">Task #4</span>
					<small class="pull-right">40%</small>
				  </div>
				  <div class="progress xs">
					<div class="progress-bar progress-bar-green" style="width: 40%;"></div>
				  </div>
				</div>
				<!-- /.col -->
			  </div>
			  <!-- /.row -->
			</div>
		  </div>
		  <!-- /.box -->

		</section>
		<!-- right col -->
	  </div>
	  <!-- /.row (main row) -->

	</section>
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$dashboardv2_php->Page_Terminate();
?>
