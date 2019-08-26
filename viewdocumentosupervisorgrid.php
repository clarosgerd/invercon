<?php include_once "usuarioinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($viewdocumentosupervisor_grid)) $viewdocumentosupervisor_grid = new cviewdocumentosupervisor_grid();

// Page init
$viewdocumentosupervisor_grid->Page_Init();

// Page main
$viewdocumentosupervisor_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewdocumentosupervisor_grid->Page_Render();
?>
<?php if ($viewdocumentosupervisor->Export == "") { ?>
<script type="text/javascript">

// Form object
var fviewdocumentosupervisorgrid = new ew_Form("fviewdocumentosupervisorgrid", "grid");
fviewdocumentosupervisorgrid.FormKeyCountName = '<?php echo $viewdocumentosupervisor_grid->FormKeyCountName ?>';

// Validate form
fviewdocumentosupervisorgrid.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewdocumentosupervisor->descripcion->FldCaption(), $viewdocumentosupervisor->descripcion->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fviewdocumentosupervisorgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "descripcion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "imagen", false)) return false;
	if (ew_ValueChanged(fobj, infix, "avaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_tipodocumento", false)) return false;
	return true;
}

// Form_CustomValidate event
fviewdocumentosupervisorgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewdocumentosupervisorgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewdocumentosupervisorgrid.Lists["x_avaluo"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tipoinmueble","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"avaluo"};
fviewdocumentosupervisorgrid.Lists["x_avaluo"].Data = "<?php echo $viewdocumentosupervisor_grid->avaluo->LookupFilterQuery(FALSE, "grid") ?>";
fviewdocumentosupervisorgrid.Lists["x_id_tipodocumento"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipodocumento"};
fviewdocumentosupervisorgrid.Lists["x_id_tipodocumento"].Data = "<?php echo $viewdocumentosupervisor_grid->id_tipodocumento->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($viewdocumentosupervisor->CurrentAction == "gridadd") {
	if ($viewdocumentosupervisor->CurrentMode == "copy") {
		$bSelectLimit = $viewdocumentosupervisor_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$viewdocumentosupervisor_grid->TotalRecs = $viewdocumentosupervisor->ListRecordCount();
			$viewdocumentosupervisor_grid->Recordset = $viewdocumentosupervisor_grid->LoadRecordset($viewdocumentosupervisor_grid->StartRec-1, $viewdocumentosupervisor_grid->DisplayRecs);
		} else {
			if ($viewdocumentosupervisor_grid->Recordset = $viewdocumentosupervisor_grid->LoadRecordset())
				$viewdocumentosupervisor_grid->TotalRecs = $viewdocumentosupervisor_grid->Recordset->RecordCount();
		}
		$viewdocumentosupervisor_grid->StartRec = 1;
		$viewdocumentosupervisor_grid->DisplayRecs = $viewdocumentosupervisor_grid->TotalRecs;
	} else {
		$viewdocumentosupervisor->CurrentFilter = "0=1";
		$viewdocumentosupervisor_grid->StartRec = 1;
		$viewdocumentosupervisor_grid->DisplayRecs = $viewdocumentosupervisor->GridAddRowCount;
	}
	$viewdocumentosupervisor_grid->TotalRecs = $viewdocumentosupervisor_grid->DisplayRecs;
	$viewdocumentosupervisor_grid->StopRec = $viewdocumentosupervisor_grid->DisplayRecs;
} else {
	$bSelectLimit = $viewdocumentosupervisor_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($viewdocumentosupervisor_grid->TotalRecs <= 0)
			$viewdocumentosupervisor_grid->TotalRecs = $viewdocumentosupervisor->ListRecordCount();
	} else {
		if (!$viewdocumentosupervisor_grid->Recordset && ($viewdocumentosupervisor_grid->Recordset = $viewdocumentosupervisor_grid->LoadRecordset()))
			$viewdocumentosupervisor_grid->TotalRecs = $viewdocumentosupervisor_grid->Recordset->RecordCount();
	}
	$viewdocumentosupervisor_grid->StartRec = 1;
	$viewdocumentosupervisor_grid->DisplayRecs = $viewdocumentosupervisor_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$viewdocumentosupervisor_grid->Recordset = $viewdocumentosupervisor_grid->LoadRecordset($viewdocumentosupervisor_grid->StartRec-1, $viewdocumentosupervisor_grid->DisplayRecs);

	// Set no record found message
	if ($viewdocumentosupervisor->CurrentAction == "" && $viewdocumentosupervisor_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$viewdocumentosupervisor_grid->setWarningMessage(ew_DeniedMsg());
		if ($viewdocumentosupervisor_grid->SearchWhere == "0=101")
			$viewdocumentosupervisor_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$viewdocumentosupervisor_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$viewdocumentosupervisor_grid->RenderOtherOptions();
?>
<?php $viewdocumentosupervisor_grid->ShowPageHeader(); ?>
<?php
$viewdocumentosupervisor_grid->ShowMessage();
?>
<?php if ($viewdocumentosupervisor_grid->TotalRecs > 0 || $viewdocumentosupervisor->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($viewdocumentosupervisor_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewdocumentosupervisor">
<div id="fviewdocumentosupervisorgrid" class="ewForm ewListForm form-inline">
<div id="gmp_viewdocumentosupervisor" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_viewdocumentosupervisorgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$viewdocumentosupervisor_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$viewdocumentosupervisor_grid->RenderListOptions();

// Render list options (header, left)
$viewdocumentosupervisor_grid->ListOptions->Render("header", "left");
?>
<?php if ($viewdocumentosupervisor->descripcion->Visible) { // descripcion ?>
	<?php if ($viewdocumentosupervisor->SortUrl($viewdocumentosupervisor->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $viewdocumentosupervisor->descripcion->HeaderCellClass() ?>"><div id="elh_viewdocumentosupervisor_descripcion" class="viewdocumentosupervisor_descripcion"><div class="ewTableHeaderCaption"><?php echo $viewdocumentosupervisor->descripcion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $viewdocumentosupervisor->descripcion->HeaderCellClass() ?>"><div><div id="elh_viewdocumentosupervisor_descripcion" class="viewdocumentosupervisor_descripcion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentosupervisor->descripcion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentosupervisor->descripcion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentosupervisor->descripcion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewdocumentosupervisor->imagen->Visible) { // imagen ?>
	<?php if ($viewdocumentosupervisor->SortUrl($viewdocumentosupervisor->imagen) == "") { ?>
		<th data-name="imagen" class="<?php echo $viewdocumentosupervisor->imagen->HeaderCellClass() ?>"><div id="elh_viewdocumentosupervisor_imagen" class="viewdocumentosupervisor_imagen"><div class="ewTableHeaderCaption"><?php echo $viewdocumentosupervisor->imagen->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="imagen" class="<?php echo $viewdocumentosupervisor->imagen->HeaderCellClass() ?>"><div><div id="elh_viewdocumentosupervisor_imagen" class="viewdocumentosupervisor_imagen">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentosupervisor->imagen->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentosupervisor->imagen->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentosupervisor->imagen->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewdocumentosupervisor->avaluo->Visible) { // avaluo ?>
	<?php if ($viewdocumentosupervisor->SortUrl($viewdocumentosupervisor->avaluo) == "") { ?>
		<th data-name="avaluo" class="<?php echo $viewdocumentosupervisor->avaluo->HeaderCellClass() ?>"><div id="elh_viewdocumentosupervisor_avaluo" class="viewdocumentosupervisor_avaluo"><div class="ewTableHeaderCaption"><?php echo $viewdocumentosupervisor->avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="avaluo" class="<?php echo $viewdocumentosupervisor->avaluo->HeaderCellClass() ?>"><div><div id="elh_viewdocumentosupervisor_avaluo" class="viewdocumentosupervisor_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentosupervisor->avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentosupervisor->avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentosupervisor->avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewdocumentosupervisor->id_tipodocumento->Visible) { // id_tipodocumento ?>
	<?php if ($viewdocumentosupervisor->SortUrl($viewdocumentosupervisor->id_tipodocumento) == "") { ?>
		<th data-name="id_tipodocumento" class="<?php echo $viewdocumentosupervisor->id_tipodocumento->HeaderCellClass() ?>"><div id="elh_viewdocumentosupervisor_id_tipodocumento" class="viewdocumentosupervisor_id_tipodocumento"><div class="ewTableHeaderCaption"><?php echo $viewdocumentosupervisor->id_tipodocumento->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_tipodocumento" class="<?php echo $viewdocumentosupervisor->id_tipodocumento->HeaderCellClass() ?>"><div><div id="elh_viewdocumentosupervisor_id_tipodocumento" class="viewdocumentosupervisor_id_tipodocumento">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentosupervisor->id_tipodocumento->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentosupervisor->id_tipodocumento->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentosupervisor->id_tipodocumento->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$viewdocumentosupervisor_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$viewdocumentosupervisor_grid->StartRec = 1;
$viewdocumentosupervisor_grid->StopRec = $viewdocumentosupervisor_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($viewdocumentosupervisor_grid->FormKeyCountName) && ($viewdocumentosupervisor->CurrentAction == "gridadd" || $viewdocumentosupervisor->CurrentAction == "gridedit" || $viewdocumentosupervisor->CurrentAction == "F")) {
		$viewdocumentosupervisor_grid->KeyCount = $objForm->GetValue($viewdocumentosupervisor_grid->FormKeyCountName);
		$viewdocumentosupervisor_grid->StopRec = $viewdocumentosupervisor_grid->StartRec + $viewdocumentosupervisor_grid->KeyCount - 1;
	}
}
$viewdocumentosupervisor_grid->RecCnt = $viewdocumentosupervisor_grid->StartRec - 1;
if ($viewdocumentosupervisor_grid->Recordset && !$viewdocumentosupervisor_grid->Recordset->EOF) {
	$viewdocumentosupervisor_grid->Recordset->MoveFirst();
	$bSelectLimit = $viewdocumentosupervisor_grid->UseSelectLimit;
	if (!$bSelectLimit && $viewdocumentosupervisor_grid->StartRec > 1)
		$viewdocumentosupervisor_grid->Recordset->Move($viewdocumentosupervisor_grid->StartRec - 1);
} elseif (!$viewdocumentosupervisor->AllowAddDeleteRow && $viewdocumentosupervisor_grid->StopRec == 0) {
	$viewdocumentosupervisor_grid->StopRec = $viewdocumentosupervisor->GridAddRowCount;
}

// Initialize aggregate
$viewdocumentosupervisor->RowType = EW_ROWTYPE_AGGREGATEINIT;
$viewdocumentosupervisor->ResetAttrs();
$viewdocumentosupervisor_grid->RenderRow();
if ($viewdocumentosupervisor->CurrentAction == "gridadd")
	$viewdocumentosupervisor_grid->RowIndex = 0;
if ($viewdocumentosupervisor->CurrentAction == "gridedit")
	$viewdocumentosupervisor_grid->RowIndex = 0;
while ($viewdocumentosupervisor_grid->RecCnt < $viewdocumentosupervisor_grid->StopRec) {
	$viewdocumentosupervisor_grid->RecCnt++;
	if (intval($viewdocumentosupervisor_grid->RecCnt) >= intval($viewdocumentosupervisor_grid->StartRec)) {
		$viewdocumentosupervisor_grid->RowCnt++;
		if ($viewdocumentosupervisor->CurrentAction == "gridadd" || $viewdocumentosupervisor->CurrentAction == "gridedit" || $viewdocumentosupervisor->CurrentAction == "F") {
			$viewdocumentosupervisor_grid->RowIndex++;
			$objForm->Index = $viewdocumentosupervisor_grid->RowIndex;
			if ($objForm->HasValue($viewdocumentosupervisor_grid->FormActionName))
				$viewdocumentosupervisor_grid->RowAction = strval($objForm->GetValue($viewdocumentosupervisor_grid->FormActionName));
			elseif ($viewdocumentosupervisor->CurrentAction == "gridadd")
				$viewdocumentosupervisor_grid->RowAction = "insert";
			else
				$viewdocumentosupervisor_grid->RowAction = "";
		}

		// Set up key count
		$viewdocumentosupervisor_grid->KeyCount = $viewdocumentosupervisor_grid->RowIndex;

		// Init row class and style
		$viewdocumentosupervisor->ResetAttrs();
		$viewdocumentosupervisor->CssClass = "";
		if ($viewdocumentosupervisor->CurrentAction == "gridadd") {
			if ($viewdocumentosupervisor->CurrentMode == "copy") {
				$viewdocumentosupervisor_grid->LoadRowValues($viewdocumentosupervisor_grid->Recordset); // Load row values
				$viewdocumentosupervisor_grid->SetRecordKey($viewdocumentosupervisor_grid->RowOldKey, $viewdocumentosupervisor_grid->Recordset); // Set old record key
			} else {
				$viewdocumentosupervisor_grid->LoadRowValues(); // Load default values
				$viewdocumentosupervisor_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$viewdocumentosupervisor_grid->LoadRowValues($viewdocumentosupervisor_grid->Recordset); // Load row values
		}
		$viewdocumentosupervisor->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($viewdocumentosupervisor->CurrentAction == "gridadd") // Grid add
			$viewdocumentosupervisor->RowType = EW_ROWTYPE_ADD; // Render add
		if ($viewdocumentosupervisor->CurrentAction == "gridadd" && $viewdocumentosupervisor->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$viewdocumentosupervisor_grid->RestoreCurrentRowFormValues($viewdocumentosupervisor_grid->RowIndex); // Restore form values
		if ($viewdocumentosupervisor->CurrentAction == "gridedit") { // Grid edit
			if ($viewdocumentosupervisor->EventCancelled) {
				$viewdocumentosupervisor_grid->RestoreCurrentRowFormValues($viewdocumentosupervisor_grid->RowIndex); // Restore form values
			}
			if ($viewdocumentosupervisor_grid->RowAction == "insert")
				$viewdocumentosupervisor->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$viewdocumentosupervisor->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($viewdocumentosupervisor->CurrentAction == "gridedit" && ($viewdocumentosupervisor->RowType == EW_ROWTYPE_EDIT || $viewdocumentosupervisor->RowType == EW_ROWTYPE_ADD) && $viewdocumentosupervisor->EventCancelled) // Update failed
			$viewdocumentosupervisor_grid->RestoreCurrentRowFormValues($viewdocumentosupervisor_grid->RowIndex); // Restore form values
		if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_EDIT) // Edit row
			$viewdocumentosupervisor_grid->EditRowCnt++;
		if ($viewdocumentosupervisor->CurrentAction == "F") // Confirm row
			$viewdocumentosupervisor_grid->RestoreCurrentRowFormValues($viewdocumentosupervisor_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$viewdocumentosupervisor->RowAttrs = array_merge($viewdocumentosupervisor->RowAttrs, array('data-rowindex'=>$viewdocumentosupervisor_grid->RowCnt, 'id'=>'r' . $viewdocumentosupervisor_grid->RowCnt . '_viewdocumentosupervisor', 'data-rowtype'=>$viewdocumentosupervisor->RowType));

		// Render row
		$viewdocumentosupervisor_grid->RenderRow();

		// Render list options
		$viewdocumentosupervisor_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($viewdocumentosupervisor_grid->RowAction <> "delete" && $viewdocumentosupervisor_grid->RowAction <> "insertdelete" && !($viewdocumentosupervisor_grid->RowAction == "insert" && $viewdocumentosupervisor->CurrentAction == "F" && $viewdocumentosupervisor_grid->EmptyRow())) {
?>
	<tr<?php echo $viewdocumentosupervisor->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewdocumentosupervisor_grid->ListOptions->Render("body", "left", $viewdocumentosupervisor_grid->RowCnt);
?>
	<?php if ($viewdocumentosupervisor->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion"<?php echo $viewdocumentosupervisor->descripcion->CellAttributes() ?>>
<?php if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_descripcion" class="form-group viewdocumentosupervisor_descripcion">
<textarea data-table="viewdocumentosupervisor" data-field="x_descripcion" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentosupervisor->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentosupervisor->descripcion->EditAttributes() ?>><?php echo $viewdocumentosupervisor->descripcion->EditValue ?></textarea>
</span>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_descripcion" name="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" id="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->descripcion->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_descripcion" class="form-group viewdocumentosupervisor_descripcion">
<textarea data-table="viewdocumentosupervisor" data-field="x_descripcion" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentosupervisor->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentosupervisor->descripcion->EditAttributes() ?>><?php echo $viewdocumentosupervisor->descripcion->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_descripcion" class="viewdocumentosupervisor_descripcion">
<span<?php echo $viewdocumentosupervisor->descripcion->ViewAttributes() ?>>
<?php echo $viewdocumentosupervisor->descripcion->ListViewValue() ?></span>
</span>
<?php if ($viewdocumentosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_descripcion" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->descripcion->FormValue) ?>">
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_descripcion" name="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" id="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->descripcion->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_descripcion" name="fviewdocumentosupervisorgrid$x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" id="fviewdocumentosupervisorgrid$x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->descripcion->FormValue) ?>">
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_descripcion" name="fviewdocumentosupervisorgrid$o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" id="fviewdocumentosupervisorgrid$o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->descripcion->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->id->CurrentValue) ?>">
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id" name="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id" id="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->id->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_EDIT || $viewdocumentosupervisor->CurrentMode == "edit") { ?>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($viewdocumentosupervisor->imagen->Visible) { // imagen ?>
		<td data-name="imagen"<?php echo $viewdocumentosupervisor->imagen->CellAttributes() ?>>
<?php if ($viewdocumentosupervisor_grid->RowAction == "insert") { // Add record ?>
<span id="el$rowindex$_viewdocumentosupervisor_imagen" class="form-group viewdocumentosupervisor_imagen">
<div id="fd_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen">
<span title="<?php echo $viewdocumentosupervisor->imagen->FldTitle() ? $viewdocumentosupervisor->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentosupervisor->imagen->ReadOnly || $viewdocumentosupervisor->imagen->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentosupervisor" data-field="x_imagen" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen"<?php echo $viewdocumentosupervisor->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosupervisor->imagen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fs_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosupervisor->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosupervisor->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_imagen" name="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->imagen->OldValue) ?>">
<?php } elseif ($viewdocumentosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_imagen" class="viewdocumentosupervisor_imagen">
<span<?php echo $viewdocumentosupervisor->imagen->ViewAttributes() ?>>
<?php echo ew_GetFileViewTag($viewdocumentosupervisor->imagen, $viewdocumentosupervisor->imagen->ListViewValue()) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_imagen" class="form-group viewdocumentosupervisor_imagen">
<div id="fd_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen">
<span title="<?php echo $viewdocumentosupervisor->imagen->FldTitle() ? $viewdocumentosupervisor->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentosupervisor->imagen->ReadOnly || $viewdocumentosupervisor->imagen->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentosupervisor" data-field="x_imagen" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen"<?php echo $viewdocumentosupervisor->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosupervisor->imagen->Upload->FileName ?>">
<?php if (@$_POST["fa_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen"] == "0") { ?>
<input type="hidden" name="fa_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosupervisor->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosupervisor->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewdocumentosupervisor->avaluo->Visible) { // avaluo ?>
		<td data-name="avaluo"<?php echo $viewdocumentosupervisor->avaluo->CellAttributes() ?>>
<?php if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($viewdocumentosupervisor->avaluo->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_avaluo" class="form-group viewdocumentosupervisor_avaluo">
<span<?php echo $viewdocumentosupervisor->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosupervisor->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_avaluo" class="form-group viewdocumentosupervisor_avaluo">
<select data-table="viewdocumentosupervisor" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentosupervisor->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo"<?php echo $viewdocumentosupervisor->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentosupervisor->avaluo->SelectOptionListHtml("x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_avaluo" name="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" id="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->avaluo->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($viewdocumentosupervisor->avaluo->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_avaluo" class="form-group viewdocumentosupervisor_avaluo">
<span<?php echo $viewdocumentosupervisor->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosupervisor->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_avaluo" class="form-group viewdocumentosupervisor_avaluo">
<select data-table="viewdocumentosupervisor" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentosupervisor->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo"<?php echo $viewdocumentosupervisor->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentosupervisor->avaluo->SelectOptionListHtml("x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_avaluo" class="viewdocumentosupervisor_avaluo">
<span<?php echo $viewdocumentosupervisor->avaluo->ViewAttributes() ?>>
<?php echo $viewdocumentosupervisor->avaluo->ListViewValue() ?></span>
</span>
<?php if ($viewdocumentosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_avaluo" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->avaluo->FormValue) ?>">
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_avaluo" name="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" id="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->avaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_avaluo" name="fviewdocumentosupervisorgrid$x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" id="fviewdocumentosupervisorgrid$x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->avaluo->FormValue) ?>">
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_avaluo" name="fviewdocumentosupervisorgrid$o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" id="fviewdocumentosupervisorgrid$o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->avaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewdocumentosupervisor->id_tipodocumento->Visible) { // id_tipodocumento ?>
		<td data-name="id_tipodocumento"<?php echo $viewdocumentosupervisor->id_tipodocumento->CellAttributes() ?>>
<?php if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_id_tipodocumento" class="form-group viewdocumentosupervisor_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($viewdocumentosupervisor->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentosupervisor->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentosupervisor->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentosupervisor->id_tipodocumento->ReadOnly || $viewdocumentosupervisor->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentosupervisor->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $viewdocumentosupervisor->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentosupervisor->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentosupervisor->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentosupervisor->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentosupervisor->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id_tipodocumento" name="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->id_tipodocumento->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_id_tipodocumento" class="form-group viewdocumentosupervisor_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($viewdocumentosupervisor->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentosupervisor->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentosupervisor->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentosupervisor->id_tipodocumento->ReadOnly || $viewdocumentosupervisor->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentosupervisor->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $viewdocumentosupervisor->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentosupervisor->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentosupervisor->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentosupervisor->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentosupervisor->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } ?>
<?php if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentosupervisor_grid->RowCnt ?>_viewdocumentosupervisor_id_tipodocumento" class="viewdocumentosupervisor_id_tipodocumento">
<span<?php echo $viewdocumentosupervisor->id_tipodocumento->ViewAttributes() ?>>
<?php echo $viewdocumentosupervisor->id_tipodocumento->ListViewValue() ?></span>
</span>
<?php if ($viewdocumentosupervisor->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id_tipodocumento" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->id_tipodocumento->FormValue) ?>">
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id_tipodocumento" name="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->id_tipodocumento->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id_tipodocumento" name="fviewdocumentosupervisorgrid$x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" id="fviewdocumentosupervisorgrid$x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->id_tipodocumento->FormValue) ?>">
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id_tipodocumento" name="fviewdocumentosupervisorgrid$o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" id="fviewdocumentosupervisorgrid$o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->id_tipodocumento->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewdocumentosupervisor_grid->ListOptions->Render("body", "right", $viewdocumentosupervisor_grid->RowCnt);
?>
	</tr>
<?php if ($viewdocumentosupervisor->RowType == EW_ROWTYPE_ADD || $viewdocumentosupervisor->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fviewdocumentosupervisorgrid.UpdateOpts(<?php echo $viewdocumentosupervisor_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($viewdocumentosupervisor->CurrentAction <> "gridadd" || $viewdocumentosupervisor->CurrentMode == "copy")
		if (!$viewdocumentosupervisor_grid->Recordset->EOF) $viewdocumentosupervisor_grid->Recordset->MoveNext();
}
?>
<?php
	if ($viewdocumentosupervisor->CurrentMode == "add" || $viewdocumentosupervisor->CurrentMode == "copy" || $viewdocumentosupervisor->CurrentMode == "edit") {
		$viewdocumentosupervisor_grid->RowIndex = '$rowindex$';
		$viewdocumentosupervisor_grid->LoadRowValues();

		// Set row properties
		$viewdocumentosupervisor->ResetAttrs();
		$viewdocumentosupervisor->RowAttrs = array_merge($viewdocumentosupervisor->RowAttrs, array('data-rowindex'=>$viewdocumentosupervisor_grid->RowIndex, 'id'=>'r0_viewdocumentosupervisor', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($viewdocumentosupervisor->RowAttrs["class"], "ewTemplate");
		$viewdocumentosupervisor->RowType = EW_ROWTYPE_ADD;

		// Render row
		$viewdocumentosupervisor_grid->RenderRow();

		// Render list options
		$viewdocumentosupervisor_grid->RenderListOptions();
		$viewdocumentosupervisor_grid->StartRowCnt = 0;
?>
	<tr<?php echo $viewdocumentosupervisor->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewdocumentosupervisor_grid->ListOptions->Render("body", "left", $viewdocumentosupervisor_grid->RowIndex);
?>
	<?php if ($viewdocumentosupervisor->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion">
<?php if ($viewdocumentosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewdocumentosupervisor_descripcion" class="form-group viewdocumentosupervisor_descripcion">
<textarea data-table="viewdocumentosupervisor" data-field="x_descripcion" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentosupervisor->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentosupervisor->descripcion->EditAttributes() ?>><?php echo $viewdocumentosupervisor->descripcion->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewdocumentosupervisor_descripcion" class="form-group viewdocumentosupervisor_descripcion">
<span<?php echo $viewdocumentosupervisor->descripcion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosupervisor->descripcion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_descripcion" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->descripcion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_descripcion" name="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" id="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->descripcion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewdocumentosupervisor->imagen->Visible) { // imagen ?>
		<td data-name="imagen">
<span id="el$rowindex$_viewdocumentosupervisor_imagen" class="form-group viewdocumentosupervisor_imagen">
<div id="fd_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen">
<span title="<?php echo $viewdocumentosupervisor->imagen->FldTitle() ? $viewdocumentosupervisor->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentosupervisor->imagen->ReadOnly || $viewdocumentosupervisor->imagen->Disabled) echo " hide"; ?>" data-trigger="hover">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentosupervisor" data-field="x_imagen" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen"<?php echo $viewdocumentosupervisor->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosupervisor->imagen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fs_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosupervisor->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentosupervisor->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_imagen" name="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" id="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->imagen->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewdocumentosupervisor->avaluo->Visible) { // avaluo ?>
		<td data-name="avaluo">
<?php if ($viewdocumentosupervisor->CurrentAction <> "F") { ?>
<?php if ($viewdocumentosupervisor->avaluo->getSessionValue() <> "") { ?>
<span id="el$rowindex$_viewdocumentosupervisor_avaluo" class="form-group viewdocumentosupervisor_avaluo">
<span<?php echo $viewdocumentosupervisor->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosupervisor->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_viewdocumentosupervisor_avaluo" class="form-group viewdocumentosupervisor_avaluo">
<select data-table="viewdocumentosupervisor" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentosupervisor->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo"<?php echo $viewdocumentosupervisor->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentosupervisor->avaluo->SelectOptionListHtml("x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_viewdocumentosupervisor_avaluo" class="form-group viewdocumentosupervisor_avaluo">
<span<?php echo $viewdocumentosupervisor->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosupervisor->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_avaluo" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->avaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_avaluo" name="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" id="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->avaluo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewdocumentosupervisor->id_tipodocumento->Visible) { // id_tipodocumento ?>
		<td data-name="id_tipodocumento">
<?php if ($viewdocumentosupervisor->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewdocumentosupervisor_id_tipodocumento" class="form-group viewdocumentosupervisor_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next(":not([disabled])").click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($viewdocumentosupervisor->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentosupervisor->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentosupervisor->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentosupervisor->id_tipodocumento->ReadOnly || $viewdocumentosupervisor->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentosupervisor->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $viewdocumentosupervisor->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentosupervisor->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentosupervisor->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentosupervisor->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentosupervisor->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewdocumentosupervisor_id_tipodocumento" class="form-group viewdocumentosupervisor_id_tipodocumento">
<span<?php echo $viewdocumentosupervisor->id_tipodocumento->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentosupervisor->id_tipodocumento->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id_tipodocumento" name="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->id_tipodocumento->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewdocumentosupervisor" data-field="x_id_tipodocumento" name="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $viewdocumentosupervisor_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentosupervisor->id_tipodocumento->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewdocumentosupervisor_grid->ListOptions->Render("body", "right", $viewdocumentosupervisor_grid->RowIndex);
?>
<script type="text/javascript">
fviewdocumentosupervisorgrid.UpdateOpts(<?php echo $viewdocumentosupervisor_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($viewdocumentosupervisor->CurrentMode == "add" || $viewdocumentosupervisor->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $viewdocumentosupervisor_grid->FormKeyCountName ?>" id="<?php echo $viewdocumentosupervisor_grid->FormKeyCountName ?>" value="<?php echo $viewdocumentosupervisor_grid->KeyCount ?>">
<?php echo $viewdocumentosupervisor_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewdocumentosupervisor->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $viewdocumentosupervisor_grid->FormKeyCountName ?>" id="<?php echo $viewdocumentosupervisor_grid->FormKeyCountName ?>" value="<?php echo $viewdocumentosupervisor_grid->KeyCount ?>">
<?php echo $viewdocumentosupervisor_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewdocumentosupervisor->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fviewdocumentosupervisorgrid">
</div>
<?php

// Close recordset
if ($viewdocumentosupervisor_grid->Recordset)
	$viewdocumentosupervisor_grid->Recordset->Close();
?>
<?php if ($viewdocumentosupervisor_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($viewdocumentosupervisor_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($viewdocumentosupervisor_grid->TotalRecs == 0 && $viewdocumentosupervisor->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewdocumentosupervisor_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($viewdocumentosupervisor->Export == "") { ?>
<script type="text/javascript">
fviewdocumentosupervisorgrid.Init();
</script>
<?php } ?>
<?php
$viewdocumentosupervisor_grid->Page_Terminate();
?>
