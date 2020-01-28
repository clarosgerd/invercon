<?php include_once "usuarioinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($pago_avaluo_grid)) $pago_avaluo_grid = new cpago_avaluo_grid();

// Page init
$pago_avaluo_grid->Page_Init();

// Page main
$pago_avaluo_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$pago_avaluo_grid->Page_Render();
?>
<?php if ($pago_avaluo->Export == "") { ?>
<script type="text/javascript">

// Form object
var fpago_avaluogrid = new ew_Form("fpago_avaluogrid", "grid");
fpago_avaluogrid.FormKeyCountName = '<?php echo $pago_avaluo_grid->FormKeyCountName ?>';

// Validate form
fpago_avaluogrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_pago_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pago_avaluo->pago_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_avaluo_id");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pago_avaluo->avaluo_id->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_q");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pago_avaluo->q->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_id_metodopago");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pago_avaluo->id_metodopago->FldCaption(), $pago_avaluo->id_metodopago->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_id_metodopago");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pago_avaluo->id_metodopago->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_monto");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $pago_avaluo->monto->FldCaption(), $pago_avaluo->monto->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_monto");
			if (elm && !ew_CheckNumber(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pago_avaluo->monto->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_id_banco");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($pago_avaluo->id_banco->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fpago_avaluogrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "pago_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "avaluo_id", false)) return false;
	if (ew_ValueChanged(fobj, infix, "q", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_metodopago", false)) return false;
	if (ew_ValueChanged(fobj, infix, "monto", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_banco", false)) return false;
	return true;
}

// Form_CustomValidate event
fpago_avaluogrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fpago_avaluogrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
// Form object for search

</script>
<?php } ?>
<?php
if ($pago_avaluo->CurrentAction == "gridadd") {
	if ($pago_avaluo->CurrentMode == "copy") {
		$bSelectLimit = $pago_avaluo_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$pago_avaluo_grid->TotalRecs = $pago_avaluo->ListRecordCount();
			$pago_avaluo_grid->Recordset = $pago_avaluo_grid->LoadRecordset($pago_avaluo_grid->StartRec-1, $pago_avaluo_grid->DisplayRecs);
		} else {
			if ($pago_avaluo_grid->Recordset = $pago_avaluo_grid->LoadRecordset())
				$pago_avaluo_grid->TotalRecs = $pago_avaluo_grid->Recordset->RecordCount();
		}
		$pago_avaluo_grid->StartRec = 1;
		$pago_avaluo_grid->DisplayRecs = $pago_avaluo_grid->TotalRecs;
	} else {
		$pago_avaluo->CurrentFilter = "0=1";
		$pago_avaluo_grid->StartRec = 1;
		$pago_avaluo_grid->DisplayRecs = $pago_avaluo->GridAddRowCount;
	}
	$pago_avaluo_grid->TotalRecs = $pago_avaluo_grid->DisplayRecs;
	$pago_avaluo_grid->StopRec = $pago_avaluo_grid->DisplayRecs;
} else {
	$bSelectLimit = $pago_avaluo_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($pago_avaluo_grid->TotalRecs <= 0)
			$pago_avaluo_grid->TotalRecs = $pago_avaluo->ListRecordCount();
	} else {
		if (!$pago_avaluo_grid->Recordset && ($pago_avaluo_grid->Recordset = $pago_avaluo_grid->LoadRecordset()))
			$pago_avaluo_grid->TotalRecs = $pago_avaluo_grid->Recordset->RecordCount();
	}
	$pago_avaluo_grid->StartRec = 1;
	$pago_avaluo_grid->DisplayRecs = $pago_avaluo_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$pago_avaluo_grid->Recordset = $pago_avaluo_grid->LoadRecordset($pago_avaluo_grid->StartRec-1, $pago_avaluo_grid->DisplayRecs);

	// Set no record found message
	if ($pago_avaluo->CurrentAction == "" && $pago_avaluo_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$pago_avaluo_grid->setWarningMessage(ew_DeniedMsg());
		if ($pago_avaluo_grid->SearchWhere == "0=101")
			$pago_avaluo_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$pago_avaluo_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$pago_avaluo_grid->RenderOtherOptions();
?>
<?php $pago_avaluo_grid->ShowPageHeader(); ?>
<?php
$pago_avaluo_grid->ShowMessage();
?>
<?php if ($pago_avaluo_grid->TotalRecs > 0 || $pago_avaluo->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($pago_avaluo_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> pago_avaluo">
<div id="fpago_avaluogrid" class="ewForm ewListForm form-inline">
<div id="gmp_pago_avaluo" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_pago_avaluogrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$pago_avaluo_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$pago_avaluo_grid->RenderListOptions();

// Render list options (header, left)
$pago_avaluo_grid->ListOptions->Render("header", "left");
?>
<?php if ($pago_avaluo->id->Visible) { // id ?>
	<?php if ($pago_avaluo->SortUrl($pago_avaluo->id) == "") { ?>
		<th data-name="id" class="<?php echo $pago_avaluo->id->HeaderCellClass() ?>"><div id="elh_pago_avaluo_id" class="pago_avaluo_id"><div class="ewTableHeaderCaption"><?php echo $pago_avaluo->id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $pago_avaluo->id->HeaderCellClass() ?>"><div><div id="elh_pago_avaluo_id" class="pago_avaluo_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago_avaluo->id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago_avaluo->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago_avaluo->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago_avaluo->pago_id->Visible) { // pago_id ?>
	<?php if ($pago_avaluo->SortUrl($pago_avaluo->pago_id) == "") { ?>
		<th data-name="pago_id" class="<?php echo $pago_avaluo->pago_id->HeaderCellClass() ?>"><div id="elh_pago_avaluo_pago_id" class="pago_avaluo_pago_id"><div class="ewTableHeaderCaption"><?php echo $pago_avaluo->pago_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="pago_id" class="<?php echo $pago_avaluo->pago_id->HeaderCellClass() ?>"><div><div id="elh_pago_avaluo_pago_id" class="pago_avaluo_pago_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago_avaluo->pago_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago_avaluo->pago_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago_avaluo->pago_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago_avaluo->avaluo_id->Visible) { // avaluo_id ?>
	<?php if ($pago_avaluo->SortUrl($pago_avaluo->avaluo_id) == "") { ?>
		<th data-name="avaluo_id" class="<?php echo $pago_avaluo->avaluo_id->HeaderCellClass() ?>"><div id="elh_pago_avaluo_avaluo_id" class="pago_avaluo_avaluo_id"><div class="ewTableHeaderCaption"><?php echo $pago_avaluo->avaluo_id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="avaluo_id" class="<?php echo $pago_avaluo->avaluo_id->HeaderCellClass() ?>"><div><div id="elh_pago_avaluo_avaluo_id" class="pago_avaluo_avaluo_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago_avaluo->avaluo_id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago_avaluo->avaluo_id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago_avaluo->avaluo_id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago_avaluo->q->Visible) { // q ?>
	<?php if ($pago_avaluo->SortUrl($pago_avaluo->q) == "") { ?>
		<th data-name="q" class="<?php echo $pago_avaluo->q->HeaderCellClass() ?>"><div id="elh_pago_avaluo_q" class="pago_avaluo_q"><div class="ewTableHeaderCaption"><?php echo $pago_avaluo->q->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="q" class="<?php echo $pago_avaluo->q->HeaderCellClass() ?>"><div><div id="elh_pago_avaluo_q" class="pago_avaluo_q">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago_avaluo->q->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago_avaluo->q->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago_avaluo->q->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago_avaluo->id_metodopago->Visible) { // id_metodopago ?>
	<?php if ($pago_avaluo->SortUrl($pago_avaluo->id_metodopago) == "") { ?>
		<th data-name="id_metodopago" class="<?php echo $pago_avaluo->id_metodopago->HeaderCellClass() ?>"><div id="elh_pago_avaluo_id_metodopago" class="pago_avaluo_id_metodopago"><div class="ewTableHeaderCaption"><?php echo $pago_avaluo->id_metodopago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_metodopago" class="<?php echo $pago_avaluo->id_metodopago->HeaderCellClass() ?>"><div><div id="elh_pago_avaluo_id_metodopago" class="pago_avaluo_id_metodopago">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago_avaluo->id_metodopago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago_avaluo->id_metodopago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago_avaluo->id_metodopago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago_avaluo->monto->Visible) { // monto ?>
	<?php if ($pago_avaluo->SortUrl($pago_avaluo->monto) == "") { ?>
		<th data-name="monto" class="<?php echo $pago_avaluo->monto->HeaderCellClass() ?>"><div id="elh_pago_avaluo_monto" class="pago_avaluo_monto"><div class="ewTableHeaderCaption"><?php echo $pago_avaluo->monto->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="monto" class="<?php echo $pago_avaluo->monto->HeaderCellClass() ?>"><div><div id="elh_pago_avaluo_monto" class="pago_avaluo_monto">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago_avaluo->monto->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago_avaluo->monto->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago_avaluo->monto->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($pago_avaluo->id_banco->Visible) { // id_banco ?>
	<?php if ($pago_avaluo->SortUrl($pago_avaluo->id_banco) == "") { ?>
		<th data-name="id_banco" class="<?php echo $pago_avaluo->id_banco->HeaderCellClass() ?>"><div id="elh_pago_avaluo_id_banco" class="pago_avaluo_id_banco"><div class="ewTableHeaderCaption"><?php echo $pago_avaluo->id_banco->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_banco" class="<?php echo $pago_avaluo->id_banco->HeaderCellClass() ?>"><div><div id="elh_pago_avaluo_id_banco" class="pago_avaluo_id_banco">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $pago_avaluo->id_banco->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($pago_avaluo->id_banco->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($pago_avaluo->id_banco->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$pago_avaluo_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$pago_avaluo_grid->StartRec = 1;
$pago_avaluo_grid->StopRec = $pago_avaluo_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($pago_avaluo_grid->FormKeyCountName) && ($pago_avaluo->CurrentAction == "gridadd" || $pago_avaluo->CurrentAction == "gridedit" || $pago_avaluo->CurrentAction == "F")) {
		$pago_avaluo_grid->KeyCount = $objForm->GetValue($pago_avaluo_grid->FormKeyCountName);
		$pago_avaluo_grid->StopRec = $pago_avaluo_grid->StartRec + $pago_avaluo_grid->KeyCount - 1;
	}
}
$pago_avaluo_grid->RecCnt = $pago_avaluo_grid->StartRec - 1;
if ($pago_avaluo_grid->Recordset && !$pago_avaluo_grid->Recordset->EOF) {
	$pago_avaluo_grid->Recordset->MoveFirst();
	$bSelectLimit = $pago_avaluo_grid->UseSelectLimit;
	if (!$bSelectLimit && $pago_avaluo_grid->StartRec > 1)
		$pago_avaluo_grid->Recordset->Move($pago_avaluo_grid->StartRec - 1);
} elseif (!$pago_avaluo->AllowAddDeleteRow && $pago_avaluo_grid->StopRec == 0) {
	$pago_avaluo_grid->StopRec = $pago_avaluo->GridAddRowCount;
}

// Initialize aggregate
$pago_avaluo->RowType = EW_ROWTYPE_AGGREGATEINIT;
$pago_avaluo->ResetAttrs();
$pago_avaluo_grid->RenderRow();
if ($pago_avaluo->CurrentAction == "gridadd")
	$pago_avaluo_grid->RowIndex = 0;
if ($pago_avaluo->CurrentAction == "gridedit")
	$pago_avaluo_grid->RowIndex = 0;
while ($pago_avaluo_grid->RecCnt < $pago_avaluo_grid->StopRec) {
	$pago_avaluo_grid->RecCnt++;
	if (intval($pago_avaluo_grid->RecCnt) >= intval($pago_avaluo_grid->StartRec)) {
		$pago_avaluo_grid->RowCnt++;
		if ($pago_avaluo->CurrentAction == "gridadd" || $pago_avaluo->CurrentAction == "gridedit" || $pago_avaluo->CurrentAction == "F") {
			$pago_avaluo_grid->RowIndex++;
			$objForm->Index = $pago_avaluo_grid->RowIndex;
			if ($objForm->HasValue($pago_avaluo_grid->FormActionName))
				$pago_avaluo_grid->RowAction = strval($objForm->GetValue($pago_avaluo_grid->FormActionName));
			elseif ($pago_avaluo->CurrentAction == "gridadd")
				$pago_avaluo_grid->RowAction = "insert";
			else
				$pago_avaluo_grid->RowAction = "";
		}

		// Set up key count
		$pago_avaluo_grid->KeyCount = $pago_avaluo_grid->RowIndex;

		// Init row class and style
		$pago_avaluo->ResetAttrs();
		$pago_avaluo->CssClass = "";
		if ($pago_avaluo->CurrentAction == "gridadd") {
			if ($pago_avaluo->CurrentMode == "copy") {
				$pago_avaluo_grid->LoadRowValues($pago_avaluo_grid->Recordset); // Load row values
				$pago_avaluo_grid->SetRecordKey($pago_avaluo_grid->RowOldKey, $pago_avaluo_grid->Recordset); // Set old record key
			} else {
				$pago_avaluo_grid->LoadRowValues(); // Load default values
				$pago_avaluo_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$pago_avaluo_grid->LoadRowValues($pago_avaluo_grid->Recordset); // Load row values
		}
		$pago_avaluo->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($pago_avaluo->CurrentAction == "gridadd") // Grid add
			$pago_avaluo->RowType = EW_ROWTYPE_ADD; // Render add
		if ($pago_avaluo->CurrentAction == "gridadd" && $pago_avaluo->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$pago_avaluo_grid->RestoreCurrentRowFormValues($pago_avaluo_grid->RowIndex); // Restore form values
		if ($pago_avaluo->CurrentAction == "gridedit") { // Grid edit
			if ($pago_avaluo->EventCancelled) {
				$pago_avaluo_grid->RestoreCurrentRowFormValues($pago_avaluo_grid->RowIndex); // Restore form values
			}
			if ($pago_avaluo_grid->RowAction == "insert")
				$pago_avaluo->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$pago_avaluo->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($pago_avaluo->CurrentAction == "gridedit" && ($pago_avaluo->RowType == EW_ROWTYPE_EDIT || $pago_avaluo->RowType == EW_ROWTYPE_ADD) && $pago_avaluo->EventCancelled) // Update failed
			$pago_avaluo_grid->RestoreCurrentRowFormValues($pago_avaluo_grid->RowIndex); // Restore form values
		if ($pago_avaluo->RowType == EW_ROWTYPE_EDIT) // Edit row
			$pago_avaluo_grid->EditRowCnt++;
		if ($pago_avaluo->CurrentAction == "F") // Confirm row
			$pago_avaluo_grid->RestoreCurrentRowFormValues($pago_avaluo_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$pago_avaluo->RowAttrs = array_merge($pago_avaluo->RowAttrs, array('data-rowindex'=>$pago_avaluo_grid->RowCnt, 'id'=>'r' . $pago_avaluo_grid->RowCnt . '_pago_avaluo', 'data-rowtype'=>$pago_avaluo->RowType));

		// Render row
		$pago_avaluo_grid->RenderRow();

		// Render list options
		$pago_avaluo_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($pago_avaluo_grid->RowAction <> "delete" && $pago_avaluo_grid->RowAction <> "insertdelete" && !($pago_avaluo_grid->RowAction == "insert" && $pago_avaluo->CurrentAction == "F" && $pago_avaluo_grid->EmptyRow())) {
?>
	<tr<?php echo $pago_avaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pago_avaluo_grid->ListOptions->Render("body", "left", $pago_avaluo_grid->RowCnt);
?>
	<?php if ($pago_avaluo->id->Visible) { // id ?>
		<td data-name="id"<?php echo $pago_avaluo->id->CellAttributes() ?>>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_id" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_id" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago_avaluo->id->OldValue) ?>">
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_id" class="form-group pago_avaluo_id">
<span<?php echo $pago_avaluo->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago_avaluo->id->CurrentValue) ?>">
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_id" class="pago_avaluo_id">
<span<?php echo $pago_avaluo->id->ViewAttributes() ?>>
<?php echo $pago_avaluo->id->ListViewValue() ?></span>
</span>
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago_avaluo->id->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_id" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_id" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago_avaluo->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_id" name="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_id" id="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago_avaluo->id->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_id" name="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_id" id="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago_avaluo->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago_avaluo->pago_id->Visible) { // pago_id ?>
		<td data-name="pago_id"<?php echo $pago_avaluo->pago_id->CellAttributes() ?>>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($pago_avaluo->pago_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_pago_id" class="form-group pago_avaluo_pago_id">
<span<?php echo $pago_avaluo->pago_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->pago_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_pago_id" class="form-group pago_avaluo_pago_id">
<input type="text" data-table="pago_avaluo" data-field="x_pago_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->pago_id->EditValue ?>"<?php echo $pago_avaluo->pago_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_pago_id" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->OldValue) ?>">
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($pago_avaluo->pago_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_pago_id" class="form-group pago_avaluo_pago_id">
<span<?php echo $pago_avaluo->pago_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->pago_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_pago_id" class="form-group pago_avaluo_pago_id">
<input type="text" data-table="pago_avaluo" data-field="x_pago_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->pago_id->EditValue ?>"<?php echo $pago_avaluo->pago_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_pago_id" class="pago_avaluo_pago_id">
<span<?php echo $pago_avaluo->pago_id->ViewAttributes() ?>>
<?php echo $pago_avaluo->pago_id->ListViewValue() ?></span>
</span>
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_pago_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_pago_id" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_pago_id" name="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" id="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_pago_id" name="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" id="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago_avaluo->avaluo_id->Visible) { // avaluo_id ?>
		<td data-name="avaluo_id"<?php echo $pago_avaluo->avaluo_id->CellAttributes() ?>>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($pago_avaluo->avaluo_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_avaluo_id" class="form-group pago_avaluo_avaluo_id">
<span<?php echo $pago_avaluo->avaluo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->avaluo_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_avaluo_id" class="form-group pago_avaluo_avaluo_id">
<input type="text" data-table="pago_avaluo" data-field="x_avaluo_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->avaluo_id->EditValue ?>"<?php echo $pago_avaluo->avaluo_id->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->OldValue) ?>">
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($pago_avaluo->avaluo_id->getSessionValue() <> "") { ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_avaluo_id" class="form-group pago_avaluo_avaluo_id">
<span<?php echo $pago_avaluo->avaluo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->avaluo_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_avaluo_id" class="form-group pago_avaluo_avaluo_id">
<input type="text" data-table="pago_avaluo" data-field="x_avaluo_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->avaluo_id->EditValue ?>"<?php echo $pago_avaluo->avaluo_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_avaluo_id" class="pago_avaluo_avaluo_id">
<span<?php echo $pago_avaluo->avaluo_id->ViewAttributes() ?>>
<?php echo $pago_avaluo->avaluo_id->ListViewValue() ?></span>
</span>
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" name="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" id="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" name="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" id="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago_avaluo->q->Visible) { // q ?>
		<td data-name="q"<?php echo $pago_avaluo->q->CellAttributes() ?>>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_q" class="form-group pago_avaluo_q">
<input type="text" data-table="pago_avaluo" data-field="x_q" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_q" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_q" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->q->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->q->EditValue ?>"<?php echo $pago_avaluo->q->EditAttributes() ?>>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_q" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_q" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_q" value="<?php echo ew_HtmlEncode($pago_avaluo->q->OldValue) ?>">
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_q" class="form-group pago_avaluo_q">
<input type="text" data-table="pago_avaluo" data-field="x_q" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_q" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_q" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->q->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->q->EditValue ?>"<?php echo $pago_avaluo->q->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_q" class="pago_avaluo_q">
<span<?php echo $pago_avaluo->q->ViewAttributes() ?>>
<?php echo $pago_avaluo->q->ListViewValue() ?></span>
</span>
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_q" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_q" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_q" value="<?php echo ew_HtmlEncode($pago_avaluo->q->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_q" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_q" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_q" value="<?php echo ew_HtmlEncode($pago_avaluo->q->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_q" name="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_q" id="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_q" value="<?php echo ew_HtmlEncode($pago_avaluo->q->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_q" name="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_q" id="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_q" value="<?php echo ew_HtmlEncode($pago_avaluo->q->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago_avaluo->id_metodopago->Visible) { // id_metodopago ?>
		<td data-name="id_metodopago"<?php echo $pago_avaluo->id_metodopago->CellAttributes() ?>>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_id_metodopago" class="form-group pago_avaluo_id_metodopago">
<input type="text" data-table="pago_avaluo" data-field="x_id_metodopago" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->id_metodopago->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->id_metodopago->EditValue ?>"<?php echo $pago_avaluo->id_metodopago->EditAttributes() ?>>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_id_metodopago" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($pago_avaluo->id_metodopago->OldValue) ?>">
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_id_metodopago" class="form-group pago_avaluo_id_metodopago">
<input type="text" data-table="pago_avaluo" data-field="x_id_metodopago" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->id_metodopago->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->id_metodopago->EditValue ?>"<?php echo $pago_avaluo->id_metodopago->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_id_metodopago" class="pago_avaluo_id_metodopago">
<span<?php echo $pago_avaluo->id_metodopago->ViewAttributes() ?>>
<?php echo $pago_avaluo->id_metodopago->ListViewValue() ?></span>
</span>
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_id_metodopago" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($pago_avaluo->id_metodopago->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_id_metodopago" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($pago_avaluo->id_metodopago->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_id_metodopago" name="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" id="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($pago_avaluo->id_metodopago->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_id_metodopago" name="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" id="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($pago_avaluo->id_metodopago->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago_avaluo->monto->Visible) { // monto ?>
		<td data-name="monto"<?php echo $pago_avaluo->monto->CellAttributes() ?>>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_monto" class="form-group pago_avaluo_monto">
<input type="text" data-table="pago_avaluo" data-field="x_monto" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_monto" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_monto" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->monto->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->monto->EditValue ?>"<?php echo $pago_avaluo->monto->EditAttributes() ?>>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_monto" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_monto" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_monto" value="<?php echo ew_HtmlEncode($pago_avaluo->monto->OldValue) ?>">
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_monto" class="form-group pago_avaluo_monto">
<input type="text" data-table="pago_avaluo" data-field="x_monto" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_monto" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_monto" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->monto->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->monto->EditValue ?>"<?php echo $pago_avaluo->monto->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_monto" class="pago_avaluo_monto">
<span<?php echo $pago_avaluo->monto->ViewAttributes() ?>>
<?php echo $pago_avaluo->monto->ListViewValue() ?></span>
</span>
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_monto" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_monto" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_monto" value="<?php echo ew_HtmlEncode($pago_avaluo->monto->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_monto" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_monto" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_monto" value="<?php echo ew_HtmlEncode($pago_avaluo->monto->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_monto" name="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_monto" id="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_monto" value="<?php echo ew_HtmlEncode($pago_avaluo->monto->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_monto" name="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_monto" id="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_monto" value="<?php echo ew_HtmlEncode($pago_avaluo->monto->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($pago_avaluo->id_banco->Visible) { // id_banco ?>
		<td data-name="id_banco"<?php echo $pago_avaluo->id_banco->CellAttributes() ?>>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_id_banco" class="form-group pago_avaluo_id_banco">
<input type="text" data-table="pago_avaluo" data-field="x_id_banco" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->id_banco->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->id_banco->EditValue ?>"<?php echo $pago_avaluo->id_banco->EditAttributes() ?>>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_id_banco" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" value="<?php echo ew_HtmlEncode($pago_avaluo->id_banco->OldValue) ?>">
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_id_banco" class="form-group pago_avaluo_id_banco">
<input type="text" data-table="pago_avaluo" data-field="x_id_banco" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->id_banco->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->id_banco->EditValue ?>"<?php echo $pago_avaluo->id_banco->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $pago_avaluo_grid->RowCnt ?>_pago_avaluo_id_banco" class="pago_avaluo_id_banco">
<span<?php echo $pago_avaluo->id_banco->ViewAttributes() ?>>
<?php echo $pago_avaluo->id_banco->ListViewValue() ?></span>
</span>
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_id_banco" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" value="<?php echo ew_HtmlEncode($pago_avaluo->id_banco->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_id_banco" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" value="<?php echo ew_HtmlEncode($pago_avaluo->id_banco->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_id_banco" name="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" id="fpago_avaluogrid$x<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" value="<?php echo ew_HtmlEncode($pago_avaluo->id_banco->FormValue) ?>">
<input type="hidden" data-table="pago_avaluo" data-field="x_id_banco" name="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" id="fpago_avaluogrid$o<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" value="<?php echo ew_HtmlEncode($pago_avaluo->id_banco->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pago_avaluo_grid->ListOptions->Render("body", "right", $pago_avaluo_grid->RowCnt);
?>
	</tr>
<?php if ($pago_avaluo->RowType == EW_ROWTYPE_ADD || $pago_avaluo->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fpago_avaluogrid.UpdateOpts(<?php echo $pago_avaluo_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($pago_avaluo->CurrentAction <> "gridadd" || $pago_avaluo->CurrentMode == "copy")
		if (!$pago_avaluo_grid->Recordset->EOF) $pago_avaluo_grid->Recordset->MoveNext();
}
?>
<?php
	if ($pago_avaluo->CurrentMode == "add" || $pago_avaluo->CurrentMode == "copy" || $pago_avaluo->CurrentMode == "edit") {
		$pago_avaluo_grid->RowIndex = '$rowindex$';
		$pago_avaluo_grid->LoadRowValues();

		// Set row properties
		$pago_avaluo->ResetAttrs();
		$pago_avaluo->RowAttrs = array_merge($pago_avaluo->RowAttrs, array('data-rowindex'=>$pago_avaluo_grid->RowIndex, 'id'=>'r0_pago_avaluo', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($pago_avaluo->RowAttrs["class"], "ewTemplate");
		$pago_avaluo->RowType = EW_ROWTYPE_ADD;

		// Render row
		$pago_avaluo_grid->RenderRow();

		// Render list options
		$pago_avaluo_grid->RenderListOptions();
		$pago_avaluo_grid->StartRowCnt = 0;
?>
	<tr<?php echo $pago_avaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$pago_avaluo_grid->ListOptions->Render("body", "left", $pago_avaluo_grid->RowIndex);
?>
	<?php if ($pago_avaluo->id->Visible) { // id ?>
		<td data-name="id">
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_pago_avaluo_id" class="form-group pago_avaluo_id">
<span<?php echo $pago_avaluo->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago_avaluo->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_id" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_id" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($pago_avaluo->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago_avaluo->pago_id->Visible) { // pago_id ?>
		<td data-name="pago_id">
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<?php if ($pago_avaluo->pago_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_pago_avaluo_pago_id" class="form-group pago_avaluo_pago_id">
<span<?php echo $pago_avaluo->pago_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->pago_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_pago_avaluo_pago_id" class="form-group pago_avaluo_pago_id">
<input type="text" data-table="pago_avaluo" data-field="x_pago_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->pago_id->EditValue ?>"<?php echo $pago_avaluo->pago_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_pago_avaluo_pago_id" class="form-group pago_avaluo_pago_id">
<span<?php echo $pago_avaluo->pago_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->pago_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_pago_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_pago_id" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_pago_id" value="<?php echo ew_HtmlEncode($pago_avaluo->pago_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago_avaluo->avaluo_id->Visible) { // avaluo_id ?>
		<td data-name="avaluo_id">
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<?php if ($pago_avaluo->avaluo_id->getSessionValue() <> "") { ?>
<span id="el$rowindex$_pago_avaluo_avaluo_id" class="form-group pago_avaluo_avaluo_id">
<span<?php echo $pago_avaluo->avaluo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->avaluo_id->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_pago_avaluo_avaluo_id" class="form-group pago_avaluo_avaluo_id">
<input type="text" data-table="pago_avaluo" data-field="x_avaluo_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->avaluo_id->EditValue ?>"<?php echo $pago_avaluo->avaluo_id->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_pago_avaluo_avaluo_id" class="form-group pago_avaluo_avaluo_id">
<span<?php echo $pago_avaluo->avaluo_id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->avaluo_id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_avaluo_id" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_avaluo_id" value="<?php echo ew_HtmlEncode($pago_avaluo->avaluo_id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago_avaluo->q->Visible) { // q ?>
		<td data-name="q">
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_pago_avaluo_q" class="form-group pago_avaluo_q">
<input type="text" data-table="pago_avaluo" data-field="x_q" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_q" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_q" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->q->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->q->EditValue ?>"<?php echo $pago_avaluo->q->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_pago_avaluo_q" class="form-group pago_avaluo_q">
<span<?php echo $pago_avaluo->q->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->q->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_q" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_q" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_q" value="<?php echo ew_HtmlEncode($pago_avaluo->q->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_q" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_q" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_q" value="<?php echo ew_HtmlEncode($pago_avaluo->q->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago_avaluo->id_metodopago->Visible) { // id_metodopago ?>
		<td data-name="id_metodopago">
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_pago_avaluo_id_metodopago" class="form-group pago_avaluo_id_metodopago">
<input type="text" data-table="pago_avaluo" data-field="x_id_metodopago" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->id_metodopago->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->id_metodopago->EditValue ?>"<?php echo $pago_avaluo->id_metodopago->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_pago_avaluo_id_metodopago" class="form-group pago_avaluo_id_metodopago">
<span<?php echo $pago_avaluo->id_metodopago->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->id_metodopago->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_id_metodopago" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($pago_avaluo->id_metodopago->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_id_metodopago" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_id_metodopago" value="<?php echo ew_HtmlEncode($pago_avaluo->id_metodopago->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago_avaluo->monto->Visible) { // monto ?>
		<td data-name="monto">
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_pago_avaluo_monto" class="form-group pago_avaluo_monto">
<input type="text" data-table="pago_avaluo" data-field="x_monto" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_monto" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_monto" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->monto->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->monto->EditValue ?>"<?php echo $pago_avaluo->monto->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_pago_avaluo_monto" class="form-group pago_avaluo_monto">
<span<?php echo $pago_avaluo->monto->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->monto->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_monto" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_monto" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_monto" value="<?php echo ew_HtmlEncode($pago_avaluo->monto->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_monto" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_monto" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_monto" value="<?php echo ew_HtmlEncode($pago_avaluo->monto->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($pago_avaluo->id_banco->Visible) { // id_banco ?>
		<td data-name="id_banco">
<?php if ($pago_avaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_pago_avaluo_id_banco" class="form-group pago_avaluo_id_banco">
<input type="text" data-table="pago_avaluo" data-field="x_id_banco" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" size="30" placeholder="<?php echo ew_HtmlEncode($pago_avaluo->id_banco->getPlaceHolder()) ?>" value="<?php echo $pago_avaluo->id_banco->EditValue ?>"<?php echo $pago_avaluo->id_banco->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_pago_avaluo_id_banco" class="form-group pago_avaluo_id_banco">
<span<?php echo $pago_avaluo->id_banco->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $pago_avaluo->id_banco->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="pago_avaluo" data-field="x_id_banco" name="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" id="x<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" value="<?php echo ew_HtmlEncode($pago_avaluo->id_banco->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="pago_avaluo" data-field="x_id_banco" name="o<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" id="o<?php echo $pago_avaluo_grid->RowIndex ?>_id_banco" value="<?php echo ew_HtmlEncode($pago_avaluo->id_banco->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$pago_avaluo_grid->ListOptions->Render("body", "right", $pago_avaluo_grid->RowCnt);
?>
<script type="text/javascript">
fpago_avaluogrid.UpdateOpts(<?php echo $pago_avaluo_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($pago_avaluo->CurrentMode == "add" || $pago_avaluo->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $pago_avaluo_grid->FormKeyCountName ?>" id="<?php echo $pago_avaluo_grid->FormKeyCountName ?>" value="<?php echo $pago_avaluo_grid->KeyCount ?>">
<?php echo $pago_avaluo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($pago_avaluo->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $pago_avaluo_grid->FormKeyCountName ?>" id="<?php echo $pago_avaluo_grid->FormKeyCountName ?>" value="<?php echo $pago_avaluo_grid->KeyCount ?>">
<?php echo $pago_avaluo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($pago_avaluo->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fpago_avaluogrid">
</div>
<?php

// Close recordset
if ($pago_avaluo_grid->Recordset)
	$pago_avaluo_grid->Recordset->Close();
?>
<?php if ($pago_avaluo_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($pago_avaluo_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($pago_avaluo_grid->TotalRecs == 0 && $pago_avaluo->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($pago_avaluo_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($pago_avaluo->Export == "") { ?>
<script type="text/javascript">
fpago_avaluogrid.Init();
</script>
<?php } ?>
<?php
$pago_avaluo_grid->Page_Terminate();
?>
