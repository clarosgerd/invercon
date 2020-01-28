<?php include_once "usuarioinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($comentariosavaluo_grid)) $comentariosavaluo_grid = new ccomentariosavaluo_grid();

// Page init
$comentariosavaluo_grid->Page_Init();

// Page main
$comentariosavaluo_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$comentariosavaluo_grid->Page_Render();
?>
<?php if ($comentariosavaluo->Export == "") { ?>
<script type="text/javascript">

// Form object
var fcomentariosavaluogrid = new ew_Form("fcomentariosavaluogrid", "grid");
fcomentariosavaluogrid.FormKeyCountName = '<?php echo $comentariosavaluo_grid->FormKeyCountName ?>';

// Validate form
fcomentariosavaluogrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_descripcion");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $comentariosavaluo->descripcion->FldCaption(), $comentariosavaluo->descripcion->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fcomentariosavaluogrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "usuario", false)) return false;
	if (ew_ValueChanged(fobj, infix, "descripcion", false)) return false;
	return true;
}

// Form_CustomValidate event
fcomentariosavaluogrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fcomentariosavaluogrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fcomentariosavaluogrid.Lists["x_usuario"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_codigo","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"usuario"};
fcomentariosavaluogrid.Lists["x_usuario"].Data = "<?php echo $comentariosavaluo_grid->usuario->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($comentariosavaluo->CurrentAction == "gridadd") {
	if ($comentariosavaluo->CurrentMode == "copy") {
		$bSelectLimit = $comentariosavaluo_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$comentariosavaluo_grid->TotalRecs = $comentariosavaluo->ListRecordCount();
			$comentariosavaluo_grid->Recordset = $comentariosavaluo_grid->LoadRecordset($comentariosavaluo_grid->StartRec-1, $comentariosavaluo_grid->DisplayRecs);
		} else {
			if ($comentariosavaluo_grid->Recordset = $comentariosavaluo_grid->LoadRecordset())
				$comentariosavaluo_grid->TotalRecs = $comentariosavaluo_grid->Recordset->RecordCount();
		}
		$comentariosavaluo_grid->StartRec = 1;
		$comentariosavaluo_grid->DisplayRecs = $comentariosavaluo_grid->TotalRecs;
	} else {
		$comentariosavaluo->CurrentFilter = "0=1";
		$comentariosavaluo_grid->StartRec = 1;
		$comentariosavaluo_grid->DisplayRecs = $comentariosavaluo->GridAddRowCount;
	}
	$comentariosavaluo_grid->TotalRecs = $comentariosavaluo_grid->DisplayRecs;
	$comentariosavaluo_grid->StopRec = $comentariosavaluo_grid->DisplayRecs;
} else {
	$bSelectLimit = $comentariosavaluo_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($comentariosavaluo_grid->TotalRecs <= 0)
			$comentariosavaluo_grid->TotalRecs = $comentariosavaluo->ListRecordCount();
	} else {
		if (!$comentariosavaluo_grid->Recordset && ($comentariosavaluo_grid->Recordset = $comentariosavaluo_grid->LoadRecordset()))
			$comentariosavaluo_grid->TotalRecs = $comentariosavaluo_grid->Recordset->RecordCount();
	}
	$comentariosavaluo_grid->StartRec = 1;
	$comentariosavaluo_grid->DisplayRecs = $comentariosavaluo_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$comentariosavaluo_grid->Recordset = $comentariosavaluo_grid->LoadRecordset($comentariosavaluo_grid->StartRec-1, $comentariosavaluo_grid->DisplayRecs);

	// Set no record found message
	if ($comentariosavaluo->CurrentAction == "" && $comentariosavaluo_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$comentariosavaluo_grid->setWarningMessage(ew_DeniedMsg());
		if ($comentariosavaluo_grid->SearchWhere == "0=101")
			$comentariosavaluo_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$comentariosavaluo_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$comentariosavaluo_grid->RenderOtherOptions();
?>
<?php $comentariosavaluo_grid->ShowPageHeader(); ?>
<?php
$comentariosavaluo_grid->ShowMessage();
?>
<?php if ($comentariosavaluo_grid->TotalRecs > 0 || $comentariosavaluo->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($comentariosavaluo_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> comentariosavaluo">
<div id="fcomentariosavaluogrid" class="ewForm ewListForm form-inline">
<div id="gmp_comentariosavaluo" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_comentariosavaluogrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$comentariosavaluo_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$comentariosavaluo_grid->RenderListOptions();

// Render list options (header, left)
$comentariosavaluo_grid->ListOptions->Render("header", "left");
?>
<?php if ($comentariosavaluo->id->Visible) { // id ?>
	<?php if ($comentariosavaluo->SortUrl($comentariosavaluo->id) == "") { ?>
		<th data-name="id" class="<?php echo $comentariosavaluo->id->HeaderCellClass() ?>"><div id="elh_comentariosavaluo_id" class="comentariosavaluo_id"><div class="ewTableHeaderCaption"><?php echo $comentariosavaluo->id->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id" class="<?php echo $comentariosavaluo->id->HeaderCellClass() ?>"><div><div id="elh_comentariosavaluo_id" class="comentariosavaluo_id">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $comentariosavaluo->id->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($comentariosavaluo->id->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($comentariosavaluo->id->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comentariosavaluo->usuario->Visible) { // usuario ?>
	<?php if ($comentariosavaluo->SortUrl($comentariosavaluo->usuario) == "") { ?>
		<th data-name="usuario" class="<?php echo $comentariosavaluo->usuario->HeaderCellClass() ?>"><div id="elh_comentariosavaluo_usuario" class="comentariosavaluo_usuario"><div class="ewTableHeaderCaption"><?php echo $comentariosavaluo->usuario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="usuario" class="<?php echo $comentariosavaluo->usuario->HeaderCellClass() ?>"><div><div id="elh_comentariosavaluo_usuario" class="comentariosavaluo_usuario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $comentariosavaluo->usuario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($comentariosavaluo->usuario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($comentariosavaluo->usuario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comentariosavaluo->descripcion->Visible) { // descripcion ?>
	<?php if ($comentariosavaluo->SortUrl($comentariosavaluo->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $comentariosavaluo->descripcion->HeaderCellClass() ?>"><div id="elh_comentariosavaluo_descripcion" class="comentariosavaluo_descripcion"><div class="ewTableHeaderCaption"><?php echo $comentariosavaluo->descripcion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $comentariosavaluo->descripcion->HeaderCellClass() ?>"><div><div id="elh_comentariosavaluo_descripcion" class="comentariosavaluo_descripcion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $comentariosavaluo->descripcion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($comentariosavaluo->descripcion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($comentariosavaluo->descripcion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$comentariosavaluo_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$comentariosavaluo_grid->StartRec = 1;
$comentariosavaluo_grid->StopRec = $comentariosavaluo_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($comentariosavaluo_grid->FormKeyCountName) && ($comentariosavaluo->CurrentAction == "gridadd" || $comentariosavaluo->CurrentAction == "gridedit" || $comentariosavaluo->CurrentAction == "F")) {
		$comentariosavaluo_grid->KeyCount = $objForm->GetValue($comentariosavaluo_grid->FormKeyCountName);
		$comentariosavaluo_grid->StopRec = $comentariosavaluo_grid->StartRec + $comentariosavaluo_grid->KeyCount - 1;
	}
}
$comentariosavaluo_grid->RecCnt = $comentariosavaluo_grid->StartRec - 1;
if ($comentariosavaluo_grid->Recordset && !$comentariosavaluo_grid->Recordset->EOF) {
	$comentariosavaluo_grid->Recordset->MoveFirst();
	$bSelectLimit = $comentariosavaluo_grid->UseSelectLimit;
	if (!$bSelectLimit && $comentariosavaluo_grid->StartRec > 1)
		$comentariosavaluo_grid->Recordset->Move($comentariosavaluo_grid->StartRec - 1);
} elseif (!$comentariosavaluo->AllowAddDeleteRow && $comentariosavaluo_grid->StopRec == 0) {
	$comentariosavaluo_grid->StopRec = $comentariosavaluo->GridAddRowCount;
}

// Initialize aggregate
$comentariosavaluo->RowType = EW_ROWTYPE_AGGREGATEINIT;
$comentariosavaluo->ResetAttrs();
$comentariosavaluo_grid->RenderRow();
if ($comentariosavaluo->CurrentAction == "gridadd")
	$comentariosavaluo_grid->RowIndex = 0;
if ($comentariosavaluo->CurrentAction == "gridedit")
	$comentariosavaluo_grid->RowIndex = 0;
while ($comentariosavaluo_grid->RecCnt < $comentariosavaluo_grid->StopRec) {
	$comentariosavaluo_grid->RecCnt++;
	if (intval($comentariosavaluo_grid->RecCnt) >= intval($comentariosavaluo_grid->StartRec)) {
		$comentariosavaluo_grid->RowCnt++;
		if ($comentariosavaluo->CurrentAction == "gridadd" || $comentariosavaluo->CurrentAction == "gridedit" || $comentariosavaluo->CurrentAction == "F") {
			$comentariosavaluo_grid->RowIndex++;
			$objForm->Index = $comentariosavaluo_grid->RowIndex;
			if ($objForm->HasValue($comentariosavaluo_grid->FormActionName))
				$comentariosavaluo_grid->RowAction = strval($objForm->GetValue($comentariosavaluo_grid->FormActionName));
			elseif ($comentariosavaluo->CurrentAction == "gridadd")
				$comentariosavaluo_grid->RowAction = "insert";
			else
				$comentariosavaluo_grid->RowAction = "";
		}

		// Set up key count
		$comentariosavaluo_grid->KeyCount = $comentariosavaluo_grid->RowIndex;

		// Init row class and style
		$comentariosavaluo->ResetAttrs();
		$comentariosavaluo->CssClass = "";
		if ($comentariosavaluo->CurrentAction == "gridadd") {
			if ($comentariosavaluo->CurrentMode == "copy") {
				$comentariosavaluo_grid->LoadRowValues($comentariosavaluo_grid->Recordset); // Load row values
				$comentariosavaluo_grid->SetRecordKey($comentariosavaluo_grid->RowOldKey, $comentariosavaluo_grid->Recordset); // Set old record key
			} else {
				$comentariosavaluo_grid->LoadRowValues(); // Load default values
				$comentariosavaluo_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$comentariosavaluo_grid->LoadRowValues($comentariosavaluo_grid->Recordset); // Load row values
		}
		$comentariosavaluo->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($comentariosavaluo->CurrentAction == "gridadd") // Grid add
			$comentariosavaluo->RowType = EW_ROWTYPE_ADD; // Render add
		if ($comentariosavaluo->CurrentAction == "gridadd" && $comentariosavaluo->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$comentariosavaluo_grid->RestoreCurrentRowFormValues($comentariosavaluo_grid->RowIndex); // Restore form values
		if ($comentariosavaluo->CurrentAction == "gridedit") { // Grid edit
			if ($comentariosavaluo->EventCancelled) {
				$comentariosavaluo_grid->RestoreCurrentRowFormValues($comentariosavaluo_grid->RowIndex); // Restore form values
			}
			if ($comentariosavaluo_grid->RowAction == "insert")
				$comentariosavaluo->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$comentariosavaluo->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($comentariosavaluo->CurrentAction == "gridedit" && ($comentariosavaluo->RowType == EW_ROWTYPE_EDIT || $comentariosavaluo->RowType == EW_ROWTYPE_ADD) && $comentariosavaluo->EventCancelled) // Update failed
			$comentariosavaluo_grid->RestoreCurrentRowFormValues($comentariosavaluo_grid->RowIndex); // Restore form values
		if ($comentariosavaluo->RowType == EW_ROWTYPE_EDIT) // Edit row
			$comentariosavaluo_grid->EditRowCnt++;
		if ($comentariosavaluo->CurrentAction == "F") // Confirm row
			$comentariosavaluo_grid->RestoreCurrentRowFormValues($comentariosavaluo_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$comentariosavaluo->RowAttrs = array_merge($comentariosavaluo->RowAttrs, array('data-rowindex'=>$comentariosavaluo_grid->RowCnt, 'id'=>'r' . $comentariosavaluo_grid->RowCnt . '_comentariosavaluo', 'data-rowtype'=>$comentariosavaluo->RowType));

		// Render row
		$comentariosavaluo_grid->RenderRow();

		// Render list options
		$comentariosavaluo_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($comentariosavaluo_grid->RowAction <> "delete" && $comentariosavaluo_grid->RowAction <> "insertdelete" && !($comentariosavaluo_grid->RowAction == "insert" && $comentariosavaluo->CurrentAction == "F" && $comentariosavaluo_grid->EmptyRow())) {
?>
	<tr<?php echo $comentariosavaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$comentariosavaluo_grid->ListOptions->Render("body", "left", $comentariosavaluo_grid->RowCnt);
?>
	<?php if ($comentariosavaluo->id->Visible) { // id ?>
		<td data-name="id"<?php echo $comentariosavaluo->id->CellAttributes() ?>>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_id" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_id" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($comentariosavaluo->id->OldValue) ?>">
<?php } ?>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_id" class="form-group comentariosavaluo_id">
<span<?php echo $comentariosavaluo->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $comentariosavaluo->id->EditValue ?></p></span>
</span>
<input type="hidden" data-table="comentariosavaluo" data-field="x_id" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($comentariosavaluo->id->CurrentValue) ?>">
<?php } ?>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_id" class="comentariosavaluo_id">
<span<?php echo $comentariosavaluo->id->ViewAttributes() ?>>
<?php echo $comentariosavaluo->id->ListViewValue() ?></span>
</span>
<?php if ($comentariosavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_id" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($comentariosavaluo->id->FormValue) ?>">
<input type="hidden" data-table="comentariosavaluo" data-field="x_id" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_id" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($comentariosavaluo->id->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_id" name="fcomentariosavaluogrid$x<?php echo $comentariosavaluo_grid->RowIndex ?>_id" id="fcomentariosavaluogrid$x<?php echo $comentariosavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($comentariosavaluo->id->FormValue) ?>">
<input type="hidden" data-table="comentariosavaluo" data-field="x_id" name="fcomentariosavaluogrid$o<?php echo $comentariosavaluo_grid->RowIndex ?>_id" id="fcomentariosavaluogrid$o<?php echo $comentariosavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($comentariosavaluo->id->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($comentariosavaluo->usuario->Visible) { // usuario ?>
		<td data-name="usuario"<?php echo $comentariosavaluo->usuario->CellAttributes() ?>>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_usuario" class="form-group comentariosavaluo_usuario">
<select data-table="comentariosavaluo" data-field="x_usuario" data-value-separator="<?php echo $comentariosavaluo->usuario->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario"<?php echo $comentariosavaluo->usuario->EditAttributes() ?>>
<?php echo $comentariosavaluo->usuario->SelectOptionListHtml("x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario") ?>
</select>
</span>
<input type="hidden" data-table="comentariosavaluo" data-field="x_usuario" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" value="<?php echo ew_HtmlEncode($comentariosavaluo->usuario->OldValue) ?>">
<?php } ?>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_usuario" class="form-group comentariosavaluo_usuario">
<select data-table="comentariosavaluo" data-field="x_usuario" data-value-separator="<?php echo $comentariosavaluo->usuario->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario"<?php echo $comentariosavaluo->usuario->EditAttributes() ?>>
<?php echo $comentariosavaluo->usuario->SelectOptionListHtml("x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario") ?>
</select>
</span>
<?php } ?>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_usuario" class="comentariosavaluo_usuario">
<span<?php echo $comentariosavaluo->usuario->ViewAttributes() ?>>
<?php echo $comentariosavaluo->usuario->ListViewValue() ?></span>
</span>
<?php if ($comentariosavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_usuario" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" value="<?php echo ew_HtmlEncode($comentariosavaluo->usuario->FormValue) ?>">
<input type="hidden" data-table="comentariosavaluo" data-field="x_usuario" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" value="<?php echo ew_HtmlEncode($comentariosavaluo->usuario->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_usuario" name="fcomentariosavaluogrid$x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" id="fcomentariosavaluogrid$x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" value="<?php echo ew_HtmlEncode($comentariosavaluo->usuario->FormValue) ?>">
<input type="hidden" data-table="comentariosavaluo" data-field="x_usuario" name="fcomentariosavaluogrid$o<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" id="fcomentariosavaluogrid$o<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" value="<?php echo ew_HtmlEncode($comentariosavaluo->usuario->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($comentariosavaluo->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion"<?php echo $comentariosavaluo->descripcion->CellAttributes() ?>>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_descripcion" class="form-group comentariosavaluo_descripcion">
<textarea data-table="comentariosavaluo" data-field="x_descripcion" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($comentariosavaluo->descripcion->getPlaceHolder()) ?>"<?php echo $comentariosavaluo->descripcion->EditAttributes() ?>><?php echo $comentariosavaluo->descripcion->EditValue ?></textarea>
</span>
<input type="hidden" data-table="comentariosavaluo" data-field="x_descripcion" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($comentariosavaluo->descripcion->OldValue) ?>">
<?php } ?>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_descripcion" class="form-group comentariosavaluo_descripcion">
<textarea data-table="comentariosavaluo" data-field="x_descripcion" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($comentariosavaluo->descripcion->getPlaceHolder()) ?>"<?php echo $comentariosavaluo->descripcion->EditAttributes() ?>><?php echo $comentariosavaluo->descripcion->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_descripcion" class="comentariosavaluo_descripcion">
<span<?php echo $comentariosavaluo->descripcion->ViewAttributes() ?>>
<?php echo $comentariosavaluo->descripcion->ListViewValue() ?></span>
</span>
<?php if ($comentariosavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_descripcion" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($comentariosavaluo->descripcion->FormValue) ?>">
<input type="hidden" data-table="comentariosavaluo" data-field="x_descripcion" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($comentariosavaluo->descripcion->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_descripcion" name="fcomentariosavaluogrid$x<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" id="fcomentariosavaluogrid$x<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($comentariosavaluo->descripcion->FormValue) ?>">
<input type="hidden" data-table="comentariosavaluo" data-field="x_descripcion" name="fcomentariosavaluogrid$o<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" id="fcomentariosavaluogrid$o<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($comentariosavaluo->descripcion->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$comentariosavaluo_grid->ListOptions->Render("body", "right", $comentariosavaluo_grid->RowCnt);
?>
	</tr>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_ADD || $comentariosavaluo->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fcomentariosavaluogrid.UpdateOpts(<?php echo $comentariosavaluo_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($comentariosavaluo->CurrentAction <> "gridadd" || $comentariosavaluo->CurrentMode == "copy")
		if (!$comentariosavaluo_grid->Recordset->EOF) $comentariosavaluo_grid->Recordset->MoveNext();
}
?>
<?php
	if ($comentariosavaluo->CurrentMode == "add" || $comentariosavaluo->CurrentMode == "copy" || $comentariosavaluo->CurrentMode == "edit") {
		$comentariosavaluo_grid->RowIndex = '$rowindex$';
		$comentariosavaluo_grid->LoadRowValues();

		// Set row properties
		$comentariosavaluo->ResetAttrs();
		$comentariosavaluo->RowAttrs = array_merge($comentariosavaluo->RowAttrs, array('data-rowindex'=>$comentariosavaluo_grid->RowIndex, 'id'=>'r0_comentariosavaluo', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($comentariosavaluo->RowAttrs["class"], "ewTemplate");
		$comentariosavaluo->RowType = EW_ROWTYPE_ADD;

		// Render row
		$comentariosavaluo_grid->RenderRow();

		// Render list options
		$comentariosavaluo_grid->RenderListOptions();
		$comentariosavaluo_grid->StartRowCnt = 0;
?>
	<tr<?php echo $comentariosavaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$comentariosavaluo_grid->ListOptions->Render("body", "left", $comentariosavaluo_grid->RowIndex);
?>
	<?php if ($comentariosavaluo->id->Visible) { // id ?>
		<td data-name="id">
<?php if ($comentariosavaluo->CurrentAction <> "F") { ?>
<?php } else { ?>
<span id="el$rowindex$_comentariosavaluo_id" class="form-group comentariosavaluo_id">
<span<?php echo $comentariosavaluo->id->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $comentariosavaluo->id->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="comentariosavaluo" data-field="x_id" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($comentariosavaluo->id->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_id" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_id" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($comentariosavaluo->id->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($comentariosavaluo->usuario->Visible) { // usuario ?>
		<td data-name="usuario">
<?php if ($comentariosavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_comentariosavaluo_usuario" class="form-group comentariosavaluo_usuario">
<select data-table="comentariosavaluo" data-field="x_usuario" data-value-separator="<?php echo $comentariosavaluo->usuario->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario"<?php echo $comentariosavaluo->usuario->EditAttributes() ?>>
<?php echo $comentariosavaluo->usuario->SelectOptionListHtml("x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_comentariosavaluo_usuario" class="form-group comentariosavaluo_usuario">
<span<?php echo $comentariosavaluo->usuario->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $comentariosavaluo->usuario->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="comentariosavaluo" data-field="x_usuario" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" value="<?php echo ew_HtmlEncode($comentariosavaluo->usuario->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_usuario" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_usuario" value="<?php echo ew_HtmlEncode($comentariosavaluo->usuario->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($comentariosavaluo->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion">
<?php if ($comentariosavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_comentariosavaluo_descripcion" class="form-group comentariosavaluo_descripcion">
<textarea data-table="comentariosavaluo" data-field="x_descripcion" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($comentariosavaluo->descripcion->getPlaceHolder()) ?>"<?php echo $comentariosavaluo->descripcion->EditAttributes() ?>><?php echo $comentariosavaluo->descripcion->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_comentariosavaluo_descripcion" class="form-group comentariosavaluo_descripcion">
<span<?php echo $comentariosavaluo->descripcion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $comentariosavaluo->descripcion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="comentariosavaluo" data-field="x_descripcion" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($comentariosavaluo->descripcion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_descripcion" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($comentariosavaluo->descripcion->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$comentariosavaluo_grid->ListOptions->Render("body", "right", $comentariosavaluo_grid->RowCnt);
?>
<script type="text/javascript">
fcomentariosavaluogrid.UpdateOpts(<?php echo $comentariosavaluo_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($comentariosavaluo->CurrentMode == "add" || $comentariosavaluo->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $comentariosavaluo_grid->FormKeyCountName ?>" id="<?php echo $comentariosavaluo_grid->FormKeyCountName ?>" value="<?php echo $comentariosavaluo_grid->KeyCount ?>">
<?php echo $comentariosavaluo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($comentariosavaluo->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $comentariosavaluo_grid->FormKeyCountName ?>" id="<?php echo $comentariosavaluo_grid->FormKeyCountName ?>" value="<?php echo $comentariosavaluo_grid->KeyCount ?>">
<?php echo $comentariosavaluo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($comentariosavaluo->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fcomentariosavaluogrid">
</div>
<?php

// Close recordset
if ($comentariosavaluo_grid->Recordset)
	$comentariosavaluo_grid->Recordset->Close();
?>
<?php if ($comentariosavaluo_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($comentariosavaluo_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($comentariosavaluo_grid->TotalRecs == 0 && $comentariosavaluo->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($comentariosavaluo_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($comentariosavaluo->Export == "") { ?>
<script type="text/javascript">
fcomentariosavaluogrid.Init();
</script>
<?php } ?>
<?php
$comentariosavaluo_grid->Page_Terminate();
?>
