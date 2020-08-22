<?php if (@$gsExport == "") { ?>
<?php if (@!$gbSkipHeaderFooter) { ?>
		<?php if (isset($gTimer)) $gTimer->Stop() ?>
		</section>
		<!-- /.content -->
	</div>
	<!-- /.content-wrapper -->
	<!-- Main Footer -->
	<footer class="main-footer">
		<!-- To the right -->
		<div class="pull-right hidden-xs"></div>
		<!-- Default to the left --><!-- ** Note: Only licensed users are allowed to change the copyright statement. ** -->
		<div class="ewFooterText"><?php echo $Language->ProjectPhrase("FooterText") ?></div>
	</footer>
	<script type="text/html" class="ewJsTemplate" data-name="login" data-data="login" data-method="appendTo" data-target=".navbar-custom-menu .nav">
{{if isLoggedIn}}
 <?php	

	//echo "SELECT count(*) FROM notificaciones WHERE recibidopor = '" . ew_AdjustSql(CurrentUserName()) . "'";			
$count = ew_ExecuteScalar("SELECT count(*) FROM notificaciones WHERE recibidopor = '" . ew_AdjustSql(CurrentUserName()) . "' AND leido=0 AND internal=1");
if ($count == 0)
{

?>

<?php

echo "<li class=\"dropdown notifications-menu\">\n";
echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">\n";
echo "<i class=\"fa fa-bell-o\"></i></br>\n";
//  echo "<i class=\"far fa-comments\"></i></br>\n";
//echo "<span class=\"badge badge-danger navbar-badge\">$count</span>";
echo "<span class=\"label label-danger\">$count</span>\n";
echo "</a>\n";
echo "<ul class=\"dropdown-menu\">\n";
echo "<li class=\"header\">Tu tienes $count mensaje</li>\n";
echo "</ul>\n";
echo "</li>\n";
}

// Get a field value
// NOTE: Modify your SQL here, replace the table name, field name and the condition
//$MyField = ew_ExecuteScalar("SELECT MyField FROM MyTable WHERE XXX");

else{				//<!-- inner menu: contains the actual data -->			
$TheQuery="SELECT * FROM notificaciones WHERE recibidopor = '" . ew_AdjustSql(CurrentUserName()) . "' AND leido=0 AND internal=1";				
$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);
if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
$all_mensaje_result->MoveFirst();
$sData = "";
echo "<li class=\"dropdown notifications-menu\">\n";
echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">\n";
echo "<i class=\"fa fa-bell-o\"></i></br>\n";
echo "<span class=\"label label-danger\">$count</span>\n";
echo "</a>\n";
echo "<ul class=\"dropdown-menu\">\n";
echo "<li class=\"header\">Tu tienes $count mensaje</li>\n";
echo "<li>\n";
echo "<ul class=\"menu\">\n";
while ($all_mensaje_result && !$all_mensaje_result->EOF) 
{
$idmensaje=$all_mensaje_result->fields[0];
$mensaje=$all_mensaje_result->fields[1];
	$creadopor=$all_mensaje_result->fields[2];
	$recibidopor=$all_mensaje_result->fields[3];
	$name_enviado = ew_ExecuteScalar("SELECT CONCAT(nombre, ', ', apellido) FROM usuario WHERE login = '" . ew_AdjustSql($creadopor) . "'");
	$especialidad_enviado = ew_ExecuteScalar("SELECT especialidad FROM usuario WHERE login = '" . ew_AdjustSql($creadopor) . "'");
	$min_enviado = ew_ExecuteScalar("SELECT TIMESTAMPDIFF(MINUTE,now(),fecha) FROM notificaciones WHERE creadopor = '" . ew_AdjustSql($creadopor) . "' and leido=0 AND internal=1");
echo "<li><!-- start message -->\n";
echo "<a href=avaluocore.php?type=notifylearn&id=".$idmensaje.">";
echo "<div class=\"pull-left\">\n";
echo "<img src=\"phpimages/people35.png\" class=\"img-circle\" alt=\"User Image\">\n";
echo "</div>\n";
echo "<h4>\n";
echo "$name_enviado\n";
echo "<small><i class=\"fa fa-clock-o\" style=\"font-size:5px;color:red\"></i>$min_enviado</small>\n";
echo "</h4>\n";
//echo "<p>$mensaje</p>\n";
echo "</a>\n";
echo "</li>\n";
$all_mensaje_result->MoveNext();
}

//echo $sData; // display it 
$all_mensaje_result->Close();
echo "<li class=\"footer\"><a href=\"notificacioneslist.php\">Ver todos los mensajes</a></li>\n";
echo "</ul>\n";
echo "</li>\n";
} else {
$this->setFailureMessage("No records found.");
}
echo "</ul>\n";
echo "</li>\n";
}

			//echo "SELECT count(*) FROM notificaciones WHERE recibidopor = '" . ew_AdjustSql(CurrentUserName()) . "'";			
