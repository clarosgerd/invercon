<?php

// id
// name
// lastname
// email
// address
// nombre_contacto
// email_contacto
// phone
// cell
// tipoinmueble
// tipovehiculo
// tipomaquinaria
// tipomercaderia
// tipoespecial

?>
<?php if ($viewsolicitudsupervisor->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_viewsolicitudsupervisormaster" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($viewsolicitudsupervisor->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_id" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->id->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->id->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_id" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_id">
<span<?php echo $viewsolicitudsupervisor->id->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->id->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_name" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->name->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->name->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_name" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_name">
<span<?php echo $viewsolicitudsupervisor->name->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->name->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->lastname->Visible) { // lastname ?>
		<tr id="r_lastname">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_lastname" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->lastname->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->lastname->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_lastname" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_lastname">
<span<?php echo $viewsolicitudsupervisor->lastname->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->lastname->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->_email->Visible) { // email ?>
		<tr id="r__email">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor__email" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->_email->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->_email->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor__email" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor__email">
<span<?php echo $viewsolicitudsupervisor->_email->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->_email->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->address->Visible) { // address ?>
		<tr id="r_address">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_address" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->address->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->address->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_address" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_address">
<span<?php echo $viewsolicitudsupervisor->address->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->address->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->nombre_contacto->Visible) { // nombre_contacto ?>
		<tr id="r_nombre_contacto">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_nombre_contacto" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->nombre_contacto->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->nombre_contacto->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_nombre_contacto" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_nombre_contacto">
<span<?php echo $viewsolicitudsupervisor->nombre_contacto->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->nombre_contacto->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->email_contacto->Visible) { // email_contacto ?>
		<tr id="r_email_contacto">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_email_contacto" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->email_contacto->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->email_contacto->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_email_contacto" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_email_contacto">
<span<?php echo $viewsolicitudsupervisor->email_contacto->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->email_contacto->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->phone->Visible) { // phone ?>
		<tr id="r_phone">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_phone" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->phone->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->phone->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_phone" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_phone">
<span<?php echo $viewsolicitudsupervisor->phone->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->phone->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->cell->Visible) { // cell ?>
		<tr id="r_cell">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_cell" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->cell->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->cell->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_cell" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_cell">
<span<?php echo $viewsolicitudsupervisor->cell->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->cell->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipoinmueble->Visible) { // tipoinmueble ?>
		<tr id="r_tipoinmueble">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_tipoinmueble" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->tipoinmueble->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->tipoinmueble->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_tipoinmueble" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_tipoinmueble">
<span<?php echo $viewsolicitudsupervisor->tipoinmueble->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->tipoinmueble->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipovehiculo->Visible) { // tipovehiculo ?>
		<tr id="r_tipovehiculo">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_tipovehiculo" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->tipovehiculo->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->tipovehiculo->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_tipovehiculo" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_tipovehiculo">
<span<?php echo $viewsolicitudsupervisor->tipovehiculo->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->tipovehiculo->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipomaquinaria->Visible) { // tipomaquinaria ?>
		<tr id="r_tipomaquinaria">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_tipomaquinaria" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->tipomaquinaria->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->tipomaquinaria->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_tipomaquinaria" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_tipomaquinaria">
<span<?php echo $viewsolicitudsupervisor->tipomaquinaria->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->tipomaquinaria->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipomercaderia->Visible) { // tipomercaderia ?>
		<tr id="r_tipomercaderia">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_tipomercaderia" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->tipomercaderia->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->tipomercaderia->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_tipomercaderia" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_tipomercaderia">
<span<?php echo $viewsolicitudsupervisor->tipomercaderia->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->tipomercaderia->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipoespecial->Visible) { // tipoespecial ?>
		<tr id="r_tipoespecial">
			<td class="col-sm-3"><script id="tpc_viewsolicitudsupervisor_tipoespecial" class="viewsolicitudsupervisormaster" type="text/html"><span><?php echo $viewsolicitudsupervisor->tipoespecial->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudsupervisor->tipoespecial->CellAttributes() ?>>
<script id="tpx_viewsolicitudsupervisor_tipoespecial" class="viewsolicitudsupervisormaster" type="text/html">
<span id="el_viewsolicitudsupervisor_tipoespecial">
<span<?php echo $viewsolicitudsupervisor->tipoespecial->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->tipoespecial->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_viewsolicitudsupervisormaster" class="ewCustomTemplate"></div>
<script id="tpm_viewsolicitudsupervisormaster" type="text/html">
<div id="ct_viewsolicitudsupervisor_master"><div class="ewMultiPage">
<div class="nav-tabs-custom" id="solicitud_edit"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab_solicitud1" data-toggle="tab">DATOS GENERALES</a></li>
		<li><a href="#tab_solicitud2" data-toggle="tab">Disponibilidad</a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane active" id="tab_solicitud1"><!-- multi-page .tab-pane -->
<table id="tbl_solicitudedit1" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
	<tr id="r_name">
		<td>
<span id="el_solicitud_name">
{{include tmpl="#tpc_viewsolicitudsupervisor_name"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudsupervisor_name"/}}
</span>
</td>
	</tr>
	<tr id="r_lastname">
		<td>
<span id="el_solicitud_lastname">
{{include tmpl="#tpc_viewsolicitudsupervisor_lastname"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudsupervisor_lastname"/}}
</span>
</td>
	</tr>
	<tr id="r__email">
		<td>
<span id="el_solicitud__email">
{{include tmpl="#tpc_viewsolicitudsupervisor__email"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudsupervisor__email"/}}
</span>
</td>
	</tr>
	<tr id="r_address">
		<td>
<span id="el_solicitud_address">
{{include tmpl="#tpc_viewsolicitudsupervisor_address"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudsupervisor_address"/}}
</span>
</td>
	</tr>
	<tr id="r_phone">
		<td>
<span id="el_solicitud_phone">
{{include tmpl="#tpc_viewsolicitudsupervisor_phone"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudsupervisor_phone"/}}
</span>
</td>
	</tr>
	<tr id="r_cell">
		<td>
<span id="el_solicitud_cell">
{{include tmpl="#tpc_viewsolicitudsupervisor_cell"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudsupervisor_cell"/}}
</span>
</td>
	</tr>
	<tr id="r_nombre_contacto">
		<td>
<span id="el_solicitud_nombre_contacto">
{{include tmpl="#tpc_viewsolicitudsupervisor_nombre_contacto"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudsupervisor_nombre_contacto"/}}
</span>
</td>
	</tr>
	<tr id="r_email_contacto">
		<td>
<span id="el_solicitud_email_contacto">
{{include tmpl="#tpc_viewsolicitudsupervisor_email_contacto"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudsupervisor_email_contacto"/}}
</span>
</td>
	</tr>
</table><!-- /table* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane" id="tab_solicitud2"><!-- multi-page .tab-pane -->
<iframe src="reservacionesviewsecretaria.php" height="500" width="100%" style="border:none;" scrolling="yes"></iframe>
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
</div>
</script>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($viewsolicitudsupervisor->Rows) ?> };
ew_ApplyTemplate("tpd_viewsolicitudsupervisormaster", "tpm_viewsolicitudsupervisormaster", "viewsolicitudsupervisormaster", "<?php echo $viewsolicitudsupervisor->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.viewsolicitudsupervisormaster_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
