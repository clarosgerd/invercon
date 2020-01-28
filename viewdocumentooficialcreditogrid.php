<?php include_once "usuarioinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($viewdocumentooficialcredito_grid)) $viewdocumentooficialcredito_grid = new cviewdocumentooficialcredito_grid();

// Page init
$viewdocumentooficialcredito_grid->Page_Init();

// Page main
$viewdocumentooficialcredito_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewdocumentooficialcredito_grid->Page_Render();
?>
<?php if ($viewdocumentooficialcredito->Export == "") { ?>
<script type="text/javascript">

// Form object
var fviewdocumentooficialcreditogrid = new ew_Form("fviewdocumentooficialcreditogrid", "grid");
fviewdocumentooficialcreditogrid.FormKeyCountName = '<?php echo $viewdocumentooficialcredito_grid->FormKeyCountName ?>';

// Validate form
fviewdocumentooficialcreditogrid.Validate = function() {
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
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewdocumentooficialcredito->descripcion->FldCaption(), $viewdocumentooficialcredito->descripcion->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fviewdocumentooficialcreditogrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "descripcion", false)) return false;
	if (ew_ValueChanged(fobj, infix, "imagen", false)) return false;
	if (ew_ValueChanged(fobj, infix, "avaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_tipodocumento", false)) return false;
	return true;
}

