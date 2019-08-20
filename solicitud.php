<!DOCTYPE html>
<html>
<head>
	<title></title>
<meta charset="utf-8">
<link rel="stylesheet" type="text/css" href="bootstrap3/css/bootstrap.css">
<link rel="stylesheet" type="text/css" href="adminlte/css/AdminLTE.css">
<link rel="stylesheet" type="text/css" href="adminlte/css/font-awesome.min.css"><!-- Optional font -->
<link rel="stylesheet" type="text/css" href="phpcss/jquery.fileupload.css">
<link rel="stylesheet" type="text/css" href="phpcss/jquery.fileupload-ui.css">
<link rel="stylesheet" type="text/css" href="colorbox/colorbox.css">
<meta name="viewport" content="width=device-width, initial-scale=1">
<link rel="stylesheet" type="text/css" href="phpcss/invercon.css">
<script type="text/javascript" src="jquery/jquery-3.2.1.min.js"></script>
<script type="text/javascript" src="jquery/jquery.ui.widget.js"></script>
<script type="text/javascript" src="jquery/jquery.storageapi.min.js"></script>
<script type="text/javascript" src="bootstrap3/js/bootstrap.min.js"></script>
<script type="text/javascript" src="adminlte/js/adminlte.js"></script>
<script type="text/javascript" src="jquery/jquery.fileDownload.min.js"></script>
<script type="text/javascript" src="jquery/load-image.all.min.js"></script>
<script type="text/javascript" src="jquery/jqueryfileupload.min.js"></script>
<script type="text/javascript" src="phpjs/typeahead.jquery.js"></script>
<script type="text/javascript" src="colorbox/jquery.colorbox-min.js"></script>
<script type="text/javascript" src="phpjs/mobile-detect.min.js"></script>
<script type="text/javascript" src="moment/moment.min.js"></script>
<script type="text/javascript">
var EW_LANGUAGE_ID = "en";
var EW_DATE_SEPARATOR = "/"; // Date separator
var EW_TIME_SEPARATOR = ":"; // Time separator
var EW_DATE_FORMAT = "mm/dd/yyyy"; // Default date format
var EW_DATE_FORMAT_ID = 6; // Default date format ID
var EW_DECIMAL_POINT = ".";
var EW_THOUSANDS_SEP = ",";
var EW_SESSION_TIMEOUT = 0; // Session timeout time (seconds)
var EW_SESSION_TIMEOUT_COUNTDOWN = 60; // Count down time to session timeout (seconds)
var EW_SESSION_KEEP_ALIVE_INTERVAL = 0; // Keep alive interval (seconds)
var EW_RELATIVE_PATH = ""; // Relative path
var EW_SESSION_URL = EW_RELATIVE_PATH + "ewsession14.php"; // Session URL
var EW_IS_LOGGEDIN = false; // Is logged in
var EW_IS_SYS_ADMIN = false; // Is sys admin
var EW_CURRENT_USER_NAME = "Administrator"; // Current user name
var EW_IS_AUTOLOGIN = false; // Is logged in with option "Auto login until I logout explicitly"
var EW_TIMEOUT_URL = EW_RELATIVE_PATH + "logout.php"; // Timeout URL
var EW_LOOKUP_FILE_NAME = "ewlookup14.php"; // Lookup file name
var EW_LOOKUP_FILTER_VALUE_SEPARATOR = ","; // Lookup filter value separator
var EW_MODAL_LOOKUP_FILE_NAME = "ewmodallookup14.php"; // Modal lookup file name
var EW_AUTO_SUGGEST_MAX_ENTRIES = 10; // Auto-Suggest max entries
var EW_DISABLE_BUTTON_ON_SUBMIT = true;
var EW_IMAGE_FOLDER = "phpimages/"; // Image folder
var EW_UPLOAD_URL = "ewupload14.php"; // Upload URL
var EW_UPLOAD_TYPE = "POST"; // Upload type
var EW_UPLOAD_THUMBNAIL_WIDTH = 200; // Upload thumbnail width
var EW_UPLOAD_THUMBNAIL_HEIGHT = 0; // Upload thumbnail height
var EW_MULTIPLE_UPLOAD_SEPARATOR = ","; // Upload multiple separator
var EW_USE_COLORBOX = true;
var EW_USE_JAVASCRIPT_MESSAGE = false;
var EW_MOBILE_DETECT = new MobileDetect(window.navigator.userAgent);
var EW_IS_MOBILE = !!EW_MOBILE_DETECT.mobile();
var EW_PROJECT_STYLESHEET_FILENAME = "phpcss/invercon.css"; // Project style sheet
var EW_PDF_STYLESHEET_FILENAME = ""; // PDF style sheet
var EW_TOKEN = "x9g7nkded7CcylpfjtaYHA..";
var EW_CSS_FLIP = false;
var EW_LAZY_LOAD = true;
var EW_RESET_HEIGHT = true;
var EW_DEBUG_ENABLED = false;
var EW_CONFIRM_CANCEL = true;
var EW_SEARCH_FILTER_OPTION = "Client";
</script>
<script type="text/javascript" src="phpjs/jsrender.min.js"></script>
<script type="text/javascript">
$.views.settings.debugMode(EW_DEBUG_ENABLED);
</script>
<script type="text/javascript" src="phpjs/ewp14.js"></script>
<script type="text/javascript">
var ewLanguage = new ew_Language({"addbtn":"Add","cancelbtn":"Cancel","clickrecaptcha":"Please click reCAPTCHA","closebtn":"Close","confirmbtn":"Confirm","confirmcancel":"Do you want to cancel?","lightboxtitle":" ","lightboxcurrent":"image {current} of {total}","lightboxprevious":"previous","lightboxnext":"next","lightboxclose":"close","lightboxxhrerror":"This content failed to load.","lightboximgerror":"This image failed to load.","countselected":"%s selected","currentpassword":"Current password: ","deleteconfirmmsg":"Are you sure you want to delete?","deletefilterconfirm":"Delete filter %s?","editbtn":"Edit","enterfiltername":"Enter filter name","enternewpassword":"Please enter new password","enteroldpassword":"Please enter old password","enterpassword":"Please enter password","enterpwd":"Please enter password","enterusername":"Please enter username","entervalidatecode":"Enter the validation code shown","entersenderemail":"Please enter sender email","enterpropersenderemail":"Exceed maximum sender email count or email address incorrect","enterrecipientemail":"Please enter recipient email","enterproperrecipientemail":"Exceed maximum recipient email count or email address incorrect","enterproperccemail":"Exceed maximum cc email count or email address incorrect","enterproperbccemail":"Exceed maximum bcc email count or email address incorrect","entersubject":"Please enter subject","enteruid":"Please enter user ID","entervalidemail":"Please enter valid Email Address","exporting":"Exporting, please wait...","exporttoemailtext":"Email","failedtoexport":"Failed to Export","filtername":"Filter name","overwritebtn":"Overwrite","incorrectemail":"Incorrect email","incorrectfield":"Incorrect field","incorrectfloat":"Incorrect floating point number","incorrectguid":"Incorrect GUID","incorrectinteger":"Incorrect integer","incorrectphone":"Incorrect phone number","incorrectregexp":"Regular expression not matched","incorrectrange":"Number must be between %1 and %2","incorrectssn":"Incorrect social security number","incorrectzip":"Incorrect ZIP code","insertfailed":"Insert failed","invalidrecord":"Invalid Record! Key is null","loading":"Loading...","maxfilesize":"Max. file size (%s bytes) exceeded.","messageok":"OK","mismatchpassword":"Mismatch Password","more":"More","next":"Next","noaddrecord":"No records to be added","nofieldselected":"No field selected for update","norecord":"No records found","norecordselected":"No records selected","of":"of","page":"Page","passwordstrength":"Strength: %p","passwordtoosimple":"Your password is too simple","permissionaddcopy":"Add/Copy","permissiondelete":"Delete","permissionedit":"Edit","permissionlistsearchview":"List/Search/View","permissionlist":"List","permissionsearch":"Search","permissionview":"View","pleaseselect":"Please select","pleasewait":"Please wait...","prev":"Prev","quicksearchauto":"Auto","quicksearchautoshort":"","quicksearchall":"All keywords","quicksearchallshort":"All","quicksearchany":"Any keywords","quicksearchanyshort":"Any","quicksearchexact":"Exact match","quicksearchexactshort":"Exact","record":"Records","recordsperpage":"Page size","reloadbtn":"Reload","savebtn":"Save","search":"Search","searchbtn":"Search","selectbtn":"Select","sendemailsuccess":"Email sent successfully","sessionwillexpire":"Your session will expire in %s seconds. Click OK to continue your session.","sessionexpired":"Your session has expired.","updatebtn":"Update","uploading":"Uploading...","uploadstart":"Start","uploadcancel":"Cancel","uploaddelete":"Delete","uploadoverwrite":"Overwrite old file?","uploaderrmsgmaxfilesize":"File is too big","uploaderrmsgminfilesize":"File is too small","uploaderrmsgacceptfiletypes":"File type not allowed","uploaderrmsgmaxnumberoffiles":"Maximum number of files exceeded","uploaderrmsgmaxfilelength":"Total length of file names exceeds field length","useradministrator":"Administrator","useranonymous":"Anonymous","userdefault":"Default","userleveladministratorname":"User level name for user level -1 must be 'Administrator'","userlevelanonymousname":"User level name for user level -2 must be 'Anonymous'","userlevelidinteger":"User Level ID must be integer","userleveldefaultname":"User level name for user level 0 must be 'Default'","userlevelidincorrect":"User defined User Level ID must be larger than 0","userlevelnameincorrect":"User defined User Level name cannot be 'Administrator' or 'Default'","valuenotexist":"Value does not exist","wrongfiletype":"File type is not allowed.","tableorview":"Tables"});var ewVar = {"languages":{"languages":[]},"login":{"isLoggedIn":true,"currentUserName":"Administrator","logoutUrl":"logout.php","logoutText":"Logout","loginUrl":"login.php","loginText":"Login","canLogin":false,"canLogout":true,"changePasswordUrl":"changepwd.php","changePasswordText":"Change Password","canChangePassword":false}};
</script>
<script type="text/javascript" src="phpjs/userfn14.js"></script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<meta name="generator" content="PHPMaker v2018.0.7">
</head>
<body class="hold-transition skin-red" dir="ltr">
<div class="wrapper ewLayout">
	<!-- Main Header -->
	<header class="main-header">
	
		
	</header>
	<!-- Left side column, contains the logo and sidebar -->

	<!-- Content Wrapper. Contains page content -->
	<div class="content-wrapper">
		<!-- Content Header (Page header) -->
		<section class="content-header">
		<!-- Main content -->
		<section class="content">
