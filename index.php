<?php
if (session_id() == "") session_start(); // Init session data
ob_start(); // Turn on output buffering
?>
<?php include_once "ewcfg14.php" ?>
<?php include_once ((EW_USE_ADODB) ? "adodb5/adodb.inc.php" : "ewmysql14.php") ?>
<?php include_once "phpfn14.php" ?>
<?php include_once "usuarioinfo.php" ?>
<?php include_once "userfn14.php" ?>
<?php

//
// Page class
//

$default = NULL; // Initialize page object first

class cdefault {

	// Page ID
	var $PageID = 'default';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Page object name
	var $PageObjName = 'default';

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
			define("EW_PAGE_ID", 'default', TRUE);

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

		// NOTE: Security object may be needed in other part of the script, skip set to Nothing
		// 
		// Security = null;
		// 
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

		// Create Token
		$this->CreateToken();
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

	//
	// Page main
	//
	function Page_Main() {
		global $Security, $Language, $Breadcrumb;
		$Breadcrumb = new cBreadcrumb();

		// If session expired, show session expired message
		if (@$_GET["expired"] == "1")
			$this->setFailureMessage($Language->Phrase("SessionExpired"));
		if (!$Security->IsLoggedIn()) $Security->AutoLogin();
		$Security->LoadUserLevel(); // Load User Level
		if ($Security->AllowList(CurrentProjectID() . 'solicitud'))
		$this->Page_Terminate("solicitudlist.php"); // Exit and go to default page
		if ($Security->AllowList(CurrentProjectID() . 'departamento'))
			$this->Page_Terminate("departamentolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'provincia'))
			$this->Page_Terminate("provincialist.php");
		if ($Security->AllowList(CurrentProjectID() . 'usuario'))
			$this->Page_Terminate("usuariolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'solicitudcore.php'))
			$this->Page_Terminate("solicitudcore.php");
		if ($Security->AllowList(CurrentProjectID() . 'asesor'))
			$this->Page_Terminate("asesorlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'avaluo'))
			$this->Page_Terminate("avaluolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'reservacion.php'))
			$this->Page_Terminate("reservacion.php");
		if ($Security->AllowList(CurrentProjectID() . 'cliente'))
			$this->Page_Terminate("clientelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'estado'))
			$this->Page_Terminate("estadolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'estadointerno'))
			$this->Page_Terminate("estadointernolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'estadopago'))
			$this->Page_Terminate("estadopagolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'documentosavaluo'))
			$this->Page_Terminate("documentosavaluolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'sucursal'))
			$this->Page_Terminate("sucursallist.php");
		if ($Security->AllowList(CurrentProjectID() . 'tipoinmueble'))
			$this->Page_Terminate("tipoinmueblelist.php");
		if ($Security->AllowList(CurrentProjectID() . 'avaluocore.php'))
			$this->Page_Terminate("avaluocore.php");
		if ($Security->AllowList(CurrentProjectID() . 'metodopago'))
			$this->Page_Terminate("metodopagolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'banco'))
			$this->Page_Terminate("bancolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'comentariosavaluo'))
			$this->Page_Terminate("comentariosavaluolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'inspector'))
			$this->Page_Terminate("inspectorlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'oficialcredito'))
			$this->Page_Terminate("oficialcreditolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'supervisor'))
			$this->Page_Terminate("supervisorlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'notificaciones'))
			$this->Page_Terminate("notificacioneslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'corenotificacion.php'))
			$this->Page_Terminate("corenotificacion.php");
		if ($Security->AllowList(CurrentProjectID() . 'userlevelpermissions'))
			$this->Page_Terminate("userlevelpermissionslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'userlevels'))
			$this->Page_Terminate("userlevelslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'calendario.php'))
			$this->Page_Terminate("calendario.php");
		if ($Security->AllowList(CurrentProjectID() . 'emailnotificaciones'))
			$this->Page_Terminate("emailnotificacioneslist.php");
		if ($Security->AllowList(CurrentProjectID() . 'pago'))
			$this->Page_Terminate("pagolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'pago_avaluo'))
			$this->Page_Terminate("pago_avaluolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'viewavaluo'))
			$this->Page_Terminate("viewavaluolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'viewsolicitud'))
			$this->Page_Terminate("viewsolicitudlist.php");
		if ($Security->AllowList(CurrentProjectID() . 'core.php'))
			$this->Page_Terminate("core.php");
		if ($Security->AllowList(CurrentProjectID() . 'tipodocumento'))
			$this->Page_Terminate("tipodocumentolist.php");
		if ($Security->AllowList(CurrentProjectID() . 'viewavaluosc'))
			$this->Page_Terminate("viewavaluosclist.php");
		if ($Security->AllowList(CurrentProjectID() . 'getApiRestWordPress.php'))
			$this->Page_Terminate("getApiRestWordPress.php");
		if ($Security->AllowList(CurrentProjectID() . 'offline_messages'))
			$this->Page_Terminate("offline_messageslist.php");
		if ($Security->IsLoggedIn()) {
			$this->setFailureMessage(ew_DeniedMsg() . "<br><br><a href=\"logout.php\">" . $Language->Phrase("BackToLogin") . "</a>");
		} else {
			$this->Page_Terminate("login.php"); // Exit and go to login page
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
	// $type = ''|'success'|'failure'
	function Message_Showing(&$msg, $type) {

		// Example:
		//if ($type == 'success') $msg = "your success message";

	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($default)) $default = new cdefault();

// Page init
$default->Page_Init();

// Page main
$default->Page_Main();
?>
<?php include_once "header.php" ?>
<?php
$default->ShowMessage();
?>
<?php include_once "footer.php" ?>
<?php
$default->Page_Terminate();
?>
