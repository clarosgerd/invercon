<?php include_once "usuarioinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($viewavaluo_grid)) $viewavaluo_grid = new cviewavaluo_grid();

// Page init
$viewavaluo_grid->Page_Init();

// Page main
$viewavaluo_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewavaluo_grid->Page_Render();
?>
<?php if ($viewavaluo->Export == "") { ?>
<script type="text/javascript">

// Form object
var fviewavaluogrid = new ew_Form("fviewavaluogrid", "grid");
fviewavaluogrid.FormKeyCountName = '<?php echo $viewavaluo_grid->FormKeyCountName ?>';

// Validate form
fviewavaluogrid.Validate = function() {
	if (!this.ValidateRequired)
		return true; // Ignore validation
	var $ = jQuery, fobj = this.GetForm(), $fobj = $(fobj);
	if ($fobj.find("#a_confirm").val() == "F")
		return true;
	var elm, felm, uelm, addcnt = 0;
	var $k = $fobj.find("#" + this.FormKeyCountName); // Get key_count
	var rowcnt = ($k[0]) ? parseInt($k.val(), 10) : 1;
	var startcnt = (rowcnt == 0) ? 0 : 1; // Check rowcnt == 0 => Inline-Add
	var gridinsert = $fobj.find("#a_list").val() == "gridinsert";
	for (var i = startcnt; i <= rowcnt; i++) {
		var infix = ($k[0]) ? String(i) : "";
		$fobj.data("rowindex", infix);
		var checkrow = (gridinsert) ? !this.EmptyRow(infix) : true;
		if (checkrow) {
			addcnt++;
			elm = this.GetElements("x" + infix + "_id_cliente");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluo->id_cliente->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_estado");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluo->estado->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_fecha_avaluo");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($viewavaluo->fecha_avaluo->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fviewavaluogrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "tipoinmueble", false)) return false;
	if (ew_ValueChanged(fobj, infix, "codigoavaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_solicitud", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_oficialcredito", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_inspector", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_cliente", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estadopago", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_avaluo", false)) return false;
	return true;
}

// Form_CustomValidate event
fviewavaluogrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluogrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluogrid.Lists["x_tipoinmueble"] = {"LinkField":"x_nombre","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipoinmueble"};
fviewavaluogrid.Lists["x_tipoinmueble"].Data = "<?php echo $viewavaluo_grid->tipoinmueble->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluogrid.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","x__email",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
fviewavaluogrid.Lists["x_id_solicitud"].Data = "<?php echo $viewavaluo_grid->id_solicitud->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluogrid.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fviewavaluogrid.Lists["x_id_oficialcredito"].Data = "<?php echo $viewavaluo_grid->id_oficialcredito->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($viewavaluo->CurrentAction == "gridadd") {
	if ($viewavaluo->CurrentMode == "copy") {
		$bSelectLimit = $viewavaluo_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$viewavaluo_grid->TotalRecs = $viewavaluo->ListRecordCount();
			$viewavaluo_grid->Recordset = $viewavaluo_grid->LoadRecordset($viewavaluo_grid->StartRec-1, $viewavaluo_grid->DisplayRecs);
		} else {
			if ($viewavaluo_grid->Recordset = $viewavaluo_grid->LoadRecordset())
				$viewavaluo_grid->TotalRecs = $viewavaluo_grid->Recordset->RecordCount();
		}
		$viewavaluo_grid->StartRec = 1;
		$viewavaluo_grid->DisplayRecs = $viewavaluo_grid->TotalRecs;
	} else {
		$viewavaluo->CurrentFilter = "0=1";
		$viewavaluo_grid->StartRec = 1;
		$viewavaluo_grid->DisplayRecs = $viewavaluo->GridAddRowCount;
	}
	$viewavaluo_grid->TotalRecs = $viewavaluo_grid->DisplayRecs;
	$viewavaluo_grid->StopRec = $viewavaluo_grid->DisplayRecs;
} else {
	$bSelectLimit = $viewavaluo_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($viewavaluo_grid->TotalRecs <= 0)
			$viewavaluo_grid->TotalRecs = $viewavaluo->ListRecordCount();
	} else {
		if (!$viewavaluo_grid->Recordset && ($viewavaluo_grid->Recordset = $viewavaluo_grid->LoadRecordset()))
			$viewavaluo_grid->TotalRecs = $viewavaluo_grid->Recordset->RecordCount();
	}
	$viewavaluo_grid->StartRec = 1;
	$viewavaluo_grid->DisplayRecs = $viewavaluo_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$viewavaluo_grid->Recordset = $viewavaluo_grid->LoadRecordset($viewavaluo_grid->StartRec-1, $viewavaluo_grid->DisplayRecs);

	// Set no record found message
	if ($viewavaluo->CurrentAction == "" && $viewavaluo_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$viewavaluo_grid->setWarningMessage(ew_DeniedMsg());
		if ($viewavaluo_grid->SearchWhere == "0=101")
			$viewavaluo_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$viewavaluo_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$viewavaluo_grid->RenderOtherOptions();
?>
<?php $viewavaluo_grid->ShowPageHeader(); ?>
<?php
$viewavaluo_grid->ShowMessage();
?>
<?php if ($viewavaluo_grid->TotalRecs > 0 || $viewavaluo->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($viewavaluo_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewavaluo">
<div id="fviewavaluogrid" class="ewForm ewListForm form-inline">
<div id="gmp_viewavaluo" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_viewavaluogrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$viewavaluo_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$viewavaluo_grid->RenderListOptions();

// Render list options (header, left)
$viewavaluo_grid->ListOptions->Render("header", "left");
?>
<?php if ($viewavaluo->tipoinmueble->Visible) { // tipoinmueble ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->tipoinmueble) == "") { ?>
		<th data-name="tipoinmueble" class="<?php echo $viewavaluo->tipoinmueble->HeaderCellClass() ?>"><div id="elh_viewavaluo_tipoinmueble" class="viewavaluo_tipoinmueble"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->tipoinmueble->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="tipoinmueble" class="<?php echo $viewavaluo->tipoinmueble->HeaderCellClass() ?>"><div><div id="elh_viewavaluo_tipoinmueble" class="viewavaluo_tipoinmueble">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->tipoinmueble->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->tipoinmueble->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->tipoinmueble->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->codigoavaluo->Visible) { // codigoavaluo ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->codigoavaluo) == "") { ?>
		<th data-name="codigoavaluo" class="<?php echo $viewavaluo->codigoavaluo->HeaderCellClass() ?>"><div id="elh_viewavaluo_codigoavaluo" class="viewavaluo_codigoavaluo"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->codigoavaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="codigoavaluo" class="<?php echo $viewavaluo->codigoavaluo->HeaderCellClass() ?>"><div><div id="elh_viewavaluo_codigoavaluo" class="viewavaluo_codigoavaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->codigoavaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->codigoavaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->codigoavaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->id_solicitud->Visible) { // id_solicitud ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->id_solicitud) == "") { ?>
		<th data-name="id_solicitud" class="<?php echo $viewavaluo->id_solicitud->HeaderCellClass() ?>"><div id="elh_viewavaluo_id_solicitud" class="viewavaluo_id_solicitud"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->id_solicitud->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_solicitud" class="<?php echo $viewavaluo->id_solicitud->HeaderCellClass() ?>"><div><div id="elh_viewavaluo_id_solicitud" class="viewavaluo_id_solicitud">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->id_solicitud->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->id_solicitud->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->id_solicitud->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->id_oficialcredito->Visible) { // id_oficialcredito ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->id_oficialcredito) == "") { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluo->id_oficialcredito->HeaderCellClass() ?>"><div id="elh_viewavaluo_id_oficialcredito" class="viewavaluo_id_oficialcredito"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->id_oficialcredito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluo->id_oficialcredito->HeaderCellClass() ?>"><div><div id="elh_viewavaluo_id_oficialcredito" class="viewavaluo_id_oficialcredito">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->id_oficialcredito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->id_oficialcredito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->id_oficialcredito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->id_inspector->Visible) { // id_inspector ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->id_inspector) == "") { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluo->id_inspector->HeaderCellClass() ?>"><div id="elh_viewavaluo_id_inspector" class="viewavaluo_id_inspector"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->id_inspector->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluo->id_inspector->HeaderCellClass() ?>"><div><div id="elh_viewavaluo_id_inspector" class="viewavaluo_id_inspector">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->id_inspector->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->id_inspector->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->id_inspector->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->id_cliente->Visible) { // id_cliente ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->id_cliente) == "") { ?>
		<th data-name="id_cliente" class="<?php echo $viewavaluo->id_cliente->HeaderCellClass() ?>"><div id="elh_viewavaluo_id_cliente" class="viewavaluo_id_cliente"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->id_cliente->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_cliente" class="<?php echo $viewavaluo->id_cliente->HeaderCellClass() ?>"><div><div id="elh_viewavaluo_id_cliente" class="viewavaluo_id_cliente">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->id_cliente->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->id_cliente->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->id_cliente->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->estado->Visible) { // estado ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->estado) == "") { ?>
		<th data-name="estado" class="<?php echo $viewavaluo->estado->HeaderCellClass() ?>"><div id="elh_viewavaluo_estado" class="viewavaluo_estado"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado" class="<?php echo $viewavaluo->estado->HeaderCellClass() ?>"><div><div id="elh_viewavaluo_estado" class="viewavaluo_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->estado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->estadopago->Visible) { // estadopago ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->estadopago) == "") { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluo->estadopago->HeaderCellClass() ?>"><div id="elh_viewavaluo_estadopago" class="viewavaluo_estadopago"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluo->estadopago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluo->estadopago->HeaderCellClass() ?>"><div><div id="elh_viewavaluo_estadopago" class="viewavaluo_estadopago">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->estadopago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->estadopago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->estadopago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluo->fecha_avaluo->Visible) { // fecha_avaluo ?>
	<?php if ($viewavaluo->SortUrl($viewavaluo->fecha_avaluo) == "") { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluo->fecha_avaluo->HeaderCellClass() ?>"><div id="elh_viewavaluo_fecha_avaluo" class="viewavaluo_fecha_avaluo"><div class="ewTableHeaderCaption"><?php echo $viewavaluo->fecha_avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluo->fecha_avaluo->HeaderCellClass() ?>"><div><div id="elh_viewavaluo_fecha_avaluo" class="viewavaluo_fecha_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluo->fecha_avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluo->fecha_avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluo->fecha_avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$viewavaluo_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$viewavaluo_grid->StartRec = 1;
$viewavaluo_grid->StopRec = $viewavaluo_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($viewavaluo_grid->FormKeyCountName) && ($viewavaluo->CurrentAction == "gridadd" || $viewavaluo->CurrentAction == "gridedit" || $viewavaluo->CurrentAction == "F")) {
		$viewavaluo_grid->KeyCount = $objForm->GetValue($viewavaluo_grid->FormKeyCountName);
		$viewavaluo_grid->StopRec = $viewavaluo_grid->StartRec + $viewavaluo_grid->KeyCount - 1;
	}
}
$viewavaluo_grid->RecCnt = $viewavaluo_grid->StartRec - 1;
if ($viewavaluo_grid->Recordset && !$viewavaluo_grid->Recordset->EOF) {
	$viewavaluo_grid->Recordset->MoveFirst();
	$bSelectLimit = $viewavaluo_grid->UseSelectLimit;
	if (!$bSelectLimit && $viewavaluo_grid->StartRec > 1)
		$viewavaluo_grid->Recordset->Move($viewavaluo_grid->StartRec - 1);
} elseif (!$viewavaluo->AllowAddDeleteRow && $viewavaluo_grid->StopRec == 0) {
	$viewavaluo_grid->StopRec = $viewavaluo->GridAddRowCount;
}

// Initialize aggregate
$viewavaluo->RowType = EW_ROWTYPE_AGGREGATEINIT;
$viewavaluo->ResetAttrs();
$viewavaluo_grid->RenderRow();
if ($viewavaluo->CurrentAction == "gridadd")
	$viewavaluo_grid->RowIndex = 0;
if ($viewavaluo->CurrentAction == "gridedit")
	$viewavaluo_grid->RowIndex = 0;
while ($viewavaluo_grid->RecCnt < $viewavaluo_grid->StopRec) {
	$viewavaluo_grid->RecCnt++;
	if (intval($viewavaluo_grid->RecCnt) >= intval($viewavaluo_grid->StartRec)) {
		$viewavaluo_grid->RowCnt++;
		if ($viewavaluo->CurrentAction == "gridadd" || $viewavaluo->CurrentAction == "gridedit" || $viewavaluo->CurrentAction == "F") {
			$viewavaluo_grid->RowIndex++;
			$objForm->Index = $viewavaluo_grid->RowIndex;
			if ($objForm->HasValue($viewavaluo_grid->FormActionName))
				$viewavaluo_grid->RowAction = strval($objForm->GetValue($viewavaluo_grid->FormActionName));
			elseif ($viewavaluo->CurrentAction == "gridadd")
				$viewavaluo_grid->RowAction = "insert";
			else
				$viewavaluo_grid->RowAction = "";
		}

		// Set up key count
		$viewavaluo_grid->KeyCount = $viewavaluo_grid->RowIndex;

		// Init row class and style
		$viewavaluo->ResetAttrs();
		$viewavaluo->CssClass = "";
		if ($viewavaluo->CurrentAction == "gridadd") {
			if ($viewavaluo->CurrentMode == "copy") {
				$viewavaluo_grid->LoadRowValues($viewavaluo_grid->Recordset); // Load row values
				$viewavaluo_grid->SetRecordKey($viewavaluo_grid->RowOldKey, $viewavaluo_grid->Recordset); // Set old record key
			} else {
				$viewavaluo_grid->LoadRowValues(); // Load default values
				$viewavaluo_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$viewavaluo_grid->LoadRowValues($viewavaluo_grid->Recordset); // Load row values
		}
		$viewavaluo->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($viewavaluo->CurrentAction == "gridadd") // Grid add
			$viewavaluo->RowType = EW_ROWTYPE_ADD; // Render add
		if ($viewavaluo->CurrentAction == "gridadd" && $viewavaluo->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$viewavaluo_grid->RestoreCurrentRowFormValues($viewavaluo_grid->RowIndex); // Restore form values
		if ($viewavaluo->CurrentAction == "gridedit") { // Grid edit
			if ($viewavaluo->EventCancelled) {
				$viewavaluo_grid->RestoreCurrentRowFormValues($viewavaluo_grid->RowIndex); // Restore form values
			}
			if ($viewavaluo_grid->RowAction == "insert")
				$viewavaluo->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$viewavaluo->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($viewavaluo->CurrentAction == "gridedit" && ($viewavaluo->RowType == EW_ROWTYPE_EDIT || $viewavaluo->RowType == EW_ROWTYPE_ADD) && $viewavaluo->EventCancelled) // Update failed
			$viewavaluo_grid->RestoreCurrentRowFormValues($viewavaluo_grid->RowIndex); // Restore form values
		if ($viewavaluo->RowType == EW_ROWTYPE_EDIT) // Edit row
			$viewavaluo_grid->EditRowCnt++;
		if ($viewavaluo->CurrentAction == "F") // Confirm row
			$viewavaluo_grid->RestoreCurrentRowFormValues($viewavaluo_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$viewavaluo->RowAttrs = array_merge($viewavaluo->RowAttrs, array('data-rowindex'=>$viewavaluo_grid->RowCnt, 'id'=>'r' . $viewavaluo_grid->RowCnt . '_viewavaluo', 'data-rowtype'=>$viewavaluo->RowType));

		// Render row
		$viewavaluo_grid->RenderRow();

		// Render list options
		$viewavaluo_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($viewavaluo_grid->RowAction <> "delete" && $viewavaluo_grid->RowAction <> "insertdelete" && !($viewavaluo_grid->RowAction == "insert" && $viewavaluo->CurrentAction == "F" && $viewavaluo_grid->EmptyRow())) {
?>
	<tr<?php echo $viewavaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewavaluo_grid->ListOptions->Render("body", "left", $viewavaluo_grid->RowCnt);
?>
	<?php if ($viewavaluo->tipoinmueble->Visible) { // tipoinmueble ?>
		<td data-name="tipoinmueble"<?php echo $viewavaluo->tipoinmueble->CellAttributes() ?>>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_tipoinmueble" class="form-group viewavaluo_tipoinmueble">
<select data-table="viewavaluo" data-field="x_tipoinmueble" data-value-separator="<?php echo $viewavaluo->tipoinmueble->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" name="x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble"<?php echo $viewavaluo->tipoinmueble->EditAttributes() ?>>
<?php echo $viewavaluo->tipoinmueble->SelectOptionListHtml("x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble") ?>
</select>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_tipoinmueble" name="o<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" id="o<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluo->tipoinmueble->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_tipoinmueble" class="form-group viewavaluo_tipoinmueble">
<select data-table="viewavaluo" data-field="x_tipoinmueble" data-value-separator="<?php echo $viewavaluo->tipoinmueble->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" name="x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble"<?php echo $viewavaluo->tipoinmueble->EditAttributes() ?>>
<?php echo $viewavaluo->tipoinmueble->SelectOptionListHtml("x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble") ?>
</select>
</span>
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_tipoinmueble" class="viewavaluo_tipoinmueble">
<span<?php echo $viewavaluo->tipoinmueble->ViewAttributes() ?>>
<?php echo $viewavaluo->tipoinmueble->ListViewValue() ?></span>
</span>
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_tipoinmueble" name="x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" id="x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluo->tipoinmueble->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_tipoinmueble" name="o<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" id="o<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluo->tipoinmueble->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_tipoinmueble" name="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" id="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluo->tipoinmueble->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_tipoinmueble" name="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" id="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluo->tipoinmueble->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluo->id->CurrentValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_id" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluo->id->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_EDIT || $viewavaluo->CurrentMode == "edit") { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluo->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($viewavaluo->codigoavaluo->Visible) { // codigoavaluo ?>
		<td data-name="codigoavaluo"<?php echo $viewavaluo->codigoavaluo->CellAttributes() ?>>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_codigoavaluo" class="form-group viewavaluo_codigoavaluo">
<input type="text" data-table="viewavaluo" data-field="x_codigoavaluo" name="x<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewavaluo->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->codigoavaluo->EditValue ?>"<?php echo $viewavaluo->codigoavaluo->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_codigoavaluo" name="o<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" id="o<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluo->codigoavaluo->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_codigoavaluo" class="form-group viewavaluo_codigoavaluo">
<input type="text" data-table="viewavaluo" data-field="x_codigoavaluo" name="x<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewavaluo->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->codigoavaluo->EditValue ?>"<?php echo $viewavaluo->codigoavaluo->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_codigoavaluo" class="viewavaluo_codigoavaluo">
<span<?php echo $viewavaluo->codigoavaluo->ViewAttributes() ?>>
<?php echo $viewavaluo->codigoavaluo->ListViewValue() ?></span>
</span>
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_codigoavaluo" name="x<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluo->codigoavaluo->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_codigoavaluo" name="o<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" id="o<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluo->codigoavaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_codigoavaluo" name="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" id="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluo->codigoavaluo->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_codigoavaluo" name="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" id="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluo->codigoavaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluo->id_solicitud->Visible) { // id_solicitud ?>
		<td data-name="id_solicitud"<?php echo $viewavaluo->id_solicitud->CellAttributes() ?>>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($viewavaluo->id_solicitud->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_solicitud" class="form-group viewavaluo_id_solicitud">
<span<?php echo $viewavaluo->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluo->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_solicitud" class="form-group viewavaluo_id_solicitud">
<select data-table="viewavaluo" data-field="x_id_solicitud" data-value-separator="<?php echo $viewavaluo->id_solicitud->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud"<?php echo $viewavaluo->id_solicitud->EditAttributes() ?>>
<?php echo $viewavaluo->id_solicitud->SelectOptionListHtml("x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_solicitud" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluo->id_solicitud->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($viewavaluo->id_solicitud->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_solicitud" class="form-group viewavaluo_id_solicitud">
<span<?php echo $viewavaluo->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluo->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_solicitud" class="form-group viewavaluo_id_solicitud">
<select data-table="viewavaluo" data-field="x_id_solicitud" data-value-separator="<?php echo $viewavaluo->id_solicitud->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud"<?php echo $viewavaluo->id_solicitud->EditAttributes() ?>>
<?php echo $viewavaluo->id_solicitud->SelectOptionListHtml("x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_solicitud" class="viewavaluo_id_solicitud">
<span<?php echo $viewavaluo->id_solicitud->ViewAttributes() ?>>
<?php echo $viewavaluo->id_solicitud->ListViewValue() ?></span>
</span>
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_solicitud" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluo->id_solicitud->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_id_solicitud" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluo->id_solicitud->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_solicitud" name="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" id="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluo->id_solicitud->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_id_solicitud" name="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" id="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluo->id_solicitud->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluo->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<td data-name="id_oficialcredito"<?php echo $viewavaluo->id_oficialcredito->CellAttributes() ?>>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_oficialcredito" class="form-group viewavaluo_id_oficialcredito">
<select data-table="viewavaluo" data-field="x_id_oficialcredito" data-value-separator="<?php echo $viewavaluo->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito"<?php echo $viewavaluo->id_oficialcredito->EditAttributes() ?>>
<?php echo $viewavaluo->id_oficialcredito->SelectOptionListHtml("x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito") ?>
</select>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_id_oficialcredito" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluo->id_oficialcredito->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_oficialcredito" class="form-group viewavaluo_id_oficialcredito">
<select data-table="viewavaluo" data-field="x_id_oficialcredito" data-value-separator="<?php echo $viewavaluo->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito"<?php echo $viewavaluo->id_oficialcredito->EditAttributes() ?>>
<?php echo $viewavaluo->id_oficialcredito->SelectOptionListHtml("x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito") ?>
</select>
</span>
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_oficialcredito" class="viewavaluo_id_oficialcredito">
<span<?php echo $viewavaluo->id_oficialcredito->ViewAttributes() ?>>
<?php echo $viewavaluo->id_oficialcredito->ListViewValue() ?></span>
</span>
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_oficialcredito" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluo->id_oficialcredito->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_id_oficialcredito" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluo->id_oficialcredito->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_oficialcredito" name="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" id="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluo->id_oficialcredito->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_id_oficialcredito" name="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" id="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluo->id_oficialcredito->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluo->id_inspector->Visible) { // id_inspector ?>
		<td data-name="id_inspector"<?php echo $viewavaluo->id_inspector->CellAttributes() ?>>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_inspector" class="form-group viewavaluo_id_inspector">
<select data-table="viewavaluo" data-field="x_id_inspector" data-value-separator="<?php echo $viewavaluo->id_inspector->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector"<?php echo $viewavaluo->id_inspector->EditAttributes() ?>>
<?php echo $viewavaluo->id_inspector->SelectOptionListHtml("x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector") ?>
</select>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_id_inspector" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluo->id_inspector->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_inspector" class="form-group viewavaluo_id_inspector">
<select data-table="viewavaluo" data-field="x_id_inspector" data-value-separator="<?php echo $viewavaluo->id_inspector->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector"<?php echo $viewavaluo->id_inspector->EditAttributes() ?>>
<?php echo $viewavaluo->id_inspector->SelectOptionListHtml("x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector") ?>
</select>
</span>
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_inspector" class="viewavaluo_id_inspector">
<span<?php echo $viewavaluo->id_inspector->ViewAttributes() ?>>
<?php echo $viewavaluo->id_inspector->ListViewValue() ?></span>
</span>
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_inspector" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluo->id_inspector->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_id_inspector" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluo->id_inspector->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_inspector" name="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" id="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluo->id_inspector->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_id_inspector" name="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" id="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluo->id_inspector->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluo->id_cliente->Visible) { // id_cliente ?>
		<td data-name="id_cliente"<?php echo $viewavaluo->id_cliente->CellAttributes() ?>>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_cliente" class="form-group viewavaluo_id_cliente">
<input type="text" data-table="viewavaluo" data-field="x_id_cliente" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluo->id_cliente->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->id_cliente->EditValue ?>"<?php echo $viewavaluo->id_cliente->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_id_cliente" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluo->id_cliente->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_cliente" class="form-group viewavaluo_id_cliente">
<input type="text" data-table="viewavaluo" data-field="x_id_cliente" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluo->id_cliente->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->id_cliente->EditValue ?>"<?php echo $viewavaluo->id_cliente->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_id_cliente" class="viewavaluo_id_cliente">
<span<?php echo $viewavaluo->id_cliente->ViewAttributes() ?>>
<?php echo $viewavaluo->id_cliente->ListViewValue() ?></span>
</span>
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_cliente" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluo->id_cliente->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_id_cliente" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluo->id_cliente->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_cliente" name="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" id="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluo->id_cliente->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_id_cliente" name="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" id="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluo->id_cliente->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluo->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $viewavaluo->estado->CellAttributes() ?>>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_estado" class="form-group viewavaluo_estado">
<input type="text" data-table="viewavaluo" data-field="x_estado" name="x<?php echo $viewavaluo_grid->RowIndex ?>_estado" id="x<?php echo $viewavaluo_grid->RowIndex ?>_estado" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluo->estado->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->estado->EditValue ?>"<?php echo $viewavaluo->estado->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_estado" name="o<?php echo $viewavaluo_grid->RowIndex ?>_estado" id="o<?php echo $viewavaluo_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluo->estado->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_estado" class="form-group viewavaluo_estado">
<input type="text" data-table="viewavaluo" data-field="x_estado" name="x<?php echo $viewavaluo_grid->RowIndex ?>_estado" id="x<?php echo $viewavaluo_grid->RowIndex ?>_estado" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluo->estado->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->estado->EditValue ?>"<?php echo $viewavaluo->estado->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_estado" class="viewavaluo_estado">
<span<?php echo $viewavaluo->estado->ViewAttributes() ?>>
<?php echo $viewavaluo->estado->ListViewValue() ?></span>
</span>
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_estado" name="x<?php echo $viewavaluo_grid->RowIndex ?>_estado" id="x<?php echo $viewavaluo_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluo->estado->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_estado" name="o<?php echo $viewavaluo_grid->RowIndex ?>_estado" id="o<?php echo $viewavaluo_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluo->estado->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_estado" name="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_estado" id="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluo->estado->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_estado" name="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_estado" id="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluo->estado->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluo->estadopago->Visible) { // estadopago ?>
		<td data-name="estadopago"<?php echo $viewavaluo->estadopago->CellAttributes() ?>>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_estadopago" class="form-group viewavaluo_estadopago">
<input type="text" data-table="viewavaluo" data-field="x_estadopago" name="x<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" id="x<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluo->estadopago->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->estadopago->EditValue ?>"<?php echo $viewavaluo->estadopago->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_estadopago" name="o<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" id="o<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluo->estadopago->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_estadopago" class="form-group viewavaluo_estadopago">
<span<?php echo $viewavaluo->estadopago->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->estadopago->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_estadopago" name="x<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" id="x<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluo->estadopago->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_estadopago" class="viewavaluo_estadopago">
<span<?php echo $viewavaluo->estadopago->ViewAttributes() ?>>
<?php echo $viewavaluo->estadopago->ListViewValue() ?></span>
</span>
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_estadopago" name="x<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" id="x<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluo->estadopago->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_estadopago" name="o<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" id="o<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluo->estadopago->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_estadopago" name="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" id="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluo->estadopago->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_estadopago" name="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" id="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluo->estadopago->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluo->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<td data-name="fecha_avaluo"<?php echo $viewavaluo->fecha_avaluo->CellAttributes() ?>>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_fecha_avaluo" class="form-group viewavaluo_fecha_avaluo">
<input type="text" data-table="viewavaluo" data-field="x_fecha_avaluo" name="x<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($viewavaluo->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->fecha_avaluo->EditValue ?>"<?php echo $viewavaluo->fecha_avaluo->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_fecha_avaluo" name="o<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" id="o<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluo->fecha_avaluo->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_fecha_avaluo" class="form-group viewavaluo_fecha_avaluo">
<input type="text" data-table="viewavaluo" data-field="x_fecha_avaluo" name="x<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($viewavaluo->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->fecha_avaluo->EditValue ?>"<?php echo $viewavaluo->fecha_avaluo->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluo_grid->RowCnt ?>_viewavaluo_fecha_avaluo" class="viewavaluo_fecha_avaluo">
<span<?php echo $viewavaluo->fecha_avaluo->ViewAttributes() ?>>
<?php echo $viewavaluo->fecha_avaluo->ListViewValue() ?></span>
</span>
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_fecha_avaluo" name="x<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluo->fecha_avaluo->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_fecha_avaluo" name="o<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" id="o<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluo->fecha_avaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluo" data-field="x_fecha_avaluo" name="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" id="fviewavaluogrid$x<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluo->fecha_avaluo->FormValue) ?>">
<input type="hidden" data-table="viewavaluo" data-field="x_fecha_avaluo" name="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" id="fviewavaluogrid$o<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluo->fecha_avaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewavaluo_grid->ListOptions->Render("body", "right", $viewavaluo_grid->RowCnt);
?>
	</tr>
<?php if ($viewavaluo->RowType == EW_ROWTYPE_ADD || $viewavaluo->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fviewavaluogrid.UpdateOpts(<?php echo $viewavaluo_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($viewavaluo->CurrentAction <> "gridadd" || $viewavaluo->CurrentMode == "copy")
		if (!$viewavaluo_grid->Recordset->EOF) $viewavaluo_grid->Recordset->MoveNext();
}
?>
<?php
	if ($viewavaluo->CurrentMode == "add" || $viewavaluo->CurrentMode == "copy" || $viewavaluo->CurrentMode == "edit") {
		$viewavaluo_grid->RowIndex = '$rowindex$';
		$viewavaluo_grid->LoadRowValues();

		// Set row properties
		$viewavaluo->ResetAttrs();
		$viewavaluo->RowAttrs = array_merge($viewavaluo->RowAttrs, array('data-rowindex'=>$viewavaluo_grid->RowIndex, 'id'=>'r0_viewavaluo', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($viewavaluo->RowAttrs["class"], "ewTemplate");
		$viewavaluo->RowType = EW_ROWTYPE_ADD;

		// Render row
		$viewavaluo_grid->RenderRow();

		// Render list options
		$viewavaluo_grid->RenderListOptions();
		$viewavaluo_grid->StartRowCnt = 0;
?>
	<tr<?php echo $viewavaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewavaluo_grid->ListOptions->Render("body", "left", $viewavaluo_grid->RowIndex);
?>
	<?php if ($viewavaluo->tipoinmueble->Visible) { // tipoinmueble ?>
		<td data-name="tipoinmueble">
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluo_tipoinmueble" class="form-group viewavaluo_tipoinmueble">
<select data-table="viewavaluo" data-field="x_tipoinmueble" data-value-separator="<?php echo $viewavaluo->tipoinmueble->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" name="x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble"<?php echo $viewavaluo->tipoinmueble->EditAttributes() ?>>
<?php echo $viewavaluo->tipoinmueble->SelectOptionListHtml("x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluo_tipoinmueble" class="form-group viewavaluo_tipoinmueble">
<span<?php echo $viewavaluo->tipoinmueble->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->tipoinmueble->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_tipoinmueble" name="x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" id="x<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluo->tipoinmueble->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluo" data-field="x_tipoinmueble" name="o<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" id="o<?php echo $viewavaluo_grid->RowIndex ?>_tipoinmueble" value="<?php echo ew_HtmlEncode($viewavaluo->tipoinmueble->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluo->codigoavaluo->Visible) { // codigoavaluo ?>
		<td data-name="codigoavaluo">
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluo_codigoavaluo" class="form-group viewavaluo_codigoavaluo">
<input type="text" data-table="viewavaluo" data-field="x_codigoavaluo" name="x<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" size="30" maxlength="50" placeholder="<?php echo ew_HtmlEncode($viewavaluo->codigoavaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->codigoavaluo->EditValue ?>"<?php echo $viewavaluo->codigoavaluo->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluo_codigoavaluo" class="form-group viewavaluo_codigoavaluo">
<span<?php echo $viewavaluo->codigoavaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->codigoavaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_codigoavaluo" name="x<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" id="x<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluo->codigoavaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluo" data-field="x_codigoavaluo" name="o<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" id="o<?php echo $viewavaluo_grid->RowIndex ?>_codigoavaluo" value="<?php echo ew_HtmlEncode($viewavaluo->codigoavaluo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluo->id_solicitud->Visible) { // id_solicitud ?>
		<td data-name="id_solicitud">
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<?php if ($viewavaluo->id_solicitud->getSessionValue() <> "") { ?>
<span id="el$rowindex$_viewavaluo_id_solicitud" class="form-group viewavaluo_id_solicitud">
<span<?php echo $viewavaluo->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluo->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_viewavaluo_id_solicitud" class="form-group viewavaluo_id_solicitud">
<select data-table="viewavaluo" data-field="x_id_solicitud" data-value-separator="<?php echo $viewavaluo->id_solicitud->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud"<?php echo $viewavaluo->id_solicitud->EditAttributes() ?>>
<?php echo $viewavaluo->id_solicitud->SelectOptionListHtml("x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_viewavaluo_id_solicitud" class="form-group viewavaluo_id_solicitud">
<span<?php echo $viewavaluo->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_id_solicitud" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluo->id_solicitud->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_solicitud" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluo->id_solicitud->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluo->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<td data-name="id_oficialcredito">
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluo_id_oficialcredito" class="form-group viewavaluo_id_oficialcredito">
<select data-table="viewavaluo" data-field="x_id_oficialcredito" data-value-separator="<?php echo $viewavaluo->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito"<?php echo $viewavaluo->id_oficialcredito->EditAttributes() ?>>
<?php echo $viewavaluo->id_oficialcredito->SelectOptionListHtml("x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluo_id_oficialcredito" class="form-group viewavaluo_id_oficialcredito">
<span<?php echo $viewavaluo->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->id_oficialcredito->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_id_oficialcredito" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluo->id_oficialcredito->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_oficialcredito" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluo->id_oficialcredito->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluo->id_inspector->Visible) { // id_inspector ?>
		<td data-name="id_inspector">
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluo_id_inspector" class="form-group viewavaluo_id_inspector">
<select data-table="viewavaluo" data-field="x_id_inspector" data-value-separator="<?php echo $viewavaluo->id_inspector->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector"<?php echo $viewavaluo->id_inspector->EditAttributes() ?>>
<?php echo $viewavaluo->id_inspector->SelectOptionListHtml("x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluo_id_inspector" class="form-group viewavaluo_id_inspector">
<span<?php echo $viewavaluo->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->id_inspector->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_id_inspector" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluo->id_inspector->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_inspector" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluo->id_inspector->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluo->id_cliente->Visible) { // id_cliente ?>
		<td data-name="id_cliente">
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluo_id_cliente" class="form-group viewavaluo_id_cliente">
<input type="text" data-table="viewavaluo" data-field="x_id_cliente" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluo->id_cliente->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->id_cliente->EditValue ?>"<?php echo $viewavaluo->id_cliente->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluo_id_cliente" class="form-group viewavaluo_id_cliente">
<span<?php echo $viewavaluo->id_cliente->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->id_cliente->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_id_cliente" name="x<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluo->id_cliente->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluo" data-field="x_id_cliente" name="o<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" id="o<?php echo $viewavaluo_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluo->id_cliente->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluo->estado->Visible) { // estado ?>
		<td data-name="estado">
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluo_estado" class="form-group viewavaluo_estado">
<input type="text" data-table="viewavaluo" data-field="x_estado" name="x<?php echo $viewavaluo_grid->RowIndex ?>_estado" id="x<?php echo $viewavaluo_grid->RowIndex ?>_estado" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluo->estado->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->estado->EditValue ?>"<?php echo $viewavaluo->estado->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluo_estado" class="form-group viewavaluo_estado">
<span<?php echo $viewavaluo->estado->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->estado->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_estado" name="x<?php echo $viewavaluo_grid->RowIndex ?>_estado" id="x<?php echo $viewavaluo_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluo->estado->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluo" data-field="x_estado" name="o<?php echo $viewavaluo_grid->RowIndex ?>_estado" id="o<?php echo $viewavaluo_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluo->estado->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluo->estadopago->Visible) { // estadopago ?>
		<td data-name="estadopago">
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluo_estadopago" class="form-group viewavaluo_estadopago">
<input type="text" data-table="viewavaluo" data-field="x_estadopago" name="x<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" id="x<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluo->estadopago->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->estadopago->EditValue ?>"<?php echo $viewavaluo->estadopago->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluo_estadopago" class="form-group viewavaluo_estadopago">
<span<?php echo $viewavaluo->estadopago->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->estadopago->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_estadopago" name="x<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" id="x<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluo->estadopago->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluo" data-field="x_estadopago" name="o<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" id="o<?php echo $viewavaluo_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluo->estadopago->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluo->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<td data-name="fecha_avaluo">
<?php if ($viewavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluo_fecha_avaluo" class="form-group viewavaluo_fecha_avaluo">
<input type="text" data-table="viewavaluo" data-field="x_fecha_avaluo" name="x<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($viewavaluo->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluo->fecha_avaluo->EditValue ?>"<?php echo $viewavaluo->fecha_avaluo->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluo_fecha_avaluo" class="form-group viewavaluo_fecha_avaluo">
<span<?php echo $viewavaluo->fecha_avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluo->fecha_avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluo" data-field="x_fecha_avaluo" name="x<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluo->fecha_avaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluo" data-field="x_fecha_avaluo" name="o<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" id="o<?php echo $viewavaluo_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluo->fecha_avaluo->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewavaluo_grid->ListOptions->Render("body", "right", $viewavaluo_grid->RowIndex);
?>
<script type="text/javascript">
fviewavaluogrid.UpdateOpts(<?php echo $viewavaluo_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($viewavaluo->CurrentMode == "add" || $viewavaluo->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $viewavaluo_grid->FormKeyCountName ?>" id="<?php echo $viewavaluo_grid->FormKeyCountName ?>" value="<?php echo $viewavaluo_grid->KeyCount ?>">
<?php echo $viewavaluo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewavaluo->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $viewavaluo_grid->FormKeyCountName ?>" id="<?php echo $viewavaluo_grid->FormKeyCountName ?>" value="<?php echo $viewavaluo_grid->KeyCount ?>">
<?php echo $viewavaluo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewavaluo->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fviewavaluogrid">
</div>
<?php

// Close recordset
if ($viewavaluo_grid->Recordset)
	$viewavaluo_grid->Recordset->Close();
?>
<?php if ($viewavaluo_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($viewavaluo_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($viewavaluo_grid->TotalRecs == 0 && $viewavaluo->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewavaluo_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($viewavaluo->Export == "") { ?>
<script type="text/javascript">
fviewavaluogrid.Init();
</script>
<?php } ?>
<?php
$viewavaluo_grid->Page_Terminate();
?>
