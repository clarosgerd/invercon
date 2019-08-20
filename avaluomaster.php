<?php

// codigoavaluo
// id_solicitud
// id_oficialcredito
// id_inspector
// id_cliente
// estadointerno
// estadopago
// fecha_avaluo
// montoincial
// id_metodopago

?>
<?php if ($avaluo->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_avaluomaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($avaluo->codigoavaluo->Visible) { // codigoavaluo ?>
		<tr id="r_codigoavaluo">
			<td class="col-sm-3"><?php echo $avaluo->codigoavaluo->FldCaption() ?></td>
			<td<?php echo $avaluo->codigoavaluo->CellAttributes() ?>>
<span id="el_avaluo_codigoavaluo">
<span<?php echo $avaluo->codigoavaluo->ViewAttributes() ?>>
<?php echo $avaluo->codigoavaluo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($avaluo->id_solicitud->Visible) { // id_solicitud ?>
		<tr id="r_id_solicitud">
			<td class="col-sm-3"><?php echo $avaluo->id_solicitud->FldCaption() ?></td>
			<td<?php echo $avaluo->id_solicitud->CellAttributes() ?>>
<span id="el_avaluo_id_solicitud">
<span<?php echo $avaluo->id_solicitud->ViewAttributes() ?>>
<?php echo $avaluo->id_solicitud->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($avaluo->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<tr id="r_id_oficialcredito">
			<td class="col-sm-3"><?php echo $avaluo->id_oficialcredito->FldCaption() ?></td>
			<td<?php echo $avaluo->id_oficialcredito->CellAttributes() ?>>
<span id="el_avaluo_id_oficialcredito">
<span<?php echo $avaluo->id_oficialcredito->ViewAttributes() ?>>
<?php echo $avaluo->id_oficialcredito->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($avaluo->id_inspector->Visible) { // id_inspector ?>
		<tr id="r_id_inspector">
			<td class="col-sm-3"><?php echo $avaluo->id_inspector->FldCaption() ?></td>
			<td<?php echo $avaluo->id_inspector->CellAttributes() ?>>
<span id="el_avaluo_id_inspector">
<span<?php echo $avaluo->id_inspector->ViewAttributes() ?>>
<?php echo $avaluo->id_inspector->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($avaluo->id_cliente->Visible) { // id_cliente ?>
		<tr id="r_id_cliente">
			<td class="col-sm-3"><?php echo $avaluo->id_cliente->FldCaption() ?></td>
			<td<?php echo $avaluo->id_cliente->CellAttributes() ?>>
<span id="el_avaluo_id_cliente">
<span<?php echo $avaluo->id_cliente->ViewAttributes() ?>>
<?php echo $avaluo->id_cliente->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($avaluo->estadointerno->Visible) { // estadointerno ?>
		<tr id="r_estadointerno">
			<td class="col-sm-3"><?php echo $avaluo->estadointerno->FldCaption() ?></td>
			<td<?php echo $avaluo->estadointerno->CellAttributes() ?>>
<span id="el_avaluo_estadointerno">
<span<?php echo $avaluo->estadointerno->ViewAttributes() ?>>
<?php echo $avaluo->estadointerno->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($avaluo->estadopago->Visible) { // estadopago ?>
		<tr id="r_estadopago">
			<td class="col-sm-3"><?php echo $avaluo->estadopago->FldCaption() ?></td>
			<td<?php echo $avaluo->estadopago->CellAttributes() ?>>
<span id="el_avaluo_estadopago">
<span<?php echo $avaluo->estadopago->ViewAttributes() ?>>
<?php echo $avaluo->estadopago->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($avaluo->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<tr id="r_fecha_avaluo">
			<td class="col-sm-3"><?php echo $avaluo->fecha_avaluo->FldCaption() ?></td>
			<td<?php echo $avaluo->fecha_avaluo->CellAttributes() ?>>
<span id="el_avaluo_fecha_avaluo">
<span<?php echo $avaluo->fecha_avaluo->ViewAttributes() ?>>
<?php echo $avaluo->fecha_avaluo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($avaluo->montoincial->Visible) { // montoincial ?>
		<tr id="r_montoincial">
			<td class="col-sm-3"><?php echo $avaluo->montoincial->FldCaption() ?></td>
			<td<?php echo $avaluo->montoincial->CellAttributes() ?>>
<span id="el_avaluo_montoincial">
<span<?php echo $avaluo->montoincial->ViewAttributes() ?>>
<?php echo $avaluo->montoincial->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($avaluo->id_metodopago->Visible) { // id_metodopago ?>
		<tr id="r_id_metodopago">
			<td class="col-sm-3"><?php echo $avaluo->id_metodopago->FldCaption() ?></td>
			<td<?php echo $avaluo->id_metodopago->CellAttributes() ?>>
<span id="el_avaluo_id_metodopago">
<span<?php echo $avaluo->id_metodopago->ViewAttributes() ?>>
<?php echo $avaluo->id_metodopago->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
