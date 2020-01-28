<?php include_once "usuarioinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($documentosavaluo_grid)) $documentosavaluo_grid = new cdocumentosavaluo_grid();

// Page init
$documentosavaluo_grid->Page_Init();

// Page main
$documentosavaluo_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$documentosavaluo_grid->Page_Render();
?>
<?php if ($documentosavaluo->Export == "") { ?>
<script type="text/javascript">

// Form object
var fdocumentosavaluogrid = new ew_Form("fdocumentosavaluogrid", "grid");
fdocumentosavaluogrid.FormKeyCountName = '<?php echo $documentosavaluo_grid->FormKeyCountName ?>';

// Validate form
fdocumentosavaluogrid.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $documentosavaluo->descripcion->FldCaption(), $documentosavaluo->descripcion->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_created_at");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $documentosavaluo->created_at->FldCaption(), $documentosavaluo->created_at->ReqErrMsg)) ?>");
			elm = this.GetElements("x" + infix + "_created_at");
			if (elm && !ew_CheckDateDef(elm.value))
				return this.OnError(elm, "<?php echo ew_JsEncode2($documentosavaluo->created_at->FldErrMsg()) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fdocumentosavaluogrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "descripcion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "imagen", false)) return false;
	if (ew_ValueChanged(fobj, infix, "avaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_tipodocumento", false)) return false;
	if (ew_ValueChanged(fobj, infix, "created_at", false)) return false;
	return true;
}