<script type="text/javascript">

// Form object
var CurrentPageID = EW_PAGE_ID = "add";
var CurrentForm = fsolicitudadd = new ew_Form("fsolicitudadd", "add");

// Validate form
fsolicitudadd.Validate = function() {
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
				return this.OnError(elm, "Please enter required field - NOMBRE");
			elm = this.GetElements("x" + infix + "_lastname");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "Please enter required field - APELLIDO");
			elm = this.GetElements("x" + infix + "__email");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "Please enter required field - EMAIL");
			elm = this.GetElements("x" + infix + "_address");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "Please enter required field - DIRECCION");
			elm = this.GetElements("x" + infix + "_tipoinmueble");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "Please enter required field - TIPO INMUEBLE");
			elm = this.GetElements("x" + infix + "_id_ciudad");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "Please enter required field - CIUDAD");
			elm = this.GetElements("x" + infix + "_id_provincia");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "Please enter required field - PROVINCIA");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
	}

	// Process detail forms
	var dfs = $fobj.find("input[name='detailpage']").get();
	for (var i = 0; i < dfs.length; i++) {
		var df = dfs[i], val = df.value;
		if (val && ewForms[val])
			if (!ewForms[val].Validate())
				return false;
	}
	return true;
}

// Form_CustomValidate event
fsolicitudadd.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fsolicitudadd.ValidateRequired = true;

