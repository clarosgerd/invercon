<?php include_once "usuarioinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($viewdocumentoinspector_grid)) $viewdocumentoinspector_grid = new cviewdocumentoinspector_grid();

// Page init
$viewdocumentoinspector_grid->Page_Init();

// Page main
$viewdocumentoinspector_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewdocumentoinspector_grid->Page_Render();
?>
<?php if ($viewdocumentoinspector->Export == "") { ?>
<script type="text/javascript">

// Form object
var fviewdocumentoinspectorgrid = new ew_Form("fviewdocumentoinspectorgrid", "grid");
fviewdocumentoinspectorgrid.FormKeyCountName = '<?php echo $viewdocumentoinspector_grid->FormKeyCountName ?>';

// Validate form
fviewdocumentoinspectorgrid.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewdocumentoinspector->descripcion->FldCaption(), $viewdocumentoinspector->descripcion->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fviewdocumentoinspectorgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "descripcion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "imagen", false)) return false;
	if (ew_ValueChanged(fobj, infix, "avaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_tipodocumento", false)) return false;
	return true;
}

// Form_CustomValidate event
fviewdocumentoinspectorgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewdocumentoinspectorgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewdocumentoinspectorgrid.Lists["x_avaluo"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tipoinmueble","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"avaluo"};
fviewdocumentoinspectorgrid.Lists["x_avaluo"].Data = "<?php echo $viewdocumentoinspector_grid->avaluo->LookupFilterQuery(FALSE, "grid") ?>";
fviewdocumentoinspectorgrid.Lists["x_id_tipodocumento"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipodocumento"};
fviewdocumentoinspectorgrid.Lists["x_id_tipodocumento"].Data = "<?php echo $viewdocumentoinspector_grid->id_tipodocumento->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($viewdocumentoinspector->CurrentAction == "gridadd") {
	if ($viewdocumentoinspector->CurrentMode == "copy") {
		$bSelectLimit = $viewdocumentoinspector_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$viewdocumentoinspector_grid->TotalRecs = $viewdocumentoinspector->ListRecordCount();
			$viewdocumentoinspector_grid->Recordset = $viewdocumentoinspector_grid->LoadRecordset($viewdocumentoinspector_grid->StartRec-1, $viewdocumentoinspector_grid->DisplayRecs);
		} else {
			if ($viewdocumentoinspector_grid->Recordset = $viewdocumentoinspector_grid->LoadRecordset())
				$viewdocumentoinspector_grid->TotalRecs = $viewdocumentoinspector_grid->Recordset->RecordCount();
		}
		$viewdocumentoinspector_grid->StartRec = 1;
		$viewdocumentoinspector_grid->DisplayRecs = $viewdocumentoinspector_grid->TotalRecs;
	} else {
		$viewdocumentoinspector->CurrentFilter = "0=1";
		$viewdocumentoinspector_grid->StartRec = 1;
		$viewdocumentoinspector_grid->DisplayRecs = $viewdocumentoinspector->GridAddRowCount;
	}
	$viewdocumentoinspector_grid->TotalRecs = $viewdocumentoinspector_grid->DisplayRecs;
	$viewdocumentoinspector_grid->StopRec = $viewdocumentoinspector_grid->DisplayRecs;
} else {
	$bSelectLimit = $viewdocumentoinspector_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($viewdocumentoinspector_grid->TotalRecs <= 0)
			$viewdocumentoinspector_grid->TotalRecs = $viewdocumentoinspector->ListRecordCount();
	} else {
		if (!$viewdocumentoinspector_grid->Recordset && ($viewdocumentoinspector_grid->Recordset = $viewdocumentoinspector_grid->LoadRecordset()))
			$viewdocumentoinspector_grid->TotalRecs = $viewdocumentoinspector_grid->Recordset->RecordCount();
	}
	$viewdocumentoinspector_grid->StartRec = 1;
	$viewdocumentoinspector_grid->DisplayRecs = $viewdocumentoinspector_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$viewdocumentoinspector_grid->Recordset = $viewdocumentoinspector_grid->LoadRecordset($viewdocumentoinspector_grid->StartRec-1, $viewdocumentoinspector_grid->DisplayRecs);

	// Set no record found message
	if ($viewdocumentoinspector->CurrentAction == "" && $viewdocumentoinspector_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$viewdocumentoinspector_grid->setWarningMessage(ew_DeniedMsg());
		if ($viewdocumentoinspector_grid->SearchWhere == "0=101")
			$viewdocumentoinspector_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$viewdocumentoinspector_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$viewdocumentoinspector_grid->RenderOtherOptions();
?>
<?php $viewdocumentoinspector_grid->ShowPageHeader(); ?>
<?php
$viewdocumentoinspector_grid->ShowMessage();
?>
<?php if ($viewdocumentoinspector_grid->TotalRecs > 0 || $viewdocumentoinspector->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($viewdocumentoinspector_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewdocumentoinspector">
<div id="fviewdocumentoinspectorgrid" class="ewForm ewListForm form-inline">
<div id="gmp_viewdocumentoinspector" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_viewdocumentoinspectorgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$viewdocumentoinspector_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$viewdocumentoinspector_grid->RenderListOptions();

// Render list options (header, left)
$viewdocumentoinspector_grid->ListOptions->Render("header", "left");
?>
<?php if ($viewdocumentoinspector->descripcion->Visible) { // descripcion ?>
	<?php if ($viewdocumentoinspector->SortUrl($viewdocumentoinspector->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $viewdocumentoinspector->descripcion->HeaderCellClass() ?>"><div id="elh_viewdocumentoinspector_descripcion" class="viewdocumentoinspector_descripcion"><div class="ewTableHeaderCaption"><?php echo $viewdocumentoinspector->descripcion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $viewdocumentoinspector->descripcion->HeaderCellClass() ?>"><div><div id="elh_viewdocumentoinspector_descripcion" class="viewdocumentoinspector_descripcion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentoinspector->descripcion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentoinspector->descripcion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentoinspector->descripcion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewdocumentoinspector->imagen->Visible) { // imagen ?>
	<?php if ($viewdocumentoinspector->SortUrl($viewdocumentoinspector->imagen) == "") { ?>
		<th data-name="imagen" class="<?php echo $viewdocumentoinspector->imagen->HeaderCellClass() ?>"><div id="elh_viewdocumentoinspector_imagen" class="viewdocumentoinspector_imagen"><div class="ewTableHeaderCaption"><?php echo $viewdocumentoinspector->imagen->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="imagen" class="<?php echo $viewdocumentoinspector->imagen->HeaderCellClass() ?>"><div><div id="elh_viewdocumentoinspector_imagen" class="viewdocumentoinspector_imagen">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentoinspector->imagen->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentoinspector->imagen->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentoinspector->imagen->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewdocumentoinspector->avaluo->Visible) { // avaluo ?>
	<?php if ($viewdocumentoinspector->SortUrl($viewdocumentoinspector->avaluo) == "") { ?>
		<th data-name="avaluo" class="<?php echo $viewdocumentoinspector->avaluo->HeaderCellClass() ?>"><div id="elh_viewdocumentoinspector_avaluo" class="viewdocumentoinspector_avaluo"><div class="ewTableHeaderCaption"><?php echo $viewdocumentoinspector->avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="avaluo" class="<?php echo $viewdocumentoinspector->avaluo->HeaderCellClass() ?>"><div><div id="elh_viewdocumentoinspector_avaluo" class="viewdocumentoinspector_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentoinspector->avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentoinspector->avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentoinspector->avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewdocumentoinspector->id_tipodocumento->Visible) { // id_tipodocumento ?>
	<?php if ($viewdocumentoinspector->SortUrl($viewdocumentoinspector->id_tipodocumento) == "") { ?>
		<th data-name="id_tipodocumento" class="<?php echo $viewdocumentoinspector->id_tipodocumento->HeaderCellClass() ?>"><div id="elh_viewdocumentoinspector_id_tipodocumento" class="viewdocumentoinspector_id_tipodocumento"><div class="ewTableHeaderCaption"><?php echo $viewdocumentoinspector->id_tipodocumento->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_tipodocumento" class="<?php echo $viewdocumentoinspector->id_tipodocumento->HeaderCellClass() ?>"><div><div id="elh_viewdocumentoinspector_id_tipodocumento" class="viewdocumentoinspector_id_tipodocumento">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentoinspector->id_tipodocumento->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentoinspector->id_tipodocumento->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentoinspector->id_tipodocumento->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$viewdocumentoinspector_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$viewdocumentoinspector_grid->StartRec = 1;
$viewdocumentoinspector_grid->StopRec = $viewdocumentoinspector_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($viewdocumentoinspector_grid->FormKeyCountName) && ($viewdocumentoinspector->CurrentAction == "gridadd" || $viewdocumentoinspector->CurrentAction == "gridedit" || $viewdocumentoinspector->CurrentAction == "F")) {
		$viewdocumentoinspector_grid->KeyCount = $objForm->GetValue($viewdocumentoinspector_grid->FormKeyCountName);
		$viewdocumentoinspector_grid->StopRec = $viewdocumentoinspector_grid->StartRec + $viewdocumentoinspector_grid->KeyCount - 1;
	}
}
$viewdocumentoinspector_grid->RecCnt = $viewdocumentoinspector_grid->StartRec - 1;
if ($viewdocumentoinspector_grid->Recordset && !$viewdocumentoinspector_grid->Recordset->EOF) {
	$viewdocumentoinspector_grid->Recordset->MoveFirst();
	$bSelectLimit = $viewdocumentoinspector_grid->UseSelectLimit;
	if (!$bSelectLimit && $viewdocumentoinspector_grid->StartRec > 1)
		$viewdocumentoinspector_grid->Recordset->Move($viewdocumentoinspector_grid->StartRec - 1);
} elseif (!$viewdocumentoinspector->AllowAddDeleteRow && $viewdocumentoinspector_grid->StopRec == 0) {
	$viewdocumentoinspector_grid->StopRec = $viewdocumentoinspector->GridAddRowCount;
}

// Initialize aggregate
$viewdocumentoinspector->RowType = EW_ROWTYPE_AGGREGATEINIT;
$viewdocumentoinspector->ResetAttrs();
$viewdocumentoinspector_grid->RenderRow();
if ($viewdocumentoinspector->CurrentAction == "gridadd")
	$viewdocumentoinspector_grid->RowIndex = 0;
if ($viewdocumentoinspector->CurrentAction == "gridedit")
	$viewdocumentoinspector_grid->RowIndex = 0;
while ($viewdocumentoinspector_grid->RecCnt < $viewdocumentoinspector_grid->StopRec) {
	$viewdocumentoinspector_grid->RecCnt++;
	if (intval($viewdocumentoinspector_grid->RecCnt) >= intval($viewdocumentoinspector_grid->StartRec)) {
		$viewdocumentoinspector_grid->RowCnt++;
		if ($viewdocumentoinspector->CurrentAction == "gridadd" || $viewdocumentoinspector->CurrentAction == "gridedit" || $viewdocumentoinspector->CurrentAction == "F") {
			$viewdocumentoinspector_grid->RowIndex++;
			$objForm->Index = $viewdocumentoinspector_grid->RowIndex;
			if ($objForm->HasValue($viewdocumentoinspector_grid->FormActionName))
				$viewdocumentoinspector_grid->RowAction = strval($objForm->GetValue($viewdocumentoinspector_grid->FormActionName));
			elseif ($viewdocumentoinspector->CurrentAction == "gridadd")
				$viewdocumentoinspector_grid->RowAction = "insert";
			else
				$viewdocumentoinspector_grid->RowAction = "";
		}

		// Set up key count
		$viewdocumentoinspector_grid->KeyCount = $viewdocumentoinspector_grid->RowIndex;

		// Init row class and style
		$viewdocumentoinspector->ResetAttrs();
		$viewdocumentoinspector->CssClass = "";
		if ($viewdocumentoinspector->CurrentAction == "gridadd") {
			if ($viewdocumentoinspector->CurrentMode == "copy") {
				$viewdocumentoinspector_grid->LoadRowValues($viewdocumentoinspector_grid->Recordset); // Load row values
				$viewdocumentoinspector_grid->SetRecordKey($viewdocumentoinspector_grid->RowOldKey, $viewdocumentoinspector_grid->Recordset); // Set old record key
			} else {
				$viewdocumentoinspector_grid->LoadRowValues(); // Load default values
				$viewdocumentoinspector_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$viewdocumentoinspector_grid->LoadRowValues($viewdocumentoinspector_grid->Recordset); // Load row values
		}
		$viewdocumentoinspector->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($viewdocumentoinspector->CurrentAction == "gridadd") // Grid add
			$viewdocumentoinspector->RowType = EW_ROWTYPE_ADD; // Render add
		if ($viewdocumentoinspector->CurrentAction == "gridadd" && $viewdocumentoinspector->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$viewdocumentoinspector_grid->RestoreCurrentRowFormValues($viewdocumentoinspector_grid->RowIndex); // Restore form values
		if ($viewdocumentoinspector->CurrentAction == "gridedit") { // Grid edit
			if ($viewdocumentoinspector->EventCancelled) {
				$viewdocumentoinspector_grid->RestoreCurrentRowFormValues($viewdocumentoinspector_grid->RowIndex); // Restore form values
			}
			if ($viewdocumentoinspector_grid->RowAction == "insert")
				$viewdocumentoinspector->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$viewdocumentoinspector->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($viewdocumentoinspector->CurrentAction == "gridedit" && ($viewdocumentoinspector->RowType == EW_ROWTYPE_EDIT || $viewdocumentoinspector->RowType == EW_ROWTYPE_ADD) && $viewdocumentoinspector->EventCancelled) // Update failed
			$viewdocumentoinspector_grid->RestoreCurrentRowFormValues($viewdocumentoinspector_grid->RowIndex); // Restore form values
		if ($viewdocumentoinspector->RowType == EW_ROWTYPE_EDIT) // Edit row
			$viewdocumentoinspector_grid->EditRowCnt++;
		if ($viewdocumentoinspector->CurrentAction == "F") // Confirm row
			$viewdocumentoinspector_grid->RestoreCurrentRowFormValues($viewdocumentoinspector_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$viewdocumentoinspector->RowAttrs = array_merge($viewdocumentoinspector->RowAttrs, array('data-rowindex'=>$viewdocumentoinspector_grid->RowCnt, 'id'=>'r' . $viewdocumentoinspector_grid->RowCnt . '_viewdocumentoinspector', 'data-rowtype'=>$viewdocumentoinspector->RowType));

		// Render row
		$viewdocumentoinspector_grid->RenderRow();

		// Render list options
		$viewdocumentoinspector_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($viewdocumentoinspector_grid->RowAction <> "delete" && $viewdocumentoinspector_grid->RowAction <> "insertdelete" && !($viewdocumentoinspector_grid->RowAction == "insert" && $viewdocumentoinspector->CurrentAction == "F" && $viewdocumentoinspector_grid->EmptyRow())) {
?>
	<tr<?php echo $viewdocumentoinspector->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewdocumentoinspector_grid->ListOptions->Render("body", "left", $viewdocumentoinspector_grid->RowCnt);
?>
	<?php if ($viewdocumentoinspector->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion"<?php echo $viewdocumentoinspector->descripcion->CellAttributes() ?>>
<?php if ($viewdocumentoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_descripcion" class="form-group viewdocumentoinspector_descripcion">
<textarea data-table="viewdocumentoinspector" data-field="x_descripcion" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentoinspector->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentoinspector->descripcion->EditAttributes() ?>><?php echo $viewdocumentoinspector->descripcion->EditValue ?></textarea>
</span>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_descripcion" name="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" id="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->descripcion->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentoinspector->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_descripcion" class="form-group viewdocumentoinspector_descripcion">
<textarea data-table="viewdocumentoinspector" data-field="x_descripcion" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentoinspector->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentoinspector->descripcion->EditAttributes() ?>><?php echo $viewdocumentoinspector->descripcion->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($viewdocumentoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_descripcion" class="viewdocumentoinspector_descripcion">
<span<?php echo $viewdocumentoinspector->descripcion->ViewAttributes() ?>>
<?php echo $viewdocumentoinspector->descripcion->ListViewValue() ?></span>
</span>
<?php if ($viewdocumentoinspector->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_descripcion" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->descripcion->FormValue) ?>">
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_descripcion" name="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" id="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->descripcion->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_descripcion" name="fviewdocumentoinspectorgrid$x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" id="fviewdocumentoinspectorgrid$x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->descripcion->FormValue) ?>">
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_descripcion" name="fviewdocumentoinspectorgrid$o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" id="fviewdocumentoinspectorgrid$o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->descripcion->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($viewdocumentoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->id->CurrentValue) ?>">
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id" name="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id" id="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->id->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentoinspector->RowType == EW_ROWTYPE_EDIT || $viewdocumentoinspector->CurrentMode == "edit") { ?>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($viewdocumentoinspector->imagen->Visible) { // imagen ?>
		<td data-name="imagen"<?php echo $viewdocumentoinspector->imagen->CellAttributes() ?>>
<?php if ($viewdocumentoinspector_grid->RowAction == "insert") { // Add record ?>
<span id="el$rowindex$_viewdocumentoinspector_imagen" class="form-group viewdocumentoinspector_imagen">
<div id="fd_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen">
<span title="<?php echo $viewdocumentoinspector->imagen->FldTitle() ? $viewdocumentoinspector->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentoinspector->imagen->ReadOnly || $viewdocumentoinspector->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentoinspector" data-field="x_imagen" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen"<?php echo $viewdocumentoinspector->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentoinspector->imagen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fs_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentoinspector->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentoinspector->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_imagen" name="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->imagen->OldValue) ?>">
<?php } elseif ($viewdocumentoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_imagen" class="viewdocumentoinspector_imagen">
<span<?php echo $viewdocumentoinspector->imagen->ViewAttributes() ?>>
<?php echo ew_GetFileViewTag($viewdocumentoinspector->imagen, $viewdocumentoinspector->imagen->ListViewValue()) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_imagen" class="form-group viewdocumentoinspector_imagen">
<div id="fd_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen">
<span title="<?php echo $viewdocumentoinspector->imagen->FldTitle() ? $viewdocumentoinspector->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentoinspector->imagen->ReadOnly || $viewdocumentoinspector->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentoinspector" data-field="x_imagen" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen"<?php echo $viewdocumentoinspector->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentoinspector->imagen->Upload->FileName ?>">
<?php if (@$_POST["fa_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen"] == "0") { ?>
<input type="hidden" name="fa_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentoinspector->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentoinspector->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewdocumentoinspector->avaluo->Visible) { // avaluo ?>
		<td data-name="avaluo"<?php echo $viewdocumentoinspector->avaluo->CellAttributes() ?>>
<?php if ($viewdocumentoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($viewdocumentoinspector->avaluo->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_avaluo" class="form-group viewdocumentoinspector_avaluo">
<span<?php echo $viewdocumentoinspector->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentoinspector->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_avaluo" class="form-group viewdocumentoinspector_avaluo">
<select data-table="viewdocumentoinspector" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentoinspector->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo"<?php echo $viewdocumentoinspector->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentoinspector->avaluo->SelectOptionListHtml("x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_avaluo" name="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" id="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->avaluo->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentoinspector->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($viewdocumentoinspector->avaluo->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_avaluo" class="form-group viewdocumentoinspector_avaluo">
<span<?php echo $viewdocumentoinspector->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentoinspector->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_avaluo" class="form-group viewdocumentoinspector_avaluo">
<select data-table="viewdocumentoinspector" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentoinspector->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo"<?php echo $viewdocumentoinspector->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentoinspector->avaluo->SelectOptionListHtml("x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_avaluo" class="viewdocumentoinspector_avaluo">
<span<?php echo $viewdocumentoinspector->avaluo->ViewAttributes() ?>>
<?php echo $viewdocumentoinspector->avaluo->ListViewValue() ?></span>
</span>
<?php if ($viewdocumentoinspector->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_avaluo" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->avaluo->FormValue) ?>">
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_avaluo" name="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" id="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->avaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_avaluo" name="fviewdocumentoinspectorgrid$x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" id="fviewdocumentoinspectorgrid$x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->avaluo->FormValue) ?>">
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_avaluo" name="fviewdocumentoinspectorgrid$o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" id="fviewdocumentoinspectorgrid$o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->avaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewdocumentoinspector->id_tipodocumento->Visible) { // id_tipodocumento ?>
		<td data-name="id_tipodocumento"<?php echo $viewdocumentoinspector->id_tipodocumento->CellAttributes() ?>>
<?php if ($viewdocumentoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_id_tipodocumento" class="form-group viewdocumentoinspector_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($viewdocumentoinspector->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentoinspector->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentoinspector->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentoinspector->id_tipodocumento->ReadOnly || $viewdocumentoinspector->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentoinspector->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $viewdocumentoinspector->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentoinspector->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentoinspector->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentoinspector->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentoinspector->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id_tipodocumento" name="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->id_tipodocumento->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentoinspector->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_id_tipodocumento" class="form-group viewdocumentoinspector_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($viewdocumentoinspector->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentoinspector->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentoinspector->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentoinspector->id_tipodocumento->ReadOnly || $viewdocumentoinspector->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentoinspector->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $viewdocumentoinspector->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentoinspector->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentoinspector->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentoinspector->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentoinspector->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } ?>
<?php if ($viewdocumentoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentoinspector_grid->RowCnt ?>_viewdocumentoinspector_id_tipodocumento" class="viewdocumentoinspector_id_tipodocumento">
<span<?php echo $viewdocumentoinspector->id_tipodocumento->ViewAttributes() ?>>
<?php echo $viewdocumentoinspector->id_tipodocumento->ListViewValue() ?></span>
</span>
<?php if ($viewdocumentoinspector->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id_tipodocumento" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->id_tipodocumento->FormValue) ?>">
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id_tipodocumento" name="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->id_tipodocumento->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id_tipodocumento" name="fviewdocumentoinspectorgrid$x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" id="fviewdocumentoinspectorgrid$x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->id_tipodocumento->FormValue) ?>">
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id_tipodocumento" name="fviewdocumentoinspectorgrid$o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" id="fviewdocumentoinspectorgrid$o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->id_tipodocumento->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewdocumentoinspector_grid->ListOptions->Render("body", "right", $viewdocumentoinspector_grid->RowCnt);
?>
	</tr>
<?php if ($viewdocumentoinspector->RowType == EW_ROWTYPE_ADD || $viewdocumentoinspector->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fviewdocumentoinspectorgrid.UpdateOpts(<?php echo $viewdocumentoinspector_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($viewdocumentoinspector->CurrentAction <> "gridadd" || $viewdocumentoinspector->CurrentMode == "copy")
		if (!$viewdocumentoinspector_grid->Recordset->EOF) $viewdocumentoinspector_grid->Recordset->MoveNext();
}
?>
<?php
	if ($viewdocumentoinspector->CurrentMode == "add" || $viewdocumentoinspector->CurrentMode == "copy" || $viewdocumentoinspector->CurrentMode == "edit") {
		$viewdocumentoinspector_grid->RowIndex = '$rowindex$';
		$viewdocumentoinspector_grid->LoadRowValues();

		// Set row properties
		$viewdocumentoinspector->ResetAttrs();
		$viewdocumentoinspector->RowAttrs = array_merge($viewdocumentoinspector->RowAttrs, array('data-rowindex'=>$viewdocumentoinspector_grid->RowIndex, 'id'=>'r0_viewdocumentoinspector', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($viewdocumentoinspector->RowAttrs["class"], "ewTemplate");
		$viewdocumentoinspector->RowType = EW_ROWTYPE_ADD;

		// Render row
		$viewdocumentoinspector_grid->RenderRow();

		// Render list options
		$viewdocumentoinspector_grid->RenderListOptions();
		$viewdocumentoinspector_grid->StartRowCnt = 0;
?>
	<tr<?php echo $viewdocumentoinspector->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewdocumentoinspector_grid->ListOptions->Render("body", "left", $viewdocumentoinspector_grid->RowIndex);
?>
	<?php if ($viewdocumentoinspector->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion">
<?php if ($viewdocumentoinspector->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewdocumentoinspector_descripcion" class="form-group viewdocumentoinspector_descripcion">
<textarea data-table="viewdocumentoinspector" data-field="x_descripcion" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentoinspector->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentoinspector->descripcion->EditAttributes() ?>><?php echo $viewdocumentoinspector->descripcion->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewdocumentoinspector_descripcion" class="form-group viewdocumentoinspector_descripcion">
<span<?php echo $viewdocumentoinspector->descripcion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentoinspector->descripcion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_descripcion" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->descripcion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_descripcion" name="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" id="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->descripcion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewdocumentoinspector->imagen->Visible) { // imagen ?>
		<td data-name="imagen">
<span id="el$rowindex$_viewdocumentoinspector_imagen" class="form-group viewdocumentoinspector_imagen">
<div id="fd_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen">
<span title="<?php echo $viewdocumentoinspector->imagen->FldTitle() ? $viewdocumentoinspector->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentoinspector->imagen->ReadOnly || $viewdocumentoinspector->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentoinspector" data-field="x_imagen" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen"<?php echo $viewdocumentoinspector->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentoinspector->imagen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fs_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentoinspector->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentoinspector->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_imagen" name="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" id="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->imagen->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewdocumentoinspector->avaluo->Visible) { // avaluo ?>
		<td data-name="avaluo">
<?php if ($viewdocumentoinspector->CurrentAction <> "F") { ?>
<?php if ($viewdocumentoinspector->avaluo->getSessionValue() <> "") { ?>
<span id="el$rowindex$_viewdocumentoinspector_avaluo" class="form-group viewdocumentoinspector_avaluo">
<span<?php echo $viewdocumentoinspector->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentoinspector->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_viewdocumentoinspector_avaluo" class="form-group viewdocumentoinspector_avaluo">
<select data-table="viewdocumentoinspector" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentoinspector->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo"<?php echo $viewdocumentoinspector->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentoinspector->avaluo->SelectOptionListHtml("x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_viewdocumentoinspector_avaluo" class="form-group viewdocumentoinspector_avaluo">
<span<?php echo $viewdocumentoinspector->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentoinspector->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_avaluo" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->avaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_avaluo" name="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" id="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->avaluo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewdocumentoinspector->id_tipodocumento->Visible) { // id_tipodocumento ?>
		<td data-name="id_tipodocumento">
<?php if ($viewdocumentoinspector->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewdocumentoinspector_id_tipodocumento" class="form-group viewdocumentoinspector_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($viewdocumentoinspector->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentoinspector->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentoinspector->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentoinspector->id_tipodocumento->ReadOnly || $viewdocumentoinspector->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentoinspector->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $viewdocumentoinspector->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentoinspector->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentoinspector->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentoinspector->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentoinspector->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewdocumentoinspector_id_tipodocumento" class="form-group viewdocumentoinspector_id_tipodocumento">
<span<?php echo $viewdocumentoinspector->id_tipodocumento->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentoinspector->id_tipodocumento->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id_tipodocumento" name="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->id_tipodocumento->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewdocumentoinspector" data-field="x_id_tipodocumento" name="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $viewdocumentoinspector_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentoinspector->id_tipodocumento->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewdocumentoinspector_grid->ListOptions->Render("body", "right", $viewdocumentoinspector_grid->RowCnt);
?>
<script type="text/javascript">
fviewdocumentoinspectorgrid.UpdateOpts(<?php echo $viewdocumentoinspector_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($viewdocumentoinspector->CurrentMode == "add" || $viewdocumentoinspector->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $viewdocumentoinspector_grid->FormKeyCountName ?>" id="<?php echo $viewdocumentoinspector_grid->FormKeyCountName ?>" value="<?php echo $viewdocumentoinspector_grid->KeyCount ?>">
<?php echo $viewdocumentoinspector_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewdocumentoinspector->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $viewdocumentoinspector_grid->FormKeyCountName ?>" id="<?php echo $viewdocumentoinspector_grid->FormKeyCountName ?>" value="<?php echo $viewdocumentoinspector_grid->KeyCount ?>">
<?php echo $viewdocumentoinspector_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewdocumentoinspector->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fviewdocumentoinspectorgrid">
</div>
<?php

// Close recordset
if ($viewdocumentoinspector_grid->Recordset)
	$viewdocumentoinspector_grid->Recordset->Close();
?>
<?php if ($viewdocumentoinspector_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($viewdocumentoinspector_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($viewdocumentoinspector_grid->TotalRecs == 0 && $viewdocumentoinspector->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewdocumentoinspector_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($viewdocumentoinspector->Export == "") { ?>
<script type="text/javascript">
fviewdocumentoinspectorgrid.Init();
</script>
<?php } ?>
<?php
$viewdocumentoinspector_grid->Page_Terminate();
?>
