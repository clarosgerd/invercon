<?php

// id
// codigoavaluo
// id_solicitud
// id_oficialcredito
// id_inspector
// id_cliente
// estado
// estadointerno
// estadopago
// fecha_avaluo

?>
<?php if ($viewavaluosc->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_viewavaluoscmaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($viewavaluosc->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="col-sm-3"><?php echo $viewavaluosc->id->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->id->CellAttributes() ?>>
<span id="el_viewavaluosc_id">
<span<?php echo $viewavaluosc->id->ViewAttributes() ?>>
<?php echo $viewavaluosc->id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
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
<?php if ($viewavaluosc->id_solicitud->Visible) { // id_solicitud ?>
		<tr id="r_id_solicitud">
			<td class="col-sm-3"><?php echo $viewavaluosc->id_solicitud->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->id_solicitud->CellAttributes() ?>>
<span id="el_viewavaluosc_id_solicitud">
<span<?php echo $viewavaluosc->id_solicitud->ViewAttributes() ?>>
<?php echo $viewavaluosc->id_solicitud->ListViewValue() ?></span>
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
<?php if ($viewavaluosc->estado->Visible) { // estado ?>
		<tr id="r_estado">
			<td class="col-sm-3"><?php echo $viewavaluosc->estado->FldCaption() ?></td>
			<td<?php echo $viewavaluosc->estado->CellAttributes() ?>>
<span id="el_viewavaluosc_estado">
<span<?php echo $viewavaluosc->estado->ViewAttributes() ?>>
<?php echo $viewavaluosc->estado->ListViewValue() ?></span>
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
	</tbody>
</table>
</div>
<?php } ?>
