<?php

// id
// name
// lastname
// email
// address
// nombre_contacto
// email_contacto
// phone
// cell
// tipoinmueble
// tipovehiculo
// tipomaquinaria
// tipomercaderia
// tipoespecial

?>
<?php if ($viewsolicitudsupervisor->Visible) { ?>
<div class="ewMasterDiv">
<table id="tbl_viewsolicitudsupervisormaster" class="table ewViewTable ewMasterTable ewVertical">
	<tbody>
<?php if ($viewsolicitudsupervisor->id->Visible) { // id ?>
		<tr id="r_id">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->id->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->id->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_id">
<span<?php echo $viewsolicitudsupervisor->id->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->id->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->name->Visible) { // name ?>
		<tr id="r_name">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->name->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->name->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_name">
<span<?php echo $viewsolicitudsupervisor->name->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->name->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->lastname->Visible) { // lastname ?>
		<tr id="r_lastname">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->lastname->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->lastname->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_lastname">
<span<?php echo $viewsolicitudsupervisor->lastname->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->lastname->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->_email->Visible) { // email ?>
		<tr id="r__email">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->_email->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->_email->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor__email">
<span<?php echo $viewsolicitudsupervisor->_email->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->_email->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->address->Visible) { // address ?>
		<tr id="r_address">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->address->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->address->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_address">
<span<?php echo $viewsolicitudsupervisor->address->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->address->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->nombre_contacto->Visible) { // nombre_contacto ?>
		<tr id="r_nombre_contacto">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->nombre_contacto->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->nombre_contacto->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_nombre_contacto">
<span<?php echo $viewsolicitudsupervisor->nombre_contacto->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->nombre_contacto->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->email_contacto->Visible) { // email_contacto ?>
		<tr id="r_email_contacto">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->email_contacto->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->email_contacto->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_email_contacto">
<span<?php echo $viewsolicitudsupervisor->email_contacto->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->email_contacto->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->phone->Visible) { // phone ?>
		<tr id="r_phone">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->phone->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->phone->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_phone">
<span<?php echo $viewsolicitudsupervisor->phone->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->phone->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->cell->Visible) { // cell ?>
		<tr id="r_cell">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->cell->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->cell->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_cell">
<span<?php echo $viewsolicitudsupervisor->cell->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->cell->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipoinmueble->Visible) { // tipoinmueble ?>
		<tr id="r_tipoinmueble">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->tipoinmueble->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->tipoinmueble->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipoinmueble">
<span<?php echo $viewsolicitudsupervisor->tipoinmueble->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->tipoinmueble->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipovehiculo->Visible) { // tipovehiculo ?>
		<tr id="r_tipovehiculo">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->tipovehiculo->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->tipovehiculo->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipovehiculo">
<span<?php echo $viewsolicitudsupervisor->tipovehiculo->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->tipovehiculo->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipomaquinaria->Visible) { // tipomaquinaria ?>
		<tr id="r_tipomaquinaria">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->tipomaquinaria->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->tipomaquinaria->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipomaquinaria">
<span<?php echo $viewsolicitudsupervisor->tipomaquinaria->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->tipomaquinaria->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipomercaderia->Visible) { // tipomercaderia ?>
		<tr id="r_tipomercaderia">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->tipomercaderia->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->tipomercaderia->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipomercaderia">
<span<?php echo $viewsolicitudsupervisor->tipomercaderia->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->tipomercaderia->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
<?php if ($viewsolicitudsupervisor->tipoespecial->Visible) { // tipoespecial ?>
		<tr id="r_tipoespecial">
			<td class="col-sm-3"><?php echo $viewsolicitudsupervisor->tipoespecial->FldCaption() ?></td>
			<td<?php echo $viewsolicitudsupervisor->tipoespecial->CellAttributes() ?>>
<span id="el_viewsolicitudsupervisor_tipoespecial">
<span<?php echo $viewsolicitudsupervisor->tipoespecial->ViewAttributes() ?>>
<?php echo $viewsolicitudsupervisor->tipoespecial->ListViewValue() ?></span>
</span>
</td>
		</tr>
<?php } ?>
	</tbody>
</table>
</div>
<?php } ?>
