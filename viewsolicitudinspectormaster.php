<?php

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
<?php if ($viewsolicitudinspector->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_viewsolicitudinspectormaster" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($viewsolicitudinspector->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector_name" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->name->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->name->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector_name" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector_name">
<span<?php echo $viewsolicitudinspector->name->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->name->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudinspector->lastname->Visible) { // lastname ?>
		<tr id="r_lastname">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector_lastname" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->lastname->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->lastname->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector_lastname" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector_lastname">
<span<?php echo $viewsolicitudinspector->lastname->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->lastname->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudinspector->_email->Visible) { // email ?>
		<tr id="r__email">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector__email" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->_email->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->_email->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector__email" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector__email">
<span<?php echo $viewsolicitudinspector->_email->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->_email->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudinspector->address->Visible) { // address ?>
		<tr id="r_address">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector_address" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->address->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->address->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector_address" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector_address">
<span<?php echo $viewsolicitudinspector->address->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->address->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudinspector->nombre_contacto->Visible) { // nombre_contacto ?>
		<tr id="r_nombre_contacto">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector_nombre_contacto" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->nombre_contacto->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->nombre_contacto->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector_nombre_contacto" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector_nombre_contacto">
<span<?php echo $viewsolicitudinspector->nombre_contacto->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->nombre_contacto->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudinspector->email_contacto->Visible) { // email_contacto ?>
		<tr id="r_email_contacto">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector_email_contacto" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->email_contacto->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->email_contacto->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector_email_contacto" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector_email_contacto">
<span<?php echo $viewsolicitudinspector->email_contacto->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->email_contacto->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudinspector->phone->Visible) { // phone ?>
		<tr id="r_phone">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector_phone" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->phone->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->phone->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector_phone" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector_phone">
<span<?php echo $viewsolicitudinspector->phone->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->phone->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudinspector->cell->Visible) { // cell ?>
		<tr id="r_cell">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector_cell" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->cell->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->cell->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector_cell" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector_cell">
<span<?php echo $viewsolicitudinspector->cell->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->cell->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudinspector->tipoinmueble->Visible) { // tipoinmueble ?>
		<tr id="r_tipoinmueble">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector_tipoinmueble" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->tipoinmueble->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->tipoinmueble->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector_tipoinmueble" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector_tipoinmueble">
<span<?php echo $viewsolicitudinspector->tipoinmueble->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->tipoinmueble->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudinspector->tipovehiculo->Visible) { // tipovehiculo ?>
		<tr id="r_tipovehiculo">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector_tipovehiculo" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->tipovehiculo->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->tipovehiculo->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector_tipovehiculo" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector_tipovehiculo">
<span<?php echo $viewsolicitudinspector->tipovehiculo->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->tipovehiculo->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudinspector->tipomaquinaria->Visible) { // tipomaquinaria ?>
		<tr id="r_tipomaquinaria">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector_tipomaquinaria" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->tipomaquinaria->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->tipomaquinaria->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector_tipomaquinaria" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector_tipomaquinaria">
<span<?php echo $viewsolicitudinspector->tipomaquinaria->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->tipomaquinaria->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudinspector->tipomercaderia->Visible) { // tipomercaderia ?>
		<tr id="r_tipomercaderia">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector_tipomercaderia" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->tipomercaderia->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->tipomercaderia->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector_tipomercaderia" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector_tipomercaderia">
<span<?php echo $viewsolicitudinspector->tipomercaderia->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->tipomercaderia->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudinspector->tipoespecial->Visible) { // tipoespecial ?>
		<tr id="r_tipoespecial">
			<td class="col-sm-3"><script id="tpc_viewsolicitudinspector_tipoespecial" class="viewsolicitudinspectormaster" type="text/html"><span><?php echo $viewsolicitudinspector->tipoespecial->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitudinspector->tipoespecial->CellAttributes() ?>>
<script id="tpx_viewsolicitudinspector_tipoespecial" class="viewsolicitudinspectormaster" type="text/html">
<span id="el_viewsolicitudinspector_tipoespecial">
<span<?php echo $viewsolicitudinspector->tipoespecial->ViewAttributes() ?>>
<?php echo $viewsolicitudinspector->tipoespecial->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_viewsolicitudinspectormaster" class="ewCustomTemplate"></div>
<script id="tpm_viewsolicitudinspectormaster" type="text/html">
<div id="ct_viewsolicitudinspector_master"><div class="ewMultiPage">
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
{{include tmpl="#tpc_viewsolicitudinspector_name"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudinspector_name"/}}
</span>
</td>
	</tr>
	<tr id="r_lastname">
		<td>
<span id="el_solicitud_lastname">
{{include tmpl="#tpc_viewsolicitudinspector_lastname"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudinspector_lastname"/}}
</span>
</td>
	</tr>
	<tr id="r__email">
		<td>
<span id="el_solicitud__email">
{{include tmpl="#tpc_viewsolicitudinspector__email"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudinspector__email"/}}
</span>
</td>
	</tr>
	<tr id="r_address">
		<td>
<span id="el_solicitud_address">
{{include tmpl="#tpc_viewsolicitudinspector_address"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudinspector_address"/}}
</span>
</td>
	</tr>
	<tr id="r_phone">
		<td>
<span id="el_solicitud_phone">
{{include tmpl="#tpc_viewsolicitudinspector_phone"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudinspector_phone"/}}
</span>
</td>
	</tr>
	<tr id="r_cell">
		<td>
<span id="el_solicitud_cell">
{{include tmpl="#tpc_viewsolicitudinspector_cell"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudinspector_cell"/}}
</span>
</td>
	</tr>
	<tr id="r_nombre_contacto">
		<td>
<span id="el_solicitud_nombre_contacto">
{{include tmpl="#tpc_viewsolicitudinspector_nombre_contacto"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudinspector_nombre_contacto"/}}
</span>
</td>
	</tr>
	<tr id="r_email_contacto">
		<td>
<span id="el_solicitud_email_contacto">
{{include tmpl="#tpc_viewsolicitudinspector_email_contacto"/}}&nbsp;{{include tmpl="#tpx_viewsolicitudinspector_email_contacto"/}}
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
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($viewsolicitudinspector->Rows) ?> };
ew_ApplyTemplate("tpd_viewsolicitudinspectormaster", "tpm_viewsolicitudinspectormaster", "viewsolicitudinspectormaster", "<?php echo $viewsolicitudinspector->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.viewsolicitudinspectormaster_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
