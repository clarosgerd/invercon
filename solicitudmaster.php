<?php

// id
// nombre_contacto
// name
// lastname
// email
// address
// phone
// cell
// created_at
// id_sucursal
// tipoinmueble
// tipovehiculo
// tipomaquinaria
// tipomercaderia
// tipoespecial
// email_contacto

?>
<?php if ($solicitud->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_solicitudmaster" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($solicitud->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="col-sm-3"><script id="tpc_solicitud_id" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->id->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->id->CellAttributes() ?>>
<script id="tpx_solicitud_id" class="solicitudmaster" type="text/html">
<span id="el_solicitud_id">
<span<?php echo $solicitud->id->ViewAttributes() ?>>
<?php echo $solicitud->id->ListViewValue() ?></span>
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
<?php if ($solicitud->created_at->Visible) { // created_at ?>
		<tr id="r_created_at">
			<td class="col-sm-3"><script id="tpc_solicitud_created_at" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->created_at->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->created_at->CellAttributes() ?>>
<script id="tpx_solicitud_created_at" class="solicitudmaster" type="text/html">
<span id="el_solicitud_created_at">
<span<?php echo $solicitud->created_at->ViewAttributes() ?>>
<?php echo $solicitud->created_at->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->id_sucursal->Visible) { // id_sucursal ?>
		<tr id="r_id_sucursal">
			<td class="col-sm-3"><script id="tpc_solicitud_id_sucursal" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->id_sucursal->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->id_sucursal->CellAttributes() ?>>
<script id="tpx_solicitud_id_sucursal" class="solicitudmaster" type="text/html">
<span id="el_solicitud_id_sucursal">
<span<?php echo $solicitud->id_sucursal->ViewAttributes() ?>>
<?php echo $solicitud->id_sucursal->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->tipoinmueble->Visible) { // tipoinmueble ?>
		<tr id="r_tipoinmueble">
			<td class="col-sm-3"><script id="tpc_solicitud_tipoinmueble" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->tipoinmueble->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->tipoinmueble->CellAttributes() ?>>
<script id="tpx_solicitud_tipoinmueble" class="solicitudmaster" type="text/html">
<span id="el_solicitud_tipoinmueble">
<span<?php echo $solicitud->tipoinmueble->ViewAttributes() ?>>
<?php echo $solicitud->tipoinmueble->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->tipovehiculo->Visible) { // tipovehiculo ?>
		<tr id="r_tipovehiculo">
			<td class="col-sm-3"><script id="tpc_solicitud_tipovehiculo" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->tipovehiculo->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->tipovehiculo->CellAttributes() ?>>
<script id="tpx_solicitud_tipovehiculo" class="solicitudmaster" type="text/html">
<span id="el_solicitud_tipovehiculo">
<span<?php echo $solicitud->tipovehiculo->ViewAttributes() ?>>
<?php echo $solicitud->tipovehiculo->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($solicitud->tipomaquinaria->Visible) { // tipomaquinaria ?>
		<tr id="r_tipomaquinaria">
			<td class="col-sm-3"><script id="tpc_solicitud_tipomaquinaria" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->tipomaquinaria->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->tipomaquinaria->CellAttributes() ?>>
<script id="tpx_solicitud_tipomaquinaria" class="solicitudmaster" type="text/html">
<span id="el_solicitud_tipomaquinaria">
<span<?php echo $solicitud->tipomaquinaria->ViewAttributes() ?>>
<?php echo $solicitud->tipomaquinaria->ListViewValue() ?></span>
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
<?php if ($solicitud->tipoespecial->Visible) { // tipoespecial ?>
		<tr id="r_tipoespecial">
			<td class="col-sm-3"><script id="tpc_solicitud_tipoespecial" class="solicitudmaster" type="text/html"><span><?php echo $solicitud->tipoespecial->FldCaption() ?></span></script></td>
			<td<?php echo $solicitud->tipoespecial->CellAttributes() ?>>
<script id="tpx_solicitud_tipoespecial" class="solicitudmaster" type="text/html">
<span id="el_solicitud_tipoespecial">
<span<?php echo $solicitud->tipoespecial->ViewAttributes() ?>>
<?php echo $solicitud->tipoespecial->ListViewValue() ?></span>
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
	</tbody>
</table>
</div>
<div id="tpd_solicitudmaster" class="ewCustomTemplate"></div>
<script id="tpm_solicitudmaster" type="text/html">
<div id="ct_solicitud_master"><div class="ewMultiPage">
<div class="nav-tabs-custom" id="solicitud_edit"><!-- multi-page .nav-tabs-custom -->
	<ul class="nav nav-tabs">
		<li class="active"><a href="#tab_solicitud1" data-toggle="tab">DATOS GENERALES</a></li>
		<li><a href="#tab_solicitud2" data-toggle="tab">DATOS INMUEBLE</a></li>
		<li><a href="#tab_solicitud3" data-toggle="tab">DATOS VEHICULO</a></li>
		<li><a href="#tab_solicitud4" data-toggle="tab">DATOS MAQUINARIA</a></li>
		<li><a href="#tab_solicitud5" data-toggle="tab">DATOS MERCADERIA</a></li>
		<li><a href="#tab_solicitud6" data-toggle="tab">DATOS ESPECIAL</a></li>
	</ul>
	<div class="tab-content"><!-- multi-page .nav-tabs-custom .tab-content -->
		<div class="tab-pane active" id="tab_solicitud1"><!-- multi-page .tab-pane -->
<table id="tbl_solicitudedit1" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
	<tr id="r_name">
		<td>
<span id="el_solicitud_name">
{{include tmpl="#tpc_solicitud_name"/}}&nbsp;{{include tmpl="#tpx_solicitud_name"/}}
</span>
</td>
	</tr>
	<tr id="r_lastname">
		<td>
<span id="el_solicitud_lastname">
{{include tmpl="#tpc_solicitud_lastname"/}}&nbsp;{{include tmpl="#tpx_solicitud_lastname"/}}
</span>
</td>
	</tr>
	<tr id="r__email">
		<td>
<span id="el_solicitud__email">
{{include tmpl="#tpc_solicitud__email"/}}&nbsp;{{include tmpl="#tpx_solicitud__email"/}}
</span>
</td>
	</tr>
	<tr id="r_address">
		<td>
<span id="el_solicitud_address">
{{include tmpl="#tpc_solicitud_address"/}}&nbsp;{{include tmpl="#tpx_solicitud_address"/}}
</span>
</td>
	</tr>
	<tr id="r_phone">
		<td>
<span id="el_solicitud_phone">
{{include tmpl="#tpc_solicitud_phone"/}}&nbsp;{{include tmpl="#tpx_solicitud_phone"/}}
</span>
</td>
	</tr>
	<tr id="r_cell">
		<td>
<span id="el_solicitud_cell">
{{include tmpl="#tpc_solicitud_cell"/}}&nbsp;{{include tmpl="#tpx_solicitud_cell"/}}
</span>
</td>
	</tr>
	<tr id="r_id_sucursal">
		<td>
{{include tmpl="#tpc_solicitud_id_sucursal"/}}&nbsp;{{include tmpl="#tpx_solicitud_id_sucursal"/}}
</td>
	</tr>
	<tr id="r_nombre_contacto">
		<td>
<span id="el_solicitud_nombre_contacto">
{{include tmpl="#tpc_solicitud_nombre_contacto"/}}&nbsp;{{include tmpl="#tpx_solicitud_nombre_contacto"/}}
</span>
</td>
	</tr>
	<tr id="r_email_contacto">
		<td>
<span id="el_solicitud_email_contacto">
{{include tmpl="#tpc_solicitud_email_contacto"/}}&nbsp;{{include tmpl="#tpx_solicitud_email_contacto"/}}
</span>
</td>
	</tr>
</table><!-- /table* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane" id="tab_solicitud2"><!-- multi-page .tab-pane -->
<table id="tbl_solicitudedit2" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
	<tr id="r_tipoinmueble">
		<td>{{include tmpl="#tpc_solicitud_tipoinmueble"/}}&nbsp;{{include tmpl="#tpx_solicitud_tipoinmueble"/}}</td>
	</tr>
	<tr id="r_id_ciudad_inmueble">
		<td>{{include tmpl="#tpc_solicitud_id_ciudad_inmueble"/}}&nbsp;{{include tmpl="#tpx_solicitud_id_ciudad_inmueble"/}}</td>
	</tr>
	<tr id="r_id_provincia_inmueble">
	<td>{{include tmpl="#tpc_solicitud_id_provincia_inmueble"/}}&nbsp;{{include tmpl="#tpx_solicitud_id_provincia_inmueble"/}} </td>
	</tr>
	<tr id="r_imagen_inmueble02">
		<td>{{include tmpl="#tpc_solicitud_imagen_inmueble02"/}}&nbsp;{{include tmpl="#tpx_solicitud_imagen_inmueble02"/}} </td>
	</tr>
	<tr id="r_imagen_inmueble03">
		<td>{{include tmpl="#tpc_solicitud_imagen_inmueble03"/}}&nbsp;{{include tmpl="#tpx_solicitud_imagen_inmueble03"/}}</td>
	</tr>
	<tr id="r_imagen_inmueble04">
		<td>{{include tmpl="#tpc_solicitud_imagen_inmueble04"/}}&nbsp;{{include tmpl="#tpx_solicitud_imagen_inmueble04"/}}</td>
	</tr>
	<tr id="r_imagen_inmueble05">
		<td>{{include tmpl="#tpc_solicitud_imagen_inmueble05"/}}&nbsp;{{include tmpl="#tpx_solicitud_imagen_inmueble05"/}}</td>
	</tr>
</table><!-- /table* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane" id="tab_solicitud3"><!-- multi-page .tab-pane -->
<table id="tbl_solicitudedit3" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
	<tr id="r_tipovehiculo">
	<td></td>
	</tr>
	<tr id="r_id_provincia_vehiculo">
	<td></td>
	</tr>
	<tr id="r_imagen_vehiculo02">
	<td></td>
	</tr>
	<tr id="r_imagen_vehiculo03">
	<td></td>
	</tr>
	<tr id="r_imagen_vehiculo05">
	<td></td>
	</tr>
	<tr id="r_imagen_vehiculo06">
	<td></td>
	</tr>
	<tr id="r_imagen_vehiculo07">
	<td></td>
	</tr>
</table><!-- /table* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane" id="tab_solicitud4"><!-- multi-page .tab-pane -->
<table id="tbl_solicitudedit4" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
	<tr id="r_tipomaquinaria">
	<td></td>
	</tr>
	<tr id="r_id_provincia_maquinaria">
	<td></td>
	</tr>
	<tr id="r_imagen_maquinaria02">
	<td>
</td>
	</tr>
	<tr id="r_imagen_maquinaria03">
 <td></td>
	</tr>
	<tr id="r_imagen_maquinaria05">
 <td>
</td>
	</tr>
	<tr id="r_imagen_maquinaria06">
<td>
</td>
	</tr>
	<tr id="r_imagen_maquinaria07">
	<td>
</td>
	</tr>
</table><!-- /table* -->
		</div><!-- /multi-page .tab-pane -->
		<div class="tab-pane" id="tab_solicitud5"><!-- multi-page .tab-pane -->
<table id="tbl_solicitudedit5" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
	<tr id="r_tipomercaderia">
	<td>
</td>
	</tr>
	<tr id="r_documento_mercaderia">
	<td>
</td>
	</tr>
	<tr id="r_imagen_tipoespecial01">
	<td>
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
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($solicitud->Rows) ?> };
ew_ApplyTemplate("tpd_solicitudmaster", "tpm_solicitudmaster", "solicitudmaster", "<?php echo $solicitud->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.solicitudmaster_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
