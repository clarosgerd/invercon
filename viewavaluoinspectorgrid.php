<?php include_once "usuarioinfo.php" ?>
<?php ew_Header(FALSE) ?>
<?php

// Create page object
if (!isset($viewavaluoinspector_grid)) $viewavaluoinspector_grid = new cviewavaluoinspector_grid();

// Page init
$viewavaluoinspector_grid->Page_Init();

// Page main
$viewavaluoinspector_grid->Page_Main();

// Global Page Rendering event (in userfn*.php)
Page_Rendering();

// Page Rendering event
$viewavaluoinspector_grid->Page_Render();
?>
<?php if ($viewavaluoinspector->Export == "") { ?>
<script type="text/javascript">

// Form object
var fviewavaluoinspectorgrid = new ew_Form("fviewavaluoinspectorgrid", "grid");
fviewavaluoinspectorgrid.FormKeyCountName = '<?php echo $viewavaluoinspector_grid->FormKeyCountName ?>';

// Validate form
fviewavaluoinspectorgrid.Validate = function() {
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
			elm = this.GetElements("x" + infix + "_fecha_avaluo");
			if (elm && !ew_IsHidden(elm) && !ew_HasValue(elm))
				return this.OnError(elm, "<?php echo ew_JsEncode2(str_replace("%s", $viewavaluoinspector->fecha_avaluo->FldCaption(), $viewavaluoinspector->fecha_avaluo->ReqErrMsg)) ?>");

			// Fire Form_CustomValidate event
			if (!this.Form_CustomValidate(fobj))
				return false;
		} // End Grid Add checking
	}
	return true;
}

// Check empty row
fviewavaluoinspectorgrid.EmptyRow = function(infix) {
	var fobj = this.Form;
	if (ew_ValueChanged(fobj, infix, "id_solicitud", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_oficialcredito", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_inspector", false)) return false;
	if (ew_ValueChanged(fobj, infix, "id_cliente", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estado", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estadointerno", false)) return false;
	if (ew_ValueChanged(fobj, infix, "estadopago", false)) return false;
	if (ew_ValueChanged(fobj, infix, "fecha_avaluo", false)) return false;
	if (ew_ValueChanged(fobj, infix, "comentario", false)) return false;
	return true;
}

// Form_CustomValidate event
fviewavaluoinspectorgrid.Form_CustomValidate = 
 function(fobj) { // DO NOT CHANGE THIS LINE!

 	// Your custom validation code here, return false if invalid.
 	return true;
 }

// Use JavaScript validation or not
fviewavaluoinspectorgrid.ValidateRequired = <?php echo json_encode(EW_CLIENT_VALIDATE) ?>;

