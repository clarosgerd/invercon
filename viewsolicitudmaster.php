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
// id_sucursal
// id_ciudad_inmueble
// id_provincia_inmueble
// tipovehiculo
// id_ciudad_vehiculo
// id_provincia_vehiculo
// tipomaquinaria
// id_ciudad_maquinaria
// id_provincia_maquinaria
// tipomercaderia
// documento_mercaderia
// tipoespecial
// documentos

?>
<?php if ($viewsolicitud->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_viewsolicitudmaster" class="table ewViewTable ewMasterTable ewVertical hidden">
	<tbody>
<?php if ($viewsolicitud->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_id" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->id->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->id->CellAttributes() ?>>
<script id="tpx_viewsolicitud_id" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_id">
<span<?php echo $viewsolicitud->id->ViewAttributes() ?>>
<?php echo $viewsolicitud->id->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
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
<?php if ($viewsolicitud->nombre_contacto->Visible) { // nombre_contacto ?>
		<tr id="r_nombre_contacto">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_nombre_contacto" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->nombre_contacto->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->nombre_contacto->CellAttributes() ?>>
<script id="tpx_viewsolicitud_nombre_contacto" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_nombre_contacto">
<span<?php echo $viewsolicitud->nombre_contacto->ViewAttributes() ?>>
<?php echo $viewsolicitud->nombre_contacto->ListViewValue() ?></span>
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
<?php if ($viewsolicitud->id_sucursal->Visible) { // id_sucursal ?>
		<tr id="r_id_sucursal">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_id_sucursal" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->id_sucursal->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->id_sucursal->CellAttributes() ?>>
<script id="tpx_viewsolicitud_id_sucursal" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_id_sucursal">
<span<?php echo $viewsolicitud->id_sucursal->ViewAttributes() ?>>
<?php echo $viewsolicitud->id_sucursal->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->id_ciudad_inmueble->Visible) { // id_ciudad_inmueble ?>
		<tr id="r_id_ciudad_inmueble">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_id_ciudad_inmueble" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->id_ciudad_inmueble->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->id_ciudad_inmueble->CellAttributes() ?>>
<script id="tpx_viewsolicitud_id_ciudad_inmueble" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_id_ciudad_inmueble">
<span<?php echo $viewsolicitud->id_ciudad_inmueble->ViewAttributes() ?>>
<?php echo $viewsolicitud->id_ciudad_inmueble->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->id_provincia_inmueble->Visible) { // id_provincia_inmueble ?>
		<tr id="r_id_provincia_inmueble">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_id_provincia_inmueble" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->id_provincia_inmueble->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->id_provincia_inmueble->CellAttributes() ?>>
<script id="tpx_viewsolicitud_id_provincia_inmueble" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_id_provincia_inmueble">
<span<?php echo $viewsolicitud->id_provincia_inmueble->ViewAttributes() ?>>
<?php echo $viewsolicitud->id_provincia_inmueble->ListViewValue() ?></span>
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
<?php if ($viewsolicitud->id_ciudad_vehiculo->Visible) { // id_ciudad_vehiculo ?>
		<tr id="r_id_ciudad_vehiculo">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_id_ciudad_vehiculo" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->id_ciudad_vehiculo->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->id_ciudad_vehiculo->CellAttributes() ?>>
<script id="tpx_viewsolicitud_id_ciudad_vehiculo" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_id_ciudad_vehiculo">
<span<?php echo $viewsolicitud->id_ciudad_vehiculo->ViewAttributes() ?>>
<?php echo $viewsolicitud->id_ciudad_vehiculo->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->id_provincia_vehiculo->Visible) { // id_provincia_vehiculo ?>
		<tr id="r_id_provincia_vehiculo">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_id_provincia_vehiculo" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->id_provincia_vehiculo->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->id_provincia_vehiculo->CellAttributes() ?>>
<script id="tpx_viewsolicitud_id_provincia_vehiculo" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_id_provincia_vehiculo">
<span<?php echo $viewsolicitud->id_provincia_vehiculo->ViewAttributes() ?>>
<?php echo $viewsolicitud->id_provincia_vehiculo->ListViewValue() ?></span>
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
<?php if ($viewsolicitud->id_ciudad_maquinaria->Visible) { // id_ciudad_maquinaria ?>
		<tr id="r_id_ciudad_maquinaria">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_id_ciudad_maquinaria" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->id_ciudad_maquinaria->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->id_ciudad_maquinaria->CellAttributes() ?>>
<script id="tpx_viewsolicitud_id_ciudad_maquinaria" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_id_ciudad_maquinaria">
<span<?php echo $viewsolicitud->id_ciudad_maquinaria->ViewAttributes() ?>>
<?php echo $viewsolicitud->id_ciudad_maquinaria->ListViewValue() ?></span>
</span>
</script>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitud->id_provincia_maquinaria->Visible) { // id_provincia_maquinaria ?>
		<tr id="r_id_provincia_maquinaria">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_id_provincia_maquinaria" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->id_provincia_maquinaria->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->id_provincia_maquinaria->CellAttributes() ?>>
<script id="tpx_viewsolicitud_id_provincia_maquinaria" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_id_provincia_maquinaria">
<span<?php echo $viewsolicitud->id_provincia_maquinaria->ViewAttributes() ?>>
<?php echo $viewsolicitud->id_provincia_maquinaria->ListViewValue() ?></span>
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
<?php if ($viewsolicitud->documento_mercaderia->Visible) { // documento_mercaderia ?>
		<tr id="r_documento_mercaderia">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_documento_mercaderia" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->documento_mercaderia->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->documento_mercaderia->CellAttributes() ?>>
<script id="tpx_viewsolicitud_documento_mercaderia" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_documento_mercaderia">
<span<?php echo $viewsolicitud->documento_mercaderia->ViewAttributes() ?>>
<?php echo $viewsolicitud->documento_mercaderia->ListViewValue() ?></span>
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
<?php if ($viewsolicitud->documentos->Visible) { // documentos ?>
		<tr id="r_documentos">
			<td class="col-sm-3"><script id="tpc_viewsolicitud_documentos" class="viewsolicitudmaster" type="text/html"><span><?php echo $viewsolicitud->documentos->FldCaption() ?></span></script></td>
			<td<?php echo $viewsolicitud->documentos->CellAttributes() ?>>
<script id="tpx_viewsolicitud_documentos" class="viewsolicitudmaster" type="text/html">
<span id="el_viewsolicitud_documentos">
<span<?php echo $viewsolicitud->documentos->ViewAttributes() ?>>
<?php echo $viewsolicitud->documentos->ListViewValue() ?></span>
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
		<div class="tab-pane" id="tab_solicitud2"><!-- multi-page .tab-pane -->
<table id="tbl_solicitudedit2" class="table table-striped table-bordered table-hover table-condensed ewDesktopTable"><!-- table* -->
	<tr id="r_tipoinmueble">
		<td>{{include tmpl="#tpc_viewsolicitud_tipoinmueble"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_tipoinmueble"/}}</td>
	</tr>
	<tr id="r_id_ciudad_inmueble">
		<td>{{include tmpl="#tpc_viewsolicitud_id_ciudad_inmueble"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_id_ciudad_inmueble"/}}</td>
	</tr>
	<tr id="r_id_provincia_inmueble">
	<td>{{include tmpl="#tpc_viewsolicitud_id_provincia_inmueble"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_id_provincia_inmueble"/}} </td>
	</tr>
	<tr id="r_imagen_inmueble02">
		<td>{{include tmpl="#tpc_viewsolicitud_imagen_inmueble02"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_imagen_inmueble02"/}} </td>
	</tr>
	<tr id="r_imagen_inmueble03">
		<td>{{include tmpl="#tpc_viewsolicitud_imagen_inmueble03"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_imagen_inmueble03"/}}</td>
	</tr>
	<tr id="r_imagen_inmueble04">
		<td>{{include tmpl="#tpc_viewsolicitud_imagen_inmueble04"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_imagen_inmueble04"/}}</td>
	</tr>
	<tr id="r_imagen_inmueble05">
		<td>{{include tmpl="#tpc_viewsolicitud_imagen_inmueble05"/}}&nbsp;{{include tmpl="#tpx_viewsolicitud_imagen_inmueble05"/}}</td>
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
ewVar.templateData = { rows: <?php echo ew_ArrayToJson($viewsolicitud->Rows) ?> };
ew_ApplyTemplate("tpd_viewsolicitudmaster", "tpm_viewsolicitudmaster", "viewsolicitudmaster", "<?php echo $viewsolicitud->CustomExport ?>", ewVar.templateData.rows[0]);
jQuery("script.viewsolicitudmaster_js").each(function(){ew_AddScript(this.text);});
</script>
<?php } ?>
