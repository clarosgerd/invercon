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
			elm = this.GetElements("x" + infix + "_id_avaluo");
			if (elm && !ew_CheckInteger(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($comentariosavaluo->id_avaluo->FldErrMsg()) ?>");
			elm = this.GetElements("x" + infix + "_created_at");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $comentariosavaluo->created_at->FldCaption(), $comentariosavaluo->created_at->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_created_at");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($comentariosavaluo->created_at->FldErrMsg()) ?>");

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
	if (ew_ValueChanged(fobj, infix, "id_avaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "created_at", false)) return false;
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
<?php if ($comentariosavaluo->id_avaluo->Visible) { // id_avaluo ?>
	<?php if ($comentariosavaluo->SortUrl($comentariosavaluo->id_avaluo) == "") { ?>
		<th data-name="id_avaluo" class="<?php echo $comentariosavaluo->id_avaluo->HeaderCellClass() ?>"><div id="elh_comentariosavaluo_id_avaluo" class="comentariosavaluo_id_avaluo"><div class="ewTableHeaderCaption"><?php echo $comentariosavaluo->id_avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_avaluo" class="<?php echo $comentariosavaluo->id_avaluo->HeaderCellClass() ?>"><div><div id="elh_comentariosavaluo_id_avaluo" class="comentariosavaluo_id_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $comentariosavaluo->id_avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($comentariosavaluo->id_avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($comentariosavaluo->id_avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($comentariosavaluo->created_at->Visible) { // created_at ?>
	<?php if ($comentariosavaluo->SortUrl($comentariosavaluo->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $comentariosavaluo->created_at->HeaderCellClass() ?>"><div id="elh_comentariosavaluo_created_at" class="comentariosavaluo_created_at"><div class="ewTableHeaderCaption"><?php echo $comentariosavaluo->created_at->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $comentariosavaluo->created_at->HeaderCellClass() ?>"><div><div id="elh_comentariosavaluo_created_at" class="comentariosavaluo_created_at">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $comentariosavaluo->created_at->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($comentariosavaluo->created_at->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($comentariosavaluo->created_at->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
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
	<?php if ($comentariosavaluo->id_avaluo->Visible) { // id_avaluo ?>
		<td data-name="id_avaluo"<?php echo $comentariosavaluo->id_avaluo->CellAttributes() ?>>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($comentariosavaluo->id_avaluo->getSessionValue() <> "") { ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_id_avaluo" class="form-group comentariosavaluo_id_avaluo">
<span<?php echo $comentariosavaluo->id_avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $comentariosavaluo->id_avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" value="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_id_avaluo" class="form-group comentariosavaluo_id_avaluo">
<input type="text" data-table="comentariosavaluo" data-field="x_id_avaluo" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" size="30" placeholder="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->getPlaceHolder()) ?>" value="<?php echo $comentariosavaluo->id_avaluo->EditValue ?>"<?php echo $comentariosavaluo->id_avaluo->EditAttributes() ?>>
</span>
<?php } ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_id_avaluo" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" value="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->OldValue) ?>">
<?php } ?>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($comentariosavaluo->id_avaluo->getSessionValue() <> "") { ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_id_avaluo" class="form-group comentariosavaluo_id_avaluo">
<span<?php echo $comentariosavaluo->id_avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $comentariosavaluo->id_avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" value="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_id_avaluo" class="form-group comentariosavaluo_id_avaluo">
<input type="text" data-table="comentariosavaluo" data-field="x_id_avaluo" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" size="30" placeholder="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->getPlaceHolder()) ?>" value="<?php echo $comentariosavaluo->id_avaluo->EditValue ?>"<?php echo $comentariosavaluo->id_avaluo->EditAttributes() ?>>
</span>
<?php } ?>
<?php } ?>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_id_avaluo" class="comentariosavaluo_id_avaluo">
<span<?php echo $comentariosavaluo->id_avaluo->ViewAttributes() ?>>
<?php echo $comentariosavaluo->id_avaluo->ListViewValue() ?></span>
</span>
<?php if ($comentariosavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_id_avaluo" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" value="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->FormValue) ?>">
<input type="hidden" data-table="comentariosavaluo" data-field="x_id_avaluo" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" value="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_id_avaluo" name="fcomentariosavaluogrid$x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" id="fcomentariosavaluogrid$x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" value="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->FormValue) ?>">
<input type="hidden" data-table="comentariosavaluo" data-field="x_id_avaluo" name="fcomentariosavaluogrid$o<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" id="fcomentariosavaluogrid$o<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" value="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($comentariosavaluo->created_at->Visible) { // created_at ?>
		<td data-name="created_at"<?php echo $comentariosavaluo->created_at->CellAttributes() ?>>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_created_at" class="form-group comentariosavaluo_created_at">
<input type="text" data-table="comentariosavaluo" data-field="x_created_at" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" placeholder="<?php echo ew_HtmlEncode($comentariosavaluo->created_at->getPlaceHolder()) ?>" value="<?php echo $comentariosavaluo->created_at->EditValue ?>"<?php echo $comentariosavaluo->created_at->EditAttributes() ?>>
</span>
<input type="hidden" data-table="comentariosavaluo" data-field="x_created_at" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($comentariosavaluo->created_at->OldValue) ?>">
<?php } ?>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_created_at" class="form-group comentariosavaluo_created_at">
<input type="text" data-table="comentariosavaluo" data-field="x_created_at" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" placeholder="<?php echo ew_HtmlEncode($comentariosavaluo->created_at->getPlaceHolder()) ?>" value="<?php echo $comentariosavaluo->created_at->EditValue ?>"<?php echo $comentariosavaluo->created_at->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($comentariosavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $comentariosavaluo_grid->RowCnt ?>_comentariosavaluo_created_at" class="comentariosavaluo_created_at">
<span<?php echo $comentariosavaluo->created_at->ViewAttributes() ?>>
<?php echo $comentariosavaluo->created_at->ListViewValue() ?></span>
</span>
<?php if ($comentariosavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_created_at" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($comentariosavaluo->created_at->FormValue) ?>">
<input type="hidden" data-table="comentariosavaluo" data-field="x_created_at" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($comentariosavaluo->created_at->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_created_at" name="fcomentariosavaluogrid$x<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" id="fcomentariosavaluogrid$x<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($comentariosavaluo->created_at->FormValue) ?>">
<input type="hidden" data-table="comentariosavaluo" data-field="x_created_at" name="fcomentariosavaluogrid$o<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" id="fcomentariosavaluogrid$o<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($comentariosavaluo->created_at->OldValue) ?>">
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
	<?php if ($comentariosavaluo->id_avaluo->Visible) { // id_avaluo ?>
		<td data-name="id_avaluo">
<?php if ($comentariosavaluo->CurrentAction <> "F") { ?>
<?php if ($comentariosavaluo->id_avaluo->getSessionValue() <> "") { ?>
<span id="el$rowindex$_comentariosavaluo_id_avaluo" class="form-group comentariosavaluo_id_avaluo">
<span<?php echo $comentariosavaluo->id_avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $comentariosavaluo->id_avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" value="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_comentariosavaluo_id_avaluo" class="form-group comentariosavaluo_id_avaluo">
<input type="text" data-table="comentariosavaluo" data-field="x_id_avaluo" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" size="30" placeholder="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->getPlaceHolder()) ?>" value="<?php echo $comentariosavaluo->id_avaluo->EditValue ?>"<?php echo $comentariosavaluo->id_avaluo->EditAttributes() ?>>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_comentariosavaluo_id_avaluo" class="form-group comentariosavaluo_id_avaluo">
<span<?php echo $comentariosavaluo->id_avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $comentariosavaluo->id_avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="comentariosavaluo" data-field="x_id_avaluo" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" value="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_id_avaluo" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_id_avaluo" value="<?php echo ew_HtmlEncode($comentariosavaluo->id_avaluo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($comentariosavaluo->created_at->Visible) { // created_at ?>
		<td data-name="created_at">
<?php if ($comentariosavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_comentariosavaluo_created_at" class="form-group comentariosavaluo_created_at">
<input type="text" data-table="comentariosavaluo" data-field="x_created_at" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" placeholder="<?php echo ew_HtmlEncode($comentariosavaluo->created_at->getPlaceHolder()) ?>" value="<?php echo $comentariosavaluo->created_at->EditValue ?>"<?php echo $comentariosavaluo->created_at->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_comentariosavaluo_created_at" class="form-group comentariosavaluo_created_at">
<span<?php echo $comentariosavaluo->created_at->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $comentariosavaluo->created_at->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="comentariosavaluo" data-field="x_created_at" name="x<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" id="x<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($comentariosavaluo->created_at->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="comentariosavaluo" data-field="x_created_at" name="o<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" id="o<?php echo $comentariosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($comentariosavaluo->created_at->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$comentariosavaluo_grid->ListOptions->Render("body", "right", $comentariosavaluo_grid->RowIndex);
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
