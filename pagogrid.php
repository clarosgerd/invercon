<?php include_once "usuarioinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($pago_grid)) $pago_grid = new cpago_grid();

// Page init
$pago_grid->Page_Init();

// Page main
$pago_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pago_grid->Page_Render();
?>
<?php if ($pago->Export == "") { ?>
<script type="text/javascript">

// Form object
var fpagogrid = new ew_Form("fpagogrid", "grid");
fpagogrid.FormKeyCountName = '<?php echo $pago_grid->FormKeyCountName ?>';

// Validate form
fpagogrid.Validate = function() {
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

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fpagogrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "code", false)) return false;
	if (ew_ValueChanged(fobj, infix, "cliente_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "status_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "metodopago_id", false)) return false;
	return true;
}

// Form_CustomValidate event
fpagogrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpagogrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fpagogrid.Lists["x_cliente_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cliente"};
fpagogrid.Lists["x_cliente_id"].Data = "<?php echo $pago_grid->cliente_id->LookupFilterQuery(FALSE, "grid") ?>";
fpagogrid.Lists["x_status_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadopago"};
fpagogrid.Lists["x_status_id"].Data = "<?php echo $pago_grid->status_id->LookupFilterQuery(FALSE, "grid") ?>";
fpagogrid.Lists["x_metodopago_id"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_short_name","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"metodopago"};
fpagogrid.Lists["x_metodopago_id"].Data = "<?php echo $pago_grid->metodopago_id->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($pago->CurrentAction == "gridadd") {
	if ($pago->CurrentMode == "copy") {
		$bSelectLimit = $pago_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$pago_grid->TotalRecs = $pago->ListRecordCount();
			$pago_grid->Recordset = $pago_grid->LoadRecordset($pago_grid->StartRec-1, $pago_grid->DisplayRecs);
		} else {
			if ($pago_grid->Recordset = $pago_grid->LoadRecordset())
				$pago_grid->TotalRecs = $pago_grid->Recordset->RecordCount();
		}
		$pago_grid->StartRec = 1;
		$pago_grid->DisplayRecs = $pago_grid->TotalRecs;
	} else {
		$pago->CurrentFilter = "0=1";
		$pago_grid->StartRec = 1;
		$pago_grid->DisplayRecs = $pago->GridAddRowCount;
	}
	$pago_grid->TotalRecs = $pago_grid->DisplayRecs;
	$pago_grid->StopRec = $pago_grid->DisplayRecs;
} else {
	$bSelectLimit = $pago_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($pago_grid->TotalRecs <= 0)
			$pago_grid->TotalRecs = $pago->ListRecordCount();
	} else {
		if (!$pago_grid->Recordset && ($pago_grid->Recordset = $pago_grid->LoadRecordset()))
			$pago_grid->TotalRecs = $pago_grid->Recordset->RecordCount();
	}
	$pago_grid->StartRec = 1;
	$pago_grid->DisplayRecs = $pago_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$pago_grid->Recordset = $pago_grid->LoadRecordset($pago_grid->StartRec-1, $pago_grid->DisplayRecs);

	// Set no record found message
	if ($pago->CurrentAction == "" && $pago_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$pago_grid->setWarningMessage(ew_DeniedMsg());
		if ($pago_grid->SearchWhere == "0=101")
			$pago_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$pago_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$pago_grid->RenderOtherOptions();
?>
<?php $pago_grid->ShowPageHeader(); ?>
<?php
$pago_grid->ShowMessage();
?>
<?php if ($pago_grid->TotalRecs > 0 || $pago->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($pago_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> pago">
<div id="fpagogrid" class="ewForm ewListForm form-inline">
<div id="gmp_pago" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_pagogrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$pago_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$pago_grid->RenderListOptions();

// Render list options (header, left)
$pago_grid->ListOptions->Render("header", "left");
?>
<?php if ($pago->id->Visible) { // id ?>
	<?php if ($pago->SortUrl($pago->id) == "") { ?>
		<th data-name="id" class="<?php echo $pago->id->HeaderCellClass() ?>"><div id="elh_pago_id" class="pago_id"><div class="ewTableHeaderCaption"><?php echo $pago->id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $pago->id->HeaderCellClass() ?>"><div><div id="elh_pago_id" class="pago_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago->id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago->code->Visible) { // code ?>
	<?php if ($pago->SortUrl($pago->code) == "") { ?>
		<th data-name="code" class="<?php echo $pago->code->HeaderCellClass() ?>"><div id="elh_pago_code" class="pago_code"><div class="ewTableHeaderCaption"><?php echo $pago->code->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="code" class="<?php echo $pago->code->HeaderCellClass() ?>"><div><div id="elh_pago_code" class="pago_code">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago->code->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago->code->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago->code->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago->cliente_id->Visible) { // cliente_id ?>
	<?php if ($pago->SortUrl($pago->cliente_id) == "") { ?>
		<th data-name="cliente_id" class="<?php echo $pago->cliente_id->HeaderCellClass() ?>"><div id="elh_pago_cliente_id" class="pago_cliente_id"><div class="ewTableHeaderCaption"><?php echo $pago->cliente_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="cliente_id" class="<?php echo $pago->cliente_id->HeaderCellClass() ?>"><div><div id="elh_pago_cliente_id" class="pago_cliente_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago->cliente_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago->cliente_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago->cliente_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago->status_id->Visible) { // status_id ?>
	<?php if ($pago->SortUrl($pago->status_id) == "") { ?>
		<th data-name="status_id" class="<?php echo $pago->status_id->HeaderCellClass() ?>"><div id="elh_pago_status_id" class="pago_status_id"><div class="ewTableHeaderCaption"><?php echo $pago->status_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="status_id" class="<?php echo $pago->status_id->HeaderCellClass() ?>"><div><div id="elh_pago_status_id" class="pago_status_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago->status_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago->status_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago->status_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago->created_at->Visible) { // created_at ?>
	<?php if ($pago->SortUrl($pago->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $pago->created_at->HeaderCellClass() ?>"><div id="elh_pago_created_at" class="pago_created_at"><div class="ewTableHeaderCaption"><?php echo $pago->created_at->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $pago->created_at->HeaderCellClass() ?>"><div><div id="elh_pago_created_at" class="pago_created_at">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago->created_at->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago->created_at->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago->created_at->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago->metodopago_id->Visible) { // metodopago_id ?>
	<?php if ($pago->SortUrl($pago->metodopago_id) == "") { ?>
		<th data-name="metodopago_id" class="<?php echo $pago->metodopago_id->HeaderCellClass() ?>"><div id="elh_pago_metodopago_id" class="pago_metodopago_id"><div class="ewTableHeaderCaption"><?php echo $pago->metodopago_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="metodopago_id" class="<?php echo $pago->metodopago_id->HeaderCellClass() ?>"><div><div id="elh_pago_metodopago_id" class="pago_metodopago_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago->metodopago_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago->metodopago_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago->metodopago_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pago_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$pago_grid->StartRec = 1;
$pago_grid->StopRec = $pago_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($pago_grid->FormKeyCountName) && ($pago->CurrentAction == "gridadd" || $pago->CurrentAction == "gridedit" || $pago->CurrentAction == "F")) {
		$pago_grid->KeyCount = $objForm->GetValue($pago_grid->FormKeyCountName);
		$pago_grid->StopRec = $pago_grid->StartRec + $pago_grid->KeyCount - 1;
	}
}
$pago_grid->RecCnt = $pago_grid->StartRec - 1;
if ($pago_grid->Recordset && !$pago_grid->Recordset->EOF) {
	$pago_grid->Recordset->MoveFirst();
	$bSelectLimit = $pago_grid->UseSelectLimit;
	if (!$bSelectLimit && $pago_grid->StartRec > 1)
		$pago_grid->Recordset->Move($pago_grid->StartRec - 1);
} elseif (!$pago->AllowAddDeleteRow && $pago_grid->StopRec == 0) {
	$pago_grid->StopRec = $pago->GridAddRowCount;
}

// Initialize aggregate
$pago->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pago->ResetAttrs();
$pago_grid->RenderRow();
if ($pago->CurrentAction == "gridadd")
	$pago_grid->RowIndex = 0;
if ($pago->CurrentAction == "gridedit")
	$pago_grid->RowIndex = 0;
while ($pago_grid->RecCnt < $pago_grid->StopRec) {
	$pago_grid->RecCnt++;
	if (intval($pago_grid->RecCnt) >= intval($pago_grid->StartRec)) {
		$pago_grid->RowCnt++;
		if ($pago->CurrentAction == "gridadd" || $pago->CurrentAction == "gridedit" || $pago->CurrentAction == "F") {
			$pago_grid->RowIndex++;
			$objForm->Index = $pago_grid->RowIndex;
			if ($objForm->HasValue($pago_grid->FormActionName))
				$pago_grid->RowAction = strval($objForm->GetValue($pago_grid->FormActionName));
			elseif ($pago->CurrentAction == "gridadd")
				$pago_grid->RowAction = "insert";
			else
				$pago_grid->RowAction = "";
		}

		// Set up key count
		$pago_grid->KeyCount = $pago_grid->RowIndex;

		// Init row class and style
		$pago->ResetAttrs();
		$pago->CssClass = "";
		if ($pago->CurrentAction == "gridadd") {
			if ($pago->CurrentMode == "copy") {
				$pago_grid->LoadRowValues($pago_grid->Recordset); // Load row values
				$pago_grid->SetRecordKey($pago_grid->RowOldKey, $pago_grid->Recordset); // Set old record key
			} else {
				$pago_grid->LoadRowValues(); // Load default values
				$pago_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$pago_grid->LoadRowValues($pago_grid->Recordset); // Load row values
		}
		$pago->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($pago->CurrentAction == "gridadd") // Grid add
			$pago->RowType = EW_ROWTYPE_ADD; // Render add
		if ($pago->CurrentAction == "gridadd" && $pago->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$pago_grid->RestoreCurrentRowFormValues($pago_grid->RowIndex); // Restore form values
		if ($pago->CurrentAction == "gridedit") { // Grid edit
			if ($pago->EventCancelled) {
				$pago_grid->RestoreCurrentRowFormValues($pago_grid->RowIndex); // Restore form values
			}
			if ($pago_grid->RowAction == "insert")
				$pago->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$pago->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($pago->CurrentAction == "gridedit" && ($pago->RowType == EW_ROWTYPE_EDIT || $pago->RowType == EW_ROWTYPE_ADD) && $pago->EventCancelled) // Update failed
			$pago_grid->RestoreCurrentRowFormValues($pago_grid->RowIndex); // Restore form values
		if ($pago->RowType == EW_ROWTYPE_EDIT) // Edit row
			$pago_grid->EditRowCnt++;
		if ($pago->CurrentAction == "F") // Confirm row
			$pago_grid->RestoreCurrentRowFormValues($pago_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$pago->RowAttrs = array_merge($pago->RowAttrs, array('data-rowindex'=>$pago_grid->RowCnt, 'id'=>'r' . $pago_grid->RowCnt . '_pago', 'data-rowtype'=>$pago->RowType));

		// Render row
		$pago_grid->RenderRow();

		// Render list options
		$pago_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($pago_grid->RowAction <> "delete" && $pago_grid->RowAction <> "insertdelete" && !($pago_grid->RowAction == "insert" && $pago->CurrentAction == "F" && $pago_grid->EmptyRow())) {
?>
	<tr<?php echo $pago->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pago_grid->ListOptions->Render("body", "left", $pago_grid->RowCnt);
?>
	<?php if ($pago->id->Visible) { // id ?>
		<td data-name="id"<?php echo $pago->id->CellAttributes() ?>>
<?php if ($pago->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="pago" data-field="x_id" name="o<?php echo $pago_grid->RowIndex ?>_id" id="o<?php echo $pago_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago->id->OldValue) ?>">
<?php } ?>
<?php if ($pago->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_id" class="form-group pago_id">
<span<?php echo $pago->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="pago" data-field="x_id" name="x<?php echo $pago_grid->RowIndex ?>_id" id="x<?php echo $pago_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago->id->CurrentValue) ?>">
<?php } ?>
<?php if ($pago->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_id" class="pago_id">
<span<?php echo $pago->id->ViewAttributes() ?>>
<?php echo $pago->id->ListViewValue() ?></span>
</span>
<?php if ($pago->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago" data-field="x_id" name="x<?php echo $pago_grid->RowIndex ?>_id" id="x<?php echo $pago_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago->id->FormValue) ?>">
<input type="hidden" data-table="pago" data-field="x_id" name="o<?php echo $pago_grid->RowIndex ?>_id" id="o<?php echo $pago_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago" data-field="x_id" name="fpagogrid$x<?php echo $pago_grid->RowIndex ?>_id" id="fpagogrid$x<?php echo $pago_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago->id->FormValue) ?>">
<input type="hidden" data-table="pago" data-field="x_id" name="fpagogrid$o<?php echo $pago_grid->RowIndex ?>_id" id="fpagogrid$o<?php echo $pago_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago->code->Visible) { // code ?>
		<td data-name="code"<?php echo $pago->code->CellAttributes() ?>>
<?php if ($pago->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_code" class="form-group pago_code">
<input type="text" data-table="pago" data-field="x_code" name="x<?php echo $pago_grid->RowIndex ?>_code" id="x<?php echo $pago_grid->RowIndex ?>_code" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($pago->code->getPlaceHolder()) ?>" value="<?php echo $pago->code->EditValue ?>"<?php echo $pago->code->EditAttributes() ?>>
</span>
<input type="hidden" data-table="pago" data-field="x_code" name="o<?php echo $pago_grid->RowIndex ?>_code" id="o<?php echo $pago_grid->RowIndex ?>_code" value="<?php echo ew_HtmlEncode($pago->code->OldValue) ?>">
<?php } ?>
<?php if ($pago->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_code" class="form-group pago_code">
<input type="text" data-table="pago" data-field="x_code" name="x<?php echo $pago_grid->RowIndex ?>_code" id="x<?php echo $pago_grid->RowIndex ?>_code" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($pago->code->getPlaceHolder()) ?>" value="<?php echo $pago->code->EditValue ?>"<?php echo $pago->code->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($pago->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_code" class="pago_code">
<span<?php echo $pago->code->ViewAttributes() ?>>
<?php echo $pago->code->ListViewValue() ?></span>
</span>
<?php if ($pago->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago" data-field="x_code" name="x<?php echo $pago_grid->RowIndex ?>_code" id="x<?php echo $pago_grid->RowIndex ?>_code" value="<?php echo ew_HtmlEncode($pago->code->FormValue) ?>">
<input type="hidden" data-table="pago" data-field="x_code" name="o<?php echo $pago_grid->RowIndex ?>_code" id="o<?php echo $pago_grid->RowIndex ?>_code" value="<?php echo ew_HtmlEncode($pago->code->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago" data-field="x_code" name="fpagogrid$x<?php echo $pago_grid->RowIndex ?>_code" id="fpagogrid$x<?php echo $pago_grid->RowIndex ?>_code" value="<?php echo ew_HtmlEncode($pago->code->FormValue) ?>">
<input type="hidden" data-table="pago" data-field="x_code" name="fpagogrid$o<?php echo $pago_grid->RowIndex ?>_code" id="fpagogrid$o<?php echo $pago_grid->RowIndex ?>_code" value="<?php echo ew_HtmlEncode($pago->code->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago->cliente_id->Visible) { // cliente_id ?>
		<td data-name="cliente_id"<?php echo $pago->cliente_id->CellAttributes() ?>>
<?php if ($pago->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($pago->cliente_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_cliente_id" class="form-group pago_cliente_id">
<span<?php echo $pago->cliente_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago->cliente_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_grid->RowIndex ?>_cliente_id" name="x<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo ew_HtmlEncode($pago->cliente_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_cliente_id" class="form-group pago_cliente_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $pago_grid->RowIndex ?>_cliente_id"><?php echo (strval($pago->cliente_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $pago->cliente_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pago->cliente_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $pago_grid->RowIndex ?>_cliente_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($pago->cliente_id->ReadOnly || $pago->cliente_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="pago" data-field="x_cliente_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pago->cliente_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $pago_grid->RowIndex ?>_cliente_id" id="x<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo $pago->cliente_id->CurrentValue ?>"<?php echo $pago->cliente_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "cliente") && !$pago->cliente_id->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $pago->cliente_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $pago_grid->RowIndex ?>_cliente_id',url:'clienteaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $pago_grid->RowIndex ?>_cliente_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $pago->cliente_id->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } ?>
<input type="hidden" data-table="pago" data-field="x_cliente_id" name="o<?php echo $pago_grid->RowIndex ?>_cliente_id" id="o<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo ew_HtmlEncode($pago->cliente_id->OldValue) ?>">
<?php } ?>
<?php if ($pago->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($pago->cliente_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_cliente_id" class="form-group pago_cliente_id">
<span<?php echo $pago->cliente_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago->cliente_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_grid->RowIndex ?>_cliente_id" name="x<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo ew_HtmlEncode($pago->cliente_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_cliente_id" class="form-group pago_cliente_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $pago_grid->RowIndex ?>_cliente_id"><?php echo (strval($pago->cliente_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $pago->cliente_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pago->cliente_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $pago_grid->RowIndex ?>_cliente_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($pago->cliente_id->ReadOnly || $pago->cliente_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="pago" data-field="x_cliente_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pago->cliente_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $pago_grid->RowIndex ?>_cliente_id" id="x<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo $pago->cliente_id->CurrentValue ?>"<?php echo $pago->cliente_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "cliente") && !$pago->cliente_id->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $pago->cliente_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $pago_grid->RowIndex ?>_cliente_id',url:'clienteaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $pago_grid->RowIndex ?>_cliente_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $pago->cliente_id->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } ?>
<?php } ?>
<?php if ($pago->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_cliente_id" class="pago_cliente_id">
<span<?php echo $pago->cliente_id->ViewAttributes() ?>>
<?php echo $pago->cliente_id->ListViewValue() ?></span>
</span>
<?php if ($pago->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago" data-field="x_cliente_id" name="x<?php echo $pago_grid->RowIndex ?>_cliente_id" id="x<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo ew_HtmlEncode($pago->cliente_id->FormValue) ?>">
<input type="hidden" data-table="pago" data-field="x_cliente_id" name="o<?php echo $pago_grid->RowIndex ?>_cliente_id" id="o<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo ew_HtmlEncode($pago->cliente_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago" data-field="x_cliente_id" name="fpagogrid$x<?php echo $pago_grid->RowIndex ?>_cliente_id" id="fpagogrid$x<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo ew_HtmlEncode($pago->cliente_id->FormValue) ?>">
<input type="hidden" data-table="pago" data-field="x_cliente_id" name="fpagogrid$o<?php echo $pago_grid->RowIndex ?>_cliente_id" id="fpagogrid$o<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo ew_HtmlEncode($pago->cliente_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago->status_id->Visible) { // status_id ?>
		<td data-name="status_id"<?php echo $pago->status_id->CellAttributes() ?>>
<?php if ($pago->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_status_id" class="form-group pago_status_id">
<select data-table="pago" data-field="x_status_id" data-value-separator="<?php echo $pago->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $pago_grid->RowIndex ?>_status_id" name="x<?php echo $pago_grid->RowIndex ?>_status_id"<?php echo $pago->status_id->EditAttributes() ?>>
<?php echo $pago->status_id->SelectOptionListHtml("x<?php echo $pago_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<input type="hidden" data-table="pago" data-field="x_status_id" name="o<?php echo $pago_grid->RowIndex ?>_status_id" id="o<?php echo $pago_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($pago->status_id->OldValue) ?>">
<?php } ?>
<?php if ($pago->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_status_id" class="form-group pago_status_id">
<select data-table="pago" data-field="x_status_id" data-value-separator="<?php echo $pago->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $pago_grid->RowIndex ?>_status_id" name="x<?php echo $pago_grid->RowIndex ?>_status_id"<?php echo $pago->status_id->EditAttributes() ?>>
<?php echo $pago->status_id->SelectOptionListHtml("x<?php echo $pago_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<?php } ?>
<?php if ($pago->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_status_id" class="pago_status_id">
<span<?php echo $pago->status_id->ViewAttributes() ?>>
<?php echo $pago->status_id->ListViewValue() ?></span>
</span>
<?php if ($pago->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago" data-field="x_status_id" name="x<?php echo $pago_grid->RowIndex ?>_status_id" id="x<?php echo $pago_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($pago->status_id->FormValue) ?>">
<input type="hidden" data-table="pago" data-field="x_status_id" name="o<?php echo $pago_grid->RowIndex ?>_status_id" id="o<?php echo $pago_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($pago->status_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago" data-field="x_status_id" name="fpagogrid$x<?php echo $pago_grid->RowIndex ?>_status_id" id="fpagogrid$x<?php echo $pago_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($pago->status_id->FormValue) ?>">
<input type="hidden" data-table="pago" data-field="x_status_id" name="fpagogrid$o<?php echo $pago_grid->RowIndex ?>_status_id" id="fpagogrid$o<?php echo $pago_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($pago->status_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago->created_at->Visible) { // created_at ?>
		<td data-name="created_at"<?php echo $pago->created_at->CellAttributes() ?>>
<?php if ($pago->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="pago" data-field="x_created_at" name="o<?php echo $pago_grid->RowIndex ?>_created_at" id="o<?php echo $pago_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($pago->created_at->OldValue) ?>">
<?php } ?>
<?php if ($pago->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php } ?>
<?php if ($pago->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_created_at" class="pago_created_at">
<span<?php echo $pago->created_at->ViewAttributes() ?>>
<?php echo $pago->created_at->ListViewValue() ?></span>
</span>
<?php if ($pago->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago" data-field="x_created_at" name="x<?php echo $pago_grid->RowIndex ?>_created_at" id="x<?php echo $pago_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($pago->created_at->FormValue) ?>">
<input type="hidden" data-table="pago" data-field="x_created_at" name="o<?php echo $pago_grid->RowIndex ?>_created_at" id="o<?php echo $pago_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($pago->created_at->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago" data-field="x_created_at" name="fpagogrid$x<?php echo $pago_grid->RowIndex ?>_created_at" id="fpagogrid$x<?php echo $pago_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($pago->created_at->FormValue) ?>">
<input type="hidden" data-table="pago" data-field="x_created_at" name="fpagogrid$o<?php echo $pago_grid->RowIndex ?>_created_at" id="fpagogrid$o<?php echo $pago_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($pago->created_at->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago->metodopago_id->Visible) { // metodopago_id ?>
		<td data-name="metodopago_id"<?php echo $pago->metodopago_id->CellAttributes() ?>>
<?php if ($pago->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_metodopago_id" class="form-group pago_metodopago_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $pago_grid->RowIndex ?>_metodopago_id"><?php echo (strval($pago->metodopago_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $pago->metodopago_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pago->metodopago_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $pago_grid->RowIndex ?>_metodopago_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($pago->metodopago_id->ReadOnly || $pago->metodopago_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="pago" data-field="x_metodopago_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pago->metodopago_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $pago_grid->RowIndex ?>_metodopago_id" id="x<?php echo $pago_grid->RowIndex ?>_metodopago_id" value="<?php echo $pago->metodopago_id->CurrentValue ?>"<?php echo $pago->metodopago_id->EditAttributes() ?>>
</span>
<input type="hidden" data-table="pago" data-field="x_metodopago_id" name="o<?php echo $pago_grid->RowIndex ?>_metodopago_id" id="o<?php echo $pago_grid->RowIndex ?>_metodopago_id" value="<?php echo ew_HtmlEncode($pago->metodopago_id->OldValue) ?>">
<?php } ?>
<?php if ($pago->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_metodopago_id" class="form-group pago_metodopago_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $pago_grid->RowIndex ?>_metodopago_id"><?php echo (strval($pago->metodopago_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $pago->metodopago_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pago->metodopago_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $pago_grid->RowIndex ?>_metodopago_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($pago->metodopago_id->ReadOnly || $pago->metodopago_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="pago" data-field="x_metodopago_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pago->metodopago_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $pago_grid->RowIndex ?>_metodopago_id" id="x<?php echo $pago_grid->RowIndex ?>_metodopago_id" value="<?php echo $pago->metodopago_id->CurrentValue ?>"<?php echo $pago->metodopago_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($pago->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_grid->RowCnt ?>_pago_metodopago_id" class="pago_metodopago_id">
<span<?php echo $pago->metodopago_id->ViewAttributes() ?>>
<?php echo $pago->metodopago_id->ListViewValue() ?></span>
</span>
<?php if ($pago->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago" data-field="x_metodopago_id" name="x<?php echo $pago_grid->RowIndex ?>_metodopago_id" id="x<?php echo $pago_grid->RowIndex ?>_metodopago_id" value="<?php echo ew_HtmlEncode($pago->metodopago_id->FormValue) ?>">
<input type="hidden" data-table="pago" data-field="x_metodopago_id" name="o<?php echo $pago_grid->RowIndex ?>_metodopago_id" id="o<?php echo $pago_grid->RowIndex ?>_metodopago_id" value="<?php echo ew_HtmlEncode($pago->metodopago_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago" data-field="x_metodopago_id" name="fpagogrid$x<?php echo $pago_grid->RowIndex ?>_metodopago_id" id="fpagogrid$x<?php echo $pago_grid->RowIndex ?>_metodopago_id" value="<?php echo ew_HtmlEncode($pago->metodopago_id->FormValue) ?>">
<input type="hidden" data-table="pago" data-field="x_metodopago_id" name="fpagogrid$o<?php echo $pago_grid->RowIndex ?>_metodopago_id" id="fpagogrid$o<?php echo $pago_grid->RowIndex ?>_metodopago_id" value="<?php echo ew_HtmlEncode($pago->metodopago_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pago_grid->ListOptions->Render("body", "right", $pago_grid->RowCnt);
?>
	</tr>
<?php if ($pago->RowType == EW_ROWTYPE_ADD || $pago->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fpagogrid.UpdateOpts(<?php echo $pago_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($pago->CurrentAction <> "gridadd" || $pago->CurrentMode == "copy")
		if (!$pago_grid->Recordset->EOF) $pago_grid->Recordset->MoveNext();
}
?>
<?php
	if ($pago->CurrentMode == "add" || $pago->CurrentMode == "copy" || $pago->CurrentMode == "edit") {
		$pago_grid->RowIndex = '$rowindex$';
		$pago_grid->LoadRowValues();

		// Set row properties
		$pago->ResetAttrs();
		$pago->RowAttrs = array_merge($pago->RowAttrs, array('data-rowindex'=>$pago_grid->RowIndex, 'id'=>'r0_pago', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($pago->RowAttrs["class"], "ewTemplate");
		$pago->RowType = EW_ROWTYPE_ADD;

		// Render row
		$pago_grid->RenderRow();

		// Render list options
		$pago_grid->RenderListOptions();
		$pago_grid->StartRowCnt = 0;
?>
	<tr<?php echo $pago->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pago_grid->ListOptions->Render("body", "left", $pago_grid->RowIndex);
?>
	<?php if ($pago->id->Visible) { // id ?>
		<td data-name="id">
<?php if ($pago->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_pago_id" class="form-group pago_id">
<span<?php echo $pago->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago->id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago" data-field="x_id" name="x<?php echo $pago_grid->RowIndex ?>_id" id="x<?php echo $pago_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago" data-field="x_id" name="o<?php echo $pago_grid->RowIndex ?>_id" id="o<?php echo $pago_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago->code->Visible) { // code ?>
		<td data-name="code">
<?php if ($pago->CurrentAction <> "F") { ?>
<span id="el$rowindex$_pago_code" class="form-group pago_code">
<input type="text" data-table="pago" data-field="x_code" name="x<?php echo $pago_grid->RowIndex ?>_code" id="x<?php echo $pago_grid->RowIndex ?>_code" size="30" maxlength="20" placeholder="<?php echo ew_HtmlEncode($pago->code->getPlaceHolder()) ?>" value="<?php echo $pago->code->EditValue ?>"<?php echo $pago->code->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_pago_code" class="form-group pago_code">
<span<?php echo $pago->code->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago->code->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago" data-field="x_code" name="x<?php echo $pago_grid->RowIndex ?>_code" id="x<?php echo $pago_grid->RowIndex ?>_code" value="<?php echo ew_HtmlEncode($pago->code->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago" data-field="x_code" name="o<?php echo $pago_grid->RowIndex ?>_code" id="o<?php echo $pago_grid->RowIndex ?>_code" value="<?php echo ew_HtmlEncode($pago->code->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago->cliente_id->Visible) { // cliente_id ?>
		<td data-name="cliente_id">
<?php if ($pago->CurrentAction <> "F") { ?>
<?php if ($pago->cliente_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_pago_cliente_id" class="form-group pago_cliente_id">
<span<?php echo $pago->cliente_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago->cliente_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_grid->RowIndex ?>_cliente_id" name="x<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo ew_HtmlEncode($pago->cliente_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_pago_cliente_id" class="form-group pago_cliente_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $pago_grid->RowIndex ?>_cliente_id"><?php echo (strval($pago->cliente_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $pago->cliente_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pago->cliente_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $pago_grid->RowIndex ?>_cliente_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($pago->cliente_id->ReadOnly || $pago->cliente_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="pago" data-field="x_cliente_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pago->cliente_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $pago_grid->RowIndex ?>_cliente_id" id="x<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo $pago->cliente_id->CurrentValue ?>"<?php echo $pago->cliente_id->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "cliente") && !$pago->cliente_id->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $pago->cliente_id->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $pago_grid->RowIndex ?>_cliente_id',url:'clienteaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $pago_grid->RowIndex ?>_cliente_id"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $pago->cliente_id->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_pago_cliente_id" class="form-group pago_cliente_id">
<span<?php echo $pago->cliente_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago->cliente_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago" data-field="x_cliente_id" name="x<?php echo $pago_grid->RowIndex ?>_cliente_id" id="x<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo ew_HtmlEncode($pago->cliente_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago" data-field="x_cliente_id" name="o<?php echo $pago_grid->RowIndex ?>_cliente_id" id="o<?php echo $pago_grid->RowIndex ?>_cliente_id" value="<?php echo ew_HtmlEncode($pago->cliente_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago->status_id->Visible) { // status_id ?>
		<td data-name="status_id">
<?php if ($pago->CurrentAction <> "F") { ?>
<span id="el$rowindex$_pago_status_id" class="form-group pago_status_id">
<select data-table="pago" data-field="x_status_id" data-value-separator="<?php echo $pago->status_id->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $pago_grid->RowIndex ?>_status_id" name="x<?php echo $pago_grid->RowIndex ?>_status_id"<?php echo $pago->status_id->EditAttributes() ?>>
<?php echo $pago->status_id->SelectOptionListHtml("x<?php echo $pago_grid->RowIndex ?>_status_id") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_pago_status_id" class="form-group pago_status_id">
<span<?php echo $pago->status_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago->status_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago" data-field="x_status_id" name="x<?php echo $pago_grid->RowIndex ?>_status_id" id="x<?php echo $pago_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($pago->status_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago" data-field="x_status_id" name="o<?php echo $pago_grid->RowIndex ?>_status_id" id="o<?php echo $pago_grid->RowIndex ?>_status_id" value="<?php echo ew_HtmlEncode($pago->status_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago->created_at->Visible) { // created_at ?>
		<td data-name="created_at">
<?php if ($pago->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_pago_created_at" class="form-group pago_created_at">
<span<?php echo $pago->created_at->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago->created_at->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago" data-field="x_created_at" name="x<?php echo $pago_grid->RowIndex ?>_created_at" id="x<?php echo $pago_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($pago->created_at->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago" data-field="x_created_at" name="o<?php echo $pago_grid->RowIndex ?>_created_at" id="o<?php echo $pago_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($pago->created_at->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago->metodopago_id->Visible) { // metodopago_id ?>
		<td data-name="metodopago_id">
<?php if ($pago->CurrentAction <> "F") { ?>
<span id="el$rowindex$_pago_metodopago_id" class="form-group pago_metodopago_id">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $pago_grid->RowIndex ?>_metodopago_id"><?php echo (strval($pago->metodopago_id->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $pago->metodopago_id->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($pago->metodopago_id->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $pago_grid->RowIndex ?>_metodopago_id',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($pago->metodopago_id->ReadOnly || $pago->metodopago_id->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="pago" data-field="x_metodopago_id" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $pago->metodopago_id->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $pago_grid->RowIndex ?>_metodopago_id" id="x<?php echo $pago_grid->RowIndex ?>_metodopago_id" value="<?php echo $pago->metodopago_id->CurrentValue ?>"<?php echo $pago->metodopago_id->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_pago_metodopago_id" class="form-group pago_metodopago_id">
<span<?php echo $pago->metodopago_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago->metodopago_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago" data-field="x_metodopago_id" name="x<?php echo $pago_grid->RowIndex ?>_metodopago_id" id="x<?php echo $pago_grid->RowIndex ?>_metodopago_id" value="<?php echo ew_HtmlEncode($pago->metodopago_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago" data-field="x_metodopago_id" name="o<?php echo $pago_grid->RowIndex ?>_metodopago_id" id="o<?php echo $pago_grid->RowIndex ?>_metodopago_id" value="<?php echo ew_HtmlEncode($pago->metodopago_id->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pago_grid->ListOptions->Render("body", "right", $pago_grid->RowCnt);
?>
<script type="text/javascript">
fpagogrid.UpdateOpts(<?php echo $pago_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($pago->CurrentMode == "add" || $pago->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $pago_grid->FormKeyCountName ?>" id="<?php echo $pago_grid->FormKeyCountName ?>" value="<?php echo $pago_grid->KeyCount ?>">
<?php echo $pago_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($pago->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $pago_grid->FormKeyCountName ?>" id="<?php echo $pago_grid->FormKeyCountName ?>" value="<?php echo $pago_grid->KeyCount ?>">
<?php echo $pago_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($pago->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpagogrid">
</div>
<?php

// Close recordset
if ($pago_grid->Recordset)
	$pago_grid->Recordset->Close();
?>
<?php if ($pago_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($pago_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($pago_grid->TotalRecs == 0 && $pago->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($pago_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($pago->Export == "") { ?>
<script type="text/javascript">
fpagogrid.Init();
</script>
<?php } ?>
<?php
$pago_grid->Page_Terminate();
?>