// Dynamic selection lists
fviewavaluoinspectorgrid.Lists["x_id_solicitud"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_id","x_name","x_lastname","x__email"],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"solicitud"};
fviewavaluoinspectorgrid.Lists["x_id_solicitud"].Data = "<?php echo $viewavaluoinspector_grid->id_solicitud->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluoinspectorgrid.Lists["x_id_oficialcredito"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_nombre","x_apellido","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"oficialcredito"};
fviewavaluoinspectorgrid.Lists["x_id_oficialcredito"].Data = "<?php echo $viewavaluoinspector_grid->id_oficialcredito->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluoinspectorgrid.AutoSuggests["x_id_oficialcredito"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluoinspector_grid->id_oficialcredito->LookupFilterQuery(TRUE, "grid"))) ?>;
fviewavaluoinspectorgrid.Lists["x_id_inspector"] = {"LinkField":"x__login","Ajax":true,"AutoFill":false,"DisplayFields":["x_apellido","x_nombre","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"inspector"};
fviewavaluoinspectorgrid.Lists["x_id_inspector"].Data = "<?php echo $viewavaluoinspector_grid->id_inspector->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluoinspectorgrid.AutoSuggests["x_id_inspector"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluoinspector_grid->id_inspector->LookupFilterQuery(TRUE, "grid"))) ?>;
fviewavaluoinspectorgrid.Lists["x_id_cliente"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_name","x_lastname","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"cliente"};
fviewavaluoinspectorgrid.Lists["x_id_cliente"].Data = "<?php echo $viewavaluoinspector_grid->id_cliente->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluoinspectorgrid.AutoSuggests["x_id_cliente"] = <?php echo json_encode(array("data" => "ajax=autosuggest&" . $viewavaluoinspector_grid->id_cliente->LookupFilterQuery(TRUE, "grid"))) ?>;
fviewavaluoinspectorgrid.Lists["x_estado"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estado"};
fviewavaluoinspectorgrid.Lists["x_estado"].Data = "<?php echo $viewavaluoinspector_grid->estado->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluoinspectorgrid.Lists["x_estadointerno"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadointerno"};
fviewavaluoinspectorgrid.Lists["x_estadointerno"].Data = "<?php echo $viewavaluoinspector_grid->estadointerno->LookupFilterQuery(FALSE, "grid") ?>";
fviewavaluoinspectorgrid.Lists["x_estadopago"] = {"LinkField":"x_id","Ajax":true,"AutoFill":false,"DisplayFields":["x_descripcion","","",""],"ParentFields":[],"ChildFields":[],"FilterFields":[],"Options":[],"Template":"","LinkTable":"estadopago"};
fviewavaluoinspectorgrid.Lists["x_estadopago"].Data = "<?php echo $viewavaluoinspector_grid->estadopago->LookupFilterQuery(FALSE, "grid") ?>";

// Form object for search
</script>
<?php } ?>
<?php
if ($viewavaluoinspector->CurrentAction == "gridadd") {
	if ($viewavaluoinspector->CurrentMode == "copy") {
		$bSelectLimit = $viewavaluoinspector_grid->UseSelectLimit;
		if ($bSelectLimit) {
			$viewavaluoinspector_grid->TotalRecs = $viewavaluoinspector->ListRecordCount();
			$viewavaluoinspector_grid->Recordset = $viewavaluoinspector_grid->LoadRecordset($viewavaluoinspector_grid->StartRec-1, $viewavaluoinspector_grid->DisplayRecs);
		} else {
			if ($viewavaluoinspector_grid->Recordset = $viewavaluoinspector_grid->LoadRecordset())
				$viewavaluoinspector_grid->TotalRecs = $viewavaluoinspector_grid->Recordset->RecordCount();
		}
		$viewavaluoinspector_grid->StartRec = 1;
		$viewavaluoinspector_grid->DisplayRecs = $viewavaluoinspector_grid->TotalRecs;
	} else {
		$viewavaluoinspector->CurrentFilter = "0=1";
		$viewavaluoinspector_grid->StartRec = 1;
		$viewavaluoinspector_grid->DisplayRecs = $viewavaluoinspector->GridAddRowCount;
	}
	$viewavaluoinspector_grid->TotalRecs = $viewavaluoinspector_grid->DisplayRecs;
	$viewavaluoinspector_grid->StopRec = $viewavaluoinspector_grid->DisplayRecs;
} else {
	$bSelectLimit = $viewavaluoinspector_grid->UseSelectLimit;
	if ($bSelectLimit) {
		if ($viewavaluoinspector_grid->TotalRecs <= 0)
			$viewavaluoinspector_grid->TotalRecs = $viewavaluoinspector->ListRecordCount();
	} else {
		if (!$viewavaluoinspector_grid->Recordset && ($viewavaluoinspector_grid->Recordset = $viewavaluoinspector_grid->LoadRecordset()))
			$viewavaluoinspector_grid->TotalRecs = $viewavaluoinspector_grid->Recordset->RecordCount();
	}
	$viewavaluoinspector_grid->StartRec = 1;
	$viewavaluoinspector_grid->DisplayRecs = $viewavaluoinspector_grid->TotalRecs; // Display all records
	if ($bSelectLimit)
		$viewavaluoinspector_grid->Recordset = $viewavaluoinspector_grid->LoadRecordset($viewavaluoinspector_grid->StartRec-1, $viewavaluoinspector_grid->DisplayRecs);

	// Set no record found message
	if ($viewavaluoinspector->CurrentAction == "" && $viewavaluoinspector_grid->TotalRecs == 0) {
		if (!$Security->CanList())
			$viewavaluoinspector_grid->setWarningMessage(ew_DeniedMsg());
		if ($viewavaluoinspector_grid->SearchWhere == "0=101")
			$viewavaluoinspector_grid->setWarningMessage($Language->Phrase("EnterSearchCriteria"));
		else
			$viewavaluoinspector_grid->setWarningMessage($Language->Phrase("NoRecord"));
	}
}
$viewavaluoinspector_grid->RenderOtherOptions();
?>
<?php $viewavaluoinspector_grid->ShowPageHeader(); ?>
<?php
$viewavaluoinspector_grid->ShowMessage();
?>
<?php if ($viewavaluoinspector_grid->TotalRecs > 0 || $viewavaluoinspector->CurrentAction <> "") { ?>
<div class="box ewBox ewGrid<?php if ($viewavaluoinspector_grid->IsAddOrEdit()) { ?> ewGridAddEdit<?php } ?> viewavaluoinspector">
<div id="fviewavaluoinspectorgrid" class="ewForm ewListForm form-inline">
<div id="gmp_viewavaluoinspector" class="<?php if (ew_IsResponsiveLayout()) { ?>table-responsive <?php } ?>ewGridMiddlePanel">
<table id="tbl_viewavaluoinspectorgrid" class="table ewTable">
<thead>
	<tr class="ewTableHeader">
<?php

// Header row
$viewavaluoinspector_grid->RowType = EW_ROWTYPE_HEADER;

// Render list options
$viewavaluoinspector_grid->RenderListOptions();

// Render list options (header, left)
$viewavaluoinspector_grid->ListOptions->Render("header", "left");
?>
<?php if ($viewavaluoinspector->id_solicitud->Visible) { // id_solicitud ?>
	<?php if ($viewavaluoinspector->SortUrl($viewavaluoinspector->id_solicitud) == "") { ?>
		<th data-name="id_solicitud" class="<?php echo $viewavaluoinspector->id_solicitud->HeaderCellClass() ?>"><div id="elh_viewavaluoinspector_id_solicitud" class="viewavaluoinspector_id_solicitud"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->id_solicitud->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_solicitud" class="<?php echo $viewavaluoinspector->id_solicitud->HeaderCellClass() ?>"><div><div id="elh_viewavaluoinspector_id_solicitud" class="viewavaluoinspector_id_solicitud">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->id_solicitud->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspector->id_solicitud->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspector->id_solicitud->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspector->id_oficialcredito->Visible) { // id_oficialcredito ?>
	<?php if ($viewavaluoinspector->SortUrl($viewavaluoinspector->id_oficialcredito) == "") { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluoinspector->id_oficialcredito->HeaderCellClass() ?>"><div id="elh_viewavaluoinspector_id_oficialcredito" class="viewavaluoinspector_id_oficialcredito"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->id_oficialcredito->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_oficialcredito" class="<?php echo $viewavaluoinspector->id_oficialcredito->HeaderCellClass() ?>"><div><div id="elh_viewavaluoinspector_id_oficialcredito" class="viewavaluoinspector_id_oficialcredito">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->id_oficialcredito->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspector->id_oficialcredito->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspector->id_oficialcredito->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspector->id_inspector->Visible) { // id_inspector ?>
	<?php if ($viewavaluoinspector->SortUrl($viewavaluoinspector->id_inspector) == "") { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluoinspector->id_inspector->HeaderCellClass() ?>"><div id="elh_viewavaluoinspector_id_inspector" class="viewavaluoinspector_id_inspector"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->id_inspector->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_inspector" class="<?php echo $viewavaluoinspector->id_inspector->HeaderCellClass() ?>"><div><div id="elh_viewavaluoinspector_id_inspector" class="viewavaluoinspector_id_inspector">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->id_inspector->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspector->id_inspector->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspector->id_inspector->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspector->id_cliente->Visible) { // id_cliente ?>
	<?php if ($viewavaluoinspector->SortUrl($viewavaluoinspector->id_cliente) == "") { ?>
		<th data-name="id_cliente" class="<?php echo $viewavaluoinspector->id_cliente->HeaderCellClass() ?>"><div id="elh_viewavaluoinspector_id_cliente" class="viewavaluoinspector_id_cliente"><div class="ewTableHeaderCaption" style="white-space: nowrap;"><?php echo $viewavaluoinspector->id_cliente->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="id_cliente" class="<?php echo $viewavaluoinspector->id_cliente->HeaderCellClass() ?>"><div><div id="elh_viewavaluoinspector_id_cliente" class="viewavaluoinspector_id_cliente">
			<div class="ewTableHeaderBtn" style="white-space: nowrap;"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->id_cliente->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspector->id_cliente->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspector->id_cliente->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspector->estado->Visible) { // estado ?>
	<?php if ($viewavaluoinspector->SortUrl($viewavaluoinspector->estado) == "") { ?>
		<th data-name="estado" class="<?php echo $viewavaluoinspector->estado->HeaderCellClass() ?>"><div id="elh_viewavaluoinspector_estado" class="viewavaluoinspector_estado"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->estado->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estado" class="<?php echo $viewavaluoinspector->estado->HeaderCellClass() ?>"><div><div id="elh_viewavaluoinspector_estado" class="viewavaluoinspector_estado">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->estado->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspector->estado->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspector->estado->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspector->estadointerno->Visible) { // estadointerno ?>
	<?php if ($viewavaluoinspector->SortUrl($viewavaluoinspector->estadointerno) == "") { ?>
		<th data-name="estadointerno" class="<?php echo $viewavaluoinspector->estadointerno->HeaderCellClass() ?>"><div id="elh_viewavaluoinspector_estadointerno" class="viewavaluoinspector_estadointerno"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->estadointerno->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadointerno" class="<?php echo $viewavaluoinspector->estadointerno->HeaderCellClass() ?>"><div><div id="elh_viewavaluoinspector_estadointerno" class="viewavaluoinspector_estadointerno">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->estadointerno->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspector->estadointerno->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspector->estadointerno->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspector->estadopago->Visible) { // estadopago ?>
	<?php if ($viewavaluoinspector->SortUrl($viewavaluoinspector->estadopago) == "") { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluoinspector->estadopago->HeaderCellClass() ?>"><div id="elh_viewavaluoinspector_estadopago" class="viewavaluoinspector_estadopago"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->estadopago->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="estadopago" class="<?php echo $viewavaluoinspector->estadopago->HeaderCellClass() ?>"><div><div id="elh_viewavaluoinspector_estadopago" class="viewavaluoinspector_estadopago">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->estadopago->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspector->estadopago->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspector->estadopago->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspector->fecha_avaluo->Visible) { // fecha_avaluo ?>
	<?php if ($viewavaluoinspector->SortUrl($viewavaluoinspector->fecha_avaluo) == "") { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluoinspector->fecha_avaluo->HeaderCellClass() ?>"><div id="elh_viewavaluoinspector_fecha_avaluo" class="viewavaluoinspector_fecha_avaluo"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->fecha_avaluo->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="fecha_avaluo" class="<?php echo $viewavaluoinspector->fecha_avaluo->HeaderCellClass() ?>"><div><div id="elh_viewavaluoinspector_fecha_avaluo" class="viewavaluoinspector_fecha_avaluo">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->fecha_avaluo->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspector->fecha_avaluo->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspector->fecha_avaluo->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php if ($viewavaluoinspector->comentario->Visible) { // comentario ?>
	<?php if ($viewavaluoinspector->SortUrl($viewavaluoinspector->comentario) == "") { ?>
		<th data-name="comentario" class="<?php echo $viewavaluoinspector->comentario->HeaderCellClass() ?>"><div id="elh_viewavaluoinspector_comentario" class="viewavaluoinspector_comentario"><div class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->comentario->FldCaption() ?></div></div></th>
	<?php } else { ?>
		<th data-name="comentario" class="<?php echo $viewavaluoinspector->comentario->HeaderCellClass() ?>"><div><div id="elh_viewavaluoinspector_comentario" class="viewavaluoinspector_comentario">
			<div class="ewTableHeaderBtn"><span class="ewTableHeaderCaption"><?php echo $viewavaluoinspector->comentario->FldCaption() ?></span><span class="ewTableHeaderSort"><?php if ($viewavaluoinspector->comentario->getSort() == "ASC") { ?><span class="caret ewSortUp"></span><?php } elseif ($viewavaluoinspector->comentario->getSort() == "DESC") { ?><span class="caret"></span><?php } ?></span></div>
		</div></div></th>
	<?php } ?>
<?php } ?>
<?php

// Render list options (header, right)
$viewavaluoinspector_grid->ListOptions->Render("header", "right");
?>
	</tr>
</thead>
<tbody>
<?php
$viewavaluoinspector_grid->StartRec = 1;
$viewavaluoinspector_grid->StopRec = $viewavaluoinspector_grid->TotalRecs; // Show all records

// Restore number of post back records
if ($objForm) {
	$objForm->Index = -1;
	if ($objForm->HasValue($viewavaluoinspector_grid->FormKeyCountName) && ($viewavaluoinspector->CurrentAction == "gridadd" || $viewavaluoinspector->CurrentAction == "gridedit" || $viewavaluoinspector->CurrentAction == "F")) {
		$viewavaluoinspector_grid->KeyCount = $objForm->GetValue($viewavaluoinspector_grid->FormKeyCountName);
		$viewavaluoinspector_grid->StopRec = $viewavaluoinspector_grid->StartRec + $viewavaluoinspector_grid->KeyCount - 1;
	}
}
$viewavaluoinspector_grid->RecCnt = $viewavaluoinspector_grid->StartRec - 1;
if ($viewavaluoinspector_grid->Recordset && !$viewavaluoinspector_grid->Recordset->EOF) {
	$viewavaluoinspector_grid->Recordset->MoveFirst();
	$bSelectLimit = $viewavaluoinspector_grid->UseSelectLimit;
	if (!$bSelectLimit && $viewavaluoinspector_grid->StartRec > 1)
		$viewavaluoinspector_grid->Recordset->Move($viewavaluoinspector_grid->StartRec - 1);
} elseif (!$viewavaluoinspector->AllowAddDeleteRow && $viewavaluoinspector_grid->StopRec == 0) {
	$viewavaluoinspector_grid->StopRec = $viewavaluoinspector->GridAddRowCount;
}

// Initialize aggregate
$viewavaluoinspector->RowType = EW_ROWTYPE_AGGREGATEINIT;
$viewavaluoinspector->ResetAttrs();
$viewavaluoinspector_grid->RenderRow();
if ($viewavaluoinspector->CurrentAction == "gridadd")
	$viewavaluoinspector_grid->RowIndex = 0;
if ($viewavaluoinspector->CurrentAction == "gridedit")
	$viewavaluoinspector_grid->RowIndex = 0;
while ($viewavaluoinspector_grid->RecCnt < $viewavaluoinspector_grid->StopRec) {
	$viewavaluoinspector_grid->RecCnt++;
	if (intval($viewavaluoinspector_grid->RecCnt) >= intval($viewavaluoinspector_grid->StartRec)) {
		$viewavaluoinspector_grid->RowCnt++;
		if ($viewavaluoinspector->CurrentAction == "gridadd" || $viewavaluoinspector->CurrentAction == "gridedit" || $viewavaluoinspector->CurrentAction == "F") {
			$viewavaluoinspector_grid->RowIndex++;
			$objForm->Index = $viewavaluoinspector_grid->RowIndex;
			if ($objForm->HasValue($viewavaluoinspector_grid->FormActionName))
				$viewavaluoinspector_grid->RowAction = strval($objForm->GetValue($viewavaluoinspector_grid->FormActionName));
			elseif ($viewavaluoinspector->CurrentAction == "gridadd")
				$viewavaluoinspector_grid->RowAction = "insert";
			else
				$viewavaluoinspector_grid->RowAction = "";
		}

		// Set up key count
		$viewavaluoinspector_grid->KeyCount = $viewavaluoinspector_grid->RowIndex;

		// Init row class and style
		$viewavaluoinspector->ResetAttrs();
		$viewavaluoinspector->CssClass = "";
		if ($viewavaluoinspector->CurrentAction == "gridadd") {
			if ($viewavaluoinspector->CurrentMode == "copy") {
				$viewavaluoinspector_grid->LoadRowValues($viewavaluoinspector_grid->Recordset); // Load row values
				$viewavaluoinspector_grid->SetRecordKey($viewavaluoinspector_grid->RowOldKey, $viewavaluoinspector_grid->Recordset); // Set old record key
			} else {
				$viewavaluoinspector_grid->LoadRowValues(); // Load default values
				$viewavaluoinspector_grid->RowOldKey = ""; // Clear old key value
			}
		} else {
			$viewavaluoinspector_grid->LoadRowValues($viewavaluoinspector_grid->Recordset); // Load row values
		}
		$viewavaluoinspector->RowType = EW_ROWTYPE_VIEW; // Render view
		if ($viewavaluoinspector->CurrentAction == "gridadd") // Grid add
			$viewavaluoinspector->RowType = EW_ROWTYPE_ADD; // Render add
		if ($viewavaluoinspector->CurrentAction == "gridadd" && $viewavaluoinspector->EventCancelled && !$objForm->HasValue("k_blankrow")) // Insert failed
			$viewavaluoinspector_grid->RestoreCurrentRowFormValues($viewavaluoinspector_grid->RowIndex); // Restore form values
		if ($viewavaluoinspector->CurrentAction == "gridedit") { // Grid edit
			if ($viewavaluoinspector->EventCancelled) {
				$viewavaluoinspector_grid->RestoreCurrentRowFormValues($viewavaluoinspector_grid->RowIndex); // Restore form values
			}
			if ($viewavaluoinspector_grid->RowAction == "insert")
				$viewavaluoinspector->RowType = EW_ROWTYPE_ADD; // Render add
			else
				$viewavaluoinspector->RowType = EW_ROWTYPE_EDIT; // Render edit
		}
		if ($viewavaluoinspector->CurrentAction == "gridedit" && ($viewavaluoinspector->RowType == EW_ROWTYPE_EDIT || $viewavaluoinspector->RowType == EW_ROWTYPE_ADD) && $viewavaluoinspector->EventCancelled) // Update failed
			$viewavaluoinspector_grid->RestoreCurrentRowFormValues($viewavaluoinspector_grid->RowIndex); // Restore form values
		if ($viewavaluoinspector->RowType == EW_ROWTYPE_EDIT) // Edit row
			$viewavaluoinspector_grid->EditRowCnt++;
		if ($viewavaluoinspector->CurrentAction == "F") // Confirm row
			$viewavaluoinspector_grid->RestoreCurrentRowFormValues($viewavaluoinspector_grid->RowIndex); // Restore form values

		// Set up row id / data-rowindex
		$viewavaluoinspector->RowAttrs = array_merge($viewavaluoinspector->RowAttrs, array('data-rowindex'=>$viewavaluoinspector_grid->RowCnt, 'id'=>'r' . $viewavaluoinspector_grid->RowCnt . '_viewavaluoinspector', 'data-rowtype'=>$viewavaluoinspector->RowType));

		// Render row
		$viewavaluoinspector_grid->RenderRow();

		// Render list options
		$viewavaluoinspector_grid->RenderListOptions();

		// Skip delete row / empty row for confirm page
		if ($viewavaluoinspector_grid->RowAction <> "delete" && $viewavaluoinspector_grid->RowAction <> "insertdelete" && !($viewavaluoinspector_grid->RowAction == "insert" && $viewavaluoinspector->CurrentAction == "F" && $viewavaluoinspector_grid->EmptyRow())) {
?>
	<tr<?php echo $viewavaluoinspector->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewavaluoinspector_grid->ListOptions->Render("body", "left", $viewavaluoinspector_grid->RowCnt);
?>
	<?php if ($viewavaluoinspector->id_solicitud->Visible) { // id_solicitud ?>
		<td data-name="id_solicitud"<?php echo $viewavaluoinspector->id_solicitud->CellAttributes() ?>>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<?php if ($viewavaluoinspector->id_solicitud->getSessionValue() <> "") { ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_solicitud" class="form-group viewavaluoinspector_id_solicitud">
<span<?php echo $viewavaluoinspector->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_solicitud" class="form-group viewavaluoinspector_id_solicitud">
<select data-table="viewavaluoinspector" data-field="x_id_solicitud" data-value-separator="<?php echo $viewavaluoinspector->id_solicitud->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud"<?php echo $viewavaluoinspector->id_solicitud->EditAttributes() ?>>
<?php echo $viewavaluoinspector->id_solicitud->SelectOptionListHtml("x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud") ?>
</select>
</span>
<?php } ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_solicitud" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_solicitud->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_solicitud" class="form-group viewavaluoinspector_id_solicitud">
<span<?php echo $viewavaluoinspector->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->id_solicitud->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_solicitud" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_solicitud->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_solicitud" class="viewavaluoinspector_id_solicitud">
<span<?php echo $viewavaluoinspector->id_solicitud->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->id_solicitud->ListViewValue() ?></span>
</span>
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_solicitud" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_solicitud->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_solicitud" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_solicitud->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_solicitud" name="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" id="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_solicitud->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_solicitud" name="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" id="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_solicitud->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id->CurrentValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_EDIT || $viewavaluoinspector->CurrentMode == "edit") { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id->CurrentValue) ?>">
<?php } ?>
	<?php if ($viewavaluoinspector->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<td data-name="id_oficialcredito"<?php echo $viewavaluoinspector->id_oficialcredito->CellAttributes() ?>>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_oficialcredito" class="form-group viewavaluoinspector_id_oficialcredito">
<?php
$wrkonchange = trim(" " . @$viewavaluoinspector->id_oficialcredito->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$viewavaluoinspector->id_oficialcredito->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" style="white-space: nowrap; z-index: <?php echo (9000 - $viewavaluoinspector_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" id="sv_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" value="<?php echo $viewavaluoinspector->id_oficialcredito->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->getPlaceHolder()) ?>"<?php echo $viewavaluoinspector->id_oficialcredito->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_oficialcredito" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluoinspector->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fviewavaluoinspectorgrid.CreateAutoSuggest({"id":"x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito","forceSelect":false});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluoinspector->id_oficialcredito->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito',m:0,n:10,srch:true});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluoinspector->id_oficialcredito->ReadOnly || $viewavaluoinspector->id_oficialcredito->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_oficialcredito" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_oficialcredito" class="form-group viewavaluoinspector_id_oficialcredito">
<span<?php echo $viewavaluoinspector->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->id_oficialcredito->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_oficialcredito" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_oficialcredito" class="viewavaluoinspector_id_oficialcredito">
<span<?php echo $viewavaluoinspector->id_oficialcredito->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->id_oficialcredito->ListViewValue() ?></span>
</span>
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_oficialcredito" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_oficialcredito" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_oficialcredito" name="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" id="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_oficialcredito" name="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" id="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->id_inspector->Visible) { // id_inspector ?>
		<td data-name="id_inspector"<?php echo $viewavaluoinspector->id_inspector->CellAttributes() ?>>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_inspector" class="form-group viewavaluoinspector_id_inspector">
<?php
$wrkonchange = trim(" " . @$viewavaluoinspector->id_inspector->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$viewavaluoinspector->id_inspector->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" style="white-space: nowrap; z-index: <?php echo (9000 - $viewavaluoinspector_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" id="sv_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" value="<?php echo $viewavaluoinspector->id_inspector->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->getPlaceHolder()) ?>"<?php echo $viewavaluoinspector->id_inspector->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_inspector" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluoinspector->id_inspector->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fviewavaluoinspectorgrid.CreateAutoSuggest({"id":"x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector","forceSelect":false});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluoinspector->id_inspector->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector',m:0,n:10,srch:true});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluoinspector->id_inspector->ReadOnly || $viewavaluoinspector->id_inspector->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_inspector" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_inspector" class="form-group viewavaluoinspector_id_inspector">
<span<?php echo $viewavaluoinspector->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->id_inspector->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_inspector" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_inspector" class="viewavaluoinspector_id_inspector">
<span<?php echo $viewavaluoinspector->id_inspector->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->id_inspector->ListViewValue() ?></span>
</span>
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_inspector" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_inspector" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_inspector" name="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" id="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_inspector" name="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" id="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->id_cliente->Visible) { // id_cliente ?>
		<td data-name="id_cliente"<?php echo $viewavaluoinspector->id_cliente->CellAttributes() ?>>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_cliente" class="form-group viewavaluoinspector_id_cliente">
<?php
$wrkonchange = trim(" " . @$viewavaluoinspector->id_cliente->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$viewavaluoinspector->id_cliente->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" style="white-space: nowrap; z-index: <?php echo (9000 - $viewavaluoinspector_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" id="sv_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" value="<?php echo $viewavaluoinspector->id_cliente->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->getPlaceHolder()) ?>"<?php echo $viewavaluoinspector->id_cliente->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_cliente" data-value-separator="<?php echo $viewavaluoinspector->id_cliente->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fviewavaluoinspectorgrid.CreateAutoSuggest({"id":"x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente","forceSelect":false});
</script>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_cliente" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_cliente" class="form-group viewavaluoinspector_id_cliente">
<span<?php echo $viewavaluoinspector->id_cliente->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->id_cliente->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_cliente" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_id_cliente" class="viewavaluoinspector_id_cliente">
<span<?php echo $viewavaluoinspector->id_cliente->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->id_cliente->ListViewValue() ?></span>
</span>
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_cliente" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_cliente" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_cliente" name="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" id="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_cliente" name="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" id="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->estado->Visible) { // estado ?>
		<td data-name="estado"<?php echo $viewavaluoinspector->estado->CellAttributes() ?>>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_estado" class="form-group viewavaluoinspector_estado">
<select data-table="viewavaluoinspector" data-field="x_estado" data-value-separator="<?php echo $viewavaluoinspector->estado->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado"<?php echo $viewavaluoinspector->estado->EditAttributes() ?>>
<?php echo $viewavaluoinspector->estado->SelectOptionListHtml("x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado") ?>
</select>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estado" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estado->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_estado" class="form-group viewavaluoinspector_estado">
<span<?php echo $viewavaluoinspector->estado->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->estado->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estado" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estado->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_estado" class="viewavaluoinspector_estado">
<span<?php echo $viewavaluoinspector->estado->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->estado->ListViewValue() ?></span>
</span>
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estado" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estado->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estado" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estado->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estado" name="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" id="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estado->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estado" name="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" id="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estado->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->estadointerno->Visible) { // estadointerno ?>
		<td data-name="estadointerno"<?php echo $viewavaluoinspector->estadointerno->CellAttributes() ?>>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_estadointerno" class="form-group viewavaluoinspector_estadointerno">
<select data-table="viewavaluoinspector" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluoinspector->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno"<?php echo $viewavaluoinspector->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluoinspector->estadointerno->SelectOptionListHtml("x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno") ?>
</select>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadointerno" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadointerno->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_estadointerno" class="form-group viewavaluoinspector_estadointerno">
<select data-table="viewavaluoinspector" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluoinspector->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno"<?php echo $viewavaluoinspector->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluoinspector->estadointerno->SelectOptionListHtml("x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno") ?>
</select>
</span>
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_estadointerno" class="viewavaluoinspector_estadointerno">
<span<?php echo $viewavaluoinspector->estadointerno->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->estadointerno->ListViewValue() ?></span>
</span>
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadointerno" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadointerno->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadointerno" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadointerno->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadointerno" name="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" id="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadointerno->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadointerno" name="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" id="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadointerno->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->estadopago->Visible) { // estadopago ?>
		<td data-name="estadopago"<?php echo $viewavaluoinspector->estadopago->CellAttributes() ?>>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_estadopago" class="form-group viewavaluoinspector_estadopago">
<select data-table="viewavaluoinspector" data-field="x_estadopago" data-value-separator="<?php echo $viewavaluoinspector->estadopago->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago"<?php echo $viewavaluoinspector->estadopago->EditAttributes() ?>>
<?php echo $viewavaluoinspector->estadopago->SelectOptionListHtml("x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago") ?>
</select>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadopago" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadopago->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_estadopago" class="form-group viewavaluoinspector_estadopago">
<span<?php echo $viewavaluoinspector->estadopago->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->estadopago->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadopago" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadopago->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_estadopago" class="viewavaluoinspector_estadopago">
<span<?php echo $viewavaluoinspector->estadopago->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->estadopago->ListViewValue() ?></span>
</span>
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadopago" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadopago->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadopago" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadopago->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadopago" name="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" id="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadopago->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadopago" name="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" id="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadopago->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<td data-name="fecha_avaluo"<?php echo $viewavaluoinspector->fecha_avaluo->CellAttributes() ?>>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_fecha_avaluo" class="form-group viewavaluoinspector_fecha_avaluo">
<input type="text" data-table="viewavaluoinspector" data-field="x_fecha_avaluo" data-format="10" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluoinspector->fecha_avaluo->EditValue ?>"<?php echo $viewavaluoinspector->fecha_avaluo->EditAttributes() ?>>
<?php if (!$viewavaluoinspector->fecha_avaluo->ReadOnly && !$viewavaluoinspector->fecha_avaluo->Disabled && !isset($viewavaluoinspector->fecha_avaluo->EditAttrs["readonly"]) && !isset($viewavaluoinspector->fecha_avaluo->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fviewavaluoinspectorgrid", "x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo", {"ignoreReadonly":true,"useCurrent":false,"format":10});
</script>
<?php } ?>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_fecha_avaluo" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluoinspector->fecha_avaluo->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_fecha_avaluo" class="form-group viewavaluoinspector_fecha_avaluo">
<span<?php echo $viewavaluoinspector->fecha_avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->fecha_avaluo->EditValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_fecha_avaluo" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluoinspector->fecha_avaluo->CurrentValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_fecha_avaluo" class="viewavaluoinspector_fecha_avaluo">
<span<?php echo $viewavaluoinspector->fecha_avaluo->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->fecha_avaluo->ListViewValue() ?></span>
</span>
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_fecha_avaluo" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluoinspector->fecha_avaluo->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_fecha_avaluo" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluoinspector->fecha_avaluo->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_fecha_avaluo" name="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" id="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluoinspector->fecha_avaluo->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_fecha_avaluo" name="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" id="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluoinspector->fecha_avaluo->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->comentario->Visible) { // comentario ?>
		<td data-name="comentario"<?php echo $viewavaluoinspector->comentario->CellAttributes() ?>>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_ADD) { // Add record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_comentario" class="form-group viewavaluoinspector_comentario">
<textarea data-table="viewavaluoinspector" data-field="x_comentario" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluoinspector->comentario->EditAttributes() ?>><?php echo $viewavaluoinspector->comentario->EditValue ?></textarea>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_comentario" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluoinspector->comentario->OldValue) ?>">
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_EDIT) { // Edit record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_comentario" class="form-group viewavaluoinspector_comentario">
<textarea data-table="viewavaluoinspector" data-field="x_comentario" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluoinspector->comentario->EditAttributes() ?>><?php echo $viewavaluoinspector->comentario->EditValue ?></textarea>
</span>
<?php } ?>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_VIEW) { // View record ?>
<span id="el<?php echo $viewavaluoinspector_grid->RowCnt ?>_viewavaluoinspector_comentario" class="viewavaluoinspector_comentario">
<span<?php echo $viewavaluoinspector->comentario->ViewAttributes() ?>>
<?php echo $viewavaluoinspector->comentario->ListViewValue() ?></span>
</span>
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_comentario" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluoinspector->comentario->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_comentario" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluoinspector->comentario->OldValue) ?>">
<?php } else { ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_comentario" name="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" id="fviewavaluoinspectorgrid$x<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluoinspector->comentario->FormValue) ?>">
<input type="hidden" data-table="viewavaluoinspector" data-field="x_comentario" name="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" id="fviewavaluoinspectorgrid$o<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluoinspector->comentario->OldValue) ?>">
<?php } ?>
<?php } ?>
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewavaluoinspector_grid->ListOptions->Render("body", "right", $viewavaluoinspector_grid->RowCnt);
?>
	</tr>
<?php if ($viewavaluoinspector->RowType == EW_ROWTYPE_ADD || $viewavaluoinspector->RowType == EW_ROWTYPE_EDIT) { ?>
<script type="text/javascript">
fviewavaluoinspectorgrid.UpdateOpts(<?php echo $viewavaluoinspector_grid->RowIndex ?>);
</script>
<?php } ?>
<?php
	}
	} // End delete row checking
	if ($viewavaluoinspector->CurrentAction <> "gridadd" || $viewavaluoinspector->CurrentMode == "copy")
		if (!$viewavaluoinspector_grid->Recordset->EOF) $viewavaluoinspector_grid->Recordset->MoveNext();
}
?>
<?php
	if ($viewavaluoinspector->CurrentMode == "add" || $viewavaluoinspector->CurrentMode == "copy" || $viewavaluoinspector->CurrentMode == "edit") {
		$viewavaluoinspector_grid->RowIndex = '$rowindex$';
		$viewavaluoinspector_grid->LoadRowValues();

		// Set row properties
		$viewavaluoinspector->ResetAttrs();
		$viewavaluoinspector->RowAttrs = array_merge($viewavaluoinspector->RowAttrs, array('data-rowindex'=>$viewavaluoinspector_grid->RowIndex, 'id'=>'r0_viewavaluoinspector', 'data-rowtype'=>EW_ROWTYPE_ADD));
		ew_AppendClass($viewavaluoinspector->RowAttrs["class"], "ewTemplate");
		$viewavaluoinspector->RowType = EW_ROWTYPE_ADD;

		// Render row
		$viewavaluoinspector_grid->RenderRow();

		// Render list options
		$viewavaluoinspector_grid->RenderListOptions();
		$viewavaluoinspector_grid->StartRowCnt = 0;
?>
	<tr<?php echo $viewavaluoinspector->RowAttributes() ?>>
<?php

// Render list options (body, left)
$viewavaluoinspector_grid->ListOptions->Render("body", "left", $viewavaluoinspector_grid->RowIndex);
?>
	<?php if ($viewavaluoinspector->id_solicitud->Visible) { // id_solicitud ?>
		<td data-name="id_solicitud">
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<?php if ($viewavaluoinspector->id_solicitud->getSessionValue() <> "") { ?>
<span id="el$rowindex$_viewavaluoinspector_id_solicitud" class="form-group viewavaluoinspector_id_solicitud">
<span<?php echo $viewavaluoinspector->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_solicitud->CurrentValue) ?>">
<?php } else { ?>
<span id="el$rowindex$_viewavaluoinspector_id_solicitud" class="form-group viewavaluoinspector_id_solicitud">
<select data-table="viewavaluoinspector" data-field="x_id_solicitud" data-value-separator="<?php echo $viewavaluoinspector->id_solicitud->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud"<?php echo $viewavaluoinspector->id_solicitud->EditAttributes() ?>>
<?php echo $viewavaluoinspector->id_solicitud->SelectOptionListHtml("x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud") ?>
</select>
</span>
<?php } ?>
<?php } else { ?>
<span id="el$rowindex$_viewavaluoinspector_id_solicitud" class="form-group viewavaluoinspector_id_solicitud">
<span<?php echo $viewavaluoinspector->id_solicitud->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->id_solicitud->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_solicitud" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_solicitud->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_solicitud" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_solicitud" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_solicitud->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->id_oficialcredito->Visible) { // id_oficialcredito ?>
		<td data-name="id_oficialcredito">
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluoinspector_id_oficialcredito" class="form-group viewavaluoinspector_id_oficialcredito">
<?php
$wrkonchange = trim(" " . @$viewavaluoinspector->id_oficialcredito->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$viewavaluoinspector->id_oficialcredito->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" style="white-space: nowrap; z-index: <?php echo (9000 - $viewavaluoinspector_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" id="sv_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" value="<?php echo $viewavaluoinspector->id_oficialcredito->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->getPlaceHolder()) ?>"<?php echo $viewavaluoinspector->id_oficialcredito->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_oficialcredito" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluoinspector->id_oficialcredito->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fviewavaluoinspectorgrid.CreateAutoSuggest({"id":"x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito","forceSelect":false});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluoinspector->id_oficialcredito->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito',m:0,n:10,srch:true});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluoinspector->id_oficialcredito->ReadOnly || $viewavaluoinspector->id_oficialcredito->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluoinspector_id_oficialcredito" class="form-group viewavaluoinspector_id_oficialcredito">
<span<?php echo $viewavaluoinspector->id_oficialcredito->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->id_oficialcredito->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_oficialcredito" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_oficialcredito" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_oficialcredito" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_oficialcredito->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->id_inspector->Visible) { // id_inspector ?>
		<td data-name="id_inspector">
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluoinspector_id_inspector" class="form-group viewavaluoinspector_id_inspector">
<?php
$wrkonchange = trim(" " . @$viewavaluoinspector->id_inspector->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$viewavaluoinspector->id_inspector->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" style="white-space: nowrap; z-index: <?php echo (9000 - $viewavaluoinspector_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" id="sv_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" value="<?php echo $viewavaluoinspector->id_inspector->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->getPlaceHolder()) ?>"<?php echo $viewavaluoinspector->id_inspector->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_inspector" data-multiple="0" data-lookup="1" data-value-separator="<?php echo $viewavaluoinspector->id_inspector->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fviewavaluoinspectorgrid.CreateAutoSuggest({"id":"x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector","forceSelect":false});
</script>
<button type="button" title="<?php echo ew_HtmlEncode(str_replace("%s", ew_RemoveHtml($viewavaluoinspector->id_inspector->FldCaption()), $Language->Phrase("LookupLink", TRUE))) ?>" onclick="ew_ModalLookupShow({lnk:this,el:'x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector',m:0,n:10,srch:true});" class="ewLookupBtn btn btn-default btn-sm"<?php echo (($viewavaluoinspector->id_inspector->ReadOnly || $viewavaluoinspector->id_inspector->Disabled) ? " disabled" : "")?>><span class="glyphicon glyphicon-search ewIcon"></span></button>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluoinspector_id_inspector" class="form-group viewavaluoinspector_id_inspector">
<span<?php echo $viewavaluoinspector->id_inspector->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->id_inspector->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_inspector" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_inspector" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_inspector" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_inspector->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->id_cliente->Visible) { // id_cliente ?>
		<td data-name="id_cliente">
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluoinspector_id_cliente" class="form-group viewavaluoinspector_id_cliente">
<?php
$wrkonchange = trim(" " . @$viewavaluoinspector->id_cliente->EditAttrs["onchange"]);
if ($wrkonchange <> "") $wrkonchange = " onchange=\"" . ew_JsEncode2($wrkonchange) . "\"";
$viewavaluoinspector->id_cliente->EditAttrs["onchange"] = "";
?>
<span id="as_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" style="white-space: nowrap; z-index: <?php echo (9000 - $viewavaluoinspector_grid->RowCnt * 10) ?>">
	<input type="text" name="sv_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" id="sv_x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" value="<?php echo $viewavaluoinspector->id_cliente->EditValue ?>" size="30" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->getPlaceHolder()) ?>" data-placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->getPlaceHolder()) ?>"<?php echo $viewavaluoinspector->id_cliente->EditAttributes() ?>>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_cliente" data-value-separator="<?php echo $viewavaluoinspector->id_cliente->DisplayValueSeparatorAttribute() ?>" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->CurrentValue) ?>"<?php echo $wrkonchange ?>>
<script type="text/javascript">
fviewavaluoinspectorgrid.CreateAutoSuggest({"id":"x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente","forceSelect":false});
</script>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluoinspector_id_cliente" class="form-group viewavaluoinspector_id_cliente">
<span<?php echo $viewavaluoinspector->id_cliente->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->id_cliente->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_cliente" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_id_cliente" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_id_cliente" value="<?php echo ew_HtmlEncode($viewavaluoinspector->id_cliente->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->estado->Visible) { // estado ?>
		<td data-name="estado">
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluoinspector_estado" class="form-group viewavaluoinspector_estado">
<select data-table="viewavaluoinspector" data-field="x_estado" data-value-separator="<?php echo $viewavaluoinspector->estado->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado"<?php echo $viewavaluoinspector->estado->EditAttributes() ?>>
<?php echo $viewavaluoinspector->estado->SelectOptionListHtml("x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluoinspector_estado" class="form-group viewavaluoinspector_estado">
<span<?php echo $viewavaluoinspector->estado->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->estado->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estado" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estado->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estado" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estado" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estado->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->estadointerno->Visible) { // estadointerno ?>
		<td data-name="estadointerno">
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluoinspector_estadointerno" class="form-group viewavaluoinspector_estadointerno">
<select data-table="viewavaluoinspector" data-field="x_estadointerno" data-value-separator="<?php echo $viewavaluoinspector->estadointerno->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno"<?php echo $viewavaluoinspector->estadointerno->EditAttributes() ?>>
<?php echo $viewavaluoinspector->estadointerno->SelectOptionListHtml("x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluoinspector_estadointerno" class="form-group viewavaluoinspector_estadointerno">
<span<?php echo $viewavaluoinspector->estadointerno->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->estadointerno->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadointerno" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadointerno->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadointerno" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadointerno" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadointerno->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->estadopago->Visible) { // estadopago ?>
		<td data-name="estadopago">
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluoinspector_estadopago" class="form-group viewavaluoinspector_estadopago">
<select data-table="viewavaluoinspector" data-field="x_estadopago" data-value-separator="<?php echo $viewavaluoinspector->estadopago->DisplayValueSeparatorAttribute() ?>" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago"<?php echo $viewavaluoinspector->estadopago->EditAttributes() ?>>
<?php echo $viewavaluoinspector->estadopago->SelectOptionListHtml("x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago") ?>
</select>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluoinspector_estadopago" class="form-group viewavaluoinspector_estadopago">
<span<?php echo $viewavaluoinspector->estadopago->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->estadopago->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadopago" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadopago->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_estadopago" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_estadopago" value="<?php echo ew_HtmlEncode($viewavaluoinspector->estadopago->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->fecha_avaluo->Visible) { // fecha_avaluo ?>
		<td data-name="fecha_avaluo">
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluoinspector_fecha_avaluo" class="form-group viewavaluoinspector_fecha_avaluo">
<input type="text" data-table="viewavaluoinspector" data-field="x_fecha_avaluo" data-format="10" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->fecha_avaluo->getPlaceHolder()) ?>" value="<?php echo $viewavaluoinspector->fecha_avaluo->EditValue ?>"<?php echo $viewavaluoinspector->fecha_avaluo->EditAttributes() ?>>
<?php if (!$viewavaluoinspector->fecha_avaluo->ReadOnly && !$viewavaluoinspector->fecha_avaluo->Disabled && !isset($viewavaluoinspector->fecha_avaluo->EditAttrs["readonly"]) && !isset($viewavaluoinspector->fecha_avaluo->EditAttrs["disabled"])) { ?>
<script type="text/javascript">
ew_CreateDateTimePicker("fviewavaluoinspectorgrid", "x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo", {"ignoreReadonly":true,"useCurrent":false,"format":10});
</script>
<?php } ?>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluoinspector_fecha_avaluo" class="form-group viewavaluoinspector_fecha_avaluo">
<span<?php echo $viewavaluoinspector->fecha_avaluo->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->fecha_avaluo->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_fecha_avaluo" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluoinspector->fecha_avaluo->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_fecha_avaluo" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_fecha_avaluo" value="<?php echo ew_HtmlEncode($viewavaluoinspector->fecha_avaluo->OldValue) ?>">
</td>
	<?php } ?>
	<?php if ($viewavaluoinspector->comentario->Visible) { // comentario ?>
		<td data-name="comentario">
<?php if ($viewavaluoinspector->CurrentAction <> "F") { ?>
<span id="el$rowindex$_viewavaluoinspector_comentario" class="form-group viewavaluoinspector_comentario">
<textarea data-table="viewavaluoinspector" data-field="x_comentario" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" cols="35" rows="4" placeholder="<?php echo ew_HtmlEncode($viewavaluoinspector->comentario->getPlaceHolder()) ?>"<?php echo $viewavaluoinspector->comentario->EditAttributes() ?>><?php echo $viewavaluoinspector->comentario->EditValue ?></textarea>
</span>
<?php } else { ?>
<span id="el$rowindex$_viewavaluoinspector_comentario" class="form-group viewavaluoinspector_comentario">
<span<?php echo $viewavaluoinspector->comentario->ViewAttributes() ?>>
<p class="form-control-static"><?php echo $viewavaluoinspector->comentario->ViewValue ?></p></span>
</span>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_comentario" name="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" id="x<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluoinspector->comentario->FormValue) ?>">
<?php } ?>
<input type="hidden" data-table="viewavaluoinspector" data-field="x_comentario" name="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" id="o<?php echo $viewavaluoinspector_grid->RowIndex ?>_comentario" value="<?php echo ew_HtmlEncode($viewavaluoinspector->comentario->OldValue) ?>">
</td>
	<?php } ?>
<?php

// Render list options (body, right)
$viewavaluoinspector_grid->ListOptions->Render("body", "right", $viewavaluoinspector_grid->RowCnt);
?>
<script type="text/javascript">
fviewavaluoinspectorgrid.UpdateOpts(<?php echo $viewavaluoinspector_grid->RowIndex ?>);
</script>
	</tr>
<?php
}
?>
</tbody>
</table>
<?php if ($viewavaluoinspector->CurrentMode == "add" || $viewavaluoinspector->CurrentMode == "copy") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridinsert">
<input type="hidden" name="<?php echo $viewavaluoinspector_grid->FormKeyCountName ?>" id="<?php echo $viewavaluoinspector_grid->FormKeyCountName ?>" value="<?php echo $viewavaluoinspector_grid->KeyCount ?>">
<?php echo $viewavaluoinspector_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewavaluoinspector->CurrentMode == "edit") { ?>
<input type="hidden" name="a_list" id="a_list" value="gridupdate">
<input type="hidden" name="<?php echo $viewavaluoinspector_grid->FormKeyCountName ?>" id="<?php echo $viewavaluoinspector_grid->FormKeyCountName ?>" value="<?php echo $viewavaluoinspector_grid->KeyCount ?>">
<?php echo $viewavaluoinspector_grid->MultiSelectKey ?>
<?php } ?>
<?php if ($viewavaluoinspector->CurrentMode == "") { ?>
<input type="hidden" name="a_list" id="a_list" value="">
<?php } ?>
<input type="hidden" name="detailpage" value="fviewavaluoinspectorgrid">
</div>
<?php

// Close recordset
if ($viewavaluoinspector_grid->Recordset)
	$viewavaluoinspector_grid->Recordset->Close();
?>
<?php if ($viewavaluoinspector_grid->ShowOtherOptions) { ?>
<div class="box-footer ewGridLowerPanel">
<?php
	foreach ($viewavaluoinspector_grid->OtherOptions as &$option)
		$option->Render("body", "bottom");
?>
</div>
<div class="clearfix"></div>
<?php } ?>
</div>
</div>
<?php } ?>
<?php if ($viewavaluoinspector_grid->TotalRecs == 0 && $viewavaluoinspector->CurrentAction == "") { // Show other options ?>
<div class="ewListOtherOptions">
<?php
	foreach ($viewavaluoinspector_grid->OtherOptions as &$option) {
		$option->ButtonClass = "";
		$option->Render("body", "");
	}
?>
</div>
<div class="clearfix"></div>
<?php } ?>
<?php if ($viewavaluoinspector->Export == "") { ?>
<script type="text/javascript">
fviewavaluoinspectorgrid.Init();
</script>
<?php } ?>
<?php
$viewavaluoinspector_grid->Page_Terminate();
?>
