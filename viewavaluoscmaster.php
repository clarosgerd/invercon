<?php

// codigoavaluo
// id_oficialcredito
// id_inspector
// id_cliente
// estadointerno
// estadopago
// fecha_avaluo
// montoincial
// monto_pago
// comentario
// documento_pago

?>
<?php if ($viewavaluosc->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_viewavaluoscmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($viewavaluosc->codigoavaluo->Visible) { // codigoavaluo ?>
		<tr id="r_codigoavaluo">
			<td class="col-sm-3"><?php echo $viewavaluosc->codigoavaluo->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->codigoavaluo->CellAttributes() ?>>
<span id="el_viewavaluosc_codigoavaluo">
<span<?php echo $viewavaluosc->codigoavaluo->ViewAttributes() ?>>
<?php echo $viewavaluosc->codigoavaluo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosc->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<tr id="r_id_oficialcredito">
			<td class="col-sm-3"><?php echo $viewavaluosc->id_oficialcredito->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->id_oficialcredito->CellAttributes() ?>>
<span id="el_viewavaluosc_id_oficialcredito">
<span<?php echo $viewavaluosc->id_oficialcredito->ViewAttributes() ?>>
<?php echo $viewavaluosc->id_oficialcredito->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosc->id_inspector->Visible) { // id_inspector ?>
		<tr id="r_id_inspector">
			<td class="col-sm-3"><?php echo $viewavaluosc->id_inspector->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->id_inspector->CellAttributes() ?>>
<span id="el_viewavaluosc_id_inspector">
<span<?php echo $viewavaluosc->id_inspector->ViewAttributes() ?>>
<?php echo $viewavaluosc->id_inspector->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosc->id_cliente->Visible) { // id_cliente ?>
		<tr id="r_id_cliente">
			<td class="col-sm-3"><?php echo $viewavaluosc->id_cliente->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->id_cliente->CellAttributes() ?>>
<span id="el_viewavaluosc_id_cliente">
<span<?php echo $viewavaluosc->id_cliente->ViewAttributes() ?>>
<?php echo $viewavaluosc->id_cliente->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosc->estadointerno->Visible) { // estadointerno ?>
		<tr id="r_estadointerno">
			<td class="col-sm-3"><?php echo $viewavaluosc->estadointerno->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->estadointerno->CellAttributes() ?>>
<span id="el_viewavaluosc_estadointerno">
<span<?php echo $viewavaluosc->estadointerno->ViewAttributes() ?>>
<?php echo $viewavaluosc->estadointerno->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosc->estadopago->Visible) { // estadopago ?>
		<tr id="r_estadopago">
			<td class="col-sm-3"><?php echo $viewavaluosc->estadopago->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->estadopago->CellAttributes() ?>>
<span id="el_viewavaluosc_estadopago">
<span<?php echo $viewavaluosc->estadopago->ViewAttributes() ?>>
<?php echo $viewavaluosc->estadopago->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosc->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<tr id="r_fecha_avaluo">
			<td class="col-sm-3"><?php echo $viewavaluosc->fecha_avaluo->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->fecha_avaluo->CellAttributes() ?>>
<span id="el_viewavaluosc_fecha_avaluo">
<span<?php echo $viewavaluosc->fecha_avaluo->ViewAttributes() ?>>
<?php echo $viewavaluosc->fecha_avaluo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosc->montoincial->Visible) { // montoincial ?>
		<tr id="r_montoincial">
			<td class="col-sm-3"><?php echo $viewavaluosc->montoincial->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->montoincial->CellAttributes() ?>>
<span id="el_viewavaluosc_montoincial">
<span<?php echo $viewavaluosc->montoincial->ViewAttributes() ?>>
<?php echo $viewavaluosc->montoincial->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosc->monto_pago->Visible) { // monto_pago ?>
		<tr id="r_monto_pago">
			<td class="col-sm-3"><?php echo $viewavaluosc->monto_pago->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->monto_pago->CellAttributes() ?>>
<span id="el_viewavaluosc_monto_pago">
<span<?php echo $viewavaluosc->monto_pago->ViewAttributes() ?>>
<?php echo $viewavaluosc->monto_pago->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosc->comentario->Visible) { // comentario ?>
		<tr id="r_comentario">
			<td class="col-sm-3"><?php echo $viewavaluosc->comentario->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->comentario->CellAttributes() ?>>
<span id="el_viewavaluosc_comentario">
<span<?php echo $viewavaluosc->comentario->ViewAttributes() ?>>
<?php echo $viewavaluosc->comentario->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosc->documento_pago->Visible) { // documento_pago ?>
		<tr id="r_documento_pago">
			<td class="col-sm-3"><?php echo $viewavaluosc->documento_pago->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->documento_pago->CellAttributes() ?>>
<span id="el_viewavaluosc_documento_pago">
<span<?php echo $viewavaluosc->documento_pago->ViewAttributes() ?>>
<?php echo ew_GetFileViewTag($viewavaluosc->documento_pago, $viewavaluosc->documento_pago->ListViewValue()) ?>
</span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
