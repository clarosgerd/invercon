<?php

// codigoavaluo
// id_oficialcredito
// id_cliente
// estado
// estadointerno
// fecha_avaluo
// comentario

?>
<?php if ($viewavaluoinspector->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_viewavaluoinspectormaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
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
<?php if ($viewavaluoinspector->comentario->Visible) { // comentario ?>
		<tr id="r_comentario">
			<td class="col-sm-3"><?php echo $viewavaluoinspector->comentario->FldCaption() ?></td>
			<td<?php echo $viewavaluoinspector->comentario->CellAttributes() ?>>
<span id="el_viewavaluoinspector_comentario">
<span<?php echo $viewavaluoinspector->comentario->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->comentario->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