$count = ew_ExecuteScalar("SELECT count(*) FROM notificaciones WHERE recibidopor = '" . ew_AdjustSql(CurrentUserName()) . "' AND leido=0 AND internal=0");
if ($count == 0)
{
echo "<li class=\"dropdown notifications-menu\">\n";
echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">\n";
echo "<i class=\"fa fa-bell-o\"></i></br>\n";
echo "<span class=\"label label-success\">$count</span>\n";
echo "</a>\n";
echo "<ul class=\"dropdown-menu\">\n";
echo "<li class=\"header\">Tu tienes $count mensaje</li>\n";
echo "</ul>\n";
echo "</li>\n";
}

// Get a field value
// NOTE: Modify your SQL here, replace the table name, field name and the condition
//$MyField = ew_ExecuteScalar("SELECT MyField FROM MyTable WHERE XXX");

else{				//<!-- inner menu: contains the actual data -->			
$TheQuery="SELECT * FROM notificaciones WHERE recibidopor = '" . ew_AdjustSql(CurrentUserName()) . "' AND leido=0 AND internal=0";				
$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);
if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
$all_mensaje_result->MoveFirst();
$sData = "";
echo "<li class=\"dropdown notifications-menu\">\n";
echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">\n";
echo "<i class=\"fa fa-bell-o\"></i></br>\n";
echo "<span class=\"label label-success\">$count</span>\n";
echo "</a>\n";
echo "<ul class=\"dropdown-menu\">\n";
echo "<li class=\"header\">Tu tienes $count mensaje</li>\n";
echo "<li>\n";
echo "<ul class=\"menu\">\n";
while ($all_mensaje_result && !$all_mensaje_result->EOF) 
{
$idmensaje=$all_mensaje_result->fields[0];
$mensaje=$all_mensaje_result->fields[1];
	$creadopor=$all_mensaje_result->fields[2];
	$recibidopor=$all_mensaje_result->fields[3];
	$name_enviado = ew_ExecuteScalar("SELECT CONCAT(nombre, ', ', apellido) FROM usuario WHERE login = '" . ew_AdjustSql($creadopor) . "'");
	$especialidad_enviado = ew_ExecuteScalar("SELECT especialidad FROM usuario WHERE login = '" . ew_AdjustSql($creadopor) . "'");
	$min_enviado = ew_ExecuteScalar("SELECT TIMESTAMPDIFF(MINUTE,now(),fecha) FROM notificaciones WHERE creadopor = '" . ew_AdjustSql($creadopor) . "' and leido=0 AND internal=0");
echo "<li><!-- start message -->\n";
echo "<a href=avaluocore.php?type=notifylearn&id=".$idmensaje.">";
echo "<div class=\"pull-left\">\n";
echo "<img src=\"phpimages/people35.png\" class=\"img-circle\" alt=\"User Image\">\n";
echo "</div>\n";
echo "<h4>\n";
echo "$name_enviado\n";
echo "<small><i class=\"fa fa-clock-o\"></i>$min_enviado</small>\n";
echo "</h4>\n";
//echo "<p>$mensaje</p>\n";
echo "</a>\n";
echo "</li>\n";
$all_mensaje_result->MoveNext();
}

//echo $sData; // display it 
$all_mensaje_result->Close();
echo "<li class=\"footer\"><a href=\"notificacioneslist.php\">Ver todos los mensajes</a></li>\n";
echo "</ul>\n";
echo "</li>\n";
} else {
$this->setFailureMessage("No records found.");
}
echo "</ul>\n";
echo "</li>\n";
}

