<?php

// id
// code
// cliente_id
// status_id
// created_at
// metodopago_id

?>
<?php if ($pago->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_pagomaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($pago->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="col-sm-3"><?php echo $pago->id->FldCaption() ?></td>
			<td<?php echo $pago->id->CellAttributes() ?>>
<span id="el_pago_id">
<span<?php echo $pago->id->ViewAttributes() ?>>
<?php echo $pago->id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pago->code->Visible) { // code ?>
		<tr id="r_code">
			<td class="col-sm-3"><?php echo $pago->code->FldCaption() ?></td>
			<td<?php echo $pago->code->CellAttributes() ?>>
<span id="el_pago_code">
<span<?php echo $pago->code->ViewAttributes() ?>>
<?php echo $pago->code->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pago->cliente_id->Visible) { // cliente_id ?>
		<tr id="r_cliente_id">
			<td class="col-sm-3"><?php echo $pago->cliente_id->FldCaption() ?></td>
			<td<?php echo $pago->cliente_id->CellAttributes() ?>>
<span id="el_pago_cliente_id">
<span<?php echo $pago->cliente_id->ViewAttributes() ?>>
<?php echo $pago->cliente_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pago->status_id->Visible) { // status_id ?>
		<tr id="r_status_id">
			<td class="col-sm-3"><?php echo $pago->status_id->FldCaption() ?></td>
			<td<?php echo $pago->status_id->CellAttributes() ?>>
<span id="el_pago_status_id">
<span<?php echo $pago->status_id->ViewAttributes() ?>>
<?php echo $pago->status_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pago->created_at->Visible) { // created_at ?>
		<tr id="r_created_at">
			<td class="col-sm-3"><?php echo $pago->created_at->FldCaption() ?></td>
			<td<?php echo $pago->created_at->CellAttributes() ?>>
<span id="el_pago_created_at">
<span<?php echo $pago->created_at->ViewAttributes() ?>>
<?php echo $pago->created_at->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($pago->metodopago_id->Visible) { // metodopago_id ?>
		<tr id="r_metodopago_id">
			<td class="col-sm-3"><?php echo $pago->metodopago_id->FldCaption() ?></td>
			<td<?php echo $pago->metodopago_id->CellAttributes() ?>>
<span id="el_pago_metodopago_id">
<span<?php echo $pago->metodopago_id->ViewAttributes() ?>>
<?php echo $pago->metodopago_id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
