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
<?php if ($viewavaluoinspector->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_viewavaluoinspectormaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($viewavaluoinspector->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="col-sm-3"><?php echo $viewavaluoinspector->id->FldCaption() ?></td>
			<td<?php echo $viewavaluoinspector->id->CellAttributes() ?>>
<span id="el_viewavaluoinspector_id">
<span<?php echo $viewavaluoinspector->id->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluoinspector->codigoavaluo->Visible) { // codigoavaluo ?>
		<tr id="r_codigoavaluo">
			<td class="col-sm-3"><?php echo $viewavaluoinspector->codigoavaluo->FldCaption() ?></td>
			<td<?php echo $viewavaluoinspector->codigoavaluo->CellAttributes() ?>>
<span id="el_viewavaluoinspector_codigoavaluo">
<span<?php echo $viewavaluoinspector->codigoavaluo->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->codigoavaluo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluoinspector->id_solicitud->Visible) { // id_solicitud ?>
		<tr id="r_id_solicitud">
			<td class="col-sm-3"><?php echo $viewavaluoinspector->id_solicitud->FldCaption() ?></td>
			<td<?php echo $viewavaluoinspector->id_solicitud->CellAttributes() ?>>
<span id="el_viewavaluoinspector_id_solicitud">
<span<?php echo $viewavaluoinspector->id_solicitud->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->id_solicitud->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluoinspector->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<tr id="r_id_oficialcredito">
			<td class="col-sm-3"><?php echo $viewavaluoinspector->id_oficialcredito->FldCaption() ?></td>
			<td<?php echo $viewavaluoinspector->id_oficialcredito->CellAttributes() ?>>
<span id="el_viewavaluoinspector_id_oficialcredito">
<span<?php echo $viewavaluoinspector->id_oficialcredito->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->id_oficialcredito->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluoinspector->id_inspector->Visible) { // id_inspector ?>
		<tr id="r_id_inspector">
			<td class="col-sm-3"><?php echo $viewavaluoinspector->id_inspector->FldCaption() ?></td>
			<td<?php echo $viewavaluoinspector->id_inspector->CellAttributes() ?>>
<span id="el_viewavaluoinspector_id_inspector">
<span<?php echo $viewavaluoinspector->id_inspector->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->id_inspector->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluoinspector->id_cliente->Visible) { // id_cliente ?>
		<tr id="r_id_cliente">
			<td class="col-sm-3"><?php echo $viewavaluoinspector->id_cliente->FldCaption() ?></td>
			<td<?php echo $viewavaluoinspector->id_cliente->CellAttributes() ?>>
<span id="el_viewavaluoinspector_id_cliente">
<span<?php echo $viewavaluoinspector->id_cliente->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->id_cliente->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluoinspector->estado->Visible) { // estado ?>
		<tr id="r_estado">
			<td class="col-sm-3"><?php echo $viewavaluoinspector->estado->FldCaption() ?></td>
			<td<?php echo $viewavaluoinspector->estado->CellAttributes() ?>>
<span id="el_viewavaluoinspector_estado">
<span<?php echo $viewavaluoinspector->estado->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->estado->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluoinspector->estadointerno->Visible) { // estadointerno ?>
		<tr id="r_estadointerno">
			<td class="col-sm-3"><?php echo $viewavaluoinspector->estadointerno->FldCaption() ?></td>
			<td<?php echo $viewavaluoinspector->estadointerno->CellAttributes() ?>>
<span id="el_viewavaluoinspector_estadointerno">
<span<?php echo $viewavaluoinspector->estadointerno->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->estadointerno->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluoinspector->estadopago->Visible) { // estadopago ?>
		<tr id="r_estadopago">
			<td class="col-sm-3"><?php echo $viewavaluoinspector->estadopago->FldCaption() ?></td>
			<td<?php echo $viewavaluoinspector->estadopago->CellAttributes() ?>>
<span id="el_viewavaluoinspector_estadopago">
<span<?php echo $viewavaluoinspector->estadopago->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->estadopago->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewavaluoinspector->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<tr id="r_fecha_avaluo">
			<td class="col-sm-3"><?php echo $viewavaluoinspector->fecha_avaluo->FldCaption() ?></td>
			<td<?php echo $viewavaluoinspector->fecha_avaluo->CellAttributes() ?>>
<span id="el_viewavaluoinspector_fecha_avaluo">
<span<?php echo $viewavaluoinspector->fecha_avaluo->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->fecha_avaluo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