/// notificaciones emai;
//echo "SELECT count(*) FROM notificaciones WHERE recibidopor = '" . ew_AdjustSql(CurrentUserName()) . "'";			

$count = ew_ExecuteScalar("SELECT count(*) FROM emailnotificaciones WHERE recibidopor = '" . ew_AdjustSql(CurrentUserName()) . "' and leido=0");
if ($count == 0)
{
echo "<li class=\"dropdown messages-menu\">\n";
echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">\n";
echo "<i class=\"fa fa-envelope-o\"></i></br>\n";
echo "<span class=\"label label-success\">$count</span>\n";
echo "</a>\n";
echo "<ul class=\"dropdown-menu\">\n";
echo "<li class=\"header\">Tu tienes $count mensaje</li>\n";
echo "</ul>\n";
echo "</li>\n";
}
else{				//<!-- inner menu: contains the actual data -->			
$TheQuery="SELECT * FROM emailnotificaciones WHERE recibidopor = '" . ew_AdjustSql(CurrentUserName()) . "' and leido=0";				
$all_mensaje_result = ew_Execute($TheQuery) or die("error during: ".$TheQuery);
if ($all_mensaje_result && $all_mensaje_result->RecordCount() > 0) {
$all_mensaje_result->MoveFirst();
$sData = "";
echo "<li class=\"dropdown messages-menu\">\n";
echo "<a href=\"#\" class=\"dropdown-toggle\" data-toggle=\"dropdown\">\n";
echo "<i class=\"fa fa-envelope-o\"></i></br>\n";
echo "<span class=\"label label-success\">$count</span>\n";
echo "</a>\n";
echo "<ul class=\"dropdown-menu\">\n";
echo "<li class=\"header\">Tu tienes $count mensaje</li>\n";
echo "<li>\n";
echo "<ul class=\"menu\">\n";
while ($all_mensaje_result && !$all_mensaje_result->EOF) 
{
$idmensaje=$all_mensaje_result->fields[0];
$mensaje=$all_mensaje_result->fields[1];
	$creadopor=$all_mensaje_result->fields[2];
	$recibidopor=$all_mensaje_result->fields[3];
	$name_enviado = ew_ExecuteScalar("SELECT CONCAT(nombre, ', ', apellido) FROM usuario WHERE login = '" . ew_AdjustSql($creadopor) . "'");
	$especialidad_enviado = ew_ExecuteScalar("SELECT especialidad FROM usuario WHERE login = '" . ew_AdjustSql($creadopor) . "'");
	$min_enviado = ew_ExecuteScalar("SELECT TIMESTAMPDIFF(MINUTE,now(),fecha) FROM notificaciones WHERE creadopor = '" . ew_AdjustSql($creadopor) . "' and leido=0");
echo "<li><!-- start message -->\n";
echo "<a href=avaluocore.php?type=emaillearn&id=".$idmensaje.">";
echo "<div class=\"pull-left\">\n";
echo "<img src=\"phpimages/people35.png\" class=\"img-circle\" alt=\"User Image\">\n";
echo "</div>\n";
echo "<h4>\n";
echo "$name_enviado\n";
echo "<small><i class=\"fa fa-clock-o\"></i>$min_enviado</small>\n";
echo "</h4>\n";
//echo "<p>$mensaje</p>\n";
echo "</a>\n";
echo "</li>\n";
$all_mensaje_result->MoveNext();
}

//echo $sData; // display it 
$all_mensaje_result->Close();
echo "<li class=\"footer\"><a href=\"emailnotificacioneslist.php\">Ver todos los mensajes</a></li>\n";
echo "</ul>\n";
echo "</li>\n";
} else {
$this->setFailureMessage("No records found.");
}
echo "</ul>\n";
echo "</li>\n";
}
?>
<li class="dropdown user user-menu">
	 <a href="#" class="dropdown-toggle" data-toggle="dropdown">
			  <img src="phpimages/user2-160x160.jpg" class="user-image" alt="User Image">
			  <span class="hidden-xs">{{:currentUserName}} </span>
	 </a>
	<ul class="dropdown-menu">
	  <li class="user-header">
				<img src="phpimages/user2-160x160.jpg" class="img-circle" alt="User Image">
				<p>
				<?php
				$name = ew_ExecuteScalar("SELECT CONCAT(nombre, ', ', apellido) FROM usuario WHERE login = '" . ew_AdjustSql(CurrentUserName()) . "'");
				$especialidad = ew_ExecuteScalar("SELECT especialidad FROM usuario WHERE login = '" . ew_AdjustSql(CurrentUserName()) . "'");
	 			$fecha = ew_ExecuteScalar("SELECT create_at FROM usuario WHERE login = '" . ew_AdjustSql(CurrentUserName()) . "'");
				echo $name." - ".$especialidad;
				 ?>
				  <small><?php echo $fecha;?></small>
				</p>
			  </li>
		<li class="user-footer">
			{{if canChangePassword}}
			<div class="pull-left">
				<a class="btn btn-default btn-flat" href="{{:changePasswordUrl}}"><small>{{:changePasswordText}}</small></a>
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
</div>
<!-- ./wrapper -->
<?php } ?>
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
<script type="text/html" class="ewJsTemplate" data-name="languages" data-data="languages" data-method="<?php echo $Language->Method ?>" data-target="<?php echo ew_HtmlEncode($Language->Target) ?>">
<?php echo $Language->GetTemplate() ?>
</script>
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
<!-- modal lookup dialog -->
<div id="ewModalLookupDialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"></div></div></div></div>
<!-- add option dialog -->
<div id="ewAddOptDialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton"><?php echo $Language->Phrase("AddBtn") ?></button><button type="button" class="btn btn-default ewButton" data-dismiss="modal"><?php echo $Language->Phrase("CancelBtn") ?></button></div></div></div></div>
<!-- email dialog -->
<div id="ewEmailDialog" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-header"><h4 class="modal-title"></h4></div>
<div class="modal-body">
<?php include_once $EW_RELATIVE_PATH . "ewemail14.php" ?>
</div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton"><?php echo $Language->Phrase("SendEmailBtn") ?></button><button type="button" class="btn btn-default ewButton" data-dismiss="modal"><?php echo $Language->Phrase("CancelBtn") ?></button></div></div></div></div>
<!-- message box -->
<div id="ewMsgBox" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton" data-dismiss="modal"><?php echo $Language->Phrase("MessageOK") ?></button></div></div></div></div>
<!-- prompt -->
<div id="ewPrompt" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton"><?php echo $Language->Phrase("MessageOK") ?></button><button type="button" class="btn btn-default ewButton" data-dismiss="modal"><?php echo $Language->Phrase("CancelBtn") ?></button></div></div></div></div>
<!-- session timer -->
<div id="ewTimer" class="modal" role="dialog" aria-hidden="true"><div class="modal-dialog"><div class="modal-content"><div class="modal-body"></div><div class="modal-footer"><button type="button" class="btn btn-primary ewButton" data-dismiss="modal"><?php echo $Language->Phrase("MessageOK") ?></button></div></div></div></div>
<!-- tooltip -->
<div id="ewTooltip"></div>
<?php } ?>
<?php if (@$gsExport == "") { ?>
<script type="text/javascript">
jQuery.get("<?php echo $EW_RELATIVE_PATH ?>phpjs/userevt14.js");
</script>
    <!--<script src="plugins/jquery/jquery.min.js"></script>
    <!-- Bootstrap -->
    <script src="plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
    <!-- overlayScrollbars -->
    <script src="plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
    <!-- AdminLTE App -->

    <!-- jQuery Mapael -->
    <script src="plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
    <script src="plugins/raphael/raphael.min.js"></script>
    <script src="plugins/jquery-mapael/jquery.mapael.min.js"></script>
    <script src="plugins/jquery-mapael/maps/usa_states.min.js"></script>
    <!-- ChartJS -->
    <script src="plugins/chart.js/Chart.min.js"></script>

    <script type="text/javascript">

// Write your global startup script here
// document.write("page loaded");

</script>
<?php } ?>
</body>
</html>
