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

$core_php = NULL; // Initialize page object first

class ccore_php {

	// Page ID
	var $PageID = 'custom';

	// Project ID
	var $ProjectID = '{30AA0C25-B486-48CC-AF92-47D039BF725C}';

	// Table name
	var $TableName = 'core.php';

	// Page object name
	var $PageObjName = 'core_php';

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
			define("EW_TABLE_NAME", 'core.php', TRUE);

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
		$Breadcrumb->Add("custom", "core_php", $url, "", "core_php", TRUE);
		$this->Heading = $Language->TablePhrase("core_php", "TblCaption"); 
	}
}
?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($core_php)) $core_php = new ccore_php();

// Page init
$core_php->Page_Init();

// Page main
$core_php->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();
?>
<?php include_once "header.php" ?>
<?php
//echo "hola";
//echo $_GET['id'];
//echo $_GET['type'];
//$_GET['case']case=of
/*
if (isset($_GET['id']) || isset($_GET['type']) || isset($_GET['case'])) { /// all

if ($_GET['case']=="sec") ////if of
{
if ($_GET['type']=="validar")
{
	$TheQuery="SELECT * FROM solicitud WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
//echo $TheQuery;
	$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);

	if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
		$all_mensaje_result->MoveFirst();
		$sData = "";
		while ($all_mensaje_result && !$all_mensaje_result->EOF)
		{
			$nombre=$all_mensaje_result->fields["name"].$all_mensaje_result->fields["lastname"];
			$sData .= "<p>Nombre: ".$nombre."</p>";
			$email=$all_mensaje_result->fields[3];
			$sData .= "<p>Correo Electronico: ".$email."</p>";

			$address=$all_mensaje_result->fields["address"];
			$sData .= "<p>Direccion: ".$address."</p>";
			$telefono=$all_mensaje_result->fields["phone"];
			$sData .= "<p>Telefono: ".$telefono."</p>";
			$celular=$all_mensaje_result->fields["cell"];
			$sData .= "<p>Celular: ".$celular."</p>";



			$esinmueble=$all_mensaje_result->fields["tipoinmueble"];

			$esvehiculo=$all_mensaje_result->fields[21];
			$esmaquinaria=$all_mensaje_result->fields[32];
			$esmercaderia=$all_mensaje_result->fields[43];
			$esespecial=$all_mensaje_result->fields[43];


			if (isset($esinmueble) && $esinmueble != ""){
				//echo "es inmbueble";
				//echo "es inmbueble";
				//$ubicacion=$all_mensaje_result->fields["imagen_inmueble01"];
				$ubicacion = (isset($all_mensaje_result->fields["imagen_inmueble01"]) || $all_mensaje_result->fields["imagen_inmueble01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Ubicacion: ".$ubicacion."</p>";

				//$documentos=$all_mensaje_result->fields["imagen_inmueble02"];
				$documentos = (isset($all_mensaje_result->fields["imagen_inmueble02"]) || $all_mensaje_result->fields["imagen_inmueble02"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Documentos: ".$documentos."</p>";

				//$folioreal=$all_mensaje_result->fields["imagen_inmueble03"];
				$folioreal = (isset($all_mensaje_result->fields["imagen_inmueble03"]) || $all_mensaje_result->fields["imagen_inmueble03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Real: ".$folioreal."</p>";

				//$plano=$all_mensaje_result->fields["imagen_inmueble04"];
				$plano = (isset($all_mensaje_result->fields["imagen_inmueble04"]) || $all_mensaje_result->fields["imagen_inmueble04"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Plano: ".$plano."</p>";
				//$impuesto=$all_mensaje_result->fields["imagen_inmueble05"];
				$impuesto = (isset($all_mensaje_result->fields["imagen_inmueble05"]) || $all_mensaje_result->fields["imagen_inmueble05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuesto: ".$impuesto."</p>";
			}
			if (isset($esvehiculo) && $esvehiculo != ""){

				//$documentosvehiculo=$all_mensaje_result->fields["imagen_vehiculo01"];
				$documentosvehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo01"]) && $all_mensaje_result->fields["imagen_vehiculo01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Docuementos del Vehiculo: ".$documentosvehiculo."</p>";
				//$impuestovehiculo=$all_mensaje_result->fields["imagen_vehiculo05"];
				$impuestovehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo05"]) && $all_mensaje_result->fields["imagen_vehiculo05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos del Vehiculo: ".$impuestovehiculo."</p>";

				//$ruat=$all_mensaje_result->fields["imagen_vehiculo06"];
				$ruat = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .=  "<p>Tiene Ruat del Vehiculo: ".$ruat."</p>";

				//$poliza=$all_mensaje_result->fields["imagen_vehiculo07"];
				$poliza = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza: ".$poliza."</p>";

			}
			if (isset($esmaquinaria) && $esmaquinaria != ""){
				//$documentosmaquinaria=$all_mensaje_result->fields["imagen_maquinaria02"];
				$documentosmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria02"]) && $all_mensaje_result->fields["imagen_maquinaria02"] != "") ? "SI":"NO";
				$sData .= "Tiene Documentos Maquinaria: ".$documentosmaquinaria."</p>";
				//$foliorealmaquinaria=$all_mensaje_result->fields["imagen_maquinaria03"];
				$foliorealmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria03"]) && $all_mensaje_result->fields["imagen_maquinaria03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Maquinaria: ".$foliorealmaquinaria."</p>";
				//$impuestomaquinaria=$all_mensaje_result->fields["imagen_maquinaria05"];
				$impuestomaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria05"]) && $all_mensaje_result->fields["imagen_maquinaria05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos Maquinaria: ".$impuestomaquinaria."</p>";
				//$ruatmaquinaria=$all_mensaje_result->fields["imagen_maquinaria06"];
				$ruatmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria06"]) && $all_mensaje_result->fields["imagen_maquinaria06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Rutas Maquinaria: ".$ruatmaquinaria."</p>";
				//$polizamaquinaria=$all_mensaje_result->fields["imagen_maquinaria07"];
				$polizamaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria07"]) && $all_mensaje_result->fields["imagen_maquinaria07"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza Maquinaria: ".$polizamaquinaria."</p>";
			}
			if (isset($esmercaderia) && $esmercaderia != ""){
				//$documentosmercaderia=$all_mensaje_result->fields["documento_mercaderia"];
				$documentosmercaderia = (isset($all_mensaje_result->fields["documento_mercaderia"]) && $all_mensaje_result->fields["documento_mercaderia"] != "") ? true:false;
				$sData .= "<p>Tiene Docuemento Mercaderia: ".$documentosmercaderia."</p>";
				//$imagenmercaderia=$all_mensaje_result->fields["imagen_mercaderia01"];
				$imagenmercaderia = (isset($all_mensaje_result->fields["imagen_mercaderia01"]) && $all_mensaje_result->fields["imagen_mercaderia01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Mercaderia: ".$imagenmercaderia."</p>";

			}
			if (isset($esespecial) && $esespecial != ""){
				//$imagenespecial=$all_mensaje_result->fields["imagen_tipoespecial01"];
				$imagenespecial = (isset($all_mensaje_result->fields["imagen_tipoespecial01"]) && $all_mensaje_result->fields["imagen_tipoespecial01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Especial: ".$imagenespecial."</p>";
			}


			//$sData = $email.$esinmueble.$esvehiculo.$esmaquinaria.$esmercaderia;


			$all_mensaje_result->MoveNext();
		}
		//echo $sData; // display it

		$all_mensaje_result->Close();

		$core_php->setSuccessMessage($sData);
		//ew_SendEmail()

		//$core_php->s
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
		exit;
	} else {
		$core_php->setFailureMessage("No records found.");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
	}
}
//email
if ($_GET['type']=="email")
{

	$TheQuery="SELECT * FROM solicitud WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
//echo $TheQuery;
	$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);

	if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
		$all_mensaje_result->MoveFirst();
		$sData = "";
		while ($all_mensaje_result && !$all_mensaje_result->EOF)
		{
			$nombre=$all_mensaje_result->fields["name"].$all_mensaje_result->fields["lastname"];
			$sData .= "<p>Nombre: ".$nombre."</p>";
			$email=$all_mensaje_result->fields[3];
			$sData .= "<p>Correo Electronico: ".$email."</p>";

			$address=$all_mensaje_result->fields["address"];
			$sData .= "<p>Direccion: ".$address."</p>";
			$telefono=$all_mensaje_result->fields["phone"];
			$sData .= "<p>Telefono: ".$telefono."</p>";
			$celular=$all_mensaje_result->fields["cell"];
			$sData .= "<p>Celular: ".$celular."</p>";
			$nombre_contacto=$all_mensaje_result->fields["nombre_contacto"];
			$sData .= "<p>Nombre Contacto: ".$nombre_contacto."</p>";
			$email_contacto=$all_mensaje_result->fields["email_contacto"];
			$sData .= "<p>Email Contacto: ".$email_contacto."</p>";


			$esinmueble=$all_mensaje_result->fields["tipoinmueble"];

			$esvehiculo=$all_mensaje_result->fields[21];
			$esmaquinaria=$all_mensaje_result->fields[32];
			$esmercaderia=$all_mensaje_result->fields[43];
			$esespecial=$all_mensaje_result->fields[43];


			if (isset($esinmueble) && $esinmueble != ""){
				//echo "es inmbueble";
				//echo "es inmbueble";
				//$ubicacion=$all_mensaje_result->fields["imagen_inmueble01"];
				$ubicacion = (isset($all_mensaje_result->fields["imagen_inmueble01"]) || $all_mensaje_result->fields["imagen_inmueble01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Ubicacion: ".$ubicacion."</p>";

				//$documentos=$all_mensaje_result->fields["imagen_inmueble02"];
				$documentos = (isset($all_mensaje_result->fields["imagen_inmueble02"]) || $all_mensaje_result->fields["imagen_inmueble02"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Documentos: ".$documentos."</p>";

				//$folioreal=$all_mensaje_result->fields["imagen_inmueble03"];
				$folioreal = (isset($all_mensaje_result->fields["imagen_inmueble03"]) || $all_mensaje_result->fields["imagen_inmueble03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Real: ".$folioreal."</p>";

				//$plano=$all_mensaje_result->fields["imagen_inmueble04"];
				$plano = (isset($all_mensaje_result->fields["imagen_inmueble04"]) || $all_mensaje_result->fields["imagen_inmueble04"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Plano: ".$plano."</p>";
				//$impuesto=$all_mensaje_result->fields["imagen_inmueble05"];
				$impuesto = (isset($all_mensaje_result->fields["imagen_inmueble05"]) || $all_mensaje_result->fields["imagen_inmueble05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuesto: ".$impuesto."</p>";
			}
			if (isset($esvehiculo) && $esvehiculo != ""){

				//$documentosvehiculo=$all_mensaje_result->fields["imagen_vehiculo01"];
				$documentosvehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo01"]) && $all_mensaje_result->fields["imagen_vehiculo01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Docuementos del Vehiculo: ".$documentosvehiculo."</p>";
				//$impuestovehiculo=$all_mensaje_result->fields["imagen_vehiculo05"];
				$impuestovehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo05"]) && $all_mensaje_result->fields["imagen_vehiculo05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos del Vehiculo: ".$impuestovehiculo."</p>";

				//$ruat=$all_mensaje_result->fields["imagen_vehiculo06"];
				$ruat = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .=  "<p>Tiene Ruat del Vehiculo: ".$ruat."</p>";

				//$poliza=$all_mensaje_result->fields["imagen_vehiculo07"];
				$poliza = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza: ".$poliza."</p>";

			}
			if (isset($esmaquinaria) && $esmaquinaria != ""){
				//$documentosmaquinaria=$all_mensaje_result->fields["imagen_maquinaria02"];
				$documentosmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria02"]) && $all_mensaje_result->fields["imagen_maquinaria02"] != "") ? "SI":"NO";
				$sData .= "Tiene Documentos Maquinaria: ".$documentosmaquinaria."</p>";
				//$foliorealmaquinaria=$all_mensaje_result->fields["imagen_maquinaria03"];
				$foliorealmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria03"]) && $all_mensaje_result->fields["imagen_maquinaria03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Maquinaria: ".$foliorealmaquinaria."</p>";
				//$impuestomaquinaria=$all_mensaje_result->fields["imagen_maquinaria05"];
				$impuestomaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria05"]) && $all_mensaje_result->fields["imagen_maquinaria05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos Maquinaria: ".$impuestomaquinaria."</p>";
				//$ruatmaquinaria=$all_mensaje_result->fields["imagen_maquinaria06"];
				$ruatmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria06"]) && $all_mensaje_result->fields["imagen_maquinaria06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Rutas Maquinaria: ".$ruatmaquinaria."</p>";
				//$polizamaquinaria=$all_mensaje_result->fields["imagen_maquinaria07"];
				$polizamaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria07"]) && $all_mensaje_result->fields["imagen_maquinaria07"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza Maquinaria: ".$polizamaquinaria."</p>";
			}
			if (isset($esmercaderia) && $esmercaderia != ""){
				//$documentosmercaderia=$all_mensaje_result->fields["documento_mercaderia"];
				$documentosmercaderia = (isset($all_mensaje_result->fields["documento_mercaderia"]) && $all_mensaje_result->fields["documento_mercaderia"] != "") ? true:false;
				$sData .= "<p>Tiene Docuemento Mercaderia: ".$documentosmercaderia."</p>";
				//$imagenmercaderia=$all_mensaje_result->fields["imagen_mercaderia01"];
				$imagenmercaderia = (isset($all_mensaje_result->fields["imagen_mercaderia01"]) && $all_mensaje_result->fields["imagen_mercaderia01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Mercaderia: ".$imagenmercaderia."</p>";

			}
			if (isset($esespecial) && $esespecial != ""){
				//$imagenespecial=$all_mensaje_result->fields["imagen_tipoespecial01"];
				$imagenespecial = (isset($all_mensaje_result->fields["imagen_tipoespecial01"]) && $all_mensaje_result->fields["imagen_tipoespecial01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Especial: ".$imagenespecial."</p>";
			}


			//$sData = $email.$esinmueble.$esvehiculo.$esmaquinaria.$esmercaderia;


			$all_mensaje_result->MoveNext();
		}
		//echo $sData; // display it

		$all_mensaje_result->Close();
		$assunto = "Actualizacion de Documentos";
		$texto = $sData;


		$email_envio = ew_ExecuteScalar("SELECT  max(login) as login FROM usuario WHERE id_rol=3 and id_sucursal = '" . ew_AdjustSql($_SESSION["sucursal"]) . "'");

		if (isset($email_envio))
		{
		$Email = new cEmail;
		$Email->Sender="tester@communitysoft.org";
		$Email->AddRecipient($email_envio);
		$Email->AddCc($email_contacto);
		$Email->Subject = $assunto;
		$Email->Content = $sData;
		$Email->Recipient = $email_envio;
		$bEmailSent = $Email->Send();

		$sql_new="INSERT INTO `emailnotificaciones` (`enviadopor`, `recibidopor`, `cc`, `bcc`, `mensaje`, `leido`, `estado`, `fechaenvio`, `fecharecibido`) VALUES ('".$_SESSION["usr"]."', '".$email_envio."', NULL, NULL, '".$texto."', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
		$MyResult = ew_Execute($sql_new);
			$core_php->setSuccessMessage("Correo enviado");
		}
		else{
			$core_php->setFailureMessage("Correo no enviado");
		}
	//	var_dump($bEmailSent);
		//$core_php->s

		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
		exit;
	} else {
		$core_php->setFailureMessage("No records found.");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
	}
}
////

if ($_GET['type']=="notify")
{
	$TheQuery="SELECT * FROM solicitud WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
//echo $TheQuery;
	$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);

	if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
		$all_mensaje_result->MoveFirst();
		$sData = "";
		while ($all_mensaje_result && !$all_mensaje_result->EOF)
		{
			$nombre=$all_mensaje_result->fields["name"].$all_mensaje_result->fields["lastname"];
			$sData .= "<p>Nombre: ".$nombre."</p>";
			$email=$all_mensaje_result->fields[3];
			$sData .= "<p>Correo Electronico: ".$email."</p>";

			$address=$all_mensaje_result->fields["address"];
			$sData .= "<p>Direccion: ".$address."</p>";
			$telefono=$all_mensaje_result->fields["phone"];
			$sData .= "<p>Telefono: ".$telefono."</p>";
			$celular=$all_mensaje_result->fields["cell"];
			$sData .= "<p>Celular: ".$celular."</p>";
			$nombre_contacto=$all_mensaje_result->fields["nombre_contacto"];
			$sData .= "<p>Nombre Contacto: ".$nombre_contacto."</p>";
			$email_contacto=$all_mensaje_result->fields["email_contacto"];
			$sData .= "<p>Email Contacto: ".$email_contacto."</p>";


			$esinmueble=$all_mensaje_result->fields["tipoinmueble"];

			$esvehiculo=$all_mensaje_result->fields[21];
			$esmaquinaria=$all_mensaje_result->fields[32];
			$esmercaderia=$all_mensaje_result->fields[43];
			$esespecial=$all_mensaje_result->fields[43];


			if (isset($esinmueble) && $esinmueble != ""){
				//echo "es inmbueble";
				//echo "es inmbueble";
				//$ubicacion=$all_mensaje_result->fields["imagen_inmueble01"];
				$ubicacion = (isset($all_mensaje_result->fields["imagen_inmueble01"]) || $all_mensaje_result->fields["imagen_inmueble01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Ubicacion: ".$ubicacion."</p>";

				//$documentos=$all_mensaje_result->fields["imagen_inmueble02"];
				$documentos = (isset($all_mensaje_result->fields["imagen_inmueble02"]) || $all_mensaje_result->fields["imagen_inmueble02"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Documentos: ".$documentos."</p>";

				//$folioreal=$all_mensaje_result->fields["imagen_inmueble03"];
				$folioreal = (isset($all_mensaje_result->fields["imagen_inmueble03"]) || $all_mensaje_result->fields["imagen_inmueble03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Real: ".$folioreal."</p>";

				//$plano=$all_mensaje_result->fields["imagen_inmueble04"];
				$plano = (isset($all_mensaje_result->fields["imagen_inmueble04"]) || $all_mensaje_result->fields["imagen_inmueble04"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Plano: ".$plano."</p>";
				//$impuesto=$all_mensaje_result->fields["imagen_inmueble05"];
				$impuesto = (isset($all_mensaje_result->fields["imagen_inmueble05"]) || $all_mensaje_result->fields["imagen_inmueble05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuesto: ".$impuesto."</p>";
			}
			if (isset($esvehiculo) && $esvehiculo != ""){

				//$documentosvehiculo=$all_mensaje_result->fields["imagen_vehiculo01"];
				$documentosvehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo01"]) && $all_mensaje_result->fields["imagen_vehiculo01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Docuementos del Vehiculo: ".$documentosvehiculo."</p>";
				//$impuestovehiculo=$all_mensaje_result->fields["imagen_vehiculo05"];
				$impuestovehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo05"]) && $all_mensaje_result->fields["imagen_vehiculo05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos del Vehiculo: ".$impuestovehiculo."</p>";

				//$ruat=$all_mensaje_result->fields["imagen_vehiculo06"];
				$ruat = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .=  "<p>Tiene Ruat del Vehiculo: ".$ruat."</p>";

				//$poliza=$all_mensaje_result->fields["imagen_vehiculo07"];
				$poliza = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza: ".$poliza."</p>";

			}
			if (isset($esmaquinaria) && $esmaquinaria != ""){
				//$documentosmaquinaria=$all_mensaje_result->fields["imagen_maquinaria02"];
				$documentosmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria02"]) && $all_mensaje_result->fields["imagen_maquinaria02"] != "") ? "SI":"NO";
				$sData .= "Tiene Documentos Maquinaria: ".$documentosmaquinaria."</p>";
				//$foliorealmaquinaria=$all_mensaje_result->fields["imagen_maquinaria03"];
				$foliorealmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria03"]) && $all_mensaje_result->fields["imagen_maquinaria03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Maquinaria: ".$foliorealmaquinaria."</p>";
				//$impuestomaquinaria=$all_mensaje_result->fields["imagen_maquinaria05"];
				$impuestomaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria05"]) && $all_mensaje_result->fields["imagen_maquinaria05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos Maquinaria: ".$impuestomaquinaria."</p>";
				//$ruatmaquinaria=$all_mensaje_result->fields["imagen_maquinaria06"];
				$ruatmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria06"]) && $all_mensaje_result->fields["imagen_maquinaria06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Rutas Maquinaria: ".$ruatmaquinaria."</p>";
				//$polizamaquinaria=$all_mensaje_result->fields["imagen_maquinaria07"];
				$polizamaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria07"]) && $all_mensaje_result->fields["imagen_maquinaria07"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza Maquinaria: ".$polizamaquinaria."</p>";
			}
			if (isset($esmercaderia) && $esmercaderia != ""){
				//$documentosmercaderia=$all_mensaje_result->fields["documento_mercaderia"];
				$documentosmercaderia = (isset($all_mensaje_result->fields["documento_mercaderia"]) && $all_mensaje_result->fields["documento_mercaderia"] != "") ? true:false;
				$sData .= "<p>Tiene Docuemento Mercaderia: ".$documentosmercaderia."</p>";
				//$imagenmercaderia=$all_mensaje_result->fields["imagen_mercaderia01"];
				$imagenmercaderia = (isset($all_mensaje_result->fields["imagen_mercaderia01"]) && $all_mensaje_result->fields["imagen_mercaderia01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Mercaderia: ".$imagenmercaderia."</p>";

			}
			if (isset($esespecial) && $esespecial != ""){
				//$imagenespecial=$all_mensaje_result->fields["imagen_tipoespecial01"];
				$imagenespecial = (isset($all_mensaje_result->fields["imagen_tipoespecial01"]) && $all_mensaje_result->fields["imagen_tipoespecial01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Especial: ".$imagenespecial."</p>";
			}


			//$sData = $email.$esinmueble.$esvehiculo.$esmaquinaria.$esmercaderia;


			$all_mensaje_result->MoveNext();
		}
		//echo $sData; // display it

		$all_mensaje_result->Close();

		$assunto = "Actualizacion de Documentos";
		$texto = $sData;
		$email_envio = ew_ExecuteScalar("SELECT  max(login) as login FROM usuario WHERE id_rol=3 and id_sucursal = '" . ew_AdjustSql($_SESSION["sucursal"]) . "'");

		if (isset($email_envio)) {
			$sql_new = "INSERT INTO `notificaciones` (`mensaje`, `creadopor`, `recibidopor`, `leido`, `estado`, `fecha`, `fechaleido`) VALUES ('mensaje', '" . $_SESSION["usr"] . "', '" . $email_envio . "', '0', '0', NOW(), NOW())";
			$MyResult = ew_Execute($sql_new);
			$core_php->setSuccessMessage("Notificacion enviada");
			header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
			exit;
		}else{

			$core_php->setFailureMessage("Notificacion no enviada");
			header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
			exit;
		}
	} else {
		$core_php->setFailureMessage("No records found.");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
	}
}
if ($_GET['type']=="notifylearn")
{
if (isset($_GET['id']))
{

	$TheQuery="UPDATE notificaciones set leido=1 where id= '" . ew_AdjustSql($_GET['id']) . "'";
	ew_Execute($TheQuery);
	$core_php->setSuccessMessage("Notificacion Leida");
	header('Location: notificacionesview.php?showdetail=&id='.$_GET['id']);
	exit;
}
}
if ($_GET['type']=="emaillearn")
{
if (isset($_GET['id']))
{

	$TheQuery="UPDATE emailnotificaciones set leido=1 where id= '" . ew_AdjustSql($_GET['id']) . "'";
	ew_Execute($TheQuery);
	$core_php->setSuccessMessage("Correo Leido");
	header('Location: notificacionesview.php?showdetail=&id='.$_GET['id']);
	exit;
}
}

if ($_GET['type']=="smslearn")
{
//	$TheQuery="UPDATE emailnotificaciones set leido=1 where id= '" . ew_AdjustSql($_GET['id']) . "'";
//	ew_Execute($TheQuery);
	$core_php->setSuccessMessage("SMS enviado");
	header('Location:viewsolicitudedit.php?showdetail=&id='.$_GET['id']);
	exit;

}
}/////else of
else{
if ($_GET['type']=="validar")
{
	$TheQuery="SELECT * FROM solicitud WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
//echo $TheQuery;
	$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);

	if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
		$all_mensaje_result->MoveFirst();
		$sData = "";
		while ($all_mensaje_result && !$all_mensaje_result->EOF)
		{
			$nombre=$all_mensaje_result->fields["name"].$all_mensaje_result->fields["lastname"];
			$sData .= "<p>Nombre: ".$nombre."</p>";
			$email=$all_mensaje_result->fields[3];
			$sData .= "<p>Correo Electronico: ".$email."</p>";

			$address=$all_mensaje_result->fields["address"];
			$sData .= "<p>Direccion: ".$address."</p>";
			$telefono=$all_mensaje_result->fields["phone"];
			$sData .= "<p>Telefono: ".$telefono."</p>";
			$celular=$all_mensaje_result->fields["cell"];
			$sData .= "<p>Celular: ".$celular."</p>";



			$esinmueble=$all_mensaje_result->fields["tipoinmueble"];

			$esvehiculo=$all_mensaje_result->fields[21];
			$esmaquinaria=$all_mensaje_result->fields[32];
			$esmercaderia=$all_mensaje_result->fields[43];
			$esespecial=$all_mensaje_result->fields[43];


			if (isset($esinmueble) && $esinmueble != ""){
				//echo "es inmbueble";
				//echo "es inmbueble";
				//$ubicacion=$all_mensaje_result->fields["imagen_inmueble01"];
				$ubicacion = (isset($all_mensaje_result->fields["imagen_inmueble01"]) || $all_mensaje_result->fields["imagen_inmueble01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Ubicacion: ".$ubicacion."</p>";

				//$documentos=$all_mensaje_result->fields["imagen_inmueble02"];
				$documentos = (isset($all_mensaje_result->fields["imagen_inmueble02"]) || $all_mensaje_result->fields["imagen_inmueble02"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Documentos: ".$documentos."</p>";

				//$folioreal=$all_mensaje_result->fields["imagen_inmueble03"];
				$folioreal = (isset($all_mensaje_result->fields["imagen_inmueble03"]) || $all_mensaje_result->fields["imagen_inmueble03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Real: ".$folioreal."</p>";

				//$plano=$all_mensaje_result->fields["imagen_inmueble04"];
				$plano = (isset($all_mensaje_result->fields["imagen_inmueble04"]) || $all_mensaje_result->fields["imagen_inmueble04"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Plano: ".$plano."</p>";
				//$impuesto=$all_mensaje_result->fields["imagen_inmueble05"];
				$impuesto = (isset($all_mensaje_result->fields["imagen_inmueble05"]) || $all_mensaje_result->fields["imagen_inmueble05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuesto: ".$impuesto."</p>";
			}
			if (isset($esvehiculo) && $esvehiculo != ""){

				//$documentosvehiculo=$all_mensaje_result->fields["imagen_vehiculo01"];
				$documentosvehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo01"]) && $all_mensaje_result->fields["imagen_vehiculo01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Docuementos del Vehiculo: ".$documentosvehiculo."</p>";
				//$impuestovehiculo=$all_mensaje_result->fields["imagen_vehiculo05"];
				$impuestovehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo05"]) && $all_mensaje_result->fields["imagen_vehiculo05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos del Vehiculo: ".$impuestovehiculo."</p>";

				//$ruat=$all_mensaje_result->fields["imagen_vehiculo06"];
				$ruat = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .=  "<p>Tiene Ruat del Vehiculo: ".$ruat."</p>";

				//$poliza=$all_mensaje_result->fields["imagen_vehiculo07"];
				$poliza = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza: ".$poliza."</p>";

			}
			if (isset($esmaquinaria) && $esmaquinaria != ""){
				//$documentosmaquinaria=$all_mensaje_result->fields["imagen_maquinaria02"];
				$documentosmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria02"]) && $all_mensaje_result->fields["imagen_maquinaria02"] != "") ? "SI":"NO";
				$sData .= "Tiene Documentos Maquinaria: ".$documentosmaquinaria."</p>";
				//$foliorealmaquinaria=$all_mensaje_result->fields["imagen_maquinaria03"];
				$foliorealmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria03"]) && $all_mensaje_result->fields["imagen_maquinaria03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Maquinaria: ".$foliorealmaquinaria."</p>";
				//$impuestomaquinaria=$all_mensaje_result->fields["imagen_maquinaria05"];
				$impuestomaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria05"]) && $all_mensaje_result->fields["imagen_maquinaria05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos Maquinaria: ".$impuestomaquinaria."</p>";
				//$ruatmaquinaria=$all_mensaje_result->fields["imagen_maquinaria06"];
				$ruatmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria06"]) && $all_mensaje_result->fields["imagen_maquinaria06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Rutas Maquinaria: ".$ruatmaquinaria."</p>";
				//$polizamaquinaria=$all_mensaje_result->fields["imagen_maquinaria07"];
				$polizamaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria07"]) && $all_mensaje_result->fields["imagen_maquinaria07"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza Maquinaria: ".$polizamaquinaria."</p>";
			}
			if (isset($esmercaderia) && $esmercaderia != ""){
				//$documentosmercaderia=$all_mensaje_result->fields["documento_mercaderia"];
				$documentosmercaderia = (isset($all_mensaje_result->fields["documento_mercaderia"]) && $all_mensaje_result->fields["documento_mercaderia"] != "") ? true:false;
				$sData .= "<p>Tiene Docuemento Mercaderia: ".$documentosmercaderia."</p>";
				//$imagenmercaderia=$all_mensaje_result->fields["imagen_mercaderia01"];
				$imagenmercaderia = (isset($all_mensaje_result->fields["imagen_mercaderia01"]) && $all_mensaje_result->fields["imagen_mercaderia01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Mercaderia: ".$imagenmercaderia."</p>";

			}
			if (isset($esespecial) && $esespecial != ""){
				//$imagenespecial=$all_mensaje_result->fields["imagen_tipoespecial01"];
				$imagenespecial = (isset($all_mensaje_result->fields["imagen_tipoespecial01"]) && $all_mensaje_result->fields["imagen_tipoespecial01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Especial: ".$imagenespecial."</p>";
			}


			//$sData = $email.$esinmueble.$esvehiculo.$esmaquinaria.$esmercaderia;


			$all_mensaje_result->MoveNext();
		}
		//echo $sData; // display it

		$all_mensaje_result->Close();
		$core_php->setSuccessMessage($sData);
		//ew_SendEmail()

		//$core_php->s
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
		exit;
	} else {
		$core_php->setFailureMessage("No records found.");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
	}
}
//email
if ($_GET['type']=="email")
{
	$TheQuery="SELECT * FROM solicitud WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
//echo $TheQuery;
	$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);

	if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
		$all_mensaje_result->MoveFirst();
		$sData = "";
		while ($all_mensaje_result && !$all_mensaje_result->EOF)
		{
			$nombre=$all_mensaje_result->fields["name"].$all_mensaje_result->fields["lastname"];
			$sData .= "<p>Nombre: ".$nombre."</p>";
			$email=$all_mensaje_result->fields[3];
			$sData .= "<p>Correo Electronico: ".$email."</p>";

			$address=$all_mensaje_result->fields["address"];
			$sData .= "<p>Direccion: ".$address."</p>";
			$telefono=$all_mensaje_result->fields["phone"];
			$sData .= "<p>Telefono: ".$telefono."</p>";
			$celular=$all_mensaje_result->fields["cell"];
			$sData .= "<p>Celular: ".$celular."</p>";
			$nombre_contacto=$all_mensaje_result->fields["nombre_contacto"];
			$sData .= "<p>Nombre Contacto: ".$nombre_contacto."</p>";
			$email_contacto=$all_mensaje_result->fields["email_contacto"];
			$sData .= "<p>Email Contacto: ".$email_contacto."</p>";


			$esinmueble=$all_mensaje_result->fields["tipoinmueble"];

			$esvehiculo=$all_mensaje_result->fields[21];
			$esmaquinaria=$all_mensaje_result->fields[32];
			$esmercaderia=$all_mensaje_result->fields[43];
			$esespecial=$all_mensaje_result->fields[43];


			if (isset($esinmueble) && $esinmueble != ""){
				//echo "es inmbueble";
				//echo "es inmbueble";
				//$ubicacion=$all_mensaje_result->fields["imagen_inmueble01"];
				$ubicacion = (isset($all_mensaje_result->fields["imagen_inmueble01"]) || $all_mensaje_result->fields["imagen_inmueble01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Ubicacion: ".$ubicacion."</p>";

				//$documentos=$all_mensaje_result->fields["imagen_inmueble02"];
				$documentos = (isset($all_mensaje_result->fields["imagen_inmueble02"]) || $all_mensaje_result->fields["imagen_inmueble02"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Documentos: ".$documentos."</p>";

				//$folioreal=$all_mensaje_result->fields["imagen_inmueble03"];
				$folioreal = (isset($all_mensaje_result->fields["imagen_inmueble03"]) || $all_mensaje_result->fields["imagen_inmueble03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Real: ".$folioreal."</p>";

				//$plano=$all_mensaje_result->fields["imagen_inmueble04"];
				$plano = (isset($all_mensaje_result->fields["imagen_inmueble04"]) || $all_mensaje_result->fields["imagen_inmueble04"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Plano: ".$plano."</p>";
				//$impuesto=$all_mensaje_result->fields["imagen_inmueble05"];
				$impuesto = (isset($all_mensaje_result->fields["imagen_inmueble05"]) || $all_mensaje_result->fields["imagen_inmueble05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuesto: ".$impuesto."</p>";
			}
			if (isset($esvehiculo) && $esvehiculo != ""){

				//$documentosvehiculo=$all_mensaje_result->fields["imagen_vehiculo01"];
				$documentosvehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo01"]) && $all_mensaje_result->fields["imagen_vehiculo01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Docuementos del Vehiculo: ".$documentosvehiculo."</p>";
				//$impuestovehiculo=$all_mensaje_result->fields["imagen_vehiculo05"];
				$impuestovehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo05"]) && $all_mensaje_result->fields["imagen_vehiculo05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos del Vehiculo: ".$impuestovehiculo."</p>";

				//$ruat=$all_mensaje_result->fields["imagen_vehiculo06"];
				$ruat = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .=  "<p>Tiene Ruat del Vehiculo: ".$ruat."</p>";

				//$poliza=$all_mensaje_result->fields["imagen_vehiculo07"];
				$poliza = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza: ".$poliza."</p>";

			}
			if (isset($esmaquinaria) && $esmaquinaria != ""){
				//$documentosmaquinaria=$all_mensaje_result->fields["imagen_maquinaria02"];
				$documentosmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria02"]) && $all_mensaje_result->fields["imagen_maquinaria02"] != "") ? "SI":"NO";
				$sData .= "Tiene Documentos Maquinaria: ".$documentosmaquinaria."</p>";
				//$foliorealmaquinaria=$all_mensaje_result->fields["imagen_maquinaria03"];
				$foliorealmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria03"]) && $all_mensaje_result->fields["imagen_maquinaria03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Maquinaria: ".$foliorealmaquinaria."</p>";
				//$impuestomaquinaria=$all_mensaje_result->fields["imagen_maquinaria05"];
				$impuestomaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria05"]) && $all_mensaje_result->fields["imagen_maquinaria05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos Maquinaria: ".$impuestomaquinaria."</p>";
				//$ruatmaquinaria=$all_mensaje_result->fields["imagen_maquinaria06"];
				$ruatmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria06"]) && $all_mensaje_result->fields["imagen_maquinaria06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Rutas Maquinaria: ".$ruatmaquinaria."</p>";
				//$polizamaquinaria=$all_mensaje_result->fields["imagen_maquinaria07"];
				$polizamaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria07"]) && $all_mensaje_result->fields["imagen_maquinaria07"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza Maquinaria: ".$polizamaquinaria."</p>";
			}
			if (isset($esmercaderia) && $esmercaderia != ""){
				//$documentosmercaderia=$all_mensaje_result->fields["documento_mercaderia"];
				$documentosmercaderia = (isset($all_mensaje_result->fields["documento_mercaderia"]) && $all_mensaje_result->fields["documento_mercaderia"] != "") ? true:false;
				$sData .= "<p>Tiene Docuemento Mercaderia: ".$documentosmercaderia."</p>";
				//$imagenmercaderia=$all_mensaje_result->fields["imagen_mercaderia01"];
				$imagenmercaderia = (isset($all_mensaje_result->fields["imagen_mercaderia01"]) && $all_mensaje_result->fields["imagen_mercaderia01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Mercaderia: ".$imagenmercaderia."</p>";

			}
			if (isset($esespecial) && $esespecial != ""){
				//$imagenespecial=$all_mensaje_result->fields["imagen_tipoespecial01"];
				$imagenespecial = (isset($all_mensaje_result->fields["imagen_tipoespecial01"]) && $all_mensaje_result->fields["imagen_tipoespecial01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Especial: ".$imagenespecial."</p>";
			}


			//$sData = $email.$esinmueble.$esvehiculo.$esmaquinaria.$esmercaderia;


			$all_mensaje_result->MoveNext();
		}
		//echo $sData; // display it

		$all_mensaje_result->Close();
		$assunto = "Documentos Faltantes";
		$texto = $sData;

		$Email = new cEmail;
		$Email->Sender="tester@communitysoft.org";
		$Email->AddRecipient($email);
		$Email->AddCc($email_contacto);

		$Email->Subject = $assunto;
		$Email->Content = $sData;
		
		//$Email->Sender ="tester@communitysoft.org";
		$Email->Recipient = $email;
		
		$bEmailSent = $Email->Send();

		

		$sql_new="INSERT INTO `emailnotificaciones` (`enviadopor`, `recibidopor`, `cc`, `bcc`, `mensaje`, `leido`, `estado`, `fechaenvio`, `fecharecibido`) VALUES ('".$_SESSION["usr"]."', '".$email."', NULL, NULL, '".$texto."', '0', '0', CURRENT_TIMESTAMP, CURRENT_TIMESTAMP)";
		$MyResult = ew_Execute($sql_new);
		
	//	var_dump($bEmailSent);
		//$core_php->s
		$core_php->setSuccessMessage("Correo enviado");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
		exit;
	} else {
		$core_php->setFailureMessage("No records found.");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
	}
}
////


if ($_GET['type']=="notify")
{
	$TheQuery="SELECT * FROM solicitud WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
//echo $TheQuery;
	$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);

	if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
		$all_mensaje_result->MoveFirst();
		$sData = "";
		while ($all_mensaje_result && !$all_mensaje_result->EOF)
		{
			$nombre=$all_mensaje_result->fields["name"].$all_mensaje_result->fields["lastname"];
			$sData .= "<p>Nombre: ".$nombre."</p>";
			$email=$all_mensaje_result->fields[3];
			$sData .= "<p>Correo Electronico: ".$email."</p>";

			$address=$all_mensaje_result->fields["address"];
			$sData .= "<p>Direccion: ".$address."</p>";
			$telefono=$all_mensaje_result->fields["phone"];
			$sData .= "<p>Telefono: ".$telefono."</p>";
			$celular=$all_mensaje_result->fields["cell"];
			$sData .= "<p>Celular: ".$celular."</p>";
			$nombre_contacto=$all_mensaje_result->fields["nombre_contacto"];
			$sData .= "<p>Nombre Contacto: ".$nombre_contacto."</p>";
			$email_contacto=$all_mensaje_result->fields["email_contacto"];
			$sData .= "<p>Email Contacto: ".$email_contacto."</p>";


			$esinmueble=$all_mensaje_result->fields["tipoinmueble"];

			$esvehiculo=$all_mensaje_result->fields[21];
			$esmaquinaria=$all_mensaje_result->fields[32];
			$esmercaderia=$all_mensaje_result->fields[43];
			$esespecial=$all_mensaje_result->fields[43];


			if (isset($esinmueble) && $esinmueble != ""){
				//echo "es inmbueble";
				//echo "es inmbueble";
				//$ubicacion=$all_mensaje_result->fields["imagen_inmueble01"];
				$ubicacion = (isset($all_mensaje_result->fields["imagen_inmueble01"]) || $all_mensaje_result->fields["imagen_inmueble01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Ubicacion: ".$ubicacion."</p>";

				//$documentos=$all_mensaje_result->fields["imagen_inmueble02"];
				$documentos = (isset($all_mensaje_result->fields["imagen_inmueble02"]) || $all_mensaje_result->fields["imagen_inmueble02"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Documentos: ".$documentos."</p>";

				//$folioreal=$all_mensaje_result->fields["imagen_inmueble03"];
				$folioreal = (isset($all_mensaje_result->fields["imagen_inmueble03"]) || $all_mensaje_result->fields["imagen_inmueble03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Real: ".$folioreal."</p>";

				//$plano=$all_mensaje_result->fields["imagen_inmueble04"];
				$plano = (isset($all_mensaje_result->fields["imagen_inmueble04"]) || $all_mensaje_result->fields["imagen_inmueble04"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Plano: ".$plano."</p>";
				//$impuesto=$all_mensaje_result->fields["imagen_inmueble05"];
				$impuesto = (isset($all_mensaje_result->fields["imagen_inmueble05"]) || $all_mensaje_result->fields["imagen_inmueble05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuesto: ".$impuesto."</p>";
			}
			if (isset($esvehiculo) && $esvehiculo != ""){

				//$documentosvehiculo=$all_mensaje_result->fields["imagen_vehiculo01"];
				$documentosvehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo01"]) && $all_mensaje_result->fields["imagen_vehiculo01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Docuementos del Vehiculo: ".$documentosvehiculo."</p>";
				//$impuestovehiculo=$all_mensaje_result->fields["imagen_vehiculo05"];
				$impuestovehiculo = (isset($all_mensaje_result->fields["imagen_vehiculo05"]) && $all_mensaje_result->fields["imagen_vehiculo05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos del Vehiculo: ".$impuestovehiculo."</p>";

				//$ruat=$all_mensaje_result->fields["imagen_vehiculo06"];
				$ruat = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .=  "<p>Tiene Ruat del Vehiculo: ".$ruat."</p>";

				//$poliza=$all_mensaje_result->fields["imagen_vehiculo07"];
				$poliza = (isset($all_mensaje_result->fields["imagen_vehiculo06"]) && $all_mensaje_result->fields["imagen_vehiculo06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza: ".$poliza."</p>";

			}
			if (isset($esmaquinaria) && $esmaquinaria != ""){
				//$documentosmaquinaria=$all_mensaje_result->fields["imagen_maquinaria02"];
				$documentosmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria02"]) && $all_mensaje_result->fields["imagen_maquinaria02"] != "") ? "SI":"NO";
				$sData .= "Tiene Documentos Maquinaria: ".$documentosmaquinaria."</p>";
				//$foliorealmaquinaria=$all_mensaje_result->fields["imagen_maquinaria03"];
				$foliorealmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria03"]) && $all_mensaje_result->fields["imagen_maquinaria03"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Folio Maquinaria: ".$foliorealmaquinaria."</p>";
				//$impuestomaquinaria=$all_mensaje_result->fields["imagen_maquinaria05"];
				$impuestomaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria05"]) && $all_mensaje_result->fields["imagen_maquinaria05"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Impuestos Maquinaria: ".$impuestomaquinaria."</p>";
				//$ruatmaquinaria=$all_mensaje_result->fields["imagen_maquinaria06"];
				$ruatmaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria06"]) && $all_mensaje_result->fields["imagen_maquinaria06"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Rutas Maquinaria: ".$ruatmaquinaria."</p>";
				//$polizamaquinaria=$all_mensaje_result->fields["imagen_maquinaria07"];
				$polizamaquinaria = (isset($all_mensaje_result->fields["imagen_maquinaria07"]) && $all_mensaje_result->fields["imagen_maquinaria07"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Poliza Maquinaria: ".$polizamaquinaria."</p>";
			}
			if (isset($esmercaderia) && $esmercaderia != ""){
				//$documentosmercaderia=$all_mensaje_result->fields["documento_mercaderia"];
				$documentosmercaderia = (isset($all_mensaje_result->fields["documento_mercaderia"]) && $all_mensaje_result->fields["documento_mercaderia"] != "") ? true:false;
				$sData .= "<p>Tiene Docuemento Mercaderia: ".$documentosmercaderia."</p>";
				//$imagenmercaderia=$all_mensaje_result->fields["imagen_mercaderia01"];
				$imagenmercaderia = (isset($all_mensaje_result->fields["imagen_mercaderia01"]) && $all_mensaje_result->fields["imagen_mercaderia01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Mercaderia: ".$imagenmercaderia."</p>";

			}
			if (isset($esespecial) && $esespecial != ""){
				//$imagenespecial=$all_mensaje_result->fields["imagen_tipoespecial01"];
				$imagenespecial = (isset($all_mensaje_result->fields["imagen_tipoespecial01"]) && $all_mensaje_result->fields["imagen_tipoespecial01"] != "") ? "SI":"NO";
				$sData .= "<p>Tiene Imagen Especial: ".$imagenespecial."</p>";
			}


			//$sData = $email.$esinmueble.$esvehiculo.$esmaquinaria.$esmercaderia;


			$all_mensaje_result->MoveNext();
		}
		//echo $sData; // display it

		$all_mensaje_result->Close();

		$assunto = "Documentos Faltantes";
		$texto = $sData;

		$MyResult = ew_Execute($sql_new);
		$core_php->setSuccessMessage("Notificacion enviada");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
		exit;
	} else {
		$core_php->setFailureMessage("No records found.");
		header('Location: avaluoedit.php?showdetail=&id='.$_GET['ava']);
	}
}




////
if ($_GET['type']=="notifylearn")
{
if (isset($_GET['id']))
{

	$TheQuery="UPDATE notificaciones set leido=1 where id= '" . ew_AdjustSql($_GET['id']) . "'";
	ew_Execute($TheQuery);
	$core_php->setSuccessMessage("Notificacion Leida");
	header('Location: notificacionesview.php?showdetail=&id='.$_GET['id']);
	exit;
}
}
if ($_GET['type']=="emaillearn")
{
if (isset($_GET['id']))
{

	$TheQuery="UPDATE emailnotificaciones set leido=1 where id= '" . ew_AdjustSql($_GET['id']) . "'";
	ew_Execute($TheQuery);
	$core_php->setSuccessMessage("Correo Leido");
	header('Location: notificacionesview.php?showdetail=&id='.$_GET['id']);
	exit;
}
}

if ($_GET['type']=="smslearn")
{
//	$TheQuery="UPDATE emailnotificaciones set leido=1 where id= '" . ew_AdjustSql($_GET['id']) . "'";
//	ew_Execute($TheQuery);
	$core_php->setSuccessMessage("SMS enviado");
	header('Location:solicitudedit.php?showdetail=&id='.$_GET['id']);
	exit;

}
}

}else{

	header('Location:viewsolicitudlist.php');
	exit;
}
*/
if (isset($_GET['id']) || isset($_GET['type']) || isset($_GET['case'])) { /// all
if ($_GET['case']=="sec")
{


switch ($_GET['type']) {


	case "emailof":
		$core_php->setSuccessMessage("email enviado");
	header('Location:viewavaluosclist.php');
	exit;
	break;
	case "pagado":
		$core_php->setSuccessMessage("SMS enviado");
	header('Location:viewavaluosclist.php');
	exit;
	break;

	case "email":
	
			$Sql="SELECT solicitud.email FROM solicitud  INNER JOIN avaluo ON solicitud.id = avaluo.id_solicitud";
	$TheQuery=$Sql." WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
	$email = ew_ExecuteScalar($TheQuery);
	

		if (isset($email))
		{
		$Email = new cEmail;
		$Email->Sender="tester@communitysoft.org";
		$Email->AddRecipient($email);
		$Email->AddCc($email_contacto);
		$Email->Subject = $assunto;
		$Email->Content = $sData;
		$Email->Recipient = $email_envio;
		$bEmailSent = $Email->Send();
		$core_php->setSuccessMessage("Correo enviado");
		}
		else{
			$core_php->setFailureMessage("Correo no enviado");
		}

	$core_php->setSuccessMessage("Email enviado");
	header('Location:viewavaluosclist.php');
	exit;
	break;
	case "whataspp":
	$core_php->setSuccessMessage("WhatsApp enviado");
	header('Location:viewavaluosclist.php');
	exit;
	break;
	case "whatasppapi":
	$Sql="SELECT solicitud.cell FROM solicitud  INNER JOIN avaluo ON solicitud.id = avaluo.id_solicitud";
	$TheQuery=$Sql." WHERE id = '" . ew_AdjustSql($_GET['id']) . "'";
	$celular = ew_ExecuteScalar($TheQuery);
	
// https://eu84.chat-api.com/instance89383/ and token fa83g4xkqmnl36lf
	$apiURL = 'https://eu84.chat-api.com/instance89383/';
	$token = 'fa83g4xkqmnl36lf';

	$message = "Su avaluo fue terminado pase por la oficina para cancelar el costo ";
	$phone = $celular;
	$data = json_encode(
	array(
		'chatId'=>$phone.'@c.us',
		'body'=>$message
	)
	);
	$url = $apiURL.'message?token='.$token;
	$options = stream_context_create(
	array('http' =>
		array(
			'method'  => 'POST',
			'header'  => 'Content-type: application/json',
			'content' => $data
		)
		)
		);
	$response = file_get_contents($url,false,$options);
	$core_php->setSuccessMessage("WHATAPP enviado");
	header('Location:viewavaluosclist.php');
	exit;
		break;
	case "sms":
	   $Sql="SELECT solicitud.cell FROM solicitud  INNER JOIN avaluo ON solicitud.id = avaluo.id_solicitud";
		$TheQuery=$Sql." WHERE avaluo.id = '" . ew_AdjustSql($_GET['id']) . "'";
		$celular = ew_ExecuteScalar($TheQuery);
		$sms_msg= ew_Execute("insert into sms_data (celular,mensaje) values ('".$celular."','Su avaluo fue terminado pase por la oficina para cancelar el saldo')");
		$core_php->setSuccessMessage("SMS enviado");
	    header('Location:viewavaluosclist.php');
	    exit;
		break;
}
}
//echo $response; exit;
}

?>
<?php if (EW_DEBUG_ENABLED) echo ew_DebugMsg(); ?>
<?php include_once "footer.php" ?>
<?php
$core_php->Page_Terminate();
?>
