<?php

// tipoinmueble
// codigoavaluo
// id_solicitud
// id_oficialcredito
// id_inspector
// estadointerno
// informe
// monto_pago
// montoincial
// comentario
// ModifiedBy

?>
<?php if ($viewavaluosupervisor->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_viewavaluosupervisormaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($viewavaluosupervisor->tipoinmueble->Visible) { // tipoinmueble ?>
		<tr id="r_tipoinmueble">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->tipoinmueble->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->tipoinmueble->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_tipoinmueble">
<span<?php echo $viewavaluosupervisor->tipoinmueble->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->tipoinmueble->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->codigoavaluo->Visible) { // codigoavaluo ?>
		<tr id="r_codigoavaluo">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->codigoavaluo->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->codigoavaluo->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_codigoavaluo">
<span<?php echo $viewavaluosupervisor->codigoavaluo->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->codigoavaluo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->id_solicitud->Visible) { // id_solicitud ?>
		<tr id="r_id_solicitud">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->id_solicitud->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->id_solicitud->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_id_solicitud">
<span<?php echo $viewavaluosupervisor->id_solicitud->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->id_solicitud->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<tr id="r_id_oficialcredito">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->id_oficialcredito->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->id_oficialcredito->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_id_oficialcredito">
<span<?php echo $viewavaluosupervisor->id_oficialcredito->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->id_oficialcredito->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->id_inspector->Visible) { // id_inspector ?>
		<tr id="r_id_inspector">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->id_inspector->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->id_inspector->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_id_inspector">
<span<?php echo $viewavaluosupervisor->id_inspector->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->id_inspector->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->estadointerno->Visible) { // estadointerno ?>
		<tr id="r_estadointerno">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->estadointerno->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->estadointerno->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_estadointerno">
<span<?php echo $viewavaluosupervisor->estadointerno->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->estadointerno->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->informe->Visible) { // informe ?>
		<tr id="r_informe">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->informe->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->informe->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_informe">
<span<?php echo $viewavaluosupervisor->informe->ViewAttributes() ?>>
<?php echo ew_GetFileViewTag($viewavaluosupervisor->informe, $viewavaluosupervisor->informe->ListViewValue()) ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->monto_pago->Visible) { // monto_pago ?>
		<tr id="r_monto_pago">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->monto_pago->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->monto_pago->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_monto_pago">
<span<?php echo $viewavaluosupervisor->monto_pago->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->monto_pago->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->montoincial->Visible) { // montoincial ?>
		<tr id="r_montoincial">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->montoincial->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->montoincial->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_montoincial">
<span<?php echo $viewavaluosupervisor->montoincial->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->montoincial->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->comentario->Visible) { // comentario ?>
		<tr id="r_comentario">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->comentario->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->comentario->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_comentario">
<span<?php echo $viewavaluosupervisor->comentario->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->comentario->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->ModifiedBy->Visible) { // ModifiedBy ?>
		<tr id="r_ModifiedBy">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->ModifiedBy->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->ModifiedBy->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_ModifiedBy">
<span<?php echo $viewavaluosupervisor->ModifiedBy->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->ModifiedBy->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