// Form_CustomValidate event
fdocumentosavaluogrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fdocumentosavaluogrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fdocumentosavaluogrid.Lists["x_avaluo"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_codigoavaluo","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"avaluo"};
fdocumentosavaluogrid.Lists["x_avaluo"].Data = "<?php echo $documentosavaluo_grid->avaluo->LookupFilterQuery(FALSE, "grid") ?>";
fdocumentosavaluogrid.Lists["x_id_tipodocumento"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipodocumento"};
fdocumentosavaluogrid.Lists["x_id_tipodocumento"].Data = "<?php echo $documentosavaluo_grid->id_tipodocumento->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($documentosavaluo->CurrentAction == "gridadd") {
	if ($documentosavaluo->CurrentMode == "copy") {
		$bSelectLimit = $documentosavaluo_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$documentosavaluo_grid->TotalRecs = $documentosavaluo->ListRecordCount();
			$documentosavaluo_grid->Recordset = $documentosavaluo_grid->LoadRecordset($documentosavaluo_grid->StartRec-1, $documentosavaluo_grid->DisplayRecs);
		} else {
			if ($documentosavaluo_grid->Recordset = $documentosavaluo_grid->LoadRecordset())
				$documentosavaluo_grid->TotalRecs = $documentosavaluo_grid->Recordset->RecordCount();
		}
		$documentosavaluo_grid->StartRec = 1;
		$documentosavaluo_grid->DisplayRecs = $documentosavaluo_grid->TotalRecs;
	} else {
		$documentosavaluo->CurrentFilter = "0=1";
		$documentosavaluo_grid->StartRec = 1;
		$documentosavaluo_grid->DisplayRecs = $documentosavaluo->GridAddRowCount;
	}
	$documentosavaluo_grid->TotalRecs = $documentosavaluo_grid->DisplayRecs;
	$documentosavaluo_grid->StopRec = $documentosavaluo_grid->DisplayRecs;
} else {
	$bSelectLimit = $documentosavaluo_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($documentosavaluo_grid->TotalRecs <= 0)
			$documentosavaluo_grid->TotalRecs = $documentosavaluo->ListRecordCount();
	} else {
		if (!$documentosavaluo_grid->Recordset && ($documentosavaluo_grid->Recordset = $documentosavaluo_grid->LoadRecordset()))
			$documentosavaluo_grid->TotalRecs = $documentosavaluo_grid->Recordset->RecordCount();
	}
	$documentosavaluo_grid->StartRec = 1;
	$documentosavaluo_grid->DisplayRecs = $documentosavaluo_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$documentosavaluo_grid->Recordset = $documentosavaluo_grid->LoadRecordset($documentosavaluo_grid->StartRec-1, $documentosavaluo_grid->DisplayRecs);

	// Set no record found message
	if ($documentosavaluo->CurrentAction == "" && $documentosavaluo_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$documentosavaluo_grid->setWarningMessage(ew_DeniedMsg());
		if ($documentosavaluo_grid->SearchWhere == "0=101")
			$documentosavaluo_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$documentosavaluo_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$documentosavaluo_grid->RenderOtherOptions();
?>
<?php $documentosavaluo_grid->ShowPageHeader(); ?>
<?php
$documentosavaluo_grid->ShowMessage();
?>
<?php if ($documentosavaluo_grid->TotalRecs > 0 || $documentosavaluo->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($documentosavaluo_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> documentosavaluo">
<div id="fdocumentosavaluogrid" class="ewForm ewListForm form-inline">
<div id="gmp_documentosavaluo" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_documentosavaluogrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$documentosavaluo_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$documentosavaluo_grid->RenderListOptions();

// Render list options (header, left)
$documentosavaluo_grid->ListOptions->Render("header", "left");
?>
<?php if ($documentosavaluo->descripcion->Visible) { // descripcion ?>
	<?php if ($documentosavaluo->SortUrl($documentosavaluo->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $documentosavaluo->descripcion->HeaderCellClass() ?>"><div id="elh_documentosavaluo_descripcion" class="documentosavaluo_descripcion"><div class="ewTableHeaderCaption"><?php echo $documentosavaluo->descripcion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $documentosavaluo->descripcion->HeaderCellClass() ?>"><div><div id="elh_documentosavaluo_descripcion" class="documentosavaluo_descripcion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $documentosavaluo->descripcion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($documentosavaluo->descripcion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($documentosavaluo->descripcion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($documentosavaluo->imagen->Visible) { // imagen ?>
	<?php if ($documentosavaluo->SortUrl($documentosavaluo->imagen) == "") { ?>
		<th data-name="imagen" class="<?php echo $documentosavaluo->imagen->HeaderCellClass() ?>"><div id="elh_documentosavaluo_imagen" class="documentosavaluo_imagen"><div class="ewTableHeaderCaption"><?php echo $documentosavaluo->imagen->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="imagen" class="<?php echo $documentosavaluo->imagen->HeaderCellClass() ?>"><div><div id="elh_documentosavaluo_imagen" class="documentosavaluo_imagen">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $documentosavaluo->imagen->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($documentosavaluo->imagen->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($documentosavaluo->imagen->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($documentosavaluo->avaluo->Visible) { // avaluo ?>
	<?php if ($documentosavaluo->SortUrl($documentosavaluo->avaluo) == "") { ?>
		<th data-name="avaluo" class="<?php echo $documentosavaluo->avaluo->HeaderCellClass() ?>"><div id="elh_documentosavaluo_avaluo" class="documentosavaluo_avaluo"><div class="ewTableHeaderCaption"><?php echo $documentosavaluo->avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="avaluo" class="<?php echo $documentosavaluo->avaluo->HeaderCellClass() ?>"><div><div id="elh_documentosavaluo_avaluo" class="documentosavaluo_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $documentosavaluo->avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($documentosavaluo->avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($documentosavaluo->avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($documentosavaluo->id_tipodocumento->Visible) { // id_tipodocumento ?>
	<?php if ($documentosavaluo->SortUrl($documentosavaluo->id_tipodocumento) == "") { ?>
		<th data-name="id_tipodocumento" class="<?php echo $documentosavaluo->id_tipodocumento->HeaderCellClass() ?>"><div id="elh_documentosavaluo_id_tipodocumento" class="documentosavaluo_id_tipodocumento"><div class="ewTableHeaderCaption"><?php echo $documentosavaluo->id_tipodocumento->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_tipodocumento" class="<?php echo $documentosavaluo->id_tipodocumento->HeaderCellClass() ?>"><div><div id="elh_documentosavaluo_id_tipodocumento" class="documentosavaluo_id_tipodocumento">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $documentosavaluo->id_tipodocumento->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($documentosavaluo->id_tipodocumento->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($documentosavaluo->id_tipodocumento->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($documentosavaluo->created_at->Visible) { // created_at ?>
	<?php if ($documentosavaluo->SortUrl($documentosavaluo->created_at) == "") { ?>
		<th data-name="created_at" class="<?php echo $documentosavaluo->created_at->HeaderCellClass() ?>"><div id="elh_documentosavaluo_created_at" class="documentosavaluo_created_at"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $documentosavaluo->created_at->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="created_at" class="<?php echo $documentosavaluo->created_at->HeaderCellClass() ?>"><div><div id="elh_documentosavaluo_created_at" class="documentosavaluo_created_at">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $documentosavaluo->created_at->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($documentosavaluo->created_at->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($documentosavaluo->created_at->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$documentosavaluo_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$documentosavaluo_grid->StartRec = 1;
$documentosavaluo_grid->StopRec = $documentosavaluo_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($documentosavaluo_grid->FormKeyCountName) && ($documentosavaluo->CurrentAction == "gridadd" || $documentosavaluo->CurrentAction == "gridedit" || $documentosavaluo->CurrentAction == "F")) {
		$documentosavaluo_grid->KeyCount = $objForm->GetValue($documentosavaluo_grid->FormKeyCountName);
		$documentosavaluo_grid->StopRec = $documentosavaluo_grid->StartRec + $documentosavaluo_grid->KeyCount - 1;
	}
}
$documentosavaluo_grid->RecCnt = $documentosavaluo_grid->StartRec - 1;
if ($documentosavaluo_grid->Recordset && !$documentosavaluo_grid->Recordset->EOF) {
	$documentosavaluo_grid->Recordset->MoveFirst();
	$bSelectLimit = $documentosavaluo_grid->UseSelectLimit;
	if (!$bSelectLimit && $documentosavaluo_grid->StartRec > 1)
		$documentosavaluo_grid->Recordset->Move($documentosavaluo_grid->StartRec - 1);
} elseif (!$documentosavaluo->AllowAddDeleteRow && $documentosavaluo_grid->StopRec == 0) {
	$documentosavaluo_grid->StopRec = $documentosavaluo->GridAddRowCount;
}

// Initialize aggregate
$documentosavaluo->RowType = EW_ROWTYPE_AGGREGATEINIT;
$documentosavaluo->ResetAttrs();
$documentosavaluo_grid->RenderRow();
if ($documentosavaluo->CurrentAction == "gridadd")
	$documentosavaluo_grid->RowIndex = 0;
if ($documentosavaluo->CurrentAction == "gridedit")
	$documentosavaluo_grid->RowIndex = 0;
while ($documentosavaluo_grid->RecCnt < $documentosavaluo_grid->StopRec) {
	$documentosavaluo_grid->RecCnt++;
	if (intval($documentosavaluo_grid->RecCnt) >= intval($documentosavaluo_grid->StartRec)) {
		$documentosavaluo_grid->RowCnt++;
		if ($documentosavaluo->CurrentAction == "gridadd" || $documentosavaluo->CurrentAction == "gridedit" || $documentosavaluo->CurrentAction == "F") {
			$documentosavaluo_grid->RowIndex++;
			$objForm->Index = $documentosavaluo_grid->RowIndex;
			if ($objForm->HasValue($documentosavaluo_grid->FormActionName))
				$documentosavaluo_grid->RowAction = strval($objForm->GetValue($documentosavaluo_grid->FormActionName));
			elseif ($documentosavaluo->CurrentAction == "gridadd")
				$documentosavaluo_grid->RowAction = "insert";
			else
				$documentosavaluo_grid->RowAction = "";
		}

		// Set up key count
		$documentosavaluo_grid->KeyCount = $documentosavaluo_grid->RowIndex;

		// Init row class and style
		$documentosavaluo->ResetAttrs();
		$documentosavaluo->CssClass = "";
		if ($documentosavaluo->CurrentAction == "gridadd") {
			if ($documentosavaluo->CurrentMode == "copy") {
				$documentosavaluo_grid->LoadRowValues($documentosavaluo_grid->Recordset); // Load row values
				$documentosavaluo_grid->SetRecordKey($documentosavaluo_grid->RowOldKey, $documentosavaluo_grid->Recordset); // Set old record key
			} else {
				$documentosavaluo_grid->LoadRowValues(); // Load default values
				$documentosavaluo_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$documentosavaluo_grid->LoadRowValues($documentosavaluo_grid->Recordset); // Load row values
		}
		$documentosavaluo->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($documentosavaluo->CurrentAction == "gridadd") // Grid add
			$documentosavaluo->RowType = EW_ROWTYPE_ADD; // Render add
		if ($documentosavaluo->CurrentAction == "gridadd" && $documentosavaluo->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$documentosavaluo_grid->RestoreCurrentRowFormValues($documentosavaluo_grid->RowIndex); // Restore form values
		if ($documentosavaluo->CurrentAction == "gridedit") { // Grid edit
			if ($documentosavaluo->EventCancelled) {
				$documentosavaluo_grid->RestoreCurrentRowFormValues($documentosavaluo_grid->RowIndex); // Restore form values
			}
			if ($documentosavaluo_grid->RowAction == "insert")
				$documentosavaluo->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$documentosavaluo->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($documentosavaluo->CurrentAction == "gridedit" && ($documentosavaluo->RowType == EW_ROWTYPE_EDIT || $documentosavaluo->RowType == EW_ROWTYPE_ADD) && $documentosavaluo->EventCancelled) // Update failed
			$documentosavaluo_grid->RestoreCurrentRowFormValues($documentosavaluo_grid->RowIndex); // Restore form values
		if ($documentosavaluo->RowType == EW_ROWTYPE_EDIT) // Edit row
			$documentosavaluo_grid->EditRowCnt++;
		if ($documentosavaluo->CurrentAction == "F") // Confirm row
			$documentosavaluo_grid->RestoreCurrentRowFormValues($documentosavaluo_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$documentosavaluo->RowAttrs = array_merge($documentosavaluo->RowAttrs, array('data-rowindex'=>$documentosavaluo_grid->RowCnt, 'id'=>'r' . $documentosavaluo_grid->RowCnt . '_documentosavaluo', 'data-rowtype'=>$documentosavaluo->RowType));

		// Render row
		$documentosavaluo_grid->RenderRow();

		// Render list options
		$documentosavaluo_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($documentosavaluo_grid->RowAction <> "delete" && $documentosavaluo_grid->RowAction <> "insertdelete" && !($documentosavaluo_grid->RowAction == "insert" && $documentosavaluo->CurrentAction == "F" && $documentosavaluo_grid->EmptyRow())) {
?>
	<tr<?php echo $documentosavaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$documentosavaluo_grid->ListOptions->Render("body", "left", $documentosavaluo_grid->RowCnt);
?>
	<?php if ($documentosavaluo->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion"<?php echo $documentosavaluo->descripcion->CellAttributes() ?>>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_descripcion" class="form-group documentosavaluo_descripcion">
<textarea data-table="documentosavaluo" data-field="x_descripcion" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($documentosavaluo->descripcion->getPlaceHolder()) ?>"<?php echo $documentosavaluo->descripcion->EditAttributes() ?>><?php echo $documentosavaluo->descripcion->EditValue ?></textarea>
</span>
<input type="hidden" data-table="documentosavaluo" data-field="x_descripcion" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($documentosavaluo->descripcion->OldValue) ?>">
<?php } ?>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_descripcion" class="form-group documentosavaluo_descripcion">
<textarea data-table="documentosavaluo" data-field="x_descripcion" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($documentosavaluo->descripcion->getPlaceHolder()) ?>"<?php echo $documentosavaluo->descripcion->EditAttributes() ?>><?php echo $documentosavaluo->descripcion->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_descripcion" class="documentosavaluo_descripcion">
<span<?php echo $documentosavaluo->descripcion->ViewAttributes() ?>>
<?php echo $documentosavaluo->descripcion->ListViewValue() ?></span>
</span>
<?php if ($documentosavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_descripcion" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($documentosavaluo->descripcion->FormValue) ?>">
<input type="hidden" data-table="documentosavaluo" data-field="x_descripcion" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($documentosavaluo->descripcion->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_descripcion" name="fdocumentosavaluogrid$x<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" id="fdocumentosavaluogrid$x<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($documentosavaluo->descripcion->FormValue) ?>">
<input type="hidden" data-table="documentosavaluo" data-field="x_descripcion" name="fdocumentosavaluogrid$o<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" id="fdocumentosavaluogrid$o<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($documentosavaluo->descripcion->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_id" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_id" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($documentosavaluo->id->CurrentValue) ?>">
<input type="hidden" data-table="documentosavaluo" data-field="x_id" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_id" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($documentosavaluo->id->OldValue) ?>">
<?php } ?>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_EDIT || $documentosavaluo->CurrentMode == "edit") { ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_id" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_id" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($documentosavaluo->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($documentosavaluo->imagen->Visible) { // imagen ?>
		<td data-name="imagen"<?php echo $documentosavaluo->imagen->CellAttributes() ?>>
<?php if ($documentosavaluo_grid->RowAction == "insert") { // Add record ?>
<span id="el$rowindex$_documentosavaluo_imagen" class="form-group documentosavaluo_imagen">
<div id="fd_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen">
<span title="<?php echo $documentosavaluo->imagen->FldTitle() ? $documentosavaluo->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($documentosavaluo->imagen->ReadOnly || $documentosavaluo->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="documentosavaluo" data-field="x_imagen" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen"<?php echo $documentosavaluo->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="<?php echo $documentosavaluo->imagen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fs_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="<?php echo $documentosavaluo->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="<?php echo $documentosavaluo->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="documentosavaluo" data-field="x_imagen" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($documentosavaluo->imagen->OldValue) ?>">
<?php } elseif ($documentosavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_imagen" class="documentosavaluo_imagen">
<span<?php echo $documentosavaluo->imagen->ViewAttributes() ?>>
<?php echo ew_GetFileViewTag($documentosavaluo->imagen, $documentosavaluo->imagen->ListViewValue()) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_imagen" class="form-group documentosavaluo_imagen">
<div id="fd_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen">
<span title="<?php echo $documentosavaluo->imagen->FldTitle() ? $documentosavaluo->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($documentosavaluo->imagen->ReadOnly || $documentosavaluo->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="documentosavaluo" data-field="x_imagen" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen"<?php echo $documentosavaluo->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="<?php echo $documentosavaluo->imagen->Upload->FileName ?>">
<?php if (@$_POST["fa_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen"] == "0") { ?>
<input type="hidden" name="fa_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="<?php echo $documentosavaluo->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="<?php echo $documentosavaluo->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($documentosavaluo->avaluo->Visible) { // avaluo ?>
		<td data-name="avaluo"<?php echo $documentosavaluo->avaluo->CellAttributes() ?>>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($documentosavaluo->avaluo->getSessionValue() <> "") { ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_avaluo" class="form-group documentosavaluo_avaluo">
<span<?php echo $documentosavaluo->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $documentosavaluo->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($documentosavaluo->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_avaluo" class="form-group documentosavaluo_avaluo">
<select data-table="documentosavaluo" data-field="x_avaluo" data-value-separator="<?php echo $documentosavaluo->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo"<?php echo $documentosavaluo->avaluo->EditAttributes() ?>>
<?php echo $documentosavaluo->avaluo->SelectOptionListHtml("x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_avaluo" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($documentosavaluo->avaluo->OldValue) ?>">
<?php } ?>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($documentosavaluo->avaluo->getSessionValue() <> "") { ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_avaluo" class="form-group documentosavaluo_avaluo">
<span<?php echo $documentosavaluo->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $documentosavaluo->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($documentosavaluo->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_avaluo" class="form-group documentosavaluo_avaluo">
<select data-table="documentosavaluo" data-field="x_avaluo" data-value-separator="<?php echo $documentosavaluo->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo"<?php echo $documentosavaluo->avaluo->EditAttributes() ?>>
<?php echo $documentosavaluo->avaluo->SelectOptionListHtml("x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_avaluo" class="documentosavaluo_avaluo">
<span<?php echo $documentosavaluo->avaluo->ViewAttributes() ?>>
<?php echo $documentosavaluo->avaluo->ListViewValue() ?></span>
</span>
<?php if ($documentosavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_avaluo" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($documentosavaluo->avaluo->FormValue) ?>">
<input type="hidden" data-table="documentosavaluo" data-field="x_avaluo" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($documentosavaluo->avaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_avaluo" name="fdocumentosavaluogrid$x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" id="fdocumentosavaluogrid$x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($documentosavaluo->avaluo->FormValue) ?>">
<input type="hidden" data-table="documentosavaluo" data-field="x_avaluo" name="fdocumentosavaluogrid$o<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" id="fdocumentosavaluogrid$o<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($documentosavaluo->avaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($documentosavaluo->id_tipodocumento->Visible) { // id_tipodocumento ?>
		<td data-name="id_tipodocumento"<?php echo $documentosavaluo->id_tipodocumento->CellAttributes() ?>>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_id_tipodocumento" class="form-group documentosavaluo_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($documentosavaluo->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $documentosavaluo->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($documentosavaluo->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($documentosavaluo->id_tipodocumento->ReadOnly || $documentosavaluo->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="documentosavaluo" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $documentosavaluo->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $documentosavaluo->id_tipodocumento->CurrentValue ?>"<?php echo $documentosavaluo->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$documentosavaluo->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $documentosavaluo->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $documentosavaluo->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<input type="hidden" data-table="documentosavaluo" data-field="x_id_tipodocumento" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($documentosavaluo->id_tipodocumento->OldValue) ?>">
<?php } ?>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_id_tipodocumento" class="form-group documentosavaluo_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($documentosavaluo->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $documentosavaluo->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($documentosavaluo->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($documentosavaluo->id_tipodocumento->ReadOnly || $documentosavaluo->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="documentosavaluo" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $documentosavaluo->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $documentosavaluo->id_tipodocumento->CurrentValue ?>"<?php echo $documentosavaluo->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$documentosavaluo->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $documentosavaluo->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $documentosavaluo->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } ?>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_id_tipodocumento" class="documentosavaluo_id_tipodocumento">
<span<?php echo $documentosavaluo->id_tipodocumento->ViewAttributes() ?>>
<?php echo $documentosavaluo->id_tipodocumento->ListViewValue() ?></span>
</span>
<?php if ($documentosavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_id_tipodocumento" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($documentosavaluo->id_tipodocumento->FormValue) ?>">
<input type="hidden" data-table="documentosavaluo" data-field="x_id_tipodocumento" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($documentosavaluo->id_tipodocumento->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_id_tipodocumento" name="fdocumentosavaluogrid$x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" id="fdocumentosavaluogrid$x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($documentosavaluo->id_tipodocumento->FormValue) ?>">
<input type="hidden" data-table="documentosavaluo" data-field="x_id_tipodocumento" name="fdocumentosavaluogrid$o<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" id="fdocumentosavaluogrid$o<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($documentosavaluo->id_tipodocumento->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($documentosavaluo->created_at->Visible) { // created_at ?>
		<td data-name="created_at"<?php echo $documentosavaluo->created_at->CellAttributes() ?>>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_created_at" class="form-group documentosavaluo_created_at">
<input type="text" data-table="documentosavaluo" data-field="x_created_at" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" placeholder="<?php echo ew_HtmlEncode($documentosavaluo->created_at->getPlaceHolder()) ?>" value="<?php echo $documentosavaluo->created_at->EditValue ?>"<?php echo $documentosavaluo->created_at->EditAttributes() ?>>
</span>
<input type="hidden" data-table="documentosavaluo" data-field="x_created_at" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($documentosavaluo->created_at->OldValue) ?>">
<?php } ?>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_created_at" class="form-group documentosavaluo_created_at">
<input type="text" data-table="documentosavaluo" data-field="x_created_at" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" placeholder="<?php echo ew_HtmlEncode($documentosavaluo->created_at->getPlaceHolder()) ?>" value="<?php echo $documentosavaluo->created_at->EditValue ?>"<?php echo $documentosavaluo->created_at->EditAttributes() ?>>
</span>
<?php } ?>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $documentosavaluo_grid->RowCnt ?>_documentosavaluo_created_at" class="documentosavaluo_created_at">
<span<?php echo $documentosavaluo->created_at->ViewAttributes() ?>>
<?php echo $documentosavaluo->created_at->ListViewValue() ?></span>
</span>
<?php if ($documentosavaluo->CurrentAction <> "F") { ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_created_at" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($documentosavaluo->created_at->FormValue) ?>">
<input type="hidden" data-table="documentosavaluo" data-field="x_created_at" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($documentosavaluo->created_at->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_created_at" name="fdocumentosavaluogrid$x<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" id="fdocumentosavaluogrid$x<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($documentosavaluo->created_at->FormValue) ?>">
<input type="hidden" data-table="documentosavaluo" data-field="x_created_at" name="fdocumentosavaluogrid$o<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" id="fdocumentosavaluogrid$o<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($documentosavaluo->created_at->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$documentosavaluo_grid->ListOptions->Render("body", "right", $documentosavaluo_grid->RowCnt);
?>
	</tr>
<?php if ($documentosavaluo->RowType == EW_ROWTYPE_ADD || $documentosavaluo->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fdocumentosavaluogrid.UpdateOpts(<?php echo $documentosavaluo_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($documentosavaluo->CurrentAction <> "gridadd" || $documentosavaluo->CurrentMode == "copy")
		if (!$documentosavaluo_grid->Recordset->EOF) $documentosavaluo_grid->Recordset->MoveNext();
}
?>
<?php
	if ($documentosavaluo->CurrentMode == "add" || $documentosavaluo->CurrentMode == "copy" || $documentosavaluo->CurrentMode == "edit") {
		$documentosavaluo_grid->RowIndex = '$rowindex$';
		$documentosavaluo_grid->LoadRowValues();

		// Set row properties
		$documentosavaluo->ResetAttrs();
		$documentosavaluo->RowAttrs = array_merge($documentosavaluo->RowAttrs, array('data-rowindex'=>$documentosavaluo_grid->RowIndex, 'id'=>'r0_documentosavaluo', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($documentosavaluo->RowAttrs["class"], "ewTemplate");
		$documentosavaluo->RowType = EW_ROWTYPE_ADD;

		// Render row
		$documentosavaluo_grid->RenderRow();

		// Render list options
		$documentosavaluo_grid->RenderListOptions();
		$documentosavaluo_grid->StartRowCnt = 0;
?>
	<tr<?php echo $documentosavaluo->RowAttributes() ?>>
<?php

// Render list options (body, left)
$documentosavaluo_grid->ListOptions->Render("body", "left", $documentosavaluo_grid->RowIndex);
?>
	<?php if ($documentosavaluo->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion">
<?php if ($documentosavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_documentosavaluo_descripcion" class="form-group documentosavaluo_descripcion">
<textarea data-table="documentosavaluo" data-field="x_descripcion" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($documentosavaluo->descripcion->getPlaceHolder()) ?>"<?php echo $documentosavaluo->descripcion->EditAttributes() ?>><?php echo $documentosavaluo->descripcion->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_documentosavaluo_descripcion" class="form-group documentosavaluo_descripcion">
<span<?php echo $documentosavaluo->descripcion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $documentosavaluo->descripcion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="documentosavaluo" data-field="x_descripcion" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($documentosavaluo->descripcion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_descripcion" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($documentosavaluo->descripcion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($documentosavaluo->imagen->Visible) { // imagen ?>
		<td data-name="imagen">
<span id="el$rowindex$_documentosavaluo_imagen" class="form-group documentosavaluo_imagen">
<div id="fd_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen">
<span title="<?php echo $documentosavaluo->imagen->FldTitle() ? $documentosavaluo->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($documentosavaluo->imagen->ReadOnly || $documentosavaluo->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="documentosavaluo" data-field="x_imagen" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen"<?php echo $documentosavaluo->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="<?php echo $documentosavaluo->imagen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fs_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="<?php echo $documentosavaluo->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="<?php echo $documentosavaluo->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="documentosavaluo" data-field="x_imagen" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($documentosavaluo->imagen->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($documentosavaluo->avaluo->Visible) { // avaluo ?>
		<td data-name="avaluo">
<?php if ($documentosavaluo->CurrentAction <> "F") { ?>
<?php if ($documentosavaluo->avaluo->getSessionValue() <> "") { ?>
<span id="el$rowindex$_documentosavaluo_avaluo" class="form-group documentosavaluo_avaluo">
<span<?php echo $documentosavaluo->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $documentosavaluo->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($documentosavaluo->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_documentosavaluo_avaluo" class="form-group documentosavaluo_avaluo">
<select data-table="documentosavaluo" data-field="x_avaluo" data-value-separator="<?php echo $documentosavaluo->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo"<?php echo $documentosavaluo->avaluo->EditAttributes() ?>>
<?php echo $documentosavaluo->avaluo->SelectOptionListHtml("x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_documentosavaluo_avaluo" class="form-group documentosavaluo_avaluo">
<span<?php echo $documentosavaluo->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $documentosavaluo->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="documentosavaluo" data-field="x_avaluo" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($documentosavaluo->avaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_avaluo" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($documentosavaluo->avaluo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($documentosavaluo->id_tipodocumento->Visible) { // id_tipodocumento ?>
		<td data-name="id_tipodocumento">
<?php if ($documentosavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_documentosavaluo_id_tipodocumento" class="form-group documentosavaluo_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($documentosavaluo->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $documentosavaluo->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($documentosavaluo->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($documentosavaluo->id_tipodocumento->ReadOnly || $documentosavaluo->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="documentosavaluo" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $documentosavaluo->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $documentosavaluo->id_tipodocumento->CurrentValue ?>"<?php echo $documentosavaluo->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$documentosavaluo->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $documentosavaluo->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $documentosavaluo->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_documentosavaluo_id_tipodocumento" class="form-group documentosavaluo_id_tipodocumento">
<span<?php echo $documentosavaluo->id_tipodocumento->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $documentosavaluo->id_tipodocumento->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="documentosavaluo" data-field="x_id_tipodocumento" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($documentosavaluo->id_tipodocumento->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_id_tipodocumento" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($documentosavaluo->id_tipodocumento->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($documentosavaluo->created_at->Visible) { // created_at ?>
		<td data-name="created_at">
<?php if ($documentosavaluo->CurrentAction <> "F") { ?>
<span id="el$rowindex$_documentosavaluo_created_at" class="form-group documentosavaluo_created_at">
<input type="text" data-table="documentosavaluo" data-field="x_created_at" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" placeholder="<?php echo ew_HtmlEncode($documentosavaluo->created_at->getPlaceHolder()) ?>" value="<?php echo $documentosavaluo->created_at->EditValue ?>"<?php echo $documentosavaluo->created_at->EditAttributes() ?>>
</span>
<?php } else { ?>
<span id="el$rowindex$_documentosavaluo_created_at" class="form-group documentosavaluo_created_at">
<span<?php echo $documentosavaluo->created_at->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $documentosavaluo->created_at->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="documentosavaluo" data-field="x_created_at" name="x<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" id="x<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($documentosavaluo->created_at->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="documentosavaluo" data-field="x_created_at" name="o<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" id="o<?php echo $documentosavaluo_grid->RowIndex ?>_created_at" value="<?php echo ew_HtmlEncode($documentosavaluo->created_at->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$documentosavaluo_grid->ListOptions->Render("body", "right", $documentosavaluo_grid->RowCnt);
?>
<script type="text/javascript">
fdocumentosavaluogrid.UpdateOpts(<?php echo $documentosavaluo_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($documentosavaluo->CurrentMode == "add" || $documentosavaluo->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $documentosavaluo_grid->FormKeyCountName ?>" id="<?php echo $documentosavaluo_grid->FormKeyCountName ?>" value="<?php echo $documentosavaluo_grid->KeyCount ?>">
<?php echo $documentosavaluo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($documentosavaluo->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $documentosavaluo_grid->FormKeyCountName ?>" id="<?php echo $documentosavaluo_grid->FormKeyCountName ?>" value="<?php echo $documentosavaluo_grid->KeyCount ?>">
<?php echo $documentosavaluo_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($documentosavaluo->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fdocumentosavaluogrid">
</div>
<?php

// Close recordset
if ($documentosavaluo_grid->Recordset)
	$documentosavaluo_grid->Recordset->Close();
?>
<?php if ($documentosavaluo_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($documentosavaluo_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($documentosavaluo_grid->TotalRecs == 0 && $documentosavaluo->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($documentosavaluo_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($documentosavaluo->Export == "") { ?>
<script type="text/javascript">
fdocumentosavaluogrid.Init();
</script>
<?php } ?>
<?php
$documentosavaluo_grid->Page_Terminate();
?>
