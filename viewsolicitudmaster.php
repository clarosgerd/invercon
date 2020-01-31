<?php

// name
// cell
// phone
// email
// address
// email_contacto
// lastname
// tipoinmueble
// tipovehiculo
// tipomaquinaria
// tipomercaderia
// tipoespecial

?>
<?php if ($viewsolicitud->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_viewsolicitudmaster" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($viewsolicitud->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_name" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->name->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->name->CellAttributes() ?>>
<script id="tpx_viewsolicitud_name" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_name">
<span<?php echo $viewsolicitud->name->ViewAttributes() ?>>
<?php echo $viewsolicitud->name->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->cell->Visible) { // cell ?>
		<tr id="r_cell">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_cell" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->cell->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->cell->CellAttributes() ?>>
<script id="tpx_viewsolicitud_cell" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_cell">
<span<?php echo $viewsolicitud->cell->ViewAttributes() ?>>
<?php echo $viewsolicitud->cell->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->phone->Visible) { // phone ?>
		<tr id="r_phone">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_phone" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->phone->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->phone->CellAttributes() ?>>
<script id="tpx_viewsolicitud_phone" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_phone">
<span<?php echo $viewsolicitud->phone->ViewAttributes() ?>>
<?php echo $viewsolicitud->phone->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->_email->Visible) { // email ?>
		<tr id="r__email">
			<td class="col-sm-3"><script id="tpc_viewsolicitud__email" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->_email->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->_email->CellAttributes() ?>>
<script id="tpx_viewsolicitud__email" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud__email">
<span<?php echo $viewsolicitud->_email->ViewAttributes() ?>>
<?php echo $viewsolicitud->_email->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->address->Visible) { // address ?>
		<tr id="r_address">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_address" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->address->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->address->CellAttributes() ?>>
<script id="tpx_viewsolicitud_address" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_address">
<span<?php echo $viewsolicitud->address->ViewAttributes() ?>>
<?php echo $viewsolicitud->address->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->email_contacto->Visible) { // email_contacto ?>
		<tr id="r_email_contacto">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_email_contacto" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->email_contacto->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->email_contacto->CellAttributes() ?>>
<script id="tpx_viewsolicitud_email_contacto" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_email_contacto">
<span<?php echo $viewsolicitud->email_contacto->ViewAttributes() ?>>
<?php echo $viewsolicitud->email_contacto->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->lastname->Visible) { // lastname ?>
		<tr id="r_lastname">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_lastname" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->lastname->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->lastname->CellAttributes() ?>>
<script id="tpx_viewsolicitud_lastname" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_lastname">
<span<?php echo $viewsolicitud->lastname->ViewAttributes() ?>>
<?php echo $viewsolicitud->lastname->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->tipoinmueble->Visible) { // tipoinmueble ?>
		<tr id="r_tipoinmueble">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_tipoinmueble" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->tipoinmueble->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->tipoinmueble->CellAttributes() ?>>
<script id="tpx_viewsolicitud_tipoinmueble" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_tipoinmueble">
<span<?php echo $viewsolicitud->tipoinmueble->ViewAttributes() ?>>
<?php echo $viewsolicitud->tipoinmueble->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->tipovehiculo->Visible) { // tipovehiculo ?>
		<tr id="r_tipovehiculo">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_tipovehiculo" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->tipovehiculo->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->tipovehiculo->CellAttributes() ?>>
<script id="tpx_viewsolicitud_tipovehiculo" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_tipovehiculo">
<span<?php echo $viewsolicitud->tipovehiculo->ViewAttributes() ?>>
<?php echo $viewsolicitud->tipovehiculo->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->tipomaquinaria->Visible) { // tipomaquinaria ?>
		<tr id="r_tipomaquinaria">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_tipomaquinaria" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->tipomaquinaria->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->tipomaquinaria->CellAttributes() ?>>
<script id="tpx_viewsolicitud_tipomaquinaria" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_tipomaquinaria">
<span<?php echo $viewsolicitud->tipomaquinaria->ViewAttributes() ?>>
<?php echo $viewsolicitud->tipomaquinaria->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->tipomercaderia->Visible) { // tipomercaderia ?>
		<tr id="r_tipomercaderia">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_tipomercaderia" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->tipomercaderia->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->tipomercaderia->CellAttributes() ?>>
<script id="tpx_viewsolicitud_tipomercaderia" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_tipomercaderia">
<span<?php echo $viewsolicitud->tipomercaderia->ViewAttributes() ?>>
<?php echo $viewsolicitud->tipomercaderia->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->tipoespecial->Visible) { // tipoespecial ?>
		<tr id="r_tipoespecial">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_tipoespecial" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->tipoespecial->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->tipoespecial->CellAttributes() ?>>
<script id="tpx_viewsolicitud_tipoespecial" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_tipoespecial">
<span<?php echo $viewsolicitud->tipoespecial->ViewAttributes() ?>>
<?php echo $viewsolicitud->tipoespecial->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_viewsolicitudmaster" class="ewCustomTemplate"></div>
<script id="tpm_viewsolicitudmaster" type="text/html">
<div id="ct_viewsolicitud_master"><div class="ewMultiPage">
<div class="nav-tabs-custom" id="solicitud_edit"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab_solicitud1" data-toggle="tab">DATOS GENERALES</a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane active" id="tab_solicitud1"><!-- multi-page .tab-pane -->
<table id="tbl_solicitudedit1" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
	<tr id="r_name">
		<td>
<span id="el_solicitud_name">
{{include tmpl="#tpc_viewsolicitud_name"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_name"/}}
</span>
</td>
	</tr>
	<tr id="r_lastname">
		<td>
<span id="el_solicitud_lastname">
{{include tmpl="#tpc_viewsolicitud_lastname"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_lastname"/}}
</span>
</td>
	</tr>
	<tr id="r__email">
		<td>
<span id="el_solicitud__email">
{{include tmpl="#tpc_viewsolicitud__email"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud__email"/}}
</span>
</td>
	</tr>
	<tr id="r_address">
		<td>
<span id="el_solicitud_address">
{{include tmpl="#tpc_viewsolicitud_address"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_address"/}}
</span>
</td>
	</tr>
	<tr id="r_phone">
		<td>
<span id="el_solicitud_phone">
{{include tmpl="#tpc_viewsolicitud_phone"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_phone"/}}
</span>
</td>
	</tr>
	<tr id="r_cell">
		<td>
<span id="el_solicitud_cell">
{{include tmpl="#tpc_viewsolicitud_cell"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_cell"/}}
</span>
</td>
	</tr>
	<tr id="r_id_sucursal">
		<td>
{{include tmpl="#tpc_viewsolicitud_id_sucursal"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_id_sucursal"/}}
</td>
	</tr>
	<tr id="r_nombre_contacto">
		<td>
<span id="el_solicitud_nombre_contacto">
{{include tmpl="#tpc_viewsolicitud_nombre_contacto"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_nombre_contacto"/}}
</span>
</td>
	</tr>
	<tr id="r_email_contacto">
		<td>
<span id="el_solicitud_email_contacto">
{{include tmpl="#tpc_viewsolicitud_email_contacto"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_email_contacto"/}}
</span>
</td>
	</tr>
</table><!-- /table* -->
		</div><!-- /multi-page .tab-pane -->
	</div><!-- /multi-page .nav-tabs-custom .tab-content -->
</div><!-- /multi-page .nav-tabs-custom -->
</div><!-- /multi-page -->
</div>
</script>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($viewsolicitud->Rows) ?> };
ew_ApplyTemplate("tpd_viewsolicitudmaster", "tpm_viewsolicitudmaster", "viewsolicitudmaster", "<?php echo $viewsolicitud->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.viewsolicitudmaster_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
