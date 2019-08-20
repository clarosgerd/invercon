<?php

// id
// name
// lastname
// email
// address
// phone
// phone_cell
// is_active

?>
<?php if ($cliente->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_clientemaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($cliente->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="col-sm-3"><?php echo $cliente->id->FldCaption() ?></td>
			<td<?php echo $cliente->id->CellAttributes() ?>>
<span id="el_cliente_id">
<span<?php echo $cliente->id->ViewAttributes() ?>>
<?php echo $cliente->id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="col-sm-3"><?php echo $cliente->name->FldCaption() ?></td>
			<td<?php echo $cliente->name->CellAttributes() ?>>
<span id="el_cliente_name">
<span<?php echo $cliente->name->ViewAttributes() ?>>
<?php echo $cliente->name->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->lastname->Visible) { // lastname ?>
		<tr id="r_lastname">
			<td class="col-sm-3"><?php echo $cliente->lastname->FldCaption() ?></td>
			<td<?php echo $cliente->lastname->CellAttributes() ?>>
<span id="el_cliente_lastname">
<span<?php echo $cliente->lastname->ViewAttributes() ?>>
<?php echo $cliente->lastname->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->_email->Visible) { // email ?>
		<tr id="r__email">
			<td class="col-sm-3"><?php echo $cliente->_email->FldCaption() ?></td>
			<td<?php echo $cliente->_email->CellAttributes() ?>>
<span id="el_cliente__email">
<span<?php echo $cliente->_email->ViewAttributes() ?>>
<?php echo $cliente->_email->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->address->Visible) { // address ?>
		<tr id="r_address">
			<td class="col-sm-3"><?php echo $cliente->address->FldCaption() ?></td>
			<td<?php echo $cliente->address->CellAttributes() ?>>
<span id="el_cliente_address">
<span<?php echo $cliente->address->ViewAttributes() ?>>
<?php echo $cliente->address->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->phone->Visible) { // phone ?>
		<tr id="r_phone">
			<td class="col-sm-3"><?php echo $cliente->phone->FldCaption() ?></td>
			<td<?php echo $cliente->phone->CellAttributes() ?>>
<span id="el_cliente_phone">
<span<?php echo $cliente->phone->ViewAttributes() ?>>
<?php echo $cliente->phone->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->phone_cell->Visible) { // phone_cell ?>
		<tr id="r_phone_cell">
			<td class="col-sm-3"><?php echo $cliente->phone_cell->FldCaption() ?></td>
			<td<?php echo $cliente->phone_cell->CellAttributes() ?>>
<span id="el_cliente_phone_cell">
<span<?php echo $cliente->phone_cell->ViewAttributes() ?>>
<?php echo $cliente->phone_cell->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($cliente->is_active->Visible) { // is_active ?>
		<tr id="r_is_active">
			<td class="col-sm-3"><?php echo $cliente->is_active->FldCaption() ?></td>
			<td<?php echo $cliente->is_active->CellAttributes() ?>>
<span id="el_cliente_is_active">
<span<?php echo $cliente->is_active->ViewAttributes() ?>>
<?php echo $cliente->is_active->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
