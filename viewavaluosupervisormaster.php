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
// id_sucursal

?>
<?php if ($viewavaluosupervisor->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_viewavaluosupervisormaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($viewavaluosupervisor->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->id->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->id->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_id">
<span<?php echo $viewavaluosupervisor->id->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->id->ListViewValue() ?></span>
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
<?php if ($viewavaluosupervisor->id_cliente->Visible) { // id_cliente ?>
		<tr id="r_id_cliente">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->id_cliente->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->id_cliente->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_id_cliente">
<span<?php echo $viewavaluosupervisor->id_cliente->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->id_cliente->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->estado->Visible) { // estado ?>
		<tr id="r_estado">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->estado->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->estado->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_estado">
<span<?php echo $viewavaluosupervisor->estado->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->estado->ListViewValue() ?></span>
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
<?php if ($viewavaluosupervisor->estadopago->Visible) { // estadopago ?>
		<tr id="r_estadopago">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->estadopago->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->estadopago->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_estadopago">
<span<?php echo $viewavaluosupervisor->estadopago->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->estadopago->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<tr id="r_fecha_avaluo">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->fecha_avaluo->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->fecha_avaluo->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_fecha_avaluo">
<span<?php echo $viewavaluosupervisor->fecha_avaluo->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->fecha_avaluo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluosupervisor->id_sucursal->Visible) { // id_sucursal ?>
		<tr id="r_id_sucursal">
			<td class="col-sm-3"><?php echo $viewavaluosupervisor->id_sucursal->FldCaption() ?></td>
			<td<?php echo $viewavaluosupervisor->id_sucursal->CellAttributes() ?>>
<span id="el_viewavaluosupervisor_id_sucursal">
<span<?php echo $viewavaluosupervisor->id_sucursal->ViewAttributes() ?>>
<?php echo $viewavaluosupervisor->id_sucursal->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