// Form_CustomValidate event
fviewdocumentooficialcreditogrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewdocumentooficialcreditogrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewdocumentooficialcreditogrid.Lists["x_avaluo"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_tipoinmueble","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"avaluo"};
fviewdocumentooficialcreditogrid.Lists["x_avaluo"].Data = "<?php echo $viewdocumentooficialcredito_grid->avaluo->LookupFilterQuery(FALSE, "grid") ?>";
fviewdocumentooficialcreditogrid.Lists["x_id_tipodocumento"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"tipodocumento"};
fviewdocumentooficialcreditogrid.Lists["x_id_tipodocumento"].Data = "<?php echo $viewdocumentooficialcredito_grid->id_tipodocumento->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($viewdocumentooficialcredito->CurrentAction == "gridadd") {
	if ($viewdocumentooficialcredito->CurrentMode == "copy") {
		$bSelectLimit = $viewdocumentooficialcredito_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$viewdocumentooficialcredito_grid->TotalRecs = $viewdocumentooficialcredito->ListRecordCount();
			$viewdocumentooficialcredito_grid->Recordset = $viewdocumentooficialcredito_grid->LoadRecordset($viewdocumentooficialcredito_grid->StartRec-1, $viewdocumentooficialcredito_grid->DisplayRecs);
		} else {
			if ($viewdocumentooficialcredito_grid->Recordset = $viewdocumentooficialcredito_grid->LoadRecordset())
				$viewdocumentooficialcredito_grid->TotalRecs = $viewdocumentooficialcredito_grid->Recordset->RecordCount();
		}
		$viewdocumentooficialcredito_grid->StartRec = 1;
		$viewdocumentooficialcredito_grid->DisplayRecs = $viewdocumentooficialcredito_grid->TotalRecs;
	} else {
		$viewdocumentooficialcredito->CurrentFilter = "0=1";
		$viewdocumentooficialcredito_grid->StartRec = 1;
		$viewdocumentooficialcredito_grid->DisplayRecs = $viewdocumentooficialcredito->GridAddRowCount;
	}
	$viewdocumentooficialcredito_grid->TotalRecs = $viewdocumentooficialcredito_grid->DisplayRecs;
	$viewdocumentooficialcredito_grid->StopRec = $viewdocumentooficialcredito_grid->DisplayRecs;
} else {
	$bSelectLimit = $viewdocumentooficialcredito_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($viewdocumentooficialcredito_grid->TotalRecs <= 0)
			$viewdocumentooficialcredito_grid->TotalRecs = $viewdocumentooficialcredito->ListRecordCount();
	} else {
		if (!$viewdocumentooficialcredito_grid->Recordset && ($viewdocumentooficialcredito_grid->Recordset = $viewdocumentooficialcredito_grid->LoadRecordset()))
			$viewdocumentooficialcredito_grid->TotalRecs = $viewdocumentooficialcredito_grid->Recordset->RecordCount();
	}
	$viewdocumentooficialcredito_grid->StartRec = 1;
	$viewdocumentooficialcredito_grid->DisplayRecs = $viewdocumentooficialcredito_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$viewdocumentooficialcredito_grid->Recordset = $viewdocumentooficialcredito_grid->LoadRecordset($viewdocumentooficialcredito_grid->StartRec-1, $viewdocumentooficialcredito_grid->DisplayRecs);

	// Set no record found message
	if ($viewdocumentooficialcredito->CurrentAction == "" && $viewdocumentooficialcredito_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$viewdocumentooficialcredito_grid->setWarningMessage(ew_DeniedMsg());
		if ($viewdocumentooficialcredito_grid->SearchWhere == "0=101")
			$viewdocumentooficialcredito_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$viewdocumentooficialcredito_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$viewdocumentooficialcredito_grid->RenderOtherOptions();
?>
<?php $viewdocumentooficialcredito_grid->ShowPageHeader(); ?>
<?php
$viewdocumentooficialcredito_grid->ShowMessage();
?>
<?php if ($viewdocumentooficialcredito_grid->TotalRecs > 0 || $viewdocumentooficialcredito->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($viewdocumentooficialcredito_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewdocumentooficialcredito">
<div id="fviewdocumentooficialcreditogrid" class="ewForm ewListForm form-inline">
<div id="gmp_viewdocumentooficialcredito" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_viewdocumentooficialcreditogrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$viewdocumentooficialcredito_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$viewdocumentooficialcredito_grid->RenderListOptions();

// Render list options (header, left)
$viewdocumentooficialcredito_grid->ListOptions->Render("header", "left");
?>
<?php if ($viewdocumentooficialcredito->descripcion->Visible) { // descripcion ?>
	<?php if ($viewdocumentooficialcredito->SortUrl($viewdocumentooficialcredito->descripcion) == "") { ?>
		<th data-name="descripcion" class="<?php echo $viewdocumentooficialcredito->descripcion->HeaderCellClass() ?>"><div id="elh_viewdocumentooficialcredito_descripcion" class="viewdocumentooficialcredito_descripcion"><div class="ewTableHeaderCaption"><?php echo $viewdocumentooficialcredito->descripcion->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="descripcion" class="<?php echo $viewdocumentooficialcredito->descripcion->HeaderCellClass() ?>"><div><div id="elh_viewdocumentooficialcredito_descripcion" class="viewdocumentooficialcredito_descripcion">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentooficialcredito->descripcion->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentooficialcredito->descripcion->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentooficialcredito->descripcion->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewdocumentooficialcredito->imagen->Visible) { // imagen ?>
	<?php if ($viewdocumentooficialcredito->SortUrl($viewdocumentooficialcredito->imagen) == "") { ?>
		<th data-name="imagen" class="<?php echo $viewdocumentooficialcredito->imagen->HeaderCellClass() ?>"><div id="elh_viewdocumentooficialcredito_imagen" class="viewdocumentooficialcredito_imagen"><div class="ewTableHeaderCaption"><?php echo $viewdocumentooficialcredito->imagen->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="imagen" class="<?php echo $viewdocumentooficialcredito->imagen->HeaderCellClass() ?>"><div><div id="elh_viewdocumentooficialcredito_imagen" class="viewdocumentooficialcredito_imagen">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentooficialcredito->imagen->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentooficialcredito->imagen->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentooficialcredito->imagen->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewdocumentooficialcredito->avaluo->Visible) { // avaluo ?>
	<?php if ($viewdocumentooficialcredito->SortUrl($viewdocumentooficialcredito->avaluo) == "") { ?>
		<th data-name="avaluo" class="<?php echo $viewdocumentooficialcredito->avaluo->HeaderCellClass() ?>"><div id="elh_viewdocumentooficialcredito_avaluo" class="viewdocumentooficialcredito_avaluo"><div class="ewTableHeaderCaption"><?php echo $viewdocumentooficialcredito->avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="avaluo" class="<?php echo $viewdocumentooficialcredito->avaluo->HeaderCellClass() ?>"><div><div id="elh_viewdocumentooficialcredito_avaluo" class="viewdocumentooficialcredito_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentooficialcredito->avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentooficialcredito->avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentooficialcredito->avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewdocumentooficialcredito->id_tipodocumento->Visible) { // id_tipodocumento ?>
	<?php if ($viewdocumentooficialcredito->SortUrl($viewdocumentooficialcredito->id_tipodocumento) == "") { ?>
		<th data-name="id_tipodocumento" class="<?php echo $viewdocumentooficialcredito->id_tipodocumento->HeaderCellClass() ?>"><div id="elh_viewdocumentooficialcredito_id_tipodocumento" class="viewdocumentooficialcredito_id_tipodocumento"><div class="ewTableHeaderCaption"><?php echo $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_tipodocumento" class="<?php echo $viewdocumentooficialcredito->id_tipodocumento->HeaderCellClass() ?>"><div><div id="elh_viewdocumentooficialcredito_id_tipodocumento" class="viewdocumentooficialcredito_id_tipodocumento">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewdocumentooficialcredito->id_tipodocumento->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewdocumentooficialcredito->id_tipodocumento->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$viewdocumentooficialcredito_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$viewdocumentooficialcredito_grid->StartRec = 1;
$viewdocumentooficialcredito_grid->StopRec = $viewdocumentooficialcredito_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($viewdocumentooficialcredito_grid->FormKeyCountName) && ($viewdocumentooficialcredito->CurrentAction == "gridadd" || $viewdocumentooficialcredito->CurrentAction == "gridedit" || $viewdocumentooficialcredito->CurrentAction == "F")) {
		$viewdocumentooficialcredito_grid->KeyCount = $objForm->GetValue($viewdocumentooficialcredito_grid->FormKeyCountName);
		$viewdocumentooficialcredito_grid->StopRec = $viewdocumentooficialcredito_grid->StartRec + $viewdocumentooficialcredito_grid->KeyCount - 1;
	}
}
$viewdocumentooficialcredito_grid->RecCnt = $viewdocumentooficialcredito_grid->StartRec - 1;
if ($viewdocumentooficialcredito_grid->Recordset && !$viewdocumentooficialcredito_grid->Recordset->EOF) {
	$viewdocumentooficialcredito_grid->Recordset->MoveFirst();
	$bSelectLimit = $viewdocumentooficialcredito_grid->UseSelectLimit;
	if (!$bSelectLimit && $viewdocumentooficialcredito_grid->StartRec > 1)
		$viewdocumentooficialcredito_grid->Recordset->Move($viewdocumentooficialcredito_grid->StartRec - 1);
} elseif (!$viewdocumentooficialcredito->AllowAddDeleteRow && $viewdocumentooficialcredito_grid->StopRec == 0) {
	$viewdocumentooficialcredito_grid->StopRec = $viewdocumentooficialcredito->GridAddRowCount;
}

// Initialize aggregate
$viewdocumentooficialcredito->RowType = EW_ROWTYPE_AGGREGATEINIT;
$viewdocumentooficialcredito->ResetAttrs();
$viewdocumentooficialcredito_grid->RenderRow();
if ($viewdocumentooficialcredito->CurrentAction == "gridadd")
	$viewdocumentooficialcredito_grid->RowIndex = 0;
if ($viewdocumentooficialcredito->CurrentAction == "gridedit")
	$viewdocumentooficialcredito_grid->RowIndex = 0;
while ($viewdocumentooficialcredito_grid->RecCnt < $viewdocumentooficialcredito_grid->StopRec) {
	$viewdocumentooficialcredito_grid->RecCnt++;
	if (intval($viewdocumentooficialcredito_grid->RecCnt) >= intval($viewdocumentooficialcredito_grid->StartRec)) {
		$viewdocumentooficialcredito_grid->RowCnt++;
		if ($viewdocumentooficialcredito->CurrentAction == "gridadd" || $viewdocumentooficialcredito->CurrentAction == "gridedit" || $viewdocumentooficialcredito->CurrentAction == "F") {
			$viewdocumentooficialcredito_grid->RowIndex++;
			$objForm->Index = $viewdocumentooficialcredito_grid->RowIndex;
			if ($objForm->HasValue($viewdocumentooficialcredito_grid->FormActionName))
				$viewdocumentooficialcredito_grid->RowAction = strval($objForm->GetValue($viewdocumentooficialcredito_grid->FormActionName));
			elseif ($viewdocumentooficialcredito->CurrentAction == "gridadd")
				$viewdocumentooficialcredito_grid->RowAction = "insert";
			else
				$viewdocumentooficialcredito_grid->RowAction = "";
		}

		// Set up key count
		$viewdocumentooficialcredito_grid->KeyCount = $viewdocumentooficialcredito_grid->RowIndex;

		// Init row class and style
		$viewdocumentooficialcredito->ResetAttrs();
		$viewdocumentooficialcredito->CssClass = "";
		if ($viewdocumentooficialcredito->CurrentAction == "gridadd") {
			if ($viewdocumentooficialcredito->CurrentMode == "copy") {
				$viewdocumentooficialcredito_grid->LoadRowValues($viewdocumentooficialcredito_grid->Recordset); // Load row values
				$viewdocumentooficialcredito_grid->SetRecordKey($viewdocumentooficialcredito_grid->RowOldKey, $viewdocumentooficialcredito_grid->Recordset); // Set old record key
			} else {
				$viewdocumentooficialcredito_grid->LoadRowValues(); // Load default values
				$viewdocumentooficialcredito_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$viewdocumentooficialcredito_grid->LoadRowValues($viewdocumentooficialcredito_grid->Recordset); // Load row values
		}
		$viewdocumentooficialcredito->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($viewdocumentooficialcredito->CurrentAction == "gridadd") // Grid add
			$viewdocumentooficialcredito->RowType = EW_ROWTYPE_ADD; // Render add
		if ($viewdocumentooficialcredito->CurrentAction == "gridadd" && $viewdocumentooficialcredito->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$viewdocumentooficialcredito_grid->RestoreCurrentRowFormValues($viewdocumentooficialcredito_grid->RowIndex); // Restore form values
		if ($viewdocumentooficialcredito->CurrentAction == "gridedit") { // Grid edit
			if ($viewdocumentooficialcredito->EventCancelled) {
				$viewdocumentooficialcredito_grid->RestoreCurrentRowFormValues($viewdocumentooficialcredito_grid->RowIndex); // Restore form values
			}
			if ($viewdocumentooficialcredito_grid->RowAction == "insert")
				$viewdocumentooficialcredito->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$viewdocumentooficialcredito->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($viewdocumentooficialcredito->CurrentAction == "gridedit" && ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_EDIT || $viewdocumentooficialcredito->RowType == EW_ROWTYPE_ADD) && $viewdocumentooficialcredito->EventCancelled) // Update failed
			$viewdocumentooficialcredito_grid->RestoreCurrentRowFormValues($viewdocumentooficialcredito_grid->RowIndex); // Restore form values
		if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_EDIT) // Edit row
			$viewdocumentooficialcredito_grid->EditRowCnt++;
		if ($viewdocumentooficialcredito->CurrentAction == "F") // Confirm row
			$viewdocumentooficialcredito_grid->RestoreCurrentRowFormValues($viewdocumentooficialcredito_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$viewdocumentooficialcredito->RowAttrs = array_merge($viewdocumentooficialcredito->RowAttrs, array('data-rowindex'=>$viewdocumentooficialcredito_grid->RowCnt, 'id'=>'r' . $viewdocumentooficialcredito_grid->RowCnt . '_viewdocumentooficialcredito', 'data-rowtype'=>$viewdocumentooficialcredito->RowType));

		// Render row
		$viewdocumentooficialcredito_grid->RenderRow();

		// Render list options
		$viewdocumentooficialcredito_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($viewdocumentooficialcredito_grid->RowAction <> "delete" && $viewdocumentooficialcredito_grid->RowAction <> "insertdelete" && !($viewdocumentooficialcredito_grid->RowAction == "insert" && $viewdocumentooficialcredito->CurrentAction == "F" && $viewdocumentooficialcredito_grid->EmptyRow())) {
?>
	<tr<?php echo $viewdocumentooficialcredito->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewdocumentooficialcredito_grid->ListOptions->Render("body", "left", $viewdocumentooficialcredito_grid->RowCnt);
?>
	<?php if ($viewdocumentooficialcredito->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion"<?php echo $viewdocumentooficialcredito->descripcion->CellAttributes() ?>>
<?php if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_descripcion" class="form-group viewdocumentooficialcredito_descripcion">
<textarea data-table="viewdocumentooficialcredito" data-field="x_descripcion" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentooficialcredito->descripcion->EditAttributes() ?>><?php echo $viewdocumentooficialcredito->descripcion->EditValue ?></textarea>
</span>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_descripcion" name="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" id="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->descripcion->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_descripcion" class="form-group viewdocumentooficialcredito_descripcion">
<textarea data-table="viewdocumentooficialcredito" data-field="x_descripcion" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentooficialcredito->descripcion->EditAttributes() ?>><?php echo $viewdocumentooficialcredito->descripcion->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_descripcion" class="viewdocumentooficialcredito_descripcion">
<span<?php echo $viewdocumentooficialcredito->descripcion->ViewAttributes() ?>>
<?php echo $viewdocumentooficialcredito->descripcion->ListViewValue() ?></span>
</span>
<?php if ($viewdocumentooficialcredito->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_descripcion" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->descripcion->FormValue) ?>">
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_descripcion" name="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" id="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->descripcion->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_descripcion" name="fviewdocumentooficialcreditogrid$x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" id="fviewdocumentooficialcreditogrid$x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->descripcion->FormValue) ?>">
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_descripcion" name="fviewdocumentooficialcreditogrid$o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" id="fviewdocumentooficialcreditogrid$o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->descripcion->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->id->CurrentValue) ?>">
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id" name="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id" id="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->id->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_EDIT || $viewdocumentooficialcredito->CurrentMode == "edit") { ?>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($viewdocumentooficialcredito->imagen->Visible) { // imagen ?>
		<td data-name="imagen"<?php echo $viewdocumentooficialcredito->imagen->CellAttributes() ?>>
<?php if ($viewdocumentooficialcredito_grid->RowAction == "insert") { // Add record ?>
<span id="el$rowindex$_viewdocumentooficialcredito_imagen" class="form-group viewdocumentooficialcredito_imagen">
<div id="fd_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen">
<span title="<?php echo $viewdocumentooficialcredito->imagen->FldTitle() ? $viewdocumentooficialcredito->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentooficialcredito->imagen->ReadOnly || $viewdocumentooficialcredito->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentooficialcredito" data-field="x_imagen" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen"<?php echo $viewdocumentooficialcredito->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fs_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_imagen" name="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->imagen->OldValue) ?>">
<?php } elseif ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_imagen" class="viewdocumentooficialcredito_imagen">
<span<?php echo $viewdocumentooficialcredito->imagen->ViewAttributes() ?>>
<?php echo ew_GetFileViewTag($viewdocumentooficialcredito->imagen, $viewdocumentooficialcredito->imagen->ListViewValue()) ?>
</span>
</span>
<?php } else  { // Edit record ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_imagen" class="form-group viewdocumentooficialcredito_imagen">
<div id="fd_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen">
<span title="<?php echo $viewdocumentooficialcredito->imagen->FldTitle() ? $viewdocumentooficialcredito->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentooficialcredito->imagen->ReadOnly || $viewdocumentooficialcredito->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentooficialcredito" data-field="x_imagen" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen"<?php echo $viewdocumentooficialcredito->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->Upload->FileName ?>">
<?php if (@$_POST["fa_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen"] == "0") { ?>
<input type="hidden" name="fa_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="0">
<?php } else { ?>
<input type="hidden" name="fa_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="1">
<?php } ?>
<input type="hidden" name="fs_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewdocumentooficialcredito->avaluo->Visible) { // avaluo ?>
		<td data-name="avaluo"<?php echo $viewdocumentooficialcredito->avaluo->CellAttributes() ?>>
<?php if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($viewdocumentooficialcredito->avaluo->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_avaluo" class="form-group viewdocumentooficialcredito_avaluo">
<span<?php echo $viewdocumentooficialcredito->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentooficialcredito->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_avaluo" class="form-group viewdocumentooficialcredito_avaluo">
<select data-table="viewdocumentooficialcredito" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentooficialcredito->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo"<?php echo $viewdocumentooficialcredito->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentooficialcredito->avaluo->SelectOptionListHtml("x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_avaluo" name="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" id="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->avaluo->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<?php if ($viewdocumentooficialcredito->avaluo->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_avaluo" class="form-group viewdocumentooficialcredito_avaluo">
<span<?php echo $viewdocumentooficialcredito->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentooficialcredito->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_avaluo" class="form-group viewdocumentooficialcredito_avaluo">
<select data-table="viewdocumentooficialcredito" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentooficialcredito->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo"<?php echo $viewdocumentooficialcredito->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentooficialcredito->avaluo->SelectOptionListHtml("x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<?php } ?>
<?php if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_avaluo" class="viewdocumentooficialcredito_avaluo">
<span<?php echo $viewdocumentooficialcredito->avaluo->ViewAttributes() ?>>
<?php echo $viewdocumentooficialcredito->avaluo->ListViewValue() ?></span>
</span>
<?php if ($viewdocumentooficialcredito->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_avaluo" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->avaluo->FormValue) ?>">
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_avaluo" name="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" id="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->avaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_avaluo" name="fviewdocumentooficialcreditogrid$x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" id="fviewdocumentooficialcreditogrid$x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->avaluo->FormValue) ?>">
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_avaluo" name="fviewdocumentooficialcreditogrid$o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" id="fviewdocumentooficialcreditogrid$o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->avaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewdocumentooficialcredito->id_tipodocumento->Visible) { // id_tipodocumento ?>
		<td data-name="id_tipodocumento"<?php echo $viewdocumentooficialcredito->id_tipodocumento->CellAttributes() ?>>
<?php if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_id_tipodocumento" class="form-group viewdocumentooficialcredito_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($viewdocumentooficialcredito->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentooficialcredito->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentooficialcredito->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentooficialcredito->id_tipodocumento->ReadOnly || $viewdocumentooficialcredito->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentooficialcredito->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $viewdocumentooficialcredito->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentooficialcredito->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentooficialcredito->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id_tipodocumento" name="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->id_tipodocumento->OldValue) ?>">
<?php } ?>
<?php if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_id_tipodocumento" class="form-group viewdocumentooficialcredito_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($viewdocumentooficialcredito->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentooficialcredito->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentooficialcredito->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentooficialcredito->id_tipodocumento->ReadOnly || $viewdocumentooficialcredito->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentooficialcredito->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $viewdocumentooficialcredito->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentooficialcredito->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentooficialcredito->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } ?>
<?php if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewdocumentooficialcredito_grid->RowCnt ?>_viewdocumentooficialcredito_id_tipodocumento" class="viewdocumentooficialcredito_id_tipodocumento">
<span<?php echo $viewdocumentooficialcredito->id_tipodocumento->ViewAttributes() ?>>
<?php echo $viewdocumentooficialcredito->id_tipodocumento->ListViewValue() ?></span>
</span>
<?php if ($viewdocumentooficialcredito->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id_tipodocumento" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->id_tipodocumento->FormValue) ?>">
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id_tipodocumento" name="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->id_tipodocumento->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id_tipodocumento" name="fviewdocumentooficialcreditogrid$x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" id="fviewdocumentooficialcreditogrid$x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->id_tipodocumento->FormValue) ?>">
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id_tipodocumento" name="fviewdocumentooficialcreditogrid$o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" id="fviewdocumentooficialcreditogrid$o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->id_tipodocumento->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewdocumentooficialcredito_grid->ListOptions->Render("body", "right", $viewdocumentooficialcredito_grid->RowCnt);
?>
	</tr>
<?php if ($viewdocumentooficialcredito->RowType == EW_ROWTYPE_ADD || $viewdocumentooficialcredito->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fviewdocumentooficialcreditogrid.UpdateOpts(<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($viewdocumentooficialcredito->CurrentAction <> "gridadd" || $viewdocumentooficialcredito->CurrentMode == "copy")
		if (!$viewdocumentooficialcredito_grid->Recordset->EOF) $viewdocumentooficialcredito_grid->Recordset->MoveNext();
}
?>
<?php
	if ($viewdocumentooficialcredito->CurrentMode == "add" || $viewdocumentooficialcredito->CurrentMode == "copy" || $viewdocumentooficialcredito->CurrentMode == "edit") {
		$viewdocumentooficialcredito_grid->RowIndex = '$rowindex$';
		$viewdocumentooficialcredito_grid->LoadRowValues();

		// Set row properties
		$viewdocumentooficialcredito->ResetAttrs();
		$viewdocumentooficialcredito->RowAttrs = array_merge($viewdocumentooficialcredito->RowAttrs, array('data-rowindex'=>$viewdocumentooficialcredito_grid->RowIndex, 'id'=>'r0_viewdocumentooficialcredito', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($viewdocumentooficialcredito->RowAttrs["class"], "ewTemplate");
		$viewdocumentooficialcredito->RowType = EW_ROWTYPE_ADD;

		// Render row
		$viewdocumentooficialcredito_grid->RenderRow();

		// Render list options
		$viewdocumentooficialcredito_grid->RenderListOptions();
		$viewdocumentooficialcredito_grid->StartRowCnt = 0;
?>
	<tr<?php echo $viewdocumentooficialcredito->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewdocumentooficialcredito_grid->ListOptions->Render("body", "left", $viewdocumentooficialcredito_grid->RowIndex);
?>
	<?php if ($viewdocumentooficialcredito->descripcion->Visible) { // descripcion ?>
		<td data-name="descripcion">
<?php if ($viewdocumentooficialcredito->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewdocumentooficialcredito_descripcion" class="form-group viewdocumentooficialcredito_descripcion">
<textarea data-table="viewdocumentooficialcredito" data-field="x_descripcion" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->descripcion->getPlaceHolder()) ?>"<?php echo $viewdocumentooficialcredito->descripcion->EditAttributes() ?>><?php echo $viewdocumentooficialcredito->descripcion->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewdocumentooficialcredito_descripcion" class="form-group viewdocumentooficialcredito_descripcion">
<span<?php echo $viewdocumentooficialcredito->descripcion->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentooficialcredito->descripcion->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_descripcion" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->descripcion->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_descripcion" name="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" id="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_descripcion" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->descripcion->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewdocumentooficialcredito->imagen->Visible) { // imagen ?>
		<td data-name="imagen">
<span id="el$rowindex$_viewdocumentooficialcredito_imagen" class="form-group viewdocumentooficialcredito_imagen">
<div id="fd_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen">
<span title="<?php echo $viewdocumentooficialcredito->imagen->FldTitle() ? $viewdocumentooficialcredito->imagen->FldTitle() : $Language->Phrase("ChooseFile") ?>" class="btn btn-default btn-sm fileinput-button ewTooltip<?php if ($viewdocumentooficialcredito->imagen->ReadOnly || $viewdocumentooficialcredito->imagen->Disabled) echo " hide"; ?>">
	<span><?php echo $Language->Phrase("ChooseFileBtn") ?></span>
	<input type="file" title=" " data-table="viewdocumentooficialcredito" data-field="x_imagen" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen"<?php echo $viewdocumentooficialcredito->imagen->EditAttributes() ?>>
</span>
<input type="hidden" name="fn_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fn_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->Upload->FileName ?>">
<input type="hidden" name="fa_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fa_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fs_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fs_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="0">
<input type="hidden" name="fx_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fx_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->UploadAllowedFileExt ?>">
<input type="hidden" name="fm_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id= "fm_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="<?php echo $viewdocumentooficialcredito->imagen->UploadMaxFileSize ?>">
</div>
<table id="ft_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" class="table table-condensed pull-left ewUploadTable"><tbody class="files"></tbody></table>
</span>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_imagen" name="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" id="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_imagen" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->imagen->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewdocumentooficialcredito->avaluo->Visible) { // avaluo ?>
		<td data-name="avaluo">
<?php if ($viewdocumentooficialcredito->CurrentAction <> "F") { ?>
<?php if ($viewdocumentooficialcredito->avaluo->getSessionValue() <> "") { ?>
<span id="el$rowindex$_viewdocumentooficialcredito_avaluo" class="form-group viewdocumentooficialcredito_avaluo">
<span<?php echo $viewdocumentooficialcredito->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentooficialcredito->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->avaluo->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_viewdocumentooficialcredito_avaluo" class="form-group viewdocumentooficialcredito_avaluo">
<select data-table="viewdocumentooficialcredito" data-field="x_avaluo" data-value-separator="<?php echo $viewdocumentooficialcredito->avaluo->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo"<?php echo $viewdocumentooficialcredito->avaluo->EditAttributes() ?>>
<?php echo $viewdocumentooficialcredito->avaluo->SelectOptionListHtml("x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_viewdocumentooficialcredito_avaluo" class="form-group viewdocumentooficialcredito_avaluo">
<span<?php echo $viewdocumentooficialcredito->avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentooficialcredito->avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_avaluo" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->avaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_avaluo" name="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" id="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_avaluo" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->avaluo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewdocumentooficialcredito->id_tipodocumento->Visible) { // id_tipodocumento ?>
		<td data-name="id_tipodocumento">
<?php if ($viewdocumentooficialcredito->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewdocumentooficialcredito_id_tipodocumento" class="form-group viewdocumentooficialcredito_id_tipodocumento">
<span class="ewLookupList">
	<span onclick="jQuery(this).parent().next().click();" tabindex="-1" class="form-control ewLookupText" id="lu_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento"><?php echo (strval($viewdocumentooficialcredito->id_tipodocumento->ViewValue) == "" ? $Language->Phrase("PleaseSelect") : $viewdocumentooficialcredito->id_tipodocumento->ViewValue); ?></span>
</span>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewdocumentooficialcredito->id_tipodocumento->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento',m:0,n:10});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewdocumentooficialcredito->id_tipodocumento->ReadOnly || $viewdocumentooficialcredito->id_tipodocumento->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id_tipodocumento" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewdocumentooficialcredito->id_tipodocumento->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" value="<?php echo $viewdocumentooficialcredito->id_tipodocumento->CurrentValue ?>"<?php echo $viewdocumentooficialcredito->id_tipodocumento->EditAttributes() ?>>
<?php if (AllowAdd(CurrentProjectID() . "tipodocumento") && !$viewdocumentooficialcredito->id_tipodocumento->ReadOnly) { ?>
<button type="button" title="<?php echo ew_HtmlTitle($Language->Phrase("AddLink")) . "&nbsp;" . $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?>" onclick="ew_AddOptDialogShow({lnk:this,el:'x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento',url:'tipodocumentoaddopt.php'});" class="ewAddOptBtn btn btn-default btn-sm" id="aol_x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento"><span class="glyphicon glyphicon-plus ewIcon"></span><span class="hide"><?php echo $Language->Phrase("AddLink") ?>&nbsp;<?php echo $viewdocumentooficialcredito->id_tipodocumento->FldCaption() ?></span></button>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewdocumentooficialcredito_id_tipodocumento" class="form-group viewdocumentooficialcredito_id_tipodocumento">
<span<?php echo $viewdocumentooficialcredito->id_tipodocumento->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewdocumentooficialcredito->id_tipodocumento->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id_tipodocumento" name="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" id="x<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->id_tipodocumento->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewdocumentooficialcredito" data-field="x_id_tipodocumento" name="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" id="o<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>_id_tipodocumento" value="<?php echo ew_HtmlEncode($viewdocumentooficialcredito->id_tipodocumento->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewdocumentooficialcredito_grid->ListOptions->Render("body", "right", $viewdocumentooficialcredito_grid->RowCnt);
?>
<script type="text/javascript">
fviewdocumentooficialcreditogrid.UpdateOpts(<?php echo $viewdocumentooficialcredito_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($viewdocumentooficialcredito->CurrentMode == "add" || $viewdocumentooficialcredito->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $viewdocumentooficialcredito_grid->FormKeyCountName ?>" id="<?php echo $viewdocumentooficialcredito_grid->FormKeyCountName ?>" value="<?php echo $viewdocumentooficialcredito_grid->KeyCount ?>">
<?php echo $viewdocumentooficialcredito_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewdocumentooficialcredito->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $viewdocumentooficialcredito_grid->FormKeyCountName ?>" id="<?php echo $viewdocumentooficialcredito_grid->FormKeyCountName ?>" value="<?php echo $viewdocumentooficialcredito_grid->KeyCount ?>">
<?php echo $viewdocumentooficialcredito_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewdocumentooficialcredito->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fviewdocumentooficialcreditogrid">
</div>
<?php

// Close recordset
if ($viewdocumentooficialcredito_grid->Recordset)
	$viewdocumentooficialcredito_grid->Recordset->Close();
?>
<?php if ($viewdocumentooficialcredito_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($viewdocumentooficialcredito_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($viewdocumentooficialcredito_grid->TotalRecs == 0 && $viewdocumentooficialcredito->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewdocumentooficialcredito_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($viewdocumentooficialcredito->Export == "") { ?>
<script type="text/javascript">
fviewdocumentooficialcreditogrid.Init();
</script>
<?php } ?>
<?php
$viewdocumentooficialcredito_grid->Page_Terminate();
?>
