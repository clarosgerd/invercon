<?php

// codigoavaluo
// tipoinmueble
// id_solicitud
// id_oficialcredito
// id_inspector
// estado
// estadopago
// fecha_avaluo
// informe

?>
<?php if ($viewavaluo->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_viewavaluomaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($viewavaluo->codigoavaluo->Visible) { // codigoavaluo ?>
		<tr id="r_codigoavaluo">
			<td class="col-sm-3"><?php echo $viewavaluo->codigoavaluo->FldCaption() ?></td>
			<td<?php echo $viewavaluo->codigoavaluo->CellAttributes() ?>>
<span id="el_viewavaluo_codigoavaluo">
<span<?php echo $viewavaluo->codigoavaluo->ViewAttributes() ?>>
<?php echo $viewavaluo->codigoavaluo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluo->tipoinmueble->Visible) { // tipoinmueble ?>
		<tr id="r_tipoinmueble">
			<td class="col-sm-3"><?php echo $viewavaluo->tipoinmueble->FldCaption() ?></td>
			<td<?php echo $viewavaluo->tipoinmueble->CellAttributes() ?>>
<span id="el_viewavaluo_tipoinmueble">
<span<?php echo $viewavaluo->tipoinmueble->ViewAttributes() ?>>
<?php echo $viewavaluo->tipoinmueble->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluo->id_solicitud->Visible) { // id_solicitud ?>
		<tr id="r_id_solicitud">
			<td class="col-sm-3"><?php echo $viewavaluo->id_solicitud->FldCaption() ?></td>
			<td<?php echo $viewavaluo->id_solicitud->CellAttributes() ?>>
<span id="el_viewavaluo_id_solicitud">
<span<?php echo $viewavaluo->id_solicitud->ViewAttributes() ?>>
<?php echo $viewavaluo->id_solicitud->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluo->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<tr id="r_id_oficialcredito">
			<td class="col-sm-3"><?php echo $viewavaluo->id_oficialcredito->FldCaption() ?></td>
			<td<?php echo $viewavaluo->id_oficialcredito->CellAttributes() ?>>
<span id="el_viewavaluo_id_oficialcredito">
<span<?php echo $viewavaluo->id_oficialcredito->ViewAttributes() ?>>
<?php echo $viewavaluo->id_oficialcredito->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluo->id_inspector->Visible) { // id_inspector ?>
		<tr id="r_id_inspector">
			<td class="col-sm-3"><?php echo $viewavaluo->id_inspector->FldCaption() ?></td>
			<td<?php echo $viewavaluo->id_inspector->CellAttributes() ?>>
<span id="el_viewavaluo_id_inspector">
<span<?php echo $viewavaluo->id_inspector->ViewAttributes() ?>>
<?php echo $viewavaluo->id_inspector->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluo->estado->Visible) { // estado ?>
		<tr id="r_estado">
			<td class="col-sm-3"><?php echo $viewavaluo->estado->FldCaption() ?></td>
			<td<?php echo $viewavaluo->estado->CellAttributes() ?>>
<span id="el_viewavaluo_estado">
<span<?php echo $viewavaluo->estado->ViewAttributes() ?>>
<?php echo $viewavaluo->estado->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluo->estadopago->Visible) { // estadopago ?>
		<tr id="r_estadopago">
			<td class="col-sm-3"><?php echo $viewavaluo->estadopago->FldCaption() ?></td>
			<td<?php echo $viewavaluo->estadopago->CellAttributes() ?>>
<span id="el_viewavaluo_estadopago">
<span<?php echo $viewavaluo->estadopago->ViewAttributes() ?>>
<?php echo $viewavaluo->estadopago->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluo->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<tr id="r_fecha_avaluo">
			<td class="col-sm-3"><?php echo $viewavaluo->fecha_avaluo->FldCaption() ?></td>
			<td<?php echo $viewavaluo->fecha_avaluo->CellAttributes() ?>>
<span id="el_viewavaluo_fecha_avaluo">
<span<?php echo $viewavaluo->fecha_avaluo->ViewAttributes() ?>>
<?php echo $viewavaluo->fecha_avaluo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluo->informe->Visible) { // informe ?>
		<tr id="r_informe">
			<td class="col-sm-3"><?php echo $viewavaluo->informe->FldCaption() ?></td>
			<td<?php echo $viewavaluo->informe->CellAttributes() ?>>
<span id="el_viewavaluo_informe">
<span<?php echo $viewavaluo->informe->ViewAttributes() ?>>
<?php echo ew_GetFileViewTag($viewavaluo->informe, $viewavaluo->informe->ListViewValue()) ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
