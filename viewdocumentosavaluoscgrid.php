<?php include_once "usuarioinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($viewdocumentosavaluosc_grid)) $viewdocumentosavaluosc_grid = new cviewdocumentosavaluosc_grid();

// Page init
$viewdocumentosavaluosc_grid->Page_Init();

// Page main
$viewdocumentosavaluosc_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewdocumentosavaluosc_grid->Page_Render();
?>
<?php if ($viewdocumentosavaluosc->Export == "") { ?>
<script type="text/javascript">

// Form object
var fviewdocumentosavaluoscgrid = new ew_Form("fviewdocumentosavaluoscgrid", "grid");
fviewdocumentosavaluoscgrid.FormKeyCountName = '<?php echo $viewdocumentosavaluosc_grid->FormKeyCountName ?>';

// Validate form
fviewdocumentosavaluoscgrid.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewdocumentosavaluosc->descripcion->FldCaption(), $viewdocumentosavaluosc->descripcion->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fviewdocumentosavaluoscgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "descripcion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "imagen", false)) return false;
	if (ew_ValueChanged(fobj, infix, "avaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_tipodocumento", false)) return false;
	return true;
}

// Form_CustomValidate event
fviewdocumentosavaluoscgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewdocumentosavaluoscgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewdocumentosavaluoscgrid.Lists["x_avaluo"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tipoinmueble","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"avaluo"};
fviewdocumentosavaluoscgrid.Lists["x_avaluo"].Data = "<?php echo $viewdocumentosavaluosc_grid->avaluo->LookupFilterQuery(FALSE, "grid") ?>";
fviewdocumentosavaluoscgrid.Lists["x_id_tipodocumento"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipodocumento"};
fviewdocumentosavaluoscgrid.Lists["x_id_tipodocumento"].Data = "<?php echo $viewdocumentosavaluosc_grid->id_tipodocumento->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($viewdocumentosavaluosc->CurrentAction == "gridadd") {
	if ($viewdocumentosavaluosc->CurrentMode == "copy") {
		$bSelectLimit = $viewdocumentosavaluosc_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$viewdocumentosavaluosc_grid->TotalRecs = $viewdocumentosavaluosc->ListRecordCount();
			$viewdocumentosavaluosc_grid->Recordset = $viewdocumentosavaluosc_grid->LoadRecordset($viewdocumentosavaluosc_grid->StartRec-1, $viewdocumentosavaluosc_grid->DisplayRecs);
		} else {
			if ($viewdocumentosavaluosc_grid->Recordset = $viewdocumentosavaluosc_grid->LoadRecordset())
				$viewdocumentosavaluosc_grid->TotalRecs = $viewdocumentosavaluosc_grid->Recordset->RecordCount();
		}
		$viewdocumentosavaluosc_grid->StartRec = 1;
		$viewdocumentosavaluosc_grid->DisplayRecs = $viewdocumentosavaluosc_grid->TotalRecs;
	} else {
		$viewdocumentosavaluosc->CurrentFilter = "0=1";
		$viewdocumentosavaluosc_grid->StartRec = 1;
		$viewdocumentosavaluosc_grid->DisplayRecs = $viewdocumentosavaluosc->GridAddRowCount;
	}
	$viewdocumentosavaluosc_grid->TotalRecs = $viewdocumentosavaluosc_grid->DisplayRecs;
	$viewdocumentosavaluosc_grid->StopRec = $viewdocumentosavaluosc_grid->DisplayRecs;
} else {
	$bSelectLimit = $viewdocumentosavaluosc_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($viewdocumentosavaluosc_grid->TotalRecs <= 0)
			$viewdocumentosavaluosc_grid->TotalRecs = $viewdocumentosavaluosc->ListRecordCount();
	} else {
		if (!$viewdocumentosavaluosc_grid->Recordset && ($viewdocumentosavaluosc_grid->Recordset = $viewdocumentosavaluosc_grid->LoadRecordset()))
			$viewdocumentosavaluosc_grid->TotalRecs = $viewdocumentosavaluosc_grid->Recordset->RecordCount();
	}
	$viewdocumentosavaluosc_grid->StartRec = 1;
	$viewdocumentosavaluosc_grid->DisplayRecs = $viewdocumentosavaluosc_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$viewdocumentosavaluosc_grid->Recordset = $viewdocumentosavaluosc_grid->LoadRecordset($viewdocumentosavaluosc_grid->StartRec-1, $viewdocumentosavaluosc_grid->DisplayRecs);

	// Set no record found message
	if ($viewdocumentosavaluosc->CurrentAction == "" && $viewdocumentosavaluosc_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$viewdocumentosavaluosc_grid->setWarningMessage(ew_DeniedMsg());
		if ($viewdocumentosavaluosc_grid->SearchWhere == "0=101")
			$viewdocumentosavaluosc_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$viewdocumentosavaluosc_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$viewdocumentosavaluosc_grid->RenderOtherOptions();
?>
<?php $viewdocumentosavaluosc_grid->ShowPageHeader(); ?>
<?php
$viewdocumentosavaluosc_grid->ShowMessage();
?>
<?php if ($viewdocumentosavaluosc_grid->TotalRecs > 0 || $viewdocumentosavaluosc->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($viewdocumentosavaluosc_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewdocumentosavaluosc">
<div id="fviewdocumentosavaluoscgrid" class="ewForm ewListForm form-inline">
<div id="gmp_viewdocumentosavaluosc" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_viewdocumentosavaluoscgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$viewdocumentosavaluosc_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$viewdocumentosavaluosc_grid->RenderListOptions();

// Render list options (header, left)
$viewdocumentosavaluosc_grid->ListOptions->Render("header", "left");
?>
<?php if ($viewdocumentosavaluosc->descripcion->Visible) { // descripcion ?>
	<?php if ($viewdocumentosavaluosc->SortUrl($viewdocumentosavaluosc->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $viewdocumentosavaluosc->descripcion->HeaderCellClass() ?>"><div id="elh_viewdocumentosavaluosc_descripcion" class="viewdocumentosavaluosc_descripcion"><div class="ewTableHeaderCaption"><?php echo $viewdocumentosavaluosc->descripcion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $viewdocumentosavaluosc->descripcion->HeaderCellClass() ?>"><div><div id="elh_viewdocumentosavaluosc_descripcion" class="viewdocumentosavaluosc_descripcion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentosavaluosc->descripcion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentosavaluosc->descripcion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentosavaluosc->descripcion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewdocumentosavaluosc->imagen->Visible) { // imagen ?>
	<?php if ($viewdocumentosavaluosc->SortUrl($viewdocumentosavaluosc->imagen) == "") { ?>
		<th data-name="imagen" class="<?php echo $viewdocumentosavaluosc->imagen->HeaderCellClass() ?>"><div id="elh_viewdocumentosavaluosc_imagen" class="viewdocumentosavaluosc_imagen"><div class="ewTableHeaderCaption"><?php echo $viewdocumentosavaluosc->imagen->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="imagen" class="<?php echo $viewdocumentosavaluosc->imagen->HeaderCellClass() ?>"><div><div id="elh_viewdocumentosavaluosc_imagen" class="viewdocumentosavaluosc_imagen">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentosavaluosc->imagen->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentosavaluosc->imagen->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentosavaluosc->imagen->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewdocumentosavaluosc->avaluo->Visible) { // avaluo ?>
	<?php if ($viewdocumentosavaluosc->SortUrl($viewdocumentosavaluosc->avaluo) == "") { ?>
		<th data-name="avaluo" class="<?php echo $viewdocumentosavaluosc->avaluo->HeaderCellClass() ?>"><div id="elh_viewdocumentosavaluosc_avaluo" class="viewdocumentosavaluosc_avaluo"><div class="ewTableHeaderCaption"><?php echo $viewdocumentosavaluosc->avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="avaluo" class="<?php echo $viewdocumentosavaluosc->avaluo->HeaderCellClass() ?>"><div><div id="elh_viewdocumentosavaluosc_avaluo" class="viewdocumentosavaluosc_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentosavaluosc->avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentosavaluosc->avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentosavaluosc->avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewdocumentosavaluosc->id_tipodocumento->Visible) { // id_tipodocumento ?>
	<?php if ($viewdocumentosavaluosc->SortUrl($viewdocumentosavaluosc->id_tipodocumento) == "") { ?>
		<th data-name="id_tipodocumento" class="<?php echo $viewdocumentosavaluosc->id_tipodocumento->HeaderCellClass() ?>"><div id="elh_viewdocumentosavaluosc_id_tipodocumento" class="viewdocumentosavaluosc_id_tipodocumento"><div class="ewTableHeaderCaption"><?php echo $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_tipodocumento" class="<?php echo $viewdocumentosavaluosc->id_tipodocumento->HeaderCellClass() ?>"><div><div id="elh_viewdocumentosavaluosc_id_tipodocumento" class="viewdocumentosavaluosc_id_tipodocumento">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentosavaluosc->id_tipodocumento->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentosavaluosc->id_tipodocumento->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$viewdocumentosavaluosc_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$viewdocumentosavaluosc_grid->StartRec = 1;
$viewdocumentosavaluosc_grid->StopRec = $viewdocumentosavaluosc_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($viewdocumentosavaluosc_grid->FormKeyCountName) && ($viewdocumentosavaluosc->CurrentAction == "gridadd" || $viewdocumentosavaluosc->CurrentAction == "gridedit" || $viewdocumentosavaluosc->CurrentAction == "F")) {
		$viewdocumentosavaluosc_grid->KeyCount = $objForm->GetValue($viewdocumentosavaluosc_grid->FormKeyCountName);
		$viewdocumentosavaluosc_grid->StopRec = $viewdocumentosavaluosc_grid->StartRec + $viewdocumentosavaluosc_grid->KeyCount - 1;
	}
}
$viewdocumentosavaluosc_grid->RecCnt = $viewdocumentosavaluosc_grid->StartRec - 1;
if ($viewdocumentosavaluosc_grid->Recordset && !$viewdocumentosavaluosc_grid->Recordset->EOF) {
	$viewdocumentosavaluosc_grid->Recordset->MoveFirst();
	$bSelectLimit = $viewdocumentosavaluosc_grid->UseSelectLimit;
	if (!$bSelectLimit && $viewdocumentosavaluosc_grid->StartRec > 1)
		$viewdocumentosavaluosc_grid->Recordset->Move($viewdocumentosavaluosc_grid->StartRec - 1);
} elseif (!$viewdocumentosavaluosc->AllowAddDeleteRow && $viewdocumentosavaluosc_grid->StopRec == 0) {
	$viewdocumentosavaluosc_grid->StopRec = $viewdocumentosavaluosc->GridAddRowCount;
}

// Initialize aggregate
$viewdocumentosavaluosc->RowType = EW_ROWTYPE_AGGREGATEINIT;
$viewdocumentosavaluosc->ResetAttrs();
$viewdocumentosavaluosc_grid->RenderRow();
if ($viewdocumentosavaluosc->CurrentAction == "gridadd")
	$viewdocumentosavaluosc_grid->RowIndex = 0;
if ($viewdocumentosavaluosc->CurrentAction == "gridedit")
	$viewdocumentosavaluosc_grid->RowIndex = 0;
while ($viewdocumentosavaluosc_grid->RecCnt < $viewdocumentosavaluosc_grid->StopRec) {
	$viewdocumentosavaluosc_grid->RecCnt++;
	if (intval($viewdocumentosavaluosc_grid->RecCnt) >= intval($viewdocumentosavaluosc_grid->StartRec)) {
		$viewdocumentosavaluosc_grid->RowCnt++;
		if ($viewdocumentosavaluosc->CurrentAction == "gridadd" || $viewdocumentosavaluosc->CurrentAction == "gridedit" || $viewdocumentosavaluosc->CurrentAction == "F") {
			$viewdocumentosavaluosc_grid->RowIndex++;
			$objForm->Index = $viewdocumentosavaluosc_grid->RowIndex;
			if ($objForm->HasValue($viewdocumentosavaluosc_grid->FormActionName))
				$viewdocumentosavaluosc_grid->RowAction = strval($objForm->GetValue($viewdocumentosavaluosc_grid->FormActionName));
			elseif ($viewdocumentosavaluosc->CurrentAction == "gridadd")
				$viewdocumentosavaluosc_grid->RowAction = "insert";
			else
				$viewdocumentosavaluosc_grid->RowAction = "";
		}

		// Set up key count
		$viewdocumentosavaluosc_grid->KeyCount = $viewdocumentosavaluosc_grid->RowIndex;

		// Init row class and style
		$viewdocumentosavaluosc->ResetAttrs();
		$viewdocumentosavaluosc->CssClass = "";
		if ($viewdocumentosavaluosc->CurrentAction == "gridadd") {
			if ($viewdocumentosavaluosc->CurrentMode == "copy") {
				$viewdocumentosavaluosc_grid->LoadRowValues($viewdocumentosavaluosc_grid->Recordset); // Load row values
				$viewdocumentosavaluosc_grid->SetRecordKey($viewdocumentosavaluosc_grid->RowOldKey, $viewdocumentosavaluosc_grid->Recordset); // Set old record key
			} else {
				$viewdocumentosavaluosc_grid->LoadRowValues(); // Load default values
				$viewdocumentosavaluosc_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$viewdocumentosavaluosc_grid->LoadRowValues($viewdocumentosavaluosc_grid->Recordset); // Load row values
		}
		$viewdocumentosavaluosc->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($viewdocumentosavaluosc->CurrentAction == "gridadd") // Grid add
			$viewdocumentosavaluosc->RowType = EW_ROWTYPE_ADD; // Render add
		if ($viewdocumentosavaluosc->CurrentAction == "gridadd" && $viewdocumentosavaluosc->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$viewdocumentosavaluosc_grid->RestoreCurrentRowFormValues($viewdocumentosavaluosc_grid->RowIndex); // Restore form values
		if ($viewdocumentosavaluosc->CurrentAction == "gridedit") { // Grid edit
			if ($viewdocumentosavaluosc->EventCancelled) {
				$viewdocumentosavaluosc_grid->RestoreCurrentRowFormValues($viewdocumentosavaluosc_grid->RowIndex); // Restore form values
			}
			if ($viewdocumentosavaluosc_grid->RowAction == "insert")
				$viewdocumentosavaluosc->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$viewdocumentosavaluosc->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($viewdocumentosavaluosc->CurrentAction == "gridedit" && ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_EDIT || $viewdocumentosavaluosc->RowType == EW_ROWTYPE_ADD) && $viewdocumentosavaluosc->EventCancelled) // Update failed
			$viewdocumentosavaluosc_grid->RestoreCurrentRowFormValues($viewdocumentosavaluosc_grid->RowIndex); // Restore form values
		if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_EDIT) // Edit row
			$viewdocumentosavaluosc_grid->EditRowCnt++;
		if ($viewdocumentosavaluosc->CurrentAction == "F") // Confirm row
			$viewdocumentosavaluosc_grid->RestoreCurrentRowFormValues($viewdocumentosavaluosc_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$viewdocumentosavaluosc->RowAttrs = array_merge($viewdocumentosavaluosc->RowAttrs, array('data-rowindex'=>$viewdocumentosavaluosc_grid->RowCnt, 'id'=>'r' . $viewdocumentosavaluosc_grid->RowCnt . '_viewdocumentosavaluosc', 'data-rowtype'=>$viewdocumentosavaluosc->RowType));

		// Render row
		$viewdocumentosavaluosc_grid->RenderRow();

		// Render list options
		$viewdocumentosavaluosc_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($viewdocumentosavaluosc_grid->RowAction <> "delete" && $viewdocumentosavaluosc_grid->RowAction <> "insertdelete" && !($viewdocumentosavaluosc_grid->RowAction == "insert" && $viewdocumentosavaluosc->CurrentAction == "F" && $viewdocumentosavaluosc_grid->EmptyRow())) {
?>
	<tr<?php echo $viewdocumentosavaluosc->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewdocumentosavaluosc_grid->ListOptions->Render("body", "left", $viewdocumentosavaluosc_grid->RowCnt);
?>
	<?php if ($viewdocumentosavaluosc->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion"<?php echo $viewdocumentosavaluosc->descripcion->CellAttributes() ?>>
<?php if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_descripcion" class="form-group viewdocumentosavaluosc_descripcion">
<textarea data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentosavaluosc->descripcion->EditAttributes() ?>><?php echo $viewdocumentosavaluosc->descripcion->EditValue ?></textarea>
</span>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" id="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_descripcion" class="form-group viewdocumentosavaluosc_descripcion">
<textarea data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentosavaluosc->descripcion->EditAttributes() ?>><?php echo $viewdocumentosavaluosc->descripcion->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_descripcion" class="viewdocumentosavaluosc_descripcion">
<span<?php echo $viewdocumentosavaluosc->descripcion->ViewAttributes() ?>>
<?php echo $viewdocumentosavaluosc->descripcion->ListViewValue() ?></span>
</span>
<?php if ($viewdocumentosavaluosc->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->FormValue) ?>">
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" id="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="fviewdocumentosavaluoscgrid$x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" id="fviewdocumentosavaluoscgrid$x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->FormValue) ?>">
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="fviewdocumentosavaluoscgrid$o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" id="fviewdocumentosavaluoscgrid$o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->id->CurrentValue) ?>">
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id" name="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id" id="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->id->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_EDIT || $viewdocumentosavaluosc->CurrentMode == "edit") { ?>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($viewdocumentosavaluosc->imagen->Visible) { // imagen ?>
		<td data-name="imagen"<?php echo $viewdocumentosavaluosc->imagen->CellAttributes() ?>>
<?php if ($viewdocumentosavaluosc_grid->RowAction == "insert") { // Add record ?>
<span id="el$rowindex$_viewdocumentosavaluosc_imagen" class="form-group viewdocumentosavaluosc_imagen">
<div id="fd_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen">
<span title="<?php echo $viewdocumentosavaluosc->imagen->FldTitle() ? $viewdocumentosavaluosc->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentosavaluosc->imagen->ReadOnly || $viewdocumentosavaluosc->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentosavaluosc" data-field="x_imagen" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen"<?php echo $viewdocumentosavaluosc->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fs_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_imagen" name="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->imagen->OldValue) ?>">
<?php } elseif ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_imagen" class="viewdocumentosavaluosc_imagen">
<span<?php echo $viewdocumentosavaluosc->imagen->ViewAttributes() ?>>
<?php echo ew_GetFileViewTag($viewdocumentosavaluosc->imagen, $viewdocumentosavaluosc->imagen->ListViewValue()) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_imagen" class="form-group viewdocumentosavaluosc_imagen">
<div id="fd_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen">
<span title="<?php echo $viewdocumentosavaluosc->imagen->FldTitle() ? $viewdocumentosavaluosc->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentosavaluosc->imagen->ReadOnly || $viewdocumentosavaluosc->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentosavaluosc" data-field="x_imagen" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen"<?php echo $viewdocumentosavaluosc->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->Upload->FileName ?>">
<?php if (@$_POST["fa_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen"] == "0") { ?>
<input type="hidden" name="fa_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewdocumentosavaluosc->avaluo->Visible) { // avaluo ?>
		<td data-name="avaluo"<?php echo $viewdocumentosavaluosc->avaluo->CellAttributes() ?>>
<?php if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($viewdocumentosavaluosc->avaluo->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_avaluo" class="form-group viewdocumentosavaluosc_avaluo">
<span<?php echo $viewdocumentosavaluosc->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosavaluosc->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_avaluo" class="form-group viewdocumentosavaluosc_avaluo">
<select data-table="viewdocumentosavaluosc" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentosavaluosc->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo"<?php echo $viewdocumentosavaluosc->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentosavaluosc->avaluo->SelectOptionListHtml("x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_avaluo" name="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" id="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->avaluo->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($viewdocumentosavaluosc->avaluo->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_avaluo" class="form-group viewdocumentosavaluosc_avaluo">
<span<?php echo $viewdocumentosavaluosc->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosavaluosc->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_avaluo" class="form-group viewdocumentosavaluosc_avaluo">
<select data-table="viewdocumentosavaluosc" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentosavaluosc->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo"<?php echo $viewdocumentosavaluosc->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentosavaluosc->avaluo->SelectOptionListHtml("x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_avaluo" class="viewdocumentosavaluosc_avaluo">
<span<?php echo $viewdocumentosavaluosc->avaluo->ViewAttributes() ?>>
<?php echo $viewdocumentosavaluosc->avaluo->ListViewValue() ?></span>
</span>
<?php if ($viewdocumentosavaluosc->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_avaluo" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->avaluo->FormValue) ?>">
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_avaluo" name="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" id="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->avaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_avaluo" name="fviewdocumentosavaluoscgrid$x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" id="fviewdocumentosavaluoscgrid$x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->avaluo->FormValue) ?>">
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_avaluo" name="fviewdocumentosavaluoscgrid$o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" id="fviewdocumentosavaluoscgrid$o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->avaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewdocumentosavaluosc->id_tipodocumento->Visible) { // id_tipodocumento ?>
		<td data-name="id_tipodocumento"<?php echo $viewdocumentosavaluosc->id_tipodocumento->CellAttributes() ?>>
<?php if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_id_tipodocumento" class="form-group viewdocumentosavaluosc_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($viewdocumentosavaluosc->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentosavaluosc->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentosavaluosc->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentosavaluosc->id_tipodocumento->ReadOnly || $viewdocumentosavaluosc->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentosavaluosc->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $viewdocumentosavaluosc->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentosavaluosc->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentosavaluosc->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" name="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->id_tipodocumento->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_id_tipodocumento" class="form-group viewdocumentosavaluosc_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($viewdocumentosavaluosc->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentosavaluosc->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentosavaluosc->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentosavaluosc->id_tipodocumento->ReadOnly || $viewdocumentosavaluosc->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentosavaluosc->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $viewdocumentosavaluosc->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentosavaluosc->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentosavaluosc->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } ?>
<?php if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentosavaluosc_grid->RowCnt ?>_viewdocumentosavaluosc_id_tipodocumento" class="viewdocumentosavaluosc_id_tipodocumento">
<span<?php echo $viewdocumentosavaluosc->id_tipodocumento->ViewAttributes() ?>>
<?php echo $viewdocumentosavaluosc->id_tipodocumento->ListViewValue() ?></span>
</span>
<?php if ($viewdocumentosavaluosc->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->id_tipodocumento->FormValue) ?>">
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" name="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->id_tipodocumento->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" name="fviewdocumentosavaluoscgrid$x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" id="fviewdocumentosavaluoscgrid$x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->id_tipodocumento->FormValue) ?>">
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" name="fviewdocumentosavaluoscgrid$o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" id="fviewdocumentosavaluoscgrid$o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->id_tipodocumento->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewdocumentosavaluosc_grid->ListOptions->Render("body", "right", $viewdocumentosavaluosc_grid->RowCnt);
?>
	</tr>
<?php if ($viewdocumentosavaluosc->RowType == EW_ROWTYPE_ADD || $viewdocumentosavaluosc->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fviewdocumentosavaluoscgrid.UpdateOpts(<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($viewdocumentosavaluosc->CurrentAction <> "gridadd" || $viewdocumentosavaluosc->CurrentMode == "copy")
		if (!$viewdocumentosavaluosc_grid->Recordset->EOF) $viewdocumentosavaluosc_grid->Recordset->MoveNext();
}
?>
<?php
	if ($viewdocumentosavaluosc->CurrentMode == "add" || $viewdocumentosavaluosc->CurrentMode == "copy" || $viewdocumentosavaluosc->CurrentMode == "edit") {
		$viewdocumentosavaluosc_grid->RowIndex = '$rowindex$';
		$viewdocumentosavaluosc_grid->LoadRowValues();

		// Set row properties
		$viewdocumentosavaluosc->ResetAttrs();
		$viewdocumentosavaluosc->RowAttrs = array_merge($viewdocumentosavaluosc->RowAttrs, array('data-rowindex'=>$viewdocumentosavaluosc_grid->RowIndex, 'id'=>'r0_viewdocumentosavaluosc', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($viewdocumentosavaluosc->RowAttrs["class"], "ewTemplate");
		$viewdocumentosavaluosc->RowType = EW_ROWTYPE_ADD;

		// Render row
		$viewdocumentosavaluosc_grid->RenderRow();

		// Render list options
		$viewdocumentosavaluosc_grid->RenderListOptions();
		$viewdocumentosavaluosc_grid->StartRowCnt = 0;
?>
	<tr<?php echo $viewdocumentosavaluosc->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewdocumentosavaluosc_grid->ListOptions->Render("body", "left", $viewdocumentosavaluosc_grid->RowIndex);
?>
	<?php if ($viewdocumentosavaluosc->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion">
<?php if ($viewdocumentosavaluosc->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewdocumentosavaluosc_descripcion" class="form-group viewdocumentosavaluosc_descripcion">
<textarea data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentosavaluosc->descripcion->EditAttributes() ?>><?php echo $viewdocumentosavaluosc->descripcion->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewdocumentosavaluosc_descripcion" class="form-group viewdocumentosavaluosc_descripcion">
<span<?php echo $viewdocumentosavaluosc->descripcion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosavaluosc->descripcion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_descripcion" name="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" id="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->descripcion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewdocumentosavaluosc->imagen->Visible) { // imagen ?>
		<td data-name="imagen">
<span id="el$rowindex$_viewdocumentosavaluosc_imagen" class="form-group viewdocumentosavaluosc_imagen">
<div id="fd_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen">
<span title="<?php echo $viewdocumentosavaluosc->imagen->FldTitle() ? $viewdocumentosavaluosc->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentosavaluosc->imagen->ReadOnly || $viewdocumentosavaluosc->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentosavaluosc" data-field="x_imagen" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen"<?php echo $viewdocumentosavaluosc->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fs_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosavaluosc->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_imagen" name="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" id="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->imagen->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewdocumentosavaluosc->avaluo->Visible) { // avaluo ?>
		<td data-name="avaluo">
<?php if ($viewdocumentosavaluosc->CurrentAction <> "F") { ?>
<?php if ($viewdocumentosavaluosc->avaluo->getSessionValue() <> "") { ?>
<span id="el$rowindex$_viewdocumentosavaluosc_avaluo" class="form-group viewdocumentosavaluosc_avaluo">
<span<?php echo $viewdocumentosavaluosc->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosavaluosc->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_viewdocumentosavaluosc_avaluo" class="form-group viewdocumentosavaluosc_avaluo">
<select data-table="viewdocumentosavaluosc" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentosavaluosc->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo"<?php echo $viewdocumentosavaluosc->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentosavaluosc->avaluo->SelectOptionListHtml("x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_viewdocumentosavaluosc_avaluo" class="form-group viewdocumentosavaluosc_avaluo">
<span<?php echo $viewdocumentosavaluosc->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosavaluosc->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_avaluo" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->avaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_avaluo" name="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" id="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->avaluo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewdocumentosavaluosc->id_tipodocumento->Visible) { // id_tipodocumento ?>
		<td data-name="id_tipodocumento">
<?php if ($viewdocumentosavaluosc->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewdocumentosavaluosc_id_tipodocumento" class="form-group viewdocumentosavaluosc_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($viewdocumentosavaluosc->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentosavaluosc->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentosavaluosc->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentosavaluosc->id_tipodocumento->ReadOnly || $viewdocumentosavaluosc->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentosavaluosc->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $viewdocumentosavaluosc->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentosavaluosc->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentosavaluosc->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentosavaluosc->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewdocumentosavaluosc_id_tipodocumento" class="form-group viewdocumentosavaluosc_id_tipodocumento">
<span<?php echo $viewdocumentosavaluosc->id_tipodocumento->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosavaluosc->id_tipodocumento->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" name="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->id_tipodocumento->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewdocumentosavaluosc" data-field="x_id_tipodocumento" name="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosavaluosc->id_tipodocumento->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewdocumentosavaluosc_grid->ListOptions->Render("body", "right", $viewdocumentosavaluosc_grid->RowCnt);
?>
<script type="text/javascript">
fviewdocumentosavaluoscgrid.UpdateOpts(<?php echo $viewdocumentosavaluosc_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($viewdocumentosavaluosc->CurrentMode == "add" || $viewdocumentosavaluosc->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $viewdocumentosavaluosc_grid->FormKeyCountName ?>" id="<?php echo $viewdocumentosavaluosc_grid->FormKeyCountName ?>" value="<?php echo $viewdocumentosavaluosc_grid->KeyCount ?>">
<?php echo $viewdocumentosavaluosc_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewdocumentosavaluosc->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $viewdocumentosavaluosc_grid->FormKeyCountName ?>" id="<?php echo $viewdocumentosavaluosc_grid->FormKeyCountName ?>" value="<?php echo $viewdocumentosavaluosc_grid->KeyCount ?>">
<?php echo $viewdocumentosavaluosc_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewdocumentosavaluosc->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fviewdocumentosavaluoscgrid">
</div>
<?php

// Close recordset
if ($viewdocumentosavaluosc_grid->Recordset)
	$viewdocumentosavaluosc_grid->Recordset->Close();
?>
<?php if ($viewdocumentosavaluosc_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($viewdocumentosavaluosc_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($viewdocumentosavaluosc_grid->TotalRecs == 0 && $viewdocumentosavaluosc->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewdocumentosavaluosc_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($viewdocumentosavaluosc->Export == "") { ?>
<script type="text/javascript">
fviewdocumentosavaluoscgrid.Init();
</script>
<?php } ?>
<?php
$viewdocumentosavaluosc_grid->Page_Terminate();
?>