// Dynamic selection lists
fsolicitudadd.Lists["x_tipoinmueble"] = {"LinkField":"","Ajax":null,"AutoFill":false,"DisplayFields":["","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":""};
fsolicitudadd.Lists["x_tipoinmueble"].Options = [["1","Casas - Departamentos"],["2","Oficinas - Locales"],["3","Sitios"],["4","Sitios"],["5","Terrenos para desarrollo inmobiliario"],["6","Terrenos Industriales"],["7","Estacionamientos"],["8","Bodegas"],["9","Industrias - Galpones industriales"],["10","Agro Industrias (Unidades Econ\u00f3micas)"],["11","Colegios"],["12","Supermercados \/ Strip Center"]];
fsolicitudadd.Lists["x_id_ciudad"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"departamento"};
//fsolicitudadd.Lists["x_id_ciudad"].Data = "s=PEFyoYnOQDIEgbj5-hCTV65hkY512ly7j6Njel0LH6PnRbFNDghuQhWXEh5tKU9871sH10XBr2xLSyS7Gt-5hG-JtKxvVlsuJPpXVZAEJT1X-X0XYWklDXI6aJ5KWY941D7nLiSOB1bSNlZikKcmK4JcK7pvuCSnFFBEPh_gsVg.&d=&f0=XF_OKWhjJa-Dde3grd9_zZjo3NmujOqshMWUbg..&t0=3&fn0=&lang=en";
fsolicitudadd.Lists["x_id_provincia"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"provincia"};
//fsolicitudadd.Lists["x_id_provincia"].Data = "s=HYLSEat_2Ui9SktrViNjKzkleie8OiH2SZS3ay-01em7DqquJ5BugfHIpyq11D-w14n3B5XsRWjJGeTDtYu6b4LpCVJcJVegzDw6Onl8MPW6CCNBNj6u152QO_ir5DiQjhJRmbCct68liPO9ltirztlLIB-Mku4Sy0Yl4w..&d=&f0=XF_OKWhjJa-Dde3grd9_zZjo3NmujOqshMWUbg..&t0=3&fn0=&lang=en";

// Form object for search
</script>
<script type="text/javascript">

// Write your client script here, no need to add script tags.
</script>
<div class="ewMessageDialog"></div><form name="fsolicitudadd" id="fsolicitudadd" class="ewForm ewAddForm form-horizontal" action="solicitudadd.php" method="post">
<input type="hidden" name="token" value="x9g7nkded7CcylpfjtaYHA..">
<input type="hidden" name="t" value="solicitud">
<input type="hidden" name="a_add" id="a_add" value="A">
<input type="hidden" name="modal" value="0">
<div class="ewAddDiv"><!-- page* -->
	<div id="r_name" class="form-group">
		<label id="elh_solicitud_name" for="x_name" class="col-sm-2 control-label ewLabel">NOMBRE<span class="ewRequired">&nbsp;*</span></label>
		<div class="col-sm-10"><div>
<span id="el_solicitud_name">
<input type="text" data-table="solicitud" data-field="x_name" name="x_name" id="x_name" size="30" maxlength="50" placeholder="NOMBRE" value="" class="form-control">
</span>
</div></div>
	</div>
	<div id="r_lastname" class="form-group">
		<label id="elh_solicitud_lastname" for="x_lastname" class="col-sm-2 control-label ewLabel">APELLIDO<span class="ewRequired">&nbsp;*</span></label>
		<div class="col-sm-10"><div>
<span id="el_solicitud_lastname">
<input type="text" data-table="solicitud" data-field="x_lastname" name="x_lastname" id="x_lastname" size="30" maxlength="50" placeholder="APELLIDO" value="" class="form-control">
</span>
</div></div>
	</div>
	<div id="r__email" class="form-group">
		<label id="elh_solicitud__email" for="x__email" class="col-sm-2 control-label ewLabel">EMAIL<span class="ewRequired">&nbsp;*</span></label>
		<div class="col-sm-10"><div>
<span id="el_solicitud__email">
<input type="text" data-table="solicitud" data-field="x__email" name="x__email" id="x__email" size="30" maxlength="255" placeholder="EMAIL" value="" class="form-control">
</span>
</div></div>
	</div>
	<div id="r_address" class="form-group">
		<label id="elh_solicitud_address" for="x_address" class="col-sm-2 control-label ewLabel">DIRECCION<span class="ewRequired">&nbsp;*</span></label>
		<div class="col-sm-10"><div>
<span id="el_solicitud_address">
<input type="text" data-table="solicitud" data-field="x_address" name="x_address" id="x_address" size="30" maxlength="255" placeholder="DIRECCION" value="" class="form-control">
</span>
</div></div>
	</div>
	<div id="r_phone" class="form-group">
		<label id="elh_solicitud_phone" for="x_phone" class="col-sm-2 control-label ewLabel">TELEFONO</label>
		<div class="col-sm-10"><div>
<span id="el_solicitud_phone">
<input type="text" data-table="solicitud" data-field="x_phone" name="x_phone" id="x_phone" size="30" maxlength="255" placeholder="TELEFONO" value="" class="form-control">
</span>
</div></div>
	</div>
	<div id="r_cell" class="form-group">
		<label id="elh_solicitud_cell" for="x_cell" class="col-sm-2 control-label ewLabel">CELULAR</label>
		<div class="col-sm-10"><div>
<span id="el_solicitud_cell">
<input type="text" data-table="solicitud" data-field="x_cell" name="x_cell" id="x_cell" size="30" maxlength="255" placeholder="CELULAR" value="" class="form-control">
</span>
</div></div>
	</div>
	<div id="r_tipoinmueble" class="form-group">
		<label id="elh_solicitud_tipoinmueble" for="x_tipoinmueble" class="col-sm-2 control-label ewLabel">TIPO INMUEBLE<span class="ewRequired">&nbsp;*</span></label>
		<div class="col-sm-10"><div>
<span id="el_solicitud_tipoinmueble">
<select data-table="solicitud" data-field="x_tipoinmueble" data-value-separator=", " id="x_tipoinmueble" name="x_tipoinmueble" class="form-control">
<option value="">Please select</option>
<option value="" selected>Please select</option></select>
</span>
</div></div>
	</div>
	<div id="r_id_ciudad" class="form-group">
		<label id="elh_solicitud_id_ciudad" for="x_id_ciudad" class="col-sm-2 control-label ewLabel">CIUDAD<span class="ewRequired">&nbsp;*</span></label>
		<div class="col-sm-10"><div>
<span id="el_solicitud_id_ciudad">
<select data-table="solicitud" data-field="x_id_ciudad" data-value-separator=", " id="x_id_ciudad" name="x_id_ciudad" class="form-control">
<option value="">Please select</option></select>
</span>
</div></div>
	</div>
	<div id="r_id_provincia" class="form-group">
		<label id="elh_solicitud_id_provincia" for="x_id_provincia" class="col-sm-2 control-label ewLabel">PROVINCIA<span class="ewRequired">&nbsp;*</span></label>
		<div class="col-sm-10"><div>
<span id="el_solicitud_id_provincia">
<select data-table="solicitud" data-field="x_id_provincia" data-value-separator=", " id="x_id_provincia" name="x_id_provincia" class="form-control">
<option value="">Please select</option></select>
</span>
</div></div>
	</div>
</div><!-- /page* -->
<div class="form-group"><!-- buttons .form-group -->
	<div class="col-sm-10 col-sm-offset-2"><!-- buttons offset -->
<button class="btn btn-primary ewButton" name="btnAction" id="btnAction" type="submit">Add</button>
<button class="btn btn-default ewButton" name="btnCancel" id="btnCancel" type="button" data-href="http://localhost/invercon/solicitudlist.php">Cancel</button>
	</div><!-- /buttons offset -->
</div><!-- /buttons .form-group -->
</form>
<script type="text/javascript">
fsolicitudadd.Init();
</script>
<script type="text/javascript">

// Write your table-specific startup script here
// document.write("page loaded");

</script>
				</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="pull-right hidden-xs"></div>
		<!-- Default to the left --><!-- ** Note: Only licensed users are allowed to change the copyright statement. ** -->
		<div class="ewFooterText">&copy;2017 Invercon Technology Ltd. All rights reserved.</div>
	</footer>
</div>
<!-- ./wrapper -->
<script type="text/html" class="ewJsTemplate" data-name="menu" data-data="menu" data-target="#ewMenu">
<ul class="sidebar-menu" data-widget="tree" data-follow-link="{{:followLink}}" data-accordion="{{:accordion}}">
{{include tmpl="#menu"/}}
</ul>
</script>
<script type="text/html" id="menu">
{{if items}}
	{{for items}}
		<li id="{{:id}}" name="{{:name}}" class="{{if isHeader}}header{{else}}{{if items}}treeview{{/if}}{{if active}} active current{{/if}}{{if open}} menu-open{{/if}}{{/if}}">
			{{if isHeader}}
				{{if icon}}<i class="{{:icon}}"></i>{{/if}}
				<span>{{:text}}</span>
				{{if label}}
				<span class="pull-right-container">
					{{:label}}
				</span>
				{{/if}}
			{{else}}
			<a href="{{:href}}"{{if target}} target="{{:target}}"{{/if}}{{if attrs}}{{:attrs}}{{/if}}>
				{{if icon}}<i class="{{:icon}}"></i>{{/if}}
				<span>{{:text}}</span>
				{{if items}}
				<span class="pull-right-container">
					<i class="fa fa-angle-left pull-right"></i>
					{{if label}}
						<span>{{:label}}</span>
					{{/if}}
				</span>
				{{else}}
					{{if label}}
						<span class="pull-right-container">
							{{:label}}
						</span>
					{{/if}}
				{{/if}}
			</a>
			{{/if}}
			{{if items}}
			<ul class="treeview-menu"{{if open}} style="display: block;"{{/if}}>
				{{include tmpl="#menu"/}}
			</ul>
			{{/if}}
		</li>
	{{/for}}
{{/if}}
</script>
<script type="text/html" class="ewJsTemplate" data-name="languages" data-data="languages" data-method="prependTo" data-target=".navbar-custom-menu .nav">
{{for languages}}<li{{if selected}} class="active"{{/if}}><a href="#" class="ewTooltip" title="{{>desc}}" onclick="ew_SetLanguage(this);" data-language="{{:id}}">{{:id}}</a></li>{{/for}}</script>
<script type="text/html" class="ewJsTemplate" data-name="login" data-data="login" data-method="appendTo" data-target=".navbar-custom-menu .nav">
{{if isLoggedIn}}
<li class="dropdown user user-menu">
	<a href="#" class="dropdown-toggle" data-toggle="dropdown">
		<span class="glyphicon glyphicon-user" aria-hidden="true"></span>
	</a>
	<ul class="dropdown-menu">
		<!--<li class="user-header"></li>-->
		<li class="user-body">
			<p><span class="glyphicon glyphicon-user" aria-hidden="true"></span>&nbsp;&nbsp;{{:currentUserName}}</p>
		</li>
		<li class="user-footer">
			{{if canChangePassword}}
			<div class="pull-left">
				<a class="btn btn-default btn-flat" href="{{:changePasswordUrl}}">{{:changePasswordText}}</a>
			</div>
			{{/if}}
			{{if canLogout}}
			<div class="pull-right">
				<a class="btn btn-default btn-flat" href="{{:logoutUrl}}">{{:logoutText}}</a>
			</div>
			{{/if}}
		</li>
	</ul>
<li>
{{else}}
	{{if canLogin}}
<li><a href="{{:loginUrl}}">{{:loginText}}</a></li>
	{{/if}}
{{/if}}
</script>
<script type="text/javascript">
ew_RenderJsTemplates();
</script>
<!-- modal dialog -->
<div id="ewModalDialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>
<!-- message box -->
<div id="ewMsgBox" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton" data-dismiss="modal">OK</button></div></div></div></div>
<!-- prompt -->
<div id="ewPrompt" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton">OK</button><button type="button" class="btn btn-default ewButton" data-dismiss="modal">Cancel</button></div></div></div></div>
<!-- session timer -->
<div id="ewTimer" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton" data-dismiss="modal">OK</button></div></div></div></div>
<!-- tooltip -->
<div id="ewTooltip"></div>
<script type="text/javascript">
jQuery.get("phpjs/userevt14.js");
</script>
<script type="text/javascript">

// Write your global startup script here
// document.write("page loaded");

</script>
</body>
</html>

