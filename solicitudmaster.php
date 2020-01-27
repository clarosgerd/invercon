<?php

// name
// email
// address
// phone
// cell
// tipomercaderia
// email_contacto
// nombre_contacto
// lastname
// monto_inicial

?>
<?php if ($solicitud->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_solicitudmaster" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($solicitud->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="col-sm-3"><script id="tpc_solicitud_name" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->name->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->name->CellAttributes() ?>>
<script id="tpx_solicitud_name" class="solicitudmaster" type="text/html">
<span id="el_solicitud_name">
<span<?php echo $solicitud->name->ViewAttributes() ?>>
<?php echo $solicitud->name->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->_email->Visible) { // email ?>
		<tr id="r__email">
			<td class="col-sm-3"><script id="tpc_solicitud__email" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->_email->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->_email->CellAttributes() ?>>
<script id="tpx_solicitud__email" class="solicitudmaster" type="text/html">
<span id="el_solicitud__email">
<span<?php echo $solicitud->_email->ViewAttributes() ?>>
<?php echo $solicitud->_email->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->address->Visible) { // address ?>
		<tr id="r_address">
			<td class="col-sm-3"><script id="tpc_solicitud_address" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->address->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->address->CellAttributes() ?>>
<script id="tpx_solicitud_address" class="solicitudmaster" type="text/html">
<span id="el_solicitud_address">
<span<?php echo $solicitud->address->ViewAttributes() ?>>
<?php echo $solicitud->address->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->phone->Visible) { // phone ?>
		<tr id="r_phone">
			<td class="col-sm-3"><script id="tpc_solicitud_phone" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->phone->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->phone->CellAttributes() ?>>
<script id="tpx_solicitud_phone" class="solicitudmaster" type="text/html">
<span id="el_solicitud_phone">
<span<?php echo $solicitud->phone->ViewAttributes() ?>>
<?php echo $solicitud->phone->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->cell->Visible) { // cell ?>
		<tr id="r_cell">
			<td class="col-sm-3"><script id="tpc_solicitud_cell" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->cell->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->cell->CellAttributes() ?>>
<script id="tpx_solicitud_cell" class="solicitudmaster" type="text/html">
<span id="el_solicitud_cell">
<span<?php echo $solicitud->cell->ViewAttributes() ?>>
<?php echo $solicitud->cell->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->tipomercaderia->Visible) { // tipomercaderia ?>
		<tr id="r_tipomercaderia">
			<td class="col-sm-3"><script id="tpc_solicitud_tipomercaderia" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->tipomercaderia->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->tipomercaderia->CellAttributes() ?>>
<script id="tpx_solicitud_tipomercaderia" class="solicitudmaster" type="text/html">
<span id="el_solicitud_tipomercaderia">
<span<?php echo $solicitud->tipomercaderia->ViewAttributes() ?>>
<?php echo $solicitud->tipomercaderia->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->email_contacto->Visible) { // email_contacto ?>
		<tr id="r_email_contacto">
			<td class="col-sm-3"><script id="tpc_solicitud_email_contacto" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->email_contacto->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->email_contacto->CellAttributes() ?>>
<script id="tpx_solicitud_email_contacto" class="solicitudmaster" type="text/html">
<span id="el_solicitud_email_contacto">
<span<?php echo $solicitud->email_contacto->ViewAttributes() ?>>
<?php echo $solicitud->email_contacto->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->nombre_contacto->Visible) { // nombre_contacto ?>
		<tr id="r_nombre_contacto">
			<td class="col-sm-3"><script id="tpc_solicitud_nombre_contacto" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->nombre_contacto->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->nombre_contacto->CellAttributes() ?>>
<script id="tpx_solicitud_nombre_contacto" class="solicitudmaster" type="text/html">
<span id="el_solicitud_nombre_contacto">
<span<?php echo $solicitud->nombre_contacto->ViewAttributes() ?>>
<?php echo $solicitud->nombre_contacto->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->lastname->Visible) { // lastname ?>
		<tr id="r_lastname">
			<td class="col-sm-3"><script id="tpc_solicitud_lastname" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->lastname->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->lastname->CellAttributes() ?>>
<script id="tpx_solicitud_lastname" class="solicitudmaster" type="text/html">
<span id="el_solicitud_lastname">
<span<?php echo $solicitud->lastname->ViewAttributes() ?>>
<?php echo $solicitud->lastname->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->monto_inicial->Visible) { // monto_inicial ?>
		<tr id="r_monto_inicial">
			<td class="col-sm-3"><script id="tpc_solicitud_monto_inicial" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->monto_inicial->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->monto_inicial->CellAttributes() ?>>
<script id="tpx_solicitud_monto_inicial" class="solicitudmaster" type="text/html">
<span id="el_solicitud_monto_inicial">
<span<?php echo $solicitud->monto_inicial->ViewAttributes() ?>>
<?php echo $solicitud->monto_inicial->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<div id="tpd_solicitudmaster" class="ewCustomTemplate"></div>
<script id="tpm_solicitudmaster" type="text/html">
<div id="ct_solicitud_master"><div class="container">
<div class = "row">
<div class = "col-sm-12"><!-- multi-page .nav-tabs-custom -->
<iframe src="reservacionesviewsecretaria.php" height="300" width="100%" style="border:none;" scrolling="yes"></iframe>
</div>
<div class = "col-sm-6"><!-- multi-page .tab-pane -->
<table id="tbl_solicitudedit1" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
	<tr id="r_name">
		<td>
<span id="el_solicitud_name">
{{include tmpl="#tpc_solicitud_name"/}}&nbsp;{{include tmpl="#tpx_solicitud_name"/}}
</span>
</td>
		<td>
<span id="el_solicitud_lastname">
{{include tmpl="#tpc_solicitud_lastname"/}}&nbsp;{{include tmpl="#tpx_solicitud_lastname"/}}
</span>
</td>
<td>
<span id="el_solicitud__email">
{{include tmpl="#tpc_solicitud__email"/}}&nbsp;{{include tmpl="#tpx_solicitud__email"/}}
</span>
</td>
	<td>
<span id="el_solicitud_nombre_contacto">
{{include tmpl="#tpc_solicitud_nombre_contacto"/}}&nbsp;{{include tmpl="#tpx_solicitud_nombre_contacto"/}}
</span>
</td>
<td>
<span id="el_solicitud_address">
{{include tmpl="#tpc_solicitud_address"/}}&nbsp;{{include tmpl="#tpx_solicitud_address"/}}
</span>
</td>
<td>
<span id="el_solicitud_phone">
{{include tmpl="#tpc_solicitud_phone"/}}&nbsp;{{include tmpl="#tpx_solicitud_phone"/}}
</span>
</td>
<td>
<span id="el_solicitud_cell">
{{include tmpl="#tpc_solicitud_cell"/}}&nbsp;{{include tmpl="#tpx_solicitud_cell"/}}
</span>
</td>
<td>
<span id="el_solicitud_email_contacto">
{{include tmpl="#tpc_solicitud_email_contacto"/}}&nbsp;{{include tmpl="#tpx_solicitud_email_contacto"/}}
</span>
</td>
</tr>
</table>
</div>
</div>
</div>
</div>
</script>
<script type="text/javascript">
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($solicitud->Rows) ?> };
ew_ApplyTemplate("tpd_solicitudmaster", "tpm_solicitudmaster", "solicitudmaster", "<?php echo $solicitud->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.solicitudmaster_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
